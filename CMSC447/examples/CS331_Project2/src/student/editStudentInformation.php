<?php
session_start();
include('CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

// redirect user if not logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
    header("Location: studentLogin.html");
}

//define variables based on session
//used in html form
$fname = $_SESSION['fName'];
$lname = $_SESSION['lName'];
$campusID = $_SESSION['id'];
$major = $_SESSION['major'];
$email = $_SESSION['email'];
$postUMBC = $_SESSION['postUMBC'];
$questionsConcerns = $_SESSION['questionsConcerns'];

//once the submit button is pressed
if ($_POST) {
    //saves everything the adds it the session
    $fname = $_POST['tfFName'];
    $lname = $_POST['tfLName'];
    $major = $_POST['ddMajor'];
    $questionsConcerns = $_POST['questionsConcerns'];
    $postUMBC = $_POST['postUMBC'];

    //optional
    $campusID = $_POST['tfID']; //optional
    $email = $_POST['tfEmail']; //optional

    $_SESSION['fName'] = $fname;
    $_SESSION['lName'] = $lname;
    $_SESSION['major'] = $major;

    //optional
    $_SESSION['email'] = $email;//optional
    $_SESSION['id'] = $campusID;//optional
    $_SESSION['questionsConcerns'] = $questionsConcerns;
    $_SESSION['postUMBC'] = $postUMBC;

    $sql = "UPDATE Student SET fName = '$fname' ,lName = '$lname', major = '$major', postUMBC = '$postUMBC', questionsConcerns = '$questionsConcerns' WHERE campusID = '$campusID'";

    $results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);

    if($major == "Other"){
      header('Location:otherMajor.html');
      exit;
    }
    
    header('Location: menu.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale = 1">

    <title>General Information</title>

    <link rel="icon" type="image/x-icon" href="../static/img/umbc.png"/>
    <link rel="stylesheet" type="text/css" href="../static/css/student.css"/>
</head>

<body>

<div class="form">

 
    
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="EditProfile">

   <div class="field">
            
    <label for="tfFName">First Name</label><br>
    
    
        
     <input id="tfFName" type="search" size="30" maxlength="25" name="tfFName" value="<?php echo "$fname"; ?>" placeholder="Your First Name" required autofocus>
   </div>
        
   <div class="field">
   
   <br>
            
    <label for="tfLName">Last Name</label><br>

    
           
     <input id="tfLName" type="search" size="30" maxlength="25" name="tfLName" value="<?php echo "$lname"; ?>" placeholder ="Your Last Name" required>
   </div>
        
   <br>
        
   <div class="field">
            
    <label for="tfID">Student ID</label><br>
     
            
     <input id="tfID" type="search" size="30" maxlength="7" pattern="[A-Za-z]{2}[0-9]{5}" value="<?php echo "$campusID"; ?>" title="AB12345"
     placeholder="AB12345" name="tfID" required readonly>
   
   </div>
        
   <div class="field">

   <br>       
     
    <label for="tfEmail">Email</label><br>
 
    
      
     <input id="tfEmail" type="email" size="30" maxlength="25" pattern="^\w+@umbc\.edu" value="<?php echo "$email"; ?>" title="student1@umbc.edu"
     name="tfEmail" placeholder="student1@umbc.edu" required readonly>
   
   </div>

   <div class="field">
 
   <br>   

    <label for="ddMajor">Major</label><br>
            
      <?php
            $listOfMajors = array("Biochemistry & Molecular Biology [BS]", "Bioinformatics & Computational Biology [BS]", "Biological Sciences [BA]", "Biological Sciences [BS]", "Biology Education [BA]", "Chemistry [BA]", "Chemistry [BS]", "Chemistry Education [BA]", "Other");

            $default_major = $_SESSION['major'];
      ?>

       <select id="ddMajor" name="ddMajor" required  style="width: 290px !important; min-width: 290px; max-width: 290px;">


        <option value="<?php echo $default_major ?>"><?php echo "$default_major"; ?></option>

         <?php foreach ($listOfMajors as $major) { ?>
          <?php if ($major != $default_major) { ?>
           <option value="<?php echo $major; ?>"><?php echo $major; ?></option>
            <?php
             }
            ?>
             <?php
              }
             ?>
         </select>
    
  </div>

  <br>

  <div class="field"

  <h3>What are your current post-UMBC plans? (Required)</h3>

  <p>

    <textarea rows="4" cols="33" input type="text" name="postUMBC" maxlength=208 required><?php echo $postUMBC ?></textarea>

  </p>

  </div>

  <div class = "field">

  <h3>Do you have any questions or concerns that you would like to discuss during your advising session? (Optional)</h3>

   <textarea rows="4" cols="33" input type="text" name="questionsConcerns" placeholder="For example: Withdrawing from course, adding a second major, etc..." maxlength=208 value="<?php echo "$questionsConcerns" ?>"><?php echo $questionsConcerns ?></textarea>
   
  </div>



  <div class="nextButton">
      
   <input type="submit" value="Confirm" name="Sign In" class="large selection button">
     
  </div>

  </form>
 
  </div>

 </body>

</html>