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
			<body><script>function goBack(){window.history.back();}</script>";
			include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/global.php' );
			// Supposedly all messages Read?! #later on
			if(isset($_GET['page'])){
				if(is_numeric($_GET['page'])){
					// good
					$page = mysqli_real_escape_string($conn, $_GET['page']);
					if($page == 1){
						$offset = 0; # for redirectery purposes
						//echo $offset."~~"; #<-- for debuggin
					}elseif($page < 1){
						# bye shill
						header("Location: ../"); exit;
					}
					$offset = $page * 25;
				}else{
					// bye felica
					header("Location: ../"); exit;
				}
			}else{
				$page = 1;
				$offset = 0;
			}
			echo"
				<center>
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;padding:20px;'><h5>This current system is a prototype for a bigger, cleaner revamped model. This basic model will do for now
						</h5><br><h1>New Messages</h1>";
						$newMessagesQ = mysqli_query($conn, "SELECT * FROM `ec_messages` WHERE `RECEIVE_ID`='$user[0]' AND `SEEN`='NO' ORDER BY `ID` DESC LIMIT 25");
						$newMessages = mysqli_num_rows($newMessagesQ);
						if($newMessages > 0){
							while($Messages = mysqli_fetch_array($newMessagesQ)){
								// Get other patient informatoin
								$SenderQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID` ='$Messages[SENDER_ID]'");
								$Sender = mysqli_fetch_array($SenderQ);
								$SentTime = gmdate(" g:ia l jS Y", $Messages['TIME']);
								if(strlen($Messages['TITLE']) > 9){
									$title = substr($Messages['TITLE'],0,-9);
									$title .= "...";
								}else{
									$title = $Messages['TITLE'];
								}
								// Read now
								mysqli_query($conn, "UPDATE `ec_messages` SET `SEEN`='YES' WHERE `ID`='$Messages[0]'");
								echo"
								<div style='padding:5px;border:1px solid black;margin-bottom:5px;width:750px;display:flex;flex-flow:row;'>
									<div style='display:inline-block;padding:10px;'>
										<div><a href='../User?id=$Sender[0]'>
										<img src='$Sender[AVATAR_IMG_URL]' /><br>
											<b style='font-size:25px;'>$title</b>
											<br>
											By $Sender[USERNAME]
										</a></div>
									</div>

									<div style='display:inline-block;padding:10px;width:100%;'>
										<h3>$Messages[TITLE]</h3>
										<textarea style='width:590px;height:150px;overflow:auto;'>$Messages[BODY]</textarea><br><br><text style='font-size:10px;font-weight:bold;color:grey;'>$SentTime</text><br><br>
										<a href='Reply.php?id=$Messages[0]'>Reply</a>
									</div>
								</div>";
							}

						}else{
							echo"No new messages!";
						}

						echo"	
						<h1>Old Messages</h1>
						";

						$oldMessagesQ = mysqli_query($conn, "SELECT * FROM `ec_messages` WHERE `RECEIVE_ID`='$user[0]' ORDER BY `ID` DESC LIMIT 25");
						$hasOldMessages = mysqli_num_rows($oldMessagesQ);
						$oldMessagesOff = mysqli_query($conn, "SELECT * FROM `ec_messages` WHERE `RECEIVE_ID`='$user[0]' ORDER BY `ID` DESC LIMIT 25 OFFSET $offset");
						// if messages dont appear on offset then page = wrong. if messages appear, get offset
						if(mysqli_num_rows($oldMessagesOff) > 0){
							// show offset
							$oldMessagesQ = mysqli_query($conn, "SELECT * FROM `ec_messages` WHERE `RECEIVE_ID`='$user[0]' ORDER BY `ID` DESC LIMIT 25 OFFSET $offset");
						}else{
							// show wrong page ?!??!
							echo"No messages! :( <br><text style='color:grey;font-size:10px;'>page $page</text> <br><br> 
							<a style='color:grey;font-size:20px;' class='fa fa-chevron-circle-left' onclick='goBack()'></a>
							";
							exit;
						}
						if($hasOldMessages > 0){
							while($oldMessages = mysqli_fetch_array($oldMessagesQ)){
								// Get other patient informatoin
								$SenderQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID` ='$oldMessages[SENDER_ID]'");
								$Sender = mysqli_fetch_array($SenderQ);
								$SentTime = gmdate(" g:ia l jS M", $oldMessages['TIME']);
								if(strlen($oldMessages['TITLE']) > 9){
									$oldtitle = substr($oldMessages['TITLE'],0,-9);
									$oldtitle .= "...";
								}else{
									$oldtitle = $oldMessages['TITLE'];
								}
								// Read now
								mysqli_query($conn, "UPDATE `ec_messages` SET `SEEN`='YES' WHERE `ID`='$oldMessages[0]'");
								echo"
								<div style='padding:5px;border:1px solid black;margin-bottom:5px;width:750px;display:flex;flex-flow:row;'>
									<div style='display:inline-block;padding:10px;'>
										<div><a href='../User?id=$Sender[0]'>
										<img src='$Sender[AVATAR_IMG_URL]' /><br>
											<b style='font-size:25px;'>$oldtitle</b>
											<br>
											By $Sender[USERNAME]
										</a></div>
									</div>

									<div style='display:inline-block;padding:10px;'>
										<h3>$oldMessages[TITLE]</h3>
										<textarea style='width:590px;height:150px;overflow:auto;'>$oldMessages[BODY]</textarea><br><br><text style='font-size:10px;font-weight:bold;color:grey;'>$SentTime</text><br><br>
										<a href='Reply.php?id=$oldMessages[0]'>Reply</a>
									</div>
								</div>";
							}
						}else{
							echo"No messages! :( <br><text style='color:grey;font-size:10px;'>page $page</text> <br><br> 
							<a style='color:grey;font-size:20px;' class='fa fa-chevron-circle-left' onclick='goBack()'></a>
							";
						}
						$npage = $page++; // next page
						echo"
						<a href='/Messages/?page=$npage' style='color:grey;font-size:20px;' class='fa fa-chevron-circle-right' onclick='goBack()'></a>
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
