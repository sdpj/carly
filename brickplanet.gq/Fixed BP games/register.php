<?php
include "Header.php";
$Configuration = mysql_fetch_object($Configuration = mysql_query("SELECT * FROM Configuration"));
if ($Configuration->Register == "true") {

if (!$User) {
$UsernameIs = mysql_real_escape_string(strip_tags(stripslashes($_GET['UsernameIs'])));
echo '
<script src="https://www.google.com/recaptcha/api.js"></script>
<form action="" method="POST">
<div class="container white z-depth-2" style="height: 620px">
	<ul class="tabs" style="background-color: #4d90ea">
		<li class="tab col s3"><a class="white-text active" href="#login">Register</a></li>
	</ul>
	<div id="register" class="col s12">
		<form class="col s12">
			<div class="form-container">
				<div class="row">
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input type="text" name="_Username" value="'.$UsernameIs.'" class="validate">
						<label for="_Username">Username</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input type="password" name="_Password" class="validate">
						<label for="_Password">Password</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input type="password" name="_ConfirmPassword" class="validate">
						<label for="_ConfirmPassword">Confirm Password</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input type="text" name="_Email" class="validate">
						<label for="_Email">Email Address</label>
                                                <div class="g-recaptcha" data-sitekey="6LcqRw8UAAAAALLEnrcaPDbzXOktL4xQzQqKQ_nF"></div>
					</div>
				</div>
				<center>
					<button class="btn waves-effect waves-light" style="background-color: #4d90ea" type="submit" name="_Submit" value="Register">Register</button>
				</center>
			</div>
		</form>
	</div>
</div>
</form>
';
$response = SecurePost($_POST['g-recaptcha-response']);
$Username = mysql_real_escape_string(strip_tags(stripslashes($_POST['_Username'])));
$Password = mysql_real_escape_string(strip_tags(stripslashes($_POST['_Password'])));
$ConfirmPassword = mysql_real_escape_string(strip_tags(stripslashes($_POST['_ConfirmPassword'])));
$Email = mysql_real_escape_string(strip_tags(stripslashes($_POST['_Email'])));
$Submit = mysql_real_escape_string(strip_tags(stripslashes($_POST['_Submit'])));
$ref = mysql_real_escape_string(strip_tags(stripslashes($_GET['ref'])));
					function is_alphanumeric($username)
					{
						return (bool)preg_match("/^([a-zA-Z0-9._])+$/i", $username);
						 
					}
					
if ($Submit) {
if($response){
$Username = filter($Username);
if (!$Username||!$Password||!$ConfirmPassword) {
echo "<b>Please fill in all required fields.</b>";
}
else {
$userExist = mysql_query("SELECT * FROM Users WHERE Username='$Username'");
$userExist = mysql_num_rows($userExist);
$userExist1 = mysql_query("SELECT * FROM Users WHERE OriginalName='$Username'");
$userExist1 = mysql_num_rows($userExist1);
if ($userExist > 0) {
echo "<script>alert('That username already exists.')</script>";
}
elseif ($userExist1 > 0) {
echo "<script>alert('')</script>";
}
else {
if ($ConfirmPassword != $Password) {
echo "<script>alert('Your password and confirm password does not match.')</script>";
}
else {
if (strlen($Username) >= 15) {
echo "<script>alert('Your username is above fifteen (15) characters!')</script>";
}
elseif (strlen($Username) < 3) {
echo "<script>alert('Your username is under three (3) characters!')</script>";
}
elseif (!is_alphanumeric($Username)) {
echo "<script>alert('Only A-Z, 1-9, _, and . are allowed, or there is profanity in your username.')</script>";
}
else {

	if ($ref) {
	
		$getRef = mysql_query("SELECT * FROM Users WHERE ID='$ref'");
		$gR = mysql_fetch_object($getRef);
		$RefExist = mysql_num_rows($getRef);
		
			if ($RefExist == 0) {
			
				//dont do anything lol
			
			}
			else {
			
				//if ($_SERVER['PHP_SELF'] == $gR->IP) {
				
					//dont do anything lol
				
				//}
				//else {
					$userExist = mysql_query("SELECT * FROM Users WHERE Username='$Username'");
					$userExist = mysql_fetch_object($userExist);
					mysql_query("UPDATE Users SET SuccessReferrer=SuccessReferrer + 1 WHERE ID='$ref'");
					mysql_query("INSERT INTO Referrals (ReferredID, UserID) VALUES('$ref','$userExist->ID')");
				
				//}
			
			}

	}

$_ENCRYPT = hash('sha512',$Password);
$_ENCRYPT2 = hash('sha512',$Email);
$IP = $_SERVER['REMOTE_ADDR'];
mysql_query("INSERT INTO Users (Username, Password, Email, IP) VALUES('$Username','$_ENCRYPT','$_ENCRYPT2','$IP')");
$_SESSION['Username']=$Username;
$_SESSION['Password']=$_ENCRYPT;
header("Location: index.php");
}
}
}
}
}
else{
echo "<script>alert('ReCaptcha Needed!')</script>";
}
}
}
echo "";
}
else {
echo "<b>Register has been temporarily disabled.</b>";
}

include "Footer.php";
