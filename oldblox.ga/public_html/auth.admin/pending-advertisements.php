<?php
	include($_SERVER['DOCUMENT_ROOT'].'/auth.admin/admin-header.php');
$getAds = mysql_query("SELECT * FROM UserAdvertisments WHERE Approved='0'");
$numAds = mysql_num_rows($getAds);
$Expire = time()+86400; 

	echo"
	<div id='StandardBoxHeader'>
		Pending Advertisements
	</div>
	<div id='StandardBox'>

	";
	if($numAds == 0){
		echo"No advertisements awaiting moderation";
	}
	

$counter++;


echo"<table><tr>";
while($gA= mysql_fetch_object($getAds)) {
$getSender = mysql_query("SELECT * FROM Users WHERE ID='$gF->SenderID'");
$gS = mysql_fetch_object($getSender);
$counter++;
echo"

<td width='100'>
<center><img src='https://world2build.net/Advertising/Dir/$gA->Image' height='80' width='500'>
<br><a href='pending-advertisements.aspx?Accept=true&ID=$gA->ID'><font color='green'><b>Accept Image</b></font></a>
<br><a href='pending-advertisements.aspx?Deny=true&ID=$gA->ID'><font color='red'><b>Deny Image</b></font></a>
<br><a href='pending-advertisements.aspx?Moderate=true&ID=$gA->ID'><font color='blue'><b>Deny and Moderate</b></font></a>


</center>
</td>
 
";
if($counter > 2) {
echo"</tr><tr>";
$counter = 0;
}

}
echo"</tr></table>";
	echo"</div>";
	$Accept = SecurePost($_GET['Accept']);
	$Deny = SecurePost($_GET['Deny']);
	$Moderate = SecurePost($_GET['Moderate']);
	$ID = SecurePost($_GET['ID']);
	if($Accept == "true") {
	mysql_query("UPDATE UserAdvertisments SET Running='1',Approved='1',Expire='$Expire' WHERE ID='$ID'");
	header("Location: pending-advertisements.aspx");
	die();
	}
	if($Deny == "true") {
	mysql_query("UPDATE UserAdvertisments SET Running='0',Approved='1',Image='deniedimage.jpg' WHERE ID='$ID'");
	header("Location: pending-advertisements.aspx");
	die();
	}
	if($Moderate == "true") {
	mysql_query("UPDATE UserAdvertisments SET Running='0',Approved='1',Image='deniedimage.jpg' WHERE ID='$ID'");
	$getAd = mysql_query("SELECT * FROM UserAdvertisments WHERE ID='$ID'");
	$gA= mysql_fetch_object($getAd);
	
	header("Location: mod-user.aspx?ID=$gA->UserID");
	die();
	}
	?>