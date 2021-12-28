-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 06:07 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chhanra_apartment`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_cookies`
--

CREATE TABLE `ci_cookies` (
  `id` int(11) NOT NULL,
  `cookie_id` varchar(255) DEFAULT NULL,
  `netid` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `orig_page_requested` varchar(120) DEFAULT NULL,
  `php_session_id` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('b2ff4cbfe923a5939a67d9e16f27e8c6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36', 1638504157, 'a:12:{s:9:\"user_data\";s:0:\"\";s:9:\"user_name\";s:4:\"demo\";s:6:\"roleid\";s:2:\"33\";s:9:\"arraction\";a:0:{}s:12:\"arrallaction\";a:79:{s:28:\"admin/payment_befor_checkout\";s:28:\"admin/payment_befor_checkout\";s:14:\"admin/checkout\";s:14:\"admin/checkout\";s:14:\"admin/customer\";s:14:\"admin/customer\";s:14:\"admin/cleaning\";s:14:\"admin/cleaning\";s:0:\"\";s:0:\"\";s:27:\"admin/reservation/add_multi\";s:27:\"admin/reservation/add_multi\";s:18:\"admin/report/daily\";s:18:\"admin/report/daily\";s:18:\"admin/customer/add\";s:18:\"admin/customer/add\";s:21:\"admin/customer/update\";s:21:\"admin/customer/update\";s:21:\"admin/customer/delete\";s:21:\"admin/customer/delete\";s:21:\"admin/reservation/add\";s:21:\"admin/reservation/add\";s:17:\"admin/reservation\";s:17:\"admin/reservation\";s:25:\"admin/reservation/confirm\";s:25:\"admin/reservation/confirm\";s:18:\"admin/checkout/out\";s:18:\"admin/checkout/out\";s:13:\"admin/checkin\";s:13:\"admin/checkin\";s:17:\"admin/checkin/add\";s:17:\"admin/checkin/add\";s:23:\"admin/checkin/multi_add\";s:23:\"admin/checkin/multi_add\";s:11:\"admin/extra\";s:11:\"admin/extra\";s:13:\"admin/reciept\";s:13:\"admin/reciept\";s:11:\"admin/eject\";s:11:\"admin/eject\";s:8:\"item/add\";s:8:\"item/add\";s:9:\"item/edit\";s:9:\"item/edit\";s:8:\"item/del\";s:8:\"item/del\";s:10:\"admin/item\";s:10:\"admin/item\";s:25:\"admin_checkin/dis_invoice\";s:25:\"admin_checkin/dis_invoice\";s:24:\"admin/reservation/delete\";s:24:\"admin/reservation/delete\";s:22:\"admin/view_reservation\";s:22:\"admin/view_reservation\";s:21:\"admin/cleaning/update\";s:21:\"admin/cleaning/update\";s:14:\"admin/roomtype\";s:14:\"admin/roomtype\";s:18:\"admin/roomtype/add\";s:18:\"admin/roomtype/add\";s:21:\"admin/roomtype/update\";s:21:\"admin/roomtype/update\";s:21:\"admin/roomtype/delete\";s:21:\"admin/roomtype/delete\";s:13:\"admin/staying\";s:13:\"admin/staying\";s:17:\"admin/staying/add\";s:17:\"admin/staying/add\";s:20:\"admin/staying/update\";s:20:\"admin/staying/update\";s:20:\"admin/staying/delete\";s:20:\"admin/staying/delete\";s:10:\"admin/room\";s:10:\"admin/room\";s:14:\"admin/room/add\";s:14:\"admin/room/add\";s:17:\"admin/room/update\";s:17:\"admin/room/update\";s:17:\"admin/room/delete\";s:17:\"admin/room/delete\";s:10:\"currencies\";s:10:\"currencies\";s:14:\"currencies/add\";s:14:\"currencies/add\";s:17:\"currencies/update\";s:17:\"currencies/update\";s:17:\"currencies/delete\";s:17:\"currencies/delete\";s:31:\"currencies/exspanse_type_insert\";s:31:\"currencies/exspanse_type_insert\";s:24:\"currencies//add_exspanse\";s:24:\"currencies//add_exspanse\";s:23:\"currencies/expense_list\";s:23:\"currencies/expense_list\";s:25:\"currencies/update_expenes\";s:25:\"currencies/update_expenes\";s:25:\"currencies/delete_expenes\";s:25:\"currencies/delete_expenes\";s:19:\"currencies/add_bank\";s:19:\"currencies/add_bank\";s:22:\"currencies/bank_insert\";s:22:\"currencies/bank_insert\";s:24:\"currencies/delete_insert\";s:24:\"currencies/delete_insert\";s:27:\"admin/cleaning/list_holiday\";s:27:\"admin/cleaning/list_holiday\";s:25:\"admin/cleaning/addHoliday\";s:25:\"admin/cleaning/addHoliday\";s:26:\"admin/cleaning/editHoliday\";s:26:\"admin/cleaning/editHoliday\";s:27:\"admin/cleaning/deletHoliday\";s:27:\"admin/cleaning/deletHoliday\";s:26:\"admin/report/today-checkin\";s:26:\"admin/report/today-checkin\";s:19:\"admin/customer/list\";s:19:\"admin/customer/list\";s:16:\"admin/show_rooms\";s:16:\"admin/show_rooms\";s:27:\"admin/report/today-checkout\";s:27:\"admin/report/today-checkout\";s:21:\"admin/report/customer\";s:21:\"admin/report/customer\";s:18:\"admin/report/unpay\";s:18:\"admin/report/unpay\";s:26:\"admin/report/profit-report\";s:26:\"admin/report/profit-report\";s:17:\"admin/report/room\";s:17:\"admin/report/room\";s:22:\"admin/report/free-room\";s:22:\"admin/report/free-room\";s:22:\"admin/report/Busy-room\";s:22:\"admin/report/Busy-room\";s:27:\"admin/report/payment_report\";s:27:\"admin/report/payment_report\";s:10:\"admin/user\";s:10:\"admin/user\";s:14:\"admin/user/add\";s:14:\"admin/user/add\";s:15:\"admin/user/edit\";s:15:\"admin/user/edit\";s:14:\"admin/user/del\";s:14:\"admin/user/del\";s:12:\"setting/role\";s:12:\"setting/role\";s:21:\"setting/role/saverole\";s:21:\"setting/role/saverole\";s:17:\"setting/role/edit\";s:17:\"setting/role/edit\";s:18:\"setting/permission\";s:18:\"setting/permission\";s:19:\"setting/role/delete\";s:19:\"setting/role/delete\";s:18:\"admin/view_checkin\";s:18:\"admin/view_checkin\";s:32:\"admin/report/report_room_by_date\";s:32:\"admin/report/report_room_by_date\";s:33:\"admin/report/report_room_by_month\";s:33:\"admin/report/report_room_by_month\";}s:9:\"is_member\";b:0;s:12:\"is_logged_in\";b:1;s:8:\"language\";b:0;s:20:\"manufacture_selected\";N;s:22:\"search_string_selected\";N;s:5:\"order\";N;s:10:\"order_type\";N;}'),
('b2eafa56dbd3356141ca5f67e9482e83', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36', 1638505687, 'a:12:{s:9:\"user_data\";s:0:\"\";s:9:\"user_name\";s:4:\"demo\";s:6:\"roleid\";s:2:\"33\";s:9:\"arraction\";a:0:{}s:12:\"arrallaction\";a:79:{s:28:\"admin/payment_befor_checkout\";s:28:\"admin/payment_befor_checkout\";s:14:\"admin/checkout\";s:14:\"admin/checkout\";s:14:\"admin/customer\";s:14:\"admin/customer\";s:14:\"admin/cleaning\";s:14:\"admin/cleaning\";s:0:\"\";s:0:\"\";s:27:\"admin/reservation/add_multi\";s:27:\"admin/reservation/add_multi\";s:18:\"admin/report/daily\";s:18:\"admin/report/daily\";s:18:\"admin/customer/add\";s:18:\"admin/customer/add\";s:21:\"admin/customer/update\";s:21:\"admin/customer/update\";s:21:\"admin/customer/delete\";s:21:\"admin/customer/delete\";s:21:\"admin/reservation/add\";s:21:\"admin/reservation/add\";s:17:\"admin/reservation\";s:17:\"admin/reservation\";s:25:\"admin/reservation/confirm\";s:25:\"admin/reservation/confirm\";s:18:\"admin/checkout/out\";s:18:\"admin/checkout/out\";s:13:\"admin/checkin\";s:13:\"admin/checkin\";s:17:\"admin/checkin/add\";s:17:\"admin/checkin/add\";s:23:\"admin/checkin/multi_add\";s:23:\"admin/checkin/multi_add\";s:11:\"admin/extra\";s:11:\"admin/extra\";s:13:\"admin/reciept\";s:13:\"admin/reciept\";s:11:\"admin/eject\";s:11:\"admin/eject\";s:8:\"item/add\";s:8:\"item/add\";s:9:\"item/edit\";s:9:\"item/edit\";s:8:\"item/del\";s:8:\"item/del\";s:10:\"admin/item\";s:10:\"admin/item\";s:25:\"admin_checkin/dis_invoice\";s:25:\"admin_checkin/dis_invoice\";s:24:\"admin/reservation/delete\";s:24:\"admin/reservation/delete\";s:22:\"admin/view_reservation\";s:22:\"admin/view_reservation\";s:21:\"admin/cleaning/update\";s:21:\"admin/cleaning/update\";s:14:\"admin/roomtype\";s:14:\"admin/roomtype\";s:18:\"admin/roomtype/add\";s:18:\"admin/roomtype/add\";s:21:\"admin/roomtype/update\";s:21:\"admin/roomtype/update\";s:21:\"admin/roomtype/delete\";s:21:\"admin/roomtype/delete\";s:13:\"admin/staying\";s:13:\"admin/staying\";s:17:\"admin/staying/add\";s:17:\"admin/staying/add\";s:20:\"admin/staying/update\";s:20:\"admin/staying/update\";s:20:\"admin/staying/delete\";s:20:\"admin/staying/delete\";s:10:\"admin/room\";s:10:\"admin/room\";s:14:\"admin/room/add\";s:14:\"admin/room/add\";s:17:\"admin/room/update\";s:17:\"admin/room/update\";s:17:\"admin/room/delete\";s:17:\"admin/room/delete\";s:10:\"currencies\";s:10:\"currencies\";s:14:\"currencies/add\";s:14:\"currencies/add\";s:17:\"currencies/update\";s:17:\"currencies/update\";s:17:\"currencies/delete\";s:17:\"currencies/delete\";s:31:\"currencies/exspanse_type_insert\";s:31:\"currencies/exspanse_type_insert\";s:24:\"currencies//add_exspanse\";s:24:\"currencies//add_exspanse\";s:23:\"currencies/expense_list\";s:23:\"currencies/expense_list\";s:25:\"currencies/update_expenes\";s:25:\"currencies/update_expenes\";s:25:\"currencies/delete_expenes\";s:25:\"currencies/delete_expenes\";s:19:\"currencies/add_bank\";s:19:\"currencies/add_bank\";s:22:\"currencies/bank_insert\";s:22:\"currencies/bank_insert\";s:24:\"currencies/delete_insert\";s:24:\"currencies/delete_insert\";s:27:\"admin/cleaning/list_holiday\";s:27:\"admin/cleaning/list_holiday\";s:25:\"admin/cleaning/addHoliday\";s:25:\"admin/cleaning/addHoliday\";s:26:\"admin/cleaning/editHoliday\";s:26:\"admin/cleaning/editHoliday\";s:27:\"admin/cleaning/deletHoliday\";s:27:\"admin/cleaning/deletHoliday\";s:26:\"admin/report/today-checkin\";s:26:\"admin/report/today-checkin\";s:19:\"admin/customer/list\";s:19:\"admin/customer/list\";s:16:\"admin/show_rooms\";s:16:\"admin/show_rooms\";s:27:\"admin/report/today-checkout\";s:27:\"admin/report/today-checkout\";s:21:\"admin/report/customer\";s:21:\"admin/report/customer\";s:18:\"admin/report/unpay\";s:18:\"admin/report/unpay\";s:26:\"admin/report/profit-report\";s:26:\"admin/report/profit-report\";s:17:\"admin/report/room\";s:17:\"admin/report/room\";s:22:\"admin/report/free-room\";s:22:\"admin/report/free-room\";s:22:\"admin/report/Busy-room\";s:22:\"admin/report/Busy-room\";s:27:\"admin/report/payment_report\";s:27:\"admin/report/payment_report\";s:10:\"admin/user\";s:10:\"admin/user\";s:14:\"admin/user/add\";s:14:\"admin/user/add\";s:15:\"admin/user/edit\";s:15:\"admin/user/edit\";s:14:\"admin/user/del\";s:14:\"admin/user/del\";s:12:\"setting/role\";s:12:\"setting/role\";s:21:\"setting/role/saverole\";s:21:\"setting/role/saverole\";s:17:\"setting/role/edit\";s:17:\"setting/role/edit\";s:18:\"setting/permission\";s:18:\"setting/permission\";s:19:\"setting/role/delete\";s:19:\"setting/role/delete\";s:18:\"admin/view_checkin\";s:18:\"admin/view_checkin\";s:32:\"admin/report/report_room_by_date\";s:32:\"admin/report/report_room_by_date\";s:33:\"admin/report/report_room_by_month\";s:33:\"admin/report/report_room_by_month\";}s:9:\"is_member\";b:0;s:12:\"is_logged_in\";b:1;s:8:\"language\";b:0;s:22:\"search_string_selected\";N;s:5:\"order\";N;s:10:\"order_type\";N;s:20:\"manufacture_selected\";N;}');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_addres` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `pass_word` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id`, `first_name`, `last_name`, `email_addres`, `user_name`, `pass_word`) VALUES
(1, 'a', 'a', 'netcat.av@gmail.com', 'admin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `sch_z_module`
--

CREATE TABLE `sch_z_module` (
  `moduleid` int(11) NOT NULL,
  `module_name` varchar(255) DEFAULT NULL,
  `module_name_kh` varchar(255) DEFAULT NULL,
  `sort_mod` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT 1,
  `mod_position` varchar(255) DEFAULT NULL,
  `icon` varchar(55) DEFAULT NULL,
  `icon_color` varchar(55) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sch_z_module`
--

INSERT INTO `sch_z_module` (`moduleid`, `module_name`, `module_name_kh`, `sort_mod`, `order`, `is_active`, `mod_position`, `icon`, `icon_color`) VALUES
(20, 'General Model', NULL, '1', 1, 1, '1', '1', '1'),
(21, 'Reports', NULL, '1', 1, 1, '1', '1', '1'),
(22, 'System', NULL, '1', 1, 1, '1', '1', '1'),
(23, 'Dashboard', NULL, '1', 1, 1, '1', '1', '1'),
(24, 'Settings', NULL, '1', 1, 1, '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sch_z_page`
--

CREATE TABLE `sch_z_page` (
  `pageid` int(11) NOT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `page_name_kh` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `moduleid` int(11) DEFAULT 1,
  `order` int(11) DEFAULT NULL,
  `is_insert` int(11) DEFAULT NULL,
  `is_update` int(11) DEFAULT NULL,
  `is_delete` int(11) DEFAULT NULL,
  `is_show` int(11) DEFAULT NULL,
  `is_print` int(11) DEFAULT NULL,
  `is_export` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `is_active` int(11) DEFAULT 1,
  `icon` varchar(255) DEFAULT 'fa-bars'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sch_z_page`
--

INSERT INTO `sch_z_page` (`pageid`, `page_name`, `page_name_kh`, `link`, `moduleid`, `order`, `is_insert`, `is_update`, `is_delete`, `is_show`, `is_print`, `is_export`, `created_by`, `created_date`, `is_active`, `icon`) VALUES
(179, 'Reservation', NULL, 'admin/reservation', 20, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 11:52:20', 1, 'fa-bars'),
(180, 'Check-in', NULL, 'admin/checkin', 20, NULL, 0, 0, 0, 0, 0, 0, 1, '2019-12-31 12:12:13', 1, 'fa-bars'),
(181, 'Check-out', NULL, 'admin/checkout', 20, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-29 16:40:33', 1, 'fa-bars'),
(182, 'Customer', NULL, 'admin/customer', 20, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-29 15:15:40', 1, 'fa-bars'),
(183, 'Add item', NULL, 'admin/item', 20, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-29 17:34:25', 1, 'fa-bars'),
(184, 'Cleaning', NULL, 'admin/cleaning', 20, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 13:29:18', 1, 'fa-bars'),
(185, 'Daily Reports', NULL, 'admin/report/daily', 21, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 16:50:14', 1, 'fa-bars'),
(186, 'Customer Reports ', NULL, 'report/customer', 21, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-29 11:54:59', 0, 'fa-bars'),
(187, 'Add Extra', NULL, 'admin/extra', 20, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-29 17:13:12', 0, 'fa-bars'),
(188, 'Room Type', NULL, 'admin/roomtype', 22, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 13:33:51', 1, 'fa-bars'),
(189, 'Staying Time', NULL, 'admin/staying', 22, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 13:44:08', 1, 'fa-bars'),
(190, 'Room', NULL, 'admin/room', 22, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 13:46:01', 1, 'fa-bars'),
(191, 'Currencies', NULL, 'currencies', 22, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 13:58:37', 1, 'fa-bars'),
(192, 'Expense Type', NULL, 'currencies/exspanse_type_insert', 22, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 14:13:32', 1, 'fa-bars'),
(193, 'Expense', NULL, 'currencies/expense_list', 22, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 14:20:14', 1, 'fa-bars'),
(194, 'Bank', NULL, 'currencies/add_bank', 22, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 14:33:10', 1, 'fa-bars'),
(195, 'Holiday', NULL, 'admin/cleaning/list_holiday', 22, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 14:41:45', 1, 'fa-bars'),
(196, 'Dashboard', NULL, 'admin/dashboards', 23, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 16:40:45', 1, 'fa-bars'),
(197, 'Customer Report', NULL, 'admin/report/customer', 21, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 16:51:35', 1, 'fa-bars'),
(198, 'Unpay Report', NULL, 'admin/report/unpay', 21, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 16:52:23', 1, 'fa-bars'),
(199, 'Profit Report', NULL, 'admin/report/profit-report', 21, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 16:53:55', 1, 'fa-bars'),
(200, 'Today Check-In Report', NULL, 'admin/report/today-checkin', 21, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 16:57:06', 1, 'fa-bars'),
(201, 'Today Check-Out Report', NULL, 'admin/report/today-checkout', 21, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 16:56:41', 1, 'fa-bars'),
(202, 'Room Report', NULL, 'admin/report/room', 21, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 16:57:57', 1, 'fa-bars'),
(203, 'Free Room Report', NULL, 'admin/report/free-room', 21, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 16:58:35', 1, 'fa-bars'),
(204, 'Busy Room Report', NULL, 'admin/report/Busy-room', 21, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 16:59:28', 1, 'fa-bars'),
(205, 'Payments Report', NULL, 'admin/report/payment_report', 21, NULL, 1, 1, 1, 1, 1, 1, 1, '2019-12-30 17:01:15', 1, 'fa-bars'),
(206, 'User', NULL, 'admin/user', 24, NULL, 0, 0, 0, 0, 0, 0, 1, '2019-12-30 17:05:42', 1, 'fa-bars'),
(207, 'User Role', NULL, 'setting/role', 20, NULL, 0, 0, 0, 0, 0, 0, 1, '2019-12-30 17:10:02', 1, 'fa-bars'),
(208, 'Report Room By Date', NULL, 'admin/report/report_room_by_date', 21, NULL, 0, 0, 0, 0, 0, 0, 1, '2020-01-04 08:57:02', 1, 'fa-bars'),
(209, 'Report Room By Month', NULL, 'admin/report/report_room_by_month', 21, NULL, 0, 0, 0, 0, 0, 0, 1, '2020-01-07 14:46:44', 1, 'fa-bars');

-- --------------------------------------------------------

--
-- Table structure for table `sch_z_page_route`
--

CREATE TABLE `sch_z_page_route` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `action_name` varchar(255) DEFAULT NULL,
  `action_url` varchar(255) DEFAULT NULL,
  `is_mudule` tinyint(2) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sch_z_page_route`
--

INSERT INTO `sch_z_page_route` (`id`, `page_id`, `action_name`, `action_url`, `is_mudule`) VALUES
(221, 180, 'Payment', 'admin/payment_befor_checkout', NULL),
(86, 181, 'List ', 'admin/checkout', NULL),
(59, 182, 'Customer', 'admin/customer', NULL),
(152, 184, 'List Cleaning', 'admin/cleaning', NULL),
(50, 186, NULL, '', NULL),
(148, 179, 'Add Multi', 'admin/reservation/add_multi', NULL),
(193, 185, 'Daily Report', 'admin/report/daily', NULL),
(60, 182, 'Add Customer', 'admin/customer/add', NULL),
(61, 182, 'Update Customer', 'admin/customer/update', NULL),
(62, 182, 'Delete Customer', 'admin/customer/delete', NULL),
(149, 179, 'Add new', 'admin/reservation/add', NULL),
(147, 179, 'List', 'admin/reservation', NULL),
(146, 179, 'Confirm Reservation', 'admin/reservation/confirm', NULL),
(220, 180, 'Check-Out', 'admin/checkout/out', NULL),
(219, 180, 'List Check-in', 'admin/checkin', NULL),
(218, 180, 'Add Check-In', 'admin/checkin/add', NULL),
(217, 180, 'Multi Check-In', 'admin/checkin/multi_add', NULL),
(216, 180, 'Add Extra', 'admin/extra', NULL),
(87, 181, 'View Receipt', 'admin/reciept', NULL),
(88, 181, 'Eject', 'admin/eject', NULL),
(136, 183, 'Add Item', 'item/add', NULL),
(135, 183, 'Edit Item', 'item/edit', NULL),
(134, 183, 'Delete Item', 'item/del', NULL),
(122, 187, 'Add Extra', 'admin/extra', NULL),
(137, 183, 'List Item', 'admin/item', NULL),
(215, 180, 'Discount', 'admin_checkin/dis_invoice', NULL),
(150, 179, 'Delete Reservation', 'admin/reservation/delete', NULL),
(151, 179, 'View Detail Reservation', 'admin/view_reservation', NULL),
(153, 184, 'Update Clean', 'admin/cleaning/update', NULL),
(154, 188, 'List Room Type', 'admin/roomtype', NULL),
(155, 188, 'Add Room Type', 'admin/roomtype/add', NULL),
(156, 188, 'Update Room Type', 'admin/roomtype/update', NULL),
(157, 188, 'Delete Room Type', 'admin/roomtype/delete', NULL),
(158, 189, 'List Staying Time', 'admin/staying', NULL),
(159, 189, 'Add  Staying Time', 'admin/staying/add', NULL),
(160, 189, 'Update Staying Time', 'admin/staying/update', NULL),
(161, 189, 'Delete Staying Time', 'admin/staying/delete', NULL),
(162, 190, 'List Room', 'admin/room', NULL),
(163, 190, 'Add Room', 'admin/room/add', NULL),
(164, 190, 'Update Room', 'admin/room/update', NULL),
(165, 190, 'Delete Room', 'admin/room/delete', NULL),
(166, 191, 'List Currencies', 'currencies', NULL),
(167, 191, 'Add Currencies', 'currencies/add', NULL),
(168, 191, 'Update Currencies', 'currencies/update', NULL),
(169, 191, 'Delete Currencies', 'currencies/delete', NULL),
(173, 192, 'Add Expense Type', 'currencies/exspanse_type_insert', NULL),
(175, 193, 'Add Expense', 'currencies//add_exspanse', NULL),
(174, 193, 'List Expense', 'currencies/expense_list', NULL),
(176, 193, 'Update Expense', 'currencies/update_expenes', NULL),
(177, 193, 'Delete Expense', 'currencies/delete_expenes', NULL),
(178, 194, 'List Bank', 'currencies/add_bank', NULL),
(179, 194, 'Add Bank', 'currencies/bank_insert', NULL),
(180, 194, 'Delete Bank', 'currencies/delete_insert', NULL),
(181, 195, 'List Holiday', 'admin/cleaning/list_holiday', NULL),
(182, 195, 'Add Holiday', 'admin/cleaning/addHoliday', NULL),
(183, 195, 'Update Holiday', 'admin/cleaning/editHoliday', NULL),
(184, 195, 'Delete Holiday', 'admin/cleaning/deletHoliday', NULL),
(191, 196, 'Today Check-In', 'admin/report/today-checkin', NULL),
(190, 196, 'List Customer', 'admin/customer/list', NULL),
(189, 196, 'Show Room', 'admin/show_rooms', NULL),
(192, 196, 'Today Check-Out', 'admin/report/today-checkout', NULL),
(194, 197, 'Customer Report', 'admin/report/customer', NULL),
(195, 198, 'Unpay Report', 'admin/report/unpay', NULL),
(196, 199, 'Profit Report', 'admin/report/profit-report', NULL),
(200, 200, 'Today Check-In Report', 'admin/report/today-checkin', NULL),
(199, 201, 'Today Check-Out Report', 'admin/report/today-checkout', NULL),
(201, 202, 'Room Report', 'admin/report/room', NULL),
(202, 203, 'Free Room Report', 'admin/report/free-room', NULL),
(203, 204, 'Busy Room Report', 'admin/report/Busy-room', NULL),
(205, 205, 'Payments Report', 'admin/report/payment_report', NULL),
(206, 206, 'List User', 'admin/user', NULL),
(207, 206, 'Add User', 'admin/user/add', NULL),
(208, 206, 'Edit User', 'admin/user/edit', NULL),
(209, 206, 'Delete User', 'admin/user/del', NULL),
(210, 207, 'List User Role', 'setting/role', NULL),
(211, 207, 'Add User Role', 'setting/role/saverole', NULL),
(212, 207, 'Edit User Role', 'setting/role/edit', NULL),
(213, 207, 'User  Permission', 'setting/permission', NULL),
(214, 207, 'Delete User Role', 'setting/role/delete', NULL),
(222, 180, 'View Detail Checkin', 'admin/view_checkin', NULL),
(224, 208, 'Report Room By Date', 'admin/report/report_room_by_date', NULL),
(225, 209, 'Report Room By Month', 'admin/report/report_room_by_month', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sch_z_page_route_action`
--

CREATE TABLE `sch_z_page_route_action` (
  `role_actionid` int(11) NOT NULL,
  `roleid` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sch_z_page_route_action`
--

INSERT INTO `sch_z_page_route_action` (`role_actionid`, `roleid`, `action`) VALUES
(417, 49, 'admin/cleaning/list_holiday'),
(418, 49, 'admin/cleaning/addHoliday'),
(419, 49, 'admin/cleaning/editHoliday'),
(420, 49, 'admin/cleaning/deletHoliday'),
(421, 49, 'admin/reservation/add_multi'),
(422, 49, 'admin/reservation/add'),
(423, 49, 'admin/reservation'),
(424, 49, 'admin/reservation/confirm'),
(425, 49, 'admin/view_reservation'),
(426, 49, 'admin/payment_befor_checkout'),
(427, 49, 'admin/checkout/out'),
(428, 49, 'admin/checkin'),
(429, 49, 'admin/checkin/add'),
(430, 49, 'admin/checkin/multi_add'),
(431, 49, 'admin/extra'),
(432, 49, 'admin_checkin/dis_invoice'),
(433, 49, 'admin/view_checkin'),
(434, 49, 'admin/checkout'),
(435, 49, 'admin/reciept'),
(436, 49, 'admin/customer'),
(437, 49, 'admin/customer/add'),
(438, 49, 'admin/customer/update'),
(439, 49, 'admin/customer/delete'),
(440, 49, 'item/add'),
(441, 49, 'item/edit'),
(442, 49, 'admin/item'),
(443, 49, 'admin/cleaning'),
(444, 49, 'admin/cleaning/update'),
(445, 49, 'admin/report/today-checkin'),
(446, 49, 'admin/report/today-checkin'),
(447, 49, 'admin/customer/list'),
(448, 49, 'admin/show_rooms'),
(449, 49, 'admin/report/today-checkout'),
(450, 49, 'admin/report/today-checkout'),
(451, 49, 'admin/report/daily'),
(452, 49, 'admin/report/customer'),
(453, 49, 'admin/report/unpay'),
(454, 49, 'admin/report/profit-report'),
(455, 49, 'admin/report/today-checkin'),
(456, 49, 'admin/report/today-checkin'),
(457, 49, 'admin/report/today-checkout'),
(458, 49, 'admin/report/today-checkout'),
(459, 49, 'admin/report/room'),
(460, 49, 'admin/report/free-room'),
(461, 49, 'admin/report/Busy-room'),
(462, 49, 'admin/report/payment_report'),
(463, 49, 'admin/report/report_room_by_date'),
(464, 49, 'admin/report/report_room_by_month'),
(465, 51, 'currencies//add_exspanse'),
(466, 51, 'currencies/expense_list'),
(467, 51, 'admin/payment_befor_checkout'),
(468, 51, 'admin/checkout/out'),
(469, 51, 'admin/checkin'),
(470, 51, 'admin/checkin/add'),
(471, 51, 'admin/checkin/multi_add'),
(472, 51, 'admin/extra'),
(473, 51, 'admin_checkin/dis_invoice'),
(474, 51, 'admin/view_checkin'),
(475, 51, 'admin/show_rooms'),
(476, 51, 'admin/report/daily'),
(477, 51, 'admin/report/payment_report'),
(478, 51, 'admin/report/room'),
(479, 51, 'admin/report/profit-report'),
(480, 51, 'admin/report/customer'),
(630, 50, 'admin/report/today-checkin'),
(631, 50, 'admin/report/today-checkin'),
(632, 50, 'admin/report/today-checkin'),
(633, 50, 'admin/report/today-checkin'),
(634, 50, 'admin/report/today-checkin'),
(635, 50, 'admin/report/today-checkin'),
(636, 50, 'admin/report/today-checkin'),
(637, 50, 'admin/report/today-checkin'),
(638, 50, 'admin/report/room'),
(639, 50, 'admin/report/report_room_by_month'),
(640, 50, 'admin/report/Busy-room'),
(641, 50, 'admin/report/today-checkout'),
(642, 50, 'admin/report/today-checkout'),
(643, 50, 'admin/report/today-checkout'),
(644, 50, 'admin/report/today-checkout'),
(645, 50, 'admin/report/report_room_by_date'),
(646, 50, 'admin/report/free-room'),
(647, 50, 'admin/report/customer'),
(648, 50, 'admin/report/daily'),
(649, 50, 'admin/checkout'),
(650, 50, 'admin/reciept'),
(651, 50, 'admin/customer'),
(652, 50, 'admin/customer/add'),
(653, 50, 'admin/customer/update'),
(654, 50, 'admin/cleaning'),
(655, 50, 'admin/cleaning/update'),
(656, 50, 'admin/reservation/confirm'),
(657, 50, 'admin/reservation/delete'),
(658, 50, 'admin/view_reservation'),
(659, 50, 'admin/reservation/add_multi'),
(660, 50, 'admin/reservation/add'),
(661, 50, 'admin/reservation'),
(662, 50, 'admin/payment_befor_checkout'),
(663, 50, 'admin/checkout/out'),
(664, 50, 'admin/checkin'),
(665, 50, 'admin/checkin/add'),
(666, 50, 'admin/checkin/multi_add'),
(667, 50, 'admin/extra'),
(668, 50, 'admin_checkin/dis_invoice'),
(669, 50, 'admin/view_checkin'),
(670, 50, 'admin/report/today-checkout'),
(671, 50, 'admin/report/today-checkout'),
(672, 50, 'admin/report/today-checkin'),
(673, 50, 'admin/report/today-checkin'),
(674, 50, 'admin/report/today-checkin'),
(675, 50, 'admin/report/today-checkin'),
(676, 50, 'admin/report/today-checkin'),
(677, 50, 'admin/report/today-checkout'),
(678, 50, 'admin/report/today-checkin'),
(679, 50, 'admin/customer/list'),
(680, 50, 'admin/show_rooms'),
(681, 50, 'admin/report/today-checkout'),
(682, 50, 'admin/report/today-checkin'),
(683, 50, 'admin/report/today-checkin'),
(684, 48, 'admin/cleaning/list_holiday'),
(685, 48, 'admin/cleaning/addHoliday'),
(686, 48, 'admin/cleaning/editHoliday'),
(687, 48, 'admin/cleaning/deletHoliday'),
(688, 48, 'admin/roomtype'),
(689, 48, 'admin/roomtype/add'),
(690, 48, 'admin/roomtype/update'),
(691, 48, 'admin/roomtype/delete'),
(692, 48, 'admin/staying'),
(693, 48, 'admin/staying/add'),
(694, 48, 'admin/staying/update'),
(695, 48, 'admin/staying/delete'),
(696, 48, 'currencies'),
(697, 48, 'currencies/add'),
(698, 48, 'currencies/update'),
(699, 48, 'currencies/delete'),
(700, 48, 'currencies/add_bank'),
(701, 48, 'currencies/bank_insert'),
(702, 48, 'currencies/delete_insert'),
(703, 48, 'currencies//add_exspanse'),
(704, 48, 'currencies/expense_list'),
(705, 48, 'currencies/update_expenes'),
(706, 48, 'currencies/delete_expenes'),
(707, 48, 'admin/room'),
(708, 48, 'admin/room/add'),
(709, 48, 'admin/room/update'),
(710, 48, 'admin/room/delete'),
(711, 48, 'currencies/exspanse_type_insert'),
(712, 48, 'admin/user'),
(713, 48, 'admin/user/add'),
(714, 48, 'admin/user/edit'),
(715, 48, 'admin/user/del'),
(716, 48, 'admin/report/payment_report'),
(717, 48, 'admin/report/unpay'),
(718, 48, 'admin/report/customer'),
(719, 48, 'admin/report/today-checkin'),
(720, 48, 'admin/report/today-checkin'),
(721, 48, 'admin/report/today-checkin'),
(722, 48, 'admin/report/today-checkin'),
(723, 48, 'admin/report/today-checkin'),
(724, 48, 'admin/report/today-checkin'),
(725, 48, 'admin/report/today-checkin'),
(726, 48, 'admin/report/today-checkin'),
(727, 48, 'admin/report/today-checkin'),
(728, 48, 'admin/report/today-checkin'),
(729, 48, 'admin/report/today-checkin'),
(730, 48, 'admin/report/today-checkin'),
(731, 48, 'admin/report/today-checkin'),
(732, 48, 'admin/report/today-checkin'),
(733, 48, 'admin/report/today-checkin'),
(734, 48, 'admin/report/today-checkin'),
(735, 48, 'admin/report/room'),
(736, 48, 'admin/report/daily'),
(737, 48, 'admin/report/today-checkout'),
(738, 48, 'admin/report/today-checkout'),
(739, 48, 'admin/report/today-checkout'),
(740, 48, 'admin/report/today-checkout'),
(741, 48, 'admin/report/today-checkout'),
(742, 48, 'admin/report/today-checkout'),
(743, 48, 'admin/report/today-checkout'),
(744, 48, 'admin/report/today-checkout'),
(745, 48, 'admin/report/report_room_by_date'),
(746, 48, 'admin/report/Busy-room'),
(747, 48, 'admin/report/free-room'),
(748, 48, 'admin/report/report_room_by_month'),
(749, 48, 'admin/report/profit-report'),
(750, 48, 'admin/report/today-checkout'),
(751, 48, 'admin/report/today-checkout'),
(752, 48, 'admin/report/today-checkin'),
(753, 48, 'admin/report/today-checkin'),
(754, 48, 'admin/report/today-checkin'),
(755, 48, 'admin/report/today-checkin'),
(756, 48, 'admin/report/today-checkin'),
(757, 48, 'admin/report/today-checkin'),
(758, 48, 'admin/report/today-checkout'),
(759, 48, 'admin/report/today-checkout'),
(760, 48, 'admin/report/today-checkin'),
(761, 48, 'admin/report/today-checkin'),
(762, 48, 'admin/customer/list'),
(763, 48, 'admin/show_rooms'),
(764, 48, 'admin/report/today-checkout'),
(765, 48, 'admin/report/today-checkout'),
(766, 48, 'admin/report/today-checkout'),
(767, 48, 'admin/report/today-checkout'),
(768, 48, 'admin/report/today-checkin'),
(769, 48, 'admin/report/today-checkin'),
(770, 48, 'admin/report/today-checkin'),
(771, 48, 'admin/report/today-checkin'),
(772, 48, 'admin/report/today-checkin'),
(773, 48, 'admin/report/today-checkin'),
(774, 48, 'admin/report/today-checkin'),
(775, 48, 'admin/report/today-checkin'),
(776, 48, 'admin/reservation/add'),
(777, 48, 'admin/reservation'),
(778, 48, 'admin/view_reservation'),
(779, 48, 'admin/reservation/add_multi'),
(780, 48, 'admin/reservation/confirm'),
(781, 48, 'admin/reservation/delete'),
(782, 48, 'setting/role'),
(783, 48, 'setting/role/saverole'),
(784, 48, 'setting/role/edit'),
(785, 48, 'setting/permission'),
(786, 48, 'setting/role/delete'),
(787, 48, 'admin/checkout'),
(788, 48, 'admin/reciept'),
(789, 48, 'admin/eject'),
(790, 48, 'admin/cleaning'),
(791, 48, 'admin/cleaning/update'),
(792, 48, 'admin/item'),
(793, 48, 'item/add'),
(794, 48, 'item/edit'),
(795, 48, 'item/del'),
(796, 48, 'admin/customer'),
(797, 48, 'admin/customer/add'),
(798, 48, 'admin/customer/update'),
(799, 48, 'admin/customer/delete'),
(800, 48, 'admin/checkin'),
(801, 48, 'admin/view_checkin'),
(802, 48, 'admin_checkin/dis_invoice'),
(803, 48, 'admin/checkin/multi_add'),
(804, 48, 'admin/checkin/add'),
(805, 48, 'admin/checkout/out'),
(806, 48, 'admin/payment_befor_checkout'),
(807, 48, 'admin/extra');

-- --------------------------------------------------------

--
-- Table structure for table `sch_z_role`
--

CREATE TABLE `sch_z_role` (
  `roleid` int(11) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `is_admin` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sch_z_role`
--

INSERT INTO `sch_z_role` (`roleid`, `role`, `is_admin`, `is_active`) VALUES
(33, 'Super Admin', 2, 1),
(48, 'Admin', NULL, 1),
(49, 'Sale Hotel', NULL, 1),
(50, 'Receptionist', NULL, 1),
(51, 'Accountant', NULL, 1),
(52, 'demo', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sch_z_role_module_detail`
--

CREATE TABLE `sch_z_role_module_detail` (
  `mod_rol_id` int(11) NOT NULL,
  `roleid` int(11) DEFAULT NULL,
  `moduleid` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sch_z_role_module_detail`
--

INSERT INTO `sch_z_role_module_detail` (`mod_rol_id`, `roleid`, `moduleid`, `order`) VALUES
(492, 47, 20, NULL),
(540, 48, 24, NULL),
(539, 48, 23, NULL),
(538, 48, 22, NULL),
(537, 48, 21, NULL),
(536, 48, 20, NULL),
(516, 49, 22, NULL),
(515, 49, 21, NULL),
(514, 49, 20, NULL),
(535, 50, 23, NULL),
(534, 50, 21, NULL),
(510, 51, 20, NULL),
(511, 51, 21, NULL),
(512, 51, 22, NULL),
(513, 51, 23, NULL),
(517, 49, 23, NULL),
(518, 49, 24, NULL),
(533, 50, 20, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sch_z_role_page`
--

CREATE TABLE `sch_z_role_page` (
  `role_page_id` int(11) NOT NULL,
  `roleid` int(11) DEFAULT NULL,
  `pageid` int(11) DEFAULT NULL,
  `moduleid` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `is_read` int(1) DEFAULT 1,
  `is_insert` int(1) DEFAULT 1,
  `is_delete` int(1) DEFAULT 1,
  `is_update` int(1) DEFAULT 1,
  `is_print` int(1) DEFAULT 1,
  `is_export` int(1) DEFAULT 1,
  `is_import` int(1) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sch_z_role_page`
--

INSERT INTO `sch_z_role_page` (`role_page_id`, `roleid`, `pageid`, `moduleid`, `created_date`, `created_by`, `is_read`, `is_insert`, `is_delete`, `is_update`, `is_print`, `is_export`, `is_import`) VALUES
(399, 48, 183, 20, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(398, 48, 184, 20, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(397, 48, 181, 20, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(91, 33, NULL, NULL, '2019-12-29 16:07:14', '1', 0, 0, 0, 0, 0, 0, 0),
(396, 48, 207, 20, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(395, 48, 179, 20, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(394, 48, 196, 23, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(393, 48, 199, 21, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(392, 48, 209, 21, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(391, 48, 203, 21, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(390, 48, 204, 21, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(389, 48, 208, 21, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(388, 48, 201, 21, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(387, 48, 185, 21, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(386, 48, 202, 21, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(385, 48, 200, 21, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(384, 48, 197, 21, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(383, 48, 198, 21, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(382, 48, 205, 21, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(381, 48, 206, 24, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(380, 48, 192, 22, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(379, 48, 190, 22, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(378, 48, 193, 22, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(377, 48, 194, 22, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(376, 48, 191, 22, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(375, 48, 189, 22, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(374, 48, 188, 22, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(373, 48, 195, 22, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(296, 49, 209, 21, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(295, 49, 208, 21, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(294, 49, 205, 21, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(293, 49, 204, 21, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(371, 50, 180, 20, '2020-12-22 11:24:19', '1', 0, 0, 0, 0, 0, 0, 0),
(370, 50, 179, 20, '2020-12-22 11:24:19', '1', 0, 0, 0, 0, 0, 0, 0),
(369, 50, 184, 20, '2020-12-22 11:24:19', '1', 0, 0, 0, 0, 0, 0, 0),
(368, 50, 182, 20, '2020-12-22 11:24:19', '1', 0, 0, 0, 0, 0, 0, 0),
(367, 50, 181, 20, '2020-12-22 11:24:19', '1', 0, 0, 0, 0, 0, 0, 0),
(366, 50, 185, 21, '2020-12-22 11:24:19', '1', 0, 0, 0, 0, 0, 0, 0),
(303, 51, 199, 21, '2020-11-28 16:51:13', '1', 0, 0, 0, 0, 0, 0, 0),
(302, 51, 202, 21, '2020-11-28 16:51:13', '1', 0, 0, 0, 0, 0, 0, 0),
(301, 51, 205, 21, '2020-11-28 16:51:13', '1', 0, 0, 0, 0, 0, 0, 0),
(300, 51, 185, 21, '2020-11-28 16:51:13', '1', 0, 0, 0, 0, 0, 0, 0),
(299, 51, 196, 23, '2020-11-28 16:51:13', '1', 0, 0, 0, 0, 0, 0, 0),
(298, 51, 180, 20, '2020-11-28 16:51:13', '1', 0, 0, 0, 0, 0, 0, 0),
(297, 51, 193, 22, '2020-11-28 16:51:13', '1', 0, 0, 0, 0, 0, 0, 0),
(292, 49, 203, 21, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(291, 49, 202, 21, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(365, 50, 197, 21, '2020-12-22 11:24:19', '1', 0, 0, 0, 0, 0, 0, 0),
(364, 50, 203, 21, '2020-12-22 11:24:19', '1', 0, 0, 0, 0, 0, 0, 0),
(363, 50, 208, 21, '2020-12-22 11:24:19', '1', 0, 0, 0, 0, 0, 0, 0),
(362, 50, 201, 21, '2020-12-22 11:24:19', '1', 0, 0, 0, 0, 0, 0, 0),
(361, 50, 204, 21, '2020-12-22 11:24:19', '1', 0, 0, 0, 0, 0, 0, 0),
(290, 49, 201, 21, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(289, 49, 200, 21, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(288, 49, 199, 21, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(287, 49, 198, 21, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(286, 49, 197, 21, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(285, 49, 185, 21, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(284, 49, 196, 23, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(283, 49, 184, 20, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(282, 49, 183, 20, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(281, 49, 182, 20, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(280, 49, 181, 20, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(279, 49, 180, 20, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(278, 49, 179, 20, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(277, 49, 195, 22, '2020-01-14 12:03:59', '1', 0, 0, 0, 0, 0, 0, 0),
(304, 51, 197, 21, '2020-11-28 16:51:13', '1', 0, 0, 0, 0, 0, 0, 0),
(360, 50, 209, 21, '2020-12-22 11:24:19', '1', 0, 0, 0, 0, 0, 0, 0),
(359, 50, 202, 21, '2020-12-22 11:24:19', '1', 0, 0, 0, 0, 0, 0, 0),
(358, 50, 200, 21, '2020-12-22 11:24:19', '1', 0, 0, 0, 0, 0, 0, 0),
(372, 50, 196, 23, '2020-12-22 11:24:19', '1', 0, 0, 0, 0, 0, 0, 0),
(400, 48, 182, 20, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0),
(401, 48, 180, 20, '2020-12-22 11:40:47', '1', 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `id` int(11) NOT NULL,
  `account_name` varchar(45) DEFAULT NULL,
  `account_number` varchar(45) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`id`, `account_name`, `account_number`, `status`, `date`) VALUES
(6, 'ABA', '00002334', NULL, '2021-06-25 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_charges`
--

CREATE TABLE `tbl_charges` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkin`
--

CREATE TABLE `tbl_checkin` (
  `id` int(11) NOT NULL,
  `reserv_id` int(11) DEFAULT 0,
  `customer_id` int(11) DEFAULT NULL,
  `date_in` datetime DEFAULT NULL,
  `date_out` datetime DEFAULT NULL,
  `room_no` varchar(45) DEFAULT NULL,
  `staying` int(11) DEFAULT NULL,
  `extra_charges` int(11) DEFAULT NULL,
  `discount` decimal(11,2) DEFAULT NULL,
  `deposit` decimal(11,2) DEFAULT NULL,
  `checkouted` int(11) NOT NULL DEFAULT 0,
  `time` varchar(50) NOT NULL,
  `user` varchar(45) NOT NULL,
  `pay` varchar(200) DEFAULT NULL,
  `checkin_type` int(10) DEFAULT NULL,
  `eject` int(1) DEFAULT 1,
  `multi_checkin` varchar(55) DEFAULT NULL,
  `percent_dis` varchar(25) DEFAULT NULL,
  `cleaning_status` tinyint(1) DEFAULT NULL,
  `price` varchar(250) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL,
  `bank_id` int(11) NOT NULL,
  `account_name` varchar(200) NOT NULL,
  `note` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `account_number` varchar(15) NOT NULL,
  `bank_amount` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_checkin`
--

INSERT INTO `tbl_checkin` (`id`, `reserv_id`, `customer_id`, `date_in`, `date_out`, `room_no`, `staying`, `extra_charges`, `discount`, `deposit`, `checkouted`, `time`, `user`, `pay`, `checkin_type`, `eject`, `multi_checkin`, `percent_dis`, `cleaning_status`, `price`, `total`, `grand_total`, `bank_id`, `account_name`, `note`, `account_number`, `bank_amount`) VALUES
(207, 241939, 16, '2021-11-23 11:33:50', '2022-11-23 00:00:00', '205', 1, 0, '0.00', '0.00', 0, '', 'demo', 'unpay', 196, 1, NULL, NULL, NULL, '10.00', '120.00', '120.00', 0, '', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkin_detail`
--

CREATE TABLE `tbl_checkin_detail` (
  `detail_id` int(10) NOT NULL,
  `checkin_id` int(10) DEFAULT NULL,
  `room_id` int(10) DEFAULT NULL,
  `room_type` int(10) DEFAULT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `item_name` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `price` float(11,2) DEFAULT NULL,
  `price_more` varchar(250) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `date_order` date DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `amount` float(11,2) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `overtime` float(11,2) DEFAULT NULL,
  `current_date` date DEFAULT NULL,
  `is_pay` tinyint(1) DEFAULT 0,
  `is_clean` tinyint(1) DEFAULT 0,
  `date_out` datetime DEFAULT NULL,
  `refun_amount` decimal(10,0) DEFAULT NULL,
  `refun_by` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_checkin_detail`
--

INSERT INTO `tbl_checkin_detail` (`detail_id`, `checkin_id`, `room_id`, `room_type`, `room_no`, `item_name`, `price`, `price_more`, `qty`, `date_order`, `discount`, `amount`, `note`, `status`, `overtime`, `current_date`, `is_pay`, `is_clean`, `date_out`, `refun_amount`, `refun_by`) VALUES
(266, 207, 205, 69, '5', 'staying', 120.00, '10.00', 1, '2021-12-03', '0.00', 120.00, NULL, NULL, NULL, '2021-12-03', 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkoutcharg`
--

CREATE TABLE `tbl_checkoutcharg` (
  `id` int(11) NOT NULL,
  `checkout_id` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_currencies`
--

CREATE TABLE `tbl_currencies` (
  `id` int(11) NOT NULL,
  `cur_code` varchar(50) NOT NULL,
  `cur_name` varchar(50) NOT NULL,
  `cur_exchange` double NOT NULL,
  `symbol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_currencies`
--

INSERT INTO `tbl_currencies` (`id`, `cur_code`, `cur_name`, `cur_exchange`, `symbol`) VALUES
(9, '1', 'Riel', 4100, '៛'),
(10, '2', 'Dollar', 1, '$');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Family` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Gender` varchar(20) DEFAULT NULL,
  `Adress` text CHARACTER SET utf8 DEFAULT NULL,
  `Country` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Nationality` varchar(45) DEFAULT NULL,
  `City` varchar(45) DEFAULT NULL,
  `Age` varchar(45) DEFAULT NULL,
  `Passport` varchar(45) DEFAULT NULL,
  `credit_card` varchar(50) DEFAULT NULL,
  `Mobile` varchar(45) DEFAULT NULL,
  `Company` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `Note` text CHARACTER SET utf8 DEFAULT NULL,
  `verifyed` int(11) NOT NULL DEFAULT 0,
  `file` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `Name`, `Family`, `Gender`, `Adress`, `Country`, `Nationality`, `City`, `Age`, `Passport`, `credit_card`, `Mobile`, `Company`, `email`, `password`, `Note`, `verifyed`, `file`) VALUES
(9, '', 'James', 'male', 'st 12', 'Cambodia', '', 'Phnom Penh', '', '', NULL, '01222331', 'Smart', NULL, NULL, '', 1, NULL),
(14, '', 'Nita', 'male', '', '3241', '3241', '', '40', '234124', NULL, '43534132', '', NULL, NULL, '', 1, NULL),
(15, '', 'Apartment', 'male', '', '', '', '', '', '', NULL, '0968483334', '', NULL, NULL, '', 1, NULL),
(16, '', 'David', '', '', '', '', '', '', '', NULL, '03838382', '', NULL, NULL, '', 1, NULL),
(17, '', 'Sheyha', '', '', '', '', '', '', '', NULL, '048483334', '', NULL, NULL, '', 1, NULL),
(18, '', 'ABC', 'male', '', '', 'Khmer', '', '', '82379837498', NULL, '0963484872', '', NULL, NULL, '', 1, NULL),
(19, '', 'dfSADF', 'male', '', '', '', '', '', '', NULL, '087856767', '', NULL, NULL, '', 1, NULL),
(20, '', 'SADS', 'male', '', '', '', '', '', '', NULL, '096655354', '', NULL, NULL, '', 1, NULL),
(21, '', 'sddf', 'male', '', '', '', '', '', '', NULL, '0989876867', '', NULL, NULL, '', 1, NULL),
(22, '', 'AAA', 'female', '', '', '', '', '', '', NULL, '09684443', '', NULL, NULL, '', 1, '../../assets/pdf/22.pdf'),
(23, '', 'dsfsdf', 'male', '', '', '', '', '', '', NULL, '097565767', '', NULL, NULL, '', 1, '0'),
(24, '', 'AAAA', '', '', '', '', '', '', '', NULL, '00969954', '', NULL, NULL, '', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email_addres` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `pass_word` varchar(32) DEFAULT NULL,
  `type` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `first_name`, `last_name`, `email_addres`, `user_name`, `pass_word`, `type`) VALUES
(9, 'Chhour', 'ChhengLang', 'domnak@gmail.com', 'Lang', 'a4d081cbf64295da323e7aea00de236d', 33),
(24, 'Vita', 'Ton', '', 'vita', 'd0970714757783e6cf17b26fb8e2298f', 50),
(25, 'ly', 'long', 'long@gmail.com', 'demo', '41fed8e90b23c05184f3d92b8899f31d', 33);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense`
--

CREATE TABLE `tbl_expense` (
  `id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `ex_type_id` int(11) DEFAULT NULL,
  `amount` decimal(45,2) DEFAULT NULL,
  `amount_cost` decimal(45,2) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_expense`
--

INSERT INTO `tbl_expense` (`id`, `date`, `ex_type_id`, `amount`, `amount_cost`, `note`) VALUES
(1, '2021-06-01 00:00:00', 4, '2000.00', '0.00', ''),
(2, '2021-06-03 00:00:00', 5, '21.00', '0.00', ''),
(3, '2021-07-10 10:12:06', 5, '234567.00', '12344.00', ''),
(4, '2021-08-05 00:00:00', 5, '2453243.00', '0.00', ''),
(5, '2021-06-30 00:00:00', 4, '123333.00', '3243.00', ''),
(6, '2021-07-10 00:00:00', 5, '45000.00', '50000.00', ''),
(7, '2021-07-10 00:00:00', 5, '70000.00', '50000.00', ''),
(8, '2021-07-13 00:00:00', 5, '9000.00', '7000.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense_type`
--

CREATE TABLE `tbl_expense_type` (
  `id` int(11) NOT NULL,
  `ex_type` varchar(45) DEFAULT NULL,
  `note` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_expense_type`
--

INSERT INTO `tbl_expense_type` (`id`, `ex_type`, `note`) VALUES
(3, 'ភ្លើង', NULL),
(4, 'ថ្លៃទឹក', NULL),
(5, 'ទឹក', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fund`
--

CREATE TABLE `tbl_fund` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_holiday`
--

CREATE TABLE `tbl_holiday` (
  `id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `descripton` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_holiday`
--

INSERT INTO `tbl_holiday` (`id`, `date`, `descripton`) VALUES
(7, '2021-01-01 00:00:00', 'Khmer New year'),
(9, '2020-04-13 00:00:00', 'ពិធីបុណ្យចូលឆ្នាំខ្មែរប្រពៃណីជាតិ'),
(10, '2020-05-01 00:00:00', 'ទិវាពលកម្មអន្តរជាតិ'),
(11, '2020-05-06 00:00:00', 'ពិធីបុណ្យវិសាខបូជា'),
(12, '2020-05-10 00:00:00', 'ព្រះរាជពិធីច្រត់ព្រះនង្គ័ល'),
(13, '2020-05-14 00:00:00', 'ព្រះរាជពិធីបុណ្យចម្រើនព្រះជន្ម​​សម្ដេចព្រះបរមនាថនរោត្តមសីហមុនី'),
(14, '2020-06-18 00:00:00', 'ព្រះរាជពិធីបុណ្យចម្រើនព្រះជន្ម​​សម្ដេចព្រះមហាក្សត្រីព្រះវរាជមាតានរោត្តមមុនីនាថសីហនុ'),
(15, '2020-09-16 00:00:00', 'ពិធីបុណ្យភ្ជុំបិណ្ឌ'),
(16, '2020-09-17 00:00:00', 'ពិធីបុណ្យភ្ជុំបិណ្ឌ'),
(17, '2020-09-18 00:00:00', 'ពិធីបុណ្យភ្ជុំបិណ្ឌ'),
(18, '2020-09-24 00:00:00', 'ទិវាប្រកាសរដ្ឋធម្មនុញ្ញ'),
(19, '2020-10-15 00:00:00', 'ទិវាប្រារព្ធពិធីគោពវិញ្ញាណក្ខន្ធព្រះករុណាព្រះបាទសម្ដេចព្រះនរោត្តមសីហនុព្រះបរមរតនកោដ្ឋ'),
(20, '2020-10-29 00:00:00', 'ព្រះរាជពិធីគ្រងរាជសម្បត្តិព្រះករុណាព្រះបាទសម្ដេចព្រះបរមនាថនរោត្តមសីហមុនី'),
(21, '2020-10-30 00:00:00', 'ព្រះរាជពិធីបុណ្យអុំទូកបណ្ដែតប្រទីបសំពះព្រះខែអកអំបុក'),
(22, '2020-10-31 00:00:00', 'ព្រះរាជពិធីបុណ្យអុំទូកបណ្ដែតប្រទីបសំពះព្រះខែអកអំបុក'),
(23, '2020-11-01 00:00:00', 'ព្រះរាជពិធីបុណ្យអុំទូកបណ្ដែតប្រទីបសំពះព្រះខែអកអំបុក'),
(24, '2020-11-09 00:00:00', 'ពិធីបុណ្យឯករាជ្យជាតិ'),
(25, '2020-04-14 00:00:00', 'ពិធីបុណ្យចូលឆ្នាំខ្មែរប្រពៃណីជាតិ'),
(26, '2020-04-15 00:00:00', 'ពិធីបុណ្យចូលឆ្នាំខ្មែរប្រពៃណីជាតិ'),
(27, '2020-04-16 00:00:00', 'ពិធីបុណ្យចូលឆ្នាំខ្មែរប្រពៃណីជាតិ'),
(28, '2020-08-17 00:00:00', 'Khmer new years'),
(29, '2020-08-18 00:00:00', 'Khmer new year'),
(30, '2020-08-19 00:00:00', 'Khmer new years'),
(31, '2020-08-20 00:00:00', 'Khmer new year'),
(32, '2020-08-21 00:00:00', 'Khmer new years');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hotelprofile`
--

CREATE TABLE `tbl_hotelprofile` (
  `id` int(11) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `phone_1` varchar(45) DEFAULT NULL,
  `phone_2` varchar(45) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `pid` int(10) NOT NULL,
  `p_name` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `price` float(11,2) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`pid`, `p_name`, `qty`, `price`, `note`) VALUES
(5, 'ថ្លៃទឹក', 0, 2500.00, NULL),
(6, 'ខ្សែកាប', 0, 15000.00, NULL),
(7, 'ថ្លៃភ្លើង', 1, 0.50, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_history`
--

CREATE TABLE `tbl_login_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `time_in` varchar(45) DEFAULT NULL,
  `time_out` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_multireservation`
--

CREATE TABLE `tbl_multireservation` (
  `id` int(11) NOT NULL,
  `reserv_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `room_number` varchar(45) DEFAULT NULL,
  `room_type` int(10) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `room_price` decimal(10,2) DEFAULT NULL,
  `room_price_more` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_multireservation`
--

INSERT INTO `tbl_multireservation` (`id`, `reserv_id`, `room_id`, `room_number`, `room_type`, `status`, `room_price`, `room_price_more`, `amount`) VALUES
(5, 68, 170, 'A-01', 51, NULL, '10.00', '10,10,10,10,10,10,10,10,10,10,10,10', '120.00'),
(6, 68, 171, 'A-04', 51, NULL, '10.00', '10,10,10,10,10,10,10,10,10,10,10,10', '120.00'),
(7, 68, 173, 'R-01', 51, NULL, '10.00', '10,10,10,10,10,10,10,10,10,10,10,10', '120.00'),
(8, 75, 170, 'A-01', 51, NULL, '10.00', '10,10,10,10,10,10,10,10,10,10,10,10', '120.00'),
(9, 75, 171, 'A-04', 51, NULL, '10.00', '10,10,10,10,10,10,10,10,10,10,10,10', '120.00'),
(10, 75, 173, 'R-01', 51, NULL, '10.00', '10,10,10,10,10,10,10,10,10,10,10,10', '120.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_othercharges`
--

CREATE TABLE `tbl_othercharges` (
  `id` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `checkout_id` int(11) DEFAULT NULL,
  `pay_made` varchar(45) DEFAULT NULL,
  `pay_date` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` float(11,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `id` int(11) NOT NULL,
  `checkin_id` int(10) DEFAULT NULL,
  `reserva_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `deposit` decimal(10,2) DEFAULT NULL,
  `discount` varchar(10) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `checkin_id`, `reserva_id`, `user_id`, `user_name`, `date`, `deposit`, `discount`, `total`, `grand_total`) VALUES
(1271, 196, NULL, NULL, 'demo', '2021-11-22 09:17:17', '0.00', '0.00', '1200.00', '300.00'),
(1272, 198, NULL, NULL, 'demo', '2021-11-23 10:16:46', '0.00', '0.00', '3600.00', '80300.00'),
(1273, 204, NULL, NULL, 'demo', '2021-12-03 09:00:31', '0.00', '0.00', '3600.00', '300.00'),
(1274, 204, NULL, NULL, 'demo', '2021-12-03 09:06:54', '0.00', '0.00', '3600.00', '300.00'),
(1275, 204, NULL, NULL, 'demo', '2021-12-03 09:17:07', '0.00', '0.00', '3600.00', '300.00'),
(1276, 204, NULL, NULL, 'demo', '2021-12-03 09:17:24', '0.00', '0.00', '3600.00', '300.00'),
(1277, 204, NULL, NULL, 'demo', '2021-12-03 09:17:32', '0.00', '0.00', '3600.00', '300.00'),
(1278, 204, NULL, NULL, 'demo', '2021-12-03 09:17:40', '0.00', '0.00', '3600.00', '300.00'),
(1279, 204, NULL, NULL, 'demo', '2021-12-03 09:17:46', '0.00', '0.00', '3600.00', '300.00'),
(1280, 204, NULL, NULL, 'demo', '2021-12-03 09:19:18', '0.00', '0.00', '3600.00', '300.00'),
(1281, 204, NULL, NULL, 'demo', '2021-12-03 09:19:28', '0.00', '0.00', '3600.00', '300.00'),
(1282, 204, NULL, NULL, 'demo', '2021-12-03 09:19:35', '0.00', '0.00', '3600.00', '300.00'),
(1283, 204, NULL, NULL, 'demo', '2021-12-03 09:19:42', '0.00', '0.00', '3600.00', '300.00'),
(1284, 204, NULL, NULL, 'demo', '2021-12-03 09:19:56', '0.00', '0.00', '3600.00', '300.00'),
(1285, 204, NULL, NULL, 'demo', '2021-12-03 09:20:04', '0.00', '0.00', '3600.00', '300.00'),
(1286, 204, NULL, NULL, 'demo', '2021-12-03 09:20:19', '0.00', '0.00', '3600.00', '300.00'),
(1287, 204, NULL, NULL, 'demo', '2021-12-03 09:20:35', '0.00', '0.00', '3600.00', '300.00'),
(1288, 204, NULL, NULL, 'demo', '2021-12-03 09:20:39', '0.00', '0.00', '3600.00', '300.00'),
(1289, 204, NULL, NULL, 'demo', '2021-12-03 09:20:45', '0.00', '0.00', '3600.00', '300.00'),
(1290, 204, NULL, NULL, 'demo', '2021-12-03 09:20:51', '0.00', '0.00', '3600.00', '300.00'),
(1291, 204, NULL, NULL, 'demo', '2021-12-03 09:24:27', '0.00', '0.00', '3600.00', '300.00'),
(1292, 204, NULL, NULL, 'demo', '2021-12-03 09:24:47', '0.00', '0.00', '3600.00', '300.00'),
(1293, 204, NULL, NULL, 'demo', '2021-12-03 09:24:54', '0.00', '0.00', '3600.00', '300.00'),
(1294, 204, NULL, NULL, 'demo', '2021-12-03 09:25:01', '0.00', '0.00', '3600.00', '300.00'),
(1295, 204, NULL, NULL, 'demo', '2021-12-03 09:25:14', '0.00', '0.00', '3600.00', '300.00'),
(1296, 204, NULL, NULL, 'demo', '2021-12-03 09:25:23', '0.00', '0.00', '3600.00', '300.00'),
(1297, 204, NULL, NULL, 'demo', '2021-12-03 09:25:37', '0.00', '0.00', '3600.00', '300.00'),
(1298, 204, NULL, NULL, 'demo', '2021-12-03 09:25:54', '0.00', '0.00', '3600.00', '300.00'),
(1299, 204, NULL, NULL, 'demo', '2021-12-03 09:26:03', '0.00', '0.00', '3600.00', '300.00'),
(1300, 204, NULL, NULL, 'demo', '2021-12-03 09:26:21', '0.00', '0.00', '3600.00', '300.00'),
(1301, 204, NULL, NULL, 'demo', '2021-12-03 09:27:01', '0.00', '0.00', '3600.00', '300.00'),
(1302, 204, NULL, NULL, 'demo', '2021-12-03 09:27:16', '0.00', '0.00', '3600.00', '300.00'),
(1303, 204, NULL, NULL, 'demo', '2021-12-03 09:27:22', '0.00', '0.00', '3600.00', '300.00'),
(1304, 204, NULL, NULL, 'demo', '2021-12-03 09:27:28', '0.00', '0.00', '3600.00', '300.00'),
(1305, 204, NULL, NULL, 'demo', '2021-12-03 09:27:35', '0.00', '0.00', '3600.00', '300.00'),
(1306, 204, NULL, NULL, 'demo', '2021-12-03 09:27:51', '0.00', '0.00', '3600.00', '300.00'),
(1307, 204, NULL, NULL, 'demo', '2021-12-03 09:28:00', '0.00', '0.00', '3600.00', '300.00'),
(1308, 205, NULL, NULL, 'demo', '2021-12-03 09:30:35', '0.00', '0.00', '720.00', '60.00'),
(1309, 205, NULL, NULL, 'demo', '2021-12-03 09:30:56', '0.00', '0.00', '720.00', '60.00'),
(1310, 206, NULL, NULL, 'demo', '2021-12-03 10:27:32', '0.00', '0.00', '2520.00', '210.00'),
(1311, 206, NULL, NULL, 'demo', '2021-12-03 10:28:26', '0.00', '0.00', '2520.00', '210.00'),
(1312, 206, NULL, NULL, 'demo', '2021-12-03 10:28:31', '0.00', '0.00', '2520.00', '210.00'),
(1313, 206, NULL, NULL, 'demo', '2021-12-03 10:28:51', '0.00', '0.00', '2520.00', '210.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_card`
--

CREATE TABLE `tbl_payment_card` (
  `id` int(11) NOT NULL,
  `pay_id` int(11) DEFAULT NULL,
  `card_no` varchar(45) DEFAULT NULL,
  `receipt_no` varchar(45) DEFAULT NULL,
  `pay_date` varchar(45) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_cash`
--

CREATE TABLE `tbl_payment_cash` (
  `id` int(11) NOT NULL,
  `pay_id` int(11) DEFAULT NULL,
  `pay_date` varchar(45) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_cheque`
--

CREATE TABLE `tbl_payment_cheque` (
  `id` int(11) NOT NULL,
  `pay_id` int(11) DEFAULT NULL,
  `cheque_No` varchar(45) DEFAULT NULL,
  `Acc_No` varchar(45) DEFAULT NULL,
  `pay_date` varchar(45) DEFAULT NULL,
  `tbl_Payment_Chequecol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_detail`
--

CREATE TABLE `tbl_payment_detail` (
  `id` int(11) NOT NULL,
  `payment_id` int(10) DEFAULT NULL,
  `checkindetail_id` int(10) DEFAULT NULL,
  `room_id` int(10) DEFAULT NULL,
  `sale_id` int(10) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `full_pay` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_payment_detail`
--

INSERT INTO `tbl_payment_detail` (`id`, `payment_id`, `checkindetail_id`, `room_id`, `sale_id`, `item_name`, `status`, `amount`, `full_pay`) VALUES
(2579, 1263, 223, 202, NULL, '3G ( 2 )', 'room', '2520.00', NULL),
(2580, 1264, 230, 202, NULL, '3G ( 2 )', 'room', '2520.00', NULL),
(2581, 1265, 229, 202, NULL, '3G ( 2 )', 'room', '2520.00', NULL),
(2582, 1266, 234, 229, NULL, 'One Bed Room ( 101 )', 'room', '720.00', NULL),
(2583, 1267, 237, 229, NULL, 'One Bed Room ( 101 )', 'room', '720.00', NULL),
(2584, 1267, 238, NULL, NULL, 'ថ្លៃទឹក', 'extra_item', '5000.00', NULL),
(2585, 1268, 236, 229, NULL, 'One Bed Room ( 101 )', 'room', '720.00', NULL),
(2586, 1268, 239, NULL, NULL, 'ខ្សែកាប', 'extra_item', '45000.00', NULL),
(2587, 1269, 235, 229, NULL, 'One Bed Room ( 101 )', 'room', '720.00', NULL),
(2588, 1269, 240, NULL, NULL, 'ខ្សែកាប', 'extra_item', '45000.00', NULL),
(2589, 1270, 241, 202, NULL, '3G ( 2 )', 'room', '2520.00', NULL),
(2590, 1270, 242, NULL, NULL, 'ថ្លៃទឹក', 'extra_item', '2500.00', NULL),
(2591, 1271, 253, 201, NULL, '1D ( 1 )', 'room', '1200.00', NULL),
(2592, 1272, 255, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2593, 1272, 256, NULL, NULL, 'ថ្លៃទឹក', 'extra_item', '5000.00', NULL),
(2594, 1272, 257, NULL, NULL, 'ខ្សែកាប', 'extra_item', '75000.00', NULL),
(2595, 1273, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2596, 1274, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2597, 1275, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2598, 1276, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2599, 1277, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2600, 1278, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2601, 1279, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2602, 1280, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2603, 1281, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2604, 1282, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2605, 1283, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2606, 1284, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2607, 1285, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2608, 1286, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2609, 1287, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2610, 1288, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2611, 1289, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2612, 1290, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2613, 1291, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2614, 1292, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2615, 1293, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2616, 1294, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2617, 1295, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2618, 1296, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2619, 1297, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2620, 1298, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2621, 1299, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2622, 1300, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2623, 1301, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2624, 1302, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2625, 1303, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2626, 1304, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2627, 1305, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2628, 1306, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2629, 1307, 263, 201, NULL, '1D ( 1 )', 'room', '3600.00', NULL),
(2630, 1308, 264, 203, NULL, 'មជ E1 01 ( 3 )', 'room', '720.00', NULL),
(2631, 1309, 264, 203, NULL, 'មជ E1 01 ( 3 )', 'room', '720.00', NULL),
(2632, 1310, 265, 202, NULL, '3G ( 2 )', 'room', '2520.00', NULL),
(2633, 1311, 265, 202, NULL, '3G ( 2 )', 'room', '2520.00', NULL),
(2634, 1312, 265, 202, NULL, '3G ( 2 )', 'room', '2520.00', NULL),
(2635, 1313, 265, 202, NULL, '3G ( 2 )', 'room', '2520.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissions`
--

CREATE TABLE `tbl_permissions` (
  `id` int(11) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `UserEntry` int(11) DEFAULT NULL,
  `CustomerSet` int(11) DEFAULT NULL,
  `Serviceset` int(11) DEFAULT NULL,
  `prreport` int(11) DEFAULT NULL,
  `config` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation`
--

CREATE TABLE `tbl_reservation` (
  `id` int(11) NOT NULL,
  `Customer_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `reservation_date` varchar(45) DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `checkin_data` varchar(45) DEFAULT NULL,
  `checkout_data` varchar(45) DEFAULT NULL,
  `confirmed` int(11) NOT NULL DEFAULT 0,
  `staying` varchar(100) DEFAULT NULL,
  `duration` varchar(50) DEFAULT '0',
  `total_price` varchar(250) DEFAULT NULL,
  `note` text CHARACTER SET utf8 DEFAULT NULL,
  `price` varchar(250) DEFAULT NULL,
  `canceled` int(2) DEFAULT 0,
  `deposit` decimal(10,2) DEFAULT NULL,
  `bank_acc_name` varchar(50) DEFAULT NULL,
  `bank_acc_number` varchar(50) DEFAULT NULL,
  `deposit_type` int(11) DEFAULT NULL,
  `discount` varchar(10) DEFAULT NULL,
  `grand_total` decimal(18,2) DEFAULT NULL,
  `is_multy` tinyint(1) DEFAULT 0,
  `canceled_by` varchar(255) DEFAULT NULL,
  `full_pay` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_reservation`
--

INSERT INTO `tbl_reservation` (`id`, `Customer_id`, `room_id`, `reservation_date`, `create_by`, `checkin_data`, `checkout_data`, `confirmed`, `staying`, `duration`, `total_price`, `note`, `price`, `canceled`, `deposit`, `bank_acc_name`, `bank_acc_number`, `deposit_type`, `discount`, `grand_total`, `is_multy`, `canceled_by`, `full_pay`) VALUES
(241888, 9, 201, '2021-11-23', 'demo', '2022-11-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '0.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241889, 9, 201, '2021-11-23', 'demo', '2022-10-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '0.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241890, 9, 201, '2021-11-23', 'demo', '2022-09-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '0.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241891, 9, 201, '2021-11-23', 'demo', '2022-08-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '0.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241892, 9, 201, '2021-11-23', 'demo', '2022-07-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '0.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241893, 9, 201, '2021-11-23', 'demo', '2022-06-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '0.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241894, 9, 201, '2021-11-23', 'demo', '2022-05-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '0.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241895, 9, 201, '2021-11-23', 'demo', '2022-04-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '0.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241896, 9, 201, '2021-11-23', 'demo', '2022-03-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '0.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241897, 9, 201, '2021-11-23', 'demo', '2022-02-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '0.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241898, 9, 201, '2021-11-23', 'demo', '2022-01-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '0.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241899, 9, 201, '2021-11-23', 'demo', '2021-12-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '0.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241900, 9, 201, '2021-11-23', 'demo', '2021-11-23', '2022-11-23', 1, '192', '1', '3600', '0', '300.00', 0, '0.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241901, 14, 202, '2021-11-23', 'demo', '2022-11-23', '2022-11-23', 0, '193', '1', '2520', '0', '210.00', 1, '0.00', '0', '0', 0, '0', '2520.00', 0, NULL, NULL),
(241902, 14, 202, '2021-11-23', 'demo', '2022-10-23', '2022-11-23', 0, '193', '1', '2520', '0', '210.00', 1, '0.00', '0', '0', 0, '0', '2520.00', 0, 'demo', NULL),
(241903, 14, 202, '2021-11-23', 'demo', '2022-09-23', '2022-11-23', 0, '193', '1', '2520', '0', '210.00', 1, '0.00', '0', '0', 0, '0', '2520.00', 0, 'demo', NULL),
(241904, 14, 202, '2021-11-23', 'demo', '2022-08-23', '2022-11-23', 0, '193', '1', '2520', '0', '210.00', 1, '0.00', '0', '0', 0, '0', '2520.00', 0, 'demo', NULL),
(241905, 14, 202, '2021-11-23', 'demo', '2022-07-23', '2022-11-23', 0, '193', '1', '2520', '0', '210.00', 0, '0.00', '0', '0', 0, '0', '2520.00', 0, NULL, NULL),
(241906, 14, 202, '2021-11-23', 'demo', '2022-06-23', '2022-11-23', 0, '193', '1', '2520', '0', '210.00', 0, '0.00', '0', '0', 0, '0', '2520.00', 0, NULL, NULL),
(241907, 14, 202, '2021-11-23', 'demo', '2022-05-23', '2022-11-23', 0, '193', '1', '2520', '0', '210.00', 0, '0.00', '0', '0', 0, '0', '2520.00', 0, NULL, NULL),
(241908, 14, 202, '2021-11-23', 'demo', '2022-04-23', '2022-11-23', 0, '193', '1', '2520', '0', '210.00', 0, '0.00', '0', '0', 0, '0', '2520.00', 0, NULL, NULL),
(241909, 14, 202, '2021-11-23', 'demo', '2022-03-23', '2022-11-23', 0, '193', '1', '2520', '0', '210.00', 0, '0.00', '0', '0', 0, '0', '2520.00', 0, NULL, NULL),
(241910, 14, 202, '2021-11-23', 'demo', '2022-02-23', '2022-11-23', 0, '193', '1', '2520', '0', '210.00', 0, '0.00', '0', '0', 0, '0', '2520.00', 0, NULL, NULL),
(241911, 14, 202, '2021-11-23', 'demo', '2022-01-23', '2022-11-23', 0, '193', '1', '2520', '0', '210.00', 0, '0.00', '0', '0', 0, '0', '2520.00', 0, NULL, NULL),
(241912, 14, 202, '2021-11-23', 'demo', '2021-12-23', '2022-11-23', 0, '193', '1', '2520', '0', '210.00', 0, '0.00', '0', '0', 0, '0', '2520.00', 0, NULL, NULL),
(241913, 14, 202, '2021-11-23', 'demo', '2021-11-23', '2022-11-23', 1, '193', '1', '2520', '0', '210.00', 0, '0.00', '0', '0', 0, '0', '2520.00', 0, NULL, NULL),
(241914, 15, 203, '2021-11-23', 'demo', '2022-11-23', '2022-11-23', 0, '194', '1', '720', '0', '60.00', 1, '0.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241915, 15, 203, '2021-11-23', 'demo', '2022-10-23', '2022-11-23', 0, '194', '1', '720', '0', '60.00', 1, '0.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241916, 15, 203, '2021-11-23', 'demo', '2022-09-23', '2022-11-23', 0, '194', '1', '720', '0', '60.00', 0, '0.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241917, 15, 203, '2021-11-23', 'demo', '2022-08-23', '2022-11-23', 0, '194', '1', '720', '0', '60.00', 0, '0.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241918, 15, 203, '2021-11-23', 'demo', '2022-07-23', '2022-11-23', 0, '194', '1', '720', '0', '60.00', 0, '0.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241919, 15, 203, '2021-11-23', 'demo', '2022-06-23', '2022-11-23', 0, '194', '1', '720', '0', '60.00', 0, '0.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241920, 15, 203, '2021-11-23', 'demo', '2022-05-23', '2022-11-23', 0, '194', '1', '720', '0', '60.00', 0, '0.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241921, 15, 203, '2021-11-23', 'demo', '2022-04-23', '2022-11-23', 0, '194', '1', '720', '0', '60.00', 0, '0.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241922, 15, 203, '2021-11-23', 'demo', '2022-03-23', '2022-11-23', 0, '194', '1', '720', '0', '60.00', 0, '0.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241923, 15, 203, '2021-11-23', 'demo', '2022-02-23', '2022-11-23', 0, '194', '1', '720', '0', '60.00', 0, '0.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241924, 15, 203, '2021-11-23', 'demo', '2022-01-23', '2022-11-23', 0, '194', '1', '720', '0', '60.00', 0, '0.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241925, 15, 203, '2021-11-23', 'demo', '2021-12-23', '2022-11-23', 0, '194', '1', '720', '0', '60.00', 0, '0.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241926, 15, 203, '2021-11-23', 'demo', '2021-11-23', '2022-11-23', 1, '194', '1', '720', '0', '60.00', 0, '0.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241927, 16, 205, '2021-11-23', 'demo', '2022-11-23', '2022-11-23', 0, '196', '1', '120', '0', '10.00', 1, '0.00', '0', '0', 0, '0', '120.00', 0, NULL, NULL),
(241928, 16, 205, '2021-11-23', 'demo', '2022-10-23', '2022-11-23', 0, '196', '1', '120', '0', '10.00', 1, '0.00', '0', '0', 0, '0', '120.00', 0, NULL, NULL),
(241929, 16, 205, '2021-11-23', 'demo', '2022-09-23', '2022-11-23', 0, '196', '1', '120', '0', '10.00', 1, '0.00', '0', '0', 0, '0', '120.00', 0, 'demo', NULL),
(241930, 16, 205, '2021-11-23', 'demo', '2022-08-23', '2022-11-23', 0, '196', '1', '120', '0', '10.00', 0, '0.00', '0', '0', 0, '0', '120.00', 0, NULL, NULL),
(241931, 16, 205, '2021-11-23', 'demo', '2022-07-23', '2022-11-23', 0, '196', '1', '120', '0', '10.00', 0, '0.00', '0', '0', 0, '0', '120.00', 0, NULL, NULL),
(241932, 16, 205, '2021-11-23', 'demo', '2022-06-23', '2022-11-23', 0, '196', '1', '120', '0', '10.00', 0, '0.00', '0', '0', 0, '0', '120.00', 0, NULL, NULL),
(241933, 16, 205, '2021-11-23', 'demo', '2022-05-23', '2022-11-23', 0, '196', '1', '120', '0', '10.00', 0, '0.00', '0', '0', 0, '0', '120.00', 0, NULL, NULL),
(241934, 16, 205, '2021-11-23', 'demo', '2022-04-23', '2022-11-23', 0, '196', '1', '120', '0', '10.00', 0, '0.00', '0', '0', 0, '0', '120.00', 0, NULL, NULL),
(241935, 16, 205, '2021-11-23', 'demo', '2022-03-23', '2022-11-23', 0, '196', '1', '120', '0', '10.00', 0, '0.00', '0', '0', 0, '0', '120.00', 0, NULL, NULL),
(241936, 16, 205, '2021-11-23', 'demo', '2022-02-23', '2022-11-23', 0, '196', '1', '120', '0', '10.00', 0, '0.00', '0', '0', 0, '0', '120.00', 0, NULL, NULL),
(241937, 16, 205, '2021-11-23', 'demo', '2022-01-23', '2022-11-23', 0, '196', '1', '120', '0', '10.00', 0, '0.00', '0', '0', 0, '0', '120.00', 0, NULL, NULL),
(241938, 16, 205, '2021-11-23', 'demo', '2021-12-23', '2022-11-23', 0, '196', '1', '120', '0', '10.00', 0, '0.00', '0', '0', 0, '0', '120.00', 0, NULL, NULL),
(241939, 16, 205, '2021-11-23', 'demo', '2021-11-23', '2022-11-23', 1, '196', '1', '120', '0', '10.00', 0, '0.00', '0', '0', 0, '0', '120.00', 0, NULL, NULL),
(241940, 18, 201, '2021-11-23', 'demo', '2022-11-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '600.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241941, 18, 201, '2021-11-23', 'demo', '2022-10-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '600.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241942, 18, 201, '2021-11-23', 'demo', '2022-09-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '600.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241943, 18, 201, '2021-11-23', 'demo', '2022-08-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '600.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241944, 18, 201, '2021-11-23', 'demo', '2022-07-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '600.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241945, 18, 201, '2021-11-23', 'demo', '2022-06-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '600.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241946, 18, 201, '2021-11-23', 'demo', '2022-05-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '600.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241947, 18, 201, '2021-11-23', 'demo', '2022-04-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '600.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241948, 18, 201, '2021-11-23', 'demo', '2022-03-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '600.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241949, 18, 201, '2021-11-23', 'demo', '2022-02-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '600.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241950, 18, 201, '2021-11-23', 'demo', '2022-01-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '600.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241951, 18, 201, '2021-11-23', 'demo', '2021-12-23', '2022-11-23', 0, '192', '1', '3600', '0', '300.00', 0, '600.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241952, 18, 201, '2021-11-23', 'demo', '2021-11-23', '2022-11-23', 1, '192', '1', '3600', '0', '300.00', 0, '600.00', '0', '0', 0, '0', '3600.00', 0, NULL, NULL),
(241953, 14, 229, '2021-11-24', 'demo', '2022-11-24', '2022-11-24', 0, '221', '1', '1440', '0', '120.00', 1, '0.00', '0', '0', 0, '0', '1440.00', 0, NULL, NULL),
(241954, 14, 229, '2021-11-24', 'demo', '2022-10-24', '2022-11-24', 0, '221', '1', '1440', '0', '120.00', 1, '0.00', '0', '0', 0, '0', '1440.00', 0, NULL, NULL),
(241955, 14, 229, '2021-11-24', 'demo', '2022-09-24', '2022-11-24', 1, '221', '1', '1440', '0', '120.00', 0, '0.00', '0', '0', 0, '0', '1440.00', 0, NULL, NULL),
(241956, 14, 229, '2021-11-24', 'demo', '2022-08-24', '2022-11-24', 0, '221', '1', '1440', '0', '120.00', 0, '0.00', '0', '0', 0, '0', '1440.00', 0, NULL, NULL),
(241957, 14, 229, '2021-11-24', 'demo', '2022-07-24', '2022-11-24', 0, '221', '1', '1440', '0', '120.00', 0, '0.00', '0', '0', 0, '0', '1440.00', 0, NULL, NULL),
(241958, 14, 229, '2021-11-24', 'demo', '2022-06-24', '2022-11-24', 0, '221', '1', '1440', '0', '120.00', 0, '0.00', '0', '0', 0, '0', '1440.00', 0, NULL, NULL),
(241959, 14, 229, '2021-11-24', 'demo', '2022-05-24', '2022-11-24', 0, '221', '1', '1440', '0', '120.00', 0, '0.00', '0', '0', 0, '0', '1440.00', 0, NULL, NULL),
(241960, 14, 229, '2021-11-24', 'demo', '2022-04-24', '2022-11-24', 0, '221', '1', '1440', '0', '120.00', 0, '0.00', '0', '0', 0, '0', '1440.00', 0, NULL, NULL),
(241961, 14, 229, '2021-11-24', 'demo', '2022-03-24', '2022-11-24', 0, '221', '1', '1440', '0', '120.00', 0, '0.00', '0', '0', 0, '0', '1440.00', 0, NULL, NULL),
(241962, 14, 229, '2021-11-24', 'demo', '2022-02-24', '2022-11-24', 0, '221', '1', '1440', '0', '120.00', 0, '0.00', '0', '0', 0, '0', '1440.00', 0, NULL, NULL),
(241963, 14, 229, '2021-11-24', 'demo', '2022-01-24', '2022-11-24', 0, '221', '1', '1440', '0', '120.00', 0, '0.00', '0', '0', 0, '0', '1440.00', 0, NULL, NULL),
(241964, 14, 229, '2021-11-24', 'demo', '2021-12-24', '2022-11-24', 0, '221', '1', '1440', '0', '120.00', 0, '0.00', '0', '0', 0, '0', '1440.00', 0, NULL, NULL),
(241966, 14, 203, '2021-12-03', 'demo', '2022-12-03', '2022-12-03', 0, '194', '1', '720', '0', '60.00', 0, '150.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241967, 14, 203, '2021-12-03', 'demo', '2022-11-03', '2022-12-03', 0, '194', '1', '720', '0', '60.00', 0, '150.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241968, 14, 203, '2021-12-03', 'demo', '2022-10-03', '2022-12-03', 0, '194', '1', '720', '0', '60.00', 0, '150.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241969, 14, 203, '2021-12-03', 'demo', '2022-09-03', '2022-12-03', 0, '194', '1', '720', '0', '60.00', 0, '150.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241970, 14, 203, '2021-12-03', 'demo', '2022-08-03', '2022-12-03', 0, '194', '1', '720', '0', '60.00', 0, '150.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241971, 14, 203, '2021-12-03', 'demo', '2022-07-03', '2022-12-03', 0, '194', '1', '720', '0', '60.00', 0, '150.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241972, 14, 203, '2021-12-03', 'demo', '2022-06-03', '2022-12-03', 0, '194', '1', '720', '0', '60.00', 0, '150.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241973, 14, 203, '2021-12-03', 'demo', '2022-05-03', '2022-12-03', 0, '194', '1', '720', '0', '60.00', 0, '150.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241974, 14, 203, '2021-12-03', 'demo', '2022-04-03', '2022-12-03', 0, '194', '1', '720', '0', '60.00', 0, '150.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241975, 14, 203, '2021-12-03', 'demo', '2022-03-03', '2022-12-03', 0, '194', '1', '720', '0', '60.00', 0, '150.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241976, 14, 203, '2021-12-03', 'demo', '2022-02-03', '2022-12-03', 0, '194', '1', '720', '0', '60.00', 0, '150.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241977, 14, 203, '2021-12-03', 'demo', '2022-01-03', '2022-12-03', 0, '194', '1', '720', '0', '60.00', 0, '150.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL),
(241978, 14, 203, '2021-12-03', 'demo', '2021-12-03', '2022-12-03', 1, '194', '1', '720', '0', '60.00', 0, '150.00', '0', '0', 0, '0', '720.00', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room`
--

CREATE TABLE `tbl_room` (
  `id` int(11) NOT NULL,
  `room_no` varchar(45) DEFAULT NULL,
  `type_id` int(45) DEFAULT NULL,
  `floor` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_room`
--

INSERT INTO `tbl_room` (`id`, `room_no`, `type_id`, `floor`, `status`) VALUES
(201, '1', 65, 'Ground Floor', 0),
(202, '2', 66, 'Ground Floor', 0),
(203, '3', 67, 'Ground Floor', 0),
(204, '4', 93, 'Ground Floor', 1),
(205, '5', 69, 'Ground Floor', 1),
(206, '6', 70, 'Ground Floor', 0),
(207, '7', 71, 'Ground Floor', 0),
(208, '8', 72, 'Ground Floor', 0),
(209, '9', 73, 'Ground Floor', 0),
(210, '10', 74, 'Ground Floor', 0),
(211, '11', 75, 'Ground Floor', 0),
(212, '12', 76, 'Ground Floor', 0),
(213, '13', 77, 'Ground Floor', 0),
(214, '14', 78, 'Ground Floor', 0),
(215, '15', 79, 'Ground Floor', 0),
(216, '16', 80, 'Ground Floor', 0),
(217, '17', 81, 'Ground Floor', 0),
(218, '18', 82, 'Ground Floor', 0),
(219, '19', 83, 'Ground Floor', 0),
(220, '20', 84, 'Ground Floor', 0),
(221, '21', 85, 'Ground Floor', 0),
(222, '22', 86, 'Ground Floor', 0),
(223, '23', 87, 'Ground Floor', 0),
(224, '24', 88, 'Ground Floor', 0),
(225, '25', 89, 'Ground Floor', 0),
(226, '26', 90, 'Ground Floor', 0),
(227, '27', 91, 'Ground Floor', 0),
(228, '31', 94, 'Ground Floor', 0),
(229, '101', 96, 'First Floor', 0),
(230, 'R-0002', 89, 'Second Floor', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roomtype`
--

CREATE TABLE `tbl_roomtype` (
  `id` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `adult` int(11) NOT NULL,
  `child` int(11) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_roomtype`
--

INSERT INTO `tbl_roomtype` (`id`, `type`, `price`, `adult`, `child`, `note`) VALUES
(65, '1D', 0, 2, 2, ''),
(66, '3G', 0, 2, 2, ''),
(67, 'មជ E1 01', 0, 2, 2, ''),
(69, 'មជ E1 03', 0, 2, 2, ''),
(70, 'មជ​​ E2 01', 0, 2, 2, ''),
(71, 'មជ E2 02', 0, 2, 2, ''),
(72, 'មជ E2 03', 0, 2, 2, ''),
(73, 'មជ E3 01', 0, 2, 2, ''),
(74, 'មជ E3 02', 0, 2, 2, ''),
(75, 'មជ E3 03', 0, 2, 2, ''),
(76, 'មជ E4 02', 0, 2, 2, ''),
(77, 'មជ E4 03', 0, 0, 0, ''),
(78, 'មជ E4 05', 0, 2, 2, ''),
(79, 'មជ E4 07 ', 0, 2, 2, ''),
(80, 'មជ E4 08', 0, 2, 2, ''),
(81, '22 Eo 01', 0, 2, 2, ''),
(82, '22 Eo 03', 0, 2, 2, ''),
(83, '22 E1 01', 0, 2, 2, ''),
(84, '22 E1 02', 0, 0, 0, ''),
(85, '22 E2 01', 0, 2, 2, ''),
(86, '22 E2 02', 0, 0, 0, ''),
(87, '22 E2 03', 0, 0, 0, ''),
(88, '22 E3 01', 0, 0, 0, ''),
(89, '22 E3 02', 0, 0, 0, ''),
(90, '22 E3 05', 0, 0, 0, ''),
(91, '22 E4 01', 0, 0, 0, ''),
(93, 'មជ E1 02', 0, 0, 0, ''),
(94, 'BE0 01', 0, 0, 0, ''),
(95, 'BE0 02', 0, 0, 0, ''),
(96, 'One Bed Room', 0, 2, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_checkindetail`
--

CREATE TABLE `tbl_room_checkindetail` (
  `id` int(11) NOT NULL,
  `checkin_id` int(11) DEFAULT NULL,
  `room_num` int(11) DEFAULT NULL,
  `room_price` decimal(45,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_history`
--

CREATE TABLE `tbl_room_history` (
  `id` int(11) NOT NULL COMMENT '	',
  `checkout_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `datein` varchar(45) DEFAULT NULL,
  `dateout` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staying`
--

CREATE TABLE `tbl_staying` (
  `id` int(11) NOT NULL,
  `roomtype_id` int(11) NOT NULL,
  `time` varchar(100) NOT NULL,
  `price` float(11,2) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `price_weekend` float(42,2) DEFAULT NULL,
  `price_cereymony` float(22,2) DEFAULT NULL,
  `price_month` float(42,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_staying`
--

INSERT INTO `tbl_staying` (`id`, `roomtype_id`, `time`, `price`, `note`, `price_weekend`, `price_cereymony`, `price_month`) VALUES
(192, 65, 'Month', 0.00, '', 0.00, 0.00, 300.00),
(193, 66, 'Month', 0.00, '', 0.00, 0.00, 210.00),
(194, 67, 'Month', 0.00, '', 0.00, 0.00, 60.00),
(195, 93, 'Month', 0.00, '', 0.00, 0.00, 50.00),
(196, 69, 'Month', 0.00, '', 0.00, 0.00, 10.00),
(197, 70, 'Month', 0.00, '', 0.00, 0.00, 80.00),
(198, 71, 'Month', 0.00, '', 0.00, 0.00, 60.00),
(199, 72, 'Month', 0.00, '', 0.00, 0.00, 70.00),
(200, 73, 'Month', 0.00, '', 0.00, 0.00, 75.00),
(201, 74, 'Month', 0.00, '', 0.00, 0.00, 60.00),
(202, 75, 'Month', 0.00, '', 0.00, 0.00, 70.00),
(203, 76, 'Month', 0.00, '', 0.00, 0.00, 40.00),
(204, 77, 'Month', 0.00, '', 0.00, 0.00, 40.00),
(205, 78, 'Month', 0.00, '', 0.00, 0.00, 35.00),
(206, 79, 'Month', 0.00, '', 0.00, 0.00, 35.00),
(207, 80, 'Month', 0.00, '', 0.00, 0.00, 35.00),
(208, 81, 'Month', 0.00, '', 0.00, 0.00, 150.00),
(209, 82, 'Month', 0.00, '', 0.00, 0.00, 80.00),
(210, 83, 'Month', 0.00, '', 0.00, 0.00, 60.00),
(211, 84, 'Month', 0.00, '', 0.00, 0.00, 70.00),
(212, 85, 'Month', 0.00, '', 0.00, 0.00, 60.00),
(213, 86, 'Month', 0.00, '', 0.00, 0.00, 55.00),
(214, 87, 'Month', 0.00, '', 0.00, 0.00, 50.00),
(215, 88, 'Month', 0.00, '', 0.00, 0.00, 45.00),
(216, 89, 'Month', 0.00, '', 0.00, 0.00, 45.00),
(217, 90, 'Month', 0.00, '', 0.00, 0.00, 80.00),
(218, 91, 'Month', 0.00, '', 0.00, 0.00, 50.00),
(219, 94, 'Month', 0.00, '', 0.00, 0.00, 50.00),
(220, 95, 'Month', 0.00, '', 0.00, 0.00, 60.00),
(221, 96, 'Month', 0.00, '', 0.00, 0.00, 120.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_cookies`
--
ALTER TABLE `ci_cookies`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`) USING BTREE,
  ADD KEY `last_activity_idx` (`last_activity`) USING BTREE;

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sch_z_module`
--
ALTER TABLE `sch_z_module`
  ADD PRIMARY KEY (`moduleid`);

--
-- Indexes for table `sch_z_page`
--
ALTER TABLE `sch_z_page`
  ADD PRIMARY KEY (`pageid`);

--
-- Indexes for table `sch_z_page_route`
--
ALTER TABLE `sch_z_page_route`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sch_z_page_route_action`
--
ALTER TABLE `sch_z_page_route_action`
  ADD PRIMARY KEY (`role_actionid`) USING BTREE;

--
-- Indexes for table `sch_z_role`
--
ALTER TABLE `sch_z_role`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `sch_z_role_module_detail`
--
ALTER TABLE `sch_z_role_module_detail`
  ADD PRIMARY KEY (`mod_rol_id`);

--
-- Indexes for table `sch_z_role_page`
--
ALTER TABLE `sch_z_role_page`
  ADD PRIMARY KEY (`role_page_id`);

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_charges`
--
ALTER TABLE `tbl_charges`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_checkin`
--
ALTER TABLE `tbl_checkin`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Indexes for table `tbl_checkin_detail`
--
ALTER TABLE `tbl_checkin_detail`
  ADD PRIMARY KEY (`detail_id`) USING BTREE;

--
-- Indexes for table `tbl_checkoutcharg`
--
ALTER TABLE `tbl_checkoutcharg`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_currencies`
--
ALTER TABLE `tbl_currencies`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_expense`
--
ALTER TABLE `tbl_expense`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_expense_type`
--
ALTER TABLE `tbl_expense_type`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_fund`
--
ALTER TABLE `tbl_fund`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_holiday`
--
ALTER TABLE `tbl_holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_hotelprofile`
--
ALTER TABLE `tbl_hotelprofile`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`pid`) USING BTREE;

--
-- Indexes for table `tbl_login_history`
--
ALTER TABLE `tbl_login_history`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_multireservation`
--
ALTER TABLE `tbl_multireservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_othercharges`
--
ALTER TABLE `tbl_othercharges`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment_card`
--
ALTER TABLE `tbl_payment_card`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_payment_cash`
--
ALTER TABLE `tbl_payment_cash`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_payment_cheque`
--
ALTER TABLE `tbl_payment_cheque`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_payment_detail`
--
ALTER TABLE `tbl_payment_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_room`
--
ALTER TABLE `tbl_room`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Indexes for table `tbl_roomtype`
--
ALTER TABLE `tbl_roomtype`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_room_checkindetail`
--
ALTER TABLE `tbl_room_checkindetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_room_history`
--
ALTER TABLE `tbl_room_history`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_staying`
--
ALTER TABLE `tbl_staying`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ci_cookies`
--
ALTER TABLE `ci_cookies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sch_z_module`
--
ALTER TABLE `sch_z_module`
  MODIFY `moduleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sch_z_page`
--
ALTER TABLE `sch_z_page`
  MODIFY `pageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `sch_z_page_route`
--
ALTER TABLE `sch_z_page_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `sch_z_page_route_action`
--
ALTER TABLE `sch_z_page_route_action`
  MODIFY `role_actionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=808;

--
-- AUTO_INCREMENT for table `sch_z_role`
--
ALTER TABLE `sch_z_role`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `sch_z_role_module_detail`
--
ALTER TABLE `sch_z_role_module_detail`
  MODIFY `mod_rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=541;

--
-- AUTO_INCREMENT for table `sch_z_role_page`
--
ALTER TABLE `sch_z_role_page`
  MODIFY `role_page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=402;

--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_charges`
--
ALTER TABLE `tbl_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_checkin`
--
ALTER TABLE `tbl_checkin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `tbl_checkin_detail`
--
ALTER TABLE `tbl_checkin_detail`
  MODIFY `detail_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `tbl_checkoutcharg`
--
ALTER TABLE `tbl_checkoutcharg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_currencies`
--
ALTER TABLE `tbl_currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_expense`
--
ALTER TABLE `tbl_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_expense_type`
--
ALTER TABLE `tbl_expense_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_fund`
--
ALTER TABLE `tbl_fund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_holiday`
--
ALTER TABLE `tbl_holiday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_login_history`
--
ALTER TABLE `tbl_login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_multireservation`
--
ALTER TABLE `tbl_multireservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_othercharges`
--
ALTER TABLE `tbl_othercharges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1314;

--
-- AUTO_INCREMENT for table `tbl_payment_card`
--
ALTER TABLE `tbl_payment_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment_cash`
--
ALTER TABLE `tbl_payment_cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment_cheque`
--
ALTER TABLE `tbl_payment_cheque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment_detail`
--
ALTER TABLE `tbl_payment_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2636;

--
-- AUTO_INCREMENT for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241979;

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT for table `tbl_roomtype`
--
ALTER TABLE `tbl_roomtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `tbl_room_checkindetail`
--
ALTER TABLE `tbl_room_checkindetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_room_history`
--
ALTER TABLE `tbl_room_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '	';

--
-- AUTO_INCREMENT for table `tbl_staying`
--
ALTER TABLE `tbl_staying`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
