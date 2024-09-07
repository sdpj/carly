<?php



require_once("Header.php");

$ID = mysql_real_escape_string($_GET['ID']);
$getUser = mysql_query("SELECT * FROM Users WHERE ID='$ID'");
$User = mysql_fetch_object($getUser);

if ($myU->PowerAdmin != "true") {
header("Location: index.php"); exit();

}


print_r("
<br />
<fieldset>
<legend>Editing User $User->Username</legend>

<br />
<a href='ManageUser.php?ID=$ID'>&larr; Back to user </a>
<br />

<br /><br />


<b>Edit descripton</b><br /><br />

<font color='blue'><b>Current Description:</b></font> $User->Description</font><br /><br />





<form action='' method='post'>

<textarea name='description' rows='10' style='width:30%;' value='$User->Description'></textarea>
<br /><input type='submit' name='submitdesc' value='Save' style='width:30%;'><br />
<br /><b>Edit Username</b>
<br /><br />
<input type='text' name='username' style='width:30%;'>
<br />
<input type='submit' name='submitname' value='Save' style='width:30%;'>
</form>

");

if ($myU->Username == "MOBIX"||$myU->Username == "kappa"||$myU->Username == "coocbooc") {

print_r(" <form action='' method='post'>
<br />
<b>Give voins</b><br /><br />
<input type='text' name='voins' style='width:30%;'>
<br />
<input type='submit' name='submitvoins' value='Give' style='width:30%;'>
</form>"); }

$NewDesc = $_POST['description'];
$DescSubmit = $_POST['submitdesc'];
$Name = $_POST['username'];
$NewNameSub = $_POST['submitname'];
$Voins =  $_POST['voins'];
$VoinsSubmit = $_POST['submitvoins'];
if ($DescSubmit) {
mysql_query("UPDATE Users SET Description='$NewDesc' WHERE ID='$ID'");
header("Location: $self?ID=$ID");

}
if ($NewNameSub) {
mysql_query("UPDATE Users SET Username='$Name' WHERE ID='$ID'");
header("Location: $self?ID=$ID"); 
}

if ($VoinsSubmit) {
mysql_query("UPDATE Users SET Bux=Bux + $Voins WHERE ID='$ID'");
header("Location: $self?ID=$ID");
}
?>




