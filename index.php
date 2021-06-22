<?php
    require_once("system/settings.php");
    require_once("system/system.php");
    if($query_settings["status"]){
		require "themes/default/index.php";
    }else{
		require "themes/default/coming_soon.php";
    }
?>