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
			if(isset($_GET['id']) && is_numeric($_GET['id'])){
				// see if user is real
				$id = mysqli_real_escape_string($conn, $_GET['id']);
				$RealUser = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$id'");
				if(mysqli_num_rows($RealUser) > 0){

					if($id==$user[0]){
						header("Location: ../"); exit;
					}

					// set variables
					$curtime = time();
					$OurTC = ""; # our trade cart.
					$TheirTC = ""; # their trade cart.
					$otherUser = mysqli_fetch_array($RealUser);
					#$OurRareItems = array();
					#$TheirRareItems = array();  // i might use these arrays later. who knows 
					$OurTCIds = array();# our trade cart Ids
					$TheirTCIds = array();# their trade cart Ids
					$TheirItemsQ = mysqli_query($conn,"SELECT * FROM `ec_crate` WHERE `USER_ID`='$id'"); # while loop in items
					$OurItemsQ = mysqli_query($conn,"SELECT * FROM `ec_crate` WHERE `USER_ID`='$user[0]'");

					if(isset($_POST['OurTC']) && isset($_POST['TheirTC'])){
						$OurTC .= mysqli_real_escape_string($conn, $_POST['OurTC']);
						$TheirTC .= mysqli_real_escape_string($conn, $_POST['TheirTC']);
						// update our Ids
						if(isset($_POST['ItemAdd']) && is_numeric($_POST['ItemAdd']) && isset($_POST['UserId']) && is_numeric($_POST['UserId']) && isset($_POST['WhatCart']) && isset($_POST['CrateId']) && is_numeric($_POST['CrateId'])){
							$userId = mysqli_real_escape_string($conn, $_POST['UserId']);
							$itemId = mysqli_real_escape_string($conn, $_POST['ItemAdd']);
							$WhoseCart = mysqli_real_escape_string($conn, $_POST['WhatCart']);
							$crateId = mysqli_real_escape_string($conn, $_POST['CrateId']);
							// check if user has item
							$UserHasItem = mysqli_query($conn, "SELECT * FROM `ec_crate` WHERE `USER_ID`='$userId' AND `ITEM_ID`='$itemId' AND `ID`='$crateId'");
							if(mysqli_num_rows($UserHasItem) > 0){
								// add it
								if($WhoseCart=='OurTC'){
									$OurTC.="$crateId.";
								}elseif ($WhoseCart=='TheirTC') {
									$TheirTC.="$crateId.";
								}else{
									echo"<script>alert('Please Leave')</script>";
									// report hack attempt
									mysqli_query($conn, "INSERT INTO `ec_mod_logs` VALUES(NULL, '$user[0]', '$user[0]', 'Tried To Hack The Site', '$curtime')");
									echo"<script>window.location='http://google.com'</script>"; exit;
								}
							}else{
								echo"<script>alert('Please Leave')</script>";
								// report hack attempt
								mysqli_query($conn, "INSERT INTO `ec_mod_logs` VALUES(NULL, '$user[0]', '$user[0]', 'Tried To Hack The Site', '$curtime')");
								echo"<script>window.location='http://google.com'</script>"; exit;
							}
						}

						if(isset($_POST['remove']) && isset($_POST['WhatCart']) && isset($_POST['TheirTC']) && isset($_POST['OurTC'])){
							$rCrateId = mysqli_real_escape_string($conn, $_POST['remove']); # remove crate id
							$WhoseCart = mysqli_real_escape_string($conn, $_POST['WhatCart']);
							
							if($WhoseCart=='OurTC'){
								$OurTC = str_replace("$rCrateId.", "", $OurTC);
							}elseif ($WhoseCart=='TheirTC') {
								$TheirTC = str_replace("$rCrateId.", "", $TheirTC);
							}else{
								echo"<script>alert('Please Leave')</script>";
								// report hack attempt
								mysqli_query($conn, "INSERT INTO `ec_mod_logs` VALUES(NULL, '$user[0]', '$user[0]', 'Tried To Hack The Site', '$curtime')");
								echo"<script>window.location='http://google.com'</script>"; exit;
							}
						}

						$tradeCart = $OurTC."|".$TheirTC;
						
						#echo"<script>alert('$tradeCart')</script>";
						// crack trade strings algorithm
						$tradeCartArray = str_split($tradeCart);
						$switch = 0;
						$temp = "";
						for($i = 0; $i < count($tradeCartArray); $i++){
							if($tradeCartArray[$i]=='.'){
								if($switch>0){
									array_push($TheirTCIds, $temp);
									$temp = "";
								}else{
									array_push($OurTCIds, $temp);
									$temp = "";
								}
							}elseif($tradeCartArray[$i]=='|'){
								$switch++;
							}else{
								$temp.=$tradeCartArray[$i];
							}
						}
					}

					/*$test = "";
					for($i = 0; $i < count($OurTCIds); $i++){
						$test.=$OurTCIds[$i]." ";
					}
					echo"<script>alert('$test')</script>"; */
					#$test = count($OurTCIds);
					#echo"<script>alert('$test')</script>";
					#debugging purposes.

					# now we got our IDs of crate remove them from the while loops
					#$c1 = count($OurTCIds); do we need these?
					#$c2 = count($TheirTCIds);
					echo"
						<center>
							<div style='height:115px;'></div> <!-- SPACE -->
								<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;display:flex;flex:wrap;flex-direction:row;'>
									<div style='border:1px solid;display:inline-block;width:49%;border-right:0px;'>
										<h2>Your Items</h2><br>";
										while($OurItems = mysqli_fetch_array($OurItemsQ)){
											$ItemQ = mysqli_query($conn, "SELECT * FROM `ec_items` WHERE `ID`='$OurItems[ITEM_ID]'");
											$Item = mysqli_fetch_array($ItemQ);
											if($Item['RARE']=='YES'){
												if(in_array($OurItems[0],$OurTCIds)){
													echo "";
												}else{
													echo"
														<div style='margin-bottom:7.5px;z-index:0;position: relative;border:1px solid red;display:inline-block;border-radius:5px;padding:0px;padding-bottom:0px;margin-right:10px;'>
															<img src='$Item[PREVIEW_IMG_URL]' title='$Item[NAME]'>";
															if($OurItems['SERIAL']!='0'){
																echo"<div style='position:absolute;top:0px;right:0px;border:1px solid red;padding:2.5px;font-size:12.5px;border-top-right-radius:0px;border-top:0px;border-right:0px;'>#$OurItems[SERIAL]</div>";
															}
															echo"<br>
															<form method='post' action='?id=$id'>
																<input name='OurTC' value='$OurTC' hidden></input>
																<input name='TheirTC' value='$TheirTC' hidden></input>
																<input name='WhatCart' value='OurTC' hidden></input>
																<input name='CrateId' value='$OurItems[0]' hidden></input>
																<input name='ItemAdd' value='$Item[0]' hidden></input>
																<input name='UserId' value='$user[0]' hidden></input>
																<button style='padding:5px;color:green;border:0px;margin-bottom:0px;width:120px;'>ADD</button>
															</form>
														</div>
													";
												}
											}else{
												echo"";
											}
										}
										echo"
										<div style='margin-top:30px;margin-bottom:30px;border-top:1px solid;width:80%;'></div><!-- TEST -->
										<h2>Your Cart</h2>";
										if(count($OurTCIds) < 1){
											echo "<i style='margin-bottom:20px;'>No Items in Cart</i>";
										}else{
											// get each item, check if we have item
											foreach($OurTCIds as $checkCrateId){
												$check = mysqli_query($conn, "SELECT * FROM `ec_crate` WHERE `USER_ID`='$user[0]' AND `ID`='$checkCrateId'");
												if(mysqli_num_rows($check) < 1){
													echo"<script>alert('Please Leave')</script>";
													// report hack attempt
													mysqli_query($conn, "INSERT INTO `ec_mod_logs` VALUES(NULL, '$user[0]', '$user[0]', 'Tried To Hack The Site', '$curtime')");
													echo"<script>window.location='http://google.com'</script>"; exit;
												}
											}
											// we have every item by now or we would of left the page

											foreach($OurTCIds as $checkCrateId){
												$BCrateQ = mysqli_query($conn, "SELECT * FROM `ec_crate` WHERE `ID`='$checkCrateId'");
												$BCrate = mysqli_fetch_array($BCrateQ); // basket Crate
												$BItemQ = mysqli_query($conn, "SELECT * FROM `ec_items` WHERE `ID`='$BCrate[ITEM_ID]'");
												while($BItem = mysqli_fetch_array($BItemQ)){
													echo"
														<div style='margin-bottom:7.5px;z-index:0;position: relative;border:1px solid red;display:inline-block;border-radius:5px;padding:0px;padding-bottom:0px;margin-right:10px;'>
															<img src='$BItem[PREVIEW_IMG_URL]' title='$BItem[NAME]'>";
															if($BCrate['SERIAL']!='0'){
																echo"<div style='position:absolute;top:0px;right:0px;border:1px solid red;padding:2.5px;font-size:12.5px;border-top-right-radius:0px;border-top:0px;border-right:0px;'>#$BCrate[SERIAL]</div>";
															}
															echo"<br>
															<form method='post' action='?id=$id'>
																<input name='OurTC' value='$OurTC' hidden></input>
																<input name='TheirTC' value='$TheirTC' hidden></input>
																<input name='remove' value='$BCrate[0]' hidden></input>
																<input name='WhatCart' value='OurTC' hidden></input>
																<button style='padding:5px;color:red;border:0px;margin-bottom:0px;width:120px;'>REMOVE</button>
															</form>
														</div>
													";
												}
											}
										}
										echo"
									</div>

									<div style='border:1px solid;display:inline-block;widtH:49%;'>
										<h2>$otherUser[USERNAME]'s Item</h2><br>";
										while($TheirItems = mysqli_fetch_array($TheirItemsQ)){
											$ItemQ = mysqli_query($conn, "SELECT * FROM `ec_items` WHERE `ID`='$TheirItems[ITEM_ID]'");
											$Item = mysqli_fetch_array($ItemQ);
											if($Item['RARE']=='YES'){
												if(in_array($TheirItems[0],$TheirTCIds)){
													echo"";
												}else{
													echo"
														<div style='margin-bottom:7.5px;z-index:0;position: relative;border:1px solid red;display:inline-block;border-radius:5px;padding:0px;padding-bottom:0px;margin-right:10px;'>
															<img src='$Item[PREVIEW_IMG_URL]' title='$Item[NAME]'>";
															if($TheirItems['SERIAL']!='0'){
																echo"<div style='position:absolute;top:0px;right:0px;border:1px solid red;padding:2.5px;font-size:12.5px;border-top-right-radius:0px;border-top:0px;border-right:0px;'>#$TheirItems[SERIAL]</div>";
															}
															echo"<br>
															<form method='post' action='?id=$id'>
																<input name='OurTC' value='$OurTC' hidden></input>
																<input name='TheirTC' value='$TheirTC' hidden></input>
																<input name='WhatCart' value='TheirTC' hidden></input>
																<input name='CrateId' value='$TheirItems[0]' hidden></input>
																<input name='ItemAdd' value='$Item[0]' hidden></input>
																<input name='UserId' value='$TheirItems[USER_ID]' hidden></input>
																<button style='padding:5px;color:green;border:0px;margin-bottom:0px;width:120px;'>ADD</button>
															</form>
														</div>
													";
													#echo"<script>alert('$TheirTC')</script>";
												}
											}else{
												echo"";
											}
										}
										echo"
										<div style='margin-top:30px;margin-bottom:30px;border-top:1px solid;width:80%;'></div><!-- TEST -->
										<h2>$otherUser[USERNAME]'s Cart</h2>";
										if(count($TheirTCIds) < 1){
											echo "<i style='margin-bottom:20px;'>No Items in Cart</i>";
										}else{
											// get each item, check if THEY have item
											foreach($TheirTCIds as $checkCrateId){
												$check = mysqli_query($conn, "SELECT * FROM `ec_crate` WHERE `USER_ID`='$otherUser[0]' AND `ID`='$checkCrateId'");
												if(mysqli_num_rows($check) < 1){
													echo"<script>alert('Please Leave')</script>";
													// report hack attempt
													mysqli_query($conn, "INSERT INTO `ec_mod_logs` VALUES(NULL, '$user[0]', '$user[0]', 'Tried To Hack The Site', '$curtime')");
													echo"<script>window.location='http://google.com'</script>"; exit;
												}
											}
											// we have every item by now or we would of left the page

											foreach($TheirTCIds as $checkCrateId){
												$BCrateQ = mysqli_query($conn, "SELECT * FROM `ec_crate` WHERE `ID`='$checkCrateId'");
												$BCrate = mysqli_fetch_array($BCrateQ); // basket Crate
												$BItemQ = mysqli_query($conn, "SELECT * FROM `ec_items` WHERE `ID`='$BCrate[ITEM_ID]'");
												while($BItem = mysqli_fetch_array($BItemQ)){
													echo"
														<div style='margin-bottom:7.5px;z-index:0;position: relative;border:1px solid red;display:inline-block;border-radius:5px;padding:0px;padding-bottom:0px;margin-right:10px;'>
															<img src='$BItem[PREVIEW_IMG_URL]' title='$BItem[NAME]'>";
															if($BCrate['SERIAL']!='0'){
																echo"<div style='position:absolute;top:0px;right:0px;border:1px solid red;padding:2.5px;font-size:12.5px;border-top-right-radius:0px;border-top:0px;border-right:0px;'>#$BCrate[SERIAL]</div>";
															}
															echo"<br>
															<form method='post' action='?id=$id'>
																<input name='OurTC' value='$OurTC' hidden></input>
																<input name='TheirTC' value='$TheirTC' hidden></input>
																<input name='remove' value='$BCrate[0]' hidden></input>
																<input name='WhatCart' value='TheirTC' hidden></input>
																<button style='padding:5px;color:red;border:0px;margin-bottom:0px;width:120px;'>REMOVE</button>
															</form>
														</div>
													";
												}
											}
										}

										$tradeCart2 = $OurTC."|".$TheirTC;
									echo"
									</div>
								</div>
								<form method='post' action='send.php'>
									<input name='trade' value='$tradeCart2' hidden></input>
									<input name='SenderId' value='$user[0]' hidden></input>
									<input name='ReceiverId' value='$otherUser[0]' hidden></input>
									<input style='border:1px solid #1d1d1d;padding:5px;margin-top:10px;width:400px;' name='SendMoney' type='number' value='0' placeholder='How much Gold will you send?'></input> 
									<input style='border:1px solid #1d1d1d;padding:5px;margin-top:10px;width:400px;' name='ReqMoney' type='number' value='0' placeholder='How much Gold will you require?'></input><br>
									<button style='border:1px solid green;background-color:white;padding:5px;margin:25px;'>Send Trade!</button>
								</form>
							</div>
						</center>
					</body>";
				}else{
					header("Location: ../NaughtyBoy"); exit;
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
