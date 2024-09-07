<?php include "../header.php"; 
?>
<style>body{background-color:#fff!important;}
div#ErrorPage h1 {
    font-size: 40px;
    font-weight: bold;
    color: #363636;
    letter-spacing: -2px;
    margin-bottom: 10px;
    display: block;
}
div#ErrorPage h3 {
    color: #363636;
    font-weight: bold;
    font-size: 16px;
}
img.ErrorAlert {
    display: block;
    margin: 25px auto 10px;
}
div#ErrorPage .divideTitleAndBackButtons {
    margin: 20px auto;
    height: 1px;
    width: 99%;
    border-top: 1px solid #ccc;
    margin-top: 0px;
}
.btn-neutral, .btn-neutral:link, .btn-neutral:active, .btn-neutral:visited {
    border: 1.5px solid #0249c6;
    background-color: #0852b7;
    background: linear-gradient(0deg, rgba(8,79,192,1) 0%, rgba(5,103,234,1) 100%);
    color: white;
}
.btn-neutral:hover {
  background: linear-gradient(0deg, rgba(2,73,198,1) 0%, rgba(7,147,253,1) 100%); ;
}
.btn-small {
    padding: 2.1px 7.5px 19.5px 7px;
    height: 20px;
    min-width: 40px;
    font-size: 14px;
    line-height: 18px;
    background-position: left -160px;
}
.btn-large, .btn-medium, .btn-small {
    margin: 0;
    display: inline-block;
    zoom: 1;
    text-align: center;
    font-weight: normal;
    text-decoration: none;
    border-width: 1px;
    border-style: solid;
    cursor: pointer;
}
div#ErrorPage {
    text-align: center;
    margin-bottom: 20px;
}
#ErrorPage {
    text-align: center;
}
</style>

<div id="ErrorPage">    
    <img src="/images/404.png" id="ctl00_cphRoblox_ErrorImage" alt="Alert" class="ErrorAlert">
    
    <h1><span id="ctl00_cphRoblox_ErrorTitle">Requested page not found</span></h1>
    <h3><span id="ctl00_cphRoblox_ErrorMessage">You may have clicked an expired link or mistyped the address.</span></h3>
    <p><span id="ctl00_cphRoblox_CustomerServiceMessage"></span></p>
    <pre style="text-align:left;margin-left:10px;"><span id="ctl00_cphRoblox_errorMsgLbl"></span></pre>

    <div class="divideTitleAndBackButtons">&nbsp;</div>

    <div class="CenterNavigationButtonsForFloat">
        <a class="btn-small btn-neutral" title="Go to Previous Page Button" onclick="history.back();return false;" href="#">Go to Previous Page</a>
        <a class="btn-neutral btn-small" title="Return Home" href="/">Return Home</a>
        <div style="clear:both"></div>
    </div>
</div>


<?php include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>