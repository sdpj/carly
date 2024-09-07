<center>
<?php

	include "../EpicClubRebootMisc/header.php";
	
	$getStaff = mysql_query("SELECT * FROM ec_users WHERE POWER='FOUNDER' OR POWER='CO-FOUNDER' OR POWER='ADMIN' OR POWER='MOD'");
	
	while ($gS = mysql_fetch_object($getStaff)) {
	echo $gS->Username . "<br />";
	}

?>
</center>