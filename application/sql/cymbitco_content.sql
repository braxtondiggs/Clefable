-- phpMyAdmin SQL Dump
-- version 3.4.10.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 02, 2012 at 11:30 AM
-- Server version: 5.1.65
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cymbitco_content`
--

-- --------------------------------------------------------

--
-- Table structure for table `Accounts`
--

DROP TABLE IF EXISTS `Accounts`;
CREATE TABLE IF NOT EXISTS `Accounts` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `AID` varchar(12) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `AID` (`AID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `Accounts`
--

INSERT INTO `Accounts` (`ID`, `AID`, `date`) VALUES
(1, 'A2BtoDTQI0b8', '2012-09-08 01:17:35'),
(6, 'AQl9NQ5cwdth', '0000-00-00 00:00:00'),
(7, 'AlExOCZUrbnv', '2012-09-30 06:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `Activate`
--

DROP TABLE IF EXISTS `Activate`;
CREATE TABLE IF NOT EXISTS `Activate` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `SID` varchar(12) NOT NULL,
  `Templates` tinyint(1) NOT NULL,
  `Gallery` tinyint(1) NOT NULL,
  `Doc` tinyint(1) NOT NULL,
  `History` tinyint(1) NOT NULL,
  `RSS` tinyint(1) NOT NULL,
  `SEO` tinyint(1) NOT NULL,
  `Navigation` tinyint(1) NOT NULL,
  `PagePer` tinyint(1) NOT NULL,
  `Analytics` tinyint(1) NOT NULL,
  `ImgOpt` tinyint(1) NOT NULL,
  `SSIncludes` tinyint(1) NOT NULL,
  UNIQUE KEY `id` (`ID`),
  KEY `SID` (`SID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Activate`
--

INSERT INTO `Activate` (`ID`, `SID`, `Templates`, `Gallery`, `Doc`, `History`, `RSS`, `SEO`, `Navigation`, `PagePer`, `Analytics`, `ImgOpt`, `SSIncludes`) VALUES
(0, 'XOujlec', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, 'hHgFRtt', 1, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(2, 'EYtlTGy', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Clients`
--

DROP TABLE IF EXISTS `Clients`;
CREATE TABLE IF NOT EXISTS `Clients` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `Name` varchar(64) NOT NULL,
  `Text` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `Clients`
--

INSERT INTO `Clients` (`ID`, `Name`, `Text`) VALUES
(1, 'Paul, USA', 'You''ll be pleased to hear this. All looks good. Let''s go ahead and install to production. I am more than happy to continue using your services in the future.'),
(2, 'Iain Henderson, Australia.', 'I''ve been checking out the CMS over the last few days, and I''ve got to congratulate you. The system is a lot larger than I initially thought it was, and considering the complexities of managing all that information over different countries/languages I think you''ve done an excellent job. I''ve written a couple of simple management systems using PHP, but I''ve never worked with anything this scale. Well done guys.'),
(3, 'William Arsenis, USA', 'I would like to say that you do excellent work and I would recommend Cymbit CMS to any company interested in creating a professional website for today''s very demanding market. It has truly been a pleasure.'),
(4, 'Robert Rutherford, UK', 'I would also like to just say thanks to you and your team and your work so far with us. I''m very happy with the way this is working out, and your team''s responsiveness.'),
(5, 'Ruxandra Aldea, Canada', 'I was mostly impressed with the responsiveness that the team has shown to my needs throughout the project. They went above and beyond to deliver the project as promised. Even more, they took the initiative to make some really nice design recommendations and implementation in addition to my communicated requirements to improve the consistency of the web site.'),
(6, 'Mark Harris, UK', 'Its all looking very, very impressive, you guys are skilled and offer by anyone''s standards, very high-end services! I am so pleased and so very impressed. Really good job!'),
(7, 'Andre Pecina, Sanger, CA', 'It looks really good. I have received a lot of positive feedback from friends and associates. They all have said that it looks very professional. GREAT JOB! Thanks to you and your staff. I am also pleased with the user-friendliness of the CMS. It is far superior to the other company that I have used in the past. GREAT JOB! You are the Best!'),
(8, 'Vaughan King, Peterborough, Canada', 'Your service was great. Very prompt and efficient.'),
(9, 'Courtney Roddicks, Sydney,Australia', 'It Looks great. Our project is looking great with fantastic potential.');

-- --------------------------------------------------------

--
-- Table structure for table `CMS`
--

DROP TABLE IF EXISTS `CMS`;
CREATE TABLE IF NOT EXISTS `CMS` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `Title` varchar(56) NOT NULL,
  `Text` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `CMS`
--

INSERT INTO `CMS` (`ID`, `Title`, `Text`) VALUES
(1, 'Privacy Policy', '<p>By accessing the CymbitCMS website ("Site") or using the services offered by CymbitCMS ("Services") you agree and acknowledge to be bound by these Terms of Service ("Terms"). If you do not agree to these Terms or to our Privacy Policy, please do not access the Site or use the Services. We reserve the right to change these Terms at any time. We recommend that you periodically check this Site for changes.</p>\r\n\r\n<p>CymbitCMS grants you a limited license to access the Site and use the Services in accordance with these Terms and the instructions and guidelines posted on the Site. CymbitCMS reserves the rights to terminate your license to use the Site and Services at any time and for any reason or in the future charge for commercial usage.</p>\r\n\r\n<p>You are solely responsible for your use of the Site and Services. CymbitCMS allows for the posting of content to third-party websites. The third-party websites'' content, business practices and privacy policies are not under our control, and we are not responsible for the content of any third-party website or any link contained in a third-party website.</p>\r\n\r\n<p>CymbitCMS accesses and stores sensitive website login data as part of its daily operations. While we will take every reasonable precaution to secure these details (including the use of database data encryption), we will not accept any responsibility or liability for actions that may result from this data being intercepted or accessed by an unauthorized third-party.</p>\r\n\r\n<p>CymbitCMS PROVIDES THE SITE AND SERVICES "AS IS" AND WITHOUT ANY WARRANTY OR CONDITION, EXPRESS, IMPLIED OR STATUTORY. CymbitCMS SPECIFICALLY DISCLAIMS ANY IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, NON-INFRINGEMENT, INFORMATION ACCURACY, INTEGRATION, INTEROPERABILITY OR QUIET ENJOYMENT. Some states do not allow the disclaimer of implied warranties, so the foregoing disclaimer may not apply to you.</p>\r\n\r\n<p>You understand and agree that you use the Site and Services at your own discretion and risk and that you will be solely responsible for any damages that arise from such use. UNDER NO CIRCUMSTANCES SHALL CymbitCMS BE LIABLE FOR ANY DIRECT, INDIRECT, SPECIAL, INCIDENTAL, CONSEQUENTIAL OR PUNITIVE DAMAGES OF ANY KIND, OR ANY OTHER DAMAGES WHATSOEVER (HOWEVER ARISING, INCLUDING BY NEGLIGENCE), INCLUDING WITHOUT LIMITATION, DAMAGES RELATED TO USE, MISUSE, RELIANCE ON, INABILITY TO USE AND INTERRUPTION, SUSPENSION, OR TERMINATION OF THE SITE OR SERVICES, DAMAGES INCURRED THROUGH ANY LINKS PROVIDED ON THE SITE AND THE NONPERFORMANCE THEREOF AND DAMAGES RESULTING FROM LOSS OF USE, SALES, DATA, GOODWILL OR PROFITS, WHETHER OR NOT CymbitCMS HAS BEEN ADVISED OF SUCH POSSIBILITY. YOUR ONLY RIGHT WITH RESPECT TO ANY DISSATISFACTION WITH THIS SITE OR SERVICES OR WITH CymbitCMS SHALL BE TO TERMINATE USE OF THIS SITE AND SERVICES. Some states do not allow the exclusion of liability for incidental or consequential damages, so the above exclusions may not apply to you.</p>'),
(2, 'Terms of Service', '<p>By accessing the CymbitCMS website ("Site") or using the services offered by CymbitCMS ("Services") you agree and acknowledge to be bound by these Terms of Service ("Terms"). If you do not agree to these Terms or to our Privacy Policy, please do not access the Site or use the Services. We reserve the right to change these Terms at any time. We recommend that you periodically check this Site for changes.</p>\r\n<br />\r\n<h2>Usage License</h2>\r\n\r\n<p>CymbitCMS grants you a limited license to access the Site and use the Services in accordance with these Terms and the instructions and guidelines posted on the Site. CymbitCMS reserves the rights to terminate your license to use the Site and Services at any time and for any reason or in the future charge for commercial usage.</p>\r\n<br />\r\n<h2>User Responsibility</h2>\r\n\r\n<p>You are solely responsible for your use of the Site and Services. CymbitCMS allows for the posting of content to third-party websites. The third-party websites'' content, business practices and privacy policies are not under our control, and we are not responsible for the content of any third-party website or any link contained in a third-party website.</p>\r\n<br />\r\n<h2>Security</h2>\r\n\r\n<p>CymbitCMS accesses and stores sensitive website login data as part of its daily operations. While we will take every reasonable precaution to secure these details (including the use of database data encryption), we will not accept any responsibility or liability for actions that may result from this data being intercepted or accessed by an unauthorized third-party.</p>\r\n<br />\r\n<h2>Other</h2>\r\n\r\n<p>CymbitCMS PROVIDES THE SITE AND SERVICES "AS IS" AND WITHOUT ANY WARRANTY OR CONDITION, EXPRESS, IMPLIED OR STATUTORY. CymbitCMS SPECIFICALLY DISCLAIMS ANY IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, NON-INFRINGEMENT, INFORMATION ACCURACY, INTEGRATION, INTEROPERABILITY OR QUIET ENJOYMENT. Some states do not allow the disclaimer of implied warranties, so the foregoing disclaimer may not apply to you.</p>\r\n\r\n<p>You understand and agree that you use the Site and Services at your own discretion and risk and that you will be solely responsible for any damages that arise from such use. UNDER NO CIRCUMSTANCES SHALL CymbitCMS BE LIABLE FOR ANY DIRECT, INDIRECT, SPECIAL, INCIDENTAL, CONSEQUENTIAL OR PUNITIVE DAMAGES OF ANY KIND, OR ANY OTHER DAMAGES WHATSOEVER (HOWEVER ARISING, INCLUDING BY NEGLIGENCE), INCLUDING WITHOUT LIMITATION, DAMAGES RELATED TO USE, MISUSE, RELIANCE ON, INABILITY TO USE AND INTERRUPTION, SUSPENSION, OR TERMINATION OF THE SITE OR SERVICES, DAMAGES INCURRED THROUGH ANY LINKS PROVIDED ON THE SITE AND THE NONPERFORMANCE THEREOF AND DAMAGES RESULTING FROM LOSS OF USE, SALES, DATA, GOODWILL OR PROFITS, WHETHER OR NOT CymbitCMS HAS BEEN ADVISED OF SUCH POSSIBILITY. YOUR ONLY RIGHT WITH RESPECT TO ANY DISSATISFACTION WITH THIS SITE OR SERVICES OR WITH CymbitCMS SHALL BE TO TERMINATE USE OF THIS SITE AND SERVICES. Some states do not allow the exclusion of liability for incidental or consequential damages, so the above exclusions may not apply to you.</p>\r\n\r\n<p>CymbitCMS and you are independent entities, and nothing in the Terms, or via use of the Site or Services, will create any partnership, joint venture, agency, franchise, sales representative, or employment relationship between CymbitCMS and you.</p>\r\n\r\n<p>These Terms supersede any previous agreement and represent the entire agreement between CymbitCMS and you. These Terms are governed by the laws of the State of New York without reference to conflict of laws principles. If any provision of the Terms is adjudged to be illegal or unenforceable, the continuation in full force of the remainder of the Terms will not be prejudiced, and the illegal or unenforceable provision of the Terms shall be severed accordingly.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `Folder`
--

DROP TABLE IF EXISTS `Folder`;
CREATE TABLE IF NOT EXISTS `Folder` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `Owner` varchar(12) NOT NULL,
  `SID` varchar(12) NOT NULL,
  `FID` varchar(12) NOT NULL,
  `Path` varchar(512) NOT NULL,
  `Date` datetime NOT NULL,
  UNIQUE KEY `FID` (`FID`),
  UNIQUE KEY `ID` (`ID`),
  KEY `Owner` (`Owner`),
  KEY `SID` (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Gritter`
--

DROP TABLE IF EXISTS `Gritter`;
CREATE TABLE IF NOT EXISTS `Gritter` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `GritID` varchar(12) NOT NULL,
  `Title` varchar(256) NOT NULL,
  `Text` text NOT NULL,
  `Icon` varchar(128) CHARACTER SET ucs2 NOT NULL,
  `Type` varchar(64) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `GritID` (`GritID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `Gritter`
--

INSERT INTO `Gritter` (`ID`, `GritID`, `Title`, `Text`, `Icon`, `Type`) VALUES
(1, 'Srv8h2qwvc1', 'Welcome To CymbitCMS!', 'Make sure to check out the <a href="#">Demo Site</a>. If you need help check out the <a href="#">FAQ</a> page or the <a href="#">tutorial</a>. ', 'smiley-lol', 'basic'),
(2, 'bjwUietmM8D', 'Houston, we have a problem!', 'You already have this group associated with this user.', 'cross-circle', 'basic'),
(3, 'KmanQto2h5Z', 'Coming Very Soon!', 'We are still in the process of building or testing this functionality, please try this again at a later time or subscribe to our build log!', 'system-monitor', 'basic'),
(4, 'TeZ4Jr6Bg7L', 'This probably isn''t work!', 'We are aware of of this issue and we are extremely busy trying to fix this as soon as possible.', 'system-monitor', 'basic'),
(5, 't0f2UTH88a2', 'Houston, we have a problem!', 'You already have this button already in your toolbar.', 'cross-circle', 'basic'),
(6, 'tl6gVu2JEwK', 'Site has been deleted!', 'The site has been permanently deleted from our database, including all of it''s child pages, history and permission.<p>&nbsp;</p><p><strong>*Note</strong>: Your site still exists on your server.</p>', 'cross', 'basic'),
(7, 'Us9S0v87yok', 'Page has been deleted!', 'The page has been permanently deleted from our database, including all of its editable sections, history and permission.<p>&nbsp;</p><p><strong>*Note</strong>: Your page still exists on your server.</p>', 'cross', 'basic'),
(8, 'JNdLiw1gTGs', 'User has been deleted!', 'The user has been permanently deleted from our database, please inform the user of any changes.', 'cross', 'basic'),
(9, 'rn8hx0d4pZO', 'Group has been deleted!', 'The group has been deleted from our database.<p>&nbsp;</p><p><strong>*Note</strong>: Make sure to check your sites due to changes to it''s permission.</p>', 'cross', 'basic'),
(10, 'p60TQHoa0PV', 'CMS 2.0!', 'We automatically detected some values for you. Please fill in the rest of the site details below.', 'information', 'basic'),
(11, 'KIybYHbLt2B', 'User has been saved!', 'User information has been updated, if you have edited an editor please advise them on the changes.', 'user', 'basic'),
(12, 'iBK7mPsnYFI', 'User has been added!', 'User has been added to your account. An email has been sent to the provided emaill address, with information how to log in.', 'user-business', 'basic'),
(13, 'QRo6x6R2LEE', 'Group has been updated!', 'The permission that you have set are now in  effect! Please inform any users that their permission my have been changed.', 'wooden-box-label', 'basic'),
(14, 'bnyu2zgjzKx', 'Site has been updated!', 'Filled Text', 'globe-green', 'basic'),
(15, 'Ym85qbNIvIq', 'Site has been created!', 'Your site information has been updated!', 'globe-green', 'basic'),
(16, 'UtVkB6h1f06', 'Impersonation Active ', 'You are currently impersonating another user and you can see everything as they would in their account.To exit out of impersonation mode just click the banner above.', 'user-business-boss', 'basic'),
(17, 'TuyhWspKRtz', 'Select A Group First', 'To select a group just click the blue bar with name of the group you want. The <span style="color:#0078AE">blue</span> bar should turn <span style="color:#6EAC2C ">green</span> when it has been selected.', 'exclamation', 'basic'),
(18, 'mK2wx4nuWYV', 'Group has been removed!', 'The group has been removed from this user.', 'cross', 'basic'),
(19, 'CKkhWiwaTYB', 'Page has been saved!', 'Page information has been updated. Inorder for information to be updated on your site you must publish any information.', 'blue-document-import', 'basic'),
(20, 'QzorvGepRMb', 'Cut successful', 'Element has been successfully saved to clipboard.', 'scissors-blue', 'basicapp'),
(21, 'hP7aEgQZSAR', 'Copy successful', 'Element has been successfully saved to clipboard.', 'blue-document-copy', 'basicapp'),
(22, 'PH1EM2bgOoi', 'Alert: We found something!', 'It looks like you are using an AdBlock program? If not, click here to <a href="#" class="adblock_revert">revert</a>', 'soap', 'basicapp'),
(23, 'V87dMEgHPN6', 'Page Reverted!', 'Your code has been restored back to the way it orginal was.', 'arrow-circle', 'basicapp'),
(24, 'QR76zl561oe', 'Ooopps: Paste error!', 'Please <strong>Copy</strong> or <strong>Cut</strong> an element first before trying to paste.', 'exclamation', 'basicapp'),
(25, 'XNRtkb1QXfI', 'Delete successful', 'Element has been successfully deleted from page.', 'eraser', 'basicapp'),
(26, 'NW53Jua4TzQ', 'Ooopps: Copy/Cut error!', 'Please select an element first before trying to copy or cut. A yellow box should appear around the element.', 'exclamation', 'basicapp'),
(27, 'uqBM6Vkr80F', 'Delete is succesful!', 'Image has been succesfully delete from yout server. ', 'cross', 'basic'),
(28, 'GrHwam2yIlhP', 'Folder has been added!', 'The folder has been added to your local site.', 'folder', 'basic'),
(29, 'GrmI2TxC6VfH', 'Your image has changed!', 'Your image has been updated and published to your live server.', 'image-sunset', 'basic'),
(30, 'GrfS16S6Zi23', 'Site URL', 'The Site URL is used by Cymbit CMS to determine where to start editing your site, as well as the default index file name for your site (for example: index.php, index.html, default.aspx, etc.) The value in this box should appear exactly as it does in your web browser.', 'question', 'basic-help'),
(31, 'GrPK0xb96x7K', 'Site Name', 'You should set the site name to anything that specifically identifies this site. By default, we pull up the homepage title and use it as the site name.', 'question', 'basic-help'),
(32, 'Gry9RlUelpz1', 'FTP Address', 'This is the address you use to access your site via FTP, usually it will be the same as your web address. So, for example, if your web address is <i>www.mysite.com</i>, then your FTP could be something like <i>www.mysite.com</i> or <i>ftp.mysite.com</i>.', 'question', 'basic-help'),
(33, 'GrNy8imLSA7V', 'FTP Username', '<p>This is the user account you use to access your FTP server.</p>\r\n<br />\r\n<b style="color:red;">IMPORTANT:</b>\r\n<p>Make sure that this user has read and write permission to your FTP server!</p>', 'question', 'basic-help'),
(34, 'GrJM14GzVjur', 'FTP Password', 'This is the password you use to access your FTP server.', 'question', 'basic-help'),
(35, 'GrPOCiP5xNZw', 'FTP Home Page Path', '<p>Cymbit CMS needs to know where to find HTML files on your server. In this field, enter the path to your homepage () on your FTP server, or use the browse button on the right to find, and select it.</p><br />\r\n<p>The reason we ask for this is because in some cases FTP servers start outside your HTML folder, and you need to enter a special directory to get to the root of your HTML files.</p>', 'question', 'basic-help'),
(36, 'GrVYECoDQJM4', 'Template has been created!', 'Your template has been created! You can now create new pages with this template.', 'blue-document-copy', 'basic'),
(37, 'Grx5je36ZL9q', 'Template has been updated!', 'Your template information has been updated! All the pages that use this template are now updated.', 'blue-document-import', 'basic');

-- --------------------------------------------------------

--
-- Table structure for table `Groups`
--

DROP TABLE IF EXISTS `Groups`;
CREATE TABLE IF NOT EXISTS `Groups` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `GID` varchar(12) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Owner` varchar(12) NOT NULL,
  `Applied` varchar(12) NOT NULL,
  `Type` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `GID` (`GID`),
  KEY `Owner` (`Owner`),
  KEY `Applied` (`Applied`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `Groups`
--

INSERT INTO `Groups` (`ID`, `GID`, `Name`, `Owner`, `Applied`, `Type`) VALUES
(1, 'E6fG7BAHXjP', 'Basic Group', 'A2BtoDTQI0b8', 'rxwEDNWrHi0', 'Site'),
(48, 'GPg61oHpphKF', 'Basic Group', 'AQl9NQ5cwdth', 'QZHlr4pj9mns', 'Site'),
(49, 'GvxnIhbv0zLe', 'Basic Group', 'AlExOCZUrbnv', 'QZ7Qrjvin4qs', 'Site');

-- --------------------------------------------------------

--
-- Table structure for table `Group_Sites`
--

DROP TABLE IF EXISTS `Group_Sites`;
CREATE TABLE IF NOT EXISTS `Group_Sites` (
  `ID` int(10) NOT NULL,
  `GSID` varchar(12) NOT NULL,
  `SID` varchar(12) NOT NULL,
  `GID` varchar(12) NOT NULL,
  `create` tinyint(1) NOT NULL,
  `read` tinyint(1) NOT NULL,
  `modify` tinyint(1) NOT NULL,
  `delete` tinyint(1) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `GSID` (`GSID`),
  KEY `GID` (`GID`),
  KEY `SID` (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Group_Sites`
--

INSERT INTO `Group_Sites` (`ID`, `GSID`, `SID`, `GID`, `create`, `read`, `modify`, `delete`, `publish`) VALUES
(1, 'GSIUSff6Z7GS', 'hHgFRtt', 'E6fG7BAHXjP', 1, 1, 0, 0, 0),
(2, 'GScX9XjzRs15', 'EYtlTGy', 'E6fG7BAHXjP', 1, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `History`
--

DROP TABLE IF EXISTS `History`;
CREATE TABLE IF NOT EXISTS `History` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `HID` varchar(12) NOT NULL,
  `PID` varchar(12) NOT NULL,
  `Content` longtext NOT NULL,
  `modifed_user` varchar(12) NOT NULL,
  `modified_date` datetime NOT NULL,
  `Type` varchar(128) CHARACTER SET ucs2 NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `HID` (`HID`),
  KEY `PID` (`PID`),
  KEY `modifed_user` (`modifed_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `History`
--

INSERT INTO `History` (`ID`, `HID`, `PID`, `Content`, `modifed_user`, `modified_date`, `Type`) VALUES
(1, 'WyTxHjwCCZG', 'UbVyENf', '<head>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<title>Untitled Document</title>\n<link href="http://cymbit.com/css/main.css" rel="stylesheet" type="text/css">\n<style></style>\n</head>\n\n<body>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<h1 align="center">No Videos Available</h1>\n<img src="http://cymbit.com/images/index_10.jpg" width="453" height="100" class="cms">\n\n<a href="http://cymbit.com/Contact.php"> Hello</a>\n\n<p>&nbsp;</p>\n<div class="cms"><p>\n	FCKeditor has been around for more than six years. Since 2003 it has built a strong user community becoming the most used editor in the market, accumulating more than 3,5 million downloads. In 2009, we decided to rename the editor, bringing to light the next generation of our software: CKEditor 3.0.</p>\n<p>\n	CKEditor inherits the quality and strong features people were used to find in FCKeditor, in a much more modern product, added by dozens of new benefits, like accessibility and ultimate performance. I love CMYBIT CMS, More love for Cymbit CMS MORE MORE LOVE</p>\n</div>\n\n\n</body>', 'YJimMBgjWP2', '2011-08-06 01:29:21', 'Paragraph Change'),
(2, 'arMXw7F644d', 'UbVyENf', '<head>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<title>Untitled Document</title>\n<link href="http://cymbit.com/css/main.css" rel="stylesheet" type="text/css">\n<style></style>\n</head>\n\n<body>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<h1 align="center">No Videos Available</h1>\n<img src="http://cymbit.com/images/index_10.jpg" width="453" height="100" class="cms">\n\n<a href="http://cymbit.com/Contact.php"> Hello</a>\n\n<p>&nbsp;</p>\n<div class="cms"><p>\n	FCKeditor has been around for more than six years. Since 2003 it has built a strong user community becoming the most used editor in the market, accumulating more than 3,5 million downloads. In 2009, we decided to rename the editor, bringing to light the next generation of our software: CKEditor 3.0.</p>\n<p>\n	CKEditor inherits the quality and strong features people were used to find in FCKeditor, in a much more modern product, added by dozens of new benefits, like accessibility and ultimate performance. I love CMYBIT CMS, More love for Cymbit CMS MORE MORE LOVE DELETE</p>\n</div>\n\n\n</body>', 'YJimMBgjWP2', '2011-08-06 01:59:15', 'Paragraph Change'),
(3, 'pJU1cQizPDb', 'UbVyENf', '<head>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<title>Untitled Document</title>\n<link href="http://cymbit.com/css/main.css" rel="stylesheet" type="text/css">\n<style></style>\n</head>\n\n<body>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<h1 align="center">No Videos Available</h1>\n<img src="http://cymbit.com/images/index_10.jpg" width="453" height="100" class="cms">\n\n<a href="http://cymbit.com/Contact.php"> Hello</a>\n\n<p>&nbsp;</p>\n<div class="cms"><p>\n	FCKeditor has been around for more than six years. Since 2003 it has built a strong user community becoming the most used editor in the market, accumulating more than 3,5 million downloads. In 2009, we decided to rename the editor, bringing to light the next generation of our software: CKEditor 3.0.</p>\n<p>\n	CKEditor inherits the quality and strong features people were used to find in FCKeditor, in a much more modern product, added by dozens of new benefits, like accessibility and ultimate performance. I love CMYBIT CMS, More love for Cymbit CMS MORE MORE LOVE DELETE</p>\n</div>\n\n\n</body>', 'YJimMBgjWP2', '2011-08-06 02:07:09', 'Paragraph Change'),
(4, 'reKRtCzt3m3', 'UbVyENf', '<head>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<title>Untitled Document</title>\n<link href="http://cymbit.com/css/main.css" rel="stylesheet" type="text/css">\n<style></style>\n</head>\n\n<body>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<h1 align="center">No Videos Available</h1>\n<img src="http://cymbit.com/images/index_10.jpg" width="453" height="100" class="cms">\n\n<a href="http://cymbit.com/Contact.php"> Hello</a>\n\n<p>&nbsp;</p>\n<div class="cms"><p>\n	FCKeditor has been around for more than six years. Since 2003 it has built a strong user community becoming the most used editor in the market, accumulating more than 3,5 million downloads. In 2009, we decided to rename the editor, bringing to light the next generation of our software: CKEditor 3.0.</p>\n<p>\n	CKEditor inherits the quality and strong features people were used to find in FCKeditor, in a much more modern product, added by dozens of new benefits, like accessibility and ultimate performance. I love CMYBIT CMS, More love for Cymbit CMS MORE MORE LOVE DELETE</p>\n</div>\n\n\n</body>', 'YJimMBgjWP2', '2011-08-06 02:08:18', 'Paragraph Change'),
(5, 'RsKL0FEEhuu', 'UbVyENf', '<head>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<title>Untitled Document</title>\n<link href="http://cymbit.com/css/main.css" rel="stylesheet" type="text/css">\n<style></style>\n</head>\n\n<body>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<h1 align="center">No Videos Available</h1>\n<img src="http://cymbit.com/images/index_10.jpg" width="453" height="100" class="cms">\n\n<a href="http://cymbit.com/Contact.php"> Hello</a>\n\n<p>&nbsp;</p>\n<div class="cms"><p>\n	FCKeditor has been around for more than six years. Since 2003 it has built a strong user community becoming the most used editor in the market, accumulating more than 3,5 million downloads. In 2009, we decided to rename the editor, bringing to light the next generation of our software: CKEditor 3.0.</p>\n<p>\n	CKEditor inherits the quality and strong features people were used to find in FCKeditor, in a much more modern product, added by dozens of new benefits, like accessibility and ultimate performance. I love CMYBIT CMS, More love for Cymbit CMS MORE MORE LOVE DELETE</p>\n</div>\n\n\n</body>', 'YJimMBgjWP2', '2011-08-06 02:09:14', 'Paragraph Change'),
(6, 'Jo07OLiMpld', 'UbVyENf', '<head>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<title>Untitled Document</title>\n<link href="http://cymbit.com/css/main.css" rel="stylesheet" type="text/css">\n<style></style>\n</head>\n\n<body>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<h1 align="center">No Videos Available</h1>\n<img src="http://cymbit.com/images/index_10.jpg" width="453" height="100" class="cms">\n\n<a href="http://cymbit.com/Contact.php"> Hello</a>\n\n<p>&nbsp;</p>\n<div class="cms"><p>\n	FCKeditor has been around for more than six years. Since 2003 it has built a strong user community becoming the most used editor in the market, accumulating more than 3,5 million downloads. In 2009, we decided to rename the editor, bringing to light the next generation of our software: CKEditor 3.0.</p>\n<p>\n	CKEditor inherits the quality and strong features people were used to find in FCKeditor, in a much more modern product, added by dozens of new benefits, like accessibility and ultimate performance. I love CMYBIT CMS, More love for Cymbit CMS MORE MORE LOVE DELETE</p>\n</div>\n\n\n</body>', 'YJimMBgjWP2', '2011-08-06 02:09:59', 'Paragraph Change'),
(7, 'Z1IqFg0jd5Z', 'UbVyENf', '<head>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<title>Untitled Document</title>\n<link href="http://cymbit.com/css/main.css" rel="stylesheet" type="text/css">\n<style></style>\n</head>\n\n<body>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<h1 align="center">No Videos Available</h1>\n<img src="http://cymbit.com/images/index_10.jpg" width="453" height="100" class="cms">\n\n<a href="http://cymbit.com/Contact.php"> Hello</a>\n\n<p>&nbsp;</p>\n<div class="cms"><p>\n	FCKeditor has been around for more than six years. Since 2003 it has built a strong user community becoming the most used editor in the market, accumulating more than 3,5 million downloads. In 2009, we decided to rename the editor, bringing to light the next generation of our software: CKEditor 3.0.</p>\n<p>\n	CKEditor inherits the quality and strong features people were used to find in FCKeditor, in a much more modern product, added by dozens of new benefits, like accessibility and ultimate performance. I love CMYBIT CMS, More love for Cymbit CMS MORE MORE LOVE DELETE</p>\n</div>\n\n\n</body>', 'YJimMBgjWP2', '2011-08-06 02:13:10', 'Paragraph Change'),
(8, 'M9ihVEqAOi2', 'UbVyENf', '<head>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<title>Untitled Document</title>\n<link href="http://cymbit.com/css/main.css" rel="stylesheet" type="text/css">\n<style></style>\n</head>\n\n<body>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<h1 align="center">No Videos Available</h1>\n<img src="http://cymbit.com/images/index_10.jpg" width="453" height="100" class="cms">\n\n<a href="http://cymbit.com/Contact.php"> Hello</a>\n\n<p>&nbsp;</p>\n<div class="cms"><p>\n	FCKeditor has been around for more than six years. Since 2003 it has built a strong user community becoming the most used editor in the market, accumulating more than 3,5 million downloads. In 2009, we decided to rename the editor, bringing to light the next generation of our software: CKEditor 3.0.</p>\n<p>\n	CKEditor inherits the quality and strong features people were used to find in FCKeditor, in a much more modern product, added by dozens of new benefits, like accessibility and ultimate performance. I love CMYBIT CMS, More love for Cymbit CMS MORE MORE LOVE DELETE</p>\n</div>\n\n\n</body>', 'YJimMBgjWP2', '2011-08-06 02:16:40', 'Paragraph Change'),
(9, 'ByIvlLSv6eW', 'UbVyENf', '<head>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<title>Untitled Document</title>\n<link href="http://cymbit.com/css/main.css" rel="stylesheet" type="text/css">\n<style></style>\n</head>\n\n<body>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<h1 align="center">No Videos Available</h1>\n<img src="http://cymbit.com/images/index_10.jpg" width="453" height="100" class="cms">\n\n<a href="http://cymbit.com/Contact.php"> Hello</a>\n\n<p>&nbsp;</p>\n<div class="cms"><p>\n	FCKeditor has been around for more than six years. Since 2003 it has built a strong user community becoming the most used editor in the market, accumulating more than 3,5 million downloads. In 2009, we decided to rename the editor, bringing to light the next generation of our software: CKEditor 3.0.</p>\n<p>\n	CKEditor inherits the quality and strong features people were used to find in FCKeditor, in a much more modern product, added by dozens of new benefits, like accessibility and ultimate performance.</p>\n</div>\n\n\n</body>', 'YJimMBgjWP2', '2011-08-06 02:44:22', 'Paragraph Change'),
(10, 'yN6BI71buvS', 'UbVyENf', '<head>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<title>Untitled Document</title>\n<link href="http://cymbit.com/css/main.css" rel="stylesheet" type="text/css">\n<style></style>\n</head>\n\n<body>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<h1 align="center">No Videos Available</h1>\n<img src="http://cymbit.com/images/index_10.jpg" width="453" height="100" class="cms">\n\n<a href="http://cymbit.com/Contact.php"> Hello</a>\n\n<p>&nbsp;</p>\n<div class="cms"><p>\n	FCKeditor has been around for more than six years. Since 2003 it has built a strong user community becoming the most used editor in the market, accumulating more than 3,5 million downloads. In 2009, we decided to rename the editor, bringing to light the next generation of our software: CKEditor 3.0.</p>\n<p>\n	CKEditor inherits the quality and strong features people were used to find in FCKeditor, in a much more modern product, added by dozens of new benefits, like accessibility and ultimate performance.</p>\n</div>\n\n\n</body>', 'YJimMBgjWP2', '2011-08-06 02:48:46', 'Paragraph Change');

-- --------------------------------------------------------

--
-- Table structure for table `Language`
--

DROP TABLE IF EXISTS `Language`;
CREATE TABLE IF NOT EXISTS `Language` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `text` varchar(128) NOT NULL,
  `value` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

--
-- Dumping data for table `Language`
--

INSERT INTO `Language` (`ID`, `text`, `value`) VALUES
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
-- Table structure for table `Pages`
--

DROP TABLE IF EXISTS `Pages`;
CREATE TABLE IF NOT EXISTS `Pages` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `PID` varchar(12) NOT NULL,
  `SID` varchar(12) NOT NULL,
  `Title` varchar(128) NOT NULL,
  `Path` varchar(256) NOT NULL,
  `modified_user` varchar(12) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `PID` (`PID`),
  KEY `SID` (`SID`),
  KEY `modified_user` (`modified_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `Pages`
--

INSERT INTO `Pages` (`ID`, `PID`, `SID`, `Title`, `Path`, `modified_user`, `modified_date`) VALUES
(1, 'AGYsEPq', 'hHgFRtt', 'Test Page', '/help2.php', 'YJimMBgjWP2', '0000-00-00 00:00:00'),
(2, 'UbVyENf', 'hHgFRtt', 'Video Page', '/Video.php', 'YJimMBgjWP2', '0000-00-00 00:00:00'),
(3, 'QDUzSaA4pir', 'hHgFRtt', 'Simple & Free CMS for Web Designers » CymbitCMS', '/index.php', 'YJimMBgjWP2', '2011-05-17 22:56:56'),
(4, 'o7ClQh2yDaG', 'hHgFRtt', 'Test File in Folder123', '/test/file.html', 'YJimMBgjWP2', '2011-09-14 16:40:57'),
(5, 'g8pxBYfp9J1', 'hHgFRtt', 'Test File in Double Folder', '/test/secfolder/file.html', 'YJimMBgjWP2', '2011-09-14 16:45:36'),
(6, 'g8pxBYfp9J9', 'hHgFRtt', 'Test File in Double Folder', '/test/secfolder/file/something.html', 'YJimMBgjWP2', '2011-09-14 16:45:36'),
(7, 'm4nucRM7KfF', 'hHgFRtt', 'Frequenty Asked Questions &raquo; Cymbit CMS', '/support/FAQ.php', 'YJimMBgjWP2', '2011-10-03 22:36:13'),
(8, 'p4nucRM7Kf4', 'hHgFRtt', 'FAQ &raquo; Cymbit CMS', '/support/FAQ2.php', 'YJimMBgjWP2', '2011-10-03 22:36:13');

-- --------------------------------------------------------

--
-- Table structure for table `Sites`
--

DROP TABLE IF EXISTS `Sites`;
CREATE TABLE IF NOT EXISTS `Sites` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `Owner` varchar(12) NOT NULL,
  `SID` varchar(12) NOT NULL,
  `Site` varchar(150) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Enabled` tinyint(1) NOT NULL,
  `Server` varchar(150) NOT NULL,
  `User` varchar(64) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Path` varchar(150) NOT NULL,
  `Keyword` varchar(128) NOT NULL,
  `CSS` varchar(256) NOT NULL,
  `Mode` varchar(20) NOT NULL,
  `Port` int(4) NOT NULL,
  `SFTP` tinyint(1) NOT NULL,
  `has_key` int(1) NOT NULL,
  `Passkey` varchar(128) NOT NULL,
  `Color` varchar(7) NOT NULL,
  `WYSIWYG1` text NOT NULL,
  `WYSIWYG2` text NOT NULL,
  `modified_user` varchar(12) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Site` (`Site`),
  UNIQUE KEY `SID` (`SID`),
  KEY `Owner` (`Owner`),
  KEY `modified_user` (`modified_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `Sites`
--

INSERT INTO `Sites` (`ID`, `Owner`, `SID`, `Site`, `Name`, `Enabled`, `Server`, `User`, `Password`, `Path`, `Keyword`, `CSS`, `Mode`, `Port`, `SFTP`, `has_key`, `Passkey`, `Color`, `WYSIWYG1`, `WYSIWYG2`, `modified_user`, `modified_date`) VALUES
(0, 'A2BtoDTQI0b8', 'XOujlec', 'http://demo.cymbit.com', 'Demo Cymbit Site', 1, 'cymbit.com1', 'demo@cymbit.com', '° žNDë=Q/´Ò’Æ', '/index.html', 'cms-editable', '', 'Passive', 21, 0, 0, '', '', '', '', 'YJimMBgjWP2', '0000-00-00 00:00:00'),
(1, 'A2BtoDTQI0b8', 'hHgFRtt', 'http://cymbit.com', 'Cymbit CMS123456789012312332423423423', 1, 'cymbit.com', 'braxtond@cymbit.com', '6#4Wu£Éob', '/index.php', 'cms', '', 'Passive', 21, 0, 0, '', '', '', '', 'YJimMBgjWP2', '2012-10-01 16:04:40'),
(2, 'A2BtoDTQI0b8', 'EYtlTGy', 'http://morethan28days.com', 'The Identity Program', 1, 'morethan28days.com', 'morethan', 'Šs¯‡Ý‹›îz’', '/public_html/index.php', 'cms-editable', '', 'Passive', 21, 0, 0, '', '#FFFFFF', 'Cut, Copy, Paste, PasteText, PasteFromWord, hr, SpellChecker, hr, Bold, Italic, Underline, Strike, hr, Find, Replace, hr, Undo, Redo, hr, Link, Unlink, Anchor, Image, JustifyLeft, JustifyCenter, JustifyRight, JustifyBlock', '', 'YJimMBgjWP2', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Template`
--

DROP TABLE IF EXISTS `Template`;
CREATE TABLE IF NOT EXISTS `Template` (
  `ID` int(7) NOT NULL AUTO_INCREMENT,
  `TID` varchar(12) NOT NULL,
  `SID` varchar(12) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `content` longtext NOT NULL,
  `limit` int(11) NOT NULL,
  `create_user` varchar(12) NOT NULL,
  `create_date` datetime NOT NULL,
  `modifed_user` varchar(12) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `TID` (`TID`),
  KEY `SID` (`SID`),
  KEY `modifed_user` (`modifed_user`),
  KEY `create_user` (`create_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE IF NOT EXISTS `Users` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `QID` varchar(12) NOT NULL,
  `First_Name` varchar(72) NOT NULL,
  `Last_Name` varchar(72) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Email` varchar(72) NOT NULL,
  `Type` tinyint(4) NOT NULL,
  `Account` varchar(25) NOT NULL,
  `Language` varchar(32) NOT NULL,
  `Owner` varchar(12) NOT NULL,
  `last_login` datetime NOT NULL,
  `reg_date` datetime NOT NULL,
  `demo` tinyint(1) NOT NULL,
  `VerifyID` varchar(32) NOT NULL,
  `TempID` varchar(128) NOT NULL,
  `Provider` varchar(128) NOT NULL,
  `AllOne` varchar(512) NOT NULL,
  `AllOne_id` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `QID` (`QID`),
  KEY `Owner` (`Owner`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`ID`, `QID`, `First_Name`, `Last_Name`, `Password`, `Email`, `Type`, `Account`, `Language`, `Owner`, `last_login`, `reg_date`, `demo`, `VerifyID`, `TempID`, `Provider`, `AllOne`, `AllOne_id`) VALUES
(1, 'YJimMBgjWP2', 'Braxton', 'Diggs', 'e3cd9128af32051eebc04898e6775342b6aaec15', 'braxtondiggs@gmail.com', 0, 'Free', 'en', 'A2BtoDTQI0b8', '2012-10-01 14:29:51', '0000-00-00 00:00:00', 1, '', 'TGtJjU17R3y1VB3uXXwk2Vkx6L6bw15MpH67ShO0TIBH74NX97Vv1Y69legzTyPSR', 'CymbitCMS', '', ''),
(2, 'rxwEDNWrHi0', 'Edward', '\\\\\\\\\\\\\\''); DELETE FROM Users; --', '2af80637db1cbc271580efe7c66a90081c5f647d', 'John.Doe@maisdfsdfsdfsdfsfsdfsfl.com', 1, 'Free', 'en', 'A2BtoDTQI0b8', '0000-00-00 00:00:00', '2011-09-17 18:42:44', 1, '', '', '', '', ''),
(27, 'QZHlr4pj9mns', 'New User', '', 'e3cd9128af32051eebc04898e6775342b6aaec15', 'blackbad882003@yahoo.com', 0, 'Free', 'en', 'AQl9NQ5cwdth', '0000-00-00 00:00:00', '2012-09-20 15:52:46', 1, 'VHKQHEzxPWZh5', '', 'CymbitCMS', '', ''),
(28, 'QZ7Qrjvin4qs', 'New User', '', '65ae713c05b64294f3eb82254279a4d0940d98fd', 'viraatravi@gmail.com', 0, 'Free', 'en', 'AlExOCZUrbnv', '0000-00-00 00:00:00', '2012-09-30 06:54:21', 1, 'VEBtBnlXIlaJ', '', 'CymbitCMS', '', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Activate`
--
ALTER TABLE `Activate`
  ADD CONSTRAINT `Activate_ibfk_2` FOREIGN KEY (`SID`) REFERENCES `Sites` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Folder`
--
ALTER TABLE `Folder`
  ADD CONSTRAINT `Folder_ibfk_3` FOREIGN KEY (`Owner`) REFERENCES `Users` (`QID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Folder_ibfk_2` FOREIGN KEY (`SID`) REFERENCES `Sites` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Groups`
--
ALTER TABLE `Groups`
  ADD CONSTRAINT `Groups_ibfk_2` FOREIGN KEY (`Applied`) REFERENCES `Users` (`QID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Groups_ibfk_3` FOREIGN KEY (`Owner`) REFERENCES `Accounts` (`AID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Group_Sites`
--
ALTER TABLE `Group_Sites`
  ADD CONSTRAINT `Group_Sites_ibfk_1` FOREIGN KEY (`GID`) REFERENCES `Groups` (`GID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Group_Sites_ibfk_2` FOREIGN KEY (`SID`) REFERENCES `Sites` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `History`
--
ALTER TABLE `History`
  ADD CONSTRAINT `History_ibfk_2` FOREIGN KEY (`modifed_user`) REFERENCES `Users` (`QID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `History_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `Pages` (`PID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Pages`
--
ALTER TABLE `Pages`
  ADD CONSTRAINT `Pages_ibfk_2` FOREIGN KEY (`SID`) REFERENCES `Sites` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Pages_ibfk_4` FOREIGN KEY (`modified_user`) REFERENCES `Users` (`QID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Sites`
--
ALTER TABLE `Sites`
  ADD CONSTRAINT `Sites_ibfk_2` FOREIGN KEY (`modified_user`) REFERENCES `Users` (`QID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Sites_ibfk_1` FOREIGN KEY (`Owner`) REFERENCES `Accounts` (`AID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Template`
--
ALTER TABLE `Template`
  ADD CONSTRAINT `Template_ibfk_4` FOREIGN KEY (`create_user`) REFERENCES `Users` (`QID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Template_ibfk_2` FOREIGN KEY (`SID`) REFERENCES `Sites` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Template_ibfk_3` FOREIGN KEY (`modifed_user`) REFERENCES `Users` (`QID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`Owner`) REFERENCES `Accounts` (`AID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
