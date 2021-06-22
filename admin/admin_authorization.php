<div class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-md-12 text-center">
		<h1 class="m-0">Yetkiler</h1>
	  </div><!-- /.col -->
	</div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php 
					if(in_array("admin_authorization", explode(",", $active_query_user["pages"]))){
						message("info", "info", "Bilgi", "Lütfen yeni yetki eklerken yetki sıralamasının üst rütbeden alt rütbeye dogru sıralı olmasına dikkat ediniz"); ?>
						<div class="card card-info">
							<div class="card-header text-center"><h3 class="card-title float-none">Yetki işlemleri</h3></div>
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap text-center">
									<thead>
										<tr>
											<th>#</th>
											<th>Yetki ismi</th>
											<th>Yetki rengi</th>
											<th>Ekleyen</th>
											<th>Tarih</th>
											<th>İşlemler</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$query=mysqli_query($con,"SELECT user_authorization.authorization_id, user_authorization.name, user_authorization.authorization_color, user_authorization.user_id, user_authorization.datetime, admin_users.user_name FROM user_authorization INNER JOIN admin_users ON user_authorization.user_id=admin_users.user_id");
											while($query_authorization=mysqli_fetch_array($query)){
												$authorization_color=$query_authorization["authorization_color"];
												@$i++;
										?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $query_authorization["name"]; ?></td>
													<td><span class="badge badge-pill badge-<?php echo $authorization_color; ?>"><?php echo $authorization_color; ?></span></td>
													<td><?php echo $query_authorization["user_name"]; ?></td>
													<td><?php echo $query_authorization["datetime"]; ?></td>
													<td>
														<?php if($query_authorization["name"]=="Kurucu"){ echo "Bu yetki silinemez ve düzenlenemez"; }else{ ?>
															<a href="administrator.php?do=admin_authorization_edit&id=<?php echo $query_authorization["authorization_id"]; ?>"><button class="btn btn-info mr-3"><i class="far fa-edit"></i> Düzenle</button></a>
															<a onClick="return del();" href="administrator.php?do=admin_authorization_delete&id=<?php echo $query_authorization["authorization_id"]; ?>&name=<?php echo $query_authorization["name"]; ?>"><button class="btn btn-danger"><i class="fas fa-trash"></i> Sil</button></a>
														<?php } ?>
													</td>
												</tr>
										<?php } ?>
									</tbody>
								</table>
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
