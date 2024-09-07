<?php

	include($_SERVER['DOCUMENT_ROOT'].'/auth.admin/admin-header.php');

$getModerationLogs = mysql_query("SELECT * FROM Logs WHERE Type='Forum' ORDER BY ID DESC LIMIT 5");
$getBanLogs = mysql_query("SELECT * FROM Logs WHERE Type='Ban' ORDER BY ID DESC LIMIT 5");
$getPasswordLogs = mysql_query("SELECT * FROM Logs WHERE Type='Password' ORDER BY ID DESC LIMIT 5");
	echo"
	<div id='StandardBoxHeader'>
		Logged Website Activity
	</div>
	<div id='StandardBox'>
		<table>
			<tr>
				<td>
					<div id='StandardBoxHeader'>
						Recent Account Freezes
					</div>
					<div id='StandardBox'>
						<table width='700'>
							<tr>
								<td width='100'>
								<b>Avatar</b>
								</td>
								<td width='200'>
									<b>Moderator</b>
								</td>
								<td width='200'>
									<b>Details</b>
								</td>
								<td width='200'>
									<b>Date</b>
								</td>
							</tr>
							<tr>
	"; 
	
			while($gB = mysql_fetch_object($getBanLogs)){ 
			$getUser = mysql_query("SELECT * FROM Users WHERE ID='$gB->UserID'");
			$gU = mysql_fetch_object($getUser);
								echo"
								<td width='100'>
															<a href='manage-user.aspx?ID=$gU->ID'>
		<img src='http://avatar-gamer.ga/Avatar.php?ID=$gU->ID' height='50'></a>
								</td>
								<td width='200'>
								<a href='manage-user.aspx?ID=$gU->ID'>
									".$gU->Username." 
									</a>
								</td>
								<td width='200'>
									".$gB->Message."
								</td>
								<td width='200'>
									".$gB->Date."
								</td>
							</tr>
						</td>
					</tr>
				
				";
			}
			
echo"</table></div></div></div>";
echo"
		<table>
			<tr>
				<td>
					<div id='StandardBoxHeader'>
						Recent Miscellaneous Moderation

					</div>
					<div id='StandardBox'>
						<table width='700'>
							<tr>
								<td width='100'>
								<b>Avatar</b>
								</td>
								<td width='200'>
									<b>Moderator</b>
								</td>
								<td width='200'>
									<b>Details</b>
								</td>
								<td width='200'>
									<b>Date</b>
								</td>
							</tr>
							<tr>
	"; 
	
			while($gM = mysql_fetch_object($getModerationLogs)){ 
			$getUser = mysql_query("SELECT * FROM Users WHERE ID='$gM->UserID'");
			$gU = mysql_fetch_object($getUser);
								echo"
								<td width='100'>
															<a href='manage-user.aspx?ID=$gU->ID'>
		<img src='http://avatar-gamer.ga/Avatar.php?ID=$gU->ID' height='50'></a>
								</td>
								<td width='200'>
								<a href='manage-user.aspx?ID=$gU->ID'>
									".$gU->Username." 
									</a>
								</td>
								<td width='200'>
									".$gM->Message."
								</td>
								<td width='200'>
									".$gM->Date."
								</td>
							</tr>
						</td>
					</tr>
				
				";
			}
			
echo"</table></div></div></div>";
echo"
		<table>
			<tr>
				<td>
					<div id='StandardBoxHeader'>
						Recent Password Changes
					</div>
					<div id='StandardBox'>
						<table width='700'>
							<tr>
								<td width='100'>
								<b>Avatar</b>
								</td>
								<td width='200'>
									<b>Moderator</b>
								</td>
								<td width='200'>
									<b>Details</b>
								</td>
								<td width='200'>
									<b>Date</b>
								</td>
							</tr>
							<tr>
	"; 
	
			while($gP = mysql_fetch_object($getPasswordLogs)){ 
			$getUser = mysql_query("SELECT * FROM Users WHERE ID='$gP->UserID'");
			$gU = mysql_fetch_object($getUser);
								echo"
								<td width='100'>
															<a href='manage-user.aspx?ID=$gU->ID'>
		<img src='http://avatar-gamer.ga/Avatar.php?ID=$gU->ID' height='50'></a>
								</td>
								<td width='200'>
								<a href='manage-user.aspx?ID=$gU->ID'>
									".$gU->Username." 
									</a>
								</td>
								<td width='200'>
									".$gP->Message."
								</td>
								<td width='200'>
									".$gP->Date."
								</td>
							</tr>
						</td>
					</tr>
				
				";
			}
			
echo"</table></div></div></div>";



