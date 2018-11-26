<?php


include('CommonMethods.php');

$debug = false;

$COMMON = new Common($debug);


//checks if the site is active
$sql = "SELECT * FROM Shut_Off_Control";
$results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);

$offOnArray = mysql_fetch_assoc($results);

if (!$offOnArray['siteOnline']) {
    header('Location: offline.html');
    exit;
} else {

    session_start();

//add HTML form data to session variables so they can be placed in editStudentInformation.php
    $_SESSION['fName'] = $_POST['tfFName'];

    $_SESSION['lName'] = $_POST['tfLName'];

    $_SESSION['id'] = $_POST['tfID'];

    $_SESSION['email'] = $_POST['tfEmail'];

    $_SESSION['major'] = $_POST['ddMajor'];

    $_SESSION['loggedIn'] = true;

//creates a new user
    $firstName = $_SESSION['fName'];

    $lastName = $_SESSION['lName'];

    $campusID = $_SESSION['id'];

    $major = $_SESSION['major'];

    $email = $_SESSION['email'];

// checks if the student exists
    $sql = "SELECT campusID FROM Student WHERE campusID = '$campusID'";

    $results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);

//POSSIBLE ISSUE TEST THOURGHLY
//if student doesnt exists, new student is added student_table
    if (mysql_num_rows($results) == 0) {

        $sql = "INSERT INTO Student(fName,lName,campusID,major,email,meetingID) VALUES('$firstName','$lastName','$campusID','$major','$email',-1) ";

        $results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);

        $_SESSION['hasAppointment'] = false;

        // transports the user to the otherMajor.html page if the major selected is 'Other'
        if ($major == "Other") {
            //creates session variable for the free responses, wont't get a chance otherwise
            $_SESSION['questionsConcerns'] = "";
            $_SESSION['postUMBC'] = "";
            header('Location:otherMajor.html');
            exit;
        }

        header('Location:freeResponse.php');
        exit;

    } //if student id already exists redirect ot reg error page
    else {
        header('Location:registration_error.html');
        exit;
    }
}
?>

 