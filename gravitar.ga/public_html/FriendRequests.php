<?php
include('global.php');
if ($logged == false){
  die("You're not logged in!");
}
if ($_GET['accept']){
  $id = mysql_real_escape_string($_GET['accept']);
  $check = mysql_fetch_array(mysql_query("SELECT * FROM `friends` WHERE `withid`='$uid' AND `id`='$id'"));
  if ($check != 0){
    $with = $check['uid'];
    mysql_query("INSERT INTO `friends` (`withid`, `uid`, `request`) VALUES ('$with', '$uid', '1')");
    mysql_query("UPDATE `friends` SET `request`='1' WHERE `id`='$id'");
    mysql_query("INSERT INTO `messages` (`fromid`, `toid`, `subject`, `body`) VALUES ('$uid', '$with', 'Your friend request was accepted.', '$user[Username] has accepted your friend request!')");
    message("Success",  "You have accepted this friend request.", "FriendRequests.php", "Back", false, '');
  }
}
if ($_GET['decline']){
  $id = mysql_real_escape_string($_GET['decline']);
  $check = mysql_fetch_array(mysql_query("SELECT * FROM `friends` WHERE `withid`='$uid' AND `id`='$id'"));
  if ($check != 0){
    mysql_query("DELETE FROM `friends` WHERE `id`='$id'");
    mysql_query("INSERT INTO `messages` (`fromid`, `toid`, `subject`, `body`) VALUES ('$uid', '$with', 'Your friend request was declined.', '$user[Username] has declined your friend request!')");
    message("Success", "You have declined this friend request.", "FriendRequests.php", "Back", false, '');
  }
}
?>
<h1>Friend Requests (<?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `friends` WHERE `withid`='$uid' AND `request`='0' ORDER BY id"))); ?>)</h1><br />
<table>
<tr>
<?php
$q = mysql_query("SELECT * FROM `friends` WHERE `withid`='$uid' AND `request`='0' ORDER BY id");
$qq = mysql_num_rows($q);
$c = 0;
for ($count = 1; $count <= $qq; $count ++){
  $qr = mysql_fetch_array($q);
  $c++;
  $id = $qr['uid'];
  $arr = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$id'"));
  ?>
  <td width="130" style="text-align: center; border: 1px solid #666; background-color: #FFFFFF; padding: 3px;">
    <center><?php
  drawCharacter($id);
  ?>
  <br></center>
    <a href="Profile.php?id=<?php print_r($id); ?>"><?php print_r($arr['Username']); ?></a><br>
    <a href="?accept=<?php print_r($qr['id']); ?>">Accept</a> or <a href="?decline=<?php print_r($qr['id']); ?>">Decline</a>
    </td>
    <?php
  if ($c == 8){
    $c = 0;
    echo "</tr><tr>";
  }
}
?>
</tr>
</table>