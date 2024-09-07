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
    message("Error", "Sorry, you can't leave your own group.", "?id=" . $id, "Back", false, '');
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
<div style="display:inline-block;width: 98%; max-width: 99%; border-top-left-radius: 5px; border-top-right-radius: 5px; color: white; background-color:rgb(126, 180, 231); padding: 7px;border-bottom: 2px solid #4a85c0;color: #333;font-size: 1.5rem; font-weight: 600;">
<table width="98%" style="display:inline-block;"><tr><td><img src="/assets/groupimg/<?php print_r($group['logopath']); ?>" style="box-shadow: -2px 2px 7px rgb(0 0 0 / 25%);border-radius:50%;background-color:#fff;height: 50px; width: 50px;display:inline-block;" />&nbsp;&nbsp;&nbsp;<thetext style="position:relative;top:-14px;"><?php print_r($group['name']); ?>
</td><td style="margin-left:10px;text-align: right;display:block;position:relative;top:15px;"><?php if ($group['ownerid'] != $uid){ ?><?php
$c = mysql_fetch_array(mysql_query("SELECT * FROM `groupmembers` WHERE `memberid`='$uid' AND `groupid`='$id'"));
if ($c == 0){
  
  ?><a href="?id=<?php print_r($id); ?>&join=toddle" id="buttonsmall" style="background-color: #04AA6D; border: none; color: white; cursor: pointer; border-radius: 5px;float:right;">Join<?php
}else{
  ?><a href="?id=<?php print_r($id); ?>&join=toddle" id="buttonsmall" style="background-color: #f32b2b; border: none; color: white; cursor: pointer; border-radius: 5px;float:right;">Leave<?php
}
?>
</a><?php } ?></thetext></td></tr></table>
</div>
<div style="width: 98%; max-width: 99%; background-color: black; border-left: 0px solid black; border-right: 0px solid black; border-bottom: 0px solid black; color: black; background-color: white; padding: 7px;box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);border-bottom-right-radius: 5px;border-bottom-left-radius: 5px;">
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
    ?><tools style="display:block;text-align:center;"><a href="?id=<?php print_r($id); ?>&delete=true">Delete Group</a>  |  <a href="?id=<?php print_r($id); ?>&scrublogo=true">Purge Logo</a> | <a href="?id=<?php print_r($id); ?>&desc=true">Scrub Description</a></tools>
        <?php
  }
}
?>
<table width="98%"><tr>
<td style="max-width: 48%; vertical-align: text-top;width: 48%; border: 0px solid black; background-color: none;box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);border-radius:5px;">
<div style="width: 100%; background-color:rgb(126, 180, 231); border-bottom: 2px solid #4a85c0; color: white; text-align: center;border-top-left-radius: 5px;border-top-right-radius: 5px;">Group Owner: <a href="/Profile.php?id=<?php print_r($group['ownerid']); ?>" style="color:white;"><?php
$i = $group['ownerid'];
$creator = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$i'"));
if ($creator == 0){
  print_r('<i>Nobody</i>');
}else{
  print_r($creator['Username']);
} ?></a>
</div>
<text style="color: black; background-color: white; border: none; overflow: auto; margin: 2px; width: 426px; height: 144px;"><?php print_r(strip_tags(nl2br($group['description']))); ?></text>
</td><td></td>
<td style="max-width: 48%; vertical-align: text-top;width: 48%; border: 0px solid black; background-color: none;box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);border-radius:5px;">
<div style="width: 100%; background-color:rgb(126, 180, 231); border-bottom: 2px solid #4a85c0; color: white; text-align: center;border-top-left-radius: 5px;border-top-right-radius: 5px;">Group Members
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
    <a href="?id=<?php print_r($id); ?>&page=<?php print_r($page - 1); ?>" id="buttonsmalll" style="background-color:#3498db;border-radius:50%;font-size:20px;padding-left:7px;padding-right:7px;padding-bottom:2px;color:white;font-weight:bold;"><</a>
    <?php
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;Page <?php print_r($page); ?> of <?php print_r($total_pages); ?>
<?php
if ($page < $total_pages){
  ?>
  &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="?id=<?php print_r($id); ?>&page=<?php print_r($page + 1); ?>" id="buttonsmalll" style="background-color:#3498db;border-radius:50%;font-size:20px;padding-left:7px;padding-right:6px;padding-bottom:2px;color:white;font-weight:bold;">></a><br><br><?php
}
?>
</td>
</tr>
</table><br>
<div style="max-width: 98%; vertical-align: text-top;width: 98%; border: 0px solid black; background-color: none;box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);border-radius:5px;">
<div style="width: 100%; background-color:rgb(126, 180, 231); border-bottom: 2px solid #4a85c0; color: white; text-align: center;border-top-left-radius: 5px;border-top-right-radius: 5px;">
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
<div style="text-align:center;"><textarea style="text-align:center;resize: none;margin: 2px; width: 984px; height: 57px;border:0px;box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);border-radius:5px;" name="comment" placeholder=<?php if ($logged==true){ ?>"Write a comment!"<?php }else{ ?>"You must be logged in to write a comment!" disabled<?php } ?>></textarea></div><br>
<input type="submit" value="Post Comment" id="buttonsmall" style="margin:auto;display:block;text-align:center;/*background-color: #04AA6D;*/ border: none; color: white; cursor: pointer; border-radius: 5px;" />
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
    <textarea disabled style="resize:none;box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);border-radius:5px;color: black; background-color: #FFF; border: 0px solid #333; border-radius: 3px;  margin: 2px; width: 874px; height: 180px;"><?php print_r($fr['comment']); ?></textarea>
    <?php
  if ($logged==true){
    if ($user['powerHeadMod'] == '1' || $user['powerCM'] == '1' || $user['Username'] == 'Syncro'){
      ?><br><a href="?id=<?php print_r($id); ?>&scrub=<?php print_r($fr['id']); ?>">Scrub</a> or <a href="?id=<?php print_r($id); ?>&remove=<?php print_r($fr['id']); ?>">Remove</a><br><br><?php
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
      
<?php include('../Footer.php');?>