-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 03:41 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpasien`
--

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `kode_pasien` varchar(255) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `umur` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_kamar` varchar(255) NOT NULL,
  `kategori_kamar` varchar(255) NOT NULL,
  `nama_dokter` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `kode_pasien`, `nama_pasien`, `umur`, `alamat`, `no_kamar`, `kategori_kamar`, `nama_dokter`, `keterangan`) VALUES
(1, 'P-0001', 'Andi Hidayat', '28', 'Jl.Cemara Jakarta Utara', '4', 'Mawar', 'dr. Marthin Limba', 'Serangan Jantung'),
(2, 'P-0002', 'Arianto', '35', 'Jl. Manggis Jakarta Timur', '2', 'Anggrek', 'dr. Martina Yulianti', 'Hipertensi'),
(3, 'P-0003', 'Ratna Suminar', '30', 'Jl. Cililitan Jakarta Barat', '1', 'Melati', 'dr. Christofel Korah Tooy', 'Diabetes'),
(4, 'P-0004', 'Eko Sugiarto', '47', 'Jl. Jelambar Raya Jakarta Barat', '2', 'Melati', 'dr. Martina Yulianti', 'Hipertensi'),
(5, 'P-0005', 'Kusyudi', '20', 'Jl. Raya Condet Jakarta Timur', '1', 'Mawar', 'dr. Aisyah Radiallah', 'Tipes'),
(6, 'P-0006', 'Wati Anggoro', '17', 'Jl. Pemuda Jakarta Timur', '1', 'Anggrek', 'dr. Pipin Abdillah', 'Anemia'),
(7, 'P-0007', 'Joko Priyatno', '50', 'Jl. Kebon Sirih Jakarta Pusat', '2', 'Mawar', 'dr. Marthin Limba', 'Serangan Jantung'),
(8, 'P-0008', 'Intan Hasibuan', '65', 'Jl. Benyamin Sueb Jakarta Utara', '4', 'Melati', 'dr. Christofel Korah Tooy', 'Diabetes'),
(9, 'P-0009', 'Mulyati', '68', 'Jl. Antasari Jakarta Selatan', '3', 'Anggrek', 'dr. Martina Yulianti', 'Hipertensi'),
(10, 'P-0010', 'Dedi Listiadi', '76', 'Jl. Pulomas Timur Jakarta Timur', '4', 'Anggrek', 'dr. Christofel Korah Tooy', 'Diabetes'),
(18, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
