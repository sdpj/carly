<?php

include "Global.php";
$PendingAds = mysql_query("SELECT * FROM PendingAds");
$pA = mysql_num_rows($PendingAds);
$getPendingStoreItems = mysql_query("SELECT * FROM ItemDrafts");
$getPendingSI = mysql_num_rows($getPendingStoreItems);
$getPending2 = mysql_query("SELECT * FROM UserStore WHERE active='0'");
$num_pending2 = mysql_num_rows($getPending);
$getAllReports = mysql_query("SELECT * FROM Reports");
$gaR = mysql_num_rows($getAllReports);
$getUserReports = mysql_query("SELECT * FROM UserReports");
$getForumReports = mysql_query("SELECT * FROM ForumReports");
$numUserReports = mysql_num_rows($getUserReports);
$numForumReports = mysql_num_rows($getForumReports);
$total = $pA+$getPendingSI+$num_pending2+$gaR+$numForumReports+$numUserReports;
$getFriendR = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$myU->ID' AND Active='0'");
						$FriendsPending = mysql_num_rows($getFriendR);

?>

	<head>
		<title>Gravitar</title>
	
		<link rel="stylesheet" href="../style.css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet" type="text/css">
		</div>
		<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.6.2.min.js"></script> 
	</head>
	<body>
	<style>

#Userbar {
	font-family: 'Open Sans', sans-serif;
	background-color: #F2F5ED;
	width: 100%;
	height: 40px;
	border-bottom: 1px solid;

}
#Navigation {
	font-family: 'Open Sans', sans-serif;
	background-color: #C4C4C4;
	width: 100%;
	height: 40px;
	border-bottom: 1px solid;

}
#nav {
border:0px solid white;
padding:10px;
background: #45484d; /* Old browsers */
background: -moz-linear-gradient(top,  #45484d 0%, #000000 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#45484d), color-stop(100%,#000000)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #45484d 0%,#000000 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #45484d 0%,#000000 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #45484d 0%,#000000 100%); /* IE10+ */
background: linear-gradient(to bottom,  #45484d 0%,#000000 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#45484d', endColorstr='#000000',GradientType=0 ); /* IE6-9 */
word-spacing:3px;
color:white;
width:100%;

font-weight:bold;
}
#nav:a {
color:white;
}
#nav a {
color:white;
word-spacing:3px;
text-decoration:none;
}
#nav a:hover {
color:yellow;
}
</style>

<?php
function message($subj, $body, $returnto, $okayname, $includecancel, $cancelreturn) {
?>
					<div style='background-image:url(/Imagess/menuhover.png);width:100%;height:100%;top:0;left:0;position:fixed;'><center>
						<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
						<div style='background:#ccc;border:1px solid gray;width:500px;padding:8px;text-align:left;'>
							<fieldset><legend>
								<b><?php print_r($subj); ?></b>
                                </legend>
							<br />
							<form action='<?php print_r($returnto); ?>' method='POST'>
								<?php print_r($body); ?>
								<br />
								<input type='submit' value='<?php print_r($okayname); ?>' id="buttonsmall" />
                                <?php if ($includecancel == true){
									?>
                                    <a href="<?php print_r($cancelreturn); ?>" id="buttonsmall">Cancel</a>
                                    <?php
								}
								?>
							</form>
                            </fieldset>
						</div>
					</div>
						<?php
}


echo"

<div id='nav'>
<table>
<tr>
<td>
<img src='../Images/Gravitar.png' height='32'>&nbsp;&nbsp;&nbsp;&nbsp;
</td>
<td>
<a href='../index.php'>Home</a>&nbsp;&nbsp;&nbsp;&nbsp;
</td>
<td>
<a href='../Hangout.php'>Avatar Hangout</a>&nbsp;&nbsp;&nbsp;&nbsp;
</td>
<td>
<a href='../Members.php'>Members</a>&nbsp;&nbsp;&nbsp;&nbsp;
</td>
<td>
<a href='../Store/Store.php'>Catalog</a>&nbsp;&nbsp;&nbsp;&nbsp;
</td>
<td>
<a href='../Store/UserStore.php'>User Uploads</a>&nbsp;&nbsp;&nbsp;&nbsp;
</td>
</td>
<td>
<a href='../Groups/'>Groups</a>&nbsp;&nbsp;&nbsp;&nbsp;
</td>
<td>
<a href='../Forum/index.php'>Forum</a>&nbsp;&nbsp;&nbsp;&nbsp;
</td>
<td>
<a href='../Upgrade/index.php'>Membership</a>&nbsp;&nbsp;&nbsp;&nbsp;
</td>

"; if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
echo"
<td>
<a href='../Administration/index.php'>Admin<font color='red'>($total)</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
</td>
";
}

echo"
</tr>
</table>
</div>";
 if ($User) { 
$idddd = $myU->ID;
echo"
<div style='background-color:#f2f2f2;padding:10px;text-align:center;width: 100%;border-bottom: 2px solid gainsboro;'>
<font color='green'>Voins: $Bux</font>&nbsp;&nbsp;&nbsp;
<a href='../inbox.php'>Messages: $PMs</a> &nbsp;&nbsp;&nbsp;
<a href='../FriendRequests.php'>Friend Request: $FriendsPending</a>&nbsp;&nbsp; | &nbsp;&nbsp;
<a href='../user.php?ID=" . $myU->ID . "'>My Profile</a>&nbsp;&nbsp;
<a href='../Wall/'>Wall</a>&nbsp;&nbsp;
<a href='../Advertising/ViewAds.php'>My Ads</a>&nbsp;&nbsp;
<a href='../Trade'>My Trade Requests </a>&nbsp;&nbsp;
<a href='../character.php'>My Avatar</a>&nbsp;&nbsp;
<a href='../account.php'>Edit Account</a>&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;
<a href='../Logout.php'>Logout &rarr;</a>
</div>
"; 
}

echo"
</center>
<br />
";

?>

<?
	if ($myU->PowerAdmin == "true") {
	$TicketsPend = mysql_query("SELECT * FROM Tickets WHERE Active='0'");
	$Tickets = mysql_num_rows($TicketsPend);
	}
	if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"||$myU->PowerImageModerator == "true") {
	$getPending = mysql_query("SELECT * FROM PendingAds");
	$pending = mysql_num_rows($getPending);
	echo '
';}
?>
</tr>
</tbody></table>
</div>


						
						
						
						

					</tr>
				</table>
			</td><br />
		</tr>
	</table></center>
</div>
<?php

if ($Maintenance == "true") {
echo" 
<center><div style='border:0px solid white;width:100%;background-color:darkred;'><font color='white'><b>Scheduled maintenance in progress</b></font></div></center>"; } ?>

	
				<?php 
				
								//if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
								//
									//echo '
										//| <a href="../Reports.php">'.$Rep.'</a>
									//';
							//	}
								//if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"||$myU->PowerImageModerator == "true") {
								//echo '
									//	| <a href="../ItemModeration.php">Items ('.$NumPending.')</a>
								//	';
								
								//}
								//if ($myU->PowerAdmin == "true") {
								
								//	echo "
									//	| <a href='../ItemRelease.php'>Store Items (".$NumWaiting = mysql_num_rows($NumWaiting = mysql_query("SELECT * FROM ItemDrafts")).")</a>
								//	</td>
								//	";
								
							//	}
								echo '
							
					
					
				
				'; 
				
				?>

			

			<?php if (!empty($gB->Text)) { echo "
<br>
<center>
		</center>
		<center>"; if ($gB->Color == "darkRed") { echo"<div style='border: 3px solid rgb(73, 0, 0);width: 100%;background-color:$gB->Color;'>"; }
elseif ($gB->Color != "darkRed")  { echo "<div style='border:0px solid black;width:100%; background-color:$gB->Color;'>"; } echo "<br />
			"; if ($gB->Color == "darkRed") { echo " <font color='white'>"; } else { echo"<font color='white'>"; } echo"<font size='2'><b>".nl2br($gB->Text)."<br /><br /></b></font></font></center><br />
				"; }
				if ($User) {
				if ($myU->Verified != 1) {
				echo"<br /><center><div style='border:0px solid black;background-color:red;width:990px;color:white;padding:5px;font-weight:bold;'>
				 This account is not verified. Go <a href='../SendEmail.php'>here</a> to verify.				 </center>
				 </div>";
				 }}
			
$getAdss = mysql_query("SELECT * FROM RunningAds");
$getAds = mysql_query("SELECT * FROM RunningAds ORDER BY RAND() LIMIT 1");
$ads = mysql_fetch_object($getAds);
$numAds = mysql_num_rows($getAdss);
if ($numAds > 3) {
echo "<br /><center><a href='../$ads->Link'><img src='$ads->ImageLink' title='$ads->Name'></a></center>";
if ($myU->Username != $ads->Username) {
mysql_query("UPDATE Users SET Bux=Bux + 1 WHERE Username='$ads->Username'");
mysql_query("UPDATE RunningAds SET MoneyMade=MoneyMade + 1 WHERE Username='$ads->Username'"); }
if ($now > $ads->Time) {
mysql_query("DELETE FROM RunningAds WHERE ID='$ads->ID'"); 

}}
				$extratime = 86400*30;
				$premiumtime = time() + $extratime;
				//echo $premiumtime;
				echo "
			</div>
			
			</center>
			";
			
if ($User) {


if ($myU->Premium == 1) {
echo "<br><style>body { background-image:url(../Images/bg.png); }</style>";
}
}
if ($myU->Premium == 0) {
echo" <br />";
}

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

	$SayP = "<font color='red'><b>Awaiting Profanity Reports ($NumR)</b></font>";

}
else {

	$SayP = "Awaiting Profanity Reports ($NumR)";

}

if ($NumPending > 0) {

	$SayNP = "<font color='red'><b>Awaiting User Items ($NumPending)</b></font>";

}
else {

	$SayNP = "Awaiting User Items ($NumPending)";

}
$NumWaiting = mysql_num_rows($NumWaiting = mysql_query("SELECT * FROM ItemDrafts"));
if ($NumWaiting > 0) {

	$SayNW = "<font color='red'><b>Awaiting Store Items ($NumWaiting)</b></font>";

}
else {

	$SayNW = "Unmoderated Store Items ($NumWaiting)";

}
$getPending1 = mysql_query("SELECT * FROM GroupsPending ORDER BY ID");
$NumPending1 = mysql_num_rows($getPending1);
$getPending2 = mysql_query("SELECT * FROM GroupsLogo");
$NumPending2 = mysql_num_rows($getPending2);

if ($NumPending1 > 0) {

	$SayNP1 = "<font color='red'><b><a href='../ModerateGroups.php'>Awaiting Groups ($NumPending1)</a></b></font>";

}
else {

	$SayNP1 = "<a href='../ModerateGroups.php'>Awaiting Groups ($NumPending1)</a>";

}

if ($NumPending2 > 0) {

	$SayNP2 = "<font color='red'><b><a href='../ModerateLogos.php'>Awaiting Group Logos ($NumPending2)</a></b></font>";

}

else {

	$SayNP2 = "<a href='../ModerateLogos.php'>Awaiting Group Logos ($NumPending2)</a>";

}

$AllShow = $NumR + $NumPending + $NumWaiting + $NumPending1 + $NumPending2;
if ($NumPending > 0||$NumR > 0||$NumWaiting > 0||$NumPending1 > 0) {
$KShow = "<font color='red'><b>Show Moderation Panel <b>&uarr; ($AllShow)</b></font>";
}
else {
$KShow = "Quick Admin <b>&uarr; ($AllShow)";
}


echo "
<script type='text/javascript'>
$(document).ready(function(){
    $('#quickAdmin_hide').hide();
    $('#quick_admin').hide();
		$('#quickAdmin_show').click(function(){
	    $('#quick_admin').delay(500).slideDown();
		$('#quickAdmin_hide').delay(1000).slideDown();
		$('#quickAdmin_show').slideUp();
		});
		$('#quickAdmin_hide').click(function(){
	    $('#quick_admin').delay(500).slideUp();
		$('#quickAdmin_hide').slideUp();
		$('#quickAdmin_show').delay(1000).slideDown();
		});
  });
</script>
";
echo "
<div id='quickAdmin_show' style='position:fixed;bottom:0px;right:250px;background:#ddd;padding:5px;border:1px solid #555; cursor:hand;'>
$KShow</b>
</div>
<div id='quickAdmin_hide' style='position:fixed;bottom:110px;right:250px;background:#ddd;padding:5px;border:1px solid #555; cursor:hand;'>
Hide Moderation Panel<b>&darr;</b>
</div>
<div id='quick_admin' style='position:fixed;bottom:0px;right:250px;background:#ddd;padding:5px;border:1px solid #555;'>
";


if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"||$myU->PowerImageModerator == "true") {
echo "
<a href='../Administration/ViewReports.php'>$SayP</a>
<br />
";
}
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"||$myU->PowerImageModerator == "true") {
echo "<a href='../Administration/ItemModeration.php'>$SayNP</a>
<br />
";
}
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"||$myU->PowerImageModerator == "true") {
echo "<a href='../Administration/ReleaseItem.php'>$SayNW</a><br />";
}
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"||$myU->PowerImageModerator == "true") {
echo "
$SayNP1
<br />
$SayNP2
<br />
<a href='../online.php'><b>Online Users (".$NumOnline.") </b></a>
<br />
";
}
echo "</div>";
}
if($myU)
{
?>
<div pub-key="pub-f144de56-028d-43a9-aaa6-1880aa4b7f1d" sub-key="sub-b3038e9e-d36a-11e1-b1c8-9bc3b49a6845" ssl="off" origin="pubsub.pubnub.com" id="pubnub"></div>
<script src="http://cdn.pubnub.com/pubnub-3.1.min.js"></script>
<script>(function(){
 
    // LISTEN FOR MESSAGES
    PUBNUB.subscribe({
        channel    : "my_channel",      // CONNECT TO THIS CHANNEL.
 
        restore    : false,              // STAY CONNECTED, EVEN WHEN BROWSER IS CLOSED
                                         // OR WHEN PAGE CHANGES.
 
        callback   : function(message) { // RECEIVED A MESSAGE.
		var mychatid2 = document.getElementById("currentchatid").style.top;
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
		var message3 = message2.replace("<?echo$myU->Username;?>","<font color='blue' size='1'><?echo$myU->Username;?></font>");
		var message4 = message3.replace(otheruserchat,"<font color='orange' size='1'>"+otheruserchat+"</font>");
		mychatmessages.innerHTML = (mychatmessages.innerHTML+'<div style="float:left;">'+message3.substr(19)+'</div><br />')
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
 
        connect    : function() {        // CONNECTION ESTABLISHED.
 
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
<div id='chatmessage_thing'><center><b>Invite a user to chat:</b></center></div>
<br /><br />
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
$('#chat_output').html('Please type in a username');
}
if(username == my_username)
{
$('#chat_output').html('You cannot invite youself');
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
mysql_query("DELETE FROM GroupMembers WHERE GroupID='0'");

if ($User == "tyman78910") {
//session_destroy();
}
?>
			<!--End Announcement Bar-->
			
			<!--Begin Main Container-->
			<div id="ct5340">
				<center>
			            
				<div style='top:180px;left:10px;position:fixed;'></div>
					<div id="ct5341">





<?php

function drawAvatar($id, $widthf, $heightf){
$height = $heightf; // 195
$width = $widthf; // 100
$gU = mysql_fetch_array(mysql_query("SELECT * FROM `Users` WHERE `ID`='$id'"));
	echo("
						<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU[Background] . ");'>
						<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(Dir/Avatar.png);'>
							<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU[Eyes] . ");'> 
								<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU[Mouth] . ");'>
									<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU[Hair] . ");'>
										<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU[Bottom] . ");'>
											<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU[Top] . ");'>
												<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU[Hat] . ");'>
													<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU[Shoes] . ");'>
														<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU[Accessory] . ");'>	
														</div></div></div></div></div></div></div></div></div></div>
														
														");
                                                        
}


?>