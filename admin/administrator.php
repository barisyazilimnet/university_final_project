<!DOCTYPE html>
<?php
    require_once "../system/settings.php";
    require_once "../system/system.php";
	if(@$_SESSION["id"] == ""){
		header("location: index.php");
    }else{
        if(isset($_SESSION["id"])){
            header("Refresh:5401",true);
            if(time() - $_SESSION["login_time"] > 5400){ //salise üzerinden 60 yazdıgın zaman 1 dk olur
                session_destroy();
            }
        }
        $active_user_id=$_SESSION["id"];
        $active_query_user=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM admin_users INNER JOIN user_authorization ON admin_users.authorization_id=user_authorization.authorization_id WHERE admin_users.user_id='$active_user_id'"));
        @$do = $_GET["do"];
		$hata=1;
?>
<html lang="tr-TR">
<head>
  <meta charset="utf-8">
  <meta name="description" content="<?php echo $query_settings["description"]; ?>">
  <meta name="keywords" content="<?php echo $query_settings["keywords"]; ?>">
  <meta name="author" content="Barış KURT">  
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | <?php echo $query_settings["title"]; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
	<link rel="icon" type="image/x-icon" href="../uploads/site/<?php echo $query_settings["icon"]; ?>" />
	<style>
		.mandatory_field{
			color:#f00;
		}
		textarea{
			resize: none;
		}
	</style>
</head>
<body class="hold-transition sidebar-mini dark-mode">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link">Anasayfa</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-info elevation-4 collapsed">
    <!-- Brand Logo -->
    <a href="administrator.php" class="brand-link">
      <img src="../uploads/site/<?php echo $query_settings["admin_logo"]; ?>" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
			<a target="_blank" href="../uploads/profile_photos/admins/<?php echo $active_query_user["photo"]; ?>">
          		<img src="../uploads/profile_photos/admins/<?php echo $active_query_user["photo"]; ?>" class="img-circle elevation-2" style="height: 75px !important; width: 75px !important;" alt="User Image">
			</a>	
        </div>
        <div class="info">
          <a href="administrator.php?do=profile" class="d-block"><?php echo $active_query_user["user_name"]; ?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item"><a href="administrator.php?do=home_page" class="nav-link <?php if($do=="home_page" or $do==""){ echo 'active'; } ?>"><i class="nav-icon fas fa-home"></i><p> Anasayfa</p></a></li>
			<?php if(in_array("gallery_transactions", explode(",", $active_query_user["pages"]))){ ?>
          <li class="nav-item  <?php if($do=="gallery_transactions" or $do=="photo_add" or $do=="photo_delete" or $do=="photo_edit"){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($do=="gallery_transactions" or $do=="photo_add" or $do=="photo_delete" or $do=="photo_edit"){ echo 'active'; } ?>"><i class="nav-icon fas fa-images"></i><p> Galeri<i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="administrator.php?do=photo_add" class="nav-link <?php if($do=="photo_add"){ echo 'active'; } ?>"><i class="nav-icon fas fa-plus"></i><p> Fotoğraf ekle</p></a></li>
              <li class="nav-item">
				  <a href="administrator.php?do=gallery_transactions" class="nav-link <?php if($do=="gallery_transactions" or $do=="photo_delete" or $do=="photo_edit"){ echo 'active'; } ?>"><i class="nav-icon fas fa-cogs"></i><p>Fotoğraf işlemleri</p></a>
			  </li>
            </ul>
          </li>
			<?php } if(in_array("user_transactions", explode(",", $active_query_user["pages"]))){ ?>
          <li class="nav-item  <?php if($do=="user_transactions" or $do=="user_add" or $do=="user_delete" or $do=="user_edit"){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($do=="user_transactions" or $do=="user_add" or $do=="user_delete" or $do=="user_edit"){ echo 'active'; } ?>"><i class="nav-icon fas fa-users"></i><p> Üyeler<i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="administrator.php?do=user_add" class="nav-link <?php if($do=="user_add"){ echo 'active'; } ?>"><i class="nav-icon fas fa-user-plus"></i><p> Üye ekle</p></a></li>
              <li class="nav-item">
				  <a href="administrator.php?do=user_transactions" class="nav-link <?php if($do=="user_transactions" or $do=="user_delete" or $do=="user_edit"){ echo 'active'; } ?>"><i class="nav-icon fas fa-users-cog"></i><p>Üye işlemleri</p></a>
			  </li>
            </ul>
          </li>
			<?php } if(in_array("admin_user_transactions", explode(",", $active_query_user["pages"]))){ ?>
          <li class="nav-item  <?php if($do=="admin_user_transactions" or $do=="admin_user_add" or $do=="admin_user_delete" or $do=="admin_user_edit"){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($do=="admin_user_transactions" or $do=="admin_user_add" or $do=="admin_user_delete" or $do=="admin_user_edit"){ echo 'active'; } ?>"><i class="nav-icon fas fa-users"></i><p>Admin üyeleri<i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="administrator.php?do=admin_user_add" class="nav-link <?php if($do=="admin_user_add"){ echo 'active'; } ?>"><i class="nav-icon fas fa-user-plus"></i><p>Üye ekle</p></a></li>
              <li class="nav-item">
				  <a href="administrator.php?do=admin_user_transactions" class="nav-link <?php if($do=="admin_user_transactions" or $do=="admin_user_delete" or $do=="admin_user_edit"){ echo 'active'; } ?>"><i class="nav-icon fas fa-users-cog"></i><p>Üye işlemleri</p></a>
			  </li>
            </ul>
          </li>
			<?php } if(in_array("admin_authorization", explode(",", $active_query_user["pages"]))){ ?>
          <li class="nav-item  <?php if($do=="admin_authorization_add" or $do=="admin_authorization" or $do=="admin_authorization_delete" or $do=="admin_authorization_edit"){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($do=="admin_authorization_add" or $do=="admin_authorization" or $do=="admin_authorization_delete" or $do=="admin_authorization_edit"){ echo 'active'; } ?>"><i class="nav-icon fas fa-user-cog"></i><p>Admin yetkileri<i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="administrator.php?do=admin_authorization_add" class="nav-link <?php if($do=="admin_authorization_add"){ echo 'active'; } ?>"><i class="nav-icon fas fa-plus"></i><p>Yetki ekle</p></a></li>
              <li class="nav-item">
				  <a href="administrator.php?do=admin_authorization" class="nav-link <?php if($do=="admin_authorization" or $do=="admin_authorization_delete" or $do=="admin_authorization_edit"){ echo 'active'; } ?>"><i class="nav-icon fas fa-cogs"></i><p>Yetki işlemleri</p></a>
			  </li>
            </ul>
          </li>
			<?php } ?>
          <li class="nav-item  <?php if($do=="profile" or $do=="profile_password"){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($do=="profile" or $do=="profile_password"){ echo 'active'; } ?>"><i class="nav-icon fas fa-user-alt"></i><p>Profilim<i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="administrator.php?do=profile" class="nav-link <?php if($do=="profile"){ echo 'active'; } ?>"><i class="nav-icon fas fa-user-cog"></i><p>Bilgileri güncelle</p></a></li>
              <li class="nav-item">
				  <a href="administrator.php?do=profile_password" class="nav-link <?php if($do=="profile_password"){ echo 'active'; } ?>"><i class="nav-icon fas fa-key"></i><p>Şifre güncelle</p></a>
			  </li>
            </ul>
          </li>
			<?php if(in_array("system_archives", explode(",", $active_query_user["pages"]))){ ?>
          <li class="nav-item"><a href="administrator.php?do=system_archives" class="nav-link <?php if($do=="system_archives"){ echo 'active'; } ?>"><i class="nav-icon fas fa-archive"></i><p>Sistem kayıtları</p></a></li>
			<?php } if(in_array("settings", explode(",", $active_query_user["pages"]))){ ?>
			  <li class="nav-item  <?php if($do=="site_settings" or $do=="coming_soon" or $do=="homepage_settings" or $do=="site_contact"){ echo 'menu-open'; } ?>">
				<a href="#" class="nav-link <?php if($do=="site_settings" or $do=="coming_soon" or $do=="homepage_settings" or $do=="site_contact"){ echo 'active'; } ?>"><i class="nav-icon fas fa-cog"></i><p>Ayarlar<i class="right fas fa-angle-left"></i></p></a>
				<ul class="nav nav-treeview">
				  <li class="nav-item">
					  <a href="administrator.php?do=site_settings" class="nav-link <?php if($do=="site_settings"){ echo 'active'; } ?>"><i class="nav-icon fas fa-globe"></i><p>Site ayarları</p></a>
					</li>
				  <li class="nav-item">
					  <a href="administrator.php?do=homepage_settings" class="nav-link <?php if($do=="homepage_settings"){ echo 'active'; } ?>"><i class="nav-icon fas fa-home"></i><p>Anasayfa ayarları</p></a>
				  </li>
				  <li class="nav-item">
					  <a href="administrator.php?do=coming_soon" class="nav-link <?php if($do=="coming_soon"){ echo 'active'; } ?>"><i class="nav-icon fas fa-cogs"></i><p>Bakımda sayfası</p></a>
				  </li>
				</ul>
			  </li>
			<?php } ?>
          <li class="nav-item"><a href="administrator.php?do=sign_out" class="nav-link <?php if($do=="sign_out"){ echo 'active'; } ?>"><i class="nav-icon fas fa-sign-out-alt"></i><p>Çıkış yap</p></a></li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Main content -->
		<?php
			if(file_exists("{$do}.php")){
				require("{$do}.php");
			}else{
				require("home_page.php");
			}
		?>
	<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer"><strong>Copyright &copy; 2019 - <?php echo date("Y"); ?> <a href="http://barisyazilim.net">Barış YAZILIM</a>.</strong> Tüm hakları saklıdır.</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>	
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<script type="text/javascript">
	$(".alert-warning").delay(5000).slideUp(500, function() {
		$(this).alert('close');
	});
	$(".alert-success").delay(5000).slideUp(500, function() {
		$(this).alert('close');
	});
	$(".alert-danger").delay(5000).slideUp(500, function() {
		$(this).alert('close');
	});
	$(function () {
		$('[data-mask]').inputmask()
	});
	$(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
	function del(){
		var agree=confirm("Bu içeriği silmek istediğinizden emin misiniz?\nBu işlem geri alınamaz!");
		if(agree){ 
			return true; 
		} else{ 
			return false;
		} 
	}
</script>
</body>
</html>
<?php } ?>