<?php
include "../Global.php";
include "Sub.php";
echo '<link rel="stylesheet" href="../Base/Style/Main.css">';


	echo "
	<style>
		body {
		background-color:white;
		background-repeat:no-repeat;
		background-attachment:fixed;
		background-position:center top; 
		background-size:cover;
		height:100%;
		
	</style>
	
	";


		if ($myU->Ban == "1") {
echo "
			<div id='nav'>
<img src='../Imagess/SPNewLogo.png' height='40'><center>
				<table cellspacing='0' cellpadding='0' width='1100'>

					<tr>
						<td width='200'>
						
						</td>
					</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<br />
";
			echo "
<center>
			
			<div style='border:3px solid white;width:900px;padding:10px; margin: 0px auto;background-color:white; '>
			<center>
			<div style='border:1px solid black;padding:10px;text-align:left;'>
			<table>
				<tr>
					<td id=''><center>
			<div id='' style='text-align:left;font-size:20px;'>";
								if ($myU->BanLength == "0") {
								
									echo "WARNING";
								
								}
								if ($myU->BanLength == "1") {
								
									echo "BANNED FOR 1 DAY";
								
								}
								if ($myU->BanLength == "3") {
								
									echo "BANNED FOR 3 DAYS";
								
								}
								if ($myU->BanLength == "7") {
								
									echo "BANNED FOR 7 DAYS";
								
								}
								if ($myU->BanLength == "14") {
								
									echo "BANNED FOR 14 DAYS";
								
								}
								if ($myU->BanLength == "forever") {
								
									echo "ACCOUNT DELETED";
								
								}
if ($myU->BanLength == "Poision") {
								
									echo "Account Deleted";
								
								}
			echo "</div><br /><br />
					
								<div id='HeadText'>
								";

								
								if ($myU->BanLength != "forever") {
								$TimeUp = date("F j, Y g:iA","".$myU->BanTime."");
								}
								
								echo "
							</div>
							</td>
							</tr>
							<tr>
							<td align='left'>
								<font style='font-size:12px;'>
								<table>
									<tr>
										<td>
											Ban Category:
										</td>
										<td>
											<font color='darkred'><b>".$myU->BanType."</b></font>
										</td>
									</tr>
									<tr>
										<td>
											Date Reviewed:
										</td>
										<td>
											<font color='darkred'><b>".date("F j, Y g:iA","".$myU->TimeBanned."")."</b></font>
										</td>
									</tr>
								</table><br>
<font color='black'><b>Your account has been disabled by our staff for not following our <font color='darkblue'>Terms of Service</font>.<br>
<br />We have such rights to suspend your account if you do not abide by our rules.</font></b>
								
								
								</div>
								<center><br>
								
									";
									if ($myU->BanContent) {
									echo "
									<div style='background:white;padding:7px;border:1px solid black;width:100%;text-align:left;'><font style='font-size:11px;'>Reason: <b><font color='darkred'>".$myU->BanType."</font></b><br><br>
									 <b>Offensive Content:</b> <i>".$myU->BanContent."</i></font>
									 <br /><br><font size='1'>The text or content shown in italics above is not approved by our staff.<br></font>
									 
									</div>
									";
									}if ($myU->BanDescription) {
									echo "
									</center>
									<br />

									<font color='black'><b>Moderator Note:</b> $myU->BanDescription </font>";} echo"
								
							</td></tr></table>
<br />
</center></div>
			"; 
		
		
	
	$time1 = time();
	$open = $myU->BanTime;
	if($myU->BanLength != "forever")
	{
	if($myU->BanLength == "0")
                      
	{ 
	
		echo "
<center><a href='?Reactivate=Yes'><font color='green'>Reactivate Account</font></a></center></font>
<br>
</br>
<a href='http://www.Gravitar.net/siterules.php'><font color='darkred'><font color='darkblue'>Terms of Service</font>.</font></a>";
	
	}
	else if($time1 >= $open)
	{
               
					
		echo "<center><a href='?Reactivate=Yes'><font color='green'>Reactivate Account</font></a></center>
<br>
<a href='http://www.Gravitar.net/siterules.php'><font color='darkred'>*By reactivating your account, you agree to our <font color='darkblue'>Terms of Service</font>.</font></a>";
	
	}
	else if ($time1 <= $open) {
	
		echo "You may reactivate your account on ".$TimeUp.".";
		

	}
	
	$Reactivate = mysql_real_escape_string(strip_tags(stripslashes($_GET['Reactivate'])));
	if($Reactivate == "Yes")
	{
	
		if($myU->BanLength == "0")
		{
		
			mysql_query("UPDATE Users SET Ban='0' WHERE Username='$User'");
			mysql_query("UPDATE Users SET BanTime='' WHERE Username='$User'");	
			mysql_query("UPDATE Users SET BanLength='' WHERE Username='$User'");
			mysql_query("UPDATE Users SET BanType='' WHERE Username='$User'");
			mysql_query("UPDATE Users SET BanDescription='' WHERE Username='$User'");
			header("Location: /index.php");
		}
		else if($time1 >= $open)
		{
		
			if ($myU->BanLength != "forever") {
		
			mysql_query("UPDATE Users SET Ban='0' WHERE Username='$User'");
			mysql_query("UPDATE Users SET BanTime='' WHERE Username='$User'");	
			mysql_query("UPDATE Users SET BanLength='' WHERE Username='$User'");
			mysql_query("UPDATE Users SET BanType='' WHERE Username='$User'");
			mysql_query("UPDATE Users SET BanDescription='' WHERE Username='$User'");
			header("Location: /index.php");
			}
		}
		else { echo "Error"; }
	
	}
	}
	else
	{
	
	echo "<font color='black'><b>Your account has been terminated.</b></font>";

	
	
	
	
	}
echo "<br /><br /><b>i fofofr.</b>";
	echo "</div>
						</td>
				</tr>
			</table>

	";
	}
	echo "<br /><font style='font-size:8pt;color:#999;'>Want to logout? <a href='../Logout.php'>Logout here</a>.</font>";

echo " <title> Account Disabled </title> ";
	if ($myU->Ban != 1) {
	header("Location: ../index.php"); 
	exit();
	}