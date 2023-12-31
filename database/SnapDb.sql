-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 09, 2024 at 03:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SnapSpark`
--

-- --------------------------------------------------------

--
-- Table structure for table `commenti`
--

CREATE TABLE `commenti` (
  `post_user` char(30) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user` char(30) NOT NULL,
  `id` int(11) NOT NULL,
  `testo` varchar(50) NOT NULL,
  `upvote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `commenti`
--

INSERT INTO `commenti` (`post_user`, `post_id`, `user`, `id`, `testo`, `upvote`) VALUES
('john_doe', 1, 'pietro_v', 1, 'cioa', 1),
('john_doe', 1, 'pietro_v', 2, 'pollo', 1),
('john_doe', 1, 'pietro_v', 3, 'asd', 0),
('john_doe', 1, 'pietro_v', 4, 'as', 1);

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `follower` char(30) NOT NULL,
  `user` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`follower`, `user`) VALUES
('pietro_v', 'john_doe'),
('pietro_v', 'sam_wilson');

-- --------------------------------------------------------

--
-- Table structure for table `hashtags`
--

CREATE TABLE `hashtags` (
  `nome` char(20) NOT NULL,
  `descrizione` varchar(100) NOT NULL,
  `nome_social` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hashtags`
--

INSERT INTO `hashtags` (`nome`, `descrizione`, `nome_social`) VALUES
('art', 'Express yourself through art and creativity.', 'SnapSpark'),
('books', 'Discuss and recommend your favorite books.', 'SnapSpark'),
('fitness', 'Stay fit and healthy together!', 'SnapSpark'),
('happy', 'Share your happy moments!', 'SnapSpark'),
('inspiration', 'Inspiring moments to brighten your day.', 'SnapSpark'),
('motivation', 'Get inspired and motivated!', 'SnapSpark'),
('music', 'Share your favorite tunes and musical moments.', 'SnapSpark'),
('pets', 'Celebrate the joy of having pets.', 'SnapSpark'),
('positivity', 'Spread positivity and good vibes!', 'SnapSpark'),
('travel', 'Explore the world and share your adventures.', 'SnapSpark');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `post_username` char(30) NOT NULL,
  `post_id` int(11) NOT NULL,
  `username` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `like_post`
--

CREATE TABLE `like_post` (
  `comment_username` char(30) NOT NULL,
  `post_username` char(30) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `like_username` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `like_post`
--

INSERT INTO `like_post` (`comment_username`, `post_username`, `post_id`, `comment_id`, `like_username`) VALUES
('pietro_v', 'john_doe', 1, 1, 'pietro_v'),
('pietro_v', 'john_doe', 1, 2, 'pietro_v'),
('pietro_v', 'john_doe', 1, 4, 'pietro_v');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `username` char(30) NOT NULL,
  `file` char(20) NOT NULL,
  `id` int(11) NOT NULL,
  `descrizione` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `spark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`username`, `file`, `id`, `descrizione`, `data`, `spark`) VALUES
('john_doe', 'image1.jpg', 1, 'Enjoying a sunny day!', '2023-12-26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `nome_social` char(15) NOT NULL,
  `mail` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`nome_social`, `mail`) VALUES
('SnapSpark', 'info@snapsocial.com');

-- --------------------------------------------------------

--
-- Table structure for table `utenti`
--

CREATE TABLE `utenti` (
  `username` char(30) NOT NULL,
  `nome` char(20) NOT NULL,
  `cognome` char(20) NOT NULL,
  `sesso` char(1) NOT NULL,
  `password` char(30) NOT NULL,
  `data_nascita` date NOT NULL,
  `mail` char(40) NOT NULL,
  `numero` bigint(20) NOT NULL,
  `biografia` varchar(100) NOT NULL,
  `nome_social` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `utenti`
--

INSERT INTO `utenti` (`username`, `nome`, `cognome`, `sesso`, `password`, `data_nascita`, `mail`, `numero`, `biografia`, `nome_social`) VALUES
('alex_smith', 'Alex', 'Smith', 'M', 'alexpass', '1997-05-18', 'alex.smith@example.com', 4567788990, 'Exploring the world one photo at a time.', 'SnapSpark'),
('daniel_carter', 'Daniel', 'Carter', 'M', 'danielpass', '1985-11-08', 'daniel.carter@example.com', 5566778899, 'Photography enthusiast and positivity spreader.', 'SnapSpark'),
('emily_wang', 'Emily', 'Wang', 'F', 'emilypass', '1992-12-05', 'emily.wang@example.com', 1234455667, 'Chasing dreams and capturing moments.', 'SnapSpark'),
('grace_anderson', 'Grace', 'Anderson', 'F', 'gracepass', '1996-07-25', 'grace.anderson@example.com', 3344556677, 'Every day is a gift.', 'SnapSpark'),
('jane_smith', 'Jane', 'Smith', 'F', 'pass123', '1988-05-15', 'jane.smith@example.com', 9876543210, 'Enjoying life one moment at a time.', 'SnapSpark'),
('john_doe', 'John', 'Doe', 'M', 'password123', '1990-01-01', 'john.doe@example.com', 1234567890, 'I love sharing positive moments!', 'SnapSpark'),
('mary_jones', 'Mary', 'Jones', 'F', 'marypass', '1995-03-10', 'mary.jones@example.com', 5551112233, 'Spreading happiness every day!', 'SnapSpark'),
('olivia_taylor', 'Olivia', 'Taylor', 'F', 'oliviapass', '1989-09-30', 'olivia.taylor@example.com', 7890011223, 'Making memories and sharing joy!', 'SnapSpark'),
('pietro_v', 'Pietro', 'Ventrucci', 'M', 'pietro', '2002-10-22', 'pietro.sad@asd', 3458238201, 'QUalcosa da dire', 'SnapSpark'),
('ryan_nguyen', 'Ryan', 'Nguyen', 'M', 'ryanpass', '1991-06-03', 'ryan.nguyen@example.com', 1122334455, 'Living the dream and inspiring others.', 'SnapSpark'),
('sam_wilson', 'Sam', 'Wilson', 'M', 'samuelpass', '1983-08-22', 'sam.wilson@example.com', 9871122334, 'Living life to the fullest!', 'SnapSpark'),
('sophia_garcia', 'Sophia', 'Garcia', 'F', 'sophiapass', '1994-02-14', 'sophia.garcia@example.com', 8899001122, 'Believe in the beauty of every moment.', 'SnapSpark'),
('will_miller', 'Will', 'Miller', 'M', 'willpass', '1993-04-12', 'will.miller@example.com', 1122334455, 'Life is an adventure!', 'SnapSpark');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commenti`
--
ALTER TABLE `commenti`
  ADD PRIMARY KEY (`user`,`post_user`,`post_id`,`id`),
  ADD UNIQUE KEY `ID_commenti_IND` (`user`,`post_user`,`post_id`,`id`),
  ADD KEY `FKricezione_IND` (`post_user`,`post_id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`follower`,`user`),
  ADD UNIQUE KEY `ID_follow_IND` (`follower`,`user`),
  ADD KEY `FKseguito_IND` (`user`);

--
-- Indexes for table `hashtags`
--
ALTER TABLE `hashtags`
  ADD PRIMARY KEY (`nome`),
  ADD UNIQUE KEY `ID_hashtags_IND` (`nome`),
  ADD KEY `FKgiornaliero_IND` (`nome_social`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`post_username`,`post_id`,`username`),
  ADD UNIQUE KEY `ID_likes_IND` (`post_username`,`post_id`,`username`),
  ADD KEY `FKlik_ute_IND` (`username`);

--
-- Indexes for table `like_post`
--
ALTER TABLE `like_post`
  ADD PRIMARY KEY (`comment_username`,`post_username`,`post_id`,`comment_id`,`like_username`),
  ADD UNIQUE KEY `ID_like_post_IND` (`comment_username`,`post_username`,`post_id`,`comment_id`,`like_username`),
  ADD KEY `FKlik_UTE_IND` (`like_username`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`username`,`id`),
  ADD UNIQUE KEY `ID_posts_IND` (`username`,`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`nome_social`),
  ADD UNIQUE KEY `ID_socials_IND` (`nome_social`);

--
-- Indexes for table `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `ID_utenti_IND` (`username`),
  ADD KEY `FKappartengono_IND` (`nome_social`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commenti`
--
ALTER TABLE `commenti`
  ADD CONSTRAINT `FKricezione_FK` FOREIGN KEY (`post_user`,`post_id`) REFERENCES `posts` (`username`, `id`),
  ADD CONSTRAINT `FKscruittura` FOREIGN KEY (`user`) REFERENCES `utenti` (`username`);

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `FKsegue` FOREIGN KEY (`follower`) REFERENCES `utenti` (`username`),
  ADD CONSTRAINT `FKseguito_FK` FOREIGN KEY (`user`) REFERENCES `utenti` (`username`);

--
-- Constraints for table `hashtags`
--
ALTER TABLE `hashtags`
  ADD CONSTRAINT `FKgiornaliero_FK` FOREIGN KEY (`nome_social`) REFERENCES `socials` (`nome_social`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `FKlik_pos` FOREIGN KEY (`post_username`,`post_id`) REFERENCES `posts` (`username`, `id`),
  ADD CONSTRAINT `FKlik_ute_FK` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FKposta` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`);

--
-- Constraints for table `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `FKappartengono_FK` FOREIGN KEY (`nome_social`) REFERENCES `socials` (`nome_social`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
