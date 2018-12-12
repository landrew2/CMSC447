<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>Individual Appointment</title>

    <link rel="stylesheet" href="../static/css/student.css" type="text/css"/>
    <link rel="icon" type="image/x-icon" href="../static/img/umbc.png"/>


</head>
<body>

<?php
   session_start();

include('CommonMethods.php');
$debug = true;
$COMMON = new Common($debug);


echo '<div class="form">';

echo '<h1>Choose an individual appointment</h1>';
$sql = "SELECT * FROM Advisor 
            INNER JOIN Meetings 
            ON Meetings.advisorID = Advisor.advisorID 
            WHERE groupMeeting = FALSE AND dateTime>NOW() AND available = TRUE";

if (!empty($_POST['dateSubmit'])) {
  //adjusts the sql so it only shows that particular day

  $appointmentDate = $_POST['appointmentDate'];
  $sql .= " AND DATE(dateTime) = '$appointmentDate'";

  //adjusts the sql so it only shows that specific advisor
} elseif (!empty($_POST['advisorSubmit'])) {
  $advisorID = $_POST['theAdvisorChoice'];
  $sql .= " AND Meetings.advisorID = '$advisorID'";


} elseif (!empty($_POST['reset'])) {
  //resets the posts
  unset($_POST['dateSubmit']);
  unset($_POST['advisorSubmit']);
  unset($_POST['theAdvisorChoice']);
  unset($_POST['reset']);

}


$results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);

if (mysql_num_rows($results) == 0 && empty($_POST['dateSubmit']) && empty($_POST['advisorSubmit'])) {
  echo "<h1>No individual meetings currently available. Please check back later.</h1>";
} else {
  //resets the posts
  unset($_POST['dateSubmit']);
  unset($_POST['advisorSubmit']);


  echo "<div class='groupBullet'>";

  //creates a date search box
    //fixable with more dev time
 /*
 echo '<div class="field">';
  echo "<p>Narrow down your search by selecting a day:</p>";
  echo "<form name='theDate' method = 'post' >";
  echo "<input type = 'date' name = 'appointmentDate'>";
  echo "<input type = 'submit' name='dateSubmit'  class = 'search' style='margin-left:5px; margin-top:-2px' title='Search'>";
  echo "</form>";
  echo '</div>';
  echo "<br>";
    */

  //finds all the advisors that have valid individual app
    $advisorSql = "SELECT * FROM Advisor 
            INNER JOIN Meetings 
            ON Meetings.advisorID = Advisor.advisorID 
            WHERE groupMeeting = FALSE AND dateTime>NOW() AND available = TRUE
            GROUP BY Meetings.advisorID";

    $advisorResults12 = $COMMON->executeQuery($advisorSql, $_SERVER['PHP_SELF']);
    echo '<div class="field">';
    echo "<p>Narrow down your search by selecting an advisor:</p>";
    echo "<form name='theAdvisor' method = 'post'  >";
    echo "<select name='theAdvisorChoice'>";

    //Makes a drop down with all the advisor names
    while ($advisorDict = mysql_fetch_assoc($advisorResults12)) {
      $advisorID = $advisorDict['advisorID'];
      $lName = $advisorDict['lName'];
      $fName = $advisorDict['fName'];
      $name = $advisorDict['fName'] . " " . $advisorDict['lName'];

      echo "<option value='$advisorID'>";
      echo "$name";
      echo "</option>";

    }
    echo "</select>";
    echo "<input type='submit' class='large selection button' name='advisorSubmit'>";
    echo "</form>";
    echo '</div>';

    //resets previous search
    echo '<div class="field">';
    echo "<p>Reset your previous search</p>";
    echo "<form name='theReset' method = 'post'  >";
    echo "<input type = 'submit' name='reset' value='Reset' class='large selection button'>";
    echo "</form>";
    echo '</div>';

    echo "<hr>";


    echo "<form action='indiv.php' method='post' name='meetingChoice'>";

    echo '<div class="radio-toolbar">';

    while ($appointmentDict = mysql_fetch_assoc($results)) {
      $meetingID = $appointmentDict['meetingID'];
      $theTime = $appointmentDict['dateTime'];
      $theRoom = $appointmentDict['location'];
      $fName = $appointmentDict['fName'];
      $lName = $appointmentDict['lName'];
      $timeAndPlace = myDate($theTime) . " " . $theRoom . " " . $fName . " " . $lName;

      echo "<input type ='radio' name='meeting' value='$meetingID' id='$timeAndPlace' required><label for ='$timeAndPlace'>$timeAndPlace<br></label>";
    }
    echo "<br>";

    echo "<br>";

    echo '<div class="nextButton">';

    echo "<input type='submit' value='Confirm' class='large selection button'>";

    echo '</div>';

    echo "</form>";

    echo "</div>";

    echo "</div>";


}
echo '<div class="nextButton">';

echo '<form action = "menu.php" >';

echo '<input type = "submit" value = "" class="home" class="large selection button" title="Main Menu">';

echo '</form >';

echo '</div>';

//This function takes the whole value string containing time and date and formats the date to be "MM/DD"                    
function myDate($value)
{
  $time = strtotime($value);
  $myFormatForView = date("m/d/y g:i A", $time);
  return $myFormatForView;
}


?>