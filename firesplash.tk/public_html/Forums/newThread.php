<?php
	error_reporting(0);
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
			#error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE); # trying to stop errors
			if(isset($_POST['title']) && isset($_POST['body'])){
				// gottem!

				// for the shills out there
				$str = count(str_word_count($_POST['body'],1));
				$str2 = count(str_word_count($_POST['title'],1));
				if($str < 1 || $str2 < 1){
				echo"
				<center>
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;padding:20px;'>
						<h1>Create a new thread</h1>
							<form method='post' action=''>
							<input style='width:900px;border:1px solid;padding:5px;margin-bottom:5px;' name='title' placeholder='Title' maxnlength='30' required></input><br>
							<textarea name='body' style='width:900px;height:600px;' placeholder='Body' required> 
Title or body needs to be filled in!
							 </textarea><br>
							 <input name='locked' value='no' type='checkbox'>Locked?</input><br>
							 <button> Create! </button>
							</form>
						</div>
					</div>
				</center>
			</body>"; exit;
				}

				$title = strip_tags(mysqli_real_escape_string($conn, $_POST['title']));
				$body = strip_tags(mysqli_real_escape_string($conn, $_POST['body']));
				$tableId = mysqli_real_escape_string($conn, $_GET['id']);

				// check if they have a thread within last 5minutes
				$hasThreadQ = mysqli_query($conn, "SELECT * FROM `ec_forum_threads` WHERE `USER_ID`='$user[0]' ORDER BY `TIME` DESC LIMIT 1");
				$hasThread = mysqli_fetch_array($hasThreadQ);
				$curtime = time();
				$last5mins = $curtime - 300; //300 default
				if($last5mins < $hasThread['TIME']){
					// already posted last 5 mins
					echo"
				<center>
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;padding:20px;'>
						<h1>Create a new thread</h1>
							<form method='post' action=''>
							<input style='width:900px;border:1px solid;padding:5px;margin-bottom:5px;' name='title' placeholder='Title' maxnlength='30' required></input><br>
							<textarea name='body' style='width:900px;height:600px;' placeholder='Body' required disabled> 
You have already posted within the last 5 minutes
							 </textarea><br>
							 <input name='locked' value='no' type='checkbox' disabled>Locked?</input><br>
							 <button disabled> Create! </button>
							</form>
						</div>
					</div>
				</center>
			</body>";
			exit;

				}else{
					// see if they are a shill and posting the rules smh
					$search4 = "~ECSTAFF";
					$result = strpos($body, $search4);
					if($result == false){
						// check for checkbox 
						if(!isset($_POST['locked'])){
								$title2 = strip_tags(mysqli_real_escape_string($conn, $_POST['title'])); #why they wont update i will notknow #ahaha! strip tags must be on the outside
								$body2 = strip_tags(mysqli_real_escape_string($conn, $_POST['body']));
								$tableId2 = mysqli_real_escape_string($conn, $_GET['id']);
							mysqli_query($conn, "INSERT INTO `ec_forum_threads` VALUES(NULL,'$title2','$body2','$user[0]','NO','NO','$tableId','$curtime', '$curtime')");
							// update posts
							$curPosts = $user['FORUM_POSTS'];
							$newPosts = $curPosts+1;
							mysqli_query($conn,"UPDATE `ec_users` SET `FORUM_POSTS`='$newPosts' WHERE `ID`='$user[0]'");
							// get new thread
							$newTQ = mysqli_query($conn, "SELECT `ID` FROM `ec_forum_threads` WHERE `USER_ID`='$user[0]' ORDER BY `TIME` DESC LIMIT 1");
							$newT = mysqli_fetch_array($newTQ);
							#echo"<script>alert('$title2, $body2, $tableId2')</script>";
							echo"<script>window.location='thread.php?id=$newT[ID]';</script>";
						}else{
								$title2 = strip_tags(mysqli_real_escape_string($conn, $_POST['title'])); #why they wont update i will notknow #ahaha! strip tags must be on the outside
								$body2 = strip_tags(mysqli_real_escape_string($conn, $_POST['body']));
								$tableId2 = mysqli_real_escape_string($conn, $_GET['id']);
							mysqli_query($conn, "INSERT INTO `ec_forum_threads` VALUES(NULL,'$title2','$body2','$user[0]','YES','NO','$tableId','$curtime', '$curtime')");
							// update posts
							$curPosts = $user['FORUM_POSTS'];
							$newPosts = $curPosts+1;
							mysqli_query($conn,"UPDATE `ec_users` SET `FORUM_POSTS`='$newPosts' WHERE `ID`='$user[0]'");
							// get new thread
							$newTQ = mysqli_query($conn, "SELECT `ID` FROM `ec_forum_threads` WHERE `USER_ID`='$user[0]' ORDER BY `TIME` DESC LIMIT 1");
							$newT = mysqli_fetch_array($newTQ);
							#echo"<script>alert('$title2, $body2, $tableId2')</script>";
							echo"<script>window.location='thread.php?id=$newT[ID]';</script>";
						}
						
					}else{
						// shill #will edit this later
						header("Location: ../"); exit;
					}
				}

			}
			echo"
				<center>
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;padding:20px;'>
						<h1>Create a new thread</h1>
							<form method='post' action=''>
							<input style='width:900px;border:1px solid;padding:5px;margin-bottom:5px;' name='title' placeholder='Title' maxnlength='30' required></input><br>
							<textarea name='body' style='width:900px;height:600px;' placeholder='Body' required> 
Purposeful disregard to these rules will result in strong punishment against the offender.
1. Do not post explicit links or images
If it's not something you would show your mom, it's not something you should be showing kids.
2. Do not spam
This includes threads with seemingly no meaning, repetitive threads, and re-posting existing threads or ones that have been deleted already.
3. Be kind to other users
You will be banned if you post hatred, racist, sexist or any prejudice remarks.
4. Do not use profanity
5. Use the report button!
It's there for a reason - if you see anyone breaking these rules, report it.

please have fun and enjoy the site! ~ECSTAFF
							 </textarea><br>
							 <input name='locked' value='yes' type='checkbox'>Lock?</input><br>
							 <button> Create! </button>
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
