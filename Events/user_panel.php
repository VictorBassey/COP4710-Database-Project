<?php
session_start();
include 'dbh.php';

if(isset($_SESSION['username']))
{
    $username = $_SESSION['username'];
    $user = "SELECT * FROM user WHERE name = '$username'";
    $users = $mysqli->query($user);
    $row = mysqli_fetch_array($users, MYSQL_ASSOC);

    $uid = $row['uid'];
    
    //if you are a student
    if($_POST['user'] == 'view')
    {
        header("location: ../user_view.php"); 
    }
    //if you are an admin
    else
    {
        $sql = "SELECT* FROM admin WHERE aid = '$uid'"; 
        $result = $mysqli->query($sql); 
        
        if($result->num_rows == 0)
        {
            echo 'You are not an admin'; 
            header("location: user_panel.php");
        }
        header("location: create_event.php");     
    }
}

?>
<html>
<head>
</head>

    <body>  
    <form  action="user_panel.php">
        
    <button name="action" value="view" >VIEW</button>
        
    <button name="action" value="create">CREATE</button>
        
    </form>
    </body>
</html>