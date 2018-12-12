<?php
session_start();

include('CommonMethods.php');
$debug = true;
$COMMON = new Common($debug);

if (empty($_POST['meeting'])) {
  header('Location: individual.php');
  exit;
} else {


  //This gets the whole value for the button the user chose
  $meetingID = ($_POST['meeting']);

  $_SESSION['time'] = $buttonT;

  $campusID = $_SESSION['id'];

  //adds the meeting to the student
  $sql = "UPDATE Student SET meetingID = '$meetingID' WHERE campusID ='$campusID'";
  $results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);

  //sees how many people are signed up for that meeting to decide whether or not it should be made unavailible
  $sql = "SELECT meetingID FROM Student WHERE meetingID = '$meetingID'";
  $results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);
  $numPeopleRegistered = mysql_num_rows($results);

  //makes the meeting unavailable
  if ($numPeopleRegistered == 1) {
    $sql = "UPDATE Meetings SET available = FALSE WHERE meetingID = '$meetingID'";
    $results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);
  }

  $_SESSION['hasAppointment'] = true;
  $_SESSION['meetingID'] = $meetingID;

  header('location:viewAppt.php'); //confirmation page
  exit;
}
?>