<?php
	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
	
if(!$User){
header("Location: ");
die();
}

$getUser = mysql_query("SELECT * FROM Users WHERE ID='$myU->ID'");
$gU = mysql_fetch_object($getUser);
$checkExist = mysql_num_rows($getUser);
$getFriends = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$myU->ID' AND Active='0'");
$numFriends = mysql_num_rows($getFriends);
echo"<div style='padding-left:40px;'>";

$counter = 0;


$counter++;
echo"<font size='5'>Friend Requests ($numFriends)</font><br>
<hr style='border: none; height: 1px; color: grey; background: lightgrey;'/>
";
if($numFriends == 0){
echo"<br>You have no friend requests.";
}
echo"<table><tr>";
while($gF= mysql_fetch_object($getFriends)) {
$getSender = mysql_query("SELECT * FROM Users WHERE ID='$gF->SenderID'");
$gS = mysql_fetch_object($getSender);
$counter++;
echo"

<td width='100'>
<center><a href='/user.aspx?ID=$gF->SenderID'><img src='/Avatar.php?ID=$gF->SenderID' height='150px'><br>$gS->Username</a>
<br><a href='?action=accept&ID=$gF->ID'><font color='green'>Accept</font></a> | <a href='?action=decline&ID=$gF->ID'><font color='red'>Decline</font></a>
</td>

";
if($counter >= 10) {
echo"</tr><tr>";
$counter = 0;
}

}
echo"</tr></table>";
$action = SecurePost($_GET['action']);
if($action == "accept") {
$ID = SecurePost($_GET['ID']);
$getFr = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$myU->ID' AND ID='$ID'");
$gFr = mysql_fetch_object($getFr);
if($gFr->Active == "1"){
	header("Location: /Error/?code=404");
	die();
}else{
if($gFr->ReceiveID != $myU->ID) {
header("Location: FriendRequests.php");
die();
}
mysql_query("UPDATE FRs SET Active='1' WHERE ID='$ID'");
mysql_query("INSERT INTO FRs (SenderID, ReceiveID, BestFriend, Active) VALUES ('$myU->ID','$gFr->SenderID','0','1')");
header("Location: FriendRequests.php");
die();
}
}


if($action == "decline") {
$ID = SecurePost($_GET['ID']);
$getFr = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$myU->ID' AND ID='$ID'");
$gFr = mysql_fetch_object($getFr);
if($gFr->ReceiveID != $myU->ID) {
header("Location: FriendRequests.php");
}
mysql_query("DELETE FROM FRs WHERE ID='$ID'");
header("Location: FriendRequests.php");
die();
}
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>