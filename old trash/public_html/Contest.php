<?php

include "Header.php";
$getContent = mysql_query("SELECT * FROM Contest WHERE ID='1'");
$submit = $_POST['enter'];
$link = $_POST['link'];
$leave = $_POST['leave'];
$gC = mysql_fetch_object($getContent);
$getContestMembers = mysql_query("SELECT * FROM ContestMembers ");
$userExist = mysql_query("SELECT * FROM ContestMembers WHERE Username='$myU->Username'");
$userExist = mysql_num_rows($userExist);
echo " 
<br />
<font size='4'>Current Contest </font><br /><br />
<font size='3'><font color='blue'><b>Contest: $gC->title </b></font></font><br />
<font size='2'>Judges: Rachel , Transcendent , Ryanzxc4<br /><br />
<font size='1'><font color='red'><b>Contest Expiration: 5/1/2013<br />
Theme: Any type of item<br />
Only submit one item if you don't like your item delete it and enter a new item into the contest</font></font><br /><br />
<font size='3'>Contest Details</font>
<div style='border:1px solid black;width:30%;'><br />
$gC->desc<br /><br /></div><br /><br />
";
if ($myU->Username == "") { echo"<font color='red'>You're banned from this contest</font>"; }
elseif ($myU->Contest == 0) { echo"
<form action='' method='post'>
<input type='submit' name='enter' value='Enter Contest' id='buttonsmall'><br />
<b>Contest item link: </b><input type='input' name='link'>
</form>"; }if ($myU->Contest == 1){ echo"<form action='' method='post'><input type='submit' name='leave' value='Leave Contest' id='buttonsmall'></form>"; }  echo "<br /><br />
<font size='3'>Contest Members</font>
<div style='border:1px solid black;width:60%;'><br />
";


while ($gcM = mysql_fetch_object($getContestMembers)) {

echo "<font size='3'> $gcM->Username :<a href='$gcM->Link'><font color='blue'> $gcM->Link </font></font></a><br />"; } 

echo"<br /><br />";if ($submit) {
if (!$link) { echo"<font color='red'>Please provide a link</font>"; } 
else  {
mysql_query("INSERT INTO ContestMembers (Username, Link) VALUES ('$myU->Username','$link')"); mysql_query("UPDATE Users SET Contest='1' WHERE Username='$myU->Username'"); header("Location: /Contest.php"); } }
if ($leave) {
mysql_query("UPDATE Users SET Contest='0' WHERE Username='$myU->Username'"); mysql_query("DELETE From ContestMembers WHERE Username='$myU->Username'"); header("Location: /Contest.php");
}


?>


