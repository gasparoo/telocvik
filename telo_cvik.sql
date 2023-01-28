-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2022 at 06:41 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `telo_cvik`
--

-- --------------------------------------------------------

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `img1` varchar(50) NOT NULL,
  `img2` varchar(50) NOT NULL,
  `img3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `products` (`id`, `title`, `description`, `img1`, `img2`, `img3`) VALUES
(1, 'Tričko s krátkým rukávem a s černým logem potisknutým na hrudi.', '•	Složení: 100% bavlny (složení se může lišit – barva 03–97 % bavlna a 3 % viskóza)<br> •	Gramáž: 145 g/m2 <br> •	Barva: bílá<br> •	Tisk: přímý sítotisk<br> •	Střih: pánský<br> •	Značka: Malfini', 'Tricko_bile_s_logem_basic_cele.jpg', 'Tricko_bile_s_logem_basic_Tom.jpg', 'Tricko_bile_s_logem_basic_vsichni.jpg'),
(2, 'Mikina s dlouhým rukávem a s černým logem potisknutým na hrudi.', '•	Složení: Výplňková pletenina, vnitřní strana nepočesaná 65 % polyester, 35 % bavlna<br> •	Gramáž: 280 g/m2 <br> •	Barva: stříbrný melír<br> •	Tisk: přímý sítotisk<br> •	Střih: pánský i dámský<br> •	Značka: Malfini', 'Mikina_s_logem_basic.jpg', 'Mikina_s_logem_basic_1.jpg', 'ALL.jpg'),
(3, 'Tričko s krátkým rukávem a potiskem na hrudi i velkým černo červeným polem na zádech.', '•	Složení: 100% bavlny (složení se může lišit – barva 03–97 % bavlna a 3 % viskóza)<br> •	Gramáž: 145 g/m2 <br> •	Barva: světle šedý melýr<br> •	Tisk: přímý sítotisk<br> •	Střih: pánský i dámský<br> •	Značka: Malfini', 'Tricko_sedive_s_velkym_logem_ustolu.jpg', 'Tricko_sedive_s_velkym_logem_stojici.jpg', 'Tricko_sedive_s_velkym_logem_sedici.jpg');

-- --------------------------------------------------------

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `product_images` (`id`, `product_id`, `image`) VALUES
(13, 1, 'Tricko_bile_s_logem_basic_1.jpg'),
(14, 1, 'Tricko_bile_s_logem_basic_2.jpg'),
(15, 1, 'Tricko_bile_s_logem_basic_3.jpg'),
(16, 1, 'Tricko_bile_s_logem_basic_cele.jpg'),
(17, 1, 'Tricko_bile_s_logem_basic_kikin.jpg'),
(18, 1, 'Tricko_bile_s_logem_basic_Tom.jpg'),
(19, 2, 'Mikina_s_logem_basic.jpg'),
(20, 2, 'Mikina_s_logem_basic_1.jpg'),
(21, 2, 'Mikina_s_logem_basic_3.jpg'),
(22, 3, 'Tricko_sedive_s_velkym_logem_sedici.jpg'),
(23, 3, 'Tricko_sedive_s_velkym_logem_stojici.jpg'),
(24, 3, 'Tricko_sedive_s_velkym_logem_ustolu.jpg');

-- --------------------------------------------------------

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
