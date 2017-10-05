-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2017 at 12:16 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--
CREATE DATABASE IF NOT EXISTS `users` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `users`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `session_create`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `session_create` (IN `sess` VARCHAR(255), IN `theuser` INT)  MODIFIES SQL DATA
INSERT INTO sessions(sessionvalue,
                     LoginTime,
                     userid, 
                     status)
	VALUES (sess,
            CURRENT_TIMESTAMP,
           theuser,
           1)$$

DROP PROCEDURE IF EXISTS `session_inactive`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `session_inactive` (IN `sess` VARCHAR(255))  MODIFIES SQL DATA
UPDATE sessions 
	SET status= 0
WHERE sessions.sessionvalue = sess$$

DROP PROCEDURE IF EXISTS `session_load_value`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `session_load_value` (IN `sess` VARCHAR(255))  READS SQL DATA
SELECT  userid,sessionid,sessionvalue, LoginTime, status
FROM sessions
WHERE sessionvalue = sess and status = 1$$

DROP PROCEDURE IF EXISTS `user_insert`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_insert` (IN `Name` VARCHAR(25), IN `Province` VARCHAR(50), IN `Telephone` VARCHAR(50), IN `PostalCode` CHAR(8), IN `Salary` DECIMAL(10,0))  MODIFIES SQL DATA
INSERT INTO users(Name, 
                  Province, 
                  Telephone, 
                  PostalCode, 
                  Salary)
VALUES (Name,Province,Telephone,PostalCode,Salary)$$

DROP PROCEDURE IF EXISTS `user_load_info`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_load_info` (IN `Name` VARCHAR(25), IN `Province` VARCHAR(50), IN `Telephone` VARCHAR(50), IN `PostalCode` CHAR(8), IN `Salary` DECIMAL(10,0))  READS SQL DATA
SELECT Name,Province, Telephone, PostalCode,Salary
FROM `users` 
WHERE usrid = Name$$

DROP PROCEDURE IF EXISTS `user_Name_taken`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_Name_taken` (IN `Name` VARCHAR(20))  READS SQL DATA
Select Name,users.usrid 
from users
where Name = Name$$

DROP PROCEDURE IF EXISTS `user_validate_login`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_validate_login` (IN `Name` VARCHAR(25), IN `Province` VARCHAR(50), IN `Telephone` VARCHAR(50), IN `PostalCode` CHAR(8), IN `Salary` DECIMAL(10,0))  READS SQL DATA
SELECT usrid, users.first,users.last
FROM users
WHERE email = mail and pswd = pswd and status = 1$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `sessionid` int(11) NOT NULL,
  `sessionvalue` varchar(256) NOT NULL,
  `LoginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `Name` varchar(25) NOT NULL,
  `Province` varchar(50) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Country` varchar(40) NOT NULL,
  `Telephone` varchar(50) NOT NULL,
  `PostalCode` char(8) NOT NULL,
  `Salary` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Name`, `Province`, `City`, `Country`, `Telephone`, `PostalCode`, `Salary`) VALUES
('', '', '', '', '', '', '0'),
('Ben Fartzman', 'Nova Scotia', '', 'Canada', '647- 285-9867', 'M4T 6P9', '40'),
('John Doe', 'Nova Scotia', '', 'Canada', '(416) 123-4567', 'M5G 2G8', '40'),
('Paul McKenitek', 'Ontario', 'Toronto', 'Canada', '416-678-9098', 'M2N 4P0', '100');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`sessionid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
