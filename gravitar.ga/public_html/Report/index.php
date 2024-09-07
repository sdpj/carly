<?php
include "../global.php";
if ($logged == false){
	die("You're not logged in!");
}
$type = 0;
$id = 0;
if ($_GET['type'] && $_GET['id']){
	$type = mysql_real_escape_string($_GET['type']);
	$id   = mysql_real_escape_string($_GET['id']);
}else{
	die("You must specify the type and id");
}
if ($type == 0 || $id == 0){
	die("You must specify the type and id");
}
if ($_POST['reason']){
	$comment = 'No comment given.';
	$reason = mysql_real_escape_string($_POST['reason']);
	if ($_POST['comment']){
		$comment = mysql_real_escape_string($_POST['comment']);
	}
	mysql_query("INSERT INTO `Report_User` (`reason`, `comment`, `userid`, `reporterid`) VALUES ('$reason', '$comment', '$id', '$uid')");
	message("Report Sent", "Thanks, your report has been sent successfully.", "../Home.php", "Back Home", false, '');
}
?>
<div style="width: 80%; margin-left: auto; margin-right: auto; border: 1px solid black; background-color: #D5D5D5; color: black; padding: 7px; text-align: center;">
<h1>You are reporting <?php if ($type == '1'){
	$userf = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$id'"));
	if ($userf == 0){
		die("An error occurred. Perhaps the user does not exist?");
	}
	print_r($userf['Username']); } ?>!</h1><br><center>
    <form action="?type=<?php print_r($type); ?>&id=<?php print_r($id); ?>" method="post">
    <table>
    <tr>
    <td style="text-align: left; vertical-align: text-top;">
    <strong>Reason</strong>
    </td>
    <td style="text-align: left; vertical-align: text-top;">
    <select name="reason">
    <option>Swearing</option>
    <option>Online Dating</option>
    <option>Adult Content</option>
    <option>Personal Attack</option>
    </select>
    </td>
    </tr>
    <tr>
    <td style="text-align: left; vertical-align: text-top;">
    
    </td>
    <td style="text-align: left; vertical-align: text-top;">
    <textarea name="comment" style="margin: 2px; width: 618px; height: 89px;" placeholder="Please explain further."></textarea>
    </td>
    </tr>
    </table><br>
    <input type="submit" value="Send Report" />
    </form>
    </div>
    