<?php 
ini_set('display_errors', 1);
include('dbConnect.php');

//gerneral format for set queries
function addEvent($name,$address,$emergencyType,$description,$email,$phone,$priority){
	//initializes connection
	$connection = ConnectToDatabase();

	$fireEvent = 0;
	$waterEvent = 0;
	$crimeEvent = 0;
	$generalEvent = 0;

	if($emergencyType == 'Water'){
		$waterEvent = 1;
	}
	elseif ($emergencyType == 'Fire'){
		$fireEvent = 1;
	}
	elseif ($emergencyType == 'Crime'){
		$crimeEvent = 1;
	}
	elseif($emergencyType == 'General'){
		$generalEvent = 1;
	}

	$addCivilian= "INSERT INTO CIVILIANS(name, phone, email)
					 VALUES('$name','$phone','$email')";

	//actually runs the query
	$connection->query($addCivilian);

	//echo mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n";
	//id that was created 	
	$civilianID = $connection->insert_id;

	$addEvent = "INSERT INTO EVENTS(description,location,priority,civilian_id,fire_event,crime_event,water_event,general_event)
					VALUES('$description','$address','$priority','$civilianID','$fireEvent','$crimeEvent','$waterEvent','$generalEvent')";

	$connection->query($addEvent);

	//close the db connection
	$connection->close();
	return;
}

//checks the login for the 911 operator
function operatorLogin($loginID){
	$connection = ConnectToDatabase();

	$query = "SELECT * FROM 911_OPERATORS WHERE	login =$loginID";

	$results = $connection->query($query);

	if (mysqli_num_rows($results) == 0) {
        return false;
    } else {
        return true;
    }
}

// checks the login for the emergency responder
function responderLogin($loginID){
	$connection = ConnectToDatabase();

	$query = "SELECT * FROM EMERGENCY_RESPONDERS WHERE login =$loginID";

	$results = $connection->query($query);

	if (mysqli_num_rows($results) == 0) {
        return false;
    } else {
        return true;
    }
}

// function getEvent(/*query params*/){
// 	//initialize connection
// 	$connection = ConnectToDatabase();

// 	$queryString = "stuff";

// 	//run the query
// 	$result = $connection->query($queryString);

// 	//close the db connection
// 	$connection->close();

// 	//turn the output 
// 	return mysqli_fetch_assoc($result);

// }

 