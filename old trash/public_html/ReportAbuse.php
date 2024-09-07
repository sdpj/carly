<?php 
include "Header.php";
$UserName = $_GET['Username'] or die ("Error fetching User");
?>
<?php
echo "
<center>
<div style='border:1px solid black;width:500px; height:70%;'>

<b><font color='darkred'>You are reporting <font color='red'>$UserName</font>. <br>Please make sure the reason you are reporting is valid.<br></font><br>
<b>Basic rules are:<br>
<li>No Cussing</li>
<li>No Sexual Content</li>
<li>No Dating</li>
<li>No Harassment</li>
<li>No Spamming</li>
<br>
<b>You can review our <a href='http://Gravitar.net/siterules.php'><font color='darkblue'>Terms of Service</font></a> for more of our rules.</b>
<br><br>

<center> <b>If you're proceeding, leave us a comment:</b>
<br /><br /></center>
<form action='' method='post'>
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
mysql_query("INSERT INTO UserReports (UserWhoSent, UserReported, Date, Report) VALUES ('$Reporter','$UserName','$date','$Reporting')") or die ("No Table Exsist");
} if (!Reporting) { echo " Include text in your report"; }

?>
<?php
include "Footer.php";
?>