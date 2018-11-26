<?php 

include('dbConnect.php')


//gerneral format for set queries
function addEvent(/*query params*/){

	//initializes connection
	$connection = ConnectToDatabase();

	$queryString = "stuff";

	//actually runs the query
	$connection->query($queryString);

	//close the db connection
	$connection->close();
}

function getEvent(/*query params*/){
	//initialize connection
	$connection = ConnectToDatabase();

	$queryString = "stuff";

	//run the query
	$result = $connection->query($queryString);

	//close the db connection
	$connection->close();

	//turn the output 
	return mysqli_fetch_assoc($result);

}

 ?>