<?php

include "Header.php";
if (!$User) {
header("Location: index.php"); exit();
}

$to = ''.$myU->Email.'';
$subject = 'Gravitar account verify';
$Body = 'Go here to verify: http://mobix.esy.es/verify.php?Code='.$myU->Hash.'';
$headers = 'From: help@Gravitar.net';

if (mail($to,$subject,$Body,$headers)) {
echo"<center><font size='4'> Email Sent to $myU->Email<br /></font>
Make sure to check your spam folder</center>"; }
else { echo"<font size='4'>Error sending email</font>"; }