<?php 
    // Get values passed from form in login.php file
   
$_SESSION['message'] = 'Welcome User!';
    $username = $_POST['user'];
    $password = $_POST['pass'];
    
    session_start();
    // to prevent mysql injection
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $username = mysql_real_escape_string($username);
    $password = md5(mysql_real_escape_string($password));

    // connect to the server and select database
    include "../includes/dbh.php";

    // query the database
   /* $result = mysqli_query("SELECT * FROM user WHERE name = '$username' and password = '$password'", MYSQL_ASSOC); 
   
    $row = mysqli_fetch_array($result);
   */
$user = "SELECT * FROM user WHERE name = '$username' and password = '$password'";
            
            $users = $mysqli->query($user);
            $row = mysqli_fetch_array($users, MYSQL_ASSOC);
   
   if($row['name'] == $username && $row['password'] == $password){
        $_SESSION['username'] = $username; 
       
       $uid = $row['uid'];
       $user = "SELECT * FROM superadmin WHERE said = '$uid'";
       $users = $mysqli->query($user);
       $count = mysqli_num_rows($users);
        
        if($count >= 1){
            $_SESSION['accountType'] = 2;
            
        } else {
            $user = "SELECT * FROM admin WHERE aid = '$uid'";
            $users = $mysqli->query($user);
            $count = mysqli_num_rows($users);
        
            if($count >= 1){
                $_SESSION['accountType'] = 3;

            } else {
                 $_SESSION['accountType'] = 1;
            }
        }
       
     
       
       
       
       
       
       $_SESSION['message'] = "Login Succesful! Welcome back.";
       
       header("location: ../welcome.php");
       die();
      
    }else{
        $_SESSION['message'] = "Incorrect Username or Password";
       header("location: loginFail.php");
       
    }
?>


