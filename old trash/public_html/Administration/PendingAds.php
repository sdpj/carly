<?php

include "Header.php";
$getAds =  mysql_query("SELECT * FROM PendingAds");

$numAds = mysql_num_rows($getAds);
if ($myU->PowerImageModerator == "true") {

  echo "
  
  <center><font size='4'>Moderate Ads </font><br /><font size='1'>There are $numAds ads pending</font></center>
  <hr width='70%'>
  <br /><br /><br />";
  while($gA = mysql_fetch_object($getAds))  {
    echo"<table>
    <tr>
    <td>
    <b>Image Link:</b>
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
   <b>Bid:</b></td>
   <td>
   $gA->Bid
   </td>

   </tr>
<tr>
<td><b>Advertisement link:</b> 
   </td>
<td>
$gA->Link
</td>
</tr>
  <tr>
  <td><a href='?action=accept&ID=$gA->ID'><font color='green'>Accept</font></a> | <a href='?action=decline&ID=$gA->ID'><font color='red'>Decline</font></a>
    </table>
    <br /><br />
    
    
    ";
$Action = $_GET['action'];
$ID = $_GET['ID'];

if ($Action == "decline") {
    mysql_query("DELETE FROM PendingAds WHERE ID='$ID'");
    
    
    
}
if ($Action == "accept") {
    mysql_query("INSERT INTO Logs (UserID, Message) VALUES ('$myU->ID','Accepted $gA->Name as an ad')");
    mysql_query("INSERT INTO RunningAds (AdID, ImageLink, Link, Time, Name, Username) VALUES ('$ID','$gA->ImageLink','$gA->Link','$gA->Time','$gA->Name','$gA->Username')");
mysql_query("DELETE FROM PendingAds WHERE ID='$ID'"); header("Location:PendingAds.php"); 
exit();
}
  }
}
else {header("Location: index.php"); exit();
}