<?
	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
	$ID = SecurePost($_GET['ID']);
	$getGroup = mysql_query("SELECT * FROM Groups WHERE ID='".$ID."'");
	$Group = mysql_fetch_object($getGroup);
	$groupExist = mysql_num_rows($getGroup);
	if($groupExist == "0"){
		header("Location: http://avatar-gamer.ga/Error/?code=404");
		die();
	}elseif(empty($ID)){
		header("Location: http://avatar-gamer.ga/Error/?code=404");
		die();
	}
	$FindOwner = mysql_query("SELECT * FROM Users WHERE ID='".$Group->OwnerID."'");
	$fO = mysql_fetch_object($FindOwner);
	$GroupInfo = mysql_query("SELECT * FROM GroupMembers WHERE UserID='".$myU->ID."' AND GroupID='".$ID."'");
	$InGroup = mysql_fetch_object($GroupInfo);
?>

	<div id='groups-page' style='padding-top:15px;'>
		<?if($myU->PowerAdmin == "true"){
			echo"
			<a href='http://avatar-gamer.ga/Groups/Group.aspx?ID=".$ID."?&modgroupname=t'>
				Scrub Name
			</a> |
			<a href='http://avatar-gamer.ga/Groups/Group.aspx?ID=".$ID."?&modgroupdesc=t'>
				Scrub Description
			</a> |
			<a href='http://avatar-gamer.ga/Groups/Group.aspx?ID=".$ID."?&modgrouplogo=t'>
				Scrub Logo
			</a> 
			<br /><br />
			";
		}?>
		<table cellspacing='0' cellpadding='0' style='padding-bottom:10px;width:100%;'>
			<tr>
				<td>
					<?if($Group->Logo){
						echo"
						<img src='http://avatar-gamer.ga/Groups/GL/".$Group->Logo."' height='150' width='150'>
						";
					}else{
						echo"
						<img src='http://avatar-gamer.ga/Groups/GL/deleted.png' height='150' width='150'>
						";
					}?>
				</td>
				<td style='width:50px;'>
					&nbsp;
				</td>
				<td style='text-align:top;width:100%;' valign='top'>
					<h1 style='font-weight:normal;'>
						<?echo"".$Group->Name."";?>
						<?if($User && !$InGroup && $Group->RequestToJoin != "1"){
							echo"
							<div style='float:right;'>
								<a href='#' class='btn-primary' style='font-size:14px;letter-spacing:1px;'>Join Group</a>
							</div>
							";
						}elseif($User && !$InGroup && $Group->RequestToJoin == "1"){
							echo"
							<div style='float:right;'>
								<a href='#' class='btn-primary' style='font-size:14px;letter-spacing:1px;'>Request to Join</a>
							</div>
							";
						}elseif($InGroup){
							echo"
							<div style='float:right;'>
								<a href='#' class='btn-primary' style='font-size:14px;letter-spacing:1px;'>Leave Group</a>
							</div>
							";
						}?>
					</h1>
					<?echo"".$Group->Description."";?>
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td>
					Owned by: <a href='http://avatar-gamer.ga/user.aspx?ID=<?echo"".$fO->ID."";?>' style='font-size:13px;'><?echo"".$fO->Username."";?></a>
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td>
					Total Members: <?echo"".$Group->GroupMembers."";?>
				</td>
			</tr>
		</table>
		<div class='divider-bottom' style='width:100%;'></div>
	</div>
<?
	$DelName = SecurePost($_GET['modgroupname']);
	$DelDesc = SecurePost($_GET['modgroupdesc']);
	$DelLogo = SecurePost($_GET['modgrouplogo']);
	if($myU->PowerAdmin == "true"){
		if($DelName == "t"){
			mysql_query("UPDATE Groups SET Name='[ Moderated Content ".$Group->ID." ]' WHERE ID='".$Group->ID."'");
		}
		if($DelDesc == "t"){
			mysql_query("UPDATE Groups SET Description='[ Moderated Content ]' WHERE ID='".$Group->ID."'");
		}
		if($DelLogo == "t"){
			mysql_query("UPDATE Groups SET Description='deleted.png' WHERE ID='".$Group->ID."'");
		}
	}
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>