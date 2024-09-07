<?php
include('../global.php');
if ($logged==false){
	die("you're not logged in!");
}
?>
<h1>My Forums</h1><br />
<h4>These are the past 30 threads you have created.</h4><br /><br />
<?php
$x = mysql_query("SELECT * FROM `forumthreads` WHERE `posterid`='$uid' ORDER BY `order` DESC LIMIT 1, 30");
$xx = mysql_num_rows($x);
$r = 0;
for ($count = 1; $count <= $xx; $count ++){
	$xr = mysql_fetch_array($x);
	if ($r == 0){	$r = 1; }else{	$r = 0;	}
	$starterid = $xr['posterid'];
	$starterarray = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$starterid'"));
	$lastposterid = $xr['lastposter'];
	$lastposterarray = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$lastposterid'"));
	?>
	<div style="width: 98%; padding: 7px; background-color: #<?php
	if ($r == 0){
		echo 'FFF';
	}else{
		echo 'D5D5D5';
	} ?>; color: black;">
    <table width="98%">
    <tr>
    <td width="40%">
    <a href="Thread.php?id=<?php print_r($xr['id']); ?>"><?php print_r($xr['subject']); ?></a>
    </td>
    <td>
    Starter: <a href="/Profile.php?id=<?php print_r($starterid); ?>"><?php print_r($starterarray['Username']); ?></a>
    </td>
    <td>
    Replies: <?php print_r($xr['replies']); ?>
	</td>
    <td>
    Last Poster: <a href="/Profile.php?id=<?php print_r($lastposterid); ?>"><?php print_r($lastposterarray['Username']); ?></a>
    </td>
    </tr>
    </table>
    </div>
    <?php
}
?><br><br>
<h4>Past 30 threads you have replied to coming soon!</h4>