<style>
  @media only screen and (max-width: 500px) {
    .footer {
      height:95px
    }
  }
</style>
<div style="margin-bottom:50px"></div>
<?php
  if ($GLOBALS['loggedIn'] && $GLOBALS['userTable']['themeChoice'] == 0 || $GLOBALS['loggedIn'] == false) {
    echo '<footer class="container center" style="/*box-shadow:0 1px 50px 0 rgba(34,36,38,.15);*/border: 1px solid rgba(0,0,0,.125);width:63%;margin:auto;background: #fff;">';
  }else{
    echo '<footer class="footer container center">';
  }
?>
  <h5 style="color:grey;font-size:22px;margin-bottom:0px"></h5>
  <b>Copyright © <?php echo config::getName(); echo" "; echo date("Y"); ?></b> 
  <br><a href="/Legal/rules">Rules</a> | <a href="/Legal/privacy">Privacy</a> | <a href="/Legal/terms">Terms</a> | Users: <?php echo context::getUserCount(); ?>
  <p style="margin-bottom:0px">All rights belong to their respective owners.</p>
</footer>

