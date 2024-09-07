<?
include('Header.php');

  $Username = SecurePost($_POST['Username']);
  $Password = SecurePost($_POST['Password']);
  $Submit =   SecurePost($_POST['Submit']);
  
  if ($Submit) {
  
    if (!$Username || !$Password) {
    
      echo "
      <div id='Error'>
        Sorry, you have missing fields.
      </div>
      ";
    
    }
    
    else {
    
      $_HASH = hash('sha512',$Password);
      
      $checkUser = mysql_query("SELECT * FROM Users WHERE Username='$Username'");
      
      $cU = mysql_num_rows($checkUser);
      
      if ($cU == 0) {
      
      echo "
      <div id='Error'>
        Sorry, that account does not exist.
      </div>
      ";
      
      }
      
      else {
      
        $getPassword = mysql_query("SELECT * FROM Users WHERE Username='$Username' AND Password='$_HASH'");
        
        $gP = mysql_num_rows($getPassword);
        
        if ($gP == 0) {
        
          echo "
          <div id='Error'>
            Sorry, but your password is incorrect.
          </div>
          ";
        
        }
        
        else {
        
          $_SESSION['Username']=$Username;
          $_SESSION['Password']=$_HASH;
          
          header("Location: index.php");
        
        }
      
      }
    
    }
  
  }

?>
<form action="" method="POST">
<div align='left'>
  <table>
    <tr>
      <td valign='top'>
        <?php 
if (!$User)  { header("Location: Register.php"); echo "
          <div id='Login'>
            <div align='center'>
              <table>
                <tr>
                  <td id='Msg'>
                    Login to your account
                  </td>
                </tr>
              </table>
            </div>
              <table>
                <tr>
                  <td id='smalltext'>
                    Username
                  </td>
                  <td>
                    <input type='text' name='Username' required='required'>
                  </td>
                </tr>
                <tr>
                  <td id='smalltext'>
                    Password
                  </td>
                  <td>
                    <input type='password' name='Password' required='required'>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type='submit' name='Submit' value='Login'>
                  </td>
                </tr>
              </table>
              <a href='ForgotPassword.php'>Forgot your password?</a>
          </div>
          <br />
          <br />
          </form>
          <form action='register.php' method='POST'>
          <div id='Login'>
            <div align='center'>
              <table>
                <tr>
                  <td>
                    <div id='Msg'>
                      No account?
                    </div>
                    <div id='Msgsmall'>
                      <a href='Register.php'>Register</a> for free!
      "; }
      else {
      $ava = mysql_real_escape_string(strip_tags(stripslashes($_GET['Avatar3D'])));
        $getUser = mysql_query("SELECT * FROM Users WHERE Avatar3D='".$Username."'");
}
$gU = mysql_fetch_object($getUser);
        echo "
        <div id='Login'>
          <left>
            <b>Welcome, $User</b>
            <br />
            <br />



            <!--<img src='/Avatar2D.php?ID=$myU->ID'>-->
          <img src='/Avatars/$myU->Avatar3D' width='256' height='256' style='position:absolute;left:-50px;'>
                                                <center style='position:absolute; TOP:242px; LEFT:170px; width:549px;'>
                                               <!--<b>Welcome to Nobelium</b> 
                                                <br />
            <br />
                                           Nobelium-->
          </center>

        </div>
        
          
          
          
          
          ";
      


      ?>
      </td>
    </tr>
  </table>
</div>
</form>
<?php
include('Footer.php');
?>