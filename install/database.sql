-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 13, 2024 at 07:06 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adsrock`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@site.com', 'admin', NULL, '66aba35dc51431722524509.png', '$2y$12$dhMGPq10Igspn2OajE24Y.MA3a2aJOa35xJdwo9HHqu5jw1vYPfSu', 'HzDJIzToXFdhAjuxM2HRoUMaeYk7CQ3PYQhr6gL5eR4eFGfIrO8X4W67tSf7', NULL, '2024-08-01 09:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `advertiser_id` int NOT NULL DEFAULT '0',
  `publisher_id` int NOT NULL DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `click_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advertisers`
--

CREATE TABLE `advertisers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dial_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1⇒ACTIVE, 2⇒BANNED, \r\n0⇒DEACTIVE,',
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: mobile unverified, 1: mobile verified',
  `ver_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `plan_id` int UNSIGNED DEFAULT '0',
  `click_credit` int NOT NULL DEFAULT '0',
  `impression_credit` int NOT NULL DEFAULT '0',
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_complete` int NOT NULL DEFAULT '0',
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advertiser_password_resets`
--

CREATE TABLE `advertiser_password_resets` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advertises`
--

CREATE TABLE `advertises` (
  `id` bigint UNSIGNED NOT NULL,
  `advertiser_id` int NOT NULL DEFAULT '0',
  `ad_type_id` int NOT NULL DEFAULT '0',
  `track_id` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ad_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ad_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ad_type` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clicked` int NOT NULL DEFAULT '0',
  `impression` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>active , 2=>pending, 0=>deactive',
  `resolution` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `global` tinyint(1) NOT NULL DEFAULT '0',
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advertise_country`
--

CREATE TABLE `advertise_country` (
  `country_id` int DEFAULT '0',
  `advertise_id` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ad_types`
--

CREATE TABLE `ad_types` (
  `id` int UNSIGNED NOT NULL,
  `ad_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Name Of Advertise',
  `type` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Ex: ''Image, script, Gip, video etc''',
  `width` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'with in px EX: 300px',
  `height` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ex:250px',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>ENABLE 0=>DISABLED',
  `slug` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Ex: 300X250',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `analytics`
--

CREATE TABLE `analytics` (
  `id` bigint UNSIGNED NOT NULL,
  `advertiser_id` int NOT NULL DEFAULT '0',
  `advertise_id` int NOT NULL DEFAULT '0',
  `ad_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `click_count` int NOT NULL DEFAULT '0',
  `impression_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE `costs` (
  `id` bigint UNSIGNED NOT NULL,
  `country_id` int DEFAULT '0',
  `cpc` decimal(28,8) NOT NULL DEFAULT '0.00000000' COMMENT 'Cost per click',
  `cpm` decimal(28,8) NOT NULL DEFAULT '0.00000000' COMMENT 'Cost per impression',
  `epc` decimal(28,8) NOT NULL DEFAULT '0.00000000' COMMENT 'Earn Per CLick',
  `epm` decimal(28,8) NOT NULL DEFAULT '0.00000000' COMMENT 'Earn Per Impression',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `advertiser_id` int UNSIGNED NOT NULL DEFAULT '0',
  `plan_id` int NOT NULL DEFAULT '0',
  `method_code` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `method_currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `final_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `btc_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_try` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel',
  `from_api` tinyint(1) NOT NULL DEFAULT '0',
  `admin_feedback` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `success_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `failed_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_cron` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device_tokens`
--

CREATE TABLE `device_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `publisher_id` int UNSIGNED NOT NULL DEFAULT '0',
  `advertiser_id` int NOT NULL DEFAULT '0',
  `is_app` tinyint(1) NOT NULL DEFAULT '0',
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` bigint NOT NULL,
  `tracker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher_id` int NOT NULL DEFAULT '0',
  `domain_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>UNVERIFIED, 1=> VERIFIED, 2=>PENDING',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `earning_logs`
--

CREATE TABLE `earning_logs` (
  `id` bigint NOT NULL,
  `publisher_id` int NOT NULL DEFAULT '0',
  `advertise_id` int NOT NULL DEFAULT '0',
  `ad_type` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'object',
  `support` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_big.png', '<script>\r\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n                        (function(){\r\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\n                        s1.async=true;\r\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\r\n                        s1.charset=\"UTF-8\";\r\n                        s1.setAttribute(\"crossorigin\",\"*\");\r\n                        s0.parentNode.insertBefore(s1,s0);\r\n                        })();\r\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'twak.png', 0, '2019-10-18 17:16:05', '2022-03-21 23:22:24'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha3.png', '\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\n<div class=\"g-recaptcha\" data-sitekey=\"{{site_key}}\" data-callback=\"verifyCaptcha\"></div>\n<div id=\"g-recaptcha-error\"></div>', '{\"site_key\":{\"title\":\"Site Key\",\"value\":\"-----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"value\":\"-----------------\"}}', 'recaptcha.png', 0, '2019-10-18 17:16:05', '2024-08-13 00:42:42'),
(3, 'custom-captcha', 'Custom Captcha', 'Just put any random string', 'customcaptcha.png', NULL, '{\"random_key\":{\"title\":\"Random String\",\"value\":\"SecureString\"}}', 'na', 0, '2019-10-18 17:16:05', '2024-06-24 03:04:02'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google_analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{measurement_id}}\"></script>\n                <script>\n                  window.dataLayer = window.dataLayer || [];\n                  function gtag(){dataLayer.push(arguments);}\n                  gtag(\"js\", new Date());\n                \n                  gtag(\"config\", \"{{measurement_id}}\");\n                </script>', '{\"measurement_id\":{\"title\":\"Measurement ID\",\"value\":\"------\"}}', 'ganalytics.png', 0, NULL, '2021-05-04 04:19:12'),
(5, 'fb-comment', 'Facebook Comment ', 'Key location is shown bellow', 'Facebook.png', '<div id=\"fb-root\"></div><script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId={{app_key}}&autoLogAppEvents=1\"></script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"----\"}}', 'fb_com.PNG', 0, NULL, '2022-03-21 23:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `act`, `form_data`, `created_at`, `updated_at`) VALUES
(2, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"nid_number_22\":{\"name\":\"NID Number 22\",\"label\":\"nid_number_22\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"textarea\"},\"sadfg\":{\"name\":\"sadfg\",\"label\":\"sadfg\",\"is_required\":\"optional\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"asdf\":{\"name\":\"asdf\",\"label\":\"asdf\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Test\",\"Test2\",\"Test3\"],\"type\":\"select\"},\"nid_number_226985\":{\"name\":\"NID Number 226985\",\"label\":\"nid_number_226985\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Test\",\"Test 2\",\"Test 3\"],\"type\":\"checkbox\"},\"nid_number_3333\":{\"name\":\"NID Number 3333\",\"label\":\"nid_number_3333\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Test\",\"asdf\"],\"type\":\"radio\"},\"nid_number_3333587\":{\"name\":\"NID Number 3333587\",\"label\":\"nid_number_3333587\",\"is_required\":\"optional\",\"extensions\":\"jpg,bmp,png,pdf\",\"options\":[],\"type\":\"file\"}}', '2022-03-16 01:09:49', '2022-03-17 00:02:54'),
(3, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"nid_number_226985\":{\"name\":\"NID Number 226985\",\"label\":\"nid_number_226985\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', '2022-03-16 04:32:29', '2022-03-16 04:35:32'),
(5, 'withdraw_method', '{\"nid_number_33\":{\"name\":\"NID Number 33\",\"label\":\"nid_number_33\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', '2022-03-17 00:45:35', '2022-03-17 00:53:17'),
(6, 'withdraw_method', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', '2022-03-17 00:47:04', '2022-03-17 00:47:04'),
(7, 'kyc', '{\"full_name\":{\"name\":\"Full Name\",\"label\":\"full_name\",\"is_required\":\"required\",\"instruction\":null,\"extensions\":\"\",\"options\":[],\"type\":\"text\",\"width\":\"12\"},\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"instruction\":null,\"extensions\":null,\"options\":[],\"type\":\"text\",\"width\":\"12\"},\"gender\":{\"name\":\"Gender\",\"label\":\"gender\",\"is_required\":\"required\",\"instruction\":null,\"extensions\":null,\"options\":[\"Male\",\"Female\",\"Others\"],\"type\":\"select\",\"width\":\"12\"},\"you_hobby\":{\"name\":\"You Hobby\",\"label\":\"you_hobby\",\"is_required\":\"required\",\"instruction\":null,\"extensions\":null,\"options\":[\"Programming\",\"Gardening\",\"Traveling\",\"Others\"],\"type\":\"checkbox\",\"width\":\"12\"},\"nid_photo\":{\"name\":\"NID Photo\",\"label\":\"nid_photo\",\"is_required\":\"required\",\"instruction\":null,\"extensions\":\"jpg,png\",\"options\":[],\"type\":\"file\",\"width\":\"12\"}}', '2022-03-17 02:56:14', '2024-07-10 00:56:35'),
(8, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', '2022-03-21 07:53:25', '2022-03-21 07:53:25'),
(9, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', '2022-03-21 07:54:15', '2022-03-21 07:54:15'),
(10, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', '2022-03-21 07:55:15', '2022-03-21 07:55:22'),
(11, 'withdraw_method', '{\"nid_number_2658\":{\"name\":\"NID Number 2658\",\"label\":\"nid_number_2658\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[\"asdf\"],\"type\":\"checkbox\"}}', '2022-03-22 00:14:09', '2022-03-22 00:14:18'),
(12, 'withdraw_method', '[]', '2022-03-30 09:03:12', '2022-03-30 09:03:12'),
(13, 'withdraw_method', '{\"bank_name\":{\"name\":\"Bank Name\",\"label\":\"bank_name\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"account_name\":{\"name\":\"Account Name\",\"label\":\"account_name\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"account_number\":{\"name\":\"Account Number\",\"label\":\"account_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', '2022-03-30 09:09:11', '2022-04-03 06:38:57'),
(14, 'withdraw_method', '{\"mobile_number\":{\"name\":\"Mobile Number\",\"label\":\"mobile_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', '2022-03-30 09:10:12', '2022-03-30 09:10:12'),
(15, 'manual_deposit', '{\"send_from_number\":{\"name\":\"Send From Number\",\"label\":\"send_from_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"transaction_number\":{\"name\":\"Transaction Number\",\"label\":\"transaction_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"screenshot\":{\"name\":\"Screenshot\",\"label\":\"screenshot\",\"is_required\":\"required\",\"extensions\":\"jpg,jpeg,png\",\"options\":[],\"type\":\"file\"}}', '2022-03-30 09:15:27', '2022-03-30 09:15:27'),
(16, 'manual_deposit', '{\"transaction_number\":{\"name\":\"Transaction Number\",\"label\":\"transaction_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"screenshot\":{\"name\":\"Screenshot\",\"label\":\"screenshot\",\"is_required\":\"required\",\"extensions\":\"jpg,pdf,docx\",\"options\":[],\"type\":\"file\"}}', '2022-03-30 09:16:43', '2022-04-11 03:19:54'),
(17, 'manual_deposit', '[]', '2022-03-30 09:21:19', '2022-03-30 09:21:19'),
(18, 'manual_deposit', '[]', '2022-07-26 05:53:36', '2022-07-26 05:53:36'),
(19, 'manual_deposit', '{\"bank_name\":{\"name\":\"Bank Name\",\"label\":\"bank_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"a\\/c_number\":{\"name\":\"A\\/C Number\",\"label\":\"a\\/c_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', '2023-07-07 11:25:51', '2023-07-07 11:25:51'),
(20, 'manual_deposit', '{\"bank_name\":{\"name\":\"Bank Name\",\"label\":\"bank_name\",\"is_required\":\"required\",\"instruction\":null,\"extensions\":null,\"options\":[],\"type\":\"text\",\"width\":\"12\"},\"a\\/c_no:\":{\"name\":\"A\\/C No:\",\"label\":\"a\\/c_no:\",\"is_required\":\"required\",\"instruction\":null,\"extensions\":null,\"options\":[],\"type\":\"text\",\"width\":\"12\"}}', '2023-07-12 07:47:11', '2024-07-10 02:27:48'),
(21, 'withdraw_method', '{\"acount_name\":{\"name\":\"Acount Name\",\"label\":\"acount_name\",\"is_required\":\"required\",\"instruction\":null,\"extensions\":null,\"options\":[],\"type\":\"text\",\"width\":\"12\"},\"account_number\":{\"name\":\"Account Number\",\"label\":\"account_number\",\"is_required\":\"required\",\"instruction\":null,\"extensions\":null,\"options\":[],\"type\":\"text\",\"width\":\"12\"}}', '2024-06-11 02:51:21', '2024-08-12 02:26:43'),
(22, 'withdraw_method', '[]', '2024-06-11 02:52:33', '2024-06-11 02:52:33'),
(23, 'manual_deposit', '{\"account_name\":{\"name\":\"Account Name\",\"label\":\"account_name\",\"is_required\":\"required\",\"instruction\":null,\"extensions\":\"\",\"options\":[],\"type\":\"text\",\"width\":\"12\"},\"account_number\":{\"name\":\"Account Number\",\"label\":\"account_number\",\"is_required\":\"required\",\"instruction\":null,\"extensions\":\"\",\"options\":[],\"type\":\"text\",\"width\":\"12\"}}', '2024-07-10 02:33:32', '2024-08-06 04:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint UNSIGNED NOT NULL,
  `data_keys` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_values` longtext COLLATE utf8mb4_unicode_ci,
  `seo_content` longtext COLLATE utf8mb4_unicode_ci,
  `tempname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `seo_content`, `tempname`, `slug`, `created_at`, `updated_at`) VALUES
(41, 'cookie.data', '{\"short_desc\":\"We may use cookies or any other tracking technologies when you visit our website, including any other media form, mobile website, or mobile application related or connected to help customize the Site and improve your experience.\",\"description\":\"<div>\\r\\n    <h4>What Are Cookies?<\\/h4>\\r\\n    <p>Cookies are small data files that are placed on your computer or mobile device when you visit a website. These\\r\\n        files contain information that is transferred to your device\\u2019s hard drive. Cookies are widely used by website\\r\\n        owners for various purposes: they help websites function properly by enabling essential features such as page\\r\\n        navigation and access to secure areas; they improve efficiency by remembering your preferences and actions over\\r\\n        time, such as login details and language settings, so you don\\u2019t have to re-enter them each time you visit; they\\r\\n        provide reporting information that helps website owners understand how their site is being used, including data\\r\\n        on page visits, duration of visits, and any errors that occur, which is crucial for improving site performance\\r\\n        and user experience; they personalize your experience by remembering your preferences and tailoring content to\\r\\n        your interests, including showing relevant advertisements or recommendations based on your browsing history; and\\r\\n        they enhance security by detecting fraudulent activity and protecting your data from unauthorized access. By\\r\\n        using cookies, website owners can enhance the overall functionality and efficiency of their sites, providing a\\r\\n        better experience for their users.<\\/p>\\r\\n    <p><br><\\/p>\\r\\n<\\/div>\\r\\n\\r\\n<div>\\r\\n    <h4>Why Do We Use Cookies?<\\/h4>\\r\\n    <p>We use cookies for several reasons. Some cookies are required for technical reasons for our website to operate,\\r\\n        and we refer to these as \\u201cessential\\u201d or \\u201cstrictly necessary\\u201d cookies. These essential cookies are crucial for\\r\\n        enabling basic functions like page navigation, secure access to certain areas, and ensuring the overall\\r\\n        functionality of the site. Without these cookies, the website cannot perform properly.<\\/p>\\r\\n    <p>Other cookies enable us to track and target the interests of our users to enhance the experience on our website.\\r\\n        These cookies help us understand your preferences and behaviors, allowing us to tailor content and features to\\r\\n        better suit your needs. For example, they can remember your login details, language preferences, and other\\r\\n        customizable settings, providing a more personalized and efficient browsing experience.<br><\\/p>\\r\\n    <p><br><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>Types of Cookies We Use<\\/h4>\\r\\n    <p>\\r\\n    <\\/p>\\r\\n    <ul style=\\\"margin-left: 30px;list-style: circle;\\\">\\r\\n        <li style=\\\"margin-bottom: 10px;\\\">\\r\\n            <strong>Essential Cookies<\\/strong>\\r\\n            <span>These cookies are necessary for the website to function and cannot be switched off in our systems.\\r\\n                They are usually only set in response to actions made by you which amount to a request for services,\\r\\n                such as setting your privacy preferences, logging in, or filling in forms.<\\/span>\\r\\n        <\\/li>\\r\\n        <li style=\\\"margin-bottom: 10px;\\\">\\r\\n            <strong>Performance and Functionality Cookies<\\/strong>\\r\\n            <span>These cookies are used to enhance the performance and functionality of our website but are\\r\\n                non-essential to its use. However, without these cookies, certain functionality may become\\r\\n                unavailable.<\\/span>\\r\\n        <\\/li>\\r\\n        <li style=\\\"margin-bottom: 10px;\\\">\\r\\n            <strong>Analytics and Customization Cookies <\\/strong>\\r\\n            <span>These cookies collect information that is used either in aggregate form to help us understand how our\\r\\n                website is being used or how effective our marketing campaigns are, or to help us customize our website\\r\\n                for you.<\\/span>\\r\\n        <\\/li>\\r\\n        <li style=\\\"margin-bottom: 10px;\\\">\\r\\n            <strong>Advertising Cookies<\\/strong>\\r\\n            <span>These cookies are used to make advertising messages more relevant to you. They perform functions like\\r\\n                preventing the same ad from continuously reappearing, ensuring that ads are properly displayed for\\r\\n                advertisers, and in some cases selecting advertisements that are based on your interests.<\\/span>\\r\\n        <\\/li>\\r\\n    <\\/ul>\\r\\n    <p><\\/p>\\r\\n<\\/div>\\r\\n<br>\\r\\n\\r\\n<div>\\r\\n    <h4>Your Choices Regarding Cookies<\\/h4>\\r\\n    <p>You have the right to decide whether to accept or reject cookies. You can exercise your cookie preferences by\\r\\n        clicking on the appropriate opt-out links provided in the cookie banner. This banner typically appears when you\\r\\n        first visit our website and allows you to choose which types of cookies you are comfortable with. You can also\\r\\n        set or amend your web browser controls to accept or refuse cookies. Most web browsers provide settings that\\r\\n        allow you to manage or delete cookies, and you can usually find these settings in the \\u201coptions\\u201d or \\u201cpreferences\\u201d\\r\\n        menu of your browser.<\\/p>\\r\\n    <p><br><\\/p>\\r\\n    <p>If you choose to reject cookies, you may still use our website, though your access to some functionality and\\r\\n        areas of our website may be restricted. For example, certain features that rely on cookies to remember your\\r\\n        preferences or login details may not work properly. Additionally, rejecting cookies may impact the\\r\\n        personalization of your experience, as we use cookies to tailor content and advertisements to your interests.\\r\\n        Despite these limitations, we respect your right to control your cookie preferences and strive to provide a\\r\\n        functional and enjoyable browsing experience regardless of your choices.<\\/p>\\r\\n<\\/div>\\r\\n<br>\\r\\n\\r\\n<div>\\r\\n    <h4>Contact Us\\r\\n    <\\/h4>\\r\\n    <p>\\r\\n        If you have any questions about our use of cookies or other technologies, please contact <a href=\\\"\\/contact\\\" target=\\\"_blank\\\"><strong> with us<\\/strong><\\/a>. Our team is available to assist you with any inquiries or concerns you may have\\r\\n        regarding our cookie policy. We value your privacy and are committed to ensuring that your experience on our\\r\\n        website is transparent and satisfactory.\\r\\n    <\\/p>\\r\\n<\\/div>\\r\\n<br>\",\"status\":1}', NULL, 'basic', NULL, '2020-07-04 23:42:52', '2024-08-03 05:11:09'),
(103, 'banner.content', '{\"has_image\":\"1\",\"title\":\"Advertise, Earn One Platform, Dual Success!\",\"description\":\"Craft compelling ads, maximize publisher earnings \\u2013 A seamless, win-win platform for advertisers and publishers.\",\"banner_image_two_heading\":\"80M+\",\"banner_image_two_description\":\"We\'re connected with more than 80,000,000+ peoples all over the world.\",\"banner_video_title\":\"Drive More Traffic and Sales\",\"banner_video_heading\":\"Drive More traffic and product sales\",\"button_one_text\":\"Become a Advertiser\",\"button_one_url\":\"advertiser\\/register\",\"button_two_text\":\"Become a Publisher\",\"button_two_url\":\"publisher\\/register\",\"banner_image_one\":\"666693bae2c331717998522.png\",\"banner_image_two\":\"666693bb22d911717998523.png\"}', NULL, 'basic', '', '2024-06-09 23:48:42', '2024-08-07 05:38:49'),
(110, 'counter.content', '{\"has_image\":\"1\",\"heading\":\"Crafting Digital Success\",\"description\":\"Crafting Digital Success is about using effective digital ad strategies to boost your business. Our platform helps you reach the right audience, increase engagement, and maximize your online impact. Join us to turn your advertising efforts into measurable success\",\"counter_text_one\":\"Total Publisher\",\"counter_value_one\":\"5K\",\"counter_text_two\":\"Total Advertiser\",\"counter_value_two\":\"40k\",\"counter_text_three\":\"Total Click\",\"counter_value_three\":\"45M+\",\"counter_text_four\":\"Total Impression\",\"counter_value_four\":\"45K\",\"image\":\"6694d27bca9ab1721029243.png\"}', NULL, 'basic', '', '2024-06-09 23:56:58', '2024-08-07 08:43:15'),
(121, 'choose_us.content', '{\"has_image\":\"1\",\"heading\":\"Why Choose AdsRock\",\"subheading\":\"AdsRock place to post your advertisement and publisher, whether you are an individual, group, or organization. AdsRock builds into a global movement and international activists all over the world.\",\"image\":\"6666981e2e79d1717999646.png\"}', NULL, 'basic', '', '2024-06-10 00:07:26', '2024-08-08 01:04:24'),
(122, 'choose_us.element', '{\"has_image\":\"1\",\"title\":\"Certified\",\"description\":\"We are a certified company operating fully legal business in the legal field\",\"image\":\"66b46ff510ba91723101173.png\"}', NULL, 'basic', '', '2024-06-10 00:09:49', '2024-08-08 01:12:53'),
(123, 'choose_us.element', '{\"has_image\":\"1\",\"title\":\"Quick Withdrawal\",\"description\":\"Our site has a high maximum limit of withdrawal which is performed in a seconds\",\"image\":\"66b4703599b771723101237.png\"}', NULL, 'basic', '', '2024-06-10 00:10:13', '2024-08-08 01:13:57'),
(124, 'choose_us.element', '{\"has_image\":\"1\",\"title\":\"Reliable\",\"description\":\"We are highly reliable and trusted by thousands of people.\",\"image\":\"66b4702c50ae91723101228.png\"}', NULL, 'basic', '', '2024-06-10 00:10:26', '2024-08-08 01:13:48'),
(125, 'choose_us.element', '{\"has_image\":\"1\",\"title\":\"Secure\",\"description\":\"We constantly work on improving our system and level up our security.\",\"image\":\"66b47023243bc1723101219.png\"}', NULL, 'basic', '', '2024-06-10 00:10:43', '2024-08-08 01:13:39'),
(126, 'choose_us.element', '{\"has_image\":\"1\",\"title\":\"Profitable\",\"description\":\"Easily get profit for adding members. Easy to make money and withdraw within minutes.\",\"image\":\"66b4701b428be1723101211.png\"}', NULL, 'basic', '', '2024-06-10 00:11:00', '2024-08-08 01:13:31'),
(127, 'choose_us.element', '{\"has_image\":\"1\",\"title\":\"24\\/7 Support\",\"description\":\"We are here for you. We provide 24\\/7 customer support through e-mail.\",\"image\":\"66b47012460db1723101202.png\"}', NULL, 'basic', '', '2024-06-10 00:11:18', '2024-08-08 01:13:22'),
(128, 'ads.content', '{\"heading\":\"Smart Plan for Publisher\",\"title\":\"Maximize your revenue with AdsRock\'s Smart Plan. Our tailored solutions ensure optimal ad placements and higher earnings, all while maintaining a great user experience\"}', NULL, 'basic', '', '2024-06-10 00:20:28', '2024-08-08 04:27:56'),
(129, 'ads.element', '{\"has_image\":\"1\",\"image\":\"66669bd5b0fa61718000597.png\"}', NULL, 'basic', '', '2024-06-10 00:23:17', '2024-06-10 00:23:17'),
(130, 'ads.element', '{\"has_image\":\"1\",\"image\":\"66669bddb3e0d1718000605.png\"}', NULL, 'basic', '', '2024-06-10 00:23:25', '2024-06-10 00:23:25'),
(134, 'how_it_works_advertiser.element', '{\"has_image\":\"1\",\"title\":\"Signup\",\"description\":\"Start your journey by creating an account. Sign up to unlock a world of advertising opportunities with AdsRock\",\"image\":\"6694b6db0c7bc1721022171.png\"}', NULL, 'basic', '', '2024-06-10 00:41:12', '2024-07-14 23:42:51'),
(135, 'how_it_works_advertiser.element', '{\"has_image\":\"1\",\"title\":\"Purchase Plan\",\"description\":\"Choose a plan that suits your advertising goals. Our flexible plans cater to various budgets and campaign objectives.\",\"image\":\"6694b6e854a571721022184.png\"}', NULL, 'basic', '', '2024-06-10 00:42:59', '2024-07-14 23:43:04'),
(136, 'how_it_works_advertiser.element', '{\"has_image\":\"1\",\"title\":\"Setup Campaign\",\"description\":\"Dive into the heart of advertising success. Set up your campaign, defining target audiences, budget, and scheduling to optimize reach.\",\"image\":\"6694b6efeff5c1721022191.png\"}', NULL, 'basic', '', '2024-06-10 00:43:25', '2024-07-14 23:43:12'),
(137, 'how_it_works_advertiser.element', '{\"has_image\":\"1\",\"title\":\"Publish Ads\",\"description\":\"Showcase your brand to the world. Publish compelling ads that captivate your audience and drive engagement.\",\"image\":\"6694b6f9ebf611721022201.png\"}', NULL, 'basic', '', '2024-06-10 00:43:40', '2024-07-14 23:43:21'),
(138, 'how_it_works_advertiser.element', '{\"has_image\":\"1\",\"title\":\"Track Ads Performance\",\"description\":\"Monitor the impact of your campaigns in real-time. Track performance metrics, analyze data, and refine strategies for optimal results\",\"image\":\"6694b701baf1a1721022209.png\"}', NULL, 'basic', '', '2024-06-10 00:43:59', '2024-07-14 23:43:29'),
(139, 'how_it_works_publisher.element', '{\"has_image\":\"1\",\"title\":\"Signup\",\"description\":\"Start your journey by creating an account. Sign up to unlock a world of advertising opportunities with AdsRock\",\"image\":\"6694b70d5af801721022221.png\"}', NULL, 'basic', '', '2024-06-10 00:41:12', '2024-07-14 23:43:41'),
(140, 'how_it_works_publisher.element', '{\"has_image\":\"1\",\"title\":\"Purchase Plan\",\"description\":\"Choose a plan that suits your advertising goals. Our flexible plans cater to various budgets and campaign objectives.\",\"image\":\"6694b71545dab1721022229.png\"}', NULL, 'basic', '', '2024-06-10 00:42:59', '2024-07-14 23:43:49'),
(141, 'how_it_works_publisher.element', '{\"has_image\":\"1\",\"title\":\"Setup Campaign\",\"description\":\"Dive into the heart of advertising success. Set up your campaign, defining target audiences, budget, and scheduling to optimize reach.\",\"image\":\"6694b71b594b11721022235.png\"}', NULL, 'basic', '', '2024-06-10 00:43:25', '2024-07-14 23:43:55'),
(142, 'how_it_works_publisher.element', '{\"has_image\":\"1\",\"title\":\"Publish Ads\",\"description\":\"Showcase your brand to the world. Publish compelling ads that captivate your audience and drive engagement.\",\"image\":\"6694b723176571721022243.png\"}', NULL, 'basic', '', '2024-06-10 00:43:40', '2024-07-14 23:44:03'),
(143, 'how_it_works_publisher.element', '{\"has_image\":\"1\",\"title\":\"Track Ads Performance\",\"description\":\"Monitor the impact of your campaigns in real-time. Track performance metrics, analyze data, and refine strategies for optimal results\",\"image\":\"6694b72cda58e1721022252.png\"}', NULL, 'basic', '', '2024-06-10 00:43:59', '2024-07-14 23:44:12'),
(144, 'testimonial.content', '{\"title\":\"They Said It, We Believe It\",\"description\":\"Authentic voices, genuine results. Dive deeper than data, feel the passion. Unleash your own potential, we believe in you.\"}', NULL, 'basic', '', '2024-06-10 00:52:48', '2024-06-10 00:52:48'),
(145, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Michael Smith\",\"description\":\"The quality and attention to detail in this product are exceptional. From the moment I received it, I knew I made the right choice. It has exceeded all my expectations and provided great value for the money.\",\"image\":\"6666a33a87eff1718002490.png\"}', NULL, 'basic', '', '2024-06-10 00:54:50', '2024-06-10 00:54:50'),
(146, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Sarah Johnson\",\"description\":\"This product completely transformed my daily routine. It\'s incredibly user-friendly, and the results have been nothing short of amazing. I highly recommend it to anyone looking to improve their productivity.\",\"image\":\"6666a349c12591718002505.png\"}', NULL, 'basic', '', '2024-06-10 00:55:05', '2024-06-10 00:55:05'),
(147, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"James Wilson\",\"description\":\"This is a game-changer! The functionality and ease of use are unparalleled. It seamlessly integrates into my workflow, making my tasks much more manageable. I\'m thoroughly impressed.\",\"image\":\"6666a35c83b5b1718002524.png\"}', NULL, 'basic', '', '2024-06-10 00:55:24', '2024-06-10 00:55:24'),
(148, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Jessica Brown\",\"description\":\"Having tried many similar products, I can confidently say this one stands out. The results are outstanding, and it\'s super easy to use. It has become an indispensable part of my daily routine.\",\"image\":\"6666a36b4b6d21718002539.png\"}', NULL, 'basic', '', '2024-06-10 00:55:39', '2024-06-10 00:55:39'),
(149, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Daniel Martinez\",\"description\":\"Great value for money! The performance of this product is top-notch, and it has surpassed all my expectations. I couldn\'t be happier with my purchase and would recommend it to anyone.\",\"image\":\"6666a3a2e47f11718002594.png\"}', NULL, 'basic', '', '2024-06-10 00:56:34', '2024-06-10 00:56:34'),
(150, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Ashley Taylor\",\"description\":\"The quality of this product is fantastic. The attention to detail is evident, and it performs beautifully. I\'ve had a wonderful experience with it and will definitely continue using it.\",\"image\":\"6666a3ae7e0551718002606.png\"}', NULL, 'basic', '', '2024-06-10 00:56:46', '2024-06-10 00:56:46'),
(151, 'blog.content', '{\"heading\":\"Our Latest Blog\",\"subheading\":\"Stay updated with the newest trends in digital marketing and advertising. Explore expert insights, tips, and strategies to boost your campaigns\"}', NULL, 'basic', '', '2024-06-10 00:58:56', '2024-08-08 01:21:56'),
(152, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"How Small Businesses are Thriving with Our Ad Solutions\",\"description\":\"<div>Small businesses often face unique challenges in the competitive world of digital advertising, from limited budgets to the need for high-impact strategies. Our ad solutions are designed to help small businesses overcome these challenges and thrive in the digital landscape. In this blog post, we\\u2019ll explore how small businesses are leveraging our ad solutions to drive growth, increase visibility, and achieve their marketing objectives effectively. <br \\/><\\/div><div><br \\/><\\/div><div>\\r\\nFor small businesses, finding effective and affordable advertising solutions is crucial for standing out and competing with larger players. Our tailored ad solutions provide the tools and strategies necessary to maximize impact and drive results. Here\\u2019s how small businesses are benefiting from our ad solutions and achieving success: <br \\/><\\/div><div><br \\/><\\/div>\\r\\n<h4>Cost-Effective Advertising Strategies<\\/h4>\\r\\n<div>\\r\\n  Our ad solutions offer cost-effective options that allow small businesses to maximize their advertising budget. By focusing on high-impact strategies and efficient ad spend, small businesses can achieve significant results without breaking the bank, ensuring a strong return on investment.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Customized Campaigns<\\/h4>\\r\\n<div>\\r\\n  We work closely with small businesses to create customized advertising campaigns tailored to their specific needs and goals. By understanding their target audience and unique value propositions, we design campaigns that effectively capture attention and drive engagement.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Advanced Targeting Capabilities<\\/h4>\\r\\n<div>\\r\\n  Our ad solutions include advanced targeting features that enable small businesses to reach their ideal audience with precision. By utilizing demographic, geographic, and behavioral data, small businesses can ensure their ads are seen by those most likely to be interested in their products or services.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Comprehensive Analytics and Reporting<\\/h4>\\r\\n<div>\\r\\n  We provide detailed analytics and reporting tools that help small businesses track the performance of their ad campaigns. By analyzing key metrics and user interactions, businesses can gain valuable insights, make data-driven decisions, and continuously optimize their advertising efforts.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Support and Expertise<\\/h4>\\r\\n<div>\\r\\n  Our team of experts offers ongoing support and guidance to help small businesses navigate the complexities of digital advertising. From campaign setup to performance optimization, we provide the expertise and resources needed to ensure success and drive meaningful results.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<div>\\r\\n  By leveraging our ad solutions, small businesses can overcome advertising challenges, enhance their visibility, and achieve their marketing goals with confidence. Our tailored strategies and support empower small businesses to thrive in the competitive digital landscape and achieve sustainable growth.\\r\\n<\\/div>\\r\\n<br \\/>\",\"image\":\"66b383c838dcf1723040712.png\"}', NULL, 'basic', 'how-small-businesses-are-thriving-with-our-ad-solutions', '2024-06-10 01:00:14', '2024-08-07 08:25:12'),
(153, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"The Power of Targeted Advertising, Reaching Your Audience Effectively\",\"description\":\"<div>In the competitive world of digital marketing, reaching the right audience with your advertising efforts is essential for maximizing impact and achieving campaign goals. Targeted advertising allows businesses to hone in on specific audience segments, ensuring that their ads are seen by those most likely to engage. In this blog post, we\\u2019ll explore the power of targeted advertising and how it can help you reach your audience effectively, drive better results, and enhance your overall marketing strategy. <br \\/><\\/div><div><br \\/><\\/div><div>\\r\\nEffective advertising goes beyond broad reach; it\\u2019s about precision and relevance. Targeted advertising leverages data and technology to connect with the most pertinent audience segments, improving engagement and conversion rates. Here\\u2019s how targeted advertising can transform your marketing efforts and ensure you\\u2019re reaching your audience effectively: <br \\/><\\/div><div><br \\/><\\/div>\\r\\n<h4>Advanced Audience Segmentation<\\/h4>\\r\\n<div>\\r\\n  Targeted advertising uses advanced audience segmentation techniques to categorize users based on demographics, interests, behaviors, and more. By understanding these segments, you can tailor your ads to meet their specific needs and preferences, increasing the likelihood of meaningful interactions and conversions.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Personalized Ad Content<\\/h4>\\r\\n<div>\\r\\n  Personalization is key to effective targeted advertising. Crafting ad content that speaks directly to the interests and pain points of your audience can significantly enhance engagement. Personalized ads resonate more with users, leading to higher click-through rates and better campaign performance.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Enhanced Ad Placement<\\/h4>\\r\\n<div>\\r\\n  Targeted advertising allows you to place your ads on platforms and channels where your audience is most active. By choosing the right placements, you ensure that your ads reach users in environments where they are more likely to engage, leading to more efficient use of your advertising budget.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Real-Time Data and Optimization<\\/h4>\\r\\n<div>\\r\\n  Utilizing real-time data, targeted advertising enables continuous optimization of your campaigns. By monitoring performance metrics and user interactions, you can make data-driven adjustments to improve ad relevance, refine targeting parameters, and enhance overall effectiveness.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Cost Efficiency<\\/h4>\\r\\n<div>\\r\\n  Targeted advertising helps maximize cost efficiency by focusing your budget on high-potential audience segments. By reducing wasted impressions and clicks, you can achieve better results with a lower cost per acquisition, improving the return on investment for your advertising efforts.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<div>\\r\\n  Embracing the power of targeted advertising allows businesses to connect with their audience more effectively, drive better results, and optimize their marketing strategy. By leveraging data and personalization, you can enhance engagement, improve conversion rates, and achieve your advertising goals with greater precision and efficiency.\\r\\n<\\/div>\\r\\n<br \\/>\",\"image\":\"66b3831adc1091723040538.png\"}', NULL, 'basic', 'the-power-of-targeted-advertising-reaching-your-audience-effectively', '2024-06-10 01:01:36', '2024-08-07 08:22:19'),
(154, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Understanding Ad Analytics, Key Metrics for Success\",\"description\":\"<div>In the realm of digital advertising, understanding and analyzing ad performance is crucial for optimizing campaigns and achieving marketing goals. Ad analytics provides valuable insights into how your ads are performing, enabling you to make data-driven decisions and maximize your return on investment. In this blog post, we\\u2019ll break down the key metrics for ad success and explain how to leverage them to improve your advertising strategies. <br \\/><\\/div><div><br \\/><\\/div><div>\\r\\nTo effectively measure and enhance the performance of your ad campaigns, it\\u2019s essential to grasp the significance of various key metrics. By analyzing these metrics, businesses can fine-tune their strategies, optimize ad spend, and drive better results. Here\\u2019s a guide to understanding ad analytics and the critical metrics you need to track for success: <br \\/><\\/div><div><br \\/><\\/div>\\r\\n<h4>Click-Through Rate (CTR)<\\/h4>\\r\\n<div>\\r\\n  The click-through rate (CTR) measures the percentage of users who click on your ad after seeing it. A higher CTR indicates that your ad is compelling and relevant to your audience. Tracking CTR helps assess the effectiveness of your ad copy and visuals in capturing user interest.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Conversion Rate<\\/h4>\\r\\n<div>\\r\\n  Conversion rate measures the percentage of users who take a desired action (such as making a purchase or filling out a form) after clicking on your ad. This metric is crucial for evaluating the effectiveness of your ad in driving meaningful actions and achieving your campaign goals.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Cost Per Click (CPC)<\\/h4>\\r\\n<div>\\r\\n  Cost per click (CPC) refers to the amount you pay each time a user clicks on your ad. Monitoring CPC helps you understand how efficiently you\\u2019re spending your advertising budget and identify opportunities to optimize your bidding strategy for better cost management.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Return on Ad Spend (ROAS)<\\/h4>\\r\\n<div>\\r\\n  Return on ad spend (ROAS) measures the revenue generated for every dollar spent on advertising. This metric provides a clear picture of the profitability of your ad campaigns and helps determine whether your advertising efforts are yielding a positive return on investment.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Impressions and Reach<\\/h4>\\r\\n<div>\\r\\n  Impressions refer to the number of times your ad is displayed, while reach measures the total number of unique users who see your ad. Tracking these metrics helps gauge the visibility of your ads and understand how effectively you\\u2019re reaching your target audience.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<div>\\r\\n  By understanding and analyzing these key ad metrics, businesses can gain valuable insights into their advertising performance, optimize their campaigns, and achieve greater success. Leveraging ad analytics enables you to make informed decisions, improve ROI, and drive impactful results in your marketing efforts.\\r\\n<\\/div>\\r\\n<br \\/>\",\"image\":\"66b3821db74141723040285.png\"}', NULL, 'basic', 'understanding-ad-analytics-key-metrics-for-success', '2024-06-10 01:02:09', '2024-08-07 08:18:06'),
(155, 'faq.content', '{\"heading\":\"Common Queries\",\"subheading\":\"Find answers to common queries about AdsRock. Learn how to optimize your campaigns, troubleshoot issues. Get the information you need quickly and easily\"}', NULL, 'basic', '', '2024-06-10 01:04:20', '2024-08-08 01:28:32'),
(156, 'faq.element', '{\"question\":\"How does AdsRock\'s ad network work?\",\"answer\":\"AdsRock connects advertisers with top publishers using advanced targeting to ensure ads reach the most relevant audience. This maximizes engagement and drives better results for your campaigns.\"}', NULL, 'basic', '', '2024-06-10 01:04:34', '2024-08-08 02:23:14'),
(157, 'faq.element', '{\"question\":\"What plans does AdsRock offer for advertisers?\",\"answer\":\"AdsRock partners with reputable publishers and uses strict quality control measures to ensure that your ads are placed in high-quality environments, maximizing their effectiveness\"}', NULL, 'basic', '', '2024-06-10 01:04:43', '2024-08-08 02:29:51'),
(158, 'faq.element', '{\"question\":\"What payment options are available?\",\"answer\":\"AdsRock accepts various payment methods, including credit cards, PayPal, and other secure online payment options, making funding your campaigns convenient.\"}', NULL, 'basic', '', '2024-06-10 01:04:53', '2024-08-08 02:29:37'),
(159, 'faq.element', '{\"question\":\"How do I track the performance of my ads?\",\"answer\":\"AdsRock provides real-time analytics and detailed reports, allowing you to monitor the performance of your ads, track key metrics, and optimize your campaigns for better results.\"}', NULL, 'basic', '', '2024-06-10 01:05:00', '2024-08-08 02:29:01'),
(160, 'faq.element', '{\"question\":\"Is there support available if I encounter issues?\",\"answer\":\"Yes, AdsRock offers comprehensive support through our help center, FAQs, and customer service team to assist you with any questions or issues you may encounter.\"}', NULL, 'basic', '', '2024-06-10 01:05:07', '2024-08-08 02:26:41'),
(161, 'cta.content', '{\"has_image\":\"1\",\"heading\":\"Ready to Join the Largest Ad Network?\",\"subheading\":\"Tap into AdsRock\\u2019s extensive network to amplify your brand\\u2019s reach. Connect with top publishers, engage your target audience, and watch your business grow. Start your journey with us today!\",\"button_one_text\":\"Become a Publisher\",\"button_one_url\":\"publisher\\/register\",\"button_two_text\":\"Become a Advertisers\",\"button_two_url\":\"advertiser\\/register\",\"image\":\"66b49479ef5211723110521.png\"}', NULL, 'basic', '', '2024-06-10 01:07:35', '2024-08-08 03:48:43'),
(162, 'contact_us.content', '{\"has_image\":\"1\",\"heading\":\"Get in Touch\",\"subheading\":\"Reach out to us for swift assistance and friendly support\",\"map_url\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d5261.168278552001!2d-0.06853355147215559!3d51.51430246048815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4876034add2a4013%3A0x260eae2ed0510822!2sWhitechapel%2C%20London%2C%20UK!5e0!3m2!1sen!2sbd!4v1723031727324!5m2!1sen!2sbd\",\"image\":\"66b364ed9d7ea1723032813.png\"}', NULL, 'basic', '', '2024-06-10 03:06:52', '2024-08-07 06:13:33'),
(163, 'Login.content', '{\"title\":\"Please login with valid credentials\"}', NULL, 'basic', '', '2024-06-10 03:15:01', '2024-06-10 03:15:01'),
(164, 'Registration.content', '{\"title\":\"Please Register with valid credentials\"}', NULL, 'basic', '', '2024-06-10 03:15:11', '2024-06-10 03:15:11'),
(165, 'auth.content', '{\"heading\":\"Welcome to Largest Ads Network\",\"short_description\":\"Discover unparalleled reach with our ads network. Connect with diverse audiences & elevate your brand\'s visibility. Our network offers exceptional opportunities for impactful advertising. Get benefits from the largest and most effective advertising solution.\",\"has_image\":\"1\",\"image\":\"6666c4316b6cf1718010929.png\"}', NULL, 'basic', '', '2024-06-10 03:15:29', '2024-08-07 05:09:45'),
(166, 'banned.content', '{\"has_image\":\"1\",\"heading\":\"YOU ARE BANNED\",\"image\":\"666c27c89cbbb1718364104.png\"}', NULL, 'basic', '', '2024-06-14 05:21:44', '2024-08-08 04:36:53'),
(167, 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details\":\"<div>\\r\\n    <h4>Privacy Policy<\\/h4>\\r\\n    <p>This Privacy Policy outlines how we collect, use, disclose, and protect your personal information when you visit\\r\\n        our website. By accessing or using our website, you agree to the terms of this Privacy Policy\\r\\n        and consent to the collection and use of your information as described herein.\\r\\n        We are committed to ensuring that your privacy is protected. Should we ask you to provide certain information by\\r\\n        which you can be identified when using this website, you can be assured that it will only be used in accordance\\r\\n        with this Privacy Policy. We regularly review our compliance with this policy and ensure that all data handling\\r\\n        practices are transparent and secure.\\r\\n    <\\/p>\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<div>\\r\\n    <h4> Information We Collect<\\/h4>\\r\\n    <p>We collect personal information such as names, email addresses, and browsing data to enhance user experience and provide personalized services. This data helps us understand user preferences and improve our offerings. Your privacy is important to us, and we ensure that all information is handled with strict confidentiality.<\\/p><p><br \\/><\\/p>\\r\\n    <ul style=\\\"margin-left:30px;list-style:circle;\\\">\\r\\n        <li style=\\\"margin-bottom:10px;\\\">\\r\\n            <span>Personal Information:<\\/span>\\r\\n            <span>Name, email address, phone number, and other contact details.<\\/span>\\r\\n        <\\/li>\\r\\n        <li style=\\\"margin-bottom:10px;\\\">\\r\\n            <span>Usage Data:<\\/span>\\r\\n            <span>Information about how you use our website, including your IP address, browser type, and pages\\r\\n                visited.<\\/span>\\r\\n        <\\/li>\\r\\n        <li style=\\\"margin-bottom:10px;\\\">\\r\\n            <span>Cookies and Tracking technology:<\\/span>\\r\\n            <span> We use cookies to enhance your experience on our website. You can manage your cookie preferences\\r\\n                through your browser settings.<\\/span>\\r\\n        <\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<div>\\r\\n    <h4>How We Use Your Information<\\/h4>\\r\\n    <p>We use your information to provide and improve our services, ensuring a personalized experience tailored to your needs. This includes processing transactions, communicating updates, and responding to inquiries. Additionally, we use your data for analytical purposes to enhance our offerings and for security measures to protect against fraud.<\\/p><p><br \\/><\\/p>\\r\\n    <ul style=\\\"margin-left:30px;list-style:circle;\\\">\\r\\n        <li style=\\\"margin-bottom:10px;\\\">\\r\\n            <span>To provide and maintain our services.<\\/span>\\r\\n        <\\/li>\\r\\n        <li style=\\\"margin-bottom:10px;\\\">\\r\\n            <span>To improve and personalize your experience on our website.\\r\\n            <\\/span>\\r\\n        <\\/li>\\r\\n        <li style=\\\"margin-bottom:10px;\\\">\\r\\n            <span>To communicate with you, including sending updates and promotional materials.\\r\\n            <\\/span>\\r\\n        <\\/li>\\r\\n        <li style=\\\"margin-bottom:10px;\\\">\\r\\n            <span>\\r\\n                To analyze website usage and improve our services.\\r\\n            <\\/span>\\r\\n        <\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n\\r\\n<div>\\r\\n    <h4>Sharing Your Information<\\/h4>\\r\\n    <p>\\r\\n        We do not sell, trade, or otherwise transfer your personal information to outside parties except as described in\\r\\n        this Privacy Policy. We take reasonable steps to ensure that any third parties with whom we share your personal\\r\\n        information are bound by appropriate confidentiality and security obligations regarding your personal\\r\\n        information.\\r\\n\\r\\n        We understand the importance of maintaining the privacy and security of your personal information. Therefore, we\\r\\n        implement stringent measures to protect your data from unauthorized access, use, or disclosure. Our commitment\\r\\n        to safeguarding your privacy includes:\\r\\n\\r\\n    <\\/p><p><br \\/><\\/p><ul style=\\\"margin-left:30px;list-style:circle;\\\">\\r\\n        <li style=\\\"margin-bottom:10px;\\\">\\r\\n            <strong>Data Encryption<\\/strong>\\r\\n            <span>We use advanced encryption technologies to protect your personal information during transmission and\\r\\n                storage. This ensures that your data is secure and inaccessible to unauthorized parties.<\\/span>\\r\\n        <\\/li>\\r\\n        <li style=\\\"margin-bottom:10px;\\\">\\r\\n            <strong>Access Controls<\\/strong>\\r\\n            <span>We restrict access to your personal information to only those employees, contractors, and agents who\\r\\n                need to know that information to process it on our behalf. These individuals are subject to strict\\r\\n                confidentiality obligations and may be disciplined or terminated if they fail to meet these\\r\\n                obligations.<\\/span>\\r\\n        <\\/li>\\r\\n        <li style=\\\"margin-bottom:10px;\\\">\\r\\n            <strong>Regular Audits<\\/strong>\\r\\n            <span>We conduct regular audits of our data handling practices and security measures to ensure compliance\\r\\n                with this Privacy Policy and applicable laws. This helps us identify and address any potential\\r\\n                vulnerabilities in our systems.<\\/span>\\r\\n        <\\/li>\\r\\n        <li style=\\\"margin-bottom:10px;\\\">\\r\\n            <strong>Incident Response<\\/strong>\\r\\n            <span>n the unlikely event of a data breach, we have established procedures to respond promptly and\\r\\n                effectively. We will notify you and any relevant authorities as required by law and take all necessary\\r\\n                steps to mitigate the impact of the breach.<\\/span>\\r\\n        <\\/li>\\r\\n    <\\/ul>\\r\\n    <p><\\/p>\\r\\n\\r\\n<\\/div>\\r\\n\\r\\n<br \\/>\\r\\n\\r\\n<div>\\r\\n    <h4>Contact Us\\r\\n    <\\/h4>\\r\\n    <p>\\r\\n        If you have any questions about our privacy & policy, please contact\\u00a0<a href=\\\"\\/contact\\\"><strong>with us<\\/strong><\\/a>. Our team is available to assist you with any inquiries or\\r\\n        concerns you may have\\r\\n        regarding our privacy & policy. We value your privacy and are committed to ensuring that your experience on our\\r\\n        website is transparent and satisfactory.\\r\\n    <\\/p>\\r\\n<\\/div>\\r\\n<br \\/>\"}', NULL, 'basic', 'privacy-policy', '2024-06-23 00:47:45', '2024-08-03 06:01:29'),
(168, 'policy_pages.element', '{\"title\":\"Terms of Service\",\"details\":\"<div>\\r\\n    <h4>Terms & of Service<\\/h4>\\r\\n    <p>Before getting to this site, you are consenting to be limited by these site Terms and Conditions of Use, every\\r\\n        single appropriate law, and guidelines, and concur that you are answerable for consistency with any material\\r\\n        neighborhood laws. If you disagree with any of these terms, you are restricted from utilizing or getting to this\\r\\n        site.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>Support<\\/h4>\\r\\n    <p>Whenever you have downloaded our item, you may get in touch with us for help through email and we will give a\\r\\n        valiant effort to determine your issue. We will attempt to answer using the Email for more modest bug fixes,\\r\\n        after which we will refresh the center bundle. Content help is offered to confirmed clients by Tickets as it\\r\\n        were. Backing demands made by email and Livechat.<\\/p>\\r\\n    <p>On the off chance that your help requires extra adjustment of the System, at that point, you have two\\r\\n        alternatives:<\\/p>\\r\\n    <ul><li>Hang tight for additional update discharge.\\r\\n        <\\/li><li>Or on the other hand, enlist a specialist (We offer customization for extra charges).<\\/li><li><br \\/><\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>Ownership<\\/h4>\\r\\n    <p>You may not guarantee scholarly or selective possession of any of our items, altered or unmodified. All items are\\r\\n        property, we created them. Our items are given \\\"with no guarantees\\\" without guarantee of any sort, either\\r\\n        communicated or suggested. On no occasion will our juridical individual be subject to any harms including,\\r\\n        however not restricted to, immediate, roundabout, extraordinary, accidental, or significant harms or different\\r\\n        misfortunes emerging out of the utilization of or powerlessness to utilize our items.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>Warranty<\\/h4>\\r\\n    <p>We don\'t offer any guarantee or assurance of these Services in any way. When our Services have been modified we\\r\\n        can\'t ensure they will work with all outsider plugins, modules, or internet browsers. Program similarity ought\\r\\n        to be tried against the show formats on the demo worker. If you don\'t mind guarantee that the programs you use\\r\\n        will work with the component, as we can not ensure that our systems will work with all program mixes.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>Unauthorized\\/Illegal Usage<\\/h4>\\r\\n    <p>You may not utilize our things for any illicit or unapproved reason or may you, in the utilization of the stage,\\r\\n        disregard any laws in your locale (counting yet not restricted to copyright laws) just as the laws of your\\r\\n        nation and International law. Specifically, it is disallowed to utilize the things on our foundation for pages\\r\\n        that advance: brutality, illegal intimidation, hard sexual entertainment, bigotry, obscenity content or warez\\r\\n        programming joins.<br \\/><br \\/>You can\'t imitate, copy, duplicate, sell, exchange or adventure any of our segment,\\r\\n        utilization of the offered on our things, or admittance to the administration without the express composed\\r\\n        consent by us or item proprietor.<br \\/><br \\/>Our Members are liable for all substance posted on the discussion and\\r\\n        demo and movement that happens under your record.<br \\/><br \\/>We hold the chance of hindering your participation\\r\\n        account quickly if we will think about a particularly not allowed conduct.<br \\/><br \\/>If you make a record on our\\r\\n        site, you are liable for keeping up the security of your record, and you are completely answerable for all\\r\\n        exercises that happen under the record and some other activities taken regarding the record. You should quickly\\r\\n        inform us, of any unapproved employments of your record or some other penetrates of security.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>Payment\\/Refund Policy<\\/h4>\\r\\n    <p>No refund or cash back will be made. After a deposit has been finished, it is extremely unlikely to invert it.\\r\\n        You should utilize your equilibrium on requests our administrations, Hosting, SEO campaign. You concur that once\\r\\n        you complete a deposit, you won\'t document a debate or a chargeback against us in any way, shape, or\\r\\n        form.<br \\/><br \\/>If you document a debate or chargeback against us after a deposit, we claim all authority to end\\r\\n        every single future request, prohibit you from our site. False action, for example, utilizing unapproved or\\r\\n        taken charge cards will prompt the end of your record. There are no special cases.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>Free Balance \\/ Coupon Policy<\\/h4>\\r\\n    <p>We offer numerous approaches to get FREE Balance, Coupons and Deposit offers yet we generally reserve the\\r\\n        privilege to audit it and deduct it from your record offset with any explanation we may it is a sort of misuse.\\r\\n        If we choose to deduct a few or all of free Balance from your record balance, and your record balance becomes\\r\\n        negative, at that point the record will naturally be suspended. If your record is suspended because of a\\r\\n        negative Balance you can request to make a custom payment to settle your equilibrium to actuate your record.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n\\r\\n\\r\\n<div>\\r\\n    <h4>Contact Us\\r\\n    <\\/h4>\\r\\n    <p>\\r\\n        If you have any questions about our temrs of service, please contact\\u00a0<a href=\\\"\\/contact\\\"><strong>with us<\\/strong><\\/a>. Our team is available to assist you with any inquiries or\\r\\n        concerns you may have\\r\\n        regarding our temrs of service. We value your privacy and are committed to ensuring that your experience on our\\r\\n        website is transparent and satisfactory.\\r\\n    <\\/p>\\r\\n<\\/div>\\r\\n<br \\/>\"}', NULL, 'basic', 'terms-of-service', '2024-06-23 00:48:20', '2024-08-03 06:02:58'),
(169, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"lab la-facebook-f\\\"><\\/i>\",\"url\":\"https:\\/\\/www.facebook.com\\/\"}', NULL, 'basic', '', '2024-06-23 01:06:32', '2024-06-23 01:06:32'),
(170, 'social_icon.element', '{\"title\":\"Instagram\",\"social_icon\":\"<i class=\\\"lab la-instagram\\\"><\\/i>\",\"url\":\"https:\\/\\/www.instagram.com\\/\"}', NULL, 'basic', '', '2024-06-23 01:06:56', '2024-06-23 01:06:56'),
(171, 'social_icon.element', '{\"title\":\"LinkedIn\",\"social_icon\":\"<i class=\\\"lab la-linkedin-in\\\"><\\/i>\",\"url\":\"https:\\/\\/www.linkedin.com\"}', NULL, 'basic', '', '2024-06-23 01:08:07', '2024-06-23 01:08:07'),
(172, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"ad\",\"ads\",\"ads network\",\"advertiser\",\"banner ads\",\"buy sell ads\",\"digital\",\"marketing\",\"network\",\"panel\",\"PPC\",\"promotion\",\"promotional\",\"publisher\"],\"description\":\"AdsRock, a cutting-edge Ads Network & Digital Marketing Solution designed for entrepreneurs eager to embark on their own Ads network venture. With AdsRock, both advertisers and publishers can thrive, as advertisers effortlessly upload their paid promotional banners (PPC\\/CPM), while publishers effectively monetize their websites by showcasing these enticing ads. Drawing inspiration from renowned ad networks like adward, adchoice, adroll, perfect audience, and bidvertiser, AdsRock embodies a sophisticated concept. The platform boasts top-notch anti-fraud protection, distinct panels catering to advertisers and publishers, easily implementable codes for publishers, instantaneous click and impression tracking, precision GEO targeting, and an array of additional features to maximize success.\",\"social_title\":\"AdsRock - Ads Network & Digital Marketing Platform\",\"social_description\":\"AdsRock, a cutting-edge Ads Network & Digital Marketing Solution designed for entrepreneurs eager to embark on their own Ads network venture. With AdsRock, both advertisers and publishers can thrive, as advertisers effortlessly upload their paid promotional banners (PPC\\/CPM), while publishers effectively monetize their websites by showcasing these enticing ads. Drawing inspiration from renowned ad networks like adward, adchoice, adroll, perfect audience, and bidvertiser, AdsRock embodies a sophisticated concept. The platform boasts top-notch anti-fraud protection, distinct panels catering to advertisers and publishers, easily implementable codes for publishers, instantaneous click and impression tracking, precision GEO targeting, and an array of additional features to maximize success.\",\"image\":\"66bb035c839951723532124.png\"}', NULL, NULL, '', '2024-06-23 03:04:24', '2024-08-13 00:55:24'),
(173, 'register_disable.content', '{\"has_image\":\"1\",\"heading\":\"Registration Currently Disabled\",\"subheading\":\"Page you are looking for doesn\'t exit or an other error occurred or temporarily unavailable.\",\"button_name\":\"Go to Home\",\"button_url\":\"\\/\",\"image\":\"6679432722a071719223079.png\"}', NULL, 'basic', '', '2024-06-24 03:57:59', '2024-06-24 03:57:59'),
(174, 'maintenance.data', '{\"description\":\"<h2 style=\\\"text-align: center;\\\"><font size=\\\"6\\\">We\'re just tuning up a few things.<\\/font><\\/h2><p>We apologize for the inconvenience but Front is currently undergoing planned maintenance. Thanks for your patience.<\\/p>\",\"image\":\"668cf77d725851720514429.png\"}', NULL, NULL, NULL, '2024-06-23 03:04:24', '2024-07-09 02:40:30'),
(175, 'how_it_works.content', '{\"heading\":\"How Adsrock Work\",\"subheading\":\"AdsRock simplifies digital advertising by connecting advertisers with top publishers. Our platform uses advanced targeting to ensure your ads reach the right audience\"}', NULL, 'basic', '', '2024-07-09 03:09:17', '2024-08-08 01:20:44'),
(176, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"6694abb6441f41721019318.png\"}', NULL, 'basic', '', '2024-07-14 22:55:18', '2024-07-14 22:55:19'),
(177, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"6694abbd454981721019325.png\"}', NULL, 'basic', '', '2024-07-14 22:55:25', '2024-07-14 22:55:25'),
(178, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"6694abc40d6cc1721019332.png\"}', NULL, 'basic', '', '2024-07-14 22:55:32', '2024-07-14 22:55:32');
INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `seo_content`, `tempname`, `slug`, `created_at`, `updated_at`) VALUES
(179, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"6694abccd87651721019340.png\"}', NULL, 'basic', '', '2024-07-14 22:55:40', '2024-07-14 22:55:40'),
(180, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"6694ad4fb51d11721019727.png\"}', NULL, 'basic', '', '2024-07-14 23:02:07', '2024-07-14 23:02:07'),
(181, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"6694ad5db5a681721019741.png\"}', NULL, 'basic', '', '2024-07-14 23:02:21', '2024-07-14 23:02:21'),
(182, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"6694ad6d9ef891721019757.png\"}', NULL, 'basic', '', '2024-07-14 23:02:37', '2024-07-14 23:02:37'),
(183, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"6694ad74a7d821721019764.png\"}', NULL, 'basic', '', '2024-07-14 23:02:44', '2024-07-14 23:02:44'),
(184, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"6694ad7b0399f1721019771.png\"}', NULL, 'basic', '', '2024-07-14 23:02:51', '2024-07-14 23:02:51'),
(185, 'footer.content', '{\"description\":\"AdsRock helps you reach a broader audience by publishing your ads across a variety of websites\",\"newsletter_description\":\"Subscribe our newslater now to get all the updates and news\",\"has_image\":\"1\",\"shape\":\"6694f904e4cc01721039108.png\"}', NULL, 'basic', '', '2024-07-15 00:02:55', '2024-08-03 06:24:57'),
(186, 'footer.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"lab la-facebook-f\\\"><\\/i>\",\"url\":\"https:\\/\\/facebook.com\"}', NULL, 'basic', '', '2024-07-15 00:04:45', '2024-07-15 00:04:45'),
(187, 'footer.element', '{\"title\":\"Twitter\",\"social_icon\":\"<i class=\\\"fa-brands fa-x-twitter\\\"><\\/i>\",\"url\":\"https:\\/\\/twitter.com\"}', NULL, 'basic', '', '2024-07-15 00:05:04', '2024-07-15 00:05:04'),
(188, 'footer.element', '{\"title\":\"Linkedin\",\"social_icon\":\"<i class=\\\"lab la-linkedin-in\\\"><\\/i>\",\"url\":\"https:\\/\\/linkedin.com\"}', NULL, 'basic', '', '2024-07-15 00:05:31', '2024-07-15 00:05:31'),
(189, 'breadcrumb.content', '{\"has_image\":\"1\",\"shape\":\"66b36a0e73cb41723034126.png\"}', NULL, 'basic', '', '2024-07-15 05:05:44', '2024-08-07 06:35:26'),
(190, 'kyc.content', '{\"required\":\"Complete KYC to unlock the full potential of our platform! KYC helps us verify your identity and keep things secure. It is quick and easy just follow the on-screen instructions. Get started with KYC verification now!\",\"pending\":\"Your KYC verification is being reviewed. We might need some additional information. You will get an email update soon. In the meantime, explore our platform with limited features.\",\"reject\":\"We regret to inform you that the Know Your Customer (KYC) information provided has been reviewed and unfortunately, it has not met our verification standards.\"}', NULL, 'basic', '', '2024-07-15 05:47:59', '2024-07-15 05:47:59'),
(191, 'policy_pages.element', '{\"title\":\"Cookie Policy\",\"details\":\"<div>\\r\\n    <h4>What Are Cookies?<\\/h4>\\r\\n    <p>Cookies are small data files that are placed on your computer or mobile device when you visit a website. These\\r\\n        files contain information that is transferred to your device\\u2019s hard drive. Cookies are widely used by website\\r\\n        owners for various purposes: they help websites function properly by enabling essential features such as page\\r\\n        navigation and access to secure areas; they improve efficiency by remembering your preferences and actions over\\r\\n        time, such as login details and language settings, so you don\\u2019t have to re-enter them each time you visit; they\\r\\n        provide reporting information that helps website owners understand how their site is being used, including data\\r\\n        on page visits, duration of visits, and any errors that occur, which is crucial for improving site performance\\r\\n        and user experience; they personalize your experience by remembering your preferences and tailoring content to\\r\\n        your interests, including showing relevant advertisements or recommendations based on your browsing history; and\\r\\n        they enhance security by detecting fraudulent activity and protecting your data from unauthorized access. By\\r\\n        using cookies, website owners can enhance the overall functionality and efficiency of their sites, providing a\\r\\n        better experience for their users.<\\/p>\\r\\n    <p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n\\r\\n<div>\\r\\n    <h4>Why Do We Use Cookies?<\\/h4>\\r\\n    <p>We use cookies for several reasons. Some cookies are required for technical reasons for our website to operate,\\r\\n        and we refer to these as \\u201cessential\\u201d or \\u201cstrictly necessary\\u201d cookies. These essential cookies are crucial for\\r\\n        enabling basic functions like page navigation, secure access to certain areas, and ensuring the overall\\r\\n        functionality of the site. Without these cookies, the website cannot perform properly.<\\/p>\\r\\n    <p>Other cookies enable us to track and target the interests of our users to enhance the experience on our website.\\r\\n        These cookies help us understand your preferences and behaviors, allowing us to tailor content and features to\\r\\n        better suit your needs. For example, they can remember your login details, language preferences, and other\\r\\n        customizable settings, providing a more personalized and efficient browsing experience.<br \\/><\\/p>\\r\\n    <p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>Types of Cookies We Use<\\/h4>\\r\\n    <p>\\r\\n    <\\/p>\\r\\n    <ul style=\\\"margin-left:30px;list-style:circle;\\\">\\r\\n        <li style=\\\"margin-bottom:10px;\\\">\\r\\n            <strong>Essential Cookies<\\/strong>\\r\\n            <span>These cookies are necessary for the website to function and cannot be switched off in our systems.\\r\\n                They are usually only set in response to actions made by you which amount to a request for services,\\r\\n                such as setting your privacy preferences, logging in, or filling in forms.<\\/span>\\r\\n        <\\/li>\\r\\n        <li style=\\\"margin-bottom:10px;\\\">\\r\\n            <strong>Performance and Functionality Cookies<\\/strong>\\r\\n            <span>These cookies are used to enhance the performance and functionality of our website but are\\r\\n                non-essential to its use. However, without these cookies, certain functionality may become\\r\\n                unavailable.<\\/span>\\r\\n        <\\/li>\\r\\n        <li style=\\\"margin-bottom:10px;\\\">\\r\\n            <strong>Analytics and Customization Cookies <\\/strong>\\r\\n            <span>These cookies collect information that is used either in aggregate form to help us understand how our\\r\\n                website is being used or how effective our marketing campaigns are, or to help us customize our website\\r\\n                for you.<\\/span>\\r\\n        <\\/li>\\r\\n        <li style=\\\"margin-bottom:10px;\\\">\\r\\n            <strong>Advertising Cookies<\\/strong>\\r\\n            <span>These cookies are used to make advertising messages more relevant to you. They perform functions like\\r\\n                preventing the same ad from continuously reappearing, ensuring that ads are properly displayed for\\r\\n                advertisers, and in some cases selecting advertisements that are based on your interests.<\\/span>\\r\\n        <\\/li>\\r\\n    <\\/ul>\\r\\n    <p><\\/p>\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n\\r\\n<div>\\r\\n    <h4>Your Choices Regarding Cookies<\\/h4>\\r\\n    <p>You have the right to decide whether to accept or reject cookies. You can exercise your cookie preferences by\\r\\n        clicking on the appropriate opt-out links provided in the cookie banner. This banner typically appears when you\\r\\n        first visit our website and allows you to choose which types of cookies you are comfortable with. You can also\\r\\n        set or amend your web browser controls to accept or refuse cookies. Most web browsers provide settings that\\r\\n        allow you to manage or delete cookies, and you can usually find these settings in the \\u201coptions\\u201d or \\u201cpreferences\\u201d\\r\\n        menu of your browser.<\\/p>\\r\\n    <p><br \\/><\\/p>\\r\\n    <p>If you choose to reject cookies, you may still use our website, though your access to some functionality and\\r\\n        areas of our website may be restricted. For example, certain features that rely on cookies to remember your\\r\\n        preferences or login details may not work properly. Additionally, rejecting cookies may impact the\\r\\n        personalization of your experience, as we use cookies to tailor content and advertisements to your interests.\\r\\n        Despite these limitations, we respect your right to control your cookie preferences and strive to provide a\\r\\n        functional and enjoyable browsing experience regardless of your choices.<\\/p>\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n\\r\\n<div>\\r\\n    <h4>Contact Us\\r\\n    <\\/h4>\\r\\n    <p>\\r\\n        If you have any questions about our use of cookies or other technologies, please contact <a href=\\\"\\/contact\\\"><strong> with us<\\/strong><\\/a>. Our team is available to assist you with any inquiries or concerns you may have\\r\\n        regarding our cookie policy. We value your privacy and are committed to ensuring that your experience on our\\r\\n        website is transparent and satisfactory.\\r\\n    <\\/p>\\r\\n<\\/div>\\r\\n<br \\/>\"}', NULL, 'basic', 'cookie-policy', '2024-08-03 06:07:15', '2024-08-03 06:07:15'),
(192, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"How Our Network Can Boost Your Brand Visibility\",\"description\":\"<div>In today\\u2019s competitive digital landscape, standing out and increasing brand visibility is more important than ever. Our network offers a range of innovative solutions designed to enhance your brand\\u2019s presence and reach a wider audience. In this blog post, we\\u2019ll explore how leveraging our network can effectively boost your brand visibility, drive engagement, and accelerate growth. <br \\/><\\/div><div><br \\/><\\/div><div>\\r\\nMaximizing brand visibility requires a strategic approach and the right tools to reach your target audience effectively. By partnering with our network, you can take advantage of advanced advertising solutions, data-driven insights, and comprehensive marketing strategies. Here\\u2019s how our network can help elevate your brand\\u2019s visibility: <br \\/><\\/div><div><br \\/><\\/div>\\r\\n<h4>Targeted Advertising Solutions<\\/h4>\\r\\n<div>\\r\\n  Our network offers advanced targeting capabilities that allow you to reach your ideal audience with precision. By utilizing demographic, geographic, and behavioral data, we can ensure your ads are shown to the right people at the right time, increasing the likelihood of engagement and conversion.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Comprehensive Digital Marketing Strategies<\\/h4>\\r\\n<div>\\r\\n  We provide a full suite of digital marketing services, including SEO, content marketing, and social media management. By integrating these strategies, we create a cohesive marketing plan that amplifies your brand\\u2019s visibility across multiple channels, driving consistent and impactful results.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Data-Driven Insights and Analytics<\\/h4>\\r\\n<div>\\r\\n  Our network leverages cutting-edge analytics tools to track and measure the performance of your campaigns. By analyzing key metrics and user behavior, we provide actionable insights that help optimize your marketing efforts, enhance your strategy, and maximize your return on investment.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Enhanced Brand Presence Across Platforms:<\\/h4>\\r\\n<div>\\r\\n  We ensure your brand maintains a strong presence across various digital platforms, including search engines, social media, and display networks. This multi-channel approach not only increases your brand\\u2019s visibility but also creates a cohesive and recognizable brand image.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Customized Campaign Management:<\\/h4>\\r\\n<div>\\r\\n  Our team of experts collaborates with you to design and execute customized advertising campaigns that align with your brand\\u2019s goals and objectives. By tailoring our strategies to your unique needs, we help you achieve greater visibility and connect with your target audience more effectively.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<div>\\r\\n  Partnering with our network offers a strategic advantage in boosting your brand visibility and driving growth. By leveraging our targeted solutions, comprehensive strategies, and data-driven insights, you can enhance your brand\\u2019s presence, engage with a larger audience, and achieve your marketing goals.\\r\\n<\\/div>\\r\\n<br \\/>\",\"image\":\"66b38436e913b1723040822.png\"}', NULL, 'basic', 'how-our-network-can-boost-your-brand-visibility', '2024-06-10 01:00:14', '2024-08-07 08:27:03'),
(193, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"The Future of Digital Marketing, Trends to Watch in 2024\",\"description\":\"<div>The digital marketing landscape is constantly evolving, driven by rapid technological advancements and shifting consumer behaviors. As we look towards 2024, several key trends are set to reshape the way businesses approach digital marketing. In this blog post, we\\u2019ll explore the emerging trends and innovations that will define the future of digital marketing, offering insights into how businesses can stay ahead of the curve and leverage these trends to achieve success. <br \\/><\\/div><div><br \\/><\\/div><div>\\r\\nUnderstanding and adapting to the latest digital marketing trends is essential for maintaining a competitive edge. By embracing these forward-looking strategies and technologies, businesses can enhance their marketing efforts, engage with their audience more effectively, and drive growth. Here\\u2019s what to watch for in the future of digital marketing: <br \\/><\\/div><div><br \\/><\\/div>\\r\\n<h4>Artificial Intelligence and Machine Learning<\\/h4>\\r\\n<div>\\r\\n  AI and machine learning are becoming increasingly integral to digital marketing strategies. These technologies are enabling more personalized customer experiences, automating repetitive tasks, and providing deeper insights into consumer behavior. From chatbots and virtual assistants to predictive analytics and targeted advertising, AI and ML are transforming how businesses interact with their audience.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Privacy and Data Protection<\\/h4>\\r\\n<div>\\r\\n  As data privacy regulations become more stringent, businesses must prioritize transparent data practices and robust security measures. With growing concerns over data privacy, implementing strategies that build trust and ensure compliance with regulations like GDPR and CCPA will be critical for maintaining customer relationships and avoiding legal pitfalls.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Voice Search Optimization<\\/h4>\\r\\n<div>\\r\\n  The rise of voice-activated devices and virtual assistants is shifting how users search for information online. Optimizing content for voice search involves focusing on natural language, conversational keywords, and local search optimization. Businesses that adapt to this trend can enhance their visibility and capture a growing segment of voice search users.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Interactive Content and Experiences:<\\/h4>\\r\\n<div>\\r\\n  Interactive content\\u2014such as quizzes, polls, and augmented reality (AR) experiences\\u2014is becoming more popular as it engages users in meaningful ways. Creating immersive and interactive experiences can boost engagement, drive user participation, and provide valuable insights into customer preferences and behaviors.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Sustainability and Ethical Marketing:<\\/h4>\\r\\n<div>\\r\\n  Consumers are increasingly prioritizing sustainability and ethical practices in their purchasing decisions. Businesses that emphasize their commitment to environmental responsibility and social impact will resonate with values-driven consumers. Incorporating sustainability into your marketing strategy can enhance brand loyalty and differentiate your business in a crowded market.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<div>\\r\\n  Staying ahead of these digital marketing trends will be crucial for businesses aiming to thrive in 2024 and beyond. By embracing emerging technologies, adapting to evolving consumer expectations, and focusing on ethical practices, businesses can position themselves for long-term success and drive meaningful results in the ever-changing digital landscape.\\r\\n<\\/div>\\r\\n<br \\/>\",\"image\":\"66b383810e87c1723040641.png\"}', NULL, 'basic', 'the-future-of-digital-marketing-trends-to-watch-in-2024', '2024-06-10 01:01:36', '2024-08-07 08:24:01'),
(194, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Maximizing ROI, Strategies for Effective Ad Placement\",\"description\":\"<div>In the dynamic world of digital marketing, optimizing ad placement is crucial for maximizing return on investment (ROI). With the ever-evolving landscape of online advertising, businesses must employ strategic approaches to ensure their ads reach the right audience at the right time. In this blog post, we\'ll delve into key strategies for effective ad placement that can help businesses enhance their ROI, drive meaningful engagement, and achieve their marketing objectives. <br \\/><\\/div><div><br \\/><\\/div><div>\\r\\nEffective ad placement involves more than just choosing where to place your ads\\u2014it\\u2019s about strategically positioning them to capture the attention of your target audience and drive conversions. By implementing the right strategies, businesses can make the most out of their advertising budget and see a substantial increase in ROI. Here\\u2019s how to maximize your ROI through effective ad placement: <br \\/><\\/div><div><br \\/><\\/div>\\r\\n<h4>Audience Targeting<\\/h4>\\r\\n<div>\\r\\n  Leveraging advanced audience targeting techniques can ensure your ads are shown to users who are most likely to be interested in your products or services. By utilizing demographic, geographic, and behavioral data, businesses can fine-tune their ad placements to reach a highly relevant audience, increasing the likelihood of engagement and conversions.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Ad Placement Optimization<\\/h4>\\r\\n<div>\\r\\n  Regularly optimizing ad placements based on performance data is essential for maximizing ROI. By analyzing metrics such as click-through rates (CTR), conversion rates, and cost-per-click (CPC), businesses can adjust their strategies to allocate budget effectively, refine targeting criteria, and enhance ad creative to improve overall performance.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Cross-Platform Integration<\\/h4>\\r\\n<div>\\r\\n  Integrating ad placements across multiple platforms\\u2014such as social media, search engines, and display networks\\u2014can help businesses reach their audience across various touchpoints. This multi-channel approach not only amplifies visibility but also creates a cohesive brand presence, increasing the chances of conversion.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>Real-Time Analytics and Adjustments:<\\/h4>\\r\\n<div>\\r\\n  Utilizing real-time analytics tools enables businesses to monitor ad performance continuously and make data-driven adjustments on the fly. By staying responsive to performance trends and user behavior, businesses can optimize their ad placements in real-time, ensuring maximum ROI and minimizing wasted ad spend.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<h4>A\\/B Testing and Iteration:<\\/h4>\\r\\n<div>\\r\\n  Implementing A\\/B testing allows businesses to experiment with different ad formats, messaging, and placements to determine what resonates best with their audience. By iteratively refining ad strategies based on test results, businesses can identify the most effective approaches for maximizing ROI and driving meaningful results.\\r\\n<\\/div>\\r\\n<br \\/>\\r\\n<div>\\r\\n  By adopting these strategies for effective ad placement, businesses can optimize their advertising efforts, enhance engagement, and achieve a higher return on investment. Staying agile and informed in the ever-changing digital landscape will enable businesses to capitalize on new opportunities and achieve sustained success in their marketing endeavors.\\r\\n<\\/div>\\r\\n<br \\/>\",\"image\":\"66b382ab4ecd61723040427.png\"}', NULL, 'basic', 'maximizing-roi-strategies-for-effective-ad-placement', '2024-06-10 01:02:09', '2024-08-07 08:20:27'),
(195, 'benefit.content', '{\"has_image\":\"1\",\"heading\":\"Benefit from AdsRock\",\"subheading\":\"Our ad network ensures precise targeting, connecting advertisers with high-quality publishers to maximize engagement and drive exceptional results\",\"advertiser_button_text\":\"Become a Advertiser\",\"advertiser_button_url\":\"advertiser\\/register\",\"publisher_button_text\":\"Become a Publisher\",\"publisher_button_url\":\"publisher\\/register\",\"advertiser_image\":\"66b46c305218a1723100208.png\",\"publisher_image\":\"66b46c79dbcf11723100281.png\"}', NULL, 'basic', '', '2024-08-08 00:39:34', '2024-08-08 01:01:53'),
(196, 'benefit.element', '{\"benefit_title\":\"High quality unique traffic covering all GEO\'S\",\"benefit_for\":\"advertiser\"}', NULL, 'basic', '', '2024-08-08 00:39:45', '2024-08-08 00:39:45'),
(197, 'benefit.element', '{\"benefit_title\":\"Deeper targeting than other network\",\"benefit_for\":\"advertiser\"}', NULL, 'basic', '', '2024-08-08 00:39:58', '2024-08-08 00:39:58'),
(198, 'benefit.element', '{\"benefit_title\":\"Own Ad server\",\"benefit_for\":\"advertiser\"}', NULL, 'basic', '', '2024-08-08 00:40:05', '2024-08-08 00:40:05'),
(199, 'benefit.element', '{\"benefit_title\":\"Service for brand\",\"benefit_for\":\"advertiser\"}', NULL, 'basic', '', '2024-08-08 00:40:11', '2024-08-08 00:40:11'),
(200, 'benefit.element', '{\"benefit_title\":\"Monetize up to 30% more effective than before\",\"benefit_for\":\"publisher\"}', NULL, 'basic', '', '2024-08-08 00:40:20', '2024-08-08 00:40:20'),
(201, 'benefit.element', '{\"benefit_title\":\"Get paid via different withdrawal method\",\"benefit_for\":\"publisher\"}', NULL, 'basic', '', '2024-08-08 00:40:25', '2024-08-08 00:40:25'),
(202, 'benefit.element', '{\"benefit_title\":\"Monetize web and mobile traffic\",\"benefit_for\":\"publisher\"}', NULL, 'basic', '', '2024-08-08 00:40:31', '2024-08-08 00:40:31'),
(203, 'benefit.element', '{\"benefit_title\":\"Clean Ads only\",\"benefit_for\":\"publisher\"}', NULL, 'basic', '', '2024-08-08 00:40:38', '2024-08-08 00:40:38'),
(204, 'faq.element', '{\"question\":\"How do I get started with AdsRock?\",\"answer\":\"Getting started is easy. Simply sign up on our platform, create your ad campaign, choose your target audience, and launch your ads. Our intuitive interface will guide you through each step.\"}', NULL, 'basic', '', '2024-08-08 02:23:29', '2024-08-08 02:23:29'),
(205, 'publisher_plan.content', '{\"heading\":\"Smart Plan for Advertiser\",\"title\":\"Maximize your revenue with AdsRock\'s Smart Plan. Our tailored solutions ensure optimal ad placements and higher earnings, all while maintaining a great user experience\"}', NULL, 'basic', '', '2024-08-08 04:29:31', '2024-08-08 06:35:12'),
(206, 'advertiser_plan.content', '{\"heading\":\"Smart Plan for Advertiser\",\"title\":\"Maximize your revenue with AdsRock\'s Smart Plan. Our tailored solutions ensure optimal ad placements and higher earnings, all while maintaining a great user experience\"}', NULL, 'basic', '', '2024-08-08 06:36:59', '2024-08-08 06:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` bigint UNSIGNED NOT NULL,
  `form_id` int UNSIGNED NOT NULL DEFAULT '0',
  `code` int DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `gateway_parameters` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `supported_currencies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `crypto` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `form_id`, `code`, `name`, `alias`, `image`, `status`, `gateway_parameters`, `supported_currencies`, `crypto`, `extra`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 101, 'Paypal', 'Paypal', '663a38d7b455d1715091671.png', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"sb-owud61543012@business.example.com\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2021-05-20 18:04:38'),
(2, 0, 102, 'Perfect Money', 'PerfectMoney', '663a3920e30a31715091744.png', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"hR26aw02Q1eEeUPSIfuwNypXX\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2021-05-20 19:35:33'),
(3, 0, 103, 'Stripe Hosted', 'Stripe', '663a39861cb9d1715091846.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2021-05-20 18:48:36'),
(4, 0, 104, 'Skrill', 'Skrill', '663a39494c4a91715091785.png', 1, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"merchant@skrill.com\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"---\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2021-05-20 19:30:16'),
(5, 0, 105, 'PayTM', 'Paytm', '663a390f601191715091727.png', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"DIY12386817555501617\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"bKMfNxPPf_QdZppa\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"DIYtestingweb\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"Retail\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"WEB\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2021-05-20 21:00:44'),
(6, 0, 106, 'Payeer', 'Payeer', '663a38c9e2e931715091657.png', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"866989763\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"7575\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.Payeer\"}}', NULL, '2019-09-14 07:14:22', '2022-08-28 04:11:14'),
(7, 0, 107, 'PayStack', 'Paystack', '663a38fc814e91715091708.png', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"pk_test_cd330608eb47970889bca397ced55c1dd5ad3783\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"sk_test_8a0b1f199362d7acc9c390bff72c4e81f74e2ac3\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.Paystack\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.Paystack\"}}\r\n', NULL, '2019-09-14 07:14:22', '2021-05-20 19:49:51'),
(9, 0, 109, 'Flutterwave', 'Flutterwave', '663a36c2c34d61715091138.png', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------------------\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"------------------\"}}', '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2021-06-05 05:37:45'),
(10, 0, 110, 'RazorPay', 'Razorpay', '663a393a527831715091770.png', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"rzp_test_kiOtejPbRZU90E\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"osRDebzEqbsE1kbyQJ4y0re7\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2021-05-20 20:51:32'),
(11, 0, 111, 'Stripe Storefront', 'StripeJs', '663a3995417171715091861.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2021-05-20 18:53:10'),
(12, 0, 112, 'Instamojo', 'Instamojo', '663a384d54a111715091533.png', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_2241633c3bc44a3de84a3b33969\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"test_279f083f7bebefd35217feef22d\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2021-05-20 20:56:20'),
(13, 0, 501, 'Blockchain', 'Blockchain', '663a35efd0c311715090927.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"55529946-05ca-48ff-8710-f279d86b1cc5\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"xpub6CKQ3xxWyBoFAF83izZCSFUorptEU9AF8TezhtWeMU5oefjX3sFSBw62Lr9iHXPkXmDQJJiHZeTRtD9Vzt8grAYRhvbz4nEvBu3QKELVzFK\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, NULL, '2019-09-14 07:14:22', '2022-03-21 01:41:56'),
(15, 0, 503, 'CoinPayments', 'Coinpayments', '663a36a8d8e1d1715091112.png', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"---------------------\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"---------------------\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"---------------------\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"USDT.BEP20\":\"Tether USD (BSC Chain)\",\"USDT.ERC20\":\"Tether USD (ERC20)\",\"USDT.TRC20\":\"Tether USD (Tron/TRC20)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, NULL, '2019-09-14 07:14:22', '2023-04-07 21:17:18'),
(16, 0, 504, 'CoinPayments Fiat', 'CoinpaymentsFiat', '663a36b7b841a1715091127.png', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"6515561\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2021-05-20 20:07:44'),
(17, 0, 505, 'Coingate', 'Coingate', '663a368e753381715091086.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"6354mwVCEw5kHzRJ6thbGo-N\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2022-03-30 03:24:57'),
(18, 0, 506, 'Coinbase Commerce', 'CoinbaseCommerce', '663a367e46ae51715091070.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"c47cd7df-d8e8-424b-a20a\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"55871878-2c32-4f64-ab66\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.CoinbaseCommerce\"}}', NULL, '2019-09-14 07:14:22', '2021-05-20 20:02:47'),
(24, 0, 113, 'Paypal Express', 'PaypalSdk', '663a38ed101a61715091693.png', 1, '{\"clientId\":{\"title\":\"Paypal Client ID\",\"global\":true,\"value\":\"Ae0-tixtSV7DvLwIh3Bmu7JvHrjh5EfGdXr_cEklKAVjjezRZ747BxKILiBdzlKKyp-W8W_T7CKH1Ken\"},\"clientSecret\":{\"title\":\"Client Secret\",\"global\":true,\"value\":\"EOhbvHZgFNO21soQJT1L9Q00M3rK6PIEsdiTgXRBt2gtGtxwRer5JvKnVUGNU5oE63fFnjnYY7hq3HBA\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2021-05-20 17:01:08'),
(25, 0, 114, 'Stripe Checkout', 'StripeV3', '663a39afb519f1715091887.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"},\"end_point\":{\"title\":\"End Point Secret\",\"global\":true,\"value\":\"whsec_lUmit1gtxwKTveLnSe88xCSDdnPOt8g5\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, '{\"webhook\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.StripeV3\"}}', NULL, '2019-09-14 07:14:22', '2021-05-20 18:58:38'),
(27, 0, 115, 'Mollie', 'Mollie', '663a387ec69371715091582.png', 1, '{\"mollie_email\":{\"title\":\"Mollie Email \",\"global\":true,\"value\":\"vi@gmail.com\"},\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_cucfwKTWfft9s337qsVfn5CC4vNkrn\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2021-05-20 20:44:45'),
(30, 0, 116, 'Cashmaal', 'Cashmaal', '663a361b16bd11715090971.png', 1, '{\"web_id\":{\"title\":\"Web Id\",\"global\":true,\"value\":\"3748\"},\"ipn_key\":{\"title\":\"IPN Key\",\"global\":true,\"value\":\"546254628759524554647987\"}}', '{\"PKR\":\"PKR\",\"USD\":\"USD\"}', 0, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.Cashmaal\"}}', NULL, NULL, '2021-06-22 02:05:04'),
(36, 0, 119, 'Mercado Pago', 'MercadoPago', '663a386c714a91715091564.png', 1, '{\"access_token\":{\"title\":\"Access Token\",\"global\":true,\"value\":\"APP_USR-7924565816849832-082312-21941521997fab717db925cf1ea2c190-1071840315\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2022-09-14 01:41:14'),
(37, 0, 120, 'Authorize.net', 'Authorize', '663a35b9ca5991715090873.png', 1, '{\"login_id\":{\"title\":\"Login ID\",\"global\":true,\"value\":\"59e4P9DBcZv\"},\"transaction_key\":{\"title\":\"Transaction Key\",\"global\":true,\"value\":\"47x47TJyLw2E7DbR\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2022-08-28 03:33:06'),
(46, 0, 121, 'NMI', 'NMI', '663a3897754cf1715091607.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"2F822Rw39fx762MaV7Yy86jXGTC7sCDy\"}}', '{\"AED\":\"AED\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"RUB\":\"RUB\",\"SEC\":\"SEC\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2022-08-28 04:32:31'),
(50, 0, 507, 'BTCPay', 'BTCPay', '663a35cd25a8d1715090893.png', 1, '{\"store_id\":{\"title\":\"Store Id\",\"global\":true,\"value\":\"HsqFVTXSeUFJu7caoYZc3CTnP8g5LErVdHhEXPVTheHf\"},\"api_key\":{\"title\":\"Api Key\",\"global\":true,\"value\":\"4436bd706f99efae69305e7c4eff4780de1335ce\"},\"server_name\":{\"title\":\"Server Name\",\"global\":true,\"value\":\"https:\\/\\/testnet.demo.btcpayserver.org\"},\"secret_code\":{\"title\":\"Secret Code\",\"global\":true,\"value\":\"SUCdqPn9CDkY7RmJHfpQVHP2Lf2\"}}', '{\"BTC\":\"Bitcoin\",\"LTC\":\"Litecoin\"}', 1, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.BTCPay\"}}', NULL, NULL, '2023-02-13 22:42:09'),
(51, 0, 508, 'Now payments hosted', 'NowPaymentsHosted', '663a38b8d57a81715091640.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"--------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"------------\"}}', '{\"BTG\":\"BTG\",\"ETH\":\"ETH\",\"XMR\":\"XMR\",\"ZEC\":\"ZEC\",\"XVG\":\"XVG\",\"ADA\":\"ADA\",\"LTC\":\"LTC\",\"BCH\":\"BCH\",\"QTUM\":\"QTUM\",\"DASH\":\"DASH\",\"XLM\":\"XLM\",\"XRP\":\"XRP\",\"XEM\":\"XEM\",\"DGB\":\"DGB\",\"LSK\":\"LSK\",\"DOGE\":\"DOGE\",\"TRX\":\"TRX\",\"KMD\":\"KMD\",\"REP\":\"REP\",\"BAT\":\"BAT\",\"ARK\":\"ARK\",\"WAVES\":\"WAVES\",\"BNB\":\"BNB\",\"XZC\":\"XZC\",\"NANO\":\"NANO\",\"TUSD\":\"TUSD\",\"VET\":\"VET\",\"ZEN\":\"ZEN\",\"GRS\":\"GRS\",\"FUN\":\"FUN\",\"NEO\":\"NEO\",\"GAS\":\"GAS\",\"PAX\":\"PAX\",\"USDC\":\"USDC\",\"ONT\":\"ONT\",\"XTZ\":\"XTZ\",\"LINK\":\"LINK\",\"RVN\":\"RVN\",\"BNBMAINNET\":\"BNBMAINNET\",\"ZIL\":\"ZIL\",\"BCD\":\"BCD\",\"USDT\":\"USDT\",\"USDTERC20\":\"USDTERC20\",\"CRO\":\"CRO\",\"DAI\":\"DAI\",\"HT\":\"HT\",\"WABI\":\"WABI\",\"BUSD\":\"BUSD\",\"ALGO\":\"ALGO\",\"USDTTRC20\":\"USDTTRC20\",\"GT\":\"GT\",\"STPT\":\"STPT\",\"AVA\":\"AVA\",\"SXP\":\"SXP\",\"UNI\":\"UNI\",\"OKB\":\"OKB\",\"BTC\":\"BTC\"}', 1, '', NULL, NULL, '2023-02-13 23:08:23'),
(52, 0, 509, 'Now payments checkout', 'NowPaymentsCheckout', '663a38a59d2541715091621.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"---------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 1, '', NULL, NULL, '2023-02-13 23:08:04'),
(53, 0, 122, '2Checkout', 'TwoCheckout', '663a39b8e64b91715091896.png', 1, '{\"merchant_code\":{\"title\":\"Merchant Code\",\"global\":true,\"value\":\"253248016872\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"eQM)ID@&vG84u!O*g[p+\"}}', '{\"AFN\": \"AFN\",\"ALL\": \"ALL\",\"DZD\": \"DZD\",\"ARS\": \"ARS\",\"AUD\": \"AUD\",\"AZN\": \"AZN\",\"BSD\": \"BSD\",\"BDT\": \"BDT\",\"BBD\": \"BBD\",\"BZD\": \"BZD\",\"BMD\": \"BMD\",\"BOB\": \"BOB\",\"BWP\": \"BWP\",\"BRL\": \"BRL\",\"GBP\": \"GBP\",\"BND\": \"BND\",\"BGN\": \"BGN\",\"CAD\": \"CAD\",\"CLP\": \"CLP\",\"CNY\": \"CNY\",\"COP\": \"COP\",\"CRC\": \"CRC\",\"HRK\": \"HRK\",\"CZK\": \"CZK\",\"DKK\": \"DKK\",\"DOP\": \"DOP\",\"XCD\": \"XCD\",\"EGP\": \"EGP\",\"EUR\": \"EUR\",\"FJD\": \"FJD\",\"GTQ\": \"GTQ\",\"HKD\": \"HKD\",\"HNL\": \"HNL\",\"HUF\": \"HUF\",\"INR\": \"INR\",\"IDR\": \"IDR\",\"ILS\": \"ILS\",\"JMD\": \"JMD\",\"JPY\": \"JPY\",\"KZT\": \"KZT\",\"KES\": \"KES\",\"LAK\": \"LAK\",\"MMK\": \"MMK\",\"LBP\": \"LBP\",\"LRD\": \"LRD\",\"MOP\": \"MOP\",\"MYR\": \"MYR\",\"MVR\": \"MVR\",\"MRO\": \"MRO\",\"MUR\": \"MUR\",\"MXN\": \"MXN\",\"MAD\": \"MAD\",\"NPR\": \"NPR\",\"TWD\": \"TWD\",\"NZD\": \"NZD\",\"NIO\": \"NIO\",\"NOK\": \"NOK\",\"PKR\": \"PKR\",\"PGK\": \"PGK\",\"PEN\": \"PEN\",\"PHP\": \"PHP\",\"PLN\": \"PLN\",\"QAR\": \"QAR\",\"RON\": \"RON\",\"RUB\": \"RUB\",\"WST\": \"WST\",\"SAR\": \"SAR\",\"SCR\": \"SCR\",\"SGD\": \"SGD\",\"SBD\": \"SBD\",\"ZAR\": \"ZAR\",\"KRW\": \"KRW\",\"LKR\": \"LKR\",\"SEK\": \"SEK\",\"CHF\": \"CHF\",\"SYP\": \"SYP\",\"THB\": \"THB\",\"TOP\": \"TOP\",\"TTD\": \"TTD\",\"TRY\": \"TRY\",\"UAH\": \"UAH\",\"AED\": \"AED\",\"USD\": \"USD\",\"VUV\": \"VUV\",\"VND\": \"VND\",\"XOF\": \"XOF\",\"YER\": \"YER\"}', 1, '{\"approved_url\":{\"title\": \"Approved URL\",\"value\":\"ipn.TwoCheckout\"}}', NULL, NULL, '2023-04-29 03:21:58'),
(54, 0, 123, 'Checkout', 'Checkout', '663a3628733351715090984.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"------\"},\"public_key\":{\"title\":\"PUBLIC KEY\",\"global\":true,\"value\":\"------\"},\"processing_channel_id\":{\"title\":\"PROCESSING CHANNEL\",\"global\":true,\"value\":\"------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"AUD\":\"AUD\",\"CAN\":\"CAN\",\"CHF\":\"CHF\",\"SGD\":\"SGD\",\"JPY\":\"JPY\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2023-05-06 01:43:01'),
(56, 0, 510, 'Binance', 'Binance', '663a35db4fd621715090907.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"tsu3tjiq0oqfbtmlbevoeraxhfbp3brejnm9txhjxcp4to29ujvakvfl1ibsn3ja\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"jzngq4t04ltw8d4iqpi7admfl8tvnpehxnmi34id1zvfaenbwwvsvw7llw3zdko8\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"231129033\"}}', '{\"BTC\":\"Bitcoin\",\"USD\":\"USD\",\"BNB\":\"BNB\"}', 1, '{\"cron\":{\"title\": \"Cron Job URL\",\"value\":\"ipn.Binance\"}}', NULL, NULL, '2023-02-14 05:08:04'),
(57, 0, 124, 'SslCommerz', 'SslCommerz', '663a397a70c571715091834.png', 1, '{\"store_id\": {\"title\": \"Store ID\",\"global\": true,\"value\": \"---------\"},\"store_password\": {\"title\": \"Store Password\",\"global\": true,\"value\": \"----------\"}}', '{\"BDT\":\"BDT\",\"USD\":\"USD\",\"EUR\":\"EUR\",\"SGD\":\"SGD\",\"INR\":\"INR\",\"MYR\":\"MYR\"}', 0, NULL, NULL, NULL, '2023-05-06 07:43:01'),
(58, 0, 125, 'Aamarpay', 'Aamarpay', '663a34d5d1dfc1715090645.png', 1, '{\"store_id\":{\"title\":\"Store ID\",\"global\":true,\"value\":\"---------\"},\"signature_key\":{\"title\":\"Signature Key\",\"global\":true,\"value\":\"----------\"}}', '{\"BDT\":\"BDT\"}', 0, NULL, NULL, NULL, '2024-08-06 04:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_code` int DEFAULT NULL,
  `gateway_alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `max_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `percent_charge` decimal(5,2) NOT NULL DEFAULT '0.00',
  `fixed_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `gateway_parameter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `site_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available_version` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `email_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_template` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_template` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'email configuration',
  `sms_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `firebase_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `global_shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kv` tinyint(1) NOT NULL DEFAULT '0',
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'mobile verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'sms notification, 0 - dont send, 1 - send',
  `pn` tinyint(1) NOT NULL DEFAULT '1',
  `force_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `in_app_payment` tinyint(1) NOT NULL DEFAULT '1',
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT '0',
  `secure_password` tinyint(1) NOT NULL DEFAULT '0',
  `agree` tinyint(1) NOT NULL DEFAULT '0',
  `multi_language` tinyint(1) NOT NULL DEFAULT '1',
  `registration` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Off	, 1: On',
  `ad_registration` tinyint(1) NOT NULL DEFAULT '1',
  `active_template` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `socialite_credentials` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `system_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `system_customized` tinyint(1) NOT NULL DEFAULT '0',
  `paginate_number` int NOT NULL DEFAULT '0',
  `currency_format` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>Both\r\n2=>Text Only\r\n3=>Symbol Only',
  `cpc` decimal(28,8) NOT NULL DEFAULT '0.00000000' COMMENT 'Cost per click ',
  `cpm` decimal(28,8) NOT NULL DEFAULT '0.00000000' COMMENT 'Cost per impression',
  `epc` decimal(28,8) NOT NULL DEFAULT '0.00000000' COMMENT 'Earn per click',
  `epm` decimal(28,8) NOT NULL DEFAULT '0.00000000' COMMENT 'Earn per impression',
  `domain_approval` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'YES->1, No->0',
  `check_country` tinyint(1) NOT NULL DEFAULT '1',
  `check_domain_keyword` tinyint(1) NOT NULL DEFAULT '1',
  `intervals` int NOT NULL DEFAULT '0',
  `country_detector_config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `banner_video` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `available_version`, `cur_text`, `cur_sym`, `email_from`, `email_from_name`, `email_template`, `sms_template`, `sms_from`, `push_title`, `push_template`, `base_color`, `secondary_color`, `mail_config`, `sms_config`, `firebase_config`, `global_shortcodes`, `kv`, `ev`, `en`, `sv`, `sn`, `pn`, `force_ssl`, `in_app_payment`, `maintenance_mode`, `secure_password`, `agree`, `multi_language`, `registration`, `ad_registration`, `active_template`, `socialite_credentials`, `system_info`, `system_customized`, `paginate_number`, `currency_format`, `cpc`, `cpm`, `epc`, `epm`, `domain_approval`, `check_country`, `check_domain_keyword`, `intervals`, `country_detector_config`, `banner_video`, `created_at`, `updated_at`) VALUES
(1, 'AdsROCK', '0', 'USD', '$', 'admin@site.com', '{{site_name}}', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\">\r\n                          <a href=\"#\">\r\n                            <img style=\"display:block; line-height:0px; font-size:0px; border:0px;\" src=\"https://i.imgur.com/Z1qtvtV.png\" alt=\"img\">\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello {{fullname}} ({{username}})</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\">{{message}}</td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2024&nbsp;<a href=\"#\">{{site_name}}</a>&nbsp;. All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', 'hi {{fullname}} ({{username}}), {{message}}', 'ViserAdmin', NULL, NULL, '16C79A', '062c4e', '{\"name\":\"php\"}', '{\"name\":\"nexmo\",\"clickatell\":{\"api_key\":\"----------------\"},\"infobip\":{\"username\":\"------------8888888\",\"password\":\"-----------------\"},\"message_bird\":{\"api_key\":\"-------------------\"},\"nexmo\":{\"api_key\":\"----------------------\",\"api_secret\":\"----------------------\"},\"sms_broadcast\":{\"username\":\"----------------------\",\"password\":\"-----------------------------\"},\"twilio\":{\"account_sid\":\"-----------------------\",\"auth_token\":\"---------------------------\",\"from\":\"----------------------\"},\"text_magic\":{\"username\":\"-----------------------\",\"apiv2_key\":\"-------------------------------\"},\"custom\":{\"method\":\"get\",\"url\":\"https:\\/\\/hostname\\/demo-api-v1\",\"headers\":{\"name\":[\"api_key\"],\"value\":[\"test_api 555\"]},\"body\":{\"name\":[\"from_number\"],\"value\":[\"5657545757\"]}}}', '{\"apiKey\":\"------------\",\"authDomain\":\"------------------\",\"projectId\":\"--------------\",\"storageBucket\":\"-----------------\",\"messagingSenderId\":\"----------------\",\"appId\":\"---------------\",\"measurementId\":\"---------------\"}', '{\r\n    \"site_name\":\"Name of your site\",\r\n    \"site_currency\":\"Currency of your site\",\r\n    \"currency_symbol\":\"Symbol of currency\"\r\n}', 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 1, 1, 1, 1, 'basic', '{\"google\":{\"client_id\":\"-------------\",\"client_secret\":\"------------\",\"status\":1},\"facebook\":{\"client_id\":\"------\",\"client_secret\":\"------\",\"status\":1},\"linkedin\":{\"client_id\":\"-----\",\"client_secret\":\"-----\",\"status\":1}}', '[]', 0, 20, 1, 2.00000000, 1.00000000, 0.88000000, 0.50000000, 1, 0, 1, 1, '{\"name\":null}', '667fc78c25c0e1719650188.mp4', NULL, '2024-08-13 00:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `ip_charts`
--

CREATE TABLE `ip_charts` (
  `id` bigint NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 => not blocked, 1 => blocked	',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ip_logs`
--

CREATE TABLE `ip_logs` (
  `id` bigint NOT NULL,
  `ip_chart_id` int NOT NULL DEFAULT '0',
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advertise_id` int NOT NULL DEFAULT '0',
  `ad_type` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `id` bigint NOT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: not default language, 1: default language',
  `image` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `is_default`, `image`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 1, '6677cba61c6031719126950.png', '2020-07-06 03:47:55', '2024-06-23 01:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `advertiser_id` int UNSIGNED NOT NULL DEFAULT '0',
  `publisher_id` int NOT NULL DEFAULT '0',
  `sender` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_to` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notification_type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `push_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_status` tinyint(1) NOT NULL DEFAULT '1',
  `email_sent_from_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_sent_from_address` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_status` tinyint(1) NOT NULL DEFAULT '1',
  `sms_sent_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `act`, `name`, `subject`, `push_title`, `email_body`, `sms_body`, `push_body`, `shortcodes`, `email_status`, `email_sent_from_name`, `email_sent_from_address`, `sms_status`, `sms_sent_from`, `push_status`, `created_at`, `updated_at`) VALUES
(1, 'BAL_ADD', 'Balance - Added', 'Your Account has been Credited', NULL, '<div><div style=\"font-family: Montserrat, sans-serif;\">{{amount}} {{site_currency}} has been added to your account .</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Your Current Balance is :&nbsp;</span><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">{{post_balance}}&nbsp; {{site_currency}}&nbsp;</span></font><br></div><div><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></font></div><div>Admin note:&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 12px; font-weight: 600; white-space: nowrap; text-align: var(--bs-body-text-align);\">{{remark}}</span></div>', '{{amount}} {{site_currency}} credited in your account. Your Current Balance {{post_balance}} {{site_currency}} . Transaction: #{{trx}}. Admin note is \"{{remark}}\"', NULL, '{\"trx\":\"Transaction number for the action\",\"amount\":\"Amount inserted by the admin\",\"remark\":\"Remark inserted by the admin\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2022-04-03 02:18:28'),
(2, 'BAL_SUB', 'Balance - Subtracted', 'Your Account has been Debited', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">{{amount}} {{site_currency}} has been subtracted from your account .</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Your Current Balance is :&nbsp;</span><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">{{post_balance}}&nbsp; {{site_currency}}</span></font><br><div><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></font></div><div>Admin Note: {{remark}}</div>', '{{amount}} {{site_currency}} debited from your account. Your Current Balance {{post_balance}} {{site_currency}} . Transaction: #{{trx}}. Admin Note is {{remark}}', NULL, '{\"trx\":\"Transaction number for the action\",\"amount\":\"Amount inserted by the admin\",\"remark\":\"Remark inserted by the admin\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-04-03 02:24:11'),
(3, 'DEPOSIT_COMPLETE', 'Deposit - Automated - Successful', 'Deposit Completed Successfully', NULL, '<div>Your deposit of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been completed Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#000000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Received : {{method_amount}} {{method_currency}}<br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} Deposit successfully by {{method_name}}', NULL, '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-04-03 02:25:43'),
(4, 'DEPOSIT_APPROVE', 'Deposit - Manual - Approved', 'Your Deposit is Approved', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>is Approved .<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div>', 'Admin Approve Your {{amount}} {{site_currency}} payment request by {{method_name}} transaction : {{trx}}', NULL, '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-04-03 02:26:07'),
(5, 'DEPOSIT_REJECT', 'Deposit - Manual - Rejected', 'Your Deposit Request is Rejected', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}} has been rejected</span>.<span style=\"font-weight: bolder;\"><br></span></div><div><br></div><div><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge: {{charge}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number was : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">if you have any queries, feel free to contact us.<br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><br><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">{{rejection_message}}</span><br>', 'Admin Rejected Your {{amount}} {{site_currency}} payment request by {{method_name}}\r\n\r\n{{rejection_message}}', NULL, '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"rejection_message\":\"Rejection message by the admin\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-04-05 03:45:27'),
(6, 'DEPOSIT_REQUEST', 'Deposit - Manual - Requested', 'Deposit Request Submitted Successfully', NULL, '<div>Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>submitted successfully<span style=\"font-weight: bolder;\">&nbsp;.<br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}}<br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} Deposit requested by {{method_name}}. Charge: {{charge}} . Trx: {{trx}}', NULL, '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-04-03 02:29:19'),
(7, 'PASS_RESET_CODE', 'Password - Reset - Code', 'Password Reset', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">We have received a request to reset the password for your account on&nbsp;<span style=\"font-weight: bolder;\">{{time}} .<br></span></div><div style=\"font-family: Montserrat, sans-serif;\">Requested From IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>.</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><div>Your account recovery code is:&nbsp;&nbsp;&nbsp;<font size=\"6\"><span style=\"font-weight: bolder;\">{{code}}</span></font></div><div><br></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><div><font size=\"4\" color=\"#CC0000\"><br></font></div>', 'Your account recovery code is: {{code}}', NULL, '{\"code\":\"Verification code for password reset\",\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:05'),
(8, 'PASS_RESET_DONE', 'Password - Reset - Confirmation', 'You have reset your password', NULL, '<p style=\"font-family: Montserrat, sans-serif;\">You have successfully reset your password.</p><p style=\"font-family: Montserrat, sans-serif;\">You changed from&nbsp; IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{time}}</span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><font color=\"#ff0000\">If you did not change that, please contact us as soon as possible.</font></span></p>', 'Your password has been changed successfully', NULL, '{\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-04-05 03:46:35'),
(9, 'ADMIN_SUPPORT_REPLY', 'Support - Reply', 'Reply Support Ticket', NULL, '<div><p><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\">A member from our support team has replied to the following ticket:</span></span></p><p><span style=\"font-weight: bolder;\"><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\"><br></span></span></span></p><p><span style=\"font-weight: bolder;\">[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</span></p><p>----------------------------------------------</p><p>Here is the reply :<br></p><p>{{reply}}<br></p></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', 'Your Ticket#{{ticket_id}} :  {{ticket_subject}} has been replied.', NULL, '{\"ticket_id\":\"ID of the support ticket\",\"ticket_subject\":\"Subject  of the support ticket\",\"reply\":\"Reply made by the admin\",\"link\":\"URL to view the support ticket\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:51'),
(10, 'EVER_CODE', 'Verification - Email', 'Please verify your email address', NULL, '<br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For joining us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Please use the below code to verify your email address.<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your email verification code is:<font size=\"6\"><span style=\"font-weight: bolder;\">&nbsp;{{code}}</span></font></div></div>', '---', NULL, '{\"code\":\"Email verification code\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2022-04-03 02:32:07'),
(11, 'SVER_CODE', 'Verification - SMS', 'Verify Your Mobile Number', NULL, '---', 'Your phone verification code is: {{code}}', NULL, '{\"code\":\"SMS Verification Code\"}', 0, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-03-20 19:24:37'),
(12, 'WITHDRAW_APPROVE', 'Withdraw - Approved', 'Withdraw Request has been Processed and your money is sent', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been Processed Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You will get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">-----</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\">Details of Processed Payment :</font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\"><span style=\"font-weight: bolder;\">{{admin_details}}</span></font></div>', 'Admin Approve Your {{amount}} {{site_currency}} withdraw request by {{method_name}}. Transaction {{trx}}', NULL, '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"admin_details\":\"Details provided by the admin\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-03-20 20:50:16'),
(13, 'WITHDRAW_REJECT', 'Withdraw - Rejected', 'Withdraw Request has been Rejected and your money is refunded to your account', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been Rejected.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You should get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">----</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><br></font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\">{{amount}} {{method_currency}} has been&nbsp;<span style=\"font-weight: bolder;\">refunded&nbsp;</span>to your account and your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}}</span><span style=\"font-weight: bolder;\">&nbsp;{{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">-----</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\">Details of Rejection :</font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\"><span style=\"font-weight: bolder;\">{{admin_details}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br><br><br><br><br></div><div></div><div></div>', 'Admin Rejected Your {{amount}} {{site_currency}} withdraw request. Your Main Balance {{post_balance}}  {{method_name}} , Transaction {{trx}}', NULL, '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after fter this action\",\"admin_details\":\"Rejection message by the admin\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-03-20 20:57:46'),
(14, 'WITHDRAW_REQUEST', 'Withdraw - Requested', 'Withdraw Request Submitted Successfully', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been submitted Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You will get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br><br><br></div>', '{{amount}} {{site_currency}} withdraw requested by {{method_name}}. You will get {{method_amount}} {{method_currency}} Trx: {{trx}}', NULL, '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after fter this transaction\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-03-21 04:39:03'),
(15, 'DEFAULT', 'Default Template', '{{subject}}', '{{subject}}', '{{message}}', '{{message}}', '{{message}}', '{\"subject\":\"Subject\",\"message\":\"Message\"}', 1, NULL, NULL, 1, NULL, 1, '2019-09-14 13:14:22', '2024-06-29 03:55:19'),
(18, 'PLAN_PURCHASED', 'Plan Purchased —Successfully', 'Plan Purchased—Successfully', NULL, '<div><b>{{plan}}</b> Plan has been purchased successfully by paying of <b>{{amount}} {{site_currency}}</b>&nbsp; via&nbsp; <b>{{method_name}} </b></div><div><b><br></b></div><div><b>Details of your Payment:<br></b></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Plan Name : {{plan}}</div><div>Plan Credit : {{credit}}</div><div>Plan Type : {{type}}<br></div><div><br></div><div>Conversion Rate : 1 {{method_currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}} <br></div><div>Paid via :&nbsp; {{method_name}}</div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\">Your current Balance is <b>{{post_balance}} {{site_currency}}</b></font></div>', ' Plan purchased successfully by paying {{amount}} {{site_currrency}} by {{gateway_name}}', NULL, '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"site_currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\",\"plan\":\"plan name\",\"credit\":\"plan credit\",\"type\":\"plan type\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2022-04-03 02:18:28'),
(19, 'PURCHASE_REQUEST', 'Price Plan Purchase via manual gateway', 'Price Plan purchase request submitted successfully', NULL, '<div>Your Price Plan purchase request of <b>{{amount}} {{site_currency}}</b> is via&nbsp; <b>{{method_name}} </b>submitted successfully<b> .<br></b></div><div><b>Details of your Price plan:<br></b></div><div>Plan Name : {{name}}</div><div>Plan Type : {{type}}</div><div>Plan Credit : {{credit}}</div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}} <br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div>', '{{amount}} Deposit requested by {{method}}. Charge: {{charge}} . Trx: {{trx}}\r\n', NULL, '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"site_currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\",\"name\":\"price plan name\",\"type\":\"plan type\",\"credit\":\"plan credit\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2022-04-03 02:18:28'),
(21, 'DOMAIN_VERIFY', 'Domain Verify', 'Your Domain is Verify', NULL, '<h2 style=\"font-family: Montserrat, sans-serif;\">Congratulations</h2><div style=\"font-family: Montserrat, sans-serif;\">Your domain<span style=\"font-weight: bolder;\">&nbsp;</span>is verified.</div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder; background-color: var(--bs-card-bg); font-size: 1rem; text-align: var(--bs-body-text-align);\">Domain Details :</span></div><div style=\"font-family: Montserrat, sans-serif;\">Name : {{name}}</div><div style=\"\"><font color=\"#000000\"><font face=\"Montserrat, sans-serif\">Tracker Number:&nbsp;</font><span style=\"background-color: var(--bs-card-bg); text-align: var(--bs-body-text-align);\"><font face=\"Montserrat, sans-serif\" color=\"#000000\">{{tracker}}</font></span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div>', 'Admin Approve Your domain.\r\nDomain Name : {{name}}\r\nTracker Number : {{tracker}}', NULL, '{\"tracker\":\"Tracker number for domain\",\"name\":\"The name of domain\"}', 1, 'Viserlab', 'support@viserlab.com', 1, NULL, 0, '2021-11-03 06:00:00', '2024-08-08 05:31:51');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'template name',
  `secs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `seo_content`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'HOME', '/', 'templates.basic.', '[\"counter\",\"benefit\",\"choose_us\",\"advertiser_plan\",\"how_it_works\",\"testimonial\",\"blog\",\"faq\",\"cta\"]', NULL, 1, '2020-07-11 00:23:58', '2024-08-08 06:37:53'),
(6, 'About Us', 'about-us', 'templates.basic.', '[\"choose_us\",\"testimonial\",\"cta\"]', NULL, 0, '2023-07-12 05:26:14', '2024-08-08 03:54:09'),
(7, 'Blog', 'blog', 'templates.basic.', '[\"cta\"]', NULL, 1, '2020-07-11 00:23:58', '2024-08-08 03:54:33'),
(8, 'Contact', 'contact', 'templates.basic.', '[\"cta\"]', NULL, 1, '2020-07-11 00:23:58', '2024-08-08 03:55:01');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plan_prices`
--

CREATE TABLE `plan_prices` (
  `id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=> Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` bigint NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dial_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `earning` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = active, 2 = banned, 0 = deactive,	',
  `ev` tinyint(1) NOT NULL DEFAULT '0',
  `kv` tinyint(1) NOT NULL DEFAULT '0',
  `sv` tinyint(1) NOT NULL DEFAULT '0',
  `ts` tinyint(1) NOT NULL DEFAULT '0',
  `tv` tinyint(1) NOT NULL DEFAULT '1',
  `tsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kyc_data` longtext COLLATE utf8mb4_unicode_ci,
  `kyc_rejection_reason` text COLLATE utf8mb4_unicode_ci,
  `ver_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ver_code_send_at` datetime DEFAULT NULL,
  `ban_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_complete` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publisher_ads`
--

CREATE TABLE `publisher_ads` (
  `id` bigint NOT NULL,
  `publisher_id` int NOT NULL DEFAULT '0',
  `advertiser_id` int NOT NULL DEFAULT '0',
  `advertise_id` int NOT NULL DEFAULT '0',
  `click_count` int NOT NULL DEFAULT '0',
  `impression_count` int NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publisher_password_resets`
--

CREATE TABLE `publisher_password_resets` (
  `id` bigint NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint UNSIGNED NOT NULL,
  `support_message_id` int UNSIGNED NOT NULL DEFAULT '0',
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `support_ticket_id` int UNSIGNED NOT NULL DEFAULT '0',
  `admin_id` int UNSIGNED NOT NULL DEFAULT '0',
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `advertiser_id` int NOT NULL DEFAULT '0',
  `publisher_id` int NOT NULL DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(1) NOT NULL DEFAULT '3' COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `advertiser_id` int UNSIGNED NOT NULL DEFAULT '0',
  `publisher_id` int NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `post_balance` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `trx_type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `remark` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `update_logs`
--

CREATE TABLE `update_logs` (
  `id` bigint NOT NULL,
  `version` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_log` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint UNSIGNED NOT NULL,
  `publisher_id` int NOT NULL DEFAULT '0',
  `advertiser_id` int NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_ip` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint UNSIGNED NOT NULL,
  `method_id` int UNSIGNED NOT NULL DEFAULT '0',
  `publisher_id` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `after_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `withdraw_information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel,  ',
  `admin_feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `form_id` int UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_limit` decimal(28,8) DEFAULT '0.00000000',
  `max_limit` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `fixed_charge` decimal(28,8) DEFAULT '0.00000000',
  `rate` decimal(28,8) DEFAULT '0.00000000',
  `percent_charge` decimal(5,2) DEFAULT NULL,
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisers`
--
ALTER TABLE `advertisers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertiser_password_resets`
--
ALTER TABLE `advertiser_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertises`
--
ALTER TABLE `advertises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_types`
--
ALTER TABLE `ad_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ad_name` (`ad_name`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `analytics`
--
ALTER TABLE `analytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country_code` (`country_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country_code` (`country_code`),
  ADD UNIQUE KEY `country_name` (`country_name`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_tokens`
--
ALTER TABLE `device_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earning_logs`
--
ALTER TABLE `earning_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ip_charts`
--
ALTER TABLE `ip_charts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ip_logs`
--
ALTER TABLE `ip_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `plan_prices`
--
ALTER TABLE `plan_prices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publisher_ads`
--
ALTER TABLE `publisher_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publisher_password_resets`
--
ALTER TABLE `publisher_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `update_logs`
--
ALTER TABLE `update_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advertisers`
--
ALTER TABLE `advertisers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advertiser_password_resets`
--
ALTER TABLE `advertiser_password_resets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advertises`
--
ALTER TABLE `advertises`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ad_types`
--
ALTER TABLE `ad_types`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `analytics`
--
ALTER TABLE `analytics`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `costs`
--
ALTER TABLE `costs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device_tokens`
--
ALTER TABLE `device_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `earning_logs`
--
ALTER TABLE `earning_logs`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ip_charts`
--
ALTER TABLE `ip_charts`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ip_logs`
--
ALTER TABLE `ip_logs`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `plan_prices`
--
ALTER TABLE `plan_prices`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publisher_ads`
--
ALTER TABLE `publisher_ads`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publisher_password_resets`
--
ALTER TABLE `publisher_password_resets`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `update_logs`
--
ALTER TABLE `update_logs`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
