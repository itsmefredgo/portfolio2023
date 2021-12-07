-- CSCI 2170 GROUP ASSIGNMENT FALL 2021
-- DATABASE FOR THE WEBSITE

-- Database: Spider

DROP DATABASE `Spider`;

CREATE DATABASE IF NOT EXISTS `Spider` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `Spider`;

-- Table structure for table `author`

DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `author_id` 		INT(11) 		NOT NULL 	PRIMARY KEY 	AUTO_INCREMENT,
  `author_fname` 	VARCHAR(256)	NOT NULL,
  `author_lname` 	VARCHAR(256) 	NOT NULL,
  `author_phone` 	VARCHAR(12) 	NOT NULL, -- 902-123-4567
  `author_type` 	VARCHAR(256) 	NOT NULL,
  `author_intro`	VARCHAR(256) 	NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE follow(
  `f_id` INT(11) 		NOT NULL 	PRIMARY KEY AUTO_INCREMENT,
  `author_id` 			INT(11) 		NOT NULL,
  `follow_author_id` 			INT(11) 		NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE read_later(
  `r_id` INT(11) 		NOT NULL 	PRIMARY KEY AUTO_INCREMENT,
  `author_id` 			INT(11) 		NOT NULL,
  `blog_id` 			INT(11) 		NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `login`

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `author_id` 			INT(11) 		NOT NULL 	PRIMARY KEY		AUTO_INCREMENT,
  `author_email` 		VARCHAR(256) 	NOT NULL,
  `author_password` 	VARCHAR(256) 	NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `blogs`

DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `blog_id` 		INT(11) 		NOT NULL 	PRIMARY KEY		AUTO_INCREMENT,		
  `blog_title` 		VARCHAR(256) 	NOT NULL,
  `blog_preview` 	VARCHAR(256) 	NOT NULL,
  `blog_content` 	VARCHAR(1000) 	NOT NULL,
  `author_id` 		INT(11) 		NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `comment`

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `comment_id` 			INT(11) 		NOT NULL 	PRIMARY KEY		AUTO_INCREMENT,
  `author_id` 			INT(11) 		NOT NULL,
  `blog_id` 			INT(11) 		NOT NULL,		
  `comment_content` 	VARCHAR(1000) 	NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `blogtag`

DROP TABLE IF EXISTS `blogtag`;
CREATE TABLE `blogtag` (
  `blogtag_id` 		INT(11) 		NOT NULL 	PRIMARY KEY		AUTO_INCREMENT,
  `tag_id` 			INT(11) 		NOT NULL,
  `blog_id` 		INT(11) 		NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Table structure for table `tag`

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `tag_id`		INT(11) 	NOT NULL 	PRIMARY KEY		AUTO_INCREMENT,
  `tag_label` 	VARCHAR(11)	NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


alter table `author` add `login_id` int(11) not null; 
alter table `blog` add `create_time` int(11) not null;
alter table `comment` add `create_time` int(11) not null;
