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
				<?php if(in_array("user_transactions", explode(",", $active_query_user["pages"]))){ ?>
						<div class="card card-info">
							<div class="card-header text-center"><h3 class="card-title float-none">Üye işlemleri</h3></div>
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap text-center">
									<thead>
										<tr>
											<th>#</th>
											<th>Fotoğraf</th>
											<th>İsim soyisim</th>
											<th>Kullanıcı adı</th>
											<th>Doğum tarihi</th>
											<th>Email</th>
											<th>Telefon numarası</th>
											<th>Cinsiyet</th>
											<th>Durum</th>
											<th>Kayıt tarih</th>
											<th>İşlemler</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$query=mysqli_query($con,"SELECT * FROM users");
											while($users=mysqli_fetch_array($query)){
													@$i++;
													?>
													<tr>
														<td><?php echo $i; ?></td>
														<td><a target="_blank" href="../uploads/profile_photos/users/<?php echo $users['photo']; ?>"><img class="profile-user-img img-circle" style="max-width: initial; width: 40px; height: 40px;" src="../uploads/profile_photos/users/<?php echo $users['photo']; ?>"></a></td>														
														<td><?php echo $users["name_surname"]; ?></td>
														<td><?php echo $users["user_name"]; ?></td>
														<td><?php echo date_format(date_create($users["birthday"]),'d.m.Y') ?></td>
														<td><?php echo $users["email"]; ?></td>
														<td><?php echo $users["phone_number"]; ?></td>
														<td>
															<?php 
																if($users["gender"] == 1){
																	echo"<span class='badge badge-pill badge-info'>Bay</span>";
																}else{
																	echo"<span class='badge badge-pill badge-danger'>Bayan</span>";
																} 
															?>
														</td>
														<td>
															<?php 
																if($users["status"] == 1){
																	echo"<span class='badge badge-pill badge-success'>Onaylı</span>";
																}else{
																	echo"<span class='badge badge-pill badge-danger'>Onaylı değil</span>";
																} 
															?>
														</td>
														<td><?php echo date_format(date_create($users["registration_date"]),'H:i:s d.m.Y'); ?></td>
														<td>
															<a href="administrator.php?do=user_edit&id=<?php echo $users["id"]; ?>"><button class="btn btn-info mr-3"><i class="far fa-edit"></i>  Düzenle</button></a>
															<a onClick="return del();" href="administrator.php?do=user_delete&id=<?php echo $users["id"]; ?>"><button class="btn btn-danger"><i class="fas fa-trash"></i> Sil</button></a>
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
