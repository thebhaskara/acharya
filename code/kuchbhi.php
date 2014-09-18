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

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
    </head>
    <body class="container" ng-controller="addScenario">
        <?php
$a = R::dispense('tablea');
$b = R::dispense('tableb');
$rel = R::dispense('tableab');

$a->text = 'Bhaskar';

$b->description = 'is doing something';
//$relation = R::load('tableab', R::store($rel));
//$a->relb = $rel;
//$b->rela = $rel;

$rel->b = $b;
$rel->a = $a;

echo R::store($rel);
?>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery-2.1.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/angular.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>