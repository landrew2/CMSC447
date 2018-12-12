<?php

include('../utils/queries.php');

session_start();

if (!isset($_SESSION["ADVISOR_LOGGED_IN"])) {
    header("Location: ../login/login.php");
} else {
    $meetings = getAdvisorMeetings($_SESSION["ADVISOR_ID"]);
}

?>
<html>
<head>
    <title>Advising Calendar</title>

    <link rel="stylesheet" href="../../static/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../static/bower_components/bootstrap/dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../../static/bower_components/bootstrap-calendar/css/calendar.css">
    <link rel="stylesheet" href="../../static/css/advising.css">

    <link rel="icon" type="image/x-icon" href="../../static/img/umbc.png"/>
</head>
<body>


<?php include('navbar.html') ?>


<div class="container">

    <!--  TOP HEADER WITH CREATE NEW APPOINTMENT BUTTON -->
    <div class="row">
        <div class="col-sm-6">
            <h1>
                Welcome <?php echo $_SESSION["ADVISOR_FIRST_NAME"]; ?>
            </h1>
        </div>

        <div class="col-sm-6">

            <!-- Button trigger modal -->

            <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal"
                    data-target="#myModal" id="createNewAppointmentButton">
                Create a new appointment
            </button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">
                                New Appointment Form
                            </h4>
                        </div>

                        <div class="modal-body">
                            <form action="createAppointment.php" method="POST">

                                <label>
                                    Meeting Date
                                    <input type="datetime-local" name="meetingTime" required>
                                </label>


                                <label>
                                    Room Location
                                    <input type="text" name="location" required>
                                </label>

                                <label>
                                    Type of Meeting:
                                    <select name="meetingType">
                                        <option value="individual">Individual</option>
                                        <option value="group">Group</option>
                                    </select>
                                </label>

                                <button type="submit" class="btn btn-default">Create Appointment</button>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--  HEADER TO SHOW VARIOUS CALENDER FUNCTIONS LIKE MOVE ONE MONTH/WEEK/DAY ahead  -->
    <div class="row">
        <div class="pull-right form-inline">
            <div class="btn-group">
                <button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
                <button class="btn btn-default" data-calendar-nav="today">Today</button>
                <button class="btn btn-primary" data-calendar-nav="next">Next >></button>
            </div>
            <div class="btn-group">
                <button class="btn btn-warning" data-calendar-view="year">Year</button>
                <button class="btn btn-warning active" data-calendar-view="month">Month</button>
                <button class="btn btn-warning" data-calendar-view="week">Week</button>
                <button class="btn btn-warning" data-calendar-view="day">Day</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="calendar"></div>
    </div>

    <!-- Events list for debugging   -->
    <div class="row">
        <h4>Events</h4>
        <ul id="eventlist" class="nav nav-list"></ul>
    </div>

    <div class="modal fade" id="events-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3>
                        Event
                    </h3>
                </div>

                <div class="modal-body" style="height: 400px">

                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                </div>
            </div>
        </div>
    </div>


</div>


<script src="../../static/bower_components/jquery/dist/jquery.js"></script>
<script src="../../static/bower_components/underscore/underscore.js"></script>
<script src="../../static/bower_components/moment/moment.js"></script>
<script src="../../static/bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src="../../static/bower_components/bootstrap-calendar/js/calendar.js"></script>
<script src="../../static/js/advising.js"></script>

</body>
</html>