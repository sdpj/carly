<?php

include "Header.php";


$getAllAccounts = mysql_query("SELECT * FROM Users");
$totalAccounts = mysql_num_rows($getAllAccounts);

$getStoreItems = mysql_query("SELECT * FROM Items");
$total = mysql_num_rows($getStoreItems);

$getAllUserItems = mysql_query("SELECT * FROM UserStore");
$totalUserItems = mysql_num_rows($getAllUserItems);

$getAllGroups = mysql_query("SELECT * FROM Groups");
$totalGroups = mysql_num_rows($getAllGroups);

echo "
<b>Firesplash Statistics</b>
<br /><br />

There are <b>$totalAccounts</b> accounts on Firesplash
<br />
<br />
There are <b>$total</b> items on Firesplash
<br />
<br />
There are <b>$totalUserItems</b> user items on Firesplash
<br /><br />
There are <b>$totalGroups</b> groups Firesplash
<br /><br />
<marquee>amou gus</marquee>
";
?>