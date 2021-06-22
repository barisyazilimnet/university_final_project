<div class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-md-12 text-center">
		<h1 class="m-0">Bakımda sayfası</h1>
	  </div><!-- /.col -->
	</div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php 
					$query_coming_soon=mysqli_fetch_array(mysqli_query($con,"SELECT coming_soon.*,admin_users.user_name FROM coming_soon INNER JOIN admin_users ON coming_soon.user_id=admin_users.user_id"));
					if(in_array("settings", explode(",", $active_query_user["pages"]))){
						if($_POST){
							$header=trim(mb_convert_case($_POST["header"], MB_CASE_TITLE, "utf-8"));
							$description=trim(mb_convert_case($_POST["description"], MB_CASE_TITLE, "utf-8"));
							$time=$_POST["date"];
							$password=trim(md5($_POST["password"]));
							if($password == $active_query_user["password"]){
								$query=mysqli_query($con, "UPDATE coming_soon SET header='$header', description='$description', time='$time', user_id='$active_user_id'");
								if($query){
									system_archives($con, "Bakımda sayfası güncellendi", "Bakımda sayfası Güncellendi", $active_user_id);
									message("success","check","Başarılı","Bakımda sayfası başarılı bir şekilde güncellendi");
									_header("coming_soon");
								}else{
									message("warning","exclamation-triangle","Dikkat!","Güncelleme yapılamadı. Lütfen tekrar deneyiniz");
								}
							}else{
								$pass_result=0;
								message("warning","exclamation-triangle","Dikkat!","Şifrenizi yanlış girdiniz.");
							}
						}
					?>
					<div class="card card-info">
					<div class="card-header text-center"><h3 class="card-title float-none">Site ayarları</h3></div>
						<div class="mt-3 mr-3">
							<span class="float-right">Zorunlu olarak doldurulması gereken alanlar kırmızıyla işaretlenmiştir.</span><br />
							<span class="float-right">En son güncelleyen kişi : <?php echo $query_coming_soon["user_name"]; ?></span>
						</div>
						<form method="post" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group">
									<label class="mandatory_field">Başlık</label>
									<input type="text" class="form-control form-control-border border-width-2" name="header" placeholder="Başlık..." title="Başlık giriniz" value="<?php if($_POST){ echo $header; }else{ echo $query_coming_soon["header"]; } ?>" required>
								</div>
								<div class="form-group">
									<label class="mandatory_field">Açıklama</label>
									<input type="text" class="form-control form-control-border border-width-2" name="description" placeholder="Açıklama..." title="Açıklama giriniz" value="<?php if($_POST){ echo $description; }else{ echo $query_coming_soon["description"]; } ?>" required>
								</div>
								<div class="form-group">
									<label class="mandatory_field">Tarih</label><span class="text-muted"> ( Tahmini olarak sitenin tekrar açılma tarihi )</span>
									<input type="date" class="form-control form-control-border border-width-2" name="date" placeholder="Tarih..." title="Tarih seçiniz" value="<?php if($_POST){ echo $time; }else{ echo $query_coming_soon["time"]; } ?>" required>
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
