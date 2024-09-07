<?php
$pagename = 'Home';
$pagelink = 'rhodum.xyz';
include('../header.php');
?>
<?php
if ($user) {
?>

<?php
} else {
?>
<div class="content-box" style="min-width:400px;width:400px;margin:0 auto;">
		<div class="signin-hold">
<?php
include('../api/user/sign_in_account.php');
?>
			<form method="post" class="sign-form basic-font">
<img src="https://cdn.discordapp.com/attachments/853212388807802910/926629163270565898/rhodum_2_logo.png" alt="Rhodum" width="350" height="350">
<p>&nbsp;</p>
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