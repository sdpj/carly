<? include "../../header.php";
$item = $handler->query("SELECT * FROM items WHERE id=" . $_GET['id']);
$gI = $item->fetch(PDO::FETCH_OBJ);
if($gI->type != "body"){
$handler->query("UPDATE `users` SET `$gI->type`='' WHERE `id`='$myu->id'"); 
}else{
$handler->query("UPDATE `users` SET `$gI->type`='Avatar.png' WHERE `id`='$myu->id'");
}
?>
<head><meta http-equiv="refresh" content="1; url=/Customize/"></head>