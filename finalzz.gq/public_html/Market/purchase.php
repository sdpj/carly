<? include "../header.php";
if ($user){
$money=$myu->emeralds;
$id=$_GET['id'];
$item = $handler->query("SELECT * FROM items WHERE id=" . $id);
$gB = $item->fetch(PDO::FETCH_OBJ);
if ($gB->onsale == 1){
if ($money > $gB->price){
$new = ($money - $gB->price);
$handler->query("UPDATE `users` SET `emeralds`='$new' WHERE `id`='$myu->id'");
$handler->query("INSERT INTO inventory (item,user) VALUES ($id,$myu->id)");
}
} else {
?> <center><h2>Item not on sale!</h2></center> <?
}
}
?>

<head><meta http-equiv="refresh" content="1; url=/Customize/"></head>