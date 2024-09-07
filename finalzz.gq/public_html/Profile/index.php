<?php
$id = $_GET['username'];
$pagename = "$id";
include('../header.php');
?>
<?php
if (!$id) {
echo "error";
} else {
$getUser = $handler->query("SELECT * FROM users WHERE username='".$id."'");
$gU = $getUser->fetch(PDO::FETCH_OBJ);
$id = $gU->id;
$admin = $gU->admin;
$username = $gU->username;
$userExist = ($getUser->rowCount());
if ($userExist == "0") {
header("Location: /");
} else {
?>
<?php
}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link rel="stylesheet" href="/Style/headlol.css" />
<link rel="stylesheet" href="/Style/head.css" />
<div id="BodyWrapper">
<div id="RepositionBody">

<div id="Body" style="width:970px">
<style type="text/css">
  #Body {
  padding: 10px;
  }
</style>
<div>
<div style="width:900px;height:30px;clear:both; display:none;">
<span id="ctl00_cphRoblox_rbxHeaderPane_nameRegion" style="font-size:20px; font-weight:bold;"><? echo $gU->username;?></span>
</div>
<? if ($gU->admin == "true"){ ?>
<div id="ctl00_cphRoblox_OBCmember" class="blank-box" style="margin-top: 10px; width: 951px; float: left; padding: 8px">
<div style="float: left; margin-right: 10px;">
<img src="../img/admin.png" alt="OBC" title="OBC member" border="0"></div>
<div style="float: left; line-height: 30px;">
You are viewing the profile of a <a href="Upgrades/BuildersClubMemberships.aspx">Moderation team
</a> member.</div>
</div>
<? } ?>
<? if ($gU->developer == "true"){ ?>
<div id="ctl00_cphRoblox_OBCmember" class="blank-box" style="margin-top: 10px; width: 951px; float: left; padding: 8px">
<div style="float: left; margin-right: 10px;">
<img src="../img/dev.png" alt="OBC" title="OBC member" border="0"></div>
<div style="float: left; line-height: 30px;">
You are viewing the profile of a <a href="Upgrades/BuildersClubMemberships.aspx">Development team
</a> member.</div>
</div>
<? } ?>
<div style="clear: both; margin: 0; padding: 0;">
</div>
<!--[if IE 6]>
  <table>
    <tr>
      <td width="450px" valign="top">
        <![endif]-->
<div class="divider-right" style="width: 484px; float: left">
<h2 class="title">
<span id="ctl00_cphRoblox_rbxUserPane_lUserRobloxURL"><? echo $gU->username;?>'s Profile</span>
</h2>
<div class="divider-bottom" style="position: relative;z-index:3;padding-bottom: 20px">
<div style="width: 100%">
<div>
<div>
<div class="UserPaneContainer">
<div id="ctl00_cphRoblox_rbxUserPane_onlineStatusRow">
<div style="text-align: center;">
<span id="ctl00_cphRoblox_rbxUserPane_lUserOnlineStatus" class="UserOfflineMessage">[ Offline ]</span>
<br>
<a href="/Profile/?username=<? echo $gU->username;?>">http://rn1host.ml:53640/Profile/?username=<? echo $gU->username;?></a>
</div>
</div>
<div>
<div>
<center>
<div style="margin-bottom: 10px;">
</div>
<a id="ctl00_cphRoblox_rbxUserPane_AvatarImage" disabled="disabled" class=" notranslate" title="<? echo $gU->username;?>" onclick="return false" style="display:inline-block;height:200px;width:200px;">
<div class="roblox-avatar-image image-medium" data-user-id="1" data-image-size="custom" data-image-size-x="200" data-image-size-y="200" data-no-click="true" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="<? echo $gU->username;?>"><div style="position: relative;">
<iframe frameBorder="0" src=/chingchonk.php?id=<? echo $id ?> scrolling="no" style=" width: 200px; height: 200px"></iframe>
</div></div>
</a>
<br>
<div class="UserBlurb" style="margin-top: 10px; overflow-y: auto; max-height: 450px; ">
Hello gamers! </div>
<div id="ProfileButtons" style="margin: 10px auto; width: 313px;">
<div class="SendMessageProfileBtnDiv">
<a id="MessageButton" style="margin:0 5px" class="GrayButton " href="Send?id=<? echo $id ?>">Send Message</a>
</div>

