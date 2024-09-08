---------------------------------------
--OPTIONAL TO RUN ON LOCAL HOSTED SERVERS
-- Create the hotel database
CREATE DATABASE HOTEL;

-- Use the hotel database
USE HOTEL;

-------------------------------------------------------------------------------

-- Create the facilities table
CREATE TABLE `FACILITIES`
(
  `FACILITYID` INT AUTO_INCREMENT PRIMARY KEY,
  `FACILITYNAME` VARCHAR
(30) DEFAULT NULL,
  `DESCRIPTION` TEXT,
  `CAPTION` VARCHAR
(100) DEFAULT NULL,
  `PRICE` DOUBLE,
  `CONFIGURATION` VARCHAR
(30) DEFAULT NULL,
  `CAPACITY` INT DEFAULT NULL,
  `IMAGE` TEXT
  `USERNAME` TEXT
)ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

--create the users table
CREATE TABLE `users`
(
  `userid` int
(16) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar
(16) DEFAULT NULL,
  `password` varchar
(50) DEFAULT NULL,
  `reg_date` datetime DEFAULT current_timestamp
()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;