<?php

session_start();

$_SESSION['message'] = '';

include '../Navbar/includes/dbh.php';
    

      
    //Checks if user is logged in
    if(isset($_SESSION['username'])){
		echo $_SESSION['username'];
	} else {
		echo "You are not logged in!";
	}
      
    
    //gets eid of event
    $event_id = $_GET['id'];
    //gets name of user name in session
    $username = $_SESSION['username'];
    //gets user id  
    $uid = "SELECT uid 
            FROM user
            WHERE name = '$username'";
    $uid_array = mysqli_query($mysqli, $uid);
    $uid_result = mysqli_fetch_assoc($uid_array);
    $user_id = $uid_result['uid'];
    
    //checks if user is super admin
    $super_admin = "SELECT * 
                    FROM superadmin 
                    WHERE said='$user_id'";
      
    $rows = mysqli_query($mysqli, $super_admin);

    //User isnt a super admin
    if (mysqli_num_rows ($rows) == 0)
    {
        $_SESSION['message'] = "User is not super admin";
        header("location: approved_action.php");
    }
    
    
    else{
        
        $sql = "DELETE FROM events
                WHERE eid = '$event_id'";
        mysqli_query($mysqli, $sql);
        
        
        $_SESSION['message'] = "Event was NOT approved by super admin";
        header("location: approved_action.php");
    }
      
?>