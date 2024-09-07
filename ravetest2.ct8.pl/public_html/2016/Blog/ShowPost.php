<? $bannedcanview = "true"; include "../header.php"; 
$id = $_GET['id'];
$thread = $handler->query("SELECT * FROM blog WHERE id=" . $id);
$replies = $handler->query("SELECT * FROM replies WHERE threadId=" . $id);
$gT = $thread->fetch(PDO::FETCH_OBJ);
$topicsql = $handler->query("SELECT * FROM blog WHERE id=" . $gT->id);
$topic = $topicsql->fetch(PDO::FETCH_OBJ);

$alltopicssql = $handler->query("SELECT * FROM blog");

$mytopicssql = $handler->query("SELECT * FROM blog WHERE author = ". $gT->author);

if($alltopicssql->rowCount() > $id){ $debugthing = "true";
$nextid = $id + 1;
}else{ $debugthing = "false";
$nextid = $id;
} // echo $debugthing;

if($id > 1){
$previousid = $id - 1;
}else{
$previousid = "1";
}
?> 
<style data-jss="" data-meta="Unthemed">
.forumHeader-0-2-91 {
  background: #29508d;
}
.avatarHead-0-2-92 {
  width: 150px;
}
.postRow-0-2-93 {
  background: #f9f9f9;
  border-bottom: 1px solid #c3c3c3;
}
.userStat-0-2-94 {
  font-size: 0.9rem;
  margin-bottom: 0;
}
.postText-0-2-95 {
  word-wrap: anywhere;
  white-space: break-spaces;
}
body {
  background-color: #ffffff !important;
}
</style>
<div class="bg-white pt-2 pb-2">
   <div class="row">
      <div class="col-6">
         <p class="fw-bold"><a href="/Blog/"><?=$sitename;?> Blog</a> &#xbb; <a href="/Blog/ShowPost.php?id=<?=$gT->id;?>"><?=htmlspecialchars($gT->title);?></a></p>
      </div>
   </div>
   <h3><?=htmlspecialchars($gT->title);?> <? if ($myu->admin == "true"){ ?><a href="/Blog/delete.php?id=<?=$id;?>">(Delete)</a><?}?></h3>
   <div class="forumHeader-0-2-91">
      <h4 class="text-end pe-2 pt-1 pb-1 text-white mb-0"><a class="text-white" href="/Blog/ShowPost.php?id=<?=$previousid;?>">Previous Post</a><span class="fw-bolder ps-1 pe-1 text-black">::</span><a class="text-white" href="/Blog/ShowPost.php?id=<?=$nextid;?>">Next Post</a></h4>
   </div>
   <table class="w-100">
      <thead>
         <tr>
            <th class="avatarHead-0-2-92"></th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         <tr class="postRow-0-2-93">
            <td class="align-top">
<? $adminn = $handler->query("SELECT * FROM users WHERE id='$gT->author'"); 
$admin = $adminn->fetch(PDO::FETCH_OBJ); ?>
               <a href="/Profile?id=<?=$admin->id;?>"><?=$admin->username;?></a><iframe frameborder="0" src="/avatar.php?id=<? echo $admin->id ?>" scrolling="no" style=" width: 200px; height: 200px"></iframe>
               <p class="userStat-0-2-94"><span class="fw-bold">Joined: </span><span>1 Jan 2000</span></p>
               <p class="userStat-0-2-94 mb-4"><span class="fw-bold">Total Blogs: </span><span><?=$mytopicssql->rowCount();?></span></p>
            </td>
            <td class="align-top">
               <div class="ps-4">
                  <p class="mb-0">1-1-2000 00:00 AM</p>
                  <p class="mt-1 postText-0-2-95"><?=htmlspecialchars($gT->content);?></p>
               </div>
            </td>
         </tr>
      </tbody>
   </table>
   <div class="forumHeader-0-2-91">
      <h4 class="text-end pe-2 pt-1 pb-1 text-white mb-0"><a class="text-white" href="/Blog/ShowPost.php?id=<?=$previousid;?>">Previous Post</a><span class="fw-bolder ps-1 pe-1 text-black">::</span><a class="text-white" href="/Blog/ShowPost.php?id=<?=$nextid;?>">Next Post</a></h4>
   </div>
   </div>

<? include "../footer.php"; ?>