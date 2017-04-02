<link rel="stylesheet" href="style.css">

<?php
    session_start();
    include 'Navbar/navbar.php';
    
?>

<div class="body content">
    <div class = "welcome">
        
    <div class="alert alert-success"><?= $_SESSION['message'] ?></div>
    <div class="alert alert-success"><?= $_SESSION['accountType'] ?></div>  
    Welcome <span class = "user"><?= $_SESSION['username']?></span>
    