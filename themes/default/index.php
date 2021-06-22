<!DOCTYPE html>
<?php
$homepage_settings = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM homepage_settings"));
?>
<html lang="tr-TR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="<?php echo $query_settings["description"]; ?>" />
    <meta name="keywords" content="<?php echo $query_settings["keywords"]; ?>" />
    <meta name="author" content="Barış KURT" />
    <title><?php echo $query_settings["title"]; ?></title>
    <link rel="shortcut icon" href="<?php echo URL; ?>uploads/site/<?php echo $query_settings["icon"]; ?>" type="image/x-icon" />
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="<?php echo THEME_URL; ?>css/styles.css" rel="stylesheet" />
    <link href="<?php echo THEME_URL; ?>css/gallery.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(".sign_out").click(function() {
            <?php
            session_destroy();
            ?>
            alert("Başaraıyla çıkış yaptınız. Lütfen işlemi tamamlamak için tamama basınız");
            window.location.assign("http://localhost/bp/");
        });
    </script>
</head>

<body id="page-top">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="<?php echo URL; ?>uploads/site/<?php echo $query_settings["logo"]; ?>" alt="logo"></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menü
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">Hakkımızda</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#gallery">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#visitor_book">Ziyaretçi defteri</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">İletişim</a></li>
                    <?php if (@$_SESSION["id"]) { ?>
                        <li class="nav-item"><a type="button" class="sign_out nav-link">Çıkış yap</a></li>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo THEME_URL; ?>login.php">Giriş yap</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo THEME_URL; ?>register.php">Kayıt ol</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead" style="background: url(<?php echo URL; ?>uploads/site/<?php echo $homepage_settings["background"]; ?>); ">
        <div class="container d-flex h-100 align-items-center">
            <div class="mx-auto text-center">
                <h3 style="font-size: 125px"><?php echo $homepage_settings["top_header"]; ?></h3>
                <h2 class="mx-auto mt-2 mb-5" style="font-size: 25px; font-weight: bolder"><?php echo $homepage_settings["bottom_header"]; ?>.</h2>
                <a class="btn btn-info js-scroll-trigger" href="#about">Tarihçesi</a>
            </div>
        </div>
    </header>
    <!-- About-->
    <section class="about-section text-center" id="about">
        <div class="container">
            <div class="row">
                <div class="mx-auto">
                    <p class="text-white-50" style="margin:5% 0 5% 0;"><?php echo $homepage_settings["history"]; ?></p>
                </div>
            </div>
        </div>
    </section>
    <!-- Projects-->
    <section class="projects-section bg-light" id="gallery">
        <div class="container">
            <?php
            $gallery_query = mysqli_query($con, "SELECT * FROM gallery");
            while ($gallery = mysqli_fetch_array($gallery_query)) {
            ?>
                <div class="card">
                    <div class="imgBx">
                        <img src="<?php echo URL; ?>uploads/gallery/<?php echo $gallery["photo"]; ?>" alt="<?php echo $gallery["header"]; ?>" />
                    </div>
                    <div class="contentBx">
                        <div class="content">
                            <h3><?php echo $gallery["header"]; ?></h3>
                            <p><?php echo $gallery["description"]; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
    <section class="container mb-5" id="visitor_book">
        <?php
        if (@$_POST["visitor_book"]) {
            $name_surname = $_POST["name"] . " " . $_POST["surname"];
            $email = $_POST["email"];
            $message = $_POST["message"];
            $ip = $_POST["ip"];
            $query = mysqli_query($con, "INSERT INTO visitor_book SET name_surname='$name_surname',email='$email',message='$message',ip='$ip'");
            echo $query
                ? '<div class="alert alert-success" role="alert">Mesajınız başarılı bir şekilde gönderilmiştir.</div>' 
                : '<div class="alert alert-danger" role="alert">Mesajınız gönderilememiştir</div>';
        }
        ?>
        <div class="col-6 m-auto">
            <h2 class="text-center">Ziyaretçi defteri</h2>
            <form method="post">
                <div class="form-group">
                    <label for="name">Adınız</label>
                    <input type="text" name="name" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="surname">Soyadınız</label>
                    <input type="text" name="surname" class="form-control" id="surname">
                </div>
                <div class="form-group">
                    <label for="email">Email adresiniz</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="message">Site hakkındaki yorumunuz</label>
                    <textarea name="message" id="message" rows="5" class="form-control" style="resize: none;"></textarea>
                </div>
                <input type="text" hidden name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
                <input class="btn btn-secondary float-right" name="visitor_book" type="submit">
            </form>
        </div>
        <div style="clear: both;"></div>
    </section>
    <section class="contact-section bg-black" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Adres</h4>
                            <hr class="my-4" />
                            <div class="small text-black-50"><?php echo $query_settings["address"]; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">E-mail adresi</h4>
                            <hr class="my-4" />
                            <div class="small text-black-50"><a href="#!"><?php echo $query_settings["email"]; ?></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-mobile-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Telefon numarası</h4>
                            <hr class="my-4" />
                            <div class="small text-black-50"><?php echo $query_settings["phone_number"]; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social d-flex justify-content-center">
                <a class="mx-2" target="_blank" href="<?php echo $query_settings["twitter"]; ?>" <?php if (empty($query_settings["twitter"])) {
                                                                                                        echo "hidden";
                                                                                                    } ?>><i class="fab fa-twitter"></i></a>
                <a class="mx-2" target="_blank" href="<?php echo $query_settings["facebook"]; ?>" <?php if (empty($query_settings["facebook"])) {
                                                                                                        echo "hidden";
                                                                                                    } ?>><i class="fab fa-facebook-f"></i></a>
                <a class="mx-2" target="_blank" href="<?php echo $query_settings["instagram"]; ?>" <?php if (empty($query_settings["instagram"])) {
                                                                                                        echo "hidden";
                                                                                                    } ?>><i class="fab fa-instagram"></i></a>
                <a class="mx-2" target="_blank" href="<?php echo $query_settings["linkedin"]; ?>" <?php if (empty($query_settings["linkedin"])) {
                                                                                                        echo "hidden";
                                                                                                    } ?>><i class="fab fa-linkedin"></i></a>
                <a class="mx-2" target="_blank" href="<?php echo $query_settings["pinterest"]; ?>" <?php if (empty($query_settings["pinterest"])) {
                                                                                                        echo "hidden";
                                                                                                    } ?>><i class="fab fa-pinterest"></i></a>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container">Copyright © 2019 - <?php echo date("Y"); ?> <a target="_blank" href="http://barisyazilim.net/">Barış YAZILIM</a></div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?php echo THEME_URL; ?>js/scripts.min.js"></script>
</body>

</html>