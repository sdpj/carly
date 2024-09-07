<?php
session_id();
session_start();
ob_start();
date_default_timezone_set('America/Chicago');
    @mysql_connect("mysql.ct8.pl","m27001_oldblox","OldBlox1#");
    mysql_select_db("m27001_oldblox");
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
    function time_ago($tm, $rcs = 0) {
  $cur_tm = time(); 
  $dif = $cur_tm - $tm;
  $pds = array('second','minute','hour','day','week','month','year','decade');
  $lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);

  for ($v = count($lngh) - 1; ($v >= 0) && (($no = $dif / $lngh[$v]) <= 1); $v--);
    if ($v < 0)
      $v = 0;
  $_tm = $cur_tm - ($dif % $lngh[$v]);

  $no = ($rcs ? floor($no) : round($no)); // if last denomination, round

  if ($no != 1)
    $pds[$v] .= 's';
  $x = $no . ' ' . $pds[$v];

  if (($rcs > 0) && ($v >= 1))
    $x .= ' ' . $this->time_ago($_tm, $rcs - 1);

  return $x." ago";
};
    
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
    $IPBan = mysql_num_rows($getIPBans);
    if ($IPBan > 0) {
    include "403.shtml";
    exit;
    }
  
  $getNoAvatars = mysql_query("SELECT * FROM Users WHERE Body=''");
  while ($gN = mysql_fetch_object($getNoAvatars)) {
  
    mysql_query("UPDATE Users SET Body='Avatar.png' WHERE ID='$gN->ID'");
  
  }
  
  $getBanner = mysql_query("SELECT * FROM Banner");
  $gB = mysql_fetch_object($getBanner);
  

  
  
  
  $maintenance = mysql_query("SELECT * FROM Maintenance");
  $maintenancestatus = mysql_fetch_object($maintenance);
  
  if($maintenancestatus->Status == "true" && !$Admin && $myU->PowerAdmin != "true"){
    header("Location: /Login/FulfillConstraint.aspx?Protocol=1&Time=24&Code=157");
    die();
  }
  
  $now = time();
  
  $timeout = 5; 
  
  $xp = 60;
  $expires = $now + $timeout*$xp;
  mysql_query("UPDATE Users SET visitTick='$now' WHERE Username='$User'");
  mysql_query("UPDATE Users SET expireTime='$expires' WHERE Username='$User'");

  if ($myU->Ban == "1" && $_SERVER['PHP_SELF'] != "/Account/NotApproved/index.php") {
  
    header("Location: /Account/NotApproved/?ID=$myU->ID");
    die();
  
  }
  
                $Bux = $myU->Bux;
              
                if ($Bux >= 100000&&$Bux <= 999999) {
                
                  $BuxShort = substr($Bux, 0,3);
                  
                  $Bux = "".$BuxShort."K+";
                
                }
                else if ($Bux >= 1000000&&$Bux <= 9999999) {
                
                  $BuxShort = substr($Bux, 0,1);
                  
                  $Bux = "".$BuxShort."M+";
                
                }
                else if ($Bux >= 10000000&&$Bux <= 99999999) {
                
                  $BuxShort = substr($Bux, 0,2);
                  
                  $Bux = "".$BuxShort."M+";
                
                }
                else if ($Bux >= 100000000&&$Bux <= 999999999) {
                
                  $BuxShort = substr($Bux, 0,3);
                  
                  $Bux = "".$BuxShort."M+";
                
                }
                else if ($Bux >= 1000000000&&$Bux <= 9999999999) {
                
                  $BuxShort = substr($Bux, 0,1);
                  
                  $Bux = "".$BuxShort."B+";
                
                }
                else if ($Bux >= 10000000000&&$Bux <= 99999999999) {
                
                  $BuxShort = substr($Bux, 0,2);
                  
                  $Bux = "".$BuxShort."B+";
                
                }
                else if ($Bux >= 100000000000&&$Bux <= 999999999999) {
                
                  $BuxShort = substr($Bux, 0,3);
                  
                  $Bux = "".$BuxShort."B+";
                
                }
                else if ($Bux >= 1000000000000&&$Bux <= 9999999999999) {
                
                  $BuxShort = substr($Bux, 0,1);
                  
                  $Bux = "".$BuxShort."T+";
                
                }
                else if ($Bux >= 10000000000000&&$Bux <= 99999999999999) {
                
                  $BuxShort = substr($Bux, 0,2);
                  
                  $Bux = "".$BuxShort."T+";
                
                }
                else if ($Bux >= 1000000000) {
                
                  $Bux = "&#8734;";
                
                }
                else if ($Bux >= 100&&$Bux <= 99999) {
                
                  $Bux = number_format($Bux);
                
                }
                
            //rich badges
            $getPremiumWelcome = mysql_query("SELECT * FROM Users WHERE Premium='1' OR Premium='2' OR Premium='3'");
              while ($gP = mysql_fetch_object($getPremiumWelcome)) {
              
                $checkBadge = mysql_query("SELECT * FROM Badges WHERE UserID='$gP->ID' AND Position='In The Club'");
                $Badge = mysql_num_rows($checkBadge);
                
                if ($Badge == 0) {
                
                  mysql_query("INSERT INTO Badges (UserID, Position) VALUES('$gP->ID','In The Club')");
                  mysql_query("INSERT INTO PMs (SenderID, ReceiveID, Title, Body, time) VALUES('1','$gP->ID','You have been granted a badge!','You have been granted the &quot;In The Club&quot; badge for being part of our membership program. Welcome to the club!','".$now."')");
                }
              }
            $getItemskk = mysql_query("SELECT * FROM Items");
            
            while ($GIKK = mysql_fetch_object($getItemskk)) {
            if ($GIKK->UpdateTime == "") {
              mysql_query("UPDATE Items SET UpdateTime='$GIKK->CreationTime' WHERE ID='$GIKK->ID'");
              }
            
            }
            
            $getRich = mysql_query("SELECT * FROM Users WHERE Bux > 9999");
            while ($gR = mysql_fetch_object($getRich)) {
            
              $checkBadge = mysql_query("SELECT * FROM Badges WHERE UserID='".$gR->ID."' AND Position='Rich'");
              $NumBadge = mysql_num_rows($checkBadge);
              
                if ($NumBadge == 0) {
                
                  mysql_query("INSERT INTO Badges (UserID, Position) VALUES('".$gR->ID."','Rich')");
                
                }
            
            }
            $getPremium1 = mysql_query("SELECT * FROM Users WHERE Premium='1'");
              while ($gP = mysql_fetch_object($getPremium1)) {
              
                $checkBadge = mysql_query("SELECT * FROM Badges WHERE UserID='$gP->ID' AND Position='Builder'");
                $Badge = mysql_num_rows($checkBadge);
                
                if ($Badge == 0) {
                
                  mysql_query("INSERT INTO Badges (UserID, Position) VALUES('$gP->ID','Builder')");
                  mysql_query("INSERT INTO PMs (SenderID, ReceiveID) VALUES('1','$gP->ID','')");
                }
                if ($gP->PremiumExpire != "unlimited") {
                if ($now > $gP->PremiumExpire) {
                
                  mysql_query("UPDATE Users SET Premium='0' WHERE ID='$gP->ID'");
                  mysql_query("UPDATE Users SET PremiumExpire='' WHERE ID='$gP->ID'");
                  mysql_query("DELETE FROM Badges WHERE UserID='$gP->ID' AND Position='Builder'");
                  mysql_query("INSERT INTO PMs (SenderID, ReceiveID, Title, Body, time) VALUES('1','$gP->ID','Oh no! It looks like your membership has run out!','Your membership has expired. You can always reupgrade at any time by checking out our upgrades page here: https://www.world2build.net/Upgrades/Premium.aspx. We\'re sorry to see you go. We look forward to hearing from you in the future! ','$now')");
                
                }
                }
                
              
              }
            $getPremium2 = mysql_query("SELECT * FROM Users WHERE Premium='2'");
              while ($gP = mysql_fetch_object($getPremium2)) {
              
                $checkBadge = mysql_query("SELECT * FROM Badges WHERE UserID='$gP->ID' AND Position='Constructor'");
                $Badge = mysql_num_rows($checkBadge);
                
                if ($Badge == 0) {
                
                  mysql_query("INSERT INTO Badges (UserID, Position) VALUES('$gP->ID','Constructor')");
                  mysql_query("INSERT INTO PMs (SenderID, ReceiveID) VALUES('1','$gP->ID','')");
                }
                if ($gP->PremiumExpire != "unlimited") {
                if ($now > $gP->PremiumExpire) {
                
                  mysql_query("UPDATE Users SET Premium='0' WHERE ID='$gP->ID'");
                  mysql_query("UPDATE Users SET PremiumExpire='' WHERE ID='$gP->ID'");
                  mysql_query("DELETE FROM Badges WHERE UserID='$gP->ID' AND Position='Constructor'");
                  mysql_query("INSERT INTO PMs (SenderID, ReceiveID, Title, Body, time) VALUES('1','$gP->ID','Premium Expired','Your premium membership has expired.','$now')");
                
                }
                }
                
              
              }
              $getPremium3 = mysql_query("SELECT * FROM Users WHERE Premium='3'");
              while ($gP = mysql_fetch_object($getPremium3)) {
              
                $checkBadge = mysql_query("SELECT * FROM Badges WHERE UserID='$gP->ID' AND Position='Architect'");
                $Badge = mysql_num_rows($checkBadge);
                
                if ($Badge == 0) {
                
                  mysql_query("INSERT INTO Badges (UserID, Position) VALUES('$gP->ID','Architect')");
                  mysql_query("INSERT INTO PMs (SenderID, ReceiveID) VALUES('1','$gP->ID','')");
                }
                if ($gP->PremiumExpire != "unlimited") {
                if ($now > $gP->PremiumExpire) {
                
                  mysql_query("UPDATE Users SET Premium='0' WHERE ID='$gP->ID'");
                  mysql_query("UPDATE Users SET PremiumExpire='' WHERE ID='$gP->ID'");
                  mysql_query("DELETE FROM Badges WHERE UserID='$gP->ID' AND Position='Architect'");
                  mysql_query("INSERT INTO PMs (SenderID, ReceiveID, Title, Body, time) VALUES('1','$gP->ID','Premium Expired','Your premium membership has expired.','$now')");
                
                }
                }
                
              
              }
              
              $now = time();
              if ($now > $myU->getBux) {
              $NewBux = $now + 86400;
              if($myU->Premium == 0) {
              
                $AmountToAdd = 25;
              
              }
              elseif($myU->Premium == 1){
              
                $AmountToAdd = 100;
              
              }
              elseif($myU->Premium == 2){
              
                $AmountToAdd = 250;
              
              }
              elseif($myU->Premium == 3){
              
                $AmountToAdd = 500;
              
              }
              mysql_query("UPDATE Users SET Bux=Bux + ".$AmountToAdd." WHERE ID='$myU->ID'");
              mysql_query("UPDATE Users SET getBux='$NewBux' WHERE ID='$myU->ID'");
              }
            $getFriendR = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$myU->ID' AND Active='0'");
            $FriendsPending = mysql_num_rows($getFriendR);
            $Posts = mysql_num_rows($Posts = mysql_query("SELECT * FROM Threads WHERE PosterID='".$Poster->ID."'")); 
            $Replies = mysql_num_rows($Replies = mysql_query("SELECT * FROM Replies WHERE PosterID='".$Poster->ID."'")); 
            $Posts2 = $Posts+$Replies;
            mysql_query("UPDATE Users SET ForumPost='".$Posts2."' WHERE ID='".$myU->ID."'");
  if($myU->Premium != "1" OR !$User){
    echo"
    <style>
      body { 
      background-color: #610B0B;
      margin: 0;
      }
    </style>
    ";
  }
  elseif($myU->Premium == 3){
    echo"
    <style>
      body {
      background-color: #363636;
      margin: 0;
      }
    </style>
    ";
  }
$myPosts = mysql_num_rows($Posts = mysql_query("SELECT * FROM Threads WHERE PosterID='".$myU->ID."'")); 
$myPosts2 = mysql_num_rows($Posts = mysql_query("SELECT * FROM Replies WHERE PosterID='".$myU->ID."'"));
$myTotalPosts = $myPosts + $myPosts2;

mysql_query("UPDATE Users SET ForumPost='$myTotalPosts' WHERE ID='$myU->ID'");
  $test = mysql_query("SELECT * FROM Users WHERE Body=''");
  $test1 = mysql_fetch_object($test);
  if($test1 > 0){
    mysql_query("UPDATE Users SET Body='Avatar.png' WHERE ID='".$test1->ID."'");
  }
  if(empty($myU->Body)){
    mysql_query("UPDATE Users SET Body='Avatar.png' WHERE ID='".$myU->ID."'");
  }
  if($User) {
  $GetFriends = mysql_query("SELECT * FROM FRs WHERE SenderID='$myU->ID' AND Active='1'");
  $numgetFriends = mysql_num_rows($GetFriends);
  $GetFriends2 = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$myU->ID' AND Active='1'");
  $numgetFriends2 = mysql_num_rows($GetFriends2);
  $totalFriends = $numgetFriends+$numgetFriends2;
  if($totalFriends > 9){
  $checkBadge = mysql_query("SELECT * FROM Badges WHERE UserID='$myU->ID' AND Position='Friendship'");
  $checkBadgeExist = mysql_num_rows($checkBadge);
  if($checkBadgeExist == 0) {
  mysql_query("INSERT INTO Badges (UserID,Position) VALUES ('$myU->ID','Friendship')");
  
  }
  }
  
  }

?>