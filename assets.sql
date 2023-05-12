-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2021 at 09:38 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assets`
--


-- --------------------------------------------------------


CREATE TABLE `assets` (
 `id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `asset_code` VARCHAR(20) NOT NULL,
 `assetitem_id` int(30) NULL,
 `asset_name` VARCHAR(50) NOT NULL,
 `unit_of_measure` VARCHAR(10) NOT NULL,
 `category_id` int(30) NOT NULL,
 `department_id` int(30) NOT NULL,
 `location_id` int(30) NULL,
 `fund_cluster_id` int(30) NOT NULL, 
 `purchase_amount` double NULL,
 `purchase_date` date NULL,
 `invoice_number` varchar(50) NULL,
 `supplier` varchar(50) NULL,
 `userlife` int(30) NULL,
 `depreciation_rate` double NULL,
 `depstartdate` date NULL,
 `netbookvalue` double NULL,
 `totaldepreciation` double NULL,
 `status` varchar(20) NULL,
 `assetassignee` int(30) NULL,
 `specifications` varchar(200)	NULL,
 `manufacturer` varchar(20) NULL,
 `model` varchar(20) NULL,
 `serial_number` varchar(50) NULL,
 `mr_number` varchar(20) NULL,
 `mr_date` date NULL,
 `prevmr_number` varchar(20) NULL,
 `condition` varchar(25)
)
 

CREATE TABLE `assetassignment` (
   `id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `assignnumber` varchar(30) NOT NULL,
   `assigndate` date NOT NULL,
   `prevassignnumber` varchar(30) NULL,
   `employee_id` int(30) NOT NULL,
   `assetcode` varchar(20) NOT NULL,
   `assetid` int NULL,
   `assign_status` varchar(20),
   `assign_mode` varchar(25)) 	


CREATE TABLE `assettransfers` (
   `id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `ptrnumber` varchar(30) NOT NULL,
   `ptrdate` date NOT NULL,
   `prevparnumber` varchar(30) NULL,
   `prevemployee_id` int(30)  NULL,
   `employee_id` int(30) NOT NULL,
   `assetcode` varchar(20) NOT NULL,
   `assetid` int NULL,
   `ptr_status` varchar(20)) 


CREATE TABLE `inventory` (
   `id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `inv_date` date NOT NULL,
   `cut_off_date` date NOT NULL,
   `start_date` date NOT NULL,
   `completion_date` date NOT NULL,
   `description` varchar(50) NOT NULL,
   `employee_id` int(30) NOT NULL,
   `rpt_status` varchar(20) NOT NULL)

CREATE TABLE `inventorydetails` (
   `id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `inv_id` int(30),
   `asset_code` varchar(20) NOT NULL,
   `asset_status` varchar(20) NOT NULL,
   `remarks` varchar(50))
 


CREATE TABLE `tempassignment` (
   `id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `mrnumber` varchar(30) NOT NULL,
   `mrdate` date NOT NULL,
   `employee_id` int(30) NOT NULL,
   `assetcode` varchar(20) NOT NULL,
   `assetid` int NULL) 	


--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`name`) VALUES
('IT Department'),
('HR Department'),
('Accounting and Finance Department');

CREATE TABLE `location` (
`id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `category` (
`id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `category` (`name`) VALUES
('Computer Equipments'),
('Furnitures and Fixtures')

CREATE TABLE `fund_cluster` (
`id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `status` (
`id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `status` (`name`) VALUES
('Assigned'),
('Unassigned');

CREATE TABLE `condition` (
`id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` text NOT NULL
) ENGINE=InnoDB 

INSERT INTO `condition` (`name`) VALUES
('Serviceable'),
('Unserviceable'),
('Disposed'),
('For Repair'),
('Obsolete'),
('No longer needed'),
('Not used since purchase'),
('Missing');

CREATE TABLE `assetitem` (
`id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` text NOT NULL,
`pnsuffix` text(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `employee_no` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(20) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `department_id` int(30) NOT NULL,
  `position_id` int(30) NOT NULL,
  `role_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` ( `employee_no`, `firstname`, `middlename`, `lastname`, `department_id`, `position_id`, `salary`) VALUES
( '2020-9838', 'Angel Jude', 'Reyes', 'Suarez', 1, 1,1);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `department_id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` ( `department_id`, `name`) VALUES
(1, 'Programmer'),
(2, 'HR Supervisor'),
(3, 'Accounting Clerk');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `contact` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` varchar(20) NULL,
  `wl_attempts` int NULL DEFAULT 0,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=admin , 2 = staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `roles` (
  `role_id` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL
) 

CREATE TABLE `rolepermissions` (
  `id` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
  `role_id` bigint(20) NOT NULL ,
  `permission_id` bigint(20) NOT NULL
) 



CREATE TABLE activitylogs (
    id int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    access_date date NOT NULL,
    mac varchar(20) NULL,
    module varchar(30) NOT NULL,
    login_id int(30) NOT NULL,
    action varchar(50) NOT NULL,
    msg varchar(50) NULL)

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'system_name', 'Asset Management System'),
(2, 'system_short_name', 'AMS'),
(3,'company_name','DBP Data Center, Inc.'),
(4,'company_short_name','DCI'),
(5, 'logo', 'uploads/logo-1641955218.png'),
(6, 'user_avatar', 'uploads/user_avatar.jpg'),
(7, 'cover', 'uploads/cover-1641954928.png');