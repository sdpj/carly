<?php
	include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/connect.php' );
	if(ISSET($_COOKIE['EPICNAME']) && ISSET($_COOKIE['EPICPASS'])){
		// Confirm Credentials, if fail destroy cookies and redirect to homepage
		$username = mysqli_real_escape_string($conn,$_COOKIE['EPICNAME']);
		$password = mysqli_real_escape_string($conn,$_COOKIE['EPICPASS']);

		$accountQ = mysqli_query($conn,"SELECT * FROM `ec_users` WHERE `USERNAME`='$username' AND `PASSWORD`='$password'");
		$account = mysqli_num_rows($accountQ);
		if($account > 0){
			// Get user values
			$user = mysqli_fetch_array($accountQ);
			include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/header.php' );
			// include( $_SERVER['DOCUMENT_ROOT'] . 'EpicClubRebootMisc\HTMLS\Dashboard.html' );
			// include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/header.php' );
			echo"
			<body>";
			include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/global.php' );
			echo"
				<center>
					<style>
					textarea {
    					resize: none;
    					border:1px solid black;
					}
					</style>
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
							<h1 style='text-align:left'>$user[USERNAME] : Id$user[ID]</h1>
							<br>
							<div style='margin-bottom:12.5px;display:inline-block;text-align:left;border:1px solid;border-radius:5px;padding:10px;width:500px;'>
								<h3> Account Settings </h3>
								
								<form method='POST' action='#'>
									<text style='text-align:left;'>Your account biography</text>
									<center>
										<textarea style='width:100%;height:65px;' name='newbio' maxlength='999'>$user[BIO]</textarea><br>
										<button style='border-radius:0px;padding:2px;width:90%;' type='submit'>Submit Biography</button>";

										if(isset($_POST['newbio'])){
											$bio = mysqli_real_escape_string($conn, strip_tags($_POST['newbio']));
											mysqli_query($conn, "UPDATE `ec_users` SET `BIO`='$bio' WHERE `ID`='$user[0]'");
											echo"<br><text style='color:green;'>Bio updating!</text>";
											sleep(2.5);
											echo"<script>window.location='../Settings/';</script>";
										}
										
										echo"
									</center>
								</form>

								<form method='POST' action='#'>
									<text style='text-align:left;'>Your informal forum signature</text>
									<center>
										<textarea style='width:100%;height:20px;' maxlength='255' name='siggy' placeholder='Forum Signature'>$user[FORUM_SIG]</textarea><br>
										<button style='border-radius:0px;padding:2px;width:90%;' type='submit'>Submit Signature</button>";
										if(isset($_POST['siggy'])){
											$siggy = mysqli_real_escape_string($conn, strip_tags($_POST['siggy']));
											mysqli_query($conn, "UPDATE `ec_users` SET `FORUM_SIG`='$siggy' WHERE `ID`='$user[0]'");
											echo"<br><text style='color:green;'>Signature updating!</text>";
											sleep(2.5);
											echo"<script>window.location='../Settings/';</script>";
										}
										echo"
									</center>
								</form>
								
							</div><br>

							<div style='margin-bottom:12.5px;display:inline-block;text-align:left;border:1px solid;border-radius:5px;padding:10px;width:500px;'>
								<h3> Membership </h3>";

								// get expire date
								$hasMembership = mysqli_query($conn, "SELECT * FROM `ec_membership` WHERE `USER_ID`='$user[0]' AND `ACTIVE`='YES'");
								$membership = mysqli_fetch_array($hasMembership);
								$curtime = time();
								if($membership['END_TIME'] > $curtime){
									$expireDate = gmdate("d;m;Y;",$membership['END_TIME']);
								}

								if($user['VIP']=='NONE'){
									echo"<b> You Currently have no Membership (VIP Status) </b>";
								}else if($user['VIP']=='VIP'){
									echo"<b style='color:red;font-size:20px;'> You Currently have Basic Membership (VIP Status)<br> Expires: $expireDate </b>";
								}else if($user['VIP']=='MEGA_VIP'){
									echo"<b style='color:purple;font-size:20px;'> You Currently have MEGA Membership (VIP Status)<br> Expires: $expireDate </b>";
								}
								echo"
								
							</div><br>

							<div style='margin-bottom:12.5px;display:inline-block;text-align:left;border:1px solid;border-radius:5px;padding:10px;width:500px;'>
								<h3> Moderation </h3>
								";
								// Get all logs
								$banLogsQ = mysqli_query($conn, "SELECT * FROM `ec_ban_logs` WHERE `USER_ID`='$user[0]'");
								$banCount = mysqli_num_rows($banLogsQ);
								if($banCount > 0){
									// Fetch data
									while($ban = mysqli_fetch_array($banLogsQ)){
										$startTime = gmdate("g:ia l jS Y",$ban['START_TIME']);
										$endTimeE = $ban['START_TIME'] + $ban['LENGTH']; //end time equation
										$endTime = gmdate(" g:ia l jS Y", $endTimeE);
										
										echo"<text style='font-size:12.5px;'>You were banned $startTime for <i>\"$ban[REASON]\"</i>. This lasted until $endTime</text><br><br>";
									}
								}else{
									echo"<i>You have had no bans</i>";
								}
								echo"
							</div><br>

							<div style='display:inline-block;text-align:left;border:1px solid;border-radius:5px;padding:10px;width:500px;'>
								<h3> Power </h3>
								<button disabled>Deactivate Account</button> <button disabled>Change Name</button> <button disabled>Resend Verification</button>
							</div>
						</div>
					</div>
				</center>
			</body>";

		}else{
			setcookie('EPICPASS','',time() - 666, '/');
			setcookie('EPICNAME','',time() - 666, '/');
			header("Location: ../"); exit;
		}

	}else{
		// No cookies set, tell them to go away please
		$siteURLQ = mysqli_query($conn,"SELECT * FROM `site_settings` WHERE `ID` = '1'");
		$siteURL = mysqli_fetch_array($siteURLQ);
		echo"<script>window.location='../?protocal=redirect';</script>";
}
?>
