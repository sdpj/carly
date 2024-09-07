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
			
			if($user['POWER']!='CO-FOUNDER' && $user['USERNAME']!='Unitorium'){ // only founders, low sec checks :) 
				echo"<script>window.location='../'</script>";
				exit;
			}
			
			$curtime = time();
			
			if(isset($_POST['giftid'])){
				$gift_id = $_POST['giftid'];
				$item_id = $_POST['itemid'];
				$ownersQ = mysqli_query($conn, "SELECT * FROM `ec_crate` WHERE `ITEM_ID`='$gift_id'");
				while($owners = mysqli_fetch_array($ownersQ)){
					mysqli_query($conn, "INSERT INTO `ec_crate` VALUES(NULL,'$item_id','$owners[USER_ID]','0')");
				}
				mysqli_query($conn, "INSERT INTO `ec_mod_logs` VALUES(NULL, '$user[0]','$user[0]','Open Gift #$item_id','$curtime')");
				echo "Success! - Redirecting";
				sleep(1);
				echo"<script>window.location='../Catalog/item?id=$item_id'</script>";	
				exit;
			}else{	
				echo"
					<center>
						<div style='height:115px;'></div> <!-- SPACE -->
							<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
								<form method='post'>
								Gift ID <input name='giftid'><Br>
								Item ID <input placeholder='(Inside gift)' name='itemid'><br> 
								<button>Open gift</button>
								</form>
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
