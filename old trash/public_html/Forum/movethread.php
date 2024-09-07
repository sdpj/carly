<?
include '../Header.php';
?>
<?
echo "<h1>Move Thread To What Topic?</h1>";
$getID = mysql_real_escape_string($_GET['ID']);
$getTopics = mysql_query("SELECT * FROM Topics ORDER BY ID");
$getThread = mysql_query("SELECT * FROM Threads WHERE ID='$getID'");
$gT1 = mysql_fetch_object($getThread);
	while ($gT = mysql_fetch_object($getTopics)) {
	echo  "<a href='/Forum/moveto.php?ID=$gT->ID&threadID=$gT1->ID' style='font-size:15px;font-color:darkblue;'><font color='darkblue'><b> ".$gT->TopicName."</b></font></a><br>";
	
	
	}



?>