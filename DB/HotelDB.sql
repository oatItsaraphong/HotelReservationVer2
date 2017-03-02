-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 02, 2017 at 01:26 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `HotelDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `EmployeeTable`
--

CREATE TABLE `EmployeeTable` (
  `EmployeeID` int(11) UNSIGNED NOT NULL,
  `UserName` tinytext NOT NULL,
  `EmployeeName` varchar(100) NOT NULL,
  `EntryDate` date DEFAULT NULL,
  `Password` varchar(20) NOT NULL,
  `Permission` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `EmployeeTable`
--

INSERT INTO `EmployeeTable` (`EmployeeID`, `UserName`, `EmployeeName`, `EntryDate`, `Password`, `Permission`) VALUES
(0, 'Admin', 'Minion', NULL, '112233', 2),
(1122, 'PGFamilyGuy', 'Peter Griffin', NULL, '123456', 1),
(1133, 'SLOffice', 'Stan Lee', NULL, '654321', 1);

-- --------------------------------------------------------

--
-- Table structure for table `GuestTable`
--

CREATE TABLE `GuestTable` (
  `GuestIDNum` int(11) UNSIGNED NOT NULL,
  `GuestName` varchar(100) NOT NULL,
  `GuestTel` bigint(20) UNSIGNED DEFAULT NULL,
  `GuestEmail` varchar(70) DEFAULT NULL,
  `GuestNumberOfVisit` smallint(6) DEFAULT '0',
  `GuestComment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `GuestTable`
--

INSERT INTO `GuestTable` (`GuestIDNum`, `GuestName`, `GuestTel`, `GuestEmail`, `GuestNumberOfVisit`, `GuestComment`) VALUES
(15, 'Alpha November', 123456345, '', 0, ''),
(16, 'Bravo Oscar', 1231231233, '', 0, ''),
(17, 'Chalies Papa', 0, 'Et@gmail.com', 0, ''),
(18, 'Delta Quebec', 0, 'mymail@yahoo.com', 0, 'forth'),
(19, 'Echo Romeo', 32134321, 'yahooo@yahoo.com', 0, 'fifth'),
(20, 'Foxtrot Sierra', 8231343321, 'boo@hotmail.com', 0, 'sixth'),
(21, 'Golf Tango', 0, 'Foo@fool.com', 0, 'seveth'),
(22, '&#3626;&#3634;&#3607; &#3652;&#3627;', 81343211234321, 'ffe aasdfcs', 0, '&#3635;&#3654;&#3635;&#3607;&#3639;'),
(23, 'India Victor', 0, 'boogooloo@yahoooooo.co.th', 0, 'alkdfakjfd;lkajlkfjk;ajd;lfkjakldjflkasdfjlk'),
(24, 'Lima Yankee', 9012345689, 'bb@time.com', 0, 'bonae'),
(25, 'Mike Zulu', 2223334444, 'adfda@ee.com', 0, ''),
(30, 'Kilo Xray', 1122334455, 'adfad@eeedn.com', 0, ''),
(31, 'alpah papa', 43224524352345, 'dasdf', 0, ''),
(32, 'Sombra Nano', 123123, 'talon@gmail.com', 0, 'book'),
(33, 'Reaper Talon', 765432, 'talon@gmail.com', 0, 'mask'),
(34, 'Tracer Bake', 241123, 'asdf', 0, ''),
(35, 'philip j fry', 3656869879, 'planetEexpressFry@gmail.com', 0, 'Im a delivery boy!'),
(36, 'Joe Dirt', 54321654, 'joe@gmail.com', 0, 'weed');

-- --------------------------------------------------------

--
-- Table structure for table `ReservationTable`
--

CREATE TABLE `ReservationTable` (
  `ReservationID` int(11) UNSIGNED NOT NULL,
  `CheckInDate` date NOT NULL,
  `CheckOutDate` date NOT NULL,
  `ReservedRoom` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `ReservedForGuest` int(11) UNSIGNED NOT NULL,
  `NumberOfGuest` tinyint(3) UNSIGNED DEFAULT NULL,
  `ReseredFrom` varchar(50) DEFAULT NULL,
  `PaymentMethod` varchar(13) DEFAULT 'None',
  `Statue` varchar(10) NOT NULL,
  `PaidAmount` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `DiscountPercent` int(11) NOT NULL DEFAULT '0',
  `HandlerEmployee` int(11) UNSIGNED DEFAULT NULL,
  `ReservedComment` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ReservationTable`
--

INSERT INTO `ReservationTable` (`ReservationID`, `CheckInDate`, `CheckOutDate`, `ReservedRoom`, `ReservedForGuest`, `NumberOfGuest`, `ReseredFrom`, `PaymentMethod`, `Statue`, `PaidAmount`, `DiscountPercent`, `HandlerEmployee`, `ReservedComment`) VALUES
(1047, '2017-03-13', '2017-03-16', 302, 34, 2, '', 'None', 'Check In', 0, 0, 1122, 'I want a pillow fortress'),
(1048, '2017-03-13', '2017-03-16', 204, 35, 2, '', 'None', 'Reserved', 0, 0, 1122, 'I want all the channels and anchovy pizza'),
(1049, '2017-02-26', '2017-02-28', 201, 18, 3, 'book', 'Cash', 'Check Out', 2400, 0, 1122, 'na'),
(1050, '2017-02-28', '2017-03-05', 201, 18, 1, '23', 'None', 'Check In', 0, 0, 1122, '123'),
(1051, '2017-02-28', '2017-03-10', 203, 31, 2, 'bone', 'None', 'Reserved', 0, 0, 1122, 'thest'),
(1052, '2017-03-01', '2017-03-05', 301, 17, 1, 'booking', 'None', 'Reserved', 0, 0, 1122, 'test'),
(1053, '2017-02-28', '2017-03-05', 204, 32, 2, 'Kayak', 'None', 'Check In', 0, 0, 1122, 'nohting');

-- --------------------------------------------------------

--
-- Table structure for table `ResevHistoryTable`
--

CREATE TABLE `ResevHistoryTable` (
  `ResevHisID` int(11) UNSIGNED NOT NULL,
  `ResevID` int(11) UNSIGNED NOT NULL,
  `HisCheckInDate` date NOT NULL,
  `HisCheckOutDate` date NOT NULL,
  `ResevRoom` smallint(5) UNSIGNED NOT NULL,
  `ResevForGuest` int(11) UNSIGNED NOT NULL,
  `HisNumberOfGuest` tinyint(3) NOT NULL,
  `ResevFrom` varchar(50) DEFAULT NULL,
  `HisPaymentMethod` varchar(13) NOT NULL,
  `HisStatus` varchar(10) NOT NULL,
  `HisDiscount` int(4) NOT NULL,
  `HisAmount` int(11) UNSIGNED NOT NULL,
  `HisEmployee` int(11) UNSIGNED NOT NULL,
  `HisComment` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ResevHistoryTable`
--

INSERT INTO `ResevHistoryTable` (`ResevHisID`, `ResevID`, `HisCheckInDate`, `HisCheckOutDate`, `ResevRoom`, `ResevForGuest`, `HisNumberOfGuest`, `ResevFrom`, `HisPaymentMethod`, `HisStatus`, `HisDiscount`, `HisAmount`, `HisEmployee`, `HisComment`) VALUES
(3, 1, '2001-01-01', '2002-02-02', 201, 16, 1, 'dd', 'Card', 'Check', 10, 500, 1122, 'boo'),
(4, 10, '2016-06-13', '2016-06-15', 201, 15, 1, 'Hospital', 'Credit Card', 'Check Out', 5, 2280, 1122, ''),
(5, 17, '2016-06-13', '2016-06-16', 202, 16, 2, 'HOtel', 'Cash', 'Check Out', 10, 3240, 1122, ''),
(6, 18, '2016-06-14', '2016-06-16', 203, 17, 1, '', 'Cash', 'Check Out', 5, 2280, 1122, ''),
(7, 19, '2016-06-12', '2016-06-15', 204, 22, 1, 'dback', 'Internet', 'Check Out', 0, 3600, 1122, ''),
(8, 27, '2016-06-15', '2016-06-18', 204, 21, 1, 'Oat', 'Cash', 'Check Out', 20, 2880, 1122, ''),
(9, 1000, '2016-06-26', '2016-06-28', 201, 16, 2, '', 'Credit', 'Check Out', 0, 2400, 1122, ''),
(10, 1005, '2016-06-29', '2016-07-02', 204, 21, 1, '', 'Credit', 'Check Out', 5, 3420, 1122, ''),
(11, 1007, '2016-06-16', '2016-06-19', 303, 21, 1, 'ada', 'None', 'Cancel', 0, 0, 1122, ''),
(12, 1008, '2016-06-03', '2016-06-06', 203, 21, 1, 'ad', 'None', 'Cancel', 0, 0, 1122, ''),
(13, 25, '2016-06-15', '2016-06-16', 201, 20, 1, 'tt1', 'Cash', 'Check Out', 10, 1080, 1133, ''),
(14, 20, '2016-06-14', '2016-06-17', 301, 20, 3, 'roo', 'None', 'Check Out', 0, 3600, 1122, ''),
(15, 1003, '2016-06-28', '2016-06-29', 201, 15, 1, '1', 'Credit', 'Check Out', 0, 1200, 1122, ''),
(16, 1011, '2016-07-01', '2016-07-07', 204, 23, 1, '12', 'None', 'Cancel', 0, 0, 1122, ''),
(17, 22, '2016-06-14', '2016-06-17', 202, 21, 1, 'dd', 'Cash', 'Check Out', 15, 3060, 1122, ''),
(18, 1009, '2016-06-29', '2016-07-02', 201, 20, 1, '12', 'Unknow', 'Check Out', 0, 3600, 1122, '');

-- --------------------------------------------------------

--
-- Table structure for table `RoomTable`
--

CREATE TABLE `RoomTable` (
  `RoomIDNum` smallint(5) UNSIGNED NOT NULL,
  `RoomPrice` smallint(5) UNSIGNED NOT NULL,
  `NumberOfBed` tinyint(3) UNSIGNED NOT NULL,
  `Type` varchar(1) NOT NULL,
  `RoomStatus` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RoomTable`
--

INSERT INTO `RoomTable` (`RoomIDNum`, `RoomPrice`, `NumberOfBed`, `Type`, `RoomStatus`) VALUES
(201, 1200, 2, 'L', 'Good'),
(202, 1200, 2, 'M', 'Good'),
(203, 1200, 1, 'R', 'Good'),
(204, 1200, 1, 'C', 'Good'),
(301, 1200, 2, 'L', 'Good'),
(302, 1200, 1, 'M', 'Good'),
(303, 1200, 1, 'R', 'Good'),
(304, 1500, 1, 'C', 'Fix');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `EmployeeTable`
--
ALTER TABLE `EmployeeTable`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `GuestTable`
--
ALTER TABLE `GuestTable`
  ADD PRIMARY KEY (`GuestIDNum`);

--
-- Indexes for table `ReservationTable`
--
ALTER TABLE `ReservationTable`
  ADD PRIMARY KEY (`ReservationID`),
  ADD KEY `ReservedForGuest` (`ReservedForGuest`),
  ADD KEY `ReservedRoom` (`ReservedRoom`),
  ADD KEY `HandlerEmployee` (`HandlerEmployee`);

--
-- Indexes for table `ResevHistoryTable`
--
ALTER TABLE `ResevHistoryTable`
  ADD PRIMARY KEY (`ResevHisID`),
  ADD KEY `HisEmployee` (`HisEmployee`),
  ADD KEY `ResevForGuest` (`ResevForGuest`),
  ADD KEY `ResevRoom` (`ResevRoom`);

--
-- Indexes for table `RoomTable`
--
ALTER TABLE `RoomTable`
  ADD PRIMARY KEY (`RoomIDNum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `GuestTable`
--
ALTER TABLE `GuestTable`
  MODIFY `GuestIDNum` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `ReservationTable`
--
ALTER TABLE `ReservationTable`
  MODIFY `ReservationID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1054;
--
-- AUTO_INCREMENT for table `ResevHistoryTable`
--
ALTER TABLE `ResevHistoryTable`
  MODIFY `ResevHisID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `RoomTable`
--
ALTER TABLE `RoomTable`
  MODIFY `RoomIDNum` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ReservationTable`
--
ALTER TABLE `ReservationTable`
  ADD CONSTRAINT `ReservationTable_ibfk_1` FOREIGN KEY (`ReservedRoom`) REFERENCES `RoomTable` (`RoomIDNum`),
  ADD CONSTRAINT `ReservationTable_ibfk_2` FOREIGN KEY (`ReservedForGuest`) REFERENCES `GuestTable` (`GuestIDNum`),
  ADD CONSTRAINT `ReservationTable_ibfk_3` FOREIGN KEY (`HandlerEmployee`) REFERENCES `EmployeeTable` (`EmployeeID`);

--
-- Constraints for table `ResevHistoryTable`
--
ALTER TABLE `ResevHistoryTable`
  ADD CONSTRAINT `ResevHistoryTable_ibfk_1` FOREIGN KEY (`ResevRoom`) REFERENCES `RoomTable` (`RoomIDNum`),
  ADD CONSTRAINT `ResevHistoryTable_ibfk_2` FOREIGN KEY (`ResevForGuest`) REFERENCES `GuestTable` (`GuestIDNum`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
