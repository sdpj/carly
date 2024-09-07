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
<h1>Login to <?=$sitename;?></h1>
<b>Username:</b> <input type="text" name="username" id="username" class="general-textarea" style="width:82%;">
<div style="height:15px;"></div>
<b>Password:</b> <input type="password" name="password" id="password" class="general-textarea" style="margin-left: 3px; width: 82%;">
<div style="height:15px;"></div>
<input type="submit" name="submit" class="btn-0-2-183 wearButton-0-2-189 continueButton-0-2-39" style="padding:0;padding:4px 8px;" value="Sign in">
			</form>
		</div>
<?php
}
?>
<style>
.continueButton-0-2-39 {
    width: 100%;
    border: 1px solid #084ea6;
    background: linear-gradient(0deg, rgba(8,79,192,1) 0%, rgba(5,103,234,1) 100%);
    padding-top: 5px;
    padding-bottom: 5px;
}
.btn-0-2-183 {
    color: white;
    border: 1px solid #357ebd;
    margin: 0 auto;
    display: block;
    padding: 1px 13px 3px 13px;
    font-size: 20px;
    text-align: center;
    font-weight: normal;
}
.continueButton-0-2-39:hover {
  background: linear-gradient(0deg, rgba(2,73,198,1) 0%, rgba(7,147,253,1) 100%); ;
}
</style>
</div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>
<?php
include('../footer.php');
?>