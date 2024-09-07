<?php
    error_reporting(0);
  include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/includes.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo config::getName();?> | Privacy</title>
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
    <h3 style="text-align:center;">Privacy Policy</h3>

 
      
      
      
      
<footer class="container center" style="/*box-shadow:0 1px 50px 0 rgba(34,36,38,.15);*/border: 1px solid rgba(0,0,0,.125);width:80%;margin:auto;background: #fff;">  <h5 style="color:grey;font-size:22px;margin-bottom:0px"></h5>
<p>Yes, we have a privacy policy.</p>
<ul style="text-align:left;">
      <li><b>We store your IP address and e-mail address.</b> These are only used for banning and support. We won't give it away.</li>
      <li><b>Your password is hashed. No, we don't give it away.</b> DES is cool.</li>  
      <li><b>We use cookies.</b> If you disable them, the site will break in half. So don't. <small>I mean, you can, but the site won't work.</small></li>
      <li>Our server location varies, if that matters at all. It could be hosted in Europe one day, and a random country like Romania the next day. We aren't a (registered) corporation. This is considered a side-project of the creator.</li>
      <li>In the event of a data breach, we'll have a notice up. We also might send out an e-mail if we have the funds for that (because bulk e-mails are expensive).</li>
      <li>In the event we <i>do</i> show something that contains your e-mail or IP address in public, it will be fully or partially blurred.</li>
      <li>We don't sell your info to third-parties.</li>
      <li>Many actions on the <?php echo config::getName();?> website are logged, such as selling an item. This is so we can restore the database in the event of a breach.</li>
      <li>We use Cloudflare! That means everything you do goes through them.</li>
    </ul>
    <p>This page (and its contents) may change without any notice, at any time.</p>
      
</footer>
      
      
      
      
      
      
      
      </div>

    
    
    
    
    

    
    
    
    
    
    
    
    
    
    <?php html::buildFooter();?>
  </body>
</html>