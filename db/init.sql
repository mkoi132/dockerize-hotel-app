CREATE USER 'master-user'@'%' IDENTIFIED BY "docker-compose1";
GRANT ALL PRIVILEGES ON *.* TO 'master-user'@'%';
FLUSH PRIVILEGES;

USE hotel;
CREATE TABLE IF NOT EXISTS facilities (
    facilityid INT AUTO_INCREMENT PRIMARY KEY,
    facilityname VARCHAR(30) DEFAULT NULL,
    description TEXT,
    caption VARCHAR(100) DEFAULT NULL,
    price DOUBLE,
    configuration VARCHAR(30) DEFAULT NULL,
    capacity INT DEFAULT NULL,
    image TEXT,
    username TEXT);
CREATE TABLE IF NOT EXISTS users (
    userid int(16) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(16) DEFAULT NULL,
    password varchar(50) DEFAULT NULL,
    reg_date datetime DEFAULT current_timestamp());