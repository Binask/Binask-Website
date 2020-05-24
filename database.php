<?php
$host = "localhost";
$user = "student";
$password = "student";
$dbname = "BinaskDB";

//verbinden met database
$conn = mysqli_connect($host, $user, $password, $dbname);

//connectie checken
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_error() . "(" . mysqli_errno() . ")" );
}
?>