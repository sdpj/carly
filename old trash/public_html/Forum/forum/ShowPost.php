<?
	include($_SERVER['DOCUMENT_ROOT']."/Header.php");
	
	$ID = SecurePost($_GET['ID']);
	$GetThread = mysql_query("SELECT * FROM Threads WHERE ID='".$ID."'");
	$Thread = mysql_fetch_object($GetThread);
	$ThreadExist = mysql_num_rows($GetThread);
	$GetTopic = mysql_query("SELECT * FROM Topics WHERE ID='".$Thread->tid."'");
	$ThreadViews = $Thread->Views + 1;
	$GetPoster = mysql_query("SELECT * FROM Users WHERE ID='".$Thread->PosterID."'");
	$Poster = mysql_fetch_object($GetPoster);
	$TopicName = mysql_query("SELECT * FROM Topics WHERE ID='".$Thread->tid."'");
	$Topic = mysql_fetch_object($TopicName);
	$prev = $ID - 1;
	$next = $ID + 1;
	if($Topic->ID == "1"||$Topic->ID == "2"||$Topic->ID == "3"||$Topic->ID == "4"||$Topic->ID == "5"||$Topic->ID == "6"){
		$GroupName = "Avatar-Universe";
		$GroupID = 1;
	}
	elseif($Topic->ID == "7"||$Topic->ID == "8"){
		$GroupName = "Club Houses";
		$GroupID = 2;
	}
	$GroupName = $GroupName;
	$Setting = array(
	"PerPage" => 1000
	);
	$PerPage = 15;
	$Page = mysql_real_escape_string(strip_tags(stripslashes($_GET['Page'])));
	if ($Page < 1) { $Page=1; }
	if (!is_numeric($Page)) { $Page=1; }
	$Minimum = ($Page - 1) * $Setting["PerPage"];
	if ($ThreadExist == "0"){
		header("Location: http://avatar-gamer.ga/Error/?code=404");
		die();
	}
	if ($myU->ID != $Poster->ID) {
		mysql_query("UPDATE Threads SET Views=Views + 1 WHERE ID='".$ID."'"); 
	}
	
	
	$getTopPosters = mysql_query("SELECT * FROM Users ORDER BY ForumPost DESC LIMIT 0,1");
	$Body = $Thread->Body;
	$Pattern = "/(https:\/\/)?(www\.)?world2build.net(\/)?([a-z\.\?\/\=0-9]+)?/i";
?>	
	<div class='forum-thread-page' style='padding-top:10px;'>
		<a href='http://avatar-gamer.ga/forum/'>
			<b>World2Build Forum</b>
		</a>
		&raquo;
		 <a href='http://avatar-gamer.ga/forum/Group.aspx?ID=<?echo$GroupID;?>'>
			<b><?echo$GroupName;?></b>
		</a>
		&raquo;
		 <a href='http://avatar-gamer.ga/forum/ShowForum.aspx?ID=<?echo$Topic->ID;?>'>
			<b><?echo$Topic->TopicName;?></b>
		</a>
		<div style='float:right;'>
			<a href='http://avatar-gamer.ga/forum/' style='color:#363636;'>
				Home
			</a>
			|
			<a href='http://avatar-gamer.ga/forum/Search.aspx' style='color:#363636;'>
				Search
			</a>
			|
			<a href='http://avatar-gamer.ga/forum/MyThreads.aspx' style='color:#363636;'>
				My Forums
			</a>
		</div>
		<?if($Thread->Type == "global"){
			echo"
			<h1 style='font-weight:normal;'>
				<b>Global:</b> 
				".$Thread->Title."
			</h1>
			";
		}
		else{
			echo"
			<h1 style='font-weight:normal;'>
				".$Thread->Title."
			</h1>
			";
		}?>
		<div style='margin-bottom:7px;'>
			<?if($User){
				echo"
				<a href='?track=t' style='font-weight:bold;color:#363636;'>
					&laquo; Track Thread &raquo;
				</a>
				";
			}?>
			<div style='float:right;margin-bottom:7px;'>
				<a href='http://avatar-gamer.ga/forum/ShowPost.aspx?ID=<?echo $prev;?>'>
					<b>Previous Thread</b> 
				</a>
				<b>::</b> 
				<a href='http://avatar-gamer.ga/forum/ShowPost.aspx?ID=<?echo $next;?>'>
					<b>Next Thread</b>
				</a>
			</div>
		</div>
		<table cellpadding='0' name='Topic1Spacer' cellspacing='0' width='100%'>
			<tbody>
				<tr>
					<td class='forum-table-header' width='15%'>
						<center>
							Author
						</center>
					</td>
					<td class='forum-table-header-row' width='85%'>
						<center>
							Thread
						</center>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<table cellpadding='0' cellspacing='0' width='100%' style='border-bottom:1px solid #ccc;>'
			<tbody>
				<tr>
					<td class='forum-table-row-fluid' width='15%' style='vertical-align:top;border-top:0;border-right:0px solid #ccc;'>
					<table cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td class='avatar-stats' style='text-align:center;left:0;top:0;'>
									<a href='http://avatar-gamer.ga/user.aspx?ID=<?echo"".$Poster->ID."";?>'>
										<b><?echo"".$Poster->Username."";?></b>
										<br />
										<center>
											<img src='http://avatar-gamer.ga/Avatar.aspx?ID=<?echo"".$Poster->ID."";?>'>
										</center>
									
									</a>
								</td>
							</tr>
							<tr>
								<td class='forum-stats'>
									<? $getTopPosters = mysql_query("SELECT * FROM Users ORDER BY ForumPost DESC LIMIT 0,1");
									while ($gTT = mysql_fetch_object($getTopPosters)) {
										if ($Poster->Username == $gTT->Username) {
											echo"<img src='http://avatar-gamer.ga/Images/top.gif'><br />";
										}
									}
							
									$getTopPosters = mysql_query("SELECT * FROM Users ORDER BY ForumPost DESC LIMIT 0,10");
									while ($gTT = mysql_fetch_object($getTopPosters)) {
										if ($Poster->Username == $gTT->Username) {
											echo"<img src='http://avatar-gamer.ga/Images/top10.gif'>";
										}
									}
									?>
								</td>
							</tr>
							<?if($Poster->PowerForumModerator == "true"){
								echo"
								<tr>
									<td class='mod-image'>
										<img src='http://avatar-gamer.ga/Images/users_moderator.gif'>
									</td>
								</tr>
								";
							}?>
							<tr>
							</tr>
							<?if($Poster->PowerAdmin == "true"){
								echo"
								<tr>
									<td class='mod-image'>
										<img src='http://avatar-gamer.ga/Images/developer.png'>
									</td>
								</tr>
								";
							}?>
							<tr>
								<td class='forum-user-privs'>
									<?$Posts = mysql_num_rows($Posts = mysql_query("SELECT * FROM Threads WHERE PosterID='".$Poster->ID."'")); 
									$Replies = mysql_num_rows($Replies = mysql_query("SELECT * FROM Replies WHERE PosterID='".$Poster->ID."'")); 
									$Posts2 = $Posts+$Replies;?>
									<b>Total Posts:</b> <?echo"".$Posts2."";?>
									<br />
									<b>Join Date:</b> <?if($Poster->JoinDate){echo"".$Poster->JoinDate."";}else{echo"Apr 6, 2014";}?>
								</td>
							</tr>
						</table>
					</td>
					<td class='forum-table-row-fluid' style='vertical-align:top;' width='85%'>
						<div style='margin:0;padding:5px;'>
							<h3 style='font-weight:normal;margin:0;padding:0;'>
								<b style='font-size:13px;'><?echo $Thread->Title;?></b><div style='float:right;'><b style='font-size:13px;'><?echo $Thread->TimePosted;?></b></div>
								<?if($Thread->Type == "global"){
									echo"
									&nbsp;
									<font style='color:red;font-size:11px;'>
										This thread is labelled as an announcement, meaning it can be viewed in all sub-forums.
									</font>
									";
								}?>
								<div class='divider-bottom' style='width:100%;margin-top:5px;border:0;margin-bottom:5px;'></div>
								<?echo"".nl2br($Body)."";?>
								<br />
								<br />
									<b style='font-size:12px;'><?echo"".$Poster->Siggy."";?></b>
								<div style='padding-top:20px;'></div>
								<?if ($User) {
									if($Thread->Locked == "1" && $myU->PowerForumModerator == "true"){
										echo"
										<div style='float:left;bottom:0px;padding-left:5px;'>
											<a href='http://avatar-gamer.ga/forum/Reply.aspx?ID=".$Thread->ID."' class='btn-control-prof' style='font-size:12px;'>
												<div style='margin-top:4px;'>
													Mod Reply
												</div>
											</a>
										</div>
										";
									}
									elseif ($Thread->Locked == "0") {
										echo"
										<div style='float:left;bottom:0px;padding-left:5px;'>
											<a href='http://avatar-gamer.ga/forum/Reply.aspx?ID=".$Thread->ID."' class='btn-control-prof' style='font-size:12px;'>
												<div style='margin-top:4px;'>
													Reply
												</div>
											</a>
										</div>
										";
									} 
								}
								if($User){
									echo"
									<div style='float:right;bottom:0px;padding-right:5px;'>
										<a href='http://avatar-gamer.ga/abuse/report-forum-post.aspx?ID=".$Thread->ID."' style='font-weight:normal;color:#06C;'>
											Report Abuse
										</a>
									</div>
									";
								}
								else{
									echo"
									<div style='float:right;bottom:0px;padding-right:5px;'>
										<a href='http://avatar-gamer.ga/Login.aspx?&RedirectUrl=http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$Thread->ID."' style='font-weight:normal;color:#06C;'>
											Login to Report
										</a>
									</div>
									";
								}
								if ($User) {
									if ($myU->PowerForumModerator == "true") {
										if(!$Thread->OriginalTitle||!$Thread->OriginalBody){
											echo"
											<div style='float:left;bottom:0px;padding-left:5px;'>
												<a href='http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$Thread->ID."?&ThreadType=main&Moderation=scrub' class='btn-control-prof' style='font-size:12px;'>
													<div style='margin-top:4px;'>
														Scrub
													</div>
												</a>
											</div>
											";
										}
										echo"
										<div style='float:left;bottom:0px;padding-left:5px;'>
											<a href='http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$Thread->ID."?&ThreadType=main&Moderation=delete' class='btn-control-prof' style='font-size:12px;'>
												<div style='margin-top:4px;'>
													Delete
												</div>
											</a>
										</div>
										";
										if($Thread->Locked == "1"){
											echo"
											<div style='float:left;bottom:0px;padding-left:5px;'>
												<a href='http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$Thread->ID."?&ThreadType=main&Moderation=unlock' class='btn-control-prof' style='font-size:12px;'>
													<div style='margin-top:4px;'>
														Unlock
													</div>
												</a>
											</div>
											";
										}
										elseif($Thread->Locked == "0"){
											echo"
											<div style='float:left;bottom:0px;padding-left:5px;'>
												<a href='http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$Thread->ID."?&ThreadType=main&Moderation=lock' class='btn-control-prof' style='font-size:12px;'>
													<div style='margin-top:4px;'>
														Lock
													</div>
												</a>
											</div>
											";
										}
										if($Thread->OriginalTitle||$Thread->OriginalBody){
											echo"
											<div class='Scrub-Box-Forum'>
												<div style='padding-top:5px;'></div>
												<b>Original Title:</b>
												<br /> 
												".htmlentities($Thread->OriginalTitle)."
												<div style='padding-top:10px;'></div>
												<b>Original Body:</b>
												<br />
												".htmlentities($Thread->OriginalBody)."
												<div style='padding-top:10px;'></div>
												<a href='http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$Thread->ID."?&ThreadType=main&Moderation=undoscrub' class='btn-control-prof' style='font-size:12px;'>
													<div style='margin-top:4px;'>
														Restore Thread
													</div>
												</a>
											</div>
											";
										}
									} 
								}?>
							</h3>
						</div>
						<br />
						<br />
						<br />
					</td>
				</tr>
			</tbody>
		</table>
		<?$GetReplies = mysql_query("SELECT * FROM Replies WHERE tid='".$ID."' ORDER BY ID ASC LIMIT {$Minimum},  ". $Setting["PerPage"]);
		while ($Reply = mysql_fetch_object($GetReplies)){
			$Body = $Reply->Body;
			$Pattern = "/(https:\/\/)?(www\.)?world2build.net(\/)?([a-z\.\?\/\=0-9]+)?/i";
			$GetPoster = mysql_query("SELECT * FROM Users WHERE ID='".$Reply->PosterID."'");
			$Poster = mysql_fetch_object($GetPoster);
			
			echo'<a name="'.$Reply->ID.'"></a>';
			echo"
			<table cellpadding='0' cellspacing='0' width='100%' style='border-bottom:1px solid #ccc;'>
				<tbody>
					<tr>
						<td class='forum-table-row-fluid' width='15%' style='vertical-align:top;border-top:0px;border-right:0px solid #ccc;'>
							<table cellspacing='0' cellpadding='0' width='100%'>
								<tr>
									<td class='avatar-stats' style='text-align:center;'>
										<a href='http://avatar-gamer.ga/user.aspx?ID=".$Poster->ID."'>
										<b>".$Poster->Username."</b>
											<br />
											<center>
												<img src='http://avatar-gamer.ga/Avatar.aspx?ID=".$Poster->ID."'>
											</center>
											";
										
										echo"
										</a>
									</td>
								</tr>
								<tr> 
									<td class='forum-stats'>
									";
									$getTopPosters = mysql_query("SELECT * FROM Users ORDER BY ForumPost DESC LIMIT 0,1");
									while ($gTT = mysql_fetch_object($getTopPosters)) {
										if ($Poster->Username == $gTT->Username) {
											echo"<img src='http://avatar-gamer.ga/Images/top.gif'><br />";
										}
									}
									$getTopPosters = mysql_query("SELECT * FROM Users ORDER BY ForumPost DESC LIMIT 0,10");
									while ($gTT = mysql_fetch_object($getTopPosters)) {
										if ($Poster->Username == $gTT->Username) {
											echo"<img src='http://avatar-gamer.ga/Images/top10.gif'>";
										}
									}
									echo"
									</td>
								</tr>
								";
								if($Poster->PowerForumModerator == "true"){
									echo"
									<tr>
										<td class='mod-image'>
											<img src='http://avatar-gamer.ga/Images/users_moderator.gif'>
										</td>
									</tr>
									";
								}
								$Posts = mysql_num_rows($Posts = mysql_query("SELECT * FROM Threads WHERE PosterID='".$Poster->ID."'")); 
								$Replies = mysql_num_rows($Replies = mysql_query("SELECT * FROM Replies WHERE PosterID='".$Poster->ID."'")); 
								$Posts2 = $Posts+$Replies;
								if(empty($Reply->Title)){
									$replytitle = "re: $Thread->Title";
								}else{
									$replytitle = "$Reply->Title";
								}
								echo"
								<tr>
									<td class='forum-user-privs'>
										<b>Total Posts:</b> ".$Posts2."
										<br />
										<b>Join Date: </b>";
											if($Poster->JoinDate){echo"".$Poster->JoinDate."";}else{echo"Apr 6, 2014";}
										echo"
									</td>
								</tr>
							</table>
						</td>
						<td class='forum-table-row-fluid' style='vertical-align:top;border-top:0;' width='85%'>
							<div style='margin:0;padding:5px;'>
								<h3 style='font-weight:normal;margin:0;padding:0;'>
									<b style='font-size:13px;'>".$replytitle."</b><div style='float:right;'><b style='font-size:13px;'>".$Reply->TimePosted."</b></div>
									<div class='divider-bottom' style='width:100%;border:0;margin-top:5px;margin-bottom:5px;'></div>
									".nl2br($Body)."
									<br />
									<br />
									<b style='font-size:12px;'>".$Poster->Siggy."</b>
									<div style='margin-bottom:20px;'></div>
									";
									if ($User) {
										if($Thread->Locked == "1" && $myU->PowerForumModerator == "true"){
											echo"
											<div style='float:left;bottom:0px;padding-left:5px;'>
												<a href='http://avatar-gamer.ga/forum/Reply.aspx?ID=".$Thread->ID."' class='btn-control-prof' style='font-size:12px;'>
													<div style='margin-top:4px;'>
														Mod Reply
													</div>
												</a>
											</div>
											";
										}
										elseif ($Thread->Locked == "0") {
											echo"
											<div style='float:left;bottom:0px;padding-left:5px;'>
												<a href='http://avatar-gamer.ga/forum/Reply.aspx?ID=".$Thread->ID."' class='btn-control-prof' style='font-size:12px;'>
													<div style='margin-top:4px;'>
														Reply
													</div>
												</a>
											</div>
											";
										}
									}
									if($User){
										echo"
										<div style='float:right;bottom:0px;padding-right:5px;'>
											<a href='http://avatar-gamer.ga/abuse/report-reply.aspx?ID=".$Reply->ID."' style='font-weight:normal;color:#06C;'>
												Report Abuse
											</a>
										</div>
										";
									}
									else{
										echo"
										<div style='float:right;bottom:0px;padding-right:5px;'>
											<a href='http://avatar-gamer.ga/Login.aspx?&RedirectUrl=http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$Thread->ID."#".$Reply->ID."' style='font-weight:normal;color:#06C;'>
												Login to Report
											</a>
										</div>
										";
									}
									if ($User) {
										if ($myU->PowerForumModerator == "true") {
											if(!$Reply->OriginalBody){
												echo"
												<div style='float:left;bottom:0px;padding-left:5px;'>
													<a href='http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$Thread->ID."?&ThreadType=reply&ReplyID=".$Reply->ID."&Moderation=scrub' class='btn-control-prof' style='font-size:12px;'>
														<div style='margin-top:4px;'>
															Scrub
														</div>
													</a>
												</div>
												";
											}
											echo"
											<div style='float:left;bottom:0px;padding-left:5px;'>
												<a href='http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$Thread->ID."?&ThreadType=reply&ReplyID=".$Reply->ID."&Moderation=delete' class='btn-control-prof' style='font-size:12px;'>
													<div style='margin-top:4px;'>
														Delete
													</div>
												</a>
											</div>
											";
										}
										if($Reply->OriginalBody){
											echo"
											<div class='Scrub-Box-Forum' style='margin-top:50px;'>
												<div style='padding-top:5px;'></div>
												<b>Original Body:</b>
												<br />
												".addslashes($Reply->OriginalBody)."
												<div style='padding-top:10px;'></div>
												<a href='http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$Thread->ID."?&ThreadType=reply&ReplyID=".$Reply->ID."&Moderation=undoscrub' class='btn-control-prof' style='font-size:12px;'>
													<div style='margin-top:4px;'>
														Restore Reply
													</div>
												</a>
											</div>
											";
										}
									}
								echo"
								</h3>
							</div>
							<br />
							<br />
							<br />
						</td>
					</tr>
				</tbody>
			</table>
			";
		}?>
		<div class='forum-table-header' width='100%' style='padding:20px;'></div>
	</div>
<?
	if($User && $myU->PowerForumModerator == "true"){
		$Moderation = SecurePost($_GET['Moderation']);
                $date = date("F j, Y g:iA");
		$ThreadType = SecurePost($_GET['ThreadType']);
		$Body = addslashes($Thread->Body);
		$Title = addslashes($Thread->Title);
		if($Moderation == "scrub" && $myU->PowerForumModerator == "true" && !$Thread->OriginalTitle && !$Thread->OriginalBody && $ThreadType == "main"){
			mysql_query("UPDATE Threads SET OriginalTitle='".$Title."' WHERE ID='".$ID."'");
			mysql_query("UPDATE Threads SET OriginalBody='".$Body."' WHERE ID='".$ID."'");
                        mysql_query("INSERT INTO Logs (UserID, Message, Type, Date) VALUES ('$myU->ID','Has Scrubbed &quot;$Title&quot; in forums','Forum','$date')");
			mysql_query("UPDATE Threads SET Title='[ Moderated Content ]' WHERE ID='".$ID."'");
			mysql_query("UPDATE Threads SET Body='[ Moderated Content ]' WHERE ID='".$ID."'");
			header("Location: http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$ID."");
			die();
		}
		if($Moderation == "delete" && $myU->PowerForumModerator == "true" && $ThreadType == "main"){
                        mysql_query("INSERT INTO Logs (UserID, Message, Type, Date) VALUES ('$myU->ID','Has Deleted &quot;$Title&quot; from the forums','Forum','$date')");
			mysql_query("DELETE FROM Threads WHERE ID='".$ID."'");
			header("Location: http://avatar-gamer.ga/forum/ShowForum.aspx?ID=".$Thread->tid."");
			die();
		}
		if($Moderation == "undoscrub" && $myU->PowerForumModerator == "true"   && $Thread->OriginalTitle && $Thread->OriginalBody && $ThreadType == "main"){
			mysql_query("UPDATE Threads SET Title='".$Thread->OriginalTitle."' WHERE ID='".$ID."'");
			mysql_query("UPDATE Threads SET Body='".$Thread->OriginalBody."' WHERE ID='".$ID."'");
			mysql_query("UPDATE Threads SET OriginalTitle='' WHERE ID='".$ID."'");
			mysql_query("UPDATE Threads SET OriginalBody='' WHERE ID='".$ID."'");
                        mysql_query("INSERT INTO Logs (UserID, Message, Type, Date) VALUES ('$myU->ID','Has Reverted &quot;$Thread->OriginalTitle&quot; in forums','Forum','$date')");

               			header("Location: http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$ID."");
			die();
		}
		if($Moderation == "lock" && $myU->PowerForumModerator == "true" && $ThreadType == "main"){
                        mysql_query("INSERT INTO Logs (UserID, Message, Type, Date) VALUES ('$myU->ID','Has Locked &quot;$Title&quot; in forums','Forum','$date')");
			mysql_query("UPDATE Threads SET Locked='1' WHERE ID='".$ID."'");
			header("Location: http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$ID."");
			die();
		}
		if($Moderation == "unlock" && $myU->PowerForumModerator == "true" && $ThreadType == "main"){
			mysql_query("UPDATE Threads SET Locked='0' WHERE ID='".$ID."'");
                        mysql_query("INSERT INTO Logs (UserID, Message, Type, Date) VALUES ('$myU->ID','Has Unlocked &quot;$Title&quot; in forums','Forum','$date')");

			header("Location: http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$ID."");
			die();
		}
	}
	if($User && $myU->PowerForumModerator == "true"){
		$Moderation = SecurePost($_GET['Moderation']);
		$ThreadType = SecurePost($_GET['ThreadType']);
		$ReplyID = SecurePost($_GET['ReplyID']);
		$GetReplies = mysql_query("SELECT * FROM Replies WHERE tid='".$ID."' ORDER BY ID ASC LIMIT {$Minimum},  ". $Setting["PerPage"]);
		$Reply = mysql_fetch_object($GetReplies);
		$Body = addslashes($Reply->Body);
		if($Moderation == "scrub" && $myU->PowerForumModerator == "true"  && !$Reply->OriginalBody && $ThreadType == "reply"){
			mysql_query("UPDATE Replies SET OriginalBody='".$Body."' WHERE ID='".$ReplyID."'");
			mysql_query("UPDATE Replies SET Body='[ Moderated Content ]' WHERE ID='".$ReplyID."'");
                        mysql_query("INSERT INTO Logs (UserID, Message, Type, Date) VALUES ('$myU->ID','Has Scrubbed a reply to &quot;$Thread->Title&quot; in forums','Forum','$date')");

			header("Location: http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$ID."");
			die();
		}
		if($Moderation == "delete" && $myU->PowerForumModerator == "true" && $ThreadType == "reply"){
                        mysql_query("INSERT INTO Logs (UserID, Message, Type, Date) VALUES ('$myU->ID','Has Deleted a reply to &quot;$Thread->Title&quot; in forums','Forum','$date')");
			mysql_query("DELETE FROM Replies WHERE ID='".$ReplyID."'");

			header("Location: http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$ID."");
			die();
		}
		if($Moderation == "undoscrub" && $myU->PowerForumModerator == "true"  && $Thread->OriginalBody && $ThreadType == "reply"){
			mysql_query("UPDATE Replies SET Body='".$Reply->OriginalBody."' WHERE ID='".$ReplyID."'");
			mysql_query("UPDATE Replies SET OriginalBody='' WHERE ID='".$ReplyID."'");
			header("Location: http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$ID."");
			die();
		}
	}
	include($_SERVER['DOCUMENT_ROOT']."/Footer.php");
?>