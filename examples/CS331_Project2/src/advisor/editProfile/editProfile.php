<?php
session_start();

if (!isset($_SESSION["ADVISOR_LOGGED_IN"])) {
    header("Location: ../login/login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advisor Login</title>

    <link rel="stylesheet" href="../../static/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../static/bower_components/bootstrap/dist/css/bootstrap-theme.min.css">
    <link rel="icon" type="image/x-icon" href="../../static/img/umbc.png"/>
</head>

<body>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../login/login.php">
                CMNS Advising Site
            </a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">

                <li>
                    <a href="../advising/advising.php">
                        Dashboard
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

                <li>
                    <a href="../controls/controls.php">
                        Controls
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

                <li class="active">
                    <a href="../editProfile/editProfile.php">
                        Edit Profile
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

                <li>
                    <a href="../logout/logout.html">
                        Logout
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>


<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h2 class="text-center">Edit Profile</h2>

            <?php

            $err_start = "<div class=\"alert alert-info\">";
            $err_end = "</div>";

            if (isset($_GET["error_msg"])) {
                $err_start = "<div class=\"alert alert-info\">";
                $err_end = "</div>";
                $error_msg = urldecode($_GET["error_msg"]);
                echo $err_start . $error_msg . $err_end;
            }
            ?>

            <form action="updateAdvisorProfile.php" method="POST">


                <div class="form-group">
                    <label for="tfFName">First Name</label>
                    <input type="text" class="form-control"
                           id="tfFName" name="tfFName" size="30" maxlength="25"
                           value="<?php echo $_SESSION["ADVISOR_FIRST_NAME"] ?>"
                           placeholder="Sam" required>
                </div>

                <div class="form-group">
                    <label for="tfLName">Last Name</label>
                    <input class="form-control" id="tfLName" type="text" size="30" maxlength="25"
                           placeholder="Jackson" value="<?php echo $_SESSION["ADVISOR_LAST_NAME"] ?>"
                           name="tfLName" required>
                </div>

                <div class="form-group">
                    <label for="tfBldgName">Building Name</label>
                    <input id="tfBldgName" size="30" maxlength="25" class="form-control" name="tfBldgName" type="text"
                           value="<?php echo $_SESSION["ADVISOR_BLDG_NAME"] ?>"
                           placeholder="Math and Psychology Building" required>
                </div>

                <div class="form-group">
                    <label for="tfRoomNumber">Room Number</label>
                    <input id="tfRoomNumber" size="30" maxlength="25" class="form-control" name="tfRoomNumber"
                           type="text" value="<?php echo $_SESSION["ADVISOR_ROOM_NUM"] ?>"
                           placeholder="RM 420" required>
                </div>


                <div class="form-group">
                    <label for="tfEmail">Email</label>
                    <input id="tfEmail" type="email" size="30" maxlength="25" pattern="^\w+@umbc\.edu"
                           class="form-control" value="<?php echo $_SESSION["ADVISOR_EMAIL"] ?>"
                           title="advisor1@umbc.edu" name="tfEmail" placeholder="advisor1@umbc.edu" required>
                </div>

                <div class="form-group">
                    <label for="oldPassword">Re-enter Password</label>
                    <input id="oldPassword" type="password" size="30" maxlength="25" class="form-control"
                           name="oldPassword" placeholder="enter your old password" required>
                </div>


                <div class="form-group">
                    <label for="tfPassword1">New Password</label>
                    <input id="tfPassword1" type="password" size="30" maxlength="25" class="form-control"
                           name="tfPassword1" placeholder="enter your password" required>
                </div>

                <div class="form-group">
                    <label for="tfPassword2">Re-Enter New Password</label>
                    <input id="tfPassword2" type="password" size="30" maxlength="25" class="form-control"
                           name="tfPassword2" placeholder="enter your password" required>
                </div>

                <button type="submit" class="btn btn-default center-block">Update</button>


            </form>
        </div>
    </div>
</div>

<script src="../../static/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../static/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>