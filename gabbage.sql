-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2015 at 04:01 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gabbage`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
  (1, 'admin', '4851'),
  (6, 'boaz', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nat_id` int(11) NOT NULL,
  `password` text NOT NULL,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `location` text NOT NULL,
  `mobile_no` text NOT NULL,
  `gabbage_type` text NOT NULL,
  `application_date` text NOT NULL,
  `confirmation_code` text NOT NULL,
  `payment_status` text NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `nat_id`, `password`, `f_name`, `l_name`, `location`, `mobile_no`, `gabbage_type`, `application_date`, `confirmation_code`, `payment_status`, `amount`) VALUES
  (25, 29949298, '5d40954183d62a82257835477ccad3d2', 'karanja', 'wakio', 'Thika town', '0775846954', 'Harzadous', 'May 28, 2015', '', '0', 0),
  (26, 29949299, '8b1753bd5706fff3c62c790e4707f441', 'Jermiah', 'walia', 'Landless', '0725545465', 'Degrdable', 'May 28, 2015', 'ADBREKWKE', '1', 1700),
  (28, 44444444, '81dc9bdb52d04dc20036dbd8313ed055', 'Njoroge', 'Kamau', 'Makonge', '0758469584', 'Degrdable', 'May 28, 2015', 'GWT10525YT', '1', 1270);

-- --------------------------------------------------------

--
-- Table structure for table `gabbage_type`
--

CREATE TABLE IF NOT EXISTS `gabbage_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `charges` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `gabbage_type`
--

INSERT INTO `gabbage_type` (`id`, `name`, `charges`) VALUES
  (1, 'Harzadous', '500'),
  (3, 'degrdable', '800'),
  (5, 'Bio', '500');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` text NOT NULL,
  `charges` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `location`
--

INSERT INTO ,"location" (`id`, `location`, `charges`) VALUES
  (1, 'thika town', '470'),
  (3, 'Makonge', '470'),
  (5, 'Landless', '900'),
  (8, 'Mukereti', '500');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` text NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `date`, `details`) VALUES
  (9, 'Thursday 28th May 2015 ', 'This is testing post number one done by administrator');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
