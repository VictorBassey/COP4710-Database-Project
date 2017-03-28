<?php
session_start(); // allows website to remember variables
session_destroy(); // destroys session

//header("Location: ../signup.php");
header("Location: ../login/login.php");

?>