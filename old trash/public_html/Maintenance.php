<?php
session_id();
session_start();
ob_start();
date_default_timezone_set('America/Chicago');
$connection = mysql_pconnect("mysql.ct8.pl","m27001_w2b","Sg090228") or die ("Error connecting to database.");
mysql_select_db("m27001_w2b") or die ("Error connecting to database, hang tight, we are working on it.");
	
?>
<style>
body {
color:white;
font-family:Segoe UI;
}
body { background-image:url("http://www.freegreatpicture.com/files/191/20288-gyrosigma-light-blue-background.jpg"); }
#Opacity {
background: url(Opacity.png);
padding:12px;
border:1px solid #969696;
border-radius:6px;
width:380px;
}

h3 {
color:#F5F5F5;
font-size:25px;
margin:0;
padding:0;
padding-bottom:10px;
}

#h3sub {
color:#F5F5F5;
font-size:18px;
}

h2 {
color:#F5F5F5;
text-shadow:1px 0px 0px #999;
margin:0;
padding:0;
padding-bottom:10px;
}

input[type=text] {
width:300px;
background:white;
border:1px solid #999;
padding:4px;
font-family:Segoe UI;
border-radius:5px;
}

input[type=password] {
width:300px;
background:white;
border:1px solid #999;
padding:10px;
font-family:Segoe UI;
border-radius:7px;
}

#btn {
background:rgb(34,51,136);
padding:4px;
border-radius:7px;
color:white;
font-family:Verdana;
font-size:30px;
font-weight:bold;
text-shadow:1px 0px 0px rgb(34,34,34);
</style>
<center><td valign='top'>
			<center><img src='/Dir/Avatar.png'></center>
		</td>
<div style='padding-bottom:0px;'></div>
<table>
		<h1><B><font color='darkred'>Maintenance Protocol</FONT></B></h1>
<h4><B><font color='darkred'>Firesplash is currently offline for maintenance and upgrades.</FONT></B></h4>
<h4><B><font color='darkred'>You will be redirected back to the website when this process is complete.</FONT></B></h4>
<br>
</br>
	<tr>

		<td valign='top'>
			<div id='Opacity'>
                        <h0><B><font color='darkblue'>Firesplash</FONT></B></h0>
                        <h2><font color='darkblue'>Developer Login</FONT></h2>
			<form action='' method='POST'>
				<table>
					<tr>
						<td>
							<input type='password' name='Password' placeholder='Passcode...'>
						</td>
					</tr>
					<tr>
						<td>
							<input type='submit' name='submit' value='F'>
<input type='submit' name='submit' value='I'>
<input type='submit' name='submit' value='R'>
<input type='submit' name='submit' value='E'>
<input type='submit' name='submit' value='S'>
<input type='submit' name='submit' value='P'>
<input type='submit' name='submit' value='L'>
<input type='submit' name='submit' value='A'>
<input type='submit' name='submit' value='S'>
<input type='submit' name='submit' value='H'>


						</td>
					</tr>
				</table>
			</form>
			</div>
		</td>
	</tr>
</table>
<?php
$Password = mysql_real_escape_string(strip_tags(stripslashes($_POST['Password'])));
$submit = mysql_real_escape_string(strip_tags(stripslashes($_POST['submit'])));

	if ($submit) {
	
		$Passcode = "5y24G4H@$%Y56herGerefVVVVVVVerqcdfllllLOLFwew4wF!@#$";
		
		if ($Password == $Passcode) {
		
			$_SESSION['Admin']="hi";
			header("Location: index.php");
		
		}
	
	}
echo"<h4><center><font color='darkblue'>&copy Firesplash. All Rights Reserved.</font></h4></center>";
?>
<?php
echo"</div></div>";
?>