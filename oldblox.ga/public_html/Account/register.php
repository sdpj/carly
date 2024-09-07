<?	
	
include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
function is_alphanumeric($username){
                return preg_match('/^[a-z0-9]+$/i', $username);
	}
	if($User){
		header("Location: /");
		die();
	}
?>
	<div class='registration-page'>
		<h2>Register with Avatar-Universe</h2>
		Welcome to Avatar-Universe. Avatar-Universe is an online avatar website designed for users of all ages. On Avatar-Universe, users can interact with one another on our forums, learn the art of economics with our trade market, and even design their own items.
		<br>
		<br>
		All information provided here is stored in an encrypted form. We ask that you <strong>do not</strong> use a password from another website such as YouTube, Google, or ROBLOX. Although all information is stored in an encryted form, you should always use a different password on different websites.
		<div class='divider-top' style='width:100%;padding-top:5px;margin-top:5px;'></div>
		<div class='divider-right' style='width:484px;float:left;'>
			<h4>Create a new account</h4>
			<form action='' method='POST'>
				<table cellpadding='0' cellspacing='0'>
					<tr>
						<td style='text-align:right;font-size:15px;font-weight:bold;'>
							<b>Username:</b>
						</td>
						<td>
							&nbsp;
						</td>
						<td>
							<input type='text' name='_Username' placeholder='A user name...' style='width:302px;padding:5px;'>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
						</td>
					</tr>
					<tr>
						<td style='text-align:right;font-size:15px;font-weight:bold;'>
							<b>Password:</b>
						</td>
						<td>
							&nbsp;
						</td>
						<td>
							<input type='password' name='_Password' placeholder='A password...' style='width:302px;padding:5px;'>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
						</td>
					</tr>
					<tr>
						<td style='text-align:right;font-size:15px;font-weight:bold;'>
							<b>Confirm Password:</b>
						</td>
						<td>
							&nbsp;
						</td>
						<td>
							<input type='password' name='_ConfirmPassword' placeholder='Re-type password...' style='width:302px;padding:5px;'>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
						</td>
					</tr>
					<tr>
						<td style='text-align:right;font-size:15px;font-weight:bold;'>
							<b>Email:</b>
						</td>
						<td>
							&nbsp;
						</td>
						<td>
							<input type='text' name='_Email' placeholder='Email address...' style='width:302px;padding:5px;'>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
						</td>
					</tr>
					<tr>
						<td style='text-align:right;font-size:15px;font-weight:bold;'>
							<b>Gender:</b>
						</td>
						<td>
							&nbsp;
						</td>
						<td>
							<select name='_Gender' style='width:302px;padding:5px;'>
								<option value='Male' selected='selected'>I'm a Male</option>
								<option value='Female'>I'm a Female</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
						</td>
					</tr>
					<tr>
						<td style='text-align:right;font-size:15px;font-weight:bold;'>
							<b>Verify:</b>
						</td>
						<td>
							&nbsp;
						</td>
						<td>
							<div class='g-recaptcha' data-sitekey='6LdtohMTAAAAAMzGa9FGCsBUITtdCD6J7LPkh_IN'></div>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
						</td>
						<td>
							&nbsp;
						</td>
						<td style='text-align:right;'>
							<input type='submit' class='btn-primary' name='_Submit' value='Register'>
						</td>
					</tr>
				</table>
			</form>
<?
	$response = SecurePost($_POST['g-recaptcha-response']);
	$Gender = SecurePost($_POST['_Gender']);
	$Username = SecurePost($_POST['_Username']);
	$Password = SecurePost($_POST['_Password']);
	$ConfirmPassword = SecurePost($_POST['_ConfirmPassword']);
	$Email = SecurePost($_POST['_Email']);
	$Submit = SecurePost ($_POST['_Submit']);
	$DateJoined = date("M j, Y");

	if($Submit){
		if($Gender == "Male"){
			$Gender1 = "Male";	
		}elseif($Gender == "Female"){
			$Gender1 = "Female";
		}else{
			$Gender1 = "Male";
		}
		if($response){
			$Username = filter2($Username);
			if(!$Username||!$Password||!$ConfirmPassword){
				echo"
				<font style='color:red;'>
					You have fields missing. Please fill out all fields.
				</font>
				";
			}else{
				$userExist = mysql_query("SELECT * FROM Users WHERE Username='$Username'");
				$userExist = mysql_num_rows($userExist);
				$userExist1 = mysql_query("SELECT * FROM Users WHERE OriginalName='$Username'");
				$userExist1 = mysql_num_rows($userExist1);
				if ($userExist > 0){
					echo"
					<div id='error'>	Oh no! Someone already signed up with that username. Try another. </div>
					";
				}elseif ($userExist1 > 0){
					echo"
						Oh no! Someone already signed up with that username. Try another.
					";
				}else{
					if ($ConfirmPassword != $Password){
						echo"
						<div id='error'>	Your Password and Confirm Password do not match.</div>
						";
					}else{
						if (strlen($Username) >= 15){
							echo"
							<div id='error'>	Your username is too long. Please keep your username between 3 and 15 characters.</div>
							";
						}elseif (strlen($Username) < 3){
							echo"
							<div id='error'>	Your username is too short. Please keep your username between 3 and 15 characters. </div>
							";
						}
						elseif (!is_alphanumeric($Username)) {
						echo"
						<div id='error'>Only A-Z and 1-9 is allowed, or there may be profanity in your username!</div>
						";
					}
					else{
							$_ENCRYPT = hash('sha512',$Password);
							$IP = $_SERVER['REMOTE_ADDR'];
							$Flood = time()+900;
							mysql_query("INSERT INTO Users (Username, Password, Email, IP, JoinDate, Gender, VerifyTime) VALUES('$Username','$_ENCRYPT','$Email','$IP','$DateJoined','$Gender1','$Flood')");
							$_SESSION['Username']=$Username;
							$_SESSION['Password']=$_ENCRYPT;
							$Find = mysql_query("SELECT * FROM Users WHERE Username='$Username'");
							$Find1 = mysql_fetch_object($Find);
							mysql_query("INSERT INTO PMs (SenderID, ReceiveID, Title, Body, time) VALUES('1','".$Find1->ID."','Welcome to Avatar-Universe!','We are so happy to have you as part of our community. Please check out our terms of service here before continuing on the website: /info/terms-of-service/','".$now."')");
							header("Location: /");
							die();
						}
					}
				}
			}
		}else{
			echo"
			<div id='error'>	We must verify that you are human. Please fill out the recaptcha form. </div>
			";
		}
	}
	echo"
	</div>
	<br style='clear:both;'>
	</div>
	";
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>