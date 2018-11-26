<?php

// TODO: Check if the email is unique and give error if not


if ($_POST) {


    session_start();
    include("../utils/queries.php");

    if (!checkIfEmailExists($_POST["tfEmail"])) {
        if (checkIfPasswordIsCorrect($_SESSION["ADVISOR_EMAIL"], $_POST["oldPassword"])) {

            if ($_POST["tfPassword1"] == $_POST["tfPassword2"]) {

                updateAdvisor(
                    $_SESSION["ADVISOR_EMAIL"],
                    $_POST["tfEmail"], $_POST["tfPassword1"],
                    $_POST["tfFName"], $_POST["tfLName"],
                    $_POST["tfBldgName"], $_POST["tfRoomNumber"]
                );

                $_SESSION["ADVISOR_EMAIL"] = $_POST["tfEmail"];
                $_SESSION["ADVISOR_FIRST_NAME"] = $_POST["tfFName"];
                $_SESSION["ADVISOR_LAST_NAME"] = $_POST["tfLName"];
                $_SESSION["ADVISOR_BLDG_NAME"] = $_POST["tfBldgName"];
                $_SESSION["ADVISOR_ROOM_NUM"] = $_POST["tfRoomNumber"];

                header("Location: ../advising/advising.php");
            } else {

                $error_msg = "New password fields do not match!";
                header("Location: editProfile.php?error_msg=" . urlencode($error_msg));
            }


        } else {
            $error_msg = "Your password is incorrect!";
            header("Location: editProfile.php?error_msg=" . urlencode($error_msg));
        }
    } else {

        $error_msg = "The email chosen is already in use!";
        header("Location: editProfile.php?error_msg=" . urlencode($error_msg));
    }


}