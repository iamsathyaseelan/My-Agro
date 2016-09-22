-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 22, 2016 at 03:09 PM
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`id`, `proid`, `bidderid`, `price`) VALUES
(1, 1, 7, 700),
(2, 1, 9, 34);

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bidproducts`
--

INSERT INTO `bidproducts` (`id`, `price`, `quantity`, `descr`, `name`, `dateadded`, `postedby`, `img`, `verified`) VALUES
(1, 520, 2, 'hi', 'ssa@g.com', '2016-09-21 17:57:38', 7, 'img/748163754.jpg', 'yes');

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

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `descr`, `price`, `unit`, `subcategory`, `dateadded`, `img`, `userid`) VALUES
(11, 'ss', 'ss', 0, 'ss', 'as', '2016-09-18', 'img/647157549.jpg', 0),
(12, 's', 'ss\r\n', 0, 's', '', '2016-09-18', 'img/1234209874.jpg', 0),
(13, 'ARTTGH', 'dsd', 0, 'FDFHJD', 'as', '2016-09-18', 'img/682322616.jpg', 0),
(14, 'ewyhhdrhds', 'dfsgdhgds', 0, 'FDFHJD', 'as', '2016-09-19', 'img/550602014.jpg', 7);

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

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `fname`, `lname`, `addr1`, `addr2`, `dist`, `state`, `pin`, `profilepic`, `acres`, `cul`, `amt`, `startdate`, `enddate`, `uid`) VALUES
(1, 'sathya', 'seelan', 'kangayam', 'erode', 'erode', 'tamilnadu', 638701, '../profilepic/img.png', 8, 6, 90, '2016-09-15', '2017-09-15', 4),
(2, 'sathya', 'seelan', 'kangayam', 'erode', 'erode', 'tamilnadu', 638701, 'img/profilepic/img.png', 8, 6, 90, '2016-09-15', '2017-09-15', 4),
(3, 'sathya', 'seelan', 'kangayam', 'erode', 'erode', 'tamilnadu', 638701, 'img/profilepic/img.png', 8, 6, 90, '2016-09-15', '2017-09-15', 4),
(4, 'sathyaseelan', 'seelan', 'kangayam', 'erode', 'erode', 'tamilnadu', 638701, 'img/profilepic/img.png', 8, 6, 90, '2016-09-15', '2017-09-15', 4),
(5, 's', 'su', '', '', 'er', 'dd', 90, 'img/profilepic/img.png', 8, 6, 90, '2016-09-15', '2017-09-15', 4),
(6, 's', 'su', 'xdd', 'ddc', 'er', 'dd', 90, 'img/profilepic/img.png', 8, 6, 90, '2016-09-15', '2017-09-15', 4),
(7, 'sathyaseelan', 'sub', 'palamarathu thottam', 'goundampalayam,kadiyur', 'Erode', 'Tamilnadu', 638701, 'img/profilepic/9.jpg', 55, 45, 80000022, '2016-08-23', '2017-08-23', 9);

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

--
-- Dumping data for table `publicchat`
--

INSERT INTO `publicchat` (`id`, `sid`, `msg`, `dandt`) VALUES
(1, 7, 'hi', '2016-09-15 06:39:52'),
(2, 7, 'h', '2016-09-15 06:47:25'),
(3, 7, 'h', '2016-09-15 06:47:27'),
(4, 7, 'mgfj', '2016-09-15 06:50:59'),
(5, 9, 'summa', '2016-09-15 08:41:48'),
(6, 9, 'wrgdgdg rrggfs dsfshdgg fjj  rsrf rff iwilf  rfbl  lwlfrrg rf', '2016-09-15 08:42:26'),
(7, 9, 'dfsdfsdb sdssfsds dfdhndf dbb dgb6 djukg', '2016-09-15 08:42:53'),
(8, 9, 'fjg', '2016-09-15 08:42:56'),
(9, 9, 'fukf', '2016-09-15 08:43:02'),
(10, 9, 'fukf', '2016-09-15 08:43:41'),
(11, 9, 'ss', '2016-09-15 08:45:05');

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

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `uname`, `email`, `pno`, `datecreated`, `pass`, `occupation`) VALUES
(1, 's', 'ssa@g.co', '45', '2016-09-10 06:33:23', 'sa', 'ss'),
(2, 's', 'ss', '87', '2016-09-10 06:55:47', 'ssa', 'sa'),
(3, 's', 'ss', '87', '2016-09-10 06:56:37', 'ssa', 'Industrialists'),
(4, 's', 'ss', '87', '2016-09-10 06:56:59', 'sa', 'Industrialists'),
(5, 'sa', 'iamsathyaseelan@gmail.com', '45', '2016-09-10 06:58:18', 'sa', 'Industrialists'),
(6, 'sa', 'sa@gm.nm', '54', '2016-09-10 06:59:05', 'sa', 'Industrialists'),
(7, 'sa', 'sa@gm.nms', '54', '2016-09-11 05:39:46', 'sa', 'Farmer'),
(8, 'sa', 'sa@dsfgy.vn', '3456', '2016-09-11 06:15:02', 'dsa', 'Dealer'),
(9, 'sathyaseelan', 'ssa@g.com', '9976016102', '2016-09-15 08:41:09', 'sa', 'Farmer');
