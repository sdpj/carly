<?php

include "../Header.php";
$ADLink = $_GET['link'];
$adsystem = mysql_fetch_object($adsystem = mysql_query("SELECT * FROM Adsystem"));
if ($adsystem->ads == "true") {
if (!$User) {
    header("Location: ../index.php"); exit();
    
}
echo"

<font size='6'><b><center>Create User Advertisement</center></font></b>

<br /><br /><br />
<b><font color='darkred'>*You are about to create an advertisement on $ADLink that will be viewed throughout the website.<br /><br />
<b>*The minimum bid amount for advertisements is <font color='green'>50 VOINS</font>.</b></font>
<br /><br /><a href='../Images/AdTemplate.png'><font color='blue'><b>Click here for the ad Template</font></a></td><br>
<table>
<br>
<form action='' method='post'>
<tr>
<td><b>Ad Name:</b></td>
<td>
<input type='text' name='name'>
</td>
</tr>
<tr>
<td><b>Image Link:</b></td>
<td><input type='text' name='adlink' placeholder='URL link here...'> 
</tr>
<tr>
<td>
<b>Bid:</b>
</td>
<td>
<input type='text' name='bid' placeholder='Bid atleast 50 Voins'>
</td>

</tr>
<td><b>All Ads run for 24 hours.</td></b><br>
<td><input type='submit' name='run' value='Submit'>
</td>


</form>
</table>


";
} else {
echo "<h1>Ad System is currently disabled</h1>";
}

$Bid = $_POST['bid'];
$Link = $_POST['adlink'];
$Name = $_POST['name'];
$Submit = $_POST['run'];
$Time = time()+86400;

if ($Submit) {
if ($Bid > $myU->Bux) {
    
    echo"<font color='red'>ERROR: You do not have enough <font color='green'>VOINS</FONT> to complete this action.</font>";
    
    
    
    
    
}
elseif($Bid <= 49) {
    echo"<font color='red'>ERROR: You must bid at least <font color='green'>50 VOINS</FONT> to complete this action.</font>";
} 
elseif(!$Link) {
    echo"<font color='red'>ERROR: You must include an image link to complete this action.</font>";
}
elseif(!$Name) {
echo"<font color='red'>ERROR: You must provide an Ad Name to complete this action.</font>"; }
else { mysql_query("INSERT INTO PendingAds (Username, ImageLink, Bid, Link, Time, Name) VALUES ('$myU->Username','$Link','$Bid','$ADLink','$Time','$Name')"); 
mysql_query("UPDATE Users SET Bux=Bux - $Bid WHERE ID='$myU->ID'");echo "<font color='green'>Your advertisement is pending moderation.</font>";
}}


include "../Footer.php";
?>


