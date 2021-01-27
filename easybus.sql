-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2019 at 11:42 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easybus`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_booking`
--

CREATE TABLE `data_booking` (
  `id_booking` int(11) NOT NULL,
  `id_seat` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `status_bayar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_jadwal`
--

CREATE TABLE `data_jadwal` (
  `id_jadwal` varchar(10) NOT NULL,
  `id_PO` varchar(2) NOT NULL,
  `berangkat` varchar(20) NOT NULL,
  `tujuan` varchar(20) NOT NULL,
  `harga` int(6) NOT NULL,
  `jam_berangkat` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_jadwal`
--

INSERT INTO `data_jadwal` (`id_jadwal`, `id_PO`, `berangkat`, `tujuan`, `harga`, `jam_berangkat`) VALUES
('EF1', 'EF', 'Yogyakarta', 'Purwokerto', 70000, '07'),
('EF2', 'EF', 'Yogyakarta', 'Purwokerto', 70000, '12'),
('EF3', 'EF', 'Yogyakarta', 'Purwokerto', 70000, '17'),
('EF4', 'EF', 'Semarang', 'Cilacap', 110000, '06'),
('EF5', 'EF', 'Semarang', 'Cilacap', 110000, '12'),
('EF6', 'EF', 'Semarang', 'Cilacap', 110000, '18'),
('EF7', 'EF', 'Semarang', 'Cilacap', 110000, '21'),
('SA1', 'SA', 'Semarang', 'Cilacap', 100000, '05'),
('SA2', 'SA', 'Semarang', 'Cilacap', 100000, '10'),
('SA3', 'SA', 'Semarang', 'Cilacap', 100000, '09'),
('SA4', 'SA', 'Semarang', 'Cilacap', 100000, '12'),
('SA5', 'SA', 'Semarang', 'Cilacap', 100000, '15'),
('SA6', 'SA', 'Semarang', 'Cilacap', 100000, '18');

-- --------------------------------------------------------

--
-- Table structure for table `data_po`
--

CREATE TABLE `data_po` (
  `id_PO` varchar(2) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `seat_max` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_po`
--

INSERT INTO `data_po` (`id_PO`, `nama`, `seat_max`) VALUES
('EF', 'Efisiensi', 40),
('SA', 'Sumber Alam', 18);

-- --------------------------------------------------------

--
-- Table structure for table `data_seat`
--

CREATE TABLE `data_seat` (
  `id_seat` int(11) NOT NULL,
  `id_jadwal` varchar(10) NOT NULL,
  `no_seat` varchar(3) NOT NULL,
  `tanggal_berangkat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`username`, `password`, `nama`, `no_telp`, `level`) VALUES
('admin1', 'admin123', 'Administrator1', '', 'admin'),
('dionisiusjovan@easybus.com', '12345678', 'Dionisius Jovan', '082128033000', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_booking`
--
ALTER TABLE `data_booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_seat` (`id_seat`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `data_jadwal`
--
ALTER TABLE `data_jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_PO` (`id_PO`);

--
-- Indexes for table `data_po`
--
ALTER TABLE `data_po`
  ADD PRIMARY KEY (`id_PO`);

--
-- Indexes for table `data_seat`
--
ALTER TABLE `data_seat`
  ADD PRIMARY KEY (`id_seat`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_booking`
--
ALTER TABLE `data_booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_seat`
--
ALTER TABLE `data_seat`
  MODIFY `id_seat` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_booking`
--
ALTER TABLE `data_booking`
  ADD CONSTRAINT `data_booking_ibfk_1` FOREIGN KEY (`id_seat`) REFERENCES `data_seat` (`id_seat`),
  ADD CONSTRAINT `data_booking_ibfk_2` FOREIGN KEY (`username`) REFERENCES `data_user` (`username`);

--
-- Constraints for table `data_jadwal`
--
ALTER TABLE `data_jadwal`
  ADD CONSTRAINT `data_jadwal_ibfk_1` FOREIGN KEY (`id_PO`) REFERENCES `data_po` (`id_PO`);

--
-- Constraints for table `data_seat`
--
ALTER TABLE `data_seat`
  ADD CONSTRAINT `data_seat_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `data_jadwal` (`id_jadwal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
