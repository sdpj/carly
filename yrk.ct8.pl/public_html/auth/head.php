<? include("../Site/init.php"); ?>


<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="/auth/style.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="/auth/icon.png">
    
    <? if($title){ ?><title><?=$title;?></title><? } ?>
    <meta name="description" content="<?=$sitename;?> is a revival like no other. No invite keys, multiple years, and free!"/>
    <meta name="twitter:card" content="summary" />
    <meta property="og:url" content="https://<?=$_SERVER['SERVER_NAME'];?>" />
    <meta property="og:title" content="Relive your favorite years with <?=$sitename;?>" />
    <meta property="og:description" content="<?=$sitename;?> is a revival like no other. No invite keys, multiple years, and free!" />
    <meta property="og:image" content="https://<?=$_SERVER['SERVER_NAME'];?>/auth/icon.png" />

</head>
<body class="d-flex flex-column h-100">
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <a class="navbar-brand" href="/">
    <img src="/auth/logo.png" height="30" alt="<?=$sitename;?>">
  </a>
                    <li class="nav-item">
                        <? if(!$user){ ?>
                        <a class="nav-link" href="/auth/login">Login</a>
                        <? }else{ ?>
                        <a class="nav-link" href="/user/logout.php">Logout</a>
                        <? } ?>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="/auth/contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/auth/discord">Discord</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/auth/tos">Terms of Service</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/auth/privacy">Privacy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/auth/account-deletion">Account Deletion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<? if($user){ ?>
<nav class="navbar navbar-expand-lg navbar-dark navbar-auth bg-dark border-bottom pt-0 pb-0">
<div class="container-fluid">
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link" href="/home">Roblox Home</a>
</li>
<li class="nav-item">
<a class="nav-link" href="/internal/redeem">Redeem Code</a>
</li>
<li class="nav-item">
<a class="nav-link" href="/internal/invite">Invite</a>
</li>
<li class="nav-item">
<a class="nav-link" href="/internal/updates">Client Updates</a>
</li>
<li class="nav-item">
<a class="nav-link" href="/internal/migrate-to-application">Migrate to Application</a>
</li>
<li class="nav-item">
<a class="nav-link" href="/internal/membership">Membership Type</a>
</li>
<li class="nav-item">
<a class="nav-link" href="/internal/collectibles?userId=">My Collectibles</a>
</li>
</ul>
</div>
</div>
</nav>
<? } ?>
    <div id="Announcement">
        <div id="SystemAlertDiv" style="background-color:#f68802;padding:12px 0;margin:0;text-align:center;color:#fff;font-size:18px;">
            <div id="LabelAnnouncement">
                <a href="https://discord.gg/<?=$discord;?>" style="color:#fff;">discord.gg/<?=$discord;?></a>
            </div>
        </div>
    </div>
<main class="flex-shrink-0">
    

<style>
    .navbar-auth {
        margin-bottom:  -1px;
    }
    body {
        overflow-x:  hidden;
    }
    #carouselIndicators {
        background:  #000;
    }
    .carousel-inner {
        opacity: 0.5;
    }
    img.c-home {
        max-height: 60vh;
        min-height: 370px;
        object-fit: cover;
    }
    .carousel-text {
        z-index: 3;
        position: relative;
        top: 0;
        height: 0;
        overflow: visible;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.9);
    }
    .carousel-text h1 {
        font-size:  5rem;
        color:  #fff;
        padding-top: 1rem;
    }
    .carousel-text p {
        color:  #fff;
        font-weight: 500;
    }
    
    .container-one {
        padding-top: 4rem;
        padding-bottom: 4rem;
    }
    .selling-points > li {
        margin: 1rem 0;
    }
</style>


