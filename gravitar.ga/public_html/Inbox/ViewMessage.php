<?php
include('../global.php');
if ($logged == false){
  die("You're not logged in!");
}
if ($_GET['id']){
  $id = mysql_real_escape_string($_GET['id']);
  $check = mysql_fetch_array(mysql_query("SELECT * FROM `messages` WHERE `id`='$id'"));
  if ($check == 0){
    die("That message doesn't exist!");
  }
  if ($check['toid'] != $user['id']){
    die("You do not have permission to read that message!");
  }
  $senderId = $check['fromid'];
  $senderArray = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$senderId'"));
  mysql_query("UPDATE `messages` SET `read`='1' WHERE `id`='$id'");
}else{
  die("That message does not exist!");
}
?>
<h1 style="margin:0px;text-align:center;font-weight:normal;"><?php
print_r(filterBadWords(htmlspecialchars(nl2br($check['subject']))));
?></h1><br>
<div style="width: 98%; padding: 5px; box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);border-radius:5px;border: 0px solid black; color: black; background-color: white; padding: 8px; vertical-align: text-top; padding: 10px; vertical-align: text-top; color: black;">
<table width="98%"><tr>
<td width="150" style="text-align: center; vertical-align: text-top;">
<center><div style="background-color:white;border:0px solid black;"><?php drawPFP($check['fromid'], 100, 190); ?></center>
<a href="/Profile.php?id=<?php print_r($senderId); ?>"><?php print_r($senderArray['Username']); ?></a>
</td></div>
<td style="text-align: left;">
<textarea disabled style="background-color: white; color: black; box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);
    border-radius: 5px; margin: 2px; width: 98%; height: 465px; border: 0px;">
<?php
print_r(filterBadWords(strip_tags(nl2br($check['body']))));
?>
</textarea>
</td>
</tr>
</table>
<br>
<center>
<?php
if ($check['attachedBucks'] != 0){
  if ($_GET['claim']){
    mysql_query("UPDATE `accounts` SET `Bucks`=`Bucks`+'$check[attachedBucks]' WHERE `id`='$uid'");
    mysql_query("UPDATE `messages` SET `attachedBucks`='0' WHERE `id`='$id'");
    message("Done", "Your bucks were claimed.", "index.php", "Back to inbox", false, '');
    die();
  }
  ?>
    Attached Bucks: <?php print_r($check['attachedBucks']); ?> <a href="?id=<?php print_r($id); ?>&claim=true">[Claim]</a><br />
    <?php
}
?>
<a href="SendMessage.php?reply=<?php print_r($check['id']); ?>" id="buttonsmall" style="border-radius: 5px;
    background-color: #04AA6D;
    transition-duration: 0s; display:block; text-align:center; margin:auto; width: 97%;">Reply</a>
</center>
</div>
<div style="height:20px;"></div>
<?php
include('../Footer.php');
?>