-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 31, 2012 at 11:22 PM
-- Server version: 5.5.28-log
-- PHP Version: 5.4.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mylibrary`
--
DROP DATABASE `mylibrary`;
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
-- RELATIONS FOR TABLE `admin_msg`:
--   `id_admin`
--       `users` -> `id`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

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
(18, 'tata'),
(19, 'foo'),
(20, 'asdasd'),
(21, 'aaa');

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
  `rights` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_rate` (`id_rate`,`id_insert_user`),
  KEY `id_author` (`id_author`),
  KEY `id_insert_user` (`id_insert_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- RELATIONS FOR TABLE `books`:
--   `id_rate`
--       `rating_value` -> `id`
--   `id_insert_user`
--       `users` -> `id`
--   `id_author`
--       `authors` -> `id`
--

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `id_author`, `description`, `insert_date`, `cvr_img_path`, `e_book_path`, `id_rate`, `id_insert_user`, `rights`) VALUES
(15, 'Book', 19, 'bar', '2012-10-11', '/home/starlays/learning/My-library/webroot/uploads/Book/cvr_img/', '/home/starlays/learning/My-library/webroot/uploads/Book/ebook/', 1, 1, 7),
(16, 'Book 3', 19, 'test', '2012-10-16', '/home/starlays/learning/My-library/webroot/uploads/Book 3/cvr_img/', '/home/starlays/learning/My-library/webroot/uploads/Book 3/ebook/', 1, 13, 7),
(17, 'Book 4', 19, 'aaa', '2012-10-22', '/home/starlays/learning/My-library/webroot/uploads/Book 4/cvr_img/', '/home/starlays/learning/My-library/webroot/uploads/Book 4/ebook/', 1, 13, 3),
(19, 'Book 5', 21, 'test', '2012-10-25', '/home/starlays/learning/My-library/webroot/uploads/Book 5/cvr_img/', '/home/starlays/learning/My-library/webroot/uploads/Book 5/ebook/', 1, 13, 1);

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
-- RELATIONS FOR TABLE `user_book_rating`:
--   `id_user`
--       `users` -> `id`
--   `id_rate`
--       `rating_value` -> `id`
--

--
-- Dumping data for table `user_book_rating`
--

INSERT INTO `user_book_rating` (`id_user`, `id_rate`, `id_book`) VALUES
(2, 4, 3),
(2, 4, 3),
(3, 3, 4),
(3, 3, 4),
(13, 1, 18),
(13, 2, 19),
(13, 4, 16),
(13, 4, 17);

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
  `rights` int(1) NOT NULL DEFAULT '1',
  `hash` varchar(32) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `mail`, `password`, `ban_status`, `rights`, `hash`, `active`) VALUES
(1, 'foo', NULL, NULL, NULL, 'foobar', 0, 1, '', 0),
(2, 'bar', NULL, NULL, NULL, 'barfoo', 0, 1, '', 0),
(3, 'baz', 'Dicu', 'George', NULL, 'baz', 0, 1, '', 0),
(4, 'test', 'test', 'test', 'test', 'test', 0, 1, '', 0),
(8, 'newuser', 'newuser', 'newuser', 'newuser', 'newuser', 0, 1, '', 0),
(12, 'usr', 'fn', 'ln', 'mail', 'psw', 0, 1, '', 0),
(13, 'root', 'root', 'root', 'root', 'root', 0, 7, '', 1),
(15, 'xao', 'Dicu', 'George', 'xao_geo007@yahoo.com', 'test', 0, 15, '0ff39bbbf981ac0151d340c9aa40e63e', 0),
(16, 'barfoo', 'florin', 'test', 'foo@bar.com', 'barfoo', 0, 1, '289dff07669d7a23de0ef88d2f7129e7', 0);

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
