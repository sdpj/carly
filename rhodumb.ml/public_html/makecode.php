<?php
    if (isset($_POST['submit'])) {
      $mycode = $_POST['mycode'];
      $filepath = 'files/'.time();
      $files = fopen($filepath, 'w');
      $file_write = fwrite($files, $mycode);
      fclose($files);
      if ($file_write == true) {
        $file_view = '/view.php?id='.time();
        $message = '<a href="'.$file_view.'">View your file </a>';
      }
      else {
        $message = "There is an error saving your file";
      }
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Pastebin</title>
  <style type="text/css">
    textarea {
      resize: none;
      padding: 10px;
    }
  </style>
</head>
<body align=center>
  <?php
    if (isset($message)) {
      echo $message;
    }
  ?>
  <form method="post">
    <textarea name="mycode" cols="100" rows="20" placeholder="Paste your code here.."></textarea>
    <br />
    <input type="submit" name="submit" value="Save My Code">
  </form>
</body>
</html>