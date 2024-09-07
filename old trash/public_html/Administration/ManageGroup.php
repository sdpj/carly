<?php

require_once("Header.php");

$ID = mysql_real_escape_string($_GET['ID']);
if ($myU->PowerMegaModerator != "true") {
header("Location: index.php"); exit();
}

$getGroup = mysql_query("SELECT * FROM Groups WHERE ID='$ID'");
$gG = mysql_fetch_object($getGroup);
$getOwner = mysql_query("SELECT * FROM Users WHERE ID='$gG->OwnerID'");
$gO = mysql_fetch_object($getOwner);
$logo = sha1($gG->Logo);


echo "
<br />
<br />

<table width='900'>
<tr>
<td width='400'>
<b>Group Name:</b> $gG->Name
</td>
<td width='500'>
<b>Description: </b>$gG->Description
</td>
</tr>
</table>

<br />
<br />

<b>Owner:</b> $gO->Username

<br />
<br />
<b>Logo: </b>
<br /><br /> 
<img src='../Groups/GL/$gG->Logo' height='100'>
<br /><br />
<form action='' method='post'>
<b>Change Name</b>: <input type='text' name='GroupName'>
<input type='submit' name='Update' value='Submit'>

</form>
<form action='' method='post'>
<b>Change Owner</b>: <input type='text' name='GroupOwner'>
<input type='submit' name='gown' value='Change'>
</form>
<br />
<br />

<table>
<tr>
<td>
<a href='?ID=$ID&scrub=logo'>Scrub Logo</a>
</td>
<td>
<a href='?ID=$ID&scrub=name'>Scrub Name</a>
</td>
<td>
<a href='?ID=$ID&scrub=description'>Scrub Description</a>
</td>
</tr>
</table>



";


$scrub = $_GET['scrub'];


if ($scrub == "logo") {
mysql_query("UPDATE Groups SET Logo='X.png' WHERE ID='$gG->ID'");


}
if ($scrub == "name") {
mysql_query("UPDATE Groups SET Name='[ Content Deleted $ID ]' WHERE ID='$gG->ID'");


}
if ($scrub == "description") {
mysql_query("UPDATE Groups SET Description='[ Content Deleted ]' WHERE ID='$gG->ID'");

}
$Submit = $_POST['Update'];
$ChangeName = $_POST['GroupName'];
if ($Submit) {

mysql_query("UPDATE Groups SET Name='$ChangeName' WHERE ID='$gG->ID'");
}


