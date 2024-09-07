<?php
include('../global.php');

$page = 1;
$filter = 0;
if ($_GET['page'])
  $page = mysql_real_escape_string($_GET['page']);

if ($page > 1){
  $startFrom = (($page - 1) * 8);
}else{
  $startFrom = 0;
}
if ($_GET['q']){
  $qqq = mysql_real_escape_string($_GET['q']);
  $q = mysql_query("SELECT * FROM `groups` WHERE `name`='$qqq'");
}else{
  $q = mysql_query("SELECT * FROM `groups` ORDER BY `id` LIMIT $startFrom, 8");

}
?>
<center><div style="box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);border-radius:5px;padding: 7px; width: 50%; max-width: 51%; border: 0px solid #999; background-color: #FFFFFF; color: black; text-align: center; vertical-align: central;">
<form action="" method="get">
Search: <input type="text" name="q" style="background-color:#f9f9f9;box-shadow:2px 1px 4px 0px rgb(0 0 0 / 9%);border-radius:3px;border: 0px;outline: none;" />&nbsp;&nbsp;&nbsp;<input type="submit" id="buttonsmall" value="Search" style="background-color: #04AA6D; border: none; color: white; cursor: pointer; border-radius: 5px;" />
</form>
</div></center>
<?php if ($logged == true){
  ?>
<br>
  <a href="Create.php" id="buttonsmall" style="margin:auto;width:5%;display:block;text-align:center;/*background-color: #04AA6D;*/ border: none; color: white; cursor: pointer; border-radius: 5px;">Create</a>
    <?php
}
echo "<br>";?>
<?php
$qq = mysql_num_rows($q);
for ($count = 1; $count <= $qq; $count ++){
  $qr = mysql_fetch_array($q);
  ?>
  <div style="margin:auto;overflow:hidden;width:15%;border-radius:5px;box-shadow: 3px 4px 12px 0px rgb(0 0 0 / 15%);padding: 7px; border: 0px solid #999; background-color: #FFFFFF; color: black; text-align: left; vertical-align: central;">
    <table width="98%">
    <tr>
    <td width="100">
    <a href="Community.php?id=<?php print_r($qr['id']); ?>"><img src="/assets/groupimg/<?php print_r($qr['logopath']); ?>" width="100" style="height: 100px; width: auto;" border="0" /></a><br>
    
    <a href="Community.php?id=<?php print_r($qr['id']); ?>"><?php print_r($qr['name']); ?></a><br>
      <font color="gray">
    Owner: <?php
    $ownerid = $qr['ownerid'];
  $owner = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='$ownerid'"));
  ?><a href="/Profile.php?id=<?php print_r($ownerid); ?>"><?php print_r($owner['Username']); ?></a>
    <br>Members: <?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `groupmembers` WHERE `groupid`='$qr[id]' ORDER BY id"))); ?></font>
    </td>
    <td>
    
    </td>
    </tr>
    </table>
    </div><br>
    <?php
}
?>
<center>
<?php
$sql = "SELECT COUNT(id) FROM `groups` ORDER BY id"; 
$rs_result = mysql_query($sql,$con); 
$row = mysql_fetch_row($rs_result); 
$total_records = $row[0]; 
$total_pages = ceil($total_records / 8);
if ($page > 1){
  ?>
    <a href="?page=<?php print_r($page - 1); ?>" id="buttonsmall">Back</a>
    <?php
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;Page <?php print_r($page); ?> of <?php print_r($total_pages); ?>
<?php
if ($page < $total_pages){
  ?>
  &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="?page=<?php print_r($page + 1); ?>" id="buttonsmall">Next</a>
    <?php
}
?>
</center>
<br>
<?php include('../Footer.php');?>