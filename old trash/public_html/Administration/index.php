<?php
	include "Header.php";

	$getLogs = mysql_query("SELECT * FROM Logs ORDER BY ID DESC LIMIT 9");
	if ($myU->PowerMegaModerator == "true"||$myU->PowerAdmin == "true") {
	echo"
	
	<font size='3'>Firesplash Admin center</font><br /><br />
	<b>Recent Logs</b><br /><br />";
	echo"<table width='900'>
	<tr>
	<td width='300'>
	<b>Username</b>
	</td>
	<td width='600'>
<b>	Text</b>
	</td>
	</tr>
	</table><br />";
	while ($gL = mysql_fetch_object($getLogs)) {
	$getUser = mysql_query("SELECT * FROM Users WHERE ID='$gL->UserID'");
	$gU = mysql_fetch_object($getUser);
	echo "
	
	<div style='border:2px solid white;background-color:pink;padding-bottom:0px;'><br />
	<table width='900'>
	<tr>
<td width='300'>
<b><a href='ManageUser.php?ID=$gU->ID'>$gU->Username</b></a>
</td>
<td width='600'>
<font color='red'>$gU->IP</font>: $gL->Message
</td>
</tr>
</table>


	
	<br /></div>";
	}

	
	
	include "Footer.php";
}
else { header("Location: ../index.php?Admin=false");
exit();
}

?>