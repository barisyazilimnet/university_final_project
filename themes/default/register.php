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
                        $name=trim(mb_convert_case($_POST["name"], MB_CASE_TITLE, "utf-8"));
                        $surname=trim(case_converter($_POST["surname"]));
                        $name_surname=$name." ".$surname;
                        $user_name=trim($_POST["user_name"]);
                        $birthday=$_POST["birthday"];
                        $email=trim($_POST["email"]);
                        $phone_number=$_POST["phone_number"];
                        $gender=$_POST["gender"];
						$password =md5(trim($_POST["password"]));
						$response=$_POST["g-recaptcha-response"];
						$secret="6LdCdJwaAAAAAD--DZPecm-8b_i4148pqidC_d-f";
						$remoteip=$_SERVER["REMOTE_ADDR"];
						$captcha=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip"); 
						$result=json_decode($captcha);
						if($result->success==1){ 
							$user_control=mysqli_num_rows(mysqli_query($con,"SELECT * FROM users WHERE user_name='$user_name'"));
							if($user_control == 0){
								$user_control =mysqli_num_rows(mysqli_query($con,"SELECT * FROM users WHERE email='$email'"));
								if($user_control == 0){
									$query=mysqli_query($con,"INSERT INTO users SET name_surname='$name_surname', user_name='$user_name', birthday='$birthday', email='$email', phone_number='$phone_number', gender='$gender', password='$password', status=0");
									if($query){
										message("success","","Başarılı","Başarıyla kayıt oldunuz. Lütfen hesabınızın onaylanmasını bekleyiniz..");
										header("Refresh:3; url = http://localhost/bp", true, 303);
									}else{
										message("warning","","Dikkat!","Site yönetici tarafından hesabınız onaylanmamıştır. Lütfen hesabınızın onaylanmasını bekleyiniz.");                                    
									} 
								}else{
									message("danger","","Başarısız!!!","$email email adresi ile kayıtlı kullanıcımız var. Başka bir email adresiyle tekrar deneyiniz veya giriş yapabilirsiniz");
								}
							}else{
								message("danger","","Başarısız!!!","$user_name kullanıcı adı ile kayıtlı kullanıcımız var. Başka bir kullanıcı adı ile tekrar deneyiniz veya giriş yapabilirsiniz");
							}
						}else{
							message("danger","","Başarısız!!!","Lütfen güvenligi dogrulayınız.");                                    
						}
					}
				?>
				<div class="row justify-content-center"><div class="col-md-6 text-center mb-5"><h2 class="heading-section">Kayıt olun</h2></div></div>
				<div class="row justify-content-center">
					<div class="col-md-10">
						<div class="login-wrap p-0">
							<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
								<div class="row my-2">
									<div class="form-group col-md-6 m-auto">
										<input type="text" class="form-control" name="name" placeholder="Adınız" value="<?php if($_POST){ echo $name; } ?>" required>
									</div>
									<div class="form-group col-md-6 m-auto">
										<input type="text" class="form-control" name="surname" placeholder="Soyadınız" value="<?php if($_POST){ echo $surname; } ?>" required>
									</div>
								</div>
								<div class="row my-2">
									<div class="form-group col-md-6 m-auto">
										<input type="text" class="form-control" name="user_name" placeholder="Kullanıcı adınız" value="<?php if($_POST){ echo $user_name; } ?>" required>
									</div>
									<div class="form-group col-md-6 m-auto">
										<input type="date" class="form-control" name="birthday" placeholder="Doğum tarihiniz" value="<?php if($_POST){ echo $birthday; } ?>" required>
									</div>
								</div>
								<div class="row my-2">
									<div class="form-group col-md-6 m-auto">
										<input type="email" class="form-control" name="email" placeholder="E-mail adresiniz" value="<?php if($_POST){ echo $email; } ?>" required>
									</div>
									<div class="form-group col-md-6 m-auto">
										<input type="tel" class="form-control" name="phone_number" placeholder="Telefon numaranız" value="<?php if($_POST){ echo $phone_number; } ?>" required>
									</div>
								</div>
								<div class="row my-2">
									<div class="form-group col-md-6 m-auto">
										<select class="form-control" name="gender">
											<option value="0" <?php if($_POST){ if($gender==0){ echo"selected"; } } ?> style="color:black !important;">Bayan</option>
											<option value="1" <?php if($_POST){ if($gender==1){ echo"selected"; } } ?> style="color:black !important;">Bay</option>
										</select>
									</div>
									<div class="form-group col-md-6 m-auto">
										<input type="password" class="form-control" name="password" placeholder="Şifreniz" required>
									</div>
								</div>
								<div style="width:305px; height: 78px; <?php if($_POST){ if($result->success==0){ echo 'border:thin solid #f00;';}} ?> margin: auto; margin-bottom:15px; margin-top:15px;" 	class="g-recaptcha" data-sitekey="6LdCdJwaAAAAACAYr5JombM2mfKOQVUzJu1BNtla"></div>
								<div class="form-group w-75 m-auto"><button type="submit" class="form-control btn btn-primary submit">Kayıt ol</button></div>
							</form>
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

