<?php
// session stuff!!!!!!
session_start();
$_SESSION['message'] = '';

//$mysqli = new mysqli('localhost', 'root', '', 'eventdb');
include "../Navbar/includes/dbh.php";
// adds navbar to top of page
include "../Navbar/navbar/navbar.php";
?>


<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="signupStyle.css" type="text/css">
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
    ?>
    
    <?php

    //gets name of RSO trying to be created
    $rso_name = $_POST['name'];
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
            FROM rso 
            WHERE name='$rso_name'";
      
    $rows = mysqli_query($mysqli, $sql);

    
    $e1 = $_POST['email_1'];
    $e2 = $_POST['email_2'];
    $e3 = $_POST['email_3'];
    $e4 = $_POST['email_4'];
    $e5 = $_POST['email_5'];
    
    //gets domains
    $domain_1 = substr(strrchr($e1, "@"), 1);
    $domain_2 = substr(strrchr($e2, "@"), 1);
    $domain_3 = substr(strrchr($e3, "@"), 1);
    $domain_4 = substr(strrchr($e4, "@"), 1);
    $domain_5 = substr(strrchr($e5, "@"), 1);
      
    //gets email names
    $u1 = explode("@",$e1);
    $user1 = $u1[0];
    $u2 = explode("@",$e2);
    $user2 = $u2[0];
    $u3 = explode("@",$e3);
    $user3 = $u3[0];
    $u4 = explode("@",$e4);
    $user4 = $u4[0];
    $u5 = explode("@",$e5);
    $user5 = $u5[0];
    
      
    //Checks that all user names are different....
    $one_two = ($user1 != $user2);
    $one_three = ($user1 != $user3);
    $one_four = ($user1 != $user4);
    $one_five = ($user1 != $user5);
    $two_three = ($user2 != $user3);
    $two_four = ($user2 != $user4);
    $two_five = ($user2 != $user5);
    $three_four = ($user3 != $user4);
    $three_five = ($user3 != $user5);
    $four_five = ($user4 != $user5);
    
    
    
    if($one_two && $one_three && $one_four && $one_five && $two_three && $two_four && $two_five && $three_four && $three_five && $four_five){
        $usernames_check = True;
    }
      
    else{
       $usernames_check = False;
       $_SESSION['message'] = "Emails must be different";
       ?><script type="text/javascript">location.href = 'rso_create_fail.php';</script><?php
    }
      
    //check that all emails have same domain
    if (($domain_1 == $domain_2) && ($domain_1 == $domain_3) && ($domain_1 == $domain_4) && ($domain_1 == $domain_5)){
        $email_check = True;
    }
    else{
       $email_check = False;
       $_SESSION['message'] = "Emails must have same domain";
       ?><script type="text/javascript">location.href = 'rso_create_fail.php';</script><?php
    }
      
    //Checks university exists
    $uni_name = $_POST['university'];
    $univid = "SELECT univid 
               FROM university
               WHERE name = '$uni_name'";
    $univid_array = mysqli_query($mysqli, $univid);
    $univid_result = mysqli_fetch_assoc($univid_array);
    $univ_id = $univid_result['univid'];
    
    
    if(mysqli_num_rows ($univid_array) == 0){
        $uni_check = False;
        $_SESSION['message'] = "University not in database";
        ?><script type="text/javascript">location.href = 'rso_create_fail.php';</script><?php
    }
    else{
        $uni_check = True;
    }
    
       
    //Name for RSO isnt taken and other qualifications match
    if (mysqli_num_rows ($rows) == 0 && ($email_check == True) && ($uni_check == True) && ($usernames_check == True))
    {
        //insert rso into databse
        $sql2 = "INSERT INTO rso (name) 
        VALUES ('$rso_name')";
        mysqli_query($mysqli, $sql2);
        
        echo "Added " . $rso_name . " to the Database Successfully!";
        echo "\n";

        
        //Next Step: Add user into Admin Table
        //AID = UID
        //If already in table, then it doesn't matter
        $aid = "INSERT INTO admin (aid) VALUES ('$user_id')";
        mysqli_query($mysqli, $aid); 
        echo "Added " .  $username . " into Admin Table!";

        //get rso ID
        $rid = "SELECT rsoid
                FROM rso
                WHERE name = '$rso_name'";
        $rso_id_array = mysqli_query($mysqli, $rid);
        $rso_id_result = mysqli_fetch_assoc($rso_id_array);
        $rso_id = $rso_id_result['rsoid'];
	    
	  //make user memeber of RSO
        $mem = "INSERT INTO memberof (uid, rsoid) 
        VALUES ('$user_id','$rso_id')";
        mysqli_query($mysqli, $mem);
        
        //Next Step: affiliate RSO and University
        $aff = "INSERT INTO rsoaffiliation (rsoid, univid) VALUES ('$rso_id', '$univ_id')";
        mysqli_query($mysqli, $aff); 
        echo "Added to Affiliation";
        
        //insert User as RSO manager
        $sql4 = "INSERT INTO manages (aid, rsoid) 
        VALUES ('$user_id', '$rso_id')";
        mysqli_query($mysqli, $sql4);
        echo "Added " . $username . " as Owner!";

    }

    //Else, RSO name taken already
    else if (mysqli_num_rows ($rows) > 0){
        $_SESSION['message'] = "RSO Name already taken";
        ?><script type="text/javascript">location.href = 'rso_create_fail.php';</script><?php

    }

    ?>
	 
<a href="http://twitter.com/share?text=I have created the following RSO: 
<?php echo $rso_name;?> . Check it out!" class="twitter-share-button" data-url="h" data-count="vertical">Tweet</a>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

<br>
<a href= "welcome.php">Retrun to Welcome Page</a><br>
<a href="rso_index.php">View RSO List</a>
<a href= "rso_create">Return to Create RSO</a>
      
    
  </div>
</div>
</body>
