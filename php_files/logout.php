<?php
$hostname = "http://localhost/magenta";
session_start();
session_unset();
session_destroy();
header("Location:{$hostname}");

?>