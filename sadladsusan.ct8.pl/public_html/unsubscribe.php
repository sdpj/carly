<?php
	$sub_from = $_REQUEST['data1'];
	$sub_to = $_REQUEST['data2'];

	include("db_credentials.php");

    // see if the subscription already exists from user $sub_from to $sub_to
	$query_unsubscribe = "DELETE FROM Subscriptions WHERE subscriber_id=".$sub_from." AND subscribed_to_id=".$sub_to;
	echo ($query_unsubscribe);

	if ($conn->query($query_unsubscribe) === TRUE) {
		echo "Unsubscribed from ".$sub_to."!";
	} 
	else {
		echo "Error: " . $query_unsubscribe . "<br>" . $conn->error;
	}
?>