<?php
    session_start(); 
    ini_set('display_errors', 1);
    include '../dbUtils/queries.php';


    //validate password 

    $loginID = $_POST['911OperatorLogin'];

    if (operatorLogin($loginID)){
        echo "correct";
        $_SESSION['operator'] = true;
         header("Location: ../911Operator/operatorHome/operatorHome.php");
    }
    else{
        header("Location: createEvent.php");
    }
