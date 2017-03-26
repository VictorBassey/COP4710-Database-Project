<?php	
	function displayNav($filename, $tabname){
		//always call session_start() before accessing any session variables
		if (session_status() == PHP_SESSION_NONE) {
   			session_start();
		}
		
		echo '
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <a class="navbar-brand" href="index.php">UCFEvents</a>
			</div>
			<div>
			  <ul class="nav navbar-nav">';
		
		//these arrrays need to be editted if a new tab is created
		/*
			*******To add a new page to the navbar********
			create a tab name and add it to tab_array
			add php filename to file_array
			make sure to increase the index limit in the for loop
		*/
		$tab_array = array("Home", "Events", "RSOs", "Gallery");
		$file_array = array("index.php", "events.php", "findRSO.php", "gallery.php");
		
		$active = "";
		for($i = 0; $i<4; $i++){
			if( !strcmp($tabname, $tab_array[$i]) ){
				$active = ' class="active"';
			}else{
				$active = '';
			}
			echo "<li$active><a href={$file_array[$i]}>{$tab_array[$i]}</a></li>\n";
			
		}
		echo '</ul>
			  <ul class="nav navbar-nav navbar-right">';
		
		
		
		//check signup/login active
		$active1 = '';
		$active2 = '';
    if(isset($_SESSION['UserEmail']))
    {
      //print event panel
      if(!strcmp($filename, "eventPanel.php")){
        $active = ' class="active"';
      }else{
        $active = '';
      }
      echo "<li$active><a href='eventPanel.php'>Event Panel</a></li>";
      
      //print super admin panel
      if($_SESSION['isSuperAdmin'] == 'Y'){
        if(!strcmp($filename, "superadmin.php")){
          $active = ' class="active"';
        }else{
          $active = '';
        }
        echo "<li$active><a href='superadmin.php'>Super Admin Panel</a></li>";
      }
      
      //print logout
      echo "<li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
    }else{
      if(!strcmp($filename, "register.php")){
        $active1 = ' class="active"';
      }else if(!strcmp($filename, "login.php")){
        $active2 = ' class="active"';
      }
      echo "<li$active1><a href='register.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>";
			echo "<li$active2><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
    }
		
		echo	  "</ul>
>>>>>>> origin/test
			</div>
		  </div>
		</nav>";
		
	}
?>