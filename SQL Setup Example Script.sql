# Create the users
INSERT INTO user (name, password, phone, email)
VALUES ('user', 'user', '1111111111', 'user@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user2', 'user', '1111111111', 'user2@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user3', 'user', '1111111111', 'user3@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user4', 'user', '1111111111', 'user4@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user5', 'user', '1111111111', 'user5@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user6', 'user', '1111111111', 'user6@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user7', 'user', '1111111111', 'user7@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user8', 'user', '1111111111', 'user8@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user9', 'user', '1111111111', 'user9@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user10', 'user', '1111111111', 'user10@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user11', 'user', '1111111111', 'user11@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user12', 'user', '1111111111', 'user12@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user13', 'user', '1111111111', 'user13@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user14', 'user', '1111111111', 'user14@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user15', 'user', '1111111111', 'user15@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user16', 'user', '1111111111', 'user16@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user17', 'user', '1111111111', 'user17@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user18', 'user', '1111111111', 'user18@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user19', 'user', '1111111111', 'user19@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('user20', 'user', '1111111111', 'user20@knights.ucf.edu');

INSERT INTO user (name, password, phone, email)
VALUES ('admin', 'admin', '2222222222', 'admin@knights.ucf.edu');

INSERT INTO admin (SELECT uid FROM user where name = 'admin');

INSERT INTO user (name, password, phone, email)
VALUES ('admin2', 'admin2', '2222222222', 'admin2@valencia.edu');

INSERT INTO admin (SELECT uid FROM user where name = 'admin2');

INSERT INTO user (name, password, phone, email)
VALUES ('admin3', 'admin', '2222222222', 'admin3@valencia.edu');

INSERT INTO admin (SELECT uid FROM user where name = 'admin3');

INSERT INTO user (name, password, phone, email)
VALUES ('superadmin', 'superadmin', '3333333333', 'superadmin@ucf.edu');

INSERT INTO superadmin (SELECT uid FROM user where name = 'superadmin');

INSERT INTO user (name, password, phone, email)
VALUES ('superadminv', 'superadmin', '3333333333', 'superadmin@valencia.edu');

INSERT INTO superadmin (SELECT uid FROM user where name = 'superadminv');

# Create the RSOs
INSERT INTO rso (name)
VALUES ('Database Group');

INSERT INTO rso (name)
VALUES ('Fun Group');

INSERT INTO rso (name)
VALUES ('Serious Group');

# Create the Universities
INSERT INTO university (name, location, description, noofstudents)
VALUES ('University of Central Florida', 'Orlando, FL', 'Founded in 1963 as the Florida Technological University, this university has grown exponentially.', 64000);

INSERT INTO university (name, location, description, noofstudents)
VALUES ('Valencia Community College', 'Orlando, FL', 'Community College.', 10000);

# Create the RSO Affiliations
INSERT INTO rsoaffiliation (rsoid, univid)
VALUES ((SELECT rsoid FROM rso WHERE name = 'Database Group'), (SELECT univid FROM university WHERE name = 'University of Central Florida'));

INSERT INTO rsoaffiliation (rsoid, univid)
VALUES ((SELECT rsoid FROM rso WHERE name = 'Fun Group'), (SELECT univid FROM university WHERE name = 'Valencia Community College'));

INSERT INTO rsoaffiliation (rsoid, univid)
VALUES ((SELECT rsoid FROM rso WHERE name = 'Serious Group'), (SELECT univid FROM university WHERE name = 'Valencia Community College'));

# Insert admin in manages table
INSERT INTO manages (aid, rsoid)
VALUES ((SELECT aid FROM admin a INNER JOIN user u on u.uid= a.aid WHERE u.name = 'admin'), (SELECT rsoid FROM rso WHERE name = 'Database Group'));

INSERT INTO manages (aid, rsoid)
VALUES ((SELECT aid FROM admin a INNER JOIN user u on u.uid= a.aid WHERE u.name = 'admin2'), (SELECT rsoid FROM rso WHERE name = 'Fun Group'));

INSERT INTO manages (aid, rsoid)
VALUES ((SELECT aid FROM admin a INNER JOIN user u on u.uid= a.aid WHERE u.name = 'admin3'), (SELECT rsoid FROM rso WHERE name = 'Serious Group'));

# Insert members into memberof table
INSERT INTO memberof (uid, rsoid)
VALUES ((SELECT uid FROM user WHERE name = 'user'), (SELECT rsoid FROM rso WHERE name = 'Database Group'));

INSERT INTO memberof (uid, rsoid)
VALUES ((SELECT uid FROM user WHERE name = 'user2'), (SELECT rsoid FROM rso WHERE name = 'Database Group'));

INSERT INTO memberof (uid, rsoid)
VALUES ((SELECT uid FROM user WHERE name = 'user3'), (SELECT rsoid FROM rso WHERE name = 'Fun Group'));

INSERT INTO memberof (uid, rsoid)
VALUES ((SELECT uid FROM user WHERE name = 'user4'), (SELECT rsoid FROM rso WHERE name = 'Fun Group'));

INSERT INTO memberof (uid, rsoid)
VALUES ((SELECT uid FROM user WHERE name = 'user5'), (SELECT rsoid FROM rso WHERE name = 'Serious Group'));

INSERT INTO memberof (uid, rsoid)
VALUES ((SELECT uid FROM user WHERE name = 'user6'), (SELECT rsoid FROM rso WHERE name = 'Serious Group'));

INSERT INTO memberof (uid, rsoid)
VALUES ((SELECT aid FROM admin a INNER JOIN user u on u.uid= a.aid WHERE u.name = 'admin'), (SELECT rsoid FROM rso WHERE name = 'Database Group'));

INSERT INTO memberof (uid, rsoid)
VALUES ((SELECT aid FROM admin a INNER JOIN user u on u.uid= a.aid WHERE u.name = 'admin2'), (SELECT rsoid FROM rso WHERE name = 'Fun Group'));

INSERT INTO memberof (uid, rsoid)
VALUES ((SELECT aid FROM admin a INNER JOIN user u on u.uid= a.aid WHERE u.name = 'admin3'), (SELECT rsoid FROM rso WHERE name = 'Serious Group'));

# Create the events
INSERT INTO events (aid, rsoid, description, time, venuetype, eventtype, location, lat, lng)
VALUES ((SELECT aid FROM admin a INNER JOIN user u on u.uid= a.aid WHERE u.name = 'admin'), (SELECT rsoid FROM rso WHERE name = 'Database Group'),
 'We learn how DBs work!', '2017-4-7 12:30:00', 'Educational', 'RSO', 'Orlando, FL', '28.6024274', '-81.2000599');
 
INSERT INTO events (aid, description, time, venuetype, eventtype, location)
VALUES ((SELECT aid FROM admin a INNER JOIN user u on u.uid= a.aid WHERE u.name = 'admin'),
 'Introductions', '2017-4-1 15:30:00', 'Social', 'Public', 'Orlando, FL');
 
INSERT INTO events (aid, rsoid, description, time, venuetype, eventtype, location, lat, lng)
VALUES ((SELECT aid FROM admin a INNER JOIN user u on u.uid= a.aid WHERE u.name = 'admin'), (SELECT rsoid FROM rso WHERE name = 'Database Group'),
 'Officers Meeting', '2017-4-5 12:30:00', 'Administrative', 'Private', 'Orlando, FL', '28.6024274', '-81.2000599');
 
INSERT INTO events (aid, rsoid, description, time, venuetype, eventtype, location, lat, lng)
VALUES ((SELECT aid FROM admin a INNER JOIN user u on u.uid= a.aid WHERE u.name = 'admin2'), (SELECT rsoid FROM rso WHERE name = 'Fun Group'),
 'Dance Off', '2017-4-2 12:30:00', 'Social', 'Public', 'Orlando, FL', '28.5230', '81.4634');
 
INSERT INTO events (aid, rsoid, description, time, venuetype, eventtype, location, lat, lng)
VALUES ((SELECT aid FROM admin a INNER JOIN user u on u.uid= a.aid WHERE u.name = 'admin3'), (SELECT rsoid FROM rso WHERE name = 'Serious Group'),
 'Political Climate in America', '2017-4-3 12:30:00', 'Educational', 'RSO', 'Orlando, FL', '28.5230', '81.4634');

# Create a comment; In the actual site, comments would not be submitted this way, the PHP would hold the eid and user variables.
INSERT INTO comment (uid, eid, rating, comment)
VALUES ((SELECT uid FROM user WHERE name = 'user'), (SELECT eid FROM events WHERE description = 'We learn how DBs work!'), 5, 'Great experience!');

INSERT INTO comment (uid, eid, rating, comment)
VALUES ((SELECT uid FROM user WHERE name = 'user2'), (SELECT eid FROM events WHERE description = 'Introductions'), 5, 'Nice way to network!');

INSERT INTO comment (uid, eid, rating, comment)
VALUES ((SELECT uid FROM user WHERE name = 'user3'), (SELECT eid FROM events WHERE description = 'We learn how DBs work!'), 5, 'Great experience!');

INSERT INTO comment (uid, eid, rating, comment)
VALUES ((SELECT uid FROM user WHERE name = 'user4'), (SELECT eid FROM events WHERE description = 'Dance Off'), 1, 'The venue smelled so musty. People need deodorant. SAD!');

INSERT INTO comment (uid, eid, rating, comment)
VALUES ((SELECT uid FROM user WHERE name = 'user5'), (SELECT eid FROM events WHERE description = 'Political Climate in America'), 4, 'Discourse got a bit tense, but a great experience overall.');

# Approve events
UPDATE events
SET approved = TRUE
WHERE description IN ('Introductions', 'We learn how DBs work!', 'Dance Off', 'Political Climate in America');