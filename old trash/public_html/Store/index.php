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
$getall = mysql_query("select * from Items");
$all = mysql_num_rows($getall);
//query

$allusers = mysql_query("SELECT * FROM `Items` WHERE `itemDeleted`='0' ORDER BY ID DESC");
$num = mysql_num_rows($allusers);
$i = 0;
$Num = ($Page+8);
$a = 1;
$Log = 0;
echo "
<center>	<form action='' method='POST'>
				<b>Search Item: </b><input type='text' name='q' style='width:25%;'>
			
				<input type='submit' name='s'  value='Search'>
				</form>
				</center>
<table cellspacing='0' cellpadding='0' width='100%'><tr><td valign='top'>

<table width='95%'>
	<tr>
		<td width='40%'>
			";
			if ($myU->PowerArtist == "true") {
			echo "
			
				

			</div>
			<div id='aB'>
			<b>Asset Upload: </b>
				<a href='../Store/StoreUpload.php'>Upload Item</a>
			</div>
			<br />
			";
			}
			echo "
			
				
			</div>
			<div id='SeeWrap'>
				<div id='aB'>
					
				
			
			
			<br />
			<div id='SeeWrap'>
				<div id='ProfileText'>
				Sort Items
				</div>
				<div align='left'>
				&nbsp; <a href='?all' style='font-weight:bold;color:black;'>All</a>
				<br />
				 &nbsp; <a href='?Sort=Eyes' style='font-weight:bold;color:black;'>Eyes</a> 
				<br />
				 &nbsp; <a href='?Sort=Mouth' style='font-weight:bold;color:black;'>Mouths</a>
				<br />
				 &nbsp; <a href='?Sort=Hair' style='font-weight:bold;color:black;'>Hair</a>
				<br />
				 &nbsp; <a href='?Sort=Bottom' style='font-weight:bold;color:black;'>Pants</a>
				<br />
				 &nbsp; <a href='?Sort=Top' style='font-weight:bold;color:black;'>Shirts</a>
				<br />
				 &nbsp; <a href='?Sort=Hat' style='font-weight:bold;color:black;'>Hats</a>
				<br />
				 &nbsp; <a href='?Sort=Shoe' style='font-weight:bold;color:black;'>Shoes</a>
				<br />
				 &nbsp; <a href='?Sort=Accessory' style='font-weight:bold;color:black;'>Accessories</a>
				<br />
				 &nbsp; <a href='?Sort=Background' style='font-weight:bold;color:black;'>Backgrounds</a>
				<br />
				 &nbsp; <a href='?Sort=Limiteds' style='font-weight:bold;color:black;'>Limiteds</a>
				<br /><br />
				<br /><br />
				<div id='ProfileText'>
				Price Range
				</div>
				<form action='' method='GET'>
				<b>Min: </b><input type='text' name='min' style='width:110px;'>
				<br />
				<b>Max:</b><input type='text' name='max' style='width:110px;'>
				<br /><br />
				<input type='submit' name='' id='buttonsmall'>
				</form>
			</div>
		</td>
	</tr></div>
</table>
</td><td align='center'>

";

echo "<center><table><tr>";
	
	
		$q = mysql_real_escape_string(strip_tags(stripslashes($_POST['q'])));
		$s = mysql_real_escape_string(strip_tags(stripslashes($_POST['s'])));
		$pricemin = mysql_real_escape_string(strip_tags(stripslashes($_GET['min'])));
		$pricemax = mysql_real_escape_string(strip_tags(stripslashes($_GET['max'])));
		
			if (!$s && !$pricemin && !$pricemax) {
			
				$getItems = mysql_query("SELECT * FROM Items WHERE itemDeleted='0' ORDER BY UpdateTime DESC LIMIT {$Minimum},  ". $Setting["PerPage"]);
			
			}
			elseif ($s) {
			
				$getItems = mysql_query("SELECT * FROM Items WHERE Name LIKE '%$q%' AND itemDeleted='0' ORDER BY ID DESC");
			
			}
			
			$Sort = mysql_real_escape_string(strip_tags(stripslashes($_GET['Sort'])));
			
			if ($Sort) {
			
				$getItems = mysql_query("SELECT * FROM Items WHERE Name LIKE '%$q%' AND itemDeleted='0' AND Type='$Sort' ORDER BY ID DESC");
				
			}
			if($Sort=='Limiteds')
			{
				$getItems = mysql_query("SELECT * FROM Items WHERE Name LIKE '%$q%' AND itemDeleted='0' AND saletype='limited' ORDER BY ID DESC");
			}
			if($pricemin && $pricemax)
			{
			if(is_numeric($pricemin) && is_numeric($pricemax)){}else{echo "<script>alert('Your minimum and max prices must be numbers only');</script>"; return false;}
			if($pricemin < $pricemax){}else{echo "<script>alert('Your max price must be greater than your minimum');</script>"; return false;}
			if($pricemin >= 0 && $pricemax >= 0){}else{echo "<script>alert('Your minimum and max prices must be greater than or equal to 0');</script>"; return false;}
			$getItems = mysql_query("SELECT * FROM Items WHERE itemDeleted='0' AND saletype!='limited' AND Price>=$pricemin AND Price<=$pricemax ORDER BY ID DESC");
			}
	
		$counter = 0;
		$total_counter = 0;
		
		if(mysql_num_rows($getItems) < 1)
		{
		echo "No ".$Sort." to display";
		}
	


echo "<center><table><tr>";
	
	
		$q = mysql_real_escape_string(strip_tags(stripslashes($_POST['q'])));
		$s = mysql_real_escape_string(strip_tags(stripslashes($_POST['s'])));
		
			if (!$s) {
			
				$getItems = mysql_query("SELECT * FROM Items WHERE itemDeleted='0' ORDER BY ID DESC LIMIT {$Minimum},  ". $Setting["PerPage"]);
			
			}
			elseif ($s) {
			
				$getItems = mysql_query("SELECT * FROM Items WHERE Name LIKE '%$q%' AND itemDeleted='0' ORDER BY ID DESC");
			
			}
	echo" 	";
		$counter = 0;

		while ($gI = mysql_fetch_object($getItems)) {
		
			$counter++;
		
			$getCreator = mysql_query("SELECT * FROM Users WHERE ID='".$gI->CreatorID."'");
			$gC = mysql_fetch_object($getCreator);
		
			echo "
			
			<td style='font-size:13px;' align='left' width='100' valign='top'><a href='Item.php?ID=".$gI->ID."' border='0' style='color:black;'>
				<div style='border:1px solid #ccc;border-radius:0px;padding:5px;'>
				";
				if ($gI->saletype == "limited") {
				echo "
					
					<div style='width: 100px; height: 200px; z-index: 3;  background-image: url(../Store/Dir/".$gI->File.");'>
					<div style='width: 100px; height: 200px; z-index: 3;  background-image: url(/Images/limitedu.png);'>
					</div></div>
				";
				}
				else {
					echo "<img src='../Store/Dir/".$gI->File."' width='100' height='200'>";
				}
				echo "
				</div>

				<b><font color='blue'>".$gI->Name."</font></b>
				</a>
				<br />
				<font style='font-size:10px;'>Creator: <a href='/user.php?ID=".$gC->ID."'>".$gC->Username."</a>
				<br />
                                <font style='font-size:10px;'>Created: $gI->CreationTime <br />
                                <font style='font-size:10px;'>Type: &nbsp;&nbsp;&nbsp;&nbsp;$gI->Type <br />
				";
				if ($gI->sell == "yes") {
				if ($gI->saletype == "limited" && $gI->numberstock == "0") {
				echo "Was:
				<font color='green'><b>".$gI->Price." BUX</b></font>
				";
				}
				else {
				echo "Price:
				<font color='green'><b>".$gI->Price." BUX</b></font>
				";
				}
				}
				echo "
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
echo '<a href="Store.php?Page='.($Page-1).'">Prev</a> - ';
}
echo ''.$Page.'/'.(ceil($num / $Setting["PerPage"]));
if ($Page < ($amount)) {
echo ' - <a href="Store.php?Page='.($Page+1).'">Next</a>';
}
include($_SERVER['DOCUMENT_ROOT']."/Footer.php");
?>