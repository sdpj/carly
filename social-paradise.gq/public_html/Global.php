<?php
session_id();
session_start();
ob_start();
date_default_timezone_set('America/Chicago');
session_name('SOCIALP_SESSID');
$connection = mysql_connect("mysql.ct8.pl","m27001_socialpa","Sg090228") or die("We are currently overloaded with users. Please try again in 1-5 minutes. Do not constantly refresh the page.");
mysql_select_db("m27001_socialpa") or die("We are currently overloaded with users. Please try again in 1-5 minutes. Do not constantly refresh the page.");
 
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
  
  if ($Maintenance->Status == "true") {
    
  
    if ($myU->PowerAdmin == "true"||$Admin) {
    
    }
    else {
    
    
    header("Location: /Maintenance.php");
    }
  
  }
  $now = time();
  
  $timeout = 5; 
  
  $xp = 60;
  $expires = $now + $timeout*$xp;
  mysql_query("UPDATE Users SET visitTick='$now' WHERE Username='$User'");
  mysql_query("UPDATE Users SET expireTime='$expires' WHERE Username='$User'");
  
  if ($myU->Ban == "1" && $_SERVER['PHP_SELF'] != "/Banned.php") {
  
    header("Location: /Banned.php");
  
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
            
            $getPremium = mysql_query("SELECT * FROM Users WHERE Premium='1'");
              while ($gP = mysql_fetch_object($getPremium)) {
              
                $checkBadge = mysql_query("SELECT * FROM Badges WHERE UserID='$gP->ID' AND Position='Premium'");
                $Badge = mysql_num_rows($checkBadge);
                
                if ($Badge == 0) {
                
                  mysql_query("INSERT INTO Badges (UserID, Position) VALUES('$gP->ID','Premium')");
                  mysql_query("INSERT INTO PMs (SenderID, ReceiveID) VALUES('1','$gP->ID','')");
                }
                if ($gP->PremiumExpire != "unlimited") {
                if ($now > $gP->PremiumExpire) {
                
                  mysql_query("UPDATE Users SET Premium='0' WHERE ID='$gP->ID'");
                  mysql_query("DELETE FROM Badges WHERE UserID='$gP->ID' AND Position='Premium'");
                  mysql_query("INSERT INTO PMs (SenderID, ReceiveID, Title, Body, time) VALUES('1','$gP->ID','Premium Expired','Your premium membership has expired.','$now')");
                
                }
                }
                
              
              }
              
              $now = time();
              if ($now > $myU->getBux) {
              $NewBux = $now + 86400;
              if ($myU->Premium == 0) {
              
                $AmountToAdd = 100;
              
              }
              else {
              
                $AmountToAdd = 250;
              
              }
              mysql_query("UPDATE Users SET Bux=Bux + ".$AmountToAdd." WHERE ID='$myU->ID'");
              mysql_query("UPDATE Users SET getBux='$NewBux' WHERE ID='$myU->ID'");
              }
            $getFriendR = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$myU->ID' AND Active='0'");
            $FriendsPending = mysql_num_rows($getFriendR);
            
  
?>
<?php $siteNam = mysql_query("SELECT * FROM Configuration"); $siteName = mysql_fetch_object($siteNam);?>