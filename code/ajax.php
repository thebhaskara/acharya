<?php
require_once('php/config.php');

$get = $_GET;
$action = $get["a"];

switch($action){
    case "createscenario":
    include("php/ajax/createScenario.php");
    break;
    
    case "createtopic":
    include("php/ajax/createTopic.php");
    break;
    
    case "createlevel":
    include("php/ajax/createLevel.php");
    break;
    
    case "createexam":
    include("php/ajax/createExam.php");
    break;
    
    case "login":
    include("php/ajax/login.php");
    break;
    
    case "register":
    include("php/ajax/register.php");
    break;
    
    case "createpapers":
    include("php/ajax/createPapers.php");
    break;

    case "submitExam":
    include("php/ajax/submitExam.php");
    break;

    
    default:
    break;
}


?>