<?php

include "../Header.php";

if (!$User) {
Error();

}
if ($myU->PowerForumModerator == "true") {

$ID = mysql_real_escape_string($_GET['ID']);

$getThread = mysql_query("SELECT * FROM Threads WHERE ID='$ID'");
$gT = mysql_fetch_object($getThread);
$TopicName = mysql_query("SELECT * FROM Topics WHERE ID='$gT->tid'");
$gTN = mysql_fetch_object($TopicName);
if ($gT->Locked == 1) {
header("Location: ../Forum/ShowPost.php?ID=$ID"); exit(); }
echo"
<font size='5'><div id='forumBar'>Thread editing</font></div>
<br><br />
<b>Title:</b> $gT->Title
<br />
<b>Body:</b> $gT->Body
<br />
<br />
<form action='' method='post'>
<input type='text' name='Title' value='$gT->Title' style='width:327px;'><br />
<b><font size='3'><font color='darkblue'>Thread Body:</font></font></b><br />
<textarea cols='50' rows='15' name='Body'>" . $gT->Body . "</textarea>
<br />
<input type='submit' name='submit' value='Submit'>
</form>

";


$Reply = mysql_real_escape_string(strip_tags($_POST['Body']));
$Submit = $_POST['submit'];
$now = time();
$Title = mysql_real_escape_string(strip_tags($_POST['Title']));
$flood = $now + 30;
if ($Submit) {
if (!$Reply) {
echo"Please include text in your reply";
}
elseif  (strlen($Reply) <= 5) {
echo"You reply must be over 5 characters";
}
elseif ($now < $myU->ForumFlood) {
echo"You are posting too fast";
}
$now = time();
if (($now - $myU->lastflood) < 17) {
echo "You are posting too fast, please wait.";
} else {
mysql_query("UPDATE Users SET lastflood='$now' WHERE ID='$myU->ID'");

mysql_query("UPDATE Threads SET `Body`='$Reply' WHERE ID='$ID'");
mysql_query("UPDATE Threads SET `Title`='$Title' WHERE ID='$ID'");

mysql_query("UPDATE Threads SET Bump='$now' WHERE ID='$ID'");
mysql_query("UPDATE Users SET ForumFlood='$flood' WHERE ID='$myU->ID'");
mysql_query("UPDATE Threads SET Edited='1' WHERE ID='$ID'");
mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','edited thread ID $ID','".$_SERVER['PHP_SELF']."')");
echo("Your edit has been applied. Redirecting...");
ob_end_clean();
header("Location: ShowPost.php?ID=$ID"); exit();
}}
echo"</div></div></div></div></div>";
include($_SERVER['DOCUMENT_ROOT']."/Footer.php");}
?>