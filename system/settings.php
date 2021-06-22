<?php
	session_start();
    ob_start();
	//error_reporting(0);
	$h="localhost";
	$n="root";
	$p="";
	$db="bp";
	$con= mysqli_connect($h,$n,$p,$db) or die(mysql_error());
    $con -> Set_charset("utf8");
	$query_settings = mysqli_fetch_array(mysqli_query($con, "SELECT settings.*, admin_users.user_name FROM settings INNER JOIN admin_users ON settings.user_id=admin_users.user_id"));
	define("THEME_URL", $query_settings["url"]."/themes/".$query_settings["theme"]."/");
	define("URL", $query_settings["url"]."/");
?>