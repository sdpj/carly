<?php
error_reporting(0);
$con = mysql_pconnect("mysql.ct8.pl", "m27001_gravitar", "Sg090228") or die("Something went wrong while connecting to the database - ID: 1");
mysql_select_db("m27001_gravitar", $con) or die("Something went wrong while connecting to the database - ID: 2");
$isDown = false;
if ($isDown == true){
  if ($_COOKIE['allow']){
    if (!$_COOKIE['allow'] == '1q2wasd3'){
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
    $floodcheck = $user['floodcheck'];
    $bucks = 10;
    if ($user['Membership'] == '1'){
      $bucks = 20;
    }
    mysql_query("UPDATE `accounts` SET `lastBucks`='$new' WHERE `id`='$uid'");
    mysql_query("UPDATE `accounts` SET `Bucks`=`Bucks`+'$bucks' WHERE `id`='$uid'");
  }
  if ($user['Membership'] == '1'){
    if ($user['lastReebs'] == '0'){
      $new = time();
      $reebs = 10;
      mysql_query("UPDATE `accounts` SET `lastReebs`='$new', `Reebs`=`Reebs`+'$reebs' WHERE `id`='$uid'");
    }
  }
        if ($user['Membership'] == '0'){
    if ($user['lastReebs'] == '0'){
      $new = time();
      $reebs = 5;
      mysql_query("UPDATE `accounts` SET `lastReebs`='$new', `Reebs`=`Reebs`+'$reebs' WHERE `id`='$uid'");
    }
  }
  if ($user['lastBucks'] > 0){
    $last = $user['lastBucks'];
    $time = time();
    if (($time - $last) >= 86400){
      if ($user['Membership'] == '1'){
        mysql_query("UPDATE `accounts` SET `lastBucks`='$time', `Bucks`=`Bucks`+'20' WHERE `id`='$uid'");
      }else{
        mysql_query("UPDATE `accounts` SET `lastBucks`='$time', `Bucks`=`Bucks`+'10' WHERE `id`='$uid'");
      }
    }
  }
  if ($user['Membership'] == '1'){
    if ($user['lastReebs'] > 0){
      $last = $user['lastReebs'];
      $time = time();
      if (($time - $last) >= 86400){
        mysql_query("UPDATE `accounts` SET `lastReebs`='$time', `Reebs`=`Reebs`+'10' WHERE `id`='$uid'");
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
if (curPageURL() == 'http://avatarcentral.tk/Chat.php' || curPageURL() == 'http://www.avatarcentral.tk/Chat.php' || curPageURL() == 'avatarcentral.tk/Chat.php' || curPageURL() == 'www.avatarcentral.tk/Chat.php'){
  mysql_query("UPDATE accounts SET chat='1' WHERE `id`='$uid'");
}else{
  mysql_query("UPDATE accounts SET chat='0' WHERE `id`='$uid'");
}
}
function message($subj, $body, $okpath, $okname, $includecancel, $cancelpath){
?>
<div style="left: 0px; top: 0px; position: fixed; width: 100%; height: 100%; background-color:rgba(0,0,0,0.5); background-repeat: repeat; z-index: 999999999999999999999999999;"><center><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<div style="width: auto; height: auto; position: fixed; left: 37.5%; box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);border-radius:5px;padding: 7px; border: 0px solid #999; background-color: #FFFFFF; color: black; text-align: center; vertical-align: central; color: black; padding: 5px; text-align: left;">
<text style="text-align:center;display:block;color:#333;font-size: 1.5rem;
    font-weight: 500;"><?php print_r($subj); ?></text><br /><br />
<?php print_r($body); ?><br /><br />
<a href="<?php print_r($okpath); ?>" id="buttonsmall" style="width: 95.5%;
    display: block;
    margin: auto;
    text-align: center;border-radius:5px; background-color: #04AA6D; transition-duration: 0s;"><?php print_r($okname); ?></a>
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
date_default_timezone_set('America/New_York'); // CDT
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
function drawCharacter($idd, $width = 100, $height = 200){
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
    $WearingPet = false;
    $ShirtPath = "";
    $PantsPath = "";
    $EyesPath = "";
    $ShoesPath = "";
    $HairPath = "";
    $MouthPath = "";
    $AccessoriesPath = "";
    $BackgroundPath = "";
    $PetPath = "";
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
    if ($check['PetPath'] != ''){
      $WearingPet = true;
      $PetPath = $check['PetPath'];
    }
    $WearingShirt2 = false;
    $WearingPants2 = false;
    $WearingEyes2 = false;
    $WearingShoes2 = false;
    $WearingHair2 = false;
    $WearingMouth2 = false;
    $WearingAccessories2 = false;
    $WearingBackground2 = false;
    $WearingPet2 = false;
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
      if ($check['PetPath'] == $path){
        $WearingPet2 = true;
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
      if ($WearingPet2 == false){
        $PetPath = "";
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
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>; background-image:url('/assets/<?php
    if (checkUserOnline($check['id']) == true){
      echo "ON";
    }else{
      echo "OFF";
    } ?>.png'); padding: 0px;position: absolute;z-index: 3999; z-index: 999999999999999999999999999999999;"></div>
       <?php
     if ($check['Membership'] == '1'){
       ?> <img src="/assets/premium.png" style="position: absolute; margin-left: -40px; margin-top: <?php print_r($height - 20); ?>px; z-index: 3999;" /><?php
     }
     ?>
         <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>;z-index:2; position: absolute;background-image:url('/assets/Avatars/<?php echo($type); ?>');padding:0px;"></div>
          <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>;position: absolute;z-index:0;  background-image:url('/assets/Avatars/Shadow3.png');"></div>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>;z-index:0; position: absolute; background-image:url('/assets/Avatars/<?php print_r($BackgroundPath); ?>');"></div>
        
                <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>;z-index:999;position: absolute; background-image:url('/assets/Avatars/<?php print_r($AccessoriesPath); ?>');"></div>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>;z-index:4456;position:absolute; background-image:url('/assets/Avatars/<?php print_r($HairPath); ?>');"></div>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>; position: absolute; z-index:2; background-image:url('/assets/Avatars/<?php print_r($ShirtPath); ?>');"></div>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>; position: absolute; z-index:2; background-image:url('/assets/Avatars/<?php print_r($PetPath); ?>');"></div>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>; z-index:2; position: absolute;  background-image:url('/assets/Avatars/<?php print_r($PantsPath); ?>');"></div>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>; position: absolute;z-index:2;  background-image:url('/assets/Avatars/<?php print_r($EyesPath); ?>');"></div>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>; z-index:2;position: absolute;  background-image:url('/assets/Avatars/<?php print_r($MouthPath); ?>');"></div>
        <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>;position: absolute;z-index:2;  background-image:url('/assets/Avatars/<?php print_r($ShoesPath); ?>');"></div>
        </div>
        </div>
       
        <?php  
    
  }
}
  
function drawPFP($idd){
  $width = "100px";
  $height = "100px";
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
    $WearingPet = false;
    $ShirtPath = "";
    $PantsPath = "";
    $EyesPath = "";
    $ShoesPath = "";
    $HairPath = "";
    $MouthPath = "";
    $AccessoriesPath = "";
    $BackgroundPath = "";
    $PetPath = "";
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
    if ($check['PetPath'] != ''){
      $WearingPet = true;
      $PetPath = $check['PetPath'];
    }
    $WearingShirt2 = false;
    $WearingPants2 = false;
    $WearingEyes2 = false;
    $WearingShoes2 = false;
    $WearingHair2 = false;
    $WearingMouth2 = false;
    $WearingAccessories2 = false;
    $WearingBackground2 = false;
    $WearingPet2 = false;
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
      if ($check['PetPath'] == $path){
        $WearingPet2 = true;
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
      if ($WearingPet2 == false){
        $PetPath = "";
      }
      $type = "Default.png";
      if ($check['color'] == '1'){
        $type = "Default2.png";
      }
      if ($check['color'] == '2'){
        $type = "Default3.png";
      }
    ?>
        
        <div style="box-shadow: -2px 2px 7px rgb(0 0 0 / 25%); border-radius: 50%; width: <?php echo($width); ?>; height: <?php echo($height); ?>; background-image:url('/assets/Avatars/<?php echo($type); ?>');padding:0px;background-color:white;">
        <div style="border-radius: 50%; width: <?php echo($width); ?>; height: <?php echo($height); ?>; background-image:url('/assets/<?php
    if (checkUserOnline($check['id']) == true){
      echo "ON";
    }else{
      echo "OFF";
    } ?>.png'); padding: 0px;position: absolute;z-index: 3999; z-index: 999999999999999999999999999999999;"></div>
       <?php
     if ($check['Membership'] == '1'){
       ?> <img src="/assets/premium.png" style="position: absolute; margin-left: -40px; margin-top: <?php print_r($height - 20); ?>px; z-index: 3999;" /><?php
     }
     ?>
         <div style="border-radius: 50%; width: <?php echo($width); ?>; height: <?php echo($height); ?>;z-index:2; position: absolute;background-image:url('/assets/Avatars/<?php echo($type); ?>');padding:0px;"></div>
          <div style="border-radius: 50%; width: <?php echo($width); ?>; height: <?php echo($height); ?>;position: absolute;z-index:0;  background-image:url('/assets/Avatars/Shadow3.png');"></div>
        <div style="border-radius: 50%; width: <?php echo($width); ?>; height: <?php echo($height); ?>;z-index:0; position: absolute; background-image:url('/assets/Avatars/<?php print_r($BackgroundPath); ?>');"></div>
        
                <div style="border-radius: 50%; width: <?php echo($width); ?>; height: <?php echo($height); ?>;z-index:999;position: absolute; background-image:url('/assets/Avatars/<?php print_r($AccessoriesPath); ?>');"></div>
        <div style="border-radius: 50%; width: <?php echo($width); ?>; height: <?php echo($height); ?>;z-index:4456;position:absolute; background-image:url('/assets/Avatars/<?php print_r($HairPath); ?>');"></div>
        <div style="border-radius: 50%; width: <?php echo($width); ?>; height: <?php echo($height); ?>; position: absolute; z-index:2; background-image:url('/assets/Avatars/<?php print_r($ShirtPath); ?>');"></div>
        <div style="border-radius: 50%; width: <?php echo($width); ?>; height: <?php echo($height); ?>; position: absolute; z-index:2; background-image:url('/assets/Avatars/<?php print_r($PetPath); ?>');"></div>
        <div style="border-radius: 50%; width: <?php echo($width); ?>; height: <?php echo($height); ?>; z-index:2; position: absolute;  background-image:url('/assets/Avatars/<?php print_r($PantsPath); ?>');"></div>
        <div style="border-radius: 50%; width: <?php echo($width); ?>; height: <?php echo($height); ?>; position: absolute;z-index:2;  background-image:url('/assets/Avatars/<?php print_r($EyesPath); ?>');"></div>
        <div style="border-radius: 50%; width: <?php echo($width); ?>; height: <?php echo($height); ?>; z-index:2;position: absolute;  background-image:url('/assets/Avatars/<?php print_r($MouthPath); ?>');"></div>
        <div style="border-radius: 50%; width: <?php echo($width); ?>; height: <?php echo($height); ?>;position: absolute;z-index:2;  background-image:url('/assets/Avatars/<?php print_r($ShoesPath); ?>');"></div>
        </div>
        </div>
       
        <?php  
    
  }
}  

function checkUserOnline($idd){
  $check = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$idd'"));
  if ($check != '0'){
    date_default_timezone_set('America/New_York'); // CDT
if ($check['hide'] == '0'){
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
}
if ($logged==true){
  if ($user['Bucks'] < 0){
    mysql_query("UPDATE `accounts` SET `Bucks`='0' WHERE `id`='$uid'");
  }
  if ($user['Reebs'] < 0){
    mysql_query("UPDATE `accounts` SET `Reebs`='0' WHERE `id`='$uid'");
  }
}
if ($logged==true){
  $ip = $_SERVER['REMOTE_ADDR'];
  mysql_query("UPDATE accounts SET ip='$ip' WHERE id='$uid'");
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
function emoticons($text) {
        $icons = array(
                ':)'    =>  '<img src="/assets/Emoticons/emote_smile.png" alt=":)" title=":)" />',
                ':D'    =>  '<img src="/assets/Emoticons/emote_happy.png" alt=":D" title=":D" />',
                ':('    =>  '<img src="/assets/Emoticons/emote_sad.png" alt=":(" title=":(" />',
        );
        return strtr($text, $icons);
    }
if ($logged==true){
  givePowers($uid);
  $loc = curPageURL();
  mysql_query("UPDATE accounts SET lastloc='$loc' WHERE id='$uid'");
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
//if($userRow && $userRow['Id'] == "1") {
//    $allowed_ips = array(
//      '50.187.17.247',
//      '',
//      ''
//    );
//    
//    if(!in_array($_SERVER['REMOTE_ADDR'], $allowed_ips)) {
//      mysql_query("UPDATE `Website` SET `Lockdown`='1'");
//    }
//  }
  
//  $websiteRow = mysql_fetch_array(mysql_query("SELECT * FROM `Website`"));
//  if($websiteRow['Lockdown'] == '1') {
//    exit(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/documents/lockdown.html"));
//  } //just until this is fixed
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
#navbar3 {
  height: auto;
  width: auto;
  position: absolute;
  top: -4px;
  left: 167px;
  right: auto;
  display: inline;
  font-size:18px;
}
#navbar3 ul {
  margin: 0px;
  padding: 0px;
  font-family: Verdana, Geneva, sans-serif;
  font-size: small;
  color: black;
  line-height: 35px;
  white-space: nowrap;
        display: inline;
}
#navbar3 li {
  list-style-type: none;
  display: inline;
}
#navbar3 li a {
  text-decoration: none;
  padding: 7px 10px;
  color: white;
  font-weight: bold;
  letter-spacing: 1px;
}
#navbar3 li a:link {
  color: white;
  font-weight: bold;
}
#navbar3 li a:visited {
  color: white;
  font-weight: bold;
}
#navbar3 li a:hover {
  color: white;
  font-weight: bold;
  
}
#navbar2 {
  height: auto;
  width: auto;
  position: absolute;
  top: -9px;
  font-size:18px;
  text-align: center;
  left:0px;
  width: 100%;
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
  
}
h1 {
  font-size: 37px;
  font-weight: bold;
  letter-spacing: -2px;
  color: #363636;
  margin: 10px 0 10px;
}
#buttonsmall {
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0px;
  font-family: Arial;
  color: #ffffff;
  font-size: 15px;
  background: #3498db;
  padding: 5px 10px 5px 10px;
  text-decoration: none;
}

#buttonsmall:hover {
  background: #3cb0fd;
  text-decoration: none;
}
#buttonsmall2 {
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0px;
  font-family: Arial;
  color: #ffffff;
  font-size: 15px;
  background: #ff0000;
  padding: 5px 10px 5px 10px;
  text-decoration: none;
}

#buttonsmall2:hover {
  background: #ff0000;
  text-decoration: none;
}
body {
        font-family: 'Source Sans Pro', sans-serif;
  font-size: 13px;
}
fieldset {
  border: 1px solid black;
}
.expand {
    height: 1em;
    width: 100px;
    padding: 3px;
    -webkit-transition: all 1s linear;
    -0-transition: all 0.2s linear;
    -ms-transition: all 0.2s linear;
    -moz-transition: all 0.2s linear;
    transition: all 0.2s linear;
}

.expand:focus {
    width: 150px;
    -webkit-transition: all 0.2s linear;
    -0-transition: all 0.2s linear;
    -ms-transition: all 0.2s linear;
    -moz-transition: all 0.2s linear;
    transition: all 0.2s linear;
}â€‹
.m ul {
  list-style: none;
  text-align: right;
  z-index: 99999999999999999999999999;
}
.m ul li {
  display: block;
  position: relative;
  text-align: left;
  z-index: 99999999999999999999999999;
}
.m li ul { display: none; }
.m ul li a {
  display: block;
  text-decoration: none;
  color: #ffffff;
  border-top: 1px solid #ffffff;
  padding: 5px 15px 5px 15px;
  background: #2C5463;
  margin-left: 1px;
  text-align: right;
  white-space: nowrap;
  z-index: 99999999999999999999999999;
}
.m ul li a:hover { background: #617F8A; }
.m li:hover ul {
  display: block;
  position: absolute;
  list-style-type: none;
  z-index: 99999999999999999999999999;
}
.m li:hover li {
  float: none;
  font-size: 11px;
  text-align: right;
  z-index: 99999999999999999999999999;
}
.m li:hover a { background: #617F8A; }
.m li:hover li a:hover { background: #95A9B1; }

#btn {
  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  font-family: Arial;
  color: #ffffff;
  font-size: 20px;
  background: #008000;
  padding: 0px 10px 0px 10px;
  text-decoration: none;
}

#btn:hover {
  background: #3cfc53;
  text-decoration: none;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
</style>

</head>
<body bgcolor="#f5f5f5">
<?php
if ($logged==true){
  ?>

 <?php
}
?>
<div style="box-shadow: 0 2px 4px rgb(0 0 0 / 23%);position: fixed; z-index: 99999999;  left: 0px; top: -1px; width: 100%; height: 51px; background-color: rgb(20, 133, 209) ; color: white;background: /*linear-gradient(#285cb1, #122c57);*/">
<a href="/"></a>
<ul id="navbar3">
<li><a href="/"><img src="/assets/G.png" border="0" style="top: -12px; z-index: 99999999; margin-left: 3px; position: absolute;height:48px;right:430px;" /></a></li>
<li><a href="/Home.php"><font face=Arial>Home</a></li>
<li><a href="/Store/">Store</a></li>
<li><a href="/Players.php">Users</a></li>
<li><a href="/Communities/">Groups</a></li>
<li><a href="/Forum/">Forum</a></li>
  <title>Gravitar</title>
        <meta name="description" content="Gravitar! Customize your avatar, make items, and more!">


    </ul>
    </li>
 </ul>
</font>
</ul>
<?php
if ($logged == true){
  ?>
<div style="padding:0.5rem;position: fixed; left: 0px; top: 50px; width: 100%; height: 30px; background-color: rgb(60, 68, 187) ; z-index: 99999999; color: white;/*background: linear-gradient(#285cb1, #122c57);*/border-top:0px solid white;box-shadow: 0 2px 4px rgb(0 0 0 / 23%);">
<ul id="navbar2">
<li><a href="/Profile.php">Profile</a></li>
<li><a href="/Wardrobe/">Avatar</a></li>
<li><a href="/assets/Badges/">Badges</a></li>
<li><a href="/Money"><img src="/assets//reebs.png" height="10" width="10" />&nbsp; <?php print_r($user['Reebs']); ?></a></li>
<li><a href="/Money"><img src="/assets///bucks.png" height="10" width="10" />&nbsp; <?php print_r($user['Bucks']); ?></a></li>
<li><a href="/Trade/">Trades</a></li>


<?php
if ($user['powerCM'] != 0 || $user['powerForumMod'] != 0 || $user['powerHeadMod'] != 0 || $user['powerImageMod'] || $user['powerAdmin'] != 0){ ?><li><a href="/Administration/index.php"><img src="/assets/settings2.png" height="15" width="15"> (<?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `shop` WHERE `accepted`='0' ORDER BY id")) + mysql_num_rows(mysql_query("SELECT * FROM `Report_User` ORDER BY id"))); ?>) </a></li><?php } ?>
<li><a href="/Inbox<?php
if ($user['Membership'] == '1'){
  echo'2';
 
}
?>/"><img src="/assets/Messages.png" height="15" width="15"> (<?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `messages` WHERE `toid`='$uid' AND `read`='0' ORDER BY id"))); ?>)</a></li>
<li><a href="/FriendRequests.php"><img src="/assets/FR_icon.png" height="15" width="15"> (<?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `friends` WHERE `withid`='$uid' AND `request`='0' ORDER BY id"))); ?>)</a></li>
<?php
if ($user['Membership'] == '2'){ ?><li><a href="/Money"><img src="/assets/reebs.png" />&nbsp;<?php print_r($user['Reebs']); ?></a></li><?php } ?>
<li><a href="/Account/index.php"><img src="/assets/settings.png" height="15" width="15"></a></li>
<li><a href="/Login/logout.php"><img src="/assets/logout.png" height="15" width="15"></a></li>

</ul>
</div></div>
<br />
<?php
}
if ($logged == false){
  ?>
    </ul>
    </div>
    <?php
}
?><br /><br /><br />
<?php
$shout = mysql_fetch_object($q = mysql_query("SELECT * FROM `shout`"));
if ($shout->{'shout'} != ''){
$color = mysql_fetch_object($q = mysql_query("SELECT * FROM `shout`"));
if ($color->{'color'} != '')
  ?>
    <?php
if ($logged == true){
  ?>
<br><div style="z-index: 99999999;font-size:15px;position: fixed;left:0px;font-weight: 600; padding-left: 30px; width: 100%; padding: 4px; border: 0px solid black; border-radius: 0px; background-color: <?php print_r($color->{'color'}); ?>; color: white; margin-left: 0px; margin-right: 0px;box-shadow: 0 2px 4px rgb(0 0 0 / 23%);">
<center><b>
    <?php
  print_r($shout->{'shout'});
  ?>
</center>
</b>
  </div>
  <center>
  
  <br />
  <br />
  </center>
    <?php
}
?>

  
<?php
if ($logged == false){
  ?>
<br><div style="z-index: 99999999;top:50px;font-size:15px;position: fixed;left:0px;font-weight: 600; padding-left: 30px; width: 100%; padding: 4px; border: 0px solid black; border-radius: 0px; background-color: <?php print_r($color->{'color'}); ?>; color: white; margin-left: 0px; margin-right: 0px;box-shadow: 0 2px 4px rgb(0 0 0 / 23%);">
<center><b>
    <?php
  print_r($shout->{'shout'});
  ?>
</center>
</b>
  </div>
  <center>
  
  <br />
  <br />
  </center>
    <?php
}}
?>
 
  
  
  
<br />

<title>Gravitar</title><br />
    <?php
  if ($logged==true){
    if ($user['hide'] == '1'){
      ?>
            <h2>You're browsing incognito! Go to <a href="/Account/">My Account</a> and select "Off" to turn off incognito mode.</h2>
            <?php
    }
  }
  $f = mysql_fetch_array(mysql_query("SELECT * FROM `ads` WHERE `running`='1' ORDER BY RAND()"));
  $sel = $f;
  ?>
   <center><a href="/<?php
  if ($sel['type'] == '1'){
    ?>Profile.php<?php
  }
  ?>?id=<?php print_r($sel['onid']); ?>">
    </a></center><br />



