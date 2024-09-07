<? include("head.php");

if($myu->admin != "true"){
    header("Location: /internal/blog");
}
?>

<?
if(isset($_POST['save'])){
$hi = $handler->query("INSERT INTO blog (author, title, content) VALUES ('$myu->id','".mysql_real_escape_string($_POST["title"])."','".mysql_real_escape_string($_POST["post"])."')");
Header("Location: /internal/blog/".$handler->lastInsertId()); exit; die();
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
            <div class="card card-body">
                <h2>Create Blog Post</h2>
                <form method="post">
                    <input type="text" placeholder="Title" name="title" class="form-control mb-1">
                    <textarea class="form-control mb-1" rows="3" name="post" placeholder="Content"></textarea>
                    <input class="btn btn-outline-primary" type="submit" value="Submit" id="login-submit" name="save">
                </form>
            </div>
        </div>
    </div>
</div>

<? include("footer.php"); ?>