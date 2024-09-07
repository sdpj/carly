<?php
include($_SERVER['DOCUMENT_ROOT']."/Header.php");
$Setting = array(
	"PerPage" => 18
);
$Page = $_GET['Page'];
if ($Page < 1) { $Page=1; }
if (!is_numeric($Page)) { $Page=1; }
$Minimum = ($Page - 1) * $Setting["PerPage"];
//for
$getall = mysql_query("select * from UserStore");
$all = mysql_num_rows($getall);
//query
$allusers = mysql_query("SELECT * FROM Games ORDER BY ID DESC");
$num = mysql_num_rows($allusers);
$i = 0;
$Num = ($Page+8);
$a = 1;
$Log = 0;
?>
<?
echo "
			<form action='' method='POST'>

<table cellspacing='0' cellpadding='0' width='100%'>
	<tr>
		<td width='50%'>
		<div id='LargeText'>
			Games
		</div>	
		</td>
		<td>
				<table cellspacing='0' cellpadding='0'>
					<tr>
						<td>
							<input type='text' name='q' style='width:200px;'>
						</td>
						<td>
							<input type='submit' name='s' value='Search'>
						</td>
					</tr>
				</table>
		</td>
	</tr>
</table>
<table cellspacing='0' cellpadding='0' width='100%'><tr><td valign='top'>
<table width='98%'>
	<tr>
		<td width='40%'>
			";
			if($User) { if($myU->PowerArtist == "false") { echo "<a href='../Store/GameUpload.php/'>Upload Game</a>"; } else
			echo "
				<a href='../Store/GameUpload.php/'>Upload Game</a>
			<br />
			";
			}
			echo "
				<table>
					<tr>
											</tr>
				</table>
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
			
				$getItems = mysql_query("SELECT * FROM Games WHERE Active='1' AND itemDeleted='0' ORDER BY ID DESC LIMIT {$Minimum},  ". $Setting["PerPage"]);
			
			}
			elseif ($s) {
			
				$getItems = mysql_query("SELECT * FROM Games  WHERE Name LIKE '%$q%' AND Active='1' AND itemDeleted='0' ORDER BY ID DESC");
			
			}
			}
			else {
			$getItems = mysql_query("SELECT * FROM Games WHERE Active='1' AND itemDeleted='0' AND Type='$Sort' ORDER BY ID DESC LIMIT {$Minimum},  ". $Setting["PerPage"]);
			}
	
		$counter = 0;
	
		while ($gI = mysql_fetch_object($getItems)) {
		
			$counter++;
		
			$getCreator = mysql_query("SELECT * FROM Users WHERE ID='".$gI->CreatorID."'");
			$gC = mysql_fetch_object($getCreator);
		
			echo "
			
			<td style='font-size:11px;' align='left' width='100' valign='top'><a href='/Store/Game.php?ID=".$gI->ID."' border='0' style='color:black;'>
				<div style='border:1px solid #ccc;border-radius:5px;padding:5px;'>
					<img src='/Store/Dir/".$gI->File."' width='100' height='200'>
				</div>
				IP:<b>".$gI->Name."</b></a>
				<br />
				<font style='font-size:10px;'>Hoster: <a href='/User.php?Profile=".$gC->Username."'>".$gC->Username."</a>
				<br />
				<font color='green'><b>Port: ".$gI->Price."</b></font>
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
echo '<a href="?Page='.($Page-1).'">Prev</a> - ';
}
echo ''.$Page.'/'.(ceil($num / $Setting["PerPage"]));
if ($Page < ($amount)) {
echo ' - <a href="?Page='.($Page+1).'">Next</a>';
}
include($_SERVER['DOCUMENT_ROOT']."/Footer.php");
?>