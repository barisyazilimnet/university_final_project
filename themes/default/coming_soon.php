<!doctype html>
<html lang="tr-TR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Barış KURT" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" >
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>css/coming_soon/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>fonts/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>css/coming_soon/parallax-hero.min.css">
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>css/coming_soon/style.min.css">
	<title><?php echo $query_settings["title"]; ?></title>
</head>
<body>
	<?php 
		$query_coming_soon=mysqli_fetch_array(mysqli_query($con, "SELECT * FROM coming_soon"));
		$date=date_format(date_create($query_coming_soon["time"]),'d.m.Y');
	?>
	<div id="page">
		<div class="cd-background-wrapper">
			<figure class="cd-floating-background">
				<div class="base-layer" data-background-color="#166bbf"></div>
				<div class="layer animate pointer-events-none" data-background-image="<?php echo THEME_URL; ?>img/dots.png" data-layer-depth="550"></div>
				<div class="layer animate" data-layer-depth="300">
					<div id="content">
						<div class="content-wrapper">
							<div class="container">
                                <div class="brand"><img src="<?php echo URL; ?>uploads/site/<?php echo $query_settings["logo"]; ?>" alt="logo"></div>
								<div class="heading">
                                    <div class="count-down" data-countdown-year="<?php echo substr($date,6,4); ?>" data-countdown-month="<?php echo substr($date,3,2); ?>" data-countdown-day="<?php echo substr($date,0,2); ?>"></div>
									<h1 id="heading" class="large"><?php echo $query_coming_soon["header"]; ?></h1>
                                    <p><?php echo $query_coming_soon["description"]; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</figure>
		</div>
	</div>
	<script src="<?php echo THEME_URL; ?>js/coming_soon/jquery-2.1.1.min.js"></script>
    <script src="<?php echo THEME_URL; ?>js/coming_soon/jquery.plugin.min.js"></script>
    <script src="<?php echo THEME_URL; ?>js/coming_soon/jquery.countdown.min.js"></script>
	<script src="<?php echo THEME_URL; ?>js/coming_soon/parallax-hero.min.js"></script>
	<script src="<?php echo THEME_URL; ?>js/coming_soon/custom.min.js"></script>
</body>
</html>
