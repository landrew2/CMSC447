<?php

if ($_POST) {

    include("../utils/queries.php");

    error_log($_POST["meetingID"]);


    $students = getStudentInformation($_POST["meetingID"]);

    echo json_encode(
        array(
            "success" => 1,
            "result" => $students
        )
    );
}