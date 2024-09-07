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
			include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/global.php' );
			// include( $_SERVER['DOCUMENT_ROOT'] . 'EpicClubRebootMisc\HTMLS\Dashboard.html' );
			// include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/header.php' );

			// Check if ID is set!
			if(ISSET($_GET['id'])){
				// Check if USER Exists!
				$profileId = mysqli_real_escape_string($conn, $_GET['id']);
				$profileQuery = mysqli_query($conn,"SELECT * FROM `ec_users` WHERE `ID`='$profileId'"); // Should i add limit one? or is that retarded?
				$profileCount = mysqli_num_rows($profileQuery);
				if($profileCount > 0){
					$profile = mysqli_fetch_array($profileQuery);
					if($profile['BANNED']=='YES'){
						$bcolor = "#7d7d7d";
						$pcolor = "#cecece";
						$bannedColor = "#1d1d1d;";
						$backgroundIMG = "background-image: url(../EpicClubRebootMisc/IMGS/banned.png)";
					}else{
						$bcolor = "#f2f2f2";
						$bannedColor = "black;";
						$backgroundIMG = "";
						$pcolor = "white";
					}

					if($profile['ID']=='1'){
						$backgroundIMG = "background-image: url(../EpicClubRebootMisc/IMGS/itsCherryandKwame.png)";
					}
					echo"
					<body style='background-color:$bcolor;color:$bannedColor;'>";
					include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/global.php' );
					echo"
						<center>
							<div style='height:115px;'></div> <!-- SPACE -->
								<div id='platform' style='width:1200px; border:1px solid black;background-color:$pcolor;border-radius:10px;padding:20px;$backgroundIMG'>
										<div style='border:1px solid;border-radius:5px;padding:5px;width:160px;display:inline-block;padding-bottom:15px;'>
											<h4>$profile[USERNAME] ";

											$time = time();
											if($profile['LAST_ONLINE'] + 300 <= $time){
												// Offline
												echo"<i class='fa fa-circle' style='font-size:12.5px;color:red' aria-hidden='true'></i>";
											}else{
												// Online
												echo"<i class='fa fa-circle' style='font-size:12.5px;color:green' aria-hidden='true'></i>";
											}
												#href='../Mod/usertools.php?RevokeUsername=$profile[0]'
											if($user['POWER']!='MEMBER'){
												echo "
												<script>
												var confirm = 0;
												function Revoke(){
													if(confirm > 2){
														window.location='../Mod/usertools.php?RevokeUsername=$profile[0]';
													}else{
														confirm++;
														console.log('Attempt' + confirm + '!');
													}
												}
												</script>
												<br><a onclick='Revoke()' style='color:grey;font-size:10px;'>Revoke</a>";
											}

											echo"</h4>
											<img src='$profile[AVATAR_IMG_URL]'></img><br><br>
											";
											// Site Hieracrhy Status
											if($profile['POWER']=='MEMBER'){
												echo "<text style='width:100px;font-size:15px;margin-top:5px;color:black;font-weight:bold;background-color:#ff7c19;padding:5px;border-radius:5px;margin-bottom:20px;padding-left:22.5px;padding-right:23px;'>Member</text><br><br>";
											}else if($profile['POWER']=='MODERATOR'){
												echo "<text style='width:100px;font-size:15px;margin-top:5px;color:black;font-weight:bold;background-color:purple;padding:5px;padding-left:30px;padding-right:30px;border-radius:5px;margin-bottom:20px;'>M O D</text><br><br>";
											}else if($profile['POWER']=='ADMIN'){
												echo "<text style='width:100px;font-size:15px;margin-top:5px;color:white;font-weight:bold;background-color:red;padding:5px;border-radius:5px;margin-bottom:20px;padding-left:27.5px;padding-right:27.5px;'>Admin</text><br><br>";
											}else if($profile['POWER']=='CO-FOUNDER'){
												echo "<text style='width:100px;font-size:12.5px;margin-top:5px;color:black;font-weight:bold;background: linear-gradient(red, yellow);;padding:5px;border-radius:5px;margin-bottom:20px;padding-left:27.5px;padding-right:27.5px;position:relative;'>Co-Founder</text><br><br>";
											}else if($profile['POWER']=='FOUNDER'){
												//echo "<text style='width:100px;font-size:12.5px;margin-top:5px;color:#cecece;font-weight:bold;background:repeating-radial-gradient(circle,#840000,#840000 10px,#9b4c4c 10px,#9b4c4c 20px);padding:5px;border-radius:5px;margin-bottom:20px;padding-left:25px;padding-right:25px;position:relative;'>F O U N D E R</text><br><br>";
												echo "<text style='width:100px;font-size:12.5px;margin-top:5px;color:black;font-weight:bold;background: linear-gradient(to right, red,orange,yellow,green,blue,indigo,violet);;padding:5px;border-radius:5px;margin-bottom:20px;padding-left:25px;padding-right:25px;position:relative;'>F O U N D E R</text><br><br>";

											}

											// Check if verified for verified tag
											if($profile['VERIFIED']=='NO'){
												// Not Verified
												echo "<text style='width:100px;font-size:10px;margin-top:5px;color:white;font-weight:bold;background-color:orange;padding:5px;border-radius:5px;padding-left:12px;padding-right:12px;'> Not Verified</text><br>";
											}else{
												 echo "<text style='width:100px;font-size:15px;margin-top:5px;color:white;font-weight:bold;background-color:#3ea310;padding:5px;border-radius:5px;padding-left:25px;padding-right:25px;'> Verified</text><br>";
												// I prefer show nothing
											}


											// finding space on profile is like trying to find a vien >.<
											// Go to new message
											echo"<br><Br><a style='padding:5px;border:1px solid;border-radius:5px;font-size:10px;padding-left:32.5px;padding-right:32.5px;margin-top:-50px;' href='../Messages/newMessage.php?id=$profile[ID]'>Message</a>";
											// FriendR
											echo"<br><Br><a style='padding:5px;border:1px solid;border-radius:5px;font-size:10px;padding-left:40px;padding-right:40px;margin-top:-50px;' href='../Friends/?request=$profile[ID]'>Friend</a>";
											// Trade
											echo"<br><Br><a style='padding:5px;border:1px solid;border-radius:5px;font-size:10px;padding-left:42px;padding-right:42px;margin-top:-50px;' href='../Trade/?id=$profile[ID]'>Trade</a>";
											
											if($user['POWER']!='MEMBER'){
												echo"<br><br><br><Br><a href='../Mod/usertools.php?ban=$profile[0]' style='color:red;padding:5px;border:1.5px solid red;font-weight:bold;border-radius:5px;font-size:10px;padding-left:52.5px;padding-right:52.5px;margin-top:-50px;'>Ban User</a>";
												echo"<br><Br><a href='../Mod/usertools.php?avatar=$profile[0]' style='color:red;padding:5px;border:1.5px solid red;font-weight:bold;border-radius:5px;font-size:10px;padding-left:42px;padding-right:42px;margin-top:-50px;'>Reset Avatar</a>";
												echo"<br><br><Br><a href='../Mod/usertools.php?user=$profile[0]'style='color:red;padding:5px;border:1.5px solid red;font-weight:bold;border-radius:5px;font-size:10px;padding-left:42px;padding-right:42px;margin-top:-50px;'>INFORMATION</a>";
											}

											echo"
										</div>
										<div style='width:1000;display:inline-block;margin-top:0px;float:right;'>
											<div style='margin-bottom:10px;border:1px solid black;border-radius:5px;padding:5px;width:950;display:inline-block;'>
												$profile[USERNAME] has recently, \" <text style='color:grey;'>$profile[STATUS]</text> \"
											</div>

											<div style='margin-bottom:10px;border:1px solid black;border-radius:5px;padding:5px;width:950;display:inline-block;'>
												<br>
												<text style='font-weight:bold;'>$profile[BIO]</text>
												<br><Br>
											</div>

											<div style='margin-bottom:10px;border:1px solid;border-radius:5px;padding:5px;width:950;display:inline-block;'>
												<h2 style='text-align:left;'>$profile[USERNAME]'s Friends</h2>
												";
													// Get Friends
													
													// set page for items and friends
													if(isset($_GET['pageF'])){
														// check for numeric
														if(is_numeric($_GET['pageF'])){
															// check for negative numbers
															if($_GET['pageF'] > 1){
																// good
																$pageF = mysqli_real_escape_string($conn, $_GET['pageF']);
																$offsetPRE = $pageF * 10;
																$offset = $offsetPRE - 10;
																$nPage = mysqli_real_escape_string($conn, $_GET['pageF']) +1;
																$bPage = mysqli_real_escape_string($conn, $_GET['pageF']) - 1;
															}else{
																#$pageF = 1;
																$offset = 0;
																$nPage = 2;
																$bPage = 1;
															}
														}else{
															#$pageF = 1;
															$offset = 0;
															$nPage = 2;
															$bPage = 1;
														}
													}else{
														#$pageF = 1;
														$offset = 0;
														$nPage = 2;
														$bPage = 1;
													}

													#instead of making a better copy for pageF and pageI i will just copy pageF for pageI for now

													if(isset($_GET['pageI'])){
														// check for numeric
														if(is_numeric($_GET['pageI'])){
															// check for negative numbers
															if($_GET['pageI'] > 1){
																// good
																$pageI = mysqli_real_escape_string($conn, $_GET['pageI']);
																$offsetPREI = $pageI * 10;
																$offsetI = $offsetPREI - 10;
																$nPageI = mysqli_real_escape_string($conn, $_GET['pageI']) + 1;
																$bPageI = $pageI = mysqli_real_escape_string($conn, $_GET['pageI']) - 1;
															}else{
																#$pageF = 1;
																$offsetI = 0;
																$nPageI = 2;
																$bPageI = 1;
															}
														}else{
															#$pageF = 1;
															$offsetI = 0;
															$nPageI = 2;
															$bPageI = 1;
														}
													}else{
														#$pageF = 1;
														$offsetI = 0;
														$nPageI = 2;
														$bPageI = 1;
													}

													// Check if they have friends
													$hasFriendsQ = mysqli_query($conn,"SELECT * FROM `ec_friends` WHERE `SENDER_ID`='$profile[ID]' AND `ACCEPTED`='YES' OR `RECEIVE_ID`='$profile[ID]' AND `ACCEPTED`='YES' ORDER BY `ID` ASC LIMIT 8 OFFSET $offset");
													$hasFriends = mysqli_num_rows($hasFriendsQ);
													if($hasFriends > 0){
														// They have friends
														while($Friends = mysqli_fetch_array($hasFriendsQ)){
															if($Friends['SENDER_ID']==$profile['ID']){
																// Good to go
																$otherUserRecQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$Friends[RECEIVE_ID]'"); // other user request id
																$otherUserRec = mysqli_fetch_array($otherUserRecQ);
																echo"
																	<div style='display:inline-block;margin-left:15px;margin:0px;'><a href='../User/?id=$otherUserRec[ID]'><br><img style='width:99px;height:161px;' src='$otherUserRec[AVATAR_IMG_URL]'></img><br><text style='margin:0px;font-weight:bold;font-size:12.5px;'>$otherUserRec[USERNAME]</text></a><br><br></div>
																";
															}else{
																// not sender? than we are receiver!
																$otherUserSenQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$Friends[SENDER_ID]'"); // other user request id
																$otherUserSen = mysqli_fetch_array($otherUserSenQ);
																echo"
																	<div style='display:inline-block;margin-left:15px;margin:0px;'><a href='../User/?id=$otherUserSen[ID]'><br><img style='width:99px;height:161px;' src='$otherUserSen[AVATAR_IMG_URL]'></img><br><text style='margin:0px;font-weight:bold;font-size:12.5px;'>$otherUserSen[USERNAME]</text></a><br><br></div>
																";
															}
														}
													}else{
														// No Friends
														// if page is set shill, bai!
														if(isset($_GET['pageF'])){
															// go back or refresh idc
															echo"<script>window.location='../User/?id=$profile[0]';</script>";
														}else{
															echo"<text style='font-size:15px;float:left;color:grey;'>This user has no friends :(</text>";
														}
													}
												echo"
												<br>";
												if(mysqli_num_rows($hasFriendsQ) > 0){
													echo"<a class='fa fa-chevron-circle-left' href='?id=$profile[0]&pageF=$bPage'></a>  |  <a class='fa fa-chevron-circle-right' href='?id=$profile[0]&pageF=$nPage'></a>";
												}else{
													// dont echo anything
												}
												echo"
											</div>

											<div style='margin-bottom:10px;border:1px solid;border-radius:5px;padding:5px;width:950;display:inline-block;'>
												<h2 style='text-align:left;'>$profile[USERNAME]'s Items</h2>
												";
												// Get Items
												// Check if they have items
												$hasItemsQ = mysqli_query($conn,"SELECT * FROM `ec_crate` WHERE `USER_ID` = '$profile[ID]' LIMIT 10 OFFSET $offsetI");
												$hasItems = mysqli_num_rows($hasItemsQ);
												if($hasItems > 0){
													// They have items
													while($crateInfo = mysqli_fetch_array($hasItemsQ)){
														$HatQ = mysqli_query($conn, "SELECT * FROM `ec_items` WHERE `ID`='$crateInfo[ITEM_ID]'");
														$Hat = mysqli_fetch_array($HatQ);
														if($Hat['RARE']=='YES'){
															$borderC = "red";
														}else{
															$borderC = "black";
														}

														if($Hat[0]==-1){
															echo "";
														}else{
															echo"
															<a href='../Emporium/item.php?id=$Hat[0]'>
															<div style='z-index:0;position: relative;border:1px solid $borderC;display:inline-block;border-radius:5px;padding:0px;padding-bottom:0px;margin-right:10px;'>
																<img src='$Hat[PREVIEW_IMG_URL]' title='$Hat[NAME]'>";
																if($Hat['RARE']=='YES' && $crateInfo['SERIAL']!=0){
																	echo"<div style='position:absolute;top:0px;right:0px;border:1px solid red;padding:2.5px;font-size:12.5px;border-top-right-radius:0px;border-top:0px;border-right:0px;'>#$crateInfo[SERIAL]</div>";
																}
																echo"
															</div></a>
															";
														}
													}
												}else{
													// No items
													if(isset($_GET['pageI'])){
														# no items on page, go main
														echo"<script>alert('No items on this page!')</script>";
														echo"<script>window.location='../User/?id=$profile[0]';</script>";
														exit;
													}else{
														echo"<text style='font-size:15px;float:left;color:grey;'>This user has no items :(</text>"; #no items at all
													}
												}

												if(mysqli_num_rows($hasItemsQ) > 0){
													echo"<br><br><a class='fa fa-chevron-circle-left' href='?id=$profile[0]&pageI=$bPageI'></a>  |  <a class='fa fa-chevron-circle-right' href='?id=$profile[0]&pageI=$nPageI'></a>";
												}else{
													// dont echo anything
												}

												// Declare Stats variables
												// Veteran rewards
												if($profile['LAST_ONLINE'] - 2629743 >= $profile['JOINED'] && $profile['JOINED'] + 7776000 > $profile['LAST_ONLINE']){
													// Bronze Tier, only been on for a month
													$joinedColor = "#996d26";
												}else if($profile['LAST_ONLINE'] - 7776000 >= $profile['JOINED'] && $profile['JOINED'] + 16848000 > $profile['LAST_ONLINE']){
													// Silver Tier, 3 months since joined
													$joinedColor = "grey";
												}else if($profile['LAST_ONLINE'] - 16848000 >= $profile['JOINED']){
													// Gold Tier, 6.5 months since Joined // Badges awarded in header!
													$joinedColor = "#e8cf14";
												}else{
													// Dirt crap color
													$joinedColor = "#423f27";
												}

												// Forum post Rewards!
												if($profile['FORUM_POSTS'] >= 100 && $profile['FORUM_POSTS'] < 500){
													// Bronze Tier
													$forumColor = "#996d26";
												}else if($profile['FORUM_POSTS'] >= 500 && $profile['FORUM_POSTS'] < 1000){
													// Silver Tier
													$forumColor = "grey";
												}else if($profile['FORUM_POSTS'] >= 1000){
													// Gold Tier
													$forumColor = "#e8cf14";
												}else{
													// Dirt crap color, less than 100 posts xd
													$forumColor = "#423f27";
												}

												// Vip
												if($profile['VIP']=='NONE'){
													$profileVip = "None";
													$vipBackground = "grey";
												}else if($profile['VIP']=='VIP'){
													$profileVip = "Basic";
													$vipBackground = "background: linear-gradient(to bottom, #cb60b3 0%,#c146a1 50%,#a80077 51%,#db36a4 100%);";
												}else if($profile['VIP']=='MEGA_VIP'){
													$profileVip = "M E G A";
													$vipBackground = "background: linear-gradient(to bottom, #f3c5bd 0%,#e86c57 50%,#ea2803 51%,#ff6600 75%,#c72200 100%);";
												}

												// Gender
												if($profile['GENDER']=='M'){
													$genderColor = "blue";
													$profileGender = "Male";
												}else{
													$genderColor = "#ff28f0";
													$profileGender = "Female";
												}


												$joinedDate = gmdate("j F Y", $profile['JOINED']);
												echo"
											</div>

											<div style='border:1px solid;border-radius:5px;padding:5px;width:950;display:inline-block;'>
												<h4 style='text-align:left;'>$profile[USERNAME]'s Stats</h4>
												<div><center>
													<div style='padding:10px;padding-left:35px;padding-right:35px;margin-left:25px;margin-right:25px;background-color:$joinedColor;border-radius:5px;color:white;display:inline-block;'>
														<b>Joined</b><br>
														<text style='font-size:13.5px;'>$joinedDate</text>
													</div>

													<div style='padding:10px;padding-left:35px;padding-right:35px;margin-left:25px;margin-right:25px;background-color:$forumColor;border-radius:5px;color:white;display:inline-block;'>
														<b>Forum posts</b><br>
														<text style='font-size:13.5px;'>$profile[FORUM_POSTS]</text>
													</div>

													<div style='padding:10px;padding-left:35px;padding-right:35px;margin-left:25px;margin-right:25px;background-color:grey;$vipBackground;border-radius:5px;color:white;display:inline-block;'>
														<b>V I P</b><br>
														<text style='font-size:13.5px;'>$profileVip</text>
													</div>

													<div style='padding:10px;padding-left:35px;padding-right:35px;margin-left:25px;margin-right:25px;background-color:$genderColor;border-radius:5px;color:white;display:inline-block;'>
														<b>Gender</b><br>
														<text style='font-size:14.5px;'>$profileGender</text>
													</div>
												</center></div>
											</div>
										</div><br><br>
			<font color='red'><div style='border:4px solid;border-radius:5px;padding:5px;width:150;display:inline-block;'></font>
												<div><center>									<font color='green'>	<h4><a style='padding:10px;font-size:13.5px;color:red' href='../Mod/report.php?id=$profile[0]'>REPORT *$profile[USERNAME]*</a></h4></font>
										<div style='height:180px;'></div> <!-- SPACE -->
								</div>
							</div>
						</center>
					</body>";
					}else{
						// Dont Exist, send erm out
						echo"<script>window.location='../Search';</script>";

				}
				}else{
				// Go to dashboard
				echo"<script>window.location='../Dashboard';</script>";
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
