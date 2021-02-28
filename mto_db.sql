-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 28, 2021 at 06:12 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mto_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mtopribor`
--

CREATE TABLE `mtopribor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT 'Наименование прибора'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mtopribor`
--

INSERT INTO `mtopribor` (`id`, `name`) VALUES
(1, 'водосчетчик ХВС'),
(2, 'водосчетчик ХВС'),
(3, 'водосчетчик ГВС'),
(4, 'электросчетчик	'),
(5, 'газовый счетчик ');

-- --------------------------------------------------------

--
-- Table structure for table `mtoto`
--

CREATE TABLE `mtoto` (
  `id` int(11) NOT NULL,
  `kod` varchar(10) DEFAULT NULL COMMENT 'Код',
  `name` varchar(255) DEFAULT NULL COMMENT 'Наименование ТО',
  `address` varchar(255) DEFAULT NULL COMMENT 'Адрес'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mtoto`
--

INSERT INTO `mtoto` (`id`, `kod`, `name`, `address`) VALUES
(1, '01', 'отдел 1', 'г. Уфа, ул. Заки Валиди, 6'),
(2, '02', 'отдел 2', 'г. Уфа, ул. Цюрупы, 9'),
(3, '03', 'отдел 3', 'г. Уфа, ул. Мусоргского, 1'),
(4, '62', 'отдел 4', 'г. Уфа, ул. Мусоргского, 9 ');

-- --------------------------------------------------------

--
-- Table structure for table `mto_schetchiki`
--

CREATE TABLE `mto_schetchiki` (
  `id` int(11) NOT NULL,
  `id_otd` int(11) DEFAULT NULL COMMENT 'Наименование отдела',
  `id_pribor` int(11) DEFAULT NULL,
  `dateIzg` date DEFAULT NULL COMMENT 'Дата изготовления ( согласно паспорту)',
  `dateZam` date DEFAULT NULL COMMENT 'Дата поверки/ замены',
  `srok` int(11) DEFAULT NULL COMMENT 'Срок службы'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mto_schetchiki`
--

INSERT INTO `mto_schetchiki` (`id`, `id_otd`, `id_pribor`, `dateIzg`, `dateZam`, `srok`) VALUES
(1, 1, 0, '2028-06-20', '2026-06-02', 6),
(2, 2, 0, '2001-09-20', '2022-01-09', 6),
(3, 3, 0, '2001-01-20', '2022-01-01', 6),
(4, 4, 0, '2001-10-20', '2025-01-10', 6),
(5, 4, 2, '2001-01-20', '2024-01-01', 16),
(6, 1, 0, '2010-07-20', '2025-10-07', 6),
(7, 2, 1, '2004-08-20', '2023-04-08', 6),
(8, 2, 2, '2001-01-20', '2032-01-01', 16),
(9, 3, 2, '2001-01-20', '2032-01-01', 16),
(10, 4, 0, '2011-04-20', '2024-11-04', 6);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_mtopribor`
-- (See below for the actual view)
--
CREATE TABLE `v_mtopribor` (
`address` varchar(255)
,`dateIzg` date
,`dateZam` date
,`id` int(11)
,`id_pribor` int(11)
,`id_schet` int(11)
,`kod` varchar(10)
,`nameOtd` varchar(255)
,`pribor` varchar(255)
,`srok` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `v_mtopribor`
--
DROP TABLE IF EXISTS `v_mtopribor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_mtopribor`  AS  select `sch`.`id` AS `id`,`mtoto`.`kod` AS `kod`,`mtoto`.`name` AS `nameOtd`,`mtoto`.`address` AS `address`,`pr`.`name` AS `pribor`,`sch`.`dateIzg` AS `dateIzg`,`sch`.`dateZam` AS `dateZam`,`sch`.`srok` AS `srok`,`pr`.`id` AS `id_pribor`,`sch`.`id` AS `id_schet` from ((`mto_schetchiki` `sch` join `mtoto`) join `mtopribor` `pr`) where ((`sch`.`id_otd` = `mtoto`.`id`) and (`sch`.`id_pribor` = `pr`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mtopribor`
--
ALTER TABLE `mtopribor`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `mtoto`
--
ALTER TABLE `mtoto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `mto_schetchiki`
--
ALTER TABLE `mto_schetchiki`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mtopribor`
--
ALTER TABLE `mtopribor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mtoto`
--
ALTER TABLE `mtoto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mto_schetchiki`
--
ALTER TABLE `mto_schetchiki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
