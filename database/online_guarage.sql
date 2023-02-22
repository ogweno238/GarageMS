-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 17, 2022 at 12:56 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `online_guarage`
--
CREATE DATABASE IF NOT EXISTS `online_guarage` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `online_guarage`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` varchar(40) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `username`, `password`, `role`) VALUES
(2, 'admin', '2121', 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `falied`
--

CREATE TABLE IF NOT EXISTS `falied` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attempt` int(11) NOT NULL,
  `time` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `falied`
--

INSERT INTO `falied` (`id`, `attempt`, `time`) VALUES
(1, 1, '00:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `guarage`
--

CREATE TABLE IF NOT EXISTS `guarage` (
  `guarage_id` int(11) NOT NULL AUTO_INCREMENT,
  `guarage_num` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `guarage` varchar(200) NOT NULL,
  `guarage_desc` varchar(255) NOT NULL,
  `price` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`guarage_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `guarage`
--

INSERT INTO `guarage` (`guarage_id`, `guarage_num`, `location_id`, `guarage`, `guarage_desc`, `price`, `status`) VALUES
(1, 4, 1, 'Puncher', 'best', '6000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `location` varchar(200) NOT NULL,
  `locationdesc` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location_id`, `location`, `locationdesc`) VALUES
(1, 1, 'Karura', 'kariura forest');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `attempt` int(11) NOT NULL,
  `status` varchar(60) NOT NULL,
  `date` date NOT NULL,
  `last_logindatetime` datetime NOT NULL,
  `last_logoutdatetime` datetime NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `national_id` varchar(200) NOT NULL,
  `residence` varchar(200) NOT NULL,
  `checkout` int(11) NOT NULL,
  PRIMARY KEY (`profile_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `servicedetails`
--

CREATE TABLE IF NOT EXISTS `servicedetails` (
  `servicedetails_id` int(11) NOT NULL AUTO_INCREMENT,
  `guarage_Id` int(11) NOT NULL,
  `service_id` varchar(200) NOT NULL,
  `service_status` varchar(200) NOT NULL,
  `date_return` varchar(100) NOT NULL,
  PRIMARY KEY (`servicedetails_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

CREATE TABLE IF NOT EXISTS `tbl_service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `date_requested` varchar(200) NOT NULL,
  `due_date` varchar(200) NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
