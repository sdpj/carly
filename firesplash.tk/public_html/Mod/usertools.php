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
			$curtime = time();
			// include( $_SERVER['DOCUMENT_ROOT'] . 'EpicClubRebootMisc\HTMLS\Dashboard.html' );
			// include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/header.php' );

			if($user['POWER']=='MEMBER'){
				header("Location: ../"); exit;
			}

			if(!isset($_GET['avatar']) && !isset($_GET['RevokeUsername']) && !isset($_GET['ban'])){
				header("Location: ../"); exit;
			}

			echo"
			<body>";
			include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/global.php' );
			if(isset($_GET['avatar'])){
				// anti shill, even for mods
				$id = mysqli_real_escape_string($conn, $_GET['avatar']);
				// if exists
				$userExists = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$id'");
				if(mysqli_num_rows($userExists) > 0){
					$otherUser = mysqli_fetch_array($userExists);
					if($otherUser['POWER']!='MEMBER'){
					}else if($otheruser['POWER']!='MOD'){
						}else if($otheruser['POWER']!='ADMIN'){
							}else if($otheruser['POWER']!='CO-FOUNDER'){
						header("Location: ../"); exit;
					}

					// reset avatar.
					mysqli_query($conn, "UPDATE `ec_users` SET `AVATAR_IMG_URL`='/EpicClubRebootMisc/IMGS/template.png' WHERE `ID`='$id'");
					mysqli_query($conn, "INSERT INTO `ec_mod_logs` VALUES(NULL, '$user[0]','$id','Reset Avatar','$curtime')");
					#echo"<script>alert('Resetted!')</script>";
					//header("Location: ../User/?id=$id"); exit;
					echo "<script>window.location='../User/?id=$id'</script>"; exit;
				}else{
					// cya!
					header("Location: ../"); exit;
				}
			}

			if(isset($_GET['RevokeUsername'])){
				// anti shill, even for mods
				$id = mysqli_real_escape_string($conn, $_GET['RevokeUsername']);
				// if exists
				$userExists = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$id'");
				if(mysqli_num_rows($userExists) > 0){
					// i dont know why i have uni string i can just use otheruser, o well
					$otherUser = mysqli_fetch_array($userExists);
					if($otherUser['POWER']!='MEMBER'){
						header("Location: ../"); exit;
					}

					// revoke username with unistring? or rand or registration unistring? i pick option 3 at first, but this was then buggy
					$uni_string = mysqli_fetch_array($userExists);
					$number = rand(1,999999999); # 11 characters remaining
					$newName = "User_Del_".$number;
					mysqli_query($conn, "UPDATE `ec_users` SET `USERNAME`='$newName' WHERE `ID`='$id'");
					mysqli_query($conn, "INSERT INTO `ec_mod_logs` VALUES(NULL, '$user[0]','$id','Revoked Name','$curtime')");
					#echo"<script>alert('Resetted!')</script>";
					//header("Location: ../User/?id=$id"); exit;
					echo "<script>window.location='../User/?id=$id'</script>"; exit;
				}else{
					// cya!
					header("Location: ../"); exit;
				}
			}

			if(isset($_GET['ban'])){
				$id = mysqli_real_escape_string($conn, $_GET['ban']);
				$userExists = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$id'");
				if(isset($_POST['length'])){
					if(mysqli_num_rows($userExists) > 0){ // i wouldnt normally do this, but we cant trust admins + mods aswell :X
						$otherUser = mysqli_fetch_array($userExists);
						if($otherUser['POWER']!='MEMBER'){
							header("Location: ../"); exit;
						}else{
							if(is_numeric($_POST['length'])){
								// ban
								$curtime = time();
								$length = mysqli_real_escape_string($conn, $_POST['length']);
								$bannedTill = $curtime + $length;
								if(isset($_POST['reason'])){
									$reason = strip_tags(mysqli_real_escape_string($conn, $_POST['reason']));
								}else{
									$reason = "N/A";
								}
								#echo"<script>alert('$curtime , $bannedTill')</script>";
								mysqli_query($conn, "INSERT INTO `ec_ban_logs` VALUES (NULL, '$user[0]','$id', '$length', '$reason', '$curtime')");
								mysqli_query($conn, "INSERT INTO `ec_mod_logs` VALUES(NULL, '$user[0]','$id','Banned','$curtime')");
								mysqli_query($conn, "UPDATE `ec_users` SET `BANNED`='YES' WHERE `ID`='$id'");
								header("Location: ../User/?id=$id"); exit;
							}else{
								header("Location: ../"); exit;
							}
						}						
					}else{
						header("Location: ../"); exit;
					}
				}else{
					// get user information
					if(mysqli_num_rows($userExists) > 0){
						$otherUser = mysqli_fetch_array($userExists);
						if($otherUser['POWER']!='MEMBER'){
							header("Location: ../"); exit;
						}
						
						echo"
							<center>
								<div style='height:115px;'></div> <!-- SPACE -->
									<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
										<h1 style='text-align:left;padding-left:200px;'>Ban $otherUser[USERNAME]</h1>
										<form method='post'>
											<select style='border:1px solid black;width:150px;' name='length'>
											  <option value='-1'>Warn</option>
											  <option value='10800'>3 Hours</option>
											  <option value='21600'>6 Hours</option>
											  <option value='43200'>12 Hours</option>
											  <option value='86400'>1 Day</option>
											  <option value='259200'>3 Days</option>
											  <option value='604800'>1 Week</option>
											  <option value='2629743'>1 Month</option>
											  <option value='-11122000'>Terminate!</option>
											</select><br>
											<input name='reason' placeholder='Reason for ban' />
											<button style='padding:2.5px;border-radius:0px;'>Ban!</button>
										</form>
									</div>
								</div>
							</center>
						</body>";
						exit;

					}else{
						// bye
						header("Location: ../"); exit;
					}
				}
			}


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
