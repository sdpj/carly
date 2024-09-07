<?php
include "Header.php";

$reset = "../Imagess/thingTrasparent.png";
$body = "Avatar.png";
$ID = mysql_real_escape_string(strip_tags(stripslashes($_GET['ID'])));
if (!$ID) {
echo '<center><h2>Please include an ID!</h2>';
}
else {
  $gU = mysql_fetch_object($getUser = mysql_query("SELECT * FROM Users WHERE ID='".$ID."'"));
  $UserExist = mysql_num_rows($getUser = mysql_query("SELECT * FROM Users WHERE ID='".$ID."'"));
  if ($UserExist == "0") {
  
    echo "<center><h2>This user does not exist!</h2>";
    exit;
  
  }
        $checkBan = mysql_query("SELECT * FROM IPBans WHERE IP='$gU->IP'");
        $Ban = mysql_num_rows($checkBan);
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {

  if ($Ban > 0) {
  
    echo "
  <center>
  <div id='cA' style='width:90%;'>
    <b>This user has been IP banned. "; if ($myU->PowerMegaModerator == "true"||$myU->PowerAdmin == "true") { echo "<a href='../user.php?ID=$ID&IP=Revert'>(revert)</a>"; } echo "</b>
  </div>
  <br />
    ";
  $IP = mysql_real_escape_string(strip_tags(stripslashes($_GET['IP'])));
  if ($IP == "Revert") {
  mysql_query("DELETE FROM IPBans WHERE IP='$gU->IP'");
  header("Location: user.php?ID=$ID");
  }
  }

}

  if ($gU->Ban == "1") {
  echo "
  <center>
  <div id='cA' style='width:90%;'>
    <b>This user is currently banned. "; if ($myU->PowerMegaModerator == "true"||$myU->PowerAdmin == "true") {

    echo "<a href='../BanUser.php?ID=$ID&Unban=True'>(revert)</a>"; } echo "</b>
  </div>
  ";
  if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
      echo "
      <br />
      <div id='aB' style='width:75%;'>
      <center>
      <table width='50%'>
        <tr>
          <td>
            <b style='font-size:20px;'>";

                                                               

                                                                if ($gU->BanLength == "100") {
                
                  echo "Reminder";
                
                }



                if ($gU->BanLength == "0") {
                
                  echo "Warning";
                
                }
                if ($gU->BanLength == "1") {
                
                  echo "Banned for 1 Day";
                
                }
                if ($gU->BanLength == "3") {
                
                  echo "Banned for 3 Days";
                
                }
                if ($gU->BanLength == "7") {
                
                  echo "Banned for 7 Days";
                
                }
                if ($gU->BanLength == "14") {
                
                  echo "Banned for 14 Days";
                
                }
                if ($gU->BanLength == "forever") {
                
                  echo "Account Deleted";
                
                }
      echo "</b>
            <center><table width='500'><tr><td align='left'>
                <div id='HeadText'>
                ";

                
                if ($gU->BanLength != "forever") {
                $TimeUp = date("F j, Y g:iA","".$gU->BanTime."");
                }
                
                echo "
              </div>
              </td>
              </tr>
              <tr>
              <td align='left'>
                <font style='font-size:12px;'>
                Reason: <b>".$gU->BanType."</b>
                <br /><br />
                Our staff has found your account in violation of our terms. We have such rights to suspend your account if you do not abide by our rules.
                </font>
                <br />
                <br />
                <center>
                <div id='aB' style='border-radius:5px;width:600px;'>
                  <center>
                  ";
                  if ($gU->BanContent) {
                  echo "
                  <div style='background:white;padding:7px;border:1px solid #ccc;width:97%;text-align:left;'>
                   <b>Bad Content:</b> <i>".$gU->BanContent."</i>
                   <br />
                   <font style='font-size:9px;'>The following text in italics is offensive text you have typed that is not approved by our staff.</font>
                  </div>
                  ";
                  }
                  echo "
                  </center>
                  <br />
                  <b>Moderator Note:</b> $gU->BanDescription
                </div>
              </td></tr></table></div>
            </td>
        </tr>
      </table></div>
<br />
      ";
      }
      
  }
  else {
  if ($User) {
  
    if ($myU->ID != $ID) {
    
      mysql_query("UPDATE Users SET pviews=pviews + 1 WHERE ID='".$ID."'");
    
    
          $CheckIfFriend = mysql_query("SELECT * FROM FRs WHERE SenderID='".$myU->ID."' AND ReceiveID='".$ID."'");
          
          $Check_A = mysql_num_rows($CheckIfFriend);
          
          $CheckIfFriendd = mysql_query("SELECT * FROM FRs WHERE SenderID='".$ID."' AND ReceiveID='".$myU->ID."'");
          
          $Check_B = mysql_num_rows($CheckIfFriendd);
          
          $SendFR = mysql_real_escape_string(strip_tags(stripslashes($_GET['SendFR'])));
          $Close = mysql_real_escape_string(strip_tags(stripslashes($_POST['Close'])));
          
          if ($SendFR == "send") {
          
          if ($Check_A >= "1" || $Check_B >= "1") {
          
            echo "
          <div style='background-image:url(/Imagess/menuhover.png);width:100%;height:100%;top:0;left:0;position:fixed;'><center>
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <div id='aB' style='width:300px;border:2px solid #aaa;border-radius:5px;'>
              <font id='HeadText'>
                <b>Error sending request</b>
              </font>
              <br />
              <form action='' method='POST'>
                It seems like you are already friends with this user, or there is an active friend request.
                <br /><br />
                <input type='submit' name='Close' value='Close' id='SpecialInput'>
              </form>
            </div>
          </div>
            ";
          

            
            }
            else {
            
              mysql_query("INSERT INTO FRs (SenderID, ReceiveID, Active) VALUES ('".$myU->ID."','".$ID."','0')");
              
              echo "
          <div style='background-image:url(/Imagess/menuhover.png);width:100%;height:100%;top:0;left:0;position:fixed;'><center>
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <div style='background:#ccc;border:1px solid gray;width:500px;padding:8px;text-align:left;'>
              <font id='HeadText'>
                Success
              </font>
              <br />
              <form action='' method='POST'>
                You have successfully sent a friend request to ".$gU->Username."!
                <br />
                <input type='submit' name='Close' value='Close'>
              </form>
            </div>
          </div>
              ";
              
            
            }
            
          if ($Close) {
          
            header("Location: user.php?ID=$ID");
          
          }
          
          }
          
          }
  
  }
$status = $gU->ProfileStatus;
if ($gU->Premium == 1) { echo " <br><div style='border:1px solid black;width:100%;background-color:darkblue;'><font size='1'> <a href='../Upgrade/index.php'><b><font color= 'white'><center>THIS USER CURRENTLY HAS A PREMIUM MEMBERSHIP.</center></font></b></a></font></div>"; }
if ($status) { echo " <br /> <div style='border:1px solid grey;width:100%;'><br /> 
<b> $gU->Username's Status:</b> <i>'$status' </i>"; if($myU->PowerAdmin == "true") { echo " <a href='?ID=$gU->ID&moderation=scrubstatus'>| <font color='red'><b>Scrub</b></font></a>"; } echo" <br /><br /></div><br />  ";}
$ProfileBanner = $gU->ProfileBackground;
if ($ProfileBanner) {
echo"<center><img src='$ProfileBanner' height='200'width='100%' ></center>";
}
  echo "<audio autoplay loop>
      <source src='../$gU->MusicLink'></audio>
  <table width='95%'>
    <tr>
      <td width='50%' valign='top'>

        <font size='3'>".$gU->Username."'s Profile</font> </font></div>";
if ($myU->PowerAdmin == "true")  { echo " <br /><a href='BanHistory.php?ID=$ID'>Moderation History</a> "; }
        echo"</div>
        <div id='aB'>
        ";
if ($gU->ID == $myU->ID) {
echo"<a href='?ID=$ID&action=advertise'><b>Advertise</b></a>";
}
        if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
        if (!empty($gU->OriginalName)) {
        echo "<center><font color='blue' style='font-size:7pt;'><b>User's original name was ".$gU->OriginalName."</b></font> <a href='?ID=$ID&moderation=revertname' style='font-size:7pt;'>(revert)</a>";
        }
        }
        if ($gU->ID == 164) {
                echo"<br/>dwefijeijfedffjfij C: "; }  
        echo "
          <center>
          ";
          if ($now < $gU->expireTime) {
          $Status = "<b>Online</b>"; if ($gU->ingame == 1) {
echo"<b><font color='green'>This user is currently in game</b></font><br /><br />"; } ;
          $Color = "green";
          }
          else {
          $Status = "<b>Offline<b>";
          $Color = "darkred";
          }
          
          echo "
          <div>
        ";      $height = 195;
                $width = 100;
                echo "
            <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Background . ");'>
            <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(Dir/Avatar.png);'>
              <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Eyes . ");'> 
                <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Mouth . ");'>
                  <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Hair . ");'>
                    <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Bottom . ");'>
                      <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Top . ");'>
                        <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Hat . ");'>
                          <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Shoes . ");'>
                            <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gU->Accessory . ");'>
"; if ($gU->Premium == 1) { echo"<div style='padding:5px;'><img src='../Imagess/pw.png'><br /><br /></div>
"; }  echo"
                            ";
                            if (time() < $gO->expireTime) {
                            echo "<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(/Imagess/OnlineWatermark.png);'>";
                            }
                            if (time() < $gO->expireTime) {
                            echo "</div>";
                            }
                            echo "
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          ";echo"
          </div>
          <font color='$Color'><br />$Status</font>
          
          ";
          if (!empty($gU->MainGroupID)) {
          $getMain = mysql_query("SELECT * FROM Groups WHERE ID='$gU->MainGroupID'");
          $gM = mysql_fetch_object($getMain);
          echo "
          <br />
          <b style='font-size:8pt;'>Primary Group:</b>
          <br />
          <div style='height:50px;width:50px;'>
          <a href='../Groups/Group.php?ID=$gM->ID'><img src='../Groups/GL/".$gM->Logo."' width='50' height='50'>
          
          </div>
          <b><font style='font-size:11px;'>".$gM->Name."</font></a></b>
          ";
          }
          echo "
          <br />
          ";
          if ($gU->Description) { echo "
          <div style='width:90%;padding:5px;overflow-y:auto;max-height:100px;background:#f6f6f6;border:3px solid #ddd;border-radius:5px;'>
          <font color= 'black'><span style='font-weight:normal;'>".nl2br($gU->Description)."</span></font>
    </div>

          "; }

          echo "<br /><b><font color='red'>Last Location:</b> $gU->Location </font><br /><br />
      
          <div style='padding-top:5px;padding-bottom:5px;'>
          ";
          if ($User) {
          
            if ($gU->PMs == "true") { echo"<a href='SendMessage.php?ID=$ID'><b><font color= 'darkblue'><font size='1'>Send Message</font></font></b></a>"; } else { echo"<a href='SendMessage.php?ID=$ID'><b><font color= 'darkblue'><font size='1'>Send Message</font></font></b></a>"; }if ($myU->ID != $gU->ID||$myU->IP != $gU->IP) { echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='user.php?ID=$ID&sendpoints=true'><font color='darkblue'><b><font size='1'>Give Reputation</font></font></b></a>"; }
            
          
          }
            echo " &nbsp; &nbsp; &nbsp; <a href='?ID=$ID&SendFR=send'><b><font color= 'darkblue'><font size='1'>Send Friend Request</font></font></b></a>&nbsp; &nbsp; &nbsp; <a href='/Trade/?tradeWith=$ID'><font color='darkblue'><font size='1'>Trade</font></font></b></a><br /><br /><font size='1'>"; echo "<font color='darkgrey'>*Spamming a user's reputation is an automatic account deletion.</font></font><br /><br />";
if (User) { echo ""; }

echo " <br /><a href='ReportAbuse.php?ID=$ID&ReportAbuse=true&Username=$gU->Username' style='hover:font-color:darkred'><font size='2'><font color='darkred'><img src='../Badgess/Mega Moderator.png' height='20' width='20'>Report Abuse</font></font></a>"; 


if ($myU->PowerAdmin == "true") { echo "<br /><br /> <a href='user.php?ID=$ID&moderation=purge'>  <font color='red'>Purge Avatar</a></font>";  }if ($myU->Username == "RachelM"||$myU->Username == "Pheedy"||$myU->Username == "Bailey") { echo " <a href='user.php?ID=$ID&moderation=purgepost'> | <font color='red'>Purge Posts</a></font> | <a href='ChangeUsername.php?ID=$ID' style='color:white;'><b><font color='red'>Change Name</font></b></a>";  }
if ($myU->PowerAdmin == "true") {
$moderation1 = $_GET['moderation'];
if ($moderation1 == "purge") { mysql_query("UPDATE Users SET Bottom='$reset' WHERE ID='$ID'");  mysql_query("UPDATE Users SET Top='$reset' WHERE ID='$ID'"); mysql_query("UPDATE Users SET Eyes='$reset' WHERE ID='$ID'"); mysql_query("UPDATE Users SET Hair='$reset' WHERE ID='$ID'"); mysql_query("UPDATE Users SET Hat='$reset' WHERE ID='$ID'" ); mysql_query("UPDATE Users SET Accessory='$reset' WHERE ID='$ID'"); mysql_query("UPDATE Users SET Mouth='$reset' WHERE ID='$ID'");  mysql_query("UPDATE Users SET Body='Avatar.png' AND Background='$reset' AND Accessory='$reset' WHERE ID='$ID'"); } }
if ($myU->PowerAdmin == "true") {
if ($moderation1 == "purgepost") { mysql_query("DELETE FROM Threads WHERE PosterID='$ID'");  mysql_query("DELETE FROM Replies WHERE PosterID='$ID'"); } }
        if ($gU->ID == 164) {
                echo"<br /><br />dwefijeijfedffjfij C: "; }
      echo "
          </div>
        </div>
        <br />
        <font size='4'>
          Statistics </font>
        </div>
        <div id='aB'>
          <table width='100%'>
            <tr>
              <td width='40%'>
                <b>Profile Views:</b>
              </td>
              <td>
                ".number_format($gU->pviews)."
              </td>
            </tr>
            <tr>
              <td width='40%'>
                <b>Forum Posts:</b>
              </td>
              <td>
                ";
                $Threads = mysql_num_rows($Threads = mysql_query("SELECT * FROM Threads WHERE PosterID='$ID'"));
                $Replies = mysql_num_rows($Replies = mysql_query("SELECT * FROM Replies WHERE PosterID='$ID'"));
                $Posts123 = $Threads + $Replies;
                echo "
                ".number_format($Posts123)."
              </td>
            </tr>
            <tr>
              <td width='40%'>
                <b>Friends:</b>
              </td>
              <td>
                ";
                $NumFriends = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$ID' AND Active='1'");
                $NumFriends = mysql_num_rows($NumFriends);
                echo "
                $NumFriends
              </td>
            </tr>
<tr>
              <td width='40%'>
                <b>Reputation:</b>
              </td>
              <td>
                ";
                if (!$gu->Points){
                  $Rep = "0";
                  } else {
                    $Rep = $gu->Points;
                      }
                      
                echo "
                $Rep
              </td>
            </tr>
            <tr>

              <td width='40%'>
                <b>Wall Posts</b>
              </td>
              <td>
                ";
                $NumberWallPosts = mysql_num_rows($NumberWallPosts = mysql_query("SELECT * FROM Wall WHERE PosterID='".$ID."'"));
                echo "
                ".$NumberWallPosts."
              </td>
            </tr>
            <tr>
              <td width='40%'>
                <b>Last Online:</b>
              </td>
              <td>
                ";
                if (!$gU->expireTime) {
                $SS = "Error";
                }
                else {
                if ($now < $gU->expireTime) {
                $SS = "<font color='green'>Now</font>";
                }
                else {
                $SS = date("F j, Y g:iA", $gU->expireTime);
                }
                }
                
                echo "
                $SS
              </td>
            </tr>
          </table>
        </div>
        <br />
        <font size='4'>
  Badges </font>
        </div>
        <div id='aB'>
          
          ";
          if ($gU->ID == 164) {
                echo"dwefijeijfedffjfij C: "; }
          $numBadges = mysql_num_rows($Badges = mysql_query("SELECT * FROM Badges WHERE UserID='$ID'"));
          
          if ($numBadges > 0) {
          
            echo "<center><table><tr>";
            $Badges = mysql_query("SELECT * FROM Badges WHERE UserID='$ID' ORDER BY ID");
            $badge = 0;
            while ($Row = mysql_fetch_object($Badges)) {
              $badge++;
              echo "
              <td width='100'><center>
                <a href='/Badges.php'><img src='/Badgess/".$Row->Position.".png' height='64' width='64'>
                <br />
                <b>".$Row->Position."</b></a>";
                echo"
                
              
              </td>
              ";
              if ($badge >= 4) {
              echo "</tr><tr>";
              $badge = 0;
              }
            
            }
            echo "</tr></table>";
          
          }
          
          echo "
          
        </div>
      </td>
      <td width='50%' valign='top'>
        <font size='4'>
          Wall </font>
        </div>
        <div id='aB' style='overflow-y:auto;max-height:150px;'>
          ";
          $getWall = mysql_query("SELECT * FROM Wall WHERE PosterID='".$ID."' ORDER BY ID DESC");
          while ($gW = mysql_fetch_object($getWall)) {
          
            echo "
            <table width='99%' id='WallPost'>
              <tr>
                <td>
                  <font style='font-size:10px;float:right;'>
                  ";
                  
                  $k = date("m-d-y g:i:A", "$gW->time");
                  echo "
                  $k
                  </font>
                  <a href='../user.php?ID=".$ID."'><b>".$gU->Username."</b></a>: ".$gW->Body."
                                    ";
                  if ($myU->PowerMegaModerator == "true"||$myU->PowerAdmin == "true") {
                  
                    echo "
                    <br />
                    <font style='font-size:8pt;'>
                      <a href='user.php?ID=$ID&wall=scrub&wallid=".$gW->ID."'><font color='blue'><b>Scrub</b></font></a> | 
                      <a href='user.php?ID=$ID&wall=delete&wallid=".$gW->ID."'><font color='blue'><b>Delete</b></font></a>
                    </font>
                    ";
                  
                  }
                  echo "
                </td>
              </tr>
            </table>
             <DIV STYLE='PADDING-TOP:5PX;'></DIV>
            ";
          
          }
          if ($myU->PowerMegaModerator == "true"||$myU->PowerAdmin == "true") {
          
            $wall = mysql_real_escape_string(strip_tags(stripslashes($_GET['wall'])));
            $wallid = mysql_real_escape_string(strip_tags(stripslashes($_GET['wallid'])));
            
            if ($wall == "scrub") {
            
              mysql_query("UPDATE Wall SET Body='[ Content Deleted ]' WHERE ID='".$wallid."'");
              header("Location: user.php?ID=$ID");
            
            }
            elseif ($wall == "delete") {
            
              mysql_query("DELETE FROM Wall WHERE ID='$wallid'");
              header("Location: user.php?ID=$ID");
              
            }
          }
          echo "
        </div>
        ";

          
          $Setting = array(
            "PerPag1e" => 8
          );
          $Page1 = mysql_real_escape_string(strip_tags(stripslashes($_GET['FRPage'])));
          if ($Page1 < 1) { $Page1=1; }
          if (!is_numeric($Page1)) { $Page1=1; }
          $Minimum1 = ($Page1 - 1) * $Setting["PerPag1e"];
          $allusers1 = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$ID' AND Active='1'");
          $num1 = mysql_num_rows($allusers1);
          $getFRs = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$ID' AND Active='1' LIMIT {$Minimum1},  ". $Setting["PerPag1e"]);
          $RFriends = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$ID' AND Active='1'");
          $NumFriends = mysql_num_rows($getFRs);
          $KFriends = mysql_num_rows($RFriends);
          echo "
        <br />
        <font size='4'>
          Friends (".$KFriends.") </font>
        </div>
        <div id='aB'>
        <center>
          ";
          echo "<table><tr>";
          
          if ($NumFriends == 0) {
          
            echo "<b>This user has not added any friends</b>";
          
          }
            $friends = 0;
            while ($gF = mysql_fetch_object($getFRs)) {
            $friends++;
            $getFriend = mysql_query("SELECT * FROM Users WHERE ID='".$gF -> SenderID."'");
            $gFF = mysql_fetch_object($getFriend);
          echo "
          <td align='center' width='100'>
            <div style='height:100px;width:100px;overflow-y:hidden;'>
            <a href='../user.php?ID=".$gFF->ID."' style='color:black;font-weight:bold;'>
            ";      $height = 100;
                $width = 100;
                echo "
            <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gFF->Background . ");'>
            <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(Dir/Avatar.png);'>
              <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gFF->Eyes . ");'> 
                <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gFF->Mouth . ");'>
                  <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../StoreDir/" . $gFF->Hair . ");'>
                    <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gFF->Bottom . ");'>
                      <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gFF->Top . ");'>
                        <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gFF->Hat . ");'>
                          <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gFF->Shoes . ");'>
                            <div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(../Store/Dir/" . $gFF->Accessory . ");'>
"; if ($gFF->Premium == 1) { echo"<img src='../Imagess/pw.png'>"; }                             
                            if (time() < $gO->expireTime) {
                            echo "<div style='width: ".$width."px; height: ".$height."px; z-index: 3;  background-image: url(/Imagess/OnlineWatermark.png);'>";
                            }
                            if (time() < $gO->expireTime) {
                            echo "</div>";
                            }
                            echo "
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          "; echo"
            </div>
            (".$gFF -> Username.")<br />
                                           
            </a>
          </td>
          ";
$Action = $_GET['Actin'];
if ($Action == "RemoveFriend") {
mysql_query("DELETE * FROM FRs WHERE ID='$gF->SenderID'"); } 
          if ($friends >= 4) {
          
            echo "</tr><tr>";
            $friends = 0;
          
          }
          }
          
          echo "</tr></table>";
            $amount=ceil($num1 / $Setting["PerPag1e"]);
            if ($Page1 > 1) {
            echo '<a href="user.php?ID='.$ID.'&FRPage='.($Page1-1).'">Prev</a> - ';
            }
            echo ''.$Page1.'/'.(ceil($num1 / $Setting["PerPag1e"]));
            if ($Page1 < ($amount)) {
            echo ' - <a href="user.php?ID='.$ID.'&FRPage='.($Page1+1).'">Next</a>';
            }
          $NumInGroups1 = mysql_query("SELECT * FROM GroupMembers WHERE UserID='$ID'");
          $NumInGroups = mysql_num_rows($NumInGroups1);
          
          echo "
        </div>
        <br />
        <font size='4'>
          Groups (".$NumInGroups.") </font>
        </div>
        <div id='aB'><center>
        <table><tr>
          ";
          $groups = 0;
          while ($gG = mysql_fetch_object($NumInGroups1)) {
          $groups++;
          $getGroupK = mysql_query("SELECT * FROM Groups WHERE ID='$gG->GroupID'");
          $gK = mysql_fetch_object($getGroupK);
          
            echo "
            <td width='100' valign='top'>
            <center>
            <a href='../Groups/Group.php?ID=".$gK->ID."'>
            <div style='width:50px;height:50px;padding:5px;border:1px solid #ddd;'>
            <img src='../Groups/GL/".$gK->Logo."' height='50' width='50'>
            </div>
            <b>".$gK->Name."</b>
            </a>
            </td>
            ";
            if ($groups >= 4) {
            
              echo "</tr><tr>";
              $groups = 0;
            
            }
          
          }
          echo "
          </tr></table>
        </div>
      </td>
    </tr>
  </table>
  ";
echo "
<font size='4'><div style='width:50%'>
Inventory </font>
</div>
<div id='aB'><table><tr><a name='OwnedItems'></a>
";
          $counter = 0;
            $Setting = array(
              "PerPage1" => 16
            );
            $Item = mysql_real_escape_string(strip_tags(stripslashes($_GET['Item'])));
            if ($Item < 1) { $Item=1; }
            if (!is_numeric($Item)) { $Item=1; }
            $Minimum1 = ($Item - 1) * $Setting["PerPage1"];
            //query
            $allusers1 = mysql_query("SELECT * FROM Inventory WHERE UserID='".$ID."'");
            $num1 = mysql_num_rows($allusers1);
          $getOwnedItems = mysql_query("SELECT * FROM Inventory WHERE UserID='".$ID."' ORDER BY ID DESC LIMIT {$Minimum1},  ". $Setting["PerPage1"]);
            while ($gO = mysql_fetch_object($getOwnedItems)) {
            
              
            
              $getFromStore = mysql_query("SELECT * FROM Items WHERE File='".$gO->File."'");
              
              $if_store = mysql_num_rows($getFromStore);
              
              if ($if_store == "1") {
              
                $store = 1;
                
                $gF = mysql_fetch_object($getFromStore);
              
              }
              else {
              
                $store = 0;
                $getFromStore = mysql_query("SELECT * FROM UserStore WHERE File='".$gO->File."'");
                $gF = mysql_fetch_object($getFromStore);
                $DeleteItem = mysql_num_rows($getFromStore);
                
              }
              
                if ($DeleteItem == "0") {
                mysql_query("DELETE FROM Inventory WHERE ID='".$gO->ID."'");
                }
                              
                $getCreator = mysql_query("SELECT * FROM Users WHERE ID='".$gF->CreatorID."'");
                $gC = mysql_fetch_object($getCreator);
                
                if ($if_store == 1) {
                
                  $Link = "/Store/Item.php?ID=".$gF->ID."";
                
                }
                else {
                
                  $Link = "/Store/UserItem.php?ID=".$gF->ID."";
                
                }
              $counter++;
              echo "
              <td style='font-size:11px;' align='left' width='100' valign='top'><a href='".$Link."' border='0' style='color:black;'>
                <div style='border:1px solid #ddd;border-radius:5px;padding:5px;'>
                  ";
                  if ($gF->saletype == "limited") {
                  echo "
                    
                    <div style='width: 100px; height: 200px; z-index: 3;  background-image: url(/Store/Dir/".$gF->File.");'>
                    
                    <div style='width: 100px; height: 200px; z-index: 3;  background-image: url(/Images/limited.png);'>
                    "; 
if ($gO->SerialNum != "0") { echo "<center><font style='color:#253138;font-weight:bold;'>#".$gO->SerialNum."/".$gF->numbersales."</font></font>"; }
if ($gO->SerialNum == "0") { echo "<center><font style='color:#253138;font-weight:bold;'>#0/".$gF->numbersales."</font></font>"; }


                    echo "</div></div>
                  ";
                  }
                  else {
                     echo"<img src='/Store/Dir/".$gF->File."' width='100' height='200'>";
                  }
                  echo "
                </div>
                <b>".$gF->Name."</b></a>
                <br />
                <font style='font-size:10px;'>Creator: <a href='/user.php?ID=".$gF->CreatorID."'>".$gC->Username."</a>
                <br />
                ";
                if ($gF->sell == "yes") {
                if ($gF->saletype == "limited" && $gF->numberstock == "0") {
                 echo "

                <font color='green'><b>Was BUX: ".$gF->Price."</b></font>
                ";
                }
                else {
                 echo "
                <font color='green'><b>BUX: ".$gF->Price."</b></font>

                ";
                }
if ($gF->saletype == "limited") { echo"<br /><a href='?ID=$ID&trade=trade'><font color='green'>Trade</font></a>"; }
                }
                echo "
                
              </td>
              ";
              
              if ($counter >= 8) {
              
                echo "</tr><tr>";
                
                $counter = 0;
              
              }
              
              
            
            }
                  echo "</tr></table><center>";
                  $amount=ceil($num1 / $Setting["PerPage1"]);
                  if ($Item > 1) {
                  echo '<a href="user.php?ID='.$ID.'&Item='.($Item-1).'#OwnedItems">Prev</a> - ';
                  }
                  echo 'Page '.$Item.'/'.(ceil($num1 / $Setting["PerPage1"]));
                  if ($Item < ($amount)) {
                  echo ' - <a href="user.php?ID='.$ID.'&Item='.($Item+1).'#OwnedItems">Next</a>';
                  }
echo "
</div>
";
  if ($myU->PowerMegaModerator == "true"||$myU->Username == "Bailey") {
  
    echo "
    <br /><fieldset><legend>Moderation</legend>
    <center><div id='obsidian' style='width:90%;'>
    
      
<b> To ban this user or moderate any action please click the Admin tab on the header then click Manager Users then moderator user</b>
      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href='ViewOtherAccounts.php?ID=$ID' style='color:darkred;'><b>All Accounts</b></a>
      
      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href='iplogs.php?ID=$ID' style='color:darkred;'><b>IP Logs</b></a>
                       
              
      ";
      if ($myU->Username == "Bailey"||$myU->Username == "Pheedy"||$myU->Username == "RachelM") {
      
        echo "
      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href='user.php?ID=$ID&moderation=fireuser' style='color:darkred;'><b>Fire User</b></a>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href='user.php?ID=$ID&moderation=poision' style='color:darkred;'><b>Poison</b></a> 
        ";
      
      }
      echo "
    </div>
    </center>
    ";
    $moderation = mysql_real_escape_string(strip_tags(stripslashes($_GET['moderation'])));
    
      if ($moderation == "scrubdescription") {
      
        mysql_query("UPDATE Users SET Description='[ Content Deleted ]' WHERE ID='$ID'");
        header("Location: user.php?ID=$ID");
      
      }
      
      if ($myU->Username == "Bailey"||$myU->Username == "Pheedy"||$myU->Username == "RachelM") {
      
        if ($moderation == "fireuser") {
        
          mysql_query("UPDATE Users SET PowerImageModerator='false' WHERE ID='$ID'");
          mysql_query("UPDATE Users SET PowerForumModerator='false' WHERE ID='$ID'");
          mysql_query("UPDATE Users SET PowerArtist='false' WHERE ID='$ID'");
          mysql_query("UPDATE Users SET PowerMegaModerator='false' WHERE ID='$ID'");
          mysql_query("UPDATE Users SET PowerAdmin='false' WHERE ID='$ID'");
          
          //badges
          
          mysql_query("DELETE FROM Badges WHERE Position='Image Moderator' AND UserID='$ID'");
          mysql_query("DELETE FROM Badges WHERE Position='Forum Moderator' AND UserID='$ID'");
          mysql_query("DELETE FROM Badges WHERE Position='Artist' AND UserID='$ID'");
          mysql_query("DELETE FROM Badges WHERE Position='Mega Moderator' AND UserID='$ID'");
          mysql_query("DELETE FROM Badges WHERE Position='Administrator' AND UserID='$ID'");
          mysql_query("DELETE FROM Badges WHERE Position='Developer' AND UserID='$ID'");
          
          header("Location: user.php?ID=$ID");
        
        }
      
      }

      
      
      
      if ($moderation == "scrubname") {
        mysql_query("UPDATE Users SET OriginalName='$gU->Username' WHERE ID='$ID'");
        mysql_query("UPDATE Users SET Username='[ Content Deleted $ID ]' WHERE ID='$ID'");
        header("Location: user.php?ID=$ID");
      
      }
      
      if ($moderation == "revertname") {
        mysql_query("UPDATE Users SET Username='$gU->OriginalName' WHERE ID='$ID'");
        mysql_query("UPDATE Users SET OriginalName='' WHERE ID='$ID'");
        header("Location: user.php?ID=$ID");
      
      }
if ($myU->Username == "RachelM"||$myU->Username == "Pheedy") {

if ($moderation == "poision") { mysql_query("UPDATE Users SET Ban='1' WHERE IP='$gU->IP'"); mysql_query("UPDATE Users SET BanDescription='Your account has been closed due to a poison ban. Contact help@Gravitar.net for assistance.' WHERE IP='$gU->IP'"); mysql_query("UPDATE Users SET BanLength='forever' WHERE IP='$gU->IP'"); mysql_query("UPDATE Users SET BanTime='forever' WHERE IP='$gU->IP'"); }
}
      
      if ($moderation == "ipban") {
      

        if ($Ban == 0) {
        
          mysql_query("INSERT INTO IPBans (IP) VALUES('".$gU->IP."')");
          mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','IP Banned $gU->Username','".$_SERVER['PHP_SELF']."')");
          header("Location: user.php?ID=$ID");
        
        }
        header("Location: user.php?ID=$ID");
      
      }
  
  }

}
if ($gU->Premium == 1) {
echo "<style>body { background-image:url(../PremiumStripeBG.png); }</style>";

}
}
include "Footer.php";

$sendpoints = $_GET['sendpoints'];
$givepoints = $gU->Points + 20;
if ($sendpoints == "true") {
  echo "
          <div style='background-image:url(/Imagess/menuhover.png);width:100%;height:100%;top:0;left:0;position:fixed;'><center>
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <div style='background:#ccc;border:1px solid gray;width:500px;padding:8px;text-align:left;'>
              <font id='HeadText'>
                You're about to give " . $gU->Username . " reputation points!
              </font>
              <br />
              <form action='?ID=" . $ID . "&sendpoints=true' method='POST'>
                How much do you want to give " . $gU->Username . "?<br>
                <font color='darkgray' size='1'>*If you give 3 rep points, you lose 3 rep points.</font>
                <br /><br>
                <input type='number' min='5' max='20' name='rep' /><br>
                <input type='submit' name='Send' value='Send'>
              </form>
            </div>
          </div>
              ";
              if ($_POST['Send']){
                $amount = mysql_real_escape_string($_POST['rep']);
                if ($amount < 5){
                  echo "
          <div style='background-image:url(/Imagess/menuhover.png);width:100%;height:100%;top:0;left:0;position:fixed;'><center>
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <div style='background:#ccc;border:1px solid gray;width:500px;padding:8px;text-align:left;'>
              <font id='HeadText'>
                Fail
              </font>
              <br />
              <form action='" . $ID . "' method='POST'>
                You can't send less than 5 rep points!
                <br />
                <input type='submit' name='Close' value='Close'>
              </form>
            </div>
          </div>
              ";
                }elseif ($amount > 20){
                  echo "
          <div style='background-image:url(/Imagess/menuhover.png);width:100%;height:100%;top:0;left:0;position:fixed;'><center>
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <div style='background:#ccc;border:1px solid gray;width:500px;padding:8px;text-align:left;'>
              <font id='HeadText'>
                Fail
              </font>
              <br />
              <form action='" . $ID . "' method='POST'>
                You can't send more than 20 rep points!
                <br />
                <input type='submit' name='Close' value='Close'>
              </form>
            </div>
          </div>
              ";
                }elseif ($amount > $myU->Points){
                  echo "
          <div style='background-image:url(/Imagess/menuhover.png);width:100%;height:100%;top:0;left:0;position:fixed;'><center>
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <div style='background:#ccc;border:1px solid gray;width:500px;padding:8px;text-align:left;'>
              <font id='HeadText'>
                Fail
              </font>
              <br />
              <form action='?ID=" . $ID . "' method='POST'>
                You don't have enough reputation points!
                <br />
                <input type='submit' name='Close' value='Close'>
              </form>
            </div>
          </div>
              ";
                }else{
                  $amount = mysql_real_escape_string($_POST['rep']);
$allow = true;
$i = mysql_fetch_array(mysql_query("SELECT * FROM `Reputation` WHERE `GivenIP`='$IP' AND `GivenID`='$gU->ID'"));
if ($i == 0){
  $allow = true;
}else{
  $allow = false;
}
if ($allow == true){
mysql_query("UPDATE `Users` SET `Points`=Points+'$amount' WHERE ID='$ID'") or die(mysql_error()); 
mysql_query("INSERT INTO `Reputation` (`UserID`, `GivenIP`, `GivenID`) VALUES ('$myU->ID', '$IP', '$gU->ID')");
mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','Gave rep points to $gU->Username','".$_SERVER['PHP_SELF']."')"); 
$myid = $myU->ID;
mysql_query("UPDATE `Users` SET `Points`=`Points`-'$amount' WHERE `ID`='$myid'");

echo "
          <div style='background-image:url(/Imagess/menuhover.png);width:100%;height:100%;top:0;left:0;position:fixed;'><center>
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <div style='background:#ccc;border:1px solid gray;width:500px;padding:8px;text-align:left;'>
              <font id='HeadText'>
                Success
              </font>
              <br />
              <form action='?ID=" . $ID . "' method='POST'>
                You've given " . $gU->Username . " " . $amount . " reputation points!
                <br />
                <input type='submit' name='Close' value='Close'>
              </form>
            </div>
          </div>
              ";
}else{
  echo "
          <div style='background-image:url(/Imagess/menuhover.png);width:100%;height:100%;top:0;left:0;position:fixed;'><center>
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <div style='background:#ccc;border:1px solid gray;width:500px;padding:8px;text-align:left;'>
              <font id='HeadText'>
                Error
              </font>
              <br />
              <form action='?ID=" . $ID . "' method='POST'>
                You've already given this user reputation points!
                <br />
                <input type='submit' name='Close' value='Close'>
              </form>
            </div>
          </div>
              ";
}
              }
}
              }
$scrub = $_GET['moderation'];

if ($scrub == "scrubstatus") { mysql_query("UPDATE Users SET ProfileStatus='[ Content Deleted ]' WHERE ID='$gU->ID'");
header("Location ../index.php"); } if ($gU->Ban == "1") { 

header("Location: ../Error/DoesntExist.php"); }
$action = $_GET['action'];
$Link = $_SERVER['PHP_SELF'];
if ($action == "advertise") {
header("Location: ../Advertising/CreateUserAd.php?link=$Link?ID=$ID"); exit();
}
echo"</div>";

$trade = $_GET['trade'];
$itemID = $_GET['ItemID'];
if ($trade == "trade") {
header("Location: RequestTrade.php?ID=$ID&ItemID=$gF->ID"); exit(); }


echo'  <audio autoplay loop>
      <source src="$myU->MusicLink" type="audio/mp3"></audio>';
?>