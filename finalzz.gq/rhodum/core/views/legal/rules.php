<?php
    error_reporting(0);
  include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/includes.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo config::getName();?> | Rules</title>
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
    <h3 style="text-align:center;">Rules</h3>

 
      
      
      
      
<footer class="container center" style="/*box-shadow:0 1px 50px 0 rgba(34,36,38,.15);*/border: 1px solid rgba(0,0,0,.125);width:80%;margin:auto;background: #fff;">  <h5 style="color:grey;font-size:22px;margin-bottom:0px"></h5>
<p><?php echo config::getName();?> has a few rules that must be followed by everyone to keep the site from turning into another Rhodum.</p>
 <ul style="text-align:left;">
      <li>No uploading copyrighted content.</li>
      <li>No immaturity. Seems like a stupid rule but we actually <b>do</b> ban for this. This is subjective, of course, so it's up to the mod/admin.</li>
      <li>No drama. Or at least keep it to a minimum.</li>
      <li>No exploiting, hacking, or any other skiddy term you want to use to describe the act of exploiting. Yes, this includes IP trackers on the forum.</li>
      <li>No bullying.</li>
      <li>Use common sense.</li>
      <li>Go read our <a href="/Legal/terms">Terms of Service</a> and <a href="/Legal/privacy">Privacy Policy. It's in plain English, we swear.</a>
    </li></ul>
    <p>Note that just because something isn't listed here doesn't mean that it's not against the rules.</p>
      
</footer>
      
      
      
      
      
      
      
      </div>

    
    
    
    
    

    
    
    
    
    
    
    
    
    
    <?php html::buildFooter();?>
  </body>
</html>