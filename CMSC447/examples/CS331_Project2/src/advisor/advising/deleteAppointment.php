<?php

if ($_POST) {
    session_start();

    include('../utils/queries.php');

    error_log($_POST["meetingID"]);

    $students = getStudentInformation($_POST["meetingID"]);

    cancelAppointment($_POST["meetingID"]);


    $subject = "Advisor Meeting Cancelled";
    $message = "Unfortunately your meeting was cancelled.";

    foreach ($students as $student) {
        sendEmailToStudent(
            $student["email"], $subject, $message
        );
    }

    header("Location: advising.php");
} else {
    echo "Only accepts POST requests";
}