<?php include($_SERVER['DOCUMENT_ROOT'].'/Site/init.php'); // error_reporting(0); ?>

<? if (!$user) { header("Location: /auth/home"); } ?>

<head>
    <meta charset="UTF-8">
    <!--<title><?if($title){echo $title;}else{echo $sitename;}?></title>-->
    <link rel="stylesheet" type="text/css" href="/2005/Roblox.css">
</head>

<table cellspacing="0" cellpadding="0" width="950">
  <tbody><tr>
    <td style="BORDER-RIGHT: black 1px solid; PADDING-RIGHT: 8px; PADDING-LEFT: 8px; PADDING-BOTTOM: 8px; PADDING-TOP: 8px" bgcolor="lightsteelblue" colspan="2" class="Header">
      <span id="_ctl0_Span1" style="PADDING-RIGHT: 4px; FLOAT: left; TEXT-ALIGN: left" class="Header">
            <img  src="/auth/logo.png"  alt="" width="118" height="21"  />
      </span>
      <span id="_ctl0_LabelSlogan" class="Header"><?=$motto;?>&trade;</span><span style="PADDING-RIGHT: 4px; FLOAT: right; TEXT-ALIGN: right" class="Header">

<? if($user){?>
      Welcome, <?=$myu->username;?>&nbsp;|&nbsp;<font color="blue">RP</font>&nbsp;:&nbsp;<?=$myu->emeralds;?>      
<?}?>

            </span></td>
  </tr>
  <tr>
    <td valign="top" width="118">
      <div style="BORDER-RIGHT: black 1px solid; PADDING-RIGHT: 8px; PADDING-LEFT: 8px; PADDING-BOTTOM: 8px; PADDING-TOP: 0px; BORDER-BOTTOM: black 1px solid; BACKGROUND-COLOR: lightsteelblue">
        <a id="_ctl0_HyperlinkHome" class="MenuItem" href="/2005/default.aspx">Home</a><br>
        <a id="_ctl0_HyperLinkBuild" class="MenuItem" href="/2005/Build.aspx">Build!</a><br>
        <a id="_ctl0_Hyperlink12" class="MenuItem" href="/2005/levels.aspx">Games</a><br>
        <a id="_ctl0_HyperLink9" class="MenuItem" href="/2005/Models.aspx">Models</a><br>
        <a id="_ctl0_Hyperlink3" class="MenuItem" href="/2005/Contests/Default.aspx">Contests</a><br>
        <a id="_ctl0_Hyperlink6" class="MenuItem" href="/2005/My/Default.aspx">My Stuff</a><br>
        <a id="_ctl0_HyperLink10" class="MenuItem" href="/2005/Community.aspx">People</a><br>
        <a id="_ctl0_HyperLink11" class="MenuItem" href="/2005/Forum/default.aspx">Forum</a><br>
        <table id="_ctl0_PanelSignIn" cellpadding="0" cellspacing="0" border="0" width="100%"><tbody><tr><td>
          <a id="_ctl0_Hyperlink8" class="MenuItem" href="/auth/login">Sign In</a>
          <br>
</td></tr></tbody></table><table id="_ctl0_PanelSignOut" cellpadding="0" cellspacing="0" border="0" width="100%"><tbody><tr><td>
          <a id="_ctl0_HyperLinkSignOut" class="MenuItem" href="/user/logout.php">Sign Out</a>
          <br>
        
</td></tr></tbody></table>
        <a id="_ctl0_Hyperlink2" class="MenuItem" href="/Help/Default.aspx">FAQ</a>
        <br>
        <br>
<span style="WIDTH: 112px; PADDING-TOP: 1em">
          <table id="_ctl0_TopPointHolders1_DataList1" cellspacing="0" cellpadding="3" rules="rows" bordercolor="#E7E7FF" border="1" bgcolor="White" width="100%">
  <tbody><tr>
    <td bgcolor="#4A3C8C"><font color="#F7F7F7"><b>
    Top <?=$sitename;?> Points Holders</b></font></td>
<style>
.pointsworkaround:nth-child(even) {background: #E7E7FF}
.pointsworkaround:nth-child(odd) {background: #F7F7F7}
</style>
<?php
$getUsers = mysql_query("SELECT * FROM users ORDER BY emeralds DESC LIMIT 10");
while($gUsers = mysql_fetch_object($getUsers)){?>
<tr class="pointsworkaround"><td><font color='#4A3C8C'><span style='FLOAT: left'><a href='/2005/user.aspx?id=<?=$gUsers->id;?>'><?=$gUsers->username;?></a></span><span style='FLOAT: right'><span><?=$gUsers->emeralds;?></span></span></font></td></tr>
<?}?>
</tbody></table></span>
                </div>
    </td>
    <td style="BORDER-TOP: black 1px solid; PADDING-LEFT: 8px; PADDING-TOP: 8px; height: 675; display: block;">