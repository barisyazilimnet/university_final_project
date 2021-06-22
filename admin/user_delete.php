<div class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-md-12 text-center">
		<h1 class="m-0">Üyeler</h1>
	  </div><!-- /.col -->
	</div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php if(in_array("user_transactions", explode(",", $active_query_user["pages"]))){
						$id = $_GET["id"];
						$query=mysqli_fetch_array(mysqli_query($con,"SELECT user_name,photo FROM users WHERE id='$id'"));
						$name = $query["user_name"];
						$query_delete =mysqli_query($con, "DELETE FROM users WHERE id ='$id'");
						if($query_delete){
							if($query["photo"]!="Mrs_profile_photo.png" or $query["photo"]!="Mr_profile_photo.png"){
								unlink("../uploads/profile_photos/users/".$query["photo"]);
							}
							system_archives($con, "$name üyesi silindi", "Üye Silindi", $active_user_id);
							message("success","check","Başarılı","Seçilen üye başarıyla silinmiştir. Lütfen bekleyiniz");
							_header("user_transactions");
						}else{
							message("warning","exclamation-triangle","Dikkat!","Seçilen üye silinememiştir.");
							_header("user_transactions");
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