<?php
session_start();
// redirect user if not logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
    header("Location: index.html");
}

include('CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);
$meetingID = $_SESSION['meetingID'];
echo "$meetingID";
if (!empty($_POST)) {

    if ($_POST['choice'] == 'Yes') {
        //get the student's campus ID
        $campusID = $_SESSION['id'];
        $meetingID = $_SESSION['meetingID'];
        //sets the meeting the student is attached to to -1 which signifies no meeting
        $sql = " UPDATE Student SET meetingID = -1 WHERE campusID='$campusID'";
        $results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);


        //changes the availability of the meeting if necessary
        $sql = "SELECT * FROM Meetings WHERE meetingID = '$meetingID' ";
        $results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);


        $resultsRow = mysql_fetch_assoc($results);
        $sql = "UPDATE Meetings SET available = TRUE WHERE meetingID = '$meetingID'";
        $results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);

        $_SESSION['hasAppointment'] = false;
        $_SESSION['meetingID'] = -1;
    }
    header('Location: menu.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advising Scheduling</title>
    <link rel="icon" type="image/x-icon" href="umbc.png"/>
    <link rel="stylesheet" type="text/css" href="../static/css/student.css"/>
    <title>Cancel Appointment</title>
</head>

<body>
<div class="form">
    <h2>Are you sure you want to cancel your appointment?</h2>
    <div class='nextButton'>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method='post'>
        <span style='display:inline'>
        <input type='submit' class='large selection button' name='choice' value='Yes'>
  
        <input type='submit' class='large selection button' name='choice' value='No'>
        </span>
        </form>
    </div>
</div>

</body>
</html>