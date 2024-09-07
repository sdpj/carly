<?php
include('../global.php');
if ($logged == false){
	die("You're not logged in!");
}
if ($_POST['subject'] && $_POST['body']){
	$subject = strip_tags(mysql_real_escape_string($_POST['subject']));
	$body    = strip_tags(mysql_real_escape_string($_POST['body']));
	if ($_GET['id']){
		$id = mysql_real_escape_string($_GET['id']);
	}else{
		die("No ID was specified!");
	}
	$attach = 0;
	if ($_GET['bucks'] && $user['Membership'] == '1'){
		$attach = $_GET['bucks'];
	}
	$doubleCheck = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$id'"));
	if ($doubleCheck == 0){
		die("That user doesn't exist!");
	}
	$toid = $id;
	mysql_query("INSERT INTO `messages` (`fromid`, `toid`, `subject`, `body`, `attachedBucks`) VALUES ('$uid', '$toid', '$subject', '$body', '$attach')") or die("An error occured, we're sorry!");
	mysql_query("UPDATE `accounts` SET `Bucks`=`Bucks`-'$attach' WHERE `id`='$uid'");
	die("Your message has been sent successfully!<br><br><a href='index.php' id='buttonsmall'>&laquo;Back to Inbox</a>");
}
$reply = false;
if ($_GET['id']){
	$id = mysql_real_escape_string($_GET['id']);
	$check = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$id'"));
	if ($check == 0){
		die("That user doesn't exist!");
	}
	$userName = $check['Username'];
}elseif ($_GET['reply']){
	$replyId = mysql_real_escape_string($_GET['reply']);
	$message = mysql_fetch_array(mysql_query("SELECT * FROM `messages` WHERE `id`='$replyId'"));
	if ($message == 0){
		die("You can't reply to this message!");
	}
	if ($message['toid'] != $uid){
		die("You can't reply to this message!");
	}
	$reply = true;
	$id = $message['fromid'];
	$get = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$id'"));
	$userName = $get['Username'];
}else{
	die("No ID specified!");
}
?>
<div style="width: 98%; background-color: white; color: black; letter-spacing: 1px; font-weight: 600; border: 1px solid black; padding: 5px; text-align: left; vertical-align: text-top;">
<form action="?id=<?php echo($id); ?>" method="post">
<input type="text" name="subject" <?php if ($reply == false){ ?>placeholder="Subject.."<?php }else{ ?>value="<?php print_r("RE: " . $message['subject']); } ?>" /><br><br>
<textarea name="body" style="margin: 2px; height: 269px; width: 1001px;" placeholder="Message here.."><?php if ($reply == true){ ?>







------------------------------------------------------------
Please remember that you should never send your password to ANYONE. No staff member will ask for your password.


<?php } ?></textarea>
<br><br>
<center>
<?php
if ($user['Membership'] == '1'){
	?>

    <?php
}else{
	?>
    Attaching currency is for membership users only!
    <?php
} ?><br><br>
<input type="submit" value="Send Message" id="buttonsmall" />
</center>
</form>
</div>