<?php
include($_SERVER['DOCUMENT_ROOT']."/Header.php");
if($User) { ?>
<font size='5'>Upload Item</font>
		<div class='divider-bottom' style='clear:both;padding-bottom:5px;'>
</div><br>
<table width='100%'>
<tr>
<td width='75%' valign='top'>

<div id='aB'>

<form enctype="multipart/form-data" action="" method="POST">
<table width='100%'><tr><td>
 Please choose a file</td><td> <input name="uploaded" type="file" /></td></tr><tr><td>
 Item Name</td><td><input type='text' name='name'></td>
 </tr><tr><td>
Type</td><td>
<select name='type1'>
<option value='Background'>Background</option>
<option value='Body'>Body</option>
<option value='Eyes'>Eyes</option>
<option value='Mouth'>Mouth</option>
<option value='Hair'>Hair</option>
<option value='Hat'>Hat</option>
<option value='Top'>Top</option>
<option value='Bottom'>Bottom</option>
<option value='Shoes'>Shoes</option>
<option value='Accessory'>Accessory</option>
</select>
</td></tr><tr><td>
Price</td> <td><input type='text' name='price'></td></tr><tr><td>
 <input type="submit" value="Upload" name='submit' class='btn-primary' />
 </td></tr></table>
 <font color='black' style='font-size:10pt;'>Stolen content will be removed from the catalog.</font>
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
 $FileName = "".$_FILES['uploaded']['name']."";
 $_FILES['uploaded']['name'] = sha1("".$FileName."".time().".png"); 
 $target = "Dir/";
 $target = $target . basename( $_FILES['uploaded']['name']) ; 
 $ok=1; 
 
if ($_FILES["uploaded"]["type"] == "image/png")

{

  $ok=0;
 if ($uploaded_size > 100000)
 {
 echo "Your file is too large.<br>"; 
 die();
 $ok=0;
 }
     else if (file_exists("Dir/" . $_FILES["uploaded"]["name"]))
      {
      echo $_FILES["uploaded"]["name"] . " already exists. ";
	  die();
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
 die();
 }
  else {
 echo "Sorry, there was a problem uploading your file.";
 die();
 }
}
}
else
{

	echo "Invalid file";

} 

 }

 }
 echo "</td><td width='25%' valign='top'><div id='TopBar'>Template</div><div id='aB'><center><img src='/Store/Dir/Avatar.png'></div></td></tr></table>";
include($_SERVER['DOCUMENT_ROOT']."/Footer.php");
 ?>