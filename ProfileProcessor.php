<?php

if(isset($_POST['submit'])){
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$location = $_POST['location'];


echo "First Name: ". $fname;  
echo "<br>";
echo "Last Name: ". $lname;
echo "<br>";
echo "Location: ". $location;
}