# Create the users
INSERT INTO user (password, name, phone, email)
VALUES ('user', 'user', '1111111111', 'user@knights.ucf.edu');

INSERT INTO user (password, name, phone, email)
VALUES ('admin', 'admin', '2222222222', 'admin@knights.ucf.edu');

INSERT INTO admin (SELECT uid FROM user where name = 'admin');

INSERT INTO user (password, name, phone, email)
VALUES ('superadmin', 'superadmin', '3333333333', 'superadmin@ucf.edu');

INSERT INTO superadmin (SELECT uid FROM user where name = 'superadmin');

# Create the RSO
INSERT INTO rso (name)
VALUES ('Database Group');

# Create the University
INSERT INTO university (name, location, description, noofstudents)
VALUES ('University of Central Florida', 'Orlando, FL', 'Founded in 1963 as the Florida Technological University, this university has grown exponentially.', 64000);

# Create the RSO Affiliation
INSERT INTO rsoaffiliation (rsoid, univid)
VALUES ((SELECT rsoid FROM rso WHERE name = 'Database Group'), (SELECT univid FROM university WHERE name = 'University of Central Florida'));

# Insert admin in manages table
INSERT INTO manages (aid, rsoid)
VALUES ((SELECT aid FROM admin a INNER JOIN user u on u.uid= a.aid WHERE u.name = 'admin'), (SELECT rsoid FROM rso WHERE name = 'Database Group'));

# Insert members into memberof table
INSERT INTO memberof (uid, rsoid)
VALUES ((SELECT uid FROM user WHERE name = 'user'), (SELECT rsoid FROM rso WHERE name = 'Database Group'));

INSERT INTO memberof (uid, rsoid)
VALUES ((SELECT aid FROM admin a INNER JOIN user u on u.uid= a.aid WHERE u.name = 'admin'), (SELECT rsoid FROM rso WHERE name = 'Database Group'));

# Create the events
INSERT INTO events (aid, rsoid, description, time, venuetype, eventtype, location)
VALUES ((SELECT aid FROM admin a INNER JOIN user u on u.uid= a.aid WHERE u.name = 'admin'), (SELECT rsoid FROM rso WHERE name = 'Database Group'),
 'We learn how DBs work!', '2017-4-7 12:30:00', 'Educational', 'RSO', 'Orlando, FL');
 
INSERT INTO events (aid, description, time, venuetype, eventtype, location)
VALUES ((SELECT aid FROM admin a INNER JOIN user u on u.uid= a.aid WHERE u.name = 'admin'),
 'Introductions', '2017-4-1 15:30:00', 'Social', 'Public', 'Orlando, FL');
 
INSERT INTO events (aid, rsoid, description, time, venuetype, eventtype, location)
VALUES ((SELECT aid FROM admin a INNER JOIN user u on u.uid= a.aid WHERE u.name = 'admin'), (SELECT rsoid FROM rso WHERE name = 'Database Group'),
 'Officers Meeting', '2017-4-5 12:30:00', 'Administrative', 'Private', 'Orlando, FL');

# Create a comment
INSERT INTO comment (uid, eid, rating, comment)
VALUES ((SELECT uid FROM user WHERE name = 'user'), (SELECT eid FROM events WHERE description = 'We learn how DBs work!'), 5, 'Great experience!');

# Approve events
UPDATE events
SET approved = TRUE
WHERE description IN ('Introductions', 'We learn how DBs work!');