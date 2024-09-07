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
					<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
					<h1>Welcome back! $user[USERNAME]</h1>
						<div id='AvatarSpace' style='border:1px solid black;border-radius:10px;padding:2px;width:200px;display:inline-block;'>
							<img src='$user[AVATAR_IMG_URL]' /><p>Verified?: <b>$user[VERIFIED]</b>
							<br>
							Forum Posts: <b>$user[FORUM_POSTS]</b>
							<br>
							Power: <b>$user[POWER]</b></p><br>";

							// Check if they are verified to show prompt
							if($user['VERIFIED']=='NO'){
								echo "<a href='../Verify/'><i style='font-size:15px;margin-top:5px;color:white;font-weight:bold;background-color:orange;padding:5px;border-radius:5px;' class='fa fa-exclamation-circle'> Click to Verify!</i></a>";
							}else{
								// nothing they are okay
							}
							

							echo"
						</div>
						<form method='POST' action='#'>
									<br>
										<textarea style='width:20%;height:22px;' name='newstatus' maxlength='25'>$user[STATUS]</textarea><br><button style='border-radius:0px;padding:2px;width:20%;' type='submit'><i  class='fa fa-comments-o' style='margin:0px;font-size:15px;padding:5px;margin-left:0px;display:inline-block;border-radius:5px;'> </i></button>";

										if(isset($_POST['newstatus'])){
											$status = mysqli_real_escape_string($conn, strip_tags($_POST['newstatus']));
											mysqli_query($conn, "UPDATE `ec_users` SET `STATUS`='$status' WHERE `ID`='$user[0]'");
											echo"<br><text style='color:green;'>Status updating!</text>";
											sleep(2.5);
											echo"<script>window.location='../Dashboard/';</script>";
										}
										
										echo"
								</form>
							</form>


								<div style='text-align:left;border:1px solid black;padding:20px;border-radius:5px;width:900;padding-left:10px;padding-top:7.5px;padding-bottom:10px;'>
									<h3>Ongoing Events</h3>
									";

									// Fetch News
									echo "<text style='color:grey;'>There are no events right now ;c </text>";

									echo"
								</div>
								<br>
									<div style='text-align:left;border:1px solid black;padding:20px;border-radius:5px;width:900;padding-left:10px;padding-top:7.5px;padding-bottom:10px;'>
									<h3>Recent News</h3>
									";

									// Fetch News
									echo "<text style='color:black;'>- Enhanced the Dashboard</text>
									<br>
									<text style='color:black;'>- Upgraded the landing page!</text>";
									
									echo"
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
