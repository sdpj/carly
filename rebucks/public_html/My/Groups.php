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
<legend><?php print_r($check['Username']); ?>'s Communities</legend>
<table width="98%">
<tr>
<?php
$x = 0;
$q = mysql_query("SELECT * FROM `groupmembers` WHERE `memberid`='$id' ORDER BY id DESC");
$qq = mysql_num_rows($q);
for ($count = 1; $count <= $qq; $count ++){
	$qr = mysql_fetch_array($q);
	$x ++;
	$groupid = $qr['groupid'];
	$group = mysql_fetch_array(mysql_query("SELECT * FROM `groups` WHERE `id`='$groupid'"));
	?>
	<td width="200" style="text-align: center; vertical-align: text-top;">
    <a href="/Communities/Community.php?id=<?php print_r($group['id']); ?>">
    <img src="/assets/groupimg/<?php print_r($group['logopath']); ?>" style="width: 120px; height: auto;" border="0" /><br>
    <?php print_r(strip_tags($group['name'])); ?>
	</a>
    </td>
    <?php
	if ($x == 10){
		$x = 0;
	}
}
$x = 0;
$q = mysql_query("SELECT * FROM `groups` WHERE `ownerid`='$id' ORDER BY id DESC");
$qq = mysql_num_rows($q);
for ($count = 1; $count <= $qq; $count ++){
	$qr = mysql_fetch_array($q);
	$x ++;
	$group = $qr;
	?>
	<td width="200" style="text-align: center; vertical-align: text-top;">
    <a href="/Communities/Community.php?id=<?php print_r($group['id']); ?>">
    <img src="/assets/groupimg/<?php print_r($group['logopath']); ?>" style="width: 120px; height: auto;" border="0" /><br>
    <?php print_r(strip_tags($group['name'])); ?>
	</a>
    </td>
    <?php
	if ($x == 10){
		$x = 0;
	}
}
?>

</tr>
</table>