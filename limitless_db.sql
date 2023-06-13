-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jun 2023 pada 01.33
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `limitless_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `color` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `size`, `sex`, `color`, `quantity`) VALUES
(163374, 164936, 193, 'L', 'MALE', 'Ori', 1),
(897853, 887379, 392, 'L', 'FEMALE', 'Ori', 4),
(979864, 164936, 389, 'XL', 'FEMALE', 'Ori', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `type`, `sex`, `price`, `stock`) VALUES
(123, 'Bold Sport Jacket', 'Jacket', 'MALE', 999999, 12),
(193, 'Seacloud Breaker', 'Jacket', 'MALE', 1200000, 3),
(234, 'Parley Skirt', 'Skirt', 'FEMALE', 499999, 2),
(389, 'Marimekko Skirt', 'Skirt', 'FEMALE', 469000, 10),
(392, 'Windbreaker Adventure', 'Jacket', 'male', 1000000, 4),
(424, 'Play Green Skirt', 'Skirt', 'FEMALE', 900000, 4),
(432, 'Adventure Skirt', 'Skirt', 'FEMALE', 400000, 4),
(437, 'Jacket Crop White', 'Jacket', 'MALE', 1250000, 2),
(480, 'Trefoil T-Shirt', 'T-shirt', 'MALE', 500000, 20),
(512, 'Dailyrun Leggings', 'Leggings', 'FEMALE', 899999, 4),
(542, 'Go To Golf Dress', 'Dress', 'FEMALE', 700000, 3),
(572, 'Aeroready T-Shirt', 'T-shirt', 'MALE', 200000, 4),
(832, 'Dress Poplin Essentials', 'Dress', 'FEMALE', 600000, 3),
(839, 'Sportswear Future T-shirt', 'T-shirt', 'MALE', 450000, 12),
(931, 'Always Dot Dress', 'Dress', 'FEMALE', 599999, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `birth_date` date NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `birth_date`, `username`, `password`) VALUES
(164936, 'mundaaas', 'aas@gmail.com', '0812345678', '2003-04-02', 'aas', '37f31694ce2528a64cfacc73c612ef06'),
(887379, 'abrahamabi', 'abi@gmail.com', '0812345678', '2003-04-02', 'abi', '19a9228dbbbe3b613190002e54dc3429');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
