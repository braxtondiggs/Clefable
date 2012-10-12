-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 12, 2012 at 03:30 PM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `igniter`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `type` mediumint(11) NOT NULL,
  `created_on` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_id` (`account_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_id`, `type`, `created_on`) VALUES
(1, 'aYqeViE2mOcGa', 1, 1349975615);

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` mediumint(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `name`, `description`) VALUES
(1, 'Free', 'Free Limited Account'),
(2, 'Professional', 'Paid Subscription');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `text` varchar(128) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `value` varchar(5) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `value` (`value`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `text`, `value`) VALUES
(0, 'ENGLISH', 'en'),
(1, 'AFRIKAANS', 'af'),
(2, 'ALBANIAN', 'sq'),
(3, 'AMHARIC', 'am'),
(4, 'ARABIC', 'ar'),
(5, 'ARMENIAN', 'hy'),
(6, 'AZERBAIJANI', 'az'),
(7, 'BASQUE', 'eu'),
(8, 'BELARUSIAN', 'be'),
(9, 'BENGALI', 'bn'),
(10, 'BIHARI', 'bh'),
(11, 'BRETON', 'br'),
(12, 'BULGARIAN', 'bg'),
(13, 'BURMESE', 'my'),
(14, 'CATALAN', 'ca'),
(15, 'CHEROKEE', 'chr'),
(16, 'CHINESE', 'zh'),
(17, 'CHINESE SIMPLIFIED', 'zh-CN'),
(18, 'CHINESE TRADITIONAL', 'zh-TW'),
(19, 'CORSICAN', 'co'),
(20, 'CROATIAN', 'hr'),
(21, 'CZECH', 'cs'),
(22, 'DANISH', 'da'),
(23, 'DHIVEHI', 'dv'),
(24, 'DUTCH', 'nl'),
(25, 'ESPERANTO', 'eo'),
(26, 'ESTONIAN', 'et'),
(27, 'FAROESE', 'fo'),
(28, 'FILIPINO', 'tl'),
(29, 'FINNISH', 'fi'),
(30, 'FRENCH', 'fr'),
(31, 'FRISIAN', 'fy'),
(32, 'GALICIAN', 'gl'),
(33, 'GEORGIAN', 'ka'),
(34, 'GREEK', 'el'),
(35, 'GUJARATI', 'gu'),
(36, 'HAITIAN CREOLE', 'ht'),
(37, 'HEBREW', 'iw'),
(38, 'HINDI', 'hi'),
(39, 'HUNGARIAN', 'hu'),
(40, 'ICELANDIC', 'is'),
(41, 'INDONESIAN', 'id'),
(42, 'INUKTITUT', 'iu'),
(43, 'IRISH', 'ga'),
(44, 'ITALIAN', 'it'),
(45, 'JAPANESE', 'ja'),
(46, 'JAVANESE', 'jw'),
(47, 'KANNADA', 'kn'),
(48, 'KAZAKH', 'kk'),
(49, 'KHMER', 'km'),
(50, 'KOREAN', 'ko'),
(51, 'KURDISH', 'ku'),
(52, 'KYRGYZ', 'ky'),
(53, 'LAO', 'lo'),
(54, 'LATIN', 'la'),
(55, 'LATVIAN', 'lv'),
(56, 'LITHUANIAN', 'lt'),
(57, 'LUXEMBOURGISH', 'lb'),
(58, 'MACEDONIAN', 'mk'),
(59, 'MALAY', 'ms'),
(60, 'MALAYALAM', 'ml'),
(61, 'MALTESE', 'mt'),
(62, 'MAORI', 'mi'),
(63, 'MARATHI', 'mr'),
(64, 'MONGOLIAN', 'mn'),
(65, 'NEPALI', 'ne'),
(66, 'NORWEGIAN', 'no'),
(67, 'OCCITAN', 'oc'),
(68, 'ORIYA', 'or'),
(69, 'PASHTO', 'ps'),
(70, 'PERSIAN', 'fa'),
(71, 'POLISH', 'pl'),
(72, 'PORTUGUESE', 'pt'),
(73, 'PORTUGUESE PORTUGAL', 'pt-PT'),
(74, 'PUNJABI', 'pa'),
(75, 'QUECHUA', 'qu'),
(76, 'ROMANIAN', 'ro'),
(77, 'RUSSIAN', 'ru'),
(78, 'SANSKRIT', 'sa'),
(79, 'SCOTS GAELIC', 'gd'),
(80, 'SERBIAN', 'sr'),
(81, 'SINDHI', 'sd'),
(82, 'SINHALESE', 'si'),
(83, 'SLOVAK', 'sk'),
(84, 'SLOVENIAN', 'sl'),
(85, 'SPANISH', 'es'),
(86, 'SUNDANESE', 'su'),
(87, 'SWAHILI', 'sw'),
(88, 'SWEDISH', 'syr'),
(89, 'TAJIK', 'tg'),
(90, 'TAMIL', 'ta'),
(91, 'TATAR', 'tt'),
(92, 'TELUGU', 'te'),
(93, 'THAI', 'th'),
(94, 'TIBETAN', 'bo'),
(95, 'TONGA', 'to'),
(96, 'TURKISH', 'tr'),
(97, 'UKRAINIAN', 'uk'),
(98, 'URDU', 'ur'),
(99, 'UZBEK', 'uz'),
(100, 'UIGHUR', 'ug'),
(101, 'VIETNAMESE', 'vi'),
(102, 'WELSH', 'cl'),
(103, 'YIDDISH', 'yi'),
(104, 'YORUBA', 'yo');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `salt` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `activation_code` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `forgotten_password_code` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `account` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `first_name` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `user_type` mediumint(8) unsigned NOT NULL,
  `language` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `has_demo` tinyint(1) DEFAULT NULL,
  `provider` varchar(128) COLLATE latin1_general_ci DEFAULT NULL,
  `all_one` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `all_one_id` varchar(128) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_type` (`user_type`),
  KEY `language` (`language`),
  KEY `account` (`account`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `account`, `first_name`, `last_name`, `user_type`, `language`, `has_demo`, `provider`, `all_one`, `all_one_id`) VALUES
(5, '\0\0', 'uPjTuxiRz9fOH', '291df99500ce620bd3d03131e66d0d78c6318363', '0ad853e514', 'braxtondiggs@gmail.com', NULL, NULL, NULL, NULL, 1349975615, 1349975615, 1, 'aYqeViE2mOcGa', 'New', 'User', 1, 'en', 1, 'CymbitCMS', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `description` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'editor', 'General User');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`type`) REFERENCES `account_types` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_types` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`language`) REFERENCES `language` (`value`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`account`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
