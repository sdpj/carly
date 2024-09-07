<?php
include "Header.php";

$getRich = mysql_query("SELECT * FROM Users WHERE Bux > 10000000");
while ($gR = mysql_fetch_object($getRich)) {
$BuxDivide = round($gR->Bux*0.90);
$BuxDivide = $BuxDivide/75;
echo "<table><tr><td width='200'>$gR->Username</td><td width='500'>".number_format($gR->Bux)."</td><td style='padding-left:50px;'>".round($BuxDivide)."</td></tr></table>";
}

//mysql_query("UPDATE Users SET Bux=Bux + 100");