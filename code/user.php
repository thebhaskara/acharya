<?php
require_once('php/config.php');
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
        <link href="css/ng-table.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
    </head>
    <body class="container-fluid" ng-controller="loginRegister">

        <?php
include("html/nav_area.html");
        ?>
        <div class="row">
            <div class="col-sm-2"></div>
            <?php if(!$session->is_logged_in()) { ?>
            <div class="col-sm-4">
                <?php
            include("html/login_user.html");
                ?>
            </div>
            <div class="col-sm-4">
                <?php
            include("html/register_user.html");
                ?>
            </div>
            <?php } else if($session->is_applicant()) { ?>
            <div class="col-sm-8">
                <?php include('html/user_applicant.html'); ?>
            </div>
            <?php } else if($session->is_examiner()) { ?>
            <div class="col-sm-8">
                <?php include('html/user_examiner.html'); ?>
            </div>
            <?php } ?>

            <div class="col-sm-2"></div>
        </div>
        <?php include("html/shared_popup.html"); ?>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/lib/jquery-2.1.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/lib/angular.min.js"></script>
        <script src="js/lib/angular-sanitize.min.js"></script>
        <script src="js/lib/ng-table.min.js"></script>
        <script src="js/lib/bootstrap.min.js"></script>
        <script src="js/lib/summernote.min.js"></script>
        <script src="js/ready.js"></script>
        <script src="js/angular/anchorDirective.js"></script>
        <script src="js/angular/dropdownConroller.js"></script>
        <script src="js/angular/loginRegister.js"></script>
    </body>
</html>
