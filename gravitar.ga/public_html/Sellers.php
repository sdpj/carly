<?php
include('global.php');
if ($_POST['name']){
	$name = mysql_real_escape_string($_POST['name']);
	$q = mysql_query("SELECT * FROM `shop` WHERE `Name`='$name' AND `islimited`='1' ORDER BY id");
}elseif ($_POST['creator']){
	$name = mysql_real_escape_string($_POST['creator']);
	$creatoridf = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `Username`='$name'"));
	$creatorid = $creatoridf['id'];
	$q = mysql_query("SELECT * FROM `shop` WHERE `creatorid`='$creatorid' AND `islimited`='1' ORDER BY id");
}elseif ($_POST['id']){
	$name = mysql_real_escape_string($_POST['id']);
	$q = mysql_query("SELECT * FROM `shop` WHERE `id`='$name' AND `islimited`='1' ORDER BY id");
}elseif ($_POST['price']){
	$name = mysql_real_escape_string($_POST['price']);
	$q = mysql_query("SELECT * FROM `shop` WHERE `price`='$name' AND `islimited`='1' ORDER BY id");
}else{
	$q = '0';
}
?>
<center>
<div style="border-radius: 10px; border: 1px solid #666; background-color: #D5D5D5; color: black; padding: 10px; text-align: center;">
<center><form action="" method="post">
<strong>Enter the name, id, creator or price of the item you want to view private sellers for.</strong><br />
<center><table><tr>
<td><input type="text" name="name" placeholder="Item Name.." /></td>
<td> or <input type="text" name="creator" placeholder="Creator Name.." /></td>
<td> or <input type="number" name="id" min="1" placeholder="ID" /></td>
<td> or <input type="number" name="price" placeholder="Price.." /></td>
</tr>
</table><br />
<input type="submit" value="Search!" />
</form>
</div>
</center><br /><br />
<table>
<tr>
<?php
if ($q != 0){
$qq = mysql_num_rows($q);
$t = 0;
for ($count = 1; $count <= $qq; $count ++){
	$qr = mysql_fetch_array($q);
	$t ++;
	$ceoid = $qr['creatorid'];
	$ceo = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$ceoid'"));
	?>
	<td style="border: 1px solid black; border-radius: 5px;">
    <center><a href="/Store/Item.php?id=<?php print_r($qr['id']); ?>">
    <img src="/assets/Avatars/<?php print_r($qr['path']); ?>" border="0" /><br />
    <?php print_r($qr['Name']); ?>
	<br />
    Creator: <?php print_r($ceo['Username']); ?><br />
    Price: <?php if ($qr['price'] == '0'){ echo("<font color='#FF9900'>" . $qr['reebprice'] . " Reebs</font>"); }else{ echo("<font color='#009900'>" . $qr['price'] . " Bucks</font>"); } ?><br />
    Private Sellers: <?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `seller` WHERE `itemid`='$qr[id]'"))); ?>
	</a>
    </center>
    </td>
    <?php
	if ($t == 8){
		echo "</tr><tr>";
		$t = 0;
	}
}
}
?>
</tr>
</table>
<?php
include "Footer.php";