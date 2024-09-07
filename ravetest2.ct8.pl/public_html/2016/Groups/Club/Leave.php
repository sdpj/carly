<? include "../../header.php"; 

$id = $_GET['id'];

if($user){

$handler->query("DELETE FROM groupmembers WHERE userid='$myu->id' AND groupid='$id'");

}

header('Location: /Groups/Club/?id='.$id);

?>