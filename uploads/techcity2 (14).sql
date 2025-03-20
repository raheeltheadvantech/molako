-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2022 at 07:54 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techcity2`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_acl_actions`
--

CREATE TABLE `ci_acl_actions` (
  `acl_action_id` int(10) UNSIGNED NOT NULL,
  `acl_module_id` int(10) NOT NULL,
  `view` int(10) NOT NULL,
  `add` int(10) NOT NULL,
  `edit` int(10) NOT NULL,
  `delete` int(10) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_acl_actions`
--

INSERT INTO `ci_acl_actions` (`acl_action_id`, `acl_module_id`, `view`, `add`, `edit`, `delete`, `enabled`, `date_added`, `date_modified`) VALUES
(1, 1, 1, 1, 1, 1, 1, '2021-10-26 14:17:56', '2021-10-26 14:17:56'),
(2, 2, 1, 1, 1, 1, 1, '2021-10-26 16:31:23', '2021-10-26 16:31:23'),
(3, 3, 1, 1, 1, 1, 1, '2021-10-27 15:57:55', '2021-10-27 15:57:55'),
(4, 4, 1, 1, 1, 1, 1, '2021-10-27 16:03:47', '2021-10-27 16:03:47'),
(5, 5, 1, 1, 1, 1, 1, '2021-11-01 12:05:22', '2021-11-01 12:05:22'),
(6, 6, 1, 1, 1, 1, 1, '2021-11-02 16:25:59', '2021-11-02 16:25:59'),
(7, 7, 1, 1, 1, 1, 1, '2021-11-02 16:25:59', '2021-11-02 16:25:59'),
(8, 8, 1, 1, 1, 1, 1, '2021-11-03 13:03:38', '2021-11-03 13:03:38'),
(9, 9, 1, 1, 1, 1, 1, '2021-11-03 13:50:26', '2021-11-03 13:50:26'),
(10, 10, 1, 1, 1, 1, 1, '2021-11-19 07:36:30', '2021-11-19 07:36:30'),
(11, 11, 1, 1, 1, 1, 1, '2021-11-24 13:40:32', '2021-11-24 13:40:32');

-- --------------------------------------------------------

--
-- Table structure for table `ci_acl_categories`
--

CREATE TABLE `ci_acl_categories` (
  `acl_category_id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `sort` int(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_acl_categories`
--

INSERT INTO `ci_acl_categories` (`acl_category_id`, `slug`, `name`, `enabled`, `sort`, `date_added`, `date_modified`) VALUES
(1, 'users', 'Users', 1, 4, '2021-10-27 15:53:24', '2021-10-27 15:53:24'),
(2, 'customers', 'Customers', 1, 3, '2021-10-27 15:53:24', '2021-10-27 15:53:24'),
(3, 'system', 'System', 1, 8, '2021-10-27 15:53:54', '2021-10-27 15:53:54'),
(4, 'catalog', 'Catalog', 1, 1, '2021-11-01 12:01:49', '2021-11-01 12:01:49'),
(5, 'sales', 'Sales', 1, 2, '2021-11-03 13:01:14', '2021-11-03 13:01:14'),
(6, 'store_managment', 'Store Management', 1, 7, '2021-11-03 13:45:01', '2021-11-03 13:45:01'),
(7, 'extensions', 'Extensions', 1, 5, '2021-12-20 15:44:49', '2021-12-20 15:44:49'),
(8, 'localisation', 'Localisation', 1, 6, '2022-01-14 11:07:51', '2022-01-14 11:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `ci_acl_modules`
--

CREATE TABLE `ci_acl_modules` (
  `acl_module_id` int(10) UNSIGNED NOT NULL,
  `acl_category_id` int(10) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `core_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_acl_modules`
--

INSERT INTO `ci_acl_modules` (`acl_module_id`, `acl_category_id`, `slug`, `core_name`, `name`, `enabled`, `date_added`, `date_modified`) VALUES
(1, 1, 'admin_user', 'Admin_user', 'Admin Users', 1, '2021-10-27 15:54:52', '2021-10-27 15:54:52'),
(2, 1, 'admin_roles', 'Admin_roles', 'Admin Roles', 1, '2021-10-27 15:54:52', '2021-10-27 15:54:52'),
(3, 2, 'admin_customer', 'Admin_customer', 'Customers', 1, '2021-10-27 15:56:50', '2021-10-27 15:56:50'),
(4, 3, 'admin_settings', 'Admin_settings', 'Setting', 1, '2021-10-27 16:02:18', '2021-10-27 16:02:18'),
(5, 4, 'admin_categories', 'Admin_categories', 'Categories', 1, '2021-11-01 12:03:28', '2021-11-01 12:03:28'),
(7, 4, 'admin_products', 'Admin_products', 'Products', 1, '2021-11-02 13:58:05', '2021-11-02 13:58:05'),
(8, 5, 'admin_orders', 'Admin_orders', 'Orders', 1, '2021-11-03 13:02:25', '2021-11-03 13:02:25'),
(9, 6, 'admin_pages', 'Admin_pages', 'Pages', 1, '2021-11-03 13:46:51', '2021-11-03 13:46:51'),
(10, 4, 'admin_brands', 'Admin_brands', 'Brands', 1, '2021-11-19 07:35:14', '2021-11-19 07:35:14'),
(11, 6, 'admin_sliders', 'Admin_sliders', 'Homepage Slider', 1, '2021-11-24 13:39:22', '2021-11-24 13:39:22'),
(12, 7, 'admin_extensions', 'Admin_extensions', 'Extensions', 1, '2021-12-20 15:52:26', '2021-12-20 15:52:26'),
(13, 3, 'admin_contact_us', 'Admin_contact_us', 'Contact Us', 1, '2022-01-06 12:53:53', '2022-01-06 12:53:53'),
(14, 3, 'admin_newsletters', 'Admin_newsletters', 'Newsletters', 1, '2022-01-06 12:53:53', '2022-01-06 12:53:53'),
(16, 8, 'admin_geo_zones', 'Admin_geo_zones', 'Geo Zones', 1, '2022-01-14 11:09:05', '2022-01-14 11:09:05'),
(17, 8, 'admin_tax_rates', 'Admin_tax_rates', 'Tax Rates', 1, '2022-01-14 11:09:05', '2022-01-14 11:09:05'),
(18, 8, 'admin_tax_classes', 'Admin_tax_classes', 'Tax Classes', 1, '2022-01-14 11:11:02', '2022-01-14 11:11:02'),
(19, 6, 'admin_navigations', 'Admin_navigations', 'Navigations', 1, '2022-01-27 07:00:10', '2022-01-27 07:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `ci_address`
--

CREATE TABLE `ci_address` (
  `address_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `company` varchar(40) NOT NULL,
  `address_1` varchar(128) NOT NULL,
  `address_2` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `region_id` int(11) NOT NULL DEFAULT 0,
  `default_address` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_address`
--

INSERT INTO `ci_address` (`address_id`, `customer_id`, `first_name`, `last_name`, `company`, `address_1`, `address_2`, `city`, `postcode`, `country_id`, `region_id`, `default_address`) VALUES
(1, 1, 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 223, 3613, 0),
(2, 1, 'Asad', 'Ahmad', 'adv', 'adv2', '', 'Lahore', '36000', 162, 2461, 0),
(3, 2, 'Alman', 'rashid', 'Advv', 'lhrr', 'lhree', 'Lahore', '36000', 223, 3624, 0),
(4, 1, 'Asad123', 'Ali', 'Advvv3', 'Fsd', 'Fsd2', 'Faisalabad', '360000', 162, 2461, 0),
(5, 1, 'Asss', 'ddd', 'ff', 'fgg', 'gg', 'jhghg', '5400', 38, 602, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_admin_users`
--

CREATE TABLE `ci_admin_users` (
  `admin_user_id` int(10) UNSIGNED NOT NULL,
  `admin_role_id` int(10) NOT NULL,
  `address_id` int(11) NOT NULL DEFAULT 0,
  `culture_code` varchar(128) NOT NULL,
  `calendar_code` varchar(128) NOT NULL,
  `phone_format` varchar(128) NOT NULL DEFAULT '###-###-####',
  `first_name` varchar(32) DEFAULT NULL,
  `middle_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(40) NOT NULL,
  `cell` varchar(32) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `fax` varchar(32) NOT NULL,
  `address_1` varchar(128) NOT NULL,
  `address_2` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `country_code` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `country` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `zone_id` int(11) NOT NULL DEFAULT 0,
  `zone` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `zone_code` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `suspended` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_sa` tinyint(1) NOT NULL DEFAULT 0,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `ip` varchar(40) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_admin_users`
--

INSERT INTO `ci_admin_users` (`admin_user_id`, `admin_role_id`, `address_id`, `culture_code`, `calendar_code`, `phone_format`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `cell`, `phone`, `fax`, `address_1`, `address_2`, `city`, `post_code`, `country_id`, `country_code`, `country`, `zone_id`, `zone`, `zone_code`, `suspended`, `deleted`, `is_sa`, `enabled`, `ip`, `date_added`, `date_modified`) VALUES
(1, 1, 0, 'en-US', '', '', 'Basharat', NULL, 'Ali', 'basharatali5@hotmail.com', '89f7e773d7a8ecd4bc7ce08c486437e91b2e0392', '', '', '', '', '', 'Lahore', '', 162, 'PK', 'Pakistan', 2461, 'P', '', 0, 0, 1, 1, '', '0000-00-00 00:00:00', '2019-04-26 09:29:19'),
(2, 4, 0, 'en-US', '', '', 'Faizan', NULL, 'Rashid', 'faizan@theadvantech.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '', '', '', '', '', '', 16, 'BS', 'Bahamas', 299, 'INA', '', 0, 0, 0, 1, '', '0000-00-00 00:00:00', '2017-12-04 09:10:20'),
(15, 1, 0, '', '', '###-###-####', 'Azeem', NULL, 'Ravi', 'azeem@theadvantech.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '', '', '', '', '', '', 0, '', '', 0, '', '', 0, 0, 0, 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ci_brands`
--

CREATE TABLE `ci_brands` (
  `brand_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `is_enabled` int(11) NOT NULL COMMENT '1= active, 0 = inactive',
  `sort` int(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_brands`
--

INSERT INTO `ci_brands` (`brand_id`, `name`, `description`, `images`, `meta_title`, `meta_description`, `meta_keywords`, `is_enabled`, `sort`, `date_added`, `date_modified`) VALUES
(1, 'HP', NULL, NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '2021-12-31 12:21:41'),
(2, 'Samsung', NULL, NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '2021-12-31 12:36:20'),
(3, 'Apple', NULL, NULL, NULL, NULL, NULL, 1, 0, '0000-00-00 00:00:00', '2021-12-31 12:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `ci_categories`
--

CREATE TABLE `ci_categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `is_enabled` int(1) NOT NULL COMMENT '1= active, 0 = inactive',
  `sort` int(11) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_categories`
--

INSERT INTO `ci_categories` (`category_id`, `name`, `description`, `images`, `meta_title`, `meta_description`, `meta_keywords`, `is_enabled`, `sort`, `parent_id`, `date_added`, `date_modified`) VALUES
(1, 'Computers, Tablets & Accessories', 'Computers, Tablets & Accessories', NULL, 'Computers, Tablets & Accessories', 'Computers, Tablets & Accessories', 'Computers, Tablets & Accessories', 1, 0, 0, '0000-00-00 00:00:00', '2021-12-31 11:48:29'),
(2, 'Brand New Computers', 'Brand New Computers', NULL, 'Brand New Computers', 'Brand New Computers', 'Brand New Computers', 1, 0, 1, '0000-00-00 00:00:00', '2021-12-31 11:49:03'),
(3, 'Computers', 'Computers', NULL, 'Computers', 'Computers', 'Computers', 1, 0, 1, '0000-00-00 00:00:00', '2021-12-31 11:49:35'),
(4, '2-in 1 Laptops', '2-in 1 Laptops', NULL, '2-in 1 Laptops', '2-in 1 Laptops', '2-in 1 Laptops', 1, 0, 3, '0000-00-00 00:00:00', '2021-12-31 11:50:09'),
(5, 'Chromebooks', 'Chromebooks', NULL, 'Chromebooks', 'Chromebooks', 'Chromebooks', 1, 0, 3, '0000-00-00 00:00:00', '2021-12-31 11:50:34'),
(6, 'Desktop Computers', 'Desktop Computers', NULL, 'Desktop Computers', 'Desktop Computers', 'Desktop Computers', 1, 0, 3, '0000-00-00 00:00:00', '2021-12-31 11:50:59'),
(7, 'Gaming Laptops', 'Gaming Laptops', NULL, 'Gaming Laptops', 'Gaming Laptops', 'Gaming Laptops', 1, 0, 3, '0000-00-00 00:00:00', '2021-12-31 11:54:15'),
(8, 'Cell Phones', 'Cell Phones', NULL, 'Cell Phones', 'Cell Phones', 'Cell Phones', 1, 1, 0, '0000-00-00 00:00:00', '2021-12-31 11:51:52'),
(9, 'Accessories', 'Accessories', NULL, 'Accessories', 'Accessories', 'Accessories', 1, 0, 8, '0000-00-00 00:00:00', '2021-12-31 11:52:41'),
(10, 'Cases', 'Cases', NULL, 'Cases', 'Cases', 'Cases', 1, 0, 8, '0000-00-00 00:00:00', '2021-12-31 11:53:34'),
(11, 'Chargers, Cables & batteries', 'Chargers, Cables & batteries', NULL, 'Chargers, Cables & batteries', 'Chargers, Cables & batteries', 'Chargers, Cables & batteries', 1, 0, 8, '0000-00-00 00:00:00', '2021-12-31 11:54:07');

-- --------------------------------------------------------

--
-- Table structure for table `ci_contact_us`
--

CREATE TABLE `ci_contact_us` (
  `contact_us_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cell` varchar(32) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_countries`
--

CREATE TABLE `ci_countries` (
  `country_id` int(11) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(128) NOT NULL,
  `iso2_code` varchar(2) NOT NULL,
  `iso3_code` varchar(3) NOT NULL,
  `address_format` text NOT NULL,
  `postcode_required` tinyint(1) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `sequence` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_countries`
--

INSERT INTO `ci_countries` (`country_id`, `is_default`, `name`, `iso2_code`, `iso3_code`, `address_format`, `postcode_required`, `enabled`, `sequence`) VALUES
(1, 0, 'Afghanistan', 'AF', 'AFG', '', 0, 1, 0),
(2, 0, 'Albania', 'AL', 'ALB', '', 0, 1, 1),
(3, 0, 'Algeria', 'DZ', 'DZA', '', 0, 1, 2),
(4, 0, 'American Samoa', 'AS', 'ASM', '', 0, 1, 3),
(5, 0, 'Andorra', 'AD', 'AND', '', 0, 1, 4),
(6, 0, 'Angola', 'AO', 'AGO', '', 0, 1, 5),
(7, 0, 'Anguilla', 'AI', 'AIA', '', 0, 1, 6),
(8, 0, 'Antarctica', 'AQ', 'ATA', '', 0, 1, 7),
(9, 0, 'Antigua and Barbuda', 'AG', 'ATG', '', 0, 1, 8),
(10, 0, 'Argentina', 'AR', 'ARG', '', 0, 1, 9),
(11, 0, 'Armenia', 'AM', 'ARM', '', 0, 1, 10),
(12, 0, 'Aruba', 'AW', 'ABW', '', 0, 1, 11),
(13, 0, 'Australia', 'AU', 'AUS', '', 0, 1, 12),
(14, 0, 'Austria', 'AT', 'AUT', '', 0, 1, 13),
(15, 0, 'Azerbaijan', 'AZ', 'AZE', '', 0, 1, 14),
(16, 0, 'Bahamas', 'BS', 'BHS', '', 0, 1, 15),
(17, 0, 'Bahrain', 'BH', 'BHR', '', 0, 1, 16),
(18, 0, 'Bangladesh', 'BD', 'BGD', '', 0, 1, 17),
(19, 0, 'Barbados', 'BB', 'BRB', '', 0, 1, 18),
(20, 0, 'Belarus', 'BY', 'BLR', '', 0, 1, 19),
(21, 0, 'Belgium', 'BE', 'BEL', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 0, 1, 20),
(22, 0, 'Belize', 'BZ', 'BLZ', '', 0, 1, 21),
(23, 0, 'Benin', 'BJ', 'BEN', '', 0, 1, 22),
(24, 0, 'Bermuda', 'BM', 'BMU', '', 0, 1, 23),
(25, 0, 'Bhutan', 'BT', 'BTN', '', 0, 1, 24),
(26, 0, 'Bolivia', 'BO', 'BOL', '', 0, 1, 25),
(27, 0, 'Bosnia and Herzegovina', 'BA', 'BIH', '', 0, 1, 26),
(28, 0, 'Botswana', 'BW', 'BWA', '', 0, 1, 27),
(29, 0, 'Bouvet Island', 'BV', 'BVT', '', 0, 1, 28),
(30, 0, 'Brazil', 'BR', 'BRA', '', 0, 1, 29),
(31, 0, 'British Indian Ocean Territory', 'IO', 'IOT', '', 0, 1, 30),
(32, 0, 'Brunei Darussalam', 'BN', 'BRN', '', 0, 1, 31),
(33, 0, 'Bulgaria', 'BG', 'BGR', '', 0, 1, 32),
(34, 0, 'Burkina Faso', 'BF', 'BFA', '', 0, 1, 33),
(35, 0, 'Burundi', 'BI', 'BDI', '', 0, 1, 34),
(36, 0, 'Cambodia', 'KH', 'KHM', '', 0, 1, 35),
(37, 0, 'Cameroon', 'CM', 'CMR', '', 0, 1, 36),
(38, 1, 'Canada', 'CA', 'CAN', '', 0, 1, 37),
(39, 0, 'Cape Verde', 'CV', 'CPV', '', 0, 1, 38),
(40, 0, 'Cayman Islands', 'KY', 'CYM', '', 0, 1, 39),
(41, 0, 'Central African Republic', 'CF', 'CAF', '', 0, 1, 40),
(42, 0, 'Chad', 'TD', 'TCD', '', 0, 1, 41),
(43, 0, 'Chile', 'CL', 'CHL', '', 0, 1, 42),
(44, 0, 'China', 'CN', 'CHN', '', 0, 1, 43),
(45, 0, 'Christmas Island', 'CX', 'CXR', '', 0, 1, 44),
(46, 0, 'Cocos (Keeling) Islands', 'CC', 'CCK', '', 0, 1, 45),
(47, 0, 'Colombia', 'CO', 'COL', '', 0, 1, 46),
(48, 0, 'Comoros', 'KM', 'COM', '', 0, 1, 47),
(49, 0, 'Congo', 'CG', 'COG', '', 0, 1, 48),
(50, 0, 'Cook Islands', 'CK', 'COK', '', 0, 1, 49),
(51, 0, 'Costa Rica', 'CR', 'CRI', '', 0, 1, 50),
(52, 0, 'Cote D\'Ivoire', 'CI', 'CIV', '', 0, 1, 51),
(53, 0, 'Croatia', 'HR', 'HRV', '', 0, 1, 52),
(54, 0, 'Cuba', 'CU', 'CUB', '', 0, 1, 53),
(55, 0, 'Cyprus', 'CY', 'CYP', '', 0, 1, 54),
(56, 0, 'Czech Republic', 'CZ', 'CZE', '', 0, 1, 55),
(57, 0, 'Denmark', 'DK', 'DNK', '', 0, 1, 56),
(58, 0, 'Djibouti', 'DJ', 'DJI', '', 0, 1, 57),
(59, 0, 'Dominica', 'DM', 'DMA', '', 0, 1, 58),
(60, 0, 'Dominican Republic', 'DO', 'DOM', '', 0, 1, 59),
(61, 0, 'East Timor', 'TL', 'TLS', '', 0, 1, 60),
(62, 0, 'Ecuador', 'EC', 'ECU', '', 0, 1, 61),
(63, 0, 'Egypt', 'EG', 'EGY', '', 0, 1, 62),
(64, 0, 'El Salvador', 'SV', 'SLV', '', 0, 1, 63),
(65, 0, 'Equatorial Guinea', 'GQ', 'GNQ', '', 0, 1, 64),
(66, 0, 'Eritrea', 'ER', 'ERI', '', 0, 1, 65),
(67, 0, 'Estonia', 'EE', 'EST', '', 0, 1, 66),
(68, 0, 'Ethiopia', 'ET', 'ETH', '', 0, 1, 67),
(69, 0, 'Falkland Islands (Malvinas)', 'FK', 'FLK', '', 0, 1, 68),
(70, 0, 'Faroe Islands', 'FO', 'FRO', '', 0, 1, 69),
(71, 0, 'Fiji', 'FJ', 'FJI', '', 0, 1, 70),
(72, 0, 'Finland', 'FI', 'FIN', '', 0, 1, 71),
(74, 0, 'France, Metropolitan', 'FR', 'FRA', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 1, 72),
(75, 0, 'French Guiana', 'GF', 'GUF', '', 0, 1, 73),
(76, 0, 'French Polynesia', 'PF', 'PYF', '', 0, 1, 74),
(77, 0, 'French Southern Territories', 'TF', 'ATF', '', 0, 1, 75),
(78, 0, 'Gabon', 'GA', 'GAB', '', 0, 1, 76),
(79, 0, 'Gambia', 'GM', 'GMB', '', 0, 1, 77),
(80, 0, 'Georgia', 'GE', 'GEO', '', 0, 1, 78),
(81, 0, 'Germany', 'DE', 'DEU', '{company}\r\n{firstname} {lastname}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 1, 79),
(82, 0, 'Ghana', 'GH', 'GHA', '', 0, 1, 80),
(83, 0, 'Gibraltar', 'GI', 'GIB', '', 0, 1, 81),
(84, 0, 'Greece', 'GR', 'GRC', '', 0, 1, 82),
(85, 0, 'Greenland', 'GL', 'GRL', '', 0, 1, 83),
(86, 0, 'Grenada', 'GD', 'GRD', '', 0, 1, 84),
(87, 0, 'Guadeloupe', 'GP', 'GLP', '', 0, 1, 85),
(88, 0, 'Guam', 'GU', 'GUM', '', 0, 1, 86),
(89, 0, 'Guatemala', 'GT', 'GTM', '', 0, 1, 87),
(90, 0, 'Guinea', 'GN', 'GIN', '', 0, 1, 88),
(91, 0, 'Guinea-Bissau', 'GW', 'GNB', '', 0, 1, 89),
(92, 0, 'Guyana', 'GY', 'GUY', '', 0, 1, 90),
(93, 0, 'Haiti', 'HT', 'HTI', '', 0, 1, 91),
(94, 0, 'Heard and Mc Donald Islands', 'HM', 'HMD', '', 0, 1, 92),
(95, 0, 'Honduras', 'HN', 'HND', '', 0, 1, 93),
(96, 0, 'Hong Kong', 'HK', 'HKG', '', 0, 1, 94),
(97, 0, 'Hungary', 'HU', 'HUN', '', 0, 1, 95),
(98, 0, 'Iceland', 'IS', 'ISL', '', 0, 1, 96),
(99, 0, 'India', 'IN', 'IND', '', 0, 1, 97),
(100, 0, 'Indonesia', 'ID', 'IDN', '', 0, 1, 98),
(101, 0, 'Iran (Islamic Republic of)', 'IR', 'IRN', '', 0, 1, 99),
(102, 0, 'Iraq', 'IQ', 'IRQ', '', 0, 1, 100),
(103, 0, 'Ireland', 'IE', 'IRL', '', 0, 1, 101),
(104, 0, 'Israel', 'IL', 'ISR', '', 0, 1, 102),
(105, 0, 'Italy', 'IT', 'ITA', '', 0, 1, 103),
(106, 0, 'Jamaica', 'JM', 'JAM', '', 0, 1, 104),
(107, 0, 'Japan', 'JP', 'JPN', '', 0, 1, 105),
(108, 0, 'Jordan', 'JO', 'JOR', '', 0, 1, 106),
(109, 0, 'Kazakhstan', 'KZ', 'KAZ', '', 0, 1, 107),
(110, 0, 'Kenya', 'KE', 'KEN', '', 0, 1, 108),
(111, 0, 'Kiribati', 'KI', 'KIR', '', 0, 1, 109),
(112, 0, 'North Korea', 'KP', 'PRK', '', 0, 1, 110),
(113, 0, 'South Korea', 'KR', 'KOR', '', 0, 1, 111),
(114, 0, 'Kuwait', 'KW', 'KWT', '', 0, 1, 112),
(115, 0, 'Kyrgyzstan', 'KG', 'KGZ', '', 0, 1, 113),
(116, 0, 'Lao People\'s Democratic Republic', 'LA', 'LAO', '', 0, 1, 114),
(117, 0, 'Latvia', 'LV', 'LVA', '', 0, 1, 115),
(118, 0, 'Lebanon', 'LB', 'LBN', '', 0, 1, 116),
(119, 0, 'Lesotho', 'LS', 'LSO', '', 0, 1, 117),
(120, 0, 'Liberia', 'LR', 'LBR', '', 0, 1, 118),
(121, 0, 'Libyan Arab Jamahiriya', 'LY', 'LBY', '', 0, 1, 119),
(122, 0, 'Liechtenstein', 'LI', 'LIE', '', 0, 1, 120),
(123, 0, 'Lithuania', 'LT', 'LTU', '', 0, 1, 121),
(124, 0, 'Luxembourg', 'LU', 'LUX', '', 0, 1, 122),
(125, 0, 'Macau', 'MO', 'MAC', '', 0, 1, 123),
(126, 0, 'FYROM', 'MK', 'MKD', '', 0, 1, 124),
(127, 0, 'Madagascar', 'MG', 'MDG', '', 0, 1, 125),
(128, 0, 'Malawi', 'MW', 'MWI', '', 0, 1, 126),
(129, 0, 'Malaysia', 'MY', 'MYS', '', 0, 1, 127),
(130, 0, 'Maldives', 'MV', 'MDV', '', 0, 1, 127),
(131, 0, 'Mali', 'ML', 'MLI', '', 0, 1, 127),
(132, 0, 'Malta', 'MT', 'MLT', '', 0, 1, 127),
(133, 0, 'Marshall Islands', 'MH', 'MHL', '', 0, 1, 127),
(134, 0, 'Martinique', 'MQ', 'MTQ', '', 0, 1, 127),
(135, 0, 'Mauritania', 'MR', 'MRT', '', 0, 1, 127),
(136, 0, 'Mauritius', 'MU', 'MUS', '', 0, 1, 127),
(137, 0, 'Mayotte', 'YT', 'MYT', '', 0, 1, 127),
(138, 0, 'Mexico', 'MX', 'MEX', '', 0, 1, 127),
(139, 0, 'Micronesia, Federated States of', 'FM', 'FSM', '', 0, 1, 127),
(140, 0, 'Moldova, Republic of', 'MD', 'MDA', '', 0, 1, 127),
(141, 0, 'Monaco', 'MC', 'MCO', '', 0, 1, 127),
(142, 0, 'Mongolia', 'MN', 'MNG', '', 0, 1, 127),
(143, 0, 'Montserrat', 'MS', 'MSR', '', 0, 1, 127),
(144, 0, 'Morocco', 'MA', 'MAR', '', 0, 1, 127),
(145, 0, 'Mozambique', 'MZ', 'MOZ', '', 0, 1, 127),
(146, 0, 'Myanmar', 'MM', 'MMR', '', 0, 1, 127),
(147, 0, 'Namibia', 'NA', 'NAM', '', 0, 1, 127),
(148, 0, 'Nauru', 'NR', 'NRU', '', 0, 1, 127),
(149, 0, 'Nepal', 'NP', 'NPL', '', 0, 1, 127),
(150, 0, 'Netherlands', 'NL', 'NLD', '', 0, 1, 127),
(151, 0, 'Netherlands Antilles', 'AN', 'ANT', '', 0, 1, 127),
(152, 0, 'New Caledonia', 'NC', 'NCL', '', 0, 1, 127),
(153, 0, 'New Zealand', 'NZ', 'NZL', '', 0, 1, 127),
(154, 0, 'Nicaragua', 'NI', 'NIC', '', 0, 1, 127),
(155, 0, 'Niger', 'NE', 'NER', '', 0, 1, 127),
(156, 0, 'Nigeria', 'NG', 'NGA', '', 0, 1, 127),
(157, 0, 'Niue', 'NU', 'NIU', '', 0, 1, 127),
(158, 0, 'Norfolk Island', 'NF', 'NFK', '', 0, 1, 127),
(159, 0, 'Northern Mariana Islands', 'MP', 'MNP', '', 0, 1, 127),
(160, 0, 'Norway', 'NO', 'NOR', '', 0, 1, 127),
(161, 0, 'Oman', 'OM', 'OMN', '', 0, 1, 127),
(162, 0, 'Pakistan', 'PK', 'PAK', '', 0, 1, 127),
(163, 0, 'Palau', 'PW', 'PLW', '', 0, 1, 127),
(164, 0, 'Panama', 'PA', 'PAN', '', 0, 1, 127),
(165, 0, 'Papua New Guinea', 'PG', 'PNG', '', 0, 1, 127),
(166, 0, 'Paraguay', 'PY', 'PRY', '', 0, 1, 127),
(167, 0, 'Peru', 'PE', 'PER', '', 0, 1, 127),
(168, 0, 'Philippines', 'PH', 'PHL', '', 0, 1, 127),
(169, 0, 'Pitcairn', 'PN', 'PCN', '', 0, 1, 127),
(170, 0, 'Poland', 'PL', 'POL', '', 0, 1, 127),
(171, 0, 'Portugal', 'PT', 'PRT', '', 0, 1, 127),
(172, 0, 'Puerto Rico', 'PR', 'PRI', '', 0, 1, 127),
(173, 0, 'Qatar', 'QA', 'QAT', '', 0, 1, 127),
(174, 0, 'Reunion', 'RE', 'REU', '', 0, 1, 127),
(175, 0, 'Romania', 'RO', 'ROM', '', 0, 1, 127),
(176, 0, 'Russian Federation', 'RU', 'RUS', '', 0, 1, 127),
(177, 0, 'Rwanda', 'RW', 'RWA', '', 0, 1, 127),
(178, 0, 'Saint Kitts and Nevis', 'KN', 'KNA', '', 0, 1, 127),
(179, 0, 'Saint Lucia', 'LC', 'LCA', '', 0, 1, 127),
(180, 0, 'Saint Vincent and the Grenadines', 'VC', 'VCT', '', 0, 1, 127),
(181, 0, 'Samoa', 'WS', 'WSM', '', 0, 1, 127),
(182, 0, 'San Marino', 'SM', 'SMR', '', 0, 1, 127),
(183, 0, 'Sao Tome and Principe', 'ST', 'STP', '', 0, 1, 127),
(184, 0, 'Saudi Arabia', 'SA', 'SAU', '', 0, 1, 127),
(185, 0, 'Senegal', 'SN', 'SEN', '', 0, 1, 127),
(186, 0, 'Seychelles', 'SC', 'SYC', '', 0, 1, 127),
(187, 0, 'Sierra Leone', 'SL', 'SLE', '', 0, 1, 127),
(188, 0, 'Singapore', 'SG', 'SGP', '', 0, 1, 127),
(189, 0, 'Slovak Republic', 'SK', 'SVK', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city} {postcode}\r\n{zone}\r\n{country}', 0, 1, 127),
(190, 0, 'Slovenia', 'SI', 'SVN', '', 0, 1, 127),
(191, 0, 'Solomon Islands', 'SB', 'SLB', '', 0, 1, 127),
(192, 0, 'Somalia', 'SO', 'SOM', '', 0, 1, 127),
(193, 0, 'South Africa', 'ZA', 'ZAF', '', 0, 1, 127),
(194, 0, 'South Georgia &amp; South Sandwich Islands', 'GS', 'SGS', '', 0, 1, 127),
(195, 0, 'Spain', 'ES', 'ESP', '', 0, 1, 127),
(196, 0, 'Sri Lanka', 'LK', 'LKA', '', 0, 1, 127),
(197, 0, 'St. Helena', 'SH', 'SHN', '', 0, 1, 127),
(198, 0, 'St. Pierre and Miquelon', 'PM', 'SPM', '', 0, 1, 127),
(199, 0, 'Sudan', 'SD', 'SDN', '', 0, 1, 127),
(200, 0, 'Suriname', 'SR', 'SUR', '', 0, 1, 127),
(201, 0, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', '', 0, 1, 127),
(202, 0, 'Swaziland', 'SZ', 'SWZ', '', 0, 1, 127),
(203, 0, 'Sweden', 'SE', 'SWE', '{company}\r\n{firstname} {lastname}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 1, 127),
(204, 0, 'Switzerland', 'CH', 'CHE', '', 0, 1, 127),
(205, 0, 'Syrian Arab Republic', 'SY', 'SYR', '', 0, 1, 127),
(206, 0, 'Taiwan', 'TW', 'TWN', '', 0, 1, 127),
(207, 0, 'Tajikistan', 'TJ', 'TJK', '', 0, 1, 127),
(208, 0, 'Tanzania, United Republic of', 'TZ', 'TZA', '', 0, 1, 127),
(209, 0, 'Thailand', 'TH', 'THA', '', 0, 1, 127),
(210, 0, 'Togo', 'TG', 'TGO', '', 0, 1, 127),
(211, 0, 'Tokelau', 'TK', 'TKL', '', 0, 1, 127),
(212, 0, 'Tonga', 'TO', 'TON', '', 0, 1, 127),
(213, 0, 'Trinidad and Tobago', 'TT', 'TTO', '', 0, 1, 127),
(214, 0, 'Tunisia', 'TN', 'TUN', '', 0, 1, 127),
(215, 0, 'Turkey', 'TR', 'TUR', '', 0, 1, 127),
(216, 0, 'Turkmenistan', 'TM', 'TKM', '', 0, 1, 127),
(217, 0, 'Turks and Caicos Islands', 'TC', 'TCA', '', 0, 1, 127),
(218, 0, 'Tuvalu', 'TV', 'TUV', '', 0, 1, 127),
(219, 0, 'Uganda', 'UG', 'UGA', '', 0, 1, 127),
(220, 0, 'Ukraine', 'UA', 'UKR', '', 0, 1, 127),
(221, 0, 'United Arab Emirates', 'AE', 'ARE', '', 0, 1, 127),
(222, 0, 'United Kingdom', 'GB', 'GBR', '', 1, 1, 127),
(223, 0, 'United States', 'US', 'USA', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city}, {zone} {postcode}\r\n{country}', 0, 1, 127),
(224, 0, 'United States Minor Outlying Islands', 'UM', 'UMI', '', 0, 1, 127),
(225, 0, 'Uruguay', 'UY', 'URY', '', 0, 1, 127),
(226, 0, 'Uzbekistan', 'UZ', 'UZB', '', 0, 1, 127),
(227, 0, 'Vanuatu', 'VU', 'VUT', '', 0, 1, 127),
(228, 0, 'Vatican City State (Holy See)', 'VA', 'VAT', '', 0, 1, 127),
(229, 0, 'Venezuela', 'VE', 'VEN', '', 0, 1, 127),
(230, 0, 'Viet Nam', 'VN', 'VNM', '', 0, 1, 127),
(231, 0, 'Virgin Islands (British)', 'VG', 'VGB', '', 0, 1, 127),
(232, 0, 'Virgin Islands (U.S.)', 'VI', 'VIR', '', 0, 1, 127),
(233, 0, 'Wallis and Futuna Islands', 'WF', 'WLF', '', 0, 1, 127),
(234, 0, 'Western Sahara', 'EH', 'ESH', '', 0, 1, 127),
(235, 0, 'Yemen', 'YE', 'YEM', '', 0, 1, 127),
(237, 0, 'Democratic Republic of Congo', 'CD', 'COD', '', 0, 1, 127),
(238, 0, 'Zambia', 'ZM', 'ZMB', '', 0, 1, 127),
(239, 0, 'Zimbabwe', 'ZW', 'ZWE', '', 0, 1, 127),
(242, 0, 'Montenegro', 'ME', 'MNE', '', 0, 1, 127),
(243, 0, 'Serbia', 'RS', 'SRB', '', 0, 1, 127),
(244, 0, 'Aaland Islands', 'AX', 'ALA', '', 0, 1, 127),
(245, 0, 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BES', '', 0, 1, 127),
(246, 0, 'Curacao', 'CW', 'CUW', '', 0, 1, 127),
(247, 0, 'Palestinian Territory, Occupied', 'PS', 'PSE', '', 0, 1, 127),
(248, 0, 'South Sudan', 'SS', 'SSD', '', 0, 1, 127),
(249, 0, 'St. Barthelemy', 'BL', 'BLM', '', 0, 1, 127),
(250, 0, 'St. Martin (French part)', 'MF', 'MAF', '', 0, 1, 127),
(251, 0, 'Canary Islands', 'IC', 'ICA', '', 0, 1, 127),
(252, 0, 'Ascension Island (British)', 'AC', 'ASC', '', 0, 1, 127),
(253, 0, 'Kosovo, Republic of', 'XK', 'UNK', '', 0, 1, 127),
(254, 0, 'Isle of Man', 'IM', 'IMN', '', 0, 1, 127),
(255, 0, 'Tristan da Cunha', 'TA', 'SHN', '', 0, 1, 127),
(256, 0, 'Guernsey', 'GG', 'GGY', '', 0, 1, 127),
(257, 0, 'Jersey', 'JE', 'JEY', '', 0, 1, 127);

-- --------------------------------------------------------

--
-- Table structure for table `ci_country_names`
--

CREATE TABLE `ci_country_names` (
  `country_name_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `culture_code` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_country_zones`
--

CREATE TABLE `ci_country_zones` (
  `zone_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` varchar(32) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_country_zones`
--

INSERT INTO `ci_country_zones` (`zone_id`, `country_id`, `name`, `code`, `enabled`) VALUES
(1, 1, 'Badakhshan', 'BDS', 1),
(2, 1, 'Badghis', 'BDG', 1),
(3, 1, 'Baghlan', 'BGL', 1),
(4, 1, 'Balkh', 'BAL', 1),
(5, 1, 'Bamian', 'BAM', 1),
(6, 1, 'Farah', 'FRA', 1),
(7, 1, 'Faryab', 'FYB', 1),
(8, 1, 'Ghazni', 'GHA', 1),
(9, 1, 'Ghowr', 'GHO', 1),
(10, 1, 'Helmand', 'HEL', 1),
(11, 1, 'Herat', 'HER', 1),
(12, 1, 'Jowzjan', 'JOW', 1),
(13, 1, 'Kabul', 'KAB', 1),
(14, 1, 'Kandahar', 'KAN', 1),
(15, 1, 'Kapisa', 'KAP', 1),
(16, 1, 'Khost', 'KHO', 1),
(17, 1, 'Konar', 'KNR', 1),
(18, 1, 'Kondoz', 'KDZ', 1),
(19, 1, 'Laghman', 'LAG', 1),
(20, 1, 'Lowgar', 'LOW', 1),
(21, 1, 'Nangrahar', 'NAN', 1),
(22, 1, 'Nimruz', 'NIM', 1),
(23, 1, 'Nurestan', 'NUR', 1),
(24, 1, 'Oruzgan', 'ORU', 1),
(25, 1, 'Paktia', 'PIA', 1),
(26, 1, 'Paktika', 'PKA', 1),
(27, 1, 'Parwan', 'PAR', 1),
(28, 1, 'Samangan', 'SAM', 1),
(29, 1, 'Sar-e Pol', 'SAR', 1),
(30, 1, 'Takhar', 'TAK', 1),
(31, 1, 'Wardak', 'WAR', 1),
(32, 1, 'Zabol', 'ZAB', 1),
(33, 2, 'Berat', 'BR', 1),
(34, 2, 'Bulqize', 'BU', 1),
(35, 2, 'Delvine', 'DL', 1),
(36, 2, 'Devoll', 'DV', 1),
(37, 2, 'Diber', 'DI', 1),
(38, 2, 'Durres', 'DR', 1),
(39, 2, 'Elbasan', 'EL', 1),
(40, 2, 'Kolonje', 'ER', 1),
(41, 2, 'Fier', 'FR', 1),
(42, 2, 'Gjirokaster', 'GJ', 1),
(43, 2, 'Gramsh', 'GR', 1),
(44, 2, 'Has', 'HA', 1),
(45, 2, 'Kavaje', 'KA', 1),
(46, 2, 'Kurbin', 'KB', 1),
(47, 2, 'Kucove', 'KC', 1),
(48, 2, 'Korce', 'KO', 1),
(49, 2, 'Kruje', 'KR', 1),
(50, 2, 'Kukes', 'KU', 1),
(51, 2, 'Librazhd', 'LB', 1),
(52, 2, 'Lezhe', 'LE', 1),
(53, 2, 'Lushnje', 'LU', 1),
(54, 2, 'Malesi e Madhe', 'MM', 1),
(55, 2, 'Mallakaster', 'MK', 1),
(56, 2, 'Mat', 'MT', 1),
(57, 2, 'Mirdite', 'MR', 1),
(58, 2, 'Peqin', 'PQ', 1),
(59, 2, 'Permet', 'PR', 1),
(60, 2, 'Pogradec', 'PG', 1),
(61, 2, 'Puke', 'PU', 1),
(62, 2, 'Shkoder', 'SH', 1),
(63, 2, 'Skrapar', 'SK', 1),
(64, 2, 'Sarande', 'SR', 1),
(65, 2, 'Tepelene', 'TE', 1),
(66, 2, 'Tropoje', 'TP', 1),
(67, 2, 'Tirane', 'TR', 1),
(68, 2, 'Vlore', 'VL', 1),
(69, 3, 'Adrar', 'ADR', 1),
(70, 3, 'Ain Defla', 'ADE', 1),
(71, 3, 'Ain Temouchent', 'ATE', 1),
(72, 3, 'Alger', 'ALG', 1),
(73, 3, 'Annaba', 'ANN', 1),
(74, 3, 'Batna', 'BAT', 1),
(75, 3, 'Bechar', 'BEC', 1),
(76, 3, 'Bejaia', 'BEJ', 1),
(77, 3, 'Biskra', 'BIS', 1),
(78, 3, 'Blida', 'BLI', 1),
(79, 3, 'Bordj Bou Arreridj', 'BBA', 1),
(80, 3, 'Bouira', 'BOA', 1),
(81, 3, 'Boumerdes', 'BMD', 1),
(82, 3, 'Chlef', 'CHL', 1),
(83, 3, 'Constantine', 'CON', 1),
(84, 3, 'Djelfa', 'DJE', 1),
(85, 3, 'El Bayadh', 'EBA', 1),
(86, 3, 'El Oued', 'EOU', 1),
(87, 3, 'El Tarf', 'ETA', 1),
(88, 3, 'Ghardaia', 'GHA', 1),
(89, 3, 'Guelma', 'GUE', 1),
(90, 3, 'Illizi', 'ILL', 1),
(91, 3, 'Jijel', 'JIJ', 1),
(92, 3, 'Khenchela', 'KHE', 1),
(93, 3, 'Laghouat', 'LAG', 1),
(94, 3, 'Muaskar', 'MUA', 1),
(95, 3, 'Medea', 'MED', 1),
(96, 3, 'Mila', 'MIL', 1),
(97, 3, 'Mostaganem', 'MOS', 1),
(98, 3, 'M\'Sila', 'MSI', 1),
(99, 3, 'Naama', 'NAA', 1),
(100, 3, 'Oran', 'ORA', 1),
(101, 3, 'Ouargla', 'OUA', 1),
(102, 3, 'Oum el-Bouaghi', 'OEB', 1),
(103, 3, 'Relizane', 'REL', 1),
(104, 3, 'Saida', 'SAI', 1),
(105, 3, 'Setif', 'SET', 1),
(106, 3, 'Sidi Bel Abbes', 'SBA', 1),
(107, 3, 'Skikda', 'SKI', 1),
(108, 3, 'Souk Ahras', 'SAH', 1),
(109, 3, 'Tamanghasset', 'TAM', 1),
(110, 3, 'Tebessa', 'TEB', 1),
(111, 3, 'Tiaret', 'TIA', 1),
(112, 3, 'Tindouf', 'TIN', 1),
(113, 3, 'Tipaza', 'TIP', 1),
(114, 3, 'Tissemsilt', 'TIS', 1),
(115, 3, 'Tizi Ouzou', 'TOU', 1),
(116, 3, 'Tlemcen', 'TLE', 1),
(117, 4, 'Eastern', 'E', 1),
(118, 4, 'Manu\'a', 'M', 1),
(119, 4, 'Rose Island', 'R', 1),
(120, 4, 'Swains Island', 'S', 1),
(121, 4, 'Western', 'W', 1),
(122, 5, 'Andorra la Vella', 'ALV', 1),
(123, 5, 'Canillo', 'CAN', 1),
(124, 5, 'Encamp', 'ENC', 1),
(125, 5, 'Escaldes-Engordany', 'ESE', 1),
(126, 5, 'La Massana', 'LMA', 1),
(127, 5, 'Ordino', 'ORD', 1),
(128, 5, 'Sant Julia de Loria', 'SJL', 1),
(129, 6, 'Bengo', 'BGO', 1),
(130, 6, 'Benguela', 'BGU', 1),
(131, 6, 'Bie', 'BIE', 1),
(132, 6, 'Cabinda', 'CAB', 1),
(133, 6, 'Cuando-Cubango', 'CCU', 1),
(134, 6, 'Cuanza Norte', 'CNO', 1),
(135, 6, 'Cuanza Sul', 'CUS', 1),
(136, 6, 'Cunene', 'CNN', 1),
(137, 6, 'Huambo', 'HUA', 1),
(138, 6, 'Huila', 'HUI', 1),
(139, 6, 'Luanda', 'LUA', 1),
(140, 6, 'Lunda Norte', 'LNO', 1),
(141, 6, 'Lunda Sul', 'LSU', 1),
(142, 6, 'Malange', 'MAL', 1),
(143, 6, 'Moxico', 'MOX', 1),
(144, 6, 'Namibe', 'NAM', 1),
(145, 6, 'Uige', 'UIG', 1),
(146, 6, 'Zaire', 'ZAI', 1),
(147, 9, 'Saint George', 'ASG', 1),
(148, 9, 'Saint John', 'ASJ', 1),
(149, 9, 'Saint Mary', 'ASM', 1),
(150, 9, 'Saint Paul', 'ASL', 1),
(151, 9, 'Saint Peter', 'ASR', 1),
(152, 9, 'Saint Philip', 'ASH', 1),
(153, 9, 'Barbuda', 'BAR', 1),
(154, 9, 'Redonda', 'RED', 1),
(155, 10, 'Antartida e Islas del Atlantico', 'AN', 1),
(156, 10, 'Buenos Aires', 'BA', 1),
(157, 10, 'Catamarca', 'CA', 1),
(158, 10, 'Chaco', 'CH', 1),
(159, 10, 'Chubut', 'CU', 1),
(160, 10, 'Cordoba', 'CO', 1),
(161, 10, 'Corrientes', 'CR', 1),
(162, 10, 'Distrito Federal', 'DF', 1),
(163, 10, 'Entre Rios', 'ER', 1),
(164, 10, 'Formosa', 'FO', 1),
(165, 10, 'Jujuy', 'JU', 1),
(166, 10, 'La Pampa', 'LP', 1),
(167, 10, 'La Rioja', 'LR', 1),
(168, 10, 'Mendoza', 'ME', 1),
(169, 10, 'Misiones', 'MI', 1),
(170, 10, 'Neuquen', 'NE', 1),
(171, 10, 'Rio Negro', 'RN', 1),
(172, 10, 'Salta', 'SA', 1),
(173, 10, 'San Juan', 'SJ', 1),
(174, 10, 'San Luis', 'SL', 1),
(175, 10, 'Santa Cruz', 'SC', 1),
(176, 10, 'Santa Fe', 'SF', 1),
(177, 10, 'Santiago del Estero', 'SD', 1),
(178, 10, 'Tierra del Fuego', 'TF', 1),
(179, 10, 'Tucuman', 'TU', 1),
(180, 11, 'Aragatsotn', 'AGT', 1),
(181, 11, 'Ararat', 'ARR', 1),
(182, 11, 'Armavir', 'ARM', 1),
(183, 11, 'Geghark\'unik\'', 'GEG', 1),
(184, 11, 'Kotayk\'', 'KOT', 1),
(185, 11, 'Lorri', 'LOR', 1),
(186, 11, 'Shirak', 'SHI', 1),
(187, 11, 'Syunik\'', 'SYU', 1),
(188, 11, 'Tavush', 'TAV', 1),
(189, 11, 'Vayots\' Dzor', 'VAY', 1),
(190, 11, 'Yerevan', 'YER', 1),
(191, 13, 'Australian Capital Territory', 'ACT', 1),
(192, 13, 'New South Wales', 'NSW', 1),
(193, 13, 'Northern Territory', 'NT', 1),
(194, 13, 'Queensland', 'QLD', 1),
(195, 13, 'South Australia', 'SA', 1),
(196, 13, 'Tasmania', 'TAS', 1),
(197, 13, 'Victoria', 'VIC', 1),
(198, 13, 'Western Australia', 'WA', 1),
(199, 14, 'Burgenland', 'BUR', 1),
(200, 14, 'Kärnten', 'KAR', 1),
(201, 14, 'Niederösterreich', 'NOS', 1),
(202, 14, 'Oberösterreich', 'OOS', 1),
(203, 14, 'Salzburg', 'SAL', 1),
(204, 14, 'Steiermark', 'STE', 1),
(205, 14, 'Tirol', 'TIR', 1),
(206, 14, 'Vorarlberg', 'VOR', 1),
(207, 14, 'Wien', 'WIE', 1),
(208, 15, 'Ali Bayramli', 'AB', 1),
(209, 15, 'Abseron', 'ABS', 1),
(210, 15, 'AgcabAdi', 'AGC', 1),
(211, 15, 'Agdam', 'AGM', 1),
(212, 15, 'Agdas', 'AGS', 1),
(213, 15, 'Agstafa', 'AGA', 1),
(214, 15, 'Agsu', 'AGU', 1),
(215, 15, 'Astara', 'AST', 1),
(216, 15, 'Baki', 'BA', 1),
(217, 15, 'BabAk', 'BAB', 1),
(218, 15, 'BalakAn', 'BAL', 1),
(219, 15, 'BArdA', 'BAR', 1),
(220, 15, 'Beylaqan', 'BEY', 1),
(221, 15, 'Bilasuvar', 'BIL', 1),
(222, 15, 'Cabrayil', 'CAB', 1),
(223, 15, 'Calilabab', 'CAL', 1),
(224, 15, 'Culfa', 'CUL', 1),
(225, 15, 'Daskasan', 'DAS', 1),
(226, 15, 'Davaci', 'DAV', 1),
(227, 15, 'Fuzuli', 'FUZ', 1),
(228, 15, 'Ganca', 'GA', 1),
(229, 15, 'Gadabay', 'GAD', 1),
(230, 15, 'Goranboy', 'GOR', 1),
(231, 15, 'Goycay', 'GOY', 1),
(232, 15, 'Haciqabul', 'HAC', 1),
(233, 15, 'Imisli', 'IMI', 1),
(234, 15, 'Ismayilli', 'ISM', 1),
(235, 15, 'Kalbacar', 'KAL', 1),
(236, 15, 'Kurdamir', 'KUR', 1),
(237, 15, 'Lankaran', 'LA', 1),
(238, 15, 'Lacin', 'LAC', 1),
(239, 15, 'Lankaran', 'LAN', 1),
(240, 15, 'Lerik', 'LER', 1),
(241, 15, 'Masalli', 'MAS', 1),
(242, 15, 'Mingacevir', 'MI', 1),
(243, 15, 'Naftalan', 'NA', 1),
(244, 15, 'Neftcala', 'NEF', 1),
(245, 15, 'Oguz', 'OGU', 1),
(246, 15, 'Ordubad', 'ORD', 1),
(247, 15, 'Qabala', 'QAB', 1),
(248, 15, 'Qax', 'QAX', 1),
(249, 15, 'Qazax', 'QAZ', 1),
(250, 15, 'Qobustan', 'QOB', 1),
(251, 15, 'Quba', 'QBA', 1),
(252, 15, 'Qubadli', 'QBI', 1),
(253, 15, 'Qusar', 'QUS', 1),
(254, 15, 'Saki', 'SA', 1),
(255, 15, 'Saatli', 'SAT', 1),
(256, 15, 'Sabirabad', 'SAB', 1),
(257, 15, 'Sadarak', 'SAD', 1),
(258, 15, 'Sahbuz', 'SAH', 1),
(259, 15, 'Saki', 'SAK', 1),
(260, 15, 'Salyan', 'SAL', 1),
(261, 15, 'Sumqayit', 'SM', 1),
(262, 15, 'Samaxi', 'SMI', 1),
(263, 15, 'Samkir', 'SKR', 1),
(264, 15, 'Samux', 'SMX', 1),
(265, 15, 'Sarur', 'SAR', 1),
(266, 15, 'Siyazan', 'SIY', 1),
(267, 15, 'Susa', 'SS', 1),
(268, 15, 'Susa', 'SUS', 1),
(269, 15, 'Tartar', 'TAR', 1),
(270, 15, 'Tovuz', 'TOV', 1),
(271, 15, 'Ucar', 'UCA', 1),
(272, 15, 'Xankandi', 'XA', 1),
(273, 15, 'Xacmaz', 'XAC', 1),
(274, 15, 'Xanlar', 'XAN', 1),
(275, 15, 'Xizi', 'XIZ', 1),
(276, 15, 'Xocali', 'XCI', 1),
(277, 15, 'Xocavand', 'XVD', 1),
(278, 15, 'Yardimli', 'YAR', 1),
(279, 15, 'Yevlax', 'YEV', 1),
(280, 15, 'Zangilan', 'ZAN', 1),
(281, 15, 'Zaqatala', 'ZAQ', 1),
(282, 15, 'Zardab', 'ZAR', 1),
(283, 15, 'Naxcivan', 'NX', 1),
(284, 16, 'Acklins', 'ACK', 1),
(285, 16, 'Berry Islands', 'BER', 1),
(286, 16, 'Bimini', 'BIM', 1),
(287, 16, 'Black Point', 'BLK', 1),
(288, 16, 'Cat Island', 'CAT', 1),
(289, 16, 'Central Abaco', 'CAB', 1),
(290, 16, 'Central Andros', 'CAN', 1),
(291, 16, 'Central Eleuthera', 'CEL', 1),
(292, 16, 'City of Freeport', 'FRE', 1),
(293, 16, 'Crooked Island', 'CRO', 1),
(294, 16, 'East Grand Bahama', 'EGB', 1),
(295, 16, 'Exuma', 'EXU', 1),
(296, 16, 'Grand Cay', 'GRD', 1),
(297, 16, 'Harbour Island', 'HAR', 1),
(298, 16, 'Hope Town', 'HOP', 1),
(299, 16, 'Inagua', 'INA', 1),
(300, 16, 'Long Island', 'LNG', 1),
(301, 16, 'Mangrove Cay', 'MAN', 1),
(302, 16, 'Mayaguana', 'MAY', 1),
(303, 16, 'Moore\'s Island', 'MOO', 1),
(304, 16, 'North Abaco', 'NAB', 1),
(305, 16, 'North Andros', 'NAN', 1),
(306, 16, 'North Eleuthera', 'NEL', 1),
(307, 16, 'Ragged Island', 'RAG', 1),
(308, 16, 'Rum Cay', 'RUM', 1),
(309, 16, 'San Salvador', 'SAL', 1),
(310, 16, 'South Abaco', 'SAB', 1),
(311, 16, 'South Andros', 'SAN', 1),
(312, 16, 'South Eleuthera', 'SEL', 1),
(313, 16, 'Spanish Wells', 'SWE', 1),
(314, 16, 'West Grand Bahama', 'WGB', 1),
(315, 17, 'Capital', 'CAP', 1),
(316, 17, 'Central', 'CEN', 1),
(317, 17, 'Muharraq', 'MUH', 1),
(318, 17, 'Northern', 'NOR', 1),
(319, 17, 'Southern', 'SOU', 1),
(320, 18, 'Barisal', 'BAR', 1),
(321, 18, 'Chittagong', 'CHI', 1),
(322, 18, 'Dhaka', 'DHA', 1),
(323, 18, 'Khulna', 'KHU', 1),
(324, 18, 'Rajshahi', 'RAJ', 1),
(325, 18, 'Sylhet', 'SYL', 1),
(326, 19, 'Christ Church', 'CC', 1),
(327, 19, 'Saint Andrew', 'AND', 1),
(328, 19, 'Saint George', 'GEO', 1),
(329, 19, 'Saint James', 'JAM', 1),
(330, 19, 'Saint John', 'JOH', 1),
(331, 19, 'Saint Joseph', 'JOS', 1),
(332, 19, 'Saint Lucy', 'LUC', 1),
(333, 19, 'Saint Michael', 'MIC', 1),
(334, 19, 'Saint Peter', 'PET', 1),
(335, 19, 'Saint Philip', 'PHI', 1),
(336, 19, 'Saint Thomas', 'THO', 1),
(337, 20, 'Brestskaya (Brest)', 'BR', 1),
(338, 20, 'Homyel\'skaya (Homyel\')', 'HO', 1),
(339, 20, 'Horad Minsk', 'HM', 1),
(340, 20, 'Hrodzyenskaya (Hrodna)', 'HR', 1),
(341, 20, 'Mahilyowskaya (Mahilyow)', 'MA', 1),
(342, 20, 'Minskaya', 'MI', 1),
(343, 20, 'Vitsyebskaya (Vitsyebsk)', 'VI', 1),
(344, 21, 'Antwerpen', 'VAN', 1),
(345, 21, 'Brabant Wallon', 'WBR', 1),
(346, 21, 'Hainaut', 'WHT', 1),
(347, 21, 'Liège', 'WLG', 1),
(348, 21, 'Limburg', 'VLI', 1),
(349, 21, 'Luxembourg', 'WLX', 1),
(350, 21, 'Namur', 'WNA', 1),
(351, 21, 'Oost-Vlaanderen', 'VOV', 1),
(352, 21, 'Vlaams Brabant', 'VBR', 1),
(353, 21, 'West-Vlaanderen', 'VWV', 1),
(354, 22, 'Belize', 'BZ', 1),
(355, 22, 'Cayo', 'CY', 1),
(356, 22, 'Corozal', 'CR', 1),
(357, 22, 'Orange Walk', 'OW', 1),
(358, 22, 'Stann Creek', 'SC', 1),
(359, 22, 'Toledo', 'TO', 1),
(360, 23, 'Alibori', 'AL', 1),
(361, 23, 'Atakora', 'AK', 1),
(362, 23, 'Atlantique', 'AQ', 1),
(363, 23, 'Borgou', 'BO', 1),
(364, 23, 'Collines', 'CO', 1),
(365, 23, 'Donga', 'DO', 1),
(366, 23, 'Kouffo', 'KO', 1),
(367, 23, 'Littoral', 'LI', 1),
(368, 23, 'Mono', 'MO', 1),
(369, 23, 'Oueme', 'OU', 1),
(370, 23, 'Plateau', 'PL', 1),
(371, 23, 'Zou', 'ZO', 1),
(372, 24, 'Devonshire', 'DS', 1),
(373, 24, 'Hamilton City', 'HC', 1),
(374, 24, 'Hamilton', 'HA', 1),
(375, 24, 'Paget', 'PG', 1),
(376, 24, 'Pembroke', 'PB', 1),
(377, 24, 'Saint George City', 'GC', 1),
(378, 24, 'Saint George\'s', 'SG', 1),
(379, 24, 'Sandys', 'SA', 1),
(380, 24, 'Smith\'s', 'SM', 1),
(381, 24, 'Southampton', 'SH', 1),
(382, 24, 'Warwick', 'WA', 1),
(383, 25, 'Bumthang', 'BUM', 1),
(384, 25, 'Chukha', 'CHU', 1),
(385, 25, 'Dagana', 'DAG', 1),
(386, 25, 'Gasa', 'GAS', 1),
(387, 25, 'Haa', 'HAA', 1),
(388, 25, 'Lhuntse', 'LHU', 1),
(389, 25, 'Mongar', 'MON', 1),
(390, 25, 'Paro', 'PAR', 1),
(391, 25, 'Pemagatshel', 'PEM', 1),
(392, 25, 'Punakha', 'PUN', 1),
(393, 25, 'Samdrup Jongkhar', 'SJO', 1),
(394, 25, 'Samtse', 'SAT', 1),
(395, 25, 'Sarpang', 'SAR', 1),
(396, 25, 'Thimphu', 'THI', 1),
(397, 25, 'Trashigang', 'TRG', 1),
(398, 25, 'Trashiyangste', 'TRY', 1),
(399, 25, 'Trongsa', 'TRO', 1),
(400, 25, 'Tsirang', 'TSI', 1),
(401, 25, 'Wangdue Phodrang', 'WPH', 1),
(402, 25, 'Zhemgang', 'ZHE', 1),
(403, 26, 'Beni', 'BEN', 1),
(404, 26, 'Chuquisaca', 'CHU', 1),
(405, 26, 'Cochabamba', 'COC', 1),
(406, 26, 'La Paz', 'LPZ', 1),
(407, 26, 'Oruro', 'ORU', 1),
(408, 26, 'Pando', 'PAN', 1),
(409, 26, 'Potosi', 'POT', 1),
(410, 26, 'Santa Cruz', 'SCZ', 1),
(411, 26, 'Tarija', 'TAR', 1),
(412, 27, 'Brcko district', 'BRO', 1),
(413, 27, 'Unsko-Sanski Kanton', 'FUS', 1),
(414, 27, 'Posavski Kanton', 'FPO', 1),
(415, 27, 'Tuzlanski Kanton', 'FTU', 1),
(416, 27, 'Zenicko-Dobojski Kanton', 'FZE', 1),
(417, 27, 'Bosanskopodrinjski Kanton', 'FBP', 1),
(418, 27, 'Srednjebosanski Kanton', 'FSB', 1),
(419, 27, 'Hercegovacko-neretvanski Kanton', 'FHN', 1),
(420, 27, 'Zapadnohercegovacka Zupanija', 'FZH', 1),
(421, 27, 'Kanton Sarajevo', 'FSA', 1),
(422, 27, 'Zapadnobosanska', 'FZA', 1),
(423, 27, 'Banja Luka', 'SBL', 1),
(424, 27, 'Doboj', 'SDO', 1),
(425, 27, 'Bijeljina', 'SBI', 1),
(426, 27, 'Vlasenica', 'SVL', 1),
(427, 27, 'Sarajevo-Romanija or Sokolac', 'SSR', 1),
(428, 27, 'Foca', 'SFO', 1),
(429, 27, 'Trebinje', 'STR', 1),
(430, 28, 'Central', 'CE', 1),
(431, 28, 'Ghanzi', 'GH', 1),
(432, 28, 'Kgalagadi', 'KD', 1),
(433, 28, 'Kgatleng', 'KT', 1),
(434, 28, 'Kweneng', 'KW', 1),
(435, 28, 'Ngamiland', 'NG', 1),
(436, 28, 'North East', 'NE', 1),
(437, 28, 'North West', 'NW', 1),
(438, 28, 'South East', 'SE', 1),
(439, 28, 'Southern', 'SO', 1),
(440, 30, 'Acre', 'AC', 1),
(441, 30, 'Alagoas', 'AL', 1),
(442, 30, 'Amapá', 'AP', 1),
(443, 30, 'Amazonas', 'AM', 1),
(444, 30, 'Bahia', 'BA', 1),
(445, 30, 'Ceará', 'CE', 1),
(446, 30, 'Distrito Federal', 'DF', 1),
(447, 30, 'Espírito Santo', 'ES', 1),
(448, 30, 'Goiás', 'GO', 1),
(449, 30, 'Maranhão', 'MA', 1),
(450, 30, 'Mato Grosso', 'MT', 1),
(451, 30, 'Mato Grosso do Sul', 'MS', 1),
(452, 30, 'Minas Gerais', 'MG', 1),
(453, 30, 'Pará', 'PA', 1),
(454, 30, 'Paraíba', 'PB', 1),
(455, 30, 'Paraná', 'PR', 1),
(456, 30, 'Pernambuco', 'PE', 1),
(457, 30, 'Piauí', 'PI', 1),
(458, 30, 'Rio de Janeiro', 'RJ', 1),
(459, 30, 'Rio Grande do Norte', 'RN', 1),
(460, 30, 'Rio Grande do Sul', 'RS', 1),
(461, 30, 'Rondônia', 'RO', 1),
(462, 30, 'Roraima', 'RR', 1),
(463, 30, 'Santa Catarina', 'SC', 1),
(464, 30, 'São Paulo', 'SP', 1),
(465, 30, 'Sergipe', 'SE', 1),
(466, 30, 'Tocantins', 'TO', 1),
(467, 31, 'Peros Banhos', 'PB', 1),
(468, 31, 'Salomon Islands', 'SI', 1),
(469, 31, 'Nelsons Island', 'NI', 1),
(470, 31, 'Three Brothers', 'TB', 1),
(471, 31, 'Eagle Islands', 'EA', 1),
(472, 31, 'Danger Island', 'DI', 1),
(473, 31, 'Egmont Islands', 'EG', 1),
(474, 31, 'Diego Garcia', 'DG', 1),
(475, 32, 'Belait', 'BEL', 1),
(476, 32, 'Brunei and Muara', 'BRM', 1),
(477, 32, 'Temburong', 'TEM', 1),
(478, 32, 'Tutong', 'TUT', 1),
(479, 33, 'Blagoevgrad', '', 1),
(480, 33, 'Burgas', '', 1),
(481, 33, 'Dobrich', '', 1),
(482, 33, 'Gabrovo', '', 1),
(483, 33, 'Haskovo', '', 1),
(484, 33, 'Kardjali', '', 1),
(485, 33, 'Kyustendil', '', 1),
(486, 33, 'Lovech', '', 1),
(487, 33, 'Montana', '', 1),
(488, 33, 'Pazardjik', '', 1),
(489, 33, 'Pernik', '', 1),
(490, 33, 'Pleven', '', 1),
(491, 33, 'Plovdiv', '', 1),
(492, 33, 'Razgrad', '', 1),
(493, 33, 'Shumen', '', 1),
(494, 33, 'Silistra', '', 1),
(495, 33, 'Sliven', '', 1),
(496, 33, 'Smolyan', '', 1),
(497, 33, 'Sofia', '', 1),
(498, 33, 'Sofia - town', '', 1),
(499, 33, 'Stara Zagora', '', 1),
(500, 33, 'Targovishte', '', 1),
(501, 33, 'Varna', '', 1),
(502, 33, 'Veliko Tarnovo', '', 1),
(503, 33, 'Vidin', '', 1),
(504, 33, 'Vratza', '', 1),
(505, 33, 'Yambol', '', 1),
(506, 34, 'Bale', 'BAL', 1),
(507, 34, 'Bam', 'BAM', 1),
(508, 34, 'Banwa', 'BAN', 1),
(509, 34, 'Bazega', 'BAZ', 1),
(510, 34, 'Bougouriba', 'BOR', 1),
(511, 34, 'Boulgou', 'BLG', 1),
(512, 34, 'Boulkiemde', 'BOK', 1),
(513, 34, 'Comoe', 'COM', 1),
(514, 34, 'Ganzourgou', 'GAN', 1),
(515, 34, 'Gnagna', 'GNA', 1),
(516, 34, 'Gourma', 'GOU', 1),
(517, 34, 'Houet', 'HOU', 1),
(518, 34, 'Ioba', 'IOA', 1),
(519, 34, 'Kadiogo', 'KAD', 1),
(520, 34, 'Kenedougou', 'KEN', 1),
(521, 34, 'Komondjari', 'KOD', 1),
(522, 34, 'Kompienga', 'KOP', 1),
(523, 34, 'Kossi', 'KOS', 1),
(524, 34, 'Koulpelogo', 'KOL', 1),
(525, 34, 'Kouritenga', 'KOT', 1),
(526, 34, 'Kourweogo', 'KOW', 1),
(527, 34, 'Leraba', 'LER', 1),
(528, 34, 'Loroum', 'LOR', 1),
(529, 34, 'Mouhoun', 'MOU', 1),
(530, 34, 'Nahouri', 'NAH', 1),
(531, 34, 'Namentenga', 'NAM', 1),
(532, 34, 'Nayala', 'NAY', 1),
(533, 34, 'Noumbiel', 'NOU', 1),
(534, 34, 'Oubritenga', 'OUB', 1),
(535, 34, 'Oudalan', 'OUD', 1),
(536, 34, 'Passore', 'PAS', 1),
(537, 34, 'Poni', 'PON', 1),
(538, 34, 'Sanguie', 'SAG', 1),
(539, 34, 'Sanmatenga', 'SAM', 1),
(540, 34, 'Seno', 'SEN', 1),
(541, 34, 'Sissili', 'SIS', 1),
(542, 34, 'Soum', 'SOM', 1),
(543, 34, 'Sourou', 'SOR', 1),
(544, 34, 'Tapoa', 'TAP', 1),
(545, 34, 'Tuy', 'TUY', 1),
(546, 34, 'Yagha', 'YAG', 1),
(547, 34, 'Yatenga', 'YAT', 1),
(548, 34, 'Ziro', 'ZIR', 1),
(549, 34, 'Zondoma', 'ZOD', 1),
(550, 34, 'Zoundweogo', 'ZOW', 1),
(551, 35, 'Bubanza', 'BB', 1),
(552, 35, 'Bujumbura', 'BJ', 1),
(553, 35, 'Bururi', 'BR', 1),
(554, 35, 'Cankuzo', 'CA', 1),
(555, 35, 'Cibitoke', 'CI', 1),
(556, 35, 'Gitega', 'GI', 1),
(557, 35, 'Karuzi', 'KR', 1),
(558, 35, 'Kayanza', 'KY', 1),
(559, 35, 'Kirundo', 'KI', 1),
(560, 35, 'Makamba', 'MA', 1),
(561, 35, 'Muramvya', 'MU', 1),
(562, 35, 'Muyinga', 'MY', 1),
(563, 35, 'Mwaro', 'MW', 1),
(564, 35, 'Ngozi', 'NG', 1),
(565, 35, 'Rutana', 'RT', 1),
(566, 35, 'Ruyigi', 'RY', 1),
(567, 36, 'Phnom Penh', 'PP', 1),
(568, 36, 'Preah Seihanu (Kompong Som or Sihanoukville)', 'PS', 1),
(569, 36, 'Pailin', 'PA', 1),
(570, 36, 'Keb', 'KB', 1),
(571, 36, 'Banteay Meanchey', 'BM', 1),
(572, 36, 'Battambang', 'BA', 1),
(573, 36, 'Kampong Cham', 'KM', 1),
(574, 36, 'Kampong Chhnang', 'KN', 1),
(575, 36, 'Kampong Speu', 'KU', 1),
(576, 36, 'Kampong Som', 'KO', 1),
(577, 36, 'Kampong Thom', 'KT', 1),
(578, 36, 'Kampot', 'KP', 1),
(579, 36, 'Kandal', 'KL', 1),
(580, 36, 'Kaoh Kong', 'KK', 1),
(581, 36, 'Kratie', 'KR', 1),
(582, 36, 'Mondul Kiri', 'MK', 1),
(583, 36, 'Oddar Meancheay', 'OM', 1),
(584, 36, 'Pursat', 'PU', 1),
(585, 36, 'Preah Vihear', 'PR', 1),
(586, 36, 'Prey Veng', 'PG', 1),
(587, 36, 'Ratanak Kiri', 'RK', 1),
(588, 36, 'Siemreap', 'SI', 1),
(589, 36, 'Stung Treng', 'ST', 1),
(590, 36, 'Svay Rieng', 'SR', 1),
(591, 36, 'Takeo', 'TK', 1),
(592, 37, 'Adamawa (Adamaoua)', 'ADA', 1),
(593, 37, 'Centre', 'CEN', 1),
(594, 37, 'East (Est)', 'EST', 1),
(595, 37, 'Extreme North (Extreme-Nord)', 'EXN', 1),
(596, 37, 'Littoral', 'LIT', 1),
(597, 37, 'North (Nord)', 'NOR', 1),
(598, 37, 'Northwest (Nord-Ouest)', 'NOT', 1),
(599, 37, 'West (Ouest)', 'OUE', 1),
(600, 37, 'South (Sud)', 'SUD', 1),
(601, 37, 'Southwest (Sud-Ouest).', 'SOU', 1),
(602, 38, 'Alberta', 'AB', 1),
(603, 38, 'British Columbia', 'BC', 1),
(604, 38, 'Manitoba', 'MB', 1),
(605, 38, 'New Brunswick', 'NB', 1),
(606, 38, 'Newfoundland and Labrador', 'NL', 1),
(607, 38, 'Northwest Territories', 'NT', 1),
(608, 38, 'Nova Scotia', 'NS', 1),
(609, 38, 'Nunavut', 'NU', 1),
(610, 38, 'Ontario', 'ON', 1),
(611, 38, 'Prince Edward Island', 'PE', 1),
(612, 38, 'Qu&eacute;bec', 'QC', 1),
(613, 38, 'Saskatchewan', 'SK', 1),
(614, 38, 'Yukon Territory', 'YT', 1),
(615, 39, 'Boa Vista', 'BV', 1),
(616, 39, 'Brava', 'BR', 1),
(617, 39, 'Calheta de Sao Miguel', 'CS', 1),
(618, 39, 'Maio', 'MA', 1),
(619, 39, 'Mosteiros', 'MO', 1),
(620, 39, 'Paul', 'PA', 1),
(621, 39, 'Porto Novo', 'PN', 1),
(622, 39, 'Praia', 'PR', 1),
(623, 39, 'Ribeira Grande', 'RG', 1),
(624, 39, 'Sal', 'SL', 1),
(625, 39, 'Santa Catarina', 'CA', 1),
(626, 39, 'Santa Cruz', 'CR', 1),
(627, 39, 'Sao Domingos', 'SD', 1),
(628, 39, 'Sao Filipe', 'SF', 1),
(629, 39, 'Sao Nicolau', 'SN', 1),
(630, 39, 'Sao Vicente', 'SV', 1),
(631, 39, 'Tarrafal', 'TA', 1),
(632, 40, 'Creek', 'CR', 1),
(633, 40, 'Eastern', 'EA', 1),
(634, 40, 'Midland', 'ML', 1),
(635, 40, 'South Town', 'ST', 1),
(636, 40, 'Spot Bay', 'SP', 1),
(637, 40, 'Stake Bay', 'SK', 1),
(638, 40, 'West End', 'WD', 1),
(639, 40, 'Western', 'WN', 1),
(640, 41, 'Bamingui-Bangoran', 'BBA', 1),
(641, 41, 'Basse-Kotto', 'BKO', 1),
(642, 41, 'Haute-Kotto', 'HKO', 1),
(643, 41, 'Haut-Mbomou', 'HMB', 1),
(644, 41, 'Kemo', 'KEM', 1),
(645, 41, 'Lobaye', 'LOB', 1),
(646, 41, 'Mambere-KadeÔ', 'MKD', 1),
(647, 41, 'Mbomou', 'MBO', 1),
(648, 41, 'Nana-Mambere', 'NMM', 1),
(649, 41, 'Ombella-M\'Poko', 'OMP', 1),
(650, 41, 'Ouaka', 'OUK', 1),
(651, 41, 'Ouham', 'OUH', 1),
(652, 41, 'Ouham-Pende', 'OPE', 1),
(653, 41, 'Vakaga', 'VAK', 1),
(654, 41, 'Nana-Grebizi', 'NGR', 1),
(655, 41, 'Sangha-Mbaere', 'SMB', 1),
(656, 41, 'Bangui', 'BAN', 1),
(657, 42, 'Batha', 'BA', 1),
(658, 42, 'Biltine', 'BI', 1),
(659, 42, 'Borkou-Ennedi-Tibesti', 'BE', 1),
(660, 42, 'Chari-Baguirmi', 'CB', 1),
(661, 42, 'Guera', 'GU', 1),
(662, 42, 'Kanem', 'KA', 1),
(663, 42, 'Lac', 'LA', 1),
(664, 42, 'Logone Occidental', 'LC', 1),
(665, 42, 'Logone Oriental', 'LR', 1),
(666, 42, 'Mayo-Kebbi', 'MK', 1),
(667, 42, 'Moyen-Chari', 'MC', 1),
(668, 42, 'Ouaddai', 'OU', 1),
(669, 42, 'Salamat', 'SA', 1),
(670, 42, 'Tandjile', 'TA', 1),
(671, 43, 'Aisen del General Carlos Ibanez', 'AI', 1),
(672, 43, 'Antofagasta', 'AN', 1),
(673, 43, 'Araucania', 'AR', 1),
(674, 43, 'Atacama', 'AT', 1),
(675, 43, 'Bio-Bio', 'BI', 1),
(676, 43, 'Coquimbo', 'CO', 1),
(677, 43, 'Libertador General Bernardo O\'Higgins', 'LI', 1),
(678, 43, 'Los Lagos', 'LL', 1),
(679, 43, 'Magallanes y de la Antartica Chilena', 'MA', 1),
(680, 43, 'Maule', 'ML', 1),
(681, 43, 'Region Metropolitana', 'RM', 1),
(682, 43, 'Tarapaca', 'TA', 1),
(683, 43, 'Valparaiso', 'VS', 1),
(684, 44, 'Anhui', 'AN', 1),
(685, 44, 'Beijing', 'BE', 1),
(686, 44, 'Chongqing', 'CH', 1),
(687, 44, 'Fujian', 'FU', 1),
(688, 44, 'Gansu', 'GA', 1),
(689, 44, 'Guangdong', 'GU', 1),
(690, 44, 'Guangxi', 'GX', 1),
(691, 44, 'Guizhou', 'GZ', 1),
(692, 44, 'Hainan', 'HA', 1),
(693, 44, 'Hebei', 'HB', 1),
(694, 44, 'Heilongjiang', 'HL', 1),
(695, 44, 'Henan', 'HE', 1),
(696, 44, 'Hong Kong', 'HK', 1),
(697, 44, 'Hubei', 'HU', 1),
(698, 44, 'Hunan', 'HN', 1),
(699, 44, 'Inner Mongolia', 'IM', 1),
(700, 44, 'Jiangsu', 'JI', 1),
(701, 44, 'Jiangxi', 'JX', 1),
(702, 44, 'Jilin', 'JL', 1),
(703, 44, 'Liaoning', 'LI', 1),
(704, 44, 'Macau', 'MA', 1),
(705, 44, 'Ningxia', 'NI', 1),
(706, 44, 'Shaanxi', 'SH', 1),
(707, 44, 'Shandong', 'SA', 1),
(708, 44, 'Shanghai', 'SG', 1),
(709, 44, 'Shanxi', 'SX', 1),
(710, 44, 'Sichuan', 'SI', 1),
(711, 44, 'Tianjin', 'TI', 1),
(712, 44, 'Xinjiang', 'XI', 1),
(713, 44, 'Yunnan', 'YU', 1),
(714, 44, 'Zhejiang', 'ZH', 1),
(715, 46, 'Direction Island', 'D', 1),
(716, 46, 'Home Island', 'H', 1),
(717, 46, 'Horsburgh Island', 'O', 1),
(718, 46, 'South Island', 'S', 1),
(719, 46, 'West Island', 'W', 1),
(720, 47, 'Amazonas', 'AMZ', 1),
(721, 47, 'Antioquia', 'ANT', 1),
(722, 47, 'Arauca', 'ARA', 1),
(723, 47, 'Atlantico', 'ATL', 1),
(724, 47, 'Bogota D.C.', 'BDC', 1),
(725, 47, 'Bolivar', 'BOL', 1),
(726, 47, 'Boyaca', 'BOY', 1),
(727, 47, 'Caldas', 'CAL', 1),
(728, 47, 'Caqueta', 'CAQ', 1),
(729, 47, 'Casanare', 'CAS', 1),
(730, 47, 'Cauca', 'CAU', 1),
(731, 47, 'Cesar', 'CES', 1),
(732, 47, 'Choco', 'CHO', 1),
(733, 47, 'Cordoba', 'COR', 1),
(734, 47, 'Cundinamarca', 'CAM', 1),
(735, 47, 'Guainia', 'GNA', 1),
(736, 47, 'Guajira', 'GJR', 1),
(737, 47, 'Guaviare', 'GVR', 1),
(738, 47, 'Huila', 'HUI', 1),
(739, 47, 'Magdalena', 'MAG', 1),
(740, 47, 'Meta', 'MET', 1),
(741, 47, 'Narino', 'NAR', 1),
(742, 47, 'Norte de Santander', 'NDS', 1),
(743, 47, 'Putumayo', 'PUT', 1),
(744, 47, 'Quindio', 'QUI', 1),
(745, 47, 'Risaralda', 'RIS', 1),
(746, 47, 'San Andres y Providencia', 'SAP', 1),
(747, 47, 'Santander', 'SAN', 1),
(748, 47, 'Sucre', 'SUC', 1),
(749, 47, 'Tolima', 'TOL', 1),
(750, 47, 'Valle del Cauca', 'VDC', 1),
(751, 47, 'Vaupes', 'VAU', 1),
(752, 47, 'Vichada', 'VIC', 1),
(753, 48, 'Grande Comore', 'G', 1),
(754, 48, 'Anjouan', 'A', 1),
(755, 48, 'Moheli', 'M', 1),
(756, 49, 'Bouenza', 'BO', 1),
(757, 49, 'Brazzaville', 'BR', 1),
(758, 49, 'Cuvette', 'CU', 1),
(759, 49, 'Cuvette-Ouest', 'CO', 1),
(760, 49, 'Kouilou', 'KO', 1),
(761, 49, 'Lekoumou', 'LE', 1),
(762, 49, 'Likouala', 'LI', 1),
(763, 49, 'Niari', 'NI', 1),
(764, 49, 'Plateaux', 'PL', 1),
(765, 49, 'Pool', 'PO', 1),
(766, 49, 'Sangha', 'SA', 1),
(767, 50, 'Pukapuka', 'PU', 1),
(768, 50, 'Rakahanga', 'RK', 1),
(769, 50, 'Manihiki', 'MK', 1),
(770, 50, 'Penrhyn', 'PE', 1),
(771, 50, 'Nassau Island', 'NI', 1),
(772, 50, 'Surwarrow', 'SU', 1),
(773, 50, 'Palmerston', 'PA', 1),
(774, 50, 'Aitutaki', 'AI', 1),
(775, 50, 'Manuae', 'MA', 1),
(776, 50, 'Takutea', 'TA', 1),
(777, 50, 'Mitiaro', 'MT', 1),
(778, 50, 'Atiu', 'AT', 1),
(779, 50, 'Mauke', 'MU', 1),
(780, 50, 'Rarotonga', 'RR', 1),
(781, 50, 'Mangaia', 'MG', 1),
(782, 51, 'Alajuela', 'AL', 1),
(783, 51, 'Cartago', 'CA', 1),
(784, 51, 'Guanacaste', 'GU', 1),
(785, 51, 'Heredia', 'HE', 1),
(786, 51, 'Limon', 'LI', 1),
(787, 51, 'Puntarenas', 'PU', 1),
(788, 51, 'San Jose', 'SJ', 1),
(789, 52, 'Abengourou', 'ABE', 1),
(790, 52, 'Abidjan', 'ABI', 1),
(791, 52, 'Aboisso', 'ABO', 1),
(792, 52, 'Adiake', 'ADI', 1),
(793, 52, 'Adzope', 'ADZ', 1),
(794, 52, 'Agboville', 'AGB', 1),
(795, 52, 'Agnibilekrou', 'AGN', 1),
(796, 52, 'Alepe', 'ALE', 1),
(797, 52, 'Bocanda', 'BOC', 1),
(798, 52, 'Bangolo', 'BAN', 1),
(799, 52, 'Beoumi', 'BEO', 1),
(800, 52, 'Biankouma', 'BIA', 1),
(801, 52, 'Bondoukou', 'BDK', 1),
(802, 52, 'Bongouanou', 'BGN', 1),
(803, 52, 'Bouafle', 'BFL', 1),
(804, 52, 'Bouake', 'BKE', 1),
(805, 52, 'Bouna', 'BNA', 1),
(806, 52, 'Boundiali', 'BDL', 1),
(807, 52, 'Dabakala', 'DKL', 1),
(808, 52, 'Dabou', 'DBU', 1),
(809, 52, 'Daloa', 'DAL', 1),
(810, 52, 'Danane', 'DAN', 1),
(811, 52, 'Daoukro', 'DAO', 1),
(812, 52, 'Dimbokro', 'DIM', 1),
(813, 52, 'Divo', 'DIV', 1),
(814, 52, 'Duekoue', 'DUE', 1),
(815, 52, 'Ferkessedougou', 'FER', 1),
(816, 52, 'Gagnoa', 'GAG', 1),
(817, 52, 'Grand-Bassam', 'GBA', 1),
(818, 52, 'Grand-Lahou', 'GLA', 1),
(819, 52, 'Guiglo', 'GUI', 1),
(820, 52, 'Issia', 'ISS', 1),
(821, 52, 'Jacqueville', 'JAC', 1),
(822, 52, 'Katiola', 'KAT', 1),
(823, 52, 'Korhogo', 'KOR', 1),
(824, 52, 'Lakota', 'LAK', 1),
(825, 52, 'Man', 'MAN', 1),
(826, 52, 'Mankono', 'MKN', 1),
(827, 52, 'Mbahiakro', 'MBA', 1),
(828, 52, 'Odienne', 'ODI', 1),
(829, 52, 'Oume', 'OUM', 1),
(830, 52, 'Sakassou', 'SAK', 1),
(831, 52, 'San-Pedro', 'SPE', 1),
(832, 52, 'Sassandra', 'SAS', 1),
(833, 52, 'Seguela', 'SEG', 1),
(834, 52, 'Sinfra', 'SIN', 1),
(835, 52, 'Soubre', 'SOU', 1),
(836, 52, 'Tabou', 'TAB', 1),
(837, 52, 'Tanda', 'TAN', 1),
(838, 52, 'Tiebissou', 'TIE', 1),
(839, 52, 'Tingrela', 'TIN', 1),
(840, 52, 'Tiassale', 'TIA', 1),
(841, 52, 'Touba', 'TBA', 1),
(842, 52, 'Toulepleu', 'TLP', 1),
(843, 52, 'Toumodi', 'TMD', 1),
(844, 52, 'Vavoua', 'VAV', 1),
(845, 52, 'Yamoussoukro', 'YAM', 1),
(846, 52, 'Zuenoula', 'ZUE', 1),
(847, 53, 'Bjelovarsko-bilogorska', 'BB', 1),
(848, 53, 'Grad Zagreb', 'GZ', 1),
(849, 53, 'Dubrovačko-neretvanska', 'DN', 1),
(850, 53, 'Istarska', 'IS', 1),
(851, 53, 'Karlovačka', 'KA', 1),
(852, 53, 'Koprivničko-križevačka', 'KK', 1),
(853, 53, 'Krapinsko-zagorska', 'KZ', 1),
(854, 53, 'Ličko-senjska', 'LS', 1),
(855, 53, 'Međimurska', 'ME', 1),
(856, 53, 'Osječko-baranjska', 'OB', 1),
(857, 53, 'Požeško-slavonska', 'PS', 1),
(858, 53, 'Primorsko-goranska', 'PG', 1),
(859, 53, 'Šibensko-kninska', 'SK', 1),
(860, 53, 'Sisačko-moslavačka', 'SM', 1),
(861, 53, 'Brodsko-posavska', 'BP', 1),
(862, 53, 'Splitsko-dalmatinska', 'SD', 1),
(863, 53, 'Varaždinska', 'VA', 1),
(864, 53, 'Virovitičko-podravska', 'VP', 1),
(865, 53, 'Vukovarsko-srijemska', 'VS', 1),
(866, 53, 'Zadarska', 'ZA', 1),
(867, 53, 'Zagrebačka', 'ZG', 1),
(868, 54, 'Camaguey', 'CA', 1),
(869, 54, 'Ciego de Avila', 'CD', 1),
(870, 54, 'Cienfuegos', 'CI', 1),
(871, 54, 'Ciudad de La Habana', 'CH', 1),
(872, 54, 'Granma', 'GR', 1),
(873, 54, 'Guantanamo', 'GU', 1),
(874, 54, 'Holguin', 'HO', 1),
(875, 54, 'Isla de la Juventud', 'IJ', 1),
(876, 54, 'La Habana', 'LH', 1),
(877, 54, 'Las Tunas', 'LT', 1),
(878, 54, 'Matanzas', 'MA', 1),
(879, 54, 'Pinar del Rio', 'PR', 1),
(880, 54, 'Sancti Spiritus', 'SS', 1),
(881, 54, 'Santiago de Cuba', 'SC', 1),
(882, 54, 'Villa Clara', 'VC', 1),
(883, 55, 'Famagusta', 'F', 1),
(884, 55, 'Kyrenia', 'K', 1),
(885, 55, 'Larnaca', 'A', 1),
(886, 55, 'Limassol', 'I', 1),
(887, 55, 'Nicosia', 'N', 1),
(888, 55, 'Paphos', 'P', 1),
(889, 56, 'Ústecký', 'U', 1),
(890, 56, 'Jihočeský', 'C', 1),
(891, 56, 'Jihomoravský', 'B', 1),
(892, 56, 'Karlovarský', 'K', 1),
(893, 56, 'Královehradecký', 'H', 1),
(894, 56, 'Liberecký', 'L', 1),
(895, 56, 'Moravskoslezský', 'T', 1),
(896, 56, 'Olomoucký', 'M', 1),
(897, 56, 'Pardubický', 'E', 1),
(898, 56, 'Plzeňský', 'P', 1),
(899, 56, 'Praha', 'A', 1),
(900, 56, 'Středočeský', 'S', 1),
(901, 56, 'Vysočina', 'J', 1),
(902, 56, 'Zlínský', 'Z', 1),
(903, 57, 'Arhus', 'AR', 1),
(904, 57, 'Bornholm', 'BH', 1),
(905, 57, 'Copenhagen', 'CO', 1),
(906, 57, 'Faroe Islands', 'FO', 1),
(907, 57, 'Frederiksborg', 'FR', 1),
(908, 57, 'Fyn', 'FY', 1),
(909, 57, 'Kobenhavn', 'KO', 1),
(910, 57, 'Nordjylland', 'NO', 1),
(911, 57, 'Ribe', 'RI', 1),
(912, 57, 'Ringkobing', 'RK', 1),
(913, 57, 'Roskilde', 'RO', 1),
(914, 57, 'Sonderjylland', 'SO', 1),
(915, 57, 'Storstrom', 'ST', 1),
(916, 57, 'Vejle', 'VK', 1),
(917, 57, 'Vestj&aelig;lland', 'VJ', 1),
(918, 57, 'Viborg', 'VB', 1),
(919, 58, '\'Ali Sabih', 'S', 1),
(920, 58, 'Dikhil', 'K', 1),
(921, 58, 'Djibouti', 'J', 1),
(922, 58, 'Obock', 'O', 1),
(923, 58, 'Tadjoura', 'T', 1),
(924, 59, 'Saint Andrew Parish', 'AND', 1),
(925, 59, 'Saint David Parish', 'DAV', 1),
(926, 59, 'Saint George Parish', 'GEO', 1),
(927, 59, 'Saint John Parish', 'JOH', 1),
(928, 59, 'Saint Joseph Parish', 'JOS', 1),
(929, 59, 'Saint Luke Parish', 'LUK', 1),
(930, 59, 'Saint Mark Parish', 'MAR', 1),
(931, 59, 'Saint Patrick Parish', 'PAT', 1),
(932, 59, 'Saint Paul Parish', 'PAU', 1),
(933, 59, 'Saint Peter Parish', 'PET', 1),
(934, 60, 'Distrito Nacional', 'DN', 1),
(935, 60, 'Azua', 'AZ', 1),
(936, 60, 'Baoruco', 'BC', 1),
(937, 60, 'Barahona', 'BH', 1),
(938, 60, 'Dajabon', 'DJ', 1),
(939, 60, 'Duarte', 'DU', 1),
(940, 60, 'Elias Pina', 'EL', 1),
(941, 60, 'El Seybo', 'SY', 1),
(942, 60, 'Espaillat', 'ET', 1),
(943, 60, 'Hato Mayor', 'HM', 1),
(944, 60, 'Independencia', 'IN', 1),
(945, 60, 'La Altagracia', 'AL', 1),
(946, 60, 'La Romana', 'RO', 1),
(947, 60, 'La Vega', 'VE', 1),
(948, 60, 'Maria Trinidad Sanchez', 'MT', 1),
(949, 60, 'Monsenor Nouel', 'MN', 1),
(950, 60, 'Monte Cristi', 'MC', 1),
(951, 60, 'Monte Plata', 'MP', 1),
(952, 60, 'Pedernales', 'PD', 1),
(953, 60, 'Peravia (Bani)', 'PR', 1),
(954, 60, 'Puerto Plata', 'PP', 1),
(955, 60, 'Salcedo', 'SL', 1),
(956, 60, 'Samana', 'SM', 1),
(957, 60, 'Sanchez Ramirez', 'SH', 1),
(958, 60, 'San Cristobal', 'SC', 1),
(959, 60, 'San Jose de Ocoa', 'JO', 1),
(960, 60, 'San Juan', 'SJ', 1),
(961, 60, 'San Pedro de Macoris', 'PM', 1),
(962, 60, 'Santiago', 'SA', 1),
(963, 60, 'Santiago Rodriguez', 'ST', 1),
(964, 60, 'Santo Domingo', 'SD', 1),
(965, 60, 'Valverde', 'VA', 1),
(966, 61, 'Aileu', 'AL', 1),
(967, 61, 'Ainaro', 'AN', 1),
(968, 61, 'Baucau', 'BA', 1),
(969, 61, 'Bobonaro', 'BO', 1),
(970, 61, 'Cova Lima', 'CO', 1),
(971, 61, 'Dili', 'DI', 1),
(972, 61, 'Ermera', 'ER', 1),
(973, 61, 'Lautem', 'LA', 1),
(974, 61, 'Liquica', 'LI', 1),
(975, 61, 'Manatuto', 'MT', 1),
(976, 61, 'Manufahi', 'MF', 1),
(977, 61, 'Oecussi', 'OE', 1),
(978, 61, 'Viqueque', 'VI', 1),
(979, 62, 'Azuay', 'AZU', 1),
(980, 62, 'Bolivar', 'BOL', 1),
(981, 62, 'Ca&ntilde;ar', 'CAN', 1),
(982, 62, 'Carchi', 'CAR', 1),
(983, 62, 'Chimborazo', 'CHI', 1),
(984, 62, 'Cotopaxi', 'COT', 1),
(985, 62, 'El Oro', 'EOR', 1),
(986, 62, 'Esmeraldas', 'ESM', 1),
(987, 62, 'Gal&aacute;pagos', 'GPS', 1),
(988, 62, 'Guayas', 'GUA', 1),
(989, 62, 'Imbabura', 'IMB', 1),
(990, 62, 'Loja', 'LOJ', 1),
(991, 62, 'Los Rios', 'LRO', 1),
(992, 62, 'Manab&iacute;', 'MAN', 1),
(993, 62, 'Morona Santiago', 'MSA', 1),
(994, 62, 'Napo', 'NAP', 1),
(995, 62, 'Orellana', 'ORE', 1),
(996, 62, 'Pastaza', 'PAS', 1),
(997, 62, 'Pichincha', 'PIC', 1),
(998, 62, 'Sucumb&iacute;os', 'SUC', 1),
(999, 62, 'Tungurahua', 'TUN', 1),
(1000, 62, 'Zamora Chinchipe', 'ZCH', 1),
(1001, 63, 'Ad Daqahliyah', 'DHY', 1),
(1002, 63, 'Al Bahr al Ahmar', 'BAM', 1),
(1003, 63, 'Al Buhayrah', 'BHY', 1),
(1004, 63, 'Al Fayyum', 'FYM', 1),
(1005, 63, 'Al Gharbiyah', 'GBY', 1),
(1006, 63, 'Al Iskandariyah', 'IDR', 1),
(1007, 63, 'Al Isma\'iliyah', 'IML', 1),
(1008, 63, 'Al Jizah', 'JZH', 1),
(1009, 63, 'Al Minufiyah', 'MFY', 1),
(1010, 63, 'Al Minya', 'MNY', 1),
(1011, 63, 'Al Qahirah', 'QHR', 1),
(1012, 63, 'Al Qalyubiyah', 'QLY', 1),
(1013, 63, 'Al Wadi al Jadid', 'WJD', 1),
(1014, 63, 'Ash Sharqiyah', 'SHQ', 1),
(1015, 63, 'As Suways', 'SWY', 1),
(1016, 63, 'Aswan', 'ASW', 1),
(1017, 63, 'Asyut', 'ASY', 1),
(1018, 63, 'Bani Suwayf', 'BSW', 1),
(1019, 63, 'Bur Sa\'id', 'BSD', 1),
(1020, 63, 'Dumyat', 'DMY', 1),
(1021, 63, 'Janub Sina\'', 'JNS', 1),
(1022, 63, 'Kafr ash Shaykh', 'KSH', 1),
(1023, 63, 'Matruh', 'MAT', 1),
(1024, 63, 'Qina', 'QIN', 1),
(1025, 63, 'Shamal Sina\'', 'SHS', 1),
(1026, 63, 'Suhaj', 'SUH', 1),
(1027, 64, 'Ahuachapan', 'AH', 1),
(1028, 64, 'Cabanas', 'CA', 1),
(1029, 64, 'Chalatenango', 'CH', 1),
(1030, 64, 'Cuscatlan', 'CU', 1),
(1031, 64, 'La Libertad', 'LB', 1),
(1032, 64, 'La Paz', 'PZ', 1),
(1033, 64, 'La Union', 'UN', 1),
(1034, 64, 'Morazan', 'MO', 1),
(1035, 64, 'San Miguel', 'SM', 1),
(1036, 64, 'San Salvador', 'SS', 1),
(1037, 64, 'San Vicente', 'SV', 1),
(1038, 64, 'Santa Ana', 'SA', 1),
(1039, 64, 'Sonsonate', 'SO', 1),
(1040, 64, 'Usulutan', 'US', 1),
(1041, 65, 'Provincia Annobon', 'AN', 1),
(1042, 65, 'Provincia Bioko Norte', 'BN', 1),
(1043, 65, 'Provincia Bioko Sur', 'BS', 1),
(1044, 65, 'Provincia Centro Sur', 'CS', 1),
(1045, 65, 'Provincia Kie-Ntem', 'KN', 1),
(1046, 65, 'Provincia Litoral', 'LI', 1),
(1047, 65, 'Provincia Wele-Nzas', 'WN', 1),
(1048, 66, 'Central (Maekel)', 'MA', 1),
(1049, 66, 'Anseba (Keren)', 'KE', 1),
(1050, 66, 'Southern Red Sea (Debub-Keih-Bahri)', 'DK', 1),
(1051, 66, 'Northern Red Sea (Semien-Keih-Bahri)', 'SK', 1),
(1052, 66, 'Southern (Debub)', 'DE', 1),
(1053, 66, 'Gash-Barka (Barentu)', 'BR', 1),
(1054, 67, 'Harjumaa (Tallinn)', 'HA', 1),
(1055, 67, 'Hiiumaa (Kardla)', 'HI', 1),
(1056, 67, 'Ida-Virumaa (Johvi)', 'IV', 1),
(1057, 67, 'Jarvamaa (Paide)', 'JA', 1),
(1058, 67, 'Jogevamaa (Jogeva)', 'JO', 1),
(1059, 67, 'Laane-Virumaa (Rakvere)', 'LV', 1),
(1060, 67, 'Laanemaa (Haapsalu)', 'LA', 1),
(1061, 67, 'Parnumaa (Parnu)', 'PA', 1),
(1062, 67, 'Polvamaa (Polva)', 'PO', 1),
(1063, 67, 'Raplamaa (Rapla)', 'RA', 1),
(1064, 67, 'Saaremaa (Kuessaare)', 'SA', 1),
(1065, 67, 'Tartumaa (Tartu)', 'TA', 1),
(1066, 67, 'Valgamaa (Valga)', 'VA', 1),
(1067, 67, 'Viljandimaa (Viljandi)', 'VI', 1),
(1068, 67, 'Vorumaa (Voru)', 'VO', 1),
(1069, 68, 'Afar', 'AF', 1),
(1070, 68, 'Amhara', 'AH', 1),
(1071, 68, 'Benishangul-Gumaz', 'BG', 1),
(1072, 68, 'Gambela', 'GB', 1),
(1073, 68, 'Hariai', 'HR', 1),
(1074, 68, 'Oromia', 'OR', 1),
(1075, 68, 'Somali', 'SM', 1),
(1076, 68, 'Southern Nations - Nationalities and Peoples Region', 'SN', 1),
(1077, 68, 'Tigray', 'TG', 1),
(1078, 68, 'Addis Ababa', 'AA', 1),
(1079, 68, 'Dire Dawa', 'DD', 1),
(1080, 71, 'Central Division', 'C', 1),
(1081, 71, 'Northern Division', 'N', 1),
(1082, 71, 'Eastern Division', 'E', 1),
(1083, 71, 'Western Division', 'W', 1),
(1084, 71, 'Rotuma', 'R', 1),
(1085, 72, 'Ahvenanmaan lääni', 'AL', 1),
(1086, 72, 'Etelä-Suomen lääni', 'ES', 1),
(1087, 72, 'Itä-Suomen lääni', 'IS', 1),
(1088, 72, 'Länsi-Suomen lääni', 'LS', 1),
(1089, 72, 'Lapin lääni', 'LA', 1),
(1090, 72, 'Oulun lääni', 'OU', 1),
(1114, 74, 'Ain', '01', 1),
(1115, 74, 'Aisne', '02', 1),
(1116, 74, 'Allier', '03', 1),
(1117, 74, 'Alpes de Haute Provence', '04', 1),
(1118, 74, 'Hautes-Alpes', '05', 1),
(1119, 74, 'Alpes Maritimes', '06', 1),
(1120, 74, 'Ard&egrave;che', '07', 1),
(1121, 74, 'Ardennes', '08', 1),
(1122, 74, 'Ari&egrave;ge', '09', 1),
(1123, 74, 'Aube', '10', 1),
(1124, 74, 'Aude', '11', 1),
(1125, 74, 'Aveyron', '12', 1),
(1126, 74, 'Bouches du Rh&ocirc;ne', '13', 1),
(1127, 74, 'Calvados', '14', 1),
(1128, 74, 'Cantal', '15', 1),
(1129, 74, 'Charente', '16', 1),
(1130, 74, 'Charente Maritime', '17', 1),
(1131, 74, 'Cher', '18', 1),
(1132, 74, 'Corr&egrave;ze', '19', 1),
(1133, 74, 'Corse du Sud', '2A', 1),
(1134, 74, 'Haute Corse', '2B', 1),
(1135, 74, 'C&ocirc;te d&#039;or', '21', 1),
(1136, 74, 'C&ocirc;tes d&#039;Armor', '22', 1),
(1137, 74, 'Creuse', '23', 1),
(1138, 74, 'Dordogne', '24', 1),
(1139, 74, 'Doubs', '25', 1),
(1140, 74, 'Dr&ocirc;me', '26', 1),
(1141, 74, 'Eure', '27', 1),
(1142, 74, 'Eure et Loir', '28', 1),
(1143, 74, 'Finist&egrave;re', '29', 1),
(1144, 74, 'Gard', '30', 1),
(1145, 74, 'Haute Garonne', '31', 1),
(1146, 74, 'Gers', '32', 1),
(1147, 74, 'Gironde', '33', 1),
(1148, 74, 'H&eacute;rault', '34', 1),
(1149, 74, 'Ille et Vilaine', '35', 1),
(1150, 74, 'Indre', '36', 1),
(1151, 74, 'Indre et Loire', '37', 1),
(1152, 74, 'Is&eacute;re', '38', 1),
(1153, 74, 'Jura', '39', 1),
(1154, 74, 'Landes', '40', 1),
(1155, 74, 'Loir et Cher', '41', 1),
(1156, 74, 'Loire', '42', 1),
(1157, 74, 'Haute Loire', '43', 1),
(1158, 74, 'Loire Atlantique', '44', 1),
(1159, 74, 'Loiret', '45', 1),
(1160, 74, 'Lot', '46', 1),
(1161, 74, 'Lot et Garonne', '47', 1),
(1162, 74, 'Loz&egrave;re', '48', 1),
(1163, 74, 'Maine et Loire', '49', 1),
(1164, 74, 'Manche', '50', 1),
(1165, 74, 'Marne', '51', 1),
(1166, 74, 'Haute Marne', '52', 1),
(1167, 74, 'Mayenne', '53', 1),
(1168, 74, 'Meurthe et Moselle', '54', 1),
(1169, 74, 'Meuse', '55', 1),
(1170, 74, 'Morbihan', '56', 1),
(1171, 74, 'Moselle', '57', 1),
(1172, 74, 'Ni&egrave;vre', '58', 1),
(1173, 74, 'Nord', '59', 1),
(1174, 74, 'Oise', '60', 1),
(1175, 74, 'Orne', '61', 1),
(1176, 74, 'Pas de Calais', '62', 1),
(1177, 74, 'Puy de D&ocirc;me', '63', 1),
(1178, 74, 'Pyr&eacute;n&eacute;es Atlantiques', '64', 1),
(1179, 74, 'Hautes Pyr&eacute;n&eacute;es', '65', 1),
(1180, 74, 'Pyr&eacute;n&eacute;es Orientales', '66', 1),
(1181, 74, 'Bas Rhin', '67', 1),
(1182, 74, 'Haut Rhin', '68', 1),
(1183, 74, 'Rh&ocirc;ne', '69', 1),
(1184, 74, 'Haute Sa&ocirc;ne', '70', 1),
(1185, 74, 'Sa&ocirc;ne et Loire', '71', 1),
(1186, 74, 'Sarthe', '72', 1),
(1187, 74, 'Savoie', '73', 1),
(1188, 74, 'Haute Savoie', '74', 1),
(1189, 74, 'Paris', '75', 1),
(1190, 74, 'Seine Maritime', '76', 1),
(1191, 74, 'Seine et Marne', '77', 1),
(1192, 74, 'Yvelines', '78', 1),
(1193, 74, 'Deux S&egrave;vres', '79', 1),
(1194, 74, 'Somme', '80', 1),
(1195, 74, 'Tarn', '81', 1),
(1196, 74, 'Tarn et Garonne', '82', 1),
(1197, 74, 'Var', '83', 1),
(1198, 74, 'Vaucluse', '84', 1),
(1199, 74, 'Vend&eacute;e', '85', 1),
(1200, 74, 'Vienne', '86', 1),
(1201, 74, 'Haute Vienne', '87', 1),
(1202, 74, 'Vosges', '88', 1),
(1203, 74, 'Yonne', '89', 1),
(1204, 74, 'Territoire de Belfort', '90', 1),
(1205, 74, 'Essonne', '91', 1),
(1206, 74, 'Hauts de Seine', '92', 1),
(1207, 74, 'Seine St-Denis', '93', 1),
(1208, 74, 'Val de Marne', '94', 1),
(1209, 74, 'Val d\'Oise', '95', 1),
(1210, 76, 'Archipel des Marquises', 'M', 1),
(1211, 76, 'Archipel des Tuamotu', 'T', 1),
(1212, 76, 'Archipel des Tubuai', 'I', 1),
(1213, 76, 'Iles du Vent', 'V', 1),
(1214, 76, 'Iles Sous-le-Vent', 'S', 1),
(1215, 77, 'Iles Crozet', 'C', 1),
(1216, 77, 'Iles Kerguelen', 'K', 1),
(1217, 77, 'Ile Amsterdam', 'A', 1),
(1218, 77, 'Ile Saint-Paul', 'P', 1),
(1219, 77, 'Adelie Land', 'D', 1),
(1220, 78, 'Estuaire', 'ES', 1),
(1221, 78, 'Haut-Ogooue', 'HO', 1),
(1222, 78, 'Moyen-Ogooue', 'MO', 1),
(1223, 78, 'Ngounie', 'NG', 1),
(1224, 78, 'Nyanga', 'NY', 1),
(1225, 78, 'Ogooue-Ivindo', 'OI', 1),
(1226, 78, 'Ogooue-Lolo', 'OL', 1),
(1227, 78, 'Ogooue-Maritime', 'OM', 1),
(1228, 78, 'Woleu-Ntem', 'WN', 1),
(1229, 79, 'Banjul', 'BJ', 1),
(1230, 79, 'Basse', 'BS', 1),
(1231, 79, 'Brikama', 'BR', 1),
(1232, 79, 'Janjangbure', 'JA', 1),
(1233, 79, 'Kanifeng', 'KA', 1),
(1234, 79, 'Kerewan', 'KE', 1),
(1235, 79, 'Kuntaur', 'KU', 1),
(1236, 79, 'Mansakonko', 'MA', 1),
(1237, 79, 'Lower River', 'LR', 1),
(1238, 79, 'Central River', 'CR', 1),
(1239, 79, 'North Bank', 'NB', 1),
(1240, 79, 'Upper River', 'UR', 1),
(1241, 79, 'Western', 'WE', 1),
(1242, 80, 'Abkhazia', 'AB', 1),
(1243, 80, 'Ajaria', 'AJ', 1),
(1244, 80, 'Tbilisi', 'TB', 1),
(1245, 80, 'Guria', 'GU', 1),
(1246, 80, 'Imereti', 'IM', 1),
(1247, 80, 'Kakheti', 'KA', 1),
(1248, 80, 'Kvemo Kartli', 'KK', 1),
(1249, 80, 'Mtskheta-Mtianeti', 'MM', 1),
(1250, 80, 'Racha Lechkhumi and Kvemo Svanet', 'RL', 1),
(1251, 80, 'Samegrelo-Zemo Svaneti', 'SZ', 1),
(1252, 80, 'Samtskhe-Javakheti', 'SJ', 1),
(1253, 80, 'Shida Kartli', 'SK', 1),
(1254, 81, 'Baden-Württemberg', 'BAW', 1),
(1255, 81, 'Bayern', 'BAY', 1),
(1256, 81, 'Berlin', 'BER', 1),
(1257, 81, 'Brandenburg', 'BRG', 1),
(1258, 81, 'Bremen', 'BRE', 1),
(1259, 81, 'Hamburg', 'HAM', 1),
(1260, 81, 'Hessen', 'HES', 1),
(1261, 81, 'Mecklenburg-Vorpommern', 'MEC', 1),
(1262, 81, 'Niedersachsen', 'NDS', 1),
(1263, 81, 'Nordrhein-Westfalen', 'NRW', 1),
(1264, 81, 'Rheinland-Pfalz', 'RHE', 1),
(1265, 81, 'Saarland', 'SAR', 1),
(1266, 81, 'Sachsen', 'SAS', 1),
(1267, 81, 'Sachsen-Anhalt', 'SAC', 1),
(1268, 81, 'Schleswig-Holstein', 'SCN', 1),
(1269, 81, 'Thüringen', 'THE', 1),
(1270, 82, 'Ashanti Region', 'AS', 1),
(1271, 82, 'Brong-Ahafo Region', 'BA', 1),
(1272, 82, 'Central Region', 'CE', 1),
(1273, 82, 'Eastern Region', 'EA', 1),
(1274, 82, 'Greater Accra Region', 'GA', 1),
(1275, 82, 'Northern Region', 'NO', 1),
(1276, 82, 'Upper East Region', 'UE', 1),
(1277, 82, 'Upper West Region', 'UW', 1),
(1278, 82, 'Volta Region', 'VO', 1),
(1279, 82, 'Western Region', 'WE', 1),
(1280, 84, 'Attica', 'AT', 1),
(1281, 84, 'Central Greece', 'CN', 1),
(1282, 84, 'Central Macedonia', 'CM', 1),
(1283, 84, 'Crete', 'CR', 1),
(1284, 84, 'East Macedonia and Thrace', 'EM', 1),
(1285, 84, 'Epirus', 'EP', 1),
(1286, 84, 'Ionian Islands', 'II', 1),
(1287, 84, 'North Aegean', 'NA', 1),
(1288, 84, 'Peloponnesos', 'PP', 1),
(1289, 84, 'South Aegean', 'SA', 1),
(1290, 84, 'Thessaly', 'TH', 1),
(1291, 84, 'West Greece', 'WG', 1),
(1292, 84, 'West Macedonia', 'WM', 1),
(1293, 85, 'Avannaa', 'A', 1),
(1294, 85, 'Tunu', 'T', 1),
(1295, 85, 'Kitaa', 'K', 1),
(1296, 86, 'Saint Andrew', 'A', 1),
(1297, 86, 'Saint David', 'D', 1),
(1298, 86, 'Saint George', 'G', 1),
(1299, 86, 'Saint John', 'J', 1),
(1300, 86, 'Saint Mark', 'M', 1),
(1301, 86, 'Saint Patrick', 'P', 1),
(1302, 86, 'Carriacou', 'C', 1),
(1303, 86, 'Petit Martinique', 'Q', 1),
(1304, 89, 'Alta Verapaz', 'AV', 1),
(1305, 89, 'Baja Verapaz', 'BV', 1),
(1306, 89, 'Chimaltenango', 'CM', 1),
(1307, 89, 'Chiquimula', 'CQ', 1),
(1308, 89, 'El Peten', 'PE', 1),
(1309, 89, 'El Progreso', 'PR', 1),
(1310, 89, 'El Quiche', 'QC', 1),
(1311, 89, 'Escuintla', 'ES', 1),
(1312, 89, 'Guatemala', 'GU', 1),
(1313, 89, 'Huehuetenango', 'HU', 1),
(1314, 89, 'Izabal', 'IZ', 1),
(1315, 89, 'Jalapa', 'JA', 1),
(1316, 89, 'Jutiapa', 'JU', 1),
(1317, 89, 'Quetzaltenango', 'QZ', 1),
(1318, 89, 'Retalhuleu', 'RE', 1),
(1319, 89, 'Sacatepequez', 'ST', 1),
(1320, 89, 'San Marcos', 'SM', 1),
(1321, 89, 'Santa Rosa', 'SR', 1),
(1322, 89, 'Solola', 'SO', 1),
(1323, 89, 'Suchitepequez', 'SU', 1),
(1324, 89, 'Totonicapan', 'TO', 1),
(1325, 89, 'Zacapa', 'ZA', 1),
(1326, 90, 'Conakry', 'CNK', 1),
(1327, 90, 'Beyla', 'BYL', 1),
(1328, 90, 'Boffa', 'BFA', 1),
(1329, 90, 'Boke', 'BOK', 1),
(1330, 90, 'Coyah', 'COY', 1),
(1331, 90, 'Dabola', 'DBL', 1),
(1332, 90, 'Dalaba', 'DLB', 1),
(1333, 90, 'Dinguiraye', 'DGR', 1),
(1334, 90, 'Dubreka', 'DBR', 1),
(1335, 90, 'Faranah', 'FRN', 1),
(1336, 90, 'Forecariah', 'FRC', 1),
(1337, 90, 'Fria', 'FRI', 1),
(1338, 90, 'Gaoual', 'GAO', 1),
(1339, 90, 'Gueckedou', 'GCD', 1),
(1340, 90, 'Kankan', 'KNK', 1),
(1341, 90, 'Kerouane', 'KRN', 1),
(1342, 90, 'Kindia', 'KND', 1),
(1343, 90, 'Kissidougou', 'KSD', 1),
(1344, 90, 'Koubia', 'KBA', 1),
(1345, 90, 'Koundara', 'KDA', 1),
(1346, 90, 'Kouroussa', 'KRA', 1),
(1347, 90, 'Labe', 'LAB', 1),
(1348, 90, 'Lelouma', 'LLM', 1),
(1349, 90, 'Lola', 'LOL', 1),
(1350, 90, 'Macenta', 'MCT', 1),
(1351, 90, 'Mali', 'MAL', 1),
(1352, 90, 'Mamou', 'MAM', 1),
(1353, 90, 'Mandiana', 'MAN', 1),
(1354, 90, 'Nzerekore', 'NZR', 1),
(1355, 90, 'Pita', 'PIT', 1),
(1356, 90, 'Siguiri', 'SIG', 1),
(1357, 90, 'Telimele', 'TLM', 1),
(1358, 90, 'Tougue', 'TOG', 1),
(1359, 90, 'Yomou', 'YOM', 1),
(1360, 91, 'Bafata Region', 'BF', 1),
(1361, 91, 'Biombo Region', 'BB', 1),
(1362, 91, 'Bissau Region', 'BS', 1),
(1363, 91, 'Bolama Region', 'BL', 1),
(1364, 91, 'Cacheu Region', 'CA', 1),
(1365, 91, 'Gabu Region', 'GA', 1),
(1366, 91, 'Oio Region', 'OI', 1),
(1367, 91, 'Quinara Region', 'QU', 1),
(1368, 91, 'Tombali Region', 'TO', 1),
(1369, 92, 'Barima-Waini', 'BW', 1),
(1370, 92, 'Cuyuni-Mazaruni', 'CM', 1),
(1371, 92, 'Demerara-Mahaica', 'DM', 1),
(1372, 92, 'East Berbice-Corentyne', 'EC', 1),
(1373, 92, 'Essequibo Islands-West Demerara', 'EW', 1),
(1374, 92, 'Mahaica-Berbice', 'MB', 1),
(1375, 92, 'Pomeroon-Supenaam', 'PM', 1),
(1376, 92, 'Potaro-Siparuni', 'PI', 1),
(1377, 92, 'Upper Demerara-Berbice', 'UD', 1),
(1378, 92, 'Upper Takutu-Upper Essequibo', 'UT', 1),
(1379, 93, 'Artibonite', 'AR', 1),
(1380, 93, 'Centre', 'CE', 1),
(1381, 93, 'Grand\'Anse', 'GA', 1),
(1382, 93, 'Nord', 'ND', 1),
(1383, 93, 'Nord-Est', 'NE', 1),
(1384, 93, 'Nord-Ouest', 'NO', 1),
(1385, 93, 'Ouest', 'OU', 1),
(1386, 93, 'Sud', 'SD', 1),
(1387, 93, 'Sud-Est', 'SE', 1),
(1388, 94, 'Flat Island', 'F', 1),
(1389, 94, 'McDonald Island', 'M', 1),
(1390, 94, 'Shag Island', 'S', 1),
(1391, 94, 'Heard Island', 'H', 1),
(1392, 95, 'Atlantida', 'AT', 1),
(1393, 95, 'Choluteca', 'CH', 1),
(1394, 95, 'Colon', 'CL', 1),
(1395, 95, 'Comayagua', 'CM', 1),
(1396, 95, 'Copan', 'CP', 1),
(1397, 95, 'Cortes', 'CR', 1),
(1398, 95, 'El Paraiso', 'PA', 1),
(1399, 95, 'Francisco Morazan', 'FM', 1),
(1400, 95, 'Gracias a Dios', 'GD', 1),
(1401, 95, 'Intibuca', 'IN', 1),
(1402, 95, 'Islas de la Bahia (Bay Islands)', 'IB', 1),
(1403, 95, 'La Paz', 'PZ', 1),
(1404, 95, 'Lempira', 'LE', 1),
(1405, 95, 'Ocotepeque', 'OC', 1),
(1406, 95, 'Olancho', 'OL', 1),
(1407, 95, 'Santa Barbara', 'SB', 1),
(1408, 95, 'Valle', 'VA', 1),
(1409, 95, 'Yoro', 'YO', 1),
(1410, 96, 'Central and Western Hong Kong Island', 'HCW', 1),
(1411, 96, 'Eastern Hong Kong Island', 'HEA', 1),
(1412, 96, 'Southern Hong Kong Island', 'HSO', 1),
(1413, 96, 'Wan Chai Hong Kong Island', 'HWC', 1),
(1414, 96, 'Kowloon City Kowloon', 'KKC', 1),
(1415, 96, 'Kwun Tong Kowloon', 'KKT', 1),
(1416, 96, 'Sham Shui Po Kowloon', 'KSS', 1),
(1417, 96, 'Wong Tai Sin Kowloon', 'KWT', 1),
(1418, 96, 'Yau Tsim Mong Kowloon', 'KYT', 1),
(1419, 96, 'Islands New Territories', 'NIS', 1),
(1420, 96, 'Kwai Tsing New Territories', 'NKT', 1),
(1421, 96, 'North New Territories', 'NNO', 1),
(1422, 96, 'Sai Kung New Territories', 'NSK', 1),
(1423, 96, 'Sha Tin New Territories', 'NST', 1),
(1424, 96, 'Tai Po New Territories', 'NTP', 1),
(1425, 96, 'Tsuen Wan New Territories', 'NTW', 1),
(1426, 96, 'Tuen Mun New Territories', 'NTM', 1),
(1427, 96, 'Yuen Long New Territories', 'NYL', 1),
(1467, 98, 'Austurland', 'AL', 1),
(1468, 98, 'Hofuoborgarsvaeoi', 'HF', 1),
(1469, 98, 'Norourland eystra', 'NE', 1),
(1470, 98, 'Norourland vestra', 'NV', 1),
(1471, 98, 'Suourland', 'SL', 1),
(1472, 98, 'Suournes', 'SN', 1),
(1473, 98, 'Vestfiroir', 'VF', 1),
(1474, 98, 'Vesturland', 'VL', 1),
(1475, 99, 'Andaman and Nicobar Islands', 'AN', 1),
(1476, 99, 'Andhra Pradesh', 'AP', 1),
(1477, 99, 'Arunachal Pradesh', 'AR', 1),
(1478, 99, 'Assam', 'AS', 1),
(1479, 99, 'Bihar', 'BI', 1),
(1480, 99, 'Chandigarh', 'CH', 1),
(1481, 99, 'Dadra and Nagar Haveli', 'DA', 1),
(1482, 99, 'Daman and Diu', 'DM', 1),
(1483, 99, 'Delhi', 'DE', 1),
(1484, 99, 'Goa', 'GO', 1),
(1485, 99, 'Gujarat', 'GU', 1),
(1486, 99, 'Haryana', 'HA', 1),
(1487, 99, 'Himachal Pradesh', 'HP', 1),
(1488, 99, 'Jammu and Kashmir', 'JA', 1),
(1489, 99, 'Karnataka', 'KA', 1),
(1490, 99, 'Kerala', 'KE', 1),
(1491, 99, 'Lakshadweep Islands', 'LI', 1),
(1492, 99, 'Madhya Pradesh', 'MP', 1),
(1493, 99, 'Maharashtra', 'MA', 1),
(1494, 99, 'Manipur', 'MN', 1),
(1495, 99, 'Meghalaya', 'ME', 1),
(1496, 99, 'Mizoram', 'MI', 1),
(1497, 99, 'Nagaland', 'NA', 1),
(1498, 99, 'Orissa', 'OR', 1),
(1499, 99, 'Puducherry', 'PO', 1),
(1500, 99, 'Punjab', 'PU', 1),
(1501, 99, 'Rajasthan', 'RA', 1),
(1502, 99, 'Sikkim', 'SI', 1),
(1503, 99, 'Tamil Nadu', 'TN', 1),
(1504, 99, 'Tripura', 'TR', 1),
(1505, 99, 'Uttar Pradesh', 'UP', 1),
(1506, 99, 'West Bengal', 'WB', 1),
(1507, 100, 'Aceh', 'AC', 1),
(1508, 100, 'Bali', 'BA', 1),
(1509, 100, 'Banten', 'BT', 1),
(1510, 100, 'Bengkulu', 'BE', 1),
(1511, 100, 'Kalimantan Utara', 'BD', 1),
(1512, 100, 'Gorontalo', 'GO', 1),
(1513, 100, 'Jakarta', 'JK', 1),
(1514, 100, 'Jambi', 'JA', 1),
(1515, 100, 'Jawa Barat', 'JB', 1),
(1516, 100, 'Jawa Tengah', 'JT', 1),
(1517, 100, 'Jawa Timur', 'JI', 1),
(1518, 100, 'Kalimantan Barat', 'KB', 1),
(1519, 100, 'Kalimantan Selatan', 'KS', 1),
(1520, 100, 'Kalimantan Tengah', 'KT', 1),
(1521, 100, 'Kalimantan Timur', 'KI', 1),
(1522, 100, 'Kepulauan Bangka Belitung', 'BB', 1),
(1523, 100, 'Lampung', 'LA', 1),
(1524, 100, 'Maluku', 'MA', 1),
(1525, 100, 'Maluku Utara', 'MU', 1),
(1526, 100, 'Nusa Tenggara Barat', 'NB', 1),
(1527, 100, 'Nusa Tenggara Timur', 'NT', 1),
(1528, 100, 'Papua', 'PA', 1),
(1529, 100, 'Riau', 'RI', 1),
(1530, 100, 'Sulawesi Selatan', 'SN', 1),
(1531, 100, 'Sulawesi Tengah', 'ST', 1),
(1532, 100, 'Sulawesi Tenggara', 'SG', 1),
(1533, 100, 'Sulawesi Utara', 'SA', 1),
(1534, 100, 'Sumatera Barat', 'SB', 1),
(1535, 100, 'Sumatera Selatan', 'SS', 1),
(1536, 100, 'Sumatera Utara', 'SU', 1),
(1537, 100, 'Yogyakarta', 'YO', 1),
(1538, 101, 'Tehran', 'TEH', 1),
(1539, 101, 'Qom', 'QOM', 1),
(1540, 101, 'Markazi', 'MKZ', 1),
(1541, 101, 'Qazvin', 'QAZ', 1),
(1542, 101, 'Gilan', 'GIL', 1),
(1543, 101, 'Ardabil', 'ARD', 1),
(1544, 101, 'Zanjan', 'ZAN', 1),
(1545, 101, 'East Azarbaijan', 'EAZ', 1),
(1546, 101, 'West Azarbaijan', 'WEZ', 1),
(1547, 101, 'Kurdistan', 'KRD', 1),
(1548, 101, 'Hamadan', 'HMD', 1),
(1549, 101, 'Kermanshah', 'KRM', 1),
(1550, 101, 'Ilam', 'ILM', 1),
(1551, 101, 'Lorestan', 'LRS', 1),
(1552, 101, 'Khuzestan', 'KZT', 1),
(1553, 101, 'Chahar Mahaal and Bakhtiari', 'CMB', 1),
(1554, 101, 'Kohkiluyeh and Buyer Ahmad', 'KBA', 1),
(1555, 101, 'Bushehr', 'BSH', 1),
(1556, 101, 'Fars', 'FAR', 1),
(1557, 101, 'Hormozgan', 'HRM', 1),
(1558, 101, 'Sistan and Baluchistan', 'SBL', 1),
(1559, 101, 'Kerman', 'KRB', 1),
(1560, 101, 'Yazd', 'YZD', 1),
(1561, 101, 'Esfahan', 'EFH', 1),
(1562, 101, 'Semnan', 'SMN', 1),
(1563, 101, 'Mazandaran', 'MZD', 1),
(1564, 101, 'Golestan', 'GLS', 1),
(1565, 101, 'North Khorasan', 'NKH', 1),
(1566, 101, 'Razavi Khorasan', 'RKH', 1),
(1567, 101, 'South Khorasan', 'SKH', 1),
(1568, 102, 'Baghdad', 'BD', 1),
(1569, 102, 'Salah ad Din', 'SD', 1),
(1570, 102, 'Diyala', 'DY', 1),
(1571, 102, 'Wasit', 'WS', 1),
(1572, 102, 'Maysan', 'MY', 1),
(1573, 102, 'Al Basrah', 'BA', 1),
(1574, 102, 'Dhi Qar', 'DQ', 1),
(1575, 102, 'Al Muthanna', 'MU', 1),
(1576, 102, 'Al Qadisyah', 'QA', 1),
(1577, 102, 'Babil', 'BB', 1),
(1578, 102, 'Al Karbala', 'KB', 1),
(1579, 102, 'An Najaf', 'NJ', 1),
(1580, 102, 'Al Anbar', 'AB', 1),
(1581, 102, 'Ninawa', 'NN', 1),
(1582, 102, 'Dahuk', 'DH', 1),
(1583, 102, 'Arbil', 'AL', 1),
(1584, 102, 'At Ta\'mim', 'TM', 1),
(1585, 102, 'As Sulaymaniyah', 'SL', 1),
(1586, 103, 'Carlow', 'CA', 1),
(1587, 103, 'Cavan', 'CV', 1),
(1588, 103, 'Clare', 'CL', 1),
(1589, 103, 'Cork', 'CO', 1),
(1590, 103, 'Donegal', 'DO', 1),
(1591, 103, 'Dublin', 'DU', 1),
(1592, 103, 'Galway', 'GA', 1),
(1593, 103, 'Kerry', 'KE', 1),
(1594, 103, 'Kildare', 'KI', 1),
(1595, 103, 'Kilkenny', 'KL', 1),
(1596, 103, 'Laois', 'LA', 1),
(1597, 103, 'Leitrim', 'LE', 1);
INSERT INTO `ci_country_zones` (`zone_id`, `country_id`, `name`, `code`, `enabled`) VALUES
(1598, 103, 'Limerick', 'LI', 1),
(1599, 103, 'Longford', 'LO', 1),
(1600, 103, 'Louth', 'LU', 1),
(1601, 103, 'Mayo', 'MA', 1),
(1602, 103, 'Meath', 'ME', 1),
(1603, 103, 'Monaghan', 'MO', 1),
(1604, 103, 'Offaly', 'OF', 1),
(1605, 103, 'Roscommon', 'RO', 1),
(1606, 103, 'Sligo', 'SL', 1),
(1607, 103, 'Tipperary', 'TI', 1),
(1608, 103, 'Waterford', 'WA', 1),
(1609, 103, 'Westmeath', 'WE', 1),
(1610, 103, 'Wexford', 'WX', 1),
(1611, 103, 'Wicklow', 'WI', 1),
(1612, 104, 'Be\'er Sheva', 'BS', 1),
(1613, 104, 'Bika\'at Hayarden', 'BH', 1),
(1614, 104, 'Eilat and Arava', 'EA', 1),
(1615, 104, 'Galil', 'GA', 1),
(1616, 104, 'Haifa', 'HA', 1),
(1617, 104, 'Jehuda Mountains', 'JM', 1),
(1618, 104, 'Jerusalem', 'JE', 1),
(1619, 104, 'Negev', 'NE', 1),
(1620, 104, 'Semaria', 'SE', 1),
(1621, 104, 'Sharon', 'SH', 1),
(1622, 104, 'Tel Aviv (Gosh Dan)', 'TA', 1),
(1643, 106, 'Clarendon Parish', 'CLA', 1),
(1644, 106, 'Hanover Parish', 'HAN', 1),
(1645, 106, 'Kingston Parish', 'KIN', 1),
(1646, 106, 'Manchester Parish', 'MAN', 1),
(1647, 106, 'Portland Parish', 'POR', 1),
(1648, 106, 'Saint Andrew Parish', 'AND', 1),
(1649, 106, 'Saint Ann Parish', 'ANN', 1),
(1650, 106, 'Saint Catherine Parish', 'CAT', 1),
(1651, 106, 'Saint Elizabeth Parish', 'ELI', 1),
(1652, 106, 'Saint James Parish', 'JAM', 1),
(1653, 106, 'Saint Mary Parish', 'MAR', 1),
(1654, 106, 'Saint Thomas Parish', 'THO', 1),
(1655, 106, 'Trelawny Parish', 'TRL', 1),
(1656, 106, 'Westmoreland Parish', 'WML', 1),
(1657, 107, 'Aichi', 'AI', 1),
(1658, 107, 'Akita', 'AK', 1),
(1659, 107, 'Aomori', 'AO', 1),
(1660, 107, 'Chiba', 'CH', 1),
(1661, 107, 'Ehime', 'EH', 1),
(1662, 107, 'Fukui', 'FK', 1),
(1663, 107, 'Fukuoka', 'FU', 1),
(1664, 107, 'Fukushima', 'FS', 1),
(1665, 107, 'Gifu', 'GI', 1),
(1666, 107, 'Gumma', 'GU', 1),
(1667, 107, 'Hiroshima', 'HI', 1),
(1668, 107, 'Hokkaido', 'HO', 1),
(1669, 107, 'Hyogo', 'HY', 1),
(1670, 107, 'Ibaraki', 'IB', 1),
(1671, 107, 'Ishikawa', 'IS', 1),
(1672, 107, 'Iwate', 'IW', 1),
(1673, 107, 'Kagawa', 'KA', 1),
(1674, 107, 'Kagoshima', 'KG', 1),
(1675, 107, 'Kanagawa', 'KN', 1),
(1676, 107, 'Kochi', 'KO', 1),
(1677, 107, 'Kumamoto', 'KU', 1),
(1678, 107, 'Kyoto', 'KY', 1),
(1679, 107, 'Mie', 'MI', 1),
(1680, 107, 'Miyagi', 'MY', 1),
(1681, 107, 'Miyazaki', 'MZ', 1),
(1682, 107, 'Nagano', 'NA', 1),
(1683, 107, 'Nagasaki', 'NG', 1),
(1684, 107, 'Nara', 'NR', 1),
(1685, 107, 'Niigata', 'NI', 1),
(1686, 107, 'Oita', 'OI', 1),
(1687, 107, 'Okayama', 'OK', 1),
(1688, 107, 'Okinawa', 'ON', 1),
(1689, 107, 'Osaka', 'OS', 1),
(1690, 107, 'Saga', 'SA', 1),
(1691, 107, 'Saitama', 'SI', 1),
(1692, 107, 'Shiga', 'SH', 1),
(1693, 107, 'Shimane', 'SM', 1),
(1694, 107, 'Shizuoka', 'SZ', 1),
(1695, 107, 'Tochigi', 'TO', 1),
(1696, 107, 'Tokushima', 'TS', 1),
(1697, 107, 'Tokyo', 'TK', 1),
(1698, 107, 'Tottori', 'TT', 1),
(1699, 107, 'Toyama', 'TY', 1),
(1700, 107, 'Wakayama', 'WA', 1),
(1701, 107, 'Yamagata', 'YA', 1),
(1702, 107, 'Yamaguchi', 'YM', 1),
(1703, 107, 'Yamanashi', 'YN', 1),
(1704, 108, '\'Amman', 'AM', 1),
(1705, 108, 'Ajlun', 'AJ', 1),
(1706, 108, 'Al \'Aqabah', 'AA', 1),
(1707, 108, 'Al Balqa\'', 'AB', 1),
(1708, 108, 'Al Karak', 'AK', 1),
(1709, 108, 'Al Mafraq', 'AL', 1),
(1710, 108, 'At Tafilah', 'AT', 1),
(1711, 108, 'Az Zarqa\'', 'AZ', 1),
(1712, 108, 'Irbid', 'IR', 1),
(1713, 108, 'Jarash', 'JA', 1),
(1714, 108, 'Ma\'an', 'MA', 1),
(1715, 108, 'Madaba', 'MD', 1),
(1716, 109, 'Almaty', 'AL', 1),
(1717, 109, 'Almaty City', 'AC', 1),
(1718, 109, 'Aqmola', 'AM', 1),
(1719, 109, 'Aqtobe', 'AQ', 1),
(1720, 109, 'Astana City', 'AS', 1),
(1721, 109, 'Atyrau', 'AT', 1),
(1722, 109, 'Batys Qazaqstan', 'BA', 1),
(1723, 109, 'Bayqongyr City', 'BY', 1),
(1724, 109, 'Mangghystau', 'MA', 1),
(1725, 109, 'Ongtustik Qazaqstan', 'ON', 1),
(1726, 109, 'Pavlodar', 'PA', 1),
(1727, 109, 'Qaraghandy', 'QA', 1),
(1728, 109, 'Qostanay', 'QO', 1),
(1729, 109, 'Qyzylorda', 'QY', 1),
(1730, 109, 'Shyghys Qazaqstan', 'SH', 1),
(1731, 109, 'Soltustik Qazaqstan', 'SO', 1),
(1732, 109, 'Zhambyl', 'ZH', 1),
(1733, 110, 'Central', 'CE', 1),
(1734, 110, 'Coast', 'CO', 1),
(1735, 110, 'Eastern', 'EA', 1),
(1736, 110, 'Nairobi Area', 'NA', 1),
(1737, 110, 'North Eastern', 'NE', 1),
(1738, 110, 'Nyanza', 'NY', 1),
(1739, 110, 'Rift Valley', 'RV', 1),
(1740, 110, 'Western', 'WE', 1),
(1741, 111, 'Abaiang', 'AG', 1),
(1742, 111, 'Abemama', 'AM', 1),
(1743, 111, 'Aranuka', 'AK', 1),
(1744, 111, 'Arorae', 'AO', 1),
(1745, 111, 'Banaba', 'BA', 1),
(1746, 111, 'Beru', 'BE', 1),
(1747, 111, 'Butaritari', 'bT', 1),
(1748, 111, 'Kanton', 'KA', 1),
(1749, 111, 'Kiritimati', 'KR', 1),
(1750, 111, 'Kuria', 'KU', 1),
(1751, 111, 'Maiana', 'MI', 1),
(1752, 111, 'Makin', 'MN', 1),
(1753, 111, 'Marakei', 'ME', 1),
(1754, 111, 'Nikunau', 'NI', 1),
(1755, 111, 'Nonouti', 'NO', 1),
(1756, 111, 'Onotoa', 'ON', 1),
(1757, 111, 'Tabiteuea', 'TT', 1),
(1758, 111, 'Tabuaeran', 'TR', 1),
(1759, 111, 'Tamana', 'TM', 1),
(1760, 111, 'Tarawa', 'TW', 1),
(1761, 111, 'Teraina', 'TE', 1),
(1762, 112, 'Chagang-do', 'CHA', 1),
(1763, 112, 'Hamgyong-bukto', 'HAB', 1),
(1764, 112, 'Hamgyong-namdo', 'HAN', 1),
(1765, 112, 'Hwanghae-bukto', 'HWB', 1),
(1766, 112, 'Hwanghae-namdo', 'HWN', 1),
(1767, 112, 'Kangwon-do', 'KAN', 1),
(1768, 112, 'P\'yongan-bukto', 'PYB', 1),
(1769, 112, 'P\'yongan-namdo', 'PYN', 1),
(1770, 112, 'Ryanggang-do (Yanggang-do)', 'YAN', 1),
(1771, 112, 'Rason Directly Governed City', 'NAJ', 1),
(1772, 112, 'P\'yongyang Special City', 'PYO', 1),
(1773, 113, 'Ch\'ungch\'ong-bukto', 'CO', 1),
(1774, 113, 'Ch\'ungch\'ong-namdo', 'CH', 1),
(1775, 113, 'Cheju-do', 'CD', 1),
(1776, 113, 'Cholla-bukto', 'CB', 1),
(1777, 113, 'Cholla-namdo', 'CN', 1),
(1778, 113, 'Inch\'on-gwangyoksi', 'IG', 1),
(1779, 113, 'Kangwon-do', 'KA', 1),
(1780, 113, 'Kwangju-gwangyoksi', 'KG', 1),
(1781, 113, 'Kyonggi-do', 'KD', 1),
(1782, 113, 'Kyongsang-bukto', 'KB', 1),
(1783, 113, 'Kyongsang-namdo', 'KN', 1),
(1784, 113, 'Pusan-gwangyoksi', 'PG', 1),
(1785, 113, 'Soul-t\'ukpyolsi', 'SO', 1),
(1786, 113, 'Taegu-gwangyoksi', 'TA', 1),
(1787, 113, 'Taejon-gwangyoksi', 'TG', 1),
(1788, 114, 'Al \'Asimah', 'AL', 1),
(1789, 114, 'Al Ahmadi', 'AA', 1),
(1790, 114, 'Al Farwaniyah', 'AF', 1),
(1791, 114, 'Al Jahra\'', 'AJ', 1),
(1792, 114, 'Hawalli', 'HA', 1),
(1793, 115, 'Bishkek', 'GB', 1),
(1794, 115, 'Batken', 'B', 1),
(1795, 115, 'Chu', 'C', 1),
(1796, 115, 'Jalal-Abad', 'J', 1),
(1797, 115, 'Naryn', 'N', 1),
(1798, 115, 'Osh', 'O', 1),
(1799, 115, 'Talas', 'T', 1),
(1800, 115, 'Ysyk-Kol', 'Y', 1),
(1801, 116, 'Vientiane', 'VT', 1),
(1802, 116, 'Attapu', 'AT', 1),
(1803, 116, 'Bokeo', 'BK', 1),
(1804, 116, 'Bolikhamxai', 'BL', 1),
(1805, 116, 'Champasak', 'CH', 1),
(1806, 116, 'Houaphan', 'HO', 1),
(1807, 116, 'Khammouan', 'KH', 1),
(1808, 116, 'Louang Namtha', 'LM', 1),
(1809, 116, 'Louangphabang', 'LP', 1),
(1810, 116, 'Oudomxai', 'OU', 1),
(1811, 116, 'Phongsali', 'PH', 1),
(1812, 116, 'Salavan', 'SL', 1),
(1813, 116, 'Savannakhet', 'SV', 1),
(1814, 116, 'Vientiane', 'VI', 1),
(1815, 116, 'Xaignabouli', 'XA', 1),
(1816, 116, 'Xekong', 'XE', 1),
(1817, 116, 'Xiangkhoang', 'XI', 1),
(1818, 116, 'Xaisomboun', 'XN', 1),
(1852, 119, 'Berea', 'BE', 1),
(1853, 119, 'Butha-Buthe', 'BB', 1),
(1854, 119, 'Leribe', 'LE', 1),
(1855, 119, 'Mafeteng', 'MF', 1),
(1856, 119, 'Maseru', 'MS', 1),
(1857, 119, 'Mohale\'s Hoek', 'MH', 1),
(1858, 119, 'Mokhotlong', 'MK', 1),
(1859, 119, 'Qacha\'s Nek', 'QN', 1),
(1860, 119, 'Quthing', 'QT', 1),
(1861, 119, 'Thaba-Tseka', 'TT', 1),
(1862, 120, 'Bomi', 'BI', 1),
(1863, 120, 'Bong', 'BG', 1),
(1864, 120, 'Grand Bassa', 'GB', 1),
(1865, 120, 'Grand Cape Mount', 'CM', 1),
(1866, 120, 'Grand Gedeh', 'GG', 1),
(1867, 120, 'Grand Kru', 'GK', 1),
(1868, 120, 'Lofa', 'LO', 1),
(1869, 120, 'Margibi', 'MG', 1),
(1870, 120, 'Maryland', 'ML', 1),
(1871, 120, 'Montserrado', 'MS', 1),
(1872, 120, 'Nimba', 'NB', 1),
(1873, 120, 'River Cess', 'RC', 1),
(1874, 120, 'Sinoe', 'SN', 1),
(1875, 121, 'Ajdabiya', 'AJ', 1),
(1876, 121, 'Al \'Aziziyah', 'AZ', 1),
(1877, 121, 'Al Fatih', 'FA', 1),
(1878, 121, 'Al Jabal al Akhdar', 'JA', 1),
(1879, 121, 'Al Jufrah', 'JU', 1),
(1880, 121, 'Al Khums', 'KH', 1),
(1881, 121, 'Al Kufrah', 'KU', 1),
(1882, 121, 'An Nuqat al Khams', 'NK', 1),
(1883, 121, 'Ash Shati\'', 'AS', 1),
(1884, 121, 'Awbari', 'AW', 1),
(1885, 121, 'Az Zawiyah', 'ZA', 1),
(1886, 121, 'Banghazi', 'BA', 1),
(1887, 121, 'Darnah', 'DA', 1),
(1888, 121, 'Ghadamis', 'GD', 1),
(1889, 121, 'Gharyan', 'GY', 1),
(1890, 121, 'Misratah', 'MI', 1),
(1891, 121, 'Murzuq', 'MZ', 1),
(1892, 121, 'Sabha', 'SB', 1),
(1893, 121, 'Sawfajjin', 'SW', 1),
(1894, 121, 'Surt', 'SU', 1),
(1895, 121, 'Tarabulus (Tripoli)', 'TL', 1),
(1896, 121, 'Tarhunah', 'TH', 1),
(1897, 121, 'Tubruq', 'TU', 1),
(1898, 121, 'Yafran', 'YA', 1),
(1899, 121, 'Zlitan', 'ZL', 1),
(1900, 122, 'Vaduz', 'V', 1),
(1901, 122, 'Schaan', 'A', 1),
(1902, 122, 'Balzers', 'B', 1),
(1903, 122, 'Triesen', 'N', 1),
(1904, 122, 'Eschen', 'E', 1),
(1905, 122, 'Mauren', 'M', 1),
(1906, 122, 'Triesenberg', 'T', 1),
(1907, 122, 'Ruggell', 'R', 1),
(1908, 122, 'Gamprin', 'G', 1),
(1909, 122, 'Schellenberg', 'L', 1),
(1910, 122, 'Planken', 'P', 1),
(1911, 123, 'Alytus', 'AL', 1),
(1912, 123, 'Kaunas', 'KA', 1),
(1913, 123, 'Klaipeda', 'KL', 1),
(1914, 123, 'Marijampole', 'MA', 1),
(1915, 123, 'Panevezys', 'PA', 1),
(1916, 123, 'Siauliai', 'SI', 1),
(1917, 123, 'Taurage', 'TA', 1),
(1918, 123, 'Telsiai', 'TE', 1),
(1919, 123, 'Utena', 'UT', 1),
(1920, 123, 'Vilnius', 'VI', 1),
(1921, 124, 'Diekirch', 'DD', 1),
(1922, 124, 'Clervaux', 'DC', 1),
(1923, 124, 'Redange', 'DR', 1),
(1924, 124, 'Vianden', 'DV', 1),
(1925, 124, 'Wiltz', 'DW', 1),
(1926, 124, 'Grevenmacher', 'GG', 1),
(1927, 124, 'Echternach', 'GE', 1),
(1928, 124, 'Remich', 'GR', 1),
(1929, 124, 'Luxembourg', 'LL', 1),
(1930, 124, 'Capellen', 'LC', 1),
(1931, 124, 'Esch-sur-Alzette', 'LE', 1),
(1932, 124, 'Mersch', 'LM', 1),
(1933, 125, 'Our Lady Fatima Parish', 'OLF', 1),
(1934, 125, 'St. Anthony Parish', 'ANT', 1),
(1935, 125, 'St. Lazarus Parish', 'LAZ', 1),
(1936, 125, 'Cathedral Parish', 'CAT', 1),
(1937, 125, 'St. Lawrence Parish', 'LAW', 1),
(1938, 127, 'Antananarivo', 'AN', 1),
(1939, 127, 'Antsiranana', 'AS', 1),
(1940, 127, 'Fianarantsoa', 'FN', 1),
(1941, 127, 'Mahajanga', 'MJ', 1),
(1942, 127, 'Toamasina', 'TM', 1),
(1943, 127, 'Toliara', 'TL', 1),
(1944, 128, 'Balaka', 'BLK', 1),
(1945, 128, 'Blantyre', 'BLT', 1),
(1946, 128, 'Chikwawa', 'CKW', 1),
(1947, 128, 'Chiradzulu', 'CRD', 1),
(1948, 128, 'Chitipa', 'CTP', 1),
(1949, 128, 'Dedza', 'DDZ', 1),
(1950, 128, 'Dowa', 'DWA', 1),
(1951, 128, 'Karonga', 'KRG', 1),
(1952, 128, 'Kasungu', 'KSG', 1),
(1953, 128, 'Likoma', 'LKM', 1),
(1954, 128, 'Lilongwe', 'LLG', 1),
(1955, 128, 'Machinga', 'MCG', 1),
(1956, 128, 'Mangochi', 'MGC', 1),
(1957, 128, 'Mchinji', 'MCH', 1),
(1958, 128, 'Mulanje', 'MLJ', 1),
(1959, 128, 'Mwanza', 'MWZ', 1),
(1960, 128, 'Mzimba', 'MZM', 1),
(1961, 128, 'Ntcheu', 'NTU', 1),
(1962, 128, 'Nkhata Bay', 'NKB', 1),
(1963, 128, 'Nkhotakota', 'NKH', 1),
(1964, 128, 'Nsanje', 'NSJ', 1),
(1965, 128, 'Ntchisi', 'NTI', 1),
(1966, 128, 'Phalombe', 'PHL', 1),
(1967, 128, 'Rumphi', 'RMP', 1),
(1968, 128, 'Salima', 'SLM', 1),
(1969, 128, 'Thyolo', 'THY', 1),
(1970, 128, 'Zomba', 'ZBA', 1),
(1971, 129, 'Johor', 'MY-01', 1),
(1972, 129, 'Kedah', 'MY-02', 1),
(1973, 129, 'Kelantan', 'MY-03', 1),
(1974, 129, 'Labuan', 'MY-15', 1),
(1975, 129, 'Melaka', 'MY-04', 1),
(1976, 129, 'Negeri Sembilan', 'MY-05', 1),
(1977, 129, 'Pahang', 'MY-06', 1),
(1978, 129, 'Perak', 'MY-08', 1),
(1979, 129, 'Perlis', 'MY-09', 1),
(1980, 129, 'Pulau Pinang', 'MY-07', 1),
(1981, 129, 'Sabah', 'MY-12', 1),
(1982, 129, 'Sarawak', 'MY-13', 1),
(1983, 129, 'Selangor', 'MY-10', 1),
(1984, 129, 'Terengganu', 'MY-11', 1),
(1985, 129, 'Kuala Lumpur', 'MY-14', 1),
(1986, 130, 'Thiladhunmathi Uthuru', 'THU', 1),
(1987, 130, 'Thiladhunmathi Dhekunu', 'THD', 1),
(1988, 130, 'Miladhunmadulu Uthuru', 'MLU', 1),
(1989, 130, 'Miladhunmadulu Dhekunu', 'MLD', 1),
(1990, 130, 'Maalhosmadulu Uthuru', 'MAU', 1),
(1991, 130, 'Maalhosmadulu Dhekunu', 'MAD', 1),
(1992, 130, 'Faadhippolhu', 'FAA', 1),
(1993, 130, 'Male Atoll', 'MAA', 1),
(1994, 130, 'Ari Atoll Uthuru', 'AAU', 1),
(1995, 130, 'Ari Atoll Dheknu', 'AAD', 1),
(1996, 130, 'Felidhe Atoll', 'FEA', 1),
(1997, 130, 'Mulaku Atoll', 'MUA', 1),
(1998, 130, 'Nilandhe Atoll Uthuru', 'NAU', 1),
(1999, 130, 'Nilandhe Atoll Dhekunu', 'NAD', 1),
(2000, 130, 'Kolhumadulu', 'KLH', 1),
(2001, 130, 'Hadhdhunmathi', 'HDH', 1),
(2002, 130, 'Huvadhu Atoll Uthuru', 'HAU', 1),
(2003, 130, 'Huvadhu Atoll Dhekunu', 'HAD', 1),
(2004, 130, 'Fua Mulaku', 'FMU', 1),
(2005, 130, 'Addu', 'ADD', 1),
(2006, 131, 'Gao', 'GA', 1),
(2007, 131, 'Kayes', 'KY', 1),
(2008, 131, 'Kidal', 'KD', 1),
(2009, 131, 'Koulikoro', 'KL', 1),
(2010, 131, 'Mopti', 'MP', 1),
(2011, 131, 'Segou', 'SG', 1),
(2012, 131, 'Sikasso', 'SK', 1),
(2013, 131, 'Tombouctou', 'TB', 1),
(2014, 131, 'Bamako Capital District', 'CD', 1),
(2015, 132, 'Attard', 'ATT', 1),
(2016, 132, 'Balzan', 'BAL', 1),
(2017, 132, 'Birgu', 'BGU', 1),
(2018, 132, 'Birkirkara', 'BKK', 1),
(2019, 132, 'Birzebbuga', 'BRZ', 1),
(2020, 132, 'Bormla', 'BOR', 1),
(2021, 132, 'Dingli', 'DIN', 1),
(2022, 132, 'Fgura', 'FGU', 1),
(2023, 132, 'Floriana', 'FLO', 1),
(2024, 132, 'Gudja', 'GDJ', 1),
(2025, 132, 'Gzira', 'GZR', 1),
(2026, 132, 'Gargur', 'GRG', 1),
(2027, 132, 'Gaxaq', 'GXQ', 1),
(2028, 132, 'Hamrun', 'HMR', 1),
(2029, 132, 'Iklin', 'IKL', 1),
(2030, 132, 'Isla', 'ISL', 1),
(2031, 132, 'Kalkara', 'KLK', 1),
(2032, 132, 'Kirkop', 'KRK', 1),
(2033, 132, 'Lija', 'LIJ', 1),
(2034, 132, 'Luqa', 'LUQ', 1),
(2035, 132, 'Marsa', 'MRS', 1),
(2036, 132, 'Marsaskala', 'MKL', 1),
(2037, 132, 'Marsaxlokk', 'MXL', 1),
(2038, 132, 'Mdina', 'MDN', 1),
(2039, 132, 'Melliea', 'MEL', 1),
(2040, 132, 'Mgarr', 'MGR', 1),
(2041, 132, 'Mosta', 'MST', 1),
(2042, 132, 'Mqabba', 'MQA', 1),
(2043, 132, 'Msida', 'MSI', 1),
(2044, 132, 'Mtarfa', 'MTF', 1),
(2045, 132, 'Naxxar', 'NAX', 1),
(2046, 132, 'Paola', 'PAO', 1),
(2047, 132, 'Pembroke', 'PEM', 1),
(2048, 132, 'Pieta', 'PIE', 1),
(2049, 132, 'Qormi', 'QOR', 1),
(2050, 132, 'Qrendi', 'QRE', 1),
(2051, 132, 'Rabat', 'RAB', 1),
(2052, 132, 'Safi', 'SAF', 1),
(2053, 132, 'San Giljan', 'SGI', 1),
(2054, 132, 'Santa Lucija', 'SLU', 1),
(2055, 132, 'San Pawl il-Bahar', 'SPB', 1),
(2056, 132, 'San Gwann', 'SGW', 1),
(2057, 132, 'Santa Venera', 'SVE', 1),
(2058, 132, 'Siggiewi', 'SIG', 1),
(2059, 132, 'Sliema', 'SLM', 1),
(2060, 132, 'Swieqi', 'SWQ', 1),
(2061, 132, 'Ta Xbiex', 'TXB', 1),
(2062, 132, 'Tarxien', 'TRX', 1),
(2063, 132, 'Valletta', 'VLT', 1),
(2064, 132, 'Xgajra', 'XGJ', 1),
(2065, 132, 'Zabbar', 'ZBR', 1),
(2066, 132, 'Zebbug', 'ZBG', 1),
(2067, 132, 'Zejtun', 'ZJT', 1),
(2068, 132, 'Zurrieq', 'ZRQ', 1),
(2069, 132, 'Fontana', 'FNT', 1),
(2070, 132, 'Ghajnsielem', 'GHJ', 1),
(2071, 132, 'Gharb', 'GHR', 1),
(2072, 132, 'Ghasri', 'GHS', 1),
(2073, 132, 'Kercem', 'KRC', 1),
(2074, 132, 'Munxar', 'MUN', 1),
(2075, 132, 'Nadur', 'NAD', 1),
(2076, 132, 'Qala', 'QAL', 1),
(2077, 132, 'Victoria', 'VIC', 1),
(2078, 132, 'San Lawrenz', 'SLA', 1),
(2079, 132, 'Sannat', 'SNT', 1),
(2080, 132, 'Xagra', 'ZAG', 1),
(2081, 132, 'Xewkija', 'XEW', 1),
(2082, 132, 'Zebbug', 'ZEB', 1),
(2083, 133, 'Ailinginae', 'ALG', 1),
(2084, 133, 'Ailinglaplap', 'ALL', 1),
(2085, 133, 'Ailuk', 'ALK', 1),
(2086, 133, 'Arno', 'ARN', 1),
(2087, 133, 'Aur', 'AUR', 1),
(2088, 133, 'Bikar', 'BKR', 1),
(2089, 133, 'Bikini', 'BKN', 1),
(2090, 133, 'Bokak', 'BKK', 1),
(2091, 133, 'Ebon', 'EBN', 1),
(2092, 133, 'Enewetak', 'ENT', 1),
(2093, 133, 'Erikub', 'EKB', 1),
(2094, 133, 'Jabat', 'JBT', 1),
(2095, 133, 'Jaluit', 'JLT', 1),
(2096, 133, 'Jemo', 'JEM', 1),
(2097, 133, 'Kili', 'KIL', 1),
(2098, 133, 'Kwajalein', 'KWJ', 1),
(2099, 133, 'Lae', 'LAE', 1),
(2100, 133, 'Lib', 'LIB', 1),
(2101, 133, 'Likiep', 'LKP', 1),
(2102, 133, 'Majuro', 'MJR', 1),
(2103, 133, 'Maloelap', 'MLP', 1),
(2104, 133, 'Mejit', 'MJT', 1),
(2105, 133, 'Mili', 'MIL', 1),
(2106, 133, 'Namorik', 'NMK', 1),
(2107, 133, 'Namu', 'NAM', 1),
(2108, 133, 'Rongelap', 'RGL', 1),
(2109, 133, 'Rongrik', 'RGK', 1),
(2110, 133, 'Toke', 'TOK', 1),
(2111, 133, 'Ujae', 'UJA', 1),
(2112, 133, 'Ujelang', 'UJL', 1),
(2113, 133, 'Utirik', 'UTK', 1),
(2114, 133, 'Wotho', 'WTH', 1),
(2115, 133, 'Wotje', 'WTJ', 1),
(2116, 135, 'Adrar', 'AD', 1),
(2117, 135, 'Assaba', 'AS', 1),
(2118, 135, 'Brakna', 'BR', 1),
(2119, 135, 'Dakhlet Nouadhibou', 'DN', 1),
(2120, 135, 'Gorgol', 'GO', 1),
(2121, 135, 'Guidimaka', 'GM', 1),
(2122, 135, 'Hodh Ech Chargui', 'HC', 1),
(2123, 135, 'Hodh El Gharbi', 'HG', 1),
(2124, 135, 'Inchiri', 'IN', 1),
(2125, 135, 'Tagant', 'TA', 1),
(2126, 135, 'Tiris Zemmour', 'TZ', 1),
(2127, 135, 'Trarza', 'TR', 1),
(2128, 135, 'Nouakchott', 'NO', 1),
(2129, 136, 'Beau Bassin-Rose Hill', 'BR', 1),
(2130, 136, 'Curepipe', 'CU', 1),
(2131, 136, 'Port Louis', 'PU', 1),
(2132, 136, 'Quatre Bornes', 'QB', 1),
(2133, 136, 'Vacoas-Phoenix', 'VP', 1),
(2134, 136, 'Agalega Islands', 'AG', 1),
(2135, 136, 'Cargados Carajos Shoals (Saint Brandon Islands)', 'CC', 1),
(2136, 136, 'Rodrigues', 'RO', 1),
(2137, 136, 'Black River', 'BL', 1),
(2138, 136, 'Flacq', 'FL', 1),
(2139, 136, 'Grand Port', 'GP', 1),
(2140, 136, 'Moka', 'MO', 1),
(2141, 136, 'Pamplemousses', 'PA', 1),
(2142, 136, 'Plaines Wilhems', 'PW', 1),
(2143, 136, 'Port Louis', 'PL', 1),
(2144, 136, 'Riviere du Rempart', 'RR', 1),
(2145, 136, 'Savanne', 'SA', 1),
(2146, 138, 'Baja California Norte', 'BN', 1),
(2147, 138, 'Baja California Sur', 'BS', 1),
(2148, 138, 'Campeche', 'CA', 1),
(2149, 138, 'Chiapas', 'CI', 1),
(2150, 138, 'Chihuahua', 'CH', 1),
(2151, 138, 'Coahuila de Zaragoza', 'CZ', 1),
(2152, 138, 'Colima', 'CL', 1),
(2153, 138, 'Distrito Federal', 'DF', 1),
(2154, 138, 'Durango', 'DU', 1),
(2155, 138, 'Guanajuato', 'GA', 1),
(2156, 138, 'Guerrero', 'GE', 1),
(2157, 138, 'Hidalgo', 'HI', 1),
(2158, 138, 'Jalisco', 'JA', 1),
(2159, 138, 'Mexico', 'ME', 1),
(2160, 138, 'Michoacan de Ocampo', 'MI', 1),
(2161, 138, 'Morelos', 'MO', 1),
(2162, 138, 'Nayarit', 'NA', 1),
(2163, 138, 'Nuevo Leon', 'NL', 1),
(2164, 138, 'Oaxaca', 'OA', 1),
(2165, 138, 'Puebla', 'PU', 1),
(2166, 138, 'Queretaro de Arteaga', 'QA', 1),
(2167, 138, 'Quintana Roo', 'QR', 1),
(2168, 138, 'San Luis Potosi', 'SA', 1),
(2169, 138, 'Sinaloa', 'SI', 1),
(2170, 138, 'Sonora', 'SO', 1),
(2171, 138, 'Tabasco', 'TB', 1),
(2172, 138, 'Tamaulipas', 'TM', 1),
(2173, 138, 'Tlaxcala', 'TL', 1),
(2174, 138, 'Veracruz-Llave', 'VE', 1),
(2175, 138, 'Yucatan', 'YU', 1),
(2176, 138, 'Zacatecas', 'ZA', 1),
(2177, 139, 'Chuuk', 'C', 1),
(2178, 139, 'Kosrae', 'K', 1),
(2179, 139, 'Pohnpei', 'P', 1),
(2180, 139, 'Yap', 'Y', 1),
(2181, 140, 'Gagauzia', 'GA', 1),
(2182, 140, 'Chisinau', 'CU', 1),
(2183, 140, 'Balti', 'BA', 1),
(2184, 140, 'Cahul', 'CA', 1),
(2185, 140, 'Edinet', 'ED', 1),
(2186, 140, 'Lapusna', 'LA', 1),
(2187, 140, 'Orhei', 'OR', 1),
(2188, 140, 'Soroca', 'SO', 1),
(2189, 140, 'Tighina', 'TI', 1),
(2190, 140, 'Ungheni', 'UN', 1),
(2191, 140, 'St‚nga Nistrului', 'SN', 1),
(2192, 141, 'Fontvieille', 'FV', 1),
(2193, 141, 'La Condamine', 'LC', 1),
(2194, 141, 'Monaco-Ville', 'MV', 1),
(2195, 141, 'Monte-Carlo', 'MC', 1),
(2196, 142, 'Ulanbaatar', '1', 1),
(2197, 142, 'Orhon', '035', 1),
(2198, 142, 'Darhan uul', '037', 1),
(2199, 142, 'Hentiy', '039', 1),
(2200, 142, 'Hovsgol', '041', 1),
(2201, 142, 'Hovd', '043', 1),
(2202, 142, 'Uvs', '046', 1),
(2203, 142, 'Tov', '047', 1),
(2204, 142, 'Selenge', '049', 1),
(2205, 142, 'Suhbaatar', '051', 1),
(2206, 142, 'Omnogovi', '053', 1),
(2207, 142, 'Ovorhangay', '055', 1),
(2208, 142, 'Dzavhan', '057', 1),
(2209, 142, 'DundgovL', '059', 1),
(2210, 142, 'Dornod', '061', 1),
(2211, 142, 'Dornogov', '063', 1),
(2212, 142, 'Govi-Sumber', '064', 1),
(2213, 142, 'Govi-Altay', '065', 1),
(2214, 142, 'Bulgan', '067', 1),
(2215, 142, 'Bayanhongor', '069', 1),
(2216, 142, 'Bayan-Olgiy', '071', 1),
(2217, 142, 'Arhangay', '073', 1),
(2218, 143, 'Saint Anthony', 'A', 1),
(2219, 143, 'Saint Georges', 'G', 1),
(2220, 143, 'Saint Peter', 'P', 1),
(2221, 144, 'Agadir', 'AGD', 1),
(2222, 144, 'Al Hoceima', 'HOC', 1),
(2223, 144, 'Azilal', 'AZI', 1),
(2224, 144, 'Beni Mellal', 'BME', 1),
(2225, 144, 'Ben Slimane', 'BSL', 1),
(2226, 144, 'Boulemane', 'BLM', 1),
(2227, 144, 'Casablanca', 'CBL', 1),
(2228, 144, 'Chaouen', 'CHA', 1),
(2229, 144, 'El Jadida', 'EJA', 1),
(2230, 144, 'El Kelaa des Sraghna', 'EKS', 1),
(2231, 144, 'Er Rachidia', 'ERA', 1),
(2232, 144, 'Essaouira', 'ESS', 1),
(2233, 144, 'Fes', 'FES', 1),
(2234, 144, 'Figuig', 'FIG', 1),
(2235, 144, 'Guelmim', 'GLM', 1),
(2236, 144, 'Ifrane', 'IFR', 1),
(2237, 144, 'Kenitra', 'KEN', 1),
(2238, 144, 'Khemisset', 'KHM', 1),
(2239, 144, 'Khenifra', 'KHN', 1),
(2240, 144, 'Khouribga', 'KHO', 1),
(2241, 144, 'Laayoune', 'LYN', 1),
(2242, 144, 'Larache', 'LAR', 1),
(2243, 144, 'Marrakech', 'MRK', 1),
(2244, 144, 'Meknes', 'MKN', 1),
(2245, 144, 'Nador', 'NAD', 1),
(2246, 144, 'Ouarzazate', 'ORZ', 1),
(2247, 144, 'Oujda', 'OUJ', 1),
(2248, 144, 'Rabat-Sale', 'RSA', 1),
(2249, 144, 'Safi', 'SAF', 1),
(2250, 144, 'Settat', 'SET', 1),
(2251, 144, 'Sidi Kacem', 'SKA', 1),
(2252, 144, 'Tangier', 'TGR', 1),
(2253, 144, 'Tan-Tan', 'TAN', 1),
(2254, 144, 'Taounate', 'TAO', 1),
(2255, 144, 'Taroudannt', 'TRD', 1),
(2256, 144, 'Tata', 'TAT', 1),
(2257, 144, 'Taza', 'TAZ', 1),
(2258, 144, 'Tetouan', 'TET', 1),
(2259, 144, 'Tiznit', 'TIZ', 1),
(2260, 144, 'Ad Dakhla', 'ADK', 1),
(2261, 144, 'Boujdour', 'BJD', 1),
(2262, 144, 'Es Smara', 'ESM', 1),
(2263, 145, 'Cabo Delgado', 'CD', 1),
(2264, 145, 'Gaza', 'GZ', 1),
(2265, 145, 'Inhambane', 'IN', 1),
(2266, 145, 'Manica', 'MN', 1),
(2267, 145, 'Maputo (city)', 'MC', 1),
(2268, 145, 'Maputo', 'MP', 1),
(2269, 145, 'Nampula', 'NA', 1),
(2270, 145, 'Niassa', 'NI', 1),
(2271, 145, 'Sofala', 'SO', 1),
(2272, 145, 'Tete', 'TE', 1),
(2273, 145, 'Zambezia', 'ZA', 1),
(2274, 146, 'Ayeyarwady', 'AY', 1),
(2275, 146, 'Bago', 'BG', 1),
(2276, 146, 'Magway', 'MG', 1),
(2277, 146, 'Mandalay', 'MD', 1),
(2278, 146, 'Sagaing', 'SG', 1),
(2279, 146, 'Tanintharyi', 'TN', 1),
(2280, 146, 'Yangon', 'YG', 1),
(2281, 146, 'Chin State', 'CH', 1),
(2282, 146, 'Kachin State', 'KC', 1),
(2283, 146, 'Kayah State', 'KH', 1),
(2284, 146, 'Kayin State', 'KN', 1),
(2285, 146, 'Mon State', 'MN', 1),
(2286, 146, 'Rakhine State', 'RK', 1),
(2287, 146, 'Shan State', 'SH', 1),
(2288, 147, 'Caprivi', 'CA', 1),
(2289, 147, 'Erongo', 'ER', 1),
(2290, 147, 'Hardap', 'HA', 1),
(2291, 147, 'Karas', 'KR', 1),
(2292, 147, 'Kavango', 'KV', 1),
(2293, 147, 'Khomas', 'KH', 1),
(2294, 147, 'Kunene', 'KU', 1),
(2295, 147, 'Ohangwena', 'OW', 1),
(2296, 147, 'Omaheke', 'OK', 1),
(2297, 147, 'Omusati', 'OT', 1),
(2298, 147, 'Oshana', 'ON', 1),
(2299, 147, 'Oshikoto', 'OO', 1),
(2300, 147, 'Otjozondjupa', 'OJ', 1),
(2301, 148, 'Aiwo', 'AO', 1),
(2302, 148, 'Anabar', 'AA', 1),
(2303, 148, 'Anetan', 'AT', 1),
(2304, 148, 'Anibare', 'AI', 1),
(2305, 148, 'Baiti', 'BA', 1),
(2306, 148, 'Boe', 'BO', 1),
(2307, 148, 'Buada', 'BU', 1),
(2308, 148, 'Denigomodu', 'DE', 1),
(2309, 148, 'Ewa', 'EW', 1),
(2310, 148, 'Ijuw', 'IJ', 1),
(2311, 148, 'Meneng', 'ME', 1),
(2312, 148, 'Nibok', 'NI', 1),
(2313, 148, 'Uaboe', 'UA', 1),
(2314, 148, 'Yaren', 'YA', 1),
(2315, 149, 'Bagmati', 'BA', 1),
(2316, 149, 'Bheri', 'BH', 1),
(2317, 149, 'Dhawalagiri', 'DH', 1),
(2318, 149, 'Gandaki', 'GA', 1),
(2319, 149, 'Janakpur', 'JA', 1),
(2320, 149, 'Karnali', 'KA', 1),
(2321, 149, 'Kosi', 'KO', 1),
(2322, 149, 'Lumbini', 'LU', 1),
(2323, 149, 'Mahakali', 'MA', 1),
(2324, 149, 'Mechi', 'ME', 1),
(2325, 149, 'Narayani', 'NA', 1),
(2326, 149, 'Rapti', 'RA', 1),
(2327, 149, 'Sagarmatha', 'SA', 1),
(2328, 149, 'Seti', 'SE', 1),
(2329, 150, 'Drenthe', 'DR', 1),
(2330, 150, 'Flevoland', 'FL', 1),
(2331, 150, 'Friesland', 'FR', 1),
(2332, 150, 'Gelderland', 'GE', 1),
(2333, 150, 'Groningen', 'GR', 1),
(2334, 150, 'Limburg', 'LI', 1),
(2335, 150, 'Noord-Brabant', 'NB', 1),
(2336, 150, 'Noord-Holland', 'NH', 1),
(2337, 150, 'Overijssel', 'OV', 1),
(2338, 150, 'Utrecht', 'UT', 1),
(2339, 150, 'Zeeland', 'ZE', 1),
(2340, 150, 'Zuid-Holland', 'ZH', 1),
(2341, 152, 'Iles Loyaute', 'L', 1),
(2342, 152, 'Nord', 'N', 1),
(2343, 152, 'Sud', 'S', 1),
(2344, 153, 'Auckland', 'AUK', 1),
(2345, 153, 'Bay of Plenty', 'BOP', 1),
(2346, 153, 'Canterbury', 'CAN', 1),
(2347, 153, 'Coromandel', 'COR', 1),
(2348, 153, 'Gisborne', 'GIS', 1),
(2349, 153, 'Fiordland', 'FIO', 1),
(2350, 153, 'Hawke\'s Bay', 'HKB', 1),
(2351, 153, 'Marlborough', 'MBH', 1),
(2352, 153, 'Manawatu-Wanganui', 'MWT', 1),
(2353, 153, 'Mt Cook-Mackenzie', 'MCM', 1),
(2354, 153, 'Nelson', 'NSN', 1),
(2355, 153, 'Northland', 'NTL', 1),
(2356, 153, 'Otago', 'OTA', 1),
(2357, 153, 'Southland', 'STL', 1),
(2358, 153, 'Taranaki', 'TKI', 1),
(2359, 153, 'Wellington', 'WGN', 1),
(2360, 153, 'Waikato', 'WKO', 1),
(2361, 153, 'Wairarapa', 'WAI', 1),
(2362, 153, 'West Coast', 'WTC', 1),
(2363, 154, 'Atlantico Norte', 'AN', 1),
(2364, 154, 'Atlantico Sur', 'AS', 1),
(2365, 154, 'Boaco', 'BO', 1),
(2366, 154, 'Carazo', 'CA', 1),
(2367, 154, 'Chinandega', 'CI', 1),
(2368, 154, 'Chontales', 'CO', 1),
(2369, 154, 'Esteli', 'ES', 1),
(2370, 154, 'Granada', 'GR', 1),
(2371, 154, 'Jinotega', 'JI', 1),
(2372, 154, 'Leon', 'LE', 1),
(2373, 154, 'Madriz', 'MD', 1),
(2374, 154, 'Managua', 'MN', 1),
(2375, 154, 'Masaya', 'MS', 1),
(2376, 154, 'Matagalpa', 'MT', 1),
(2377, 154, 'Nuevo Segovia', 'NS', 1),
(2378, 154, 'Rio San Juan', 'RS', 1),
(2379, 154, 'Rivas', 'RI', 1),
(2380, 155, 'Agadez', 'AG', 1),
(2381, 155, 'Diffa', 'DF', 1),
(2382, 155, 'Dosso', 'DS', 1),
(2383, 155, 'Maradi', 'MA', 1),
(2384, 155, 'Niamey', 'NM', 1),
(2385, 155, 'Tahoua', 'TH', 1),
(2386, 155, 'Tillaberi', 'TL', 1),
(2387, 155, 'Zinder', 'ZD', 1),
(2388, 156, 'Abia', 'AB', 1),
(2389, 156, 'Abuja Federal Capital Territory', 'CT', 1),
(2390, 156, 'Adamawa', 'AD', 1),
(2391, 156, 'Akwa Ibom', 'AK', 1),
(2392, 156, 'Anambra', 'AN', 1),
(2393, 156, 'Bauchi', 'BC', 1),
(2394, 156, 'Bayelsa', 'BY', 1),
(2395, 156, 'Benue', 'BN', 1),
(2396, 156, 'Borno', 'BO', 1),
(2397, 156, 'Cross River', 'CR', 1),
(2398, 156, 'Delta', 'DE', 1),
(2399, 156, 'Ebonyi', 'EB', 1),
(2400, 156, 'Edo', 'ED', 1),
(2401, 156, 'Ekiti', 'EK', 1),
(2402, 156, 'Enugu', 'EN', 1),
(2403, 156, 'Gombe', 'GO', 1),
(2404, 156, 'Imo', 'IM', 1),
(2405, 156, 'Jigawa', 'JI', 1),
(2406, 156, 'Kaduna', 'KD', 1),
(2407, 156, 'Kano', 'KN', 1),
(2408, 156, 'Katsina', 'KT', 1),
(2409, 156, 'Kebbi', 'KE', 1),
(2410, 156, 'Kogi', 'KO', 1),
(2411, 156, 'Kwara', 'KW', 1),
(2412, 156, 'Lagos', 'LA', 1),
(2413, 156, 'Nassarawa', 'NA', 1),
(2414, 156, 'Niger', 'NI', 1),
(2415, 156, 'Ogun', 'OG', 1),
(2416, 156, 'Ondo', 'ONG', 1),
(2417, 156, 'Osun', 'OS', 1),
(2418, 156, 'Oyo', 'OY', 1),
(2419, 156, 'Plateau', 'PL', 1),
(2420, 156, 'Rivers', 'RI', 1),
(2421, 156, 'Sokoto', 'SO', 1),
(2422, 156, 'Taraba', 'TA', 1),
(2423, 156, 'Yobe', 'YO', 1),
(2424, 156, 'Zamfara', 'ZA', 1),
(2425, 159, 'Northern Islands', 'N', 1),
(2426, 159, 'Rota', 'R', 1),
(2427, 159, 'Saipan', 'S', 1),
(2428, 159, 'Tinian', 'T', 1),
(2429, 160, 'Akershus', 'AK', 1),
(2430, 160, 'Aust-Agder', 'AA', 1),
(2431, 160, 'Buskerud', 'BU', 1),
(2432, 160, 'Finnmark', 'FM', 1),
(2433, 160, 'Hedmark', 'HM', 1),
(2434, 160, 'Hordaland', 'HL', 1),
(2435, 160, 'More og Romdal', 'MR', 1),
(2436, 160, 'Nord-Trondelag', 'NT', 1),
(2437, 160, 'Nordland', 'NL', 1),
(2438, 160, 'Ostfold', 'OF', 1),
(2439, 160, 'Oppland', 'OP', 1),
(2440, 160, 'Oslo', 'OL', 1),
(2441, 160, 'Rogaland', 'RL', 1),
(2442, 160, 'Sor-Trondelag', 'ST', 1),
(2443, 160, 'Sogn og Fjordane', 'SJ', 1),
(2444, 160, 'Svalbard', 'SV', 1),
(2445, 160, 'Telemark', 'TM', 1),
(2446, 160, 'Troms', 'TR', 1),
(2447, 160, 'Vest-Agder', 'VA', 1),
(2448, 160, 'Vestfold', 'VF', 1),
(2449, 161, 'Ad Dakhiliyah', 'DA', 1),
(2450, 161, 'Al Batinah', 'BA', 1),
(2451, 161, 'Al Wusta', 'WU', 1),
(2452, 161, 'Ash Sharqiyah', 'SH', 1),
(2453, 161, 'Az Zahirah', 'ZA', 1),
(2454, 161, 'Masqat', 'MA', 1),
(2455, 161, 'Musandam', 'MU', 1),
(2456, 161, 'Zufar', 'ZU', 1),
(2457, 162, 'Balochistan', 'B', 1),
(2458, 162, 'Federally Administered Tribal Areas', 'T', 1),
(2459, 162, 'Islamabad Capital Territory', 'I', 1),
(2460, 162, 'North-West Frontier', 'N', 1),
(2461, 162, 'Punjab', 'P', 1),
(2462, 162, 'Sindh', 'S', 1),
(2463, 163, 'Aimeliik', 'AM', 1),
(2464, 163, 'Airai', 'AR', 1),
(2465, 163, 'Angaur', 'AN', 1),
(2466, 163, 'Hatohobei', 'HA', 1),
(2467, 163, 'Kayangel', 'KA', 1),
(2468, 163, 'Koror', 'KO', 1),
(2469, 163, 'Melekeok', 'ME', 1),
(2470, 163, 'Ngaraard', 'NA', 1),
(2471, 163, 'Ngarchelong', 'NG', 1),
(2472, 163, 'Ngardmau', 'ND', 1),
(2473, 163, 'Ngatpang', 'NT', 1),
(2474, 163, 'Ngchesar', 'NC', 1),
(2475, 163, 'Ngeremlengui', 'NR', 1),
(2476, 163, 'Ngiwal', 'NW', 1),
(2477, 163, 'Peleliu', 'PE', 1),
(2478, 163, 'Sonsorol', 'SO', 1),
(2479, 164, 'Bocas del Toro', 'BT', 1),
(2480, 164, 'Chiriqui', 'CH', 1),
(2481, 164, 'Cocle', 'CC', 1),
(2482, 164, 'Colon', 'CL', 1),
(2483, 164, 'Darien', 'DA', 1),
(2484, 164, 'Herrera', 'HE', 1),
(2485, 164, 'Los Santos', 'LS', 1),
(2486, 164, 'Panama', 'PA', 1),
(2487, 164, 'San Blas', 'SB', 1),
(2488, 164, 'Veraguas', 'VG', 1),
(2489, 165, 'Bougainville', 'BV', 1),
(2490, 165, 'Central', 'CE', 1),
(2491, 165, 'Chimbu', 'CH', 1),
(2492, 165, 'Eastern Highlands', 'EH', 1),
(2493, 165, 'East New Britain', 'EB', 1),
(2494, 165, 'East Sepik', 'ES', 1),
(2495, 165, 'Enga', 'EN', 1),
(2496, 165, 'Gulf', 'GU', 1),
(2497, 165, 'Madang', 'MD', 1),
(2498, 165, 'Manus', 'MN', 1),
(2499, 165, 'Milne Bay', 'MB', 1),
(2500, 165, 'Morobe', 'MR', 1),
(2501, 165, 'National Capital', 'NC', 1),
(2502, 165, 'New Ireland', 'NI', 1),
(2503, 165, 'Northern', 'NO', 1),
(2504, 165, 'Sandaun', 'SA', 1),
(2505, 165, 'Southern Highlands', 'SH', 1),
(2506, 165, 'Western', 'WE', 1),
(2507, 165, 'Western Highlands', 'WH', 1),
(2508, 165, 'West New Britain', 'WB', 1),
(2509, 166, 'Alto Paraguay', 'AG', 1),
(2510, 166, 'Alto Parana', 'AN', 1),
(2511, 166, 'Amambay', 'AM', 1),
(2512, 166, 'Asuncion', 'AS', 1),
(2513, 166, 'Boqueron', 'BO', 1),
(2514, 166, 'Caaguazu', 'CG', 1),
(2515, 166, 'Caazapa', 'CZ', 1),
(2516, 166, 'Canindeyu', 'CN', 1),
(2517, 166, 'Central', 'CE', 1),
(2518, 166, 'Concepcion', 'CC', 1),
(2519, 166, 'Cordillera', 'CD', 1),
(2520, 166, 'Guaira', 'GU', 1),
(2521, 166, 'Itapua', 'IT', 1),
(2522, 166, 'Misiones', 'MI', 1),
(2523, 166, 'Neembucu', 'NE', 1),
(2524, 166, 'Paraguari', 'PA', 1),
(2525, 166, 'Presidente Hayes', 'PH', 1),
(2526, 166, 'San Pedro', 'SP', 1),
(2527, 167, 'Amazonas', 'AM', 1),
(2528, 167, 'Ancash', 'AN', 1),
(2529, 167, 'Apurimac', 'AP', 1),
(2530, 167, 'Arequipa', 'AR', 1),
(2531, 167, 'Ayacucho', 'AY', 1),
(2532, 167, 'Cajamarca', 'CJ', 1),
(2533, 167, 'Callao', 'CL', 1),
(2534, 167, 'Cusco', 'CU', 1),
(2535, 167, 'Huancavelica', 'HV', 1),
(2536, 167, 'Huanuco', 'HO', 1),
(2537, 167, 'Ica', 'IC', 1),
(2538, 167, 'Junin', 'JU', 1),
(2539, 167, 'La Libertad', 'LD', 1),
(2540, 167, 'Lambayeque', 'LY', 1),
(2541, 167, 'Lima', 'LI', 1),
(2542, 167, 'Loreto', 'LO', 1),
(2543, 167, 'Madre de Dios', 'MD', 1),
(2544, 167, 'Moquegua', 'MO', 1),
(2545, 167, 'Pasco', 'PA', 1),
(2546, 167, 'Piura', 'PI', 1),
(2547, 167, 'Puno', 'PU', 1),
(2548, 167, 'San Martin', 'SM', 1),
(2549, 167, 'Tacna', 'TA', 1),
(2550, 167, 'Tumbes', 'TU', 1),
(2551, 167, 'Ucayali', 'UC', 1),
(2552, 168, 'Abra', 'ABR', 1),
(2553, 168, 'Agusan del Norte', 'ANO', 1),
(2554, 168, 'Agusan del Sur', 'ASU', 1),
(2555, 168, 'Aklan', 'AKL', 1),
(2556, 168, 'Albay', 'ALB', 1),
(2557, 168, 'Antique', 'ANT', 1),
(2558, 168, 'Apayao', 'APY', 1),
(2559, 168, 'Aurora', 'AUR', 1),
(2560, 168, 'Basilan', 'BAS', 1),
(2561, 168, 'Bataan', 'BTA', 1),
(2562, 168, 'Batanes', 'BTE', 1),
(2563, 168, 'Batangas', 'BTG', 1),
(2564, 168, 'Biliran', 'BLR', 1),
(2565, 168, 'Benguet', 'BEN', 1),
(2566, 168, 'Bohol', 'BOL', 1),
(2567, 168, 'Bukidnon', 'BUK', 1),
(2568, 168, 'Bulacan', 'BUL', 1),
(2569, 168, 'Cagayan', 'CAG', 1),
(2570, 168, 'Camarines Norte', 'CNO', 1),
(2571, 168, 'Camarines Sur', 'CSU', 1),
(2572, 168, 'Camiguin', 'CAM', 1),
(2573, 168, 'Capiz', 'CAP', 1),
(2574, 168, 'Catanduanes', 'CAT', 1),
(2575, 168, 'Cavite', 'CAV', 1),
(2576, 168, 'Cebu', 'CEB', 1),
(2577, 168, 'Compostela', 'CMP', 1),
(2578, 168, 'Davao del Norte', 'DNO', 1),
(2579, 168, 'Davao del Sur', 'DSU', 1),
(2580, 168, 'Davao Oriental', 'DOR', 1),
(2581, 168, 'Eastern Samar', 'ESA', 1),
(2582, 168, 'Guimaras', 'GUI', 1),
(2583, 168, 'Ifugao', 'IFU', 1),
(2584, 168, 'Ilocos Norte', 'INO', 1),
(2585, 168, 'Ilocos Sur', 'ISU', 1),
(2586, 168, 'Iloilo', 'ILO', 1),
(2587, 168, 'Isabela', 'ISA', 1),
(2588, 168, 'Kalinga', 'KAL', 1),
(2589, 168, 'Laguna', 'LAG', 1),
(2590, 168, 'Lanao del Norte', 'LNO', 1),
(2591, 168, 'Lanao del Sur', 'LSU', 1),
(2592, 168, 'La Union', 'UNI', 1),
(2593, 168, 'Leyte', 'LEY', 1),
(2594, 168, 'Maguindanao', 'MAG', 1),
(2595, 168, 'Marinduque', 'MRN', 1),
(2596, 168, 'Masbate', 'MSB', 1),
(2597, 168, 'Mindoro Occidental', 'MIC', 1),
(2598, 168, 'Mindoro Oriental', 'MIR', 1),
(2599, 168, 'Misamis Occidental', 'MSC', 1),
(2600, 168, 'Misamis Oriental', 'MOR', 1),
(2601, 168, 'Mountain', 'MOP', 1),
(2602, 168, 'Negros Occidental', 'NOC', 1),
(2603, 168, 'Negros Oriental', 'NOR', 1),
(2604, 168, 'North Cotabato', 'NCT', 1),
(2605, 168, 'Northern Samar', 'NSM', 1),
(2606, 168, 'Nueva Ecija', 'NEC', 1),
(2607, 168, 'Nueva Vizcaya', 'NVZ', 1),
(2608, 168, 'Palawan', 'PLW', 1),
(2609, 168, 'Pampanga', 'PMP', 1),
(2610, 168, 'Pangasinan', 'PNG', 1),
(2611, 168, 'Quezon', 'QZN', 1),
(2612, 168, 'Quirino', 'QRN', 1),
(2613, 168, 'Rizal', 'RIZ', 1),
(2614, 168, 'Romblon', 'ROM', 1),
(2615, 168, 'Samar', 'SMR', 1),
(2616, 168, 'Sarangani', 'SRG', 1),
(2617, 168, 'Siquijor', 'SQJ', 1),
(2618, 168, 'Sorsogon', 'SRS', 1),
(2619, 168, 'South Cotabato', 'SCO', 1),
(2620, 168, 'Southern Leyte', 'SLE', 1),
(2621, 168, 'Sultan Kudarat', 'SKU', 1),
(2622, 168, 'Sulu', 'SLU', 1),
(2623, 168, 'Surigao del Norte', 'SNO', 1),
(2624, 168, 'Surigao del Sur', 'SSU', 1),
(2625, 168, 'Tarlac', 'TAR', 1),
(2626, 168, 'Tawi-Tawi', 'TAW', 1),
(2627, 168, 'Zambales', 'ZBL', 1),
(2628, 168, 'Zamboanga del Norte', 'ZNO', 1),
(2629, 168, 'Zamboanga del Sur', 'ZSU', 1),
(2630, 168, 'Zamboanga Sibugay', 'ZSI', 1),
(2631, 170, 'Dolnoslaskie', 'DO', 1),
(2632, 170, 'Kujawsko-Pomorskie', 'KP', 1),
(2633, 170, 'Lodzkie', 'LO', 1),
(2634, 170, 'Lubelskie', 'LL', 1),
(2635, 170, 'Lubuskie', 'LU', 1),
(2636, 170, 'Malopolskie', 'ML', 1),
(2637, 170, 'Mazowieckie', 'MZ', 1),
(2638, 170, 'Opolskie', 'OP', 1),
(2639, 170, 'Podkarpackie', 'PP', 1),
(2640, 170, 'Podlaskie', 'PL', 1),
(2641, 170, 'Pomorskie', 'PM', 1),
(2642, 170, 'Slaskie', 'SL', 1),
(2643, 170, 'Swietokrzyskie', 'SW', 1),
(2644, 170, 'Warminsko-Mazurskie', 'WM', 1),
(2645, 170, 'Wielkopolskie', 'WP', 1),
(2646, 170, 'Zachodniopomorskie', 'ZA', 1),
(2647, 198, 'Saint Pierre', 'P', 1),
(2648, 198, 'Miquelon', 'M', 1),
(2649, 171, 'A&ccedil;ores', 'AC', 1),
(2650, 171, 'Aveiro', 'AV', 1),
(2651, 171, 'Beja', 'BE', 1),
(2652, 171, 'Braga', 'BR', 1),
(2653, 171, 'Bragan&ccedil;a', 'BA', 1),
(2654, 171, 'Castelo Branco', 'CB', 1),
(2655, 171, 'Coimbra', 'CO', 1),
(2656, 171, '&Eacute;vora', 'EV', 1),
(2657, 171, 'Faro', 'FA', 1),
(2658, 171, 'Guarda', 'GU', 1),
(2659, 171, 'Leiria', 'LE', 1),
(2660, 171, 'Lisboa', 'LI', 1),
(2661, 171, 'Madeira', 'ME', 1),
(2662, 171, 'Portalegre', 'PO', 1),
(2663, 171, 'Porto', 'PR', 1),
(2664, 171, 'Santar&eacute;m', 'SA', 1),
(2665, 171, 'Set&uacute;bal', 'SE', 1),
(2666, 171, 'Viana do Castelo', 'VC', 1),
(2667, 171, 'Vila Real', 'VR', 1),
(2668, 171, 'Viseu', 'VI', 1),
(2669, 173, 'Ad Dawhah', 'DW', 1),
(2670, 173, 'Al Ghuwayriyah', 'GW', 1),
(2671, 173, 'Al Jumayliyah', 'JM', 1),
(2672, 173, 'Al Khawr', 'KR', 1),
(2673, 173, 'Al Wakrah', 'WK', 1),
(2674, 173, 'Ar Rayyan', 'RN', 1),
(2675, 173, 'Jarayan al Batinah', 'JB', 1),
(2676, 173, 'Madinat ash Shamal', 'MS', 1),
(2677, 173, 'Umm Sa\'id', 'UD', 1),
(2678, 173, 'Umm Salal', 'UL', 1),
(2679, 175, 'Alba', 'AB', 1),
(2680, 175, 'Arad', 'AR', 1),
(2681, 175, 'Arges', 'AG', 1),
(2682, 175, 'Bacau', 'BC', 1),
(2683, 175, 'Bihor', 'BH', 1),
(2684, 175, 'Bistrita-Nasaud', 'BN', 1),
(2685, 175, 'Botosani', 'BT', 1),
(2686, 175, 'Brasov', 'BV', 1),
(2687, 175, 'Braila', 'BR', 1),
(2688, 175, 'Bucuresti', 'B', 1),
(2689, 175, 'Buzau', 'BZ', 1),
(2690, 175, 'Caras-Severin', 'CS', 1),
(2691, 175, 'Calarasi', 'CL', 1),
(2692, 175, 'Cluj', 'CJ', 1),
(2693, 175, 'Constanta', 'CT', 1),
(2694, 175, 'Covasna', 'CV', 1),
(2695, 175, 'Dimbovita', 'DB', 1),
(2696, 175, 'Dolj', 'DJ', 1),
(2697, 175, 'Galati', 'GL', 1),
(2698, 175, 'Giurgiu', 'GR', 1),
(2699, 175, 'Gorj', 'GJ', 1),
(2700, 175, 'Harghita', 'HR', 1),
(2701, 175, 'Hunedoara', 'HD', 1),
(2702, 175, 'Ialomita', 'IL', 1),
(2703, 175, 'Iasi', 'IS', 1),
(2704, 175, 'Ilfov', 'IF', 1),
(2705, 175, 'Maramures', 'MM', 1),
(2706, 175, 'Mehedinti', 'MH', 1),
(2707, 175, 'Mures', 'MS', 1),
(2708, 175, 'Neamt', 'NT', 1),
(2709, 175, 'Olt', 'OT', 1),
(2710, 175, 'Prahova', 'PH', 1),
(2711, 175, 'Satu-Mare', 'SM', 1),
(2712, 175, 'Salaj', 'SJ', 1),
(2713, 175, 'Sibiu', 'SB', 1),
(2714, 175, 'Suceava', 'SV', 1),
(2715, 175, 'Teleorman', 'TR', 1),
(2716, 175, 'Timis', 'TM', 1),
(2717, 175, 'Tulcea', 'TL', 1),
(2718, 175, 'Vaslui', 'VS', 1),
(2719, 175, 'Valcea', 'VL', 1),
(2720, 175, 'Vrancea', 'VN', 1),
(2721, 176, 'Abakan', 'AB', 1),
(2722, 176, 'Aginskoye', 'AG', 1),
(2723, 176, 'Anadyr', 'AN', 1),
(2724, 176, 'Arkahangelsk', 'AR', 1),
(2725, 176, 'Astrakhan', 'AS', 1),
(2726, 176, 'Barnaul', 'BA', 1),
(2727, 176, 'Belgorod', 'BE', 1),
(2728, 176, 'Birobidzhan', 'BI', 1),
(2729, 176, 'Blagoveshchensk', 'BL', 1),
(2730, 176, 'Bryansk', 'BR', 1),
(2731, 176, 'Cheboksary', 'CH', 1),
(2732, 176, 'Chelyabinsk', 'CL', 1),
(2733, 176, 'Cherkessk', 'CR', 1),
(2734, 176, 'Chita', 'CI', 1),
(2735, 176, 'Dudinka', 'DU', 1),
(2736, 176, 'Elista', 'EL', 1),
(2738, 176, 'Gorno-Altaysk', 'GA', 1),
(2739, 176, 'Groznyy', 'GR', 1),
(2740, 176, 'Irkutsk', 'IR', 1),
(2741, 176, 'Ivanovo', 'IV', 1),
(2742, 176, 'Izhevsk', 'IZ', 1),
(2743, 176, 'Kalinigrad', 'KA', 1),
(2744, 176, 'Kaluga', 'KL', 1),
(2745, 176, 'Kasnodar', 'KS', 1),
(2746, 176, 'Kazan', 'KZ', 1),
(2747, 176, 'Kemerovo', 'KE', 1),
(2748, 176, 'Khabarovsk', 'KH', 1),
(2749, 176, 'Khanty-Mansiysk', 'KM', 1),
(2750, 176, 'Kostroma', 'KO', 1),
(2751, 176, 'Krasnodar', 'KR', 1),
(2752, 176, 'Krasnoyarsk', 'KN', 1),
(2753, 176, 'Kudymkar', 'KU', 1),
(2754, 176, 'Kurgan', 'KG', 1),
(2755, 176, 'Kursk', 'KK', 1),
(2756, 176, 'Kyzyl', 'KY', 1),
(2757, 176, 'Lipetsk', 'LI', 1),
(2758, 176, 'Magadan', 'MA', 1),
(2759, 176, 'Makhachkala', 'MK', 1),
(2760, 176, 'Maykop', 'MY', 1),
(2761, 176, 'Moscow', 'MO', 1),
(2762, 176, 'Murmansk', 'MU', 1),
(2763, 176, 'Nalchik', 'NA', 1),
(2764, 176, 'Naryan Mar', 'NR', 1),
(2765, 176, 'Nazran', 'NZ', 1),
(2766, 176, 'Nizhniy Novgorod', 'NI', 1),
(2767, 176, 'Novgorod', 'NO', 1),
(2768, 176, 'Novosibirsk', 'NV', 1),
(2769, 176, 'Omsk', 'OM', 1),
(2770, 176, 'Orel', 'OR', 1),
(2771, 176, 'Orenburg', 'OE', 1),
(2772, 176, 'Palana', 'PA', 1),
(2773, 176, 'Penza', 'PE', 1),
(2774, 176, 'Perm', 'PR', 1),
(2775, 176, 'Petropavlovsk-Kamchatskiy', 'PK', 1),
(2776, 176, 'Petrozavodsk', 'PT', 1),
(2777, 176, 'Pskov', 'PS', 1),
(2778, 176, 'Rostov-na-Donu', 'RO', 1),
(2779, 176, 'Ryazan', 'RY', 1),
(2780, 176, 'Salekhard', 'SL', 1),
(2781, 176, 'Samara', 'SA', 1),
(2782, 176, 'Saransk', 'SR', 1),
(2783, 176, 'Saratov', 'SV', 1),
(2784, 176, 'Smolensk', 'SM', 1),
(2785, 176, 'St. Petersburg', 'SP', 1),
(2786, 176, 'Stavropol', 'ST', 1),
(2787, 176, 'Syktyvkar', 'SY', 1),
(2788, 176, 'Tambov', 'TA', 1),
(2789, 176, 'Tomsk', 'TO', 1),
(2790, 176, 'Tula', 'TU', 1),
(2791, 176, 'Tura', 'TR', 1),
(2792, 176, 'Tver', 'TV', 1),
(2793, 176, 'Tyumen', 'TY', 1),
(2794, 176, 'Ufa', 'UF', 1),
(2795, 176, 'Ul\'yanovsk', 'UL', 1),
(2796, 176, 'Ulan-Ude', 'UU', 1),
(2797, 176, 'Ust\'-Ordynskiy', 'US', 1),
(2798, 176, 'Vladikavkaz', 'VL', 1),
(2799, 176, 'Vladimir', 'VA', 1),
(2800, 176, 'Vladivostok', 'VV', 1),
(2801, 176, 'Volgograd', 'VG', 1),
(2802, 176, 'Vologda', 'VD', 1),
(2803, 176, 'Voronezh', 'VO', 1),
(2804, 176, 'Vyatka', 'VY', 1),
(2805, 176, 'Yakutsk', 'YA', 1),
(2806, 176, 'Yaroslavl', 'YR', 1),
(2807, 176, 'Yekaterinburg', 'YE', 1),
(2808, 176, 'Yoshkar-Ola', 'YO', 1),
(2809, 177, 'Butare', 'BU', 1),
(2810, 177, 'Byumba', 'BY', 1),
(2811, 177, 'Cyangugu', 'CY', 1),
(2812, 177, 'Gikongoro', 'GK', 1),
(2813, 177, 'Gisenyi', 'GS', 1),
(2814, 177, 'Gitarama', 'GT', 1),
(2815, 177, 'Kibungo', 'KG', 1),
(2816, 177, 'Kibuye', 'KY', 1),
(2817, 177, 'Kigali Rurale', 'KR', 1),
(2818, 177, 'Kigali-ville', 'KV', 1),
(2819, 177, 'Ruhengeri', 'RU', 1),
(2820, 177, 'Umutara', 'UM', 1),
(2821, 178, 'Christ Church Nichola Town', 'CCN', 1),
(2822, 178, 'Saint Anne Sandy Point', 'SAS', 1),
(2823, 178, 'Saint George Basseterre', 'SGB', 1),
(2824, 178, 'Saint George Gingerland', 'SGG', 1),
(2825, 178, 'Saint James Windward', 'SJW', 1),
(2826, 178, 'Saint John Capesterre', 'SJC', 1),
(2827, 178, 'Saint John Figtree', 'SJF', 1),
(2828, 178, 'Saint Mary Cayon', 'SMC', 1),
(2829, 178, 'Saint Paul Capesterre', 'CAP', 1),
(2830, 178, 'Saint Paul Charlestown', 'CHA', 1),
(2831, 178, 'Saint Peter Basseterre', 'SPB', 1),
(2832, 178, 'Saint Thomas Lowland', 'STL', 1),
(2833, 178, 'Saint Thomas Middle Island', 'STM', 1),
(2834, 178, 'Trinity Palmetto Point', 'TPP', 1),
(2835, 179, 'Anse-la-Raye', 'AR', 1),
(2836, 179, 'Castries', 'CA', 1),
(2837, 179, 'Choiseul', 'CH', 1),
(2838, 179, 'Dauphin', 'DA', 1),
(2839, 179, 'Dennery', 'DE', 1),
(2840, 179, 'Gros-Islet', 'GI', 1),
(2841, 179, 'Laborie', 'LA', 1),
(2842, 179, 'Micoud', 'MI', 1),
(2843, 179, 'Praslin', 'PR', 1),
(2844, 179, 'Soufriere', 'SO', 1),
(2845, 179, 'Vieux-Fort', 'VF', 1),
(2846, 180, 'Charlotte', 'C', 1),
(2847, 180, 'Grenadines', 'R', 1),
(2848, 180, 'Saint Andrew', 'A', 1),
(2849, 180, 'Saint David', 'D', 1),
(2850, 180, 'Saint George', 'G', 1),
(2851, 180, 'Saint Patrick', 'P', 1),
(2852, 181, 'A\'ana', 'AN', 1),
(2853, 181, 'Aiga-i-le-Tai', 'AI', 1),
(2854, 181, 'Atua', 'AT', 1),
(2855, 181, 'Fa\'asaleleaga', 'FA', 1),
(2856, 181, 'Gaga\'emauga', 'GE', 1),
(2857, 181, 'Gagaifomauga', 'GF', 1),
(2858, 181, 'Palauli', 'PA', 1),
(2859, 181, 'Satupa\'itea', 'SA', 1),
(2860, 181, 'Tuamasaga', 'TU', 1),
(2861, 181, 'Va\'a-o-Fonoti', 'VF', 1),
(2862, 181, 'Vaisigano', 'VS', 1),
(2863, 182, 'Acquaviva', 'AC', 1),
(2864, 182, 'Borgo Maggiore', 'BM', 1),
(2865, 182, 'Chiesanuova', 'CH', 1),
(2866, 182, 'Domagnano', 'DO', 1),
(2867, 182, 'Faetano', 'FA', 1),
(2868, 182, 'Fiorentino', 'FI', 1),
(2869, 182, 'Montegiardino', 'MO', 1),
(2870, 182, 'Citta di San Marino', 'SM', 1),
(2871, 182, 'Serravalle', 'SE', 1),
(2872, 183, 'Sao Tome', 'S', 1),
(2873, 183, 'Principe', 'P', 1),
(2874, 184, 'Al Bahah', 'BH', 1),
(2875, 184, 'Al Hudud ash Shamaliyah', 'HS', 1),
(2876, 184, 'Al Jawf', 'JF', 1),
(2877, 184, 'Al Madinah', 'MD', 1),
(2878, 184, 'Al Qasim', 'QS', 1),
(2879, 184, 'Ar Riyad', 'RD', 1),
(2880, 184, 'Ash Sharqiyah (Eastern)', 'AQ', 1),
(2881, 184, '\'Asir', 'AS', 1),
(2882, 184, 'Ha\'il', 'HL', 1),
(2883, 184, 'Jizan', 'JZ', 1),
(2884, 184, 'Makkah', 'ML', 1),
(2885, 184, 'Najran', 'NR', 1),
(2886, 184, 'Tabuk', 'TB', 1),
(2887, 185, 'Dakar', 'DA', 1),
(2888, 185, 'Diourbel', 'DI', 1),
(2889, 185, 'Fatick', 'FA', 1),
(2890, 185, 'Kaolack', 'KA', 1),
(2891, 185, 'Kolda', 'KO', 1),
(2892, 185, 'Louga', 'LO', 1),
(2893, 185, 'Matam', 'MA', 1),
(2894, 185, 'Saint-Louis', 'SL', 1),
(2895, 185, 'Tambacounda', 'TA', 1),
(2896, 185, 'Thies', 'TH', 1),
(2897, 185, 'Ziguinchor', 'ZI', 1),
(2898, 186, 'Anse aux Pins', 'AP', 1),
(2899, 186, 'Anse Boileau', 'AB', 1),
(2900, 186, 'Anse Etoile', 'AE', 1),
(2901, 186, 'Anse Louis', 'AL', 1),
(2902, 186, 'Anse Royale', 'AR', 1),
(2903, 186, 'Baie Lazare', 'BL', 1),
(2904, 186, 'Baie Sainte Anne', 'BS', 1),
(2905, 186, 'Beau Vallon', 'BV', 1),
(2906, 186, 'Bel Air', 'BA', 1),
(2907, 186, 'Bel Ombre', 'BO', 1),
(2908, 186, 'Cascade', 'CA', 1),
(2909, 186, 'Glacis', 'GL', 1),
(2910, 186, 'Grand\' Anse (on Mahe)', 'GM', 1),
(2911, 186, 'Grand\' Anse (on Praslin)', 'GP', 1),
(2912, 186, 'La Digue', 'DG', 1),
(2913, 186, 'La Riviere Anglaise', 'RA', 1),
(2914, 186, 'Mont Buxton', 'MB', 1),
(2915, 186, 'Mont Fleuri', 'MF', 1),
(2916, 186, 'Plaisance', 'PL', 1),
(2917, 186, 'Pointe La Rue', 'PR', 1),
(2918, 186, 'Port Glaud', 'PG', 1),
(2919, 186, 'Saint Louis', 'SL', 1),
(2920, 186, 'Takamaka', 'TA', 1),
(2921, 187, 'Eastern', 'E', 1),
(2922, 187, 'Northern', 'N', 1),
(2923, 187, 'Southern', 'S', 1),
(2924, 187, 'Western', 'W', 1),
(2925, 189, 'Banskobystrický', 'BA', 1),
(2926, 189, 'Bratislavský', 'BR', 1),
(2927, 189, 'Košický', 'KO', 1),
(2928, 189, 'Nitriansky', 'NI', 1),
(2929, 189, 'Prešovský', 'PR', 1),
(2930, 189, 'Trenčiansky', 'TC', 1),
(2931, 189, 'Trnavský', 'TV', 1),
(2932, 189, 'Žilinský', 'ZI', 1),
(2933, 191, 'Central', 'CE', 1),
(2934, 191, 'Choiseul', 'CH', 1),
(2935, 191, 'Guadalcanal', 'GC', 1),
(2936, 191, 'Honiara', 'HO', 1),
(2937, 191, 'Isabel', 'IS', 1),
(2938, 191, 'Makira', 'MK', 1),
(2939, 191, 'Malaita', 'ML', 1),
(2940, 191, 'Rennell and Bellona', 'RB', 1),
(2941, 191, 'Temotu', 'TM', 1),
(2942, 191, 'Western', 'WE', 1),
(2943, 192, 'Awdal', 'AW', 1),
(2944, 192, 'Bakool', 'BK', 1),
(2945, 192, 'Banaadir', 'BN', 1),
(2946, 192, 'Bari', 'BR', 1),
(2947, 192, 'Bay', 'BY', 1),
(2948, 192, 'Galguduud', 'GA', 1),
(2949, 192, 'Gedo', 'GE', 1),
(2950, 192, 'Hiiraan', 'HI', 1),
(2951, 192, 'Jubbada Dhexe', 'JD', 1),
(2952, 192, 'Jubbada Hoose', 'JH', 1),
(2953, 192, 'Mudug', 'MU', 1),
(2954, 192, 'Nugaal', 'NU', 1),
(2955, 192, 'Sanaag', 'SA', 1),
(2956, 192, 'Shabeellaha Dhexe', 'SD', 1),
(2957, 192, 'Shabeellaha Hoose', 'SH', 1),
(2958, 192, 'Sool', 'SL', 1),
(2959, 192, 'Togdheer', 'TO', 1),
(2960, 192, 'Woqooyi Galbeed', 'WG', 1),
(2961, 193, 'Eastern Cape', 'EC', 1),
(2962, 193, 'Free State', 'FS', 1),
(2963, 193, 'Gauteng', 'GT', 1),
(2964, 193, 'KwaZulu-Natal', 'KN', 1),
(2965, 193, 'Limpopo', 'LP', 1),
(2966, 193, 'Mpumalanga', 'MP', 1),
(2967, 193, 'North West', 'NW', 1),
(2968, 193, 'Northern Cape', 'NC', 1),
(2969, 193, 'Western Cape', 'WC', 1),
(2970, 195, 'La Coru&ntilde;a', 'CA', 1),
(2971, 195, '&Aacute;lava', 'AL', 1),
(2972, 195, 'Albacete', 'AB', 1),
(2973, 195, 'Alicante', 'AC', 1),
(2974, 195, 'Almeria', 'AM', 1),
(2975, 195, 'Asturias', 'AS', 1),
(2976, 195, '&Aacute;vila', 'AV', 1),
(2977, 195, 'Badajoz', 'BJ', 1),
(2978, 195, 'Baleares', 'IB', 1),
(2979, 195, 'Barcelona', 'BA', 1),
(2980, 195, 'Burgos', 'BU', 1),
(2981, 195, 'C&aacute;ceres', 'CC', 1),
(2982, 195, 'C&aacute;diz', 'CZ', 1),
(2983, 195, 'Cantabria', 'CT', 1),
(2984, 195, 'Castell&oacute;n', 'CL', 1),
(2985, 195, 'Ceuta', 'CE', 1),
(2986, 195, 'Ciudad Real', 'CR', 1),
(2987, 195, 'C&oacute;rdoba', 'CD', 1),
(2988, 195, 'Cuenca', 'CU', 1),
(2989, 195, 'Girona', 'GI', 1),
(2990, 195, 'Granada', 'GD', 1),
(2991, 195, 'Guadalajara', 'GJ', 1),
(2992, 195, 'Guip&uacute;zcoa', 'GP', 1),
(2993, 195, 'Huelva', 'HL', 1),
(2994, 195, 'Huesca', 'HS', 1),
(2995, 195, 'Ja&eacute;n', 'JN', 1),
(2996, 195, 'La Rioja', 'RJ', 1),
(2997, 195, 'Las Palmas', 'PM', 1),
(2998, 195, 'Leon', 'LE', 1),
(2999, 195, 'Lleida', 'LL', 1),
(3000, 195, 'Lugo', 'LG', 1),
(3001, 195, 'Madrid', 'MD', 1),
(3002, 195, 'Malaga', 'MA', 1),
(3003, 195, 'Melilla', 'ML', 1),
(3004, 195, 'Murcia', 'MU', 1),
(3005, 195, 'Navarra', 'NV', 1),
(3006, 195, 'Ourense', 'OU', 1),
(3007, 195, 'Palencia', 'PL', 1),
(3008, 195, 'Pontevedra', 'PO', 1),
(3009, 195, 'Salamanca', 'SL', 1),
(3010, 195, 'Santa Cruz de Tenerife', 'SC', 1),
(3011, 195, 'Segovia', 'SG', 1),
(3012, 195, 'Sevilla', 'SV', 1),
(3013, 195, 'Soria', 'SO', 1),
(3014, 195, 'Tarragona', 'TA', 1),
(3015, 195, 'Teruel', 'TE', 1),
(3016, 195, 'Toledo', 'TO', 1),
(3017, 195, 'Valencia', 'VC', 1),
(3018, 195, 'Valladolid', 'VD', 1),
(3019, 195, 'Vizcaya', 'VZ', 1),
(3020, 195, 'Zamora', 'ZM', 1),
(3021, 195, 'Zaragoza', 'ZR', 1),
(3022, 196, 'Central', 'CE', 1),
(3023, 196, 'Eastern', 'EA', 1),
(3024, 196, 'North Central', 'NC', 1),
(3025, 196, 'Northern', 'NO', 1),
(3026, 196, 'North Western', 'NW', 1),
(3027, 196, 'Sabaragamuwa', 'SA', 1),
(3028, 196, 'Southern', 'SO', 1),
(3029, 196, 'Uva', 'UV', 1),
(3030, 196, 'Western', 'WE', 1),
(3032, 197, 'Saint Helena', 'S', 1),
(3034, 199, 'A\'ali an Nil', 'ANL', 1),
(3035, 199, 'Al Bahr al Ahmar', 'BAM', 1),
(3036, 199, 'Al Buhayrat', 'BRT', 1),
(3037, 199, 'Al Jazirah', 'JZR', 1),
(3038, 199, 'Al Khartum', 'KRT', 1),
(3039, 199, 'Al Qadarif', 'QDR', 1),
(3040, 199, 'Al Wahdah', 'WDH', 1),
(3041, 199, 'An Nil al Abyad', 'ANB', 1),
(3042, 199, 'An Nil al Azraq', 'ANZ', 1),
(3043, 199, 'Ash Shamaliyah', 'ASH', 1),
(3044, 199, 'Bahr al Jabal', 'BJA', 1),
(3045, 199, 'Gharb al Istiwa\'iyah', 'GIS', 1),
(3046, 199, 'Gharb Bahr al Ghazal', 'GBG', 1),
(3047, 199, 'Gharb Darfur', 'GDA', 1),
(3048, 199, 'Gharb Kurdufan', 'GKU', 1),
(3049, 199, 'Janub Darfur', 'JDA', 1),
(3050, 199, 'Janub Kurdufan', 'JKU', 1),
(3051, 199, 'Junqali', 'JQL', 1),
(3052, 199, 'Kassala', 'KSL', 1),
(3053, 199, 'Nahr an Nil', 'NNL', 1),
(3054, 199, 'Shamal Bahr al Ghazal', 'SBG', 1),
(3055, 199, 'Shamal Darfur', 'SDA', 1),
(3056, 199, 'Shamal Kurdufan', 'SKU', 1),
(3057, 199, 'Sharq al Istiwa\'iyah', 'SIS', 1),
(3058, 199, 'Sinnar', 'SNR', 1),
(3059, 199, 'Warab', 'WRB', 1),
(3060, 200, 'Brokopondo', 'BR', 1),
(3061, 200, 'Commewijne', 'CM', 1),
(3062, 200, 'Coronie', 'CR', 1),
(3063, 200, 'Marowijne', 'MA', 1),
(3064, 200, 'Nickerie', 'NI', 1),
(3065, 200, 'Para', 'PA', 1),
(3066, 200, 'Paramaribo', 'PM', 1),
(3067, 200, 'Saramacca', 'SA', 1),
(3068, 200, 'Sipaliwini', 'SI', 1),
(3069, 200, 'Wanica', 'WA', 1),
(3070, 202, 'Hhohho', 'H', 1),
(3071, 202, 'Lubombo', 'L', 1),
(3072, 202, 'Manzini', 'M', 1),
(3073, 202, 'Shishelweni', 'S', 1),
(3074, 203, 'Blekinge', 'K', 1),
(3075, 203, 'Dalarna', 'W', 1),
(3076, 203, 'Gävleborg', 'X', 1),
(3077, 203, 'Gotland', 'I', 1),
(3078, 203, 'Halland', 'N', 1),
(3079, 203, 'Jämtland', 'Z', 1),
(3080, 203, 'Jönköping', 'F', 1),
(3081, 203, 'Kalmar', 'H', 1),
(3082, 203, 'Kronoberg', 'G', 1),
(3083, 203, 'Norrbotten', 'BD', 1),
(3084, 203, 'Örebro', 'T', 1),
(3085, 203, 'Östergötland', 'E', 1),
(3086, 203, 'Sk&aring;ne', 'M', 1),
(3087, 203, 'Södermanland', 'D', 1),
(3088, 203, 'Stockholm', 'AB', 1),
(3089, 203, 'Uppsala', 'C', 1),
(3090, 203, 'Värmland', 'S', 1),
(3091, 203, 'Västerbotten', 'AC', 1),
(3092, 203, 'Västernorrland', 'Y', 1),
(3093, 203, 'Västmanland', 'U', 1),
(3094, 203, 'Västra Götaland', 'O', 1),
(3095, 204, 'Aargau', 'AG', 1),
(3096, 204, 'Appenzell Ausserrhoden', 'AR', 1),
(3097, 204, 'Appenzell Innerrhoden', 'AI', 1),
(3098, 204, 'Basel-Stadt', 'BS', 1),
(3099, 204, 'Basel-Landschaft', 'BL', 1),
(3100, 204, 'Bern', 'BE', 1),
(3101, 204, 'Fribourg', 'FR', 1),
(3102, 204, 'Gen&egrave;ve', 'GE', 1),
(3103, 204, 'Glarus', 'GL', 1),
(3104, 204, 'Graubünden', 'GR', 1),
(3105, 204, 'Jura', 'JU', 1),
(3106, 204, 'Luzern', 'LU', 1),
(3107, 204, 'Neuch&acirc;tel', 'NE', 1),
(3108, 204, 'Nidwald', 'NW', 1),
(3109, 204, 'Obwald', 'OW', 1),
(3110, 204, 'St. Gallen', 'SG', 1),
(3111, 204, 'Schaffhausen', 'SH', 1),
(3112, 204, 'Schwyz', 'SZ', 1),
(3113, 204, 'Solothurn', 'SO', 1),
(3114, 204, 'Thurgau', 'TG', 1),
(3115, 204, 'Ticino', 'TI', 1),
(3116, 204, 'Uri', 'UR', 1),
(3117, 204, 'Valais', 'VS', 1),
(3118, 204, 'Vaud', 'VD', 1),
(3119, 204, 'Zug', 'ZG', 1),
(3120, 204, 'Zürich', 'ZH', 1),
(3121, 205, 'Al Hasakah', 'HA', 1),
(3122, 205, 'Al Ladhiqiyah', 'LA', 1),
(3123, 205, 'Al Qunaytirah', 'QU', 1),
(3124, 205, 'Ar Raqqah', 'RQ', 1),
(3125, 205, 'As Suwayda', 'SU', 1),
(3126, 205, 'Dara', 'DA', 1),
(3127, 205, 'Dayr az Zawr', 'DZ', 1),
(3128, 205, 'Dimashq', 'DI', 1),
(3129, 205, 'Halab', 'HL', 1),
(3130, 205, 'Hamah', 'HM', 1),
(3131, 205, 'Hims', 'HI', 1),
(3132, 205, 'Idlib', 'ID', 1),
(3133, 205, 'Rif Dimashq', 'RD', 1),
(3134, 205, 'Tartus', 'TA', 1),
(3135, 206, 'Chang-hua', 'CH', 1),
(3136, 206, 'Chia-i', 'CI', 1),
(3137, 206, 'Hsin-chu', 'HS', 1),
(3138, 206, 'Hua-lien', 'HL', 1),
(3139, 206, 'I-lan', 'IL', 1),
(3140, 206, 'Kao-hsiung county', 'KH', 1),
(3141, 206, 'Kin-men', 'KM', 1),
(3142, 206, 'Lien-chiang', 'LC', 1),
(3143, 206, 'Miao-li', 'ML', 1),
(3144, 206, 'Nan-t\'ou', 'NT', 1),
(3145, 206, 'P\'eng-hu', 'PH', 1),
(3146, 206, 'P\'ing-tung', 'PT', 1),
(3147, 206, 'T\'ai-chung', 'TG', 1),
(3148, 206, 'T\'ai-nan', 'TA', 1),
(3149, 206, 'T\'ai-pei county', 'TP', 1),
(3150, 206, 'T\'ai-tung', 'TT', 1),
(3151, 206, 'T\'ao-yuan', 'TY', 1),
(3152, 206, 'Yun-lin', 'YL', 1),
(3153, 206, 'Chia-i city', 'CC', 1),
(3154, 206, 'Chi-lung', 'CL', 1),
(3155, 206, 'Hsin-chu', 'HC', 1);
INSERT INTO `ci_country_zones` (`zone_id`, `country_id`, `name`, `code`, `enabled`) VALUES
(3156, 206, 'T\'ai-chung', 'TH', 1),
(3157, 206, 'T\'ai-nan', 'TN', 1),
(3158, 206, 'Kao-hsiung city', 'KC', 1),
(3159, 206, 'T\'ai-pei city', 'TC', 1),
(3160, 207, 'Gorno-Badakhstan', 'GB', 1),
(3161, 207, 'Khatlon', 'KT', 1),
(3162, 207, 'Sughd', 'SU', 1),
(3163, 208, 'Arusha', 'AR', 1),
(3164, 208, 'Dar es Salaam', 'DS', 1),
(3165, 208, 'Dodoma', 'DO', 1),
(3166, 208, 'Iringa', 'IR', 1),
(3167, 208, 'Kagera', 'KA', 1),
(3168, 208, 'Kigoma', 'KI', 1),
(3169, 208, 'Kilimanjaro', 'KJ', 1),
(3170, 208, 'Lindi', 'LN', 1),
(3171, 208, 'Manyara', 'MY', 1),
(3172, 208, 'Mara', 'MR', 1),
(3173, 208, 'Mbeya', 'MB', 1),
(3174, 208, 'Morogoro', 'MO', 1),
(3175, 208, 'Mtwara', 'MT', 1),
(3176, 208, 'Mwanza', 'MW', 1),
(3177, 208, 'Pemba North', 'PN', 1),
(3178, 208, 'Pemba South', 'PS', 1),
(3179, 208, 'Pwani', 'PW', 1),
(3180, 208, 'Rukwa', 'RK', 1),
(3181, 208, 'Ruvuma', 'RV', 1),
(3182, 208, 'Shinyanga', 'SH', 1),
(3183, 208, 'Singida', 'SI', 1),
(3184, 208, 'Tabora', 'TB', 1),
(3185, 208, 'Tanga', 'TN', 1),
(3186, 208, 'Zanzibar Central/South', 'ZC', 1),
(3187, 208, 'Zanzibar North', 'ZN', 1),
(3188, 208, 'Zanzibar Urban/West', 'ZU', 1),
(3189, 209, 'Amnat Charoen', 'Amnat Charoen', 1),
(3190, 209, 'Ang Thong', 'Ang Thong', 1),
(3191, 209, 'Ayutthaya', 'Ayutthaya', 1),
(3192, 209, 'Bangkok', 'Bangkok', 1),
(3193, 209, 'Buriram', 'Buriram', 1),
(3194, 209, 'Chachoengsao', 'Chachoengsao', 1),
(3195, 209, 'Chai Nat', 'Chai Nat', 1),
(3196, 209, 'Chaiyaphum', 'Chaiyaphum', 1),
(3197, 209, 'Chanthaburi', 'Chanthaburi', 1),
(3198, 209, 'Chiang Mai', 'Chiang Mai', 1),
(3199, 209, 'Chiang Rai', 'Chiang Rai', 1),
(3200, 209, 'Chon Buri', 'Chon Buri', 1),
(3201, 209, 'Chumphon', 'Chumphon', 1),
(3202, 209, 'Kalasin', 'Kalasin', 1),
(3203, 209, 'Kamphaeng Phet', 'Kamphaeng Phet', 1),
(3204, 209, 'Kanchanaburi', 'Kanchanaburi', 1),
(3205, 209, 'Khon Kaen', 'Khon Kaen', 1),
(3206, 209, 'Krabi', 'Krabi', 1),
(3207, 209, 'Lampang', 'Lampang', 1),
(3208, 209, 'Lamphun', 'Lamphun', 1),
(3209, 209, 'Loei', 'Loei', 1),
(3210, 209, 'Lop Buri', 'Lop Buri', 1),
(3211, 209, 'Mae Hong Son', 'Mae Hong Son', 1),
(3212, 209, 'Maha Sarakham', 'Maha Sarakham', 1),
(3213, 209, 'Mukdahan', 'Mukdahan', 1),
(3214, 209, 'Nakhon Nayok', 'Nakhon Nayok', 1),
(3215, 209, 'Nakhon Pathom', 'Nakhon Pathom', 1),
(3216, 209, 'Nakhon Phanom', 'Nakhon Phanom', 1),
(3217, 209, 'Nakhon Ratchasima', 'Nakhon Ratchasima', 1),
(3218, 209, 'Nakhon Sawan', 'Nakhon Sawan', 1),
(3219, 209, 'Nakhon Si Thammarat', 'Nakhon Si Thammarat', 1),
(3220, 209, 'Nan', 'Nan', 1),
(3221, 209, 'Narathiwat', 'Narathiwat', 1),
(3222, 209, 'Nong Bua Lamphu', 'Nong Bua Lamphu', 1),
(3223, 209, 'Nong Khai', 'Nong Khai', 1),
(3224, 209, 'Nonthaburi', 'Nonthaburi', 1),
(3225, 209, 'Pathum Thani', 'Pathum Thani', 1),
(3226, 209, 'Pattani', 'Pattani', 1),
(3227, 209, 'Phangnga', 'Phangnga', 1),
(3228, 209, 'Phatthalung', 'Phatthalung', 1),
(3229, 209, 'Phayao', 'Phayao', 1),
(3230, 209, 'Phetchabun', 'Phetchabun', 1),
(3231, 209, 'Phetchaburi', 'Phetchaburi', 1),
(3232, 209, 'Phichit', 'Phichit', 1),
(3233, 209, 'Phitsanulok', 'Phitsanulok', 1),
(3234, 209, 'Phrae', 'Phrae', 1),
(3235, 209, 'Phuket', 'Phuket', 1),
(3236, 209, 'Prachin Buri', 'Prachin Buri', 1),
(3237, 209, 'Prachuap Khiri Khan', 'Prachuap Khiri Khan', 1),
(3238, 209, 'Ranong', 'Ranong', 1),
(3239, 209, 'Ratchaburi', 'Ratchaburi', 1),
(3240, 209, 'Rayong', 'Rayong', 1),
(3241, 209, 'Roi Et', 'Roi Et', 1),
(3242, 209, 'Sa Kaeo', 'Sa Kaeo', 1),
(3243, 209, 'Sakon Nakhon', 'Sakon Nakhon', 1),
(3244, 209, 'Samut Prakan', 'Samut Prakan', 1),
(3245, 209, 'Samut Sakhon', 'Samut Sakhon', 1),
(3246, 209, 'Samut Songkhram', 'Samut Songkhram', 1),
(3247, 209, 'Sara Buri', 'Sara Buri', 1),
(3248, 209, 'Satun', 'Satun', 1),
(3249, 209, 'Sing Buri', 'Sing Buri', 1),
(3250, 209, 'Sisaket', 'Sisaket', 1),
(3251, 209, 'Songkhla', 'Songkhla', 1),
(3252, 209, 'Sukhothai', 'Sukhothai', 1),
(3253, 209, 'Suphan Buri', 'Suphan Buri', 1),
(3254, 209, 'Surat Thani', 'Surat Thani', 1),
(3255, 209, 'Surin', 'Surin', 1),
(3256, 209, 'Tak', 'Tak', 1),
(3257, 209, 'Trang', 'Trang', 1),
(3258, 209, 'Trat', 'Trat', 1),
(3259, 209, 'Ubon Ratchathani', 'Ubon Ratchathani', 1),
(3260, 209, 'Udon Thani', 'Udon Thani', 1),
(3261, 209, 'Uthai Thani', 'Uthai Thani', 1),
(3262, 209, 'Uttaradit', 'Uttaradit', 1),
(3263, 209, 'Yala', 'Yala', 1),
(3264, 209, 'Yasothon', 'Yasothon', 1),
(3265, 210, 'Kara', 'K', 1),
(3266, 210, 'Plateaux', 'P', 1),
(3267, 210, 'Savanes', 'S', 1),
(3268, 210, 'Centrale', 'C', 1),
(3269, 210, 'Maritime', 'M', 1),
(3270, 211, 'Atafu', 'A', 1),
(3271, 211, 'Fakaofo', 'F', 1),
(3272, 211, 'Nukunonu', 'N', 1),
(3273, 212, 'Ha\'apai', 'H', 1),
(3274, 212, 'Tongatapu', 'T', 1),
(3275, 212, 'Vava\'u', 'V', 1),
(3276, 213, 'Couva/Tabaquite/Talparo', 'CT', 1),
(3277, 213, 'Diego Martin', 'DM', 1),
(3278, 213, 'Mayaro/Rio Claro', 'MR', 1),
(3279, 213, 'Penal/Debe', 'PD', 1),
(3280, 213, 'Princes Town', 'PT', 1),
(3281, 213, 'Sangre Grande', 'SG', 1),
(3282, 213, 'San Juan/Laventille', 'SL', 1),
(3283, 213, 'Siparia', 'SI', 1),
(3284, 213, 'Tunapuna/Piarco', 'TP', 1),
(3285, 213, 'Port of Spain', 'PS', 1),
(3286, 213, 'San Fernando', 'SF', 1),
(3287, 213, 'Arima', 'AR', 1),
(3288, 213, 'Point Fortin', 'PF', 1),
(3289, 213, 'Chaguanas', 'CH', 1),
(3290, 213, 'Tobago', 'TO', 1),
(3291, 214, 'Ariana', 'AR', 1),
(3292, 214, 'Beja', 'BJ', 1),
(3293, 214, 'Ben Arous', 'BA', 1),
(3294, 214, 'Bizerte', 'BI', 1),
(3295, 214, 'Gabes', 'GB', 1),
(3296, 214, 'Gafsa', 'GF', 1),
(3297, 214, 'Jendouba', 'JE', 1),
(3298, 214, 'Kairouan', 'KR', 1),
(3299, 214, 'Kasserine', 'KS', 1),
(3300, 214, 'Kebili', 'KB', 1),
(3301, 214, 'Kef', 'KF', 1),
(3302, 214, 'Mahdia', 'MH', 1),
(3303, 214, 'Manouba', 'MN', 1),
(3304, 214, 'Medenine', 'ME', 1),
(3305, 214, 'Monastir', 'MO', 1),
(3306, 214, 'Nabeul', 'NA', 1),
(3307, 214, 'Sfax', 'SF', 1),
(3308, 214, 'Sidi', 'SD', 1),
(3309, 214, 'Siliana', 'SL', 1),
(3310, 214, 'Sousse', 'SO', 1),
(3311, 214, 'Tataouine', 'TA', 1),
(3312, 214, 'Tozeur', 'TO', 1),
(3313, 214, 'Tunis', 'TU', 1),
(3314, 214, 'Zaghouan', 'ZA', 1),
(3315, 215, 'Adana', 'ADA', 1),
(3316, 215, 'Adıyaman', 'ADI', 1),
(3317, 215, 'Afyonkarahisar', 'AFY', 1),
(3318, 215, 'Ağrı', 'AGR', 1),
(3319, 215, 'Aksaray', 'AKS', 1),
(3320, 215, 'Amasya', 'AMA', 1),
(3321, 215, 'Ankara', 'ANK', 1),
(3322, 215, 'Antalya', 'ANT', 1),
(3323, 215, 'Ardahan', 'ARD', 1),
(3324, 215, 'Artvin', 'ART', 1),
(3325, 215, 'Aydın', 'AYI', 1),
(3326, 215, 'Balıkesir', 'BAL', 1),
(3327, 215, 'Bartın', 'BAR', 1),
(3328, 215, 'Batman', 'BAT', 1),
(3329, 215, 'Bayburt', 'BAY', 1),
(3330, 215, 'Bilecik', 'BIL', 1),
(3331, 215, 'Bingöl', 'BIN', 1),
(3332, 215, 'Bitlis', 'BIT', 1),
(3333, 215, 'Bolu', 'BOL', 1),
(3334, 215, 'Burdur', 'BRD', 1),
(3335, 215, 'Bursa', 'BRS', 1),
(3336, 215, 'Çanakkale', 'CKL', 1),
(3337, 215, 'Çankırı', 'CKR', 1),
(3338, 215, 'Çorum', 'COR', 1),
(3339, 215, 'Denizli', 'DEN', 1),
(3340, 215, 'Diyarbakır', 'DIY', 1),
(3341, 215, 'Düzce', 'DUZ', 1),
(3342, 215, 'Edirne', 'EDI', 1),
(3343, 215, 'Elazığ', 'ELA', 1),
(3344, 215, 'Erzincan', 'EZC', 1),
(3345, 215, 'Erzurum', 'EZR', 1),
(3346, 215, 'Eskişehir', 'ESK', 1),
(3347, 215, 'Gaziantep', 'GAZ', 1),
(3348, 215, 'Giresun', 'GIR', 1),
(3349, 215, 'Gümüşhane', 'GMS', 1),
(3350, 215, 'Hakkari', 'HKR', 1),
(3351, 215, 'Hatay', 'HTY', 1),
(3352, 215, 'Iğdır', 'IGD', 1),
(3353, 215, 'Isparta', 'ISP', 1),
(3354, 215, 'İstanbul', 'IST', 1),
(3355, 215, 'İzmir', 'IZM', 1),
(3356, 215, 'Kahramanmaraş', 'KAH', 1),
(3357, 215, 'Karabük', 'KRB', 1),
(3358, 215, 'Karaman', 'KRM', 1),
(3359, 215, 'Kars', 'KRS', 1),
(3360, 215, 'Kastamonu', 'KAS', 1),
(3361, 215, 'Kayseri', 'KAY', 1),
(3362, 215, 'Kilis', 'KLS', 1),
(3363, 215, 'Kırıkkale', 'KRK', 1),
(3364, 215, 'Kırklareli', 'KLR', 1),
(3365, 215, 'Kırşehir', 'KRH', 1),
(3366, 215, 'Kocaeli', 'KOC', 1),
(3367, 215, 'Konya', 'KON', 1),
(3368, 215, 'Kütahya', 'KUT', 1),
(3369, 215, 'Malatya', 'MAL', 1),
(3370, 215, 'Manisa', 'MAN', 1),
(3371, 215, 'Mardin', 'MAR', 1),
(3372, 215, 'Mersin', 'MER', 1),
(3373, 215, 'Muğla', 'MUG', 1),
(3374, 215, 'Muş', 'MUS', 1),
(3375, 215, 'Nevşehir', 'NEV', 1),
(3376, 215, 'Niğde', 'NIG', 1),
(3377, 215, 'Ordu', 'ORD', 1),
(3378, 215, 'Osmaniye', 'OSM', 1),
(3379, 215, 'Rize', 'RIZ', 1),
(3380, 215, 'Sakarya', 'SAK', 1),
(3381, 215, 'Samsun', 'SAM', 1),
(3382, 215, 'Şanlıurfa', 'SAN', 1),
(3383, 215, 'Siirt', 'SII', 1),
(3384, 215, 'Sinop', 'SIN', 1),
(3385, 215, 'Şırnak', 'SIR', 1),
(3386, 215, 'Sivas', 'SIV', 1),
(3387, 215, 'Tekirdağ', 'TEL', 1),
(3388, 215, 'Tokat', 'TOK', 1),
(3389, 215, 'Trabzon', 'TRA', 1),
(3390, 215, 'Tunceli', 'TUN', 1),
(3391, 215, 'Uşak', 'USK', 1),
(3392, 215, 'Van', 'VAN', 1),
(3393, 215, 'Yalova', 'YAL', 1),
(3394, 215, 'Yozgat', 'YOZ', 1),
(3395, 215, 'Zonguldak', 'ZON', 1),
(3396, 216, 'Ahal Welayaty', 'A', 1),
(3397, 216, 'Balkan Welayaty', 'B', 1),
(3398, 216, 'Dashhowuz Welayaty', 'D', 1),
(3399, 216, 'Lebap Welayaty', 'L', 1),
(3400, 216, 'Mary Welayaty', 'M', 1),
(3401, 217, 'Ambergris Cays', 'AC', 1),
(3402, 217, 'Dellis Cay', 'DC', 1),
(3403, 217, 'French Cay', 'FC', 1),
(3404, 217, 'Little Water Cay', 'LW', 1),
(3405, 217, 'Parrot Cay', 'RC', 1),
(3406, 217, 'Pine Cay', 'PN', 1),
(3407, 217, 'Salt Cay', 'SL', 1),
(3408, 217, 'Grand Turk', 'GT', 1),
(3409, 217, 'South Caicos', 'SC', 1),
(3410, 217, 'East Caicos', 'EC', 1),
(3411, 217, 'Middle Caicos', 'MC', 1),
(3412, 217, 'North Caicos', 'NC', 1),
(3413, 217, 'Providenciales', 'PR', 1),
(3414, 217, 'West Caicos', 'WC', 1),
(3415, 218, 'Nanumanga', 'NMG', 1),
(3416, 218, 'Niulakita', 'NLK', 1),
(3417, 218, 'Niutao', 'NTO', 1),
(3418, 218, 'Funafuti', 'FUN', 1),
(3419, 218, 'Nanumea', 'NME', 1),
(3420, 218, 'Nui', 'NUI', 1),
(3421, 218, 'Nukufetau', 'NFT', 1),
(3422, 218, 'Nukulaelae', 'NLL', 1),
(3423, 218, 'Vaitupu', 'VAI', 1),
(3424, 219, 'Kalangala', 'KAL', 1),
(3425, 219, 'Kampala', 'KMP', 1),
(3426, 219, 'Kayunga', 'KAY', 1),
(3427, 219, 'Kiboga', 'KIB', 1),
(3428, 219, 'Luwero', 'LUW', 1),
(3429, 219, 'Masaka', 'MAS', 1),
(3430, 219, 'Mpigi', 'MPI', 1),
(3431, 219, 'Mubende', 'MUB', 1),
(3432, 219, 'Mukono', 'MUK', 1),
(3433, 219, 'Nakasongola', 'NKS', 1),
(3434, 219, 'Rakai', 'RAK', 1),
(3435, 219, 'Sembabule', 'SEM', 1),
(3436, 219, 'Wakiso', 'WAK', 1),
(3437, 219, 'Bugiri', 'BUG', 1),
(3438, 219, 'Busia', 'BUS', 1),
(3439, 219, 'Iganga', 'IGA', 1),
(3440, 219, 'Jinja', 'JIN', 1),
(3441, 219, 'Kaberamaido', 'KAB', 1),
(3442, 219, 'Kamuli', 'KML', 1),
(3443, 219, 'Kapchorwa', 'KPC', 1),
(3444, 219, 'Katakwi', 'KTK', 1),
(3445, 219, 'Kumi', 'KUM', 1),
(3446, 219, 'Mayuge', 'MAY', 1),
(3447, 219, 'Mbale', 'MBA', 1),
(3448, 219, 'Pallisa', 'PAL', 1),
(3449, 219, 'Sironko', 'SIR', 1),
(3450, 219, 'Soroti', 'SOR', 1),
(3451, 219, 'Tororo', 'TOR', 1),
(3452, 219, 'Adjumani', 'ADJ', 1),
(3453, 219, 'Apac', 'APC', 1),
(3454, 219, 'Arua', 'ARU', 1),
(3455, 219, 'Gulu', 'GUL', 1),
(3456, 219, 'Kitgum', 'KIT', 1),
(3457, 219, 'Kotido', 'KOT', 1),
(3458, 219, 'Lira', 'LIR', 1),
(3459, 219, 'Moroto', 'MRT', 1),
(3460, 219, 'Moyo', 'MOY', 1),
(3461, 219, 'Nakapiripirit', 'NAK', 1),
(3462, 219, 'Nebbi', 'NEB', 1),
(3463, 219, 'Pader', 'PAD', 1),
(3464, 219, 'Yumbe', 'YUM', 1),
(3465, 219, 'Bundibugyo', 'BUN', 1),
(3466, 219, 'Bushenyi', 'BSH', 1),
(3467, 219, 'Hoima', 'HOI', 1),
(3468, 219, 'Kabale', 'KBL', 1),
(3469, 219, 'Kabarole', 'KAR', 1),
(3470, 219, 'Kamwenge', 'KAM', 1),
(3471, 219, 'Kanungu', 'KAN', 1),
(3472, 219, 'Kasese', 'KAS', 1),
(3473, 219, 'Kibaale', 'KBA', 1),
(3474, 219, 'Kisoro', 'KIS', 1),
(3475, 219, 'Kyenjojo', 'KYE', 1),
(3476, 219, 'Masindi', 'MSN', 1),
(3477, 219, 'Mbarara', 'MBR', 1),
(3478, 219, 'Ntungamo', 'NTU', 1),
(3479, 219, 'Rukungiri', 'RUK', 1),
(3480, 220, 'Cherkas\'ka Oblast\'', '71', 1),
(3481, 220, 'Chernihivs\'ka Oblast\'', '74', 1),
(3482, 220, 'Chernivets\'ka Oblast\'', '77', 1),
(3483, 220, 'Crimea', '43', 1),
(3484, 220, 'Dnipropetrovs\'ka Oblast\'', '12', 1),
(3485, 220, 'Donets\'ka Oblast\'', '14', 1),
(3486, 220, 'Ivano-Frankivs\'ka Oblast\'', '26', 1),
(3487, 220, 'Khersons\'ka Oblast\'', '65', 1),
(3488, 220, 'Khmel\'nyts\'ka Oblast\'', '68', 1),
(3489, 220, 'Kirovohrads\'ka Oblast\'', '35', 1),
(3490, 220, 'Kyiv', '30', 1),
(3491, 220, 'Kyivs\'ka Oblast\'', '32', 1),
(3492, 220, 'Luhans\'ka Oblast\'', '09', 1),
(3493, 220, 'L\'vivs\'ka Oblast\'', '46', 1),
(3494, 220, 'Mykolayivs\'ka Oblast\'', '48', 1),
(3495, 220, 'Odes\'ka Oblast\'', '51', 1),
(3496, 220, 'Poltavs\'ka Oblast\'', '53', 1),
(3497, 220, 'Rivnens\'ka Oblast\'', '56', 1),
(3498, 220, 'Sevastopol\'', '40', 1),
(3499, 220, 'Sums\'ka Oblast\'', '59', 1),
(3500, 220, 'Ternopil\'s\'ka Oblast\'', '61', 1),
(3501, 220, 'Vinnyts\'ka Oblast\'', '05', 1),
(3502, 220, 'Volyns\'ka Oblast\'', '07', 1),
(3503, 220, 'Zakarpats\'ka Oblast\'', '21', 1),
(3504, 220, 'Zaporiz\'ka Oblast\'', '23', 1),
(3505, 220, 'Zhytomyrs\'ka oblast\'', '18', 1),
(3506, 221, 'Abu Dhabi', 'ADH', 1),
(3507, 221, '\'Ajman', 'AJ', 1),
(3508, 221, 'Al Fujayrah', 'FU', 1),
(3509, 221, 'Ash Shariqah', 'SH', 1),
(3510, 221, 'Dubai', 'DU', 1),
(3511, 221, 'R\'as al Khaymah', 'RK', 1),
(3512, 221, 'Umm al Qaywayn', 'UQ', 1),
(3513, 222, 'Aberdeen', 'ABN', 1),
(3514, 222, 'Aberdeenshire', 'ABNS', 1),
(3515, 222, 'Anglesey', 'ANG', 1),
(3516, 222, 'Angus', 'AGS', 1),
(3517, 222, 'Argyll and Bute', 'ARY', 1),
(3518, 222, 'Bedfordshire', 'BEDS', 1),
(3519, 222, 'Berkshire', 'BERKS', 1),
(3520, 222, 'Blaenau Gwent', 'BLA', 1),
(3521, 222, 'Bridgend', 'BRI', 1),
(3522, 222, 'Bristol', 'BSTL', 1),
(3523, 222, 'Buckinghamshire', 'BUCKS', 1),
(3524, 222, 'Caerphilly', 'CAE', 1),
(3525, 222, 'Cambridgeshire', 'CAMBS', 1),
(3526, 222, 'Cardiff', 'CDF', 1),
(3527, 222, 'Carmarthenshire', 'CARM', 1),
(3528, 222, 'Ceredigion', 'CDGN', 1),
(3529, 222, 'Cheshire', 'CHES', 1),
(3530, 222, 'Clackmannanshire', 'CLACK', 1),
(3531, 222, 'Conwy', 'CON', 1),
(3532, 222, 'Cornwall', 'CORN', 1),
(3533, 222, 'Denbighshire', 'DNBG', 1),
(3534, 222, 'Derbyshire', 'DERBY', 1),
(3535, 222, 'Devon', 'DVN', 1),
(3536, 222, 'Dorset', 'DOR', 1),
(3537, 222, 'Dumfries and Galloway', 'DGL', 1),
(3538, 222, 'Dundee', 'DUND', 1),
(3539, 222, 'Durham', 'DHM', 1),
(3540, 222, 'East Ayrshire', 'ARYE', 1),
(3541, 222, 'East Dunbartonshire', 'DUNBE', 1),
(3542, 222, 'East Lothian', 'LOTE', 1),
(3543, 222, 'East Renfrewshire', 'RENE', 1),
(3544, 222, 'East Riding of Yorkshire', 'ERYS', 1),
(3545, 222, 'East Sussex', 'SXE', 1),
(3546, 222, 'Edinburgh', 'EDIN', 1),
(3547, 222, 'Essex', 'ESX', 1),
(3548, 222, 'Falkirk', 'FALK', 1),
(3549, 222, 'Fife', 'FFE', 1),
(3550, 222, 'Flintshire', 'FLINT', 1),
(3551, 222, 'Glasgow', 'GLAS', 1),
(3552, 222, 'Gloucestershire', 'GLOS', 1),
(3553, 222, 'Greater London', 'LDN', 1),
(3554, 222, 'Greater Manchester', 'MCH', 1),
(3555, 222, 'Gwynedd', 'GDD', 1),
(3556, 222, 'Hampshire', 'HANTS', 1),
(3557, 222, 'Herefordshire', 'HWR', 1),
(3558, 222, 'Hertfordshire', 'HERTS', 1),
(3559, 222, 'Highlands', 'HLD', 1),
(3560, 222, 'Inverclyde', 'IVER', 1),
(3561, 222, 'Isle of Wight', 'IOW', 1),
(3562, 222, 'Kent', 'KNT', 1),
(3563, 222, 'Lancashire', 'LANCS', 1),
(3564, 222, 'Leicestershire', 'LEICS', 1),
(3565, 222, 'Lincolnshire', 'LINCS', 1),
(3566, 222, 'Merseyside', 'MSY', 1),
(3567, 222, 'Merthyr Tydfil', 'MERT', 1),
(3568, 222, 'Midlothian', 'MLOT', 1),
(3569, 222, 'Monmouthshire', 'MMOUTH', 1),
(3570, 222, 'Moray', 'MORAY', 1),
(3571, 222, 'Neath Port Talbot', 'NPRTAL', 1),
(3572, 222, 'Newport', 'NEWPT', 1),
(3573, 222, 'Norfolk', 'NOR', 1),
(3574, 222, 'North Ayrshire', 'ARYN', 1),
(3575, 222, 'North Lanarkshire', 'LANN', 1),
(3576, 222, 'North Yorkshire', 'YSN', 1),
(3577, 222, 'Northamptonshire', 'NHM', 1),
(3578, 222, 'Northumberland', 'NLD', 1),
(3579, 222, 'Nottinghamshire', 'NOT', 1),
(3580, 222, 'Orkney Islands', 'ORK', 1),
(3581, 222, 'Oxfordshire', 'OFE', 1),
(3582, 222, 'Pembrokeshire', 'PEM', 1),
(3583, 222, 'Perth and Kinross', 'PERTH', 1),
(3584, 222, 'Powys', 'PWS', 1),
(3585, 222, 'Renfrewshire', 'REN', 1),
(3586, 222, 'Rhondda Cynon Taff', 'RHON', 1),
(3587, 222, 'Rutland', 'RUT', 1),
(3588, 222, 'Scottish Borders', 'BOR', 1),
(3589, 222, 'Shetland Islands', 'SHET', 1),
(3590, 222, 'Shropshire', 'SPE', 1),
(3591, 222, 'Somerset', 'SOM', 1),
(3592, 222, 'South Ayrshire', 'ARYS', 1),
(3593, 222, 'South Lanarkshire', 'LANS', 1),
(3594, 222, 'South Yorkshire', 'YSS', 1),
(3595, 222, 'Staffordshire', 'SFD', 1),
(3596, 222, 'Stirling', 'STIR', 1),
(3597, 222, 'Suffolk', 'SFK', 1),
(3598, 222, 'Surrey', 'SRY', 1),
(3599, 222, 'Swansea', 'SWAN', 1),
(3600, 222, 'Torfaen', 'TORF', 1),
(3601, 222, 'Tyne and Wear', 'TWR', 1),
(3602, 222, 'Vale of Glamorgan', 'VGLAM', 1),
(3603, 222, 'Warwickshire', 'WARKS', 1),
(3604, 222, 'West Dunbartonshire', 'WDUN', 1),
(3605, 222, 'West Lothian', 'WLOT', 1),
(3606, 222, 'West Midlands', 'WMD', 1),
(3607, 222, 'West Sussex', 'SXW', 1),
(3608, 222, 'West Yorkshire', 'YSW', 1),
(3609, 222, 'Western Isles', 'WIL', 1),
(3610, 222, 'Wiltshire', 'WLT', 1),
(3611, 222, 'Worcestershire', 'WORCS', 1),
(3612, 222, 'Wrexham', 'WRX', 1),
(3613, 223, 'Alabama', 'AL', 1),
(3614, 223, 'Alaska', 'AK', 1),
(3615, 223, 'American Samoa', 'AS', 1),
(3616, 223, 'Arizona', 'AZ', 1),
(3617, 223, 'Arkansas', 'AR', 1),
(3618, 223, 'Armed Forces Africa', 'AF', 1),
(3619, 223, 'Armed Forces Americas', 'AA', 1),
(3620, 223, 'Armed Forces Canada', 'AC', 1),
(3621, 223, 'Armed Forces Europe', 'AE', 1),
(3622, 223, 'Armed Forces Middle East', 'AM', 1),
(3623, 223, 'Armed Forces Pacific', 'AP', 1),
(3624, 223, 'California', 'CA', 1),
(3625, 223, 'Colorado', 'CO', 1),
(3626, 223, 'Connecticut', 'CT', 1),
(3627, 223, 'Delaware', 'DE', 1),
(3628, 223, 'District of Columbia', 'DC', 1),
(3629, 223, 'Federated States Of Micronesia', 'FM', 1),
(3630, 223, 'Florida', 'FL', 1),
(3631, 223, 'Georgia', 'GA', 1),
(3632, 223, 'Guam', 'GU', 1),
(3633, 223, 'Hawaii', 'HI', 1),
(3634, 223, 'Idaho', 'ID', 1),
(3635, 223, 'Illinois', 'IL', 1),
(3636, 223, 'Indiana', 'IN', 1),
(3637, 223, 'Iowa', 'IA', 1),
(3638, 223, 'Kansas', 'KS', 1),
(3639, 223, 'Kentucky', 'KY', 1),
(3640, 223, 'Louisiana', 'LA', 1),
(3641, 223, 'Maine', 'ME', 1),
(3642, 223, 'Marshall Islands', 'MH', 1),
(3643, 223, 'Maryland', 'MD', 1),
(3644, 223, 'Massachusetts', 'MA', 1),
(3645, 223, 'Michigan', 'MI', 1),
(3646, 223, 'Minnesota', 'MN', 1),
(3647, 223, 'Mississippi', 'MS', 1),
(3648, 223, 'Missouri', 'MO', 1),
(3649, 223, 'Montana', 'MT', 1),
(3650, 223, 'Nebraska', 'NE', 1),
(3651, 223, 'Nevada', 'NV', 1),
(3652, 223, 'New Hampshire', 'NH', 1),
(3653, 223, 'New Jersey', 'NJ', 1),
(3654, 223, 'New Mexico', 'NM', 1),
(3655, 223, 'New York', 'NY', 1),
(3656, 223, 'North Carolina', 'NC', 1),
(3657, 223, 'North Dakota', 'ND', 1),
(3658, 223, 'Northern Mariana Islands', 'MP', 1),
(3659, 223, 'Ohio', 'OH', 1),
(3660, 223, 'Oklahoma', 'OK', 1),
(3661, 223, 'Oregon', 'OR', 1),
(3662, 223, 'Palau', 'PW', 1),
(3663, 223, 'Pennsylvania', 'PA', 1),
(3664, 223, 'Puerto Rico', 'PR', 1),
(3665, 223, 'Rhode Island', 'RI', 1),
(3666, 223, 'South Carolina', 'SC', 1),
(3667, 223, 'South Dakota', 'SD', 1),
(3668, 223, 'Tennessee', 'TN', 1),
(3669, 223, 'Texas', 'TX', 1),
(3670, 223, 'Utah', 'UT', 1),
(3671, 223, 'Vermont', 'VT', 1),
(3672, 223, 'Virgin Islands', 'VI', 1),
(3673, 223, 'Virginia', 'VA', 1),
(3674, 223, 'Washington', 'WA', 1),
(3675, 223, 'West Virginia', 'WV', 1),
(3676, 223, 'Wisconsin', 'WI', 1),
(3677, 223, 'Wyoming', 'WY', 1),
(3678, 224, 'Baker Island', 'BI', 1),
(3679, 224, 'Howland Island', 'HI', 1),
(3680, 224, 'Jarvis Island', 'JI', 1),
(3681, 224, 'Johnston Atoll', 'JA', 1),
(3682, 224, 'Kingman Reef', 'KR', 1),
(3683, 224, 'Midway Atoll', 'MA', 1),
(3684, 224, 'Navassa Island', 'NI', 1),
(3685, 224, 'Palmyra Atoll', 'PA', 1),
(3686, 224, 'Wake Island', 'WI', 1),
(3687, 225, 'Artigas', 'AR', 1),
(3688, 225, 'Canelones', 'CA', 1),
(3689, 225, 'Cerro Largo', 'CL', 1),
(3690, 225, 'Colonia', 'CO', 1),
(3691, 225, 'Durazno', 'DU', 1),
(3692, 225, 'Flores', 'FS', 1),
(3693, 225, 'Florida', 'FA', 1),
(3694, 225, 'Lavalleja', 'LA', 1),
(3695, 225, 'Maldonado', 'MA', 1),
(3696, 225, 'Montevideo', 'MO', 1),
(3697, 225, 'Paysandu', 'PA', 1),
(3698, 225, 'Rio Negro', 'RN', 1),
(3699, 225, 'Rivera', 'RV', 1),
(3700, 225, 'Rocha', 'RO', 1),
(3701, 225, 'Salto', 'SL', 1),
(3702, 225, 'San Jose', 'SJ', 1),
(3703, 225, 'Soriano', 'SO', 1),
(3704, 225, 'Tacuarembo', 'TA', 1),
(3705, 225, 'Treinta y Tres', 'TT', 1),
(3706, 226, 'Andijon', 'AN', 1),
(3707, 226, 'Buxoro', 'BU', 1),
(3708, 226, 'Farg\'ona', 'FA', 1),
(3709, 226, 'Jizzax', 'JI', 1),
(3710, 226, 'Namangan', 'NG', 1),
(3711, 226, 'Navoiy', 'NW', 1),
(3712, 226, 'Qashqadaryo', 'QA', 1),
(3713, 226, 'Qoraqalpog\'iston Republikasi', 'QR', 1),
(3714, 226, 'Samarqand', 'SA', 1),
(3715, 226, 'Sirdaryo', 'SI', 1),
(3716, 226, 'Surxondaryo', 'SU', 1),
(3717, 226, 'Toshkent City', 'TK', 1),
(3718, 226, 'Toshkent Region', 'TO', 1),
(3719, 226, 'Xorazm', 'XO', 1),
(3720, 227, 'Malampa', 'MA', 1),
(3721, 227, 'Penama', 'PE', 1),
(3722, 227, 'Sanma', 'SA', 1),
(3723, 227, 'Shefa', 'SH', 1),
(3724, 227, 'Tafea', 'TA', 1),
(3725, 227, 'Torba', 'TO', 1),
(3726, 229, 'Amazonas', 'AM', 1),
(3727, 229, 'Anzoategui', 'AN', 1),
(3728, 229, 'Apure', 'AP', 1),
(3729, 229, 'Aragua', 'AR', 1),
(3730, 229, 'Barinas', 'BA', 1),
(3731, 229, 'Bolivar', 'BO', 1),
(3732, 229, 'Carabobo', 'CA', 1),
(3733, 229, 'Cojedes', 'CO', 1),
(3734, 229, 'Delta Amacuro', 'DA', 1),
(3735, 229, 'Dependencias Federales', 'DF', 1),
(3736, 229, 'Distrito Federal', 'DI', 1),
(3737, 229, 'Falcon', 'FA', 1),
(3738, 229, 'Guarico', 'GU', 1),
(3739, 229, 'Lara', 'LA', 1),
(3740, 229, 'Merida', 'ME', 1),
(3741, 229, 'Miranda', 'MI', 1),
(3742, 229, 'Monagas', 'MO', 1),
(3743, 229, 'Nueva Esparta', 'NE', 1),
(3744, 229, 'Portuguesa', 'PO', 1),
(3745, 229, 'Sucre', 'SU', 1),
(3746, 229, 'Tachira', 'TA', 1),
(3747, 229, 'Trujillo', 'TR', 1),
(3748, 229, 'Vargas', 'VA', 1),
(3749, 229, 'Yaracuy', 'YA', 1),
(3750, 229, 'Zulia', 'ZU', 1),
(3751, 230, 'An Giang', 'AG', 1),
(3752, 230, 'Bac Giang', 'BG', 1),
(3753, 230, 'Bac Kan', 'BK', 1),
(3754, 230, 'Bac Lieu', 'BL', 1),
(3755, 230, 'Bac Ninh', 'BC', 1),
(3756, 230, 'Ba Ria-Vung Tau', 'BR', 1),
(3757, 230, 'Ben Tre', 'BN', 1),
(3758, 230, 'Binh Dinh', 'BH', 1),
(3759, 230, 'Binh Duong', 'BU', 1),
(3760, 230, 'Binh Phuoc', 'BP', 1),
(3761, 230, 'Binh Thuan', 'BT', 1),
(3762, 230, 'Ca Mau', 'CM', 1),
(3763, 230, 'Can Tho', 'CT', 1),
(3764, 230, 'Cao Bang', 'CB', 1),
(3765, 230, 'Dak Lak', 'DL', 1),
(3766, 230, 'Dak Nong', 'DG', 1),
(3767, 230, 'Da Nang', 'DN', 1),
(3768, 230, 'Dien Bien', 'DB', 1),
(3769, 230, 'Dong Nai', 'DI', 1),
(3770, 230, 'Dong Thap', 'DT', 1),
(3771, 230, 'Gia Lai', 'GL', 1),
(3772, 230, 'Ha Giang', 'HG', 1),
(3773, 230, 'Hai Duong', 'HD', 1),
(3774, 230, 'Hai Phong', 'HP', 1),
(3775, 230, 'Ha Nam', 'HM', 1),
(3776, 230, 'Ha Noi', 'HI', 1),
(3777, 230, 'Ha Tay', 'HT', 1),
(3778, 230, 'Ha Tinh', 'HH', 1),
(3779, 230, 'Hoa Binh', 'HB', 1),
(3780, 230, 'Ho Chi Minh City', 'HC', 1),
(3781, 230, 'Hau Giang', 'HU', 1),
(3782, 230, 'Hung Yen', 'HY', 1),
(3783, 232, 'Saint Croix', 'C', 1),
(3784, 232, 'Saint John', 'J', 1),
(3785, 232, 'Saint Thomas', 'T', 1),
(3786, 233, 'Alo', 'A', 1),
(3787, 233, 'Sigave', 'S', 1),
(3788, 233, 'Wallis', 'W', 1),
(3789, 235, 'Abyan', 'AB', 1),
(3790, 235, 'Adan', 'AD', 1),
(3791, 235, 'Amran', 'AM', 1),
(3792, 235, 'Al Bayda', 'BA', 1),
(3793, 235, 'Ad Dali', 'DA', 1),
(3794, 235, 'Dhamar', 'DH', 1),
(3795, 235, 'Hadramawt', 'HD', 1),
(3796, 235, 'Hajjah', 'HJ', 1),
(3797, 235, 'Al Hudaydah', 'HU', 1),
(3798, 235, 'Ibb', 'IB', 1),
(3799, 235, 'Al Jawf', 'JA', 1),
(3800, 235, 'Lahij', 'LA', 1),
(3801, 235, 'Ma\'rib', 'MA', 1),
(3802, 235, 'Al Mahrah', 'MR', 1),
(3803, 235, 'Al Mahwit', 'MW', 1),
(3804, 235, 'Sa\'dah', 'SD', 1),
(3805, 235, 'San\'a', 'SN', 1),
(3806, 235, 'Shabwah', 'SH', 1),
(3807, 235, 'Ta\'izz', 'TA', 1),
(3812, 237, 'Bas-Congo', 'BC', 1),
(3813, 237, 'Bandundu', 'BN', 1),
(3814, 237, 'Equateur', 'EQ', 1),
(3815, 237, 'Katanga', 'KA', 1),
(3816, 237, 'Kasai-Oriental', 'KE', 1),
(3817, 237, 'Kinshasa', 'KN', 1),
(3818, 237, 'Kasai-Occidental', 'KW', 1),
(3819, 237, 'Maniema', 'MA', 1),
(3820, 237, 'Nord-Kivu', 'NK', 1),
(3821, 237, 'Orientale', 'OR', 1),
(3822, 237, 'Sud-Kivu', 'SK', 1),
(3823, 238, 'Central', 'CE', 1),
(3824, 238, 'Copperbelt', 'CB', 1),
(3825, 238, 'Eastern', 'EA', 1),
(3826, 238, 'Luapula', 'LP', 1),
(3827, 238, 'Lusaka', 'LK', 1),
(3828, 238, 'Northern', 'NO', 1),
(3829, 238, 'North-Western', 'NW', 1),
(3830, 238, 'Southern', 'SO', 1),
(3831, 238, 'Western', 'WE', 1),
(3832, 239, 'Bulawayo', 'BU', 1),
(3833, 239, 'Harare', 'HA', 1),
(3834, 239, 'Manicaland', 'ML', 1),
(3835, 239, 'Mashonaland Central', 'MC', 1),
(3836, 239, 'Mashonaland East', 'ME', 1),
(3837, 239, 'Mashonaland West', 'MW', 1),
(3838, 239, 'Masvingo', 'MV', 1),
(3839, 239, 'Matabeleland North', 'MN', 1),
(3840, 239, 'Matabeleland South', 'MS', 1),
(3841, 239, 'Midlands', 'MD', 1),
(3842, 105, 'Agrigento', 'AG', 1),
(3843, 105, 'Alessandria', 'AL', 1),
(3844, 105, 'Ancona', 'AN', 1),
(3845, 105, 'Aosta', 'AO', 1),
(3846, 105, 'Arezzo', 'AR', 1),
(3847, 105, 'Ascoli Piceno', 'AP', 1),
(3848, 105, 'Asti', 'AT', 1),
(3849, 105, 'Avellino', 'AV', 1),
(3850, 105, 'Bari', 'BA', 1),
(3851, 105, 'Belluno', 'BL', 1),
(3852, 105, 'Benevento', 'BN', 1),
(3853, 105, 'Bergamo', 'BG', 1),
(3854, 105, 'Biella', 'BI', 1),
(3855, 105, 'Bologna', 'BO', 1),
(3856, 105, 'Bolzano', 'BZ', 1),
(3857, 105, 'Brescia', 'BS', 1),
(3858, 105, 'Brindisi', 'BR', 1),
(3859, 105, 'Cagliari', 'CA', 1),
(3860, 105, 'Caltanissetta', 'CL', 1),
(3861, 105, 'Campobasso', 'CB', 1),
(3863, 105, 'Caserta', 'CE', 1),
(3864, 105, 'Catania', 'CT', 1),
(3865, 105, 'Catanzaro', 'CZ', 1),
(3866, 105, 'Chieti', 'CH', 1),
(3867, 105, 'Como', 'CO', 1),
(3868, 105, 'Cosenza', 'CS', 1),
(3869, 105, 'Cremona', 'CR', 1),
(3870, 105, 'Crotone', 'KR', 1),
(3871, 105, 'Cuneo', 'CN', 1),
(3872, 105, 'Enna', 'EN', 1),
(3873, 105, 'Ferrara', 'FE', 1),
(3874, 105, 'Firenze', 'FI', 1),
(3875, 105, 'Foggia', 'FG', 1),
(3876, 105, 'Forli-Cesena', 'FC', 1),
(3877, 105, 'Frosinone', 'FR', 1),
(3878, 105, 'Genova', 'GE', 1),
(3879, 105, 'Gorizia', 'GO', 1),
(3880, 105, 'Grosseto', 'GR', 1),
(3881, 105, 'Imperia', 'IM', 1),
(3882, 105, 'Isernia', 'IS', 1),
(3883, 105, 'L&#39;Aquila', 'AQ', 1),
(3884, 105, 'La Spezia', 'SP', 1),
(3885, 105, 'Latina', 'LT', 1),
(3886, 105, 'Lecce', 'LE', 1),
(3887, 105, 'Lecco', 'LC', 1),
(3888, 105, 'Livorno', 'LI', 1),
(3889, 105, 'Lodi', 'LO', 1),
(3890, 105, 'Lucca', 'LU', 1),
(3891, 105, 'Macerata', 'MC', 1),
(3892, 105, 'Mantova', 'MN', 1),
(3893, 105, 'Massa-Carrara', 'MS', 1),
(3894, 105, 'Matera', 'MT', 1),
(3896, 105, 'Messina', 'ME', 1),
(3897, 105, 'Milano', 'MI', 1),
(3898, 105, 'Modena', 'MO', 1),
(3899, 105, 'Napoli', 'NA', 1),
(3900, 105, 'Novara', 'NO', 1),
(3901, 105, 'Nuoro', 'NU', 1),
(3904, 105, 'Oristano', 'OR', 1),
(3905, 105, 'Padova', 'PD', 1),
(3906, 105, 'Palermo', 'PA', 1),
(3907, 105, 'Parma', 'PR', 1),
(3908, 105, 'Pavia', 'PV', 1),
(3909, 105, 'Perugia', 'PG', 1),
(3910, 105, 'Pesaro e Urbino', 'PU', 1),
(3911, 105, 'Pescara', 'PE', 1),
(3912, 105, 'Piacenza', 'PC', 1),
(3913, 105, 'Pisa', 'PI', 1),
(3914, 105, 'Pistoia', 'PT', 1),
(3915, 105, 'Pordenone', 'PN', 1),
(3916, 105, 'Potenza', 'PZ', 1),
(3917, 105, 'Prato', 'PO', 1),
(3918, 105, 'Ragusa', 'RG', 1),
(3919, 105, 'Ravenna', 'RA', 1),
(3920, 105, 'Reggio Calabria', 'RC', 1),
(3921, 105, 'Reggio Emilia', 'RE', 1),
(3922, 105, 'Rieti', 'RI', 1),
(3923, 105, 'Rimini', 'RN', 1),
(3924, 105, 'Roma', 'RM', 1),
(3925, 105, 'Rovigo', 'RO', 1),
(3926, 105, 'Salerno', 'SA', 1),
(3927, 105, 'Sassari', 'SS', 1),
(3928, 105, 'Savona', 'SV', 1),
(3929, 105, 'Siena', 'SI', 1),
(3930, 105, 'Siracusa', 'SR', 1),
(3931, 105, 'Sondrio', 'SO', 1),
(3932, 105, 'Taranto', 'TA', 1),
(3933, 105, 'Teramo', 'TE', 1),
(3934, 105, 'Terni', 'TR', 1),
(3935, 105, 'Torino', 'TO', 1),
(3936, 105, 'Trapani', 'TP', 1),
(3937, 105, 'Trento', 'TN', 1),
(3938, 105, 'Treviso', 'TV', 1),
(3939, 105, 'Trieste', 'TS', 1),
(3940, 105, 'Udine', 'UD', 1),
(3941, 105, 'Varese', 'VA', 1),
(3942, 105, 'Venezia', 'VE', 1),
(3943, 105, 'Verbano-Cusio-Ossola', 'VB', 1),
(3944, 105, 'Vercelli', 'VC', 1),
(3945, 105, 'Verona', 'VR', 1),
(3946, 105, 'Vibo Valentia', 'VV', 1),
(3947, 105, 'Vicenza', 'VI', 1),
(3948, 105, 'Viterbo', 'VT', 1),
(3949, 222, 'County Antrim', 'ANT', 1),
(3950, 222, 'County Armagh', 'ARM', 1),
(3951, 222, 'County Down', 'DOW', 1),
(3952, 222, 'County Fermanagh', 'FER', 1),
(3953, 222, 'County Londonderry', 'LDY', 1),
(3954, 222, 'County Tyrone', 'TYR', 1),
(3955, 222, 'Cumbria', 'CMA', 1),
(3956, 190, 'Pomurska', '1', 1),
(3957, 190, 'Podravska', '2', 1),
(3958, 190, 'Koroška', '3', 1),
(3959, 190, 'Savinjska', '4', 1),
(3960, 190, 'Zasavska', '5', 1),
(3961, 190, 'Spodnjeposavska', '6', 1),
(3962, 190, 'Jugovzhodna Slovenija', '7', 1),
(3963, 190, 'Osrednjeslovenska', '8', 1),
(3964, 190, 'Gorenjska', '9', 1),
(3965, 190, 'Notranjsko-kraška', '10', 1),
(3966, 190, 'Goriška', '11', 1),
(3967, 190, 'Obalno-kraška', '12', 1),
(3968, 33, 'Ruse', '', 1),
(3969, 101, 'Alborz', 'ALB', 1),
(3970, 21, 'Brussels-Capital Region', 'BRU', 1),
(3971, 138, 'Aguascalientes', 'AG', 1),
(3973, 242, 'Andrijevica', '01', 1),
(3974, 242, 'Bar', '02', 1),
(3975, 242, 'Berane', '03', 1),
(3976, 242, 'Bijelo Polje', '04', 1),
(3977, 242, 'Budva', '05', 1),
(3978, 242, 'Cetinje', '06', 1),
(3979, 242, 'Danilovgrad', '07', 1),
(3980, 242, 'Herceg-Novi', '08', 1),
(3981, 242, 'Kolašin', '09', 1),
(3982, 242, 'Kotor', '10', 1),
(3983, 242, 'Mojkovac', '11', 1),
(3984, 242, 'Nikšić', '12', 1),
(3985, 242, 'Plav', '13', 1),
(3986, 242, 'Pljevlja', '14', 1),
(3987, 242, 'Plužine', '15', 1),
(3988, 242, 'Podgorica', '16', 1),
(3989, 242, 'Rožaje', '17', 1),
(3990, 242, 'Šavnik', '18', 1),
(3991, 242, 'Tivat', '19', 1),
(3992, 242, 'Ulcinj', '20', 1),
(3993, 242, 'Žabljak', '21', 1),
(3994, 243, 'Belgrade', '00', 1),
(3995, 243, 'North Bačka', '01', 1),
(3996, 243, 'Central Banat', '02', 1),
(3997, 243, 'North Banat', '03', 1),
(3998, 243, 'South Banat', '04', 1),
(3999, 243, 'West Bačka', '05', 1),
(4000, 243, 'South Bačka', '06', 1),
(4001, 243, 'Srem', '07', 1),
(4002, 243, 'Mačva', '08', 1),
(4003, 243, 'Kolubara', '09', 1),
(4004, 243, 'Podunavlje', '10', 1),
(4005, 243, 'Braničevo', '11', 1),
(4006, 243, 'Šumadija', '12', 1),
(4007, 243, 'Pomoravlje', '13', 1),
(4008, 243, 'Bor', '14', 1),
(4009, 243, 'Zaječar', '15', 1),
(4010, 243, 'Zlatibor', '16', 1),
(4011, 243, 'Moravica', '17', 1),
(4012, 243, 'Raška', '18', 1),
(4013, 243, 'Rasina', '19', 1),
(4014, 243, 'Nišava', '20', 1),
(4015, 243, 'Toplica', '21', 1),
(4016, 243, 'Pirot', '22', 1),
(4017, 243, 'Jablanica', '23', 1),
(4018, 243, 'Pčinja', '24', 1),
(4020, 245, 'Bonaire', 'BO', 1),
(4021, 245, 'Saba', 'SA', 1),
(4022, 245, 'Sint Eustatius', 'SE', 1),
(4023, 248, 'Central Equatoria', 'EC', 1),
(4024, 248, 'Eastern Equatoria', 'EE', 1),
(4025, 248, 'Jonglei', 'JG', 1),
(4026, 248, 'Lakes', 'LK', 1),
(4027, 248, 'Northern Bahr el-Ghazal', 'BN', 1),
(4028, 248, 'Unity', 'UY', 1),
(4029, 248, 'Upper Nile', 'NU', 1),
(4030, 248, 'Warrap', 'WR', 1),
(4031, 248, 'Western Bahr el-Ghazal', 'BW', 1),
(4032, 248, 'Western Equatoria', 'EW', 1),
(4035, 129, 'Putrajaya', 'MY-16', 1),
(4036, 117, 'Ainaži, Salacgrīvas novads', '0661405', 1),
(4037, 117, 'Aizkraukle, Aizkraukles novads', '0320201', 1),
(4038, 117, 'Aizkraukles novads', '0320200', 1),
(4039, 117, 'Aizpute, Aizputes novads', '0640605', 1),
(4040, 117, 'Aizputes novads', '0640600', 1),
(4041, 117, 'Aknīste, Aknīstes novads', '0560805', 1),
(4042, 117, 'Aknīstes novads', '0560800', 1),
(4043, 117, 'Aloja, Alojas novads', '0661007', 1),
(4044, 117, 'Alojas novads', '0661000', 1),
(4045, 117, 'Alsungas novads', '0624200', 1),
(4046, 117, 'Alūksne, Alūksnes novads', '0360201', 1),
(4047, 117, 'Alūksnes novads', '0360200', 1),
(4048, 117, 'Amatas novads', '0424701', 1),
(4049, 117, 'Ape, Apes novads', '0360805', 1),
(4050, 117, 'Apes novads', '0360800', 1),
(4051, 117, 'Auce, Auces novads', '0460805', 1),
(4052, 117, 'Auces novads', '0460800', 1),
(4053, 117, 'Ādažu novads', '0804400', 1),
(4054, 117, 'Babītes novads', '0804900', 1),
(4055, 117, 'Baldone, Baldones novads', '0800605', 1),
(4056, 117, 'Baldones novads', '0800600', 1),
(4057, 117, 'Baloži, Ķekavas novads', '0800807', 1),
(4058, 117, 'Baltinavas novads', '0384400', 1),
(4059, 117, 'Balvi, Balvu novads', '0380201', 1),
(4060, 117, 'Balvu novads', '0380200', 1),
(4061, 117, 'Bauska, Bauskas novads', '0400201', 1),
(4062, 117, 'Bauskas novads', '0400200', 1),
(4063, 117, 'Beverīnas novads', '0964700', 1),
(4064, 117, 'Brocēni, Brocēnu novads', '0840605', 1),
(4065, 117, 'Brocēnu novads', '0840601', 1),
(4066, 117, 'Burtnieku novads', '0967101', 1),
(4067, 117, 'Carnikavas novads', '0805200', 1),
(4068, 117, 'Cesvaine, Cesvaines novads', '0700807', 1),
(4069, 117, 'Cesvaines novads', '0700800', 1),
(4070, 117, 'Cēsis, Cēsu novads', '0420201', 1),
(4071, 117, 'Cēsu novads', '0420200', 1),
(4072, 117, 'Ciblas novads', '0684901', 1),
(4073, 117, 'Dagda, Dagdas novads', '0601009', 1),
(4074, 117, 'Dagdas novads', '0601000', 1),
(4075, 117, 'Daugavpils', '0050000', 1),
(4076, 117, 'Daugavpils novads', '0440200', 1),
(4077, 117, 'Dobele, Dobeles novads', '0460201', 1),
(4078, 117, 'Dobeles novads', '0460200', 1),
(4079, 117, 'Dundagas novads', '0885100', 1),
(4080, 117, 'Durbe, Durbes novads', '0640807', 1),
(4081, 117, 'Durbes novads', '0640801', 1),
(4082, 117, 'Engures novads', '0905100', 1),
(4083, 117, 'Ērgļu novads', '0705500', 1),
(4084, 117, 'Garkalnes novads', '0806000', 1),
(4085, 117, 'Grobiņa, Grobiņas novads', '0641009', 1),
(4086, 117, 'Grobiņas novads', '0641000', 1),
(4087, 117, 'Gulbene, Gulbenes novads', '0500201', 1),
(4088, 117, 'Gulbenes novads', '0500200', 1),
(4089, 117, 'Iecavas novads', '0406400', 1),
(4090, 117, 'Ikšķile, Ikšķiles novads', '0740605', 1),
(4091, 117, 'Ikšķiles novads', '0740600', 1),
(4092, 117, 'Ilūkste, Ilūkstes novads', '0440807', 1),
(4093, 117, 'Ilūkstes novads', '0440801', 1),
(4094, 117, 'Inčukalna novads', '0801800', 1),
(4095, 117, 'Jaunjelgava, Jaunjelgavas novads', '0321007', 1),
(4096, 117, 'Jaunjelgavas novads', '0321000', 1),
(4097, 117, 'Jaunpiebalgas novads', '0425700', 1),
(4098, 117, 'Jaunpils novads', '0905700', 1),
(4099, 117, 'Jelgava', '0090000', 1),
(4100, 117, 'Jelgavas novads', '0540200', 1),
(4101, 117, 'Jēkabpils', '0110000', 1),
(4102, 117, 'Jēkabpils novads', '0560200', 1),
(4103, 117, 'Jūrmala', '0130000', 1),
(4104, 117, 'Kalnciems, Jelgavas novads', '0540211', 1),
(4105, 117, 'Kandava, Kandavas novads', '0901211', 1),
(4106, 117, 'Kandavas novads', '0901201', 1),
(4107, 117, 'Kārsava, Kārsavas novads', '0681009', 1),
(4108, 117, 'Kārsavas novads', '0681000', 1),
(4109, 117, 'Kocēnu novads ,bij. Valmieras)', '0960200', 1),
(4110, 117, 'Kokneses novads', '0326100', 1),
(4111, 117, 'Krāslava, Krāslavas novads', '0600201', 1),
(4112, 117, 'Krāslavas novads', '0600202', 1),
(4113, 117, 'Krimuldas novads', '0806900', 1),
(4114, 117, 'Krustpils novads', '0566900', 1),
(4115, 117, 'Kuldīga, Kuldīgas novads', '0620201', 1),
(4116, 117, 'Kuldīgas novads', '0620200', 1),
(4117, 117, 'Ķeguma novads', '0741001', 1),
(4118, 117, 'Ķegums, Ķeguma novads', '0741009', 1),
(4119, 117, 'Ķekavas novads', '0800800', 1),
(4120, 117, 'Lielvārde, Lielvārdes novads', '0741413', 1),
(4121, 117, 'Lielvārdes novads', '0741401', 1),
(4122, 117, 'Liepāja', '0170000', 1),
(4123, 117, 'Limbaži, Limbažu novads', '0660201', 1),
(4124, 117, 'Limbažu novads', '0660200', 1),
(4125, 117, 'Līgatne, Līgatnes novads', '0421211', 1),
(4126, 117, 'Līgatnes novads', '0421200', 1),
(4127, 117, 'Līvāni, Līvānu novads', '0761211', 1),
(4128, 117, 'Līvānu novads', '0761201', 1),
(4129, 117, 'Lubāna, Lubānas novads', '0701413', 1),
(4130, 117, 'Lubānas novads', '0701400', 1),
(4131, 117, 'Ludza, Ludzas novads', '0680201', 1),
(4132, 117, 'Ludzas novads', '0680200', 1),
(4133, 117, 'Madona, Madonas novads', '0700201', 1),
(4134, 117, 'Madonas novads', '0700200', 1),
(4135, 117, 'Mazsalaca, Mazsalacas novads', '0961011', 1),
(4136, 117, 'Mazsalacas novads', '0961000', 1),
(4137, 117, 'Mālpils novads', '0807400', 1),
(4138, 117, 'Mārupes novads', '0807600', 1),
(4139, 117, 'Mērsraga novads', '0887600', 1),
(4140, 117, 'Naukšēnu novads', '0967300', 1),
(4141, 117, 'Neretas novads', '0327100', 1),
(4142, 117, 'Nīcas novads', '0647900', 1),
(4143, 117, 'Ogre, Ogres novads', '0740201', 1),
(4144, 117, 'Ogres novads', '0740202', 1),
(4145, 117, 'Olaine, Olaines novads', '0801009', 1),
(4146, 117, 'Olaines novads', '0801000', 1),
(4147, 117, 'Ozolnieku novads', '0546701', 1),
(4148, 117, 'Pārgaujas novads', '0427500', 1),
(4149, 117, 'Pāvilosta, Pāvilostas novads', '0641413', 1),
(4150, 117, 'Pāvilostas novads', '0641401', 1),
(4151, 117, 'Piltene, Ventspils novads', '0980213', 1),
(4152, 117, 'Pļaviņas, Pļaviņu novads', '0321413', 1),
(4153, 117, 'Pļaviņu novads', '0321400', 1),
(4154, 117, 'Preiļi, Preiļu novads', '0760201', 1),
(4155, 117, 'Preiļu novads', '0760202', 1),
(4156, 117, 'Priekule, Priekules novads', '0641615', 1),
(4157, 117, 'Priekules novads', '0641600', 1),
(4158, 117, 'Priekuļu novads', '0427300', 1),
(4159, 117, 'Raunas novads', '0427700', 1),
(4160, 117, 'Rēzekne', '0210000', 1),
(4161, 117, 'Rēzeknes novads', '0780200', 1),
(4162, 117, 'Riebiņu novads', '0766300', 1),
(4163, 117, 'Rīga', '0010000', 1),
(4164, 117, 'Rojas novads', '0888300', 1),
(4165, 117, 'Ropažu novads', '0808400', 1),
(4166, 117, 'Rucavas novads', '0648500', 1),
(4167, 117, 'Rugāju novads', '0387500', 1),
(4168, 117, 'Rundāles novads', '0407700', 1),
(4169, 117, 'Rūjiena, Rūjienas novads', '0961615', 1),
(4170, 117, 'Rūjienas novads', '0961600', 1),
(4171, 117, 'Sabile, Talsu novads', '0880213', 1),
(4172, 117, 'Salacgrīva, Salacgrīvas novads', '0661415', 1),
(4173, 117, 'Salacgrīvas novads', '0661400', 1),
(4174, 117, 'Salas novads', '0568700', 1),
(4175, 117, 'Salaspils novads', '0801200', 1),
(4176, 117, 'Salaspils, Salaspils novads', '0801211', 1),
(4177, 117, 'Saldus novads', '0840200', 1),
(4178, 117, 'Saldus, Saldus novads', '0840201', 1),
(4179, 117, 'Saulkrasti, Saulkrastu novads', '0801413', 1),
(4180, 117, 'Saulkrastu novads', '0801400', 1),
(4181, 117, 'Seda, Strenču novads', '0941813', 1),
(4182, 117, 'Sējas novads', '0809200', 1),
(4183, 117, 'Sigulda, Siguldas novads', '0801615', 1),
(4184, 117, 'Siguldas novads', '0801601', 1),
(4185, 117, 'Skrīveru novads', '0328200', 1),
(4186, 117, 'Skrunda, Skrundas novads', '0621209', 1),
(4187, 117, 'Skrundas novads', '0621200', 1),
(4188, 117, 'Smiltene, Smiltenes novads', '0941615', 1),
(4189, 117, 'Smiltenes novads', '0941600', 1),
(4190, 117, 'Staicele, Alojas novads', '0661017', 1),
(4191, 117, 'Stende, Talsu novads', '0880215', 1),
(4192, 117, 'Stopiņu novads', '0809600', 1),
(4193, 117, 'Strenči, Strenču novads', '0941817', 1),
(4194, 117, 'Strenču novads', '0941800', 1),
(4195, 117, 'Subate, Ilūkstes novads', '0440815', 1),
(4196, 117, 'Talsi, Talsu novads', '0880201', 1),
(4197, 117, 'Talsu novads', '0880200', 1),
(4198, 117, 'Tērvetes novads', '0468900', 1),
(4199, 117, 'Tukuma novads', '0900200', 1),
(4200, 117, 'Tukums, Tukuma novads', '0900201', 1),
(4201, 117, 'Vaiņodes novads', '0649300', 1),
(4202, 117, 'Valdemārpils, Talsu novads', '0880217', 1),
(4203, 117, 'Valka, Valkas novads', '0940201', 1),
(4204, 117, 'Valkas novads', '0940200', 1),
(4205, 117, 'Valmiera', '0250000', 1),
(4206, 117, 'Vangaži, Inčukalna novads', '0801817', 1),
(4207, 117, 'Varakļāni, Varakļānu novads', '0701817', 1),
(4208, 117, 'Varakļānu novads', '0701800', 1),
(4209, 117, 'Vārkavas novads', '0769101', 1),
(4210, 117, 'Vecpiebalgas novads', '0429300', 1),
(4211, 117, 'Vecumnieku novads', '0409500', 1),
(4212, 117, 'Ventspils', '0270000', 1),
(4213, 117, 'Ventspils novads', '0980200', 1),
(4214, 117, 'Viesīte, Viesītes novads', '0561815', 1),
(4215, 117, 'Viesītes novads', '0561800', 1),
(4216, 117, 'Viļaka, Viļakas novads', '0381615', 1),
(4217, 117, 'Viļakas novads', '0381600', 1),
(4218, 117, 'Viļāni, Viļānu novads', '0781817', 1),
(4219, 117, 'Viļānu novads', '0781800', 1),
(4220, 117, 'Zilupe, Zilupes novads', '0681817', 1),
(4221, 117, 'Zilupes novads', '0681801', 1),
(4222, 43, 'Arica y Parinacota', 'AP', 1),
(4223, 43, 'Los Rios', 'LR', 1),
(4224, 220, 'Kharkivs\'ka Oblast\'', '63', 1),
(4225, 118, 'Beirut', 'LB-BR', 1),
(4226, 118, 'Bekaa', 'LB-BE', 1),
(4227, 118, 'Mount Lebanon', 'LB-ML', 1),
(4228, 118, 'Nabatieh', 'LB-NB', 1),
(4229, 118, 'North', 'LB-NR', 1),
(4230, 118, 'South', 'LB-ST', 1),
(4231, 99, 'Telangana', 'TS', 1),
(4232, 44, 'Qinghai', 'QH', 1),
(4233, 100, 'Papua Barat', 'PB', 1),
(4234, 100, 'Sulawesi Barat', 'SR', 1),
(4235, 100, 'Kepulauan Riau', 'KR', 1),
(4236, 105, 'Barletta-Andria-Trani', 'BT', 1),
(4237, 105, 'Fermo', 'FM', 1),
(4238, 105, 'Monza Brianza', 'MB', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_country_zone_names`
--

CREATE TABLE `ci_country_zone_names` (
  `country_zone_name_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `culture_code` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_currency`
--

CREATE TABLE `ci_currency` (
  `currency_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `code` varchar(3) NOT NULL,
  `symbol_left` varchar(12) NOT NULL,
  `symbol_right` varchar(12) NOT NULL,
  `decimal_place` char(1) NOT NULL,
  `value` double(15,8) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_customers`
--

CREATE TABLE `ci_customers` (
  `customer_id` int(11) UNSIGNED NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL DEFAULT 0,
  `company_name` varchar(128) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `middle_name` varchar(32) DEFAULT '',
  `last_name` varchar(32) NOT NULL,
  `display_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(40) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `cell` varchar(32) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `fax` varchar(32) NOT NULL,
  `address_1` varchar(128) NOT NULL,
  `address_2` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `country_code` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `country` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `zone_id` int(11) NOT NULL DEFAULT 0,
  `zone` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `zone_code` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `is_same_billing_address` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'no',
  `display_country_id` int(11) NOT NULL DEFAULT 0,
  `display_country_code` varchar(3) NOT NULL,
  `display_country` varchar(128) NOT NULL,
  `billing_company_name` text NOT NULL,
  `billing_first_name` varchar(128) NOT NULL,
  `billing_last_name` varchar(128) NOT NULL,
  `billing_phone` varchar(32) NOT NULL,
  `billing_address_1` varchar(128) NOT NULL,
  `billing_address_2` varchar(128) NOT NULL,
  `billing_city` varchar(128) NOT NULL,
  `billing_country_id` int(11) NOT NULL,
  `billing_zone_id` int(11) NOT NULL,
  `billing_country_code` varchar(3) NOT NULL,
  `billing_country` varchar(128) NOT NULL,
  `billing_post_code` varchar(10) NOT NULL,
  `is_newsletter` varchar(6) NOT NULL COMMENT 'daily, weekly, never',
  `images` text NOT NULL,
  `is_guest` int(11) NOT NULL,
  `email_otp` varchar(255) NOT NULL,
  `is_email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `is_suspended` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `ip` varchar(40) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_customers`
--

INSERT INTO `ci_customers` (`customer_id`, `user_role_id`, `address_id`, `company_name`, `first_name`, `middle_name`, `last_name`, `display_name`, `email`, `password`, `gender`, `dob`, `cell`, `phone`, `fax`, `address_1`, `address_2`, `city`, `post_code`, `country_id`, `country_code`, `country`, `zone_id`, `zone`, `zone_code`, `is_same_billing_address`, `display_country_id`, `display_country_code`, `display_country`, `billing_company_name`, `billing_first_name`, `billing_last_name`, `billing_phone`, `billing_address_1`, `billing_address_2`, `billing_city`, `billing_country_id`, `billing_zone_id`, `billing_country_code`, `billing_country`, `billing_post_code`, `is_newsletter`, `images`, `is_guest`, `email_otp`, `is_email_verified`, `is_blocked`, `is_suspended`, `is_deleted`, `is_enabled`, `ip`, `date_added`, `date_modified`) VALUES
(1, 0, 0, '', 'Faizan', '', 'Rashid', '', 'faizan.rashid@advantech.com', '3066ae72739e663244a565eebc73612d', '', '0000-00-00', '005464646456', '', '', '', '', '', '', 0, '', '', 0, '', '', 'no', 0, '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', 0, '', 0, 0, 0, 0, 1, '', '2021-12-31 06:28:22', '0000-00-00 00:00:00'),
(2, 0, 0, '', 'Alman', '', 'rashid', '', 'alman@gmail.com', 'eaafad502f93575321978b575b1308ce', '', '0000-00-00', '223455654', '', '', '', '', '', '', 0, '', '', 0, '', '', 'no', 0, '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', 0, '', 0, 0, 0, 0, 1, '', '2022-01-10 07:51:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ci_customers_password_reset_requests`
--

CREATE TABLE `ci_customers_password_reset_requests` (
  `customer_password_reset_request_id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `confirm_hash` varchar(255) NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_customer_notifications`
--

CREATE TABLE `ci_customer_notifications` (
  `customer_notification_id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT 0,
  `is_weekly_newsletter` varchar(10) DEFAULT NULL,
  `is_weekly_seller_update` varchar(10) DEFAULT NULL,
  `is_weekly_newsletter_recommendations` varchar(10) DEFAULT NULL,
  `is_bidder_not_won_notifications` varchar(10) DEFAULT NULL,
  `is_bidder_winning_confirmations` varchar(10) DEFAULT NULL,
  `is_bidder_outbid_notifications` varchar(10) DEFAULT NULL,
  `is_seller_product_submited_confirmation` varchar(10) DEFAULT NULL,
  `is_seller_product_approved_confirmation` varchar(10) DEFAULT NULL,
  `is_seller_auction_scheduled` varchar(10) DEFAULT NULL,
  `is_seller_auction_live` varchar(10) DEFAULT NULL,
  `is_seller_adjustments_required` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_customer_notification_alerts`
--

CREATE TABLE `ci_customer_notification_alerts` (
  `customer_notification_id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT 0,
  `category_attribute_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_customer_settings`
--

CREATE TABLE `ci_customer_settings` (
  `customer_setting_id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT 0,
  `code` varchar(128) NOT NULL,
  `key` varchar(128) NOT NULL,
  `value` text NOT NULL,
  `is_serialized` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_customer_wishlist`
--

CREATE TABLE `ci_customer_wishlist` (
  `user_wishlist_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_customer_wishlist`
--

INSERT INTO `ci_customer_wishlist` (`user_wishlist_id`, `customer_id`, `product_id`, `date_added`, `date_modified`) VALUES
(2, 1, 1, '2022-01-06 08:26:06', '2022-01-06 08:26:06'),
(3, 1, 2, '2022-01-06 08:26:54', '2022-01-06 08:26:54');

-- --------------------------------------------------------

--
-- Table structure for table `ci_customer_wishlist_org`
--

CREATE TABLE `ci_customer_wishlist_org` (
  `user_wishlist_id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `short_description` text NOT NULL,
  `enabled` tinyint(1) DEFAULT 1,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_customer_wishlist_products`
--

CREATE TABLE `ci_customer_wishlist_products` (
  `user_wishlist_product_id` int(11) UNSIGNED NOT NULL,
  `user_wishlist_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `checkin_date` date NOT NULL DEFAULT '0000-00-00',
  `checkout_date` date NOT NULL DEFAULT '0000-00-00',
  `enabled` tinyint(1) DEFAULT 1,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_errors_log`
--

CREATE TABLE `ci_errors_log` (
  `error_log_id` int(11) NOT NULL,
  `is_mobile` varchar(255) DEFAULT 'no' COMMENT 'yes, no',
  `error_type` varchar(32) NOT NULL,
  `error_function` varchar(128) NOT NULL,
  `error_referer` text DEFAULT NULL,
  `error_url` text NOT NULL,
  `error_buffer` longtext NOT NULL,
  `heading` varchar(32) DEFAULT NULL,
  `template` varchar(32) DEFAULT NULL,
  `status_code` varchar(32) DEFAULT NULL,
  `severity` varchar(32) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `exception` varchar(32) DEFAULT NULL,
  `page` varchar(32) DEFAULT NULL,
  `log_error` varchar(32) DEFAULT NULL,
  `exception_scope` varchar(32) DEFAULT NULL,
  `filepath` varchar(32) DEFAULT NULL,
  `line` varchar(32) DEFAULT NULL,
  `user_platform` varchar(128) DEFAULT '',
  `user_browser` varchar(128) DEFAULT '',
  `user_agent` text DEFAULT NULL,
  `user_ip` varchar(128) DEFAULT '',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_extensions`
--

CREATE TABLE `ci_extensions` (
  `extension_id` int(11) NOT NULL,
  `scope` varchar(32) NOT NULL,
  `code` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_extensions`
--

INSERT INTO `ci_extensions` (`extension_id`, `scope`, `code`, `name`) VALUES
(1, 'shipping', 'flat', 'Flat Shipping'),
(2, 'shipping', 'free', 'Free Shipping'),
(4, 'payment', 'paypal', 'Paypal'),
(5, 'payment', 'cod', 'Cash on Delivery'),
(6, 'payment', 'stripe', 'Stripe');

-- --------------------------------------------------------

--
-- Table structure for table `ci_geo_ip_location`
--

CREATE TABLE `ci_geo_ip_location` (
  `ip_from` int(10) UNSIGNED DEFAULT NULL,
  `ip_to` int(10) UNSIGNED DEFAULT NULL,
  `country_code` char(2) DEFAULT NULL,
  `country_name` varchar(64) DEFAULT NULL,
  `region_name` varchar(128) DEFAULT NULL,
  `city_name` varchar(128) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `zip_code` varchar(30) DEFAULT NULL,
  `time_zone` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_geo_zone`
--

CREATE TABLE `ci_geo_zone` (
  `geo_zone_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_geo_zone`
--

INSERT INTO `ci_geo_zone` (`geo_zone_id`, `name`, `description`, `date_added`, `date_modified`) VALUES
(3, 'UK VAT Zone', 'UK VAT', '2009-01-06 23:26:25', '2022-01-12 16:01:03'),
(4, 'UK Shipping', 'UK Shipping Zones', '2009-06-23 01:14:53', '2010-12-15 15:18:13'),
(5, 'Canada Tax Zone', 'Canada Tax Zone', '2022-01-24 07:08:53', '2022-01-24 07:08:53'),
(6, 'Canada Shipping Zones', 'Canada Shipping Zones', '2019-07-10 09:41:16', '2019-07-10 10:07:58'),
(9, 'Test paki', 'Test Zone', '2022-01-13 16:46:02', '2022-01-13 16:46:02');

-- --------------------------------------------------------

--
-- Table structure for table `ci_geo_zones`
--

CREATE TABLE `ci_geo_zones` (
  `geo_zone_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT 0,
  `suspended` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `added_by_id` int(11) NOT NULL,
  `added_by_name` varchar(128) NOT NULL,
  `added_by_ip` varchar(40) NOT NULL,
  `modified_by_id` int(11) NOT NULL,
  `modified_by_name` varchar(128) NOT NULL,
  `modified_by_ip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_length_class`
--

CREATE TABLE `ci_length_class` (
  `length_class_id` int(11) NOT NULL,
  `value` decimal(15,8) NOT NULL,
  `title` varchar(32) NOT NULL,
  `unit` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_length_class`
--

INSERT INTO `ci_length_class` (`length_class_id`, `value`, `title`, `unit`) VALUES
(1, '1.00000000', 'Centimeter', 'cm'),
(2, '10.00000000', 'Millimeter', 'mm'),
(3, '0.39370000', 'Inch', 'in');

-- --------------------------------------------------------

--
-- Table structure for table `ci_login_attempts`
--

CREATE TABLE `ci_login_attempts` (
  `ip` varchar(20) NOT NULL,
  `attempt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_navigations`
--

CREATE TABLE `ci_navigations` (
  `navigation_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `has_child_nav` tinyint(1) NOT NULL,
  `sort_order` tinyint(3) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_navigations`
--

INSERT INTO `ci_navigations` (`navigation_id`, `name`, `link`, `has_child_nav`, `sort_order`, `is_enabled`, `date_added`, `date_modified`) VALUES
(1, 'home', 'https://localhost/techrevamp/', 0, 0, 1, '2022-01-25 06:21:10', '2022-01-25 06:21:10'),
(2, 'catalog', 'https://localhost/techrevamp/catalog.html', 0, 1, 1, '2022-01-25 06:21:46', '2022-01-25 06:21:46'),
(3, 'pages', 'privacy-policy', 1, 4, 1, '2022-01-27 06:42:05', '2022-01-27 06:42:05'),
(7, 'pages', 'about-us', 1, 5, 1, '2022-01-27 06:52:53', '0000-00-00 00:00:00'),
(8, 'pages', 'free-shipping', 1, 6, 1, '2022-01-27 06:54:03', '2022-01-27 06:54:03'),
(9, 'categories', 'categoriesssss', 0, 2, 1, '2022-01-27 06:54:21', '0000-00-00 00:00:00'),
(10, 'brand', 'branssss', 0, 3, 0, '2022-01-28 07:03:00', '2022-01-28 07:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `ci_newsletters`
--

CREATE TABLE `ci_newsletters` (
  `newsletter_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_newsletters`
--

INSERT INTO `ci_newsletters` (`newsletter_id`, `email`, `date_added`) VALUES
(1, 'asad@gmail.com', '2021-12-20 10:51:33'),
(2, 'asad2@gmail.com', '2021-12-20 10:55:23'),
(3, 'aaa@gmail.com', '2021-12-20 10:56:10'),
(4, 'aaaaa@gmail.com', '2021-12-20 10:57:19'),
(5, 'aaza@gmail.com', '2021-12-20 10:59:02'),
(6, 'salman@gmail.com', '2021-12-21 02:32:10'),
(7, 'azam@gmail.com', '2021-12-21 02:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `ci_order`
--

CREATE TABLE `ci_order` (
  `order_id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL DEFAULT 0,
  `invoice_prefix` varchar(26) NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT 0,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `payment_first_name` varchar(32) NOT NULL,
  `payment_last_name` varchar(32) NOT NULL,
  `payment_company` varchar(60) NOT NULL,
  `payment_address_1` varchar(128) NOT NULL,
  `payment_address_2` varchar(128) NOT NULL,
  `payment_city` varchar(128) NOT NULL,
  `payment_postcode` varchar(10) NOT NULL,
  `payment_country` varchar(128) NOT NULL,
  `payment_country_id` int(11) NOT NULL,
  `payment_zone` varchar(128) NOT NULL,
  `payment_zone_id` int(11) NOT NULL,
  `payment_method` varchar(128) NOT NULL,
  `payment_code` varchar(128) NOT NULL,
  `shipping_first_name` varchar(32) NOT NULL,
  `shipping_last_name` varchar(32) NOT NULL,
  `shipping_company` varchar(40) NOT NULL,
  `shipping_address_1` varchar(128) NOT NULL,
  `shipping_address_2` varchar(128) NOT NULL,
  `shipping_city` varchar(128) NOT NULL,
  `shipping_postcode` varchar(10) NOT NULL,
  `shipping_country` varchar(128) NOT NULL,
  `shipping_country_id` int(11) NOT NULL,
  `shipping_zone` varchar(128) NOT NULL,
  `shipping_zone_id` int(11) NOT NULL,
  `shipping_method` varchar(128) NOT NULL,
  `shipping_code` varchar(128) NOT NULL,
  `comment` text NOT NULL,
  `total` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `order_status_id` int(11) NOT NULL DEFAULT 0,
  `currency_id` int(11) NOT NULL,
  `currency_code` varchar(3) NOT NULL,
  `currency_value` decimal(15,8) NOT NULL DEFAULT 1.00000000,
  `ip` varchar(40) NOT NULL,
  `forwarded_ip` varchar(40) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `accept_language` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `added_by_id` int(11) NOT NULL,
  `added_by_name` varchar(128) NOT NULL,
  `added_by_ip` varchar(40) NOT NULL,
  `modified_by_id` int(11) NOT NULL,
  `modified_by_name` varchar(128) NOT NULL,
  `modified_by_ip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_order`
--

INSERT INTO `ci_order` (`order_id`, `invoice_no`, `invoice_prefix`, `customer_id`, `first_name`, `last_name`, `email`, `telephone`, `payment_first_name`, `payment_last_name`, `payment_company`, `payment_address_1`, `payment_address_2`, `payment_city`, `payment_postcode`, `payment_country`, `payment_country_id`, `payment_zone`, `payment_zone_id`, `payment_method`, `payment_code`, `shipping_first_name`, `shipping_last_name`, `shipping_company`, `shipping_address_1`, `shipping_address_2`, `shipping_city`, `shipping_postcode`, `shipping_country`, `shipping_country_id`, `shipping_zone`, `shipping_zone_id`, `shipping_method`, `shipping_code`, `comment`, `total`, `order_status_id`, `currency_id`, `currency_code`, `currency_value`, `ip`, `forwarded_ip`, `user_agent`, `accept_language`, `date_added`, `date_modified`, `added_by_id`, `added_by_name`, `added_by_ip`, `modified_by_id`, `modified_by_name`, `modified_by_ip`) VALUES
(1, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'PayPal', 'paypal', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '843.9897', 6, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2021-12-31 06:32:04', '2021-12-31 06:32:04', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(2, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '328.9897', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2021-12-31 06:44:24', '2021-12-31 06:44:24', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(3, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Free Shipping', 'free', '', '41.2000', 2, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-03 05:58:42', '2022-01-03 05:58:42', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(13, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'PayPal', 'paypal', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '843.9897', 6, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-04 08:22:59', '2022-01-04 08:22:59', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(37, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'PayPal', 'paypal', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '40.6000', 0, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-04 08:56:42', '2022-01-04 08:56:42', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(38, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '125.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 05:47:21', '2022-01-10 05:47:21', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(39, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Asad', 'Ahmad', 'adv', 'adv2', '', 'Lahore', '36000', 'Pakistan', 162, 'Punjab', 2461, 'Free Shipping', 'free', '', '20.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 06:09:26', '2022-01-10 06:09:26', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(40, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Asad', 'Ahmad', 'adv', 'adv2', '', 'Lahore', '36000', 'Pakistan', 162, 'Punjab', 2461, 'Free Shipping', 'free', '', '20.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 06:10:57', '2022-01-10 06:10:57', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(41, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '42.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 06:55:15', '2022-01-10 06:55:15', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(42, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Asad', 'Ahmad', 'adv', 'adv2', '', 'Lahore', '36000', 'Pakistan', 162, 'Punjab', 2461, 'Flat Shipping', 'flat', '', '40.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 07:01:01', '2022-01-10 07:01:01', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(43, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Asad', 'Ahmad', 'adv', 'adv2', '', 'Lahore', '36000', 'Pakistan', 162, 'Punjab', 2461, 'Flat Shipping', 'flat', '', '40.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 07:39:46', '2022-01-10 07:39:46', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(44, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '42.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 07:44:13', '2022-01-10 07:44:13', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(45, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Asad', 'Ahmad', 'adv', 'adv2', '', 'Lahore', '36000', 'Pakistan', 162, 'Punjab', 2461, 'Flat Shipping', 'flat', '', '41.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 07:47:58', '2022-01-10 07:47:58', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(46, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '1069.9895', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 07:48:41', '2022-01-10 07:48:41', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(47, 0, 'INV', 2, 'Alman', 'rashid', 'alman@gmail.com', '223455654', 'Alman', 'rashid', 'Advv', 'lhrr', 'lhree', 'Lahore', '36000', 'United States', 223, 'California', 3624, 'Cash on delivery', 'cod', 'Alman', 'rashid', 'Advv', 'lhrr', 'lhree', 'Lahore', '36000', 'United States', 223, 'California', 3624, 'Flat Shipping', 'flat', '', '40.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 07:51:59', '2022-01-10 07:51:59', 2, 'Alman rashid', '::1', 2, 'Alman rashid', '::1'),
(50, 0, 'INV', 2, 'Alman', 'rashid', 'alman@gmail.com', '223455654', 'Alman', 'rashid', 'Advv', 'lhrr', 'lhree', 'Lahore', '36000', 'United States', 223, 'California', 3624, 'Cash on delivery', 'cod', 'Alman', 'rashid', 'Advv', 'lhrr', 'lhree', 'Lahore', '36000', 'United States', 223, 'California', 3624, 'Flat Shipping', 'flat', '', '1019.9900', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 07:53:29', '2022-01-10 07:53:29', 2, 'Alman rashid', '::1', 2, 'Alman rashid', '::1'),
(51, 0, 'INV', 2, 'Alman', 'rashid', 'alman@gmail.com', '223455654', 'Alman', 'rashid', 'Advv', 'lhrr', 'lhree', 'Lahore', '36000', 'United States', 223, 'California', 3624, 'Cash on delivery', 'cod', 'Alman', 'rashid', 'Advv', 'lhrr', 'lhree', 'Lahore', '36000', 'United States', 223, 'California', 3624, 'Flat Shipping', 'flat', '', '319.9900', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 07:54:22', '2022-01-10 07:54:22', 2, 'Alman rashid', '::1', 2, 'Alman rashid', '::1'),
(52, 0, 'INV', 2, 'Alman', 'rashid', 'alman@gmail.com', '223455654', 'Alman', 'rashid', 'Advv', 'lhrr', 'lhree', 'Lahore', '36000', 'United States', 223, 'California', 3624, 'Cash on delivery', 'cod', 'Alman', 'rashid', 'Advv', 'lhrr', 'lhree', 'Lahore', '36000', 'United States', 223, 'California', 3624, 'Flat Shipping', 'flat', '', '1019.9900', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 08:05:38', '2022-01-10 08:05:38', 2, 'Alman rashid', '::1', 2, 'Alman rashid', '::1'),
(54, 0, 'INV', 2, 'Alman', 'rashid', 'alman@gmail.com', '223455654', 'Alman', 'rashid', 'Advv', 'lhrr', 'lhree', 'Lahore', '36000', 'United States', 223, 'California', 3624, 'PayPal', 'paypal', 'Alman', 'rashid', 'Advv', 'lhrr', 'lhree', 'Lahore', '36000', 'United States', 223, 'California', 3624, 'Flat Shipping', 'flat', '', '40.0000', 6, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 08:20:49', '2022-01-10 08:20:49', 2, 'Alman rashid', '::1', 2, 'Alman rashid', '::1'),
(55, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '41.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 08:24:13', '2022-01-10 08:24:13', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(56, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '1069.9895', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 08:28:54', '2022-01-10 08:28:54', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(64, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '41.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 08:33:09', '2022-01-10 08:33:09', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(65, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '41.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 08:36:04', '2022-01-10 08:36:04', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(66, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '41.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 08:39:30', '2022-01-10 08:39:30', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(67, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '62.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 08:41:51', '2022-01-10 08:41:51', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(68, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '62.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 08:44:44', '2022-01-10 08:44:44', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(69, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '62.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 09:40:12', '2022-01-10 09:40:12', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(70, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '62.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 09:40:12', '2022-01-10 09:40:12', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(71, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '440.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 09:48:54', '2022-01-10 09:48:54', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(72, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '62.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 09:52:22', '2022-01-10 09:52:22', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(73, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '1069.9895', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 10:07:26', '2022-01-10 10:07:26', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(74, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Free Shipping', 'free', '', '44.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36', 'en-US,en;q=0.9', '2022-01-10 10:19:04', '2022-01-10 10:19:04', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(75, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Asad123', 'Ali', 'Advvv3', 'Fsd', 'Fsd2', 'Faisalabad', '360000', 'Pakistan', 162, 'Punjab', 2461, 'Flat Shipping', 'flat', '', '64.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'en-US,en;q=0.9', '2022-01-21 01:24:34', '2022-01-21 01:24:34', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(76, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Cash on delivery', 'cod', 'Asad123', 'Ali', 'Advvv3', 'Fsd', 'Fsd2', 'Faisalabad', '360000', 'Pakistan', 162, 'Punjab', 2461, 'Flat Shipping', 'flat', '', '87.0000', 1, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'en-US,en;q=0.9', '2022-01-21 01:35:17', '2022-01-21 01:35:17', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(77, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'PayPal', 'paypal', 'Asad123', 'Ali', 'Advvv3', 'Fsd', 'Fsd2', 'Faisalabad', '360000', 'Pakistan', 162, 'Punjab', 2461, 'Flat Shipping', 'flat', '', '154.0000', 6, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'en-US,en;q=0.9', '2022-01-21 01:46:55', '2022-01-21 01:46:55', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(78, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Asss', 'ddd', 'ff', 'fgg', 'gg', 'jhghg', '5400', 'Canada', 38, 'Alberta', 602, 'PayPal', 'paypal', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '1059.9898', 6, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'en-US,en;q=0.9', '2022-01-24 02:11:30', '2022-01-24 02:11:30', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1'),
(79, 0, 'INV', 1, 'Faizan', 'Rashid', 'faizan.rashid@advantech.com', '005464646456', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'PayPal', 'paypal', 'Faizan', 'Rashid', 'Advantech', 'Advanrech', 'Lahore', 'Lahore', '54000', 'United States', 223, 'Alabama', 3613, 'Flat Shipping', 'flat', '', '65.0000', 6, 1, 'USD', '1.00000000', '::1', '', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'en-US,en;q=0.9', '2022-01-28 01:05:34', '2022-01-28 01:05:34', 1, 'Faizan Rashid', '::1', 1, 'Faizan Rashid', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `ci_order_history`
--

CREATE TABLE `ci_order_history` (
  `order_history_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `notify` tinyint(1) NOT NULL DEFAULT 0,
  `comment` text NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_order_history`
--

INSERT INTO `ci_order_history` (`order_history_id`, `order_id`, `order_status_id`, `notify`, `comment`, `date_added`) VALUES
(1, 1, 6, 0, '', '2021-12-31 06:32:04'),
(2, 2, 1, 0, '', '2021-12-31 06:44:24'),
(3, 3, 1, 0, '', '2022-01-03 05:58:42'),
(13, 13, 6, 0, '', '2022-01-04 08:22:59'),
(37, 37, 0, 0, '', '2022-01-04 08:56:42'),
(38, 3, 2, 1, 'its processed', '2022-01-05 14:24:09'),
(39, 3, 2, 1, 'its processed', '2022-01-05 14:41:29'),
(40, 3, 2, 1, 'its processed', '2022-01-05 14:53:17'),
(41, 3, 2, 1, 'its processed', '2022-01-05 14:59:39'),
(42, 38, 1, 0, '', '2022-01-10 05:47:21'),
(43, 39, 1, 0, '', '2022-01-10 06:09:26'),
(44, 40, 1, 0, '', '2022-01-10 06:10:57'),
(45, 41, 1, 0, '', '2022-01-10 06:55:15'),
(46, 42, 1, 0, '', '2022-01-10 07:01:01'),
(47, 43, 1, 0, '', '2022-01-10 07:39:46'),
(48, 44, 1, 0, '', '2022-01-10 07:44:13'),
(49, 45, 1, 0, '', '2022-01-10 07:47:58'),
(50, 46, 1, 0, '', '2022-01-10 07:48:41'),
(51, 47, 1, 0, '', '2022-01-10 07:51:59'),
(54, 50, 1, 0, '', '2022-01-10 07:53:29'),
(55, 51, 1, 0, '', '2022-01-10 07:54:22'),
(56, 52, 1, 0, '', '2022-01-10 08:05:38'),
(58, 54, 6, 0, '', '2022-01-10 08:20:49'),
(59, 55, 1, 0, '', '2022-01-10 08:24:13'),
(60, 56, 1, 0, '', '2022-01-10 08:28:54'),
(68, 64, 1, 0, '', '2022-01-10 08:33:09'),
(69, 65, 1, 0, '', '2022-01-10 08:36:04'),
(70, 66, 1, 0, '', '2022-01-10 08:39:30'),
(71, 67, 1, 0, '', '2022-01-10 08:41:51'),
(72, 68, 1, 0, '', '2022-01-10 08:44:44'),
(73, 69, 1, 0, '', '2022-01-10 09:40:12'),
(74, 70, 1, 0, '', '2022-01-10 09:40:12'),
(75, 71, 1, 0, '', '2022-01-10 09:48:54'),
(76, 72, 1, 0, '', '2022-01-10 09:52:22'),
(77, 73, 1, 0, '', '2022-01-10 10:07:26'),
(78, 74, 1, 0, '', '2022-01-10 10:19:04'),
(79, 75, 1, 0, '', '2022-01-21 01:24:34'),
(80, 76, 1, 0, '', '2022-01-21 01:35:17'),
(81, 77, 6, 0, '', '2022-01-21 01:46:55'),
(82, 78, 6, 0, '', '2022-01-24 02:11:30'),
(83, 79, 6, 0, '', '2022-01-28 01:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `ci_order_items`
--

CREATE TABLE `ci_order_items` (
  `order_item_id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `auction_percentage` decimal(15,2) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `auction_fee` decimal(15,2) NOT NULL,
  `shipping_cost` decimal(15,2) NOT NULL,
  `client_user_id` int(11) NOT NULL,
  `expert_user_id` int(11) NOT NULL,
  `product_category_id` int(11) NOT NULL DEFAULT 0,
  `brand_category_id` int(11) NOT NULL DEFAULT 0,
  `brand_category_item_id` int(11) NOT NULL DEFAULT 0,
  `bid_start_date` datetime DEFAULT '0000-00-00 00:00:00',
  `bid_end_date` datetime DEFAULT '0000-00-00 00:00:00',
  `max_estimate_price` decimal(15,2) DEFAULT NULL,
  `min_estimate_price` decimal(15,2) DEFAULT NULL,
  `is_pickup_required` varchar(4) NOT NULL COMMENT 'yes, no',
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `short_description` text CHARACTER SET latin1 NOT NULL,
  `message_expert` text CHARACTER SET latin1 NOT NULL,
  `estimate_revenue` decimal(15,2) NOT NULL,
  `first_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `last_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(96) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `cell` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `phone` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `fax` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `address_1` varchar(128) NOT NULL,
  `address_2` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `country_code` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `country` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `zone_id` int(11) NOT NULL DEFAULT 0,
  `zone` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `zone_code` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ship_to` varchar(25) NOT NULL DEFAULT 'none' COMMENT 'warehouse, user, none.',
  `status_id` int(11) NOT NULL DEFAULT 1,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `is_picked_by_buyer` varchar(15) NOT NULL DEFAULT 'no' COMMENT 'yes, no',
  `is_modified` tinyint(1) NOT NULL DEFAULT 0,
  `suspended` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `added_by_id` int(11) NOT NULL,
  `added_by_name` varchar(128) NOT NULL,
  `added_by_ip` varchar(40) NOT NULL,
  `modified_by_id` int(11) NOT NULL,
  `modified_by_name` varchar(128) NOT NULL,
  `modified_by_ip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_order_products`
--

CREATE TABLE `ci_order_products` (
  `order_item_id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unite_price` decimal(15,2) NOT NULL,
  `tax` decimal(10,2) DEFAULT 0.00,
  `discount_total` decimal(15,0) DEFAULT NULL,
  `total` decimal(15,2) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by_ip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_order_products`
--

INSERT INTO `ci_order_products` (`order_item_id`, `order_id`, `customer_id`, `product_id`, `product_name`, `sku`, `quantity`, `unite_price`, `tax`, `discount_total`, `total`, `date_added`, `added_by_ip`) VALUES
(1, 1, 1, 1, 'ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER***', 'AN515-51522L', 1, '799.99', '24.00', NULL, '799.99', '2021-12-31 06:32:04', '::1'),
(2, 2, 1, 2, ' Samsung Galaxy A21 32GB Unlocked Cell Phone *Open Box*', 'SM-A21SU', 1, '299.99', '9.00', NULL, '299.99', '2021-12-31 06:44:24', '::1'),
(3, 3, 1, 4, 'Apple MacBook Air 11.6&amp;quot; (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )', 'A1465_2gb250gb', 2, '20.00', '1.20', NULL, '40.00', '2022-01-03 05:58:42', '::1'),
(13, 13, 1, 1, 'ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER***', 'AN515-51522L', 1, '799.99', '24.00', NULL, '799.99', '2022-01-04 08:22:59', '::1'),
(37, 37, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )', 'A1465_2gb250gb', 1, '20.00', '0.60', NULL, '20.00', '2022-01-04 08:56:42', '::1'),
(38, 38, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )', 'A1465_2gb250gb', 5, '20.00', '5.00', NULL, '100.00', '2022-01-10 05:47:21', '::1'),
(39, 39, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )', 'A1465_2gb250gb', 1, '20.00', '0.00', NULL, '20.00', '2022-01-10 06:09:26', '::1'),
(40, 40, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )', 'A1465_2gb250gb', 1, '20.00', '0.00', NULL, '20.00', '2022-01-10 06:10:57', '::1'),
(41, 41, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )', 'A1465_2gb250gb', 1, '20.00', '2.00', NULL, '20.00', '2022-01-10 06:55:15', '::1'),
(42, 42, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )', 'A1465_2gb250gb', 1, '20.00', '0.00', NULL, '20.00', '2022-01-10 07:01:01', '::1'),
(43, 43, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )', 'A1465_2gb250gb', 1, '20.00', '0.00', NULL, '20.00', '2022-01-10 07:39:46', '::1'),
(44, 44, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )', 'A1465_2gb250gb', 1, '20.00', '2.00', NULL, '20.00', '2022-01-10 07:44:13', '::1'),
(45, 45, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )', 'A1465_2gb250gb', 1, '20.00', '1.00', NULL, '20.00', '2022-01-10 07:47:58', '::1'),
(46, 46, 1, 1, 'ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER***', 'AN515-51522L', 1, '999.99', '50.00', NULL, '999.99', '2022-01-10 07:48:41', '::1'),
(47, 47, 2, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )', 'A1465_2gb250gb', 1, '20.00', '0.00', NULL, '20.00', '2022-01-10 07:51:59', '::1'),
(50, 50, 2, 1, 'ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER***', 'AN515-51522L', 1, '999.99', '0.00', NULL, '999.99', '2022-01-10 07:53:29', '::1'),
(51, 51, 2, 2, ' Samsung Galaxy A21 32GB Unlocked Cell Phone *Open Box*', 'SM-A21SU', 1, '299.99', '0.00', NULL, '299.99', '2022-01-10 07:54:22', '::1'),
(52, 52, 2, 1, 'ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER***', 'AN515-51522L', 1, '999.99', '0.00', NULL, '999.99', '2022-01-10 08:05:38', '::1'),
(54, 54, 2, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )', 'A1465_2gb250gb', 1, '20.00', '0.00', NULL, '20.00', '2022-01-10 08:20:49', '::1'),
(55, 55, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )', 'A1465_2gb250gb', 1, '20.00', '1.00', NULL, '20.00', '2022-01-10 08:24:13', '::1'),
(56, 56, 1, 1, 'ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER***', 'AN515-51522L', 1, '999.99', '50.00', NULL, '999.99', '2022-01-10 08:28:54', '::1'),
(64, 64, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )', 'A1465_2gb250gb', 1, '20.00', '1.00', NULL, '20.00', '2022-01-10 08:33:09', '::1'),
(65, 65, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )', 'A1465_2gb250gb', 1, '20.00', '1.00', NULL, '20.00', '2022-01-10 08:36:04', '::1'),
(66, 66, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )', 'A1465_2gb250gb', 1, '20.00', '1.00', NULL, '20.00', '2022-01-10 08:39:30', '::1'),
(67, 67, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb )', 'A1465_2gb500gb', 1, '40.00', '2.00', NULL, '40.00', '2022-01-10 08:41:51', '::1'),
(68, 68, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb )', 'A1465_2gb500gb', 1, '40.00', '2.00', NULL, '40.00', '2022-01-10 08:44:44', '::1'),
(69, 69, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb )', 'A1465_2gb500gb', 1, '40.00', '2.00', NULL, '40.00', '2022-01-10 09:40:12', '::1'),
(70, 70, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb )', 'A1465_2gb500gb', 1, '40.00', '2.00', NULL, '40.00', '2022-01-10 09:40:12', '::1'),
(71, 71, 1, 6, 'test product 3', '66666', 1, '400.00', '20.00', NULL, '400.00', '2022-01-10 09:48:54', '::1'),
(72, 72, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb )', 'A1465_2gb500gb', 1, '40.00', '2.00', NULL, '40.00', '2022-01-10 09:52:22', '::1'),
(73, 73, 1, 1, 'ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER***', 'AN515-51522L', 1, '999.99', '50.00', NULL, '999.99', '2022-01-10 10:07:26', '::1'),
(74, 74, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb )', 'A1465_2gb500gb', 1, '40.00', '4.00', NULL, '40.00', '2022-01-10 10:19:04', '::1'),
(75, 75, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb )', 'A1465_2gb500gb', 1, '40.00', '4.00', NULL, '40.00', '2022-01-21 01:24:34', '::1'),
(76, 76, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb )', 'A1465_2gb500gb', 1, '40.00', '27.00', NULL, '40.00', '2022-01-21 01:35:17', '::1'),
(77, 77, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb )', 'A1465_2gb500gb', 2, '40.00', '54.00', NULL, '80.00', '2022-01-21 01:46:55', '::1'),
(78, 78, 1, 1, 'ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER***', 'AN515-51522L', 1, '999.99', '40.00', NULL, '999.99', '2022-01-24 02:11:30', '::1'),
(79, 79, 1, 4, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb )', 'A1465_2gb500gb', 1, '40.00', '5.00', NULL, '40.00', '2022-01-28 01:05:34', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `ci_order_status`
--

CREATE TABLE `ci_order_status` (
  `order_status_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_order_status`
--

INSERT INTO `ci_order_status` (`order_status_id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipping'),
(4, 'Shipped'),
(5, 'Processed'),
(6, 'Completed'),
(7, 'Expired'),
(8, 'Denied'),
(9, 'Canceled');

-- --------------------------------------------------------

--
-- Table structure for table `ci_order_status_log`
--

CREATE TABLE `ci_order_status_log` (
  `order_status_log_id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `customer_id` int(11) NOT NULL DEFAULT 0,
  `client_user_id` int(11) NOT NULL DEFAULT 0,
  `sent_by` varchar(25) NOT NULL DEFAULT '0',
  `recieved_by` varchar(25) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `is_modified` tinyint(1) NOT NULL DEFAULT 0,
  `suspended` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `added_by_id` int(11) NOT NULL,
  `added_by_name` varchar(128) NOT NULL,
  `added_by_ip` varchar(40) NOT NULL,
  `modified_by_id` int(11) NOT NULL,
  `modified_by_name` varchar(128) NOT NULL,
  `modified_by_ip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_order_total`
--

CREATE TABLE `ci_order_total` (
  `order_total_id` int(10) NOT NULL,
  `order_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `sort_order` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_order_total`
--

INSERT INTO `ci_order_total` (`order_total_id`, `order_id`, `code`, `title`, `value`, `sort_order`) VALUES
(1, 1, 'sub_total', 'sub_total', '799.9900', 0),
(2, 1, 'flat', 'shipping_cost', '20.0000', 1),
(3, 1, 'tax', 'tax', '23.9997', 2),
(4, 1, 'total', 'total', '843.9897', 3),
(5, 2, 'sub_total', 'sub_total', '299.9900', 0),
(6, 2, 'flat', 'shipping_cost', '20.0000', 1),
(7, 2, 'tax', 'tax', '8.9997', 2),
(8, 2, 'total', 'total', '328.9897', 3),
(9, 3, 'sub_total', 'sub_total', '40.0000', 0),
(10, 3, 'free', 'shipping_cost', '0.0000', 1),
(11, 3, 'tax', 'tax', '1.2000', 2),
(12, 3, 'total', 'total', '41.2000', 3),
(49, 13, 'sub_total', 'sub_total', '799.9900', 0),
(50, 13, 'flat', 'shipping_cost', '20.0000', 1),
(51, 13, 'tax', 'tax', '23.9997', 2),
(52, 13, 'total', 'total', '843.9897', 3),
(145, 37, 'sub_total', 'sub_total', '20.0000', 0),
(146, 37, 'flat', 'shipping_cost', '20.0000', 1),
(147, 37, 'tax', 'tax', '0.6000', 2),
(148, 37, 'total', 'total', '40.6000', 3),
(149, 38, 'sub_total', 'sub_total', '100.0000', 0),
(150, 38, 'flat', 'shipping_cost', '20.0000', 1),
(151, 38, 'tax', 'tax', '5.0000', 2),
(152, 38, 'total', 'total', '125.0000', 3),
(153, 39, 'sub_total', 'sub_total', '20.0000', 0),
(154, 39, 'free', 'shipping_cost', '0.0000', 1),
(155, 39, 'tax', 'tax', '0.0000', 2),
(156, 39, 'total', 'total', '20.0000', 3),
(157, 40, 'sub_total', 'sub_total', '20.0000', 0),
(158, 40, 'free', 'shipping_cost', '0.0000', 1),
(159, 40, 'tax', 'tax', '0.0000', 2),
(160, 40, 'total', 'total', '20.0000', 3),
(161, 41, 'sub_total', 'sub_total', '20.0000', 0),
(162, 41, 'flat', 'shipping_cost', '20.0000', 1),
(163, 41, 'tax', 'tax', '2.0000', 2),
(164, 41, 'total', 'total', '42.0000', 3),
(165, 42, 'sub_total', 'sub_total', '20.0000', 0),
(166, 42, 'flat', 'shipping_cost', '20.0000', 1),
(167, 42, 'tax', 'tax', '0.0000', 2),
(168, 42, 'total', 'total', '40.0000', 3),
(169, 43, 'sub_total', 'sub_total', '20.0000', 0),
(170, 43, 'flat', 'shipping_cost', '20.0000', 1),
(171, 43, 'tax', 'tax', '0.0000', 2),
(172, 43, 'total', 'total', '40.0000', 3),
(173, 44, 'sub_total', 'sub_total', '20.0000', 0),
(174, 44, 'flat', 'shipping_cost', '20.0000', 1),
(175, 44, 'tax', 'tax', '2.0000', 2),
(176, 44, 'total', 'total', '42.0000', 3),
(177, 45, 'sub_total', 'sub_total', '20.0000', 0),
(178, 45, 'flat', 'shipping_cost', '20.0000', 1),
(179, 45, 'tax', 'tax', '1.0000', 2),
(180, 45, 'total', 'total', '41.0000', 3),
(181, 46, 'sub_total', 'sub_total', '999.9900', 0),
(182, 46, 'flat', 'shipping_cost', '20.0000', 1),
(183, 46, 'tax', 'tax', '49.9995', 2),
(184, 46, 'total', 'total', '1069.9895', 3),
(185, 47, 'sub_total', 'sub_total', '20.0000', 0),
(186, 47, 'flat', 'shipping_cost', '20.0000', 1),
(187, 47, 'tax', 'tax', '0.0000', 2),
(188, 47, 'total', 'total', '40.0000', 3),
(197, 50, 'sub_total', 'sub_total', '999.9900', 0),
(198, 50, 'flat', 'shipping_cost', '20.0000', 1),
(199, 50, 'tax', 'tax', '0.0000', 2),
(200, 50, 'total', 'total', '1019.9900', 3),
(201, 51, 'sub_total', 'sub_total', '299.9900', 0),
(202, 51, 'flat', 'shipping_cost', '20.0000', 1),
(203, 51, 'tax', 'tax', '0.0000', 2),
(204, 51, 'total', 'total', '319.9900', 3),
(205, 52, 'sub_total', 'sub_total', '999.9900', 0),
(206, 52, 'flat', 'shipping_cost', '20.0000', 1),
(207, 52, 'tax', 'tax', '0.0000', 2),
(208, 52, 'total', 'total', '1019.9900', 3),
(213, 54, 'sub_total', 'sub_total', '20.0000', 0),
(214, 54, 'flat', 'shipping_cost', '20.0000', 1),
(215, 54, 'tax', 'tax', '0.0000', 2),
(216, 54, 'total', 'total', '40.0000', 3),
(217, 55, 'sub_total', 'sub_total', '20.0000', 0),
(218, 55, 'flat', 'shipping_cost', '20.0000', 1),
(219, 55, 'tax', 'tax', '1.0000', 2),
(220, 55, 'total', 'total', '41.0000', 3),
(221, 56, 'sub_total', 'sub_total', '999.9900', 0),
(222, 56, 'flat', 'shipping_cost', '20.0000', 1),
(223, 56, 'tax', 'tax', '49.9995', 2),
(224, 56, 'total', 'total', '1069.9895', 3),
(253, 64, 'sub_total', 'sub_total', '20.0000', 0),
(254, 64, 'flat', 'shipping_cost', '20.0000', 1),
(255, 64, 'tax', 'tax', '1.0000', 2),
(256, 64, 'total', 'total', '41.0000', 3),
(257, 65, 'sub_total', 'sub_total', '20.0000', 0),
(258, 65, 'flat', 'shipping_cost', '20.0000', 1),
(259, 65, 'tax', 'tax', '1.0000', 2),
(260, 65, 'total', 'total', '41.0000', 3),
(261, 66, 'sub_total', 'sub_total', '20.0000', 0),
(262, 66, 'flat', 'shipping_cost', '20.0000', 1),
(263, 66, 'tax', 'tax', '1.0000', 2),
(264, 66, 'total', 'total', '41.0000', 3),
(265, 67, 'sub_total', 'sub_total', '40.0000', 0),
(266, 67, 'flat', 'shipping_cost', '20.0000', 1),
(267, 67, 'tax', 'tax', '2.0000', 2),
(268, 67, 'total', 'total', '62.0000', 3),
(269, 68, 'sub_total', 'sub_total', '40.0000', 0),
(270, 68, 'flat', 'shipping_cost', '20.0000', 1),
(271, 68, 'tax', 'tax', '2.0000', 2),
(272, 68, 'total', 'total', '62.0000', 3),
(273, 69, 'sub_total', 'sub_total', '40.0000', 0),
(274, 69, 'flat', 'shipping_cost', '20.0000', 1),
(275, 69, 'tax', 'tax', '2.0000', 2),
(276, 69, 'total', 'total', '62.0000', 3),
(277, 70, 'sub_total', 'sub_total', '40.0000', 0),
(278, 70, 'flat', 'shipping_cost', '20.0000', 1),
(279, 70, 'tax', 'tax', '2.0000', 2),
(280, 70, 'total', 'total', '62.0000', 3),
(281, 71, 'sub_total', 'sub_total', '400.0000', 0),
(282, 71, 'flat', 'shipping_cost', '20.0000', 1),
(283, 71, 'tax', 'tax', '20.0000', 2),
(284, 71, 'total', 'total', '440.0000', 3),
(285, 72, 'sub_total', 'sub_total', '40.0000', 0),
(286, 72, 'flat', 'shipping_cost', '20.0000', 1),
(287, 72, 'tax', 'tax', '2.0000', 2),
(288, 72, 'total', 'total', '62.0000', 3),
(289, 73, 'sub_total', 'sub_total', '999.9900', 0),
(290, 73, 'flat', 'shipping_cost', '20.0000', 1),
(291, 73, 'tax', 'tax', '49.9995', 2),
(292, 73, 'total', 'total', '1069.9895', 3),
(293, 74, 'sub_total', 'sub_total', '40.0000', 0),
(294, 74, 'free', 'shipping_cost', '0.0000', 1),
(295, 74, 'tax', 'tax', '4.0000', 2),
(296, 74, 'total', 'total', '44.0000', 3),
(297, 75, 'sub_total', 'sub_total', '40.0000', 0),
(298, 75, 'flat', 'shipping_cost', '20.0000', 1),
(299, 75, 'tax', 'tax', '4.0000', 2),
(300, 75, 'total', 'total', '64.0000', 3),
(301, 76, 'sub_total', 'sub_total', '40.0000', 0),
(302, 76, 'flat', 'shipping_cost', '20.0000', 1),
(303, 76, 'tax', 'tax', '27.0000', 2),
(304, 76, 'total', 'total', '87.0000', 3),
(305, 77, 'sub_total', 'sub_total', '80.0000', 0),
(306, 77, 'flat', 'shipping_cost', '20.0000', 1),
(307, 77, 'tax', 'tax', '54.0000', 2),
(308, 77, 'total', 'total', '154.0000', 3),
(309, 78, 'sub_total', 'sub_total', '999.9900', 0),
(310, 78, 'flat', 'shipping_cost', '20.0000', 1),
(311, 78, 'tax', 'tax', '39.9998', 2),
(312, 78, 'total', 'total', '1059.9898', 3),
(313, 79, 'sub_total', 'sub_total', '40.0000', 0),
(314, 79, 'flat', 'shipping_cost', '20.0000', 1),
(315, 79, 'tax', 'tax', '5.0000', 2),
(316, 79, 'total', 'total', '65.0000', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ci_pages`
--

CREATE TABLE `ci_pages` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `menu_title` varchar(128) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `route_id` int(128) NOT NULL,
  `content` longtext NOT NULL,
  `sequence` int(11) NOT NULL DEFAULT 0,
  `url` varchar(255) DEFAULT NULL,
  `new_window` tinyint(1) DEFAULT 0,
  `meta_title` text NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT 1,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_pages`
--

INSERT INTO `ci_pages` (`id`, `title`, `menu_title`, `slug`, `route_id`, `content`, `sequence`, `url`, `new_window`, `meta_title`, `meta_keywords`, `meta_description`, `enabled`, `date_added`, `date_modified`) VALUES
(1, 0, 'Privacy Policy', 'Privacy Policy', 'privacy-policy', 1, '<h1><span style=\"font-size: 14pt;\"><strong>Privacy Statement</strong></span></h1>\r\n<p><br />TechCity Canada is dedicated to the information and documentation security of all customers. Personal and non-personal information collected is used in the most professional manner. All personal information (such as name, mailing address, email address, telephone number, account information, etc.) is&nbsp;kept in the stickiest confidence. All non-personal information (which is information that does not identify the user, such as your IP address or browsing information) is taken strictly for statistical and customer service purposes but does not retain the customer&rsquo;s identity.</p>\r\n<div class=\"mainbox-body\"><br />\r\n<h2><span style=\"font-size: 14pt;\"><strong>Confidentiality of Information</strong></span></h2>\r\n<p>Personal information will only be released to process your order and will follow a very secure code. When you place an order, your name, credit card number and purchase quantity will be released to your financial institution for authorization. If there are discrepancies with this part of the process, your order may not be processed. Your name, address and telephone number will also be given to shipping companies/suppliers in order to facilitate efficient delivery of your product. Personal information may also be released in necessary cases, such as to your credit card institution, suppliers and warranty providers. These parties will also be bound by our confidentiality regulations.</p>\r\n<p>&nbsp;</p>\r\n<p>Please note that we may release personal information if mandated under the Canadian Information Act, such as in the following cases:</p>\r\n<ul class=\"main-list\">\r\n<li>When personal information is required by a certified legal authority</li>\r\n<li>For the purposes of combating fraud or other unlawful activity</li>\r\n<li>In response to court orders or subpoenas</li>\r\n<li>To our personal legal representative</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Regarding non-personal information, IP addresses or browsing information will not be individually released. This information will be treated as a group and collectively studied for statistical purposes only. Information about shopping preferences may be catalogued to provide more appropriate service to the customer but will also not contain the identity of the buyer. All questions regarding this Privacy Policy should be directed to&nbsp;<a href=\"mailto:admin@tecsourcecanada.ca?subject=Privacy%20Policy\">info@techcitycanada.ca<br /><br /></a></p>\r\n<h2><span style=\"font-size: 14pt;\"><strong>Disclaimers</strong></span></h2>\r\n<ul class=\"main-list\">\r\n<li>TechCity Canada&nbsp;does not take responsibility for third-party links that are available from our web page or the information this link gathers. Please install appropriate software to combat any changes these links may make on your computer.</li>\r\n<li>Third Party links or advertisements on our web-page may present messages that do not necessarily represent the views of&nbsp;TechCity Canada.</li>\r\n<li>TechCity Canada&nbsp;maintains the right to modify this policy at any time. It is the responsibility of the buyer to review this policy occasionally to ensure proper conduct.</li>\r\n<li>This policy is binding upon both&nbsp;TechCity Canada&nbsp;and its customers.</li>\r\n<li>TechCity Canada&nbsp;reserves the right to cancel an order if information provided is lacking or incorrect.</li>\r\n</ul>\r\n</div>', 0, 1, 0, NULL, 0, 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', 1, '2020-06-27 11:36:29', '2021-12-21 12:48:40'),
(2, 0, 'About Us', 'About Us', 'about-us', 2, '<h1><span style=\"font-size: 12pt;\"><span style=\"font-family: arial, helvetica, sans-serif;\"><span style=\"font-family: \'arial black\', sans-serif;\">In the year 2008, Techcity was founded by our CEO, based on a vision for an electronics store which did things the right way.</span></span></span></h1>\r\n<div>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: Arial;\">What is the &ldquo;right way&rdquo; you may ask?</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: Arial;\">While many of the &ldquo;big players&rdquo; see customers as dollar signs and nothing else, we see them for what they are, real people, looking for quality and expertise which we strive to provide on a daily basis.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: Arial;\">While we have expanded, our values have stayed much the same. Every day we try to do our best to meet the needs of our customers and keep a positive attitude while doing it.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: Arial;\">Our products lines are incredibly diverse and chances are if you need something electronics related, we got it. We carry almost every type of electronic products and our experienced technicians are present for repair and technical assistance services. Our goal is to provide quality at competitive prices, this is our guarantee to you.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: Arial;\">We currently have 2 locations around the GTA: 1012 Gerrard St E. (Downtown Toronto), and 1274 Kennedy Rd. (Scarborough).</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: Arial;\">Our website is designed in a simple and transparent manner so that our customers can do some prior research regarding our product selection and when it is more convenient for them, they may have us deliver items or reserve them for pickup.</span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: Arial;\"><strong>General Manager</strong></span></p>\r\n<p><span style=\"font-family: Arial;\">Maqsood Ahmad</span></p>\r\n<p><span style=\"font-family: Arial;\">max@techcitycanada.ca</span></p>\r\n<p>&nbsp;</p>\r\n<p><strong><span style=\"font-family: Arial;\">Chief Operating Officer</span></strong></p>\r\n<p><span style=\"font-family: Arial;\">Amjad Shahid</span></p>\r\n<p><span style=\"font-family: Arial;\">ali@techcitycanada.ca</span></p>\r\n</div>', 0, 1, 1, NULL, 0, 'About Us', 'About Us', 'About Us', 1, '2020-06-27 11:45:25', '2021-12-21 12:47:16'),
(3, 0, 'Free Shipping', 'Free Shipping', 'free-shipping', 3, '<p>Free Shipping</p>', 0, 0, 2, NULL, 0, 'Free Shipping', 'Free Shipping', 'Free Shipping', 1, '2020-08-06 07:30:06', '2022-01-28 07:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `ci_page_contents`
--

CREATE TABLE `ci_page_contents` (
  `page_content_id` int(11) NOT NULL,
  `page_id` int(11) UNSIGNED NOT NULL,
  `culture_code` varchar(32) CHARACTER SET latin1 NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `meta_title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `meta_keywords` text CHARACTER SET latin1 NOT NULL,
  `meta_description` text CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `short_description` text CHARACTER SET latin1 NOT NULL,
  `content` longtext NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT 0,
  `suspended` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `added_by_id` int(11) NOT NULL,
  `added_by_name` varchar(128) NOT NULL,
  `added_by_ip` varchar(40) NOT NULL,
  `modified_by_id` int(11) NOT NULL,
  `modified_by_name` varchar(128) NOT NULL,
  `modified_by_ip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_page_contents`
--

INSERT INTO `ci_page_contents` (`page_content_id`, `page_id`, `culture_code`, `name`, `meta_title`, `meta_keywords`, `meta_description`, `description`, `short_description`, `content`, `sort_order`, `suspended`, `deleted`, `enabled`, `date_added`, `date_modified`, `added_by_id`, `added_by_name`, `added_by_ip`, `modified_by_id`, `modified_by_name`, `modified_by_ip`) VALUES
(1000000, 1000000, 'en-US', 'About Us', 'About Us', 'About Us', 'About Us', 'About Us', 'About Us', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><br><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 0, 0, 0, 1, '2017-11-09 09:25:49', '0000-00-00 00:00:00', 0, '', '', 0, '', ''),
(1000001, 1000000, 'ar-SA', 'About Us - Arabic', 'About Us', 'About Us', 'About Us', 'About Us', 'About Us', '<p><img src=\"https://localhost/www/booking/uploads/wysiwyg/FILE-20171109-0848ZJS76E3JAV4F.jpg\" width=\"100\" height=\"75\" /></p>\r\n<ul>\r\n<li>About Us</li>\r\n<li>About Us</li>\r\n<li>About Us</li>\r\n</ul>', 0, 0, 0, 1, '2017-11-09 09:26:40', '2017-11-09 09:26:49', 0, '', '', 0, '', ''),
(1000002, 1000001, 'en-US', 'Who We Are', 'Who We Are', 'Who We Are', 'Who We Are', '', '', '<p>Who We Are</p>\r\n<p>Who We Are</p>\r\n<p>Who We Are</p>', 0, 0, 0, 1, '2017-11-09 19:12:16', '0000-00-00 00:00:00', 0, '', '', 0, '', ''),
(1000003, 1000001, 'ar-SA', 'Who We Are - Arabic', 'Who We Are', 'Who We Are', 'Who We Are', 'Who We Are', 'Who We Are', '<p>Who We Are</p>\r\n<p>Who We Are</p>\r\n<p>Who We Are</p>\r\n<p>Who We Are</p>\r\n<p>Who We Are</p>', 0, 0, 0, 1, '2017-11-09 19:12:50', '0000-00-00 00:00:00', 0, '', '', 0, '', ''),
(1000004, 1000003, 'en-US', 'Terms and Conditions', 'Terms and Conditions', 'Terms and Conditions', 'Terms and Conditions', 'Terms and Conditions', 'Terms and Conditions', '<p><strong>Consent</strong><br /><br />By using this website, you consent to our collection, use and retention of the information as described herein. If we decide to make changes to this Privacy Policy, we will post the changes on this page so that you will always know what information we collect and how we use it<br /><br /><strong>Use and Purpose of Collected Personal Information</strong><br /><br />Our website uses cookies (a small piece of information sent by a web server to store information on your web browser so it can later be read back from that browser) to collect information of your use of our website and to facilitate return visits. Cookies on our website may collect information about the internet domain and internet protocol address from which you access our website, the date and time that you visited our website and the pages that you visited on our website. You can determine cookie use independently through your web browser settings, however this may limit your access to or use of our website. The information that we collect from the cookies and the information that you provide to us when you request information from us via our website or complete questionnaires or surveys posted on our website is used to provide you with the information that you have requested, to keep you informed of our current and new products and services (unless you have indicated that you do not wish to receive marketing material from us), to improve the functionality of our website, to facilitate your use of our website, to create statistical data for our marketing purposes, to develop non-personally identifiable profiles of parties that are interested in our products and services, to build databases for marketing material such as emailers and campaigns and for client support. We will not use your personal information for any purpose, other than as stated in this Privacy Policy, without your express consent. We may process your information on a server located outside the country that you are located in. If any of the information that you have furnished to us via our website changes, you need to advise us as soon as possible so that we can update our records<br /><br /><strong>Protection and Sharing of Information</strong><br /><br />We take all reasonable steps to secure any information and data provided by user, collected from you, from unauthorized access and disclosure, unlawful processing and alteration. For Android and IOS applications, user information is secured by SSL URL and transmit data to the server in encrypted form, however, we cannot make any warranties or representations that such information will be 100% safe and secure. We will notify you if we become aware of any unauthorized access, disclosure or processing of your information.<br /><br /><strong>We share the information provided by and collected from you with:</strong><br /><br />* Our affiliated companies in other countries for registrations pertaining to those countries and as statistical data.<br /><br />* Our employees and third party service providers who assist us in processing your information for the purposes set out in this Privacy Policy.<br /><br />* Save for this, we will only share the information provided by and collected from you with third parties with your express permission, or as required by applicable law or as may be necessary to protect or defend our rights. We do not sell or rent your information to third parties.<br /><br />* Our affiliated companies, employees and service providers who have access to personal information obtained via our website are obliged to respect the confidentiality of such information and to only process the information for the purposes set out in this Privacy Policy.<br /><br />* We will not retain your information longer than the period for which it was originally needed unless we are required by law to do so, or the information will only be used for historical, statistical or research purposes or you consent to us retaining such information for a longer period.<br /><br />* You undertake not to deliver or attempt to deliver, whether on purpose or negligently, any damaging code to our website or the server or computer network that support our<br /><br />website or to use any device to breach or overcome the security measures of our website. We reserve the right to claim all damages and losses that we suffer from you as a result of the above</p>', 0, 0, 0, 1, '2018-07-05 06:52:36', '2018-07-05 09:44:55', 0, '', '', 0, '', ''),
(1000005, 1000004, 'en-US', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', '<p><strong>Consent</strong><br /><br />By using this website, you consent to our collection, use and retention of the information as described herein. If we decide to make changes to this Privacy Policy, we will post the changes on this page so that you will always know what information we collect and how we use it<br /><br /><strong>Use and Purpose of Collected Personal Information</strong><br /><br />Our website uses cookies (a small piece of information sent by a web server to store information on your web browser so it can later be read back from that browser) to collect information of your use of our website and to facilitate return visits. Cookies on our website may collect information about the internet domain and internet protocol address from which you access our website, the date and time that you visited our website and the pages that you visited on our website. You can determine cookie use independently through your web browser settings, however this may limit your access to or use of our website. The information that we collect from the cookies and the information that you provide to us when you request information from us via our website or complete questionnaires or surveys posted on our website is used to provide you with the information that you have requested, to keep you informed of our current and new products and services (unless you have indicated that you do not wish to receive marketing material from us), to improve the functionality of our website, to facilitate your use of our website, to create statistical data for our marketing purposes, to develop non-personally identifiable profiles of parties that are interested in our products and services, to build databases for marketing material such as emailers and campaigns and for client support. We will not use your personal information for any purpose, other than as stated in this Privacy Policy, without your express consent. We may process your information on a server located outside the country that you are located in. If any of the information that you have furnished to us via our website changes, you need to advise us as soon as possible so that we can update our records<br /><br /><strong>Protection and Sharing of Information</strong><br /><br />We take all reasonable steps to secure any information and data provided by user, collected from you, from unauthorized access and disclosure, unlawful processing and alteration. For Android and IOS applications, user information is secured by SSL URL and transmit data to the server in encrypted form, however, we cannot make any warranties or representations that such information will be 100% safe and secure. We will notify you if we become aware of any unauthorized access, disclosure or processing of your information.<br /><br /><strong>We share the information provided by and collected from you with:</strong><br /><br />* Our affiliated companies in other countries for registrations pertaining to those countries and as statistical data.<br /><br />* Our employees and third party service providers who assist us in processing your information for the purposes set out in this Privacy Policy.<br /><br />* Save for this, we will only share the information provided by and collected from you with third parties with your express permission, or as required by applicable law or as may be necessary to protect or defend our rights. We do not sell or rent your information to third parties.<br /><br />* Our affiliated companies, employees and service providers who have access to personal information obtained via our website are obliged to respect the confidentiality of such information and to only process the information for the purposes set out in this Privacy Policy.<br /><br />* We will not retain your information longer than the period for which it was originally needed unless we are required by law to do so, or the information will only be used for historical, statistical or research purposes or you consent to us retaining such information for a longer period.<br /><br />* You undertake not to deliver or attempt to deliver, whether on purpose or negligently, any damaging code to our website or the server or computer network that support our<br /><br />website or to use any device to breach or overcome the security measures of our website. We reserve the right to claim all damages and losses that we suffer from you as a result of the above</p>', 0, 0, 0, 1, '2018-07-05 07:26:20', '2018-07-05 09:45:54', 0, '', '', 0, '', ''),
(1000006, 1000005, 'en-US', 'Returns', 'Returns', 'Returns', 'Returns', 'Returns', 'Returns', 'Returns page', 0, 0, 0, 1, '2018-07-05 07:33:34', '0000-00-00 00:00:00', 0, '', '', 0, '', ''),
(1000007, 1000006, 'en-US', 'Latest News', 'Latest News', 'Latest News', 'Latest News', 'Latest News', 'Latest News', 'Latest News Page', 0, 0, 0, 1, '2018-07-05 07:34:35', '0000-00-00 00:00:00', 0, '', '', 0, '', ''),
(1000008, 1000008, 'en-US', 'Placing Your Bid', 'Placing Your Bid', 'Placing Your Bid', 'Placing Your Bid', 'Placing Your Bid', 'Placing Your Bid', 'Placing Your Bid Page', 0, 0, 0, 1, '2018-07-05 07:36:27', '0000-00-00 00:00:00', 0, '', '', 0, '', ''),
(1000009, 1000009, 'en-US', 'How Auction Works', 'How Auction Works', 'How Auction Works', 'How Auction Works', 'How Auction Works', 'How Auction Works', '<p>How Auction Works</p>', 0, 0, 0, 1, '2018-07-13 09:59:47', '0000-00-00 00:00:00', 0, '', '', 0, '', ''),
(1000010, 1000010, 'en-US', 'Why Sell', 'Why Sell', 'Why Sell', 'Why Sell', 'Why Sell', 'Why Sell', '<p>Why Sell</p>', 0, 0, 0, 1, '2018-07-13 10:01:24', '0000-00-00 00:00:00', 0, '', '', 0, '', ''),
(1000011, 1000011, 'en-US', 'Free Shipping', 'Free Shipping', 'Free Shipping', 'Free Shipping', 'Free Shipping', 'Free Shipping', '<div class=\"col-sm-4\"><img src=\"http://www.mccormackracing.com/images/free_shipping_250.png\"></div>\r\n<div class=\"col-sm-8\">\r\n<p>McCormack Racing offers FREE shipping on all orders over $150. There are no handling fees, no single piece fees, no unboxable product fees. When you order over $150 worth of product we ship it to your 100% FREE! The price you see, is the price you pay!</p>\r\n\r\n<p>Many other companies offer limited free shipping or no free shipping at all. Often times there are hidden costs such as a transaction fee or handling fee. We stock and ship our product quickly, usually within 1-2 business days. If you have any questions, please <a href=\"contact-us.html\">contact us</a> and one of our staff will answer any questions you may have.</p>\r\n</div>\r\n', 0, 0, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 0, '', ''),
(1000012, 1000012, 'en-US', 'Gallery', 'Gallery', 'Gallery', 'Gallery', 'Gallery', 'Gallery', '<p>We are collecting photos of great looking rides with McCormack bought merchandise. If you are proud of your ride, send us photos to <a href=\"mailto:gallery@mccormackracing.com\">gallery@mccormackracing.com</a>. Make sure to include your name, location, what McCormack Racing products are on your ride, make, model and anything you want to include. We will get them up on our <a href=\"https://www.facebook.com/pages/McCormack-Racing-Enterprises/162268543797357\" target=\"_blank\">facebook</a> page and <a href=\"https://twitter.com/#!/McCormackRacing\">twitter</a> account as soon as we see them. We will add them to the gallery as soon as we have it built! thanks!</p>', 0, 0, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 0, '', ''),
(1000013, 1000013, 'en-US', 'FAQ', 'FAQ', 'FAQ', 'FAQ', 'FAQ', 'FAQ', '<p>The FAQ Section will be built soon</p>', 0, 0, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ci_paypal_log`
--

CREATE TABLE `ci_paypal_log` (
  `paypal_log_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `response` text DEFAULT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_paypal_log`
--

INSERT INTO `ci_paypal_log` (`paypal_log_id`, `order_id`, `method`, `response`, `date_added`) VALUES
(1, 1, 'SetExpressCheckout', '{\"TOKEN\":\"EC-46463444GV492904M\",\"TIMESTAMP\":\"2021-12-31T11:32:09Z\",\"CORRELATIONID\":\"be20d916e4a30\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\"}', '2021-12-31 06:32:09'),
(2, 1, 'GetExpressCheckoutDetails', '{\"TOKEN\":\"EC-46463444GV492904M\",\"BILLINGAGREEMENTACCEPTEDSTATUS\":\"0\",\"CHECKOUTSTATUS\":\"PaymentActionNotInitiated\",\"TIMESTAMP\":\"2021-12-31T11:32:23Z\",\"CORRELATIONID\":\"6cb6ac8d18cb\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\",\"EMAIL\":\"waqaskhanbhatti@gmail.com\",\"PAYERID\":\"3KHWG25BLVQ6G\",\"PAYERSTATUS\":\"unverified\",\"FIRSTNAME\":\"waqas\",\"LASTNAME\":\"khan\",\"COUNTRYCODE\":\"AE\",\"SHIPTONAME\":\"waqas khan\",\"SHIPTOSTREET\":\"Free Trade Zone\",\"SHIPTOCITY\":\"Dubai\",\"SHIPTOZIP\":\"971\",\"SHIPTOCOUNTRYCODE\":\"AE\",\"SHIPTOCOUNTRYNAME\":\"United Arab Emirates\",\"ADDRESSSTATUS\":\"Confirmed\",\"CURRENCYCODE\":\"USD\",\"AMT\":\"843.99\",\"ITEMAMT\":\"799.99\",\"SHIPPINGAMT\":\"20.00\",\"HANDLINGAMT\":\"0.00\",\"TAXAMT\":\"24.00\",\"INSURANCEAMT\":\"0.00\",\"SHIPDISCAMT\":\"0.00\",\"INSURANCEOPTIONOFFERED\":\"false\",\"L_NAME0\":\"ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER*** (Original Price: $799.99)\",\"L_NUMBER0\":\"AN515-51522L\",\"L_QTY0\":\"1\",\"L_TAXAMT0\":\"0.00\",\"L_AMT0\":\"799.99\",\"L_DESC0\":\"ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER***\\/AN515-51522L\",\"PAYMENTREQUEST_0_CURRENCYCODE\":\"USD\",\"PAYMENTREQUEST_0_AMT\":\"843.99\",\"PAYMENTREQUEST_0_ITEMAMT\":\"799.99\",\"PAYMENTREQUEST_0_SHIPPINGAMT\":\"20.00\",\"PAYMENTREQUEST_0_HANDLINGAMT\":\"0.00\",\"PAYMENTREQUEST_0_TAXAMT\":\"24.00\",\"PAYMENTREQUEST_0_INSURANCEAMT\":\"0.00\",\"PAYMENTREQUEST_0_SHIPDISCAMT\":\"0.00\",\"PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID\":\"waqaskhanbhattipaypalbusiness@gmail.com\",\"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED\":\"false\",\"PAYMENTREQUEST_0_SHIPTONAME\":\"waqas khan\",\"PAYMENTREQUEST_0_SHIPTOSTREET\":\"Free Trade Zone\",\"PAYMENTREQUEST_0_SHIPTOCITY\":\"Dubai\",\"PAYMENTREQUEST_0_SHIPTOZIP\":\"971\",\"PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE\":\"AE\",\"PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME\":\"United Arab Emirates\",\"PAYMENTREQUEST_0_ADDRESSSTATUS\":\"Confirmed\",\"L_PAYMENTREQUEST_0_NAME0\":\"ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER*** (Original Price: $799.99)\",\"L_PAYMENTREQUEST_0_NUMBER0\":\"AN515-51522L\",\"L_PAYMENTREQUEST_0_QTY0\":\"1\",\"L_PAYMENTREQUEST_0_TAXAMT0\":\"0.00\",\"L_PAYMENTREQUEST_0_AMT0\":\"799.99\",\"L_PAYMENTREQUEST_0_DESC0\":\"ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER***\\/AN515-51522L\",\"PAYMENTREQUESTINFO_0_ERRORCODE\":\"0\"}', '2021-12-31 06:32:24'),
(3, 1, 'DoExpressCheckoutPayment', '{\"TOKEN\":\"EC-46463444GV492904M\",\"SUCCESSPAGEREDIRECTREQUESTED\":\"false\",\"TIMESTAMP\":\"2021-12-31T11:32:27Z\",\"CORRELATIONID\":\"22318a4a7b83e\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\",\"TRANSACTIONID\":\"24Y46422KM6408740\",\"TRANSACTIONTYPE\":\"expresscheckout\",\"PAYMENTTYPE\":\"instant\",\"ORDERTIME\":\"2021-12-31T11:32:26Z\",\"AMT\":\"843.99\",\"FEEAMT\":\"42.61\",\"TAXAMT\":\"0.00\",\"CURRENCYCODE\":\"USD\",\"PAYMENTSTATUS\":\"Completed\",\"PENDINGREASON\":\"None\",\"REASONCODE\":\"None\",\"PROTECTIONELIGIBILITY\":\"Eligible\",\"INSURANCEOPTIONSELECTED\":\"false\",\"SHIPPINGOPTIONISDEFAULT\":\"false\",\"PAYMENTINFO_0_TRANSACTIONID\":\"24Y46422KM6408740\",\"PAYMENTINFO_0_TRANSACTIONTYPE\":\"expresscheckout\",\"PAYMENTINFO_0_PAYMENTTYPE\":\"instant\",\"PAYMENTINFO_0_ORDERTIME\":\"2021-12-31T11:32:26Z\",\"PAYMENTINFO_0_AMT\":\"843.99\",\"PAYMENTINFO_0_FEEAMT\":\"42.61\",\"PAYMENTINFO_0_TAXAMT\":\"0.00\",\"PAYMENTINFO_0_CURRENCYCODE\":\"USD\",\"PAYMENTINFO_0_EXCHANGERATE\":\"0.266575529733424\",\"PAYMENTINFO_0_PAYMENTSTATUS\":\"Completed\",\"PAYMENTINFO_0_PENDINGREASON\":\"None\",\"PAYMENTINFO_0_REASONCODE\":\"None\",\"PAYMENTINFO_0_PROTECTIONELIGIBILITY\":\"Eligible\",\"PAYMENTINFO_0_PROTECTIONELIGIBILITYTYPE\":\"ItemNotReceivedEligible,UnauthorizedPaymentEligible\",\"PAYMENTINFO_0_SELLERPAYPALACCOUNTID\":\"waqaskhanbhattipaypalbusiness@gmail.com\",\"PAYMENTINFO_0_SECUREMERCHANTACCOUNTID\":\"XXQP2MQAQWGS8\",\"PAYMENTINFO_0_ERRORCODE\":\"0\",\"PAYMENTINFO_0_ACK\":\"Success\"}', '2021-12-31 06:32:27'),
(4, 4, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:15:49Z\",\"CORRELATIONID\":\"1b7543689de37\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:15:50'),
(5, 5, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:15:54Z\",\"CORRELATIONID\":\"4c0de9413a393\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:15:55'),
(6, 6, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:17:36Z\",\"CORRELATIONID\":\"2acd61925fe0b\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:17:36'),
(7, 7, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:17:39Z\",\"CORRELATIONID\":\"46b393515710c\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:17:40'),
(8, 10, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:21:34Z\",\"CORRELATIONID\":\"58ef27420d184\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:21:35'),
(9, 11, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:21:38Z\",\"CORRELATIONID\":\"7ac2e0523bb09\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:21:38'),
(10, 12, 'SetExpressCheckout', '{\"TOKEN\":\"EC-4V676552H6766190R\",\"TIMESTAMP\":\"2022-01-04T13:22:58Z\",\"CORRELATIONID\":\"e9eb49f0cc71b\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\"}', '2022-01-04 08:22:58'),
(11, 13, 'SetExpressCheckout', '{\"TOKEN\":\"EC-40R459881X385113F\",\"TIMESTAMP\":\"2022-01-04T13:23:02Z\",\"CORRELATIONID\":\"47e7b93e50128\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\"}', '2022-01-04 08:23:03'),
(12, 13, 'GetExpressCheckoutDetails', '{\"TOKEN\":\"EC-40R459881X385113F\",\"BILLINGAGREEMENTACCEPTEDSTATUS\":\"0\",\"CHECKOUTSTATUS\":\"PaymentActionNotInitiated\",\"TIMESTAMP\":\"2022-01-04T13:23:36Z\",\"CORRELATIONID\":\"da0e71ff6e4b0\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\",\"EMAIL\":\"waqaskhanbhatti@gmail.com\",\"PAYERID\":\"3KHWG25BLVQ6G\",\"PAYERSTATUS\":\"unverified\",\"FIRSTNAME\":\"waqas\",\"LASTNAME\":\"khan\",\"COUNTRYCODE\":\"AE\",\"SHIPTONAME\":\"waqas khan\",\"SHIPTOSTREET\":\"Free Trade Zone\",\"SHIPTOCITY\":\"Dubai\",\"SHIPTOZIP\":\"971\",\"SHIPTOCOUNTRYCODE\":\"AE\",\"SHIPTOCOUNTRYNAME\":\"United Arab Emirates\",\"ADDRESSSTATUS\":\"Confirmed\",\"CURRENCYCODE\":\"USD\",\"AMT\":\"843.99\",\"ITEMAMT\":\"799.99\",\"SHIPPINGAMT\":\"20.00\",\"HANDLINGAMT\":\"0.00\",\"TAXAMT\":\"24.00\",\"INSURANCEAMT\":\"0.00\",\"SHIPDISCAMT\":\"0.00\",\"INSURANCEOPTIONOFFERED\":\"false\",\"L_NAME0\":\"ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER*** (Original Price: $799.99)\",\"L_NUMBER0\":\"AN515-51522L\",\"L_QTY0\":\"1\",\"L_TAXAMT0\":\"0.00\",\"L_AMT0\":\"799.99\",\"L_DESC0\":\"ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER***\\/AN515-51522L\",\"PAYMENTREQUEST_0_CURRENCYCODE\":\"USD\",\"PAYMENTREQUEST_0_AMT\":\"843.99\",\"PAYMENTREQUEST_0_ITEMAMT\":\"799.99\",\"PAYMENTREQUEST_0_SHIPPINGAMT\":\"20.00\",\"PAYMENTREQUEST_0_HANDLINGAMT\":\"0.00\",\"PAYMENTREQUEST_0_TAXAMT\":\"24.00\",\"PAYMENTREQUEST_0_INSURANCEAMT\":\"0.00\",\"PAYMENTREQUEST_0_SHIPDISCAMT\":\"0.00\",\"PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID\":\"waqaskhanbhattipaypalbusiness@gmail.com\",\"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED\":\"false\",\"PAYMENTREQUEST_0_SHIPTONAME\":\"waqas khan\",\"PAYMENTREQUEST_0_SHIPTOSTREET\":\"Free Trade Zone\",\"PAYMENTREQUEST_0_SHIPTOCITY\":\"Dubai\",\"PAYMENTREQUEST_0_SHIPTOZIP\":\"971\",\"PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE\":\"AE\",\"PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME\":\"United Arab Emirates\",\"PAYMENTREQUEST_0_ADDRESSSTATUS\":\"Confirmed\",\"L_PAYMENTREQUEST_0_NAME0\":\"ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER*** (Original Price: $799.99)\",\"L_PAYMENTREQUEST_0_NUMBER0\":\"AN515-51522L\",\"L_PAYMENTREQUEST_0_QTY0\":\"1\",\"L_PAYMENTREQUEST_0_TAXAMT0\":\"0.00\",\"L_PAYMENTREQUEST_0_AMT0\":\"799.99\",\"L_PAYMENTREQUEST_0_DESC0\":\"ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER***\\/AN515-51522L\",\"PAYMENTREQUESTINFO_0_ERRORCODE\":\"0\"}', '2022-01-04 08:23:37'),
(13, 13, 'DoExpressCheckoutPayment', '{\"TOKEN\":\"EC-40R459881X385113F\",\"SUCCESSPAGEREDIRECTREQUESTED\":\"false\",\"TIMESTAMP\":\"2022-01-04T13:23:40Z\",\"CORRELATIONID\":\"388cf58a5c65c\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\",\"TRANSACTIONID\":\"55A36565EN548153K\",\"TRANSACTIONTYPE\":\"expresscheckout\",\"PAYMENTTYPE\":\"instant\",\"ORDERTIME\":\"2022-01-04T13:23:39Z\",\"AMT\":\"843.99\",\"FEEAMT\":\"42.61\",\"TAXAMT\":\"0.00\",\"CURRENCYCODE\":\"USD\",\"PAYMENTSTATUS\":\"Completed\",\"PENDINGREASON\":\"None\",\"REASONCODE\":\"None\",\"PROTECTIONELIGIBILITY\":\"Eligible\",\"INSURANCEOPTIONSELECTED\":\"false\",\"SHIPPINGOPTIONISDEFAULT\":\"false\",\"PAYMENTINFO_0_TRANSACTIONID\":\"55A36565EN548153K\",\"PAYMENTINFO_0_TRANSACTIONTYPE\":\"expresscheckout\",\"PAYMENTINFO_0_PAYMENTTYPE\":\"instant\",\"PAYMENTINFO_0_ORDERTIME\":\"2022-01-04T13:23:39Z\",\"PAYMENTINFO_0_AMT\":\"843.99\",\"PAYMENTINFO_0_FEEAMT\":\"42.61\",\"PAYMENTINFO_0_TAXAMT\":\"0.00\",\"PAYMENTINFO_0_CURRENCYCODE\":\"USD\",\"PAYMENTINFO_0_EXCHANGERATE\":\"0.266575529733424\",\"PAYMENTINFO_0_PAYMENTSTATUS\":\"Completed\",\"PAYMENTINFO_0_PENDINGREASON\":\"None\",\"PAYMENTINFO_0_REASONCODE\":\"None\",\"PAYMENTINFO_0_PROTECTIONELIGIBILITY\":\"Eligible\",\"PAYMENTINFO_0_PROTECTIONELIGIBILITYTYPE\":\"ItemNotReceivedEligible,UnauthorizedPaymentEligible\",\"PAYMENTINFO_0_SELLERPAYPALACCOUNTID\":\"waqaskhanbhattipaypalbusiness@gmail.com\",\"PAYMENTINFO_0_SECUREMERCHANTACCOUNTID\":\"XXQP2MQAQWGS8\",\"PAYMENTINFO_0_ERRORCODE\":\"0\",\"PAYMENTINFO_0_ACK\":\"Success\"}', '2022-01-04 08:23:41'),
(14, 16, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:29:14Z\",\"CORRELATIONID\":\"ce5c43d332960\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:29:15'),
(15, 17, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:29:18Z\",\"CORRELATIONID\":\"36d3e81e2cf0\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:29:18'),
(16, 18, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:30:02Z\",\"CORRELATIONID\":\"3c6de72c6b426\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:30:03'),
(17, 19, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:30:18Z\",\"CORRELATIONID\":\"b1db75cf1309d\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:30:19'),
(18, 20, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:30:55Z\",\"CORRELATIONID\":\"8e893de9fec2a\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:30:56'),
(19, 21, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:36:58Z\",\"CORRELATIONID\":\"20fd8932ce423\",\"ACK\":\"Failure\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\",\"L_ERRORCODE0\":\"10413\",\"L_SHORTMESSAGE0\":\"Transaction refused because of an invalid argument. See additional error messages for details.\",\"L_LONGMESSAGE0\":\"The totals of the cart item amounts do not match order amounts.\",\"L_SEVERITYCODE0\":\"Error\"}', '2022-01-04 08:36:58'),
(20, 22, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:38:26Z\",\"CORRELATIONID\":\"c7b24e86286d1\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:38:27'),
(21, 23, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:40:51Z\",\"CORRELATIONID\":\"de3d1e3733952\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:40:52'),
(22, 24, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:41:41Z\",\"CORRELATIONID\":\"126f4c0a3f475\",\"ACK\":\"Failure\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\",\"L_ERRORCODE0\":\"10413\",\"L_SHORTMESSAGE0\":\"Transaction refused because of an invalid argument. See additional error messages for details.\",\"L_LONGMESSAGE0\":\"The totals of the cart item amounts do not match order amounts.\",\"L_SEVERITYCODE0\":\"Error\"}', '2022-01-04 08:41:42'),
(23, 25, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:42:06Z\",\"CORRELATIONID\":\"2490dad2114c3\",\"ACK\":\"Failure\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\",\"L_ERRORCODE0\":\"10413\",\"L_SHORTMESSAGE0\":\"Transaction refused because of an invalid argument. See additional error messages for details.\",\"L_LONGMESSAGE0\":\"The totals of the cart item amounts do not match order amounts.\",\"L_SEVERITYCODE0\":\"Error\"}', '2022-01-04 08:42:07'),
(24, 26, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:43:21Z\",\"CORRELATIONID\":\"91a31d6794529\",\"ACK\":\"Failure\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\",\"L_ERRORCODE0\":\"10413\",\"L_SHORTMESSAGE0\":\"Transaction refused because of an invalid argument. See additional error messages for details.\",\"L_LONGMESSAGE0\":\"The totals of the cart item amounts do not match order amounts.\",\"L_SEVERITYCODE0\":\"Error\"}', '2022-01-04 08:43:22'),
(25, 27, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:43:41Z\",\"CORRELATIONID\":\"58601b390004b\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:43:42'),
(26, 28, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:49:37Z\",\"CORRELATIONID\":\"e421efd15a96a\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:49:38'),
(27, 29, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:49:41Z\",\"CORRELATIONID\":\"a1019c3f058e3\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:49:42'),
(28, 30, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:50:40Z\",\"CORRELATIONID\":\"99c31b1827681\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:50:41'),
(29, 33, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:52:41Z\",\"CORRELATIONID\":\"53e8c68b43c73\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:52:42'),
(30, 34, 'SetExpressCheckout', '{\"TIMESTAMP\":\"2022-01-04T13:53:24Z\",\"CORRELATIONID\":\"6b6c3afe05924\",\"ACK\":\"Failure\",\"L_ERRORCODE0\":\"10004\",\"L_SHORTMESSAGE0\":\"Invalid Request Error.\",\"L_LONGMESSAGE0\":\"Transaction refused because of an invalid argument.\"}', '2022-01-04 08:53:25'),
(31, 35, 'SetExpressCheckout', '{\"TOKEN\":\"EC-8A620526C22181314\",\"TIMESTAMP\":\"2022-01-04T13:54:13Z\",\"CORRELATIONID\":\"9dd0dedcf5613\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\"}', '2022-01-04 08:54:14'),
(32, 36, 'SetExpressCheckout', '{\"TOKEN\":\"EC-34G299348R8419429\",\"TIMESTAMP\":\"2022-01-04T13:56:41Z\",\"CORRELATIONID\":\"598ed0117bdfa\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\"}', '2022-01-04 08:56:42'),
(33, 37, 'SetExpressCheckout', '{\"TOKEN\":\"EC-05132434776381604\",\"TIMESTAMP\":\"2022-01-04T13:56:46Z\",\"CORRELATIONID\":\"a4731057ec75a\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\"}', '2022-01-04 08:56:46'),
(34, 48, 'SetExpressCheckout', '{\"TOKEN\":\"EC-4KB45274AU143280T\",\"TIMESTAMP\":\"2022-01-10T12:52:56Z\",\"CORRELATIONID\":\"caf49a1308947\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\"}', '2022-01-10 07:52:57'),
(35, 49, 'SetExpressCheckout', '{\"TOKEN\":\"EC-4JR01269UB805480D\",\"TIMESTAMP\":\"2022-01-10T12:53:00Z\",\"CORRELATIONID\":\"ff1f192cd644\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\"}', '2022-01-10 07:53:01'),
(36, 53, 'SetExpressCheckout', '{\"TOKEN\":\"EC-73P85995F4344560H\",\"TIMESTAMP\":\"2022-01-10T13:20:47Z\",\"CORRELATIONID\":\"de0476643de49\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\"}', '2022-01-10 08:20:49'),
(37, 54, 'SetExpressCheckout', '{\"TOKEN\":\"EC-5D149183FL013152S\",\"TIMESTAMP\":\"2022-01-10T13:20:52Z\",\"CORRELATIONID\":\"bdc40b63e200a\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\"}', '2022-01-10 08:20:53'),
(38, 54, 'GetExpressCheckoutDetails', '{\"TOKEN\":\"EC-5D149183FL013152S\",\"BILLINGAGREEMENTACCEPTEDSTATUS\":\"0\",\"CHECKOUTSTATUS\":\"PaymentActionNotInitiated\",\"TIMESTAMP\":\"2022-01-10T13:21:11Z\",\"CORRELATIONID\":\"b266074564017\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\",\"EMAIL\":\"waqaskhanbhatti@gmail.com\",\"PAYERID\":\"3KHWG25BLVQ6G\",\"PAYERSTATUS\":\"unverified\",\"FIRSTNAME\":\"waqas\",\"LASTNAME\":\"khan\",\"COUNTRYCODE\":\"AE\",\"SHIPTONAME\":\"waqas khan\",\"SHIPTOSTREET\":\"Free Trade Zone\",\"SHIPTOCITY\":\"Dubai\",\"SHIPTOZIP\":\"971\",\"SHIPTOCOUNTRYCODE\":\"AE\",\"SHIPTOCOUNTRYNAME\":\"United Arab Emirates\",\"ADDRESSSTATUS\":\"Confirmed\",\"CURRENCYCODE\":\"USD\",\"AMT\":\"40.00\",\"ITEMAMT\":\"20.00\",\"SHIPPINGAMT\":\"20.00\",\"HANDLINGAMT\":\"0.00\",\"TAXAMT\":\"0.00\",\"INSURANCEAMT\":\"0.00\",\"SHIPDISCAMT\":\"0.00\",\"INSURANCEOPTIONOFFERED\":\"false\",\"L_NAME0\":\"Apple MacBook Air 11.6 (2014) - I5\\/4GB RAM\\/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb ) (Original Price: $20.00)\",\"L_NUMBER0\":\"A1465_2gb250gb\",\"L_QTY0\":\"1\",\"L_TAXAMT0\":\"0.00\",\"L_AMT0\":\"20.00\",\"L_DESC0\":\"Apple MacBook Air 11.6 (2014) - I5\\/4GB RAM\\/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )\\/A1465_2gb250gb\",\"PAYMENTREQUEST_0_CURRENCYCODE\":\"USD\",\"PAYMENTREQUEST_0_AMT\":\"40.00\",\"PAYMENTREQUEST_0_ITEMAMT\":\"20.00\",\"PAYMENTREQUEST_0_SHIPPINGAMT\":\"20.00\",\"PAYMENTREQUEST_0_HANDLINGAMT\":\"0.00\",\"PAYMENTREQUEST_0_TAXAMT\":\"0.00\",\"PAYMENTREQUEST_0_INSURANCEAMT\":\"0.00\",\"PAYMENTREQUEST_0_SHIPDISCAMT\":\"0.00\",\"PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID\":\"waqaskhanbhattipaypalbusiness@gmail.com\",\"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED\":\"false\",\"PAYMENTREQUEST_0_SHIPTONAME\":\"waqas khan\",\"PAYMENTREQUEST_0_SHIPTOSTREET\":\"Free Trade Zone\",\"PAYMENTREQUEST_0_SHIPTOCITY\":\"Dubai\",\"PAYMENTREQUEST_0_SHIPTOZIP\":\"971\",\"PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE\":\"AE\",\"PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME\":\"United Arab Emirates\",\"PAYMENTREQUEST_0_ADDRESSSTATUS\":\"Confirmed\",\"L_PAYMENTREQUEST_0_NAME0\":\"Apple MacBook Air 11.6 (2014) - I5\\/4GB RAM\\/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb ) (Original Price: $20.00)\",\"L_PAYMENTREQUEST_0_NUMBER0\":\"A1465_2gb250gb\",\"L_PAYMENTREQUEST_0_QTY0\":\"1\",\"L_PAYMENTREQUEST_0_TAXAMT0\":\"0.00\",\"L_PAYMENTREQUEST_0_AMT0\":\"20.00\",\"L_PAYMENTREQUEST_0_DESC0\":\"Apple MacBook Air 11.6 (2014) - I5\\/4GB RAM\\/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:250gb )\\/A1465_2gb250gb\",\"PAYMENTREQUESTINFO_0_ERRORCODE\":\"0\"}', '2022-01-10 08:21:12'),
(39, 54, 'DoExpressCheckoutPayment', '{\"TOKEN\":\"EC-5D149183FL013152S\",\"SUCCESSPAGEREDIRECTREQUESTED\":\"false\",\"TIMESTAMP\":\"2022-01-10T13:21:15Z\",\"CORRELATIONID\":\"c388b43b60e79\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\",\"TRANSACTIONID\":\"9PC27918T0528515H\",\"TRANSACTIONTYPE\":\"expresscheckout\",\"PAYMENTTYPE\":\"instant\",\"ORDERTIME\":\"2022-01-10T13:21:14Z\",\"AMT\":\"40.00\",\"FEEAMT\":\"2.49\",\"TAXAMT\":\"0.00\",\"CURRENCYCODE\":\"USD\",\"PAYMENTSTATUS\":\"Completed\",\"PENDINGREASON\":\"None\",\"REASONCODE\":\"None\",\"PROTECTIONELIGIBILITY\":\"Eligible\",\"INSURANCEOPTIONSELECTED\":\"false\",\"SHIPPINGOPTIONISDEFAULT\":\"false\",\"PAYMENTINFO_0_TRANSACTIONID\":\"9PC27918T0528515H\",\"PAYMENTINFO_0_TRANSACTIONTYPE\":\"expresscheckout\",\"PAYMENTINFO_0_PAYMENTTYPE\":\"instant\",\"PAYMENTINFO_0_ORDERTIME\":\"2022-01-10T13:21:14Z\",\"PAYMENTINFO_0_AMT\":\"40.00\",\"PAYMENTINFO_0_FEEAMT\":\"2.49\",\"PAYMENTINFO_0_TAXAMT\":\"0.00\",\"PAYMENTINFO_0_CURRENCYCODE\":\"USD\",\"PAYMENTINFO_0_EXCHANGERATE\":\"0.266575529733424\",\"PAYMENTINFO_0_PAYMENTSTATUS\":\"Completed\",\"PAYMENTINFO_0_PENDINGREASON\":\"None\",\"PAYMENTINFO_0_REASONCODE\":\"None\",\"PAYMENTINFO_0_PROTECTIONELIGIBILITY\":\"Eligible\",\"PAYMENTINFO_0_PROTECTIONELIGIBILITYTYPE\":\"ItemNotReceivedEligible,UnauthorizedPaymentEligible\",\"PAYMENTINFO_0_SELLERPAYPALACCOUNTID\":\"waqaskhanbhattipaypalbusiness@gmail.com\",\"PAYMENTINFO_0_SECUREMERCHANTACCOUNTID\":\"XXQP2MQAQWGS8\",\"PAYMENTINFO_0_ERRORCODE\":\"0\",\"PAYMENTINFO_0_ACK\":\"Success\"}', '2022-01-10 08:21:16'),
(40, 77, 'SetExpressCheckout', '{\"TOKEN\":\"EC-2CD981640U849543W\",\"TIMESTAMP\":\"2022-01-21T06:47:00Z\",\"CORRELATIONID\":\"b3770be79494a\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\"}', '2022-01-21 01:47:01'),
(41, 77, 'GetExpressCheckoutDetails', '{\"TOKEN\":\"EC-2CD981640U849543W\",\"BILLINGAGREEMENTACCEPTEDSTATUS\":\"0\",\"CHECKOUTSTATUS\":\"PaymentActionNotInitiated\",\"TIMESTAMP\":\"2022-01-21T06:48:44Z\",\"CORRELATIONID\":\"629f65b1ca8aa\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\",\"EMAIL\":\"waqaskhanbhatti@gmail.com\",\"PAYERID\":\"3KHWG25BLVQ6G\",\"PAYERSTATUS\":\"unverified\",\"FIRSTNAME\":\"waqas\",\"LASTNAME\":\"khan\",\"COUNTRYCODE\":\"AE\",\"SHIPTONAME\":\"waqas khan\",\"SHIPTOSTREET\":\"Free Trade Zone\",\"SHIPTOCITY\":\"Dubai\",\"SHIPTOZIP\":\"971\",\"SHIPTOCOUNTRYCODE\":\"AE\",\"SHIPTOCOUNTRYNAME\":\"United Arab Emirates\",\"ADDRESSSTATUS\":\"Confirmed\",\"CURRENCYCODE\":\"USD\",\"AMT\":\"154.00\",\"ITEMAMT\":\"80.00\",\"SHIPPINGAMT\":\"20.00\",\"HANDLINGAMT\":\"0.00\",\"TAXAMT\":\"54.00\",\"INSURANCEAMT\":\"0.00\",\"SHIPDISCAMT\":\"0.00\",\"INSURANCEOPTIONOFFERED\":\"false\",\"L_NAME0\":\"Apple MacBook Air 11.6 (2014) - I5\\/4GB RAM\\/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb ) (Original Price: $40.00)\",\"L_NUMBER0\":\"A1465_2gb500gb\",\"L_QTY0\":\"2\",\"L_TAXAMT0\":\"0.00\",\"L_AMT0\":\"40.00\",\"L_DESC0\":\"Apple MacBook Air 11.6 (2014) - I5\\/4GB RAM\\/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb )\\/A1465_2gb500gb\",\"PAYMENTREQUEST_0_CURRENCYCODE\":\"USD\",\"PAYMENTREQUEST_0_AMT\":\"154.00\",\"PAYMENTREQUEST_0_ITEMAMT\":\"80.00\",\"PAYMENTREQUEST_0_SHIPPINGAMT\":\"20.00\",\"PAYMENTREQUEST_0_HANDLINGAMT\":\"0.00\",\"PAYMENTREQUEST_0_TAXAMT\":\"54.00\",\"PAYMENTREQUEST_0_INSURANCEAMT\":\"0.00\",\"PAYMENTREQUEST_0_SHIPDISCAMT\":\"0.00\",\"PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID\":\"waqaskhanbhattipaypalbusiness@gmail.com\",\"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED\":\"false\",\"PAYMENTREQUEST_0_SHIPTONAME\":\"waqas khan\",\"PAYMENTREQUEST_0_SHIPTOSTREET\":\"Free Trade Zone\",\"PAYMENTREQUEST_0_SHIPTOCITY\":\"Dubai\",\"PAYMENTREQUEST_0_SHIPTOZIP\":\"971\",\"PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE\":\"AE\",\"PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME\":\"United Arab Emirates\",\"PAYMENTREQUEST_0_ADDRESSSTATUS\":\"Confirmed\",\"L_PAYMENTREQUEST_0_NAME0\":\"Apple MacBook Air 11.6 (2014) - I5\\/4GB RAM\\/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb ) (Original Price: $40.00)\",\"L_PAYMENTREQUEST_0_NUMBER0\":\"A1465_2gb500gb\",\"L_PAYMENTREQUEST_0_QTY0\":\"2\",\"L_PAYMENTREQUEST_0_TAXAMT0\":\"0.00\",\"L_PAYMENTREQUEST_0_AMT0\":\"40.00\",\"L_PAYMENTREQUEST_0_DESC0\":\"Apple MacBook Air 11.6 (2014) - I5\\/4GB RAM\\/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb )\\/A1465_2gb500gb\",\"PAYMENTREQUESTINFO_0_ERRORCODE\":\"0\"}', '2022-01-21 01:48:45'),
(42, 77, 'DoExpressCheckoutPayment', '{\"TOKEN\":\"EC-2CD981640U849543W\",\"SUCCESSPAGEREDIRECTREQUESTED\":\"false\",\"TIMESTAMP\":\"2022-01-21T06:48:48Z\",\"CORRELATIONID\":\"a385742b15a74\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\",\"TRANSACTIONID\":\"13S60198JY7436631\",\"TRANSACTIONTYPE\":\"expresscheckout\",\"PAYMENTTYPE\":\"instant\",\"ORDERTIME\":\"2022-01-21T06:48:46Z\",\"AMT\":\"154.00\",\"FEEAMT\":\"8.17\",\"TAXAMT\":\"0.00\",\"CURRENCYCODE\":\"USD\",\"PAYMENTSTATUS\":\"Completed\",\"PENDINGREASON\":\"None\",\"REASONCODE\":\"None\",\"PROTECTIONELIGIBILITY\":\"Eligible\",\"INSURANCEOPTIONSELECTED\":\"false\",\"SHIPPINGOPTIONISDEFAULT\":\"false\",\"PAYMENTINFO_0_TRANSACTIONID\":\"13S60198JY7436631\",\"PAYMENTINFO_0_TRANSACTIONTYPE\":\"expresscheckout\",\"PAYMENTINFO_0_PAYMENTTYPE\":\"instant\",\"PAYMENTINFO_0_ORDERTIME\":\"2022-01-21T06:48:46Z\",\"PAYMENTINFO_0_AMT\":\"154.00\",\"PAYMENTINFO_0_FEEAMT\":\"8.17\",\"PAYMENTINFO_0_TAXAMT\":\"0.00\",\"PAYMENTINFO_0_CURRENCYCODE\":\"USD\",\"PAYMENTINFO_0_EXCHANGERATE\":\"0.266575529733424\",\"PAYMENTINFO_0_PAYMENTSTATUS\":\"Completed\",\"PAYMENTINFO_0_PENDINGREASON\":\"None\",\"PAYMENTINFO_0_REASONCODE\":\"None\",\"PAYMENTINFO_0_PROTECTIONELIGIBILITY\":\"Eligible\",\"PAYMENTINFO_0_PROTECTIONELIGIBILITYTYPE\":\"ItemNotReceivedEligible,UnauthorizedPaymentEligible\",\"PAYMENTINFO_0_SELLERPAYPALACCOUNTID\":\"waqaskhanbhattipaypalbusiness@gmail.com\",\"PAYMENTINFO_0_SECUREMERCHANTACCOUNTID\":\"XXQP2MQAQWGS8\",\"PAYMENTINFO_0_ERRORCODE\":\"0\",\"PAYMENTINFO_0_ACK\":\"Success\"}', '2022-01-21 01:48:49'),
(43, 78, 'SetExpressCheckout', '{\"TOKEN\":\"EC-4XA97620LJ125104J\",\"TIMESTAMP\":\"2022-01-24T07:11:35Z\",\"CORRELATIONID\":\"72b62d6dbb28e\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\"}', '2022-01-24 02:11:37'),
(44, 78, 'GetExpressCheckoutDetails', '{\"TOKEN\":\"EC-4XA97620LJ125104J\",\"BILLINGAGREEMENTACCEPTEDSTATUS\":\"0\",\"CHECKOUTSTATUS\":\"PaymentActionNotInitiated\",\"TIMESTAMP\":\"2022-01-24T07:11:53Z\",\"CORRELATIONID\":\"409d619332485\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\",\"EMAIL\":\"waqaskhanbhatti@gmail.com\",\"PAYERID\":\"3KHWG25BLVQ6G\",\"PAYERSTATUS\":\"unverified\",\"FIRSTNAME\":\"waqas\",\"LASTNAME\":\"khan\",\"COUNTRYCODE\":\"AE\",\"SHIPTONAME\":\"waqas khan\",\"SHIPTOSTREET\":\"Free Trade Zone\",\"SHIPTOCITY\":\"Dubai\",\"SHIPTOZIP\":\"971\",\"SHIPTOCOUNTRYCODE\":\"AE\",\"SHIPTOCOUNTRYNAME\":\"United Arab Emirates\",\"ADDRESSSTATUS\":\"Confirmed\",\"CURRENCYCODE\":\"USD\",\"AMT\":\"1059.99\",\"ITEMAMT\":\"999.99\",\"SHIPPINGAMT\":\"20.00\",\"HANDLINGAMT\":\"0.00\",\"TAXAMT\":\"40.00\",\"INSURANCEAMT\":\"0.00\",\"SHIPDISCAMT\":\"0.00\",\"INSURANCEOPTIONOFFERED\":\"false\",\"L_NAME0\":\"ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER*** (Original Price: $999.99)\",\"L_NUMBER0\":\"AN515-51522L\",\"L_QTY0\":\"1\",\"L_TAXAMT0\":\"0.00\",\"L_AMT0\":\"999.99\",\"L_DESC0\":\"ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER***\\/AN515-51522L\",\"PAYMENTREQUEST_0_CURRENCYCODE\":\"USD\",\"PAYMENTREQUEST_0_AMT\":\"1059.99\",\"PAYMENTREQUEST_0_ITEMAMT\":\"999.99\",\"PAYMENTREQUEST_0_SHIPPINGAMT\":\"20.00\",\"PAYMENTREQUEST_0_HANDLINGAMT\":\"0.00\",\"PAYMENTREQUEST_0_TAXAMT\":\"40.00\",\"PAYMENTREQUEST_0_INSURANCEAMT\":\"0.00\",\"PAYMENTREQUEST_0_SHIPDISCAMT\":\"0.00\",\"PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID\":\"waqaskhanbhattipaypalbusiness@gmail.com\",\"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED\":\"false\",\"PAYMENTREQUEST_0_SHIPTONAME\":\"waqas khan\",\"PAYMENTREQUEST_0_SHIPTOSTREET\":\"Free Trade Zone\",\"PAYMENTREQUEST_0_SHIPTOCITY\":\"Dubai\",\"PAYMENTREQUEST_0_SHIPTOZIP\":\"971\",\"PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE\":\"AE\",\"PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME\":\"United Arab Emirates\",\"PAYMENTREQUEST_0_ADDRESSSTATUS\":\"Confirmed\",\"L_PAYMENTREQUEST_0_NAME0\":\"ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER*** (Original Price: $999.99)\",\"L_PAYMENTREQUEST_0_NUMBER0\":\"AN515-51522L\",\"L_PAYMENTREQUEST_0_QTY0\":\"1\",\"L_PAYMENTREQUEST_0_TAXAMT0\":\"0.00\",\"L_PAYMENTREQUEST_0_AMT0\":\"999.99\",\"L_PAYMENTREQUEST_0_DESC0\":\"ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER***\\/AN515-51522L\",\"PAYMENTREQUESTINFO_0_ERRORCODE\":\"0\"}', '2022-01-24 02:11:55'),
(45, 78, 'DoExpressCheckoutPayment', '{\"TOKEN\":\"EC-4XA97620LJ125104J\",\"SUCCESSPAGEREDIRECTREQUESTED\":\"false\",\"TIMESTAMP\":\"2022-01-24T07:11:59Z\",\"CORRELATIONID\":\"31af8b5238c3c\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\",\"TRANSACTIONID\":\"6AL911329A953720B\",\"TRANSACTIONTYPE\":\"expresscheckout\",\"PAYMENTTYPE\":\"instant\",\"ORDERTIME\":\"2022-01-24T07:11:55Z\",\"AMT\":\"1059.99\",\"FEEAMT\":\"53.38\",\"TAXAMT\":\"0.00\",\"CURRENCYCODE\":\"USD\",\"PAYMENTSTATUS\":\"Completed\",\"PENDINGREASON\":\"None\",\"REASONCODE\":\"None\",\"PROTECTIONELIGIBILITY\":\"Eligible\",\"INSURANCEOPTIONSELECTED\":\"false\",\"SHIPPINGOPTIONISDEFAULT\":\"false\",\"PAYMENTINFO_0_TRANSACTIONID\":\"6AL911329A953720B\",\"PAYMENTINFO_0_TRANSACTIONTYPE\":\"expresscheckout\",\"PAYMENTINFO_0_PAYMENTTYPE\":\"instant\",\"PAYMENTINFO_0_ORDERTIME\":\"2022-01-24T07:11:55Z\",\"PAYMENTINFO_0_AMT\":\"1059.99\",\"PAYMENTINFO_0_FEEAMT\":\"53.38\",\"PAYMENTINFO_0_TAXAMT\":\"0.00\",\"PAYMENTINFO_0_CURRENCYCODE\":\"USD\",\"PAYMENTINFO_0_EXCHANGERATE\":\"0.266575529733424\",\"PAYMENTINFO_0_PAYMENTSTATUS\":\"Completed\",\"PAYMENTINFO_0_PENDINGREASON\":\"None\",\"PAYMENTINFO_0_REASONCODE\":\"None\",\"PAYMENTINFO_0_PROTECTIONELIGIBILITY\":\"Eligible\",\"PAYMENTINFO_0_PROTECTIONELIGIBILITYTYPE\":\"ItemNotReceivedEligible,UnauthorizedPaymentEligible\",\"PAYMENTINFO_0_SELLERPAYPALACCOUNTID\":\"waqaskhanbhattipaypalbusiness@gmail.com\",\"PAYMENTINFO_0_SECUREMERCHANTACCOUNTID\":\"XXQP2MQAQWGS8\",\"PAYMENTINFO_0_ERRORCODE\":\"0\",\"PAYMENTINFO_0_ACK\":\"Success\"}', '2022-01-24 02:12:01'),
(46, 79, 'SetExpressCheckout', '{\"TOKEN\":\"EC-8T340430YK706060G\",\"TIMESTAMP\":\"2022-01-28T06:05:37Z\",\"CORRELATIONID\":\"695c334d85c17\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\"}', '2022-01-28 01:05:38'),
(47, 79, 'GetExpressCheckoutDetails', '{\"TOKEN\":\"EC-8T340430YK706060G\",\"BILLINGAGREEMENTACCEPTEDSTATUS\":\"0\",\"CHECKOUTSTATUS\":\"PaymentActionNotInitiated\",\"TIMESTAMP\":\"2022-01-28T06:06:06Z\",\"CORRELATIONID\":\"f65d865ca158a\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\",\"EMAIL\":\"waqaskhanbhatti@gmail.com\",\"PAYERID\":\"3KHWG25BLVQ6G\",\"PAYERSTATUS\":\"unverified\",\"FIRSTNAME\":\"waqas\",\"LASTNAME\":\"khan\",\"COUNTRYCODE\":\"AE\",\"SHIPTONAME\":\"waqas khan\",\"SHIPTOSTREET\":\"Free Trade Zone\",\"SHIPTOCITY\":\"Dubai\",\"SHIPTOZIP\":\"971\",\"SHIPTOCOUNTRYCODE\":\"AE\",\"SHIPTOCOUNTRYNAME\":\"United Arab Emirates\",\"ADDRESSSTATUS\":\"Confirmed\",\"CURRENCYCODE\":\"USD\",\"AMT\":\"65.00\",\"ITEMAMT\":\"40.00\",\"SHIPPINGAMT\":\"20.00\",\"HANDLINGAMT\":\"0.00\",\"TAXAMT\":\"5.00\",\"INSURANCEAMT\":\"0.00\",\"SHIPDISCAMT\":\"0.00\",\"INSURANCEOPTIONOFFERED\":\"false\",\"L_NAME0\":\"Apple MacBook Air 11.6 (2014) - I5\\/4GB RAM\\/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb ) (Original Price: $40.00)\",\"L_NUMBER0\":\"A1465_2gb500gb\",\"L_QTY0\":\"1\",\"L_TAXAMT0\":\"0.00\",\"L_AMT0\":\"40.00\",\"L_DESC0\":\"Apple MacBook Air 11.6 (2014) - I5\\/4GB RAM\\/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb )\\/A1465_2gb500gb\",\"PAYMENTREQUEST_0_CURRENCYCODE\":\"USD\",\"PAYMENTREQUEST_0_AMT\":\"65.00\",\"PAYMENTREQUEST_0_ITEMAMT\":\"40.00\",\"PAYMENTREQUEST_0_SHIPPINGAMT\":\"20.00\",\"PAYMENTREQUEST_0_HANDLINGAMT\":\"0.00\",\"PAYMENTREQUEST_0_TAXAMT\":\"5.00\",\"PAYMENTREQUEST_0_INSURANCEAMT\":\"0.00\",\"PAYMENTREQUEST_0_SHIPDISCAMT\":\"0.00\",\"PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID\":\"waqaskhanbhattipaypalbusiness@gmail.com\",\"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED\":\"false\",\"PAYMENTREQUEST_0_SHIPTONAME\":\"waqas khan\",\"PAYMENTREQUEST_0_SHIPTOSTREET\":\"Free Trade Zone\",\"PAYMENTREQUEST_0_SHIPTOCITY\":\"Dubai\",\"PAYMENTREQUEST_0_SHIPTOZIP\":\"971\",\"PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE\":\"AE\",\"PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME\":\"United Arab Emirates\",\"PAYMENTREQUEST_0_ADDRESSSTATUS\":\"Confirmed\",\"L_PAYMENTREQUEST_0_NAME0\":\"Apple MacBook Air 11.6 (2014) - I5\\/4GB RAM\\/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb ) (Original Price: $40.00)\",\"L_PAYMENTREQUEST_0_NUMBER0\":\"A1465_2gb500gb\",\"L_PAYMENTREQUEST_0_QTY0\":\"1\",\"L_PAYMENTREQUEST_0_TAXAMT0\":\"0.00\",\"L_PAYMENTREQUEST_0_AMT0\":\"40.00\",\"L_PAYMENTREQUEST_0_DESC0\":\"Apple MacBook Air 11.6 (2014) - I5\\/4GB RAM\\/250GB SSD Laptop *Used** (Ram:2gb Hard-drive:500gb )\\/A1465_2gb500gb\",\"PAYMENTREQUESTINFO_0_ERRORCODE\":\"0\"}', '2022-01-28 01:06:07'),
(48, 79, 'DoExpressCheckoutPayment', '{\"TOKEN\":\"EC-8T340430YK706060G\",\"SUCCESSPAGEREDIRECTREQUESTED\":\"false\",\"TIMESTAMP\":\"2022-01-28T06:06:10Z\",\"CORRELATIONID\":\"b710096818dd8\",\"ACK\":\"Success\",\"VERSION\":\"124.0\",\"BUILD\":\"56144363\",\"TRANSACTIONID\":\"77M18214U5003830V\",\"TRANSACTIONTYPE\":\"expresscheckout\",\"PAYMENTTYPE\":\"instant\",\"ORDERTIME\":\"2022-01-28T06:06:09Z\",\"AMT\":\"65.00\",\"FEEAMT\":\"3.73\",\"TAXAMT\":\"0.00\",\"CURRENCYCODE\":\"USD\",\"PAYMENTSTATUS\":\"Completed\",\"PENDINGREASON\":\"None\",\"REASONCODE\":\"None\",\"PROTECTIONELIGIBILITY\":\"Eligible\",\"INSURANCEOPTIONSELECTED\":\"false\",\"SHIPPINGOPTIONISDEFAULT\":\"false\",\"PAYMENTINFO_0_TRANSACTIONID\":\"77M18214U5003830V\",\"PAYMENTINFO_0_TRANSACTIONTYPE\":\"expresscheckout\",\"PAYMENTINFO_0_PAYMENTTYPE\":\"instant\",\"PAYMENTINFO_0_ORDERTIME\":\"2022-01-28T06:06:09Z\",\"PAYMENTINFO_0_AMT\":\"65.00\",\"PAYMENTINFO_0_FEEAMT\":\"3.73\",\"PAYMENTINFO_0_TAXAMT\":\"0.00\",\"PAYMENTINFO_0_CURRENCYCODE\":\"USD\",\"PAYMENTINFO_0_EXCHANGERATE\":\"0.266575529733424\",\"PAYMENTINFO_0_PAYMENTSTATUS\":\"Completed\",\"PAYMENTINFO_0_PENDINGREASON\":\"None\",\"PAYMENTINFO_0_REASONCODE\":\"None\",\"PAYMENTINFO_0_PROTECTIONELIGIBILITY\":\"Eligible\",\"PAYMENTINFO_0_PROTECTIONELIGIBILITYTYPE\":\"ItemNotReceivedEligible,UnauthorizedPaymentEligible\",\"PAYMENTINFO_0_SELLERPAYPALACCOUNTID\":\"waqaskhanbhattipaypalbusiness@gmail.com\",\"PAYMENTINFO_0_SECUREMERCHANTACCOUNTID\":\"XXQP2MQAQWGS8\",\"PAYMENTINFO_0_ERRORCODE\":\"0\",\"PAYMENTINFO_0_ACK\":\"Success\"}', '2022-01-28 01:06:11');

-- --------------------------------------------------------

--
-- Table structure for table `ci_products`
--

CREATE TABLE `ci_products` (
  `product_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `brand_name` varchar(200) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `long_description` text DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `length` varchar(10) DEFAULT NULL,
  `width` varchar(10) DEFAULT NULL,
  `product_unit` varchar(20) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `weight_unit` varchar(20) DEFAULT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `tax_class_id` int(11) NOT NULL DEFAULT 1,
  `keywords` varchar(255) DEFAULT NULL,
  `barcode` varchar(50) DEFAULT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `display_model_number` varchar(50) DEFAULT NULL,
  `country_of_origin` varchar(150) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `is_shippable` tinyint(1) DEFAULT 1,
  `views` int(11) DEFAULT NULL,
  `option_name` text NOT NULL,
  `option_value` text NOT NULL,
  `return_warrenty` varchar(255) NOT NULL,
  `manufacturing_defect_warrenty` varchar(255) NOT NULL,
  `courtesy_warranty` varchar(255) NOT NULL,
  `is_local` int(11) DEFAULT 0,
  `is_enabled` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_products`
--

INSERT INTO `ci_products` (`product_id`, `brand_id`, `brand_name`, `product_name`, `sku`, `short_description`, `long_description`, `height`, `length`, `width`, `product_unit`, `weight`, `weight_unit`, `sale_price`, `tax_class_id`, `keywords`, `barcode`, `quantity`, `display_model_number`, `country_of_origin`, `meta_title`, `meta_description`, `meta_keywords`, `is_shippable`, `views`, `option_name`, `option_value`, `return_warrenty`, `manufacturing_defect_warrenty`, `courtesy_warranty`, `is_local`, `is_enabled`, `is_deleted`, `date_added`, `date_modified`) VALUES
(1, 1, NULL, 'ACER NITRO 5 GAMING Laptop i5-8GB-500GB SDD ***BLOWOUT OFFER***', 'AN515-51522L', '<p><em><strong>Brand</strong></em> ACER NITRO 5 Operating System Windows 10 CPU Intel Screen size 14.1 Inches RAM 8 GB About this item: Intel Core i5(7th) 2.40GHz 500 GB Solid State Drive 8GB DDR3 RAM Windows 10 Professional 64Bit nvidia getforce gtx1050 Off Lease item 30 Days Warranty *** 30 DAY WARRANTY ***</p>', '<p><strong>Brand</strong> ACER NITRO 5 Operating System Windows 10 CPU Intel Screen size 14.1 Inches RAM 8 GB About this item: Intel Core i5(7th) 2.40GHz 500 GB Solid State Drive 8GB DDR3 RAM Windows 10 Professional 64Bit nvidia getforce gtx1050 Off Lease item 30 Days Warranty *** 30 DAY WARRANTY ***</p>', '', '', '', '', '', '', '999.99', 4, NULL, 'AN515-51522L', '43', NULL, NULL, 'ACER NITRO 5 GAMING Laptop', 'ACER NITRO 5 GAMING Laptop', 'ACER NITRO 5 GAMING Laptop', 1, 22, '', '', '', '', '', 1, 1, 0, '2022-01-24 06:43:55', '2022-01-24 06:43:55'),
(2, 2, NULL, ' Samsung Galaxy A21 32GB Unlocked Cell Phone *Open Box*', 'SM-A21SU', '<p>Charge Up. Power Through: Spend more time scrolling, texting and sharing, and less time looking for an outlet to charge your mobile phone; Its long-lasting battery has the power to keep up with you A Lens for Your Favorite Angle: Capture shareable cell phone portraits, wide shots and videos with the Samsung Galaxy A21’s versatile, 16MP triple-lens camera Big Screen to Get More Done: Keep in touch with friends, family and the news with plenty of room on a crystal-clear, 6.5\" edge-to-edge display screen Store More: Keep all your photos and apps on your Android smart phone without worrying about storage; Get up to 512GB of storage with a MicroSD card (sold separately) Wireless voice, data and messaging services compatible with most major U.S. GSM and CDMA networks; Support for certain features and services such as VoWiFi and hot spot, vary by wireless service provider</p>', '<p>Wireless Carrier Unlocked for All Carriers Brand Samsung Color Black/RED/BLUE Memory Storage 32 GB OS Android 10.0 Screen Size 6.5 Inches About this item Charge Up. Power Through: Spend more time scrolling, texting and sharing, and less time looking for an outlet to charge your mobile phone; Its long-lasting battery has the power to keep up with you A Lens for Your Favorite Angle: Capture shareable cell phone portraits, wide shots and videos with the Samsung Galaxy A21’s versatile, 16MP triple-lens camera Big Screen to Get More Done: Keep in touch with friends, family and the news with plenty of room on a crystal-clear, 6.5\" edge-to-edge display screen Store More: Keep all your photos and apps on your Android smart phone without worrying about storage; Get up to 512GB of storage with a MicroSD card (sold separately) Wireless voice, data and messaging services compatible with most major U.S. GSM and CDMA networks; Support for certain features and services such as VoWiFi and hot spot, vary by wireless service provider</p>', '', '', '', '', '', '', '299.99', 4, NULL, 'SM-A21SU', '2', NULL, NULL, ' Samsung Galaxy A21 32GB Unlocked Cell Phone *Open Box*', ' Samsung Galaxy A21 32GB Unlocked Cell Phone *Open Box*', ' Samsung Galaxy A21 32GB Unlocked Cell Phone *Open Box*', 1, 8, '', '', '', '', '', 1, 1, 0, '2022-01-25 05:49:09', '2022-01-25 05:49:09'),
(3, 3, NULL, 'Apple iPhone SE 2020 64GB Unlocked (A Grade) **Open Box - Like New**', 'iPhone SE 64GB', 'Apple iPhone SE 2020 64GB Unlocked (A Grade)\r\n* Open Box - Like New * 30 Day Store Warranty (Also Comes With Partial Apple Warranty) *\r\n\r\nReleased: April 2020\r\n\r\nDisplay Size & Type: 4.7\" Retina Display with True-Tone', 'Apple iPhone SE 2020 64GB Unlocked (A Grade)\r\n* Open Box - Like New * 30 Day Store Warranty (Also Comes With Partial Apple Warranty) *\r\n\r\nReleased: April 2020\r\n\r\nDisplay Size & Type: 4.7\" Retina Display with True-Tone\r\n\r\nResolution: 750 x 1344 Pixels\r\n\r\nOS: iOS 13 (Software Updates Available)\r\n\r\nChipset: Apple A13 Bionic (7 nm+) \r\n\r\nCPU: Hexa-core (2x2.65 GHz Lightning + 4x1.8 GHz Thunder)\r\n\r\nGPU: Apple GPU (4-core graphics)\r\n\r\nBattery: Non-Removable Li-ion 1,821mAh Battery \r\n\r\nFingerprint: Yes\r\n\r\nNFC: Yes\r\n\r\nFront Camera: Single Camera 7MP\r\n\r\nRear Camera: Single Camera 12MP (Wide)\r\n\r\nHDR: Yes\r\n\r\nMemory: 64GB Internal\r\n\r\nRam: 3GB\r\n\r\nCharging Fast charging 18W, 50% in 30 min (advertised)\r\nQi wireless charging\r\nIP67 Rated Water Resistant', '', '', '', '', '', '', '539.99', 1, NULL, 'iPhone SE 64GB', '3', NULL, NULL, 'Apple iPhone SE 2020 64GB Unlocked (A Grade) **Open Box - Like New**', 'Apple iPhone SE 2020 64GB Unlocked (A Grade) **Open Box - Like New**', 'Apple iPhone SE 2020 64GB Unlocked (A Grade) **Open Box - Like New**', 1, 6, '', '', '', '', '', 1, 1, 0, '2021-12-31 12:43:02', '2021-12-31 12:43:02'),
(4, 3, NULL, 'Apple MacBook Air 11.6 (2014) - I5/4GB RAM/250GB SSD Laptop *Used**', 'A1465', '<p>Apple MacBook Air 11.6./5\" (2014) * 30 Day Warranty * Off-Lease (A-Grade) *</p>', '<p>Apple MacBook Air 11.6./5\" (2014) * 30 Day Warranty * Off-Lease (A-Grade) * Condition: Used Brand: Apple Size / Dimensions: 11.6\" -------------------------------------------------- **Laptop Comes with Store Warranty** -------------------------------------------------- --&gt; PROCESSOR: INTEL CORE i5 - Dual-Core 1.40GHz --&gt; RAM: 4GB (Expandable) --&gt; HARD DRIVE: 250GB S.S.D (Expandable) --&gt; OS: macOS Big Sur (Version 11.1) --&gt; Screen Size: 11.6\" Display --&gt; Resolution: 1366 x 768 Pixels --&gt; Graphics: Intel HD Graphics 5000 1536MB --------------------------------------------------- (RAM AND SSD OR HARD DRIVE EXPANSION AVAILABLE)</p>', '', '', '', '1', '', '', '549.99', 1, NULL, 'A1465', '50', NULL, NULL, 'Apple MacBook Air 11.6&amp;amp;amp;quot; (2014)', 'Apple MacBook Air 11.6\" (2014)', 'Apple MacBook Air 11.6\" (2014)', 1, 86, '[\"Ram\",\"Hard drive\"]', '[\"2gb,4gb\",\"250gb,500gb\"]', '', '', '', 1, 1, 0, '2022-01-05 16:26:40', '2022-01-05 16:26:40'),
(5, 3, NULL, 'test product 2', '32424', '<p>sdf</p>', '<p>sdfsdf</p>', '', '', '', '', '', '', '345.00', 1, NULL, '324', '32434', NULL, NULL, '', '', '', 1, NULL, '', '', '', '', '', 1, 1, 0, '2022-01-05 16:22:39', '2022-01-05 16:22:39'),
(6, 3, NULL, 'test product 3', '66666', '<p>sdfds sdf </p>', '<p>sdf sd fsdf</p>', '', '', '', '', '', '', '400.00', 1, NULL, '66666', '19', NULL, NULL, '', '', '', 1, 2, '', '', '', '', '', 1, 1, 0, '2022-01-05 16:23:33', '2022-01-05 16:23:33'),
(7, 1, NULL, 'test product', 'ttt12345', '<p>tees</p>', '', '', '', '', '', '', '', '56.00', 4, NULL, 'eewe', '5', NULL, NULL, '', '', '', 1, NULL, '', '', '', '', '', 1, 1, 0, '2022-01-24 06:50:13', '2022-01-24 06:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `ci_product_categories`
--

CREATE TABLE `ci_product_categories` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_product_categories`
--

INSERT INTO `ci_product_categories` (`product_id`, `category_id`) VALUES
(1, 7),
(2, 8),
(3, 8),
(4, 4),
(4, 8),
(5, 2),
(6, 8),
(6, 10),
(7, 1),
(7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ci_product_edit_log`
--

CREATE TABLE `ci_product_edit_log` (
  `id` int(11) NOT NULL,
  `admin_user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `admin_data` text DEFAULT NULL COMMENT 'json encoded',
  `product_data` text DEFAULT NULL COMMENT 'json encoded',
  `modification_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_product_images`
--

CREATE TABLE `ci_product_images` (
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_product_images`
--

INSERT INTO `ci_product_images` (`product_id`, `image`) VALUES
(3, '47332677a9813317dc02133dc504ab0b.jpg'),
(5, 'd09f2ff7596a874d157195164a2177d4.jpg'),
(6, '201c1b24089dda92e5e393625b9a229c.jpg'),
(4, '1424047630f841ab7fd7437ca3cba17b.jpg'),
(4, '73894f88fc09a6db00d5d0dbe0035b0b.jpg'),
(1, '6bae28594fd14cb29508ab0ef018502d.jpg'),
(1, '5607bb0f8fb1548a8619a985099570f6.jpg'),
(1, 'daa9c82065cd808197f911d3e551cf87.jpg'),
(2, '5038e7d40ccdf5789d5b348945547a3b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ci_product_option_filter`
--

CREATE TABLE `ci_product_option_filter` (
  `product_option_filter_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `filter_key` varchar(255) DEFAULT NULL,
  `filter_value` varchar(255) DEFAULT NULL,
  `is_specification` tinyint(1) NOT NULL DEFAULT 0,
  `is_filter` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_product_option_filter`
--

INSERT INTO `ci_product_option_filter` (`product_option_filter_id`, `product_id`, `filter_key`, `filter_value`, `is_specification`, `is_filter`) VALUES
(20, 4, 'Hard drive', '500gb', 0, 1),
(19, 4, 'Hard drive', '250gb', 0, 1),
(18, 4, 'Ram', '4gb', 0, 1),
(17, 4, 'Ram', '2gb', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_product_option_value`
--

CREATE TABLE `ci_product_option_value` (
  `product_option_value_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(3) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `price_prefix` varchar(1) NOT NULL,
  `combination` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_product_option_value`
--

INSERT INTO `ci_product_option_value` (`product_option_value_id`, `product_id`, `quantity`, `price`, `price_prefix`, `combination`, `image`, `sku`) VALUES
(14, 4, 20, '40.00', '', '{\"Ram\":\"2gb\",\"Hard-drive\":\"500gb\"}', NULL, 'A1465_2gb500gb'),
(15, 4, 0, '20.00', '', '{\"Ram\":\"2gb\",\"Hard-drive\":\"250gb\"}', NULL, 'A1465_2gb250gb'),
(16, 4, 40, '60.00', '', '{\"Ram\":\"4gb\",\"Hard-drive\":\"250gb\"}', NULL, 'A1465_4gb250gb'),
(13, 4, 50, '80.00', '', '{\"Ram\":\"4gb\",\"Hard-drive\":\"500gb\"}', NULL, 'A1465_4gb500gb');

-- --------------------------------------------------------

--
-- Table structure for table `ci_product_special_price`
--

CREATE TABLE `ci_product_special_price` (
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_product_special_price`
--

INSERT INTO `ci_product_special_price` (`product_id`, `price`, `start_date`, `end_date`) VALUES
(3, '419.99', '2021-12-31', '2022-04-21'),
(4, '449.99', '2022-01-03', '2022-05-31'),
(1, '799.99', '2021-12-30', '2022-01-05'),
(2, '200.00', '2022-01-23', '2022-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `ci_related_products`
--

CREATE TABLE `ci_related_products` (
  `product_id` int(11) NOT NULL,
  `related_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_roles`
--

CREATE TABLE `ci_roles` (
  `role_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `enabled` tinyint(1) DEFAULT 1,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_roles`
--

INSERT INTO `ci_roles` (`role_id`, `name`, `enabled`, `date_added`, `date_modified`) VALUES
(1, 'Admin', 1, '2021-10-27 07:05:06', '0000-00-00 00:00:00'),
(2, 'Manager', 1, '2021-10-27 07:05:20', '0000-00-00 00:00:00'),
(4, 'Supervisor', 1, '2021-10-28 01:44:14', '2021-10-28 18:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `ci_role_permissions`
--

CREATE TABLE `ci_role_permissions` (
  `role_permission_id` int(11) UNSIGNED NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL,
  `acl_action_id` int(11) UNSIGNED NOT NULL,
  `view` int(10) NOT NULL,
  `add` int(10) NOT NULL,
  `edit` int(10) NOT NULL,
  `delete` int(10) NOT NULL,
  `acl_module_id` int(11) UNSIGNED NOT NULL,
  `acl_category_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_role_permissions`
--

INSERT INTO `ci_role_permissions` (`role_permission_id`, `role_id`, `acl_action_id`, `view`, `add`, `edit`, `delete`, `acl_module_id`, `acl_category_id`) VALUES
(38, 4, 1, 1, 1, 0, 0, 1, 1),
(39, 4, 3, 1, 1, 0, 0, 3, 2),
(40, 4, 4, 1, 1, 0, 0, 4, 3),
(41, 2, 1, 1, 0, 0, 0, 1, 1),
(42, 2, 4, 1, 0, 0, 0, 4, 3),
(51, 10, 1, 1, 0, 0, 0, 1, 1),
(52, 10, 2, 1, 0, 0, 0, 2, 1),
(53, 10, 3, 1, 0, 0, 0, 3, 2),
(54, 10, 4, 1, 0, 0, 0, 4, 3),
(95, 1, 5, 1, 1, 1, 1, 5, 4),
(96, 1, 6, 1, 1, 1, 1, 6, 4),
(97, 1, 7, 1, 1, 1, 1, 7, 4),
(98, 1, 4, 1, 1, 1, 1, 4, 3),
(99, 1, 3, 1, 1, 1, 0, 3, 2),
(100, 1, 1, 1, 1, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_routes`
--

CREATE TABLE `ci_routes` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `route` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_routes`
--

INSERT INTO `ci_routes` (`id`, `slug`, `route`) VALUES
(1, 'privacy-policy', 'User_page/index/1'),
(2, 'about-us', 'User_page/index/2'),
(3, 'free-shipping', 'User_page/index/3');

-- --------------------------------------------------------

--
-- Table structure for table `ci_search`
--

CREATE TABLE `ci_search` (
  `code` varchar(40) NOT NULL,
  `term` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_search_a`
--

CREATE TABLE `ci_search_a` (
  `code` varchar(40) NOT NULL,
  `term` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_search_a`
--

INSERT INTO `ci_search_a` (`code`, `term`) VALUES
('7585864edbdc7cbe30af19094bfc9fb6', '{\"term\":\"b\"}'),
('8481a31f51401ba2b11c558c397d355e', '{\"term\":\"asad\"}');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) CHARACTER SET latin1 NOT NULL,
  `ip_address` varchar(45) CHARACTER SET latin1 NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` longblob NOT NULL,
  `user_data` longtext CHARACTER SET latin1 DEFAULT NULL,
  `auto_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions_a`
--

CREATE TABLE `ci_sessions_a` (
  `id` varchar(128) CHARACTER SET latin1 NOT NULL,
  `ip_address` varchar(45) CHARACTER SET latin1 NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` longblob NOT NULL,
  `auto_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_sessions_a`
--

INSERT INTO `ci_sessions_a` (`id`, `ip_address`, `timestamp`, `data`, `auto_date`) VALUES
('1sg4lm156h1ru56sho29lol9lp7mpp59', '::1', 1643951386, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333935313338363b61646d696e7c613a393a7b733a323a226964223b733a313a2231223b733a31333a2261646d696e5f757365725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a383a224261736861726174223b733a393a226c6173745f6e616d65223b733a333a22416c69223b733a353a22656d61696c223b733a32343a226261736861726174616c693540686f746d61696c2e636f6d223b733a31333a2261646d696e5f726f6c655f6964223b733a313a2231223b733a353a2269735f7361223b733a313a2231223b733a31323a2263756c747572655f636f6465223b733a353a22656e2d5553223b733a363a22657870697265223b693a313634333936353334353b7d6d6573736167657c733a35323a22466c6174207368697070696e672073657474696e67732068617665206265656e207361766564207375636365737366756c6c7921223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d, '2022-02-04 05:02:13'),
('9c3heoikcmgabb9n9pdkuv7i7k8qnl8e', '::1', 1643949977, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333934393937373b61646d696e7c613a393a7b733a323a226964223b733a313a2231223b733a31333a2261646d696e5f757365725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a383a224261736861726174223b733a393a226c6173745f6e616d65223b733a333a22416c69223b733a353a22656d61696c223b733a32343a226261736861726174616c693540686f746d61696c2e636f6d223b733a31333a2261646d696e5f726f6c655f6964223b733a313a2231223b733a353a2269735f7361223b733a313a2231223b733a31323a2263756c747572655f636f6465223b733a353a22656e2d5553223b733a363a22657870697265223b693a313634333936343138363b7d, '2022-02-04 04:40:28'),
('bma57vanavilgivr06a13juadgba1dgn', '::1', 1643954631, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333935343633313b61646d696e7c613a393a7b733a323a226964223b733a313a2231223b733a31333a2261646d696e5f757365725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a383a224261736861726174223b733a393a226c6173745f6e616d65223b733a333a22416c69223b733a353a22656d61696c223b733a32343a226261736861726174616c693540686f746d61696c2e636f6d223b733a31333a2261646d696e5f726f6c655f6964223b733a313a2231223b733a353a2269735f7361223b733a313a2231223b733a31323a2263756c747572655f636f6465223b733a353a22656e2d5553223b733a363a22657870697265223b693a313634333936353738363b7d, '2022-02-04 05:09:46'),
('bs6i64tqdflim803n8f0ru6d23mgdp58', '::1', 1643949628, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333934393632383b, '2022-02-04 04:20:47'),
('eq30io379l619qjd9j5j4gfr3ki9f4la', '::1', 1643955112, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333935353131323b61646d696e7c613a393a7b733a323a226964223b733a313a2231223b733a31333a2261646d696e5f757365725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a383a224261736861726174223b733a393a226c6173745f6e616d65223b733a333a22416c69223b733a353a22656d61696c223b733a32343a226261736861726174616c693540686f746d61696c2e636f6d223b733a31333a2261646d696e5f726f6c655f6964223b733a313a2231223b733a353a2269735f7361223b733a313a2231223b733a31323a2263756c747572655f636f6465223b733a353a22656e2d5553223b733a363a22657870697265223b693a313634333936393035393b7d, '2022-02-04 06:03:52'),
('ivte4ua85n5tv11v2jm3c9j76a934q2g', '::1', 1643957652, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333935373635323b61646d696e7c613a393a7b733a323a226964223b733a313a2231223b733a31333a2261646d696e5f757365725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a383a224261736861726174223b733a393a226c6173745f6e616d65223b733a333a22416c69223b733a353a22656d61696c223b733a32343a226261736861726174616c693540686f746d61696c2e636f6d223b733a31333a2261646d696e5f726f6c655f6964223b733a313a2231223b733a353a2269735f7361223b733a313a2231223b733a31323a2263756c747572655f636f6465223b733a353a22656e2d5553223b733a363a22657870697265223b693a313634333937323035323b7d, '2022-02-04 06:54:12'),
('mphkcko7bke563l2qu1g52pfo7j38kq7', '::1', 1643950933, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333935303933333b61646d696e7c613a393a7b733a323a226964223b733a313a2231223b733a31333a2261646d696e5f757365725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a383a224261736861726174223b733a393a226c6173745f6e616d65223b733a333a22416c69223b733a353a22656d61696c223b733a32343a226261736861726174616c693540686f746d61696c2e636f6d223b733a31333a2261646d696e5f726f6c655f6964223b733a313a2231223b733a353a2269735f7361223b733a313a2231223b733a31323a2263756c747572655f636f6465223b733a353a22656e2d5553223b733a363a22657870697265223b693a313634333936343636303b7d6d6573736167657c733a32343a22546178205261746520686173206265656e2073617665642e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d, '2022-02-04 04:46:17'),
('uh64qcnovovppi82q2f3qjbmo5s15oh5', '::1', 1643957652, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333935373635323b61646d696e7c613a393a7b733a323a226964223b733a313a2231223b733a31333a2261646d696e5f757365725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a383a224261736861726174223b733a393a226c6173745f6e616d65223b733a333a22416c69223b733a353a22656d61696c223b733a32343a226261736861726174616c693540686f746d61696c2e636f6d223b733a31333a2261646d696e5f726f6c655f6964223b733a313a2231223b733a353a2269735f7361223b733a313a2231223b733a31323a2263756c747572655f636f6465223b733a353a22656e2d5553223b733a363a22657870697265223b693a313634333936393531323b7d, '2022-02-04 06:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions_u`
--

CREATE TABLE `ci_sessions_u` (
  `id` varchar(128) CHARACTER SET latin1 NOT NULL,
  `ip_address` varchar(45) CHARACTER SET latin1 NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` longblob NOT NULL,
  `auto_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_sessions_u`
--

INSERT INTO `ci_sessions_u` (`id`, `ip_address`, `timestamp`, `data`, `auto_date`) VALUES
('0lsi4hhonrrc7edrvin4b8ddf55albqr', '127.0.0.1', 1643949561, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333934393536303b, '2022-02-04 04:39:21'),
('0lsi4hhonrrc7edrvin4b8ddf55albqr', '::1', 1643950325, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333935303332353b636172747c613a323a7b733a31323a22414e3531352d35313532324c223b613a373a7b733a31303a2270726f647563745f6964223b693a313b733a383a227175616e74697479223b733a313a2231223b733a353a227072696365223b733a363a223939392e3939223b733a373a226f7074696f6e73223b613a303a7b7d733a31333a22617661696c61626c655f717479223b693a34333b733a31323a227461785f636c6173735f6964223b733a313a2234223b733a333a22736b75223b733a31323a22414e3531352d35313532324c223b7d733a31343a2241313436355f3267623530306762223b613a373a7b733a31303a2270726f647563745f6964223b693a343b733a383a227175616e74697479223b733a313a2232223b733a353a227072696365223b733a353a2234302e3030223b733a373a226f7074696f6e73223b613a333a7b733a333a2252616d223b733a333a22326762223b733a31303a22486172642d6472697665223b733a353a223530306762223b733a32333a2270726f647563745f6f7074696f6e5f76616c75655f6964223b733a323a223134223b7d733a31333a22617661696c61626c655f717479223b693a32303b733a31323a227461785f636c6173735f6964223b733a313a2231223b733a333a22736b75223b733a31343a2241313436355f3267623530306762223b7d7d757365727c613a383a7b733a323a226964223b733a313a2231223b733a31313a22637573746f6d65725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a363a224661697a616e223b733a393a226c6173745f6e616d65223b733a363a22526173686964223b733a353a22656d61696c223b733a32373a226661697a616e2e72617368696440616476616e746563682e636f6d223b733a343a2263656c6c223b733a31323a22303035343634363436343536223b733a31323a22757365725f726f6c655f6964223b733a313a2230223b733a363a22657870697265223b693a313634333936343239373b7d636865636b6f75747c613a343a7b733a31353a2262696c6c696e675f61646472657373223b733a313a2231223b733a31363a227368697070696e675f61646472657373223b733a313a2231223b733a31353a227368697070696e675f6d6574686f64223b733a343a2266726565223b733a31343a227061796d656e745f6d6574686f64223b733a333a22636f64223b7d, '2022-02-04 04:39:59'),
('1gsdubf8svp75cup6t7r182qab50ltqg', '::1', 1643694545, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333639343534353b, '2022-02-01 05:36:06'),
('1p3phtjhrbgka988i346754kb1bda4kv', '::1', 1643348700, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333334383730303b, '2022-01-28 05:19:48'),
('2419kkfbsupct0p6934gm56mbtrbc3lh', '::1', 1643263886, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333236333838353b, '2022-01-27 04:30:20'),
('290jc734pna62io0dbrckbmiobmoen7q', '::1', 1643697413, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333639373336343b, '2022-02-01 06:36:04'),
('2hf2v5u9i6bm1t059t27fo0kio09mmum', '::1', 1643003949, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333030333934393b, '2022-01-24 04:44:18'),
('2ri65mkqod37bc3vbrlmf9nuca3kajpq', '::1', 1643693766, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333639333736363b, '2022-02-01 05:19:07'),
('3n86t15e7ill0r2h1djp8hcgk7utnbi6', '::1', 1643690578, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333639303537383b, '2022-02-01 04:30:43'),
('60gvc07679q3fmgji0ulrf69rrvlhqf5', '::1', 1643085899, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333038353839393b636172747c613a313a7b733a31343a2241313436355f3467623530306762223b613a373a7b733a31303a2270726f647563745f6964223b693a343b733a383a227175616e74697479223b733a313a2231223b733a353a227072696365223b733a353a2238302e3030223b733a373a226f7074696f6e73223b613a333a7b733a333a2252616d223b733a333a22346762223b733a31303a22486172642d6472697665223b733a353a223530306762223b733a32333a2270726f647563745f6f7074696f6e5f76616c75655f6964223b733a323a223133223b7d733a31333a22617661696c61626c655f717479223b693a35303b733a31323a227461785f636c6173735f6964223b733a313a2231223b733a333a22736b75223b733a31343a2241313436355f3467623530306762223b7d7d757365727c613a383a7b733a323a226964223b733a313a2231223b733a31313a22637573746f6d65725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a363a224661697a616e223b733a393a226c6173745f6e616d65223b733a363a22526173686964223b733a353a22656d61696c223b733a32373a226661697a616e2e72617368696440616476616e746563682e636f6d223b733a343a2263656c6c223b733a31323a22303035343634363436343536223b733a31323a22757365725f726f6c655f6964223b733a313a2230223b733a363a22657870697265223b693a313634333039393939363b7d636865636b6f75747c613a343a7b733a31353a2262696c6c696e675f61646472657373223b733a313a2231223b733a31363a227368697070696e675f61646472657373223b733a313a2231223b733a31353a227368697070696e675f6d6574686f64223b733a343a22666c6174223b733a31343a227061796d656e745f6d6574686f64223b733a333a22636f64223b7d, '2022-01-25 04:37:03'),
('69t1m1373hek26ct4tbc2909sqk668vt', '::1', 1643006774, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333030363737343b636172747c613a313a7b733a31323a22414e3531352d35313532324c223b613a373a7b733a31303a2270726f647563745f6964223b693a313b733a383a227175616e74697479223b733a313a2231223b733a353a227072696365223b623a303b733a373a226f7074696f6e73223b613a303a7b7d733a31333a22617661696c61626c655f717479223b693a34343b733a31323a227461785f636c6173735f6964223b733a313a2234223b733a333a22736b75223b733a31323a22414e3531352d35313532324c223b7d7d, '2022-01-24 06:32:28'),
('6erfk9097n26p638llc8qpp18lleu2av', '::1', 1643004538, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333030343533383b636172747c613a313a7b733a31323a22414e3531352d35313532324c223b613a373a7b733a31303a2270726f647563745f6964223b693a313b733a383a227175616e74697479223b733a313a2231223b733a353a227072696365223b623a303b733a373a226f7074696f6e73223b613a303a7b7d733a31333a22617661696c61626c655f717479223b693a34343b733a31323a227461785f636c6173735f6964223b733a313a2234223b733a333a22736b75223b733a31323a22414e3531352d35313532324c223b7d7d6d6573736167657c733a3131303a2250726f6475637420616464656420746f20796f7572203c6120687265663d2268747470733a2f2f6c6f63616c686f73742f74656368726576616d702f636865636b6f75742f636172742e68746d6c223e73686f7070696e6720636172743c2f613e207375636365737366756c6c79223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d, '2022-01-24 05:59:10'),
('6vh1btg19lprncr2h8taobef5bac02ku', '::1', 1643350800, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333335303830303b757365727c613a383a7b733a323a226964223b733a313a2231223b733a31313a22637573746f6d65725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a363a224661697a616e223b733a393a226c6173745f6e616d65223b733a363a22526173686964223b733a353a22656d61696c223b733a32373a226661697a616e2e72617368696440616476616e746563682e636f6d223b733a343a2263656c6c223b733a31323a22303035343634363436343536223b733a31323a22757365725f726f6c655f6964223b733a313a2230223b733a363a22657870697265223b693a313634333336343832333b7d6e767072657161727261797c613a31313a7b733a363a224d4554484f44223b733a32343a22446f45787072657373436865636b6f75745061796d656e74223b733a373a2256455253494f4e223b733a353a223132342e30223b733a333a22505744223b733a31363a223452364e58514459565542485337464c223b733a343a2255534552223b733a33343a2277617161736b68616e6268617474695f617069312e64697374697a6f6e652e636f6d223b733a393a225349474e4154555245223b733a35363a2241345541304b54775851466e50312d5774364d5263545462474b4874414c496f495a7455384553464746624a516d6752344372427a433034223b733a353a22544f4b454e223b733a32303a2245432d3854333430343330594b37303630363047223b733a373a2250415945524944223b733a31333a22334b4857473235424c56513647223b733a31333a225041594d454e54414354494f4e223b733a343a2253616c65223b733a333a22414d54223b733a353a2236352e3030223b733a31323a2243555252454e4359434f4445223b733a333a22555344223b733a393a22495041444452455353223b733a393a226c6f63616c686f7374223b7d, '2022-01-28 06:13:38'),
('7d38ctlmv4rtdgbnremutj8bdvlov43o', '::1', 1643345815, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333334353831353b, '2022-01-28 04:51:41'),
('7e12qk8pea417j9kntru9bic3j14n4sk', '::1', 1643691182, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333639313138323b, '2022-02-01 04:42:58'),
('8icgovopf7qs7hmgnotduq1p8etplvia', '::1', 1643344989, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333334343938393b, '2022-01-28 04:35:07'),
('8tgp8qhlu18f0sstibfl1ve5qbmt256h', '::1', 1643005947, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333030353934373b636172747c613a313a7b733a31323a22414e3531352d35313532324c223b613a373a7b733a31303a2270726f647563745f6964223b693a313b733a383a227175616e74697479223b733a313a2231223b733a353a227072696365223b623a303b733a373a226f7074696f6e73223b613a303a7b7d733a31333a22617661696c61626c655f717479223b693a34343b733a31323a227461785f636c6173735f6964223b733a313a2234223b733a333a22736b75223b733a31323a22414e3531352d35313532324c223b7d7d, '2022-01-24 06:08:59'),
('9308iatdj0d2vvobrjc07cc0t6bg0gv0', '::1', 1643345501, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333334353530313b, '2022-01-28 04:43:09'),
('bda64tfnc3qvnnrm4er1qq5otia7u3ok', '::1', 1643257818, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333235373831383b, '2022-01-27 04:24:06'),
('cpl3emjk5fbmr3f9qdboit3ojhpmo1q5', '::1', 1643349003, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333334393030333b, '2022-01-28 05:45:01'),
('dr4difkt7k18au2hcp1hcg66m56ik9dn', '::1', 1643350418, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333335303431383b757365727c613a383a7b733a323a226964223b733a313a2231223b733a31313a22637573746f6d65725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a363a224661697a616e223b733a393a226c6173745f6e616d65223b733a363a22526173686964223b733a353a22656d61696c223b733a32373a226661697a616e2e72617368696440616476616e746563682e636f6d223b733a343a2263656c6c223b733a31323a22303035343634363436343536223b733a31323a22757365725f726f6c655f6964223b733a313a2230223b733a363a22657870697265223b693a313634333336343439303b7d6e767072657161727261797c613a31313a7b733a363a224d4554484f44223b733a32343a22446f45787072657373436865636b6f75745061796d656e74223b733a373a2256455253494f4e223b733a353a223132342e30223b733a333a22505744223b733a31363a223452364e58514459565542485337464c223b733a343a2255534552223b733a33343a2277617161736b68616e6268617474695f617069312e64697374697a6f6e652e636f6d223b733a393a225349474e4154555245223b733a35363a2241345541304b54775851466e50312d5774364d5263545462474b4874414c496f495a7455384553464746624a516d6752344372427a433034223b733a353a22544f4b454e223b733a32303a2245432d3854333430343330594b37303630363047223b733a373a2250415945524944223b733a31333a22334b4857473235424c56513647223b733a31333a225041594d454e54414354494f4e223b733a343a2253616c65223b733a333a22414d54223b733a353a2236352e3030223b733a31323a2243555252454e4359434f4445223b733a333a22555344223b733a393a22495041444452455353223b733a393a226c6f63616c686f7374223b7d, '2022-01-28 06:05:38'),
('f6aia95kp0h96ti9ar9a2visilfink8k', '::1', 1643264547, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333236343534373b, '2022-01-27 06:11:25'),
('f9me7f5b99d4od46ott7p0tidpf2otdn', '::1', 1643955554, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333935353535343b636172747c613a323a7b733a31323a22414e3531352d35313532324c223b613a373a7b733a31303a2270726f647563745f6964223b693a313b733a383a227175616e74697479223b733a313a2231223b733a353a227072696365223b733a363a223939392e3939223b733a373a226f7074696f6e73223b613a303a7b7d733a31333a22617661696c61626c655f717479223b693a34333b733a31323a227461785f636c6173735f6964223b733a313a2234223b733a333a22736b75223b733a31323a22414e3531352d35313532324c223b7d733a31343a2241313436355f3267623530306762223b613a373a7b733a31303a2270726f647563745f6964223b693a343b733a383a227175616e74697479223b733a313a2232223b733a353a227072696365223b733a353a2234302e3030223b733a373a226f7074696f6e73223b613a333a7b733a333a2252616d223b733a333a22326762223b733a31303a22486172642d6472697665223b733a353a223530306762223b733a32333a2270726f647563745f6f7074696f6e5f76616c75655f6964223b733a323a223134223b7d733a31333a22617661696c61626c655f717479223b693a32303b733a31323a227461785f636c6173735f6964223b733a313a2231223b733a333a22736b75223b733a31343a2241313436355f3267623530306762223b7d7d757365727c613a383a7b733a323a226964223b733a313a2231223b733a31313a22637573746f6d65725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a363a224661697a616e223b733a393a226c6173745f6e616d65223b733a363a22526173686964223b733a353a22656d61696c223b733a32373a226661697a616e2e72617368696440616476616e746563682e636f6d223b733a343a2263656c6c223b733a31323a22303035343634363436343536223b733a31323a22757365725f726f6c655f6964223b733a313a2230223b733a363a22657870697265223b693a313634333936343732353b7d636865636b6f75747c613a343a7b733a31353a2262696c6c696e675f61646472657373223b733a313a2235223b733a31363a227368697070696e675f61646472657373223b733a313a2231223b733a31353a227368697070696e675f6d6574686f64223b733a343a2266726565223b733a31343a227061796d656e745f6d6574686f64223b733a333a22636f64223b7d, '2022-02-04 04:52:05'),
('g2o9tltodeeo6fh2lg9qbd18chksueuc', '::1', 1643349628, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333334393632383b, '2022-01-28 05:50:03'),
('gf0ad2jkbmrtf7ag0njmk01begln6gjd', '::1', 1643692192, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333639323139323b, '2022-02-01 04:53:02'),
('gjtgobq03v32jkgcvhslvgn5jdnjkb85', '::1', 1643697364, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333639373336343b, '2022-02-01 05:49:05'),
('gk7ta4a40ljvp48iprgcflhlvitt8f6h', '::1', 1643088057, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333038383035373b636172747c613a313a7b733a383a22534d2d4132315355223b613a373a7b733a31303a2270726f647563745f6964223b693a323b733a383a227175616e74697479223b733a313a2231223b733a353a227072696365223b733a363a223230302e3030223b733a373a226f7074696f6e73223b613a303a7b7d733a31333a22617661696c61626c655f717479223b693a323b733a31323a227461785f636c6173735f6964223b733a313a2234223b733a333a22736b75223b733a383a22534d2d4132315355223b7d7d757365727c613a383a7b733a323a226964223b733a313a2231223b733a31313a22637573746f6d65725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a363a224661697a616e223b733a393a226c6173745f6e616d65223b733a363a22526173686964223b733a353a22656d61696c223b733a32373a226661697a616e2e72617368696440616476616e746563682e636f6d223b733a343a2263656c6c223b733a31323a22303035343634363436343536223b733a31323a22757365725f726f6c655f6964223b733a313a2230223b733a363a22657870697265223b693a313634333130303538313b7d, '2022-01-25 04:44:59'),
('gtncl4phomsfghpj6jaugcu5qv83oj1i', '::1', 1643008037, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333030383033373b636172747c613a303a7b7d, '2022-01-24 06:51:44'),
('h096q9g900ubujts8l2rt13rq5feeidu', '::1', 1643784451, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333738343435313b636172747c613a313a7b733a31323a22414e3531352d35313532324c223b613a373a7b733a31303a2270726f647563745f6964223b693a313b733a383a227175616e74697479223b733a313a2231223b733a353a227072696365223b733a363a223939392e3939223b733a373a226f7074696f6e73223b613a303a7b7d733a31333a22617661696c61626c655f717479223b693a34333b733a31323a227461785f636c6173735f6964223b733a313a2234223b733a333a22736b75223b733a31323a22414e3531352d35313532324c223b7d7d6d6573736167657c733a3131303a2250726f6475637420616464656420746f20796f7572203c6120687265663d2268747470733a2f2f6c6f63616c686f73742f74656368726576616d702f636865636b6f75742f636172742e68746d6c223e73686f7070696e6720636172743c2f613e207375636365737366756c6c79223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d, '2022-02-02 06:18:32'),
('ha7srj2tj1t2tmhgrntks6e8aqb16uas', '::1', 1643007104, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333030373130343b636172747c613a313a7b733a31323a22414e3531352d35313532324c223b613a373a7b733a31303a2270726f647563745f6964223b693a313b733a383a227175616e74697479223b733a313a2231223b733a353a227072696365223b623a303b733a373a226f7074696f6e73223b613a303a7b7d733a31333a22617661696c61626c655f717479223b693a34343b733a31323a227461785f636c6173735f6964223b733a313a2234223b733a333a22736b75223b733a31323a22414e3531352d35313532324c223b7d7d, '2022-01-24 06:46:14'),
('hpj1udajahp921guksmingtflg5dfhe1', '::1', 1643780447, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333738303434373b, '2022-02-02 05:18:09'),
('jkv25rndasfqo52gj1p5cq99t4oaef74', '::1', 1643784513, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333738343435313b636172747c613a323a7b733a31323a22414e3531352d35313532324c223b613a373a7b733a31303a2270726f647563745f6964223b693a313b733a383a227175616e74697479223b733a313a2231223b733a353a227072696365223b733a363a223939392e3939223b733a373a226f7074696f6e73223b613a303a7b7d733a31333a22617661696c61626c655f717479223b693a34333b733a31323a227461785f636c6173735f6964223b733a313a2234223b733a333a22736b75223b733a31323a22414e3531352d35313532324c223b7d733a31343a2241313436355f3267623530306762223b613a373a7b733a31303a2270726f647563745f6964223b693a343b733a383a227175616e74697479223b733a313a2231223b733a353a227072696365223b733a353a2234302e3030223b733a373a226f7074696f6e73223b613a333a7b733a333a2252616d223b733a333a22326762223b733a31303a22486172642d6472697665223b733a353a223530306762223b733a32333a2270726f647563745f6f7074696f6e5f76616c75655f6964223b733a323a223134223b7d733a31333a22617661696c61626c655f717479223b693a32303b733a31323a227461785f636c6173735f6964223b733a313a2231223b733a333a22736b75223b733a31343a2241313436355f3267623530306762223b7d7d6c6f67696e5f6572726f727c733a36323a22556e61626c6520746f20617574686f72697a65642c20706c6561736520636865636b20796f757220757365726e616d6520616e642070617373776f72642e223b5f5f63695f766172737c613a323a7b733a31313a226c6f67696e5f6572726f72223b733a333a226e6577223b733a353a226572726f72223b733a333a226e6577223b7d6572726f727c733a32373a22557365726e616d652f50617373776f7264206e6f742076616c6964223b, '2022-02-02 06:47:31'),
('k0fefla86idfi85vmda5eoothbgphdnm', '::1', 1643266988, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333236363734353b, '2022-01-27 06:59:05'),
('ldhvkjtcjmd0ktvl87cd3223u27i9dh5', '::1', 1643350800, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333335303830303b757365727c613a383a7b733a323a226964223b733a313a2231223b733a31313a22637573746f6d65725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a363a224661697a616e223b733a393a226c6173745f6e616d65223b733a363a22526173686964223b733a353a22656d61696c223b733a32373a226661697a616e2e72617368696440616476616e746563682e636f6d223b733a343a2263656c6c223b733a31323a22303035343634363436343536223b733a31323a22757365725f726f6c655f6964223b733a313a2230223b733a363a22657870697265223b693a313634333336353230303b7d6e767072657161727261797c613a31313a7b733a363a224d4554484f44223b733a32343a22446f45787072657373436865636b6f75745061796d656e74223b733a373a2256455253494f4e223b733a353a223132342e30223b733a333a22505744223b733a31363a223452364e58514459565542485337464c223b733a343a2255534552223b733a33343a2277617161736b68616e6268617474695f617069312e64697374697a6f6e652e636f6d223b733a393a225349474e4154555245223b733a35363a2241345541304b54775851466e50312d5774364d5263545462474b4874414c496f495a7455384553464746624a516d6752344372427a433034223b733a353a22544f4b454e223b733a32303a2245432d3854333430343330594b37303630363047223b733a373a2250415945524944223b733a31333a22334b4857473235424c56513647223b733a31333a225041594d454e54414354494f4e223b733a343a2253616c65223b733a333a22414d54223b733a353a2236352e3030223b733a31323a2243555252454e4359434f4445223b733a333a22555344223b733a393a22495041444452455353223b733a393a226c6f63616c686f7374223b7d, '2022-01-28 06:20:00'),
('o0q691c72lv20p8vef41lurb3o3tcnq8', '::1', 1643692747, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333639323734373b, '2022-02-01 05:09:52'),
('p1spjvb93tvr7vtlj0auucrrk3o053i4', '::1', 1643008338, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333030383333383b757365727c613a383a7b733a323a226964223b733a313a2231223b733a31313a22637573746f6d65725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a363a224661697a616e223b733a393a226c6173745f6e616d65223b733a363a22526173686964223b733a353a22656d61696c223b733a32373a226661697a616e2e72617368696440616476616e746563682e636f6d223b733a343a2263656c6c223b733a31323a22303035343634363436343536223b733a31323a22757365725f726f6c655f6964223b733a313a2230223b733a363a22657870697265223b693a313634333032323732333b7d6e767072657161727261797c613a31313a7b733a363a224d4554484f44223b733a32343a22446f45787072657373436865636b6f75745061796d656e74223b733a373a2256455253494f4e223b733a353a223132342e30223b733a333a22505744223b733a31363a223452364e58514459565542485337464c223b733a343a2255534552223b733a33343a2277617161736b68616e6268617474695f617069312e64697374697a6f6e652e636f6d223b733a393a225349474e4154555245223b733a35363a2241345541304b54775851466e50312d5774364d5263545462474b4874414c496f495a7455384553464746624a516d6752344372427a433034223b733a353a22544f4b454e223b733a32303a2245432d34584139373632304c4a3132353130344a223b733a373a2250415945524944223b733a31333a22334b4857473235424c56513647223b733a31333a225041594d454e54414354494f4e223b733a343a2253616c65223b733a333a22414d54223b733a373a22313035392e3939223b733a31323a2243555252454e4359434f4445223b733a333a22555344223b733a393a22495041444452455353223b733a393a226c6f63616c686f7374223b7d, '2022-01-24 07:07:17'),
('pqi9jgrjcv53p2l1a1npl1rf2d643le0', '::1', 1643093062, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039333034363b636172747c613a313a7b733a383a22534d2d4132315355223b613a373a7b733a31303a2270726f647563745f6964223b693a323b733a383a227175616e74697479223b733a313a2231223b733a353a227072696365223b733a363a223230302e3030223b733a373a226f7074696f6e73223b613a303a7b7d733a31333a22617661696c61626c655f717479223b693a323b733a31323a227461785f636c6173735f6964223b733a313a2234223b733a333a22736b75223b733a383a22534d2d4132315355223b7d7d757365727c613a383a7b733a323a226964223b733a313a2231223b733a31313a22637573746f6d65725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a363a224661697a616e223b733a393a226c6173745f6e616d65223b733a363a22526173686964223b733a353a22656d61696c223b733a32373a226661697a616e2e72617368696440616476616e746563682e636f6d223b733a343a2263656c6c223b733a31323a22303035343634363436343536223b733a31323a22757365725f726f6c655f6964223b733a313a2230223b733a363a22657870697265223b693a313634333130373435373b7d636865636b6f75747c613a343a7b733a31353a2262696c6c696e675f61646472657373223b733a313a2231223b733a31363a227368697070696e675f61646472657373223b733a313a2231223b733a31353a227368697070696e675f6d6574686f64223b733a343a22666c6174223b733a31343a227061796d656e745f6d6574686f64223b733a333a22636f64223b7d, '2022-01-25 06:44:07'),
('q0fjfrk9er9cfjaoufbtngnk8lb4ju6s', '::1', 1643955554, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333935353535343b636172747c613a323a7b733a31323a22414e3531352d35313532324c223b613a373a7b733a31303a2270726f647563745f6964223b693a313b733a383a227175616e74697479223b733a313a2231223b733a353a227072696365223b733a363a223939392e3939223b733a373a226f7074696f6e73223b613a303a7b7d733a31333a22617661696c61626c655f717479223b693a34333b733a31323a227461785f636c6173735f6964223b733a313a2234223b733a333a22736b75223b733a31323a22414e3531352d35313532324c223b7d733a31343a2241313436355f3267623530306762223b613a373a7b733a31303a2270726f647563745f6964223b693a343b733a383a227175616e74697479223b733a313a2232223b733a353a227072696365223b733a353a2234302e3030223b733a373a226f7074696f6e73223b613a333a7b733a333a2252616d223b733a333a22326762223b733a31303a22486172642d6472697665223b733a353a223530306762223b733a32333a2270726f647563745f6f7074696f6e5f76616c75655f6964223b733a323a223134223b7d733a31333a22617661696c61626c655f717479223b693a32303b733a31323a227461785f636c6173735f6964223b733a313a2231223b733a333a22736b75223b733a31343a2241313436355f3267623530306762223b7d7d757365727c613a383a7b733a323a226964223b733a313a2231223b733a31313a22637573746f6d65725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a363a224661697a616e223b733a393a226c6173745f6e616d65223b733a363a22526173686964223b733a353a22656d61696c223b733a32373a226661697a616e2e72617368696440616476616e746563682e636f6d223b733a343a2263656c6c223b733a31323a22303035343634363436343536223b733a31323a22757365725f726f6c655f6964223b733a313a2230223b733a363a22657870697265223b693a313634333936393935343b7d636865636b6f75747c613a343a7b733a31353a2262696c6c696e675f61646472657373223b733a313a2235223b733a31363a227368697070696e675f61646472657373223b733a313a2231223b733a31353a227368697070696e675f6d6574686f64223b733a343a2266726565223b733a31343a227061796d656e745f6d6574686f64223b733a333a22636f64223b7d, '2022-02-04 06:19:14'),
('q9kbujmcl8hop94r3gg9mdo1i9m8jkm3', '::1', 1643093046, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333039333034363b636172747c613a313a7b733a383a22534d2d4132315355223b613a373a7b733a31303a2270726f647563745f6964223b693a323b733a383a227175616e74697479223b733a313a2231223b733a353a227072696365223b733a363a223230302e3030223b733a373a226f7074696f6e73223b613a303a7b7d733a31333a22617661696c61626c655f717479223b693a323b733a31323a227461785f636c6173735f6964223b733a313a2234223b733a333a22736b75223b733a383a22534d2d4132315355223b7d7d757365727c613a383a7b733a323a226964223b733a313a2231223b733a31313a22637573746f6d65725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a363a224661697a616e223b733a393a226c6173745f6e616d65223b733a363a22526173686964223b733a353a22656d61696c223b733a32373a226661697a616e2e72617368696440616476616e746563682e636f6d223b733a343a2263656c6c223b733a31323a22303035343634363436343536223b733a31323a22757365725f726f6c655f6964223b733a313a2230223b733a363a22657870697265223b693a313634333130323530313b7d, '2022-01-25 05:20:57'),
('qol2c4b9o3u3fj4emiu2eas71l6aijgc', '::1', 1643085422, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333038353432323b, '2022-01-25 04:24:23'),
('s04fbdm1um9dj4diqbb03rp48iri0sbd', '::1', 1643782712, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333738323731323b636172747c613a313a7b733a31323a22414e3531352d35313532324c223b613a373a7b733a31303a2270726f647563745f6964223b693a313b733a383a227175616e74697479223b733a313a2231223b733a353a227072696365223b733a363a223939392e3939223b733a373a226f7074696f6e73223b613a303a7b7d733a31333a22617661696c61626c655f717479223b693a34333b733a31323a227461785f636c6173735f6964223b733a313a2234223b733a333a22736b75223b733a31323a22414e3531352d35313532324c223b7d7d6d6573736167657c733a3131303a2250726f6475637420616464656420746f20796f7572203c6120687265663d2268747470733a2f2f6c6f63616c686f73742f74656368726576616d702f636865636b6f75742f636172742e68746d6c223e73686f7070696e6720636172743c2f613e207375636365737366756c6c79223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226e6577223b7d, '2022-02-02 05:40:47'),
('s5tv0u4hmks70duoqn2fi0j6cnl1k59u', '::1', 1643008341, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333030383333383b757365727c613a383a7b733a323a226964223b733a313a2231223b733a31313a22637573746f6d65725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a363a224661697a616e223b733a393a226c6173745f6e616d65223b733a363a22526173686964223b733a353a22656d61696c223b733a32373a226661697a616e2e72617368696440616476616e746563682e636f6d223b733a343a2263656c6c223b733a31323a22303035343634363436343536223b733a31323a22757365725f726f6c655f6964223b733a313a2230223b733a363a22657870697265223b693a313634333032323734313b7d6e767072657161727261797c613a31313a7b733a363a224d4554484f44223b733a32343a22446f45787072657373436865636b6f75745061796d656e74223b733a373a2256455253494f4e223b733a353a223132342e30223b733a333a22505744223b733a31363a223452364e58514459565542485337464c223b733a343a2255534552223b733a33343a2277617161736b68616e6268617474695f617069312e64697374697a6f6e652e636f6d223b733a393a225349474e4154555245223b733a35363a2241345541304b54775851466e50312d5774364d5263545462474b4874414c496f495a7455384553464746624a516d6752344372427a433034223b733a353a22544f4b454e223b733a32303a2245432d34584139373632304c4a3132353130344a223b733a373a2250415945524944223b733a31333a22334b4857473235424c56513647223b733a31333a225041594d454e54414354494f4e223b733a343a2253616c65223b733a333a22414d54223b733a373a22313035392e3939223b733a31323a2243555252454e4359434f4445223b733a333a22555344223b733a393a22495041444452455353223b733a393a226c6f63616c686f7374223b7d, '2022-01-24 07:12:18'),
('sd5618jmo1br26glsofdtjmplakr07e8', '::1', 1643266745, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333236363734353b, '2022-01-27 06:53:22'),
('sjmgdh49fjgoft7mnpsms47b3c1ebss0', '::1', 1643347188, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333334373138383b, '2022-01-28 04:56:55'),
('sl9cm4gjrdjen1dsaoo7qpuidcb7fct6', '::1', 1643349934, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333334393933343b636172747c613a313a7b733a31343a2241313436355f3267623530306762223b613a373a7b733a31303a2270726f647563745f6964223b693a343b733a383a227175616e74697479223b733a313a2231223b733a353a227072696365223b733a353a2234302e3030223b733a373a226f7074696f6e73223b613a333a7b733a333a2252616d223b733a333a22326762223b733a31303a22486172642d6472697665223b733a353a223530306762223b733a32333a2270726f647563745f6f7074696f6e5f76616c75655f6964223b733a323a223134223b7d733a31333a22617661696c61626c655f717479223b693a32313b733a31323a227461785f636c6173735f6964223b733a313a2231223b733a333a22736b75223b733a31343a2241313436355f3267623530306762223b7d7d757365727c613a383a7b733a323a226964223b733a313a2231223b733a31313a22637573746f6d65725f6964223b733a313a2231223b733a31303a2266697273745f6e616d65223b733a363a224661697a616e223b733a393a226c6173745f6e616d65223b733a363a22526173686964223b733a353a22656d61696c223b733a32373a226661697a616e2e72617368696440616476616e746563682e636f6d223b733a343a2263656c6c223b733a31323a22303035343634363436343536223b733a31323a22757365725f726f6c655f6964223b733a313a2230223b733a363a22657870697265223b693a313634333336343331393b7d636865636b6f75747c613a343a7b733a31353a2262696c6c696e675f61646472657373223b733a313a2231223b733a31363a227368697070696e675f61646472657373223b733a313a2231223b733a31353a227368697070696e675f6d6574686f64223b733a343a22666c6174223b733a31343a227061796d656e745f6d6574686f64223b733a363a2270617970616c223b7d, '2022-01-28 06:00:28'),
('snrvsc9g307o1uo3h7l2imi8qks9f230', '::1', 1643265120, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333236353132303b, '2022-01-27 06:22:27'),
('thdag4trf3sippt052fovbmaqfhm82a0', '::1', 1643266402, 0x5f5f63695f6c6173745f726567656e65726174657c693a313634333236363430323b, '2022-01-27 06:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `ci_settings`
--

CREATE TABLE `ci_settings` (
  `setting_id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `is_json` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_settings`
--

INSERT INTO `ci_settings` (`setting_id`, `type`, `code`, `key`, `value`, `is_json`) VALUES
(1, NULL, 'config', 'config_name', 'Techcity Canadaaaa', 0),
(2, NULL, 'config', 'config_owner', 'Faizan', 0),
(3, NULL, 'config', 'config_email', 'faizan@theadvantech.com', 0),
(4, NULL, 'config', 'config_address', '1025 John A. Papalas Dr.\r\nLincoln Park, MI 48146', 0),
(5, NULL, 'config', 'config_telephone', '(416) 406-1222', 0),
(6, NULL, 'config', 'config_fax', '(416) 406-1222', 0),
(7, NULL, 'config', 'config_meta_title', 'Techcity Canada', 0),
(8, NULL, 'config', 'config_meta_description', 'Techcity Canada computer electronics and Accessories', 0),
(9, NULL, 'config', 'config_meta_keyword', 'Techcity Canada', 0),
(10, NULL, 'config', 'config_theme', 'basharatali5@hotmail.com', 0),
(11, NULL, 'config', 'config_country_id', '38', 0),
(12, NULL, 'config', 'config_zone_id', '602', 0),
(13, NULL, 'config', 'config_currency', 'USD', 0),
(14, NULL, 'config', 'config_length_class_id', '1', 0),
(15, NULL, 'config', 'config_weight_class_id', '5', 0),
(16, NULL, 'config', 'config_mail_from_email', 'no-reply@dev.techcity.com', 0),
(17, NULL, 'config', 'config_mail_from_name', 'TechCity Canada', 0),
(18, NULL, 'config', 'config_mail_engine', '', 0),
(19, NULL, 'config', 'config_mail_parameter', '', 0),
(20, NULL, 'config', 'config_mail_smtp_hostname', '', 0),
(21, NULL, 'config', 'config_mail_smtp_username', '', 0),
(22, NULL, 'config', 'config_mail_smtp_password', '', 0),
(23, NULL, 'config', 'config_sendmail_path', '', 0),
(24, NULL, 'config', 'config_mail_smtp_port', '', 0),
(25, NULL, 'config', 'config_mail_smtp_timeout', '', 0),
(26, NULL, 'config', 'config_mail_smtp_crypto', '', 0),
(27, NULL, 'config', 'config_alert_emails', 'samiu@consultant.com, faizan@theadvantech.com', 0),
(28, NULL, 'config', 'config_is_send_email_admin', '0', 0),
(29, NULL, 'config', 'config_is_send_email_customer', '1', 0),
(30, NULL, 'config', 'config_ssl_support', '', 0),
(31, NULL, 'config', 'config_maintenance', '', 0),
(32, NULL, 'config', 'config_google_analytics', '', 0),
(33, NULL, 'config', 'turn14_access_token', '22f31b2f2c33cd71a105c41aa249038d6fa9f5e9', 0),
(34, NULL, 'config', 'config_time_zone', 'US/Eastern', 0),
(35, NULL, 'product', 'featured_products', '{\"product_id\":\"851\",\"is_hot\":\"1\",\"status\":\"1\"}', 1),
(36, NULL, 'config', 'config_logo', 'assets/img/mccormack-logo-with-tagline.jpg', 0),
(37, NULL, 'config', 'config_tag_line', 'A Bad Day Racing Is Better Than a Good Day Working', 0),
(38, NULL, 'config', 'config_placeholder', 'assets/img/no-product-image.jpg', 0),
(39, NULL, 'config', 'config_placeholder_small', 'assets/img/small-no-product-image.jpg', 0),
(40, NULL, 'config', 'config_payment_icons', 'assets/img/payment.png', 0),
(41, NULL, 'config', 'config_avatar', 'assets/img/avatar-default.png', 0),
(42, 'payment', 'cod', 'cod_sort_order', '1', 0),
(43, 'payment', 'cod', 'cod_total', '0.01', 0),
(44, 'payment', 'cod', 'cod_order_status_id', '1', 0),
(45, 'payment', 'cod', 'cod_geo_zone_id', '0', 0),
(46, 'payment', 'cod', 'cod_status', '1', 0),
(47, 'shipping', 'flat', 'flat_title', 'Flat Shipping', 0),
(48, 'shipping', 'flat', 'flat_sort_order', '1', 0),
(49, 'shipping', 'flat', 'flat_status', '1', 0),
(50, 'shipping', 'flat', 'flat_geo_zone_id', '0', 0),
(51, 'shipping', 'flat', 'flat_tax_class_id', '9', 0),
(52, 'shipping', 'flat', 'flat_cost', '20.00', 0),
(53, 'payment', 'cod', 'cod_title', 'Cash on delivery', 0),
(54, NULL, 'config', 'config_invoice_prefix', 'INV', 0),
(55, NULL, 'config', 'config_pending_order_status', '1', 0),
(56, NULL, 'config', 'config_currency_id', '1', 0),
(57, NULL, 'config', 'config_currency_value', '1.00', 0),
(58, 'payment', 'paypal', 'paypal_title', 'PayPal', 0),
(59, 'payment', 'paypal', 'paypal_sort_order', '1', 0),
(60, 'payment', 'paypal', 'paypal_total', '0.01', 0),
(61, 'payment', 'paypal', 'paypal_order_status_id', '6', 0),
(62, 'payment', 'paypal', 'paypal_geo_zone_id', '0', 0),
(63, 'payment', 'paypal', 'paypal_status', '1', 0),
(64, NULL, 'config', 'tax_status', '0', 0),
(65, NULL, 'config', 'tax_type', 'percent', 0),
(66, NULL, 'config', 'tax_value', '5', 0),
(67, NULL, 'config', 'config_complete_order_status', '6', 0),
(68, NULL, 'config', 'paypal_sandbox_username', 'sb-05oxm1944333_api1.business.example.com', 0),
(69, NULL, 'config', 'paypal_sandbox_password', 'K2ZY4AM2WZ6QQK6A', 0),
(70, NULL, 'config', 'paypal_sandbox_api_signature', 'AleF3RcSlLokd-PEJIe7B7ufRtJzA67UhZb5JSrJjIoVIgJwWt9Mnz6P', 0),
(75, NULL, 'config', 'join_club_discount_type', 'percent', 0),
(76, NULL, 'config', 'join_club_discount_value', '2', 0),
(77, NULL, 'config', 'join_club_discount_status', '1', 0),
(78, NULL, 'config', 'tax_states', '3645,3613,2461,392', 0),
(79, 'shipping', 'free', 'free_sort_order', '1', 0),
(80, 'shipping', 'free', 'free_status', '1', 0),
(81, 'shipping', 'free', 'free_geo_zone_id', '0', 0),
(82, 'shipping', 'free', 'free_tax_class_id', '9', 0),
(83, 'shipping', 'free', 'free_cost', '0', 0),
(84, 'shipping', 'free', 'free_title', 'Free Shipping', 0),
(85, 'shipping', 'free', 'free_total', '150', 0),
(86, NULL, 'config', 'config_placeholder_large', 'assets/img/no-product-image-large.jpg', 0),
(87, NULL, 'config', 'config_coupon_code_status', '0', 0),
(88, NULL, 'config', 'config_coupon_type', 'percent', 0),
(89, NULL, 'config', 'config_coupon_value', '10', 0),
(91, 'payment', 'paypal', 'paypal_sandbox_username', 'waqaskhanbhatti_api1.distizone.com', 0),
(92, 'payment', 'paypal', 'paypal_sandbox_password', '4R6NXQDYVUBHS7FL', 0),
(93, 'payment', 'paypal', 'paypal_sandbox_api_signature', 'A4UA0KTwXQFnP1-Wt6MRcTTbGKHtALIoIZtU8ESFGFbJQmgR4CrBzC04', 0),
(94, 'payment', 'paypal', 'paypal_live_username', 'sales_api1.mccormackracing.com', 0),
(95, 'payment', 'paypal', 'paypal_live_password', '6ZWRPBC6TNLTQCG6', 0),
(96, 'payment', 'paypal', 'paypal_live_api_signature', 'ATJ1Acvh507QgzP-HYL8xvUdSv64AuL2MvDfDaOSh0I7pHzILKGZ0A2E', 0),
(97, 'payment', 'paypal', 'paypal_sandbox_mode', '1', 0),
(99, NULL, 'config', 'config_coupon_value', '10', 0),
(100, NULL, 'config', 'config_coupon_type', 'percent', 0),
(101, NULL, 'config', 'everyone_discount_type', 'percent', 0),
(102, NULL, 'config', 'everyone_discount_value', '2', 0),
(103, NULL, 'config', 'everyone_discount_status', '1', 0),
(104, NULL, 'config', 'config_top_bar_content', '<p style=\"text-align: center;\"><strong>Attention Valued Customers,</strong>&nbsp;As the GTA has now entered the grey zone, our stores are now fully open with limited capacity. Throughout the pandemic, we have tried our best to keep our prices lower then others and continue to do so123456</p>', 0),
(105, NULL, 'config', 'is_short_checkout', '0', 0),
(106, '', 'config', 'is_short_checkout', '0', 0),
(107, 'payment', 'stripe', 'stripe_title', 'Credit card', 0),
(108, 'payment', 'stripe', 'stripe_sort_order', '1', 0),
(109, 'payment', 'stripe', 'stripe_total', '0.01', 0),
(110, 'payment', 'stripe', 'stripe_order_status_id', '6', 0),
(111, 'payment', 'stripe', 'stripe_geo_zone_id', '0', 0),
(112, 'payment', 'stripe', 'stripe_status', '0', 0),
(113, 'payment', 'stripe', 'stripe_publish_key', 'pk_test_51KChIsEVgeb2qGVYDXRInmUxjsAXGL9QUBJRgOAtWZas6wltSxoAV82Fs9HRKD8tdAhAHgCBSWA6BWB1TM2TinLT00lAMtF3yS', 0),
(114, 'payment', 'stripe', 'stripe_secret_key', 'sk_test_51KChIsEVgeb2qGVYu10tXWhuaKYmlaqOHBVkUKgljmNGMAOnlsvJ5HyjUFVFsT4LSTkzZ6xZkRBoLuYGA89OaJZi00cty5Wr8z', 0),
(115, 'shipping', 'shipping_item', 'shipping_item_sort_order', '2', 0),
(116, 'shipping', 'shipping_item', 'shipping_item_status', '0', 0),
(117, 'shipping', 'shipping_item', 'shipping_item_geo_zone_id', '6', 0),
(118, 'shipping', 'shipping_item', 'shipping_item_tax_class_id', '9', 0),
(119, 'shipping', 'shipping_item', 'shipping_item_cost', '20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_settings_old`
--

CREATE TABLE `ci_settings_old` (
  `setting_id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `is_json` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_settings_old`
--

INSERT INTO `ci_settings_old` (`setting_id`, `type`, `code`, `key`, `value`, `is_json`) VALUES
(1, NULL, 'config', 'config_name', 'Techcity Canadaaaa', 0),
(2, NULL, 'config', 'config_owner', 'Faizan', 0),
(3, NULL, 'config', 'config_email', 'faizan@theadvantech.com', 0),
(4, NULL, 'config', 'config_address', '1025 John A. Papalas Dr.\r\nLincoln Park, MI 48146', 0),
(5, NULL, 'config', 'config_telephone', '(416) 406-1222', 0),
(6, NULL, 'config', 'config_fax', '(416) 406-1222', 0),
(7, NULL, 'config', 'config_meta_title', 'Techcity Canada', 0),
(8, NULL, 'config', 'config_meta_description', 'Techcity Canada computer electronics and Accessories', 0),
(9, NULL, 'config', 'config_meta_keyword', 'Techcity Canada', 0),
(10, NULL, 'config', 'config_theme', 'basharatali5@hotmail.com', 0),
(11, NULL, 'config', 'config_country_id', '223', 0),
(12, NULL, 'config', 'config_zone_id', '3645', 0),
(13, NULL, 'config', 'config_currency', 'USD', 0),
(14, NULL, 'config', 'config_length_class_id', '1', 0),
(15, NULL, 'config', 'config_weight_class_id', '5', 0),
(16, NULL, 'config', 'config_mail_from_email', 'no-reply@dev.techcity.com', 0),
(17, NULL, 'config', 'config_mail_from_name', 'TechCity Canada', 0),
(18, NULL, 'config', 'config_mail_engine', 'mail', 0),
(19, NULL, 'config', 'config_mail_parameter', '', 0),
(20, NULL, 'config', 'config_mail_smtp_hostname', '', 0),
(21, NULL, 'config', 'config_mail_smtp_username', 'abc123', 0),
(22, NULL, 'config', 'config_mail_smtp_password', '123456', 0),
(23, NULL, 'config', 'config_sendmail_path', '/usr/sbin/sendmail', 0),
(24, NULL, 'config', 'config_mail_smtp_port', '25', 0),
(25, NULL, 'config', 'config_mail_smtp_timeout', '5', 0),
(26, NULL, 'config', 'config_mail_smtp_crypto', 'tls', 0),
(27, NULL, 'config', 'config_alert_emails', 'samiu@consultant.com, faizan@theadvantech.com', 0),
(28, NULL, 'config', 'config_is_send_email_admin', '1', 0),
(29, NULL, 'config', 'config_is_send_email_customer', '1', 0),
(30, NULL, 'config', 'config_ssl_support', '', 0),
(31, NULL, 'config', 'config_maintenance', '', 0),
(32, NULL, 'config', 'config_google_analytics', '', 0),
(33, NULL, 'config', 'turn14_access_token', '22f31b2f2c33cd71a105c41aa249038d6fa9f5e9', 0),
(34, NULL, 'config', 'config_time_zone', 'US/Eastern', 0),
(35, NULL, 'product', 'featured_products', '{\"product_id\":\"851\",\"is_hot\":\"1\",\"status\":\"1\"}', 1),
(36, NULL, 'config', 'config_logo', 'assets/img/mccormack-logo-with-tagline.jpg', 0),
(37, NULL, 'config', 'config_tag_line', 'A Bad Day Racing Is Better Than a Good Day Working', 0),
(38, NULL, 'config', 'config_placeholder', 'assets/img/no-product-image.jpg', 0),
(39, NULL, 'config', 'config_placeholder_small', 'assets/img/small-no-product-image.jpg', 0),
(40, NULL, 'config', 'config_payment_icons', 'assets/img/payment.png', 0),
(41, NULL, 'config', 'config_avatar', 'assets/img/avatar-default.png', 0),
(42, 'payment', 'cod', 'cod_sort_order', '1', 0),
(43, 'payment', 'cod', 'cod_total', '0.01', 0),
(44, 'payment', 'cod', 'cod_order_status_id', '1', 0),
(45, 'payment', 'cod', 'cod_geo_zone_id', '0', 0),
(46, 'payment', 'cod', 'cod_status', '1', 0),
(47, 'shipping', 'flat', 'flat_title', 'Flat Shipping', 0),
(48, 'shipping', 'flat', 'flat_sort_order', '1', 0),
(49, 'shipping', 'flat', 'flat_status', '1', 0),
(50, 'shipping', 'flat', 'flat_geo_zone_id', '0', 0),
(51, 'shipping', 'flat', 'flat_tax_class_id', '9', 0),
(52, 'shipping', 'flat', 'flat_cost', '20.00', 0),
(53, 'payment', 'cod', 'cod_title', 'Cash on delivery', 0),
(54, NULL, 'config', 'config_invoice_prefix', 'INV', 0),
(55, NULL, 'config', 'config_pending_order_status', '1', 0),
(56, NULL, 'config', 'config_currency_id', '1', 0),
(57, NULL, 'config', 'config_currency_value', '1.00', 0),
(58, 'payment', 'paypal', 'paypal_title', 'PayPal', 0),
(59, 'payment', 'paypal', 'paypal_sort_order', '1', 0),
(60, 'payment', 'paypal', 'paypal_total', '0.01', 0),
(61, 'payment', 'paypal', 'paypal_order_status_id', '6', 0),
(62, 'payment', 'paypal', 'paypal_geo_zone_id', '0', 0),
(63, 'payment', 'paypal', 'paypal_status', '1', 0),
(64, NULL, 'config', 'tax_status', '1', 0),
(65, NULL, 'config', 'tax_type', 'percent', 0),
(66, NULL, 'config', 'tax_value', '3', 0),
(67, NULL, 'config', 'config_complete_order_status', '6', 0),
(68, NULL, 'config', 'paypal_sandbox_username', 'sb-05oxm1944333_api1.business.example.com', 0),
(69, NULL, 'config', 'paypal_sandbox_password', 'K2ZY4AM2WZ6QQK6A', 0),
(70, NULL, 'config', 'paypal_sandbox_api_signature', 'AleF3RcSlLokd-PEJIe7B7ufRtJzA67UhZb5JSrJjIoVIgJwWt9Mnz6P', 0),
(75, NULL, 'config', 'join_club_discount_type', 'percent', 0),
(76, NULL, 'config', 'join_club_discount_value', '2', 0),
(77, NULL, 'config', 'join_club_discount_status', '1', 0),
(78, NULL, 'config', 'tax_states', '3645,3613,2461,392', 0),
(79, 'shipping', 'free', 'free_sort_order', '1', 0),
(80, 'shipping', 'free', 'free_status', '1', 0),
(81, 'shipping', 'free', 'free_geo_zone_id', '0', 0),
(82, 'shipping', 'free', 'free_tax_class_id', '9', 0),
(83, 'shipping', 'free', 'free_cost', '0', 0),
(84, 'shipping', 'free', 'free_title', 'Free Shipping', 0),
(85, 'shipping', 'free', 'free_total', '150', 0),
(86, NULL, 'config', 'config_placeholder_large', 'assets/img/no-product-image-large.jpg', 0),
(87, NULL, 'config', 'config_coupon_code_status', '0', 0),
(88, NULL, 'config', 'config_coupon_type', 'percent', 0),
(89, NULL, 'config', 'config_coupon_value', '10', 0),
(91, 'payment', 'paypal', 'paypal_sandbox_username', 'waqaskhanbhatti_api1.distizone.com', 0),
(92, 'payment', 'paypal', 'paypal_sandbox_password', '4R6NXQDYVUBHS7FL', 0),
(93, 'payment', 'paypal', 'paypal_sandbox_api_signature', 'A4UA0KTwXQFnP1-Wt6MRcTTbGKHtALIoIZtU8ESFGFbJQmgR4CrBzC04', 0),
(94, 'payment', 'paypal', 'paypal_live_username', 'sales_api1.mccormackracing.com', 0),
(95, 'payment', 'paypal', 'paypal_live_password', '6ZWRPBC6TNLTQCG6', 0),
(96, 'payment', 'paypal', 'paypal_live_api_signature', 'ATJ1Acvh507QgzP-HYL8xvUdSv64AuL2MvDfDaOSh0I7pHzILKGZ0A2E', 0),
(97, 'payment', 'paypal', 'paypal_sandbox_mode', '1', 0),
(99, NULL, 'config', 'config_coupon_value', '10', 0),
(100, NULL, 'config', 'config_coupon_type', 'percent', 0),
(101, NULL, 'config', 'everyone_discount_type', 'percent', 0),
(102, NULL, 'config', 'everyone_discount_value', '2', 0),
(103, NULL, 'config', 'everyone_discount_status', '1', 0),
(104, NULL, 'config', 'config_top_bar_content', '<p style=\"text-align: center;\"><strong>Attention Valued Customers,</strong>&nbsp;As the GTA has now entered the grey zone, our stores are now fully open with limited capacity. Throughout the pandemic, we have tried our best to keep our prices lower then others and continue to do so123456</p>', 0),
(105, NULL, 'config', 'is_short_checkout', '0', 0),
(106, '', 'config', 'is_short_checkout', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sliders`
--

CREATE TABLE `ci_sliders` (
  `slider_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `enable_on` date NOT NULL,
  `disable_on` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `new_window` tinyint(1) NOT NULL,
  `sort_order` tinyint(3) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_sliders`
--

INSERT INTO `ci_sliders` (`slider_id`, `name`, `title`, `enable_on`, `disable_on`, `image`, `link`, `new_window`, `sort_order`, `is_enabled`, `date_added`, `date_modified`) VALUES
(1, 'slider1', 'slider1', '0000-00-00', '0000-00-00', 'd1bc5adf5881f98ed18eec8fef02dd53.png', 'https://www.techcitycanada.ca/', 1, 1, 0, '2021-12-22 12:23:54', '2021-12-22 12:23:54'),
(2, 'Slider', 'Slider2', '0000-00-00', '0000-00-00', '3fbaeced45cdb3788f2f99468e9bbe0b.png', '', 0, 0, 0, '2021-12-22 12:19:19', '2021-12-22 12:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `ci_special_products`
--

CREATE TABLE `ci_special_products` (
  `product_id` int(11) NOT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_taxes`
--

CREATE TABLE `ci_taxes` (
  `tax_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `tax_rate` decimal(10,2) DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_taxes`
--

INSERT INTO `ci_taxes` (`tax_id`, `country_id`, `region_id`, `tax_rate`, `date_modified`, `date_created`) VALUES
(1, 223, 3645, '7.00', '2022-01-11', '2022-01-11'),
(2, 223, 2461, '10.00', '2022-01-07', '2022-01-07'),
(4, 162, 2461, '8.50', NULL, '2022-01-11');

-- --------------------------------------------------------

--
-- Table structure for table `ci_tax_class`
--

CREATE TABLE `ci_tax_class` (
  `tax_class_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_tax_class`
--

INSERT INTO `ci_tax_class` (`tax_class_id`, `title`, `description`, `date_added`, `date_modified`) VALUES
(1, 'Taxable Goods', 'Taxed goods', '2022-01-18 10:05:18', '2022-01-18 10:05:18'),
(4, 'Downloadable Products', 'Downloadable', '2022-01-24 06:21:18', '2022-01-24 06:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `ci_tax_rate`
--

CREATE TABLE `ci_tax_rate` (
  `tax_rate_id` int(11) NOT NULL,
  `geo_zone_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(32) NOT NULL,
  `rate` decimal(10,2) NOT NULL DEFAULT 0.00,
  `type` char(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_tax_rate`
--

INSERT INTO `ci_tax_rate` (`tax_rate_id`, `geo_zone_id`, `name`, `rate`, `type`, `date_added`, `date_modified`) VALUES
(86, 5, 'VAT (20%)', '20.00', 'F', '2022-01-24 08:10:28', '2022-01-24 08:10:28'),
(87, 5, 'Eco Tax (-2.00)', '5.00', 'F', '2022-02-04 05:50:49', '2022-02-04 05:50:49'),
(88, 6, 'HST', '10.00', 'F', '2022-02-04 05:51:00', '2022-02-04 05:51:00'),
(89, 4, 'Tax', '13.00', 'P', '2019-07-10 09:34:43', '2019-07-10 09:36:48'),
(90, 5, 'HST (13%)', '5.00', 'F', '2019-07-10 09:35:00', '2019-12-04 11:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `ci_tax_rule`
--

CREATE TABLE `ci_tax_rule` (
  `tax_rule_id` int(11) NOT NULL,
  `tax_class_id` int(11) NOT NULL,
  `tax_rate_id` int(11) NOT NULL,
  `based` varchar(10) NOT NULL,
  `priority` int(5) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_tax_rule`
--

INSERT INTO `ci_tax_rule` (`tax_rule_id`, `tax_class_id`, `tax_rate_id`, `based`, `priority`) VALUES
(161, 1, 90, 'store', 2),
(160, 1, 87, 'payment', 1),
(159, 1, 86, 'shipping', 0),
(165, 4, 87, 'store', 1),
(164, 4, 86, 'payment', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_weight_class`
--

CREATE TABLE `ci_weight_class` (
  `weight_class_id` int(11) NOT NULL,
  `value` decimal(15,8) NOT NULL DEFAULT 0.00000000,
  `title` varchar(32) NOT NULL,
  `unit` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_weight_class`
--

INSERT INTO `ci_weight_class` (`weight_class_id`, `value`, `title`, `unit`) VALUES
(1, '1.00000000', 'Kilogram', 'kg'),
(2, '1000.00000000', 'Gram', 'g'),
(5, '2.20460000', 'Pound', 'lb'),
(6, '35.27400000', 'Ounce', 'oz');

-- --------------------------------------------------------

--
-- Table structure for table `ci_zone_to_geo_zone`
--

CREATE TABLE `ci_zone_to_geo_zone` (
  `zone_to_geo_zone_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL DEFAULT 0,
  `geo_zone_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_zone_to_geo_zone`
--

INSERT INTO `ci_zone_to_geo_zone` (`zone_to_geo_zone_id`, `country_id`, `zone_id`, `geo_zone_id`, `date_added`, `date_modified`) VALUES
(22, 38, 602, 5, '2022-01-24 07:08:53', '0000-00-00 00:00:00'),
(19, 162, 2461, 9, '2022-01-13 16:46:02', '0000-00-00 00:00:00'),
(18, 1, 2, 9, '2022-01-13 16:46:02', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_acl_actions`
--
ALTER TABLE `ci_acl_actions`
  ADD PRIMARY KEY (`acl_action_id`);

--
-- Indexes for table `ci_acl_categories`
--
ALTER TABLE `ci_acl_categories`
  ADD PRIMARY KEY (`acl_category_id`) USING BTREE;

--
-- Indexes for table `ci_acl_modules`
--
ALTER TABLE `ci_acl_modules`
  ADD PRIMARY KEY (`acl_module_id`);

--
-- Indexes for table `ci_address`
--
ALTER TABLE `ci_address`
  ADD PRIMARY KEY (`address_id`) USING BTREE,
  ADD KEY `customer_id` (`customer_id`) USING BTREE;

--
-- Indexes for table `ci_admin_users`
--
ALTER TABLE `ci_admin_users`
  ADD PRIMARY KEY (`admin_user_id`) USING BTREE;

--
-- Indexes for table `ci_brands`
--
ALTER TABLE `ci_brands`
  ADD PRIMARY KEY (`brand_id`) USING BTREE;

--
-- Indexes for table `ci_categories`
--
ALTER TABLE `ci_categories`
  ADD PRIMARY KEY (`category_id`) USING BTREE;

--
-- Indexes for table `ci_contact_us`
--
ALTER TABLE `ci_contact_us`
  ADD PRIMARY KEY (`contact_us_id`);

--
-- Indexes for table `ci_countries`
--
ALTER TABLE `ci_countries`
  ADD PRIMARY KEY (`country_id`) USING BTREE;

--
-- Indexes for table `ci_country_names`
--
ALTER TABLE `ci_country_names`
  ADD PRIMARY KEY (`country_name_id`) USING BTREE;

--
-- Indexes for table `ci_country_zones`
--
ALTER TABLE `ci_country_zones`
  ADD PRIMARY KEY (`zone_id`) USING BTREE;

--
-- Indexes for table `ci_country_zone_names`
--
ALTER TABLE `ci_country_zone_names`
  ADD PRIMARY KEY (`country_zone_name_id`) USING BTREE;

--
-- Indexes for table `ci_currency`
--
ALTER TABLE `ci_currency`
  ADD PRIMARY KEY (`currency_id`) USING BTREE;

--
-- Indexes for table `ci_customers`
--
ALTER TABLE `ci_customers`
  ADD PRIMARY KEY (`customer_id`) USING BTREE;

--
-- Indexes for table `ci_customers_password_reset_requests`
--
ALTER TABLE `ci_customers_password_reset_requests`
  ADD PRIMARY KEY (`customer_password_reset_request_id`) USING BTREE;

--
-- Indexes for table `ci_customer_notifications`
--
ALTER TABLE `ci_customer_notifications`
  ADD PRIMARY KEY (`customer_notification_id`) USING BTREE;

--
-- Indexes for table `ci_customer_notification_alerts`
--
ALTER TABLE `ci_customer_notification_alerts`
  ADD PRIMARY KEY (`customer_notification_id`) USING BTREE;

--
-- Indexes for table `ci_customer_settings`
--
ALTER TABLE `ci_customer_settings`
  ADD PRIMARY KEY (`customer_setting_id`) USING BTREE;

--
-- Indexes for table `ci_customer_wishlist`
--
ALTER TABLE `ci_customer_wishlist`
  ADD PRIMARY KEY (`user_wishlist_id`) USING BTREE;

--
-- Indexes for table `ci_customer_wishlist_org`
--
ALTER TABLE `ci_customer_wishlist_org`
  ADD PRIMARY KEY (`user_wishlist_id`) USING BTREE;

--
-- Indexes for table `ci_customer_wishlist_products`
--
ALTER TABLE `ci_customer_wishlist_products`
  ADD PRIMARY KEY (`user_wishlist_product_id`) USING BTREE;

--
-- Indexes for table `ci_errors_log`
--
ALTER TABLE `ci_errors_log`
  ADD PRIMARY KEY (`error_log_id`) USING BTREE;

--
-- Indexes for table `ci_extensions`
--
ALTER TABLE `ci_extensions`
  ADD PRIMARY KEY (`extension_id`) USING BTREE;

--
-- Indexes for table `ci_geo_ip_location`
--
ALTER TABLE `ci_geo_ip_location`
  ADD KEY `idx_ip_from` (`ip_from`) USING BTREE,
  ADD KEY `idx_ip_to` (`ip_to`) USING BTREE,
  ADD KEY `idx_ip_from_to` (`ip_from`,`ip_to`) USING BTREE;

--
-- Indexes for table `ci_geo_zone`
--
ALTER TABLE `ci_geo_zone`
  ADD PRIMARY KEY (`geo_zone_id`);

--
-- Indexes for table `ci_geo_zones`
--
ALTER TABLE `ci_geo_zones`
  ADD PRIMARY KEY (`geo_zone_id`) USING BTREE;

--
-- Indexes for table `ci_length_class`
--
ALTER TABLE `ci_length_class`
  ADD PRIMARY KEY (`length_class_id`) USING BTREE;

--
-- Indexes for table `ci_login_attempts`
--
ALTER TABLE `ci_login_attempts`
  ADD KEY `ip` (`ip`) USING BTREE;

--
-- Indexes for table `ci_navigations`
--
ALTER TABLE `ci_navigations`
  ADD PRIMARY KEY (`navigation_id`);

--
-- Indexes for table `ci_newsletters`
--
ALTER TABLE `ci_newsletters`
  ADD PRIMARY KEY (`newsletter_id`);

--
-- Indexes for table `ci_order`
--
ALTER TABLE `ci_order`
  ADD PRIMARY KEY (`order_id`) USING BTREE;

--
-- Indexes for table `ci_order_history`
--
ALTER TABLE `ci_order_history`
  ADD PRIMARY KEY (`order_history_id`) USING BTREE;

--
-- Indexes for table `ci_order_items`
--
ALTER TABLE `ci_order_items`
  ADD PRIMARY KEY (`order_item_id`) USING BTREE;

--
-- Indexes for table `ci_order_products`
--
ALTER TABLE `ci_order_products`
  ADD PRIMARY KEY (`order_item_id`) USING BTREE;

--
-- Indexes for table `ci_order_status`
--
ALTER TABLE `ci_order_status`
  ADD PRIMARY KEY (`order_status_id`) USING BTREE;

--
-- Indexes for table `ci_order_status_log`
--
ALTER TABLE `ci_order_status_log`
  ADD PRIMARY KEY (`order_status_log_id`) USING BTREE;

--
-- Indexes for table `ci_order_total`
--
ALTER TABLE `ci_order_total`
  ADD PRIMARY KEY (`order_total_id`) USING BTREE,
  ADD KEY `order_id` (`order_id`) USING BTREE;

--
-- Indexes for table `ci_pages`
--
ALTER TABLE `ci_pages`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `ci_pages` ADD FULLTEXT KEY `title` (`title`,`content`);

--
-- Indexes for table `ci_page_contents`
--
ALTER TABLE `ci_page_contents`
  ADD PRIMARY KEY (`page_content_id`) USING BTREE;

--
-- Indexes for table `ci_paypal_log`
--
ALTER TABLE `ci_paypal_log`
  ADD PRIMARY KEY (`paypal_log_id`);

--
-- Indexes for table `ci_products`
--
ALTER TABLE `ci_products`
  ADD PRIMARY KEY (`product_id`) USING BTREE,
  ADD KEY `sku` (`sku`) USING BTREE;

--
-- Indexes for table `ci_product_categories`
--
ALTER TABLE `ci_product_categories`
  ADD PRIMARY KEY (`product_id`,`category_id`);

--
-- Indexes for table `ci_product_edit_log`
--
ALTER TABLE `ci_product_edit_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_product_option_filter`
--
ALTER TABLE `ci_product_option_filter`
  ADD PRIMARY KEY (`product_option_filter_id`);

--
-- Indexes for table `ci_product_option_value`
--
ALTER TABLE `ci_product_option_value`
  ADD PRIMARY KEY (`product_option_value_id`);

--
-- Indexes for table `ci_related_products`
--
ALTER TABLE `ci_related_products`
  ADD PRIMARY KEY (`product_id`,`related_product_id`);

--
-- Indexes for table `ci_roles`
--
ALTER TABLE `ci_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `ci_role_permissions`
--
ALTER TABLE `ci_role_permissions`
  ADD PRIMARY KEY (`role_permission_id`);

--
-- Indexes for table `ci_routes`
--
ALTER TABLE `ci_routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_search`
--
ALTER TABLE `ci_search`
  ADD PRIMARY KEY (`code`) USING BTREE;

--
-- Indexes for table `ci_search_a`
--
ALTER TABLE `ci_search_a`
  ADD PRIMARY KEY (`code`) USING BTREE;

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`,`ip_address`) USING BTREE,
  ADD KEY `ci_sessions_timestamp` (`timestamp`) USING BTREE;

--
-- Indexes for table `ci_sessions_a`
--
ALTER TABLE `ci_sessions_a`
  ADD PRIMARY KEY (`id`,`ip_address`) USING BTREE,
  ADD KEY `ci_sessions_timestamp` (`timestamp`) USING BTREE;

--
-- Indexes for table `ci_sessions_u`
--
ALTER TABLE `ci_sessions_u`
  ADD PRIMARY KEY (`id`,`ip_address`) USING BTREE,
  ADD KEY `ci_sessions_timestamp` (`timestamp`) USING BTREE;

--
-- Indexes for table `ci_settings`
--
ALTER TABLE `ci_settings`
  ADD PRIMARY KEY (`setting_id`) USING BTREE;

--
-- Indexes for table `ci_settings_old`
--
ALTER TABLE `ci_settings_old`
  ADD PRIMARY KEY (`setting_id`) USING BTREE;

--
-- Indexes for table `ci_sliders`
--
ALTER TABLE `ci_sliders`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `ci_special_products`
--
ALTER TABLE `ci_special_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `ci_taxes`
--
ALTER TABLE `ci_taxes`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `ci_tax_class`
--
ALTER TABLE `ci_tax_class`
  ADD PRIMARY KEY (`tax_class_id`);

--
-- Indexes for table `ci_tax_rate`
--
ALTER TABLE `ci_tax_rate`
  ADD PRIMARY KEY (`tax_rate_id`);

--
-- Indexes for table `ci_tax_rule`
--
ALTER TABLE `ci_tax_rule`
  ADD PRIMARY KEY (`tax_rule_id`);

--
-- Indexes for table `ci_weight_class`
--
ALTER TABLE `ci_weight_class`
  ADD PRIMARY KEY (`weight_class_id`) USING BTREE;

--
-- Indexes for table `ci_zone_to_geo_zone`
--
ALTER TABLE `ci_zone_to_geo_zone`
  ADD PRIMARY KEY (`zone_to_geo_zone_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ci_acl_actions`
--
ALTER TABLE `ci_acl_actions`
  MODIFY `acl_action_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ci_acl_categories`
--
ALTER TABLE `ci_acl_categories`
  MODIFY `acl_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ci_acl_modules`
--
ALTER TABLE `ci_acl_modules`
  MODIFY `acl_module_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ci_address`
--
ALTER TABLE `ci_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ci_admin_users`
--
ALTER TABLE `ci_admin_users`
  MODIFY `admin_user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ci_brands`
--
ALTER TABLE `ci_brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_categories`
--
ALTER TABLE `ci_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ci_contact_us`
--
ALTER TABLE `ci_contact_us`
  MODIFY `contact_us_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_countries`
--
ALTER TABLE `ci_countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `ci_country_names`
--
ALTER TABLE `ci_country_names`
  MODIFY `country_name_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_country_zones`
--
ALTER TABLE `ci_country_zones`
  MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4239;

--
-- AUTO_INCREMENT for table `ci_country_zone_names`
--
ALTER TABLE `ci_country_zone_names`
  MODIFY `country_zone_name_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_currency`
--
ALTER TABLE `ci_currency`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_customers`
--
ALTER TABLE `ci_customers`
  MODIFY `customer_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ci_customers_password_reset_requests`
--
ALTER TABLE `ci_customers_password_reset_requests`
  MODIFY `customer_password_reset_request_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_customer_notifications`
--
ALTER TABLE `ci_customer_notifications`
  MODIFY `customer_notification_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ci_customer_notification_alerts`
--
ALTER TABLE `ci_customer_notification_alerts`
  MODIFY `customer_notification_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `ci_customer_settings`
--
ALTER TABLE `ci_customer_settings`
  MODIFY `customer_setting_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_customer_wishlist`
--
ALTER TABLE `ci_customer_wishlist`
  MODIFY `user_wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_customer_wishlist_org`
--
ALTER TABLE `ci_customer_wishlist_org`
  MODIFY `user_wishlist_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ci_customer_wishlist_products`
--
ALTER TABLE `ci_customer_wishlist_products`
  MODIFY `user_wishlist_product_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_errors_log`
--
ALTER TABLE `ci_errors_log`
  MODIFY `error_log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_extensions`
--
ALTER TABLE `ci_extensions`
  MODIFY `extension_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ci_geo_zone`
--
ALTER TABLE `ci_geo_zone`
  MODIFY `geo_zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ci_geo_zones`
--
ALTER TABLE `ci_geo_zones`
  MODIFY `geo_zone_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_length_class`
--
ALTER TABLE `ci_length_class`
  MODIFY `length_class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_navigations`
--
ALTER TABLE `ci_navigations`
  MODIFY `navigation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ci_newsletters`
--
ALTER TABLE `ci_newsletters`
  MODIFY `newsletter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ci_order`
--
ALTER TABLE `ci_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `ci_order_history`
--
ALTER TABLE `ci_order_history`
  MODIFY `order_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `ci_order_items`
--
ALTER TABLE `ci_order_items`
  MODIFY `order_item_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_order_products`
--
ALTER TABLE `ci_order_products`
  MODIFY `order_item_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `ci_order_status`
--
ALTER TABLE `ci_order_status`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ci_order_status_log`
--
ALTER TABLE `ci_order_status_log`
  MODIFY `order_status_log_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_order_total`
--
ALTER TABLE `ci_order_total`
  MODIFY `order_total_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

--
-- AUTO_INCREMENT for table `ci_pages`
--
ALTER TABLE `ci_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ci_page_contents`
--
ALTER TABLE `ci_page_contents`
  MODIFY `page_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000014;

--
-- AUTO_INCREMENT for table `ci_paypal_log`
--
ALTER TABLE `ci_paypal_log`
  MODIFY `paypal_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `ci_products`
--
ALTER TABLE `ci_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ci_product_edit_log`
--
ALTER TABLE `ci_product_edit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_product_option_filter`
--
ALTER TABLE `ci_product_option_filter`
  MODIFY `product_option_filter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ci_product_option_value`
--
ALTER TABLE `ci_product_option_value`
  MODIFY `product_option_value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ci_roles`
--
ALTER TABLE `ci_roles`
  MODIFY `role_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ci_role_permissions`
--
ALTER TABLE `ci_role_permissions`
  MODIFY `role_permission_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `ci_routes`
--
ALTER TABLE `ci_routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ci_settings`
--
ALTER TABLE `ci_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `ci_settings_old`
--
ALTER TABLE `ci_settings_old`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `ci_sliders`
--
ALTER TABLE `ci_sliders`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ci_taxes`
--
ALTER TABLE `ci_taxes`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ci_tax_class`
--
ALTER TABLE `ci_tax_class`
  MODIFY `tax_class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ci_tax_rate`
--
ALTER TABLE `ci_tax_rate`
  MODIFY `tax_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `ci_tax_rule`
--
ALTER TABLE `ci_tax_rule`
  MODIFY `tax_rule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `ci_zone_to_geo_zone`
--
ALTER TABLE `ci_zone_to_geo_zone`
  MODIFY `zone_to_geo_zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
