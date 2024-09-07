<?php
include('../global.php');
if ($logged == false){
  die("You're not logged in!");
}
$page = 1;
$filter = 0;
if ($_GET['page']){
  $page = mysql_real_escape_string($_GET['page']);
}
if ($page > 1){
  $startFrom = (($page - 1) * 20);
}else{
  $startFrom = 0;
}
if ($_GET['archive']){
  $id = mysql_real_escape_string($_GET['archive']);
  $get = mysql_fetch_array(mysql_query("SELECT * FROM `messages` WHERE `id`='$id'")) or die(mysql_error());
  if ($get['toid'] != $uid){
    die("You cannot archive a message you do not own!");
  }
  mysql_query("UPDATE `messages` SET `archive`='1' WHERE `id`='$id'");
}
if ($_GET['delete']){
  $id = mysql_real_escape_string($_GET['delete']);
  $get = mysql_fetch_array(mysql_query("SELECT * FROM `messages` WHERE `id`='$id'")) or die(mysql_error());
  if ($get['toid'] != $uid){
    die("You cannot delete a message you do not own!");
  }
  mysql_query("UPDATE `messages` SET `removed`='1' WHERE `id`='$id'");
}
if ($_GET['restore']){
  $id = mysql_real_escape_string($_GET['restore']);
  $get = mysql_fetch_array(mysql_query("SELECT * FROM `messages` WHERE `id`='$id'")) or die(mysql_error());
  if ($get['toid'] != $uid){
    die("You cannot restore a message you do not own!");
  }
  mysql_query("UPDATE `messages` SET `removed`='0', `archive`='0' WHERE `id`='$id'");
}
$filter = 'inbox';
if ($_GET['filter']){
  $filter = mysql_real_escape_string($_GET['filter']);
  if ($filter == 'inbox'){
    $q = mysql_query("SELECT * FROM `messages` WHERE `toid`='$uid' AND `removed`='0' AND `archive`='0' ORDER BY id DESC LIMIT $startFrom, 20");
  }elseif ($filter == 'read'){
    $q = mysql_query("SELECT * FROM `messages` WHERE `toid`='$uid' AND `read`='1' AND `removed`='0' AND `archive`='0' ORDER BY id DESC LIMIT $startFrom, 20");
  }elseif ($filter == 'unread'){
    $q = mysql_query("SELECT * FROM `messages` WHERE `toid`='$uid' AND `read`='0' AND `removed`='0' AND `archive`='0' ORDER BY id DESC LIMIT $startFrom, 20");
  }elseif ($filter == 'outbox'){
    $q = mysql_query("SELECT * FROM `messages` WHERE `fromid`='$uid' ORDER BY id DESC LIMIT $startFrom, 20");
  }elseif ($filter == 'archive'){
    $filter = 1;
    $q = mysql_query("SELECT * FROM `messages` WHERE `toid`='$uid' AND `archive`='1' ORDER BY id DESC LIMIT $startFrom, 20");
  }elseif ($filter == 'removed'){
    $filter = 2;
    $q = mysql_query("SELECT * FROM `messages` WHERE `toid`='$uid' AND `removed`='1' ORDER BY id DESC LIMIT $startFrom, 20");
  }
}else{
  $q = mysql_query("SELECT * FROM `messages` WHERE `toid`='$uid' AND `removed`='0' AND `archive`='0' ORDER BY id DESC LIMIT $startFrom, 20");
}
?>
<h1 style="margin:0px;text-align:center;font-weight:normal;"><?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `messages` WHERE `toid`='$uid' AND `read`='0' ORDER BY id"))); ?> Unread Messages</h1>
<br><br>
<table width="98%"><tr><td style="box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);border-radius:5px;border: 0px solid black; color: black; background-color: white; padding: 8px; vertical-align: text-top; padding: 10px; vertical-align: text-top;">
<a href="?filter=inbox">Inbox</a><br>
<a href="?filter=outbox">Sent Messages</a><br>
<a href="?filter=read">Read Messages</a><br>
<a href="?filter=unread">Unread Messages</a><br>
<a href="?filter=archive">Archive</a><br>
<a href="?filter=removed">Trash</a>
</td>
<td>
<div style="width: 98%; padding: 5px; box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);
    border-radius: 5px; color: black; background-color: #fff;">
<table width="98%">
<tr>
<td width="100" style="text-align: left;">Sender</td>
<td width="450" style="text-align: left;">Subject</td>
<td style="text-align: right;">Actions</td>
</tr>
<style>#buttonsmall { border-radius:5px; background-color: #04AA6D; transition-duration: 0s;} #buttonsmall:hover{ background-color: #04AA6D; /*background-color: #02c17b;*/ transition-duration: 0s;}</style>
<?php
$last = 0;
$qq = mysql_num_rows($q);
for ($count = 1; $count <= $qq; $count ++){
  if ($last == 0){  $last = 1;  }else{  $last = 0;  }
  $qr = mysql_fetch_array($q);
  $senderId = $qr['fromid'];
  $senderArray = mysql_fetch_object($qf = mysql_query("SELECT * FROM `accounts` WHERE `id`='$senderId'"));
  if ($qr['read'] == '0'){
    $fontWeight = "font-weight: 600";
  }else{
    $fontWeight = "font-weight: 200";
  }
  ?>
<tr style="box-shadow: 3px 3px 12px 0px rgb(0 0 0 / 8%); border-radius: 5px; border: 1px solid black; background-color: #<?php if ($last == 0){ print_r("efefef"); }else{ print_r("fcfcfc"); }?>; color: black; padding: 15px;">
  <td width="100" style=" <?php print_r($fontWeight); ?>; text-align: left; padding: 15px;"><a href="/Profile.php?id=<?php print_r($senderArray->{'id'}); ?>"><?php print_r($senderArray->{'Username'}); ?></a>
    </td>
    <td width="450" style=" <?php print_r($fontWeight); ?>; text-align: left; padding: 15px;"><a href="ViewMessage.php?id=<?php print_r($qr['id']); ?>"><?php
  if (strlen($qr['subject']) > 80){
    print_r(strip_tags(substr($qr['subject'], 0, 80)));
  }else{
    print_r(strip_tags($qr['subject']));
  } ?></a></td>
    <td style=" <?php print_r($fontWeight); ?>; text-align: right; padding: 15px;">
    <?php
    if ($filter == 1){
    ?>
    <a href="?restore=<?php print_r($qr['id']); ?>" id="buttonsmall">Restore</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
  }elseif ($filter == 2){
    ?>
        <a href="?restore=<?php print_r($qr['id']); ?>" id="buttonsmall">Restore</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
  }else{
    ?>
        <a href="?archive=<?php print_r($qr['id']); ?>" id="buttonsmall">Archive</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="?delete=<?php print_r($qr['id']); ?>" id="buttonsmall">Trash</a>
    <?php
  }
  ?>
    </td>
    </tr>
    <?php
}
?>
</tr>
</table>
<br><br>
</tr>
</table>
<center><br>
<?php
if ($filter == 'inbox'){
$sql = "SELECT COUNT(id) FROM `messages` WHERE `toid`='$uid' "; 
}elseif ($filter == 'outbox'){
$sql = "SELECT COUNT(id) FROM `messages` WHERE `fromid`='$uid' "; 
}elseif ($filter == 'read'){
$sql = "SELECT COUNT(id) FROM `messages` WHERE `toid`='$uid' AND `read`='1' "; 
}elseif ($filter == 'unread'){
$sql = "SELECT COUNT(id) FROM `messages` WHERE `toid`='$uid' AND `read`='0' "; 
}elseif ($filter == 'archive'){
$sql = "SELECT COUNT(id) FROM `messages` WHERE `archive`='1' "; 
}elseif ($filter == 'removed'){
$sql = "SELECT COUNT(id) FROM `messages` WHERE `removed`='1' "; 
}else{
$sql = "SELECT COUNT(id) FROM `messages` WHERE `toid`='$uid' "; 
}
$rs_result = mysql_query($sql,$con); 
$row = mysql_fetch_row($rs_result); 
$total_records = $row[0]; 
$total_pages = ceil($total_records / 20);
if ($page > 1){
  ?>
    <a href="?page=<?php print_r($page - 1); ?>" id="buttonsmall" style="padding-left:20px;padding-right:20px;">&laquo;</a>
    <?php
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;Page <?php print_r($page); ?> of <?php print_r($total_pages); ?>
<?php
if ($page < $total_pages){
  ?>
  &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="?page=<?php print_r($page + 1); ?>" id="buttonsmall" style="padding-left:20px;padding-right:20px;">&raquo;</a>
    <?php
}?><div style="height:15px;"></div>
<?php
include('../Footer.php');
?>