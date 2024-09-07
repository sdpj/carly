<?php
include "Header.php";

	$getAll = mysql_query("SELECT * FROM Users");
		
		while ($gA = mysql_fetch_object($getAll)) {
		
			$Posts = mysql_num_rows($Posts = mysql_query("SELECT * FROM Threads WHERE PosterID='".$gA->ID."'")); $Replies = mysql_num_rows($Replies = mysql_query("SELECT * FROM Replies WHERE PosterID='".$gA->ID."'")); $Posts = $Posts+$Replies;
			
			if ($Posts >= 100) {
			echo $gA->Username." ($gA->ID)<br />";
			}
		
		}

?>