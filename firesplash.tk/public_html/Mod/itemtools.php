<?php
    //from ubooly rewritten made by matt/mario from epicclub
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

			if($user['POWER']=='MEMBER'){
				header("Location: ../"); exit;
			}

			if(isset($_GET['CensorComment'])){
				$id = mysqli_real_escape_string($conn, $_GET['CensorComment']);
				// see if thread is real
				$RealPost = mysqli_query($conn, "SELECT * FROM `ec_item_comments` WHERE `ID`='$id'");
				if(mysqli_num_rows($RealPost) > 0){
					// do what get says
					$threadIdPre = mysqli_fetch_array($RealPost);
					$threadId = $threadIdPre['THREAD_ID'];
					mysqli_query($conn, "UPDATE `ec_item_comments` SET `COMMENT`='[Censored Comment]' WHERE `ID`='$id'");
					echo"<script>window.location='../Emporium/'</script>";
				}else{
					echo"<script>window.location='../'</script>"; exit;
					//header("Location: ../"); exit;
				}
			}elseif(isset($_GET['nothing'])){
				
				}else{
					//header("Location: ../"); exit;
					echo"<script>window.location='../'</script>"; exit;
				}
			echo"
				<center>
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
							MARIO WAS HERE
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
