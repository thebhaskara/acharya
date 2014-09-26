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
    
    default:
    break;
    
}


?>