<?php


include "Header.php";
$Setting = array(
			"PerPage" => 8
		);
		$Page = $_GET['Page'];
		if ($Page < 1) { $Page=1; }
		if (!is_numeric($Page)) { $Page=1; }
		$Minimum = ($Page - 1) * $Setting["PerPage"];
if ($myU->PowerAdmin != "true") {
header("Location: index.php"); exit(); }
echo"<b>Chat Logs</b><br /><br />";
$getMessages = mysql_query("SELECT * FROM chatmessages ORDER BY ID DESC LIMIT  {$Minimum},  ". $Setting["PerPage"]);




echo "<table width='900'>
<tr>
<td width='200'>
<b>Sender</b>
</td>
<td>
<td width='200'>

</td>
<td width='300'>
<b>Message Text</b> 
</td>
<td width='200'>

</td>

</tr>
</table>
<br />
";
while ($gM = mysql_fetch_object($getMessages)) {



echo"
<table width='900'>
<tr>
<td width='400'>
$gM->username
</td>

<td width='500'>
$gM->message
</td>


</tr>
</table><br /><br />";
}
$amount=ceil($num / $Setting["PerPage"]);
if ($Page > 1) {
echo '<a href="partychatlogs.php?Page='.($Page-1).'">Prev</a> - ';
}
echo ''.$Page.'/'.(ceil($num / $Setting["PerPage"]));

echo ' - <a href="partychatlogs.php?Page='.($Page+1).'">Next</a>';
