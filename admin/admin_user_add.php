<div class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-md-12 text-center">
		<h1 class="m-0">Üye ekle</h1>
	  </div><!-- /.col -->
	</div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php 
					if(in_array("admin_user_transactions", explode(",", $active_query_user["pages"]))){
						if($_POST){
							$name=trim(mb_convert_case($_POST["name"], MB_CASE_TITLE, "utf-8"));
							$surname=trim(case_converter($_POST["surname"]));
							$name_surname=$name." ".$surname;
							$user_name=trim($_POST["user_name"]);
							$birthday=$_POST["birthday"];
							$email=trim($_POST["email"]);
							$phone_number=$_POST["phone_number"];
							$web_site=trim($_POST["web_site"]);
							$facebook=trim($_POST["facebook"]);
							$twitter=trim($_POST["twitter"]);
							$linkedin=trim($_POST["linkedin"]);
							$instagram=trim($_POST["instagram"]);
							$pinterest=trim($_POST["pinterest"]);
							$gender=$_POST["gender"];
							$authorization=$_POST["authorization"];
							$status=$_POST["status"];
							$password=md5($_POST["password"]);
							$user_password=md5($_POST["user_password"]);
							$turkish_characters=array("ğ", "Ğ", "ç", "Ç", "ş", "Ş", "ü", "Ü", "ö", "Ö", "ı", "İ");
							foreach($turkish_characters as $value){
								$turkish=strstr($user_name, $value);
							}
							if($turkish==False){
								$user_name_control = mysqli_num_rows(mysqli_query($con,"SELECT * FROM admin_users WHERE user_name = '$user_name'"));
								if ($user_name_control == 0){
									$email_control= mysqli_num_rows(mysqli_query($con,"SELECT * FROM admin_users WHERE email='$email'"));
									if ($email_control == 0){
										if(is_uploaded_file($_FILES["photo"]["tmp_name"])){
											$photo=pathinfo($_FILES["photo"]["name"]);
											$photo_extension=$photo["extension"];
											if($photo_extension=="png" or $photo_extension=="PNG" or $photo_extension=="jpg" or $photo_extension=="JPG" or $photo_extension=="jpeg" or $photo_extension=="JPEG"){
												$photo_file_name=$user_name."_photo_".uniqid(True);
												$photo_new_adress="../uploads/profile_photos/admins/".$photo_file_name.".".$photo_extension;
												if(move_uploaded_file($_FILES["photo"]["tmp_name"],$photo_new_adress)){
													$photo=$photo_file_name.".".$photo_extension;
												}else{
													$hata=0;
													message("warning","exclamation-triangle","Dikkat!","Profil fotoğrafı yüklenemedi.");
												}
											}else{
												$hata=0;
												message("warning","exclamation-triangle","Dikkat!","Lütfen belirtilen uzantılara ( png, jpeg, jpg ) uygun profil fotoğrafı ekleyiniz.");
											}
										}else{
											if($gender==0){
												$photo="Mrs_profile_photo.png";
											}else{
												$photo="Mr_profile_photo.png";
											}
										}
										if($hata){
											if($password == $active_query_user["password"]){
												$query=mysqli_query($con, "INSERT INTO admin_users SET name_surname='$name_surname', user_name='$user_name', birthday='$birthday', email='$email', phone_number='$phone_number', web_site='$web_site', facebook='$facebook', twitter='$twitter', linkedin='$linkedin', instagram='$instagram', pinterest='$pinterest', gender='$gender', photo='$photo', password='$user_password', status='$status', authorization_id=$authorization");
												if($query){
													system_archives($con, "$user_name admin paneli üyesi eklendi", "Admin Üyesi Eklendi", $active_user_id);
													message("success","check","Başarılı","Üye başarılı bir şekilde eklendi");
													_header("admin_user_transactions");
												}else{
													message("warning","exclamation-triangle","Dikkat!","Üye eklenemedi. Lütfen tekrar deneyiniz");
												}
											}else{
												$pass_result=0;
												message("warning","exclamation-triangle","Dikkat!","Şifrenizi yanlış girdiniz.");
											}
										}
									}else{
										message("warning","exclamation-triangle","Dikkat!","$email e-posta adresini kullanan başka bir üyeniz mevcut. Lütfen başka bir e-posta adresi ile tekrar deneyiniz.");
									}
								}else{
									message("warning","exclamation-triangle","Dikkat!","$user_name kullanıcı adını kullanan başka bir üyeniz mevcut. Lütfen başka bir kullanıcı adı ile tekrar deneyiniz.");
								}
							}else{
								message("warning","exclamation-triangle","Dikkat!","Lütfen kullanıcı adında türkçe karakterler kullanmayınız (  ğ,  Ğ,  ç,  Ç,  ş,  Ş,  ü,  Ü,  ö,  Ö,  ı,  İ  )");
							}
						}
					?>
					<div class="card card-info">
						<div class="card-header text-center"><h3 class="card-title float-none">Yeni admin üye ekleme</h3></div>
						<div class="mt-3 mr-3"><span class="float-right">Zorunlu olarak doldurulması gereken alanlar kırmızıyla işaretlenmiştir.</span></div>
						<form method="post" enctype="multipart/form-data">
							<div class="card-body">
								<div class="row">
									<div class="form-group col-md-6">
										<label class="mandatory_field">Adı</label>
										<input type="text" class="form-control form-control-border border-width-2" name="name" placeholder="Üye adı..." title="Üye adını giriniz" value="<?php if($_POST){ echo $name; } ?>" required>
									</div>
									<div class="form-group col-md-6">
										<label class="mandatory_field">Soyadı</label>
										<input type="text" class="form-control form-control-border border-width-2" name="surname" placeholder="Üye soyadı..." title="Üye soyadını giriniz" value="<?php if($_POST){ echo $surname; } ?>" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label class="mandatory_field">Kullanıcı adı</label><span> Lütfen türkçe karakter kullanmayınız (  ğ - Ğ - ç - Ç - ş - Ş - ü - Ü - ö - Ö - ı - İ  )</span>
										<input type="text" class="form-control form-control-border border-width-2 <?php if($_POST){ if($turkish or $user_name_control){ echo 'is-invalid'; } } ?>" id="inputError" name="user_name" placeholder="Kullanıcı adı..." title="Kullanıcı adını giriniz" value="<?php if($_POST){ echo $user_name; } ?>" required>
									</div>
									<div class="form-group col-md-6">
										<label class="mandatory_field">Doğum tarihi</label>
										<input type="date" class="form-control form-control-border border-width-2" name="birthday" placeholder="Doğum tarihi..." title="Doğum tarihini seçiniz" value="<?php if($_POST){ echo $birthday; } ?>" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label class="mandatory_field">Telefon numarası</label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fas fa-phone"></i></span></div>
											<input type="tel" class="form-control form-control-border border-width-2" name="phone_number" title="Telefon numarasını giriniz" data-inputmask='"mask": "(999) 999-9999"' data-mask placeholder="Telefon numarası..." value="<?php if($_POST){ echo $phone_number; } ?>" required>
										</div>
									</div>
									<div class="form-group col-md-6">
										<label class="mandatory_field">E-mail adresi</label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fas fa-envelope"></i></span></div>
											<input type="email" class="form-control form-control-border border-width-2 <?php if($_POST){ if($email_control){ echo 'is-invalid'; } } ?>" id="inputError" name="email" placeholder="E-mail adresi..." title="E-mail adresini giriniz" value="<?php if($_POST){ echo $email; } ?>" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Web site adresi</label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fas fa-globe"></i></span></div>
											<input type="url" class="form-control form-control-border border-width-2" name="web_site" placeholder="Web site adresi..." title="Web site adresini giriniz" value="<?php if($_POST){ echo $web_site; } ?>">
										</div>
									</div>
									<div class="form-group col-md-6">
										<label>Facebook adresi</label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-facebook-f"></i></span></div>
											<input type="url" class="form-control form-control-border border-width-2" name="facebook" placeholder="Facebook adresi..." title="Facebook adresini giriniz" value="<?php if($_POST){ echo $facebook; } ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>İnstagram adresi</label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-instagram"></i></span></div>
											<input type="url" class="form-control form-control-border border-width-2" name="instagram" placeholder="İnstagram adresi..." title="İnstagram adresini giriniz" value="<?php if($_POST){ echo $instagram; } ?>">
										</div>
									</div>
									<div class="form-group col-md-6">
										<label>Linkedin adresi</label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-linkedin-in"></i></span></div>
											<input type="url" class="form-control form-control-border border-width-2" name="linkedin" placeholder="Linkedin adresi..." title="Linkedin adresini giriniz" value="<?php if($_POST){ echo $linkedin; } ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Pinterest adresi</label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-pinterest"></i></span></div>
											<input type="url" class="form-control form-control-border border-width-2" name="pinterest" placeholder="Pinterest adresi..." title="Pinterest adresini giriniz" value="<?php if($_POST){ echo $pinterest; } ?>">
										</div>
									</div>
									<div class="form-group col-md-6">
										<label>Twitter adresi</label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-twitter"></i></span></div>
											<input type="url" class="form-control form-control-border border-width-2" name="twitter" placeholder="Twitter adresi..." title="Twitter adresini giriniz" value="<?php if($_POST){ echo $twitter; } ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label class="mandatory_field">Cinsiyet</label>
										<select class="form-control form-control-border border-width-2" name="gender">
											<option value="0" <?php if($_POST){ if($gender==0){ echo "selected"; } } ?> >Bayan</option>
											<option value="1" <?php if($_POST){ if($gender==1){ echo "selected"; } } ?> >Bay</option>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label class="mandatory_field">Durum</label>
										<select class="form-control form-control-border border-width-2" name="status">
											<option value="0" <?php if($_POST){ if($status==0){ echo "selected"; } } ?> >Onaylı değil</option>
											<option value="1" <?php if($_POST){ if($status==1){ echo "selected"; } } ?> >Onaylı</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Profil fotoğrafı</label><span class="text-muted"> ( Kabul edilen uzantılar : jpg - png - jpeg )</span>
										<div class="input-group"><div class="custom-file"><input type="file" name="photo" class="custom-file-input"><label class="custom-file-label">Dosya seçin...</label></div></div>
									</div>
									<div class="form-group col-md-6">
										<label class="mandatory_field">Yetki</label>
										<select class="form-control form-control-border border-width-2" name="authorization">
											<?php 
												$authorization_query=mysqli_query($con, "SELECT * FROM user_authorization");
												while($authorization_row=mysqli_fetch_array($authorization_query)){ 
													if($authorization_row["authorization_id"]!=1){
														?>
														<option value="<?php echo $authorization_row["authorization_id"]; ?>" <?php if($_POST){ if($authorization==$authorization_row["authorization_id"]){ echo "selected"; } } ?> ><?php echo $authorization_row["name"]; ?></option>
											<?php } } ?>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label>Şifre</label>
									<input type="text" class="form-control form-control-border border-width-2" name="user_password" title="Şifre" value="<?php echo password(8); ?>" readonly>
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
