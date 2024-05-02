
------- DATABASE NAME -------------
-- google_login

-- REVIEW RATINGS --

CREATE TABLE review_table (
  review_id int(11) NOT NULL,
  user_name varchar(200) NOT NULL,
  user_rating int(1) NOT NULL,
  user_review text NOT NULL,
  datetime int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-------------- GOOOGLE LOGIN TABLE -----------------------
CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `google_id` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
 `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `profile_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `google_id` (`google_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



------------------------ admin table ---------------------
DROP TABLE IF EXISTS `adminlogin`;
CREATE TABLE IF NOT EXISTS `adminlogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


---------------------------- insert into ---------------
INSERT INTO `adminlogin` (`id`, `username`, `password`) VALUES (NULL, 'admin', 'admin'), (NULL, 'admin2', 'admin2');


------------------------ admin with image ----------------------
INSERT INTO `adminlogin` (`id`, `username`, `password`, `image`, `email`)
VALUES
(NULL, 'admin', 'admin', 'admin_image.jpg', 'villahermosafrancisco6@gmail.com'),
(NULL, 'admin2', 'admin2', 'admin2_image.jpg', 'jomaralberastine90@gmail.com');