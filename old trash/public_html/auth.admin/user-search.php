<?php
	include($_SERVER['DOCUMENT_ROOT'].'/auth.admin/admin-header.php');
	
	echo"
	<div id='StandardBoxHeader'>
		User Search
	</div>
	<div id='StandardBox'>
		<form action='' method='POST'>
			<table>
				<tr>
					<td>
						<center>
							<font style='font-size:12px;font-weight:bold;'>
								Username
							</font>
							<br />
							<input type='text' name='Username'>
						</center>
					</td>
				</tr>
				<tr>
					<td>
						<input type='submit' name='Submit' value='Submit'>
					</td>
				</tr>
				<tr>
					<td>
					<center>
							<font style='font-size:12px;font-weight:bold;'>
								IP Address
							</font>
							<br />
							<input type='text' name='IP'>
						</center>
					</td>
				</tr>
				<tr>
					<td>
						<input type='submit' name='Submit2' value='Submit'>
					</td>
				</tr>
			</table>
		</form>
	";
	
	//sort
	
	echo"
	<table width='700'>
		<tr>
			<td width='100'>
				<font style='font-size:12px;font-weight:bold;'>
					Username
				</font>
			</td>
			<td width='200'>
				<font style='font-size:12px;font-weight:bold;'>
					Description
				</font>
			</td>
			<td width='200'>
				<font style='font-size:12px;font-weight:bold;'>
					E-Mail
				</font>
			</td>
			<td width='100'>
				<font style='font-size:12px;font-weight:bold;'>
					Status
				</font>
			</td>
			<td width='100'>
							<font style='font-size:12px;font-weight:bold;'>Bux</font>
			</td>
		</tr>

	<hr color='lightgrey'>";
	
	$Username = $_POST['Username'];
	$Submit = $_POST['Submit'];
	
		if ($Submit) {
		
			$getUsers = mysql_query("SELECT * FROM Users WHERE Username LIKE '%$Username%' ORDER BY ID ASC");
			
				while ($gU = mysql_fetch_object($getUsers)) {
				
					if ($now < $gU->expireTime) {
					$Status = "<font color='green'>Online</font>";
					$Color = "green";
					}
					else {
					$Status = "<font color='red'>Offline</font>";
					$Color = "red";
					}
				
					echo "
					<td width='100'><a href='manage-user.aspx?ID=$gU->ID'>$gU->Username</a></td>
					<td width='200'>".nl2br($gU->Description)."</td>
					<td width='200'>$gU->Email</td>
					<td width='100'>$Status</td>
					<td width='100'><font color='green'><b>$gU->Bux</b></font></td>
							";
							$gU->Bux = round($gU->Bux);
								$Bux = $gU->Bux;
							
								if ($Bux >= 100000&&$Bux <= 999999) {
								
									$BuxShort = substr($Bux, 0,3);
									
									$Bux = "".$BuxShort."K+";
								
								}
								else if ($Bux >= 1000000&&$Bux <= 9999999) {
								
									$BuxShort = substr($Bux, 0,1);
									
									$Bux = "".$BuxShort."M+";
								
								}
								else if ($Bux >= 10000000&&$Bux <= 99999999) {
								
									$BuxShort = substr($Bux, 0,2);
									
									$Bux = "".$BuxShort."M+";
								
								}
								else if ($Bux >= 100000000&&$Bux <= 999999999) {
								
									$BuxShort = substr($Bux, 0,3);
									
									$Bux = "".$BuxShort."M+";
								
								}
								else if ($Bux >= 1000000000&&$Bux <= 9999999999) {
								
									$BuxShort = substr($Bux, 0,1);
									
									$Bux = "".$BuxShort."B+";
								
								}
								else if ($Bux >= 10000000000&&$Bux <= 99999999999) {
								
									$BuxShort = substr($Bux, 0,2);
									
									$Bux = "".$BuxShort."B+";
								
								}
								else if ($Bux >= 100000000000&&$Bux <= 999999999999) {
								
									$BuxShort = substr($Bux, 0,3);
									
									$Bux = "".$BuxShort."B+";
								
								}
								else if ($Bux >= 1000000000000&&$Bux <= 9999999999999) {
								
									$BuxShort = substr($Bux, 0,1);
									
									$Bux = "".$BuxShort."T+";
								
								}
								else if ($Bux >= 10000000000000&&$Bux <= 99999999999999) {
								
									$BuxShort = substr($Bux, 0,2);
									
									$Bux = "".$BuxShort."T+";
								
								}
								else if ($Bux >= 1000000000) {
								
									$Bux = "&#8734;";
								
								}
								else if ($Bux >= 100&&$Bux <= 99999) {
								
									$Bux = number_format($Bux);
								
								}
							echo "
							</tr><tr>
					";
				
				}
		
		}
	

	
	$IP = $_POST['IP'];
	$Submit2 = $_POST['Submit2'];
	
		if ($Submit2) {
		
			$getUsers2 = mysql_query("SELECT * FROM Users WHERE IP='$IP' ORDER BY ID ASC");
			
				while ($gU2 = mysql_fetch_object($getUsers2)) {
				
					if ($now < $gU2->expireTime) {
					$Status = "Online";
					$Color = "green";
					}
					else {
					$Status = "Offline";
					$Color = "red";
					}
				
					echo "
					<table style='padding:10px;border:1px solid #DDD;'>
						<tr>
							<td width='200'>
								<a href='ManageUser.php?ID=$gU2->ID'>$gU2->Username</a>
							</td>
							<td width='350'>
								<font style='font-size:9px;'>$gU2->Description</font>
							</td>
							<td width='75'><center>
								<font color='$Color'>$Status</font>
							</td>
							<td width='200'>
								$gU2->Email
							</td>
							<td width='200'>
			
								<a href='ModerateUser.php?ID=$gU2->ID'><font color='red'>test</font></a>
							</td>
							<td width='75'>
							";
							$gU->Bux = round($gU->Bux);
								$Bux = $gU->Bux;
							
								if ($Bux >= 100000&&$Bux <= 999999) {
								
									$BuxShort = substr($Bux, 0,3);
									
									$Bux = "".$BuxShort."K+";
								
								}
								else if ($Bux >= 1000000&&$Bux <= 9999999) {
								
									$BuxShort = substr($Bux, 0,1);
									
									$Bux = "".$BuxShort."M+";
								
								}
								else if ($Bux >= 10000000&&$Bux <= 99999999) {
								
									$BuxShort = substr($Bux, 0,2);
									
									$Bux = "".$BuxShort."M+";
								
								}
								else if ($Bux >= 100000000&&$Bux <= 999999999) {
								
									$BuxShort = substr($Bux, 0,3);
									
									$Bux = "".$BuxShort."M+";
								
								}
								else if ($Bux >= 1000000000&&$Bux <= 9999999999) {
								
									$BuxShort = substr($Bux, 0,1);
									
									$Bux = "".$BuxShort."B+";
								
								}
								else if ($Bux >= 10000000000&&$Bux <= 99999999999) {
								
									$BuxShort = substr($Bux, 0,2);
									
									$Bux = "".$BuxShort."B+";
								
								}
								else if ($Bux >= 100000000000&&$Bux <= 999999999999) {
								
									$BuxShort = substr($Bux, 0,3);
									
									$Bux = "".$BuxShort."B+";
								
								}
								else if ($Bux >= 1000000000000&&$Bux <= 9999999999999) {
								
									$BuxShort = substr($Bux, 0,1);
									
									$Bux = "".$BuxShort."T+";
								
								}
								else if ($Bux >= 10000000000000&&$Bux <= 99999999999999) {
								
									$BuxShort = substr($Bux, 0,2);
									
									$Bux = "".$BuxShort."T+";
								
								}
								else if ($Bux >= 1000000000) {
								
									$Bux = "&#8734;";
								
								}
								else if ($Bux >= 100&&$Bux <= 99999) {
								
									$Bux = number_format($Bux);
								
								}
							echo "
								<font color='green' title='$gU->Bux'><b>$Bux BUX</b></font>
							</td>
						</tr>
					</table>
					<br/ >
					";
				
				}
		
		}

echo"</div></div>";

?>

<?php
?>




