<?php
include 'CommonMethods.php';


//declare and define empty errors 


$debug = false;

$COMMON = new Common($debug);

//checks if the site is active
$sql = "SELECT * FROM Shut_Off_Control";
$results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);

$offOnArray = mysql_fetch_assoc($results);

if (!$offOnArray['siteOnline']) {
    header('Location: offline.html');
    exit;

} else {
    $email_error = "";
    $id_error = "";
    if ($_POST) {


        $campusID = strtolower($_POST["campusID"]);

        $email = strtolower($_POST["email"]);


        $fileName = "login.php";

        //check student_table for campusID input
        $id_val_query = "SELECT * FROM Student WHERE campusID ='$campusID'";

        $id_results = $COMMON->executequery($id_val_query, $fileName);


        //if campusID is left empty or does not exist in table
        if (mysql_num_rows($id_results) == 0) {
            $id_error = "Please enter a valid student ID.";
        } else {
            //search if email exists in student_table

            $num_rows = mysql_num_rows($id_results);

            if ($num_rows == 1) {
                session_start();

                $studentDict = mysql_fetch_assoc($id_results);

                if ($studentDict["email"] == $email) {

                    $_SESSION["loggedIn"] = true;

                    //creating session variables for each field for the student

                    $_SESSION["fName"] = $studentDict["fName"];

                    $_SESSION["lName"] = $studentDict["lName"];

                    $_SESSION["email"] = $studentDict["email"];

                    $_SESSION["id"] = $studentDict["campusID"];

                    $_SESSION["major"] = $studentDict["major"];

                    $_SESSION["postUMBC"] = $studentDict["postUMBC"];

                    $_SESSION["questionsConcerns"] = $studentDict["questionsConcerns"];

                    //retrieving meetingID to determine if student has a meeting

                    $sql = "SELECT meetingID FROM Student WHERE campusID = '$campusID'";

                    $results = $COMMON->executeQuery($sql, $_SERVER['PHP_SELF']);

                    $hasAppt = mysql_fetch_assoc($results);

                    $_SESSION["meetingID"] = $hasAppt["meetingID"];

                    if ($hasAppt["meetingID"] == -1) {
                        $_SESSION["hasAppointment"] = false;
                    } else {
                        $_SESSION["hasAppointment"] = true;
                    }

                    //redirected to menu.php
                    header('Location: menu.php');
                } else {

                    $email_error = "Please enter a valid email.";

                }
            }
        }
    }
}
?>

<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" , initial-scale=1, maximum-scale=1, user-scalable=no>

    <title>Student Login</title>

    <link rel="icon" type="image/x-icon" href="../static/img/umbc.png"/>
    <link rel="stylesheet" type="text/css" href="../static/css/student.css"/>


</head>

<body>

<div class="form">

    <h1>
        Student Login Page
    </h1>


    <br>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <div class="field">

            <label for="email">E-mail</label>

            <br><br>

            <input id="email" type="search" name="email" placeholder="johndoe@umbc.edu" required>
            <span class="error"><font color="red"><br><?php echo $email_error; ?></font></span>

        </div>


        <br>

        <div class="field">

            <label for="id">Student ID</label>

            <br><br>

            <input id="id" type="search" name="campusID" placeholder="JD12345" required>

            <span class="error"><br><font color="red"><?php echo $id_error; ?></font></span>

        </div>

        <br>

        <div class="nextButton">

            <label><input type="submit" class="large selection button" value="Login"></label>

        </div>

</div>
</form>
</body>
</html>
  

