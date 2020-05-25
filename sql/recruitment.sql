-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2020 at 10:28 AM
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
-- Database: `recruitment`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahasa`
--

CREATE TABLE `bahasa` (
  `bahasa_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `baca` varchar(10) NOT NULL,
  `tulis` varchar(10) NOT NULL,
  `dengar` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE `biodata` (
  `biodata_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(10) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `jabatan1` varchar(100) NOT NULL,
  `jabatan2` varchar(100) NOT NULL,
  `jabatan3` varchar(100) NOT NULL,
  `ekspetasi_gaji` varchar(20) NOT NULL,
  `foto` text NOT NULL,
  `cv` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`biodata_id`, `user_id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `agama`, `jenis_kelamin`, `alamat`, `no_hp`, `email`, `jabatan1`, `jabatan2`, `jabatan3`, `ekspetasi_gaji`, `foto`, `cv`) VALUES
(1, 7, 'Alfath Ramadhan', 'Jakarta', '1999-01-04', 'Islam', 'P', 'Jl Lontar VI no.46', '082123145680', 'alfath@gmail.com', 'Junior Programmer', '', '', '4000000', 'd12cc4383b3712422de27dcf258ceb4b.jpg', '1bb22243a5120874c4bedb34ac41e22b.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `fpk`
--

CREATE TABLE `fpk` (
  `fpk_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_pemohon` varchar(100) NOT NULL,
  `jabatan_pemohon` varchar(50) NOT NULL,
  `lokasi` text NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `jumlah_kebutuhan` int(11) NOT NULL,
  `usia_min` int(11) NOT NULL,
  `usia_max` int(11) NOT NULL,
  `pendidikan_min` varchar(10) NOT NULL,
  `pengalaman_min` int(11) NOT NULL,
  `deskripsi_pekerjaan` varchar(1024) NOT NULL,
  `alasan` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fpk`
--

INSERT INTO `fpk` (`fpk_id`, `user_id`, `nama_pemohon`, `jabatan_pemohon`, `lokasi`, `jabatan`, `status`, `jumlah_kebutuhan`, `usia_min`, `usia_max`, `pendidikan_min`, `pengalaman_min`, `deskripsi_pekerjaan`, `alasan`) VALUES
(1, 6, 'Muhammad Irfan Ariesta', 'Program Analyst', 'Jakarta Utara', 'Junior Programmer', 'dirut_approve', 2, 20, 25, 'D3', 1, 'Membantu project dino retail', 'urgent');

-- --------------------------------------------------------

--
-- Table structure for table `keahlian`
--

CREATE TABLE `keahlian` (
  `keahlian_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelatihan`
--

CREATE TABLE `pelatihan` (
  `pelatihan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `penyelenggara` varchar(50) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengalaman_kerja`
--

CREATE TABLE `pengalaman_kerja` (
  `pengalaman_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pendidikan`
--

CREATE TABLE `riwayat_pendidikan` (
  `riwayat_pendidikan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sekolah` varchar(100) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `tingkat_pendidikan` varchar(10) NOT NULL,
  `program_studi` varchar(50) NOT NULL,
  `tahun_masuk` varchar(5) NOT NULL,
  `tahun_keluar` varchar(5) NOT NULL,
  `nilai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status_lamaran`
--

CREATE TABLE `status_lamaran` (
  `status_lamaran_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fpk_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_lamaran`
--

INSERT INTO `status_lamaran` (`status_lamaran_id`, `user_id`, `fpk_id`, `status`) VALUES
(1, 7, 1, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `hak_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `hak_akses`) VALUES
(1, 'admin', '12345678', 'admin@admin.com', 1),
(4, 'dirut', '12345678', 'dirut@example.com', 2),
(5, 'hrd', '12345678', 'hrd@example.com', 3),
(6, 'divisi', '12345678', 'divisi@example.com', 4),
(7, 'alfath@gmail.com', '12345678', 'alfath@gmail.com', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahasa`
--
ALTER TABLE `bahasa`
  ADD PRIMARY KEY (`bahasa_id`);

--
-- Indexes for table `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`biodata_id`);

--
-- Indexes for table `fpk`
--
ALTER TABLE `fpk`
  ADD PRIMARY KEY (`fpk_id`);

--
-- Indexes for table `keahlian`
--
ALTER TABLE `keahlian`
  ADD PRIMARY KEY (`keahlian_id`);

--
-- Indexes for table `pelatihan`
--
ALTER TABLE `pelatihan`
  ADD PRIMARY KEY (`pelatihan_id`);

--
-- Indexes for table `pengalaman_kerja`
--
ALTER TABLE `pengalaman_kerja`
  ADD PRIMARY KEY (`pengalaman_id`);

--
-- Indexes for table `riwayat_pendidikan`
--
ALTER TABLE `riwayat_pendidikan`
  ADD PRIMARY KEY (`riwayat_pendidikan_id`);

--
-- Indexes for table `status_lamaran`
--
ALTER TABLE `status_lamaran`
  ADD PRIMARY KEY (`status_lamaran_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahasa`
--
ALTER TABLE `bahasa`
  MODIFY `bahasa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `biodata`
--
ALTER TABLE `biodata`
  MODIFY `biodata_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fpk`
--
ALTER TABLE `fpk`
  MODIFY `fpk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keahlian`
--
ALTER TABLE `keahlian`
  MODIFY `keahlian_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelatihan`
--
ALTER TABLE `pelatihan`
  MODIFY `pelatihan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengalaman_kerja`
--
ALTER TABLE `pengalaman_kerja`
  MODIFY `pengalaman_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riwayat_pendidikan`
--
ALTER TABLE `riwayat_pendidikan`
  MODIFY `riwayat_pendidikan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_lamaran`
--
ALTER TABLE `status_lamaran`
  MODIFY `status_lamaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
