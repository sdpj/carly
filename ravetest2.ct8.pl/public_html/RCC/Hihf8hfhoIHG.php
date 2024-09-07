<?php include('../Site/init.php'); 

header("Content-Type: text/plain");

error_reporting(E_ALL);

$q = $handler->query("SELECT * FROM thumbnailque ORDER BY userid DESC LIMIT 1");

$row = $q->fetch();



$quecheck = $row['userid'];



if ($quecheck == ''){

    exit('{"userid":"null","charapp":"http://yrk.ct8.pl/RCC/charget.php?id=1","status":"true"}');

}



?>
{"userid":"<? echo $row['userid']; ?>","charapp":"<? echo $row['thumbnail']; ?>","status":"false"}