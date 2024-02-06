-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 06, 2024 alle 22:01
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `snapspark`
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
('maria_rossi', 'luca_cara');

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
-- Struttura della tabella `posts`
--

CREATE TABLE `posts` (
  `username` char(30) NOT NULL,
  `file` char(50) NOT NULL,
  `id` int(11) NOT NULL,
  `descrizione` varchar(100) NOT NULL,
  `data` datetime NOT NULL,
  `spark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `posts`
--

INSERT INTO `posts` (`username`, `file`, `id`, `descrizione`, `data`, `spark`) VALUES
('luca_cara', '4ef4c4e41eaf859ab26f7dc09af91427c66522d7.jpg', 1, 'Nature is fantastic!', '2024-02-06 21:44:13', 0),
('maria_rossi', 'cdc4c3625b5255320732787157f544170c36d83b.jpg', 1, 'What a beautiful landscape!', '2024-02-06 21:55:37', 0);

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
('SnapSpark', 'snapsparkapp@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `username` char(30) NOT NULL,
  `nome` char(20) NOT NULL,
  `cognome` char(20) NOT NULL,
  `sesso` char(10) NOT NULL,
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
('luca_cara', 'Luca', 'Carabini', 'Maschio', 'lucacara', '2002-06-05', 'luca02c2@gmail.com', 3703112047, '', 'SnapSpark', '0b3b6d9beede5478860d5714b9b363c494180b1d.png'),
('maria_rossi', 'Maria', 'Rossi', 'Femmina', 'mariapass', '2001-12-10', 'luca02c6@gmail.com', 3332040211, '', 'SnapSpark', '058c70174ca5d5e4714226521760b2eeb5d7a0ef.png');

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
