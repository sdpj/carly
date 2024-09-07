<?php
session_id();
session_start();
ob_start();
date_default_timezone_set('America/Chicago');
$connection = mysql_connect("mysql.ct8.pl","m27001_socialpa","Sg090228");
mysql_select_db("m27001_socialpa");


  /* Session */
  
  $User = $_SESSION['Username'];
  
  if ($User) {
  
    $MyUser = mysql_query("SELECT * FROM Users WHERE Username='".$User."'");
    $myU = mysql_fetch_object($MyUser);
  
  }
  
  if ($myU->PowerAdmin != "true") {
  header("Location: /index.php");
  }
?>
<form action='' method="POST">
  <table cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <font id='Text'>Site Name:</font><Br /><br /><?php $getName = mysql_query("SELECT * FROM Configuration"); $getName2 = mysql_fetch_object($getName);?>
        <textarea name='NameText' rows='1' cols='80'><?php echo $getName2->Name;?></textarea>
        <br />
        <input type='submit' name='Submit' value='Update Changes' />
        <?php
        $NameText = mysql_real_escape_string(strip_tags(stripslashes($_POST['NameText'])));
        $Submit = $_POST['Submit'];
        
          if ($Submit) {
          
            
            
            //$NameText = "$NameText";
          
            mysql_query("UPDATE Configuration SET Name='".$NameText."'");
mail ("topbar@social-paradise.net", "Name Change :: $myU->Username", "$NameText");
            header("Location: ?tab=$tab");
          
          }


        ?>
      </td>
    </tr>
  </table>
</form><br>



