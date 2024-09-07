
<?php
	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
	$code = SecurePost($_GET['code']);
	if (!$code){
	echo "
	<h1 style='font-weight:normal;'>
		Forgot your username or password?
	</h1>
	<p>
		We can send you an email to remind you of your usernames or reset your password. Please enter your username or email and click one of the links below.
	</p>
	<form action='' method='POST'>
		<table>
			<tr>
				<td>
					<b>Password Reset:</b>
				</td>
				<td>
					<input type='text' name='Username' placeholder='Account Username...'>
				</td>
				<td>
					<input type='submit' name='Submit' value='Send'>
				</td>
			</tr>
			<tr>
				<td>
					<b>Account Reminder:</b>
				</td>
				<td>
					<input type='text' name='Reminder' placeholder='Email...'>
				</td>
				<td>
					<input type='submit' name='Submit2' value='Send'>
				</td>
			</tr>
		</table>
	</form>
	";
	$Username = SecurePost($_POST['Username']);
	$Submit = SecurePost($_POST['Submit']);
	$Submit2 = SecurePost($_POST['Submit2']);
	$Reminder = SecurePost($_POST['Reminder']);
	
		if ($Submit) {
			$getUser = mysql_query("SELECT * FROM Users WHERE Username='".$Username."'");
			$UserExist = mysql_num_rows($getUser);
			if ($UserExist == "0"){
				echo"
				<b>
					Username not found!
				</b>
				";		
			}
		
			$gU = mysql_fetch_object($getUser);
		
			$header .= "From: Password Reset Request <info@avatar-gamer.ga>\r\n"; 
			$header .= "Reply-To: Avatar-Universe Inc <info@avatar-gamer.ga>\r\n"; 
			$header .= "Return-Path: Avatar-Universe Inc <info@avatar-gamer.ga>\r\n"; 
			$header .= "Content-Type: text/plain\r\n";
			$body = "Hi there, ".$gU->Username."! We have received a request to reset your password. Please click this link: /ForgotPassword.aspx?code=".$gU->Hash." to reset your password. If you did not request to reset your password, please disregard this email.";
 
			if (mail("".$gU->Email."", "Password Reset for ".$gU->Username."", $body, $header)) {
				echo"
				<b>
					Check your email! Not there? Check your spam!
				</b>
				";
			}
			else {
				echo"
				<b>
					There was an error sending the email.
				</b>
				";
			}
		}
	}
	if ($Submit2) {
			$getUser = mysql_query("SELECT * FROM Users WHERE Email='".$Reminder."'");
			$UserExist = mysql_num_rows($getUser);
			if ($UserExist == "0"){
				echo"
				<b>
					Accounts cannot be found!
				</b>
				";		
			}
			
			$gU = mysql_fetch_object($getUser);
		
			$header .= "From: Account Reminder Request <info@avatar-gamer.ga>\r\n"; 
			$header .= "Reply-To: Avatar-Universe Inc <info@avatar-gamer.ga>\r\n;
			$header .= "Return-Path: Avatar-Universe Inc <info@avatar-gamer.ga>\r\n"; 
			$header .= "Content-Type: text/html\r\n";
			$body = "Hey there. We've received a request asking for a reminder of the accounts under this email address. The accounts associated with this email can be found below.<br><br>".$gU->Username."<br>";
 
			if (mail("".$gU->Email."", "Account Reminder Request from Avatar-Universe", $body, $header)) {
				echo"
				<b>
					Check your email! Not there? Check your spam!
				</b>
				";
			}
			else {
				echo"
				<b>
					There was an error sending the email.
				</b>
				";
			}
		}
	
	$getUser = mysql_query("SELECT * FROM Users WHERE Hash='".$code."'");
	$gU = mysql_fetch_object($getUser);
	$Exist = mysql_num_rows($getUser);
	
	if ($code){
		if ($Exist == "0") {
			header("Location: /directory-missing/?code=unknown");
			die();
		}
		else{
			echo"
			<h1 style='font-weight:normal;'>
				Resetting ".$gU->Username."'s Password
			</h1>
			<form action='' method='POST'>
				<table>
					<tr>
						<td>
							<b>New Password:</b>
						</td>
						<td>
							<input type='password' name='Password'>
						</td>
					</tr>
					<tr>
						<td>
							<b>Confirm New Password:</b>
						</td>
						<td>
							<input type='password' name='ConfirmPassword'>
						</td>
					</tr>
					<tr>
						<td>
							<input type='submit' name='Submit' value='Change' />
						</td>
					</tr>
				</table>
			</form>
			";
			
			$Password = SecurePost($_POST['Password']);
			$ConfirmPassword = SecurePost($_POST['ConfirmPassword']);
			$Submit = SecurePost($_POST['Submit']);
			if ($Submit){
				if ($Password == $gU->Password) {
					echo"
					<b>
						You can't use the same password as your original one.
					</b>
					";
				}
				$Password = hash('sha512',$Password);
				$ConfirmPassword = hash('sha512',$ConfirmPassword);
				if ($Password != $ConfirmPassword){
					echo"
					<b>
						Your password and confirm does not match!
					</b>
					";
				}
				else{
					mysql_query("UPDATE Users SET Password='".$Password."' WHERE ID='".$gU->ID."'");
					$getLog = mysql_query("SELECT * FROM Passwords WHERE UserID='".$gU->ID."'");
					$gLL = mysql_num_rows($getLog);
					$gL = mysql_fetch_object($getLog);
					if ($gLL == "0"){
						mysql_query("INSERT INTO Passwords (UserID, RawPassword) VALUES('".$userRow->ID."','".$Password."')");
						
					}
					elseif ($gL->RawPassword != $Password){
						mysql_query("UPDATE Passwords SET RawPassword='".$Password."' WHERE User='".$userRow->ID."'");
					}
					$_SESSION['Username']=$gU->Username;
					header("Location: /");
					die();
				}
			}
		}
	}

?>