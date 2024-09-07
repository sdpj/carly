<? include "../../header.php";

$id = $_GET['id'];

$thread = $handler->query("SELECT * FROM threads WHERE threadId=" . $id);

$gT = $thread->fetch(PDO::FETCH_OBJ);

$topicid = $gT->topicId;


if ($myu->admin=="true"){ 

$handler->query("DELETE FROM threads WHERE threadId=" . $id); 

}



if ($gT->threadAdmin==$myu->id){ 

$handler->query("DELETE FROM threads WHERE threadId=" . $id); 

}

header("Location: /Forum/topic.php?id=".$topicid); ?>