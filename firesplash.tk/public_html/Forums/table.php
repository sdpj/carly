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
					// Get threads
					$tableId = mysqli_real_escape_string($conn, $_GET['id']);
					
					if($tableId < 1){
						// Bye felica
						header("Location: ../"); exit;

					}

					echo "<div id='platform' style='text-align:right;width:900px; margin-bottom:0px; background-color:transparent;padding:2.5px;'>
					<a href='newThread.php?id=$tableId'><button style='border-radius:0px;padding:5px;'>New Thread</button></a>
					</div>";

					if(is_numeric($tableId)){
						$threadsQ = mysqli_query($conn, "SELECT * FROM `ec_forum_threads` WHERE `TABLE_ID`='$tableId' ORDER BY `LAST_TIME` DESC LIMIT 30");
						$pinnedThreadsQ = mysqli_query($conn, "SELECT * FROM `ec_forum_threads` WHERE `PINNED`='YES' AND `TABLE_ID`='$tableId'");
						$hasThreads = mysqli_num_rows($threadsQ);
						$hasPinnedThreads = mysqli_num_rows($pinnedThreadsQ);
						if($hasThreads > 0){
							if($hasPinnedThreads > 0){
								// Show pinned threads
							while ($pinnedThreads = mysqli_fetch_array($pinnedThreadsQ)) {
								$prepreview = substr($pinnedThreads['BODY'], 0, 40);
								$preview = $prepreview."...";

								echo"<a href='thread.php?id=$pinnedThreads[0]'><div id='platform' style='text-align:left;width:900px; margin-bottom:10px; border:1px solid black;background-color:white;padding:20px;'>
									<div style='display:inline-block;width:50%;'><text style='font-size:20px;margin-right:10px;'>$pinnedThreads[TITLE]</text> <text style='font-size:11;'>$preview</text></div>
									<div style='display:inline-block;float:right;'>";
									if($pinnedThreads['LOCKED'] == "NO"){
										echo"<div style='display:inline-block;margin-right:40px;'><text style='font-size:15px;'> </text><br><center><text style='font-size:11;'> </text></center></div>";
									}else{
										echo"<div style='display:inline-block;margin-right:40px;'><text style='font-size:20px;'><i class='fa fa-lock'> </i></text><br><center><text style='font-size:11;'> </text></center></div>";
									}

									echo"<div style='display:inline-block;margin-right:40px;'><text style='font-size:20px;'><i class='fa fa-thumb-tack'> </i></text><br><center><text style='font-size:11;'> </text></center></div>";

									echo"<div style='display:inline-block;margin-right:40px;'><text style='font-size:15px;'>Replies</text><br><center><text style='font-size:11;'>";
									$pinnedRepliesQ = mysqli_query($conn, "SELECT * FROM `ec_forum_posts` WHERE `THREAD_ID`='$pinnedThreads[ID]'");
									$pinnedReplies = mysqli_num_rows($pinnedRepliesQ);
									echo $pinnedReplies; 
									echo"</text></center></div>";

									//  replies
									echo"
									<div style='display:inline-block;'><text style='font-size:15px;'>Author</text><br><center><text style='font-size:11;'>";
										$AuthorQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$pinnedThreads[USER_ID]'");
										$Author = mysqli_fetch_array($AuthorQ);
										if(strlen($Author[1]) > 6){
											$length = strlen($Author[1]);
											$name = substr($Author[1], 0, 6)."..";
										}else{
											$name = $Author[1];
										}
										echo"<a style='font-size:11px;' href='../User/?id=$Author[0]'>$name</a>";
										echo "</text></center></div>
									</div>
								</div></a>";
							
							}

							}else{
								// Show nothing
							}
							
							while ($threads = mysqli_fetch_array($threadsQ)) {
							$prepreview = substr($threads['BODY'], 0, 40);
							$preview = $prepreview."...";
							if($threads['PINNED']=='YES'){
								// show nothing
							}else{
							echo"<a href='thread.php?id=$threads[0]'><div id='platform' style='text-align:left;width:900px; margin-bottom:10px; border:1px solid black;background-color:white;padding:20px;'>
								<div style='display:inline-block;width:50%;'><text style='font-size:20px;margin-right:10px;'>$threads[TITLE]</text> <text style='font-size:11;'>$preview</text></div>
								<div style='display:inline-block;float:right;'>";
								if($threads['LOCKED'] == "NO"){
									echo"<div style='display:inline-block;margin-right:40px;'><text style='font-size:15px;'> </text><br><center><text style='font-size:11;'> </text></center></div>";
								}else{
									echo"<div style='display:inline-block;margin-right:40px;'><text style='font-size:20px;'><i class='fa fa-lock'> </i></text><br><center><text style='font-size:11;'> </text></center></div>";
								}

								echo"<div style='display:inline-block;margin-right:40px;'><text style='font-size:15px;'>Replies</text><br><center><text style='font-size:11;'>";
								$RepliesQ = mysqli_query($conn, "SELECT * FROM `ec_forum_posts` WHERE `THREAD_ID`='$threads[ID]'"); 
								$Replies = mysqli_num_rows($RepliesQ);
								echo $Replies;
								echo"</text></center></div>";

								//  replies
								echo"
								<div style='display:inline-block;'><text style='font-size:15px;'>Author</text><br><center><text style='font-size:11;'>";
									$AuthorQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `ID`='$threads[USER_ID]'");
									$Author = mysqli_fetch_array($AuthorQ);
									if(strlen($Author[1]) > 6){
										$length = strlen($Author[1]);
										$name = substr($Author[1], 0, 6)."..";
									}else{
										$name = $Author[1];
									}
									echo"<a style='font-size:11px;' href='../User/?id=$Author[0]'>$name</a>";
									echo "</text></center></div>
								</div>
							</div></a>";
							}
							
							}
						}else{
							echo"
							<div id='platform' style='width:1200px; border:1px solid black;background-color:white;padding:20px;'>
								This table has no threads!
							</div>
							";
						}
					}else{
						// Bye felica
						header("Location: ../"); exit;
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
