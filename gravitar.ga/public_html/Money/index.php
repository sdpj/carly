<?php
include('../global.php');
if ($logged == false){
	die("You're not logged in!");
}
if ($user['Membership'] == '3'){
	?>
	<center>
    <table>
    <tr>
    <td>
    <center>
    <?php drawCharacter($uid); ?>
	</center>
    </td>
    <td>
    <h1>
    Oops, that looks like a premium feature!
    </h1>
    <br />
    Sorry but it looks like trade currency is a premium only feature. Why not <a href="/Upgrade/">purchase premium membership</a> today?
    </td>
    </tr>
    </table>
    </center>
    <?php
}else{
	if ($_GET['finished']){
	message("Success", "Your trade has completed.", "", "Okay", false, '');
}
	?>
	<center>
You have <font color="#FF6600"><?php print_r($user['Reebs']); ?> Gold Coins</font> and <font color="#009900"><?php print_r($user['Bucks']); ?> Bucks</font> to trade.</center><br /><br />
<table width="98%">
<tr><td width="100"><center>

</center>
</td>
<td>
<center>Trade Currency<br><br>
<form action="Count.php" method="get">
My Offer: <input name="offer" type="text">&nbsp;<select name="type"><option>Bucks</option><option>Gold Coins</option></select><br><input type="submit" id="buttonsmall" value="Trade" />
</form>
</center>
</td>
<td width="100">
<center>

</center>
</td>
</tr>
</table>
<?php
}
?>