<?
	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
	$ID = SecurePost($_GET['ID']);
	$Username = SecurePost($_GET['Username']);
	$gU = mysql_fetch_object($getUser = mysql_query("SELECT * FROM Users WHERE ID='".$ID."'"));
	$UserExist = mysql_num_rows($getUser = mysql_query("SELECT * FROM Users WHERE ID='".$ID."'"));
	$checkBan = mysql_query("SELECT * FROM IPBans WHERE IP='".$gU->IP."'");
	$Ban = mysql_num_rows($checkBan);
	$numBadges = mysql_num_rows($Badges = mysql_query("SELECT * FROM Badges WHERE UserID='".$ID."'"));
	$getWall1 = mysql_query("SELECT * FROM Wall WHERE PosterID='".$ID."'");
	$getWallNum = mysql_num_rows($getWall1);
	$getWall = mysql_query("SELECT * FROM Wall WHERE PosterID='".$ID."' ORDER BY ID DESC");
	$getcheckActiveRequest = mysql_query("SELECT * FROM FRs WHERE SenderID='$myU->ID' AND ReceiveID='$ID' AND Active='0'");
	$checkActiveRequest = mysql_num_rows($getcheckActiveRequest);
	
	
	
	
	echo"<title>".$gU->Username." | Avatar-Universe</title>";
	if (!$ID) {
		header("Location: /Error/?code=404");
		die();
	}
	if ($UserExist == "0") {
		header("Location: /Error/DoesntExist.aspx");
		die();
	}
	if($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"){
		echo"
		<div class='blank-box' style='margin-bottom:10px;'>
			<a href='../auth.admin/mod-user.aspx?ID=".$gU->ID."'>
				Ban User
			</a>	
		</div>
		";
	}
	if($gU->Ban == 1){
		header("Location: /Error/DoesntExist.aspx");
		die();
	}
	if(!empty($gU->ProfileStatus)){
		echo"
		<div class='user-status-box'>
			<font style='color:gray;font-size:13px;'>
				Right Now I'm:
			</font>
			<i>
				&quot;".htmlentities($gU->ProfileStatus)."&quot;
			</i>
		</div>
		";
	}
	if($gU->Premium == "3"){
		echo"
		<div class='blank-box' style='margin-top:10px;'>
			<img src='/Badgess/Architect.png' width='25' style='margin-right:10px;vertical-align:middle;'>
			".$gU->Username." currently has an existing <a href='/#'>Architect Membership</a>.
		</div>
		";
	}
	if ($now < $gU->expireTime) {
		$Status = "[ Online: Website ]";
		$Color = "green";
	}else {
		$Status = "[ Offline ]";
		$Color = "gray";
	}if ($myU->Username != $gU->Username)
	{
		mysql_query("UPDATE Users SET pviews=pviews+1 WHERE ID='$gU->ID'");
	}
?>
	<div class='divider-right' style='width:484px;float:left;'>
		<div class='profileUser-Name'>
			<?echo $gU->Username; echo"'s Profile"; if($myU->ID == $gU->ID) { echo"  <br><a href='Advertising/Create.aspx'><b>Advertise Profile</b></a>";}?>
		</div>
		<div class='divider-bottom' style='position: relative;z-index:3;padding-bottom: 20px'>
			<div class='userInformation'>
				<font style='color:<?echo $Color;?>'>
					<?echo $Status;?>
				</font>
				<br />
				<img src='/Avatar.aspx?ID=<?echo $gU->ID;?>' style='display:inline-block;height:200px;width:100px;'>
			</div>
			<?
				echo"
				
				<div align='center'>
					<div id='UserDescription'>
						".nl2br($gU->Description)."
					</div>
				</div>
				<center><a href='/Account/SendMessage.aspx?ID=".$gU->ID."' class='btn-control-prof'>Send Message</a>  <a href='https://www.world2build.net/Account/DonateUser.aspx?ID=".$gU->ID."' class='btn-control-prof'>Donate</a> 
";
$checkIfFriend1 = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$gU->ID' AND SenderID='$myU->ID' AND Active='1'");
$checkFriend1 = mysql_num_rows($checkIfFriend1);
$checkIfFriend2 = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$myU->ID' AND SenderID='$gU->ID' AND Active='1'");
$checkFriend2 = mysql_num_rows($checkIfFriend2);
if($checkActiveRequest != 0) {
	echo"
				<a href='/user.aspx?ID=".$gU->ID."&ItemType=Hat' class='btn-control-prof' style='pointer-events:none;'>Friend Request Pending</a></center>
				";
}
				if($checkFriend1 == 0 and $checkFriend2 == 0 and $checkActiveRequest == 0) {
 
			echo"	<a href='/user.aspx?ID=".$gU->ID."&ItemType=Hat&friendrequest=true' class='btn-control-prof'>Send Friend Request</a></center>
				";
				}



				
				
			?>
		</div>
		<div class='profileBadgesPane'>
			Avatar-Universe Badges
		</div>
		<div class='divider-bottom' style='padding-bottom:20px;'>
			<?if($numBadges == "0"){
				echo"
				<div class='userBadges'>
					This user does not have any badges yet!
				</div>
				";
			}
			if ($numBadges > 0){
				$Badges = mysql_query("SELECT * FROM Badges WHERE UserID='".$ID."' ORDER BY ID");
				$badge = 0;
				echo"
				<table cellsapcing='0' cellpadding='0'>
				<tr>
				";
				while ($Row = mysql_fetch_object($Badges)){
					$badge++;
					echo"
					<td>
						<img src='/Badgess/".$Row->Position.".png' height='72' width='72' style='margin-left: 20px;margin-right: 20px;'>
						<div style='padding-top:2px;'></div>
						<a href='/Account/Badges.aspx' style='font-size:14px;color:#0055B3;'>
							<center>
								".$Row->Position."
							</center>
						</a>
					</td>
					";
					if ($badge >= 4) {
						echo"
						</tr>
						<tr>
						";
					$badge = 0;
					}
				}
				echo"
				</tr>
				</table>
				";
			}?>
		</div>
		<div>
			<div class='profileStatisticsPane'>
				Statistics
			</div>
			<table class='statsTable'>
				<tbody>
					<tr>
						<td class='statsTableTd'>
							<acronym title='The number of profile views this user has.'>Profile Views</acronym>:
						</td>
						<td class='statsTableValue'>
							<?echo"".number_format($gU->pviews)."";?>
						</td>
					</tr>
					<tr>
						<td class='statsTableTd'>
							<acronym title='The number of forum posts this user has.'>Forum Posts</acronym>:
						</td>
						<td class='statsTableValue'>
							<?$Threads = mysql_num_rows($Threads = mysql_query("SELECT * FROM Threads WHERE PosterID='$ID'"));
							$Replies = mysql_num_rows($Replies = mysql_query("SELECT * FROM Replies WHERE PosterID='$ID'"));
							$Posts123 = $Threads + $Replies;
							echo "".number_format($Posts123)."";?>
						</td>
					</tr>
					<tr>
						<td class='statsTableTd'>
							<acronym title='The number of friends this user has.'>Friends</acronym>:
						</td>
						<td class='statsTableValue'>
							<?$NumFriends = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$ID' AND Active='1'");
							$NumFriends = mysql_num_rows($NumFriends);
							echo "".$NumFriends."";?>
						</td>
					</tr>
					<tr>
					<td class='statsTableTd'>
						<acronym title='The number of wall posts this user has.'>Wall Posts</acronym>:
					</td>
					<td class='statsTableValue'>
						<?$NumberWallPosts = mysql_num_rows($NumberWallPosts = mysql_query("SELECT * FROM Wall WHERE PosterID='".$ID."'"));
						echo"".$NumberWallPosts."";?>
					</td>
					</tr>
					<tr>
						<td class='statsTableTd'>
							<acronym title='The last time this user was seen on the website.'>Status/Last Online</acronym>:
						</td>
						<td class='statsTableValue'>
							<?if (!$gU->expireTime){
								$SS = "Error";
							}
							else {
								if ($now < $gU->expireTime) {
									$SS = "<font color='green'>Online</font>";
								}
								else {
									$SS = date("F j, Y g:iA", $gU->expireTime);
								}
							}?>
							<?echo $SS;?>
						</td>
					</tr>
				</tbody>
			</table>
			<br />
		</div>
	</div>
	<div class='divider-left' style='width: 484px; float: left; position: relative; left: -1px'>
		<div class='divider-bottom' style='clear:both;padding-bottom:20px;'>
			<div class='profileUser-Name' style='padding-left:10px;'>
				<?echo"".$gU->Username."'s Friends &nbsp; <a href='/My/Friends.aspx?ID=$ID' style='font-size: 20px;'>View all</a>";?>
			</div>
			<?$Setting = array(
			"PerPag1e" => 8
			);
			$Page1 = SecurePost($_GET['FRPage']);
			if ($Page1 < 1) { $Page1=1; }
			if (!is_numeric($Page1)) { $Page1=1; }
			$Minimum1 = ($Page1 - 1) * $Setting["PerPag1e"];
			$allusers1 = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$ID' AND Active='1'");
			$num1 = mysql_num_rows($allusers1);
			$getFRs = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$ID' AND Active='1' LIMIT {$Minimum1},  ". $Setting["PerPag1e"]);
			$RFriends = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$ID' AND Active='1'");
			$NumFriends = mysql_num_rows($getFRs);
			$KFriends = mysql_num_rows($RFriends);?>
			<center>
				<table style='margin-left:20px;'>
					<tr>
					<?if ($NumFriends == 0){
						echo"
						<div class='userFriends'>
							This user has not added any friends yet!
						</div>
						";
					}
					$friends = 0;
					while ($gF = mysql_fetch_object($getFRs)){
						$friends++;
						$getFriend = mysql_query("SELECT * FROM Users WHERE ID='".$gF->SenderID."'");
						$gFF = mysql_fetch_object($getFriend);
						echo"
						<td>
							<a href='/user.aspx?ID=".$gFF->ID."'>
								<div style='height:100px;width:100px;overflow-y:hidden;'>
									<img src='/Avatar.aspx?ID=".$gFF->ID."'>
								</div>
								".$gFF -> Username."
							</a>
						</td>
						";
						if ($friends >= 4){
							echo"
							</tr>
							<tr>
							";
							$friends = 0;
						}
					}?>
					</tr>
				</table>
			</center>
			<div style='margin-left:20px;'>
			<?$amount=ceil($num1 / $Setting["PerPag1e"]);
			if ($Page1 > 1) {
			echo'<a href="/user.aspx?ID='.$ID.'&ItemType=Hat&FRPage='.($Page1-1).'">Prev</a> - ';
			}
			echo ''.$Page1.'/'.(ceil($num1 / $Setting["PerPag1e"]));
			if ($Page1 < ($amount)) {
			echo' - <a href="/user.aspx?ID='.$ID.'&ItemType=Hat&FRPage='.($Page1+1).'">Next</a>';
			}?>
			</div>
		</div>
		<div class='divider-bottom' style='clear:both;padding-bottom:20px;'>
			<div class='profileGroupsPane'>
				Groups
			</div>
			<?$NumInGroups1 = mysql_query("SELECT * FROM GroupMembers WHERE UserID='$ID'");
			$NumInGroups = mysql_num_rows($NumInGroups1);
			if ($NumInGroups == "0"){
				echo"
				<div class='userGroups'>
					This user has not joined any groups yet!
				</div>
				";
			}?>
			<center>
				<table>
					<tr>
				<?$groups = 0;
				while ($gG = mysql_fetch_object($NumInGroups1)){
					$groups++;
					$getGroupK = mysql_query("SELECT * FROM Groups WHERE ID='".$gG->GroupID."'");
					$gK = mysql_fetch_object($getGroupK);
					$GroupName = $gK->Name;
					if(strlen($GroupName) > 10)  $GroupName = substr($GroupName, 0, 10).'...';
					echo "
					<td>
						<a href='/Groups/Group.aspx?ID=".$gK->ID."' title='".$gK->Name."'>
							<div style='width:65px;height:65px;margin:10px 10px;'>
								<img src='/Groups/GL/".$gK->Logo."' height='64' width='64'>
							</div>
							".$GroupName."
						</a>
					</td>
					";
					if ($groups >= 5) {
						echo"
						</tr>
						<tr>
						";
						$groups = 0;
					}
				}?>
					</tr>
				</table>
			</center>
		</div>
		<div class='divider-bottom' style='clear:both;padding-bottom:20px;'>
			<div class='profileWallPostsPane'>
				Wall Posts
			</div>
			<div class='userWallPosts'>
				This user does not have any wall posts yet!
			</div>
		</div>
	</div>
	<div class='divider-top' style='clear:both;padding-bottom:20px;'>
		<div class='profileInventoryPane'>
			Inventory
		</div>
		<?$ItemType = SecurePost($_GET['ItemType']);
		if(empty($ItemType)){
			header("Location: /user.aspx?ID=".$gU->ID."&ItemType=Hat");
			die();
		}
		if($ItemType == "Hat"){
			$Category = "
			<div class='profileh2'>
				Hats
			</div>
			";
		}
		elseif($ItemType == "Top"){
			$Category = "
			<div class='profileh2'>
				Shirts
			</div>
			";
		}
		elseif($ItemType == "Bottom"){
			$Category = "
			<div class='profileh2'>
				Pants
			</div>
			";
		}
		elseif($ItemType == "Hair"){
			$Category = "
			<div class='profileh2'>
				Hair
			</div>
			";
		}
		elseif($ItemType == "Eyes"){
			$Category = "
			<div class='profileh2'>
				Eyes
			</div>
			";
		}
		elseif($ItemType == "Accessory"){
			$Category = "
			<div class='profileh2'>
				Accessories
			</div>
			";
		}
		elseif($ItemType == "Mouths"){
			$Category = "
			<div class='profileh2'>
				Mouths
			</div>
			";
		}
		elseif($ItemType == "Shoes"){
			$Category = "
			<div class='profileh2'>
				Shoes
			</div>
			";
		}
		else{
			header("Location: /Error/?code=404");
			die();
		}?>
		<div id='AssetsMenu'>
			<div class='verticaltab'>
				<a href='/user.aspx?ID=<?echo $gU->ID;?>&ItemType=Hat'>
					Hats
				</a>
				<a href='/user.aspx?ID=<?echo $gU->ID;?>&ItemType=Accessory'>
					Accessories
				</a>
				<a href='/user.aspx?ID=<?echo $gU->ID;?>&ItemType=Top'>
					Shirts
				</a>
				<a href='/user.aspx?ID=<?echo $gU->ID;?>&ItemType=Bottom'>
					Pants
				</a>
				<a href='/user.aspx?ID=<?echo $gU->ID;?>&ItemType=Eyes'>
					Eyes
				</a>
				<a href='/user.aspx?ID=<?echo $gU->ID;?>&ItemType=Shoes'>
					Shoes
				</a>
				<a href='/user.aspx?ID=<?echo $gU->ID;?>&ItemType=Mouths'>
					Mouths
				</a>
				<a href='/user.aspx?ID=<?echo $gU->ID;?>&ItemType=Hair'>
					Hair
				</a>
			</div>
		</div>
		<table cellspacing='0' cellpadding='0'>
			<tr>
		<?
			$getmyitems = mysql_query("SELECT * FROM Inventory WHERE UserID='".$gU->ID."' AND Type='".$ItemType."'");
			while($gmi = mysql_fetch_object($getmyitems)){
				$storeitem = mysql_query("SELECT * FROM Items WHERE ID='".$gmi->ItemID."' AND Type='".$ItemType."'");
				$si = mysql_fetch_object($storeitem);
				
				echo"
				<td>
					$si->Name
				</td>
				";
			}
		?>
			</tr>
		</table>
		<br style='clear:both;'>
<?

$friendRequest = SecurePost($_GET['friendrequest']);

if($friendRequest == "true") {
if($ID != $myU->ID) {
if($checkActiveRequest != 0){
mysql_query("INSERT INTO FRs (SenderID, ReceiveID, BestFriend, Active) VALUES ('$myU->ID','$ID','0','0')");
header("Location: user.aspx?ID=$ID");
die();
}
}
else {
header("Location: user.aspx?ID=$ID");
}
}







	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>