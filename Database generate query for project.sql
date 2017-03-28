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


create table user (
    uid integer not null auto_increment,
    password varchar(50) not null,
    name varchar(255) not null,
    phone varchar(10) not null,
    email varchar(50) not null,
    primary key (uid)
)ENGINE=INNODB;

Create index user_ix1 on user (uid);

create table superadmin (
	said integer,
    primary key (said),
    foreign key (said)
		references user (uid)
        on delete cascade on update cascade
)ENGINE=INNODB;

create table admin (
	aid integer,
    primary key (aid),
    foreign key (aid)
		references user (uid)
        on delete cascade on update cascade
)ENGINE=INNODB;

Create index admin_ix1 on admin (aid);

create table events (
	eid integer not null auto_increment,
    description varchar(255) not null,
    time datetime not null,
    venuetype varchar(20) not null,
    eventtype varchar(20) not null,
    location varchar(255) not null,
    approved boolean,
    primary key (eid)
)ENGINE=INNODB;

Create index events_ix1 on events (eid);

create table comment (
	commentid integer not null auto_increment,
    uid integer,
    eid integer,
    rating integer,
    ctime timestamp,
    comment varchar(255),
    primary key (commentid),
    foreign key (uid)
		references user (uid)
        on delete cascade on update cascade,
	foreign key (eid)
		references events (eid)
        on delete cascade on update cascade
)ENGINE=INNODB;


create table rso (
	rsoid integer not null auto_increment,
    name varchar(255),
    primary key (rsoid)
)ENGINE=INNODB;

Create index rso_ix1 on rso (rsoid);

create table manages (
	aid integer,
    rsoid integer,
    primary key (aid, rsoid)
)ENGINE=INNODB;

create table memberof (
	uid integer,
    rsoid integer,
    primary key (uid),
    foreign key (uid)
		references user (uid)
        on delete cascade on update cascade,
	foreign key (rsoid)
		references rso (rsoid)
        on delete cascade on update cascade
)ENGINE=INNODB;

create table createevent (
	aid integer,
    eid integer,
    primary key (aid),
    foreign key (aid)
		references admin (aid)
		on delete cascade on update cascade,
	foreign key (eid)
		references events (eid)
        on delete cascade on update cascade
)ENGINE=INNODB;

create table university (
	univid integer not null auto_increment,
    name varchar (255),
    location varchar (255),
    description varchar (255),
    noofstudents integer,
    primary key (univid)
)ENGINE=INNODB;

Create index university_ix1 on university (univid);

create table rsoaffiliation (
	rsoid integer,
    univid integer,
    foreign key (rsoid)
		references rso (rsoid)
		on delete cascade on update cascade,
	foreign key (univid)
		references university (univid)
        on delete cascade on update cascade
)ENGINE=INNODB;
