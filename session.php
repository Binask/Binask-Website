<?php
include "database.php";
session_start();

$user_check = $_SESSION['user_id'];
$user_role = $_SESSION['user_type'];
$user_firstname = $_SESSION["user_firstname"];

?>
