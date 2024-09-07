<?php 
include "Header.php";
$ID = $_GET['ID'];
$getItem = mysql_query("SELECT * FROM Threads WHERE ID='$ID'");
$gI = mysql_fetch_object($getItem);
$getUser = mysql_query("SELECT * FROM Users WHERE ID='$gI->PosterID'");
$gU = mysql_fetch_object($getUser);

?>
<?php
echo "
<center>
<div style='border:1px solid black;width:500px;'>

<center> <b><font color='red'><font size='3'>Reporting post by $gU->Username</b></font></font><br /><br /><b>Title:</b> $gI->Title <br /> <b>Body:</b> $gI->Body <br />
<br />
</center>
<br /><br />
<form action='' method='post'>
Please include a brief description why you are reporting
<textarea name='Report' rows='4' cols='40'></textarea>
<br /><br /><input type='submit' name='Send' value='Send Report'><br /><br />
</form>


<br /><br />
</center></div>"; ?>

<?php 
$UserName = $_GET['Username'];
$date = date("D, M, Y");
$Reporter = $myU->Username;
$Submit = $_POST['Send'];
$Reporting = $_POST['Report'];



if($Submit) {
mysql_query("INSERT INTO ForumReports (UserWhoSent, UserReported, Date, Report, Body , Title ) VALUES ('$Reporter','$gU->Username','$date','$Reporting','$gI->Body','$gI->Title')") ;
} if (!Reporting) { echo " Include text in your report"; }

?>
<?php
include "Footer.php";
?>