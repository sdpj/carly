
<? include 'Core.php'; ?>



<head>
<title>noynac patched</title>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.min.js"></script>
<link href="/css/OptionalUpdateTheme.min.css" rel="stylesheet">
<link href="/css/bootstrapalternative.min.css" rel="stylesheet">
<link href="/css/heroic-features.css" rel="stylesheet">
<script type="text/javascript"> //<![CDATA[ 
var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.comodo.com/" : "http://www.trustlogo.com/");
document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
//]]>
</script>
</head>


<body>
<center>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="color: #d9534f;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                </span>&nbsp;&nbsp;noynac patched</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
<li>
                        <a href="/" style="color: white;"><span class="glyphicon glyphicon-home" style="color: white;"></span>&nbsp;&nbsp;Home</a>
                    </li>
                    <li>
                        <a href="/users.php" style="color: white;"><span class="glyphicon glyphicon-eye-open" style="color: white;"></span>&nbsp;&nbsp;Users</a>
 </li>
                    <li>

               <a href="/Forum/" style="color: white;"></span>&nbsp;&nbsp;Forum</a>

<li><a href='/Store/' style='color: white;'><span class='glyphicon glyphicon-shopping-cart' style='color: white;'></span>&nbsp;&nbsp;Store</a></li>
                    </li>
<?
$getConfig = mysql_query("SELECT * FROM Configuration");
$gC = mysql_fetch_object($getConfig);
if($gC->Register == "true"){
echo"<li><a href='/Store/UserStore.php' style='color: white;'><span class='glyphicon glyphicon-shopping-cart' style='color: white;'></span>&nbsp;&nbsp;User Store</a></li>";}elseif($gC->Avatars == "2D"){
echo"        <li>


                        <a href='/Store' style='color: white;'><span class='glyphicon glyphicon-shopping-cart' style='color: white;'></span>&nbsp;&nbsp;Item Store</a>
                    </li>";
};
?>
                </ul>
<?
                                                                       if ($User) {
									
								echo "<ul class='nav navbar-nav navbar-right'  style='color: #d9534f;'>
<li><a href='#' style='color: lightgreen;'>$Bux cash</a></li>


                                                                     <li class='dropdown'  style='color: #d9534f;'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false' style='color: white;' >$User<span class='caret' style='color: white;'></span></a>
          <ul class='dropdown-menu' role='menu'  style='color: #d9534f;'>
            <li style='color: #d9534f;'><a href='/Settings.php' style='color: #d9534f;'><span class='glyphicon glyphicon-cog' style='color: #d9534f;'></span>&nbsp;&nbsp;Account Settings</a></li>
            <li><a href='/character.php' style='color: #d9534f;'><span class='glyphicon glyphicon-user' style='color: #d9534f;'></span>&nbsp;&nbsp;Wardrobe</a></li>";
            if($myU->PowerAdmin == "true"){
            echo"<li class='divider'></li>
            <li><a href='/ItemRelease.php'  style='color: #d9534f;'><span class='glyphicon glyphicon-wrench'  style='color: #d9534f;'></span>&nbsp;&nbsp;Store Items Mod</a></li>
            <li><a href='/ItemModeration.php'  style='color: #d9534f;'><span class='glyphicon glyphicon-pencil'  style='color: #d9534f;'></span>&nbsp;&nbsp;User Shop Mod</a></li>";


            };
            echo"<li class='divider'></li>
            <li><a href='/Logout.php'  style='color: #d9534f;'><span class='glyphicon glyphicon-log-out'  style='color: #d9534f;'></span>&nbsp;&nbsp;Logout</a></li>
          </ul>
        </li>
</ul>
										";
									
									}
									else {
									
										echo "
									    <ul class='nav navbar-nav navbar-right'>
									           <li><a href='Login.php'  style='color: white;'>Login</a></li>
                                                                                   <li><a href='Register.php'  style='color: white;'>Register</a></li>
									</ul>
										";
									
									}
									?>
            </div>
        </div>
    </nav>
    <div class="container">
<?
if($gC->Maintenance == "true"){
if(!$User){
    header('Location: main.php');
    }elseif($myU->PowerAdmin == "false"){
    header('Location: main.php');
    }elseif($myU->PowerAdmin == "true"){
    echo "<div class='alert alert-danger'>
         <center>Currently in Maintenance Mode!</center>
         </div>";
    };
  };
$getShout = mysql_query("SELECT * FROM Banner");
while ($gB = mysql_fetch_object($getShout)) {
if (!empty($gB->Text)) { 
echo"
<div class='alert-ban' style='background-color: #d9534f; color: white;'>
<center>".nl2br($gB->Text)."</center>
</div><br>";
};
};
?>
</body>
