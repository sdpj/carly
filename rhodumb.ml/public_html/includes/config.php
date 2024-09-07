<?php
$name = "SMFGeneration";
?>


<?php // dont touch these
define('DB_SERVER', 'mysql.ct8.pl');
define('DB_USERNAME', 'm27001_smbflash');
define('DB_PASSWORD', 'Yahoo1#');
define('DB_NAME', 'm27001_smbflash');
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

<?php
    //Database settings
    $dbhost = "mysql.ct8.pl"; //Database host
    $dbuser = "m27001_smbflash"; //Database username
    $dbpassword = "Yahoo1#"; //Database Password. Leave blank for no password!
    $dbname = "m27001_smbflash"; //Database Name;

    //General Settings
    $sitename = $name; //Website Name;


    //Dont edit this line!
    $conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
?>

