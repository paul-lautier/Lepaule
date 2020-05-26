CREATE TABLE `admins` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY admins (`username`)
)

CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `money` int NOT NULL,
  `is_warned` int,
  `is_muted` BOOLEAN,
  `is_banned` BOOLEAN,

  PRIMARY KEY (`id`),
  UNIQUE KEY users (`username`),
  UNIQUE KEY users (`email`)
)

CREATE TABLE `subs`(
    `sub_id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `sub_name` varchar(50) UNIQUE KEY NOT NULL,
    `nbr_users` int NOT NULL,
    `nbr_reports` int NOT NULL,
    `modos` varchar(50) NOT NULL,
    `post` varchar(100) NOT NULL
);

CREATE TABLE `post`(
    `post_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    `post_title` varchar(50) UNIQUE KEY NOT NULL ,
    `author` varchar(50) NOT NULL,
    `mature_content` BOOLEAN NOT NULL,
    `nbr_upvotes` int NOT NULL,
    `nbr_downvotes` int NOT NULL,
    `nbr_reports` int NOT NULL
);

CREATE TABLE `reports`(
    `report_id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `desc` varchar(250) NOT NULL,
    `sub_id`int NOT NULL,
    `username_report` varchar(50) UNIQUE KEY
)