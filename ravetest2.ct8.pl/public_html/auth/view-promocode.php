<? include("head.php");

if($_GET['id']){

$id = htmlspecialchars($_GET['id']);

if($myu->admin == "true"){

$promocode = $handler->query("SELECT * FROM promocodes WHERE id='".$id."'");

if($promocode->rowCount() == "0"){

header("Location: /internal/redeem");

}

$pC = $promocode->fetch(PDO::FETCH_OBJ);

if ($myu->admin=="true"){ 

if (isset($_POST['delete'])){

$handler->query("DELETE FROM `promocodes` WHERE `id` = '".$id."'"); 

header("Location: /internal/redeem");

}

}

$awards = "an unknown amount of Robux and Tix. Please report this bug.";

if($pC->robuxaward == 0){

if($pC->tixaward == 0){

$awards = "no Robux or Tix. You may want to delete this.";

}

}

if($pC->robuxaward > 0){

if($pC->tixaward == 0){

$awards = $pC->robuxaward." Robux";

}

}

if($pC->robuxaward == 0){

if($pC->tixaward > 0){

$awards = $pC->tixaward." Tix";

}

}

if($pC->robuxaward > 0){

if($pC->tixaward > 0){

$awards = $pC->robuxaward." Robux and ".$pC->tixaward." Tix";

}

}

?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
            <div class="card card-body">
                <h2>Viewing Promocode</h2>
                <form method="post">
                    <p class="mb-0"><?=$pC->code;?></p>
                    <p class="mt-1">Awards <?=$awards;?></p>
                    <input class="btn btn-outline-danger w-100" type="submit" value="Delete" id="login-submit" name="delete">
                </form>
            </div>
        </div>
    </div>
</div>

<? }else{ header("Location: /internal/redeem"); }}else{ header("Location: /internal/redeem"); } ?>

<? include("footer.php"); ?>