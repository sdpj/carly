<?php
    error_reporting(0);
  include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/includes.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo config::getName();?> | Terms</title>
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
    <h3 style="text-align:center;">Terms of Service</h3>

 
      
      
      
      
<footer class="container center" style="/*box-shadow:0 1px 50px 0 rgba(34,36,38,.15);*/border: 1px solid rgba(0,0,0,.125);width:80%;margin:auto;background: #fff;">  <h5 style="color:grey;font-size:22px;margin-bottom:0px"></h5>
    <p>By using the <?php echo config::getName();?> website, you agree to the following terms:</p>
    <ul style="text-align:left !important;">
      <li>You must be 13 years of age or older to use or register for <?php echo config::getName();?>.</li>
      <li><?php echo config::getName();?> is not responsible for any user actions. A lot of content on the <?php echo config::getName();?> website is user-generated.</li>
      <li>You must not excessively scrape the <?php echo config::getName();?> website.</li>
      <li>You must not spam the website with invalid requests.</li>
      <li>You must not create a new account in the event you receive a moderation action (which includes, but is not exclusive to a warning or ban).</li>
      <li>You must not link to or engage in the transmission of unlawful content to the <?php echo config::getName();?> website.</li>
      <li>If your account gets compromised, you will not receive any compensation.</li>
      <li>If the <?php echo config::getName();?> team receives payment for any goods or services (or any other monetary transaction), it is final.</li>
      <li>We kinda own the stuff on the site, unless if it belongs to another person/corporation/object.</li>
      <li>These terms may change at any time, with or without notice.</li>
    </ul>
</footer>
      
      
      
      
      
      
      
      </div>

    
    
    
    
    

    
    
    
    
    
    
    
    
    
    <?php html::buildFooter();?>
  </body>
</html>