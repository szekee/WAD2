-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: localhost    Database: wad2proj
-- ------------------------------------------------------
-- Server version	8.0.27-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `applylisting`
--

DROP TABLE IF EXISTS `applylisting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applylisting` (
  `applyid` int NOT NULL AUTO_INCREMENT,
  `jobid` int NOT NULL,
  `userid` int NOT NULL,
  `applydate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `applicationstatus` varchar(28) NOT NULL,
  PRIMARY KEY (`applyid`),
  KEY `userid` (`userid`),
  KEY `jobid` (`jobid`),
  CONSTRAINT `applylisting_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`),
  CONSTRAINT `applylisting_ibfk_2` FOREIGN KEY (`jobid`) REFERENCES `job` (`jobid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applylisting`
--

LOCK TABLES `applylisting` WRITE;
/*!40000 ALTER TABLE `applylisting` DISABLE KEYS */;
INSERT INTO `applylisting` VALUES (1,1,1,'2021-11-09 16:24:22','Submitted'),(2,1,2,'2021-11-09 16:24:22','Accepted'),(3,2,2,'2021-11-09 16:24:22','Submitted'),(4,3,2,'2021-11-09 16:24:22','Accepted'),(5,4,2,'2021-11-09 16:24:22','Submitted'),(7,1,6,'2021-11-11 00:06:21','Submitted'),(9,21,6,'2021-11-11 00:52:36','Submitted'),(10,8,6,'2021-11-11 00:53:07','Submitted'),(14,3,6,'2021-11-12 03:07:35','Submitted'),(15,9,6,'2021-11-12 03:07:57','Submitted'),(16,12,6,'2021-11-12 04:26:11','Submitted'),(18,4,6,'2021-11-12 04:35:33','Submitted'),(19,20,6,'2021-11-12 04:38:17','Submitted'),(20,5,6,'2021-11-12 04:39:40','Submitted'),(21,7,6,'2021-11-12 04:43:13','Submitted'),(22,11,6,'2021-11-12 04:44:11','Submitted'),(23,34,6,'2021-11-12 05:12:52','Accepted'),(24,17,6,'2021-11-12 04:51:42','Submitted'),(25,15,6,'2021-11-12 04:53:24','Submitted'),(26,18,6,'2021-11-12 05:02:42','Submitted'),(27,14,6,'2021-11-12 05:03:25','Submitted'),(28,16,6,'2021-11-12 05:10:07','Submitted'),(29,13,6,'2021-11-12 05:10:55','Submitted'),(30,33,6,'2021-11-12 22:13:52','Submitted');
/*!40000 ALTER TABLE `applylisting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job` (
  `jobid` int NOT NULL AUTO_INCREMENT,
  `jobname` varchar(128) NOT NULL,
  `jobdesc` varchar(600) DEFAULT NULL,
  `rolerequired` varchar(128) DEFAULT NULL,
  `picturepath` varchar(600) DEFAULT NULL,
  `skills` varchar(600) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `address` varchar(600) DEFAULT NULL,
  `createuserid` int NOT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `listingstatus` varchar(28) NOT NULL,
  PRIMARY KEY (`jobid`),
  KEY `createuserid` (`createuserid`),
  CONSTRAINT `job_ibfk_1` FOREIGN KEY (`createuserid`) REFERENCES `user` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` VALUES (1,'AmazingPhotographer','Take photo of homo sapiens for 2 day event','photographer','sun-photo.jpeg','Knowledge of using camera','2021-02-22','2021-02-23',' 5001 Beach Rd #08-31 Singapore 199588',2,'2021-11-09 16:20:41','Open'),(2,'WonderfulVideographer','Film homo sapiens for 2 day event','videographer','shutterstock_1316889752.jpeg','Knowledge of using camera','2021-02-22','2021-02-23','20 Maxwell Rd #09-17 Maxwell Hse Singapore 069113',2,'2021-11-09 16:20:41','Closed'),(3,'FantasticModel','Pose like homo sapiens for 2 day event','model','photo_2021-09-13_13-57-23.jpg','Posing glamourously','2021-02-22','2021-02-23','Robinson Road No 66 Singapore 984438',2,'2021-11-09 16:20:41','Open'),(4,'TalentedActress','Act as mother for 2 day event','actress','matheus-ferrero-W7b3eDUb_2I-unsplash.jpg','Acting realistically','2021-02-22','2021-02-23','80 Mandai Lake Rd, Singapore 729826',2,'2021-11-09 16:20:41','Open'),(5,'ExperiencedProducer','Produce cool videos of homo sapiens for 2 day event','photographer','Film-Production-Company.jpeg','Knowledge of using camera','2021-02-22','2021-02-23','21 Lower Kent Ridge Rd, Singapore 119077',2,'2021-11-09 16:20:41','Open'),(6,'JazzySoundProducer','Produce jazzy sounds for 2 day event','videographer','Engineer_at_audio_console_at_Danish_Broadcasting_Corporation.png','Knowledge of using camera','2021-02-22','2021-02-23','455 Ang Mo Kio Street 44, Singapore 560455',2,'2021-11-09 16:20:41','Closed'),(7,'ChildActor','Pose like homo sapiens for 2 day event','model','13SCENE-articleLarge.jpeg','Posing glamourously','2021-02-22','2021-02-23','21 Choa Chu Kang Ave 4, Singapore 689812',2,'2021-11-09 16:20:41','Open'),(8,'MakeUpArtist','Make homo sapiens pretty for 2 day event','actress','makeupartist.jpeg','Acting realistically','2021-02-22','2021-02-23','Singapore Management University School of Economics 90 Stamford Road Singapore 178903',2,'2021-11-09 16:20:41','Open'),(9,'KoreanTranslator','Translate english to korean','translator','korean.jpeg','Bilingual english and korean','2021-02-22','2021-02-23','301 Neo Tiew Cres, Singapore 718925',2,'2021-11-09 16:20:41','Open'),(10,'FilmEditor','Edit videos','film editor','filmeditor.jpeg','Edit videos into a film','2021-02-22','2021-02-23','Boon Lay Pl, #01-106 01-106, 642221',2,'2021-11-09 16:20:41','Closed'),(11,'ContentStrategist','Create content for youtube channel','Content strategist','content-creator-job-description-4605x3454-20201118.jpeg','creativity, experience','2021-02-22','2021-02-23','Singapore Management University School of Economics 90 Stamford Road Singapore 178903',2,'2021-11-09 16:20:41','Open'),(12,'SocialMediaManager','Manage social media (insta and tiktok) for new film','Social media manager','socmed.jpeg','social media skills','2021-02-22','2021-02-23','Singapore Management University School of Economics 90 Stamford Road Singapore 178903',2,'2021-11-09 16:20:41','Open'),(13,'CostumeDesigner','Design costumes for actors','Costume designer','AdobeStock_76351013.jpeg','design, creativity, measuring sizes','2021-02-22','2021-02-23','Hillion Mall 17 Petir Rd, Singapore 678278',2,'2021-11-09 16:20:41','Open'),(14,'ProductionDesigner','Create storyboard for advertisement','Production designer','Production-Designer.jpeg','design storyboard','2021-02-22','2021-02-23','Bishan Park 1384 Ang Mo Kio Ave 1',2,'2021-11-09 16:20:41','Open'),(15,'CreativePropMaster','Design props according to storyboard','Prop master','props-knife.jpeg','design and craft','2021-02-22','2021-02-23','Singapore Management University School of Economics 90 Stamford Road Singapore 178903',2,'2021-11-09 16:20:41','Open'),(16,'PeriodDramaHairstylist','Style hair for period drama','Hair stylist','perioddrama.jpeg','hairstyling, creativity, experience','2021-02-22','2021-02-23','610A Upper E Coast Rd, Singapore 465404',2,'2021-11-09 16:20:41','Open'),(17,'SpecialEffectsCoordinator','Coordinate all special effects to polish our film','special effects coordinator','specialeffects.jpeg','experience and editing skills','2021-02-22','2021-02-23','Jewel Changi Airport 78 Airport Blvd Singapore 819666',2,'2021-11-09 16:20:41','Open'),(18,'GrandmaActor','Act as a clinically ill grandma to the main actor','Actor','130471120-sick-senior-grandmother-in-wheelchair-with-epileptic-seizures-in-outdoor-elderly-patient-convulsions.jpeg','acting skills','2021-02-22','2021-02-23','4 Tampines Central 5, Singapore 529510',2,'2021-11-09 16:20:41','Open'),(19,'DubbingManager','Bub japenese animation film to english','Dubbing manager','dubbingmanager.jpeg','bilingual english and japanese','2021-02-22','2021-02-23','51 Yishun Ave 11, Singapore 768867',2,'2021-11-09 16:20:41','Closed'),(20,'GhostActor','Act as ghost in horror movie, ok to put heavy makeup','Actor','4da97cb9-1181-444a-a77f-62a6af05e888-large16x9_AP21246537346406.jpeg','acting skills','2021-02-22','2021-02-23','Universal Studios Singapore 8 Sentosa Gateway, 098269',2,'2021-11-09 16:20:41','Open'),(21,'BeachModel','Model for a beach shoot.','model','image04.jpeg','Modelling skills, Professionalism','2021-02-22','2021-02-23','Tanjong Beach Club 120 Tanjong Beach Walk, 098942',2,'2021-11-09 16:20:41','Open'),(33,'Amazing Photographer','Take photo of homo sapiens for 2 day event','Photographer','4da97cb9-1181-444a-a77f-62a6af05e888-large16x9_AP21246537346406.jpeg','Knowledge of using camera','2021-11-19','2021-11-24','5001 Beach Rd #08-31 Singapore 199588',6,'2021-11-12 04:45:30','Open'),(34,'Amazing Videographer','Shoot Wedding events','Videographer','content-creator-job-description-4605x3454-20201118.jpeg','Familiar with Software Editing Software','2021-11-24','2021-11-26','5001 Beach Rd #08-31 Singapore 199588',6,'2021-11-12 04:48:36','Open'),(36,'Event Photographer','Good with Camera','Photographer','shutterstock_1316889752.jpeg','Familiar with Adobe and lightings','2021-11-13','2021-11-18','5001 Beach Rd #08-31 Singapore 199588',6,'2021-11-12 05:00:32','Open');
/*!40000 ALTER TABLE `job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likelisting`
--

DROP TABLE IF EXISTS `likelisting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likelisting` (
  `jobid` int NOT NULL,
  `userid` int NOT NULL,
  `is_liked` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`jobid`,`userid`),
  KEY `userid` (`userid`),
  CONSTRAINT `likelisting_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`),
  CONSTRAINT `likelisting_ibfk_2` FOREIGN KEY (`jobid`) REFERENCES `job` (`jobid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likelisting`
--

LOCK TABLES `likelisting` WRITE;
/*!40000 ALTER TABLE `likelisting` DISABLE KEYS */;
INSERT INTO `likelisting` VALUES (1,2,1),(2,1,1),(4,2,1),(5,2,1),(5,6,1),(6,2,1),(6,6,1),(7,2,1),(9,6,1),(11,6,1),(13,6,1),(14,6,1),(15,6,1),(17,6,1),(20,6,1),(21,6,1),(33,6,1);
/*!40000 ALTER TABLE `likelisting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile` (
  `profileid` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `skills` varchar(128) NOT NULL,
  `bio` varchar(600) DEFAULT NULL,
  `profilepic` varchar(600) DEFAULT NULL,
  `portfoliolink` varchar(600) DEFAULT NULL,
  `portfoliopath` varchar(600) DEFAULT NULL,
  `videoid` varchar(600) DEFAULT NULL,
  `facebook` varchar(600) DEFAULT NULL,
  `instagram` varchar(600) DEFAULT NULL,
  `youtube` varchar(600) DEFAULT NULL,
  `pinterest` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`profileid`),
  UNIQUE KEY `userid` (`userid`),
  CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,1,'Photography, Videography, Photo editing, Video editing, Video special effects, Wedding shoots, Advertisement shoots','Hello! Nice to meet you! I came from Italy to Singapore to take wonderful photos of the trees! Recently, I took on a new interest, expanding my expertise from photography to videography as well. I have some experience shooting all sorts of videos from romantic weddings to fast faces sports highlights. Looking to gain more experience for both photography and videography. Quality assured.','../profileimg/u1/profileimg.png','en.wikipedia.org/wiki/Mary_(name)','../profileimg/u1/gallery','4poqZjNTZjI','www.facebook.com','www.instagram.com','www.youtube.com','www.pinterest.com'),(2,2,'Photo editing','Best company in the world to find photo editing experts','../profileimg/u2/profileimg.png','www.company.com','../profileimg/u2/gallery','PEUIqPFXPRg','www.facebook.com/Meta/','','',''),(13,3,'Designing','Apple Lover and Apple Phone Designer','../profileimg/u3/profileimg.png','apple.com','../profileimg/u3/gallery','XKfgdkcIUxw','','','www.youtube.com/channel/UCNVEosBert4OFUBoJ_P2R5g',''),(15,4,'Music Production, DJ','Music is part of my soul, I live and breathe it','../profileimg/u4/profileimg.png','','../profileimg/u4/gallery','2ZhH68zSyA4','','','www.youtube.com/channel/UC-9-kyTW8ZkZNDHQJ6FgpwQ','www.pinterest.com/livenation/the-power-of-music/'),(16,5,'Modelling, Dancing, Singing, Acting, Photography','Have experience modelling for many brands!','../profileimg/u5/profileimg.png','','../profileimg/u5/gallery','D2EvaSgi3UQ','','','','www.pinterest.com/search/pins/?q=models&rs=typed&term_meta[]=models%7Ctyped'),(17,6,'Creative Thinking, Photography, Videography, Graphic Design, Animation','One-stop shop for all services you need :(','../profileimg/u6/profileimg.png','www.holidify.com/collections/music-festivals-in-singapore','../profileimg/u6/gallery','R5kYXWABh-0','','','','');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `rolename` varchar(28) NOT NULL,
  `userid` int NOT NULL,
  PRIMARY KEY (`rolename`,`userid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES ('Photographer',1),('Videographer',1),('Photo Editor',2),('Phone Designer',3),('Music Producer',4),('Model',5),('Graphic Designer',6),('Music Producer',6),('Photographer',6),('Videographer',6);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `userid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `address` varchar(128) DEFAULT NULL,
  `country` varchar(28) DEFAULT NULL,
  `gender` varchar(28) DEFAULT NULL,
  `phone` varchar(28) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `code` mediumint NOT NULL,
  `status` text NOT NULL,
  `googleid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Mary','$2y$10$VVKbZN0Dn1U7l/nzBWPrz.74W3T4kpMXDNLuFZWjUU8dnygHcqsoK','mary@gmail.com','Blk 1 ABC Road Singapore 111111','Singapore','F','83671562','2009-02-23 00:00:00',0,'verified',NULL),(2,'The Company','$2y$10$VVKbZN0Dn1U7l/nzBWPrz.74W3T4kpMXDNLuFZWjUU8dnygHcqsoK','company@gmail.com','Blk 2 DEF Road Singapore 111111','Singapore',NULL,'98478234','2000-02-23 00:00:00',0,'verified',NULL),(3,'John','$2y$10$VVKbZN0Dn1U7l/nzBWPrz.74W3T4kpMXDNLuFZWjUU8dnygHcqsoK','john@gmail.com','Blk 3 EFG Road Singapore 111111','Singapore','M','95837423','1988-02-23 00:00:00',0,'verified',NULL),(4,'Jessica Tan','$2y$10$WssELmGJUwrIdpxbGiKZL.7GkScpqhBF0id33m0hIf0bjX2YycbOq','carmenlee086@gmail.com','amk blk 123 singapore 111111','Singapore','F','82637162','2001-01-30 00:00:00',0,'verified',NULL),(5,'Jeo Lee','$2y$10$0yAXIVXRYsMCuWiJvIqex.xnpsc6LUz/qgy2sF7hT.JkhQ3WGEz1m','carmenlee480@gmail.com','Singapore0000','Singapore','F','97451231','1999-06-15 00:00:00',0,'verified',NULL),(6,'Amber Chua','$2y$10$VVKbZN0Dn1U7l/nzBWPrz.74W3T4kpMXDNLuFZWjUU8dnygHcqsoK','carmenlee098@gmail.com','No 27, Jalan Mutiara 3/1, Taman Mutiara Mas Skudai','Singapore','M','90665687','1999-11-11 00:00:00',0,'verified',NULL),(15,'Ben Teo','$2y$10$1ZPHDGwFVYERcZyREY4SJ.Heo4/Q37rYGs2xFuUc0gbeYbXVlJmFu','carmen.lee.2020@scis.smu.edu.sg','No 27, Jalan Mutiara 3/1, Taman Mutiara Mas Skudai','Afghanistan','M','97255777','1999-11-11 00:00:00',0,'verified',NULL),(17,'Albert Tan','$2y$10$v2/jKqmA/x2pMhpfR8qZ.ebCaUaKOSCjU7n6xnGHzjm.Mp/8o8Zh2','carmenlee0704@runbox.com','No 27, Jalan Mutiara 3/1, Taman Mutiara Mas Skudai','Afghanistan','M','90665687','1999-11-11 00:00:00',0,'verified',NULL),(18,'Jeovanne Poernomo','$2y$10$RbePa7lFeLJZWnbfe0arbOJxX5mk8Ew2weURBSPeEI30c8qVzMX4K','jjeovannecp@gmail.com','Helloooooo there','Singapore','F','81852528','2001-07-28 00:00:00',0,'verified',NULL),(19,'Henry Lee','$2y$10$nkpXkvud.Gxx20MurWEUoeMrVOoIuKidEXTXOL576e0ePMypgFC/e','tetayo3885@healteas.com','amk','Singapore','M','87513212','2000-11-18 00:00:00',0,'verified',NULL),(20,'Angela Wee','$2y$10$sEyHU6x0Y9RAXfHcVkIY/OKCVj7u.L3Mu3kQ8HpkEFCOwcGtRdY9m','angelawee1996@gmail.com','26 Sophia Road #06-38 Peace Centre Singapore 2282649, Singapore','Singapore','F','90665685','1999-11-11 00:00:00',132054,'verified',NULL),(21,'Jeremy Su','no','jeremysu1996@gmail.com','26 Sophia Road #06-38 Peace Centre Singapore 2282649, Singapore','Singapore','male','90883526','1999-11-11 00:00:00',0,'verified','115695131988512220172'),(22,'Alex Goh','$2y$10$jJC4UjPFkjHRE0eNUIQOquYYPwhPnWbmornO1eHY97ReJRZeythai','alexgohkx@gmail.com','Ptd 2980 Jln Muar 83500 Parit Sulong Johor Parit Sulong Johor 83500 Malaysia','Malaysia','M','87654233','1998-11-12 00:00:00',0,'verified',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-13 22:07:17
