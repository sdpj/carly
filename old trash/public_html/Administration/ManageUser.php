<?php
	include "Header.php";
	if ($myU->PowerAdmin != "true") { header("Location: index.php"); exit(); }

		$ID = mysql_real_escape_string($_GET['ID']);
		
		if (!$ID) {
		
			echo "<b>Invalid ID.</b>";
			die;
		}
		
		$getUser = mysql_query("SELECT * FROM Users WHERE ID='$ID'");
		$numUser = mysql_num_rows($getUser);
		
		if ($numUser == 0) {
		
			echo "<b>Invalid ID.";
			die;
		
		}
		
		//start
		
		$gU = mysql_fetch_object($getUser);
		
		echo "
		<table>
			<tr>
				<td>
					<div id='ProfileText'>
	".$gU->Username."
	<br /><br />
	<a href='EditUser.php?ID=$ID'><font size='2'>Edit User</a></font>
	
	
					</div>
					View and modify things for the user ".$gU->Username.".
				</td>
			</tr>
		</table>
		<br />
		<table>
			<tr>
				<td valign='top'>
					<div style='width:100px;height:200px;border:1px solid #DDD;'>
						";echo"<div>";
							$height = 195;
								$width = 100;
								echo "
						<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir" . $gU->Background . ");'>
						<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Dir/Avatar.png);'>
							<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Eyes . ");'> 
								<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Mouth . ");'>
									<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Hair . ");'>
										<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Bottom . ");'>
											<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Top . ");'>
												<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Hat . ");'>
													<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Shoes . ");'>
														<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Accessory . ");'>

														";
														if (time() < $gO->expireTime) {
														echo "<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(/Imagess/OnlineWatermark.png);'>";
														}
														if (time() < $gO->expireTime) {
														echo "</div>";
														}
														echo "
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
					";echo"
					</div>
				</td>
				<td valign='top'>
					<b><font size='1'>User Statistics:</font></b>
					<br />
					<br />
					<table style='padding:4px;'>
						<tr>
							<td width='150'>
								<b><font size='1'>Currency:</font></b>
							</td>
							<td>
								<font color='green'><font size='1'><b>".($gU->Bux)." VOINS</b></font></font>
							</td>
						</tr>
						<tr>
							<td>
								<b><font size='1'>Status:</font></b>
							</td>
							<td>
							";
							
								if ($now < $gU->expireTime) {
								$Status = "<font size='1'><b>Online</font></b>";
								$Color = "green";
								}
								else {
								$Status = "<font size='1'><b>Offline</font></b>";
								$Color = "red";
								}
								
							echo "
								<font color='$Color'>$Status</font>
							</td>
						</tr>
<tr>
<td><font size='1'><b>Verified</b></font></td>
<td>"; if ($gU->Verified == 1) { echo" <font color='green'><font size='1'>Verified</font></font>";} else { echo"<font color='red'><font size='1'>Not verified</font>"; }
echo"</td>
</tr>
						<tr>
							<td>
								<b><font size='1'>Last Seen:</font></b>
							</td>

							<td>
								";
								echo date("F j, Y g:iA","".$gU->visitTick."");
								echo "
							</td>
						</tr>
						<tr>
							<td>
								<b><font size='1'>Purge Avatar:</font></b>
							</td>
							<td>
								<a href='?purge=yes'><font size='1'>Purge Avatar</font></a>
							</td>
							
							
						</tr>
						<tr>
						<td><b><font size='1'>Current Ban:</font> </b>
						</td>
						<td>
					"; if ($gU->Ban == 1) { echo"<font color='red'>Current banned for $gU->BanLength Days "; }
					else { echo"<font color='green'><b><font size='1'>No current ban.</font></b></font>";
					}
					echo"
						<tr>
							<td>
								<b><font size='1'>Premium Expire:</font></b>
							</td>
							<td>
								";
								if ($gU->Premium == 0) {
								
									echo "<font size='1'>User does not have premium.</font>";
								
								}
								else {
								
									if ($gU->PremiumExpire == "unlimited") {
									
										echo "<font size='1'>Lifetime Premium</font>";
									
									}
									else {
								
										echo date("F j, Y g:iA","".$gU->PremiumExpire."");
									
									}
								
								}
if ($myU->Username == "MOBIX"||$myU->Username == "coocbooc"||$myU->Username == "noynac") {
								echo "
							</td>
						</tr>
					</table>
				</td>

				<td valign='top'>
					<b><font size='1'>Give Premium:</font></b>
					<br />
					<br />
					<form action='' method='POST'>
						<table>
							<tr>
								<td>
									<b>Length:</b>
								</td>
								<td>
									";
									$time = time();
									$Month = 86400*30;
									$SixMonth = 86400*30*6;
									$Year = 86400*30*12;
									$Lifetime = "unlimited";
									echo "
									<select name='Length'>
										<option value='".$Month."'>Monthly</option>
										<option value='".$SixMonth."'>Half Year</option>
										<option value='".$Year."'>Yearly</option>
										<option value='".$Lifetime."'>Lifetime</option>
									</select>
								</td>
								<td>
									<input type='checkbox' name='BonusBux' value='1' checked>
									<label for='BonusBux' id='BonusBux'><font color='green'><b>5,000 VOINS</b></font> Bonus</label>
								</td>
							</tr>
							<tr>
								<td>
									<input type='submit' name='Submit' value='Submit'>
								</td>
							</tr>
                         <tr>
						 <td>
						 <b><input type='submit' name='reset' value='Reset Voins'></b>
						 </td>
						</table>
						";
						
							$Length = $_POST['Length'];
							$BonusBux = $_POST['BonusBux'];
							$Submit = $_POST['Submit'];
							
								if ($Submit) {
								
									mysql_query("UPDATE Users SET Premium='1' WHERE ID='$gU->ID'");
									
									if ($gU->PremiumExpire == "unlimited") {
									
										echo "<b>You can not add premium to a lifetime premium account.</b>";
									
									}
									
									else {
								
									if (!empty($gU->PremiumExpire)) {
									
										if ($Length != "unlimited") {
									
										$Length = $gU->PremiumExpire + $Length;
										
										}
									
										mysql_query("UPDATE Users SET PremiumExpire=PremiumExpire + $Length WHERE ID='$gU->ID'");
									
									}
									else {
										
										if ($Length != "unlimited") {
										
										$Length = time() + $Length;
										
										}
										
										mysql_query("UPDATE Users SET PremiumExpire='$Length' WHERE ID='$gU->ID'");
									
									}
									
									if ($BonusBux) {
									
										mysql_query("UPDATE Users SET Bux=Bux + 5000 WHERE ID='$gU->ID'");
									
									}
									
									header("Location: ManageUser.php?ID=$gU->ID");
									
									}
								
								}
}


						
						echo "
					</form>
				</td>
			</tr>
		</table>
		<br />
		<table>
			<tr>
				<td>
				<br />
					<div id='ProfileText'>
					
						Ban History
						<br /><br />
					<form action='' method='post'>
						<input type='submit' name='unBan' value='Unban'>
<a href='http://www.ravitar.rbxplus.com/Administration/ModerateUser.php?ID=$gU->ID'><font color='red'>Ban User</font></a>
				</form>
					</div>
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td width='100'>
					<b>Moderator</b>
				</td>
				<td width='100'>
					<b>Ban Type</b>
				</td>
				<td width='100'>
					<b>Ban Length</b>
				</td>
				<td width='300'>
					<b>Ban Description</b>
				</td>
				<td width='200'>
					<b>Ban Content</b>
				</td>
			</tr>
		</table>
		";
		
		$getHistory = mysql_query("SELECT * FROM BanHistory WHERE UserID='$ID' ORDER BY ID DESC");
		
		while ($gH = mysql_fetch_object($getHistory)) {
		
			echo "
			<table>
				<tr>
					<td width='100'>
						";
						
							$getMod = mysql_query("SELECT * FROM Users WHERE ID='$gH->WhoBanned'");
							$gM = mysql_fetch_object($getMod);
						
						echo "
						$gM->Username
					</td>
					<td width='100'>
						$gH->BanType
					</td>
					<td width='100'>
						$gH->BanLength days
					</td>
					<td width='300'>
						$gH->BanDescription
					</td>
					<td width='200'>
						$gH->BanContent
					</td>
				</tr>
			</table>
			";
		
		}
	
	include "Footer.php";
	
	
	
	$unban = $_POST['unBan'];
	
	if ($unban) {
	
	mysql_query("UPDATE Users SET Ban='0' WHERE ID='$gU->ID'");
	header("Location: ?ID=$gU->ID"); exit();
	}

$reset = $_POST['reset'];

if ($reset){
mysql_query("UPDATE Users SET Bux='1000' WHERE ID='$ID'");
header("Location: $self"); exit();
}
$Password = $_POST['password'];
$Confirm = $_POST['passwordc'];
$newPass = hash('sha512',$Password);


if ($Confirm) {

mysql_query("UPDATE Users SET Password='$newPass' WHERE ID='$ID'");
echo "<font color='green'> Password Changed</font>";
}
