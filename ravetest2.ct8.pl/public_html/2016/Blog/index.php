<? $bannedcanview = "true"; include "../header.php"; 
$getGroup = $handler->query("SELECT * FROM `blog` ORDER by id DESC");
?>

<div class="col s12 m9 l8">
<div class="container" style="width:100%;">
<h1 class="pageTitle-0-2-247" style="margin-left:1.2rem;">Blog <? if ($myu->admin == "true"){ ?><a href="/Blog/create.php">(Create Post)</a><?}?></h1>

<? while($gG = $getGroup->fetch(PDO::FETCH_OBJ)){ 
$getusers = $handler->query("SELECT * FROM groupmembers WHERE groupid='$gG->id'"); 
$all = ($getusers->rowCount()); ?>
<style>.groupthing {
    background: white;
    box-shadow: 0 1px 4px 0 rgb(25 25 25 / 30%);
    border-radius: 0;
}</style>
<? $adminn = $handler->query("SELECT * FROM users WHERE id='$gG->author'"); 
$admin = $adminn->fetch(PDO::FETCH_OBJ); ?>
<div class="col s12 m9 l8">
<div class="container" style="width:100%;">
<div class="content-box" style="padding:0;border-radius:0;border-top:0;">
<div class="row valign-wrapper groupthing" style="border:1px solid #e8e8e8;padding:15px 0;margin-bottom:0;margin-left:0;margin-right:0;">
<div class="col s2 valign center-align">
<a href="/Blog/ShowPost.php?id=<?echo "$gG->id"; ?>"><iframe frameborder="0" src="/avatar.php?id=<? echo $admin->id ?>" scrolling="no" style=" width: 200px; height: 200px"></iframe></a>
</div>
<div class="col s8 valign">
<a href="/Blog/ShowPost.php?id=<?echo "$gG->id"; ?>"><div style="font-size:22px;color:#666666;display:inline-block;"><? echo " $gG->title"; ?></div></a>
<div style="font-size:14px;color:#888888;"><?=mb_strimwidth(htmlspecialchars($gG->content), 0, 159, "...");?></div>
</div>
<div class="col s2 valign center-align">
<div style="font-size:18px;"><? echo " $admin->username"; ?></div>
<div style="font-size:14px;color:#777777;">AUTHOR</div>
<br>
<div style="font-size:18px;">1/1/2000</div>
<div style="font-size:14px;color:#777777;">DATE</div>
</div>
</div>
</div>
</div>
</div>
</br>
<? } ?>
</div></div></div></div></div></div></div></div></div></div></div></div></div>
<? include "../footer.php"; ?>