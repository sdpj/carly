<?php include "../header.php";

if(!$user){
    header("Location:..");
}

?>


<? if(isset($_GET['ForumID'])){
$topicsql = $handler->query("SELECT * FROM topics WHERE id=" . $_GET['ForumID']);
$topic = $topicsql->fetch(PDO::FETCH_OBJ);
?>
<style>body{background-color:#fff!important;}</style>
<?

if($myu->admin == "true"){
$stickymeow = $_POST['sticky'];
}else{
$stickymeow = "0";
}

if(isset($_POST['save'])){
$hi = $handler->query("INSERT INTO threads (topicId, threadAdmin, threadTitle, threadBody, bump, date, sticky) VALUES ('".$_GET["ForumID"]."','$myu->id','".mysql_real_escape_string($_POST["title"])."','".mysql_real_escape_string($_POST["post"])."','".time()."','".time()."','".$stickymeow."')");
header("Location: /Forum/ShowPost.aspx?PostID=".$handler->lastInsertId());
}
?>


<div class="bg-white pt-2 pb-2">
   <div class="row">
      <div class="col-6">
         <p class="fw-bold"><a href="/Forum/"><?=$sitename;?> Forum</a> &raquo; <a href="/Forum/ShowForum.aspx?ForumID=<?=htmlspecialchars($_GET['ForumID']);?>"><?=$topic->name;?></a></p>
      </div>
      <div class="col-6">
         <p class="text-end fw-bold"><span><a class="normal" href="/Forum/Default.aspx">Home</a></span><span class="pe-1 ps-1">|</span><span><a class="normal" href="/Forum/MyForums.aspx">MyForums</a></span></p>
      </div>
   </div>
   <h3 class="mt-4 mb-4">New Post</h3>
   <table class="w-100">
      <thead>
         <tr>
            <td class="leftTable-0-2-56"></td>
            <td></td>
         </tr>
      </thead>
      <tbody>
      <form action="" method="POST">
         <tr>
            <td class="fw-bolder text-end">Subject:</td>
            <td><input type="text" class="w-100" name="title"> </td>
         </tr>
         <tr>
            <td class="fw-bolder text-end align-top">Message:</td>
            <td><textarea class="w-100" rows="12" name="post"></textarea><input type="submit" name="save" class="mt-1" value="Post" style="border: 2px solid black;">


<? if($myu->admin == "true"){ ?><j class="fw-light text-end align-top" style="margin-top: 5px; margin-left: 2px; margin-right: 3px; display: inline-block;"> | Pinned:</j><input type="checkbox" name="sticky" value="1"><? } ?>


</td>
         </tr>
       </form>
      </tbody>
   </table>
</div>

<?}?>





<? if(isset($_GET['PostID'])){

$id = $_GET['PostID'];

$thread = $handler->query("SELECT * FROM threads WHERE threadId=" . $id);

$gT = $thread->fetch(PDO::FETCH_OBJ);

$topicsql = $handler->query("SELECT * FROM topics WHERE id=" . $gT->topicId);

$topic = $topicsql->fetch(PDO::FETCH_OBJ);

$adminn = $handler->query("SELECT * FROM users WHERE username='$gT->threadAdmin'"); 

$admin = $adminn->fetch(PDO::FETCH_OBJ);

if($user){

?>
<style data-jss="" data-meta="Unthemed">
.subheaderCard-0-2-28 {
  background: #29508d;
}
.leftTable-0-2-29 {
  width: 100px;
}
.postText-0-2-30 {
  white-space: break-spaces;
}
body {
  background-color: #fff!important;
</style>
<div class="bg-white pt-2 pb-2">
   <div class="row">
      <div class="col-6">
         <p class="fw-bold"><a href="/Forum/"><?=$sitename;?> Forum</a> &#xBB; <a href="/Forum/ShowForum.aspx?ForumID=<?=$gT->topicId;?>"><?=$topic->name;?></a> &#xBB; <a href="/Forum/ShowPost.aspx?PostID=<?=$gT->threadId;?>"><?=htmlspecialchars($gT->threadTitle);?></a></p>
      </div>
      <div class="col-6">
         <p class="text-end fw-bold"><span><a class="normal" href="/Forum/Default.aspx">Home</a></span><span class="pe-1 ps-1">|</span><span><a class="normal" href="/Forum/MyForums.aspx">MyForums</a></span></p>
      </div>
   </div>
   <h3 class="mt-4 mb-4">Reply to Post</h3>
   <div class="subheaderCard-0-2-28">
      <h4 class="text-white text-center mb-0 pt-2 pb-2">Original Post</h4>
   </div>
<? $adminn = $handler->query("SELECT * FROM users WHERE id='$gT->threadAdmin'"); 
$admin = $adminn->fetch(PDO::FETCH_OBJ); ?>
   <p style="margin-bottom: 0px;"><a href="/Forum/ShowPost.aspx?PostID=<?=$gT->threadId;?>"><?=htmlspecialchars($gT->threadTitle);?></a>
   <p>Posted by <a href="/Profile?id=<?=$admin->id;?>"><?=$admin->username;?></a> on <?=date("m-d-y g:i A", $gT->date);?></p>
   <p class="postText-0-2-30" style="word-break:break-word;"><?=htmlspecialchars($gT->threadBody);?></p>
   </p>
   <div class="subheaderCard-0-2-28">
      <h4 class="text-white text-center mb-0 pt-2 pb-2">New Post</h4>
   </div>
   <table class="w-100">
      <thead>
         <tr>
            <td class="leftTable-0-2-29"></td>
            <td></td>
         </tr>
      </thead>
      <tbody>
       <form action="" method="POST">
         <tr>
            <td class="fw-bolder text-end">Subject:</td>
            <td>Re: <?=htmlspecialchars($gT->threadTitle);?></td>
         </tr>
         <tr>
            <td class="fw-bolder text-end align-top">Message:</td>
            <td><textarea class="w-100" rows="12" name="post"></textarea><input type="submit" name="save" class="mt-1" value="Post" style="border: 2px solid black;"></td>
         </tr>
        </form>
      </tbody>
   </table>
</div>


<?

if(isset($_POST['save'])){

$body=$_POST["post"];

$hi = $handler->query("INSERT INTO replies (threadId, postBy, postText, date, topicId) VALUES ('$id','$myu->id','".$_POST["post"]."','".time()."','".$gT->topicId."')");

$handler->query("UPDATE threads SET bump = '".time()."' WHERE threadId = '".$id."'");

header("Location: /Forum/ShowPost.aspx?PostID=".$id);

}

?>


<?}}?>

<?php include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>