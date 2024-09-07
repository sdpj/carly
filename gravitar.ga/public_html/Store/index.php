<?php
include('../global.php');
if ($_GET['Type']){
  $type = mysql_real_escape_string($_GET['Type']);
}else{
  $type = 2;
}
$page = 1;
if ($_GET['page']){
  $page = mysql_real_escape_string($_GET['page']);
}
if ($page > 1){
  $startFrom = (($page - 1) * 21);
}else{
  $startFrom = 0;
}
if ($_GET['Sort']){
  $sort = mysql_real_escape_string($_GET['Sort']);
  if ($type == 0){
  $c = mysql_query("SELECT * FROM `shop` WHERE `type`='$sort' AND `accepted`='1' AND `islimited`='1' ORDER BY id DESC LIMIT $startFrom, 21");
  }elseif ($type == 1){
  $c = mysql_query("SELECT * FROM `shop` WHERE `type`='$sort' AND `accepted`='1' AND `islimited`='1' ORDER BY id DESC LIMIT $startFrom, 21");
  }elseif ($type == 2){
    $c = mysql_query("SELECT * FROM `shop` WHERE `type`='$sort' AND `accepted`='1'  AND `islimited`='0' ORDER BY id DESC LIMIT $startFrom, 21");
  }elseif ($type == 3){
    $c = mysql_query("SELECT * FROM `shop` WHERE `type`='$sort' AND `accepted`='1' ORDER BY numbersold DESC LIMIT $startFrom, 21");
  }
}else{
  if ($type == 0){
    $c = mysql_query("SELECT * FROM `shop` WHERE `accepted`='1' AND `islimited`='1' ORDER BY id DESC LIMIT $startFrom, 21");
  }elseif ($type == 1){
    $c = mysql_query("SELECT * FROM `shop` WHERE `accepted`='1' AND `islimited`='1' ORDER BY id DESC LIMIT $startFrom, 21");
  }elseif ($type == 2){
  $c = mysql_query("SELECT * FROM `shop` WHERE `accepted`='1' AND `islimited`='0' ORDER BY id DESC LIMIT $startFrom, 21");
  }elseif ($type == 3){
  $c = mysql_query("SELECT * FROM `shop` WHERE `accepted`='1' ORDER BY numbersold DESC LIMIT $startFrom, 21");
  }
}
?>
<table width="98%">
<tr>
<td width="200">
<div style="box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);border-radius:5px;border: 0px solid black; color: black; background-color: white; padding: 8px; vertical-align: text-top;">
<?php
if ($logged == true){
    ?>
    <b><font color='red'>Limiteds only are displayed in the Limiteds tab.</font></b><br />
    <fieldset>
        <legend>Upload Item</legend>
        <a href="Upload.php" id="buttonsmall">Upload</a>
        </fieldset>
        <br><br>
        <?php
}
?>
<fieldset>
<legend>Store Type</legend>
<a href="?Type=1" id="buttonsmall2">Limiteds</a><br /><br>
<a href="?Type=2" id="buttonsmall">Main Items</a><br /><br>
<a href="?Type=3" id="buttonsmall">Most Popular</a>
</fieldset><br />
<fieldset>
<legend>Sort By</legend>
<a href="?Sort=Hat&Type=<?php print_r($type); ?>">Hats</a><br>
<a href="?Sort=Eye&Type=<?php print_r($type); ?>">Eyes</a><br>
<a href="?Sort=Face&Type=<?php print_r($type); ?>">Faces</a><br>
<a href="?Sort=Shirt&Type=<?php print_r($type); ?>">Shirts</a><br>
<a href="?Sort=Pants&Type=<?php print_r($type); ?>">Pants</a><br>
<a href="?Sort=Shoe&Type=<?php print_r($type); ?>">Shoes</a><br>
<a href="?Sort=Background&Type=<?php print_r($type); ?>">Backgrounds</a><br>
<a href="?Sort=Accessory&Type=<?php print_r($type); ?>">Accessories</a><br>
<a href="?Sort=Pet&Type=<?php print_r($type); ?>">Pets</a><br>
</fieldset>
</div>
</td>
<td style="text-align: right; vertical-align: text-top; width: 80%;">
<table width=""><tr>
<?php
$o = 0;
$cc = mysql_num_rows($c);
for ($count = 1; $count <= $cc; $count ++){
  $cr = mysql_fetch_array($c);
  $o ++;
  ?>
    <td width="100" height="240" style="box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);border-radius:5px;overflow:hidden;max-width: 100px; padding: 3px; border: 0px solid black; background-color: white; color: black; text-align: center; ">
    <a title="<?php print_r(htmlspecialchars($cr['Name'])); ?>" href="Item.php?id=<?php print_r($cr['id']); ?>">
    <img src="/assets/Avatars/<?php print_r($cr['path']); ?>" <?php if ($cr['islimited'] != 0){ ?>style="position: absolute;"<?php } ?> width="100" height="195" border="0" />
    <?php
  if ($cr['islimited'] != 0){
    ?>
        <img src="/assets/Limited.png" width="100" height="195" st/>
        <?php
  }
  ?>
    <br />
    <?php
  if (strlen($cr['Name']) > 50){
    print_r(substr($cr['Name'], 0, 50) . "..");
  }else{
    print_r($cr['Name']);
  }
  ?>
    </a><br />
    By: <?php
  $ceoid = $cr['creatorid'];
  $creatorarray = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$ceoid'"));
  print_r("<a href='/Profile.php?id=" . $ceoid . "'>" . $creatorarray['Username'] . "</a>");
  ?><br />
    <?php
  if ($cr['price'] == '0'){
    print_r("<font color='#FF9900'><img src='/assets//reebs.png'> " . $cr['reebprice'] . "</font>");
  }else{
    print_r("<font color='#00CC00'><img src='/assets//bucks.png'> " . $cr['price'] . "</font>");
  }
  ?>
    </td>
    <?php
  if ($o == 7){
    echo '</tr><tr>';
    $o = 0;
  }
}
?>
</tr>
</td>
</tr>
</table>
</table>
  
<center>
<?php
if ($type == 0){
$sql = "SELECT COUNT(id) FROM shop WHERE `accepted`='1' AND `islimited`='1'"; 
}else{
$sql = "SELECT COUNT(id) FROM shop WHERE `accepted`='1' AND `islimited`='1'";   
}
$rs_result = mysql_query($sql,$con); 
$row = mysql_fetch_row($rs_result); 
$total_records = $row[0]; 
$total_pages = ceil($total_records / 21);
if ($page > 1){
  ?>
    <a href="?page=<?php print_r($page - 1); ?>&Type=<?php print_r($type); ?>" id="buttonsmall">Back</a>
    <?php
}
?>

&nbsp;&nbsp;&nbsp;&nbsp;Page <?php print_r($page); ?> of <?php print_r($total_pages); ?>
<?php
if ($page < $total_pages){
  ?>
  &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="?page=<?php print_r($page + 1); ?>&Type=<?php print_r($type); ?>" id="buttonsmall">Next</a>
    <?php
}?>
 <br><br><?php
include "../Footer.php";
?> 