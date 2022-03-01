-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jan 2020 pada 13.56
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `panasonic_center`
--
CREATE DATABASE IF NOT EXISTS `panasonic_center` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `panasonic_center`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `stok_min` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id`, `kode_barang`, `nama_barang`, `kategori`, `satuan`, `harga`, `stok_min`, `stok`) VALUES
(8, 'A001', 'dacey chairs', 'Portable', 'Unit', 850000, 10, 28),
(9, 'A002', 'eames', 'Portable', 'Paket', 85000000, 2, 4),
(10, 'A003', 'ergotech chairs', 'Permanen', 'Lusin', 450000, 30, 48),
(11, 'A004', 'backdrop', 'Permanen', 'Paket', 30000000, 2, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_beli`
--

CREATE TABLE `tb_beli` (
  `kd_beli` varchar(15) NOT NULL,
  `tgl_beli` date NOT NULL,
  `userid` tinyint(50) NOT NULL,
  `tunai` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `diskon` varchar(50) NOT NULL,
  `grand_total` varchar(50) NOT NULL,
  `kembalian` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_beli`
--

INSERT INTO `tb_beli` (`kd_beli`, `tgl_beli`, `userid`, `tunai`, `total`, `diskon`, `grand_total`, `kembalian`) VALUES
('PC2001070001', '2020-01-07', 1, 'Rp. 500.000', 'Rp. 450.000', 'Rp. 4.500', 'Rp. 445.500', 'Rp. 54.500');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail`
--

CREATE TABLE `tb_detail` (
  `id` bigint(20) NOT NULL,
  `kd_beli` varchar(20) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `userid` tinyint(50) NOT NULL,
  `nama_barang` varchar(250) NOT NULL,
  `qty` int(250) NOT NULL,
  `harga` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detail`
--

INSERT INTO `tb_detail` (`id`, `kd_beli`, `kd_barang`, `userid`, `nama_barang`, `qty`, `harga`) VALUES
(6, 'PC2001070001', 'A003', 1, 'ergotech chairs', 1, 450000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_staf`
--

CREATE TABLE `tb_staf` (
  `userid` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_staf`
--

INSERT INTO `tb_staf` (`userid`, `username`, `password`, `nama`, `alamat`, `level`) VALUES
(1, 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Yohannes Stefanus Ola', 'JL.puri Sadana', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `kode_supplier` int(5) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_supplier`
--

INSERT INTO `tb_supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `no_telp`, `email`) VALUES
(1, 'Garuda Wisnu Arta', 'Jl.kobra Pasir Putih', '0717456745', 'garuda@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_beli`
--
ALTER TABLE `tb_beli`
  ADD PRIMARY KEY (`kd_beli`);

--
-- Indeks untuk tabel `tb_detail`
--
ALTER TABLE `tb_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_staf`
--
ALTER TABLE `tb_staf`
  ADD PRIMARY KEY (`userid`);

--
-- Indeks untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_detail`
--
ALTER TABLE `tb_detail`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_staf`
--
ALTER TABLE `tb_staf`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `kode_supplier` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
