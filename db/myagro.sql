-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 24, 2016 at 01:29 AM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myagro`
--

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE IF NOT EXISTS `bid` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `proid` int(10) NOT NULL,
  `bidderid` int(10) NOT NULL,
  `price` int(100) NOT NULL,
  `posistion` varchar(100) NOT NULL DEFAULT 'NotSelected',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


-- --------------------------------------------------------

--
-- Table structure for table `bidproducts`
--

CREATE TABLE IF NOT EXISTS `bidproducts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `descr` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postedby` int(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `verified` varchar(10) NOT NULL DEFAULT 'no',
  `completed` varchar(100) NOT NULL DEFAULT '0',
  `winnerId` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `descr` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `subcategory` varchar(100) NOT NULL,
  `dateadded` date NOT NULL,
  `img` varchar(100) NOT NULL,
  `userid` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;


-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `addr1` varchar(100) NOT NULL,
  `addr2` varchar(100) NOT NULL,
  `dist` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pin` int(100) NOT NULL,
  `profilepic` varchar(100) NOT NULL,
  `acres` int(100) NOT NULL,
  `cul` int(100) NOT NULL,
  `amt` int(100) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `uid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `publicchat`
--

CREATE TABLE IF NOT EXISTS `publicchat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sid` int(10) NOT NULL,
  `msg` varchar(100) NOT NULL,
  `dandt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;


-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE IF NOT EXISTS `register` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pno` varchar(100) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pass` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;


-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE IF NOT EXISTS `finance` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `datedo` date NOT NULL,
  `postedby` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
