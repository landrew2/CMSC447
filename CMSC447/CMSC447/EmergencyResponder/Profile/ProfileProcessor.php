<?php

if ($_POST) {

$profile = $_POST['fname'] . " " .$_POST['lname'] . " " .$_POST['location'] 
. ", " . $_POST['fire'] . ", " . $_POST['crime'] . ", " . $_POST['water']
 . ", " . $_POST['general situation'];

addProfile($_POST['fname'], $fullStreetAddress,$_POST['emergencyType'],$_POST['description'],$_POST['email'], $_POST['phone'],$priority);
}