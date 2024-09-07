<?php
include('../global.php');
if ($_GET['id']){
	$id = mysql_real_escape_string($_GET['id']);
	$thread = mysql_fetch_array(mysql_query("SELECT * FROM `forumboards` WHERE `id`='$id'"));
	$checkExistt = mysql_fetch_array(mysql_query("SELECT * FROM `forumboards` WHERE `id`='$id'")) or die(mysql_error());
	if ($checkExistt == '0'){
		die("This forum doesn't exist!");
	}
?>

<a href="index.php">Avatar Central Forums</a> &rarr; <a href="?id=<?php print_r($id); ?>"><?php print_r($thread['name']); ?></a>
<br /><br />
<a href="NewThread.php?id=<?php print_r($id); ?>" id="buttonsmall">New Thread</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="MyForums.php" id="buttonsmall">My Forums</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="Top.php" id="buttonsmall" bottom-padding: 10px;>Top Posters</a><br>
<br />
<div style="width: 98%; overflow-y:hidden; max-width: 98%; height: 30px; background-color: #2D81BA; border 5px solid #; color: white;"><table width="98%">
<tr>
<td width="50%">
Thread Subject
</td>
<td width="15%" style="text-align: right;">
Starter
</td>
<td width="15%" style="text-align: right;">
Last Poster
</td>
<td width="15%" style="text-align: right;">
Replies
</td>
</tr></table>
</div>
<div style="width: 98%; border: 0px solid #333;">

<?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start_from = ($page-1) * 35; 
$pr = mysql_query("SELECT * FROM `forumthreads` WHERE `inid`='$id' AND `sticky`='1' ORDER BY `order` DESC LIMIT $start_from, 35");
$ppr = mysql_num_rows($pr);
for ($countr = 1; $countr <= $ppr; $countr ++){
	$ir = mysql_fetch_array($pr);
	$posterid = $ir['posterid'];
	$postearray = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$posterid'"));
	?>
    <table width="98%">
    <tr><td width="50%" style="color: red; font-weight: 600; padding: 5px; height: 25px; border-bottom: 0px solid #999; font-size: 13px;"><img src="/assets/Forum/thread_pinned.png" border="0" align="left" />&nbsp;&nbsp;&nbsp;&nbsp;<a href="Thread.php?id=<?php print_r($ir['id']); ?>">
	<?php print_r($ir['subject']); ?></a><br /></td><td style="text-align: right; padding: 5px; height: 25px; border-bottom: 0px solid #999; font-size: 13px;" width="15%"><a href="/Profile.php?id=<?php print_r($ir['posterid']); ?>"><?php print_r($postearray['Username']); ?></a></td><td width="15%" style="padding: 5px; height: 25px; border-bottom: 0px solid #999; font-size: 13px;text-align: right;"><?php
	$lastposter = $i['lastposter'];
	$lastposterarray = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$lastposter'"));
	?>
    <a href="/Profile.php?id=<?php print_r($lastposter); ?>"><?php print_r($lastposterarray['Username']); ?></a>
    </td>
    <td width="15%" style="text-align: right; padding: 5px; height: 25px; border-bottom: 0px solid #999; font-size: 13px;">
    <?php 
	$num = mysql_num_rows(mysql_query("SELECT * FROM `forumreplies` WHERE `inid`='$ir[id]' ORDER BY id"));
	if ($num == '0'){
		print_r("No Replies");
	}else{
		print_r($num);
	}
	?>
    </td>
		
	</tr></table>
    <?php
}
?>
<?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start_from = ($page-1) * 35; 
$p = mysql_query("SELECT * FROM `forumthreads` WHERE `inid`='$id' AND `sticky`='0' ORDER BY `order` DESC LIMIT $start_from, 35");
$pp = mysql_num_rows($p);
for ($count = 1; $count <= $pp; $count ++){
	$i = mysql_fetch_array($p);
	$posterid = $i['posterid'];
	$postearray = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$posterid'"));
	?>
    <table width="98%">
    <tr><td width="50%" style="padding: 5px; height: 25px; border-bottom: 0px solid #999; font-size: 13px;"><img src="/assets/Forum/thread_<?php
    if ($i['locked'] == '1'){
	print_r("locked");
	}else{
		print_r("regular");
	} ?>.png" border="0" align="left" />&nbsp;&nbsp;&nbsp;&nbsp;<a href="Thread.php?id=<?php print_r($i['id']); ?>">
	<?php
	if ($id == '4'){
		
		if ($i['status'] == '0'){
			?>
            <img src="/assets/none.png" title="This suggestion is yet to be reviewed." align="left" border="0"/>
            <?php
		}elseif ($i['status'] == '1'){
			?>
            <img src="/assets/wip.png" title="Suggestion Being Created" align="left" border="0"/>
            <?php
		}elseif ($i['status'] == '2'){
			?>
            <img src="/assets/done.png" align="left" title="Suggestion Created" border="0"/>
            <?php
		}elseif ($i['status'] == '3'){
			?>
            <img src="/assets/rejected.png" align="left" title="Rejected Suggestion" border="0"/>
            <?php
		}
	}
	?>
	<?php print_r($i['subject']); ?></a></td><td style="text-align: right;padding: 5px; height: 25px; border-bottom: 0px solid #999; font-size: 13px;" width="15%"><a href="/Profile.php?id=<?php print_r($i['posterid']); ?>"><?php print_r($postearray['Username']); ?></a></td>
    <td width="15%" style="text-align: right;padding: 5px; height: 25px; border-bottom: 0px solid #999; font-size: 13px;">
    <?php
	$lastposter = $i['lastposter'];
	$lastposterarray = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$lastposter'"));
	?>
    <a href="/Profile.php?id=<?php print_r($lastposter); ?>"><?php print_r($lastposterarray['Username']); ?></a>
    </td>
    <td width="15%" style="text-align: right;padding: 5px; height: 25px; border-bottom: 0px solid #999; font-size: 13px;"><?php if ($i['replies'] == '0'){ print_r("No Replies"); }else{ print_r($i['replies']); } ?></td>
	
	</tr></table>
    <?php
}
	?>
    
    </div>
    <?php	$sql = "SELECT COUNT(id) FROM forumthreads WHERE `inid`='$id'"; 
$rs_result = mysql_query($sql,$con); 
$row = mysql_fetch_row($rs_result); 
$total_records = $row[0]; 
$total_pages = ceil($total_records / 35); 
?></table><br /><br /><?php
if ($page > 1){
	?>
    <a href="?id=<?php print_r($id); ?>&page=<?php print_r($page - 1); ?>" id="buttonsmall">Back</a>
    <?php
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;Page <?php print_r($page); ?> of <?php print_r($total_pages); ?>
<?php
if ($page < $total_pages){
	?>
	&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="?id=<?php print_r($id); ?>&page=<?php print_r($page + 1); ?>" id="buttonsmall">Next</a>
    <?php
}
}