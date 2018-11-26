<html>
<head>
    <metacharset
    ="UTF8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Group Appointment</title>

    <link rel="stylesheet" href="../static/css/student.css" type="text/css"/>
    <link rel="icon" type="image/x-icon" href="../static/img/umbc.png"/>

</head>
</html>

<body>

<?php
   include('CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

$sql = "SELECT * FROM Meetings WHERE available = TRUE AND dateTime>NOW() AND groupMeeting = TRUE ";

if (!empty($_POST['dateSubmit'])) {
  //adjusts the sql so it only shows that particular day

  $appointmentDate = $_POST['appointmentDate'];
  $sql .= " AND DATE(dateTime) = '$appointmentDate'";

  //adjusts the sql so it only shows that specific advisor

} elseif (!empty($_POST['reset'])) {
  //resets the posts
  unset($_POST['dateSubmit']);
  unset($_POST['reset']);
}

$results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);

  echo "<div class='form'>";
//displays the meetings if there are any, if there aren't lets you go back
if (mysql_num_rows($results) == 0 && empty($_POST['dateSubmit'])) {
  echo "<h1>No group meetings currently available. Please check back later.</h1>";
} else {

  echo "<h1>Choose a time</h1><br>";

  //creates a date search box
  echo '<div class="field">';
  echo "<p>Narrow down your search by selecting a day:</p>";
  echo "<form name='theDate' method = 'post' >";
  echo "<input type = 'date' name = 'appointmentDate'>";
  echo "<input type = 'submit' value='Search' style='margin-left: 5px;margin-top:-2px' name='dateSubmit' class='large selection button'>";
  echo "</form>";
  echo '</div>';
  //resets previous search
  echo '<div class="field">';
  echo "<p>Reset your previous search</p>";
  echo "<form name='theReset' method = 'post'  >";
  echo "<input type = 'submit' name='reset' value='Reset' class='large selection button'>";
  echo "</form>";
  echo '</div>';


  echo "<div class='groupBullet'>";

  echo "<form action='group.php' method='post' name='meetingChoice'>";

  echo "<hr>";

  echo '<div class="radio-toolbar">';
  while ($row = mysql_fetch_assoc($results)) {

    //prints all the availible meetings in the form of radio buttons
    $meetingID = $row['meetingID'];
    $theTime = $row['dateTime'];
    $theRoom = $row['location'];
    $timeAndPlace = myDate($theTime) . " " . $theRoom;


    echo "<input type='radio' name='meeting' value='$meetingID' id ='$timeAndPlace' required><label for='$timeAndPlace'>$timeAndPlace<br></label>";


  }
  echo '</div>';

  echo '</div>';

  echo '<div class="nextButton">';

  echo '<input type="submit" class="large selection button">';

  echo '</div>';

  echo "</form>";

  echo "<br>";




}
echo '<div class="nextButton">';

echo '<form action = "menu.php" >';

echo '<input type = "submit" value = "" class="home" >';

echo '</div>';

echo '</form >';

echo "</div>";
echo "</div>";
//This function takes the whole value string containing time and date and formats the date to be "MM/DD"                    
function myDate($value)
{
  $time = strtotime($value);
  $myFormatForView = date("m/d/y g:i A", $time);

  return $myFormatForView;
}


?>
