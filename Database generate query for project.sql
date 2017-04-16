# SQL commands to create and populate the MySQL database for Group Project
# Victor Bassey
#
# delete the database if it already exists
drop database if exists eventdb;

# create a new database named eventdb
create database eventdb;

# switch to the new database
use eventdb;

#InnoDB is used because that supports foreign key constraints.


CREATE TABLE user (
    uid INTEGER NOT NULL AUTO_INCREMENT,
    password VARCHAR(50) NOT NULL,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(10) NOT NULL,
    email VARCHAR(50) NOT NULL,
    PRIMARY KEY (uid)
)  ENGINE=INNODB;

Create index user_ix1 on user (uid);

CREATE TABLE superadmin (
    said INTEGER,
    PRIMARY KEY (said),
    FOREIGN KEY (said)
        REFERENCES user (uid)
        ON DELETE CASCADE ON UPDATE CASCADE
)  ENGINE=INNODB;

CREATE TABLE admin (
    aid INTEGER,
    PRIMARY KEY (aid),
    FOREIGN KEY (aid)
        REFERENCES user (uid)
        ON DELETE CASCADE ON UPDATE CASCADE
)  ENGINE=INNODB;

Create index admin_ix1 on admin (aid);


CREATE TABLE rso (
    rsoid INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (rsoid)
)  ENGINE=INNODB;

Create index rso_ix1 on rso (rsoid);

CREATE TABLE manages (
    aid INTEGER,
    rsoid INTEGER,
    PRIMARY KEY (aid , rsoid)
)  ENGINE=INNODB;

CREATE TABLE memberof (
    uid INTEGER,
    rsoid INTEGER,
    PRIMARY KEY (uid, rsoid),
    FOREIGN KEY (uid)
        REFERENCES user (uid),
    FOREIGN KEY (rsoid)
        REFERENCES rso (rsoid)
)  ENGINE=INNODB;


CREATE TABLE university (
    univid INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    location VARCHAR(255),
    description VARCHAR(255),
    noofstudents INTEGER,
    PRIMARY KEY (univid)
)  ENGINE=INNODB;

Create index university_ix1 on university (univid);

CREATE TABLE rsoaffiliation (
    rsoid INTEGER,
    univid INTEGER,
    PRIMARY KEY (rsoid, univid),
    FOREIGN KEY (rsoid)
        REFERENCES rso (rsoid),
    FOREIGN KEY (univid)
        REFERENCES university (univid)
)  ENGINE=INNODB;

Create index rsoaff_ix1 on rsoaffiliation (rsoid);

CREATE TABLE events (
    eid INTEGER NOT NULL AUTO_INCREMENT,
    aid INTEGER NOT NULL,
    rsoid INTEGER,
    description VARCHAR(255) NOT NULL,
    time DATETIME NOT NULL,
    venuetype VARCHAR(20) NOT NULL,
    eventtype VARCHAR(20) NOT NULL,
    location VARCHAR(1000) NOT NULL,
    lat FLOAT( 10, 6 ),
    lng FLOAT( 10, 6 ),
    approved BOOLEAN DEFAULT FALSE,
    PRIMARY KEY (eid),
    FOREIGN KEY (aid)
        REFERENCES admin (aid),
	FOREIGN KEY (rsoid)
		REFERENCES rsoaffiliation (rsoid)
)  ENGINE=INNODB;

Create index events_ix1 on events (eid);

CREATE TABLE comment (
    commentid INTEGER NOT NULL AUTO_INCREMENT,
    uid INTEGER NOT NULL,
    eid INTEGER NOT NULL,
    rating INTEGER,
    ctime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    comment VARCHAR(255),
    PRIMARY KEY (commentid),
    FOREIGN KEY (uid)
        REFERENCES user (uid),
    FOREIGN KEY (eid)
        REFERENCES events (eid)
)ENGINE=INNODB;

CREATE TABLE registered (
	eid INTEGER not null,
    uid INTEGER not null,
    PRIMARY KEY (eid, uid),
    FOREIGN KEY (eid)
		REFERENCES events (eid),
	FOREIGN KEY (uid)
		REFERENCES user (uid)
)ENGINE=INNODB;
