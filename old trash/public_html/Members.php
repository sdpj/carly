<?php
include "Header.php";
	$q = mysql_real_escape_string(strip_tags(stripslashes($_POST['q'])));
	$s = mysql_real_escape_string(strip_tags(stripslashes($_POST['s'])));
$numMem = mysql_query("SELECT * FROM Users");
$num = mysql_num_rows($numMem);
echo "<center>

<div style='border:2px solid d1cdcd; width:75%;background-color:bdbdbd;'><b></b><br />
<b>Total Members: </b> $num<br /><br />
<form action='' method='post'>

<b>Search: </b><input type='search' name='q' style='width:45%'>
<input type='submit' name='submit' value='Find'><br />
<a href='staffonline.php'><b>Admins <font color='green'>Online</font> (".$NumOnline = mysql_num_rows($NumOnline = mysql_query("SELECT * FROM Users WHERE PowerAdmin='true' AND $now < expireTime")).")</a> |
<a href='modonline.php'><b>Moderators <font color='green'>Online</font> (".$NumOnline = mysql_num_rows($NumOnline = mysql_query("SELECT * FROM Users WHERE PowerMegaModerator='true' AND $now < expireTime")).")</a> 
| <a href='online.php'><b>Users <font color='green'>Online</font> (".$NumOnline = mysql_num_rows($NumOnline = mysql_query("SELECT * FROM Users WHERE $now < expireTime")).")</a></center>

</form>";

$getMembers = mysql_query("SELECT * FROM Users WHERE Ban='0' AND Username LIKE '%$q%' ORDER BY ID");
$submit = $_POST['submit'];
if ($submit) {
echo"
Results<br /> ";
 while ($gM = mysql_fetch_object($getMembers))
{
echo " <br/><div style='border:1px solid black; background-color:#F2F2F2;'><br />
<table width='900'>
<tr>
<td width='400'>
<a href='user.php?ID=$gM->ID'>$gM->Username</a>
</td>
<td width='500'>
$gM->Description
</td>
</tr>
</table><br /></div><br />";


}

}










echo "  <br /><br /><br /><br /><br /><br /><br /><br /> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
include "Footer.php";