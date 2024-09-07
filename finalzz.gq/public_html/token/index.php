<?php
$pagename = 'Discord token';
$pagelink = '/token';
include('../header.php');
?>
<?php
if ($user) {
?>
<?php
function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
$gen = generateRandomString();
$username = $myu->username;
$handler->query("UPDATE users SET discordtoken='$gen' WHERE username='$username'");
?>
</center>
<div class="col s12 m9 l8">
<div class="container" style="width:100%;">
<div class="content-box">
<div class="header-text">Discord token generated!</div></br>
<div style="font-size:16px;">Your discord token is: <b><?php echo $gen; ?></b>, join the discord server to use it.</div>
<?php
} else {
header('Location: /Register');
}
?>