-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2025 at 05:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ucm_lecturer`
--

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `room` varchar(255) DEFAULT NULL,
  `departments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`departments`)),
  `image` varchar(255) DEFAULT NULL,
  `image_type` varchar(255) NOT NULL DEFAULT 'jpg',
  `image_size` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `name`, `title`, `room`, `departments`, `image`, `image_type`, `image_size`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Ir. Tony Antonio, M. Eng.', 'Dosen, Ketua', '202', '[\"Magister Management\"]', 'tony', 'png', '111KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(2, 'Dr. E. Elia Ardyan, S.E., MBA.', 'Dosen, Ketua Prodi Manajemen', '203', '[\"Management\",\"Magister Management\"]', 'elia', 'png', '51KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(3, 'Dr. Adityawarman M. Kouwagam, S.H., M.Kn.', 'Dosen', '410', '[\"Management\"]', 'aditya', 'png', '12KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(4, 'Asriah Syam, S.E., M.M.', 'Dosen', '411', '[\"Management\"]', 'asriah', 'png', '88KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(5, 'Dr. Carolina Novi Mustikarini, S.E., M.Sc., LP-NLP.', 'Dosen', '201', '[\"Management\",\"Magister Management\"]', 'carolina', 'png', '10KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(6, 'Cindy Yoel Tanesia S.E., MBA.', 'Dosen', '508', '[\"Management\"]', 'cindy', 'png', '12KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(7, 'Cipta Canggih Perdana, S.E., M.M.', 'Dosen', '604', '[\"Management\"]', 'cipta', 'png', '11KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(8, 'Dr. Erwin Parega, S.E., M.M.', 'Dosen', '605', '[\"Management\",\"Magister Management\"]', 'erwin', 'png', '13KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(9, 'Fia Fauzia Burhanuddin, B.Bus., M.Ak.', 'Dosen', '201', '[\"Management\"]', 'fia', 'png', '116KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(10, 'Gracela Marisa Sanapang, S.P., M.M.', 'Dosen', '411', '[\"Management\"]', 'gracela', 'png', '81KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(11, 'Justin Wijaya, S.E., M.M.', 'Dosen', '102', '[\"Management\"]', 'justin', 'png', '11KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(12, 'Maichal, S.E., M.Sc.', 'Dosen', '106', '[\"Management\"]', 'maichal', 'png', '65KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(13, 'Michael Ricky Sondak, S.E., M.M.', 'Dosen', '410', '[\"Management\"]', 'michael', 'png', '66KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(14, 'Dr. Monalisa, S.E., M.M.', 'Dosen', '201', '[\"Management\",\"Magister Management\"]', 'monalisa', 'png', '63KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(15, 'Dr. Muchtar, S.E., M.Si.', 'Dosen', '401', '[\"Management\",\"Magister Management\"]', 'muchtar', 'png', '245KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(16, 'Muh. Syulhasbiullah, S.M., M.I.Kom., M.M.', 'Dosen', '408', '[\"Management\"]', 'syulhasbiullah', 'png', '89KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(17, 'Dr. Mustika Kusuma Basir S.Psi., M.M., CPS., CHCM.,CODP.', 'Dosen', '407', '[\"Management\",\"Magister Management\"]', 'mustika', 'png', '661KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(18, 'Dr. Natali Ikawidjaja, M.M., CRP.', 'Dosen', '405', '[\"Management\",\"Magister Management\"]', 'natali', 'png', '13KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(19, 'Novalina Gloria Simanungkalit, S.Psi., M.Psi., Psikolog, CLMA®', 'Dosen', '204', '[\"Management\"]', 'gloria', 'png', '14KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(20, 'Novieanty Pagiling, S.E., M.Sc.', 'Dosen', '407', '[\"Management\"]', 'novieanty', 'png', '81KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(21, 'Novika Ayu Triany, S.I.Kom., M.I.Kom.', 'Dosen', '303', '[\"Management\"]', 'ayu', 'png', '14KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(22, 'Powell Gian Hartono, S.M., M.M., RSA®', 'Dosen', '307', '[\"Management\"]', 'powell', 'png', '100KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(23, 'Dr. Salmah Sharon, S.E., M.Si., Ak., CA., CSRS., CSRA.', 'Dosen', '310', '[\"Management\",\"Magister Management\"]', 'salmah', 'png', '14KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(24, 'Sinar Dharmayana Putra, S.E., M.M.', 'Dosen', '308', '[\"Management\"]', 'sinar', 'png', '10KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(25, 'Winarto Poernomo, S.E., M.M.', 'Dosen', '304', '[\"Management\"]', 'winarto', 'png', '16KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(26, 'Yuyun Karystin Meilisa Suade, S.M., M.M.', 'Dosen', '406', '[\"Management\"]', 'yuyun', 'png', '14KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(27, 'Giovanni Marras', 'Dosen', '102', '[\"Management\"]', 'giovanni', 'png', '13KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(28, 'David Sundoro, S.T., M.MT.', 'Ketua Prodi Informatika', '501', '[\"Informatics\"]', 'david', 'png', '12KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(29, 'Ir. Kasmir Syariati, S.Kom., M.T.', 'Dosen', '502', '[\"Informatics\"]', 'kasmir', 'png', '12KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(30, 'Citra Suardi, S.Kom., M.T.', 'Dosen', '508', '[\"Informatics\"]', 'citra', 'png', '9KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(31, 'Arnold Nasir, B.Sc.(Hons.), M.Sc.', 'Dosen', '504', '[\"Informatics\"]', 'arnold', 'png', '90KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(32, 'Reinaldo Lewis Lordianto, S.Kom', 'Laboran', '503', '[\"Informatics\"]', 'reinaldo', 'png', '14KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(33, 'Ir. Juan Salao Biantong, S.Kom., M.T', 'Dosen', '302', '[\"Informatics\"]', 'juan', 'png', '666KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(34, 'Niken Savitri Anggraeni, S.Sn., M.Ds.', 'Ketua Prodi Desain Komunikasi Visual', '602', '[\"Visual Communication Design\"]', 'niken', 'png', '14KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(35, 'Ahmad Ade Nugraha, S.Ds., M.Ds.', 'Dosen', '605', '[\"Visual Communication Design\"]', 'ahmad', 'png', '12KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(36, 'Andra Rizky Yuwono, S.Ds., M.Ds.', 'Dosen', '603', '[\"Visual Communication Design\"]', 'andra', 'png', '11KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(37, 'Bilyan Putra Sari, S.Ds., M.Ds.', 'Dosen', '604', '[\"Visual Communication Design\"]', 'bilyan', 'png', '13KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(38, 'Rahmat Zulfikar, S.Ds., M.Ds.', 'Dosen', '601', '[\"Visual Communication Design\"]', 'rahmat', 'png', '12KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41'),
(39, 'Afrizal Firman, S.IP., MBA., Ph.D.', 'Ketua Prodi Magister Manajemen', '470', '[\"Magister Management\"]', 'afrizal', 'png', '95KB', '2025-10-29 00:46:41', '2025-10-29 00:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_10_29_000001_create_lecturers_table', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
