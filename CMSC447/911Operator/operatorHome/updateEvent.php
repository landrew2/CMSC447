<?php
ini_set('display_errors', 1);

session_start(); 

include '../../dbUtils/queries.php';

$eventID = $_GET['eventID'];        
$status = $_POST['status'];
$priority = $_POST['priority'];
echo "Potato";
updateEvent($eventID,$status,$priority);

header('Location: operatorHome.php');