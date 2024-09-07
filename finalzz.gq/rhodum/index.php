<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/includes.php';
  if ($GLOBALS['loggedIn']) {
    header("Location: /user/dashboard");
    exit;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo config::getName();?></title>
    <?php html::buildHead();?>
    <script src="/core/html/js/particles.min.js"></script>
    <script>
      particlesJS.load('particles-js', 'core/html/js/particles.json', function() {
        console.log('particles.js loaded - callback');
      });
    </script>
    <!--<link rel="stylesheet" href="https://bootswatch.com/5/lumen/bootstrap.min.css">-->
    <style>
      #particles-js{
        width: 100%;
        height: 100%;
        background-image: url('');
        background-size: cover;
        background-position: 50% 50%;
        background-repeat: no-repeat;
      }
      canvas {
        position: absolute;
        left: 0;
        top: 0;
        z-index: -999
      }
      .card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .25rem;
    width: 373px;
}
    </style>
  </head>
  <body><style>
    .home-main-content {
        background: url(/core/html/img/finobebanner.jpg) no-repeat center center;
        background: url(/core/html/img/finobebanner.jpg) no-repeat center center, -webkit-linear-gradient(top left, #312a6c, #852d91);
        background: url(/core/html/img/finobebanner.jpg) no-repeat center center, -moz-linear-gradient(top left, #312a6c, #852d91);
        /*background: url(img/hallo.png) no-repeat center center;
        background: url(img/hallo.png) no-repeat center center, -webkit-linear-gradient(top left, #312a6c, #852d91);
        background: url(img/hallo.png) no-repeat center center, -moz-linear-gradient(top left, #312a6c, #852d91);*/
      background-size: cover;
      margin: 0;
      padding: 0;
      height: 350px;
      color: #ececec;
      display: flex;
      width:100%;
      
    }

    .home-main-content > .container {
      display: flex;
      flex-direction: column;
      align-self: center;
    }
    
    .home-main-content {
    margin-right: 0;
    margin-left: 0;
    padding-left: 0px;
    padding-right: 0px;
    width:100%;
}
    nav {
      margin-bottom:0px !important;
      }
    .topspace {
      margin-bottom:0px !important;
</style>
    <?php html::getNavigation();?>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    
      <div id="particles-js">
        <div class="home-main-content"><div class="container d-flex justify-content-center"><h1 class="mb-4 home-text" style="color: #ececec;padding-bottom:10px;">We don't do what FinalB does</h1> <p class="home-text" style="font-weight:normal;padding-bottom:10px;">FinalB puts RATs on your not-phone.</p> <p><a href="/Register" class="btn btn-primary btn-lg mt-3 mr-2">Get started ›</a></p></div></div>
      </div>
    
    <div class="container" style="margin:auto;margin-top:3%;">

</div>
    
 <div style="text-align:left;box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; position:relative;margin-left:auto;margin-right:auto;padding-right:15px;padding-left:15px;width:960px;max-width:100%;height:auto;margin-top:20px;"><span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span>
<div style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; -webkit-box-orient:horizontal;display:-webkit-box;-webkit-box-direction:normal;text-align:center;"><span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span>
<div style="box-sizing:inherit;-moz-box-sizing:inherit;-ms-box-sizing:inherit;position:relative;background-color:rgb(255, 255, 255);border-top-left-radius:4.0px 4.0px;border-top-right-radius:4.0px 4.0px;border-bottom-right-radius:4.0px 4.0px;border-bottom-left-radius:4.0px 4.0px;display:-webkit-box;-webkit-box-direction:normal;-webkit-box-flex:1;-webkit-box-orient:vertical;margin-right:15px;border-width:1px;border-style:solid;border-color:rgba(0, 0, 0, 0.121094)"><span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span>
<div style="box-sizing:inherit;-moz-box-sizing:inherit;-ms-box-sizing:inherit;-webkit-box-flex:1;vertical-align:middle;padding:20.0px"><span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span>
<h5 style="box-sizing:inherit;-moz-box-sizing:inherit;-ms-box-sizing:inherit;margin-top:0px;margin-bottom:8.0px;font-family:inherit;font-weight:500;line-height:1.1;color:inherit;font-size:20.0px"><span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span>94.5% SAFER<span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span></h5>
We're tired of Epiculy's RATvivals.<span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span></div>
<span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span></div>
<div style="box-sizing:inherit;-moz-box-sizing:inherit;-ms-box-sizing:inherit;position:relative;background-color:rgb(255, 255, 255);border-top-left-radius:4.0px 4.0px;border-top-right-radius:4.0px 4.0px;border-bottom-right-radius:4.0px 4.0px;border-bottom-left-radius:4.0px 4.0px;display:-webkit-box;-webkit-box-direction:normal;-webkit-box-flex:1;-webkit-box-orient:vertical;margin-left:15px;margin-right:15px;border-width:1px;border-style:solid;border-color:rgba(0, 0, 0, 0.121094)"><span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span>
<div style="box-sizing:inherit;-moz-box-sizing:inherit;-ms-box-sizing:inherit;-webkit-box-flex:1;vertical-align:middle;padding:20.0px"><span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span>
<h5 style="box-sizing:inherit;-moz-box-sizing:inherit;-ms-box-sizing:inherit;margin-top:0px;margin-bottom:8.0px;font-family:inherit;font-weight:500;line-height:1.1;color:inherit;font-size:20.0px"><span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span>95.5% FUNNIER<span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span></h5>
Inb4 he rages about this site!<span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span></div>
<span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span></div>
<div style="box-sizing:inherit;-moz-box-sizing:inherit;-ms-box-sizing:inherit;position:relative;background-color:rgb(255, 255, 255);border-top-left-radius:4.0px 4.0px;border-top-right-radius:4.0px 4.0px;border-bottom-right-radius:4.0px 4.0px;border-bottom-left-radius:4.0px 4.0px;display:-webkit-box;-webkit-box-direction:normal;-webkit-box-flex:1;-webkit-box-orient:vertical;margin-left:15px;border-width:1px;border-style:solid;border-color:rgba(0, 0, 0, 0.121094)"><span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span>
<div style="box-sizing:inherit;-moz-box-sizing:inherit;-ms-box-sizing:inherit;-webkit-box-flex:1;vertical-align:middle;padding:20.0px"><span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span>
<h5 style="box-sizing:inherit;-moz-box-sizing:inherit;-ms-box-sizing:inherit;margin-top:0px;margin-bottom:8.0px;font-family:inherit;font-weight:500;line-height:1.1;color:inherit;font-size:20.0px"><span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span>96.5% LESS SUS<span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span></h5>
*insert everything he's ever said*<span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span></div>
<span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span></div>
<span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span></div>
<span style="box-sizing: inherit; -moz-box-sizing: inherit; -ms-box-sizing: inherit; "></span></div>   
    
    <?php html::buildFooter();?>
  </body>
</html>
