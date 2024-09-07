<?php
	include($_SERVER['DOCUMENT_ROOT']."/Header.php");
$ID = SecurePost($_GET['ID']);
if (!$User) {
		
			header("Location: ");
			die();
		
		}
		if (!$ID) {
		
			header("Location: ");
		die();
		}
if($ID == $myU->ID) {
header("Location: ../user.aspx?ID=$myU->ID");
		die();
}
		
$getUser = mysql_query("SELECT * FROM Users WHERE ID='$ID'");
$gU = mysql_fetch_object($getUser);
echo"<div style='padding-left:30px'>
<form action='' method='post'>
<font size='5'>Send a message to $gU->Username</font><br><br><br>
<table width='600px'>
<tr>
<td width='150px'><b>To:</b></td><td> <a href='../user.aspx?ID=$gU->ID'>$gU->Username</a></td>
</tr>
<tr>
<td width='150px'><b>From:</b></td><td> <a href='../user.aspx?ID=$myU->ID'>$myU->Username</a></td>
</tr>
<tr>
<td width='150px'><b>Title:</b></td><td><input type='text' name='Title' style='width:500px;'/></td>
</tr>
<tr>

<td width='150px'><b>Body:</b></td><td><textarea name='Body' style='width:504px;height:200px;resize:none;'/></textarea></td>
</tr>


</table>
<div style='padding-left:535px'><input type='Submit' class='btn-primary' name='Send' value='Send'/></div>
</form>
";
$Title = SecurePost(filter($_POST['Title']));
$Body = SecurePost(filter($_POST['Body']));
$Send = SecurePost($_POST['Send']);
$Time = time();
if($Send){
if(!$Title){
echo"<br><div id='error'>You must have a title.";
die();
}
elseif (strlen($Title) > 100) {
echo"<br><div id='error'>Your title is too long (Max 100 Characters).";
die();
}
else {
mysql_query("INSERT INTO PMs (SenderID, ReceiveID, Title, Body, time, LookMessage) VALUES ('$myU->ID','$gU->ID','$Title','$Body','$Time','0')");
header("Location: ../user.aspx?ID=$ID");
die();
}


}
include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
