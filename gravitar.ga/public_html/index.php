<?php
include('global.php');
?>
<?php
  $f = mysql_fetch_array(mysql_query("SELECT * FROM `ads` WHERE `running`='1' ORDER BY RAND()"));
  $sel = $f;
  ?>
   <!--<center><a href="/<?php
  if ($sel['type'] == '1'){
    ?>Profile.php<?php
  }
  ?>?id=<?php print_r($sel['onid']); ?>">
    <img src="/assets/ads/<?php print_r($sel['path']); ?>" border="0" width="920" height="90" title="<?php print_r($sel['caption']); ?>" />
    </a></center>-->
    <?php
  
  ?>

<?php if ($logged == true){?><center><h1 style='margin-bottom:0px;'>Welcome back, <?php print_r($user['Username']); ?>!</h1> <center> <font color="#0B610B"><img src="/assets///bucks.png"> <?php print_r($user['Bucks']); ?></font>&nbsp;&nbsp;
    <font color="#FF9900"><img src="/assets///reebs.png"> <?php print_r($user['Reebs']); ?></font></center>  <?php }else{ ?><h1 style="margin:0px;text-align:center;font-weight:normal;">Welcome to Gravitar!</h1><?php } ?></h1>
<br>
<div align="center">
<div style="border: 0px solid #333; width: 250px; background-color: #FFF; color: black; padding: 4px; text-align: center; box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%); border-radius: 5px;">
<?php
if ($logged == false){
  ?>
<div style="display:inline-block;width: 94%; max-width: 94%; border-top-left-radius: 5px; border-top-right-radius: 5px; color: white; background-color:rgb(126, 180, 231); padding: 7px;border-bottom: 2px solid #4a85c0;color: #333;font-size: 1.5rem; font-weight: 600;">
<table width="94%" style="display:inline-block;"><tbody><tr><td><img src="/assets/G.png" style="box-shadow: -2px 2px 7px rgb(0 0 0 / 25%);border-radius:50%;background-color:#fff;height: 50px; width: 50px;display:inline-block;">&nbsp;&nbsp;&nbsp;<thetext style="position:relative;top:-14px;">Login</thetext></td></tr></tbody></table>
</div>  
<form action="/Login/dologin.php" method="post">
<table style="margin-top:14px;"><tr>
<td>Username:</td><td><input type="text" name="username" style="background-color: #f9f9f9; box-shadow: 2px 1px 4px 0px rgb(0 0 0 / 15%); border-radius: 3px; /* border: 1px solid #f7f7f7; */ outline: none; border: 0px;" /></td></tr>
<tr>
<tr></tr>
<td>Password:</td><td><input type="password" name="password" style="background-color: #f9f9f9; box-shadow: 2px 1px 4px 0px rgb(0 0 0 / 15%); border-radius: 3px; /* border: 1px solid #f7f7f7; */ outline: none; border: 0px;" /></td></tr>
</table>
<input type="submit" value="Login" id="buttonsmall" style="background-color: #04AA6D; border: none; color: white; cursor: pointer; border-radius: 5px; width: 97%; margin-top: 5px;" />
</form>
</div>
<div align="center" style="margin-bottom: 10px;">
<br>
<div style="border: 0px solid #333; width: 250px; background-color: #FFF; color: black; padding: 4px; text-align: center; box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%); border-radius: 5px;">
<div style="display:inline-block;width: 94%; max-width: 94%; border-top-left-radius: 5px; border-top-right-radius: 5px; color: white; background-color:rgb(126, 180, 231); padding: 7px;border-bottom: 2px solid #4a85c0;color: #333;font-size: 1.5rem; font-weight: 600;">
<table width="94%" style="display:inline-block;"><tbody><tr><td><img src="/assets/G.png" style="box-shadow: -2px 2px 7px rgb(0 0 0 / 25%);border-radius:50%;background-color:#fff;height: 50px; width: 50px;display:inline-block;">&nbsp;&nbsp;&nbsp;<thetext style="position:relative;top:-14px;">Register</thetext></td></tr></tbody></table>
</div>  
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
<title>Gravitar</title>
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

<form name="f" method="post" action="Login/doregister.php">
<div style="margin:0px;">
<div style="width:0px;background:#ff99ff; margin-bottom:20px"><?php echo $note; ?></div>

<table>

  <tr><td>Username</td><td><input type="text" name="username"  onchange="validate(this.form);"  style="background-color: #f9f9f9; box-shadow: 2px 1px 4px 0px rgb(0 0 0 / 15%); border-radius: 3px; /* border: 1px solid #f7f7f7; */ outline: none; border: 0px;"/></td></tr>
<tr></tr>
  <tr><td>Password</td><td><input type="password" name="password"  onchange="validate(this.form);" style="background-color: #f9f9f9; box-shadow: 2px 1px 4px 0px rgb(0 0 0 / 15%); border-radius: 3px; /* border: 1px solid #f7f7f7; */ outline: none; border: 0px;" /></td></tr>
<tr></tr>
  <tr><td>Password</td><td><input type="password" name="cpassword"  onchange="validate(this.form);" style="background-color: #f9f9f9; box-shadow: 2px 1px 4px 0px rgb(0 0 0 / 15%); border-radius: 3px; /* border: 1px solid #f7f7f7; */ outline: none; border: 0px;" /></td></tr>
<tr></tr>
  <tr><td>Email</td><td><input type="text" name="email"  onchange="validate(this.form);" style="background-color: #f9f9f9; box-shadow: 2px 1px 4px 0px rgb(0 0 0 / 15%); border-radius: 3px; /* border: 1px solid #f7f7f7; */ outline: none; border: 0px;" /></td></tr>

  </table>

<img src="Login/captcha.php" id="captcha" style="margin-top: 5px; margin-bottom: 9px; border: 0px solid #333; width: 80%; background-color: #FFF; color: black; padding: 4px; text-align: center; box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%); border-radius: 5px;" /><br/>
<a href="#" onclick="
    document.getElementById('captcha').src='Login/captcha.php?'+Math.random();
    document.getElementById('captcha-form').focus();"
    id="change-image">Not readable? Change text.</a><br/><br/>
  <b>Captcha</b><br/>
  <input type="text" name="captcha" id="captcha-form"  onchange="validate(this.form);" style="margin-top: 3px; background-color: #f9f9f9; box-shadow: 2px 1px 4px 0px rgb(0 0 0 / 15%); border-radius: 3px; /* border: 1px solid #f7f7f7; */ outline: none; border: 0px;" /><br/><br>

<input type="checkbox" name="vehicle" value="Bike"> I agree to the Terms of Service<br><br>

   <input type="submit" name="sub" id="buttonsmall" disabled style="background-color: #04AA6D; border: none; color: white; cursor: pointer; border-radius: 5px; width: 97%; margin-top: 5px;" />

</form >
</div>
</div>
</div>


  
      
<?php
}else{
  ?>
 <center><center><?php drawCharacter($uid); ?>


<br><a href="/Forum/MyForums.php"><button style='background-color: #04AA6D; border: none; color: white; padding: 14px 28px; cursor: pointer; border-radius: 5px;'><b>Forum Posts:</b> <?php print_r($uid['totalposts']); ?></button></a>
  
   
   
</center><br />
<br></center></center></div></br>

    <?php
}
include "Footer.php";
?>
