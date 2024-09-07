<?php

/* Database credentials. */

define('DB_SERVER', 'mysql.ct8.pl');

define('DB_USERNAME', 'm32361_2005');

define('DB_PASSWORD', 'Watch1#');

define('DB_NAME', 'm32361_2005');

 

/* Attempt to connect to MySQL database */

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

 

// Check connection

if($link === false){

    die("ERROR: Could not connect. " . mysqli_connect_error());

}

?>