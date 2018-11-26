<html>
<head>
  <metacharset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Confirmation</title>
  <link rel="stylesheet" href="../static/css/student.css" type="text/css"/>
  <link rel="icon" type="image/x-icon" href="../static/img/umbc.png"/>

</head>
<body>

<?php
session_start();

include('CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

echo "<div class='form'>";
echo "<h1>Your Appointment</h1>";
echo "<br>";

$meetingID = $_SESSION['meetingID'];
//The values we need that were set in either group or individual


//finds the name of the adviser or group
$sql = "SELECT advisorID, groupMeeting,location FROM Meetings WHERE meetingID = '$meetingID'";
$results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);

$meetingRows = mysql_fetch_assoc($results);

//finds the time
$sql = "SELECT dateTime FROM Meetings WHERE meetingID = '$meetingID'";
$results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);

$value = mysql_fetch_assoc($results);
$theTime = strtotime($value['dateTime']);
$myTime = date("m/d/y g:i A", $theTime);

echo'<div class="field">';
//Display information about the appointment
echo "Your appointment is at " . $myTime . "<br>";

$advisorID = $meetingRows['advisorID'];
if ($meetingRows['groupMeeting']) {
  echo "Advisor: Group<br>";
} else {
  $sql = "SELECT fName,lName,email FROM Advisor WHERE advisorID = '$advisorID'";
  $results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);
  $advisorStats = mysql_fetch_assoc($results);
  $fname = $advisorStats['fName'];
  $lname = $advisorStats['lName'];
  $email = $advisorStats['email'];
  echo"Advisor: " . $fname. " ".$lname."<br>";
  echo"Email: ". $email."<br>";

}

echo "Location: " . $meetingRows['location'] . "<br>";

echo'</div>';
//When they hit the confirm button, send them to the menu
echo "<form action='menu.php' method='post' name='menu'>";
echo "<br>";
echo'<div class="nextButton">';
echo "<input type='submit' value='OK' name='button' class='large selection button'>";
echo "</div>";
echo "</form>";

echo "</div>";
