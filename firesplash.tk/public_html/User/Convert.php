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
			if(isset($_POST['amount']) && isset($_POST['cur'])){
				if(is_numeric($_POST['amount']) && is_numeric($_POST['cur'])){
					$amount = mysqli_real_escape_string($conn, $_POST['amount']);
					$currency = mysqli_real_escape_string($conn, $_POST['cur']);
					if($amount >= 1){
						if($currency == 1){
							// see if they have enough silver
							$GoldRequested = round($amount / 10, 3, PHP_ROUND_HALF_DOWN);
							if($GoldRequested >= 1){
								$NewGoldReq = round($GoldRequested, 0, PHP_ROUND_HALF_DOWN);
								$OurSilver = $user['SILVER'];
								// check if we have positive balance after
								$AfterTrade = $OurSilver - $amount;
								if($AfterTrade >= 0){
									// we have enough silver trade!
									$NewGoldAmount = $user['GOLD'] + $NewGoldReq;
									mysqli_query($conn, "UPDATE `ec_users` SET `GOLD`='$NewGoldAmount',`SILVER`='$AfterTrade' WHERE `ID`='$user[0]'");
									echo "<script>window.location='../User/Convert?succ'</script>"; exit;
									//header("Location: ../User/Convert.php?succ"); exit;
								}else{
									//header("Location: ../User/Convert.php?ins"); exit;
									echo "<script>window.location='../User/Convert?ins'</script>"; exit;
								}
							}else{
								header("Location: ../"); exit;
							}
						}elseif($currency == 2){
							$SilverRequested = round($amount * 10, 3, PHP_ROUND_HALF_DOWN);
							if($SilverRequested >= 10){
								$NewSilverReq = round($SilverRequested, 0, PHP_ROUND_HALF_DOWN);
								$OurGold = $user['GOLD'];
								// check if we have positive balance after
								$AfterTrade = $OurGold - $amount;
								if($AfterTrade >= 0){
									// we have enough silver trade!
									$NewSilverAmount = $user['SILVER'] + $NewSilverReq;
									mysqli_query($conn, "UPDATE `ec_users` SET `GOLD`='$AfterTrade',`SILVER`='$NewSilverAmount' WHERE `ID`='$user[0]'");
									//header("Location: ../User/Convert.php?succ"); exit;
									echo "<script>window.location='../User/Convert?succ'</script>"; exit;
								}else{
									//header("Location: ../User/Convert.php?ins"); exit;
									echo "<script>window.location='../User/Convert?ins'</script>"; exit;
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
				}
			}else{
				echo"
					<center>
						<div style='height:115px;'></div> <!-- SPACE -->
							<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;display:flex;flex-flow:column;'>
								<h1>Convert your coins!</h1>
								<div style='padding-right:300px;'>
									<i id='coin' style='color:yellow;font-size:100px;margin-left:300px;' class='fa fa-circle'></i>
								</div>
								<div style='padding-bottom:30px;'>
									<form method='post'>
										<select onchange='ChangeImg()' style='padding:5px;width:200px;' id='img' name='cur' required>
											<option value='1'>Converting to Gold</option>
											<option value='2'>Converting to Silver</option>
										</select><br>
										<input style='padding:5px;width:200px;margin-top:5px;' name='amount' type='number' placeholder='How much?' required></input>
									</form>
									<br>
									<text style='font-size:55px;'><i style='color:yellow;' class='fa fa-circle'>1</i> <i class='fa fa-exchange'></i> <i style='color:grey;' class='fa fa-circle'>10</i></text>
									";
									if(isset($_GET['succ'])){ #succ!
										echo "<br><text style='color:green;font-weight:bold;'>Success!</text>";
									}elseif(isset($_GET['ins'])){
										echo "<br><text style='color:red;font-weight:bold;'>Not Enough Money!</text>";
									}
									echo"
								</div>
							</div>
						</div>
					</center>
					<script>
						function ChangeImg() {
							var s = document.getElementById('img');
							var item1 = s.options[s.selectedIndex].value;

							if (item1 == 1) {
							    document.getElementById('coin').style.color = 'yellow';
							}
							else if (item1 == 2) {
							    document.getElementById('coin').style.color = 'grey';
							}
						}
					</script>
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
