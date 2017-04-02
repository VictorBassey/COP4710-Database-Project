Hey guys sorry I couldn't make it to the meeting (had to work) but here's what I got

rso_index.php:
	-shows the list of RSO's and next to each one a button for the user to join
	-clicking the button will get you to rso_join.php

ros_join.php:
	-inserts user and rso into the `memberof` table
	-outputs success message or already joined
	-Two links at the end, one takes you to welcome page other to the RSO list 

rso_create:
	-table to create an rso
	-button takes you to rso_signup.php

rso_signup.php:
	-similar to rso_join (outputs message and shows links for welcome page or create rso)

As of last meeting, the navbar should contain an RSO section with 2 options
1. Create RSO (rso_create) and 2. View RSO's (rso_index)

Lastly, there's a relation in our DB called rsoaffiliate and it takes univid and rsoid
I don't know what it's used for. My guess is that a superadmin can affiliate a university
with an RSO as long as he belongs to the RSO? 
Let me know what it is used for and I can implement it
