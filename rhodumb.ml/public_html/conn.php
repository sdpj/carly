<?php
define('DB_SERVER', 'mysql.ct8.pl');
define('DB_USERNAME', 'm27001_smbflash');
define('DB_PASSWORD', 'Yahoo1#');
define('DB_NAME', 'm27001_smbflash');
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
