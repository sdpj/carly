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
					<div style='height:115px;'></div> <!-- SPACE -->";
					// Get forum tables
					$forumQ = mysqli_query($conn, "SELECT * FROM `ec_forums` WHERE 1");
					while($forum = mysqli_fetch_array($forumQ)){
						echo"<a href='table.php?id=$forum[0]'><div id='platform' style='text-align:left;width:1200px; margin-bottom:10px; border:1px solid black;background-color:white;padding:20px;'>
								<div style='display:inline-block;width:50%;'><text style='font-size:20px;margin-right:10px;'>$forum[NAME]</text> <text style='font-size:11;'>$forum[DESCRIPTION]</text></div>
								<div style='display:inline-block;float:right;'>
									<div style='display:inline-block;margin-right:40px;'><text style='font-size:15px;'>Threads</text><br><center><text style='font-size:11;'>$forum[THREADS]</text></center></div>
									<div style='display:inline-block;margin-right:40px;'><text style='font-size:15px;'>Posts</text><br><center><text style='font-size:11;'>$forum[POSTS]</text></center></div>
									<div style='display:inline-block;'><text style='font-size:15px;'>Last poster</text><br><center><text style='font-size:11;'>";
									// Get last poster
									$lastPostQ = mysqli_query($conn, "SELECT * FROM `ec_forum_posts` WHERE `TABLE_ID`='$forum[ID]' ORDER BY `TIME` DESC LIMIT 1");
									$lastPost = mysqli_fetch_array($lastPostQ);
									$lastUserQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$lastPost[USER_ID]'");
									$lastUser = mysqli_fetch_array($lastUserQ);
									if(mysqli_num_rows($lastUserQ) < 1){
										echo"No one!";
									}else{
										echo "<a href='../User/?id=$lastUser[0]' style='font-size:11px;'>$lastUser[1]</a>";
									}
									
									
									echo "</text></center></div>
								</div>
							</div></a>";
					}
			echo"
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
