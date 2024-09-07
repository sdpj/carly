<?php
include "Header.php";
if (isset($_POST['fusername']) && $_POST['ban'] && $_POST['reason'] && $_POST['content']){
	$username = $_POST['fusername'];
	$ban      = $_POST['ban'];
	$reason   = $_POST['reason'];
	$content  = $_POST['content'];
	if ($ban == '1 Day'){
	$banUntil = time () + 24 * 60 * 60;
	$type = 2;
	}elseif ($ban == '3 Days'){
	$banUntil = time () + 72 * 60 * 60;
	$type = 3;
	}elseif ($ban == '7 Days'){
	$banUntil = time () + 168 * 60 * 60;
	$type = 4;
	}elseif ($ban == 'Warning'){
	$banUntil = time () - 1;
	$type = 1;
	}elseif ($ban == 'Request Deletion'){
		if ($user['Username'] == 'ORBITAL'){
$banUntil = time () + 21472412412;
			mysql_query("UPDATE `accounts` SET `banned`='5', `bannedFor`='$content', `bannedReason`='$reason', `bannedUntil`='$banUntil' WHERE `Username`='$username'");
		}else{
		mysql_query("INSERT INTO `messages` (`fromid`, `toid`, `subject`, `body`) VALUES ('1', '1', 'Requested account Deletion.', 'The user, $username has been requested to be deleted. Reason: $reason and content: $content ')");
		die("Done.");
		}
	}
	mysql_query("UPDATE `accounts` SET `banned`='$type', `bannedReason`='$reason', `bannedFor`='$content', `bannedUntil`='$banUntil' WHERE `Username`='$username'");
	die("Done.");
}
if (isset($_GET['username'])){
	$username = $_GET['username'];
	$check = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `Username`='$username'"));
	if ($check != 0){
		?>
        <h1>Next, please fill in some details about the ban.</h1><br><br>
        <form action="" method="post">
        Username: <input type="text" value="<?php print_r($check['Username']); ?>"  name="fusername" /><br>
        Ban For: <select name="ban"><option>Warning</option><option>1 Day</option><option>3 Days</option><option>7 Days</option><option>Request Deletion</option></select><br>
        Reason: <input type="text" name="reason" value="" /><br>
        Rule Breaking Content: <br>
        <textarea name="content"></textarea><br>
        <input type="submit" value="BAN" />
        <br>
        <h6>Abusing your powers will get you a suspension from them and a ban placed on your account.</h6>
        </form>
        <?php
	}
}
if (isset($_GET['id'])){
	$username = $_GET['id'];
	$check = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$username'"));
	if ($check != 0){
		?>
        <h1>Next, please fill in some details about the ban.</h1><br><br>
        <form action="" method="post">
        Username: <input type="text" value="<?php print_r($check['Username']); ?>"  name="fusername" /><br>
        Ban For: <select name="ban"><option>Warning</option><option>1 Day</option><option>3 Days</option><option>7 Days</option><option>Request Deletion</option></select><br>
        Reason: <input type="text" name="reason" value="i.e. Please do not spam at Travinis" /><br>
        Rule Breaking Content: <br>
        <textarea name="content"></textarea><br>
        <input type="submit" value="BAN" />
        <br>
        <h6>Abusing your powers will get you a suspension from them and a ban placed on your account.</h6>
        </form>
        <?php
	}
}
?>
<h1>You are about to ban a user. Please type in their username or ID and press continue.</h1><br /><br />
<form action="" method="get">
Username: <input type="text" name="username" /> or ID: <input type="text" name="id" /><br />
<input type="submit" value="Continue.." />
</form><?php
	