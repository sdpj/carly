<?php

include "../Header.php";
if (!$User) {
header("Location: /Error/Login.php"); exit(); }

$currenttime = date("F j, Y, g:i a");
	$ID = mysql_real_escape_string($_GET['ID']);
	
	$RecentForums = mysql_query("SELECT * FROM Threads WHERE ID='$ID'");
	
	
	
	
	while ($Recents = mysql_fetch_object($RecentForums)) {
	$getPoster = mysql_query("SELECT * FROM Users WHERE ID='".$Recents->PosterID."'");
	$gP = mysql_fetch_object($getPoster);
	}
			
			
$cancel = mysql_real_escape_string(strip_tags($_POST['cancel']));
$preview = mysql_real_escape_string(strip_tags(filter($_POST['preview'])));
$getThread = mysql_query("SELECT * FROM Threads WHERE ID='$ID'");
$gT = mysql_fetch_object($getThread);
$TopicName = mysql_query("SELECT * FROM Topics WHERE ID='$gT->tid'");
$gTN = mysql_fetch_object($TopicName);

if ($cancel) {
header("Location: /Forum/index.aspx");
}

					
if ($gT->Locked == 1 && $myU->PowerForumModerator != "true") {
header("Location: ../Forum/ShowPost.aspx?ID=$ID"); exit(); }

	echo "
<style>
#ForumBar {
background-color: #0058B1;
padding:5px;


color:white;
font-weight:bold;
border-top-left-radius:0px;
border-top-right-radius:0px;
font-size:20px;
padding-top:5px;
padding-bottom:5px;
padding-left:5px;
}

</style>
";


echo"
<br>
<br><br>
<b><a href='/Forum/' style='font-weight:bold;'>Avatar-Universe Forum</a></b>
<h1>Reply to Post</h1>

<form action='' method='post'>
<div id='ForumBar'>
<div align='center'>
Original Post
</div>
</div>
<font size='3' color='#343434'><a href='/Forum/ShowPost.aspx?ID=$gT->ID' style='font-weight:bold;padding-top:4px;font-size:16px;'>Re: $gT->Title</a></font><br>
Posted by <a href='/user.aspx?ID=$gP->ID'>$gP->Username</a> on $gT->TimePosted<br><br>
<font size='3' color='#343434'>$gT->Body</font><br><br>
<div id='ForumBar'>
<div align='center'>
New Post
</div>
</div><br><b>Subject:</b> Re: $gT->Title<br /><br />
<br />
<b>Message:</b><br><textarea cols='50' rows='15' name='Body'></textarea>


<br />
<input type='submit' name='cancel' value='Cancel' class='btn-control-prof'>
 <input type='submit' name='submit' value='Post' class='btn-control-prof'>

</form>

";
if ($User) {

$Reply = mysql_real_escape_string(strip_tags(filter($_POST['Body'])));
if($myU->PowerAdmin == "true" or $myU->PowerImageModerator == "true" or $myU->PowerForumModerator == "true" or $myU->PowerMegaModerator == "true") {
$Reply = mysql_real_escape_string(strip_tags(filter($_POST['Body'])));
$now = time();
}

$Submit = mysql_real_escape_string(strip_tags($_POST['submit']));
if ($Submit) {
if (!$Reply) {
echo"<div id='error'>ERROR: Please include a reply.</div>";
}
elseif  (strlen($Reply) <= 5) {
echo"<div id='error'>ERROR: Reply must be at-least 5 characters.</div>";
}
elseif ($now < $myU->VerifyTime) {
						echo "<div id='error'>Accounts must be older than 15 minutes to post.</div>";
			
						}

elseif ($now < $myU->forumflood) {
						echo "You are posting too fast, please wait.";
						}
						
 else {
	 $flood = $now + 30;
mysql_query("UPDATE Users SET lastflood='$flood' WHERE ID='$myU->ID'");
mysql_query("INSERT INTO Replies (tid, Body, PosterID, TimePosted) VALUES ('$ID','$Reply','$myU->ID','$currenttime')");
mysql_query("UPDATE Threads SET Bump='$now' WHERE ID='$ID'");
mysql_query("UPDATE Users SET ForumFlood='$flood' WHERE ID='$myU->ID'");
header("Location: ShowPost.php?ID=$ID"); exit();
}}}
echo"</div></div></div></div></div>";
include($_SERVER['DOCUMENT_ROOT']."/Footer.php");
?>