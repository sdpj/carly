<?php
include "Header.php";
if ($myU->PowerAdmin = "true") {

	
	echo "
	<fieldset>
	<legend>Search User</legend>
	<form action='' method='POST'>
		<table>
			<tr>
				<td>
					Search by Username
				</td>
				<td>
					<input type='text' name='SearchByUsername' />
				</td>
			</tr>
			<tr>
				<td>
					<input type='submit' name='SearchSubmit' value='Search' />
				</td>
			</tr>
		</table>
	</form>
	</fieldset>
	";
	
		$SearchByUsername = mysql_real_escape_string(strip_tags(stripslashes($_POST['SearchByUsername'])));
		$SearchSubmit = mysql_real_escape_string(strip_tags(stripslashes($_POST['SearchSubmit'])));
		
			if ($SearchSubmit) {
			
				if (!$SearchByUsername) {
				
					echo "Please type in a username.";
					exit;
				
				}
			
				$getList = mysql_query("SELECT * FROM Users WHERE Username LIKE '%$SearchByUsername%'");
				
					while ($gL = mysql_fetch_object($getList)) {
					
					
						echo "
				
						<a href='user.php?ID=".$gL->ID."'>".$gL->Username."</a><br /><br />";
					
					
					}
			
			
			}

}
include "Footer.php";
?>