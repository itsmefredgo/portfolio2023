-- CSCI 2170 GROUP ASSIGNMENT FALL 2021
-- DATABASE FOR THE WEBSITE

-- Database: Spider

DROP DATABASE Spider;
CREATE DATABASE IF NOT EXISTS `Spider` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `Spider`;

-- Table structure for table `author`

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` 		INT(11) 	NOT NULL 	PRIMARY KEY 	AUTO_INCREMENT,
  `user_fname` 	VARCHAR(256)	NOT NULL,
  `user_lname` 	VARCHAR(256) 	NOT NULL,
  `user_phone` 	VARCHAR(12) 	NOT NULL, -- 902-123-4567
  `user_type` 	VARCHAR(256) 	NOT NULL,
  `user_intro`	VARCHAR(256) 	NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO user VALUES(1,'Frederick','Go','902-123-4567','Role','Yo, I am Fred Go, and yes, Go is my actual last name.');
INSERT INTO user VALUES(2,'Run','Guo','902-987-6543','Role','I am Run. I like running!');
INSERT INTO user VALUES(3,'Ben','Hoeg','902-135-2468','Role','My name is Ben, and I love writing!');

-- Table structure for table `login`

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `user_id` 			INT(11) 		NOT NULL 	PRIMARY KEY		AUTO_INCREMENT,
  `user_email` 		VARCHAR(256) 	NOT NULL,
  `user_password` 	VARCHAR(256) 	NOT NULL,
  FOREIGN KEY(user_id) REFERENCES user(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO login VALUES(1,'fredgo@spider.org','qwerty1234');
INSERT INTO login VALUES(2,'runguo@spider.org','asdfgh0987');
INSERT INTO login VALUES(3,'benhueg@spider.org','zxcvbn1537');

-- Table structure for table `blogs`

DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `blog_id` 		INT(11) 		NOT NULL 	PRIMARY KEY		AUTO_INCREMENT,		
  `blog_title` 		VARCHAR(256) 	NOT NULL,
  `blog_preview` 	VARCHAR(256) 	NOT NULL,
  `blog_content` 	VARCHAR(1000) 	NOT NULL,
  `user_id` 		INT(11) 		NOT NULL,
  FOREIGN KEY(user_id) REFERENCES user(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO blog VALUES(1,'Somebody','Somebody once told me',"Somebody once told me the world is gonna roll me I ain't the sharpest tool in the shed She was looking kind of dumb with her finger and her thumb In the shape of an 'L' on her forehead",1);
INSERT INTO blog VALUES(2,'No Good Content','I have no idea',"This is some random ideas that came out of nowhere. I like poutine, but I don't like fries. Eh, this is some random content for testing. Yeet.",2);
INSERT INTO blog VALUES(3,'Thought','You will never forget',"Did you know? No one has even been into an empty room. Wo...",3);

-- Table structure for table `comment`

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `comment_id` 			INT(11) 		NOT NULL 	PRIMARY KEY		AUTO_INCREMENT,
  `user_id` 			INT(11) 		NOT NULL,
  `blog_id` 			INT(11) 		NOT NULL,		
  `comment_content` 	VARCHAR(1000) 	NOT NULL,
  FOREIGN KEY(user_id) REFERENCES user(user_id),
  FOREIGN KEY(blog_id) REFERENCES blog(blog_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO comment VALUES(1,3,1,"Well the years start coming and they don't stop coming Fed to the rules and I hit the ground running Didn't make sense not to live for fun Your brain gets smart but your head gets dumb");
INSERT INTO comment VALUES(2,1,2,"I love poutine too!");
INSERT INTO comment VALUES(3,2,3,"Wo, I cannot unthink that now. ");
-- Table structure for table `blogtag`

DROP TABLE IF EXISTS `blogtag`;
CREATE TABLE `blogtag` (
  `blogtag_id` 		INT(11) 		NOT NULL 	PRIMARY KEY		AUTO_INCREMENT,
  `tag_id` 			INT(11) 		NOT NULL,
  `blog_id` 		INT(11) 		NOT NULL,
  FOREIGN KEY(blog_id) REFERENCES blog(blog_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO blogtag VALUES(1,1,1);
INSERT INTO blogtag VALUES(2,2,2);
INSERT INTO blogtag VALUES(3,3,3);

-- Table structure for table `tag`

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `tag_id`		INT(11) 	NOT NULL 	PRIMARY KEY		AUTO_INCREMENT,
  `tag_label` 	VARCHAR(11)	NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO tag VALUES(1,"Music");
INSERT INTO tag VALUES(2,"Food");
INSERT INTO tag VALUES(3,"Thoughts");

ALTER TABLE blogtag ADD FOREIGN KEY (tag_id) REFERENCES tag(tag_id);
