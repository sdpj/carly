<?php

include "Header.php";
$getAds =  mysql_query("SELECT * FROM RunningAds");
$numAds = mysql_num_rows($getAds);
if ($myU->PowerImageModerator == "true"){
echo "
  <center><font size='4'>Running Ads [Moderate] </font><br /><font size='1'>There are $numAds ads running</font></center>
  <hr width='70%'>
  <br /><br /><br />
";
  while($gA = mysql_fetch_object($getAds))  {
  
  echo "
  <table>
    <tr>
    <td>
    <b>Ad:</b>
    </td>
    <td>
  <img src='$gA->ImageLink'>
    </td>
</tr>
<tr>
<td>
<b>Name:</b>
</td>
<td>
$gA->Name
</td>
    </tr>
    <tr>
    <td>
   <b> Creater:</b>
   </td>
   <td>
   $gA->Username
   </td>
   </tr>
   <tr>
   <td>
   <b>Money Made:</b></td>
   <td>
   $gA->MoneyMade
   </td>

   </tr>
<tr>
<td><b>Advertisement URL:</b> 
   </td>
<td>
$gA->Link
</td>
</tr>
  <tr>
  <td><a href='?action=stoprunning&ID=$gA->ID'><font color='red'>Stop Running</font></a>
    </table>
    <br /><br />
    
    
    ";
	
$Action = $_GET['action'];
$ID = $_GET['ID'];

if ($Action == "stoprunning") {
    mysql_query("DELETE FROM RunningAds WHERE ID='$ID'");
    mysql_query("INSERT INTO Logs (UserID, Message) VALUES ('$myU->ID','Stopped Running $gA->Name Ad')");
    header('Location: /Administration/runningads.php');
    
}
  }
  
  }
  
  