<style>
   .navbar-nav.navbar-center {
    position: absolute;
    left: 50%;
    transform: translatex(-50%);
    
}
  .navbar {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding-top: 1rem;
    padding-bottom: 1rem;
    border: none;
    box-shadow: inset 1px 1px rgb(255 255 255 / 20%), inset -1px -1px rgb(255 255 255 / 10%), 1px 3px 24px -1px rgb(0 0 0 / 15%);
    background-color: transparent;
    background-image: linear-gradient(125deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.2) 70%);
    -webkit-backdrop-filter: blur(5px);
    backdrop-filter: blur(5px);
}





</style><?php include($_SERVER['DOCUMENT_ROOT'].'/src/config.php'); if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocol = 'https://';
}
else {
  $protocol = 'http://';
} ?>
<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="/src/bootstrap.min.css">
<meta name="title" content="<?php echo $name;?>">
<meta name="description" content="<?php echo $description;?>">
<meta name="keywords" content="<?php echo strtolower($name)?>, baguettebling, mischief, comitant, nexo, nexodev, wafkee, sans, social, avatar, network, script, sandbox, old, roblox, revival, clone, offtopic, shopium, blexnetwork, noynac, patched, brick, planet, hill, gravitar, carly, jaredyoshi, brickplanet, bricked, thegamerland, TGL, thinkblocks, bloxcreate, bloxcity, avatarsquare, brickhill, retrohill, 1.0, social-avatar, social-paradise, brick-planet, games, game, jgg, justgoodgame, gtoria, graphictoria">
<meta name="robots" content="index, follow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="language" content="English">
<meta name="revisit-after" content="1 day">
<meta name="author" content="<?php echo $name;?>">
<meta property="og:image" content="/src/img/icon.png" />
<meta name="twitter:title" content="<?php echo $name;?>">
<meta name="twitter:description" content="<?php echo $description;?>">
<meta name="twitter:image" content="<?php echo $protocol;?><?php echo $_SERVER['HTTP_HOST'];?>/src/img/icon.png">
<meta name="twitter:card" content="summary_large_image">
    </head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary text-center" style="padding:5px !important;padding-bottom: 20px !important;">
  <div class="container" style="display:block;">
    <a class="navbar-brand navbar-center" href="/" style="padding:0px !important;"><img src="/src/img/icon.png" height="50px" style="padding-bottom: 5px !important;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="nav navbar-nav navbar-center" style="margin-top:7px;">
        <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/products">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/forum">Forum</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contact">Contact</a>
        </li>
      </ul>
    </div>
    </div>
</nav>
<div class="container" style="margin-top: 1rem!important;">