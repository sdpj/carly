<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
   <head>
    <?php include_once "2014head.php"; ?>
    <?php
    require_once "DiscordEmbed.php";
    $discordembed = new DiscordEmbed();
    if(isset($_GET['lang'])) {
        if($_GET['lang'] == 'ru') {
            //$discordembed->NormalEmbed("Зайти", "https://squared.cf/Default.aspx");
            echo '<title>Зайти - Cubed</title>
    <meta property="og:site_name" content="Cubed">
    <meta property="og:title" content="Зайти - Cubed">
    <meta property="og:type" content="profile">
    <meta property="og:url" content="">
    <meta property="og:description" content="Cubed, это вебсайт. Он за старого кирпичного строителя. Хороший для использования.">
    <meta property="og:image" content="https://cdn.upload.systems/uploads/pDPrTMVK.png">';
        } else {
            $discordembed->NormalEmbed("Home", "https://squared.cf/Default.aspx");
        }
    } else {
        $discordembed->NormalEmbed("Home", "https://squared.cf/Default.aspx");
    } ?>
   </head>
   <body class="">
      
         <?php include_once "updateinfo.php"; ?>
         <?php if(isset($_SESSION['id'])){ header('Location: Default.aspx'); } ?>
         <?php
                   if(isset($_GET['lang'])) {
        if($_GET['lang'] == 'ru') {
            include_once "2014navbar_ru.php";
        } else {
            include_once "2014navbar.php";
        }
    } else {
        include_once "2014navbar.php";
    }
                   ?>
         
         
               <style>* {



margin:0;

padding:0;



}</style>
                 <div class="home-main-content" style="position:relative;top:-5px;right:0;height:300px;width:100% !important;background:url('http://web.archive.org/web/20220116211513im_/https://squared.rocks/img/xmas_small.jpg') center center;background-size: cover;">
                   <div class="container d-flex justify-content-center">
                     <h1 class="mb-4 home-text" style="color:#fff;margin-left: 0px!important;">We do what Cubed does</h1> 
                     <p class="home-text" style="color:#fff;">Cubed puts games on your not-phone.</p> 
                     <p><a href="/register.aspx" class="btn btn-primary btn-lg mt-3 mr-2" style="background-image:none !important;background-color: #3182ce !important; border-color: #3182ce !important;">Get started ›</a></p>
                   </div></div>
                   </div>
<div class="container mt-4"><div class="row"><div class="col-lg-6 mb-2"><a href="#" class="catalog-card"><div class="card"><div class="card-body"><h3 style="color: #ececec !important;display:inline-block;white-space:nowrap;"><img src="https://pnggrid.com/wp-content/uploads/2021/05/Discord-Logo-Circle-1024x1024.png" class="img-inline align-middle mr-1" style="max-width: 30px; max-height: 30px;">&nbsp;Discord</h3> <p class="text-muted mb-0" style="margin-bottom: 1.25rem !important;">Join our Discord server and talk to people in our community!</p></div></div></a></div> <div class="col-lg-6 mb-2"><a href="#" class="catalog-card"><div class="card"><div class="card-body"><h3 style="color: #ececec !important;white-space:nowrap;"><img src="https://www.letterjoin.co.uk/images/twitter-logo-p-1600.png" class="img-inline align-middle mr-1" style="max-width: 30px; max-height: 30px;"> Twitter</h3> <p class="text-muted mb-0">We tweet whenever we post a video, and may even hint at some upcoming events on our Twitter.</p></div></div></a></div></div></div>
     
         <?php include "2014footer.php" ?>
      </div>
   </body>
</html>