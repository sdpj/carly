<?php
include "Header.php";

//if ($user['Username'] !== '608'){
//  //echo $user['Username'];
//  echo "Nice argument, unfortunately, "; echo $_SERVER['REMOTE_ADDR']; echo ".";
//  die();
//  }
  
if (isset($_POST['announcement'])){
  $announcement = $_POST['announcement'];
  mysql_query("UPDATE `shout` SET `shout`='$announcement'");
  
}
if (isset($_POST['color'])){
  $color = $_POST['color'];
  mysql_query("UPDATE `shout` SET `color`='$color'");
  echo "Done.<br><br>";
}
?>
<form action="" method="post">
<textarea name="announcement" style="margin: 2px; width: 599px; height: 140px;"><?php
$f = mysql_fetch_array(mysql_query("SELECT * FROM `shout`"));
print_r($f['shout']);
?></textarea><br><br><br><br>
Background Color <br>
 <input type="text" name="color" value="<?php print_r($f['color']);?>"><br><br><br><br>
<input type="submit" value="Update Shout" />
</form>