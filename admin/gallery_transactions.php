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
				<?php if(in_array("gallery_transactions", explode(",", $active_query_user["pages"]))){ ?>
						<div class="card card-info">
							<div class="card-header text-center"><h3 class="card-title float-none">Üye işlemleri</h3></div>
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap text-center">
									<thead>
										<tr>
											<th>#</th>
											<th>Başlık</th>
											<th>Açıklama</th>
											<th>Fotoğraf</th>
											<th>Ekleyen</th>
											<th>Tarih</th>
											<th>İşlemler</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$query=mysqli_query($con,"SELECT gallery.*,admin_users.user_name FROM gallery INNER JOIN admin_users ON gallery.user_id=admin_users.user_id");
											while($photos=mysqli_fetch_array($query)){
													@$i++;
													?>
													<tr>
														<td><?php echo $i; ?></td>
														<td><?php echo $photos["header"]; ?></td>
														<td><?php echo $photos["description"]; ?></td>
														<td>
															<a target="_blank" href="../uploads/gallery/<?php echo $photos["photo"]; ?>">
																<img class="img-fluid img-circle" style="max-width: initial; width: 50px; height: 50px" src="../uploads/gallery/<?php echo $photos["photo"]; ?>">
															</a>
														</td>
														<td><?php echo $photos["user_name"]; ?></td>
														<td><?php echo date_format(date_create($photos["date"]),'H:i:s d.m.Y'); ?></td>
														<td>
															<a href="administrator.php?do=photo_edit&id=<?php echo $photos["id"]; ?>"><button class="btn btn-info mr-3"><i class="far fa-edit"></i>  Düzenle</button></a>
															<a onClick="return del();" href="administrator.php?do=photo_delete&id=<?php echo $photos["id"]; ?>&header=<?php echo $photos["header"]; ?>"><button class="btn btn-danger"><i class="fas fa-trash"></i> Sil</button></a>
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
