<?php

include "../Header.php";

if (!$User) {
Error();

}


$ID = mysql_real_escape_string($_GET['ID']);

$getThread = mysql_query("SELECT * FROM Threads WHERE ID='$ID'");
$gT = mysql_fetch_object($getThread);
$TopicName = mysql_query("SELECT * FROM Topics WHERE ID='$gT->tid'");
$gTN = mysql_fetch_object($TopicName);
if ($gT->Locked == 1) {
header("Location: ../Forum/ViewThread.php?ID=$ID"); exit(); }
echo"
<center><font size='3'>Replying to: $gT->Title</font></center><br />
<a href='../Forum/index.php'><font color='blue'><b>Forum</b></font></a> &rarr; <a href='../Forum/ViewTopic.php?ID=$gTN->ID'><font color='blue'><b>$gTN->TopicName</b></font></a> &rarr; <a href='../Forum/ViewThread.php?ID=$ID'><font color='blue'><b>$gT->Title</b></font></a> &rarr; Reply <center>
<br />

<form action='' method='post'>
<b>Body</b><br />
<textarea cols='50' rows='15' name='Body'></textarea>
<br />
<input type='submit' name='submit' value='Submit'>
</form>

";


$Reply = mysql_real_escape_string(BBCode(filter($_POST['Body'])));
$Submit = mysql_real_escape_string(strip_tags($_POST['submit']));
$now = time();
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

mysql_query("INSERT INTO Replies (tid, Body, PosterID) VALUES ('$ID','$Reply','$myU->ID')");
mysql_query("UPDATE Threads SET Bump='$now' WHERE ID='$ID'");
mysql_query("UPDATE Users SET ForumFlood='$flood' WHERE ID='$myU->ID'");
header("Location: ViewThread.php?ID=$ID"); exit();
}}
?>