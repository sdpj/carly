<? include("../head.php"); $search = mysql_real_escape_string(htmlspecialchars($_POST['search'])); ?>

<div class="card text-center mt-3" style="width: 85%; margin: auto;">
  <div class="card-header">

<ul class="nav nav-tabs card-header-tabs">
    <li class="nav-item">
        <a href="#stats" class="nav-link <? if($search){}else{echo("active");}?>" data-bs-toggle="tab">Statistics</a>
    </li>
    <li class="nav-item">
        <a href="#games" class="nav-link" data-bs-toggle="tab">Games</a>
    </li>
    <li class="nav-item">
        <a href="#chats" class="nav-link <? if(!$search){}else{echo("active");}?>" data-bs-toggle="tab">Chats</a>
    </li>
</ul>

</div>

<div class="card-body">

<? $allChats = $handler->query("SELECT * FROM `ingamechats`"); ?>

<div class="tab-content">
    <div class="tab-pane <? if($search){}else{echo("show active");}?>" id="stats">
        <p>There are N/A games on <?=$sitename;?>.</p>
        <p><?=$allChats->rowCount();?> ingame chat messages have been stored.</p>
        <p>N/A total kills have been had throughout all games.</p>
    </div>
    <div class="tab-pane" id="games">
                <form>
  <div class="form-group">

<div class="input-group">
  <input type="text" class="form-control" placeholder="Search games">
  <span class="input-group-btn">
    <button class="btn btn-success" type="submit">
        Submit
    </button>
  </span>
</div>

    <small id="emailHelp" class="form-text text-muted">No results found. (This tab does nothing currently.)</small>
  </div>
</form>
    </div>
    <div class="tab-pane <? if(!$search){}else{echo("show active");}?>" id="chats">
        <form action="#chats" method="POST">
  <div class="form-group">

<div class="input-group">
  <input type="text" class="form-control" placeholder="Search chats" name="search">
  <span class="input-group-btn">
    <button class="btn btn-success" type="submit">
        Submit
    </button>
  </span>
</div>

    <small id="emailHelp" class="form-text text-muted hideifresults">No results found.</small>



<? $getGroup = $handler->query("SELECT * FROM `ingamechats` WHERE message LIKE '%".$search."%' ORDER by id DESC"); ?>

<? 
while($gG = $getGroup->fetch(PDO::FETCH_OBJ)){ 
?>

<? $adminn = $handler->query("SELECT * FROM users WHERE id='$gG->userid'"); 
$admin = $adminn->fetch(PDO::FETCH_OBJ); ?>

<style>.hideifresults{display:none!important;}</style>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12 col-md-6 offset-md-3">
            <div class="card card-body">
                <h3><?=htmlspecialchars($admin->username);?></h3>
                <p class="mb-0"><?=htmlspecialchars($gG->message);?></p>
                <p class="text-muted"><?=date("M j Y | G:i:s a", $gG->time);?></p>
                <p class="mb-0"><? if($myu->admin == "true"){?><a href="#" class="btn btn-outline-danger">Ban User</a><?}?></p>
            </div>
        </div>
    </div>
</div>



<? } ?>



  </div>
</form>
    </div>
</div>

</div>

</div>

<? include("../footer.php"); ?>