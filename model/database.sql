drop database if exists wad2proj;

create database wad2proj;
use wad2proj;

CREATE TABLE IF NOT EXISTS user (
    userid int NOT NULL auto_increment,
	name varchar(128) NOT NULL,
    password varchar(128) NOT NULL,
    email varchar(128) NOT null,
    address varchar(128),
	country varchar(28),
    gender varchar(28),
    phone varchar(28) not null,
    personType varchar(28) not null,
    PRIMARY KEY(userid)
);

CREATE TABLE IF NOT EXISTS role (
	rolename varchar(28) not null,
	userid int NOT NULL,
	PRIMARY KEY(rolename, userid),
    foreign key (userid) references user(userid)
);

CREATE TABLE IF NOT EXISTS profile (
	profileid int NOT NULL auto_increment,
	userid int NOT NULL,
    skills varchar(128) not null,
    bio varchar(600),
    profilepic varchar(600),
    portfoliolink varchar(600),
    portfoliopath varchar(600),
    primary key(profileid),
    foreign key (userid) references user(userid)
);

CREATE TABLE IF NOT EXISTS education (
	eduid int NOT NULL auto_increment,
	profileid varchar(28) not null,
    school varchar(128) not null,
    coursename varchar(128) not null,
    startdate date,
    enddate date not null,
    primary key(eduid),
    foreign key (profileid) references profile(profileid)
);

CREATE TABLE IF NOT EXISTS professionalcerts (
	certsid int NOT NULL auto_increment,
	profileid varchar(28) not null,
    certname varchar(128) not null,
    completiondate date not null,
    primary key(certsid),
    foreign key (profileid) references profile(profileid)
);

CREATE TABLE IF NOT EXISTS projects (
	projectid int NOT NULL auto_increment,
    projectname varchar(56) not null,
	profileid varchar(28) not null,
    description varchar(600),
    photopath varchar(600),
    projectlink varchar(600),
    primary key(projectid),
    foreign key (profileid) references profile(profileid)
);

CREATE TABLE IF NOT EXISTS job (
	jobid int NOT NULL auto_increment,
    jobname varchar(128) not null,
	jobdesc varchar(600),
    rolerequired varchar(128),
    picturepath varchar(600),
    skills varchar(600),
	startdate date,
    enddate date,
    address varchar(600),
	createuserid int not null,
    createdate date not null,
    listingstatus varchar(28) not null,
    primary key(jobid),
	foreign key(createuserid) references user(userid)
);

CREATE TABLE IF NOT EXISTS applylisting (
	applyid int NOT NULL auto_increment,
	jobid varchar(28) not null,
    userid int not null,
    applydate date not null,
    applicationstatus varchar(28) not null,
    primary key(applyid),
	foreign key (userid) references user(userid),
	foreign key (jobid) references user(jobid)
);

CREATE TABLE IF NOT EXISTS likelisting (
	jobid varchar(28) not null,
    userid int not null,
	is_liked bool,
    primary key(jobid, userid),
	foreign key (userid) references user(userid),
	foreign key (jobid) references user(jobid)
);

INSERT INTO user (name, password, email, address, country, gender, phone, personType) 
VALUES ('Mary', 'password', 'mary@gmail.com', 'Blk 1 ABC Road Singapore 111111', 'Singapore', 'F', '99999999', 'P');
INSERT INTO user (name, password, email, address, country, gender, phone, personType) 
VALUES ('The Company', 'password1', 'company@gmail.com', 'Blk 2 DEF Road Singapore 111111', 'Singapore', null, '88888888', 'C');

INSERT INTO role (rolename, userid) VALUES ('Photographer', 1);
INSERT INTO role (rolename, userid) VALUES ('Videographer', 1);
INSERT INTO role (rolename, userid) VALUES ('Photo editor', 2);

INSERT INTO profile (userid, skills, bio, profilepic, portfoliolink, portfoliopath)
VALUES (1, 'photography, videography, photo editing', 'Best CameraWoman in SG', '/profile/profilepic.png', 'www.marythebest.com', '/profile/maryportfolio.pdf');
INSERT INTO profile (userid, skills, bio, profilepic, portfoliolink)
VALUES (2, 'photo editing', 'Best company in the world', '/profile/companypic.png', 'www.company.com');

INSERT INTO education (profileid, school, coursename, startdate, enddate) 
VALUES (1, 'SMU', 'Photography 101', '2020-11-11', '2021-11-11');
INSERT INTO education (profileid, school, coursename, startdate, enddate) 
VALUES (1, 'NAFA', 'Diploma in Videography', '2010-11-11', '2011-11-11');

INSERT INTO professionalcerts (profileid, certname, completiondate)
VALUES (1, 'Certificate of Accomplishment in Photos', '2019-01-31');

INSERT INTO projects (profileid, projectname, description, photopath, projectlink)
VALUES (1, 'Wedding', "Client's wedding on 11 September. I was in charge of photo taking.", "profile/projects/1", "www.facebook.com/wedding");
INSERT INTO projects (profileid, projectname, description, photopath, projectlink)
VALUES (2, 'Photoshoot', "20 Models to take photo", "profile/projects/2", "www.company.com/photoshoot");

INSERT INTO job (jobname, jobdesc, rolerequired, picturepath, skills, startdate, enddate, address, createuserid, createdate, listingstatus)
VALUES ('AmazingPhotographer', 'take photo of homo sapiens for 2 day event', 'photographer', null, 'knowledge of using camera', '2021-02-22', '2021-02-23', '12 imlost road #01-00 Singapore 000000', 2, '2020-03-01', 'open');
INSERT INTO job (jobname, jobdesc, rolerequired, picturepath, skills, startdate, enddate, address, createuserid, createdate, listingstatus)
VALUES ('WonderfulVideographer', 'film homo sapiens for 2 day event', 'videographer', null, 'knowledge of using camera', '2021-02-22', '2021-02-23', '12 imlost road #01-00 Singapore 000000', 2, '2020-04-21', 'closed');

INSERT INTO applylisting (jobid, userid, applydate, applicationstatus)
VALUES (1, 1, '2021-01-16', 'submitted');
INSERT INTO applylisting (jobid, userid, applydate, applicationstatus)
VALUES (2, 1, '2020-01-16', 'accepted');

INSERT INTO likelisting (jobid, userid, is_liked) VALUES (1, 1, 1);
