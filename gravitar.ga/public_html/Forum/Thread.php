<?php
include('../global.php');
if ($_GET['id']){
  $id = mysql_real_escape_string($_GET['id']);
  $thread = mysql_fetch_array(mysql_query("SELECT * FROM `forumthreads` WHERE `id`='$id'"));
  if ($thread == '0'){
    die("This thread doesn't exist!");
  }
  if ($_GET['deleteReply']){
  if ($logged == true){
    if ($user['powerCM'] != '0' || $user['powerForumMod'] != '0' || $user['powerHeadMod'] != '0'){
      $replyid = mysql_real_escape_string($_GET['deleteReply']);
      mysql_query("DELETE FROM `forumreplies` WHERE `id`='$replyid'") or die(mysql_error());
      message("Success", "Reply was deleted.", "?id=" . $id, "Okay", false, '');
    }
  }
  }
  $threadinid = $thread['inid'];
  $group = mysql_fetch_array(mysql_query("SELECT * FROM `forumgroups` WHERE `id`='$threadinid'"));
  $posterid = $thread['posterid'];
  $posterarray = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$posterid'"));
  if ($logged==true){
    if ($user['powerCM'] != '0' || $user['powerForumMod'] != '0' || $user['powerHeadMod'] != '0'){
      if ($_GET['scrub']){
          $scrubid = mysql_real_escape_string($_GET['scrub']);
          mysql_query("UPDATE `forumreplies` SET `body`='[ Removed Post ]' WHERE `id`='$scrubid'");
          message("Success", "Post was scrubbed.", "?id=" . $id, "Okay", false, '');
        }
        if ($_GET['scrubpost']){
          $scrubid = $id;
          mysql_query("UPDATE `forumthreads` SET `subject`='[ Removed Post ]', `body`='[ Removed Post ]' WHERE `id`='$scrubid'");
          message("Success", "Thread was scrubbed.", "?id=" . $id, "Okay", false, '');
        }
    }
  }
  if ($_GET['action']){
    if ($logged == true){
      if ($user['powerCM'] != '0' || $user['powerForumMod'] != '0' || $user['powerHeadMod'] != '0'){
        
        $action = mysql_real_escape_string($_GET['action']);
        if ($action == "lock"){
          mysql_query("UPDATE `forumthreads` SET `locked`='1' WHERE `id`='$id'");
          message("Success", "Thread was locked.", "?id=" . $id, "Okay", false, '');
        }
        if ($action == "sticky"){
          if ($thread['sticky'] == '0'){
            mysql_query("UPDATE `forumthreads` SET `sticky`='1' WHERE `id`='$id'");
            message("Success", "Thread was pinned.", "?id=" . $id, "Okay", false, '');
          }else{
            mysql_query("UPDATE `forumthreads` SET `sticky`='0' WHERE `id`='$id'");
            message("Success", "Thread was un-pinned.", "?id=" . $id, "Okay", false, '');
          }
        }
        if ($action == "delete"){
          mysql_query("DELETE FROM `forumthreads` WHERE `id`='$id'");
          message("Success", "Thread was deleted.", "index.php", "Okay", false, '');
        }
      }
    }
  }
  $inid = $thread['inid'];
  $inforum = mysql_fetch_array(mysql_query("SELECT * FROM `forumboards` WHERE `id`='$inid'"));
  ?>
    
    <center><a href="index.php">Gravitar Forums</a> &rarr; <a href="Forum.php?id=<?php print_r($thread['inid']); ?>"><?php print_r($inforum['name']); ?></a> &rarr; <a href="#"><?php print_r($thread['subject']); ?></a></center>
<br /><br />
<div style="width: 98%; padding: 7px; border: 0px solid black; background-color: #2D81BA; color: #2D81BA;">

</div>

<table><tr>
<td style="width: 150px; border:0px solid black; background-color: #F3F3F3;">
<center>
<a href="/Profile.php?id=<?php print_r($posterid); ?>"><font color="black" size="2"><?php print_r($posterarray['Username']); ?></font></a><br>
<?php
drawCharacter($posterid, 100, 140);
?><br>
<?php
?><br>
<?php if ($posterarray['powerCM'] != '0' || $posterarray['powerHeadMod'] != '0' || $posterarray['powerForumMod'] != '0'){
  ?><br><img src="/assets/users_moderator.gif" /><br /><?php
}
if ($posterarray['totalposts'] >= 350 && $posterarray['totalposts'] < 500){
  ?><br /><font color="red" size="2">Top 100 Poster</font><?php
}
if ($posterarray['totalposts'] >= 500 && $posterarray['totalposts'] < 1000){
  ?><br /><font color="red" size="2">Top 75 Poster</font><?php
}

if ($posterarray['totalposts'] >= 1000 && $posterarray['totalposts'] < 5000 ){
  ?><br /><font color="red" size="2">Top 50 Poster</font><?php
}
if ($posterarray['totalposts'] >= 5000 && $posterarray['totalposts'] < 10000){
  ?><br /><font color="red" size="2">Top 25 Poster</font><?php
}
if ($posterarray['Username'] == 'Bailey'){
  ?><br /><img src="wsa.png" /><?php
}
?><br />
Total Posts: <?php print_r($posterarray['totalposts']); ?><br />
Joined: <?php print_r($posterarray['joined']); ?><br />

Status: <?php
$status = checkUserOnline($posterarray['id']);
if ($status == true){
  ?><font color="green">Online</font>
    <?php
}else{
  ?>
    <font color="red">Offline</font>
    <?php
}
?>
</td>
<td>
<center><div style="height: 350px; margin-top: 0px; border: 0px solid black; color: black; letter-spacing: 1px; font-size: 16px; margin: 0px 2px; width: 846px;overflow: auto; background-color: #F3F3F3;">
<div style="width: 836px; border-bottom: 0px solid black; background-color: white; color:black; size: 18px; padding-left: 10px; padding-top: 10px; font-weight: 600;">
<center><?php
print_r($thread['subject']);
?><br /><br /></center>
</div><br />
<center><br><?php print_r(nl2br($thread['body'])); ?><br /><br /><br><br><br>
<div style="border: 0; height: 1px;width:90%;"><hr style="border: 0; height: 0.5px;background-color: #d8d8d8;"></div><?php print_r($posterarray['Signature']); ?></div></center>
</td>
</tr>
</table><br>
<?php if ($thread['locked'] == '0'){ if ($logged == true){ ?><a href="Reply.php?id=<?php print_r($id); ?>" id="buttonsmall">Reply</a><?php } }else{ ?>[Thread Locked]<?php } ?>
<?php
if ($logged == true){
  if ($user['powerCM'] != '0' || $user['powerForumMod'] != '0' || $user['powerHeadMod'] != '0'){
    ?> | <a href="?id=<?php print_r($id); ?>&action=lock">Lock</a> | <a href="?id=<?php print_r($id); ?>&action=sticky">Sticky</a> | <a href="?id=<?php print_r($id); ?>&action=delete">Delete</a> | <a href="?id=<?php print_r($id); ?>&scrubpost=true">Scrub</a><?php
    if ($user['powerDev'] == '1' || $user['Username'] == 'Syncro'){
      if ($_GET['mark']){
        $mark = $_GET['mark'];
        if ($mark == '1'){
          mysql_query("UPDATE `forumthreads` SET `status`='3' WHERE `id`='$id'") or die(mysql_error());
          message("Done", "Done", "?id=" . $id, "Back", false, '');
          die();
        }elseif ($mark == '2'){
          mysql_query("UPDATE `forumthreads` SET `status`='1' WHERE `id`='$id'") or die(mysql_error());
          message("Done", "Done", "?id=" . $id, "Back", false, '');
          die();
        }elseif ($mark == '3'){
          mysql_query("UPDATE `forumthreads` SET `status`='2' WHERE `id`='$id'") or die(mysql_error());
          message("Done", "Done", "?id=" . $id, "Back", false, '');
          die();
        }
      }
      ?>
             | <a href="?id=<?php print_r($id); ?>&mark=1">Mark Rejected</a>
              | <a href="?id=<?php print_r($id); ?>&mark=2">Mark WIP</a>
              | <a href="?id=<?php print_r($id); ?>&mark=3">Mark Done</a>
    
</center>
      <?php
    }
  }
}

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start_from = ($page-1) * 6;
  $q = mysql_query("SELECT * FROM `forumreplies` WHERE `inid`='$id' ORDER BY id LIMIT $start_from, 6");
  $qq = mysql_num_rows($q);
  for ($count = 1; $count <= $qq; $count ++){
    $qr = mysql_fetch_array($q);
    $authid = $qr['authorid'];
    $author = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$authid'"));
    ?><br>
        <table><tr>
<td style="width: 150px; border: 0px solid #F3F3F3; background-color: #F3F3F3;">
<center>
<a href="/Profile.php?id=<?php print_r($authid); ?>"><?php print_r($author['Username']); ?></a><br>
<?php
drawCharacter($qr['authorid'], 100, 140);
?><br>
<?php

?><br>

<?php if ($author['powerCM'] != '0' || $author['powerForumMod'] != '0' || $author['powerHeadMod'] != '0'){
  ?><br><img src="/assets/users_moderator.gif" /><?php
}
if ($author['totalposts'] >= 350 && $author['totalposts'] < 500){
  ?><br /><font color="red" size="2">Top 100 Poster</font><?php
}
if ($author['totalposts'] >= 500 && $author['totalposts'] < 1000){
  ?><br /><font color="red" size="2">Top 75 Poster</font><?php
}

if ($author['totalposts'] >= 1000 && $author['totalposts'] < 5000 ){
  ?><br /><font color="red" size="2">Top 50 Poster</font><?php
}
if ($author['totalposts'] >= 5000 && $author['totalposts'] < 10000){
  ?><br /><font color="red" size="2">Top 25 Poster</font><?php
}

?>
<br />
Total Posts: <?php print_r($author['totalposts']); ?><br />
Joined: <?php print_r($author['joined']); ?><br />
Status: <?php
$status = checkUserOnline($author['id']);
if ($status == true){
  ?>
    <font color="green" size="1">Online</font>
    <?php
}else{
  ?>
    <font color="red" size="1">Offline</font>
    <?php
}
?>
</td>
<td>
<div style="height: 350px; border: 0px solid black; color: black; background-color: #F3F3F3; letter-spacing: 1px; font-size: 16px; margin: 0px 2px; width: 846px;overflow: auto;"><br><center><?php print_r(nl2br($qr['body'])); ?></center>
<br /><br /><br><br><br>
<center><div style="border: 0; height: 1px;width:90%;"><hr style="border: 0; height: 0.5px;background-color: #d8d8d8;"></div><br><?php print_r($author['Signature']); ?></div></center>
<?php if ($logged == true){
  if ($user['powerCM'] != '0' || $user['powerForumMod'] != '0' || $user['powerHeadMod'] != '0'){
    ?>
 | <a href="?id=<?php print_r($id); ?>&deleteReply=<?php print_r($qr['id']); ?>">[Delete Comment]</a> | <a href="?id=<?php print_r($id); ?>&scrub=<?php print_r($qr['id']); ?>">Scrub</a>
        <?php
  }
}
?>
</td>
</tr>
</table><br>
<?php if ($thread['locked'] == '0'){ if ($logged == true){ ?> <a href="Reply.php?id=<?php print_r($id); ?>" id="buttonsmall">Reply</a> <?php } } ?>
<?php
  }
  $sql = "SELECT COUNT(id) FROM `forumreplies` WHERE `inid`='$id'"; 
$rs_result = mysql_query($sql,$con); 
$row = mysql_fetch_row($rs_result); 
$total_records = $row[0]; 
$total_pages = ceil($total_records / 6); 
?><br />
<center>Pages: <?php
for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='?id=" . $id . "&page=".$i."'>".$i."</a> "; 
}; 

}