<?php
require_once('php/config.php');
$session->logout();
$session->close();
open_login_page();
?>