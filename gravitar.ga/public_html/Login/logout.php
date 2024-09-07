<?php
setcookie("ch_salt", "", time()-1, "/");
ob_end_clean();
header('location: ../Home.php');
