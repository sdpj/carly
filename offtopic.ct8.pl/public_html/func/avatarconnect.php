
<?php
error_reporting(0);
$host = "mysql.ct8.pl";
$user = "m27001_3DAVATAR";
$pass = "Sg090228";
$name = "m27001_3DAVATAR";

$conn = new MySQLi($host, $user, $pass, $name);

if ($conn->connect_errno) {
    die("ERROR : -> " . $conn->connect_error);
}
/* Not needed.
 if(!$conn) {
  die("Database Error");
}
*/
if(session_status() == PHP_SESSION_NONE) {
  session_name("TetrimusSess");
  session_start();
}

$loggedIn = isset($_SESSION['id']);

$query = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['id']);
$userRow = mysqli_fetch_array($query);

$CurrentUser = $conn->query("SELECT * FROM users WHERE id='".$userRow['id']."'");
$user = mysqli_fetch_object($CurrentUser);
?>
