<link rel="stylesheet" href="style.css">

<?php
    session_start();
    include 'navbar.html';
?>

<div class="body content">
    <div class = "welcome">
    <div class="alert alert-success"><?= $_SESSION['message'] ?></div>
    <span class="user"><img src="images/thumbsup.jpg"></span><br>
    Welcome <span class = "user"><?= $_SESSION['username']?></span>
    