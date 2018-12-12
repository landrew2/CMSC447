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
            <a class="navbar-brand" href="login.php">
                CMNS Advising Site
            </a>
        </div>


        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">

                <li class="active">
                    <a href="login.php">
                        Login
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

                <li>
                    <a href="../registration/registration.php">
                        Register
                    </a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <h2 class="text-center">Advisor Login</h2>

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

            <form action="process.php" method="POST">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" size="30" maxlength="25"
                           pattern="^\w+@umbc\.edu"
                           class="form-control"
                           title="advisor1@umbc.edu" name="email"
                           placeholder="advisor1@umbc.edu" required>
                </div>


                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password"
                           size="30" maxlength="25"
                           class="form-control"
                           name="password"
                           placeholder="enter your password" required>
                </div>

                <button type="submit" class="btn btn-default center-block">
                    Login
                </button>

                <a href="../registration/registration.php">
                    <em>Need to register?</em>
                </a>

            </form>
        </div>
    </div>
</div>

<script src="../../static/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../static/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>