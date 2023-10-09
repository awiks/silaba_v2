-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Agu 2023 pada 15.30
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bengkel_motor_gavi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account_categories`
--

CREATE TABLE `account_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_header_id` bigint(20) NOT NULL,
  `category_code` char(10) NOT NULL,
  `categories_name` char(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `account_categories`
--

INSERT INTO `account_categories` (`id`, `sub_header_id`, `category_code`, `categories_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '1.1.1', 'Kas & Bank', '2023-08-07 04:39:10', '2023-08-07 07:10:22', NULL),
(2, 1, '1.1.2', 'Piutang', '2023-08-07 04:40:11', '2023-08-07 04:40:11', NULL),
(3, 1, '1.1.3', 'Persediaan', '2023-08-07 04:40:25', '2023-08-07 04:40:25', NULL),
(4, 1, '1.1.4', 'Biaya dibayar dimuka', '2023-08-07 04:40:39', '2023-08-07 04:40:39', NULL),
(5, 1, '1.1.5', 'Investasi', '2023-08-07 04:40:50', '2023-08-07 04:40:50', NULL),
(6, 2, '1.2.1', 'Aset Berwujud', '2023-08-07 04:41:02', '2023-08-07 04:41:02', NULL),
(7, 2, '1.2.2', 'Aset Tak Berwujud', '2023-08-07 04:41:16', '2023-08-07 04:41:16', NULL),
(8, 3, '2.1.1', 'Utang Dagang', '2023-08-07 04:41:35', '2023-08-07 04:41:35', NULL),
(9, 3, '2.1.2', 'Beban yang masih harus dibayar', '2023-08-07 04:52:51', '2023-08-07 04:52:51', NULL),
(10, 8, '4.1.1', 'Pendapatan', '2023-08-10 05:14:53', '2023-08-10 05:15:05', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `account_headers`
--

CREATE TABLE `account_headers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header_code` int(11) NOT NULL,
  `header_name` char(200) NOT NULL,
  `serving_header` enum('1','2') NOT NULL COMMENT '1=Neraca 2=Laba Rugi',
  `normal_balance` enum('1','2') NOT NULL COMMENT '1=Debit 2=Kredit',
  `addition` enum('1','2') NOT NULL COMMENT '1=Debit 2=Kredit',
  `subtraction` enum('1','2') NOT NULL COMMENT '1=Debit 2=Kredit',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `account_headers`
--

INSERT INTO `account_headers` (`id`, `header_code`, `header_name`, `serving_header`, `normal_balance`, `addition`, `subtraction`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Aset', '1', '1', '1', '2', '2023-08-05 02:54:40', '2023-08-06 06:28:37', NULL),
(2, 2, 'Kewajiban', '1', '2', '2', '1', '2023-08-05 02:55:21', '2023-08-06 04:52:38', NULL),
(3, 3, 'Ekuitas', '1', '2', '2', '1', '2023-08-05 02:56:34', '2023-08-06 04:53:04', NULL),
(4, 4, 'Pendapatan', '2', '2', '2', '1', '2023-08-05 03:10:17', '2023-08-06 04:53:18', NULL),
(5, 5, 'Harga Pokok Penjualan (COGS)', '2', '1', '1', '2', '2023-08-05 03:11:01', '2023-08-07 11:49:14', NULL),
(6, 6, 'Beban', '2', '1', '1', '1', '2023-08-06 04:57:26', '2023-08-06 04:57:26', NULL),
(7, 7, 'Penghasilan diluar Usaha', '2', '1', '1', '1', '2023-08-06 04:58:12', '2023-08-06 04:58:12', NULL),
(8, 8, 'Beban diluar Usaha', '2', '2', '1', '1', '2023-08-06 04:58:32', '2023-08-06 04:58:32', NULL),
(9, 9, 'Pajak Badan', '2', '2', '1', '1', '2023-08-06 04:58:51', '2023-08-06 04:58:51', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `account_lists`
--

CREATE TABLE `account_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `lists_code` char(10) NOT NULL,
  `lists_name` char(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `account_lists`
--

INSERT INTO `account_lists` (`id`, `category_id`, `lists_code`, `lists_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '1.1.1.1', 'Kas', '2023-08-07 08:03:07', '2023-08-08 00:17:17', NULL),
(2, 1, '1.1.1.2', 'Bank BCA', '2023-08-07 10:30:34', '2023-08-07 10:30:34', NULL),
(3, 2, '1.1.2.1', 'Piutang Usaha', '2023-08-07 10:30:59', '2023-08-07 10:30:59', NULL),
(4, 2, '1.1.2.2', 'Piutang lainnya', '2023-08-07 10:31:14', '2023-08-07 10:31:14', NULL),
(5, 3, '1.1.3.1', 'Persediaan', '2023-08-07 10:31:29', '2023-08-07 10:31:29', NULL),
(6, 3, '1.1.3.2', 'Cadangan Persediaan Rusak', '2023-08-07 10:31:41', '2023-08-07 10:31:41', NULL),
(7, 4, '1.1.4.1', 'Biaya dibayar dimuka:sewa', '2023-08-07 10:32:21', '2023-08-07 10:32:21', NULL),
(8, 4, '1.1.4.2', 'Biaya dibayar dimuka:asuransi', '2023-08-07 10:32:35', '2023-08-07 10:32:35', NULL),
(9, 5, '1.1.5.1', 'Pembelian Saham', '2023-08-07 10:32:57', '2023-08-07 10:32:57', NULL),
(10, 6, '1.2.1.1', 'Tanah', '2023-08-07 10:34:02', '2023-08-07 10:34:02', NULL),
(11, 6, '1.2.1.2', 'Gedung', '2023-08-07 10:34:17', '2023-08-07 10:34:17', NULL),
(12, 6, '1.2.1.3', 'Kendaraan', '2023-08-07 10:34:29', '2023-08-07 10:34:29', NULL),
(13, 6, '1.2.1.4', 'Peralatan', '2023-08-07 10:34:48', '2023-08-07 10:34:48', NULL),
(14, 7, '1.2.2.1', 'Goodwill', '2023-08-07 10:35:12', '2023-08-07 10:35:12', NULL),
(15, 7, '1.2.2.2', 'Franchise', '2023-08-07 10:35:34', '2023-08-07 10:35:34', NULL),
(16, 8, '2.1.1.1', 'Utang Dagang', '2023-08-07 10:36:07', '2023-08-07 10:36:07', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `account_sub_headers`
--

CREATE TABLE `account_sub_headers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header_id` bigint(20) NOT NULL,
  `sub_header_code` char(10) NOT NULL,
  `header_sub_name` char(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `account_sub_headers`
--

INSERT INTO `account_sub_headers` (`id`, `header_id`, `sub_header_code`, `header_sub_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '1.1', 'Aset Lancar', '2023-08-06 05:37:21', '2023-08-07 02:57:24', NULL),
(2, 1, '1.2', 'Aset tidak lancar', '2023-08-06 05:37:21', '2023-08-07 02:47:14', NULL),
(3, 2, '2.1', 'Kewajiban lancar', '2023-08-07 05:37:21', '2023-08-07 05:37:21', NULL),
(4, 2, '2.2', 'Kewajiban Tidak Lancar', '2023-08-07 01:34:41', '2023-08-07 01:34:41', NULL),
(5, 3, '3.1', 'Modal', '2023-08-07 01:35:02', '2023-08-07 01:35:02', NULL),
(6, 3, '3.2', 'Saldo Laba', '2023-08-07 01:35:17', '2023-08-07 01:35:17', NULL),
(7, 3, '3.3', 'Deviden', '2023-08-07 01:35:30', '2023-08-07 01:35:30', NULL),
(8, 4, '4.1', 'Penjualan', '2023-08-07 01:35:52', '2023-08-07 01:35:52', NULL),
(9, 4, '4.2', 'Retur Penjualan', '2023-08-07 01:36:02', '2023-08-07 01:36:02', NULL),
(10, 4, '4.3', 'Diskon Penjualan', '2023-08-07 01:36:19', '2023-08-07 01:36:19', NULL),
(11, 5, '5.1', 'Persediaan Awal', '2023-08-07 01:36:29', '2023-08-07 01:36:29', NULL),
(12, 5, '5.2', 'Pembelian', '2023-08-07 01:37:03', '2023-08-07 01:37:03', NULL),
(13, 5, '5.3', 'Retur Pembelian', '2023-08-07 01:37:21', '2023-08-07 01:37:21', NULL),
(14, 5, '5.4', 'Persediaan Akhir', '2023-08-07 01:37:42', '2023-08-07 01:37:42', NULL),
(15, 5, '5.5', 'HPP Lainnya', '2023-08-07 01:38:00', '2023-08-07 01:38:00', NULL),
(16, 6, '6.1', 'Beban Penjualan', '2023-08-07 01:38:23', '2023-08-07 01:38:23', NULL),
(17, 6, '6.2', 'Beban Personalia', '2023-08-07 01:38:56', '2023-08-07 01:38:56', NULL),
(18, 6, '6.3', 'Beban administrasi dan umum', '2023-08-07 02:31:52', '2023-08-07 02:31:52', NULL),
(19, 7, '7.1', 'Penghasilan diluar Operasional', '2023-08-07 02:32:06', '2023-08-07 02:32:06', NULL),
(20, 8, '8.1', 'Biaya diluar usaha', '2023-08-07 02:32:21', '2023-08-07 02:32:21', NULL),
(21, 9, '9.1', 'Pajak penghasilan badan', '2023-08-07 02:32:32', '2023-08-07 02:32:32', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bicycles`
--

CREATE TABLE `bicycles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `police_number` char(20) NOT NULL,
  `brand` char(50) NOT NULL,
  `type` char(50) NOT NULL,
  `description` char(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bicycles`
--

INSERT INTO `bicycles` (`id`, `customer_id`, `police_number`, `brand`, `type`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'G-3261-UM', 'Honda', 'Beat Compact Sport Matic 2012 Biru Putih', NULL, '2023-07-22 05:29:34', '2023-07-22 05:29:34', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_brand` char(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `brands`
--

INSERT INTO `brands` (`id`, `name_brand`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Astra Otoparts', '2023-07-21 07:02:00', '2023-08-02 03:11:55', NULL),
(2, 'Bosch', '2023-07-21 07:02:00', '2023-07-21 07:02:00', NULL),
(3, 'Yamaha Genuine Parts', '2023-07-21 07:03:18', '2023-07-21 07:03:18', NULL),
(4, 'AHM Parts', '2023-07-21 07:03:18', '2023-07-21 07:03:18', NULL),
(5, 'Federal Oil', '2023-07-21 07:15:45', '2023-07-21 07:15:45', NULL),
(6, 'AHM Oil', '2023-07-21 07:03:18', '2023-07-21 07:03:18', NULL),
(7, 'NGK (Nippon Gaishi Kaisha)', '2023-07-22 06:07:29', '2023-07-22 06:07:29', NULL),
(8, 'Brembo', '2023-07-22 06:07:55', '2023-07-22 06:07:55', NULL),
(9, 'Denso', '2023-07-22 06:11:14', '2023-07-22 06:11:14', NULL),
(10, 'Ban FDR Champion', '2023-08-09 10:59:00', '2023-08-09 10:59:00', NULL),
(11, 'Ban Michelin', '2023-08-09 14:25:09', '2023-08-09 14:25:09', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Aki Motor', '2023-07-21 07:05:49', '2023-08-02 03:19:03', NULL),
(2, 'Ban', '2023-07-21 07:05:49', '2023-07-21 07:05:49', NULL),
(3, 'Lampu', '2023-07-21 07:06:20', '2023-07-21 07:06:20', NULL),
(4, 'Rantai', '2023-07-21 07:06:20', '2023-07-21 07:06:20', NULL),
(5, 'Busi', '2023-07-21 07:06:55', '2023-07-21 07:06:55', NULL),
(6, 'Tali Gas', '2023-07-21 07:06:55', '2023-07-21 07:06:55', NULL),
(7, 'Oli Motor', '2023-07-21 07:07:32', '2023-07-21 07:07:32', NULL),
(8, 'Kampas dan Tali Rem', '2023-07-21 07:07:32', '2023-07-21 07:07:32', NULL),
(9, 'Blok Silinder', '2023-07-22 06:52:40', '2023-07-22 06:52:40', NULL),
(10, 'Seal karet', '2023-07-22 07:01:12', '2023-07-22 07:01:12', NULL),
(11, 'Kunci Kontak', '2023-07-23 23:20:19', '2023-07-23 23:20:19', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `contact`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kasnawi', 'Desa Nyamok RT 01 RW 01 Kec.Kajen Kab.Pekalongan', '083892858498', 'kasnawi20@gmail.com', '2023-07-28 02:38:49', '2023-07-28 02:38:49', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` char(50) NOT NULL,
  `phone` char(50) NOT NULL,
  `email` char(100) DEFAULT NULL,
  `address` char(255) DEFAULT NULL,
  `birtday` date DEFAULT NULL,
  `status` enum('1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `employees`
--

INSERT INTO `employees` (`id`, `name`, `phone`, `email`, `address`, `birtday`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Rizki Fajar', '08485899382', NULL, NULL, '1990-07-24', '1', '2023-07-23 00:46:52', '2023-07-23 08:39:26', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_sku` char(50) DEFAULT NULL,
  `barcode` char(50) DEFAULT NULL,
  `brand_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `description` longtext DEFAULT NULL,
  `buy_checked` int(1) NOT NULL,
  `account_buy` bigint(20) NOT NULL,
  `tax_buy_id` bigint(20) DEFAULT NULL,
  `sell_cheked` int(1) NOT NULL,
  `account_sell` bigint(20) NOT NULL,
  `tax_sell_id` bigint(20) DEFAULT NULL,
  `inventory_checked` int(1) NOT NULL,
  `minimum_stock` int(11) DEFAULT NULL,
  `account_inventory` bigint(20) NOT NULL,
  `images` char(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`id`, `code_sku`, `barcode`, `brand_id`, `category_id`, `item_name`, `description`, `buy_checked`, `account_buy`, `tax_buy_id`, `sell_cheked`, `account_sell`, `tax_sell_id`, `inventory_checked`, `minimum_stock`, `account_inventory`, `images`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'SKU-00001', NULL, 5, 7, 'FEDERAL Oil Matic 40 10W-40 0.8L 800ml - Oli Motor Matic AT', 'Dengan kombinasi Advanced Active Moly dan Heat Protection Formulation menghasilkan keunggulan Spesialis Dingin menjadikan berkendara lebih nyaman', 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '2023-07-21 14:16:48', '2023-08-10 04:59:41', NULL),
(2, 'SKU-00002', NULL, 5, 7, 'FEDERAL Oil Matic 30 10W-30 0.8L 800ml - Oli Motor Matic AT', 'Dengan kombinasi Advanced Active Moly dan Heat Protection Formulation menghasilkan keunggulan Spesialis Dingin menjadikan berkendara lebih nyaman', 0, 0, 0, 0, 0, 0, 0, NULL, 0, '/storage/images/1691629556.ad677662-37cb-4041-a85b-611e7c45fb9d.jpg', '2023-07-21 14:18:49', '2023-08-10 01:05:56', NULL),
(3, 'SKU-00003', NULL, 5, 7, 'FEDERAL OIL Racing 10W-40 1L - Oli Motor Non Matic', 'Federal Racing 10W-40 adalah oli mesin skuter sintetik dengan kombinasi Viscoelastic Molecule dan Slip Resistant Layer menghasilkan akselerasi dan tenaga maksimum saat berkendara dengan performa tinggi', 0, 0, 0, 0, 0, 0, 0, NULL, 0, '/storage/images/1691629374.b065482d-2bd6-480a-9806-d4794d7e0dda.jpg', '2023-07-21 14:19:45', '2023-08-10 01:04:52', NULL),
(4, 'SKU-00004', NULL, 5, 7, 'FEDERAL OIL Ultratec xx 10W-40 0.8L 800ml - Oli Motor Non Matic 4T', 'Dengan kombinasi Slip Resistant Layer dan Wear Protection Technology menjadikan berkendara lebih nyaman', 0, 0, 0, 0, 0, 0, 0, NULL, 0, '/storage/images/1691629329.ec6ba9fc-e348-4323-a586-a2a3bf1aa138.jpg', '2023-07-21 14:20:24', '2023-08-10 01:02:09', NULL),
(5, 'SKU-00005', NULL, 5, 7, 'FEDERAL OIL Ultratec 20W-50 0.8L 800ml - Oli Motor Non Matic 4T', 'Wear Protection Technology mampu melindungi sepeda motor transmisi manual lebih lama, sehingga usia pakai menjadi lebih lama', 0, 0, 0, 0, 0, 0, 0, NULL, 0, '/storage/images/1691629293.8c921e18-94c1-41ea-ae4a-e0c0fdba3c79.jpg', '2023-07-21 14:20:52', '2023-08-10 01:01:33', NULL),
(6, 'SKU-00006', NULL, 5, 7, 'FEDERAL OIL Matic Gear Oil 10W-30 0.12L 120ml - Oli Pelumas Gir Matic', 'Pelumas sintetik motor 4T dan direkomendasikan sebagai oli untuk motor yang membutuhkan viskositas 10w - 40', 1, 1, 0, 1, 4, 0, 0, 0, 0, '/storage/images/1691629240.25624318-1cfb-470d-9d77-c210fb6915fc.jpg', '2023-07-21 14:22:04', '2023-08-10 01:41:51', NULL),
(7, 'SKU-00007', NULL, 6, 7, 'AHM OIL MPX2 – 0.8 L 10W-30 - Untuk Matic', 'Spesifikasi SAE:10W-30, API-SL, JASO:MB\r\n\r\nSangat hemat dengan penggantian yang lebih lama dan sekaligus mengurangi dampak pencemaran lingkungan. Memberikan daya lubrikasi sempurna untuk performa prima mesin sepeda motor Honda tipe kopling kering (matic).', 0, 0, 0, 0, 0, 0, 1, 2, 2, NULL, '2023-07-21 14:35:29', '2023-08-09 23:32:20', NULL),
(8, 'SKU-00008', NULL, 6, 7, 'AHM OIL SPX2 – SLMB 0.8 L REP - Untuk Matic', '<p>Spesifikasi SAE:10W-30, API-SL, JASO:MB AHM OIL SPX2 memberikan proteksi yang SUPERIOR untuk tuntutan performa mesin yang lebih tinggi pada seluruh sepeda motor Honda tipe kopling kering (matic).<br></p>', 0, 0, 0, 0, 0, 0, 1, NULL, 0, NULL, '2023-07-21 14:37:54', '2023-07-31 13:56:49', NULL),
(9, 'SKU-00009', NULL, 3, 3, 'Piting Lampu Depan Mio Sporty/Mio m3/Jupiter Burhan/Jupiter Z/Vega Zr/Vega R New', NULL, 0, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, '2023-07-23 23:17:44', '2023-07-23 23:17:44', NULL),
(10, 'SKU-00010', NULL, 3, 11, 'Kunci Kontak Mio Sporty Mio Smile Soul Nouvo(5TL-XH250-22)', NULL, 0, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, '2023-07-23 23:20:45', '2023-07-23 23:20:45', NULL),
(11, 'SKU-00011', NULL, 6, 7, 'Transmission Gear Oil', 'Mampu menahan tekanan kerja & temperatur yang tinggi terhadap daya pelumasan. Dengan formulasi tersebut, perpindahan gigi otomatis dapat tetap lembut dan lancar serta umur pakai unit CVT menjadi jauh lebih lama.', 0, 0, 0, 0, 0, 0, 1, NULL, 0, NULL, '2023-07-31 12:21:30', '2023-07-31 12:21:30', NULL),
(12, 'SKU-00012', NULL, 6, 7, 'AHM Oil MPX2 – 0.65 L 10W-30', '<p style=\"line-height: 1;\">Produk ini bisa digunakan oleh motor:\r\n</p><ul><li style=\"line-height: 1;\">BeAT dan BeAT Street K1A (2020 - Sekarang)\r\n</li><li style=\"line-height: 1.4;\">Genio (2019 - 2022)\r\n</li><li style=\"line-height: 1.4;\">Genio K0JN (2022 - Sekarang)\r\n</li><li style=\"line-height: 1.4;\">Scoopy K2F (2021 - Sekarang)</li></ul>', 0, 0, 0, 0, 0, 0, 1, NULL, 0, NULL, '2023-07-31 12:47:28', '2023-07-31 13:52:30', NULL),
(13, 'SKU-00013', NULL, 6, 7, 'Cairan Pendingin (Coolant) – Air Radiator', '<p style=\"line-height: 1.4;\">Produk ini bisa digunakan oleh motor:\r\n</p><ul><li style=\"line-height: 1.4;\">\r\nPCX 125 CBU (2010 - 2012)</li><li style=\"line-height: 1.4;\"><span style=\"font-size: 0.9rem;\">PCX 150 CBU (2012 - 2014)\r\n</span></li><li style=\"line-height: 1.4;\"><span style=\"font-size: 0.9rem;\">PCX 150 CBU K36J (2014 - 2017)\r\n</span></li><li style=\"line-height: 1.4;\"><span style=\"font-size: 0.9rem;\">PCX 150 K97 (2017 - 2021)\r\n</span></li><li style=\"line-height: 1.4;\"><span style=\"font-size: 0.9rem;\">PCX 160 K1Z (2021 - Sekarang)\r\n</span></li><li style=\"line-height: 1.4;\"><span style=\"font-size: 0.9rem;\">Vario 110 CW (2006 - 2014)\r\n</span></li><li style=\"line-height: 1.4;\"><span style=\"font-size: 0.9rem;\">Vario 125 eSP K60R (2018 - 2022)\r\n</span></li><li style=\"line-height: 1.4;\"><span style=\"font-size: 0.9rem;\">Vario 150 eSP K59J (2018 - 2022)\r\n</span></li><li style=\"line-height: 1.4;\"><span style=\"font-size: 0.9rem;\">Vario Techno 125 FI CBS ISS (2013 - 2015)\r\n</span></li><li style=\"line-height: 1.4;\"><span style=\"font-size: 0.9rem;\">Vario Techno 125 FI STD (2013 - 2015)\r\n</span></li><li style=\"line-height: 1.4;\"><span style=\"font-size: 0.9rem;\">Vario Techno 125 Helm-In FI (2012 - 2013)\r\n</span></li><li style=\"line-height: 1.4;\"><span style=\"font-size: 0.9rem;\">Vario Techno 125 Helm-In FI CBS (2012 - 2013)</span></li></ul>', 0, 0, 0, 0, 0, 0, 1, NULL, 0, NULL, '2023-07-31 12:56:33', '2023-07-31 23:40:59', NULL),
(14, 'SKU-00014', NULL, 1, 2, 'Ban Federal Motor Beat', NULL, 1, 1, NULL, 1, 5, NULL, 0, NULL, 0, NULL, '2023-08-09 10:54:09', '2023-08-09 10:56:42', '2023-08-09 10:56:42'),
(15, 'SKU-00021', NULL, 10, 2, 'BLAZE SE 110/70-17 Tubeless', '<p><span style=\"font-size: 14.4px;\">Ban balap motor sport yang dirancang khusus untuk kondisi sirkuit kering.</span><br></p>', 1, 1, NULL, 1, 4, NULL, 1, 2, 5, '/storage/images/1691590919.BLAZE SE.png', '2023-08-09 11:14:09', '2023-08-09 14:21:59', NULL),
(16, 'SKU-00022', NULL, 10, 2, 'BLAZE SE 130/70-17 Tubeless', '<p><span style=\"font-size: 14.4px;\">Ban balap motor sport yang dirancang khusus untuk kondisi sirkuit kering.</span><br></p>', 1, 2, NULL, 1, 4, NULL, 1, 3, 5, '/storage/images/1691590886.5d53b4b28c40b.png', '2023-08-09 11:18:54', '2023-08-09 14:21:26', NULL),
(17, 'SKU-00023', NULL, 10, 2, 'Maxtreme SE 110/70-17 Tubeless', '<p style=\"line-height: 1;\"><span style=\"font-size: 14.4px;\"><b>Soft compound</b></span></p><ul><li style=\"line-height: 1;\">Untuk daya cengkeram maksimal saat balapan</li></ul><p style=\"line-height: 1;\"><span style=\"font-size: 14.4px;\"><b>Ban basah</b></span></p><ul><li style=\"line-height: 1;\"><span style=\"font-size: 14.4px;\">Cocok untuk digunakan di trek basah dan trek basah</span></li></ul><p style=\"line-height: 1;\"><span style=\"font-size: 14.4px;\"><b>Progresif TWI</b></span></p><ul><li style=\"line-height: 1;\"><span style=\"font-size: 14.4px;\">Indikator keausan ban progresif yang memberi peringatan dini</span><br><br></li></ul>', 1, 1, 0, 1, 2, 0, 0, 0, 0, '/storage/images/1691590908.b49f64fa-b40d-4dfa-b0c5-8582fc7d0773.png', '2023-08-09 11:23:14', '2023-08-10 01:42:18', NULL),
(18, 'SKU-00024', NULL, 11, 2, 'CITY GRIP', '<div><font color=\"#333333\" face=\"Noto Sans, arial, sans-serif\"><span style=\"font-size: 16px;\">Generasi pertama dari rangkaian MICHELIN City Grip</span></font><br></div><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; color: rgb(51, 51, 51); font-family: &quot;Noto Sans&quot;, arial, sans-serif; font-size: 16px; border: 0px; padding: 0px; vertical-align: baseline; list-style-position: outside; list-style-image: initial; margin-inline-start: 2rem;\"><li style=\"border: 0px; margin: 0px; padding: 0px; vertical-align: baseline;\">Cengkraman di jalanan basah bahkan hujan!</li><li style=\"border: 0px; margin: 0px; padding: 0px; vertical-align: baseline;\">Performa terbaik sampai akhir pemakaian</li><li style=\"border: 0px; margin: 0px; padding: 0px; vertical-align: baseline;\">Digunakan oleh satu atau lebih manufaktur</li></ul>', 1, 5, NULL, 0, 0, NULL, 0, NULL, 0, '/storage/images/1691591286.cl96xtuw40f8x01o5yhpmnhmi-cgi-michelin-city-grip.webp', '2023-08-09 14:28:06', '2023-08-09 14:30:39', '2023-08-09 14:30:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_07_19_033930_create_customers_table', 1),
(7, '2023_07_19_184450_create_bicycles_table', 1),
(8, '2023_07_20_201335_create_brands_table', 1),
(9, '2023_07_20_202453_create_categories_table', 1),
(10, '2023_07_20_203927_create_units_table', 1),
(11, '2023_07_20_204037_create_items_table', 1),
(12, '2023_07_22_140352_create_suppliers_table', 2),
(13, '2023_07_22_155046_create_employees_table', 3),
(14, '2023_07_25_075759_create_unit_conversions_table', 4),
(15, '2023_08_01_110935_create_taxes_table', 5),
(16, '2023_08_01_210444_create_account_categories_table', 7),
(23, '2023_08_01_180422_create_account_headers_table', 8),
(24, '2023_08_02_194154_create_account_lists_table', 8),
(25, '2023_08_06_122843_create_account_sub_headers_table', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `phone`, `email`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Allbeknow Indonesia', '0867866655', NULL, NULL, '2023-07-22 07:59:08', '2023-07-22 07:59:08', NULL),
(2, 'Kasnawi', '083892858498', NULL, 'Jakarta', '2023-07-22 08:37:46', '2023-07-22 08:39:06', '2023-07-22 08:39:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tax_name` varchar(50) NOT NULL,
  `percentage` decimal(5,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `taxes`
--

INSERT INTO `taxes` (`id`, `tax_name`, `percentage`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PPN', '11', '2023-08-01 04:46:13', '2023-08-09 01:34:17', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `units`
--

INSERT INTO `units` (`id`, `unit_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PCS', '2023-07-24 04:24:16', '2023-08-02 03:05:08', NULL),
(2, 'BOX', '2023-07-24 04:33:24', '2023-07-24 04:33:24', NULL),
(3, 'Lusin', '2023-07-25 06:01:09', '2023-08-02 02:36:12', NULL),
(6, 'Galon', '2023-07-28 00:21:45', '2023-08-02 02:21:17', NULL),
(7, 'Liter', '2023-07-28 00:22:21', '2023-08-16 06:33:53', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_conversions`
--

CREATE TABLE `unit_conversions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `unit_id` bigint(20) NOT NULL,
  `amount` decimal(5,0) NOT NULL,
  `unit_type` enum('1','2') NOT NULL COMMENT '1=Satuan Dasar 2=Konversi',
  `buy_price` decimal(15,0) DEFAULT NULL,
  `sell_price` decimal(15,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `unit_conversions`
--

INSERT INTO `unit_conversions` (`id`, `item_id`, `unit_id`, `amount`, `unit_type`, `buy_price`, `sell_price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, 1, '1', '1', '84430', '0', '2023-07-28 02:11:48', '2023-07-31 12:41:32', NULL),
(2, 10, 2, '24', '2', '2026320', '0', '2023-07-28 02:11:48', '2023-07-31 12:41:32', NULL),
(3, 8, 1, '1', '1', '60000', '0', '2023-07-31 05:17:24', '2023-07-31 12:19:39', NULL),
(4, 8, 2, '24', '2', '1440000', '0', '2023-07-31 05:17:24', '2023-07-31 12:19:39', NULL),
(5, 7, 1, '1', '1', '49000', '0', '2023-07-31 12:18:41', '2023-07-31 12:18:41', NULL),
(6, 11, 1, '1', '1', '16500', '0', '2023-07-31 12:22:05', '2023-07-31 12:27:59', NULL),
(7, 2, 1, '1', '1', '54000', '0', '2023-07-31 12:31:54', '2023-07-31 12:31:54', NULL),
(8, 1, 1, '1', '1', '54000', '0', '2023-07-31 12:34:45', '2023-08-10 04:59:41', NULL),
(9, 4, 1, '1', '1', '53000', '0', '2023-07-31 12:36:30', '2023-07-31 12:36:30', NULL),
(10, 3, 1, '1', '1', '65000', '0', '2023-07-31 12:37:27', '2023-07-31 12:37:27', NULL),
(11, 5, 1, '1', '1', '47000', '0', '2023-07-31 12:38:27', '2023-07-31 12:38:27', NULL),
(12, 6, 1, '1', '1', '13500', '17000', '2023-07-31 12:39:45', '2023-08-10 10:03:47', NULL),
(13, 12, 1, '1', '1', '49000', '0', '2023-07-31 12:48:00', '2023-07-31 12:48:00', NULL),
(14, 13, 1, '1', '1', '19500', '0', '2023-07-31 12:56:50', '2023-08-10 04:12:44', NULL),
(15, 13, 2, '24', '2', '468000', '0', '2023-08-08 01:56:20', '2023-08-10 04:12:44', NULL),
(18, 14, 1, '1', '1', '250000', '0', '2023-08-09 10:54:09', '2023-08-09 10:56:42', '2023-08-09 10:56:42'),
(19, 15, 1, '1', '1', '535000', '635000', '2023-08-09 11:14:09', '2023-08-09 11:35:07', NULL),
(20, 16, 1, '1', '1', '720000', '820000', '2023-08-09 11:18:54', '2023-08-09 11:18:54', NULL),
(21, 17, 1, '1', '1', '535000', '750000', '2023-08-09 11:23:14', '2023-08-15 13:49:52', NULL),
(24, 9, 1, '1', '1', '537000', '637000', '2023-08-09 11:23:14', '2023-08-09 11:23:14', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `account_categories`
--
ALTER TABLE `account_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `account_headers`
--
ALTER TABLE `account_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `account_lists`
--
ALTER TABLE `account_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `account_sub_headers`
--
ALTER TABLE `account_sub_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bicycles`
--
ALTER TABLE `bicycles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `unit_conversions`
--
ALTER TABLE `unit_conversions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `account_categories`
--
ALTER TABLE `account_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `account_headers`
--
ALTER TABLE `account_headers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `account_lists`
--
ALTER TABLE `account_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `account_sub_headers`
--
ALTER TABLE `account_sub_headers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `bicycles`
--
ALTER TABLE `bicycles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `unit_conversions`
--
ALTER TABLE `unit_conversions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
