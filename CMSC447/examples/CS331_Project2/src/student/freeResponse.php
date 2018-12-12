<?php

session_start();


include('CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

if($_POST){
  
  $campusID = $_SESSION['id'];
  
  $postUMBC  = $_POST['postUMBC'];

  $questionsConcerns = $_POST['questionsConcerns'];

  $sql = "UPDATE Student SET postUMBC = '$postUMBC', questionsConcerns = '$questionsConcerns' WHERE campusID = '$campusID'" ;

  $results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);

  $_SESSION['postUMBC'] = $postUMBC;

  $_SESSION['questionsConcerns'] = $questionsConcerns;

  header('Location:menu.php');
  
}

?>

<html>
<head>

  <meta charset="UTF-8"/>
  <meta name ="viewport" content="width=device-width, initial-scale=1.0">

  <title>Pre-Registration Questions</title>


    <link rel="icon" type="image/x-icon" href="../static/img/umbc.png"/>
    <link rel="stylesheet" type="text/css" href="../static/css/student.css"/>

<div class="form">
<h1>Please complete the form(s).</h1>
</head>
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<p>

<div class="field">
  <h3>What are your current post-UMBC plans?*</h3><p> 

<textarea rows="4" cols="33" input type="text" name="postUMBC" placeholder ="For example: Medical School, Teach middle school science, Research career, Master's/PhD, etc..." maxlength = 208 required>
</textarea>
</div>

<div class="field">
  <p><h3>Do you have any questions or concerns that you would like to discuss during your advising session?  </h3><p>

<textarea rows="4" cols="33" input type="text" name="questionsConcerns" placeholder ="For example: Withdrawing from course, adding a second major, etc..." maxlength = 208>
</textarea>  
</div>

<div class="nextButton">
<label><input type="submit" class="large selection button"></label>
</div>
</form>
</div>
</html>
