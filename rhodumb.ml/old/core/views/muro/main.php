<?php
    error_reporting(0);
  include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/includes.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo config::getName();?> | Il muro</title>
        <?php html::buildHead();?>
        <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />
    </head>
  <body>
        <style>
        /* Solid border */
        hr.solid {
          border-top: 3px solid #bbb;
        }
        </style>
    <?php html::getNavigation();?>
    <div class="container">
    <h1 style="text-align: center;">Il Muro</h1>
        <h3 style="text-align: center;">Il posto dove puoi trovare informazione su Epiculy, il coglione di merda</h3>
        </div>
        <hr class="solid">
        <div class="col-xs-12 col-sm-4 col-md-6 col-sm-offset-2 col-md-offset-3col-xs-12 col-sm-4 col-md-6 col-sm-offset-2 col-md-offset-3">
            <h2>Epiculy is a pedo.</h2>
            <img src="/html/img/muro/pedo.jpg">
            <h2>Epiculy's revivals are RATs.</h2>
            <img src="/html/img/muro/rat.png">
            <h2>Epiculy can't code.</h2>
            <img src="/html/img/muro/code.png">
        </div>
    </div>
    <?php html::buildFooter();?>
  </body>
</html>