<?php

include "Header.php";
if ($myU->PowerAdmin != "true") { 
header("Location: /index.php"); exit; }

echo" 
<center><font size='3'>Make Notice </center></font>

<center>
<br /><br /><form action='' method='post'>
<textarea name='Notice' cols='40' rows='10'></textarea>
<br /><br />
<input type='submit' name='Submit' value='Submit'>
</form>
";


$notice = $_POST['Notice'];
$Submit = $_POST['Submit'];
$Username = $myU->Username;
$currentnotice = mysql_query("SELECT * FROM Notice");
$getnotice = mysql_fetch_object($currentnotice);

if ($Submit) { mysql_query("UPDATE Notice SET Text='$notice' WHERE Text='$getnotice->Text'");
}



 ?> 