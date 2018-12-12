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

	$addEvent = "INSERT INTO EVENTS(status,description,location,priority,civilian_id,fire_event,crime_event,water_event,general_event)
					VALUES(0,'$description','$address','$priority','$civilianID','$fireEvent','$crimeEvent','$waterEvent','$generalEvent')";

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

// get all non completed events
function getEvents(){
	//initialize connection
	$connection = ConnectToDatabase();

	$queryString = "SELECT * FROM EVENTS 
	INNER JOIN CIVILIANS ON EVENTS.civilian_id = CIVILIANS.civilian_id
	WHERE (status = 0 or status =1) and priority !=0";

	//run the query
	$result = $connection->query($queryString);

	//close the db connection
	$connection->close();
	
    $arrayOfDicts = array();

    while ($row = $result->fetch_assoc()) {
        array_push($arrayOfDicts, $row);
    }

    return $arrayOfDicts;

}

//get all the  events that were created by civilians that havent been processed by the 911 operator yet
function getCivilianCreatedEvents(){
		//initialize connection
		$connection = ConnectToDatabase();

		$queryString = "SELECT * FROM EVENTS 
		INNER JOIN CIVILIANS ON EVENTS.civilian_id = CIVILIANS.civilian_id
		WHERE priority = 0";
	
		//run the query
		$result = $connection->query($queryString);
	
		//close the db connection
		$connection->close();
		$arrayOfDicts = array();

		while ($row = $result->fetch_assoc()) {
			array_push($arrayOfDicts, $row);
		}
	
		return $arrayOfDicts;
}

function updateEvent($eventID, $status,$priority){
	//initialize connection
	$connection = ConnectToDatabase();
	echo "evnet Id" . $eventID ."thing" ;
	$queryString = "UPDATE EVENTS
					SET status = $status, priority = $priority
					WHERE event_id = $eventID ";

	//run the query
	$result = $connection->query($queryString);
	echo("Error description: " . mysqli_error($connection));
	//close the db connection
	$connection->close();
}
 
function deleteEvent($eventID){
//initialize connection
$connection = ConnectToDatabase();
echo $eventID;	
$queryString = "DELETE FROM EVENTS WHERE event_id=$eventID";

//run the query
$result = $connection->query($queryString);
echo("Error description: " . mysqli_error($connection));
//close the db connection
$connection->close();
}