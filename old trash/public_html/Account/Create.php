<html>
<head>
</head>
</html>
<?php
include "../Header.php";
?>
<script>
function loadXMLDoc(value)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
}
xmlhttp.open("GET","check_exist.php?value=" + value,true);
xmlhttp.send();
}
function dopass(value)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv2").innerHTML=xmlhttp.responseText;
    }
}
xmlhttp.open("GET","check_exist.php?pass=" + value,true);
xmlhttp.send();
}
function docpass(value, otherf)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv3").innerHTML=xmlhttp.responseText;
    }
}
xmlhttp.open("GET","check_exist.php?pass=" + otherf + "&cpass=" + value,true);
xmlhttp.send();
}
</script>
<?php
$JoinDate = date("d-m-y");
$Configuration = mysql_fetch_object($Configuration = mysql_query("SELECT * FROM Configuration"));
if ($Configuration->Register == "true") {

if (!$User) {
$UsernameIs = mysql_real_escape_string(strip_tags(stripslashes($_GET['UsernameIs'])));
echo '
<div id="aB">
<div id="Text">
<font size="4">&nbsp;&nbsp;&nbsp;&nbsp;Basic Information<hr width="95%"></font><br />

</div>
<form action="" method="POST">
<table cellspacing="0" cellpadding="0">
<td style="padding-right:15px;">
Username:
</td>
<td>
<input type="text" name="_Username" onkeyup="loadXMLDoc(this.value);" value="'.$UsernameIs.'" />
</td>
<td width="500" style="color: black" id="myDiv"></td>
</tr>
<tr>
<td style="style="padding-right:15px;"">
Password:
</td>
<td>
<input type="password" id="pw" onkeyup="dopass(this.value);" name="_Password" />
</td>
<td width="500" style="color: black" id="myDiv2"></td>
</tr>
<tr>
<td style="padding-right:15px;">
Confirm Password:
</td>
<td>
<input type="password" onkeyup="docpass(this.value, pw.value);" name="_ConfirmPassword" />
<td width="500" style="color: black" id="myDiv3"></td>
</tr>
</tr>
<tr>
<td style="padding-right:15px;">
Email:
</td>
<td>
<input type="text" name="_Email" />
</td>
</tr>
<tr>
<td style="padding-right:15px;">
Name:
</td>
<td>
<input type="text" name="Name">
</td>
<td>
&nbsp;&nbsp;&nbsp; Male<input type="radio" name="Gender" value="Male" checked/> Female<input type="radio" name="Gender" value="Female"/>
</td>
</tr>

</tr>
</table>
<br/>
<input type="submit" name="_Submit" value="Submit">
<br/>
</form>
<br /><br />

';
$response = json_decode($response, true);
$Username = mysql_real_escape_string(strip_tags(stripslashes($_POST['_Username'])));
$Password = mysql_real_escape_string(strip_tags(stripslashes($_POST['_Password'])));
$ConfirmPassword = mysql_real_escape_string(strip_tags(stripslashes($_POST['_ConfirmPassword'])));
$Email = mysql_real_escape_string(strip_tags(stripslashes($_POST['_Email'])));
$Submit = mysql_real_escape_string(strip_tags(stripslashes($_POST['_Submit'])));
$ref = mysql_real_escape_string(strip_tags(stripslashes($_GET['ref'])));
$Gender = SecurePost($_POST['Gender']);
$Name = SecurePost($_POST['Name']);
$Code = SecurePost(rand(5, 15));
					function is_alphanumeric($username)
					{
						return (bool)preg_match("/^([a-zA-Z0-9])+$/i", $username);
						 
					}
					
if ($Submit) {
$Username = filter($Username);
if (!$Username||!$Password||!$ConfirmPassword) {
echo "<b>Please fill in all required fields.</b>";
}
else {
$userExist = mysql_query("SELECT * FROM Users WHERE Username='$Username'");
$userExist = mysql_num_rows($userExist);
$userExist1 = mysql_query("SELECT * FROM Users WHERE OldUsername='$Username'");
$userExist1 = mysql_num_rows($userExist1);
if ($userExist > 0) {
echo "<b>That username already exists.</b>";
}
elseif ($userExist1 > 0) {
echo "<b>That username already exists.</b";
}
else {
if ($ConfirmPassword != $Password) {
echo "<b>Your password and confirm password does not match.</b>";
}
else {
if (!$Email) {
echo"Please provide an email"; }
else {
if (strlen($Username) >= 25) {
echo "<b>Your username is above fifteen (25) characters!</b>";
}

elseif (strlen($Username) < 3) {
echo "<b>Your username is under three (3) characters!</b>";
}
elseif ($response["success"]===false) {
echo "<b>No bots mate, you failed.</b>";
}
elseif (!is_alphanumeric($Username)) {
echo "<b>Only A-Z and 1-9 is allowed, or there is profanity in your username.</b>";
}

elseif (strlen($Password) < 5){
	echo("<b>Passwords must be at least 5 characters long!</b>");
}

else {

	if ($ref) {
	
		$getRef = mysql_query("SELECT * FROM Users WHERE ID='$ref'");
		$gR = mysql_fetch_object($getRef);
		$RefExist = mysql_num_rows($getRef);
		
			if ($RefExist == 0) {
			
				//dont do anything lol
			
			}
			else {
			
				//if ($_SERVER['PHP_SELF'] == $gR->IP) {
				
					//dont do anything lol
				
				//}
				//else {
					$userExist = mysql_query("SELECT * FROM Users WHERE Username='$Username'");
					$userExist = mysql_fetch_object($userExist);
					mysql_query("UPDATE Users SET SuccessReferrer=SuccessReferrer + 1 WHERE ID='$ref'");
					mysql_query("INSERT INTO Referrals (ReferredID, UserID) VALUES('$ref','$userExist->ID')");
				
				//}
			
			}

	}

$_ENCRYPT = hash('sha512',$Password);
$IP = $_SERVER['REMOTE_ADDR'];
mysql_query("INSERT INTO Users (Username, Password, Email, IP) VALUES('$Username','$_ENCRYPT','$Email','$IP')");


 
$_SESSION['Username']=$Username;
$_SESSION['Password']=$_ENCRYPT;
header("Location: ../index.php");
}
}

}
}
}
}
echo '
</div>
';
}
}
else {
echo "<b>Register has been temporarily disabled.</b>";
header("Location: ../index.php");
}  
    
    
    
?>

<?php
include "../Footer.php";
?>