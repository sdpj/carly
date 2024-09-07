<?php
include('../global.php');
$id = 0;
if ($_GET['id']){
  $id = mysql_real_escape_string($_GET['id']);
  if ($id < 1){
    die("That id is invalid.");
  }
}else{
  die("No id was given.");
}
$get = mysql_fetch_array(mysql_query("SELECT * FROM `shop` WHERE `id`='$id'"));
if ($get == 0){
  die("That item doesn't exist.");
}
if ($_GET['buy']){
  $uid = $user['id'];
  $type = 'Bucks';
  if ($get['price'] == '0'){
    $type = 'Reebs';
  }
  if ($type == 'Bucks'){
    if ($user['Bucks'] < $get['price']){
      die("Not enough bucks!");
    }
  }else{
    if ($user['Reebs'] < $get['reebprice']){
      die("Not enough Tokens!");
    }
  }
  if ($get['islimited'] != '0'){
    if ($get['remaining'] < 1){
      die("Sold out!");
    }
  }
  $name = addslashes($get['Name']);
  $creatorid = $get['creatorid'];
  $type = $get['type'];
  $path = $get['path'];
  $allow = true;
  $k = mysql_fetch_array(mysql_query("SELECT * FROM `inventory` WHERE `itemid`='$id' AND `ownerid`='$uid'"));
  if ($k != 0){
    $allow = false;
  }
  if ($allow == false){
    die("You already own this item!");
  }
  if ($get['islimited'] != 0){
    mysql_query("UPDATE `shop` SET `remaining`=`remaining`-'1' WHERE `id`='$id'");
  }
  if ($get['price'] != '0'){
    $price = $get['price'];
    mysql_query("UPDATE `accounts` SET `Bucks`=`Bucks`-'$price' WHERE `id`='$uid'") or die(mysql_error());
    mysql_query("UPDATE `accounts` SET `Bucks`=`Bucks`+'$price' WHERE `id`='$creatorid'") or die(mysql_error());
  }else{
    $price = $get['reebprice'];
    mysql_query("UPDATE `accounts` SET `Reebs`=`Reebs`-'$price' WHERE `id`='$uid'") or die(mysql_error());
    mysql_query("UPDATE `accounts` SET `Reebs`=`Reebs`+'$price' WHERE `id`='$creatorid'") or die(mysql_error());
  }
  mysql_query("UPDATE `shop` SET `numbersold`=`numbersold`+'1' WHERE `id`='$id'");
  mysql_query("INSERT INTO `inventory` (`ownerid`, `name`, `itemid`, `path`, `type`) VALUES ('$uid', '$name', '$id', '$path', '$type')") or die(mysql_error());
  echo "Thanks for purchasing that item, it is now in your inventory for you to wear it!";
}
$creoid = $get['creatorid'];
$creatorarray = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$creoid'"));
?>
<table width="98%">
<tr>
<td width="98%" style="border: 1px solid black;">
<?php
print_r($get['Name']);
?>, an item by <a href="/Profile.php?id=<?php print_r($creoid); ?>"><?php print_r($creatorarray['Username']); ?></a>.
</td>
</tr>
</table>
<table width="98%">
<tr>
<td width="200" style="border: 1px solid black; vertical-align: central; text-align: center;">
<img src="/assets/Avatars/<?php print_r($get['path']); ?>" />
</td>
<td>
<table width="98%">
<tr>
<td style="border: 1px solid black; text-align: center;">
<?php print_r($get['Name']); ?><br>
<center><?php drawCharacter($creoid, 100, 140); ?></center><br>
<a href="/Profile.php?id=<?php print_r($creoid); ?>"><?php print_r($creatorarray['Username']); ?></a>
<br>
Price: <?php
if ($get['price'] == '0'){
  print_r("<font color='#FF6600'>" . $get['reebprice'] . " Gold Coins</font>");
}else{
  print_r("<font color='#009900'>" . $get['price'] . " Bucks</font>");
} ?>
<br>
Number Sold: <?php print_r($get['numbersold']); ?><br>
Description:<br>
<textarea disabled style="border: 1px solid black; color: black; background-color: white; font-family: Verdana, Geneva, sans-serif; margin: 2px; height: 96px; width: 265px;"><?php print_r($get['Description']); ?></textarea><br>
<?php
if ($get['islimited'] == '1'){
  print_r($get['remaining'] . " Remaining.<br>");
}
?>
Created: <?php print_r($get['Created']); ?>
</td>
<td style="border: 1px solid black; vertical-align: central; text-align: center;">
<a href="?id=<?php print_r($id); ?>&buy=true" id="buttonsmall">Purchase Item</a>
<?php
$naim = $get['creatorid'];
if ($logged==true){
  if ($user['id'] == $naim){
    ?>
        <a href="/Store/EditItem.php?id=<?php print_r($id); ?>">[ Edit Item ]</a>
        <?php
  }
}
?>
<?php
if ($logged==true){
  if ($user['powerImageMod'] == '1' || $user['powerCM'] == '1' || $user['powerHeadMod'] == '1'){
    if ($_GET['delete']){
      mysql_query("DELETE FROM `shop` WHERE `id`='$id'");
      mysql_query("DELETE FROM `inventory` WHERE `itemid`='$id'");
      message("Done", "Deleted.", "index.php", "Back", false, '');
    }
    ?>
        <a href="?id=<?php print_r($id); ?>&delete=true">[ Delete Item ]</a>
        <?php
  }
}
?>
</td>
</tr>
</table>
</td>
</tr>
</table><br />
  <table width="98%">
    <tr>
   <td>

    </td>
    <td>

<?php


if ($logged==true){
  if ($_POST['comment']){
    $comment = strip_tags(nl2br(mysql_real_escape_string($_POST['comment'])));
    mysql_query("INSERT INTO `itemComments` (`itemid`, `comment`, `authorid`) VALUES ('$id', '$comment', '$uid')");
    message("Done", "Comment posted.", "?id=" . $id, "Back", false, '');
    die();
  }
}
?>
<br />
<fieldset>
<legend>Item Comments</legend>
<table>
<tr>
<td>
<form action="?id=<?php print_r($id); ?>" method="post">
<textarea style="border-top-left-radius: 1%; border-top-right-radius: 1%; border-bottom-right-radius: 1%; border-bottom-left-radius: 1%; margin: 2px; width: 995px; height: 78px;" name="comment" <?php
if ($logged==false){
  ?>placeholder="You must be logged in to write a comment.." disabled<?php }else{ ?>placeholder="Write a comment.."<?php } ?>></textarea><br />
<input type="submit" id="buttonsmall" value="Post Comment" />
</form>
</td>
</tr>
</table><br />
<table width="98%">
<?php
$c = mysql_query("SELECT * FROM `itemComments` WHERE `itemid`='$id' ORDER BY id DESC");
$cc = mysql_num_rows($c);
for ($count = 1; $count <= $cc ;$count ++){
  $cr = mysql_fetch_array($c);
  $commenterid = $cr['authorid'];
  $commenter = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$commenterid'"));
  ?>
  <tr>
    <td width="150">
    <center>
    <a href="/Profile.php?id=<?php print_r($commenterid); ?>">
    <?php
  drawCharacter($commenterid, 100, 140);
  ?><br />
    <?php print_r($commenter['Username']); ?>
  </a>
    </center>
    </td>
    <td>
    <textarea style="margin: 2px; background-color: white; color: black; font-family: verdana; width: 894px; height: 145px;" disabled><?php print_r($cr['comment']); ?></textarea>
    </td>
    </tr>
    <?php
}
?></table>
</fieldset>
      <br><br><?php
include "../Footer.php";
?>