<?php
include($_SERVER['DOCUMENT_ROOT'].'/Header.php');
if(!$User){
header("Location: /");
die();
}



echo"
<div style='padding-left:40px;'>




<font size='5'>Create advertisement</font>
<br><br>You can create advertisements for profiles and items. Your ad will appear on the website so other users can see them.
<br><br>
&bull; Before you start, all ads must be  728 x 90. <a href='/Dir/AdBannerTemplate.png' class='btn-best' style='font-size:13px;padding:2px;'>Download</a>
<br><br>
&bull; Design an advertisement that will attract other users.
<br><br>
&bull; Minimum you can bid is <b>100</b> <font color='green'><b>B$</b></font>, you get <b>1</b> <font color='green'><b>B$</b></font> every time a user sees your ad.
<br><br>
<form action='' method='post' enctype='multipart/form-data'>
<table>
<tr>
<td><b>Ad Name:</b></td>
<td><input type='text' name='AdName'></td>
</tr>
<tr>
<td><b>Bid Amount:</b></td>
<td><input type='text' name='Bid'> <b>The more <font color='green'>B$</font> you bid on an ad, the most likely it is to show up.</b></td>
</tr>
<tr>
<td><b>Choose File:</b></td>
<td><input type='file' name='fileToUpload' id='fileToUpload'></td>
</tr>
</table>
<br><input type='submit' name='Submit' class='btn-primary' value='Upload'>
</form>
</div>";

$Submit = SecurePost($_POST['Submit']);
$Name = SecurePost($_POST['AdName']);
$Bid = SecurePost($_POST['Bid']);
$target_dir = "Dir/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$Link = "test";
$getmyAds = mysql_query("SELECT * FROM UserAdvertisments WHERE UserID='$myU->ID'");
$numAds = mysql_num_rows($getmyAds);

if($Submit) {
if(!$Name){
echo"<div id='error'>Your ad must have a name</div>";
die();
}
elseif($Bid < 100) {
echo"<div id='error'>Your bid must be at least 100 <font color='green'><b>Bux</b></font></div>";
die();
}
elseif($Bid > $myU->Bux){
echo"<div id='error'>You do not have enough <font color='green'><b>Bux</b></font></div>";
die();
}
elseif($numAds >= 2) {
echo"<div id='error'>You have too many ads running.</div>";
die();
}
else {
	 $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
     
        $uploadOk = 1;
    } else {
       
        $uploadOk = 0;
    }
}
if (file_exists($target_file)) {
    echo "<div id='error'>File already exists.</div>";
    $uploadOk = 0;
	die();
}
	
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "<div id='error'>Sorry, your file is too large.</div>";
    $uploadOk = 0;
	die();
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<div id='error'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
    $uploadOk = 0;
	die();
}
if ($uploadOk == 0) {
    echo "<div id='error'>Sorry, your file was not uploaded.</div>";
	die();
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], ($target_file))) {
        echo "<div id='success'>Your advertisement has been uploaded.</div>";
		$getAdDir = basename( $_FILES["fileToUpload"]["name"]);
		$Expire = time()+86400; 
		
   mysql_query("INSERT INTO UserAdvertisments (UserID, Name, Link, Image,  Running, Bid, Approved) VALUES ('$myU->ID','$Name','$Link','$getAdDir','0','$Bid','0')");
   mysql_query("UPDATE Users SET Bux=Bux-$Bid WHERE ID='$myU->ID'");
   } else {
        echo "Sorry, there was an error uploading your file.";
		die();
    }
}
}




	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');

?>