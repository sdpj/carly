<?
	include($_SERVER['DOCUMENT_ROOT'].'/auth.admin/admin-header.php');
	$ID = mysql_real_escape_string(strip_tags(stripslashes($_GET['ID'])));
	$getUser= mysql_query("SELECT * FROM Users WHERE ID='".$ID."'");
	$gU = mysql_fetch_object($getUser);
	$date = date("F j, Y g:iA");
	if($myU->PowerAdmin != "true" OR $myU->PowerMegaModerator !="true"){
		header("Location: /Error/?code=404");
		die();
	}
	?>

	<div id='StandardBoxHeader'>
		Managing <?echo"".$gU->Username."";?>'s Account 
	</div>
	<form action='' method='POST'>
		<div id='StandardBox'>
			<div align='left'>
				<div id='admintopbar'>
					<div class='divider-right' style='width:484px;float:left;'> 
						<div class='divider-bottom' style='position: relative;z-index:3;padding-bottom: 20px'>
							<h3 style='padding:0;margin:2;'><?echo"".$gU->Username."";?></h3>
						<?php if($gU->Ban == 1){
							if($gU->BanLength == "forever") {
								echo"
							
							
							<font color='red'><b>This account is permanently disabled.</b></font>";
							}
							elseif($gU->BanLength == "Reminder" or $gU->BanLength == "0") {
							echo"<font color='red'><b>This account is temporarily disabled.</b></font>";
						}
						else {
							echo"<font color='red'><b>This account is disabled for $gU->BanLength days.</b></font>";
						}}
						
						
						?>
							<table cellspacing='0' cellpadding='0'>
								<tr>
									<td style='text-align:center;'>
										<img src='/Avatar.aspx?ID=<?echo"".$gU->ID."";?>'>
									</td>
									<td style='text-align:left;'>
										&nbsp;&nbsp;&nbsp;
									</td>
									<td style='text-align:left;'>
										<table cellspacing='0' cellpadding='0'>
											<tr>
												<td style='text-align:right;'>
													<b>Original Email:</b>
												</td>
												<td>
													&nbsp;
												</td>
												<td>
													<?echo"".$gU->Email."";?>
												</td>
											</tr>
											<tr>
												<td style='text-align:right;'>
													<b>Current Email:</b>
												</td>
												<td>
													&nbsp;
												</td>
												<td>
													<?echo"".$gU->Email."";?>
												</td>
											</tr>
											<tr>
												<td style='text-align:right;color:darkgreen;'>
													<b>BUX (amount):</b>
												</td>
												<td>
													&nbsp;
												</td>
												<td style='color:darkgreen;'>
													<?echo"".$gU->Bux."";?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</div>
						<div class='divider-bottom' style='position: relative;z-index:3;border:0;padding-bottom: 20px;text-align:center;'>
							<h4>Moderation Actions for this User</h4>
								<input type='Submit' name='IPBan' class='btn-forgotten' value='IP Ban'>
								<input type='Submit' name='Ban' class='btn-forgotten' value='Ban'>
								<input type='Submit' name='PurgePosts' class='btn-forgotten' value='Purge Posts'>
								<input type='Submit' name='DeleteUsername' class='btn-forgotten' value='Delete Username'>
						</div>
					</div>
					<div class='divider-right' style='width:484px;border:0;float:left;padding-left:10px;'> 
						<center><h4>Update Password</h4></center>
						<form action='' method='POST'>
							<table cellspacing='0' cellpadding='0'>
								<tr>
									<td style='text-align:right;width:150px;'>
										New Password:
									</td>
									<td>
										&nbsp;
									</td>
									<td>
										<input type='password' name='NewPassword' placeholder='New Password' style='width:250px;'>
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
								</tr>
								<tr>
									<td style='text-align:right;width:150px;'>
										Confirm Password:
									</td>
									<td>
										&nbsp;
									</td>
									<td>
										<input type='password' name='ConfirmNewPassword' placeholder='Confirm Password' style='width:250px;'>
									</td>
								</tr>
								<tr>
									<td>
										&nbsp;
									</td>
								</tr>
								<tr>
									<td style='text-align:right;width:150px;'>
										&nbsp;
									</td>
									<td>
										&nbsp;
									</td>
									<td style='text-align:right;'>
										<input type='submit' name='SubmitPassword' value='Update'>
									</td>
								</tr>
							</table>
						</form>
						<center><h4>Update Email</h4></center>
						<form action='' method='POST'>
							<table cellspacing='0' cellpadding='0'>
								<tr>
									<td style='text-align:right;width:150px;'>
										New Email:
									</td>
									<td>
										&nbsp;
									</td>
									<td>
										<input type='text' name='NewEmail' placeholder='New Email' style='width:250px;'>
									</td>
								</tr>
							</table>
						</form>
						<center><h4>Update Pin Code</h4></center>
						<form action='' method='POST'>
							<table cellspacing='0' cellpadding='0'>
								<tr>
									<td style='text-align:right;width:150px;'>
										New Pin Code:
									</td>
									<td>
										&nbsp;
									</td>
									<td>
										<input type='text' name='NewPinCode' placeholder='New Pin Code' style='width:250px;'>
									</td>
								</tr>
							</table>
						</form>
					</div>
					<div class='divider-bottom' style='float:left;width:100%'></div>
					<br style='clear:both;'>
					<h3>Moderation History</h3>
					<?
					$getModerationHistory = mysql_query("SELECT * FROM BanHistory WHERE UserID='$ID' ORDER BY ID DESC");
$numModeration = mysql_num_rows($getModerationHistory);
if($numModeration == 0) {
echo"This user has no moderation record.";
}
else {
echo"<table width='2000px'>
<tr>
<td width='240px'><b>Length</b></td>
<td width='240px'><b>Moderator Note</b></td>
<td width='240px'><b>Offensive Content</b></td>
<td width='240px'><b>Time Expired</b></td>
<td width='240px'><b>Moderator</b></td>
</tr>
</table>";
}
while($gM = mysql_fetch_object($getModerationHistory)) {
$timeBanned = date("M j, Y",$gM->BanTime);
$getModerator = mysql_query("SELECT * FROM Users WHERE ID='$gM->WhoBanned'");
$gMM = mysql_fetch_object($getModerator);
echo"<table width='2000px'>
<tr>
<td width='240px'>$gM->BanLength</td>
<td width='240px'>$gM->BanDescription</td>
<td width='240px'>";if(!$gM->BanContent) {echo"No offensive Content";} else{echo"&quot;$gM->BanContent&quot;";} echo"</td>
<td width='240px'>$timeBanned</td>
<td width='240px'>$gMM->Username</td>
</tr>
</table>";
}?>
				</div>
			</div>
		</div>
	</form>
<?
	$IPBan = SecurePost($_POST['IPBan']);
	$Ban = SecurePost($_POST['Ban']);
	$NewPassword = SecurePost($_POST['NewPassword']);
	$ConfirmNewPassword = SecurePost($_POST['ConfirmNewPassword']);
	$SubmitPassword = SecurePost($_POST['SubmitPassword']);
	if($SubmitPassword){
		if($ID == 1 OR $ID == 9){
			mysql_query("INSERT INTO Logs (UserID, Message, Type, Date) VALUES ('$myU->ID',' has tried to change $gU->Username\'s password (system administrator)','Password','$date')");
			echo"
			<div class='BoxBackground'></div>
			<div class='BoxContainer'>
				<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
					<div class='Title'>
						<h2 style='margin:0;'>
						Moderation Action Failed
						</h2>
					</div>
					<div class='GenericModalBody'>
						<div class='TopBody' style='padding:10px;text-align:center;'>
							<div class='Message'>
								<h2 style='font-weight:normal;margin:0;'>
									An error occurred when completing this moderation action.
								</h2>
								<img src='/auth.admin/img/Oops.png' height='64'>
							</div>
						</div>
						<div class='ConfirmationContainer'>
							<center>
								<a href='/auth.admin/manage-user.aspx?ID=".$ID."' class='btn-forgotten'>Cancel</a>
							</center>
						</div>
					</div>   
				</div>
			</div>
			";
		}else{
			if ($ConfirmNewPassword != $NewPassword){
				echo"
				<div class='BoxBackground'></div>
				<div class='BoxContainer'>
					<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
						<div class='Title'>
							<h2 style='margin:0;'>
							Moderation Action Failed
							</h2>
						</div>
						<div class='GenericModalBody'>
							<div class='TopBody' style='padding:10px;text-align:center;'>
								<div class='Message'>
									<h2 style='font-weight:normal;margin:0;'>
										Please make sure the new password and new confirm password match.
									</h2>
									<img src='/auth.admin/img/Oops.png' height='64'>
								</div>
							</div>
							<div class='ConfirmationContainer'>
								<center>
									<a href='/auth.admin/manage-user.aspx?ID=".$ID."' class='btn-forgotten'>Cancel</a>
								</center>
							</div>
						</div>   
					</div>
				</div>
				";
			}else{
				$_ENCRYPT = hash('sha512',$NewPassword);
				mysql_query("UPDATE Users SET Password='$_ENCRYPT' WHERE ID='".$ID."'");
				echo"
				<div class='BoxBackground'></div>
				<div class='BoxContainer'>
					<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
						<div class='Title'>
							<h2 style='margin:0;'>
							Moderation Action Completed
							</h2>
						</div>
						<div class='GenericModalBody'>
							<div class='TopBody' style='padding:10px;text-align:center;'>
								<div class='Message'>
									<h2 style='font-weight:normal;margin:0;'>
										Users password was successfully updated.
									</h2>
									<img src='/auth.admin/img/Yay.png' height='64'>
								</div>
							</div>
							<div class='ConfirmationContainer'>
								<center>
									<a href='/auth.admin/manage-user.aspx?ID=".$ID."' class='btn-forgotten'>Close</a>
								</center>
							</div>
						</div>   
					</div>
				</div>
				";
			}
		}
	}
	if($Ban){
		header("Location: /auth.admin/mod-user.aspx?ID=".$ID."");
		die();
	}
	if($IPBan){
		echo"
		<div class='BoxBackground' style='height:100%;'></div>
		<div class='BoxContainer'>
			<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
				<div class='Title'>
					<h2 style='margin:0;'>
						Please Confirm Action: IP Ban
					</h2>
				</div>
				<div class='GenericModalBody'>
					<div class='TopBody' style='padding:10px;text-align:center;'>
						<div class='Message'>
							<font style='font-size:15px;color:red;'>
								Are you sure you would like to complete this action?
							</font>
							<hr color='lightgrey' size='1'>
							<font style='font-size:14px;color:#343434;'>
								Completing this action will remove ".$gU->Username."'s rights to access the website. This action can be reversed. 
								<br>
								<br>
								This action <strong>will be logged</strong> for account ".$myU->Username." on IP address ".$myU->IP.".
							</font>							
							<form action='' method='POST'>
						</div>
					</div>
					<div class='ConfirmationContainer'>
						<center>
							<form action=''method='POST'>
								<input type='submit' class='btn-primary' name='ConfirmIPBan' value='Continue'>
								&nbsp;
								<a href='/auth.admin/manage-user.aspx?ID=".$ID."' class='btn-forgotten'>Cancel</a>
							</form>
						</center>
					</div>
				</div>   
			</div>
		</div>
		";
	}
	
	$ConfirmIPBan = SecurePost($_POST['ConfirmIPBan']);
	if($ConfirmIPBan  && $ID == 1||$ConfirmIPBan && $ID== 2){
		echo"
		<div class='BoxBackground'></div>
		<div class='BoxContainer'>
			<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
				<div class='Title'>
					<h2 style='margin:0;'>
					Moderation Action Failed
					</h2>
				</div>
				<div class='GenericModalBody'>
					<div class='TopBody' style='padding:10px;text-align:center;'>
						<div class='Message'>
							<h2 style='font-weight:normal;margin:0;'>
								An error occurred when completing this moderation action.
							</h2>
							<img src='/auth.admin/img/Oops.png' height='64'>
						</div>
					</div>
					<div class='ConfirmationContainer'>
						<center>
							<a href='/auth.admin/manage-user.aspx?ID=".$ID."' class='btn-forgotten'>Cancel</a>
						</center>
					</div>
				</div>   
			</div>
		</div>
		";
	}elseif($ConfirmIPBan && $ID != 1||$ConfirmIPBan && $ID != 2){
		echo"
		<div class='BoxBackground'></div>
		<div class='BoxContainer'>
			<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
				<div class='Title'>
					<h2 style='margin:0;'>
					Moderation Action Completed
					</h2>
				</div>
				<div class='GenericModalBody'>
					<div class='TopBody' style='padding:10px;text-align:center;'>
						<div class='Message'>
							<h2 style='font-weight:normal;margin:0;'>
								This moderation action was completed successfully. 
							</h2>
							<img src='/auth.admin/img/Yay.png' height='64'>
						</div>
					</div>
					<div class='ConfirmationContainer'>
						<center>
							<a href='/auth.admin/manage-user.aspx?ID=".$ID."' class='btn-forgotten'>Close</a>
						</center>
					</div>
				</div>   
			</div>
		</div>
		";
	}
	
	$PurgePosts = SecurePost($_POST['PurgePosts']);
	if($PurgePosts){
		mysql_query("UPDATE Threads SET Title='[ Moderated Content ]' WHERE PosterID='".$ID."'");
		mysql_query("UPDATE Threads SET Body='[ Moderated Content ]' WHERE PosterID='".$ID."'");
		mysql_query("UPDATE Replies SET Title='[ Moderated Content ]' WHERE PosterID='".$ID."'");
		mysql_query("UPDATE Replies SET Body='[ Moderated Content ]' WHERE PosterID='".$ID."'");
	}
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>