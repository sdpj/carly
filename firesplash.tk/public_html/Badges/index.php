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
			//include( $_SERVER['DOCUMENT_ROOT'] . 'EpicClubRebootMisc\HTMLS\Dashboard.html' );
			//include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/header.php' );
			echo"
			<body>";
			include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/global.php' );
			echo"        
			<center>
				<div style='height:115px;'></div> <!-- SPACE -->
					<div id='platform' style='width:1200px; border:1px solid black;background-color:#fff
					;border-radius:10px;padding:20px;'>
						<h1 style='text-align:center;'><i class='fa fa-medal'></i> Badges Area</h1>
						    <img src='https://cdn.discordapp.com/attachments/793953239208820799/805158870128787476/uniadman.png'>
                            <p><i class='fa fa-medal'></i> Administrator</p></a>
                            <text>Given to staff of Unitorium!</text><br>
                            <br>
                            <img src='https://cdn.discordapp.com/attachments/790665807033925633/805505216929464360/UNIBETA.png'>
                            <p><i class='fa fa-medal'></i> Beta</p></a>
                            <text>Given to people who joined in the beta stages of Unitorium!</text><br>
</p>
                            <br>
                            <br>
                         <a style='margin-right:5.5px;margin-left:5.5px;color:black;' href='/Dashboard/'><i class='fa fa-home'></i> Return to dashboard</a>
					</div>
				</div><br><br>
			</center>
		</div>
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
		//$siteURLQ = mysqli_query($conn,"SELECT * FROM `site_settings` WHERE `ID` = '1'");
		//$siteURL = mysqli_fetch_array($siteURLQ);
		echo"<script>window.location='../?protocal=redirect';</script>";
}
?>
