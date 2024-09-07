<?php
$con = mysql_pconnect("localhost", "avatarce_user", "bradybear1298") or die("Something went wrong while connecting to the database - ID: 1");
mysql_select_db("avatarce_database", $con) or die("Something went wrong while connecting to the database - ID: 2");
$logged = false;
if ($_COOKIE['ck_usrn'] && $_COOKIE['ch_salt']){
	$urn = mysql_real_escape_string($_COOKIE['ck_usrn']);
	$sal = mysql_real_escape_string($_COOKIE['ch_salt']);
	$uss = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `salt`='$sal'"));
	if ($uss != '0'){
		if (hash("ripemd160", strtolower($uss['Username']) == $urn)){
			$logged = true;
			$user = $uss;
			$myU = mysql_fetch_object($ui = mysql_query("SELECT * FROM `accounts` WHERE `salt`='$sal'"));
		}else{
			$logged = false;	
		}
	}
}?>
<h4>Users Chatting: <?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `accounts` WHERE `chat`='1' AND `online`='1' ORDER BY id"))); ?></h4><br />
<?php
$c = mysql_query("SELECT * FROM `accounts` WHERE `chat`='1' AND `online`='1' ORDER BY id");
$cc = mysql_num_rows($c);
for ($count = 1; $count <= $cc; $count ++){
	$cr = mysql_fetch_array($c);
	?>
    <a href="Profile.php?id=<?php print_r($cr['id']); ?>"><?php print_r($cr['Username']); ?></a><br />
    <?php
}
?>
