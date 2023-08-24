-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2023 at 04:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manacul`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `res_id` int(11) DEFAULT NULL,
  `nama_menu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `res_id`, `nama_menu`) VALUES
(62, 13, 'Halua Kenari,Ayam Woku'),
(64, 16, 'Kepala Babi Goreng Madu,Ayam Woku,Rahang Tuna,Tinutuan'),
(65, 17, 'Kepala Babi Goreng Madu,Rahang Tuna Bakar,Rahang Tuna'),
(66, 18, 'Ayam Woku,Klappertaart,Tinutuan'),
(67, 19, 'Mie ikan Cakalang,Rahang Tuna,Rahang Tuna Bakar,Kepala Babi Goreng Madu,Klappertaart'),
(68, 20, 'Rahang Tuna Bakar,Klappertaart,Halua Kenari,Ayam Woku,Rahang Tuna'),
(69, 22, 'Tinutuan');

-- --------------------------------------------------------

--
-- Table structure for table `restoran`
--

CREATE TABLE `restoran` (
  `res_id` int(20) NOT NULL,
  `res_name` varchar(40) NOT NULL,
  `notelp` int(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `site_address` varchar(255) NOT NULL,
  `res_logo` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restoran`
--

INSERT INTO `restoran` (`res_id`, `res_name`, `notelp`, `address`, `site_address`, `res_logo`, `user_id`) VALUES
(5, 'Mie Ikan Cakalang Manado', 2147483647, 'Jl. AA Maramis, Paniki Bawah, Manado', 'https://www.google.com/search?client=opera-gx&q=Mie+Ikan+Cakalang+Manado&sourceid=opera&ie=UTF-8&oe=UTF-8', '../img/reslogo/image_2023-08-24_052751195.png', 20),
(13, 'Rahang Tuna Om Iker', 2147483647, 'FRVQ+73G, Marina Plaza, Depan Hash Inn, North Wenang, Manado City, North Sulawesi', 'https://www.google.com/search?client=opera-gx&q=Rahang+Tuna+Om+Iker&sourceid=opera&ie=UTF-8&oe=UTF-8', '../img/reslogo/image_2023-08-24_050525928.png', 189),
(16, 'GOSO RICA by Valen Rewah', 2147483647, 'Sindulang Satu, Kec. Tuminting, Kota Manado, Sulawesi Utara', 'https://maps.app.goo.gl/JbForCuR5SDGBUPx7', '../img/reslogo/image_2023-08-24_050216069.png', 14),
(17, 'Kelapa 17 Megamas - Kepala, Rusuk, Kaki ', 2147483647, 'Kawasan Megamas, Kota Manado, Sulawesi Utara 95111', 'https://www.google.com/search?client=opera-gx&q=Kelapa+17+Megamas&sourceid=opera&ie=UTF-8&oe=UTF-8', '../img/reslogo/image_2023-08-24_050814640.png', 192),
(18, 'CHRISTINE KLAPPERTAART', 431858975, 'Manado Griya Indah B67 pal dua lingk VIII, Paal Dua, Kec. Paal Dua, Kota Manado, Sulawesi Utara', 'https://www.google.com/search?client=opera-gx&q=CHRISTINE+KLAPPERTAART+HOME&sourceid=opera&ie=UTF-8&oe=UTF-8', '../img/reslogo/image_2023-08-24_051005720.png', 193),
(19, 'Tuna House Manado Living World', 2147483647, 'Jl. Laksda John Lie, Wenang Selatan, Kec. Wenang, Kota Manado.', 'https://www.google.com/search?client=opera-gx&q=Deep+Sea+Tuna+House+cafe+%26+Resto.&sourceid=opera&ie=UTF-8&oe=UTF-8', '../img/reslogo/image_2023-08-24_051606828.png', 194),
(20, 'City Extra', 2147483647, 'Jl. Raya Tanawangko Kalasey No.55, Kalasey Satu, Kec. Mandolang, Kabupaten Minahasa', 'https://www.google.com/search?q=city+extra+manado&client=opera-gx&hs=4mf&sca_esv=559523683&sxsrf=AB5stBgMypxhnpnxKv0FvPwxPV0Xnm85Fg%3A1692829094124&ei=poXmZOyiB-WXjuMPmt-z-A4&ved=0ahUKEwjsjcjm5_OAAxXli2MGHZrvDO8Q4dUDCA4&uact=5&oq=city+extra+manado&gs_lp=E', '../img/reslogo/image_2023-08-24_052019227.png', 195),
(21, 'BSR BambuSario Restaurant', 2147483647, 'Jalan Kembang, Sario Utara, North Sario, Sario, Manado City, North Sulawesi 95114', 'https://www.google.com/search?client=opera-gx&q=Bambuden+Sario&sourceid=opera&ie=UTF-8&oe=UTF-8', '../img/reslogo/image_2023-08-24_052332839.png', 196),
(22, 'Restoran Mahal', 31232242, 'sdasad', 'dassda', '../img/reslogo/logo RH.png', 197);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `roles`) VALUES
(1, 'Roy', 'roy@roy', '123', 'admin'),
(12, 'Roy The Savior Of Light', 'pus@sy.com', '$2y$10$/KD0J1Vzch8bi10h4aCBTuZq1mbekrcYs3sM0B/qO.EQuoN8UE/Ma', 'user'),
(14, 'preysilia geibe tatipang', 'prey@si.com', '$2y$10$ndFuGxdyVAtxIqGmGdvCg.ayQTOXONwNTOs1ZjSF64sre9ouyFiLy', 'user'),
(20, 'Aldi Taher', 'aldi@ta.com', '$2y$10$wYU.6MHkJNV8EsPR4Se.A.02NCHZTpldKtiBRi/EDyEtYx5bpSAcW', 'user'),
(24, 'cicak', 'ci@cak.com', '$2y$10$qfweo4Z3R1lkQ8VBd/TdcOwcwzUR3PhdVR4e8SSkVczZDFIXFqCme', 'user'),
(185, 'Rois The Admin', 'roy@admin.com', '$2y$10$/KD0J1Vzch8bi10h4aCBTuZq1mbekrcYs3sM0B/qO.EQuoN8UE/Ma', 'admin'),
(187, 'Coldest Admin On The Earth', 'admin@manacul.com', '$2y$10$/KD0J1Vzch8bi10h4aCBTuZq1mbekrcYs3sM0B/qO.EQuoN8UE/Ma', 'admin'),
(188, 'dsadas', 'eaw@dsa.com', '$2y$10$xxRRdME9DT2lmK6Ooddt3u57RgU0mifBpI2fKTI25mBBK1Un46CGK', 'user'),
(189, 'war', 'war@a.com', '$2y$10$XwybtWOHA.eq11VfsaU1COXhiK4gzN2J19LP4rTy1mTYM07AAbciy', 'user'),
(190, 'wir', 'wir@a.com', '$2y$10$VoLfSsMFCS5/BIN6D44G0OHdU1twqaeDGjGoQ1bwlM9PIid7YfW8W', 'user'),
(191, 'wur', 'wur@a.com', '$2y$10$j.zhkuHDfkZx9PKPK2TwBexIHG6eKxCL6mAGtPQkZiwEmMgfwLOBq', 'user'),
(192, 'Kelapa 17 Megamas', 'kelapa@gmail.com', '$2y$10$N4ShmoufbAxoxeYAJ4A1h.eAF5ZRsXV.kLeC/2HUZrP.sc1apQ.sq', 'user'),
(193, 'CHRISTINE KLAPPERTAART HOME', 'chris@gmail.com', '$2y$10$zAFPTWUOLLyyPl8hHmBK0uZ7Yn9wEVEIWJHcqjIHxVamPQj8XQExO', 'user'),
(194, 'Tuna House', 'tuna@gmail.com', '$2y$10$qiiPelW5QpXdOE0QCiFYK.KDKJa0X762Xm/RQ3qIWXdk/JihS4Wia', 'user'),
(195, 'city', 'city@extra.com', '$2y$10$T3yPhlGvuq2cxqhULnW1gOqJIyqbqA10rz4o812QFCyQ1//5.ZY02', 'user'),
(196, 'BSR BambuSario Restaurant', 'bambu@sario.com', '$2y$10$eomyPHkJm4DKVf7vgv7RC.1OKPKQS9v6J/IGliYpDQwIQWs4SB5Ku', 'user'),
(197, 'kdsal', 'wda@a.com', '$2y$10$.objIfJ4U3/fYBO.Iz/k7ezgNtPmYT073e4a7ARJW38CVpPlb1GrW', 'user'),
(198, 'huhu', 'hihi@i.com', '$2y$10$f9qmuCS83A03ETKnl0FF2ejGaiDDDPzBRvFjWR9cGvVv7N3G0TfbO', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `fk_menu_resid` (`res_id`);

--
-- Indexes for table `restoran`
--
ALTER TABLE `restoran`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `restoran`
--
ALTER TABLE `restoran`
  MODIFY `res_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_res_id` FOREIGN KEY (`res_id`) REFERENCES `restoran` (`res_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_menu_resid` FOREIGN KEY (`res_id`) REFERENCES `restoran` (`res_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `restoran` (`res_id`),
  ADD CONSTRAINT `menu_ibfk_2` FOREIGN KEY (`res_id`) REFERENCES `restoran` (`res_id`) ON DELETE CASCADE;

--
-- Constraints for table `restoran`
--
ALTER TABLE `restoran`
  ADD CONSTRAINT `restoran_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
