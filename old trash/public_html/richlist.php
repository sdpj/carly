<?php
include "Header.php";

$getRich = mysql_query("SELECT * FROM Users WHERE Bux > 25000");
while ($gR = mysql_fetch_object($getRich)) {
$BuxDivide = round($gR->Bux*0.90);
$BuxDivide = $BuxDivide/75;
echo"<center><font color='darkred'><h3>Rich List (by VOINS)</h3></font></center>";
echo "<br><table><tr><td width='200'><b><font color='darkblue'><font size='2'>'$gR->Username' has a total of...</FONT></b></font> </td><td width='500'><font color='green'><b>$".number_format($gR->Bux)." VOINS</font></b></td><td style='padding-left:50px;'></td></tr></table>";
}