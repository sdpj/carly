<?php

	include "Header.php";



	echo "<title>Account | Gravitar</title>";

	if ($User) {
	
		//Description
		
		$Description 		= BBCode($_POST['Description']);
		$Submit 			= mysql_real_escape_string(strip_tags(stripslashes($_POST['Submit'])));
		$UpdateTheme 		= mysql_real_escape_string(strip_tags(stripslashes($_POST['UpdateTheme'])));
		$Submit1 			= mysql_real_escape_string(strip_tags(stripslashes($_POST['Submit1'])));
		$Submit3 			= mysql_real_escape_string(strip_tags(stripslashes($_POST['Submit3'])));
		$Xfire 				= mysql_real_escape_string(strip_tags(stripslashes($_POST['Xfire'])));
		$Twitter 			= mysql_real_escape_string(strip_tags(stripslashes($_POST['Twitter'])));
		$CurrentPassword 	= mysql_real_escape_string(strip_tags(stripslashes($_POST['CurrentPassword'])));
		$NewPassword 		= mysql_real_escape_string(strip_tags(stripslashes($_POST['NewPassword'])));
		$ConfirmNewPassword = mysql_real_escape_string(strip_tags(stripslashes($_POST['ConfirmNewPassword'])));
		$Submit2 			= mysql_real_escape_string(strip_tags(stripslashes($_POST['Submit2'])));
		$Siggy				= mysql_real_escape_string(strip_tags(stripslashes($_POST['Signature'])));
		$ThemeSelect		= mysql_real_escape_string(strip_tags(stripslashes($_POST['ThemeSelect'])));
		$email = mysql_real_escape_string(strip_tags(stripslashes($_POST['email'])));
		$emailsubmit = mysql_real_escape_string(strip_tags(stripslashes($_POST['emailpost'])));


if ($emailsubmit) {
			
				
				
				mysql_query("UPDATE Users SET Email='".$email."' WHERE ID='".$myU->ID."'") or die ("Error");
				
				header("Location: account.php");
			
			}
			if ($UpdateTheme) {
			
				mysql_query("UPDATE Users SET ThemeType='".$ThemeSelect."' WHERE ID='".$myU->ID."'");
				header("Location: account.php");
			
			}
			if ($Submit) {
			
				$Description = filter($Description);
				
				mysql_query("UPDATE Users SET Description='".$Description."' WHERE Username='".$User."'") or die ("Error");
				
				header("Location: account.php");
			
			}
			
			
			if ($Submit1) {
			
				mysql_query("UPDATE Users SET Xfire='".$Xfire."' WHERE ID='".$myU->ID."'");
				mysql_query("UPDATE Users SET Twitter='".$Twitter."' WHERE ID='".$myU->ID."'");
				
				header("Location: account.php");
			
			}
			
			if ($Submit2) {
			
				$_OLDHASH = hash('sha512',''.$CurrentPassword.'');
				
				$_NEWHASH = hash('sha512',''.$NewPassword.'');
				$_CONFIRMNEWHASH = hash('sha512',''.$ConfirmNewPassword.'');
				
				if ($myU->Password == $_OLDHASH) {
				
					if ($_NEWHASH == $_CONFIRMNEWHASH) {
					
						mysql_query("UPDATE Users SET Password='".$_NEWHASH."' WHERE Username='".$User."'");
						
						session_destroy();
						
						header("Location: index.php");
					
					}
					else {
					
						echo "Your new password and new confirm password does not match!";
					
					}
				
				}
				else {
				
					echo "Your current password is not right!";
				
				}
			
			}
			
			if($Submit3)
			{
				
				if($Siggy)
				{
					mysql_query("UPDATE Users SET Signature='$Siggy' WHERE ID='$myU->ID'");
					header("Location: account.php");
				}
			}


		echo "
		<table width='95%'>
			<tr>
				<td>

						
					
					<div id='aB'><div align='left'> 
<h2>My Account [$myU->Username]</h2><br /><br /></div>";
if ($myU->Premium == 1) { echo "<font color='red'> Your Account IS NOT Premium. Go Here To<a href='Upgrade/index.php'><font color='red'>Upgrade</font></font></a>"; } echo " <br /><br />










						<form action='' method='POST'>
							<table>
								<tr>

									<td>
										<b>My Description</b>
										<br />
										<font id='Small'>Update your personal description here.</font>
										<br />
										<textarea name='Description' rows='3' cols='50'>".$myU->Description."</textarea>
									</td>
								</tr>
								<tr>
									<td>
										<input type='submit' value='Update' name='Submit'>
									</td>
								</tr>
						</table>
						</form><br />





							<form action='' method='POST'>
							<br />
							<table>
								<tr>
									<td>
										<b>My Password</b>
										<br />
										<font id='Small'>Update your password here.</font>
										<br />
										<table>
											<tr>
												<td>
													<b>Current Password:</b>
												</td>
												<td>
													<input type='password' name='CurrentPassword'>
												</td>
											</tr>
											<tr>
												<td>
													<b>New Password:</b>
												</td>
												<td>
													<input type='password' name='NewPassword'>
												</td>
											</tr>
											<tr>
												<td>
													<b>Confirm New Password:</b>
												</td>
												<td>
													<input type='password' name='ConfirmNewPassword'>
												</td>
											</tr>
										
									</td>
								</tr>
								<tr>
									<td>
										<input type='submit' value='Change' name='Submit2'>
							
									</td>

</tr>



<tr>
<td>
<b>Profile Banner:</b>
</td>
<td>
<input type='text' placeholder='Image link here' name='ProfileBanner'> <input type='submit' name='UpdateProfileBanner' value='Update'>
</td>

</tr>

</table>
<table>
<tr>
<tr>
							
						<td><form action='' method='post'>
						<b>Email:</b>
						</td>
						<td>
						Your current email is: <b>$myU->Email</b><br >
						<input type='text' name='email'>
						<input type='submit' name='emailpost' value='Submit'>
						</tr><tr>
												<td><form action='' method='post'>
													<b>Signature:</b>
												</td>
												<td>
													<input type='text' name='siggy02'>
	
										</td>
							
							<tr>
							
						
										
<br /><br />	<td><b>Disable Messages:</b></td>
<td>
";
if ($myU->PMs != "true") { echo "<input type='submit' name='allow' value='Allow PMs'>"; }
elseif ($myU->PMs == "true") { echo "<input type='submit' name='disable' value='Disable PMs'>"; }
echo "


</td>
											</tr>
</table>
<br /> <input type='submit' name='updatesiggy' value='Update'></form>




								</tr>





					</table>
						</form>
					
				</td>
				<td>
				
				</td>
			</tr>
		

		";
	
	}
$pms = $_POST['allowpms'];
$updatesiggylol = $_POST['updatesiggy'];
$getsiggy = filter($_POST['siggy02']);
$pmsOn = $_POST['allow'];
$pmsOff = $_POST['disable'];
$ProfileBanner = SecurePost($_POST['ProfileBanner']);
$SubmitBanner = SecurePost($_POST['UpdateProfileBanner']);
if ($SubmitBanner) {
mysql_query("UPDATE Users SET ProfileBackground='$ProfileBanner' WHERE ID='$myU->ID'");
}

if ($pmsOn) {
mysql_query("UPDATE Users SET PMs='true' WHERE ID='$myU->ID'");
}
if ($pmsOff) {
mysql_query("UPDATE Users SET PMs='false' WHERE ID='$myU->ID'");
header ("Location: /account.php");
}
if ($updatesiggylol) { mysql_query("UPDATE Users SET Signature='$getsiggy' WHERE ID='$myU->ID'");
header ("Location: /account.php");

}
if ($myU->Premium == 1) {
echo" 
<form action='' method='post'>
<table>
<tr>
<td>
<b>Profile Music</b>
</td>
<td>
<input type='file' name='file'>
</td>

</tr>
<tr>
<td>
<input type='submit' name='submitmusic' value='Submit'>
</td>
</tr>
</table>
</form>"; }

if($_POST[submitmusic]) {
$path = "music/".$_FILES['file']['name'];
move_uploaded_file($_FILES['name']['tmp_name'], $path);
echo"File Uploaded";
}
echo " <form action='' method='post'>
</form>";
?>

<?php
$age = $_POST['age'];

if ($age) {
mysql_query("UPDATE Users SET 13+='true' WHERE ID='$myU->ID'");
}
?>