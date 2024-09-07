<?
	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
	
	$view = SecurePost($_GET['view']);
?>
	<h1>Develop</h1>
	<div id='AssetsMenu' style='margin-right:0;border:0;'>
		<div class='verticaltab'>
			<a href='http://avatar-gamer.ga/develop/?view=1'>
				My Items
			</a>
			<a href='http://avatar-gamer.ga/develop/?view=2'>
				My Forum Posts
			</a>
			<a href='http://avatar-gamer.ga/develop/?view=3'>
				My Friends
			</a>
			<a href='http://avatar-gamer.ga/develop/?view=4'>
				My Best Friends
			</a>
						<a href='http://avatar-gamer.ga/develop/?view=5'>
				My Advertisements
			</a>
		</div>
	</div>
	<div class='divider-right' style='width:654px;float:left;border-left:1px solid #ccc;padding:10px;'>
		<?if(!$view){
			header("Location: http://avatar-gamer.ga/develop/?view=1");
			die();
		}
		if($view == "1"){
			echo"
			<h1 style='font-weight:normal;margin:0;'>
				My Items
			</h1>

			";
			
					$counter = 0;
		$Setting = array(
		"PerPage1" => 12
		);
		$Item = mysql_real_escape_string(strip_tags(stripslashes($_GET['Item'])));
		if ($Item < 1) { $Item=1; }
		if (!is_numeric($Item)) { $Item=1; }
		$Minimum1 = ($Item - 1) * $Setting["PerPage1"];
		//query
		$allusers1 = mysql_query("SELECT * FROM Inventory WHERE Type='".$ItemType."' AND UserID='".$ID."'");
		$num1 = mysql_num_rows($allusers1);
		$getOwnedItems = mysql_query("SELECT * FROM Inventory WHERE UserID='".$ID."' AND Type='".$ItemType."' ORDER BY ID DESC LIMIT {$Minimum1},  ". $Setting["PerPage1"]);
		echo $Category;
		if ($num1 == "0"){
			echo"
			<div class='userInventory'>
				This user does not have any items in this category yet!
			</div>
			";
		}?>
		<table>
			<tr>
				<a name='OwnedItems'></a>
				<?while ($gO = mysql_fetch_object($getOwnedItems)){
					$getFromStore = mysql_query("SELECT * FROM Items WHERE Type='".$ItemType."'");
					$if_store = mysql_num_rows($getFromStore);
					if ($if_store == "1"){
						$store = 1;
						$gF = mysql_fetch_object($getFromStore);
					}
					else {
						$store = 0;
						$getFromStore = mysql_query("SELECT * FROM UserStore WHERE Type='".$ItemType."'");
						$gF = mysql_fetch_object($getFromStore);
						$DeleteItem = mysql_num_rows($getFromStore);
					}
					if ($DeleteItem == "0"){
						
					}
					$getCreator = mysql_query("SELECT * FROM Users WHERE ID='".$gF->CreatorID."'");
					$gC = mysql_fetch_object($getCreator);
					if ($if_store == 1) {
						$Link = "http://avatar-gamer.ga/Store/Item.aspx?ID=".$gF->ID."";
					}
					else {
						$Link = "http://avatar-gamer.ga/Store/UserItem.aspx?ID=".$gF->ID."";
					}
					$counter++;
					echo"
					</font></font></font></font>
					<td>
					";
					if ($gF->saletype == "limited"){
						echo "
						<a href='".$Link."'>
							<div style='width: 100px; height: 200px; z-index: 3;  background-image: url(http://avatar-gamer.ga/Store/Dir/".$gF->File.");'>
							<div style='width: 100px; height: 200px; z-index: 3;  background-image: url(/Imagess/LimitedWatermark.png);'>
						</a>
						"; 
						if ($gO->SerialNum != "0"){ 
							echo"
							<center><font style='color:#253138;font-weight:bold;'>#".$gO->SerialNum."/".$gF->numbersales."</font></font>
							"; 
						}
						echo"
						</div>
						</div>
						";
					}
					else {
						echo"
						<a href='".$Link."'>
							<img src='http://avatar-gamer.ga/Store/Dir/".$gF->File."' width='100' height='200'>
						</a>
						";
					}
					echo"
					</div>
					<br />
					<a href='".$Link."'>
						<b>".$gF->Name."</b>
					</a>
					</a>
					<br />
					<font class='CreatorLabel'>
						Creator:
					</font>
					<a href='http://avatar-gamer.ga/user.aspx?ID=".$gF->CreatorID."'>
						".$gC->Username."
					</a>
					<br />
					";
					if ($gF->sell == "yes"){
						if ($gF->saletype == "limited" && $gF->numberstock == "0"){
							echo"
							<font class='Bux'>
								Was: $".$gF->Price." BUX
							</font>
							";
						}
						else{
							echo"
							<font class='Bux'>
								$".$gF->Price." BUX
							</font>
							";
						}
					}
					echo"
					</td>
					";
					if ($counter >= 6) {
						echo"
						</tr>
						<tr>
						";
						$counter = 0;
					}
				}
				
	echo "
			</tr>
		</table>
		";
		
		$amount=ceil($num1 / $Setting["PerPage1"]);
		if ($Item > 1) {
		echo'<a href="http://avatar-gamer.ga/user.aspx?ID='.$ID.'&ItemType='.$ItemType.'&Item='.($Item-1).'#OwnedItems">Prev</a> - ';
		}
		echo'Page '.$Item.'/'.(ceil($num1 / $Setting["PerPage1"]));
		if ($Item < ($amount)) {
		echo ' - <a href="http://avatar-gamer.ga/user.aspx?ID='.$ID.'&ItemType='.$ItemType.'&Item='.($Item+1).'#OwnedItems">Next</a>';
		}
		
		}
		if($view == "2"){
			$MyForumPosts = mysql_query("SELECT * FROM Threads WHERE PosterID='".$myU->ID."'");
			$Threads = mysql_fetch_object($MyForumPosts);
			$ThreadsExist = mysql_num_rows($MyForumPosts);
			echo"
			<h1 style='font-weight:normal;margin:0;'>
				My Forum Posts
			</h1>
			";
			if($ThreadsExist > 0){
				echo"
				<div id='ForumBar'>
					Fuck
				</div>
				<table width='100%' cellspacing='0' cellpadding='0'>
					<tr>
						<td width='75%'>
							Test
						</td>
						<td width='25%'>
							Test
						</td>
					</tr>
				</table>
				";
			}
			else{
				echo"
				<center>
					<div style='padding:20px;'>
						You do not have any forum posts in the forum just yet!
					</div>
				</center>
				";
			}
		}
		if($view == "3"){
			echo"
			<h1 style='font-weight:normal;margin:0;'>
				My Friends
			</h1>
			";
		}
		if($view == "4"){
			echo"
			<h1 style='font-weight:normal;margin:0;'>
				My Best Friends
			</h1>
			";
		}
		if($view == "5"){
			echo"
			<h1 style='font-weight:normal;margin:0;'>
				My Advertisements
			</h1>
			";
		}?>
	</div>
	<br style='clear:both;'>
<?
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>