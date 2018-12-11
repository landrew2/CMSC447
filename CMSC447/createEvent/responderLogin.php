<?php
    session_start();
    ini_set('display_errors', 1);
    include '../dbUtils/queries.php';


    //validate password 

    $loginID = $_POST['emergencyResponderLogin'];

    if (responderLogin($loginID)){
        echo "correct"; 
        $_SESSION['responder'] =true;
    }
    else{
        header("Location: createEvent.php");
    }
