<?php
  include('../global.php');
if ($logged == false){
  die("You're not logged in!");
}?>
<div style="text-align:center;"><h1 style="/*text-align:center;*/">Chat</h1>


<form action="#" method="post">
<input type="text" name="comment" style="width: 30%; height: 15px;overflow:hidden; padding: 0px; vertical-align: text-top;" placeholder='<?php if ($logged==true){ ?>Write something to say...<?php }else{ ?>"You must be logged in to write a comment!" disabled<?php } ?>'><input type="submit" value="Post" id="buttonsmall">
</form>



<div style="text-align:center;"><div style="max-width: 65%; vertical-align: text-top;width: 65%; border: 1px solid black; background-color: white;margin:auto;">
<div style="width: 100%; background-color: gray; color: white; text-align: left;">
</div>
<br>
<?php
if ($_POST['comment']){
  if ($logged == true){
    $comment = nl2br(mysql_real_escape_string($_POST['comment']));
    mysql_query("INSERT INTO `lechat` (`groupid`, `memberid`, `comment`) VALUES ('$id', '$uid', '$comment')");
    //message("Success", "Comment posted to the wall.", "?id=" . $id, "Back", false, '');
  }
}
if ($_GET['scrub']){
  if ($logged == true){
    if ($user['powerHeadMod'] == '1' || $user['powerCM'] == '1' || $user['powerForumMod'] != '1' || $user['Username'] == 'Syncro'){
      $cid = $_GET['scrub'];
      mysql_query("UPDATE `lechat` SET `comment`='[ Content Deleted ]' WHERE `id`='$cid'");
      message("Success", "Chat message was scrubbed successfully!", "?id=" . $id, "Back", false, '');
    }
  }
}
if ($_GET['remove']){
  if ($logged == true){
    if ($user['powerHeadMod'] == '1' || $user['powerCM'] == '1' || $user['Username'] == 'Syncro'){
      $cid = $_GET['remove'];
      mysql_query("DELETE FROM `lechat` WHERE `id`='$cid'");
      message("Success", "Chat message was removed successfully!", "?id=" . $id, "Back", false, '');
    }
  }
}
?>
<br>
<div style="text-align:center;"><table width="98%">
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
  
</table>
</div>

</div>
</div>
<br>
</center>
</td>

</div></div>
