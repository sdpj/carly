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
			$curtime = time();

			if($user['POWER']=='MEMBER'){
				header("Location: ../"); exit;
			}

			if($user['POWER']!='ADMIN' && $user['POWER']!='MODERATOR'){
				if(isset($_GET['declineAss']) && is_numeric($_GET['declineAss'])) {
					// decline it
					$id = mysqli_real_escape_string($conn, $_GET['declineAss']); // do i trust my co founders? or will i have to mysqli_real_esc?
					$infoQ = mysqli_query($conn, "SELECT * FROM `ec_mod_uploads` WHERE `ID`='$id'");
					$info = mysqli_fetch_array($infoQ);
					mysqli_query($conn, "UPDATE `ec_mod_uploads` SET `PENDING`='NO' WHERE `ID`='$id'");
					//get user id and confirm that its declined
					#mysqli_query($conn, "INSERT INTO `ec_messages` VALUES(NULL, '$user[0]','$info[USER_ID]','I have declined your asset','Your asset has been deemed unworthy. This is an automated message','','$curtime','NO')");
					// refresh
					echo"<script>window.location='../Mod/'</script>"; exit;
					//exit(header("Location: ../Mod/"));
				}

				if(isset($_GET['approveAss']) && is_numeric($_GET['approveAss'])) {
					$id = mysqli_real_escape_string($conn, $_GET['approveAss']); // do i trust my co founders? or will i have to mysqli_real_esc?
					$infoQ = mysqli_query($conn, "SELECT * FROM `ec_mod_uploads` WHERE `ID`='$id'");
					$info = mysqli_fetch_array($infoQ);
					mysqli_query($conn, "UPDATE `ec_mod_uploads` SET `PENDING`='NO' WHERE `ID`='$id'");
					#mysqli_query($conn, "INSERT INTO `ec_messages` VALUES(NULL, '$user[0]','$info[USER_ID]','I have accepted your asset','Your asset has been deemed worthy. This is an automated message, you can now view the item in store','','$curtime','NO')");
					// insert
					mysqli_query($conn, "INSERT INTO `ec_items` VALUES(NULL, '$info[NAME]', '$info[DESCRIPTION]', '$info[GOLD_PRICE]', '$info[SILVER_PRICE]', 'NO', '$info[PREVIEW_IMG_URL]', '$info[AVATAR_IMG_URL]', '$info[RARE]', '$info[STOCK]', '$info[STOCK]', '0', '$info[TIME]', '$info[LAYER]')");
					// give them one
					$theirsQ = mysqli_query($conn,"SELECT `ID` FROM `ec_items` WHERE 1 ORDER BY `ID` ASC LIMIT 1");
					$theirs = mysqli_fetch_array($theirsQ);
					mysqli_query($conn,"INSERT INTO `ec_crate` VALUES(NULL, '$theirs[ID]', '$info[USER_ID]', '0')");
					// go to item
					//exit(header("Location: ../Emporium/item.php?id=$theirs[ID]"));
					echo"<script>window.location='../Emporium/item.php?id=$theirs[ID]'</script>"; exit;
				}
			}
			
			if(isset($_FILES["file"]) && isset($_FILES['file2'])){
				if ($_FILES["file"]["error"] > 0){
					echo "<script>alert('Error: " . $_FILES["file"]["error"] . "')</script>";
				}else{
					$info = getimagesize($_FILES['file']['tmp_name']);
					$info2 = getimagesize($_FILES['file2']['tmp_name']);
					if ($info === FALSE || $info2 === FALSE) {
					  echo"<script>alert('Not A Valid Image file!')</script>";
					  echo"<script>window.location='../Mod/'</script>"; exit;
					}

					if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
					   echo"<script>alert('Not A Valid Image file! (Avatar)')</script>";
					   echo"<script>window.location='../Mod/'</script>"; exit;
					}
					
					if (($info2[2] !== IMAGETYPE_GIF) && ($info2[2] !== IMAGETYPE_JPEG) && ($info2[2] !== IMAGETYPE_PNG)) {
					   echo"<script>alert('Not A Valid Image file! (Preview)')</script>";
					   echo"<script>window.location='../Mod/'</script>"; exit;
					}

					if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['gold']) && isset($_POST['silver']) && isset($_POST['rare']) && isset($_POST['stock']) && isset($_POST['layer'])){
						#$ = mysqli_real_escape_string($conn, $_POST['']);
						$name = mysqli_real_escape_string($conn, $_POST['name']);
						$description = mysqli_real_escape_string($conn, $_POST['description']);
						$gold = mysqli_real_escape_string($conn, $_POST['gold']);
						$silver = mysqli_real_escape_string($conn, $_POST['silver']);
						$rare = mysqli_real_escape_string($conn, $_POST['rare']);
						$stock = mysqli_real_escape_string($conn, $_POST['stock']);
						$layer = mysqli_real_escape_string($conn, $_POST['layer']);
						//echo"<script>alert('$layer')</script>";
					}else{
						echo"<script>alert('Wrong Data Submitted!')</script>";
						echo"<script>window.location='../Mod/'</script>"; exit;
					}

					$image_dir= '../EpicClubRebootMisc/IMGS/HATS/';
					move_uploaded_file($_FILES['file']['tmp_name'], $image_dir.$_FILES['file']['name']);
					move_uploaded_file($_FILES['file2']['tmp_name'], $image_dir.$_FILES['file2']['name']);
					$imageAVATAR_URL = $image_dir.$_FILES['file']['name'];
					$imagePREVIEW_URL = $image_dir.$_FILES['file2']['name'];
					$curtime = time();
					#echo"<script>alert('$imageURL')</script>";
					mysqli_query($conn, "INSERT INTO `ec_mod_uploads` VALUES(NULL, '$imageAVATAR_URL', '$imagePREVIEW_URL', 'YES', '$user[0]', '$rare', '$stock', '$gold', '$silver', '$name', '$description', '$curtime', '$layer')");
					echo"<script>alert('Hat Sent! Waiting for Approval')</script>";
					echo"<script>window.location='../Mod/'</script>"; exit;
				}
			}else{
				echo"<script>console.log('No files chosen!')</script>";
			}

			if(isset($_POST['reportId']) && isset($_POST['note'])){
				$reportId = mysqli_real_escape_string($conn, $_POST['reportId']);
				$note = strip_tags(mysqli_real_escape_string($conn, $_POST['note']));
				// see if report exists
				$RealReport = mysqli_query($conn, "SELECT * FROM `ec_reports` WHERE `ID`='$reportId'");
				if(mysqli_num_rows($RealReport) > 0){
					// seen + dealt
					if(strlen($note) < 1){
						$note = "No Action Taken!";
					}
					mysqli_query($conn, "UPDATE `ec_reports` SET `SEEN`='YES',`MOD_SEEN_ID`='$user[0]',`MOD_NOTE`='$note' WHERE `ID`='$reportId'");
					// refresh page
					echo"<script>window.location='../Mod/'</script>";exit;
				}else{
					echo"<script>alert('\$WrongReportId!')</script>";exit;
				}
			}

			echo"
				<center>
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
							<h1 style='text-align:left;'>Admin Panel</h1><a style='font-size:10px;color:grey;' href='gift'>Open Gifts?</a>";
							if($user['POWER']!='MODERATOR' && $user['POWER']!='ADMIN'){
								echo "<h2 style='text-align:left;'>Awaiting Your Approval!</h2>";
								//
							}else{
								echo "<h2 style='text-align:left;'>Awaiting Approval from a higher rank</h2>";
							}

							// get mod uploads ready for admins
							$hasUploads = mysqli_query($conn, "SELECT * FROM `ec_mod_uploads` WHERE `PENDING`='YES'");
							if(mysqli_num_rows($hasUploads) > 0){
								while($upload = mysqli_fetch_array($hasUploads)){
									$userDeQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$upload[USER_ID]' "); #user details query
									$userDe = mysqli_fetch_array($userDeQ);
									echo "
									<div style='border:1px solid;display:flex;flex-wrap:wrap;flex-direction:row;width:925px;margin-bottom:5px;'>
										<div style='display:inline-block;width:50%;'>
											<img src='$upload[AVATAR_IMG_URL]'></img><br>
											<img src='$upload[PREVIEW_IMG_URL]'></img><br>";

											if($user['POWER']!='MODERATOR' && $user['POWER']!='ADMIN'){
												echo"<a style='color:green' href='?approveAss=$upload[0]'>Approve</a>  |  <a style='color:red' href='?declineAss=$upload[0]'>Decline</a><br>";
											}

											if($upload['USER_ID']==$user[0]){
												echo"Delete";
											}

											echo"
										</div>
										<div style='display:inline-blockwidth:50%'>
											<br>Name - $upload[NAME]<br><br>
											Description - <text style='font-size:12.5px'>$upload[DESCRIPTION]</text><br>
											Rare? $upload[RARE]<br>";

											if($upload['RARE']=='YES'){
												echo "<text style='color:red;font-size:17.5px;'>STOCK: $upload[STOCK]</text><br>";
											}

											if($upload['GOLD_PRICE']<1){
												echo "<text style='color:grey;font-size:12.5px;'>No Gold</text><br>";
											}else{
												echo "Gold: $upload[GOLD_PRICE]<br>";
											}

											if($upload['SILVER_PRICE']<1){
												echo "<text style='color:grey;font-size:12.5px;'>No Silver</text><br>";
											}else{
												echo "Silver: $upload[SILVER_PRICE]<br>";
											}
											
											echo"
											Layer: $upload[LAYER]<br>
											<img src='$userDe[AVATAR_IMG_URL]'><br>$userDe[USERNAME]</img>
										</div>
									</div>";
								}
							}else{
								echo "<i>None! Maybe Create One?</i>";
							}
							
							echo"<br><br>
							<h2 style='text-align:left;'>Reports</h2>";
							// get reports
							$areReports = mysqli_query($conn, "SELECT * FROM `ec_reports` WHERE 1");
							if(mysqli_num_rows($areReports) > 0){
								// get all unseen
								$unseenQ = mysqli_query($conn, "SELECT * FROM `ec_reports` WHERE `SEEN`='NO' LIMIT 30");
								while($unseen = mysqli_fetch_array($unseenQ)){
									$reporterQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$unseen[REPORTER_ID]'");
									$reporter = mysqli_fetch_array($reporterQ);
									$victimQ =  mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$unseen[VICTIM_ID]'");
									if($unseen['TYPE']=='FORUM'){
										$url = '../Forums/thread.php?id=';
										$string = str_split($unseen['VICTIM_ID']);
										$id_array = array();
										for($i = 0; $i < count($string); $i++){
											if(is_numeric($string[$i])){
												array_push($id_array, $string[$i]);
											}
										}

										// get all the numbers together!
										$finalstring = "";
										for($x = 0; $x < count($id_array); $x++){
											$finalstring.=$id_array[$x];
										}

										$victim=$finalstring;
										$text = "Thread Id";
									}else{
										$victimPRE = mysqli_fetch_array($victimQ);
										$victim = $victimPRE[0];
										$url = '../User/?id=';
										$text = "";
									}
									echo"
									<div style='display:flex;flex-direction:column;width:700px;'>
									<div style='padding:10px;width:100%;border-bottom:0px;'>
									<a style='color:blue;' href='../User/?id=$reporter[0]'>$reporter[USERNAME]</a>, Reported <a style='color:blue;' href='$url$victim'>$text $victim</a> For \"<i>$unseen[REASON]</i>\"
									</div>
									<div style='margin-left:5px;border:1px solid;padding:10px;width:100%;padding-left:5px;padding-right:5px;'>
										<form method='post'>
											<input value='$unseen[0]' name='reportId' type='hidden' />
											<input style='border:1px solid black;padding:5px;' name='note' maxlength='255' placeholder='Note'></input> 
											<button style='border-radius:0px;padding:5px;'> I've Dealt with this! </button>
										</form>
									</div>
									</div>
									<br><Br>
									";
								}

								// get all seen
								echo"
								<div style='border-top:1px solid;width:80%;margin-bottom:0px;'></div><br>
								<h3>Seen</h3>
								";
								$seenQ =  mysqli_query($conn, "SELECT * FROM `ec_reports` WHERE `SEEN`='YES' ORDER BY `ID` DESC LIMIT 50");
								while($seen = mysqli_fetch_array($seenQ)){
									$reporterQ2 = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$seen[REPORTER_ID]'");
									$reporter2 = mysqli_fetch_array($reporterQ2);
									$modQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$seen[MOD_SEEN_ID]'");
									$mod = mysqli_fetch_array($modQ);

									if($seen['TYPE']=='FORUM'){
										$url = '../Forums/thread.php?id=';
										$string = str_split($seen['VICTIM_ID']);
										$id_array = array();
										for($i = 0; $i < count($string); $i++){
											if(is_numeric($string[$i])){
												array_push($id_array, $string[$i]);
											}
										}

										// get all the numbers together!
										$finalstring = "";
										for($x = 0; $x < count($id_array); $x++){
											$finalstring.=$id_array[$x];
										}

										$victimId=$finalstring;
										$text = "Thread Id ".$victimId;
									}else{
										$victimQ2 =  mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$seen[VICTIM_ID]'");
										$victim2 = mysqli_fetch_array($victimQ2);
										$victimId = $victim2[0];
										$url = '../User/?id=';
										$text = "User Id ".$victim2[1];
									} 
									echo"
										<text style='font-size:15px;'><a style='color:blue;' href='../User/?id=$reporter2[0]'>$reporter2[USERNAME]</a>, Reported <a style='color:blue;' href='$url$victimId'>$text</a> For \"<i>$seen[REASON]</i>\".
										| <text style='color:red'>$mod[USERNAME]</text> Dealt with this. (Action: <i style='font-weight:bold;'>$seen[MOD_NOTE]</i>)</text><br><br>
									";
								}
							}else{
								echo "<i>No reports</i>";
							}
							echo"
							<br><br>
							<h2 style='text-align:left;'>Logs</h2>";
							$hasLogs = mysqli_query($conn, "SELECT * FROM `ec_mod_logs` WHERE 1 ORDER BY `ID` DESC LIMIT 100");
							if(mysqli_num_rows($hasLogs) > 0){
								while($log = mysqli_fetch_array($hasLogs)){
									$VictimQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$log[USER_ID]'");
									$Victim = mysqli_fetch_array($VictimQ);
									$ModQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$log[MOD_ID]'");
									$Mod = mysqli_fetch_array($ModQ);
									$time = gmdate("M jS h:i a",$log['TIME']); // D for Mon, Tues, etc

									echo "<br>$Mod[USERNAME] -> $log[ACTION] -> $Victim[USERNAME] <a style='color:blue;' href='../User/?id=$log[USER_ID]'> (Id:$log[USER_ID]) </a>  |  $time";
								}
							}else{
								echo"<i>No logs</i>";
							}

							if($user['POWER']!='ADMIN' && $user['POWER']!='MODERATOR'){
								echo"<h4>Founders Only</h4>
								<form method='post' style='border:1px solid;padding:2.5px;width:900px;margin-top:40px;'>
								<input style='border:1px solid grey;padding:5px;' type='number' name='UserId' placeholder='User Id'></input>
								<input style='border:1px solid grey;padding:5px;width:300px;' type='number' name='length' placeholder='Length (Seconds) (2,600,000 = 1month)'></input>
								<select style='border:1px solid grey;padding:5px;' name='type' placeholder='Type'>
									<option name='VIP'>VIP</option>
									<option name='MVIP'>MEGA_VIP</option>
								</select>
								<button style='border:1px solid;padding:5px;'><i class='fa fa-arrow-right'></i></button>
								</form>";

								if(isset($_POST['UserId']) && is_numeric($_POST['UserId']) && isset($_POST['length']) && is_numeric($_POST['length']) && isset($_POST['type'])){
									$id = mysqli_real_escape_string($conn, $_POST['UserId']);
									$length = mysqli_real_escape_string($conn, $_POST['length']);
									$type = mysqli_real_escape_string($conn, $_POST['type']);
									if($type=="VIP"){
										// give id vip type at length...
										$endTime = $curtime + $length;
										mysqli_query($conn, "INSERT INTO `ec_membership` VALUES(NULL, '$id','$curtime','$endTime','YES','$type')");
										// update thier id give them vip
										mysqli_query($conn, "UPDATE `ec_users` SET `VIP`='$type' WHERE `ID`='$id'");
										// tell id via PM we have ...
										mysqli_query($conn, "INSERT INTO `ec_messages` VALUES(NULL, '$user[0]','$id','I have grant you membership','This is an Automated Message, You now have $type Status, Check more details in settings!','','$curtime','NO')");
										// insert it into logs
										mysqli_query($conn, "INSERT INTO `ec_mod_logs` VALUES(NULL, '$user[0]', '$id', 'Grant $type', '$curtime')");
										//echo succ , succ = success
										echo"<text style='color:green'>Success!</text>";
									}elseif ($type=="MEGA_VIP") {
										// give id vip type at length...
										$endTime = $curtime + $length;
										mysqli_query($conn, "INSERT INTO `ec_membership` VALUES(NULL, '$id','$curtime','$endTime','YES','$type')");
										// update thier id give them vip
										mysqli_query($conn, "UPDATE `ec_users` SET `VIP`='$type' WHERE `ID`='$id'");
										// tell id via PM we have ...
										mysqli_query($conn, "INSERT INTO `ec_messages` VALUES(NULL, '$user[0]','$id','I have grant you membership','This is an Automated Message, You now have $type Status, Check more details in settings!','','$curtime','NO')");
										// insert it into logs
										mysqli_query($conn, "INSERT INTO `ec_mod_logs` VALUES(NULL, '$user[0]', '$id', 'Grant $type', '$curtime')");
										//echo succ , succ = success
										echo"<text style='color:green'>Success!</text>";
									}else{
										echo"<script>window.location='../Mod/'</script>"; exit;
									}
								}

								echo"
								<form method='post' style='border:1px solid;padding:2.5px;width:900px;margin-top:40px;'>
								<input style='border:1px solid grey;padding:5px;' type='number' name='UserId' placeholder='User Id'></input>
								<input style='border:1px solid grey;padding:5px;' type='number' name='amount' placeholder='Amount'></input>
								<select style='border:1px solid grey;padding:5px;' name='curr' placeholder='Type'>
									<option name='GOLD'>GOLD</option>
									<option name='SILVER'>SILVER</option>
								</select>
								<button style='border:1px solid;padding:5px;'><i class='fa fa-arrow-right'></i></button>
								</form>";

								if(isset($_POST['UserId']) && is_numeric($_POST['UserId']) && isset($_POST['amount']) && is_numeric($_POST['amount']) && isset($_POST['curr'])){
									$id = mysqli_real_escape_string($conn, $_POST['UserId']);
									$amount = mysqli_real_escape_string($conn, $_POST['amount']);
									$type = mysqli_real_escape_string($conn, $_POST['curr']);
									if($type=="GOLD"){
										// give id vip type at length...
										$otherUQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$id'"); #other user query
										$otherU = mysqli_fetch_array($otherUQ);
										$newGold = $otherU['GOLD'] + $amount;
										mysqli_query($conn, "UPDATE `ec_users` SET `GOLD`='$newGold' WHERE `ID`='$id'");
										// tell id via PM we have ...
										mysqli_query($conn, "INSERT INTO `ec_messages` VALUES(NULL, '$user[0]','$id','I have grant you some $type','This is an Automated Message, You have gained $amount $type!','','$curtime','NO')");
										// insert it into logs
										mysqli_query($conn, "INSERT INTO `ec_mod_logs` VALUES(NULL, '$user[0]', '$id', 'Grant $amount $type', '$curtime')");
										//echo succ , succ = success
										echo"<text style='color:green'>Success!</text>";
									}elseif ($type=="SILVER") {
										// give id vip type at length...
										$otherUQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$id'"); #other user query
										$otherU = mysqli_fetch_array($otherUQ);
										$newGold = $otherU['SILVER'] + $amount;
										mysqli_query($conn, "UPDATE `ec_users` SET `SILVER`='$newGold' WHERE `ID`='$id'"); // ik ik, i just copied and paste
										// tell id via PM we have ...
										mysqli_query($conn, "INSERT INTO `ec_messages` VALUES(NULL, '$user[0]','$id','I have grant you some $type','This is an Automated Message, You have gained $amount $type!','','$curtime','NO')");
										// insert it into logs
										mysqli_query($conn, "INSERT INTO `ec_mod_logs` VALUES(NULL, '$user[0]', '$id', 'Grant $amount $type', '$curtime')");
										//echo succ , succ = success
										echo"<text style='color:green'>Success!</text>";
									}else{
										echo"<script>window.location='../Mod/'</script>"; exit;
									}
								}
							}

							echo"
							<form style='margin-top:125px;' method='post' enctype='multipart/form-data'>
								<div style='border:1px solid;padding:5px;display:flex;flex-wrap:wrap;flex-direction:column;'>
								    <input style='padding:5px;border:1px solid;' type='file' name='file' id='file'> </input>
								    <label style='width:200px;' for='file'>Avatar Image</label><br>
								    <input style='margin-top:5px;padding:5px;border:1px solid;' type='file' name='file2' id='file2'> </input>
								    <label style='width:200px;padding:left:300px;' for='file'>PreviewImage</label><br>
								    <input style='border:1px solid black;width:300px;padding:5px;margin-bottom:5px;' placeholder='Item name' name='name'></input>
								    <textarea style='border:1px solid black;width:300px;padding:5px;' placeholder='Description' name='description'></textarea>
								    <br>
								    <br>
								    <input style='padding:5px;border:1px solid;' type='number' name='gold' value='0'> Gold (0 for no gold) </input>
								    <input style='padding:5px;border:1px solid;' type='number' name='silver' value='0'> Silver (0 for no gold) </input>
								    <br><br>
								    Rare?<select name='rare' style='padding:5px;padding-left:10px;padding-right:20px;margin-top:7.5px;'>
								    	<option name='YES'>YES</option>
								    	<option name='NO'>NO</option>
								    </select>
								    <br><br>
								    <input style='padding:5px;border:1px solid;' type='number' name='stock' value='0'> Stock (Leave at zero if not rare) </input>
								    <br>
								    <select name='layer' style='padding:5px;padding-left:10px;padding-right:20px;margin-top:7.5px;'>
								    	<option name='BODY'>BODY</option>
								    	<option name='FACE'>FACE</option>
								    	<option name='MASK'>MASK</option>
								    	<option name='HEAD'>HEAD</option>
								    	<option name='TOOL'>TOOL</option>
										<option name='HEAD_2'>HEAD_2</option>
										<option name='EYES'>EYES</option>
										<option name='HAIR'>HAIR</option>
								    </select>
								    <button style='width:400px;'>I am happy with this and will wait for approval by an offical</button>
								</div>
							</form>
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
