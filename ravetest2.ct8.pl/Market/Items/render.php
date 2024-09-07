<? include "../../header.php";
$id = $_GET['id'];
$item = $handler->query("SELECT * FROM items WHERE id=" . $_GET['id']);
$gI = $item->fetch(PDO::FETCH_OBJ);
$getInv = $handler->query("SELECT * FROM inventory WHERE item='".$id."' AND user='".$myu->id."'");
$alreadyOwned = ($getInv->rowCount());
if ($alreadyOwned != "0") {
$handler->query("UPDATE `users` SET `$gI->type`='$gI->wearable' WHERE `id`='$myu->id'");
}else{
header("Location: /Customize"); exit; die();
}
?>
<head><meta http-equiv="refresh" content="1; url=/Customize/"></head>