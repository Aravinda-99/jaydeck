-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2020 at 09:43 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jaydeck`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(199) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `main_cat_id` int(11) NOT NULL,
  `sub_cat_1_id` int(11) DEFAULT NULL,
  `sub_cat_2_id` int(11) DEFAULT NULL,
  `brand_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0 COMMENT '0=inactive/1=active',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `slug`, `description`, `image`, `main_cat_id`, `sub_cat_1_id`, `sub_cat_2_id`, `brand_id`, `active`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '811D', 'PRO_10001', '811d-1', NULL, 'assets/uploads/products/main_image/sp3kpFxjVP.png', 1, 10, NULL, NULL, 1, 1, '2020-09-21 06:46:22', '2020-09-21 06:46:22', NULL),
(2, '866', 'PRO_10002', '866-2', NULL, 'assets/uploads/products/main_image/nfBWZ8sV2f.png', 1, 10, NULL, NULL, 1, 1, '2020-09-21 06:47:31', '2020-09-21 06:47:31', NULL),
(3, 'CD', 'PRO_10003', 'cd-3', NULL, 'assets/uploads/products/main_image/CRXtuC0tG2.png', 1, 10, NULL, NULL, 1, 1, '2020-09-21 06:48:17', '2020-09-21 06:48:17', NULL),
(4, 'Alaska', 'PRO_10004', 'alaska-4', NULL, 'assets/uploads/products/main_image/aKNimkTCER.png', 1, 11, 12, NULL, 1, 1, '2020-09-21 06:55:51', '2020-09-21 06:55:51', NULL),
(5, 'DC212', 'PRO_10005', 'dc212-5', NULL, 'assets/uploads/products/main_image/67fWYAnFNZ.png', 1, 11, 12, NULL, 1, 1, '2020-09-21 06:57:26', '2020-09-21 06:57:26', NULL),
(6, 'DC213', 'PRO_10006', 'dc213-6', NULL, 'assets/uploads/products/main_image/gv6nYp4eH0.png', 1, 11, 12, NULL, 1, 1, '2020-09-21 06:59:43', '2020-09-21 06:59:43', NULL),
(7, 'Lake', 'PRO_10007', 'lake-7', NULL, 'assets/uploads/products/main_image/cXstdn1nw8.png', 1, 11, 12, NULL, 1, 1, '2020-09-21 07:01:33', '2020-09-21 07:01:33', NULL),
(8, 'Landscape', 'PRO_10008', 'landscape-8', NULL, 'assets/uploads/products/main_image/3i0H0W1epH.png', 1, 11, 12, NULL, 1, 1, '2020-09-21 07:04:40', '2020-09-21 07:04:40', NULL),
(9, 'Versailles', 'PRO_10009', 'versailles-9', NULL, 'assets/uploads/products/main_image/hYD1PYpDKQ.png', 1, 11, 12, NULL, 1, 1, '2020-09-21 07:06:08', '2020-09-21 07:06:08', NULL),
(10, 'Meteor', 'PRO_10010', 'meteor-10', NULL, 'assets/uploads/products/main_image/nlfFLFzEl5.png', 1, 11, 13, NULL, 1, 1, '2020-09-21 07:08:56', '2020-09-21 07:08:56', NULL),
(11, 'Ocean', 'PRO_10011', 'ocean-11', NULL, 'assets/uploads/products/main_image/M0E6fjsjYf.png', 1, 11, 13, NULL, 1, 1, '2020-09-21 07:12:03', '2020-09-21 07:12:03', NULL),
(12, 'Alps', 'PRO_10012', 'alps-12', NULL, 'assets/uploads/products/main_image/8mLKEUiz9y.png', 1, 11, 14, NULL, 1, 1, '2020-09-21 07:14:41', '2020-09-21 07:14:41', NULL),
(13, 'DC124', 'PRO_10013', 'dc124-13', NULL, 'assets/uploads/products/main_image/bMuDs3XMeQ.png', 1, 11, 15, NULL, 1, 1, '2020-09-21 07:19:48', '2020-09-21 07:19:48', NULL),
(14, 'DC125', 'PRO_10014', 'dc125-14', NULL, 'assets/uploads/products/main_image/jphl9H4pXh.png', 1, 11, 14, NULL, 1, 1, '2020-09-21 07:21:28', '2020-09-21 07:21:28', NULL),
(15, 'DC126', 'PRO_10015', 'dc126-15', NULL, 'assets/uploads/products/main_image/swMjWcSaQT.png', 1, 11, 14, NULL, 1, 1, '2020-09-21 07:32:26', '2020-09-21 07:32:26', NULL),
(16, 'DC127', 'PRO_10016', 'dc127-16', NULL, 'assets/uploads/products/main_image/Bl3b2zYAMC.png', 1, 11, 14, NULL, 1, 1, '2020-09-21 07:33:50', '2020-09-21 07:33:50', NULL),
(17, 'DC160', 'PRO_10017', 'dc160-17', NULL, 'assets/uploads/products/main_image/INTYLvH1LH.png', 1, 11, 14, NULL, 1, 1, '2020-09-21 07:38:49', '2020-09-21 07:38:49', NULL),
(18, 'DC161', 'PRO_10018', 'dc161-18', NULL, 'assets/uploads/products/main_image/Z0UxtNtLQx.png', 1, 11, 14, NULL, 1, 1, '2020-09-21 08:03:08', '2020-09-21 08:03:08', NULL),
(19, 'Hollywood', 'PRO_10019', 'hollywood-19', NULL, 'assets/uploads/products/main_image/WWmrSh9p1X.png', 1, 11, 14, NULL, 1, 1, '2020-09-21 08:04:16', '2020-09-21 08:04:16', NULL),
(20, 'Impress', 'PRO_10020', 'impress-20', NULL, 'assets/uploads/products/main_image/giTyMCzvq3.png', 1, 11, 14, NULL, 1, 1, '2020-09-21 08:05:32', '2020-09-21 08:05:32', NULL),
(21, 'Melbourne', 'PRO_10021', 'melbourne-21', NULL, 'assets/uploads/products/main_image/MbHHw3SDSd.png', 1, 11, 14, NULL, 1, 1, '2020-09-21 08:06:50', '2020-09-21 08:06:50', NULL),
(22, 'Rain', 'PRO_10022', 'rain-22', NULL, 'assets/uploads/products/main_image/xAMOIct5b2.png', 1, 11, 14, NULL, 1, 1, '2020-09-21 08:08:33', '2020-09-21 08:08:33', NULL),
(23, 'River H', 'PRO_10023', 'river-h-23', NULL, 'assets/uploads/products/main_image/PnR7EmjcUD.png', 1, 11, 14, NULL, 1, 1, '2020-09-21 08:11:42', '2020-09-21 08:11:42', NULL),
(24, 'River J', 'PRO_10024', 'river-j-24', NULL, 'assets/uploads/products/main_image/6pZUxjMLfB.png', 1, 11, 14, NULL, 1, 1, '2020-09-21 08:14:13', '2020-09-21 08:14:13', NULL),
(25, 'Roma', 'PRO_10025', 'roma-25', NULL, 'assets/uploads/products/main_image/5jXNXNkx1x.png', 1, 11, 14, NULL, 1, 1, '2020-09-21 08:19:18', '2020-09-21 08:19:18', NULL),
(26, 'Sicily', 'PRO_10026', 'sicily-26', NULL, 'assets/uploads/products/main_image/1tX77lXdKu.png', 1, 11, 14, NULL, 1, 1, '2020-09-21 08:21:19', '2020-09-21 08:21:19', NULL),
(27, 'Zurich', 'PRO_10027', 'zurich-27', NULL, 'assets/uploads/products/main_image/zB6eM8POHn.png', 1, 11, 14, NULL, 1, 1, '2020-09-21 08:23:59', '2020-09-21 08:23:59', NULL),
(28, 'Aurora', 'PRO_10028', 'aurora-28', NULL, 'assets/uploads/products/main_image/zNTL6lWmT7.png', 1, 11, 15, NULL, 1, 1, '2020-09-21 08:39:35', '2020-09-21 08:39:35', NULL),
(29, 'Chennai', 'PRO_10029', 'chennai-29', NULL, 'assets/uploads/products/main_image/p0Q74Cbr87.png', 1, 11, 15, NULL, 1, 1, '2020-09-21 08:43:13', '2020-09-21 08:43:13', NULL),
(30, 'Cloudbay', 'PRO_10030', 'cloudbay-30', NULL, 'assets/uploads/products/main_image/cxE9hHYIxq.png', 1, 11, 15, NULL, 1, 1, '2020-09-21 08:44:50', '2020-09-21 08:44:50', NULL),
(31, 'DC105', 'PRO_10031', 'dc105-31', NULL, 'assets/uploads/products/main_image/PJ75MGHK7x.png', 1, 11, 15, NULL, 1, 1, '2020-09-21 08:47:34', '2020-09-21 08:47:34', NULL),
(32, 'DC107', 'PRO_10032', 'dc107-32', NULL, 'assets/uploads/products/main_image/6K7JfNDeeq.png', 1, 11, 15, NULL, 1, 1, '2020-09-21 08:53:04', '2020-09-21 08:53:04', NULL),
(33, 'Forest', 'PRO_10033', 'forest-33', NULL, 'assets/uploads/products/main_image/y1SiJK4QHy.png', 1, 11, 15, NULL, 1, 1, '2020-09-21 08:56:35', '2020-09-21 09:01:16', NULL),
(34, 'Hokkaido', 'PRO_10034', 'hokkaido-34', NULL, 'assets/uploads/products/main_image/smGzOlYTIh.png', 1, 11, 15, NULL, 1, 1, '2020-09-21 09:03:26', '2020-09-21 09:03:26', NULL),
(35, 'Spring', 'PRO_10035', 'spring-35', NULL, 'assets/uploads/products/main_image/sdedVD3MDa.png', 1, 11, 15, NULL, 1, 1, '2020-09-21 09:04:39', '2020-09-21 09:04:39', NULL),
(36, 'Star Field', 'PRO_10036', 'star-field-36', NULL, 'assets/uploads/products/main_image/KVXFk6cKjT.png', 1, 11, 15, NULL, 1, 1, '2020-09-21 09:05:41', '2020-09-21 09:05:41', NULL),
(37, 'Starline', 'PRO_10037', 'starline-37', NULL, 'assets/uploads/products/main_image/ueAxyf7A9n.png', 1, 11, 15, NULL, 1, 1, '2020-09-21 09:06:50', '2020-09-21 09:06:50', NULL),
(38, 'Summer', 'PRO_10038', 'summer-38', NULL, 'assets/uploads/products/main_image/YBAfiI1nuk.png', 1, 11, 15, NULL, 1, 1, '2020-09-21 09:08:42', '2020-09-21 09:08:42', NULL),
(39, 'Vienna', 'PRO_10039', 'vienna-39', NULL, 'assets/uploads/products/main_image/7noU8AIBD9.png', 1, 11, 15, NULL, 1, 1, '2020-09-21 09:13:52', '2020-09-21 09:13:52', NULL),
(40, 'Aluminium partition and doors-windows_1', 'PRO_10040', 'aluminium-partition-and-doors-windows-1-40', NULL, 'assets/uploads/products/main_image/NGiccL6EAp.png', 2, NULL, NULL, NULL, 1, 1, '2020-09-21 09:16:45', '2020-09-21 09:16:45', NULL),
(41, 'Ceiling systems_1', 'PRO_10041', 'ceiling-systems-1-41', NULL, 'assets/uploads/products/main_image/o9oXtu9piB.png', 3, NULL, NULL, NULL, 1, 1, '2020-09-21 09:17:56', '2020-09-21 09:17:56', NULL),
(42, 'Door matting heavy duty_1', 'PRO_10042', 'door-matting-heavy-duty-1-42', NULL, 'assets/uploads/products/main_image/kt5nrApDoQ.png', 4, NULL, NULL, NULL, 1, 1, '2020-09-21 09:20:00', '2020-09-21 09:20:00', NULL),
(43, 'Vinyl plank floorings_1', 'PRO_10043', 'vinyl-plank-floorings-1-43', NULL, 'assets/uploads/products/main_image/4s8SK0Y3XN.png', 5, NULL, NULL, NULL, 1, 1, '2020-09-21 09:22:13', '2020-09-21 09:22:13', NULL),
(44, 'Window blinds_1', 'PRO_10044', 'window-blinds-1-44', NULL, 'assets/uploads/products/main_image/GsCHgNDb6B.png', 6, NULL, NULL, NULL, 1, 1, '2020-09-21 09:23:24', '2020-09-21 09:23:24', NULL),
(45, 'office chair Fabric-Mesh type_', 'PRO_10045', 'office-chair-fabric-mesh-type-45', NULL, 'assets/uploads/products/main_image/d51OcqG1f3.png', 7, NULL, NULL, NULL, 1, 1, '2020-09-21 09:24:44', '2020-09-28 06:16:18', '2020-09-28 06:16:18'),
(46, 'Floor sealants_1', 'PRO_10046', 'floor-sealants-1-46', NULL, 'assets/uploads/products/main_image/jjbP4f7mLN.png', 8, NULL, NULL, NULL, 1, 1, '2020-09-21 09:25:34', '2020-09-21 09:25:34', NULL),
(47, 'Turn-Key Project interiors_1', 'PRO_10047', 'turn-key-project-interiors-1-47', NULL, 'assets/uploads/products/main_image/HoSkXQOMLu.png', 9, NULL, NULL, NULL, 1, 1, '2020-09-21 09:28:00', '2020-09-21 09:28:00', NULL),
(48, 'AN 27H', 'PRO_10048', 'an-27h-48', NULL, 'assets/uploads/products/main_image/kl0Ew7V132.png', 7, NULL, NULL, NULL, 1, 1, '2020-09-28 06:15:56', '2020-09-28 06:15:56', NULL),
(49, 'AN 27M', 'PRO_10049', 'an-27m-49', NULL, 'assets/uploads/products/main_image/D6CENMseCA.png', 7, NULL, NULL, NULL, 1, 1, '2020-09-28 06:18:02', '2020-09-28 06:18:02', NULL),
(50, 'AN27L', 'PRO_10050', 'an27l-50', NULL, 'assets/uploads/products/main_image/WeGM3eQCnQ.png', 7, NULL, NULL, NULL, 1, 1, '2020-09-28 06:18:44', '2020-09-28 06:18:44', NULL),
(51, 'Computer arm Chair 609', 'PRO_10051', 'computer-arm-chair-609-51', NULL, 'assets/uploads/products/main_image/eMxFv4XOpc.png', 7, NULL, NULL, NULL, 1, 1, '2020-09-28 06:19:23', '2020-09-28 06:19:23', NULL),
(52, 'EB 884', 'PRO_10052', 'eb-884-52', NULL, 'assets/uploads/products/main_image/xlP4J4XZGc.png', 7, NULL, NULL, NULL, 1, 1, '2020-09-28 06:20:38', '2020-09-28 06:20:38', NULL),
(53, 'Mesh chair - M', 'PRO_10053', 'mesh-chair-m-53', NULL, 'assets/uploads/products/main_image/Rcp2Mt64Ni.png', 7, NULL, NULL, NULL, 1, 1, '2020-09-28 06:21:28', '2020-09-28 06:21:28', NULL),
(54, 'Mesh High back chair', 'PRO_10054', 'mesh-high-back-chair-54', NULL, 'assets/uploads/products/main_image/3kKeRFVty6.png', 7, NULL, NULL, NULL, 1, 1, '2020-09-28 06:22:28', '2020-09-28 06:22:28', NULL),
(55, 'Mesh Visitor chair', 'PRO_10055', 'mesh-visitor-chair-55', NULL, 'assets/uploads/products/main_image/Y64PwNU46q.png', 7, NULL, NULL, NULL, 1, 1, '2020-09-28 06:23:36', '2020-09-28 06:23:36', NULL),
(56, 'Plastic Shell Chair', 'PRO_10056', 'plastic-shell-chair-56', NULL, 'assets/uploads/products/main_image/5TrAx5m27O.png', 7, NULL, NULL, NULL, 1, 1, '2020-09-28 06:27:08', '2020-09-28 06:27:08', NULL),
(57, 'Smale Visitor Chairs1', 'PRO_10057', 'smale-visitor-chairs1-57', NULL, 'assets/uploads/products/main_image/vWfJbVNGGC.png', 7, NULL, NULL, NULL, 1, 1, '2020-09-28 06:28:02', '2020-09-28 06:28:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `category_level` int(11) NOT NULL COMMENT '0-main/ 1-sub1/ 2-sub2',
  `image` varchar(199) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `display_order` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `description`, `parent_id`, `category_level`, `image`, `active`, `display_order`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Wall to Wall carpet and Tiles', NULL, NULL, 0, 'assets/uploads/categories/main_image/Fq5Q1RY69n.png', 1, 3, 1, '2020-09-21 06:13:08', '2020-09-21 06:13:08', NULL),
(2, 'Aluminium partition ', NULL, NULL, 0, 'assets/uploads/categories/main_image/V8GZJ4cexL.png', 1, 1, 1, '2020-09-21 06:15:53', '2020-09-21 06:15:53', NULL),
(3, 'Ceiling systems', NULL, NULL, 0, 'assets/uploads/categories/main_image/zThMefWyJ0.png', 1, 2, 1, '2020-09-21 06:17:40', '2020-09-21 06:18:03', NULL),
(4, 'Door Matting Heavy Duty', NULL, NULL, 0, 'assets/uploads/categories/main_image/54W14UEVfZ.png', 1, NULL, 1, '2020-09-21 06:20:26', '2020-10-15 07:29:18', '2020-10-15 07:29:18'),
(5, 'HDF Floors & Vinyl Planks and Sheets', NULL, NULL, 0, 'assets/uploads/categories/main_image/uwnT4jaElE.png', 1, 4, 1, '2020-09-21 06:22:14', '2020-09-21 06:22:14', NULL),
(6, 'Window Blinds', NULL, NULL, 0, 'assets/uploads/categories/main_image/Hiiyd9KVlg.png', 1, 7, 1, '2020-09-21 06:23:09', '2020-09-21 06:23:09', NULL),
(7, 'Office Chairs ', NULL, NULL, 0, 'assets/uploads/categories/main_image/oAp4uCOcXu.png', 1, 5, 1, '2020-09-21 06:24:00', '2020-09-21 06:24:00', NULL),
(8, 'Floor Sealants', NULL, NULL, 0, 'assets/uploads/categories/main_image/ErlYB5eFIU.png', 1, 6, 1, '2020-09-21 06:24:50', '2020-10-15 07:28:21', NULL),
(9, 'Turn-Key Project Interiors', NULL, NULL, 0, 'assets/uploads/categories/main_image/PTDQhywlYs.png', 1, NULL, 1, '2020-09-21 06:25:28', '2020-10-15 07:26:51', '2020-10-15 07:26:51'),
(10, 'Carpet Roll', NULL, 1, 1, '', 1, NULL, 1, '2020-09-21 06:26:38', '2020-09-21 06:26:38', NULL),
(11, 'Carpet Tiles', NULL, 1, 1, '', 1, NULL, 1, '2020-09-21 06:27:22', '2020-09-21 06:27:22', NULL),
(12, 'Nylon+PVC Backing', NULL, 11, 2, '', 1, NULL, 1, '2020-09-21 06:28:15', '2020-09-21 06:28:15', NULL),
(13, 'Polyester+PVC Backing', NULL, 11, 2, '', 1, NULL, 1, '2020-09-21 06:28:49', '2020-09-21 06:28:49', NULL),
(14, 'PP+ Bitumen Backing', NULL, 11, 2, '', 1, NULL, 1, '2020-09-21 06:29:13', '2020-09-21 06:29:13', NULL),
(15, 'PP+ PVC Backing', NULL, 11, 2, '', 1, NULL, 1, '2020-09-21 06:29:36', '2020-09-21 06:29:36', NULL),
(16, 'Wall Cladding', NULL, NULL, 0, 'assets/uploads/categories/main_image/3NhLkJrKa8.png', 1, 8, 1, '2020-10-15 07:31:31', '2020-10-15 07:31:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `img_src` varchar(199) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `img_src`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'assets/uploads/products/product 1/images/iFv07m9Gvh.jpg', '2020-09-21 09:35:41', '2020-09-21 09:35:41', '2020-09-21 09:35:41'),
(2, 1, 'assets/uploads/products/product 1/images/tbuYv5hTS8.jpg', '2020-09-21 09:35:41', '2020-09-21 09:35:41', '2020-09-21 09:35:41'),
(3, 1, 'assets/uploads/products/product 1/images/m80Fs3c6rP.jpg', '2020-09-21 09:35:41', '2020-09-21 09:35:41', '2020-09-21 09:35:41'),
(4, 1, 'assets/uploads/products/product 1/images/KzNRnAxxK9.jpg', '2020-09-21 09:35:41', '2020-09-21 09:35:41', '2020-09-21 09:35:41'),
(5, 1, 'assets/uploads/products/product 1/images/7avk1Y3zFx.jpg', '2020-09-21 09:35:41', '2020-09-21 09:35:41', '2020-09-21 09:35:41'),
(6, 2, 'assets/uploads/products/product 2/images/1EuhXjeIz1.jpg', '2020-09-21 09:37:14', '2020-09-21 09:37:14', '2020-09-21 09:37:14'),
(7, 2, 'assets/uploads/products/product 2/images/nFENUYOHSY.jpg', '2020-09-21 09:37:14', '2020-09-21 09:37:14', '2020-09-21 09:37:14'),
(8, 2, 'assets/uploads/products/product 2/images/GMsJoplt9L.jpg', '2020-09-21 09:37:14', '2020-09-21 09:37:14', '2020-09-21 09:37:14'),
(9, 2, 'assets/uploads/products/product 2/images/jKGB8ajHMJ.jpg', '2020-09-21 09:37:14', '2020-09-21 09:37:14', '2020-09-21 09:37:14'),
(10, 2, 'assets/uploads/products/product 2/images/TtWpInu1pT.jpg', '2020-09-21 09:37:14', '2020-09-21 09:37:14', '2020-09-21 09:37:14'),
(11, 2, 'assets/uploads/products/product 2/images/Y0huZo1mqI.jpg', '2020-09-21 09:37:14', '2020-09-21 09:37:14', '2020-09-21 09:37:14'),
(12, 4, 'assets/uploads/products/product 4/images/J1in0yEr0y.jpg', '2020-09-21 09:41:17', '2020-09-21 09:41:17', '2020-09-21 09:41:17'),
(13, 4, 'assets/uploads/products/product 4/images/xCxdtScGz1.jpg', '2020-09-21 09:41:17', '2020-09-21 09:41:17', '2020-09-21 09:41:17'),
(14, 4, 'assets/uploads/products/product 4/images/MUuCTlc8F3.jpg', '2020-09-21 09:41:17', '2020-09-21 09:41:17', '2020-09-21 09:41:17'),
(15, 4, 'assets/uploads/products/product 4/images/wTXe395gmE.jpg', '2020-09-21 09:41:17', '2020-09-21 09:41:17', '2020-09-21 09:41:17'),
(16, 4, 'assets/uploads/products/product 4/images/nLGbRkYYVi.jpg', '2020-09-21 09:41:17', '2020-09-21 09:41:17', '2020-09-21 09:41:17'),
(17, 4, 'assets/uploads/products/product 4/images/FKgCHA33RS.jpg', '2020-09-21 09:41:17', '2020-09-21 09:41:17', '2020-09-21 09:41:17'),
(18, 4, 'assets/uploads/products/product 4/images/50qVCPdMgn.jpg', '2020-09-21 09:41:17', '2020-09-21 09:41:17', '2020-09-21 09:41:17'),
(19, 4, 'assets/uploads/products/product 4/images/NXiew8xLcU.jpg', '2020-09-21 09:41:17', '2020-09-21 09:41:17', '2020-09-21 09:41:17'),
(20, 4, 'assets/uploads/products/product 4/images/hnkiN3YXSt.jpg', '2020-09-21 09:41:17', '2020-09-21 09:41:17', '2020-09-21 09:41:17'),
(21, 5, 'assets/uploads/products/product 5/images/6H8LCkOCmR.jpg', '2020-09-21 09:45:23', '2020-09-21 09:45:23', '2020-09-21 09:45:23'),
(22, 5, 'assets/uploads/products/product 5/images/cOhO99Qqed.jpg', '2020-09-21 09:45:23', '2020-09-21 09:45:23', '2020-09-21 09:45:23'),
(23, 5, 'assets/uploads/products/product 5/images/x4WSWedczP.jpg', '2020-09-21 09:45:23', '2020-09-21 09:45:23', '2020-09-21 09:45:23'),
(24, 5, 'assets/uploads/products/product 5/images/a28wqEtxKj.jpg', '2020-09-21 09:45:23', '2020-09-21 09:45:23', '2020-09-21 09:45:23'),
(25, 5, 'assets/uploads/products/product 5/images/0GwALkNqjr.jpg', '2020-09-21 09:45:23', '2020-09-21 09:45:23', '2020-09-21 09:45:23'),
(26, 5, 'assets/uploads/products/product 5/images/P4XTJZzmKi.jpg', '2020-09-21 09:45:23', '2020-09-21 09:45:23', '2020-09-21 09:45:23'),
(27, 6, 'assets/uploads/products/product 6/images/A0sLKtduaO.jpg', '2020-09-21 09:46:04', '2020-09-21 09:46:04', '2020-09-21 09:46:04'),
(28, 6, 'assets/uploads/products/product 6/images/D9ZImwHfF7.jpg', '2020-09-21 09:46:04', '2020-09-21 09:46:04', '2020-09-21 09:46:04'),
(29, 6, 'assets/uploads/products/product 6/images/6CHJfuUEFw.jpg', '2020-09-21 09:46:04', '2020-09-21 09:46:04', '2020-09-21 09:46:04'),
(30, 6, 'assets/uploads/products/product 6/images/ztNiYurpNB.jpg', '2020-09-21 09:46:04', '2020-09-21 09:46:04', '2020-09-21 09:46:04'),
(31, 6, 'assets/uploads/products/product 6/images/Nt6tQXkMa5.jpg', '2020-09-21 09:46:04', '2020-09-21 09:46:04', '2020-09-21 09:46:04'),
(32, 6, 'assets/uploads/products/product 6/images/eEUsKeDbGt.jpg', '2020-09-21 09:46:04', '2020-09-21 09:46:04', '2020-09-21 09:46:04'),
(33, 7, 'assets/uploads/products/product 7/images/ka6o3Y6bd9.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', '2020-09-21 09:47:50'),
(34, 7, 'assets/uploads/products/product 7/images/7cYcVCWpP4.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', '2020-09-21 09:47:50'),
(35, 7, 'assets/uploads/products/product 7/images/XlzDbRtml2.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', '2020-09-21 09:47:50'),
(36, 7, 'assets/uploads/products/product 7/images/SE6SSF7UyV.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', '2020-09-21 09:47:50'),
(37, 7, 'assets/uploads/products/product 7/images/H58bO6b5HC.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', '2020-09-21 09:47:50'),
(38, 7, 'assets/uploads/products/product 7/images/v99atA5FH1.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', '2020-09-21 09:47:50'),
(39, 7, 'assets/uploads/products/product 7/images/Qz3Rj6M9R9.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', '2020-09-21 09:47:50'),
(40, 7, 'assets/uploads/products/product 7/images/9L9QULFYnq.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', '2020-09-21 09:47:50'),
(41, 7, 'assets/uploads/products/product 7/images/7Imlu4PXdP.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', '2020-09-21 09:47:50'),
(42, 7, 'assets/uploads/products/product 7/images/GPz7nXMwnF.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', '2020-09-21 09:47:50'),
(43, 8, 'assets/uploads/products/product 8/images/V8330Ha3Jc.jpg', '2020-09-21 10:00:10', '2020-09-21 10:00:10', '2020-09-21 10:00:10'),
(44, 8, 'assets/uploads/products/product 8/images/CQxy6KxVV0.jpg', '2020-09-21 10:00:10', '2020-09-21 10:00:10', '2020-09-21 10:00:10'),
(45, 8, 'assets/uploads/products/product 8/images/WXorqArDo7.jpg', '2020-09-21 10:00:10', '2020-09-21 10:00:10', '2020-09-21 10:00:10'),
(46, 8, 'assets/uploads/products/product 8/images/HpabgVhw3K.jpg', '2020-09-21 10:00:10', '2020-09-21 10:00:10', '2020-09-21 10:00:10'),
(47, 8, 'assets/uploads/products/product 8/images/elGuHGqmN0.jpg', '2020-09-21 10:00:10', '2020-09-21 10:00:10', '2020-09-21 10:00:10'),
(48, 8, 'assets/uploads/products/product 8/images/cBS8KIFZaP.jpg', '2020-09-21 10:00:10', '2020-09-21 10:00:10', '2020-09-21 10:00:10'),
(49, 8, 'assets/uploads/products/product 8/images/Q5ZTAkMAxt.jpg', '2020-09-21 10:00:10', '2020-09-21 10:00:10', '2020-09-21 10:00:10'),
(50, 9, 'assets/uploads/products/product 9/images/w3KcmilzD8.jpg', '2020-09-21 10:00:49', '2020-09-21 10:00:49', '2020-09-21 10:00:49'),
(51, 9, 'assets/uploads/products/product 9/images/8rauqpOFZR.jpg', '2020-09-21 10:00:49', '2020-09-21 10:00:49', '2020-09-21 10:00:49'),
(52, 9, 'assets/uploads/products/product 9/images/O8kGTH0rpx.jpg', '2020-09-21 10:00:49', '2020-09-21 10:00:49', '2020-09-21 10:00:49'),
(53, 9, 'assets/uploads/products/product 9/images/ZAaxcwXmTh.jpg', '2020-09-21 10:00:49', '2020-09-21 10:00:49', '2020-09-21 10:00:49'),
(54, 9, 'assets/uploads/products/product 9/images/SKzWZLm4Wc.jpg', '2020-09-21 10:00:49', '2020-09-21 10:00:49', '2020-09-21 10:00:49'),
(55, 9, 'assets/uploads/products/product 9/images/6QLo02PQ6M.jpg', '2020-09-21 10:00:49', '2020-09-21 10:00:49', '2020-09-21 10:00:49'),
(56, 10, 'assets/uploads/products/product 10/images/XZAFgeJm6s.jpg', '2020-09-21 10:03:15', '2020-09-21 10:03:15', '2020-09-21 10:03:15'),
(57, 10, 'assets/uploads/products/product 10/images/cOXrjJ85qp.jpg', '2020-09-21 10:03:15', '2020-09-21 10:03:15', '2020-09-21 10:03:15'),
(58, 10, 'assets/uploads/products/product 10/images/9rCiynuyA2.jpg', '2020-09-21 10:03:15', '2020-09-21 10:03:15', '2020-09-21 10:03:15'),
(59, 10, 'assets/uploads/products/product 10/images/gqjoPRtmCs.jpg', '2020-09-21 10:03:15', '2020-09-21 10:03:15', '2020-09-21 10:03:15'),
(60, 10, 'assets/uploads/products/product 10/images/6pAkH26n8V.jpg', '2020-09-21 10:03:15', '2020-09-21 10:03:15', '2020-09-21 10:03:15'),
(61, 10, 'assets/uploads/products/product 10/images/2s916fsFaS.jpg', '2020-09-21 10:03:15', '2020-09-21 10:03:15', '2020-09-21 10:03:15'),
(62, 11, 'assets/uploads/products/product 11/images/782hosdC1M.jpg', '2020-09-21 10:04:04', '2020-09-21 10:04:04', '2020-09-21 10:04:04'),
(63, 11, 'assets/uploads/products/product 11/images/qrgPSjh4Kl.jpg', '2020-09-21 10:04:04', '2020-09-21 10:04:04', '2020-09-21 10:04:04'),
(64, 11, 'assets/uploads/products/product 11/images/DFVSHfrcr8.jpg', '2020-09-21 10:04:04', '2020-09-21 10:04:04', '2020-09-21 10:04:04'),
(65, 11, 'assets/uploads/products/product 11/images/6YZGB2kgoM.jpg', '2020-09-21 10:04:04', '2020-09-21 10:04:04', '2020-09-21 10:04:04'),
(66, 11, 'assets/uploads/products/product 11/images/vHdhQgoorP.jpg', '2020-09-21 10:04:04', '2020-09-21 10:04:04', '2020-09-21 10:04:04'),
(67, 11, 'assets/uploads/products/product 11/images/cdunGlkrgC.jpg', '2020-09-21 10:04:04', '2020-09-21 10:04:04', '2020-09-21 10:04:04'),
(68, 11, 'assets/uploads/products/product 11/images/VBmxVoeerG.jpg', '2020-09-21 10:04:04', '2020-09-21 10:04:04', '2020-09-21 10:04:04'),
(69, 11, 'assets/uploads/products/product 11/images/WMcAth0kqv.jpg', '2020-09-21 10:04:04', '2020-09-21 10:04:04', '2020-09-21 10:04:04'),
(70, 12, 'assets/uploads/products/product 12/images/xbyEjsvi0n.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', '2020-09-21 10:05:28'),
(71, 12, 'assets/uploads/products/product 12/images/jAOK96ED67.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', '2020-09-21 10:05:28'),
(72, 12, 'assets/uploads/products/product 12/images/ePBwv4Rw7z.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', '2020-09-21 10:05:28'),
(73, 12, 'assets/uploads/products/product 12/images/Ztr6KbeUKw.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', '2020-09-21 10:05:28'),
(74, 12, 'assets/uploads/products/product 12/images/0DhmFaoSqD.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', '2020-09-21 10:05:28'),
(75, 12, 'assets/uploads/products/product 12/images/hUEBhDTjMW.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', '2020-09-21 10:05:28'),
(76, 12, 'assets/uploads/products/product 12/images/QBPS13Uk0m.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', '2020-09-21 10:05:28'),
(77, 12, 'assets/uploads/products/product 12/images/jRo6JdiECK.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', '2020-09-21 10:05:28'),
(78, 12, 'assets/uploads/products/product 12/images/LTvq2XgxVb.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', '2020-09-21 10:05:28'),
(79, 12, 'assets/uploads/products/product 12/images/mW9Jeepzxc.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', '2020-09-21 10:05:28'),
(80, 13, 'assets/uploads/products/product 13/images/OllTlr4S2F.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', '2020-09-21 10:06:47'),
(81, 13, 'assets/uploads/products/product 13/images/43nE9t2ycx.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', '2020-09-21 10:06:47'),
(82, 13, 'assets/uploads/products/product 13/images/4astbYVXcB.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', '2020-09-21 10:06:47'),
(83, 13, 'assets/uploads/products/product 13/images/JUpO0Lf9Eh.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', '2020-09-21 10:06:47'),
(84, 13, 'assets/uploads/products/product 13/images/nsUWv2KKuL.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', '2020-09-21 10:06:47'),
(85, 13, 'assets/uploads/products/product 13/images/Gp51trweiN.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', '2020-09-21 10:06:47'),
(86, 13, 'assets/uploads/products/product 13/images/Zz9KTP5UAY.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', '2020-09-21 10:06:47'),
(87, 13, 'assets/uploads/products/product 13/images/FnNa3muBOs.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', '2020-09-21 10:06:47'),
(88, 13, 'assets/uploads/products/product 13/images/GHWaSGskL3.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', '2020-09-21 10:06:47'),
(89, 14, 'assets/uploads/products/product 14/images/XsET59XdAd.jpg', '2020-09-21 10:09:05', '2020-09-21 10:09:05', '2020-09-21 10:09:05'),
(90, 14, 'assets/uploads/products/product 14/images/cGX1dlW5eD.jpg', '2020-09-21 10:09:05', '2020-09-21 10:09:05', '2020-09-21 10:09:05'),
(91, 14, 'assets/uploads/products/product 14/images/fqjxLHhLNB.jpg', '2020-09-21 10:09:05', '2020-09-21 10:09:05', '2020-09-21 10:09:05'),
(92, 14, 'assets/uploads/products/product 14/images/pSQmnWs8o7.jpg', '2020-09-21 10:09:05', '2020-09-21 10:09:05', '2020-09-21 10:09:05'),
(93, 14, 'assets/uploads/products/product 14/images/76xCcXFi9V.jpg', '2020-09-21 10:09:05', '2020-09-21 10:09:05', '2020-09-21 10:09:05'),
(94, 14, 'assets/uploads/products/product 14/images/XCvIZUkwFb.jpg', '2020-09-21 10:09:05', '2020-09-21 10:09:05', '2020-09-21 10:09:05'),
(95, 14, 'assets/uploads/products/product 14/images/MyY2L3nRi6.jpg', '2020-09-21 10:09:05', '2020-09-21 10:09:05', '2020-09-21 10:09:05'),
(96, 14, 'assets/uploads/products/product 14/images/9geqCoRNQH.jpg', '2020-09-21 10:09:05', '2020-09-21 10:09:05', '2020-09-21 10:09:05'),
(97, 14, 'assets/uploads/products/product 14/images/37FeYkjo7r.jpg', '2020-09-21 10:09:05', '2020-09-21 10:09:05', '2020-09-21 10:09:05'),
(98, 15, 'assets/uploads/products/product 15/images/2EB7VxdQSh.jpg', '2020-09-21 10:10:56', '2020-09-21 10:10:56', '2020-09-21 10:10:56'),
(99, 15, 'assets/uploads/products/product 15/images/IfYaODgwdJ.jpg', '2020-09-21 10:10:56', '2020-09-21 10:10:56', '2020-09-21 10:10:56'),
(100, 15, 'assets/uploads/products/product 15/images/Y8BonWSzor.jpg', '2020-09-21 10:10:56', '2020-09-21 10:10:56', '2020-09-21 10:10:56'),
(101, 15, 'assets/uploads/products/product 15/images/vzdgTczRl5.jpg', '2020-09-21 10:10:56', '2020-09-21 10:10:56', '2020-09-21 10:10:56'),
(102, 15, 'assets/uploads/products/product 15/images/HwyjnnGn5P.jpg', '2020-09-21 10:10:56', '2020-09-21 10:10:56', '2020-09-21 10:10:56'),
(103, 15, 'assets/uploads/products/product 15/images/73KrJtLshx.jpg', '2020-09-21 10:10:56', '2020-09-21 10:10:56', '2020-09-21 10:10:56'),
(104, 16, 'assets/uploads/products/product 16/images/biT92LB0rg.jpg', '2020-09-21 10:10:08', '2020-09-21 10:10:08', '2020-09-21 10:10:08'),
(105, 16, 'assets/uploads/products/product 16/images/E8HxHbUyJE.jpg', '2020-09-21 10:10:08', '2020-09-21 10:10:08', '2020-09-21 10:10:08'),
(106, 16, 'assets/uploads/products/product 16/images/dCODriexUD.jpg', '2020-09-21 10:10:08', '2020-09-21 10:10:08', '2020-09-21 10:10:08'),
(107, 16, 'assets/uploads/products/product 16/images/zg9HncQZwj.jpg', '2020-09-21 10:10:08', '2020-09-21 10:10:08', '2020-09-21 10:10:08'),
(108, 16, 'assets/uploads/products/product 16/images/iKuwrJU2d0.jpg', '2020-09-21 10:10:08', '2020-09-21 10:10:08', '2020-09-21 10:10:08'),
(109, 16, 'assets/uploads/products/product 16/images/Fa4Kb4LKOR.jpg', '2020-09-21 10:10:08', '2020-09-21 10:10:08', '2020-09-21 10:10:08'),
(110, 16, 'assets/uploads/products/product 16/images/qPBRKxzd95.jpg', '2020-09-21 10:10:08', '2020-09-21 10:10:08', '2020-09-21 10:10:08'),
(111, 16, 'assets/uploads/products/product 16/images/xmBTnedF60.jpg', '2020-09-21 10:10:08', '2020-09-21 10:10:08', '2020-09-21 10:10:08'),
(112, 17, 'assets/uploads/products/product 17/images/npPkbTBhta.jpg', '2020-09-21 10:12:15', '2020-09-21 10:12:15', '2020-09-21 10:12:15'),
(113, 17, 'assets/uploads/products/product 17/images/4aD4J4lBf0.jpg', '2020-09-21 10:12:15', '2020-09-21 10:12:15', '2020-09-21 10:12:15'),
(114, 17, 'assets/uploads/products/product 17/images/tooo8X6GPL.jpg', '2020-09-21 10:12:15', '2020-09-21 10:12:15', '2020-09-21 10:12:15'),
(115, 17, 'assets/uploads/products/product 17/images/A1jGr5qcpf.jpg', '2020-09-21 10:12:15', '2020-09-21 10:12:15', '2020-09-21 10:12:15'),
(116, 17, 'assets/uploads/products/product 17/images/7SJASMMNuO.jpg', '2020-09-21 10:12:15', '2020-09-21 10:12:15', '2020-09-21 10:12:15'),
(117, 17, 'assets/uploads/products/product 17/images/HdSh8ivqYe.jpg', '2020-09-21 10:12:15', '2020-09-21 10:12:15', '2020-09-21 10:12:15'),
(118, 17, 'assets/uploads/products/product 17/images/JgunyrRIER.jpg', '2020-09-21 10:12:15', '2020-09-21 10:12:15', '2020-09-21 10:12:15'),
(119, 17, 'assets/uploads/products/product 17/images/6DbpRIVKVd.jpg', '2020-09-21 10:12:15', '2020-09-21 10:12:15', '2020-09-21 10:12:15'),
(120, 18, 'assets/uploads/products/product 18/images/YoU8lFGnxF.jpg', '2020-09-21 10:13:14', '2020-09-21 10:13:14', '2020-09-21 10:13:14'),
(121, 18, 'assets/uploads/products/product 18/images/CBMWu1z3t1.jpg', '2020-09-21 10:13:14', '2020-09-21 10:13:14', '2020-09-21 10:13:14'),
(122, 18, 'assets/uploads/products/product 18/images/VOpP8AbMz5.jpg', '2020-09-21 10:13:14', '2020-09-21 10:13:14', '2020-09-21 10:13:14'),
(123, 18, 'assets/uploads/products/product 18/images/huvUgLniPP.jpg', '2020-09-21 10:13:14', '2020-09-21 10:13:14', '2020-09-21 10:13:14'),
(124, 18, 'assets/uploads/products/product 18/images/W68hHoVmcm.jpg', '2020-09-21 10:13:14', '2020-09-21 10:13:14', '2020-09-21 10:13:14'),
(125, 18, 'assets/uploads/products/product 18/images/yHobN8BFfR.jpg', '2020-09-21 10:13:14', '2020-09-21 10:13:14', '2020-09-21 10:13:14'),
(126, 18, 'assets/uploads/products/product 18/images/ouS5OiX3rJ.jpg', '2020-09-21 10:13:14', '2020-09-21 10:13:14', '2020-09-21 10:13:14'),
(127, 19, 'assets/uploads/products/product 19/images/nnTQ1q9aCZ.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', '2020-09-21 10:31:05'),
(128, 19, 'assets/uploads/products/product 19/images/5OZDGa8Z9h.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', '2020-09-21 10:31:05'),
(129, 19, 'assets/uploads/products/product 19/images/2kS6huLMRr.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', '2020-09-21 10:31:05'),
(130, 19, 'assets/uploads/products/product 19/images/hB1s6445wq.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', '2020-09-21 10:31:05'),
(131, 19, 'assets/uploads/products/product 19/images/hpMLxy96Vi.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', '2020-09-21 10:31:05'),
(132, 19, 'assets/uploads/products/product 19/images/a43iQ7fNkT.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', '2020-09-21 10:31:05'),
(133, 19, 'assets/uploads/products/product 19/images/VduzM2Y76f.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', '2020-09-21 10:31:05'),
(134, 19, 'assets/uploads/products/product 19/images/irbzwCNmtW.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', '2020-09-21 10:31:05'),
(135, 19, 'assets/uploads/products/product 19/images/UtRolzy7JR.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', '2020-09-21 10:31:05'),
(136, 20, 'assets/uploads/products/product 20/images/vvCKxmqGO8.jpg', '2020-09-21 10:30:05', '2020-09-21 10:30:05', '2020-09-21 10:30:05'),
(137, 20, 'assets/uploads/products/product 20/images/M6DeQW0gTV.jpg', '2020-09-21 10:30:05', '2020-09-21 10:30:05', '2020-09-21 10:30:05'),
(138, 20, 'assets/uploads/products/product 20/images/ZU9UXbwYhk.jpg', '2020-09-21 10:30:05', '2020-09-21 10:30:05', '2020-09-21 10:30:05'),
(139, 20, 'assets/uploads/products/product 20/images/uoWzPpEEdw.jpg', '2020-09-21 10:30:05', '2020-09-21 10:30:05', '2020-09-21 10:30:05'),
(140, 20, 'assets/uploads/products/product 20/images/HYyanwfmtH.jpg', '2020-09-21 10:30:05', '2020-09-21 10:30:05', '2020-09-21 10:30:05'),
(141, 20, 'assets/uploads/products/product 20/images/AHY5UmgKO1.jpg', '2020-09-21 10:30:05', '2020-09-21 10:30:05', '2020-09-21 10:30:05'),
(142, 20, 'assets/uploads/products/product 20/images/LPIUB6GJ3t.jpg', '2020-09-21 10:30:05', '2020-09-21 10:30:05', '2020-09-21 10:30:05'),
(143, 20, 'assets/uploads/products/product 20/images/UdIPzEFfzl.jpg', '2020-09-21 10:30:05', '2020-09-21 10:30:05', '2020-09-21 10:30:05'),
(144, 20, 'assets/uploads/products/product 20/images/sCVdSbFU6B.jpg', '2020-09-21 10:30:05', '2020-09-21 10:30:05', '2020-09-21 10:30:05'),
(145, 21, 'assets/uploads/products/product 21/images/fy3lBpKhLy.jpg', '2020-09-21 10:37:46', '2020-09-21 10:37:46', '2020-09-21 10:37:46'),
(146, 21, 'assets/uploads/products/product 21/images/2C1jUm8iEj.jpg', '2020-09-21 10:37:46', '2020-09-21 10:37:46', '2020-09-21 10:37:46'),
(147, 21, 'assets/uploads/products/product 21/images/fzAH8AgjMD.jpg', '2020-09-21 10:37:46', '2020-09-21 10:37:46', '2020-09-21 10:37:46'),
(148, 21, 'assets/uploads/products/product 21/images/xJbDIlDQj6.jpg', '2020-09-21 10:37:46', '2020-09-21 10:37:46', '2020-09-21 10:37:46'),
(149, 21, 'assets/uploads/products/product 21/images/qUXIZ8APsf.jpg', '2020-09-21 10:37:46', '2020-09-21 10:37:46', '2020-09-21 10:37:46'),
(150, 21, 'assets/uploads/products/product 21/images/j3UKySkQO0.jpg', '2020-09-21 10:37:46', '2020-09-21 10:37:46', '2020-09-21 10:37:46'),
(151, 21, 'assets/uploads/products/product 21/images/8sLmGQxhCR.jpg', '2020-09-21 10:37:46', '2020-09-21 10:37:46', '2020-09-21 10:37:46'),
(152, 21, 'assets/uploads/products/product 21/images/9qcELWyC6Z.jpg', '2020-09-21 10:37:46', '2020-09-21 10:37:46', '2020-09-21 10:37:46'),
(153, 22, 'assets/uploads/products/product 22/images/GVI2Vmg5u1.jpg', '2020-09-21 10:41:40', '2020-09-21 10:41:40', '2020-09-21 10:41:40'),
(154, 22, 'assets/uploads/products/product 22/images/ydkyb6InK3.jpg', '2020-09-21 10:41:40', '2020-09-21 10:41:40', '2020-09-21 10:41:40'),
(155, 22, 'assets/uploads/products/product 22/images/e1eMeNSTLj.jpg', '2020-09-21 10:41:40', '2020-09-21 10:41:40', '2020-09-21 10:41:40'),
(156, 22, 'assets/uploads/products/product 22/images/6vPwihrThl.jpg', '2020-09-21 10:41:40', '2020-09-21 10:41:40', '2020-09-21 10:41:40'),
(157, 22, 'assets/uploads/products/product 22/images/qZC6sPFT0m.jpg', '2020-09-21 10:41:40', '2020-09-21 10:41:40', '2020-09-21 10:41:40'),
(158, 22, 'assets/uploads/products/product 22/images/AciPjbcXjj.jpg', '2020-09-21 10:41:40', '2020-09-21 10:41:40', '2020-09-21 10:41:40'),
(159, 22, 'assets/uploads/products/product 22/images/abGYHY5EdP.jpg', '2020-09-21 10:41:40', '2020-09-21 10:41:40', '2020-09-21 10:41:40'),
(160, 22, 'assets/uploads/products/product 22/images/QdkLFt7Q3N.jpg', '2020-09-21 10:41:40', '2020-09-21 10:41:40', '2020-09-21 10:41:40'),
(161, 22, 'assets/uploads/products/product 22/images/HCtkkQN3RU.jpg', '2020-09-21 10:41:40', '2020-09-21 10:41:40', '2020-09-21 10:41:40'),
(162, 23, 'assets/uploads/products/product 23/images/MZMWkkY4Ws.jpg', '2020-09-21 10:42:31', '2020-09-21 10:42:31', '2020-09-21 10:42:31'),
(163, 23, 'assets/uploads/products/product 23/images/sI9g0pCFh2.jpg', '2020-09-21 10:42:31', '2020-09-21 10:42:31', '2020-09-21 10:42:31'),
(164, 23, 'assets/uploads/products/product 23/images/ury3X3YSnB.jpg', '2020-09-21 10:42:31', '2020-09-21 10:42:31', '2020-09-21 10:42:31'),
(165, 23, 'assets/uploads/products/product 23/images/XSuKijvXzx.jpg', '2020-09-21 10:42:31', '2020-09-21 10:42:31', '2020-09-21 10:42:31'),
(166, 23, 'assets/uploads/products/product 23/images/EvZjnqJCke.jpg', '2020-09-21 10:42:31', '2020-09-21 10:42:31', '2020-09-21 10:42:31'),
(167, 23, 'assets/uploads/products/product 23/images/GZZgjmvCS9.jpg', '2020-09-21 10:42:31', '2020-09-21 10:42:31', '2020-09-21 10:42:31'),
(168, 23, 'assets/uploads/products/product 23/images/bamsxUWHpx.jpg', '2020-09-21 10:42:31', '2020-09-21 10:42:31', '2020-09-21 10:42:31'),
(169, 23, 'assets/uploads/products/product 23/images/noLzTS4VIK.jpg', '2020-09-21 10:42:31', '2020-09-21 10:42:31', '2020-09-21 10:42:31'),
(170, 23, 'assets/uploads/products/product 23/images/NPNqfybubh.jpg', '2020-09-21 10:42:31', '2020-09-21 10:42:31', '2020-09-21 10:42:31'),
(171, 23, 'assets/uploads/products/product 23/images/Idup6SVfvd.jpg', '2020-09-21 10:42:31', '2020-09-21 10:42:31', '2020-09-21 10:42:31'),
(172, 24, 'assets/uploads/products/product 24/images/UineqxanQJ.jpg', '2020-09-21 10:43:21', '2020-09-21 10:43:21', '2020-09-21 10:43:21'),
(173, 24, 'assets/uploads/products/product 24/images/ji6qbLDKVq.jpg', '2020-09-21 10:43:21', '2020-09-21 10:43:21', '2020-09-21 10:43:21'),
(174, 24, 'assets/uploads/products/product 24/images/hjMPoQG9uB.jpg', '2020-09-21 10:43:21', '2020-09-21 10:43:21', '2020-09-21 10:43:21'),
(175, 24, 'assets/uploads/products/product 24/images/dkolPFgs0Z.jpg', '2020-09-21 10:43:21', '2020-09-21 10:43:21', '2020-09-21 10:43:21'),
(176, 24, 'assets/uploads/products/product 24/images/kKxHHqz0gx.jpg', '2020-09-21 10:43:21', '2020-09-21 10:43:21', '2020-09-21 10:43:21'),
(177, 24, 'assets/uploads/products/product 24/images/oEoblIlRW0.jpg', '2020-09-21 10:43:21', '2020-09-21 10:43:21', '2020-09-21 10:43:21'),
(178, 24, 'assets/uploads/products/product 24/images/rNQ3nYKjvz.jpg', '2020-09-21 10:43:21', '2020-09-21 10:43:21', '2020-09-21 10:43:21'),
(179, 24, 'assets/uploads/products/product 24/images/LYJicL0ABU.jpg', '2020-09-21 10:43:21', '2020-09-21 10:43:21', '2020-09-21 10:43:21'),
(180, 25, 'assets/uploads/products/product 25/images/uZxVt3a7rp.jpg', '2020-09-21 10:44:07', '2020-09-21 10:44:07', '2020-09-21 10:44:07'),
(181, 25, 'assets/uploads/products/product 25/images/m8NkITnpgr.jpg', '2020-09-21 10:44:07', '2020-09-21 10:44:07', '2020-09-21 10:44:07'),
(182, 25, 'assets/uploads/products/product 25/images/EJ4ud75QDh.jpg', '2020-09-21 10:44:07', '2020-09-21 10:44:07', '2020-09-21 10:44:07'),
(183, 25, 'assets/uploads/products/product 25/images/h1sz3CiQaw.jpg', '2020-09-21 10:44:07', '2020-09-21 10:44:07', '2020-09-21 10:44:07'),
(184, 25, 'assets/uploads/products/product 25/images/yuLAudGmnQ.jpg', '2020-09-21 10:44:07', '2020-09-21 10:44:07', '2020-09-21 10:44:07'),
(185, 25, 'assets/uploads/products/product 25/images/c9k9DzFOMO.jpg', '2020-09-21 10:44:07', '2020-09-21 10:44:07', '2020-09-21 10:44:07'),
(186, 25, 'assets/uploads/products/product 25/images/Q8migvb8d7.jpg', '2020-09-21 10:44:07', '2020-09-21 10:44:07', '2020-09-21 10:44:07'),
(187, 25, 'assets/uploads/products/product 25/images/N2e7JlMx2K.jpg', '2020-09-21 10:44:07', '2020-09-21 10:44:07', '2020-09-21 10:44:07'),
(188, 26, 'assets/uploads/products/product 26/images/acLN0NH8M6.jpg', '2020-09-21 10:46:22', '2020-09-21 10:46:22', '2020-09-21 10:46:22'),
(189, 26, 'assets/uploads/products/product 26/images/g6R07V5hnb.jpg', '2020-09-21 10:46:22', '2020-09-21 10:46:22', '2020-09-21 10:46:22'),
(190, 26, 'assets/uploads/products/product 26/images/grTerXeQN8.jpg', '2020-09-21 10:46:22', '2020-09-21 10:46:22', '2020-09-21 10:46:22'),
(191, 26, 'assets/uploads/products/product 26/images/aIvIvMP4y0.jpg', '2020-09-21 10:46:22', '2020-09-21 10:46:22', '2020-09-21 10:46:22'),
(192, 26, 'assets/uploads/products/product 26/images/85KISGgn7P.jpg', '2020-09-21 10:46:22', '2020-09-21 10:46:22', '2020-09-21 10:46:22'),
(193, 26, 'assets/uploads/products/product 26/images/T7SIres9gx.jpg', '2020-09-21 10:46:22', '2020-09-21 10:46:22', '2020-09-21 10:46:22'),
(194, 26, 'assets/uploads/products/product 26/images/hcXAEBpslb.jpg', '2020-09-21 10:46:22', '2020-09-21 10:46:22', '2020-09-21 10:46:22'),
(195, 26, 'assets/uploads/products/product 26/images/75EBLbWiT4.jpg', '2020-09-21 10:46:22', '2020-09-21 10:46:22', '2020-09-21 10:46:22'),
(196, 27, 'assets/uploads/products/product 27/images/mngrvLSL5L.jpg', '2020-09-21 10:47:05', '2020-09-21 10:47:05', '2020-09-21 10:47:05'),
(197, 27, 'assets/uploads/products/product 27/images/GJ0cVqgqnc.jpg', '2020-09-21 10:47:05', '2020-09-21 10:47:05', '2020-09-21 10:47:05'),
(198, 27, 'assets/uploads/products/product 27/images/e0xMLLQ5A2.jpg', '2020-09-21 10:47:05', '2020-09-21 10:47:05', '2020-09-21 10:47:05'),
(199, 27, 'assets/uploads/products/product 27/images/g884gpQRhB.jpg', '2020-09-21 10:47:05', '2020-09-21 10:47:05', '2020-09-21 10:47:05'),
(200, 27, 'assets/uploads/products/product 27/images/TC3mLJomvO.jpg', '2020-09-21 10:47:05', '2020-09-21 10:47:05', '2020-09-21 10:47:05'),
(201, 27, 'assets/uploads/products/product 27/images/PNblEKn8PZ.jpg', '2020-09-21 10:47:05', '2020-09-21 10:47:05', '2020-09-21 10:47:05'),
(202, 27, 'assets/uploads/products/product 27/images/FwpgRsfAuI.jpg', '2020-09-21 10:47:05', '2020-09-21 10:47:05', '2020-09-21 10:47:05'),
(203, 27, 'assets/uploads/products/product 27/images/N4866G4J8M.jpg', '2020-09-21 10:47:05', '2020-09-21 10:47:05', '2020-09-21 10:47:05'),
(204, 27, 'assets/uploads/products/product 27/images/pc2Z4yuqui.jpg', '2020-09-21 10:47:05', '2020-09-21 10:47:05', '2020-09-21 10:47:05'),
(205, 28, 'assets/uploads/products/product 28/images/ZpwpA45iEU.jpg', '2020-09-21 08:39:35', '2020-09-21 08:39:35', NULL),
(206, 28, 'assets/uploads/products/product 28/images/YZqT6GGaQy.jpg', '2020-09-21 08:39:35', '2020-09-21 08:39:35', NULL),
(207, 28, 'assets/uploads/products/product 28/images/ZX2eg8vJ83.jpg', '2020-09-21 08:39:35', '2020-09-21 08:39:35', NULL),
(208, 28, 'assets/uploads/products/product 28/images/k7OOSbpbw5.jpg', '2020-09-21 08:39:35', '2020-09-21 08:39:35', NULL),
(209, 28, 'assets/uploads/products/product 28/images/WaXRRe4TlP.jpg', '2020-09-21 08:39:35', '2020-09-21 08:39:35', NULL),
(210, 28, 'assets/uploads/products/product 28/images/RfCAdDScBL.jpg', '2020-09-21 08:39:36', '2020-09-21 08:39:36', NULL),
(211, 28, 'assets/uploads/products/product 28/images/orJthTrvwI.jpg', '2020-09-21 08:39:36', '2020-09-21 08:39:36', NULL),
(212, 28, 'assets/uploads/products/product 28/images/IN8UasSJYm.jpg', '2020-09-21 08:39:36', '2020-09-21 08:39:36', NULL),
(213, 28, 'assets/uploads/products/product 28/images/vQCWJ8agoM.jpg', '2020-09-21 08:39:36', '2020-09-21 08:39:36', NULL),
(214, 28, 'assets/uploads/products/product 28/images/xQovMpaUGx.jpg', '2020-09-21 08:39:36', '2020-09-21 08:39:36', NULL),
(215, 28, 'assets/uploads/products/product 28/images/9K3bjtg8c3.jpg', '2020-09-21 08:39:37', '2020-09-21 08:39:37', NULL),
(216, 28, 'assets/uploads/products/product 28/images/Qw4bjXzriw.jpg', '2020-09-21 08:39:37', '2020-09-21 08:39:37', NULL),
(217, 28, 'assets/uploads/products/product 28/images/pGWiOqJD8m.jpg', '2020-09-21 08:39:37', '2020-09-21 08:39:37', NULL),
(218, 28, 'assets/uploads/products/product 28/images/Yu0FSDSi4r.jpg', '2020-09-21 08:39:37', '2020-09-21 08:39:37', NULL),
(219, 28, 'assets/uploads/products/product 28/images/BhWEfWdXxA.jpg', '2020-09-21 08:39:37', '2020-09-21 08:39:37', NULL),
(220, 28, 'assets/uploads/products/product 28/images/60onpmLV4H.jpg', '2020-09-21 08:39:38', '2020-09-21 08:39:38', NULL),
(221, 28, 'assets/uploads/products/product 28/images/rkBex66RjE.jpg', '2020-09-21 08:39:38', '2020-09-21 08:39:38', NULL),
(222, 28, 'assets/uploads/products/product 28/images/5Okl1LzR3S.jpg', '2020-09-21 08:39:38', '2020-09-21 08:39:38', NULL),
(223, 28, 'assets/uploads/products/product 28/images/m9KzvXFP7m.jpg', '2020-09-21 08:40:05', '2020-09-21 08:40:05', NULL),
(224, 28, 'assets/uploads/products/product 28/images/hWgQM6N1Fo.jpg', '2020-09-21 08:40:05', '2020-09-21 08:40:05', NULL),
(225, 29, 'assets/uploads/products/product 29/images/lFSecP2feE.jpg', '2020-09-21 08:43:13', '2020-09-21 08:43:13', NULL),
(226, 29, 'assets/uploads/products/product 29/images/tol5mGi9Kh.jpg', '2020-09-21 08:43:13', '2020-09-21 08:43:13', NULL),
(227, 29, 'assets/uploads/products/product 29/images/99RmRVxx0T.jpg', '2020-09-21 08:43:13', '2020-09-21 08:43:13', NULL),
(228, 29, 'assets/uploads/products/product 29/images/lei9Bm75S9.jpg', '2020-09-21 08:43:13', '2020-09-21 08:43:13', NULL),
(229, 29, 'assets/uploads/products/product 29/images/d2MKMQNxih.jpg', '2020-09-21 08:43:13', '2020-09-21 08:43:13', NULL),
(230, 29, 'assets/uploads/products/product 29/images/ADfEK5CQlu.jpg', '2020-09-21 08:43:13', '2020-09-21 08:43:13', NULL),
(231, 29, 'assets/uploads/products/product 29/images/asAKQHHbCd.jpg', '2020-09-21 08:43:13', '2020-09-21 08:43:13', NULL),
(232, 30, 'assets/uploads/products/product 30/images/M3TY3hUSzH.jpg', '2020-09-21 08:44:50', '2020-09-21 08:44:50', NULL),
(233, 30, 'assets/uploads/products/product 30/images/gmJ1cN5D2F.jpg', '2020-09-21 08:44:50', '2020-09-21 08:44:50', NULL),
(234, 30, 'assets/uploads/products/product 30/images/6I4Lxf7S4K.jpg', '2020-09-21 08:44:50', '2020-09-21 08:44:50', NULL),
(235, 30, 'assets/uploads/products/product 30/images/o9n8bZrxu6.jpg', '2020-09-21 08:44:50', '2020-09-21 08:44:50', NULL),
(236, 30, 'assets/uploads/products/product 30/images/rHVdczMVBB.jpg', '2020-09-21 08:44:50', '2020-09-21 08:44:50', NULL),
(237, 30, 'assets/uploads/products/product 30/images/FUxiuELQVr.jpg', '2020-09-21 08:44:50', '2020-09-21 08:44:50', NULL),
(238, 30, 'assets/uploads/products/product 30/images/qF3GEcJoTI.jpg', '2020-09-21 08:44:50', '2020-09-21 08:44:50', NULL),
(239, 31, 'assets/uploads/products/product 31/images/QToT1HR3b5.jpg', '2020-09-21 08:47:34', '2020-09-21 08:47:34', NULL),
(240, 31, 'assets/uploads/products/product 31/images/zHONLj4XQ7.jpg', '2020-09-21 08:47:34', '2020-09-21 08:47:34', NULL),
(241, 31, 'assets/uploads/products/product 31/images/UvEnVxANUF.jpg', '2020-09-21 08:47:34', '2020-09-21 08:47:34', NULL),
(242, 31, 'assets/uploads/products/product 31/images/vJfg4E37H1.jpg', '2020-09-21 08:47:34', '2020-09-21 08:47:34', NULL),
(243, 31, 'assets/uploads/products/product 31/images/ejxKR3renb.jpg', '2020-09-21 08:47:34', '2020-09-21 08:47:34', NULL),
(244, 31, 'assets/uploads/products/product 31/images/WtOmYk8CIn.jpg', '2020-09-21 08:47:34', '2020-09-21 08:47:34', NULL),
(245, 31, 'assets/uploads/products/product 31/images/4cER4BVu7r.jpg', '2020-09-21 08:47:34', '2020-09-21 08:47:34', NULL),
(246, 32, 'assets/uploads/products/product 32/images/KTYed62kTK.jpg', '2020-09-21 08:53:04', '2020-09-21 08:53:04', NULL),
(247, 32, 'assets/uploads/products/product 32/images/skykqSa1KZ.jpg', '2020-09-21 08:53:05', '2020-09-21 08:53:05', NULL),
(248, 32, 'assets/uploads/products/product 32/images/pxfVfjGoCH.jpg', '2020-09-21 08:53:05', '2020-09-21 08:53:05', NULL),
(249, 32, 'assets/uploads/products/product 32/images/YYfIg7ZCud.jpg', '2020-09-21 08:53:05', '2020-09-21 08:53:05', NULL),
(250, 32, 'assets/uploads/products/product 32/images/isK1F7T3zD.jpg', '2020-09-21 08:53:05', '2020-09-21 08:53:05', NULL),
(251, 32, 'assets/uploads/products/product 32/images/KK7dUQv9EA.jpg', '2020-09-21 08:53:05', '2020-09-21 08:53:05', NULL),
(252, 32, 'assets/uploads/products/product 32/images/h1lpKDkqlv.jpg', '2020-09-21 08:53:05', '2020-09-21 08:53:05', NULL),
(253, 32, 'assets/uploads/products/product 32/images/1ZdU1aI2fI.jpg', '2020-09-21 08:53:05', '2020-09-21 08:53:05', NULL),
(254, 32, 'assets/uploads/products/product 32/images/28VDAumf20.jpg', '2020-09-21 08:53:05', '2020-09-21 08:53:05', NULL),
(255, 32, 'assets/uploads/products/product 32/images/Z4NqctMk7r.jpg', '2020-09-21 08:53:05', '2020-09-21 08:53:05', NULL),
(256, 32, 'assets/uploads/products/product 32/images/rN1k40x07o.jpg', '2020-09-21 08:53:05', '2020-09-21 08:53:05', NULL),
(257, 32, 'assets/uploads/products/product 32/images/OULqM8I0Vj.jpg', '2020-09-21 08:53:05', '2020-09-21 08:53:05', NULL),
(258, 32, 'assets/uploads/products/product 32/images/w7ZqI5AHo4.jpg', '2020-09-21 08:53:05', '2020-09-21 08:53:05', NULL),
(259, 32, 'assets/uploads/products/product 32/images/M46t8C8t3E.jpg', '2020-09-21 08:53:06', '2020-09-21 08:53:06', NULL),
(260, 32, 'assets/uploads/products/product 32/images/mzc4voWALo.jpg', '2020-09-21 08:53:06', '2020-09-21 08:53:06', NULL),
(261, 32, 'assets/uploads/products/product 32/images/vhwPEUKHhH.jpg', '2020-09-21 08:53:06', '2020-09-21 08:53:06', NULL),
(262, 32, 'assets/uploads/products/product 32/images/mBa3I5qXFp.jpg', '2020-09-21 08:53:06', '2020-09-21 08:53:06', NULL),
(263, 32, 'assets/uploads/products/product 32/images/Gu17Go0kv1.jpg', '2020-09-21 08:53:06', '2020-09-21 08:53:06', NULL),
(264, 32, 'assets/uploads/products/product 32/images/X9eC4Ty9vi.jpg', '2020-09-21 08:53:06', '2020-09-21 08:53:06', NULL),
(265, 32, 'assets/uploads/products/product 32/images/HFig2mym1W.jpg', '2020-09-21 08:53:06', '2020-09-21 08:53:06', NULL),
(266, 33, 'assets/uploads/products/product 33/images/2qbs0IWqFf.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(267, 33, 'assets/uploads/products/product 33/images/IL9pd4XDgH.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(268, 33, 'assets/uploads/products/product 33/images/tsgZvp7pEC.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(269, 33, 'assets/uploads/products/product 33/images/KblMwHJeDt.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(270, 33, 'assets/uploads/products/product 33/images/9XblrQvVpI.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(271, 33, 'assets/uploads/products/product 33/images/opt2ilTxoe.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(272, 33, 'assets/uploads/products/product 33/images/YxXmOHwxd0.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(273, 33, 'assets/uploads/products/product 33/images/ZrJX0y0nJm.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(274, 33, 'assets/uploads/products/product 33/images/I3Ez2QzWwH.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(275, 33, 'assets/uploads/products/product 33/images/zEhpK9fun6.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(276, 33, 'assets/uploads/products/product 33/images/QPoJ2JiDX4.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(277, 33, 'assets/uploads/products/product 33/images/KtDvRCncf1.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(278, 33, 'assets/uploads/products/product 33/images/Im6qIDPhHG.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(279, 33, 'assets/uploads/products/product 33/images/nEc5x9UgqM.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(280, 33, 'assets/uploads/products/product 33/images/dl3wKpkeje.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(281, 33, 'assets/uploads/products/product 33/images/RIJ87edhBN.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(282, 33, 'assets/uploads/products/product 33/images/ndC3FLRjRh.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(283, 33, 'assets/uploads/products/product 33/images/e7JxX7njfl.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(284, 33, 'assets/uploads/products/product 33/images/eDKXSJgCGf.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(285, 33, 'assets/uploads/products/product 33/images/6wb2SaJMKB.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', '2020-09-21 09:01:16'),
(286, 33, 'assets/uploads/products/product 33/images/P4iAkVq7Hv.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', NULL),
(287, 33, 'assets/uploads/products/product 33/images/gw5OIUQzbx.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', NULL),
(288, 33, 'assets/uploads/products/product 33/images/tyeCSNsR3z.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', NULL),
(289, 33, 'assets/uploads/products/product 33/images/LRlxO44kci.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', NULL),
(290, 33, 'assets/uploads/products/product 33/images/xOFDuqI5p4.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', NULL),
(291, 33, 'assets/uploads/products/product 33/images/bM8N3DmJIF.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', NULL),
(292, 33, 'assets/uploads/products/product 33/images/eH3WmnhK2R.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', NULL),
(293, 33, 'assets/uploads/products/product 33/images/g2yWOu9kNa.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', NULL),
(294, 33, 'assets/uploads/products/product 33/images/BG3QtIVtst.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', NULL),
(295, 33, 'assets/uploads/products/product 33/images/C69HJypiY6.jpg', '2020-09-21 09:01:16', '2020-09-21 09:01:16', NULL),
(296, 33, 'assets/uploads/products/product 33/images/rb8irYE4Rh.jpg', '2020-09-21 09:01:17', '2020-09-21 09:01:17', NULL),
(297, 33, 'assets/uploads/products/product 33/images/SFIVTTl29i.jpg', '2020-09-21 09:01:17', '2020-09-21 09:01:17', NULL),
(298, 33, 'assets/uploads/products/product 33/images/Y46mgmklVI.jpg', '2020-09-21 09:01:17', '2020-09-21 09:01:17', NULL),
(299, 33, 'assets/uploads/products/product 33/images/NqmNZ7EuVU.jpg', '2020-09-21 09:01:17', '2020-09-21 09:01:17', NULL),
(300, 33, 'assets/uploads/products/product 33/images/YTn7OFHTgG.jpg', '2020-09-21 09:01:17', '2020-09-21 09:01:17', NULL),
(301, 33, 'assets/uploads/products/product 33/images/X8mY8HqAqF.jpg', '2020-09-21 09:01:17', '2020-09-21 09:01:17', NULL),
(302, 33, 'assets/uploads/products/product 33/images/Le3nV48l3Y.jpg', '2020-09-21 09:01:17', '2020-09-21 09:01:17', NULL),
(303, 34, 'assets/uploads/products/product 34/images/dEDoBj4gpk.jpg', '2020-09-21 09:03:26', '2020-09-21 09:03:26', NULL),
(304, 34, 'assets/uploads/products/product 34/images/jcsakoGmEg.jpg', '2020-09-21 09:03:26', '2020-09-21 09:03:26', NULL),
(305, 34, 'assets/uploads/products/product 34/images/u8OuXaUn54.jpg', '2020-09-21 09:03:26', '2020-09-21 09:03:26', NULL),
(306, 34, 'assets/uploads/products/product 34/images/nroeyBO9IY.jpg', '2020-09-21 09:03:26', '2020-09-21 09:03:26', NULL),
(307, 34, 'assets/uploads/products/product 34/images/Z87Sz8CGCg.jpg', '2020-09-21 09:03:26', '2020-09-21 09:03:26', NULL),
(308, 34, 'assets/uploads/products/product 34/images/BGx3GMmco7.jpg', '2020-09-21 09:03:26', '2020-09-21 09:03:26', NULL),
(309, 34, 'assets/uploads/products/product 34/images/zPf76Ck5Kw.jpg', '2020-09-21 09:03:26', '2020-09-21 09:03:26', NULL),
(310, 34, 'assets/uploads/products/product 34/images/fcyutVvftI.jpg', '2020-09-21 09:03:26', '2020-09-21 09:03:26', NULL),
(311, 34, 'assets/uploads/products/product 34/images/HRUl6Tn96L.jpg', '2020-09-21 09:03:26', '2020-09-21 09:03:26', NULL),
(312, 34, 'assets/uploads/products/product 34/images/847qOJRyjt.jpg', '2020-09-21 09:03:26', '2020-09-21 09:03:26', NULL),
(313, 34, 'assets/uploads/products/product 34/images/pKUbhTqfXB.jpg', '2020-09-21 09:03:26', '2020-09-21 09:03:26', NULL),
(314, 34, 'assets/uploads/products/product 34/images/4kU9kM16Hv.jpg', '2020-09-21 09:03:26', '2020-09-21 09:03:26', NULL),
(315, 34, 'assets/uploads/products/product 34/images/2YSjAwV9Q8.jpg', '2020-09-21 09:03:27', '2020-09-21 09:03:27', NULL),
(316, 35, 'assets/uploads/products/product 35/images/MSlvY8d3Wj.jpg', '2020-09-21 09:04:39', '2020-09-21 09:04:39', NULL),
(317, 35, 'assets/uploads/products/product 35/images/8xkhqrmcHY.jpg', '2020-09-21 09:04:40', '2020-09-21 09:04:40', NULL),
(318, 35, 'assets/uploads/products/product 35/images/d2T7t1HAOu.jpg', '2020-09-21 09:04:40', '2020-09-21 09:04:40', NULL),
(319, 35, 'assets/uploads/products/product 35/images/ry5mJCOKf6.jpg', '2020-09-21 09:04:40', '2020-09-21 09:04:40', NULL),
(320, 35, 'assets/uploads/products/product 35/images/3w5HaYaJO6.jpg', '2020-09-21 09:04:41', '2020-09-21 09:04:41', NULL),
(321, 35, 'assets/uploads/products/product 35/images/L2wdEnIklA.jpg', '2020-09-21 09:04:41', '2020-09-21 09:04:41', NULL),
(322, 35, 'assets/uploads/products/product 35/images/NGeEufyosM.jpg', '2020-09-21 09:04:41', '2020-09-21 09:04:41', NULL),
(323, 35, 'assets/uploads/products/product 35/images/yXBO7yQQZd.jpg', '2020-09-21 09:04:41', '2020-09-21 09:04:41', NULL),
(324, 35, 'assets/uploads/products/product 35/images/3xr6zrEfNb.jpg', '2020-09-21 09:04:41', '2020-09-21 09:04:41', NULL),
(325, 35, 'assets/uploads/products/product 35/images/pASdJPLPDl.jpg', '2020-09-21 09:04:41', '2020-09-21 09:04:41', NULL),
(326, 35, 'assets/uploads/products/product 35/images/SPCaTAkL4T.jpg', '2020-09-21 09:04:42', '2020-09-21 09:04:42', NULL),
(327, 35, 'assets/uploads/products/product 35/images/uSs2ZWczlh.jpg', '2020-09-21 09:04:42', '2020-09-21 09:04:42', NULL),
(328, 35, 'assets/uploads/products/product 35/images/MnLKUjD5mf.jpg', '2020-09-21 09:04:42', '2020-09-21 09:04:42', NULL),
(329, 36, 'assets/uploads/products/product 36/images/hjKjOV3pov.jpg', '2020-09-21 09:05:41', '2020-09-21 09:05:41', NULL),
(330, 36, 'assets/uploads/products/product 36/images/iAvzDxmIKS.jpg', '2020-09-21 09:05:41', '2020-09-21 09:05:41', NULL),
(331, 36, 'assets/uploads/products/product 36/images/X2LvrzxFke.jpg', '2020-09-21 09:05:41', '2020-09-21 09:05:41', NULL),
(332, 36, 'assets/uploads/products/product 36/images/PWNl3kZKtu.jpg', '2020-09-21 09:05:41', '2020-09-21 09:05:41', NULL),
(333, 36, 'assets/uploads/products/product 36/images/ioi2O6zLlP.jpg', '2020-09-21 09:05:41', '2020-09-21 09:05:41', NULL),
(334, 36, 'assets/uploads/products/product 36/images/aCE98inQ4N.jpg', '2020-09-21 09:05:41', '2020-09-21 09:05:41', NULL),
(335, 36, 'assets/uploads/products/product 36/images/424QMasKGL.jpg', '2020-09-21 09:05:41', '2020-09-21 09:05:41', NULL),
(336, 36, 'assets/uploads/products/product 36/images/eoqMlKpfg6.jpg', '2020-09-21 09:05:41', '2020-09-21 09:05:41', NULL),
(337, 37, 'assets/uploads/products/product 37/images/ARQYd7x2BQ.jpg', '2020-09-21 09:06:50', '2020-09-21 09:06:50', NULL),
(338, 37, 'assets/uploads/products/product 37/images/ExuoQhz1bx.jpg', '2020-09-21 09:06:50', '2020-09-21 09:06:50', NULL),
(339, 37, 'assets/uploads/products/product 37/images/R0yeofqNee.jpg', '2020-09-21 09:06:51', '2020-09-21 09:06:51', NULL),
(340, 37, 'assets/uploads/products/product 37/images/usHEtwhLuK.jpg', '2020-09-21 09:06:51', '2020-09-21 09:06:51', NULL),
(341, 37, 'assets/uploads/products/product 37/images/67sfEycCGb.jpg', '2020-09-21 09:06:51', '2020-09-21 09:06:51', NULL),
(342, 37, 'assets/uploads/products/product 37/images/bOEEC0rgX6.jpg', '2020-09-21 09:06:51', '2020-09-21 09:06:51', NULL),
(343, 37, 'assets/uploads/products/product 37/images/RfLEYyArLa.jpg', '2020-09-21 09:06:51', '2020-09-21 09:06:51', NULL),
(344, 38, 'assets/uploads/products/product 38/images/FuOuXbpEtP.jpg', '2020-09-21 09:08:42', '2020-09-21 09:08:42', NULL),
(345, 38, 'assets/uploads/products/product 38/images/JtuY3A0tv4.jpg', '2020-09-21 09:08:42', '2020-09-21 09:08:42', NULL),
(346, 38, 'assets/uploads/products/product 38/images/Olu9e1Tiao.jpg', '2020-09-21 09:08:42', '2020-09-21 09:08:42', NULL),
(347, 38, 'assets/uploads/products/product 38/images/lftoJkin39.jpg', '2020-09-21 09:08:42', '2020-09-21 09:08:42', NULL),
(348, 38, 'assets/uploads/products/product 38/images/3PKHug9vtb.jpg', '2020-09-21 09:08:42', '2020-09-21 09:08:42', NULL),
(349, 38, 'assets/uploads/products/product 38/images/aDxE7K5EAX.jpg', '2020-09-21 09:08:42', '2020-09-21 09:08:42', NULL),
(350, 38, 'assets/uploads/products/product 38/images/Bp84K7k7Xj.jpg', '2020-09-21 09:08:43', '2020-09-21 09:08:43', NULL),
(351, 38, 'assets/uploads/products/product 38/images/XBnJ2EE5Dd.jpg', '2020-09-21 09:08:43', '2020-09-21 09:08:43', NULL),
(352, 38, 'assets/uploads/products/product 38/images/gVXo5LCxCa.jpg', '2020-09-21 09:08:43', '2020-09-21 09:08:43', NULL),
(353, 39, 'assets/uploads/products/product 39/images/ROHKyNJMvE.jpg', '2020-09-21 09:13:52', '2020-09-21 09:13:52', NULL),
(354, 39, 'assets/uploads/products/product 39/images/wYv7DdsA2H.jpg', '2020-09-21 09:13:52', '2020-09-21 09:13:52', NULL),
(355, 39, 'assets/uploads/products/product 39/images/nUUWdbzwvs.jpg', '2020-09-21 09:13:52', '2020-09-21 09:13:52', NULL),
(356, 39, 'assets/uploads/products/product 39/images/OnYQFlzjDb.jpg', '2020-09-21 09:13:52', '2020-09-21 09:13:52', NULL),
(357, 39, 'assets/uploads/products/product 39/images/AREqOCe5GJ.jpg', '2020-09-21 09:13:52', '2020-09-21 09:13:52', NULL),
(358, 39, 'assets/uploads/products/product 39/images/WluEfmUQ26.jpg', '2020-09-21 09:13:53', '2020-09-21 09:13:53', NULL),
(359, 39, 'assets/uploads/products/product 39/images/3g1YKE3MjQ.jpg', '2020-09-21 09:13:53', '2020-09-21 09:13:53', NULL),
(360, 39, 'assets/uploads/products/product 39/images/7DUQUoxUI3.jpg', '2020-09-21 09:13:53', '2020-09-21 09:13:53', NULL),
(361, 39, 'assets/uploads/products/product 39/images/RFfHFjB5BI.jpg', '2020-09-21 09:13:53', '2020-09-21 09:13:53', NULL),
(362, 40, 'assets/uploads/products/product 40/images/v8AkWJTMi6.jpg', '2020-09-21 09:16:45', '2020-09-21 09:16:45', NULL),
(363, 40, 'assets/uploads/products/product 40/images/YrQMBR9Y9l.jpg', '2020-09-21 09:16:46', '2020-09-21 09:16:46', NULL),
(364, 40, 'assets/uploads/products/product 40/images/kFEt1aR9AZ.jpg', '2020-09-21 09:16:46', '2020-09-21 09:16:46', NULL),
(365, 40, 'assets/uploads/products/product 40/images/rv4i0IBsex.jpg', '2020-09-21 09:16:46', '2020-09-21 09:16:46', NULL),
(366, 40, 'assets/uploads/products/product 40/images/I2CAMTdwZD.jpg', '2020-09-21 09:16:46', '2020-09-21 09:16:46', NULL),
(367, 40, 'assets/uploads/products/product 40/images/JbORotbjmx.jpg', '2020-09-21 09:16:46', '2020-09-21 09:16:46', NULL),
(368, 41, 'assets/uploads/products/product 41/images/fnKSYa03cl.jpg', '2020-09-21 09:17:56', '2020-09-21 09:17:56', NULL),
(369, 41, 'assets/uploads/products/product 41/images/PQsMTHwif2.jpg', '2020-09-21 09:17:56', '2020-09-21 09:17:56', NULL),
(370, 41, 'assets/uploads/products/product 41/images/KPt0653Zib.jpg', '2020-09-21 09:17:56', '2020-09-21 09:17:56', NULL),
(371, 41, 'assets/uploads/products/product 41/images/z5CuDLatNJ.jpg', '2020-09-21 09:17:56', '2020-09-21 09:17:56', NULL),
(372, 41, 'assets/uploads/products/product 41/images/ceO1fr2Fc8.jpg', '2020-09-21 09:17:57', '2020-09-21 09:17:57', NULL),
(373, 41, 'assets/uploads/products/product 41/images/bU7OeXm06l.jpg', '2020-09-21 09:17:57', '2020-09-21 09:17:57', NULL),
(374, 41, 'assets/uploads/products/product 41/images/aqBUvhX4Cc.jpg', '2020-09-21 09:17:57', '2020-09-21 09:17:57', NULL),
(375, 42, 'assets/uploads/products/product 42/images/WncOjss2Rm.jpg', '2020-09-21 09:20:00', '2020-09-21 09:20:00', NULL),
(376, 43, 'assets/uploads/products/product 43/images/HtRdrrnHVr.jpg', '2020-09-21 09:22:13', '2020-09-21 09:22:13', NULL),
(377, 44, 'assets/uploads/products/product 44/images/G0tLYDsHEH.jpg', '2020-09-21 09:23:24', '2020-09-21 09:23:24', NULL),
(378, 44, 'assets/uploads/products/product 44/images/IUPjy5iF2I.jpg', '2020-09-21 09:23:24', '2020-09-21 09:23:24', NULL),
(379, 44, 'assets/uploads/products/product 44/images/0JGvBgvh6T.jpg', '2020-09-21 09:23:24', '2020-09-21 09:23:24', NULL),
(380, 44, 'assets/uploads/products/product 44/images/Bc3URZTfsb.jpg', '2020-09-21 09:23:24', '2020-09-21 09:23:24', NULL),
(381, 44, 'assets/uploads/products/product 44/images/2C9tbunGgy.jpg', '2020-09-21 09:23:24', '2020-09-21 09:23:24', NULL),
(382, 45, 'assets/uploads/products/product 45/images/QGk1oB444z.jpg', '2020-09-28 06:16:18', '2020-09-28 06:16:18', '2020-09-28 06:16:18');
INSERT INTO `product_images` (`id`, `product_id`, `img_src`, `created_at`, `updated_at`, `deleted_at`) VALUES
(383, 45, 'assets/uploads/products/product 45/images/EqaCop7z08.jpg', '2020-09-28 06:16:18', '2020-09-28 06:16:18', '2020-09-28 06:16:18'),
(384, 45, 'assets/uploads/products/product 45/images/VP2VDSQW8L.jpg', '2020-09-28 06:16:18', '2020-09-28 06:16:18', '2020-09-28 06:16:18'),
(385, 45, 'assets/uploads/products/product 45/images/TLrn0BevLt.jpg', '2020-09-28 06:16:18', '2020-09-28 06:16:18', '2020-09-28 06:16:18'),
(386, 45, 'assets/uploads/products/product 45/images/o812K7Reh1.jpg', '2020-09-28 06:16:18', '2020-09-28 06:16:18', '2020-09-28 06:16:18'),
(387, 45, 'assets/uploads/products/product 45/images/lirdqaymEY.jpg', '2020-09-28 06:16:18', '2020-09-28 06:16:18', '2020-09-28 06:16:18'),
(388, 45, 'assets/uploads/products/product 45/images/tsmahfwhFF.jpg', '2020-09-28 06:16:18', '2020-09-28 06:16:18', '2020-09-28 06:16:18'),
(389, 46, 'assets/uploads/products/product 46/images/At4cquhXEE.jpg', '2020-09-21 09:25:34', '2020-09-21 09:25:34', NULL),
(390, 47, 'assets/uploads/products/product 47/images/u3iHYcpf03.jpg', '2020-09-21 09:28:01', '2020-09-21 09:28:01', NULL),
(391, 1, 'assets/uploads/products/product 1/images/n2gc4IOZ2e.jpg', '2020-09-21 09:35:41', '2020-09-21 09:35:41', NULL),
(392, 1, 'assets/uploads/products/product 1/images/bFZAh6Apr6.jpg', '2020-09-21 09:35:42', '2020-09-21 09:35:42', NULL),
(393, 1, 'assets/uploads/products/product 1/images/EEj2AcMtL4.jpg', '2020-09-21 09:35:42', '2020-09-21 09:35:42', NULL),
(394, 1, 'assets/uploads/products/product 1/images/e0WwliddBe.jpg', '2020-09-21 09:35:42', '2020-09-21 09:35:42', NULL),
(395, 1, 'assets/uploads/products/product 1/images/nyEzY3Xm8I.jpg', '2020-09-21 09:35:42', '2020-09-21 09:35:42', NULL),
(396, 2, 'assets/uploads/products/product 2/images/T1sSnJ5rVs.jpg', '2020-09-21 09:37:14', '2020-09-21 09:37:14', NULL),
(397, 2, 'assets/uploads/products/product 2/images/EqG98jyIMn.jpg', '2020-09-21 09:37:14', '2020-09-21 09:37:14', NULL),
(398, 2, 'assets/uploads/products/product 2/images/wu1t2Yx3Dl.jpg', '2020-09-21 09:37:15', '2020-09-21 09:37:15', NULL),
(399, 2, 'assets/uploads/products/product 2/images/z7xcouxESB.jpg', '2020-09-21 09:37:15', '2020-09-21 09:37:15', NULL),
(400, 2, 'assets/uploads/products/product 2/images/fgQ7hyfxYw.jpg', '2020-09-21 09:37:15', '2020-09-21 09:37:15', NULL),
(401, 2, 'assets/uploads/products/product 2/images/Ne50SaxXX9.jpg', '2020-09-21 09:37:15', '2020-09-21 09:37:15', NULL),
(402, 3, 'assets/uploads/products/product 3/images/XRQUPryis1.jpg', '2020-09-21 09:40:00', '2020-09-21 09:40:00', NULL),
(403, 4, 'assets/uploads/products/product 4/images/7FdS3XkC65.jpg', '2020-09-21 09:41:17', '2020-09-21 09:41:17', NULL),
(404, 4, 'assets/uploads/products/product 4/images/dyJFWsm3mb.jpg', '2020-09-21 09:41:17', '2020-09-21 09:41:17', NULL),
(405, 4, 'assets/uploads/products/product 4/images/QLm321Mq2N.jpg', '2020-09-21 09:41:18', '2020-09-21 09:41:18', NULL),
(406, 4, 'assets/uploads/products/product 4/images/R0jVJPlcqY.jpg', '2020-09-21 09:41:18', '2020-09-21 09:41:18', NULL),
(407, 4, 'assets/uploads/products/product 4/images/a9PUSAzcUH.jpg', '2020-09-21 09:41:18', '2020-09-21 09:41:18', NULL),
(408, 4, 'assets/uploads/products/product 4/images/0MOGCWqIYL.jpg', '2020-09-21 09:41:18', '2020-09-21 09:41:18', NULL),
(409, 4, 'assets/uploads/products/product 4/images/0zv1naqq5y.jpg', '2020-09-21 09:41:18', '2020-09-21 09:41:18', NULL),
(410, 4, 'assets/uploads/products/product 4/images/wPRMWcvK0k.jpg', '2020-09-21 09:41:18', '2020-09-21 09:41:18', NULL),
(411, 4, 'assets/uploads/products/product 4/images/aShwXREnwV.jpg', '2020-09-21 09:41:18', '2020-09-21 09:41:18', NULL),
(412, 4, 'assets/uploads/products/product 4/images/95uFsvRbLM.jpg', '2020-09-21 09:41:18', '2020-09-21 09:41:18', NULL),
(413, 5, 'assets/uploads/products/product 5/images/fBbGDPUIOd.jpg', '2020-09-21 09:45:23', '2020-09-21 09:45:23', NULL),
(414, 5, 'assets/uploads/products/product 5/images/NKHeLsGJTW.jpg', '2020-09-21 09:45:23', '2020-09-21 09:45:23', NULL),
(415, 5, 'assets/uploads/products/product 5/images/3HqbUJ37wV.jpg', '2020-09-21 09:45:24', '2020-09-21 09:45:24', NULL),
(416, 5, 'assets/uploads/products/product 5/images/C8rrhvmtY3.jpg', '2020-09-21 09:45:24', '2020-09-21 09:45:24', NULL),
(417, 5, 'assets/uploads/products/product 5/images/iI4wwQItI1.jpg', '2020-09-21 09:45:24', '2020-09-21 09:45:24', NULL),
(418, 5, 'assets/uploads/products/product 5/images/2pAnjfcwl6.jpg', '2020-09-21 09:45:24', '2020-09-21 09:45:24', NULL),
(419, 6, 'assets/uploads/products/product 6/images/5cybqFiSTM.jpg', '2020-09-21 09:46:04', '2020-09-21 09:46:04', NULL),
(420, 6, 'assets/uploads/products/product 6/images/FYFnZcnDpN.jpg', '2020-09-21 09:46:04', '2020-09-21 09:46:04', NULL),
(421, 6, 'assets/uploads/products/product 6/images/bDH69gkrGh.jpg', '2020-09-21 09:46:04', '2020-09-21 09:46:04', NULL),
(422, 6, 'assets/uploads/products/product 6/images/PwHzjelwN4.jpg', '2020-09-21 09:46:04', '2020-09-21 09:46:04', NULL),
(423, 6, 'assets/uploads/products/product 6/images/t1jVG286mN.jpg', '2020-09-21 09:46:04', '2020-09-21 09:46:04', NULL),
(424, 6, 'assets/uploads/products/product 6/images/l8BDX64dhT.jpg', '2020-09-21 09:46:05', '2020-09-21 09:46:05', NULL),
(425, 7, 'assets/uploads/products/product 7/images/Z5N4NynK4g.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', NULL),
(426, 7, 'assets/uploads/products/product 7/images/tOI4hciIvc.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', NULL),
(427, 7, 'assets/uploads/products/product 7/images/cNTq9E1jDs.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', NULL),
(428, 7, 'assets/uploads/products/product 7/images/KCtJQ49cYW.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', NULL),
(429, 7, 'assets/uploads/products/product 7/images/r1z9Z0Hove.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', NULL),
(430, 7, 'assets/uploads/products/product 7/images/yzdbGJ4CpZ.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', NULL),
(431, 7, 'assets/uploads/products/product 7/images/SBczwXPOMI.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', NULL),
(432, 7, 'assets/uploads/products/product 7/images/51YFSECCxY.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', NULL),
(433, 7, 'assets/uploads/products/product 7/images/lDW4YvSdNt.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', NULL),
(434, 7, 'assets/uploads/products/product 7/images/SV45jxD4D9.jpg', '2020-09-21 09:47:50', '2020-09-21 09:47:50', NULL),
(435, 8, 'assets/uploads/products/product 8/images/FQj1Yxiz2Q.jpg', '2020-09-21 10:00:10', '2020-09-21 10:00:10', NULL),
(436, 8, 'assets/uploads/products/product 8/images/u1ClCF33G7.jpg', '2020-09-21 10:00:10', '2020-09-21 10:00:10', NULL),
(437, 8, 'assets/uploads/products/product 8/images/FLdrz8cjVO.jpg', '2020-09-21 10:00:10', '2020-09-21 10:00:10', NULL),
(438, 8, 'assets/uploads/products/product 8/images/JsoVVCp7Hi.jpg', '2020-09-21 10:00:10', '2020-09-21 10:00:10', NULL),
(439, 8, 'assets/uploads/products/product 8/images/SwANtps98w.jpg', '2020-09-21 10:00:10', '2020-09-21 10:00:10', NULL),
(440, 8, 'assets/uploads/products/product 8/images/mZtUrN3GPG.jpg', '2020-09-21 10:00:11', '2020-09-21 10:00:11', NULL),
(441, 8, 'assets/uploads/products/product 8/images/0njcWlnsgo.jpg', '2020-09-21 10:00:11', '2020-09-21 10:00:11', NULL),
(442, 9, 'assets/uploads/products/product 9/images/2ipCPfAzjT.jpg', '2020-09-21 10:00:49', '2020-09-21 10:00:49', NULL),
(443, 9, 'assets/uploads/products/product 9/images/IvNDIUDiUC.jpg', '2020-09-21 10:00:50', '2020-09-21 10:00:50', NULL),
(444, 9, 'assets/uploads/products/product 9/images/IMo2puDYqi.jpg', '2020-09-21 10:00:50', '2020-09-21 10:00:50', NULL),
(445, 9, 'assets/uploads/products/product 9/images/ekHoUW8owq.jpg', '2020-09-21 10:00:50', '2020-09-21 10:00:50', NULL),
(446, 9, 'assets/uploads/products/product 9/images/lRZyDZqixW.jpg', '2020-09-21 10:00:50', '2020-09-21 10:00:50', NULL),
(447, 9, 'assets/uploads/products/product 9/images/hQ4iavF6ND.jpg', '2020-09-21 10:00:50', '2020-09-21 10:00:50', NULL),
(448, 9, 'assets/uploads/products/product 9/images/SXdCfRR98y.jpg', '2020-09-21 10:00:50', '2020-09-21 10:00:50', NULL),
(449, 10, 'assets/uploads/products/product 10/images/xIwpAU8sh3.jpg', '2020-09-21 10:03:15', '2020-09-21 10:03:15', NULL),
(450, 10, 'assets/uploads/products/product 10/images/EnAceqZa59.jpg', '2020-09-21 10:03:15', '2020-09-21 10:03:15', NULL),
(451, 10, 'assets/uploads/products/product 10/images/DAHDfEdrdZ.jpg', '2020-09-21 10:03:15', '2020-09-21 10:03:15', NULL),
(452, 10, 'assets/uploads/products/product 10/images/g7ZLsso28l.jpg', '2020-09-21 10:03:15', '2020-09-21 10:03:15', NULL),
(453, 10, 'assets/uploads/products/product 10/images/NNojkgZrfs.jpg', '2020-09-21 10:03:15', '2020-09-21 10:03:15', NULL),
(454, 10, 'assets/uploads/products/product 10/images/A2LUl7F2Bv.jpg', '2020-09-21 10:03:15', '2020-09-21 10:03:15', NULL),
(455, 10, 'assets/uploads/products/product 10/images/j9Vmc1fi42.jpg', '2020-09-21 10:03:15', '2020-09-21 10:03:15', NULL),
(456, 11, 'assets/uploads/products/product 11/images/CM4OB7jj7g.jpg', '2020-09-21 10:04:04', '2020-09-21 10:04:04', NULL),
(457, 11, 'assets/uploads/products/product 11/images/Q12hQOTEuh.jpg', '2020-09-21 10:04:04', '2020-09-21 10:04:04', NULL),
(458, 11, 'assets/uploads/products/product 11/images/RSVDZSFVzg.jpg', '2020-09-21 10:04:04', '2020-09-21 10:04:04', NULL),
(459, 11, 'assets/uploads/products/product 11/images/AB4hl2uoin.jpg', '2020-09-21 10:04:04', '2020-09-21 10:04:04', NULL),
(460, 11, 'assets/uploads/products/product 11/images/S1nPuRjPhv.jpg', '2020-09-21 10:04:05', '2020-09-21 10:04:05', NULL),
(461, 11, 'assets/uploads/products/product 11/images/rG26TQXmxu.jpg', '2020-09-21 10:04:05', '2020-09-21 10:04:05', NULL),
(462, 11, 'assets/uploads/products/product 11/images/dAhdzE7B6p.jpg', '2020-09-21 10:04:05', '2020-09-21 10:04:05', NULL),
(463, 11, 'assets/uploads/products/product 11/images/pEoFlY1u8L.jpg', '2020-09-21 10:04:05', '2020-09-21 10:04:05', NULL),
(464, 12, 'assets/uploads/products/product 12/images/RDTDB6AkGm.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', NULL),
(465, 12, 'assets/uploads/products/product 12/images/AlgrkB6EYA.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', NULL),
(466, 12, 'assets/uploads/products/product 12/images/thcNwPzBhW.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', NULL),
(467, 12, 'assets/uploads/products/product 12/images/0nyHRpVVbB.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', NULL),
(468, 12, 'assets/uploads/products/product 12/images/2cSm0DbKG6.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', NULL),
(469, 12, 'assets/uploads/products/product 12/images/9p323fz5c6.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', NULL),
(470, 12, 'assets/uploads/products/product 12/images/y5dRjPlZja.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', NULL),
(471, 12, 'assets/uploads/products/product 12/images/rUVED9z7IU.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', NULL),
(472, 12, 'assets/uploads/products/product 12/images/rscBwUvV25.jpg', '2020-09-21 10:05:28', '2020-09-21 10:05:28', NULL),
(473, 12, 'assets/uploads/products/product 12/images/erm53vG9tv.jpg', '2020-09-21 10:05:29', '2020-09-21 10:05:29', NULL),
(474, 13, 'assets/uploads/products/product 13/images/XUu9BNoMV5.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', NULL),
(475, 13, 'assets/uploads/products/product 13/images/mOgMolIan2.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', NULL),
(476, 13, 'assets/uploads/products/product 13/images/rI79ttWsgJ.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', NULL),
(477, 13, 'assets/uploads/products/product 13/images/tK65PuGVf9.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', NULL),
(478, 13, 'assets/uploads/products/product 13/images/pgKwJKgEg3.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', NULL),
(479, 13, 'assets/uploads/products/product 13/images/kGogGoCDWr.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', NULL),
(480, 13, 'assets/uploads/products/product 13/images/1s04B22wBX.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', NULL),
(481, 13, 'assets/uploads/products/product 13/images/zpCE3r84Dj.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', NULL),
(482, 13, 'assets/uploads/products/product 13/images/9t3V2sJWwX.jpg', '2020-09-21 10:06:47', '2020-09-21 10:06:47', NULL),
(483, 14, 'assets/uploads/products/product 14/images/4C3lr9JAQS.jpg', '2020-09-21 10:09:06', '2020-09-21 10:09:06', NULL),
(484, 14, 'assets/uploads/products/product 14/images/jRBlY05CG1.jpg', '2020-09-21 10:09:06', '2020-09-21 10:09:06', NULL),
(485, 14, 'assets/uploads/products/product 14/images/1t8jjiBK2c.jpg', '2020-09-21 10:09:06', '2020-09-21 10:09:06', NULL),
(486, 14, 'assets/uploads/products/product 14/images/QkiDKvpFMt.jpg', '2020-09-21 10:09:06', '2020-09-21 10:09:06', NULL),
(487, 14, 'assets/uploads/products/product 14/images/dYznFU0E39.jpg', '2020-09-21 10:09:06', '2020-09-21 10:09:06', NULL),
(488, 14, 'assets/uploads/products/product 14/images/4ig1I9LBI8.jpg', '2020-09-21 10:09:06', '2020-09-21 10:09:06', NULL),
(489, 14, 'assets/uploads/products/product 14/images/brh65uGzeb.jpg', '2020-09-21 10:09:06', '2020-09-21 10:09:06', NULL),
(490, 14, 'assets/uploads/products/product 14/images/sutTUohsp8.jpg', '2020-09-21 10:09:06', '2020-09-21 10:09:06', NULL),
(491, 14, 'assets/uploads/products/product 14/images/y0g3Bvv9Gk.jpg', '2020-09-21 10:09:07', '2020-09-21 10:09:07', NULL),
(492, 16, 'assets/uploads/products/product 16/images/GUqW851uAT.jpg', '2020-09-21 10:10:08', '2020-09-21 10:10:08', NULL),
(493, 16, 'assets/uploads/products/product 16/images/5FKkPzAe3L.jpg', '2020-09-21 10:10:08', '2020-09-21 10:10:08', NULL),
(494, 16, 'assets/uploads/products/product 16/images/c8zaT0WwP8.jpg', '2020-09-21 10:10:09', '2020-09-21 10:10:09', NULL),
(495, 16, 'assets/uploads/products/product 16/images/ZzYJhQkZwF.jpg', '2020-09-21 10:10:09', '2020-09-21 10:10:09', NULL),
(496, 16, 'assets/uploads/products/product 16/images/hNNsQkCbe0.jpg', '2020-09-21 10:10:09', '2020-09-21 10:10:09', NULL),
(497, 16, 'assets/uploads/products/product 16/images/QZQBToTLS9.jpg', '2020-09-21 10:10:09', '2020-09-21 10:10:09', NULL),
(498, 16, 'assets/uploads/products/product 16/images/EPzcvxmLAk.jpg', '2020-09-21 10:10:09', '2020-09-21 10:10:09', NULL),
(499, 16, 'assets/uploads/products/product 16/images/W0LxsWgzfO.jpg', '2020-09-21 10:10:09', '2020-09-21 10:10:09', NULL),
(500, 16, 'assets/uploads/products/product 16/images/B5YAW7ndJ7.jpg', '2020-09-21 10:10:09', '2020-09-21 10:10:09', NULL),
(501, 16, 'assets/uploads/products/product 16/images/QyRgxDQ8gs.jpg', '2020-09-21 10:10:09', '2020-09-21 10:10:09', NULL),
(502, 15, 'assets/uploads/products/product 15/images/qcqgklwCM9.jpg', '2020-09-21 10:10:56', '2020-09-21 10:10:56', NULL),
(503, 15, 'assets/uploads/products/product 15/images/2AUDNWyS7r.jpg', '2020-09-21 10:10:56', '2020-09-21 10:10:56', NULL),
(504, 15, 'assets/uploads/products/product 15/images/iDoHS9zIlI.jpg', '2020-09-21 10:10:56', '2020-09-21 10:10:56', NULL),
(505, 15, 'assets/uploads/products/product 15/images/8kNIKRmjJZ.jpg', '2020-09-21 10:10:56', '2020-09-21 10:10:56', NULL),
(506, 15, 'assets/uploads/products/product 15/images/sromznJAvw.jpg', '2020-09-21 10:10:56', '2020-09-21 10:10:56', NULL),
(507, 15, 'assets/uploads/products/product 15/images/mcnPeiorC0.jpg', '2020-09-21 10:10:56', '2020-09-21 10:10:56', NULL),
(508, 15, 'assets/uploads/products/product 15/images/UNP49dkkqz.jpg', '2020-09-21 10:10:56', '2020-09-21 10:10:56', NULL),
(509, 15, 'assets/uploads/products/product 15/images/YxCEjTB4u1.jpg', '2020-09-21 10:10:57', '2020-09-21 10:10:57', NULL),
(510, 17, 'assets/uploads/products/product 17/images/RvKOrjJv22.jpg', '2020-09-21 10:12:15', '2020-09-21 10:12:15', NULL),
(511, 17, 'assets/uploads/products/product 17/images/diUW5UflM7.jpg', '2020-09-21 10:12:15', '2020-09-21 10:12:15', NULL),
(512, 17, 'assets/uploads/products/product 17/images/UpM5bQsFNB.jpg', '2020-09-21 10:12:15', '2020-09-21 10:12:15', NULL),
(513, 17, 'assets/uploads/products/product 17/images/QaasGHXGy2.jpg', '2020-09-21 10:12:15', '2020-09-21 10:12:15', NULL),
(514, 17, 'assets/uploads/products/product 17/images/GZn7QvlYS7.jpg', '2020-09-21 10:12:15', '2020-09-21 10:12:15', NULL),
(515, 17, 'assets/uploads/products/product 17/images/yc1Yjlrf75.jpg', '2020-09-21 10:12:15', '2020-09-21 10:12:15', NULL),
(516, 17, 'assets/uploads/products/product 17/images/5PITdRVdJH.jpg', '2020-09-21 10:12:15', '2020-09-21 10:12:15', NULL),
(517, 17, 'assets/uploads/products/product 17/images/d5bDcGItwT.jpg', '2020-09-21 10:12:16', '2020-09-21 10:12:16', NULL),
(518, 17, 'assets/uploads/products/product 17/images/8Wmt39775k.jpg', '2020-09-21 10:12:16', '2020-09-21 10:12:16', NULL),
(519, 18, 'assets/uploads/products/product 18/images/c6h1Csxb8Z.jpg', '2020-09-21 10:13:14', '2020-09-21 10:13:14', NULL),
(520, 18, 'assets/uploads/products/product 18/images/B4Rflq1GNs.jpg', '2020-09-21 10:13:14', '2020-09-21 10:13:14', NULL),
(521, 18, 'assets/uploads/products/product 18/images/VcEapWtcpW.jpg', '2020-09-21 10:13:14', '2020-09-21 10:13:14', NULL),
(522, 18, 'assets/uploads/products/product 18/images/QwU2L3bLD5.jpg', '2020-09-21 10:13:15', '2020-09-21 10:13:15', NULL),
(523, 18, 'assets/uploads/products/product 18/images/3YsbWqEbHV.jpg', '2020-09-21 10:13:15', '2020-09-21 10:13:15', NULL),
(524, 18, 'assets/uploads/products/product 18/images/dDLfwBohjG.jpg', '2020-09-21 10:13:15', '2020-09-21 10:13:15', NULL),
(525, 18, 'assets/uploads/products/product 18/images/hveUZfTdRj.jpg', '2020-09-21 10:13:15', '2020-09-21 10:13:15', NULL),
(526, 18, 'assets/uploads/products/product 18/images/306O0dYh0r.jpg', '2020-09-21 10:13:15', '2020-09-21 10:13:15', NULL),
(527, 20, 'assets/uploads/products/product 20/images/TOupNq8OmZ.jpg', '2020-09-21 10:30:05', '2020-09-21 10:30:05', NULL),
(528, 20, 'assets/uploads/products/product 20/images/BpTmT5yljL.jpg', '2020-09-21 10:30:05', '2020-09-21 10:30:05', NULL),
(529, 20, 'assets/uploads/products/product 20/images/HptMd6C77O.jpg', '2020-09-21 10:30:05', '2020-09-21 10:30:05', NULL),
(530, 20, 'assets/uploads/products/product 20/images/h1oUkrWkF6.jpg', '2020-09-21 10:30:05', '2020-09-21 10:30:05', NULL),
(531, 20, 'assets/uploads/products/product 20/images/mjiy25Ckrm.jpg', '2020-09-21 10:30:05', '2020-09-21 10:30:05', NULL),
(532, 20, 'assets/uploads/products/product 20/images/VggneTjAEh.jpg', '2020-09-21 10:30:06', '2020-09-21 10:30:06', NULL),
(533, 20, 'assets/uploads/products/product 20/images/t5U3KPsxf7.jpg', '2020-09-21 10:30:06', '2020-09-21 10:30:06', NULL),
(534, 20, 'assets/uploads/products/product 20/images/Y3jNQj3p9Z.jpg', '2020-09-21 10:30:06', '2020-09-21 10:30:06', NULL),
(535, 20, 'assets/uploads/products/product 20/images/wi14hktmIQ.jpg', '2020-09-21 10:30:06', '2020-09-21 10:30:06', NULL),
(536, 20, 'assets/uploads/products/product 20/images/ebstIrf0X2.jpg', '2020-09-21 10:30:06', '2020-09-21 10:30:06', NULL),
(537, 19, 'assets/uploads/products/product 19/images/XGhURdLHrk.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', NULL),
(538, 19, 'assets/uploads/products/product 19/images/G6elV9EsEE.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', NULL),
(539, 19, 'assets/uploads/products/product 19/images/33tQdIzX89.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', NULL),
(540, 19, 'assets/uploads/products/product 19/images/IhDqeR883z.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', NULL),
(541, 19, 'assets/uploads/products/product 19/images/hS9rvOSrBV.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', NULL),
(542, 19, 'assets/uploads/products/product 19/images/wMJWW5m7YP.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', NULL),
(543, 19, 'assets/uploads/products/product 19/images/tMfQ8QJbIa.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', NULL),
(544, 19, 'assets/uploads/products/product 19/images/bywdBvLkIR.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', NULL),
(545, 19, 'assets/uploads/products/product 19/images/y0sCaHr2Yu.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', NULL),
(546, 19, 'assets/uploads/products/product 19/images/BwjkSidAMT.jpg', '2020-09-21 10:31:05', '2020-09-21 10:31:05', NULL),
(547, 21, 'assets/uploads/products/product 21/images/FLjEUK56hK.jpg', '2020-09-21 10:37:46', '2020-09-21 10:37:46', NULL),
(548, 21, 'assets/uploads/products/product 21/images/1w87tYqKD0.jpg', '2020-09-21 10:37:46', '2020-09-21 10:37:46', NULL),
(549, 21, 'assets/uploads/products/product 21/images/aiDWYVEcJ4.jpg', '2020-09-21 10:37:46', '2020-09-21 10:37:46', NULL),
(550, 21, 'assets/uploads/products/product 21/images/WZOQiZa8R0.jpg', '2020-09-21 10:37:46', '2020-09-21 10:37:46', NULL),
(551, 21, 'assets/uploads/products/product 21/images/8EsLvxplzG.jpg', '2020-09-21 10:37:46', '2020-09-21 10:37:46', NULL),
(552, 21, 'assets/uploads/products/product 21/images/s9bIiHiLZB.jpg', '2020-09-21 10:37:46', '2020-09-21 10:37:46', NULL),
(553, 21, 'assets/uploads/products/product 21/images/M0W71FZcHR.jpg', '2020-09-21 10:37:46', '2020-09-21 10:37:46', NULL),
(554, 21, 'assets/uploads/products/product 21/images/swYVxFwpMZ.jpg', '2020-09-21 10:37:46', '2020-09-21 10:37:46', NULL),
(555, 22, 'assets/uploads/products/product 22/images/lwUMCjXjzR.jpg', '2020-09-21 10:41:41', '2020-09-21 10:41:41', NULL),
(556, 22, 'assets/uploads/products/product 22/images/e5TvoYrhTY.jpg', '2020-09-21 10:41:41', '2020-09-21 10:41:41', NULL),
(557, 22, 'assets/uploads/products/product 22/images/8XHzRbUq3o.jpg', '2020-09-21 10:41:41', '2020-09-21 10:41:41', NULL),
(558, 22, 'assets/uploads/products/product 22/images/ZQq8Xno54w.jpg', '2020-09-21 10:41:41', '2020-09-21 10:41:41', NULL),
(559, 22, 'assets/uploads/products/product 22/images/SLEYVCb5vE.jpg', '2020-09-21 10:41:41', '2020-09-21 10:41:41', NULL),
(560, 22, 'assets/uploads/products/product 22/images/j1eLNGLzFS.jpg', '2020-09-21 10:41:41', '2020-09-21 10:41:41', NULL),
(561, 22, 'assets/uploads/products/product 22/images/BHgIMVru91.jpg', '2020-09-21 10:41:41', '2020-09-21 10:41:41', NULL),
(562, 22, 'assets/uploads/products/product 22/images/cFZt9QKvCW.jpg', '2020-09-21 10:41:41', '2020-09-21 10:41:41', NULL),
(563, 22, 'assets/uploads/products/product 22/images/G1p9eOW3Jd.jpg', '2020-09-21 10:41:41', '2020-09-21 10:41:41', NULL),
(564, 23, 'assets/uploads/products/product 23/images/9u1SHCVg66.jpg', '2020-09-21 10:42:32', '2020-09-21 10:42:32', NULL),
(565, 23, 'assets/uploads/products/product 23/images/hvMFVNaNnx.jpg', '2020-09-21 10:42:32', '2020-09-21 10:42:32', NULL),
(566, 23, 'assets/uploads/products/product 23/images/XyRW53SDmS.jpg', '2020-09-21 10:42:32', '2020-09-21 10:42:32', NULL),
(567, 23, 'assets/uploads/products/product 23/images/vcRGdoMoPq.jpg', '2020-09-21 10:42:32', '2020-09-21 10:42:32', NULL),
(568, 23, 'assets/uploads/products/product 23/images/fvxQWS2zPG.jpg', '2020-09-21 10:42:32', '2020-09-21 10:42:32', NULL),
(569, 23, 'assets/uploads/products/product 23/images/FgdRPfS7rX.jpg', '2020-09-21 10:42:32', '2020-09-21 10:42:32', NULL),
(570, 23, 'assets/uploads/products/product 23/images/AhAzrzhALM.jpg', '2020-09-21 10:42:32', '2020-09-21 10:42:32', NULL),
(571, 23, 'assets/uploads/products/product 23/images/sDPl6VacCX.jpg', '2020-09-21 10:42:32', '2020-09-21 10:42:32', NULL),
(572, 23, 'assets/uploads/products/product 23/images/qTJi4Kedcr.jpg', '2020-09-21 10:42:32', '2020-09-21 10:42:32', NULL),
(573, 23, 'assets/uploads/products/product 23/images/1TShxXRTNX.jpg', '2020-09-21 10:42:32', '2020-09-21 10:42:32', NULL),
(574, 23, 'assets/uploads/products/product 23/images/u9WVJJpB7V.jpg', '2020-09-21 10:42:32', '2020-09-21 10:42:32', NULL),
(575, 23, 'assets/uploads/products/product 23/images/BpnRdjK23M.jpg', '2020-09-21 10:42:33', '2020-09-21 10:42:33', NULL),
(576, 24, 'assets/uploads/products/product 24/images/kHstmkTWcX.jpg', '2020-09-21 10:43:21', '2020-09-21 10:43:21', NULL),
(577, 24, 'assets/uploads/products/product 24/images/X986CRuDw2.jpg', '2020-09-21 10:43:22', '2020-09-21 10:43:22', NULL),
(578, 24, 'assets/uploads/products/product 24/images/0yfXSE93H6.jpg', '2020-09-21 10:43:22', '2020-09-21 10:43:22', NULL),
(579, 24, 'assets/uploads/products/product 24/images/13KgouRmq2.jpg', '2020-09-21 10:43:22', '2020-09-21 10:43:22', NULL),
(580, 24, 'assets/uploads/products/product 24/images/ELeZOL5lo7.jpg', '2020-09-21 10:43:22', '2020-09-21 10:43:22', NULL),
(581, 24, 'assets/uploads/products/product 24/images/DHen9yBwG4.jpg', '2020-09-21 10:43:22', '2020-09-21 10:43:22', NULL),
(582, 24, 'assets/uploads/products/product 24/images/HvGnvfdBAW.jpg', '2020-09-21 10:43:22', '2020-09-21 10:43:22', NULL),
(583, 24, 'assets/uploads/products/product 24/images/vJRiDXoXcz.jpg', '2020-09-21 10:43:22', '2020-09-21 10:43:22', NULL),
(584, 24, 'assets/uploads/products/product 24/images/j0Q1Qm2CXc.jpg', '2020-09-21 10:43:22', '2020-09-21 10:43:22', NULL),
(585, 25, 'assets/uploads/products/product 25/images/9PskwA0wK0.jpg', '2020-09-21 10:44:07', '2020-09-21 10:44:07', NULL),
(586, 25, 'assets/uploads/products/product 25/images/enHkA35uEW.jpg', '2020-09-21 10:44:07', '2020-09-21 10:44:07', NULL),
(587, 25, 'assets/uploads/products/product 25/images/9d32ftnCTC.jpg', '2020-09-21 10:44:07', '2020-09-21 10:44:07', NULL),
(588, 25, 'assets/uploads/products/product 25/images/E3TYLmeXt2.jpg', '2020-09-21 10:44:07', '2020-09-21 10:44:07', NULL),
(589, 25, 'assets/uploads/products/product 25/images/aYozVSkb8i.jpg', '2020-09-21 10:44:07', '2020-09-21 10:44:07', NULL),
(590, 25, 'assets/uploads/products/product 25/images/GMLLXgWoZm.jpg', '2020-09-21 10:44:07', '2020-09-21 10:44:07', NULL),
(591, 25, 'assets/uploads/products/product 25/images/sgWlgpIOOI.jpg', '2020-09-21 10:44:07', '2020-09-21 10:44:07', NULL),
(592, 25, 'assets/uploads/products/product 25/images/ocsncBlGAw.jpg', '2020-09-21 10:44:08', '2020-09-21 10:44:08', NULL),
(593, 25, 'assets/uploads/products/product 25/images/euCoAo5sef.jpg', '2020-09-21 10:44:08', '2020-09-21 10:44:08', NULL),
(594, 26, 'assets/uploads/products/product 26/images/gaTu3qWDis.jpg', '2020-09-21 10:46:22', '2020-09-21 10:46:22', NULL),
(595, 26, 'assets/uploads/products/product 26/images/urFL9Sp78b.jpg', '2020-09-21 10:46:22', '2020-09-21 10:46:22', NULL),
(596, 26, 'assets/uploads/products/product 26/images/c9f4PmBPJy.jpg', '2020-09-21 10:46:22', '2020-09-21 10:46:22', NULL),
(597, 26, 'assets/uploads/products/product 26/images/cKi8SqBwvq.jpg', '2020-09-21 10:46:22', '2020-09-21 10:46:22', NULL),
(598, 26, 'assets/uploads/products/product 26/images/cGIU4cfWwA.jpg', '2020-09-21 10:46:22', '2020-09-21 10:46:22', NULL),
(599, 26, 'assets/uploads/products/product 26/images/lsiz8nfv7C.jpg', '2020-09-21 10:46:22', '2020-09-21 10:46:22', NULL),
(600, 26, 'assets/uploads/products/product 26/images/boJ1Tyslbd.jpg', '2020-09-21 10:46:22', '2020-09-21 10:46:22', NULL),
(601, 26, 'assets/uploads/products/product 26/images/koe8kGQWrh.jpg', '2020-09-21 10:46:22', '2020-09-21 10:46:22', NULL),
(602, 27, 'assets/uploads/products/product 27/images/hcV1ocZgSX.jpg', '2020-09-21 10:47:05', '2020-09-21 10:47:05', NULL),
(603, 27, 'assets/uploads/products/product 27/images/G7jBYwpio9.jpg', '2020-09-21 10:47:06', '2020-09-21 10:47:06', NULL),
(604, 27, 'assets/uploads/products/product 27/images/2NcewoDI0s.jpg', '2020-09-21 10:47:06', '2020-09-21 10:47:06', NULL),
(605, 27, 'assets/uploads/products/product 27/images/Eyjs5032Hy.jpg', '2020-09-21 10:47:06', '2020-09-21 10:47:06', NULL),
(606, 27, 'assets/uploads/products/product 27/images/T70nuitteI.jpg', '2020-09-21 10:47:06', '2020-09-21 10:47:06', NULL),
(607, 27, 'assets/uploads/products/product 27/images/a92c0ep1wd.jpg', '2020-09-21 10:47:06', '2020-09-21 10:47:06', NULL),
(608, 27, 'assets/uploads/products/product 27/images/t4tnyenUF2.jpg', '2020-09-21 10:47:06', '2020-09-21 10:47:06', NULL),
(609, 48, 'assets/uploads/products/product 48/images/joxrFrqijQ.jpg', '2020-09-28 06:15:57', '2020-09-28 06:15:57', NULL),
(610, 49, 'assets/uploads/products/product 49/images/aKihEAco1r.jpg', '2020-09-28 06:18:02', '2020-09-28 06:18:02', NULL),
(611, 50, 'assets/uploads/products/product 50/images/3rhUdaUuqv.jpg', '2020-09-28 06:18:44', '2020-09-28 06:18:44', NULL),
(612, 51, 'assets/uploads/products/product 51/images/IKEXISp6mt.jpg', '2020-09-28 06:19:23', '2020-09-28 06:19:23', NULL),
(613, 52, 'assets/uploads/products/product 52/images/mXzsa2kG7b.jpg', '2020-09-28 06:20:38', '2020-09-28 06:20:38', NULL),
(614, 53, 'assets/uploads/products/product 53/images/v9H1QiI9o9.jpg', '2020-09-28 06:21:28', '2020-09-28 06:21:28', NULL),
(615, 54, 'assets/uploads/products/product 54/images/xqdhmmATjY.jpg', '2020-09-28 06:22:28', '2020-09-28 06:22:28', NULL),
(616, 55, 'assets/uploads/products/product 55/images/78TWYfw2cy.jpg', '2020-09-28 06:23:36', '2020-09-28 06:23:36', NULL),
(617, 56, 'assets/uploads/products/product 56/images/rnARy9ZaBD.jpg', '2020-09-28 06:27:08', '2020-09-28 06:27:08', NULL),
(618, 57, 'assets/uploads/products/product 57/images/G8JykNoX1t.jpg', '2020-09-28 06:28:02', '2020-09-28 06:28:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2018-11-21 19:38:36', '2018-11-21 19:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_no` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone_no`, `email`, `password`, `remember_token`, `active`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '0712587412', 'sltds@admin.lk', '$2y$10$07fGKyOH29tuHDTZv8kAOORNpcu.UoX0z3rWJ.GwoCJjayBWS/Lvu', 'qsS5JrutJKXAFVzT6Aauga7yAeKh61vbIVapYS0XphMNirLojwx3feYZgFNw', 1, 1, '2019-10-01 10:02:39', NULL),
(2, 'client', '0723698525', 'client@admin.lk', '$2y$10$ktchUaRywC8Od7KkZhk4we6O44i0OSyDPrXP.Hwf0bx595zHH8eV6', '2GhTNzpr0e9iiu30TOYZE6cJx90XV101cGLm5hOQ0Ah8KJoNAYNj3Ek9fgl3', 1, 1, '2019-10-02 01:06:21', '2020-02-13 05:19:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=619;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
