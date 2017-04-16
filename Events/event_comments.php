<?php
    session_start();
    date_default_timezone_set('America/New_York');
include "../Navbar/navbar.php";    
include '../Navbar/includes/dbh.php';
  
        //if(!isset($_SESSION['eid'])){
            $_SESSION['eid'] = $_GET['varname'];
            
       // }
            
        if(isset($_POST['commentEdit'])){
            echo $_SESSION['cid'];
            ?><script type="text/javascript">location.href = 'comment_edit.php';</script><?php
        }
            $eid = $_SESSION['eid'];
        
    

    // refrences to a variable outside of function $mysqli
    function setComments($mysqli){
        // checks to see if commentSubmit button has been set
        if(isset($_POST['commentSubmit'])){
            // grabs data from url or Session vars
            $uid = $_SESSION['uid'];
            $eid = $_SESSION['eid'];
            //$eid = $_SESSION['eid'];
            //$eid = $_POST['varname']; 
            //$_SESSION['eid'] = $eid;
            $message = $_POST['message'];

            //inserts data to the database
            $sql = "INSERT INTO comment (uid, eid, comment) 
            Values ('$uid', '$eid', '$message')";

            $result = mysqli_query($mysqli, $sql);
        }
    }

    function getComments($mysqli){
       // $eid = $_SESSION['eid'];
        // $eid = $_POST['eid'];
        //$eid = $_GET['varname'];
        //$eid = 1;
        $eid = $_SESSION['eid'];
       // echo $eid;
        $sql = "SELECT * FROM comment WHERE eid= '$eid'";
        $result = mysqli_query($mysqli, $sql);
        // pulls results from the db until there is no 
        // results left
        if(mysqli_num_rows($result)>0){
        
            while($row = $result ->fetch_assoc()){
                echo "<div class='comment-box'><p>";
                    echo $row['uid']."<br>";
                    echo $row['ctime']."<br>";
                $commentid = $row['commentid'];
                $_SESSION['cid'] = $commentid;
                
                    // searches for new lines in message and converts
                    // them to proper breaks 
                    echo nl2br($row['comment']);
                    echo "<br>";
                   // echo "<button class='commentedit' type='submit' name='commentEdit'  value = $commentid >Comment</button>"; 
                
             // echo '<h3><a href="event_comments.php? varname= '$commentid'">Display</a></h3> ';
            
              echo'<td><h3><a href="comment_edit.php?commentid='.$commentid.'">Edit Comment</a></h3></td></tr>';
                
              
                 // echo '<a href="example.php?attribute='.$row1['att2'].'">'.$row1['att2'].'</a>';
                   // echo <a></a>
                echo "<p></div>";

            }
        } else{
            echo "No comments have been made. Be the first to comment now!";
        }
    }

// Query and code to set event details!!!!!!!!!!!
  

        
        
        // $eid = $_SESSION['eid'];
        $sql = "SELECT * FROM events WHERE eid = '$eid'";
        $result = mysqli_query($mysqli, $sql);
        
        if(mysqli_num_rows($result) > 0 ){
            $row = $result ->fetch_assoc(); 
                
            $description = $row['description'];
            $location = $row['location'];
            $eventTime = $row['time'];
            //$uid = $row['uid'];
            $rsoID = $row['rsoid'];
            $aid = $row['aid'];
            
        }else{
            echo "No event with that Event ID Exists!";
        }
    

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the Document</title>
<link rel="stylesheet" type="text/css" href="../Navbar/Signup/signupStyle.css">
    <style>
        *{
            margin: auto;
        }
       
   
textarea{
    width: 50%;
    margin-top: 3%;
    margin-left: 25%;
    margin-bottom: 0%;
    height: 80px;
    background-color: #333;
    resize:none;
}

.commentsubmit {
    width: 100px;
    height: 30px;
    margin-left: 25%;
    margin-bottom: 2%;
    background-color: #333;
    border: none;
    color: #fff;
    font-family: arial;
    font-weight: 400;
    cursor: pointer;
    
}

.commentedit{
    width: 150px;
    height: 20px;
    margin-left: 0%;
    margin-bottom: 0%;
    background-color: #333;
    border: none;
    color: #fff;
    font-family: arial;
    font-weight: 400;
    cursor: pointer;
        }

.comment-box{
    width: 40%;
    padding: 20px;
    padding-bottom: 10px;
    margin-bottom: 4px;
    background-color: #fff;
    border-radius: 4px;
}

.comment-box p{
    font-family: arial;
    font-size: 14px;
    line-height: 16px;
    color: #282828;
    font-weight: 100;
}
        
 .event-box{
    margin-top: 5%;
    width: 60%;
    padding: 20px;
     padding-top: 2px;
    margin-bottom: 4px;
    background-color: #333;
    border-radius: 4px;  
}
 .event-box p{
     
    font-family: arial;
    font-size: 14px;
    line-height: 16px;
    color: #fff;
    font-weight: 100; 
     
        }
        
ul{
   margin-left: none; 
    text-align: left;
    list-style: none;
        }
        
     h3   a{
    width: 100px;
    height: 30px;
    font-size: 11px;
    margin-left: -2%;
    margin-bottom: 0%;
    padding: 6px;
    padding-left: 5%;
    padding-right: 5%;        
    background-color: #333;
    border: none;
    color: #fff;
    font-family: arial;
    font-weight: 400;
    cursor: pointer;  
    text-decoration: none;
        }
    
    </style>
</head>
    
<body>
    
   

    
<?php // $mysqli is a variable outside of function
   
    //echo "$description <br>";
    //echo  "$location <br>";
    //echo  "$eventTime <br>";
    //echo   "$uid <br>";
    //echo   "$rsoID <br>";
    //echo   "$aid <br>";
     
   // echo "<h1>Event Details</h1>";
    echo "<div class='event-box'><p>";
            echo "<ul id='eventdetails'>";    
                echo "<h1>Event Details</h1>";
                echo "<li>Event Location: $location</li><br><br>";
                echo "<li>Event Time: $eventTime</li><br><br>";
                echo "<li>Event RSO: $rsoID</li><br><br>";
                echo "<li>Event AdminID: $aid</li><br><br>";
                echo "<li>Event Description:";
                echo nl2br($description)."<br>"; 
                    //echo $eventTime."<br>";
                    //echo $rsoID."<br>";
                    //echo $aid."<br>";
                    //echo nl2br($description); 
            echo "</ul>";
                echo "<p></div>";
    
   /* echo"
    <h1>Event Details</h1>
    <ul>
        <li>Event Description: $description</li>
        <li>Event Location: $location</li>
        <li>Event Time: $eventTime</li>
        <li>RSO ID: $rsoID</li>
        <li>Admin ID: $aid</li>
    </ul>
    ";
    */
    
   echo" <form method='POST' action='".setComments($mysqli)."'>
        <input type='hidden' name='uid' value='Anonymous'>
        <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
        <textarea name='message'></textarea><br>
        <button class='commentsubmit' type='submit' name='commentSubmit'>Comment</button>
    </form>";
    
getComments($mysqli)

?>
</body>

</html>