<?php
include($_SERVER['DOCUMENT_ROOT']."/Header.php");
if (!$User) {
	
		header("Location: /index.php");


		exit;
	}
$getmessages = mysql_query("SELECT * FROM ChatRoom ORDER BY id");


echo " 


<html>
<head>
<title> Complains </title>
</head>
<font size='3'><b>Complaining</b> </font>
<br />
<br />
Provide reasons, and the staff you're complaining about.
<br />
<br /><div style='border:1px solid grey; background-color:white; width:50%; height:250px;overflow:auto;'>";
while ($gM = mysql_fetch_object($getmessages)) { echo "
<b><font color='green'>$gM->Username:</font></b> $gM->Text<br /> ";



}


echo"


</div>
<form action='' method='post'>
<textarea name='Chat' cols='59%' rows='4'></textarea><br />
<input type='submit' name='Send' value='Send' id='buttonsmall'>
</form>
</html>"; 



$Message = filter($_POST['Chat']);
$Send = $_POST['Send'];
$Username = $myU->Username;

if ($Send) { mysql_query("INSERT INTO ChatRoom (Username, Text) VALUES ('$Username', '$Message')"); header("Location: ../Complains/Complaining.php); } ;



?>




