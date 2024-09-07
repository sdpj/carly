<?php
include($_SERVER['DOCUMENT_ROOT']."/Header.php");

	$ID = mysql_real_escape_string(strip_tags(stripslashes($_GET['ID'])));
	$getThread = mysql_query("SELECT * FROM Threads WHERE ID='$ID'");
	$gT = mysql_fetch_object($getThread);
	$Posts = $Posts+$Replies;
	$getTopic = mysql_query("SELECT * FROM Topics WHERE ID='$gT->tid'");
$views = $gT->Views + 1;
$Setting = array(
	"PerPage" => 1000
);
$PerPage = 15;
$Page = mysql_real_escape_string(strip_tags(stripslashes($_GET['Page'])));
if ($Page < 1) { $Page=1; }
if (!is_numeric($Page)) { $Page=1; }
$Minimum = ($Page - 1) * $Setting["PerPage"];
	$gTT = mysql_fetch_object($getTopic);
	
	$ThreadExist = mysql_num_rows($getThread);
	
	
		if ($ThreadExist == "0") {
		
			header("Location: /index.aspx");
			exit;
		
		}
		$getTopic = mysql_fetch_object(mysql_query("SELECT * FROM Topics WHERE ID='$gT->tid'"));
		
		
						$getPoster = mysql_query("SELECT * FROM Users WHERE ID='$gT->PosterID'");
						$gP = mysql_fetch_object($getPoster);
						$getMainGroup = mysql_query("SELECT * FROM Groups WHERE ID='$gP->MainGroupID'");
						$gMG = mysql_fetch_object($getMainGroup);
if ($myU->ID != $gP->ID) {
		
			mysql_query("UPDATE Threads SET Views=Views + 1 WHERE ID='".$ID."'"); }
		echo "
		
			<tr>
";

if ($User) { echo"<br>

<br><br />
<div id='loginh2' style='font-weight:normal;'><font size='6' color='#343434'>$gT->Title</font></div><br>
"; }
else{ echo"
<br><font color='#343434' size='3'><b>
 </font></b><br><br>"; }
if (!$User) { echo"
<div id='loginh2' style='font-weight:bold;'><font size='6' color='#343434'>$gT->Title</font></div>"; }
if ($gT->Locked == 1) {  echo "<br><div id='ErrorMaintenance'><img src='../Images/exclamation.png' title='Important Message'><font size='3'> This thread is locked and does not allow replies to be posted.</font></div><br><div id='forumbar'><a href='../Forum/index.aspx' style='text-decoration: none;'><font color='white' size='2'>Forum index</a> > <a href='../Forum/ShowForum.aspx?ID=$getTopic->ID' style='text-decoration: none;'><font color='white' size='2'>$getTopic->TopicName</a> > <a href='../Forum/ShowPost.aspx?ID=$gT->ID' style='text-decoration: none;'><font color='white' size='2'>$gT->Title</a></font></font></div><div id='abforum'><br>"; }
else {
echo"<div id='forumbar'><a href='../Forum/index.aspx' style='text-decoration: none;'><font color='white' size='2'>Forum index</a> > <a href='../Forum/ShowForum.aspx?ID=$getTopic->ID' style='text-decoration: none;'><font color='white' size='2'>$getTopic->TopicName</a> > <a href='../Forum/ShowPost.aspx?ID=$gT->ID' style='text-decoration: none;'><font color='white' size='2'>$gT->Title</a></font></div><div id='abforum'><br>"; 
}
		echo"<table>
			<tr>
				<td width='125' valign='top' style='border-right:1px solid #ccc;border-top:0px solid lightgrey;'><br>
						<center>";
if ($now < $gP->expireTime) {
					echo"";
					
					}
					else {
					echo"";
				
					} echo"<a href='/user.aspx?ID=$gP->ID'>";
	
	if ($gP->Premium > 0) { echo"<font color='red'>&nbsp;$gP->Username</font>"; } else { echo"<font size='2' color='#013DA4'>&nbsp;$gP->Username</font></a>"; }echo"<br>
<img src='/Avatar.aspx?ID=$gT->PosterID'></center></a>";
 
						

						
					

						$Posts = mysql_num_rows($Posts = mysql_query("SELECT * FROM Threads WHERE PosterID='".$gP->ID."'")); $Replies = mysql_num_rows($Replies = mysql_query("SELECT * FROM Replies WHERE PosterID='".$gP->ID."'")); $Posts = $Posts+$Replies;
if ($gP->PowerAdmin == "true"||$gP->PowerMegaModerator == "true"||$gP->PowerForumModerator == "true") { echo "<img src='../Imagess/users_moderator.gif' style='padding:3px;' title='Forum Moderator'><br>"; }
$getTopPosters = mysql_query("SELECT * FROM Users ORDER BY ForumPost DESC LIMIT 0,1");
while ($gTT = mysql_fetch_object($getTopPosters)) {
	if ($gP->Username == $gTT->Username) {
		echo "<img src='../Images/top.gif'><br>";
	}
}
$getTopPosters = mysql_query("SELECT * FROM Users ORDER BY ForumPost DESC LIMIT 0,10");
while ($gTT = mysql_fetch_object($getTopPosters)) {
	if ($gP->Username == $gTT->Username) {
		echo "<img src='../Images/top10.gif'><br>";
	}
}

$string = $gMG->Name;
if(strlen($string) > 15)  $string = substr($string, 0, 15).'...'; 

echo "
					
						<font color='#343434'><font size='2'><b>Total Posts:</b></font></font> "; $Posts = mysql_num_rows($Posts = mysql_query("SELECT * FROM Threads WHERE PosterID='".$gP->ID."'")); $Replies = mysql_num_rows($Replies = mysql_query("SELECT * FROM Replies WHERE PosterID='".$gP->ID."'")); $Posts = $Posts+$Replies; echo "<font color= '#343434'><font size='2'>$Posts</font></font>";
 if ($gP->JoinDate != "") { echo" <br> <font color= '#343434'><font size='2'><b>Joined:</b> $gP->JoinDate </font></font>"; } elseif ($gP->JoinDate == "") { echo " <br /><font color= '#343434'><font size='2'><b>Joined:</b> June 3, 2013</font></font> "; }
 if ($gP->Gender != "") { echo" <br> <font color= '#343434'><font size='2'><b>Gender:</b> $gP->Gender  </font></font>"; } elseif ($gP->JoinDate == "") { echo " <br /><font color= '#343434'><font size='2'><b>Gender:</b> N/A</font></font> "; } if ($gP->MainGroupID) {
 echo"<br /><font size='2' color='#343434'></font><a href='../Groups/Group.aspx?ID=$gMG->ID'><font size='2'>$string</font></a>";
 }



echo "</div>

				</td>

				<td valign='top' width='750' style=''>
					<div id='ProfileText' style='padding:10px;background:darkwhite;border:0px solid lightgrey;'>
						<font size='3'></b>$gT->TimePosted</font></font></b><br />
					";
echo"
					</div>
					<div style='min-height:250px;overflow-y:auto;height:px; padding-left:10px;border:0px solid lightgrey;border-top:0;'>
					";
					$Body = $gT->Body;
					$Pattern = "/(http:\/\/)?(www\.)?mibzi.net(\/)?([a-z\.\?\/\=0-9]+)?/i";
if ($gP->PowerAdmin == "true"||$gP->PowerForumModerator == "true"||$gP->PowerMegaModerator == "true") {
echo "
						<br> <font color='#343434' size='2'>".nl2br($Body)."</font><br><br><font size='1' color='#343434'><i>".htmlentities($gP->Signature)."</i></font>
						";
}
else {
echo"<br><font color='#343434' size='2'>".nl2br($Body)."<br><br><font size='1' color='#343434'><i>".htmlentities($gP->Signature)."</i></font></font>";
}
if ($myU->PowerForumModerator == "true" OR $myU->PowerMegaModerator == "true") {
if ($gT->OriginalTitle OR $gT->OriginalBody) {
echo"<div style='padding-top:15px;'></div><div style='width:315px;padding:5px;overflow-y:auto;background:#FEF1B5;border-right:1px solid #e2c822;border-top:1px solid #e2c822;border-bottom:1px solid #e2c822;border-left:1px solid #e2c822;'><font color='#343434'><b>Original Content:</b><br><br><b>Title:</b> <i>$gT->OriginalTitle</i><br><br><b>Body:</b> <i>$gT->OriginalBody</i><br><br>
<a href='ShowPost.aspx?ID=$gT->ID?&restorethread=true'>Restore Thread</a></div></font>";
}
$restorethread = $_GET['restorethread'];
        
       if ($restorethread == "true") {
mysql_query("UPDATE Threads SET Title='$gT->OriginalTitle' WHERE ID='$gT->ID'");
mysql_query("UPDATE Threads SET Body='$gT->OriginalBody' WHERE ID='$gT->ID'");
mysql_query("UPDATE Threads SET OriginalTitle='' WHERE ID='$gT->ID'");
mysql_query("UPDATE Threads SET OriginalBody='' WHERE ID='$gT->ID'");
header("Location: ShowPost.aspx?ID=$gT->ID"); exit();
}
}
if ($User) {
if ($gT->Locked == "0") {
echo"<br><br><br><a href='../Forum/Reply.aspx?ID=$ID'><img src='../Forum/Images/reply.png'></a>";
} }

echo"</font><br /><br /><b> </b>";
						if ($myU->PowerAdmin == "true"||$myU->PowerForumModerator == "true"||$myU->PowerMegaModerator == "true") {
$action = $_GET['action'];
						if ($User) {

				
}		
$Redirect = rawurlencode($_SERVER['aspx_SELF']);					
 }
						echo "
					</div>
				</td>
			</tr>
		</table>
		";

						if ($myU->PowerAdmin == "true"||$myU->PowerForumModerator == "true"||$myU->PowerMegaModerator == "true") {
						echo"<center>";
							echo "<br><center><font size='1'>";
if (!$gT->OriginalTitle && !$gT->OriginalBody) { echo"
<a href='?ID=$ID&Moderation=Scrub&Thread=Main&ThreadID=".$gT->ID."' class='btnforum'><font color='white' size='3' style='font-weight:normal;' id='btn_delete'>Scrub Thread</font></a>&nbsp; &nbsp;&nbsp;"; } echo"

<a href='movethread.aspx?ID=".$gT->ID."' class='btnforum'><font color='white' size='3' style='font-weight:normal;' id='btn_delete'>Move Thread</font></a>&nbsp; &nbsp;&nbsp;

<a href='?ID=$ID&Moderation=Delete&Thread=Main&ThreadID=".$gT->ID."' class='btnforum'><font color='white' size='3' style='font-weight:normal;' id='btn_delete'>Remove Thread</font></a>&nbsp; &nbsp;&nbsp; "; 

if ($gT->Locked == 0) { echo" 

<a href='?ID=$ID&Moderation=Lock' class='btnforum'><font color='white' size='3' style='font-weight:normal;' id='btn_delete'>Lock Thread</font></a>&nbsp; &nbsp;&nbsp;
<a href='?ID=$ID&Moderation=Edit' class='btnforum'><font color='white' size='3' style='font-weight:normal;' id='btn_delete'>Edit Thread</font></a>&nbsp; &nbsp;&nbsp; "; echo"</center></center>";}
if ($gT->Locked == 1) { echo " 
<a href='?ID=$ID&Moderation=unlock' class='btnforum'><font color='white' size='3' style='font-weight:normal;' id='btn_delete'>Unlock Thread</font></a>&nbsp; &nbsp;&nbsp"; 
echo"</center>";
}
}echo"<div align='left'>";

		//main moderation
		
			$getReplies = mysql_query("SELECT * FROM Replies WHERE tid='".$ID."' ORDER BY ID ASC LIMIT {$Minimum},  ". $Setting["PerPage"]);
			
				while ($gR = mysql_fetch_object($getReplies)) {
						$getPoster = mysql_query("SELECT * FROM Users WHERE ID='$gR->PosterID'");
						$gP = mysql_fetch_object($getPoster);
						$getMainGroup = mysql_query("SELECT * FROM Groups WHERE ID='$gP->MainGroupID'");
						$gMG = mysql_fetch_object($getMainGroup);

					echo "
			<a name='$gR->ID'></a>
		<table style='margin-top:10px;'>
			<tr style='background:darkwhite;'>
				<td width='125' valign='top' style='border-right:1px solid lightgrey; border-top:1px solid lightgrey'>
						<center>";
if ($now < $gP->expireTime) {
					echo"";
					
					}
					else {
					echo"";
				
					}
						
							if ($gP->Premium > 0) { echo"<a href='../user.aspx?ID=$gP->ID'><font color='red'>&nbsp;$gP->Username</font></a>"; } else { echo"<a href='../user.aspx?ID=$gP->ID'><font color='#343434'><font size='2'>&nbsp;$gP->Username</font></font></a></a>"; }echo"<br>

	<img src='/Avatar.aspx?ID=$gP->ID'></center>";
							
						
					
						
	$height = 150;
								$width = 100;
						
						
						
						
					
$Posts = mysql_num_rows($Posts = mysql_query("SELECT * FROM Threads WHERE PosterID='".$gP->ID."'")); $Replies = mysql_num_rows($Replies = mysql_query("SELECT * FROM Replies WHERE PosterID='".$gP->ID."'")); $Posts = $Posts+$Replies;
if ($gP->PowerAdmin == "true"||$gP->PowerMegaModerator == "true"||$gP->PowerForumModerator == "true") { echo "<img src='../Imagess/users_moderator.gif' style='padding:3px;' title='Forum Moderator'><br>"; }
$getTopPosters = mysql_query("SELECT * FROM Users ORDER BY ForumPost DESC LIMIT 0,1");
while ($gTT = mysql_fetch_object($getTopPosters)) {
	if ($gP->Username == $gTT->Username) {
		echo "<img src='../Images/top.gif'><br>";
	}
}
$getTopPosters = mysql_query("SELECT * FROM Users ORDER BY ForumPost DESC LIMIT 0,10");
while ($gTT = mysql_fetch_object($getTopPosters)) {
	if ($gP->Username == $gTT->Username) {
		echo "<img src='../Images/top10.gif'><br>";
	}
}


$string = $gMG->Name;
if(strlen($string) > 15)  $string = substr($string, 0, 15).'...'; 



						echo "<div align='left'>
						<font color= '#343434'><font size='2'><b>Total Posts:</b></font> </font>"; $Posts = mysql_num_rows($Posts = mysql_query("SELECT * FROM Threads WHERE PosterID='".$gP->ID."'")); $Replies = mysql_num_rows($Replies = mysql_query("SELECT * FROM Replies WHERE PosterID='".$gP->ID."'"));
$Posts = $Posts+$Replies; echo "<font color= '#343434'><font size='2'>$Posts </font></font>";
if ($gP->JoinDate != "") { echo"  <br /><font color= '#343434'><font size='2'><b>Joined:</b> $gP->JoinDate</font></font> "; } else { echo " <br /><font color= '#343434'><font size='2'><b>Joined:</b> June 3, 2013</font></font> "; }
if ($gP->Gender != "") { echo" <br> <font color= '#343434'><font size='2'><b>Gender:</b> $gP->Gender </font></font>"; } elseif ($gP->JoinDate == "") { echo " <br /><font color= '#343434'><font size='2'><b>Gender:</b> N/A</font></font> "; } if ($gP->MainGroupID) {
echo"<br /><font size='2' color='#343434'></font><a href='../Groups/Group.aspx?ID=$gP->MainGroupID'><font size='2'>$string</a></font>"; }



echo" </div></div> 
				</td>
				<td valign='top' width='750' style='darkwhite'><hr color='lightgrey' size='1'>
					<div id='ProfileText' style='padding:10px;border:0px solid lightgrey;'>";
if ($gR->TimePosted) { echo"
					<font color= '#343434' size='3'>$gR->TimePosted</font> "; }
else { echo"<font color='#343434' size='1'>October 29, 2013, 1:00 pm</font> <a href='../ReportThread.aspx?ID=$ID&RedirectUrl=$Redirect?ID=$ID'><font size='2'><font color='darkred'><img src='../Images/report.png' height='15' width='15' title='Report Abuse'></a>"; } echo"<br />
					</div>
					<div style='padding-left:10px;min-height:200px;overflow-y:auto;height:px;border:0px solid lightgrey;border-top:0;'>
						";
					$Body = $gR->Body;
					$Pattern = "/(http:\/\/)?(www\.)?mibzi.net(\/)?([a-z\.\?\/\=0-9]+)?/i";
					$Body = preg_replace($Pattern, "<a href='http://www.mibzi.net/\\4' target='_blank'>\\0</a>", $Body);
					
if ($gP->PowerAdmin == "true"||$gP->PowerForumModerator == "true"||$gP->PowerMegaModerator == "true") {
echo "
						<br><font color='#343434'>".nl2br($Body)."</font><br><br><font size='1' color='#343434'><i>".htmlentities($gP->Signature)."</i></font>
						";
}
else {
echo"<br><font color='#343434'>".nl2br($Body)."</font><br><br><font size='1' color='#343434'><i>".htmlentities($gP->Signature)."</i></font>";
}
if ($User) {
if ($gT->Locked == "0") {
echo"<br><br><br><a href='../Forum/Reply.aspx?ID=$ID'><img src='../Forum/Images/reply.png'></a>";
}
}
echo"<br><br>";
echo "</font><br /><br /></div>";

if ($myU->PowerAdmin == "true"||$myU->PowerForumModerator == "true"||$myU->PowerMegaModerator == "true") {
						
							echo "<center><br>
<a href='?ID=$ID&Moderation=Scrub&Thread=Reply&ThreadID=".$gR->ID."' class='btnforum'><font color='white' size='3' style='font-weight:normal;' id='btn_delete'>Scrub Reply</font></a>&nbsp; &nbsp;&nbsp; 
<a href='?ID=$ID&Moderation=Delete&Thread=Reply&ThreadID=".$gR->ID."' class='btnforum'><font color='white' size='3' style='font-weight:normal;' id='btn_delete'>Remove Reply</font></a>&nbsp; &nbsp;&nbsp; 
</center> ";

}


echo"
					
				</td>
			</tr>

		</table>

					";

				
				}

				$Moderation = mysql_real_escape_string(strip_tags(stripslashes($_GET['Moderation'])));
				$Thread = mysql_real_escape_string(strip_tags(stripslashes($_GET['Thread'])));
				$ThreadID = mysql_real_escape_string(strip_tags(stripslashes($_GET['ThreadID'])));
				
				if ($Moderation == "Scrub" && $Thread == "Reply") {
				
					if ($myU->PowerAdmin == "true"||$myU->PowerForumModerator == "true"||$myU->PowerMegaModerator == "true") {
					echo "
					


					<div style='background-image:url(/Imagess/menuhover.png);width:100%;height:100%;top:0;left:0;position:fixed;'><center>
						<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
						<div id='Container' style='background-color:white;width:600px;border:5px solid darkred;border-radius:0px;'>
							<div id='loginh2' style='letter-spacing:0px;'><font color='#343434' size='5'>Confirm Moderation Action</font></div>
							<br />
							
								<font size='3'><font color='darkred'>Are you sure you would like to scrub this reply, $myU->Username? &nbsp;<img src='../Images/question.png' title='This action will change this reply to [ Content Removed ]'></font></font>
								<br /><br />
								
							
						
						<form action='' method='POST'>
							<center><input type='submit' name='True' value='Confirm' class='btnforum'> <input type='submit' name='True1' value='Confirm and Moderate' class='btnforum'> <input type='submit' name='Close' value='Cancel' class='btnforum'></center>
							
							
							</form>
						</div>
					</div>
					";
					$Yes = mysql_real_escape_string(strip_tags(stripslashes($_POST['True'])));
					$Close = mysql_real_escape_string(strip_tags(stripslashes($_POST['Close'])));
					$Yes1 = mysql_real_escape_string(strip_tags(stripslashes($_POST['True1'])));
					if ($Yes) {
					$getThreadAgain = mysql_query("SELECT * FROM Replies WHERE ID='$ThreadID'");
					$gTA = mysql_fetch_object($getThreadAgain);
					
mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','scrubbed a reply with original body &quot;$gTA->Body&quot;','".$_SERVER['aspx_SELF']."')");
mysql_query("UPDATE Replies SET OriginalBody='$gTA->Body' WHERE ID='".$ThreadID."'");
					mysql_query("UPDATE Replies SET Body='[ Content Removed ]' WHERE ID='".$ThreadID."'");
					header("Location: ShowPost.aspx?ID=$ID");
					}
					if ($Yes1) {
							$getThreadAgain = mysql_query("SELECT * FROM Replies WHERE ID='$ThreadID'");
					$gTA = mysql_fetch_object($getThreadAgain);
mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','scrubbed a reply with original body &quot;$gTA->Body&quot;','".$_SERVER['aspx_SELF']."')");
mysql_query("UPDATE Replies SET OriginalBody='$gTA->Body' WHERE ID='".$ThreadID."'");
					mysql_query("UPDATE Replies SET Body='[ Content Removed ]' WHERE ID='".$ThreadID."'");
					mysql_query("UPDATE Replies SET Title='[ Content Removed ]' WHERE ID='".$ThreadID."'");
					header("Location: ../Administration/ModerateUser.aspx?ID=$gTA->PosterID&badcontent=".$gTA->Body.""); exit();
					}
					if ($Close) {
					header("Location: ShowPost.aspx?ID=$ID");
					}
					}
				
				}
				if ($Moderation == "Delete" && $Thread == "Reply") {
				
					if ($myU->PowerAdmin == "true" OR $myU->PowerForumModerator == "true" OR $myU->PowerMegaModerator == "true") {
					echo "
						<div style='background-image:url(/Imagess/menuhover.png);width:100%;height:100%;top:0;left:0;position:fixed;'><center>
						<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
						<div id='Container' style='background-color:white;width:600px;border:5px solid darkred;border-radius:0px;'>
							<div id='loginh2' style='letter-spacing:0px;'><font color='#343434' size='5'>Confirm Moderation Action</font></div>
							<br />
							
								<font size='3'><font color='darkred'>Are you sure you would like to delete this reply, $myU->Username? &nbsp;<img src='../Images/question.png' title='This action will remove this reply from the thread'></font></font>
								<br /><br />
								
							
						
							<form action='' method='POST'>
							<center><input type='submit' name='True' value='Confirm' class='btnforum'> <input type='submit' name='True1' value='Confirm and Moderate' class='btnforum'> <input type='submit' name='Close' value='Cancel' class='btnforum'></center>
							
							
							</form>
						</div>
					</div>
					";
					$Yes = mysql_real_escape_string(strip_tags(stripslashes($_POST['True'])));
					$Close = mysql_real_escape_string(strip_tags(stripslashes($_POST['Close'])));
					$Yes1 = mysql_real_escape_string(strip_tags(stripslashes($_POST['True1'])));
					if ($Yes) {
					mysql_query("DELETE FROM Replies WHERE ID='".$ThreadID."'");
					header("Location: ShowPost.aspx?ID=$ID");
					}
					if ($Yes1) {
					mysql_query("UPDATE Threads SET Body='[ Content Removed ]' WHERE ID='".$ThreadID."'");
					mysql_query("UPDATE Threads SET Title='[ Content Removed ]' WHERE ID='".$ThreadID."'");
					header("Location: ../Administration/ModerateUser.aspx?ID=$gP->PosterID&badcontent=$gT->Title, $gT->Body");
					}
					if ($Close) {
					header("Location: ShowPost.aspx?ID=$ID");
					}
					}
				
				}
				if ($Moderation == "Scrub" && $Thread == "Main") {
				
					if ($myU->PowerAdmin == "true"||$myU->PowerForumModerator == "true"||$myU->PowerMegaModerator == "true") { if (!$gT->OriginalTitle && !$gT->OriginalBody) {
					echo "
						<div style='background-image:url(/Imagess/menuhover.png);width:100%;height:100%;top:0;left:0;position:fixed;'><center>
						<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
						<div id='Container' style='background-color:white;width:600px;border:5px solid darkred;border-radius:0px;'>
							<div id='loginh2' style='letter-spacing:0px;'><font color='#343434' size='5'>Confirm Moderation Action</font></div>
							<br />
							
								<font size='3'><font color='darkred'>Are you sure you would like to scrub this thread, $myU->Username? &nbsp;<img src='../Images/question.png' title='This action will change this thread to [ Content Removed ]'></font></font>
								<br /><br />
								
							
						
<form action='' method='POST'>
							<center><input type='submit' name='True' value='Confirm' class='btnforum'> <input type='submit' name='True1' value='Confirm and Moderate' class='btnforum'> <input type='submit' name='Close' value='Cancel' class='btnforum'></center>
							
							
							</form>
						</div>
					</div>
					";
					$Yes = mysql_real_escape_string(strip_tags(stripslashes($_POST['True'])));
					$Close = mysql_real_escape_string(strip_tags(stripslashes($_POST['Close'])));
					$Yes1 = mysql_real_escape_string(strip_tags(stripslashes($_POST['True1'])));
					if ($Yes) {
mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','scrubbed thread ID $ThreadID with original title &quot;$gT->Title&quot; and original body &quot;$gT->Body&quot;','".$_SERVER['aspx_SELF']."')");
mysql_query("UPDATE Threads SET OriginalTitle='$gT->Title' WHERE ID='$ID'");
mysql_query("UPDATE Threads SET OriginalBody='$gT->Body' WHERE ID='$ID'");
					mysql_query("UPDATE Threads SET Body='[ Content Removed ]' WHERE ID='".$ThreadID."'");
					mysql_query("UPDATE Threads SET Title='[ Content Removed ]' WHERE ID='".$ThreadID."'");
					header("Location: ShowPost.aspx?ID=$ID"); 
					}
					if ($Yes1) {
mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','scrubbed thread ID $ThreadID with original title &quot;$gT->Title&quot; and original body &quot;$gT->Body&quot;','".$_SERVER['aspx_SELF']."')");
mysql_query("UPDATE Threads SET OriginalTitle='$gT->Title' WHERE ID='$ID'");
mysql_query("UPDATE Threads SET OriginalBody='$gT->Body' WHERE ID='$ID'");
					mysql_query("UPDATE Threads SET Body='[ Content Removed ]' WHERE ID='".$ThreadID."'");
					mysql_query("UPDATE Threads SET Title='[ Content Removed ]' WHERE ID='".$ThreadID."'");
					header("Location: ../Administration/ModerateUser.aspx?ID=$gT->PosterID&badcontent=Title: $gT->Title Body: $gT->Body"); exit();
header("Location: ../Administration/ModerateUser.aspx?ID=$gT->PosterID&badcontent=Title: $gT->Title Body: $gT->Body"); exit();
					}
					if ($Close) {
					header("Location: ShowPost.aspx?ID=$ID");
					}
					}
				else { header("Location: /Error/404.aspx"); exit(); }
				}
} 
				if ($Moderation == "Delete" && $Thread == "Main") {
				
					if ($myU->PowerAdmin == "true"||$myU->PowerForumModerator == "true"||$myU->PowerMegaModerator == "true") {
					echo "
						<div style='background-image:url(/Imagess/menuhover.png);width:100%;height:100%;top:0;left:0;position:fixed;'><center>
						<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
						<div id='Container' style='background-color:white;width:600px;border:5px solid darkred;border-radius:0px;'>
							<div id='loginh2' style='letter-spacing:0px;'><font color='#343434' size='5'>Confirm Moderation Action</font></div>
							<br />
							
								<font size='3'><font color='darkred'>Are you sure you would like to delete this thread, $myU->Username? &nbsp;<img src='../Images/question.png' title='This action will remove this thread from the forum'></font></font>
								<br /><br />
								
							
						
							<form action='' method='POST'>
							<center><input type='submit' name='True' value='Confirm' class='btnforum'> <input type='submit' name='True1' value='Confirm and Moderate' class='btnforum'> <input type='submit' name='Close' value='Cancel' class='btnforum'></center>
							
							
							</form>
						</div>
					</div>
					";
					$Yes = mysql_real_escape_string(strip_tags(stripslashes($_POST['True'])));
					$Yes1 = mysql_real_escape_string(strip_tags(stripslashes($_POST['True1'])));
					$Close = mysql_real_escape_string(strip_tags(stripslashes($_POST['Close'])));
					if ($Yes) {
mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','removed thread ID $ThreadID with original title &quot;$gT->Title&quot; and original body &quot;$gT->Body&quot;','".$_SERVER['aspx_SELF']."')");
					mysql_query("DELETE FROM Threads WHERE ID='".$ThreadID."'");
					mysql_query("DELETE FROM Replies WHERE ID='".$ThreadID."'");
					header("Location: ShowForum.aspx?ID=$gT->tid"); exit();
					}
					if ($Yes1) {
mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','removed thread ID $ThreadID with original title &quot;$gT->Title&quot; and original body &quot;$gT->Body&quot;','".$_SERVER['aspx_SELF']."')");
					mysql_query("UPDATE Threads SET Body='[ Content Removed ]' WHERE ID='".$ThreadID."'");
					mysql_query("UPDATE Threads SET Title='[ Content Removed ]' WHERE ID='".$ThreadID."'");
					header("Location: ../Administration/ModerateUser.aspxID=$gP->PosterID&badcontent=Title: $gT->Title Body: $gT->Body");
					}
					if ($Close) {
					header("Location: ShowPost.aspx?ID=$ID");
					}
					}
				
				}
		
		
		echo"</div><br><br><div id='forumbar'><a href='../Forum/index.aspx' style='text-decoration: none;'><font color='white' size='2'>Forum index</a> > <a href='../Forum/ShowForum.aspx?ID=$getTopic->ID' style='text-decoration: none;'><font color='white' size='2'>$getTopic->TopicName</a> > <a href='../Forum/ShowPost.aspx?ID=$gT->ID' style='text-decoration: none;'><font color='white' size='2'>$gT->Title</a></font></div><br>";
 
		if ($gT->Locked == 1) {  echo "<div id='ErrorMaintenance'><img src='../Images/exclamation.png' title='Important Message'><font size='3' color='#343434'> This thread is locked and does not allow replies to be posted.</font></div><br>"; }




if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"||$myU->PowerForumModerator == "true") {
if ($Moderation == "Lock") { 
mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','locked thread ID $gT->ID','".$_SERVER['aspx_SELF']."')");
mysql_query("UPDATE Threads SET Locked='1' WHERE ID='$ID'");
header("Location: ShowPost.aspx?ID=$ID"); exit(); }
if ($Moderation == "Edit"){
	ob_end_clean();
	header('location: ModEdit.aspx?ID=' . $ID);
}
if ($Moderation == "unlock") { mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','unlocked thread ID $gT->ID','".$_SERVER['aspx_SELF']."')");
mysql_query("UPDATE Threads SET Locked='0' WHERE ID='$ID'");
header("Location: ShowPost.aspx?ID=$ID"); exit(); } 		
		
}

$track = mysql_real_escape_string($_GET['track']); 

if ($track == "true") {
mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','tracked thread ID $gT->ID','".$_SERVER['aspx_SELF']."')");
mysql_query("INSERT INTO TrackedThreads (UserID, ThreadID) VALUES ('$myU->ID','$ID')");
header("Location: ?ID=$ID"); exit();
}
echo"</div></div></div></div></div></div></div>";
include($_SERVER['DOCUMENT_ROOT']."/Footer.php");