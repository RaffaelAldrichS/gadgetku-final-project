-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jun 2024 pada 23.45
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gadgetku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `popular` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(191) NOT NULL,
  `meta_title` varchar(191) NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `meta_keywords` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `status`, `popular`, `image`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`) VALUES
(6, 'Smartphone', 'Smartphone', 'Mobile Phone', 0, 1, '66715e1776aea.jpg', 'Smartphone', 'Smartphone', 'Smartphone', '2024-06-18 10:14:47'),
(7, 'Laptop', 'Laptop', 'Personal Computer', 0, 1, '66715e41981ae.png', 'Laptop', 'Laptop', 'Laptop', '2024-06-18 10:15:29'),
(9, 'Tablet', 'Tablet', 'Tablet besar', 0, 0, '6671c65756fce.jpg', 'Tablet', 'Tablet', 'Tablet', '2024-06-18 17:37:42'),
(10, 'Camera', 'Camera', 'Camera photo', 0, 0, '6671c5fee5966.jpg', 'Camera', 'Camera', 'Camera', '2024-06-18 17:38:06'),
(11, 'Headphone', 'Headphone', 'Headphone', 0, 0, '6671c61a2b925.jpg', 'Headphone', 'Headphone', 'Headphone', '2024-06-18 17:38:34'),
(12, 'Graphics Card', 'Graphics Card', 'Graphics Card', 0, 0, '6671c74160203.jpg', 'Graphics Card', 'Graphics Card', 'Graphics Card', '2024-06-18 17:43:29'),
(13, 'TV', 'TV', 'TV', 0, 0, '6671c75695516.jpg', 'TV', 'TV', 'TV', '2024-06-18 17:43:50'),
(14, 'Monitor', 'Monitor', 'Monitor', 0, 0, '6671c76a3c566.jpg', 'Monitor', 'Monitor', 'Monitor', '2024-06-18 17:44:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `tracking_no` varchar(191) NOT NULL,
  `user_id` int(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `address` mediumtext NOT NULL,
  `pincode` int(191) NOT NULL,
  `total_price` int(191) NOT NULL,
  `payment_mode` varchar(191) NOT NULL,
  `payment_id` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `comments` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `tracking_no`, `user_id`, `name`, `email`, `phone`, `address`, `pincode`, `total_price`, `payment_mode`, `payment_id`, `status`, `comments`, `created_at`) VALUES
(6, 'order667659bbd18532762', 6, 'Raffael Aldrich Setiawan', 'raffaelaldrichsetiawan@gmail.com', '081227772844', '123', 123, 280000000, 'COD', '', 0, NULL, '2024-06-22 04:57:31'),
(7, 'order6676bdd22d4166982', 6, 'Raffael Aldrich Setiawan', 'raffaelprgm@gmail.com', '(+62) 812 2777 2844', '123123', 123, 14000000, 'COD', '', 0, NULL, '2024-06-22 12:04:34'),
(8, 'order66787c083dbfe3299', 3, 'Raihan', 'raihan@gmail.com', '08111', 'Suruh', 1882, 10000000, 'COD', '', 2, NULL, '2024-06-23 19:48:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(191) NOT NULL,
  `prod_id` int(191) NOT NULL,
  `qty` int(191) NOT NULL,
  `price` int(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `prod_id`, `qty`, `price`, `created_at`) VALUES
(9, 6, 3, 10, 28000000, '2024-06-22 04:57:31'),
(10, 7, 5, 1, 14000000, '2024-06-22 12:04:34'),
(11, 8, 8, 1, 10000000, '2024-06-23 19:48:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `small_description` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `original_price` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `image` varchar(191) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `trending` tinyint(4) NOT NULL,
  `meta_title` varchar(191) NOT NULL,
  `meta_keywords` mediumtext NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `small_description`, `description`, `original_price`, `selling_price`, `image`, `qty`, `status`, `trending`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`) VALUES
(1, 6, 'Infinix GT 20', 'infinix-gt-20', 'Infinix GT 20 - Powerful performance and stunning design for the modern user.', 'The Infinix GT 20 offers a seamless blend of power and aesthetics, featuring a cutting-edge processor, high-resolution camera, and long-lasting battery. Ideal for users seeking both style and performance in a smartphone.', 5000000, 4500000, '66715ebadb44b.jpg', 10, 0, 1, 'Infinix GT 20 - Ultimate Performance and Design', 'Infinix GT 20, Infinix Smartphone, High-performance phone, Stylish smartphone', 'Discover the Infinix GT 20, a smartphone that combines powerful performance with stunning design. Perfect for modern users who demand more from their devices.', '2024-06-18 10:17:30'),
(2, 7, 'Asus ROG 14', 'asus-rog-14', 'Asus ROG 14 - Ultimate gaming laptop with unbeatable power.', 'The Asus ROG 14 is designed for gamers who demand the best. Featuring a high-refresh-rate display, top-tier graphics card, and advanced cooling system, this laptop ensures smooth and immersive gaming experiences. Its compact design makes it perfect for gaming on the go.', 20000000, 18000000, '6671615a17985.png', 10, 0, 1, 'Asus ROG 14 - Superior Gaming Laptop', 'Asus ROG 14, Gaming laptop, High-performance laptop, Portable gaming', 'The Asus ROG 14 is the ultimate gaming laptop, offering unbeatable power and portability. Experience superior gaming performance with this high-end device.', '2024-06-18 10:28:42'),
(3, 6, 'iPhone 15 Pro Max', 'iphone-15-pro-max', 'iPhone 15 Pro Max - The pinnacle of smartphone innovation.', 'The iPhone 15 Pro Max sets a new standard for smartphones with its advanced features and sleek design. Boasting a powerful A15 Bionic chip, professional-grade camera system, and an impressive OLED display, this device is perfect for those who want the best in mobile technology.', 30000000, 28000000, '6671a5cc5a27a.jpg', 30, 0, 1, 'iPhone 15 Pro Max - Unmatched Innovation and Performance', ' iPhone 15 Pro Max, Apple smartphone, High-end phone, Innovative technology', 'Experience unmatched innovation with the iPhone 15 Pro Max. Featuring a powerful processor, top-tier camera, and stunning display, this smartphone is perfect for those who demand excellence.', '2024-06-18 15:20:01'),
(5, 7, 'HP Victus 14', 'hp-victus-14', 'HP Victus 14 - Compact gaming powerhouse.', 'The HP Victus 14 is a compact yet powerful gaming laptop. Equipped with the latest graphics and processor, it delivers smooth gaming performance in a portable design. Ideal for gamers on the go who need reliable performance.', 16000000, 14000000, '6673a352f1e5e.png', 19, 0, 1, 'HP Victus 14 - Compact Gaming Powerhouse', 'HP Victus 14, Gaming laptop, Portable gaming, High-performance laptop', 'Discover the HP Victus 14, a compact gaming laptop that offers powerful performance and portability. Perfect for gamers on the move.', '2024-06-20 03:34:42'),
(6, 7, 'MacBook M2', 'macbook-m2', 'MacBook M2 - Cutting-edge performance and design.', 'The MacBook M2 represents the pinnacle of Apple\'s laptop technology. With the new M2 chip, it offers unprecedented performance and energy efficiency, along with a stunning Retina display and sleek design. Ideal for professionals and creatives.', 35000000, 33000000, '6673a515aecf3.png', 20, 0, 1, ' MacBook M2 - Unmatched Performance and Design', 'MacBook M2, Apple laptop, High-performance laptop, Professional laptop', 'Experience the MacBook M2, featuring Apple\'s latest M2 chip for unmatched performance and efficiency. Perfect for professionals and creatives seeking the best in laptop technology.', '2024-06-20 03:42:13'),
(7, 7, 'Acer Nitro V15', 'acer-nitro-v15', 'Acer Nitro V15 - Ultimate gaming experience.', 'The Acer Nitro V15 is built for serious gamers. Featuring a high-refresh-rate display, powerful graphics card, and advanced cooling technology, it ensures a seamless and immersive gaming experience. Perfect for those who demand the best in gaming laptops.', 18000000, 16500000, '6673a7912c0ed.png', 30, 0, 0, 'Acer Nitro V15 - Ultimate Gaming Experience', 'Acer Nitro V15, Gaming laptop, High-performance gaming, Immersive gaming', 'The Acer Nitro V15 offers the ultimate gaming experience with its powerful specs and advanced cooling technology. Perfect for serious gamers who want the best performance.', '2024-06-20 03:52:49'),
(8, 7, 'Axioo Pongoo 725', 'axioo-pongoo-725', 'Axioo Pongoo 725 - Affordable performance for daily tasks.', 'The Axioo Pongoo 725 is a budget-friendly laptop designed for everyday use. With reliable performance, a durable build, and long battery life, it is perfect for students and professionals who need an efficient and affordable computing solution.', 11000000, 10000000, '6673a826dbfe9.png', 19, 0, 1, 'Axioo Pongoo 725 - Affordable Daily Performance', 'Axioo Pongoo 725, Budget laptop, Daily use laptop, Affordable computing', 'Discover the Axioo Pongoo 725, a budget-friendly laptop offering reliable performance and durability. Perfect for everyday tasks, students, and professionals seeking an affordable solution.', '2024-06-20 03:55:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(191) NOT NULL,
  `user_email` varchar(191) NOT NULL,
  `user_phone` int(15) NOT NULL,
  `user_password` varchar(191) NOT NULL,
  `role_as` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_phone`, `user_password`, `role_as`, `created_at`) VALUES
(3, 'admin', '123@gmail.com', 123, '$2y$10$Pn4mWJf7C5facdL/6/cub.Hx/DHACNqwYc62uteyffKdg9WpX9RJy', 1, '2024-06-18 05:04:36'),
(4, 'user', 'ras@gmail.com', 123, '$2y$10$amVCjRq4v.gmCofsivDo.uzYaRyz8ozQvBkT8Qa91ghXNG7fG5n4C', 0, '2024-06-18 05:04:53'),
(6, 'raffael', 'raffael@gmail.com', 123123123, '$2y$10$TDBtk8AkQHE2Ic.DLnYY9eiOloR.f0piVDTzCx1RVvja17Jjl7sfe', 0, '2024-06-21 05:08:36'),
(7, 'raffael', 'asd@gmail.com', 123, '$2y$10$zFDqVXfqU6tdQWKAMSQ13uyZXz9GqatP2lnrIRJ8n8IH4ZXvRic26', 0, '2024-06-21 08:10:05'),
(8, 'admin', 'admin@gmail.com', 123, '$2y$10$mffuhN0lnseiSl47SAk.UexLJ4rNMW5o7hW7j8DHpKkw4DLoMfvJa', 1, '2024-06-23 21:43:39');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
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

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
