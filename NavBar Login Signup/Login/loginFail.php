<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" type="text/css" href="loginStyle.css">
    </head>
<body>
    
    <div id="frm">
        <h1>Log in</h1>
        <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
    <form action="process.php" method="POST">
        <p>
            <input type="text" id="user" placeholder="Username" name="user" />
        </p>
        <p>
            
            <input type="password" id="pass" placeholder="Password" name="pass" />
        </p>
        <div id="box">
        <p>
            <input type="submit" id="btn" name="Login"/>
        </p>
        <p>
           <a href="../signup.php">Signup</a>
        </p>
        </div>
        </form>
    </div>
    
</body>
</html>