<?php
include "Header.php";
$c = mysql_query("SELECT * FROM `Report_User` ORDER BY id") or die (mysql_error());
$cc = mysql_num_rows($c);
if (isset($_GET['ignore'])){
	$id = $_GET['ignore'];
	mysql_query("DELETE FROM `Report_User` WHERE `Report_User`='$id'");
	die("Report ignored.");
}
?>
<h1>User Reports</h1><br />
<table width="70%">
<tr>
<td>
User Reported
</td>
<td>
Reporter
</td>
<td>
Reason
</td>
<td>
Comment
</td>
<td>
Actions
</td>
</tr>
<?php
$t = 0;
for ($count = 1; $count <= $cc; $count ++){
	if ($t == 0){	$t = 1;	}else{	$t = 0;	}
	$cr = mysql_fetch_array($c);
	$reporteeid = $cr['userid'];
	$reportee = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$reporteeid'"));
	$reporterid = $cr['reporterid'];
	$reporter = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$reporterid'"));
	?>
	<tr style="border: 1px solid black; background-color: #<?php if ($t == 0){ ?>FFF<?php }else{ ?>D5D5D5<?php } ?>; color: black;">
    <td>
    <a href="/Profile.php?id=<?php print_r($cr['userid']); ?>"><?php print_r($reportee['Username']); ?></a>
    </td>
    <td>
    <a href="/Profile.php?id=<?php print_r($cr['reporterid']); ?>"><?php print_r($reporter['Username']); ?></a>
    </td>
    <td>
    <?php
	print_r($cr['reason']);
	?>
	</td>
    <td>
    <?php
	print_r($cr['comment']);
	?>
	</td>
    <td>
    <a href="?ignore=<?php print_r($cr['id']); ?>">[Ignore]</a>
     | <a href="Ban.php?id=<?php print_r($reporteeid); ?>">[Take Action]</a>
     </td>
     </tr>
     <?php
}