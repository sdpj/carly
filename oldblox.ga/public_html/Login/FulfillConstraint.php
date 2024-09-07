<?
	session_id();
session_start();
ob_start();
date_default_timezone_set('America/Chicago');
@mysql_connect("localhost","avatarga_usr","a12bcd101");
	mysql_select_db("avatarga_Db");
	echo'<link rel="icon" type="image/png" href="/Images/wrench-64.png">
	<style>
	body{
		background-color:#610B0B;
	}
	</style>';
	echo"
	 <META http-equiv='refresh' content='60;URL=/Landing/Animated/'>
	<link rel='stylesheet' type='text/css' href='/Base/Style/Main.css'>
	<div class='site-header'>
		<div id='navigation-container'>
			<a href='/'>
				<img src='/Images/Avatar-Universe-logo.png' width='190' height='35' style='margin-bottom:2px;margin-right:15px;vertical-align:bottom;' title='World2Build'>
			</a>
		</div>
	</div>
	";
	echo"
	<div id='bodywrapper' style='background:#E4E4E4;'>
	<div id='Body' style='background:#E4E4E4;'>
	";
	$MaintenanceStatus = mysql_query("SELECT * FROM `Maintenance`");
	$Maintenance = mysql_fetch_object($MaintenanceStatus);
	
	if ($Maintenance->Status == "false") {
		header("Location: /Landing/Animated/");
		die();
	}
	
	echo"<link rel='stylesheet' type='text/css' href='/Base/Style/Main.css'>";
	
	echo"
	<style>
	body{
	background-color:#E4E4E4;
	}
	</style>
	
	<style>
#ForumBar {
background-color: #343434;
padding:5px;
color:white;
width:100%;
font-weight:bold;
border-top-left-radius:0px;
border-top-right-radius:0px;
font-size:20px;
padding-top:5px;
padding-bottom:5px;
padding-left:5px;
}

</style>
	<title>
		Avatar-Universe | Maintenance
	</title>
	";
	
	
	
	echo"
	<div align='center'>
		<div id='container' style='width:900px;text-align:left;border:0;background:#E4E4E4;'>
			<div style='padding-top:80px;'></div>
			<center>
				<img src='../Login/maint_logo.png'>
			</center>
			<div style='padding-top:5px;'></div>
				<center>
					<strong style='font-size:16px;'>The site is currently offline for maintenance and upgrades. Please check back soon!</strong>
				</center>
			<div style='padding-top:50px;'></div>
			<center>
				Avatar-Universe is currently undergoing maintenance. You'll be updated when the website comes back online.
				<br>
				<br>
				Because you're an awesome player, you'll be redirected when we're done upgrading the website. Stay tuned!
			</center>
	</div>
	</div>
	</div>
	</div>
	<div class='footer-container' style='height:auto;'>
		<div id='footer-nav' style='height:auto;'>
			<a href='/info/Privacy.aspx'>
				Privacy Policy
			</a>
			&nbsp;|&nbsp;
			<a href='../test.php'>
				Advertise with Us
			</a>
			&nbsp;|&nbsp;
			<a href='../test.php'>
				Press
			</a>
			&nbsp;|&nbsp;
			<a href='../test.php'>
				Contact Us
			</a>
			&nbsp;|&nbsp;
			<a href='../test.php'>
				About Us
			</a>
			&nbsp;|&nbsp;
			<a href='../test.php'>
				Blog
			</a>
			&nbsp;|&nbsp;
			<a href='../test.php'>
				Jobs
			</a>
			&nbsp;|&nbsp;
			<a href='../test.php'>
				Parents
			</a>
			&nbsp;|&nbsp;
			<a href='../test.php'>
				Online Store
			</a>
			<hr color='white' size='1' style='margin:10px;'>
			<table width='100%' cellspacing='0' cellpadding='0'>
				<tr>
					<td width='75'>
						<img src='/Badgess/Administrator.png' height='75' width='75' style='vertical-align:middle;margin-right:10px;'>
					</td>
					<td width='775'>
						<table width='100%' cellspacing='0' cellpadding='0'>
							<tr>
								<td>
									<div id='badgecontainer' style='color:white;font-size:12px;text-align:left;'>
										Avatar-Universe, characters, logos, names, and all related indicia are copyrighted under Avatar-Universe INC, &copy; 2015. Patents pending. Avatar-Universe is not sponsored, authorized or endorsed by any producer of plastic building bricks, including The LEGO Group, MEGA Brands, ROBLOX, &quot;Social Avatar Network Script&quot;, and K'Nex, and no resemblance to the products of these companies is intended. Use of this site signifies your acceptance of the <a href='/info/terms-of-service/'>Terms and Conditions</a>.
									</div>
								</td>
							</tr>
						</table>	
					</td>
				</tr>
			</table>
			<p>
				<center>
					<p>
						<font color='white'>
							Developer Login
						</font>
					</p>
					<form action='' method='POST'>
						<input type='password' name='Password' style='width:250px;'>
						<input type='submit' value='Login' name='loginbutton1'>
					</form>
				</center>
			</p>
			<br />
	";
	
	$Password = mysql_real_escape_string(strip_tags(stripslashes($_POST['Password'])));
	$submit1 = mysql_real_escape_string(strip_tags(stripslashes($_POST['loginbutton1'])));
	if ($submit1){
		$Passcode = "indust";
		if ($Password == $Passcode){
			$_SESSION['Admin']="Admin";
			header("Location: /Landing/Animated/");
			die();
		}else{
			echo"
			<center>
				<font color='white'>
					Incorrect passcode provided.
				</font>
			</center>
			";
		}
	}
	 
	echo"
	</div>
	</div>
	</table>
	</div>
	</center>
	</div>
	";
?>