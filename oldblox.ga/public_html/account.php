<?
	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
	
	echo"<form action='' method='POST'>";

?>
	<div class='divider-right' style='width:654px;float:left;'>
		<div class='divider-bottom' style='clear:both;padding-bottom:20px;'>
			<div class='MembershipSetting'>
				<h3 style='font-weight:bold;'>
					Billing Settings
				</h3>
				<?if($myU->Premium  >= 1){
					echo"
					For billing and payment questions: <a href='mailto:info@avatar-gamer.ga'>info@avatar-gamer.ga</a><br><br>
					<div class='PremiumBar'>
						<a href='/#' class='btn-primary'>
							Extend Premium
						</a>
						&nbsp;
						<a href='/#' class='btn-primary'>
							Buy BUX
						</a>
					</div>
					";
				}
				else{
					echo"
					<div class='NonPremiumBar'>
						<h3>You do not have a Premium Membership with Avatar-Universe.</h3>
						<a href='/#' class='btn-primary'>
							Buy Premium
						</a>
						&nbsp;
						<a href='/#' class='btn-primary'>
							Buy BUX
						</a>
					</div>
					";
				}?>
				<?php echo"
			</div>
		</div>
		<div class='divider-bottom' style='clear:both;padding-bottom:20px;'>
			<div class='MembershipSetting'>
				<h3 style='font-weight:bold;'>
					Account Settings
				</h3>
				<table>
					<tr>
						<td>
							<div class='settingLabel'>
								Username:
							</div>
						</td>
						<td>
						<form action='' method='POST'>
							<a href='/user.aspx?ID=$myU->ID'>
								$myU->Username
							</a>
							&nbsp;
							
							
							<input type='submit' name='updateusername' value='Change Username' class='btn-primary' style='padding:2;font-size:14px;'>
							</form>
							
						</td>
					</tr>
					<tr>
						<td>
							<div class='account-spacer'>
							</div>
						</td>
					</tr>
					<tr> 
						<td>
							<div class='settingLabel'>
								Gender:
							</div>
						</td>
						<td>
							<form action='' method='POST'>
								<select name='UserGender' value=''>
									<option name='null' value=''>Please select...</option>
									<option name='M' value='Male'>Male</option>
									<option name='F' value='Female'>Female</option>
								</select>
							$myU->Gender
							</form>
						</td>
					</tr>
					<tr>
						<td>
							<div class='settingLabel'>
								Profile theme:
							</div>
						</td>
						<td>
							<form action='' method='POST'>
								<select name='ProfileTheme' value=''>
									<option name='1' value=''>World2Build 1.0</option>
								</select>
							</form>
						</td>
					</tr>
					<tr>
						<td>
							<div class='settingLabel'>
								Password:
							</div>
						</td>
						<td>
							<form action='' method='POST'>
								*******
								&nbsp;
								<input type='submit' name='ChangePassword' value='Change Password' class='btn-control-small'>
							</form>
						</td>
					</tr>
					<tr>
						<td>
							<div class='account-spacer'>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class='settingLabel'>
								Email:
							</div>
						</td>
						<td>
							
							<form action='' method='POST'>
							<a href='mailto:$myU->Email'>
							$myU->Email
							</a>
							<input type='submit' name='changeEmail' value='Change Email' class='btn-control-small'>
							</form>
								
						</td>
					</tr>
					<tr>
						<td>
							<div class='account-spacer'>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class='settingLabel'>
								Public Bio:
							</div>
						</td>
						<td>
							<form action='' method='POST'>
								<textarea rows='2' cols='20' name='NewBio' style='height:60px;width:490px;'>$myU->Description</textarea>
								<br />
								<font color='#666'>Do not provide any details that can be used to identify you outside of Avatar-Universe.<br>(1000 character limit)</font>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td style='text-align:right;'>
							<input type='submit' class='btn-primary' name='ConfirmSettings' value='Update Bio'>
						</td>
					</tr>
					<tr>
						<td>
							<div class='account-spacer'>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class='settingLabel'>
								Signature:
							</div>
						</td>
						<td>
							<form action='' method='POST'>
								<textarea rows='2' cols='20' name='Siggy' style='height:60px;width:490px;'>$myU->Siggy</textarea>
								<br />
								<font color='#666'>Your unique forum signature. This should contain something epic and mysterious. (200 character limit)</font>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td style='text-align:right;'>
							<input type='submit' class='btn-primary' name='ConfirmSiggy' value='Update Siggy'>
						</td></form>
					</tr></form>
				</table>
			</div>
		</div>
	</div>
	<br style='clear:both;'>
	";
	$SubmitChanges = SecurePost($_POST['ConfirmSettings']);
	$SubmitSiggy = SecurePost($_POST['ConfirmSiggy']);
	$Description = SecurePost($_POST['NewBio']);
	$Siggy = SecurePost($_POST['Siggy']);
	if($SubmitSiggy){
		$Siggy = filter($Siggy);
		$Siggy = htmlentities($Siggy);
		if(strlen($Siggy) > 200){
			header("Location: /account.aspx?sigup=f&reason=too_long");
			die();
		}else{
			mysql_query("UPDATE Users SET Siggy='".$Siggy."' WHERE ID='".$myU->ID."'");
			header("Location: /account.aspx?sigup=t");
			die();
		}
	}
	if ($SubmitChanges) {
		$Description = filter($Description); 
		$Description = htmlentities($Description);
		if (mysql_query("UPDATE Users SET Description='".$Description."' WHERE ID='".$myU->ID."'")) {
		header("Location: /account.aspx?succ=true");
		die();
		}else{
			echo"oh no!";
		}
	}
	$UpdatePassword = SecurePost($_POST['UpdatePassword']);
	$ChangePassword = SecurePost($_POST['ChangePassword']);
	$Change_Password = SecurePost($_GET['Change_Password']);
	$NewPassword = SecurePost($_POST['NewPassword']);
	$ConfirmNewPassword = SecurePost($_POST['ConfirmNewPassword']);
	$OldPassword = SecurePost($_POST['OldPassword']);
	$changeEmail = SecurePost($_POST['changeEmail']);
	if($Change_Password == "missingfields"){
		echo"
		<div class='BoxBackground'></div>
		<div class='BoxContainer'>
			<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
				<div class='Title'>
					<h2 style='margin:0;'>
						Password Update Failed
					</h2>
				</div>
				<div class='GenericModalBody'>
					<div class='TopBody' style='padding:10px;text-align:center;'>
						<div class='Message'>
							<h2 style='font-weight:normal;margin:0;'>
								You forgot some fields on your password information!
							</h2>
						</div>
					</div>
					<div class='ConfirmationContainer'>
						<center>
							<a href='/account.aspx' class='btn-forgotten'>Retry</a>
						</center>
					</div>
				</div>   
			</div>
		</div>
		";
	}
	if($ChangePassword){
		echo"
		<div class='BoxBackground'></div>
		<div class='BoxContainer'>
			<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
				<div class='Title'>
					<h2 style='margin:0;'>
						Change Account Password
					</h2>
				</div>
				<div class='GenericModalBody'>
					<div class='TopBody' style='padding:10px;text-align:center;'>
						<div class='Message'>
							<font style='font-size:13px;color:red;'>
								Do not give this information to anyone!
							</font>
							<form action='' method='POST'>
								<table align='center'>
									<tr>
										<td>
											<b>New Password:</b>
										</td>
										<td>
											<input type='password' name='NewPassword' placeholder='Your new password...'>
										</td>
									</tr>
									<tr>
										<td>
											<b>Confirm:</b>
										</td>
										<td>
											<input type='password' name='ConfirmNewPassword' placeholder='Confirm new password...'>
										</td>
									</tr>
									<tr>
										<td>
											<b>Old Password:</b>
										</td>
										<td>
											<input type='password' name='OldPassword' placeholder='Your old password...'>
										</td>
									</tr>
								</table>
						</div>
					</div>
					<div class='ConfirmationContainer'>
						<center>
							<form action=''method='POST'>
								<input type='submit' class='btn-primary' name='UpdatePassword' value='Update'>
								&nbsp;
								<a href='/account.aspx' class='btn-forgotten'>Cancel</a>
							</form>
						</center>
					</div>
				</div>   
			</div>
		</div>
		";
	}
	if($UpdatePassword){
		$_HASH = hash('sha512',$OldPassword);
		if(!$NewPassword||!$ConfirmNewPassword||!$OldPassword){
			header("Location: /account.aspx?&Change_Password=missingfields");
			die();
		}
		elseif($NewPassword != $ConfirmNewPassword){
			header("Location: /account.aspx?&Change_Password=missingfields");
			die();
		}elseif(strlen($NewPassword) < 6){
			echo"
			<div class='BoxBackground'></div>
			<div class='BoxContainer'>
				<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
					<div class='Title'>
						<h2 style='margin:0;'>
							Password Update Failed
						</h2>
					</div>
					<div class='GenericModalBody'>
						<div class='TopBody' style='padding:10px;text-align:center;'>
							<div class='Message'>
								<h2 style='font-weight:normal;margin:0;'>
									Your password is too short. Please make your password at least 6 characters.
								</h2>
							</div>
						</div>
						<div class='ConfirmationContainer'>
							<center>
								<a href='/account.aspx' class='btn-forgotten'>Retry</a>
							</center>
						</div>
					</div>   
				</div>
			</div>
			";
		}
		elseif($_HASH != $myU->Password){
			header("Location: /account.aspx?&Change_Password=missingfields");
			die();
		}else{
			$_ENCRPYT = hash('sha512',$NewPassword);
			mysql_query("UPDATE Users SET Password='$_ENCRPYT' WHERE ID='".$myU->ID."'");
			header("Location: /account.aspx?&Change_Password=success");
		}
	}
	if($changeEmail){
		echo"
		<div class='BoxBackground'></div>
		<div class='BoxContainer'>
			<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
				<div class='Title'>
					<h2 style='margin:0;'>
						Update Email Address
					</h2>
				</div>
				<div class='GenericModalBody'>
					<div class='TopBody' style='padding:10px;text-align:center;'>
						<div class='Message'>
							<font style='font-size:13px;color:red;'>
								Be sure you have access to this email address!
							</font>
							<form action='' method='POST'>
								<table align='center'>
									<tr>
										<td>
											<b>New Email:</b>
										</td>
										<td>
											<input type='text' name='NewEmail' placeholder='Your new email...'>
										</td>
									</tr>
									<tr>
										<td>
											<b>Confirm:</b>
										</td>
										<td>
											<input type='text' name='ConfirmNewEmail' placeholder='Confirm new email...'>
										</td>
									</tr>
								</table>
						</div>
					</div>
					<div class='ConfirmationContainer'>
						<center>
							<form action=''method='POST'>
								<input type='submit' class='btn-primary' name='UpdateEmail' value='Update'>
								&nbsp;
								<a href='/account.aspx' class='btn-forgotten'>Cancel</a>
							</form>
						</center>
					</div>
				</div>   
			</div>
		</div>
		";
	}
	$UpdateEmail = SecurePost($_POST['UpdateEmail']);
	$NewEmail = SecurePost($_POST['NewEmail']);
	$ConfirmNewEmail = SecurePost($_POST['ConfirmNewEmail']);
	if($UpdateEmail){
		if(!$NewEmail OR !$ConfirmNewEmail){
			echo"
			<div class='BoxBackground'></div>
			<div class='BoxContainer'>
				<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
					<div class='Title'>
						<h2 style='margin:0;'>
							Email Update Failed
						</h2>
					</div>
					<div class='GenericModalBody'>
						<div class='TopBody' style='padding:10px;text-align:center;'>
							<div class='Message'>
								<h2 style='font-weight:normal;margin:0;'>
									You forgot some fields on your email information!
								</h2>
							</div>
						</div>
						<div class='ConfirmationContainer'>
							<center>
								<a href='/account.aspx' class='btn-forgotten'>Retry</a>
							</center>
						</div>
					</div>   
				</div>
			</div>
			";
		}elseif($NewEmail != $ConfirmNewEmail){
			echo"
			<div class='BoxBackground'></div>
			<div class='BoxContainer'>
				<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
					<div class='Title'>
						<h2 style='margin:0;'>
							Email Update Failed
						</h2>
					</div>
					<div class='GenericModalBody'>
						<div class='TopBody' style='padding:10px;text-align:center;'>
							<div class='Message'>
								<h2 style='font-weight:normal;margin:0;'>
									Your emails do not match. Please try again.
								</h2>
							</div>
						</div>
						<div class='ConfirmationContainer'>
							<center>
								<a href='/account.aspx' class='btn-forgotten'>Retry</a>
							</center>
						</div>
					</div>   
				</div>
			</div>
			";
		}else{
			$NewEmail = htmlentities($NewEmail);
			mysql_query("UPDATE Users SET Email='".$NewEmail."' WHERE ID='".$myU->ID."'");
			header("Location: /account.aspx");
			die();
		}
	}
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>
