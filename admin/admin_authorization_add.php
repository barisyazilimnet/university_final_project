<div class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-md-12 text-center">
		<h1 class="m-0">Admin yetki ekleme</h1>
	  </div><!-- /.col -->
	</div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php 
					if(in_array("admin_authorization", explode(",", $active_query_user["pages"]))){
						message("info", "info", "Bilgi", "Lütfen yeni yetki eklerken yetki sıralamasının üst rütbeden alt rütbeye dogru sıralı olmasına dikkat ediniz");
						$query_authorization=mysqli_num_rows(mysqli_query($con,"SELECT * FROM user_authorization"));
						if($_POST){
							if($query_authorization < 9){
								$name=trim(mb_convert_case($_POST["name"], MB_CASE_TITLE, "utf-8"));
								$color=$_POST["color"];
								@$pages=$_POST["pages"];
								if($pages!=""){
									$pages=implode(",", $pages);
								}
								$password=trim(md5($_POST["password"]));
								if($password == $active_query_user["password"]){
									$authorization_id=$query_authorization+1;
									$query=mysqli_query($con, "INSERT INTO user_authorization SET authorization_id='$authorization_id', name='$name', authorization_color='$color', pages='$pages', user_id='$active_user_id'");
									if($query){
										system_archives($con, "$name isimli yetki eklendi", "Yetki Eklendi", $active_user_id);
										message("success","check","Başarılı","$name isimli yetki eklendi");
										_header("admin_authorization");
									}else{
										message("warning","exclamation-triangle","Dikkat!","Yetki eklenemedi");
									}
								}else{
									$pass_result=0;
									message("warning","exclamation-triangle","Dikkat!","Şifrenizi yanlış girdiniz.");
								}
							}else{
								message("warning","exclamation-triangle","Dikkat!","Yetki ekleme sınırını aştınız");
							}
						}
					?>
					<div class="card card-info">
						<div class="card-header text-center"><h3 class="card-title float-none">Yeni yetki ekleme</h3></div>
						<div class="mt-3 mr-3">
							<span class="float-right">Zorunlu olarak doldurulması gereken alanlar kırmızıyla işaretlenmiştir.</span><br />
							<span class="float-right">En fazla 8 adet yetki eklenebilir. Güncel : <?php echo $query_authorization; ?> adet yetki bulunmaktadır</span>
						</div>
						<form method="post">
							<div class="card-body">
								<div class="form-group">
									<label class="mandatory_field">Yetki ismi</label>
									<input type="text" class="form-control form-control-border border-width-2" name="name" placeholder="Yetki ismi..." title="Yetki ismi giriniz" value="<?php if($_POST){ echo $name; } ?>" required>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label class="mandatory_field">Üye yetki rengi</label>
										<select class="form-control form-control-border border-width-2" name="color">
											<option value="primary" <?php if($_POST){ if($color=="primary"){ echo "selected"; } } ?> class="bg-primary">Primary</option>
											<option value="warning" <?php if($_POST){ if($color=="warning"){ echo "selected"; } } ?> class="bg-warning">Warning</option>
											<option value="secondary" <?php if($_POST){ if($color=="secondary"){ echo "selected"; } } ?> class="bg-secondary">Secondary</option>
											<option value="success" <?php if($_POST){ if($color=="success"){ echo "selected"; } } ?> class="bg-success">Success</option>
											<option value="danger" <?php if($_POST){ if($color=="danger"){ echo "selected"; } } ?> class="bg-danger">Danger</option>
											<option value="info" <?php if($_POST){ if($color=="info"){ echo "selected"; } } ?> class="bg-info">İnfo</option>
											<option value="light" <?php if($_POST){ if($color=="light"){ echo "selected"; } } ?> class="bg-light">Light</option>
											<option value="dark" <?php if($_POST){ if($color=="dark"){ echo "selected"; } } ?> class="bg-dark">Dark</option>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label>Örnek</label><br />
										<span class="badge badge-pill badge-primary mx-3">Primary</span>
										<span class="badge badge-pill badge-warning mx-3">Warning</span>
										<span class="badge badge-pill badge-secondary mx-3">Secondary</span>
										<span class="badge badge-pill badge-success mx-3">Success</span>
										<span class="badge badge-pill badge-danger mx-3">Danger</span>
										<span class="badge badge-pill badge-info mx-3">İnfo</span>
										<span class="badge badge-pill badge-light mx-3">Light</span>
										<span class="badge badge-pill badge-dark mx-3">Dark</span>
									</div>
								</div>
								<div class="form-group">
									<label class="mandatory_field">İzinler</label><br />
								    <input class="ml-2" type="checkbox" name="pages[]" value="settings" <?php authorization_add_pages_control($_POST, @$pages, "settings"); ?> /> Ayarlar &nbsp;&nbsp;
								    <input type="checkbox" name="pages[]" value="admin_authorization" <?php authorization_add_pages_control($_POST, @$pages, "admin_authorization"); ?> /> Yetki işlemleri &nbsp;&nbsp;
								    <input type="checkbox" name="pages[]" value="system_archives" <?php authorization_add_pages_control($_POST, @$pages, "system_archives"); ?> /> Sistem kayıtları &nbsp;&nbsp;
								    <input type="checkbox" name="pages[]" value="admin_user_transactions" <?php authorization_add_pages_control($_POST, @$pages, "admin_user_transactions"); ?> /> Admin üye işlemleri &nbsp;&nbsp;
								    <input type="checkbox" name="pages[]" value="user_transactions" <?php authorization_add_pages_control($_POST, @$pages, "user_transactions"); ?> /> Üye işlemleri &nbsp;&nbsp;	<input type="checkbox" name="pages[]" value="gallery_transactions" <?php authorization_add_pages_control($_POST, @$pages, "gallery_transactions"); ?> /> Galeri işlemleri &nbsp;&nbsp;
								</div>
								<div class="form-group text-center">
									<label class="mandatory_field">Şifreniz</label><span class="text-muted"> ( İşlemi tamamlayabilmek için şifrenizi girmeniz gerekmektedir. )</span>
									<input type="password" class="form-control form-control-border border-width-2 <?php input_control($_POST, $pass_result); ?>" id="inputError" name="password" title="İşlemi tamamlayabilmek için kendi şifrenizi giriniz" minlength="8" placeholder="Şifreniz...">
								</div>
							</div>
							<div class="card-footer"><button type="submit" class="btn btn-info float-right">Ekle</button></div>
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
