<div class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-md-12 text-center">
		<h1 class="m-0">Anasayfa ayarları</h1>
	  </div><!-- /.col -->
	</div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php 
					if(in_array("settings", explode(",", $active_query_user["pages"]))){
						$homepage_settings=mysqli_fetch_array(mysqli_query($con,"SELECT homepage_settings.*,admin_users.user_name FROM homepage_settings INNER JOIN admin_users ON homepage_settings.user_id=admin_users.user_id"));
						if($_POST){
							$top_header=trim(case_converter($_POST["top_header"]));
							$bottom_header=trim(mb_convert_case(htmlspecialchars($_POST["bottom_header"], ENT_QUOTES), MB_CASE_TITLE, "utf-8"));
							$history=htmlspecialchars($_POST["history"], ENT_QUOTES);
							$password=trim(md5($_POST["password"]));
							if(is_uploaded_file($_FILES["background"]["tmp_name"])){
								$background=pathinfo($_FILES["background"]["name"]);
								$background_extension=$background["extension"];
								if($background_extension=="png" or $background_extension=="PNG" or $background_extension=="jpg" or $background_extension=="JPG" or $background_extension=="jpeg" or $background_extension=="JPEG"){
									$background_file_name="homepage_background_".uniqid(True);
									$background_new_adress="../uploads/site/".$background_file_name.".".$background_extension;
									if(move_uploaded_file($_FILES["background"]["tmp_name"],$background_new_adress)){
										if($homepage_settings["background"]){
											unlink("../uploads/site/".$homepage_settings["background"]);
										}
										$background=$background_file_name.".".$background_extension;
									}else{
										$hata=0;
										message("warning","exclamation-triangle","Dikkat!","Arkaplan fotoğrafı yüklenemedi.");
									}
								}else{
									$hata=0;
									message("warning","exclamation-triangle","Dikkat!","Lütfen belirtilen uzantılara ( png, jpeg, jpg ) uygun arkaplan fotoğrafı ekleyiniz.");
								}
							}else{
								$background=$homepage_settings["background"];
							}
							if($hata){
								if($password == $active_query_user["password"]){
									$datetime=date('d.m.Y H:i:s', time()+60*60);
									$query=mysqli_query($con, "UPDATE homepage_settings SET top_header='$top_header', bottom_header='$bottom_header', history='$history', background='$background', date='$datetime', user_id='$active_user_id'");
									echo mysqli_error($con);
									if($query){
										system_archives($con, "Anasayfa ayarları güncellendi", "Anasayfa Ayarları Güncellendi", $active_user_id);
										message("success","check","Başarılı","Anasayfa ayarları başarılı bir şekilde güncellendi");
										_header("site_settings");
									}else{
										message("warning","exclamation-triangle","Dikkat!","Güncelleme yapılamadı. Lütfen tekrar deneyiniz");
									}
								}else{
									$pass_result=0;
									message("warning","exclamation-triangle","Dikkat!","Şifrenizi yanlış girdiniz.");
								}
							}
						}
					?>
					<div class="card card-info">
						<div class="card-header text-center"><h3 class="card-title float-none">Site ayarları</h3></div>
						<div class="mt-3 mr-3">
							<span class="float-right">Zorunlu olarak doldurulması gereken alanlar kırmızıyla işaretlenmiştir.</span><br />
							<span class="float-right">En son güncellenme zamanı : <?php echo $homepage_settings["date"]; ?></span><br />
							<span class="float-right">En son güncelleyen kişi : <?php echo $homepage_settings["user_name"]; ?></span>
						</div>
						<form method="post" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group">
									<label class="mandatory_field">Üst başlık</label>
									<input type="text" class="form-control form-control-border border-width-2" name="top_header" placeholder="Üst başlık..." title="Üst başlık yazınız" value="<?php if($_POST){ echo $top_header; }else{ echo $homepage_settings["top_header"]; } ?>" required>
								</div>
								<div class="form-group">
									<label class="mandatory_field">Alt başlık</label>
									<input type="text" class="form-control form-control-border border-width-2" name="bottom_header" placeholder="Alt başlık..." title="Alt başlık yazınız" value="<?php if($_POST){ echo $bottom_header; }else{ echo $homepage_settings["bottom_header"]; } ?>" required>
								</div>
								<div class="form-group">
									<label class="mandatory_field">Tarihçe</label>
									<textarea class="form-control" name="history" placeholder="Tarihçe..." title="Tarihçe yazınız" required rows="10"><?php if($_POST){ echo $history; }else{ echo $homepage_settings["history"]; } ?></textarea>
								</div>
								<div class="form-group">
									<label>Arkaplan fotoğrafı</label><span class="text-muted"> ( Kabul edilen uzantılar : jpg - png - jpeg )</span>
									<div class="input-group">
										<div class="custom-file">
											<input type="file" name="background" title="Anasayfa arkaplan görseli ekleyiniz" class="custom-file-input">
											<label class="custom-file-label">Dosya seçin...</label>
										</div>
									</div>
								</div>
								<div class="form-group text-center">
									<label class="mandatory_field">Şifreniz</label><span class="text-muted"> ( İşlemi tamamlayabilmek için şifrenizi girmeniz gerekmektedir. )</span>
									<input type="password" class="form-control form-control-border border-width-2 <?php input_control($_POST, $pass_result); ?>" id="inputError" name="password" title="İşlemi tamamlayabilmek için kendi şifrenizi giriniz" minlength="8" placeholder="Şifreniz...">
								</div>
							</div>
							<div class="card-footer"><button type="submit" class="btn btn-info float-right">Güncelle</button></div>
						</form>
					</div>
				<?php
					}else{
						message("danger","ban","Dikkat!","Buraya girmeye yetkiniz yoktur. Lütfen bekleyiniz ana sayfaya yönlendirliyorsunuz");
						_header("");
					}
				?>
			</div>
		</div>
	</div>
</div>
