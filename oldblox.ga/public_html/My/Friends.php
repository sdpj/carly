<?php
	include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
	
if(!$User){
header("Location: ");
die();
}
$ID = SecurePost($_GET['ID']);

$getUser = mysql_query("SELECT * FROM Users WHERE ID='$ID'");
$gU = mysql_fetch_object($getUser);
$checkExist = mysql_num_rows($getUser);
$getFriends = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$ID' AND Active='1'");
$numFriends = mysql_num_rows($getFriends);
echo"<div style='padding-left:40px;'>";
if($checkExist == 0) {
header("Location: /Error/?code=404");
die();
}
$counter = 0;


echo"<font size='5'>$gU->Username's Friends ($numFriends)</font><br>
<hr style='border: none; height: 1px; color: grey; background: lightgrey;'/>
";
if($numFriends == 0){
echo"<br>$gU->Username has not added anyone to his/her friends list.";
}
echo"<table><tr>";
while($gF= mysql_fetch_object($getFriends)) {
	$counter++;

$getSender = mysql_query("SELECT * FROM Users WHERE ID='$gF->SenderID'");
$gS = mysql_fetch_object($getSender);
echo"

<td width='100'>
<center><a href='/user.aspx?ID=$gF->SenderID'><img src='/Avatar.php?ID=$gF->SenderID' height='150px'><br>$gS->Username</a></center>
</td>
";
if($counter >= 10) {
echo"</tr><tr>";
$counter = 0;
}

}
echo"</tr></table>";

	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');