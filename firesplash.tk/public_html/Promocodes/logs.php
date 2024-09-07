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
			<body";
					if($ishalloweentheme == 0){echo"";}else{echo" style='background-color:black;'";}
					echo">";
			include( $_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/global.php' );
			echo"
				<center>
					<div style='height:115px;'></div> <!-- SPACE -->
						<div id='platform' style='width:1200px; border:1px solid black;background-color:";
					if($ishalloweentheme == 0){echo"#ddd";}else{echo"orange";}
					echo";border-radius:10px;padding:20px;'>
							<h1>Redeem Logs | <a href='/Promocodes/'>Return</a></h1>";
							if($user['POWER']!='ADMIN'&&$user['POWER']!='FOUNDER'&&$user['POWER']!='CO-FOUNDER'){
							    echo"<script>window.location='/';</script>";
							}else{
							$logsQ = mysqli_query($conn,"SELECT * FROM `promocode_redeems` WHERE 1");
							while(($logs = mysqli_fetch_array($logsQ))){
							    $uQ = mysqli_query($conn,"SELECT * FROM `ec_users` WHERE `ID` = '$logs[USER]'");
							    $u = mysqli_fetch_array($uQ);
							    $cQ = mysqli_query($conn,"SELECT * FROM `promocodes` WHERE `ID` = '$logs[CODE]'");
							    $c = mysqli_fetch_array($cQ);
							    echo"<p>$logs[ID] - <a href='/User/?id=$u[ID]'><u>$u[USERNAME]</u></a> redeemed <u>$c[CODE] ($c[ID])</u></a></p>";
							}}
		}
	}
?>