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
			
			if(isset($_POST['reply']) && isset($_POST['threadId'])){
				// see if they posted in last 45 seconds
				$lastPTQ = mysqli_query($conn, "SELECT * FROM `ec_forum_posts` WHERE `USER_ID`='$user[0]' ORDER BY `TIME` DESC LIMIT 1");
				$lastPostTime = mysqli_fetch_array($lastPTQ);
				$curtime = time();
				$last45seconds = $curtime - 15;
				if($last45seconds > $lastPostTime['TIME']){
					// let them post
					$reply = mysqli_real_escape_string($conn,strip_tags($_POST['reply']));
					$threadId = mysqli_real_escape_string($conn, $_POST['threadId']);
					$tableIdQ = mysqli_query($conn, "SELECT * FROM `ec_forum_threads` WHERE `ID`='$threadId'");
					if(mysqli_num_rows($tableIdQ) < 1){
						// bye felica # this is last minute patches
						header("Location: ../"); exit;
						exit;
					}
					$tableId = mysqli_fetch_array($tableIdQ);
					
					if($tableId['LOCKED']=='YES'){
						// goodbye
						header("Location: ../"); exit;
						exit;
						sleep(5);
					}
					
					mysqli_query($conn, "INSERT INTO `ec_forum_posts` VALUES(NULL,'$reply','$tableId[TABLE_ID]','$threadId','$user[0]','$curtime')");
					mysqli_query($conn, "UPDATE `ec_forum_threads` SET `LAST_TIME`='$curtime' WHERE `ID`='$threadId'");
					$curPosts = $user['FORUM_POSTS'];
					$newPosts = $curPosts+1;
					mysqli_query($conn, "UPDATE `ec_users` SET `FORUM_POSTS`='$newPosts' WHERE `ID`='$user[0]'");
					//echo"<script>alert('$curPosts, $user[FORUM_POSTS], $newPosts')</script>";
					// go to post
					echo"<script>window.location='thread.php?id=$threadId';</script>";
				}else{
					echo"
				<center>
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
							<form method='post' action=''>
								<textarea style='width:900px;height:150px;' name='reply' placeholder='Reply' disabled>You have posted within the last 15 seconds</textarea><br>
								<input name='threadId' hidden></input>
								<button disabled> Reply! </button>
							</form>
						</div>
					</div>
				</center>
			</body>";
			exit;
				}
			}

			if(isset($_GET['id'])){
				error_reporting(0);
				$threadId = mysqli_real_escape_string($conn, $_GET['id']);
				$ThreadEx = mysqli_query($conn, "SELECT * FROM `ec_forum_threads` WHERE `ID`='$threadId'");
				if(mysqli_num_rows($ThreadEx) < 1){
					// bye felica # this is last minute patches
					header("Location: ../"); exit;
				}
				echo"
				<center>
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
							<form method='post' action=''>
								<textarea style='width:900px;height:150px;' name='reply' placeholder='Reply'></textarea><br>
								<input name='threadId' value='$threadId' hidden></input>
								<button> Reply! </button>
							</form>
						</div>
					</div>
				</center>
			</body>";

			}else{
				header("Location: ../"); exit;
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
