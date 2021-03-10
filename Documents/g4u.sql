-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Mar 2021, 11:08
-- Wersja serwera: 10.1.13-MariaDB
-- Wersja PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `g4u`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_level` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `first_name`, `last_name`, `username`, `password`, `created`, `user_level`) VALUES
(1, 'test1@g4u.com', 'test1', 'test1', 'test1', '$2y$10$7bRLHJQWH2bqzWDvtSMUdunn2oi1hE08xcwC.E9OhVEJKxfg8utH6', '2020-11-10 11:18:17', 0),
(2, 'test3@g4u.com', 'test2', 'test2', 'test2', '$2y$10$7bRLHJQWH2bqzWDvtSMUdunn2oi1hE08xcwC.E9OhVEJKxfg8utH6', '2020-11-04 15:35:39', 1),
(3, 'test2@g4u.com', 'test3', 'test3', 'test3', '$2y$10$7bRLHJQWH2bqzWDvtSMUdunn2oi1hE08xcwC.E9OhVEJKxfg8utH6', '2020-11-30 13:58:26', 2),
(4, 'Adrian.H.A@g4u.com', '', '', 'HID001', '$2y$10$7bRLHJQWH2bqzWDvtSMUdunn2oi1hE08xcwC.E9OhVEJKxfg8utH6', '2021-03-08 16:08:03', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bitmore`
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
-- Zrzut danych tabeli `bitmore`
--

INSERT INTO `bitmore` (`ID`, `Address`, `supplierID`, `Products`, `ProductPrice`, `DeliveryDate`, `ProductAvailability`) VALUES
(1, 'Park House15-19 Greenhill CrescentWatford Business ParkHertfordshire WD18 8PH', 'BI', 'USB Power ', '995,995', '0000-00-00', 2),
(2, 'Park House15-19 Greenhill CrescentWatford Business ParkHertfordshire WD18 8PH', 'BI', 'USB Power Bank 20000mAh', '1899,1864', '2021-02-03', 1),
(3, 'Park House15-19 Greenhill CrescentWatford Business ParkHertfordshire WD18 8PH', 'BI', 'Portable Personal Fan', '565, 480', '2021-02-25', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `brainstorm ltd`
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
-- Zrzut danych tabeli `brainstorm ltd`
--

INSERT INTO `brainstorm ltd` (`ID`, `Address`, `supplierID`, `Products`, `ProductPrice`, `DeliveryDate`, `ProductAvailability`) VALUES
(1, 'BrainStorm LimitedUnit 1A, Mill LaneGISBURNLancashireBB7 4LN UK', 'BS', 'USB Power Bank 10000mAh', '995,995', '2021-02-04', 1),
(2, 'BrainStorm LimitedUnit 1A, Mill LaneGISBURNLancashireBB7 4LN UK', 'BS', 'Star Wars USB Cup Warmer BB-8', '1099', '2021-02-27', 1),
(3, 'BrainStorm LimitedUnit 1A, Mill LaneGISBURNLancashireBB7 4LN UK', 'BS', 'Polaroid Play 3D Pen', '2859', '2021-02-18', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `completedsales`
--

CREATE TABLE `completedsales` (
  `SaleID` int(11) NOT NULL,
  `Salecompletion` int(10) NOT NULL,
  `signedoffby` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `completedsales`
--

INSERT INTO `completedsales` (`SaleID`, `Salecompletion`, `signedoffby`) VALUES
(1, 1, 'john'),
(2, 1, 'jason'),
(3, 2, 'ann');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cottagetoys`
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
-- Struktura tabeli dla tabeli `employeetable`
--

CREATE TABLE `employeetable` (
  `EmployeeID` varchar(11) NOT NULL,
  `EmployeeName` varchar(25) NOT NULL,
  `Department` varchar(50) NOT NULL,
  `Title` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `employeetable`
--

INSERT INTO `employeetable` (`EmployeeID`, `EmployeeName`, `Department`, `Title`) VALUES
('BRE510', 'Jason Brentwood', 'Senior SalesPerson GT', 'Mr'),
('DUN021', 'Sarah Dunkley', 'CEO PG4U', 'Ms'),
('HID001', 'Adrian Hidcote-Armstrong', 'MD & Chairman of G4U Boar', 'Sir'),
('VER121', 'John Vermont', 'Mgr PG4U GT Dept.', 'Mr');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `login`
--

CREATE TABLE `login` (
  `Username` varchar(25) NOT NULL,
  `Password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order authorization`
--

CREATE TABLE `order authorization` (
  `SaleID` int(11) NOT NULL,
  `authorization` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orderstates`
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
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `ID` int(10) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `ProductPrice` decimal(10,0) NOT NULL,
  `ProductQuantity` int(100) NOT NULL,
  `SupplierID` varchar(11) NOT NULL,
  `ProductImage` varchar(50) NOT NULL,
  `available` enum('0','1') CHARACTER SET utf8 NOT NULL COMMENT '0-available,1-unavailable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`ID`, `ProductName`, `ProductPrice`, `ProductQuantity`, `SupplierID`, `ProductImage`, `available`) VALUES
(1, 'USB Power Bank 10000mAh', '995', 10, 'BI, BS', 'productimg1.jpg', '0'),
(2, 'USB Power Bank 20000mAh', '1899', 10, 'BI, BS', 'productimg2.jpg', '0'),
(3, 'USB Power Bank 25800mAh', '1999', 10, 'BI, BS', 'productimg3.jpg', '0'),
(5, 'Spider Catcher', '199', 10, 'SH, BS ', 'productimg4.jpg', '0'),
(6, 'Portable Personal Fan', '565', 10, 'BI, SH', 'productimg5.jpg', '0'),
(9, 'Star Wars USB Cup Warmer BB-8', '1099', 10, 'BS, BI, SH', 'productimg6.jpg', '0'),
(10, 'Polaroid Play 3D Pen', '2859', 10, 'SH, BS', 'productimg7.jpg', '0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `shenzhenhousing`
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
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT dla tabeli `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `bitmore`
--
ALTER TABLE `bitmore`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `brainstorm ltd`
--
ALTER TABLE `brainstorm ltd`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `completedsales`
--
ALTER TABLE `completedsales`
  MODIFY `SaleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `cottagetoys`
--
ALTER TABLE `cottagetoys`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `shenzhenhousing`
--
ALTER TABLE `shenzhenhousing`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
