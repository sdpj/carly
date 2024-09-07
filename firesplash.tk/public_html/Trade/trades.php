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
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;padding:20px;'>";

						$tradeReqQ = mysqli_query($conn, "SELECT * FROM `ec_trades` WHERE `RECEIVER_ID`='$user[0]' AND `STATUS`='PENDING'"); #trade requests query
						if(mysqli_num_rows($tradeReqQ) > 0){
							while($trade = mysqli_fetch_array($tradeReqQ)){
								$otherUserQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$trade[SENDER_ID]'");
								$otherUser = mysqli_fetch_array($otherUserQ);
								echo "<a href='view.php?id=$trade[0]'><div style='border:1px solid;padding:5px;display:inline-block;width:450px;margin-right:5px;'>
								<h3>$otherUser[USERNAME] <i style='font-size:35px;margin-left:20px;margin-right:20px;' class='fa fa-exchange'></i> $user[USERNAME]</h3>
								<text style='color:grey;'>View Trade!</text>
								</div></a>";
							}
						}else{
							echo "<i>You have no trades :(</i>";
						}

						echo"	
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
