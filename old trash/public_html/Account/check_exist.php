<?php
error_reporting(0);
$connection = mysql_pconnect("localhost","u934831188_mb","kappa123") or die ("Error connecting to database.");
mysql_select_db("u934831188_mb") or die ("Error connecting to database, hang tight, we are working on it.");
if ($_GET['value']){
	$value = mysql_real_escape_string($_GET['value']);
	$get = mysql_fetch_array(mysql_query("SELECT * FROM `Users` WHERE `Username`='$value'"));
	if ($get == 0){
		print_r("<font color='Green'>That username is available!</font>");
	}else{
		print_r("<font color='Red'>That username is not available.</font>");
	}
}
if ($_GET['pass']){
	$pass = mysql_real_escape_string($_GET['pass']);
	if ($_GET['cpass']){
		$cpass = mysql_real_escape_string($_GET['cpass']);
		if ($cpass != $pass){
			print_r("<font color='red'>Password and confirm password do not match.</font>");
		}else{
			print_r("<font color='green'>Password and confirm password match.</font>");
		}
	}else{
	if (strlen($pass) < 5){
		print_r("<font color='Red'>Passwords must be 5 characters or above!</font>");
	}elseif (strlen($pass) > 4 && strlen($pass) < 6){
		print_r("<font color='#FF5D00'>That password is weak!</font>");
	}elseif (strlen($pass) > 5 && strlen($pass) < 10){
		print_r("<font color='#A5FF00'>That password is satisfactory.</font>");
	}elseif (strlen($pass) > 9){
		print_r("<font color='green'>That password is strong!</font>");
	}
	}
	
}