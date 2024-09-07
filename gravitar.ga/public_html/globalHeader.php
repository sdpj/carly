<?php
$con = mysql_pconnect("mysql.ct8.pl", "m27001_gravitar", "Sg090228") or die("Something went wrong while connecting to the database - ID: 1");
mysql_select_db("m27001_gravitar", $con) or die("Something went wrong while connecting to the database - ID: 2");
$isDown = false;
if ($isDown == true){
	if ($_COOKIE['allow']){
		if (!$_COOKIE['allow'] == '1q2wasd3'){
			header('location: ../Down/index.php');
		}
	}else{
		ob_end_clean();
		header('location: ../Down/index.php');
	}
}
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
if ($logged == true){
	$uid = $user['id'];
	if ($user['lastBucks'] == '0'){
		$new = time();
		$bucks = 20;
		if ($user['Membership'] == '1'){
			$bucks = 100;
		}
		mysql_query("UPDATE `accounts` SET `lastBucks`='$new' WHERE `id`='$uid'");
		mysql_query("UPDATE `accounts` SET `Bucks`=`Bucks`+'$bucks' WHERE `id`='$uid'");
	}
        if ($user['lastReebs'] > 0){
                $last = $user['lastReebs'];
                $time = time();
                if (($time - $last) >=86400){
                        if ($user['Membership'] == '1'){
mysql_query("UPDATE `accounts` SET `lastBucks`='$time', `Reebs`=`Reebs`+'50' WHERE `id`='$uid'");
			}else{
				mysql_query("UPDATE `accounts` SET `lastReebs`='$time', `Reebs`=`Reebs`+'10' WHERE `id`='$uid'");
			}
		}
	}
	if ($user['Membership'] == '1'){
		if ($user['lastReebs'] == '0'){
			$new = time();
			$reebs = 40;
			mysql_query("UPDATE `accounts` SET `lastReebs`='$new', `Reebs`=`Reebs`+'$reebs' WHERE `id`='$uid'");
		}
	}
	if ($user['lastBucks'] > 0){
		$last = $user['lastBucks'];
		$time = time();
		if (($time - $last) >= 86400){
			if ($user['Membership'] == '1'){
				mysql_query("UPDATE `accounts` SET `lastBucks`='$time', `Bucks`=`Bucks`+'100' WHERE `id`='$uid'");
			}else{
				mysql_query("UPDATE `accounts` SET `lastBucks`='$time', `Bucks`=`Bucks`+'20' WHERE `id`='$uid'");
			}
		}
	}
	if ($user['Membership'] == '1'){
		if ($user['lastReebs'] > 0){
			$last = $user['lastReebs'];
			$time = time();
			if (($time - $last) >= 86400){
				mysql_query("UPDATE `accounts` SET `lastReebs`='$time', `Reebs`=`Reebs`+'40' WHERE `id`='$uid'");
			}
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
if ($logged==true){
	if ($user['Membership'] == '1'){
		if ($user['Expire'] < time()){
			$uid = $user['id'];
			mysql_query("UPDATE `accounts` SET `Membership`='0' WHERE `id`='$uid'") or die(mysql_error());
			mysql_query("INSERT INTO `messages` (`fromid`, `toid`, `subject`, `body`) VALUES ('1', '$uid', 'Your premium membership has expired.', 'We\'re sorry to tell you but your premium membership has expired. We hope you have enjoyed your time with it. If you would like to upgrade again, go to the upgrades page and select an upgrade option.')") or die(mysql_error());
		}
	}
}
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
if ($logged == true){
if (curPageURL() != 'http://avatarcentral.tk/Banned.php' && curPageURL() != 'http://www.avatarcentral.tk/Banned.php' && curPageURL() != 'avatarcentral.tk/Banned.php' && curPageURL() != 'www.avatarcentral.tk/Banned.php'){
if ($user['banned'] != '0'){
	header('location: Banned.php');
}
}
}
function message($subj, $body, $okpath, $okname, $includecancel, $cancelpath){
?>
<div style="left: 0px; top: 0px; position: fixed; width: 100%; height: 100%; background-image:url('/assets/msg.png'); background-repeat: repeat; z-index: 9999999999999999999999999;"><center><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<div style="width: auto; height: auto; position: fixed; left: 40%; background-color: #CCC; border: 1px solid #000; border-radius: 5px; color: black; padding: 5px; text-align: left;">
<font color="#000000" style="letter-spacing: -1px; text-shadow:#CCC; size: 16px;"><?php print_r($subj); ?></font><br /><br />
<?php print_r($body); ?><br /><br />
<a href="<?php print_r($okpath); ?>" id="buttonsmall"><?php print_r($okname); ?></a>
<?php if ($includecancel == true){
	?>
    <br />
    <a href="<?php print_r($cancelpath); ?>" id="buttonsmall">Cancel</a>
    <?php
}
?>
</div>
</div>
<?php	
}
$uid = $user['id'];
mysql_query("UPDATE `accounts` SET `online`='1' WHERE `id`='$uid'");
date_default_timezone_set('America/Chicago'); // CDT
include('filter.php');
$info = getdate();
$date = $info['mday'];
$month = $info['mon'];
$year = $info['year'];
$hour = $info['hours'];
$min = $info['minutes'];
$sec = $info['seconds'];
$whatineed = ($date . $month);
$mins = ($min);
mysql_query("UPDATE `accounts` SET `lastOnline`='$whatineed' WHERE `id`='$uid'");
mysql_query("UPDATE `accounts` SET `lastOnlineMinutes`='$mins' WHERE `id`='$uid'");
mysql_query("UPDATE `accounts` SET `lastOnlineHours`='$hour' WHERE `id`='$uid'");
function drawCharacter($idd, $width = 100, $height = 195){
	$width = $width . "px";
	$height = $height . "px";
	$check = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$idd'"));
	if ($check != '0'){
		$WearingShirt = false;
		$WearingPants = false;
		$WearingEyes = false;
		$WearingShoes = false;
		$WearingHair = false;
		$WearingMouth = false;
		$WearingAccessories = false;
		$WearingBackground = false;
		$ShirtPath = "";
		$PantsPath = "";
		$EyesPath = "";
		$ShoesPath = "";
		$HairPath = "";
		$MouthPath = "";
		$AccessoriesPath = "";
		$BackgroundPath = "";
		if ($check['ShirtPath'] != ''){
			$WearingShirt = true;
			$ShirtPath = $check['ShirtPath'];
		}
		if ($check['PantsPath'] != ''){
			$WearingPants = true;
			$PantsPath = $check['PantsPath'];
		}
		if ($check['EyesPath'] != ''){
			$WearingEyes = true;
			$EyesPath = $check['EyesPath'];
		}
		if ($check['MouthPath'] != ''){
			$WearingMouth = true;
			$MouthPath = $check['MouthPath'];
		}
		if ($check['ShoesPath'] != ''){
			$WearingShoes = true;
			$ShoesPath = $check['ShoesPath'];
		}
		if ($check['HairPath'] != ''){
			$WearingHair = true;
			$HairPath = $check['HairPath'];
		}
		if ($check['Accessories'] != ''){
			$WearingAccessories = true;
			$AccessoriesPath = $check['Accessories'];
		}
		if ($check['Background'] != ''){
			$WearingBackground = true;
			$BackgroundPath = $check['Background'];
		}
		$WearingShirt2 = false;
		$WearingPants2 = false;
		$WearingEyes2 = false;
		$WearingShoes2 = false;
		$WearingHair2 = false;
		$WearingMouth2 = false;
		$WearingAccessories2 = false;
		$WearingBackground2 = false;
		$o = mysql_query("SELECT * FROM `inventory` WHERE `ownerid`='$idd' ORDER BY id");
		$oo = mysql_num_rows($o);
		for ($count = 1; $count <= $oo; $count ++){
			$or = mysql_fetch_array($o);
			$path = $or['path'];
			if ($check['ShirtPath'] == $path){
				$WearingShirt2 = true;
			}
			if ($check['PantsPath'] == $path){
				$WearingPants2 = true;
			}
			if ($check['EyesPath'] == $path){
				$WearingEyes2 = true;
			}
			if ($check['ShoesPath'] == $path){
				$WearingShoes2 = true;
			}
			if ($check['HairPath'] == $path){
				$WearingHair2 = true;
			}
			if ($check['MouthPath'] == $path){
				$WearingMouth2 = true;
			}
			if ($check['Accessories'] == $path){
				$WearingAccessories2 = true;
			}
			if ($check['Background'] == $path){
				$WearingBackground2 = true;
			}
		}
			if ($WearingShirt2 == false){
				$ShirtPath = "";
			}
			if ($WearingPants2 == false){
				$PantsPath = "";
			}
			if ($WearingEyes2 == false){
				$EyesPath = "";
			}
			if ($WearingShoes2 == false){
				$ShoesPath = "";
			}
			if ($WearingHair2 == false){
				$HairPath = "";
			}
			if ($WearingMouth2 == false){
				$MouthPath = "";
			}
			if ($WearingAccessories2 == false){
				$AccessoriesPath = "";
			}
			if ($WearingBackground2 == false){
				$BackgroundPath = "";
			}
			$type = "Default.png";
			if ($check['color'] == '1'){
				$type = "Default2.png";
			}
			if ($check['color'] == '2'){
				$type = "Default3.png";
			}
		?>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>; background-image:url('/assets/Avatars/<?php echo($type); ?>');padding:0px;">
       <?php
	   if ($check['Membership'] == '1'){
		   ?> <img src="/assets/premium.png" style="position: absolute; margin-left: -40px; margin-top: <?php print_r($height - 20); ?>px; z-index: 3999;" /><?php
	   }
	   ?>
         <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>;z-index:1; position: absolute;background-image:url('/assets/Avatars/<?php echo($type); ?>');padding:0px;"></div>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>;z-index:0; position: absolute; background-image:url('/assets/Avatars/<?php print_r($BackgroundPath); ?>');"></div>
        
                <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>;z-index:999;position: absolute; background-image:url('/assets/Avatars/<?php print_r($AccessoriesPath); ?>');"></div>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>;z-index:4456;position:absolute; background-image:url('/assets/Avatars/<?php print_r($HairPath); ?>');"></div>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>; position: absolute; z-index:2; background-image:url('/assets/Avatars/<?php print_r($ShirtPath); ?>');"></div>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>; z-index:2; position: absolute;  background-image:url('/assets/Avatars/<?php print_r($PantsPath); ?>');"></div>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>; position: absolute;z-index:2;  background-image:url('/assets/Avatars/<?php print_r($EyesPath); ?>');"></div>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>; z-index:2;position: absolute;  background-image:url('/assets/Avatars/<?php print_r($MouthPath); ?>');"></div>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>;position: absolute;z-index:2;  background-image:url('/assets/Avatars/<?php print_r($ShoesPath); ?>');"></div>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>;position: absolute;z-index:2;  background-image:url('/assets/Avatars/Shadow.png');"></div>
        </div>
        
       
        <?php	
		
	}
}
function checkUserOnline($idd){
	$check = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$idd'"));
	if ($check != '0'){
		date_default_timezone_set('America/Chicago'); // CDT

$info = getdate();
$date = $info['mday'];
$month = $info['mon'];
$year = $info['year'];
$hour = $info['hours'];
$min = $info['minutes'];
$sec = $info['seconds'];

$signedin = false;
if ($check['lastOnline'] == ($date . $month)){
	if ($check['lastOnlineHours'] == ($hour)){
		$minsAway = $check['lastOnlineMinutes'];
		if ($minsAway <= $min && $minsAway >= $min - 5){
			$signedin = true;	
		}
	}
}
return $signedin;
	}
}
if ($logged==true){
	if ($user['Dollars'] < 0){
		mysql_query("UPDATE `accounts` SET `Bucks`='0' WHERE `id`='$uid'");
	}
	if ($user['Tokens'] < 0){
		mysql_query("UPDATE `accounts` SET `Reebs`='0' WHERE `id`='$uid'");
	}
}
function givePowers($id) {
	$getUser = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$id'"));
	if ($getUser != 0){
		$cb = mysql_query("SELECT * FROM `Job` WHERE `userid`='$id' ORDER BY id");
		$cbn = mysql_num_rows($cb);
		for ($count = 1; $count <= $cbn; $count ++){
			$cbr = mysql_fetch_array($cb);
			$jobid = $cbr['jobid'];
			if ($jobid == '1'){
				mysql_query("UPDATE `accounts` SET `powerImageMod`='1' WHERE `id`='$id'");
			}
			if ($jobid == '2'){
				mysql_query("UPDATE `accounts` SET `powerDev`='1' WHERE `id`='$id'");
			}
			if ($jobid == '3'){
				mysql_query("UPDATE `accounts` SET `powerCM`='1' WHERE `id`='$id'");
			}
			if ($jobid == '4'){
				mysql_query("UPDATE `accounts` SET `powerForumMod`='1' WHERE `id`='$id'");
			}
			if ($jobid == '5'){
				mysql_query("UPDATE `accounts` SET `powerArtist`='1' WHERE `id`='$id'");
			}
			if ($jobid == '6'){
				mysql_query("UPDATE `accounts` SET `powerHeadMod`='1' WHERE `id`='$id'");
			}
		}
	}
}
if ($logged==true){
	givePowers($uid);
}
$k = mysql_query("SELECT * FROM `ads` ORDER BY id");
$kk = mysql_num_rows($k);
for ($count = 1; $count <= $kk; $count ++){
	$kr = mysql_fetch_array($k);
	if ($kr['endunix'] < time()){
		$id = $kr['id'];
		mysql_query("UPDATE `ads` SET `running`='0' WHERE `id`='$id'");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
a {
	color: #000000;
	text-decoration: none;
}
a:hover {
	color: #000000;
	text-decoration: underline;
}
a:visited {
	color: #000000;
	text-decoration: none;
}
#navbar {
	height: auto;
	width: auto;
	position: absolute;
	top: 0px;
	left: 20%;
	right: auto;
}
#navbar ul {
	margin: 0px;
	padding: 0px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: small;
	color: black;
	line-height: 35px;
	white-space: nowrap;
}
#navbar li {
	list-style-type: none;
	display: inline;
}
#navbar li a {
	text-decoration: none;
	padding: 7px 10px;
	color: white;
	font-weight: bold;
	letter-spacing: 1px;
}
#navbar li a:link {
	color: white;
	font-weight: bold;
}
#navbar li a:visited {
	color: white;
	font-weight: bold;
}
#navbar li a:hover {
	color: white;
	font-weight: bold;
	text-decoration: underline;
}
#navbar2 {
	height: auto;
	width: auto;
	position: absolute;
	top: -9px;
	left: 100px;
	right: auto;
}
#navbar2 ul {
	margin: 0px;
	padding: 0px;
	font-family: "Arial Black", Gadget, sans-serif, Helvetica, sans-serif;
	font-size: small;
	color: white;
	line-height: 35px;
	white-space: nowrap;
}
#navbar2 li {
	list-style-type: none;
	display: inline;
}
#navbar2 li a {
	text-decoration: none;
	padding: 7px 10px;
	color: white;
	font-weight: 500;
	letter-spacing: 1px;
}
#navbar2 li a:link {
	color: white;
}
#navbar2 li a:visited {
	color: white;
}
#navbar2 li a:hover {
	color: white;
	text-decoration: underline;
}
h1 {
	font-size: 37px;
	font-weight: bold;
	letter-spacing: -2px;
	color: #363636;
	margin: 10px 0 10px;
}
#buttonsmall {
	  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  font-family: Arial;
  color: #ffffff;
  font-size: 20px;
  padding: 5px;
  background: #3498db;
  border: solid #1f628d 2px;
  text-decoration: none;
}
#buttonsmall a {
	text-decoration: none;
}
#buttonsmall a:hover {
	text-decoration: none;
}
#buttonsmall:hover {
	border: 1px solid #09F;
	background-color: #0CF;
	color: white;
	box-shadow: inset 0px -2px 2px 0px rgba(204,204,204,1);
}
body {
	font-family: verdana;
	font-size: 12px;
}
</style>
</head>
<body bgcolor="#<?php
if ($logged==true){
	if ($user['Membership'] == '1'){
		print_r('D7D7D7');
	}else{
		print_r('C9FFFF');
	}
}else{
	print_r('C9FFFF');
}?>">
<div style="z-index: -1; left: 0px; top: 0px; position: absolute; background-image:url('/assets/<?php
if ($logged==true){
	if ($user['Membership'] == '1'){
		print_r('premium');
	}
}
?>bgSlant.png'); width: 100%; height: 600px;"></div>
<div style="position: fixed; z-index: 99999999;  left: 0px; top: 0px; width: 100%; height: 40px; background-image:url('/assets/Header/<?php
if ($logged==true){
	if ($user['Membership'] == '1'){
		echo'premium';
	}
}
?>header4.png'); color: blue;">
<ul id="navbar">
<li><a href="/">Home</a></li>
<li><a href="/Players.php">Players</a></li>
<li><a href="/Store/">Store</a></li>
<li><a href="/Upgrade/">Upgrade</a></li>
<li><a href="/Communities/">Communities</a></li>
<li><a href="/Forum/">Forum</a></li>
<li><a href="/Corp/Jobs.php">Jobs</a></li>
<li><a href="/CLIENT.exe">Client</a></li>
</ul>
</div>
<?php
if ($logged == true){
	?>
<div style="position: fixed; left: 0px; top: 40px; width: 100%; height: 25px; background-image:url('/assets/Header/<?php
if ($logged==true){
	if ($user['Membership'] == '1'){
		echo'premium';
	}
}
?>logBar2.png'); z-index: 99999999; color: white;">
<a href="/"><img src="/assets/Logo2.png" border="0" style="margin-top: -40px; z-index: 99999999; margin-left: 3px;" /></a>
<ul id="navbar2">
<li><a href="/Login/logout.php">&larr; Logout</a></li> | 
<a href="/Profile.php"><?php print_r($user['Username']); ?></a></li>
<li><a href="/Account/">Account</a></li>
<li><a href="/Wardrobe/">Wardrobe</a></li>
<li><a href="/Trade/">Trade(<?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `trade` WHERE `toid`='$uid' ORDER BY id"))); ?>)</a></li>
<?php
if ($user['powerCM'] != 0 || $user['powerForumMod'] != 0 || $user['powerHeadMod'] != 0 || $user['powerImageMod'] || $user['powerAdmin'] != 0){ ?><li><a href="/Administration/">Admin (<?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `shop` WHERE `accepted`='0' ORDER BY id"))); ?>) </a></li><?php } ?>
<li><a href="/Inbox<?php
if ($user['Membership'] == '1'){
	echo'2';
}
?>/">Messages (<?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `messages` WHERE `toid`='$uid' AND `read`='0' ORDER BY id"))); ?>)</a></li>
<li><a href="/FriendRequests.php">Friend Requests (<?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `friends` WHERE `withid`='$uid' AND `request`='0' ORDER BY id"))); ?>)</a></li>
<?php
if ($user['Membership'] == '1'){ ?><li><a href="/Money">Gold Coins: <?php print_r($user['Reebs']); ?></a></li><?php } ?>
<li><a href="/Money">Bucks: <?php print_r($user['Bucks']); ?></a></li>
</ul>
</div>
<br /><br />
<?php
}
?><br /><br />
    <br />
    <br />
    <br />
<?php
$shout = mysql_fetch_object($q = mysql_query("SELECT * FROM `shout`"));
if ($shout->{'shout'} != ''){
	?>
    <div style="font-weight: 600; padding-left: 30px; width: 1035px; padding: 4px; border: 1px solid black; background-color: orange; color: white; margin-left: auto; margin-right: auto;">
    <?php
	print_r($shout->{'shout'});
	?>
	</div><br />
    <?php
}
?>
	<br />
    <?php
	$f = mysql_fetch_array(mysql_query("SELECT * FROM `ads` WHERE `running`='1' ORDER BY RAND()"));
	$sel = $f;
	?>
   <center><a href="/<?php
	if ($sel['type'] == '1'){
		?>Profile.php<?php
	}
	?>?id=<?php print_r($sel['onid']); ?>">
    <img src="/assets/ads/<?php print_r($sel['path']); ?>" border="0" width="920" height="90" title="<?php print_r($sel['caption']); ?>" />
    </a></center>
    <?php
	
	?>
<div style="width: 1035px; padding: 4px; border: 1px solid black; background-color: white; color: black; margin-left: auto; margin-right: auto;">