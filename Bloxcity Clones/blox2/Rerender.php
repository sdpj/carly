<?php include "Header.php";
  $allusers = mysql_query("SELECT * FROM Inventory WHERE UserID='$myU->ID' ORDER BY ID");
$num = mysql_num_rows($allusers);
$i = 0;
$Num = ($Page+8);
$a = 1;
$Log = 0;
$getConfig = mysql_query("SELECT * FROM Configuration");
$gC = mysql_fetch_object($getConfig);
if ($User)?>
<iframe src='/Avatar3D.php?ID=$myU->ID' style='position: absolute;width:100%;height:100%;border:100%;'></iframe>