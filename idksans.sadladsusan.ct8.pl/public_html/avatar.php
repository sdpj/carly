<? $bannedcanview = "true"; include "Site/init.php"; 

if($_GET['id']){

$id = $_GET['id'];

$getUser = $handler->query("SELECT * FROM users WHERE id='$id'");

} $gU = $getUser->fetch(PDO::FETCH_OBJ); 

if($gU->face){

$face = $gU->face;

} else {

$face = "2016smile.png";

}

?>

<div style="position:absolute; width:200; height:200; z-index:1; background-image:url('../Market/Storage/<?php print_r($gU->outfit); ?>');"></div>
<div style="position:absolute; width:200; height:200; z-index:3; background-image:url('../Market/Storage/<?php print_r($gU->hat); ?>');"></div>
<div style="position:absolute; width:200; height:200; z-index:2; background-image:url('../Market/Storage/<?php print_r($gU->hair); ?>');"></div>
<div style="position:absolute; width:200; height:200; z-index:2; background-image:url('../Market/Storage/<?php print_r($face); ?>');"></div>
<div style="width:200; height:200; z-index:0; background-image:url('../Market/Storage/<?php print_r($gU->body); ?>');"></div>
