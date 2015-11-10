-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 09 Lis 2015, 19:00
-- Wersja serwera: 5.5.45-37.4-log
-- Wersja PHP: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `atmel_parking`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `number_plates`
--

CREATE TABLE IF NOT EXISTS `number_plates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `number` varchar(8) NOT NULL,
  PRIMARY KEY (`id`,`user_id`),
  KEY `user_id_i` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Zrzut danych tabeli `number_plates`
--

INSERT INTO `number_plates` (`id`, `user_id`, `number`) VALUES
(1, 6, 'RZE5XY78'),
(2, 6, 'RZE251AB'),
(5, 14, 'KLA64YU9'),
(6, 14, 'WE32768A'),
(9, 8, 'RZE5XY79'),
(10, 19, 'RZE87K65'),
(11, 19, 'RLA5987X');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `parkings`
--

CREATE TABLE IF NOT EXISTS `parkings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `image` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `parkings`
--

INSERT INTO `parkings` (`id`, `name`, `image`) VALUES
(1, 'Galeria Rzeszów', 'res/images/006302.jpg'),
(2, 'Rynek', 'http://www.polskaniezwykla.pl/pictures/original/271379.jpg'),
(3, 'Podpromie', 'http://s3.flog.pl/media/foto/677956_hala-podpromie-w-rzeszowie-hdr.jpg'),
(4, 'Politechnika Rzeszów', 'http://www.rzeszow4u.pl/upload/Aktualnosci/remont-akademikow-politechniki.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `places`
--

CREATE TABLE IF NOT EXISTS `places` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place` int(11) NOT NULL,
  `id_parking` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `state` int(11) DEFAULT '0',
  `number_id` varchar(45) NOT NULL,
  PRIMARY KEY (`id`,`id_parking`,`user_id`,`number_id`),
  KEY `id_parking_i` (`id_parking`),
  KEY `id_user_i` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Zrzut danych tabeli `places`
--

INSERT INTO `places` (`id`, `place`, `id_parking`, `user_id`, `state`, `number_id`) VALUES
(1, 1, 1, 0, 1, ''),
(2, 2, 1, 0, 0, '8'),
(3, 3, 1, 14, 2, '6'),
(4, 4, 1, 7, 2, '4'),
(5, 5, 1, 8, 2, '9'),
(6, 1, 2, 0, 0, ''),
(7, 2, 2, 8, 2, '9'),
(8, 3, 2, 0, 1, ''),
(9, 4, 2, 0, 0, ''),
(10, 1, 3, 0, 0, ''),
(11, 2, 3, 0, 0, '1'),
(12, 3, 3, 0, 0, ''),
(13, 1, 4, 0, 1, ''),
(14, 2, 4, 0, 1, ''),
(15, 3, 4, 0, 0, ''),
(16, 4, 4, 6, 2, '1'),
(17, 5, 4, 0, 0, ''),
(18, 6, 4, 0, 1, ''),
(19, 7, 4, 19, 2, '10'),
(20, 8, 4, 0, 1, ''),
(21, 9, 4, 0, 0, '1'),
(22, 10, 4, 0, 1, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `places_history`
--

CREATE TABLE IF NOT EXISTS `places_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `id_place` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `state` int(11) DEFAULT '0',
  `number_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_user`,`id_place`,`number_id`),
  KEY `id_place_i` (`id_place`),
  KEY `id_user_i` (`id_user`),
  KEY `number_id_i` (`number_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 PACK_KEYS=1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `reset_pass` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `reset_pass`) VALUES
(6, 'nanotest321@gmail.com', 'b31ef2c556479f501b02ccd23fc3d088267dc236', ''),
(8, 'user@nanomatic.pl', '45f106ef4d5161e7aa38cf6c666607f25748b6ca', NULL),
(14, 'admin@nanomatic.pl', '74913f5cd5f61ec0bcfdb775414c2fb3d161b620', NULL),
(19, 'projekt@nanomatic.pl', 'e79d8a9dfa047aa82777f1c8d2f5aa51e58963a3', '2ae96567bf02287d8544004d67e89f7c91f4f7c4');

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `number_plates`
--
ALTER TABLE `number_plates`
  ADD CONSTRAINT `user_id_f` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `places`
--
ALTER TABLE `places`
  ADD CONSTRAINT `id_parking_f` FOREIGN KEY (`id_parking`) REFERENCES `parkings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `places_history`
--
ALTER TABLE `places_history`
  ADD CONSTRAINT `id_place_f` FOREIGN KEY (`id_place`) REFERENCES `places` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user_f` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `number_id` FOREIGN KEY (`number_id`) REFERENCES `number_plates` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
