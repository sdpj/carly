<?php
include "Header.php";

	$ID = mysql_real_escape_string(strip_tags(stripslashes($_GET['ID'])));
	
		if (!$User) {
		
			header("Location: index.php");
		
		}
		if (!$ID) {
		
			echo "<b>Please include an ID!</b>";
			exit;
		
		}
		else {
		
			$getMessage = mysql_query("SELECT * FROM PMs WHERE ID='$ID'");
			$gM = mysql_fetch_object($getMessage);
			
				if ($gM->SenderID != $myU->ID) {
				
					echo "<b>Error.</b>";
					exit;
					
				}
				//sender id
				
				$getSender = mysql_query("SELECT * FROM Users WHERE ID='$gM->SenderID'");
				$gS = mysql_fetch_object($getSender);
				$Method = mysql_real_escape_string(strip_tags(stripslashes($_GET['Method'])));
				if (!$Method) {
				echo "
				<div id='TopBar'>
					".$gM->Title."
				</div>
				<div id='aB'>
					<table>
						<tr>
							<td width='125' valign='top'><center>
								<a href='user.php?ID=".$gS->ID."' style='color:black;'>
								";
								
								drawAvatar($gS->ID, 100, 195);
								
								echo "
								<br />
								<b>".$gS->Username."</b>
								</a>
							</td>
							<td valign='top'>
								".nl2br($gM->Body)."
								<br />
								<br />
								
							</td>
						</tr>
					</table>
				</div>
				";
				}
				
					
		
		}

include "Footer.php";