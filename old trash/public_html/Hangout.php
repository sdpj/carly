<?php

require_once("Header.php");

$getOnline = mysql_query("SELECT * FROM Users WHERE ingame='1'");
$Online = mysql_num_rows($getOnline);
$getVisits = mysql_query("SELECT * FROM Game");
$Visits = mysql_fetch_object($getVisits);
//if (!$User) {
//header("Location: index.php"); exit();
//}



echo "
<br />
<b>Current Active Servers</b>
<div style='padding:10;'>


<br />
<br />


<div style='border:1px solid lightgrey;border-radius:3px;width:20%;padding:5px;'>
<center>
<a href='../world/game.php'>Avatar Street</a>
<br /><font color='green'>$Online playing</font>
<br />
Visits: $Visits->Visits
</center>
</div>
<br />
<div style='border:1px solid lightgrey;border-radius:3px;width:20%;padding:5px;'>
<b>Description</b><br /><br />
Come here to hangout and talk or trade items with other users.
</div>


</div>
";


