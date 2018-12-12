<?php
session_start();
// redirect user if not logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
    header("Location: index.html");
}


?>

<html>
<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Advising Scheduling</title>
    
    <link rel="icon" type="image/x-icon" href="../static/img/umbc.png"/>
    <link rel="stylesheet" type="text/css" href="../static/css/student.css"/>
    
    <title>Appointment</title>
    <link rel="stylesheet" href="../static/student.css" type="text/css"/>

</head>

<body>
<div class="form">
<h1>Appointment Page</h1>
  
    <h3>Choose an appointment type:</h3>
    
  <div class="buttonGroup">
    
    <div class="field">
    <form action="group1.php">
        <input type="submit" class="group" style="" title="Group" value="Group">
    </form>
    </div>

    <div class="field">
    <form action="individual.php" >
        <input type="submit" class="indiv" title="Individual" value="Individual">
    </form>
    </div>
  
  </div>

</div>
</body>
</html>
