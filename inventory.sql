-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07 Feb 2016 pada 09.22
-- Versi Server: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agama`
--

CREATE TABLE `agama` (
  `id_agama` bigint(20) NOT NULL,
  `nama_agama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `agama`
--

INSERT INTO `agama` (`id_agama`, `nama_agama`) VALUES
(1, 'ISLAM'),
(2, 'PROTESTAN'),
(3, 'KATOLIK'),
(4, 'HINDU'),
(5, 'BUDHA'),
(6, 'KONGHUCHU'),
(7, 'LAIN-LAIN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `kode_barang` varchar(20) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `deskripsi` varchar(200) DEFAULT NULL,
  `is_deleted` varchar(2) DEFAULT '0' COMMENT '1= Ya'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `id_satuan`, `kode_barang`, `nama_barang`, `merk`, `deskripsi`, `is_deleted`) VALUES
(1, 6, '1', 'HVS', 'Sinar Dunia', '[""]', '0'),
(2, 6, '2', 'CB White Ukuran 24,1 dan 37,8 ', '', '[""]', '0'),
(3, 3, '3', 'CFB Putih Ukuran 24,1 dan 37,8 ', '', '[""]', '0'),
(4, 3, '4', 'CFB Merah Ukuran 24,1 dan 37,8', '', '[""]', '0'),
(5, 3, '5', 'CFB Kuning Ukuran 24,1 dan 37,8', NULL, '[""]', '0'),
(6, 3, '6', 'CFB Hijau Ukuran 24,1 dan 37,8', NULL, '[""]', '0'),
(7, 3, '7', 'CFB Biru Ukuran 24,1 dan 37,8', NULL, '[""]', '0'),
(8, 3, '8', 'CF Putih Ukuran 24,1 dan 37,8', NULL, '[""]', '0'),
(9, 3, '9', 'CF Merah Ukuran 24,1 dan 37,8', NULL, '[""]', '0'),
(10, 3, '10', 'CF Kuning Ukuran 24,1 dan 37,8', NULL, '[""]', '0'),
(11, 3, '11', 'CF Hijau Ukuran 24,1 dan 37,8', NULL, '[""]', '0'),
(12, 3, '12', 'CF Biru Ukuran 24,1 dan 37,8', NULL, '[""]', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_jadi`
--

CREATE TABLE `barang_jadi` (
  `id_barang_jadi` int(11) NOT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `kode_barang_jadi` varchar(20) DEFAULT NULL,
  `nama_barang_jadi` varchar(50) DEFAULT NULL,
  `harga` varchar(20) DEFAULT NULL,
  `deskripsi` varchar(200) DEFAULT NULL,
  `is_delected` varchar(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_jadi`
--

INSERT INTO `barang_jadi` (`id_barang_jadi`, `id_satuan`, `kode_barang_jadi`, `nama_barang_jadi`, `harga`, `deskripsi`, `is_delected`) VALUES
(124, 6, '1', 'Depaper K1', '100000', '', '0'),
(125, 6, '2', 'Depaper K1 PRS', '100000', '', '0'),
(126, 6, '3', 'Depaper K2', '100000', '', '0'),
(127, 6, '4', 'Depaper K2 PP', '100001', '[""]', '0'),
(128, 6, '5', 'Depaper K2 PRS', '100000', '', '0'),
(129, 6, '6', 'Depaper K2 PRS PP', '100000', '', '0'),
(130, 6, '7', 'Depaper K3', '100000', '', '0'),
(131, 6, '8', 'Depaper K3 PP', '100000', '', '0'),
(132, 6, '9', 'Depaper K3 PRS', '100000', '', '0'),
(133, 6, '10', 'Depaper K3 PRS PP', '100000', '', '0'),
(134, 6, '11', 'Depaper K4', '100000', '', '0'),
(135, 6, '12', 'Depaper K4 PP', '100000', '', '0'),
(136, 6, '13', 'Depaper K4 PRS', '100000', '', '0'),
(137, 6, '14', 'Depaper K4 PRS PP', '100000', '', '0'),
(138, 6, '15', 'Depaper K5', '100000', '', '0'),
(139, 6, '16', 'Depaper K5 PP', '100000', '', '0'),
(140, 6, '17', 'Depaper K5 PRS', '100000', '', '0'),
(141, 6, '18', 'Depaper K5 PRS PP', '100000', '', '0'),
(142, 6, '19', 'Depaper K6', '100000', '', '0'),
(143, 6, '20', 'Depaper K6 PRS', '100000', '', '0'),
(144, 6, '21', 'Depaper K1 Wartel', '100000', '', '0'),
(145, 6, '22', 'DepaperK2 Wartel', '100000', '', '0'),
(146, 6, '23', 'Depaper K3 Wartel', '100000', '', '0'),
(147, 6, '24', 'Depaper K4 Wartel', '100000', '', '0'),
(148, 6, '25', 'Depaper B1', '100000', '', '0'),
(149, 6, '26', 'Depaper B2', '100000', '', '0'),
(150, 6, '27', 'Depaper B2 PP', '100000', '', '0'),
(151, 6, '28', 'Depaper B3', '100000', '', '0'),
(152, 6, '29', 'Depaper B3 PP', '100000', '', '0'),
(153, 6, '30', 'Depaper B4', '100000', '', '0'),
(154, 6, '31', 'Depaper B4 PP', '100000', '', '0'),
(155, 6, '32', 'Depaper B5', '100000', '', '0'),
(156, 6, '33', 'Depaper K1 : 3', '100000', '', '0'),
(157, 6, '34', 'Depaper K1 : 4', '100000', '', '0'),
(159, 6, '35', 'Sinar Mentari K1', '100000', '', '0'),
(160, 6, '36', 'Sinar Mentari K1 PRS', '100000', '', '0'),
(161, 6, '37', 'Sinar Mentari K2', '100000', '', '0'),
(162, 6, '38', 'Sinar Mentari K2 PP', '100000', '', '0'),
(163, 6, '39', 'Sinar Mentari K2 PRS', '100000', '', '0'),
(164, 6, '40', 'Sinar Mentari K2 PRS PP', '100000', '', '0'),
(165, 6, '41', 'Sinar Mentari K3', '100000', '', ''),
(166, 6, '42', 'Sinar Mentari K3 PP', '100000', '', '0'),
(167, 6, '43', 'Sinar Mentari K3 PRS', '100000', '', '0'),
(168, 6, '44', 'Sinar Mentari K3 PRS PP', '100000', '', '0'),
(169, 6, '45', 'Sinar Mentari K4', '100000', '', '0'),
(170, 6, '46', 'Sinar Mentari K4 PP', '100000', '', '0'),
(171, 6, '47', 'Sinar Mentari K4 PRS', '100000', '', '0'),
(172, 6, '48', 'Sinar Mentari K4 PRS PP', '100000', '', '0'),
(173, 6, '49', 'Sinar Mentari K5', '100000', '', '0'),
(174, 6, '50', 'Sinar Mentari K5 PP', '100000', '', '0'),
(175, 6, '51', 'Sinar Mentari K5 PRS', '100000', '', '0'),
(176, 6, '52', 'Sinar Mentari K5 PRS PP', '100000', '[""]', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_saldo`
--

CREATE TABLE `barang_saldo` (
  `id_barang_saldo` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `kode_saldo` varchar(20) DEFAULT NULL,
  `tgl_saldo` date NOT NULL,
  `jumlah_saldo` varchar(6) NOT NULL,
  `is_deleted` varchar(2) DEFAULT '0',
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_stok`
--

CREATE TABLE `barang_stok` (
  `id_barang_stok` int(11) NOT NULL,
  `id_tanda_terima` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah_stok` int(11) DEFAULT NULL,
  `harga_satuan` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `id_kota` bigint(20) NOT NULL,
  `id_propinsi` bigint(20) DEFAULT NULL,
  `nama_kota` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`id_kota`, `id_propinsi`, `nama_kota`) VALUES
(1, 1, 'ACEH SELATAN'),
(2, 1, 'ACEH TENGGARA'),
(3, 1, 'ACEH TIMUR'),
(4, 1, 'ACEH TENGAH'),
(5, 1, 'ACEH BARAT'),
(6, 1, 'ACEH BESAR'),
(7, 1, 'PIDIE'),
(8, 1, 'ACEH UTARA'),
(9, 1, 'BIREUEN'),
(10, 1, 'ACEH SINGKIL'),
(11, 1, 'SIMEULUE'),
(12, 1, 'ACEH NAGAN RAYA'),
(13, 1, 'BANDA ACEH'),
(14, 1, 'SABANG'),
(15, 1, 'LHOKSEUMAWE'),
(16, 1, 'LANGSA'),
(17, 2, 'NIAS'),
(18, 2, 'TAPANULI SELATAN'),
(19, 2, 'TAPANULI TENGAH'),
(20, 2, 'TAPANULI UTARA'),
(21, 2, 'LABUHANBATU'),
(22, 2, 'ASAHAN'),
(23, 2, 'SIMALUNGUN'),
(24, 2, 'DAIRI'),
(25, 2, 'KARO'),
(26, 2, 'DELI SERDANG'),
(27, 2, 'LANGKAT'),
(28, 2, 'TOBA SAMOSIR'),
(29, 2, 'MANDAILING NATAL'),
(30, 2, 'SIBOLGA'),
(31, 2, 'TANJUNG BALAI'),
(32, 2, 'PEMATANG SIANTAR'),
(33, 2, 'TEBING TINGGI'),
(34, 2, 'MEDAN'),
(35, 2, 'BINJAI'),
(36, 2, 'PADANG SIDEMPUAN'),
(37, 3, 'PESISIR SELATAN'),
(38, 3, 'SOLOK'),
(39, 3, 'SAWAH LUNTO'),
(40, 3, 'TANAH DATAR'),
(41, 3, 'PADANG PARIAMAN'),
(42, 3, 'AGAM'),
(43, 3, 'LIMA PULUH KOTA'),
(44, 3, 'PASAMAN'),
(45, 3, 'KEPULAUAN MENTAWAI'),
(46, 3, 'PADANG'),
(47, 3, 'SOLOK'),
(48, 3, 'SAWAHLUNTO'),
(49, 3, 'PADANG PANJANG'),
(50, 3, 'BUKITTINGGI'),
(51, 3, 'PAYAKUMBUH'),
(52, 3, 'PARIAMAN'),
(53, 4, 'INDRAGIRI HULU'),
(54, 4, 'INDRAGIRI HILIR'),
(55, 4, 'KEPULAUAN RIAU'),
(56, 4, 'KAMPAR'),
(57, 4, 'BENGKALIS'),
(58, 10, 'KARIMUN'),
(59, 4, 'KUANTAN SINGING'),
(60, 10, 'NATUNA'),
(61, 4, 'SIAK'),
(62, 4, 'ROKAN HILIR'),
(63, 4, 'ROKAN HULU'),
(64, 4, 'PELALAWAN'),
(65, 4, 'PEKANBARU'),
(66, 10, 'BATAM'),
(67, 4, 'DUMAI'),
(68, 10, 'TANJUNG PINANG'),
(69, 5, 'KERINCI'),
(70, 5, 'BATANGHARI'),
(71, 5, 'SAROLANGUN'),
(72, 5, 'MERANGIN'),
(73, 5, 'TANJUNG JABUNG TIMUR'),
(74, 5, 'TANJUNG JABUNG BARAT'),
(75, 5, 'MUARA JAMBI'),
(76, 5, 'BUNGO'),
(77, 5, 'TEBO'),
(78, 5, 'JAMBI'),
(79, 6, 'OGAN KOMERING ULU'),
(80, 6, 'OGAN KOMERING ILIR'),
(81, 6, 'MUARA ENIM'),
(82, 6, 'LAHAT'),
(83, 6, 'MUSI RAWAS'),
(84, 6, 'MUSI BANYUASIN'),
(85, 6, 'PALEMBANG'),
(86, 6, 'PRABUMULIH'),
(87, 6, 'PAGAR ALAM'),
(88, 6, 'LUBUK LINGGAU'),
(89, 7, 'BENGKULU SELATAN'),
(90, 7, 'REJANG LEBONG'),
(91, 7, 'BENGKULU UTARA'),
(92, 7, 'BENGKULU'),
(93, 8, 'LAMPUNG SELATAN'),
(94, 8, 'LAMPUNG TENGAH'),
(95, 8, 'LAMPUNG UTARA'),
(96, 8, 'LAMPUNG BARAT'),
(97, 8, 'TANGGAMUS'),
(98, 8, 'TULANG BAWANG'),
(99, 8, 'LAMPUNG TIMUR'),
(100, 8, 'WAY KANAN'),
(101, 8, 'BANDAR LAMPUNG'),
(102, 8, 'METRO'),
(103, 9, 'BANGKA'),
(104, 9, 'BELITUNG'),
(105, 9, 'PANGKAL PINANG'),
(106, 16, 'PANDEGLANG'),
(107, 16, 'LEBAK'),
(108, 16, 'TANGERANG'),
(109, 16, 'SERANG'),
(111, 16, 'CILEGON'),
(112, 11, 'JAKARTA SELATAN'),
(113, 11, 'JAKARTA TIMUR'),
(114, 11, 'JAKARTA PUSAT'),
(115, 11, 'JAKARTA BARAT'),
(116, 11, 'JAKARTA UTARA'),
(117, 12, 'BOGOR'),
(118, 12, 'SUKABUMI'),
(119, 12, 'CIANJUR'),
(120, 12, 'BANDUNG'),
(121, 12, 'GARUT'),
(122, 12, 'TASIKMALAYA'),
(123, 12, 'CIAMIS'),
(124, 12, 'KUNINGAN'),
(125, 12, 'CIREBON'),
(126, 12, 'MAJALENGKA'),
(127, 12, 'SUMEDANG'),
(128, 12, 'INDRAMAYU'),
(129, 12, 'SUBANG'),
(130, 12, 'PURWAKARTA'),
(131, 12, 'KERAWANG'),
(132, 12, 'BEKASI'),
(133, 12, 'BOGOR'),
(134, 12, 'SUKABUMI'),
(135, 12, 'BANDUNG'),
(136, 12, 'CIREBON'),
(137, 12, 'BEKASI'),
(138, 12, 'DEPOK'),
(139, 12, 'CIMAHI'),
(140, 12, 'TASIKMALAYA'),
(141, 13, 'CILACAP'),
(142, 13, 'BANYUMAS'),
(143, 13, 'PURBALINGGA'),
(144, 13, 'BANJARNEGARA'),
(145, 13, 'KEBUMEN'),
(146, 13, 'PURWOREJO'),
(147, 13, 'WONOSOBO'),
(148, 13, 'MAGELANG'),
(149, 13, 'BOYOLALI'),
(150, 13, 'KLATEN'),
(151, 13, 'SUKOHARJO'),
(152, 13, 'WONOGIRI'),
(153, 13, 'KARANGANYAR'),
(154, 13, 'SRAGEN'),
(155, 13, 'GROBOGAN'),
(156, 13, 'BLORA'),
(157, 13, 'REMBANG'),
(158, 13, 'PATI'),
(159, 13, 'KUDUS'),
(160, 13, 'JEPARA'),
(161, 13, 'DEMAK'),
(162, 13, 'SEMARANG'),
(163, 13, 'TEMANGGUNG'),
(164, 13, 'KENDAL'),
(165, 13, 'BATANG'),
(166, 13, 'PEKALONGAN'),
(167, 13, 'PEMALANG'),
(168, 13, 'TEGAL'),
(169, 13, 'BREBES'),
(170, 13, 'MAGELANG'),
(171, 13, 'SURAKARTA'),
(172, 13, 'SALATIGA'),
(173, 13, 'SEMARANG'),
(174, 13, 'PEKALONGAN'),
(175, 13, 'TEGAL'),
(176, 14, 'KULONPROGO'),
(177, 14, 'BANTUL'),
(178, 14, 'GUNUNG KIDUL'),
(179, 14, 'SLEMAN'),
(180, 14, 'YOGYAKARTA'),
(181, 15, 'PACITAN'),
(182, 15, 'PONOROGO'),
(183, 15, 'TRENGGALEK'),
(184, 15, 'TULUNGAGUNG'),
(185, 15, 'BLITAR'),
(186, 15, 'KEDIRI'),
(187, 15, 'MALANG'),
(188, 15, 'LUMAJANG'),
(189, 15, 'JEMBER'),
(190, 15, 'BANYUWANGI'),
(191, 15, 'BONDOWOSO'),
(192, 15, 'SITUBONDO'),
(193, 15, 'PROBOLINGGO'),
(194, 15, 'PASURUAN'),
(195, 15, 'SIDOARJO'),
(196, 15, 'MOJOKERTO'),
(197, 15, 'JOMBANG'),
(198, 15, 'NGANJUK'),
(199, 15, 'MADIUN'),
(200, 15, 'MAGETAN'),
(201, 15, 'NGAWI'),
(202, 15, 'BOJONEGORO'),
(203, 15, 'TUBAN'),
(204, 15, 'LAMONGAN'),
(205, 15, 'GRESIK'),
(206, 15, 'BANGKALAN'),
(207, 15, 'SAMPANG'),
(208, 15, 'PAMEKASAN'),
(209, 15, 'SUMENEP'),
(210, 15, 'KEDIRI'),
(211, 15, 'BLITAR'),
(212, 15, 'MALANG'),
(213, 15, 'PROBOLINGGO'),
(214, 15, 'PASURUAN'),
(215, 15, 'MOJOKERTO'),
(216, 15, 'MADIUN'),
(217, 15, 'SURABAYA'),
(218, 15, 'BATU'),
(219, 17, 'JEMBRANA'),
(220, 17, 'TABANAN'),
(221, 17, 'BADUNG'),
(222, 17, 'GIANYAR'),
(223, 17, 'KLUNGKUNG'),
(224, 17, 'BANGLI'),
(225, 17, 'KARANG ASEM'),
(226, 17, 'BULELENG'),
(227, 17, 'DENPASAR'),
(228, 18, 'LOMBOK BARAT'),
(229, 18, 'LOMBOK TENGAH'),
(230, 18, 'LOMBOK TIMUR'),
(231, 18, 'SUMBAWA'),
(232, 18, 'DOMPU'),
(233, 18, 'BIMA'),
(234, 18, 'MATARAM'),
(235, 18, 'BIMA'),
(236, 19, 'SUMBA BARAT'),
(237, 19, 'SUMBA TIMUR'),
(238, 19, 'KUPANG'),
(239, 19, 'TIMOR TENGAH SELATAN'),
(240, 19, 'TIMOR TENGAH UTARA'),
(241, 19, 'BELU'),
(242, 19, 'ALOR'),
(243, 19, 'FLORES TIMUR'),
(244, 19, 'SIKKA'),
(245, 19, 'ENDE'),
(246, 19, 'NGADA'),
(247, 19, 'MANGGARAI'),
(248, 19, 'LEMBATA'),
(249, 19, 'KUPANG'),
(250, 20, 'SAMBAS'),
(251, 20, 'PONTIANAK'),
(252, 20, 'SANGGAU'),
(253, 20, 'KETAPANG'),
(254, 20, 'SINTANG'),
(255, 20, 'KAPUAS HULU'),
(256, 20, 'BENGKAYANG'),
(257, 20, 'LANDAK'),
(258, 20, 'PONTIANAK'),
(259, 20, 'SINGKAWANG'),
(260, 21, 'KOTAWARINGIN BARAT'),
(261, 21, 'KOTAWARINGIN TIMUR'),
(262, 21, 'KAPUAS'),
(263, 21, 'BARITO SELATAN'),
(264, 21, 'BARITO UTARA'),
(265, 21, 'GUNUNG MAS'),
(266, 21, 'PALANGKARAYA'),
(267, 22, 'TANAH LAUT'),
(268, 22, 'KOTABARU'),
(269, 22, 'BANJAR'),
(270, 22, 'BARITO KUALA'),
(271, 22, 'TAPIN'),
(272, 22, 'HULU SUNGAI SELATAN'),
(273, 22, 'HULU SUNGAI TENGAH'),
(274, 22, 'HULU SUNGAI UTARA'),
(275, 22, 'TABALONG'),
(276, 22, 'BANJARMASIN'),
(277, 22, 'BANJARBARU'),
(278, 23, 'PASER'),
(279, 23, 'KUTAI KARTANEGARA'),
(280, 23, 'BERAU'),
(281, 23, 'BULUNGAN'),
(282, 23, 'NUNUKAN'),
(283, 23, 'KUTAI TIMUR'),
(284, 23, 'MALINAU'),
(285, 23, 'KUTAI BARAT'),
(286, 23, 'BALIKPAPAN'),
(287, 23, 'SAMARINDA'),
(288, 23, 'TARAKAN'),
(289, 23, 'BONTANG'),
(290, 28, 'GORONTALO'),
(291, 28, 'BOALEMO'),
(292, 28, 'BONEBOLANGO'),
(293, 28, 'GORONTALO'),
(294, 24, 'BOLAANG MONGONDOW'),
(295, 24, 'MINAHASA'),
(296, 24, 'SANGIHE'),
(297, 24, 'KEPL. TALAUD'),
(298, 24, 'MANADO'),
(299, 24, 'BITUNG'),
(300, 25, 'POSO'),
(301, 25, 'DONGGALA'),
(302, 25, 'BANGGAI KEPULAUAN'),
(303, 25, 'BANGGAI'),
(304, 25, 'BUOL'),
(305, 25, 'TOLI TOLI'),
(306, 25, 'MOROWALI'),
(307, 25, 'PARIGI MUOTONG'),
(308, 25, 'PALU'),
(309, 26, 'SELAYAR'),
(310, 26, 'BULUKUMBA'),
(311, 26, 'BANTAENG'),
(312, 26, 'JENEPONTO'),
(313, 26, 'TAKALAR'),
(314, 26, 'GOWA'),
(315, 26, 'SINJAI'),
(316, 26, 'BONE'),
(317, 26, 'MAROS'),
(318, 26, 'PANGKAJENE KEPULAUAN'),
(319, 26, 'BARRU'),
(320, 26, 'SOPPENG'),
(321, 26, 'WAJO'),
(322, 26, 'SIDENRENG RAPPANG'),
(323, 26, 'PINRANG'),
(324, 26, 'ENREKANG'),
(325, 26, 'LUWU'),
(326, 26, 'TANA TORAJA'),
(327, 29, 'POLEWALI'),
(328, 26, 'MAJENE'),
(329, 29, 'MAMUJU'),
(330, 26, 'LUWU UTARA'),
(331, 26, 'MAKASAR'),
(332, 26, 'PARE PARE'),
(333, 26, 'PALOPO'),
(334, 27, 'BUTON'),
(335, 27, 'MUNA'),
(336, 27, 'KONAWE'),
(337, 27, 'KOLAKA'),
(338, 27, 'KENDARI'),
(339, 27, 'BAU-BAU'),
(340, 30, 'MALUKU TENGGARA'),
(341, 30, 'MALUKU TENGAH'),
(342, 30, 'BURU'),
(343, 30, 'MALUKU TENGGARA BARAT'),
(344, 30, 'AMBON'),
(345, 31, 'MALUKU UTARA'),
(346, 31, 'HALMAHERA TENGAH'),
(347, 31, 'TERNATE'),
(348, 33, 'JAYA PURA'),
(349, 33, 'JAYAWIJAYA'),
(350, 33, 'PUNCAK JAYA'),
(351, 33, 'MARAUKE'),
(352, 33, 'JAYAPURA'),
(353, 32, 'SORONG'),
(354, 32, 'MANOKWARI'),
(355, 32, 'FAK-FAK'),
(356, 32, 'SORONG'),
(357, 1, 'GAYO LUAS'),
(358, 18, 'AMPENAN'),
(360, 21, 'MUARATEWEH'),
(361, 17, 'SINGARAJA'),
(502, 33, 'KEPULAUAN YAPEN'),
(505, 29, 'MAJENE'),
(506, 28, 'GORONTALO UTARA'),
(545, 20, 'MALAWI'),
(546, 20, 'SINGKANG'),
(553, 33, 'BIAK NUMFOR'),
(563, 33, 'NABIRE'),
(568, 1, 'BENER MERIAH'),
(574, 16, 'SERANG'),
(575, 16, 'TANGERANG SELATAN'),
(576, 5, 'SUNGAI PENUH'),
(577, 12, 'BANJAR'),
(578, 20, 'KUBU RAYA'),
(579, 22, 'TANAH BUMBU'),
(580, 21, 'BARITO TIMUR'),
(581, 21, 'KATINGAN'),
(582, 31, 'HALMAHERA BARAT'),
(583, 31, 'HALMAHERA SELATAN'),
(584, 31, 'HALMAHERA TIMUR'),
(585, 31, 'HALMAHERA UTARA'),
(587, 7, 'KAUR'),
(588, 7, 'KEPAHIANG'),
(589, 7, 'LEBONG'),
(590, 7, 'MUKO-MUKO'),
(591, 7, 'SELUMA'),
(592, 11, 'KEPULAUAN SERIBU'),
(593, 28, 'POHUWATO'),
(594, 12, 'BANDUNG BARAT'),
(595, 20, 'KAYONG UTARA'),
(596, 20, 'SEKADAU'),
(597, 22, 'BALANGAN'),
(598, 21, 'LAMANDAU'),
(599, 21, 'MURUNG RAYA'),
(600, 21, 'PULANG PISAU'),
(601, 21, 'SERUYAN'),
(602, 21, 'SUKAMARA'),
(603, 23, 'PENAJAM PASER UTARA'),
(604, 23, 'TANA TIDUNG'),
(605, 9, 'BANGKA BARAT'),
(606, 9, 'BANGKA SELATAN'),
(607, 9, 'BANGKA TENGAH'),
(608, 9, 'BELITUNG TIMUR'),
(609, 10, 'BINTAN'),
(610, 10, 'KEPULAUAN ANAMBAS'),
(611, 10, 'LINGGA'),
(612, 8, 'PESAWARAN'),
(613, 8, 'PRINGSEWU'),
(614, 30, 'KEPULAUAN ARU'),
(615, 30, 'SERAM BAGIAN BARAT'),
(616, 30, 'SERAM BAGIAN TIMUR'),
(617, 31, 'KEPULAUAN SULA'),
(618, 31, 'TIDORE KEPULAUAN'),
(619, 1, 'ACEH BARAT DAYA'),
(620, 1, 'ACEH JAYA'),
(621, 1, 'ACEH TAMIANG'),
(622, 1, 'SUBULUSSALAM'),
(623, 18, 'SUMBAWA BARAT'),
(624, 19, 'MANGGARAI BARAT'),
(625, 19, 'MANGGARAI TIMUR'),
(626, 19, 'NAGEKEO'),
(627, 19, 'ROTE NDAO'),
(628, 19, 'SUMBA TENGAH'),
(629, 33, 'ASMAT'),
(630, 33, 'BOVEN DIGUL'),
(631, 33, 'DOGIYAI'),
(632, 33, 'INTAN JAYA'),
(633, 33, 'KEEROM'),
(634, 33, 'LANNY JAYA'),
(635, 33, 'MAMBERAMO TENGAH'),
(636, 33, 'MAPPI'),
(637, 33, 'MIMIKA'),
(638, 33, 'NDUGA'),
(639, 33, 'PANIAI'),
(640, 33, 'PEGUNUNGAN BINTANG'),
(641, 33, 'PUNCAK'),
(642, 33, 'SARMI'),
(643, 33, 'SUPIORI'),
(644, 33, 'TOLIKARA'),
(645, 33, 'WAROPEN'),
(646, 33, 'YAHUKIMO'),
(647, 33, 'YALIMO'),
(648, 32, 'KAIMANA'),
(649, 32, 'RAJA AMPAT'),
(650, 32, 'SORONG SELATAN'),
(651, 32, 'TELUK BINTUNI'),
(652, 32, 'TELUK WONDAMA'),
(653, 29, 'MAMASA'),
(654, 29, 'MAMUJU UTARA'),
(655, 26, 'LUWU TIMUR'),
(656, 25, 'SIGI'),
(657, 25, 'TOJO UNA-UNA'),
(658, 27, 'BOMBANA'),
(659, 27, 'BUTON UTARA'),
(660, 27, 'KOLAKA UTARA'),
(661, 27, 'KONAWE SELATAN'),
(662, 27, 'KONAWE UTARA'),
(663, 27, 'WAKATOBI'),
(664, 24, 'BOLAANG MONGONDOW UTARA'),
(665, 24, 'KEPL. SITARO'),
(666, 24, 'MINAHASA SELATAN'),
(667, 24, 'MINAHASA TENGGARA'),
(668, 24, 'MINAHASA UTARA'),
(669, 24, 'KOTAMOBAGU'),
(670, 24, 'TOMOHON'),
(671, 3, 'DHARMASRAYA'),
(672, 3, 'PASAMAN BARAT'),
(673, 3, 'SIJUNJUNG'),
(674, 3, 'SOLOK SELATAN'),
(675, 6, 'BANYUASIN'),
(676, 6, 'EMPAT LAWANG'),
(677, 6, 'OGAN ILIR'),
(678, 6, 'OKU SELATAN'),
(679, 6, 'OKU TIMUR'),
(680, 2, 'BATUBARA'),
(681, 2, 'HUMBANG HASUNDUTAN'),
(682, 2, 'LABUHANBATU SELATAN'),
(683, 2, 'LABUHANBATU UTARA'),
(684, 2, 'NIAS SELATAN'),
(685, 2, 'PADANG LAWAS'),
(686, 2, 'PADANG LAWAS UTARA'),
(687, 2, 'PAKPAK BHARAT'),
(688, 2, 'SAMOSIR'),
(689, 2, 'SERDANG BEDAGAI'),
(690, 2, 'GUNUNG SITOLI'),
(692, 27, 'KENDARI'),
(693, 26, 'MAMUJU'),
(694, 26, 'POLEWALI MAMASA'),
(696, 21, 'TAMIANG LAYANG'),
(697, 21, 'SAMPIT'),
(43211, 13, 'SOLO');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` bigint(20) NOT NULL,
  `id_parent_menu` bigint(20) DEFAULT NULL,
  `label` varchar(50) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `order` bigint(20) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `menu_type` varchar(2) DEFAULT NULL COMMENT '1=System, 2=Jadi, 3=mentah'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `id_parent_menu`, `label`, `url`, `order`, `icon`, `menu_type`) VALUES
(1, 0, 'Setting ', 'setting', 1, 'fa-gears', '1'),
(5, 1, 'Menu', 'setting/menu/read', 4, '', '1'),
(7, 0, 'Master', 'master/', 2, 'fa-database', '1'),
(8, 7, 'Satuan', 'master/satuan/read', 1, '', '1'),
(9, 7, 'Supplier', 'master/supplier/read', 2, '', '1'),
(10, 7, 'Bahan Baku', 'master/barang/read', 4, '', '1'),
(11, 0, 'Permintaan Bahan Baku', 'permintaan_barang', 1, 'fa-sign-in', '2'),
(12, 11, 'Data Formulir', 'permintaan_barang/baru/read', 1, '', '2'),
(13, 11, 'Validasi', 'permintaan_barang/baru/readPersetujuan', 2, '', '2'),
(14, 0, 'Purchasing Order (PO)', 'puchasing-order', 2, 'fa-shopping-cart', '2'),
(15, 14, 'Data', 'purchasing_order/data/read', 1, '', '2'),
(26, 0, 'Tanda Terima', 'tanda_terima', 3, 'fa-check-square-o', '2'),
(30, 14, 'Validasi', 'purchasing_order/data/readPersetujuan', 2, '', '2'),
(31, 26, 'Dari PO', 'tanda_terima/po/read', 1, '', ''),
(33, 0, 'Barang Mentah', 'barang_mentah/data/read', 5, 'fa-database', '2'),
(34, 0, 'Produksi', 'Produksi', 6, 'fa-recycle', '2'),
(35, 34, 'Data Formulir', 'produksi/baru/read', 1, NULL, '2'),
(36, 34, 'Validasi', 'produksi/baru/readPersetujuan', 2, NULL, '2'),
(37, 0, 'Barang Jadi', 'barang_jadi/data/read', 7, 'fa-database', '2'),
(38, 7, 'Data Barang', 'master/barangjadi/read', 5, '', '2'),
(39, 0, 'Penjualan', 'penjualan/data/read', 8, 'fa-paper-plane', '2'),
(40, 1, 'User', 'setting/user/read', 5, NULL, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `negara`
--

CREATE TABLE `negara` (
  `id_negara` bigint(20) NOT NULL,
  `nama_negara` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `negara`
--

INSERT INTO `negara` (`id_negara`, `nama_negara`) VALUES
(114, 'INDONESIA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_unit_kerja` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `nama_pegawai` varchar(150) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat_lahir` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengambilan_barang`
--

CREATE TABLE `pengambilan_barang` (
  `id_pengambilan_barang` int(11) NOT NULL,
  `kode_sistem` varchar(20) NOT NULL,
  `nomor_pengambilan` varchar(30) DEFAULT NULL,
  `tgl_pengambilan` date DEFAULT NULL,
  `waktu_sistem` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_peg_gudang` int(11) DEFAULT NULL,
  `id_peg_pj` int(11) DEFAULT NULL,
  `is_saved` varchar(2) DEFAULT '0',
  `is_deleted` varchar(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengambilan_barang`
--

INSERT INTO `pengambilan_barang` (`id_pengambilan_barang`, `kode_sistem`, `nomor_pengambilan`, `tgl_pengambilan`, `waktu_sistem`, `id_peg_gudang`, `id_peg_pj`, `is_saved`, `is_deleted`) VALUES
(28, '00000000001', '23132', '2016-01-07', '2016-01-07 09:39:40', NULL, NULL, '1', '0'),
(29, '00000000002', NULL, NULL, '2016-01-07 11:30:09', NULL, NULL, '0', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengambilan_barang_detail`
--

CREATE TABLE `pengambilan_barang_detail` (
  `id_pengambilan_barang_detail` int(11) NOT NULL,
  `id_pengambilan_barang` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah_ambil` varchar(5) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `is_deleted` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengambilan_barang_detail`
--

INSERT INTO `pengambilan_barang_detail` (`id_pengambilan_barang_detail`, `id_pengambilan_barang`, `id_barang`, `jumlah_ambil`, `keterangan`, `is_deleted`) VALUES
(3, 28, 1, '150', 'dfwewsf', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `kode_sistem` varchar(10) NOT NULL,
  `nomor_penjualan` varchar(30) DEFAULT NULL,
  `nama_pembeli` varchar(30) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `waktu_sistem` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_penjualan` date DEFAULT NULL,
  `tgl_on_site` date DEFAULT NULL,
  `status_kirim` varchar(2) DEFAULT '0',
  `status_jual` varchar(2) DEFAULT NULL COMMENT '1 = Eceran, 2 = Grosir',
  `id_peg_apv` int(20) DEFAULT NULL,
  `is_saved` varchar(2) NOT NULL DEFAULT '0',
  `is_deleted` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `kode_sistem`, `nomor_penjualan`, `nama_pembeli`, `alamat`, `waktu_sistem`, `tgl_penjualan`, `tgl_on_site`, `status_kirim`, `status_jual`, `id_peg_apv`, `is_saved`, `is_deleted`) VALUES
(6, '0000000001', '1', 'ahmad mustofa', '12q', '2016-01-07 09:46:03', '2016-01-07', '2016-01-07', '0', NULL, NULL, '1', '0'),
(13, '0000000002', '21', 'dasd', NULL, '2016-01-08 10:49:46', '2016-01-08', '2016-01-08', '0', NULL, NULL, '1', '0'),
(15, '0000000003', '1234', 'asd', '1dwsasa', '2016-01-08 10:50:56', '2016-01-08', '2016-01-08', '0', NULL, NULL, '1', '0'),
(16, '0000000004', '1', 'alsdfl', 'adfcasc', '2016-01-11 16:48:45', '2016-01-11', '2016-01-11', '0', NULL, NULL, '1', '0'),
(17, '0000000005', '123', 'achmad', 'sirabaya', '2016-01-12 10:42:23', '2016-01-12', '2016-01-12', '0', NULL, NULL, '1', '0'),
(20, '0000000006', '123456', NULL, NULL, '2016-01-13 07:17:55', NULL, NULL, '0', '1', NULL, '1', '1'),
(21, '0000000007', '12345', 'nasd', 'dwfd', '2016-01-13 12:37:47', '2016-01-13', NULL, '0', '2', NULL, '1', '0'),
(25, '0000000008', '12349876', 'dtfyghjk', 'huj', '2016-01-14 11:28:09', '2016-01-14', NULL, '0', '2', NULL, '1', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id_penjualan_detail` int(11) NOT NULL,
  `id_penjualan` int(11) DEFAULT NULL,
  `id_barang_jadi` int(11) DEFAULT NULL,
  `jumlah_barang` varchar(10) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `is_deleted` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id_penjualan_detail`, `id_penjualan`, `id_barang_jadi`, `jumlah_barang`, `keterangan`, `is_deleted`) VALUES
(6, 6, NULL, '150', 'gferdg', '0'),
(15, 6, 159, '234', 'sdgf', '0'),
(16, 16, 157, '100', 'incunrcu', '0'),
(17, 17, 124, '100', 'ihihie', '0'),
(18, 21, 142, '100', 'nin', '0'),
(19, 25, 124, '1000', 'iehfihrnf', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan_barang`
--

CREATE TABLE `permintaan_barang` (
  `id_permintaan_barang` int(11) NOT NULL,
  `kode_sistem` varchar(10) NOT NULL,
  `nomor_permintaan` varchar(30) DEFAULT NULL,
  `id_proyek` int(11) DEFAULT NULL,
  `waktu_sistem` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_permintaan` date DEFAULT NULL,
  `tgl_on_site` date DEFAULT NULL,
  `status_kirim` varchar(2) DEFAULT NULL,
  `id_peg_apv` int(20) DEFAULT NULL,
  `status_diterima` varchar(2) DEFAULT NULL,
  `id_peg_peminta` int(11) DEFAULT NULL,
  `is_saved` varchar(2) NOT NULL DEFAULT '0',
  `is_deleted` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `permintaan_barang`
--

INSERT INTO `permintaan_barang` (`id_permintaan_barang`, `kode_sistem`, `nomor_permintaan`, `id_proyek`, `waktu_sistem`, `tgl_permintaan`, `tgl_on_site`, `status_kirim`, `id_peg_apv`, `status_diterima`, `id_peg_peminta`, `is_saved`, `is_deleted`) VALUES
(1, '0000000001', '1', 2, '2016-01-07 09:34:47', '2016-01-07', '2016-01-06', '1', 2, NULL, NULL, '1', '0'),
(2, '0000000002', '123', NULL, '2016-01-12 10:16:47', '2016-01-13', NULL, '1', NULL, NULL, NULL, '1', '0'),
(5, '0000000003', '12345', NULL, '2016-01-13 16:05:12', '2016-01-13', NULL, '2', NULL, NULL, NULL, '1', '0'),
(6, '0000000004', '31234', NULL, '2016-01-14 11:56:01', '2016-01-14', NULL, '2', 4, NULL, NULL, '1', '0'),
(9, '0000000005', 'FPB00005', NULL, '2016-02-07 04:52:37', '2016-02-07', NULL, '1', NULL, NULL, NULL, '1', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan_barang_detail`
--

CREATE TABLE `permintaan_barang_detail` (
  `id_permintaan_barang_detail` int(11) NOT NULL,
  `id_permintaan_barang` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah_barang` varchar(10) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `is_deleted` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `permintaan_barang_detail`
--

INSERT INTO `permintaan_barang_detail` (`id_permintaan_barang_detail`, `id_permintaan_barang`, `id_barang`, `jumlah_barang`, `keterangan`, `is_deleted`) VALUES
(35, 1, 1, '500', 'Segera', '0'),
(36, 1, 11, '400', 'egrfgrtb', '0'),
(37, 2, 2, '100', 'ugyigdi', '0'),
(38, 2, 12, '200', 'ftu', '0'),
(39, 5, 34, '123', 'knknk', '1'),
(40, 5, 2, '1000', 'dfggfd', '0'),
(41, 6, 2, '1000', '', '0'),
(42, 6, 9, '1000', 'd', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(100) DEFAULT NULL,
  `alamat_perusahaan` varchar(100) DEFAULT NULL,
  `no_telephone` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nama_perusahaan`, `alamat_perusahaan`, `no_telephone`) VALUES
(1, 'PT ABC', '', NULL),
(2, 'PT BCD', NULL, NULL),
(3, 'PT VISTA', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produksi`
--

CREATE TABLE `produksi` (
  `id_produksi` int(11) NOT NULL,
  `id_barang_jadi` int(11) NOT NULL,
  `kode_sistem` varchar(10) NOT NULL,
  `nomor_produksi` varchar(30) DEFAULT NULL,
  `tgl_produksi` date DEFAULT NULL,
  `waktu_sistem` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status_produksi` varchar(2) DEFAULT NULL,
  `id_peg_apv` int(11) DEFAULT NULL,
  `jumlah_barang` varchar(30) DEFAULT NULL,
  `is_saved` varchar(2) NOT NULL DEFAULT '0',
  `is_deleted` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `id_barang_jadi`, `kode_sistem`, `nomor_produksi`, `tgl_produksi`, `waktu_sistem`, `status_produksi`, `id_peg_apv`, `jumlah_barang`, `is_saved`, `is_deleted`) VALUES
(22, 124, '0000000001', '23245', '2016-01-07', '2016-01-13 11:26:28', NULL, NULL, '100', '1', '0'),
(23, 125, '0000000002', '1234', '2016-01-12', '2016-01-12 10:39:20', NULL, 1, '300', '1', '0'),
(24, 125, '0000000003', '30202', '2016-01-13', '2016-01-13 12:32:51', NULL, 1, '100', '1', '0'),
(27, 124, '0000000004', '1234', '2016-01-14', '2016-01-14 12:04:28', NULL, 1, '100', '1', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produksi_detail`
--

CREATE TABLE `produksi_detail` (
  `id_produksi_detail` int(11) NOT NULL,
  `id_produksi` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah_ambil` varchar(5) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `is_delected` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produksi_detail`
--

INSERT INTO `produksi_detail` (`id_produksi_detail`, `id_produksi`, `id_barang`, `jumlah_ambil`, `keterangan`, `is_delected`) VALUES
(18, 22, 1, '211', 'rrredf', '0'),
(19, 23, 1, '100', 'ugudegu', '1'),
(20, 23, 1, '100', 'keteranga\r\n', '0'),
(21, 24, 1, '100', 'dfewf', '0'),
(22, 27, 2, '100', 'byhvy', '0'),
(23, 27, 9, '100', 'bubi', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `propinsi`
--

CREATE TABLE `propinsi` (
  `id_propinsi` bigint(20) NOT NULL,
  `id_negara` bigint(20) DEFAULT NULL,
  `nama_propinsi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `propinsi`
--

INSERT INTO `propinsi` (`id_propinsi`, `id_negara`, `nama_propinsi`) VALUES
(1, 114, 'NANGGROE ACEH DARUSSALAM'),
(2, 114, 'SUMATERA UTARA'),
(3, 114, 'SUMATERA BARAT'),
(4, 114, 'RIAU'),
(5, 114, 'JAMBI'),
(6, 114, 'SUMATERA SELATAN'),
(7, 114, 'BENGKULU'),
(8, 114, 'LAMPUNG'),
(9, 114, 'KEPULAUAN BANGKA BELITUNG'),
(10, 114, 'KEPULAUAN RIAU'),
(11, 114, 'DKI JAKARTA'),
(12, 114, 'JAWA BARAT'),
(13, 114, 'JAWA TENGAH'),
(14, 114, 'DI YOGYAKARTA'),
(15, 114, 'JAWA TIMUR'),
(16, 114, 'BANTEN'),
(17, 114, 'BALI'),
(18, 114, 'NUSA TENGGARA BARAT'),
(19, 114, 'NUSA TENGGARA TIMUR'),
(20, 114, 'KALIMANTAN BARAT'),
(21, 114, 'KALIMANTAN TENGAH'),
(22, 114, 'KALIMANTAN SELATAN'),
(23, 114, 'KALIMANTAN TIMUR'),
(24, 114, 'SULAWESI UTARA'),
(25, 114, 'SULAWESI TENGAH'),
(26, 114, 'SULAWESI SELATAN'),
(27, 114, 'SULAWESI TENGGARA'),
(28, 114, 'GORONTALO'),
(29, 114, 'SULAWESI BARAT'),
(30, 114, 'MALUKU'),
(31, 114, 'MALUKU UTARA'),
(32, 114, 'PAPUA BARAT'),
(33, 114, 'PAPUA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyek`
--

CREATE TABLE `proyek` (
  `id_proyek` int(11) NOT NULL,
  `nama_perusahaan` varchar(50) DEFAULT NULL,
  `nama_proyek` varchar(50) DEFAULT NULL,
  `alamat_proyek` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `proyek`
--

INSERT INTO `proyek` (`id_proyek`, `nama_perusahaan`, `nama_proyek`, `alamat_proyek`) VALUES
(2, 'PT Depaper Surabaya', 'Gudang', 'Jl.Kali Rungkut, Ruko megah Raya Blok E-16, Surabaya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchasing_order`
--

CREATE TABLE `purchasing_order` (
  `id_purchasing_order` int(11) NOT NULL,
  `kode_sistem` varchar(10) DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `nomor_po` varchar(30) DEFAULT NULL,
  `syarat_pembayaran` varchar(50) DEFAULT 'SATU BULAN',
  `waktu_sistem` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_on_site` date DEFAULT NULL,
  `jadwal_nota` varchar(50) DEFAULT 'Selasa, PKL 10.00 - 14.00 WIB',
  `alamat_pengiriman` varchar(1000) DEFAULT '<p>JAYA ARTA PRIMA Margomulyo Indah Komplek Mutiara Blok C 25  Surabaya</p>',
  `id_peg_purchasing` int(11) DEFAULT NULL,
  `id_peg_pj` int(11) DEFAULT NULL,
  `is_saved` varchar(2) NOT NULL DEFAULT '0',
  `is_deleted` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `purchasing_order`
--

INSERT INTO `purchasing_order` (`id_purchasing_order`, `kode_sistem`, `id_supplier`, `nomor_po`, `syarat_pembayaran`, `waktu_sistem`, `tgl_on_site`, `jadwal_nota`, `alamat_pengiriman`, `id_peg_purchasing`, `id_peg_pj`, `is_saved`, `is_deleted`) VALUES
(41, '0000000001', 7, 'FPB00001', 'SATU BULAN', '2016-02-07 04:32:05', '2016-02-07', 'Selasa, PKL 10.00 - 14.00 WIB', '<p>JAYA ARTA PRIMA Margomulyo Indah Komplek Mutiara Blok C 25  Surabaya</p>', NULL, NULL, '1', '0'),
(42, '0000000002', NULL, 'PO000002', 'SATU BULAN', '2016-02-07 04:36:03', NULL, 'Selasa, PKL 10.00 - 14.00 WIB', '<p>JAYA ARTA PRIMA Margomulyo Indah Komplek Mutiara Blok C 25  Surabaya</p>', NULL, NULL, '1', '0'),
(45, '0000000003', NULL, 'PO000003', 'SATU BULAN', '2016-02-07 04:49:48', NULL, 'Selasa, PKL 10.00 - 14.00 WIB', '<p>JAYA ARTA PRIMA Margomulyo Indah Komplek Mutiara Blok C 25  Surabaya</p>', NULL, NULL, '0', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchasing_order_detail`
--

CREATE TABLE `purchasing_order_detail` (
  `id_purchasing_order_detail` int(11) NOT NULL,
  `id_purchasing_order` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah_barang` varchar(20) DEFAULT NULL,
  `harga_satuan` varchar(20) DEFAULT NULL,
  `harga_total` varchar(20) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `is_deleted` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `purchasing_order_detail`
--

INSERT INTO `purchasing_order_detail` (`id_purchasing_order_detail`, `id_purchasing_order`, `id_barang`, `jumlah_barang`, `harga_satuan`, `harga_total`, `keterangan`, `is_deleted`) VALUES
(19, 41, 11, '400', '0', '0', 'egrfgrtb', '0'),
(20, 41, 1, '500', '0', '0', 'Segera', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchasing_order_fpb`
--

CREATE TABLE `purchasing_order_fpb` (
  `id_purchasing_order_fpb` int(11) NOT NULL,
  `id_purchasing_order` int(11) NOT NULL,
  `id_permintaan_barang` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `purchasing_order_fpb`
--

INSERT INTO `purchasing_order_fpb` (`id_purchasing_order_fpb`, `id_purchasing_order`, `id_permintaan_barang`) VALUES
(16, 27, 90),
(17, 28, 90),
(18, 31, 1),
(19, 32, 1),
(20, 33, 6),
(21, 34, 1),
(22, 34, 6),
(23, 36, 1),
(24, 37, 1),
(25, 37, 6),
(26, 38, 1),
(27, 38, 6),
(28, 39, 1),
(29, 35, 6),
(30, 40, 1),
(31, 41, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, 'Truk'),
(2, 'Sak'),
(3, 'Biji'),
(4, 'KG'),
(5, 'BTG'),
(6, 'PCS'),
(7, 'Klga'),
(8, 'Tabung'),
(9, 'Lusin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan_konversi`
--

CREATE TABLE `satuan_konversi` (
  `id_satuan_konversi` int(11) NOT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `id_satuan_bawah` int(11) DEFAULT NULL,
  `nama_konversi` varchar(50) DEFAULT NULL,
  `jumlah_atas` varchar(20) DEFAULT NULL,
  `jumlah_bawah` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(100) DEFAULT NULL,
  `alamat_supplier` varchar(100) DEFAULT NULL,
  `no_telephone` varchar(30) DEFAULT NULL,
  `no_fax` varchar(30) DEFAULT NULL,
  `nama_pemilik` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat_supplier`, `no_telephone`, `no_fax`, `nama_pemilik`) VALUES
(4, 'Cahaya Maju', 'Margomulyo Indah 1 Blok D Kav 16-17', NULL, NULL, NULL),
(5, 'Warga Djaja', 'Graha 137 , JL. Jayakarta no 137 H8 Jakarta Pusat', NULL, NULL, NULL),
(6, 'Intan Ustrik', 'JL. Reja Remo kec Manyar Gresik', NULL, NULL, NULL),
(7, 'Pura Baru Tama', 'JL. AKBP RAG Kusuma Madya 203 , Kudus', NULL, NULL, NULL),
(8, 'PT. Sinar Surya Kemas', 'JL. Raya Gantang KM50 Bopo menganti Gresik', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanda_terima`
--

CREATE TABLE `tanda_terima` (
  `id_tanda_terima` int(11) NOT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `kode_sistem` varchar(10) DEFAULT NULL,
  `nomor_po` varchar(30) DEFAULT NULL,
  `nomor_ttm` varchar(30) DEFAULT NULL,
  `nomor_surat_jalan` varchar(30) DEFAULT NULL,
  `waktu_sistem` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `tgl_terima` date NOT NULL DEFAULT '0000-00-00',
  `id_peg_pj` int(11) DEFAULT NULL,
  `nama_pengirim` varchar(20) DEFAULT NULL,
  `nama_penerima` varchar(20) DEFAULT NULL,
  `is_saved` varchar(2) DEFAULT '0',
  `is_deleted` varchar(2) DEFAULT '0',
  `is_po` varchar(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tanda_terima`
--

INSERT INTO `tanda_terima` (`id_tanda_terima`, `id_supplier`, `kode_sistem`, `nomor_po`, `nomor_ttm`, `nomor_surat_jalan`, `waktu_sistem`, `tgl_terima`, `id_peg_pj`, `nama_pengirim`, `nama_penerima`, `is_saved`, `is_deleted`, `is_po`) VALUES
(45, 4, '000000001M', '123', '341', '432', '2016-01-07 09:38:22', '2016-01-07', NULL, NULL, NULL, '1', '0', '0'),
(46, NULL, '000000002M', NULL, NULL, NULL, '2016-01-07 11:24:36', '0000-00-00', NULL, NULL, NULL, '0', '0', '0'),
(47, 4, '00000001PO', NULL, '234532', '1234', '2016-01-13 15:06:43', '2016-01-13', NULL, NULL, NULL, '1', '0', '1'),
(48, 5, '00000002PO', NULL, '3123', '31234', '2016-01-14 12:01:40', '0000-00-00', NULL, NULL, NULL, '1', '0', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanda_terima_detail`
--

CREATE TABLE `tanda_terima_detail` (
  `id_tanda_terima_detail` int(11) NOT NULL,
  `id_tanda_terima` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `jumlah_terima` int(11) DEFAULT NULL,
  `harga_satuan` varchar(20) DEFAULT NULL,
  `harga_terima` varchar(20) DEFAULT NULL,
  `harga_total` varchar(20) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `is_deleted` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tanda_terima_detail`
--

INSERT INTO `tanda_terima_detail` (`id_tanda_terima_detail`, `id_tanda_terima`, `id_barang`, `jumlah_barang`, `jumlah_terima`, `harga_satuan`, `harga_terima`, `harga_total`, `keterangan`, `is_deleted`) VALUES
(67, 45, 1, 0, 200, '0', '1000', '200000', 'sudah', '0'),
(68, 47, 11, 400, 100, '0', '120000', '12000000', 'egrfgrtb', '0'),
(69, 47, 1, 500, 200, '0', '120000', '24000000', 'Segera', '0'),
(70, 48, 2, 1000, 1000, '10000', '10000', '10000000', '', '0'),
(71, 48, 9, 1000, 1000, '10000', '10000', '10000000', 'd', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanda_terima_po`
--

CREATE TABLE `tanda_terima_po` (
  `id_tanda_terima_po` int(11) NOT NULL,
  `id_tanda_terima` int(11) NOT NULL,
  `id_purchasing_order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tanda_terima_po`
--

INSERT INTO `tanda_terima_po` (`id_tanda_terima_po`, `id_tanda_terima`, `id_purchasing_order`) VALUES
(12, 47, 32),
(13, 48, 33);

-- --------------------------------------------------------

--
-- Struktur dari tabel `template`
--

CREATE TABLE `template` (
  `id_template` bigint(20) NOT NULL,
  `nama_template` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `template`
--

INSERT INTO `template` (`id_template`, `nama_template`) VALUES
(1, 'Super Administrator'),
(2, 'Customer'),
(3, 'Purchase Order'),
(4, 'Purcahsing Order');

-- --------------------------------------------------------

--
-- Struktur dari tabel `template_menu`
--

CREATE TABLE `template_menu` (
  `id_template_menu` bigint(20) NOT NULL,
  `id_template` bigint(20) DEFAULT NULL,
  `id_menu` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `template_menu`
--

INSERT INTO `template_menu` (`id_template_menu`, `id_template`, `id_menu`) VALUES
(8, 8, 7),
(10, 8, 10),
(13, 3, 11),
(14, 3, 12),
(15, 4, 13),
(16, 3, 14),
(17, 3, 15),
(29, 3, 26),
(33, 4, 30),
(34, 3, 31),
(36, 8, 33),
(38, 10, 34),
(39, 10, 35),
(40, 11, 36),
(41, 8, 37),
(42, 8, 38),
(43, 3, 39),
(45, 4, 11),
(47, 4, 14),
(48, 11, 34),
(80, 1, 1),
(81, 1, 5),
(82, 1, 7),
(83, 1, 8),
(84, 1, 9),
(85, 1, 10),
(86, 1, 11),
(87, 1, 12),
(88, 1, 13),
(89, 1, 14),
(90, 1, 15),
(93, 1, 26),
(95, 1, 30),
(96, 1, 31),
(98, 1, 33),
(99, 1, 34),
(100, 1, 35),
(101, 1, 36),
(102, 1, 37),
(103, 1, 38),
(104, 1, 39),
(111, 1, 40);

-- --------------------------------------------------------

--
-- Struktur dari tabel `template_user`
--

CREATE TABLE `template_user` (
  `id_template_user` bigint(20) NOT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `id_template` bigint(20) DEFAULT NULL,
  `id_parent` varchar(2) DEFAULT NULL,
  `status_aktif` bigint(20) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `template_user`
--

INSERT INTO `template_user` (`id_template_user`, `id_user`, `id_template`, `id_parent`, `status_aktif`) VALUES
(1, 1, 1, NULL, 1),
(2, 2, 2, '11', 1),
(3, 3, 3, '11', 1),
(4, 4, 4, NULL, 1),
(5, 5, 5, NULL, 1),
(6, 6, 6, NULL, 1),
(7, 7, 7, NULL, 1),
(8, 8, 8, NULL, 1),
(9, 9, 9, NULL, 1),
(10, 10, 10, NULL, 1),
(11, 11, 11, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) NOT NULL,
  `id_role` bigint(20) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `nama_user` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `id_role`, `username`, `password`, `email`, `tgl_lahir`, `nama_user`) VALUES
(1, 1, 'admin', 'inS4UGgjBAP.I', 'admin@gmail.com', '1990-05-16', 'Administrator'),
(3, 3, 'PersonInCharge', 'inclvEgHyceKg', 'PersonInCharge@gmail.com', '2016-01-13', 'Person In Charge'),
(4, 4, 'kepalaPic', 'in.UMnurQd522', 'purchasing@gmail.com', '2016-01-13', 'Manajer PIC'),
(8, 7, 'karyawanGudang', 'in//bojaFsFXI', 'karyawangudang@gmail.com', '2016-01-13', 'Gudang'),
(10, 9, 'karyawanProduksi', 'in//bojaFsFXI', 'karyawanproduksi@gmail.com', '2016-01-13', 'Produksi'),
(11, 10, 'KepalaProduksi', 'inOt/0hUzQij2', 'kepalaproduksi@gmail.com', '2016-01-13', 'Kepala Produksi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `barang_jadi`
--
ALTER TABLE `barang_jadi`
  ADD PRIMARY KEY (`id_barang_jadi`);

--
-- Indexes for table `barang_saldo`
--
ALTER TABLE `barang_saldo`
  ADD PRIMARY KEY (`id_barang_saldo`),
  ADD UNIQUE KEY `kode_stok_opname` (`kode_saldo`);

--
-- Indexes for table `barang_stok`
--
ALTER TABLE `barang_stok`
  ADD PRIMARY KEY (`id_barang_stok`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `negara`
--
ALTER TABLE `negara`
  ADD PRIMARY KEY (`id_negara`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pengambilan_barang`
--
ALTER TABLE `pengambilan_barang`
  ADD PRIMARY KEY (`id_pengambilan_barang`);

--
-- Indexes for table `pengambilan_barang_detail`
--
ALTER TABLE `pengambilan_barang_detail`
  ADD PRIMARY KEY (`id_pengambilan_barang_detail`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id_penjualan_detail`);

--
-- Indexes for table `permintaan_barang`
--
ALTER TABLE `permintaan_barang`
  ADD PRIMARY KEY (`id_permintaan_barang`),
  ADD UNIQUE KEY `kode_sistem` (`kode_sistem`);

--
-- Indexes for table `permintaan_barang_detail`
--
ALTER TABLE `permintaan_barang_detail`
  ADD PRIMARY KEY (`id_permintaan_barang_detail`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id_produksi`);

--
-- Indexes for table `produksi_detail`
--
ALTER TABLE `produksi_detail`
  ADD PRIMARY KEY (`id_produksi_detail`);

--
-- Indexes for table `propinsi`
--
ALTER TABLE `propinsi`
  ADD PRIMARY KEY (`id_propinsi`);

--
-- Indexes for table `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id_proyek`);

--
-- Indexes for table `purchasing_order`
--
ALTER TABLE `purchasing_order`
  ADD PRIMARY KEY (`id_purchasing_order`);

--
-- Indexes for table `purchasing_order_detail`
--
ALTER TABLE `purchasing_order_detail`
  ADD PRIMARY KEY (`id_purchasing_order_detail`);

--
-- Indexes for table `purchasing_order_fpb`
--
ALTER TABLE `purchasing_order_fpb`
  ADD PRIMARY KEY (`id_purchasing_order_fpb`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `satuan_konversi`
--
ALTER TABLE `satuan_konversi`
  ADD PRIMARY KEY (`id_satuan_konversi`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tanda_terima`
--
ALTER TABLE `tanda_terima`
  ADD PRIMARY KEY (`id_tanda_terima`);

--
-- Indexes for table `tanda_terima_detail`
--
ALTER TABLE `tanda_terima_detail`
  ADD PRIMARY KEY (`id_tanda_terima_detail`);

--
-- Indexes for table `tanda_terima_po`
--
ALTER TABLE `tanda_terima_po`
  ADD PRIMARY KEY (`id_tanda_terima_po`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id_template`);

--
-- Indexes for table `template_menu`
--
ALTER TABLE `template_menu`
  ADD PRIMARY KEY (`id_template_menu`);

--
-- Indexes for table `template_user`
--
ALTER TABLE `template_user`
  ADD PRIMARY KEY (`id_template_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `id_agama` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `barang_jadi`
--
ALTER TABLE `barang_jadi`
  MODIFY `id_barang_jadi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
--
-- AUTO_INCREMENT for table `barang_saldo`
--
ALTER TABLE `barang_saldo`
  MODIFY `id_barang_saldo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `barang_stok`
--
ALTER TABLE `barang_stok`
  MODIFY `id_barang_stok` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43212;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `negara`
--
ALTER TABLE `negara`
  MODIFY `id_negara` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pengambilan_barang`
--
ALTER TABLE `pengambilan_barang`
  MODIFY `id_pengambilan_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `pengambilan_barang_detail`
--
ALTER TABLE `pengambilan_barang_detail`
  MODIFY `id_pengambilan_barang_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id_penjualan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `permintaan_barang`
--
ALTER TABLE `permintaan_barang`
  MODIFY `id_permintaan_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `permintaan_barang_detail`
--
ALTER TABLE `permintaan_barang_detail`
  MODIFY `id_permintaan_barang_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_produksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `produksi_detail`
--
ALTER TABLE `produksi_detail`
  MODIFY `id_produksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `propinsi`
--
ALTER TABLE `propinsi`
  MODIFY `id_propinsi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id_proyek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `purchasing_order`
--
ALTER TABLE `purchasing_order`
  MODIFY `id_purchasing_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `purchasing_order_detail`
--
ALTER TABLE `purchasing_order_detail`
  MODIFY `id_purchasing_order_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `purchasing_order_fpb`
--
ALTER TABLE `purchasing_order_fpb`
  MODIFY `id_purchasing_order_fpb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `satuan_konversi`
--
ALTER TABLE `satuan_konversi`
  MODIFY `id_satuan_konversi` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tanda_terima`
--
ALTER TABLE `tanda_terima`
  MODIFY `id_tanda_terima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `tanda_terima_detail`
--
ALTER TABLE `tanda_terima_detail`
  MODIFY `id_tanda_terima_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `tanda_terima_po`
--
ALTER TABLE `tanda_terima_po`
  MODIFY `id_tanda_terima_po` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id_template` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `template_menu`
--
ALTER TABLE `template_menu`
  MODIFY `id_template_menu` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `template_user`
--
ALTER TABLE `template_user`
  MODIFY `id_template_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
