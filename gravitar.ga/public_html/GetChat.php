<script>
var objDiv = document.getElementById("chat");
objDiv.scrollTop = objDiv.scrollHeight;
</script>
<?php
$con = mysql_pconnect("mysql.ct8.pl", "m27001_gravitar", "Sg090228") or die("Something went wrong while connecting to the database - ID: 1");
mysql_select_db("m27001_gravitar", $con) or die("Something went wrong while connecting to the database - ID: 2");
$logged = false;
if ($_COOKIE['ck_usrn'] && $_COOKIE['ch_salt']){
  $urn = mysql_real_escape_string($_COOKIE['ck_usrn']);
  $sal = mysql_real_escape_string($_COOKIE['ch_salt']);
  $uss = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `salt`='$sal'"));
  if ($uss != '0'){
    if (hash("ripemd160", strtolower($uss['Username']) == $urn)){
      $logged = true;
      $user = $uss;
      $myU = mysql_fetch_object($ui = mysql_query("SELECT * FROM `accounts` WHERE `salt`='$sal'"));
    }else{
      $logged = false;  
    }
  }
}

?>
<table width="98%"><?php
$c = mysql_query("SELECT * FROM `chat` ORDER BY id DESC");
$cc = mysql_num_rows($c);
for ($count=1; $count <= $cc; $count ++){
  $cr =mysql_fetch_array($c);
  $ui = $cr['userid'];
  $fuser = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$ui'"));
  ?>
  <tr>
    <td width="150">
    <strong><a href="Profile.php?id=<?php print_r($ui); ?>"><?php print_r($fuser['Username']); ?></a> Wrote:</strong></td>
    <td width="1000" style="max-width: 1000px; overflow: visible;">
    <?php print_r($cr['comment']); ?>
    <?php
  if ($logged==true){
    if ($user['powerForumMod'] == '1' || $user['powerImageMod'] == '1' || $user['powerCM'] == '1' || $user['powerHeadMod'] == '1' || $user['Username'] == 'Syncro'){
      if ($_GET['delete']){
        $id = $_GET['delete'];
        mysql_query("DELETE FROM chat WHERE id='$id'");
        die("Done, <a href='Chat.php'>back to chat page.</a>");
      }
      ?>
            <a href="?delete=<?php print_r($cr['id']); ?>">[Delete]</a>
            <?php
    }
  }
  ?>
  </td>
    <td width="300">
    <strong>
    <?php print_r($cr['date']); ?>
  </strong>
    </td>
    </tr>
    <?php
}