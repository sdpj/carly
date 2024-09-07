<?php 

include "Header.php";

if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
	if ($_GET['deleteReport']){
		$id = mysql_real_escape_string($_GET['deleteReport']);
		$arr = mysql_fetch_array(mysql_query("SELECT * FROM `UserReports` WHERE `ID`='$id'"));
		if ($arr == '0'){
			die("That report doesn't exist, perhaps it was already deleted?");
		}
		mysql_query("DELETE FROM `UserReports` WHERE `ID`='$id'");
		ob_end_clean();
		header('location: ViewReports.php');
		echo("User Report ID " . $id . " was deleted successfully.");
	}
	if ($_GET['deleteForumReport']){
		$id = mysql_real_escape_string($_GET['deleteForumReport']);
		$arr = mysql_fetch_array(mysql_query("SELECT * FROM `ForumReports` WHERE `ID`='$id'"));
		if ($arr == '0'){
			die("That report doesn't exist, perhaps it was already deleted?");
		}
		mysql_query("DELETE FROM `ForumReports` WHERE `ID`='$id'");
		ob_end_clean();
		header('location: ViewReports.php');
		echo("Forum Report ID " . $id . " was deleted successfully.");
	}
$q = mysql_query("SELECT * FROM UserReports ORDER BY ID");
?><br>
<font size="3">Reports</font><br>
<?php
/*$qq = mysql_num_rows($q);
$rot = 0;
for ($count = 1; $count <= $qq; $count ++){
	if ($rot == 0){	$rot = 1;	}else{	$rot = 0;	}
	$qr = mysql_fetch_array($q);
	$reporter = $qr['UserWhoSent'];
	$reporterarray = mysql_fetch_array(mysql_query("SELECT * FROM `Users` WHERE `Username`='$reporter'"));
	$reportee = $qr['UserReported'];
	$reporteearray = mysql_fetch_array(mysql_query("SELECT * FROM `Users` WHERE `Username`='$reportee'"));
	?>
	<table width="98%">
    <tr style="background-color: #<?php
    if ($rot == 0){
		print_r("FFFFFF");
	}else{
		print_r("C4C4C4");
	} ?>">
    <td width="200" style="text-align: left;">
    Reporter: <a href="user.php?ID=<?php print_r($reporterarray['ID']); ?>"><?php print_r($reporter); ?></a>
    </td>
    <td width="200" style="text-align: left;">
    Reported User: <a href="user.php?ID=<?php print_r($reporteearray['ID']); ?>"><?php print_r($reportee); ?></a>
    </td>
    <td width="400" style="text-align: center; max-width: 400px; overflow: auto; height: auto;">
    Comment:<br>
    <?php print_r(strip_tags(nl2br($qr['Report']))); ?>
    </td>
    <td width="100" style="text-align: left; max-width: 100px; overflow: auto; height: auto;">
    <a href="?deleteReport=<?php print_r($qr['ID']); ?>">[Delete]</a> or <a href="?banUser=<?php print_r($reporteearray['ID']); ?>">[Ban]</a>
    </td>
    <td>
    Date: <?php print_r($qr['Date']); ?>
    </td>
    </tr>
    </table>
    <?php
}*/


$q = mysql_query("SELECT * FROM ForumReports ORDER BY ID");
?><br>
<font size="3">Forum Reports</font><br>
<?php
$qq = mysql_num_rows($q);
$rot = 0;
for ($count = 1; $count <= $qq; $count ++){
	if ($rot == 0){	$rot = 1;	}else{	$rot = 0;	}
	$qr = mysql_fetch_array($q);
	$reporter56 = $qr['UserWhoSent'];
	$reporterarray58 = mysql_fetch_array(mysql_query("SELECT * FROM `Users` WHERE `Username`='$reporter'"));
	$reportee56 = $qr['UserReported'];
	$reporteearray58 = mysql_fetch_array(mysql_query("SELECT * FROM `Users` WHERE `Username`='$reportee'"));
	?>
	<table width="98%">
    <tr style="background-color: #<?php
    if ($rot == 0){
		print_r("FFFFFF");
	}else{
		print_r("C4C4C4");
	} ?>">
    <td width="200" style="text-align: left;">
    Reporter: <a href="user.php?ID=<?php print_r($reporterarray58['ID']); ?>"><?php print_r($reporter56); ?></a>
    </td>
    <td width="200" style="text-align: left;">
    Reported User: <a href="user.php?ID=<?php print_r($reporteearray58['ID']); ?>"><?php print_r($reportee56); ?></a>
    </td>
    <td width="100" style="text-align: center; max-width: 100px; overflow: auto; height: auto;">
    Comment:<br>
    <?php print_r(strip_tags(nl2br($qr['Report']))); ?>
    </td>
    <td width="200" style="text-align: center; max-width: 200px; overflow: auto; height: auto;">
    Offensive Body Content:<br>
    <?php print_r(strip_tags(nl2br($qr['Body']))); ?>
    </td>
    <td width="100" style="text-align: center; max-width: 300px; overflow: auto; height: auto;">
    Offensive Body Title:<br>
    <?php print_r(strip_tags(nl2br($qr['Title']))); ?>
    </td>
    <td width="100" style="text-align: left; max-width: 100px; overflow: auto; height: auto;">
    <a href="?deleteForumReport=<?php print_r($qr['ID']); ?>">[Delete]</a>
    </td>
    <td>
    Date: <?php print_r($qr['Date']); ?>
    </td>
    </tr>
    </table>
    <?php
}
}else{
die("You can't access this.");
}
?>