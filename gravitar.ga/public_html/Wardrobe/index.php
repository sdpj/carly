<?php
include('../global.php');
if ($logged == false){
  die("You're not logged in!");
}
if ($_GET['pickColor']){
  $type = mysql_real_escape_string($_GET['pickColor']);
  $color = 0;
  if ($type == '1'){
    $color = 0;
  }elseif ($type == '2'){
    $color = 1;
  }elseif ($type == '3'){
    $color = 2;
  }elseif ($type == '4'){
    $color = 4;
  }
  mysql_query("UPDATE `accounts` SET `color`='$color' WHERE `id`='$uid'");
  ?>
    <script>window.location = 'index.php';</script>
    <?php
}
$page = 1;
if ($_GET['page']){
  $page = mysql_real_escape_string($_GET['page']);
}
if ($page > 1){
  $startFrom = ($page - 1 * 20);
}else{
  $startFrom = 0;
}
$choice = 1;
if ($_GET['choice']){
  $choice = mysql_real_escape_string($_GET['choice']);
  if ($choice > 10){
    die("Invalid choice.");
  }
}
if ($_GET['wear']){
  $id = mysql_real_escape_string($_GET['wear']);
  $get = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id`='$id'"));
  if ($get != 0){
    if ($get['ownerid'] == $uid){
      $itemid = $get['itemid'];
      $arr = mysql_fetch_array(mysql_query("SELECT * FROM `shop` WHERE `id`='$itemid'"));
      if ($arr != 0){
        $type = $arr['type'];
        $path = $arr['path'];
        if ($type == 'Hat'){
          mysql_query("UPDATE `accounts` SET `HairPath`='$path' WHERE `id`='$uid'");
        }elseif ($type == 'Shirt'){
          mysql_query("UPDATE `accounts` SET `ShirtPath`='$path' WHERE `id`='$uid'");
          }elseif ($type == 'Pet'){
          mysql_query("UPDATE `accounts` SET `PetPath`='$path' WHERE `id`='$uid'");
        }elseif ($type == 'Pants'){
          mysql_query("UPDATE `accounts` SET `PantsPath`='$path' WHERE `id`='$uid'");
        }elseif ($type == 'Face'){
          mysql_query("UPDATE `accounts` SET `MouthPath`='$path' WHERE `id`='$uid'");
        }elseif ($type == 'Shoe'){
          mysql_query("UPDATE `accounts` SET `ShoesPath`='$path' WHERE `id`='$uid'");
        }elseif ($type == 'Face'){
          mysql_query("UPDATE `accounts` SET `FacePath`='$path' WHERE `id`='$uid'");
        }elseif ($type == 'Accessory'){
          mysql_query("UPDATE `accounts` SET `Accessories`='$path' WHERE `id`='$uid'");
        }elseif ($type == 'Background'){
          mysql_query("UPDATE `accounts` SET `Background`='$path' WHERE `id`='$uid'");
        }
      }
    }
  }
}
if ($_GET['unwear']){
  $id = mysql_real_escape_string($_GET['unwear']);
  $get = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `id`='$id'"));
  if ($get != 0){
    if ($get['ownerid'] == $uid){
      $itemid = $get['itemid'];
      $arr = mysql_fetch_array(mysql_query("SELECT * FROM `shop` WHERE `id`='$itemid'"));
      if ($arr != 0){
        $type = $arr['type'];
        $path = $arr['path'];
        if ($type == 'Hat'){
          mysql_query("UPDATE `accounts` SET `HairPath`='' WHERE `id`='$uid'");
        }elseif ($type == 'Shirt'){
          mysql_query("UPDATE `accounts` SET `ShirtPath`='' WHERE `id`='$uid'");
        }elseif ($type == 'Pants'){
          mysql_query("UPDATE `accounts` SET `PantsPath`='' WHERE `id`='$uid'");
        }elseif ($type == 'Pet'){
          mysql_query("UPDATE `accounts` SET `PetPath`='' WHERE `id`='$uid'");
        }elseif ($type == 'Eye'){
          mysql_query("UPDATE `accounts` SET `EyesPath`='' WHERE `id`='$uid'");
        }elseif ($type == 'Shoe'){
          mysql_query("UPDATE `accounts` SET `ShoesPath`='' WHERE `id`='$uid'");
        
        }elseif ($type == 'Face'){
          mysql_query("UPDATE `accounts` SET `MouthPath`='' WHERE `id`='$uid'");
        
        }elseif ($type == 'Accessory'){
          mysql_query("UPDATE `accounts` SET `Accessories`='' WHERE `id`='$uid'");
        }elseif ($type == 'Background'){
          mysql_query("UPDATE `accounts` SET `Background`='' WHERE `id`='$uid'");
        }
      }
    }
  }
}
if ($choice != 1){
  if ($choice == 2){
    $type = "Hat";
  }elseif ($choice == 3){
    $type = "Shirt";
  }elseif ($choice == 4){
    $type = "Pants";
  }elseif ($choice == 5){
    $type = "Accessory";
  }elseif ($choice == 6){
    $type = "Background";
  }elseif ($choice == 7){
    $type = "Shoe";
  }elseif ($choice == 8){
    $type = "Eye";
  }elseif ($choice == 9){
    $type = "Face";
  }elseif ($choice == 10){
    $type = "Pet";
  }else{
    die("Error.");
  }
  $q = mysql_query("SELECT * FROM `inventory` WHERE `type`='$type' AND `ownerid`='$uid' ORDER BY id DESC LIMIT $startFrom, 60000");
}
?>
<div style="width: 98%; padding: 3px; border: 1px solid #333; background-color: #FFFFFF; color: black; text-align: center;">My Wardrobe</div><br>
<div style="width: 98%; padding: 3px; border: 1px solid #333; background-color: #FFFFFF; color: black; text-align: center; vertical-align: central;">
<table width="98%"><tr><td width="100">
<?php
drawCharacter($user['id']);
?>
</td>
<td>

<table width="98%">
<?php
if ($choice == 1){ echo'
  
  
  
  <td style="text-align: center;"><a href="/Store/Item.php?id=21"><img src="/assets/Avatars/Default.png" border="0"><br>White Body</a><br>
        <a href="?pickColor=1&amp;choice=1">[Wear]</a>
        </td>
  
  
  <td style="text-align: center;"><a href="/Store/Item.php?id=21"><img src="/assets/Avatars/Default2.png" border="0"><br>Black Body</a><br>
        <a href="?pickColor=2&amp;choice=1">[Wear]</a>
        </td>';
  
  
  
  
  
  
  //<a href="?pickColor=1"><!--<button style="background-color:#ffdfbd;padding:10px;border:1px solid black;margin-right:5px;"></button>--><td style="text-align: center;"><a href="?pickColor=2"><img src="/assets/Avatars//Default.png"></td>[Wear]</a><!--<button style="background-color:#642508;padding:10px;border:1px solid black;margin-right:5px;"></button>--><td style="text-align: center;"><img src="/assets/Avatars//Default2.png"></td></a>';
  ?>
<tr>
<td>

</tr>
<?php
}else{
  ?>
    <tr>
    <?php
  $i = 0;
  $qq = mysql_num_rows($q);
  for ($count = 1; $count <= $qq; $count ++){
    $qr = mysql_fetch_object($q);
    $i ++;
    ?>
        <td style="text-align: center;"><a href="/Store/Item.php?id=<?php print_r($qr->{'itemid'}); ?>"><img src="/assets/Avatars/<?php print_r($qr->{'path'}); ?>" border="0" /><br><?php print_r($qr->{'name'}); ?></a><br>
        <a href="?wear=<?php print_r($qr->{'id'}); ?>&choice=<?php print_r($choice); ?>">[Wear]</a><br />
        <a href="?unwear=<?php print_r($qr->{'id'}); ?>&choice=<?php print_r($choice); ?>">[Unwear]</a>
        </td>
        <?php
    if ($i == 5){
      echo '</tr><tr>';
      $i = 0;
    }
  }
  ?>
    </tr>
    <?php
}
?>
</table>
</div>
</td><td>
<td>
<div style="padding: 4px; border: 1px solid #000; background-color: white;">
<div style="width:94%; padding: 4px; background-color: #2D81BA; border: 1px solid #2D81BA; color: white; text-align: center;">My Stuff</div><br>
<center>
<style>#buttonsmall{/*width:40px;*/}</style>
<a href="?choice=1" id="buttonsmall">Body Colors</a><br><br>
<a href="?choice=2" id="buttonsmall">Hats / Hair</a><br><br>
<a href="?choice=9" id="buttonsmall">Faces</a><br><br>
<a href="?choice=3" id="buttonsmall">Shirts</a><br><br>
<a href="?choice=4" id="buttonsmall">Pants</a><br><br>
<a href="?choice=5" id="buttonsmall">Accessories</a><br><br>
<a href="?choice=6" id="buttonsmall">Backgrounds</a><br><br>
<a href="?choice=7" id="buttonsmall">Shoes</a><br /><br>

</center>
</div>
</td>
</td>
</tr>
</table>