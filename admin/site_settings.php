<div class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-md-12 text-center">
		<h1 class="m-0">Site ayarları</h1>
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
						if($_POST){
							$url=trim($_POST["url"]);
							$title=trim(mb_convert_case($_POST["title"], MB_CASE_TITLE, "utf-8"));
							$keywords=trim(mb_convert_case($_POST["keywords"], MB_CASE_TITLE, "utf-8"));
							$description=trim(mb_convert_case($_POST["description"], MB_CASE_TITLE, "utf-8"));
							$status=$_POST["status"];
							$theme=$_POST["theme"];
							$phone_number=$_POST["phone_number"];
							$email=trim($_POST["email"]);
							$facebook=trim($_POST["facebook"]);
							$twitter=trim($_POST["twitter"]);
							$linkedin=trim($_POST["linkedin"]);
							$instagram=trim($_POST["instagram"]);
							$pinterest=trim($_POST["pinterest"]);
							$address=trim($_POST["address"]);
							$password=trim(md5($_POST["password"]));
							if(is_uploaded_file($_FILES["icon"]["tmp_name"])){
								$icon=pathinfo($_FILES["icon"]["name"]);
								$icon_extension=$icon["extension"];
								if($icon_extension=="png" or $icon_extension=="PNG" or $icon_extension=="jpg" or $icon_extension=="JPG" or $icon_extension=="jpeg" or $icon_extension=="JPEG"){
									$icon_file_name="icon_".uniqid(True);
									$icon_new_adress="../uploads/site/".$icon_file_name.".".$icon_extension;
									if(move_uploaded_file($_FILES["icon"]["tmp_name"],$icon_new_adress)){
										if($query_settings["icon"]){
											unlink("../uploads/site/".$query_settings["icon"]);
										}
										$icon=$icon_file_name.".".$icon_extension;
									}else{
										$hata=0;
										message("warning","exclamation-triangle","Dikkat!","Başlık iconu fotoğrafı yüklenemedi.");
									}
								}else{
									$hata=0;
									message("warning","exclamation-triangle","Dikkat!","Lütfen belirtilen uzantılara ( png, jpeg, jpg ) uygun başlık iconu ekleyiniz.");
								}
							}else{
								$icon=$query_settings["icon"];
							}
							if($hata){
								if(is_uploaded_file($_FILES["logo"]["tmp_name"])){
									$logo=pathinfo($_FILES["logo"]["name"]);
									$logo_extension=$logo["extension"];
									if($logo_extension=="png" or $logo_extension=="PNG" or $logo_extension=="jpg" or $logo_extension=="JPG" or $logo_extension=="jpeg" or $logo_extension=="JPEG"){
										$logo_file_name="logo_".uniqid(True);
										$logo_new_adress="../uploads/site/".$logo_file_name.".".$logo_extension;
										if(move_uploaded_file($_FILES["logo"]["tmp_name"],$logo_new_adress)){
											if($query_settings["logo"]){
												unlink("../uploads/site/".$query_settings["logo"]);
											}
											$logo=$logo_file_name.".".$logo_extension;
										}else{
											$hata=0;
											message("warning","exclamation-triangle","Dikkat!","Site logosu yüklenemedi.");
										}
									}else{
										$hata=0;
										message("warning","exclamation-triangle","Dikkat!","Lütfen belirtilen uzantılara ( png, jpeg, jpg ) uygun site logosu ekleyiniz.");
									}
								}else{
									$logo=$query_settings["logo"];
								}
								if($hata){
									if(is_uploaded_file($_FILES["admin_logo"]["tmp_name"])){
										$admin_logo=pathinfo($_FILES["admin_logo"]["name"]);
										$admin_logo_extension=$admin_logo["extension"];
										if($admin_logo_extension=="png" or $admin_logo_extension=="PNG" or $admin_logo_extension=="jpg" or $admin_logo_extension=="JPG" or $admin_logo_extension=="jpeg" or $admin_logo_extension=="JPEG"){
											$admin_logo_file_name="admin_logo_".uniqid(True);
											$admin_logo_new_adress="../uploads/site/".$admin_logo_file_name.".".$admin_logo_extension;
											if(move_uploaded_file($_FILES["admin_logo"]["tmp_name"],$admin_logo_new_adress)){
												if($query_settings["admin_logo"]){
													unlink("../uploads/site/".$query_settings["admin_logo"]);
												}
												$admin_logo=$admin_logo_file_name.".".$admin_logo_extension;
											}else{
												$hata=0;
												message("warning","exclamation-triangle","Dikkat!","Admin panel logosu yüklenemedi.");
											}
										}else{
											$hata=0;
											message("warning","exclamation-triangle","Dikkat!","Lütfen belirtilen uzantılara ( png, jpeg, jpg ) uygun admin panel logosu ekleyiniz.");
										}
									}else{
										$admin_logo=$query_settings["admin_logo"];
									}
									if($hata){
										if(is_uploaded_file($_FILES["login_background"]["tmp_name"])){
											$login_background=pathinfo($_FILES["login_background"]["name"]);
											$login_background_extension=$login_background["extension"];
											if($login_background_extension=="png" or $login_background_extension=="PNG" or $login_background_extension=="jpg" or $login_background_extension=="JPG" or $login_background_extension=="jpeg" or $login_background_extension=="JPEG"){
												$login_background_file_name="login_background_".uniqid(True);
												$login_background_new_adress="../uploads/site/".$login_background_file_name.".".$login_background_extension;
												if(move_uploaded_file($_FILES["login_background"]["tmp_name"],$login_background_new_adress)){
													if($query_settings["login_background"]){
														unlink("../uploads/site/".$query_settings["login_background"]);
													}
													$login_background=$login_background_file_name.".".$login_background_extension;
												}else{
													$hata=0;
													message("warning","exclamation-triangle","Dikkat!","Üye giriş bölümü arkaplan fotoğrafı  yüklenemedi.");
												}
											}else{
												$hata=0;
												message("warning","exclamation-triangle","Dikkat!","Lütfen belirtilen uzantılara ( png, jpeg, jpg ) uygun üye giriş bölümü arkaplan fotoğrafı ekleyiniz.");
											}
										}else{
											$login_background=$query_settings["login_background"];
										}
										if($hata){
											if($password == $active_query_user["password"]){
												$datetime=date('d.m.Y H:i:s', time()+60*60);
												$query=mysqli_query($con, "UPDATE settings SET url='$url', title='$title', keywords='$keywords', description='$description', status='$status', theme='$theme', phone_number='$phone_number', email='$email', facebook='$facebook', twitter='$twitter', linkedin='$linkedin', instagram='$instagram', pinterest='$pinterest', icon='$icon', logo='$logo', admin_logo='$admin_logo', login_background='$login_background', address='$address', datetime='$datetime', user_id='$active_user_id'");
												if($query){
													system_archives($con, "Site ayarları güncellendi", "Site Ayarları Güncellendi", $active_user_id);
													message("success","check","Başarılı","Site ayarları başarılı bir şekilde güncellendi");
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
								}
							}
						}
					?>
					<div class="card card-info">
					<div class="card-header text-center"><h3 class="card-title float-none">Site ayarları</h3></div>
						<div class="mt-3 mr-3">
							<span class="float-right">Zorunlu olarak doldurulması gereken alanlar kırmızıyla işaretlenmiştir.</span><br />
							<span class="float-right">En son güncellenme zamanı : <?php echo $query_settings["datetime"]; ?></span><br />
							<span class="float-right">En son güncelleyen kişi : <?php echo $query_settings["user_name"]; ?></span>
						</div>
						<form method="post" enctype="multipart/form-data">
							<div class="card-body">
								<div class="row">
									<div class="form-group col-md-6">
										<label class="mandatory_field">URL</label>
										<input type="text" class="form-control form-control-border border-width-2" name="url" placeholder="URL..." title="Site linkini giriniz" value="<?php if($_POST){ echo $url; }else{ echo $query_settings["url"]; } ?>" required>
									</div>
									<div class="form-group col-md-6">
										<label class="mandatory_field">Başlık</label>
										<input type="text" class="form-control form-control-border border-width-2" name="title" placeholder="Başlık..." title="Site başlık ismini giriniz" value="<?php if($_POST){ echo $title; }else{ echo $query_settings["title"]; } ?>" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label class="mandatory_field">Açıklama</label>
										<input type="text" class="form-control form-control-border border-width-2" name="description" placeholder="Açıklama..." title="Site açıklamasını giriniz" value="<?php if($_POST){ echo $description; }else{ echo $query_settings["description"]; } ?>" required>
									</div>
									<div class="form-group col-md-6">
										<label class="mandatory_field">Anahtar kelimeler</label><span class="text-muted"> ( Lütfen her kelime arasına virgül koyunuz. )</span>
										<input type="text" class="form-control form-control-border border-width-2" name="keywords" placeholder="Anahtar kelimeler..." title="Site anahtar kelimelerini giriniz" value="<?php if($_POST){ echo $keywords; }else{ echo $query_settings["keywords"]; } ?>" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label class="mandatory_field">Telefon numarası</label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fas fa-phone"></i></span></div>
											<input type="tel" class="form-control form-control-border border-width-2" name="phone_number" data-inputmask='"mask": "(999) 999-9999"' title="Site telefon numarasını giriniz" data-mask placeholder="Telefon numarası..." value="<?php if($_POST){ echo $phone_number; }else{ echo $query_settings["phone_number"]; } ?>" required>
										</div>
									</div>
									<div class="form-group col-md-6">
										<label class="mandatory_field">E-mail</label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fas fa-envelope"></i></span></div>
											<input type="email" class="form-control form-control-border border-width-2" name="email" placeholder="E-mail..." title="Site email adresini giriniz" value="<?php if($_POST){ echo $email; }else{ echo $query_settings["email"]; } ?>" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Facebook adresi</label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-facebook-f"></i></span></div>
											<input type="url" class="form-control form-control-border border-width-2" name="facebook" placeholder="Facebook adresi..." title="Site facebook adresini giriniz" value="<?php if($_POST){ echo $facebook; }else{ echo $query_settings["facebook"]; } ?>">
										</div>
									</div>
									<div class="form-group col-md-6">
										<label>İnstagram adresi</label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-instagram"></i></span></div>
											<input type="url" class="form-control form-control-border border-width-2" name="instagram" placeholder="İnstagram adresi..." title="Site instagram adresini giriniz" value="<?php if($_POST){ echo $instagram; }else{ echo $query_settings["instagram"]; } ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Linkedin adresi</label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-linkedin-in"></i></span></div>
											<input type="url" class="form-control form-control-border border-width-2" name="linkedin" placeholder="Linkedin adresi..." title="Site linkedin adresini giriniz" value="<?php if($_POST){ echo $linkedin; }else{ echo $query_settings["linkedin"]; } ?>">
										</div>
									</div>
									<div class="form-group col-md-6">
										<label>Pinterest adresi</label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-pinterest"></i></span></div>
											<input type="url" class="form-control form-control-border border-width-2" name="pinterest" placeholder="Pinterest adresi..." title="Site pinterest adresini giriniz" value="<?php if($_POST){ echo $pinterest; }else{ echo $query_settings["pinterest"]; } ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Twitter adresi</label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" style="border:none !important;"><i class="fab fa-twitter"></i></span></div>
											<input type="url" class="form-control form-control-border border-width-2" name="twitter" placeholder="Twitter adresi..." title="Site twitter adresini giriniz" value="<?php if($_POST){ echo $twitter; }else{ echo $query_settings["twitter"]; } ?>">
										</div>
									</div>
									<div class="form-group col-md-6">
										<label>Adres</label>
										<input type="text" class="form-control form-control-border border-width-2" name="address" placeholder="Adres..." title="Adresinizi giriniz" value="<?php if($_POST){ echo $address; }else{ echo $query_settings["address"]; } ?>">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Site durumu</label>
										<select class="form-control form-control-border border-width-2" name="status">
											<option value="0" <?php if($_POST){ if($status==0){ echo "selected"; } }else{ if($query_settings["status"]==0){ echo "selected"; } } ?> >Kapalı</option>
											<option value="1" <?php if($_POST){ if($status==1){ echo "selected"; } }else{ if($query_settings["status"]==1){ echo "selected"; } } ?> >Açık</option>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label>Site tema</label>
										<select class="form-control form-control-border border-width-2" name="theme">
											<option value="default" <?php if($_POST){ if($theme=="default"){ echo "selected"; } }else{ if($query_settings["theme"]=="default"){ echo "selected"; } } ?> >Default</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Başlık iconu</label><span class="text-muted"> ( Kabul edilen uzantılar : jpg - png - jpeg )</span>
										<div class="input-group"><div class="custom-file"><input type="file" name="icon" title="Site başlık icon görseli ekleyiniz" class="custom-file-input"><label class="custom-file-label">Dosya seçin...</label></div></div>
									</div>
									<div class="form-group col-md-6">
										<label>Logo</label><span class="text-muted"> ( Kabul edilen uzantılar : jpg - png - jpeg )</span>
										<div class="input-group"><div class="custom-file"><input type="file" name="logo" title="Site logo görseli ekleyiniz" class="custom-file-input"><label class="custom-file-label">Dosya seçin...</label></div></div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Admin paneli logo</label><span class="text-muted"> ( Kabul edilen uzantılar : jpg - png - jpeg )</span>
										<div class="input-group"><div class="custom-file"><input type="file" name="admin_logo" title="Site admin paneli logo görseli ekleyiniz" class="custom-file-input"><label class="custom-file-label">Dosya seçin...</label></div></div>
									</div>
									<div class="form-group col-md-6">
										<label>Üye giriş ve kayıt ol arkaplan</label><span class="text-muted"> ( Kabul edilen uzantılar : jpg - png - jpeg )</span>
										<div class="input-group"><div class="custom-file"><input type="file" name="login_background" title="Site üye giriş arkaplanı resmi ekleyiniz" class="custom-file-input"><label class="custom-file-label">Dosya seçin...</label></div></div>
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
