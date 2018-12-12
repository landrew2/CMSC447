<?php
function connectToDB()
{
    $servername = "studentdb-maria.gl.umbc.edu";
    $username = "ricke1";
    $password = "feelsbadman";
    $dbName = "ricke1";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // So the database name is the same as the username. wierd
    if (!mysqli_select_db($conn, $dbName)) {
        die("Uh oh, couldn't select database $dbName");
    }

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {

        // Connected successfully
        return $conn;
    }

}