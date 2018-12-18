<?php 
    ini_set('display_errors', 1);
    include('../../dbUtils/dbConnect.php');

    // get all non completed events
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

    echo json_encode($arrayOfDicts);

?>