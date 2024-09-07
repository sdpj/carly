<?php

include "Header.php";

echo "
<font size='3'>Send message to all users</font>
<br /><br />
<center>
<form action='' method='post'>
Title:<br /><textarea rows='1' cols='50' name='title'></textarea><br />Body:<br /><textarea rows='7' cols='50' name='body'></textarea><br />
<input type='submit' name='submit' value='Send'></form>";

$getMembers = mysql_query("SELECT ID FROM Users");
$gM = mysql_fetch_object($getMembers);
$title = $_POST['title'];
$body = $_POST['body'];
$submit = $_POST['submit'];

if ($submit) { 

mysql_query("INSERT INTO PMs (SenderID, ReceiveID, Title, Body) VALUES('1','$gM->ID','$title','$body')");
header ("Location: /index.php"); }
?>