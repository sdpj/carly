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
			if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']>0){
				// check if its for us
				$id = mysqli_real_escape_string($conn, $_GET['id']);
				$tradeReqQ = mysqli_query($conn, "SELECT * FROM `ec_trades` WHERE `RECEIVER_ID`='$user[0]' AND `ID`='$id'"); #trade requests query
				if(mysqli_num_rows($tradeReqQ) > 0){
					$trade = mysqli_fetch_array($tradeReqQ);
					$SenderTCIds = array();# our trade cart Ids
					$UsTCIds = array();# their trade cart Ids
					$otherUserQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$trade[SENDER_ID]'");
					$otherUser = mysqli_fetch_array($otherUserQ);

					$tradeCartArray = str_split($trade['TRADE_INFO']);
					$switch = 0;
					$temp = "";
					for($i = 0; $i < count($tradeCartArray); $i++){
						if($tradeCartArray[$i]=='.'){
							if($switch>0){
								array_push($UsTCIds, $temp);
								$temp = "";
							}else{
								array_push($SenderTCIds, $temp);
								$temp = "";
							}
						}elseif($tradeCartArray[$i]=='|'){
							$switch++;
						}else{
							$temp.=$tradeCartArray[$i];
						}
					}

					if(isset($_GET['decline'])){
						$tradeId = mysqli_real_escape_string($conn, $_GET['decline']);
						// change status to decline
						mysqli_query($conn, "UPDATE `ec_trades` SET `STATUS`='DECLINED' WHERE `ID`='$id' AND `RECEIVER_ID`='$user[0]'");
						echo"<script>alert('Trade Declined!')</script>";
						mysqli_query($conn, "INSERT INTO `ec_messages` VALUES(NULL, '1','$trade[SENDER_ID]','$user[USERNAME] Has Declined Your Trade!','$user[USERNAME] Has Declined Your Trade!','','$curtime','NO')");
						echo"<script>window.location='../Trade/trades.php'</script>"; exit;
					}

					// finally, accept mech. keep it simple >.<
					if(isset($_GET['accept'])){
						$tradeId = mysqli_real_escape_string($conn, $_GET['accept']);
						// check if we have enough money.
						if($user['GOLD']<$trade['MONEY_REQUEST']){
							echo"<script>alert('You dont have enough money!')</script>";
							echo"<script>window.location='../Trade/trades.php'</script>"; exit;
						}

						// check if they have enough money
						if($otherUser['GOLD']<$trade['MONEY_SENDING']){
							// delete trade
							echo"<script>alert('The Sender Does not have the required amount of Gold!')</script>";
							mysqli_query($conn, "UPDATE `ec_trades` SET `STATUS`='DECLINED' WHERE `ID`='$id' AND `RECEIVER_ID`='$user[0]'");
							echo"<script>alert('Trade Declined!')</script>";
							echo"<script>window.location='../Trade/trades.php'</script>"; exit;
						}
						
						// check if we still have items
						foreach ($UsTCIds as $crateId) {
							$cratesQ = mysqli_query($conn, "SELECT * FROM `ec_crate` WHERE `ID`='$crateId' AND `USER_ID`='$user[0]'");

								if(mysqli_num_rows($cratesQ) < 1){
								// get rid of trade. bad trade
								echo"<script>alert('You do not have some items')</script>";
								mysqli_query($conn, "UPDATE `ec_trades` SET `STATUS`='DECLINED' WHERE `ID`='$id' AND `RECEIVER_ID`='$user[0]'");
								echo"<script>alert('Trade Declined!')</script>";
								echo"<script>window.location='../Trade/trades.php'</script>"; exit;
								}
						}
						
						// check if they still have items
						foreach ($SenderTCIds as $crateId) {
							$cratesQ = mysqli_query($conn, "SELECT * FROM `ec_crate` WHERE `ID`='$crateId' AND `USER_ID`='$otherUser[0]'");
							if(mysqli_num_rows($cratesQ) < 1){
								// delete trade
								echo"<script>alert('The Sender Does not have some items')</script>";
								mysqli_query($conn, "UPDATE `ec_trades` SET `STATUS`='DECLINED' WHERE `ID`='$id' AND `RECEIVER_ID`='$user[0]'");
								echo"<script>alert('Trade Declined!')</script>";
								echo"<script>window.location='../Trade/trades.php'</script>"; exit;
							}
						}
						// exchange
						$ourNewMoneyPRE = $user['GOLD'] + $trade['MONEY_SENDING'];
						$ourNewMoney = $ourNewMoneyPRE - $trade['MONEY_REQUEST'];
						$theirNewMoneyPRE = $otherUser['GOLD'] + $trade['MONEY_REQUEST'];
						$theirNewMoney = $theirNewMoneyPRE - $trade['MONEY_SENDING'];
						mysqli_query($conn, "UPDATE `ec_users` SET `GOLD`='$ourNewMoney' WHERE `ID`='$user[0]'");
						mysqli_query($conn, "UPDATE `ec_users` SET `GOLD`='$theirNewMoney' WHERE `ID`='$otherUser[0]'");
						foreach ($UsTCIds as $crateId) {
							// give them our items
							mysqli_query($conn, "UPDATE `ec_crate` SET `USER_ID`='$otherUser[0]' WHERE `ID`='$crateId'");
						}
						foreach ($SenderTCIds as $crateId) {
							// take their items
							mysqli_query($conn, "UPDATE `ec_crate` SET `USER_ID`='$user[0]' WHERE `ID`='$crateId'");
						}
						mysqli_query($conn, "INSERT INTO `ec_messages` VALUES(NULL, '1','$trade[SENDER_ID]','Your Trade Has Been Accepted!','Your trade with $user[USERNAME] has been accepted!','','$curtime','NO')");
						echo"<script>alert('Trade Accepted!')</script>";
						echo"<script>window.location='../Avatar/'</script>"; exit;
						// alert sender it is successfull
					}

					echo"
						<center>
							<div style='height:115px;'></div> <!-- SPACE -->
								<div id='platform' style='width:1200px; border:1px solid black;background-color:white;padding:20px;'>
								<h1>$otherUser[USERNAME] Sends</h1>
								";
								foreach ($SenderTCIds as $crateId) {
									$cratesQ = mysqli_query($conn, "SELECT * FROM `ec_crate` WHERE `ID`='$crateId' AND `USER_ID`='$otherUser[0]'");

									if(mysqli_num_rows($cratesQ) < 1){
										// get rid of trade. bad trade
										mysqli_query($conn, "DELETE FROM `ec_trades` WHERE `ID`='$trade[0]'");
										echo"<script>alert('Bad Trade!')</script>";
										echo"<script>window.location='../Trade/'</script>"; exit;
									}

									while($crate = mysqli_fetch_array($cratesQ)){
										$itemQ = mysqli_query($conn, "SELECT * FROM `ec_items` WHERE `ID`='$crate[ITEM_ID]'");
										$item = mysqli_fetch_array($itemQ);
										echo"<div style='margin-bottom:7.5px;z-index:0;position: relative;border:1px solid red;display:inline-block;border-radius:5px;padding:0px;padding-bottom:0px;margin-right:10px;'>
											<img src='$item[PREVIEW_IMG_URL]' title='$item[NAME]'>";
											if($crate['SERIAL']!='0'){
												echo"<div style='position:absolute;top:0px;right:0px;border:1px solid red;padding:2.5px;font-size:12.5px;border-top-right-radius:0px;border-top:0px;border-right:0px;'>#$crate[SERIAL]</div>";
											}
											echo"
										</div>";
									}
								}
								if($trade['MONEY_SENDING']!='0'){
									echo"<br><text style='color:#ffad21;font-size:35px;font-weight:bold;'>+ $trade[MONEY_SENDING] <i class='fa fa-circle'></i></text>";
								}
								echo"
									<h1>You Send</h1>";
								foreach ($UsTCIds as $crateId) {
									$cratesQ = mysqli_query($conn, "SELECT * FROM `ec_crate` WHERE `ID`='$crateId' AND `USER_ID`='$user[0]'");

									if(mysqli_num_rows($cratesQ) < 1){
										// get rid of trade. bad trade
										mysqli_query($conn, "DELETE FROM `ec_trades` WHERE `ID`='$trade[0]'");
										echo"<script>alert('Bad Trade!')</script>";
										echo"<script>window.location='../Trade/'</script>"; exit;
									}

									while($crate = mysqli_fetch_array($cratesQ)){
										$itemQ = mysqli_query($conn, "SELECT * FROM `ec_items` WHERE `ID`='$crate[ITEM_ID]'");
										$item = mysqli_fetch_array($itemQ);
										echo"<div style='margin-bottom:7.5px;z-index:0;position: relative;border:1px solid red;display:inline-block;border-radius:5px;padding:0px;padding-bottom:0px;margin-right:10px;'>
											<img src='$item[PREVIEW_IMG_URL]' title='$item[NAME]'>";
											if($crate['SERIAL']!='0'){
												echo"<div style='position:absolute;top:0px;right:0px;border:1px solid red;padding:2.5px;font-size:12.5px;border-top-right-radius:0px;border-top:0px;border-right:0px;'>#$crate[SERIAL]</div>";
											}
											echo"
										</div>";
									}
								}
								if($trade['MONEY_REQUEST']!='0'){
									echo"<br><text style='color:#ffad21;font-size:35px;font-weight:bold;'>+ $trade[MONEY_REQUEST] <i class='fa fa-circle'></i></text>";
								}
									echo"

									<br><br><br>
									<a href='?id=$id&accept' style='padding:5px;border:1px solid green;color:green;font-weight:bold;font-size:20px;padding-left:50px;padding-right:50px;'>Accept</a>
									<a href='?id=$id&decline' style='padding:5px;border:1px solid red;color:red;font-weight:bold;font-size:20px;padding-left:50px;padding-right:50px;'>Decline</a><br>
									<br><br><text style='color:grey;margin-top:20px;'>All Clicks are Final! Please Choose Wisely!</text>
								</div>
							</div>
						</center>
					</body>";
				
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
