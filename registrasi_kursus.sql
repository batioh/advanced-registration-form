-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2021 at 01:51 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registrasi_kursus`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoiceID` int(11) NOT NULL,
  `SiswaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoiceID`, `SiswaID`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

--
-- Triggers `invoice`
--
DELIMITER $$
CREATE TRIGGER `InvoiceID->Line_buy` AFTER INSERT ON `invoice` FOR EACH ROW UPDATE line_buy 
SET invoiceID = NEW.invoiceID
WHERE invoiceID IS NULL
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `kls_bingc`
-- (See below for the actual view)
--
CREATE TABLE `kls_bingc` (
`SiswaID` int(11)
,`NamaLengkap` varchar(200)
,`Asrama` varchar(200)
,`Sekolah` varchar(200)
,`Kelas` varchar(200)
,`KLS_BINGC` varchar(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kls_bings`
-- (See below for the actual view)
--
CREATE TABLE `kls_bings` (
`SiswaID` int(11)
,`NamaLengkap` varchar(200)
,`Asrama` varchar(200)
,`Sekolah` varchar(200)
,`Kelas` varchar(200)
,`KLS_BINGS` varchar(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kls_maths`
-- (See below for the actual view)
--
CREATE TABLE `kls_maths` (
`SiswaID` int(11)
,`NamaLengkap` varchar(200)
,`Asrama` varchar(200)
,`Sekolah` varchar(200)
,`Kelas` varchar(200)
,`KLS_MATHS` varchar(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `laporan_keungan`
-- (See below for the actual view)
--
CREATE TABLE `laporan_keungan` (
`SiswaID` int(11)
,`NamaLengkap` varchar(200)
,`Program` varchar(200)
,`Subtotal` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `line_buy`
--

CREATE TABLE `line_buy` (
  `invoiceID` int(11) DEFAULT NULL,
  `ProgramID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `line_buy`
--

INSERT INTO `line_buy` (`invoiceID`, `ProgramID`) VALUES
(1, 'BING-C'),
(2, 'BING-S'),
(2, 'BING-C'),
(3, 'BING-C'),
(4, 'BING-S'),
(4, 'BING-C'),
(4, 'MATH-S'),
(5, 'BING-C'),
(5, 'MATH-S');

-- --------------------------------------------------------

--
-- Stand-in structure for view `loop_harga`
-- (See below for the actual view)
--
CREATE TABLE `loop_harga` (
`invoiceID` int(11)
,`ProgramID` varchar(11)
,`harga` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `ProgramID` varchar(11) NOT NULL,
  `namaProgram` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`ProgramID`, `namaProgram`, `harga`) VALUES
('BING-C', 'Bing convo', 220000),
('BING-S', 'Bahasa Inggris Sekolah', 200000),
('MATH-S', 'Matematika', 330000);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `NamaLengkap` varchar(255) NOT NULL,
  `TanggalLahir` date NOT NULL,
  `AlamatRumah` varchar(255) NOT NULL,
  `Asrama` varchar(255) NOT NULL,
  `JenPend` enum('SLTA','SLTP') NOT NULL,
  `Sekolah` varchar(255) NOT NULL,
  `Kelas` enum('1 SMP','2 SMP','3 SMP','1 SMA','2 SMA','3 SMA') NOT NULL,
  `KotaKelahiran` varchar(255) NOT NULL,
  `Program` varchar(255) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `SiswaID` int(11) NOT NULL,
  `NamaLengkap` varchar(200) NOT NULL,
  `KotaKelahiran` varchar(200) NOT NULL,
  `AlamatRumah` varchar(200) NOT NULL,
  `Asrama` varchar(200) NOT NULL,
  `JenPend` varchar(200) NOT NULL,
  `Sekolah` varchar(200) NOT NULL,
  `Kelas` varchar(200) NOT NULL,
  `ProgramGabungan` varchar(200) NOT NULL,
  `TanggalLahir` date DEFAULT NULL,
  `register_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `KLS_BINGS` varchar(11) DEFAULT NULL,
  `KLS_BINGC` varchar(11) DEFAULT NULL,
  `KLS_MATHS` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`SiswaID`, `NamaLengkap`, `KotaKelahiran`, `AlamatRumah`, `Asrama`, `JenPend`, `Sekolah`, `Kelas`, `ProgramGabungan`, `TanggalLahir`, `register_date`, `KLS_BINGS`, `KLS_BINGC`, `KLS_MATHS`) VALUES
(1, 'M. Fajrul Alam Ulin Nuha', 'Jombang', 'sbs', 'MZM', 'SLTA', 'RASTA', '3 SMA', 'BING-C', '2021-08-13', '2021-08-17 10:03:24', 'BS_C', '', 'MT-A'),
(2, 'M. Fajrul Alam Ulin Nuhaww', 'Jombang', 'sbs', 'MZM', 'SLTA', 'RASTA', '3 SMA', 'BING-S, BING-C', '2021-08-13', '2021-08-17 10:03:31', 'BS_D', '', ''),
(3, 'awa', 'adwa', 'gerge', 'sgs', 'SLTA', 'RASTA', '2 SMP', 'BING-C', '2021-08-12', '2021-08-17 10:05:06', '', 'BC_B', ''),
(4, 'fajpeg', 'Jombang', 'afaf', 'afafa', 'SLTA', 'RASTA', '2 SMA', 'BING-S, BING-C, MATH-S', '2021-08-05', '2021-08-17 12:43:44', 'BS_A', 'BC_B', 'MT_C'),
(5, 'KMAOOOO', 'adwa', 'iygiyg', 'adwa', 'SLTA', 'SPASA', '2 SMP', 'BING-C, MATH-S', '2021-08-07', '2021-08-17 14:34:31', '', 'BC_B', 'MT_B');

--
-- Triggers `siswa`
--
DELIMITER $$
CREATE TRIGGER `SiswaID->Invoice` AFTER INSERT ON `siswa` FOR EACH ROW INSERT INTO invoice(SiswaID)
VALUES(NEW.SiswaID)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `sum`
-- (See below for the actual view)
--
CREATE TABLE `sum` (
`invoiceID` int(11)
,`ProgramID` varchar(11)
,`Subtotal` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `summ`
-- (See below for the actual view)
--
CREATE TABLE `summ` (
`siswaID` int(11)
,`ProgramID` varchar(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `summz`
-- (See below for the actual view)
--
CREATE TABLE `summz` (
`invoiceID` int(11)
,`ProgramID` varchar(11)
,`SUM(p.harga)` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `sump`
-- (See below for the actual view)
--
CREATE TABLE `sump` (
`invoiceID` int(11)
,`Subtotal` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `testing`
-- (See below for the actual view)
--
CREATE TABLE `testing` (
`invoiceID` int(11)
,`ProgramID` varchar(11)
,`subtotal` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Structure for view `kls_bingc`
--
DROP TABLE IF EXISTS `kls_bingc`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kls_bingc`  AS  select `siswa`.`SiswaID` AS `SiswaID`,`siswa`.`NamaLengkap` AS `NamaLengkap`,`siswa`.`Asrama` AS `Asrama`,`siswa`.`Sekolah` AS `Sekolah`,`siswa`.`Kelas` AS `Kelas`,`siswa`.`KLS_BINGC` AS `KLS_BINGC` from `siswa` where `siswa`.`KLS_BINGC` is not null and `siswa`.`KLS_BINGC` <> '' ;

-- --------------------------------------------------------

--
-- Structure for view `kls_bings`
--
DROP TABLE IF EXISTS `kls_bings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kls_bings`  AS  select `siswa`.`SiswaID` AS `SiswaID`,`siswa`.`NamaLengkap` AS `NamaLengkap`,`siswa`.`Asrama` AS `Asrama`,`siswa`.`Sekolah` AS `Sekolah`,`siswa`.`Kelas` AS `Kelas`,`siswa`.`KLS_BINGS` AS `KLS_BINGS` from `siswa` where `siswa`.`KLS_BINGS` is not null and `siswa`.`KLS_BINGS` <> '' ;

-- --------------------------------------------------------

--
-- Structure for view `kls_maths`
--
DROP TABLE IF EXISTS `kls_maths`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kls_maths`  AS  select `siswa`.`SiswaID` AS `SiswaID`,`siswa`.`NamaLengkap` AS `NamaLengkap`,`siswa`.`Asrama` AS `Asrama`,`siswa`.`Sekolah` AS `Sekolah`,`siswa`.`Kelas` AS `Kelas`,`siswa`.`KLS_MATHS` AS `KLS_MATHS` from `siswa` where `siswa`.`KLS_MATHS` is not null and `siswa`.`KLS_MATHS` <> '' ;

-- --------------------------------------------------------

--
-- Structure for view `laporan_keungan`
--
DROP TABLE IF EXISTS `laporan_keungan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_keungan`  AS  select `s`.`SiswaID` AS `SiswaID`,`s`.`NamaLengkap` AS `NamaLengkap`,`s`.`ProgramGabungan` AS `Program`,`t`.`Subtotal` AS `Subtotal` from (`siswa` `s` join `sump` `t`) where `s`.`SiswaID` = `t`.`invoiceID` ;

-- --------------------------------------------------------

--
-- Structure for view `loop_harga`
--
DROP TABLE IF EXISTS `loop_harga`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `loop_harga`  AS  select `i`.`invoiceID` AS `invoiceID`,`p`.`ProgramID` AS `ProgramID`,`p`.`harga` AS `harga` from (`line_buy` `i` join `program` `p`) where `i`.`ProgramID` = `p`.`ProgramID` ;

-- --------------------------------------------------------

--
-- Structure for view `sum`
--
DROP TABLE IF EXISTS `sum`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sum`  AS  select `i`.`invoiceID` AS `invoiceID`,`p`.`ProgramID` AS `ProgramID`,sum(`p`.`harga`) AS `Subtotal` from (`invoice` `i` join `program` `p` on(`p`.`ProgramID` = `i`.`invoiceID`)) group by `i`.`invoiceID`,`p`.`ProgramID` ;

-- --------------------------------------------------------

--
-- Structure for view `summ`
--
DROP TABLE IF EXISTS `summ`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `summ`  AS  select `s`.`SiswaID` AS `siswaID`,`p`.`ProgramID` AS `ProgramID` from (`siswa` `s` join `program` `p` on(`p`.`ProgramID` = `s`.`SiswaID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `summz`
--
DROP TABLE IF EXISTS `summz`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `summz`  AS  select `i`.`invoiceID` AS `invoiceID`,`p`.`ProgramID` AS `ProgramID`,sum(`p`.`harga`) AS `SUM(p.harga)` from (`invoice` `i` join `program` `p`) group by `i`.`invoiceID`,`p`.`ProgramID` ;

-- --------------------------------------------------------

--
-- Structure for view `sump`
--
DROP TABLE IF EXISTS `sump`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sump`  AS  select `l`.`invoiceID` AS `invoiceID`,sum(`p`.`harga`) AS `Subtotal` from (`line_buy` `l` join `program` `p`) where `l`.`ProgramID` = `p`.`ProgramID` group by `l`.`invoiceID` ;

-- --------------------------------------------------------

--
-- Structure for view `testing`
--
DROP TABLE IF EXISTS `testing`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `testing`  AS  select `i`.`invoiceID` AS `invoiceID`,`p`.`ProgramID` AS `ProgramID`,sum(`p`.`harga`) AS `subtotal` from (`invoice` `i` join `program` `p`) group by `i`.`invoiceID`,`p`.`ProgramID` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoiceID`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`ProgramID`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`SiswaID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `SiswaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
