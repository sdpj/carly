<?php

include "Header.php";
if (!$User) {
header("Location: ../index.php"); exit(); }
$Username = $myU->Username;

$Code = SecurePost(rand(1111, 999999));
$Tickets = mysql_query("SELECT * FROM Tickets WHERE Username='$myU->Username'");
$Open = mysql_num_rows($Tickets);
echo "<font size='4'><b><center><font color='darkblue'>Customer Service Center</font><hr width='70%'></b></font>
<b><font size='2'>With detail, let us know what's up. :)</font></b>
</center><b>You have $Open ticket(s) pending review.<center><br /><br />
<br>
<li><font color='darkred'>*This is not a report system. Use our Report Abuse buttons for reporting.</font></li>
<li><font color='darkred'>*Include links to your issue(s) and or problem if possible.</font></li>
<li><font color='darkred'>*Be descriptive - don't be shy. We're here to help.</font></li>
<li><font color='darkred'>*Further help can be found by emailing <a mail-to:help@Gravitar.net><font color='darkblue'>help@Gravitar.net</a>.</font></li>
<br>
<form action='' method='post'>
<textarea name='Detail' rows='7' style='width:50%'></textarea>
<br />
<input type='submit' name='Send' value='Send Report'><br />
"
;

$Submit = SecurePost($_POST['Send']);
$Detail = SecurePost($_POST['Detail']);
if ($Submit) {
if (!$Detail) {
    echo "You did not include any information in your report";}
   
else { mysql_query("INSERT INTO Tickets (Username, Detail, Code) VALUES ('$myU->Username','$Detail','$Code')");
echo"<font color='geen'>You have opened a support ticket (#$Code)</font>"; } }
echo"<br /><br /><br />";
include "Footer.php";
?>