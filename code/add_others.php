<?php
require_once('php/config.php');
if(!$session->is_logged_in())
    open_login_page();
if(!$session->is_examiner())
    open_login_page();
?>
<!DOCTYPE html>
<html lang="en" ng-app="onlineExam">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add a question</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom css -->
        <link href="css/style.css" rel="stylesheet">
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
        <link href="css/summernote.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
    </head>
    <body class="container-fluid" ng-controller="addOthers">

        <?php
include("html/nav_area.html");
        ?>
        <div class="row">
            <div class="col-sm-3">
            <!-- left nav -->
            </div>
            <div class="col-sm-4">
                <?php
include("html/add_topic.html");
include("html/add_level.html");
?>
            </div>
        </div>
        <?php include("html/shared_popup.html"); ?>
        <script>var Topics = <?php  echo json_encode(topic::get_all()); ?>;</script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/lib/jquery-2.1.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/lib/angular.min.js"></script>
        <script src="js/lib/angular-sanitize.min.js"></script>
        <script src="js/lib/bootstrap.min.js"></script>
        <script src="js/lib/summernote.min.js"></script>
        <script src="js/ready.js"></script>
        <script src="js/angular/anchorDirective.js"></script>
        <script src="js/angular/dropdownConroller.js"></script>
        <script src="js/angular/addOthers.js"></script>
    </body>
</html>
