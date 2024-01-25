-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2023 at 07:00 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devaraso_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `admin_users_id` int(11) NOT NULL,
  `admin_users_unique_id` varchar(50) NOT NULL,
  `admin_users_title` varchar(50) NOT NULL,
  `admin_users_user_name` varchar(50) NOT NULL,
  `admin_users_password` varchar(50) NOT NULL,
  `admin_users_pass` varchar(30) NOT NULL,
  `admin_users_level` varchar(20) NOT NULL,
  `admin_users_accessibilities` text NOT NULL,
  `admin_users_branch_id` int(11) NOT NULL,
  `admin_users_employee_id` int(11) NOT NULL,
  `admin_users_company_id` int(11) NOT NULL,
  `admin_users_face_register_status` int(11) NOT NULL,
  `admin_users_face_scan_status` int(11) NOT NULL,
  `admin_users_face_data` longtext NOT NULL,
  `admin_users_image` text NOT NULL,
  `admin_users_added_by` int(11) NOT NULL,
  `admin_users_added_on` int(11) NOT NULL,
  `admin_users_added_ip` varchar(20) NOT NULL,
  `admin_users_modified_by` int(11) NOT NULL,
  `admin_users_modified_on` int(11) NOT NULL,
  `admin_users_modified_ip` varchar(20) NOT NULL,
  `admin_users_deleted_by` int(11) NOT NULL,
  `admin_users_deleted_on` int(11) NOT NULL,
  `admin_users_deleted_ip` varchar(20) NOT NULL,
  `admin_users_active_status` varchar(10) NOT NULL DEFAULT 'active',
  `admin_users_delete_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_users_id`, `admin_users_unique_id`, `admin_users_title`, `admin_users_user_name`, `admin_users_password`, `admin_users_pass`, `admin_users_level`, `admin_users_accessibilities`, `admin_users_branch_id`, `admin_users_employee_id`, `admin_users_company_id`, `admin_users_face_register_status`, `admin_users_face_scan_status`, `admin_users_face_data`, `admin_users_image`, `admin_users_added_by`, `admin_users_added_on`, `admin_users_added_ip`, `admin_users_modified_by`, `admin_users_modified_on`, `admin_users_modified_ip`, `admin_users_deleted_by`, `admin_users_deleted_on`, `admin_users_deleted_ip`, `admin_users_active_status`, `admin_users_delete_status`) VALUES
(1, 'b7642c6b42b5cbs99dpd4f5d51fad3414549ce64', 'Ara', 'admin', '99c5e07b4d5de9d18c350cdf64c5aa3d', '567', 'admin', 'all', 0, 0, 0, 0, 0, '', '../assets/images/profile/2023/July/120230707092923.jpg', 0, 0, '', 1, 0, '', 0, 0, '', 'active', 0),
(2, '3a4626e066aee6okd098fe783e600fb50a838bbe', 'arasoftwares', 'ARA001', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'Admin123', 'company', '', 0, 0, 1, 0, 0, '', '', 1, 1686143376, '::1', 1, 0, '::1', 0, 0, '', 'active', 0),
(3, 'eeb2ca4cm9b6f8zorlz481c00919f4923590474c', 'Tiruvannamalai', 'ARARARAR5133', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'Admin123', 'branch', '', 1, 0, 1, 0, 0, '', '../src/assets/images/profile2023/June/320230628184511.png', 1, 1686143741, '::1', 1, 0, '::1', 0, 0, '', 'active', 0),
(4, 'bee4abch0415b9xthmide97452b5428bff5cfefb', 'Rajesh', '6554654645', '0314ee502c6f4e284128ad14e84e37d5', 'emp123', 'employee', '', 1, 1, 1, 0, 0, '', '', 1, 1686369382, '::1', 1, 1688644881, '::1', 0, 0, '', 'active', 0),
(5, '2815e17cfr2030yyht32a35e3ca5b9f8b7e93231', 'Rajesh', '6554654645', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'Admin123', 'branch', '', 1, 1, 1, 0, 0, '', '', 3, 1686410377, '::1', 1, 1688644881, '::1', 0, 0, '', 'active', 0),
(6, '3b35cfeqpfe86efuu4bcfa385689ddd6a32843e6', 'khvhjhj', 'ARAR876', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'Admin123', 'branch', '', 3, 2, 1, 0, 0, '', '', 1, 1686419095, '::1', 1, 0, '::1', 0, 0, '', 'active', 0),
(7, 'b85b8503v71bb05vncpb941dfd585acd95fbe9a8', 'arasoftwares', 'INF001', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'Admin123', 'company', '', 0, 0, 1, 0, 0, '', '', 1, 1686467404, '::1', 1, 0, '::1', 0, 0, '', 'active', 0),
(8, '1e469d64sd64ffsr8oa2fdc131f291fab779f0ae', 'sad', 'INSACDS', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'Admin123', 'branch', '', 5, 0, 2, 0, 0, '', '', 6, 1686477313, '::1', 0, 0, '', 0, 0, '', 'active', 0),
(9, '434370297r1762iq9y8d6eab76060feea4ef33b5', 'rajeshdurai', 'ARTI5144', '0314ee502c6f4e284128ad14e84e37d5', 'emp123', 'employee', '', 1, 2, 1, 0, 0, '', '', 1, 1686483085, '::1', 0, 0, '', 0, 0, '', 'active', 0),
(10, '82fd81apo1e070aef57541957b75dd04552d3cba', 'durai', 'ARA0015133', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'Admin123', 'branch', '', 6, 0, 1, 0, 0, '', '', 1, 1686553751, '::1', 0, 0, '', 0, 0, '', 'active', 0),
(11, '5e2fc7ayudf8062m4fma7958c758fc5cae1ec55b', 'rajeshD', '6798769876', '0314ee502c6f4e284128ad14e84e37d5', 'emp123', 'employee', '', 2, 3, 1, 0, 0, '', '', 1, 1687249529, '::1', 0, 0, '', 0, 0, '', 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_detail`
--

CREATE TABLE `attendance_detail` (
  `attendance_detail_id` int(11) NOT NULL,
  `attendance_detail_uniq_id` varchar(255) NOT NULL,
  `attendance_detail_emp_id` int(11) NOT NULL,
  `attendance_detail_emp_device_id` varchar(50) NOT NULL,
  `attendance_detail_date` date NOT NULL,
  `attendance_detail_time` time NOT NULL,
  `attendance_detail_check_status` text NOT NULL,
  `attendance_detail_datetime` datetime NOT NULL,
  `attendance_detail_device_ip` varchar(100) NOT NULL,
  `attendance_detail_device_id` int(11) NOT NULL,
  `attendance_detail_lat` varchar(25) NOT NULL,
  `attendance_detail_long` varchar(25) NOT NULL,
  `attendance_detail_source` varchar(20) NOT NULL,
  `attendance_detail_in_out_status` varchar(10) NOT NULL,
  `attendance_detail_location` varchar(255) NOT NULL,
  `attendance_detail_company_id` int(11) NOT NULL,
  `attendance_detail_branch_id` int(11) NOT NULL,
  `attendance_detail_added_by` int(11) NOT NULL,
  `attendance_detail_added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `attendance_detail_deleted_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_detail`
--

INSERT INTO `attendance_detail` (`attendance_detail_id`, `attendance_detail_uniq_id`, `attendance_detail_emp_id`, `attendance_detail_emp_device_id`, `attendance_detail_date`, `attendance_detail_time`, `attendance_detail_check_status`, `attendance_detail_datetime`, `attendance_detail_device_ip`, `attendance_detail_device_id`, `attendance_detail_lat`, `attendance_detail_long`, `attendance_detail_source`, `attendance_detail_in_out_status`, `attendance_detail_location`, `attendance_detail_company_id`, `attendance_detail_branch_id`, `attendance_detail_added_by`, `attendance_detail_added_on`, `attendance_detail_deleted_status`) VALUES
(1, 'xnmbccbvmb,fdjghlkfjhflkhjhjghl;ghfgj', 155, '', '2023-03-25', '17:40:00', '', '2023-03-25 17:40:00', '', 0, '11.782548', '79.5538425', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 218, '2023-03-25 11:28:17', 1),
(2, 'fhdglkdlkhjhlfjgkhkhkhkjhj', 155, '', '2023-03-25', '10:40:00', '', '2023-03-25 10:40:00', '', 0, '11.782548', '79.5538425', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 218, '2023-03-25 11:28:43', 1),
(3, 'fdgfdhfgjhkhjkytuitiyuuyouoiuoiouioiioyu', 156, '', '2023-03-25', '10:10:00', '', '2023-03-25 10:10:00', '', 0, '11.782548', '79.5538425', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 218, '2023-03-25 11:29:09', 1),
(4, 'fdgfdhfgjhkhjkytuitiyuuyouoiuoiouioiioygfdhfghfgj', 157, '', '2023-03-25', '10:10:00', '', '2023-03-25 10:10:00', '', 0, '11.782548', '79.5538425', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 218, '2023-03-25 11:29:24', 1),
(5, 'fdfgdggfdgdfghfdhfdhdhfdhfdhfddhfdhd', 158, '', '1970-01-01', '05:30:00', '', '1970-01-01 05:30:00', '', 0, '11.782548', '79.5538425', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 218, '2023-03-25 11:29:38', 1),
(6, 'fdfgdggfdgdfghfdhfdhdhfdhfdhhfhfgjgfjfddhfdhd', 158, '', '2023-03-25', '18:10:00', '', '2023-03-25 18:10:00', '', 0, '11.782548', '79.5538425', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 218, '2023-03-25 11:29:58', 1),
(7, 'fdfgdggfdgdfghfdhfhfgjgfjfjgfjhgjkk', 156, '', '2023-03-25', '19:30:00', '', '2023-03-25 19:30:00', '', 0, '11.782548', '79.5538425', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 218, '2023-03-25 11:30:26', 1),
(8, '30ff2072-3480-4128-b39e-e5ab94f8acc8', 164, '', '2023-04-06', '10:40:00', '', '2023-04-06 10:40:00', '', 0, '11.7825593', '79.5538417', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 05:13:00', 1),
(9, '41fe5619-7a58-470c-bc75-911bb30283e7', 167, '', '2023-04-06', '11:17:00', '', '2023-04-06 11:17:00', '', 0, '11.7825593', '79.5538395', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 05:47:57', 1),
(10, '9a340f13-71de-4368-94cf-6ad26eabe373', 164, '', '2023-04-06', '11:24:00', '', '2023-04-06 11:24:00', '', 0, '11.7824769', '79.5537777', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-06 05:59:31', 1),
(11, '2620edbf-673c-46f0-8694-3cef69aad7d5', 163, '', '2023-04-06', '11:24:00', '', '2023-04-06 11:24:00', '', 0, '11.7823075', '79.5536406', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-06 05:59:38', 1),
(12, '3fc1b001-8b00-4790-8feb-a74c7cac8d4d', 163, '', '2023-04-06', '11:24:00', '', '2023-04-06 11:24:00', '', 0, '11.7823075', '79.5536406', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 05:59:40', 1),
(13, '3bcb5716-04eb-4b65-89a1-2f259f5c7b94', 164, '', '2023-04-06', '11:31:00', '', '2023-04-06 11:31:00', '', 0, '11.7825619', '79.5538421', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 06:02:05', 1),
(14, '1042c61c-d711-4b6d-b3e0-35de3a401e79', 163, '', '2023-04-06', '11:31:00', '', '2023-04-06 11:31:00', '', 0, '11.7825619', '79.5538421', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 06:02:10', 1),
(15, 'ecef2a4c-63fd-4603-b46d-6fc6ecfa51a6', 164, '', '2023-04-06', '11:31:00', '', '2023-04-06 11:31:00', '', 0, '11.7825565', '79.5538376', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 06:02:30', 1),
(16, '8c0aa02a-77b4-4a3c-84e8-f68261451d90', 163, '', '2023-04-06', '11:31:00', '', '2023-04-06 11:31:00', '', 0, '11.782556', '79.5538371', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 06:17:04', 1),
(17, '92420730-b312-46b9-8dcc-f31420a10d61', 163, '', '2023-04-06', '11:31:00', '', '2023-04-06 11:31:00', '', 0, '11.782556', '79.5538371', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 06:17:08', 1),
(18, 'fbc14da7-5dea-4850-a0ab-a67166f30783', 169, '', '2023-04-06', '12:07:00', '', '2023-04-06 12:07:00', '', 0, '11.782551', '79.5538326', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 06:37:55', 1),
(19, '9734080d-639d-460f-862a-c2360b3af69b', 163, '', '2023-04-06', '14:15:00', '', '2023-04-06 14:15:00', '', 0, '11.782558', '79.5538428', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 08:56:35', 1),
(20, '8f0be2c9-7d7d-4bf2-8f3b-825721e7e541', 163, '', '2023-04-06', '14:15:00', '', '2023-04-06 14:15:00', '', 0, '11.782558', '79.5538428', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 08:56:38', 1),
(21, '619fb96b-cf3b-4bde-802a-3fbc1709475d', 167, '', '2023-04-06', '14:15:00', '', '2023-04-06 14:15:00', '', 0, '11.782558', '79.5538428', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 08:56:52', 1),
(22, '612c4d82-b5db-4bab-81ce-ac58be6cb0ce', 163, '', '2023-04-06', '14:15:00', '', '2023-04-06 14:15:00', '', 0, '11.7825591', '79.5538454', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 08:56:58', 1),
(23, '9e01901f-85b6-47c8-9292-37748c107c89', 169, '', '2023-04-06', '14:15:00', '', '2023-04-06 14:15:00', '', 0, '11.7825591', '79.5538454', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 08:57:03', 1),
(24, '0f5fce66-58fa-4fb2-83ef-28f15b478412', 169, '', '2023-04-06', '14:30:00', '', '2023-04-06 14:30:00', '', 0, '', '', 'app', '', '', 0, 0, 233, '2023-04-06 09:00:14', 1),
(25, 'be52b644-344b-4747-a1d2-5cb53c56d73b', 167, '', '2023-04-06', '14:30:00', '', '2023-04-06 14:30:00', '', 0, '11.7825664', '79.5538245', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 09:00:37', 1),
(26, 'a5034d52-3c72-4a19-afa3-82fe5a18a216', 164, '', '2023-04-06', '14:30:00', '', '2023-04-06 14:30:00', '', 0, '11.7825664', '79.5538245', 'app', '', 'QHM3+5JR, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 09:00:45', 1),
(27, 'ed7f6803-e34c-4eca-81b7-b069de6f5eba', 174, '', '2023-04-06', '14:34:00', '', '2023-04-06 14:34:00', '', 0, '', '', 'app', '', '', 0, 0, 233, '2023-04-06 09:04:37', 1),
(28, '1705f26f-dc11-44df-8035-909d976652e3', 174, '', '2023-04-06', '14:34:00', '', '2023-04-06 14:34:00', '', 0, '11.782563', '79.5538236', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 09:05:10', 1),
(29, '6a218304-6084-49b6-b6dc-a7e0aa28e31e', 174, '', '2023-04-06', '14:36:00', '', '2023-04-06 14:36:00', '', 0, '11.782563', '79.5538236', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 09:06:05', 1),
(30, '3f58ff0e-30d3-4fad-b0fd-6900e22db753', 174, '', '2023-04-06', '14:36:00', '', '2023-04-06 14:36:00', '', 0, '11.782563', '79.5538236', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 09:06:08', 1),
(31, 'b045ecf5-42b8-48bf-9a75-50636c77079a', 174, '', '2023-04-06', '14:36:00', '', '2023-04-06 14:36:00', '', 0, '11.782563', '79.5538236', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-06 09:06:12', 1),
(32, '43121ca7-27e1-4bb4-b538-18396c373515', 166, '', '2023-04-06', '17:51:00', '', '2023-04-06 17:51:00', '', 0, '', '', 'app', '', '', 0, 0, 233, '2023-04-06 12:21:30', 1),
(33, '5dd45d6c-e67e-4980-af01-a18d61190f5d', 166, '', '2023-04-06', '18:04:00', '', '2023-04-06 18:04:00', '', 0, '', '', 'app', '', '', 0, 0, 233, '2023-04-06 12:35:18', 1),
(34, 'cf426bdf-cf7c-46ed-9b63-0de41dd8811e', 166, '', '2023-04-06', '18:04:00', '', '2023-04-06 18:04:00', '', 0, '', '', 'app', '', '', 0, 0, 233, '2023-04-06 12:35:23', 1),
(35, '5a964241-1f4f-40dc-9de0-c2be93e5b6d6', 166, '', '2023-04-06', '18:04:00', '', '2023-04-06 18:04:00', '', 0, '', '', 'app', '', '', 0, 0, 233, '2023-04-06 12:35:30', 1),
(36, '12000a77-30a6-4b60-8452-f7b3c8ee51c5', 166, '', '2023-04-06', '18:04:00', '', '2023-04-06 18:04:00', '', 0, '11.5725655', '79.5548999', 'app', '', 'No 16, Kamalambal Nagar, Abatharanapuram, Vadalure, Tamil Nadu 607303, India', 0, 0, 233, '2023-04-06 12:35:41', 1),
(37, '40d87938-1132-4b24-a704-bc0f3c0edbec', 166, '', '2023-04-06', '18:04:00', '', '2023-04-06 18:04:00', '', 0, '11.5725655', '79.5548999', 'app', '', 'No 16, Kamalambal Nagar, Abatharanapuram, Vadalure, Tamil Nadu 607303, India', 0, 0, 233, '2023-04-06 12:35:50', 1),
(38, 'ce9b8806-30f6-4fa1-a411-6c51ee60e3ba', 166, '', '2023-04-06', '18:04:00', '', '2023-04-06 18:04:00', '', 0, '11.57173', '79.5608708', 'app', '', 'HHC6+J5H, Vadalur R.F., Tamil Nadu 607303, India', 0, 0, 233, '2023-04-06 12:36:03', 1),
(39, 'c58fa0a2-44e6-41f3-a05e-a0cbdcaa16e1', 169, '', '2023-04-07', '08:56:00', '', '2023-04-07 08:56:00', '', 0, '11.7825597', '79.5538409', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 03:26:35', 1),
(40, '2441f12c-f37f-400c-b1ec-0e67c084a960', 169, '', '2023-04-07', '09:35:00', '', '2023-04-07 09:35:00', '', 0, '11.7825617', '79.5538463', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 04:06:57', 1),
(41, '03485fc7-a371-47ff-ae3a-389ad03f8ff0', 169, '', '2023-04-07', '09:39:00', '', '2023-04-07 09:39:00', '', 0, '11.7825592', '79.5538459', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 04:09:30', 1),
(42, 'c09269db-5fb4-4fde-b720-d3d401f26dab', 169, '', '2023-04-07', '09:42:00', '', '2023-04-07 09:42:00', '', 0, '11.78256', '79.5538401', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 239, '2023-04-07 04:12:45', 1),
(43, '9c9bbdc3-4e0a-4b39-8dfc-c47ed8be8697', 174, '', '2023-04-07', '09:48:00', '', '2023-04-07 09:48:00', '', 0, '11.7825639', '79.5538238', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 04:18:54', 1),
(44, 'a9207ad4-0be5-455e-be28-29b107527616', 174, '', '2023-04-07', '09:49:00', '', '2023-04-07 09:49:00', '', 0, '11.7825663', '79.5538236', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 04:19:25', 1),
(45, '886e0032-68f0-4a4c-a7df-40396ad01781', 173, '', '2023-04-07', '09:49:00', '', '2023-04-07 09:49:00', '', 0, '11.7825663', '79.5538236', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 04:19:28', 1),
(46, '88c47e4e-c024-4da1-b24e-db2898390acf', 169, '', '2023-04-07', '09:56:00', '', '2023-04-07 09:56:00', '', 0, '11.78256', '79.5538401', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 238, '2023-04-07 04:27:04', 1),
(47, '1ddfc417-f743-4949-9fad-7db2d52cc646', 175, '', '2023-04-07', '09:57:00', '', '2023-04-07 09:57:00', '', 0, '11.7825183', '79.5538288', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 04:28:05', 1),
(48, '096659fb-5dca-4130-a68e-862094bd8744', 169, '', '2023-04-07', '09:57:00', '', '2023-04-07 09:57:00', '', 0, '11.7825591', '79.5538458', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 238, '2023-04-07 04:28:05', 1),
(49, '6ea6335c-0389-4626-bb29-455df76cff0c', 163, '', '2023-04-07', '09:57:00', '', '2023-04-07 09:57:00', '', 0, '11.7825183', '79.5538288', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 04:28:08', 1),
(50, '419fb3f3-13c9-461d-9494-b18ab2f8cfea', 163, '', '2023-04-07', '09:57:00', '', '2023-04-07 09:57:00', '', 0, '11.7825183', '79.5538288', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 04:28:19', 1),
(51, '1cc2a0e6-9b65-4817-adac-08087ee1e8d2', 163, '', '2023-04-07', '09:57:00', '', '2023-04-07 09:57:00', '', 0, '11.7825467', '79.5538441', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 04:28:23', 1),
(52, '80a347e9-ed95-4f7e-b61e-44283a600a6f', 174, '', '2023-04-07', '09:57:00', '', '2023-04-07 09:57:00', '', 0, '11.7825467', '79.5538441', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 04:28:36', 1),
(53, '81c8e189-f5a0-4326-b311-a90f1bf81f48', 173, '', '2023-04-07', '09:57:00', '', '2023-04-07 09:57:00', '', 0, '11.7825595', '79.553845', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 04:28:41', 1),
(54, '14ecc750-4e23-4798-bf98-08b732ad6106', 168, '', '2023-04-07', '09:57:00', '', '2023-04-07 09:57:00', '', 0, '11.7825593', '79.553846', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 04:28:48', 1),
(55, 'd4ba0fcf-26e1-4b9c-a8dd-7fc9c2e374c8', 170, '', '2023-04-07', '09:57:00', '', '2023-04-07 09:57:00', '', 0, '11.7825593', '79.553846', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 04:29:00', 1),
(56, '9cc2b2b4-44ef-4ce6-b5e8-b6e831addc73', 167, '', '2023-04-07', '09:57:00', '', '2023-04-07 09:57:00', '', 0, '11.7825576', '79.553838', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 04:29:06', 1),
(57, 'b67b53e3-ca45-475d-ac8c-137ce1d7e395', 169, '', '2023-04-07', '09:58:00', '', '2023-04-07 09:58:00', '', 0, '11.7825592', '79.5538459', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 238, '2023-04-07 04:31:51', 1),
(58, '82241457-9a95-4a0b-95b9-7ddbd689d82f', 169, '', '2023-04-07', '10:16:00', '', '2023-04-07 10:16:00', '', 0, '11.7825598', '79.5538463', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 238, '2023-04-07 04:46:56', 1),
(59, '1f0c572b-4b9e-4626-b9bb-79870035122b', 169, '', '2023-04-07', '16:58:00', '', '2023-04-07 16:58:00', '', 0, '11.782562', '79.5538459', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 11:29:52', 1),
(60, '451f54a9-9a99-4905-85ab-ad770e668cbf', 169, '', '2023-04-07', '17:10:00', '', '2023-04-07 17:10:00', '', 0, '11.7825609', '79.5538466', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 11:41:57', 1),
(61, 'b82bfc57-8c01-48b9-8c57-a103686770e0', 169, '', '2023-04-07', '17:12:00', '', '2023-04-07 17:12:00', '', 0, '11.7825609', '79.5538466', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 11:42:10', 1),
(62, 'c8b0abf6-fa17-4d6e-9499-72ddf8606992', 169, '', '2023-04-07', '17:23:00', '', '2023-04-07 17:23:00', '', 0, '11.7825599', '79.5538417', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 238, '2023-04-07 11:54:07', 1),
(63, 'f316c836-f560-4243-88db-7bdc42d91b5c', 163, '', '2023-04-07', '17:48:00', '', '2023-04-07 17:48:00', '', 0, '11.7825592', '79.5538459', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 238, '2023-04-07 12:18:37', 1),
(64, '55c4e8ef-ff5a-4619-9357-b1e352965ea9', 169, '', '2023-04-07', '17:48:00', '', '2023-04-07 17:48:00', '', 0, '11.7825592', '79.5538459', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 238, '2023-04-07 12:18:53', 1),
(65, '14ce1933-e198-4f34-8a14-96e1fef211ac', 171, '', '2023-04-07', '17:59:00', '', '2023-04-07 17:59:00', '', 0, '11.7825603', '79.5538465', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 241, '2023-04-07 12:30:00', 1),
(66, '30cfdf33-13ec-4d37-939c-1ed030491754', 171, '', '2023-04-07', '17:59:00', '', '2023-04-07 17:59:00', '', 0, '11.7825603', '79.5538465', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 241, '2023-04-07 12:30:11', 1),
(67, '96cde37b-52d2-4b2d-abae-6c986658bb64', 169, '', '2023-04-07', '18:04:00', '', '2023-04-07 18:04:00', '', 0, '11.7825584', '79.553842', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 12:35:04', 1),
(68, '38a91a62-7b68-4a84-aa05-7564968183df', 167, '', '2023-04-07', '18:04:00', '', '2023-04-07 18:04:00', '', 0, '11.7817362', '79.5548999', 'app', '', 'QHJ3+PWJ, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 12:35:05', 1),
(69, 'e45b012d-3eff-4b9c-968b-71960a87e16b', 163, '', '2023-04-07', '18:04:00', '', '2023-04-07 18:04:00', '', 0, '11.7817362', '79.5548999', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 12:35:10', 1),
(70, 'f1b671df-4527-4c0c-bc2c-ef405db14c79', 169, '', '2023-04-07', '18:05:00', '', '2023-04-07 18:05:00', '', 0, '11.7825601', '79.553846', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 12:36:01', 1),
(71, '6b9862ed-e291-450c-9f4c-beeb5310769c', 169, '', '2023-04-07', '18:06:00', '', '2023-04-07 18:06:00', '', 0, '11.7825596', '79.5538422', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 12:36:50', 1),
(72, '6d210809-627f-40fc-a4c1-f9106afdfb1e', 169, '', '2023-04-07', '18:07:00', '', '2023-04-07 18:07:00', '', 0, '11.78256', '79.5538401', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 12:37:35', 1),
(73, 'ba9bd3de-8559-4aa0-8c86-c358c5d2599e', 175, '', '2023-04-07', '18:11:00', '', '2023-04-07 18:11:00', '', 0, '11.782413', '79.5541975', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 245, '2023-04-07 12:42:05', 1),
(74, '9c54a309-a06e-40ff-9e90-4880886c2eba', 163, '', '2023-04-07', '18:04:00', '', '2023-04-07 18:04:00', '', 0, '', '', 'app', '', '', 0, 0, 233, '2023-04-07 12:46:21', 1),
(75, 'b1815052-9117-4d12-a14b-e903c64c7fad', 169, '', '2023-04-07', '18:19:00', '', '2023-04-07 18:19:00', '', 0, '11.7825584', '79.5538391', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-07 12:50:05', 1),
(76, 'c3bd86f0-d969-4a6a-91ff-907ed03bd2ff', 169, '', '2023-04-07', '18:21:00', '', '2023-04-07 18:21:00', '', 0, '11.7825603', '79.5538461', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 239, '2023-04-07 12:51:42', 1),
(77, '0a91364e-042a-4340-a823-d8e1b8996b0d', 169, '', '2023-04-07', '18:21:00', '', '2023-04-07 18:21:00', '', 0, '11.782559', '79.5538426', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 239, '2023-04-07 12:52:06', 1),
(78, '67509c91-984f-4639-bc07-18b9f831b1e6', 169, '', '2023-04-07', '18:22:00', '', '2023-04-07 18:22:00', '', 0, '11.7825602', '79.553841', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 239, '2023-04-07 12:52:27', 1),
(79, 'e3279506-77c3-45a9-bbbe-220edb733962', 169, '', '2023-04-07', '18:29:00', '', '2023-04-07 18:29:00', '', 0, '11.7825611', '79.5538465', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 238, '2023-04-07 13:01:38', 1),
(80, '8703fc04-2767-44ff-8e5d-65b4139f2e00', 169, '', '2023-04-07', '18:32:00', '', '2023-04-07 18:32:00', '', 0, '11.7825592', '79.5538448', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 238, '2023-04-07 13:02:55', 1),
(81, 'c645632d-7756-47de-adbb-9759e4ef87d9', 169, '', '2023-04-08', '08:53:00', '', '2023-04-08 08:53:00', '', 0, '11.7825379', '79.5538633', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 238, '2023-04-08 03:24:18', 1),
(82, '3c530e41-cf8e-46b5-946b-e9784922b589', 169, '', '2023-04-08', '08:54:00', '', '2023-04-08 08:54:00', '', 0, '11.7824923', '79.5538603', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 238, '2023-04-08 03:24:43', 1),
(83, '026a1424-566a-4f98-9c75-526ff1e4290c', 163, '', '2023-04-08', '08:54:00', '', '2023-04-08 08:54:00', '', 0, '', '', 'app', '', '', 0, 0, 233, '2023-04-08 03:25:06', 1),
(84, '6de728ad-d58f-45f4-b791-26ca5f2712f0', 174, '', '2023-04-08', '08:55:00', '', '2023-04-08 08:55:00', '', 0, '11.7825627', '79.5538456', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 244, '2023-04-08 03:25:45', 1),
(85, '39ed62da-9c35-4314-9cc5-e29c60a0dff4', 168, '', '2023-04-08', '08:58:00', '', '2023-04-08 08:58:00', '', 0, '11.7825597', '79.5538409', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 238, '2023-04-08 03:28:05', 1),
(86, '61567b76-e11e-415f-b915-58f41b96258b', 155, '', '2023-04-18', '11:55:00', '', '2023-04-18 11:55:00', '', 0, '11.7825585', '79.5538305', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 221, '2023-04-18 06:25:46', 1),
(87, 'f2f39fbd-4ed8-4aca-b613-44be918d9c8a', 155, '', '2023-04-18', '11:54:00', '', '2023-04-18 11:54:00', '', 0, '11.7825607', '79.5538311', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 221, '2023-04-18 06:26:21', 1),
(88, '3f270e1f-88e2-48c5-ac29-ab0d3c25ec3c', 181, '', '2023-04-18', '13:19:00', '', '2023-04-18 13:19:00', '', 0, '13.1218266', '80.1494273', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 252, '2023-04-18 07:49:36', 1),
(89, '6524af38-0541-432c-a22c-83a075f19c6b', 180, '', '2023-04-18', '13:21:00', '', '2023-04-18 13:21:00', '', 0, '13.1218305', '80.1494295', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 252, '2023-04-18 07:51:47', 1),
(90, '92e14c3c-ce50-4970-a60f-97ed34c68fc1', 180, '', '2023-04-18', '15:17:00', '', '2023-04-18 15:17:00', '', 0, '13.1218252', '80.1494278', 'app', '', '', 0, 0, 251, '2023-04-18 09:48:25', 1),
(91, '3c286be8-078c-491f-baca-7067339461cc', 181, '', '2023-04-18', '16:00:00', '', '2023-04-18 16:00:00', '', 0, '13.1218234', '80.1494198', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 251, '2023-04-18 10:30:42', 1),
(92, '60bc501b-2ee3-457f-8e4f-4eec70b92de4', 182, '', '2023-04-19', '10:43:00', '', '2023-04-19 10:43:00', '', 0, '13.1219683', '80.1494932', 'app', '', '18, Old Twp Rd, Vardharajapuram, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 253, '2023-04-19 05:13:54', 1),
(93, '101cefca-9eb9-4ca2-b445-2c3f82d84991', 182, '', '2023-04-19', '10:43:00', '', '2023-04-19 10:43:00', '', 0, '13.1219683', '80.1494932', 'app', '', '18, Old Twp Rd, Vardharajapuram, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 253, '2023-04-19 05:14:27', 1),
(94, 'e19e9f8d-94ae-4012-a803-b53c56f40b78', 181, '', '2023-04-19', '10:45:00', '', '2023-04-19 10:45:00', '', 0, '13.1218378', '80.1494356', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 252, '2023-04-19 05:15:36', 1),
(95, '89aa9bc5-7d75-4bcb-b7bc-bb846e4a954c', 181, '', '2023-04-19', '10:46:00', '', '2023-04-19 10:46:00', '', 0, '13.1218438', '80.1494537', 'app', '', '18, Old Twp Rd, Vardharajapuram, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 252, '2023-04-19 05:16:58', 1),
(96, 'f66cf384-0ead-4e15-b074-302cdb65360a', 180, '', '2023-04-19', '14:51:00', '', '2023-04-19 14:51:00', '', 0, '13.1218228', '80.149423', 'app', '', '59, Oragadam Rd, Secretariat Colony, Venkatapuram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 259, '2023-04-19 09:21:40', 1),
(97, '05efd1dc-4935-44c2-bb2e-79c060e8aebd', 180, '', '2023-04-19', '14:52:00', '', '2023-04-19 14:52:00', '', 0, '13.1218203', '80.1494205', 'app', '', '59, Oragadam Rd, Secretariat Colony, Venkatapuram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 259, '2023-04-19 09:23:00', 1),
(98, '81b54a20-bff7-4177-a345-941b059e5d01', 182, '', '2023-04-19', '14:52:00', '', '2023-04-19 14:52:00', '', 0, '13.1218224', '80.1494226', 'app', '', '59, Oragadam Rd, Secretariat Colony, Venkatapuram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 259, '2023-04-19 09:23:19', 1),
(99, '68a7c014-07a2-41ec-9d44-ffd65cf81e88', 180, '', '2023-04-19', '17:34:00', '', '2023-04-19 17:34:00', '', 0, '13.1218902', '80.1494529', 'app', '', '59, Oragadam Rd, Secretariat Colony, Venkatapuram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 259, '2023-04-19 12:05:03', 1),
(100, 'a4cd0691-9a34-42ea-89a6-f245f5d23834', 182, '', '2023-04-19', '17:34:00', '', '2023-04-19 17:34:00', '', 0, '13.1218336', '80.1494281', 'app', '', '59, Oragadam Rd, Secretariat Colony, Venkatapuram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 259, '2023-04-19 12:05:11', 1),
(101, '4593c58d-ddb8-45a0-9d96-1f81341f79b4', 181, '', '2023-04-19', '17:35:00', '', '2023-04-19 17:35:00', '', 0, '13.1218309', '80.1494347', 'app', '', '59, Oragadam Rd, Secretariat Colony, Venkatapuram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 259, '2023-04-19 12:05:28', 1),
(102, 'a01aad6f-48a9-4686-812e-be028dc2c9d7', 181, '', '2023-04-19', '17:35:00', '', '2023-04-19 17:35:00', '', 0, '13.1218724', '80.1494205', 'app', '', '59, Oragadam Rd, Secretariat Colony, Venkatapuram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 259, '2023-04-19 12:05:53', 1),
(103, '8b43a87a-1a89-48ea-a8e3-2b8348f194bd', 182, '', '2023-04-20', '11:04:00', '', '2023-04-20 11:04:00', '', 0, '13.1218258', '80.1494301', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 253, '2023-04-20 05:34:09', 1),
(104, 'd8c80fdf-434a-4f6d-9ca2-ac7c2b12ba3f', 181, '', '2023-04-20', '12:19:00', '', '2023-04-20 12:19:00', '', 0, '13.1218344', '80.1494344', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 252, '2023-04-20 06:49:43', 1),
(105, 'dd1d807a-7df2-4212-8c98-41a598e7ad86', 182, '', '2023-04-20', '15:00:00', '', '2023-04-20 15:00:00', '', 0, '13.1218273', '80.1494284', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 262, '2023-04-20 09:30:57', 1),
(106, 'f4d3db5d-e4d0-4c43-b13d-6bd772e72cda', 182, '', '2023-04-20', '15:01:00', '', '2023-04-20 15:01:00', '', 0, '13.1218223', '80.1494119', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 262, '2023-04-20 09:31:54', 1),
(107, '534b76d8-fa35-4935-83fb-932d66eb4557', 182, '', '2023-04-20', '15:12:00', '', '2023-04-20 15:12:00', '', 0, '13.1218247', '80.1494299', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 0, 0, 262, '2023-04-20 09:42:13', 1),
(108, 'a18bc635-4ae3-4aa9-b67e-d778ad021233', 169, '', '2023-04-21', '15:40:00', '', '2023-04-21 15:40:00', '', 0, '11.7825622', '79.5538314', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 239, '2023-04-21 10:11:10', 1),
(109, '7962d8d4-f8d4-4247-9e49-99d4c0a0821b', 169, '', '2023-04-21', '15:56:00', '', '2023-04-21 15:56:00', '', 0, '11.7825587', '79.5538294', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 239, '2023-04-21 10:26:56', 1),
(110, 'df7852a0-7b98-43ee-9427-907ee5c21646', 169, '', '2023-04-21', '15:59:00', '', '2023-04-21 15:59:00', '', 0, '11.7825172', '79.5539497', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 239, '2023-04-21 10:30:15', 1),
(111, '4a1967a6-e68d-422f-bc1b-21ec796efa11', 163, '', '2023-04-21', '16:26:00', '', '2023-04-21 16:26:00', '', 0, '11.7825612', '79.5538327', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 239, '2023-04-21 10:56:47', 1),
(112, '935dc35d-7192-4bca-a982-60afc696d1bd', 163, '', '2023-04-21', '16:27:00', '', '2023-04-21 16:27:00', '', 0, '11.782542', '79.5538199', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 239, '2023-04-21 10:58:17', 1),
(113, '54b244a4-11ca-4f60-aa71-2017cbe78aee', 163, '', '2023-04-21', '16:32:00', '', '2023-04-21 16:32:00', '', 0, '11.7825595', '79.5538267', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-21 11:02:32', 1),
(114, '99ba27f5-ba97-40a2-910d-f48fd8fd43ac', 163, '', '2023-04-21', '16:32:00', '', '2023-04-21 16:32:00', '', 0, '11.7823052', '79.5536424', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-21 11:02:49', 1),
(115, 'a4b98482-c347-430c-8559-9a00552c19a9', 167, '', '2023-04-21', '16:32:00', '', '2023-04-21 16:32:00', '', 0, '11.7825574', '79.5538309', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-21 11:03:03', 1),
(116, 'a8fd245f-3811-4385-9ca2-eaad0a496c52', 167, '', '2023-04-21', '16:57:00', '', '2023-04-21 16:57:00', '', 0, '11.7825589', '79.5538285', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-21 11:27:54', 1),
(117, '2b57e259-8fc4-46a9-b74f-ac30638b61fd', 190, '', '2023-04-21', '17:00:00', '', '2023-04-21 17:00:00', '', 0, '11.7825596', '79.5538235', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-21 11:30:50', 1),
(118, 'c85a68ec-bbd0-4cee-85d3-7359352c86c5', 163, '', '2023-04-21', '17:01:00', '', '2023-04-21 17:01:00', '', 0, '11.7822853', '79.5536341', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-21 11:31:26', 1),
(119, '0a737731-da94-4e24-a46c-050363e90d2a', 163, '', '2023-04-21', '17:01:00', '', '2023-04-21 17:01:00', '', 0, '11.7822853', '79.5536341', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-21 11:31:57', 1),
(120, 'a57771d3-6246-49eb-9e7e-28fc6baadb74', 169, '', '2023-04-21', '17:02:00', '', '2023-04-21 17:02:00', '', 0, '11.7823011', '79.5536353', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-21 11:32:15', 1),
(121, 'd53451a6-cb35-4e6c-8994-6ac86e8e0197', 169, '', '2023-04-21', '17:31:00', '', '2023-04-21 17:31:00', '', 0, '11.7825585', '79.5538307', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 239, '2023-04-21 12:01:36', 1),
(122, '37750867-bcce-4c4b-80e5-2a1fecf330dc', 173, '', '2023-04-21', '17:39:00', '', '2023-04-21 17:39:00', '', 0, '11.7825793', '79.5538195', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 243, '2023-04-21 12:09:46', 1),
(123, '0bebdcef-02aa-4ba0-b691-c8e751997f88', 173, '', '2023-04-21', '17:40:00', '', '2023-04-21 17:40:00', '', 0, '11.7825793', '79.5538195', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 243, '2023-04-21 12:10:07', 1),
(124, '1beba3eb-e0de-4000-a31d-984eb14c123d', 164, '', '2023-04-21', '17:40:00', '', '2023-04-21 17:40:00', '', 0, '11.7825793', '79.5538195', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 243, '2023-04-21 12:10:28', 1),
(125, '700af7d9-1079-475c-91f8-224f8bb416cd', 171, '', '2023-04-21', '17:40:00', '', '2023-04-21 17:40:00', '', 0, '11.7825622', '79.5538321', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 241, '2023-04-21 12:10:46', 1),
(126, '572008ea-8662-4141-8457-0e2aca6c16df', 175, '', '2023-04-21', '17:41:00', '', '2023-04-21 17:41:00', '', 0, '11.7825583', '79.5538308', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 245, '2023-04-21 12:11:49', 1),
(127, 'c82577a5-1b33-485e-9e15-594d3b666aba', 169, '', '2023-04-21', '17:41:00', '', '2023-04-21 17:41:00', '', 0, '11.7825598', '79.5538298', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 240, '2023-04-21 12:12:09', 1),
(128, '78784973-b73c-40b0-b298-959d4c04fe8e', 170, '', '2023-04-21', '17:41:00', '', '2023-04-21 17:41:00', '', 0, '11.7825598', '79.5538298', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 240, '2023-04-21 12:12:26', 1),
(129, '76da6934-4537-4903-8445-b7637c3103c8', 173, '', '2023-04-21', '17:41:00', '', '2023-04-21 17:41:00', '', 0, '11.7825521', '79.5538387', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 240, '2023-04-21 12:12:31', 1),
(130, '66fe78a3-3bff-44fc-abe6-d80a4feb83eb', 164, '', '2023-04-21', '17:41:00', '', '2023-04-21 17:41:00', '', 0, '11.7825521', '79.5538387', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 240, '2023-04-21 12:12:42', 1),
(131, '8365e8bf-43d1-4e79-aea1-ef7e6d2467cd', 168, '', '2023-04-21', '17:44:00', '', '2023-04-21 17:44:00', '', 0, '11.7825624', '79.5538313', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 238, '2023-04-21 12:14:51', 1),
(132, '6332b77d-7352-4fa3-8400-45b991b68e74', 190, '', '2023-04-21', '17:45:00', '', '2023-04-21 17:45:00', '', 0, '11.7825596', '79.5538269', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-21 12:15:27', 1),
(133, '1b29c6d1-9526-4ef8-a491-29a5138143d0', 171, '', '2023-04-21', '17:40:00', '', '2023-04-21 17:40:00', '', 0, '11.7825603', '79.5538328', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 241, '2023-04-21 12:16:00', 1),
(134, '1078be34-f329-4b46-aec0-c52ceed29c7a', 175, '', '2023-04-21', '17:46:00', '', '2023-04-21 17:46:00', '', 0, '11.7825581', '79.5538262', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 245, '2023-04-21 12:16:20', 1),
(135, '94e8d915-1b68-481f-b02d-5045dc20a545', 170, '', '2023-04-21', '17:48:00', '', '2023-04-21 17:48:00', '', 0, '11.7825581', '79.5538456', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 240, '2023-04-21 12:18:37', 1),
(136, '5abdbf66-d830-46db-98df-0b3cb0c83eca', 170, '', '2023-04-21', '17:48:00', '', '2023-04-21 17:48:00', '', 0, '11.7825565', '79.5538247', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 240, '2023-04-21 12:18:57', 1),
(137, '101a6fd1-063b-4506-871c-3581228b580f', 170, '', '2023-04-21', '17:48:00', '', '2023-04-21 17:48:00', '', 0, '11.7825565', '79.5538247', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 240, '2023-04-21 12:19:06', 1),
(138, '2051a542-73e2-498d-b6e5-c7dece3c0d93', 173, '', '2023-04-21', '17:48:00', '', '2023-04-21 17:48:00', '', 0, '11.7825585', '79.5538301', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 240, '2023-04-21 12:19:11', 1),
(139, '273d2677-cffa-4d45-8d01-21190df5c4a2', 170, '', '2023-04-21', '17:48:00', '', '2023-04-21 17:48:00', '', 0, '11.7825585', '79.5538301', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 240, '2023-04-21 12:19:18', 1),
(140, '90b90e9a-4223-4554-9c32-8aa44485ef7b', 163, '', '2023-04-22', '08:35:00', '', '2023-04-22 08:35:00', '', 0, '11.7823056', '79.5536428', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-22 03:05:36', 1),
(141, '434582e8-7fa6-441e-9cf6-8fc1aeeb00a2', 168, '', '2023-04-22', '08:35:00', '', '2023-04-22 08:35:00', '', 0, '11.7823386', '79.5536358', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-22 03:05:51', 1),
(142, '07c7be0e-1515-44af-b7fe-6c4c00291a19', 174, '', '2023-04-22', '08:44:00', '', '2023-04-22 08:44:00', '', 0, '11.7825678', '79.5538275', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-22 03:16:53', 1),
(143, '9cd411c2-ef51-4aa7-837b-32f0f1eff479', 174, '', '2023-04-22', '08:46:00', '', '2023-04-22 08:46:00', '', 0, '11.7825499', '79.5538233', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 244, '2023-04-22 03:18:07', 1),
(144, '29644209-07ee-4d01-a72a-27f63fd9b246', 167, '', '2023-04-22', '08:51:00', '', '2023-04-22 08:51:00', '', 0, '11.7822949', '79.5536352', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-22 03:28:42', 1),
(145, '027ac00a-e3ae-4453-8b5b-b6167152109f', 173, '', '2023-04-22', '09:03:00', '', '2023-04-22 09:03:00', '', 0, '11.7825585', '79.55383', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 243, '2023-04-22 03:34:21', 1),
(146, 'caed57f9-8348-446d-9eef-03ff41341fbd', 169, '', '2023-04-22', '09:04:00', '', '2023-04-22 09:04:00', '', 0, '11.7825585', '79.5538263', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 239, '2023-04-22 03:34:40', 1),
(147, '5692afa2-421b-48b3-88a2-04bcf6446bf7', 175, '', '2023-04-22', '09:08:00', '', '2023-04-22 09:08:00', '', 0, '11.7825585', '79.55383', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 244, '2023-04-22 03:38:58', 1),
(148, '48a67a7e-40c0-47cc-808c-4cc2b7ee2cd2', 190, '', '2023-04-22', '09:29:00', '', '2023-04-22 09:29:00', '', 0, '11.7822906', '79.5536345', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-22 03:59:44', 1),
(149, '8e57317d-57be-4a8d-9870-b4f46a0ecb36', 171, '', '2023-04-22', '09:49:00', '', '2023-04-22 09:49:00', '', 0, '11.7825612', '79.5538327', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 241, '2023-04-22 04:19:29', 1),
(150, '2ffb5f57-9c63-4486-9c6d-76a2603646d3', 170, '', '2023-04-22', '09:49:00', '', '2023-04-22 09:49:00', '', 0, '11.7825592', '79.5538324', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 240, '2023-04-22 04:19:31', 1),
(151, 'c0c3e570-8a16-41f8-82fc-0776ba29e2c8', 169, '', '2023-04-22', '09:52:00', '', '2023-04-22 09:52:00', '', 0, '11.7825593', '79.5538277', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 239, '2023-04-22 04:22:52', 1),
(152, 'e6ab7547-e91e-44da-ada8-f01772310819', 173, '', '2023-04-22', '17:58:00', '', '2023-04-22 17:58:00', '', 0, '11.782413', '79.5541975', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 243, '2023-04-22 12:28:42', 1),
(153, '5a8f3f78-7af3-4632-a438-73d49a380bf2', 175, '', '2023-04-22', '18:01:00', '', '2023-04-22 18:01:00', '', 0, '11.7824728', '79.5538717', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 245, '2023-04-22 12:32:13', 1),
(154, 'd1fe38bb-a34a-44d2-849b-55ce446edfd2', 171, '', '2023-04-22', '18:04:00', '', '2023-04-22 18:04:00', '', 0, '11.7825603', '79.5538328', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 241, '2023-04-22 12:34:14', 1),
(155, '1b4cde48-d197-476e-97f1-5fe28278ad31', 167, '', '2023-04-22', '18:04:00', '', '2023-04-22 18:04:00', '', 0, '11.7825583', '79.5538304', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-22 12:34:23', 1),
(156, '7ad40989-140e-4d27-99a3-82948178eed3', 167, '', '2023-04-22', '18:04:00', '', '2023-04-22 18:04:00', '', 0, '11.7825593', '79.5538277', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 245, '2023-04-22 12:34:26', 1),
(157, '1f8e7bfb-4563-4f13-90ad-5dfcaf019adb', 190, '', '2023-04-22', '18:05:00', '', '2023-04-22 18:05:00', '', 0, '11.7825583', '79.5538304', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-22 12:35:14', 1),
(158, 'ed81c340-1153-469c-9c77-56f9f74ad913', 170, '', '2023-04-22', '18:05:00', '', '2023-04-22 18:05:00', '', 0, '11.7825589', '79.5538285', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 240, '2023-04-22 12:35:35', 1),
(159, 'c8594dcd-df57-4328-ad39-22c75ed0c807', 168, '', '2023-04-22', '18:09:00', '', '2023-04-22 18:09:00', '', 0, '11.7825608', '79.5538329', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 238, '2023-04-22 12:39:07', 1),
(160, '3b4bf9b9-a5f2-40ae-8ab8-e23cdbb0db33', 168, '', '2023-04-24', '08:30:00', '', '2023-04-24 08:30:00', '', 0, '11.7830015', '79.5537888', 'app', '', 'QHM3+5JR, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 238, '2023-04-24 03:00:36', 1),
(161, 'd76e88b2-e680-4b42-8260-0ad1b295a7cc', 163, '', '2023-04-24', '08:30:00', '', '2023-04-24 08:30:00', '', 0, '11.7830149', '79.5537692', 'app', '', 'QHM3+5HX, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-24 03:00:47', 1),
(162, '6095d87e-b34f-4ae3-9029-4c9508058ac4', 169, '', '2023-04-24', '08:42:00', '', '2023-04-24 08:42:00', '', 0, '11.7825593', '79.5538277', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 239, '2023-04-24 03:12:27', 1),
(163, '3d3373eb-5c3d-47ee-ad7f-fbad38ecf2c8', 174, '', '2023-04-24', '08:56:00', '', '2023-04-24 08:56:00', '', 0, '11.7825587', '79.5538315', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 244, '2023-04-24 03:26:54', 1),
(164, 'c7e8106e-8a3b-4582-916b-9fc4c1ecc724', 167, '', '2023-04-24', '08:56:00', '', '2023-04-24 08:56:00', '', 0, '11.7825605', '79.5538271', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-24 03:26:55', 1),
(165, '53a9d019-c048-43b0-b89f-32dbc25efa86', 174, '', '2023-04-24', '08:56:00', '', '2023-04-24 08:56:00', '', 0, '11.7825587', '79.5538315', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 244, '2023-04-24 03:27:09', 1),
(166, '6f9ad992-76ed-405f-b0e4-e1a372fb1c25', 173, '', '2023-04-24', '08:57:00', '', '2023-04-24 08:57:00', '', 0, '11.7825135', '79.5538288', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 243, '2023-04-24 03:27:42', 1),
(167, '3c0bf07b-cca5-4aca-933e-cd4123ab3913', 170, '', '2023-04-24', '09:20:00', '', '2023-04-24 09:20:00', '', 0, '11.7824595', '79.5537672', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 240, '2023-04-24 03:52:24', 1),
(168, '64e42ee3-6d34-4644-9ddb-9da87f73edb0', 163, '', '2023-04-24', '08:57:00', '', '2023-04-24 08:57:00', '', 0, '11.7823066', '79.5536455', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-24 04:11:19', 1),
(169, '4ad31462-00c3-4fe7-b34c-e4f377959b18', 163, '', '2023-04-24', '09:41:00', '', '2023-04-24 09:41:00', '', 0, '11.7823039', '79.5536383', 'app', '', '', 0, 0, 233, '2023-04-24 04:11:34', 1),
(170, '4ba59189-5d2f-48be-bf07-bf2614f2c997', 190, '', '2023-04-24', '09:41:00', '', '2023-04-24 09:41:00', '', 0, '11.782306', '79.553644', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-24 04:11:45', 1),
(171, '18163771-9548-4cb9-a0d3-240f41fea57d', 174, '', '2023-04-24', '18:28:00', '', '2023-04-24 18:28:00', '', 0, '11.7825623', '79.5538321', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 244, '2023-04-24 12:58:12', 1),
(172, '43b29b1a-8765-4fa9-9404-cd3512da0da4', 163, '', '2023-04-25', '16:19:00', '', '2023-04-25 16:19:00', '', 0, '11.7825635', '79.553831', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-25 10:49:45', 1),
(173, '2bda960e-6572-4794-aa43-a9c0d33af253', 167, '', '2023-04-25', '18:04:00', '', '2023-04-25 18:04:00', '', 0, '11.7825589', '79.5538285', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-25 12:35:28', 1),
(174, '6c2dbb20-686a-4ad8-94a0-26bb00fe19df', 190, '', '2023-04-25', '18:05:00', '', '2023-04-25 18:05:00', '', 0, '11.7825601', '79.5538285', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-25 12:39:09', 1),
(175, '53eccf2d-f98b-45d3-9572-ab048d670ba8', 173, '', '2023-04-25', '18:10:00', '', '2023-04-25 18:10:00', '', 0, '11.7825584', '79.5538316', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 243, '2023-04-25 12:40:18', 1),
(176, '003a8813-c9fc-4f83-8052-9e30f4e2c688', 163, '', '2023-04-25', '19:19:00', '', '2023-04-25 19:19:00', '', 0, '11.7825646', '79.5538347', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 233, '2023-04-25 13:49:11', 1),
(177, 'f13993a7-54a5-48eb-af84-c36aaad4b76e', 169, '', '2023-04-26', '09:13:00', '', '2023-04-26 09:13:00', '', 0, '11.7825598', '79.553826', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 239, '2023-04-26 03:44:06', 1),
(178, '3069bdb7-6157-42e1-9df0-2398df1b451a', 163, '', '2023-04-26', '09:49:00', '', '2023-04-26 09:49:00', '', 0, '11.7822963', '79.5536349', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-26 04:19:25', 1),
(179, '7933289f-9fbe-4c66-bdc3-0ccf07b85b24', 169, '', '2023-04-26', '09:53:00', '', '2023-04-26 09:53:00', '', 0, '11.7823983', '79.55377', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 239, '2023-04-26 04:30:06', 1),
(180, '0dc62448-5140-4e29-9b74-e3bac430b17b', 169, '', '2023-04-26', '09:53:00', '', '2023-04-26 09:53:00', '', 0, '11.7823983', '79.55377', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 239, '2023-04-26 04:30:09', 1),
(181, '6ff8b8e0-48a0-433e-9b8c-8e583528e1b8', 169, '', '2023-04-26', '09:58:00', '', '2023-04-26 09:58:00', '', 0, '11.7823983', '79.55377', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 239, '2023-04-26 04:30:34', 1),
(182, '4b0d9229-e688-4c46-a155-7933546a8f1b', 169, '', '2023-04-26', '09:58:00', '', '2023-04-26 09:58:00', '', 0, '11.7823983', '79.55377', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 239, '2023-04-26 04:30:52', 1),
(183, 'dbce0564-9401-4b34-ba8d-6bad7d3e3620', 163, '', '2023-04-26', '09:59:00', '', '2023-04-26 09:59:00', '', 0, '11.7825598', '79.553826', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 239, '2023-04-26 04:31:24', 1),
(184, 'e762e982-bf34-4793-b913-661751bdfa43', 169, '', '2023-04-26', '10:00:00', '', '2023-04-26 10:00:00', '', 0, '11.782434', '79.5537383', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 239, '2023-04-26 04:32:26', 1),
(185, 'de532d67-159a-4311-9209-c5806db29bd6', 167, '', '2023-04-26', '10:02:00', '', '2023-04-26 10:02:00', '', 0, '11.7822953', '79.5536462', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-26 04:32:49', 1),
(186, 'f4306620-b14d-47d2-ac8b-e17918f19809', 169, '', '2023-04-26', '10:42:00', '', '2023-04-26 10:42:00', '', 0, '11.7825621', '79.5538321', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 239, '2023-04-26 05:12:43', 1),
(187, '9222522a-81fa-4a7e-83d5-ebd8645f93e9', 163, '', '2023-04-26', '10:47:00', '', '2023-04-26 10:47:00', '', 0, '11.7823018', '79.5536443', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-26 05:17:19', 1),
(188, 'e2b40947-2fa7-4d6f-912b-e186ca751c90', 163, '', '2023-04-26', '11:00:00', '', '2023-04-26 11:00:00', '', 0, '11.7823019', '79.5536438', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-26 05:31:06', 1),
(189, '44a0f4a2-e53f-4139-bb8e-d01c0d983e31', 173, '', '2023-04-26', '11:03:00', '', '2023-04-26 11:03:00', '', 0, '11.782413', '79.5541975', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 243, '2023-04-26 05:34:15', 1),
(190, '7743121f-4665-4d1e-8083-d5cfdf465eea', 168, '', '2023-04-26', '17:25:00', '', '2023-04-26 17:25:00', '', 0, '11.7825604', '79.5538328', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 238, '2023-04-26 11:55:56', 1),
(191, '403c9cd2-2798-424a-8e2c-37b0437209f9', 169, '', '2023-04-26', '17:52:00', '', '2023-04-26 17:52:00', '', 0, '11.7825598', '79.553826', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 239, '2023-04-26 12:22:59', 1),
(192, '73d9d0bc-5416-47e2-862d-2b6569472c6f', 163, '', '2023-04-26', '17:55:00', '', '2023-04-26 17:55:00', '', 0, '11.782304', '79.5536461', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-26 12:26:04', 1),
(193, '17e1bfed-0d60-43e0-be6e-c1f15329efed', 163, '', '2023-04-26', '17:55:00', '', '2023-04-26 17:55:00', '', 0, '11.7823048', '79.5536459', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-26 12:26:17', 1),
(194, 'ac71d26d-adcc-44e6-ac40-2c56984d5587', 163, '', '2023-04-26', '17:55:00', '', '2023-04-26 17:55:00', '', 0, '11.7823048', '79.5536459', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-26 12:26:27', 1),
(195, '50b7d545-b103-4623-a01f-3c541c409f87', 163, '', '2023-04-26', '18:03:00', '', '2023-04-26 18:03:00', '', 0, '11.7823065', '79.5536441', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-26 12:34:07', 1),
(196, '0de3d28f-7978-4cfd-9eb8-bf9d63166461', 167, '', '2023-04-26', '18:05:00', '', '2023-04-26 18:05:00', '', 0, '11.7822525', '79.5536056', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-26 12:36:12', 1);
INSERT INTO `attendance_detail` (`attendance_detail_id`, `attendance_detail_uniq_id`, `attendance_detail_emp_id`, `attendance_detail_emp_device_id`, `attendance_detail_date`, `attendance_detail_time`, `attendance_detail_check_status`, `attendance_detail_datetime`, `attendance_detail_device_ip`, `attendance_detail_device_id`, `attendance_detail_lat`, `attendance_detail_long`, `attendance_detail_source`, `attendance_detail_in_out_status`, `attendance_detail_location`, `attendance_detail_company_id`, `attendance_detail_branch_id`, `attendance_detail_added_by`, `attendance_detail_added_on`, `attendance_detail_deleted_status`) VALUES
(197, 'e6c6d538-d648-4d7d-91a1-9f7b74651767', 189, '', '2023-04-26', '18:15:00', '', '2023-04-26 18:15:00', '', 0, '13.121822', '80.1494183', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 253, '2023-04-26 12:45:20', 1),
(198, 'c767ad7a-4c9a-4ccd-937b-829f33911f4d', 182, '', '2023-04-26', '18:15:00', '', '2023-04-26 18:15:00', '', 0, '13.121821', '80.1494202', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 253, '2023-04-26 12:47:27', 1),
(199, '1f676bbc-3ac6-46f4-a513-a70854d16712', 189, '', '2023-04-26', '18:17:00', '', '2023-04-26 18:17:00', '', 0, '13.121821', '80.1494202', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 253, '2023-04-26 12:47:54', 1),
(200, '8126b778-f3d2-499d-98f1-7c7073382864', 189, '', '2023-04-26', '18:17:00', '', '2023-04-26 18:17:00', '', 0, '13.1218316', '80.1494612', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 253, '2023-04-26 12:48:04', 1),
(201, '301bd44e-d176-4e26-9de5-fc1ed3318ba4', 182, '', '2023-04-26', '18:18:00', '', '2023-04-26 18:18:00', '', 0, '13.12183', '80.1494484', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 253, '2023-04-26 12:48:12', 1),
(202, '99df6060-cfe6-42f3-a59b-2068451176a1', 181, '', '2023-04-26', '18:18:00', '', '2023-04-26 18:18:00', '', 0, '13.12183', '80.1494484', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 253, '2023-04-26 12:48:19', 1),
(203, 'ba1c3ab2-d1ef-4d22-a747-e1d7c5d32849', 182, '', '2023-04-26', '18:18:00', '', '2023-04-26 18:18:00', '', 0, '13.1218438', '80.1496445', 'app', '', '17/30, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 253, '2023-04-26 12:48:53', 1),
(204, '0327d9d4-2c86-4dee-b4f9-81fbb6a83beb', 182, '', '2023-04-26', '18:19:00', '', '2023-04-26 18:19:00', '', 0, '13.1218248', '80.1494307', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 253, '2023-04-26 12:50:05', 1),
(205, '77f60eb7-5c9a-4316-9eef-63d32ec5ef7c', 169, '', '2023-04-26', '18:44:00', '', '2023-04-26 18:44:00', '', 0, '11.7825589', '79.5538285', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 239, '2023-04-26 13:14:57', 1),
(206, '4500a0da-8950-4831-9944-162b408550a9', 163, '', '2023-04-26', '18:59:00', '', '2023-04-26 18:59:00', '', 0, '11.7822593', '79.5536646', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-26 13:29:10', 1),
(207, '439d98a3-c25a-44e0-9e04-b9ca25ae5e0a', 163, '', '2023-04-27', '09:08:00', '', '2023-04-27 09:08:00', '', 0, '11.782254', '79.5535584', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-27 03:40:48', 1),
(208, 'f7399f10-f409-4dd4-9f90-075668b228ed', 173, '', '2023-04-27', '09:12:00', '', '2023-04-27 09:12:00', '', 0, '11.7825398', '79.5538242', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 243, '2023-04-27 03:43:29', 1),
(209, '2a116723-df33-41e3-9ef9-ad66c1a5ae0b', 169, '', '2023-04-27', '09:26:00', '', '2023-04-27 09:26:00', '', 0, '11.7825585', '79.55383', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 239, '2023-04-27 03:57:04', 1),
(210, '66270b2c-f098-4d03-990f-7959525c1ee3', 163, '', '2023-04-27', '09:27:00', '', '2023-04-27 09:27:00', '', 0, '11.7822524', '79.55356', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-27 03:57:45', 1),
(211, 'bc9659a9-adee-46f4-a109-9d28de559429', 167, '', '2023-04-27', '09:27:00', '', '2023-04-27 09:27:00', '', 0, '11.7822524', '79.55356', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-27 03:58:01', 1),
(212, 'f80f80a9-15c4-45d4-8e67-efee238084cc', 190, '', '2023-04-27', '09:27:00', '', '2023-04-27 09:27:00', '', 0, '11.7822616', '79.5535571', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-27 04:13:29', 1),
(213, 'b60a33f1-8c2b-42aa-9237-6d2c66de78c0', 173, '', '2023-04-27', '09:44:00', '', '2023-04-27 09:44:00', '', 0, '11.7825308', '79.5538408', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 243, '2023-04-27 04:14:52', 1),
(214, '189c1ec4-f80e-4cb1-9030-c6852d3b2c18', 170, '', '2023-04-27', '09:44:00', '', '2023-04-27 09:44:00', '', 0, '11.7825308', '79.5538408', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 243, '2023-04-27 04:15:28', 1),
(215, 'a4e9aefc-c48d-4c02-82c3-6a821b9f5f54', 174, '', '2023-04-27', '09:44:00', '', '2023-04-27 09:44:00', '', 0, '11.7825167', '79.5538346', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 243, '2023-04-27 04:15:50', 1),
(216, 'ee58082e-f619-4c08-8f3a-a1f2d453be50', 169, '', '2023-04-27', '10:22:00', '', '2023-04-27 10:22:00', '', 0, '11.7825381', '79.5538228', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 239, '2023-04-27 04:52:48', 1),
(217, 'bef82e1c-29b9-4207-930a-90bdc281d1a6', 182, '', '2023-04-27', '10:25:00', '', '2023-04-27 10:25:00', '', 0, '13.1218237', '80.1494219', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 253, '2023-04-27 04:56:30', 1),
(218, 'c719cc35-4764-4f8f-847b-ac705d5dc120', 182, '', '2023-04-27', '10:26:00', '', '2023-04-27 10:26:00', '', 0, '13.1218237', '80.1494219', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 253, '2023-04-27 04:56:42', 1),
(219, '525330c5-154c-404b-987b-c3b9f2121279', 192, '', '2023-04-27', '10:53:00', '', '2023-04-27 10:53:00', '', 0, '13.1218227', '80.1494188', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 49, 35, 269, '2023-04-27 05:23:12', 1),
(220, 'ed2c5a74-a3d2-4f11-a51e-61adf20fb827', 190, '', '2023-04-27', '11:04:00', '', '2023-04-27 11:04:00', '', 0, '11.7825624', '79.5538313', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 266, '2023-04-27 05:34:24', 1),
(221, 'b0e8914f-f0ff-471e-8665-0ccf55642349', 190, '', '2023-04-27', '17:59:00', '', '2023-04-27 17:59:00', '', 0, '11.7825632', '79.553831', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 266, '2023-04-27 12:30:24', 1),
(222, '92d43056-19c5-4cd6-9e17-fccbcd026a74', 167, '', '2023-04-27', '18:00:00', '', '2023-04-27 18:00:00', '', 0, '11.7828502', '79.5540806', 'app', '', 'QHM3+5JR, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-04-27 12:38:55', 1),
(223, '289c7886-3e98-4e0c-84dc-e064af79c565', 163, '', '2023-04-27', '19:03:00', '', '2023-04-27 19:03:00', '', 0, '11.7825425', '79.5538207', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-04-27 13:33:40', 1),
(224, 'afcee273-5f13-4956-a85c-6af366ef61af', 163, '', '2023-04-28', '08:55:00', '', '2023-04-28 08:55:00', '', 0, '11.7822536', '79.5535617', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-28 03:25:43', 1),
(225, 'ebddb72e-1a8a-4333-a016-87b9c8bdc2c0', 167, '', '2023-04-28', '09:10:00', '', '2023-04-28 09:10:00', '', 0, '11.7822542', '79.5535484', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-28 03:40:22', 1),
(226, 'f1179884-565f-4b7e-8252-c8a62428a77d', 169, '', '2023-04-28', '09:10:00', '', '2023-04-28 09:10:00', '', 0, '11.7825396', '79.5538195', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 239, '2023-04-28 03:40:55', 1),
(227, 'a3054481-eaf4-4f42-9b47-7c221b3b2c3c', 174, '', '2023-04-28', '09:14:00', '', '2023-04-28 09:14:00', '', 0, '11.7825408', '79.5538246', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 244, '2023-04-28 03:44:51', 1),
(228, 'b24a1723-e6bb-49fa-a9da-8615105d1fd2', 190, '', '2023-04-28', '09:52:00', '', '2023-04-28 09:52:00', '', 0, '11.7822509', '79.5535661', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-28 04:22:47', 1),
(229, '86e6e285-0f41-41ec-8b6e-f5eb7e9b8f73', 167, '', '2023-04-28', '18:02:00', '', '2023-04-28 18:02:00', '', 0, '11.7822611', '79.5535594', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-28 12:32:58', 1),
(230, 'e444e1b7-3a86-4d01-9ac5-61c5f49de955', 190, '', '2023-04-28', '18:03:00', '', '2023-04-28 18:03:00', '', 0, '11.7822611', '79.5535594', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-28 12:33:13', 1),
(231, 'ac7acaad-fe29-4ba6-940b-7ac3ddb4322e', 163, '', '2023-04-29', '08:52:00', '', '2023-04-29 08:52:00', '', 0, '11.7822503', '79.5535478', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-29 03:22:09', 1),
(232, '43ca13aa-686c-4a54-b6fb-c314208a1bf2', 163, '', '2023-04-29', '08:52:00', '', '2023-04-29 08:52:00', '', 0, '11.7822527', '79.5535479', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-29 03:22:35', 1),
(233, 'affa8a3b-9d57-410b-b1fa-d626ca5c4ccc', 163, '', '2023-04-29', '08:52:00', '', '2023-04-29 08:52:00', '', 0, '11.7822527', '79.5535479', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 0, 0, 233, '2023-04-29 03:22:40', 1),
(234, '56addf11-cbda-490c-8342-8b1cbb51d247', 163, '', '2023-04-29', '08:53:00', '', '2023-04-29 08:53:00', '', 0, '11.7822553', '79.553548', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-29 03:23:35', 1),
(235, '6e50375d-d4ea-449e-b9b7-74566322cb18', 163, '', '2023-04-29', '08:57:00', '', '2023-04-29 08:57:00', '', 0, '11.7825438', '79.553823', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-04-29 03:27:35', 1),
(236, '9aad31e1-37a8-4854-ae87-3653d1d526bd', 169, '', '2023-04-29', '08:57:00', '', '2023-04-29 08:57:00', '', 0, '11.7825402', '79.5538245', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 239, '2023-04-29 03:27:47', 1),
(237, '4d80a0ce-23e1-43e9-90c6-edf8386151d1', 167, '', '2023-04-29', '08:57:00', '', '2023-04-29 08:57:00', '', 0, '11.7825592', '79.5538272', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-04-29 03:27:52', 1),
(238, '1bf8a726-dd96-44e2-8ea5-fcfe1f38c74d', 163, '', '2023-04-29', '09:40:00', '', '2023-04-29 09:40:00', '', 0, '11.7822571', '79.5535573', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-29 04:10:32', 1),
(239, 'bf6bf390-b8d2-499f-bd02-2c2070a2d204', 190, '', '2023-04-29', '09:40:00', '', '2023-04-29 09:40:00', '', 0, '11.7822571', '79.5535573', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-29 04:10:53', 1),
(240, '229434d2-7b83-407e-80b9-44ec5dc019ff', 174, '', '2023-04-29', '09:40:00', '', '2023-04-29 09:40:00', '', 0, '11.7825422', '79.5538238', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 244, '2023-04-29 04:10:57', 1),
(241, '4cd7a009-420f-46c2-9952-9a1031e97dc5', 173, '', '2023-04-29', '09:40:00', '', '2023-04-29 09:40:00', '', 0, '11.7825422', '79.5538238', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 244, '2023-04-29 04:11:02', 1),
(242, 'd27bbe75-68d5-478f-8364-5b1155b9a4f8', 190, '', '2023-04-29', '14:22:00', '', '2023-04-29 14:22:00', '', 0, '11.782539', '79.5538211', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 266, '2023-04-29 08:53:09', 1),
(243, '900623ed-bccf-4905-8b67-942095b20120', 169, '', '2023-04-29', '15:43:00', '', '2023-04-29 15:43:00', '', 0, '11.7825393', '79.5538203', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-04-29 10:13:44', 1),
(244, 'a3a889f2-57bf-43bb-9deb-af6012eb6a36', 169, '', '2023-04-29', '15:43:00', '', '2023-04-29 15:43:00', '', 0, '11.7825393', '79.5538203', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-04-29 10:13:52', 1),
(245, '4b9cd9a0-bf3f-4b01-8ca9-8fb46c6782f5', 169, '', '2023-04-29', '17:30:00', '', '2023-04-29 17:30:00', '', 0, '11.7825402', '79.5538242', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-04-29 12:00:58', 1),
(246, '177c4159-fdd8-4981-a413-706a0af32cdd', 169, '', '2023-04-29', '17:33:00', '', '2023-04-29 17:33:00', '', 0, '11.7825402', '79.5538179', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 239, '2023-04-29 12:06:02', 1),
(247, '619ba73a-92cc-497e-90eb-20f613dc2db2', 169, '', '2023-04-29', '17:33:00', '', '2023-04-29 17:33:00', '', 0, '11.7825402', '79.5538179', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 239, '2023-04-29 12:06:16', 1),
(248, 'cce54aae-f728-4f51-b7b8-11db2bc3d604', 190, '', '2023-04-29', '17:56:00', '', '2023-04-29 17:56:00', '', 0, '11.7825393', '79.5538203', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 266, '2023-04-29 12:27:23', 1),
(249, '59cf345f-f7b0-4404-b21d-fff593ad5483', 163, '', '2023-04-29', '17:55:00', '', '2023-04-29 17:55:00', '', 0, '11.782254', '79.5535584', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-29 12:29:47', 1),
(250, 'c06f550b-fdfd-4434-9050-c5c550c1d3d5', 167, '', '2023-04-29', '17:55:00', '', '2023-04-29 17:55:00', '', 0, '11.782254', '79.5535584', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-29 12:29:58', 1),
(251, 'f48e22bc-b556-4709-b5f7-b349bca7ba92', 163, '', '2023-04-29', '18:26:00', '', '2023-04-29 18:26:00', '', 0, '11.782254', '79.5535584', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-04-29 12:57:01', 1),
(252, '2af3cb98-7383-4c36-bc19-4daadd4e21bc', 163, '', '2023-05-02', '09:07:00', '', '2023-05-02 09:07:00', '', 0, '11.7827022', '79.5539432', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-02 03:38:07', 1),
(253, 'd45fd1f9-63c4-406e-a68a-7c5b3f57a3a5', 167, '', '2023-05-02', '09:08:00', '', '2023-05-02 09:08:00', '', 0, '11.7829444', '79.5538523', 'app', '', 'QHM3+5JR, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-02 03:38:28', 1),
(254, '8c1b6f01-6f27-4ef4-9ca6-2882122a28ab', 169, '', '2023-05-02', '09:45:00', '', '2023-05-02 09:45:00', '', 0, '11.7825389', '79.5538226', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 239, '2023-05-02 04:16:10', 1),
(255, '89c90d91-0d26-4e0f-8277-9ef30c7558ea', 190, '', '2023-05-02', '09:45:00', '', '2023-05-02 09:45:00', '', 0, '11.7825394', '79.5538212', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 266, '2023-05-02 04:16:30', 1),
(256, 'e5162407-bd76-4ecb-a6c3-172202d474dc', 167, '', '2023-05-02', '18:03:00', '', '2023-05-02 18:03:00', '', 0, '11.7822595', '79.5535553', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-05-02 12:33:42', 1),
(257, '33d95423-b495-4e07-9320-18aed8daeb38', 163, '', '2023-05-02', '18:04:00', '', '2023-05-02 18:04:00', '', 0, '11.782261', '79.5535557', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-05-02 12:34:24', 1),
(258, '087386d0-1a36-4e65-bc02-f68378fc1b2a', 190, '', '2023-05-02', '18:04:00', '', '2023-05-02 18:04:00', '', 0, '11.7825278', '79.5538065', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-02 12:34:49', 1),
(259, '1a0cf21b-e6a7-4d2e-9528-f4a50811d9e0', 163, '', '2023-05-02', '19:05:00', '', '2023-05-02 19:05:00', '', 0, '11.7825389', '79.5538218', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-02 13:35:06', 1),
(260, '991cf7d1-8791-4030-b804-38179d916763', 163, '', '2023-05-03', '08:42:00', '', '2023-05-03 08:42:00', '', 0, '11.782253', '79.5535583', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-05-03 03:12:42', 1),
(261, 'e7045f91-8cf0-42b2-801b-ddb6544b7077', 163, '', '2023-05-03', '09:05:00', '', '2023-05-03 09:05:00', '', 0, '11.7825418', '79.5538195', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-03 03:35:12', 1),
(262, '059ed859-da7b-4c37-9680-57333b1ac7f8', 167, '', '2023-05-03', '09:05:00', '', '2023-05-03 09:05:00', '', 0, '11.7825418', '79.5538195', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-03 03:35:19', 1),
(263, '4c238a83-4a75-4ff8-8f07-9332eb7687a0', 174, '', '2023-05-03', '09:13:00', '', '2023-05-03 09:13:00', '', 0, '11.7825413', '79.5538246', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 244, '2023-05-03 03:43:58', 1),
(264, 'e996dfb2-6f2d-4208-967b-1d9eaa16bf31', 169, '', '2023-05-03', '09:47:00', '', '2023-05-03 09:47:00', '', 0, '11.7825428', '79.5538238', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 239, '2023-05-03 04:17:51', 1),
(265, 'd1e183cb-f476-48e7-bc24-ee5c51635c2f', 163, '', '2023-05-03', '09:05:00', '', '2023-05-03 09:05:00', '', 0, '11.7823672', '79.5536541', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-05-03 04:20:26', 1),
(266, 'fe885f83-bed8-4dfd-8a35-a10be49c0748', 190, '', '2023-05-03', '09:50:00', '', '2023-05-03 09:50:00', '', 0, '11.7825366', '79.5538165', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-03 04:22:56', 1),
(267, 'ece9d96c-da9b-4cfa-9293-82197b45811c', 169, '', '2023-05-03', '12:10:00', '', '2023-05-03 12:10:00', '', 0, '11.7825402', '79.5538245', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 239, '2023-05-03 06:40:30', 1),
(268, '27d9d466-0326-4cf2-9826-8791e526b902', 163, '', '2023-05-03', '14:37:00', '', '2023-05-03 14:37:00', '', 0, '11.7824415', '79.5538482', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-03 09:10:49', 1),
(269, 'adc8ff8d-a07c-4b19-b72e-4ac8184416a0', 169, '', '2023-05-03', '14:41:00', '', '2023-05-03 14:41:00', '', 0, '11.7825389', '79.5538218', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-03 09:12:05', 1),
(270, '0519723e-8d9b-4913-8ef2-35a0a9ce2826', 163, '', '2023-05-03', '14:51:00', '', '2023-05-03 14:51:00', '', 0, '', '', 'app', '', '', 48, 32, 233, '2023-05-03 09:24:46', 1),
(271, '745e0b4d-5a62-48e4-856b-a28f6a194c31', 163, '', '2023-05-03', '14:57:00', '', '2023-05-03 14:57:00', '', 0, '', '', 'app', '', '', 48, 32, 233, '2023-05-03 09:30:41', 1),
(272, 'a55929ea-33ad-45f8-9bed-b786015dac75', 163, '', '2023-05-03', '14:57:00', '', '2023-05-03 14:57:00', '', 0, '', '', 'app', '', '', 48, 32, 233, '2023-05-03 09:31:17', 1),
(273, 'e4b0edb2-ae82-4bcb-b24c-c8ae041dbe51', 163, '', '2023-05-03', '15:01:00', '', '2023-05-03 15:01:00', '', 0, '11.7822588', '79.5535585', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-05-03 09:31:28', 1),
(274, '6ba498cc-18f4-4229-9111-065edc714559', 163, '', '2023-05-03', '15:01:00', '', '2023-05-03 15:01:00', '', 0, '', '', 'app', '', '', 48, 32, 233, '2023-05-03 09:35:11', 1),
(275, '41062097-04dc-4402-a91b-27df482ac52b', 190, '', '2023-05-03', '17:58:00', '', '2023-05-03 17:58:00', '', 0, '11.7822446', '79.5535474', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-05-03 12:29:04', 1),
(276, 'cd9e854c-0db6-4a3d-b857-71b9f212ea60', 167, '', '2023-05-03', '18:17:00', '', '2023-05-03 18:17:00', '', 0, '11.7823912', '79.5536811', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-05-03 12:48:31', 1),
(277, '215e17fe-2505-4bff-9b1e-8299a3017877', 163, '', '2023-05-04', '08:47:00', '', '2023-05-04 08:47:00', '', 0, '11.7822533', '79.5535583', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-05-04 03:18:10', 1),
(278, '077e2e1c-9e99-47cd-92e1-2b18b4593af4', 167, '', '2023-05-04', '09:00:00', '', '2023-05-04 09:00:00', '', 0, '11.7822598', '79.553554', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-05-04 03:30:56', 1),
(279, '828925aa-b018-4b86-b3fd-ef19e16eb067', 163, '', '2023-05-04', '09:48:00', '', '2023-05-04 09:48:00', '', 0, '11.7825402', '79.5538179', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-04 04:18:22', 1),
(280, '51fd3afd-e641-45e8-9ddd-9736efd97745', 190, '', '2023-05-04', '09:48:00', '', '2023-05-04 09:48:00', '', 0, '11.7825402', '79.5538179', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-04 04:18:50', 1),
(281, '44b6cd92-4497-4cfe-89f0-0b5290f9faef', 169, '', '2023-05-04', '09:49:00', '', '2023-05-04 09:49:00', '', 0, '11.7825424', '79.5538238', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 239, '2023-05-04 04:19:11', 1),
(282, 'b9ceac46-db5e-4eed-bba5-d34da8cb6c1f', 169, '', '2023-05-04', '09:49:00', '', '2023-05-04 09:49:00', '', 0, '11.7825391', '79.5538208', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 239, '2023-05-04 04:21:46', 1),
(283, '53078256-5089-4aaa-95fb-81d81f77de97', 167, '', '2023-05-04', '18:00:00', '', '2023-05-04 18:00:00', '', 0, '11.7825375', '79.5538153', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-04 12:35:38', 1),
(284, '3278a4f2-82be-41a7-b70a-d7efe52605c7', 190, '', '2023-05-04', '18:20:00', '', '2023-05-04 18:20:00', '', 0, '11.7825406', '79.5538184', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-04 12:54:24', 1),
(285, '866ec294-fa0b-42bc-b294-635c362363fa', 163, '', '2023-05-04', '18:24:00', '', '2023-05-04 18:24:00', '', 0, '11.782539', '79.5538211', 'app', '', '', 48, 32, 233, '2023-05-04 13:41:25', 1),
(286, '967b4692-6c5f-4572-b0ee-accdeaebad1b', 163, '', '2023-05-05', '09:04:00', '', '2023-05-05 09:04:00', '', 0, '11.7823348', '79.5534283', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-05-05 03:35:04', 1),
(287, '845e70b8-fa87-48ce-9f05-21feb4d810dd', 163, '', '2023-05-05', '09:05:00', '', '2023-05-05 09:05:00', '', 0, '11.7823037', '79.5534656', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-05-05 03:59:03', 1),
(288, 'cce85e1c-e0fc-41bb-ba49-7aee3be1785b', 167, '', '2023-05-05', '09:29:00', '', '2023-05-05 09:29:00', '', 0, '11.7825434', '79.5538374', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-05 03:59:17', 1),
(289, '5a49df1a-6e1c-48ec-973e-fdccc5fb49a9', 174, '', '2023-05-05', '10:53:00', '', '2023-05-05 10:53:00', '', 0, '11.7825449', '79.5538433', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 244, '2023-05-05 05:23:31', 1),
(290, '0c90646a-42e7-4cd3-b9a9-3e4be255f91f', 174, '', '2023-05-05', '10:53:00', '', '2023-05-05 10:53:00', '', 0, '11.7825449', '79.5538433', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 244, '2023-05-05 05:23:37', 1),
(291, 'a1862eab-322f-429d-8c7f-cdbcca55be3d', 163, '', '2023-05-05', '18:00:00', '', '2023-05-05 18:00:00', '', 0, '11.7822593', '79.5535555', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-05-05 12:30:21', 1),
(292, '0e3377b7-d337-4461-91e2-2d8aa07bd6ca', 167, '', '2023-05-05', '18:00:00', '', '2023-05-05 18:00:00', '', 0, '11.7822593', '79.5535555', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-05-05 12:30:36', 1),
(293, '83e7bdb2-1cd7-4ee6-8781-719e0ce829e7', 163, '', '2023-05-05', '18:25:00', '', '2023-05-05 18:25:00', '', 0, '11.7825461', '79.5538403', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-05 12:56:03', 1),
(294, 'ebaddfaf-486a-4929-a85c-f31d054768d2', 169, '', '2023-05-05', '18:26:00', '', '2023-05-05 18:26:00', '', 0, '11.7825442', '79.5538415', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-05 12:56:36', 1),
(295, '36996f13-b3c0-42f7-8982-2c12f806fb05', 163, '', '2023-05-06', '09:11:00', '', '2023-05-06 09:11:00', '', 0, '11.7822457', '79.553532', 'app', '', 'QHJ3+XFR, TRV Nagar, Lakshminarayanpuram, Tamil Nadu 607016, India', 48, 32, 233, '2023-05-06 03:41:53', 1),
(296, '248fd1cd-9796-414e-b739-5ff0aa05a46c', 169, '', '2023-05-10', '11:04:00', '', '2023-05-10 11:04:00', '', 0, '11.7825453', '79.5538418', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 233, '2023-05-10 05:34:14', 1),
(297, '3b3bf599-38ab-433b-9c52-b80ed9710055', 174, '', '2023-05-11', '08:59:00', '', '2023-05-11 08:59:00', '', 0, '11.7825446', '79.5538521', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 244, '2023-05-11 03:29:41', 1),
(298, 'gfhhgjjhjhuytyikhkjjhljllklljhlhjljhl', 195, '', '2023-03-25', '19:30:00', '', '2023-03-25 19:30:00', '', 0, '11.782548', '79.5538425', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 0, 0, 218, '2023-05-12 04:40:24', 1),
(299, 'gfhhgjjhjhuytyikhkjjhhhuiioljllklljhlhjljhl', 195, '', '2023-05-12', '10:30:00', '', '2023-05-12 10:30:00', '', 0, '11.782548', '79.5538425', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 46, 44, 218, '2023-05-12 04:44:46', 1),
(300, 'gfhhgjjhjhuytyikhkjjhhhuiioljllklljhlhjljhltrtrtrtr', 183, '', '2023-05-12', '11:30:00', '', '2023-05-12 11:30:00', '', 0, '11.782548', '79.5538425', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 34, 218, '2023-05-12 05:56:01', 1),
(301, 'fhdgjgfjhgkjhkljhljklkjljxvgsdfgfdhfgd', 196, '', '2023-05-12', '11:30:00', '', '2023-05-12 11:30:00', '', 0, '11.782548', '79.5538425', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 46, 44, 218, '2023-05-12 06:14:44', 1),
(302, '4cfff4d3-16e9-4c5e-944f-52c5da2ed5e4', 174, '', '2023-05-20', '08:46:00', '', '2023-05-20 08:46:00', '', 0, '11.7825552', '79.5538553', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 244, '2023-05-20 03:16:54', 1),
(303, '817406b3-320d-41d0-be9c-f14b644fe814', 182, '', '2023-05-24', '16:42:00', '', '2023-05-24 16:42:00', '', 0, '13.1218226', '80.1494304', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 253, '2023-05-24 11:12:46', 1),
(304, '8a0b4db5-e51e-473c-8cda-8428580fe0be', 182, '', '2023-05-24', '16:43:00', '', '2023-05-24 16:43:00', '', 0, '13.1218248', '80.1494243', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 253, '2023-05-24 11:13:29', 1),
(305, '51fadfe3-0862-4cdb-a5f1-ffb7f92bdc70', 182, '', '2023-05-24', '16:43:00', '', '2023-05-24 16:43:00', '', 0, '13.1218129', '80.1493985', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 253, '2023-05-24 11:13:48', 1),
(306, '9fa2b3f2-5d65-4d4a-9872-739063f839e5', 169, '', '2023-05-25', '10:04:00', '', '2023-05-25 10:04:00', '', 0, '11.7825677', '79.5537994', 'app', '', 'QHM3+2HC, TRV Nagar, Panruti, Tamil Nadu 607106, India', 48, 32, 239, '2023-05-25 04:34:46', 1),
(307, '7d3bc7c0-7fb7-4ee5-b65b-07de1a475e12', 180, '', '2023-05-26', '10:19:00', '', '2023-05-26 10:19:00', '', 0, '13.1218253', '80.1494337', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 251, '2023-05-26 04:50:00', 1),
(308, '9a1a41bf-353b-4584-94e9-c77f3c09fbe2', 180, '', '2023-05-26', '10:20:00', '', '2023-05-26 10:20:00', '', 0, '13.1218274', '80.1494333', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 251, '2023-05-26 04:50:41', 1),
(309, '681b0a01-e36a-4096-b203-ad659e809bac', 188, '', '2023-05-26', '10:25:00', '', '2023-05-26 10:25:00', '', 0, '13.1218433', '80.1494428', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 300, '2023-05-26 04:55:11', 1),
(310, '39bd8339-e01f-48ac-b5a9-98b6a644c254', 180, '', '2023-05-26', '10:38:00', '', '2023-05-26 10:38:00', '', 0, '13.1218303', '80.1494356', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 251, '2023-05-26 05:08:38', 1),
(311, 'baf14bc6-0624-49ee-b429-81c4ffadf689', 182, '', '2023-05-30', '14:45:00', '', '2023-05-30 14:45:00', '', 0, '13.1218384', '80.1494423', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 253, '2023-05-30 09:15:59', 1),
(312, '853cea3a-cc95-4b02-9285-91ac4d8d49ae', 201, '', '2023-05-30', '15:20:00', '', '2023-05-30 15:20:00', '', 0, '13.0866763', '80.2143687', 'app', '', '11, 5th St, X Block, Y Block, Anna Nagar, Chennai, Tamil Nadu 600040, India', 48, 34, 300, '2023-05-30 09:50:07', 1),
(313, 'eb333727-ff23-45b3-87da-f06a4882e43b', 202, '', '2023-05-30', '15:23:00', '', '2023-05-30 15:23:00', '', 0, '13.0869482', '80.2141796', 'app', '', '11, 5th St, X Block, Y Block, Anna Nagar, Chennai, Tamil Nadu 600040, India', 48, 34, 301, '2023-05-30 09:53:37', 1),
(314, '08bdae8a-914d-4afb-b08d-d0a18b2668ab', 202, '', '2023-05-31', '11:18:00', '', '2023-05-31 11:18:00', '', 0, '13.0943529', '80.1785933', 'app', '', '35VH+PCP, TMP Nagar, Padi, Chennai, Tamil Nadu 600050, India', 48, 34, 301, '2023-05-31 05:48:30', 1),
(315, '4ad1c753-9095-40b9-93bf-92de1fa685c7', 201, '', '2023-05-31', '11:18:00', '', '2023-05-31 11:18:00', '', 0, '13.0943533', '80.1785909', 'app', '', '35VH+PCP, TMP Nagar, Padi, Chennai, Tamil Nadu 600050, India', 48, 34, 300, '2023-05-31 05:49:02', 1),
(316, '1c3c2bde-2e4c-4693-ba83-46d3398386d7', 201, '', '2023-06-01', '10:57:00', '', '2023-06-01 10:57:00', '', 0, '13.1218341', '80.1494381', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 300, '2023-06-01 05:27:27', 1),
(317, 'dc32b1e0-e224-4e00-91d9-0b33324a26bf', 202, '', '2023-06-01', '10:59:00', '', '2023-06-01 10:59:00', '', 0, '', '', 'app', '', '', 48, 34, 301, '2023-06-01 05:29:21', 1),
(318, 'a26700e3-5cf9-45c6-922b-d13c3037447b', 180, '', '2023-06-01', '11:05:00', '', '2023-06-01 11:05:00', '', 0, '13.1218533', '80.1494498', 'app', '', '59, Oragadam Rd, Secretariat Colony, Venkatapuram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 251, '2023-06-01 05:35:44', 1),
(319, '69c2988d-f10a-42b5-bb6a-cf9d062a4e2d', 180, '', '2023-06-01', '11:05:00', '', '2023-06-01 11:05:00', '', 0, '13.1218369', '80.1494356', 'app', '', '59, Oragadam Rd, Secretariat Colony, Venkatapuram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 251, '2023-06-01 05:36:02', 1),
(320, '07242ba8-d01f-4be5-ba25-1d3e35822fbe', 180, '', '2023-06-01', '11:06:00', '', '2023-06-01 11:06:00', '', 0, '13.1218387', '80.1494428', 'app', '', '59, Oragadam Rd, Secretariat Colony, Venkatapuram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 251, '2023-06-01 05:36:36', 1),
(321, '92945db7-8a12-4ce3-847d-ca6788e37352', 181, '', '2023-06-01', '11:06:00', '', '2023-06-01 11:06:00', '', 0, '13.1218337', '80.1494357', 'app', '', '59, Oragadam Rd, Secretariat Colony, Venkatapuram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 251, '2023-06-01 05:36:52', 1),
(322, '0d951f0f-3099-419d-8f94-4f28b2964710', 181, '', '2023-06-01', '11:06:00', '', '2023-06-01 11:06:00', '', 0, '13.1218337', '80.1494357', 'app', '', '59, Oragadam Rd, Secretariat Colony, Venkatapuram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 251, '2023-06-01 05:37:01', 1),
(323, 'a98692f5-e8cf-4c91-93bc-28d599cecc43', 180, '', '2023-06-01', '11:07:00', '', '2023-06-01 11:07:00', '', 0, '13.1218368', '80.1494374', 'app', '', '59, Oragadam Rd, Secretariat Colony, Venkatapuram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 251, '2023-06-01 05:37:46', 1),
(324, '5503cc86-6bfd-484d-bf29-23ef71e21e91', 188, '', '2023-06-01', '11:10:00', '', '2023-06-01 11:10:00', '', 0, '13.1218417', '80.1494388', 'app', '', '59, Oragadam Rd, Secretariat Colony, Venkatapuram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 251, '2023-06-01 05:40:21', 1),
(325, 'b06e5ffa-dc7b-4509-820b-ab3fc2c84f78', 182, '', '2023-06-01', '11:10:00', '', '2023-06-01 11:10:00', '', 0, '13.1218417', '80.1494388', 'app', '', '59, Oragadam Rd, Secretariat Colony, Venkatapuram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 251, '2023-06-01 05:40:29', 1),
(326, 'd29f28b3-454b-4200-ae3a-0d361d2f01c7', 201, '', '2023-06-02', '10:08:00', '', '2023-06-02 10:08:00', '', 0, '13.0993516', '80.1740608', 'app', '', '101, Periyar Nagar, Mannurpet, Padi, Chennai, Tamil Nadu 600049, India', 48, 34, 300, '2023-06-02 04:38:40', 1),
(327, '60d23175-dd0a-4d39-9f62-1b2298842e5c', 202, '', '2023-06-02', '10:40:00', '', '2023-06-02 10:40:00', '', 0, '13.1001633', '80.1736136', 'app', '', '15, Pillayar Koil St, Periyar Nagar, Mannurpet, Chennai, Tamil Nadu 600050, India', 48, 34, 301, '2023-06-02 05:10:14', 1),
(328, '7be8cbf4-3730-4853-a78d-a7778442fa78', 214, '', '2023-06-02', '11:32:00', '', '2023-06-02 11:32:00', '', 0, '13.1218364', '80.149438', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 75, 49, 320, '2023-06-02 06:02:33', 1),
(329, '819bccf4-bd7f-4509-9dc1-9f9910bd2b3e', 181, '', '2023-06-02', '11:34:00', '', '2023-06-02 11:34:00', '', 0, '13.1218399', '80.149373', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 48, 34, 252, '2023-06-02 06:04:40', 1),
(330, '691d0bdc-28bf-4108-bc9b-d5bd6a579413', 214, '', '2023-06-02', '11:35:00', '', '2023-06-02 11:35:00', '', 0, '13.1218365', '80.1494444', 'app', '', '18, Old Twp Rd, Secretariat Colony, Venkatapuram, Vijayalakshmi Puram, Ambattur, Chennai, Tamil Nadu 600053, India', 75, 49, 320, '2023-06-02 06:05:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch_id` int(11) NOT NULL,
  `branch_uniq_id` varchar(20) NOT NULL,
  `branch_code` varchar(10) NOT NULL,
  `branch_name` varchar(80) NOT NULL,
  `branch_location` varchar(50) NOT NULL,
  `branch_address` text NOT NULL,
  `branch_contact_person` varchar(20) NOT NULL,
  `branch_contact_no` varchar(40) NOT NULL,
  `branch_email` varchar(40) NOT NULL,
  `branch_pin_code` int(15) NOT NULL,
  `branch_company_id` int(11) NOT NULL,
  `branch_added_by` int(11) NOT NULL,
  `branch_added_on` int(11) NOT NULL,
  `branch_added_ip` varchar(20) NOT NULL,
  `branch_modified_by` int(11) NOT NULL,
  `branch_modified_on` int(11) NOT NULL,
  `branch_modified_ip` varchar(20) NOT NULL,
  `branch_deleted_by` int(11) NOT NULL,
  `branch_deleted_on` int(11) NOT NULL,
  `branch_deleted_ip` varchar(20) NOT NULL,
  `branch_active_status` varchar(8) NOT NULL DEFAULT 'active',
  `branch_deleted_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_uniq_id`, `branch_code`, `branch_name`, `branch_location`, `branch_address`, `branch_contact_person`, `branch_contact_no`, `branch_email`, `branch_pin_code`, `branch_company_id`, `branch_added_by`, `branch_added_on`, `branch_added_ip`, `branch_modified_by`, `branch_modified_on`, `branch_modified_ip`, `branch_deleted_by`, `branch_deleted_on`, `branch_deleted_ip`, `branch_active_status`, `branch_deleted_status`) VALUES
(1, 'eeb2ca4cm9b6f8zorlz4', 'ARARARAR51', 'Tiruvannamalai', 'chennai', 'tiruvannamalai-606805', 'rajesh', '467567677678', 'tiru@gmail.com', 76867890, 1, 1, 1686143741, '::1', 1, 1686461113, '::1', 0, 0, '', 'active', 0),
(2, '2815e17cfr2030yyht32', 'AR566', 'Chennai', 'hennai', 'hennai', 'hennai', '0980090', 'hennai@gmali.com', 97990, 1, 3, 1686410377, '::1', 0, 0, '', 0, 0, '', 'active', 0),
(3, '3b35cfeqpfe86efuu4bc', 'ARAR876', 'khvhjhj', '', '', '', '', '', 43535435, 1, 1, 1686419095, '::1', 1, 1688632356, '::1', 0, 0, '', 'active', 0),
(4, '819d111thub8e1p1jicf', 'AR74465', 'fdgsf', '', '', '', '', 'asds@gmail.com', 0, 1, 1, 1686419291, '::1', 0, 0, '', 0, 0, '', 'active', 0),
(5, '1e469d64sd64ffsr8oa2', 'INSACDS', 'sad', '', '', '', '', '', 0, 1, 6, 1686477313, '::1', 0, 0, '', 0, 0, '', 'active', 0),
(6, '82fd81apo1e070aef575', 'ARA0015133', 'durai', '', '', '', '', '', 0, 1, 1, 1686553751, '::1', 0, 0, '', 0, 0, '', 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_uniq_id` varchar(20) NOT NULL,
  `company_code` varchar(10) NOT NULL,
  `company_name` varchar(80) NOT NULL,
  `company_email` varchar(40) NOT NULL,
  `company_contact_no` varchar(40) NOT NULL,
  `company_owner_name` varchar(30) NOT NULL,
  `company_owner_contact_no` varchar(40) NOT NULL,
  `company_license_expiry_date` date NOT NULL,
  `company_address` text NOT NULL,
  `company_pin_code` int(15) NOT NULL,
  `company_added_by` int(11) NOT NULL,
  `company_added_on` int(11) NOT NULL,
  `company_added_ip` varchar(20) NOT NULL,
  `company_modified_by` int(11) NOT NULL,
  `company_modified_on` int(11) NOT NULL,
  `company_modified_ip` varchar(20) NOT NULL,
  `company_deleted_by` int(11) NOT NULL,
  `company_deleted_on` int(11) NOT NULL,
  `company_deleted_ip` varchar(20) NOT NULL,
  `company_active_status` varchar(8) NOT NULL DEFAULT 'active',
  `company_deleted_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_uniq_id`, `company_code`, `company_name`, `company_email`, `company_contact_no`, `company_owner_name`, `company_owner_contact_no`, `company_license_expiry_date`, `company_address`, `company_pin_code`, `company_added_by`, `company_added_on`, `company_added_ip`, `company_modified_by`, `company_modified_on`, `company_modified_ip`, `company_deleted_by`, `company_deleted_on`, `company_deleted_ip`, `company_active_status`, `company_deleted_status`) VALUES
(1, '9f17cdceah89e8fgyyeb', 'ARA001', 'arasoftwares', 'ara@gmail.com', '3565656460', 'ArulJothi', '0809809880', '2023-06-30', 'Chennai-606602', 8878686, 1, 1686143376, '::1', 1, 1688642042, '::1', 0, 0, '', 'active', 0),
(2, 'b85b8503v71bb05vncpb', 'INF001', 'infosys', 'info@gmail.com', '868687687', 'rajesh', '897707709', '2023-06-11', 'chennai', 696969, 1, 1686467404, '::1', 0, 0, '', 0, 0, '', 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_uniq_id` varchar(40) NOT NULL,
  `department_name` varchar(255) NOT NULL COMMENT 'department ',
  `department_company_id` int(11) NOT NULL,
  `department_branch_id` int(11) NOT NULL,
  `department_added_by` int(11) NOT NULL,
  `department_added_on` int(11) NOT NULL,
  `department_added_ip` varchar(20) NOT NULL,
  `department_modified_by` int(11) NOT NULL,
  `department_modified_on` int(11) NOT NULL,
  `department_modified_ip` varchar(20) NOT NULL,
  `department_deleted_by` int(11) NOT NULL,
  `department_deleted_on` int(11) NOT NULL,
  `department_deleted_ip` varchar(20) NOT NULL,
  `department_active_status` varchar(20) NOT NULL DEFAULT 'active' COMMENT 'Status',
  `department_deleted_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_uniq_id`, `department_name`, `department_company_id`, `department_branch_id`, `department_added_by`, `department_added_on`, `department_added_ip`, `department_modified_by`, `department_modified_on`, `department_modified_ip`, `department_deleted_by`, `department_deleted_on`, `department_deleted_ip`, `department_active_status`,`department_deleted_status`) VALUES
(1, '2c353cfw4sf03a95eld5070d1e1ec4b00d81de5c', 'Electrical&amp;Electronics', 1, 1, 1, 1686222235, '::1', 1, 1686477130, '::1', 0, 0, '', 'active', 0, 0),
(2, '0d1da62hkiaab3nya053d08b2c734910c88cf935', 'Electrical&amp;Electronic', 1, 1, 1, 1686477117, '::1', 0, 0, '', 0, 0, '', 'active', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `designation_id` int(11) NOT NULL,
  `designation_uniq_id` varchar(40) NOT NULL,
  `designation_name` varchar(255) NOT NULL COMMENT 'designation ',
  `designation_company_id` int(11) NOT NULL,
  `designation_branch_id` int(11) NOT NULL,
  `designation_added_by` int(11) NOT NULL,
  `designation_added_on` int(11) NOT NULL,
  `designation_added_ip` varchar(20) NOT NULL,
  `designation_modified_by` int(11) NOT NULL,
  `designation_modified_on` int(11) NOT NULL,
  `designation_modified_ip` varchar(20) NOT NULL,
  `designation_deleted_by` int(11) NOT NULL,
  `designation_deleted_on` int(11) NOT NULL,
  `designation_deleted_ip` varchar(20) NOT NULL,
  `designation_active_status` varchar(20) NOT NULL DEFAULT 'active' COMMENT 'Status',
  `designation_deleted_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`designation_id`, `designation_uniq_id`, `designation_name`, `designation_company_id`, `designation_branch_id`, `designation_added_by`, `designation_added_on`, `designation_added_ip`, `designation_modified_by`, `designation_modified_on`, `designation_modified_ip`, `designation_deleted_by`, `designation_deleted_on`, `designation_deleted_ip`, `designation_active_status`, `designation_deleted_status`) VALUES
(1, 'c6f1e5cd2geeab2l9qj1007af5c56f89146bdcac', 'PHPS', 1, 1, 1, 1686219318, '::1', 1, 1686221976, '::1', 0, 0, '', 'active', 0),
(2, 'bbfa85ejvp10fag9ihoeda62b9bcc1e08e943bec', 'Laravel', 1, 1, 1, 1686394345, '::1', 0, 0, '', 0, 0, '', 'active', 0),
(3, 'fe49aa5cqde254ri6hjc25fedfd14236167c7245', 'Andriod', 1, 1, 1, 1686394352, '::1', 0, 0, '', 0, 0, '', 'active', 0),
(4, 'a5f220f70k8927gh40ia9c37562f8c0b6f03418b', 'Andriod', 1, 5, 1, 1686478571, '::1', 0, 0, '', 0, 0, '', 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `employee_uniq_id` varchar(40) NOT NULL,
  `employee_code` varchar(40) NOT NULL,
  `employee_name` varchar(30) NOT NULL,
  `employee_date_of_birth` date NOT NULL,
  `employee_gender` varchar(50) NOT NULL,
  `employee_designation_id` int(11) NOT NULL,
  `employee_department_id` int(11) NOT NULL,
  `employee_contact_no` varchar(40) NOT NULL,
  `employee_email` varchar(255) NOT NULL,
  `employee_date_of_join` date NOT NULL,
  `employee_address` text NOT NULL,
  `employee_register_status` varchar(10) NOT NULL,
  `employee_scan_status` varchar(10) NOT NULL,
  `employee_clear_face_data` varchar(10) NOT NULL,
  `employee_lock_status` varchar(10) NOT NULL,
  `employee_lock_days` int(11) NOT NULL,
  `employee_photo` text NOT NULL,
  `employee_company_id` int(11) NOT NULL,
  `employee_branch_id` int(11) NOT NULL,
  `employee_added_by` int(11) NOT NULL,
  `employee_added_on` int(11) NOT NULL,
  `employee_added_ip` varchar(40) NOT NULL,
  `employee_modified_by` int(11) NOT NULL,
  `employee_modified_on` int(11) NOT NULL,
  `employee_modified_ip` varchar(20) NOT NULL,
  `employee_deleted_by` int(11) NOT NULL,
  `employee_deleted_on` int(11) NOT NULL,
  `employee_deleted_ip` varchar(40) NOT NULL,
  `employee_active_status` varchar(20) NOT NULL DEFAULT 'active',
  `employee_deleted_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_uniq_id`, `employee_code`, `employee_name`, `employee_date_of_birth`, `employee_gender`, `employee_designation_id`, `employee_department_id`, `employee_contact_no`, `employee_email`, `employee_date_of_join`, `employee_address`, `employee_register_status`, `employee_scan_status`, `employee_clear_face_data`, `employee_lock_status`, `employee_lock_days`, `employee_photo`, `employee_company_id`, `employee_branch_id`, `employee_added_by`, `employee_added_on`, `employee_added_ip`, `employee_modified_by`, `employee_modified_on`, `employee_modified_ip`, `employee_deleted_by`, `employee_deleted_on`, `employee_deleted_ip`, `employee_active_status`, `employee_deleted_status`) VALUES
(1, '662f4c1187be5c8u4b6939c1a0b7e28228200774', 'ARTI5133', 'Rajesh', '2023-06-23', 'male', 3, 1, '6554654645', 'rajesh@gmail.com', '2023-06-30', 'Tiruvannamalai', 'yes', 'yes', 'no', 'no', 0, '', 1, 1, 1, 1688644881, '::1', 0, 0, '', 0, 0, '', 'active', 0),
(2, '59f1d783m0e872kzzj538b3e05545412c5a22283', 'ARTI5144', 'rajeshdurai', '0000-00-00', '', 1, 1, '2544245356', '', '0000-00-00', '', '', '', '', '', 0, '', 1, 1, 1, 1687159395, '::1', 0, 0, '', 0, 0, '', 'active', 0),
(3, '5e2fc7ayudf8062m4fma7958c758fc5cae1ec55b', 'E0001', 'rajeshD', '2023-06-01', 'male', 4, 2, '6798769876', 'raj@gmail.com', '0000-00-00', '', '', '', '', '', 0, '', 1, 2, 1, 1687249529, '::1', 0, 0, '', 0, 0, '', 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `financial_years`
--

CREATE TABLE `financial_years` (
  `financial_year_id` int(11) NOT NULL,
  `financial_year_from` varchar(40) NOT NULL,
  `financial_year_to` varchar(40) NOT NULL,
  `financial_year_form_date` date NOT NULL,
  `financial_year_to_date` date NOT NULL,
  `financial_year_delete_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `financial_years`
--

INSERT INTO `financial_years` (`financial_year_id`, `financial_year_from`, `financial_year_to`, `financial_year_form_date`, `financial_year_to_date`, `financial_year_delete_status`) VALUES
(1, '2021', '2022', '2021-04-01', '2022-03-31', 0),
(2, '2022', '2023', '2022-04-01', '2023-03-31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_and_database_details`
--

CREATE TABLE `login_and_database_details` (
  `login_and_databas_id` int(11) NOT NULL,
  `login_and_databas_uniq_id` varchar(40) NOT NULL,
  `login_and_databas_user_name` varchar(255) NOT NULL COMMENT 'login_and_databas',
  `login_and_databas_user_id` int(11) NOT NULL,
  `login_and_databas_update_date_time` datetime NOT NULL,
  `login_and_databas_download_date_time` datetime NOT NULL,
  `login_and_databas_login_date_time` datetime NOT NULL,
  `login_and_databas_logout_date_time` datetime NOT NULL,
  `login_and_databas_type` int(11) NOT NULL,
  `login_and_databas_company_id` int(11) NOT NULL,
  `login_and_databas_branch_id` int(11) NOT NULL,
  `login_and_databas_added_by` int(11) NOT NULL,
  `login_and_databas_added_on` int(11) NOT NULL,
  `login_and_databas_added_ip` varchar(20) NOT NULL,
  `login_and_databas_modified_by` int(11) NOT NULL,
  `login_and_databas_modified_on` int(11) NOT NULL,
  `login_and_databas_modified_ip` varchar(20) NOT NULL,
  `login_and_databas_deleted_by` int(11) NOT NULL,
  `login_and_databas_deleted_on` int(11) NOT NULL,
  `login_and_databas_deleted_ip` varchar(20) NOT NULL,
  `login_and_databas_active_status` varchar(20) NOT NULL DEFAULT 'active' COMMENT 'Status',
  `login_and_databas_block_status` tinyint(1) NOT NULL,
  `login_and_databas_deleted_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`admin_users_id`);

--
-- Indexes for table `attendance_detail`
--
ALTER TABLE `attendance_detail`
  ADD PRIMARY KEY (`attendance_detail_id`),
  ADD UNIQUE KEY `attendance_detail_uniq_id` (`attendance_detail_uniq_id`),
  ADD KEY `attendance_detail_date` (`attendance_detail_date`),
  ADD KEY `attendance_detail_emp_id` (`attendance_detail_emp_id`),
  ADD KEY `attendance_detail_time` (`attendance_detail_time`),
  ADD KEY `attendance_detail_device_id` (`attendance_detail_device_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `employee_branch_id` (`employee_branch_id`),
  ADD KEY `employee_deleted_status` (`employee_deleted_status`),
  ADD KEY `employee_uniq_id` (`employee_uniq_id`),
  ADD KEY `employee_designation_id` (`employee_designation_id`),
  ADD KEY `employee_id` (`employee_id`,`employee_branch_id`,`employee_deleted_status`);

--
-- Indexes for table `financial_years`
--
ALTER TABLE `financial_years`
  ADD PRIMARY KEY (`financial_year_id`);

--
-- Indexes for table `login_and_database_details`
--
ALTER TABLE `login_and_database_details`
  ADD PRIMARY KEY (`login_and_databas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `attendance_detail`
--
ALTER TABLE `attendance_detail`
  MODIFY `attendance_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `financial_years`
--
ALTER TABLE `financial_years`
  MODIFY `financial_year_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_and_database_details`
--
ALTER TABLE `login_and_database_details`
  MODIFY `login_and_databas_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
