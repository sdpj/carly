<?php
$servername = "mysql.ct8.pl";
$username = "m27001_w2b";
$password = "Sg090228";
$database = "m27001_w2b";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
