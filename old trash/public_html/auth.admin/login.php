<?
	include($_SERVER['DOCUMENT_ROOT'].'/auth.admin/admin-header.php');
	
	echo"
	<title>
		Admin Login
	</title>
	";
	
	if($AdminSession){
		header("Location: ../auth.admin/index.aspx");
		die();
	}
	
	echo"
	<div align='center'>
		<div id='StandardBoxHeader' style='width:450px;'>
			Admin Login
		</div>
		<div id='StandardBox' align='center' style='width:450px;'>
			<form action='' method='POST'>
				<table>
					<tr>
						<td>
							<center>
								<font style='font-size:12px;font-weight:bold;'>
									Panel Username
								</font>
								<br />
								<input type='password' name='Username' placeholder='Username...'>
							</center>
						</td>
					</tr>
					<tr>
						<td>
							<center>
								<font style='font-size:12px;font-weight:bold;'>
									Panel Password
								</font>
								<br />
								<input type='password' name='Password' placeholder='Passcode...'>
							</center>
						</td>
					</tr>
					<tr>
						<td>
							<input type='submit' name='submit' value='Login' class='btn-control-lrg'>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	
	
	";
	
	
	
	$Password = mysql_real_escape_string(strip_tags(stripslashes($_POST['Password'])));
	$Username = mysql_real_escape_string(strip_tags(stripslashes($_POST['Username'])));
	$submit = mysql_real_escape_string(strip_tags(stripslashes($_POST['submit'])));
	$IPAddress = $_SERVER['REMOTE_ADDR'];
	$Date =  date("M. d, Y H:i:sa");
	if ($submit) {
	
		$Passcode = "a";
		
		if ($Password == $Passcode && $Username == "admin") {
		mysql_query("INSERT INTO AdminLoginLogs (IP, Date, User, Status) VALUES ('$IPAddress','$Date','$myU->Username','Success')");
			$_SESSION['AdminSession']="AdminSession";
			header("Location: http://avatar-gamer.ga/auth.admin/index.aspx");
			die();
		}
		
		else {
			mysql_query("INSERT INTO AdminLoginLogs (IP, Date, User, Status) VALUES ('$IPAddress','$Date','$myU->Username','Failed')");
			echo"
			Incorrect password.
			";
		}
	
	}
	
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>