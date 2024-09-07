<?php
error_reporting(0);
include "global.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="https://www.facebook.com/2008/fbml"> 
  <head>
    <title>ROBLOX</title>
    <link rel="icon" type="image/png" href="/Badgess/Administrator.png">
    <link rel="stylesheet" href="/Base/Style/Main.css">
    <link rel="stylesheet" href="/Base/Themes/Default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/Base/Themes/Pascal/pascal.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/Base/Themes/Orman/orman.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/Base/Style/Nivo.css" type="text/css" media="screen" />
    
    <link rel="stylesheet" href="/Base/Style/Main.css">
    <link rel="stylesheet" href="/Base/Themes/Default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/Base/Themes/Pascal/pascal.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/Base/Themes/Orman/orman.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/Base/Style/Nivo.css" type="text/css" media="screen" />
    <!--<script type="text/javascript" src="https://avaworld.net/snowstorm.js"></script>-->
    <script type="text/javascript" src="https://ajax.microsoft.com/ajax/jquery/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="https://www.tumuski.com/library/Nibbler/Nibbler.js"></script>
    <script>
    $(document).ready(function(){
    $('.redirect').click(function(){
    window.location = $(this).attr('redirect');
    });
    });
    </script>
  </head>  
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <body>
    <?if($myU->Premium != "3" OR !$User){
    echo"
    <div class='site-header'>
      <div id='navigation-container'>
        <a href='/'>
          <img src='/Images/oldbloxlogo.png' width='190' height='35' style='margin-bottom:2px;margin-right:15px;vertical-align:bottom;'>
        </a>
    ";
  }
  elseif($myU->Premium == "3"){
    echo"
    <div class='site-header-prem'>
      <div id='navigation-container-prem'>
        <a href='/'>
          <img src='/Images/oldbloxlogo.png' width='190' height='35' style='margin-bottom:2px;margin-right:15px;vertical-align:bottom;'>
        </a>
    ";
  }?>
      <span style=''>
        <a href='/'>
          Home
        </a>
        
        <a href='/Store/Store.aspx'>
          Catalog
        </a>
        <a href='/Store/UserStore.aspx'>
          User Catalog
        </a>
        <a href='/Upgrades/Premium.aspx'>
          Premium
        </a>
        <a href='/forum/'>
          Forum
        </a>
        <a href='/Browse.aspx'>
          People
        </a>
        <?if($User){
$getRequests = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$myU->ID' AND Active='0'");
$numRequests = mysql_num_rows($getRequests);
$getMessages = mysql_query("SELECT * FROM PMs WHERE ReceiveID='$myU->ID' AND LookMessage='0'");
$numMessages = mysql_num_rows($getMessages);
          echo"
          <div style='float:right;'>
            <a href='/user.aspx?ID=$myU->ID' style='font-weight:normal;font-size:12px;'>
              ".$myU->Username."
            </a>
            &nbsp;
            <a href='/Account/inbox.aspx'>
              $numMessages <img src='/Images/msgs.png' height='13' width='20'>
            </a>
            &nbsp;
            <a href='../My/FriendRequests.aspx'>
              $numRequests <img src='/Images/friends.png' height='13' width='14'>
            </a>
            &nbsp;
            <font style='color:#7394c1;height:50px;'>
              |
            </font>
            &nbsp;
            <a href='../test.php'>
              <font style='color:lightgreen;font-size:12px;'>
                B$: ".$Bux."
              </font>
            </a>
            &nbsp;
            <font style='color:#7394c1;height:50px;'>
              |
            </font>
            &nbsp;
            <a href='/auth/logout.aspx' style='font-weight:normal;font-size:12px;'>
              Logout
            </a>
          </div>
          ";
        }?>
      </span>
    </div>
  </div>
  <?if($User){
    echo"
    <div class='user-submenu'>
      <div class='subMenu'>
        <a href='/user.aspx?ID=".$myU->ID."'>
          Profile
        </a>
        <a href='/character.aspx'>
          Character
        </a>
        <a href='/My/Friends.aspx?ID=$myU->ID'>
          Friends
        </a>
        <a href='../test.php'>
          Groups
        </a>
        <a href='/My/Stuff.aspx'>
          Inventory
        </a>
        <a href='../test.php'>
          Trade
        </a>
        <a href='/test.php'>
          Money
        </a>
        <a href='/Advertising/index.aspx'>
          Advertising
        </a>
        <a href='/account.aspx'>
          Account
        </a>
        ";
        
        if ($myU->PowerAdmin == "true" OR $myU->PowerMegaModerator == "true") {
          echo"
          <div style='float:right;'>
            <a href='/auth.admin/'>
              <b>Admin Panel</b>
            </a>
            <font style='color:white;'>
              &nbsp;<b>|</b>&nbsp;
            </font>
            ".date("F j, Y g:iA", $now)."
          </div>
          ";
        }
          echo "
        </div>
      </div>
    </div>
    "; 
  }?>
  
  <?
  $getAllGroups = mysql_query("SELECT * FROM Groups");
  
  while ($gAG = mysql_fetch_object($getAllGroups)) {
  
    $getAllMembers = mysql_query("SELECT * FROM GroupMembers WHERE GroupID='$gAG->ID'");
    $gA = mysql_num_rows($getAllMembers);
    
    mysql_query("UPDATE Groups SET GroupMembers='$gA' WHERE ID='$gAG->ID'");
  
  }

?>
<?php



?>
  <div id='MasterContainer'>
  <div id='bodywrapper'>
  <div id='Body'>
  <?$BannerText = mysql_query("SELECT * FROM Banner");
  $Banner = mysql_fetch_object($BannerText);
    
  if($Banner->Text){
    if($User){
      echo"
      <div style='padding-top:65px;'></div>
      ";
    }
    else{
      echo"
      <div style='padding-top:40px;'></div>
      ";
    }
  echo"
    <div align='center'>
      <div class='SystemAlert'>
        <div id='AlertBar'>
          <div style='float:left;'>
            <img src='/Images/s_notice.png' style='margin-top:4px;margin-left:3px;' title='System Alert'>
          </div>
          ".$Banner->Text."
        </div>
      </div>
    </div>
    "; 
  }
  else{
    if($User){ 
      echo"
      <div style='padding-top:65px;'></div>
      ";
    }
    else{
      echo"
      <div style='padding-top:40px;'></div>
      ";
    }
  }?>
  
  <?php
  //Ads
  
  $getAds = mysql_query("SELECT * FROM UserAdvertisments WHERE Approved='1' AND Running='1' ORDER BY RAND()");
  $gA = mysql_fetch_object($getAds);
  if(time() > $gA->Expire){
  $now = time();
  mysql_query("INSERT INTO PMs (SenderID, ReceiveID, Title, Body, time, LookMessage) VALUES ('1','$gA->UserID','Your advertisement has expired','Your advertisement &quot;$gA->Name&quot; has expired','$now','0')");
  mysql_query("DELETE FROM UserAdvertisments WHERE ID='$gA->ID'");
  
  }
  $numAds = mysql_num_rows($getAds);
  if($numAds >=5) {
  $finduser = mysql_query("SELECT * FROM Users WHERE ID='$gA->UserID'");
  $gu = mysql_fetch_object($finduser);
  echo"
  <center>
  <a href='/user.aspx?ID=$gA->UserID'><img src='/Advertising/Dir/$gA->Image' alt='$gA->Name' height='90' width='728'><br />Advertisement by ".$gu->Username."</a></center><br />
  ";
if($myU->ID != $gA->UserID) 
if ($gU->Premium == 0) {
mysql_query("UPDATE UserAdvertisments SET BuxEarned=BuxEarned+1 WHERE ID='$gA->ID'");
mysql_query("UPDATE Users SET Bux=Bux+1 WHERE ID='$gA->UserID'");
}
elseif ($gU->Premium == 1) {
mysql_query("UPDATE UserAdvertisments SET BuxEarned=BuxEarned+5 WHERE ID='$gA->ID'");
mysql_query("UPDATE Users SET Bux=Bux+5 WHERE ID='$gA->UserID'");
}
elseif ($gU->Premium == 2) {
mysql_query("UPDATE UserAdvertisments SET BuxEarned=BuxEarned+5 WHERE ID='$gA->ID'");
mysql_query("UPDATE Users SET Bux=Bux+5 WHERE ID='$gA->UserID'");
}
elseif ($gU->Premium == 3) {
mysql_query("UPDATE UserAdvertisments SET BuxEarned=BuxEarned+15 WHERE ID='$gA->ID'");
mysql_query("UPDATE Users SET Bux=Bux+15 WHERE ID='$gA->UserID'");
}
}
