-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 22, 2013 at 10:49 PM
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

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `type` mediumint(11) NOT NULL,
  `created_on` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_id` (`account_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_id`, `type`, `created_on`) VALUES
(1, 'aYqeViE2mOcGa', 1, 1349975615),
(2, 'a0qeViE2mOcGa', 1, 1349975615);

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

DROP TABLE IF EXISTS `account_types`;
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
-- Table structure for table `activate`
--

DROP TABLE IF EXISTS `activate`;
CREATE TABLE `activate` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sid` varchar(12) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `template` tinyint(4) NOT NULL,
  `gallery` tinyint(4) NOT NULL,
  `document` tinyint(4) NOT NULL,
  `history` tinyint(4) NOT NULL,
  `rss` tinyint(4) NOT NULL,
  `seo` tinyint(4) NOT NULL,
  `navigation` tinyint(4) NOT NULL,
  `page_permission` tinyint(4) NOT NULL,
  `analytics` tinyint(4) NOT NULL,
  `optimization` tinyint(4) NOT NULL,
  `includes` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sid` (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `activate`
--

INSERT INTO `activate` (`id`, `sid`, `template`, `gallery`, `document`, `history`, `rss`, `seo`, `navigation`, `page_permission`, `analytics`, `optimization`, `includes`) VALUES
(1, 'sga9DS7zWzfR', 1, 1, 0, 0, 0, 1, 0, 0, 1, 1, 0),
(2, 'sE59DS7zWzfR', 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE latin1_general_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('4975e9d452b61ef9b61867c05901268d', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22', 1363903833, 'a:12:{s:9:"user_data";s:0:"";s:8:"identity";s:22:"braxtondiggs@gmail.com";s:12:"identity_QID";s:13:"uPjTuxiRz9fOH";s:3:"QID";s:13:"uPjTuxiRz9fOH";s:7:"account";s:13:"aYqeViE2mOcGa";s:5:"email";s:22:"braxtondiggs@gmail.com";s:7:"user_id";s:1:"5";s:14:"old_last_login";s:10:"1363813374";s:10:"first_name";s:7:"Braxton";s:9:"last_name";s:5:"Diggs";s:9:"user_type";s:1:"1";s:12:"account_type";s:1:"1";}');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `text` varchar(128) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `value` varchar(5) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `value` (`value`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

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

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(16) COLLATE latin1_general_ci NOT NULL,
  `login` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
CREATE TABLE `sites` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `created_by` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `account` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `sid` varchar(12) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `name` varchar(128) COLLATE latin1_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `server` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `ftp_username` varchar(64) COLLATE latin1_general_ci NOT NULL,
  `ftp_password` varchar(150) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `path` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `keyword` varchar(128) COLLATE latin1_general_ci NOT NULL,
  `ftp_mode` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `ftp_port` int(4) NOT NULL,
  `ftp_secure` tinyint(1) NOT NULL,
  `has_key` int(1) NOT NULL,
  `extra_password` varchar(128) COLLATE latin1_general_ci NOT NULL,
  `color` varchar(7) COLLATE latin1_general_ci NOT NULL,
  `wysiwyg_1` text COLLATE latin1_general_ci NOT NULL,
  `wysiwyg_2` text COLLATE latin1_general_ci NOT NULL,
  `modified_user` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Site` (`url`),
  UNIQUE KEY `SID` (`sid`),
  KEY `Owner` (`created_by`),
  KEY `modified_user` (`modified_user`),
  KEY `account` (`account`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `created_by`, `created_date`, `account`, `sid`, `url`, `name`, `active`, `server`, `ftp_username`, `ftp_password`, `path`, `keyword`, `ftp_mode`, `ftp_port`, `ftp_secure`, `has_key`, `extra_password`, `color`, `wysiwyg_1`, `wysiwyg_2`, `modified_user`, `modified_date`) VALUES
(1, 'uPjTuxiRz9fOH', '0000-00-00 00:00:00', 'aYqeViE2mOcGa', 'sga9DS7zWzfR', 'http://www.cymbit.com/', 'Cymbit CMS', 1, 'cymbit.com', 'braxtond@cymbit.com', '2J42@7k7n*a_', '/demo/index.html', 'new_keyword', 'Passive', 21, 0, 0, '', '', '', '', 'uPjTuxiRz9fOH', '0000-00-00 00:00:00'),
(2, 'uPjTuxiRz9fOH', '0000-00-00 00:00:00', 'aYqeViE2mOcGa', 'sE59DS7zWzfR', 'http://www.example2222site.com/', 'Example Company Site', 1, 'address', 'username', 'password', 'path', 'new_keyword', 'Passive', 21, 0, 0, '', '', '', '', 'uPjTuxiRz9fOH', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

DROP TABLE IF EXISTS `templates`;
CREATE TABLE `templates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `html` longtext COLLATE latin1_general_ci NOT NULL,
  `js` longtext COLLATE latin1_general_ci NOT NULL,
  `css` longtext COLLATE latin1_general_ci NOT NULL,
  `created_by` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(128) COLLATE latin1_general_ci NOT NULL,
  `tid` varchar(12) COLLATE latin1_general_ci NOT NULL,
  `sid` varchar(12) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tid` (`tid`),
  UNIQUE KEY `modified_user` (`modified_user`),
  KEY `sid` (`sid`),
  KEY `created_by` (`created_by`,`modified_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `html`, `js`, `css`, `created_by`, `created_date`, `modified_user`, `modified_date`, `name`, `tid`, `sid`) VALUES
(2, 'HTML Goes HEREsd', 'JS goes Heresd Hello', 'CSs Goes Heresdsdf', 'u9jTuxiRz9fOf', '2013-03-19 04:00:00', 'u9jTuxiRz9fOf', '2013-03-19 21:08:50', 'Test Templatedfsdxcsdsd', '459DS7zWzfR', 'sga9DS7zWzfR'),
(3, 'dfvdfv', 'dfvdfv', 'dfvdv', 'uPjTuxiRz9fOH', '0000-00-00 00:00:00', 'uPjTuxiRz9fOH', '2013-03-20 21:47:39', 'dfvdfv', 'teN8TJpjvOs0', 'sga9DS7zWzfR');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
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
  UNIQUE KEY `username` (`username`),
  KEY `user_type` (`user_type`),
  KEY `language` (`language`),
  KEY `account` (`account`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `account`, `first_name`, `last_name`, `user_type`, `language`, `has_demo`, `provider`, `all_one`, `all_one_id`) VALUES
(5, '\0\0', 'uPjTuxiRz9fOH', '291df99500ce620bd3d03131e66d0d78c6318363', '0ad853e514', 'braxtondiggs@gmail.com', NULL, NULL, NULL, 'd2eae6562b2d28b0f5bf43aea28e201706a3aaf1', 1349975615, 1363883893, 1, 'aYqeViE2mOcGa', 'Braxton', 'Diggs', 1, 'en', 1, 'CymbitCMS', NULL, NULL),
(6, '7f000001', 'u9jTuxiRz9fOf', '', '0ad853e514', '123braxtondiggs@gmail.com', NULL, NULL, NULL, NULL, 1349975615, 1350329734, 1, 'aYqeViE2mOcGa', 'John', 'Doe', 2, 'en', 1, 'CymbitCMS', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE `user_types` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(100) COLLATE latin1_general_ci NOT NULL,
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
-- Constraints for table `activate`
--
ALTER TABLE `activate`
  ADD CONSTRAINT `activate_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `sites` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sites`
--
ALTER TABLE `sites`
  ADD CONSTRAINT `sites_ibfk_2` FOREIGN KEY (`modified_user`) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sites_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sites_ibfk_4` FOREIGN KEY (`account`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `templates_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `sites` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `templates_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `templates_ibfk_3` FOREIGN KEY (`modified_user`) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
