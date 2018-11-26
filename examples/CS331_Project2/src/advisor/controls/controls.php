<?php
include("../utils/queries.php");

session_start();
if (!isset($_SESSION["ADVISOR_LOGGED_IN"])) {
    header("Location: ../login/login.php");
}

$siteOnline = checkIfSiteIsOnline();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advisor Controls</title>

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

                <li class="active">
                    <a href="../advising/advising.php">
                        Controls
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

                <li>
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
        <div class="col-md-4 col-md-offset-4 text-center">

            <h2 class="text-center">Advisor Control Panel</h2>
            <?php if ($siteOnline == 1) { ?>
                <h3>Are you sure you want to disable appointments?</h3>
            <?php } else { ?>
                <h3>Are you sure you want to enable appointments?</h3>
            <?php } ?>
            <a href="switch.php" class="btn btn-primary" role="button">
                Yes
            </a>
            <a href="../advising/advising.php" class="btn btn-default" role="button">
                No
            </a>


        </div>
    </div>
</div>

<script src="../../static/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../static/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>