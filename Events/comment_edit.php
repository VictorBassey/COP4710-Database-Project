<?php
    session_start();
    date_default_timezone_set('America/New_York');
include "../Navbar/navbar.php";    
include '../Navbar/includes/dbh.php';
    
if(isset($_POST['commentDelete'])){
                
        $commentContent = $_SESSION['commentContents'];
        
        $sql = "DELETE FROM comment WHERE comment = '$commentContent'";
        $yes = mysqli_query($mysqli,$sql);
    if(!$yes){
        echo $commentContent;
        echo "did not work";
    }else{
                 ?><script type="text/javascript">location.href = 'public_event.php';</script><?php
    }
            }


if(isset($_POST['commentSubmit'])){
                //header("Location:event_comments.php");
                 ?><script type="text/javascript">location.href = 'public_event.php';</script><?php
            }

    

  function getComment($mysqli){
       // $eid = $_SESSION['eid'];
        // $eid = $_POST['eid'];
        $commentid = $_GET['commentid'];
      //echo $commentid;
      // HAVE TO CHANGE THIS!!!!!!!!!!!!!!!!
        $sql = "SELECT * FROM comment WHERE commentid= '$commentid'";
        $result = mysqli_query($mysqli, $sql);
        // pulls results from the db until there is no 
        // results left
        if(mysqli_num_rows($result)>0){
            $row = $result ->fetch_assoc();
            $commentContents = $row['comment'];
           // echo $commentContents;
            $_SESSION['commentContents'] = $commentContents;
            /*
            while($row = $result ->fetch_assoc()){
                echo "<div class='comment-box'><p>";
                    echo $row['uid']."<br>";
                    echo $row['ctime']."<br>";
                    // searches for new lines in message and converts
                    // them to proper breaks 
                    echo nl2br($row['comment']); 
                echo "<p></div>";

            }
        } else{
            echo "Comment could not be found!";
        }
        */
        } else{
            $commentContents = "Comment could not be found!" ;
            $_SESSION['commentContents'] = $commentContents;
        }
    }

    function setComment($mysqli){
            // checks to see if commentSubmit button has been set
            if(isset($_POST['commentSubmit'])){
                // grabs data from url or Session vars
                $uid = $_SESSION['uid'];
                //$eid = $_SESSION['eid'];
                
                //HAVE TO CHANGE THIS!!!!!!!!!!!!!!!!!!!!!!!!
                $eid = $_SESSION['eid'];
                $commentid = $_GET['commentid'];
                $_SESSION['commentid'] = $commentid;
                $message = $_POST['message'];

                //inserts data to the database
                $sql = "UPDATE comment SET comment = '$message' WHERE comment.commentid = '$commentid'"; 
                

                $result = mysqli_query($mysqli, $sql);
                
               
                
            }
        
            if(isset($_POST['commentSubmit'])){
               // header("Location:event_comments.php");
                ?><script type="text/javascript">location.href = 'public_event.php';</script><?php
            }
            
        }








    $eid = $_SESSION['eid'];
   // echo $eid;
    //echo $_GET['commentid'];
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

$commentContents = $_SESSION['commentContents'];

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
    margin-top: 1%;
    margin-left: 25%;
    margin-bottom: 0%;
    height: 80px;
    background-color: #fff;
    resize:none;
}

.commentsubmit {
    width: 150px;
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
        
        .commentdelete{
          width: 150px;
    height: 30px;
    margin-left: 0%;
    margin-bottom: 2%;
    background-color: #333;
    border: none;
    color: #fff;
    font-family: arial;
    font-weight: 400;
    cursor: pointer;  
        }
h3{
    margin-left: 25%;
    margin-top: 2%;
}
        
.comment-box{
    width: 40%;
    padding: 20px;
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
    margin-bottom: px;
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
    echo "<h3>Change Comment</h3>";
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
   getComment($mysqli);
     $commentContents = $_SESSION['commentContents'];
   // echo $commentContents;
    
   echo" <form method='POST' action='".setComment($mysqli)."'>
        <input type='hidden' name='uid' value='Anonymous'>
        <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
        <textarea name='message' input type ='text' placeholder = '$commentContents' ></textarea><br>
        <button class='commentsubmit' type='submit' name='commentSubmit'>Change Comment</button>
        
        <button class='commentdelete' type='submit' name='commentDelete'>Delete Comment</button>
    </form>";
    

?>
</body>

</html>