<?php
	$sub_from = $_REQUEST['data1'];
	$sub_to = $_REQUEST['data2'];

	include("db_credentials.php");

    // see if the subscription already exists from user $sub_from to $sub_to
	$query_search_subscription = "SELECT * FROM Subscriptions WHERE subscriber_id=".$sub_from." AND subscribed_to_id=".$sub_to;
	$result = $conn->query($query_search_subscription);

	if ($result->num_rows === 1) {
		// already subscribed to this person!
		// TODO: prompt for an unsubscribe...
	}
	else {
		$latest_id = 0;		
		$query_latest_subscription = "SELECT * FROM Subscriptions ORDER BY subscription_id DESC LIMIT 1";
		$result = $conn->query($query_latest_subscription);
		if ($result->num_rows === 1) {
			while($row = $result->fetch_assoc()) {
				$latest_id = $row['subscription_id'];
			}
		}
		
		// add the subscription to DB
		$query_add_subscription = "INSERT INTO Subscriptions (subscription_id, subscriber_id, 
			subscribed_to_id, subscription_date)
			VALUES (".($latest_id+1).", '$sub_from', '$sub_to', '2020-05-01')";
			
		if ($conn->query($query_add_subscription) === TRUE) {
			echo "Subscribed to ".$sub_to."!";		
		} 
		else {
			echo "Error: " . $query_add_subscription . "<br>" . $conn->error;
		}
	}
?>