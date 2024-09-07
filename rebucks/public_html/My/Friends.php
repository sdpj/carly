<?php
include('../global.php');
$id = 0;
if ($_GET['id']){
	$id = mysql_real_escape_string($_GET['id']);
}else{
	if ($logged == false){	
		die("You're not logged in!");
	}else{
		$id = $user['id'];
	}
}
if ($id == 0){
	die("Something went wrong.");
}
$check = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$id'"));
if ($check == 0){
	die("That user does not appear to exist!");
}
?>
<fieldset>
<legend><?php print_r($check['Username']); ?>'s Friends</legend>
<center><table width="98%">
<tr>
<?php
$x = 0;
$q = mysql_query("SELECT * FROM `friends` WHERE `withid`='$id' ORDER BY id DESC");
$qq = mysql_num_rows($q);
for ($count = 1; $count <= $qq; $count ++){
	$qr = mysql_fetch_array($q);
	$x ++;
	$groupid = $qr['uid'];
	$group = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$groupid'"));
	?>
	<td width="200" style="text-align: center; vertical-align: text-top;">
    <a href="/Profile.php?id=<?php print_r($group['id']); ?>">
    <center><?php drawCharacter($groupid, 100, 195); ?></center><br>
    <?php print_r(strip_tags($group['Username'])); ?>
	</a>
    </td>
    <?php
	if ($x == 9){
		$x = 0;
		echo '</tr><tr>';
	}
}
?></tr>
</table>