<?php
include 'dbh.php';
$username = ''; 
//username public event filter
//$username = $_SESSION['username'];

//if university space has been filled and the user is not a superadmin
if(isset ($_POST['uniseristy']) && $_SESSION['accountType'] != 2)
{

    $university = $_POST['university']; 
    $username = $_SESSION['username'];
    $user = "SELECT * FROM user WHERE name = '$username'";
    $users = $mysqli->query($user);
    $row = mysqli_fetch_array($users, MYSQL_ASSOC);

    $uid = $row['uid'];

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