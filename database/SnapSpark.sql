-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Gen 17, 2024 alle 02:44
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

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
-- Struttura della tabella `commenti`
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
-- Dump dei dati per la tabella `commenti`
--

INSERT INTO `commenti` (`post_user`, `post_id`, `user`, `id`, `testo`, `upvote`) VALUES
('olivia_taylor', 1, 'alex_smith', 1, 'ss', 1),
('olivia_taylor', 1, 'alex_smith', 2, 'dddd', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `follow`
--

CREATE TABLE `follow` (
  `follower` char(30) NOT NULL,
  `user` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `follow`
--

INSERT INTO `follow` (`follower`, `user`) VALUES
('alex_smith', 'mary_jones'),
('alex_smith', 'olivia_taylor'),
('daniel_carter', 'alex_smith'),
('daniel_carter', 'ryan_nguyen'),
('daniel_carter', 'sophia_garcia'),
('emily_wang', 'alex_smith'),
('grace_anderson', 'daniel_carter'),
('jane_smith', 'mary_jones'),
('john_doe', 'jane_smith'),
('john_doe', 'sam_wilson'),
('mary_jones', 'emily_wang'),
('mary_jones', 'sam_wilson'),
('olivia_taylor', 'grace_anderson'),
('olivia_taylor', 'will_miller'),
('ryan_nguyen', 'mary_jones'),
('sam_wilson', 'emily_wang'),
('sam_wilson', 'olivia_taylor'),
('sophia_garcia', 'john_doe'),
('sophia_garcia', 'ryan_nguyen'),
('will_miller', 'grace_anderson'),
('will_miller', 'sophia_garcia');

-- --------------------------------------------------------

--
-- Struttura della tabella `hashtags`
--

CREATE TABLE `hashtags` (
  `nome` char(20) NOT NULL,
  `descrizione` varchar(100) NOT NULL,
  `nome_social` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `hashtags`
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
-- Struttura della tabella `likes`
--

CREATE TABLE `likes` (
  `post_username` char(30) NOT NULL,
  `post_id` int(11) NOT NULL,
  `username` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `likes`
--

INSERT INTO `likes` (`post_username`, `post_id`, `username`) VALUES
('olivia_taylor', 1, 'alex_smith');

-- --------------------------------------------------------

--
-- Struttura della tabella `like_post`
--

CREATE TABLE `like_post` (
  `comment_username` char(30) NOT NULL,
  `post_username` char(30) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `like_username` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `like_post`
--

INSERT INTO `like_post` (`comment_username`, `post_username`, `post_id`, `comment_id`, `like_username`) VALUES
('alex_smith', 'olivia_taylor', 1, 1, 'alex_smith'),
('alex_smith', 'olivia_taylor', 1, 2, 'alex_smith');

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggio`
--

CREATE TABLE `messaggio` (
  `sen_username` char(30) NOT NULL,
  `rec_username` char(30) NOT NULL,
  `testo` char(100) NOT NULL,
  `id` bigint(255) NOT NULL,
  `data` datetime(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `messaggio`
--

INSERT INTO `messaggio` (`sen_username`, `rec_username`, `testo`, `id`, `data`) VALUES
('alex_smith', 'daniel_carter', 'aaaa', 1, '2024-01-13 17:59:22.0'),
('alex_smith', 'daniel_carter', 'aaaa', 2, '2024-01-13 17:59:27.0'),
('alex_smith', 'daniel_carter', 's', 9, '2024-01-13 18:14:41.0'),
('alex_smith', 'daniel_carter', 'aaa', 11, '2024-01-13 18:51:20.0'),
('alex_smith', 'daniel_carter', 'aaa', 12, '2024-01-13 18:53:13.0'),
('alex_smith', 'daniel_carter', 'aa', 13, '2024-01-13 18:53:19.0'),
('alex_smith', 'daniel_carter', 'aaaa', 14, '2024-01-13 18:53:22.0'),
('alex_smith', 'daniel_carter', 'sssjsjs', 16, '2024-01-13 19:38:24.0'),
('alex_smith', 'daniel_carter', 'jxsjxnjsnx', 20, '2024-01-13 19:42:07.0'),
('alex_smith', 'daniel_carter', 'ssjnsjw', 24, '2024-01-13 20:24:48.0'),
('alex_smith', 'daniel_carter', 'ciao', 26, '2024-01-13 20:32:50.0'),
('alex_smith', 'daniel_carter', 'ciao', 61, '2024-01-17 00:05:23.0'),
('alex_smith', 'daniel_carter', 'ciao', 62, '2024-01-17 00:06:52.0'),
('alex_smith', 'daniel_carter', 'ciao', 63, '2024-01-17 00:07:17.0'),
('alex_smith', 'daniel_carter', 'ciao', 65, '2024-01-17 00:12:28.0'),
('alex_smith', 'emily_wang', 'dddd', 15, '2024-01-13 19:35:33.0'),
('alex_smith', 'emily_wang', 'xxxx', 17, '2024-01-13 19:38:46.0'),
('alex_smith', 'emily_wang', 'jcdndjcdjcn', 19, '2024-01-13 19:42:00.0'),
('alex_smith', 'emily_wang', 'eeeeje', 25, '2024-01-13 20:26:50.0'),
('alex_smith', 'mary_jones', 'marrr', 21, '2024-01-13 19:42:23.0'),
('alex_smith', 'olivia_taylor', 'ciaoo', 58, '2024-01-16 21:03:58.0'),
('daniel_carter', 'alex_smith', 'dedked', 3, '2024-01-13 18:08:39.0'),
('daniel_carter', 'alex_smith', 'd', 4, '2024-01-13 18:08:42.0'),
('daniel_carter', 'alex_smith', 'd', 5, '2024-01-13 18:08:45.0'),
('daniel_carter', 'alex_smith', 'd', 6, '2024-01-13 18:08:48.0'),
('daniel_carter', 'alex_smith', 'd', 7, '2024-01-13 18:08:53.0'),
('daniel_carter', 'alex_smith', 'd', 8, '2024-01-13 18:08:55.0'),
('daniel_carter', 'alex_smith', 'xx', 10, '2024-01-13 18:14:56.0'),
('daniel_carter', 'alex_smith', 'ciao', 27, '2024-01-13 20:32:57.0'),
('daniel_carter', 'alex_smith', 'ciaoo', 54, '2024-01-15 21:22:02.0'),
('daniel_carter', 'alex_smith', 'ciao', 59, '2024-01-16 23:51:58.0'),
('daniel_carter', 'alex_smith', 'ciao', 60, '2024-01-17 00:05:14.0'),
('daniel_carter', 'alex_smith', 'ciao', 64, '2024-01-17 00:12:22.0'),
('daniel_carter', 'alex_smith', 'ciao', 66, '2024-01-17 01:27:49.0'),
('daniel_carter', 'alex_smith', 'ciao', 67, '2024-01-17 01:36:29.0'),
('ryan_nguyen', 'alex_smith', 'ciaooo', 35, '2024-01-14 03:29:30.0'),
('ryan_nguyen', 'alex_smith', 'ciaooo', 37, '2024-01-14 03:29:46.0'),
('ryan_nguyen', 'alex_smith', 'ciaooo', 41, '2024-01-15 16:02:49.0');

-- --------------------------------------------------------

--
-- Struttura della tabella `notifica`
--

CREATE TABLE `notifica` (
  `tipo` char(50) NOT NULL,
  `sen_user` char(30) NOT NULL,
  `id` bigint(20) NOT NULL,
  `username` char(30) NOT NULL,
  `data` datetime(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `notifica`
--

INSERT INTO `notifica` (`tipo`, `sen_user`, `id`, `username`, `data`) VALUES
('send', 'daniel_carter', 1, 'alex_smith', '2024-01-17 01:27:49.0'),
('send', 'daniel_carter', 2, 'alex_smith', '2024-01-17 01:36:29.0'),
('send', 'daniel_carter', 3, 'alex_smith', '2024-01-17 01:36:34.0'),
('removeMessage', 'daniel_carter', 4, 'alex_smith', '2024-01-17 01:44:32.0'),
('Follow', 'daniel_carter', 5, 'alex_smith', '2024-01-17 02:11:04.0'),
('Follow', 'daniel_carter', 6, 'alex_smith', '2024-01-17 02:11:19.0'),
('Follow', 'daniel_carter', 7, 'alex_smith', '2024-01-17 02:12:45.0'),
('', 'daniel_carter', 8, 'alex_smith', '2024-01-17 02:12:46.0'),
('Unfollow', 'daniel_carter', 9, 'alex_smith', '2024-01-17 02:12:52.0'),
('Follow', 'daniel_carter', 10, 'alex_smith', '2024-01-17 02:12:55.0'),
('Unfollow', 'daniel_carter', 11, 'alex_smith', '2024-01-17 02:12:56.0'),
('Follow', 'daniel_carter', 12, 'alex_smith', '2024-01-17 02:12:56.0'),
('Unfollow', 'daniel_carter', 13, 'alex_smith', '2024-01-17 02:12:56.0'),
('Follow', 'daniel_carter', 14, 'alex_smith', '2024-01-17 02:13:01.0'),
('Unfollow', 'daniel_carter', 15, 'alex_smith', '2024-01-17 02:15:38.0'),
('Follow', 'daniel_carter', 16, 'alex_smith', '2024-01-17 02:15:40.0'),
('Follow', 'alex_smith', 17, 'john_doe', '2024-01-17 02:34:49.0'),
('Unfollow', 'alex_smith', 18, 'john_doe', '2024-01-17 02:34:51.0');

-- --------------------------------------------------------

--
-- Struttura della tabella `posts`
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
-- Dump dei dati per la tabella `posts`
--

INSERT INTO `posts` (`username`, `file`, `id`, `descrizione`, `data`, `spark`) VALUES
('alex_smith', 'petselfie.jpg', 1, 'Quality time with my furry friend!', '2023-12-21', 0),
('daniel_carter', 'techgadget.jpg', 1, 'Exciting new tech gadget!', '2023-12-17', 0),
('emily_wang', 'artwork.jpg', 1, 'Expressing creativity through art.', '2023-12-22', 0),
('grace_anderson', 'bookshelf.jpg', 1, 'A glimpse into my book collection.', '2023-12-18', 0),
('jane_smith', 'video1.mp4', 1, 'Feeling inspired today!', '2023-12-25', 0),
('john_doe', 'image1.jpg', 1, 'Enjoying a sunny day!', '2023-12-26', 0),
('john_doe', 'imag21.jpg', 2, 'Enjoying a snowy day!', '2023-12-28', 0),
('mary_jones', 'foodpic.jpg', 1, 'Delicious homemade meal!', '2023-12-24', 0),
('olivia_taylor', 'musiccover.mp3', 1, 'Jamming to my favorite song!', '2023-12-12', 1),
('olivia_taylor', 'runsong.mp3', 2, 'What a Beautiful day to run!', '2023-12-20', 0),
('sam_wilson', 'travel1.jpg', 1, 'Exploring new places!', '2023-12-23', 0),
('will_miller', 'fashionstyle.jpg', 1, 'Today\'s stylish outfit!', '2023-12-19', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `socials`
--

CREATE TABLE `socials` (
  `nome_social` char(15) NOT NULL,
  `mail` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `socials`
--

INSERT INTO `socials` (`nome_social`, `mail`) VALUES
('SnapSpark', 'info@snapsocial.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
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
  `nome_social` char(15) NOT NULL,
  `profile_img` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`username`, `nome`, `cognome`, `sesso`, `password`, `data_nascita`, `mail`, `numero`, `biografia`, `nome_social`, `profile_img`) VALUES
('alex_smith', 'Alex', 'Smith', 'M', 'alexpass', '1997-05-18', 'alex.smith@example.com', 4567788990, 'Exploring the world one photo at a time.', 'SnapSpark', 'sample2.png'),
('daniel_carter', 'Daniel', 'Carter', 'M', 'danielpass', '1985-11-08', 'daniel.carter@example.com', 5566778899, 'Photography enthusiast and positivity spreader.', 'SnapSpark', 'avatar.png'),
('emily_wang', 'Emily', 'Wang', 'F', 'emilypass', '1992-12-05', 'emily.wang@example.com', 1234455667, 'Chasing dreams and capturing moments.', 'SnapSpark', 'avatar.png'),
('grace_anderson', 'Grace', 'Anderson', 'F', 'gracepass', '1996-07-25', 'grace.anderson@example.com', 3344556677, 'Every day is a gift.', 'SnapSpark', 'avatar.png'),
('jane_smith', 'Jane', 'Smith', 'F', 'pass123', '1988-05-15', 'jane.smith@example.com', 9876543210, 'Enjoying life one moment at a time.', 'SnapSpark', 'avatar.png'),
('john_doe', 'John', 'Doe', 'M', 'password123', '1990-01-01', 'john.doe@example.com', 1234567890, 'I love sharing positive moments!', 'SnapSpark', 'avatar.png'),
('mary_jones', 'Mary', 'Jones', 'F', 'marypass', '1995-03-10', 'mary.jones@example.com', 5551112233, 'Spreading happiness every day!', 'SnapSpark', 'avatar.png'),
('olivia_taylor', 'Olivia', 'Taylor', 'F', 'oliviapass', '1989-09-30', 'olivia.taylor@example.com', 7890011223, 'Making memories and sharing joy!', 'SnapSpark', 'sample.png'),
('ryan_nguyen', 'Ryan', 'Nguyen', 'M', 'ryanpass', '1991-06-03', 'ryan.nguyen@example.com', 1122334455, 'Living the dream and inspiring others.', 'SnapSpark', 'avatar.png'),
('sam_wilson', 'Sam', 'Wilson', 'M', 'samuelpass', '1983-08-22', 'sam.wilson@example.com', 9871122334, 'Living life to the fullest!', 'SnapSpark', 'avatar.png'),
('sophia_garcia', 'Sophia', 'Garcia', 'F', 'sophiapass', '1994-02-14', 'sophia.garcia@example.com', 8899001122, 'Believe in the beauty of every moment.', 'SnapSpark', 'avatar.png'),
('will_miller', 'Will', 'Miller', 'M', 'willpass', '1993-04-12', 'will.miller@example.com', 1122334455, 'Life is an adventure!', 'SnapSpark', 'avatar.png');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `commenti`
--
ALTER TABLE `commenti`
  ADD PRIMARY KEY (`user`,`post_user`,`post_id`,`id`),
  ADD UNIQUE KEY `ID_commenti_IND` (`user`,`post_user`,`post_id`,`id`),
  ADD KEY `FKricezione_IND` (`post_user`,`post_id`);

--
-- Indici per le tabelle `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`follower`,`user`),
  ADD UNIQUE KEY `ID_follow_IND` (`follower`,`user`),
  ADD KEY `FKseguito_IND` (`user`);

--
-- Indici per le tabelle `hashtags`
--
ALTER TABLE `hashtags`
  ADD PRIMARY KEY (`nome`),
  ADD UNIQUE KEY `ID_hashtags_IND` (`nome`),
  ADD KEY `FKgiornaliero_IND` (`nome_social`);

--
-- Indici per le tabelle `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`post_username`,`post_id`,`username`),
  ADD UNIQUE KEY `ID_likes_IND` (`post_username`,`post_id`,`username`),
  ADD KEY `FKlik_ute_IND` (`username`);

--
-- Indici per le tabelle `like_post`
--
ALTER TABLE `like_post`
  ADD PRIMARY KEY (`comment_username`,`post_username`,`post_id`,`comment_id`,`like_username`),
  ADD UNIQUE KEY `ID_like_post_IND` (`comment_username`,`post_username`,`post_id`,`comment_id`,`like_username`),
  ADD KEY `FKlik_UTE_IND` (`like_username`);

--
-- Indici per le tabelle `messaggio`
--
ALTER TABLE `messaggio`
  ADD PRIMARY KEY (`sen_username`,`rec_username`,`id`),
  ADD UNIQUE KEY `ID_messagio_IND` (`sen_username`,`rec_username`,`id`),
  ADD KEY `FKscrive_IND` (`rec_username`);

--
-- Indici per le tabelle `notifica`
--
ALTER TABLE `notifica`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID_notifica_IND` (`id`),
  ADD KEY `FKriceve_IND` (`username`);

--
-- Indici per le tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`username`,`id`),
  ADD UNIQUE KEY `ID_posts_IND` (`username`,`id`);

--
-- Indici per le tabelle `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`nome_social`),
  ADD UNIQUE KEY `ID_socials_IND` (`nome_social`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `ID_utenti_IND` (`username`),
  ADD KEY `FKappartengono_IND` (`nome_social`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `commenti`
--
ALTER TABLE `commenti`
  ADD CONSTRAINT `FKricezione_FK` FOREIGN KEY (`post_user`,`post_id`) REFERENCES `posts` (`username`, `id`),
  ADD CONSTRAINT `FKscruittura` FOREIGN KEY (`user`) REFERENCES `utenti` (`username`);

--
-- Limiti per la tabella `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `FKsegue` FOREIGN KEY (`follower`) REFERENCES `utenti` (`username`),
  ADD CONSTRAINT `FKseguito_FK` FOREIGN KEY (`user`) REFERENCES `utenti` (`username`);

--
-- Limiti per la tabella `hashtags`
--
ALTER TABLE `hashtags`
  ADD CONSTRAINT `FKgiornaliero_FK` FOREIGN KEY (`nome_social`) REFERENCES `socials` (`nome_social`);

--
-- Limiti per la tabella `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `FKlik_pos` FOREIGN KEY (`post_username`,`post_id`) REFERENCES `posts` (`username`, `id`),
  ADD CONSTRAINT `FKlik_ute_FK` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`);

--
-- Limiti per la tabella `notifica`
--
ALTER TABLE `notifica`
  ADD CONSTRAINT `FKriceve_FK` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`);

--
-- Limiti per la tabella `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FKposta` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`);

--
-- Limiti per la tabella `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `FKappartengono_FK` FOREIGN KEY (`nome_social`) REFERENCES `socials` (`nome_social`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
