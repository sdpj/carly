<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
   <head>
      <?php include_once "2014head.php"; ?>
      <?php include_once "updateinfo.php"; ?>
      <?php
            $id=69420;
            $user="";$about="";$aeae="";$onn="";$kkz="";
            if(!isset($_GET['id'])){
                if(isset($_SESSION['id'])){$id=$_SESSION['id'];}else{
                    header('Location: 404');
                }
            }else{$id=$_GET['id'];}

            $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
            if ($polaczenie->connect_errno!=0)
            {
                echo "Error: ".$polaczenie->connect_errno;
            }
            else
            {
                if ($rezultat = @$polaczenie->query(
                sprintf("SELECT * FROM users WHERE id='%s'",
                mysqli_real_escape_string($polaczenie,$id))))
                {
                        
                    $ilu_userow = $rezultat->num_rows;
                    if($ilu_userow>0)
                    {
                        $wiersz = $rezultat->fetch_assoc();
                        
                        //  $_SESSION['zalogowany'] = true;
                        $user = $wiersz['user'];
                        $joindate = $wiersz['created_at'];
                            $aeae = date("F jS Y", strtotime($joindate));
                        $about = $wiersz['about'];
                        $onn = $wiersz['online'];
                        $adminlevel = $wiersz['admin'];
                        $kkz = $wiersz['profileviews'];
                        $banreason = $wiersz['banreason'];
                        $bannote = $wiersz['moderatornote'];
                        $banned = $wiersz['banned'];;
                        unset($_SESSION['blad']);
                        $rezultat->free_result();
                        
                    } else {
                        //header('Location: 404');
                        include_once "2014navbar.php";
                        echo '<div id="BodyWrapper">
            <div id="RepositionBody">
               <div id="Body" style="width:970px">
             <div id="Body" class="" style="width:970px">

<div id="ErrorPage">
<div class="divideTitleAndBackButtons" style="margin:20px auto; height:100px; width:100%; border-top:1px solid #fff;">&nbsp;</div>
<img src="/img/exclamation2.png">
<h1>Requested page not found</h1>
<h3>You may have clicked an expired link or mistyped the address.</h3>
<pre><span id="ctl00_cphRoblox_errorMsgLbl"></span></pre>
<div class="divideTitleAndBackButtons">&nbsp;</div>
<div class="CenterNavigationButtonsForFloat">
<a onclick="history.back();return false;" href="#">Go to Previous Page</a>
<a href="/">Return Home</a>
<div style="clear:both"></div>
</div>
<div class="divideTitleAndBackButtons" style="margin:20px auto; height:100px; width:100%; border-top:1px solid #fff;">&nbsp;</div>
</div>




</div>
            </div>
         </div>';
         die();
                    }
                    
                }
                
                $polaczenie->close();
            }
  /*if(isset($_SESSION['id']) && !($id == $_SESSION['id'])){
    $conn = new mysqli($host, $db_user, $db_password);
    $conn->select_db($db_name);
    $sql = "UPDATE `users` SET `profileviews` = '".($kkz+1)."' WHERE `users`.`id` = ".$id.";";
    $result = $conn->query($sql);
    $conn->close();
  }*/
  $assy = $about;
  //if ($user == 'sudoapt') {
      //$assy = '"We do what we must because we can." the loser, the legend, the lemonade guy.
//<br>
//i dual boot Windows 10 and Solus. I also enjoy me some good Portal, and am just kinda in the OSC and little more.';
//  }
        ?>
        <title><?php echo $user; ?> - Cubed</title>
        <meta property="og:site_name" content="Cubed">
    <meta property="og:title" content="<?php echo $user; ?> - Cubed">
    <meta property="og:type" content="profile">
    <meta property="og:url" content="https://cubed.cf/User.aspx?id=<?php echo $_GET['id']; ?>">
    <meta property="og:description" content='<?php echo $assy; ?>'>
    <meta property="og:image" content="https://cubed.cf/get_avatar?id=<?php echo $_GET['id']; ?>">
    <style>
    td { padding-bottom:0px !important; } 
    .UserPaneContainer { text-align: center !important; }
    </style>
   </head>
   <body class="">
      <div id="MasterContainer">
         <?php include_once "updatestuff.php"; ?>
         <?php include_once "2014navbar.php"; ?>
         <div id="BodyWrapper">
            <div id="RepositionBody">
                <div id="Body" style="width:970px;">
                    
    <style type="text/css">
        #Body {
            padding: 10px;
        }
    </style>
    <div>
        
<div style="width:900px;height:30px;clear:both; display:none;">
    <span id="ctl00_cphRoblox_rbxHeaderPane_nameRegion" style="font-size:20px; font-weight:bold;">Dert41</span>
</div>




        
        <div style="clear: both; margin: 0; padding: 0;"></div>
        <div class="divider-rightt" style="width: 484px; float: left">


          
          
          
          
<div class="card" style="width: 200%;"><div class="card-body">
  
  <div id="UserAvatar" class="thumbnail-holder" data-3d-thumbs-enabled="" data-url="/web/20141009134408oe_/http://www.roblox.com/thumbnail/user-avatar?userId=68647&amp;thumbnailFormatId=124&amp;width=352&amp;height=352">
    <span class="thumbnail-span" data-3d-url="/avatar-thumbnail-3d/json?userId=68647" data-js-files="http://js.rbxcdn.com/2cdabe2b5b7eb87399a8e9f18dd7ea05.js"><img alt="Avatar" height="250px" class="" src="/get_avatar.php?id=<?php echo $id; ?>" style="max-width: 350px; float: left; margin-right: 1.7rem;"></span>
</div><?php
            if ($adminlevel == 'yes') {
                $asd = '<span style="color:#e74c3c"> Administrator </span>';
            } elseif ($user == 'Katrinaa') {
                $asd = '<span style="color:#33cc00"> Well-Known </span>';
            } elseif ($adminlevel == 'no') {
                $asd = '<span style="color:#e74c3c"> Member </span>';
            } elseif (!$adminlevel) {
                $asd = '<span style="color:#e74c3c"> Member </span>';
            } elseif ($user == 'Cross') {
                $asd = '<span> Idiot </span';
            } else {
                $asd = '<span style="color:#e74c3c"> Member </span>';
            }
            ?>
<div id="user-info"><h3 class="mb-0" style="color: #ececec;"><span id="ctl00_cphRoblox_rbxUserPane_lUserOnlineStatus"> <?php if($onn==1){ echo ''; } ?><?php if($onn==1){ echo '<i class="fa fa-circle" style="color:green;"></i>';}else{echo '<i class="fa fa-circle" style="color:red;"></i>';} ?></span>&nbsp;<?php echo $user; ?></h3> <div class="mb-2"></div> <b class="mb-0">Blurb:</b> <p class="mb-4" style="white-space:nowrap;"><?php echo $assy;?></p> <p class="mb-0"><b>Friends: </b> 0</p> <p class="mb-0"><b>Join Date: </b> <?php
    if ($user == 'acroarson') {
      $aeae = '240000000 BC';
      echo $aeae;
    } else {
        echo $aeae;
    } ?></p><p><b>Role:</b> <?php echo $asd; ?></p></div></div></div>          
          
          
          
<br><div class="row" style="width: 206.2%!important;"><div class="col-lg-6 mb-2"><a class="catalog-card"><div class="card" style="height: 202px!important;"><div class="card-body"><h3 style="color: #ececec;">Friends</h3> <p class="text-muted mb-0" style="margin-bottom: 1.25rem !important;">This user has no friends.</p></div></div></a></div> <div class="col-lg-6 mb-2"><a class="catalog-card"><div class="card"><div class="card-body"><h3 style="color:#ececec;">Badges</h3> <p class="text-muted mb-0"><?php if($adminlevel == "yes"){

                $asd = '<span style="color:#e74c3c"> Administrator </span>';
            } elseif ($user == 'Katrinaa') {
                $asd = '<span style="color:#33cc00"> Well-Known </span>';
            } elseif ($adminlevel == 'no') {
                $asd = '<span style="color:#ececec"> Member </span>';
            } elseif (!$adminlevel) {
                $asd = '<span style="color:#ececec"> Member </span>';
            } elseif ($user == 'Cross') {
                $asd = '<span> Idiot </span';
            } else {
                $asd = '<span style="color:#ececec"> Member </span>';
            }
              
  
  
  
  echo'<td>
          <div class="Badge">
            <div class="BadgeImage"><a id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl00_hlHeader" href="Badges.aspx"><img id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl00_iBadge" src="/img/logo.svg" alt="" style="height:75px;width:75px;border-width:0px;"></a></div>
            <div class="BadgeLabel"><a id="ctl00_cphRoblox_rbxUserBadgesPane_dlBadges_ctl00_HyperLink1">'; echo $asd; echo'</a></div>
          </div>
  </td>'; ?></p></div></div></a></div></div>
          
          
          


    

                    <div style="clear:both"></div>
                </div>
            </div>
        </div>
        <?php include "2014footer.php" ?>
      </div>
   </body>
</html>