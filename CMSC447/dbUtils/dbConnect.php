<?php
	function ConnectToDatabase() {
		$dbEndpoint = "goodsamaritans.cqnoxiob8a44.us-east-2.rds.amazonaws.com";	
		$dbName = "goodsamaritans";
		$dbUsername = "cmsc447";
		$dbPassword= "goodsamaritans";
		$port = 3306;

		// Create connection
    	$conn = mysqli_connect($dbEndpoint, $dbUsername, $dbPassword, $dbName, $port);

    	if (!mysqli_select_db($conn, $dbName)) {
        	die("Uh oh, couldn't select database $dbName");
    	}

    	// Check connection
	    if ($conn->connect_error) {
	        die("Connection failed: " . $conn->connect_error);
	    } else {
	        return $conn;
		}
	}
