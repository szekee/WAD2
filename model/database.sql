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
    phone varchar(28),
    dob datetime,
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
	userid int unique NOT NULL,
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
	profileid int not null,
    school varchar(128) not null,
    coursename varchar(128) not null,
    startdate date,
    enddate date not null,
    primary key(eduid),
    foreign key (profileid) references profile(profileid)
);

CREATE TABLE IF NOT EXISTS professionalcerts (
	certsid int NOT NULL auto_increment,
	profileid int not null,
    certname varchar(128) not null,
    completiondate date not null,
    primary key(certsid),
    foreign key (profileid) references profile(profileid)
);

CREATE TABLE IF NOT EXISTS projects (
	projectid int NOT NULL auto_increment,
    projectname varchar(56) not null,
	profileid int not null,
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
    createdate DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    listingstatus varchar(28) not null,
    primary key(jobid),
	foreign key(createuserid) references user(userid)
);

CREATE TABLE IF NOT EXISTS applylisting (
	applyid int NOT NULL auto_increment,
	jobid int not null,
    userid int not null,
    applydate DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    applicationstatus varchar(28) not null,
    primary key(applyid),
	foreign key (userid) references user(userid),
	foreign key (jobid) references job(jobid) on delete cascade
);

CREATE TABLE IF NOT EXISTS likelisting (
	jobid int not null,
    userid int not null,
	is_liked boolean,
    primary key(jobid, userid),
	foreign key (userid) references user(userid),
	foreign key (jobid) references job(jobid) on delete cascade
);

INSERT INTO user (name, password, email, address, country, gender, phone, dob) 
VALUES ('mary', 'password', 'mary@gmail.com', 'Blk 1 ABC Road Singapore 111111', 'Singapore', 'F', '99999999', '2009-02-23');
INSERT INTO user (name, password, email, address, country, gender, phone, dob) 
VALUES ('The company', 'password1', 'company@gmail.com', 'Blk 2 DEF Road Singapore 111111', 'Singapore', null, '88888888', '2000-02-23');
INSERT INTO user (name, password, email, address, country, gender, phone, dob) 
VALUES ('John', 'password3', 'john@gmail.com', 'Blk 3 EFG Road Singapore 111111', 'Singapore', 'M', '77777777', '1988-02-23');

INSERT INTO role (rolename, userid) VALUES ('photographer', 1);
INSERT INTO role (rolename, userid) VALUES ('videographer', 1);
INSERT INTO role (rolename, userid) VALUES ('photo editor', 2);

INSERT INTO profile (userid, skills, bio, profilepic, portfoliolink, portfoliopath)
VALUES (1, 'photography, videography, photo editing', 'Best CameraWoman in SG',  'profilepic.png', 'www.marythebest.com', '/profile/maryportfolio.pdf');
INSERT INTO profile (userid, skills, bio, profilepic, portfoliolink)
VALUES (2, 'photo editing', 'Best company in the world', 'profilepic.png','www.company.com');

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
VALUES ('AmazingPhotographer', 'take photo of homo sapiens for 2 day event', 'photographer', 'sun-photo.jpeg', 'knowledge of using camera', '2021-02-22', '2021-02-23', ' 5001 Beach Rd #08-31 Singapore 199588', 2, '2020-03-01 17:00:00', 'Open');
INSERT INTO job (jobname, jobdesc, rolerequired, picturepath, skills, startdate, enddate, address, createuserid, createdate, listingstatus)
VALUES ('WonderfulVideographer', 'film homo sapiens for 2 day event', 'videographer', 'shutterstock_1316889752.jpeg', 'knowledge of using camera', '2021-02-22', '2021-02-23', '20 Maxwell Rd #09-17 Maxwell Hse Singapore 069113', 2, '2020-04-21 17:00:00', 'Closed');
INSERT INTO job (jobname, jobdesc, rolerequired, picturepath, skills, startdate, enddate, address, createuserid, createdate, listingstatus)
VALUES ('FantasticModel', 'pose like homo sapiens for 2 day event', 'model', 'photo_2021-09-13_13-57-23.jpg', 'posing glamourously', '2021-02-22', '2021-02-23', 'Robinson Road No 66 Singapore 984438', 2, '2020-03-01 17:00:00', 'Open');
INSERT INTO job (jobname, jobdesc, rolerequired, picturepath, skills, startdate, enddate, address, createuserid, createdate, listingstatus)
VALUES ('TalentedActress', 'act as mother for 2 day event', 'actress', 'matheus-ferrero-W7b3eDUb_2I-unsplash.jpg', 'acting realistically', '2021-02-22', '2021-02-23', '80 Mandai Lake Rd, Singapore 729826', 2, '2020-04-21 17:00:00', 'Open');
INSERT INTO job (jobname, jobdesc, rolerequired, picturepath, skills, startdate, enddate, address, createuserid, createdate, listingstatus)
VALUES ('ExperiencedProducer', 'produce cool videos of homo sapiens for 2 day event', 'photographer', 'Film-Production-Company.jpeg', 'knowledge of using camera', '2021-02-22', '2021-02-23', 'Administration Building Singapore Management University 81 Victoria Street Singapore 188065', 2, '2020-03-01 17:00:00', 'Open');
INSERT INTO job (jobname, jobdesc, rolerequired, picturepath, skills, startdate, enddate, address, createuserid, createdate, listingstatus)
VALUES ('JazzySoundProducer', 'produce jazzy sounds for 2 day event', 'videographer', 'Engineer_at_audio_console_at_Danish_Broadcasting_Corporation.png', 'knowledge of using camera', '2021-02-22', '2021-02-23', 'Singapore Management University Lee Kong Chian School of Business 50 Stamford Road Singapore 178899', 2, '2020-04-21 17:00:00', 'Closed');
INSERT INTO job (jobname, jobdesc, rolerequired, picturepath, skills, startdate, enddate, address, createuserid, createdate, listingstatus)
VALUES ('ChildActor', 'pose like homo sapiens for 2 day event', 'model', '13SCENE-articleLarge.jpeg', 'posing glamourously', '2021-02-22', '2021-02-23', 'Singapore Management University School of Computing and Information Systems 80 Stamford Road Singapore 178902', 2, '2020-03-01 17:00:00', 'Open');
INSERT INTO job (jobname, jobdesc, rolerequired, picturepath, skills, startdate, enddate, address, createuserid, createdate, listingstatus)
VALUES ('MakeUpArtist', 'make homo sapiens pretty for 2 day event', 'actress', 'makeupartist.jpeg', 'acting realistically', '2021-02-22', '2021-02-23', 'Singapore Management University School of Economics 90 Stamford Road Singapore 178903', 2, '2020-04-21 17:00:00', 'Closed');


INSERT INTO applylisting (jobid, userid, applydate, applicationstatus)
VALUES (1, 1, '2021-01-16', 'Submitted');
INSERT INTO applylisting (jobid, userid, applydate, applicationstatus)
VALUES (1, 2, '2020-01-16', 'Accepted');
INSERT INTO applylisting (jobid, userid, applydate, applicationstatus)
VALUES (2, 2, '2020-01-16', 'Submitted');
INSERT INTO applylisting (jobid, userid, applydate, applicationstatus)
VALUES (3, 2, '2020-01-16', 'Accepted');
INSERT INTO applylisting (jobid, userid, applydate, applicationstatus)
VALUES (4, 2, '2020-01-16', 'Submitted');

INSERT INTO likelisting (jobid, userid, is_liked) VALUES (1, 1, 1);
INSERT INTO likelisting (jobid, userid, is_liked) VALUES (2, 1, 1);
INSERT INTO likelisting (jobid, userid, is_liked) VALUES (1, 2, 1);
INSERT INTO likelisting (jobid, userid, is_liked) VALUES (4, 2, 1);
INSERT INTO likelisting (jobid, userid, is_liked) VALUES (5, 2, 1);
INSERT INTO likelisting (jobid, userid, is_liked) VALUES (6, 2, 1);
INSERT INTO likelisting (jobid, userid, is_liked) VALUES (7, 2, 1);
