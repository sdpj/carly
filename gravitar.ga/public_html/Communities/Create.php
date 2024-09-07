<?php
include('../global.php');
if ($logged==false){
	die("You're not logged in!");
}
if ($user['Membership'] == '1'){
	?>
	<h1>Hey, <?php print_r($user['Username']); ?>, you're a premium member! We'll let you make this group for free!</h1>
    <?php
}else{
	?>
	<h1>Looks like you're not a premium member, <?php print_r($user['Username']); ?>, this will cost you 100 Bucks.</h1>
    <?php
}
$allowedExts = array("png");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ($_FILES['file']){
if ((($_FILES["file"]["type"] == "image/png")
)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    die( "Hmm.. Looks like an error!");
    }

    
		  if ($_POST['name'] && $_POST['desc']){
			  $name = addslashes(strip_tags(mysql_real_escape_string($_POST['name'])));
			  $desc = nl2br(strip_tags(mysql_real_escape_string($_POST['desc'])));
			  $hasher = hash("ripemd160", $_FILES['file']['name'] . rand() . $name);
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../assets/groupimg/" . $hasher);
	  $path = $hasher;
	  $ui = $user['id'];
	  $price = 100;
	  if ($user['Membership'] == '1'){
		  $price = 0;
	  }
	  $getuploaded = mysql_fetch_array(mysql_query("SELECT * FROM `groups` WHERE `name`='$name'"));
	  if ($getuploaded != 0){
		  die("That name already exists!");
	  }
	  if ($user['Bucks'] < $price){
		  die("Not enough bucks!");
	  }
	  mysql_query("UPDATE `accounts` SET `Bucks`=`Bucks`-'$price' WHERE `id`='$ui'");
	  mysql_query("INSERT INTO `groups` (`ownerid`, `name`, `description`, `logopath`) VALUES ('$ui', '$name', '$desc', '$hasher')");
	  $getgrou = mysql_fetch_array(mysql_query("SELECT * FROM `groups` WHERE `name`='$name'"));
	  die("Your group has been created, <a href='Community.php?id=" . $getgrou['id'] . "'>Click here to go to it!");
      }
			  
	 }
else
  {
  echo "Some seems to have gone wrong... Try again later!";
  }
}
?>
<br /><br />
<form action="" method="post"
enctype="multipart/form-data">
<table>
<tr><td><b>Group Name:</b></td><td><input type="text" name="name" placeholder="" style="width: 99.4%" required="required" /></td></tr>
<tr><td><b>Group Description:</b></td><td><textarea name="desc" placeholder="" required="required" style="margin: 2px; width: 934px; height: 75px;"></textarea></td></tr>
<tr><td><b>Group Logo:</b></td><td><label for="file">Filename:</label>&nbsp;&nbsp;<input type="file" name="file" id="file"></td></tr></table><br />
<input type="submit" value="Create group for <?php if ($user['Membership'] == '1'){ ?>FREE!<?php }else{ ?>100 Bucks<?php } ?>" id="buttonsmall" />
</form>
