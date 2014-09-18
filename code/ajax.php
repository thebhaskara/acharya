<?php
require_once('php/config.php');

if(isset($_POST))
    echo alert($_POST);
else
    echo '$_POST is not set';

//echo alert($_POST["scenario"]);

echo alert($_GET);
echo alert($_REQUEST);
echo alert($_SERVER);
?>