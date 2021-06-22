<div class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-md-12 text-center">
		<h1 class="m-0">Sistem kayıtları</h1>
	  </div><!-- /.col -->
	</div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php 
					if(in_array("system_archives", explode(",", $active_query_user["pages"]))){
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }
							$limit=11;
							$start_from = ($page-1) * $limit;
							$query = mysqli_query($con, "SELECT system_archives.id, system_archives.description, system_archives.operation, system_archives.datetime, admin_users.user_name FROM system_archives INNER JOIN admin_users ON system_archives.user_id=admin_users.user_id LIMIT $start_from, $limit");
							$query_number = mysqli_affected_rows($con);
							$query_number_records = mysqli_num_rows(mysqli_query($con, "SELECT * FROM system_archives INNER JOIN admin_users ON system_archives.user_id=admin_users.user_id"));  //kayıt sayısı
							$total_pages = ceil($query_number_records / $limit);
							if($page==1){
								$baslangic=1;
								if($limit>$query_number_records){
									$end=$query_number_records;
								}else{
									$end=$limit;
								}
							}else{
								$baslangic=1;
								for($i=1; $i<$page; $i++){
									$baslangic+=$limit;
								}
								if($page==$total_pages){
									if($limit>=$query_number){
										$end=$query_number_records;
									}
								}else{
									if($limit>$query_number_records){
										$end=$query_number_records;
									}else{
										$end=$page*$limit;
									}
								}
							}
						?>
						<div class="card card-info">
							<div class="card-header text-center"><h3 class="card-title float-none">Sistem kayıtları</h3></div>
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap text-center">
									<thead>
										<tr>
											<th>#</th>
											<th>Açıklama</th>
											<th>İşlem</th>
											<th>Ekleyen</th>
											<th>Tarih</th>
										</tr>
									</thead>
									<tbody>
										<?php while($query_archives=mysqli_fetch_array($query)){ ?>
												<tr>
													<td><?php echo $query_archives["id"]; ?></td>
													<td><?php echo $query_archives["description"]; ?></td>
													<td>
														<?php 
															if(strpos($query_archives["operation"],"Eklendi")){
																echo '<span class="badge badge-pill badge-success">'.$query_archives["operation"].'</span>';
															}else if(strpos($query_archives["operation"],"Güncellendi")){
																echo '<span class="badge badge-pill badge-info">'.$query_archives["operation"].'</span>';
															}else if(strpos($query_archives["operation"],"Silindi")){
																echo '<span class="badge badge-pill badge-danger">'.$query_archives["operation"].'</span>';
															}
														?>
													</td>
													<td><?php echo $query_archives["user_name"]; ?></td>
													<td><?php echo $query_archives["datetime"]; ?></td>
												</tr>
										<?php } ?>
									</tbody>
								</table>
								<div class="col-md-12 text-center my-3">
									<?php echo'<span class="float-left mt-3">'.$baslangic.' - '.$end.' / '.$query_number_records.' gösteriliyor</span>'; ?>
									<div class="btn-group">
										<?php   if($page!=1){
													echo'<a type="button" class="btn btn-info" href="administrator.php?do=system_archives&page=1"><i class="fa fa-fast-backward"></i></a>';
												}
												for ($i=1; $i<=$total_pages; $i++){
													echo'<a type="button" class="btn btn-info" href="administrator.php?do=system_archives&page='.$i.'">'.$i.'</a>';
												}
												if($page!=$total_pages){
													echo'<a type="button" class="btn btn-info" href="administrator.php?do=system_archives&page='.$total_pages.'"><i class="fa fa-fast-forward"></i></a>';
												}
										?>
									</div>
								</div>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
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
