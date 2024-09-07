<?php
include('../global.php');
if ($logged ==false){
	die("not logged in");
}
if ($user['Membership'] == '3'){
	die("This is membership only.");
}
if ($_GET['offer'] && $_GET['type']){
	$type = mysql_real_escape_string($_GET['type']);
	$offer = mysql_real_escape_string($_GET['offer']);
	$trade = mysql_fetch_array(mysql_query("SELECT * FROM `tc` ORDER BY id DESC LIMIT 1;"));
	if ($offer < 20){
		die("You can't trade less than 20 " . $type);
	}
	$givv = 'Bucks';
	if ($type == 'Bucks'){
		$givv = 'Reebs';
		$receive = ceil($offer / $trade['reebtobuck']);
	}else{
		$givv = 'Bucks';
		$receive = ceil($offer * $trade['bucktoreeb']);
	}
	if ($givv == 'Reebs'){
		if ($user['Bucks'] < $offer){
			message("Error", "You don't have enough bucks for that.", "index.php", "Back", false, '');
			die();
		}
	}else{
		if ($user['Reebs'] < $offer){
			message("Error", "You don't have enough tokens for that.", "index.php", "Back", false, '');
			die();
		}
	}
	if ($_GET['do']){
	$reebtobuck = rand(5, 18);
	$bucktoreeb = rand(5, 18);
	$uid = $user['id'];
	if ($type == 'Bucks'){
		mysql_query("UPDATE `accounts` SET `Reebs`=`Reebs`+$receive WHERE `id`='$uid'");
		mysql_query("UPDATE `accounts` SET `Bucks`=`Bucks`-$offer WHERE `id`='$uid'");
	}else{
		mysql_query("UPDATE `accounts` SET `Bucks`=`Bucks`+$receive WHERE `id`='$uid'");
		mysql_query("UPDATE `accounts` SET `Reebs`=`Reebs`-$offer WHERE `id`='$uid'");
	}
	mysql_query("INSERT INTO `tc` (`reebtobuck`, `bucktoreeb`) VALUES ('$reebtobuck', '$bucktoreeb')");
	message("Complete", "Your transaction has completed. Thanks!", "index.php", "Okay, back.", false, '');
	}else{
		message("Are you sure?","Trades are non-refundable.", "?type=" . $type . "&offer=" . $offer . "&do=true", "Yep, I'm Sure.", true, "index.php");
	}
}else{
	ob_end_clean();
	header('location: index.php');
}
