<?php
include "Header.php";

$User = $_SESSION['Username'];
	if ($myU->PowerAdmin != "true") { header("Location: index.php"); exit(); }

	if ($User) {
	
		$MyUser = mysql_query("SELECT * FROM Users WHERE Username='".$User."'");
		$myU = mysql_fetch_object($MyUser);
	
	}
	
	if ($myU->PowerAdmin != "true") {
	header("Location: /index.php");
        exit();
	}
	
?>
<form action='' method='POST'>
	<table cellspacing='0' cellpadding='0'>
		<tr>
			<td>
<?php if ($myU->Username == "MOBIX"||$myU->Username == "MOBIX"||$myU->Username == "MOBIX") { echo "
				<font id='ProfileText'><font color='red'><B>Hire User</B></FONT></font><br /><br />
		                <font id='Text'><font color='red'><B>*Do not hire a user without authorization.</B></FONT></font><br /><br />			

                                         <table>
						<tr>
							<td>
								User ID:
							</td>
							<td>
								<input type='text' name='UserID' />
							</td>
						</tr>
						<tr>
							<td>
								Position:
							</td>
							<td>
		

						<select name='Position' style='padding:2px;'>
"; } ?>
									<?php if ($myU->Username == "AvatarNation"||$myU->Username == "Developer"||$myU->Username == "noynac") { echo "
									<option value='Administrator'>Administrator</option>                     
                                                                        <option value='Developer'>Developer</option>
                                                                        <option value='Forum Moderator'>Forum Moderator</option>
                                                                        <option value='Image Moderator'>Image Moderator</option>
                                                                        <option value='Mega Moderator'>Mega Moderator</option>
                                                                        <option value='Verified User'>Verified User</option>
                                                                        <option value='Artist'>Artist</option>
<option value='Game Moderator'>Game Moderator</option>
<option value='Community Manager'>Community Manager</option>
<option value='Head Admin'>Head Admin</option>


                                                                        
								</select>
								<input id='buttonsmall' type='submit' name='Submit' />
								"; } ?>
<?php
									$Position = mysql_real_escape_string(strip_tags(stripslashes($_POST['Position'])));
									$UserID = mysql_real_escape_string(strip_tags(stripslashes($_POST['UserID'])));
									$Submit = mysql_real_escape_string(strip_tags(stripslashes($_POST['Submit'])));
									
										if ($Submit) {
										
											if ($Position == "Administrator") {
											
												$Hire = "PowerAdmin";
											
											}
											if ($Position == "Artist") {
											
												$Hire = "PowerArtist";
											
											}
											if ($Position == "Forum Moderator") {
											
												$Hire = "PowerForumModerator";
											
											}
											if ($Position == "Image Moderator") {
											
												$Hire = "PowerImageModerator";
											
											}
											if ($Position == "Mega Moderator") {
											
												$Hire = "PowerMegaModerator";
											
											}
											
											mysql_query("INSERT INTO Badges (UserID, Position) VALUES('$UserID','$Position')");
											
											if ($Position != "Developer") {
											
												mysql_query("UPDATE Users SET ".$Hire."='true' WHERE ID='$UserID'");
											
											}
											
											if ($Position == "Administrator"||$Position == "Forum Moderator"||$Position == "Mega Moderator") {
											
												$checkOwn = mysql_query("SELECT * FROM Inventory WHERE UserID='$UserID' AND ItemID='40'");
												$cO = mysql_num_rows($checkOwn);
												if ($cO >= 1) {
												
													
												
												}
												else {
											
											$getItem = mysql_query("SELECT * FROM Items WHERE ID='40'");
											$gI = mysql_fetch_object($getItem);
										
											$code1 = sha1($gI->File);
											$code2 = sha1($UserID);
										
											mysql_query("INSERT INTO Inventory (UserID, ItemID, File, Type, code1, code2, SerialNum)
											VALUES ('".$UserID."','40','".$gI->File."','".$gI->Type."','".$code1."','".$code2."','".$Output."')");
											
											//logs
											
											$getNew = mysql_query("SELECT * FROM Users WHERE ID='$UserID'");
											$gN = mysql_fetch_object($getNew);
											

											}
											}
											$getNew = mysql_query("SELECT * FROM Users WHERE ID='$UserID'");
											$gN = mysql_fetch_object($getNew);
mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','hired ".$gN->Username." as a ".$Position."','".$_SERVER['PHP_SELF']."')");
										
										}
										
								?>
							</td>
						</tr>
					</table>
			</td>
		</tr>
	</table>
</form>