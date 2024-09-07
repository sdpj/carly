<?php
include "Header.php";
?>
<style type="text/css">
.btn {
	padding-left: 15px;
	padding-right: 15px;
	padding-top: 5px;
	padding-bottom: 5px;
	border: 1px solid #424F47;
	background-color: #DFDFDF;
	color: #000;
	box-shadow: inset 0px -5px 10px 0px rgba(204,204,204,1);
}
.btn a:hover {
	text-decoration: none;
}
.btn:hover {
	background-color: #FFF;
	border: 1px solid #999;
	box-shadow: inset 0px -5px 10px 0px rgba(204,204,204,1);
}
</style>
<?php
$Setting = array(
	"PerPage" => 15
);
$PerPage = 12;
$Page = mysql_real_escape_string(strip_tags(stripslashes($_GET['Page'])));
if ($Page < 1) { $Page=1; }
if (!is_numeric($Page)) { $Page=1; }
$Minimum = ($Page - 1) * $Setting["PerPage"];
//query
$num = mysql_num_rows($allusers = mysql_query("SELECT * FROM PMs WHERE `status`='0' AND SenderId='$myU->ID' ORDER BY ID"));
$PMs = mysql_num_rows($allusers = mysql_query("SELECT * FROM PMs WHERE SenderID='$myU->ID' ORDER BY ID"));
$Num = ($Page+8);

	if (!$User) {
	
		header("Location: index.php");
		exit;
	
	}
	
	echo "
	<div id='LargeText'>
		 Sent Messages (".$PMs.")
	</div>
	<center>
";
$amount=ceil($num / $Setting["PerPage"]);
if ($Page > 1) {
echo '<a href="Sent.php?Page='.($Page-1).'">Prev</a> - ';
}
echo ''.$Page.'/'.(ceil($num / $Setting["PerPage"]));
if ($Page < ($amount)) {
echo ' - <a href="Sent.php?Page='.($Page+1).'">Next</a>';
}
?>	</center>
	
					
					<a href="inbox.php" class="btn"><font color='black'><b>Inbox</b></font></a>&nbsp;
					<a href="Archive.php" class="btn"><font color='black'>Archive</font></a>&nbsp;
					<a href="Trash.php" class="btn"><font color='black'>Trash</font></a>&nbsp;
                    
                    <a href="#" class="btn"><font color='darkGray'>Sent Mail</font></a><b>
		<?php

		echo "
		<div style='border-bottom:1px solid #ddd;width:99%;'></div>
		";
		
			
			//while loop
			$getPMs1 = mysql_query("SELECT * FROM PMs WHERE SenderID='$myU->ID' ORDER BY ID DESC LIMIT {$Minimum},  ". $Setting["PerPage"]);
			while ($gP = mysql_fetch_object($getPMs1)) {
			
				?>
		<table cellspacing='0' cellpadding='0' id='aBForum' style='border-top:0;font-size:10pt;padding:10px;' width='99%'>
			<tr>
				<td style='width:50px;'>
					
				</td>
				<td style='width:200px;'>
					<?php
					$getSender = mysql_query("SELECT * FROM Users WHERE ID='".$gP->ReceiveID."'");
					$gS = mysql_fetch_object($getSender);
					echo "
					To: <a href='../user.php?ID=$gS->ID'>".$gS->Username."</a>
				</td>
				<td style='width:600px;'>
				";
				if ($gP->LookMessage == "0") {
				$Title = "<a href='http://Gravitar.net/ViewSentMessage.php?ID=$gP->ID' style=''>$gP->Title</a>";
				}
				else {
				$Title = "<a style='font-weight:normal;' href='http://Gravitar.net/ViewSentMessage.php?ID=$gP->ID' style=''>$gP->Title</a>";
				}
				echo "
				$Title
				</td>
				<td>
					";
					$Display1 = date("F j, Y",$gP->time);
					$Display2 = date("g:iA",$gP->time);
					echo "
					$Display1 $Display2
				</td>
			</tr>
		</table>
				";
			
			}
		
		echo "
		<center>
		";
$amount=ceil($num / $Setting["PerPage"]);
if ($Page > 1) {
echo '<a href="http://Gravitar.net/Inbox/?Page='.($Page-1).'">Prev</a> - ';
}
echo ''.$Page.'/'.(ceil($num / $Setting["PerPage"]));
if ($Page < ($amount)) {
echo ' - <a href="http://Gravitar.net/Inbox/?Page='.($Page+1).'">Next</a>';
}
		echo "
	</center>
	";
include "Footer.php";
