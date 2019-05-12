-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2017 at 03:18 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_borrow`
--

CREATE TABLE `book_borrow` (
  `BorrowID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `FinesPerDay` double NOT NULL,
  `FinesPrice` double NOT NULL,
  `Status` varchar(9) NOT NULL COMMENT 'Borrow or Return',
  `ReturnDate` datetime NOT NULL,
  `GoodReturn` int(11) NOT NULL,
  `BrokenReturn` int(11) NOT NULL,
  `MissingReturn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_borrow`
--

INSERT INTO `book_borrow` (`BorrowID`, `BookID`, `Quantity`, `FinesPerDay`, `FinesPrice`, `Status`, `ReturnDate`, `GoodReturn`, `BrokenReturn`, `MissingReturn`) VALUES
(1, 1, 1, 1000, 50000, 'Return', '2017-01-05 00:00:00', 1, 0, 0),
(1, 1, 1, 1000, 50000, 'Return', '2017-01-05 00:00:00', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_data`
--

CREATE TABLE `book_data` (
  `BookID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Types` varchar(100) NOT NULL,
  `FinesPerDay` double NOT NULL,
  `Loaned` varchar(5) NOT NULL COMMENT 'true or false',
  `ComeDate` datetime NOT NULL,
  `Writer` varchar(100) NOT NULL,
  `Publisher` varchar(100) NOT NULL,
  `NumberOfPage` int(11) NOT NULL,
  `Synopsis` text NOT NULL,
  `Donation` varchar(5) NOT NULL COMMENT 'true of false',
  `Price` double NOT NULL,
  `NumberOfGood` int(11) NOT NULL,
  `NumberOfBroken` int(11) NOT NULL,
  `NumberOfMissing` int(11) NOT NULL,
  `CountOfLoaned` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_data`
--

INSERT INTO `book_data` (`BookID`, `Name`, `Types`, `FinesPerDay`, `Loaned`, `ComeDate`, `Writer`, `Publisher`, `NumberOfPage`, `Synopsis`, `Donation`, `Price`, `NumberOfGood`, `NumberOfBroken`, `NumberOfMissing`, `CountOfLoaned`) VALUES
(1, 'Tutorial PHP', 'Education', 1000, 'true', '2016-12-26 00:00:00', 'Muhammad Fathan Al-Ghifary', 'Fara Rafa Corp', 195, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'false', 50000, 7, 0, 0, 0),
(2, 'Tutorial C# CUI', 'Education', 1000, 'true', '2016-12-27 00:00:00', 'Muhammad Fathan Al-Ghifary', 'Fara Rafa Corp', 89, '.Net adalah revolusioner platform dibuat oleh Microsoft untuk pembuatan (developing) aplikasi. Hal yang paling menarik dalam pembahasan kali ini adalah bagaimana cara “Developing Application on Windows Operating System” (pembuatan aplikasi di Windows OS).  Salah satu contohnya adalah Mono, sebuah versi open-source dari .Net Framework (termasuk C#) akan berjalan di beberapa system operasi, termasuk dapat berjalan pula di Linux dan Mac OS. Dalam kondisi tertentu kamu dapat menggunakan Microsoft .Net Compact Framework (Essentially subset of the full .Net Framework) pada asisten personal digital (PDA)  perangkat kelas dan bahkan beberapa smart phone.', 'false', 50000, 2, 2, 0, -2),
(4, 'Aurora', 'Education', 1, 'true', '0000-00-00 00:00:00', 'neoso', 'Fara Rafa Corp', 2, 'bla bla bla bla', 'true', 1000, 1, 0, 0, 0),
(5, 'filsafat', 'Education', 1, 'true', '1999-06-06 00:00:00', 'neoso', 'Fara Rafa Corp', 12, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'true', 100, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_storage`
--

CREATE TABLE `book_storage` (
  `BookID` int(11) NOT NULL,
  `Floor` varchar(20) NOT NULL,
  `Corridor` varchar(50) NOT NULL,
  `Rack` varchar(50) NOT NULL,
  `Level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_storage`
--

INSERT INTO `book_storage` (`BookID`, `Floor`, `Corridor`, `Rack`, `Level`) VALUES
(1, 'Lower Ground', 'Education', 'Lesson', 1),
(2, '1', 'Office Check', 'Table officer', 0),
(4, '1', 'Office Check', 'Table officer', 0),
(5, '1', 'Office Check', 'Table officer', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment_data`
--

CREATE TABLE `comment_data` (
  `CommentID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `CommentValue` text NOT NULL,
  `CommentDate` datetime NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `Email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_data`
--

INSERT INTO `comment_data` (`CommentID`, `Name`, `CommentValue`, `CommentDate`, `PhoneNumber`, `Email`) VALUES
(2, 'Hans', 'Hello, ini adalah comment. Comment gaje', '2016-12-30 05:02:42', '081234567890', 'something@example.com'),
(3, 'Mugiarsa', 'perpustakaan is the best', '2017-04-18 09:31:14', '083819931111', 'alfie@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `employee_data`
--

CREATE TABLE `employee_data` (
  `EmployeeID` varchar(100) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Gender` varchar(6) NOT NULL COMMENT 'Male of Female',
  `Religion` varchar(10) NOT NULL,
  `PlaceOfBirth` varchar(100) NOT NULL,
  `DateOfBirth` datetime NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Address` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_data`
--

INSERT INTO `employee_data` (`EmployeeID`, `FullName`, `Gender`, `Religion`, `PlaceOfBirth`, `DateOfBirth`, `PhoneNumber`, `Email`, `Address`) VALUES
('--------', 'Ardabilly', 'Male', 'islam', 'Bogor', '2000-12-01 00:00:00', '0838299', '', ''),
('101112131415', 'Muhammad Kurtubi', 'Male', 'Islam', 'Bogor', '1999-12-21 00:00:00', '08567115077911', 'kurtubi@gmail.com', 'CIJULANG GUYS'),
('11111', 'Muhammad Ambari', 'Male', 'Islam', 'Bogor', '1999-06-02 00:00:00', '0856711507798', 'mmmmm@gmail.com', 'kp bbakan');

-- --------------------------------------------------------

--
-- Table structure for table `employee_login`
--

CREATE TABLE `employee_login` (
  `EmployeeID` varchar(100) NOT NULL,
  `Usernames` varchar(200) NOT NULL,
  `Passwords` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_login`
--

INSERT INTO `employee_login` (`EmployeeID`, `Usernames`, `Passwords`) VALUES
('--------', 'ardabilly', '4QrcOUm6Wau+VuBX8g+IPg==');

-- --------------------------------------------------------

--
-- Table structure for table `member_borrow`
--

CREATE TABLE `member_borrow` (
  `BorrowID` int(11) NOT NULL,
  `MemberID` varchar(10) NOT NULL,
  `EmployeeID` varchar(100) NOT NULL,
  `BorrowDate` datetime NOT NULL,
  `ReturnDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_borrow`
--

INSERT INTO `member_borrow` (`BorrowID`, `MemberID`, `EmployeeID`, `BorrowDate`, `ReturnDate`) VALUES
(1, '0000000001', '--------', '2017-01-01 00:00:00', '2017-01-02 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `member_data`
--

CREATE TABLE `member_data` (
  `MemberID` varchar(10) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Gender` varchar(6) NOT NULL COMMENT 'Male of Female',
  `Religion` varchar(10) NOT NULL,
  `PlaceOfBirth` varchar(100) NOT NULL,
  `DateOfBirth` datetime NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Address` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_data`
--

INSERT INTO `member_data` (`MemberID`, `FullName`, `Gender`, `Religion`, `PlaceOfBirth`, `DateOfBirth`, `PhoneNumber`, `Email`, `Address`) VALUES
('0000000001', 'Qwerty Keyboard', 'Male', 'Islam', 'Bogor', '2000-01-01 00:00:00', '083819937855', 'nurulsyifa541@gmail.com', 'unknown street'),
('0000000002', 'Mochamad Arda Billy', 'Male', 'Islam', 'Bogor', '1999-02-05 00:00:00', '083819937855', 'aditya@gmail.com', 'kp babakan'),
('0000000003', 'Andika', 'Male', 'Islam', 'Bogor', '2000-02-06 00:00:00', '083819931111', 'aditya@gmail.com', 'aaaaaaaaaaaaaaaaaaaaaaaaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `news_data`
--

CREATE TABLE `news_data` (
  `NewsID` int(11) NOT NULL,
  `DatePosting` datetime NOT NULL,
  `NewsTitle` varchar(200) NOT NULL,
  `NewsValue` text NOT NULL,
  `EmployeeID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_data`
--

INSERT INTO `news_data` (`NewsID`, `DatePosting`, `NewsTitle`, `NewsValue`, `EmployeeID`) VALUES
(1, '2016-12-28 13:43:05', 'Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '--------'),
(2, '2016-12-28 14:18:24', 'dolor sit', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '--------');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_borrow`
--
ALTER TABLE `book_borrow`
  ADD KEY `BorrowID` (`BorrowID`),
  ADD KEY `BookID` (`BookID`);

--
-- Indexes for table `book_data`
--
ALTER TABLE `book_data`
  ADD PRIMARY KEY (`BookID`);

--
-- Indexes for table `book_storage`
--
ALTER TABLE `book_storage`
  ADD KEY `book_storage_ibfk_1` (`BookID`);

--
-- Indexes for table `comment_data`
--
ALTER TABLE `comment_data`
  ADD PRIMARY KEY (`CommentID`);

--
-- Indexes for table `employee_data`
--
ALTER TABLE `employee_data`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `employee_login`
--
ALTER TABLE `employee_login`
  ADD KEY `employee_login_ibfk_1` (`EmployeeID`);

--
-- Indexes for table `member_borrow`
--
ALTER TABLE `member_borrow`
  ADD PRIMARY KEY (`BorrowID`),
  ADD KEY `MemberID` (`MemberID`),
  ADD KEY `member_borrow_ibfk_2` (`EmployeeID`);

--
-- Indexes for table `member_data`
--
ALTER TABLE `member_data`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `news_data`
--
ALTER TABLE `news_data`
  ADD PRIMARY KEY (`NewsID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_borrow`
--
ALTER TABLE `book_borrow`
  ADD CONSTRAINT `book_borrow_ibfk_1` FOREIGN KEY (`BorrowID`) REFERENCES `member_borrow` (`BorrowID`),
  ADD CONSTRAINT `book_borrow_ibfk_2` FOREIGN KEY (`BookID`) REFERENCES `book_data` (`BookID`);

--
-- Constraints for table `book_storage`
--
ALTER TABLE `book_storage`
  ADD CONSTRAINT `book_storage_ibfk_1` FOREIGN KEY (`BookID`) REFERENCES `book_data` (`BookID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_login`
--
ALTER TABLE `employee_login`
  ADD CONSTRAINT `employee_login_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee_data` (`EmployeeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member_borrow`
--
ALTER TABLE `member_borrow`
  ADD CONSTRAINT `member_borrow_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member_data` (`MemberID`),
  ADD CONSTRAINT `member_borrow_ibfk_2` FOREIGN KEY (`EmployeeID`) REFERENCES `employee_data` (`EmployeeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news_data`
--
ALTER TABLE `news_data`
  ADD CONSTRAINT `news_data_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employee_data` (`EmployeeID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
