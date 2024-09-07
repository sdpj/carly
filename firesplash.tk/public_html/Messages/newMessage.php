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
			//anti shill functions
			if(isset($_GET['id'])){
				if(is_numeric($_GET['id'])){
					// good to go
					if($_GET['id']==$user['ID']){
						// shill
						// bye felcia
						echo"<script>window.location='../User/?id=$user[0]';</script>";
					}
				}else{
					// bye felcia
				header("Location: ../"); exit;
				}
			}else{
				// bye felcia
				header("Location: ../"); exit;
			}
			

			// Good to go? got it
			if(isset($_POST['title']) && isset($_POST['body'])){
				// just send erm. screw it.
				$id = mysqli_real_escape_string($conn,$_GET['id']);
				$title = strip_tags(mysqli_real_escape_string($conn,$_POST['title']));
				$title = substr($title, 0, 30);
				$body = strip_tags(mysqli_real_escape_string($conn,$_POST['body']));
				$body = substr($body, 0, 2000);
				$curtime = time();
				// good enough. send
				mysqli_query($conn, "INSERT INTO `ec_messages` VALUES(NULL, '$user[0]','$id','$title','$body','','$curtime','NO')");
				echo"<script>alert('Sent!')</script>";
				echo"<script>window.location='../User/?id=$id';</script>";
			}


			// see if they have posted in last min
			$curtime = time();
			$last1min = $curtime - 60;
			$lastPMq = mysqli_query($conn, "SELECT * FROM `ec_messages` WHERE `SENDER_ID`='$user[0]' ORDER BY `ID` DESC LIMIT 1");
			$lastPM = mysqli_fetch_array($lastPMq);
			if($last1min > $lastPM['TIME']){
				//proceed
				echo"
					<center>
						<div style='height:115px;'></div> <!-- SPACE -->
							<div id='platform' style='width:900px; border:1px solid black;background-color:white;padding:20px;'>
								<form method='post' action=''>
								<input style='width:900px;padding:5px;margin-bottom:5px;' name='title' placeholder='Title' maxnlength='30' required></input><br>
								<textarea name='body' style='width:900px;height:300px;' placeholder='Body' required></textarea>
								<button> Send Message! </button>
							</div>
						</div>
					</center>
				</body>";
			}else{
			echo"
				<center>
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:900px; border:1px solid black;background-color:white;padding:20px;'>
							<form method='post' action=''>
							<input style='width:900px;padding:5px;margin-bottom:5px;' name='title' placeholder='Title' maxnlength='30' required disabled></input><br>
							<textarea name='body' style='width:900px;height:300px;' placeholder='Body' required disabled>You have sent a message within the last minute</textarea>
							<button disabled> Send Message! </button>
						</div>
					</div>
				</center>
			</body>";
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
