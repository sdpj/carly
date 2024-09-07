<?php
	include "../Header.php";
	if (!$User) {
	
		header("Location: ../index.php");
		die;
	}
	
	$TargetType = SecurePost($_GET['TargetType']);
	$TargetID = SecurePost($_GET['TargetID']);
	
	if (!$TargetType || !$TargetID) {
	
		echo "Invalid request.";
		include "../Footer.php";
		die;
	
	}
	
	if ($TargetType == "Item") {
	
		$getItem = mysql_query("SELECT * FROM Items WHERE ID='$TargetID'");
		$gI = mysql_fetch_object($getItem);
		
		if ($gI->CreatorID != $myU->ID) {
		
			echo "Invalid request.";
			include "../Footer.php";
			die;
		
		}
	
	}
	elseif ($TargetType == "UserItem") {
	
		$getItem = mysql_query("SELECT * FROM UserStore WHERE ID='$TargetID'");
		$gI = mysql_fetch_object($getItem);
		
		if ($gI->CreatorID != $myU->ID) {
		
			echo "Invalid request.";
			include "../Footer.php";
			die;
		
		}
	}
	elseif ($TargetType == "Profile") {
	
		if ($TargetID != $myU->ID) {
		
			echo "Invalid request.";
			include "../Footer.php";
			die;
		
		}
		
	
	}
	
	elseif ($TargetType == "Group") {
	
		$getGroup = mysql_query("SELECT * FROM Groups WHERE ID='$TargetID'");
		$gG = mysql_fetch_object($getGroup);
		
		if ($myU->ID != $gG->OwnerID) {
		
			echo "Invalid request.";
			include "../Footer.php";
			die;
		
		}
	
	}
	
	
	echo "
	<div id='LargeText'>
		Upload Ad
	</div>
	<div id='aB'>
	<form enctype='multipart/form-data' action='' method='POST'>
		<table>
			<tr>
				<td>
					<b>File</b>
				</td>
				<td>
					<input type='file' name='uploaded'>
				</td>
			</tr>
			<tr>
				<td>
					<b>What I bid</b>
				</td>
				<td>
					<input type='text' name='BidAmount'>
					<br />
					<font style='font-size:7pt;'>*1 BUX = 1 Impression</font>
				</td>
			</tr>
		</table>
	</form>
	</div>
	";
	
	
	include "../Footer.php";