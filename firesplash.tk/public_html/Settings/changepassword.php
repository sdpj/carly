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
					<style>
					textarea {
    					resize: none;
    					border:1px solid black;
					}
					</style>
						<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
							<center><h1>Change password here!</h1></center>
							<h5> (You will be logged off when changing ur password, so make sure to remember it!)</h5>
							<br>
							<div style='margin-bottom:12.5px;display:inline-block;text-align:left;border:1px solid;border-radius:5px;padding:10px;width:500px;'>
								<h3> Account Settings </h3>
								
								<form method='POST' action='#'>
									<text style='text-align:left;'>Your account password</text>
									<center>
										<textarea style='width:100%;height:65px;' name='newpass' minlength='7' maxlength='250'></textarea><br>
										<button style='border-radius:0px;padding:2px;width:90%;' type='submit'>Submit Password</button>";

										if(isset($_POST['newpass'])){
											$set_password = mysqli_real_escape_string($conn,$_POST['newpass']);
											$gosted = hash('gost',$set_password);
                                            $password = hash('whirlpool',$gosted);
											mysqli_query($conn, "UPDATE `ec_users` SET `PASSWORD`='$password' WHERE `ID`='$user[0]'");
											echo"<br><text style='color:green;'>Password updating!</text>";
											sleep(2.5);
										echo"<script>window.location='../User?id=$user[ID]';</script>";
										}
										
					echo"
								";

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
