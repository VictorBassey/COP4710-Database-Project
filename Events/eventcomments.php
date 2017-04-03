<?php
    session_start();
    date_default_timezone_set('America/New_York');
    include '../Navbar/includes/dbh.php';
    //include '../Navbar/navbar/navbar.php';
    

    // refrences to a variable outside of function $mysqli
    function setComments($mysqli){
        // checks to see if commentSubmit button has been set
        if(isset($_POST['commentSubmit'])){
            // grabs data from url or Session vars
            $uid = $_SESSION['uid'];
            //$eid = $_SESSION['eid'];
            $eid = 1;
            $message = $_POST['message'];

            //inserts data to the database
            $sql = "INSERT INTO comment (uid, eid, comment) 
            Values ('$uid', '$eid', '$message')";

            $result = mysqli_query($mysqli, $sql);
        }
    }

    function getComments($mysqli){
       // $eid = $_SESSION['eid'];
        $eid = 1;
        $sql = "SELECT * FROM comment WHERE eid= '$eid'";
        $result = mysqli_query($mysqli, $sql);
        // pulls results from the db until there is no 
        // results left
        if(mysqli_num_rows($result)>0){
        
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
            echo "No comments have been made. Be the first to comment now!";
        }
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
        body{
            
        }
   
textarea{
    width: 50%;
    margin-top: 10%;
    margin-left: 25%;
    margin-bottom: 0%;
    height: 80px;
    background-color: #fff;
    resize:none;
}

button {
    width: 100px;
    height: 30px;
    margin-left: 25%;
    margin-bottom: 5%;
    background-color: #282828;
    border: none;
    color: #fff;
    font-family: arial;
    font-weight: 400;
    cursor: pointer;
    
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
    
    </style>
</head>
    
<body>
    
   

    
<?php // $mysqli is a variable outside of function
   echo" <form method='POST' action='".setComments($mysqli)."'>
        <input type='hidden' name='uid' value='Anonymous'>
        <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
        <textarea name='message'></textarea><br>
        <button type='submit' name='commentSubmit'>Comment</button>
    </form>";
    
getComments($mysqli)
?>
</body>

</html>