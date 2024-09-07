<?php
include("../global.php");
$id = 0;
if ($_GET['id']){
	$id = mysql_real_escape_string($_GET['id']);
	if ($id < 1){
		die("That ID is invalid.");
	}
}else{
	die("No ID was given.");
}
$get = mysql_fetch_array(mysql_query("SELECT * FROM `shop` WHERE `id`='$id'"));
if ($get == 0){
	die("That item doesn't exist.");
}else{
if ($get['creatorid'] != $user['id']){
	die("ye havin' a bit of a giggle?");
}else{
echo "
<center><h2>Edit Item</h2></center>
<hr>
<br />
<br />
";
?>
<form action='' method='post'>
Change Name : <br /><input type='text' name='cname'><br /><br />
Change Bucks : <br /><input type='text' name='cbux'><br /><br />
Change Gold Coins : <br /><input type='text' name='creebs'><br /><br />
Change Description: <br /> <textarea type='text' name='cdesc'></textarea><br /><br />
 
<?php
if ($user['Membership'] == 1) {
?>

<?php
}
?>
<input type='submit' name='submit'><br /><br />
</form>
<?php
}
$cname = mysql_real_escape_string(stripslashes($_POST['cname']));
$cbux = mysql_real_escape_string($_POST['cbux']);
$cdesc = mysql_real_escape_string($_POST['cdesc']);
$creebs = mysql_real_escape_string($_POST['creebs']);
$submit = mysql_real_escape_string(stripslashes($_POST['submit']));

if ($submit) {
mysql_query("UPDATE shop SET Name='$cname' WHERE id='$id'");
mysql_query("UPDATE shop SET price='$cbux' WHERE id='$id'");
mysql_query("UPDATE shop SET description='$cdesc' WHERE id='$id'");
mysql_query("UPDATE shop SET reebprice='$creebs' WHERE id='$id'");
}elseif ($user['Membership'] == 1){

}
}