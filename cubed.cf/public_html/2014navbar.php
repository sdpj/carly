<style>.site-header {
    background: #6a6aa7;
    background: linear-gradient(
90deg
,#265a7f,#545489);
    border-bottom: 0;
    font-weight:normal!important;
    padding-bottom: 45px;
}

#navigation-container ul li a, #navigation-menu ul li a:visited {
    border: 0 solid black;
    padding: 0;
    text-decoration: none;
    outline: none;
    font-size: 15px;
    font-weight: normal !important;
    padding-bottom:3px;
}

</style><div class="site-header">
    <div id="navigation-container" style="margin-top:5px;">
        <a href="/Default.aspx" class="btn-logoo" data-se="nav-logo"><img src="/cubed.png" height="30px" style="float:left;padding-right:5px;"></a>
        <div id="navigation-menu">
            <ul>
                <li><a href="/Default.aspx" ref="nav-myroblox" data-se="nav-myhome">Home</a></li>
                <li><a data-se="nav-games" href="/games" ref="nav-games" title="Games">Games</a> </li>
                <li><a data-se="nav-catalog" href="/Catalog.aspx" ref="nav-catalog" title="Catalog">Catalog</a></li>
                <li><a data-se="nav-catalog" href="/Browse.aspx" ref="nav-catalog" title="Browse">People</a></li>
                <li><a data-se="nav-catalog" href="/News.aspx" ref="nav-catalog" title="Browse">News</a></li>
            </ul>
        </div>
                <div id="header-login-container">
        <?php if(isset($_SESSION['id'])){echo '<div id="AlertSpace">
<div class="AlertItemm" style="max-width: 500px;text-align:center;float:right;" id="logoutonclick">&nbsp;&nbsp;&nbsp;&nbsp;
<a id="lsLoginStatus" data-se="nav-logoutt" class="logoutButton btn btn-danger" href="/logout">Logout</a>
</div>


<a data-se="nav-robux" href="#">
<div id="RobuxWrapper" class="RobuxAlert AlertItem tooltip-bottom" original-title="ROBUX" style="margin-left:8px;">
<div class="icons robuxs_icon"><img src="/diu_16.png"></div>
<div id="RobuxAlertCaption" class="AlertCaption">'.$_SESSION['qian'].'</div>
</div>
</a>



<a data-se="nav-login" href="/User.aspx">
<div id="AuthenticatedUserNameWrapper">
<div id="AuthenticatedUserName">
<span class="login-span notranslate">'.$_SESSION['user'].'</span>
</div>
</div>
</a>

</div>';}else{echo '
                    <div id="header-login-wrapperr" class="iframe-login-signupp" data-display-opened="" style="float:right!important;margin:0px;padding:0px;display:inline-block;white-space:nowrap;/*position:relative;top:-10px;*/">
                        <a id="header-signupp" href="/login.aspx" style="color: #fff;">Login</a>
                        &nbsp;
                        <span id="login-span">
                            <a href="/register.aspx" class="btn btn-success" style="background-image:none !important;background-color: #38a169!important; border-color: #38a169!important;color:white;text-transform: none !important;">Register</a>
                        </span>
                        <div id="iFrameLogin" style="display: none; height: 128px;">
                            <iframe class="login-frame" src="/register.aspx" scrolling="no" frameborder="0"></iframe>
        </div>
  
  
  
  
  
  

  
  
  
  
  
  </div>
  
  
  
  
  
  
  
  
  
  
  
  ';} ?>
                </div>
    </div>
    <br>
<p>&nbsp;</p>
</div>
                            <p>&nbsp;</p>
                            <div id="ctl00_Announcement">
<div id="ctl00_SystemAlertDiv" class="SystemAlert" style="width:100%;margin-top:24px;border:0px;background-color:#e53e3e;background-image:  url();background-size: auto;background-position: left center;background-repeat: no-repeat;">
<div id="ctl00_SystemAlertTextColor" class="SystemAlertText">
<div id="ctl00_LabelAnnouncement">welcome to fucking CUBED, because why not</div>
</div>
</div>
</div>
                            <!--<div id="ctl00_Announcement">
<div id="ctl00_SystemAlertDiv" class="SystemAlert" style="background-color:#188a4e;background-image:  url();background-size: auto;background-position: left center;background-repeat: no-repeat;">
<div id="ctl00_SystemAlertTextColor" class="SystemAlertText">
<div id="ctl00_LabelAnnouncement">if you find any bugs report them to janx or phil</div>
</div>
</div>
</div>-->
<!--<div id="ctl00_Announcement">
<div id="ctl00_SystemAlertDiv" class="SystemAlert" style="background-color:#1951a5;background-image:  url();background-size: auto;background-position: left center;background-repeat: no-repeat;">
<div id="ctl00_SystemAlertTextColor" class="SystemAlertText">
<div id="ctl00_LabelAnnouncement">30 users nice</div>
</div>
</div>
</div>-->