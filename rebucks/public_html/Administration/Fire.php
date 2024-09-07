<?php
include "Header.php";
if ($user['powerHeadMod'] == '0'){
	if ($user['Username'] != 'Syncro'){
	die("Not allowed here!");
}
}
if (isset($_GET['id'])){
	$id = mysql_real_escape_string($_GET['id']);
	$f = mysql_fetch_array(mysql_query("SELECT * FROM `Job` WHERE `id`='$id'"));
	if ($f==0){
		die("Oops something went wrong sorry!");
	}
	mysql_query("DELETE FROM Job WHERE id='$id'");
	mysql_query("INSERT INTO `messages` (`fromid`, `toid`, `subject`, `body`) VALUES ('1', '1', 'User Fired', 'The user id, $f[userid] has been fired, previous job was $f[type] ')");
	die("User fired and message sent to Syncro.");
}
$q = mysql_query("SELECT * FROM `Job` ORDER BY id");
$qq = mysql_num_rows($q);
for ($count = 1; $count <= $qq; $count ++){
	$qr = mysql_fetch_array($q);
	$useri = $qr['userid'];
	$ur = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$useri'"));
	  ?>
	  Username: <?php print_r($ur['Username']); ?><br>
      Job: <?php print_r($qr['type']); ?>
	  <br>
      <a href="?id=<?php print_r($qr['id']); ?>">[Fire From Job]</a><br>
      <?php
}