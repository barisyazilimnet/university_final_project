<?php
	function _header($page){ // sayfa yönelendirmeleri
		if($page==""){
			header("Refresh:3; url = http://localhost/bp/admin/administrator.php", true, 303);
		}else{
			header("Refresh:3; url = http://localhost/bp/admin/administrator.php?do=$page", true, 303);
		}
	}
	function input_control($post, $variable){ // şifre ve benzerleri konrtolü için
		if($post){ 
			if($variable==0 and isset($variable)){ echo 'is-invalid'; } 
		}
	}
	function authorization_add_pages_control($post,$pages,$pages_name){ // yetki ekleme de checkboxda seçim kontrolleri
		if($post){ 
			if($pages!="" and in_array($pages_name, explode(",", $pages))){ echo "checked"; } 
		}
	}
	function authorization_edit_pages_control($post,$pages,$pages_name,$vt_pages){ // yetki düzenleme de checkboxda seçim kontrolleri
		if($post){ 
			if($pages!="" and in_array($pages_name, explode(",", $pages))){ echo "checked"; } 
		}else{ 
			if(in_array($pages_name, explode(",", $vt_pages))){ echo "checked"; } 
		}
	}
	function authorization_edit_color_control($post,$color,$color_name,$vt_color){ // yetki düzenleme de select de seçim kontrolleri
		if($post){ 
			if($color==$color_name){ echo "selected"; } 
		}else{ 
			if($vt_color==$color_name){ echo "selected"; } 
		}
	}
	function password($length){ //otomatik şifre üretiyor
		$characters = "0123456789!@#$%^&*()_+"."abcdefghijklmnopqrstuvwxyz"."ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$sfr = "";
		while(strlen($sfr) < $length)
		{
			$sfr .= substr($characters, (rand()% strlen($characters)), 1);
		}
		return($sfr);
	}
	function system_archives($con, $description, $operation, $active_user_id){ //sistem kayıt sql
		mysqli_query($con, "INSERT INTO system_archives SET description ='$description', operation ='$operation', user_id ='$active_user_id'");
	}
	function case_converter( $keyword){ // bütün harfleri büyütür
		$low = array('a','b','c','ç','d','e','f','g','ğ','h','ı','i','j','k','l','m','n','o','ö','p','r','s','ş','t','u','ü','v','y','z','q','w','x');
		$upp = array('A','B','C','Ç','D','E','F','G','Ğ','H','I','İ','J','K','L','M','N','O','Ö','P','R','S','Ş','T','U','Ü','V','Y','Z','Q','W','X');
		$keyword = str_replace( $low, $upp, $keyword );
		$keyword = function_exists( 'mb_strtoupper' ) ? mb_strtoupper( $keyword ) : $keyword;
		return $keyword;
	}
	function message($message_pattern,$icon,$top_header_message,$message){ // mesaj şekilleri -> warning -- danger -- success
		echo'<div class="alert alert-'.$message_pattern.' alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fas fa-'.$icon.'"></i> '.$top_header_message.'</h4>
			'.$message.'
		</div>';
	}
	function p($par, $st = false){ // güvenlik
		if ($st){
			return htmlspecialchars(addslashes(trim($_POST[$par])));
		}else {
			return addslashes(trim($_POST[$par]));
		}
	}
?>