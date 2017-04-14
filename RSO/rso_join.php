<?php

session_start();

include '../Navbar/includes/dbh.php';


?>

<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="../Navbar/Signup/signupStyle.css" type="text/css">
<body>
<div class="body-content">
  <div class="module">
    
<?php
      
    //Checks if user is logged in
    if(isset($_SESSION['username'])){
		echo $_SESSION['username'];
	} else {
		echo "You are not logged in!";
	}
      
    //checks if user has already joined, if not, adds it to DB
    
    //gets name of RSO trying to be created
    $rso_id = $_GET['id'];
    //gets name of user name in session
    $username = $_SESSION['username'];
    //gets username id  
    $uid = "SELECT uid 
            FROM user
            WHERE name = '$username'";
    $uid_array = mysqli_query($mysqli, $uid);
    $uid_result = mysqli_fetch_assoc($uid_array);
    $user_id = $uid_result['uid'];
    
    $sql = "SELECT * 
            FROM memberof 
            WHERE rsoid='$rso_id' AND uid='$user_id'";
      
    $rows = mysqli_query($mysqli, $sql);

    //User isnt already a member
    if (mysqli_num_rows ($rows) == 0)
    {
        //insert rso into databse
        $sql2 = "INSERT INTO memberof (uid, rsoid) 
        VALUES ('$user_id','$rso_id')";
        mysqli_query($mysqli, $sql2);
        echo "Successfully Joined!";
    }
    
    else echo "Already Joined";
      
?>
  
<a href="http://twitter.com/share?text=I have joined the following RSO: <?php echo $rso_name;?>. Check it out!" 
class="twitter-share-button" data-url="h" data-count="vertical">Tweet</a>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
      
      
<br>
<a href= "../Navbar/welcome.php">Retrun to Welcome Page</a><br>
<a href= "../RSO/rso_index.php">Return to RSO Page</a>
      
 </div>
</div>
</body>
