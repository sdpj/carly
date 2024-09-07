<?php
$pagename = 'Home';
$pagelink = 'www.dimensious.com';
include('../header.php');
?>
<?php
if ($user) {
?>
<h2>Welcome, <?php echo "$user"; ?></h2>
</center><div class="col s12 m9 l8">
<div class="container" style="width:100%;">
<div class="row">
<div class="col s12 m12 l3">
<div class="content-box">
<center><? echo "
<img src='../Market/Storage/".$myu->body."' width='182' height='182'>
"; ?></center>
</div>
<div style="height:25px;"></div>
<div class="header-text" style="font-size:18px;">Blog</div>
<div class="content-box">

</div>
</div>
<div class="col s12 m12 l9">
<div class="content-box">
<form action="" method="post">
<input type="text" name="status" id="status" class="general-textbar" placeholder="What's up?">
<input type="hidden" name="csrf_token" value="/pAzDRYIxP4I5R+7Ghdg7buhF06UtFcrIZQ/gczlnt4=">
</form>
</div>
<div style="height:25px;"></div>
<div class="header-text" style="font-size:18px;">Feed</div>
<div style="border-bottom:1px solid #DDDDDD;"></div>










<div class="content-box" style="border:0;border:1px solid #DDDDDD;border-radius:0;border-top:0;padding:0;padding:0 15px;">
<table cellspacing="0" cellpadding="0" style="margin:0;padding:0;">
<tbody>
<tr>
<td width="13%" class="center-align">
<a href="/Profile/?id=2"><center><div style="width:50px;height:50px;border:1px solid #eee;overflow:hidden;" class="circle"><img src="/Market/Storage/Nicholas.png" width="100" style="margin-left:-25px;"></div></center></a>
<a href="/Profile/?id=2" style="padding-top:5px;display:inline-block;font-size:12px;">nicholas</a>
</td>
<td width="87%" style="padding-left:15px;font-size:14px;color:#555555;">
Updated their status to "hi there."
<div style="color:#888888;font-size:12px;padding-top:5px;"><i class="material-icons" style="font-size:14px;">access_time</i> 1 day ago</div>
</td>
</tr>
</tbody>
</table>
</div>
<div class="content-box" style="border:0;border:1px solid #DDDDDD;border-radius:0;border-top:0;padding:0;padding:0 15px;">
<table cellspacing="0" cellpadding="0" style="margin:0;padding:0;">
<tbody>
<tr>
<td width="13%" class="center-align">
<a href="/Profile/?id=1"><center><div style="width:50px;height:50px;border:1px solid #eee;overflow:hidden;" class="circle"><img src="/Market/Storage/Creator.png" width="100" style="margin-left:-25px;"></div></center></a>
<a href="/Profile/?id=1" style="padding-top:5px;display:inline-block;font-size:12px;">Creator</a>
</td>
<td width="87%" style="padding-left:15px;font-size:14px;color:#555555;">
Updated their status to "Hello, welcome to BloxCreate, I am the founder of this wonderful establishment. If you need any help, please contact support@bloxcreate.site"
<div style="color:#888888;font-size:12px;padding-top:5px;"><i class="material-icons" style="font-size:14px;">access_time</i> 3 days ago</div>
</td>
</tr>
</tbody>
</table>
</div>
<div class="content-box" style="border:0;border:1px solid #DDDDDD;border-radius:0;border-top:0;padding:0;padding:0 15px;">

</div>


</div>
</div>
</div>
</div>
<?php
} else {
?>
<div class="content-box" style="min-width:400px;width:400px;margin:0 auto;">
		<div class="signin-hold">
<?php
include('../api/user/sign_in_account.php');
?>
			<form method="post" class="sign-form basic-font">
<h5 style="padding:0;margin:0;padding-bottom:25px;">Log in</h5>
<input type="text" name="username" id="username" class="general-textarea" placeholder="Username">
<div style="height:15px;"></div>
<input type="password" name="password" id="password" class="general-textarea" placeholder="Password">
<div style="height:15px;"></div>
<input type="submit" name="submit" class="groups-blue-button" style="padding:0;padding:4px 8px;" value="Log in">
			</form>
		</div>
<?php
}
?>
<?php
include('footer.php');
?>