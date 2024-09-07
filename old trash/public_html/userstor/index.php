<?php
include($_SERVER['DOCUMENT_ROOT']."/Header.php");
$Setting = array(
	"PerPage" => 12
);
$Page = $_GET['Page'];
if ($Page < 1) { $Page=1; }
if (!is_numeric($Page)) { $Page=1; }
$Minimum = ($Page - 1) * $Setting["PerPage"];
//for
$getall = mysql_query("select * from UserStore");
$all = mysql_num_rows($getall);
//query
if ($_GET['Sort']){
	$Sort = mysql_real_escape_string($_GET['Sort']);
	if ($Sort == "Top" || $Sort == "Bottom" || $Sort == "Eyes" || $Sort == "Hat" || $Sort == "Mouth" || $Sort == "Accessory" || $Sort == "Background" || $Sort == "Shoe"){
$allusers = mysql_query("SELECT * FROM UserStore WHERE `Type`='$Sort' ORDER BY ID DESC");
	}else{
		$allusers = mysql_query("SELECT * FROM UserStore ORDER BY ID DESC");
	}
}else{
	$allusers = mysql_query("SELECT * FROM UserStore ORDER BY ID DESC");
}
$num = mysql_num_rows($allusers);
$i = 0;
$Num = ($Page+8);
$a = 1;
$Log = 0;
echo "
<table cellspacing='0' cellpadding='0' width='100%'><tr><td valign='top'>
<table width='98%'>
	<tr>
		<td width='40%'>
			";
			if ($myU->Rank >= 0) {
			echo "
			<b>
				Upload Item</b>
			</div>
			<div id='aB'>
				<a href='UserUpload.php'>Upload Item</a>
			</div>
			<br />
			";
			}
			echo "
			<b>
				Search</b>
			</div>
			<div id='aB'>
				<form action='' method='POST'>
				<input type='text' name='q'>
				<br />
				<input type='submit' name='s' value='Search'>
				</form>
			</div>
			<br />
			<b>
				Sort Items</b>
			</div>
			<div id='aB'>
				<div align='left'>
				<a href='/Store/UserStore.php?Sort=Eyes' style='font-weight:bold;color:black;'> &nbsp; Eyes</a> 
				<br />
				<a href='/Store/UserStore.php?Sort=Mouth' style='font-weight:bold;color:black;'> &nbsp; Mouths</a>
				<br />
				<a href='/Store/UserStore.php?Sort=Hair' style='font-weight:bold;color:black;'> &nbsp; Hair</a>
				<br />
				<a href='/Store/UserStore.php?Sort=Bottom' style='font-weight:bold;color:black;'> &nbsp; Pants</a>
				<br />
				<a href='/Store/UserStore.php?Sort=Top' style='font-weight:bold;color:black;'> &nbsp; Shirts</a>
				<br />
				<a href='/Store/UserStore.php?Sort=Hat' style='font-weight:bold;color:black;'> &nbsp; Hats</a>
				<br />
				<a href='/Store/UserStore.php?Sort=Shoe' style='font-weight:bold;color:black;'> &nbsp; Shoes</a>
				<br />
				<a href='/Store/UserStore.php?Sort=Accessory' style='font-weight:bold;color:black;'> &nbsp; Accessories</a>
			</div>
		</td>
		<td>
		
		</td>
	</tr>
</table>
</td><td align='center'>
";

echo "<center><table><tr>";
		$q = mysql_real_escape_string(strip_tags(stripslashes($_POST['q'])));
		$s = mysql_real_escape_string(strip_tags(stripslashes($_POST['s'])));
		$Sort = mysql_real_escape_string(strip_tags(stripslashes($_GET['Sort'])));
		
		
			if (!$Sort) {
		
			if (!$s) {
			
				$getItems = mysql_query("SELECT * FROM UserStore WHERE Active='1' AND itemDeleted='0' ORDER BY ID DESC LIMIT {$Minimum},  ". $Setting["PerPage"]);
			
			}
			elseif ($s) {
			
				$getItems = mysql_query("SELECT * FROM UserStore  WHERE Name LIKE '%$q%' AND Active='1' AND itemDeleted='0' ORDER BY ID DESC");
			
			}
			}
			else {
			$getItems = mysql_query("SELECT * FROM UserStore WHERE Active='1' AND itemDeleted='0' AND Type='$Sort' ORDER BY ID DESC LIMIT {$Minimum},  ". $Setting["PerPage"]);
			}
	
		$counter = 0;
	
		while ($gI = mysql_fetch_object($getItems)) {
		
			$counter++;
		
			$getCreator = mysql_query("SELECT * FROM Users WHERE ID='".$gI->CreatorID."'");
			$gC = mysql_fetch_object($getCreator);
		
			echo "
			
			<td style='font-size:11px;' align='left' width='100' valign='top'><a href='UserItem.php?ID=".$gI->ID."' border='0' style='color:black;'>
				<div style='border:1px solid #ccc;border-radius:5px;padding:5px;'>
					<img src='/Store/Dir/".$gI->File."' width='100' height='200'>
				</div>
				<b>".$gI->Name."</b></a>
				<br />
				<font style='font-size:10px;'>Creator: <a href='/user.php?ID=".$gC->ID."'>".$gC->Username."</a>
				<br />
				<font color='purple'><b>BUX: ".$gI->Price."</b></font>
			</td>
			
			";
			
			if ($counter >= 6) {
			
				echo "</tr><tr>";
				
				$counter = 0;
			
			}
		
		}

		echo "</tr></table></td></tr></table><center>";
		$amount=ceil($num / $Setting["PerPage"]);
if ($Page > 1) {
echo '<a href="UserStore.php?Page='.($Page-1).'">Prev</a> - ';
}
echo ''.$Page.'/'.(ceil($num / $Setting["PerPage"]));
if ($Page < ($amount)) {
echo ' - <a href="UserStore.php?Page='.($Page+1).'">Next</a>';
}
include($_SERVER['DOCUMENT_ROOT']."/Footer.php");
?>