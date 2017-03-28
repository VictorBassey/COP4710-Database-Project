<?php
// session stuff!!!!!!
session_start();
$_SESSION['message'] = '';


//$mysqli = new mysqli('localhost', 'root', '', 'eventdb');
include "../includes/dbh.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    // if two passwords are equal to each other, set values
    if($_POST['password'] == $_POST['confirmpassword']){
        
        $username = $mysqli ->real_escape_string($_POST['username']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $password = md5($_POST['password']);//md5 hash password security
        $phonenumber = $mysqli ->real_escape_string($_POST['phonenumber']);
        $accountType = $mysqli ->real_escape_string($_POST['userSelect']);
        
        
        
        $sql = "INSERT INTO user (name, email, password, phone) "
            . "VALUES ('$username', '$email', '$password', '$phonenumber')";
        
        //$result = mysqli_query($user);
        // if the query is successful, redirect to welcome.php page
        //+++++THIS NEEDS TO CHANGE TO HOMEPAGE++++
        if($mysqli->query($sql) == true){
            $user = "SELECT * FROM user WHERE name = '$username'";
            
            $users = $mysqli->query($user);
            $row = mysqli_fetch_array($users, MYSQL_ASSOC);
            
            $userid = $row['uid'];
            //$_SESSION['result'] = $row['uid'];                           
            if($accountType > 1){
                $sql = "INSERT INTO superadmin (said) "
            . "VALUES ('$userid')";
                $mysqli->query($sql);
                
            }
            
            $_SESSION['accountType'] = $accountType;
            $_SESSION['username'] = $username;
            
            
            $_SESSION['message'] = "Registration Succesful! Added $username to the database!";
            header("location: ../welcome.php");
            
        }
        else{
            $_SESSION['message'] = "User could not be added to the database!";
        }
    }
    // if passwords don't match
    else{
        $_SESSION['message'] = "The two passwords did not match!";
    }
}

// adds navbar to top of page
// include 'navbar.html';
?>
    

<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="signupStyle.css" type="text/css">
<body>
<div class="body-content">
  <div class="module">
    <h1>Create an account</h1>
    <form class="form" action="signup.php" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
      <input type="text" placeholder="User Name" name="username" required />
      <input type="text" placeholder="Phone Number" name="phonenumber"/>
      <input type="email" placeholder="Email" name="email" required />
      <input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
      <input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required />
      <div class="dropdown"><label>Use dropdown to select your account type:</label>
        <select name="userSelect" id= "userSelect" required>
            <option value="0" disabled="disabled" selected="selected">Please select account type</option>
          <option value="1">User</option>
          <option value="2">SuperAdmin</option>
        </select>
        </div>
      <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>
</body>

