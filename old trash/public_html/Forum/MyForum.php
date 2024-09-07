<?php

require_once("../Header.php");


$getThreads = mysql_query("SELECT * FROM TrackedThreads WHERE UserID='$myU->ID'");

print_r("<font size='3'>Threads you're tracking</font><br /><br />");


while ($gT = mysql_fetch_object($getThreads)) {
$getThreadName = mysql_query("SELECT * FROM Threads WHERE ID='$gT->ThreadID'");
$gTN = mysql_fetch_object($getThreadName);
$getPoster = mysql_query("SELECT * FROM Users WHERE ID='$gTN->PosterID'");
$gP = mysql_fetch_object($getPoster);
print_r(" <div style='border:1px solid black;'>
<table width='800'>
<tr>
<td width='400'>
<a href='ViewThread.php?ID=$gTN->ID'>$gTN->Title
</td>
<td width='200'>
$gP->Username
</td>
<td width='200'>
<a href='?action=remove'><font color='red'>Remove</font></a>
</td>
</tr>
</table>
</div>
<br />");
}

$action = mysql_real_escape_string($_GET['action']);

if ($action == "remove") {

mysql_query("DELETE FROM TrackedThreads WHERE ThreadID='$gTN->ID'");

header("Location: $self"); exit();
}
