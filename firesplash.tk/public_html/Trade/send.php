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
			if(isset($_POST['trade']) && isset($_POST['SenderId']) && is_numeric($_POST['SenderId']) && isset($_POST['ReceiverId']) && is_numeric($_POST['ReceiverId'])){
			if(isset($_POST['ReqMoney']) && is_numeric($_POST['ReqMoney']) && $_POST['ReqMoney']>-1 && isset($_POST['SendMoney']) && is_numeric($_POST['SendMoney']) && $_POST['SendMoney']>-1){
				$ReqMoney = round(mysqli_real_escape_string($conn, $_POST['ReqMoney']));
				$SendMoney = round(mysqli_real_escape_string($conn, $_POST['SendMoney']));
			}else{
				$ReqMoney = 0;
				$SendMoney = 0;
			}

			$curtime = time();
			$trade = mysqli_real_escape_string($conn, $_POST['trade']);
			$SenderId = mysqli_real_escape_string($conn, $_POST['SenderId']);
			$ReceiverId = mysqli_real_escape_string($conn, $_POST['ReceiverId']);
			$OurTCIds = array();# our trade cart Ids
			$TheirTCIds = array();# their trade cart Ids
			
			if($trade=="|"){
				echo"<script>window.history.back();</script>"; exit;
			}
			// see if user exists
			// crack the trade
			$tradeCartArray = str_split($trade);
			$switch = 0;
			$temp = "";
			for($i = 0; $i < count($tradeCartArray); $i++){
				if($tradeCartArray[$i]=='.'){
					if($switch>0){
						array_push($TheirTCIds, $temp);
						$temp = "";
					}else{
						array_push($OurTCIds, $temp);
						$temp = "";
					}
				}elseif($tradeCartArray[$i]=='|'){
					$switch++;
				}else{
					$temp.=$tradeCartArray[$i];
				}
			}

			// see if sender is real and receiver is real, see if they have the valid items
			// we are the sender, check our items first
			foreach($OurTCIds as $crateIds){
				$check = mysqli_query($conn, "SELECT * FROM `ec_crate` WHERE `ID`='$crateIds' AND `USER_ID`='$user[0]'"); // or sender Id
				if(mysqli_num_rows($check) < 1){
					echo"<script>alert('Please Leave')</script>";
					// report hack attempt
					mysqli_query($conn, "INSERT INTO `ec_mod_logs` VALUES(NULL, '$user[0]', '$user[0]', 'Tried To Hack The Site', '$curtime')");
					echo"<script>window.location='http://google.com'</script>"; exit;
				}
			}

			// check receiver items are indeed valid
			foreach($TheirTCIds as $crateIds){
				$check = mysqli_query($conn, "SELECT * FROM `ec_crate` WHERE `ID`='$crateIds' AND `USER_ID`='$ReceiverId'"); // or sender Id
				if(mysqli_num_rows($check) < 1){
					echo"<script>alert('Please Leave')</script>";
					// report hack attempt
					mysqli_query($conn, "INSERT INTO `ec_mod_logs` VALUES(NULL, '$user[0]', '$user[0]', 'Tried To Hack The Site', '$curtime')");
					echo"<script>window.location='http://google.com'</script>"; exit;
				}
			}

			// check if one side is full and other is empty
			if(count($TheirTCIds) < 1){
				echo"<script>window.history.back();</script>"; exit;
			}

			if(count($OurTCIds) < 1){
				echo"<script>window.history.back();</script>"; exit;
			}

			// all items are valid with users correct IDs. send trade
			mysqli_query($conn, "INSERT INTO `ec_trades` VALUES(NULL, '$trade', '$user[0]', '$ReceiverId', 'PENDING', '$SendMoney', '$ReqMoney')");
			echo"<script>alert('Trade Sent!')</script>";
			mysqli_query($conn, "INSERT INTO `ec_messages` VALUES(NULL, '1','$ReceiverId','You have a new Trade!','You have a new trade? Open the gear and press trades!','','$curtime','NO')");
			echo"<script>window.location='../User/?id=$ReceiverId'</script>"; exit;
			#mysqli_query($conn, "INSERT INTO `ec_messages` VALUES(NULL, '1','$ReceiverId','You have a new Trade!','You have a new trade? Open the gear and press trades!','','$curtime','NO')");
			}else{
				header("Location: ../"); exit;
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
