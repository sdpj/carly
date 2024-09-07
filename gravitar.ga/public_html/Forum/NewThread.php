<?php
include('../global.php');

if ($_GET['id']){
	
	$unixtime = time();
	$id = mysql_real_escape_string($_GET['id']); 
	$arr = mysql_fetch_array(mysql_query("SELECT * FROM `forumboards` WHERE `id`='$id'"));
	if ($arr == '0'){
		die("Sorry..");
	}
	?>
    <center><a href="index.php">Gravitar Forum</a> &rarr; <a href="Forum.php?id=<?php print_r($arr['id']); ?>"><?php print_r($arr['name']); ?></a> &rarr; <a href="#">New Thread</a><br /><center> 
<div style="width: 98%; padding: 7px; border: 0px solid black; background-color: #2D81BA; color: #2D81BA;">  
</div><br><br> 
<?php
if ($user['Verified'] == '0'){
	?>
    Sorry, you need to be verified to post in our forums!<br />
    <a href="/Verify/">Click here to verify now!</a>
    <?php
}else{
	if ($_POST['subject'] && $_POST['body']){
		if ($logged == true){
if ($user['floodcheck'] == '0'){
	mysql_query("UPDATE `accounts` SET `floodcheck`='$unixtime' WHERE `id`='$uid'");
}
$canpost = false;
if (($unixtime - $user['floodcheck']) > 7){
$canpost = true;
}

if ($canpost == false){
	die("Can you try reposting that in a little bit? This is to moderate spam.");
}
$unixtime = time();
mysql_query("UPDATE `accounts` SET `floodcheck`='$unixtime' WHERE `id`='$uid'");
	$subjd = strip_tags(mysql_real_escape_string($_POST['subject']));
	$subj = filterBadWords($subjd);
			$sig = $user['Signature'];
	$useSiggy = false;
	if ($_POST['siggy']){
		$useSiggy = true;
	}
	$bodys = strip_tags(nl2br(mysql_real_escape_string($_POST['body'])));
	$bodyf = filterBadWords($bodys);
	$body = emoticons($bodyf);
	if ($logged == true){
	$uid = $user['id'];
	$inid = $id;
	$islocked = 0;
	$isstuck = 0;
		if ($_POST['lock']){
			$islocked = 1;
		}
		if ($user['powerCM'] != '0' || $user['powerForumMod'] != '0' || $user['powerHeadMod'] != '0'){
			if ($_POST['stick']){
				$isstuck = 1;
			}
		}
			$highval = 0;
	$q = mysql_query("SELECT * FROM `forumthreads` ORDER BY id");
	$qq = mysql_num_rows($q);
	for ($count = 1; $count <= $qq; $count ++){
		$p = mysql_fetch_array($q);
		if ($p['order'] > $highval){
		$highval = $p['order'];
		}
	}
	$highval = $highval + 1;
		$nm = $user['Username'];
	mysql_query("INSERT INTO `forumthreads` (`siggy`, `order`, `inid`, `posterid`, `sticky`, `locked`, `subject`, `body`, `lastposter`) VALUES ('$sig', '$highval', '$inid', '$uid', '$isstuck', '$islocked', '$subj', '$body', '$nm')") or die(mysql_error());
	mysql_query("UPDATE `accounts` SET `totalposts`=`totalposts`+'1' WHERE `Username`='$nm'") or die(mysql_error());
	mysql_query("UPDATE `forumboards` SET `totalposts`=`totalposts`+'1' WHERE `id`='$inid'");
?>
<br />
<?php
        die("Your thread has been successfully posted!");
	}
	}
	}
	?>
<br />
<div style="width: 98%; overflow: auto; background-color: #F0F0F0; border: 1px solid #D9D9D9; padding: 7px; text-align: left; border-radius: 5px;">
<form action="?id=<?php print_r($id); ?>" method="post">
Subject: <input name="subject" type="text" size="100" /><br>
<textarea name="body" style="margin: 2px; width: 99%; height: 151px;"></textarea><br>
<table ><tr><td>Lock <input type="checkbox" name="lock"></td><td>
Use Signature <input type="checkbox" name="siggy" checked></td>
<?php if ($logged == true){ if ($user['powerCM'] != '0' || $user['powerForumMod'] != '0' || $user['powerHeadMod'] != '0'){ ?><td>Sticky <input type="checkbox" name="stick"></td><?php } } ?></tr></table><br /><br />
<input type="submit" style='float: right;' value="Post" id="buttonsmall"/><br>
</form>
<h5><font color="red">Please make sure you read over the forum's rules before making a post.</font></h5>
</div>
<?php
}
}
include "../Footer.php";	