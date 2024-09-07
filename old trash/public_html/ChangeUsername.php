<?php
include ("Header.php");
$ID = $_GET['ID'];

if ($myU->Username != "Bailey") {
header("Location: index.php"); exit();
}

echo " 


<form action='' method='post'>

New Username: <input type='input' name='Name'>
<input type='submit' name='submit' Value='Submit'>
</form>
<br />
<font color='red'>This may not be done with user request </font>

"; 
$submit = $_POST['submit'];
$Name = $_POST['Name'];
if ($submit) { mysql_query("UPDATE Users SET Username='$Name' WHERE ID='$ID'"); 

header("Location: /index.php");

exit();

}


include ("Footer.php");
?>