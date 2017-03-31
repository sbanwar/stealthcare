-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2017 at 05:35 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `SCP`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `loginWithUsername`(IN `iUsername` VARCHAR(150), IN `iPassword` VARCHAR(150))
BEGIN
SELECT U.*
FROM `SCP_UserLogin` AS U, SCP_Status AS S
WHERE U.UserName=iUsername AND U.Password= iPassword AND S.StatusID=U.StatusID ;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_AccessLevel`
--

CREATE TABLE IF NOT EXISTS `SCP_AccessLevel` (
  `AccessLevelID` int(11) NOT NULL AUTO_INCREMENT,
  `AccessLevelName` varchar(150) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  PRIMARY KEY (`AccessLevelID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `SCP_AccessLevel`
--

INSERT INTO `SCP_AccessLevel` (`AccessLevelID`, `AccessLevelName`, `CreatedDateTime`, `ModifyDateTime`, `StatusID`) VALUES
(1, 'ALL', '2017-03-01 18:14:00.000', '2017-03-01 18:14:00.000', 1),
(2, 'WEB,TABLET,MOBILE', '2017-03-01 18:14:00.000', '2017-03-01 18:14:00.000', 1),
(3, 'TABLET', '2017-03-01 18:14:00.000', '2017-03-01 18:14:00.000', 1),
(4, 'MOBILE', '2017-03-01 18:14:00.000', '2017-03-01 18:14:00.000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `SCP_Alert`
--

CREATE TABLE IF NOT EXISTS `SCP_Alert` (
  `AlertID` int(11) NOT NULL AUTO_INCREMENT,
  `Priority` varchar(150) DEFAULT NULL,
  `Severity` varchar(150) DEFAULT NULL,
  `TaskID` int(11) DEFAULT NULL,
  `StaffID` int(11) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  PRIMARY KEY (`AlertID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_AssessmentAllocation`
--

CREATE TABLE IF NOT EXISTS `SCP_AssessmentAllocation` (
  `AssessmentAllocationID` int(11) NOT NULL AUTO_INCREMENT,
  `EnquiryID` int(11) DEFAULT NULL,
  `StaffID` int(11) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  PRIMARY KEY (`AssessmentAllocationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_CareOrg`
--

CREATE TABLE IF NOT EXISTS `SCP_CareOrg` (
  `OrgID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(150) DEFAULT NULL,
  `PlanID` int(11) DEFAULT NULL,
  `Address` varchar(150) DEFAULT NULL,
  `ContactNo` varchar(150) DEFAULT NULL,
  `ContactNo2` varchar(150) DEFAULT NULL,
  `FaxNo` varchar(150) DEFAULT NULL,
  `WebSite` varchar(150) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `OtherDetails` varchar(150) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  PRIMARY KEY (`OrgID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `SCP_CareOrg`
--

INSERT INTO `SCP_CareOrg` (`OrgID`, `Name`, `PlanID`, `Address`, `ContactNo`, `ContactNo2`, `FaxNo`, `WebSite`, `UserID`, `OtherDetails`, `CreatedDateTime`, `ModifyDateTime`, `StatusID`) VALUES
(3, 'rest', NULL, 'Hi', '7415850336', '7415850336', '7415850336', 'http://localhost/SCPProject/#/create_care_orga', 12, 'rest', '2017-03-27 17:32:53.000', '2017-03-27 17:32:53.000', 1),
(4, 'rest', NULL, 'Hi', '7415850336', '7415850336', '7415850336', 'http://localhost/SCPProject/#/create_care_orga', 2, 'rest', '2017-03-27 17:32:53.000', '2017-03-27 17:32:53.000', 1),
(5, 'Anil Banwar', NULL, 'Indore', '7415850336', '7415850336', '7415850336', 'http://localhost/SCPProject/organizer/abanwar', 13, 'Test Data', '2017-03-30 12:43:14.000', '2017-03-30 12:43:14.000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `SCP_Customer`
--

CREATE TABLE IF NOT EXISTS `SCP_Customer` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerName` varchar(150) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ContactNo` varchar(150) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  `OtherDetails` varchar(150) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_Documents`
--

CREATE TABLE IF NOT EXISTS `SCP_Documents` (
  `DocumentID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) DEFAULT NULL,
  `DocumentTypeID` int(11) DEFAULT NULL,
  `DocumentUrl` varchar(150) DEFAULT NULL,
  `StaffID` int(11) DEFAULT NULL,
  `Version` varchar(150) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  PRIMARY KEY (`DocumentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_DocumentType`
--

CREATE TABLE IF NOT EXISTS `SCP_DocumentType` (
  `DocumentTypeID` int(11) NOT NULL,
  `Typename` varchar(150) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  PRIMARY KEY (`DocumentTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_Enquiry`
--

CREATE TABLE IF NOT EXISTS `SCP_Enquiry` (
  `EnquiryID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  PRIMARY KEY (`EnquiryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_Licenses`
--

CREATE TABLE IF NOT EXISTS `SCP_Licenses` (
  `LicenseID` int(11) NOT NULL AUTO_INCREMENT,
  `LicenseKey` varchar(150) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  `OrgID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  PRIMARY KEY (`LicenseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `SCP_Licenses`
--

INSERT INTO `SCP_Licenses` (`LicenseID`, `LicenseKey`, `StatusID`, `OrgID`, `UserID`, `CreatedDateTime`, `ModifyDateTime`) VALUES
(44, 'A4C4C44ED49ACFA7E62DCB8BE71BF7BA', 6, NULL, NULL, '2017-03-24 17:48:18.000', '2017-03-24 17:48:18.000'),
(45, 'F66A2DF6B963E630EAF27C5237C7D24C', 1, NULL, NULL, '2017-03-24 17:48:18.000', '2017-03-24 17:48:18.000'),
(46, 'EF6E8C49FBD76D0E21EA138F65E158DD', 6, NULL, NULL, '2017-03-24 17:48:18.000', '2017-03-24 17:48:18.000'),
(47, '6DD2D7B53723633F695DB339FE0CC852', 1, NULL, NULL, '2017-03-24 17:48:18.000', '2017-03-24 17:48:18.000'),
(48, '81E8117515CCB0F09CF33EF71F8642B0', 1, NULL, NULL, '2017-03-24 17:48:18.000', '2017-03-24 17:48:18.000'),
(49, 'BFC2987299F75940ED82D4D4453BD350', 1, NULL, NULL, '2017-03-24 17:48:18.000', '2017-03-24 17:48:18.000'),
(50, '94A64199B60D114159F52730C40E2D95', 1, NULL, NULL, '2017-03-24 17:48:18.000', '2017-03-24 17:48:18.000'),
(51, 'FB271FB751313B9347280F60FB744454', 1, NULL, NULL, '2017-03-24 17:48:18.000', '2017-03-24 17:48:18.000'),
(52, 'B05B64376DDC70860EAE655E3A4114AB', 1, NULL, NULL, '2017-03-24 17:48:18.000', '2017-03-24 17:48:18.000'),
(53, 'C2F24C0D65B0D9EC4C77400EC6846C42', 1, NULL, NULL, '2017-03-24 19:32:56.000', '2017-03-24 19:32:56.000'),
(54, '8FAE6989F608AAA1B9E5CE063962607A', 1, NULL, NULL, '2017-03-24 19:32:56.000', '2017-03-24 19:32:56.000'),
(55, '3EB26B3A9067A88860E235967E795634', 1, NULL, NULL, '2017-03-24 19:32:56.000', '2017-03-24 19:32:56.000'),
(56, 'F4C5DE1F6118401965B9041D5BFAE051', 1, NULL, NULL, '2017-03-24 19:32:56.000', '2017-03-24 19:32:56.000'),
(57, 'F0DE6E9AA8D52AB43363C4AE999A2FF0', 1, NULL, NULL, '2017-03-24 19:32:56.000', '2017-03-24 19:32:56.000'),
(58, 'E7E0E4AAF705735E1C9AB1311A93FD10', 1, NULL, NULL, '2017-03-24 19:32:56.000', '2017-03-24 19:32:56.000'),
(59, '6491EF48E9EB7FCAFA6D504AF2AAE0A1', 1, NULL, NULL, '2017-03-24 19:32:56.000', '2017-03-24 19:32:56.000'),
(60, '8063959BA49DAFCB3DBA5C4415800286', 1, NULL, NULL, '2017-03-24 19:32:56.000', '2017-03-24 19:32:56.000'),
(61, 'D598C506110F7C76979277C2CC162143', 1, NULL, NULL, '2017-03-24 19:32:56.000', '2017-03-24 19:32:56.000'),
(62, 'C208A8DF15B08CC25C38E7280C52504D', 1, NULL, NULL, '2017-03-24 19:32:56.000', '2017-03-24 19:32:56.000'),
(63, 'F7EA37D8F3F8931F61070F89DAD78644', 1, NULL, NULL, '2017-03-24 19:32:56.000', '2017-03-24 19:32:56.000'),
(64, '422B5FE38AB4445EE4E0171D73601BAD', 1, NULL, NULL, '2017-03-24 19:32:56.000', '2017-03-24 19:32:56.000'),
(65, '9C2B3A5929FAEE512591044B94356D2A', 1, NULL, NULL, '2017-03-24 19:35:12.000', '2017-03-24 19:35:12.000'),
(66, 'E17E23EB0C8116D6C1D65973FFC75644', 1, NULL, NULL, '2017-03-24 19:35:12.000', '2017-03-24 19:35:12.000'),
(67, '50082CB651B13A10BCF21482C2AF24AE', 1, NULL, NULL, '2017-03-24 19:35:12.000', '2017-03-24 19:35:12.000'),
(68, '6C731DC62A395F75791B11696C991B54', 1, NULL, NULL, '2017-03-24 19:35:12.000', '2017-03-24 19:35:12.000'),
(69, '9865FB6F71BFBCE38ED90D613815A186', 1, NULL, NULL, '2017-03-24 19:35:12.000', '2017-03-24 19:35:12.000'),
(70, '87A8AD0CB6927EF3B2780030D1A7C314', 1, NULL, NULL, '2017-03-24 19:35:12.000', '2017-03-24 19:35:12.000'),
(71, '3E6B1F66E3D8942B32AEF9F251FD95AA', 1, NULL, NULL, '2017-03-24 19:35:12.000', '2017-03-24 19:35:12.000'),
(72, '670A51D6D95F7561FCCB102D89EF377D', 1, NULL, NULL, '2017-03-24 19:35:12.000', '2017-03-24 19:35:12.000'),
(73, 'E3E4DB941842AB971238F250035BB57C', 1, NULL, NULL, '2017-03-24 19:35:12.000', '2017-03-24 19:35:12.000'),
(74, 'AC1694FE19189F22E36B993910B8385D', 1, NULL, NULL, '2017-03-24 19:35:12.000', '2017-03-24 19:35:12.000'),
(75, 'A5D25BF85B757AF14AE09CCA98A685E9', 1, NULL, NULL, '2017-03-24 19:35:12.000', '2017-03-24 19:35:12.000'),
(76, 'EDCE428B5444765F19D4D257DB9BF1CF', 1, NULL, NULL, '2017-03-24 19:35:12.000', '2017-03-24 19:35:12.000'),
(77, 'F2D6E8C32AF20F6096CCF68CC73D7FAE', 1, NULL, NULL, '2017-03-24 19:35:12.000', '2017-03-24 19:35:12.000'),
(78, '0BE5203899B67AD6D7E7C57076BE5620', 1, NULL, NULL, '2017-03-24 19:35:12.000', '2017-03-24 19:35:12.000'),
(79, '02923C361323848813DF1504A6638CF7', 1, NULL, NULL, '2017-03-24 19:35:12.000', '2017-03-24 19:35:12.000');

-- --------------------------------------------------------

--
-- Table structure for table `SCP_LicensesPlan`
--

CREATE TABLE IF NOT EXISTS `SCP_LicensesPlan` (
  `PlanID` int(11) NOT NULL AUTO_INCREMENT,
  `PlanName` varchar(156) NOT NULL,
  `MinQty` int(11) NOT NULL,
  `MaxQty` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `CreatedDateTime` datetime NOT NULL,
  `ModifyDateTime` datetime NOT NULL,
  PRIMARY KEY (`PlanID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `SCP_LicensesPlan`
--

INSERT INTO `SCP_LicensesPlan` (`PlanID`, `PlanName`, `MinQty`, `MaxQty`, `Price`, `StatusID`, `CreatedDateTime`, `ModifyDateTime`) VALUES
(1, 'BRONZE', 0, 25, 100, 2, '2017-03-20 07:13:18', '2017-03-20 07:13:18'),
(2, 'SILVER', 25, 50, 150, 2, '2017-03-20 07:13:18', '2017-03-20 07:13:18'),
(3, 'GOLD', 25, 100, 200, 1, '2017-03-20 07:13:18', '2017-03-20 07:13:18'),
(4, 'PLATINUM', 0, 1000, 300, 1, '2017-03-20 07:13:18', '2017-03-20 07:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `SCP_MedicationForm`
--

CREATE TABLE IF NOT EXISTS `SCP_MedicationForm` (
  `FormID` int(11) NOT NULL AUTO_INCREMENT,
  `FormName` varchar(150) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  PRIMARY KEY (`FormID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_MedicationRoute`
--

CREATE TABLE IF NOT EXISTS `SCP_MedicationRoute` (
  `RouteID` int(11) NOT NULL,
  `RouteName` varchar(150) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  PRIMARY KEY (`RouteID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_MedicationTaskDetails`
--

CREATE TABLE IF NOT EXISTS `SCP_MedicationTaskDetails` (
  `MedicationTaskID` int(11) NOT NULL AUTO_INCREMENT,
  `TaskID` int(11) DEFAULT NULL,
  `MedicationFormID` int(11) DEFAULT NULL,
  `MedicationRouteID` int(11) DEFAULT NULL,
  `Location` varchar(150) DEFAULT NULL,
  `Dosage` varchar(150) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  PRIMARY KEY (`MedicationTaskID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_Messaging`
--

CREATE TABLE IF NOT EXISTS `SCP_Messaging` (
  `MessagingID` int(11) NOT NULL AUTO_INCREMENT,
  `FromID` int(11) DEFAULT NULL,
  `ToID` int(11) DEFAULT NULL,
  `Text` longtext,
  `DateTime` datetime(3) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  PRIMARY KEY (`MessagingID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_OutComes`
--

CREATE TABLE IF NOT EXISTS `SCP_OutComes` (
  `OutComeID` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(150) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  PRIMARY KEY (`OutComeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_Rights`
--

CREATE TABLE IF NOT EXISTS `SCP_Rights` (
  `RightsID` int(11) NOT NULL AUTO_INCREMENT,
  `RightsType` varchar(150) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  PRIMARY KEY (`RightsID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `SCP_Rights`
--

INSERT INTO `SCP_Rights` (`RightsID`, `RightsType`, `CreatedDateTime`, `ModifyDateTime`, `StatusID`) VALUES
(1, 'ALL', '2017-03-01 18:14:00.000', '2017-03-01 18:14:00.000', 1),
(2, 'ADD,EDIT,DELETE', '2017-03-01 18:14:00.000', '2017-03-01 18:14:00.000', 1),
(3, 'EDIT,DELETE', '2017-03-01 18:14:00.000', '2017-03-01 18:14:00.000', 1),
(4, 'EDIT', '2017-03-01 18:14:00.000', '2017-03-01 18:14:00.000', 1),
(5, 'ADD', '2017-03-01 00:00:00.000', '2017-03-01 18:14:00.000', 1),
(6, 'DELETE', '2017-03-01 00:00:00.000', '2017-03-01 00:00:00.000', 1),
(7, 'VIEWONLY', '2017-03-01 00:00:00.000', '2017-03-01 00:00:00.000', 1),
(8, 'ADD,EDIT', '2017-03-01 00:00:00.000', '2017-03-01 00:00:00.000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `SCP_Settings`
--

CREATE TABLE IF NOT EXISTS `SCP_Settings` (
  `SettingID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `SettingsTypeID` int(11) DEFAULT NULL,
  `TypeName` varchar(150) DEFAULT NULL,
  `Value` varchar(150) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  PRIMARY KEY (`SettingID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_SettingsValue`
--

CREATE TABLE IF NOT EXISTS `SCP_SettingsValue` (
  `SettingsTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `SettingsValues` varchar(150) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  PRIMARY KEY (`SettingsTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_Staff`
--

CREATE TABLE IF NOT EXISTS `SCP_Staff` (
  `StaffID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(150) DEFAULT NULL,
  `OrgID` int(11) DEFAULT NULL,
  `UserAccessID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `LicenseID` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  PRIMARY KEY (`StaffID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_Status`
--

CREATE TABLE IF NOT EXISTS `SCP_Status` (
  `StatusID` int(11) NOT NULL,
  `StatusName` varchar(150) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `ModifyDateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`StatusID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SCP_Status`
--

INSERT INTO `SCP_Status` (`StatusID`, `StatusName`, `CreatedDateTime`, `ModifyDateTime`) VALUES
(1, 'ACTIVE', '2017-03-01 18:10:00', '2017-03-01 18:10:00'),
(2, 'DEACTIVE', '2017-03-01 18:10:00', '2017-03-01 18:10:00'),
(3, 'BLOCK', '2017-03-01 18:14:00', '2017-03-01 18:14:00'),
(4, 'GRANT', '2017-03-01 00:00:00', '2017-03-01 00:00:00'),
(5, 'REVOKE', '2017-03-01 00:00:00', '2017-03-01 00:00:00'),
(6, 'DISABLED', '2017-03-08 13:30:00', '2017-03-08 13:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `SCP_Task`
--

CREATE TABLE IF NOT EXISTS `SCP_Task` (
  `TaskID` int(11) NOT NULL AUTO_INCREMENT,
  `TaskDesc` varchar(150) DEFAULT NULL,
  `TaskTypeID` int(11) DEFAULT NULL,
  `TaskStartDate` date DEFAULT NULL,
  `TaskEndDate` date DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `CreatedByStaffID` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  PRIMARY KEY (`TaskID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_Task2OtherRelations`
--

CREATE TABLE IF NOT EXISTS `SCP_Task2OtherRelations` (
  `Task2RelationID` int(11) NOT NULL AUTO_INCREMENT,
  `TaskID` int(11) DEFAULT NULL,
  `ToID` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Task2RelationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_TaskType`
--

CREATE TABLE IF NOT EXISTS `SCP_TaskType` (
  `TaskTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `TaskTypeName` varchar(150) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  PRIMARY KEY (`TaskTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_Test`
--

CREATE TABLE IF NOT EXISTS `SCP_Test` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Data` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `SCP_Test`
--

INSERT INTO `SCP_Test` (`ID`, `Data`) VALUES
(1, 'Test'),
(2, ''),
(3, ''),
(4, ''),
(5, 'Test'),
(6, ''),
(7, '');

-- --------------------------------------------------------

--
-- Table structure for table `SCP_UserAccess`
--

CREATE TABLE IF NOT EXISTS `SCP_UserAccess` (
  `UserAccessID` int(11) NOT NULL AUTO_INCREMENT,
  `RightsID` int(11) DEFAULT NULL,
  `AccessLevelID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `UserTypeID` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  PRIMARY KEY (`UserAccessID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `SCP_UserAccess`
--

INSERT INTO `SCP_UserAccess` (`UserAccessID`, `RightsID`, `AccessLevelID`, `UserID`, `UserTypeID`, `CreatedDateTime`, `ModifyDateTime`, `StatusID`) VALUES
(1, 1, 1, 1, 1, '2017-03-01 18:14:00.000', '2017-03-01 18:14:00.000', 1),
(2, 2, 1, 2, 2, '2017-03-01 18:14:00.000', '2017-03-01 18:14:00.000', 1),
(3, 2, 2, 12, 2, '2017-03-27 17:32:53.000', '2017-03-27 17:32:53.000', 1),
(4, 2, 2, 13, 2, '2017-03-30 12:43:14.000', '2017-03-30 12:43:14.000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `SCP_UserLogin`
--

CREATE TABLE IF NOT EXISTS `SCP_UserLogin` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(150) DEFAULT NULL,
  `EmailID` varchar(150) DEFAULT NULL,
  `Password` varchar(150) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `SCP_UserLogin`
--

INSERT INTO `SCP_UserLogin` (`UserID`, `UserName`, `EmailID`, `Password`, `StatusID`, `CreatedDateTime`, `ModifyDateTime`) VALUES
(1, 'scpAdmin', 'abanwar2407@gmail.com', '2bdd3604cd9755bec86999d30666994e', 1, '2017-03-01 18:10:00.000', '2017-03-01 18:10:00.000'),
(2, 'IzissTech', 'anil.banwar@izisstechnology.com', '2bdd3604cd9755bec86999d30666994e', 1, '2017-03-01 18:10:00.000', '2017-03-01 18:10:00.000'),
(12, 'rest', 'abanwar@gmail.com', 'df6d2338b2b8fce1ec2f6dda0a630eb0', 1, '2017-03-27 17:32:53.000', '2017-03-27 17:32:53.000'),
(13, 'abanwar', 'abanwar2407@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2017-03-30 12:43:14.000', '2017-03-30 12:43:14.000');

-- --------------------------------------------------------

--
-- Table structure for table `SCP_UserType`
--

CREATE TABLE IF NOT EXISTS `SCP_UserType` (
  `UserTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `UserTypeName` varchar(150) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  PRIMARY KEY (`UserTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `SCP_UserType`
--

INSERT INTO `SCP_UserType` (`UserTypeID`, `UserTypeName`, `CreatedDateTime`, `ModifyDateTime`, `StatusID`) VALUES
(1, 'SUPERADMIN', '2017-03-01 18:14:00.000', '2017-03-01 18:14:00.000', 1),
(2, 'ADMIN', '2017-03-01 18:14:00.000', '2017-03-01 18:14:00.000', 1),
(3, 'SUPERVISOR', '2017-03-01 18:14:00.000', '2017-03-01 18:14:00.000', 1),
(4, 'CAREWORKER', '2017-03-01 18:14:00.000', '2017-03-01 18:14:00.000', 1),
(5, 'PORTALUSER', '2017-03-01 18:14:00.000', '2017-03-01 18:14:00.000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `SCP_Visits`
--

CREATE TABLE IF NOT EXISTS `SCP_Visits` (
  `VisitID` int(11) NOT NULL,
  `StaffID` int(11) DEFAULT NULL,
  `VisitTitle` varchar(150) DEFAULT NULL,
  `TimeOfDay` varchar(150) DEFAULT NULL,
  `VisitTypeID` int(11) DEFAULT NULL,
  `VisitStartDate` date DEFAULT NULL,
  `VisitEndDate` date DEFAULT NULL,
  `IsFixed` tinyint(4) DEFAULT NULL,
  `VisitDays` varchar(150) DEFAULT NULL,
  `VisitStartTime` time(6) DEFAULT NULL,
  `VisitEndTime` time(6) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `OtherDetails` varchar(150) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  PRIMARY KEY (`VisitID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SCP_VisitType`
--

CREATE TABLE IF NOT EXISTS `SCP_VisitType` (
  `VisitTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `VisitTypeName` varchar(150) DEFAULT NULL,
  `CreatedDateTime` datetime(3) DEFAULT NULL,
  `ModifyDateTime` datetime(3) DEFAULT NULL,
  `StatusID` int(11) DEFAULT NULL,
  PRIMARY KEY (`VisitTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
