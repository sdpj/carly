<?php include($_SERVER['DOCUMENT_ROOT'].'/Site/init.php'); error_reporting(0); ?>

<head>
<title><?php echo $name;?> | Home</title>
<link rel="shortcut icon" type="image/png" href="/img/logo.png">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo $name;?>! Socialize with friends, play games and customize your character. Create an account for free and explore the older versions of an amazing game!">
<meta name="keywords" content="Old Roblox, <?php echo $name;?>, XDiscuss, Socialize, Games, Forum, Character customisation, Rhodum, FinalB">
<meta name="author" content="<?php echo $name;?>">
<script type="text/javascript" async="" src="/Style/javascript.js"></script>
<script src="https://kit.fontawesome.com/fe2bf6e013.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="/Style/head.css">
<link rel="stylesheet" href="/Style/default.css">
<link type="text/css" rel="stylesheet" href="/Style/font-awesome.min.css"/>
</head>
<style>nav {
    background: #600e74;
    background: linear-gradient(
90deg
 ,#600e74,#fe00b0);
    border: 0;
}</style>
<nav style="box-shadow:none;" class="main-nav">
<div class="nav-wrapper">
<a href="/" class="brand-logo">
<img src="/img/logo.png" height="50" style="margin-top:5px;margin-left:8px;">
</a>
<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
<ul class="left hide-on-med-and-down" style="margin-left:65px;">
  <li><a href="/Games" style="font-size:16px;color:white;"><i class="fas fa-gamepad" aria-hidden="true" style="font-size:17px;"></i> Games</a></li>
  <li><a href="/Forum" style="font-size:16px;color:white;"><i class="fas fa-bullhorn" aria-hidden="true" style="font-size:17px;"></i> Forum</a></li>
  <li><a href="/Groups" style="font-size:16px;color:white;"><i class="fas fa-users" aria-hidden="true" style="font-size:17px;"></i> Groups</a></li>
  <li><a href="/Market" style="font-size:16px;color:white;"><i class="fas fa-store" aria-hidden="true" style="font-size:17px;"></i> Catalog</a></li>
  <li><a href="/Players" style="font-size:16px;color:white;"><i class="fas fa-user-friends" aria-hidden="true" style="font-size:17px;"></i> Users</a></li>
</ul>
<ul class="right hide-on-med-and-down">

<?php
if (!$user) {
?>
<li><a href="/Login" style="color:white;">Login</a></li>
<li><a href="/Register" style="color:white;">Register</a></li>
<? } else { ?>
<li>
<a href="/Personal/Messages" style="color:white;" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="1 Messages" style="font-size:16px;" data-tooltip-id="b4aea4cd-79e2-33cf-80fc-c81f4ef2427e"><i class="material-icons left" style="font-size:15px;margin-right:6px;">message</i><?php echo "$myu->messages"; ?></a>
</li>
<li>
<a href="/Personal/Friends" style="color:white;" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="0 Friend Requests" style="font-size:16px;" data-tooltip-id="9b5a7655-dced-578a-7931-0b85e9bab83f"><i class="material-icons left" style="font-size:15px;margin-right:6px;margin-top:-1px;">person_add</i><?php echo "$myu->requests"; ?></a>
</li>
<li>
<a href="/Personal/Trades" style="color:white;" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="0 Trades" style="font-size:16px;" data-tooltip-id="efaa0fa2-5db1-ee27-4561-198cf507ce09"><i class="material-icons left" style="font-size:18px;margin-right:6px;margin-top:-1px;">swap_vert</i><?php echo "$myu->trades"; ?></a>
</li>
<li>
<a href="/Personal/Money" style="color:white;font-size:16px;" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Posties" data-tooltip-id="20c7f21f-cf71-b7fa-6a38-adc331a4e85a">
<i class="material-icons left" style="font-size:14px;margin-right:6px;margin-top:-1px;">monetization_on</i><?php echo "$myu->emeralds"; ?>
</a>
</li>
<li>


<li><a href="/Customize" style="font-size:16px;color:white;"><?php echo "$user";?></a></li>
</li>
<?php } ?>

<ul class="right hide-on-med-and-down">
<?php
if (!$user) {
?>
<li><a href="/user/logout.php"><?php echo "$user"; ?></a></li>
<? } ?>
<ul class="side-nav" id="mobile-demo" style="transform: translateX(-100%);">
<li><a href="/Games/">Games</a></li>
<li><a href="/Market/">Market</a></li>
<li><a href="/Players">Users</a></li>
<li><a href="/Groups">Groups</a></li>
<li><a href="/Forum">Forum</a></li>
<li><a href="/Upgrades">Upgrade</a></li>
<li><a href="/Blog">Blog</a></li>
</div>
</nav>
      </ul>
    </div>
<?php
if ($user) {
?>
</div>
<? } ?>
<div style="padding-top:85px;"></div>