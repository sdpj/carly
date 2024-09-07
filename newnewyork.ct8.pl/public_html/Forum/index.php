<?php include "../header.php"; ?>
<style data-jss="" data-meta="Unthemed">
.headerRow-0-2-103 {
  background: #29508d;
}
.headerRow-0-2-103 th {
  color: #fff;
  font-size: 1.25rem;
  font-weight: 500;
  padding-top: 0.5rem;
  padding-left: 0.25rem;
  padding-bottom: 0.5rem;
}
.bodyRow-0-2-104 {
  background: #f9f9f9;
}
.bodyRow-0-2-104:hover {
  background: #e9e9e9;
}
.lastPostHeader-0-2-105 {
  min-width: 110px;
}
body {
  background-color: #ffffff !important;
}
.mainthing {
  width: 70% !important;
}
</style>
<div class="mt-4">
   <div class="bg-white pt-2 pb-2">
      <div class="row">
         <div class="col-6">
            <p><span class="fw-bold">Current time: </span><span><?=date('M j, h:i A', time());?></span></p>
         </div>
         <div class="col-6">
            <p class="text-end fw-bold"><span><a class="normal" href="/Forum/">Home</a></span><span class="pe-1 ps-1">|</span><span><a class="normal" href="/Forum/MyForums.aspx">MyForums</a></span></p>
         </div>
      </div>
      <table class="w-100">
         <thead class="header-0-2-102">
            <tr class="headerRow-0-2-103">
               <th><?=$sitename;?></th>
               <th class="text-center">Threads</th>
               <th class="text-center">Posts</th>
               <th class="lastPostHeader-0-2-105 text-center">Last Post</th>
            </tr>
         </thead>
         <tbody>

<? $getTopic = $handler->query("SELECT * FROM topics WHERE category = 1 ORDER BY id ASC");
while($gT = $getTopic->fetch(PDO::FETCH_OBJ)){ 
$threads = $handler->query("SELECT * FROM threads WHERE topicId='$gT->id'");
$replies = $handler->query("SELECT * FROM replies WHERE topicId='$gT->id'");
?>
            <tr class="bodyRow-0-2-104">
               <td>
                  <a class="normal" href="ShowForum.aspx?ForumID=<?=$gT->id;?>">
                     <p class="mb-0 fw-bold mt-2"><?=$gT->name;?></p>
                     <p class="mb-2"><?=$gT->description;?></p>
                  </a>
               </td>
               <td class="text-center"><?=$threads->rowCount();?></td>
               <td class="text-center"><?=$threads->rowCount() + $replies->rowCount();?></td>
               <td>
                  <div>
                     <a class="normal" href="#">
                        <p class="fw-bold mb-0 text-center"><?=htmlspecialchars($gT->lastPostTitle);?></p>
                        <p class="mb-0 text-center"><?=$gT->lastPostBy;?></p>
                     </a>
                  </div>
               </td>
            </tr>
<?}?>
         </tbody>
      </table>
      <table class="w-100">
         <thead class="header-0-2-102">
            <tr class="headerRow-0-2-103">
               <th>Club Houses</th>
               <th class="text-center">Threads</th>
               <th class="text-center">Posts</th>
               <th class="lastPostHeader-0-2-105 text-center">Last Post</th>
            </tr>
         </thead>
         <tbody>
            <? $getTopic = $handler->query("SELECT * FROM topics WHERE category = 2 ORDER BY id ASC");
while($gT = $getTopic->fetch(PDO::FETCH_OBJ)){ 
$threads = $handler->query("SELECT * FROM threads WHERE topicId='$gT->id'");
$replies = $handler->query("SELECT * FROM replies WHERE topicId='$gT->id'");
?>
            <tr class="bodyRow-0-2-104">
               <td>
                  <a class="normal" href="ShowForum.aspx?ForumID=<?=$gT->id;?>">
                     <p class="mb-0 fw-bold mt-2"><?=$gT->name;?></p>
                     <p class="mb-2"><?=$gT->description;?></p>
                  </a>
               </td>
               <td class="text-center"><?=$threads->rowCount();?></td>
               <td class="text-center"><?=$threads->rowCount() + $replies->rowCount();?></td>
               <td>
                  <div>
                     <a class="normal" href="#">
                        <p class="fw-bold mb-0 text-center"><?=htmlspecialchars($gT->lastPostTitle);?></p>
                        <p class="mb-0 text-center"><?=$gT->lastPostBy;?></p>
                     </a>
                  </div>
               </td>
            </tr>
<?}?>
         </tbody>
      </table>
   </div>
</div>
<? include "../footer.php"; ?>