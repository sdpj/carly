<?php include "../../header.php"; 

if(!$user){
    header("Location:..");
}

$topicsql = $handler->query("SELECT * FROM topics WHERE id=" . $_GET['id']);
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
$hi = $handler->query("INSERT INTO threads (topicId, threadAdmin, threadTitle, threadBody, bump, date, sticky) VALUES ('".$_GET["id"]."','$myu->id','".mysql_real_escape_string($_POST["title"])."','".mysql_real_escape_string($_POST["post"])."','".time()."','".time()."','".$stickymeow."')");
header("Location: /Forum/ShowPost.aspx?PostID=".$handler->lastInsertId());
}
?>


<div class="bg-white pt-2 pb-2">
   <div class="row">
      <div class="col-6">
         <p class="fw-bold"><a href="/Forum/"><?=$sitename;?> Forum</a> » <a href="/Forum/topic.php?id=<?=htmlspecialchars($_GET['id']);?>"><?=$topic->name;?></a></p>
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


<?php include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>