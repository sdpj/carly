<?php
include "Header.php";
$getConfig = mysql_query("SELECT * FROM Configuration");
$gC = mysql_fetch_object($getConfig);
$Profile = mysql_real_escape_string(strip_tags(stripslashes($_GET['Profile'])));
echo"<center>";
if (!$Profile) {
echo 'Please include an Username!';
}
else {
  $gU = mysql_fetch_object($getUser = mysql_query("SELECT * FROM Users WHERE Username='".$Profile."'"));
  $UserExist = mysql_num_rows($getUser = mysql_query("SELECT * FROM Users WHERE Username='".$Profile."'"));
  if ($UserExist == "0") {
  
    echo "<b>This user does not exist.</b>";
    exit;
  
  }
$Twiter = $gU->Twitter;
if ($gU->Premium == 1) {

  echo "
  <style>
    body {
    background:url(https://buildcity.ml/Images/PremiumBG.png);
    background-repeat:no-repeat;
    background-attachment:fixed;
    background-position:center top; 
    background-size:cover;
    height:100%;
    }
    h1 {
    margin: 0px !important;
    }
  </style>
  ";

}
echo"<h1 style='margin: 0px !important;padding-right:34px;'>";if (time() < $gU->expireTime) {
  echo"<online style='font-size:30px;padding-bottom:4px;'>🟢</online><name style='padding-top:5px;font-size: 40;'>";
  }
  if (time() > $gU->expireTime) {
  echo "<online style='font-size:30px;padding-bottom:4px;'>⚫</online><name style='padding-top:5px;font-size: 40;'>";
  } echo $gU->Username; echo "</h1></name>";
if($gC->Avatars == "3D"){
echo"<img src='/Avatars/$gU->Avatar3D' width='256' height='256'><br>";
  if ($gU->PowerAdmin == "true") {
  echo "<authority style='position:relative;bottom:33px;color:green;'>[Admin]</authority>";
  }
    if ($gU->PowerAdmin == "false") {
  echo "<authority style='position:relative;bottom:33px;'>[User]</authority>";
  }
}elseif($gC->Avatars == "2D"){
echo"<img src='/Avatar2D.php?ID=$gU->ID'><br><br>";
};
if (empty($Twiter)) {
$Twiter = "";
}
else {
echo'<a href="https://twitter.com/@';echo"$Twiter";echo'"><img src="/Images/twitter.png" style="border-radius: 30px;"></a>';
};
if (!$gU->expireTime) {
$SS = "N/A";
}
else {
if ($now < $gU->expireTime) {
$SS = "<font color='green'>Right Now!</font>";
}
else {
$SS = date("F j, Y g:iA", $gU->expireTime);
}
};
echo"<hr style='margin-top:0px;'><div class='jumbotron hero-spacer' style='border-radius: 0px;'><h4>".$gU->Username."'s Description:</h4><h5>$gU->Description</h5><hr><h4>".$gU->Username."'s Statistics:</h4><h5>Last Seen: $SS</h5><hr>";
echo"<h4>".$gU->Username."'s Badges:</h4>";
$numBadges = mysql_num_rows($Badges = mysql_query("SELECT * FROM Badges WHERE UserID='$gU->ID'"));
          
          if ($numBadges > 0) {
          
            echo "<table style='table-layout: auto;border: 0px solid black;width:30px;'><tr>";
            $Badges = mysql_query("SELECT * FROM Badges WHERE UserID='$gU->ID' ORDER BY ID");
            $badge = 0;
            while ($Row = mysql_fetch_object($Badges)) {
              $badge++;
              echo "<td style='padding:0px;width:0px !important;'>
<div class='center'>
            <img src='/Badges/".$Row->Position.".png' height='72' width='72' style='margin-left: 20px;margin-right: 20px;'></div>
            <div style='padding-top:2px;'></div>
              <div class='center'>
                ".$Row->Position."
              </div>
            </a>
          </td>
              ";
              if ($badge >= 6) {
              echo "</tr><tr>";
              $badge = 0;
              }
            
            }
}
echo"</tr></table></div>";
}
?>