<?php

include "Header.php";
if ($myU->PowerAdmin != "true") { header("Location: index.php"); exit(); }

$User = $_SESSION['Username'];
	
	if ($User) {
	
		$MyUser = mysql_query("SELECT * FROM Users WHERE Username='".$User."'");
		$myU = mysql_fetch_object($MyUser);
	
	}
	
	if ($myU->PowerAdmin != "true") {
	header("Location: /index.php");
        exit();
	}

?>
<form action='' method="POST">
	<table cellspacing="0" cellpadding="0">
		<tr>
			<td>
                                <font id='ProfileText'><B><font color='red'>Main Configuration</FONT></B></font><Br />
							<br />	<a href='ManageStore.php'>Manage Store</a><br /><br />
				<font id='Text'><B><font color='black'>Announcement</FONT></B></font><Br /><br />
				<textarea name='BannerText' rows='5' cols='80'><?=$gB->Text?></textarea>
				<br />
                            <b>Banner color: </b><input type='radio' name='color' value='Pink' checked>Pink<input type='radio' name='color' value='lightBlue'>Light Blue<input type='radio' name='color' value='darkRed'>Red<br />
				<input type='submit' name='Submit' value='Update Changes' />
				<?php
				$BannerText = mysql_real_escape_string(strip_tags(stripslashes($_POST['BannerText'])));
                                $Color = $_POST['color'];
				$Submit = $_POST['Submit'];
				
					if ($Submit) {
					
						$BannerText = ($BannerText);
						
						$BannerText = "$BannerText";
					
						mysql_query("UPDATE Banner SET Text='".$BannerText."'");
mysql_query("UPDATE Banner SET Color='".$Color."'");

mail ("bannerchanges@universe.net", "Announcement Change :: $myU->Username", "$BannerText"); mysql_query("INSERT INTO Logs (UserID , Message) VALUES ('$myU->ID','Update banner to $BannerText')");
						header("Location: ?tab=$tab");
					
					}


				?>
			</td>
		</tr>
	</table>
</form>
<form action='' method="POST">
	<table cellspacing="0" cellpadding="0">
		<tr>
			<td>
<br>
</br>
				<font id='ProfileText'><font color='grey'><B>Site Controls</B></FONT></font>
				<table>
<br>
</br>
					<tr>
						<td>
							<div id='Text'><B>User Register</B></div>
						</td>
						<?php
						$adsystem = mysql_fetch_object($adsystem = mysql_query("SELECT * FROM Adsystem"));
						$Configuration = mysql_fetch_object($Configuration = mysql_query("SELECT * FROM Configuration"));
						$MaintenanceEnabled = mysql_real_escape_string(strip_tags(stripslashes($_POST['_MaintenanceEnabled'])));
						$RegisterEnabled = mysql_real_escape_string(strip_tags(stripslashes($_POST['_RegisterEnabled'])));
						$AdvertiseEnabled = mysql_real_escape_string(strip_tags(stripslashes($_POST['_AdvertiseEnabled'])));
						$Submit = mysql_real_escape_string(strip_tags(stripslashes($_POST['_Submit'])));
						
							if ($Submit) {
							
								if (!$RegisterEnabled) {
								
									$RegisterEnabled = "false";
								
								}
								if (!$MaintenanceEnabled) {
								
									$MaintenanceEnabled = "false";
								
								}
								if (!$AdvertiseEnabled) {
								
									$AdvertiseEnabled = "false";
									
								}
								
								
								mysql_query("UPDATE Configuration SET Register='$RegisterEnabled'");
								mysql_query("UPDATE Maintenance SET Status='$MaintenanceEnabled'");
								mysql_query("UPDATE Adsystem SET ads='$AdvertiseEnabled'");
								header("Location: ?tab=configuration");
							
							}
						?>
						<td style='padding-left:150px;'>
							<input type='checkbox' name='_RegisterEnabled' value='true' <?php if ($Configuration->Register == "true") { echo 'checked'; } ?>/>
						</td>
					</tr>
					<tr>
						<td>
							<div id='Text'><B>Maintenance</B></div>
						</td>
						<td style='padding-left:150px;'>
							<input type='checkbox' name='_MaintenanceEnabled' value='true' <?php if ($Maintenance->Status == "true") { echo 'checked'; } ?>/>
						</td>
					</tr>
						<tr>
						<td>
							<div id='Text'><B>Ad System</B></div>
						</td>
						<td style='padding-left:150px;'>
							<input type='checkbox' name='_AdvertiseEnabled' value='true' <?php if ($adsystem->ads == "true") { echo 'checked'; } ?>/>
						</td>
					</tr>
				</table>
				<input type='submit' name='_Submit' value='Update Changes' />
		</tr>	
	</table>
</form>