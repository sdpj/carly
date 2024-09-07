<?php
include('../global.php');
if ($logged == false){
  die("You're not logged in!");
}
$featured = false;
if ($user['powerArtist'] != '0' || $user['Username'] == 'AvatarLife'){
  $featured = true;
}
$allowedExts = array("png", "png", "png", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ($_FILES['file']){
if ((($_FILES["file"]["type"] == "image/png") ||
($_FILES["file"]["type"] == "image/png") ||
($_FILES["file"]["type"] == "image/png") ||
($_FILES["file"]["type"] == "image/png")
)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    die( "Oops! That's an unsupported file type. Uploads must be .png files with a transparent background and must not have the template still on them.");
    }

    
      if ($_POST['name'] && $_POST['description'] && $_POST['price'] && $_POST['type'] && $_POST['pricetype']){
        $name = $_POST['name'];
        $desc = $_POST['description'];
        $pric = $_POST['price'];
        if ($pric < 0){
          die("You can't sell an item for less than nothing!");
        }
        $upty = mysql_real_escape_string($_POST['type']);
        $hasher = hash("ripemd160", $_FILES['file']['name'] . rand() . $name);
        $typ  = $_POST['pricetype'];
        if ($typ == 'Reebs' || $typ == 'Bucks'){
        $limited = 0;
        $islimited = 0;
        if ($logged == true){
          if  ($user['limiteds'] == '0' || $user['powerartist'] != '0'){
          $limitedr =$_POST['limited'];
          if (!$limitedr){
            $islimited = 0;
            $limited = 0;
          }else{
            $limited = $limitedr;
            $islimited = 1;
          }
          }
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../assets/Avatars/" . $upty . "/" . $hasher);
    $path = $upty . "/" . $hasher;
    $ui = $user['id'];
    if ($featured == true){
      if ($typ == 'Bucks'){
    mysql_query("INSERT INTO `shop` (`Name`, `Description`, `creatorid`, `path`, `price`, `type`, `islimited`, `remaining`, `rare`, `ismain`) VALUES ('$name', '$desc', '$ui', '$path', '$pric', '$upty', '$islimited', '$limited', '$rare', '1')") or die(mysql_error());
      }else{
         mysql_query("INSERT INTO `shop` (`Name`, `Description`, `creatorid`, `path`, `reebprice`, `type`, `islimited`, `remaining`, `rare`, `ismain`) VALUES ('$name', '$desc', '$ui', '$path', '$pric', '$upty', '$islimited', '$limited', '$rare', '1')") or die(mysql_error());
      }
    }else{
      if ($typ == 'Bucks'){
      mysql_query("INSERT INTO `shop` (`Name`, `Description`, `creatorid`, `path`, `price`, `type`, `islimited`, `remaining`, `rare`) VALUES ('$name', '$desc', '$ui', '$path', '$pric', '$upty', '$islimited', '$limited', '$rare')") or die(mysql_error());
      }else{
        die("You cannot set the price as reebs!");
      }
    }
    $getuploaded = mysql_fetch_array(mysql_query("SELECT * FROM `shop` WHERE `path`='$path' AND `creatorid`='$ui' AND `Name`='$name'"));
          mysql_query("INSERT INTO `inventory` (`ownerid`, `name`, `itemid`, `path`, `type`) VALUES ('$ui', '$name', '$getuploaded[id]', '$path', '$upty')") or die(mysql_error());
    
    die("Thanks for uploading your item!");
      }
        }
    
  }
}
else
  {
  echo "Some seems to have gone wrong... Try again later!";
  }
}
?>
<table width="98%">
<tr>
<td width="80%" style="text-align:center;font-size: 1.5rem; font-weight: 600;color: #333;background-color: rgb(126, 180, 231);border-bottom: 2px solid #4a85c0;border-top-left-radius: 4px;border-top-right-radius: 4px;">
Upload Item
</td>
<td style="text-align:center;font-size: 1.5rem; font-weight: 600;color: #333;background-color: rgb(126, 180, 231);border-bottom: 2px solid #4a85c0;border-top-left-radius: 4px;border-top-right-radius: 4px;">
Template
</td>
</tr>
<tr>
<td width="80%" style="border-radius: 5px; box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);background-color:#fff;border-top-left-radius:0px;border-top-right-radius: 0px;">
<!--<h1>Hi, <?php print_r($user['Username']); ?>, you are uploading to the <?php if ($featured == true){ print_r("featured tab!"); }else{ print_r("user store!"); } ?></h1>--><br>
<form action="" method="post"
enctype="multipart/form-data">
<table><tr><td><label for="file">File</label></td><td><input type="file" name="file" id="file"></td></tr>
<tr><td>Type</td><td><select name="type">
<?php
if ($user['Membership'] == 1){
  ?>
    
    <?php
}
if ($featured == true){
  ?>
   
    <?php
}
?><script></script>
<option>Hat</option>
<option>Background</option>
<option>Accessory</option>
<option>Shirt</option>
<option>Pants</option>
<option>Face</option>
<option>Shoe</option>

</select></td></tr>
<tr><td>Name</td><td><input type="text" name="name" /></td></tr>
<tr><td>Description</td><td><textarea name="description"> </textarea></td></tr>
<tr><td>Price</td><td><input type="number" min="0" name="price" />&nbsp;&nbsp;<select name="pricetype"><option>Bucks</option><option>Reebs</option></select></td><td></td></tr>

<?php
if ($featured == true){
  ?>
     <tr><td>Amount to go around (Leave 0 for non limited)</td><td><input type="number" name="limited" /></td></tr>
    <?php
}
?>
<tr><td>
<input type="submit" value="Create" id="buttonsmall" style="display:block;text-align:center;/*background-color: #04AA6D;*/ border: none; color: white; cursor: pointer; border-radius: 5px;" /></td>
</tr>
</table>
</form>
<br>
<h6 style="color: #aaa;font-weight:normal;">Before uploading an item, please make sure that it follows our Terms and Conditions.</h6>
</td>
<td style="text-align:center;border-radius: 5px; box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);background-color:#fff;border-top-left-radius:0px;border-top-right-radius: 0px;">
<img src="/assets/Avatars/Default.png" />
<br>Reminder: Delete the template layer before saving your item!
</td>
</tr>
</table>
<br><br><?php
include "../Footer.php";
?>