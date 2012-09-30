-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 28, 2012 at 05:02 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mylibrary`
--
CREATE DATABASE `mylibrary` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mylibrary`;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'Autor 1'),
(2, 'Autor 2'),
(3, 'Autor 3'),
(4, 'Autor 4'),
(6, 'Marius'),
(7, 'test2'),
(8, 'tes4tes4'),
(9, 'tes4'),
(10, 'muc cel mic2'),
(11, 'muc cel mic'),
(12, 'muc cel mic33'),
(13, 'author'),
(14, 'Gheorge'),
(15, 'muc cel mic4'),
(16, 'muc cel mic123');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `title` char(20) NOT NULL,
  `id_author` mediumint(9) NOT NULL,
  `description` char(40) NOT NULL,
  `insert_date` date DEFAULT NULL,
  `cvr_img_path` char(120) NOT NULL,
  `e_book_path` char(120) NOT NULL,
  `id_rate` mediumint(9) NOT NULL,
  `id_insert_user` mediumint(9) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_rate` (`id_rate`,`id_insert_user`),
  KEY `id_author` (`id_author`),
  KEY `id_insert_user` (`id_insert_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `id_author`, `description`, `insert_date`, `cvr_img_path`, `e_book_path`, `id_rate`, `id_insert_user`) VALUES
(5, 'alab ca zapada', 6, 'blablabla', '2012-09-26', '', '', 1, 3),
(11, 'muc cel mic123', 16, 'muc cel mic123', '2012-09-27', '', '', 1, 3),
(12, 'muc cel mic123', 16, 'muc cel mic123', '2012-09-27', 'D:\\webdev\\apache\\htdocs\\uploads\\muc cel mic123\\cvr_img\\', 'D:\\webdev\\apache\\htdocs\\uploads\\muc cel mic123\\ebook\\', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `rating_value`
--

CREATE TABLE IF NOT EXISTS `rating_value` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `value` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `rating_value`
--

INSERT INTO `rating_value` (`id`, `value`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_book_rating`
--

CREATE TABLE IF NOT EXISTS `user_book_rating` (
  `id_user` mediumint(9) NOT NULL,
  `id_rate` mediumint(9) NOT NULL,
  `id_book` mediumint(9) NOT NULL,
  KEY `id_user` (`id_user`,`id_rate`,`id_book`),
  KEY `id_book` (`id_book`),
  KEY `id_rate` (`id_rate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_book_rating`
--

INSERT INTO `user_book_rating` (`id_user`, `id_rate`, `id_book`) VALUES
(2, 4, 3),
(2, 4, 3),
(3, 3, 4),
(3, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_book_rights`
--

CREATE TABLE IF NOT EXISTS `user_book_rights` (
  `id_user` mediumint(9) NOT NULL,
  `id_book` mediumint(9) NOT NULL,
  `rights` bit(4) NOT NULL DEFAULT b'1',
  KEY `id_user` (`id_user`,`id_book`),
  KEY `id_book` (`id_book`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `username` char(15) DEFAULT NULL,
  `first_name` char(20) DEFAULT NULL,
  `last_name` char(20) DEFAULT NULL,
  `mail` char(30) DEFAULT NULL,
  `password` char(30) DEFAULT NULL,
  `ban_status` tinyint(1) NOT NULL DEFAULT '0',
  `rights` int(4) unsigned zerofill NOT NULL DEFAULT '0001',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `mail`, `password`, `ban_status`, `rights`) VALUES
(1, 'foo', NULL, NULL, NULL, 'foobar', 0, 0001),
(2, 'bar', NULL, NULL, NULL, 'barfoo', 0, 0001),
(3, 'baz', NULL, NULL, NULL, 'baz', 0, 0001),
(4, 'test', 'test', 'test', 'test', 'test', 0, 0001),
(5, 'test', 'test', 'test', 'test', 'test', 0, 0001),
(8, 'newuser', 'newuser', 'newuser', 'newuser', 'newuser', 0, 0001),
(12, 'usr', 'fn', 'ln', 'mail', 'psw', 0, 0001),
(13, 'root', 'root', 'root', 'root', 'recovery', 0, 1111);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`id_rate`) REFERENCES `rating_value` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_3` FOREIGN KEY (`id_insert_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `books_ibfk_4` FOREIGN KEY (`id_author`) REFERENCES `authors` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_book_rating`
--
ALTER TABLE `user_book_rating`
  ADD CONSTRAINT `user_book_rating_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_book_rating_ibfk_2` FOREIGN KEY (`id_rate`) REFERENCES `rating_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_book_rights`
--
ALTER TABLE `user_book_rights`
  ADD CONSTRAINT `user_book_rights_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_book_rights_ibfk_2` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
