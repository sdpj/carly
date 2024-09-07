<?php


include "Header.php";

if ($myU->PowerAdmin != "true") {
header("Location: index.php"); exit(); }
echo"Recent Chat Logs ( Last 3 messages sent )<br /><br />";
$getMessages = mysql_query("SELECT * FROM PMs ORDER BY ID DESC LIMIT 3");




echo "<table width='900'>
<tr>
<td width='200'>
<b>Sender</b>
</td>
<td>
<td width='200'>
<b>Receiver</b>
</td>
<td width='300'>
<b>Title</b>
</td>
<td width='200'>
<b>Body</b>
</td>

</tr>
</table>
<br />
";
while ($gM = mysql_fetch_object($getMessages)) {
$getSender = mysql_query("SELECT * FROM Users WHERE ID='$gM->SenderID'");
$getS = mysql_fetch_object($getSender);
$getReciever = mysql_query("SELECT * FROM Users WHERE ID='$gM->ReceiveID'");
$getR = mysql_fetch_object($getReciever);


echo"
<table width='900'>
<tr>
<td width='200'>
$getS->Username
</td>
<td>
<td width='200'>
$getR->Username
</td>
<td width='400'>
$gM->Title
</td>
<td width='100'>
$gM->Body
</td>

</tr>
</table><br /><br />";
}