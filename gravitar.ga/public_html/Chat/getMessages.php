<?php $con = mysql_pconnect("mysql.ct8.pl", "m27001_gravitar", "Sg090228") or die("Something went wrong while connecting to the database - ID: 1");
mysql_select_db("m27001_gravitar", $con) or die("Something went wrong while connecting to the database - ID: 2");?>
<?php function drawCharacter($idd, $width = 100, $height = 195){
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
      echo "online";
    }else{
      echo "offline";
    } ?>.png'); padding: 0px;position: absolute;z-index: 3999; z-index: 999999999999999999999999999999999;"></div>
       <?php
     if ($check['Membership'] == '1'){
       ?> <img src="/assets/premium.png" style="position: absolute; margin-left: -40px; margin-top: <?php print_r($height - 20); ?>px; z-index: 3999;" /><?php
     }
     ?>
         <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>;z-index:2; position: absolute;background-image:url('/assets/Avatars/<?php echo($type); ?>');padding:0px;"></div>
          <div style="width: <?php echo($width); ?>; height: <?php echo($height); ?>;position: absolute;z-index:0;  background-image:url('/assets/Avatars/Shadow.png');"></div>
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
} ?>
<?php
$f = mysql_query("SELECT * FROM `lechat` ORDER BY id DESC LIMIT 5");
$ff = mysql_num_rows($f);
for ($count = 1; $count <= $ff; $count ++){
  $fr = mysql_fetch_array($f);
  $memberid = $fr['memberid'];
  $member = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$memberid'"));
  ?>
    <tr>
    <td width="200" style="text-align: center;">
    <center><?php drawCharacter($memberid, 100, 100); ?></center><br>
    <a href="/Profile.php?id=<?php print_r($memberid); ?>"><?php print_r($member['Username']); ?></a>
    </td>
    <td style="/*text-align: center;*/">
    <textarea disabled style="color: black; background-color: #fff; border: 0px solid #333; border-radius: 3px;  margin-top: 0; width: 50%; height: auto;text-align:left;"><?php print_r($fr['comment']); ?></textarea>
    <?php
  if ($logged==true){
    if ($user['powerHeadMod'] == '1' || $user['powerCM'] == '1' || $user['Username'] == 'Syncro'){
      ?><!--<a href="?id=<?php print_r($id); ?>&scrub=<?php print_r($fr['id']); ?>">Scrub Comment</a> | <a href="?id=<?php print_r($id); ?>&remove=<?php print_r($fr['id']); ?>">Remove Comment</a>--><?php
    }
  }
  ?>
    </td>
    </tr>
    <?php
}
?>