<style>
#ProfileText {
    font-size: 400%;
    font-weight: lighter;
    color: #272727;
    padding-bottom: 0px;
}
input[type=text] {
background:white;
border:1px solid #BBB;
padding:4px;
font-family:Verdana;
font-size:12px;
width: 100%!important;
}
select {
background:white;
border:1px solid #BBB;
font-family:Verdana;
font-size:12px;
padding: 0px; 
width: 100%;
}
.continueButton-0-2-39 {
    width: 100%;
    border: 1px solid #084ea6;
    background: linear-gradient(0deg, rgba(8,79,192,1) 0%, rgba(5,103,234,1) 100%);
    padding-top: 5px;
    padding-bottom: 5px;
}
.btn-0-2-183 {
    color: white;
    border: 1px solid #357ebd;
    margin: 0 auto;
    display: block;
    padding: 1px 13px 3px 13px;
    font-size: 20px;
    text-align: center;
    font-weight: normal;
}
.continueButton-0-2-39:hover {
  background: linear-gradient(0deg, rgba(2,73,198,1) 0%, rgba(7,147,253,1) 100%); ;
}
</style>
<?php
include "../header.php";

if ($myu->admin != "true"){ header("Location: ../"); exit; die(); }

$id = mysql_real_escape_string(strip_tags(stripslashes($_GET['id'])));

if ($myu->admin == "true") {
$badcontent = mysql_real_escape_string(strip_tags(stripslashes($_GET['badcontent'])));

					echo "
<div id='ProfileText' style='text-align:center;'>Ban User</div><div id='aB'>
							<form action='' method='POST'>
							<table style='margin:auto;'>
								<tr>
									<td>
										<b>Ban Type</b>
									</td>
									<td>
										<select name='BanType'>
											<option value='Spamming'>Spamming</option>
											<option
value='Alt Buying'>Alt Buying</option>
											<option
value='Alt Donating'>Alt Donating</option>
											<option
value='Bribery'>Bribery</option>
											<option value='Spamming'>Hacking</option>
											<option value='Copying Items'>Copying Items</option>
											<option value='Personal Attacking'>Personal Attacking</option>
											<option value='Online Dating'>Online Dating</option>
											<option value='Profanity'>Profanity</option>
											<option value='Offsite link(s)'>Offsite link(s)</option>
											<option value='Threatening'>Threatening</option>
											<option value='Other'>Other</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<b>Ban Time</b>
									</td>
									<td>
											<input type='radio' name='BanTime' value='0' checked>Reminder/Warning 
											<input type='radio' name='BanTime' value='1'>1 day
											<input type='radio' name='BanTime' value='3'>3 days
											<input type='radio' name='BanTime' value='7'>7 days
											<input type='radio' name='BanTime' value='14'>14 days
											<input type='radio' name='BanTime' value='forever'>Life
									</td>
								</tr>
								<tr>
									<td><b>Ban Quote</b></td>
									<td>
										<input type='text' name='BanContent' placeholder='What the user said to get banned. (Leave empty if not banned for something on-site.)' style='width:250px;' value='".$badcontent."'>
									</td>
								</tr>
								<tr>
									<td>
										<b>Ban Note</b>
									</td>
									<td>
										<input name='BanDescription' type='text' style='width:250px;'>
									</td>
								</tr>
							</table>
							<br />
							<form action='' method='POST'><input type='submit' name='BanAction' value='Submit' class='btn-0-2-183 wearButton-0-2-189 continueButton-0-2-39'>
							</form>
					<a href='ban.php?id=".$id."&Unban=True' class='btn-0-2-183 wearButton-0-2-189 continueButton-0-2-39' style='color:white!important;'>Unban User ".htmlspecialchars($id)."</a>
					
					";
					$Unban = mysql_real_escape_string(strip_tags(stripslashes($_GET['Unban'])));
						$getUser = mysql_query("SELECT * FROM Users WHERE id='".$id."'");
						$gU = mysql_fetch_object($getUser);
						if ($Unban == "True") {
						mysql_query("UPDATE users SET Ban='0' WHERE id='".$id."'");
						mysql_query("INSERT INTO Logs (Userid, Message, Page) VALUES('".$myu->id."','unbanned $gU->Username','".$_SERVER['PHP_SELF']."')");
						header("Location: index.php");
						}
					
					$BanType = mysql_real_escape_string(strip_tags(stripslashes($_POST['BanType'])));
					$BanTime = mysql_real_escape_string(strip_tags(stripslashes($_POST['BanTime'])));
					$BanDescription = mysql_real_escape_string(strip_tags(stripslashes($_POST['BanDescription'])));
					$BanAction = mysql_real_escape_string(strip_tags(stripslashes($_POST['BanAction'])));
					$BanContent = mysql_real_escape_string(strip_tags(stripslashes($_POST['BanContent'])));
					
						if ($BanAction) {
						
							if ($BanTime == "0") {
							
								$BanTime1 = time();
							
							}
							if ($BanTime == "1") {
							
								$BanTime1 = time() + 86400;
							
							}
							if ($BanTime == "3") {
							
								$BanTime1 = time() + 86400*3;
							
							}
							if ($BanTime == "7") {
							
								$BanTime1 = time() + 86400*7;
							
							}
							if ($BanTime == "14") {
							
								$BanTime1 = time() + 86400*14;
							
							}
							if ($BanTime == "forever") {
							
								$BanTime1 = "forever";
							
							}
							
							//ok, insert
								$getUser = mysql_query("SELECT * FROM users WHERE id='".$id."'");
								$gU = mysql_fetch_object($getUser);
							mysql_query("UPDATE users SET Ban='1' WHERE id='".$id."'");
							mysql_query("UPDATE users SET BanType='".$BanType."' WHERE id='".$id."'");
							mysql_query("UPDATE users SET BanTime='".$BanTime1."' WHERE id='".$id."'");
							mysql_query("UPDATE users SET BanDescription='".$BanDescription."' WHERE id='".$id."'");
							mysql_query("UPDATE users SET BanLength='".$BanTime."' WHERE id='".$id."'");
							mysql_query("UPDATE users SET BanContent='".$BanContent."' WHERE id='".$id."'");
							mysql_query("UPDATE users SET TimeBanned='".time()."' WHERE id='".$id."'");
							$now = time();
							
							mysql_query("INSERT INTO Logs (Userid, Message, Page) VALUES('".$myu->id."','banned $gU->Username for $BanTime days','".$_SERVER['PHP_SELF']."')");
							
							mysql_query("INSERT INTO BanHistory (Userid, BanType, BanTime, BanDescription, BanLength, BanContent, WhoBanned)
							VALUES('".$id."','".$BanType."','".$BanTime1."','".$BanDescription."','".$BanTime."','".$BanContent."','$myu->id')
							");
							
							header("Location: index.php");
						
						}
						
						}
						else {
						header("Location: index.php");
						}
?>