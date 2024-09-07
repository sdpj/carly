<?php
include($_SERVER['DOCUMENT_ROOT'].'/auth.admin/admin-header.php');
$getReports = mysql_query("SELECT * FROM Reports ORDER BY ID DESC LIMIT 5");
$numReports = mysql_num_rows($getReports);
echo"
	
<div id='StandardBoxHeader'>Website Abuse Reports</div><div id='StandardBox'><div align='left'><div id='admintopbar'>";
if($numReports > 0) {
echo"
<font size='4'>There are <font color='red'>$numReports</font> reports awaiting action.</font><br><br>
<table width='1000px'>
<tr>
<td width='200px'><center><b>User Reported</b></center></td>
<td width='200px'><center><b>Sent By</b></center></td>
<td width='200px'><center><b>Offensive Content</b></center></td>
<td width='200px'><center><b>Comment</b></center></td>
<td width='200px'><center><b>Category</b></center></td>
</tr>
</table>
";
}
else {
echo"
No Reports awaiting action.";		
}
while($gR = mysql_fetch_object($getReports)) {
$getUserWhoSent = mysql_query("SELECT * FROM Users WHERE ID='$gR->UserWhoSent'");
$gUWS = mysql_fetch_object($getUserWhoSent);
$getUserReported = mysql_query("SELECT * FROM Users WHERE ID='$gR->UserReported'");
$gUR = mysql_fetch_object($getUserReported);
echo"
<hr style='border: none; height: 1px; color: grey; background: lightgrey;'/>

<table width='1000px'>
<tr>
<td width='200px'><center><a href='manage-user.aspx?ID=$gR->UserReported'><img src='http://avatar-gamer.ga/Avatar.php?ID=$gR->UserReported'><br>$gUR->Username</a></center></td>
<td width='200px'><center><a href='manage-user.aspx?ID=$gR->UserWhoSent'><img src='http://avatar-gamer.ga/Avatar.php?ID=$gR->UserWhoSent'><br>$gUWS->Username</center></td>
<td width='200px'><center>$gR->Content</center></td>
<td width='200px'><center>$gR->Comment</center></td>
<td width='200px'><center>$gR->Category</center></td>
</tr>
</table>
<center><a href='view-reports.aspx?Action=BanOffender&ID=$gR->ID'><b>Moderate Offender</b></a> | <a href='view-reports.aspx?Action=BanSender&ID=$gR->ID'><b>Moderate Sender</b></a> | <a href='view-reports.aspx?Action=Close&ID=$gR->ID'><b>Close Report</b></a></center>
";
$Action = SecurePost($_GET['Action']);
$ID = SecurePost($_GET['ID']);

if($Action == "BanOffender") {
$getReport = mysql_query("SELECT * FROM Reports WHERE ID='$ID'");
$gR = mysql_fetch_object($getReport);
if($gR->Type == "ForumPost") {
mysql_query("UPDATE Threads SET Title='[ Moderated Content ]',Body='[ Moderated Content ]' WHERE ID='$gR->ItemID'");
}
if($gR->Type == "ForumReply") {
mysql_query("UPDATE Replies SET Body='[ Moderated Content ]' WHERE ID='$gR->ItemID'");
}

mysql_query("DELETE FROM Reports WHERE Type='$gR->Type' AND UserReported='$gR->UserReported'");
$Content1 = str_replace('"', "", $gR->Content);
$Content2 = str_replace("'", "", $Content1);
header("Location: mod-user.aspx?ID=$gR->UserReported&badcontent=$Content2");
die();	
}

if($Action == "BanSender") {
$getReport2 = mysql_query("SELECT * FROM Reports WHERE ID='$ID'");
$gRR2 = mysql_fetch_object($getReport2);
mysql_query("DELETE FROM Reports WHERE ID='$ID'");
header("Location: mod-user.aspx?ID=$gRR2->UserWhoSent");
die();	
}
if($Action == "Close") {
mysql_query("DELETE FROM Reports WHERE ID='$ID'");
header("Location: view-reports.aspx");
die();	
}

}







echo"</div>";
?>