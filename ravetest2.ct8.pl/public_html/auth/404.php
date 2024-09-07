<?php include("head.php");

header("HTTP/1.1 404 Not Found");

$directory = "auth/404-images/";

$img = "/".$directory.rand(1,3).".png";

  $quotes[] = 'The requested resource could not be found.';
  $quotes[] = 'Fun Fact: SnowFort is Polish, like our site host.';
  $quotes[] = 'uuuuuuuh for some reason we cant find the page';
  $quotes[] = 'R.I.P. EconomySimulator';
  $quotes[] = 'Oh I\'m a Gummy Bear';
  $quotes[] = 'That\'s an error!';
  $quotes[] = 'I\'d be shocked if you don\'t already know what a 404 error is.';
  $quotes[] = 'CT8 is amazing!';
  $quotes[] = 'Oof!';
  $quotes[] = 'Ouch!';

  srand ((double) microtime() * 1000000);
  $random_number = rand(0,count($quotes)-1);

  $quote = $quotes[$random_number];
?>

<main class="flex-shrink-0" style="width: 50%; margin: auto; padding: 1rem;">
<div class="card card-body shadow-sm">
<div class="text-center px-3 py-3">
<img src="<?=$img;?>" width="70%">
<hr>
<h3>404</h3>
<span><?=$quote;?></span>
<div class="d-flex justify-content-center mt-3">
<button class="btn btn-secondary shadow-sm" role="button" onclick="window.history.back()" style="margin-right: 0.4rem;">Back</button>
<a href="/auth/home" class="btn btn-primary" role="button">Home</a>
</div>
</div>
</div>
</main>

<?php include("footer.php");?>