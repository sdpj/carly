<?php
include("../global.php");
session_start();
	
if (!empty($_REQUEST['captcha'])) 
{
    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) 
	{
        $note= 'Please enter valid text';
    } 
	else 
	{
	if($_SERVER["REQUEST_METHOD"] == "POST")
{

$name=htmlentities($_POST['name']); 
$message=htmlentities($_POST['message']);


$note= 'Values Inserted';
}

    }

  
    unset($_SESSION['captcha']);
}


?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>9lessons Demo</title>
<script language="javascript" type="text/javascript">
<!--

function validate() {
    var isNotValid = false;

    var flds = new Array('username', 'password', 'cpassword','email','captcha');
    var e = document.forms['f'].elements;

    for (var i = 0; i < flds.length; i++ ) {
        if (e[ flds[ i ] ].value.length == 0) isNotValid = true;
    }

    e['sub'].disabled = isNotValid;
}

-->
</script>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
body{
font-family:Arial, Helvetica, sans-serif;
font-size:13px;
}
</style>
</head>

<body>

<form name="f" method="post" action="doregister.php">

<div><h3>Register for a FREE Account Now!</a></h3></div> 
<div style="margin:50px ">
<div style="width:300px;background:#ff99ff; margin-bottom:20px"><?php echo $note; ?></div>

<table> 
<tr><td>Username</td><td><input type="text" name="username"  onchange="validate(this.form);" /></td></tr> 
<tr><td>Password</td><td><input type="password" name="password"  onchange="validate(this.form);" /></td></tr> 
<tr><td>Retype Password</td><td><input type="password" name="cpassword"  onchange="validate(this.form);"/></td></tr> 
<tr><td>Email</td><td><input type="text" name="email"  onchange="validate(this.form);"/></td></tr> 
</table>

<img src="captcha.php" id="captcha" /><br/>
<a href="#" onclick="
    document.getElementById('captcha').src='captcha.php?'+Math.random();
    document.getElementById('captcha-form').focus();"
    id="change-image">Not readable? Change text.</a><br/><br/>
	<b>Human Test</b><br/>
	<input type="text" name="captcha" id="captcha-form"  onchange="validate(this.form);"/><br/><br>

<input type="checkbox" name="vehicle" value="Bike"> I agree to the Terms of Service<br><br>

   <input type="submit" name="sub" disabled />

</form >
</div>
</body>
</html>