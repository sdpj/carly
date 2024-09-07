<?php
include('../global.php');
if ($logged == false){
	die("You're not logged in!");
}
if ($_POST['music']){
	$music = mysql_real_escape_string($_POST['music']);
	if ($music == 'None'){
		mysql_query("UPDATE `accounts` SET `music`='0' WHERE `id`='$uid'");
	}elseif ($music == 'Troll Song'){
		mysql_query("UPDATE `accounts` SET `music`='1' WHERE `id`='$uid'");
	}
	echo "Done!";
}
if ($_POST['email']){
	$email = mysql_real_escape_string($_POST['email']);
	$uid = $user['id'];
	mysql_query("UPDATE `accounts` SET `Email`='$email' WHERE `id`='$uid'");
	echo "Success! Your e-mail has been updated.<br>";
}
if ($_POST['incog']){
	$incog = mysql_real_escape_string($_POST['incog']);
	if ($incog == 'On'){
		mysql_query("UPDATE `accounts` SET `hide`='1' WHERE `id`='$uid'");
		echo "Success! You are using incognito mode!<br>";
	}else{
		mysql_query("UPDATE `accounts` SET `hide`='0' WHERE `id`='$uid'");
		echo "Success! You are no longer using incognito mode!<br>";
	}
}
if ($_POST['name']){
	$name = mysql_real_escape_string($_POST['name']);
	$uid = $user['id'];
	mysql_query("UPDATE `accounts` SET `Name`='$name' WHERE `id`='$uid'");
	echo "Success! Your username has been updated!<br>";
}
if ($_POST['oldpass'] && $_POST['newpass'] && $_POST['cnewpass']){
	$oldpass = mysql_real_escape_string($_POST['oldpass']);
	$newpass = mysql_real_escape_string($_POST['newpass']);
	$cnewpass = mysql_real_escape_string($_POST['cnewpass']);
	$oldpassHash = hash("ripemd160", $oldpass);
	$newpassHash = hash("ripemd160", $newpass);
	if ($user['Password'] != $oldpassHash){
		echo "Error! That is the incorrect password!";
	}else{
		if ($newpass != $cnewpass){
			echo "Error! New password and retype do not match!";
		}else{
			$uid = $user['id'];
			mysql_query("UPDATE `accounts` SET `Password`='$newpassHash' WHERE `id`='$uid'");
			echo "Success! Your password has been updated!";
		}
	}
}
if ($_POST['blurb']){
	$blurb = strip_tags(nl2br(mysql_real_escape_string($_POST['blurb'])));
	mysql_query("UPDATE `accounts` SET `blurb`='$blurb' WHERE `id`='$uid'");
	echo "Blurb updated successfully!";
}
if ($_POST['siggy']){
	$siggy = strip_tags(mysql_real_escape_string($_POST['siggy']));
	mysql_query("UPDATE `accounts` SET `Signature`='$siggy' WHERE `id`='$uid'");
	echo "Signature updated succesfully!";
}
?>
<h1>My OffTopic Account</h1>
<h3><?php if ($user['Verified'] == '0'){ ?>You are not verified! Click<a href="/Verify/">here</a> to verify it!<?php }else{ ?>Your account is verified!<?php } ?></h3><br /><br />
<fieldset>
<legend>Basic Account Settings (Username changing disabled)</legend>
<tr><td><h6>Remember, if you do not provide us your <b> real </b> e-mail address, then we cannot contact you.</tr></td></h6>
<tr><td><h6>We will let you change your username on some conditions, for more information, contact us on the support page at OffTopic.tk/support</tr></td></h6>
<table><tr><td>
Username:</td><td><input disabled="" type="text" value="<?php print_r($user['none']); ?>" /></td></tr>
<form action="" method="post">
<tr>
<td>Email Address:</td><td><input type="text" name="email" value="<?php print_r($user['Email']); ?>" /></td></tr><tr><td>
Name:</td><td><input type="text" name="name" value="<?php print_r($user['Name']); ?>" /></td></tr><tr><td>
<input type="submit" value="Update" id="buttonsmall" />
</td></tr>
</form>
</table>
</fieldset><br />
<fieldset>
<table>
<legend>Password Settings</legend>
<form action="" method="post">
<tr><td>
Old Password:</td><td><input type="password" name="oldpass" /></td></tr><tr><td>
New Password:</td><td><input type="password" name="newpass" /></td></tr><tr><td>
Retype Password:</td><td><input type="password" name="cnewpass" /></td></tr><tr><td>
<input type="submit" value="Update" id="buttonsmall" />
</td></tr></form></table></fieldset>
<br />
<fieldset>
<legend>Social Settings</legend>
<form action="" method="post">
<table><tr>
<td width="100">
Blurb
</td>
<td>
<textarea name="blurb" width="98%" height="300" style="margin: 2px; height: 101px; width: 891px;"><?php print_r($user['blurb']); ?></textarea>
</td>
</tr><tr><td width="100">
Forum Signature</td>
<td><input type="text" name="siggy" value="<?php print_r($user['Signature']); ?>" /></td>
</tr>
</table><br />
<table>
<tr>
<td><strong>Invisible Mode</strong></td>
<td><select name="incog">
<?php
if ($user['hide'] == '0'){
	?>
<option>Off</option><option>On</option></select>
<?php
}else{
	?>
    <option>On</option><option>Off</option></select>
    <?php
}
?>
</td>
<td>* If Invisible Mode is turned on, your status will appear as offline when you are online or offline.</td>
</tr>
</table><br />
<input type="submit" value="Update" id="buttonsmall" />
</form>
</fieldset>
<?php
include "../Footer.php";