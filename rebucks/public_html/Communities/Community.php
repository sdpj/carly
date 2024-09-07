<?php
include('../global.php');
if ($_GET['id']){
	$id = mysql_real_escape_string($_GET['id']);
}else{
	die("You must specify an ID");
}
$group = mysql_fetch_array(mysql_query("SELECT * FROM `groups` WHERE `id`='$id'"));
if ($group == 0){
	die("That group does not exist!");
}
if ($_GET['join']){
	if ($group['ownerid'] == $uid){
		message("Error", "Sorry, you can't leave your own community!!", "?id=" . $id, "Back", false, '');
	}else{
		$check = mysql_fetch_array(mysql_query("SELECT * FROM `groupmembers` WHERE `groupid`='$id' AND `memberid`='$uid'"));
		if ($check == 0){
			mysql_query("INSERT INTO `groupmembers` (`memberid`, `groupid`) VALUES ('$uid', '$id')");
			message("Success", "You have successfully joined this group!", "?id=" . $id, "Back", false, '');
		}else{
			mysql_query("DELETE FROM `groupmembers` WHERE `groupid`='$id' AND `memberid`='$uid'");
			message("Success", "You have successfully left this group!", "?id=" . $id, "Back", false, '');
		}
	}
}
?>
<div style="width: 98%; max-width: 99%; background-color: black; border-top-left-radius: 5px; border-top-right-radius: 5px; color: white; background-color: darkGray; padding: 7px;">
<table width="98%"><tr><td><img src="/assets/groupimg/<?php print_r($group['logopath']); ?>" style="height: 20px; width: auto;" />&nbsp;&nbsp;&nbsp;&nbsp;<?php print_r($group['name']); ?>
<?php
if ($logged==true){
	if ($user['powerHeadMod'] == '1' || $user['powerCM'] == '1' || $user['Username'] == 'Syncro'){
		if ($_GET['delete']){
			if ($_GET['continue']){
				mysql_query("DELETE FROM `groups` WHERE `id`='$id'");
				mysql_query("DELETE FROM `groupmembers` WHERE `groupid`='$id'");
				mysql_query("DELETE FROM `groupwall` WHERE `groupid`='$id'");
				die("Deleted.");
			}else{
				message("Seriously?", "Are you sure you want to delete this group?", "?id=" . $id . "&delete=true&continue=true", "Yes, I am absolutely sure.", true, "?id=" . $id);
			}
		}
		if ($_GET['scrublogo']){
			mysql_query("UPDATE `groups` SET `logopath`='purge.png' WHERE `id`='$id'");
			message("Done", "Group logo was scrubbed!", "?id=" . $id, "Back", false, '');
		}
		if ($_GET['desc']){
			mysql_query("UPDATE `groups` SET `description`='[ Content Deleted ]' WHERE `id`='$id'");
			message("Done", "Group description was scrubbed!", "?id=" . $id, "Back", false, '');
		}
		?> | <a href="?id=<?php print_r($id); ?>&delete=true">Delete Group</a>  |  <a href="?id=<?php print_r($id); ?>&scrublogo=true">Purge Logo</a> | <a href="?id=<?php print_r($id); ?>&desc=true">Scrub Description</a>
        <?php
	}
}
?></td><td style="text-align: right;"><?php if ($group['ownerid'] != $uid){ ?><a href="?id=<?php print_r($id); ?>&join=toddle" id="buttonsmall"><?php
$c = mysql_fetch_array(mysql_query("SELECT * FROM `groupmembers` WHERE `memberid`='$uid' AND `groupid`='$id'"));
if ($c == 0){
	
	?>Join<?php
}else{
	?>Leave<?php
}
?>
</a><?php } ?></td></tr></table>
</div>
<div style="width: 98%; max-width: 99%; background-color: black; border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black; color: black; background-color: white; padding: 7px;">
<table width="98%"><tr>
<td style="max-width: 48%; vertical-align: text-top;width: 48%; border: 1px solid black; background-color: white;">
<div style="width: 100%; background-color: gray; color: white; text-align: center;">Group Owner: <a href="/Profile.php?id=<?php print_r($group['ownerid']); ?>"><?php
$i = $group['ownerid'];
$creator = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$i'"));
if ($creator == 0){
	print_r('<i>No one</i>');
}else{
	print_r($creator['Username']);
} ?></a>
</div><br>
<textarea disabled style="color: black; background-color: white; border: none; overflow: auto; margin: 2px; width: 426px; height: 144px;"><?php print_r(strip_tags(nl2br($group['description']))); ?></textarea>
</td>
<td style="border: 1px solid black; vertical-align: text-top;  background-color: white;">
<div style="width: 100%; vertical-align: text-top; background-color: gray; color: white; text-align: center;">Group Members
</div><br>
<div style="width: 98%; max-width: 98%;">
<table><tr>
<?php
$page = 1;
if ($_GET['page']){
	$page = mysql_real_escape_string($_GET['page']);
}
if ($page > 1){
	$startFrom = (($page - 1) * 4);
}else{
	$startFrom = 0;
}
$x = mysql_query("SELECT * FROM `groupmembers` WHERE `groupid`='$id' ORDER BY id DESC LIMIT $startFrom, 4");
$xx = mysql_num_rows($x);
for ($count = 1; $count <= $xx; $count ++){
	$xr = mysql_fetch_array($x);
	$userid = $xr['memberid'];
	$get = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$userid'"));
	?>
    <td style="width: 129px; max-width: 129px; text-align: center;">
    <center><?php drawCharacter($get['id'], 100, 140); ?></center><br>
    <a href="/Profile.php?id=<?php print_r($get['id']); ?>"><?php print_r($get['Username']); ?></a>
    </td>
    <?php
}
?>
<td style="width: 129px; max-width: 129px; text-align: center;">
<center><?php drawCharacter($creator['id'], 100, 140); ?></center><br>
<a href="/Profile.php?id=<?php print_r($creator['id']); ?>"><?php print_r($creator['Username']); ?></a>
</td>
</tr>
</table>
<center>
<?php
$sql = "SELECT COUNT(id) FROM `groupmembers` WHERE `groupid`='$id'"; 
$rs_result = mysql_query($sql,$con); 
$row = mysql_fetch_row($rs_result); 
$total_records = $row[0]; 
$total_pages = ceil($total_records / 4);
if ($page > 1){
	?>
    <a href="?id=<?php print_r($id); ?>&page=<?php print_r($page - 1); ?>" id="buttonsmall">Back</a>
    <?php
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;Page <?php print_r($page); ?> of <?php print_r($total_pages); ?>
<?php
if ($page < $total_pages){
	?>
	&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="?id=<?php print_r($id); ?>&page=<?php print_r($page + 1); ?>" id="buttonsmall">Next</a>
    <?php
}
?>
</td>
</tr>
</table><br>
<div style="max-width: 98%; vertical-align: text-top;width: 98%; border: 1px solid black; background-color: white;">
<div style="width: 100%; background-color: gray; color: white; text-align: left;">
Group Wall
</div>
<br>
<?php
if ($_POST['comment']){
	if ($logged == true){
		$comment = nl2br(mysql_real_escape_string($_POST['comment']));
		mysql_query("INSERT INTO `groupwall` (`groupid`, `memberid`, `comment`) VALUES ('$id', '$uid', '$comment')");
		message("Success", "Comment posted to the wall.", "?id=" . $id, "Back", false, '');
	}
}
if ($_GET['scrub']){
	if ($logged == true){
		if ($user['powerHeadMod'] == '1' || $user['powerCM'] == '1' || $user['powerForumMod'] != '1' || $user['Username'] == 'Syncro'){
			$cid = $_GET['scrub'];
			mysql_query("UPDATE `groupwall` SET `comment`='[ Content Deleted ]' WHERE `id`='$cid'");
			message("Success", "Comment was scrubbed successfully!", "?id=" . $id, "Back", false, '');
		}
	}
}
if ($_GET['remove']){
	if ($logged == true){
		if ($user['powerHeadMod'] == '1' || $user['powerCM'] == '1' || $user['Username'] == 'Syncro'){
			$cid = $_GET['remove'];
			mysql_query("DELETE FROM `groupwall` WHERE `id`='$cid'");
			message("Success", "Comment was removed successfully!", "?id=" . $id, "Back", false, '');
		}
	}
}
?>
<form action="?id=<?php print_r($id); ?>" method="post">
<textarea style="margin: 2px; width: 984px; height: 57px;" name="comment" placeholder=<?php if ($logged==true){ ?>"Write a comment.."<?php }else{ ?>"You must be logged in to write a comment!" disabled<?php } ?>></textarea><br>
<input type="submit" value="Post Comment" id="buttonsmall" />
</form><br>
<table width="98%">
<?php
$f = mysql_query("SELECT * FROM `groupwall` WHERE `groupid`='$id' ORDER BY id DESC");
$ff = mysql_num_rows($f);
for ($count = 1; $count <= $ff; $count ++){
	$fr = mysql_fetch_array($f);
	$memberid = $fr['memberid'];
	$member = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$memberid'"));
	?>
    <tr>
    <td width="200" style="text-align: center;">
    <center><?php drawCharacter($memberid, 100, 140); ?></center><br>
    <a href="/Profile.php?id=<?php print_r($memberid); ?>"><?php print_r($member['Username']); ?></a>
    </td>
    <td style="text-align: center;">
    <textarea disabled style="color: black; background-color: #D5D5D5; border: 1px solid #333; border-radius: 3px;  margin: 2px; width: 874px; height: 180px;"><?php print_r($fr['comment']); ?></textarea>
    <?php
	if ($logged==true){
		if ($user['powerHeadMod'] == '1' || $user['powerCM'] == '1' || $user['Username'] == 'Syncro'){
			?><a href="?id=<?php print_r($id); ?>&scrub=<?php print_r($fr['id']); ?>">Scrub Comment</a> | <a href="?id=<?php print_r($id); ?>&remove=<?php print_r($fr['id']); ?>">Remove Comment</a><?php
		}
	}
	?>
    </td>
    </tr>
    <?php
}
?>
</table>
</div>
</div>
</div>
<br>
</center>
</td>
</div>