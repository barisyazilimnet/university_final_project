<!DOCTYPE html>
<?php 
	require_once"../system/settings.php"; 
	require_once"../system/system.php";
	if(@$_SESSION["id"] != ""){
		header("location: administrator.php");
    }

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
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="card card-outline card-info">
				<div class="card-header text-center">
					<a href="index.php" class="h1"><b>Admin</b></a>
				</div>
				<div class="card-body">
					<p class="login-box-msg">Giriş yapınız</p>
					<?php
						@$giris=$_GET["giris"];
						if($_POST){
							$name_email=trim($_POST["name_email"]);
							$password =md5(trim($_POST["password"]));
							$response=$_POST["g-recaptcha-response"];
							$secret="6LdCdJwaAAAAAD--DZPecm-8b_i4148pqidC_d-f";
							$remoteip=$_SERVER["REMOTE_ADDR"];
							$captcha=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip"); 
							$result=json_decode($captcha);
							if($result->success==1){ 
								$user_control=mysqli_num_rows(mysqli_query($con,"SELECT * FROM admin_users WHERE (user_name='$name_email' OR email='$name_email') AND password='$password'"));
								if($user_control == 1){
									$query_user = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM admin_users WHERE (user_name='$name_email' OR email='$name_email') AND password='$password'"));
									if($query_user["status"] == 1){
										$_SESSION["id"] = $query_user["user_id"];
										message("success","check","Başarılı","Kullanıcı giriş başarıyla gerçekleşti. Lütfen bekleyiniz yönlendiriliyorsunuz...");                                    
										$_SESSION["login_time"] = time();
										_header("");
									}else{
										message("warning","warning","Dikkat!","Site yönetici tarafından hesabınız onaylanmamıştır. Lütfen hesabınızın onaylanmasını bekleyiniz.");                                    
									} 
								}else{
									message("danger","ban","Başarısız!!!","Kullanıcı adı veya şifreniz hatalı...");                                    
								}
							}else{
								message("danger","ban","Başarısız!!!","Lütfen güvenligi dogrulayınız.");                                    
							}
						}
					?>
					<form method="post" action="<?php $_SERVER["PHP_SELF"]; ?>">
						<div class="input-group mb-3">
							<div class="input-group-append"><div class="input-group-text" style="border:none !important; background-color: transparent !important;"><span class="fas fa-user-alt"></span></div></div>
							<input type="text" class="form-control form-control-border border-with-2 <?php input_control($_POST, $user_control); ?>" name="name_email" id="inputError" placeholder="Kullanıcı adı veya email..." value="<?php echo @$giris; ?>" required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append"><div class="input-group-text" style="border:none !important; background-color: transparent !important;"><span class="fas fa-lock"></span></div></div>
							<input type="password" class="form-control form-control-border border-with-2 <?php input_control($_POST, $user_control); ?>" minlength="8" name="password" id="inputError" placeholder="Şifre..." required>
						</div>
                    	<div style="width:305px; height: 78px; <?php if($_POST){ if($result->success==0){ echo 'border:thin solid #f00;';}} ?>" class="g-recaptcha ml-2 mb-1" data-sitekey="6LdCdJwaAAAAACAYr5JombM2mfKOQVUzJu1BNtla"></div>
						<div class="row">
							<div class="col-8">
								<div class="icheck-primary">
									<input type="checkbox" id="remember">
									<label for="remember">Beni hatırla</label>
								</div>
							</div>
							<!-- /.col -->
							<div class="col-4"><button type="submit" class="btn btn-outline-info btn-block">Giriş yap</button></div>
							<!-- /.col -->
						</div>
					</form>
					<p class="mb-0"><a href="#">Şifremi unuttum</a></p>
					<p class="mb-0"><a href="register.php" class="text-center">Kayıt ol</a></p>
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
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.min.js"></script>
		<script type="text/javascript">
			$(".alert").delay(5000).slideUp(500, function() {
				$(this).alert('close');
			});
		</script>
	</body>
</html>
