<?php


include "Header.php";
$getStore = mysql_query("SELECT * FROM StoreStatus");
$gS = mysql_fetch_object($getStore);
$self = $_SERVER['PHP_SELF'];
$getStoreItems = mysql_query("SELECT * FROM Items");
$total = mysql_num_rows($getStoreItems);
if ($myU->PowerAdmin != "true") {
header("Location: index.php"); exit();
}

echo "
<b>Store Management</b>


<br /><br /><br />
Store is currently: "; if ($gS->Enabled == "true") { echo" <font color='green'>On</font>"; } else { echo"<font color='red'>Off</font>"; }  echo"<br /><br />
There are <b>$total</b> items in the store


<br /><br />
<fieldset width='30%'><legend>Options</legend>
<a href='?status=false'>Disable Purchases</a>
<br /><br />
<a href='?status=true'>Enable Purchases</a>
</fieldset>
";

$Status = $_GET['status'];


if ($Status == "false") { 
mysql_query("UPDATE StoreStatus SET Enabled='false' WHERE Enabled='true'");
header("Location: ../Administration/ManageStore.php"); exit();
}

if ($Status == "true") { 
mysql_query("UPDATE StoreStatus SET Enabled='true' WHERE Enabled='false'");
header("Location: ../Administration/ManageStore.php"); exit();
}




