<? include("head.php"); 

function makeTicket() { 

return str_shuffle(time());

}

if($_POST['regen']) {

$handler->query("UPDATE users SET authticket = '".makeTicket()."' WHERE `id` = '".$myu->id."'"); 

header("Location: /auth/ticket");

}

?>

<div class="container mt-4">

<div class="row">
        <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
            <div class="card card-body">
                <h2>AuthTicket</h2>
                <form method="post">
                    <p><?if($myu->authticket != ""){?><?=htmlspecialchars($myu->authticket);?><?}else{echo"No AuthTicket. Please regenerate below.";}?></p>
                    <input class="btn btn-outline-success w-100" type="submit" value="Regenerate" id="login-submit" name="regen">
                </form>
            </div>
        </div>
    </div>
</div>

<? include("footer.php"); ?>