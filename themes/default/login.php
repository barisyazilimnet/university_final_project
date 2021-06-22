<!doctype html>
<?php 
	require_once"../../system/settings.php";
	require_once"../../system/system.php";
?>
<html lang="tr-TR">
	<head>
		<title><?php echo $query_settings["title"]; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo THEME_URL ?>css/login/style.min.css">
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	</head>
	<body class="img js-fullheight" style="background-image: url(../../uploads/site/<?php echo $query_settings["login_background"]; ?>);">
		<section class="ftco-section">
			<div class="container">
				<?php
					if($_POST){
						$name_email=trim($_POST["name_email"]);
						$password =md5(trim($_POST["password"]));
						$response=$_POST["g-recaptcha-response"];
						$secret="6LdCdJwaAAAAAD--DZPecm-8b_i4148pqidC_d-f";
						$remoteip=$_SERVER["REMOTE_ADDR"];
						$captcha=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip"); 
						$result=json_decode($captcha);
						if($result->success==1){ 
							$user_control=mysqli_num_rows(mysqli_query($con,"SELECT * FROM users WHERE (user_name='$name_email' OR email='$name_email') AND password='$password'"));
							if($user_control == 1){
								$query_user = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM users WHERE (user_name='$name_email' OR email='$name_email') AND password='$password'"));
								if($query_user["status"] == 1){
									$_SESSION["id"] = $query_user["id"];
									message("success","","Başarılı","Kullanıcı giriş başarıyla gerçekleşti. Lütfen bekleyiniz yönlendiriliyorsunuz...");
									header("Refresh:3; url = http://localhost/bp", true, 303);
								}else{
									message("warning","","Dikkat!","Site yönetici tarafından hesabınız onaylanmamıştır. Lütfen hesabınızın onaylanmasını bekleyiniz.");                                    
								} 
							}else{
								message("danger","","Başarısız!!!","Kullanıcı adı veya şifreniz hatalı...");                                    
							}
						}else{
							message("danger","","Başarısız!!!","Lütfen güvenligi dogrulayınız.");                                    
						}
					}
				?>
				<div class="row justify-content-center"><div class="col-md-6 text-center mb-5"><h2 class="heading-section">Giriş Yapın</h2></div></div>
				<div class="row justify-content-center">
					<div class="col-md-6 col-lg-4">
						<div class="login-wrap p-0">
							<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post" class="signin-form">
								<div class="form-group"><input type="text" class="form-control <?php input_control($_POST, $user_control); ?>" name="name_email" placeholder="Kullanıcı adınız & Email adresiniz" required></div>
								<div class="form-group"><input id="password-field" type="password" name="password" class="form-control <?php input_control($_POST, $user_control); ?>" placeholder="Şifreniz" required></div>
								<div style="width:305px; height: 78px; <?php if($_POST){ if($result->success==0){ echo 'border:thin solid #f00;';}} ?> margin: auto; margin-bottom:15px;" class="g-recaptcha" data-sitekey="6LdCdJwaAAAAACAYr5JombM2mfKOQVUzJu1BNtla"></div>
								<div class="form-group"><button type="submit" class="form-control btn btn-primary submit px-3">Giriş yap</button></div>
								<div class="form-group d-md-flex">
									<div class="w-50"><label class="checkbox-wrap checkbox-primary"> Beni Hatırla <input type="checkbox"> <span class="checkmark"></span></label></div>
									<div class="w-50 text-md-right"><a href="#" style="color: #fff">Şifremi unuttum</a></div>
								</div>
							</form>
							<a href="<?php echo THEME_URL; ?>register.php" class="btn btn-primary px-3 w-100">Kayıt ol</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<script src="<?php echo THEME_URL; ?>js/login/jquery.min.js"></script>
		<script src="<?php echo THEME_URL; ?>js/login/popper.min.js"></script>
		<script src="<?php echo THEME_URL; ?>js/login/bootstrap.min.js"></script>
		<script src="<?php echo THEME_URL; ?>js/login/main.min.js"></script>
		<script type="text/javascript">
			$(".alert").delay(5000).slideUp(500, function() {
				$(this).alert('close');
			});
		</script>
	</body>
</html>

