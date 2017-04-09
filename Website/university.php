<?php

	//This php file connects to the database
	session_start();
include '../navbar/includes/dbh.php';
	include '../navbar/navbar.php';
	
	
	
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name="University" content="This web page is for super admins to view and submit universities.">
        
        <title>University Page</title>
        
        <style>
            
		
            body
            {
                width: 80%;
                margin: 0 auto;
                font-family:Arial,Helvetica,sans-serif;
                font-size: 1em;
				text-align: center;
				background:url('http://clevertechie.com/img/bnet-bg.jpg') #0f2439 no-repeat center top;
            }

            
            h1 
            {
                font-family: Georgia, "Times New Roman", serif;
                font-size: 2em;
                font-weight: bold;
                font-style: bold;
            }
            
            h2
            {
                color:red;
                font-weight:normal;
            }
            
            p
            {
                line-height: 1.6;
                text-align: justify;
            }
			
			table 
			{
				border: 2px solid red;
				background-color: #FFC;
			}
            
			th 
			{
				border-bottom: 5px solid #000;
			}
			
			td
			{
				border-bottom: 2px solid #666;
			}
			
			
			.button 
			{
				font: bold 15px Arial;
				text-decoration: none;
				background-color: #EEEEEE;
				color: #333333;
				padding: 2px 6px 2px 6px;
				border-top: 1px solid #CCCCCC;
				border-right: 1px solid #333333;
				border-bottom: 1px solid #333333;
				border-left: 1px solid #CCCCCC;
			}
			
			
        </style>
    </head>
    <body>
        
        <h1 id="top"> Universities</h1>
        
             
        <main role = "main">
        <article role = "article">
		
		<!--This link is formatted as a button.-->
		<!--When clicked, users will be sent to the submission page for universities-->
		 <a href="submit.php" class = "button" title="University Submission Page">Submit your university!</a> 
		
		
		
		<section>
        <h2 id="uni">University Information</h2>
		<div class="center-div td-center" style="width: 500px;">
			<?php
				
				
				//Sets variable to a query
				$getInfo = "SELECT * FROM university";
				
				//Makes the query
				$data = mysqli_query($mysqli, $getInfo) or die('Error getting data');
				
				
				//Sets up the table
				echo "<table>";
				echo "<tr><th>ID</th><th>Name</th><th>Location</th><th>Description</th><th># of Students</th></tr></tr>";
				
				//Loops until all entries in the database are filled into the table
				while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC))
				{
					echo "<tr><td>";
					echo $row['univid'];
					echo "</td><td>";
					echo $row['name'];
					echo "</td><td>";
					echo $row['location'];
					echo "</td><td>";
					echo $row['description'];
					echo "</td><td>";
					echo $row['noofstudents'];
					echo "</td></tr>";
					
				}
				
				//Closes table tab
				echo "</table>";

			?>
		</div>
		</section>		
        <div id = "Bottom">
			<div class="wrap">
				<!--Allows users to quickly go back to the top of the page-->
				<p><a href="#top" title="Back To Top">Back To Top</a></p>
			</div>
        </div>
		</article>
        </main>
    </body>
</html>
