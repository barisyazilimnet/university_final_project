<div class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-md-12 text-center">
		<h1 class="m-0">Üye işlemleri</h1>
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
						$id=$_GET["id"];
						if($id!=1){
							$admin_users_query=mysqli_fetch_array(mysqli_query($con, "SELECT admin_users.*, user_authorization.name, user_authorization.authorization_color FROM admin_users INNER JOIN user_authorization ON admin_users.authorization_id=user_authorization.authorization_id WHERE admin_users.user_id='$id'"));
							$name_surname=explode(" ",$admin_users_query["name_surname"]); // veritabanından gelen adı ve soyadını parçalara ayırır ve dizi şeklimnde degişkene atar
							$surname=array_reverse($name_surname)[0]; //diziyi ters çevirir ve ilk elemanını degişkene atar
							array_pop($name_surname); //dizinin son elemanını siler
							$name=implode(" ",$name_surname); //dizideki kalan elemanları aralarında boşluk olucak şekilde birleştirerek degişkene atar
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
								$status=$_POST["status"];
								$authorization=$_POST["authorization"];
								$password=md5($_POST["password"]);
								$turkish_characters=array("ğ", "Ğ", "ç", "Ç", "ş", "Ş", "ü", "Ü", "ö", "Ö", "ı", "İ");
								foreach($turkish_characters as $value){
									$turkish=strstr($user_name, $value);
								}
								if($turkish==False){
									if(is_uploaded_file($_FILES["photo"]["tmp_name"])){
										$photo=pathinfo($_FILES["photo"]["name"]);
										$photo_extension=$photo["extension"];
										if($photo_extension=="png" or $photo_extension=="PNG" or $photo_extension=="jpg" or $photo_extension=="JPG" or $photo_extension=="jpeg" or $photo_extension=="JPEG"){
											$photo_file_name=$user_name."_photo_".uniqid(True);
											$photo_new_adress="../uploads/profile_photos/admins/".$photo_file_name.".".$photo_extension;
											if(move_uploaded_file($_FILES["photo"]["tmp_name"],$photo_new_adress)){
												if($admin_users_query["photo"]!="Mrs_profile_photo.png" or $admin_users_query["photo"]!="Mr_profile_photo.png"){
													unlink("../uploads/profile_photos/admins/".$admin_users_query["photo"]);
												}
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
										$photo=$admin_users_query["photo"];
									}
									if($hata){
										if($password == $active_query_user["password"]){
											$query=mysqli_query($con, "UPDATE admin_users SET name_surname='$name_surname', user_name='$user_name', birthday='$birthday', email='$email', phone_number='$phone_number', web_site='$web_site', facebook='$facebook', twitter='$twitter', linkedin='$linkedin', instagram='$instagram', pinterest='$pinterest', gender='$gender', photo='$photo', status='$status', authorization_id='$authorization' WHERE user_id='$id'");
											if($query){
												system_archives($con, "$user_name admin paneli üyesi başarıyla güncellendi", "Admin Üyesi Güncellendi", $active_user_id);
												message("success","check","Başarılı","Üye başarılı bir şekilde güncellendi");
												_header("admin_user_transactions");
											}else{
												message("warning","exclamation-triangle","Dikkat!","Güncelleme yapılamadı. Lütfen tekrar deneyiniz");
											}
										}else{
											$pass_result=0;
											message("warning","exclamation-triangle","Dikkat!","Şifrenizi yanlış girdiniz.");
										}
									}
								}else{
									message("warning","exclamation-triangle","Dikkat!","Lütfen kullanıcı adında türkçe karakterler kullanmayınız (  ğ,  Ğ,  ç,  Ç,  ş,  Ş,  ü,  Ü,  ö,  Ö,  ı,  İ  )");
								}
							}
						?>
					</div>	
					<div class="col-md-2">
						<div class="card card-info card-outline">
							<div class="card-body box-profile">
								<div class="text-center">
									<a target="_blank" href="../uploads/profile_photos/admins/<?php echo $admin_users_query["photo"]; ?>">
										<img class="profile-user-img img-fluid img-circle" style="max-width: initial; width: 200px; height: 200px" src="../uploads/profile_photos/admins/<?php echo $admin_users_query["photo"]; ?>" alt="User profile picture">
									</a>
								</div>
								<h3 class="profile-username text-center"><?php echo $admin_users_query["user_name"]; ?></h3>
								<p class="text-muted text-center"><?php echo $admin_users_query["name_surname"]; ?></p>
								<p class="text-muted text-center"><?php echo date_format(date_create($admin_users_query["birthday"]),'d.m.Y'); ?></p>
								<p class="text-muted text-center"><?php echo $admin_users_query["phone_number"]; ?></p>
								<p class="text-muted text-center"><?php echo $admin_users_query["email"]; ?></p>
								<p class="text-center" 
								   <?php if(empty($admin_users_query["web_site"]) and empty($admin_users_query["facebook"]) and empty($admin_users_query["instagram"]) and empty($admin_users_query["twitter"]) and empty($admin_users_query["linkedin"]) and empty($admin_users_query["pinterest"])){ echo"hidden"; } ?>>
									<a target="_blank" href="<?php echo $admin_users_query["web_site"]; ?>" <?php if(empty($admin_users_query["web_site"])){ echo"hidden"; } ?>>
										<i class="fas fa-globe"></i>
									</a>&nbsp;
									<a target="_blank" href="<?php echo $admin_users_query['facebook']; ?>" <?php if(empty($admin_users_query["facebook"])){ echo"hidden"; } ?>>
										<i class="fab fa-facebook-square"></i>
									</a>&nbsp;
									<a target="_blank" href="<?php echo $admin_users_query['instagram']; ?>" <?php if(empty($admin_users_query["instagram"])){ echo"hidden"; } ?>>
										<i class="fab fa-instagram-square"></i>
									</a>&nbsp;
									<a target="_blank" href="<?php echo $admin_users_query['twitter']; ?>" <?php if(empty($admin_users_query["twitter"])){ echo"hidden"; } ?>>
										<i class="fab fa-twitter-square"></i>
									</a>&nbsp;
									<a target="_blank" href="<?php echo $admin_users_query['linkedin']; ?>" <?php if(empty($admin_users_query["linkedin"])){ echo"hidden"; } ?>>
										<i class="fab fa-linkedin"></i>
									</a>&nbsp;
									<a target="_blank" href="<?php echo $admin_users_query['pinterest']; ?>" <?php if(empty($admin_users_query["pinterest"])){ echo"hidden"; } ?>>
										<i class="fab fa-pinterest-square"></i>
									</a>
								</p>
								<p class="text-center">
									<?php
										$authorization_name=$admin_users_query["name"];
										$authorization_color=$admin_users_query["authorization_color"];
										if($admin_users_query["gender"] == 1){
											echo"<span class='badge badge-pill badge-info m-1'>Bay</span>";
										}else{
											echo"<span class='badge badge-pill badge-danger m-1'>Bayan</span>";
										}
										echo "<span class='badge badge-pill badge-$authorization_color'>$authorization_name</span>";
										if($admin_users_query["status"] == 1){
											echo"<span class='badge badge-pill badge-success m-1'>Onaylı</span>";
										}else{
											echo"<span class='badge badge-pill badge-danger m-1'>Onaylı değil</span>";
										}
									?>
								</p>
								<p class="text-center"><?php echo $admin_users_query["registration_date"]; ?></p>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
					<!-- /.col -->
					<div class="col-md-10">
						<div class="card card-info">
							<div class="card-header text-center"><h3 class="card-title float-none">Bilgileri Güncelle</h3></div>
							<div class="mt-3 mr-3"><span class="float-right">Zorunlu olarak doldurulması gereken alanlar kırmızıyla işaretlenmiştir.</span></div>
							<form method="post" enctype="multipart/form-data">
								<div class="card-body">
									<div class="row">
										<div class="form-group col-md-6">
											<label class="mandatory_field">Adı</label>
											<input type="text" class="form-control form-control-border border-width-2" name="name" placeholder="Adı..." title="Üye adını giriniz" value="<?php if($_POST){ echo $name; }else{ echo $name; } ?>" required>
										</div>
										<div class="form-group col-md-6">
											<label class="mandatory_field">Soyadı</label>
											<input type="text" class="form-control form-control-border border-width-2" name="surname" placeholder="Soyadı..." title="Üye soyadınızı giriniz" value="<?php if($_POST){ echo $surname; }else{ echo $surname; } ?>" required>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-6">
											<label class="mandatory_field">Kullanıcı adı</label><span> Lütfen türkçe karakter kullanmayınız (  ğ - Ğ - ç - Ç - ş - Ş - ü - Ü - ö - Ö - ı - İ  )</span>
											<input type="text" class="form-control form-control-border border-width-2 <?php if($_POST){ if($turkish){ echo 'is-invalid'; } } ?>" id="inputError" name="user_name" placeholder="Kullanıcı adı..." title="Üye kullanıcı adını giriniz" value="<?php if($_POST){ echo $user_name; }else{ echo $admin_users_query["user_name"]; } ?>" required>
										</div>
										<div class="form-group col-md-6">
											<label class="mandatory_field">Doğum tarihi</label>
											<input type="date" class="form-control form-control-border border-width-2" name="birthday" placeholder="Doğum tarihi..." title="Üye doğum tarihini seçiniz" value="<?php if($_POST){ echo $birthday; }else{ echo $admin_users_query["birthday"]; } ?>" required>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-6">
											<label class="mandatory_field">Telefon numarası</label>
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fas fa-phone"></i></span></div>
												<input type="tel" class="form-control form-control-border border-width-2" name="phone_number" title="Üye telefon numarasını giriniz" data-inputmask='"mask": "(999) 999-9999"' data-mask placeholder="Telefon numarası..." value="<?php if($_POST){ echo $phone_number; }else{ echo $admin_users_query["phone_number"]; } ?>" required>
											</div>
										</div>
										<div class="form-group col-md-6">
											<label class="mandatory_field">E-mail adresi</label>
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fas fa-envelope"></i></span></div>
												<input type="email" class="form-control form-control-border border-width-2" name="email" placeholder="E-mail adresi..." title="Üye e-mail adresini giriniz" value="<?php if($_POST){ echo $email; }else{ echo $admin_users_query["email"]; } ?>" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-6">
											<label>Web site adresi</label>
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fas fa-globe"></i></span></div>
												<input type="url" class="form-control form-control-border border-width-2" name="web_site" placeholder="Web site adresi..." title="Üye web site adresini giriniz" value="<?php if($_POST){ echo $web_site; }else{ echo $admin_users_query["web_site"]; } ?>">
											</div>
										</div>
										<div class="form-group col-md-6">
											<label>Facebook adresi</label>
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-facebook-f"></i></span></div>
												<input type="url" class="form-control form-control-border border-width-2" name="facebook" placeholder="Facebook adresi..." title="Üye facebook adresini giriniz" value="<?php if($_POST){ echo $facebook; }else{ echo $admin_users_query["facebook"]; } ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-6">
											<label>İnstagram adresi</label>
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-instagram"></i></span></div>
												<input type="url" class="form-control form-control-border border-width-2" name="instagram" placeholder="İnstagram adresi..." title="Üye instagram adresini giriniz" value="<?php if($_POST){ echo $instagram; }else{ echo $admin_users_query["instagram"]; } ?>">
											</div>
										</div>
										<div class="form-group col-md-6">
											<label>Linkedin adresi</label>
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-linkedin-in"></i></span></div>
												<input type="url" class="form-control form-control-border border-width-2" name="linkedin" placeholder="Linkedin adresi..." title="Üye linkedin adresini giriniz" value="<?php if($_POST){ echo $linkedin; }else{ echo $admin_users_query["linkedin"]; } ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-6">
											<label>Pinterest adresi</label>
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-pinterest"></i></span></div>
												<input type="url" class="form-control form-control-border border-width-2" name="pinterest" placeholder="Pinterest adresi..." title="Üye pinterest adresini giriniz" value="<?php if($_POST){ echo $pinterest; }else{ echo $admin_users_query["pinterest"]; } ?>">
											</div>
										</div>
										<div class="form-group col-md-6">
											<label>Twitter adresi</label>
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-twitter"></i></span></div>
												<input type="url" class="form-control form-control-border border-width-2" name="twitter" placeholder="Twitter adresi..." title="Üye twitter adresini giriniz" value="<?php if($_POST){ echo $twitter; }else{ echo $admin_users_query["twitter"]; } ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-6">
											<label class="mandatory_field">Cinsiyet</label>
											<select class="form-control form-control-border border-width-2" name="gender">
												<option value="0" <?php if($_POST){ if($gender==0){ echo "selected"; } }else{ if($admin_users_query["gender"]==0){ echo "selected"; } } ?> >Bayan</option>
												<option value="1" <?php if($_POST){ if($gender==1){ echo "selected"; } }else{ if($admin_users_query["gender"]==1){ echo "selected"; } } ?> >Bay</option>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label>Profil fotoğrafı</label><span class="text-muted"> ( Kabul edilen uzantılar : jpg - png - jpeg )</span>
											<div class="input-group"><div class="custom-file"><input type="file" name="photo" class="custom-file-input"><label class="custom-file-label">Dosya seçin...</label></div></div>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-6">
											<label class="mandatory_field">Durum</label>
											<select name="status" class="form-control form-control-border border-width-2">
												<option value="0" <?php if($_POST){ if($status==0){ echo "selected"; } }else{ if($admin_users_query["status"]==0){ echo "selected"; } } ?> >Onaylı değil</option>
												<option value="1" <?php if($_POST){ if($status==1){ echo "selected"; } }else{ if($admin_users_query["status"]==1){ echo "selected"; } } ?> >Onaylı</option>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label class="mandatory_field">Yetki</label>
											<select name="authorization" class="form-control form-control-border border-width-2">
												<?php 
													$authorization_query=mysqli_query($con, "SELECT * FROM user_authorization");
													while($authorization_row=mysqli_fetch_array($authorization_query)){ 
														if($authorization_row["authorization_id"]!=1){
															?>
															<option value="<?php echo $authorization_row["authorization_id"]; ?>" <?php if($_POST){ if($authorization==$authorization_row["authorization_id"]){ echo "selected"; } }else{ if($admin_users_query["authorization_id"]==$authorization_row["authorization_id"]){ echo "selected"; } } ?> ><?php echo $authorization_row["name"]; ?></option>
												<?php } } ?>
											</select>
										</div>
									</div>
									<div class="form-group text-center">
										<label class="mandatory_field">Şifreniz</label><span class="text-muted"> ( İşlemi tamamlayabilmek için şifrenizi girmeniz gerekmektedir. )</span>
										<input type="password" class="form-control form-control-border border-width-2 <?php input_control($_POST, $pass_result); ?>" id="inputError" name="password" minlength="8" title="İşlemi tamamlayabilmek için kendi şifrenizi giriniz" placeholder="Şifreniz...">
									</div>
								</div>
								<div class="card-footer"><button type="submit" class="btn btn-info float-right">Güncelle</button></div>
							</form>
						</div>
					</div>
					<div>
				<?php
					}else{
						message("danger","ban","Dikkat!","Bu kullanıcı düzenlenemez. Lütfen bekleyiniz üye işlemleri sayfasına yönlendirliyorsunuz");
						_header("admin_user_transactions");
					}
				}else{
					message("danger","ban","Dikkat!","Buraya girmeye yetkiniz yoktur. Lütfen bekleyiniz anasayfaya yönlendirliyorsunuz");
					_header("");
				}
			?>
			</div>
		</div>
	</div>
</div>