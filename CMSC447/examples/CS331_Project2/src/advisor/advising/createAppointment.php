<?php

include("../utils/queries.php");


if ($_POST) {
    session_start();

    createAppointment(
        $_POST["location"], $_POST["meetingTime"],
        $_POST["meetingType"], $_SESSION["ADVISOR_ID"]
    );


    header("Location: advising.php");

} else {
    echo "This only accepts POST requests";
}