<?php
$con = mysql_pconnect("mysql.ct8.pl", "m27001_OT", "Sg090228") or die("Something went wrong while connecting to the database - ID: 1");
mysql_select_db("m27001_OT", $con) or die("Something went wrong while connecting to the database - ID: 2");
$isDown = true;

	

$logged = false;
if ($_COOKIE['ck_usrn'] && $_COOKIE['ch_salt']){
	$urn = mysql_real_escape_string($_COOKIE['ck_usrn']);
	$sal = mysql_real_escape_string($_COOKIE['ch_salt']);
	$uss = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `salt`='$sal'"));
	if ($uss != '0'){
		if (hash("ripemd160", strtolower($uss['Username']) == $urn)){
			$logged = true;
			$user = $uss;
			$myU = mysql_fetch_object($ui = mysql_query("SELECT * FROM `accounts` WHERE `salt`='$sal'"));
		}else{
			$logged = false;	
		}
	}
}
if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
    function unMagicQuotify($array) {
        $fixed = array();
        foreach ($array as $key=>$val) {
            if (is_array($val)) {
                $fixed[stripslashes($key)] = unMagicQuotify($val);
            } else {
                $fixed[stripslashes($key)] = stripslashes($val);
            }
        }
        return $fixed;
    }

    $_GET = unMagicQuotify($_GET);
    $_POST = unMagicQuotify($_POST);
    $_COOKIE = unMagicQuotify($_COOKIE);
    $_REQUEST = unMagicQuotify($_REQUEST);
    $_FILES = unMagicQuotify($_FILES);
}
function curPageURL() {
 $pageURL = 'http';
 if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" ) {
    $pageURL .= "s";
}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
if ($logged == true){
if (curPageURL() != 'http://Travinis.tk/Banned.php'){
if ($user['banned'] != '0'){
	header('location: Banned.php'); exit();
}
}

}
function message($subj, $body, $okpath, $okname, $includecancel, $cancelpath){
}
?>
<style>
#buttonsmall {
   -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0px;
  font-family: Arial;
  color: #ffffff;
  font-size: 20px;
  background: #3498db;
  padding: 0px 10px 0px 10px;
  text-decoration: none;
}
</style>