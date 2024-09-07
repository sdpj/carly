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
			include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/global.php' ); // vital last minute add :x
			echo"
				<center>
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:900px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
							<form method='post'>
								<input style='width:850px;' class='Ginput' placeholder='Search for a user, item or game' name='username' maxlength='20'></input>
							</form>";

							if(isset($_POST['username'])){
								$username = mysqli_real_escape_string($conn, $_POST['username']);
								$search = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `USERNAME` LIKE '%$username%'");
								$searchI = mysqli_query($conn, "SELECT * FROM `ec_items` WHERE `NAME` LIKE '%$username%'"); // not really username
								if(mysqli_num_rows($search) > 0 || mysqli_num_rows($searchI) > 0){
									echo"<h4 style='text-align:left;'>Search Results</h4>";
									while($names = mysqli_fetch_array($search)){
										echo"
								        <a href='/User/?id=$names[ID]'><div style='display:inline-block;'>
								        	<img src='$names[AVATAR_IMG_URL]'></img><br>
								       		$names[USERNAME]<br>
								       	</div></a>
								        ";
									}

									while($names = mysqli_fetch_array($searchI)){
										if($names['ID']=='-1'){
											echo"";
										}else{
										echo"
									        <a href='/Emporium/item.php?id=$names[ID]'><div style='display:inline-block;'>
									        	<img src='$names[AVATAR_IMG_URL]'></img><br>";
									        	if(strlen($names['NAME']) > 10){
									        		$hatN = substr($names['NAME'], 0, 9)."...";
									        	}else{
									        		$hatN = $names['NAME'];
									        	}
									        	echo"
									       		<name style='color:grey;'>$hatN</name><br>
									       	</div></a>
									        ";
								    	}
									}
								}else{
									echo "<h3>No Results!</h3>";
								}
							}

							echo"

							<h4 style='text-align:left;'>Online Users</h4>

							";
							// lets get online users online
							// users from last 5 minutes
							$last5mins = time() - 300;
							$result = mysqli_query($conn,"SELECT * FROM `ec_users` WHERE `LAST_ONLINE` > '$last5mins'");

							if (mysqli_num_rows($result) > 0) {
								    while($users = mysqli_fetch_array($result)) {
								        echo"
								        <a href='/User/?id=$users[ID]'><div style='display:inline-block;'>
								        	<img src='$users[AVATAR_IMG_URL]'></img><br>
								       		$users[USERNAME]<br>
								       	</div></a>
								        ";
								    }
								} else {
							    	echo "No users :(";
							}

							echo"<br><br>";
							// Check if ALL is set
							if(ISSET($_GET['All'])){
								echo"<h1 style='text-align:left;'>Users</h1>";
								// Check if page is set
								// Check if page is_numeric
								if(ISSET($_GET['page'])){
									if(is_numeric($_GET['page'])){
												$page = mysqli_real_escape_string($conn, $_GET['page']);
												$maxPageI = 1;
												$offsetPre = $page * 14;
												$offset = $offsetPre - 14;
												$nPage = mysqli_real_escape_string($conn, $_GET['page']) + 1;
												$bPage = mysqli_real_escape_string($conn, $_GET['page']) - 1;
												$CurrentUsersQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE 1 LIMIT 14 OFFSET $offset");
												while($UserInfo = mysqli_fetch_array($CurrentUsersQ)){
													echo"<div style='display:inline-block;'>
														<a href='../User/?id=$UserInfo[0]'>
														 <img src='$UserInfo[AVATAR_IMG_URL]' /><br>
														 ";
															 if(strlen($UserInfo['USERNAME']) > 15){
															 	$name = substr($UserInfo['USERNAME'], 0, -6)."...";
															 }else{
															 	$name = $UserInfo['USERNAME'];
															 }
														 echo"
														 	$name
														</a>
													</div>";
												}
												// get max page for or while? imma go while
												$AllUsers = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE 1");
												while($maxPageI <= mysqli_num_rows($AllUsers)){
													$maxPageI += 14;
												}
												
												$maxPage = round($maxPageI / 14);

												echo"<br><br><a style='padding-right:50px;font-size:12.5px;' href='?All&page=$bPage'>Back Page</a>  <a href='?All&page=1'>1</a>  |  <text style='font-size:12.5px;'>$page</text>  |  <a href='?All&page=$maxPage'>$maxPage</a>  <a style='padding-left:50px;font-size:12.5px;' href='?All&page=$nPage'>Next Page</a>";
										    }else{
										    	echo"Not a valid number!";
										    }
									}else{
										// Page no set
										echo"Invalid page number!";
									}

								}else{
									// Do nothing? No page
									echo "<a href='?All&page=1'><text style='font-size:15px;'>All Users?</text></a>";
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
