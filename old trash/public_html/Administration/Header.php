<?php
include "Permissions.php";




if (isset($_COOKIE['Admin'])) {

				$Online = mysql_num_rows($Online = mysql_query("SELECT * FROM Users WHERE $now < expireTime"));
$getPending = mysql_query("SELECT * FROM UserStore WHERE active='0'");
$getDrafts = mysql_query("SELECT * FROM ItemDrafts");
$getAds = mysql_query("SELECT * FROM PendingAds");
$gA = mysql_num_rows($getAds);
$active = mysql_num_rows($getDrafts);
$num_pending = mysql_num_rows($getPending);
$getReports = mysql_query("SELECT * FROM Reports");
$gR = mysql_num_rows($getReports);
$getUserReports = mysql_query("SELECT * FROM UserReports");
$getForumReports = mysql_query("SELECT * FROM ForumReports");
//$numUserReports = mysql_num_rows($getUserReports);
$numForumReports = mysql_num_rows($getForumReports);
$AbuseReports = $numForumReports+$numUserReports;
$getRun = mysql_query("SELECT * FROM RunningAds");
$grA = mysql_num_rows($getRun);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<title>Administration | Firesplash</title>
		<link rel="stylesheet" href="http://social-paradise.net/Base/Style/Main.css">
	</head>
		<body>
		
		
			</body>	
			<?php echo"	
			<style>
			body {
			background-color:#000000;
			font-weight:none;
			
			}
			
				#header2 {
				background:lightgrey;
				border-right:1px solid black;
				height:100%;
                                float:left;
				width:10%;
				
			padding:8px;
			
				color:black;
				}
				
				
				
				#header2 td {
				padding-left:10px;
				padding-right:10px;
				padding-top:10px;
				color:black;
				}
				
			    #header2 a{ 
				
			font-weight:none;
			color:black;
			}
				#container {
				width:75%;
				
				background:white;
				border:1px solid black;
			
				
				padding:15px;
				float:center;
				padding-left:50px;
				
				}
			</style>
			<center>
<div id='header2'><br />
			<center><br /><img src='../Imagess/SPNewLogo.png' height='37'></center><br /><br />
			Online($Online)<br /><br /><a href='ViewReports.php'><font color='red'> Reports($gR)</font></a><br /><a href='ItemModeration.php'>Items($num_pending)</a><br /><a href='ReleaseItem.php'>Store Items($active)</a><br />
<a href='PendingAds.php'>User Ads($gA)</a><br />
<a href='runningads.php'>Running Ads($grA) </a><br />
<hr color='#E3E3E3' width='100%'>
			<br />

<div style='border:1px solid #E3E3E3;padding:5px;overflow:auto;height:20%;width:95%;'>
			
							<a href='../Administration/' ><font color='blue'><font size='2'>Logs</font></font></a>
						<br />
							<a href='../Administration/Users.php'><font color='blue'><font size='2'>Accounts</font></font></a>
						<br />
							<a href='../Administration/Site.php'><font color='blue'><font size='2'>Site Controls</font></font></a>
					<br />
							<a href='../Administration/Powers.php'><font color='blue'><font size='2'>Grant Powers</font></font></a>
<br />
							<a href='../Administration/Item.php'><font color='blue'><font size='2'>Grant Items</font></font></a>
<br />
							<a href='../Administration/Groups.php'><font color='blue'><font size='2'>Groups</font></font></a>

						<br />
						<a href='../Administration/Statistics.php'><font color='blue'><font size='2'>Statistics</font></font></a>
						<br />
						<a href='../Administration/AssetUpload.php'><font color='blue'><font size='2'>Upload Asset</font></font></a>
<a href='../Administration/ChatLogs.php'><font color='blue'>PM Logs</font></a><br />
<a href='../Administration/partychatlogs.php'><font color='blue'>Chat Logs</font></a><br />

												
							<a href='../Administration/MakeNotice.php'><font color='blue'><font size='2'>Set Site Alert</font></font></a><br /></div>
						<br /><br /><a href='UserReports.php'><font color='red'>Abuse Reports($AbuseReports)</font></a><br /><br />
						<a href='../index.php'>Return Home</a>
					
				</div>
			<br /><br />
			<div id='container'><div align='left'>";}
			else{  header("Location: Login.php"); exit();
			}