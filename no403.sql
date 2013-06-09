-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 27, 2013 at 08:22 AM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `no403`
--

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE IF NOT EXISTS `attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `value` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modifier_id` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_deletd` char(1) COLLATE utf8_bin DEFAULT 'F',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `code` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `type` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `url` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `description` varchar(2000) COLLATE utf8_bin DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modifier_id` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_deleted` char(1) COLLATE utf8_bin DEFAULT 'F',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(4000) COLLATE utf8_bin DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `is_deleted` char(1) COLLATE utf8_bin DEFAULT 'F',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `subject` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `body` varchar(4000) COLLATE utf8_bin DEFAULT NULL,
  `send_date` datetime DEFAULT NULL,
  `recv_date` datetime DEFAULT NULL,
  `is_read` char(1) COLLATE utf8_bin DEFAULT NULL,
  `is_deleted` char(1) COLLATE utf8_bin DEFAULT 'F',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE IF NOT EXISTS `program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `physical_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `picture` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `source_website` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `dowunload_num` int(11) DEFAULT NULL,
  `version` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `multi_version` tinyint(1) DEFAULT NULL,
  `next_version_date` date DEFAULT NULL,
  `size` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `description` varchar(2000) COLLATE utf8_bin DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `modifier_id` int(11) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `is_deleted` char(1) COLLATE utf8_bin DEFAULT 'F',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `programCategory`
--

CREATE TABLE IF NOT EXISTS `programCategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prog_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `program_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `program_url` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `program_description` varchar(4000) COLLATE utf8_bin DEFAULT NULL,
  `request_date` datetime DEFAULT NULL,
  `respond_date` datetime DEFAULT NULL,
  `approved` char(1) COLLATE utf8_bin DEFAULT 'F',
  `note` varchar(4000) COLLATE utf8_bin DEFAULT NULL,
  `responder_id` int(11) DEFAULT NULL,
  `is_deleted` char(1) COLLATE utf8_bin DEFAULT 'F',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `respond`
--

CREATE TABLE IF NOT EXISTS `respond` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) DEFAULT NULL,
  `type` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `body` varchar(4000) COLLATE utf8_bin DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `respond_date` datetime DEFAULT NULL,
  `is_deleted` char(1) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `permission` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `modifier_id` int(11) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `is_deleted` varchar(1) COLLATE utf8_bin DEFAULT 'F',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `permission`, `creator_id`, `created_date`, `modifier_id`, `modified_date`, `is_deleted`) VALUES
(5, 'مهند شب قلعية', 'e10adc3949ba59abbe56e057f20f883e', 'ms.kaleia@gmail.com', 'ADMIN', 0, '0000-00-00', 0, '0000-00-00', 'F'),
(6, 'New user ', '123456', 'new@user.com', 'ADMIN', 0, '0000-00-00', 0, '0000-00-00', 'F'),
(7, 'rami', 'e10adc3949ba59abbe56e057f20f883e', 'ramiaqqad@gmail.fr', 'ADMIN', 0, '0000-00-00', 0, '0000-00-00', 'F'),
(8, 'Molham', 'e10adc3949ba59abbe56e057f20f883e', 'mulham@gmail.com', 'ADMIN', 0, '0000-00-00', 0, '0000-00-00', 'F'),
(10, 'husam', 'e10adc3949ba59abbe56e057f20f883e', 'husam@gmail.com', 'ADMIN', 0, '0000-00-00', 0, '0000-00-00', 'F'),
(11, 'momo', '4297f44b13955235245b2497399d7a93', 'mom@momo.com', 'USER', 0, '0000-00-00', 0, '0000-00-00', 'F'),
(12, 'test', '5f4dcc3b5aa765d61d8327deb882cf99', 'test@test.com', 'ADMIN', 0, '0000-00-00', 0, '0000-00-00', 'F'),
(13, 'حسام شب قلعية', 'e10adc3949ba59abbe56e057f20f883e', 'husam_vc@hotmail.com', 'ADMIN', 0, '0000-00-00', 0, '0000-00-00', 'F'),
(14, 'رامي عقاد', 'e10adc3949ba59abbe56e057f20f883e', 'rami@rami.com', 'ADMIN', 0, '0000-00-00', 0, '0000-00-00', 'F'),
(15, 'toto', 'e10adc3949ba59abbe56e057f20f883e', 'tot@t.com', 'USER', 0, '0000-00-00', 0, '0000-00-00', 'T'),
(16, 'indicator', 'e10adc3949ba59abbe56e057f20f883e', 'd@jiji.com', 'ADMIN', 0, '2012-12-13', 0, '0000-00-00', 'F');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
