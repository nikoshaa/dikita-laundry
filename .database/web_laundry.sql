-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 06:07 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_karyawan`
--

CREATE TABLE `tbl_karyawan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_karyawan`
--

INSERT INTO `tbl_karyawan` (`id`, `nama`, `username`, `password`, `email`, `no_hp`, `alamat`, `catatan`, `image`, `role`) VALUES
(1, 'Wildan Hafidz Mauludin', 'admin', '$2y$10$MTm15IHxkcTNGTMoPMRcaeMyYqGIc5U6UPk4PymX/sggGNSyT4hMe', 'admin@dikitalaundry.com', '+6285320357152', 'Simpang Remujung Lowokwaru Malang Jawa Timur', 'Focusing', '108Foto Profile.jpeg', 'Admin'),
(2, 'Yasmine Navisha Andani', '<br />\r\n<b>Warning</b>:  Undef', '$2y$10$mp5Uet8mXWCTKY9OIU7LyOUHXoXZMXMmE1bAHxjhFYHz/FOOPY1t6', 'yasminenavisha@gmail.com', '08520357152', 'Dinoyo Malang Jawa Timur', 'Targeting', '925Dikita Laundry.png', 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paket`
--

CREATE TABLE `tbl_paket` (
  `id` varchar(10) NOT NULL,
  `paket` varchar(100) NOT NULL,
  `harga_kilo` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_paket`
--

INSERT INTO `tbl_paket` (`id`, `paket`, `harga_kilo`, `deskripsi`) VALUES
('PKT001', 'Murah Meriah', 5000, 'Selesai 3 hari = Cuci + Kering Setrika'),
('PKT002', 'Cuci Komplit', 8000, 'Selesai 1 hari = Cuci + Kering + Setrika'),
('PKT003', 'Cuci Kering', 5000, 'Selesai 1 hari'),
('PKT004', 'Cuci Basah', 3500, 'Selesai 1 hari'),
('PKT005', 'Setrika', 5000, 'Selesai 1 hari'),
('PKT006', 'Cuci Ekspres', 15000, 'Selesai 6 jam = Cuci + Kering + Setrika'),
('PKT007', 'Cuci Kilat', 25000, 'Selesai 3 jam = Komplit + Bonus Kaus Laundry Ku'),
('PKT008', 'VIP', 75000, 'Selesai 2 jam = Komplit + Bonus Kaus & Celana Laundry Ku + Antar langsung'),
('PKT009', 'VVIP', 120000, 'Selesai 1 jam = Komplit + Bonus Kaus & Celana Laundru Ku + Tas Khusus Laundry Ku + Antar langsung '),
('PKT010', 'VVIP', 120000, 'Selesai 1 jam = Komplit + Bonus Kaus & Celana Laundru Ku + Tas Khusus Laundry Ku + Antar langsung ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id`, `nama`, `alamat`, `no_hp`) VALUES
('PLG001', 'Abdullah Azzam', 'Griya Shanta', '080000000000'),
('PLG002', 'Ahmad Bima Tristan Ibrahim', 'Simbar Menjangan', '080000001111'),
('PLG003', 'Dimitri Abdullah', 'Sudimoro', '080000002222'),
('PLG004', 'Andhito Galih Nur Cahyo', 'Dau', '080000003333'),
('PLG005', 'Naresh Pratista', 'Semanggi', '080000004444'),
('PLG009', 'Yuliyana Rahmawati', 'Kedung Kandang', '080000008888'),
('PLG006', 'Hafshah Rahmadita', 'Senggani', '080000005555'),
('PLG007', 'Bima Syahputra Purba', 'Kesumba', '080000006666'),
('PLG008', 'Chairil Anwar', 'Pisang Kipas', '080000007777'),
('PLG010', 'Dina Ira Pandini Purba', 'Semanggi', '080000009999');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id` varchar(10) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `id_pelanggan` varchar(10) NOT NULL,
  `kd_paket` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id`, `tanggal`, `id_pelanggan`, `kd_paket`, `qty`, `biaya`, `bayar`, `kembalian`) VALUES
('TRS001', '24 Nov 2020', 'PLG001', 'PKT001', 7, 35000, 50000, 15000),
('TRS002', '24 Nov 2020', 'PLG002', 'PKT001', 5, 25000, 50000, 25000),
('TRS003', '24 Nov 2020', 'PLG005', 'PKT002', 8, 64000, 70000, 6000),
('TRS004', '25 Nov 2020', 'PLG022', 'PKT009', 10, 1200000, 1200000, 0),
('TRS005', '25 Nov 2020', 'PLG025', 'PKT008', 5, 375000, 400000, 25000),
('TRS006', '25 Nov 2020', 'PLG031', 'PKT007', 2, 50000, 50000, 0),
('TRS007', '25 Nov 2020', 'PLG018', 'PKT005', 2, 10000, 10000, 0),
('TRS008', '25 Nov 2020', 'PLG027', 'PKT006', 3, 45000, 50000, 5000),
('TRS009', '25 Nov 2020', 'PLG014', 'PKT006', 5, 75000, 30000, -45000),
('TRS010', '25 Nov 2020', 'PLG003', 'PKT009', 10, 1200000, 1200000, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `kd_paket` (`kd_paket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
