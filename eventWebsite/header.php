<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset = "UTF-8">
<title>Title of the document</title>
<link rel="stylesheet" type="text/css" href="styleHeader.css">
</head>
<body>
    
<header>
    <nav>
        <ul>            
            <li><button class="btn btn-menublock btn-menu" onclick="location.href='index.php'" type="button">HOME</button></li>
            
            
            
            <?php 
                // checks whether the user is logged in
                if(isset($_SESSION['username'])){
                  echo "<form action='includes/logout.inc.php'>
                            <button>LOG OUT</button>    
                        </form>";
                } else{
                     echo "<form action='includes/login.inc.php' method='POST'>
                                <input type='text' name='uid' placeholder='Username'>            <input type='password' name='pwd' placeholder='Password'>
                                <button type='submit'>LOGIN</button>
                           </form>";
                }
            //REMEMBER THE FORM HAS TO BE ECHO'd in css and remember the single and double apostrapies...
           
            ?>
           <li><button class="btn btn-menublock btn-menu" onclick="location.href='signup.php'" type="button">
                SIGNUP</button></li>
            
        </ul>
    </nav>
    
</header>