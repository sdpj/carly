<?php

$dbName = 'm27001_3DAVATAR';
$host = 'mysql.ct8.pl';
$username = 'm27001_3DAVATAR';
$password = 'Sg090228';

$secretGameKey = "86938";
$secretServerKey = "86938";

function dbConnect()
{
	global  $dbName;
	global  $host;
	global  $username;
	global  $password;

	$link = mysql_connect($host, $username, $password);
	
	if(!$link)
	{
		fail("Couldn�t connect to database server");
	}
	
	if(!@mysql_select_db($dbName))
	{
		fail("Couldn�t find database $dbName");
	}
	
	return $link;
}
	
function safe($variable)
{
	$variable = addslashes(trim($variable));
	return $variable;
}

function fail($errorMsg)
{
	print $errorMsg;
	exit;
}

?>