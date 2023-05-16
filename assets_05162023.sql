-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2023 at 01:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

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

--
-- Table structure for table `activitylogs`
--

CREATE TABLE `activitylogs` (
  `id` int(30) NOT NULL,
  `access_date` date NOT NULL,
  `mac` varchar(20) DEFAULT NULL,
  `module` varchar(30) NOT NULL,
  `login_id` int(30) NOT NULL,
  `action` varchar(50) NOT NULL,
  `msg` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activitylogs`
--

INSERT INTO `activitylogs` (`id`, `access_date`, `mac`, `module`, `login_id`, `action`, `msg`) VALUES
(2, '2022-09-07', NULL, '', 3, '', NULL),
(3, '2022-09-07', NULL, '', 3, '', NULL),
(4, '2022-09-07', NULL, '', 3, '', 'test'),
(5, '2022-09-07', '::1', '', 3, '', 'test'),
(6, '2022-09-07', '::1', 'Login Module', 3, 'Login to system', 'test'),
(7, '2022-09-07', '::1', 'Login Module', 3, '', 'test'),
(8, '2022-09-07', '::1', 'Login Module', 3, '', 'test'),
(9, '2022-09-07', '::1', 'Login Module', 3, '', 'test'),
(10, '2022-09-07', '::1', 'Login Module', 3, '', 'test'),
(11, '2022-09-07', '::1', 'Login Module', 3, 'Successful Login', 'test'),
(12, '2022-09-07', '::1', 'Login Module', 3, 'Unsuccessful Login', 'test'),
(13, '2022-09-07', '::1', 'Login Module', 3, 'Unsuccessful Login', 'test'),
(14, '2022-09-07', '::1', 'Login Module', 3, 'Successful Login', 'test'),
(15, '2022-09-07', '::1', 'Login Module', 3, 'Successful Login', 'test'),
(16, '2022-09-07', '::1', '', 3, 'Saved Asset', 'test'),
(17, '2022-09-07', '::1', 'Manage Assets', 3, 'Saved Asset', 'test'),
(18, '2022-09-07', '::1', 'Manage Employee Module', 3, 'Saved Employee', 'test'),
(19, '2022-09-07', '::1', 'Manage Department Module', 3, 'Saved Department', 'test'),
(20, '2022-09-07', '::1', '', 3, 'Deleted Asset', 'test'),
(21, '2022-09-07', '::1', '', 3, 'Deleted Asset', 'test'),
(22, '2022-09-08', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(23, '2022-09-09', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(24, '2022-09-10', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(25, '2022-09-10', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(26, '2022-09-12', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(27, '2022-09-12', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(28, '2022-09-12', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(29, '2022-09-12', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(30, '2022-09-15', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(31, '2022-09-15', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(32, '2022-09-15', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(33, '2022-09-15', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(34, '2022-09-15', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(35, '2022-09-15', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(36, '2022-09-15', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(37, '2022-09-15', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(38, '2022-09-15', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(39, '2022-09-16', '::1', 'Manage Assets', 4, 'Saved Asset', 'test'),
(40, '2022-09-16', '::1', 'Manage Assets', 4, 'Saved Asset', 'test'),
(41, '2022-09-16', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(42, '2022-09-17', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(43, '2022-09-17', '::1', 'Manage Assets', 4, 'Saved Asset', 'test'),
(44, '2022-09-17', '::1', 'Manage Assets', 4, 'Saved Asset', 'test'),
(45, '2022-09-18', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(46, '2022-09-18', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(47, '2022-09-18', '::1', 'Manage Department Module', 4, 'Saved Department', 'test'),
(48, '2022-09-18', '::1', 'Manage Department Module', 4, 'Saved Department', 'test'),
(49, '2022-09-18', '::1', 'Manage Department Module', 4, 'Saved Department', 'test'),
(50, '2022-09-18', '::1', 'Manage Department Module', 4, 'Saved Department', 'test'),
(51, '2022-09-18', '::1', 'Manage Department Module', 4, 'Saved Department', 'test'),
(52, '2022-09-18', '::1', 'Manage Department Module', 4, 'Saved Department', 'test'),
(53, '2022-09-18', '::1', 'Manage Department Module', 4, 'Saved Department', 'test'),
(54, '2022-09-18', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(55, '2022-09-18', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(56, '2022-09-19', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(57, '2022-09-19', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(58, '2022-09-19', '::1', 'Manage Employee Module', 4, 'Saved Employee', 'test'),
(59, '2022-09-19', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(60, '2022-09-19', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(61, '2022-09-19', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(62, '2022-09-19', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(63, '2022-09-20', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(64, '2022-09-20', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(65, '2022-09-20', '::1', 'Login Module', 4, 'Successful Login', 'test'),
(66, '2022-09-20', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(67, '2022-09-20', '::1', 'Manage Employee Module', 6, 'Saved Employee', 'test'),
(68, '2022-09-20', '::1', 'Manage Department Module', 6, 'Saved Department', 'test'),
(69, '2022-09-20', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(70, '2022-09-20', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(71, '2022-09-20', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(72, '2022-09-20', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(73, '2022-09-20', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(74, '2022-09-20', '::1', '', 6, 'Deleted Asset', 'test'),
(75, '2022-09-20', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(76, '2022-09-20', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(77, '2022-09-20', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(78, '2022-09-21', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(79, '2022-09-21', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(80, '2022-09-21', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(81, '2022-09-21', '::1', '', 6, 'Deleted Asset', 'test'),
(82, '2022-09-22', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(83, '2022-09-22', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(84, '2022-09-22', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(85, '2022-09-22', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(86, '2022-09-23', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(87, '2022-09-23', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(88, '2022-09-28', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(89, '2022-09-30', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(90, '2022-09-30', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(91, '2022-10-03', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(92, '2022-10-05', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(93, '2022-10-05', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(94, '2022-10-06', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(95, '2022-10-06', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(96, '2022-10-06', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(97, '2022-10-06', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(98, '2022-10-06', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(99, '2022-10-06', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(100, '2022-10-06', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(101, '2022-10-06', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(102, '2022-10-06', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(103, '2022-10-07', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(104, '2022-10-15', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(105, '2022-10-15', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(106, '2022-10-15', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(107, '2022-10-15', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(108, '2022-10-17', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(109, '2022-10-22', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(110, '2022-11-02', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(111, '2022-11-08', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(112, '2022-11-08', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(113, '2022-11-14', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(114, '2022-11-14', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(115, '2022-11-21', '::1', 'Login Module', 1, 'Unsuccessful Login', 'test'),
(116, '2022-11-21', '::1', 'Login Module', 1, 'Unsuccessful Login', 'test'),
(117, '2022-11-21', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(118, '2022-11-21', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(119, '2022-11-21', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(120, '2022-11-21', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(121, '2022-11-23', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(122, '2022-11-23', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(123, '2022-11-23', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(124, '2022-11-23', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(125, '2022-11-23', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(126, '2022-11-23', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(127, '2022-11-23', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(128, '2022-11-23', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(129, '2022-11-23', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(130, '2022-11-23', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(131, '2022-11-25', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(132, '2022-11-25', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(133, '2022-11-25', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(134, '2022-11-25', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(135, '2022-11-25', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(136, '2022-12-03', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(137, '2022-12-04', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(138, '2022-12-10', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(139, '2022-12-10', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(140, '2022-12-10', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(141, '2023-02-01', '::1', 'Login Module', 6, 'Unsuccessful Login', 'test'),
(142, '2023-02-01', '::1', 'Login Module', 6, 'Unsuccessful Login', 'test'),
(143, '2023-02-01', '::1', 'Login Module', 6, 'Unsuccessful Login', 'test'),
(144, '2023-02-01', '::1', 'Login Module', 1, 'Unsuccessful Login', 'test'),
(145, '2023-02-01', '::1', 'Login Module', 1, 'Unsuccessful Login', 'test'),
(146, '2023-02-01', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(147, '2023-02-02', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(148, '2023-02-02', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(149, '2023-02-02', '::1', '', 6, 'Deleted Asset', 'test'),
(150, '2023-02-02', '::1', '', 6, 'Deleted Asset', 'test'),
(151, '2023-02-02', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(152, '2023-02-02', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(153, '2023-02-02', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(154, '2023-02-02', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(155, '2023-02-02', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(156, '2023-02-02', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(157, '2023-02-02', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(158, '2023-02-02', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(159, '2023-02-07', '::1', 'Login Module', 6, 'Unsuccessful Login', 'test'),
(160, '2023-02-07', '::1', 'Login Module', 6, 'Unsuccessful Login', 'test'),
(161, '2023-02-07', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(162, '2023-02-07', '::1', 'Login Module', 1, 'Unsuccessful Login', 'test'),
(163, '2023-02-07', '::1', 'Login Module', 6, 'Unsuccessful Login', 'test'),
(164, '2023-02-07', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(165, '2023-02-07', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(166, '2023-02-07', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(167, '2023-02-13', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(168, '2023-02-13', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(169, '2023-02-13', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(170, '2023-02-13', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(171, '2023-02-13', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(172, '2023-02-13', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(173, '2023-02-15', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(174, '2023-02-15', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(175, '2023-02-15', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(176, '2023-02-15', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(177, '2023-02-23', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(178, '2023-02-23', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(179, '2023-02-23', '::1', 'Manage Office Module', 6, 'Saved Office', 'test'),
(180, '2023-02-23', '::1', 'Manage Office Module', 6, 'Saved Office', 'test'),
(181, '2023-02-23', '::1', 'Manage Office Module', 6, 'Saved Office', 'test'),
(182, '2023-02-23', '::1', 'Manage Office Module', 6, 'Saved Office', 'test'),
(183, '2023-02-23', '::1', 'Manage Office Module', 6, 'Saved Office', 'test'),
(184, '2023-02-23', '::1', 'Manage Office Module', 6, 'Saved Office', 'test'),
(185, '2023-02-23', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(186, '2023-02-25', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(187, '2023-02-26', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(188, '2023-02-26', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(189, '2023-03-03', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(190, '2023-03-04', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(191, '2023-03-04', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(192, '2023-03-05', '::1', 'Login Module', 1, 'Unsuccessful Login', 'test'),
(193, '2023-03-05', '::1', 'Login Module', 1, 'Unsuccessful Login', 'test'),
(194, '2023-03-05', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(195, '2023-03-05', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(196, '2023-03-06', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(197, '2023-03-08', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(198, '2023-03-08', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(199, '2023-03-09', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(200, '2023-03-09', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(201, '2023-03-09', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(202, '2023-03-10', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(203, '2023-03-10', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(204, '2023-03-13', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(205, '2023-03-13', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(206, '2023-03-13', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(207, '2023-03-13', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(208, '2023-03-14', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(209, '2023-03-15', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(210, '2023-03-16', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(211, '2023-03-16', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(212, '2023-03-20', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(213, '2023-03-21', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(214, '2023-03-24', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(215, '2023-03-24', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(216, '2023-03-24', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(217, '2023-03-24', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(218, '2023-03-27', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(219, '2023-03-27', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(220, '2023-03-27', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(221, '2023-03-29', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(222, '2023-03-30', '::1', 'Login Module', 6, 'Successful Login', 'test'),
(223, '2023-03-30', '::1', 'Login Module', 7, 'Successful Login', 'test'),
(224, '2023-03-30', '::1', 'Login Module', 7, 'Successful Login', 'test'),
(225, '2023-03-30', '::1', 'Login Module', 7, 'Unsuccessful Login', 'test'),
(226, '2023-03-30', '::1', 'Manage Assets', 7, 'Saved Asset', 'test'),
(227, '2023-03-30', '::1', 'Manage Assets', 7, 'Saved Asset', 'test'),
(228, '2023-03-30', '::1', 'Login module', 6, 'Successful Login', 'test'),
(229, '2023-03-30', '::1', 'Login module', 6, 'Successful Login', 'test'),
(230, '2023-03-31', '::1', 'Login module', 6, 'Successful Login', 'test'),
(231, '2023-04-04', '::1', 'Login module', 6, 'Successful Login', 'test'),
(232, '2023-04-04', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(233, '2023-04-04', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(234, '2023-04-04', '::1', 'Login module', 6, 'Successful Login', 'test'),
(235, '2023-04-05', '::1', 'Login module', 6, 'Successful Login', 'test'),
(236, '2023-04-05', '::1', 'Login module', 8, 'Unsuccessful Login', 'test'),
(237, '2023-04-05', '::1', 'Login module', 8, 'Successful Login', 'test'),
(238, '2023-04-05', '::1', 'Login module', 8, 'Successful Login', 'test'),
(239, '2023-04-05', '::1', 'Login module', 6, 'Successful Login', 'test'),
(240, '2023-04-05', '::1', 'Login module', 6, 'Successful Login', 'test'),
(241, '2023-04-05', '::1', 'Login module', 8, 'Successful Login', 'test'),
(242, '2023-04-05', '::1', 'Login module', 6, 'Successful Login', 'test'),
(243, '2023-04-05', '::1', 'Login module', 8, 'Successful Login', 'test'),
(244, '2023-04-05', '::1', 'Login module', 6, 'Successful Login', 'test'),
(245, '2023-04-05', '::1', 'Login module', 8, 'Successful Login', 'test'),
(246, '2023-04-05', '::1', 'Login module', 6, 'Successful Login', 'test'),
(247, '2023-04-05', '::1', 'Login module', 8, 'Successful Login', 'test'),
(248, '2023-04-05', '::1', 'Login module', 6, 'Successful Login', 'test'),
(249, '2023-04-05', '::1', 'Login module', 8, 'Successful Login', 'test'),
(250, '2023-04-05', '::1', 'Login module', 6, 'Successful Login', 'test'),
(251, '2023-04-05', '::1', 'Login module', 8, 'Successful Login', 'test'),
(252, '2023-04-05', '::1', 'Login module', 8, 'Successful Login', 'test'),
(253, '2023-04-05', '::1', 'Login module', 6, 'Successful Login', 'test'),
(254, '2023-04-05', '::1', 'Login module', 8, 'Successful Login', 'test'),
(255, '2023-04-06', '::1', 'Login module', 6, 'Successful Login', 'test'),
(256, '2023-04-06', '::1', 'Login module', 8, 'Successful Login', 'test'),
(257, '2023-04-06', '127.0.0.1', 'Login module', 6, 'Successful Login', 'test'),
(258, '2023-04-06', '::1', 'Login module', 6, 'Successful Login', 'test'),
(259, '2023-04-06', '::1', 'Login module', 8, 'Successful Login', 'test'),
(260, '2023-04-14', '::1', 'Login module', 6, 'Successful Login', 'test'),
(261, '2023-04-14', '::1', 'Login module', 6, 'Unsuccessful Login', 'test'),
(262, '2023-04-14', '::1', 'Login module', 6, 'Unsuccessful Login', 'test'),
(263, '2023-04-14', '::1', 'Login module', 6, 'Unsuccessful Login', 'test'),
(264, '2023-04-14', '::1', 'Login module', 1, 'Unsuccessful Login', 'test'),
(265, '2023-04-14', '::1', 'Login module', 6, 'Unsuccessful Login', 'test'),
(266, '2023-04-14', '::1', 'Login module', 6, 'Unsuccessful Login', 'test'),
(267, '2023-04-14', '::1', 'Login module', 8, 'Unsuccessful Login', 'test'),
(268, '2023-04-14', '::1', 'Login module', 6, 'Unsuccessful Login', 'test'),
(269, '2023-04-14', '::1', 'Login module', 6, 'Unsuccessful Login', 'test'),
(270, '2023-04-14', '::1', 'Login module', 8, 'Unsuccessful Login', 'test'),
(271, '2023-04-14', '::1', 'Login module', 6, 'Unsuccessful Login', 'test'),
(272, '2023-04-14', '::1', 'Login module', 6, 'Unsuccessful Login', 'test'),
(273, '2023-04-14', '::1', 'Login module', 7, 'Unsuccessful Login', 'test'),
(274, '2023-04-14', '::1', 'Login module', 6, 'Unsuccessful Login', 'test'),
(275, '2023-04-14', '::1', 'Login module', 6, 'Unsuccessful Login', 'test'),
(276, '2023-04-14', '::1', 'Login module', 6, 'Unsuccessful Login', 'test'),
(277, '2023-04-14', '::1', 'Login module', 8, 'Unsuccessful Login', 'test'),
(278, '2023-04-14', '::1', 'Login module', 8, 'Unsuccessful Login', 'test'),
(279, '2023-04-14', '::1', 'Login module', 6, 'Successful Login', 'test'),
(280, '2023-04-14', '::1', 'Login module', 6, 'Successful Login', 'test'),
(281, '2023-04-14', '::1', 'Login module', 6, 'Successful Login', 'test'),
(282, '2023-04-14', '::1', 'Login module', 8, 'Successful Login', 'test'),
(283, '2023-04-14', '::1', 'Login module', 6, 'Successful Login', 'test'),
(284, '2023-04-17', '::1', 'Login module', 6, 'Successful Login', 'test'),
(285, '2023-04-18', '::1', 'Login module', 6, 'Successful Login', 'test'),
(286, '2023-04-18', '::1', 'Login module', 6, 'Successful Login', 'test'),
(287, '2023-04-19', '::1', 'Login module', 6, 'Successful Login', 'test'),
(288, '2023-04-19', '::1', 'Login module', 8, 'Successful Login', 'test'),
(289, '2023-04-19', '::1', 'Login module', 6, 'Successful Login', 'test'),
(290, '2023-04-19', '::1', 'Login module', 8, 'Successful Login', 'test'),
(291, '2023-04-19', '::1', 'Login module', 8, 'Successful Login', 'test'),
(292, '2023-04-19', '::1', 'Login module', 6, 'Successful Login', 'test'),
(293, '2023-04-20', '::1', 'Login module', 6, 'Successful Login', 'test'),
(294, '2023-04-21', '::1', 'Login module', 38, 'Successful Login', 'test'),
(295, '2023-04-21', '::1', 'Login module', 38, 'Successful Login', 'test'),
(296, '2023-04-21', '::1', 'Login module', 38, 'Successful Login', 'test'),
(297, '2023-04-21', '::1', 'Login module', 38, 'Successful Login', 'test'),
(298, '2023-04-21', '::1', 'Login module', 6, 'Successful Login', 'test'),
(299, '2023-04-21', '::1', 'Manage Assets', 6, 'Updated Asset', 'test'),
(300, '2023-04-21', '::1', 'Manage Assets', 6, 'Saved Asset', 'test'),
(301, '2023-04-24', '::1', 'Login module', 38, 'Successful Login', 'test'),
(302, '2023-04-24', '::1', 'Login module', 6, 'Successful Login', 'test'),
(303, '2023-04-24', '::1', 'Login module', 6, 'Successful Login', 'test'),
(304, '2023-04-24', '::1', 'Login module', 6, 'Successful Login', 'test'),
(305, '2023-04-24', '::1', 'Login module', 8, 'Successful Login', 'test'),
(306, '2023-04-24', '::1', 'Login module', 6, 'Successful Login', 'test'),
(307, '2023-04-24', '::1', 'Login module', 6, 'Successful Login', 'test'),
(308, '2023-04-25', '::1', 'Login module', 6, 'Successful Login', 'test'),
(309, '2023-04-25', '::1', 'Login module', 6, 'Successful Login', 'test'),
(310, '2023-04-25', '::1', 'Login module', 6, 'Successful Login', 'test'),
(311, '2023-04-25', '::1', 'Manage Department Module', 6, 'Saved Department', 'test'),
(312, '2023-04-25', '::1', 'Manage Department Module', 6, 'Saved Department', 'test'),
(313, '2023-04-25', '::1', 'Manage Employee Module', 6, 'Saved Employee', 'test'),
(314, '2023-04-25', '::1', 'Manage Employee Module', 6, 'Saved Employee', 'test'),
(315, '2023-04-26', '::1', 'Login module', 6, 'Successful Login', 'test'),
(316, '2023-04-26', '::1', '', 6, 'Update Location', 'test'),
(317, '2023-04-26', '::1', '', 6, 'Save New User', 'test'),
(318, '2023-04-26', '::1', '', 6, 'Save New User', 'test'),
(319, '2023-04-26', '::1', '', 6, 'Save New User', 'test'),
(320, '2023-04-26', '::1', '', 6, 'Save New User', 'test'),
(321, '2023-04-26', '::1', '', 6, 'Save New User', 'test'),
(322, '2023-04-26', '::1', '', 6, 'Save New User', 'test'),
(323, '2023-04-26', '::1', 'Manage Notifications Module', 6, 'Saved Notification', 'test'),
(324, '2023-04-26', '::1', 'Manage Notifications Module', 6, 'Saved Notification', 'test'),
(325, '2023-04-26', '::1', '', 6, 'Save New User', 'test'),
(326, '2023-04-26', '::1', '', 6, 'Save New User', 'test'),
(327, '2023-04-26', '::1', '', 6, 'Save New User', 'test'),
(328, '2023-05-16', '::1', 'Login module', 6, 'Successful Login', 'test'),
(341, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(342, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(343, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(344, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(345, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(346, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(347, '2023-05-16', '::1', 'supplier Module', 6, 'Update Supplier', 'test'),
(348, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(349, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(350, '2023-05-16', '::1', '', 6, 'Deleted Supplier', 'test'),
(351, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(352, '2023-05-16', '::1', '', 6, 'Saved Supplier', 'test'),
(353, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(354, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(355, '2023-05-16', '::1', 'Manage Supplier', 6, 'Deleted Supplier', 'test'),
(356, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(357, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(358, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(359, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(360, '2023-05-16', '::1', 'Manage Supplier', 6, 'Deleted Supplier', 'test'),
(361, '2023-05-16', '::1', 'supplier Module', 6, 'Deleted Supplier', 'test'),
(362, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(363, '2023-05-16', '::1', 'Manage Supplier', 6, 'Deleted Supplier', 'test'),
(364, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(365, '2023-05-16', '::1', 'supplier Module', 6, 'Update Supplier', 'test'),
(366, '2023-05-16', '::1', 'Manage Supplier', 6, 'Deleted Supplier', 'test'),
(367, '2023-05-16', '::1', 'supplier Module', 6, 'Deleted Supplier', 'test'),
(368, '2023-05-16', '::1', 'supplier Module', 6, 'Deleted Supplier', 'test'),
(369, '2023-05-16', '::1', 'supplier Module', 6, 'Deleted Supplier', 'test'),
(370, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(371, '2023-05-16', '::1', 'supplier Module', 6, 'Update Supplier', 'test'),
(372, '2023-05-16', '::1', 'supplier Module', 6, 'Update Supplier', 'test'),
(373, '2023-05-16', '::1', 'supplier Module', 6, 'Update Supplier', 'test'),
(374, '2023-05-16', '::1', 'Manage Supplier', 6, 'Deleted Supplier', 'test'),
(375, '2023-05-16', '::1', 'supplier Module', 6, 'Saved Supplier', 'test'),
(376, '2023-05-16', '::1', 'supplier Module', 6, 'Update Supplier', 'test'),
(377, '2023-05-16', '::1', 'supplier Module', 6, 'Update Supplier', 'test'),
(378, '2023-05-16', '::1', 'Login module', 6, 'Successful Login', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `assetassignment`
--

CREATE TABLE `assetassignment` (
  `id` int(30) NOT NULL,
  `assignnumber` varchar(30) NOT NULL,
  `assigndate` date NOT NULL,
  `prevassignnumber` varchar(30) DEFAULT NULL,
  `employee_id` int(30) NOT NULL,
  `assetcode` varchar(20) NOT NULL,
  `assetid` int(11) DEFAULT NULL,
  `assign_status` varchar(20) DEFAULT NULL,
  `assign_mode` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assetassignment`
--

INSERT INTO `assetassignment` (`id`, `assignnumber`, `assigndate`, `prevassignnumber`, `employee_id`, `assetcode`, `assetid`, `assign_status`, `assign_mode`) VALUES
(1, 'PAR202211001 ', '2022-11-04', NULL, 4, '2200001', NULL, 'Inactive', 'Purchase'),
(2, 'PAR202211002', '2022-11-04', NULL, 3, '2200002', NULL, 'Inactive', 'Purchase'),
(3, 'PAR202211002', '2022-11-04', NULL, 3, '2200003', NULL, 'Inactive', 'Purchase'),
(4, 'PAR202211003 ', '2022-11-11', NULL, 5, '2200004', NULL, 'Inactive', 'Purchase'),
(7, 'PAR202211004 ', '2022-11-19', NULL, 1, '2200009', NULL, 'Active', 'Purchase'),
(28, 'PAR202303001 ', '2023-03-08', NULL, 5, '2300012', NULL, 'Active', 'Purchase'),
(29, 'PAR202303002 ', '2023-03-10', NULL, 4, '2300043', NULL, 'Active', 'Purchase');

-- --------------------------------------------------------

--
-- Table structure for table `assetitem`
--

CREATE TABLE `assetitem` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `pnsuffix` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assetitem`
--

INSERT INTO `assetitem` (`id`, `name`, `pnsuffix`) VALUES
(3, 'CPU', '1'),
(4, 'Monitor', '2'),
(5, 'Keyboard', '3'),
(6, 'Mouse', '4'),
(7, 'Laptop', '5'),
(8, 'Printer', '6'),
(9, '\r\nScanner', '7'),
(10, 'UPS', '8'),
(11, 'Network appliance', '9'),
(12, 'Furniture', '10'),
(13, 'AVR', '11'),
(14, 'Office Equipment', '12');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(30) NOT NULL,
  `asset_code` varchar(20) NOT NULL,
  `assetitem_id` int(30) DEFAULT NULL,
  `asset_name` varchar(50) NOT NULL,
  `category_id` int(30) NOT NULL,
  `department_id` int(30) NOT NULL,
  `location_id` int(30) DEFAULT NULL,
  `purchase_amount` double DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `supplier` varchar(50) DEFAULT NULL,
  `userlife` int(30) DEFAULT NULL,
  `depreciation_rate` double DEFAULT NULL,
  `depstartdate` date DEFAULT NULL,
  `netbookvalue` double DEFAULT NULL,
  `totaldepreciation` double DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `assetassignee` int(30) DEFAULT NULL,
  `specifications` varchar(200) DEFAULT NULL,
  `manufacturer` varchar(20) DEFAULT NULL,
  `model` varchar(20) DEFAULT NULL,
  `serial_number` varchar(50) DEFAULT NULL,
  `mr_number` varchar(20) DEFAULT NULL,
  `mr_date` date DEFAULT NULL,
  `prevmr_number` varchar(20) DEFAULT NULL,
  `unit_of_measure` varchar(10) NOT NULL,
  `fund_cluster_id` int(30) NOT NULL,
  `condition` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `asset_code`, `assetitem_id`, `asset_name`, `category_id`, `department_id`, `location_id`, `purchase_amount`, `purchase_date`, `invoice_number`, `supplier`, `userlife`, `depreciation_rate`, `depstartdate`, `netbookvalue`, `totaldepreciation`, `status`, `assetassignee`, `specifications`, `manufacturer`, `model`, `serial_number`, `mr_number`, `mr_date`, `prevmr_number`, `unit_of_measure`, `fund_cluster_id`, `condition`) VALUES
(2, '2200001', NULL, 'Desktop Computer', 1, 4, 1, 25000, '2022-08-01', '', 'Informantixd', 5, 600, '2022-08-01', 0, 24000, 'Assigned', 4, 'Intel i7', 'HP', '3453', '435345', 'PAR202211001 ', '2022-11-04', '', '', 1, 'For Repair'),
(3, '2200002', NULL, 'Desktop Computer', 1, 2, 3, 25000, '2020-07-05', '', '', 0, 0, '2021-08-01', 0, 24000, 'Assigned', 3, 'Intel i5', 'Lenovo', '79543', '313', '20221111 ', '2022-11-04', '', '', 1, 'Serviceable'),
(4, '2200003', NULL, 'Desktop Computer', 1, 2, 1, 26000, '2022-08-09', '', 'Informantix', 0, 0, '0000-00-00', 1500, 24500, 'Assigned', 3, '', 'Apple', '', '', '20221111 ', '2022-11-04', '', '', 1, 'Serviceable'),
(5, '2200004', NULL, 'Desktop Computer', 1, 1, 1, 25000, '2022-09-09', NULL, 'Informantix', 0, 0, '0000-00-00', 0, 0, 'Assigned', 5, 'Intel i7', '', '', '', 'PAR202211003 ', '2022-11-11', '', 'set', 1, 'Serviceable'),
(7, '2200006', NULL, 'Desktop Computer', 1, 4, 1, 27000, '2022-09-08', NULL, 'ValueBay', 0, 0, '0000-00-00', 0, 0, 'Assigned', 5, 'Intel i7', 'Lenovo', '1234', '4321', 'PAR202211003 ', '2022-11-11', '', 'pc', 1, 'Serviceable'),
(9, '2200008', NULL, 'Cabinet', 2, 1, 1, 28000, '0000-00-00', NULL, 'Cabinetry', 0, 0, '0000-00-00', 0, 0, 'Assigned', 5, '', '', '', '', 'PAR202211003 ', '2022-11-11', '', 'pc', 1, 'Serviceable'),
(10, '2200009', NULL, 'Desktop Computer', 1, 2, 2, 45000, '2022-09-23', '', 'ValueBay', 5, 0, '0000-00-00', 0, 0, 'Assigned', 1, 'Intel i7', 'HP', '3462546', '547xcvbx', 'PAR202211004 ', '2022-11-19', '', '', 1, 'Serviceable'),
(13, '2200011', NULL, 'Desktop Computer', 1, 5, 1, 28000, '2022-09-14', NULL, 'Informantix', 5, 0, '0000-00-00', 0, 0, 'Assigned', 1, 'Intel i5', 'Lenovo', '687768', '678678', 'PAR202211004 ', '2022-11-19', '', 'set', 1, 'Serviceable'),
(355, '2300012', NULL, 'computer', 1, 2, 1, 0, '0000-00-00', '', '', 0, 0, '0000-00-00', 0, 0, 'Assigned', 5, '', '', '', '', 'PAR202303001 ', '2023-03-08', NULL, '', 0, 'Serviceable'),
(356, '2300013', NULL, 'Desktop Computer', 1, 3, 1, 45000, '0000-00-00', '', '', 0, 0, '0000-00-00', 0, 0, 'Unassigned', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 'Serviceable'),
(357, '2300014', NULL, 'Asset Name', 0, 0, NULL, NULL, '0000-00-00', 'invoice_number', 'supplier', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'specifications', 'manufacturer', 'model', NULL, NULL, NULL, NULL, 'unit_of_me', 0, 'Serviceable'),
(358, '2300015', NULL, 'Desktop Computer', 1, 4, NULL, 25000, '0000-00-00', '15331', 'Informantix', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i7', 'HP', 'Pavilion', NULL, NULL, NULL, NULL, 'set', 1, 'Serviceable'),
(359, '2300016', NULL, 'Desktop Computer', 1, 4, NULL, 25000, '0000-00-00', '15331', 'Informantix', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i7', 'HP', 'Pavilion', NULL, NULL, NULL, NULL, 'set', 1, 'Serviceable'),
(360, '2300017', NULL, 'Desktop Computer', 1, 1, NULL, 25000, '0000-00-00', '15332', 'Informantix', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i7', 'Asus', 'S501MD', NULL, NULL, NULL, NULL, 'set', 1, 'Serviceable'),
(361, '2300018', NULL, 'Desktop Computer', 1, 1, NULL, 25000, '0000-00-00', '15332', 'Informantix', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i7', 'Asus', 'S501MD', NULL, NULL, NULL, NULL, 'set', 1, 'Serviceable'),
(362, '2300019', NULL, 'Desktop Computer', 1, 4, NULL, 40000, '0000-00-00', '15333', 'ValueBay', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i7', 'Lenovo', 'ThinkCentre', NULL, NULL, NULL, NULL, 'pc', 1, 'Serviceable'),
(363, '2300020', NULL, 'Desktop Computer', 1, 4, NULL, 40000, '0000-00-00', '15333', 'ValueBay', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i7', 'Lenovo', 'ThinkCentre', NULL, NULL, NULL, NULL, 'pc', 1, 'Serviceable'),
(364, '2300021', NULL, 'Cabinet', 2, 1, NULL, 5000, '0000-00-00', '15334', 'Cabinetry', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, '', '', '', NULL, NULL, NULL, NULL, 'pc', 1, 'Serviceable'),
(365, '2300022', NULL, 'Cabinet', 2, 1, NULL, 5000, '0000-00-00', '15334', 'Cabinetry', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, '', '', '', NULL, NULL, NULL, NULL, 'pc', 1, 'Serviceable'),
(366, '2300023', NULL, 'Cabinet', 2, 1, NULL, 5000, '0000-00-00', '15334', 'Cabinetry', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, '', '', '', NULL, NULL, NULL, NULL, 'pc', 1, 'Serviceable'),
(367, '2300024', NULL, 'Cabinet', 2, 1, NULL, 5000, '0000-00-00', '15334', 'Cabinetry', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, '', '', '', NULL, NULL, NULL, NULL, 'pc', 1, 'Serviceable'),
(368, '2300025', NULL, 'Cabinet', 2, 1, NULL, 5000, '0000-00-00', '15334', 'Cabinetry', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, '', '', '', NULL, NULL, NULL, NULL, 'pc', 1, 'Serviceable'),
(369, '2300026', NULL, 'Cabinet', 2, 1, NULL, 5000, '0000-00-00', '15334', 'Cabinetry', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, '', '', '', NULL, NULL, NULL, NULL, 'pc', 1, 'Serviceable'),
(370, '2300027', NULL, 'Desktop Computer', 1, 2, NULL, 22000, '0000-00-00', '15335', 'ValueBay', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i5', 'Acer', 'Aspire', NULL, NULL, NULL, NULL, 'set', 1, 'Serviceable'),
(371, '2300028', NULL, 'Desktop Computer', 1, 2, NULL, 22000, '0000-00-00', '15335', 'ValueBay', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i5', 'Acer', 'Aspire', NULL, NULL, NULL, NULL, 'set', 1, 'Serviceable'),
(372, '2300029', NULL, 'Desktop Computer', 1, 2, NULL, 22000, '0000-00-00', '15335', 'ValueBay', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i5', 'Acer', 'Aspire', NULL, NULL, NULL, NULL, 'set', 1, 'Serviceable'),
(373, '2300030', NULL, 'Desktop Computer', 1, 2, NULL, 22000, '0000-00-00', '15335', 'ValueBay', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i5', 'Acer', 'Aspire', NULL, NULL, NULL, NULL, 'set', 1, 'Serviceable'),
(374, '2300031', NULL, 'Desktop Computer', 1, 2, NULL, 22000, '0000-00-00', '15335', 'ValueBay', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i5', 'Acer', 'Aspire', NULL, NULL, NULL, NULL, 'set', 1, 'Serviceable'),
(375, '2300032', NULL, 'Desktop Computer', 1, 2, NULL, 22000, '0000-00-00', '15335', 'ValueBay', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i5', 'Acer', 'Aspire', NULL, NULL, NULL, NULL, 'set', 1, 'Serviceable'),
(376, '2300033', NULL, 'Desktop Computer', 1, 2, NULL, 22000, '0000-00-00', '15335', 'ValueBay', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i5', 'Acer', 'Aspire', NULL, NULL, NULL, NULL, 'set', 1, 'Serviceable'),
(377, '2300034', NULL, 'Desktop Computer', 1, 2, NULL, 22000, '0000-00-00', '15335', 'ValueBay', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i5', 'Acer', 'Aspire', NULL, NULL, NULL, NULL, 'set', 1, 'Serviceable'),
(378, '2300035', NULL, 'Desktop Computer', 1, 2, NULL, 22000, '0000-00-00', '15335', 'ValueBay', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i5', 'Acer', 'Aspire', NULL, NULL, NULL, NULL, 'set', 1, 'Serviceable'),
(379, '2300036', NULL, 'Desktop Computer', 1, 2, NULL, 22000, '0000-00-00', '15335', 'ValueBay', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i5', 'Acer', 'Aspire', NULL, NULL, NULL, NULL, 'set', 1, 'Serviceable'),
(380, '2300037', NULL, 'Desktop Computer', 1, 2, NULL, 22000, '0000-00-00', '15335', 'ValueBay', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i5', 'Acer', 'Aspire', NULL, NULL, NULL, NULL, 'set', 1, 'Serviceable'),
(381, '2300038', NULL, 'Desktop Computer', 1, 3, NULL, 26000, '0000-00-00', '15336', 'VBG', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i7', 'HP', 'Pavislion', NULL, NULL, NULL, NULL, 'pc', 1, 'Serviceable'),
(382, '2300039', NULL, 'Desktop Computer', 1, 3, NULL, 26000, '0000-00-00', '15336', 'VBG', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i7', 'HP', 'Pavislion', NULL, NULL, NULL, NULL, 'pc', 1, 'Serviceable'),
(383, '2300040', NULL, 'HP Laptop', 1, 3, NULL, 40000, '0000-00-00', '15345', 'SSI', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i7', 'Dell', 'Inspiron', NULL, NULL, NULL, NULL, 'pc', 1, 'Serviceable'),
(384, '2300041', NULL, 'HP Laptop', 1, 3, NULL, 40000, '0000-00-00', '15345', 'SSI', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'Intel i7', 'Dell', 'Inspiron', NULL, NULL, NULL, NULL, 'pc', 1, 'Serviceable'),
(385, '2300042', NULL, 'Mac Laptop', 1, 5, NULL, 90000, '0000-00-00', '16001', 'Rogers', NULL, NULL, NULL, NULL, NULL, 'Unassigned', NULL, 'M2', 'Apple', 'MacBook Air', NULL, NULL, NULL, NULL, 'pc', 1, 'Serviceable'),
(386, '2300043', NULL, 'Mac Laptop', 1, 5, NULL, 90000, '0000-00-00', '16001', 'Rogers', NULL, NULL, NULL, NULL, NULL, 'Assigned', 4, 'M2', 'Apple', 'MacBook Air', NULL, 'PAR202303002 ', '2023-03-10', NULL, 'pc', 1, 'Serviceable'),
(387, '2300044', NULL, 'Desktop Computer', 1, 3, 3, 0, '0000-00-00', '', '', 0, 0, '0000-00-00', 0, 0, 'Unassigned', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Property Plant and Equipment'),
(2, 'Semi-expendable with High Value'),
(3, 'Semi-expendable with Low Value');

-- --------------------------------------------------------

--
-- Table structure for table `condition`
--

CREATE TABLE `condition` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `condition`
--

INSERT INTO `condition` (`id`, `name`) VALUES
(1, 'Serviceable'),
(2, 'Unserviceable'),
(3, 'Disposed'),
(4, 'For Repair'),
(5, 'Obsolete'),
(6, 'No longer needed'),
(7, 'Not used since purchase'),
(8, 'Missing');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'IT Department'),
(2, 'HR Department'),
(3, 'Accounting and Finance Department'),
(4, 'Project Management Department'),
(5, 'Admin Department'),
(6, 'Legal Department'),
(12, 'Health and Wellness Department'),
(13, 'Marketing Department'),
(14, 'MSB');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(20) NOT NULL,
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

INSERT INTO `employee` (`id`, `employee_no`, `firstname`, `middlename`, `lastname`, `department_id`, `position_id`, `role_id`) VALUES
(1, '2020-9838', 'Angel Jude', 'Reyes', 'Suarez', 1, 1, 0),
(3, '2022-6313', 'Robert', 'S', 'Diente', 1, 0, 0),
(4, '2022-2513', 'Rufel', '', 'Aganan', 1, 0, 0),
(6, '2023-5082', 'Scottie', '', 'Thompson', 1, 0, 0),
(7, '2023-2465', 'Japeth', '', 'Aguilar', 12, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fund_cluster`
--

CREATE TABLE `fund_cluster` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fund_cluster`
--

INSERT INTO `fund_cluster` (`id`, `name`) VALUES
(1, 'Internally Generated Fund');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(30) NOT NULL,
  `inv_date` date DEFAULT NULL,
  `description` varchar(50) NOT NULL,
  `employee_id` int(30) NOT NULL,
  `rpt_status` varchar(20) NOT NULL,
  `cut_off_date` date NOT NULL,
  `start_date` date NOT NULL,
  `completion_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `inv_date`, `description`, `employee_id`, `rpt_status`, `cut_off_date`, `start_date`, `completion_date`) VALUES
(5, '2022-09-01', 'SEPT 2022', 4, 'Closed', '2022-08-30', '2022-09-01', '2022-09-30'),
(6, '2022-11-01', 'November Inventory', 6, 'Open', '2022-09-30', '2022-11-01', '2022-11-30'),
(8, '0000-00-00', '', 6, 'Open', '0000-00-00', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `inventorydetails`
--

CREATE TABLE `inventorydetails` (
  `id` int(30) NOT NULL,
  `inv_id` int(30) DEFAULT NULL,
  `asset_code` varchar(20) NOT NULL,
  `asset_status` varchar(20) NOT NULL,
  `remarks` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventorydetails`
--

INSERT INTO `inventorydetails` (`id`, `inv_id`, `asset_code`, `asset_status`, `remarks`) VALUES
(13, 5, '2200001', 'Serviceable', 'working'),
(14, 5, '2200002', 'Serviceable', 'unserviceable'),
(17, 5, '2200006', 'Serviceable', 'working'),
(18, 5, '2200008', 'Serviceable', ''),
(19, 5, '2200009', 'Serviceable', ''),
(20, 5, '2200011', 'Serviceable', ''),
(21, 5, '2200012', 'Serviceable', ''),
(22, 5, '2200013', 'Serviceable', ''),
(25, 6, '2200001', 'Unserviceable', '');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`) VALUES
(1, 'HO'),
(2, 'TMC2'),
(3, 'EVRMC');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(20) NOT NULL,
  `notif_name` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `type` varchar(20) NOT NULL,
  `role_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notif_name`, `message`, `type`, `role_id`) VALUES
(2, 'New User Created', ' A new user has been created.', 'Message', 1),
(3, 'User Updated', 'A user record has been updated.', 'Message', 1),
(4, 'User Deleted', 'A user has been deleted.', 'Message', 1);

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`id`, `name`) VALUES
(2, 'PNOC'),
(3, 'PAFC'),
(4, 'PDMC'),
(5, 'PSTC');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `name`) VALUES
(1, 'User Maintenance'),
(2, 'Role Maintenance'),
(3, 'Permission Maintenance'),
(4, 'Asset Categories Maintenance'),
(5, 'Employees Maintenance'),
(6, 'Department Maintenance'),
(7, 'Office Mainitenance'),
(8, 'Location Maintenance'),
(9, 'Fund Cluster Maintenance'),
(10, 'Asset Masterlist'),
(11, 'Asset Assignment'),
(12, 'Asset Inventory'),
(13, 'Supplies Masterlist'),
(14, 'Supplies Delivery'),
(15, 'Supplies Issuance'),
(16, 'Reports'),
(19, 'Asset Transfer'),
(20, 'Employee Ledger Card'),
(21, 'RPCPPE'),
(22, 'IIRUP'),
(23, 'Waste Material Report'),
(24, 'Assets per Employee'),
(25, 'Assets Per Category'),
(26, 'Assets Per Department '),
(27, 'Activity Logs'),
(28, 'Barcode Stickers'),
(29, 'Notifications Maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `rolepermissions`
--

CREATE TABLE `rolepermissions` (
  `id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `permission_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rolepermissions`
--

INSERT INTO `rolepermissions` (`id`, `role_id`, `permission_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 4),
(4, 1, 5),
(5, 2, 7),
(6, 2, 8),
(7, 4, 9),
(8, 5, 10),
(9, 6, 7),
(10, 6, 8),
(11, 6, 9),
(14, 5, 1),
(15, 1, 6),
(16, 1, 8),
(17, 7, 10),
(18, 7, 11),
(19, 1, 3),
(20, 1, 7),
(21, 7, 12),
(22, 7, 13),
(23, 7, 14),
(24, 7, 15),
(25, 7, 16),
(27, 7, 20),
(28, 8, 27),
(29, 8, 11),
(30, 8, 4),
(31, 8, 12),
(32, 8, 10),
(33, 8, 19),
(34, 8, 25),
(35, 8, 26),
(36, 8, 24),
(37, 8, 28),
(38, 8, 6),
(39, 8, 20),
(40, 8, 5),
(42, 8, 9),
(43, 8, 22),
(44, 8, 8),
(45, 8, 7),
(46, 8, 3),
(47, 8, 16),
(48, 8, 2),
(49, 8, 21),
(50, 8, 14),
(51, 8, 15),
(52, 8, 13),
(53, 8, 1),
(54, 8, 23),
(55, 1, 29),
(56, 1, 10),
(57, 1, 12),
(58, 1, 16),
(59, 1, 22),
(60, 1, 20),
(61, 1, 21),
(62, 1, 28);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` bigint(20) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'User'),
(4, 'Supervisor'),
(5, 'Auditor'),
(7, 'Property Custodian');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Assigned'),
(2, 'Unassigned');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `contact_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `address`, `contact_number`, `contact_name`) VALUES
(11, 'MANOLO SALARDA BOHOL', 'Lt 14 block 9 phase 1 Villa San Isidro', '0284207844', 'NOLI BOHOL');

-- --------------------------------------------------------

--
-- Table structure for table `supplies_begbal`
--

CREATE TABLE `supplies_begbal` (
  `id` int(30) NOT NULL,
  `item_code` varchar(20) DEFAULT NULL,
  `balance_date` date DEFAULT NULL,
  `beg_bal` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplies_master`
--

CREATE TABLE `supplies_master` (
  `id` int(30) NOT NULL,
  `item_type` int(30) DEFAULT NULL,
  `item_code` varchar(20) DEFAULT NULL,
  `item_description` varchar(50) DEFAULT NULL,
  `unit_of_measure` varchar(10) DEFAULT NULL,
  `pcs_unit` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplies_master`
--

INSERT INTO `supplies_master` (`id`, `item_type`, `item_code`, `item_description`, `unit_of_measure`, `pcs_unit`) VALUES
(6, 0, 'S-001', 'Bond Paper Short', '', 100),
(7, 0, 'S-002', 'Bond Paper Long', 'ream', 100),
(8, 0, 'S-003', 'Bond Paper A4', 'ream', 100),
(9, 0, 'S-004', 'Brown Envelope Short', 'pc', 1),
(10, 0, 'S-005', 'Brown Envelope Long', 'pc', 1),
(11, 0, 'S-006', 'Scotch Tape Large', 'pc', 1),
(12, 0, 'S-007', 'Scotch Tape small', 'pc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplies_txn`
--

CREATE TABLE `supplies_txn` (
  `id` int(30) NOT NULL,
  `tran_date` date DEFAULT NULL,
  `tran_code` varchar(30) DEFAULT NULL,
  `ref_no` varchar(20) DEFAULT NULL,
  `department_id` int(30) DEFAULT NULL,
  `item_id` varchar(20) NOT NULL,
  `purchase_price` double DEFAULT NULL,
  `dep` double DEFAULT NULL,
  `wdw` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplies_txn`
--

INSERT INTO `supplies_txn` (`id`, `tran_date`, `tran_code`, `ref_no`, `department_id`, `item_id`, `purchase_price`, `dep`, `wdw`) VALUES
(1, '2023-03-09', 'DEL', '23-03001', NULL, '6', 245, 200, NULL),
(2, '2023-03-02', 'WDW', '23-0001', 1, '6', NULL, NULL, 50),
(3, '2023-03-02', 'DEL', '23-03002', NULL, '7', 285, 300, NULL),
(4, '2023-03-02', 'DEL', '23-03002', NULL, '8', 255, 100, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'system_name', 'Asset Management System'),
(2, 'system_short_name', 'AMS'),
(3, 'company_name', 'DBP Data Center, Inc.'),
(4, 'company_short_name', 'DCI'),
(5, 'logo', 'uploads/logo-1641955218.png'),
(6, 'user_avatar', 'uploads/user_avatar.jpg'),
(7, 'cover', 'uploads/cover-1641954928.png'),
(0, 'host', 'smtp.gmail.com'),
(0, 'username', 'rpaganan@dci.ph'),
(0, 'passwword', '491994Lefur'),
(0, 'port', '587');

-- --------------------------------------------------------

--
-- Table structure for table `tempassignment`
--

CREATE TABLE `tempassignment` (
  `id` int(30) NOT NULL,
  `mrnumber` varchar(30) NOT NULL,
  `mrdate` date NOT NULL,
  `employee_id` int(30) NOT NULL,
  `assetcode` varchar(20) NOT NULL,
  `assetid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `contact` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=admin , 2 = staff',
  `status` varchar(20) DEFAULT NULL,
  `wl_attempts` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `contact`, `username`, `password`, `type`, `status`, `wl_attempts`) VALUES
(1, 'Administrator', '', '', 'lefurz@yahoo.com', '$2y$10$Cp7cHq77N00amWOGAvIbZuD5fZVuM0IRHvd/WLQgv561nyn77DTbe', 1, 'ACTIVE', 0),
(6, 'Rufel Aganan', '', '', 'rpaganan@dci.ph', '$2y$10$Cp7cHq77N00amWOGAvIbZuD5fZVuM0IRHvd/WLQgv561nyn77DTbe', 1, 'ACTIVE', 0),
(7, 'Manolo Bohol', '', '', 'msbohol@gmail.com', '$2y$10$QAGYlvBRyxmVrkg1Rltr9eMOfYHW0woP2kduLvx0eleA5HbTC8XZG', 1, 'ACTIVE', 0),
(29, 'April Bote', '', '', 'atbote@dci.ph', '$2y$10$Lod4o2OuZhIRQ1mIWP4f9eR11hzZq9ug9/4ug5CKJHOB4NunBHdf.', 4, 'ACTIVE', 0),
(33, 'Jaymie Pasco', '', '', 'jpasco@gmail.com', '$2y$10$I3UXmlFcsWzWqZpTcaJD4.qARPJXesmlsxOpAa5LnleITl4nr9ML2', 5, 'ACTIVE', 0),
(34, 'Justin Brownloee', '', '', 'jblee@galc.com', '$2y$10$mhZEmme63euEHI1WQB9Hw.dH4VGTZrvorVR7irM.4KKXzQKgiSClW', 5, 'ACTIVE', 0),
(35, 'Jomer Aganan', '', '', 'jaganandsdf@gmail.com', '$2y$10$vHdAZStOzvnqHbZhaH5sh.oqNMJb1hVCd/D0fvKvq1i2cJ2UBm9mG', 5, 'ACTIVE', 0),
(38, 'John Doe', '', '', 'rpaganan', '$2y$10$as3FZ8MFZBKPBzTj.6mc..hDY/XGtm6QkSPU4Rt.RquAkjul.yPfS', 5, 'ACTIVE', 0),
(42, 'John Doe6', '', '', 'jdoe@gmail.com', '$2y$10$rkVh/QbiOPZL2D8W6ZkJbOR9Ax/EDZCUy6ozcLIQvWQJzRzXzSMBS', 5, 'ACTIVE', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activitylogs`
--
ALTER TABLE `activitylogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assetassignment`
--
ALTER TABLE `assetassignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assetitem`
--
ALTER TABLE `assetitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `condition`
--
ALTER TABLE `condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fund_cluster`
--
ALTER TABLE `fund_cluster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventorydetails`
--
ALTER TABLE `inventorydetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rolepermissions`
--
ALTER TABLE `rolepermissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplies_begbal`
--
ALTER TABLE `supplies_begbal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplies_master`
--
ALTER TABLE `supplies_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplies_txn`
--
ALTER TABLE `supplies_txn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tempassignment`
--
ALTER TABLE `tempassignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activitylogs`
--
ALTER TABLE `activitylogs`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=379;

--
-- AUTO_INCREMENT for table `assetassignment`
--
ALTER TABLE `assetassignment`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `assetitem`
--
ALTER TABLE `assetitem`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=388;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `condition`
--
ALTER TABLE `condition`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fund_cluster`
--
ALTER TABLE `fund_cluster`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inventorydetails`
--
ALTER TABLE `inventorydetails`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `rolepermissions`
--
ALTER TABLE `rolepermissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `supplies_begbal`
--
ALTER TABLE `supplies_begbal`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplies_master`
--
ALTER TABLE `supplies_master`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `supplies_txn`
--
ALTER TABLE `supplies_txn`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tempassignment`
--
ALTER TABLE `tempassignment`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
