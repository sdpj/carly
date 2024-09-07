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
							<h1 style='font-align:left'>Donate to support EC!</h1>
							<h4>All donations over the minimal required amount come with membership and items*</h4>
							<a href='http://paypal.me/RFoli'>
								<img style='margin-right:20px;' src='../EpicClubRebootMisc/IMGS/1monthvip.png'></img>
							</a>
							
							<a href='http://paypal.me/RFoli'>
								<img style='margin-left:20px;' src='../EpicClubRebootMisc/IMGS/1monthmegavip.png'></img>
								<img src='../EpicClubRebootMisc/IMGS/megacombo.png'></img>
							</a>
							<br>
							<img src='../EpicClubRebootMisc/IMGS/membership1.png'></img>
							<img src='../EpicClubRebootMisc/IMGS/membership2.png'></img>
							<img src='../EpicClubRebootMisc/IMGS/AVATARS/Z6754jm10UOjFyEy0r2z.png'></img>
							<img src='../EpicClubRebootMisc/IMGS/membership3.png'></img><br><br>
							All Purchases will gain you an extra 50 Gold!<br>
							<text style='color:grey;font-size:10px;'>*Only Mega vip gain the Mega combo items</text>
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
