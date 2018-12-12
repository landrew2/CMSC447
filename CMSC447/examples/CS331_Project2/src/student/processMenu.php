<?php


session_start();

if(isset($_POST['reschedule'])) {
  $_SESSION['reschedule'] = true;
  header('Location: cancelPage.php');
} 

else if(isset($_POST['cancel'])) {
  header('Location: cancelPage.php');
} 

// edit info and return to menu.php
else if(isset($_POST['edit'])) {
  $_SESSION['returnToMenu'] = true;
  header('Location: editStudentInformation.php');
} 

else if(!($_SESSION['hasAppointment'])){
  header('Location: appointmentPage.php');
}
else { // is view schedule
  header('Location: viewAppt.php');
}


?>