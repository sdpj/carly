<script src="https://cdnjs.cloudflare.com/ajax/libs/material-ui/5.0.0-alpha.4/Popper/Popper.min.js"></script><script src="https://unpkg.com/bootstrap.min.js@3.3.5/bootstrap.min.js"></script><?php
            require "connect.php";
            $amountofusers = 0;
            $onlinepeople = 0;
      $conn2 = new mysqli($host, $db_user, $db_password);
      $conn2->select_db($db_name);
        // Check connection
      if ($conn2->connect_error) {
          die("Connection failed: " . $conn2->connect_error);
      }
      $sql = "SELECT id FROM users";

      $result = $conn2->query($sql);
        $amountofusers = $result->num_rows;
      $conn2->close();
      
      $conn2 = new mysqli($host, $db_user, $db_password);
      $conn2->select_db($db_name);
        // Check connection
      if ($conn2->connect_error) {
          die("Connection failed: " . $conn2->connect_error);
      }
      $sql = "SELECT * FROM users WHERE online=1";

      $result = $conn2->query($sql);
        $onlinepeople = $result->num_rows;
      $conn2->close();
      $assa = randnumber(1, $amountofusers);
      $assa2 = randnumber(1, $amountofusers);
      $assa3 = randnumber(1, $amountofusers);
            ?>
         
<style>
  @import url("https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
  i {
font-family: fontawesome !important;
}</style>

<div class="footer">
   <div class="container">
      <p class="my-0"><b>Copyright © Cubed 2022</b> | <b>Lucky number:</b> <?php echo $assa; ?><?php echo $assa2; ?>/<?php echo $assa3; ?><?php echo $amountofusers; ?></p>
      <div class="d-flex align-items-center mt-1 mb-0">
         <div class="dropdown">
            <button class="btn btn-theme btn-sm mr-2 mb-0" type="button" id="locale-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="far fa-language mr-2"></i><i class="far fa-caret-up"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="locale-dropdown">
               <a class="dropdown-item locale-change-link active" href="#" data-locale="en">English (US)</a>
               <a class="dropdown-item locale-change-link" href="#" data-locale="pt_BR">Portugues (Brasil)</a>
               <a class="dropdown-item locale-change-link" href="#" data-locale="es_US">Español (Estados Unidos)</a>
               <a class="dropdown-item locale-change-link" href="#" data-locale="de_DE">Deutsch</a>
               <a class="dropdown-item locale-change-link" href="#" data-locale="pl_PL">Polski (Polska)</a>
            </div>
         </div>
         <p class="my-0">
            <a href="/legal/about-us" style="color: #11b0ff!important;">About Us</a> | <a href="/legal/rules" style="color: #11b0ff!important;">Rules</a> | <a href="/legal/terms" style="color: #11b0ff!important;">Terms of Service</a> | <a href="/legal/privacy" style="color: #11b0ff!important;">Privacy Policy</a>
         </p>
      </div>
   </div>
</div>