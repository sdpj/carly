<? include("../Site/init.php");
if ($myu->admin=="true"){ 

$id = $_GET['id'];

$handler->query("DELETE FROM `blog` WHERE `id` = '".$id."'"); 

}

header("Location: /Blog/");
?>