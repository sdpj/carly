<?php

include "../Header.php";
if (!$User) { header("Location: ../index.php"); exit(); }
$getAds = mysql_query("SELECT * FROM RunningAds WHERE Username='$myU->Username'");



echo"


<center><b><font size='4'>Running ads</font></b><br />
<br /><br /><br />
<table>
<tr>
<td width='300'>
<b>Name</b>
<td width='300'>
<b>Image link</b>
</td>
<td width='300'>
<b>Voins Earned</b>
</td>
</tr>
</table>";
while ($gA = mysql_fetch_object($getAds)) { echo"<br /><br /><div style='border:1px solid black;background-color:white;'>

<table>
<tr>
<td width='300'>
$gA->Name
</td>
<td width='300'>
$gA->ImageLink
</td>
<td width='300'>
$gA->MoneyMade
</td>
</tr>

</table></div><br />
";


}