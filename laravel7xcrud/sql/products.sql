-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 16, 2020 lúc 04:45 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laravel7xcrud`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_publish` datetime NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_image`, `product_desc`, `product_publish`, `product_quantity`, `product_price`, `created_at`, `updated_at`) VALUES
(2, 'headphone', '', 'sony', '2020-08-16 04:04:12', 1, '500.00', '2020-08-14 05:27:20', '2020-08-15 21:04:12'),
(3, 'Jelani Clayton', '', 'Pariatur Voluptatib', '2020-08-16 04:06:56', 412, '919.00', '2020-08-14 06:20:44', '2020-08-15 21:06:56'),
(4, 'Nora Lloyd', '', 'Ullam aut voluptatem', '2020-08-16 04:06:04', 315, '556.00', '2020-08-14 06:21:13', '2020-08-15 21:06:04'),
(5, 'Eagan Frederick', '', 'Obcaecati fuga Volu', '2020-08-14 13:27:03', 361, '425.00', '2020-08-14 06:27:03', '2020-08-14 06:27:03'),
(6, 'sữa chua', '', 'dẻo', '2020-08-15 11:24:24', 11, '7000.00', '2020-08-15 04:24:24', '2020-08-15 04:24:24'),
(7, 'mobile', '', 'iphone 11', '2020-08-16 04:00:32', 1, '2000.00', '2020-08-15 21:00:32', '2020-08-15 21:00:32');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
