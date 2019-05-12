-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2017 at 05:40 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belajarakun`
--

-- --------------------------------------------------------

--
-- Table structure for table `people_data`
--

CREATE TABLE `people_data` (
  `PeopleID` int(11) NOT NULL,
  `FullName` varchar(200) NOT NULL,
  `NickName` varchar(100) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Religion` varchar(20) NOT NULL,
  `PlaceOfBirth` varchar(100) NOT NULL,
  `DataOfBirth` datetime NOT NULL,
  `PhoneNumber` varchar(50) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Address` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `people_login`
--

CREATE TABLE `people_login` (
  `PeopleID` int(11) NOT NULL,
  `Usernames` varchar(200) NOT NULL,
  `Passwords` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `people_data`
--
ALTER TABLE `people_data`
  ADD PRIMARY KEY (`PeopleID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
