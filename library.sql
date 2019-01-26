-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 06, 2014 at 07:23 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `library`;
USE `library`;
--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` varchar(10) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `author_name` varchar(30) NOT NULL,
  `publisher` varchar(25) NOT NULL,
  `publication_year` varchar(10) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `borrower_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_name`, `author_name`, `publisher`, `publication_year`, `subject`, `borrower_id`) VALUES
('java01', 'core java volume 1 fundamental', 'Cay S Horstmann', 'Sun microsystem', '2007', 'Java Programming', '115127'),
('c0001', 'Let Us C', 'Yashavant P Kanetkar', 'BPB Publications', '2010', 'C Programming', ''),
('n0001', 'Data Communications and Networking', 'Behrouz A. Forouzan', 'Huga Media', '2007', 'Computer Networks', ''),
('Em001', 'Computers as Components: Principles of Embedded Computing System Design', 'Wayne Wolf', 'Morgan Kaufmann', '2008', 'Embedded System', ''),
('phy001', 'Engineering Physics II', 'P.K.Palanisamy', 'Scitech publication', '2008', 'Physics', '');

-- --------------------------------------------------------

--
-- Table structure for table `liblogin`
--

CREATE TABLE IF NOT EXISTS `liblogin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `liblogin`
--

INSERT INTO `liblogin` (`username`, `password`, `name`) VALUES
('bala', 'klncit', 'Bala Subramani');

-- --------------------------------------------------------

--
-- Table structure for table `stafflogin`
--

CREATE TABLE IF NOT EXISTS `stafflogin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `dept` varchar(10) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stafflogin`
--

INSERT INTO `stafflogin` (`username`, `password`, `name`, `dept`) VALUES
('aselvaraj', 'selvaraj', 'A Selvaraj', 'IT'),
('cpandian', 'pandian', 'C Pandian', 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `studentlogin`
--

CREATE TABLE IF NOT EXISTS `studentlogin` (
  `username` int(10) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `year` int(5) NOT NULL,
  `dept` varchar(10) NOT NULL,
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentlogin`
--

INSERT INTO `studentlogin` (`username`, `password`, `name`, `year`, `dept`) VALUES
(100001, 'aishwarya', 'Aishwarya', 4, 'ECE'),
(115041, 'dharani', 'Dharani N', 4, 'IT'),
(115127, 'ashok', 'Ashok GSV', 4, 'IT'),
(115132, 'manoj', 'Manoj Kumar', 4, 'IT'),
(115301, 'gowtham', 'Gowtham V', 4, 'IT');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
