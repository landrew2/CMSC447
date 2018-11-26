<?php
session_start();

$fName = $_SESSION["fName"];


// redirect user if not logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
    header("Location: index.html");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1">

    <title>Advising Scheduling</title>

    <link rel="icon" type="image/x-icon" href="../static/img/umbc.png"/>
    <link rel="stylesheet" type="text/css" href="../static/css/student.css"/>

</head>


<div class="form">
    <h2>Hello <?php echo $fName ?>!</h2>
    <form action="processMenu.php" method="post" name="menu">

        <?php

        if (!isset($_SESSION['hasAppointment'])) {
            echo('Oops! Something went wrong');
            header('index.html');
        }

        // if student has an appointment, show options to view, cancel, or reschedule
        if (($_SESSION['hasAppointment'])) {
	  echo '<div class="nextButton">';
            echo "<button type='menu' name='view' class='button large selection' value='view'>View my appointment</button><br>";


            echo "<button type='menu' name='cancel' class='button large selection' value='cancel'>Cancel my appointment</button><br>";
	    echo'</div>';
	    
        } // otherwise show option to sign up for an appointment
        else {
	  echo '<div class="nextButton">';
            echo "<button type='menu' name='signUp' class='button large selection' value='view'>Sign up for an appointment</button>
<br>";
	    echo '</div>';
	    
        }
        ?>
    
    <div class="nextButton">    
    <button type='menu' name='edit' class='button large selection' value='edit'>Edit student information</button>
    </form>
	  </div>
<br>
    <div class="nextButton">
        
    <form action="logout.php"><input type='submit' value="Logout" class='button large selection'>

    </div>

</div>

</html>
