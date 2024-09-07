<?php $loginalert = "";
if (!$user) {
$username = $_POST['username'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
$email = $_POST['email'];
$submit = $_POST['submit'];

function is_alphanumeric($username) {
return (bool)preg_match("/^([a-zA-Z0-9])+$/i", $username);
}

if ($submit) {
if (!$username||!$password||!$confirmpassword||!$email) {
$loginalert = "Please fill in all required fields";
if($authpage != "true"){
echo "<div class='reg-alert'><p class='basic-font reg-alert-txt'>Please fill in all required fields</p></div>";
}
}
else {
$userExist1 = "SELECT * FROM users WHERE username=:username";
$userExist = $handler->prepare($userExist1);
$userExist->execute(array(':username' => $username));
$userExist = ($userExist->rowCount());
if ($userExist > 0) {
$loginalert = "That username already exists";
if($authpage != "true"){
echo "<div class='reg-alert'><p class='basic-font reg-alert-txt'>That username already exists</p></div>";
}
}
else {
if ($password != $confirmpassword) {
$loginalert = "Your password and confirm password does not match";
if($authpage != "true"){
echo "<div class='reg-alert'><p class='basic-font reg-alert-txt'>Your password and confirm password does not match</p></div>";
}
}
else {
if (strlen($username) >= 15) {
$loginalert = "Your username is too long";
if($authpage != "true"){
echo "<div class='reg-alert'><p class='basic-font reg-alert-txt'>Your username is too long</p></div>";
}
}
elseif (strlen($username) < 3) {
$loginalert = "Your username is too short";
if($authpage != "true"){
echo "<div class='reg-alert'><p class='basic-font reg-alert-txt'>Your username is too short</p></div>";
}
}
elseif (strlen($password) <= 4) {
$loginalert = "Your password is too short";
if($authpage != "true"){
echo "<div class='reg-alert'><p class='basic-font reg-alert-txt'>Your password is too short</p></div>";
}
}
elseif (!is_alphanumeric($username)) {
$loginalert = "You username contains some invalid characters";
if($authpage != "true"){
echo "<div class='reg-alert'><p class='basic-font reg-alert-txt'>You username contains some invalid characters</p></div>";
}
} else {
//$encrypt = password_hash($password, PASSWORD_BCRYPT, array(
//	'cost' => 12
//));
//justhost doesn't support bcrypt :(
$encrypt1 = hash('sha512',$password);
$encrypt = hash('sha512',$encrypt1);
$date = time();
session_start();
$_SESSION['username'] = $user;
$_SESSION['hash'] = $encrypt;
$ip = $_SERVER['REMOTE_ADDR'];
$data1 = "INSERT INTO users (username, password, email, ip, datecreated, visittick) VALUES (:username, :password, :email, :ip, :datecreated, :datecreated)";
$data2 = $handler->prepare($data1);
$data2->execute(array(':username' => $username, ':password' => $encrypt, ':email' => $email, ':ip' => $ip, ':datecreated' => $date));
$giveEmeralds = $handler->query("UPDATE users SET emeralds=5 WHERE username='$username'");
if($authpage != "true"){
header("Location: /Login/");
}else{
header("Location: /auth/login");
}
exit();
}
}
}
}
}
} else {
if($authpage != "true"){
header("Location: /Login/");
}else{
header("Location: /auth/login");
}
exit();	
}
?>