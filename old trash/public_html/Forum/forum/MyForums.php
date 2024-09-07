<?
	include($_SERVER['DOCUMENT_ROOT']."/Header.php");
	if(!$User){
		header("Location: http://avatar-gamer.ga/Landing/Animated/");
		die();
	}
	$TrackedThreads = mysql_query("SELECT * FROM TrackedThreads WHERE UserID='".$myU->ID."'");
	$Exist = mysql_num_rows($TrackedThreads);
	$TrackedThreadInfo = mysql_query("SELECT * FROM Threads WHERE ID='".$Tracked->ID."'");
	$TrackedInfo = mysql_fetch_object($TrackedThreadInfo);
?>
	<div class='tracked-thread-page'>
		<div class='forum-thread-page' style='padding-top:10px;'>
			<a href='http://avatar-gamer.ga/forum/'>
				<b>Avatar-Universe Forum</b>
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
		</div>
		<h1 style='font-weight:normal;'>
			Your Tracked Threads
		</h1>
		<?if($Exist == 0){
			echo"
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
			You have no tracked threads.
			";
		}else{
			while($Tracked = mysql_fetch_object($TrackedThreads)){
				
			}
		}?>
	</div>