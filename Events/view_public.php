<?php
include 'dbh.php';

//if university space has been filled and the user is not a superadmin
if(isset ($_POST['uniseristy']) && $_SESSION['accountType'] != 2)
{
    //if logged in
      if(!isset($_SESSION['uid'])) 
     {
            echo '<h1>Sorry, you must be logged in to view this event.</h1>';
            echo '</div></div></body></html>';
            die();
     }
    
    $university = $_POST['university']; 
    $username = $_SESSION['username'];
    $uid = $_SESSION['uid']; 

    $univid = "SELECT univid FROM rsoaffiliation WHERE rsoid IN (SELECT rsoid FROM events WHERE eid IN (SELECT eid FROM registered WHERE uid = '$uid'))"; 

    $sql = "SELECT* FROM events WHERE location = '$university' AND eid IN (SELECT eid FROM registered uid ='$uid')"; 
    $result = $mysqli->query($sql);

    if($result->num_rows == 0)
    {
        echo 'error'; 
    }
    $result = $mysqli->query($sql);
 
}
else
{
        $sql = "SELECT* FROM events WHERE eventtype = 'public'";
        $result = $mysqli->query($sql);
}

?>