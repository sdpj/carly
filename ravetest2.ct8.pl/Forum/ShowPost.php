<? include "../header.php"; 
$id = $_GET['PostID'];
$thread = $handler->query("SELECT * FROM threads WHERE threadId=" . $id);
$replies = $handler->query("SELECT * FROM replies WHERE threadId=" . $id." ORDER BY postId ASC");
$gT = $thread->fetch(PDO::FETCH_OBJ);
$topicsql = $handler->query("SELECT * FROM topics WHERE id=" . $gT->topicId);
$topic = $topicsql->fetch(PDO::FETCH_OBJ);

$alltopicssql = $handler->query("SELECT * FROM threads");

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

// view count updater

$newviews = $gT->views + 1;

$handler->query("UPDATE `threads` SET `views` = '".$newviews."' WHERE `threadId` = '".$gT->threadId."'");

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
         <p class="fw-bold"><a href="/Forum/"><?=$sitename;?> Forum</a> » <a href="/Forum/ShowForum.aspx?ForumID=<?=$gT->topicId;?>"><?=$topic->name;?></a> » <a href="/Forum/ShowPost.aspx?PostID=<?=$gT->threadId;?>"><?=htmlspecialchars($gT->threadTitle);?></a></p>
      </div>
      <div class="col-6">
         <p class="text-end fw-bold"><span><a class="normal" href="/Forum/Default.aspx">Home</a></span><span class="pe-1 ps-1">|</span><span><a class="normal" href="/Forum/MyForums.aspx">MyForums</a></span></p>
      </div>
   </div>
   <h3><?=htmlspecialchars($gT->threadTitle);?> <? if ($myu->admin == "true"){ ?><!--<a href="/Forum/Thread/delete.php?id=<?=$id;?>">(Delete)</a>--><?}?></h3>
   <div class="forumHeader-0-2-91">
      <h4 class="text-end pe-2 pt-1 pb-1 text-white mb-0"><a class="text-white" href="/Forum/ShowPost.aspx?PostID=<?=$previousid;?>">Previous Thread</a><span class="fw-bolder ps-1 pe-1 text-black">::</span><a class="text-white" href="/Forum/ShowPost.aspx?PostID=<?=$nextid;?>">Next Thread</a></h4>
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
<? $adminn = $handler->query("SELECT * FROM users WHERE id='$gT->threadAdmin'"); 
$admin = $adminn->fetch(PDO::FETCH_OBJ); 

   $posterthreadssql = $handler->query("SELECT * FROM threads WHERE threadAdmin='$gT->threadAdmin'");
   $posterthreads = $posterthreadssql->fetch(PDO::FETCH_OBJ);
   
   $posterrepliessql = $handler->query("SELECT * FROM replies WHERE postBy='$gT->threadAdmin'"); 
   $posterreplies = $posterrepliessql->fetch(PDO::FETCH_OBJ);
   
   $totalposts = $posterthreadssql->rowCount() + $posterrepliessql->rowCount();

   $candeleteop = "false";

   if($myu->id == $admin->id){
   $candeleteop = "true";
   }

   if($myu->admin == "true"){
   $candeleteop = "true";
   }

   if($now < $admin->expiretime){
   $opindicator = "Online";
   }else{
   $opindicator = "Offline";
   }
?>
               <img src="/images/user_Is<?=$opindicator;?>.gif" alt="<?=$admin->username;?> is <?=strtolower($opindicator);?>." style="border-width: 0px; margin-bottom: 3px; margin-right: 2px;"><a href="/users/<?=$admin->id;?>/profile"><?=$admin->username;?></a><iframe frameborder="0" src="/avatar.php?id=<? echo $admin->id ?>" scrolling="no" style=" width: 200px; height: 200px; display: block;"></iframe>
               <? if($admin->admin == "true"){ ?><p class="userStat-0-2-94"><img src="/images/users_moderator.gif" alt="Forum Moderator" style="border-width:0px;"></p><? } ?>
               <p class="userStat-0-2-94"><span class="fw-bold">Joined: </span><span><?=date("j M Y", $admin->datecreated);?></span></p>
               <p class="userStat-0-2-94 mb-4"><span class="fw-bold">Total Posts: </span><span><?=$totalposts;?></span></p>
            </td>
            <td class="align-top">
               <div class="ps-4">
                  <p class="mb-0"><?=date("m/d/Y g:i A", $gT->date);?></p>
                  <p class="mt-1 postText-0-2-95"><?=htmlspecialchars($gT->threadBody);?></p>
                  <? if($candeleteop == "true"){?><a class="text-danger cursor-pointer" href="/Forum/Thread/delete.php?id=<?=$id;?>">Delete</a><?}?>
               </div>
            </td>
         </tr>
<? while($gR = $replies->fetch(PDO::FETCH_OBJ)){ ?>
         <tr class="postRow-0-2-93" style="border-top: 1px solid #c3c3c3; border-bottom: 0px;">
            <td class="align-top">
<? $poster = $handler->query("SELECT * FROM users WHERE id='$gR->postBy'"); 
   $postby = $poster->fetch(PDO::FETCH_OBJ); 

   $posterthreadssql = $handler->query("SELECT * FROM threads WHERE threadAdmin='$gR->postBy'");
   $posterthreads = $posterthreadssql->fetch(PDO::FETCH_OBJ);
   
   $posterrepliessql = $handler->query("SELECT * FROM replies WHERE postBy='$gR->postBy'"); 
   $posterreplies = $posterrepliessql->fetch(PDO::FETCH_OBJ);
   
   $totalposts = $posterthreadssql->rowCount() + $posterrepliessql->rowCount();

   $candeletereply = "false";

   if($myu->id == $gR->postBy){
   $candeletereply = "true";
   }

   if($myu->admin == "true"){
   $candeletereply = "true";
   }

   if($now < $postby->expiretime){
   $replierindicator = "Online";
   }else{
   $replierindicator = "Offline";
   }
?>

               <img src="/images/user_Is<?=$replierindicator;?>.gif" alt="<?=$postby->username;?> is <?=strtolower($replierindicator);?>." style="border-width: 0px; margin-bottom: 3px; margin-right: 2px;"><a href="/users/<?=$postby->id;?>/profile"><?=$postby->username;?></a><iframe frameborder="0" src="/avatar.php?id=<? echo $postby->id ?>" scrolling="no" style=" width: 200px; height: 200px; display: block;"></iframe>
               <? if($postby->admin == "true"){ ?><p class="userStat-0-2-94"><img src="/images/users_moderator.gif" alt="Forum Moderator" style="border-width:0px;"></p><? } ?>
               <p class="userStat-0-2-94"><span class="fw-bold">Joined: </span><span><?=date("j M Y", $postby->datecreated);?></span></p>
               <p class="userStat-0-2-94 mb-4"><span class="fw-bold">Total Posts: </span><span><?=$totalposts;?></span></p>
            </td>
            <td class="align-top">
               <div class="ps-4">
                  <p class="mb-0"><?=date("m/d/Y g:i A", $gR->date);?></p>
                  <p class="mt-1 postText-0-2-95"><?=htmlspecialchars($gR->postText);?></p>
                  <? if($candeletereply == "true"){?><a class="text-danger cursor-pointer" href="#">Delete</a><?}?>
               </div>
            </td>
         </tr>
<?}?>
      </tbody>
   </table>
   <div class="forumHeader-0-2-91">
      <h4 class="text-end pe-2 pt-1 pb-1 text-white mb-0"><a class="text-white" href="/Forum/ShowPost.aspx?PostID=<?=$previousid;?>">Previous Thread</a><span class="fw-bolder ps-1 pe-1 text-black">::</span><a class="text-white" href="/Forum/ShowPost.aspx?PostID=<?=$nextid;?>">Next Thread</a></h4>
   </div>
   <div class="row">
      <div class="col-6">
         <p class="fw-bold">Page 1</p>
      </div>
      <div class="col-6">
         <p class="mb-0 text-end"><span>1</span></p>
      </div>
   </div>
   <?php if($user){?><p class="text-center mb-0 mt-4"><a href="AddPost.aspx?PostID=<?=$id;?>&mode=flat">Add a Reply</a></p><?}?>
</div>

<? include "../footer.php"; ?>