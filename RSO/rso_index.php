<?php

session_start();
include '../Navbar/navbar.php';
include '../Navbar/includes/dbh.php';

$sql = 'SELECT * FROM rso';

$results = mysqli_query($mysqli, $sql);

?>

<!DOCTYPE html>
<html>
<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="../Navbar/Signup/signupStyle.css" type="text/css">
<body>
<div class="body-content">
  <div class="module">

<body>

<h1>Registered Student Organizations</h1>
    
<table width = "600" cellpadding = "5" cellspacing = "2">
    
<?php
    
while ($rsos = mysqli_fetch_assoc($results)){
?>   
                  
                                             
<tr>
<td><?php echo $rsos['name'];?> </td>
<td><a href= "rso_join.php?id=<?php echo $rsos['rsoid'];?>">JOIN RSO</a></td>

</tr>

<?php   
}
?>

</table>
</body>