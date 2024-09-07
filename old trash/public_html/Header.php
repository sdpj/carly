<?php

include "Global.php";
  $theFrenz = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$myU->ID' AND Active='1'");
  $Frenz = mysql_num_rows($theFrenz);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>FireSplash</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" href="../Base/Themes/Default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Base/Style/Nivo.css" type="text/css" media="screen" />
    <!--<script type="text/javascript" src="/snowstorm.js"></script>-->
    <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="http://www.tumuski.com/library/Nibbler/Nibbler.js"></script>
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
      <div id='Header'> 
        <table cellspacing='0' cellpadding='0' width='100%' style='white-space:nowrap;'>
          <tr>
            <td width='1'>
              <img src='/Imagess/SPNewLogo.png'  height='40' style='float:left !important;display:inline-block;text-align: left;padding-left: 15px;position: absolute;top:3px;' align='left'>
            </td>
            <td style='text-align:center !important;'>
              <table cellspacing='0' cellpadding='0' style='white-space:nowrap;text-align:center !important;margin: auto;display:inline;padding-left:30px;'>
                <tr>
                  <td>
                    <a href='/'>Home</a>
                  </td>
                  <td>
                    <a href='/Members.php'>Users</a>
                  </td>
                  <td>
                    <a href='/Store/'>Store</a>
                  </td>
                  <td>
                    <a href='/Store/UserStore.php'>User Store</a>
                  </td>
                  <td>
                    <a href='/Groups/'>Groups</a>
                  </td>
                  <td>
                    <a href='/Forum/'>Forum</a>
                  </td>
                  <td>
                    <a href='/upgrades.php'>Upgrades</a>
                  </td>
                  <?php
                  
                    if ($User) {
                    
                  //  echo "
                  //<td>
                  //  <a href='/TradeSystem'>Trade</a>
                //  </td>
                //    ";
                    
                    }
                  
                  ?>
                  <?php
                  
                    if ($myU->PowerAdmin == "true") {
                    
                      echo "
                  <td>
                    <a href='../Admin/?tab=configuration'>Admin</a>
                  </td>
                      ";
                    
                    }
                    
                  if ($User) {
                  
                    echo "
                  <td style='padding-left:35px;'>
                    <a href='/user.php?ID=$myU->ID'>$User</a>
                  </td>
                  <td>
                    <a href='#'><i class='fa fa-money' style='color:#fff;'></i><font color='#fff'> $Bux</font></a>
                  </td>
                  <td>
                    <a href='/Logout.php'>Logout</a>
                  </td>
                    ";
                  
                  }
                  else {
                  
                    echo "
                  <td style='padding-left:35px;'>
                    <a href='/Login.php'>Login</a>
                  </td>
                  <td>
                    <a href='/register.php'>Register</a>
                  </td>
                    ";
                  
                  }
                  ?>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </div>
  <?php   if ($User) { $theFrenzz = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$myU->ID' AND Active='0'");
  $Frenzz = mysql_num_rows($theFrenzz);
             echo "<center>
    <div id='SubBar'>
    <table cellspacing='0' cellpadding='0'>
      <tr>
        <td>
          <a href='/account.php'>Account</a>
        </td>
        <td>
          <a href='/user.php?ID=$myU->ID'>Profile</a>
        </td>
        <td>
          <a href='/character.php'>Avatar</a>
        </td>
        <td>
          <a href='/Wall/'>Wall</a>
        </td>
        <td>
          <a href='/FriendRequests.php'>Friend Requests ($Frenzz)</a>
        </td>
        <td>
          <a href='/inbox.php'>Inbox ($PMs)</a>
        </td>
        <td>
          <a href='/ItemLogs.php?view=all'>Purchases</a>
        </td>
      </tr>
    </table>
    </div>
    "; }
    ?>
  <center>
<style>#Header a { transition-duration: 0.4s !important; transition: background-color 0.4s ease-out;}
  
  
  #Header a:hover{
      transition-duration: 0.4s !important;
background: #052089;
font-weight:none !important;
font-size: 12px !important;
}
 
   
  
  </style>

      <!--End Top Bar-->
      <!--Begin Announcement Bar-->
      <?php if (!empty($gB->Text)) { echo "
      <center>
      <div id='Alert'>
        <center>".nl2br($gB->Text)."</center>
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
if ($myU->PowerAdmin == "true") {
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

  $SayNP1 = "<font color='red'><b><a href='/ModerateGroups.php'>Unmoderated Groups ($NumPending1)</a></b></font>";

}
else {

  $SayNP1 = "<a href='/ModerateGroups.php'>Unmoderated Groups ($NumPending1)</a>";

}

if ($NumPending2 > 0) {

  $SayNP2 = "<font color='red'><b><a href='/ModerateLogos.php'>Unmoderated Group Logos ($NumPending2)</a></b></font>";

}

else {

  $SayNP2 = "<a href='/ModerateLogos.php'>Unmoderated Group Logos ($NumPending2)</a>";

}
if ($myU->PowerAdmin == "true") {
$AllShow = $NumR + $NumPending + $NumWaiting + $NumPending1 + $NumPending2;
}
else {
$AllShow = $NumR + $NumPending + $NumWaiting + $NumPending1 + $NumPending2;
}
if ($NumPending > 0||$NumR > 0||$NumWaiting > 0||$NumPending1 > 0) {
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
<div id='quickAdmin_show' style='position:fixed;bottom:0px;right:250px;background:#eee;padding:5px;border:1px solid #aaa; cursor:pointer;'>
$KShow</b>
</div>
<div id='quickAdmin_hide' style='position:fixed;bottom:110px;right:250px;background:#eee;padding:5px;border:1px solid #aaa;cursor:pointer;'>
Hide Quick Admin <b>&darr;</b>
</div>
<div id='quick_admin' style='position:fixed;bottom:0px;right:250px;background:#eee;padding:5px;border:1px solid #aaa;'>
<div align='left'>
";


if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
echo "
<a href='/Reports.php'>$SayP</a>
<br />
";
}
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"||$myU->PowerImageModerator == "true") {
echo "<a href='/ItemModeration.php'>$SayNP</a>
<br />
";
}
if ($myU->PowerAdmin == "true") {
echo "<a href='/ItemRelease.php'>$SayNW</a><br />";
}
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
echo "
$SayNP1
<br />
$SayNP2
<br />
<a href='/online.php'><b>Online Users (".$NumOnline.") </b></a>
<br />
</div>
";
}
}
echo "</div></div>";
if ($myU->Premium == 1) {

  echo "
  <style>
    body {
    background:url(https://cdn.discordapp.com/attachments/964346440337985556/965266788076118086/unknown.png);
    background-repeat:no-repeat;
    background-attachment:fixed;
    background-position:center top;
    background-size:cover;
    height:100%;
    }
  </style>
  ";

}
?>
if ($myU->Premium == 4) {

  echo "
  <style>
    body {
    background:url(https://cdn.discordapp.com/attachments/964346440337985556/965266788076118086/unknown.png);
    background-repeat:no-repeat;
    background-attachment:fixed;
    background-position:center top;
    background-size:cover;
    height:100%;
    }
  </style>
  ";

}
?>
if ($myU->Premium == 0) {

  echo "
  <style>
    body {
    background:url(https://cdn.discordapp.com/attachments/964346440337985556/965266788076118086/unknown.png);
    background-repeat:no-repeat;
    background-attachment:fixed;
    background-position:center top;
    background-size:cover;
    height:100%;
    }
  </style>
  ";

}
?>

      <!--End Announcement Bar-->
<?php
			$connection = mysql_pconnect("mysql.ct8.pl","m27001_w2b","Sg090228") or die("Error connecting to database, hang tight, we are working on it.");
			mysql_select_db("m27001_w2b") or die("Error connecting to database, hang tight, we are working on it...");
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
			<td width='50%' style='font-weight:400;'>Ad by $gU->Username</td>
			</tr>
			</table>
			
			</center><br /><br />";

			}
		?>
      
      <!--Begin Main Container-->
    <br>
        <center>
          <div id="Container" style='border-top: 1px solid gainsboro;'><div align='left'>