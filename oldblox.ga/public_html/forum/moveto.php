<?
include '../Header.php';
?>
<?
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"||$myU->PowerForumModerator == "true") {
$getID = $_GET['ID'];
$getTID = $_GET['threadID'];

$getTopics = mysql_query("SELECT * FROM Topics ORDER BY ID");
$getThread = mysql_query("SELECT * FROM Threads WHERE ID='$getID'");

$gT1 = mysql_fetch_object($getThread);
$gT = mysql_fetch_object($getTopics);

if($getID) {
mysql_query("UPDATE Threads SET tid='$getID' WHERE ID='$getTID'");
header('Location: /Forum');
	}
	}
?>