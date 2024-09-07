<?php
	include($_SERVER['DOCUMENT_ROOT'].'/auth.admin/admin-header.php');

	$getDrafts = mysql_query("SELECT * FROM ItemDrafts");
	
	echo"
	<div id='StandardBoxHeader'>
		Store Item Moderation
	</div>
	<div id='StandardBox'>
	";
	
	while ($gD = mysql_fetch_object($getDrafts)) {
		echo"
		<td id='unApproveditem' width='215'>
			<center>
		";
		
		if ($gD->Type != "Background") {
			echo "
			<div style='width:100px;height:200px;background-image:url(../catalog/storage/Avatar.png);'>
			<img src='../catalog/storage/".$gD->File."' width='100' height='200'></div>
			";
		}
		else {
			echo"
			<div style='width:100px;height:200px;background-image:url(../catalog/storage/".$gD->File.");'>
				<img src='../store/catalog/Avatar.png' width='100' height='200'>
			</div>
			";
		}
					echo "
					<form action='' method='POST'>
					<table width='75%'>
						<tr>
							<td>
							<font size='1'><font color='grey'><b>NAME: </font></font></b>
							</td>
							<td>
								<input type='text' name='Name' value='".$gD->Name."'>
							</td>
						</tr>
						<tr>
							<td>
							<font size='1'><font color='grey'><b>PRICE: </font></font></b>
							</td>
							<td>
								<input type='text' name='Price' value='".$gD->Price."'>
							</td>
						</tr>
						<tr>
							<td>
								<font size='1'><font color='grey'><b>TYPE: </font></font></b>
							</td>
							<td>
								<input type='text' name='saletype' value='".$gD->saletype."'>
							</td>
						</tr>
						<tr>
							<td>
								<font size='1'><font color='grey'><b>STOCK: </font></font></b>
							</td>
							<td>
								<input type='text' name='numberstock' value='".$gD->numberstock."'>
							</td>
						</tr>
						<tr>
							<td>
								<font size='1'><font color='grey'><b>CREATOR: </font></font></b>
							</td>
							<td>
								";
								$getCreator = mysql_query("SELECT * FROM Users WHERE ID='$gD->CreatorID'");
								$gC = mysql_fetch_object($getCreator);
								echo "
								$gC->Username
							</td>
						</tr>
					</table>
					<br />
					<input type='submit' name='Submit' value='Update Item'>
					<input type='hidden' name='ItemID' value='".$gD->ID."'>
					<br /><br />
					<a href='?Release=yes&ReleaseID=$gD->ID'><b><font color='green'>Release</font</b></a> / <a href='?Release=no&ReleaseID=$gD->ID'><b><font color='red'>Delete</font></b></a>
					</form>
				</center>
				</td>
				";
				
			
			}
				$Name = mysql_real_escape_string(strip_tags(stripslashes($_POST['Name'])));
				$Price = mysql_real_escape_string(strip_tags(stripslashes($_POST['Price'])));
				$saletype = mysql_real_escape_string(strip_tags(stripslashes($_POST['saletype'])));
				$numberstock = mysql_real_escape_string(strip_tags(stripslashes($_POST['numberstock'])));
				$ItemID = mysql_real_escape_string(strip_tags(stripslashes($_POST['ItemID'])));
				$Submit = mysql_real_escape_string(strip_tags(stripslashes($_POST['Submit'])));
				$Release = mysql_real_escape_string(strip_tags(stripslashes($_GET['Release'])));
				$ReleaseID = mysql_real_escape_string(strip_tags(stripslashes($_GET['ReleaseID'])));
                                $date = date("F j, Y g:iA");

				if ($Submit) {
				
					mysql_query("UPDATE ItemDrafts SET Name='$Name' WHERE ID='$ItemID'");
					mysql_query("UPDATE ItemDrafts SET Price='$Price' WHERE ID='$ItemID'");
					mysql_query("UPDATE ItemDrafts SET saletype='$saletype' WHERE ID='$ItemID'");
					mysql_query("UPDATE ItemDrafts SET numberstock='$numberstock' WHERE ID='$ItemID'");
					header("Location: ReleaseItem.php");
				
				}
				if ($Release == "yes") {
					
					$getItem = mysql_query("SELECT * FROM ItemDrafts WHERE ID='$ReleaseID'");
					$gI = mysql_fetch_object($getItem);
					mysql_query("INSERT INTO Items (Name, File, Type, Price, CreatorID, saletype, numbersales, numberstock, sell, Description, CreationTime, store, timemake, itemDeleted, SalePrices, NumberSold, Bump)
					VALUES ('$gI->Name','$gI->File','$gI->Type','$gI->Price','$gI->CreatorID','$gI->saletype','$gI->numbersales','$gI->numberstock','$gI->sell','$gI->Description','$gI->CreationTime','$gI->store','$gI->timemake','$gI->itemDeleted','$gI->SalePrices','$gI->NumberSold','$gI->Bump')");
                                        mysql_query("INSERT INTO Logs (UserID, Message, Type, Date) VALUES ('$myU->ID','Has Accepted $gI->Name into the Main Catalog','Store','$date')");
					mysql_query("DELETE FROM ItemDrafts WHERE ID='$ReleaseID'");
                               
					header("Location: ReleaseItem.php");					
				
				}
				elseif ($Release == "no") {
                                mysql_query("INSERT INTO Logs (UserID, Message, Type, Date) VALUES ('$myU->ID','Has Declined $gI->Name into the Main Catalog','Store','$date')");
				mysql_query("DELETE FROM ItemDrafts WHERE ID='$ReleaseID'");
					$getItem = mysql_query("SELECT * FROM ItemDrafts WHERE ID='$ReleaseID'");
					$gI = mysql_fetch_object($getItem);
					unlink("/Store/Dir/$gI->File");
				header("Location: /Administration/ReleaseItem.php");
				}echo "</tr></table>";
?>