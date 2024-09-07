<? include "../header.php";
if ($user){
$money=$myu->emeralds;
$id=$_GET['id'];
$item = $handler->query("SELECT * FROM items WHERE id=" . $id);
$gB = $item->fetch(PDO::FETCH_OBJ);
$getInv = $handler->query("SELECT * FROM inventory WHERE item='".$id."' AND user='".$myu->id."'");
$alreadyOwned = ($getInv->rowCount());
if ($alreadyOwned != "0") {
header("Location: /Customize"); exit; die();
}
if ($gB->onsale == 1){
if ($money > $gB->price){
$new = ($money - $gB->price);
$sales = ($gB->sales + 1);
$handler->query("UPDATE `users` SET `emeralds`='$new' WHERE `id`='$myu->id'");
$handler->query("UPDATE `items` SET `sales`='$sales' WHERE `id`='$gB->id'");
$handler->query("INSERT INTO inventory (item,user) VALUES ($id,$myu->id)");
}
} else {
?> <center><h2>Item not on sale!</h2></center> <?
}
}
?>

<head><meta http-equiv="refresh" content="1; url=/Customize/"></head>