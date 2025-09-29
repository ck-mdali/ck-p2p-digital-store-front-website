-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 29, 2025 at 11:12 AM
-- Server version: 8.0.41
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ck_p2p_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `name`, `image`, `link`, `created_at`, `updated_at`, `status`) VALUES
(1, 'test', 'https://placehold.co/1100x200/EEE/31343C', 'https://google.com', NULL, NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin@email.com|127.0.0.1', 'i:2;', 1758476355),
('laravel-cache-admin@email.com|127.0.0.1:timer', 'i:1758476355;', 1758476355);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `added_by`, `created_at`, `updated_at`) VALUES
(3, 'HTML Templates', 'html-templates', 'hiouh12345', 'categories/YJz3gs3Tha84hQqYb4eKZ1KvMz9TFRcGicPxAiYB.jpg', 1, '2025-09-21 07:22:35', '2025-09-21 07:26:46'),
(4, 'Flutter Templates', 'flutter-templates', 'hulkh12345', 'categories/czhVIrxe0iNjaCwNinbWK5ljFFWzznBFcIzXZa9o.png', 1, '2025-09-21 07:24:24', '2025-09-21 07:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `order_id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 'kuh', '2025-09-21 11:57:55', '2025-09-21 11:57:55'),
(2, 8, 1, 'okay', '2025-09-21 11:57:55', '2025-09-21 11:57:55'),
(3, 8, 2, 'sfdasdf', '2025-09-21 12:01:24', '2025-09-21 12:01:24'),
(4, 9, 2, 'Okay', '2025-09-27 03:00:56', '2025-09-27 03:00:56'),
(5, 9, 1, 'Hey please do the payment', '2025-09-27 03:24:20', '2025-09-27 03:24:20'),
(6, 9, 2, 'Doing', '2025-09-27 03:24:42', '2025-09-27 03:24:42'),
(7, 9, 2, 'Where to do it', '2025-09-27 03:25:35', '2025-09-27 03:25:35'),
(8, 9, 1, 'Simple, 3 types of details are given, upi bank or crypto, send money on the details given and enter trx id in the box and click mark as paid', '2025-09-27 03:26:06', '2025-09-27 03:26:06'),
(9, 9, 2, 'acha oh ok', '2025-09-27 03:26:21', '2025-09-27 03:26:21'),
(10, 9, 2, 'hey', '2025-09-27 03:35:37', '2025-09-27 03:35:37'),
(11, 9, 1, 'Yes, did you do it?', '2025-09-27 03:37:51', '2025-09-27 03:37:51'),
(12, 9, 2, 'no', '2025-09-27 03:38:02', '2025-09-27 03:38:02'),
(13, 9, 1, 'why brothwer', '2025-09-27 03:38:08', '2025-09-27 03:38:08'),
(14, 9, 2, 'its very confuding', '2025-09-27 03:38:18', '2025-09-27 03:38:18'),
(15, 9, 1, 'wait do one thing, call me on +91 799 780 7419', '2025-09-27 03:38:30', '2025-09-27 03:38:30'),
(16, 9, 2, 'okay', '2025-09-27 03:43:18', '2025-09-27 03:43:18'),
(17, 9, 2, 'nice', '2025-09-27 03:43:49', '2025-09-27 03:43:49'),
(18, 9, 2, 'ARE YOU THERE?', '2025-09-27 03:46:23', '2025-09-27 03:46:23'),
(19, 9, 1, 'Yes', '2025-09-27 03:46:33', '2025-09-27 03:46:33'),
(20, 9, 2, 'MY UPI IS NOT WORKING', '2025-09-27 03:46:51', '2025-09-27 03:46:51'),
(21, 9, 1, 'WHAT I CAN DO', '2025-09-27 03:47:00', '2025-09-27 03:47:00'),
(22, 9, 2, 'SEND BANK DETAILS', '2025-09-27 03:47:08', '2025-09-27 03:47:08'),
(23, 9, 1, ':)', '2025-09-27 03:57:17', '2025-09-27 03:57:17'),
(24, 9, 1, 'Are you happy now?', '2025-09-27 04:44:33', '2025-09-27 04:44:33'),
(25, 9, 1, 'happy', '2025-09-27 04:44:44', '2025-09-27 04:44:44'),
(26, 9, 1, 'Got the file', '2025-09-27 04:45:54', '2025-09-27 04:45:54'),
(27, 9, 1, 'pokpo', '2025-09-27 04:46:05', '2025-09-27 04:46:05'),
(28, 9, 1, 'pl', '2025-09-27 04:46:40', '2025-09-27 04:46:40'),
(29, 9, 2, 'sadf', '2025-09-27 04:59:02', '2025-09-27 04:59:02'),
(30, 7, 1, 'Hey', '2025-09-27 04:59:19', '2025-09-27 04:59:19'),
(31, 10, 2, 'Hi boss', '2025-09-27 04:59:47', '2025-09-27 04:59:47'),
(32, 10, 1, 'Yes, please pay and click the button', '2025-09-27 05:00:03', '2025-09-27 05:00:03'),
(33, 10, 2, 'ok', '2025-09-27 05:00:12', '2025-09-27 05:00:12'),
(34, 10, 2, 'can i call?', '2025-09-27 05:00:55', '2025-09-27 05:00:55'),
(35, 10, 1, 'need to ask boss', '2025-09-27 05:01:31', '2025-09-27 05:01:31'),
(36, 10, 2, 'why', '2025-09-27 05:01:53', '2025-09-27 05:01:53'),
(37, 10, 1, 'policy', '2025-09-27 05:02:47', '2025-09-27 05:02:47'),
(38, 10, 2, 'achaaa bhai', '2025-09-27 05:02:55', '2025-09-27 05:02:55'),
(39, 10, 1, 'haan bhai', '2025-09-27 05:07:59', '2025-09-27 05:07:59');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `reply_id` bigint UNSIGNED DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `user_id`, `parent_id`, `reply_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'ABCD', '2025-09-24 02:05:29', '2025-09-24 02:05:29'),
(2, 1, 1, 1, 1, 'I KNOW BABY', '2025-09-24 02:05:29', '2025-09-24 02:05:29'),
(3, 1, 1, 1, NULL, 'Okay thats fantastic', '2025-09-24 02:19:58', '2025-09-24 02:19:58'),
(4, 1, 2, 1, NULL, 'Im also a admin', '2025-09-24 02:25:35', '2025-09-24 02:25:35'),
(5, 1, 1, 1, NULL, 'Sorry bro, you have been removed from admin role!', '2025-09-24 02:26:16', '2025-09-24 02:26:16'),
(6, 1, 1, NULL, NULL, 'So what i want to ask, can we get reports module in this application???', '2025-09-24 02:31:03', '2025-09-24 02:31:03'),
(7, 1, 1, NULL, NULL, 'Please add mobile application to it', '2025-09-24 02:37:16', '2025-09-24 02:37:16'),
(8, 1, 1, 7, NULL, 'I mean flutter', '2025-09-24 02:37:26', '2025-09-24 02:37:26'),
(9, 1, 1, 6, NULL, 'Please respond', '2025-09-24 02:37:34', '2025-09-24 02:37:34'),
(10, 1, 1, NULL, NULL, 'What about REACT NATIVE mobile app for it, and also can i get API docs with it?', '2025-09-24 02:37:52', '2025-09-24 02:37:52'),
(11, 1, 1, NULL, NULL, 'This platform is awesome, im loving it', '2025-09-24 02:38:25', '2025-09-24 02:38:25'),
(12, 1, 1, NULL, NULL, 'HEY ALL NEW USERS, TRUST THIS PLATFORM, THIS IS AMAZIG.. bhot badiya bhai', '2025-09-24 02:38:42', '2025-09-24 02:38:42'),
(13, 1, 1, NULL, NULL, 'Muhammed shariq ne to kamal kar dikhaya hai, pura india khush hai is platform ke liye', '2025-09-24 02:39:03', '2025-09-24 02:39:03'),
(14, 1, 1, 13, NULL, 'bhai ek meetup karlo aap jab ham hyd ayenge to', '2025-09-24 02:39:59', '2025-09-24 02:39:59'),
(15, 1, 1, NULL, NULL, 'AUR BHAI', '2025-09-28 02:21:51', '2025-09-28 02:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `freelancers`
--

CREATE TABLE `freelancers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tagline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `github_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portfolios` text COLLATE utf8mb4_unicode_ci,
  `pricing_usd` decimal(8,2) DEFAULT NULL,
  `pricing_inr` decimal(8,2) DEFAULT NULL,
  `pricing_tagline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skills` text COLLATE utf8mb4_unicode_ci,
  `address` text COLLATE utf8mb4_unicode_ci,
  `aadhaar_card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_badge` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `rating` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `freelancers`
--

INSERT INTO `freelancers` (`id`, `user_id`, `tagline`, `about`, `github_link`, `website_link`, `youtube_link`, `instagram_link`, `linkedin_link`, `portfolios`, `pricing_usd`, `pricing_inr`, `pricing_tagline`, `skills`, `address`, `aadhaar_card`, `pan_card`, `profile_picture`, `verified_badge`, `status`, `rating`, `created_at`, `updated_at`) VALUES
(1, 2, 'FULLSTACK DEVELOPER | Wordpress | Laravel | Flutter | Laravel Filament', '8 Years experience in developing websites, mobile apps, software tools for businesses.', NULL, NULL, 'https://www.youtube.com/embed/qSYKItOoHek?si=v1qIKGVtTa8PFvM2', NULL, NULL, NULL, 10.00, 1000.00, 'I charge custom price for custom projects', 'php, node js, flutter, python', 'Hyderabad', NULL, NULL, 'https://placehold.co/600x300/EEE/31343C', 1, 'active', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(6, '2025_09_21_120402_create_categories_table', 2),
(7, '2025_09_21_120403_create_products_table', 2),
(8, '2025_09_21_162926_create_payment_types_table', 3),
(9, '2025_09_21_162927_create_orders_table', 3),
(10, '2025_09_21_172139_create_chat_messages_table', 4),
(11, '2025_09_22_043815_create_transactions_table', 5),
(12, '2025_09_22_055538_create_banners_table', 6),
(13, '2025_09_24_072916_create_comments_table', 7),
(14, '2025_09_24_090604_create_freelancers_table', 8),
(15, '2025_09_27_065319_create_pages_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `amount_usd` decimal(10,2) NOT NULL,
  `amount_inr` decimal(10,2) NOT NULL,
  `payment_type_id` bigint UNSIGNED DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `admin_read` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `status`, `amount_usd`, `amount_inr`, `payment_type_id`, `notes`, `admin_read`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'new', 60.00, 60000.00, NULL, NULL, 0, '2025-09-21 11:11:46', '2025-09-21 11:11:46'),
(3, 1, 1, 'new', 60.00, 60000.00, NULL, NULL, 0, '2025-09-21 11:12:06', '2025-09-21 11:12:06'),
(4, 1, 1, 'new', 60.00, 60000.00, NULL, NULL, 0, '2025-09-21 11:12:38', '2025-09-21 11:12:38'),
(5, 1, 1, 'new', 60.00, 60000.00, NULL, NULL, 1, '2025-09-21 11:13:33', '2025-09-28 02:31:20'),
(6, 1, 1, 'new', 60.00, 60000.00, NULL, NULL, 1, '2025-09-21 11:13:36', '2025-09-28 02:34:26'),
(7, 1, 1, 'new', 60.00, 60000.00, NULL, NULL, 1, '2025-09-21 11:15:30', '2025-09-28 02:28:19'),
(8, 1, 1, 'completed', 60.00, 60000.00, NULL, NULL, 1, '2025-09-21 11:15:53', '2025-09-28 02:28:44'),
(9, 2, 1, 'completed', 60.00, 60000.00, 2, NULL, 0, '2025-09-27 03:00:45', '2025-09-27 04:15:09'),
(10, 2, 1, 'denied', 60.00, 60000.00, 2, NULL, 1, '2025-09-27 04:59:43', '2025-09-28 02:27:53'),
(11, 3, 1, 'new', 60.00, 60000.00, NULL, NULL, 0, '2025-09-28 04:50:29', '2025-09-28 04:50:29'),
(12, 3, 1, 'new', 60.00, 60000.00, NULL, NULL, 0, '2025-09-28 04:51:38', '2025-09-28 04:51:38'),
(13, 3, 1, 'new', 60.00, 60000.00, NULL, NULL, 0, '2025-09-28 04:52:13', '2025-09-28 04:52:13'),
(14, 3, 1, 'new', 60.00, 60000.00, NULL, NULL, 0, '2025-09-28 04:52:32', '2025-09-28 04:52:32'),
(15, 3, 1, 'pending', 60.00, 60000.00, 2, NULL, 0, '2025-09-28 04:54:34', '2025-09-28 04:56:30'),
(16, 3, 1, 'pending', 60.00, 60000.00, 1, NULL, 0, '2025-09-28 04:57:24', '2025-09-28 05:05:12'),
(17, 3, 1, 'new', 60.00, 60000.00, NULL, NULL, 0, '2025-09-28 05:06:37', '2025-09-28 05:06:37'),
(18, 1, 1, 'new', 60.00, 60000.00, NULL, NULL, 1, '2025-09-28 05:08:41', '2025-09-28 05:09:16'),
(19, 3, 1, 'new', 60.00, 60000.00, NULL, NULL, 0, '2025-09-28 05:14:46', '2025-09-28 05:14:46'),
(20, 3, 1, 'new', 60.00, 60000.00, NULL, NULL, 0, '2025-09-28 05:16:33', '2025-09-28 05:16:33'),
(21, 3, 1, 'pending', 60.00, 60000.00, 2, NULL, 0, '2025-09-28 05:21:01', '2025-09-28 05:22:14'),
(22, 3, 1, 'pending', 60.00, 60000.00, 1, NULL, 0, '2025-09-28 05:23:56', '2025-09-28 05:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `added_by` bigint UNSIGNED NOT NULL,
  `views` bigint UNSIGNED NOT NULL DEFAULT '0',
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `allow_seo` tinyint(1) NOT NULL DEFAULT '0',
  `is_public` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` timestamp NULL DEFAULT NULL,
  `template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `content`, `meta_title`, `meta_desc`, `meta_keywords`, `added_by`, `views`, `status`, `allow_seo`, `is_public`, `published_at`, `template`, `featured_image`, `created_at`, `updated_at`) VALUES
(1, 'About CK Softwares', 'about', '<div style=\"font-family: sans-serif; line-height: 1.8; color: #333; max-width: 800px; margin: 0 auto; font-size: 16px;\">\n    <h1 style=\"font-size: 32px; font-weight: bold; color: #1f2937;\">About Us</h1>\n\n    <p>\n        Welcome to <strong>{{ config(\'app.name\', \'OurStore\') }}</strong> — your go-to destination for high-quality digital products and expert freelance services.\n    </p>\n\n    <p>\n        We are a passionate team of creators, developers, and dreamers who believe in empowering businesses and individuals through innovation and technology.\n        Our platform is built for:\n    </p>\n\n    <ul style=\"padding-left: 20px; margin-top: 10px;\">\n        <li>✅ Entrepreneurs looking to launch faster</li>\n        <li>✅ Developers in need of ready-made digital tools</li>\n        <li>✅ Businesses hiring skilled freelancers</li>\n    </ul>\n\n    <p style=\"margin-top: 20px;\">\n        Since our launch, we\'ve helped thousands of people access top-tier digital assets and connect with verified professionals across the globe.\n        Whether you\'re a startup founder or a freelancer yourself, we’re here to help you succeed.\n    </p>\n\n    <p style=\"margin-top: 20px;\">\n        <strong>What sets us apart?</strong>\n    </p>\n\n    <ul style=\"padding-left: 20px;\">\n        <li>🌟 Curated products & services</li>\n        <li>🔒 Secure payments</li>\n        <li>💬 Friendly, real-time support</li>\n    </ul>\n\n    <p style=\"margin-top: 20px;\">\n        Thank you for choosing <strong>{{ config(\'app.name\', \'OurStore\') }}</strong>. We’re excited to be part of your journey.\n    </p>\n\n    <p style=\"margin-top: 30px;\">\n        — The {{ config(\'app.name\', \'OurStore\') }} Team\n    </p>\n</div>\n', 'about', 'about us', 'ck softwares', 1, 30, 'published', 1, 1, NULL, NULL, NULL, NULL, '2025-09-28 02:45:27'),
(2, 'Contact Us | CK Softwares', 'contact', '<div style=\"font-family: sans-serif; line-height: 1.6; font-size: 16px;\">\r\n    <p>\r\n        📞 <strong>Call Us:</strong>\r\n        <a href=\"tel:+91 7997807419\" style=\"color: #2563eb; text-decoration: none;\">+91 799 780 7419</a>\r\n    </p>\r\n    <p>\r\n        📧 <strong>Email:</strong>\r\n        <a href=\"mailto:help@cksoftwares.com\" style=\"color: #2563eb; text-decoration: none;\">help@cksoftwares.com</a>\r\n    </p>\r\n</div>\r\n', 'contact', 'ck softwares contact', 'ck softwares, contact', 1, 15, 'published', 1, 1, NULL, NULL, NULL, NULL, '2025-09-28 02:45:13'),
(3, 'Policies', 'policies', '<section class=\"policy-content max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md\">\r\n  <h1 class=\"text-3xl font-bold mb-6\">P2P eCommerce Platform Payment & Refund Policy</h1>\r\n  <p class=\"mb-8\"><strong>Effective Date:</strong> 27 September 2025</p>\r\n\r\n  <h2 class=\"text-2xl font-semibold mt-6 mb-4\">1. Overview</h2>\r\n  <p class=\"mb-4\">\r\n    Welcome to <strong>CK Softwares</strong> — a peer-to-peer marketplace connecting developers and buyers for digital products and freelance services. We empower developers to upload scripts, templates, and showcase their freelancer profiles, while enabling users to purchase these offerings securely.\r\n  </p>\r\n  <p>\r\n    Unlike traditional platforms, our payment system is <strong>person-to-person (P2P)</strong>, facilitating direct manual payments between buyers and sellers with our agent’s support.\r\n  </p>\r\n\r\n  <h2 class=\"text-2xl font-semibold mt-6 mb-4\">2. Payment Process</h2>\r\n  <ul class=\"list-disc list-inside space-y-2\">\r\n    <li>When you initiate a purchase, our platform opens a live chatbox with a dedicated agent.</li>\r\n    <li>On the payment page, you will see the agent\'s payment details such as bank account number, UPI ID, and cryptocurrency wallet addresses.</li>\r\n    <li>You are required to manually transfer the payment to the provided payment option.</li>\r\n    <li>After payment, please inform the agent in the chatbox by sharing the payment confirmation details.</li>\r\n    <li>Our agent will verify the payment and coordinate with the developer/seller to ensure safe and successful delivery of the product or service.</li>\r\n  </ul>\r\n\r\n  <h2 class=\"text-2xl font-semibold mt-6 mb-4\">3. Role of the Agent</h2>\r\n  <ul class=\"list-disc list-inside space-y-2\">\r\n    <li>The agent acts as an intermediary to facilitate and verify transactions between buyers and sellers.</li>\r\n    <li>The agent will assist in communication, verify payment receipt, and provide support to both parties.</li>\r\n    <li>The agent is responsible for ensuring a fair transaction and may intervene to resolve disputes.</li>\r\n  </ul>\r\n\r\n  <h2 class=\"text-2xl font-semibold mt-6 mb-4\">4. Refund Policy</h2>\r\n  <ul class=\"list-disc list-inside space-y-2\">\r\n    <li>In case of any issues or discrepancies with the transaction (e.g., non-delivery of product, incorrect product, or fraud), please notify the agent immediately through the chatbox.</li>\r\n    <li>Our agent will investigate the situation impartially.</li>\r\n    <li>If the agent determines the buyer\'s claim to be valid, a refund will be issued to the buyer from the agent’s side.</li>\r\n    <li>Refunds will be processed promptly once verified, but timing may vary depending on the payment method.</li>\r\n  </ul>\r\n\r\n  <h2 class=\"text-2xl font-semibold mt-6 mb-4\">5. User Responsibilities</h2>\r\n  <ul class=\"list-disc list-inside space-y-2\">\r\n    <li>Buyers must ensure that they follow the instructions carefully when making manual payments.</li>\r\n    <li>Buyers should communicate clearly and promptly with the agent during and after the payment process.</li>\r\n    <li>Sellers are responsible for delivering the purchased product or service as described.</li>\r\n    <li>Both parties are encouraged to maintain transparency and act in good faith.</li>\r\n  </ul>\r\n\r\n  <h2 class=\"text-2xl font-semibold mt-6 mb-4\">6. Disclaimer</h2>\r\n  <p class=\"mb-4\">\r\n    <strong>CK Softwares</strong> does not handle payments directly and is not responsible for the manual payment transactions outside the platform.\r\n  </p>\r\n  <p class=\"mb-4\">\r\n    While we strive to ensure safe transactions through agent support, buyers and sellers engage in payments at their own risk.\r\n  </p>\r\n  <p>\r\n    We recommend keeping records of all payment confirmations and communications for your protection.\r\n  </p>\r\n\r\n  <h2 class=\"text-2xl font-semibold mt-6 mb-4\">7. Contact Us</h2>\r\n  <p>\r\n    For any questions or concerns regarding payments, refunds, or disputes, please contact our support team through the platform’s chatbox or email at \r\n    <a href=\"mailto:help@cksoftwares.com\" class=\"text-blue-600 underline\">help@cksoftwares.com</a>.\r\n  </p>\r\n\r\n  <p class=\"mt-8 font-semibold\">\r\n    By using <strong>CK Softwares</strong>, you agree to this Payment & Refund Policy.\r\n  </p>\r\n</section>\r\n', NULL, 'policies', 'policies', 1, 4, 'published', 1, 1, NULL, NULL, NULL, NULL, '2025-09-28 02:36:31'),
(4, 'Disclaimer', 'disclaimer', '<div class=\"max-w-4xl mx-auto px-6 sm:px-8 lg:px-12 bg-white rounded-xl shadow-md p-10\">\r\n\r\n            <p class=\"mb-4 text-gray-700 leading-relaxed\">\r\n                Welcome to <span class=\"font-semibold text-indigo-600\">CK Softwares</span>. By using our platform, you acknowledge and agree to the following disclaimer regarding the use of our services:\r\n            </p>\r\n\r\n            <h2 class=\"text-2xl font-bold text-gray-800 mt-8 mb-4\">1. Platform Role</h2>\r\n            <p class=\"mb-4 text-gray-700 leading-relaxed\">\r\n                CK Softwares operates as a peer-to-peer marketplace that connects developers (sellers) and users (buyers) for the exchange of digital products and freelance services.\r\n                We do not process payments directly or act as a payment gateway.\r\n            </p>\r\n\r\n            <h2 class=\"text-2xl font-bold text-gray-800 mt-8 mb-4\">2. Manual Payment Transactions</h2>\r\n            <p class=\"mb-4 text-gray-700 leading-relaxed\">\r\n                Payments between buyers and sellers are conducted manually via bank transfer, UPI, cryptocurrency, or other payment methods provided by our agents.\r\n                Buyers and sellers engage in these transactions at their own risk.\r\n            </p>\r\n\r\n            <h2 class=\"text-2xl font-bold text-gray-800 mt-8 mb-4\">3. Agent Support</h2>\r\n            <p class=\"mb-4 text-gray-700 leading-relaxed\">\r\n                Our agents facilitate communication, verify payments, and assist in dispute resolution.\r\n                However, CK Softwares does not guarantee the success or safety of any transaction and is not liable for any losses resulting from these manual payments.\r\n            </p>\r\n\r\n            <h2 class=\"text-2xl font-bold text-gray-800 mt-8 mb-4\">4. User Responsibility</h2>\r\n            <p class=\"mb-4 text-gray-700 leading-relaxed\">\r\n                Users are responsible for exercising caution, verifying payment details, and maintaining records of all transactions and communications.\r\n                We recommend keeping payment confirmations and chat records as proof in case of disputes.\r\n            </p>\r\n\r\n            <h2 class=\"text-2xl font-bold text-gray-800 mt-8 mb-4\">5. Limitation of Liability</h2>\r\n            <p class=\"mb-4 text-gray-700 leading-relaxed\">\r\n                CK Softwares expressly disclaims any liability for direct, indirect, incidental, consequential, or punitive damages arising out of or related to manual payment transactions conducted through our platform.\r\n            </p>\r\n\r\n            <h2 class=\"text-2xl font-bold text-gray-800 mt-8 mb-4\">6. Changes to this Disclaimer</h2>\r\n            <p class=\"mb-4 text-gray-700 leading-relaxed\">\r\n                We reserve the right to update or modify this disclaimer at any time. Changes will be posted on this page with an updated effective date.\r\n                Continued use of the platform after changes constitutes acceptance of the revised disclaimer.\r\n            </p>\r\n\r\n            <h2 class=\"text-2xl font-bold text-gray-800 mt-8 mb-4\">7. Contact Us</h2>\r\n            <p class=\"mb-4 text-gray-700 leading-relaxed\">\r\n                If you have any questions or concerns regarding this disclaimer, please contact us at \r\n                <a href=\"mailto:help@cksoftwares.com\" class=\"text-indigo-600 hover:underline\">help@cksoftwares.com</a>.\r\n            </p>\r\n\r\n            <p class=\"mt-10 text-sm text-gray-500\">\r\n                Effective Date: 27 September 2025\r\n            </p>\r\n        </div>', NULL, 'CK Softwares disclaimer', 'ck softwares', 1, 13, 'published', 1, 1, NULL, NULL, NULL, NULL, '2025-09-28 02:36:34');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('mdali@cksoftwares.com', '$2y$12$txLSvZzn1VTaQBwqPy2bfeGpuGChyxI6wwZAQCFYjutOCtlVgXHw2', '2025-09-28 04:45:03');

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `description` text COLLATE utf8mb4_unicode_ci,
  `added_by` bigint UNSIGNED NOT NULL,
  `inr` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `name`, `status`, `description`, `added_by`, `inr`, `created_at`, `updated_at`) VALUES
(1, 'UPI', 'active', '<div>\n                                                <p class=\"font-semibold text-gray-700\">UPI Payment</p>\n                                                <p class=\"text-gray-600 text-sm mt-1\"><strong>UPI ID:</strong> johndoe@bank</p>\n                                                <p class=\"text-gray-400 text-sm mt-2\">Use your preferred UPI app (Google Pay, PhonePe, Paytm, etc.) to transfer the amount.</p>\n                                                <p class=\"text-gray-400 text-sm\">After payment, please share a screenshot or transaction ID in the chat.</p>\n                                            </div>', 1, 1, NULL, NULL),
(2, 'Bank Details', 'active', '<div>\n                                                <p class=\"font-semibold text-gray-700\">Bank Transfer Details</p>\n                                                <p class=\"text-gray-600 text-sm mt-1\"><strong>Bank:</strong> ABC Bank</p>\n                                                <p class=\"text-gray-600 text-sm\"><strong>Account Name:</strong> John Doe</p>\n                                                <p class=\"text-gray-600 text-sm\"><strong>Account Number:</strong> 1234567890</p>\n                                                <p class=\"text-gray-600 text-sm\"><strong>IFSC:</strong> ABCD0123456</p>\n                                                <p class=\"text-gray-400 text-sm mt-2\">Transfer the exact amount and save the transaction ID to send as proof.</p>\n                                            </div>', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_lt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `screenshots` json DEFAULT NULL,
  `youtube_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price_usd` decimal(10,2) NOT NULL,
  `price_inr` decimal(10,2) NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `added_by` bigint UNSIGNED NOT NULL,
  `demo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stars` decimal(4,1) NOT NULL DEFAULT '3.0',
  `tech_support` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_mods` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` int NOT NULL DEFAULT '0',
  `download_path` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description_lt`, `screenshots`, `youtube_url`, `price_usd`, `price_inr`, `category_id`, `added_by`, `demo_url`, `stars`, `tech_support`, `custom_mods`, `license`, `keywords`, `featured`, `download_path`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Something flutter real estate applictiopn', 'somwthign-re-sdf-asdf', 'a;sdfjas;kldfjasdf;lasjfd', '\"[\\\"https://placehold.co/600x400/EEE/31343C\\\", \\\"https://example.com/screenshot2.jpg\\\", \\\"https://example.com/screenshot3.jpg\\\"]\"', 'https://www.youtube.com/embed/qSYKItOoHek?si=v1qIKGVtTa8PFvM2', 60.00, 60000.00, 3, 1, 'https://google.com', 4.2, 'NO available', 'NO', 'NO', 'NO', 1, '112211.txt', 'published', '2025-09-21 07:32:33', '2025-09-21 07:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FRAUaQdC0z56d3UJeJwaHoEJGDWf071So2kSHCEj', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVWh4V3BpZ1p3UEFRcnpmanRCeE1JQTBvS1FlelhDZndJaEMzOVY2MiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vY2stcDJwLXN0b3JlLnRlc3QiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO3M6MzoidXJsIjthOjA6e319', 1759058569);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `verified_by` bigint UNSIGNED DEFAULT NULL,
  `amount_usd` decimal(10,2) NOT NULL,
  `amount_inr` decimal(10,2) NOT NULL,
  `payment_type_id` bigint UNSIGNED NOT NULL,
  `trx_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `user_id`, `verified_by`, `amount_usd`, `amount_inr`, `payment_type_id`, `trx_id`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 9, 2, 1, 60.00, 60000.00, 2, 'TRX68D7B22530E37', 'Order updated by admin.', 'verified', '2025-09-27 04:15:09', '2025-09-27 04:15:09'),
(2, 10, 2, 1, 60.00, 60000.00, 2, 'TRX68D7C1E5370D8', 'Order updated by admin.', 'denied', '2025-09-27 05:22:21', '2025-09-27 05:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Muhammed Ali', 'mdali@cksoftwares.com', 'admin', '2025-09-28 10:38:20', '$2y$12$419FSuXlw5BQhEWc/rGTCOiP/FGgRJT7D4Xn5fxpdgKgkbMxhfajG', NULL, '2025-09-21 00:38:21', '2025-09-28 04:43:23'),
(2, 'sameer', 'sameer@email.com', 'user', NULL, '$2y$12$S4uoLtqaCduU4dUZfKKrJuE49Q/Ncl8UT6WwJ8aGZhMOirKYcm61y', NULL, '2025-09-21 12:07:58', '2025-09-21 12:07:58'),
(3, 'Shariqq Bhai', 'shariqq.com@gmail.com', 'user', '2025-09-21 10:44:01', '$2y$12$ZhNvi1BneOwn20qoRdxwT.mj31apYDmjGg7QT7MXuOlsgczyHwKGK', NULL, '2025-09-28 04:48:41', '2025-09-28 04:48:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_added_by_foreign` (`added_by`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_messages_order_id_foreign` (`order_id`),
  ADD KEY `chat_messages_user_id_foreign` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_product_id_foreign` (`product_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`),
  ADD KEY `comments_reply_id_foreign` (`reply_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `freelancers`
--
ALTER TABLE `freelancers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `freelancers_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_product_id_foreign` (`product_id`),
  ADD KEY `orders_payment_type_id_foreign` (`payment_type_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`),
  ADD KEY `pages_added_by_foreign` (`added_by`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_types_added_by_foreign` (`added_by`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_added_by_foreign` (`added_by`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_order_id_foreign` (`order_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_verified_by_foreign` (`verified_by`),
  ADD KEY `transactions_payment_type_id_foreign` (`payment_type_id`);

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
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `freelancers`
--
ALTER TABLE `freelancers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_reply_id_foreign` FOREIGN KEY (`reply_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `freelancers`
--
ALTER TABLE `freelancers`
  ADD CONSTRAINT `freelancers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_payment_type_id_foreign` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD CONSTRAINT `payment_types_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_payment_type_id_foreign` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
