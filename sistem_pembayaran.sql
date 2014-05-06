-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 06, 2014 at 01:16 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sistem_pembayaran_test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `alokasi`
--

CREATE TABLE IF NOT EXISTS `alokasi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_transaksi` bigint(20) unsigned NOT NULL,
  `id_siswa` bigint(20) unsigned DEFAULT NULL,
  `id_unit` tinyint(3) unsigned DEFAULT NULL,
  `id_jenis_pembayaran` tinyint(3) unsigned DEFAULT NULL,
  `nilai` decimal(20,5) NOT NULL,
  `sisa` decimal(20,5) NOT NULL,
  `terdistribusi` decimal(20,5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_id_transaksi` (`id_transaksi`),
  KEY `index_id_siswa` (`id_siswa`),
  KEY `index_id_unit` (`id_unit`),
  KEY `index_id_jenis_pembayaran` (`id_jenis_pembayaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE IF NOT EXISTS `bank` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE IF NOT EXISTS `bulan` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `label` varchar(50) NOT NULL,
  `angka` char(2) NOT NULL,
  `urutan` tinyint(3) unsigned NOT NULL,
  `bagian_periode` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pembayaran`
--

CREATE TABLE IF NOT EXISTS `jenis_pembayaran` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE IF NOT EXISTS `kasir` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `id_tingkat` tinyint(3) unsigned NOT NULL,
  `nama` varchar(100) NOT NULL,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_id_tingkat` (`id_tingkat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `kode_produk` char(2) NOT NULL,
  `id_unit` tinyint(3) unsigned NOT NULL,
  `id_jenis_pembayaran` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_id_unit` (`id_unit`),
  KEY `index_id_jenis_pembayaran` (`id_jenis_pembayaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE IF NOT EXISTS `program` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE IF NOT EXISTS `rekening` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `id_bank` tinyint(3) unsigned NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_id_bank` (`id_bank`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `nis` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE IF NOT EXISTS `tagihan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `waktu_tagihan` datetime NOT NULL,
  `id_tahun_ajaran` tinyint(3) unsigned NOT NULL,
  `id_siswa` bigint(20) unsigned NOT NULL,
  `id_bulan` tinyint(3) unsigned NOT NULL,
  `id_jenis_pembayaran` tinyint(3) unsigned NOT NULL,
  `nilai` decimal(20,5) NOT NULL,
  `terbayar` decimal(20,5) NOT NULL,
  `sisa` decimal(20,5) NOT NULL,
  `id_unit` tinyint(3) unsigned NOT NULL,
  `id_program` tinyint(3) unsigned NOT NULL,
  `id_jurusan` tinyint(3) unsigned NOT NULL,
  `id_tingkat` tinyint(3) unsigned NOT NULL,
  `id_kelas` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_id_tahun_ajaran` (`id_tahun_ajaran`),
  KEY `index_id_siswa` (`id_siswa`),
  KEY `index_id_bulan` (`id_bulan`),
  KEY `index_id_jenis_pembayaran` (`id_jenis_pembayaran`),
  KEY `index_id_unit` (`id_unit`),
  KEY `index_id_program` (`id_program`),
  KEY `index_id_jurusan` (`id_jurusan`),
  KEY `index_id_tingkat` (`id_tingkat`),
  KEY `index_id_kelas` (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE IF NOT EXISTS `tahun_ajaran` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `label` varchar(50) NOT NULL,
  `waktu_mulai` datetime NOT NULL,
  `waktu_selesai` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tingkat`
--

CREATE TABLE IF NOT EXISTS `tingkat` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `id_unit` tinyint(3) unsigned NOT NULL,
  `nama` varchar(100) NOT NULL,
  `label` varchar(50) NOT NULL,
  `tingkatan` tinyint(4) NOT NULL COMMENT 'kelompok bermain sampai 12 SMA (-2 sampai 12)',
  PRIMARY KEY (`id`),
  KEY `index_id_unit` (`id_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `jenis` enum('TRANSAKSI','PEMBATALAN') NOT NULL,
  `kategori` enum('PEMBAYARAN','PENGEMBALIAN') NOT NULL,
  `metode` enum('ONLINE','OFFLINE') NOT NULL,
  `batal` tinyint(1) NOT NULL DEFAULT '0',
  `waktu_transaksi` datetime NOT NULL,
  `waktu_laporan` datetime NOT NULL,
  `waktu_entri` datetime NOT NULL,
  `id_rekening` tinyint(3) unsigned DEFAULT NULL,
  `id_kasir` tinyint(3) unsigned DEFAULT NULL,
  `nomor_transaksi` varchar(50) DEFAULT NULL,
  `nomor_referensi` varchar(50) DEFAULT NULL,
  `nilai` decimal(20,5) NOT NULL DEFAULT '0.00000',
  PRIMARY KEY (`id`),
  KEY `index_waktu_laporan` (`waktu_laporan`),
  KEY `index_id_kasir` (`id_kasir`),
  KEY `index_id_rekening` (`id_rekening`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE IF NOT EXISTS `unit` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alokasi`
--
ALTER TABLE `alokasi`
  ADD CONSTRAINT `alokasi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `alokasi_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `alokasi_ibfk_3` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `alokasi_ibfk_4` FOREIGN KEY (`id_jenis_pembayaran`) REFERENCES `jenis_pembayaran` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_tingkat`) REFERENCES `tingkat` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`id_jenis_pembayaran`) REFERENCES `jenis_pembayaran` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `rekening`
--
ALTER TABLE `rekening`
  ADD CONSTRAINT `rekening_ibfk_1` FOREIGN KEY (`id_bank`) REFERENCES `bank` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `tagihan_ibfk_9` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tagihan_ibfk_1` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tagihan_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tagihan_ibfk_3` FOREIGN KEY (`id_bulan`) REFERENCES `bulan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tagihan_ibfk_4` FOREIGN KEY (`id_jenis_pembayaran`) REFERENCES `jenis_pembayaran` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tagihan_ibfk_5` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tagihan_ibfk_6` FOREIGN KEY (`id_program`) REFERENCES `program` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tagihan_ibfk_7` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tagihan_ibfk_8` FOREIGN KEY (`id_tingkat`) REFERENCES `tingkat` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tingkat`
--
ALTER TABLE `tingkat`
  ADD CONSTRAINT `tingkat_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_kasir`) REFERENCES `kasir` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_rekening`) REFERENCES `rekening` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
