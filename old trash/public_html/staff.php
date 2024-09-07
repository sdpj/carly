<?php

	include "Header.php";
	
	$getStaff = mysql_query("SELECT * FROM Users WHERE PowerAdmin='true'");
$getStaff2 = mysql_query("SELECT * FROM Users WHERE PowerMegaModerator='true'");
$getStaff3 = mysql_query("SELECT * FROM Users WHERE PowerForumModerator='true'");
$getStaff4 = mysql_query("SELECT * FROM Users WHERE PowerImageModerator='true'");
	echo"<h4><font color='darkred'>Administrators</h4></font>";
	while ($gS = mysql_fetch_object($getStaff)) {
	echo "<a href='../user.php?ID=$gS->ID'>$gS->Username</a><br />";
	}
echo"<h4><font color='darkred'>Super Moderators</h4></font>";
	while ($gS = mysql_fetch_object($getStaff2)) {
	echo "<a href='../user.php?ID=$gS->ID'>$gS->Username</a> <br />";
	}
echo"<h4><font color='darkred'>Forum Moderators</h4></font>";
	while ($gS = mysql_fetch_object($getStaff3)) {
	echo "<a href='../user.php?ID=$gS->ID'>$gS->Username</a><br />";
	}
echo"<h4><font color='darkred'>Image Moderators</h4></font>";
	while ($gS = mysql_fetch_object($getStaff4)) {
	echo "<a href='../user.php?ID=$gS->ID'>$gS->Username</a><br />";
	}
?>