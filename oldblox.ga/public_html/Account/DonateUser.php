<?php


	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');

$ID = SecurePost($_GET['ID']);



if(!$ID) {
		header("Location: /Error/?code=500");
die();
}
if($ID == $myU->ID) {
		header("Location: /Error/?code=500");

	die();
}
$getUser = mysql_query("SELECT * FROM Users WHERE ID='$ID'");
$gU = mysql_fetch_object($getUser);
$checkuserExist = mysql_num_rows($getUser);

if($checkuserExist == 0)
	{
	header("Location: /Error/?code=500");

	die();
	}
if($myU->IP == $gU->IP) {
	header("Location: /Error/?code=500");

	die();
}
if($myU->Email == $gU->Email) {
	header("Location: /Error/?code=500");

	die();
}
echo"
<div style='padding-left:30px;'>
<font size='5'>Donate $gU->Username Bux</font><br>
												<div class='divider-bottom' style='width:100%;padding-top:3px;margin-bottom:5px;'></div>

<br>All donations are final and are <b>not</b> refundable.<br><br>
<form action='' method='post'>
Amount<font color='green'> <b>(Bux)</b></font>: <input type='text' name='Amount'/><br><br>
<input type='Submit' name='Submit' value='Send' class='btn-primary'/>
</form>
</div>
";

$Amount = SecurePost($_POST['Amount']);
$Submit = SecurePost($_POST['Submit']);
if($Submit) {
if ($myU->Bux < $Amount) {
echo"<br><div id='error'>You do not have enough <font color='green'><b>BUX<b></font>";
}
else{
mysql_query("UPDATE Users SET Bux=Bux+$Amount WHERE ID='$gU->ID'");
mysql_query("UPDATE Users SET Bux=Bux-$Amount WHERE ID='$myU->ID'");
header("Location: /user.aspx?ID=$gU->ID");
}}
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>