<?php
$moderation = $_GET['moderation'];
$ID = $_GET['ID'];
$input = $_GET['search'];
$submit = $_GET['k'];
include "../Header.php";
if (!$myU->Username == "Pheedy"){ header("Location: ../index.php"); exit(); }
if ($myU->PowerAdmin == "true") {
echo"<center><font size='3'><b> Manage Bans Center </b></font><br /><br /></center>";
$User = mysql_query("SELECT * FROM Users WHERE Ban='1'");
$input = $_GET['search'];
echo "<form action='?search=$input' method='get'>  <input type='search' name='search'><input type='submit' name='k' value='Search'></form>";
while ($UserTwo = mysql_fetch_object($User)) {
echo "<center><font color='black'><b> Username:</b> $UserTwo->Username <br /><b>Moderator Note:</b> $UserTwo->BanDescription <br /><b>Bad Content:</b> $UserTwo->BanContent </b><br /><a href='../Manage/Bans.php?moderation=unban&ID=$UserTwo->ID'><font color='red'><b>Unban</b></font> </font><br /><br /><br /></center>"; }
}

if ($moderation == "unban") { 
mysql_query("UPDATE Users SET Ban='0' WHERE ID='$ID'"); header("Location ../Manage/Bans.php");
}

if ($submit) { 
echo "<br /><br /><b> $input </b> ";
}
?>