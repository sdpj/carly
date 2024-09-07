<?php

require_once("Header.php");


if ($myU->PowerAdmin != "true") {
header("Location: index.php"); exit();

}



$game = mysql_query("SELECT * FROM GameStatus WHERE ID='1'");
$Server = mysql_fetch_object($game);
$ingame = mysql_query("SELECT * FROM Users WHERE ingame='1'");
$total = mysql_num_rows($ingame);



echo "
<b>Avatar Hangout server settings</b>
<br /><br />
<b>Status:</b>"; if ($Server->Status == "true") {
echo" <font color='green'>Running</font>"; } else { echo"<font color='red'>Off</font>";
}


echo "
<br /><br />
<b>Users in server</b>:<font color='green'> $total </font>
<br />
<br />
<fieldset style='width:20%;'>
<legend>Server Controls</legend>

<form action='' method='post'>
<input type='submit' name='TurnOn' value='Turn On'>
<br />
<input type='submit'name='TurnOff' value='Turn Off'>
</form>
</fieldset>


";
$Activate = $_POST['TurnOn'];
$Deactivate = $_POST['TurnOff'];

if ($Activate) {
mysql_query("UPDATE GameStatus SET Status='true' WHERE ID='1'");
header("Location: $self");

}
if ($Deactivate) {
mysql_query("UPDATE GameStatus SET Status='false' WHERE ID='1'");
header("Location: $self");

}