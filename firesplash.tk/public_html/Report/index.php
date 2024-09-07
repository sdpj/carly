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
			$curtime = time();
			$lastmin = $curtime - 60;
			include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/header.php' );
			// include( $_SERVER['DOCUMENT_ROOT'] . 'EpicClubRebootMisc\HTMLS\Dashboard.html' );
			// include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/header.php' );

			$lastReportQ = mysqli_query($conn, "SELECT * FROM `ec_reports` WHERE `REPORTER_ID`='$user[0]' ORDER BY TIME DESC LIMIT 1"); # stop report spammers
			$lastReport = mysqli_fetch_array($lastReportQ);
			if($lastReport['TIME'] > $lastmin){
				#bye spammer
				header("Location: ../"); exit;
			}

			echo"
			<body>";
			include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/global.php' );
			if(isset($_GET['ThreadId'])){
				if(is_numeric($_GET['ThreadId'])){
					// see if thread is real
					$threadId = mysqli_real_escape_string($conn, $_GET['ThreadId']);
					$realThread = mysqli_query($conn, "SELECT * FROM `ec_forum_threads` WHERE `ID`='$threadId'");
					if(mysqli_num_rows($realThread) > 0){
						$threadInfo = mysqli_fetch_array($realThread);
						mysqli_query($conn, "INSERT INTO `ec_reports` VALUES(NULL,'$user[0]','inappropriate content','Thread ID $threadId','NO','$curtime','1','No Action','FORUM')");
						echo"<script>alert('Reported!')</script>";
						echo"<script>window.location='../Forums/thread.php?id=$threadId'</script>";
						exit;
					}else{
						header("Location: ../"); exit;
					}
				}else{
					// isset but not numeric. possible sql injection attempt
					header("Location: ../"); exit;
				}
			}

			if(isset($_GET['PostId'])){
				if(is_numeric($_GET['PostId'])){
					// see if thread is real
					$postId = mysqli_real_escape_string($conn, $_GET['PostId']);
					$realThread = mysqli_query($conn, "SELECT * FROM `ec_forum_posts` WHERE `ID`='$postId'");
					if(mysqli_num_rows($realThread) > 0){
						$threadInfo = mysqli_fetch_array($realThread);
						$usernameQ = mysqli_query($conn, "SELECT `USERNAME` FROM `ec_users` WHERE `ID`='$threadInfo[USER_ID]'");
						$p_user = mysqli_fetch_array($usernameQ); #poster username
						mysqli_query($conn, "INSERT INTO `ec_reports` VALUES(NULL,'$user[0]','inappropriate content','A post by $p_user[USERNAME] on THREAD ID $threadInfo[THREAD_ID]','NO','$curtime','1','No Action','FORUM')");
						echo"<script>alert('Reported!')</script>";
						echo"<script>window.location='../Forums/thread.php?id=$threadInfo[THREAD_ID]'</script>";
						exit;
					}else{
						header("Location: ../"); exit;
					}
				}else{
					// isset but not numeric. possible sql injection attempt
					header("Location: ../"); exit;
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
