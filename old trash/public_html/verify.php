<?php

include "Header.php";

$Code = $_GET['Code'];
if (!$User) {
header("Location: index.php"); exit();
}
if (!$Code) {
header("Location: index.php"); exit();
}


if ($Code != $myU->Hash) {
header("Location: index.php"); exit();
}
if ($myU->Verified == 1) {
header("Location: index.php"); exit();
}

else {




echo "<center><font size='4'><font color='green'>Verified</font></font><br /><br />Your account is now <font color='green'>verified</font></center>";
mysql_query("INSERT INTO Badges (UserID, Position) VALUES ('$myU->ID','Verified User')");
mysql_query("UPDATE Users SET Verified='1' WHERE ID='$myU->ID'");
}