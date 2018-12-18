<?php 

    ini_set('display_errors', 1);
    
    session_start(); 
    
    include '../../dbUtils/queries.php';
    
    $eventID = $_GET['eventID'];
    echo "Potato";
    deleteEvent($eventID);
    

    header('Location: operatorHome.php');