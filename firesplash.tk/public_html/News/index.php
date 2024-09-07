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
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
							<h1>Upcoming Updates and News</h1>
							<text>• EpicClub is back!<text> <br>
							<text>• Getting items for free glitch fixed<text> <br>
							<text>• Verification system on website<text> <br>
							<text>• New items added<text> <br><br><br>
							<text>• Forum Signature fixed is now fixed and is not incorporated with the user forum post<text> <br><br><br>
							<text>• UPCOMING UPDATE : The CSS will change soon.<text> <br><br><br>
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
