-- phpMyAdmin SQL Dump
-- version 4.0.10.17
-- https://www.phpmyadmin.net
--
-- Host: studentdb-maria.gl.umbc.edu
-- Generation Time: Dec 20, 2016 at 04:16 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.4.44

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ricke1`
--

-- --------------------------------------------------------

--
-- Table structure for table `Advisor`
--

CREATE TABLE IF NOT EXISTS `Advisor` (
  `advisorID` int(11) NOT NULL AUTO_INCREMENT,
  `fName` varchar(40) NOT NULL,
  `lName` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `bldgName` text NOT NULL,
  `roomNum` text NOT NULL,
  `salt` char(23) NOT NULL COMMENT 'The salt for this particular user',
  `password` char(123) NOT NULL COMMENT 'Salted and Hashed Version of the password',
  PRIMARY KEY (`advisorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `Advisor`
--

INSERT INTO `Advisor` (`advisorID`, `fName`, `lName`, `email`, `bldgName`, `roomNum`, `salt`, `password`) VALUES
(28, 'Jaime', 'Orellana', 'jaime5@umbc.edu', 'ITE', '240', '196862188858589b7cdec31', '19blSuELLqrWM'),
(29, 'Kwame', 'Owusu-Boaitey', 'kwame3@umbc.edu', 'The Trap House', '312', '5706834315854a5f3aa86d4', '57pSLkw0.PZCw'),
(30, 'Andrew', 'Levin', 'landrew2@umbc.edu', 'Engineering', '420', '4117323095854b3eab326d3', '413wKbMHLj9WA');

-- --------------------------------------------------------

--
-- Table structure for table `Meetings`
--

CREATE TABLE IF NOT EXISTS `Meetings` (
  `meetingID` int(11) NOT NULL AUTO_INCREMENT,
  `dateTime` datetime NOT NULL,
  `groupMeeting` tinyint(1) NOT NULL COMMENT 'True is a group meeting false is an individual meeting',
  `available` tinyint(1) NOT NULL,
  `location` varchar(15) NOT NULL,
  `advisorID` int(11) NOT NULL,
  PRIMARY KEY (`meetingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `Meetings`
--

INSERT INTO `Meetings` (`meetingID`, `dateTime`, `groupMeeting`, `available`, `location`, `advisorID`) VALUES
(49, '2016-12-16 14:00:00', 1, 1, 'ITE 240', 28),
(50, '2016-12-16 14:30:00', 0, 1, 'ITE 204', 28),
(51, '2016-12-16 15:00:00', 1, 1, 'ITE 204', 28),
(52, '2016-12-16 15:30:00', 0, 1, 'ITE 204', 28),
(53, '2016-12-19 15:00:00', 0, 0, 'ITE 201', 28),
(54, '2016-12-20 13:00:00', 1, 1, 'Lecture Hall 1', 28),
(55, '2016-12-16 12:00:00', 0, 1, 'ITE 201', 29),
(56, '2016-12-25 09:30:00', 0, 0, 'ITE 201', 30),
(57, '2016-12-26 10:00:00', 0, 0, 'Math 220', 30),
(58, '2016-12-27 15:10:00', 0, 1, 'esrgeg', 30),
(59, '2016-12-22 10:00:00', 0, 0, 'ITE 204', 28),
(60, '2016-12-23 10:00:00', 0, 0, 'ITE 214', 28);

-- --------------------------------------------------------

--
-- Table structure for table `Shut_Off_Control`
--

CREATE TABLE IF NOT EXISTS `Shut_Off_Control` (
  `onlineID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `siteOnline` tinyint(1) NOT NULL COMMENT 'If true then the site is active for students, if it is false the site is offline for students',
  PRIMARY KEY (`onlineID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Shut_Off_Control`
--

INSERT INTO `Shut_Off_Control` (`onlineID`, `siteOnline`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE IF NOT EXISTS `Student` (
  `count` int(11) NOT NULL AUTO_INCREMENT,
  `fName` varchar(40) NOT NULL,
  `lName` varchar(40) NOT NULL,
  `campusID` varchar(7) NOT NULL,
  `email` varchar(35) NOT NULL,
  `meetingID` int(11) NOT NULL COMMENT 'if it is -1 then there is no meeting associated with the student',
  `major` text,
  `postUMBC` text,
  `questionsConcerns` text,
  PRIMARY KEY (`count`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`count`, `fName`, `lName`, `campusID`, `email`, `meetingID`, `major`, `postUMBC`, `questionsConcerns`) VALUES
(7, 'Max', 'Ricketts-Uy', 'ew22222', 'ricke1@umbc.edu', -1, 'Other', 'do it', 'shrimp'),
(29, 'Bob', 'Burger', 'qw21345', 'burger2@umbc.edu', -1, 'Chemistry [BA]', NULL, NULL),
(30, 'James', 'Pond', 'er44432', 'pond45@umbc.edu', -1, 'Biological Sciences [BA]', NULL, NULL),
(31, 'matt', 'frog', 'qw23432', 'frog1@umbc.edu', -1, 'Bioinformatics & Computational Biology [BS]', NULL, NULL),
(33, 'Andrew', 'Levin', 'BR86693', 'landrew2@umbc.edu', -1, 'Chemistry [BA]', 'Potato Potato', ''),
(35, 'john ', 'red', 'we33333', 'red99@umbc.edu', -1, 'Biochemistry & Molecular Biology [BS]', 'jshdcbs', ''),
(36, 'Ham', 'Bone', 're33333', 'bone4@umbc.edu', -1, 'Bioinformatics & Computational Biology [BS]', NULL, NULL),
(41, 'walter', 'melon', 'fg44444', 'melon2@umbc.edu', -1, 'Biological Sciences [BA]', 'djsdjnsdjnskdjvnksdjvnksjdvnksjdnvvksjdnvksjdnksjdnkjsdnfkjsdnfksjdnfksjdnfkjsdnfkjsdnfkjsndfkjsndfkjsndfkjsndfkjnsdkfjnsdkjfnskdjfnskdjfnksjdfnksjdfnksjdnfksjdnfksjdnfksjdnfksjdnfksjdnfksjdnfksjdnksjdnfksjdfnksjdnfksjdnfksjdnfksjdnfksjdnfksjdnfksjdnfkjsdnfksjdnfksjdnfksjdnfksjdnfksjdnfksjdnfksjdnf\r\n', 'sjdnfsjdfnksjdfnksjdfnskjdfnskjdnfksjddfnksjdnfksjdnfksjdnfksjdfnksjdfnksjdnfksjdfnksjdnfksjdnfksjdnfksjd'),
(42, 'blue ', 'berrymore', 'fd23223', 'berry@umbc.edu', -1, 'Biology Education [BA]', NULL, NULL),
(43, 'jackie', 'chance', 'gf55555', 'chance2@umbc.edu', -1, 'Biological Sciences [BS]', NULL, NULL),
(44, 'john', 'deere', 'fd44444', 'deere@umbc.edu', -1, 'Biological Sciences [BA]', 'ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss'),
(45, 'Wuz', 'Good', 'wu23443', 'wuz@umbc.edu', -1, 'Biological Sciences [BA]', NULL, NULL),
(46, 'Wayne', 'Brady', 'sd33211', 'brady2@umbc.edu', -1, 'Biological Sciences [BA]', 'get munny', 'am i good enough??'),
(47, 'Rooney', 'Mac', 'co20101', 'rooneymac@umbc.edu', -1, 'Chemistry [BS]', NULL, NULL),
(48, 'Rooney', 'Dogboy', 'we33234', 'dogboy2@umbc.edu', -1, 'Biological Sciences [BS]', 'be a good boy', ''),
(49, 'Gordan', 'Grey', 'de22354', 'grey0@umbc.edu', -1, 'Biological Sciences [BA]', 'Just gonna do whatever', 'nope'),
(50, 'Jordan', 'Rose', 'sd34343', 'rose0@umbc.edu', -1, 'Bioinformatics & Computational Biology [BS]', 'Get mun', ''),
(51, 'test', 'case', 'te12345', 'test@umbc.edu', -1, 'Biological Sciences [BS]', 'test', ''),
(52, 'Bob', 'Strong', 'er33333', 'strong9@umbc.edu', -1, 'Biological Sciences [BA]', 'get money', 'none'),
(53, 'Eugene', 'Krabs', 'ut44342', 'krabs2@umbc.edu', -1, 'Other', NULL, NULL),
(54, 'Pepe', 'Frog', 'oo76775', 'frog@umbc.edu', -1, 'Other', NULL, NULL),
(56, 'Sterling', 'Archer', 'IS15666', 'sarcher@umbc.edu', -1, 'Biology Education [BA]', 'Danger Zone', 'My obsession with kenny loggins.\r\n'),
(57, 'Lana', 'Kane', 'Is15777', 'lkane@umbc.edu', -1, 'Chemistry [BS]', 'The Daaaaaaaaaaaaaaaaanger Zone', 'Kenny Loggins'),
(58, 'Cheryl/Carrol', 'Tunt', 'Is15888', 'ctunt@umbc.edu', -1, 'Biochemistry & Molecular Biology [BS]', NULL, NULL),
(59, 'george', 'gordon', 'er33222', 'gordon@umbc.edu', -1, 'Bioinformatics & Computational Biology [BS]', NULL, NULL),
(60, '', '', '', '', -1, '', NULL, NULL),
(61, 'Don', 'Joseph', 'er88888', 'd@umbc.edu', -1, 'Biological Sciences [BA]', NULL, NULL),
(62, 'Snake', 'Lord', 'iu99999', 'lord@umbc.edu', -1, 'Biological Sciences [BA]', NULL, NULL),
(63, 'Tim', 'McGee', 'sd22222', 'm@umbc.edu', -1, 'Biological Sciences [BA]', 'I have a great day and I will be a good time to get the chance to get the chance to get the chance to get the', 'Nope'),
(64, 'Arthur', 'Antman', 'aa99999', 'aa@umbc.edu', -1, 'Chemistry [BA]', 'Ants', 'Inmypantz'),
(65, 'Salsa ', 'Man', 'sa66777', 'salsa@umbc.edu', -1, 'Biological Sciences [BS]', 'Dunk on em', ''),
(67, 'asasc', 'ascasc', 'ww32323', 'asdasdsd@umbc.edu', -1, 'Biological Sciences [BA]', NULL, NULL),
(68, 'kawaii', 'despot', 'ab12345', 'student1@umbc.edu', -1, 'Other', 'get a job\r\nforget everything i learned in all my classes\r\nhope i can get a promotion\r\nwatch netflix and play ow all day long\r\n', 'but first, lemme take a se1fie'),
(69, 'Liliya', 'Elkins', 'LV12344', 'Liliyalevina@umbc.edu', -1, 'Bioinformatics & Computational Biology [BS]', 'Live life', 'How to live'),
(70, 'Larisa ', 'MyLastName', 'CD78981', 'larisa1@umbc.edu', -1, 'Other', NULL, NULL),
(71, 'Liliya', 'Elkins', 'LE91234', 'Liliyaelkins@umbc.edu', -1, 'Chemistry [BA]', 'Sleep', ''),
(72, 'Spongebob', 'Squarepants', 'kk77777', 'crusty@umbc.edu', -1, 'Other', NULL, NULL),
(73, 'Rick', 'Sanchez', 'rs88888', 'rs@umbc.edu', -1, 'Other', NULL, NULL),
(74, 'John', 'Diggle', 'AR11111', 'john@umbc.edu', -1, 'Bioinformatics & Computational Biology [BS]', '3wtwergwertw', 'etwertwert'),
(75, 'egsfg', 'asdfasdf', 'sd11312', 'asdfasdf@umbc.edu', -1, 'Other', NULL, NULL),
(76, 'Juliet', 'Schick', 'NV24019', 'jschick1@umbc.edu', -1, 'Other', 'None', ''),
(77, 'Rooney', 'Mac', 'RG12345', 'rooneymac@umbc.edu', -1, 'Biology Education [BA]', 'play professional ball', 'am i tall enough'),
(78, 'Dale', 'Earnhardt', 'we11111', 'de@umbc.edu', -1, 'Biological Sciences [BA]', 'drive', ''),
(79, 'Wanying', 'Zhao', 'XT87923', 'wzhao3@umbc.edu', -1, 'Other', NULL, NULL),
(80, 'jhdgfht', 'htrehrteh', 'xt25656', 'dskfjsdfjk@umbc.edu', -1, 'Other', NULL, NULL),
(81, 'Aaron', 'Frishman', 'Ci92948', 'aaronf1@umbc.edu', -1, 'Biochemistry & Molecular Biology [BS]', '', ''),
(82, 'John', 'Johnson', 'qw11111', 'jj@umbc.edu', -1, 'Biological Sciences [BS]', 'sdasdasasd', ''),
(83, 'Shrimp', 'Boy', 'sd33333', 'shrimp@umbc.edu', -1, 'Biological Sciences [BA]', 'sumthing', 'nothing'),
(84, 'max', 'ricketts-uy', 'er22222', 'ricke1@umbc.edu', -1, 'Other', NULL, NULL),
(85, 'Aaron', 'Frishman', 'CI73095', 'aaronf1@umbc.edu', -1, 'Chemistry [BA]', 'sdfja', ''),
(86, 'Yeah', 'Mon', 'we00000', 'ym@umbc.edu', -1, 'Bioinformatics & Computational Biology [BS]', 'do the thing', ''),
(87, 'John', 'Doe', 'JD12345', 'Johndoe@umbc.edu', -1, 'Biochemistry & Molecular Biology [BS]', 'Medical School', ''),
(88, 'Johnny', 'Appleseed', 'SI07979', 'jaime5@umbc.edu', 54, 'Biochemistry & Molecular Biology [BS]', 'Be a balla', ''),
(89, 'Jow', 'Blow', 'ed11111', 'blow@umbc.edu', -1, 'Biological Sciences [BA]', 'someithing', ''),
(90, 'John', 'Smith', 'JS12345', 'Johnsmith@umbc.edu', -1, 'Biochemistry & Molecular Biology [BS]', '', ''),
(91, 'Ender', 'Shepard', 'NN77777', 'aliens@umbc.edu', -1, 'Other', 'Potato', 'sdsdf'),
(92, 'Kvothe', 'Sparrow', 'df64646', 'kasdfasdf@umbc.edu', -1, 'Bioinformatics & Computational Biology [BS]', 'sdfgdfg', 'sfgsdfgsdf'),
(93, 'Caliope', 'Elkins', 'CE99999', 'bear@umbc.edu', -1, 'Biological Sciences [BA]', 'fdfgs', 'dfdgdfv'),
(94, 'James', 'Smith', 'JS11111', 'jsmith1@umbc.edu', -1, 'Biological Sciences [BA]', '', ''),
(95, 'Dan', 'Haris', 'ew11111', 'haris1@umbc.edu', 59, 'Biological Sciences [BA]', 'Grad school', ''),
(96, 'Jim', 'Dean', 'JD11111', 'Jimdean1@umbc.edu', 60, 'Biochemistry & Molecular Biology [BS]', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
