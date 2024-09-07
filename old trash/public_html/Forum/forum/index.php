<?
	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
	$World2BuildTopics = mysql_query("SELECT * FROM Topics WHERE ID='1' OR ID='2' OR ID='5' OR ID='8'");
	$ClubHousesTopics = mysql_query("SELECT * FROM Topics WHERE ID='4' OR ID='1337'");
	$UnrelatedTopics = mysql_query("SELECT * FROM Topics WHERE ID='6' OR ID='9001' OR ID='7'");
?>
	<div class='forum-index'>
		<div style='text-align:right;padding-top:10px;padding-bottom:10px;'>
			<a href='/forum/' style='color:#363636;'>
				Home
			</a>
			|
			<a href='/forum/Search.aspx' style='color:#363636;'>
				Search
			</a>
			|
			<a href='/forum/MyThreads.aspx' style='color:#363636;'>
				My Forums
			</a>
		</div>
		<div style='text-align:left;padding-top:10px;padding-bottom:10px;'>
			<form action='' method='POST' style='margin:0;padding:0;'>
				<b>Current time:</b> <?echo"".date("F j, Y g:iA", $now)."";?>
				<div style='float:right;padding-bottom:10px;'>
					<b>Search Avatar-Universe Forums:</b>
					<input type='text' name='ForumIndexSearch' placeholder='Search...'>
					<input type='submit' name='ForumIndexSearchSubmit' value='Go' style='cursor:pointer;'>
				</div>
			</form>
		</div>
		<table cellpadding='0' name='Topic1Spacer' cellspacing='0' width='100%'>
			<tbody>
				<tr>
					<td class='forum-table-header' width='70%'>
						Avatar-Universe Central
					</td>
					<td class='forum-table-header-row' width='10%'>
						<center>
							Threads
						</center>
					</td>
					<td class='forum-table-header-row' width='10%'>
						<center>
							Posts
						</center>
					</td>
					<td class='forum-table-header-row' width='10%'>
						<center>
							Last Post
						</center>
					</td>
				</td>
			</tbody>
		</table>
		<table cellpadding='0' name='Topic1' cellspacing='0' width='100%'>
			<?while($World2Build = mysql_fetch_object($World2BuildTopics)){
				$ThreadCount = mysql_query("SELECT * FROM Threads WHERE tid='".$World2Build->ID."'");
				$Threads = mysql_num_rows($ThreadCount);
				$Threads2 = mysql_fetch_object($ThreadCount);
				$RepliesCount = mysql_query("SELECT * FROM Replies WHERE tid='".$ThreadCount->ID."'");
				$Replies = mysql_num_rows($RepliesCount);
				$lastReply = mysql_query("SELECT * FROM Replies WHERE tid='".$Threads2->ID."' ORDER BY ID DESC LIMIT 1");
				$lR = mysql_num_rows($lastReply);
				if ($lR == 0) {
					$LastReply = "-";
				}
				else {
					$lR = mysql_fetch_object($lastReply);
					$getPoster = mysql_query("SELECT * FROM Users WHERE ID='".$lR->PosterID."'");
					$gP = mysql_fetch_object($getPoster);
					$LastReply = "
					<a href='/forum/ShowPost.aspx?ID=".$Threads2->ID."#".$lR->ID."'>
						<font style='color:#363636;font-size:13px;'>
							<font style='font-size:12px;'>
								<b>".$lR->TimePosted."</b>
							</font>
							<br />
							".$gP->Username."
						</font>
					</a>
					";
				}
				echo"
				<tr>
					<td width='70%' class='forum-table-row'>
						<div class='topic-name-description' style='width:87%'>
							<a href='/forum/ShowForum.aspx?ID=".$World2Build->ID."' class='forumTitle'>
								".$World2Build->TopicName."
								<div style='margin-top:5px;'></div>
								<font style='font-size:13px;font-weight:normal;'>
									".$World2Build->TopicDescription."
								</font>
							</a>
						</div>
					</td>
					<td width='10%' class='forum-table-row' style='border-left:1px solid #ccc;'>
						<center>
							".$Threads."
						</center>
					</td>
					<td width='10%' class='forum-table-row' style='border-left:1px solid #ccc;'>
						<center>
							".$Replies."
						</center>
					</td>
					<td width='10%' class='forum-table-row' style='border-left:1px solid #ccc;'>
						<center>
							".$LastReply."
						</center>
					</td>
				</tr>
				";
			}?>
		</table>
		<table cellpadding='0' name='Topic1Spacer' cellspacing='0' width='100%'>
			<tbody>
				<tr>
					<td class='forum-table-header' width='70%'>
						Hangouts and Guilds
					</td>
					<td class='forum-table-header-row' width='10%'>
						<center>
							Threads
						</center>
					</td>
					<td class='forum-table-header-row' width='10%'>
						<center>
							Posts
						</center>
					</td>
					<td class='forum-table-header-row' width='10%'>
						<center>
							Last Post
						</center>
					</td>
				</td>
			</tbody>
		</table>
		<table cellpadding='0' name='Topic1' cellspacing='0' width='100%'>
			<?while($ClubHouses = mysql_fetch_object($ClubHousesTopics)){
				$ThreadCount = mysql_query("SELECT * FROM Threads WHERE tid='".$ClubHouses->ID."'");
				$Threads = mysql_num_rows($ThreadCount);
				$Threads2 = mysql_fetch_object($ThreadCount);
				$RepliesCount = mysql_query("SELECT * FROM Replies WHERE tid='".$Threads->ID."'");
				$Replies = mysql_fetch_object($RepliesCount);
				$lastReply = mysql_query("SELECT * FROM Replies WHERE tid='".$Threads2->ID."' ORDER BY ID DESC LIMIT 1");
				$lR = mysql_num_rows($lastReply);
				if ($lR == 0) {
					$LastReply = "-";
				}
				else {
					$lR = mysql_fetch_object($lastReply);
					$getPoster = mysql_query("SELECT * FROM Users WHERE ID='".$lR->PosterID."'");
					$gP = mysql_fetch_object($getPoster);
					$LastReply = "
					<a href='/forum/ShowPost.aspx?ID=".$Threads2->ID."#".$lR->ID."'>
						<font style='color:#363636;font-size:13px;'>
							<font style='font-size:12px;'>
								<b>".$lR->TimePosted."</b>
							</font>
							<br />
							".$gP->Username."
						</font>
					</a>
					";
				}
				echo"
				<tr>
					<td width='70%' class='forum-table-row'>
						<div class='topic-name-description' style='width:87%'>
							<a href='/forum/ShowForum.aspx?ID=".$ClubHouses->ID."' class='forumTitle'>									".$World2Build->TopicName."
								".$ClubHouses->TopicName."
								<div style='margin-top:5px;'></div>
								<font style='font-size:13px;font-weight:normal;'>
									".$ClubHouses->TopicDescription."
								</font>
							</a>
						</div>
					</td>
					<td width='10%' class='forum-table-row' style='border-left:1px solid #ccc;'>
						<center>
							".$Threads."
						</center>
					</td>
					<td width='10%' class='forum-table-row' style='border-left:1px solid #ccc;'>
						<center>
							15
						</center>
					</td>
					<td width='10%' class='forum-table-row' style='border-left:1px solid #ccc;'>
						<center>
							".$LastReply."
						</center>
					</td>
				</tr>
				";
			}?>
		</table>
		<table cellpadding='0' name='Topic1Spacer' cellspacing='0' width='100%'>
			<tbody>
				<tr>
					<td class='forum-table-header' width='70%'>
						Unrelated Chat
					</td>
					<td class='forum-table-header-row' width='10%'>
						<center>
							Threads
						</center>
					</td>
					<td class='forum-table-header-row' width='10%'>
						<center>
							Posts
						</center>
					</td>
					<td class='forum-table-header-row' width='10%'>
						<center>
							Last Post
						</center>
					</td>
				</td>
			</tbody>
		</table>
		<table cellpadding='0' name='Topic1' cellspacing='0' width='100%'>
			<?while($Unrelated = mysql_fetch_object($UnrelatedTopics)){
				$ThreadCount = mysql_query("SELECT * FROM Threads WHERE tid='".$Unrelated->ID."'");
				$Threads = mysql_num_rows($ThreadCount);
				$Threads2 = mysql_fetch_object($ThreadCount);
				$RepliesCount = mysql_query("SELECT * FROM Replies WHERE tid='".$Threads->ID."'");
				$Replies = mysql_fetch_object($RepliesCount);
				$lastReply = mysql_query("SELECT * FROM Replies WHERE tid='".$Threads2->ID."' ORDER BY ID DESC LIMIT 1");
				$lR = mysql_num_rows($lastReply);
				if ($lR == 0) {
					$LastReply = "-";
				}
				else {
					$lR = mysql_fetch_object($lastReply);
					$getPoster = mysql_query("SELECT * FROM Users WHERE ID='".$lR->PosterID."'");
					$gP = mysql_fetch_object($getPoster);
					$LastReply = "
					<a href='/forum/ShowPost.aspx?ID=".$Threads2->ID."#".$lR->ID."'>
						<font style='color:#363636;font-size:13px;'>
							<font style='font-size:12px;'>
								<b>".$lR->TimePosted."</b>
							</font>
							<br />
							".$gP->Username."
						</font>
					</a>
					";
				}
				echo"
				<tr>
					<td width='70%' class='forum-table-row'>
						<div class='topic-name-description' style='width:87%'>
							<a href='/forum/ShowForum.aspx?ID=".$Unrelated->ID."' class='ForumTitle'>									".$World2Build->TopicName."
								".$Unrelated->TopicName."
								<div style='margin-top:5px;'></div>
								<font style='font-size:13px;font-weight:normal;'>
									".$Unrelated->TopicDescription."
								</font>
							</a>
						</div>
					</td>
					<td width='10%' class='forum-table-row' style='border-left:1px solid #ccc;'>
						<center>
							".$Threads."
						</center>
					</td>
					<td width='10%' class='forum-table-row' style='border-left:1px solid #ccc;'>
						<center>
							15
						</center>
					</td>
					<td width='10%' class='forum-table-row' style='border-left:1px solid #ccc;'>
						<center>
							".$LastReply."
						</center>
					</td>
				</tr>
				";
			}?>
		</table>
	</div>
<?
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>