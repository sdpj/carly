<?php
session_id();
session_start();
ob_start();
date_default_timezone_set('America/Chicago');
$connection = mysql_pconnect("localhost","socialpa_user","lolkpass123") or die("Error connecting to database, hang tight, we are working on it.");
mysql_select_db("socialpa_database") or die("Error connecting to database, hang tight, we are working on it.");

	/* Session */
	
	$User = $_SESSION['Username'];
	$Password = $_SESSION['Password'];
	$Admin = $_SESSION['Admin'];
	 
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
		  $IP=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
		  $IP=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		  $IP=$_SERVER['REMOTE_ADDR'];
		}

	if ($User) {
	
		$MyUser = mysql_query("SELECT * FROM Users WHERE Username='".$User."'");
		$myU = mysql_fetch_object($MyUser);
		$UserExist = mysql_num_rows($MyUser);
		
			if ($UserExist == "0") {
			
				session_destroy();
				header("Location: /index.php");
			
			}
			mysql_query("UPDATE Users SET IP='$IP' WHERE Username='$myU->Username'");
			
			$checkifInDatabase = mysql_query("SELECT * FROM UserIPs WHERE IP='$IP' AND UserID='$myU->ID'");
			$cii = mysql_num_rows($checkifInDatabase);
			
				if ($cii == "0") {
				mysql_query("INSERT INTO UserIPs (UserID, IP) VALUES('$myU->ID','$IP')");
				}
				
			if ($Password != $myU->Password) {
			session_destroy();
			}
	
	}
?>
<?php
if($myU)
{
?>
<link rel="stylesheet" href="http://avatar-gamer.ga/style.css">
<script type='text/javascript'>
function moveuser() {
var y = $("#user_<?echo$myU->ingamenum;?>").offset().top;
var x = $("#user_<?echo$myU->ingamenum;?>").offset().top;
document.getElementById("u1").innerHTML = 'ddd';
document.getElementById("u2").innerHTML = 'ddd';
var boundary1_y = 347;
var boundary2_y = 550;
var boundary1_x = -10;
var boundary2_x = 1090;
interval = 5;
if (window.event) keycode = window.event.keyCode;
if (keycode==87) {
if(y>boundary1_y) y = y - interval;
	$('#user_<?echo$myU->ingamenum;?>').offset().marginTop = y+'px';
}
if (keycode==65) {
if(x>boundary1_x) x = x - interval;
	$('#user_<?echo$myU->ingamenum;?>').offset().marginLeft = x+'px';
}
if (keycode==83) {
if(y<boundary2_y) y = y + interval;
	$('#user_<?echo$myU->ingamenum;?>').offset().marginTop = y+'px';
}
if (keycode==68) {
if(x<boundary2_x) x = x+ interval;
	$('#user_<?echo$myU->ingamenum;?>').offset().marginLeft = x+'px';
}
}
</script>
<body onkeydown='moveuser()'>
<div id='world' style='margin:0 auto; margin-top:30px; background-image:url(/newgame/buildbg.png); border:2px solid black; height:550px; width:1100px;'>
<div id='clickevents' style='height:550px; width:1100px; border:1px solid grey; position:absolute;'></div>
<div id='user_<?echo$myU->ingamenum;?>' style='height:100px; width:100px; background-image:url(/newgame/soldier.png); position:absolute; margin-top:347px;'></div>
</div>
<br />
<div id='u1'></div>
<br />
<div id='u2'></div>
<?
}
?>
</body>