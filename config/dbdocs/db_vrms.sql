-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2020 at 10:05 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_vrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbr_colorvariants`
--

CREATE TABLE `tbr_colorvariants` (
  `colorVariantsID` int(11) NOT NULL,
  `vehicleID` int(11) NOT NULL,
  `colorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbr_comfort`
--

CREATE TABLE `tbr_comfort` (
  `comfortID` int(11) NOT NULL,
  `vehicleID` int(11) NOT NULL,
  `powerControls` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `climateControl` tinyint(1) NOT NULL COMMENT '0 - No\r\n1 - Yes',
  `cruiseControl` tinyint(1) NOT NULL COMMENT '0 - No\r\n1 - Yes',
  `airCondition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbr_financeemi`
--

CREATE TABLE `tbr_financeemi` (
  `financeID` int(11) NOT NULL,
  `ownershipID` int(11) NOT NULL,
  `monthlyAmount` double NOT NULL,
  `paidFinanceAmount` double NOT NULL,
  `balanceAmountToBePaid` double NOT NULL,
  `financeCompany` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbr_financepaymentrecords`
--

CREATE TABLE `tbr_financepaymentrecords` (
  `FPRID` int(11) NOT NULL,
  `financeID` int(11) NOT NULL,
  `lastDateOfPayment` date NOT NULL,
  `dateOfPayment` date NOT NULL,
  `isAmountPaid` tinyint(1) NOT NULL COMMENT '0 - No\r\n1 - Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbr_infotainment`
--

CREATE TABLE `tbr_infotainment` (
  `infortainmentID` int(11) NOT NULL,
  `vehicleID` int(11) NOT NULL,
  `infoSystem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `speakers` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wirelessCharging` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connectivity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interface` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Touch, Button, Gesture, Voice',
  `navSystem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbr_outletstockrecords`
--

CREATE TABLE `tbr_outletstockrecords` (
  `OSRID` int(11) NOT NULL,
  `sellingOutletID` int(11) NOT NULL,
  `vehicleID` int(11) NOT NULL,
  `stockNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbr_ownershiprecords`
--

CREATE TABLE `tbr_ownershiprecords` (
  `ownershipID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `purchaseID` int(11) NOT NULL,
  `colorVariantsID` int(11) NOT NULL,
  `regNo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agreementDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbr_performance`
--

CREATE TABLE `tbr_performance` (
  `performanceID` int(11) NOT NULL,
  `vehicleID` int(11) NOT NULL,
  `topSpeed` float NOT NULL,
  `engineType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maxTorque` float NOT NULL,
  `maxPower` float NOT NULL,
  `noOfCylinder` int(11) NOT NULL,
  `turbo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driveType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbr_productionrecords`
--

CREATE TABLE `tbr_productionrecords` (
  `PRID` int(11) NOT NULL,
  `vehicleID` int(11) NOT NULL,
  `productionYear` year(4) NOT NULL,
  `noOfVehiclesProduced` int(11) NOT NULL,
  `noOfvehiclesSold` int(11) NOT NULL,
  `noOfVehiclesWithDealers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbr_purchases`
--

CREATE TABLE `tbr_purchases` (
  `purchaseID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `vehicleID` int(11) NOT NULL,
  `dealerID` int(11) NOT NULL,
  `paymentAmount` float NOT NULL,
  `advPaidAmount` float NOT NULL,
  `balanceAmount` float NOT NULL,
  `financeEMI` tinyint(1) NOT NULL COMMENT '0 - False\r\n1 - True',
  `imported` tinyint(1) NOT NULL COMMENT '0 - False\r\n1 - True'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbr_safety`
--

CREATE TABLE `tbr_safety` (
  `safetyID` int(11) NOT NULL,
  `vehicleID` int(11) NOT NULL,
  `airbags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crashSensor` tinyint(1) NOT NULL,
  `abs` tinyint(1) NOT NULL,
  `shatterResistantGlass` tinyint(1) NOT NULL,
  `tractionControl` tinyint(1) NOT NULL,
  `electronicStabControl` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbr_shipping`
--

CREATE TABLE `tbr_shipping` (
  `shippingID` int(11) NOT NULL,
  `purchaseID` int(11) NOT NULL,
  `shippingAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customsDuty` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbr_suspension`
--

CREATE TABLE `tbr_suspension` (
  `suspensionID` int(11) NOT NULL,
  `vehicleID` int(11) NOT NULL,
  `frontSuspension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rearSuspension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `steeringType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `turningRadius` float NOT NULL,
  `brakeType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbr_testdriverecords`
--

CREATE TABLE `tbr_testdriverecords` (
  `testdriveID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `dealerID` int(11) NOT NULL,
  `vehicleID` int(11) NOT NULL,
  `sellingOutletID` int(11) NOT NULL,
  `driveDate` date NOT NULL,
  `driveTime` time NOT NULL,
  `request` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'Accepted/\r\nRejected/\r\nRescheduled/\r\nPending',
  `complete` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'Completed/Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_auth`
--

CREATE TABLE `tb_auth` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `isLoggedIn` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_auth`
--

INSERT INTO `tb_auth` (`id`, `userID`, `username`, `token`, `isLoggedIn`) VALUES
(1, 1, 'amrameen769', 'f3717e72a3c2ce7234d2cbceb84cb5bd1466fd02170f31ad92933542d1391036', 1),
(2, 4, 'guardianangel0507', '5887ef3bab5ce5e1a8e1333ea6b211572cbde6e3ab053a238c294784f8160c5c', 0),
(3, 6, 'merc', '9141b13bb6e05b312e2c46bf389a2bff9f642bbdde1e13e2b8bc57566dc446ac', 0),
(4, 9, 'alphin', '20f04495ef096dfb47bac7da76b7b147566710668a5a0be3c3c96ab7091335e6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_colors`
--

CREATE TABLE `tb_colors` (
  `colorID` int(11) NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_customers`
--

CREATE TABLE `tb_customers` (
  `ID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `noOfVehiclesOwned` int(11) NOT NULL DEFAULT 0,
  `noOfVehiclesBooked` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_customers`
--

INSERT INTO `tb_customers` (`ID`, `customerID`, `noOfVehiclesOwned`, `noOfVehiclesBooked`) VALUES
(1, 4, 0, 0),
(2, 9, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_dealers`
--

CREATE TABLE `tb_dealers` (
  `ID` int(11) NOT NULL,
  `dealerID` int(11) NOT NULL,
  `manufacturerID` int(11) NOT NULL,
  `noOfSellingOutlets` int(11) DEFAULT 0,
  `noOfVehiclesSold` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_dealers`
--

INSERT INTO `tb_dealers` (`ID`, `dealerID`, `manufacturerID`, `noOfSellingOutlets`, `noOfVehiclesSold`) VALUES
(3, 2, 6, 0, 0),
(4, 17, 10, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_manufacturers`
--

CREATE TABLE `tb_manufacturers` (
  `ID` int(11) NOT NULL,
  `manufacturerID` int(11) NOT NULL,
  `noOfDealers` int(11) NOT NULL DEFAULT 0,
  `noOfProductOutlets` int(11) NOT NULL DEFAULT 0,
  `noOfVehicles` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_manufacturers`
--

INSERT INTO `tb_manufacturers` (`ID`, `manufacturerID`, `noOfDealers`, `noOfProductOutlets`, `noOfVehicles`) VALUES
(1, 6, 1, 0, 0),
(2, 10, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sellingoutlets`
--

CREATE TABLE `tb_sellingoutlets` (
  `sellingOutletID` int(11) NOT NULL,
  `dealerID` int(11) NOT NULL,
  `outletName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oultletAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `outletPhoneNo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `userID` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phoneNo` bigint(20) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userType` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activeStatus` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 - False(Inactive)\r\n1 - True(Active)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`userID`, `name`, `username`, `email`, `password`, `phoneNo`, `address`, `userType`, `activeStatus`) VALUES
(1, 'Al Ameen AR', 'amrameen769', 'amrameen769@gmail.com', '7025', 7025886445, 'Al Ameen Manzil', 'admin', 1),
(2, 'Popular Vehicles', 'popularvh', 'popularvh@gmail.com', '1234', 7845123265, 'bla bla bla', 'dealer', 0),
(3, 'Rosbee', 'rosbee05', 'rosbee0506@gmail.com', '1234', 8606107201, 'Chittayam House', 'customer', 1),
(4, 'Richard Brooks', 'guardianangel0507', 'guardianangel0507@gmail.com', '0507', 8943199646, 'Willington Mansion', 'customer', 1),
(5, 'Abdullah Bin Mubarak', 'abduvjd', 'abduvjd@gmail.com', '1234', 7412589632, '1234 Main Street, Buckingham', 'customer', 1),
(6, 'Mercedes', 'merc', 'mercedes@gmail.com', '1234', 997788, '1234 Street Mexico', 'manufacturer', 1),
(7, 'Samal', 'samalpgd', 'samalpgd@gmail.com', '1234', 7458745877, '1234 Street Kenya', 'customer', 1),
(8, 'Anzalna', 'anzu', 'anzalnaar@gmail.com', '1234', 7845125487, '1234 Street Canada', 'customer', 1),
(9, 'Alphin', 'alphin', 'alphinmay30@gmail.com', '1234', 9865326598, '1234 Street Paravoor', 'customer', 1),
(10, 'Volkswagen BMW', 'vkbm', 'vkbmw@gmail.com', '1234', 4115444, 'Vw Headquarters, SanFransico', 'manufacturer', 1),
(11, 'LandRover', 'landrover', 'landroverwheels@gmail.com', '1234', 77889966, 'Landrover Hover, LK Streets, Britain', 'manufacturer', 0),
(12, 'Lexus', 'lexus', 'contact@lexus.com', '1234', 44115555, 'Lexus HQ, Tai Chi, Japan', 'manufacturer', 0),
(16, 'Toyota MotorVehicles', 'toyota', 'contact@toyota.com', '1234', 2536897, 'Toyota HQ, Japan', 'manufacturer', 0),
(17, 'Kallingal Bajaj', 'bajajkallingal', 'bajajkallingal@gmail.com', '1234', 7485964152, '1234 Street, Kallingal ', 'dealer', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_vehicles`
--

CREATE TABLE `tb_vehicles` (
  `vehicleID` int(11) NOT NULL,
  `manufacturerID` int(11) NOT NULL,
  `vehicleName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicleModel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicleCategory` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicleClass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `onRoadPrice` float NOT NULL,
  `fuelType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engineCC` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mileage` float NOT NULL,
  `emiAvailable` tinyint(1) NOT NULL COMMENT '0 - False\r\n1 - True',
  `userRating` int(2) NOT NULL,
  `power` int(11) NOT NULL,
  `fuelTankCapacity` float NOT NULL,
  `seatingCapacity` int(3) NOT NULL,
  `insurance` tinyint(1) NOT NULL COMMENT '0 - False\r\n1 - True',
  `maintenanceCost` float NOT NULL,
  `transmissionType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbr_colorvariants`
--
ALTER TABLE `tbr_colorvariants`
  ADD PRIMARY KEY (`colorVariantsID`),
  ADD KEY `VEHICLE_FOREIGN_INDEX` (`vehicleID`),
  ADD KEY `COLOR_FOREIGN_INDEX` (`colorID`);

--
-- Indexes for table `tbr_comfort`
--
ALTER TABLE `tbr_comfort`
  ADD PRIMARY KEY (`comfortID`),
  ADD KEY `VEHICLE_FOREIGN_INDEX` (`vehicleID`);

--
-- Indexes for table `tbr_financeemi`
--
ALTER TABLE `tbr_financeemi`
  ADD PRIMARY KEY (`financeID`),
  ADD KEY `OWNERSHIPS_FOREIGN_INDEX` (`ownershipID`);

--
-- Indexes for table `tbr_financepaymentrecords`
--
ALTER TABLE `tbr_financepaymentrecords`
  ADD PRIMARY KEY (`FPRID`),
  ADD KEY `FINANCEEMI_FOREIGN_INDEX` (`financeID`);

--
-- Indexes for table `tbr_infotainment`
--
ALTER TABLE `tbr_infotainment`
  ADD PRIMARY KEY (`infortainmentID`),
  ADD KEY `VEHICLE_FOREIGN_INDEX` (`vehicleID`);

--
-- Indexes for table `tbr_outletstockrecords`
--
ALTER TABLE `tbr_outletstockrecords`
  ADD PRIMARY KEY (`OSRID`),
  ADD KEY `SELLOUTLET_FOREIGN_INDEX` (`sellingOutletID`),
  ADD KEY `VEHICLE_FOREIGN_INDEX` (`vehicleID`);

--
-- Indexes for table `tbr_ownershiprecords`
--
ALTER TABLE `tbr_ownershiprecords`
  ADD PRIMARY KEY (`ownershipID`),
  ADD KEY `CUSTOMER_FOREIGN_INDEX` (`customerID`),
  ADD KEY `PURCHASE_FOREIGN_INDEX` (`purchaseID`),
  ADD KEY `COLORVARIANT_FOREIGN_INDEX` (`colorVariantsID`);

--
-- Indexes for table `tbr_performance`
--
ALTER TABLE `tbr_performance`
  ADD PRIMARY KEY (`performanceID`),
  ADD KEY `VEHICLE_FOREIGN_INDEX` (`vehicleID`);

--
-- Indexes for table `tbr_productionrecords`
--
ALTER TABLE `tbr_productionrecords`
  ADD PRIMARY KEY (`PRID`),
  ADD KEY `VEHICLE_FOREIGN_INDEX` (`vehicleID`);

--
-- Indexes for table `tbr_purchases`
--
ALTER TABLE `tbr_purchases`
  ADD PRIMARY KEY (`purchaseID`),
  ADD KEY `CUSTOMER_FOREIGN_INDEX` (`customerID`),
  ADD KEY `VEHICLE_FOREIGN_INDEX` (`vehicleID`),
  ADD KEY `DEALER_FOREIGN_INDEX` (`dealerID`);

--
-- Indexes for table `tbr_safety`
--
ALTER TABLE `tbr_safety`
  ADD PRIMARY KEY (`safetyID`),
  ADD KEY `VEHICLE_FOREIGN_INDEX` (`vehicleID`);

--
-- Indexes for table `tbr_shipping`
--
ALTER TABLE `tbr_shipping`
  ADD PRIMARY KEY (`shippingID`),
  ADD KEY `PURCHASE_FOREIGN_INDEX` (`purchaseID`);

--
-- Indexes for table `tbr_suspension`
--
ALTER TABLE `tbr_suspension`
  ADD PRIMARY KEY (`suspensionID`),
  ADD KEY `VEHICLE_FOREIGN_INDEX` (`vehicleID`);

--
-- Indexes for table `tbr_testdriverecords`
--
ALTER TABLE `tbr_testdriverecords`
  ADD PRIMARY KEY (`testdriveID`),
  ADD KEY `CUSTOMER_FOREIGN_INDEX` (`customerID`),
  ADD KEY `DEALER_FOREIGN_INDEX` (`dealerID`),
  ADD KEY `VEHICLE_FOREIGN_INDEX` (`vehicleID`),
  ADD KEY `SELLOUTLET_FOREIGN_INDEX` (`sellingOutletID`);

--
-- Indexes for table `tb_auth`
--
ALTER TABLE `tb_auth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD UNIQUE KEY `IS_AUTHENTICATED` (`userID`) USING BTREE;

--
-- Indexes for table `tb_colors`
--
ALTER TABLE `tb_colors`
  ADD PRIMARY KEY (`colorID`);

--
-- Indexes for table `tb_customers`
--
ALTER TABLE `tb_customers`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNIQUE_USERID` (`customerID`) USING BTREE,
  ADD KEY `USER_FOREIGN_INDEX` (`customerID`) USING BTREE;

--
-- Indexes for table `tb_dealers`
--
ALTER TABLE `tb_dealers`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNIQUE_USERID` (`dealerID`) USING BTREE,
  ADD KEY `USER_FOREIGN_INDEX` (`dealerID`),
  ADD KEY `MANUFACTURER_FOREIGN_INDEX` (`manufacturerID`);

--
-- Indexes for table `tb_manufacturers`
--
ALTER TABLE `tb_manufacturers`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNIQUE_USERID` (`manufacturerID`) USING BTREE,
  ADD KEY `USER_FOREIGN_INDEX` (`manufacturerID`) USING BTREE;

--
-- Indexes for table `tb_sellingoutlets`
--
ALTER TABLE `tb_sellingoutlets`
  ADD PRIMARY KEY (`sellingOutletID`),
  ADD KEY `DEALER_FOREIGN_INDEX` (`dealerID`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `USERNAME_UNIQUE_INDEX` (`username`) USING BTREE,
  ADD UNIQUE KEY `EMAIL_UNIQUE_INDEX` (`email`) USING BTREE;

--
-- Indexes for table `tb_vehicles`
--
ALTER TABLE `tb_vehicles`
  ADD PRIMARY KEY (`vehicleID`),
  ADD KEY `PATENT_FOREIGN_INDEX` (`manufacturerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbr_colorvariants`
--
ALTER TABLE `tbr_colorvariants`
  MODIFY `colorVariantsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbr_comfort`
--
ALTER TABLE `tbr_comfort`
  MODIFY `comfortID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbr_financeemi`
--
ALTER TABLE `tbr_financeemi`
  MODIFY `financeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbr_financepaymentrecords`
--
ALTER TABLE `tbr_financepaymentrecords`
  MODIFY `FPRID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbr_infotainment`
--
ALTER TABLE `tbr_infotainment`
  MODIFY `infortainmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbr_outletstockrecords`
--
ALTER TABLE `tbr_outletstockrecords`
  MODIFY `OSRID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbr_ownershiprecords`
--
ALTER TABLE `tbr_ownershiprecords`
  MODIFY `ownershipID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbr_performance`
--
ALTER TABLE `tbr_performance`
  MODIFY `performanceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbr_productionrecords`
--
ALTER TABLE `tbr_productionrecords`
  MODIFY `PRID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbr_purchases`
--
ALTER TABLE `tbr_purchases`
  MODIFY `purchaseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbr_safety`
--
ALTER TABLE `tbr_safety`
  MODIFY `safetyID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbr_shipping`
--
ALTER TABLE `tbr_shipping`
  MODIFY `shippingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbr_suspension`
--
ALTER TABLE `tbr_suspension`
  MODIFY `suspensionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbr_testdriverecords`
--
ALTER TABLE `tbr_testdriverecords`
  MODIFY `testdriveID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_auth`
--
ALTER TABLE `tb_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_colors`
--
ALTER TABLE `tb_colors`
  MODIFY `colorID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_customers`
--
ALTER TABLE `tb_customers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_dealers`
--
ALTER TABLE `tb_dealers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_manufacturers`
--
ALTER TABLE `tb_manufacturers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_sellingoutlets`
--
ALTER TABLE `tb_sellingoutlets`
  MODIFY `sellingOutletID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_vehicles`
--
ALTER TABLE `tb_vehicles`
  MODIFY `vehicleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbr_colorvariants`
--
ALTER TABLE `tbr_colorvariants`
  ADD CONSTRAINT `COLORS_FOREIGN_CONSTRAINT_COLORVARIANTS` FOREIGN KEY (`colorID`) REFERENCES `tb_colors` (`colorID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VEHICLES_FOREIGN_CONSTRAINT_COLORVARIANTS` FOREIGN KEY (`vehicleID`) REFERENCES `tb_vehicles` (`vehicleID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbr_comfort`
--
ALTER TABLE `tbr_comfort`
  ADD CONSTRAINT `VEHICLES_FOREIGN_CONSTRAINT_COMFORT` FOREIGN KEY (`vehicleID`) REFERENCES `tb_vehicles` (`vehicleID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbr_financeemi`
--
ALTER TABLE `tbr_financeemi`
  ADD CONSTRAINT `OWNERSHIPS_FOREIGN_CONSTRAINT_FINANCEEMI` FOREIGN KEY (`ownershipID`) REFERENCES `tbr_ownershiprecords` (`ownershipID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbr_financepaymentrecords`
--
ALTER TABLE `tbr_financepaymentrecords`
  ADD CONSTRAINT `FINANCEEMI_FOREIGN_CONSTRAINT_FPR` FOREIGN KEY (`financeID`) REFERENCES `tbr_financeemi` (`financeID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbr_infotainment`
--
ALTER TABLE `tbr_infotainment`
  ADD CONSTRAINT `VEHICLES_FOREIGN_CONSTRAINT_INFOTAINMENT` FOREIGN KEY (`vehicleID`) REFERENCES `tb_vehicles` (`vehicleID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbr_outletstockrecords`
--
ALTER TABLE `tbr_outletstockrecords`
  ADD CONSTRAINT `SELLINGOUTLETS_FOREIGN_CONSTRAINT_STOCKRECORDS` FOREIGN KEY (`sellingOutletID`) REFERENCES `tb_sellingoutlets` (`sellingOutletID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VEHICLES FOREIGN_CONSTRAINT_STOCKRECORDS` FOREIGN KEY (`vehicleID`) REFERENCES `tb_vehicles` (`vehicleID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbr_ownershiprecords`
--
ALTER TABLE `tbr_ownershiprecords`
  ADD CONSTRAINT `COLORVARIANTS_FOREIGN_CONSTRAINT_OWNERSHIPS` FOREIGN KEY (`colorVariantsID`) REFERENCES `tbr_colorvariants` (`colorVariantsID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `CUSTOMERS_FOREIGN_CONSTRAINT_OWNERSHIPS` FOREIGN KEY (`customerID`) REFERENCES `tb_customers` (`customerID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `PURCHASES_FOREIGN_CONSTRAINT_OWNERSHIPS` FOREIGN KEY (`purchaseID`) REFERENCES `tbr_purchases` (`purchaseID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbr_performance`
--
ALTER TABLE `tbr_performance`
  ADD CONSTRAINT `VEHICLES_FOREIGN_CONSTRAINT_PERFORMANCE` FOREIGN KEY (`vehicleID`) REFERENCES `tb_vehicles` (`vehicleID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbr_productionrecords`
--
ALTER TABLE `tbr_productionrecords`
  ADD CONSTRAINT `VEHICLES_FOREIGN_CONSTRAINT_PRODRECORDS` FOREIGN KEY (`vehicleID`) REFERENCES `tb_vehicles` (`vehicleID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbr_purchases`
--
ALTER TABLE `tbr_purchases`
  ADD CONSTRAINT `CUSTOMERS_FOREIGN_CONTRAINT_PURCHASES` FOREIGN KEY (`customerID`) REFERENCES `tb_customers` (`customerID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `DEALERS_FOREIGN_CONTRAINT_PURCHASES` FOREIGN KEY (`dealerID`) REFERENCES `tb_dealers` (`dealerID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VEHICLES_FOREIGN_CONTRAINT_PURCHASES` FOREIGN KEY (`vehicleID`) REFERENCES `tb_vehicles` (`vehicleID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbr_safety`
--
ALTER TABLE `tbr_safety`
  ADD CONSTRAINT `VEHICLES_FOREIGN_CONSTRAINT_SAFETY` FOREIGN KEY (`vehicleID`) REFERENCES `tb_vehicles` (`vehicleID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbr_shipping`
--
ALTER TABLE `tbr_shipping`
  ADD CONSTRAINT `PURCHASES_FOREIGN_CONSTRAINT_SHIPPING` FOREIGN KEY (`purchaseID`) REFERENCES `tbr_purchases` (`purchaseID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbr_suspension`
--
ALTER TABLE `tbr_suspension`
  ADD CONSTRAINT `VEHICLES_FOREIGN_CONSTRAINT_SUSPENSION` FOREIGN KEY (`vehicleID`) REFERENCES `tb_vehicles` (`vehicleID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbr_testdriverecords`
--
ALTER TABLE `tbr_testdriverecords`
  ADD CONSTRAINT `CUSTOMERS_FOREIGN_CONSRAINT_TESTDRIVE` FOREIGN KEY (`customerID`) REFERENCES `tb_customers` (`customerID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `DEALERS_FOREIGN_CONSRAINT_TESTDRIVE` FOREIGN KEY (`dealerID`) REFERENCES `tb_dealers` (`dealerID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `SELLOUTLETS_FOREIGN_CONSRAINT_TESTDRIVE` FOREIGN KEY (`sellingOutletID`) REFERENCES `tb_sellingoutlets` (`sellingOutletID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VEHICLES_FOREIGN_CONSRAINT_TESTDRIVE` FOREIGN KEY (`vehicleID`) REFERENCES `tb_vehicles` (`vehicleID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_auth`
--
ALTER TABLE `tb_auth`
  ADD CONSTRAINT `IS_AUTHENTICATED` FOREIGN KEY (`userID`) REFERENCES `tb_users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_customers`
--
ALTER TABLE `tb_customers`
  ADD CONSTRAINT `USERS_FOREIGN_CONSTRAINT_CUSTOMERS` FOREIGN KEY (`customerID`) REFERENCES `tb_users` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_dealers`
--
ALTER TABLE `tb_dealers`
  ADD CONSTRAINT `MANUFACTURERS_FOREIGN_CONSTRAINT_DEALERS` FOREIGN KEY (`manufacturerID`) REFERENCES `tb_manufacturers` (`manufacturerID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `USERS_FOREIGN_CONSTRAINT_DEALERS` FOREIGN KEY (`dealerID`) REFERENCES `tb_users` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_manufacturers`
--
ALTER TABLE `tb_manufacturers`
  ADD CONSTRAINT `USERS_FOREIGN_CONSTRAINT_MANUFACTURER` FOREIGN KEY (`manufacturerID`) REFERENCES `tb_users` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_sellingoutlets`
--
ALTER TABLE `tb_sellingoutlets`
  ADD CONSTRAINT `DEALERS_FOREIGN_CONTRAINT_SELLINGOUTLETS` FOREIGN KEY (`dealerID`) REFERENCES `tb_dealers` (`dealerID`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_vehicles`
--
ALTER TABLE `tb_vehicles`
  ADD CONSTRAINT `PATENT_FOREIGN_CONSTRAINT_VEHICLES` FOREIGN KEY (`manufacturerID`) REFERENCES `tb_manufacturers` (`manufacturerID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
