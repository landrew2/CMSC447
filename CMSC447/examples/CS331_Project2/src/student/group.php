<?php
session_start();


include('CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

if (empty($_POST['meeting'])) {
  header('Location: group1.php');
  exit;
} else {


  $meetingID = ($_POST['meeting']);

  //echo  $meetingID;

  $campusID = $_SESSION['id'];
  //adds the meeting to the student
  $sql = "UPDATE Student SET meetingID = '$meetingID' WHERE campusID ='$campusID'";
  $results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);

  //sees how many people are signed up for that meeting to decide whether or not it should be made unavailible
  $sql = "SELECT meetingID FROM Student WHERE meetingID = '$meetingID'";
  $results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);
  $numPeopleRegistered = mysql_num_rows($results);

  //makes the meeting unavailable
  if ($numPeopleRegistered == 40) {
    $sql = "UPDATE Meetings SET available = FALSE WHERE meetingID = '$meetingID'";
    $results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);
  }


  $_SESSION['hasAppointment'] = true;
  $_SESSION['meetingID'] = $meetingID;
  header('location:viewAppt.php');
  exit;
}
?>