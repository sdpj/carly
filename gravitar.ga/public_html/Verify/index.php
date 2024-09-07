<?php
include('../global.php');
if ($logged == false){
	die("Not logged in..");
}
if ($user['Email'] == ''){
	die("You haven't specified an email address! Go to My Account and do so.");
}
if ($user['Verified'] == '1'){
	die("You're already verified with us!");
}
if ($_GET['token']){
	$token = mysql_real_escape_string($_GET['token']);
	$check = mysql_fetch_array(mysql_query("SELECT * FROM `verify` WHERE `userid`='$uid' AND `token`='$token'"));
	if ($check == 0){
		die("That verification is invalid, or you do not own the rights to it!");
	}else{
		mysql_query("UPDATE `accounts` SET `Verified`='1' WHERE `id`='$uid'");
		mysql_query("DELETE FROM `verify` WHERE `token`='$token'");
		die("Thanks, you're now verified!");
	}
}
$resend = false;
if ($_GET['resend']){
	$resend = true;
}
$check = mysql_fetch_array(mysql_query("SELECT * FROM `verify` WHERE `userid`='$uid'"));
if ($check != 0 && $resend == false){
	?>
    You've already been sent a verification code. <a href="?resend=true">Do you want us to send it again?</a>
    <?php
}else{
$verify = hash("ripemd160", rand() . $user['Username'] . rand());
mysql_query("INSERT INTO `verify` (`userid`, `token`) VALUES ('$uid', '$verify')") or die(mysql_error());
mail($user['Email'], "Your Travinis Verification", "Hi, " . $user['Username'] . ". 

Thanks for registering with Travinis. Here is your verification code, copy and paste it into your URL bar or if your email allows links go ahead and click it. 

http://www.Travinis.tk/Verify/?token=" . $verify);
?>
<h1>Verification Sent</h1><br>
<table><tr>
<td><?php drawCharacter($uid, 100, 100); ?></td><td>
<h6>We have sent your email verification, please make sure you check your spam and bulk folders if you do not receive it. If you use an email service other than googlemail we recommend you wait up to 1 hour to receive it.</h6></td></tr></table>
<?php
}