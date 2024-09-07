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
				$threadId = mysqli_real_escape_string($conn, $_GET['id']);
				if(is_numeric($threadId)){
					// check if thread exists!
					$exQ = mysqli_query($conn, "SELECT * FROM `ec_forum_threads` WHERE `ID`='$threadId'");
					if(mysqli_num_rows($exQ) > 0){
						echo"<script>console.log('~-!GOOD BOY TM!-~')</script>";
					}else{
						// bye felica
						echo"<script> window.history.back();</script>";
					}
				}else{
					// bye felica
					echo"<script> window.history.back();</script>";
				}
			}else{
				// bye felica
				echo"<script> window.history.back();</script>";
			}
			
			echo"
				<center>
					<div style='height:115px;'></div> <!-- SPACE -->";
					// Get original post
					$OPq = mysqli_query($conn, "SELECT * FROM `ec_forum_threads` WHERE `ID`='$threadId'");
					$OP = mysqli_fetch_array($OPq);
					// Get user
					$OPUserQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$OP[USER_ID]'");
					$OPUser = mysqli_fetch_array($OPUserQ);
					$threadTime = gmdate(" g:ia l M jS Y", $OP['TIME']);
					echo"
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;padding:20px;'>
						<h1 style='text-align:left;'>$OP[TITLE]</h1> <h5 style='text-align:right;'>
						$threadTime
						<br>
							<a href='../Report/?ThreadId=$OP[0]'>Report</a>
						<br>
						</h1>
						<div>
							<div style='display:inline-block;padding:2.5px;margin:0px;'>
									<a href='../User/?id=$OPUser[0]'>
										<img src='$OPUser[AVATAR_IMG_URL]'></img><br>
										$OPUser[1]<br><br>";

										// Get tag
										// Site Hieracrhy Status
										if($OPUser['POWER']=='MEMBER'){
											//echo "<text style='width:100px;font-size:15px;margin-top:5px;color:black;font-weight:bold;background-color:#ff7c19;padding:5px;border-radius:5px;margin-bottom:20px;padding-left:22.5px;padding-right:23px;'>Member</text><br><br>";
										}else if($OPUser['POWER']=='MODERATOR'){
											echo "<text style='width:100px;font-size:15px;margin-top:5px;color:black;font-weight:bold;background-color:purple;padding:5px;padding-left:30px;padding-right:30px;border-radius:5px;margin-bottom:20px;'>M O D</text><br><br>";
										}else if($OPUser['POWER']=='ADMIN'){
											echo "<text style='width:100px;font-size:15px;margin-top:5px;color:white;font-weight:bold;background-color:red;padding:5px;border-radius:5px;margin-bottom:20px;padding-left:27.5px;padding-right:27.5px;'>Admin</text><br><br>";
										}else if($OPUser['POWER']=='CO-FOUNDER'){
											echo "<text style='width:100px;font-size:12.5px;margin-top:5px;color:black;font-weight:bold;background: linear-gradient(red, yellow);;padding:5px;border-radius:5px;margin-bottom:20px;padding-left:27.5px;padding-right:27.5px;position:relative;'>Co-Founder</text><br><br>";
										}else if($OPUser['POWER']=='FOUNDER'){
											echo "<text style='width:100px;font-size:12.5px;margin-top:5px;color:black;font-weight:bold;background: linear-gradient(to right, red,orange,yellow,green,blue,indigo,violet);;padding:5px;border-radius:5px;margin-bottom:20px;padding-left:25px;padding-right:25px;position:relative;'>F O U N D E R</text><br><br>";
										//echo "<text style='width:100px;font-size:12.5px;margin-top:5px;color:black;font-weight:bold;background: linear-gradient(to right, red,orange,yellow,green,blue,indigo,violet);;padding:5px;border-radius:5px;margin-bottom:20px;padding-left:25px;padding-right:25px;position:relative;'>F O U N D E R</text><br><br>";
										}

										// MORE PHP CODE
										// Declare Stats variables
												// Veteran rewards
												if($OPUser['LAST_ONLINE'] - 2629743 >= $OPUser['JOINED'] && $OPUser['JOINED'] + 7776000 > $OPUser['LAST_ONLINE']){
													// Bronze Tier, only been on for a month
													$joinedColor = "#996d26";
												}else if($OPUser['LAST_ONLINE'] - 7776000 >= $OPUser['JOINED'] && $OPUser['JOINED'] + 16848000 > $OPUser['LAST_ONLINE']){
													// Silver Tier, 3 months since joined
													$joinedColor = "grey";
												}else if($OPUser['LAST_ONLINE'] - 16848000 >= $OPUser['JOINED']){
													// Gold Tier, 6.5 months since Joined // Badges awarded in header!
													$joinedColor = "#e8cf14";
												}else{
													// Dirt crap color
													$joinedColor = "#423f27";
												}

												// Forum post Rewards!
												if($OPUser['FORUM_POSTS'] >= 100 && $OPUser['FORUM_POSTS'] < 500){
													// Bronze Tier
													$forumColor = "#996d26";
												}else if($OPUser['FORUM_POSTS'] >= 500 && $OPUser['FORUM_POSTS'] < 1000){
													// Silver Tier
													$forumColor = "grey";
												}else if($OPUser['FORUM_POSTS'] >= 1000){
													// Gold Tier
													$forumColor = "#e8cf14";
												}else{
													// Dirt crap color, less than 100 posts xd
													$forumColor = "#423f27";
												}

												// Vip
												if($OPUser['VIP']=='NONE'){
													$OPUserVip = "None";
													$vipBackground = "grey";
												}else if($OPUser['VIP']=='VIP'){
													$OPUserVip = "Basic";
													$vipBackground = "background: linear-gradient(to bottom, #cb60b3 0%,#c146a1 50%,#a80077 51%,#db36a4 100%);";
												}else if($OPUser['VIP']=='MEGA_VIP'){
													$OPUserVip = "M E G A";
													$vipBackground = "background: linear-gradient(to bottom, #f3c5bd 0%,#e86c57 50%,#ea2803 51%,#ff6600 75%,#c72200 100%);";
												}

												// Gender
												if($OPUser['GENDER']=='M'){
													$genderColor = "blue";
													$OPUserGender = "Male";
												}else{
													$genderColor = "#ff28f0";
													$OPUserGender = "Female";
												}


												$joinedDate = gmdate("j F Y", $OPUser['JOINED']);
									echo"
								</a>
							</div>
								
							<div style='display:inline-block;width:1050px;margin:0px;'>
								<div style='display:inline-block;width:600px;margin-right:100px;'>
									<text style='font-size:15px;word-wrap: break-word;text-align:left;'>$OP[BODY]<br>________________________________________________________________________________________$OPUser[FORUM_SIG]</text><br><br>";
									// If not member, give mod tools
									if($user['POWER']!= "MEMBER"){
										if($OP['LOCKED']=='YES'){
											echo"<a style='font-size:12.5px;color:grey;' href='../Mod/forumtools.php?unlockThread=$OP[0]'>Unlock  |  </a>";
										}else{
											echo"<a style='font-size:12.5px;color:grey;' href='../Mod/forumtools.php?lockThread=$OP[0]'>Lock  |  </a>";
										}
										echo"<a style='font-size:12.5px;color:grey;' href='../Mod/forumtools.php?CensorThread=$OP[0]'>Censor  |  </a>";
										echo"<a style='font-size:12.5px;color:grey;' href='../Mod/forumtools.php?delThread=$OP[0]'>Delete  </a>";
									}

									if($user['POWER']!= "MEMBER" && $user['POWER']!="MODERATOR"){
										if($OP['PINNED']=='YES'){
											echo"<a style='font-size:12.5px;color:grey;' href='../Mod/forumtools.php?unpinThread=$OP[0]'>|  Unpin</a>";
										}else{
											echo"<a style='font-size:12.5px;color:grey;' href='../Mod/forumtools.php?pinThread=$OP[0]'>|  Pin</a>";
										}
									}

									echo"
								</div><br>
								
								<div style='display:inline-block;margin-top:50px;'>
									<div style='padding:5px;padding-left:35px;padding-right:35px;margin-left:25px;margin-right:25px;background-color:$joinedColor;border-radius:5px;color:white;display:inline-block;'>
										<b>Joined</b><br>
										<text style='font-size:8.5px;'>$joinedDate</text>
									</div>

									<div style='padding:5px;padding-left:35px;padding-right:35px;margin-left:25px;margin-right:25px;background-color:$forumColor;border-radius:5px;color:white;display:inline-block;'>
										<b>Forum posts</b><br>
										<text style='font-size:8.5px;'>$OPUser[FORUM_POSTS]</text>
									</div>

									<div style='padding:5px;padding-left:35px;padding-right:35px;margin-left:25px;margin-right:25px;background-color:grey;$vipBackground;border-radius:5px;color:white;display:inline-block;'>
										<b>V I P</b><br>
										<text style='font-size:8.5px;'>$OPUserVip</text>
									</div>

									<div style='padding:5px;padding-left:35px;padding-right:35px;margin-left:25px;margin-right:25px;background-color:$genderColor;border-radius:5px;color:white;display:inline-block;'>
										<b>Gender</b><br>
										<text style='font-size:8.5px;'>$OPUserGender</text>
									</div>
								</div>
							</div>
						";
						
						echo"
						</div>
					</center>
				<center>";
				// GEt replies TAKE IN MIND PAGINATION
				#$max = $page * 5;
				if(isset($_GET['page'])){
					$page = mysqli_real_escape_string($conn, $_GET['page']);
					if(is_numeric($page)){
						echo"<script>console.log('~-!GOOD BOY TM! (SEAL 2)-~')</script>";
					}else{
						// bye felica
						echo"<script>window.history.back();</script>";
					}
				}else{
					$page = 1;
				}

				$max = $page * 5;
				$min = $max - 5;
				
				$repliesQ = mysqli_query($conn, "SELECT * FROM `ec_forum_posts` WHERE `THREAD_ID` = '$OP[0]' ORDER BY `ID` ASC LIMIT 5 OFFSET $min");
				if(mysqli_num_rows($repliesQ) < 1){
					// No replies. check if page is more than one.
					if($page > 1){
						// bye felica
						echo"<script>window.history.back();</script>";
					}else{
						// let them stay
					}
				}

				while($replies = mysqli_fetch_array($repliesQ)){
					$RUserQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$replies[USER_ID]'");//replier user query
					$RUser = mysqli_fetch_array($RUserQ);
					$threadTime = gmdate(" g:ia l M jS Y", $replies['TIME']);
					// Declare Stats variables
												// Veteran rewards
												if($RUser['LAST_ONLINE'] - 2629743 >= $RUser['JOINED'] && $RUser['JOINED'] + 7776000 > $RUser['LAST_ONLINE']){
													// Bronze Tier, only been on for a month
													$joinedColor = "#996d26";
												}else if($RUser['LAST_ONLINE'] - 7776000 >= $RUser['JOINED'] && $RUser['JOINED'] + 16848000 > $RUser['LAST_ONLINE']){
													// Silver Tier, 3 months since joined
													$joinedColor = "grey";
												}else if($RUser['LAST_ONLINE'] - 16848000 >= $RUser['JOINED']){
													// Gold Tier, 6.5 months since Joined // Badges awarded in header!
													$joinedColor = "#e8cf14";
												}else{
													// Dirt crap color
													$joinedColor = "#423f27";
												}

												// Forum post Rewards!
												if($RUser['FORUM_POSTS'] >= 100 && $RUser['FORUM_POSTS'] < 500){
													// Bronze Tier
													$forumColor = "#996d26";
												}else if($RUser['FORUM_POSTS'] >= 500 && $RUser['FORUM_POSTS'] < 1000){
													// Silver Tier
													$forumColor = "grey";
												}else if($RUser['FORUM_POSTS'] >= 1000){
													// Gold Tier
													$forumColor = "#e8cf14";
												}else{
													// Dirt crap color, less than 100 posts xd
													$forumColor = "#423f27";
												}

												// Vip
												if($RUser['VIP']=='NONE'){
													$RUserVip = "None";
													$vipBackground = "grey";
												}else if($RUser['VIP']=='VIP'){
													$RUserVip = "Basic";
													$vipBackground = "background: linear-gradient(to bottom, #cb60b3 0%,#c146a1 50%,#a80077 51%,#db36a4 100%);";
												}else if($RUser['VIP']=='MEGA_VIP'){
													$RUserVip = "M E G A";
													$vipBackground = "background: linear-gradient(to bottom, #f3c5bd 0%,#e86c57 50%,#ea2803 51%,#ff6600 75%,#c72200 100%);";
												}

												// Gender
												if($RUser['GENDER']=='M'){
													$genderColor = "blue";
													$RUserGender = "Male";
												}else{
													$genderColor = "#ff28f0";
													$RUserGender = "Female";
												}


												$joinedDate = gmdate("j F Y", $RUser['JOINED']);

					echo"
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;padding:20px;margin-top:5px;'>
						<h5 style='text-align:right;'>$threadTime
							<br>
							<a href='../Report/?PostId=$replies[0]'>Report</a>
							<br>
						</h5>
						<div style='display:inline-block;'>
								<a href='../User/?id=$RUser[0]'>
								<img src='$RUser[AVATAR_IMG_URL]'></img><br>
								$RUser[1]<Br><br>";

								// Get tag
										// Site Hieracrhy Status
										if($RUser['POWER']=='MEMBER'){
											//echo "<text style='width:100px;font-size:15px;margin-top:5px;color:black;font-weight:bold;background-color:#ff7c19;padding:5px;border-radius:5px;margin-bottom:20px;padding-left:22.5px;padding-right:23px;'>Member</text><br><br>";
										}else if($RUser['POWER']=='MODERATOR'){
											echo "<text style='width:100px;font-size:15px;margin-top:5px;color:black;font-weight:bold;background-color:purple;padding:5px;padding-left:30px;padding-right:30px;border-radius:5px;margin-bottom:20px;'>M O D</text><br><br>";
										}else if($RUser['POWER']=='ADMIN'){
											echo "<text style='width:100px;font-size:15px;margin-top:5px;color:white;font-weight:bold;background-color:red;padding:5px;border-radius:5px;margin-bottom:20px;padding-left:27.5px;padding-right:27.5px;'>Admin</text><br><br>";
										}else if($RUser['POWER']=='CO-FOUNDER'){
											echo "<text style='width:100px;font-size:12.5px;margin-top:5px;color:black;font-weight:bold;background: linear-gradient(red, yellow);;padding:5px;border-radius:5px;margin-bottom:20px;padding-left:27.5px;padding-right:27.5px;position:relative;'>Co-Founder</text><br><br>";
										}else if($RUser['POWER']=='FOUNDER'){
											echo "<text style='width:100px;font-size:12.5px;margin-top:5px;color:#cecece;font-weight:bold;background:repeating-radial-gradient(circle,#840000,#840000 10px,#9b4c4c 10px,#9b4c4c 20px);padding:5px;border-radius:5px;margin-bottom:20px;padding-left:25px;padding-right:25px;position:relative;'>F O U N D E R</text><br><br>";
										//echo "<text style='width:100px;font-size:12.5px;margin-top:5px;color:black;font-weight:bold;background: linear-gradient(to right, red,orange,yellow,green,blue,indigo,violet);;padding:5px;border-radius:5px;margin-bottom:20px;padding-left:25px;padding-right:25px;position:relative;'>F O U N D E R</text><br><br>";
										}

								echo"
								</a>
							</div>

							<div style='display:inline-block;width:1050px;margin:0px;'>
								<div style='display:inline-block;width:600px;margin-right:100px;'>
									<text style='font-size:15px;word-wrap: break-word;text-align:left;'>$replies[BODY]<br>________________________________________________________________________________________$RUser[FORUM_SIG]</text><br><br>";
									// If not member, give mod tools
									if($user['POWER']!= "MEMBER"){
										echo"<a style='font-size:12.5px;color:grey;' href='../Mod/forumtools.php?CensorPost=$replies[0]'>Censor</a>";
									}
									echo"
								</div>

								<div style='display:inline-block;margin-top:50px;'>
									<div style='padding:5px;padding-left:35px;padding-right:35px;margin-left:25px;margin-right:25px;background-color:$joinedColor;border-radius:5px;color:white;display:inline-block;'>
										<b>Joined</b><br>
										<text style='font-size:8.5px;'>$joinedDate</text>
									</div>

									<div style='padding:5px;padding-left:35px;padding-right:35px;margin-left:25px;margin-right:25px;background-color:$forumColor;border-radius:5px;color:white;display:inline-block;'>
										<b>Forum posts</b><br>
										<text style='font-size:8.5px;'>$RUser[FORUM_POSTS]</text>
									</div>

									<div style='padding:5px;padding-left:35px;padding-right:35px;margin-left:25px;margin-right:25px;background-color:grey;$vipBackground;border-radius:5px;color:white;display:inline-block;'>
										<b>V I P</b><br>
										<text style='font-size:8.5px;'>$RUserVip</text>
									</div>

									<div style='padding:5px;padding-left:35px;padding-right:35px;margin-left:25px;margin-right:25px;background-color:$genderColor;border-radius:5px;color:white;display:inline-block;'>
										<b>Gender</b><br>
										<text style='font-size:8.5px;'>$RUserGender</text>
									</div>
								</div>

							</div>
						</div>
					";
				}
					/*if(isset($_GET['page'])){
						$page2 = mysqli_real_escape_string($conn, $_GET['page']);
						$newPage = $page2 + 1;
					}else{
						// cos current page = 1? get it? read codes above
						$newPage = 2;
					}

					$threadId2 = mysqli_real_escape_string($conn, $_GET['id']);*/
					$newPage = $page + 1;
					
					echo"
				</center>

				<center><Br><br>
					<a style='font-size:10px;background-color:white;border:1px solid;padding:2.5px;padding-right:30px;padding-left:30px;' onclick='goBack()'>Go back</a>";
					if($OP['LOCKED']=='YES'){
						echo" <a style='background-color:white; color:grey;border:1px solid grey;padding:5px;padding-right:30px;padding-left:30px;' disabled>Reply</a>";
					}else{
						echo" <a style='background-color:white;border:1px solid;padding:5px;padding-right:30px;padding-left:30px;' href='Reply.php?id=$threadId'>Reply</a>";
					} 
					echo"
					<a style='font-size:10px;background-color:white;border:1px solid;padding:2.5px;padding-right:30px;padding-left:30px;' href='thread.php?id=$threadId&page=$newPage'>Next page?</a>	
					<script>
					function goBack() {
					    window.history.back();
					}
					</script>		
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
