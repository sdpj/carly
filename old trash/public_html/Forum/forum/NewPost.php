<?
	include($_SERVER['DOCUMENT_ROOT']."/Header.php");
	if ($User) {
		$ID = mysql_real_escape_string(strip_tags(stripslashes($_GET['ID'])));
		$getTopic = mysql_query("SELECT * FROM Topics WHERE ID='$ID'");
		$gT = mysql_fetch_object($getTopic);
		$lol = date("F j, Y, g:i a");
		if (!$ID){
			header("Location: http://avatar-gamer.ga/Error/?code=404");
			die();
		}elseif ($gT == "0") {
			header("Location: http://avatar-gamer.ga/Error/?code=404");
			die();
		}else{
			echo"
			<h1>Creating Thread</h1>
			<form action='' method='POST'>
				<table>
					<tr>
						<td>
							<br><br><font size='5' color='#343434'><b>Title of Thread</b></font><br>
								
								<input type='text' name='Title' style='width:500px;' />
							</td>
						</tr>
					
						<tr>
							<td>
								<font size='5' color='#343434'><b>Body of Thread</b></font><br>
								
								<textarea name='Body' rows='5' cols='40' style='width:500px;'></textarea>
							</td>
						</tr>
						<tr>
							
						</tr>
					
				
				";
				if ($myU->PowerForumModerator == "true") {
				
					echo "
					<div align=''><font size='5' color='#343434'><b>Type of Thread</font></b><br>
					<select name='Type'>
					<option value='regular'>Non-Sticky Post</option>
					<option value='sticky'>Sticky Post</option>
					</select>
					";
				
				}
	echo "&nbsp;&nbsp;<select name='usertype'> <font size='5' color='#343434'><b>Type of Thread</font></b><option value='0' >Post allows replies</option>
	<option value='1'>Post denies replies</option></select></div><td>
								<input type='submit' name='Submit' value='Create Thread' class='btn' />
							</td></table>";
				echo "</form>";

				
				$Title = mysql_real_escape_string((strip_tags($_POST['Title'])));
				$Body = filter(mysql_real_escape_string(strip_tags($_POST['Body'])));
				if($myU->PowerAdmin == "true" or $myU->PowerImageModerator == "true" or $myU->PowerForumModerator == "true" or $myU->PowerMegaModerator == "true") {
					$Title = mysql_real_escape_string(strip_tags(($_POST['Title'])));
				$Body = mysql_real_escape_string(strip_tags(($_POST['Body'])));
				}
				$Type = mysql_real_escape_string(strip_tags(stripslashes($_POST['Type'])));
				$Submit = mysql_real_escape_string(strip_tags(stripslashes($_POST['Submit'])));
							$Type1 = mysql_real_escape_string(strip_tags(stripslashes($_POST['usertype'])));
							



		function filter1($string){
			$input = array("[b]","[/b]");
			$newinput = array("<b>","</b>");
			$string1 = str_replace($input, $newinput, $string);
		}






				
					if ($Submit) {
					
						if (!$Title||!$Body) {
						
							echo"<div id='error'>ERROR: ".(!$Title && !$Body ? "Title and Body" : !$Title ? "Title" : !$Body ? "Body" : "[Unknown]")." absent.</div>";

						
						}
							elseif ($now < $myU->VerifyTime) {
							echo "<div id='error'>Accounts must be older than 15 minutes to post.</div>";
							die();
							}
						elseif (strlen($Title) < 4) {
						
							echo"<div id='error'>ERROR: Title must be at-least 5 characters.</div>";
						
						}
						elseif (strlen($Title) > 299) {
						
							echo"<div id='error'>ERROR: Title too long.</div>";
						
						}
						elseif (strlen($Body) < 4) {
						
							echo"<div id='error'>ERROR: Body must be at-least 5 characters.</div>";
						
						}
						elseif (strlen($Body) > 100000000) {
						
							echo"<div id='error'>ERROR: Body too long.</div>";
						
						}
						else {
						
							$Title = filter($Title);
							$Body = filter($Body);
							$Body =  ($Body);
						
							if ($myU->PowerAdmin == "false"||$myU->PowerForumModerator == "false"||$myU->PowerAdmin == "false") {
							
								
								
									$Type = "regular";
								
								
							
							}
							$now = time();
		
							if ($now < $myU->forumflood) {
							echo "You are posting too fast, please wait.";
							}
							else {
								$flood = $now + 30;
							mysql_query("UPDATE Users SET forumflood='$flood' WHERE ID='$myU->ID'");
							mysql_query("INSERT INTO Threads (Title, Body, PosterID, Type, tid, bump, Locked, TimePosted, Views) VALUES ('$Title','$Body','$myU->ID','$Type','$ID','$now','$Type1','$lol','0')");
							$getNew = mysql_query("SELECT * FROM Threads WHERE Title='$Title' AND Body='$Body' AND PosterID='$myU->ID' AND tid='$ID' AND bump='$now'");
							$gN = mysql_fetch_object($getNew);
							header("Location: ShowPost.aspx?ID=$gN->ID");
							die();
							}
					
							if($myU->PowerAdmin == "true" or $myU->PowerImageModerator == "true" or $myU->PowerForumModerator == "true" or $myU->PowerMegaModerator == "true") {
							mysql_query("UPDATE Users SET lastflood='$flood' WHERE ID='$myU->ID'");
							mysql_query("INSERT INTO Threads (Title, Body, PosterID, Type, tid, bump, Locked, TimePosted, Views, staffPost) VALUES ('$Title','$Body','$myU->ID','$Type','$ID','$now','$Type1','$lol','0')");
							$getNew = mysql_query("SELECT * FROM Threads WHERE Title='$Title' AND Body='$Body' AND PosterID='$myU->ID' AND tid='$ID' AND bump='$now' AND staffPost='1'");
							$gN = mysql_fetch_object($getNew);
							header("Location: ShowPost.aspx?ID=$gT->$ID");
							die();
							}
						}
					
					}
			
			}
			}else{
				header("Location: http://avatar-gamer.ga/");
				die();
			}


echo"</div></div></div></div></div>";
include($_SERVER['DOCUMENT_ROOT']."/Footer.php");