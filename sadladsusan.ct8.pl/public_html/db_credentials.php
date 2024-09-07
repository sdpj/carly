<?php
	$servername = "mysql.ct8.pl";
	$username = "m32361_ronaldo";
	$password = "Goal1#";
	$db = "m32361_ronaldo";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>