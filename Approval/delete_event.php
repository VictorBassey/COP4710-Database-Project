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
    
    

    //User isnt a super admin
    
        $sql = "DELETE FROM comment
                WHERE eid = $event_id";
        $it = mysqli_query($mysqli, $sql);
    
       if(!$it){
        echo $event_id;
        echo "It didnt work1";
        //echo mysql_error($mysqli);
    }
        
        $sql = "DELETE FROM events
                WHERE eid = $event_id";
        $it = mysqli_query($mysqli, $sql);

    if(!$it){
        echo "It didnt work2";
        //echo mysql_error($mysqli);
    }
        
        
        $_SESSION['message'] = "Event was NOT approved by super admin";
        header("location: approve_action.php");
        //header("location: ../Events/priv_event.php");
    
    
      
?>