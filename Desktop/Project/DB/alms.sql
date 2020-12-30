-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 30, 2020 at 11:48 AM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alms`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `LANDID` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `NAME` varchar(30) NOT NULL,
  `CONTACT` int(12) NOT NULL,
  `EMAIL` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ADDRESS` varchar(50) NOT NULL,
  `VILLAGE` varchar(20) NOT NULL,
  `TALUK` varchar(20) NOT NULL,
  `DISTRICT` varchar(20) NOT NULL,
  `FROMDATE` date NOT NULL,
  `TODATE` date NOT NULL,
  `STATUS` varchar(10) NOT NULL,
  PRIMARY KEY (`LANDID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customercare`
--

DROP TABLE IF EXISTS `customercare`;
CREATE TABLE IF NOT EXISTS `customercare` (
  `LANDID` varchar(15) NOT NULL,
  `NAME` varchar(20) NOT NULL,
  `CONTACT` bigint(10) NOT NULL,
  `SERVICE_YOU_NEED` varchar(30) NOT NULL,
  `STATUS` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customercare`
--

INSERT INTO `customercare` (`LANDID`, `NAME`, `CONTACT`, `SERVICE_YOU_NEED`, `STATUS`) VALUES
('LD5fc5b6d42a7a4', 'Meenakshi Rajesh', 9072960424, 'Labour', 'Rejected'),
('LD5fc495daI0831', 'Aparna Ajith', 8129490416, 'Seeds,Labour', 'Approved'),
('LD5fc495da10831', 'Aparna Ajith', 8129490416, 'Machinery, Tool', 'Approved'),
('LD5fc5b6d42a7a4', 'Meenakshi', 9072960424, 'Seeds,Labour', 'Rejected'),
('LD5fc495da10831', 'Aparna Ajith', 8129490416, 'others', 'Approved'),
('LD5fc5b6d42a7a4', 'APARNA', 8129490416, 'Machinery, Tool', 'Rejected'),
('LD5fc5b6d42a7a4', 'Meenakshi Rajesh', 7057153047, 'Labour', 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `landsoil`
--

DROP TABLE IF EXISTS `landsoil`;
CREATE TABLE IF NOT EXISTS `landsoil` (
  `LANDID` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `LAND_OWNERS_NAME` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `CONTACT` varchar(10) NOT NULL,
  `PLACE` varchar(20) NOT NULL,
  `POST_OFFICE` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PINCODE` bigint(6) NOT NULL,
  `LOCAL_BODY` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `NAME_OF_LOCAL_BODY` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `WARD_NO` bigint(10) NOT NULL,
  `SURVEY_NO` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `VILLAGE` varchar(20) NOT NULL,
  `TALUK` varchar(20) NOT NULL,
  `DISTRICT` varchar(20) NOT NULL,
  `LAND_AREA` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `EXPECTING_LEASE_RATE` bigint(8) NOT NULL,
  `LAND_PICTURE` varchar(30) NOT NULL,
  `SOIL_TEST_REPORT` varchar(30) NOT NULL,
  `IRRIGATION_FACILITY` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `DROUGHT_AFFECTING_AREA` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `FLOOD_AFFECTING_AREA` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `STATUS` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `REASON` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`LANDID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `landsoil`
--

INSERT INTO `landsoil` (`LANDID`, `LAND_OWNERS_NAME`, `CONTACT`, `PLACE`, `POST_OFFICE`, `PINCODE`, `LOCAL_BODY`, `NAME_OF_LOCAL_BODY`, `WARD_NO`, `SURVEY_NO`, `VILLAGE`, `TALUK`, `DISTRICT`, `LAND_AREA`, `EXPECTING_LEASE_RATE`, `LAND_PICTURE`, `SOIL_TEST_REPORT`, `IRRIGATION_FACILITY`, `DROUGHT_AFFECTING_AREA`, `FLOOD_AFFECTING_AREA`, `STATUS`, `REASON`) VALUES
('LD5fc5c450f2582', 'Sreerag B', '9874563210', 'Airapuram', 'Valayanchirangara', 685931, 'Grampachayath', 'Airapuram', 5, 'V/1236', 'Airapuram', 'Kunnathunad', 'Ernakulam', '1500', 1000, 'landsoilLD5fc5c450f2582.jpg', 'soilrptLD5fc5c450f2582.jpg', 'Canal', 'No', 'No', 'Approved', NULL),
('LD5fc5b6d42a7a4', 'Meenakshi Rajesh', '9072960424', 'Marampilly', 'South Vellarapilly', 683580, 'Grampachayath', 'Vellarapilly', 13, 'XIII/208', 'Marampilly', 'Aluva', 'Ernakulam', '500', 800, 'landsoilLD5fc5b6d42a7a4.jpg', 'soilrptLD5fc5b6d42a7a4.jpg', 'Well', 'No', 'No', 'Approved', NULL),
('LD5fc64a9b8abc3', 'Doney', '9497504753', 'Parambancheri', 'Pulinthanam', 686671, 'Grampachayath', 'Enanalloor', 5, 'V/402', 'Enanalloor', 'Muvattupuzha', 'Ernakulam', '100', 10000, 'landsoilLD5fc64a9b8abc3.jpg', 'soilrptLD5fc64a9b8abc3.jpg', 'Well', 'Yes', 'No', 'Approved', NULL),
('LD5fc495da10831', 'Aparna Ajith', '8129490416', 'Ayakkadu', 'Thrikkariyoor', 686692, 'Grampachayath', 'Pindimana', 8, 'VII/355', 'Thrikkariyoor', 'Kothamangalam', 'Ernakulam', '1000', 1000, 'landsoilLD5fc495da10831.jpg', 'soilrptLD5fc495da10831.jpg', 'Canal', 'No', 'No', 'Approved', NULL),
('LD5fc5c621516b5', 'Ajay C Mohan', '7057153047', 'Manjapra', 'Manjapra', 683581, 'Grampachayath', 'Manjapra', 11, 'XI/215', 'Manjapra', 'Aluva', 'Ernakulam', '100', 1000, 'landsoilLD5fc5c621516b5.jpg', 'soilrptLD5fc5c621516b5.jpg', 'River', 'No', 'No', 'Approved', NULL),
('LD5fc77fbbb5d24', 'dssd', '41236', 'ghhf', 'ghyu', 353, 'Grampachayath', 'kuggd', 12, 'm12', 'Edapilly south', 'Aluva', 'Ernakulam', '120', 1232, 'landsoilLD5fc77fbbb5d24.jpg', 'soilrptLD5fc77fbbb5d24.jpg', 'Well', 'No', 'No', NULL, NULL),
('LD5fc7804d0ab26', 'Meenakshi', '9072960424', 'Manjapra', 'Manjapra', 686692, 'Grampachayath', 'Airapuram', 12, 'DFX123', 'Alangad', 'Aluva', 'Ernakulam', '100', 1000, 'landsoilLD5fc7804d0ab26.jpg', 'soilrptLD5fc7804d0ab26.jpg', 'WELL', 'No', 'No', 'Approved', NULL),
('LD5fc780992bc68', 'Meenakshi', '9072960424', 'Manjapra', 'Manjapra', 686692, 'Grampachayath', 'Airapuram', 12, 'DFX123', 'Alangad', 'Aluva', 'Ernakulam', '100', 1000, 'landsoilLD5fc780992bc68.jpg', 'soilrptLD5fc780992bc68.jpg', 'WELL', 'No', 'No', 'Approved', NULL),
('LD5fc882aa5791f', 'Anandu Ajith', '987451230', 'Kakkanad', 'Kakkanad', 687692, 'Muncipality', 'Ernakulam', 9, 'IX/902', 'Ernakulam', 'Kochi', 'Ernakulam', '500', 2000, 'landsoilLD5fc882aa5791f.jpg', 'soilrptLD5fc882aa5791f.jpg', 'Pond', 'No', 'No', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

DROP TABLE IF EXISTS `userlogin`;
CREATE TABLE IF NOT EXISTS `userlogin` (
  `EMAIL` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PASSWORD` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ACCTYPE` int(11) NOT NULL,
  `STATUS` int(11) NOT NULL,
  PRIMARY KEY (`EMAIL`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`EMAIL`, `PASSWORD`, `ACCTYPE`, `STATUS`) VALUES
('ajay@gmail.com', '29e457082db729fa1059d4294ede3909', 2, 1),
('aparna@gmail.com', '46aab74d298e13f19d28aa38dda7277f', 2, 1),
('meenu@gmail.com', '4b03afcdb71c48eb81a2405b0998019f', 2, 1),
('don@gmail.com', '6a01bfa30172639e770a6aacb78a3ed4', 2, 1),
('vo@gmail.com', '0339448060128eec9599c4529ff3d5c5', 1, 1),
('admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 0, 1),
('appu@gmail.com', '622622b00805c54040dd9a15674a5117', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userreg`
--

DROP TABLE IF EXISTS `userreg`;
CREATE TABLE IF NOT EXISTS `userreg` (
  `NAME` varchar(20) NOT NULL,
  `EMAIL` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PASSWORD` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `CONFPW` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ADDRESS` varchar(30) NOT NULL,
  `TALUK` varchar(20) NOT NULL,
  `DISTRICT` varchar(20) NOT NULL,
  `PINCODE` bigint(6) NOT NULL,
  `CONTACT` bigint(10) NOT NULL,
  PRIMARY KEY (`EMAIL`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userreg`
--

INSERT INTO `userreg` (`NAME`, `EMAIL`, `PASSWORD`, `CONFPW`, `ADDRESS`, `TALUK`, `DISTRICT`, `PINCODE`, `CONTACT`) VALUES
('Ajay C Mohan', 'ajay@gmail.com', '29e457082db729fa1059d4294ede3909', '29e457082db729fa1059d4294ede3909', 'Thoopelil House, Manjapra PO, ', 'Aluva', 'Ernakulam', 683581, 7057153047),
('Aparna Ajith', 'aparna@gmail.com', '46aab74d298e13f19d28aa38dda7277f', '46aab74d298e13f19d28aa38dda7277f', 'Pullattu House, Ayakkadu, Thri', 'Kothamangalam', 'Ernakulam', 686692, 8129490416),
('Meenakshi Rajesh', 'meenu@gmail.com', '4b03afcdb71c48eb81a2405b0998019f', '4b03afcdb71c48eb81a2405b0998019f', 'Pottomkudy (H), Vellarapilly, ', 'Aluva', 'Ernakulam', 683580, 9072960424),
('Appu', 'appu@gmail.com', '622622b00805c54040dd9a15674a5117', '622622b00805c54040dd9a15674a5117', 'pullattu house ayakkadu thrikk', 'ktmglm', 'ekm', 686692, 8297461350),
('Doney', 'don@gmail.com', '6a01bfa30172639e770a6aacb78a3ed4', '6a01bfa30172639e770a6aacb78a3ed4', 'Kallingal House, Pulinthanam P', 'Muvattupuzha', 'Ernakulam', 686671, 9497504753);

-- --------------------------------------------------------

--
-- Table structure for table `voreg`
--

DROP TABLE IF EXISTS `voreg`;
CREATE TABLE IF NOT EXISTS `voreg` (
  `NAME` varchar(20) NOT NULL,
  `DISTRICT` varchar(30) NOT NULL,
  `TALUK` varchar(30) NOT NULL,
  `VILLAGE_OFFICE` varchar(20) NOT NULL,
  `VILLAGE_ID` varchar(10) NOT NULL,
  `VO_ID` varchar(30) NOT NULL,
  `EMAIL` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PASSWORD` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `STATUS` varchar(10) NOT NULL,
  PRIMARY KEY (`VILLAGE_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `voreg`
--

INSERT INTO `voreg` (`NAME`, `DISTRICT`, `TALUK`, `VILLAGE_OFFICE`, `VILLAGE_ID`, `VO_ID`, `EMAIL`, `PASSWORD`, `STATUS`) VALUES
('Meenakshi', 'Ernakulam', 'Aluva', 'Aluva East', 'aluva123', 'IMG_9868.JPG', 'vo@gm', '0339448060128eec9599c4529ff3d5c5', 'Approved');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
