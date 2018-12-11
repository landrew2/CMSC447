<?
ini_set('display_errors', 1);

session_start(); 

include '../dbUtils/queries.php';
var_dump($_SESSION);
if ($_POST) {
    //echo $_POST['name'];
    //echo $_POST['emergencyType'];
    if ((isset($_SESSION['operator']) && $_SESSION['operator'])){
        $priority = $_POST['priority'];
    }
    else{
         $priority = 0;
    }
     $fullStreetAddress = $_POST['street'] . " " .$_POST['city'] . " " .$_POST['state'] . ", " . $_POST['zipCode'];
    // echo $fullStreetAddress;
        //test();
    addEvent($_POST['name'], $fullStreetAddress,$_POST['emergencyType'],$_POST['description'],$_POST['email'], $_POST['phone'],$priority);
    
    //not logged in as either
     if ( (!isset($_SESSION['operator'])|| !$_SESSION['operator']) &&  (!isset($_SESSION['responder']) || !$_SESSION['responder'])){
       header('Location: ../success.html');
     }
     elseif($_SESSION['operator'])
     {
        header('Location: ../911Operator/operatorHome/operatorHome.html');
     }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../Libraries/popper.min.js"></script>
    <script src="../Libraries/jquery-3.3.1.js"></script>
    <script src="createEvent.js"></script>
    <title>Emergency</title>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-8" style="border:solid">
                <h2>Need help?</h2>
                <form action="" method= "POST">
                    <div class="form-group">
                        <label for="nameInput">Name:</label>
                        <input type="text" class="form-control" id="nameInput" aria-describedby="name" name= "name" placeholder="Enter name"
                            required>
                    </div>

                    <!-- street address -->
                    <div class="form-group">
                        <label for="streetInput">Street address:</label>
                        <input type="text" class="form-control" id="streetInput" aria-describedby="streetInput" name="street"
                            placeholder="Enter street address">
                    </div>

                    <!-- City -->
                    <div class="form-group">
                        <label for="cityInput">City:</label>
                        <input type="text" class="form-control" id="cityInput" aria-describedby="cityInput" name = "city" placeholder="Enter City">
                    </div>

                    <!-- State -->
                    <div class="form-group">
                        <label for="stateInput">State:</label>
                        <input type="text" class="form-control" id="stateInput" aria-describedby="stateInput" name = "state"
                            placeholder="Enter State">
                    </div>

                    <!-- Zip Code -->
                    <div class="form-group">
                        <label for="zipCodeInput">Zip Code:</label>
                        <input type="text" class="form-control" id="zipCodeInput" aria-describedby="zipCodeInput" name = "zipCode"
                            placeholder="Enter Zip Code">
                    </div>

                    <!-- Event type -->
                    <div class="form-group">
                        <label for="eventTypeSelect">Emergency Type:</label>
                        <select class="form-control" id="eventTypeSelect" required name="emergencyType">
                           <!-- Changing these options will require changes in queries.php Just FYI.-->
                            <option>Water</option>
                            <option>Fire</option>
                            <option>Crime</option>
                            <option>General</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="descriptionInput">Description</label>
                        <textarea class="form-control" id="descriptionInput" rows="3" placeholder="Please describe your emergency" name="description"
                            required></textarea>
                    </div>
                
                    <?php
                        if(isset($_SESSION['operator'])){
                            echo '                    
                            <div class="form-group">
                                <label for="descriptionInput">Priority</label>
                                <select class="form-control" id="eventTypeSelect" required name="priority">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                             </select>
                            </div>';
                        }
                        ?>
                <h5>Contact information - Please fill out at least one of the following fields:</h5>
                <!-- Contact info phone and/or email -->
                <div class="form-group">
                    <label for="phoneInput">Contact Phone:</label>
                    <input type="tel" class="form-control" id="phoneInput" aria-describedby="phoneInput" name = "phone" placeholder="Enter phone number">
                </div>

                <div class="form-group">
                    <label for="emailInput">Contact Email Address:</label>
                    <input type="email" class="form-control" id="emailInput" aria-describedby="emailInput" name = "email" placeholder="Enter email address">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <?php
             if (!isset($_SESSION['operator']) || !$_SESSION['operator']){
                echo '
                <div class="col-4" style="border:solid">
                    <h2>log in stuff</h2>
                    <h5>Emergency Responder?</h5>
                    <form action="responderLogin.php" method = "POST">
                        <div class="form-row align-items-center">
                            <input type="text" class="form-control " id="emergencyResponderLogin" name="emergencyResponderLogin"placeholder="Login ID">
                            <button id="emergencyResponderLoginButton" class="btn btn-success" type="submit">Sign in</button>
                        </div>
                    </form>
                    <form action="operatorLogin.php" method = "POST">
                        <h5>911 Operator?</h5>
                        <input type="text" class="form-control" id="911OperatorLogin" name="911OperatorLogin" placeholder="Login ID">
                        <button id="911operatorLoginButton" class="btn btn-success" type="submit">Sign in</button>
                    </form>
                </div>';
              }
              ?>
        </div>
    </div>

    <link rel="stylesheet" href="../Libraries/bootstrap-4.1.3-dist/css/bootstrap.min.css">
    <script src="../Libraries/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
</body>