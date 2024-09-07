<?php
	include "Header.php";
	if (!$User) {
	
		header("Location: index.php");
	
	}
	$view = mysql_real_escape_string(strip_tags(stripslashes($_GET['view'])));
	
		if (!$view) {
		header("Location: ItemLogs.php?view=all");
		}
		
		if ($view == "all") {
		
			echo "<font size='4'>Purchase History</font><br /><br />";
		
			$getLogs = mysql_query("SELECT * FROM PurchaseLog WHERE UserID='$myU->ID' ORDER BY ID DESC");
			
				while ($gL = mysql_fetch_object($getLogs)) {
				
					$TypeStore = "";
					
					if ($gL->TypeStore == "store") {
					$TypeStore = "Store";
					}
					else {
					$TypeStore = "User Store";
					}
				
					echo "
					<div style='border:1px solid black;background-color:white;'>
					<table width='100%' style='padding:5px;'>
						<tr>
							<td width='700'>
									".$gL->Item."
							</td>
							<td>
								".$TypeStore."
							</td>
						</tr>
					</table></div>
					<br />
					";
				
				}
				echo "</div>";
		
		}
	include "Footer.php";
?>