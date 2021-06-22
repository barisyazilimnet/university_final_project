<div class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-sm-6">
		<h1 class="m-0">Anasayfa</h1>
	  </div><!-- /.col -->
	</div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php
					session_destroy();
					header("Refresh:3; url = http://localhost/bp/admin");
					message("success","check","Başarılı","Başarılı bir şekilde çıkış yaptınız. Lütfen bekleyiniz yönlendiriliyorsunuz.");
				?>
			</div>
		</div>
	</div>
</div>