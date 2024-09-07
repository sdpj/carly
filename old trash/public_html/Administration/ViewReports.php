<?php
include "Header.php";
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {

	echo "
	
		Reports
	</div>
	
	";
	if ($NumR == "0") {
	
		echo "There are no reports to show.";
	
	}
	else {
		$Query = mysql_query("SELECT * FROM Reports ORDER BY ID DESC");
		while ($R = mysql_fetch_object($Query)) {
		
			echo "
			<table>
				<tr>
					<td width='500'>
						";
						$getF = mysql_query("SELECT * FROM Users WHERE ID='$R->OffenseID'");
						$gF = mysql_fetch_object($getF);
						echo "
						<a href='../user.php?ID=$gF->ID' style='color:black;font-weight:bold;'>
						<br />".$gF->Username."
						</a>
					</td>
					<td valign='top'>
						".$R->Message."
						<br /><br /><br />
						on ".$R->Link."
						<br /><br /><br />
						<a href='ViewReports.php?ID=$ID&ReportID=$R->ID&Action=Ban' style='color:blue;font-weight:bold;'>Ban User</a> | <a href='?ReportID=$R->ID&Action=Close' style='color:blue;font-weight:bold;'>Close Report</a>
					</td>
				</tr>
			</table>
			";
			$ReportID = mysql_real_escape_string(strip_tags(stripslashes($_GET['ReportID'])));
			$Action = mysql_real_escape_string(strip_tags(stripslashes($_GET['Action'])));
			
				if ($Action == "Close") {
				
					mysql_query("DELETE FROM Reports WHERE ID='$ReportID'");
					header("Location: ViewReports.php");
				
				}
				if ($Action == "Ban") {
				
					mysql_query("DELETE FROM Reports WHERE ID='$ReportID'");
					header("Location: ../Administration/ModerateUser.php?ID=$gF->ID&badcontent=$R->Content");
				
				}
		
		}
	
	}
	echo "
	</div><br />
	";

}
else {

	header("Location: index.php");

}
include "Footer.php";