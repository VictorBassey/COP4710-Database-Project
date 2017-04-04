<?php
include 'dbh.php';
$username = ''; 
//username public event filter

//$username = $_SESSION['username'];

if(isset ($_POST['uniseristy'])&&isset($_POST['type']) && $_SESSION['accountType'] != 2)
{
    //you must be logged in
     if(!isset($_SESSION['username'])) 
     {
            echo '<h1>Sorry, you must be logged in to view this event.</h1>';
            echo '</div></div></body></html>';
            die();
     }
    
    if($_POST['type'] == 'rso')
    {
    $university = $_POST['university']; 
    $username = $_SESSION['username'];
    //user info
    $user = "SELECT * FROM user WHERE name = '$username'";
    $users = $mysqli->query($user);
    $row = mysqli_fetch_array($users, MYSQL_ASSOC);

    $uid = $row['uid'];

    $univid = "SELECT univid FROM rsoaffiliation WHERE rsoid IN (SELECT rsoid FROM events WHERE eid IN (SELECT eid FROM registered WHERE uid = '$uid'))"; 

    $sql = "SELECT* FROM events WHERE location = '$university' AND rsoid IN (SELECT rsoid FROM rsoaffiliation univid ='$univid') AND IN (SELECT rsoid FROM memberof WHERE uid = '$uid')"; 

    $result = $mysqli->query($sql);

        if($result->num_rows == 0)
        {
            echo '<h1>Sorry, you must be part of the event\' RSO to view those events</h1>'; 
        }
    }
}
else
{
      $sql = "SELECT* FROM events WHERE eventtype = 'public'"; 
      $result = $mysqli->query($sql);
}
?>