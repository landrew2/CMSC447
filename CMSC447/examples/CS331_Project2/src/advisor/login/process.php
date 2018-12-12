<?php

include '../utils/queries.php';

if ($_POST) {
    // Checks to see if given password is valid
    if (checkIfPasswordIsCorrect($_POST["email"], $_POST["password"])) {

        session_start();

        $_SESSION["ADVISOR_LOGGED_IN"] = true;
        $_SESSION["ADVISOR_EMAIL"] = $_POST["email"];

        // Query and store all variables for user in the current session
        $advisorDict = getAdvisorInformation($_SESSION["ADVISOR_EMAIL"]);

        $_SESSION["ADVISOR_ID"] = $advisorDict["advisorID"];
        $_SESSION["ADVISOR_FIRST_NAME"] = $advisorDict["fName"];
        $_SESSION["ADVISOR_LAST_NAME"] = $advisorDict["lName"];
        $_SESSION["ADVISOR_BLDG_NAME"] = $advisorDict["bldgName"];
        $_SESSION["ADVISOR_ROOM_NUM"] = $advisorDict["roomNum"];

        header("Location: ../advising/advising.php");

    } else {
        $error_msg = "Email and password combination is incorrect";

        header("Location: login.php?error_msg=" . urlencode($error_msg));
    }
}