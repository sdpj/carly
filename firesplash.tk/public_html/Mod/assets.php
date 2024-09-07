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
			
			if($user['POWER']=='MEMBER' || $user['POWER']=='MODERATOR'){
				echo "<script>window.location='../'</script>"; exit;
			}
			
			$curtime = time();
			
			if(isset($_GET['d'])){
				
				$id = mysqli_real_escape_string($conn, $_GET['d']);
				if(!is_numeric($id)){
					echo "<script>window.location='../'</script>"; exit;
				}
				
				$assetQ = mysqli_query($conn, "SELECT * FROM `ec_user_assets` WHERE `ID`='$id'");
				$asset = mysqli_fetch_array($assetQ);
				$creatorQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$asset[CREATOR_ID]'");
				$creator = mysqli_fetch_array($creatorQ);
				
				// delete row				
				mysqli_query($conn, "INSERT INTO `ec_messages` VALUES(NULL, '$user[0]','$creator[0]','Asset Declined','This is an Automated Message, $asset[NAME] has been declined!','','$curtime','NO')");
				mysqli_query($conn, "DELETE FROM `ec_user_assets` WHERE `ID`='$id'");
				echo "<script>window.location='../Mod/assets'</script>"; exit;
			}
			
			if(isset($_GET['a'])){
				$id = mysqli_real_escape_string($conn, $_GET['a']);
				if(!is_numeric($id)){
					echo "<script>window.location='../'</script>"; exit;
				}
				
				$assetQ = mysqli_query($conn, "SELECT * FROM `ec_user_assets` WHERE `ID`='$id'");
				$asset = mysqli_fetch_array($assetQ);
				$creatorQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$asset[CREATOR_ID]'");
				$creator = mysqli_fetch_array($creatorQ);
				mysqli_query($conn, "INSERT INTO `ec_messages` VALUES(NULL, '$user[0]','$creator[0]','Asset Accepted!','This is an Automated Message, $asset[NAME] has been accepted!','','$curtime','NO')");
				//echo"<script>alert('$asset[TYPE]')</script>";
				// upload
				if($asset['TYPE']!='SHIRT' && $asset['TYPE']!='TROU'){
					$type2 = "TROU";
				}else{
					$type2 = $asset['TYPE'];
				}
				//echo"<script>alert('$test')</script>";
				mysqli_query($conn, "INSERT INTO `ec_items` VALUES(NULL,'$asset[NAME]', '$asset[DESCRIPTION]','0','$asset[SILVER_PRICE]','NO','$asset[AVATAR_IMG]','$asset[AVATAR_IMG]','NO','-1','-1','0','$asset[TIME_UPLOADED]','$type2')");
				
				// get and put in their crate.
				$assetIdQ = mysqli_query($conn, "SELECT * FROM `ec_items` WHERE 1 ORDER BY `ID` DESC LIMIT 1");
				$assetId = mysqli_fetch_array($assetIdQ);
				mysqli_query($conn, "INSERT INTO `ec_crate` VALUES(NULL,'$assetId[ID]','$creator[ID]','0')");
				// remove pending
				mysqli_query($conn, "UPDATE `ec_user_assets` SET `STATUS`='ACCEPTED' WHERE `ID`='$id'"); // add logs or change to delete
				echo"<script>alert('Accepted!')</script>";
				mysqli_query($conn, "INSERT INTO `ec_mod_logs` VALUES(NULL, '$user[0]','$user[0]',' Accepted <B>$asset[NAME]</b> ','$curtime')");
				echo"<script>window.location='../Catalog/?type=$asset[TYPE]'</script>"; exit;
			}
			
			echo"
				<center>
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
							<h2>Moderate Assets</h2>";
							
							// get assets
							$AssetsQ = mysqli_query($conn, "SELECT * FROM `ec_user_assets` WHERE `STATUS`='PENDING' LIMIT 50");
							if(mysqli_num_rows($AssetsQ) > 0){
								while($Asset = mysqli_fetch_array($AssetsQ)){
									$CreatorQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$Asset[CREATOR_ID]'");
									$Creator = mysqli_fetch_array($CreatorQ);
									echo"
									<div style='width:850px;border:1px solid grey;display:flex;flex-wrap:wrap;margin-bottom:20px;'>
										<img src='$Asset[AVATAR_IMG]'>
										<div style='text-align:left;width:350px;'>
											<b>Name:</b> $Asset[NAME]<Br>
											<b>Desc:</b> $Asset[DESCRIPTION]<Br><br>
											
											Type: $Asset[TYPE]<br>
											Price: $Asset[SILVER_PRICE]<br>
											Creator: <a style='color:blue;' href='../User/?id=$Creator[0]'>$Creator[USERNAME]</a>
											
										</div>
										<div style='padding-left:225px;padding-top:25px;'>
											<a href='assets?a=$Asset[ID]' style='width:50px;padding:2.5px;border:1px solid green;color:green;'>Accept</a>
											- 
											<a href='assets?d=$Asset[ID]' style='width:50px;padding:2.5px;border:1px solid red;color:red;'>Decline</a>
										</div>
									</div>
									";
								}
							}else{
								echo"Nothing to moderate!";
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
