<?php include('connection.php'); error_reporting(0); ?>

<head>
<title>BloxBuild | Home</title>
<link rel="shortcut icon" type="image/png" href="/NewLogo.png">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<script type="text/javascript" async="" src="/Style/javascript.js"></script>
<link rel="stylesheet" href="/Style/default.css">
<link rel="stylesheet" href="/Style/style.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<nav style="box-shadow:none;" class="main-nav">
<div class="nav-wrapper light-blue darken-2"">
<a href="/" class="brand-logo">
<img src="/Blox-Build-Assets/BrandLogo.png" height="50" style="margin-top:5px;margin-left:8px;">
</a>
<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
<ul class="left hide-on-med-and-down" style="margin-left:65px;">
<li><a href="/" style="font-size:16px;">Home</a></li>
<li><a href="/Market" style="font-size:16px;">Market</a></li>
<li><a href="/Forum" style="font-size:16px;">Forum</a></li>
</ul>
<ul class="right hide-on-med-and-down">

<?php
if (!$User) {
?>
<li><a href="/Login">Login</a></li>
<li><a href="/Register">Register</a></li>
<? } else { ?>
<i class="material-icons left" style="font-size:14px;margin-right:6px;margin-top:-1px;">monetization_on</i><?php echo "$Bux Cash"; ?>
</a>
</li>
<li>


<li><a href="/" style="font-size:16px;"><?php echo "$User";?></a></li>
</li>
<?php } ?>

<ul class="right hide-on-med-and-down">
<?php
if (!$User) {
?>
<li><a href="/Logout.php"><?php echo "$User"; ?></a></li>
<? } ?>
			</ul>
		</div>
<?php
if ($user) {
?>

</div>
<? } ?>
<div style="padding-top:85px;"></div>