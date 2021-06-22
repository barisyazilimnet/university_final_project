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
		<div class="col-md-12">
			<?php
				if($_POST){
					$new_password = md5(trim($_POST["new_password"]));
					$new_password2 = md5(trim($_POST["new_password2"]));
					$old_password = md5(trim($_POST["old_password"]));
					if($new_password==$new_password2){
						if($active_query_user["password"]==$old_password){
							$query_update =mysqli_query($con, "UPDATE admin_users SET password='$new_password' WHERE user_id ='$active_user_id'");                
							if($query_update){
								system_archives($con, "Profil şifresi güncellendi", "Profil Güncellendi", $active_user_id);
								message("success","check","Başarılı","Şifreniz başarılı bir şekilde güncellendi");
								_header("profile");
							}else{
								message("warning","exclamation-triangle","Dikkat!","Güncelleme yapılamadı. Lütfen tekrar deneyiniz.");
							}
						}else{
							$pass_result=0;
							message("warning","exclamation-triangle","Dikkat!","Eski şifrenizi yanlış girdiniz");
						}
					}else{
						$new_pass=0;
						message("warning","exclamation-triangle","Dikkat!","Yeni şifreleriniz uyuşmuyor.");
					}
				}
			?>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card card-info">
					<div class="card-header text-center"><h3 class="card-title float-none">Şifre Güncelle</h3></div>
					<form method="post">
						<div class="card-body">
							<div class="float-right mb-3">Zorunlu olarak doldurulması gereken alanlar kırmızıyla işaretlenmiştir.</div>
							<div class="form-group">
								<label class="mandatory_field">Eski şifre</label>
								<input type="password" class="form-control form-control-border border-width-2 <?php input_control($_POST, $pass_result); ?>" id="inputError" name="old_password" minlength="8" title="Eski şifrenizi giriniz" placeholder="Eski şifre..." required>
							</div>
							<div class="form-group">
								<label class="mandatory_field">Yeni şifre</label>
								<input type="password" class="form-control form-control-border border-width-2 <?php input_control($_POST, $new_pass); ?>" id="inputError" name="new_password" title="Yeni şifrenizi giriniz" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}" placeholder="Yeni şifre..." required>
							</div>
							<div class="form-group">
								<label class="mandatory_field">Tekrar yeni şifre</label>
								<input type="password" class="form-control form-control-border border-width-2 <?php input_control($_POST, $new_pass); ?>" id="inputError" name="new_password2" title="Yeni şifrenizi tekrar giriniz" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}" placeholder="Tekrar yeni şifre..." required>
							</div>
						</div>
						<div class="card-footer"><button type="submit" class="btn btn-info float-right">Güncelle</button></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>