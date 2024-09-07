<?php include "src/nav.php"; ?>

<?php if(!isset($_GET['type']))
{
  
    header('Location: / ');
    }
?>

<?php if(isset($_GET['type']))
{
  if(isset($_GET['type'])&& $_GET['type'] == '404'){
    echo'<div class="card mt-3" style="width: 50%; margin: auto;">
<div class="card-body">
<h3 style="text-align:center;">Error 404</h3>
<products style="text-align:center;display:block;">
The page you were looking for could not be found.
</products>
</div>
</div>';
    }
  else
    {
  
    header('Location: / ');
    }
}?>

    
<?php include "src/footer.php"; ?>