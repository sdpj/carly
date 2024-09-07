<?php include('Site/init.php'); // error_reporting(0); ?>

<? if (!$user) { header("Location: /auth/home"); } ?>

<html>
   <head>
      <meta charset="utf-8">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
      <title><?=$sitename;?></title>
      <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="next-head-count" content="6">
      <link rel="preload" href="/Style/thisthing.css" as="style">
      <link rel="stylesheet" href="/Style/2016.css" data-n-g="">
      <noscript data-n-css=""></noscript>
      <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&amp;display=swap" rel="stylesheet">
      <style id="server-side-styles">.imgDesktop-0-2-7 {
         width: 118px;
         height: 30px;
         display: none;
         background-size: 118px 30px;
         background-image: url(/auth/logo.png);
         }
         @media(min-width: 1301px) {
         .imgDesktop-0-2-7 {
         display: block;
         }
         }
         .imgMobile-0-2-8 {
         width: 30px;
         height: 30px;
         display: block;
         background-size: 30px;
         background-image: url(/img/logo_R.svg);
         }
         @media(min-width: 1301px) {
         .imgMobile-0-2-8 {
         display: none;
         }
         }
         .imgMobileWrapper-0-2-9 {
         margin-left: 40px;
         }
         .col-0-2-10 {
         max-width: 140px;
         }
         .openSideNavMobile-0-2-11 {
         display: none;
         }
         @media(max-width: 1300px) {
         .openSideNavMobile-0-2-11 {
         float: left;
         width: 30px;
         cursor: pointer;
         height: 30px;
         display: block;
         }
         }
         .container-0-2-12 {
         margin-top: 3px;
         padding-left: 0;
         margin-bottom: 0;
         padding-bottom: 0;
         }
         .linkEntry-0-2-13 {
         color: white;
         padding: 4px 8px;
         font-size: 16px;
         text-align: center;
         transition: none;
         font-weight: 400;
         margin-bottom: 0;
         padding-bottom: 0;
         text-decoration: none;
         }
         .linkEntry-0-2-13:hover {
         color: white;
         cursor: pointer;
         background: rgba(25,25,25,0.1);
         transition: none;
         border-radius: 4px;
         }
         .navItem-0-2-14 {
         padding-right: 2rem;
         }
         @media(max-width: 1300px) {
         .navItem-0-2-14 {
         padding-right: 1.75rem;
         }
         }
         @media(max-width: 1250px) {
         .navItem-0-2-14 {
         padding-right: 1.5rem;
         }
         }
         @media(max-width: 1175px) {
         .navItem-0-2-14 {
         padding-right: 1rem;
         }
         }
         .col-0-2-15 {
         margin-left: 0;
         padding-left: 0;
         }
         .icon-0-2-18 {
         float: right;
         margin-top: -24px;
         padding-top: 0;
         }
         .wrapper-0-2-16 {
         width: 100%;
         border: 1px solid #c3c3c3;
         padding: 4px 2px;
         background: white;
         border-radius: 2px;
         }
         .searchInput-0-2-17 {
         width: 100%;
         border: none;
         padding-top: 0;
         padding-bottom: 0;
         }
         .searchInput-0-2-17:focus {
         border: none!important;
         box-shadow: none!important;
         }
         .navbar-0-2-1 {
         padding-top: 6px;
         padding-bottom: 3px;
         }
         .navContainer-0-2-2 {
         max-width: 100%!important;
         padding-top: 0;
         padding-bottom: 0;
         }
         .leftContainer-0-2-3 {  }
         .row-0-2-4 {
         width: 100%;
         }
         .wrapper-0-2-5 {
         overflow: auto;
         max-width: 100vw;
         margin-bottom: 40px;
         }
         @media(max-width: 991px) {
         .wrapper-0-2-5 {
         margin-bottom: 98px;
         }
         }
         .navbar-d0-0-2-6 {
         background-color: #0074BD;
         }
         .text-0-2-24 {
         color: #B8B8B8;
         font-size: 12px;
         font-weight: 400;
         }
         .link-0-2-25 {
         font-size: 21px;
         text-align: center;
         font-weight: 300;
         text-decoration: none;
         }
         .link-0-2-25:hover {
         color: #191919;
         }
         .footer-0-2-26 {
         background: #ffffff;
         }
         .footerContainer-0-2-27 {
         padding-top: 5px;
         padding-bottom: 20px;
         }
         .main-0-2-23 {
         min-height: 95vh;
         }
         .alertBg-0-2-19 {
         background: #F68802;
         }
         .alertText-0-2-20 {
         color: #fff;
         padding: 12px 0;
         font-size: 18px;
         text-align: center;
         font-weight: bold;
         }
         .alertLink-0-2-21 {
         color: #fff;
         }
         .alertLink-0-2-21:hover {
         text-decoration: underline;
         }
         .fakeAlert-0-2-22 {
         width: 100%;
         height: 40px;
         position: relative;
         }
      </style>
      <style data-jss="" data-meta="Unthemed">
         .linkEntry-0-2-33 {
         padding-top: 5px;
         margin-bottom: 0;
         }
         .name-0-2-34 {
         font-size: 16px;
         vertical-align: middle;
         }
         .wrapper-0-2-35:hover {
         cursor: pointer;
         }
         .link-0-2-36 {
         color: inherit;
         }
         .countWrapper-0-2-37 {
         float: right;
         padding-top: 5px;
         }
         .count-0-2-38 {
         color: white;
         padding: 2px 7px;
         background: #01a2fd;
         border-radius: 10px;
         }
      </style>
      <style data-jss="" data-meta="Unthemed">
         .container-0-2-28 {
         top: 0;
         left: 0;
         z-index: 999;
         position: fixed;
         }
         .card-0-2-29 {
         width: 175px;
         height: 100vh;
         background: #f2f2f2;
         padding-left: 10px;
         padding-right: 10px;
         }
         .username-0-2-30 {
         color: #1e1e1f;
         font-size: 18px;
         padding-top: 8px;
         margin-bottom: 0;
         padding-bottom: 5px;
         }
         .divider-0-2-31 {
         width: 100%;
         height: 2px;
         border-bottom: 2px solid #c3c3c3;
         }
         .upgradeNowButton-0-2-32 {
         color: white;
         width: 100%;
         font-size: 15px;
         background: #01a2fd;
         margin-top: 10px;
         text-align: center;
         font-weight: 500;
         padding-top: 8px;
         border-radius: 4px;
         padding-bottom: 8px;
         }
         .upgradeNowButton-0-2-32:hover {
         background: #3ab8ff;
         }
      </style>
      <style data-jss="" data-meta="Unthemed">
         .text-0-2-39 {
         color: white;
         display: inline;
         font-size: 16px;
         margin-top: 2px;
         text-align: right;
         font-weight: 400;
         white-space: nowrap;
         border-bottom: 0;
         margin-bottom: 0;
         }
         .link-0-2-40 {
         color: white;
         padding: 4px 8px;
         text-decoration: none;
         }
         .link-0-2-40:hover {
         color: white;
         cursor: pointer;
         background: rgba(25,25,25,0.1);
         border-radius: 4px;
         }
         .settingsIcon-0-2-41 {
         float: right;
         }
         .linkContainerCol-0-2-43 {
         float: right;
         max-width: 250px;
         }
         .robuxText-0-2-44 {
         margin-left: 5px;
         margin-right: 20px;
         }
      </style>
      <style data-jss="" data-meta="Unthemed">
         .imgDesktop-0-2-7 {
    width: 103px;
    height: 28px !important;
    display: block;
    background-size: 104px 31px!important;
    background-image: url(/auth/logo.png);
    background-position-y: 60px;
    position: relative;
    right: 3px;
    bottom: 0px;
    background-repeat-x: no-repeat;
}
         @media(min-width: 1301px) {
         .imgDesktop-0-2-7 {
         display: block;
         }
         }
         .imgMobile-0-2-8 {
         width: 30px;
         height: 30px;
         display: block;
         background-size: 30px;
         background-image: url(/img/logo_R.svg);
         }
         @media(min-width: 1301px) {
         .imgMobile-0-2-8 {
         display: none;
         }
         }
         .imgMobileWrapper-0-2-9 {
         margin-left: 40px;
         }
         .col-0-2-10 {
         max-width: 140px;
         }
         .openSideNavMobile-0-2-11 {
         display: block;
         }
         @media(max-width: 1300px) {
         .openSideNavMobile-0-2-11 {
         float: left;
         width: 30px;
         cursor: pointer;
         height: 30px;
         display: block;
         }
         }
      </style>
      <style data-jss="" data-meta="Unthemed">
         .container-0-2-12 {
         margin-top: 3px;
         padding-left: 0;
         margin-bottom: 0;
         padding-bottom: 0;
         }
         .linkEntry-0-2-13 {
         color: white;
         padding: 4px 8px;
         font-size: 16px;
         text-align: center;
         transition: none;
         font-weight: 400;
         margin-bottom: 0;
         padding-bottom: 0;
         text-decoration: none;
         }
         .linkEntry-0-2-13:hover {
         color: white;
         cursor: pointer;
         background: rgba(25,25,25,0.1);
         transition: none;
         border-radius: 4px;
         }
         .navItem-0-2-14 {
         padding-right: 2rem;
         }
         @media(max-width: 1300px) {
         .navItem-0-2-14 {
         padding-right: 1.75rem;
         }
         }
         @media(max-width: 1250px) {
         .navItem-0-2-14 {
         padding-right: 1.5rem;
         }
         }
         @media(max-width: 1175px) {
         .navItem-0-2-14 {
         padding-right: 1rem;
         }
         }
         .col-0-2-15 {
         margin-left: 0;
         padding-left: 0;
         }
      </style>
      <style data-jss="" data-meta="Unthemed">
         .icon-0-2-18 {
         float: right;
         margin-top: -24px;
         padding-top: 0;
         }
      </style>
      <style data-jss="" data-meta="Unthemed">
         .wrapper-0-2-16 {
         width: 100%;
         border: 1px solid #c3c3c3;
         padding: 4px 2px;
         background: white;
         border-radius: 2px;
         }
         .searchInput-0-2-17 {
         width: 100%;
         border: none;
         padding-top: 0;
         padding-bottom: 0;
         }
         .searchInput-0-2-17:focus {
         border: none!important;
         box-shadow: none!important;
         }
      </style>
      <style data-jss="" data-meta="Unthemed"></style>
      <style data-jss="" data-meta="Unthemed">
         .text-0-2-24 {
         color: #B8B8B8;
         font-size: 12px;
         font-weight: 400;
         }
         .link-0-2-25 {
         font-size: 21px;
         text-align: center;
         font-weight: 300;
         text-decoration: none;
         }
         .link-0-2-25:hover {
         color: #191919;
         }
         .footer-0-2-26 {
         background: #ffffff;
         }
         .footerContainer-0-2-27 {
         padding-top: 5px;
         padding-bottom: 20px;
         }
      </style>
      <style data-jss="" data-meta="Unthemed">
         .main-0-2-23 {
         min-height: 95vh;
         }
      </style>
      <style data-jss="" data-meta="Unthemed">
         .alertBg-0-2-19 {
         background: #F68802;
         }
         .alertText-0-2-20 {
         color: #fff;
         padding: 12px 0;
         font-size: 18px;
         text-align: center;
         font-weight: bold;
         }
         .alertLink-0-2-21 {
         color: #fff;
         }
         .alertLink-0-2-21:hover {
         text-decoration: underline;
         }
         .fakeAlert-0-2-22 {
         width: 100%;
         height: 40px;
         position: relative;
         }
      </style>
   </head>
   <body style="background: #e3e3e3;">
      <div id="__next" data-reactroot="">
         <div>
            <div class="wrapper-0-2-5 navbar-wrapper-main">
               <nav class="navbar fixed-top navbar-expand-lg navbar-0-2-1 navbar-d0-0-2-6">
                  <div class="navContainer-0-2-2 container">
                     <div class="row-0-2-4 row">
                        <div class="col-12 col-lg-8">
                           <div class="row-0-2-4 row">
                              <div class="col-0-2-10 col-2 col-lg-2">
                                 <a href="/home"><div class="imgDesktop-0-2-7"></div></a>
                              </div>
                              <div class="col-0-2-15 col-10 col-lg-5">
                                 <div class="container-0-2-12">
                                    <div class="row">
                                       <div class="col-3"><a class="linkEntry-0-2-13 nav-link active pt-0" href="/games">Games</a></div>
                                       <div class="col-3"><a class="linkEntry-0-2-13 nav-link active pt-0" href="/catalog">Catalog</a></div>
                                       <div class="col-3"><a class="linkEntry-0-2-13 nav-link active pt-0" href="/Groups">Groups</a></div>
                                       <div class="col-3"><a class="linkEntry-0-2-13 nav-link active pt-0" href="/Forum">Forum</a></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-12 col-lg-5">
                                 <div style="width:100%">
                                    <div class="wrapper-0-2-16">
<form action="/search/users/" method="POST" style="margin: 0px;">
<input value="" class="form-control searchInput-0-2-17" placeholder="Search" name="nyaa">
<span class="icon-0-2-18 icon-nav-search"></span>
</form>
</div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 col-lg-4">
                           <div class="linkContainerCol-0-2-43 ">
                              <div class="row">
                                 <div class="col-12 linkContainer-0-2-42">
<?php
if ($user) {
?>

                                    <p class="text-0-2-47" title="<?=$myu->emeralds;?>" style="color: white; display: inline; font-size: 16px; margin-top: 2px; text-align: right; font-weight: 400; white-space: nowrap; border-bottom: 0; margin-bottom: 0;"><a href="/Personal/Money"><span class="icon-nav-tix"></span></a></p>
                                    <p class="text-0-2-39 robuxText-0-2-44" style="margin-left:0.5px!important;"><span title="<?=$myu->emeralds;?>"><?=$myu->emeralds;?></span></p>
                                    <p class="text-0-2-39"><a href="/Personal/Settings/"><span class="icon-nav-settings settingsIcon-0-2-41" id="nav-settings"></span></a></p>
<?}else{?>
                                 <div class="container-0-2-12">
                                    <div class="row">
                                       <div class="col-3" style="width: 46%;"><a class="linkEntry-0-2-13 nav-link active pt-0" href="/Login">Login</a></div>
                                       <div class="col-3" style="width: 54%;"><a class="linkEntry-0-2-13 nav-link active pt-0" href="/Register">Register</a></div>
                                    </div>
                                 </div>
<?}?>                                 
</div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </nav>
</div>
<?php
if ($user) {
?>
<style data-jss="" data-meta="Unthemed">
.linkEntry-0-2-45 {
  padding-top: 5px;
  margin-bottom: 0;
}
.name-0-2-46 {
  font-size: 16px;
  vertical-align: middle;
}
.wrapper-0-2-47:hover {
  cursor: pointer;
}
.link-0-2-48 {
  color: inherit;
}
.countWrapper-0-2-49 {
  float: right;
  padding-top: 5px;
}
.count-0-2-50 {
  color: white;
  padding: 2px 7px;
  background: #01a2fd;
  border-radius: 10px;
}
</style>

<? 
$getMail = $handler->query("SELECT * FROM messages where receiver=" . $myu->id." AND unread='1'"); 
?>

               <div class="container-0-2-28">
                  <div class="card-0-2-29" style="padding-top: 40px;">
                     <p class="username-0-2-30"><?=$myu->username;?></p>
<? if ($myu->admin == "true"){ ?><a href="/Admin/">Admin Panel</a><?}?>
                     <div class="divider-0-2-31"></div>
                     <a class="link-0-2-36" href="/home">
                        <div class="wrapper-0-2-35 hover-icon-nav-home">
                           <p class="linkEntry-0-2-33"><span class="icon-nav-home"></span> <span class="name-0-2-34">Home</span></p>
                        </div>
                     </a>
                     <a class="link-0-2-36" href="/users/<?=$myu->id;?>/profile">
                        <div class="wrapper-0-2-35 hover-icon-nav-profile">
                           <p class="linkEntry-0-2-33"><span class="icon-nav-profile"></span> <span class="name-0-2-34">Profile</span></p>
                        </div>
                     </a>
                     <a class="link-0-2-36" href="/My/Messages">
                        <div class="wrapper-0-2-35 hover-icon-nav-message">
                           <p class="linkEntry-0-2-33"><span class="icon-nav-message"></span> <span class="name-0-2-34">Messages</span>  <? if($getMail->rowCount() > 0){?><span class="countWrapper-0-2-49"><span class="count-0-2-50"><?=$getMail->rowCount();?></span></span><?}?>  </p>
                        </div>
                     </a>
                     <a class="link-0-2-36" href="#">
                        <div class="wrapper-0-2-35 hover-icon-nav-friends">
                           <p class="linkEntry-0-2-33"><span class="icon-nav-friends"></span> <span class="name-0-2-34">Friends</span></p>
                        </div>
                     </a>
                     <a class="link-0-2-36" href="/Customize">
                        <div class="wrapper-0-2-35 hover-icon-nav-charactercustomizer">
                           <p class="linkEntry-0-2-33"><span class="icon-nav-charactercustomizer"></span> <span class="name-0-2-34">Character</span></p>
                        </div>
                     </a>
                     <a class="link-0-2-36" href="#">
                        <div class="wrapper-0-2-35 hover-icon-nav-inventory">
                           <p class="linkEntry-0-2-33"><span class="icon-nav-inventory"></span> <span class="name-0-2-34">Inventory</span></p>
                        </div>
                     </a>
                     <a class="link-0-2-36" href="#">
                        <div class="wrapper-0-2-35 hover-icon-nav-group">
                           <p class="linkEntry-0-2-33"><span class="icon-nav-group"></span> <span class="name-0-2-34">Groups</span></p>
                        </div>
                     </a>
                     <a class="link-0-2-36" href="/Forum/">
                        <div class="wrapper-0-2-35 hover-icon-nav-forum">
                           <p class="linkEntry-0-2-33"><span class="icon-nav-forum"></span> <span class="name-0-2-34">Forums</span></p>
                        </div>
                     </a>
                     <a class="link-0-2-36" href="/info/blog">
                        <div class="wrapper-0-2-35 hover-icon-nav-blog">
                           <p class="linkEntry-0-2-33"><span class="icon-nav-blog"></span> <span class="name-0-2-34">Blog</span></p>
                        </div>
                     </a>
                     <!--<a href="/Upgrade">
                        <p class="upgradeNowButton-0-2-32">Upgrade Now</p>
                     </a>
-->



<!--<div class="divider-0-2-31 mt-2"></div>

<a href="/Download">
                        <p class="upgradeNowButton-0-2-32">Client Testing</p>
                     </a>

<div class="divider-0-2-31"></div>-->





<a href="/user/logout.php">
                        <p class="upgradeNowButton-0-2-32">Logout</p>
                     </a>

                  </div>
               </div>
            </div>
<?}?>

<?php
if ($gB->text) {
?>
            <div class="alertBg-0-2-19">
               <p class="alertText-0-2-20"><?=$gB->text;?></p>
            </div>
<?}?>

<?php
if (!$gB->text) {
?>
<style>.haii{margin-top:1rem;}</style>
<?}?>
            <div class="main-0-2-23">
               <div class="row">
                  <div class="col-6 mx-auto mainthing haii">
