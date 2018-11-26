<?php

include('dbconfig.php');

// TODO: Use PHP Prepared statements to protect from SQL injections


function checkIfEmailExists($email)
{
    $open_con = connectToDB();

    $checkEmail = "SELECT 1 from `Advisor` WHERE `email` = '$email' LIMIT 1";

    $results = $open_con->query($checkEmail);
    $open_con->close();

    if (mysqli_num_rows($results) == 0) {
        return false;
    } else {
        return true;
    }
}

// Creates an advisor, does no error checking and assumes there will be no error.

function createAdvisor($email, $password, $fName, $lName, $bldgName, $roomNumber)
{
    $open_con = connectToDB();

    $salt = uniqid(rand(), true);
    $saltedAndHashed = crypt($password, $salt);

    $createAnAdvisor = "
        INSERT INTO `Advisor` (
            email, salt, password, fName, lName, bldgName, roomNum
        )
        VALUES (
            '$email', '$salt', '$saltedAndHashed', '$fName','$lName', '$bldgName', '$roomNumber'
        )
    ";

    $result = $open_con->query($createAnAdvisor);

    error_log($open_con->error);

    $open_con->close();
}

function checkIfPasswordIsCorrect($email, $password)
{
    $open_con = connectToDB();

    $obtainSaltAndPassWithEmail = "
      SELECT salt,password FROM Advisor WHERE email = '$email'
    ";

    $result = $open_con->query($obtainSaltAndPassWithEmail);

    // for Debugging
    error_log($open_con->error);

    $open_con->close();

    $result = $result->fetch_array();

    $salt = $result[0];
    $hash = $result[1];

    $obtainedHash = crypt($password, $salt);

    error_Log($hash);
    error_log($obtainedHash);


    if ($obtainedHash == $hash) {
        return true;
    } else {
        return false;
    }
}


function getAdvisorInformation($email)
{
    $open_con = connectToDB();
    $searchAdvisor = "SELECT * FROM Advisor WHERE email='$email'";

    $result = $open_con->query($searchAdvisor);

    return mysqli_fetch_assoc($result);
}

function getAdvisorMeetings($advisorID)
{
    $open_con = connectToDB();
    $searchAdvisorsMeetings = "
      SELECT * FROM `Meetings` WHERE advisorID = '$advisorID'
    ";

    $result = $open_con->query($searchAdvisorsMeetings);

    $arrayOfDicts = array();

    while ($row = $result->fetch_assoc()) {
        array_push($arrayOfDicts, $row);
    }

    return $arrayOfDicts;
}

// isGroup -> a string that is either "individual" or "group"
function createAppointment($location, $datetime, $meetingType, $advisorID)
{
    $open_con = connectToDB();

    $meetingType = ($meetingType == "individual" ? 0 : 1);

    $createAppointment = "
        INSERT INTO Meetings(dateTime, groupMeeting, available, location, advisorID)
        VALUES ('$datetime', '$meetingType', true, '$location', '$advisorID')
    ";

    $open_con->query($createAppointment);

    if (mysqli_error($open_con)) {
        error_log(mysqli_error($open_con));
    }

    $open_con->close();
}

// Deletes meeting from table handling student and meeting side
function cancelAppointment($meetingID)
{
    $open_con = connectToDB();

    // sets students to no longer having a meeting
    $setStudentsToNoMeeting = "
        UPDATE Student
        SET meetingID = -1
        WHERE meetingID = '$meetingID'
    ";
    $open_con->query($setStudentsToNoMeeting);

    // deletes appointment from table
    $delAppointment = "
        DELETE FROM Meetings WHERE meetingID = '$meetingID'
    ";
    $open_con->query($delAppointment);
}

function getStudentInformation($meetingID)
{
    $open_con = connectToDB();

    $getStudentInfo = "
      SELECT 
        Student.fName, Student.lName, Student.email,
        Meetings.dateTime, Meetings.location, Student.campusID
      FROM Meetings
      INNER JOIN Student
      ON Meetings.meetingID = Student.meetingID
      WHERE Meetings.meetingID= '$meetingID'
    ";

    $result = $open_con->query($getStudentInfo);

    $students = array();

    while ($student = $result->fetch_assoc()) {
        array_push($students, $student);
    }

    return $students;
}

function sendEmailToStudent($email, $subject, $message)
{
    $url = 'https://api.sendgrid.com/';
    $user = 'jaime5';
    $pass = 'feelsbadman1';

    $json_string = array(

        'to' => array(
            "jaime.orellana789@gmail.com"
        ),
        'category' => 'test_category'
    );

    $params = array(
        'api_user' => $user,
        'api_key' => $pass,
        'x-smtpapi' => json_encode($json_string),
        'to' => 'example3@sendgrid.com',
        'subject' => 'testing from curl',
        'html' => 'testing bodghchg y',
        'text' => 'testing body',
        'from' => 'example@sendgrid.com',
    );


    $request = $url . 'api/mail.send.json';

    // Generate curl request
    $session = curl_init($request);
    // Tell curl to use HTTP POST
    curl_setopt($session, CURLOPT_POST, true);
    // Tell curl that this is the body of the POST
    curl_setopt($session, CURLOPT_POSTFIELDS, $params);
    // Tell curl not to return headers, but do return the response
    curl_setopt($session, CURLOPT_HEADER, false);
    // Tell PHP not to use SSLv3 (instead opting for TLS)
    curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

    // obtain response
    $response = curl_exec($session);
    curl_close($session);
}

function updateAdvisor($currentEmail, $email, $password, $fName, $lName, $bldgName, $roomNumber)
{

    error_log($email);

    $open_con = connectToDB();

    $salt = uniqid(rand(), true);
    $saltedAndHashed = crypt($password, $salt);

    $updateAdvisor = "
        UPDATE Advisor
        SET email = '$email',
            salt = '$salt',
            password = '$saltedAndHashed',
            fName = '$fName', 
            lName = '$lName', 
            bldgName = '$bldgName', 
            roomNum = '$roomNumber'
        WHERE email = '$currentEmail'
    ";


    $open_con->query($updateAdvisor);

    error_log(mysqli_error($open_con));

    $open_con->close();
}


function checkIfSiteIsOnline()
{
    $open_con = connectToDB();

    $checkQuery = "SELECT siteOnline from Shut_Off_Control";

    $results = $open_con->query($checkQuery);
    $results = $results->fetch_assoc();

    return $results["siteOnline"];
}


function switchSite()
{
    $open_con = connectToDB();

    $state = checkIfSiteIsOnline();

    if ($state == 1) {
        $state = 0;
    } else {
        $state = 1;
    }

    $flipQuery = "
        UPDATE Shut_Off_Control
        SET siteOnline = $state
    ";

    $open_con->query($flipQuery);
}