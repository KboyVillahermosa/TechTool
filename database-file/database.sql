-- Review Tables --

CREATE TABLE `review_tables` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `colorsinpo` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `dou` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `happy_hues` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `khorma` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `lolcolors` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `sip` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tailwind_components` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tailwind_cheat` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `datacamp` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `dbdiagram` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `geeks` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `mode` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `mongo_db` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `mysql` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `redash` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `sqlpad` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Google Login Table --

CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `google_id` varchar(150) NOT NULL,
 `name` varchar(50) NOT NULL,
 `email` varchar(50) NOT NULL,
 `profile_image` text NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `google_id` (`google_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Admin Table --

CREATE TABLE IF NOT EXISTS `adminlogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Insertion into Admin Table --

INSERT INTO `adminlogin` (`id`, `username`, `password`) VALUES 
(NULL, 'admin', 'admin'), 
(NULL, 'admin2', 'admin2');


-- User Preferences Table --

CREATE TABLE `user_prefs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
   `user_id` INT NOT NULL,
    `likes` TEXT,
    `improvements` TEXT,
    `tools_needed` TEXT,
    `interests` ENUM('Frontend', 'Backend', 'Full Stack', 'Data Science', 'Web Design'),
    `experience` INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
