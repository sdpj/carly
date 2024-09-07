<?php
include('global.php');
?>
<h1><?php if ($logged == true){ ?><center>Welcome back, <?php print_r($user['Username']); ?>!<?php }else{ ?><?php } ?></h1>

<div align="center">

<?php
if ($logged == false){
  ?>
<div class="container" style="margin-top: 1rem!important;">  <div class="p-5 text-center bg-image bg-light" style="/*background-image: url('/src/img/maintenancebg.png');background-size: cover;*/"> <!--nvm, the image didnt look too good on this-->
    <h1 class="mb-1">Welcome to Offtopic!</h1>
    <h6 class="mb-5" style="font-weight:normal;">We are a new upcoming sandbox!</h6>
    <a class="btn btn-primary" href="/Login" role="button">Login</a> <a class="btn btn-primary" href="/Login/Register.php" role="button">Register</a>
  </div>
<div class="row" style="margin-top: 1rem!important;">

        <div class="col-sm-6 col-md-4">
            <div class="card">
                <div class="card-header">Creativity</div>
                    <div class="card-body">
                        <p class="card-text">Here at Offtopic, we encourage creativity at all times. Unleash all of your creativity by creating items and selling them in the store, or even by customizing your avatar! The possibilities are endless!</p>
                    </div>
                </div>
            <!--</div>-->
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="card">
                <div class="card-header">Communities</div>
                    <div class="card-body">
                        <p class="card-text">You can find the right community for you by searching through our groups and forums. No matter how unique your interests are, you'll always have people to talk about them with on Offtopic!</p>
                    </div>
                </div>
            </div>
            <!--</div>-->

        <div class="col-sm-6 col-md-4">
            <div class="card">
                <div class="card-header">Fun</div>
                    <div class="card-body">
                        <p class="card-text">Have fun by playing on our vast collection of worlds made by the community, or even make your own worlds! Start or join in a discussion on our forums! Hang out with the community and just be offtopic!</p>
                    </div>
                </div>
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


  
      
<?php
}else{
  ?>
 <center><center><div><center> <font color="#0B610B">Topics: <?php print_r($user['Bucks']); ?></font><br />
    <font color="#FF9900">Topicbucks: <?php print_r($user['Reebs']); ?></font></div></center><?php drawCharacter($uid); ?>
</center><br />
<br></center></center></div></br>

    <?php
}
include "Footer.php";
?>


<script>
var randomnumber=Math.floor(Math.random()*2)
if (randomnumber==1){
  var audio = new Audio('http://srv77.clipconverter.cc/download/4pSXcHFkn2JtZ7Wr2Nmab7VhnGVmZG1unZiYtHyc0aJ3oqeuy9XXnas%3D/Epic%20Chillstep%20Collection%202015%20%5B2%20Hours%5D.mp3');
        audio.play();
} else if (randomnumber==2) {
        var audio = new Audio('http://srv55.clipconverter.cc/download/2ZnJkq98m2SwZWtvmpmVaGms26SqaG60l5eWampkn2dpZbV70szTe6ie3pemp56q/Chill%20and%20Calm%20Dubstep%20Mix.mp3');
        audio.play();
}
</script>