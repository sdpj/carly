<?php


require_once("Header.php");

if ($myU->PowerMegaModerator != "true") {
header("Location: index.php"); exit();
}

echo "<br /><br /> <b>Search a group</b>
<br />
<br />

<form action='' method='post'>
<b>Name:</b> <input type='text' name='k' style='width:25%;' placeholder='Group name here'>
<br />
<input type='submit'name='submit' value='Find'>
</form>
";

$k = $_POST['k'];
$Submit = $_POST['submit'];


if ($Submit) { 
$getGroup = mysql_query("SELECT * FROM Groups WHERE Name LIKE '%$k%' LIMIT 6 ");

while ($mG = mysql_fetch_object($getGroup)) {
echo "
<div style='border:1px solid black;background-color:lightgrey;'>
<table width='900'>
<tr>
<td width='400'>
<a href='ManageGroup.php?ID=$mG->ID'>$mG->Name</a>
<td width='500'>
</b>$mG->Description
</td>
</tr>
</table>
</div>
<br />
";

}
}
