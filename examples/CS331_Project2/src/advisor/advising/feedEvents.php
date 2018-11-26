<?php

session_start();
date_default_timezone_set("EST");

include('../utils/queries.php');

function printAssociativeArray($array)
{
    foreach ($array as $key => $value) {
        error_log("Key: $key; Value: $value\n");
    }
}

function changeAdvisorMeetingArrayFormat($meetings)
{
    $formattedMeetings = array();

    foreach ($meetings as $meeting) {

        $groupType = "Individual Meeting";

        if ($meeting["groupMeeting"] == 1) {
            $groupType = "Group Meeting";
        }

        $title = $groupType . " " . $meeting["location"];

        $start = strtotime($meeting["dateTime"]) . '000';
        $end = (strtotime($meeting["dateTime"]) + 1800) . '000';

        $students = getStudentInformation($meeting["meetingID"]);

        $formattedMeeting = array(
            'id' => $meeting["meetingID"],
            'title' => $title,
            'start' => $start,
            'end' => $end,
            'type' => $groupType,
            'location' => $meeting["location"],
            'students' => $students
        );

        array_push($formattedMeetings, $formattedMeeting);
    }
    return $formattedMeetings;
}

$start = $_REQUEST['from'] / 1000;
$end = $_REQUEST['to'] / 1000;

$meetings = getAdvisorMeetings($_SESSION["ADVISOR_ID"]);

$formattedMeetings = changeAdvisorMeetingArrayFormat($meetings);

echo json_encode(
    array(
        "success" => 1,
        "result" => $formattedMeetings
    )
);