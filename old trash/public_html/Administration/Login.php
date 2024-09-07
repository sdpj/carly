<?php

include "../Global.php";
	if ($myU->PowerMegaModerator == "true"||$myU->PowerAdmin == "true") {
echo"
<style>
body {
background-color:white;
font-family:verdana;
}

</style><head><title>Administration | Login</title></head>


<center>
<br /><br /><br /><br /><br /><br /><br />
<div style='border:1px solid black;border-radius:5px;width:30%;background-color:lightgrey;padding:5px;'><br />
<img src='../Badgess/Administrator.png' width='30' height='30'><b><font color='darkred'><u>FireSplash Administration Access</font></u></b><br>
<b><font size='1'><font color='darkblue'>Security Passcode Required</font></font></b>
<form action='' method='post'>
<br />
<b><font size='1'>Passcode:</font> </b><input type='password' name='password' style='width:60%;'>
<br />
<input type='submit' name='submit' value='Login'>
</form>
<br />
</div>
";

$Passcode = "poopisgood123";

$SafeCookie = hash('sha512','YouCannotHackThisCookieGoAheadAndTry');
$Request = $_POST['password'];
$Submit = $_POST['submit'];
$SafeLogin = $_COOKIE['MobixAdmin'];
if ($Submit) {

if ($Request == $Passcode) {
setcookie('Admin',$SafeCookie,time()+3600);
header("Location: /Administration/index.php"); exit();

}
}
} 
else { header("Location: ../index.php?Admin=false");
exit(); 
}

