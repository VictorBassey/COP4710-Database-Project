<?php

session_start();

include '../Navbar/includes/dbh.php';
    include '../Navbar/navbar.php';

$_SESSION['message'] = '';

$sql = 'SELECT * FROM events WHERE approved = 0';

$results = mysqli_query($mysqli, $sql);

?>

<!DOCTYPE html>
<html>
<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="signupStyle.css" type="text/css">
<body>
<div class="body-content">
  <div class="module">

<body>

<h1>Events Pending Approval</h1>
    
<table width = "700" cellpadding = "5" cellspacing = "1">
    
<?php
    
while ($events = mysqli_fetch_assoc($results)){
?>   
                  
                                             
<tr>
<td><?php echo $events['description'];?> </td>
<td align = "center"><a href= "approve_process.php?id=<?php echo $events['eid'];?>">APPROVE</a></td>
<td><a href= "delete_event.php?id=<?php echo $events['eid'];?>">DELETE</a></td>
</tr>


<?php   
}
?>

</table>
</body>