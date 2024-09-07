<? $bannedcanview = "true"; include("head.php"); 

$id = $_GET['id'];

if($_GET['id']){
$thread = $handler->query("SELECT * FROM blog WHERE id=" . $id);
$gT = $thread->fetch(PDO::FETCH_OBJ);
$topicsql = $handler->query("SELECT * FROM blog WHERE id=" . $gT->id);
$topic = $topicsql->fetch(PDO::FETCH_OBJ);

$alltopicssql = $handler->query("SELECT * FROM blog");

$mytopicssql = $handler->query("SELECT * FROM blog WHERE author = ". $gT->author);

$adminn = $handler->query("SELECT * FROM users WHERE id='$gT->author'");

$admin = $adminn->fetch(PDO::FETCH_OBJ);

?>
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12 col-md-6 offset-md-3">
            <div class="card card-body">
                <h3><?=htmlspecialchars($gT->title);?></h3>
                <p><?=nl2br(htmlspecialchars($gT->content));?></p>
                <p>- <?=$admin->username;?></p>
                <p class="mb-0"><a href="/internal/blog" class="btn btn-outline-primary">Back</a><? if($myu->admin == "true"){?><a href="/auth/delete-blog-post?id=<?=$id;?>" class="btn btn-outline-danger" style="margin-left: .5rem;">Delete</a><?}?></p>
            </div>
        </div>
    </div>
</div>
<? }else{ ?>
<? $getGroup = $handler->query("SELECT * FROM `blog` ORDER by id DESC"); ?>

<? if($myu->admin == "true"){?><div class="container mt-4"> <div class="row mb-4"> <div class="col-12 col-md-6 offset-md-3"><a href="/auth/create-blog-post" class="btn btn-outline-primary">Create Post</a></div></div</div><?}?>

<? 
while($gG = $getGroup->fetch(PDO::FETCH_OBJ)){ 
$getusers = $handler->query("SELECT * FROM groupmembers WHERE groupid='$gG->id'"); 
?>

<? $adminn = $handler->query("SELECT * FROM users WHERE id='$gG->author'"); 
$admin = $adminn->fetch(PDO::FETCH_OBJ); ?>


<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12 col-md-6 offset-md-3">
            <div class="card card-body">
                <h3><?=htmlspecialchars($gG->title);?></h3>
                <p><?=mb_strimwidth(htmlspecialchars($gG->content), 0, 159, "...");?></p>
                <p>- <?=$admin->username;?></p>
                <p class="mb-0"><a href="/internal/blog/<?=$gG->id;?>" class="btn btn-outline-primary">Read Post</a><? if($myu->admin == "true"){?><a href="/auth/delete-blog-post?id=<?=$gG->id;?>" class="btn btn-outline-danger" style="margin-left: .5rem;">Delete</a><?}?></p>
            </div>
        </div>
    </div>
</div>



<? } } ?>
<? include("footer.php"); ?>