<?php
// session stuff!!!!!!
session_start();
$_SESSION['message'] = '';

//$mysqli = new mysqli('localhost', 'root', '', 'eventdb');
include "../Navbar/includes/dbh.php";

// adds navbar to top of page
include "../Navbar/navbar.php";
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
    ?>
      
    <h1>Create an RSO</h1>
    <form class="form" action="rso_signup.php" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
      <input type="text" placeholder="RSO Name" name="name" required />
      <input type="text" placeholder="University" name="university" required/>
      <p> Five (5) emails with the same domain needed to create RSO </p>
      <input type="email" placeholder="Email (1)" name="email_1" required />
      <input type="email" placeholder="Email (2)" name="email_2" required />
      <input type="email" placeholder="Email (3)" name="email_3" required /> 
      <input type="email" placeholder="Email (4)" name="email_4" required />
      <input type="email" placeholder="Email (5)" name="email_5" required />
      <div class="avatar"></div>    
      <input type="submit" value="Create RSO" name="register" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>
</body>
