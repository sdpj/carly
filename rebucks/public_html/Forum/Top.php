<?php
include "../global.php";
if ($_GET['num']){
	$num=mysql_real_escape_string($_GET['num']);
}else{
	$num = 10;
}
?>
<center>
<h1>Top <?php print_r($num); ?> Posters</h1><br>
<form action="" method="get">
<input type="text" name="num" placeholder="Amount to Display" value="<?php print_r($num); ?>" />&nbsp;&nbsp;<input type="submit" value="Go!" id="buttonsmall" />
</form>
</center><br />
<?php
$c = mysql_query("SELECT * FROM `accounts` ORDER BY `totalposts` DESC LIMIT 0, $num");
$cc = mysql_num_rows($c);
for ($count = 1; $count <= $cc; $count ++){
	$cr = mysql_fetch_array($c);
	print_r($count . ". <b>" . $cr['Username'] . "</b> with <b>" . $cr['totalposts'] . " posts</b><br><br>");
}