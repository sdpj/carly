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
			echo"
				<center>
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
							";
			// check if they are accepting a request.
			if(isset($_GET['accept'])){
				// see if it is numeric
				if(is_numeric($_GET['accept'])){
					// good to go pretty much. for the shills that will use negative numbers that wont mean anything.
					// check if request is sent for them. or they could accept any old request.
					$requestId = mysqli_real_escape_string($conn, $_GET['accept']);
					$forUs = mysqli_query($conn,"SELECT * FROM `ec_friends` WHERE `ID`='$requestId' AND `RECEIVE_ID`='$user[0]'");
					if(mysqli_num_rows($forUs) > 0){
						// good to go
						mysqli_query($conn, "UPDATE `ec_friends` SET `ACCEPTED`='YES' WHERE `ID`='$requestId'");
						// send a message saying fr accepted by us!
						$receive_idQ = mysqli_query($conn, "SELECT `SENDER_ID` FROM `ec_friends` WHERE `ID`='$requestId'");
						$receive_id = mysqli_fetch_array($receive_idQ);
						$curtime = time();
						mysqli_query($conn, "INSERT INTO `ec_messages` VALUES (NULL, '1', '$receive_id[SENDER_ID]', 'Friend Request Accepted!', '$user[USERNAME] has accepted your friend request!', 'HIGHLY ADVISED NOT TO REPLY TO SYSTEM MESSAGE! GO BACK!', '$curtime', 'NO')"); // id 1 becauses owner :)
						// refresh page without get data
						echo"<script>window.location='../Friends/';</script>";
					}else{
						// nah not updating.
						echo"Error: CODE SHILL";
					}
				}
			}

			if(isset($_GET['declined'])){
				// see if it is numeric
				if(is_numeric($_GET['decline'])){
					// good to go pretty much. for the shills that will use negative numbers that wont mean anything.
					// check if request is sent for them. or they could accept any old request.
					$requestId = mysqli_real_escape_string($conn, $_GET['declined']);
					$forUs = mysqli_query($conn,"SELECT * FROM `ec_friends` WHERE `ID`='$requestId' AND `RECEIVE_ID`='$user[0]'");
					if(mysqli_num_rows($forUs) > 0){
						// good to go
						mysqli_query($conn, "UPDATE `ec_friends` SET `DECLINED`='YES' WHERE `ID`='$requestId'");
						// send a message saying fr accepted by us!
						$receive_idQ = mysqli_query($conn, "SELECT `SENDER_ID` FROM `ec_friends` WHERE `ID`='$requestId'");
						$receive_id = mysqli_fetch_array($receive_idQ);
						$curtime = time();
						mysqli_query($conn, "INSERT INTO `ec_messages` VALUES (NULL, '1', '$receive_id[SENDER_ID]', 'Friend Request Declined!', '$user[USERNAME] has declined your friend request!', 'HIGHLY ADVISED NOT TO REPLY TO SYSTEM MESSAGE! GO BACK!', '$curtime', 'NO')"); // id 1 becauses owner :)
						// refresh page without get data
						echo"<script>window.location='../Friends/';</script>";
					}else{
						// nah not updating.
						echo"Error: CODE SHILL";
					}
				}
			}
			
			if(isset($_GET['unfr'])){
				$id = mysqli_real_escape_string($conn,$_GET['unfr']);
				echo "<h1>Unfriending will work soon</h1>";
			}

			// check if they are 

			// Check if a request is sent
			if(isset($_GET['request'])){
				if(is_numeric($_GET['request'])){
					// good to go
					if($_GET['request']==$user['ID']){
						// dont send anything, go back
						echo"<script>window.history.back();</script>";
					}else{
						// Check if they are friends
						$receive_id = mysqli_real_escape_string($conn,$_GET['request']);
						$areFriends = mysqli_query($conn,"SELECT * FROM `ec_friends` WHERE `SENDER_ID`='$user[0]' AND `RECEIVE_ID`='$receive_id' AND `ACCEPTED`='YES' OR `SENDER_ID`='$receive_id' AND `RECEIVE_ID`='$user[0]' AND `ACCEPTED`='YES'");
						if(mysqli_num_rows($areFriends) > 0){
							// they are friends dont send anything
							echo"<i>You are already friends with this user!</i><br>";
						}else{
							// not accepted, check for pending
							$areFriendsP = mysqli_query($conn,"SELECT * FROM `ec_friends` WHERE `SENDER_ID`='$user[0]' AND `RECEIVE_ID`='$receive_id' AND `PENDING`='YES' OR `SENDER_ID`='$receive_id' AND `RECEIVE_ID`='$user[0]' AND `PENDING`='YES'");
							if(mysqli_num_rows($areFriendsP)>0){
								echo"<i>You already sent a friend request to this user!</i><br>";
							}else{
								// check if user is real
								$userReal = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$receive_id'");
								if(mysqli_num_rows($userReal) > 0){
									// real account, send FR +  message to user!
									$curtime = time();
									mysqli_query($conn, "INSERT INTO `ec_friends` VALUES(NULL,'$user[0]','$receive_id','YES','NO','NO')");
									mysqli_query($conn, "INSERT INTO `ec_messages` VALUES (NULL, '1', '$receive_id', 'Friend Request Received!', 'You have a new friend request!', 'HIGHLY ADVISED NOT TO REPLY TO SYSTEM MESSAGE! GO BACK!', '$curtime', 'NO')"); // id 1 becauses owner :)
									echo"<h3 style='color:green;'>Friend Request Sent!</h3>";
								}else{
									// nope. not doing anything
									echo"<i>User does not exist!</i>";
								}
							}
						}
					}
				}else{
					// bye felcia
				header("Location: ../"); exit;
				}
			}else{
				// no bye
				#header("Location: ../"); exit;
			}
			
			// Load friends with pagination
			if(isset($_GET['page'])){
				if(is_numeric($_GET['page'])){
					// good
					$page = mysqli_real_escape_string($conn, $_GET['page']);
					if($page < 1 || $page == 0){
						// bye felica
						echo"<script>window.location='?page=1';</script>";
					}
					
					if($page == 1){
						$offset = 0;
						$nPage = 2;
						$bPage = 1;
					}else{
						$offsetPRE = $page * 20;
						$offset = $offsetPRE - 10;
						$nPage = $page+1;
						$bPage = $page-1;
					}
				}else{
					// bye felica
					header("Location: ../"); exit;
				}
			}else{
				$page = 1;
				$nPage = 2;
				$bPage = 1;
				$offset = 0;
			}

			// Get requests
			$requestsQ = mysqli_query($conn, "SELECT * FROM `ec_friends` WHERE `RECEIVE_ID`='$user[0]' AND `PENDING`='YES' AND `ACCEPTED`='NO' LIMIT 15");
			if(mysqli_num_rows($requestsQ) > 0){
				// They have pending, lets show
				while($requests = mysqli_fetch_array($requestsQ)){
					// get sender info
					$SenderQ = mysqli_query($conn,"SELECT * FROM `ec_users` WHERE `ID`='$requests[SENDER_ID]'");
					$Sender = mysqli_fetch_array($SenderQ);
					echo"
					<div style='display:inline-block;margin-left:15px;padding:7.5px;'><a href='../User/?id=$Sender[0]'><text style='margin-bottom:0px;font-weight:bold;'>$Sender[USERNAME]</text><br><img src='$Sender[AVATAR_IMG_URL]'></img></a><br><br>
					<a style='border:1px solid green;padding:2.5px;color:green;font-weight:bold;' href='?accept=$requests[ID]'>Accept</a>
					<a style='border:1px solid red;padding:2.5px;color:red;font-weight:bold;' href='?decline=$requests[ID]'>Decline</a>
					</div>
					";
				}
			}

			echo"<h2>Your Friends</h2>";
			// check if has friends
			$hasFriends = mysqli_query($conn, "SELECT * FROM `ec_friends` WHERE `SENDER_ID`='$user[0]'  AND `ACCEPTED`='YES' OR `RECEIVE_ID`='$user[0]' AND `ACCEPTED`='YES' ORDER BY `ID` LIMIT 20 OFFSET $offset");
			if(mysqli_num_rows($hasFriends) > 0){
				// load
				while($Friends = mysqli_fetch_array($hasFriends)){
					// CHECK IF were the sender or receiver
					if($Friends['SENDER_ID']==$user['ID']){
						// Good to go
						$otherUserRecQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$Friends[RECEIVE_ID]'"); // other user request id
						$otherUserRec = mysqli_fetch_array($otherUserRecQ);
						echo"
							<div style='display:inline-block;margin-left:15px;padding:7.5px;'><a href='../User/?id=$otherUserRec[ID]'><text style='margin-bottom:0px;font-weight:bold;'>$otherUserRec[USERNAME]</text><br><img src='$otherUserRec[AVATAR_IMG_URL]'></img></a><br><br>
								<a style='font-size:10px;padding:2.5px;color:grey;font-weight:bold;' href='?unfr=$Friends[ID]'>Unfriend</a>
							</div>
						";
					}else{
						// not sender? than we are receiver!
						$otherUserSenQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$Friends[SENDER_ID]'"); // other user request id
						$otherUserSen = mysqli_fetch_array($otherUserSenQ);
						echo"
							<div style='display:inline-block;margin-left:15px;padding:7.5px;'><a href='../User/?id=$otherUserSen[ID]'><text style='margin-bottom:0px;font-weight:bold;'>$otherUserSen[USERNAME]</text><br><img src='$otherUserSen[AVATAR_IMG_URL]'></img></a><br><br>
								<a style='font-size:10px;padding:2.5px;color:grey;font-weight:bold;' href='?unfr=$Friends[ID]'>Unfriend</a>
							</div>
						";
					}
				}
			}else{
				// no friends
				echo"<i>You have no friends! :(</i>";
			}

			// if no friends and page isset. bye!
			if(isset($_GET['page']) && mysqli_num_rows($hasFriends) < 1){
				echo"<script>window.history.back()</script>";
			}
			echo"<br><br>
			<a style='color:grey;font-size:20px;padding-right:7.5px;' href='?page=$bPage' class='fa fa-chevron-circle-left'></a>   $page  <a style='color:grey;font-size:20px;padding-left:7.5px;' href='?page=$nPage' class='fa fa-chevron-circle-right'></a>
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
