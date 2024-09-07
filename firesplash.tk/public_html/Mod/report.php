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
			if(isset($_GET['id'])){
				if(is_numeric($_GET['id'])){
					$id = mysqli_real_escape_string($conn, $_GET['id']);
					if($user[0] != $id){
						// see if user is real
						$RealUser = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$id'");
						if(mysqli_num_rows($RealUser) > 0){
							// get user info
							$uInfo = mysqli_fetch_array($RealUser);

							if(isset($_POST['reason'])){
								// report them with reason, reason must more than 7 chaarcters or considered useless
								$reason = strip_tags(mysqli_real_escape_string($conn, $_POST['reason']));
								$curtime = time();
								if(strlen($reason) > 7){
									mysqli_query($conn, "INSERT INTO `ec_reports` VALUES(NULL,'$user[0]','$reason','$uInfo[0]','NO','$curtime','1','No Action','USER')");
									echo"<script>alert('Reported!')</script>";
									echo"<script>window.location='../User/?id=$uInfo[0]'</script>"; exit;
								}else{
								echo"
									<center>
										<div style='height:115px;'></div> <!-- SPACE -->
											<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
												<h1 style='text-align:left;padding-left:200px;'>Report $uInfo[1]</h1>
												<form method='post'>
												<input type='hidden' value='$uInfo[0]' name='id' maxlength='500' required>
												<textarea style='border:1px solid;width:500px;' name='reason' placeholder='Reason' required>Reason must be valid! Please add more detail!</textarea><Br>
												<button style='border-radius:0px;width:500px;'>Submit</button>
												</form>
											</div>
										</div>
									</center>
								</body>"; exit;
								}
							}else{
								echo"
									<center>
										<div style='height:115px;'></div> <!-- SPACE -->
											<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
												<h1 style='text-align:left;padding-left:200px;'>Report $uInfo[1]</h1>
												<form method='post'>
												<input type='hidden' value='$uInfo[0]' name='id' required>
												<textarea style='border:1px solid;width:500px;' name='reason' placeholder='Reason' required></textarea><Br>
												<button style='border-radius:0px;width:500px;'>Submit</button>
												</form>
											</div>
										</div>
									</center>
								</body>";
							}
						}else{
							header("Location: ../"); exit;
						}
					}else{
						header("Location: ../"); exit;
					}
				}else{
					header("Location: ../"); exit;
				}
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
