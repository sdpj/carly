<?php
include('../global.php');
if ($_GET['id']){
	$unixtime = time();
	if ($logged == false){
		die("not logged in");
	}
						
	$id = mysql_real_escape_string($_GET['id']);
	$oldy = mysql_fetch_array(mysql_query("SELECT * FROM `forumthreads` WHERE `id`='$id'"));
	if ($oldy == '0'){
		die("...");
	}
	if ($oldy['locked'] == '1'){
		die("You cannot post on locked threads.");
	}
	$inid = $oldy['inid'];
	$forumin = mysql_fetch_array(mysql_query("SELECT * FROM `forumboards` WHERE `id`='$inid'"));
	?>
   <center> <a href="index.php">Gravitar Forums</a> &rarr; <a href="Forum.php?id=<?php print_r($oldy['inid']); ?>"><?php print_r($forumin['name']); ?></a> &rarr; <a href="Thread.php?id=<?php print_r($id); ?>"><?php print_r($oldy['subject']); ?></a> &rarr; <a href="#">Reply</a></center><br><br> 
<div style="width: 98%; padding: 7px; border: 0px solid black; background-color: #2D81BA; color: #2D81BA;">  
</div><br><br>
    <?php
	if ($user['Verified'] == '0'){
	?>
    Sorry, you need to be verified to post in our forums!<br />
    <a href="/Verify/">Click here to verify now!</a>
    <?php
}else{

	$ownerid = $user['id'];
	$ownernm = $user['Username'];
	if ($_POST['body']){
	if ($user['floodcheck'] == '0'){
	mysql_query("UPDATE `accounts` SET `floodcheck`='$unixtime' WHERE `id`='$uid'");
}
$canpost = false;
if (($unixtime - $user['floodcheck']) > 7){
$canpost = true;
}

if ($canpost == false){
	die("Floodcheck blocked your post. Sorry!");
}
$unixtime = time();
mysql_query("UPDATE `accounts` SET `floodcheck`='$unixtime' WHERE `id`='$uid'");
		$sig = $user['Signature'];
	$useSiggy = false;
	if ($_POST['siggy']){
		$useSiggy = true;
	}
	
	$body = (nl2br(strip_tags(mysql_real_escape_string($_POST['body']))));
	$filteredf = filterBadWords($body);
	$filtered = emoticons($filteredf);
	mysql_query("INSERT INTO `forumreplies` (`siggy`, `inid`, `authorid`, `body`) VALUES ('$sig', '$id', '$ownerid', '$filtered')") or die(mysql_error());
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
	mysql_query("UPDATE `forumthreads` SET `order`='$highval', `replies`=`replies`+'1', `lastposter`='$user[id]' WHERE `id`='$id'");
	mysql_query("UPDATE `accounts` SET `totalposts`=`totalposts`+'1' WHERE `id`='$ownerid'");
	die("Your reply was added. <br><br><a href=Thread.php?id=" . $id . ">Click here to go back</a>");
	}
	?>
	<form action="?id=<?php print_r($id); ?>" method="post">
    <textarea name="body" style="margin: 2px; width: 99%; height: 99px;"></textarea><br>
    <div style='float: right;'>Use Signature</div> <input type="checkbox" style='float: right;' name="siggy" checked><br><br>
     <input type="submit" style='float: right;' id="buttonsmall" value="Post Reply" /></div>
    <?php
}
}