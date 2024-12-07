-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Des 2024 pada 08.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lodge_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `room_id` int(30) NOT NULL,
  `date_in` datetime NOT NULL,
  `date_out` datetime NOT NULL,
  `duration` int(2) NOT NULL,
  `adults` int(2) NOT NULL,
  `total_amount` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=Approved,2=Cancelled',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `room_id`, `date_in`, `date_out`, `duration`, `adults`, `total_amount`, `status`, `date_created`, `date_updated`) VALUES
(3, 7, 1, '2024-10-05 00:00:00', '2024-10-05 00:00:00', 0, 0, 140200, 2, '2024-10-04 20:25:01', '2024-10-06 10:42:53'),
(4, 7, 4, '2024-10-07 00:00:00', '2024-10-07 00:00:00', 0, 0, 140000, 2, '2024-10-06 10:39:01', '2024-10-06 10:42:35'),
(5, 7, 3, '2024-10-08 21:00:00', '2024-10-08 23:00:00', 0, 0, 150000, 1, '2024-10-06 10:42:15', '2024-10-06 11:36:43'),
(6, 7, 4, '2024-10-07 20:00:00', '2024-10-07 23:00:00', 0, 0, 210000, 3, '2024-10-06 10:44:00', '2024-10-18 00:05:38'),
(7, 7, 1, '2024-10-06 20:00:00', '2024-10-06 22:00:00', 0, 0, 140000, 3, '2024-10-06 10:45:08', '2024-10-06 11:37:06'),
(9, 9, 4, '2024-10-17 20:00:00', '2024-10-17 23:00:00', 0, 0, 210000, 3, '2024-10-17 20:48:24', '2024-10-18 00:04:52'),
(10, 9, 3, '2024-10-18 19:00:00', '2024-10-18 22:00:00', 0, 0, 225000, 1, '2024-10-17 20:49:12', '2024-10-18 00:05:07'),
(11, 9, 1, '2024-10-18 01:00:00', '2024-10-18 03:00:00', 0, 2, 0, 3, '2024-10-17 23:52:49', '2024-10-18 00:05:25'),
(12, 9, 3, '2024-10-20 20:00:00', '2024-10-20 22:00:00', 0, 3, 0, 1, '2024-10-18 00:01:35', '2024-10-18 00:04:39'),
(13, 9, 1, '2024-10-22 17:00:00', '2024-10-22 21:00:00', 0, 4, 0, 1, '2024-10-18 00:02:30', '2024-10-18 00:04:24'),
(14, 10, 1, '2024-10-19 15:30:00', '2024-10-19 16:30:00', 0, 4, 0, 3, '2024-10-19 15:45:31', '2024-10-19 15:48:17'),
(15, 8, 3, '2024-10-30 14:00:00', '2024-10-30 18:00:00', 0, 1, 300000, 2, '2024-10-30 13:54:58', '2024-10-30 14:11:35'),
(16, 8, 4, '2024-10-30 19:00:00', '2024-10-30 22:00:00', 0, 3, 210000, 1, '2024-10-30 14:11:21', '2024-10-30 14:12:17'),
(17, 7, 4, '2024-10-31 20:00:00', '2024-10-31 23:00:00', 0, 4, 210000, 0, '2024-10-30 18:54:50', NULL),
(18, 7, 2, '2024-10-30 20:00:00', '2024-10-30 22:00:00', 0, 2, 140000, 3, '2024-10-30 18:55:26', '2024-12-02 20:34:54'),
(19, 8, 3, '2024-11-01 21:00:00', '2024-11-01 23:00:00', 0, 4, 150000, 0, '2024-10-30 23:20:49', NULL),
(20, 8, 3, '2024-11-01 20:00:00', '2024-11-01 22:00:00', 0, 4, 150000, 2, '2024-10-31 21:44:34', '2024-10-31 21:51:01'),
(21, 8, 1, '2024-11-05 21:00:00', '2024-11-05 23:00:00', 2, 2, 140000, 1, '2024-10-31 21:49:22', '2024-12-02 20:34:43'),
(22, 8, 3, '2024-11-21 20:30:00', '2024-11-21 22:30:00', 2, 4, 160000, 3, '2024-11-21 14:11:49', '2024-12-02 20:34:32'),
(23, 8, 3, '2024-12-04 20:00:00', '2024-12-04 22:00:00', 2, 3, 160000, 1, '2024-12-04 16:47:49', '2024-12-04 20:27:33'),
(24, 8, 2, '2024-12-04 20:00:00', '2024-12-04 23:00:00', 3, 2, 225000, 3, '2024-12-04 16:49:23', '2024-12-04 20:26:34'),
(25, 9, 3, '2024-12-05 20:00:00', '2024-12-05 23:00:00', 3, 4, 240000, 1, '2024-12-04 16:50:53', '2024-12-04 20:27:21'),
(26, 9, 1, '2024-12-04 20:00:00', '2024-12-04 22:00:00', 2, 2, 150000, 3, '2024-12-04 16:51:27', '2024-12-04 20:26:26'),
(27, 9, 4, '2024-12-04 23:00:00', '2024-12-05 02:00:00', 3, 3, 180000, 0, '2024-12-04 16:52:38', NULL),
(28, 8, 1, '2024-12-06 21:00:00', '2024-12-06 22:00:00', 1, 1, 75000, 0, '2024-12-06 18:18:54', NULL),
(29, 8, 3, '2024-12-08 20:00:00', '2024-12-08 23:00:00', 3, 4, 240000, 0, '2024-12-06 18:19:55', NULL),
(30, 8, 4, '2024-12-07 22:00:00', '2024-12-08 02:00:00', 4, 3, 240000, 0, '2024-12-06 18:21:19', NULL),
(31, 9, 3, '2024-12-06 20:30:00', '2024-12-06 23:30:00', 3, 6, 240000, 0, '2024-12-06 18:23:07', NULL),
(32, 9, 1, '2024-12-08 22:00:00', '2024-12-09 01:00:00', 3, 4, 225000, 0, '2024-12-06 18:25:16', NULL),
(33, 9, 4, '2024-12-10 20:00:00', '2024-12-10 23:00:00', 3, 5, 180000, 0, '2024-12-06 18:26:40', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(30) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `inquiry`
--

INSERT INTO `inquiry` (`id`, `name`, `email`, `subject`, `message`, `status`, `date_created`) VALUES
(2, 'JenoLee', 'jenolee@gmail.com', 'Hallo admin!!', 'halloooo', 1, '2024-10-19 16:33:00'),
(3, 'JenoLee', 'jenolee@gmail.com', 'Admin!!', 'Konfirmasi pesanan saya', 1, '2024-10-19 16:34:09'),
(4, 'Hrenjun', 'huangrenjun@gmail.com', 'Hallo admin!!', 'Hallooooo', 1, '2024-10-19 16:34:57'),
(5, 'JenoLee', 'jenolee@gmail.com', 'Hallo admin!!', 'Room 03 apakah ready?', 0, '2024-10-19 16:35:24'),
(7, 'Renjun', 'huangrenjun@gmail.com', 'Hallo admin!!', 'Room 02 apakah ready?', 1, '2024-10-19 16:37:26'),
(8, 'Renjun', 'huangrenjun@gmail.com', 'Hallo admin!!', 'Besok apakah buka?', 0, '2024-10-19 16:37:57'),
(9, 'Renjun', 'huangrenjun@gmail.com', 'Hallo admin!!', 'Room 04 apakah ready?', 0, '2024-10-19 16:38:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `room_list`
--

CREATE TABLE `room_list` (
  `id` int(30) NOT NULL,
  `room` text NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = Available, 2 = Unavailable',
  `upload_path` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `room_list`
--

INSERT INTO `room_list` (`id`, `room`, `description`, `price`, `status`, `upload_path`, `date_created`, `date_updated`) VALUES
(1, 'Room 01', '&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif;&quot;&gt;Room 01 di karaoke dengan desain sederhana dan lokasi dekat resepsionis adalah pilihan yang tepat bagi Anda yang menginginkan ruangan yang nyaman, mudah diakses, dan dengan harga yang terjangkau. Meskipun desainnya sederhana, ruangan ini tetap dilengkapi dengan peralatan karaoke yang lengkap untuk memberikan pengalaman bernyanyi yang menyenangkan.&lt;br&gt;&lt;/p&gt;', 75000, 1, 'uploads/room_1', '2021-07-24 10:22:15', '2024-11-21 14:07:41'),
(2, 'Room 02', '&lt;p&gt;Room 02 adalah pilihan yang tepat bagi Anda yang mencari suasana yang lebih cozy dan intim untuk bernyanyi bersama teman dekat atau keluarga. Meskipun ukurannya kecil, ruangan ini tetap dilengkapi dengan peralatan karaoke yang berkualitas dan desain yang menarik.&lt;br&gt;&lt;/p&gt;', 75000, 1, 'uploads/room_2', '2021-07-24 14:38:31', '2024-11-21 14:07:53'),
(3, 'Room 03', '&lt;p&gt;Room 03 adalah pilihan yang tepat bagi Anda yang membutuhkan ruangan yang luas dan fleksibel untuk berbagai macam acara. Desainnya yang sederhana namun elegan, ditambah dengan peralatan karaoke yang lengkap, membuat ruangan ini menjadi tempat yang sempurna untuk bersenang-senang bersama teman-teman atau keluarga.&lt;span style=&quot;font-family: &amp;quot;Segoe UI&amp;quot;;&quot;&gt;﻿&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 80000, 1, 'uploads/room_3', '2024-10-04 13:34:58', '2024-11-21 14:06:48'),
(4, 'Room 04', '&lt;p&gt;Room 04 adalah pilihan yang tepat bagi Anda yang mencari suasana yang lebih tenang dan privat untuk menikmati waktu bernyanyi. Desainnya yang sederhana dan lokasinya di lantai 2 membuat ruangan ini menjadi tempat yang nyaman untuk bersantai dan melupakan sejenak kesibukan sehari-hari.&lt;br&gt;&lt;/p&gt;', 60000, 1, 'uploads/room_4', '2024-10-04 13:36:39', '2024-12-04 22:05:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Booking Room Management System'),
(6, 'short_name', 'Cafe & Karaoke Dayoen99'),
(11, 'logo', 'uploads/1728024180_WhatsApp Image 2024-09-30 at 13.32.40.jpeg'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1728024180_resepsionis.jpeg'),
(15, 'user_help', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `email` text NOT NULL,
  `contact` varchar(50) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `contact`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', '', '', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/1728022920_1726755360_avatarcewek.png', NULL, 1, '2021-01-20 14:02:37', '2024-10-04 13:22:06'),
(6, 'John', 'Smith', 'jsmith@sample.com', '09123456789', 'jsmith', '1254737c076cf867dc53d60a0364f38e', NULL, NULL, 0, '2021-07-24 10:41:04', '2021-07-24 10:57:40'),
(7, 'Huang', 'Renjun', 'huangrenjun@gmail.com', '098765432134', 'Hrenjun', '471ab50c8c408f9de1299fef7c3608e4', NULL, NULL, 0, '2024-10-04 13:47:16', NULL),
(8, 'Na', 'Jaemin', 'jaemin@gmail.com', '082987654322', 'najaem', '518d5f3401534f5c6c21977f12f60989', NULL, NULL, 0, '2024-10-10 21:51:14', NULL),
(9, 'Lee', 'Jeno', 'jeno@gmail.com', '0988765432234', 'jenolee', '2c5a506a135b1806c1eacce2efaeea05', NULL, NULL, 0, '2024-10-16 11:09:21', NULL),
(10, 'Revalina', 'Ananda', 'revalina@gmail.com', '098765432132', 'revalina123', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 0, '2024-10-19 15:43:33', NULL),
(11, 'Na', 'Jaemin', 'jaemin@gmail.com', '098765432', 'jaemin', 'b3279dfb36d17ec339097805a98880ea', NULL, NULL, 0, '2024-10-19 16:52:11', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `room_list`
--
ALTER TABLE `room_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `room_list`
--
ALTER TABLE `room_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
