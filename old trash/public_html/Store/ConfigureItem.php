<?php
include($_SERVER['DOCUMENT_ROOT']."/Header.php");
$ID = mysql_real_escape_string($_GET['ID']);
$getItems = mysql_query("SELECT * FROM Items WHERE ID='$ID' AND itemDeleted='0'");
$gI = mysql_fetch_object($getItems);
$getcheck = mysql_query("SELECT * FROM Inventory WHERE File='$gI->File'");
$gC = mysql_fetch_object($getcheck);
	if($gI->CreatorID == $myU->ID||$myU->Username == "Bailey"||$myU->Username == "Rachel"||$myU->Username == "Civil"||$myU->Username == "Forever")
	{

			

		echo "
		<center>
			<table width='100%'>
				<tr>
					<td>
						<div id='TopBar' style='width:99%;'>
							<center>
								Edit Item
							</center>
						</div>
						<form action='' method='POST'>
						<div id='aB'>
							<table>
								<tr>
									<td>
										Item Name:
									</td>
									<td>
										<input type='text' name='ItemName' value='".$gI->Name."' style='width:250px;'>
									</td>
								</tr>
								<tr>
									<td>
										Price:
									</td>
									<td>
										<input type='text' name='Price' value='".$gI->Price."' style='width:250px;'>
									</td>
								</tr>
								<tr>
									<td>
										Type:
									</td>
									<td>
										<select name='Type' style='width:250px;'>
											<option value='".$gI->Type."'>$gI->Type</option>
											<option value='Background'>Background</option>
											<option value='Body'>Body</option>
											<option value='Eyes'>Eyes</option>
											<option value='Mouth'>Mouth</option>
											<option value='Hair'>Hair</option>
											<option value='Hat'>Hat</option>
											<option value='Top'>Top</option>
											<option value='Bottom'>Bottom</option>
											<option value='Shoes'>Shoes</option>
											<option value='Accessory'>Accessory</option>
										</select>
										<br>
									</td>
								</tr>
							</table>
							<table>
								<tr>
									<td>
										Description:
									</td>
								</tr>
								<tr>
									<td>
										<textarea name='description' cols='40'>".$gI->Description."</textarea>
									</td>
								</tr>
								<tr>
									<td>
										";
										if ($myU->PowerAdmin == "true"||$gI->CreatorID == $myU->ID) {
										echo "
											Item Type:
											";
											if ($gI->saletype == 'regular') {
												echo "
												<select name='itemtype'>
													<option value='regular'>Regular</option>
													<option value='limited'>Limited</option>
												</select>
												
												";
							}
							else {
								if ($gI->CreatorID == $myU->ID||$myU->PowerAdmin == "true") {
								echo "
									 <select name='itemtype'>
										<option value='limited'>Limited</option>
										<option value='regular'>Regular</option>
									</select>
									<br>
									<b>Number Sales:</b> <input type='text' name='numbersales' value='$gI->numbersales'>
									<br>
									<b>Number Stock:</b> <input type='text' name='numberstock' value='$gI->numberstock'>
									<br />
									";
								}
							}
							}
					if ($myU->Username == "Bailey"||$myU->Username == "Pheedy"||$gI->CreatorID == $myU->ID) {				echo "
						<br>
					On Sale?
					<br>
					";
					
					if($gI->sell == "yes")
					{
					echo "
					<select name='ifsale'>
						<option value='yes'>Yes</option>
						<option value='no'>No</option>
					</select>
					";
					}
					
					else
					{
					echo "
					<select name='ifsale'>
						<option value='no'>No</option>
						<option value='yes'>Yes</option>
					</select>
					<br>
					<br>
					";
					}
					}
					echo "
					<br>
					<br>";
					
					if($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"||$gI->CreatorID == $myU->ID)
					
					{
					echo "
						<input type='submit' name='Submit' value='Update'>
					";
					}
					if ($myU->PowerAdmin == "true") {
					echo "
						<br>
						<br>
						<form action='' method='POST'>
						<input type='submit' name='movetus' value='Move To User Store'/>
						</form>
					";
					}
					echo "<form action='' method='POST'><input type='submit' name='DeleteItem' value='Delete item'></form>"; 
		$ItemName = mysql_real_escape_string(strip_tags(stripslashes($_POST['ItemName'])));
		$Price = mysql_real_escape_string(strip_tags(stripslashes($_POST['Price'])));
		$Type = mysql_real_escape_string(strip_tags(stripslashes($_POST['Type'])));
		$Description = mysql_real_escape_string(strip_tags(stripslashes($_POST['description'])));
		$Submit = mysql_real_escape_string(strip_tags(stripslashes($_POST['Submit'])));
		$ifsale = mysql_real_escape_string(strip_tags(stripslashes($_POST['ifsale'])));
		$givecopy = mysql_real_escape_string(strip_tags(stripslashes($_POST['givecopy'])));
		$Submit1 = mysql_real_escape_string(strip_tags(stripslashes($_POST['Submit1'])));
		$movetus = mysql_real_escape_string(strip_tags(stripslashes($_POST['movetus'])));
		$itemtype = mysql_real_escape_string(strip_tags(stripslashes($_POST['itemtype'])));
		$numbersales = mysql_real_escape_string(strip_tags(stripslashes($_POST['numbersales'])));
		$numberstock = mysql_real_escape_string(strip_tags(stripslashes($_POST['numberstock'])));
		
		$getNumber = mysql_query("SELECT * FROM Inventory WHERE File='$gI->File' AND ItemID='$gI->ID' AND UserID !='".$gC->ID."'");
		$gN = mysql_num_rows($getNumber);
		if ($gI->numbersales == 0) {
			$gN = $gN;
		} 
		else {
			$gN = $gI->numbersales;
		}
		if (!is_numeric($numbersales)) {
		$numbersales = 0;
		}
		if (!is_numeric($numberstock)) {
		$numberstock = 0;
		}
		if ($numbersales < 0) {
		$numbersales = 0;
		}
		if ($numberstock < 0) {
		$numberstock = 0;
		}
		if (!$itemtype) {
		$itemtype = $gI->saletype;
		}
		
		if($movetus)
		{
			$code1 = md5($gI->File);
			$code2 = md5($myU->ID);
			mysql_query("INSERT INTO UserStore (Name, File, Type, Price, CreatorID, saletype, numbersales, numberstock, active)
			VALUES ('$gI->Name','$gI->File','$gI->Type','$gI->Price','$gI->CreatorID','$gI->saletype','$gI->numbersales','$gI->numberstock', '1')");
			mysql_query("DELETE FROM Items WHERE Name='$gI->Name' AND File='$gI->File'");
			header("Location: UserStore.php");
		}
		
		if($Submit)
		{
		
				if ($Price <= 0) {
				
					$Price = "0";
					
				}
				$ItemName = filter($ItemName);
				$Description = filter($Description);
			mysql_query("UPDATE Inventory SET ItemName='$ItemName' WHERE File='".$gI->File."'");
			mysql_query("UPDATE Items SET Name='$ItemName' WHERE ID='$ID'");
			mysql_query("UPDATE Items SET Price='$Price' WHERE ID='$ID'");
			mysql_query("UPDATE Items SET Description='$Description' WHERE ID='$ID'");
			mysql_query("UPDATE Items SET sell='$ifsale' WHERE ID='$ID'");
			mysql_query("UPDATE Items SET saletype='$itemtype' WHERE ID='$ID'");
			mysql_query("UPDATE Items SET numbersales='$gN' WHERE ID='$ID'");
			mysql_query("UPDATE Items SET Type='$Type' WHERE ID='$ID'");
			mysql_query("UPDATE Items SET numbersales='$numbersales' WHERE ID='$ID'");
			mysql_query("UPDATE Items SET numberstock='$numberstock' WHERE ID='$ID'");
mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','modified $ItemName in main store','".$_SERVER['PHP_SELF']."')");
			header("Location: Item.php?ID=$ID");
		
		}
					if($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"||$myU->PowerImageModerator == "true"||$gI->CreatorID == $myU->ID)
					{
					
						
						$DeleteItem = mysql_real_escape_string(strip_tags(stripslashes($_POST['DeleteItem'])));
						if($DeleteItem)
						{
						
							$getRefunds = mysql_query("SELECT * FROM Inventory WHERE ItemID='".$gI->ID."'");
							
								while ($gRR = mysql_fetch_object($getRefunds)) {
								
									mysql_query("UPDATE Members SET Bux=Bux + ".$gI->Price." WHERE ID='".$gRR->UserID."'");
								
								}
						
							mysql_query("DELETE FROM Inventory WHERE ItemID='".$gI->ID."'");
							mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','deleted $ItemName in main store','".$_SERVER['PHP_SELF']."')");
							mysql_query("DELETE FROM Items WHERE ID='$ID'");
							
							$Type = $gI->Type;
							$FileName = $gI->File;
							
							$Location = "Dir/".$FileName."";
							
							mysql_query("update Users set $Type='' where $Type='$FileName'");
							
							unlink($Location);
							
							
							
							
							
							header("Location: Store.php");
						
						}
					
					}
					}