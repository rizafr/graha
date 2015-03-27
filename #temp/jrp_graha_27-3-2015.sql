-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2015 at 02:54 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jrp_graha`
--
CREATE DATABASE IF NOT EXISTS `jrp_graha` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `jrp_graha`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agent`
--

CREATE TABLE IF NOT EXISTS `tbl_agent` (
`id_agent` int(11) NOT NULL,
  `id_sm` int(11) DEFAULT NULL,
  `team` varchar(100) NOT NULL,
  `tanggal_posting` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_agent`
--

INSERT INTO `tbl_agent` (`id_agent`, `id_sm`, `team`, `tanggal_posting`) VALUES
(1, NULL, '', '2013-04-16 22:51:18'),
(2, 6, '3', '2015-03-25 15:10:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_anggota_keluarga`
--

CREATE TABLE IF NOT EXISTS `tbl_anggota_keluarga` (
`id_anggota_keluarga` int(11) NOT NULL,
  `id_kartu_keluarga` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_ktp` varchar(50) NOT NULL,
  `tanggal_lahir` varchar(2) NOT NULL,
  `bulan_lahir` varchar(2) NOT NULL,
  `tahun_lahir` varchar(4) NOT NULL,
  `npwp` varchar(30) NOT NULL,
  `hubungan_keluarga` varchar(50) NOT NULL,
  `status_nikah` varchar(20) NOT NULL,
  `hash_data` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_anggota_keluarga`
--

INSERT INTO `tbl_anggota_keluarga` (`id_anggota_keluarga`, `id_kartu_keluarga`, `nama_lengkap`, `no_ktp`, `tanggal_lahir`, `bulan_lahir`, `tahun_lahir`, `npwp`, `hubungan_keluarga`, `status_nikah`, `hash_data`) VALUES
(1, 1, 'Jaja', '3424242', '15', '3', '1999', '343434', 'Anak', 'Kawin', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_captcha`
--

CREATE TABLE IF NOT EXISTS `tbl_captcha` (
`captcha_id` bigint(13) unsigned NOT NULL,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `tbl_captcha`
--

INSERT INTO `tbl_captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(43, 1427458864, '127.0.0.1', '9073'),
(44, 1427459031, '127.0.0.1', '5501'),
(45, 1427462399, '127.0.0.1', '3645'),
(46, 1427463161, '127.0.0.1', '4792'),
(47, 1427463161, '127.0.0.1', '4921'),
(48, 1427463161, '127.0.0.1', '4970'),
(49, 1427463165, '127.0.0.1', '5498');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cara_pembayaran`
--

CREATE TABLE IF NOT EXISTS `tbl_cara_pembayaran` (
`id_cara_pembayaran` int(11) NOT NULL,
  `tipe_pembayaran` varchar(50) NOT NULL,
  `tahap_pembayaran` int(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_cara_pembayaran`
--

INSERT INTO `tbl_cara_pembayaran` (`id_cara_pembayaran`, `tipe_pembayaran`, `tahap_pembayaran`) VALUES
(1, 'Cash', 1),
(2, 'Cash', 3),
(3, 'Cash', 6),
(4, 'Cash', 8),
(5, 'Cash', 12),
(6, 'KPR', 3),
(7, 'KPR', 6),
(8, 'KPR', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cluster`
--

CREATE TABLE IF NOT EXISTS `tbl_cluster` (
`id_cluster` int(11) NOT NULL,
  `kode_cluster` varchar(50) NOT NULL,
  `nama_cluster` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tbl_cluster`
--

INSERT INTO `tbl_cluster` (`id_cluster`, `kode_cluster`, `nama_cluster`) VALUES
(1, 'GRB', 'ANGGREK LOKA'),
(2, 'GRA', 'CARISSA'),
(3, 'CATALINA', 'CATALINA'),
(4, 'FB', 'CBD FORTUNE'),
(5, 'CELESTA', 'CELESTA'),
(6, 'CR', 'CORNELIA'),
(7, 'GRB', 'ELDORA'),
(8, 'GB', 'FIERA'),
(9, 'D1', 'FORTUNE BELLEZA'),
(10, 'D5', 'FORTUNE BREEZE'),
(11, 'D2', 'FORTUNE SPRING'),
(12, 'GRB', 'GARDENIA LOKA'),
(13, 'GB', 'GR-29'),
(14, 'GB', 'GR-30'),
(15, 'GRACIA', 'GRACIA'),
(16, 'MELIA', 'MELIA'),
(17, 'MELIA', 'MELIA GROVE'),
(18, 'GRB', 'NEO ELDORA'),
(19, 'GRB', 'NEO GARDENIA'),
(20, 'GRB', 'NUSA INDAH LOKA'),
(21, 'GRB', 'PONDOK JAGUNG'),
(22, 'FR', 'RUKO FIERA'),
(23, 'GRB', 'RUKO ORLIN ARCADE II'),
(24, 'VERINA', 'VERINA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE IF NOT EXISTS `tbl_customer` (
`id_customer` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_ktp` varchar(50) NOT NULL,
  `no_npwp` varchar(50) NOT NULL,
  `alamat_npwp` text NOT NULL,
  `telpon` varchar(50) NOT NULL,
  `hp` varchar(50) NOT NULL,
  `alamat_ktp` text NOT NULL,
  `alamat_surat_menyurat` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `doc_ktp` varchar(250) NOT NULL,
  `doc_npwp` varchar(250) NOT NULL,
  `doc_kartu_keluarga` varchar(250) NOT NULL,
  `doc_akta_nikah` varchar(250) NOT NULL,
  `doc_siup` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_dokumen`
--

CREATE TABLE IF NOT EXISTS `tbl_customer_dokumen` (
`id_dokumen` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `file_dokumen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_ref`
--

CREATE TABLE IF NOT EXISTS `tbl_customer_ref` (
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `no_ktp` varchar(100) NOT NULL DEFAULT '',
  `no_npwp` varchar(100) DEFAULT NULL,
  `alamat_npwp` text,
  `telpon` varchar(50) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `alamat_ktp` text,
  `alamat_surat_menyurat` text,
  `email` varchar(200) DEFAULT NULL,
  `no_kartu_keluarga` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file_dokumen`
--

CREATE TABLE IF NOT EXISTS `tbl_file_dokumen` (
`id_dokumen` int(11) NOT NULL,
  `id_anggota_keluarga` int(11) NOT NULL,
  `nama_dokumen` varchar(20) NOT NULL,
  `file_dokument` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE IF NOT EXISTS `tbl_gallery` (
`id_gallery` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `image_gallery` varchar(200) NOT NULL DEFAULT 'no_image.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kartu_keluarga`
--

CREATE TABLE IF NOT EXISTS `tbl_kartu_keluarga` (
`id_kartu_keluarga` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `no_kartu_keluarga` varchar(20) NOT NULL,
  `tanggal_posting` datetime NOT NULL,
  `hash_data` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE IF NOT EXISTS `tbl_news` (
`id_news` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `status` enum('Aktif','Tidak Aktif','','') NOT NULL DEFAULT 'Tidak Aktif',
  `id_user` int(11) NOT NULL,
  `tanggal_posting` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` (`id_news`, `judul`, `image`, `deskripsi`, `status`, `id_user`, `tanggal_posting`) VALUES
(1, 'Tipe Baru', 'Tipe_Baru.jpg', '<p>Deskripsi...</p>', 'Aktif', 8, '2015-03-25 16:03:43'),
(2, 'Woodbarry House', 'Woodbarry_House.jpg', '<p>Keterangan...</p>', 'Aktif', 8, '2013-07-18 01:05:53'),
(3, 'Promo Cluster ABC', 'Promo_Cluster_ABC.jpg', '<p>Keterangan...</p>', 'Aktif', 8, '2013-07-18 01:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nup`
--

CREATE TABLE IF NOT EXISTS `tbl_nup` (
`id_nup` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `nup` varchar(30) NOT NULL,
  `no_antrian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemesanan`
--

CREATE TABLE IF NOT EXISTS `tbl_pemesanan` (
`id_pemesanan` int(11) NOT NULL,
  `id_unit` int(3) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_agen` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_kartu_keluarga` int(11) NOT NULL,
  `id_promo` int(11) NOT NULL,
  `jenis_pemesanan` varchar(20) NOT NULL,
  `status_pemesanan` varchar(20) NOT NULL,
  `status_verify` varchar(50) NOT NULL,
  `tipe_pembayaran` varchar(20) NOT NULL,
  `tahap_pembayaran` int(10) NOT NULL,
  `booking_fee` decimal(20,0) NOT NULL DEFAULT '0',
  `nomor_pemesanan` varchar(50) NOT NULL,
  `tanggal_pemesanan` datetime NOT NULL,
  `tanggal_tanda_jadi` datetime NOT NULL,
  `tanggal_sold` datetime NOT NULL,
  `tanggal_timeout` datetime NOT NULL,
  `timeout` int(11) NOT NULL,
  `diskon_tanah` decimal(4,2) NOT NULL DEFAULT '0.00',
  `diskon_bangunan` decimal(4,2) NOT NULL DEFAULT '0.00',
  `status_data` varchar(20) NOT NULL,
  `lock_pemesanan` int(11) NOT NULL,
  `delete_by` int(11) NOT NULL,
  `delete_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promo`
--

CREATE TABLE IF NOT EXISTS `tbl_promo` (
`id_promo` int(11) NOT NULL,
  `nama_promo` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_promo` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_promo`
--

INSERT INTO `tbl_promo` (`id_promo`, `nama_promo`, `deskripsi`, `tanggal_mulai`, `tanggal_akhir`, `id_user`, `status_promo`) VALUES
(1, 'Promo #1', 'Deskripsi promo tampil disini.', '2013-07-01', '2013-07-31', 0, 0),
(2, 'Promo #2', 'Deskripsi promo tampil disini.', '2013-08-01', '2013-08-31', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sessions`
--

CREATE TABLE IF NOT EXISTS `tbl_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sessions`
--

INSERT INTO `tbl_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('3d05fd69c36164cf771fe327ef8066a1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', 1427462252, 'a:9:{s:9:"user_data";s:0:"";s:7:"id_user";s:1:"1";s:12:"nama_lengkap";s:13:"Dito Fityanto";s:8:"username";s:13:"Administrator";s:9:"hash_data";s:32:"9805ca24493ce5d26e93af4ddc850f89";s:5:"level";s:13:"Administrator";s:2:"sm";s:1:"N";s:8:"id_agent";s:1:"1";s:16:"status_transaksi";s:1:"1";}'),
('3d2758b5b3161bc0ac0ba874b70ae38d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', 1427463160, ''),
('63ce544613c67508417ea5be058a912c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', 1427463160, 'a:9:{s:9:"user_data";s:0:"";s:7:"id_user";s:1:"1";s:12:"nama_lengkap";s:13:"Dito Fityanto";s:8:"username";s:13:"Administrator";s:9:"hash_data";s:32:"9805ca24493ce5d26e93af4ddc850f89";s:5:"level";s:13:"Administrator";s:2:"sm";s:1:"N";s:8:"id_agent";s:1:"1";s:16:"status_transaksi";s:1:"1";}'),
('9f70a4e376269af5205f32363ec0992a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', 1427458863, 'a:9:{s:9:"user_data";s:0:"";s:7:"id_user";s:1:"1";s:12:"nama_lengkap";s:13:"Dito Fityanto";s:8:"username";s:13:"Administrator";s:9:"hash_data";s:32:"9805ca24493ce5d26e93af4ddc850f89";s:5:"level";s:13:"Administrator";s:2:"sm";s:1:"N";s:8:"id_agent";s:1:"1";s:16:"status_transaksi";s:1:"1";}'),
('d453d0013dea43fc927005db08ae22f2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', 1427464108, 'a:9:{s:9:"user_data";s:0:"";s:7:"id_user";s:1:"1";s:12:"nama_lengkap";s:13:"Dito Fityanto";s:8:"username";s:13:"Administrator";s:9:"hash_data";s:32:"9805ca24493ce5d26e93af4ddc850f89";s:5:"level";s:13:"Administrator";s:2:"sm";s:1:"N";s:8:"id_agent";s:1:"1";s:16:"status_transaksi";s:1:"1";}'),
('f2b1e99912f605817e4f3bf5b6c2f8fb', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', 1427463160, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siteplan`
--

CREATE TABLE IF NOT EXISTS `tbl_siteplan` (
`id_siteplan` int(11) NOT NULL,
  `id_cluster` int(11) NOT NULL,
  `nama_siteplan` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL DEFAULT 'no_image.jpg',
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Tidak Aktif'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_siteplan`
--

INSERT INTO `tbl_siteplan` (`id_siteplan`, `id_cluster`, `nama_siteplan`, `image`, `status`) VALUES
(1, 6, 'CORNELIA', '1_CORNELIA.jpg', 'Aktif'),
(2, 8, 'FIERA', '2_FIERA.jpg', 'Aktif'),
(3, 9, 'FORTUNE BELLEZA', '3_FORTUNE_BELLEZA.jpg', 'Aktif'),
(4, 10, 'FORTUNE BREEZE', '4_FORTUNE_BREEZE.jpg', 'Aktif'),
(5, 11, 'FORTUNE SPRING', '5_FORTUNE_SPRING.jpg', 'Aktif'),
(6, 16, 'MELIA', '6_MELIA.jpg', 'Aktif'),
(7, 17, 'MELIA GROVE', '7_MELIA_GROVE.jpg', 'Aktif'),
(8, 19, 'NEO GARDENIA', '8_NEO_GARDENIA.jpg', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timeout`
--

CREATE TABLE IF NOT EXISTS `tbl_timeout` (
`id_timeout` int(11) NOT NULL,
  `status_pemesanan` varchar(50) NOT NULL,
  `timeout` bigint(100) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_timeout`
--

INSERT INTO `tbl_timeout` (`id_timeout`, `status_pemesanan`, `timeout`, `status`) VALUES
(1, 'Tanda Jadi', 432000, 0),
(2, 'Tanda Jadi', 259200, 1),
(3, 'Booking', 1800, 1),
(4, 'Booking', 86400, 0),
(8, 'Locked (Siteplan)', 600, 1),
(9, 'Locked (Siteplan)', 600, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE IF NOT EXISTS `tbl_type` (
`id_type` int(11) NOT NULL,
  `id_cluster` int(11) NOT NULL,
  `nama_type` varchar(100) NOT NULL,
  `spesifikasi` text,
  `kode_blok` varchar(200) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`id_type`, `id_cluster`, `nama_type`, `spesifikasi`, `kode_blok`) VALUES
(1, 1, 'PARKIT', '', 'A4'),
(2, 2, 'KAVELING', '', 'B'),
(3, 3, 'BELLINE', '', 'J'),
(4, 4, 'KAVELING', '', 'B'),
(5, 5, 'KAVELING', '', 'A'),
(6, 6, 'CORNELIA', '', 'B'),
(7, 7, 'KAVELING', '', 'H8'),
(8, 8, 'FIERA', '', 'GR9'),
(9, 9, 'CARNATION', '<p><strong>Struktur</strong><br /> Pondasi Mini Pile<br /> Sloop Beton Bertulang<br /> Struktur Atas Beton Bertulang<br /> Dinding Batu Bata Finish Plester ACI<br /> RangkaP Atap Baja RIngan<br /> Pagar Depan/Belakang Bata Merah<br /> Atap Genteng Beton Flat</p>\r\n<p><strong>Finishing</strong><br /> Lantai Dalam Keramik<br /> Lantai Carport Paving Blok + Keramik<br /> Lantai Kamar Mandi Keramik<br /> Teras Keramik<br /> Dinding Luar Finishing Cat Weatercoat<br /> Dinding Dalam Finishing Cat<br /> Kusen Jendela &amp; Pintu Aluminum + Kayu<br /> Daun Pintu Fabrikasi<br /> Plafond Eksterior GRC Board<br /> Plafond Interior Gypsum Board<br /> Penutup Atap Genteng Beton<br /> <br /> <strong>Instalasi </strong><br /> 2200VA<br /> PAM Graharaya<br /> Bio Tech Septik Tank</p>', 'C,D,F,G,J,K'),
(10, 9, 'ORCHITA', '<p><strong>Struktur</strong><br /> Pondasi Mini Pile<br /> Sloop Beton Bertulang<br /> Struktur Atas Beton Bertulang<br /> Dinding Batu Bata Finish Plester ACI<br /> RangkaP Atap Baja RIngan<br /> Pagar Depan/Belakang Bata Merah<br /> Atap Genteng Beton Flat</p>\r\n<p><strong>Finishing</strong><br /> Lantai Dalam Keramik<br /> Lantai Carport Paving Blok + Keramik<br /> Lantai Kamar Mandi Keramik<br /> Teras Keramik<br /> Dinding Luar Finishing Cat Weatercoat<br /> Dinding Dalam Finishing Cat<br /> Kusen Jendela &amp; Pintu Aluminum + Kayu<br /> Daun Pintu Fabrikasi<br /> Plafond Eksterior GRC Board<br /> Plafond Interior Gypsum Board<br /> Penutup Atap Genteng Beton<br /> <br /> <strong>Instalasi </strong><br /> 2200VA<br /> PAM Graharaya<br /> Bio Tech Septik Tank</p>', 'H,I,J,L'),
(11, 9, 'TULIPA', '<p><strong>Struktur</strong><br /> Pondasi Mini Pile<br /> Sloop Beton Bertulang<br /> Struktur Atas Beton Bertulang<br /> Dinding Batu Bata Finish Plester ACI<br /> RangkaP Atap Baja RIngan<br /> Pagar Depan/Belakang Bata Merah<br /> Atap Genteng Beton Flat</p>\r\n<p><strong>Finishing</strong><br /> Lantai Dalam Keramik<br /> Lantai Carport Paving Blok + Keramik<br /> Lantai Kamar Mandi Keramik<br /> Teras Keramik<br /> Dinding Luar Finishing Cat Weatercoat<br /> Dinding Dalam Finishing Cat<br /> Kusen Jendela &amp; Pintu Aluminum + Kayu<br /> Daun Pintu Fabrikasi<br /> Plafond Eksterior GRC Board<br /> Plafond Interior Gypsum Board<br /> Penutup Atap Genteng Beton<br /> <br /> <strong>Instalasi </strong><br /> 2200VA<br /> PAM Graharaya<br /> Bio Tech Septik Tank</p>', 'A,B,C,E'),
(12, 10, 'ANIMA', '', 'A,B,E,F2,F3,G,H,I,J'),
(13, 10, 'AURA', '', 'E,F5,F6,J,K,L,M'),
(14, 10, 'KAVELING', '', 'A,H,L,M'),
(15, 10, 'VIENTO', '', 'C,D,F,F1,I,J'),
(16, 11, 'KAVELING', '', 'E'),
(17, 11, 'RIVINNA', '', 'E,H'),
(18, 11, 'RUSELLIA', '', 'B,F,G,H'),
(19, 11, 'SALVIA', '', 'D,I'),
(20, 12, 'KAVELING', '', 'E4'),
(21, 13, 'GRETTA', '', 'GR29'),
(22, 13, 'KAVELING', '', 'GR29'),
(23, 14, 'KAVELING', '', 'GR30'),
(24, 15, 'GARNETA', '', 'G,H'),
(25, 15, 'GRANIA', '', 'I,J,K'),
(26, 15, 'KAVELING', '', 'O,P'),
(27, 16, 'KAVELING', '', 'MGG,MGH,MGI,MGJ'),
(28, 17, 'KAVELING', '', 'GMJ'),
(29, 18, 'ELDAR', '', 'H3A'),
(30, 18, 'ELETTRA', '', 'H1A,H2A'),
(31, 19, 'NEO GARDENIA', '', 'F6,F6A,F6B,F6C'),
(32, 20, 'PARKIT', '', 'HE3,HF1'),
(33, 21, 'ILLIA', '', 'GS12'),
(34, 22, 'TIPE A', '', 'A,D'),
(35, 23, 'ARCADE', '', 'JB'),
(36, 24, 'CALANDRA', '', 'M'),
(37, 24, 'KAVELING', '', 'A,E,F,L'),
(38, 6, 'TESTER', '', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE IF NOT EXISTS `tbl_unit` (
`id_unit` int(11) NOT NULL,
  `id_promo` int(11) NOT NULL,
  `id_cluster` int(11) NOT NULL,
  `id_type` int(11) DEFAULT NULL,
  `posisi` varchar(50) NOT NULL,
  `kode_unit` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL DEFAULT '-',
  `luas_tanah` decimal(5,2) NOT NULL DEFAULT '0.00',
  `luas_bangunan` decimal(5,2) NOT NULL DEFAULT '0.00',
  `harga_tanah_m2` decimal(20,0) NOT NULL DEFAULT '0',
  `harga_bangunan_m2` decimal(20,0) NOT NULL DEFAULT '0',
  `diskon_tanah` decimal(4,2) NOT NULL DEFAULT '0.00',
  `diskon_bangunan` decimal(4,2) NOT NULL DEFAULT '0.00',
  `harga_tanah` decimal(20,0) NOT NULL DEFAULT '0',
  `harga_bangunan` decimal(20,0) NOT NULL DEFAULT '0',
  `harga_jual_exc_ppn` decimal(20,0) NOT NULL DEFAULT '0',
  `harga_jual_inc_ppn` decimal(20,0) NOT NULL DEFAULT '0',
  `fs` decimal(4,2) NOT NULL DEFAULT '0.00',
  `keterangan_fs` varchar(200) DEFAULT NULL,
  `tanda_jadi` decimal(20,0) NOT NULL DEFAULT '0',
  `persen_tanda_jadi` decimal(11,9) NOT NULL DEFAULT '0.000000000',
  `uang_muka` decimal(20,0) NOT NULL DEFAULT '0',
  `persen_uang_muka` decimal(11,9) NOT NULL DEFAULT '0.000000000',
  `plafon_kpr` decimal(20,0) NOT NULL DEFAULT '0',
  `kpr_5_tahun` decimal(20,0) NOT NULL DEFAULT '0',
  `kpr_10_tahun` decimal(20,0) NOT NULL DEFAULT '0',
  `kpr_15_tahun` decimal(20,0) NOT NULL DEFAULT '0',
  `suku_bunga` decimal(4,2) NOT NULL DEFAULT '0.00',
  `status_unit` enum('Master','Marketable','Promo') NOT NULL DEFAULT 'Master',
  `status_transaksi` enum('','Booked','Sold') NOT NULL DEFAULT '',
  `tanggal_posting` datetime NOT NULL,
  `kelas_produk` varchar(10) NOT NULL DEFAULT '-',
  `locked` int(1) NOT NULL,
  `tanggal_locked` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=350 ;

--
-- Dumping data for table `tbl_unit`
--

INSERT INTO `tbl_unit` (`id_unit`, `id_promo`, `id_cluster`, `id_type`, `posisi`, `kode_unit`, `kategori`, `luas_tanah`, `luas_bangunan`, `harga_tanah_m2`, `harga_bangunan_m2`, `diskon_tanah`, `diskon_bangunan`, `harga_tanah`, `harga_bangunan`, `harga_jual_exc_ppn`, `harga_jual_inc_ppn`, `fs`, `keterangan_fs`, `tanda_jadi`, `persen_tanda_jadi`, `uang_muka`, `persen_uang_muka`, `plafon_kpr`, `kpr_5_tahun`, `kpr_10_tahun`, `kpr_15_tahun`, `suku_bunga`, `status_unit`, `status_transaksi`, `tanggal_posting`, `kelas_produk`, `locked`, `tanggal_locked`) VALUES
(1, 0, 6, 6, 'KHUSUS', 'CR/B-10', 'RESIDENSIAL', '132.00', '108.00', '5600000', '4400000', '0.00', '0.00', '739200000', '475200000', '1214400000', '1335840000', '0.00', '', '33396000', '2.500000000', '367356000', '27.500000000', '935088000', '18626356', '10978030', '8536071', '7.25', 'Marketable', '', '2013-07-04 08:11:08', 'HM', 0, '0000-00-00 00:00:00'),
(2, 0, 6, 6, 'KHUSUS', 'CR/B-11', 'RESIDENSIAL', '132.00', '108.00', '5600000', '4400000', '0.00', '0.00', '739200000', '475200000', '1214400000', '1335840000', '0.00', '', '33396000', '2.500000000', '367356000', '27.500000000', '935088000', '18626356', '10978030', '8536071', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(3, 0, 6, 6, 'KHUSUS', 'CR/B-12', 'RESIDENSIAL', '133.00', '108.00', '5600000', '4400000', '0.00', '0.00', '744800000', '475200000', '1220000000', '1342000000', '0.00', '', '33550000', '2.500000000', '369050000', '27.500000000', '939400000', '18712248', '11028654', '8575434', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(4, 0, 6, 6, 'KHUSUS', 'CR/B-15', 'RESIDENSIAL', '134.00', '108.00', '5600000', '4400000', '0.00', '0.00', '750400000', '475200000', '1225600000', '1348160000', '0.00', '', '33704000', '2.500000000', '370744000', '27.500000000', '943712000', '18798140', '11079277', '8614797', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(5, 0, 6, 6, 'KHUSUS', 'CR/B-16', 'RESIDENSIAL', '134.00', '108.00', '5600000', '4400000', '0.00', '0.00', '750400000', '475200000', '1225600000', '1348160000', '0.00', '', '33704000', '2.500000000', '370744000', '27.500000000', '943712000', '18798140', '11079277', '8614797', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(6, 0, 6, 6, 'KHUSUS', 'CR/B-17', 'RESIDENSIAL', '135.00', '108.00', '5600000', '4400000', '0.00', '0.00', '756000000', '475200000', '1231200000', '1354320000', '0.00', '', '33858000', '2.500000000', '372438000', '27.500000000', '948024000', '18884033', '11129900', '8654159', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(7, 0, 6, 6, 'KHUSUS', 'CR/B-18', 'RESIDENSIAL', '136.00', '108.00', '5600000', '4400000', '0.00', '0.00', '761600000', '475200000', '1236800000', '1360480000', '0.00', '', '34012000', '2.500000000', '374132000', '27.500000000', '952336000', '18969925', '11180524', '8693522', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(8, 0, 6, 6, 'KHUSUS', 'CR/B-19', 'RESIDENSIAL', '136.00', '108.00', '5600000', '4400000', '0.00', '0.00', '761600000', '475200000', '1236800000', '1360480000', '0.00', '', '34012000', '2.500000000', '374132000', '27.500000000', '952336000', '18969925', '11180524', '8693522', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(9, 0, 6, 6, 'KHUSUS', 'CR/B-20', 'RESIDENSIAL', '137.00', '108.00', '5600000', '4400000', '0.00', '0.00', '767200000', '475200000', '1242400000', '1366640000', '0.00', '', '34166000', '2.500000000', '375826000', '27.500000000', '956648000', '19055817', '11231147', '8732884', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(10, 0, 6, 6, 'KHUSUS', 'CR/B-21', 'RESIDENSIAL', '138.00', '108.00', '5600000', '4400000', '0.00', '0.00', '772800000', '475200000', '1248000000', '1372800000', '0.00', '', '34320000', '2.500000000', '377520000', '27.500000000', '960960000', '19141709', '11281770', '8772247', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(11, 0, 6, 6, 'KHUSUS', 'CR/B-22', 'RESIDENSIAL', '138.00', '108.00', '5600000', '4400000', '0.00', '0.00', '772800000', '475200000', '1248000000', '1372800000', '0.00', '', '34320000', '2.500000000', '377520000', '27.500000000', '960960000', '19141709', '11281770', '8772247', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(12, 0, 6, 6, 'SUDUT', 'CR/B-23', 'RESIDENSIAL', '218.00', '119.00', '5600000', '5280000', '0.00', '0.00', '1220800000', '628320000', '1849120000', '2034032000', '0.00', '', '50850800', '2.500000000', '559358800', '27.500000000', '1423822400', '28361633', '16715823', '12997546', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(13, 0, 18, 30, 'KHUSUS', 'GRB/H1A-02', 'RESIDENSIAL', '161.00', '95.00', '5800000', '5400000', '0.00', '0.00', '933800000', '513000000', '1446800000', '1591480000', '0.00', '', '39787000', '2.500000000', '437657000', '27.500000000', '1114036000', '22190886', '13078899', '10169621', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(14, 0, 18, 30, 'KHUSUS', 'GRB/H1A-03', 'RESIDENSIAL', '165.00', '95.00', '5800000', '4725000', '0.00', '0.00', '957000000', '448875000', '1405875000', '1546462500', '0.00', '', '38661563', '2.500000000', '425277188', '27.500000000', '1082523749', '21563182', '12708942', '9881957', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(15, 0, 18, 30, 'KHUSUS', 'GRB/H1A-05', 'RESIDENSIAL', '183.00', '95.00', '5800000', '4725000', '0.00', '0.00', '1061400000', '448875000', '1510275000', '1661302500', '0.00', '', '41532563', '2.500000000', '456858188', '27.500000000', '1162911749', '23164459', '13652705', '10615790', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(16, 0, 18, 30, 'KHUSUS', 'GRB/H1A-06', 'RESIDENSIAL', '127.00', '95.00', '5800000', '4725000', '0.00', '0.00', '736600000', '448875000', '1185475000', '1304022500', '0.00', '', '32600563', '2.500000000', '358606188', '27.500000000', '912815749', '18182707', '10716552', '8332756', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(17, 0, 18, 30, 'KHUSUS', 'GRB/H1A-07', 'RESIDENSIAL', '134.00', '95.00', '5800000', '4725000', '0.00', '0.00', '777200000', '448875000', '1226075000', '1348682500', '0.00', '', '33717063', '2.500000000', '370887688', '27.500000000', '944077749', '18805426', '11083571', '8618135', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(18, 0, 18, 30, 'KHUSUS', 'GRB/H1A-08', 'RESIDENSIAL', '142.00', '95.00', '5800000', '4725000', '0.00', '0.00', '823600000', '448875000', '1272475000', '1399722500', '0.00', '', '34993063', '2.500000000', '384923688', '27.500000000', '979805749', '19517105', '11503022', '8944283', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(19, 0, 18, 30, 'KHUSUS', 'GRB/H2A-03', 'RESIDENSIAL', '99.00', '95.00', '5800000', '4725000', '0.00', '0.00', '602910000', '448875000', '1051785000', '1156963500', '5.00', '', '28924088', '2.500000000', '318164963', '27.500000000', '809874449', '16132182', '9508010', '7393043', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(20, 0, 18, 30, 'KHUSUS', 'GRB/H2A-05', 'RESIDENSIAL', '115.00', '95.00', '5800000', '4725000', '0.00', '0.00', '667000000', '448875000', '1115875000', '1227462500', '0.00', '', '30686563', '2.500000000', '337552188', '27.500000000', '859223749', '17115188', '10087376', '7843535', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(21, 0, 18, 30, 'KHUSUS', 'GRB/H2A-11', 'RESIDENSIAL', '124.00', '95.00', '5800000', '4725000', '0.00', '0.00', '719200000', '448875000', '1168075000', '1284882500', '0.00', '', '32122063', '2.500000000', '353342688', '27.500000000', '899417749', '17915827', '10559258', '8210451', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(22, 0, 18, 30, 'KHUSUS', 'GRB/H2A-23', 'RESIDENSIAL', '84.00', '95.00', '5800000', '4725000', '0.00', '0.00', '487200000', '448875000', '936075000', '1029682500', '0.00', '', '25742063', '2.500000000', '283162688', '27.500000000', '720777749', '14357432', '8462006', '6579713', '7.25', 'Marketable', '', '2013-07-04 08:11:09', 'HM', 0, '0000-00-00 00:00:00'),
(23, 0, 18, 30, 'KHUSUS', 'GRB/H2A-25', 'RESIDENSIAL', '111.00', '95.00', '5800000', '4725000', '0.00', '0.00', '643800000', '448875000', '1092675000', '1201942500', '0.00', '', '30048563', '2.500000000', '330534188', '27.500000000', '841359749', '16759349', '9877651', '7680461', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'HM', 0, '0000-00-00 00:00:00'),
(24, 0, 18, 30, 'KHUSUS', 'GRB/H2A-27', 'RESIDENSIAL', '168.00', '95.00', '5800000', '4725000', '0.00', '0.00', '974400000', '448875000', '1423275000', '1565602500', '0.00', '', '39140063', '2.500000000', '430540688', '27.500000000', '1095921749', '21830061', '12866235', '10004263', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'HM', 0, '0000-00-00 00:00:00'),
(25, 0, 18, 29, 'KHUSUS', 'GRB/H3A-06', 'RESIDENSIAL', '108.00', '69.00', '5800000', '4725000', '0.00', '0.00', '626400000', '326025000', '952425000', '1047667500', '0.00', '', '26191688', '2.500000000', '288108563', '27.500000000', '733367249', '14608207', '8609808', '6694637', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'HM', 0, '0000-00-00 00:00:00'),
(26, 0, 18, 29, 'KHUSUS', 'GRB/H3A-26', 'RESIDENSIAL', '83.00', '69.00', '5800000', '4725000', '0.00', '0.00', '481400000', '326025000', '807425000', '888167500', '0.00', '', '22204188', '2.500000000', '244246063', '27.500000000', '621717249', '12384211', '7299025', '5675426', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'HM', 0, '0000-00-00 00:00:00'),
(27, 0, 18, 30, 'KHUSUS', 'GRB/H1A-01', 'RESIDENSIAL', '176.00', '95.00', '5800000', '4725000', '0.00', '0.00', '1020800000', '448875000', '1469675000', '1616642500', '0.00', '', '40416063', '2.500000000', '444576688', '27.500000000', '1131649749', '22541740', '13285686', '10330411', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'HM', 0, '0000-00-00 00:00:00'),
(28, 0, 18, 30, 'KHUSUS', 'GRB/H1A-09', 'RESIDENSIAL', '141.00', '95.00', '5800000', '4725000', '0.00', '0.00', '817800000', '448875000', '1266675000', '1393342500', '0.00', '', '34833563', '2.500000000', '383169188', '27.500000000', '975339749', '19428145', '11450590', '8903515', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'HM', 0, '0000-00-00 00:00:00'),
(29, 0, 18, 30, 'SUDUT', 'GRB/H2A-01', 'RESIDENSIAL', '164.00', '0.00', '5800000', '0', '0.00', '0.00', '1022540000', '0', '1022540000', '1124794000', '7.50', '', '28119850', '2.500000000', '309318350', '27.500000000', '787355800', '15683625', '9243639', '7187479', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'HM', 0, '0000-00-00 00:00:00'),
(30, 0, 18, 30, 'SUDUT', 'GRB/H2A-02', 'RESIDENSIAL', '119.00', '0.00', '5800000', '0', '0.00', '0.00', '724710000', '0', '724710000', '797181000', '5.00', '', '19929525', '2.500000000', '219224775', '27.500000000', '558026700', '11115535', '6551292', '5094019', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'MH', 0, '0000-00-00 00:00:00'),
(31, 0, 18, 30, 'SUDUT', 'GRB/H2A-15', 'RESIDENSIAL', '120.00', '0.00', '5800000', '4725000', '0.00', '0.00', '696000000', '0', '696000000', '765600000', '0.00', '', '19140000', '2.500000000', '210540000', '27.500000000', '535920000', '10675184', '6291757', '4892215', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'MH', 0, '0000-00-00 00:00:00'),
(32, 0, 18, 30, 'KHUSUS', 'GRB/H2A-17', 'RESIDENSIAL', '201.00', '95.00', '5800000', '4725000', '0.00', '0.00', '1165800000', '448875000', '1614675000', '1776142500', '0.00', '', '44403563', '2.500000000', '488439188', '27.500000000', '1243299749', '24765737', '14596469', '11349622', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'HM', 0, '0000-00-00 00:00:00'),
(33, 0, 18, 30, 'KHUSUS', 'GRB/H2A-19', 'RESIDENSIAL', '107.00', '95.00', '5800000', '4725000', '0.00', '0.00', '620600000', '448875000', '1069475000', '1176422500', '0.00', '', '29410563', '2.500000000', '323516188', '27.500000000', '823495749', '16403509', '9667926', '7517387', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'HM', 0, '0000-00-00 00:00:00'),
(34, 0, 18, 29, 'SUDUT', 'GRB/H3A-01', 'RESIDENSIAL', '110.00', '0.00', '5800000', '5400000', '0.00', '0.00', '669900000', '0', '669900000', '736890000', '5.00', '', '18422250', '2.500000000', '202644750', '27.500000000', '515823000', '10274865', '6055816', '4708757', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'MH', 0, '0000-00-00 00:00:00'),
(35, 0, 18, 29, 'SUDUT', 'GRB/H3A-02', 'RESIDENSIAL', '109.00', '0.00', '5800000', '0', '0.00', '0.00', '663810000', '0', '663810000', '730191000', '5.00', '', '18254775', '2.500000000', '200802525', '27.500000000', '511133700', '10181457', '6000763', '4665950', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'MH', 0, '0000-00-00 00:00:00'),
(36, 0, 18, 29, 'SUDUT', 'GRB/H3A-11', 'RESIDENSIAL', '108.00', '0.00', '5800000', '0', '0.00', '0.00', '626400000', '0', '626400000', '689040000', '0.00', '', '17226000', '2.500000000', '189486000', '27.500000000', '482328000', '9607666', '5662581', '4402993', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'MH', 0, '0000-00-00 00:00:00'),
(37, 0, 18, 29, 'SUDUT', 'GRB/H3A-15', 'RESIDENSIAL', '138.00', '0.00', '5800000', '0', '0.00', '0.00', '800400000', '0', '800400000', '880440000', '0.00', '', '22011000', '2.500000000', '242121000', '27.500000000', '616308000', '12276462', '7235520', '5626047', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'HM', 0, '0000-00-00 00:00:00'),
(38, 0, 18, 29, 'KHUSUS', 'GRB/H3A-23', 'RESIDENSIAL', '108.00', '69.00', '5800000', '4500000', '0.00', '0.00', '626400000', '310500000', '936900000', '1030590000', '0.00', '', '25764750', '2.500000000', '283412250', '27.500000000', '721413000', '14370086', '8469464', '6585511', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'HM', 0, '0000-00-00 00:00:00'),
(39, 0, 18, 29, 'KHUSUS', 'GRB/H3A-50', 'RESIDENSIAL', '214.00', '69.00', '5800000', '4725000', '0.00', '0.00', '1241200000', '326025000', '1567225000', '1723947500', '0.00', '', '43098688', '2.500000000', '474085563', '27.500000000', '1206763249', '24037953', '14167526', '11016094', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'HM', 0, '0000-00-00 00:00:00'),
(40, 0, 19, 31, 'SUDUT', 'GRB/F6-22', 'RESIDENSIAL', '140.00', '118.00', '6000000', '5760000', '0.00', '0.00', '840000000', '679680000', '1519680000', '1671648000', '0.00', '', '41791200', '2.500000000', '459703200', '27.500000000', '1170153600', '23308712', '13737725', '10681898', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'HM', 0, '0000-00-00 00:00:00'),
(41, 0, 19, 31, 'STANDAR', 'GRB/F6-30', 'RESIDENSIAL', '98.00', '107.00', '6000000', '4800000', '0.00', '0.00', '588000000', '513600000', '1101600000', '1211760000', '0.00', '', '30294000', '2.500000000', '333234000', '27.500000000', '848232000', '16896240', '9958332', '7743195', '7.25', 'Marketable', '', '2013-07-04 08:11:10', 'HM', 0, '0000-00-00 00:00:00'),
(42, 0, 19, 31, 'KHUSUS', 'GRB/F6-36', 'RESIDENSIAL', '163.00', '107.00', '6000000', '5040000', '0.00', '0.00', '978000000', '539280000', '1517280000', '1669008000', '0.00', '', '41725200', '2.500000000', '458977200', '27.500000000', '1168305600', '23271901', '13716029', '10665028', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(43, 0, 19, 31, 'KHUSUS', 'GRB/F6A-01', 'RESIDENSIAL', '124.00', '107.00', '6000000', '5040000', '0.00', '0.00', '744000000', '539280000', '1283280000', '1411608000', '0.00', '', '35290200', '2.500000000', '388192200', '27.500000000', '988125600', '19682831', '11600697', '9020232', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(44, 0, 19, 31, 'KHUSUS', 'GRB/F6A-03', 'RESIDENSIAL', '109.00', '107.00', '6000000', '5040000', '0.00', '0.00', '654000000', '539280000', '1193280000', '1312608000', '0.00', '', '32815200', '2.500000000', '360967200', '27.500000000', '918825600', '18302419', '10787108', '8387618', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(45, 0, 19, 31, 'KHUSUS', 'GRB/F6A-05', 'RESIDENSIAL', '99.00', '107.00', '6000000', '5040000', '0.00', '0.00', '594000000', '539280000', '1133280000', '1246608000', '0.00', '', '31165200', '2.500000000', '342817200', '27.500000000', '872625600', '17382145', '10244715', '7965875', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(46, 0, 19, 31, 'STANDAR', 'GRB/F6A-06', 'RESIDENSIAL', '98.00', '107.00', '6000000', '4800000', '0.00', '0.00', '588000000', '513600000', '1101600000', '1211760000', '0.00', '', '30294000', '2.500000000', '333234000', '27.500000000', '848232000', '16896240', '9958332', '7743195', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(47, 0, 19, 31, 'STANDAR', 'GRB/F6A-07', 'RESIDENSIAL', '98.00', '107.00', '6000000', '4800000', '0.00', '0.00', '588000000', '513600000', '1101600000', '1211760000', '0.00', '', '30294000', '2.500000000', '333234000', '27.500000000', '848232000', '16896240', '9958332', '7743195', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(48, 0, 19, 31, 'STANDAR', 'GRB/F6A-08', 'RESIDENSIAL', '98.00', '107.00', '6000000', '4800000', '0.00', '0.00', '588000000', '513600000', '1101600000', '1211760000', '0.00', '', '30294000', '2.500000000', '333234000', '27.500000000', '848232000', '16896240', '9958332', '7743195', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(49, 0, 19, 31, 'STANDAR', 'GRB/F6A-09', 'RESIDENSIAL', '98.00', '107.00', '6000000', '4800000', '0.00', '0.00', '588000000', '513600000', '1101600000', '1211760000', '0.00', '', '30294000', '2.500000000', '333234000', '27.500000000', '848232000', '16896240', '9958332', '7743195', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(50, 0, 19, 31, 'STANDAR', 'GRB/F6A-10', 'RESIDENSIAL', '98.00', '107.00', '6000000', '4800000', '0.00', '0.00', '588000000', '513600000', '1101600000', '1211760000', '0.00', '', '30294000', '2.500000000', '333234000', '27.500000000', '848232000', '16896240', '9958332', '7743195', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(51, 0, 19, 31, 'KHUSUS', 'GRB/F6A-11', 'RESIDENSIAL', '99.00', '107.00', '6000000', '5040000', '0.00', '0.00', '594000000', '539280000', '1133280000', '1246608000', '0.00', '', '31165200', '2.500000000', '342817200', '27.500000000', '872625600', '17382145', '10244715', '7965875', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(52, 0, 19, 31, 'KHUSUS', 'GRB/F6A-12', 'RESIDENSIAL', '99.00', '107.00', '6000000', '5040000', '0.00', '0.00', '594000000', '539280000', '1133280000', '1246608000', '0.00', '', '31165200', '2.500000000', '342817200', '27.500000000', '872625600', '17382145', '10244715', '7965875', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(53, 0, 19, 31, 'KHUSUS', 'GRB/F6A-15', 'RESIDENSIAL', '110.00', '107.00', '6000000', '5040000', '0.00', '0.00', '660000000', '539280000', '1199280000', '1319208000', '0.00', '', '32980200', '2.500000000', '362782200', '27.500000000', '923445600', '18394447', '10841347', '8429792', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(54, 0, 19, 31, 'SUDUT', 'GRB/F6B-18', 'RESIDENSIAL', '154.00', '118.00', '6000000', '5760000', '0.00', '0.00', '924000000', '679680000', '1603680000', '1764048000', '0.00', '', '44101200', '2.500000000', '485113200', '27.500000000', '1234833600', '24597097', '14497075', '11272338', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(55, 0, 19, 31, 'KHUSUS', 'GRB/F6B-19', 'RESIDENSIAL', '127.00', '107.00', '6000000', '5040000', '0.00', '0.00', '762000000', '539280000', '1301280000', '1431408000', '0.00', '', '35785200', '2.500000000', '393637200', '27.500000000', '1001985600', '19958913', '11763415', '9146755', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(56, 0, 19, 31, 'SUDUT', 'GRB/F6C-02', 'RESIDENSIAL', '158.00', '118.00', '6000000', '5760000', '0.00', '0.00', '948000000', '679680000', '1627680000', '1790448000', '0.00', '', '44761200', '2.500000000', '492373200', '27.500000000', '1253313600', '24965206', '14714032', '11441035', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(57, 0, 19, 31, 'KHUSUS', 'GRB/F6C-06', 'RESIDENSIAL', '118.00', '107.00', '6000000', '5040000', '0.00', '0.00', '708000000', '539280000', '1247280000', '1372008000', '0.00', '', '34300200', '2.500000000', '377302200', '27.500000000', '960405600', '19130666', '11275262', '8767186', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(58, 0, 19, 31, 'KHUSUS', 'GRB/F6C-08', 'RESIDENSIAL', '125.00', '107.00', '6000000', '5040000', '0.00', '0.00', '750000000', '539280000', '1289280000', '1418208000', '0.00', '', '35455200', '2.500000000', '390007200', '27.500000000', '992745600', '19774858', '11654937', '9062406', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(59, 0, 19, 31, 'KHUSUS', 'GRB/F6C-10', 'RESIDENSIAL', '133.00', '107.00', '6000000', '5040000', '0.00', '0.00', '798000000', '539280000', '1337280000', '1471008000', '0.00', '', '36775200', '2.500000000', '404527200', '27.500000000', '1029705600', '20511078', '12088851', '9399800', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(60, 0, 19, 31, 'KHUSUS', 'GRB/F6C-12', 'RESIDENSIAL', '141.00', '107.00', '6000000', '5040000', '0.00', '0.00', '846000000', '539280000', '1385280000', '1523808000', '0.00', '', '38095200', '2.500000000', '419047200', '27.500000000', '1066665600', '21247298', '12522765', '9737194', '7.25', 'Marketable', '', '2013-07-04 08:11:11', 'HM', 0, '0000-00-00 00:00:00'),
(61, 0, 19, 31, 'SUDUT', 'GRB/F6C-15', 'RESIDENSIAL', '154.00', '118.00', '6000000', '5760000', '0.00', '0.00', '924000000', '679680000', '1603680000', '1764048000', '0.00', '', '44101200', '2.500000000', '485113200', '27.500000000', '1234833600', '24597097', '14497075', '11272338', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HM', 0, '0000-00-00 00:00:00'),
(62, 0, 19, 31, 'KHUSUS', 'GRB/F6C-16', 'RESIDENSIAL', '148.00', '107.00', '6000000', '5040000', '0.00', '0.00', '888000000', '539280000', '1427280000', '1570008000', '0.00', '', '39250200', '2.500000000', '431752200', '27.500000000', '1099005600', '21891490', '12902440', '10032414', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HM', 0, '0000-00-00 00:00:00'),
(63, 0, 19, 31, 'KHUSUS', 'GRB/F6C-18', 'RESIDENSIAL', '155.00', '107.00', '6000000', '5040000', '0.00', '0.00', '930000000', '539280000', '1469280000', '1616208000', '0.00', '', '40405200', '2.500000000', '444457200', '27.500000000', '1131345600', '22535682', '13282115', '10327634', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HM', 0, '0000-00-00 00:00:00'),
(64, 0, 19, 31, 'KHUSUS', 'GRB/F6C-20', 'RESIDENSIAL', '157.00', '107.00', '6000000', '5040000', '0.00', '0.00', '942000000', '539280000', '1481280000', '1629408000', '0.00', '', '40735200', '2.500000000', '448087200', '27.500000000', '1140585600', '22719737', '13390594', '10411983', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HM', 0, '0000-00-00 00:00:00'),
(65, 0, 8, 8, 'KHUSUS', 'GB/GR9-65', 'RESIDENSIAL', '163.00', '108.00', '5600000', '4620000', '0.00', '0.00', '912800000', '498960000', '1411760000', '1552936000', '0.00', '', '38823400', '2.500000000', '427057400', '27.500000000', '1087055200', '21653445', '12762141', '9923323', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HM', 0, '0000-00-00 00:00:00'),
(66, 0, 8, 8, 'STANDAR', 'GB/GR9-81', 'RESIDENSIAL', '98.00', '108.00', '5600000', '4400000', '0.00', '0.00', '548800000', '475200000', '1024000000', '1126400000', '0.00', '', '28160000', '2.500000000', '309760000', '27.500000000', '788480000', '15706018', '9256837', '7197741', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HM', 0, '0000-00-00 00:00:00'),
(67, 0, 8, 8, 'STANDAR', 'GB/GR9-82', 'RESIDENSIAL', '98.00', '108.00', '5600000', '4400000', '0.00', '0.00', '548800000', '475200000', '1024000000', '1126400000', '0.00', '', '28160000', '2.500000000', '309760000', '27.500000000', '788480000', '15706018', '9256837', '7197741', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HM', 0, '0000-00-00 00:00:00'),
(68, 0, 8, 8, 'KHUSUS', 'GB/GR9-83', 'RESIDENSIAL', '176.00', '108.00', '5600000', '4620000', '0.00', '0.00', '985600000', '498960000', '1484560000', '1633016000', '0.00', '', '40825400', '2.500000000', '449079400', '27.500000000', '1143111200', '22770045', '13420245', '10435038', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HM', 0, '0000-00-00 00:00:00'),
(69, 0, 8, 8, 'KHUSUS', 'GB/GR9-88', 'RESIDENSIAL', '105.00', '108.00', '5600000', '4620000', '0.00', '0.00', '588000000', '498960000', '1086960000', '1195656000', '0.00', '', '29891400', '2.500000000', '328805400', '27.500000000', '836959200', '16671693', '9825988', '7640290', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HM', 0, '0000-00-00 00:00:00'),
(70, 0, 8, 8, 'KHUSUS', 'GB/GR9-92', 'RESIDENSIAL', '197.00', '108.00', '5600000', '4620000', '0.00', '0.00', '1103200000', '498960000', '1602160000', '1762376000', '0.00', '', '44059400', '2.500000000', '484653400', '27.500000000', '1233663200', '24573783', '14483334', '11261653', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HM', 0, '0000-00-00 00:00:00'),
(71, 0, 8, 8, 'SUDUT', 'GB/GR9-98', 'RESIDENSIAL', '195.00', '119.00', '5600000', '4840000', '0.00', '0.00', '1092000000', '575960000', '1667960000', '1834756000', '0.00', '', '45868900', '2.500000000', '504557900', '27.500000000', '1284329200', '25583017', '15078159', '11724165', '7.25', 'Marketable', 'Booked', '2013-07-04 08:11:12', 'HM', 0, '0000-00-00 00:00:00'),
(72, 0, 8, 8, 'STANDAR', 'GB/GR9-100', 'RESIDENSIAL', '98.00', '108.00', '5600000', '4400000', '0.00', '0.00', '548800000', '475200000', '1024000000', '1126400000', '0.00', '', '28160000', '2.500000000', '309760000', '27.500000000', '788480000', '15706018', '9256837', '7197741', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HM', 0, '0000-00-00 00:00:00'),
(73, 0, 8, 8, 'STANDAR', 'GB/GR9-101', 'RESIDENSIAL', '98.00', '108.00', '5600000', '4400000', '0.00', '0.00', '548800000', '475200000', '1024000000', '1126400000', '0.00', '', '28160000', '2.500000000', '309760000', '27.500000000', '788480000', '15706018', '9256837', '7197741', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HM', 0, '0000-00-00 00:00:00'),
(74, 0, 8, 8, 'SUDUT', 'GB/GR9-105', 'RESIDENSIAL', '154.00', '119.00', '5600000', '4840000', '0.00', '0.00', '862400000', '575960000', '1438360000', '1582196000', '0.00', '', '39554900', '2.500000000', '435103900', '27.500000000', '1107537200', '22061434', '13002602', '10110296', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HM', 0, '0000-00-00 00:00:00'),
(75, 0, 9, 11, 'SUDUT', 'D1/A-01', 'RESIDENSIAL', '180.00', '162.00', '6700000', '5280000', '0.00', '0.00', '1206000000', '855360000', '2061360000', '2267496000', '0.00', '', '56687400', '2.500000000', '623561400', '27.500000000', '1587247200', '31616951', '18634447', '14489391', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HH', 0, '0000-00-00 00:00:00'),
(76, 0, 9, 11, 'STANDAR', 'D1/A-02', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '904500000', '646800000', '1551300000', '1706430000', '0.00', '', '42660750', '2.500000000', '469268250', '27.500000000', '1194501000', '23793697', '14023566', '10904156', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HM', 0, '0000-00-00 00:00:00'),
(77, 0, 9, 11, 'SUDUT', 'D1/A-05', 'RESIDENSIAL', '179.00', '162.00', '6700000', '5280000', '0.00', '0.00', '1199300000', '855360000', '2054660000', '2260126000', '0.00', '', '56503150', '2.500000000', '621534650', '27.500000000', '1582088200', '31514187', '18573880', '14442296', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HH', 0, '0000-00-00 00:00:00'),
(78, 0, 9, 11, 'SUDUT', 'D1/A-06', 'RESIDENSIAL', '217.00', '162.00', '6700000', '5280000', '0.00', '0.00', '1453900000', '855360000', '2309260000', '2540186000', '0.00', '', '63504650', '2.500000000', '698551150', '27.500000000', '1778130200', '35419218', '20875434', '16231891', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HH', 0, '0000-00-00 00:00:00'),
(79, 0, 9, 11, 'STANDAR', 'D1/A-10', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '904500000', '646800000', '1551300000', '1706430000', '0.00', '', '42660750', '2.500000000', '469268250', '27.500000000', '1194501000', '23793697', '14023566', '10904156', '7.25', 'Marketable', '', '2013-07-04 08:11:12', 'HM', 0, '0000-00-00 00:00:00'),
(80, 0, 9, 11, 'SUDUT', 'D1/A-12', 'RESIDENSIAL', '213.00', '162.00', '6700000', '5280000', '0.00', '0.00', '1427100000', '855360000', '2282460000', '2510706000', '0.00', '', '62767650', '2.500000000', '690444150', '27.500000000', '1757494200', '35008162', '20633165', '16043512', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HH', 0, '0000-00-00 00:00:00'),
(81, 0, 9, 11, 'SUDUT', 'D1/B-01', 'RESIDENSIAL', '179.00', '162.00', '6700000', '5280000', '0.00', '0.00', '1319230000', '855360000', '2174590000', '2392049000', '10.00', '', '59801225', '2.500000000', '657813475', '27.500000000', '1674434300', '33353662', '19658033', '15285289', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HH', 0, '0000-00-00 00:00:00'),
(82, 0, 9, 11, 'STANDAR', 'D1/B-02', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '904500000', '646800000', '1551300000', '1706430000', '0.00', '', '42660750', '2.500000000', '469268250', '27.500000000', '1194501000', '23793697', '14023566', '10904156', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HM', 0, '0000-00-00 00:00:00'),
(83, 0, 9, 11, 'SUDUT', 'D1/B-05', 'RESIDENSIAL', '179.00', '162.00', '6700000', '5280000', '0.00', '0.00', '1199300000', '855360000', '2054660000', '2260126000', '0.00', '', '56503150', '2.500000000', '621534650', '27.500000000', '1582088200', '31514187', '18573880', '14442296', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HH', 0, '0000-00-00 00:00:00'),
(84, 0, 9, 11, 'SUDUT', 'D1/B-06', 'RESIDENSIAL', '179.00', '162.00', '6700000', '5280000', '0.00', '0.00', '1199300000', '855360000', '2054660000', '2260126000', '0.00', '', '56503150', '2.500000000', '621534650', '27.500000000', '1582088200', '31514187', '18573880', '14442296', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HH', 0, '0000-00-00 00:00:00'),
(85, 0, 9, 11, 'STANDAR', 'D1/B-09', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '904500000', '646800000', '1551300000', '1706430000', '0.00', '', '42660750', '2.500000000', '469268250', '27.500000000', '1194501000', '23793697', '14023566', '10904156', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HM', 0, '0000-00-00 00:00:00'),
(86, 0, 9, 11, 'STANDAR', 'D1/B-10', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '904500000', '646800000', '1551300000', '1706430000', '0.00', '', '42660750', '2.500000000', '469268250', '27.500000000', '1194501000', '23793697', '14023566', '10904156', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HM', 0, '0000-00-00 00:00:00'),
(87, 0, 9, 11, 'STANDAR', 'D1/B-11', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '904500000', '646800000', '1551300000', '1706430000', '0.00', '', '42660750', '2.500000000', '469268250', '27.500000000', '1194501000', '23793697', '14023566', '10904156', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HM', 0, '0000-00-00 00:00:00'),
(88, 0, 9, 11, 'SUDUT', 'D1/B-12', 'RESIDENSIAL', '225.00', '162.00', '6700000', '5280000', '0.00', '0.00', '1507500000', '855360000', '2362860000', '2599146000', '0.00', '', '64978650', '2.500000000', '714765150', '27.500000000', '1819402200', '36241330', '21359971', '16608647', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HH', 0, '0000-00-00 00:00:00'),
(89, 0, 9, 9, 'SUDUT', 'D1/C-01', 'RESIDENSIAL', '196.00', '135.00', '6700000', '5280000', '0.00', '0.00', '1313200000', '712800000', '2026000000', '2228600000', '0.00', '', '55715000', '2.500000000', '612865000', '27.500000000', '1560020000', '31074602', '18314797', '14240844', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HH', 0, '0000-00-00 00:00:00'),
(90, 0, 9, 9, 'KHUSUS', 'D1/C-03', 'RESIDENSIAL', '129.00', '122.00', '6700000', '4620000', '0.00', '0.00', '864300000', '563640000', '1427940000', '1570734000', '0.00', '', '39268350', '2.500000000', '431951850', '27.500000000', '1099513800', '21901613', '12908406', '10037053', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HM', 0, '0000-00-00 00:00:00'),
(91, 0, 9, 9, 'KHUSUS', 'D1/C-05', 'RESIDENSIAL', '141.00', '122.00', '6700000', '4620000', '0.00', '0.00', '944700000', '563640000', '1508340000', '1659174000', '0.00', '', '41479350', '2.500000000', '456272850', '27.500000000', '1161421800', '23134781', '13635213', '10602189', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HM', 0, '0000-00-00 00:00:00'),
(92, 0, 9, 9, 'KHUSUS', 'D1/C-07', 'RESIDENSIAL', '145.00', '122.00', '6700000', '4620000', '0.00', '0.00', '971500000', '563640000', '1535140000', '1688654000', '0.00', '', '42216350', '2.500000000', '464379850', '27.500000000', '1182057800', '23545836', '13877482', '10790567', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HM', 0, '0000-00-00 00:00:00'),
(93, 0, 9, 9, 'KHUSUS', 'D1/C-09', 'RESIDENSIAL', '146.00', '122.00', '6700000', '4620000', '0.00', '0.00', '978200000', '563640000', '1541840000', '1696024000', '0.00', '', '42400600', '2.500000000', '466406600', '27.500000000', '1187216800', '23648600', '13938049', '10837661', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HM', 0, '0000-00-00 00:00:00'),
(94, 0, 9, 9, 'KHUSUS', 'D1/C-11', 'RESIDENSIAL', '149.00', '122.00', '6700000', '4620000', '0.00', '0.00', '998300000', '563640000', '1561940000', '1718134000', '0.00', '', '42953350', '2.500000000', '472486850', '27.500000000', '1202693800', '23956892', '14119750', '10978945', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HM', 0, '0000-00-00 00:00:00'),
(95, 0, 9, 9, 'KHUSUS', 'D1/C-15', 'RESIDENSIAL', '155.00', '122.00', '6700000', '4620000', '0.00', '0.00', '1038500000', '563640000', '1602140000', '1762354000', '0.00', '', '44058850', '2.500000000', '484647350', '27.500000000', '1233647800', '24573476', '14483154', '11261513', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HM', 0, '0000-00-00 00:00:00'),
(96, 0, 9, 9, 'KHUSUS', 'D1/C-17', 'RESIDENSIAL', '159.00', '122.00', '6700000', '4620000', '0.00', '0.00', '1065300000', '563640000', '1628940000', '1791834000', '0.00', '', '44795850', '2.500000000', '492754350', '27.500000000', '1254283800', '24984532', '14725422', '11449891', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HM', 0, '0000-00-00 00:00:00'),
(97, 0, 9, 9, 'SUDUT', 'D1/C-19', 'RESIDENSIAL', '179.00', '135.00', '6700000', '5280000', '0.00', '0.00', '1199300000', '712800000', '1912100000', '2103310000', '0.00', '', '52582750', '2.500000000', '578410250', '27.500000000', '1472317000', '29327614', '17285155', '13440235', '7.25', 'Marketable', 'Booked', '2013-07-04 08:11:13', 'HM', 0, '0000-00-00 00:00:00'),
(98, 0, 9, 11, 'SUDUT', 'D1/C-02', 'RESIDENSIAL', '179.00', '162.00', '6700000', '5280000', '0.00', '0.00', '1319230000', '855360000', '2174590000', '2392049000', '10.00', '', '59801225', '2.500000000', '657813475', '27.500000000', '1674434300', '33353662', '19658033', '15285289', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HH', 0, '0000-00-00 00:00:00'),
(99, 0, 9, 11, 'STANDAR', 'D1/C-06', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '972337500', '646800000', '1619137500', '1781051250', '7.50', '', '44526281', '2.500000000', '489789094', '27.500000000', '1246735875', '24834182', '14636809', '11380989', '7.25', 'Marketable', '', '2013-07-04 08:11:13', 'HM', 0, '0000-00-00 00:00:00'),
(100, 0, 9, 11, 'STANDAR', 'D1/C-10', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '904500000', '646800000', '1551300000', '1706430000', '0.00', '', '42660750', '2.500000000', '469268250', '27.500000000', '1194501000', '23793697', '14023566', '10904156', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HM', 0, '0000-00-00 00:00:00'),
(101, 0, 9, 11, 'STANDAR', 'D1/C-16', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '904500000', '646800000', '1551300000', '1706430000', '0.00', '', '42660750', '2.500000000', '469268250', '27.500000000', '1194501000', '23793697', '14023566', '10904156', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HM', 0, '0000-00-00 00:00:00'),
(102, 0, 9, 11, 'STANDAR', 'D1/C-18', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '904500000', '646800000', '1551300000', '1706430000', '0.00', '', '42660750', '2.500000000', '469268250', '27.500000000', '1194501000', '23793697', '14023566', '10904156', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HM', 0, '0000-00-00 00:00:00'),
(103, 0, 9, 11, 'STANDAR', 'D1/C-20', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '904500000', '646800000', '1551300000', '1706430000', '0.00', '', '42660750', '2.500000000', '469268250', '27.500000000', '1194501000', '23793697', '14023566', '10904156', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HM', 0, '0000-00-00 00:00:00'),
(104, 0, 9, 11, 'STANDAR', 'D1/C-22', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '904500000', '646800000', '1551300000', '1706430000', '0.00', '', '42660750', '2.500000000', '469268250', '27.500000000', '1194501000', '23793697', '14023566', '10904156', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HM', 0, '0000-00-00 00:00:00'),
(105, 0, 9, 11, 'SUDUT', 'D1/C-28', 'RESIDENSIAL', '187.00', '147.00', '6700000', '5280000', '0.00', '0.00', '1346867500', '776160000', '2123027500', '2335330250', '7.50', '', '58383256', '2.500000000', '642215819', '27.500000000', '1634731175', '32562801', '19191914', '14922854', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HH', 0, '0000-00-00 00:00:00'),
(106, 0, 9, 9, 'SUDUT', 'D1/D-02', 'RESIDENSIAL', '204.00', '135.00', '6700000', '5280000', '0.00', '0.00', '1366800000', '712800000', '2079600000', '2287560000', '0.00', '', '57189000', '2.500000000', '629079000', '27.500000000', '1601292000', '31896714', '18799335', '14617600', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HH', 0, '0000-00-00 00:00:00'),
(107, 0, 9, 9, 'STANDAR', 'D1/D-08', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HM', 0, '0000-00-00 00:00:00'),
(108, 0, 9, 9, 'STANDAR', 'D1/D-16', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HM', 0, '0000-00-00 00:00:00'),
(109, 0, 9, 9, 'SUDUT', 'D1/D-22', 'RESIDENSIAL', '217.00', '135.00', '6700000', '5280000', '0.00', '0.00', '1526595000', '712800000', '2239395000', '2463334500', '5.00', '', '61583363', '2.500000000', '677416988', '27.500000000', '1724334149', '34347635', '20243862', '15740806', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HH', 0, '0000-00-00 00:00:00'),
(110, 0, 9, 9, 'SUDUT', 'D1/D-25', 'RESIDENSIAL', '174.00', '135.00', '6700000', '5280000', '0.00', '0.00', '1253235000', '712800000', '1966035000', '2162638500', '7.50', '', '54065963', '2.500000000', '594725588', '27.500000000', '1513846949', '30154864', '17772721', '13819347', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HM', 0, '0000-00-00 00:00:00'),
(111, 0, 9, 11, 'SUDUT', 'D1/E-01', 'RESIDENSIAL', '204.00', '162.00', '6700000', '5280000', '0.00', '0.00', '1366800000', '855360000', '2222160000', '2444376000', '0.00', '', '61109400', '2.500000000', '672203400', '27.500000000', '1711063200', '34083286', '20088060', '15619661', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HH', 0, '0000-00-00 00:00:00'),
(112, 0, 9, 11, 'SUDUT', 'D1/E-02', 'RESIDENSIAL', '259.00', '162.00', '6700000', '5280000', '0.00', '0.00', '1735300000', '855360000', '2590660000', '2849726000', '0.00', '', '71243150', '2.500000000', '783674650', '27.500000000', '1994808200', '39735305', '23419256', '18209864', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HH', 0, '0000-00-00 00:00:00'),
(113, 0, 9, 11, 'STANDAR', 'D1/E-03', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '904500000', '646800000', '1551300000', '1706430000', '0.00', '', '42660750', '2.500000000', '469268250', '27.500000000', '1194501000', '23793697', '14023566', '10904156', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HM', 0, '0000-00-00 00:00:00'),
(114, 0, 9, 11, 'STANDAR', 'D1/E-05', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '904500000', '646800000', '1551300000', '1706430000', '0.00', '', '42660750', '2.500000000', '469268250', '27.500000000', '1194501000', '23793697', '14023566', '10904156', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HM', 0, '0000-00-00 00:00:00'),
(115, 0, 9, 11, 'KHUSUS', 'D1/E-06', 'RESIDENSIAL', '212.00', '147.00', '6700000', '4620000', '0.00', '0.00', '1491420000', '679140000', '2170560000', '2387616000', '5.00', '', '59690400', '2.500000000', '656594400', '27.500000000', '1671331200', '33291850', '19621602', '15256962', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HH', 0, '0000-00-00 00:00:00'),
(116, 0, 9, 11, 'STANDAR', 'D1/E-07', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '972337500', '646800000', '1619137500', '1781051250', '7.50', '', '44526281', '2.500000000', '489789094', '27.500000000', '1246735875', '24834182', '14636809', '11380989', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HM', 0, '0000-00-00 00:00:00'),
(117, 0, 9, 11, 'STANDAR', 'D1/E-09', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '972337500', '646800000', '1619137500', '1781051250', '7.50', '', '44526281', '2.500000000', '489789094', '27.500000000', '1246735875', '24834182', '14636809', '11380989', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HM', 0, '0000-00-00 00:00:00'),
(118, 0, 9, 11, 'STANDAR', 'D1/E-11', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '972337500', '646800000', '1619137500', '1781051250', '7.50', '', '44526281', '2.500000000', '489789094', '27.500000000', '1246735875', '24834182', '14636809', '11380989', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HM', 0, '0000-00-00 00:00:00'),
(119, 0, 9, 11, 'STANDAR', 'D1/E-15', 'RESIDENSIAL', '135.00', '147.00', '6700000', '4400000', '0.00', '0.00', '972337500', '646800000', '1619137500', '1781051250', '7.50', '', '44526281', '2.500000000', '489789094', '27.500000000', '1246735875', '24834182', '14636809', '11380989', '7.25', 'Marketable', '', '2013-07-04 08:11:14', 'HM', 0, '0000-00-00 00:00:00'),
(120, 0, 9, 11, 'SUDUT', 'D1/E-17', 'RESIDENSIAL', '219.00', '162.00', '6700000', '5280000', '0.00', '0.00', '1577347500', '855360000', '2432707500', '2675978250', '7.50', '', '66899456', '2.500000000', '735894019', '27.500000000', '1873184775', '37312644', '21991384', '17099609', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HH', 0, '0000-00-00 00:00:00'),
(121, 0, 9, 9, 'SUDUT', 'D1/F-01', 'RESIDENSIAL', '217.00', '135.00', '6700000', '5280000', '0.00', '0.00', '1526595000', '712800000', '2239395000', '2463334500', '5.00', '', '61583363', '2.500000000', '677416988', '27.500000000', '1724334149', '34347635', '20243862', '15740806', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HH', 0, '0000-00-00 00:00:00'),
(122, 0, 9, 9, 'SUDUT', 'D1/F-02', 'RESIDENSIAL', '177.00', '135.00', '6700000', '5280000', '0.00', '0.00', '1245195000', '712800000', '1957995000', '2153794500', '5.00', '', '53844863', '2.500000000', '592293488', '27.500000000', '1507656149', '30031548', '17700040', '13762833', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HM', 0, '0000-00-00 00:00:00'),
(123, 0, 9, 9, 'KHUSUS', 'D1/F-03', 'RESIDENSIAL', '153.00', '122.00', '6700000', '4620000', '0.00', '0.00', '1025100000', '563640000', '1588740000', '1747614000', '0.00', '', '43690350', '2.500000000', '480593850', '27.500000000', '1223329800', '24367948', '14362019', '11167324', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HM', 0, '0000-00-00 00:00:00'),
(124, 0, 9, 9, 'KHUSUS', 'D1/F-05', 'RESIDENSIAL', '147.00', '122.00', '6700000', '4620000', '0.00', '0.00', '984900000', '563640000', '1548540000', '1703394000', '0.00', '', '42584850', '2.500000000', '468433350', '27.500000000', '1192375800', '23751364', '13998616', '10884756', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HM', 0, '0000-00-00 00:00:00'),
(125, 0, 9, 9, 'KHUSUS', 'D1/F-07', 'RESIDENSIAL', '131.00', '122.00', '6700000', '4620000', '0.00', '0.00', '877700000', '563640000', '1441340000', '1585474000', '0.00', '', '39636850', '2.500000000', '436005350', '27.500000000', '1109831800', '22107141', '13029541', '10131243', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HM', 0, '0000-00-00 00:00:00'),
(126, 0, 9, 9, 'STANDAR', 'D1/F-09', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HM', 0, '0000-00-00 00:00:00'),
(127, 0, 9, 9, 'STANDAR', 'D1/F-11', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HM', 0, '0000-00-00 00:00:00'),
(128, 0, 9, 9, 'STANDAR', 'D1/F-15', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HM', 0, '0000-00-00 00:00:00'),
(129, 0, 9, 9, 'SUDUT', 'D1/F-17', 'RESIDENSIAL', '237.00', '135.00', '6700000', '5280000', '0.00', '0.00', '1587900000', '712800000', '2300700000', '2530770000', '0.00', '', '63269250', '2.500000000', '695961750', '27.500000000', '1771539000', '35287925', '20798052', '16171722', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HH', 0, '0000-00-00 00:00:00'),
(130, 0, 9, 9, 'SUDUT', 'D1/F-20', 'RESIDENSIAL', '188.00', '135.00', '6700000', '5280000', '0.00', '0.00', '1259600000', '712800000', '1972400000', '2169640000', '0.00', '', '54241000', '2.500000000', '596651000', '27.500000000', '1518748000', '30252490', '17830260', '13864087', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HM', 0, '0000-00-00 00:00:00'),
(131, 0, 9, 9, 'STANDAR', 'D1/F-08', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HM', 0, '0000-00-00 00:00:00'),
(132, 0, 9, 9, 'STANDAR', 'D1/F-10', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HM', 0, '0000-00-00 00:00:00'),
(133, 0, 9, 9, 'STANDAR', 'D1/F-12', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HM', 0, '0000-00-00 00:00:00'),
(134, 0, 9, 9, 'STANDAR', 'D1/F-16', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HM', 0, '0000-00-00 00:00:00'),
(135, 0, 9, 9, 'STANDAR', 'D1/F-18', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HM', 0, '0000-00-00 00:00:00'),
(136, 0, 9, 9, 'SUDUT', 'D1/G-01', 'RESIDENSIAL', '288.00', '135.00', '6700000', '5280000', '0.00', '0.00', '2026080000', '712800000', '2738880000', '3012768000', '5.00', '', '75319200', '2.500000000', '828511200', '27.500000000', '2108937600', '42008690', '24759147', '19251709', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HH', 0, '0000-00-00 00:00:00'),
(137, 0, 9, 9, 'SUDUT', 'D1/G-02', 'RESIDENSIAL', '223.00', '135.00', '6700000', '5280000', '0.00', '0.00', '1568805000', '712800000', '2281605000', '2509765500', '5.00', '', '62744138', '2.500000000', '690185513', '27.500000000', '1756835849', '34995048', '20625436', '16037502', '7.25', 'Marketable', '', '2013-07-04 08:11:15', 'HH', 0, '0000-00-00 00:00:00');
INSERT INTO `tbl_unit` (`id_unit`, `id_promo`, `id_cluster`, `id_type`, `posisi`, `kode_unit`, `kategori`, `luas_tanah`, `luas_bangunan`, `harga_tanah_m2`, `harga_bangunan_m2`, `diskon_tanah`, `diskon_bangunan`, `harga_tanah`, `harga_bangunan`, `harga_jual_exc_ppn`, `harga_jual_inc_ppn`, `fs`, `keterangan_fs`, `tanda_jadi`, `persen_tanda_jadi`, `uang_muka`, `persen_uang_muka`, `plafon_kpr`, `kpr_5_tahun`, `kpr_10_tahun`, `kpr_15_tahun`, `suku_bunga`, `status_unit`, `status_transaksi`, `tanggal_posting`, `kelas_produk`, `locked`, `tanggal_locked`) VALUES
(138, 0, 9, 9, 'STANDAR', 'D1/G-05', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:16', 'HM', 0, '0000-00-00 00:00:00'),
(139, 0, 9, 9, 'STANDAR', 'D1/G-06', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:16', 'HM', 0, '0000-00-00 00:00:00'),
(140, 0, 9, 9, 'STANDAR', 'D1/G-07', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:16', 'HM', 0, '0000-00-00 00:00:00'),
(141, 0, 9, 9, 'STANDAR', 'D1/G-10', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:16', 'HM', 0, '0000-00-00 00:00:00'),
(142, 0, 9, 9, 'SUDUT', 'D1/G-11', 'RESIDENSIAL', '213.00', '135.00', '6700000', '5280000', '0.00', '0.00', '1427100000', '712800000', '2139900000', '2353890000', '0.00', '', '58847250', '2.500000000', '647319750', '27.500000000', '1647723000', '32821590', '19344440', '15041452', '7.25', 'Marketable', '', '2013-07-04 08:11:16', 'HH', 0, '0000-00-00 00:00:00'),
(143, 0, 9, 9, 'STANDAR', 'D1/G-12', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:16', 'HM', 0, '0000-00-00 00:00:00'),
(144, 0, 9, 9, 'STANDAR', 'D1/G-16', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:16', 'HM', 0, '0000-00-00 00:00:00'),
(145, 0, 9, 9, 'SUDUT', 'D1/G-18', 'RESIDENSIAL', '172.00', '135.00', '6700000', '5280000', '0.00', '0.00', '1152400000', '712800000', '1865200000', '2051720000', '0.00', '', '51293000', '2.500000000', '564223000', '27.500000000', '1436204000', '28608266', '16861184', '13110573', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(146, 0, 9, 10, 'SUDUT', 'D1/H-01', 'RESIDENSIAL', '158.00', '121.00', '6700000', '5280000', '0.00', '0.00', '1058600000', '638880000', '1697480000', '1867228000', '0.00', '', '46680700', '2.500000000', '513487700', '27.500000000', '1307059600', '26035792', '15345016', '11931662', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(147, 0, 9, 10, 'SUDUT', 'D1/H-02', 'RESIDENSIAL', '180.00', '121.00', '6700000', '5280000', '0.00', '0.00', '1206000000', '638880000', '1844880000', '2029368000', '0.00', '', '50734200', '2.500000000', '558076200', '27.500000000', '1420557600', '28296600', '16677494', '12967743', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(148, 0, 9, 10, 'STANDAR', 'D1/H-06', 'RESIDENSIAL', '105.00', '110.00', '6700000', '4400000', '0.00', '0.00', '703500000', '484000000', '1187500000', '1306250000', '0.00', '', '32656250', '2.500000000', '359218750', '27.500000000', '914375000', '18213766', '10734858', '8346990', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(149, 0, 9, 10, 'STANDAR', 'D1/H-08', 'RESIDENSIAL', '105.00', '110.00', '6700000', '4400000', '0.00', '0.00', '703500000', '484000000', '1187500000', '1306250000', '0.00', '', '32656250', '2.500000000', '359218750', '27.500000000', '914375000', '18213766', '10734858', '8346990', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(150, 0, 9, 10, 'STANDAR', 'D1/H-10', 'RESIDENSIAL', '105.00', '110.00', '6700000', '4400000', '0.00', '0.00', '703500000', '484000000', '1187500000', '1306250000', '0.00', '', '32656250', '2.500000000', '359218750', '27.500000000', '914375000', '18213766', '10734858', '8346990', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(151, 0, 9, 10, 'STANDAR', 'D1/H-12', 'RESIDENSIAL', '105.00', '110.00', '6700000', '4400000', '0.00', '0.00', '703500000', '484000000', '1187500000', '1306250000', '0.00', '', '32656250', '2.500000000', '359218750', '27.500000000', '914375000', '18213766', '10734858', '8346990', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(152, 0, 9, 10, 'STANDAR', 'D1/H-16', 'RESIDENSIAL', '105.00', '110.00', '6700000', '4400000', '0.00', '0.00', '703500000', '484000000', '1187500000', '1306250000', '0.00', '', '32656250', '2.500000000', '359218750', '27.500000000', '914375000', '18213766', '10734858', '8346990', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(153, 0, 9, 10, 'STANDAR', 'D1/H-18', 'RESIDENSIAL', '105.00', '110.00', '6700000', '4400000', '0.00', '0.00', '703500000', '484000000', '1187500000', '1306250000', '0.00', '', '32656250', '2.500000000', '359218750', '27.500000000', '914375000', '18213766', '10734858', '8346990', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(154, 0, 9, 10, 'SUDUT', 'D1/H-19', 'RESIDENSIAL', '158.00', '121.00', '6700000', '5280000', '0.00', '0.00', '1058600000', '638880000', '1697480000', '1867228000', '0.00', '', '46680700', '2.500000000', '513487700', '27.500000000', '1307059600', '26035792', '15345016', '11931662', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(155, 0, 9, 10, 'STANDAR', 'D1/H-20', 'RESIDENSIAL', '105.00', '110.00', '6700000', '4400000', '0.00', '0.00', '703500000', '484000000', '1187500000', '1306250000', '0.00', '', '32656250', '2.500000000', '359218750', '27.500000000', '914375000', '18213766', '10734858', '8346990', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(156, 0, 9, 10, 'SUDUT', 'D1/H-21', 'RESIDENSIAL', '179.00', '110.00', '6700000', '5280000', '0.00', '0.00', '1199300000', '580800000', '1780100000', '1958110000', '0.00', '', '48952750', '2.500000000', '538480250', '27.500000000', '1370677000', '27303010', '16091891', '12512402', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(157, 0, 9, 10, 'KHUSUS', 'D1/H-22', 'RESIDENSIAL', '219.00', '110.00', '6700000', '4620000', '0.00', '0.00', '1467300000', '508200000', '1975500000', '2173050000', '0.00', '', '54326250', '2.500000000', '597588750', '27.500000000', '1521135000', '30300038', '17858283', '13885877', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(158, 0, 9, 10, 'KHUSUS', 'D1/H-23', 'RESIDENSIAL', '211.00', '110.00', '6700000', '4620000', '0.00', '0.00', '1413700000', '508200000', '1921900000', '2114090000', '0.00', '', '52852250', '2.500000000', '581374750', '27.500000000', '1479863000', '29477926', '17373746', '13509120', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(159, 0, 9, 10, 'SUDUT', 'D1/I-01', 'RESIDENSIAL', '212.00', '121.00', '6700000', '5280000', '0.00', '0.00', '1420400000', '638880000', '2059280000', '2265208000', '0.00', '', '56630200', '2.500000000', '622932200', '27.500000000', '1585645600', '31585048', '18615644', '14474770', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HH', 0, '0000-00-00 00:00:00'),
(160, 0, 9, 10, 'STANDAR', 'D1/I-02', 'RESIDENSIAL', '105.00', '110.00', '6700000', '4400000', '0.00', '0.00', '703500000', '484000000', '1187500000', '1306250000', '0.00', '', '32656250', '2.500000000', '359218750', '27.500000000', '914375000', '18213766', '10734858', '8346990', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(161, 0, 9, 10, 'SUDUT', 'D1/I-03', 'RESIDENSIAL', '221.00', '121.00', '6700000', '5280000', '0.00', '0.00', '1480700000', '638880000', '2119580000', '2331538000', '0.00', '', '58288450', '2.500000000', '641172950', '27.500000000', '1632076600', '32509924', '19160749', '14898621', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HH', 0, '0000-00-00 00:00:00'),
(162, 0, 9, 10, 'SUDUT', 'D1/J-01', 'RESIDENSIAL', '149.00', '121.00', '6700000', '5280000', '0.00', '0.00', '998300000', '638880000', '1637180000', '1800898000', '0.00', '', '45022450', '2.500000000', '495246950', '27.500000000', '1260628600', '25110917', '14799911', '11507811', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(163, 0, 9, 9, 'SUDUT', 'D1/J-02', 'RESIDENSIAL', '178.00', '135.00', '6700000', '5280000', '0.00', '0.00', '1192600000', '712800000', '1905400000', '2095940000', '0.00', '', '52398500', '2.500000000', '576383500', '27.500000000', '1467158000', '29224850', '17224588', '13393141', '7.25', 'Marketable', '', '2013-07-04 08:11:17', 'HM', 0, '0000-00-00 00:00:00'),
(164, 0, 9, 10, 'STANDAR', 'D1/J-03', 'RESIDENSIAL', '105.00', '110.00', '6700000', '4400000', '0.00', '0.00', '703500000', '484000000', '1187500000', '1306250000', '0.00', '', '32656250', '2.500000000', '359218750', '27.500000000', '914375000', '18213766', '10734858', '8346990', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HM', 0, '0000-00-00 00:00:00'),
(165, 0, 9, 10, 'STANDAR', 'D1/J-05', 'RESIDENSIAL', '105.00', '110.00', '6700000', '4400000', '0.00', '0.00', '703500000', '484000000', '1187500000', '1306250000', '0.00', '', '32656250', '2.500000000', '359218750', '27.500000000', '914375000', '18213766', '10734858', '8346990', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HM', 0, '0000-00-00 00:00:00'),
(166, 0, 9, 9, 'KHUSUS', 'D1/J-06', 'RESIDENSIAL', '122.00', '122.00', '6700000', '4620000', '0.00', '0.00', '817400000', '563640000', '1381040000', '1519144000', '0.00', '', '37978600', '2.500000000', '417764600', '27.500000000', '1063400800', '21182265', '12484436', '9707391', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HM', 0, '0000-00-00 00:00:00'),
(167, 0, 9, 10, 'KHUSUS', 'D1/J-07', 'RESIDENSIAL', '121.00', '110.00', '6700000', '4620000', '0.00', '0.00', '810700000', '508200000', '1318900000', '1450790000', '0.00', '', '36269750', '2.500000000', '398967250', '27.500000000', '1015553000', '20229167', '11922698', '9270606', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HM', 0, '0000-00-00 00:00:00'),
(168, 0, 9, 9, 'KHUSUS', 'D1/J-08', 'RESIDENSIAL', '122.00', '122.00', '6700000', '4620000', '0.00', '0.00', '817400000', '563640000', '1381040000', '1519144000', '0.00', '', '37978600', '2.500000000', '417764600', '27.500000000', '1063400800', '21182265', '12484436', '9707391', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HM', 0, '0000-00-00 00:00:00'),
(169, 0, 9, 9, 'KHUSUS', 'D1/J-10', 'RESIDENSIAL', '121.00', '122.00', '6700000', '4620000', '0.00', '0.00', '810700000', '563640000', '1374340000', '1511774000', '0.00', '', '37794350', '2.500000000', '415737850', '27.500000000', '1058241800', '21079501', '12423869', '9660297', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HM', 0, '0000-00-00 00:00:00'),
(170, 0, 9, 9, 'KHUSUS', 'D1/J-12', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4620000', '0.00', '0.00', '804000000', '563640000', '1367640000', '1504404000', '0.00', '', '37610100', '2.500000000', '413711100', '27.500000000', '1053082800', '20976737', '12363302', '9613202', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HM', 0, '0000-00-00 00:00:00'),
(171, 0, 9, 9, 'KHUSUS', 'D1/J-16', 'RESIDENSIAL', '163.00', '122.00', '6700000', '4620000', '0.00', '0.00', '1092100000', '563640000', '1655740000', '1821314000', '0.00', '', '45532850', '2.500000000', '500861350', '27.500000000', '1274919800', '25395588', '14967691', '11638270', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HM', 0, '0000-00-00 00:00:00'),
(172, 0, 9, 9, 'SUDUT', 'D1/K-01', 'RESIDENSIAL', '164.00', '135.00', '6700000', '5280000', '0.00', '0.00', '1153740000', '712800000', '1866540000', '2053194000', '5.00', '', '51329850', '2.500000000', '564628350', '27.500000000', '1437235800', '28628819', '16873298', '13119992', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HM', 0, '0000-00-00 00:00:00'),
(173, 0, 9, 9, 'STANDAR', 'D1/K-02', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HM', 0, '0000-00-00 00:00:00'),
(174, 0, 9, 9, 'STANDAR', 'D1/K-03', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HM', 0, '0000-00-00 00:00:00'),
(175, 0, 9, 9, 'STANDAR', 'D1/K-05', 'RESIDENSIAL', '120.00', '122.00', '6700000', '4400000', '0.00', '0.00', '804000000', '536800000', '1340800000', '1474880000', '0.00', '', '36872000', '2.500000000', '405592000', '27.500000000', '1032416000', '20565067', '12120671', '9424542', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HM', 0, '0000-00-00 00:00:00'),
(176, 0, 9, 9, 'KHUSUS', 'D1/K-06', 'RESIDENSIAL', '126.00', '122.00', '6700000', '4620000', '0.00', '0.00', '844200000', '563640000', '1407840000', '1548624000', '0.00', '', '38715600', '2.500000000', '425871600', '27.500000000', '1084036800', '21593321', '12726705', '9895770', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HM', 0, '0000-00-00 00:00:00'),
(177, 0, 9, 9, 'KHUSUS', 'D1/K-07', 'RESIDENSIAL', '235.00', '122.00', '6700000', '4620000', '0.00', '0.00', '1574500000', '563640000', '2138140000', '2351954000', '0.00', '', '58798850', '2.500000000', '646787350', '27.500000000', '1646367800', '32794595', '19328529', '15029081', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HH', 0, '0000-00-00 00:00:00'),
(178, 0, 9, 9, 'KHUSUS', 'D1/K-08', 'RESIDENSIAL', '190.00', '122.00', '6700000', '4620000', '0.00', '0.00', '1273000000', '563640000', '1836640000', '2020304000', '0.00', '', '50507600', '2.500000000', '555583600', '27.500000000', '1414212800', '28170216', '16603006', '12909824', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HM', 0, '0000-00-00 00:00:00'),
(179, 0, 9, 9, 'SUDUT', 'D1/K-09', 'RESIDENSIAL', '211.00', '135.00', '6700000', '5280000', '0.00', '0.00', '1484385000', '712800000', '2197185000', '2416903500', '5.00', '', '60422588', '2.500000000', '664648463', '27.500000000', '1691832449', '33700222', '19862289', '15444110', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HH', 0, '0000-00-00 00:00:00'),
(180, 0, 9, 9, 'KHUSUS', 'D1/K-10', 'RESIDENSIAL', '220.00', '122.00', '6700000', '4620000', '0.00', '0.00', '1474000000', '563640000', '2037640000', '2241404000', '0.00', '', '56035100', '2.500000000', '616386100', '27.500000000', '1568982800', '31253135', '18420021', '14322662', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HH', 0, '0000-00-00 00:00:00'),
(181, 0, 9, 9, 'KHUSUS', 'D1/K-11', 'RESIDENSIAL', '153.00', '122.00', '6700000', '4620000', '0.00', '0.00', '1076355000', '563640000', '1639995000', '1803994500', '5.00', '', '45099863', '2.500000000', '496098488', '27.500000000', '1262796149', '25154093', '14825358', '11527597', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HM', 0, '0000-00-00 00:00:00'),
(182, 0, 9, 10, 'SUDUT', 'D1/L-01', 'RESIDENSIAL', '222.00', '121.00', '6700000', '5280000', '0.00', '0.00', '1561770000', '638880000', '2200650000', '2420715000', '5.00', '', '60517875', '2.500000000', '665696625', '27.500000000', '1694500500', '33753368', '19893612', '15468466', '7.25', 'Marketable', '', '2013-07-04 08:11:18', 'HH', 0, '0000-00-00 00:00:00'),
(183, 0, 9, 10, 'SUDUT', 'D1/L-02', 'RESIDENSIAL', '149.00', '121.00', '6700000', '5280000', '0.00', '0.00', '998300000', '638880000', '1637180000', '1800898000', '0.00', '', '45022450', '2.500000000', '495246950', '27.500000000', '1260628600', '25110917', '14799911', '11507811', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(184, 0, 9, 10, 'KHUSUS', 'D1/L-03', 'RESIDENSIAL', '151.00', '110.00', '6700000', '4620000', '0.00', '0.00', '1011700000', '508200000', '1519900000', '1671890000', '0.00', '', '41797250', '2.500000000', '459769750', '27.500000000', '1170323000', '23312087', '13739714', '10683444', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(185, 0, 9, 10, 'KHUSUS', 'D1/L-05', 'RESIDENSIAL', '148.00', '110.00', '6700000', '4620000', '0.00', '0.00', '991600000', '508200000', '1499800000', '1649780000', '0.00', '', '41244500', '2.500000000', '453689500', '27.500000000', '1154846000', '23003795', '13558012', '10542160', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(186, 0, 9, 10, 'STANDAR', 'D1/L-06', 'RESIDENSIAL', '105.00', '110.00', '6700000', '4400000', '0.00', '0.00', '703500000', '484000000', '1187500000', '1306250000', '0.00', '', '32656250', '2.500000000', '359218750', '27.500000000', '914375000', '18213766', '10734858', '8346990', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(187, 0, 9, 10, 'KHUSUS', 'D1/L-07', 'RESIDENSIAL', '194.00', '110.00', '6700000', '4620000', '0.00', '0.00', '1299800000', '508200000', '1808000000', '1988800000', '0.00', '', '49720000', '2.500000000', '546920000', '27.500000000', '1392160000', '27730938', '16344103', '12708512', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(188, 0, 9, 10, 'STANDAR', 'D1/L-08', 'RESIDENSIAL', '105.00', '110.00', '6700000', '4400000', '0.00', '0.00', '703500000', '484000000', '1187500000', '1306250000', '0.00', '', '32656250', '2.500000000', '359218750', '27.500000000', '914375000', '18213766', '10734858', '8346990', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(189, 0, 9, 10, 'KHUSUS', 'D1/L-10', 'RESIDENSIAL', '128.00', '110.00', '6700000', '4620000', '0.00', '0.00', '857600000', '508200000', '1365800000', '1502380000', '0.00', '', '37559500', '2.500000000', '413154500', '27.500000000', '1051666000', '20948515', '12346668', '9600269', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(190, 0, 10, 12, 'SUDUT', 'D5/A-02', 'RESIDENSIAL', '132.00', '98.50', '6100000', '4400000', '0.00', '0.00', '805200000', '433400000', '1238600000', '1362460000', '0.00', '', '34061500', '2.500000000', '374676500', '27.500000000', '953722000', '18997533', '11196796', '8706174', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(191, 0, 10, 14, 'STANDAR', 'D5/A-12', 'KAVELING', '222.00', '0.00', '6100000', '0', '0.00', '0.00', '1354200000', '0', '1354200000', '1489620000', '0.00', '', '37240500', '2.500000000', '409645500', '27.500000000', '1042734000', '20770595', '12241806', '9518732', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(192, 0, 10, 12, 'SUDUT', 'D5/B-02', 'RESIDENSIAL', '144.00', '98.50', '6100000', '4400000', '0.00', '0.00', '922320000', '433400000', '1355720000', '1491292000', '5.00', '', '37282300', '2.500000000', '410105300', '27.500000000', '1043904400', '20793909', '12255546', '9529416', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(193, 0, 10, 15, 'SUDUT', 'D5/C-31', 'RESIDENSIAL', '144.00', '103.00', '6100000', '4400000', '0.00', '0.00', '878400000', '453200000', '1331600000', '1464760000', '0.00', '', '36619000', '2.500000000', '402809000', '27.500000000', '1025332000', '20423959', '12037504', '9359875', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(194, 0, 10, 15, 'SUDUT', 'D5/C-52', 'RESIDENSIAL', '144.00', '103.00', '6100000', '4400000', '0.00', '0.00', '878400000', '453200000', '1331600000', '1464760000', '0.00', '', '36619000', '2.500000000', '402809000', '27.500000000', '1025332000', '20423959', '12037504', '9359875', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(195, 0, 10, 15, 'SUDUT', 'D5/D-01', 'RESIDENSIAL', '144.00', '103.00', '6100000', '4400000', '0.00', '0.00', '944280000', '453200000', '1397480000', '1537228000', '7.50', '', '38430700', '2.500000000', '422737700', '27.500000000', '1076059600', '21434420', '12633052', '9822949', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(196, 0, 10, 15, 'SUDUT', 'D5/D-08', 'RESIDENSIAL', '132.00', '103.00', '6100000', '4400000', '0.00', '0.00', '805200000', '453200000', '1258400000', '1384240000', '0.00', '', '34606000', '2.500000000', '380666000', '27.500000000', '968968000', '19301224', '11375785', '8845349', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(197, 0, 10, 13, 'SUDUT', 'D5/E-02', 'RESIDENSIAL', '147.00', '76.00', '6100000', '4400000', '0.00', '0.00', '896700000', '334400000', '1231100000', '1354210000', '0.00', '', '33855250', '2.500000000', '372407750', '27.500000000', '947947000', '18882499', '11128996', '8653456', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(198, 0, 10, 12, 'SUDUT', 'D5/E-39', 'RESIDENSIAL', '148.00', '98.50', '6100000', '4400000', '0.00', '0.00', '902800000', '433400000', '1336200000', '1469820000', '0.00', '', '36745500', '2.500000000', '404200500', '27.500000000', '1028874000', '20494513', '12079088', '9392209', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(199, 0, 10, 13, 'SUDUT', 'D5/E-62', 'RESIDENSIAL', '140.00', '76.00', '6100000', '4400000', '0.00', '0.00', '854000000', '334400000', '1188400000', '1307240000', '0.00', '', '32681000', '2.500000000', '359491000', '27.500000000', '915068000', '18227570', '10742994', '8353316', '7.25', 'Marketable', 'Booked', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(200, 0, 10, 15, 'SUDUT', 'D5/F-01', 'RESIDENSIAL', '132.00', '103.00', '6100000', '4400000', '0.00', '0.00', '805200000', '453200000', '1258400000', '1384240000', '0.00', '', '34606000', '2.500000000', '380666000', '27.500000000', '968968000', '19301224', '11375785', '8845349', '7.25', 'Marketable', '', '2013-07-04 08:11:19', 'HM', 0, '0000-00-00 00:00:00'),
(201, 0, 10, 15, 'STANDAR', 'D5/F-12', 'RESIDENSIAL', '96.00', '95.00', '6100000', '4000000', '0.00', '0.00', '585600000', '380000000', '965600000', '1062160000', '0.00', '', '26554000', '2.500000000', '292094000', '27.500000000', '743512000', '14810284', '8728908', '6787245', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(202, 0, 10, 15, 'SUDUT', 'D5/F1-01', 'KAVELING', '132.00', '103.00', '6100000', '4400000', '0.00', '0.00', '805200000', '453200000', '1258400000', '1384240000', '0.00', '', '34606000', '2.500000000', '380666000', '27.500000000', '968968000', '19301224', '11375785', '8845349', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(203, 0, 10, 15, 'SUDUT', 'D5/F1-15', 'KAVELING', '144.00', '103.00', '6100000', '4400000', '0.00', '0.00', '878400000', '453200000', '1331600000', '1464760000', '0.00', '', '36619000', '2.500000000', '402809000', '27.500000000', '1025332000', '20423959', '12037504', '9359875', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(204, 0, 10, 15, 'SUDUT', 'D5/F1-02', 'KAVELING', '132.00', '103.00', '6100000', '4400000', '0.00', '0.00', '805200000', '453200000', '1258400000', '1384240000', '0.00', '', '34606000', '2.500000000', '380666000', '27.500000000', '968968000', '19301224', '11375785', '8845349', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(205, 0, 10, 15, 'STANDAR', 'D5/F1-06', 'KAVELING', '96.00', '95.00', '6100000', '4000000', '0.00', '0.00', '585600000', '380000000', '965600000', '1062160000', '0.00', '', '26554000', '2.500000000', '292094000', '27.500000000', '743512000', '14810284', '8728908', '6787245', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(206, 0, 10, 15, 'SUDUT', 'D5/F1-26', 'KAVELING', '144.00', '103.00', '6100000', '4400000', '0.00', '0.00', '878400000', '453200000', '1331600000', '1464760000', '0.00', '', '36619000', '2.500000000', '402809000', '27.500000000', '1025332000', '20423959', '12037504', '9359875', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(207, 0, 10, 15, 'KHUSUS', 'D5/F1-28', 'KAVELING', '140.00', '95.00', '6100000', '4200000', '0.00', '0.00', '854000000', '399000000', '1253000000', '1378300000', '0.00', '', '34457500', '2.500000000', '379032500', '27.500000000', '964810000', '19218399', '11326970', '8807392', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(208, 0, 10, 15, 'KHUSUS', 'D5/F1-30', 'KAVELING', '134.00', '95.00', '6100000', '4200000', '0.00', '0.00', '817400000', '399000000', '1216400000', '1338040000', '0.00', '', '33451000', '2.500000000', '367961000', '27.500000000', '936628000', '18657032', '10996110', '8550129', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(209, 0, 10, 12, 'SUDUT', 'D5/F2-08', 'RESIDENSIAL', '126.00', '98.50', '6100000', '4400000', '0.00', '0.00', '768600000', '433400000', '1202000000', '1322200000', '0.00', '', '33055000', '2.500000000', '363605000', '27.500000000', '925540000', '18436166', '10865936', '8448911', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(210, 0, 10, 12, 'SUDUT', 'D5/F3-01', 'RESIDENSIAL', '120.00', '98.50', '6100000', '4400000', '0.00', '0.00', '732000000', '433400000', '1165400000', '1281940000', '0.00', '', '32048500', '2.500000000', '352533500', '27.500000000', '897358000', '17874798', '10535076', '8191648', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(211, 0, 10, 12, 'STANDAR', 'D5/F3-07', 'RESIDENSIAL', '84.00', '86.00', '6100000', '4000000', '0.00', '0.00', '512400000', '344000000', '856400000', '942040000', '0.00', '', '23551000', '2.500000000', '259061000', '27.500000000', '659428000', '13135385', '7741753', '6019673', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(212, 0, 10, 12, 'STANDAR', 'D5/F3-21', 'RESIDENSIAL', '84.00', '86.00', '6100000', '4000000', '0.00', '0.00', '512400000', '344000000', '856400000', '942040000', '0.00', '', '23551000', '2.500000000', '259061000', '27.500000000', '659428000', '13135385', '7741753', '6019673', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(213, 0, 10, 13, 'SUDUT', 'D5/F5-01', 'RESIDENSIAL', '108.00', '76.00', '6100000', '4400000', '0.00', '0.00', '658800000', '334400000', '993200000', '1092520000', '0.00', '', '27313000', '2.500000000', '300443000', '27.500000000', '764764000', '15233610', '8978409', '6981247', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(214, 0, 10, 13, 'SUDUT', 'D5/F5-09', 'RESIDENSIAL', '108.00', '76.00', '6100000', '4400000', '0.00', '0.00', '658800000', '334400000', '993200000', '1092520000', '0.00', '', '27313000', '2.500000000', '300443000', '27.500000000', '764764000', '15233610', '8978409', '6981247', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(215, 0, 10, 13, 'SUDUT', 'D5/F5-28', 'RESIDENSIAL', '108.00', '76.00', '6100000', '4400000', '0.00', '0.00', '658800000', '334400000', '993200000', '1092520000', '0.00', '', '27313000', '2.500000000', '300443000', '27.500000000', '764764000', '15233610', '8978409', '6981247', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(216, 0, 10, 13, 'SUDUT', 'D5/F6-02', 'RESIDENSIAL', '108.00', '76.00', '6100000', '4400000', '0.00', '0.00', '658800000', '334400000', '993200000', '1092520000', '0.00', '', '27313000', '2.500000000', '300443000', '27.500000000', '764764000', '15233610', '8978409', '6981247', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(217, 0, 10, 13, 'SUDUT', 'D5/F6-12', 'RESIDENSIAL', '108.00', '76.00', '6100000', '4400000', '0.00', '0.00', '658800000', '334400000', '993200000', '1092520000', '0.00', '', '27313000', '2.500000000', '300443000', '27.500000000', '764764000', '15233610', '8978409', '6981247', '7.25', 'Marketable', '', '2013-07-04 08:11:20', 'HM', 0, '0000-00-00 00:00:00'),
(218, 0, 10, 12, 'STANDAR', 'D5/G-02', 'KAVELING', '120.00', '98.50', '6100000', '4400000', '0.00', '0.00', '732000000', '433400000', '1165400000', '1281940000', '0.00', '', '32048500', '2.500000000', '352533500', '27.500000000', '897358000', '17874798', '10535076', '8191648', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(219, 0, 10, 12, 'SUDUT', 'D5/G-37', 'RESIDENSIAL', '138.00', '98.50', '6100000', '4400000', '0.00', '0.00', '841800000', '433400000', '1275200000', '1402720000', '0.00', '', '35068000', '2.500000000', '385748000', '27.500000000', '981904000', '19558901', '11527655', '8963437', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(220, 0, 10, 12, 'SUDUT', 'D5/G-50', 'RESIDENSIAL', '120.00', '98.50', '6100000', '4400000', '0.00', '0.00', '732000000', '433400000', '1165400000', '1281940000', '0.00', '', '32048500', '2.500000000', '352533500', '27.500000000', '897358000', '17874798', '10535076', '8191648', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(221, 0, 10, 14, 'STANDAR', 'D5/H-01', 'KAVELING', '146.00', '0.00', '6100000', '0', '0.00', '0.00', '890600000', '0', '890600000', '979660000', '0.00', '', '24491500', '2.500000000', '269406500', '27.500000000', '685762000', '13659941', '8050917', '6260067', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(222, 0, 10, 12, 'STANDAR', 'D5/H-03', 'RESIDENSIAL', '84.00', '86.00', '6100000', '4000000', '0.00', '0.00', '512400000', '344000000', '856400000', '942040000', '0.00', '', '23551000', '2.500000000', '259061000', '27.500000000', '659428000', '13135385', '7741753', '6019673', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(223, 0, 10, 12, 'SUDUT', 'D5/H-26', 'RESIDENSIAL', '132.00', '98.50', '6100000', '4400000', '0.00', '0.00', '805200000', '433400000', '1238600000', '1362460000', '0.00', '', '34061500', '2.500000000', '374676500', '27.500000000', '953722000', '18997533', '11196796', '8706174', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(224, 0, 10, 12, 'SUDUT', 'D5/H-31', 'RESIDENSIAL', '128.00', '98.50', '6100000', '4400000', '0.00', '0.00', '780800000', '433400000', '1214200000', '1335620000', '0.00', '', '33390500', '2.500000000', '367295500', '27.500000000', '934934000', '18623288', '10976223', '8534665', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(225, 0, 10, 12, 'SUDUT', 'D5/I-01', 'RESIDENSIAL', '132.00', '98.50', '6100000', '4400000', '0.00', '0.00', '805200000', '433400000', '1238600000', '1362460000', '0.00', '', '34061500', '2.500000000', '374676500', '27.500000000', '953722000', '18997533', '11196796', '8706174', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(226, 0, 10, 15, 'SUDUT', 'D5/I-02', 'RESIDENSIAL', '185.00', '103.00', '6100000', '4400000', '0.00', '0.00', '1128500000', '453200000', '1581700000', '1739870000', '0.00', '', '43496750', '2.500000000', '478464250', '27.500000000', '1217909000', '24259969', '14298378', '11117839', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(227, 0, 10, 12, 'STANDAR', 'D5/I-03', 'RESIDENSIAL', '84.00', '86.00', '6100000', '4000000', '0.00', '0.00', '512400000', '344000000', '856400000', '942040000', '0.00', '', '23551000', '2.500000000', '259061000', '27.500000000', '659428000', '13135385', '7741753', '6019673', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(228, 0, 10, 12, 'STANDAR', 'D5/I-05', 'RESIDENSIAL', '84.00', '86.00', '6100000', '4000000', '0.00', '0.00', '512400000', '344000000', '856400000', '942040000', '0.00', '', '23551000', '2.500000000', '259061000', '27.500000000', '659428000', '13135385', '7741753', '6019673', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(229, 0, 10, 12, 'STANDAR', 'D5/I-07', 'RESIDENSIAL', '84.00', '86.00', '6100000', '4000000', '0.00', '0.00', '512400000', '344000000', '856400000', '942040000', '0.00', '', '23551000', '2.500000000', '259061000', '27.500000000', '659428000', '13135385', '7741753', '6019673', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(230, 0, 10, 15, 'KHUSUS', 'D5/I-08', 'RESIDENSIAL', '125.00', '103.00', '6100000', '4200000', '0.00', '0.00', '762500000', '432600000', '1195100000', '1314610000', '0.00', '', '32865250', '2.500000000', '361517750', '27.500000000', '920227000', '18330334', '10803561', '8400411', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(231, 0, 10, 15, 'KHUSUS', 'D5/I-10', 'RESIDENSIAL', '156.00', '103.00', '6100000', '4200000', '0.00', '0.00', '951600000', '432600000', '1384200000', '1522620000', '0.00', '', '38065500', '2.500000000', '418720500', '27.500000000', '1065834000', '21230733', '12513002', '9729603', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(232, 0, 10, 15, 'SUDUT', 'D5/I-20', 'RESIDENSIAL', '144.00', '103.00', '6100000', '4400000', '0.00', '0.00', '922320000', '453200000', '1375520000', '1513072000', '5.00', '', '37826800', '2.500000000', '416094800', '27.500000000', '1059150400', '21097600', '12434536', '9668591', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(233, 0, 10, 12, 'SUDUT', 'D5/I-21', 'RESIDENSIAL', '132.00', '98.50', '6100000', '4400000', '0.00', '0.00', '805200000', '433400000', '1238600000', '1362460000', '0.00', '', '34061500', '2.500000000', '374676500', '27.500000000', '953722000', '18997533', '11196796', '8706174', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(234, 0, 10, 12, 'SUDUT', 'D5/I-22', 'RESIDENSIAL', '126.00', '98.50', '6100000', '4400000', '0.00', '0.00', '807030000', '433400000', '1240430000', '1364473000', '5.00', '', '34111825', '2.500000000', '375230075', '27.500000000', '955131100', '19025602', '11213339', '8719037', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(235, 0, 10, 12, 'SUDUT', 'D5/I-32', 'RESIDENSIAL', '143.00', '98.50', '6100000', '4400000', '0.00', '0.00', '872300000', '433400000', '1305700000', '1436270000', '0.00', '', '35906750', '2.500000000', '394974250', '27.500000000', '1005389000', '20026707', '11803372', '9177823', '7.25', 'Marketable', '', '2013-07-04 08:11:21', 'HM', 0, '0000-00-00 00:00:00'),
(236, 0, 10, 12, 'SUDUT', 'D5/J-01', 'RESIDENSIAL', '126.00', '98.50', '6100000', '4400000', '0.00', '0.00', '768600000', '433400000', '1202000000', '1322200000', '0.00', '', '33055000', '2.500000000', '363605000', '27.500000000', '925540000', '18436166', '10865936', '8448911', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'HM', 0, '0000-00-00 00:00:00'),
(237, 0, 10, 13, 'SUDUT', 'D5/J-02', 'RESIDENSIAL', '148.00', '76.00', '6100000', '4400000', '0.00', '0.00', '902800000', '334400000', '1237200000', '1360920000', '0.00', '', '34023000', '2.500000000', '374253000', '27.500000000', '952644000', '18976060', '11184140', '8696333', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'HM', 0, '0000-00-00 00:00:00'),
(238, 0, 10, 15, 'SUDUT', 'D5/J-11', 'RESIDENSIAL', '151.00', '103.00', '6100000', '4400000', '0.00', '0.00', '921100000', '453200000', '1374300000', '1511730000', '0.00', '', '37793250', '2.500000000', '415725750', '27.500000000', '1058211000', '21078887', '12423507', '9660015', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'HM', 0, '0000-00-00 00:00:00'),
(239, 0, 10, 15, 'SUDUT', 'D5/J-19', 'RESIDENSIAL', '133.00', '103.00', '6100000', '4400000', '0.00', '0.00', '811300000', '453200000', '1264500000', '1390950000', '0.00', '', '34773750', '2.500000000', '382511250', '27.500000000', '973665000', '19394785', '11430928', '8888226', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'HM', 0, '0000-00-00 00:00:00'),
(240, 0, 10, 13, 'SUDUT', 'D5/K-01', 'RESIDENSIAL', '120.00', '76.00', '6100000', '4400000', '0.00', '0.00', '732000000', '334400000', '1066400000', '1173040000', '0.00', '', '29326000', '2.500000000', '322586000', '27.500000000', '821128000', '16356345', '9640128', '7495773', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'HM', 0, '0000-00-00 00:00:00'),
(241, 0, 10, 13, 'SUDUT', 'D5/K-19', 'RESIDENSIAL', '125.00', '76.00', '6100000', '4400000', '0.00', '0.00', '762500000', '334400000', '1096900000', '1206590000', '0.00', '', '30164750', '2.500000000', '331812250', '27.500000000', '844613000', '16824152', '9915845', '7710159', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'HM', 0, '0000-00-00 00:00:00'),
(242, 0, 10, 13, 'SUDUT', 'D5/L-01', 'RESIDENSIAL', '108.00', '76.00', '6100000', '4400000', '0.00', '0.00', '658800000', '334400000', '993200000', '1092520000', '0.00', '', '27313000', '2.500000000', '300443000', '27.500000000', '764764000', '15233610', '8978409', '6981247', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'HM', 0, '0000-00-00 00:00:00'),
(243, 0, 10, 13, 'KHUSUS', 'D5/L-02', 'RESIDENSIAL', '87.00', '69.00', '6100000', '4200000', '0.00', '0.00', '530700000', '289800000', '820500000', '902550000', '0.00', '', '22563750', '2.500000000', '248201250', '27.500000000', '631785000', '12584754', '7417222', '5767331', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'HM', 0, '0000-00-00 00:00:00'),
(244, 0, 10, 13, 'STANDAR', 'D5/L-03', 'RESIDENSIAL', '72.00', '69.00', '6100000', '4000000', '0.00', '0.00', '439200000', '276000000', '715200000', '786720000', '0.00', '', '19668000', '2.500000000', '216348000', '27.500000000', '550704000', '10969672', '6465322', '5027172', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'MH', 0, '0000-00-00 00:00:00'),
(245, 0, 10, 13, 'SUDUT', 'D5/L-05', 'RESIDENSIAL', '108.00', '76.00', '6100000', '4400000', '0.00', '0.00', '658800000', '334400000', '993200000', '1092520000', '0.00', '', '27313000', '2.500000000', '300443000', '27.500000000', '764764000', '15233610', '8978409', '6981247', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'HM', 0, '0000-00-00 00:00:00'),
(246, 0, 10, 13, 'STANDAR', 'D5/L-06', 'RESIDENSIAL', '72.00', '69.00', '6100000', '4000000', '0.00', '0.00', '439200000', '276000000', '715200000', '786720000', '0.00', '', '19668000', '2.500000000', '216348000', '27.500000000', '550704000', '10969672', '6465322', '5027172', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'MH', 0, '0000-00-00 00:00:00'),
(247, 0, 10, 13, 'SUDUT', 'D5/L-08', 'RESIDENSIAL', '108.00', '76.00', '6100000', '4400000', '0.00', '0.00', '658800000', '334400000', '993200000', '1092520000', '0.00', '', '27313000', '2.500000000', '300443000', '27.500000000', '764764000', '15233610', '8978409', '6981247', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'HM', 0, '0000-00-00 00:00:00'),
(248, 0, 10, 13, 'KHUSUS', 'D5/L-10', 'RESIDENSIAL', '108.00', '69.00', '6100000', '4200000', '0.00', '0.00', '658800000', '289800000', '948600000', '1043460000', '0.00', '', '26086500', '2.500000000', '286951500', '27.500000000', '730422000', '14549540', '8575230', '6667751', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'HM', 0, '0000-00-00 00:00:00'),
(249, 0, 10, 13, 'KHUSUS', 'D5/L-12', 'RESIDENSIAL', '91.00', '69.00', '6100000', '4200000', '0.00', '0.00', '555100000', '289800000', '844900000', '929390000', '0.00', '', '23234750', '2.500000000', '255582250', '27.500000000', '650573000', '12958999', '7637795', '5938839', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'HM', 0, '0000-00-00 00:00:00'),
(250, 0, 10, 13, 'KHUSUS', 'D5/L-16', 'RESIDENSIAL', '148.00', '69.00', '6100000', '4200000', '0.00', '0.00', '902800000', '289800000', '1192600000', '1311860000', '0.00', '', '32796500', '2.500000000', '360761500', '27.500000000', '918302000', '18291989', '10780961', '8382838', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'HM', 0, '0000-00-00 00:00:00'),
(251, 0, 10, 14, 'STANDAR', 'D5/L-18', 'KAVELING', '168.00', '0.00', '6100000', '0', '0.00', '0.00', '1024800000', '0', '1024800000', '1127280000', '0.00', '', '28182000', '2.500000000', '310002000', '27.500000000', '789096000', '15718288', '9264069', '7203364', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'HM', 0, '0000-00-00 00:00:00'),
(252, 0, 10, 14, 'STANDAR', 'D5/M-02', 'KAVELING', '109.00', '0.00', '6100000', '0', '0.00', '0.00', '664900000', '0', '664900000', '731390000', '0.00', '', '18284750', '2.500000000', '201132250', '27.500000000', '511973000', '10198175', '6010616', '4673611', '7.25', 'Marketable', '', '2013-07-04 08:11:22', 'MH', 0, '0000-00-00 00:00:00'),
(253, 0, 10, 13, 'KHUSUS', 'D5/M-06', 'RESIDENSIAL', '93.00', '69.00', '6100000', '4200000', '0.00', '0.00', '567300000', '289800000', '857100000', '942810000', '0.00', '', '23570250', '2.500000000', '259272750', '27.500000000', '659967000', '13146121', '7748081', '6024594', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(254, 0, 10, 13, 'KHUSUS', 'D5/M-08', 'RESIDENSIAL', '104.00', '69.00', '6100000', '4200000', '0.00', '0.00', '634400000', '289800000', '924200000', '1016620000', '0.00', '', '25415500', '2.500000000', '279570500', '27.500000000', '711634000', '14175295', '8354657', '6496243', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(255, 0, 10, 13, 'KHUSUS', 'D5/M-10', 'RESIDENSIAL', '116.00', '69.00', '6100000', '4200000', '0.00', '0.00', '707600000', '289800000', '997400000', '1097140000', '0.00', '', '27428500', '2.500000000', '301713500', '27.500000000', '767998000', '15298030', '9016376', '7010769', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(256, 0, 10, 13, 'KHUSUS', 'D5/M-12', 'RESIDENSIAL', '127.00', '69.00', '6100000', '4200000', '0.00', '0.00', '774700000', '289800000', '1064500000', '1170950000', '0.00', '', '29273750', '2.500000000', '322011250', '27.500000000', '819665000', '16327203', '9622952', '7482418', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(257, 0, 11, 18, 'SUDUT', 'D2/B-26', 'RESIDENSIAL', '150.00', '72.00', '6100000', '4400000', '0.00', '0.00', '960750000', '316800000', '1277550000', '1405305000', '5.00', '', '35132625', '2.500000000', '386458875', '27.500000000', '983713500', '19594945', '11548899', '8979955', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(258, 0, 11, 19, 'SUDUT', 'D2/D-01', 'RESIDENSIAL', '135.00', '45.00', '6100000', '4400000', '0.00', '0.00', '823500000', '198000000', '1021500000', '1123650000', '0.00', '', '28091250', '2.500000000', '309003750', '27.500000000', '786555000', '15667673', '9234238', '7180169', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(259, 0, 11, 16, 'STANDAR', 'D2/E-01', 'KAVELING', '250.00', '0.00', '6100000', '0', '0.00', '0.00', '1525000000', '0', '1525000000', '1677500000', '0.00', '', '41937500', '2.500000000', '461312500', '27.500000000', '1174250000', '23390310', '13785817', '10719292', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(260, 0, 11, 16, 'STANDAR', 'D2/E-02', 'KAVELING', '157.00', '0.00', '6100000', '0', '0.00', '0.00', '957700000', '0', '957700000', '1053470000', '0.00', '', '26336750', '2.500000000', '289704250', '27.500000000', '737429000', '14689115', '8657493', '6731716', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(261, 0, 11, 17, 'SUDUT', 'D2/E-21', 'RESIDENSIAL', '148.00', '56.00', '6100000', '4400000', '0.00', '0.00', '902800000', '246400000', '1149200000', '1264120000', '0.00', '', '31603000', '2.500000000', '347633000', '27.500000000', '884884000', '17626324', '10388630', '8077778', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(262, 0, 11, 17, 'SUDUT', 'D2/E-51', 'RESIDENSIAL', '151.00', '56.00', '6100000', '4400000', '0.00', '0.00', '921100000', '246400000', '1167500000', '1284250000', '0.00', '', '32106250', '2.500000000', '353168750', '27.500000000', '898975000', '17907008', '10554060', '8206409', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(263, 0, 11, 18, 'SUDUT', 'D2/F-02', 'RESIDENSIAL', '148.00', '72.00', '6100000', '4400000', '0.00', '0.00', '902800000', '316800000', '1219600000', '1341560000', '0.00', '', '33539000', '2.500000000', '368929000', '27.500000000', '939092000', '18706113', '11025038', '8572622', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(264, 0, 11, 18, 'SUDUT', 'D2/F-23', 'RESIDENSIAL', '196.00', '72.00', '6100000', '4400000', '0.00', '0.00', '1195600000', '316800000', '1512400000', '1663640000', '0.00', '', '41591000', '2.500000000', '457501000', '27.500000000', '1164548000', '23197052', '13671915', '10630726', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(265, 0, 11, 18, 'SUDUT', 'D2/F-26', 'RESIDENSIAL', '150.00', '72.00', '6100000', '4400000', '0.00', '0.00', '915000000', '316800000', '1231800000', '1354980000', '0.00', '', '33874500', '2.500000000', '372619500', '27.500000000', '948486000', '18893235', '11135324', '8658377', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(266, 0, 11, 18, 'SUDUT', 'D2/G-02', 'RESIDENSIAL', '158.00', '72.00', '6100000', '4400000', '0.00', '0.00', '1011990000', '316800000', '1328790000', '1461669000', '5.00', '', '36541725', '2.500000000', '401958975', '27.500000000', '1023168300', '20380859', '12012102', '9340124', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(267, 0, 11, 18, 'SUDUT', 'D2/G-29', 'RESIDENSIAL', '150.00', '72.00', '6100000', '4400000', '0.00', '0.00', '915000000', '316800000', '1231800000', '1354980000', '0.00', '', '33874500', '2.500000000', '372619500', '27.500000000', '948486000', '18893235', '11135324', '8658377', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(268, 0, 11, 18, 'SUDUT', 'D2/G-30', 'RESIDENSIAL', '150.00', '72.00', '6100000', '4400000', '0.00', '0.00', '915000000', '316800000', '1231800000', '1354980000', '0.00', '', '33874500', '2.500000000', '372619500', '27.500000000', '948486000', '18893235', '11135324', '8658377', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(269, 0, 11, 17, 'SUDUT', 'D2/H-01', 'RESIDENSIAL', '135.00', '56.00', '6100000', '4400000', '0.00', '0.00', '885262500', '246400000', '1131662500', '1244828750', '7.50', '', '31120719', '2.500000000', '342327906', '27.500000000', '871380125', '17357336', '10230093', '7954506', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(270, 0, 11, 18, 'SUDUT', 'D2/H-02', 'RESIDENSIAL', '150.00', '72.00', '6100000', '4400000', '0.00', '0.00', '983625000', '316800000', '1300425000', '1430467500', '7.50', '', '35761688', '2.500000000', '393378563', '27.500000000', '1001327249', '19945799', '11755686', '9140745', '7.25', 'Marketable', '', '2013-07-04 08:11:23', 'HM', 0, '0000-00-00 00:00:00'),
(271, 0, 11, 18, 'SUDUT', 'D2/H-36', 'RESIDENSIAL', '150.00', '72.00', '6100000', '4400000', '0.00', '0.00', '915000000', '316800000', '1231800000', '1354980000', '0.00', '', '33874500', '2.500000000', '372619500', '27.500000000', '948486000', '18893235', '11135324', '8658377', '7.25', 'Marketable', '', '2013-07-04 08:11:24', 'HM', 0, '0000-00-00 00:00:00'),
(272, 0, 11, 17, 'SUDUT', 'D2/H-65', 'RESIDENSIAL', '170.00', '56.00', '6100000', '4400000', '0.00', '0.00', '1037000000', '246400000', '1283400000', '1411740000', '0.00', '', '35293500', '2.500000000', '388228500', '27.500000000', '988218000', '19684671', '11601782', '9021075', '7.25', 'Marketable', '', '2013-07-04 08:11:24', 'HM', 0, '0000-00-00 00:00:00'),
(273, 0, 11, 19, 'KHUSUS', 'D2/I-52', 'RESIDENSIAL', '167.00', '42.00', '6100000', '4200000', '0.00', '0.00', '1018700000', '176400000', '1195100000', '1314610000', '0.00', '', '32865250', '2.500000000', '361517750', '27.500000000', '920227000', '18330334', '10803561', '8400411', '7.25', 'Marketable', '', '2013-07-04 08:11:24', 'HM', 0, '0000-00-00 00:00:00'),
(274, 0, 11, 19, 'KHUSUS', 'D2/I-56', 'RESIDENSIAL', '148.00', '42.00', '6100000', '4200000', '0.00', '0.00', '902800000', '176400000', '1079200000', '1187120000', '0.00', '', '29678000', '2.500000000', '326458000', '27.500000000', '830984000', '16552671', '9755839', '7585744', '7.25', 'Marketable', '', '2013-07-04 08:11:24', 'HM', 0, '0000-00-00 00:00:00');
INSERT INTO `tbl_unit` (`id_unit`, `id_promo`, `id_cluster`, `id_type`, `posisi`, `kode_unit`, `kategori`, `luas_tanah`, `luas_bangunan`, `harga_tanah_m2`, `harga_bangunan_m2`, `diskon_tanah`, `diskon_bangunan`, `harga_tanah`, `harga_bangunan`, `harga_jual_exc_ppn`, `harga_jual_inc_ppn`, `fs`, `keterangan_fs`, `tanda_jadi`, `persen_tanda_jadi`, `uang_muka`, `persen_uang_muka`, `plafon_kpr`, `kpr_5_tahun`, `kpr_10_tahun`, `kpr_15_tahun`, `suku_bunga`, `status_unit`, `status_transaksi`, `tanggal_posting`, `kelas_produk`, `locked`, `tanggal_locked`) VALUES
(275, 0, 11, 19, 'SUDUT', 'D2/I-76', 'RESIDENSIAL', '135.00', '45.00', '6100000', '4400000', '0.00', '0.00', '823500000', '198000000', '1021500000', '1123650000', '0.00', '', '28091250', '2.500000000', '309003750', '27.500000000', '786555000', '15667673', '9234238', '7180169', '7.25', 'Marketable', '', '2013-07-04 08:11:24', 'HM', 0, '0000-00-00 00:00:00'),
(276, 0, 17, 28, 'STANDAR', 'MELIA/GMJ-01', 'KAVELING', '165.00', '0.00', '7300000', '0', '0.00', '0.00', '1204500000', '0', '1204500000', '1324950000', '0.00', '', '33123750', '2.500000000', '364361250', '27.500000000', '927465000', '18474510', '10888536', '8466484', '7.25', 'Marketable', 'Booked', '2013-07-04 08:11:24', 'HM', 0, '0000-00-00 00:00:00'),
(277, 0, 16, 27, 'STANDAR', 'MELIA/MGG-20', 'KAVELING', '199.00', '0.00', '7300000', '0', '0.00', '0.00', '1452700000', '0', '1452700000', '1597970000', '0.00', '', '39949250', '2.500000000', '439441750', '27.500000000', '1118579000', '22281379', '13132234', '10211092', '7.25', 'Marketable', '', '2013-07-04 08:11:24', 'HM', 0, '0000-00-00 00:00:00'),
(278, 0, 16, 27, 'STANDAR', 'MELIA/MGG-22', 'KAVELING', '169.00', '0.00', '7300000', '0', '0.00', '0.00', '1233700000', '0', '1233700000', '1357070000', '0.00', '', '33926750', '2.500000000', '373194250', '27.500000000', '949949000', '18922377', '11152500', '8671732', '7.25', 'Marketable', '', '2013-07-04 08:11:24', 'HM', 0, '0000-00-00 00:00:00'),
(279, 0, 16, 27, 'STANDAR', 'MELIA/MGG-28', 'KAVELING', '308.00', '0.00', '7300000', '0', '0.00', '0.00', '2248400000', '0', '2248400000', '2473240000', '0.00', '', '61831000', '2.500000000', '680141000', '27.500000000', '1731268000', '34485753', '20325267', '15804103', '7.25', 'Marketable', '', '2013-07-04 08:11:24', 'HH', 0, '0000-00-00 00:00:00'),
(280, 0, 16, 27, 'STANDAR', 'MELIA/MGH-19', 'KAVELING', '220.00', '0.00', '7300000', '0', '0.00', '0.00', '1606000000', '0', '1606000000', '1766600000', '0.00', '', '44165000', '2.500000000', '485815000', '27.500000000', '1236620000', '24632681', '14518048', '11288645', '7.25', 'Marketable', '', '2013-07-04 08:11:24', 'HM', 0, '0000-00-00 00:00:00'),
(281, 0, 16, 27, 'STANDAR', 'MELIA/MGH-21', 'KAVELING', '237.00', '0.00', '7300000', '0', '0.00', '0.00', '1730100000', '0', '1730100000', '1903110000', '0.00', '', '47577750', '2.500000000', '523355250', '27.500000000', '1332177000', '26536115', '15639897', '12160949', '7.25', 'Marketable', '', '2013-07-04 08:11:24', 'HM', 0, '0000-00-00 00:00:00'),
(282, 0, 16, 27, 'STANDAR', 'MELIA/MGH-23', 'KAVELING', '426.00', '0.00', '7300000', '0', '0.00', '0.00', '3109800000', '0', '3109800000', '3420780000', '0.00', '', '85519500', '2.500000000', '940714500', '27.500000000', '2394546000', '47697827', '28112219', '21858922', '7.25', 'Marketable', '', '2013-07-04 08:11:24', 'HH', 0, '0000-00-00 00:00:00'),
(283, 0, 16, 27, 'STANDAR', 'MELIA/MGH-25', 'KAVELING', '243.00', '0.00', '7300000', '0', '0.00', '0.00', '1773900000', '0', '1773900000', '1951290000', '0.00', '', '48782250', '2.500000000', '536604750', '27.500000000', '1365903000', '27207915', '16035843', '12468821', '7.25', 'Marketable', '', '2013-07-04 08:11:24', 'HM', 0, '0000-00-00 00:00:00'),
(284, 0, 16, 27, 'STANDAR', 'MELIA/MGH-27', 'KAVELING', '247.00', '0.00', '7300000', '0', '0.00', '0.00', '1803100000', '0', '1803100000', '1983410000', '0.00', '', '49585250', '2.500000000', '545437750', '27.500000000', '1388387000', '27655782', '16299808', '12674070', '7.25', 'Marketable', '', '2013-07-04 08:11:24', 'HM', 0, '0000-00-00 00:00:00'),
(285, 0, 16, 27, 'STANDAR', 'MELIA/MGH-29', 'KAVELING', '250.00', '0.00', '7300000', '0', '0.00', '0.00', '1825000000', '0', '1825000000', '2007500000', '0.00', '', '50187500', '2.500000000', '552062500', '27.500000000', '1405250000', '27991683', '16497781', '12828006', '7.25', 'Marketable', '', '2013-07-04 08:11:24', 'HM', 0, '0000-00-00 00:00:00'),
(286, 0, 16, 27, 'STANDAR', 'MELIA/MGH-31', 'KAVELING', '267.00', '0.00', '7300000', '0', '0.00', '0.00', '1949100000', '0', '1949100000', '2144010000', '0.00', '', '53600250', '2.500000000', '589602750', '27.500000000', '1500807000', '29895117', '17619630', '13700310', '7.25', 'Marketable', '', '2013-07-04 08:11:24', 'HM', 0, '0000-00-00 00:00:00'),
(287, 0, 16, 27, 'STANDAR', 'MELIA/MGI-01', 'KAVELING', '188.00', '0.00', '7300000', '0', '0.00', '0.00', '1406710000', '0', '1406710000', '1547381000', '2.50', '', '38684525', '2.500000000', '425529775', '27.500000000', '1083166700', '21575989', '12716490', '9887827', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(288, 0, 16, 27, 'STANDAR', 'MELIA/MGI-02', 'KAVELING', '362.00', '0.00', '7300000', '0', '0.00', '0.00', '2708665000', '0', '2708665000', '2979531500', '2.50', '', '74488288', '2.500000000', '819371163', '27.500000000', '2085672049', '41545255', '24486007', '19039326', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HH', 0, '0000-00-00 00:00:00'),
(289, 0, 16, 27, 'STANDAR', 'MELIA/MGI-06', 'KAVELING', '186.00', '0.00', '7300000', '0', '0.00', '0.00', '1391745000', '0', '1391745000', '1530919500', '2.50', '', '38272987', '2.500000000', '421002862', '27.500000000', '1071643651', '21346457', '12581208', '9782637', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(290, 0, 16, 27, 'STANDAR', 'MELIA/MGI-08', 'KAVELING', '259.00', '0.00', '7300000', '0', '0.00', '0.00', '1937967500', '0', '1937967500', '2131764250', '2.50', '', '53294106', '2.500000000', '586235169', '27.500000000', '1492234975', '29724368', '17518994', '13622059', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(291, 0, 16, 27, 'STANDAR', 'MELIA/MGI-09', 'KAVELING', '214.00', '0.00', '7300000', '0', '0.00', '0.00', '1601255000', '0', '1601255000', '1761380500', '2.50', '', '44034512', '2.500000000', '484379637', '27.500000000', '1232966351', '24559902', '14475153', '11255292', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(292, 0, 16, 27, 'STANDAR', 'MELIA/MGJ-01', 'KAVELING', '254.00', '0.00', '7300000', '0', '0.00', '0.00', '1900555000', '0', '1900555000', '2090610500', '2.50', '', '52265262', '2.500000000', '574917887', '27.500000000', '1463427351', '29150538', '17180789', '13359085', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(293, 0, 16, 27, 'STANDAR', 'MELIA/MGJ-03', 'KAVELING', '179.00', '0.00', '7300000', '0', '0.00', '0.00', '1306700000', '0', '1306700000', '1437370000', '0.00', '', '35934250', '2.500000000', '395276750', '27.500000000', '1006159000', '20042045', '11812411', '9184852', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(294, 0, 16, 27, 'STANDAR', 'MELIA/MGJ-05', 'KAVELING', '315.00', '0.00', '7300000', '0', '0.00', '0.00', '2299500000', '0', '2299500000', '2529450000', '0.00', '', '63236250', '2.500000000', '695598750', '27.500000000', '1770615000', '35269520', '20787204', '16163287', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HH', 1, '2015-03-27 20:39:57'),
(295, 0, 16, 27, 'STANDAR', 'MELIA/MGJ-12', 'KAVELING', '201.00', '0.00', '7300000', '0', '0.00', '0.00', '1467300000', '0', '1467300000', '1614030000', '0.00', '', '40350750', '2.500000000', '443858250', '27.500000000', '1129821000', '22505313', '13264216', '10313717', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(296, 0, 15, 24, 'KHUSUS', 'GRACIA/G-09', 'RESIDENSIAL', '117.00', '60.00', '5600000', '3885000', '0.00', '0.00', '655200000', '233100000', '888300000', '977130000', '0.00', '', '24428250', '2.500000000', '268710750', '27.500000000', '683991000', '13624664', '8030126', '6243900', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(297, 0, 15, 24, 'KHUSUS', 'GRACIA/G-11', 'RESIDENSIAL', '112.00', '60.00', '5600000', '3885000', '0.00', '0.00', '627200000', '233100000', '860300000', '946330000', '0.00', '', '23658250', '2.500000000', '260240750', '27.500000000', '662431000', '13195202', '7777009', '6047087', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(298, 0, 15, 24, 'KHUSUS', 'GRACIA/G-15', 'RESIDENSIAL', '112.00', '60.00', '5600000', '3885000', '0.00', '0.00', '627200000', '233100000', '860300000', '946330000', '0.00', '', '23658250', '2.500000000', '260240750', '27.500000000', '662431000', '13195202', '7777009', '6047087', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(299, 0, 15, 24, 'KHUSUS', 'GRACIA/G-17', 'RESIDENSIAL', '120.00', '60.00', '5600000', '3885000', '0.00', '0.00', '705600000', '233100000', '938700000', '1032570000', '5.00', '', '25814250', '2.500000000', '283956750', '27.500000000', '722799000', '14397694', '8485736', '6598164', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(300, 0, 15, 24, 'SUDUT', 'GRACIA/G-19', 'RESIDENSIAL', '251.00', '67.00', '5600000', '4070000', '0.00', '0.00', '1475880000', '272690000', '1748570000', '1923427000', '5.00', '', '48085675', '2.500000000', '528942425', '27.500000000', '1346398900', '26819406', '15806863', '12290776', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(301, 0, 15, 24, 'KHUSUS', 'GRACIA/H-17', 'RESIDENSIAL', '147.00', '60.00', '5600000', '3885000', '0.00', '0.00', '823200000', '233100000', '1056300000', '1161930000', '0.00', '', '29048250', '2.500000000', '319530750', '27.500000000', '813351000', '16201432', '9548825', '7424779', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(302, 0, 15, 24, 'KHUSUS', 'GRACIA/H-20', 'RESIDENSIAL', '154.00', '60.00', '5600000', '3885000', '0.00', '0.00', '862400000', '233100000', '1095500000', '1205050000', '0.00', '', '30126250', '2.500000000', '331388750', '27.500000000', '843535000', '16802678', '9903189', '7700318', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(303, 0, 15, 25, 'KHUSUS', 'GRACIA/I-15', 'RESIDENSIAL', '157.00', '42.00', '5600000', '3885000', '0.00', '0.00', '879200000', '163170000', '1042370000', '1146607000', '0.00', '', '28665175', '2.500000000', '315316925', '27.500000000', '802624900', '15987775', '9422900', '7326865', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(304, 0, 15, 25, 'KHUSUS', 'GRACIA/I-22', 'RESIDENSIAL', '112.00', '42.00', '5600000', '3885000', '0.00', '0.00', '627200000', '163170000', '790370000', '869407000', '0.00', '', '21735175', '2.500000000', '239086925', '27.500000000', '608584900', '12122623', '7144850', '5555546', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(305, 0, 15, 25, 'KHUSUS', 'GRACIA/J-11', 'RESIDENSIAL', '136.00', '42.00', '5600000', '3885000', '0.00', '0.00', '761600000', '163170000', '924770000', '1017247000', '0.00', '', '25431175', '2.500000000', '279742925', '27.500000000', '712072900', '14184037', '8359810', '6500249', '7.25', 'Marketable', '', '2013-07-04 08:11:25', 'HM', 0, '0000-00-00 00:00:00'),
(306, 0, 15, 25, 'KHUSUS', 'GRACIA/J-18', 'RESIDENSIAL', '144.00', '42.00', '5600000', '3885000', '0.00', '0.00', '806400000', '163170000', '969570000', '1066527000', '0.00', '', '26663175', '2.500000000', '293294925', '27.500000000', '746568900', '14871176', '8764797', '6815150', '7.25', 'Marketable', '', '2013-07-04 08:11:26', 'HM', 0, '0000-00-00 00:00:00'),
(307, 0, 15, 25, 'KHUSUS', 'GRACIA/K-20', 'RESIDENSIAL', '97.00', '42.00', '5600000', '3885000', '0.00', '0.00', '543200000', '163170000', '706370000', '777007000', '0.00', '', '19425175', '2.500000000', '213676925', '27.500000000', '543904900', '10834238', '6385500', '4965106', '7.25', 'Marketable', '', '2013-07-04 08:11:26', 'MH', 0, '0000-00-00 00:00:00'),
(308, 0, 15, 25, 'KHUSUS', 'GRACIA/K-22', 'RESIDENSIAL', '98.00', '42.00', '5600000', '3885000', '0.00', '0.00', '548800000', '163170000', '711970000', '783167000', '0.00', '', '19579175', '2.500000000', '215370925', '27.500000000', '548216900', '10920131', '6436123', '5004469', '7.25', 'Marketable', '', '2013-07-04 08:11:26', 'MH', 0, '0000-00-00 00:00:00'),
(309, 0, 15, 25, 'KHUSUS', 'GRACIA/K-26', 'RESIDENSIAL', '98.00', '42.00', '5600000', '3885000', '0.00', '0.00', '548800000', '163170000', '711970000', '783167000', '0.00', '', '19579175', '2.500000000', '215370925', '27.500000000', '548216900', '10920131', '6436123', '5004469', '7.25', 'Marketable', '', '2013-07-04 08:11:26', 'MH', 0, '0000-00-00 00:00:00'),
(310, 0, 15, 25, 'SUDUT', 'GRACIA/K-28', 'RESIDENSIAL', '146.00', '48.00', '5600000', '4070000', '0.00', '0.00', '817600000', '195360000', '1012960000', '1114256000', '0.00', '', '27856400', '2.500000000', '306420400', '27.500000000', '779979200', '15536688', '9157037', '7120141', '7.25', 'Marketable', '', '2013-07-04 08:11:26', 'HM', 0, '0000-00-00 00:00:00'),
(311, 0, 15, 26, 'STANDAR', 'GRACIA/O-15', 'KAVELING', '193.00', '0.00', '5600000', '0', '0.00', '0.00', '1080800000', '0', '1080800000', '1188880000', '0.00', '', '29722000', '2.500000000', '326942000', '27.500000000', '832216000', '16577211', '9770302', '7596991', '7.25', 'Marketable', '', '2013-07-04 08:11:26', 'HM', 0, '0000-00-00 00:00:00'),
(312, 0, 15, 26, 'STANDAR', 'GRACIA/P-02', 'KAVELING', '154.00', '0.00', '5600000', '0', '0.00', '0.00', '862400000', '0', '862400000', '948640000', '0.00', '', '23716000', '2.500000000', '260876000', '27.500000000', '664048000', '13227412', '7795993', '6061848', '7.25', 'Marketable', '', '2013-07-04 08:11:26', 'HM', 0, '0000-00-00 00:00:00'),
(313, 0, 13, 22, 'STANDAR', 'GB/GR29-109', 'KAVELING', '310.00', '0.00', '5600000', '0', '0.00', '0.00', '1736000000', '0', '1736000000', '1909600000', '0.00', '', '47740000', '2.500000000', '525140000', '27.500000000', '1336720000', '26626609', '15693232', '12202421', '7.25', 'Marketable', '', '2013-07-04 08:11:26', 'HM', 0, '0000-00-00 00:00:00'),
(314, 0, 13, 21, 'KHUSUS', 'GB/GR29-110', 'RESIDENSIAL', '136.00', '60.00', '5600000', '4095000', '0.00', '0.00', '761600000', '245700000', '1007300000', '1108030000', '0.00', '', '27700750', '2.500000000', '304708250', '27.500000000', '775621000', '15449875', '9105871', '7080356', '7.25', 'Marketable', '', '2013-07-04 08:11:26', 'HM', 0, '0000-00-00 00:00:00'),
(315, 0, 13, 21, 'KHUSUS', 'GB/GR29-111', 'RESIDENSIAL', '134.00', '60.00', '5600000', '4095000', '0.00', '0.00', '750400000', '245700000', '996100000', '1095710000', '0.00', '', '27392750', '2.500000000', '301320250', '27.500000000', '766997000', '15278090', '9004625', '7001631', '7.25', 'Marketable', '', '2013-07-04 08:11:26', 'HM', 0, '0000-00-00 00:00:00'),
(316, 0, 13, 21, 'KHUSUS', 'GB/GR29-112', 'RESIDENSIAL', '180.00', '60.00', '5600000', '4095000', '0.00', '0.00', '1008000000', '245700000', '1253700000', '1379070000', '0.00', '', '34476750', '2.500000000', '379244250', '27.500000000', '965349000', '19229136', '11333298', '8812313', '7.25', 'Marketable', '', '2013-07-04 08:11:26', 'HM', 0, '0000-00-00 00:00:00'),
(317, 0, 14, 23, 'STANDAR', 'GB/GR30-33', 'KAVELING', '185.00', '0.00', '5600000', '0', '0.00', '0.00', '1036000000', '0', '1036000000', '1139600000', '0.00', '', '28490000', '2.500000000', '313390000', '27.500000000', '797720000', '15890073', '9365316', '7282090', '7.25', 'Marketable', '', '2013-07-04 08:11:26', 'HM', 0, '0000-00-00 00:00:00'),
(318, 0, 14, 23, 'STANDAR', 'GB/GR30-33A', 'KAVELING', '139.00', '0.00', '5600000', '0', '0.00', '0.00', '778400000', '0', '778400000', '856240000', '0.00', '', '21406000', '2.500000000', '235466000', '27.500000000', '599368000', '11939028', '7036643', '5471408', '7.25', 'Marketable', '', '2013-07-04 08:11:26', 'HM', 0, '0000-00-00 00:00:00'),
(319, 0, 24, 37, 'STANDAR', 'VERINA/A-61', 'KAVELING', '422.00', '0.00', '5600000', '0', '0.00', '0.00', '2363200000', '0', '2363200000', '2599520000', '0.00', '', '64988000', '2.500000000', '714868000', '27.500000000', '1819664000', '36246545', '21363045', '16611037', '7.25', 'Marketable', '', '2013-07-04 08:11:26', 'HH', 0, '0000-00-00 00:00:00'),
(320, 0, 24, 37, 'STANDAR', 'VERINA/E-09', 'KAVELING', '255.00', '0.00', '5600000', '0', '0.00', '0.00', '1428000000', '0', '1428000000', '1570800000', '0.00', '', '39270000', '2.500000000', '431970000', '27.500000000', '1099560000', '21902533', '12908949', '10037475', '7.25', 'Marketable', '', '2013-07-04 08:11:26', 'HM', 0, '0000-00-00 00:00:00'),
(321, 0, 24, 37, 'STANDAR', 'VERINA/E-10', 'KAVELING', '328.00', '0.00', '5600000', '0', '0.00', '0.00', '1836800000', '0', '1836800000', '2020480000', '0.00', '', '50512000', '2.500000000', '555632000', '27.500000000', '1414336000', '28172670', '16604452', '12910948', '7.25', 'Marketable', '', '2013-07-04 08:11:26', 'HM', 0, '0000-00-00 00:00:00'),
(322, 0, 24, 37, 'STANDAR', 'VERINA/F-02', 'KAVELING', '109.00', '0.00', '5600000', '0', '0.00', '0.00', '610400000', '0', '610400000', '671440000', '0.00', '', '16786000', '2.500000000', '184646000', '27.500000000', '470008000', '9362259', '5517943', '4290529', '7.25', 'Marketable', '', '2013-07-04 08:11:27', 'MH', 0, '0000-00-00 00:00:00'),
(323, 0, 24, 37, 'STANDAR', 'VERINA/F-52', 'KAVELING', '372.00', '0.00', '5600000', '0', '0.00', '0.00', '2083200000', '0', '2083200000', '2291520000', '0.00', '', '57288000', '2.500000000', '630168000', '27.500000000', '1604064000', '31951930', '18831878', '14642905', '7.25', 'Marketable', '', '2013-07-04 08:11:27', 'HH', 0, '0000-00-00 00:00:00'),
(324, 0, 24, 37, 'STANDAR', 'VERINA/F-56', 'KAVELING', '196.00', '0.00', '5600000', '0', '0.00', '0.00', '1097600000', '0', '1097600000', '1207360000', '0.00', '', '30184000', '2.500000000', '332024000', '27.500000000', '845152000', '16834888', '9922172', '7715079', '7.25', 'Marketable', '', '2013-07-04 08:11:27', 'HM', 0, '0000-00-00 00:00:00'),
(325, 0, 24, 37, 'STANDAR', 'VERINA/L-35', 'KAVELING', '236.00', '0.00', '5600000', '0', '0.00', '0.00', '1321600000', '0', '1321600000', '1453760000', '0.00', '', '36344000', '2.500000000', '399784000', '27.500000000', '1017632000', '20270580', '11947106', '9289585', '7.25', 'Marketable', '', '2013-07-04 08:11:27', 'HM', 0, '0000-00-00 00:00:00'),
(326, 0, 24, 36, 'SUDUT', 'VERINA/M-05', 'RESIDENSIAL', '227.00', '44.00', '5600000', '3520000', '0.00', '0.00', '1302980000', '154880000', '1457860000', '1603646000', '2.50', '', '40091150', '2.500000000', '441002650', '27.500000000', '1122552200', '22360523', '13178880', '10247362', '7.25', 'Marketable', '', '2013-07-04 08:11:27', 'HM', 0, '0000-00-00 00:00:00'),
(327, 0, 5, 5, 'STANDAR', 'CELESTA/A-11', 'KAVELING', '181.00', '0.00', '5600000', '0', '0.00', '0.00', '1013600000', '0', '1013600000', '1114960000', '0.00', '', '27874000', '2.500000000', '306614000', '27.500000000', '780472000', '15546504', '9162823', '7124639', '7.25', 'Marketable', '', '2013-07-04 08:11:27', 'HM', 0, '0000-00-00 00:00:00'),
(328, 0, 3, 3, 'SUDUT', 'CATALINA/J-16', 'RESIDENSIAL', '190.00', '56.00', '5600000', '3520000', '0.00', '0.00', '1064000000', '197120000', '1261120000', '1387232000', '0.00', '', '34680800', '2.500000000', '381488800', '27.500000000', '971062400', '19342943', '11400374', '8864468', '7.25', 'Marketable', '', '2013-07-04 08:11:27', 'HM', 0, '0000-00-00 00:00:00'),
(329, 0, 3, 3, 'KHUSUS', 'CATALINA/J-18', 'RESIDENSIAL', '121.00', '51.00', '5600000', '3360000', '0.00', '0.00', '677600000', '171360000', '848960000', '933856000', '0.00', '', '23346400', '2.500000000', '256810400', '27.500000000', '653699200', '13021271', '7674497', '5967377', '7.25', 'Marketable', '', '2013-07-04 08:11:27', 'HM', 0, '0000-00-00 00:00:00'),
(330, 0, 3, 3, 'KHUSUS', 'CATALINA/J-20', 'RESIDENSIAL', '116.00', '51.00', '5600000', '3360000', '0.00', '0.00', '649600000', '171360000', '820960000', '903056000', '0.00', '', '22576400', '2.500000000', '248340400', '27.500000000', '632139200', '12591809', '7421380', '5770564', '7.25', 'Marketable', '', '2013-07-04 08:11:27', 'HM', 0, '0000-00-00 00:00:00'),
(331, 0, 3, 3, 'KHUSUS', 'CATALINA/J-22', 'RESIDENSIAL', '111.00', '51.00', '5600000', '3360000', '0.00', '0.00', '621600000', '171360000', '792960000', '872256000', '0.00', '', '21806400', '2.500000000', '239870400', '27.500000000', '610579200', '12162348', '7168263', '5573751', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'HM', 0, '0000-00-00 00:00:00'),
(332, 0, 3, 3, 'KHUSUS', 'CATALINA/J-26', 'RESIDENSIAL', '106.00', '51.00', '5600000', '3360000', '0.00', '0.00', '593600000', '171360000', '764960000', '841456000', '0.00', '', '21036400', '2.500000000', '231400400', '27.500000000', '589019200', '11732886', '6915147', '5376938', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'HM', 0, '0000-00-00 00:00:00'),
(333, 0, 3, 3, 'KHUSUS', 'CATALINA/J-28', 'RESIDENSIAL', '101.00', '51.00', '5600000', '3360000', '0.00', '0.00', '565600000', '171360000', '736960000', '810656000', '0.00', '', '20266400', '2.500000000', '222930400', '27.500000000', '567459200', '11303425', '6662030', '5180124', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'MH', 0, '0000-00-00 00:00:00'),
(334, 0, 3, 3, 'SUDUT', 'CATALINA/J-30', 'RESIDENSIAL', '155.00', '56.00', '5600000', '3520000', '0.00', '0.00', '868000000', '197120000', '1065120000', '1171632000', '0.00', '', '29290800', '2.500000000', '322198800', '27.500000000', '820142400', '16336713', '9628557', '7486776', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'HM', 0, '0000-00-00 00:00:00'),
(335, 0, 2, 2, 'STANDAR', 'GRA/B-39', 'KAVELING', '382.00', '0.00', '5600000', '0', '0.00', '0.00', '2139200000', '0', '2139200000', '2353120000', '0.00', '', '58828000', '2.500000000', '647108000', '27.500000000', '1647184000', '32810853', '19338112', '15036531', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'HH', 0, '0000-00-00 00:00:00'),
(336, 0, 7, 7, 'STANDAR', 'GRB/H8-07', 'KAVELING', '72.00', '0.00', '5100000', '0', '0.00', '0.00', '367200000', '0', '367200000', '403920000', '0.00', '', '10098000', '2.500000000', '111078000', '27.500000000', '282744000', '5632080', '3319444', '2581065', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'MH', 0, '0000-00-00 00:00:00'),
(337, 0, 7, 7, 'STANDAR', 'GRB/H8-28', 'KAVELING', '72.00', '0.00', '5100000', '0', '0.00', '0.00', '367200000', '0', '367200000', '403920000', '0.00', '', '10098000', '2.500000000', '111078000', '27.500000000', '282744000', '5632080', '3319444', '2581065', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'MH', 0, '0000-00-00 00:00:00'),
(338, 0, 1, 1, 'KHUSUS', 'GRB/A4-38', 'RESIDENSIAL', '258.00', '60.00', '5100000', '3255000', '0.00', '0.00', '1315800000', '195300000', '1511100000', '1662210000', '0.00', '', '41555250', '2.500000000', '457107750', '27.500000000', '1163547000', '23177113', '13660163', '10621589', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'HM', 0, '0000-00-00 00:00:00'),
(339, 0, 12, 20, 'STANDAR', 'GRB/E4-A17', 'RESIDENSIAL', '72.00', '0.00', '5600000', '0', '0.00', '0.00', '403200000', '0', '403200000', '443520000', '0.00', '', '11088000', '2.500000000', '121968000', '27.500000000', '310464000', '6184245', '3644880', '2834111', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'MH', 0, '0000-00-00 00:00:00'),
(340, 0, 12, 20, 'STANDAR', 'GRB/E4-B3', 'RESIDENSIAL', '72.00', '0.00', '5600000', '0', '0.00', '0.00', '403200000', '0', '403200000', '443520000', '0.00', '', '11088000', '2.500000000', '121968000', '27.500000000', '310464000', '6184245', '3644880', '2834111', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'MH', 0, '0000-00-00 00:00:00'),
(341, 0, 12, 20, 'STANDAR', 'GRB/E4-C39', 'RESIDENSIAL', '84.00', '0.00', '5600000', '0', '0.00', '0.00', '470400000', '0', '470400000', '517440000', '0.00', '', '12936000', '2.500000000', '142296000', '27.500000000', '362208000', '7214952', '4252360', '3306462', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'MH', 0, '0000-00-00 00:00:00'),
(342, 0, 20, 32, 'KHUSUS', 'GRB/HE3-12', 'RESIDENSIAL', '120.00', '56.00', '5100000', '2000000', '0.00', '0.00', '612000000', '112000000', '724000000', '796400000', '0.00', '', '19910000', '2.500000000', '219010000', '27.500000000', '557480000', '11104646', '6544873', '5089028', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'MH', 0, '0000-00-00 00:00:00'),
(343, 0, 20, 32, 'KHUSUS', 'GRB/HF1-03', 'RESIDENSIAL', '120.00', '48.00', '5100000', '2000000', '0.00', '0.00', '612000000', '96000000', '708000000', '778800000', '0.00', '', '19470000', '2.500000000', '214170000', '27.500000000', '545160000', '10859239', '6400235', '4976563', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'MH', 0, '0000-00-00 00:00:00'),
(344, 0, 21, 33, 'STANDAR', 'GRB/GS12-21', 'RESIDENSIAL', '86.00', '21.00', '4500000', '1600000', '0.00', '0.00', '387000000', '33600000', '420600000', '462660000', '0.00', '', '11566500', '2.500000000', '127231500', '27.500000000', '323862000', '6451124', '3802174', '2956416', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'MH', 0, '0000-00-00 00:00:00'),
(345, 0, 21, 33, 'STANDAR', 'GRB/GS12-23', 'RESIDENSIAL', '88.00', '21.00', '4500000', '1600000', '0.00', '0.00', '396000000', '33600000', '429600000', '472560000', '0.00', '', '11814000', '2.500000000', '129954000', '27.500000000', '330792000', '6589165', '3883533', '3019677', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'MH', 0, '0000-00-00 00:00:00'),
(346, 0, 23, 35, 'KHUSUS', 'GRB/JB-10', 'RUKO', '73.00', '153.00', '21000000', '3465000', '0.00', '0.00', '1533000000', '530145000', '2063145000', '2269459500', '0.00', '', '56736488', '2.500000000', '624101363', '27.500000000', '1588621649', '31644329', '18650584', '14501937', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'RUKO', 0, '0000-00-00 00:00:00'),
(347, 0, 4, 4, 'STANDAR', 'FB/B-12', 'RUKO', '553.00', '0.00', '9200000', '0', '0.00', '0.00', '5087600000', '0', '5087600000', '5596360000', '0.00', '', '139909000', '2.500000000', '1538999000', '27.500000000', '3917452000', '78033142', '45991294', '35760965', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'HH', 0, '0000-00-00 00:00:00'),
(348, 0, 22, 34, 'SUDUT', 'FR/A-01', 'RUKO', '169.00', '131.00', '18000000', '3500000', '0.00', '0.00', '3270150000', '458500000', '3728650000', '4101515000', '7.50', '', '102537875', '2.500000000', '1127916625', '27.500000000', '2871060500', '57189692', '33706549', '26208846', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'RUKO', 0, '0000-00-00 00:00:00'),
(349, 0, 22, 34, 'SUDUT', 'FR/D-02', 'RUKO', '72.00', '131.00', '18000000', '3500000', '0.00', '0.00', '1393200000', '458500000', '1851700000', '2036870000', '7.50', '', '50921750', '2.500000000', '560139250', '27.500000000', '1425809000', '28401205', '16739146', '13015681', '7.25', 'Marketable', '', '2013-07-04 08:11:28', 'RUKO', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit_promo`
--

CREATE TABLE IF NOT EXISTS `tbl_unit_promo` (
  `id_unit` int(11) NOT NULL,
  `id_cara_pembayaran` int(11) NOT NULL,
  `max_diskon_tanah` decimal(4,2) NOT NULL DEFAULT '0.00',
  `max_diskon_bangunan` decimal(4,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit_siteplan`
--

CREATE TABLE IF NOT EXISTS `tbl_unit_siteplan` (
  `id_siteplan` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `coords` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_unit_siteplan`
--

INSERT INTO `tbl_unit_siteplan` (`id_siteplan`, `id_unit`, `coords`) VALUES
(1, 4, '562, 276, 519, 266, 493, 386, 535, 395'),
(1, 5, '474, 256, 515, 265, 489, 384, 447, 376'),
(1, 6, '427, 246, 470, 256, 443, 376, 401, 366'),
(1, 7, '382, 236, 424, 245, 396, 366, 355, 357'),
(1, 8, '336, 226, 378, 235, 351, 356, 310, 348'),
(1, 9, '292, 216, 331, 226, 304, 347, 264, 338'),
(1, 10, '245, 206, 286, 216, 259, 337, 217, 329'),
(1, 11, '199, 196, 199, 196, 240, 206, 213, 328, 171, 320'),
(6, 279, '896, 197, 867, 183, 899, 112, 957, 130, 960, 135, 955, 151, 921, 138'),
(6, 291, '568, 135, 621, 139, 624, 142, 653, 144, 619, 181, 567, 158'),
(7, 276, '623, 429, 645, 384, 612, 367, 612, 367, 590, 412'),
(3, 203, '235, 654, 272, 631, 253, 602, 216, 626'),
(3, 206, '248, 679, 286, 655, 273, 634, 237, 657'),
(3, 238, '363, 766, 398, 743, 382, 717, 376, 717, 345, 737'),
(3, 209, '411, 840, 446, 818, 460, 838, 423, 862'),
(3, 210, '426, 865, 462, 842, 476, 863, 439, 886'),
(3, 262, '394, 608, 371, 572, 345, 588, 344, 591, 365, 626'),
(3, 263, '419, 592, 396, 557, 374, 570, 397, 606'),
(3, 264, '466, 561, 443, 525, 421, 539, 446, 575'),
(3, 265, '493, 545, 513, 532, 490, 495, 469, 508'),
(3, 266, '516, 528, 537, 516, 514, 480, 494, 494'),
(3, 267, '541, 514, 561, 501, 538, 465, 518, 478'),
(3, 268, '565, 499, 585, 486, 562, 449, 541, 463'),
(3, 270, '467, 711, 443, 674, 413, 694, 413, 699, 433, 732'),
(3, 273, '572, 643, 554, 655, 531, 618, 550, 606'),
(3, 291, '492, 751, 469, 714, 436, 735, 456, 768, 463, 769'),
(3, 113, '517, 735, 493, 698, 472, 711, 495, 748'),
(3, 131, '839, 270, 802, 248, 791, 266, 827, 289'),
(3, 132, '804, 244, 815, 225, 851, 248, 841, 267'),
(3, 133, '817, 223, 854, 246, 865, 227, 828, 204'),
(3, 134, '866, 224, 878, 205, 841, 182, 830, 201'),
(3, 138, '903, 256, 891, 274, 854, 251, 865, 233'),
(3, 139, '936, 351, 948, 333, 911, 310, 899, 328'),
(3, 140, '904, 253, 915, 234, 878, 212, 867, 230'),
(3, 141, '926, 286, 937, 267, 974, 289, 963, 307'),
(3, 144, '989, 265, 1001, 246, 963, 223, 952, 243'),
(1, 3, '565, 277, 608, 286, 581, 403, 538, 396'),
(4, 191, '585, 346, 575, 308, 535, 319, 502, 370'),
(4, 192, '737, 430, 777, 420, 767, 384, 765, 382, 760, 381, 727, 390'),
(4, 195, '925, 471, 963, 460, 954, 422, 914, 432'),
(4, 197, '883, 635, 924, 624, 916, 592, 913, 589, 906, 588, 873, 598'),
(4, 203, '959, 420, 998, 408, 1008, 447, 970, 458'),
(4, 206, '1101, 946, 1141, 935, 1152, 974, 1138, 980, 1113, 984, 1101, 946'),
(4, 209, '1238, 798, 1247, 832, 1211, 842, 1206, 839, 1198, 809'),
(4, 210, '1227, 915, 1243, 911, 1259, 906, 1249, 867, 1220, 875, 1217, 878'),
(4, 211, '1335, 886, 1324, 847, 1302, 853, 1313, 891'),
(4, 213, '1383, 996, 1373, 958, 1346, 966, 1345, 971, 1354, 1005'),
(4, 214, '1481, 971, 1471, 936, 1469, 932, 1464, 931, 1441, 939, 1452, 978'),
(4, 216, '1367, 1046, 1373, 1046, 1394, 1040, 1384, 1001, 1356, 1008'),
(4, 217, '1464, 1021, 1487, 1014, 1490, 1011, 1491, 1007, 1482, 973, 1453, 982'),
(4, 232, '777, 1046, 766, 1006, 726, 1018, 736, 1057'),
(4, 234, '653, 1080, 643, 1041, 609, 1050, 619, 1088'),
(4, 238, '799, 1086, 795, 1088, 744, 1085, 737, 1061, 788, 1047'),
(5, 257, '953, 868, 986, 859, 975, 813, 971, 810, 965, 809, 938, 816'),
(5, 259, '845, 1111, 830, 1059, 744, 1083, 814, 1119'),
(5, 261, '1108, 1039, 1093, 987, 1060, 996, 1073, 1044, 1076, 1047, 1082, 1047'),
(5, 262, '1313, 983, 1337, 977, 1340, 973, 1340, 920, 1299, 931'),
(5, 263, '1059, 992, 1092, 984, 1078, 932, 1051, 938, 1046, 941, 1046, 948'),
(5, 264, '1310, 830, 1338, 823, 1344, 817, 1354, 763, 1296, 779'),
(5, 265, '1305, 924, 1339, 916, 1324, 862, 1291, 873'),
(5, 266, '1056, 840, 1042, 788, 1008, 798, 1007, 803, 1020, 850'),
(5, 267, '1373, 661, 1401, 653, 1406, 651, 1406, 645, 1392, 600, 1360, 610'),
(5, 268, '1321, 767, 1356, 758, 1341, 707, 1307, 716'),
(5, 269, '977, 617, 962, 565, 932, 572, 945, 620, 949, 624'),
(5, 270, '1041, 691, 1027, 640, 996, 648, 995, 650, 995, 657, 1007, 701'),
(5, 271, '1359, 605, 1391, 595, 1379, 550, 1374, 546, 1343, 553'),
(5, 273, '1301, 469, 1353, 454, 1311, 409, 1287, 415'),
(5, 274, '1355, 452, 1372, 406, 1321, 387, 1314, 406'),
(3, 75, '271, 631, 253, 602, 216, 626, 235, 654'),
(3, 76, '287, 655, 273, 635, 237, 658, 249, 678'),
(3, 77, '323, 710, 304, 681, 267, 705, 282, 729, 287, 731'),
(3, 78, '363, 774, 342, 740, 309, 761, 307, 765, 328, 799'),
(3, 79, '425, 871, 411, 850, 375, 873, 388, 893'),
(3, 80, '406, 920, 442, 897, 467, 935, 445, 951, 426, 952, 405, 921'),
(3, 81, '274, 629, 311, 605, 296, 582, 294, 580, 290, 579, 256, 600'),
(3, 82, '326, 630, 312, 608, 276, 632, 290, 653'),
(3, 83, '307, 679, 342, 656, 359, 680, 358, 685, 357, 687, 325, 707'),
(3, 84, '363, 765, 400, 743, 386, 720, 377, 716, 344, 737'),
(3, 85, '445, 814, 432, 793, 396, 817, 409, 837'),
(3, 86, '460, 839, 447, 817, 411, 841, 424, 861'),
(3, 87, '463, 841, 475, 862, 439, 884, 427, 864'),
(3, 88, '442, 888, 477, 866, 492, 889, 478, 929, 470, 934'),
(3, 89, '456, 475, 493, 451, 470, 416, 439, 449'),
(3, 90, '514, 437, 487, 397, 472, 415, 495, 448'),
(3, 91, '536, 423, 508, 380, 490, 393, 517, 435'),
(3, 99, '418, 591, 395, 557, 375, 568, 397, 604'),
(3, 98, '394, 608, 371, 571, 346, 587, 345, 596, 366, 625'),
(3, 92, '555, 410, 539, 422, 511, 378, 528, 365'),
(3, 93, '577, 394, 549, 353, 530, 364, 559, 408'),
(3, 100, '466, 562, 443, 525, 422, 539, 445, 574'),
(3, 94, '598, 383, 569, 336, 551, 349, 580, 395'),
(4, 190, '665, 325, 702, 314, 692, 278, 686, 276, 656, 285'),
(3, 95, '620, 369, 588, 321, 571, 335, 601, 382'),
(3, 101, '513, 532, 490, 495, 470, 509, 493, 544'),
(3, 96, '641, 356, 613, 311, 601, 309, 591, 319, 623, 366'),
(3, 102, '538, 515, 514, 480, 493, 493, 517, 529'),
(3, 97, '670, 337, 647, 301, 616, 310, 644, 354'),
(3, 103, '561, 500, 539, 465, 518, 478, 542, 513'),
(3, 104, '585, 486, 561, 450, 541, 463, 565, 498'),
(3, 105, '612, 467, 642, 449, 621, 415, 615, 415, 590, 431, 612, 467'),
(3, 106, '466, 710, 444, 675, 414, 693, 413, 699, 434, 732'),
(3, 107, '509, 683, 487, 647, 468, 659, 491, 695'),
(3, 108, '573, 643, 550, 606, 531, 618, 555, 654'),
(3, 109, '619, 612, 653, 590, 630, 555, 595, 576'),
(3, 110, '632, 512, 652, 497, 652, 494, 643, 453, 609, 474'),
(3, 111, '491, 749, 469, 714, 435, 735, 456, 768, 461, 769'),
(3, 112, '538, 829, 523, 853, 515, 859, 482, 807, 480, 803, 482, 798, 508, 783'),
(3, 114, '539, 718, 517, 683, 496, 698, 519, 731'),
(3, 115, '553, 753, 510, 780, 540, 828, 546, 824, 558, 810, 544, 792'),
(3, 116, '563, 703, 541, 668, 519, 682, 543, 716'),
(3, 117, '587, 689, 565, 653, 543, 666, 567, 701'),
(3, 118, '612, 674, 589, 637, 567, 650, 591, 687'),
(3, 119, '612, 622, 591, 635, 614, 671, 636, 658'),
(3, 120, '637, 656, 666, 638, 668, 632, 655, 594, 615, 620'),
(3, 121, '740, 281, 729, 300, 722, 305, 672, 276, 690, 251'),
(3, 122, '812, 313, 776, 290, 760, 314, 760, 317, 762, 322, 795, 341'),
(3, 123, '752, 258, 706, 230, 693, 248, 741, 277'),
(3, 124, '766, 237, 722, 211, 709, 227, 754, 255'),
(3, 125, '778, 216, 736, 190, 723, 207, 768, 234'),
(3, 126, '792, 194, 751, 170, 738, 187, 780, 213'),
(3, 127, '805, 172, 767, 149, 753, 168, 794, 191'),
(3, 128, '807, 170, 822, 145, 783, 130, 770, 146'),
(3, 135, '843, 180, 857, 158, 882, 165, 894, 139, 911, 150, 879, 201, 843, 180'),
(3, 136, '876, 299, 840, 277, 799, 342, 853, 331, 857, 329'),
(3, 137, '934, 354, 898, 331, 884, 353, 884, 358, 902, 398, 906, 401'),
(3, 143, '986, 268, 975, 286, 939, 263, 950, 245'),
(3, 142, '931, 210, 948, 181, 949, 176, 946, 171, 914, 152, 894, 186'),
(3, 145, '964, 221, 978, 198, 981, 196, 984, 195, 1019, 216, 1003, 243'),
(3, 146, '947, 424, 950, 421, 961, 400, 924, 378, 909, 402'),
(3, 147, '1046, 410, 1029, 440, 993, 418, 1009, 389'),
(3, 148, '1058, 392, 1050, 408, 1012, 386, 1022, 370'),
(3, 149, '1060, 389, 1071, 373, 1034, 351, 1023, 367'),
(3, 150, '1035, 348, 1045, 332, 1080, 354, 1071, 370'),
(3, 151, '1047, 329, 1056, 314, 1092, 335, 1083, 351'),
(3, 152, '1093, 333, 1103, 315, 1067, 294, 1057, 310'),
(3, 153, '1115, 298, 1106, 314, 1069, 290, 1078, 276'),
(3, 154, '1042, 265, 1057, 245, 1059, 239, 1022, 218, 1006, 242'),
(3, 155, '1118, 295, 1126, 280, 1090, 256, 1081, 272'),
(3, 156, '1095, 181, 1083, 200, 1078, 206, 1070, 206, 1041, 186, 1058, 158'),
(3, 157, '1092, 254, 1121, 205, 1130, 232, 1145, 250, 1129, 274'),
(3, 158, '1097, 177, 1113, 152, 1109, 126, 1077, 128, 1060, 154'),
(3, 159, '1034, 441, 1087, 433, 1089, 432, 1101, 414, 1064, 392'),
(3, 160, '1102, 411, 1112, 393, 1075, 373, 1066, 388'),
(3, 161, '1114, 390, 1126, 370, 1108, 319, 1077, 369'),
(4, 193, '370, 576, 359, 536, 319, 546, 330, 587'),
(4, 194, '407, 642, 397, 604, 357, 614, 366, 650, 369, 653'),
(4, 196, '1005, 609, 1016, 645, 977, 653, 975, 652, 967, 621'),
(4, 198, '429, 682, 417, 646, 370, 657, 392, 691, 395, 692'),
(4, 199, '467, 747, 458, 711, 419, 722, 430, 760'),
(4, 200, '1033, 712, 1024, 677, 988, 685, 985, 689, 993, 722'),
(4, 201, '1019, 942, 1011, 915, 972, 927, 979, 951'),
(4, 202, '1008, 607, 1049, 595, 1056, 627, 1056, 634, 1018, 641'),
(4, 204, '1037, 712, 1028, 675, 1062, 666, 1066, 666, 1070, 672, 1076, 700'),
(4, 205, '1084, 729, 1077, 703, 1038, 716, 1045, 740'),
(4, 207, '1158, 1047, 1124, 1037, 1116, 1087, 1143, 1096'),
(4, 208, '1162, 1048, 1191, 1056, 1175, 1105, 1147, 1098'),
(4, 212, '1485, 843, 1473, 805, 1454, 810, 1465, 849'),
(4, 215, '1469, 895, 1496, 886, 1486, 849, 1459, 856'),
(4, 218, '873, 764, 907, 755, 895, 716, 862, 725'),
(4, 219, '480, 794, 469, 756, 431, 766, 442, 805'),
(1, 1, '657, 297, 699, 306, 673, 423, 631, 415'),
(1, 2, '611, 287, 653, 294, 627, 413, 586, 403'),
(15, 350, '494, 515, 989, 521, 826, 717, 452, 716'),
(16, 351, '415, 544, 959, 527, 661, 735'),
(16, 350, '250, 574, 152, 750, 481, 617'),
(15, 351, '305, 121, 636, 323, 408, 293'),
(2, 72, '854.05, 1117, 867.05, 1013, 819.05, 1007, 804.05, 1112'),
(2, 73, '907.05, 1123, 921.05, 1020, 872.05, 1016, 858.05, 1117'),
(2, 74, '1113.05, 1048, 1100.05, 1149, 1019.05, 1138, 1033.05, 1037'),
(2, 65, '1010.05, 1205, 1088.05, 1215, 1080.05, 1266, 1099.05, 1319, 997.05, 1307, 1010.05, 1205'),
(2, 66, '1072.95, 662, 1114.95, 637, 1061.95, 547, 1019.95, 575'),
(2, 68, '1165.95, 605, 1236.95, 560, 1229.95, 493, 1170.95, 481, 1112.95, 517'),
(2, 67, '1117.95, 633, 1161.95, 606, 1108.95, 520, 1066.95, 544'),
(2, 69, '1162.95, 889, 1271.95, 876, 1277.95, 926, 1168.95, 938'),
(2, 70, '1186.95, 1104, 1300.95, 1092, 1311.95, 1171, 1198.95, 1212'),
(2, 71, '864.95, 906, 813.95, 898, 807.95, 898, 801.95, 901, 745.95, 936, 742.95, 945, 734.95, 993, 851.95, 1006'),
(8, 40, '702.05, 878, 725.05, 802, 727.05, 795, 723.05, 787, 667.05, 771, 641.05, 858'),
(8, 41, '411.05, 788, 452.05, 801, 479.05, 714, 437.05, 700, 410.05, 786'),
(8, 42, '333.05, 763, 360.05, 675, 318.05, 663, 312.05, 681, 275.05, 670, 262.05, 741'),
(8, 43, '882.05, 881, 893.05, 842, 786.05, 808, 772.05, 848'),
(8, 44, '829.05, 965, 839.05, 938, 862.05, 944, 866.05, 932, 756.05, 898, 744.05, 940'),
(8, 45, '730.05, 984, 744.05, 943, 828.05, 970, 815.05, 1012'),
(8, 46, '715.05, 1031, 730.05, 988, 814.05, 1015, 801.05, 1057'),
(8, 47, '714.05, 1035, 701.05, 1076, 785.05, 1102, 800.05, 1061'),
(8, 48, '701.05, 1080, 687.05, 1121, 771.05, 1146, 785.05, 1106'),
(8, 49, '686.05, 1126, 673.05, 1168, 758.05, 1194, 771.05, 1151'),
(8, 50, '673.05, 1172, 659.05, 1213, 744.05, 1239, 758.05, 1195'),
(8, 51, '659.05, 1214, 646.05, 1258, 731.05, 1283, 745.05, 1243'),
(8, 52, '645.05, 1261, 632.05, 1304, 716.05, 1328, 729.05, 1289'),
(8, 53, '631.05, 1307, 614.05, 1360, 702.05, 1371, 719.05, 1334'),
(8, 54, '264.05, 998, 332.05, 1019, 358.05, 931, 297.05, 913, 291.05, 916, 264.05, 997'),
(8, 55, '292.05, 849, 317.05, 763, 261.05, 746, 245.05, 832'),
(8, 56, '562.05, 1090, 630.05, 1110, 652.05, 1036, 655.05, 1028, 647.05, 1020, 589.05, 1003, 564.05, 1090'),
(8, 57, '518.05, 1076, 558.05, 1087, 585.05, 1003, 544.05, 989'),
(8, 58, '472.05, 1061, 514.05, 1073, 539.05, 989, 498.05, 975'),
(8, 59, '453.05, 960, 495.05, 975, 467.05, 1059, 426.05, 1047'),
(8, 60, '422.05, 1046, 449.05, 959, 408.05, 947, 382.05, 1033'),
(8, 61, '383.05, 878, 409.05, 791, 367.05, 777, 340.05, 864'),
(8, 62, '404.05, 947, 363.05, 932, 335.05, 1019, 376.05, 1032'),
(8, 63, '292.05, 1167, 252.05, 1154, 209.05, 1294, 251.05, 1300'),
(8, 64, '247.05, 1153, 183.05, 1132, 152.05, 1284, 203.05, 1293'),
(6, 277, '799.05, 151, 825.05, 97, 777.05, 83, 772.05, 143'),
(6, 278, '830.05, 97, 860.05, 104, 830.05, 168, 804.05, 155'),
(6, 280, '227.05, 428, 211.05, 338, 180.05, 331, 199.05, 433'),
(6, 281, '196.05, 433, 177.05, 331, 175.05, 330, 156.05, 399, 164.05, 437'),
(6, 282, '154.05, 471, 160.05, 442, 153.05, 403, 145.05, 402, 140.05, 401, 75.05, 391, 68.05, 412, 64.05, 426, 55.05, 449'),
(6, 283, '153.05, 471, 146.05, 505, 49.05, 482, 57.05, 452'),
(6, 284, '145.05, 506, 139.05, 538, 41.05, 517, 49.05, 487'),
(6, 285, '138.05, 542, 40.05, 521, 32.05, 551, 131.05, 572'),
(6, 286, '125.05, 606, 131.05, 574, 32.05, 554, 21.05, 605, 108.05, 627, 113.05, 601'),
(6, 287, '505.2167, 303.6667, 542.2167, 264.6667, 502.2167, 226.6667, 480.2167, 249.6667, 480.2167, 254.6667, 482.2167, 263.6667'),
(6, 288, '452.2167, 125.6667, 407.2167, 122.6667, 412.2167, 54.6667, 437.2167, 53.6667, 437.2167, 16.6667, 462.2167, 18.6667, 463.2167, 39.6667, 457.2167, 39.6667'),
(6, 289, '461.2167, 43.6667, 487.2167, 44.6667, 482.2167, 124.6667, 456.2167, 126.6667'),
(6, 290, '486.2167, 127.6667, 492.2167, 43.6667, 529.2167, 47.6667, 526.2167, 128.6667'),
(6, 292, '408.2167, 236.6667, 395.2167, 155.6667, 357.2167, 164.6667, 371.2167, 243.6667'),
(6, 293, '367.2167, 243.6667, 353.2167, 165.6667, 326.2167, 171.6667, 341.2167, 248.6667'),
(6, 294, '323.2167, 172.6667, 320.2167, 173.6667, 292.2167, 169.6667, 282.2167, 245.6667, 287.2167, 245.6667, 291.2167, 258.6667, 339.2167, 250.6667'),
(6, 295, '322.2167, 351.6667, 312.2167, 295.6667, 285.2167, 302.6667, 288.2167, 316.6667, 265.2167, 321.6667, 262.2167, 341.6667, 280.2167, 358.6667'),
(5, 258, '437.2167, 703.8333, 407.2167, 711.8333, 394.2167, 663.8333, 394.2167, 658.8333, 397.2167, 657.8333, 423.2167, 651.8333'),
(5, 260, '916.3833, 1182.8333, 901.3833, 1132.8333, 865.3833, 1141.8333, 879.3833, 1192.8333'),
(5, 272, '1481.2, 277.8333, 1492.2, 248.8333, 1492.2, 246.8333, 1492.2, 238.8333, 1443.2, 219.8333, 1430.2, 260.8333'),
(5, 275, '1439.2667, 220, 1428.2667, 249, 1378.2667, 231, 1388.2667, 203, 1392.2667, 203'),
(4, 220, '516.05, 861, 506.05, 822, 475.05, 830, 475.05, 835, 475.05, 840, 483.05, 870'),
(4, 221, '863.05, 813, 886.05, 808, 890.05, 803, 905.05, 758, 852.05, 774'),
(4, 222, '859.05, 814, 849.05, 774, 827.05, 779, 837.05, 820'),
(4, 223, '550.05, 976, 540.05, 937, 503.05, 944, 515.05, 985'),
(4, 224, '530.05, 904, 519.05, 864, 485.05, 873, 494.05, 907, 498.05, 912'),
(4, 225, '768.05, 964, 798.05, 955, 801.05, 954, 802.05, 947, 792.05, 913, 756.05, 921'),
(4, 226, '913.05, 884, 953.05, 876, 934.05, 801, 908.05, 865'),
(4, 228, '739.05, 971, 728.05, 930, 707.05, 935, 716.05, 978'),
(4, 229, '712.05, 978, 702.05, 938, 681.05, 944, 692.05, 984'),
(4, 227, '764.05, 964, 753.05, 923, 730.05, 930, 741.05, 968'),
(4, 230, '929.05, 938, 922.05, 917, 962.05, 907, 975.05, 950'),
(4, 231, '867.05, 1022, 898.05, 1012, 909.05, 969, 856.05, 983'),
(4, 233, '563.05, 1020, 551.05, 979, 515.05, 989, 525.05, 1030'),
(4, 235, '539.05, 1109, 529.05, 1070, 506.05, 1079, 503.05, 1082, 489.05, 1125'),
(4, 236, '533.05, 1158, 521.05, 1121, 489.05, 1125, 499.05, 1168'),
(4, 237, '503.05, 1245, 492.05, 1205, 465.05, 1211, 463.05, 1214, 450.05, 1259'),
(4, 239, '898.05, 1016, 886.05, 1054, 886.05, 1061, 861.05, 1069, 848.05, 1031'),
(4, 240, '493.05, 1295, 482.05, 1255, 450.05, 1263, 460.05, 1303'),
(4, 241, '648.05, 1251, 678.05, 1243, 674.05, 1202, 636.05, 1211'),
(4, 242, '393.05, 1330, 419.05, 1322, 420.05, 1320, 410.05, 1285, 382.05, 1293'),
(4, 243, '453.05, 1443, 445.05, 1410, 406.05, 1422, 408.05, 1432'),
(4, 244, '390.05, 1333, 378.05, 1294, 360.05, 1297, 370.05, 1337'),
(4, 245, '367.05, 1340, 356.05, 1301, 328.05, 1306, 339.05, 1346'),
(4, 246, '404.05, 1419, 400.05, 1400, 439.05, 1389, 444.05, 1406'),
(4, 247, '437.05, 1385, 433.05, 1360, 428.05, 1358, 423.05, 1358, 390.05, 1369, 398.05, 1395'),
(4, 248, '369.05, 1373, 387.05, 1369, 404.05, 1434, 384.05, 1430'),
(4, 249, '365.05, 1375, 347.05, 1379, 359.05, 1425, 380.05, 1428'),
(4, 250, '356.3667, 1425.3334, 344.3667, 1380.3334, 287.3667, 1395.3334, 290.3667, 1407.3334'),
(4, 251, '282.3667, 1395.3334, 285.3667, 1407.3334, 268.3667, 1465.3334, 243.3667, 1459.3334, 244.3667, 1406.3334'),
(4, 252, '620.3667, 1468.0166, 608.3667, 1422.0166, 577.3667, 1430.0166, 586.3667, 1463.0166'),
(4, 253, '644.3667, 1470.0166, 630.3667, 1416.0166, 610.3667, 1420.0166, 624.3667, 1470.0166'),
(4, 254, '632.3667, 1415.0166, 650.3667, 1410.0166, 668.3667, 1472.0166, 648.3667, 1471.0166'),
(4, 255, '654.3667, 1409.0166, 672.3667, 1405.0166, 692.3667, 1473.0166, 671.3667, 1470.0166'),
(4, 256, '676.3667, 1402.0166, 694.3667, 1398.0166, 715.3667, 1474.0166, 694.3667, 1472.0166'),
(1, 12, '195.0625, 195, 128.0625, 181, 100.0625, 302, 166.0625, 319');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
`id_user` int(11) NOT NULL,
  `id_agent` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `email` varchar(200) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `hp` varchar(100) DEFAULT NULL,
  `alamat` text NOT NULL,
  `level` enum('Administrator','Manager','Kasir','Sales','Stok') NOT NULL DEFAULT 'Sales',
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tanggal_posting` datetime NOT NULL,
  `status_transaksi` enum('1','2','3') NOT NULL DEFAULT '2'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `id_agent`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `email`, `telepon`, `hp`, `alamat`, `level`, `username`, `password`, `tanggal_posting`, `status_transaksi`) VALUES
(1, 1, 'Dito Fityanto', 'Lhokseumawe', '1989-05-12', 'dito.fityanto@gmail.com', '', '08123456789', 'Bandung', 'Administrator', 'Administrator', '7b7bc2512ee1fedcd76bdc68926d4f7b', '2013-07-23 05:37:55', '1'),
(2, 1, 'Manager', 'Bintaro', '2013-07-23', 'manager@gmail.com', '', '08123456789', 'Bintaro', 'Manager', 'Manager', 'ae94be3cd532ce4a025884819eb08c98', '2013-07-23 05:37:55', '1'),
(3, 1, 'Stok', 'Bintaro', '2013-07-23', 'stok@gmail.com', '', '08123456789', 'Bintaro', 'Stok', 'Stok', '55b7f53cb9c4d5e2f48d8ecf146d397b', '2013-07-23 05:37:55', '2'),
(4, 1, 'Kasir', 'Bintaro', '2013-07-23', 'kasir@gmail.com', '33333', '08123456789', 'Bintaro', 'Kasir', 'Kasir', '5a048a5dfdc9d2c58452dbdbfb320b9e', '2013-07-23 05:37:55', '1'),
(5, 2, 'Firman', 'Tangerang', '2013-07-23', 'firman_cus@yahoo.co.id', '02198085123', '081317776274', 'Tangerang', 'Sales', 'firman', 'c1f62146d15fca0d4c56ca866f4c44b0', '2013-07-23 05:37:55', '1'),
(6, 2, 'Slamet Margono', 'Pati', '2013-07-23', 'margonos@gmail.com', '', '085218860370', 'Kp. Pondok serut Rt/Rw 001/003 Pakujaya Serpong Tangerang', 'Sales', 'slamet', 'c5a42d9667c760e1b7c064e25536e570', '2013-07-23 05:37:55', '1'),
(7, 2, 'Yenny Roichanah', 'Malang', '2013-07-23', 'yenny_bramcha@yahoo.com', '08170084300', '08128480990', 'Jl. Teratai II Blok T-3/No.4 Villa Melati Mas Tangerang', 'Sales', 'yenny', '22db3625031bab4cc62af84eb6269d60', '2013-07-23 05:37:55', '1'),
(8, 2, 'Vera Lisliana', 'Jakarta', '2013-07-23', 'vera_lies@yahoo.com', '02199676995', '081388906636', 'Tangerang', 'Sales', 'vera', '5b1c28eec862c98f1f4d460ec2f9033c', '2013-07-23 05:37:55', '1'),
(9, 2, 'Rita Lousiana Anthony', 'Medan', '2013-07-23', 'rita.lusiana@gmail.com', '02199753098', '089625858568', 'Telaga Kahuripan Blok F8 No. 10-11 Parung Bogor', 'Sales', 'rita', '1cdac5ad084879e80e5b67c51baa9095', '2013-07-23 05:37:55', '1'),
(10, 2, 'Rian Sopian', 'Sukabumi', '1978-11-06', 'rian.sofyan@yahoo.com', '', '087808232328', 'Jl. Bandeng 1 No. 212 Karawaci Baru Tangerang', 'Sales', 'rian', 'c5e548cb9af6cf4a89e1b2c3df58f869', '2013-07-23 05:37:55', '1'),
(11, 2, 'Sri Haryati', 'Jakarta', '2013-07-23', 'keishacantik2105@yahoo.com', '02198125158', '087781945898', 'Cluster Pesona Ciledug-Tajur Blok F No. 9 Ciledug Tangerang', 'Sales', 'arie', 'db76becac4ca1a766a3d61a35ac47149', '2013-07-23 05:37:55', '1'),
(12, 2, 'Dendi Surya Negara', 'Jakarta', '1986-08-06', 'dendidudu@gmail.com', '0215454705', '08571827788', 'Komp. Kodam Jaya Jl. Sakura Blok K2/68 Kalideres Jakarta Barat', 'Sales', 'dendi', '9d47cb51d31cc4adbdaa29cde5070c7c', '2013-07-23 05:37:55', '1'),
(13, 2, 'Supriyatno', 'Jakarta', '2013-07-23', 'supri.bakri@gmail.com', '', '08170029300', 'Jl. Kemaring IV dalam Rt/Rw 011/06 Pejaten Timur Pasar Minggu', 'Sales', 'supri', 'd79444495ba8886c397b418227564d3f', '2013-07-23 05:37:55', '1'),
(14, 2, 'Sri Pamuji Rahayu', 'Klaten', '2013-07-23', 'ayugraharaya@yahoo.co.id', '08212395829', '08170048300', 'Verina x No. 17 Graha Raya', 'Sales', 'sri', 'b44d26dc49101cd7423a27b958952e58', '2013-07-23 05:37:55', '1'),
(15, 2, 'Anggie Kartika Ransum', 'Bandar lampung', '1985-05-19', 'anggieransum@yahoo.com', '081318952000', '-', 'Jl. Nuri I No. 3 Karawaci Tangerang', 'Sales', 'anggie', '959a07de79b44c9e77150e9b8dc92fbc', '2013-07-23 05:37:55', '1'),
(16, 2, 'Ahmad Kurniawan', 'Batang', '1976-07-17', 'jabalyk@yahoo.com', '', '08158490014', 'Komp. Graha Bunga GB7. No7 Bintaro Jaya', 'Sales', 'wawan', '52c69e3a57331081823331c4e69d3f2e', '2013-07-23 05:37:55', '1'),
(17, 2, 'Lisa Resti Ishak', 'Jakarta', '1988-03-10', 'lisa.resty@yahoo.com', '', '081586878859', 'Poris Indah Blok D.828', 'Sales', 'resty', '892d2419d28f99cb74cc020f8c0419b2', '2013-07-23 05:37:55', '1'),
(18, 2, 'Maharani', 'Jakarta', '1981-02-21', 'button_2181@yahoo.co.id', '', '081807896394', 'Graha Raya GB5 No. 3 Tangerang', 'Sales', 'rani', 'd3e070965d9cb730ab61750e2a09e018', '2013-07-23 05:37:55', '1'),
(19, 2, 'Micha Sofia', 'Bandung', '1972-05-02', 'micha.sofia@yahoo.com', '', '081807896398', 'Komp. Kuciran Indah Jl. Duyung D3/137', 'Sales', 'micha', '36980aedddb26b3aaef26bb214d979ec', '2013-07-23 05:37:55', '1'),
(20, 2, 'Dian Franky Maradu', '-', '2013-07-23', '-', '', '-', '-', 'Sales', 'dian', 'f97de4a9986d216a6e0fea62b0450da9', '2013-07-23 05:37:55', '1'),
(21, 2, 'Budi Hardjono', 'Semarang', '1970-11-25', 'budi.hardjono@gmail.com', '', '018128987889', 'Puri Dewata Indah Blok D2 No. 21 Tangerang', 'Sales', 'hardjono', '5825ba0ef08bc1280e7036129f4edd42', '2013-07-23 05:37:55', '1'),
(22, 2, 'Zaenudin', '-', '2013-07-23', '-', '', '-', '-', 'Sales', 'zaenudin', '18bb3de4c47570a26a4140fc4fd2fd76', '2013-07-23 05:37:55', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_log`
--

CREATE TABLE IF NOT EXISTS `tbl_user_log` (
`id_logs` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `keterangan` text,
  `ip_address` varchar(50) DEFAULT NULL,
  `tanggal_posting` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_agent`
--
ALTER TABLE `tbl_agent`
 ADD PRIMARY KEY (`id_agent`);

--
-- Indexes for table `tbl_anggota_keluarga`
--
ALTER TABLE `tbl_anggota_keluarga`
 ADD PRIMARY KEY (`id_anggota_keluarga`);

--
-- Indexes for table `tbl_captcha`
--
ALTER TABLE `tbl_captcha`
 ADD PRIMARY KEY (`captcha_id`), ADD KEY `word` (`word`);

--
-- Indexes for table `tbl_cara_pembayaran`
--
ALTER TABLE `tbl_cara_pembayaran`
 ADD PRIMARY KEY (`id_cara_pembayaran`);

--
-- Indexes for table `tbl_cluster`
--
ALTER TABLE `tbl_cluster`
 ADD PRIMARY KEY (`id_cluster`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
 ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `tbl_customer_dokumen`
--
ALTER TABLE `tbl_customer_dokumen`
 ADD PRIMARY KEY (`id_dokumen`);

--
-- Indexes for table `tbl_customer_ref`
--
ALTER TABLE `tbl_customer_ref`
 ADD PRIMARY KEY (`no_ktp`);

--
-- Indexes for table `tbl_file_dokumen`
--
ALTER TABLE `tbl_file_dokumen`
 ADD PRIMARY KEY (`id_dokumen`);

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
 ADD PRIMARY KEY (`id_gallery`), ADD KEY `fk_tbl_gallery_type` (`id_type`);

--
-- Indexes for table `tbl_kartu_keluarga`
--
ALTER TABLE `tbl_kartu_keluarga`
 ADD PRIMARY KEY (`id_kartu_keluarga`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
 ADD PRIMARY KEY (`id_news`);

--
-- Indexes for table `tbl_nup`
--
ALTER TABLE `tbl_nup`
 ADD PRIMARY KEY (`id_nup`);

--
-- Indexes for table `tbl_pemesanan`
--
ALTER TABLE `tbl_pemesanan`
 ADD PRIMARY KEY (`id_pemesanan`,`id_customer`);

--
-- Indexes for table `tbl_promo`
--
ALTER TABLE `tbl_promo`
 ADD PRIMARY KEY (`id_promo`);

--
-- Indexes for table `tbl_sessions`
--
ALTER TABLE `tbl_sessions`
 ADD PRIMARY KEY (`session_id`), ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `tbl_siteplan`
--
ALTER TABLE `tbl_siteplan`
 ADD PRIMARY KEY (`id_siteplan`), ADD KEY `fk_tbl_siteplan_cluster` (`id_cluster`);

--
-- Indexes for table `tbl_timeout`
--
ALTER TABLE `tbl_timeout`
 ADD PRIMARY KEY (`id_timeout`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
 ADD PRIMARY KEY (`id_type`), ADD KEY `fk_tbl_type_cluster` (`id_cluster`);

--
-- Indexes for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
 ADD PRIMARY KEY (`id_unit`), ADD KEY `fk_tbl_unit_cluster` (`id_cluster`), ADD KEY `fk_tbl_unit_type` (`id_type`);

--
-- Indexes for table `tbl_unit_siteplan`
--
ALTER TABLE `tbl_unit_siteplan`
 ADD KEY `fk_tbl_unit_siteplan_siteplan` (`id_siteplan`), ADD KEY `fk_tbl_unit_siteplan_unit` (`id_unit`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
 ADD PRIMARY KEY (`id_user`), ADD UNIQUE KEY `username` (`username`), ADD KEY `fk_tbl_user_agent` (`id_agent`);

--
-- Indexes for table `tbl_user_log`
--
ALTER TABLE `tbl_user_log`
 ADD PRIMARY KEY (`id_logs`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_agent`
--
ALTER TABLE `tbl_agent`
MODIFY `id_agent` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_anggota_keluarga`
--
ALTER TABLE `tbl_anggota_keluarga`
MODIFY `id_anggota_keluarga` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_captcha`
--
ALTER TABLE `tbl_captcha`
MODIFY `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `tbl_cara_pembayaran`
--
ALTER TABLE `tbl_cara_pembayaran`
MODIFY `id_cara_pembayaran` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_cluster`
--
ALTER TABLE `tbl_cluster`
MODIFY `id_cluster` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_customer_dokumen`
--
ALTER TABLE `tbl_customer_dokumen`
MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_file_dokumen`
--
ALTER TABLE `tbl_file_dokumen`
MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
MODIFY `id_gallery` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_kartu_keluarga`
--
ALTER TABLE `tbl_kartu_keluarga`
MODIFY `id_kartu_keluarga` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
MODIFY `id_news` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_nup`
--
ALTER TABLE `tbl_nup`
MODIFY `id_nup` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_pemesanan`
--
ALTER TABLE `tbl_pemesanan`
MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_promo`
--
ALTER TABLE `tbl_promo`
MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_siteplan`
--
ALTER TABLE `tbl_siteplan`
MODIFY `id_siteplan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_timeout`
--
ALTER TABLE `tbl_timeout`
MODIFY `id_timeout` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=350;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tbl_user_log`
--
ALTER TABLE `tbl_user_log`
MODIFY `id_logs` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
