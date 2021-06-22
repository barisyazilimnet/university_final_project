<!DOCTYPE html>
<?php 
	require_once"../system/settings.php"; 
	require_once"../system/system.php";
?>
<html lang="tr-TR">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Barış KURT">
		<title>Admin | <?php echo $query_settings["title"]; ?></title>

		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- icheck bootstrap -->
		<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/adminlte.min.css">
		<link rel="icon" type="image/x-icon" href="../uploads/site/<?php echo $query_settings["icon"]; ?>" />
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<style>
			.mandatory_field{
				color:#f00;
			}
		</style>
	</head>
	<body class="hold-transition login-page">
		<div class="login-box w-75">
			<div class="card card-outline card-info">
				<div class="card-header text-center">
					<a href="index.php" class="h3"><b>Admin | Kayıt ol</b></a>
					<a class="btn btn-danger float-right" href="index.php"><i class="fas fa-close"></i>Vazgeç</a>
				</div>
				<div class="card-body">
					<div class="mr-3"><span class="float-right">Zorunlu olarak doldurulması gereken alanlar kırmızıyla işaretlenmiştir.</span></div><br />
					<?php
                   if($_POST){
                        $name=trim(mb_convert_case($_POST["name"], MB_CASE_TITLE, "utf-8"));
                        $surname=trim(case_converter($_POST["surname"]));
                        $name_surname=$name." ".$surname;
                        $user_name=trim($_POST["user_name"]);
                        $birthday=$_POST["birthday"];
                        $email=trim($_POST["email"]);
                        $phone_number=$_POST["phone_number"];
                        $gender=$_POST["gender"];
                        $password= md5(trim($_POST["password"]));
                        $response=$_POST["g-recaptcha-response"];  // Yanıt 
                        $secret="6LdCdJwaAAAAAD--DZPecm-8b_i4148pqidC_d-f"; // Gizli Anahtar KOdu
                        $remoteip=$_SERVER["REMOTE_ADDR"]; // Kullanıcının İp Adresini Alma
                        $captcha=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip"); 
                        $result=json_decode($captcha);
                        if($result->success==1){ 
                            $turkish_characters=array("ğ", "Ğ", "ç", "Ç", "ş", "Ş", "ü", "Ü", "ö", "Ö", "ı", "İ");
                            foreach($turkish_characters as $value){
                                $turkish=strstr($user_name, $value);
                            }
                            if($turkish==False){
								$user_name_control = mysqli_num_rows(mysqli_query($con,"SELECT * FROM users WHERE user_name = '$user_name'"));
								if ($user_name_control == 0){
									$email_control= mysqli_num_rows(mysqli_query($con,"SELECT * FROM users WHERE email='$email'"));
									if ($email_control == 0){
										if($gender==0){
											$new_adress="Mr_profile_photo.png";
										}else{
											$new_adress="Mrs_profile_photo.png";
										}
										if($password==md5(trim($_POST["password2"]))){
											$query=mysqli_query($con,"INSERT INTO admin_users SET name_surname='$name_surname', user_name='$user_name', birthday='$birthday', email='$email', phone_number='$phone_number', gender='$gender', password='$password', photo='$new_adress', status=0");
											echo mysqli_error($con);
											if($query == 1){
												message("success","check","Başarılı","Sevgili $name_surname kaydınız başarılı bir şekilde oluşturulmuştur. Lütfen sistem yöneticileri tarafından kaydınızı onaylamalarını bekleyiniz");
												header("Refresh:3; url = http://localhost/bp/admin", true, 303);
											}else{
												message("warning","warning","Dikkat!","Kaydınız oluşturulamamıştır.");
											}
										}else{
											message("warning","warning","Dikkat!","Girdiğiniz şifreler uyuşmuyor.");
										}
									}else{
										message("warning","warning","Dikkat!","$email e-posta adresini kullanan başka bir üyemiz mevcut. Lütfen başka bir e-posta ile deneyiniz veya <a href='http://localhost/bp/admin/index.php?giris=$email'><button type='submit' class='btn btn-info'>Giriş yap</button></a> butona tıklayarak giriş yapınız.");
									}
								}else{
									message("warning","warning","Dikkat!","$user_name kullanıcı adını kullanan başka bir üyemiz mevcut. Lütfen başka bir kullanıcı adı ile deneyiniz veya <a href='http://localhost/bp/admin/index.php?giris=$user_name'><button type='submit' class='btn btn-info'>Giriş yap</button></a> butona tıklayarak giriş yapınız.");
								}
                            }else{
								message("warning","warning","Dikkat!","Lütfen kullanıcı adında türkçe karakterler ( ğ, Ğ, ç, Ç, ş, Ş, ü, Ü, ö, Ö, ı, İ ) kullanmayınız");
                            }
                        }else{
							message("danger","ban","Başarısız!","Lütfen güvenligi dogrulayınız.");
                        }
                    }
					?>
					<form method="post" action="<?php $_SERVER["PHP_SELF"]; ?>">
						<div class="row mb-2">
							<div class="form-group col-6">
								<label class="mandatory_field mb-0">Adınız</label>
								<input type="text" class="form-control form-control-border border-with-2" name="name" value="<?php if($_POST){ echo $name; } ?>" placeholder="Adınız..." required>
							</div>
							<div class="form-group col-6">
								<label class="mandatory_field mb-0">Soyadınız</label>
								<input type="text" class="form-control form-control-border border-with-2" name="surname" value="<?php if($_POST){ echo $surname; } ?>" placeholder="Soyadınız..." required>
							</div>
						</div>
						<div class="row mb-2">
							<div class="form-group col-6">
								<label class="mandatory_field mb-0">Kullanıcı adınız</label><span> Lütfen türkçe karakter kullanmayınız (  ğ - Ğ - ç - Ç - ş - Ş - ü - Ü - ö - Ö - ı - İ  )</span>
								<input type="text" class="form-control form-control-border border-with-2 <?php if($_POST){ if(($user_name_control == 1 and isset($user_name_control)) or $turkish){ echo'is-invalid'; }} ?>" name="user_name" id="inputError" placeholder="Kullanıcı adınız..." value="<?php if($_POST){ echo $user_name; } ?>" required>
							</div>
							<div class="form-group col-6">
								<label class="mandatory_field mb-0">Doğum tarihiniz</label>
								<input type="date" class="form-control form-control-border border-with-2" value="<?php if($_POST){ echo $birthday; } ?>" name="birthday" placeholder="Doğum tarihiniz..." required>
							</div>
						</div>
						<div class="row mb-3">
							<div class="form-group col-6">
								<label class="mandatory_field mb-0">E-Mail adresiniz</label>
								<div class="input-group">
									<div class="input-group-append">
										<div class="input-group-text" style="border:none !important; background-color: transparent !important;"><span class="fas fa-envelope"></span></div>
									</div>
									<input type="email" class="form-control form-control-border border-with-2 <?php if($_POST){ if($email_control == 1 and isset($email_control)){ echo'is-invalid'; } } ?>" name="email" value="<?php if($_POST){ echo $email; } ?>" id="inputError" placeholder="E-Mail adresiniz..." required>
								</div>
							</div>
							<div class="form-group col-6">
								<label class="mandatory_field mb-0">Telefon numaranız</label>
								<div class="input-group">
									<div class="input-group-append">
										<div class="input-group-text" style="border:none !important; background-color: transparent !important;"><span class="fas fa-phone-alt"></span></div>
									</div>
									<input type="tel" class="form-control form-control-border border-with-2" name="phone_number" value="<?php if($_POST){ echo $phone_number; } ?>" placeholder="Telefon numaranız..." data-inputmask='"mask": "(999) 999-9999"' data-mask required>
								</div>
							</div>
						</div>
						<div class="row mb-2">
							<div class="form-group col-6">
								<label class="mandatory_field mb-0">Şifreniz</label>
								<input type="password" class="form-control form-control-border border-with-2" name="password" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}" minlength="8"placeholder="Şifreniz..." required>
							</div>
							<div class="form-group col-6">
								<label class="mandatory_field mb-0">Cinsyet</label>
								<select name="gender" class="form-control form-control-border border-with-2">
									<option value="0" <?php if($_POST){ if($gender==0){ echo'selected'; } } ?>>Bayan</option>
									<option value="1" <?php if($_POST){ if($gender==1){ echo'selected'; } } ?>>Bay</option>
								</select>
							</div>
						</div>
						<div class="form-group col-6 float-left">
							<label class="mandatory_field mb-0">Şifreniz tekrar</label>
							<input type="password" class="form-control form-control-border border-with-2" name="password2" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}" minlength="8" placeholder="Şifreniz tekrar..." required>
						</div>
						<div class="mb-1 col-6 float-left">
                    		<div style="width:305px; height: 78px; <?php if($_POST){ if($result->success==0){ echo 'border:thin solid #f00;';}} ?>" class="g-recaptcha m-auto" data-sitekey="6LdCdJwaAAAAACAYr5JombM2mfKOQVUzJu1BNtla"></div>
						</div>
						<div class="row">
							<div style="margin-left:93%"><button type="submit" class="btn btn-outline-info btn-block">Kayıt ol</button></div>
						</div>
					</form>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- /.login-box -->
		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
		<script src="dist/js/adminlte.min.js"></script>
		<script type="text/javascript">
			$(".alert").delay(5000).slideUp(500, function() {
				$(this).alert('close');
			});
			$(function () {
				$('[data-mask]').inputmask()
			});
		</script>
	</body>
</html>
