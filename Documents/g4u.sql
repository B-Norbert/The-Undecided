-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Kwi 2021, 17:40
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
  `user_level` int(11) NOT NULL DEFAULT '0',
  `appointment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `first_name`, `last_name`, `username`, `password`, `created`, `user_level`, `appointment`) VALUES
(1, 'Mustafa.M@g4u.com', 'Mustafa', 'Mahmood', 'MAH042', '$2y$10$7bRLHJQWH2bqzWDvtSMUdunn2oi1hE08xcwC.E9OhVEJKxfg8utH6', '2020-11-10 11:18:17', 6, 'Sales Assistant GT'),
(2, 'John.V@g4u.com', 'John', 'Vermont', 'VER121', '$2y$10$7bRLHJQWH2bqzWDvtSMUdunn2oi1hE08xcwC.E9OhVEJKxfg8utH6', '2020-11-04 15:35:39', 3, 'Mgr PG4U GT Dept'),
(3, 'Ann.G@g4u.com', 'Ann', 'Greengold', 'GRE056', '$2y$10$7bRLHJQWH2bqzWDvtSMUdunn2oi1hE08xcwC.E9OhVEJKxfg8utH6', '2020-11-30 13:58:26', 5, 'Assistant QA Controller ACC Dept'),
(4, 'Adrian.H.A@g4u.com', 'Adrian Hidcote', 'Armstrong', 'HID001', '$2y$10$7bRLHJQWH2bqzWDvtSMUdunn2oi1hE08xcwC.E9OhVEJKxfg8utH6', '2021-03-08 16:08:03', 1, 'MD & Chairman of G4U Board'),
(5, 'Jason.B@g4u.com', 'Jason', 'Brentwood', 'BRE510', '$2y$10$7bRLHJQWH2bqzWDvtSMUdunn2oi1hE08xcwC.E9OhVEJKxfg8utH6', '2021-04-23 21:17:33', 4, 'Senior Sales GT'),
(6, 'Amanda.P@g4u.com', 'Amanda', 'Patel', 'PAT201', '$2y$10$7bRLHJQWH2bqzWDvtSMUdunn2oi1hE08xcwC.E9OhVEJKxfg8utH6', '2021-04-08 00:27:30', 6, 'Sales Assistant GT'),
(7, 'Sarah.D@g4u.com', 'Sarah', 'Dunkley', 'DUN021', '$2y$10$Ly6SbXl9emLc3qmAErKRTeKUUkDc4xdh7522/nn8CQ97b14IHJ7cm$2y$10$7bRLHJQWH2bqzWDvtSMUdunn2oi1hE08xcwC.E9OhVEJKxfg8utH6', '2021-04-13 22:51:49', 2, 'CEO PG4U'),
(8, 'Jennifer.G@g4u.com', 'Jennifer', 'Green', 'GRE123', '$2y$10$7bRLHJQWH2bqzWDvtSMUdunn2oi1hE08xcwC.E9OhVEJKxfg8utH6', '2021-04-13 23:30:47', 6, 'Sales Assistant GT'),
(9, 'Derek.P@g4u.com', 'Derek', 'Pitts', 'PIT101', '$2y$10$7bRLHJQWH2bqzWDvtSMUdunn2oi1hE08xcwC.E9OhVEJKxfg8utH6', '2021-04-13 23:31:27', 6, 'Sales Assistant GT'),
(10, 'Enrico.P@g4u.com', 'Enrico', 'Piam', 'PIA412', '$2y$10$7bRLHJQWH2bqzWDvtSMUdunn2oi1hE08xcwC.E9OhVEJKxfg8utH6', '2021-04-13 23:31:42', 6, 'Sales Assistant GT');

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
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `ID` int(10) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `ProductType` varchar(11) NOT NULL,
  `ProductCode` varchar(11) NOT NULL,
  `ProductPrice` double(10,2) NOT NULL,
  `ProductTax` decimal(4,2) NOT NULL,
  `ProductQuantity` int(100) NOT NULL,
  `SupplierID` varchar(11) NOT NULL,
  `ProductImage` varchar(50) NOT NULL,
  `available` enum('0','1') CHARACTER SET utf8 NOT NULL COMMENT '0-available,1-unavailable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`ID`, `ProductName`, `ProductType`, `ProductCode`, `ProductPrice`, `ProductTax`, `ProductQuantity`, `SupplierID`, `ProductImage`, `available`) VALUES
(1, 'USB Power Bank 10000mAh', 'gadgets', 'PWR41', 9.95, '20.00', 127, 'BI, BS', 'gadgets_image.jpg', '0'),
(2, 'USB Power Bank 20000mAh', 'gadgets', 'PWR43', 19.00, '20.00', 24, 'BI, BS', 'gadgets_image.jpg', '0'),
(3, 'USB Power Bank 25800mAh', 'gadgets', 'PWR44', 19.99, '20.00', 10, 'BI, BS', 'gadgets_image.jpg', '0'),
(5, 'Spider Catcher', 'gadgets', 'SC01', 19.90, '20.00', 10, 'SH, BS ', 'gadgets_image.jpg', '0'),
(6, 'Portable Personal Fan', 'gadgets', 'PPF03', 56.50, '20.00', 10, 'BI, SH', 'gadgets_image.jpg', '0'),
(9, 'Star Wars USB Cup Warmer BB-8', 'gadgets', 'SW08', 109.99, '20.00', 10, 'BS, BI, SH', 'gadgets_image.jpg', '0'),
(10, 'Polaroid Play 3D Pen', 'gadgets', 'POL03', 28.59, '20.00', 10, 'SH, BS', 'gadgets_image.jpg', '0'),
(11, 'Nerf N-Strike Elite Disruptor', 'toys', 'NRF10', 12.00, '20.00', 231, 'BI, SH', 'toys_image.jpg', '0'),
(12, 'KLIKBOT Studio Thud', 'toys', 'KST01', 9.00, '20.00', 123, 'Bi, SH', 'toys_image.jpg', '0'),
(13, 'Plan Toys Pinball', 'toys', 'PIN00', 40.00, '20.00', 21, 'BI, CT', 'toys_image.jpg', '0'),
(14, 'Funko Pop! Disney: Frozen 2 - Olaf', 'toys', 'FP59', 8.00, '20.00', 263, 'SH, CT', 'toys_image.jpg', '0'),
(15, 'LEGO Classic Bricks and Ideas - 11001', 'toys', 'LEX95', 8.00, '20.00', 153, 'SH, CT', 'toys_image.jpg', '0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products_order`
--

CREATE TABLE `products_order` (
  `products_order_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `products_order_total` double(10,2) NOT NULL,
  `products_order_date` date NOT NULL,
  `products_order_notes` text NOT NULL,
  `products_order_supplier` varchar(255) NOT NULL,
  `products_order_status` text NOT NULL,
  `products_order_process` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `products_order`
--

INSERT INTO `products_order` (`products_order_id`, `account_id`, `products_order_total`, `products_order_date`, `products_order_notes`, `products_order_supplier`, `products_order_status`, `products_order_process`) VALUES
(1, 0, 385.43, '2021-04-21', '', '12', 'credit', 'active'),
(2, 0, 0.00, '2021-04-21', '', '12', 'credit', 'active'),
(3, 0, 0.00, '2021-04-21', '', '12', 'cash', 'active'),
(4, 0, 0.00, '2021-04-21', '', '12', 'cash', 'active'),
(5, 0, 1137.92, '2021-04-21', '', '12', 'cash', 'active'),
(6, 0, 169750.56, '2021-04-21', '', 'BS', 'cash', 'active'),
(7, 0, 128.08, '2021-04-21', '', '4', 'cash', 'active'),
(8, 0, 2013.18, '2021-04-21', '', 'asd', 'cash', 'active'),
(9, 0, 89.60, '2021-04-22', '', '2', 'cash', 'active'),
(10, 0, 1021.44, '2021-04-22', '', 'BS', 'cash', 'active'),
(11, 0, 219.30, '2021-04-22', '', 'BS', 'cash', 'active'),
(12, 0, 89.60, '2021-04-22', '', 'bs', 'cash', 'active'),
(13, 4, 111.60, '2021-04-23', '', 'BS', 'cash', 'active'),
(14, 4, 72.00, '2021-04-23', '', 'bs', 'inactive', 'cash'),
(15, 4, 243.54, '2021-04-23', '', 'BS', 'credit', 'inactive'),
(16, 4, 1016.10, '2021-04-23', 'Just testing if it works', 'bs', 'credit', 'active'),
(17, 4, 76.80, '2021-04-23', 'Testing states', 'BS', 'active', 'test'),
(18, 4, 96.00, '2021-04-24', 'testing', 'bs', 'active', 'test'),
(19, 4, 0.00, '0000-00-00', '', '', 'inactive', 'Delivered'),
(20, 4, 0.00, '0000-00-00', '', '', 'inactive', 'Sent awaiting delivery'),
(21, 4, 57.60, '2021-04-27', 's', '12', 'inactive', 'Sent awaiting delivery'),
(22, 4, 76.80, '2021-04-27', 'ft', '12', 'inactive', 'Sent awaiting delivery'),
(23, 4, 1286.40, '2021-04-27', 's', 's', 'inactive', 'Sent awaiting delivery'),
(24, 4, 643.20, '2021-04-27', 'test', '12', 'active', 'Sent awaiting delivery'),
(25, 4, 71.64, '2021-04-27', '4562', '4', 'inactive', 'Sent awaiting delivery'),
(26, 4, 279.00, '2021-04-27', '234', '3', 'inactive', 'Sent awaiting delivery');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products_order_list`
--

CREATE TABLE `products_order_list` (
  `products_order_list_id` int(11) NOT NULL,
  `products_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `tax` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `products_order_list`
--

INSERT INTO `products_order_list` (`products_order_list_id`, `products_order_id`, `product_id`, `quantity`, `price`, `tax`) VALUES
(2, 6, 10, 12, 2859.00, 12.00),
(3, 6, 3, 4, 1999.00, 12.00),
(4, 6, 9, 66, 1099.00, 12.00),
(5, 6, 6, 65, 565.00, 12.00),
(6, 7, 10, 4, 28.59, 12.00),
(7, 8, 5, 12, 19.90, 12.00),
(8, 8, 9, 12, 109.99, 12.00),
(9, 8, 1, 12, 9.95, 12.00),
(10, 8, 1, 12, 9.95, 12.00),
(13, 5, 14, 12, 8.00, 12.00),
(14, 5, 14, 4, 8.00, 12.00),
(15, 5, 14, 46, 8.00, 12.00),
(16, 5, 14, 65, 8.00, 12.00),
(17, 9, 14, 2, 8.00, 12.00),
(18, 9, 14, 5, 8.00, 12.00),
(19, 9, 15, 3, 8.00, 12.00),
(38, 11, 15, 3, 8.00, 12.00),
(39, 11, 1, 4, 9.95, 12.00),
(40, 11, 11, 7, 12.00, 12.00),
(41, 11, 14, 6, 8.00, 12.00),
(43, 1, 11, 12, 12.00, 12.00),
(44, 1, 10, 7, 28.59, 12.00),
(45, 10, 14, 44, 8.00, 12.00),
(46, 10, 15, 44, 8.00, 12.00),
(47, 10, 13, 4, 40.00, 12.00),
(48, 10, 15, 6, 8.00, 12.00),
(49, 12, 15, 4, 8.00, 12.00),
(50, 12, 11, 4, 12.00, 12.00),
(51, 13, 11, 4, 12.00, 20.00),
(52, 13, 12, 5, 9.00, 20.00),
(65, 14, 15, 3, 8.00, 20.00),
(66, 14, 11, 3, 12.00, 20.00),
(69, 15, 10, 5, 28.59, 20.00),
(70, 15, 11, 5, 12.00, 20.00),
(71, 16, 12, 5, 9.00, 20.00),
(72, 16, 1, 5, 9.95, 20.00),
(73, 16, 11, 6, 12.00, 20.00),
(74, 16, 13, 17, 40.00, 20.00),
(75, 17, 15, 4, 8.00, 20.00),
(76, 17, 14, 4, 8.00, 20.00),
(77, 18, 14, 5, 8.00, 20.00),
(78, 18, 15, 5, 8.00, 20.00),
(79, 19, 12, 12, 9.00, 20.00),
(80, 19, 14, 4, 8.00, 20.00),
(87, 22, 14, 8, 8.00, 20.00),
(88, 23, 14, 134, 8.00, 20.00),
(89, 23, 15, 47, 8.00, 20.00),
(90, 24, 15, 67, 8.00, 20.00),
(91, 25, 1, 6, 9.95, 20.00),
(92, 26, 1, 10, 9.95, 20.00),
(93, 26, 2, 7, 19.00, 20.00);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `completedsales`
--
ALTER TABLE `completedsales`
  ADD PRIMARY KEY (`SaleID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products_order`
--
ALTER TABLE `products_order`
  ADD PRIMARY KEY (`products_order_id`);

--
-- Indexes for table `products_order_list`
--
ALTER TABLE `products_order_list`
  ADD PRIMARY KEY (`products_order_list_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT dla tabeli `completedsales`
--
ALTER TABLE `completedsales`
  MODIFY `SaleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `products_order`
--
ALTER TABLE `products_order`
  MODIFY `products_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT dla tabeli `products_order_list`
--
ALTER TABLE `products_order_list`
  MODIFY `products_order_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
