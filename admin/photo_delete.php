<div class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-md-12 text-center">
		<h1 class="m-0">Fotoğraflar</h1>
	  </div><!-- /.col -->
	</div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php if(in_array("gallery_transactions", explode(",", $active_query_user["pages"]))){
						$id = $_GET["id"];
						$header = $_GET["header"];
						$query_delete =mysqli_query($con, "DELETE FROM gallery WHERE id ='$id'");
						if($query_delete){
							system_archives($con, "$header fotoğrafı silindi", "Fotoğraf Silindi", $active_user_id);
							message("success","check","Başarılı","Seçilen fotoğraf başarıyla silinmiştir. Lütfen bekleyiniz");
							_header("gallery_transactions");
						}else{
							message("warning","exclamation-triangle","Dikkat!","Seçilen fotoğraf silinememiştir.");
							_header("gallery_transactions");
						}
					}else{
						message("danger","ban","Dikkat!","Buraya girmeye yetkiniz yoktur. Lütfen bekleyiniz ana sayfaya yönlendirliyorsunuz");
						_header("");
					}
				?>
			</div>
		</div>
	</div>
</div>