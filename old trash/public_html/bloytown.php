<?php
error_reporting(0);
include "Global.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="https://www.facebook.com/2008/fbml"> 
<head>
<?
// DO NOT TOUCH THE BELOW CODE!
// EVEN IF YOU ARE ADVANCED!
// THIS IS IMPORTANT CODE THAT PREVENTS XSS ATTACKS AND SETS A COOKIE FOR ANALYSIS.
$name = "xss";
ini_set('session.cookie_domain', '.reborn2go.rf.gd' );
setcookie('XSSProtection',$name,time() + (86400 * 7)); // 86400 = 1 day
?>

<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
<title>Reborn2Go</title>
<link rel="stylesheet" href="/Base/Style/Main2.css">
<link rel="stylesheet" href="https://bootswatch.com/cosmo/bootstrap.css">
<link rel="stylesheet" href="/Base/Style/Bootstrap.css">
<link rel="stylesheet" href="/noynac.css">
<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jquery/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="https://www.tumuski.com/library/Nibbler/Nibbler.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://bootswatch.com/assets/js/custom.js"></script>
<script src="http://bootswatch.com/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script><script>

     var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-23019901-1']);
      _gaq.push(['_setDomainName', "bootswatch.com"]);
        _gaq.push(['_setAllowLinker', true]);
      _gaq.push(['_trackPageview']);

     (function() {
       var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
       ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
     })();

    </script>
  <script id="_carbonads_projs" type="text/javascript" src="//srv.carbonads.net/ads/C6AILKT.json?segment=placement:bootswatchcom&amp;callback=_carbonads_go"></script><script type="text/javascript" src="http://adn.fusionads.net/launchbit/9533/developers//bootswatchcom/8/?click_redir=%2F%2Fsrv.carbonads.net%2Fads%2Fclick%2Fx%2FGTND423YCEBDC23JCT74YKQWFTBDVK3WCA7DLZ3JCEADV237F6AI5KQKC6BDE23WCKBDEK3EHJNCLSIZZRLCP7I35MNFV%3Fencredirect%3D"></script>
<script type="text/javascript">/* <![CDATA[ */(function(d,s,a,i,j,r,l,m,t){try{l=d.getElementsByTagName('a');t=d.createElement('textarea');for(i=0;l.length-i;i++){try{a=l[i].href;s=a.indexOf('/cdn-cgi/l/email-protection');m=a.length;if(a&&s>-1&&m>28){j=28+s;s='';if(j<m){r='0x'+a.substr(j,2)|0;for(j+=2;j<m&&a.charAt(j)!='X';j+=2)s+='%'+('0'+('0x'+a.substr(j,2)^r).toString(16)).slice(-2);j++;s=decodeURIComponent(s)+a.substr(j,m-j)}t.innerHTML=s.replace(/</g,'&lt;').replace(/>/g,'&gt;');l[i].href='mailto:'+t.value}}catch(e){}}}catch(e){}})(document);/* ]]> */</script>
<script>WebFont.load({
  google: {
    families: ["Source Sans Pro:200,300,regular,600,700,900"]
  }
});</script>

<style>

h1 {
font-weight: 300;
}
font {
font-weight: 400;
}

</style>

		<script>
		$(document).ready(function(){
		$('.redirect').click(function(){
		window.location = $(this).attr('redirect');
		});
		});
		</script>
		
		

	</head>
	<body>

		<div align='center'>

		</div>



	<?php
// Show premium background if premium
if ($myU->Premium == 1) {
	echo "
	<style>
	body {
margin:0;
padding:0;
font-family:'Source Sans Pro', sans-serif;
color: #333;
background-color: blqack;
background-image: url('/images/dark-striped-pattern-1780.png');
line-height: 20px;
font-weight: 400;
height:100%;
}
</style>
";
}
if (!$User) {
	echo "
	<style>
	body {
margin:0;
padding:0;
font-family:'Source Sans Pro', sans-serif;
color: #333;
line-height: 20px;
font-weight: 400;
height:100%;
}
</style>
	";
}
if ($myU->Premium == 0) {
		echo "
	<style>
	body {
margin:0;
padding:0;
font-family:'Source Sans Pro', sans-serif;
color: #333;
line-height: 20px;
font-weight: 400;
height:100%;
}
</style>
	";
}
	
// Show different headers if user is premium/not premium	
if ($myU->Premium == 0) {
echo "

<div class='navbar navbar-inverse'>

";
}
else {
echo "
<div class='navbar navbar-default'>

";
}
?>
				
				


                     

 
                    </ul>

 <ul class='nav navbar-nav navbar-right'>
									<?php
									
										if ($myU->PowerAdmin == "true") {
										
											echo "
                                                                          <li><a href='/Admin/?tab=configuration'>Admin</a></li>
											";
										
										}
										
	
										
									if ($User) {
									
										echo "
									
									


									
										
								
										";
									
									}
									else {
									
										echo "
									
                                                                        
								
										";
									
									}
									?>

                      
                    </ul>
                  </div>
                </div>
              </nav>
            <div id='source-button' class='btn btn-primary btn-xs' style='display: none;'>&lt; &gt;</div></div>

			</div>
			
		<?php
		// WHEN UPDATING THE SUBBAR LINKS, EDIT BOTH BELOW.
		// UPDATE $myU->Premium == 0 AND $myU->Premium == 1
		// IF YOU ARE CONFUSED, <DON'T> EDIT IT!
		// -JOE
		?>
		
	<?php  if ($User) { 
if ($myU->Premium == 0) {
	echo "<center>
		<div id='navbar_links2' style='
    margin-top: -22px;
'>
		<table cellspacing='0' cellpadding='0'>
			<tr>
				<td>
					<a href='/'>-</a>
				</td>
				<td>
				    <a href='/'>Home</a>
				</td>
				<td>
					<a href='/user.php?ID=$myU->ID'>Public Profile</a>
				</td>
				<td>
				    <a href='/account.php'>Account</a>
				</td>
				<td>
				    <a href='/Store/UserStore.php'>Store</a>
				</td>
				<td>
				    <a href='/Groups/'>Groups</a>
				</td>
				<td>
				    <a href='/forum/'>Forum</a>
				</td>
				<td>
				    <a href='/Memberships/UpgradeAccount.php'>Upgrade</a>
				</td>
				<td>
				    <a href='/users/'>Users</a>
				</td>
				<td>
					<a href='/character.php'>Character</a>
				</td>
				<td>
					<a href='/FriendRequests.php'>Friend Requests ($FriendsPending)</a>
				</td>
				<td>
					<a href='/inbox.php'>Inbox ($PMs)</a>
				</td>
				<td>
					<a href='/Blog/'>Blog</a>
				</td>
				<td>
				    <a href='/Logout.php'>Logout</a>
				</td>
			</tr>
		</table>
		</div>
		</center>
		";
}
if ($myU->Premium == 1) {
	echo "<center>
		<div id='navbar_links2' style='
    margin-top: -22px;
background-color:#333333; color:blue;'>
		<table cellspacing='0' cellpadding='0'>
			<tr>
				<td>
					<a href=''>Home</a>
				</td>
				<td>
				    <a href='/Store/UserStore.php'>Shop</a>
				</td>
				<td>
				    <a href='/forum/'>Forum</a>
				</td>
				<td>
				    <a href='/account.php'>Account</a>
				</td>
				<td>
					<a href='/user.php?ID=$myU->ID'>Public Profile</a>
				</td>
				<td>
					<a href='/character.php'>Character</a>
				</td>
				<td>
					<a href='/FriendRequests.php'>Friend Requests ($FriendsPending)</a>
				</td>
				<td>
					<a href='/inbox.php'>Inbox ($PMs)</a>
				</td>
				<td>
					<a href='/Groups/'>Groups</a>
				</td>
				<td>
					<a href='/ItemLogs.php?view=all'>Purchase Logs</a>
				</td>
				<td>
					<a href='/Blog/'>Blog</a>
				</td>
				<td>
				    <a href='/users/'>Users</a>
				</td>
				<td>
				   <a href='/Logout.php'>Logout</a>
				</td>
			</tr>
		</table>
		</div>
		</center>
		";
}
	}
		?>
	<center>


			<!--End Top Bar-->
		
			<!--Important notification, use for emergencies -->
			
			<!-- 
			<div class='bannernotification' style='font-weight: 400; background-color: #00a2ff; box-shadow: 0px 0px; 0px; 0px;'>
			<div class='bannernotificationtext'> You will be logged out of your account in <b>1 minute</b>. Your data will not be lost. This is part of a website safety inspection. </div></div> <br /><br />
			-->


			<?php
			if ($myU->Verified == "0") {
			echo "
			<div id='error'>
<font size='3'><center>You haven't verified your account yet! Click <a href='/EmailSend.php?email=$myU->Email'>here</a> to verify.</font></div></center>

";
}
?>


			<?php 
			
			if ($myU->Premium == 0 AND $User) {
			if (!empty($gB->Text)) { echo "
			
			
			
			
			
			
			<style>
			.bannernotification {
padding: 10px 5px;
background-color: #00a2ff;
box-shadow: gray 0px 1px 3px 0px;
}
.bannernotificationtext {
color: white;
padding-left: 5px;
padding-right: 5px;
font-size:16px;
text-align: center;
}
</style>
		
		
		<div class='bannernotification' style='font-weight: 400; box-shadow: 0px 0px; 0px; 0px;'>
<div class='bannernotificationtext'> ".nl2br($gB->Text)." </div></div>
";
			




			
				$kkk = 30*6;
				$extratime = 86400*$kkk;
				$premiumtime = time() + $extratime;
				//echo $premiumtime;
				echo "
			</div>
			
			</center>
			
			";
			}
			}
			if ($myU->Premium == 1) {
			if (!empty($gB->Text)) { echo "
			
			
			
			
			
			
			<style>
			.bannernotification {
padding: 10px 5px;
background-color: #ffa550;
box-shadow: gray 0px 1px 3px 0px;
}
.bannernotificationtext {
color: white;
padding-left: 5px;
padding-right: 5px;
font-size:16px;
text-align: center;
}
</style>
		
		
		<div class='bannernotification' style='font-weight: 400; background-color:gray; box-shadow: 0px 0px; 0px; 0px;'>
<div class='bannernotificationtext'> ".nl2br($gB->Text)." </div></div>
";
			




			
				$kkk = 30*6;
				$extratime = 86400*$kkk;
				$premiumtime = time() + $extratime;
				//echo $premiumtime;
				echo "
			</div>
			
			</center>
			
			";
			}
			}
			
			elseif (!$User) {
				if (!empty($gB->Text)) { echo "
			
			
			
			
			
			
			<style>
			.bannernotification {
padding: 10px 5px;
background-color: #00a2ff;
box-shadow: gray 0px 1px 3px 0px;
}
.bannernotificationtext {
color: white;
padding-left: 5px;
padding-right: 5px;
font-size:16px;
text-align: center;
}
</style>
		
		
		<div class='bannernotification' style='font-weight: 400; box-shadow: 0px 0px; 0px; 0px;'>
<div class='bannernotificationtext'> ".nl2br($gB->Text)." </div></div>
";
			




			
				$kkk = 30*6;
				$extratime = 86400*$kkk;
				$premiumtime = time() + $extratime;
				//echo $premiumtime;
				echo "
			</div>
			
			</center>
			
			";
			}
			}
			
		

			echo "<br />";
			
			
		

$getAllGroups = mysql_query("SELECT * FROM Groups");
	
	while ($gAG = mysql_fetch_object($getAllGroups)) {
	
		$getAllMembers = mysql_query("SELECT * FROM GroupMembers WHERE GroupID='$gAG->ID'");
		$gA = mysql_num_rows($getAllMembers);
		
		mysql_query("UPDATE Groups SET GroupMembers='$gA' WHERE ID='$gAG->ID'");
	
	}

?>
<?php
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"||$myU->PowerImageModerator == "true") {
$NumOnline = mysql_num_rows($NumOnline = mysql_query("SELECT * FROM Users WHERE $now < expireTime"));
if ($NumR > 0) {

	$SayP = "<font color='red'><b>Unmoderated Profanity Reports ($NumR)</b></font>";

}
else {

	$SayP = "Unmoderated Profanity Reports ($NumR)";

}

if ($NumPending > 0) {

	$SayNP = "<font color='red'><b>Unmoderated User Items ($NumPending)</b></font>";

}
else {

	$SayNP = "Unmoderated User Items ($NumPending)";

}
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
$NumWaiting = mysql_num_rows($NumWaiting = mysql_query("SELECT * FROM ItemDrafts"));
if ($NumWaiting > 0) {

	$SayNW = "<font color='red'><b>Unmoderated Store Items ($NumWaiting)</b></font>";

}
else {

	$SayNW = "Unmoderated Store Items ($NumWaiting)";

}
}
$getPending1 = mysql_query("SELECT * FROM GroupsPending ORDER BY ID");
$NumPending1 = mysql_num_rows($getPending1);
$getPending2 = mysql_query("SELECT * FROM GroupsLogo");
$NumPending2 = mysql_num_rows($getPending2);


if ($NumPending1 > 0) {

	$SayNP1 = "<font color='red'><b><a href='../ModerateGroups.php'>Unmoderated Groups ($NumPending1)</a></b></font>";

}
else {

	$SayNP1 = "<a href='../ModerateGroups.php'>Unmoderated Groups ($NumPending1)</a>";

}

if ($NumPending2 > 0) {

	$SayNP2 = "<font color='red'><b><a href='../ModerateLogos.php'>Unmoderated Group Logos ($NumPending2)</a></b></font>";

}

else {

	$SayNP2 = "<a href='../ModerateLogos.php'>Unmoderated Group Logos ($NumPending2)</a>";

}

if ($NumPending3 > 0) {

	$SayNP3 = "<font color='red'><b><a href='../PendingAds.php'>Unmoderated Ads ($NumPending3)</a></b></font>";

}

else {

	$SayNP3 = "<a href='../PendingAds.php'>Unmoderated Ads ($NumPending3)</a>";

}












if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
$AllShow = $NumR + $NumPending + $NumWaiting + $NumPending1 + $NumPending2 + $NumPending3;
}
else {
$AllShow = $NumR + $NumPending + $NumWaiting + $NumPending1 + $NumPending2 + $NumPending3;
}
if ($NumPending > 0||$NumR > 0||$NumWaiting > 0||$NumPending1 > 0||$NumPending2 > 0||$NumPending3 > 0) {
$KShow = "<font color='red'><b>Show Quick Admin <b>&uarr; ($AllShow)</b></font>";
}
else {
$KShow = "Show Quick Admin <b>&uarr; ($AllShow)";
}


echo "
<script type='text/javascript'>
$(document).ready(function(){
    $('#quickAdmin_hide').hide();
    $('#quick_admin').hide();
		$('#quickAdmin_show').click(function(){
	    $('#quick_admin').delay(1).slideDown();
		$('#quickAdmin_hide').delay(1).slideDown();
		$('#quickAdmin_show').slideUp();
		});
		$('#quickAdmin_hide').click(function(){
	    $('#quick_admin').delay(1).slideUp();
		$('#quickAdmin_hide').slideUp();
		$('#quickAdmin_show').delay(1).slideDown();
		});
  });
</script>
";
echo "
<div id='quickAdmin_show' style='position:fixed;bottom:0px;right:250px;background:#eee;padding:5px;border:1px solid #aaa; cursor:pointer; font-size:9pt;'>
$KShow</b>
</div>
<div id='quickAdmin_hide' style='position:fixed;bottom:110px;right:250px;background:#eee;padding:5px;border:1px solid #aaa;cursor:pointer; font-size:9pt;'>
Hide Quick Admin <b>&darr;</b><br /><br /><br /><br />
</div>
<div id='quick_admin' style='position:fixed;bottom:0px;right:250px;background:#eee;padding:5px;border:1px solid #aaa; font-size:9pt;'>
<div align='left'>
";


if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
echo "
<a href='../Reports.php'>$SayP</a>
<br />
";
}
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"||$myU->PowerImageModerator == "true") {
echo "<a href='../ItemModeration.php'>$SayNP</a>
<br />
";
}
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
echo "<a href='../ItemRelease.php'>$SayNW</a><br />";
}
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
if ($NumPending4 > 0) {

	$SayNP4 = "<font color='red'><b><a href='../RunningAds.php'>Running Ads ($NumPending4)</a></b></font>";

}

else {

	$SayNP4 = "<font color='red'><a href='../RunningAds.php'>Running Ads ($NumPending4)</a></font>";

}



echo "
$SayNP1
<br />
$SayNP2
<br />
$SayNP3
<br />
$SayNP4
<br />
<a href='../online.php'><b>Online Users (".$NumOnline.") </b></a>
<br />
</div>
";
}
}
echo "</div></div>";


















if($myU)
{
?>
<div pub-key="pub-f144de56-028d-43a9-aaa6-1880aa4b7f1d" sub-key="sub-b3038e9e-d36a-11e1-b1c8-9bc3b49a6845" ssl="off" origin="pubsub.pubnub.com" id="pubnub"></div>
<script src="https://cdn.pubnub.com/pubnub-3.1.min.js"></script>
<script>(function(){
 
 // LISTEN FOR MESSAGES
 PUBNUB.subscribe({
 channel : "my_channel", // CONNECT TO THIS CHANNEL.
 
 restore : true, // STAY CONNECTED, EVEN WHEN BROWSER IS CLOSED
 // OR WHEN PAGE CHANGES.
 
 callback : function(message) { // RECEIVED A MESSAGE.
		var myid2 = document.getElementById("currentchatid").style.top;
		var mychatid = mychatid2.substr(0,6);
		var otheruserchat = document.getElementById('otheruserchat').value;
		if(message.substr(0,10) == 'chatinvite')
		{
		if(message.substr(11,5) == '<?echo$myU->ingamenum;?>')
		{
		}
		else
		{
		if(message.substr(17,5) == '<?echo$myU->ingamenum;?>')
		{
		var inviteusernum = message.substr(11,5);
		$('#chat_output').load('/Header.php?chataction=getchat&usertocheckchat=ddd&new=1');
		}
		else
		{
		}
		}
		}
		if(message.substr(0,11) == 'chatmessage')
		{
		if(message.substr(12,6) == mychatid)
		{
		var message2 = message.replace(/00dz00/g,"&nbsp");
		var message3 = message2.replace("<?echo$myU->Username;?>","<font color='blue'><?echo$myU->Username;?></font><br /><br />");
		var message4 = message3.replace(otheruserchat,"<font color='orange'>"+otheruserchat+"</font><br /><br />");
		mychatmessages.innerHTML = (mychatmessages.innerHTML+'<div style="float:left;word-wrap:break-word;   word-spacing: 30000px; 
">'+message3.substr(500)+'</div><br /><br />')
		}
		else
		{
		}
		}
		if(message.substr(0,10) == 'chatremove')
		{
		if(message.substr(17,5) == '<?echo$myU->ingamenum;?>')
		{
		$('#chat_output').load('/Header.php?chataction=remove&removenew=1');
		}
		else
		{
		}
		}
 },
 
 connect : function() { // CONNECTION ESTABLISHED.
 
 }
 })
 
})();</script>
<?
echo "
<script type='text/javascript'>

$(document).ready(function(){
	if(mychatid > 0)
	{
	$('#chat_interface').hide().delay(2000).show();
	}
	if(mychatid < 1)
	{
 $('#chat_interface').hide();
	}
		$('#show_chat').click(function(){
	 $('#chat_interface').delay(500).fadeIn(500);
			});
		$('#close_chat').click(function(){
	 $('#chat_interface').delay(500).slideUp();
		$('#close_chat').slideUp();
		$('#show_chat').delay(1000).slideDown();
		});
 });
</script>
";
echo "
<div id='show_chat' style='position:fixed;bottom:1px;right:5px;width:150px;border:2px solid #aaa;border-radius:5px; cursor:hand;background:#F0F0F0;'>
<center>Open Chat</center>
</div>
<div id='close_chat' style='width:225px;position:fixed;bottom:150px;right:5px;border:2px solid #aaa;border-radius:5px; cursor:hand;background:#F0F0F0; cursor:hand;'>
<center>Close Chat <b>&darr;</b></center>
</div>
<div id='chat_interface' style='height:140px;width:225px;position:fixed;bottom:0px;right:5px;border:2px solid #aaa;border-radius:5px;background:#F0F0F0;'>
<br />
<div id='chatmessage_thing'><center><b>Invite a user to chat.</b></center></div>
<br />
<center>
<input type='text' id='cleartext_chat' name='username_chat' style='border:1px solid grey; color:grey; font-weight:bold;' value='Type username here'>
<button name='invite_chat' id='invitechat_button' value='' onclick='invitechat(this.value)' style='cursor:hand;'>Invite</button>
<br /><br />
<b><div id='chat_output'></div></b>
</center>
";
echo "</div>";
?>
<script type='text/javascript'>
 $(document).ready(function(){
 $('#cleartext_chat').val('').delay().val('Type username here');
 });
 $('#cleartext_chat').click(function(){
 $('#cleartext_chat').val('');
	$('#invitechat_button').val('');
 });
 <?
 if($myU->chatid > 0)
 {
 ?>
 var mychatid = <?echo$myU->chatid;?>;
 if(mychatid > 0)
 {
 $('#chat_output').load('/Header.php?chataction=getchat&usertocheckchat=ddd&new=1');
		$('#close_chat').hide();
		$('#show_chat').hide();
		$('#close_chat2').show();
 }
 <?
 }
 ?>
function invitechat()
{
var usernamea = $('#cleartext_chat').val();
var username = usernamea.toLowerCase();
var my_usernamea = '<?echo$myU->Username;?>';
var my_username = my_usernamea.toLowerCase();
if(username.length < 1)
{
$('#chat_output').html('Please type in a username.');
}
if(username == my_username)
{
$('#chat_output').html('You cannot invite yourself!');
}
if(username != my_username && username.length > 0)
{
$('#chat_output').load('/Header.php?chataction=getchat&usertocheckchat='+username);
}
}
function removechat()
{
$('#chat_output').load('/Header.php?chataction=removechat');
}
</script>
<script>
$('#close_chat').hide();
$('#chat_interface').hide();
$('#show_chat').click(function(){
var mychatid5 = document.getElementById("currentchatid").style.top;
$('#show_chat').slideUp(500);
$('#chat_interface').delay(500).slideDown(500);
if(mychatid5 < 1)
{
$('#close_chat').delay(1000).slideDown(500);
}
if(mychatid5 > 0)
{
$('#close_chat2').delay(1000).slideDown(500);
}
});
$('#close_chat').click(function(){
$('#close_chat').slideUp(500);
$('#chat_interface').delay(500).slideUp(500);
$('#show_chat').delay(1000).slideDown(500);
});
$('#close_chat2').click(function(){
var mychatid5 = document.getElementById("currentchatid").style.top;
$('#close_chat2').slideUp(500);
$('#chat_interface').delay(500).slideUp(500);
$('#show_chat').delay(1000).slideDown(500);
});
</script>
<div id='currentchatid'></div>
<input type='hidden' id='otheruserchat'>
<?
}
?>
			<!--End Announcement Bar-->
			
			
		<?php
			$connection = mysql_connect("mysql.ct8.pl","m24817_blox","Sg090228") or die("Error connecting to database, hang tight, we are working on it.");
			mysql_select_db("m24817_blox") or die("Error connecting to database, hang tight, we are working on it...");
			$getAds = mysql_query("SELECT * FROM Ads WHERE Active='1' ORDER BY RAND() LIMIT 1");
			$gU = mysql_query("SELECT * FROM Users WHERE ID");
				
			while ($gA = @mysql_Fetch_object($getAds)) {

			$Timer = time();
	
			if ($Timer >= $gA->Time) {
			mysql_query("UPDATE Ads SET Active=0 WHERE AdID='$gA->AdID'");
			}
			$hashedad = hash('ripemd160',"".$gA->Name."");
			echo "<center>
			<a href='$gA->Link' target='_BLANK'>
			<img src='$gA->Image' height='90' width='728'></img>
			</a>
			<table width='720px'>
			<tr>
			<td width='40%'></td>
			<td width='50%' style='font-weight:400;'>Ad by $gA->Username</td>
			</tr>
			</table>
			
			</center><br /><br />";

			}
		?>
			
			<!--Begin Main Container-->
			
				<center>
					<div id="Container"><div align='left'>
				<?php 
					
					$rainbow = mysql_query("SELECT * FROM Users WHERE ID='".$myU->ID."'");
					$rainbow = mysql_fetch_object($rainbow);
					
					$_SESSION['Username'] = $rainbow->Username;
					$_SESSION['Password'] = $rainbow->Password;
					
					
				?>