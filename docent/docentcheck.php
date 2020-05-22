<?php
include "../session.php";

if ($user_role == "student"){
    session_destroy();
    header("location: ../login.php");
}
?>