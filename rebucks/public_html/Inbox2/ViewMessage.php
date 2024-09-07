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
<div style="width: 98%; padding: 5px; border: 1px solid black; background-color: #E5E5E5; color: black;">
<table width="98%"><tr>
<td width="150" style="text-align: center; vertical-align: text-top;">
<center><?php drawCharacter($check['fromid'], 100, 180); ?></center><br />
<a href="/Profile.php?id=<?php print_r($senderId); ?>"><?php print_r($senderArray['Username']); ?></a>
</td>
<td style="text-align: left;">
<textarea disabled style="background-color: white; color: black; border: none; margin: 2px; width: 895px; height: 496px;">
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
<a href="index.php" id="buttonsmall">&laquo; Back to Inbox</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="SendMessage.php?reply=<?php print_r($check['id']); ?>" id="buttonsmall">Reply</a>
</center>
</div>