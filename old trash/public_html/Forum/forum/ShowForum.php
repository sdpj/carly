<?
	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
	$ID = SecurePost($_GET['ID']);
	$Topics = mysql_query("SELECT * FROM Topics WHERE ID='".$ID."'");
	$Topic = mysql_fetch_object($Topics);
	$TopicExist = mysql_num_rows($Topics);
	$Stickies = mysql_query("SELECT * FROM Threads WHERE tid='".$ID."' AND Type='sticky'");
	$Globals = mysql_query("SELECT * FROM Threads WHERE Type='global'");
	if($TopicExist == 0){
		header("Location: http://avatar-gamer.ga/directory-missing/?code=unknown");
		die();
	}
	$Setting = array(
	"PerPage" => 15
	);
	$Page = mysql_real_escape_string(strip_tags(stripslashes($_GET['Page'])));
	if ($Page < 1) { $Page=1; }
	if (!is_numeric($Page)) { $Page=1; }
	$Minimum = ($Page - 1) * $Setting["PerPage"];
	//query
	$num = mysql_num_rows($allusers = mysql_query("SELECT * FROM Threads WHERE tid='".$ID."'"));
	$Num = ($Page+8);
	$Threads = mysql_query("SELECT * FROM Threads WHERE tid='".$ID."' AND Type='regular' ORDER BY bump DESC LIMIT {$Minimum},  ". $Setting["PerPage"]);
	if($Topic->ID == "1"||$Topic->ID == "2"||$Topic->ID == "3"||$Topic->ID == "4"||$Topic->ID == "5"||$Topic->ID == "6"){
		$GroupName = "World2Build";
		$GroupID = 1;
	}
	elseif($Topic->ID == "7"||$Topic->ID == "8"){
		$GroupName = "Club Houses";
		$GroupID = 2;
	}
	$GroupName = $GroupName;
?>
	<div class='forum-category-page' style='padding-top:10px;'>
		<a href='http://avatar-gamer.ga/forum/'>
			<b>Avatar-Universe Forum</b>
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
		<div style='padding-top:10px;'></div>
		<div style='text-align:left;padding-top:10px;padding-bottom:10px;'>
			<form action='' method='POST' style='margin:0;padding:0;'>
				<a href='http://avatar-gamer.ga/forum/NewPost.aspx?ID=<?echo$Topic->ID;?>' class='btn-primary' style='padding:3px;font-size:13px;'>
					New Thread
				</a>
				<a href='http://avatar-gamer.ga/forum/TopPosters.aspx' class='btn-primary' style='padding:3px;font-size:13px;'>
					Top 10 Posters
				</a>
				<div style='float:right;padding-bottom:10px;'>
					<b>Search this forum:</b>
					<input type='text' name='ForumIndexSearch' placeholder='Search...'>
					<input type='submit' name='ForumIndexSearchSubmit' value='Go' style='cursor:pointer;'>
				</div>
			</form>
		</div>
		<table cellpadding='0' name='Topic1Spacer' cellspacing='0' width='100%'>
			<tbody>
				<tr>
					<td class='forum-table-header' width='60%'>
						Subject
					</td>
					<td class='forum-table-header-row' width='10%'>
						<center>
							Author
						</center>
					</td>
					<td class='forum-table-header-row' width='10%'>
						<center>
							Replies
						</center>
					</td>
					<td class='forum-table-header-row' width='10%'>
						<center>
							Views
						</center>
					</td>
					<td class='forum-table-header-row' width='10%'>
						<center>
							Last Post
						</center>
					</td>
				</tr>
			</tbody>
		</table>
		<table cellpadding='0' name='Topic1' cellspacing='0' width='100%'>
			<?while($Global = mysql_fetch_object($Globals)){
				if($Replies == 0){
					$Replies = "-";
				}
				else{
					$Replies = "".$Replies."";
				}
				$lastReply = mysql_query("SELECT * FROM Replies WHERE tid='".$Global->ID."' ORDER BY ID DESC LIMIT 1");
				$lR = mysql_num_rows($lastReply);
				if ($lR == 0) {
					$LastReply = "-";
				}
				else {
					$lR = mysql_fetch_object($lastReply);
					$getPoster = mysql_query("SELECT * FROM Users WHERE ID='".$lR->PosterID."'");
					$gP = mysql_fetch_object($getPoster);
					$LastReply = "
					<a href='http://avatar-gamer.ga/user.aspx?ID=".$gP->ID."'>
						<center>
							<font style='font-size:10px;'>
								<b>".$lR->TimePosted."</b>
							</font>
							<br />
							".$gP->Username."
						</center>
					</a>
					";
				}
				$NumberReplies = mysql_query("SELECT * FROM Replies WHERE tid='".$Global->ID."'");
				$Replies = mysql_num_rows($NumberReplies);
				if($Replies == 0){
					$RepliesNumber = "-";
				}
				else{
					$RepliesNumber = $Replies;
				}
				$getPoster = mysql_query("SELECT * FROM Users WHERE ID='".$Global->PosterID."'");
				$gP = mysql_fetch_object($getPoster);
				$GlobalTitle = $Global->Title;
				if(strlen($GlobalTitle) > 50)  $GlobalTitle = substr($GlobalTitle, 0, 50).'...'; 
				if($Global->Locked == "0"){
					$ForumImage = "<img src='http://avatar-gamer.ga/Images/warning.png' style='padding-right:5px;vertical-align:middle;' width='25'>";
				}
				elseif($Global->Locked == "1"){
					$ForumImage = "<img src='http://avatar-gamer.ga/Images/warning.png' style='padding-right:7px;vertical-align:middle;' width='25'>";
				}
				echo"
				<tr>
					<td width='60%' class='forum-table-row' style='max-width:60%;border-right:1px solid #ccc;padding:10px;'>
						<div class='topic-name-description' style='width:87%'>
							".$ForumImage."
							<a href='http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$Global->ID."'>
								<font style='font-size:14px;font-weight:normal;color:#363636;vertical-align:middle;'>
									<b>Announcement:</b> ".$GlobalTitle."
								</font>
							</a>
						</div>
					</td>
				<td class='forum-table-row' width='10%' style='padding-top:10px;padding-bottom:10px;'>
						<a href='http://avatar-gamer.ga/user.aspx?ID=".$gP->ID."' style='font-size:13px;color:#363636;'>
							<center>
								<font style='font-size:10px;'>
									<b>".$Global->TimePosted."</b>
								</font>
								".$gP->Username."
							</center>
						</a>
					</td>
					<td class='forum-table-row' width='10%' style='padding-top:10px;padding-bottom:10px;border-left:1px solid #ccc;'>
						<center>
							".$RepliesNumber."
						</center>
					</td>
					<td class='forum-table-row' width='10%' style='padding-top:10px;padding-bottom:10px;border-left:1px solid #ccc;'>
						<center>
							".number_format($Global->Views)."
						</center>
					</td>
					<td class='forum-table-row' width='10%' style='padding-top:10px;padding-bottom:10px;border-left:1px solid #ccc;'>
						<center>
							<font style='font-size:13px;'>
								".$LastReply."
							</font>
						</center>
					</td>
				</tr>
				";
			}?>
		</table>
		<table cellpadding='0' name='Topic1' cellspacing='0' width='100%'>
			<?while($Sticky = mysql_fetch_object($Stickies)){
				$lastReply = mysql_query("SELECT * FROM Replies WHERE tid='".$Sticky->ID."' ORDER BY ID DESC LIMIT 1");
				$lR = mysql_num_rows($lastReply);
				if ($lR == 0) {
					$LastReply = "-";
				}
				else {
					$lR = mysql_fetch_object($lastReply);
					$getPoster = mysql_query("SELECT * FROM Users WHERE ID='".$lR->PosterID."'");
					$gP = mysql_fetch_object($getPoster);
					$LastReply = "
					<a href='http://avatar-gamer.ga/user.aspx?ID=".$gP->ID."' style='color:#363636;'>
						<center>
							<font style='font-size:10px;'>
								<b>".$lR->TimePosted."</b>
							</font>
							<br />
							".$gP->Username."
						</center>
					</a>
					";
				}
				$NumberReplies = mysql_query("SELECT * FROM Replies WHERE tid='".$Sticky->ID."'");
				$Replies = mysql_num_rows($NumberReplies);
				if($Replies == 0){
					$RepliesNumber = "-";
				}
				else{
					$RepliesNumber = $Replies;
				}
				$getPoster = mysql_query("SELECT * FROM Users WHERE ID='".$Sticky->PosterID."'");
				$gP = mysql_fetch_object($getPoster);
				$StickyTitle = $Sticky->Title;
				if(strlen($StickyTitle) > 50)  $StickyTitle = substr($StickyTitle, 0, 50).'...'; 
				if($Sticky->Locked == "0"){
					$ForumImage = "<img src='http://avatar-gamer.ga/Images/stickytopic.gif' style='padding-right:5px;vertical-align:middle;'>";
				}
				elseif($Sticky->Locked == "1"){
					$ForumImage = "<img src='http://avatar-gamer.ga/forum/Images/sticky-locked.png' style='padding-right:5px;vertical-align:middle;'>";
				}
				echo"
				<tr>
					<td width='60%' class='forum-table-row' style='max-width:60%;padding:10px;'>
						<div class='topic-name-description' style='width:87%'>
							".$ForumImage."
							<a href='http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$Sticky->ID."'>
								<font style='font-size:14px;font-weight:normal;color:#363636;vertical-align:middle;'>
									<b>Pinned:</b> ".$StickyTitle."
								</font>
							</a>
						</div>
					</td>
					<td class='forum-table-row' width='10%' style='padding-top:10px;padding-bottom:10px;border-left:1px solid #ccc;'>
						<a href='http://avatar-gamer.ga/user.aspx?ID=".$gP->ID."' style='font-size:13px;color:#363636;'>
							<center>
								<font style='font-size:10px;color:#363636;'>
									<b>".$Sticky->TimePosted."</b>
								</font>
								".$gP->Username."
							</center>
						</a>
					</td>
					<td class='forum-table-row' width='10%' style='padding-top:10px;padding-bottom:10px;border-left:1px solid #ccc;'>
						<center>
							".$RepliesNumber."
						</center>
					</td>
					<td class='forum-table-row' width='10%' style='padding-top:10px;padding-bottom:10px;border-left:1px solid #ccc;'>
						<center>
							".$Sticky->Views."
						</center>
					</td>
					<td class='forum-table-row' width='10%' style='padding-top:10px;padding-bottom:10px;border-left:1px solid #ccc;'>
						<center>
							<font style='font-size:13px;'>
								".$LastReply."
							</font>
						</center>
					</td>
				</tr>
				";
			}?>
		</table>
		<table cellpadding='0' name='Topic1' cellspacing='0' width='100%'>
			<?while($Thread = mysql_fetch_object($Threads)){
				$lastReply = mysql_query("SELECT * FROM Replies WHERE tid='".$Thread->ID."' ORDER BY ID DESC LIMIT 1");
				$lR = mysql_num_rows($lastReply);
				if ($lR == 0) {
					$LastReply = "-";
				}
				else {
					$lR = mysql_fetch_object($lastReply);
					$getPoster = mysql_query("SELECT * FROM Users WHERE ID='".$lR->PosterID."'");
					$gP = mysql_fetch_object($getPoster);
					$LastReply = "
					<a href='http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$Thread->ID."#".$lR->ID."'>
						<font style='color:#363636;font-size:13px;'>
							<font style='font-size:10px;'>
								<b>".$lR->TimePosted."</b>
							</font>
							<br />
							".$gP->Username."
						</font>
					</a>
					";
				}
				$NumberReplies = mysql_query("SELECT * FROM Replies WHERE tid='".$Thread->ID."'");
				$NumberReplies = mysql_query("SELECT * FROM Replies WHERE tid='".$Thread->ID."'");
				$Replies = mysql_num_rows($NumberReplies);
				if($Replies == 0){
					$RepliesNumber = "-";
				}
				else{
					$RepliesNumber = $Replies;
				}
				$getPoster = mysql_query("SELECT * FROM Users WHERE ID='".$Thread->PosterID."'");
				$gP = mysql_fetch_object($getPoster);
				$ThreadTitle = $Thread->Title;
				if(strlen($ThreadTitle) > 50)  $ThreadTitle = substr($ThreadTitle, 0, 50).'...'; 
				if($Thread->Views > 45 && $Thread->Locked == "1"){
					$ForumImage = "<img src='http://avatar-gamer.ga/Images/hotpost-locked.png' style='padding-right:5px;vertical-align:middle;'>";
				}
				elseif($Thread->Views > 45 && $Thread->Locked == "0"){
					$ForumImage = "<img src='http://avatar-gamer.ga/Images/hotpost.png' style='padding-right:5px;vertical-align:middle;'>";
				}
				elseif($Thread->Locked == "0"){
					$ForumImage = "<img src='http://avatar-gamer.ga/Images/regpost.gif' style='padding-right:5px;vertical-align:middle;'>";
				}
				elseif($Thread->Locked == "1"){
					$ForumImage = "<img src='http://avatar-gamer.ga/Images/postlocked.gif' style='padding-right:5px;vertical-align:middle;'>";
				}
				echo"
				<tr>
					<td width='60%' class='forum-table-row' style='max-width:60%;padding:10px;'>
						<div class='topic-name-description' style='width:100%'>
							".$ForumImage."
							<a href='http://avatar-gamer.ga/forum/ShowPost.aspx?ID=".$Thread->ID."'>
								<font style='font-size:14px;font-weight:normal;color:#363636;vertical-align:middle;'>
									".$ThreadTitle."
								</font>
							</a>
						</div>
					</td>
					<td class='forum-table-row' width='10%' style='padding-top:10px;padding-bottom:10px;border-left:1px solid #ccc;'>
						<a href='http://avatar-gamer.ga/user.aspx?ID=".$gP->ID."' style='font-size:13px;color:#363636;'>
							<center>
								<font style='font-size:10px;'>
									<b>".$Thread->TimePosted."</b>
								</font>
								<br />
								".$gP->Username."
							</center>
						</a>
					</td>
					<td class='forum-table-row' width='10%' style='padding-top:10px;padding-bottom:10px;border-left:1px solid #ccc;'>
						<center>
							".$RepliesNumber."
						</center>
					</td>
					<td class='forum-table-row' width='10%' style='padding-top:10px;padding-bottom:10px;border-left:1px solid #ccc;'>
						<center>
							".$Thread->Views."
						</center>
					</td>
					<td class='forum-table-row' width='10%' style='padding-top:10px;padding-bottom:10px;border-left:1px solid #ccc;'>
						<center>
							<font style='font-size:13px;'>
								".$LastReply."
							</font>
						</center>
					</td>
				</tr>
				";
			}?>
		</table>
	</div>
	<div class='forum-table-header' width='100%' style='padding:20px;'></div>
<?
	$amount=ceil($num / $Setting["PerPage"]);
	if ($Page > 1) {
	echo '<a href="http://avatar-gamer.ga/forum/ShowForum.aspx?ID='.$ID.'&Page='.($Page-1).'">Previous</a> - ';
	}
	echo '<b>Page '.$Page.' of '.(ceil($num / $Setting["PerPage"]));
	echo'</b>';
	if ($Page < ($amount)) {
	echo ' - <a href="http://avatar-gamer.ga/forum/ShowForum.aspx?ID='.$ID.'&Page='.($Page+1).'">Next</a>';
	}
?>
<?
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>