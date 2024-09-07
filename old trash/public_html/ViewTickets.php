<?php

include "Header.php";
if ($myU->PowerAdmin != "true") {
    header("Location: ../index.php");
}
$getReports = mysql_query("SELECT * FROM Tickets WHERE Active='0'");
$Pending = mysql_num_rows($getReports);


    echo"
   <center> <font size='4'><b>Waiting Tickets</b></font>
    <hr width='75%'>
    <font size='1'>There are <b>$Pending</b> tickets open</font><br /><br />
   


";
while($gR = mysql_fetch_object($getReports)) { 
$User = mysql_query("SELECT * FROM Users WHERE Username='$gR->Username'");
$gU = mysql_fetch_object($User);

echo"
<table>
<tr>
<td width='200'>
<b>Ticket ID</b>
</td>
<td width='200'>
<b>Username</b>
</td>
<td width='200'>
<b>Detail</b>
</td>

</tr>

<tr>
<td width='200'>
$gR->Code
</td>
<td width='200'>
$gR->Username
</td>
<td width='200'>
$gR->Detail
</td>
<td width='200'>
<a href='?action=close'><font color='red'>Close</font></a> | <a href='SendMessage.php?ID=$gU->ID'><font color='red'>Reply</font></a>
</td>
</tr>

<br /></center>
    ";
$Action = $_GET['action'];

if ($Action == "close") {
    
mysql_query("UPDATE Tickets SET Active='1' WHERE ID='$gR->ID'");
header("Location: ViewTickets.php"); exit();
}
    
}
?>