<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/config.php'); session_start(); ?>
<!doctype html>
<html>
    <head>
    <link rel="stylesheet" href="includes/materialize.css" media="screen,projection"/>
    <link rel="stylesheet" href="includes/styles.css?v=2.5.61">
    <link rel="stylesheet" href="includes/light.css?v=2.5.61">
    <link rel="stylesheet" href="includes/1.css?v=2.5.61">
    </head>
<body>
<header>
       
                
        <div class="navbar-fixed">
          <nav class="navigation">
            <div class="nav-wrapper container">
              <a href="/" class="brand-logo" style="position: unset!important;"><?php echo $name;?></a> <a class="flow-text" href="game.php?id=49" style="margin-left:2rem;">Play</a> <a class="flow-text" href="levels" style="margin-left:2rem;">Levels</a>
              <a href="#" data-activates="mobile-navigation" class="button-collapse"><i class="material-icons">menu</i></a>
              <ul class="right hide-on-med-and-down">
                <!--<li><a class="flow-text" href="game.php?id=49">Play</a></li>
                <li><a class="flow-text" href="levels">Levels</a></li>-->
                
                <?php if(isset($_SESSION["loggedin"])){
    echo '<li><a class="flow-text" style="margin-top:5%;margin-bottom:auto;">';echo $_SESSION["username"];'</a></li>';
} else {
    echo '<li><a class="waves-effect waves-light btn white-text" href="login?url=/" style="margin-top:auto;margin-bottom:auto;">Login</a></li>
                <li><a class="btn waves-effect waves-light green lighten-2 white-text" href="signup" style="margin-top:auto;margin-bottom:auto;">Sign Up</a></li>';
}?>
                
              </ul><!-- End right navbar links -->
              <ul class="side-nav" id="mobile-navigation">
                <li><a href="index">Home</a></li>
                <li><a href="game.php?id=49">Play</a></li>
                <li><a href="levels">Levels</a></li>
                <li class="divider"></li>
                <li><a href="login">Login</a></li>
                <li><a href="signup">Sign Up</a></li>
              </ul><!-- End mobile navbar links -->
            </div><!-- End nav-wrapper -->
          </nav><!-- End navbar -->
        </div><!-- End navbar-fixed container -->
      </header><!-- End header -->       
<div class="container" style="margin-top: 1rem!important;">