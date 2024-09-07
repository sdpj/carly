<?        
  include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
  if(!$User){
    header("Location: /register.aspx");
    die(); 
  }
  $RecentForums = mysql_query("SELECT * FROM Threads ORDER BY ID DESC LIMIT 7");
  $Posted = ($_GET['Posted']);
  $RecentMembers = mysql_query("SELECT * FROM Users ORDER BY ID DESC LIMIT 0,5");
  
  
          
?>
  <h1>Hello, <?echo $myU->Username;?>!</h1>
  <div class='left-column'>
    <div class='user-avatar-container'>
      <img src='/Avatar.aspx?ID=<?echo $myU->ID;?>' style='margin-bottom:10px;'>
    </div>
    <div class='left-column-boxes'>
      <b>ROBLOX News</b>
      <div style='margin-top:7px;'></div>
      <img src='/Images/BulletPointArrow.png'>
      &nbsp;
      <a href='/Blog/Post/?ID=1'>
        Welcome to ROBLOX!
      </a>
      <div style='margin-top:7px;'></div>
      <img src='/Images/BulletPointArrow.png'>
      &nbsp;
      <a href='/Blog/Post/?ID=1'>
        ROBLOX in Beta...
      </a>
    </div>
    <div class='left-column-boxes'>
      <b>My Best Friends</b>
      &nbsp;
      <a href='/My/BestFriends.aspx' class='btn-best' style='font-size:13px;padding:2px;'>
        Edit
      </a>
    </div>
  </div>
  <div class='left-column' style='width:auto;'>
    <div style='padding-right:10px;padding-left:10px;'>
      <div class='user-status-box'>
        <form action='' method='POST' style='margin:0;'>
          <center>
            <input type='status' name='StatusText' placeholder='<?echo $myU->ProfileStatus;?>'>
            &nbsp;
            <input type='submit' name='StatusSubmit' class='btn-control-prof' value='Share' style='font-size:12px;font-weight:bold;'>          
          </center>
        </form>
        <?
        $StatusSubmit = SecurePost($_POST['StatusSubmit']);
        $StatusText = SecurePost($_POST['StatusText']);
        if ($StatusSubmit && $User){
          $StatusText = filter($StatusText);
          $StatusText = htmlentities($StatusText);
          if(strlen($StatusText) > 140){
            echo"
            Keep it under 140 characters! :)
            ";
          }
          mysql_query("UPDATE Users SET ProfileStatus='".$StatusText."' WHERE ID='".$myU->ID."'");
          header("Location: /");
          die();
        }
        elseif($StatusSubmit && !$User){
          echo"
          <b>An error occured while updating your status.</b>
          ";
        }
      echo"</div>";
        
        ?>
    </div>
  
    <br style='clear:both;'>
    <div class='left-column-boxes' style='width:auto;'>
      <h2 style='margin:10px;'>
        Updates
      </h2>
      <div class='updates-panel'>
        <div class='UpdatesContent'>
          <div class='UpdatesImage'>
            <img src='/Badgess/Icon.png' width='75'>
          </div>
          <div class='UpdatesDescription'>
            Welcome to ROBLOX -- an online social avatar hangout for everyone. We're currently undergoing heavy construction, so not all features on the site are going to be available at this time. If you have any questions, please post on our <a href='/forum/'>Forum</a> or email us for assistance at <a href='mailto:info@oldblox.ga'>info@oldblox.ga</a>. 
          </div>
        </div>
      </div>
    </div>
    <div class='left-column-boxes' style='width:auto;'>
      <h2 style='margin:10px;'>
        My Feed
      </h2>
      <div class='feed-panel'>
        <div class='ShoutContent'>
          <div class='ShoutImage'>
            <img src='/Avatar.aspx?ID=1' width='40'>
          </div>
          <b>by <a href='/user.aspx?ID=1' style='font-weight:bold;'>ROBLOX</a> on Dec. 21, 2015 @ 5:15 p.m.</b>
          <div class='ShoutDescription'>
            &quot;<i>Hi!</i>&quot;
          </div>
        </div>
        <hr color='#ccc' size='1' style='margin:0;'>
      </div>
    </div>
  </div>
  <div class='left-column-boxes' style='border-top:0;border-bottom:1px solid #ccc;width:auto;'>
    <b>Recent Forum Posts</b>
    <div style='margin-top:7px;'></div>
    <?while($Recents = mysql_fetch_object($RecentForums)){
      if($Recents == 0){
        echo"
        <center>
          No recent forum posts!
        </center>
        ";
      }
      else{
        $getPoster = mysql_query("SELECT * FROM Users WHERE ID='".$Recents->PosterID."'");
        $gP = mysql_fetch_object($getPoster);
        echo"
        <img src='/Images/BulletPointArrow.png'>
        &nbsp;
        <a href='/forum/ShowPost.aspx?ID=".$Recents->ID."'>
          ".$Recents->Title."
        </a>
        <br />
        <font style='font-size:11px'>
          by 
          <a href='/user.aspx?ID=".$gP->ID."' style='font-size:11px;'>
            ".$gP->Username."
          </a>
          on ".$Recents->TimePosted."
        </font>
        <div style='margin-top:7px;'></div>
        ";
      }
    }?>
  </div>
  <div class='left-column-boxes' style='border:0;'>
    <b>Newly Joined Members</b>
    <div style='margin-top:7px;'></div>
    <?while($NewestMems = mysql_fetch_object($RecentMembers)){
        if($NewestMems == 0){
          echo"
          <center>
            No recent members!
          </center>
          ";
        }
        else{
          echo"
          <img src='/Images/BulletPointArrow.png'>
          &nbsp;
          <a href='/user.aspx?ID=".$NewestMems->ID."'>
            ".$NewestMems->Username."
          </a>
          <br />
          <font style='font-size:11px;'>
            on Decemeber 21, 2015.
          </font>
          <div style='margin-top:7px;'></div>
          ";
        }
      }?>
  </div>
  <br style='clear:both;'>
<?
  include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>