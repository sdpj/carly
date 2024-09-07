<?php
error_reporting(0);
$con = mysql_pconnect("localhost", "avatarce_user", "bradybear1298") or die("Something went wrong while connecting to the database - ID: 1");
mysql_select_db("avatarce_database", $con) or die("Something went wrong while connecting to the database - ID: 2");
		?>