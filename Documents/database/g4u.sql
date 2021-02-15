-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2021 at 06:09 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g4u`
--

-- --------------------------------------------------------

--
-- Table structure for table `bitmore`
--

CREATE TABLE `bitmore` (
  `ID` int(10) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `supplierID` varchar(10) NOT NULL,
  `Products` varchar(50) NOT NULL,
  `ProductPrice` varchar(10) NOT NULL,
  `DeliveryDate` date NOT NULL,
  `ProductAvailability` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bitmore`
--

INSERT INTO `bitmore` (`ID`, `Address`, `supplierID`, `Products`, `ProductPrice`, `DeliveryDate`, `ProductAvailability`) VALUES
(1, 'Park House15-19 Greenhill CrescentWatford Business ParkHertfordshire WD18 8PH', 'BI', 'USB Power ', '995,995', '0000-00-00', 2),
(2, 'Park House15-19 Greenhill CrescentWatford Business ParkHertfordshire WD18 8PH', 'BI', 'USB Power Bank 20000mAh', '1899,1864', '2021-02-03', 1),
(3, 'Park House15-19 Greenhill CrescentWatford Business ParkHertfordshire WD18 8PH', 'BI', 'Portable Personal Fan', '565, 480', '2021-02-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brainstorm ltd`
--

CREATE TABLE `brainstorm ltd` (
  `ID` int(10) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `supplierID` varchar(10) NOT NULL,
  `Products` varchar(100) NOT NULL,
  `ProductPrice` varchar(1900) NOT NULL,
  `DeliveryDate` date NOT NULL,
  `ProductAvailability` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brainstorm ltd`
--

INSERT INTO `brainstorm ltd` (`ID`, `Address`, `supplierID`, `Products`, `ProductPrice`, `DeliveryDate`, `ProductAvailability`) VALUES
(1, 'BrainStorm LimitedUnit 1A, Mill LaneGISBURNLancashireBB7 4LN UK', 'BS', 'USB Power Bank 10000mAh', '995,995', '2021-02-04', 1),
(2, 'BrainStorm LimitedUnit 1A, Mill LaneGISBURNLancashireBB7 4LN UK', 'BS', 'Star Wars USB Cup Warmer BB-8', '1099', '2021-02-27', 1),
(3, 'BrainStorm LimitedUnit 1A, Mill LaneGISBURNLancashireBB7 4LN UK', 'BS', 'Polaroid Play 3D Pen', '2859', '2021-02-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `completedsales`
--

CREATE TABLE `completedsales` (
  `SaleID` int(11) NOT NULL,
  `Salecompletion` int(10) NOT NULL,
  `signedoffby` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `completedsales`
--

INSERT INTO `completedsales` (`SaleID`, `Salecompletion`, `signedoffby`) VALUES
(1, 1, 'john'),
(2, 1, 'jason'),
(3, 2, 'ann');

-- --------------------------------------------------------

--
-- Table structure for table `cottagetoys`
--

CREATE TABLE `cottagetoys` (
  `ID` int(10) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `supplierID` int(10) NOT NULL,
  `Products` varchar(100) NOT NULL,
  `ProductPrice` decimal(10,0) NOT NULL,
  `DeliveryDate` int(10) NOT NULL,
  `ProductAvailability` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employeetable`
--

CREATE TABLE `employeetable` (
  `EmployeeID` varchar(11) NOT NULL,
  `EmployeeName` varchar(25) NOT NULL,
  `Department` varchar(50) NOT NULL,
  `Title` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employeetable`
--

INSERT INTO `employeetable` (`EmployeeID`, `EmployeeName`, `Department`, `Title`) VALUES
('BRE510', 'Jason Brentwood', 'Senior SalesPerson GT', 'Mr'),
('DUN021', 'Sarah Dunkley', 'CEO PG4U', 'Ms'),
('HID001', 'Adrian Hidcote-Armstrong', 'MD & Chairman of G4U Boar', 'Sir'),
('VER121', 'John Vermont', 'Mgr PG4U GT Dept.', 'Mr');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Username` varchar(25) NOT NULL,
  `Password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order authorization`
--

CREATE TABLE `order authorization` (
  `SaleID` int(11) NOT NULL,
  `authorization` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderstates`
--

CREATE TABLE `orderstates` (
  `Raised(not checked)` int(11) NOT NULL,
  `ExtraCheck` int(11) NOT NULL,
  `Confirmed(NotSent)` int(11) NOT NULL,
  `sent(supplierquries)` int(11) NOT NULL,
  `sent(awaitingDelivery)` int(11) NOT NULL,
  `FailedCheck` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(10) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `ProductPrice` decimal(10,0) NOT NULL,
  `ProductQuantity` int(100) NOT NULL,
  `SupplierID` varchar(11) NOT NULL,
  `ProductImage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shenzhenhousing`
--

CREATE TABLE `shenzhenhousing` (
  `ID` int(10) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `supplierID` varchar(10) NOT NULL,
  `Products` varchar(100) NOT NULL,
  `ProductPrice` decimal(10,0) NOT NULL,
  `DeliveryDate` date NOT NULL,
  `ProductAvailability` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bitmore`
--
ALTER TABLE `bitmore`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `brainstorm ltd`
--
ALTER TABLE `brainstorm ltd`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `completedsales`
--
ALTER TABLE `completedsales`
  ADD PRIMARY KEY (`SaleID`);

--
-- Indexes for table `cottagetoys`
--
ALTER TABLE `cottagetoys`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employeetable`
--
ALTER TABLE `employeetable`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `order authorization`
--
ALTER TABLE `order authorization`
  ADD PRIMARY KEY (`SaleID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `shenzhenhousing`
--
ALTER TABLE `shenzhenhousing`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bitmore`
--
ALTER TABLE `bitmore`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brainstorm ltd`
--
ALTER TABLE `brainstorm ltd`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `completedsales`
--
ALTER TABLE `completedsales`
  MODIFY `SaleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cottagetoys`
--
ALTER TABLE `cottagetoys`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shenzhenhousing`
--
ALTER TABLE `shenzhenhousing`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
