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

			if($user['POWER']=='MEMBER'){
				header("Location: ../"); exit;
			}

			if(isset($_GET['lockThread'])){
				$id = mysqli_real_escape_string($conn, $_GET['lockThread']);
				// see if thread is real
				$RealThread = mysqli_query($conn, "SELECT * FROM `ec_forum_threads` WHERE `ID`='$id'");
				if(mysqli_num_rows($RealThread) > 0){
				// do what get says
					mysqli_query($conn, "UPDATE `ec_forum_threads` SET `LOCKED`='YES' WHERE `ID`='$id'");
					//echo"<script>window.location='../'</script>";
					echo"<script>window.location='../Forums/thread.php?id=$id'</script>"; exit;
					//header("Location: ../Forums/thread.php?id=$id"); exit;
				}else{
					echo"<script>window.location='../'</script>"; exit;
					//header("Location: ../"); exit;
				}
			}elseif(isset($_GET['CensorThread'])){
				$id = mysqli_real_escape_string($conn, $_GET['CensorThread']);
				// see if thread is real
				$RealThread = mysqli_query($conn, "SELECT * FROM `ec_forum_threads` WHERE `ID`='$id'");
				if(mysqli_num_rows($RealThread) > 0){
					// do what get says
					mysqli_query($conn, "UPDATE `ec_forum_threads` SET `BODY`='[Content Censored #$user[0]]' WHERE `ID`='$id'");
					//header("Location: ../Forums/thread.php?id=$id"); exit;
					echo"<script>window.location='../Forums/thread.php?id=$id'</script>";
					echo"<script>window.location='../'</script>";
				}else{
					//header("Location: ../"); exit;
					echo"<script>window.location='../'</script>"; exit;
				}
			}elseif(isset($_GET['delThread'])){
				$id = mysqli_real_escape_string($conn, $_GET['delThread']);
				// see if thread is real
				$RealThread = mysqli_query($conn, "SELECT * FROM `ec_forum_threads` WHERE `ID`='$id'");
				if(mysqli_num_rows($RealThread) > 0){
					// do what get says
					$tableIdPRE = mysqli_fetch_array($RealThread);
					$tableId = $tableIdPRE['TABLE_ID'];
					mysqli_query($conn, "DELETE FROM `ec_forum_threads` WHERE `ID`='$id'");
					//header("Location: ../Forums/table.php?id=$tableId"); exit;
					echo"<script>window.location='../Forums/table.php?id=$tableId'</script>";
				}else{
					//header("Location: ../"); exit;
					echo"<script>window.location='../'</script>"; exit;
				}
			}elseif(isset($_GET['pinThread'])){
				if($user['POWER']=='MODERATOR'){
					header("Location: ../"); exit;
				}
				$id = mysqli_real_escape_string($conn, $_GET['pinThread']);
				// see if thread is real
				$RealThread = mysqli_query($conn, "SELECT * FROM `ec_forum_threads` WHERE `ID`='$id'");
				if(mysqli_num_rows($RealThread) > 0){
					// do what get says
					mysqli_query($conn, "UPDATE `ec_forum_threads` SET `PINNED`='YES' WHERE `ID`='$id'");
					echo"<script>window.location='../Forums/thread.php?id=$id'</script>";
				}else{
					echo"<script>window.location='../'</script>"; exit;
				}
			}elseif(isset($_GET['CensorPost'])) {
				$id = mysqli_real_escape_string($conn, $_GET['CensorPost']);
				// see if thread is real
				$RealPost = mysqli_query($conn, "SELECT * FROM `ec_forum_posts` WHERE `ID`='$id'");
				if(mysqli_num_rows($RealPost) > 0){
					// do what get says
					$threadIdPre = mysqli_fetch_array($RealPost);
					$threadId = $threadIdPre['THREAD_ID'];
					mysqli_query($conn, "UPDATE `ec_forum_posts` SET `BODY`='[Censored Post #$user[0]]' WHERE `ID`='$id'");
					echo"<script>window.location='../Forums/thread.php?id=$id'</script>";
				}else{
					echo"<script>window.location='../'</script>"; exit;
				}
			}elseif(isset($_GET['unpinThread'])){
				$id = mysqli_real_escape_string($conn, $_GET['unpinThread']);
				// see if thread is real
				$RealThread = mysqli_query($conn, "SELECT * FROM `ec_forum_threads` WHERE `ID`='$id'");
				if(mysqli_num_rows($RealThread) > 0){
				// do what get says
					mysqli_query($conn, "UPDATE `ec_forum_threads` SET `PINNED`='NO' WHERE `ID`='$id'");
					echo"<script>window.location='../Forums/thread.php?id=$id'</script>";
				}else{
					echo"<script>window.location='../'</script>"; exit;
				}
			}elseif(isset($_GET['unlockThread'])){
				$id = mysqli_real_escape_string($conn, $_GET['unlockThread']);
				// see if thread is real
				$RealThread = mysqli_query($conn, "SELECT * FROM `ec_forum_threads` WHERE `ID`='$id'");
				if(mysqli_num_rows($RealThread) > 0){
				// do what get says
					mysqli_query($conn, "UPDATE `ec_forum_threads` SET `LOCKED`='NO' WHERE `ID`='$id'");
					//header("Location: ../Forums/thread.php?id=$id"); exit;
					echo"<script>window.location='../Forums/thread.php?id=$id'</script>";
				}else{
					echo"<script>window.location='../'</script>"; exit;
				}
			}else{
				echo"<script>window.location='../'</script>"; exit;
			}
			echo"
				<center>
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:1200px; border:1px solid black;background-color:white;border-radius:10px;padding:20px;'>
							TEST
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
