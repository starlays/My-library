-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 11, 2012 at 01:06 PM
-- Server version: 5.5.22
-- PHP Version: 5.3.10

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
-- Table structure for table `admin_msg`
--

CREATE TABLE IF NOT EXISTS `admin_msg` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `id_admin` mediumint(9) NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_admin` (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_msg`
--

INSERT INTO `admin_msg` (`id`, `id_admin`, `message`, `date`) VALUES
(1, 13, 'Salutare...', '2012-10-11');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

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
(16, 'muc cel mic123'),
(17, 'george'),
(18, 'tata');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `id_author`, `description`, `insert_date`, `cvr_img_path`, `e_book_path`, `id_rate`, `id_insert_user`) VALUES
(13, 'alba ca zapada', 17, 'alala', '2012-10-09', 'E:\\webdev\\apache\\htdocs\\uploads\\alba ca zapada\\cvr_img\\', 'E:\\webdev\\apache\\htdocs\\uploads\\alba ca zapada\\ebook\\', 1, 13),
(14, 'george', 18, 'sdasdasd', '2012-10-09', 'E:\\webdev\\apache\\htdocs\\uploads\\george\\cvr_img\\', 'E:\\webdev\\apache\\htdocs\\uploads\\george\\ebook\\', 1, 13);

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
  `hash` varchar(32) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `mail`, `password`, `ban_status`, `rights`, `hash`, `active`) VALUES
(1, 'foo', NULL, NULL, NULL, 'foobar', 0, 0001, '', 0),
(2, 'bar', NULL, NULL, NULL, 'barfoo', 0, 0001, '', 0),
(3, 'baz', 'Dicu', 'George', NULL, 'baz', 0, 0001, '', 0),
(4, 'test', 'test', 'test', 'test', 'test', 0, 0001, '', 0),
(8, 'newuser', 'newuser', 'newuser', 'newuser', 'newuser', 0, 0001, '', 0),
(12, 'usr', 'fn', 'ln', 'mail', 'psw', 0, 0001, '', 0),
(13, 'root', 'root', 'root', 'root', 'root', 0, 1111, '', 1),
(14, 'mama', 'mama', 'mama', 'dicugeorge1987@yahoo.com', '123', 0, 0001, '', 0),
(15, 'xao', 'Dicu', 'George', 'xao_geo007@yahoo.com', 'test', 0, 0001, '0ff39bbbf981ac0151d340c9aa40e63e', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_msg`
--
ALTER TABLE `admin_msg`
  ADD CONSTRAINT `admin_msg_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
