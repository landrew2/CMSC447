<?php

include '../utils/queries.php';

// Assume right now that emails match, lets hash and put into databas
if ($_POST["tfPassword1"] == $_POST["tfPassword2"]) {
    if (!checkIfEmailExists($_POST["tfEmail"])) {
        createAdvisor(
            $_POST["tfEmail"], $_POST["tfPassword1"],
            $_POST["tfFName"], $_POST["tfLName"],
            $_POST["tfBldgName"], $_POST["tfRoomNumber"]
        );
        header("Location: ../login/login.php");

    } else {
        $error_msg = "Email is not unique";
        header("Location: registration.php?error_msg=" . urlencode($error_msg));
    }
} else {
    $error_msg = "Passwords do not match";
    header("Location: registration.php?error_msg=" . urlencode($error_msg));

}