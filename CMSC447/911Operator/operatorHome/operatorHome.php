<?php
ini_set('display_errors', 1);

session_start(); 

include '../../dbUtils/queries.php';

$allEvents = getEvents();
$civilianEvents = getCivilianCreatedEvents();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../../Libraries/popper.min.js"></script>
    <script src="../../Libraries/jquery-3.3.1.js"></script>
    <title>Emergency</title>

    <a href="../../createEvent/createEvent.php">Create event</a>
</head>
<body>
    <div class = "row">
        <div class = "col-6" style="border:solid">
            <h3>All Emergencies</h3>
            <ul class="list-group">
            <?php
            foreach($allEvents as $event){
                echo "
                    <li class ='list-group-item' id ='allEvent" . $event['event_id']. "'>
                        <form action ='deleteEvent.php?eventID=". $event['event_id']. "' method = 'POST'>
                            <input type='number' name='eventID' value='". $event['event_id']. " ' >
                            <div class = 'row'>
                                <div class = 'col-4'>
                                    <h4>Priority: " .  $event['priority']. " Status: " . $event['status'] . " </h4>
                                    <p>Name: " . $event['name'] . " Phone: " . $event['phone'] . " Email: ". $event['email'] ."</p>
                                    <p>Address: " . $event['location'] . "</p>
                                    <p>Description: " . $event['description'] . "</p> 
                                </div>
                                <div class='col-2'>
                                    <button class='btn btn-danger' type = 'submit'> Delete Event </button>
                                </div>
                            </div>
                        </form>
                    </li>
                "; 
            }
            ?>
            </ul>
        </div>
        <div class = "col-6" style="border:solid">  
            <h3>Pending Events</h3>
            <ul class="list-group">
            <?php
            foreach($civilianEvents as $event){
                echo $event['event_id'];
                echo "
                    <li class ='list-group-item' id ='allEvent" . $event['event_id']. "'>
                        <form action='updateEvent.php?eventID=". $event['event_id']. "' method='POST'> 
                            <h4>Priority: 
                                    <select name='priority'>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                Status: 
                                    <select name='status'>
                                        <option value='0'>Pending</option>
                                        <option value='1'>In Progress</option>
                                        <option value='2'>Complete</option>
                                    </select>
                            </h4>
                                <p>Name: " . $event['name'] . " Phone: " . $event['phone'] . " Email: ". $event['email'] ."</p>
                                <p>Address: " . $event['location'] . "</p>
                                <p>Description: " . $event['description'] . "</p> 
                                <button type='submit' class='btn btn-success'>Update Event</button>
                        </form> 
                    </li>
                ";     
            }
            ?>
            </ul>
        </div>
    </div>

    <link rel="stylesheet" href="../../Libraries/bootstrap-4.1.3-dist/css/bootstrap.min.css">
    <script src="../../Libraries/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
</body>