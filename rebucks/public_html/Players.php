<?php
include('global.php');
$q = mysql_query("SELECT * FROM `accounts` ORDER BY id");
$qq = mysql_num_rows($q);
for ($count = 1; $count <= $qq; $count ++){
	$qr = mysql_fetch_array($q);
	if (checkUserOnline($qr['id']) == true){
		$id = $qr['id'];
		mysql_query("UPDATE `accounts` SET `online`='1' WHERE `id`='$id'");
	}else{
		$id = $qr['id'];
		mysql_query("UPDATE `accounts` SET `online`='0' WHERE `id`='$id'");
	}
}
$page = 1;
if ($_GET['page']){
	$page = mysql_real_escape_string($_GET['page']);
}
if ($page > 1){
	$start = (($page - 1) * 16);
}else{
	$start = 0;
}
if ($_GET['q']){
	$search = mysql_real_escape_string($_GET['q']);
	$q = mysql_query("SELECT * FROM `accounts` WHERE `Username`='$search'");
}elseif ($_GET['online']){
	$q = mysql_query("SELECT * FROM `accounts` WHERE `online`='1' ORDER BY id ASC LIMIT $start, 16");
}else{
	if ($_GET['view']){
		$view = mysql_real_escape_string($_GET['view']);
		if ($view == 'online'){
	$q = mysql_query("SELECT * FROM `accounts` WHERE `online`='1' ORDER BY id ASC LIMIT $start, 16") or die(mysql_error());
		}elseif ($view == 'staffonline'){
	$q = mysql_query("SELECT * FROM `accounts` WHERE `online`='1' AND `powerForumMod`='1' OR `powerHeadMod`='1' OR `powerCM`='1' OR `powerArtist`='1' OR `powerAdmin`='1' OR `powerImageMod`='1' ORDER BY id LIMIT $start, 16") or die(mysql_error());
		}else{
	$q = mysql_query("SELECT * FROM `accounts` ORDER BY id ASC LIMIT $start, 16") or die(mysql_error());
		}
	}else{
	$q = mysql_query("SELECT * FROM `accounts` ORDER BY id ASC LIMIT $start, 16") or die(mysql_error());
	}		
}
$qq = mysql_num_rows($q);
$c = 0;
?>
<center>
<form action="" method="get">
<fieldset>
<legend>Search</legend>
<input type="text" name="q" placeholder="Username..." /><input type="submit" value="Search" id="buttonsmall" />
</fieldset>
</form><br>
<a href="?view=staffonline"><font face=Arial><strong><font color=Green>Staff Members</font></strong>: <?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `accounts` WHERE `online`='1' AND `powerForumMod`='1' OR `powerHeadMod`='1' OR `powerCM`='1' OR `powerArtist`='1' OR `powerAdmin`='1' OR `powerImageMod`='1' ORDER BY id"))); ?></a> | <a href="?view=online"><font face=Arial><strong><font color=Green>Users Online: </font></strong><?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `accounts` WHERE `online`='1' ORDER BY id"))); ?></a> | <font color=Green>Total Members: <?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `accounts` ORDER BY id"))); ?></font>
<table><tr>
<?php
for ($count = 1; $count <= $qq; $count ++){
	$qr = mysql_fetch_array($q);
	$c ++;
	?>
	<td style="width: 125px; border: 1px solid #333; background-color: #FFFFFF; color: black; text-align: center;"><center>
    <?php
	drawCharacter($qr['id'], 100, 190);
	?><br>
    <a href="Profile.php?id=<?php print_r($qr['id']); ?>"><?php print_r($qr['Username']); ?></a><br>
    <?php
	if (checkUserOnline($qr['id']) == true){
		?>
		<font color="#009900" size="1">Online</font>
        <?php
	}else{
		?>
		<font color="#CC0000" size="1">Offline</font>
        <?php
	}
	?>
	</center></td>
    <?php
	if ($c == 8){
		echo "</tr><tr>";
		$c = 0;
	}
}
?>
</tr></table></center>
<br><br><center>
<?php
$sql = "SELECT COUNT(id) FROM accounts WHERE `banned`='0' "; 
$rs_result = mysql_query($sql,$con); 
$row = mysql_fetch_row($rs_result); 
$total_records = $row[0]; 
$total_pages = ceil($total_records / 14);
if ($page > 1){
	?>
    <a href="?page=<?php print_r($page - 1); ?>" id="buttonsmall">Previous</a>
    <?php
}
?>
&nbsp;&nbsp;Page <?php print_r($page); ?> of <?php print_r($total_pages); ?>&nbsp;&nbsp;
<?php
if ($total_pages > $page){
	?>
	<a href="?page=<?php print_r($page + 1); ?>" id="buttonsmall">Next</a>
    <?php
}
include('Footer.php');