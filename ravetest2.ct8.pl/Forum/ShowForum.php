<? include "../header.php"; $id = $_GET['ForumID']; 
$getTopic = $handler->query("SELECT * FROM topics WHERE id='$id'") or die("That topic does not exist.");
; 
$topic = $getTopic->fetch(PDO::FETCH_OBJ); 



$Setting = array(
	"PerPage" => 10
	);
	$page = mysql_real_escape_string(strip_tags(stripslashes($_GET['page'])));
	if ($page < 1) { $page=1; }
	if (!is_numeric($page)) { $page=1; }
	$Minimum = ($page - 1) * $Setting["PerPage"];
        $allthreads = $handler->query("SELECT * FROM threads WHERE topicId='".$id."'");
        $num = $allthreads->rowCount();

?>
    <?php
            $result = mysql_query("SELECT * FROM topics WHERE id=" . $_GET['ForumID']) or die("That topic does not exist.");
            while($row = mysql_fetch_assoc($result)){ 
    ?>
    <?php } ?>

<style data-jss="" data-meta="Unthemed">
.headerRow-0-2-25 {
  background: #29508d;
}
.headerRow-0-2-25 th {
  color: #fff;
  font-size: 1.25rem;
  font-weight: 500;
  padding-top: 0.5rem;
  padding-left: 0.25rem;
  padding-bottom: 0.5rem;
}
.bodyRow-0-2-26 {
  background: #f9f9f9;
}
.bodyRow-0-2-26:hover {
  background: #e9e9e9;
}
.lastPostHeader-0-2-27 {
  min-width: 110px;
}
body {
  background-color: #ffffff !important;
}
</style>
<div class="bg-white pt-2 pb-2">
   <div class="row">
      <div class="col-6">
         <p class="fw-bold"><a href="/Forum/"><?=$sitename;?> Forum</a> » <a href="/Forum/ShowForum.aspx?ForumID=<?=$topic->id;?>"><?=$topic->name;?></a></p>
      </div>
      <div class="col-6">
         <p class="text-end fw-bold"><span><a class="normal" href="/Forum/">Home</a></span><span class="pe-1 ps-1">|</span><span><a class="normal" href="/Forum/MyForums.aspx">MyForums</a></span></p>
      </div>
   </div>
   <div class="w-100">
      <?php if($user) {?><div class="float-left"><a href="/Forum/AddPost.aspx?ForumID=<?=$id;?>">New Thread</a></div><?}?>
   </div>
   <table class="w-100">
      <thead class="header-0-2-24">
         <tr class="headerRow-0-2-25">
            <th>Subject</th>
            <th>Author</th>
            <th class="text-center">Replies</th>
            <th class="text-center">Views</th>
            <th class="text-center">Last Post</th>
         </tr>
      </thead>
      <tbody>
<? $getThreads = $handler->query("SELECT * FROM threads WHERE topicId='$id' ORDER BY bump DESC LIMIT ".$Minimum.", ". $Setting["PerPage"]."");
while($gT = $getThreads->fetch(PDO::FETCH_OBJ)){ 
$getReplies = $handler->query("SELECT * FROM replies WHERE threadId='$gT->threadId'"); 
$adminn = $handler->query("SELECT * FROM users WHERE id='$gT->threadAdmin'"); 
$admin = $adminn->fetch(PDO::FETCH_OBJ);

$latestreplysql = $handler->query("SELECT * FROM replies WHERE threadId=" . $gT->threadId." ORDER BY postId DESC LIMIT 1");
$latestreply = $latestreplysql->fetch(PDO::FETCH_OBJ);

if($latestreplysql->rowCount() > 0){
$latestreplyuser = $latestreply->postBy;
}else{
$latestreplyuser = $gT->threadAdmin;
}

$adminn2 = $handler->query("SELECT * FROM users WHERE id='$latestreplyuser'"); 
$admin2 = $adminn2->fetch(PDO::FETCH_OBJ);

if($gT->sticky == "0"){
$timeorpinnedtext = relativetime($gT->bump);
}else{
$timeorpinnedtext = "Pinned Post";
}
?>
         <tr class="bodyRow-0-2-26">
            <td>
               <a class="normal" href="/Forum/ShowPost.aspx?PostID=<?=$gT->threadId;?>">
                  <div class="d-inline-block"><img src="/img/thread-unread.png" alt="Thread Icon"></div>
                  <div class="d-inline-block"><?=htmlspecialchars($gT->threadTitle);?></div>
               </a>
            </td>
            <td><?=$admin->username;?></td>
            <td class="text-center"><?=$getReplies->rowCount();?></td>
            <td class="text-center"><?=$gT->views;?></td>
            <td>
            <p class="text-center mb-0 fw-bold"><?php echo $timeorpinnedtext;?></p>
            <p class="text-center mb-0"><a class="normal" href="/users/<?=$admin2->id;?>/profile" style="font-size:14px;"><?=$admin2->username;?></a></p>
            </td>
            </tr>
<?}?>
      </tbody>
      <thead class="header-0-2-24">
         <tr class="headerRow-0-2-25">
            <th>
               <p class="mb-0">&emsp;</p>
            </th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
         </tr>
      </thead>
   </table>

   <div class="row">
      <div class="col-6">
         <p class="fw-bolder">Page <?=htmlspecialchars($page);?></p>
      </div>
      <div class="col-6">
         <p class="mb-0 text-end"><span>
         <?
	$amount=ceil($num / $Setting["PerPage"]);
	if ($page > 1) { $otherpage1 = $page - 1;
	echo '<style>.leftthing{margin-left:5px;}</style><a href="/Forum/ShowForum.aspx?ForumID='.$id.'&page='.($page-1).'" style="display:inline-block!important;">'.$otherpage1.'</a>';
	}
        echo "<thing class='leftthing rightthing'>".htmlspecialchars($page)."</thing>";
	if ($page < ($amount)) { $otherpage2 = $page + 1;
	echo '<style>.rightthing{margin-right:5px;}</style><a href="/Forum/ShowForum.aspx?ForumID='.$id.'&page='.($page+1).'" style="display:inline-block!important;">'.$otherpage2.'</a>';
	}
?>
      </span></p>
      </div>
   </div>
</div>
<? include "../footer.php"; ?>