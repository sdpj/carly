<?php
include('../global.php');
?><head>
<style>
.kk:hover{
  background-color: #BAF0F0;
}
</style>
</head>


<h1 style="margin:0px;text-align:center;font-weight:normal;">Gravitar Forum</h1>
<br />

<div style="width: 98%; max-width: 98%;  border: 0px solid black; padding: 3px; text-align: left; color:#333;background-color:rgb(126, 180, 231);border-bottom: 2px solid #4a85c0;border-top-left-radius: 4px;border-top-right-radius: 4px;font-size: 1.5rem; font-weight: 600;">
<table width="98%"><tr>
<td width="98%" style="position: relative; top: 4px;">
Boards
</td>
<td style="text-align: right;position: relative; top: 4px;">
Threads
</td></tr></table>
</style>
</div>
<?php
$i = mysql_query("SELECT * FROM `forumboards` ORDER BY `id`");
$ii = mysql_num_rows($i);
$r = 0;
for ($count=1; $count<=$ii; $count++){
  if ($r == 0){ $r = 1; }else{ $r = 0; }
$iii = mysql_fetch_array($i);
$groupid = $iii['group'];
?>
<div style="width: 98%; max-width: 98%; background-color: #<?php
if ($r == 0){
  print_r("E5E5E5");
}else{
  print_r("FFF");
}
?>; border: 0px solid black; padding: 3px; text-align: left; color:black;">
<table width="98%">
<tr><td width="80%">
<div id="kk" style="width: 98%; overflow: auto; padding: 7px; text-align: left; border-radius: 5px;">
<table width="98%">
<tr><td><a href="Forum.php?id=<?php print_r($iii['id']); ?>"><?php print_r($iii['name']); ?></a><br /><font size="2" color="#000000"><?php print_r($iii['description']); ?></font></td><td><td style="text-align: right;"><b><?php print_r(mysql_num_rows(mysql_query("SELECT * FROM `forumthreads` WHERE `inid`='$iii[id]' ORDER BY id")));  ?></b>

</table>
</div>
</td>
</tr>
</table>
</div>
<?php
}
?>
</div></div><br><br>
<?php include('../Footer.php');?>