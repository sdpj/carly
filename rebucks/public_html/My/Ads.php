<?php
include('../global.php');
if ($logged == false){
	die("You're not logged in!");
}
if ($_GET['run']){
	$id = mysql_real_escape_string($_GET['run']);
	$get = mysql_fetch_array(mysql_query("SELECT * FROM `ads` WHERE `id`='$id'"));
	if ($get == 0){
		die("That ad does not exist.");
	}
	if ($get['ownerid'] != $uid){
		die("That is not your advert.");
	}
	if ($_POST['caption'] && $_POST['bid']){
		$caption=mysql_real_escape_string($_POST['caption']);
		$bid  =mysql_real_escape_string($_POST['bid']);
		$end = time () + 24 * 60 * 60;
		mysql_query("UPDATE `accounts` SET `Bucks`=`Bucks`-'$bid' WHERE `id`='$uid'") or die(mysql_error());
		mysql_query("UPDATE `ads` SET `running`='1', `endunix`='$end' WHERE `id`='$id'") or die(mysql_error());
		die("Your ad is now running.");
	}
	?>
    <div style="width: 98%; padding: 12px; border: 1px solid #000; background-color: #D5D5D5; color: black;">
    <form action="?run=<?php print_r($id); ?>" method="post">
    <center>
    <img src="/assets/ads/<?php print_r($get['path']); ?>">
    </center><br>
    <table>
    <tr>
    <td>
    Caption
    </td>
    <td>
    <input name="caption" type="text" value="<?php print_r($get['caption']); ?>" />
    </td>
    </tr>
    <tr>
    <td>
    Bid (Bucks)
    </td>
    <td>
    <input type="text" name="bid" min="20" required="" />
    </td>
    </tr>
    </table>
    <br>
    <input type="submit" value="Run Ad" id="buttonsmall" />
    </form>
    </div>
    <?php
}else{
?>
<div style="width: 98%; padding: 12px; border: 1px solid #000; background-color: #D5D5D5; color: black;">
<table width="98%">
<?php
$chk = mysql_fetch_array(mysql_query("SELECT * FROM `ads` WHERE `ownerid`='$uid'"));
if ($chk == 0){
	echo "You do not have any ads currently running.";
}
$i = 0;
$c = mysql_query("SELECT * FROM `ads` WHERE `ownerid`='$uid' ORDER BY id DESC");
$cc = mysql_num_rows($c);
for ($count = 1; $count <= $cc; $count ++){
	$cr = mysql_fetch_array($c);
	if ($i == 0){	$i = 1;	}else{	$i = 0;	}
	?>
    <tr>
    <td style="background-color: #<?php if ($i == 0){ echo "FFF"; }else{	echo "D5D5D5";	}	?>; color: black; padding: 3px;">
    <table width="98%">
    <tr>
    <td width="50">
    <center>
    <img src="/assets/ads/<?php print_r($cr['path']); ?>" style="width: 350px; height: auto;" border="0" /><br />
    <?php
	print_r($cr['caption']);
	?>
    </center>
    </td>
    <td width="200">
    <img src="/assets/ads/<?php
	if ($cr['endunix'] < time()){
		echo "Stop";
	}else{
		echo "Running";
	} ?>.png" />
    </td>
    <td>
    <?php
	if ($cr['endunix'] < time()){
		?>
        <a href="?run=<?php print_r($cr['id']); ?>"><font color="red">Run Ad</font></a>
        <?php
	}else{
		?>
        <font color="green">Running</font>
        <?php
	}
	?>
    </td>
    <td>
    Total Clicks: <?php print_r($qr['clicks']); ?>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    <?php
}
?>
</div>
<?php
}