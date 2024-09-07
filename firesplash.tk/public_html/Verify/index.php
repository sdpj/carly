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
			$curtime = time();
			$lastday = $curtime - 86400;
			$safemode = $curtime - 11122000;

			if(isset($_POST['uni_string'])){
				// check if its users
				if($user['UNI_STRING']==$_POST['uni_string']){
					mysqli_query($conn, "UPDATE `ec_users` SET `VERIFIED`='YES' WHERE `ID`='$user[0]'");
					header("Location: ?succ"); exit;
				}else{
					header("Location: ?fail"); exit;
				}
			}

			$hasSent = mysqli_query($conn, "SELECT * FROM `ec_anti_email_spam` WHERE `USER_ID`='$user[0]'");
			if(mysqli_num_rows($hasSent) > 0){
				// check if its been more than a day
				$lastEmail = mysqli_fetch_array($hasSent);
				if($lastEmail['TIME'] < $lastday){
					// send
					require '../PHPMailer-master/PHPMailerAutoload.php';
					$mail = new PHPMailer;
				    $mail->IsSMTP();  // telling the class to use SMTP
				    #$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
				    $mail->SMTPAuth   = true; // SMTP authentication
				    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
				    $mail->Host       = "smtp.gmail.com"; // SMTP server
				    $mail->Port       = 587; // SMTP Port
				    $mail->Username   = "rfoli.2k17@gmail.com"; // SMTP account username
				    $mail->Password   = "\Zxcvbnm1234567";        // SMTP account password

					$mail->setFrom('rfoli.2k17@gmail.com', 'EpicClub');
					$mail->addAddress($user['EMAIL'], $user['USERNAME']);     // Add a recipient
					$mail->isHTML(true);                                  // Set email format to HTML

					$mail->Subject = 'EpicClub Verification for '.$user['USERNAME'];
					$mail->Body    = "Your verification string is <b>".$user['UNI_STRING']."!</b>";
					#$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
					if(!$mail->send()) {
					   #echo 'Message could not be sent.';
					   echo "<script>console.log('Mailer Error:".$mail->ErrorInfo."')</script>";
					} else {
					   echo "<script>console.log('Sent!')</script>";
					}
					echo"
						<center>
							<div style='height:115px;'></div> <!-- SPACE -->
								<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
									<h1>Verification</h1>
									<text style='color:#1d1d1d;font-size:17.5px;color:green;font-weight:bold;'><text style='color:#1d1d1d;font-size:17.5px;'>This is your verification Code : <text style='color:#1d1d1d;font-size:17.5px;color:green;font-weight:bold;'>".$user['UNI_STRING']."</text><br></text><br>
									<form method='post'>
										<br><input name='uni_string' style='padding:5px;width:300px;' placeholder='Code'></input>
										<br><button style='border:1px solid grey;padding:5px:width:300px;margin-top:5px;border-radius:0px;'>Verify</button>
									</form>";
									if(isset($_GET['fail'])){
										echo"<br><text style='color:red'> Failure to verifiy!</text>";
									}elseif(isset($_GET['succ']) && $user['VERIFIED']=='YES'){ #SUCC!
										echo"<br><text style='color:green'> Success, you are verified!</text>";
									}
									echo"
								</div>
							</div>
						</center>
					</body>";
					// update
					mysqli_query($conn, "UPDATE `ec_anti_email_spam` SET `TIME`='$curtime' WHERE `USER_ID`='$user[0]'");
					exit;
				}else{
					// ask for verification
					echo"
						<center>
							<div style='height:115px;'></div> <!-- SPACE -->
								<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
									<h1>Verification</h1>
									<text style='color:#1d1d1d;font-size:17.5px;'><text style='color:#1d1d1d;font-size:17.5px;'>This is your verification Code : <text style='color:#1d1d1d;font-size:17.5px;color:green;font-weight:bold;'>".$user['UNI_STRING']."</text><br></text><br>
									<form method='post'>
										<br><input name='uni_string' style='padding:5px;width:300px;' placeholder='Code'></input>
										<br><button style='border:1px solid grey;padding:5px:width:300px;margin-top:5px;border-radius:0px;'>Verify</button>
									</form>";
									if(isset($_GET['fail'])){
										echo"<br><text style='color:red'> Failure to verifiy!</text>";
									}elseif(isset($_GET['succ']) && $user['VERIFIED']=='YES'){ #SUCC!
										echo"<br><text style='color:green'> Success, you are verified!</text>";
									}
									echo"
								</div>
							</div>
						</center>
					</body>";
				}
			}else{
				mysqli_query($conn, "INSERT INTO `ec_anti_email_spam` VALUES(NULL, '$user[0]','$safemode')"); # because it must be -24hr check and refresh
				header("Location: ../Verify"); exit;
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
