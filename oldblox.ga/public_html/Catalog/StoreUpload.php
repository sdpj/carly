<?php
include($_SERVER['DOCUMENT_ROOT']."/Header.php");
if($User) { if($myU->PowerArtist != "true") { header("Location: ../index.aspx"); die(); }  else { ?>
<table width='100%'>
  <tr>
    <td width='75%' valign='top'>
      <font size='5'>
        Upload Store Item
      </font><br><br>
      <div id='aB'>
        <div align='left'>
          <form enctype="multipart/form-data" action="" method="POST">
            <table>
              <tr>
                <td style='padding-right:20px;'>
                  <b>Item File</b>
                </td>
                <td>
                  <input name="uploaded" type="file" />
                </td>
              </tr>
              <tr>
                <td style='padding-right:20px;'>
                  <b>Item Name</b>
                </td>
                <td>
                  <input type='text' name='name'>
                </td>
              </tr>
              <tr>
                <td style='padding-right:20px;'>
                  <b>Description</b>
                </td>
                <td>
                  <textarea name='Description' placeholder='Required' style='width:162px;' rows='5'></textarea>
                </td>
              </tr>
              <tr>
                <td style='padding-right:20px;'>
                  <b>Type</b>
                </td>
                <td>
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
                </td>
              </tr>
              <tr>
                <td style='padding-right:20px;'>
                  <b><font color='green'><b>Bux</b></font></b>
                </td>
                <td>
                  <input type='text' name='price'>
                </td>
              </tr>
              <tr>
                <td style='padding-right:20px;'>
                  <b>Item Type</b>
                </td>
                <td>
                  <select name='itemtype'>
                    <option value='regular'>Regular</option>
                    <option value='limited'>Limited</option>
                    
                  </select>
                </td>
              </tr>
              <tr>
                <td style='padding-right:20px;'>
                  <b>Amount in Stock</b>
                </td>
                <td>
                  <input type='text' name='numbersold'>
                </td>
              </tr>
              <tr>
                <td style='padding-right:20px;'>
                  <b>For Sale</b>
                </td>
                <td>
                  <select name='ifsale'>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <input type="submit" value="Upload" name='submit' class='btn-control-prof' />
                </td>
              </tr>
            </table>
            <font color='black' style='font-size:10pt;'>Any stolen material will be removed from the catalog.</font>
          </form>  
 <?php 
 $itemname = mysql_real_escape_string(strip_tags(stripslashes($_POST['name'])));
  $Description = mysql_real_escape_string(strip_tags(stripslashes($_POST['Description'])));
 $itemtype = mysql_real_escape_string(strip_tags(stripslashes($_POST['type'])));
 $itemprice = mysql_real_escape_string(strip_tags(stripslashes($_POST['price'])));
 $filename = mysql_real_escape_string(strip_tags(stripslashes($_POST['filename'])));
 $numbersold = mysql_real_escape_string(strip_tags(stripslashes($_POST['numbersold'])));
 $itemtype = mysql_real_escape_string(strip_tags(stripslashes($_POST['itemtype'])));
 $selectype = mysql_real_escape_string(strip_tags(stripslashes($_POST['type1'])));
 $ifsale = mysql_real_escape_string(strip_tags(stripslashes($_POST['ifsale'])));
 date_default_timezone_set('EDT');
 $time = date("F jS, Y, g:i a");
 $submit = mysql_real_escape_string(strip_tags(stripslashes($_POST['submit'])));

 if($submit)
 {
$itemname = filter($itemname);
   if($itemprice <= 0)
 {
  $itemprice = "0";
 }

 if(!is_numeric($itemprice))
 {
  $itemprice = "0";
 }
 if ($itemtype == "limited")
 {
 if ($numbersold < 2) {
 echo "<b>Error, must be at least 2 in stock.</b>";
 exit;
 }
 }
 $FileName = "".$_FILES['uploaded']['name']."";
 $_FILES['uploaded']['name'] = sha1(".$FileName."); 
 $target = "Dir/";
 $target = $target . basename( $_FILES['uploaded']['name']) ; 
 $ok=1; 
if (($_FILES["uploaded"]["type"] == "image/png") OR ($_FILES["uploaded"]["type"] == "image/jpg")  OR ($_FILES["uploaded"]["type"] == "image/jpeg") 
&& ($_FILES["uploaded"]["size"] <  100000))
{
  $ok=0;

//
  //
 if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
 {
 echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded";
 mysql_query("INSERT INTO Items (Name, File, Type, Price, CreatorID, saletype, numbersales, numberstock, CreationTime, Description)
 VALUES ('$itemname','".$_FILES['uploaded']['name']."','$selectype','$itemprice','$myU->ID','$itemtype','$_POST[numbersold]','$_POST[numbersold]', '$time','$Description')");
 mysql_query("UPDATE Items SET sell='$ifsale' WHERE Name='$itemname'");
mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','uploaded ".$itemname."','".$_SERVER['PHP_SELF']."')");
 header("Location: index.php");
 die();
 } 
 else {
 echo "Sorry, there was a problem uploading your file.";
 die();
 }
  //

 }
 else
 {
  echo "<b>Error</b>";
 }
}

 echo "</td><td width='25%' valign='top'><div id='TopBar'>Avatar Template</div><div id='aB'><center><img src='/Catalog/Dir/Avatar.png'></div></td></tr></table>";
 }
 }
include($_SERVER['DOCUMENT_ROOT']."/Footer.php");
 ?>