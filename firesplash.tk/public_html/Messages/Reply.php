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

			if(isset($_POST['replyTxt']) && isset($_POST['MessID'])){
				// check if MessID.Sender.Id = User.Id
				$MessID = mysqli_real_escape_string($conn, $_POST['MessID']);
				$replyTxt = mysqli_real_escape_string($conn, $_POST['replyTxt']);
				$MessageQ = mysqli_query($conn, "SELECT * FROM `ec_messages` WHERE `ID`='$MessID'"); 
				$Message = mysqli_fetch_array($MessageQ);
				if($Message['RECEIVE_ID']==$user['ID']){
					// proceed
					// check if they posted in last 15 seconds
					$curtime = time();
					$last15seconds = $curtime - 15;
					$Mtime = $Message['TIME'];
					if($Mtime < $last15seconds){
						// i would check if strlen > 0 for the message, but if they want to make an empty reply to their partner, thats their problem. 
						// not allowed on the PUBLIC forums tho
						// let them post ! not until we check if they posting to themselves ;) 
						
						if($Message['RECEIVE_ID'] && $Message['SENDER_ID']==$user['ID']){
							// sendin to themselves
							echo"<script>window.location='../Messages/';</script>";
							exit;
						}else{
							// Post
							$PAST_TEXT = $Message['PAST_TEXT']; 
							#$replyTxt .= "- $user[USERNAME]"; // WIP
							$PAST_TEXT .= $replyTxt;
							$oldTitle = $Message['TITLE'];
							$newTitle = "R:".$oldTitle;
							mysqli_query($conn, "INSERT INTO `ec_messages` VALUES(NULL,'$user[0]','$Message[SENDER_ID]','$newTitle','$PAST_TEXT','$PAST_TEXT','$curtime','NO')");
							echo"<script>
							alert('Sent!');
							window.location='../Messages/';
							</script>";
						}
						

						exit;
					}else{
						echo"
							<center>
								<div style='height:115px;'></div> <!-- SPACE -->
									<div id='platform' style='width:700px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
										<form action='' method='post'>
											<textarea style='width:500px;height:200px;' name='replyTxt' placeholder='Message to reply' requried disabled>
											You have posted within the last 15 seconds
										</form>
									</div>
								</div>
							</center>
						</body>";
					}
				}else{
					// bye felica
					echo"<script>window.location='../Messages/';</script>";
					exit;
				}
			}else{
				// Show nothing
			}

			if(isset($_GET['id'])){
				// get information!
				$MessageId = mysqli_real_escape_string($conn, $_GET['id']);
				$MessageExists = mysqli_query($conn, "SELECT `RECEIVE_ID` FROM `ec_messages` WHERE `ID`='$MessageId'");
				if(mysqli_num_rows($MessageExists) > 0){
					// check if message belong to them
					$RecieverId = mysqli_fetch_array($MessageExists);
					if($user['ID'] == $RecieverId['RECEIVE_ID']){
						// good to reply
						$MessageQ = mysqli_query($conn,"SELECT * FROM `ec_messages` WHERE `ID`='$MessageId'");
						$Message = mysqli_fetch_array($MessageQ);
						$SenderQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$Message[SENDER_ID]'"); 
						$Sender = mysqli_fetch_array($SenderQ);
						$PAST_TEXT = $Message['PAST_TEXT'];
						
						if(strlen($PAST_TEXT)==0){
							$newPT = $Message['BODY'];
						}else{
							$newPT = $Message['PAST_TEXT']; 
						}
						
						$SentTime = gmdate(" g:ia l jS M", $Message['TIME']);
						echo"
							<center>
								<div style='height:115px;'></div> <!-- SPACE -->
									<div id='platform' style='width:700px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
										<form action='' method='post'>
											<textarea style='width:500px;height:200px;' name='replyTxt' placeholder='Message to reply' requried>
												

												^^^^^^^^^^^^^^^^^
												$SentTime
												$newPT
											</textarea><Br>
											<input name='MessID' value='$Message[ID]' hidden>
											<button style='padding:2.5px;'> Reply! </button>
										</form>
									</div>
								</div>
							</center>
						</body>";
					}else{
						// bye felica
						echo"<script>window.location='../Messages/';</script>";
						exit;
					}
				}else{
					// bye felica
					echo"<script>window.location='../Messages/';</script>";
					exit;
				}
			}else{
				// bye felica
				echo"<script>window.location='../Messages/';</script>";
				exit;
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
