-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2018 at 02:34 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proj_rent`
--

-- --------------------------------------------------------

--
-- Table structure for table `agreement`
--

CREATE TABLE `agreement` (
  `id` varchar(5) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `customer` varchar(5) NOT NULL,
  `staff` varchar(5) NOT NULL,
  `invoice` varchar(5) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

CREATE TABLE `fine` (
  `id` varchar(5) NOT NULL,
  `date` date NOT NULL,
  `agreement` varchar(5) NOT NULL,
  `late` int(10) NOT NULL,
  `damage` int(10) NOT NULL,
  `invoice` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` varchar(5) NOT NULL,
  `date` date NOT NULL,
  `amount` int(10) NOT NULL,
  `ref` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(5) NOT NULL,
  `rate_rent` int(10) NOT NULL,
  `rate_ship` int(10) NOT NULL,
  `rate_late` int(10) NOT NULL,
  `rate_damage` int(10) NOT NULL,
  `rate_deposit` int(10) NOT NULL,
  `count_all` int(5) NOT NULL,
  `count_damage` int(5) NOT NULL,
  `count_inrent` int(5) NOT NULL,
  `count_ready` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `type`, `rate_rent`, `rate_ship`, `rate_late`, `rate_damage`, `rate_deposit`, `count_all`, `count_damage`, `count_inrent`, `count_ready`) VALUES
('P0001', 'MSI GL63 8RD-406TH', 'T0001', 350, 100, 530, 34900, 17450, 10, 0, 0, 10),
('P0002', 'Acer Swift SF114-32-P1UY/T001', 'T0001', 125, 100, 190, 12490, 6250, 10, 2, 0, 8),
('P0003', 'Lenovo ThinkPad X270', 'T0001', 460, 100, 690, 45500, 22750, 10, 0, 0, 10),
('P0004', 'Acer Aspire TC-830-504G1T00Mi/T003', 'T0002', 90, 300, 140, 8900, 4450, 10, 0, 0, 10),
('P0005', 'Lenovo IdeaCentreIC 510A-15ARR', 'T0002', 130, 300, 200, 12900, 6450, 10, 0, 0, 10),
('P0006', 'DELL Vostro V3470-W268954202THW10', 'T0002', 120, 300, 180, 11900, 5950, 10, 0, 0, 10),
('P0007', 'Lenovo Think TS TS150 (70UBS00G00)', 'T0003', 185, 500, 280, 18500, 9250, 10, 0, 0, 10),
('P0008', 'Dell PowerEdge R230 E3-1220v6(SNSR23020)', 'T0003', 450, 500, 680, 45000, 22500, 10, 0, 0, 10),
('P0009', 'HPE MicroServer X3216 (873830-375)', 'T0003', 165, 500, 250, 16400, 8200, 10, 0, 0, 10),
('P0010', 'LED 18.5\'', 'T0004', 25, 300, 40, 2520, 1260, 10, 0, 0, 10),
('P0011', 'LED 21.5\'', 'T0004', 35, 300, 50, 3600, 1800, 10, 0, 0, 10),
('P0012', 'LED 23.8\'', 'T0004', 85, 300, 130, 8600, 4300, 10, 0, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `receive`
--

CREATE TABLE `receive` (
  `id` varchar(5) NOT NULL,
  `date` date NOT NULL,
  `agreement` varchar(5) NOT NULL,
  `ps` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

CREATE TABLE `rent` (
  `id` int(5) NOT NULL,
  `agreement` varchar(5) NOT NULL,
  `product` varchar(5) NOT NULL,
  `count` int(5) NOT NULL,
  `deposit` int(10) NOT NULL,
  `service` int(10) NOT NULL,
  `receive_good` int(5) DEFAULT NULL,
  `receive_bad` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
('T0001', 'Notebook'),
('T0002', 'Desktop'),
('T0003', 'Server'),
('T0004', 'Monitor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agreement`
--
ALTER TABLE `agreement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer` (`customer`),
  ADD KEY `staff` (`staff`),
  ADD KEY `invoice` (`invoice`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fine`
--
ALTER TABLE `fine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agreement` (`agreement`),
  ADD KEY `invoice` (`invoice`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `receive`
--
ALTER TABLE `receive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agreement` (`agreement`);

--
-- Indexes for table `rent`
--
ALTER TABLE `rent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agreement` (`agreement`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rent`
--
ALTER TABLE `rent`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agreement`
--
ALTER TABLE `agreement`
  ADD CONSTRAINT `agreement_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agreement_ibfk_2` FOREIGN KEY (`staff`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agreement_ibfk_3` FOREIGN KEY (`invoice`) REFERENCES `invoice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fine`
--
ALTER TABLE `fine`
  ADD CONSTRAINT `fine_ibfk_1` FOREIGN KEY (`agreement`) REFERENCES `agreement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fine_ibfk_2` FOREIGN KEY (`invoice`) REFERENCES `invoice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receive`
--
ALTER TABLE `receive`
  ADD CONSTRAINT `receive_ibfk_1` FOREIGN KEY (`agreement`) REFERENCES `agreement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rent`
--
ALTER TABLE `rent`
  ADD CONSTRAINT `rent_ibfk_1` FOREIGN KEY (`agreement`) REFERENCES `agreement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rent_ibfk_2` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
