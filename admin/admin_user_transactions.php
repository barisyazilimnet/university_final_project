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
				<?php if(in_array("admin_user_transactions", explode(",", $active_query_user["pages"]))){ ?>
						<div class="card card-info">
							<div class="card-header text-center"><h3 class="card-title float-none">Üye işlemleri</h3></div>
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap text-center">
									<thead>
										<tr>
											<th>#</th>
											<th>İsim soyisim</th>
											<th>Kullanıcı adı</th>
											<th>Email</th>
											<th>Telefon numarası</th>
											<th>Web site ve sosyal<br />medya</th>
											<th>Cinsiyet</th>
											<th>Durum</th>
											<th>Yetki</th>
											<th>Kayıt tarih</th>
											<th>İşlemler</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$query=mysqli_query($con,"SELECT admin_users.*, user_authorization.name, user_authorization.authorization_color FROM admin_users INNER JOIN user_authorization ON admin_users.authorization_id=user_authorization.authorization_id");
											while($admin_users=mysqli_fetch_array($query)){
												if($admin_users["user_id"]!=1){
													@$i++;
													?>
													<tr>
														<td><?php echo $i; ?></td>
														<td><?php echo $admin_users["name_surname"]; ?></td>
														<td><?php echo $admin_users["user_name"]; ?></td>
														<td><?php echo $admin_users["email"]; ?></td>
														<td><?php echo $admin_users["phone_number"]; ?></td>
														<td>
															<a target="_blank" href="<?php echo $admin_users["web_site"]; ?>" <?php if(empty($admin_users["web_site"])){ echo"hidden"; } ?>>
																<i class="fas fa-globe"></i>
															</a>&nbsp;
															<a target="_blank" href="<?php echo $admin_users['facebook']; ?>" <?php if(empty($admin_users["facebook"])){ echo"hidden"; } ?>>
																<i class="fab fa-facebook-square"></i>
															</a>&nbsp;
															<a target="_blank" href="<?php echo $admin_users['instagram']; ?>" <?php if(empty($admin_users["instagram"])){ echo"hidden"; } ?>>
																<i class="fab fa-instagram-square"></i>
															</a>&nbsp;
															<a target="_blank" href="<?php echo $admin_users['twitter']; ?>" <?php if(empty($admin_users["twitter"])){ echo"hidden"; } ?>>
																<i class="fab fa-twitter-square"></i>
															</a>&nbsp;
															<a target="_blank" href="<?php echo $admin_users['linkedin']; ?>" <?php if(empty($admin_users["linkedin"])){ echo"hidden"; } ?>>
																<i class="fab fa-linkedin"></i>
															</a>&nbsp;
															<a target="_blank" href="<?php echo $admin_users['pinterest']; ?>" <?php if(empty($admin_users["pinterest"])){ echo"hidden"; } ?>>
																<i class="fab fa-pinterest-square"></i>
															</a>
														</td>
														<td>
															<?php 
																if($admin_users["gender"] == 1){
																	echo"<span class='badge badge-pill badge-info'>Bay</span>";
																}else{
																	echo"<span class='badge badge-pill badge-danger'>Bayan</span>";
																} 
															?>
														</td>
														<td>
															<?php 
																if($admin_users["status"] == 1){
																	echo"<span class='badge badge-pill badge-success'>Onaylı</span>";
																}else{
																	echo"<span class='badge badge-pill badge-danger'>Onaylı değil</span>";
																} 
															?>
														</td>
														<td>
															<?php 
																$authorization_name=$admin_users["name"];
																$authorization_color=$admin_users["authorization_color"];
																echo "<span class='badge badge-pill badge-$authorization_color'>$authorization_name</span>";
															?>
														</td>
														<td><?php echo date_format(date_create($admin_users["registration_date"]),'H:i:s d.m.Y'); ?></td>
														<td>
															<a href="administrator.php?do=admin_user_edit&id=<?php echo $admin_users["user_id"]; ?>"><button class="btn btn-info mr-3"><i class="far fa-edit"></i>  Düzenle</button></a>
															<a onClick="return del();" href="administrator.php?do=admin_user_delete&id=<?php echo $admin_users["user_id"]; ?>"><button class="btn btn-danger"><i class="fas fa-trash"></i> Sil</button></a>
														</td>
													</tr>
										<?php } } ?>
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
