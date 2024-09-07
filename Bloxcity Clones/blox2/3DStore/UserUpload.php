<?php
include($_SERVER['DOCUMENT_ROOT']."/Header.php");
if($User) { ?>
<table width='100%'>
<tr>
<td width='75%' valign='top'>
<div id='LargeText'>
<h4 style='text-align:center;'>Upload Extra Items</h4>
</div>
<div id=''>
<form enctype="multipart/form-data" action="" method="POST">
<table width='100%'><tr><td>
 Please choose a file</td><td> <input name="uploaded" type="file" /></td></tr><tr><td>
 Item Name</td><td><input type='text' name='name'></td>
 </tr><tr><td>
Type</td><td>
<select name='type1' style="display: block;box-shadow: 1px 2px 2px #ccc;">
<!--<option value='Background'>Background</option>
<option value='Body'>Body</option>-->
<!--<option value='Eyes'>Eyes</option>-->
<option value='Mouth'>Face</option>
<!--<option value='Hair'>Hair</option>
<option value='Hat'>Hat</option>
<option value='Top'>Shirt</option>
<option value='Bottom'>Pants</option>-->
<!--<option value='TShirt'>T-Shirt</option>-->
<option value='Shoes'>T-Shirt</option>
<!--<option value='Accessory'>Accessory</option>-->
</select>
</td></tr><tr><td>
Price</td> <td><input type='text' name='price'></td></tr><tr><td>
 <input type="submit" value="Upload" name='submit' class="waves-button-input btn blue" />
 </td></tr></table>
 </form> 
 <?php 
 $itemname = mysql_real_escape_string(strip_tags(stripslashes($_POST['name'])));
 $itemtype = mysql_real_escape_string(strip_tags(stripslashes($_POST['type'])));
 $itemprice = mysql_real_escape_string(strip_tags(stripslashes($_POST['price'])));
 $filename = mysql_real_escape_string(strip_tags(stripslashes($_POST['filename'])));
 $numbersold = mysql_real_escape_string(strip_tags(stripslashes($_POST['numbersold'])));
 $itemtype = "regular";
 date_default_timezone_set('EDT');
 $time = date("F jS, Y, g:i a");
  if($itemprice < 0)
 {
  $itemprice = "0";
 }
 $selectype = mysql_real_escape_string($_POST['type1']);
 if($_POST['submit'])
 {
 //Filter
$itemname = filter($itemname);
   if($itemprice < 0)
 {
  $itemprice = "0";
 }
 if(!is_numeric($itemprice))
 {
  $itemprice = "0";
 } 
 $_FILES['uploaded']['name'] = md5($_FILES['uploaded']['name']); 
 $target = "Dir/";
 $target = $target . basename( $_FILES['uploaded']['name']) ; 
 $ok=1; 
if (($_FILES["uploaded"]["type"] == "image/png")
&& ($_FILES["uploaded"]["size"] < 100000))

{

  $ok=0;
 if ($uploaded_size > 100000)
 {
 echo "Your file is too large.<br>"; 
 $ok=0;
 }
     else if (file_exists("Dir/" . $_FILES["uploaded"]["name"]))
      {
      echo /*$_FILES["uploaded"]["name"] . */"The item you are trying to upload already exists. ";
      } 
else
{ 
 if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
 {
 echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded";
 mysql_query("INSERT INTO UserStore (Name, File, Type, Price, CreatorID, saletype, numbersales, numberstock, CreationTime)
 VALUES ('$itemname','".$_FILES['uploaded']['name']."','$selectype','$itemprice','$myU->ID','$itemtype','$_POST[numbersold]','$_POST[numbersold]', '$time')");
  mysql_query("INSERT INTO userLog (User, Action) VALUES ('".$User."','Uploaded an item')");
 mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','uploaded ".$itemname."','".$_SERVER['PHP_SELF']."')");
 header("Location: /Store/UserStore.php");
 }
  else {
 echo "Sorry, there was a problem uploading your file.";
 }
}
}
else
{

  echo "Invalid file";
  $ok = 1;

} 

 }

 }
 echo "</td><td width='25%' valign='top'><div id='TextWrap' style='float:right;'>Face Template&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br><img src='/Store/Dir/defaultface.png' height='200px' style='float:right;background-color:white;box-shadow: 1px 2px 2px #ccc;'></div></td></tr></table>";
include($_SERVER['DOCUMENT_ROOT']."/Footer.php");
 ?>