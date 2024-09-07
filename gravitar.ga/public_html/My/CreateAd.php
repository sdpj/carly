<?php
include('../global.php');
if ($logged==false){
  die("You're not logged in!");
}
if ($_GET['type'] && $_GET['id']){
  $type = mysql_real_escape_string($_GET['type']);
  if ($type == '1'){ //profile ad
    $id = mysql_real_escape_string($_GET['id']);
    $allowedExts = array("png", "gif", "jpg", "jpeg");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ($_FILES['file']){
if ((($_FILES["file"]["type"] == "image/png") ||
($_FILES["file"]["type"] == "image/gif") ||
($_FILES["file"]["type"] == "image/jpg") ||
($_FILES["file"]["type"] == "image/jpeg")
)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    die( "Hmm.. Looks like an error!");
    }

    
      if ($_POST['caption'] && $_POST['bid']){
        $caption = addslashes(strip_tags(mysql_real_escape_string($_POST['caption'])));
        $bid = mysql_real_escape_string($_POST['bid']);
        if ($bid < 20){
          die("You can't bid less than 20 bucks on an ad!");
        }
        $hasher = hash("ripemd160", $_FILES['file']['name'] . rand() . $caption);
        
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../assets/ads/" . $hasher);
    $path = $hasher;
    $ui = $user['id'];
    $endunix = time() * 24;
    if ($user['Bucks'] < $bid){
      die("Not enough bucks!");
    }
    mysql_query("UPDATE `accounts` SET `Bucks`=`Bucks`-'$bid' WHERE `id`='$uid'");
    mysql_query("INSERT INTO `ads` (`endunix`, `caption`, `ownerid`, `onid`, `bid`, `path`, `running`, `type`) VALUES ('$endunix', '$caption', '$ui', '$id', '$bid', '$path', '1', '$type')") or die(mysql_error());
      
    $getuploaded = mysql_fetch_array(mysql_query("SELECT * FROM `ads` WHERE `path`='$path' AND `ownerid`='$ui' AND `caption`='$caption'"));
    die("Your ad has been created and is now running, click <a href='Ads.php'>here</a> to view your current ads");
      
        
    
  }
}
else
  {
  echo "Some seems to have gone wrong... Try again later!";
  }
}
    ?>
        Right click the ad template to download it.<br>
        <img src="/assets/ads/template.png" style="border:1px solid black;">
        <br><br>
    <form action="?type=<?php print_r($type); ?>&id=<?php print_r($id); ?>" method="post"
enctype="multipart/form-data">
<table><tr><td><label for="file">Filename:</label></td><td><input type="file" name="file" id="file"></td></tr>
<tr>
<td>
Caption
</td>
<td>
<input type="text" name="caption" placeholder="Caption here..." />
</td>
</tr>
<tr>
<td>
Bid
</td>
<td>
<input type="text" name="bid" />
</td>
</tr>
</table>
<br>
<input type="submit" value="Run Ad" />
</form>
<?php
  }
}
