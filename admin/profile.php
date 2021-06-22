<div class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-md-12 text-center">
		<h1 class="m-0">Profilim</h1>
	  </div><!-- /.col -->
	</div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php
					$name_surname=explode(" ",$active_query_user["name_surname"]); // veritabanından gelen adı ve soyadını parçalara ayırır ve dizi şeklimnde degişkene atar
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
										if($active_query_user["photo"]){
											unlink("../uploads/profile_photos/admins/".$active_query_user["photo"]);
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
								$photo=$active_query_user["photo"];
							}
							if($hata){
								if($password == $active_query_user["password"]){
									$query=mysqli_query($con, "UPDATE admin_users SET name_surname='$name_surname', user_name='$user_name', birthday='$birthday', email='$email', phone_number='$phone_number', web_site='$web_site', facebook='$facebook', twitter='$twitter', linkedin='$linkedin', instagram='$instagram', pinterest='$pinterest', gender='$gender', photo='$photo' WHERE user_id='$active_user_id'");
									if($query){
										system_archives($con, "Profil bilgileri güncellendi", "Profil Güncellendi", $active_user_id);
										message("success","check","Başarılı","Profiliniz başarılı bir şekilde güncellendi");
										_header("profile");
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
							<a target="_blank" href="../uploads/profile_photos/admins/<?php echo $active_query_user["photo"]; ?>">
								<img class="profile-user-img img-fluid img-circle" style="max-width: initial; width: 200px; height: 200px" src="../uploads/profile_photos/admins/<?php echo $active_query_user["photo"]; ?>" alt="User profile picture">
							</a>
						</div>
						<h3 class="profile-username text-center"><?php echo $active_query_user["user_name"]; ?></h3>
						<p class="text-muted text-center"><?php echo $active_query_user["name_surname"]; ?></p>
						<p class="text-muted text-center"><?php echo date_format(date_create($active_query_user["birthday"]),'d.m.Y'); ?></p>
						<p class="text-muted text-center"><?php echo $active_query_user["phone_number"]; ?></p>
						<p class="text-muted text-center"><?php echo $active_query_user["email"]; ?></p>
						<p class="text-center" 
						   <?php if(empty($active_query_user["web_site"]) and empty($active_query_user["facebook"]) and empty($active_query_user["instagram"]) and empty($active_query_user["twitter"]) and empty($active_query_user["linkedin"]) and empty($active_query_user["pinterest"])){ echo"hidden"; } ?>>
							<a target="_blank" href="<?php echo $active_query_user["web_site"]; ?>" <?php if(empty($active_query_user["web_site"])){ echo"hidden"; } ?>>
								<i class="fas fa-globe"></i>
							</a>&nbsp;
							<a target="_blank" href="<?php echo $active_query_user['facebook']; ?>" <?php if(empty($active_query_user["facebook"])){ echo"hidden"; } ?>>
								<i class="fab fa-facebook-square"></i>
							</a>&nbsp;
							<a target="_blank" href="<?php echo $active_query_user['instagram']; ?>" <?php if(empty($active_query_user["instagram"])){ echo"hidden"; } ?>>
								<i class="fab fa-instagram-square"></i>
							</a>&nbsp;
							<a target="_blank" href="<?php echo $active_query_user['twitter']; ?>" <?php if(empty($active_query_user["twitter"])){ echo"hidden"; } ?>>
								<i class="fab fa-twitter-square"></i>
							</a>&nbsp;
							<a target="_blank" href="<?php echo $active_query_user['linkedin']; ?>" <?php if(empty($active_query_user["linkedin"])){ echo"hidden"; } ?>>
								<i class="fab fa-linkedin"></i>
							</a>&nbsp;
							<a target="_blank" href="<?php echo $active_query_user['pinterest']; ?>" <?php if(empty($active_query_user["pinterest"])){ echo"hidden"; } ?>>
								<i class="fab fa-pinterest-square"></i>
							</a>
						</p>
                        <p class="text-center">
                            <?php
								$authorization_name=$active_query_user["name"];
								$authorization_color=$active_query_user["authorization_color"];
                                if($active_query_user["gender"] == 1){
                                    echo"<span class='badge badge-pill badge-info m-1'>Bay</span>";
                                }else{
                                    echo"<span class='badge badge-pill badge-danger m-1'>Bayan</span>";
                                }
								echo "<span class='badge badge-pill badge-$authorization_color'>$authorization_name</span>";
                                if($active_query_user["status"] == 1){
                                    echo"<span class='badge badge-pill badge-success m-1'>Onaylı</span>";
                                }else{
                                    echo"<span class='badge badge-pill badge-danger m-1'>Onaylı değil</span>";
                                }
                            ?>
                        </p>
                        <p class="text-center"><?php echo date_format(date_create($active_query_user["registration_date"]),'H:i:s d.m.Y'); ?></p>
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
									<label class="mandatory_field">Adınız</label>
									<input type="text" class="form-control form-control-border border-width-2" name="name" placeholder="Adınız..." title="Adınızı giriniz" value="<?php if($_POST){ echo $name; }else{ echo $name; } ?>" required>
								</div>
								<div class="form-group col-md-6">
									<label class="mandatory_field">Soyadınız</label>
									<input type="text" class="form-control form-control-border border-width-2" name="surname" placeholder="Soyadınız..." title="Soyadınızı giriniz" value="<?php if($_POST){ echo $surname; }else{ echo $surname; } ?>" required>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label class="mandatory_field">Kullanıcı adı</label><span> Lütfen türkçe karakter kullanmayınız (  ğ - Ğ - ç - Ç - ş - Ş - ü - Ü - ö - Ö - ı - İ  )</span>
									<input type="text" class="form-control form-control-border border-width-2 <?php if($_POST){ if($turkish){ echo 'is-invalid'; } } ?>" id="inputError" name="user_name" placeholder="Kullanıcı adı..." title="Kullanıcı adınızı giriniz" value="<?php if($_POST){ echo $user_name; }else{ echo $active_query_user["user_name"]; } ?>" required>
								</div>
								<div class="form-group col-md-6">
									<label class="mandatory_field">Doğum tarihi</label>
									<input type="date" class="form-control form-control-border border-width-2" name="birthday" placeholder="Doğum tarihi..." title="Doğum tarihinizi seçiniz" value="<?php if($_POST){ echo $birthday; }else{ echo $active_query_user["birthday"]; } ?>" required>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label class="mandatory_field">Telefon numarası</label>
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fas fa-phone"></i></span></div>
										<input type="tel" class="form-control form-control-border border-width-2" name="phone_number" title="Telefon numaranızı giriniz" data-inputmask='"mask": "(999) 999-9999"' data-mask placeholder="Telefon numarası..." value="<?php if($_POST){ echo $phone_number; }else{ echo $active_query_user["phone_number"]; } ?>" required>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="mandatory_field">E-mail adresiniz</label>
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fas fa-envelope"></i></span></div>
										<input type="email" class="form-control form-control-border border-width-2" name="email" placeholder="E-mail adresiniz..." title="E-mail adresinizi giriniz" value="<?php if($_POST){ echo $email; }else{ echo $active_query_user["email"]; } ?>" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label>Web site adresi</label>
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fas fa-globe"></i></span></div>
										<input type="url" class="form-control form-control-border border-width-2" name="web_site" placeholder="Web site adresi..." title="Web site adresinizi giriniz" value="<?php if($_POST){ echo $web_site; }else{ echo $active_query_user["web_site"]; } ?>">
									</div>
								</div>
								<div class="form-group col-md-6">
									<label>Facebook adresi</label>
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-facebook-f"></i></span></div>
										<input type="url" class="form-control form-control-border border-width-2" name="facebook" placeholder="Facebook adresi..." title="Facebook adresinizi giriniz" value="<?php if($_POST){ echo $facebook; }else{ echo $active_query_user["facebook"]; } ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label>İnstagram adresi</label>
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-instagram"></i></span></div>
										<input type="url" class="form-control form-control-border border-width-2" name="instagram" placeholder="İnstagram adresi..." title="İnstagram adresinizi giriniz" value="<?php if($_POST){ echo $instagram; }else{ echo $active_query_user["instagram"]; } ?>">
									</div>
								</div>
								<div class="form-group col-md-6">
									<label>Linkedin adresi</label>
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-linkedin-in"></i></span></div>
										<input type="url" class="form-control form-control-border border-width-2" name="linkedin" placeholder="Linkedin adresi..." title="Linkedin adresinizi giriniz" value="<?php if($_POST){ echo $linkedin; }else{ echo $active_query_user["linkedin"]; } ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label>Pinterest adresi</label>
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-pinterest"></i></span></div>
										<input type="url" class="form-control form-control-border border-width-2" name="pinterest" placeholder="Pinterest adresi..." title="Pinterest adresinizi giriniz" value="<?php if($_POST){ echo $pinterest; }else{ echo $active_query_user["pinterest"]; } ?>">
									</div>
								</div>
								<div class="form-group col-md-6">
									<label>Twitter adresi</label>
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-twitter"></i></span></div>
										<input type="url" class="form-control form-control-border border-width-2" name="twitter" placeholder="Twitter adresi..." title="Twitter adresinizi giriniz" value="<?php if($_POST){ echo $twitter; }else{ echo $active_query_user["twitter"]; } ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label class="mandatory_field">Cinsiyet</label>
									<select class="form-control form-control-border border-width-2" name="gender">
										<option value="0" <?php if($_POST){ if($gender==0){ echo "selected"; } }else{ if($active_query_user["gender"]==0){ echo "selected"; } } ?> >Bayan</option>
										<option value="1" <?php if($_POST){ if($gender==1){ echo "selected"; } }else{ if($active_query_user["gender"]==1){ echo "selected"; } } ?> >Bay</option>
									</select>
								</div>
								<div class="form-group col-md-6">
									<label>Profil fotoğrafı</label><span class="text-muted"> ( Kabul edilen uzantılar : jpg - png - jpeg )</span>
									<div class="input-group"><div class="custom-file"><input type="file" name="photo" class="custom-file-input"><label class="custom-file-label">Dosya seçin...</label></div></div>
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
		</div>
	</div>
</div>
