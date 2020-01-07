-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2019 at 09:05 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hackathon`
--

-- --------------------------------------------------------

--
-- Table structure for table `catatan_penjualan`
--

CREATE TABLE `catatan_penjualan` (
  `id_catatan_penjualan` int(11) NOT NULL,
  `saldo_penjualan` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catatan_penjualan`
--

INSERT INTO `catatan_penjualan` (`id_catatan_penjualan`, `saldo_penjualan`, `id_penjualan`) VALUES
(1, 119850, 2),
(2, 119850, 2),
(3, 280500, 4),
(4, 663000, 5),
(5, 0, 6),
(6, 1186600, 6),
(7, 1842800, 7),
(8, 1759500, 8),
(9, 1825800, 9),
(10, 2189600, 10);

-- --------------------------------------------------------

--
-- Table structure for table `catatan_tabungan`
--

CREATE TABLE `catatan_tabungan` (
  `id_catatan_tabungan` int(11) NOT NULL,
  `saldo_tabungan` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `id_penarikan` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catatan_tabungan`
--

INSERT INTO `catatan_tabungan` (`id_catatan_tabungan`, `saldo_tabungan`, `status`, `id_penarikan`, `id_pembelian`) VALUES
(7, 1000, 'penarikan', 1, 0),
(8, 1000, 'penarikan', 2, 0),
(12, 8000, 'penarikan', 3, 0),
(13, 2000, 'penarikan', 4, 0),
(14, 10000, 'penarikan', 5, 0),
(19, 102000, 'penabungan', 0, 1),
(20, 35700, 'penabungan', 0, 2),
(21, 671500, 'penabungan', 0, 3),
(22, 377400, 'penabungan', 0, 4),
(26, 200000, 'penarikan', 6, 0),
(27, 60000, 'penarikan', 7, 0),
(28, 16500, 'penarikan', 8, 0),
(29, 10000, 'penarikan', 9, 0),
(34, 483650, 'penabungan', 0, 5),
(35, 881450, 'penabungan', 0, 6),
(36, 386750, 'penabungan', 0, 7),
(37, 8500, 'penabungan', 0, 10),
(38, 65450, 'penabungan', 0, 11),
(39, 10000, 'penarikan', 10, 0),
(40, 102000, 'penarikan', 11, 0),
(41, 686800, 'penabungan', 0, 12),
(42, 670650, 'penabungan', 0, 13),
(43, 396100, 'penabungan', 0, 14),
(44, 436050, 'penabungan', 0, 15),
(45, 250, 'penarikan', 12, 0),
(46, 4600, 'penarikan', 13, 0),
(47, 9700, 'penarikan', 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detil_pembelian`
--

CREATE TABLE `detil_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_nm_sampah` int(11) NOT NULL,
  `berat_pembelian` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detil_pembelian`
--

INSERT INTO `detil_pembelian` (`id_pembelian`, `id_nm_sampah`, `berat_pembelian`) VALUES
(1, 1, 12),
(2, 5, 21),
(3, 1, 11),
(3, 6, 21),
(3, 6, 13),
(4, 5, 12),
(4, 6, 21),
(5, 6, 11),
(5, 5, 11),
(5, 7, 21),
(6, 6, 31),
(6, 7, 21),
(6, 3, 34),
(7, 6, 21),
(7, 6, 14),
(8, 6, 21),
(10, 3, 1),
(11, 4, 1),
(11, 5, 2),
(11, 7, 3),
(12, 5, 21),
(12, 6, 31),
(12, 6, 21),
(12, 7, 11),
(13, 5, 11),
(13, 6, 21),
(13, 6, 21),
(13, 6, 31),
(14, 5, 11),
(14, 1, 14),
(14, 6, 21),
(14, 8, 1),
(15, 5, 21),
(15, 6, 1),
(15, 5, 21);

-- --------------------------------------------------------

--
-- Table structure for table `detil_penjualan`
--

CREATE TABLE `detil_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_nm_sampah` int(11) NOT NULL,
  `berat_penjualan` float NOT NULL,
  `harga_penjualan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detil_penjualan`
--

INSERT INTO `detil_penjualan` (`id_penjualan`, `id_nm_sampah`, `berat_penjualan`, `harga_penjualan`) VALUES
(2, 1, 12, 10000),
(2, 5, 21, 1000),
(3, 1, 12, 10000),
(3, 5, 21, 12000),
(4, 1, 12, 10000),
(4, 5, 21, 10000),
(5, 1, 23, 10000),
(5, 5, 21, 10000),
(5, 6, 34, 10000),
(6, 1, 23, 10000),
(6, 5, 33, 2000),
(6, 6, 55, 20000),
(7, 3, 34, 21000),
(7, 5, 11, 10000),
(7, 6, 77, 12000),
(7, 7, 42, 10000),
(8, 3, 35, 20000),
(8, 5, 11, 10000),
(8, 6, 77, 12000),
(8, 7, 42, 8000),
(9, 3, 35, 10000),
(9, 4, 1, 11000),
(9, 5, 13, 12000),
(9, 6, 77, 13000),
(9, 7, 45, 14000),
(10, 1, 14, 10000),
(10, 5, 85, 12000),
(10, 6, 147, 9000),
(10, 7, 11, 8000),
(10, 8, 1, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_sampah`
--

CREATE TABLE `jenis_sampah` (
  `id_jn_sampah` int(11) NOT NULL,
  `nm_jn_sampah` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_sampah`
--

INSERT INTO `jenis_sampah` (`id_jn_sampah`, `nm_jn_sampah`) VALUES
(1, 'pelastik'),
(2, 'kertas'),
(3, 'logam'),
(4, 'karet'),
(5, 'kaca');

-- --------------------------------------------------------

--
-- Table structure for table `nama_sampah`
--

CREATE TABLE `nama_sampah` (
  `id_nm_sampah` int(11) NOT NULL,
  `nm_sampah` varchar(20) NOT NULL,
  `id_jn_sampah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nama_sampah`
--

INSERT INTO `nama_sampah` (`id_nm_sampah`, `nm_sampah`, `id_jn_sampah`) VALUES
(1, 'botol bersih', 1),
(2, 'botol kotor', 1),
(3, 'kerdus', 2),
(4, 'buku', 2),
(5, 'besi', 3),
(6, 'ban bekas', 4),
(7, 'botol', 5),
(8, 'pecah', 5);

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE `nasabah` (
  `norek` bigint(20) NOT NULL,
  `nm_nasabah` varchar(50) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rt` int(11) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`norek`, `nm_nasabah`, `no_hp`, `email`, `rt`, `alamat`) VALUES
(1, 'anto', '0839473892687', 'anto@gmail.com', 5, 'jl.anto'),
(9738781727, 'indra', '08397773562', 'indra@gmail.com', 21, 'jl.indra'),
(97723981209, 'dinar', '0838281267', 'dinar@yahoo.com', 1, 'jl.dinar'),
(91278972367812763, 'dina', '087379236747', 'dina@gmail.com', 9, 'jl.dina');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `norek` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `tanggal`, `norek`) VALUES
(1, '2019-07-03', 9738781727),
(2, '2019-07-03', 97723981209),
(3, '2019-07-03', 91278972367812763),
(4, '2019-07-03', 9738781727),
(5, '2019-07-04', 9738781727),
(6, '2019-07-04', 97723981209),
(7, '2019-07-04', 91278972367812763),
(10, '2019-07-04', 91278972367812763),
(11, '2019-07-04', 1),
(12, '2019-07-06', 1),
(13, '2019-07-06', 9738781727),
(14, '2019-07-06', 97723981209),
(15, '2019-07-06', 91278972367812763);

-- --------------------------------------------------------

--
-- Table structure for table `penarikan`
--

CREATE TABLE `penarikan` (
  `id_penarikan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `norek` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penarikan`
--

INSERT INTO `penarikan` (`id_penarikan`, `tanggal`, `norek`) VALUES
(1, '2019-07-03', 0),
(2, '2019-07-03', 9738781727),
(3, '2019-07-03', 97723981209),
(4, '2019-07-03', 91278972367812763),
(5, '2019-07-03', 91278972367812763),
(6, '2019-07-04', 97723981209),
(7, '2019-07-04', 9738781727),
(8, '2019-07-04', 91278972367812763),
(9, '2019-07-04', 91278972367812763),
(10, '2019-07-05', 1),
(11, '2019-07-05', 9738781727),
(12, '2019-07-06', 1),
(13, '2019-07-06', 91278972367812763),
(14, '2019-07-06', 91278972367812763);

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `id_pengurus` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`id_pengurus`, `username`, `status`, `no_hp`, `email`, `password`, `alamat`) VALUES
(1, 'tris', 'ketua', '085893266624', 'tris@gmail.com', 'tris', 'jl.tris'),
(9, 'ira', 'sekertaris', '0837826742746', 'ira@gmail.com', 'ira', 'jl.ira'),
(10, 'naumi', 'bendahara', '0837642634276', 'naumi@gmail.com', 'naumi', 'jl.naumi');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `tanggal`) VALUES
(6, '2019-07-03'),
(9, '2019-07-04'),
(10, '2019-07-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catatan_penjualan`
--
ALTER TABLE `catatan_penjualan`
  ADD PRIMARY KEY (`id_catatan_penjualan`);

--
-- Indexes for table `catatan_tabungan`
--
ALTER TABLE `catatan_tabungan`
  ADD PRIMARY KEY (`id_catatan_tabungan`);

--
-- Indexes for table `jenis_sampah`
--
ALTER TABLE `jenis_sampah`
  ADD PRIMARY KEY (`id_jn_sampah`);

--
-- Indexes for table `nama_sampah`
--
ALTER TABLE `nama_sampah`
  ADD PRIMARY KEY (`id_nm_sampah`);

--
-- Indexes for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`norek`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `penarikan`
--
ALTER TABLE `penarikan`
  ADD PRIMARY KEY (`id_penarikan`);

--
-- Indexes for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id_pengurus`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catatan_penjualan`
--
ALTER TABLE `catatan_penjualan`
  MODIFY `id_catatan_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `catatan_tabungan`
--
ALTER TABLE `catatan_tabungan`
  MODIFY `id_catatan_tabungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `jenis_sampah`
--
ALTER TABLE `jenis_sampah`
  MODIFY `id_jn_sampah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nama_sampah`
--
ALTER TABLE `nama_sampah`
  MODIFY `id_nm_sampah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `penarikan`
--
ALTER TABLE `penarikan`
  MODIFY `id_penarikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id_pengurus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
