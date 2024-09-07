<?php
include('global.php');

if ($_GET['reactivate']){
	if (time() > $user['bannedUntil']){
		mysql_query("UPDATE `accounts` SET `banned`='0' WHERE `id`='$uid'");
		die("Your account has been reactivated. You can now go anywhere in the site.");
               
                
	}
}
?>

<center>
<div style="border: 5px solid black; background-color: white; padding: 6px; text-align: center;">
<h1><?php
if ($user['banned'] == '1'){
	echo "Warning";
}elseif ($user['banned'] == '2'){
	echo "Banned for 1 day";
}elseif ($user['banned'] == '3'){
	echo "Banned for 3 days";
}elseif ($user['banned'] == '4'){
	echo "Banned for 7 days";
}elseif ($user['banned'] == '5'){
	echo "Account Deleted";
} ?></h1><br>
Your account has been banned. If you think this is a false ban please email us.<br>
You have been banned for the following reason: <pre><?php print_r($user['bannedReason']); ?></pre><br><br>
You were moderated for the following content:<br>
<pre><?php print_r($user['bannedFor']); ?></pre><br><br>
You may re-activate your account on <?php echo date("Y-m-d H:i:s",$user['bannedUntil']);  ?>.<br><br>
<?php
if ($user['banned'] < 5){
if (time() >= $user['bannedUntil']){
	?>
	<a href="?reactivate=true" id="buttonsmall">Reactivate My Account</a>
    <?php

}else{
	?>
	Reactivate my Account
    <?php
}
}
?>
</div>

<script>
var audio = new Audio('http://puu.sh/fENah/8501fd943a.mp3');
audio.play();
</script>