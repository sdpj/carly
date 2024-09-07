<?
	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
	$Setting = array(
	"PerPage" => 15
	);
	$PerPage = 12;
	$Page = mysql_real_escape_string(strip_tags(stripslashes($_GET['Page'])));
	if ($Page < 1) { $Page=1; }
	if (!is_numeric($Page)) { $Page=1; }
	$Minimum = ($Page - 1) * $Setting["PerPage"];
	//query
	$num = mysql_num_rows($allusers = mysql_query("SELECT * FROM PMs WHERE ReceiveID='$myU->ID' ORDER BY ID"));
	$Num = ($Page+8);
	if(!$User){
		header("Location: /Login.aspx/?redirect=/Account/inbox.aspx");
		die();
	}
?>
	<h1>My Messages</h1>
	<font style='font-size: 12px;'>
<?
	$amount=ceil($num / $Setting["PerPage"]);
	if ($Page > 1) {
	echo '<a href="/Account/inbox.aspx?Page='.($Page-1).'">Prev</a> - ';
	}
	echo 'Page '.$Page.' of '.(ceil($num / $Setting["PerPage"]));
	if ($Page < ($amount)) {
	echo ' - <a href="/Account/inbox.aspx?Page='.($Page+1).'">Next</a>';
	}
?>
	</font>
	<br>
	<br>
	<table cellspacing='0' cellpadding='0'>
		<tr>
			<td style='width:50px;'>
				<b>Action</b>
			</td>
			<td style='width:200px;'>
				<b>Sender</b>
			</td>
			<td style='width:600px;'>
				<b>Title</b>
			</td>
			<td style='width:150px'>
				&nbsp;<b>Date Sent</b>
			</td>
		</tr>
	</table>
	<div class='divider-top' stlye='width:100%;'></div>
<?
	$getPMs1 = mysql_query("SELECT * FROM PMs WHERE ReceiveID='$myU->ID' ORDER BY ID DESC LIMIT {$Minimum},  ". $Setting["PerPage"]);
	while ($gP = mysql_fetch_object($getPMs1)){
		echo"
		<table cellspacing='0' cellpadding='' id='aBForum' style='border-top:0;font-size:10px;padding-top:4px;padding-bottom:4px;' width='99%'>
			<tr>
				<td style='width:50px;'>
					<input type='checkbox' name='CheckBox' value='$gP->ID'>
				</td>
				<td style='width:200px;'>
					";
					$getSender = mysql_query("SELECT * FROM Users WHERE ID='".$gP->SenderID."'");
					$gS = mysql_fetch_object($getSender);
					if ($gP->LookMessage == "0") {
						echo"
						<a href='/user.aspx?ID=$gS->ID' style='color:#2E64FE;font-weight:bold;'>".$gS->Username."</a>
						";
					}else{
						echo"
						<a href='/user.aspx?ID=$gS->ID' style='color:##2E64FE;'>".$gS->Username."</a>
						";
					}
				echo"
				</td>
				<td style='width:600px;'>
				";
				if ($gP->LookMessage == "0") {
				$Title = "<a href='/Account/ViewMessage.aspx?ID=$gP->ID' style='color:#2E64FE;font-weight:bold;'>$gP->Title</a>";
				}
				else {
				$Title = "<a href='/Account/ViewMessage.aspx?ID=$gP->ID' style='color:#2E64FE;'>$gP->Title</a>";
				}
				echo "
				$Title
				</td>
				<td style='width:150px'>
					";
					$Display1 = date("M. j, Y",$gP->time);
					$Display2 = date("g:iA",$gP->time);
					echo "
				<b style='color:#2E64FE;'><center>$Display1 $Display2</center></b>
				</td>
			</tr>
		</table>
		";
	}
	echo"
	<br />
	<font style='font-size: 12px;'>
	";
	$amount=ceil($num / $Setting["PerPage"]);
	if ($Page > 1) {
	echo '<a href="/Account/inbox.aspx?Page='.($Page-1).'">Prev</a> - ';
	}
	echo 'Page '.$Page.' of '.(ceil($num / $Setting["PerPage"]));
	if ($Page < ($amount)) {
	echo ' - <a href="/Account/inbox.aspx?Page='.($Page+1).'">Next</a></font>';
	}
?>
<?
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>