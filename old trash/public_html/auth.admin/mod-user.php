<?php
include($_SERVER['DOCUMENT_ROOT'].'/auth.admin/admin-header.php');

$ID = mysql_real_escape_string(strip_tags(stripslashes($_GET['ID'])));
$Banning = mysql_query("SELECT * FROM Users WHERE ID='$ID'");
$Banned = mysql_fetch_object($Banning);

$badcontent = mysql_real_escape_string(strip_tags(stripslashes($_GET['badcontent'])));

					echo "<div id='StandardBoxHeader'>Account state override.</div><div id='StandardBox'><div align='left'><div id='admintopbar'>Moderating User: $Banned->Username</div><br>

";

echo"<a href='../Administration/ManageUser.php?ID=$Banned->ID' class='btn'><font color='#343434'>View Previous Moderation Action</font></a><Br><br>"; echo"

							<form action='' method='POST'>
							
								
										<fieldset>
										<legend><div id='loginh2'><font size='3'><font color='#343434'>Suspension Category</font></font></div></legend>
											<input type='radio' name='BanType' value='Other' checked>Other
											
											
<input type='radio' name='BanType'  value='Bribery'>Bribery
											<input type='radio' name='BanType'  value='Exploiting/Hacking'>Exploiting/Hacking
											<input type='radio' name='BanType'  value='Copying Items'>Copying Items
											<input type='radio' name='BanType'  value='Personal Attacking'>Personal Attacking
											<input type='radio' name='BanType'  value='Online Dating'>Online Dating
											<input type='radio' name='BanType'  value='Profanity'>Profanity
											<input type='radio' name='BanType'  value='Threatening'>Threatening
											<input type='radio' name='BanType'  value='Spamming'>Spamming
<input type='radio' name='BanType'  value='Adult Content'>Adult Content
<input type='radio' name='BanType'  value='Account Spamming'>Account Spamming
<input type='radio' name='BanType'  value='Scamming'>Scamming
<input type='radio' name='BanType'  value='Account Selling/Trading'>Account Selling
							</fieldset><br />
								</td></tr></table>
								<fieldset>
								<legend><div id='loginh2'><font size='3'><font color='#343434'>Suspension Length</font></font></div></legend>
										  
									        <input type='radio' name='BanTime' value='Reminder' checked>Reminder 
											<input type='radio' name='BanTime' value='0'>Warning 
											<input type='radio' name='BanTime' value='1'>1 day 
										    <input type='radio' name='BanTime' value='3'>3 days 
											<input type='radio' name='BanTime' value='7'>7 days 
											<input type='radio' name='BanTime' value='14'>14 days 
											<input type='radio' name='BanTime' value='forever'>Termination 
                                                                                        
									</fieldset><br />
								
								<tr>
									<td><div id='loginh2'><font size='3'><font color='#343434'>&nbsp;&nbsp;&nbsp;&nbsp;Inappropriate content</font></font></div>
									<td>
										<input type='text' name='BanContent' placeholder='What the said wrong.' style='width:250px;' value='".$badcontent."'><br>									

									</td>
								</tr>
								<br />
								<tr>
								
									<td><div id='loginh2'><font size='3'><font color='#343434'>&nbsp;&nbsp;&nbsp;&nbsp;Message to User</font></font></div>
									<td>
										<input type='text' name='Message' placeholder='Optional' style='width:250px;'><br>									

									</td>
								</tr>
								<br>	
							<div id='loginh2'><font size='3'><font color='#343434'>&nbsp;&nbsp;&nbsp;&nbsp;Moderator Note</font></font></div>
									</td>
									<td><select name='BanDescription'>
									
<option value='You have violated our terms of service. Your account has been disabled.'>You have violated our terms of service. Your account has been disabled.</option>
<option value='Bribing staff members on Avatar-Universe is prohibited.'>Bribing staff members on Avatar-Universe is prohibited.</option>
<option value='Do not attempt to exploit and/or breach site boundaries.'>Do not attempt to exploit and/or breach site boundaries.</option>
<option value='Do not copy work from other users or websites.'>Do not copy work from other users or websites.</option>
<option value='Do not harass or attack other users on Avatar-Universe.'>Do not harass or attack other users on Avatar-Universe.</option>
<option value='Online dating is not allowed on Avatar-Universe.'>Online dating is not allowed on Avatar-Universe.</option>
<option value='Do not use profanity or attempt to bypass our filter.'>Do not use profanity or attempt to bypass our filter.</option>
<option value='Do not repeatedly spam on Avatar-Universe.'>Do not repeatedly spam on Avatar-Universe.</option>
<option value='We do not allow adult content on Avatar-Universe. Avatar-Universe is for kids as well as adults.'>We do not allow adult content on Avatar-Universe. Avatar-Universe is for kids as well as adults.</option>
<option value='Do not spam accounts on Avatar-Universe. Alts are allowed, but not too many!'>Do not spam accounts on Avatar-Universe. Alts are allowed, but not too many!</option>
<option value='Scamming is prohibited on Avatar-Universe.'>Scamming is prohibited on Avatar-Universe.</option>
<option value='Account trading or selling is not allowed on Avatar-Universe.'>Account trading or selling is not allowed on Avatar-Universe.</option>
<option value='Account closed for pending investigation by staff.'>Account closed for pending investigation by staff.</option>
<option value='Do not create accounts on Avatar-Universe just to break the rules.'>Do not create accounts on Avatar-Universe just to break the rules.</option>
<option value='You have repeatedly violated our terms of service. You are no longer welcome on Avatar-Universe.'>You have repeatedly violated our terms of service. You are no longer welcome on Avatar-Universe.</option>
<option value='Lag posting is strictly against the rules. Your post count has been reset.'>Lag posting is strictly against the rules. Your post count has been reset.</option>
<option value='Your account has been disabled for disrupting the economy.'>Your account has been disabled for disrupting the economy.</option>

								</select>
									</td>
	
								</tr>";
								echo"
								
							</table>
							<br /><br />
<div id='StandardBoxHeader' style='width:30%;'>Additional moderation</div><div id='StandardBox' style='width:30%;'>
						<form action='' method='post'>
						<input type='checkbox' name='ScrubName'><font size='2'><font color='#343434'><b>Delete Username</font></b></font></a>  </font><BR>
						<input type='checkbox' name='IPBan' ><font size='2'><font color='#343434'><b>IP ban for 1 week</font></b></font></a><BR>
						<input type='checkbox' name='Poison'><font size='2'><font color='#343434'><b>Disable all accounts</font></b></font></a> <BR>
			</div>
							<br /><form action='' method='POST'><input type='submit' name='BanAction' value='Ban User' class='btn'></form>
							"; echo"
							
					
					

					";
					$Unban = mysql_real_escape_string(strip_tags(stripslashes($_GET['Unban'])));
						$getUser = mysql_query("SELECT * FROM Users WHERE ID='".$ID."'");
						$gU = mysql_fetch_object($getUser);
						if ($Unban == "True") {
						mysql_query("UPDATE Users SET Ban='0' WHERE ID='".$ID."'");
						header("Location: MemberProfile.php?ID=$ID");
						exit();
						}
					
					$BanType = mysql_real_escape_string(strip_tags(stripslashes($_POST['BanType'])));
					$BanTime = mysql_real_escape_string(strip_tags(stripslashes($_POST['BanTime'])));
					$BanDescription = mysql_real_escape_string(strip_tags(stripslashes($_POST['BanDescription'])));
					$BanAction = mysql_real_escape_string(strip_tags(stripslashes($_POST['BanAction'])));
					$BanContent =  SecurePost($_POST['BanContent']);
					$Message = mysql_real_escape_string(strip_tags($_POST['Message']));
						if ($BanAction) {
						if ($BanTime == "Reminder") {
							
								$BanTime1 = time();
							
							}
							if ($BanTime == "0") {
							
								$BanTime1 = time();
							
							}
							if ($BanTime == "1") {
							
								$BanTime1 = time() + 86400;
							
							}
							if ($BanTime == "3") {
							
								$BanTime1 = time() + 86400*3;
							
							}
							if ($BanTime == "7") {
							
								$BanTime1 = time() + 86400*7;
							
							}
							if ($BanTime == "14") {
							
								$BanTime1 = time() + 86400*14;
							
							}
							if ($BanTime == "forever") {
							
								$BanTime1 = "forever";
							
							}

								$getUser = mysql_query("SELECT * FROM Users WHERE ID='".$ID."'");
								$gU = mysql_fetch_object($getUser);
							mysql_query("UPDATE Users SET Ban='1' WHERE ID='".$ID."'");

							mysql_query("UPDATE Users SET BanType='".$BanType."' WHERE ID='".$ID."'");
							mysql_query("UPDATE Users SET BanTime='".$BanTime1."' WHERE ID='".$ID."'");
							mysql_query("UPDATE Users SET BanDescription='".$BanDescription."' WHERE ID='".$ID."'");
							mysql_query("UPDATE Users SET BanLength='".$BanTime."' WHERE ID='".$ID."'");
							mysql_query("UPDATE Users SET BanContent='".$BanContent."' WHERE ID='".$ID."'");
							mysql_query("UPDATE Users SET MessageToUser='".$Message."' WHERE ID='".$ID."'");
							mysql_query("UPDATE Users SET TimeBanned='".time()."' WHERE ID='".$ID."'");
							$now = time();
                                                        $date = date("F j, Y g:iA");
if($BanTime == "forever") {
mysql_query("INSERT INTO Logs (UserID, Message, Type, Date) VALUES ('$myU->ID','Has deleted $gU->Username.','Ban','$date')");
mysql_query("INSERT INTO BanHistory (UserID, BanType, BanTime, BanDescription, BanLength, BanContent, WhoBanned)
							VALUES('".$ID."','".$BanType."','".$BanTime1."','".$BanDescription."','Account Deleted','".$BanContent."','$myU->ID')
							");
}
elseif($BanTime == "Reminder" or $BanTime == "0")  {
mysql_query("INSERT INTO Logs (UserID, Message, Type, Date) VALUES ('$myU->ID','Has Reminded/Warned $gU->Username.','Ban','$date')");
mysql_query("INSERT INTO BanHistory (UserID, BanType, BanTime, BanDescription, BanLength, BanContent, WhoBanned)
							VALUES('".$ID."','".$BanType."','".$BanTime1."','".$BanDescription."','Reminder/Warning','".$BanContent."','$myU->ID')
							");
}
else {
mysql_query("INSERT INTO Logs (UserID, Message, Type, Date) VALUES ('$myU->ID','Has banned $gU->Username for $BanTime Days.','Ban','$date')");
mysql_query("INSERT INTO BanHistory (UserID, BanType, BanTime, BanDescription, BanLength, BanContent, WhoBanned)
							VALUES('".$ID."','".$BanType."','".$BanTime1."','".$BanDescription."','Banned for ".$BanTime." days','".$BanContent."','$myU->ID')
							");
}



					

							
							
							$PoisonBan = SecurePost($_POST['Poison']);
							$ScrubName = SecurePost($_POST['ScrubName']);
							$IPBan = SecurePost($_POST['IPBan']);
if($ScrubName) {
mysql_query("INSERT INTO Logs (UserID, Message, Type, Date) VALUES ('$myU->ID','Has Scrubbed username $gU->Username.','Ban','$date')");
mysql_query("UPDATE Users SET Username='[ Moderated Content $ID ]' WHERE ID='$ID'");
}
if($IPBan) {
$Expire = Time()+604800;
mysql_query("INSERT INTO Logs (UserID, Message, Type, Date) VALUES ('$myU->ID','Has IP Banned $gU->Username.','Ban','$date')");
mysql_query("INSERT INTO IPBans (IP,Expire) VALUES ('$gU->IP,$Expire')");
}
if($PoisonBan){
mysql_query("INSERT INTO Logs (UserID, Message, Type, Date) VALUES ('$myU->ID','Has Poison Banned $gU->Username.','Ban','$date')");
mysql_query("UPDATE Users SET Ban='1' AND BanLength='forever' WHERE IP='".$gU->IP."'");

							mysql_query("UPDATE Users SET BanType='".$BanType."' WHERE IP='".$gU->IP."'");
							mysql_query("UPDATE Users SET BanTime='".$BanTime1."' WHERE IP='".$gU->IP."'");
							mysql_query("UPDATE Users SET BanDescription='".$BanDescription."' WHERE IP='".$gU->IP."'");
							mysql_query("UPDATE Users SET BanLength='".$BanTime."' WHERE IP='".$gU->IP."'");
							mysql_query("UPDATE Users SET BanContent='".$BanContent."' WHERE IP='".$gU->IP."'");
							mysql_query("UPDATE Users SET MessageToUser='".$Message."' WHERE IP='".$gU->IP."'");
							mysql_query("UPDATE Users SET TimeBanned='".time()."' WHERE IP='".$gU->IP."'");
							$now = time();
							
}

							header("Location: manage-user.aspx?ID=$ID");
							die();




}

?>