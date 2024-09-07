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
        <script data-ad-client="ca-pub-3105696169953509" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <title><?php echo config::getName();?></title>
    <?php html::buildHead();?>
        <style>
        h1 {
            text-shadow: 1px 1px #000000;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        h2 {text-align: center;}
        .text-center {
        text-align: center;
    }

    .g-recaptcha {
        display: inline-block;
    }
        </style>
  </head>
  <body style="margin:0;background-color:#EEEEEE">
    <?php html::getNavigation();?>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <div class="container">
    <div>
    <div class="container-fluid" style="">    
        <div id="loginbox" style="margin-top:10px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">   
        <div class="col-xs-12 col-sm-12 col-md-10" id="particles-js-" style="background-color:#fff !important;padding:10px;border: 1px solid rgba(0, 0, 0, 0.121094);border-radius:4px;">
          <script src="/core/func/js/auth/register.js?v=29"></script><script src="/core/html/js/particles.min.js"></script>
    <script>
      particlesJS.load('particles-js', 'core/html/js/particles.json', function() {
        console.log('particles.js loaded - callback');
      });
    </script>
                    <img src="/core/html/img/logo.png" alt="Logo" class="center">
          <h2>Register</h2>
          <div id="rStatus"></div>
          <input class="form-control" type="text" id="rUsername" placeholder="Username" style="width:70%;margin:auto;margin-bottom:5px;"></input>
          <input class="form-control" type="email" id="rEmail" placeholder="E-Mail (will be verified)" style="width:70%;margin:auto;margin-bottom:5px;"></input>
          <input class="form-control" type="password" id="rPassword1" placeholder="Password" style="width:70%;margin:auto;margin-bottom:5px;"></input>
          <input class="form-control" type="password" id="rPassword2" placeholder="Password (again)" style="width:70%;margin:auto;"></input>
          <p> </p>
          <div class="text-center"><div class="g-recaptcha" data-sitekey="6LfeEkUeAAAAAFANyCqLSRRySx8l19HVnBJWnZ_8" style="margin:auto !important;"></div></div>
          <p> </p>
          <button class="btn btn-primary fullWidth" id="rSubmit">Register</button>
        </div>
      </div>
        </div>
      </div>
        </div>                     
    </div>
    </div>
  </body>
</html>