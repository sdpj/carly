<? include "../../header.php";

if($user){

$id = $_GET['id'];

$antiflamesploit = $handler->query("SELECT * FROM groupmembers WHERE groupid='$id' and userid='$myu->id'");

if($antiflamesploit->rowCount() == "0"){

$handler->query("INSERT INTO groupmembers (userid, groupid) VALUES ('$myu->id','$id')");

}

}

header('Location: /Groups/Club/?id='.$id);

?>