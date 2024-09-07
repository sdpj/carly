<? include("head.php");

if(!$user){

header("Location: /auth/home");

}

function makePromoCode() { // promo code generator, i believe it will be truly random, echo makePromoCode() to call it
return strrev(implode("-", str_split(strtoupper(str_shuffle(uniqid(substr(sha1(md5(time())), 0, 2)))), 3)));
}
// makePromoCode();
?>


<div class="container mt-4">

<?

if(isset($_POST['code'])){

$promocode = $handler->query("SELECT * FROM promocodes WHERE code='".$_POST['code']."' AND claimed='0'");

if($promocode->rowCount() == "0"){

?>

        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning">
                    <p class="mb-0">Invalid Code</p>
                </div>
            </div>
        </div>

<? } } ?>

<?

if(isset($_POST['code'])){

if($promocode->rowCount() != "0"){


$pC = $promocode->fetch(PDO::FETCH_OBJ);


$awards = "an unknown amount of Robux and Tix. Please report this to an admin.";

if($pC->robuxaward == 0){

if($pC->tixaward == 0){

$awards = "no Robux or Tix. Please report this to an admin.";

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

        <div class="row">
            <div class="col-12">
                <div class="alert alert-success">
                    <p class="mb-0">Code redeemed! You have earned <?=$awards;?>.</p>
                </div>
            </div>
        </div>

<?

$newtix = $myu->emeralds + $pC->tixaward;

$newrobux = $myu->robux + $pC->robuxaward;

$handler->query("UPDATE promocodes SET claimed = '1', claimer = '".$myu->id."' WHERE id = '".$pC->id."'");

$handler->query("UPDATE users SET emeralds = '".$newtix."' WHERE `id` = '".$myu->id."'"); 

$handler->query("UPDATE users SET robux = '".$newrobux."' WHERE `id` = '".$myu->id."'"); 

?>

<? } } ?>

    <div class="row">
<? if(!isset($_GET['add'])){?>
        <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
         <? if($myu->admin == "true"){?><a href="?add" class="btn btn-outline-primary w-100 mb-3">Add New Promocode</a><? } ?>
            <div class="card card-body">
                <h2>Redeem Promocode</h2>
                <form method="post">
                    <input type="text" placeholder="XXX-XXX-XXX-XXX-XXX" name="code" class="form-control mb-1">
                    <input class="btn btn-outline-primary w-100" type="submit" value="Redeem" id="login-submit" name="save">
                </form>
            </div>
        </div>
    </div>
<?}else{?>
<? if($myu->admin == "true"){?>
<?
if(isset($_POST['addsubmit'])){ $thiscode = makePromoCode();
$hi = $handler->query("INSERT INTO promocodes (robuxaward, tixaward, code) VALUES ('".mysql_real_escape_string($_POST["robux"])."','".mysql_real_escape_string($_POST["tix"])."','".$thiscode."')");
Header("Location: /auth/view-promocode?id=".$handler->lastInsertId()); exit; die();
}
?>
        <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
            <div class="card card-body">
                <h2>Add Promocode</h2>
                <form method="post">
                    <input type="text" placeholder="Robux Amount" name="robux" class="form-control mb-1">
                    <input type="text" placeholder="Tix Amount" name="tix" class="form-control mb-1">
                    <input class="btn btn-outline-primary w-100" type="submit" value="Add" id="login-submit" name="addsubmit">
                </form>
            </div>
        </div>
    </div>
<?}else{header("Location: /internal/redeem");}?>
<?}?>
</div>


<? include("footer.php"); ?>