 <?
	include($_SERVER['DOCUMENT_ROOT']."/Header.php");
	if(!$User){
		header("Location: http://rega-gaming.mlLanding/Animated/");
		die();
	}
	$ID = SecurePost($_GET['ID']);
	$getItem = mysql_query("SELECT * FROM Items WHERE ID='".$ID."' AND itemDeleted='0'");
	$gI = mysql_fetch_object($getItem);
	$getCreator = mysql_query("SELECT * FROM Users WHERE ID='".$gI->CreatorID."'");
	$gC = mysql_fetch_object($getCreator);
	$Exist = mysql_num_rows($getItem);
	$commentflood = date(time() + 30);
	$findnumbersold = mysql_query("SELECT * FROM Inventory WHERE ItemID='".$ID."'");
	$fns = mysql_num_rows($findnumbersold);
	if ($Exist == "0"){
		header("Location: http://rega-gaming.mlError/?code=404");
		die();
	}else{
		$tryGet = mysql_query("SELECT * FROM Inventory WHERE UserID='".$myU->ID."' AND ItemID='".$ID."' AND File='".$gI->File."'");
		$tG = mysql_num_rows($tryGet);
		$getSold = mysql_query("SELECT * FROM Inventory WHERE ItemID='".$ID."' AND File='".$gI->File."'");
		$gsold = mysql_num_rows($getSold);
		if ($gI->itemDeleted == "1"){
			header("Location: http://rega-gaming.mlError/?code=404");
			die();
		}
		$checkOwn = mysql_query("SELECT * FROM Inventory WHERE UserID='$gI->CreatorID' AND ItemID='$ID'");
		$cO = mysql_num_rows($checkOwn);
		if($gI->PremiumOnly == "1"){
			$PremStat = "<center>This item is listed as a <a href='http://rega-gaming.mlUpgrades/premium.aspx' style='font-size:13px;'>membership</a> only item.
						<br />
						Only <a href='http://rega-gaming.mlUpgrades/premium.aspx' style='font-size:13px;'>membership</a> users can purchase this item.
						</center>".$time."";
		}else{
			$PremStat = "<center>This item is listed as a free for everyone item.
						<br />
						All users can purchase this item.
						</center>";
		}?>
		<form action='' method='POST'>
			<table cellspacing='0' cellpadding='0' style='padding-top:15px;padding-bottom:20px;'>
				<tr>
					<td style='width:20%;text-align:center;'>
						<?if ($gI->saletype == "limited"){
							echo"
							<div align='center'>
							<div style='width: 100px; height: 200px; z-index: 3;  background-image: url(Dir/Avatar.png);'>
							<div style='width: 100px; height: 200px; z-index: 3;  background-image: url(Dir/".$gI->File.");'>
							<div style='width: 100px; height: 200px; z-index: 3;  background-image: url(/Imagess/LimitedWatermark.png);'>
							</div></div></div></div>
							";
						}else{
							echo"
							<div align='center'>
							<div style='width: 100px; height: 200px; z-index: 3;  background-image: url(Dir/Avatar.png);'>
							<div style='width: 100px; height: 200px; z-index: 3;  background-image: url(Dir/".$gI->File.");'>
							<div style='width: 100px; height: 200px; z-index: 3;  background-image: url();'>
							</div></div></div></div>
							";
						}?>
						<br />
						<font color='darkgreen'>BUX: <b><?echo"".$gI->Price."";?></b></font>
					</td>
					<td>
						&nbsp;
					</td>
					<td valign='top' style='padding-top:15px;width:53%;'>
						<h2><?echo"".$gI->Name."";?></h2>
						<?echo"".$gI->Description."";?>
					</td>
					<td valign='top' style='text-align:center;padding-top:15px;padding-left:10px;'>
						<?if($gI->sell == "yes"&&$gI->PremiumOnly == "1"){
							if($myU->Premium >= "1"){
								echo"
								<input type='submit' name='Buy' class='btn-primary' value='Purchase'>
								";
							}else{
								echo"
								<input type='submit' name='Off' class='btn-forgotten' disabled='disabled' value='Premium Only'>
								";
							}
						}if($gI->sell == "yes"&&!$gI->PremiumOnly){
							echo"
							<input type='submit' name='Buy' class='btn-primary' value='Purchase'>
							";
						}elseif($gI->sell == "no"){
							echo"
							<input type='submit' name='Off' class='btn-forgotten' disabled=disabled value='Off Sale'>
							";
						}?>
						<br /><br />
						<center><table cellspacing='0' cellpadding='0'>
							<tr>
								<td style='text-align:right;padding-right:10px;'>
									<strong>Item Type:</strong>
								</td>
								<td>
									&nbsp;
								</td>
								<td style='text-align:left;'>
									<?echo"".$gI->Type."";?>
								</td>
							</tr>
							<tr>
								<td style='text-align:right;padding-right:10px;'>
									<strong>Date Created:</strong>
								</td>
								<td>
									&nbsp;
								</td>
								<td style='text-align:left;'>
									<?echo date("F j, Y", $gI->CreationTime);?>
								</td>
							</tr>
							<tr>
								<td style='text-align:right;padding-right:10px;'>
									<strong>Last Updated:</strong>
								</td>
								<td>
									&nbsp;
								</td>
								<td style='text-align:left;'>
									<?echo time_ago($gI->UpdateTime, $rcs = 0);?>
								</td>
							</tr>
							<tr>
								<td style='text-align:right;padding-right:10px;'>
									<strong>Number Sold:</strong>
								</td>
								<td>
									&nbsp;
								</td>
								<td style='text-align:left;'>
									<?echo"".$fns."";?>
								</td>
							</tr>
						<?	if($gI->saletype == "limited"){
								echo"
								<tr>
									<td style='text-align:right;padding-right:10px;color:red;'>
										<strong>Item Stock:</strong>
									</td>
									<td>
										&nbsp;
									</td>
									<td style='text-align:left;color:red;'>
										<b>".$gI->numberstock."</b> of <b>".$gI->numbersales."</b> remaining
									</td>
								</tr>
								";
							}
						?>
						</table></center>
						<div class='divider-bottom' style='padding-top:10px;margin-bottom:10px;'></div>
						<?echo $PremStat;?>
					</td>
				</tr>
			</table>
			<?
				if ($gI->saletype == "limited" && $gI->numberstock == "0"){
					$getSales = mysql_query("SELECT * FROM Sales WHERE ItemID='".$ID."' ORDER BY Amount ASC");
					$findsales = mysql_num_rows($getSales);
					echo"
					<div class='divider-bottom' style='width:100%'></div>
					<a name='PrivateSellers'></a>
					<h2>Private Sellers</h2>
					";
					while ($getS = mysql_fetch_object($getSales)){
						$getSeller = mysql_query("SELECT * FROM Users WHERE ID='".$getS->UserID."'");
						$gS = mysql_fetch_object($getSeller);
						if ($getS->SerialNum == "0"){
							$Serial_Num = "N/A";
						}else{
							$Serial_Num = $getS->SerialNum;
						}
						echo"
						<center><table cellspacing='0' cellpadding='0' style='width:100%;'>
							<tr>
								<td style='width:33%;text-align:center;'>
									<a href='http://rega-gaming.mluser.aspx?ID=".$gS->ID."'>
										<div align='center'><div style='height:100px;width:100px;overflow-y:hidden;'>
											<img src='http://rega-gaming.mlAvatar.aspx?ID=".$gS->ID."'>
										</div></div>
										".$gS->Username."
									</a>
								</td>
								<td style='width:33%;text-align:center;'>
									<b>Serial Number:</b> <b>".$Serial_Num."</b> of <b>".$gI->numbersales."</b>
									<br />
									<img src='http://rega-gaming.mlStore/Dir/".$gI->File."' height='100' width='50'>
								</td>
								<td style='width:33%;text-align:center;'>
									<font color='darkgreen' style='font-weight:bold;'>BUX: ".number_format($getS->Amount)."</font>
									<br />
								";
								if ($tG == 0){
									echo"
									</form><form action='Item.php?ID=".$ID."&SaleID=".$getS->ID."' method='POST'><input type='submit' name='PurchaseSale' value='Purchase' style='cursor:pointer;' id='buttonsmall' class='btn-primary'></form>
									";
								}else{
							echo "</form><form action='Item.php?ID=".$ID."&SaleID=".$getS->ID."' method='POST'><input type='submit' name='PurchaseSale' value='Purchase' disabled='disabled'  id='buttonsmall' title='You already own this item' class='btn-primary'></form>";

									
								}
								echo"
								</td>
							</tr>
						</table></center>
						";
					}
					if($findsales == 0){
						echo"
						No one is currently selling ".$gI->Name." at this time. 
						";
					}
					echo"
					<h2>Recent Prices</h2>
					";
					if ($gI->NumberSold != "0"){
						$SalePrices = $gI->SalePrices/$gI->NumberSold;
						$SalePrices = "<font color='green'><b>$".number_format($SalePrices)."</b></green>";
					}else{
						$SalePrices = "<b>N/A</b>";
					}
					echo"
					<table cellspacing='0' cellpadding='0' style='width:100%;'>
						<tr>
							<td style='text-align:center;width:50%;'>
								Recent Average Price
								<br />
								<font size='16px'>".$SalePrices."</font>
							</td>
						";
						if($tG == 0&&$myU->ID != $gC->ID){
							echo"
							<td style='text-align:center;width:50%'>
								<font style='font-size:15px;font-weight:bold;'>You can't sell this item!</font>
								<br />
								<font style='font-size:13px;'>You have to own this item in order to sell it.</font>
							</td>
							";
						}elseif($myU->ID == $gC->ID){
							echo"
							<td style='text-align:center;width:50%'>
								<font style='font-size:15px;font-weight:bold;'>You can't sell this item!</font>
								<br />
								<font style='font-size:13px;'>You are the maker of this item and cannot sell it.</font>
							</td>
							";
						}
					$Purchase = SecurePost($_POST['PurchaseSale']);
					$SaleID = SecurePost($_GET['SaleID']);
					if ($Purchase && $tG == "0" && $SaleID){
						$getRow = mysql_query("SELECT * FROM Sales WHERE ID='".$SaleID."'");
						$row = mysql_fetch_object($getRow);					
						$num_row = mysql_num_rows($getRow);
						$SalePrice = $row->Amount;
						if($num_row == 0){
							header("Location: http://rega-gaming.mlError/?code=500");
							die();
						}else{
							 if ($num_row == 1 && $myU->Bux >= $SalePrice && $row->UserID != $myU->ID){
								$getpastowner = mysql_query("SELECT * FROM Users WHERE ID='".$row->UserID."'");
								$gpo = mysql_fetch_object($getpastowner);
								$getSerial = mysql_query("SELECT * FROM Inventory WHERE UserID='$gpo->ID' AND File='$gI->File'");
								$Serial = mysql_fetch_object($getSerial);
								$code1 = sha1($gI->File);
								$code2 = sha1($myU->ID);
								mysql_query("UPDATE Users SET Bux=Bux + $SalePrice WHERE ID='".$row->UserID."'");
								mysql_query("INSERT INTO Inventory (UserID, ItemID, File, Type, code1, code2, SerialNum)
								VALUES ('$myU->ID','$ID','$gI->File','$gI->Type','$code1','$code2','$Serial->SerialNum')");
								$getpastowner = mysql_query("SELECT * FROM Users WHERE ID='".$row->UserID."'");
								$gpo = mysql_fetch_object($getpastowner);
								mysql_query("DELETE FROM Inventory WHERE ItemID='".$ID."' AND UserID='".$row->UserID."' AND File='".$gI->File."' AND Type='".$gI->Type."'");
								mysql_query("UPDATE Users SET Bux=Bux - $SalePrice WHERE ID='".$myU->ID."'");
								mysql_query("DELETE FROM Sales WHERE ID='".$SaleID."' AND UserID='".$row->UserID."'");
								mysql_query("UPDATE Users SET ".$gI->Type."='' WHERE ID='".$row->UserID."' AND $gI->Type='$gI->File'");
			
								header("Location: http://rega-gaming.mlcharacter.aspx");
								die();
							}else{
								$getpastowner = mysql_query("SELECT * FROM Users WHERE ID='".$row->UserID."'");
								$gpo = mysql_fetch_object($getpastowner);
								$MoreMoney = $SalePrice - $myU->Bux;
							}
						}
					}
					if ($gI->saletype == "limited" && $gI->numberstock == "0"&&$tG >= "1" && $myU->ID != $gC->ID){
						$PriceSell = SecurePost($_POST['PriceSell']);
						$SubmitSell = SecurePost($_POST['SubmitSell']);
						$ifSelling = mysql_query("SELECT * FROM Sales WHERE ItemID='".$ID."' AND UserID='".$myU->ID."'");
						$ifS = mysql_num_rows($ifSelling);
						echo"
								<td style='text-align:center;width:50%;'>
									<form action='' method='POST'>
						";	
										if ($ifS == "0"){
											$action = "create";
											echo"
											<b>Input a price to sell</b>
											<br />
											<input type='text' placeholder='Enter your price here...' name='PriceSell' style='width:250px;margin-bottom:5px;'>
											<br />
											<input type='submit' name='SubmitSell' class='btn-primary' value='Sell my Limited' />
											";
										}else{
											$iS = mysql_fetch_object($ifSelling);
											$action = "update";
												echo"
												<b>Input a price to sell</b>
												<br />
												<input type='text' placeholder='Enter your price here...' name='PriceSell' value='".$iS->Amount."' style='width:250px;margin-bottom:5px;'>
												<br />
												<input type='submit' name='SubmitSell' class='btn-primary' value='Update' />
												<a href='Item.aspx?ID=".$ID."&RemoveMySale=T' class='btn-primary'>Remove</a>
												";
												$RemoveMySale = SecurePost($_GET['RemoveMySale']);
												if ($RemoveMySale == "T"){
													if ($ifS == "1"){
														mysql_query("DELETE FROM Sales WHERE UserID='".$myU->ID."' AND ItemID='".$ID."'");
														header("Location: Item.aspx?ID=".$ID."");
														die();
													}
												}
											}
											if ($action == "create" && $SubmitSell){
												if ($PriceSell < 0){
													echo "<font color='red'>ERROR: Your price is below 0 Bux! Please try again...</font>";
												}else {
														
														$getFromInventory = mysql_query("SELECT * FROM Inventory WHERE UserID='".$myU->ID."' AND ItemID='".$ID."'");
														$gFI = mysql_fetch_object($getFromInventory);
														mysql_query("INSERT INTO Sales (UserID, Amount, ItemID, SerialNum) VALUES ('".$myU->ID."','".$PriceSell."','".$ID."','".$gFI->SerialNum."')");
			
			
															
															header("Location: Item.php?ID=".$ID."");
														
														}
													
													}
													
													if ($action == "update" && $SubmitSell) {
													
														if ($PriceSell < 0) {
														
															echo "<font color='red'>ERROR: Your price is below 0 Bux! Please try again...</font>";
														
														}
														else {
														
														mysql_query("UPDATE Sales SET Amount='".$PriceSell."' WHERE UserID='".$myU->ID."' AND ItemID='".$ID."'");
														
														}
													
													}
													
													
													echo "
													</form>
													</td>
													</tr>
													</table>
												";
												
											
											}
				}
			?>
			<table cellspacing='0' cellpadding='0' style='width:100%;padding-top:15px;'>
				<tr>
					<td style='width:50%;' valign='top'>
						<a name='CommentSection'></a>
						<h2>Comments</h2>
						<table cellspacing='0' cellpadding='0' style='width:100%;'>
							<tr>
								<td style='text-align:center;'>
									<a href='http://rega-gaming.mluser.aspx?ID=<?echo"".$myU->ID."";?>'>
										<div align='center'><div style='height:100px;width:100px;overflow-y:hidden;'>
											<img src='http://rega-gaming.mlAvatar.aspx?ID=<?echo"".$myU->ID."";?>'>
										</div></div>
										<?echo"".$myU->Username."";?>
									</a>
								</td>
								<td style='text-align:center;'>
									<textarea name='Comment' rows='5' cols='40' placeholder='Say something neat about this item.'></textarea>
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;
								</td>
								<td style='text-align:right;padding-right:15px;'>
									<input type='submit' class='btn-primary' name='PostComment' value='Post'>
								</td>
							</tr>
						</table>
						<?
						$Comment = SecurePost(filter($_POST['Comment']));
						$PostComment = SecurePost($_POST['PostComment']);
						$now = time();
						if($PostComment){
							if($User) {
							mysql_query("INSERT INTO ItemComments (UserID,ItemID,Post,time) VALUES('$myU->ID','$ID','$Comment','$now')");
							header("Location: Item.aspx?ID=$ID");
							
							}
						}
							$getComments = mysql_query("SELECT * FROM ItemComments WHERE ItemID='".$ID."' ORDER BY time DESC");
							$counter = 0;
							$doanyexist = mysql_num_rows($getComments);
							while ($gC = mysql_fetch_object($getComments)){
								$counter++;
								$getPoster = mysql_query("SELECT * FROM Users WHERE ID='".$gC->UserID."'");
								$gP = mysql_fetch_object($getPoster);
								echo"
								<table>
									<tr>
										<td style='text-align:center;'>
											<a href='http://rega-gaming.mluser.aspx?ID=".$gP->ID."'>
												<div align='center'><div style='height:100px;width:100px;overflow-y:hidden;'>
													<img src='http://rega-gaming.mlAvatar.aspx?ID=".$gP->ID."'>
												</div></div>
												".$gP->Username."
											</a>
										</td>
										<td style='width:95%' valign='top'>
											<div style='width:100%'>
												Posted ".time_ago($gC->time, $rcs = 0)."
												<div class='divider-bottom' style='width:100%;padding-top:3px;margin-bottom:5px;'></div>
												".nl2br($gC->Post)."
											</div>
										</td>
									</tr>
								</table>
								<div class='divider-bottom' style='width:100%;padding-top:3px;margin-bottom:5px;'></div></div><br>
								";
							}
							if($doanyexist < 1){
								echo"
								<center>
									<div style='padding:10px;'>
										No one has commented on this item yet! Want to be the first?
									</div>
								</center>
								";
							}
						?>
					</td>
					<td style='width:50%;' valign='top'>
						<h2>Featured Items</h2>
					</td>
				</tr>
			</table>
		</form>
<?
	}
?>
<?
	$Comment = SecurePost($_POST['Comment']);
	$PostComment = SecurePost($_POST['PostComment']);
	if($PostComment){
		if(!$Comment){
			echo"
			<div class='BoxBackground'></div>
			<div class='BoxContainer'>
				<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
					<div class='Title'>
						<h2 style='margin:0;'>
						Comment Post Failed
						</h2>
					</div>
					<div class='GenericModalBody'>
						<div class='TopBody' style='padding:10px;text-align:center;'>
							<div class='Message'>
								<h2 style='font-weight:normal;margin:0;'>
									Please provide a comment to post!
								</h2>
								<img src='http://rega-gaming.mlImages/Oops.png' height='64'>
							</div>
						</div>
						<div class='ConfirmationContainer'>
							<center>
								<a href='http://rega-gaming.mlStore/Item.aspx?ID=".$ID."?#CommentSection' class='btn-forgotten'>Cancel</a>
							</center>
						</div>
					</div>   
				</div>
			</div>
			";
		}elseif(strlen($Comment) > 250){
			echo"
			<div class='BoxBackground'></div>
			<div class='BoxContainer'>
				<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
					<div class='Title'>
						<h2 style='margin:0;'>
						Comment Post Failed
						</h2>
					</div>
					<div class='GenericModalBody'>
						<div class='TopBody' style='padding:10px;text-align:center;'>
							<div class='Message'>
								<h2 style='font-weight:normal;margin:0;'>
									Your post is too long. Keep your post under 250 characters!
								</h2>
								<img src='http://rega-gaming.mlImages/Oops.png' height='64'>
							</div>
						</div>
						<div class='ConfirmationContainer'>
							<center>
								<a href='http://rega-gaming.mlStore/Item.aspx?ID=".$ID."?#CommentSection' class='btn-forgotten'>Cancel</a>
							</center>
						</div>
					</div>   
				</div>
			</div>
			";
		}
	}
	$Buy = SecurePost($_POST['Buy']);
	if ($Buy && $gI->sell == "yes"){
		$Price = $gI->Price;
		$Diamonds = $gI->Diamonds;
		if($gI->PremiumOnly > 0&&$myU->Premium == 0){
			//
		}elseif ($myU->Bux >= $Price){
			if ($gI->saletype == "limited"&&$gI->numberstock == "0") {
				//item sold out, error msg
				echo"
				<div class='BoxBackground'></div>
				<div class='BoxContainer'>
					<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
						<div class='Title'>
							<h2 style='margin:0;'>
							Store Purchase Failed
							</h2>
						</div>
						<div class='GenericModalBody'>
							<div class='TopBody' style='padding:10px;text-align:center;'>
								<div class='Message'>
									<h2 style='font-weight:normal;margin:0;'>
										This item is sold out. Better luck next time!
									</h2>
									<img src='http://rega-gaming.mlImages/Oops.png' height='64'>
								</div>
							</div>
							<div class='ConfirmationContainer'>
								<center>
									<a href='http://rega-gaming.mlStore/Item.aspx?ID=".$ID."' class='btn-forgotten'>Cancel</a>
								</center>
							</div>
						</div>   
					</div>
				</div>
				";
			}else{
				$tryGet = mysql_query("SELECT * FROM Inventory WHERE UserID='".$myU->ID."' AND ItemID='".$ID."' AND File='".$gI->File."'");
				$tG = mysql_num_rows($tryGet);
				if ($tG >= 1){
					echo"
					<div class='BoxBackground'></div>
					<div class='BoxContainer'>
						<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
							<div class='Title'>
								<h2 style='margin:0;'>
								Store Purchase Failed
								</h2>
							</div>
							<div class='GenericModalBody'>
								<div class='TopBody' style='padding:10px;text-align:center;'>
									<div class='Message'>
										<h2 style='font-weight:normal;margin:0;'>
											This item is already in your inventory!
										</h2>
										<img src='http://rega-gaming.mlImages/Oops.png' height='64'>
									</div>
								</div>
								<div class='ConfirmationContainer'>
									<center>
										<a href='http://rega-gaming.mlStore/Item.aspx?ID=".$ID."' class='btn-forgotten'>Cancel</a>
									</center>
								</div>
							</div>   
						</div>
					</div>
					";
				}elseif ($tG == "0"){
					if ($gI->saletype == "limited" && $gI->numberstock != "0"){
						mysql_query("UPDATE Items SET numberstock=numberstock - 1 WHERE ID='".$ID."'");
					}
					$code1 = sha1($gI->File);
					$code2 = sha1($myU->ID);
					if ($gI->saletype == "limited"){
						$Equation = $gI->numbersales + 1;
						$Output = $Equation - $gI->numberstock;
						$getStock = mysql_query("SELECT * FROM Inventory WHERE ItemID='$ID' AND File='$gI->File' AND SerialNum='$Output'");
						$Stock = mysql_num_rows($getStock);
						if ($Stock >= 1){
							header("Location: http://rega-gaming.mlError/?code=500");
							die();
						}		
					}else{
						$Output = 0;
					}
					mysql_query("UPDATE Users SET Bux=Bux - ".$Price." WHERE ID='".$myU->ID."'");
					mysql_query("INSERT INTO Inventory (UserID, ItemID, File, Type, code1, code2, SerialNum)
					VALUES ('".$myU->ID."','".$ID."','".$gI->File."','".$gI->Type."','".$code1."','".$code2."','".$Output."')");
					mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','purchased ".$gI->Name." for ".$Price."','".$_SERVER['PHP_SELF']."')");
					mysql_query("INSERT INTO PurchaseLog (UserID, Item, TypeStore) VALUES('$myU->ID','Purchased $gI->Name for $Price','store')");
					header("Location: http://rega-gaming.mlStore/Item.aspx?ID=".$ID."");
					die();
				}
			}
		}else {
			//you dont have enough money!!
			echo"
			<div class='BoxBackground'></div>
			<div class='BoxContainer'>
				<div tabindex='-1' style='height: 100%; outline: 0px; width: 100%; overflow: visible;'>
					<div class='Title'>
						<h2 style='margin:0;'>
							Store Purchase Failed
						</h2>
					</div>
					<div class='GenericModalBody'>
						<div class='TopBody' style='padding:10px;text-align:center;'>
							<div class='Message'>
								<h2 style='font-weight:normal;margin:0;'>
									You do not have enough currency to purchase this item!
								</h2>
								<img src='http://rega-gaming.mlImages/Oops.png' height='64'>
							</div>
						</div>
						<div class='ConfirmationContainer'>
							<center>
								<a href='http://rega-gaming.mlStore/Item.aspx?ID=".$ID."' class='btn-forgotten'>Cancel</a>
							</center>
						</div>
					</div>   
				</div>
			</div>
			";
		}
	}
	include($_SERVER['DOCUMENT_ROOT']."/Footer.php");
?>