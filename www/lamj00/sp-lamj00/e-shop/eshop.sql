-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 04. čen 2021, 02:20
-- Verze serveru: 10.4.18-MariaDB
-- Verze PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `eshop`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `categories`
--

CREATE TABLE `categories` (
  `ID` int(255) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `categories`
--

INSERT INTO `categories` (`ID`, `category_name`) VALUES
(1, 'Processors'),
(2, 'Motherboards'),
(3, 'RAM'),
(4, 'HDD'),
(5, 'SSD'),
(6, 'Graphics cards'),
(7, 'Coolers');

-- --------------------------------------------------------

--
-- Struktura tabulky `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `fk_users_ID` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `orders`
--

INSERT INTO `orders` (`ID`, `total_price`, `fk_users_ID`, `date`, `address`) VALUES
(39, 814, 4, '2021-06-03 20:06:31', 'Kostelec 180, 2516 kamenice'),
(48, 64, 4, '2021-06-03 22:17:39', 'Jan Lampa\nKostelec 180, 2516 kamenice'),
(50, 123, 4, '2021-06-03 22:26:48', 'Jan Lampaaa\nKostelec 180, 2516 kamenice'),
(51, 305, 4, '2021-06-03 22:31:59', 'Jan Lampa\nKostelec 180, 2516 kamenice'),
(53, 0, 5, '2021-06-04 01:46:26', '\n'),
(54, 255, 5, '2021-06-04 01:48:00', 'Jannn Lampa\nVondr'),
(55, 255, 5, '2021-06-04 01:48:52', 'Jannn Lampa\nVondr'),
(56, 255, 5, '2021-06-04 01:49:57', 'Jannn Lampa\nVondr'),
(57, 255, 5, '2021-06-04 01:51:11', 'Jannn Lampa\nVondr'),
(58, 255, 5, '2021-06-04 01:52:13', 'Jannn Lampa\nVondr'),
(59, 255, 5, '2021-06-04 01:52:32', 'Jannn Lampa\nVondr'),
(60, 255, 5, '2021-06-04 01:52:42', 'Jannn Lampa\nVondr'),
(61, 255, 5, '2021-06-04 01:53:49', 'Jannn Lampa\nVondr'),
(62, 255, 5, '2021-06-04 01:53:58', 'Jannn Lampa\nVondr'),
(63, 255, 5, '2021-06-04 01:54:28', 'Jannn Lampa\nVondr'),
(64, 255, 5, '2021-06-04 01:56:48', 'Jannn Lampa\nVondr'),
(65, 255, 5, '2021-06-04 01:56:51', 'Jannn Lampa\nVondr'),
(66, 255, 5, '2021-06-04 01:56:53', 'Jannn Lampa\nVondr'),
(67, 255, 5, '2021-06-04 01:56:53', 'Jannn Lampa\nVondr'),
(68, 255, 5, '2021-06-04 02:01:40', 'Jannn Lampa\nVondr'),
(69, 255, 5, '2021-06-04 02:03:31', 'Jannn Lampa\nVondr'),
(70, 255, 5, '2021-06-04 02:05:29', 'Jannn Lampa\nVondr'),
(71, 255, 5, '2021-06-04 02:06:27', 'Jannn Lampa\nVondr'),
(72, 255, 5, '2021-06-04 02:08:10', 'Jannn Lampa\nVondr'),
(73, 255, 5, '2021-06-04 02:08:12', 'Jannn Lampa\nVondr'),
(74, 255, 5, '2021-06-04 02:08:19', 'Jannn Lampa\nVondr'),
(75, 255, 5, '2021-06-04 02:08:49', 'Jannn Lampa\nVondr'),
(76, 255, 5, '2021-06-04 02:09:00', 'Jannn Lampa\nVondr'),
(77, 255, 5, '2021-06-04 02:11:33', 'Jannn Lampa\nVondr'),
(78, 255, 5, '2021-06-04 02:12:04', 'Jannn Lampa\nVondr'),
(79, 255, 5, '2021-06-04 02:13:30', 'Jannn Lampa\nVondr');

-- --------------------------------------------------------

--
-- Struktura tabulky `orders_content`
--

CREATE TABLE `orders_content` (
  `fk_orders` int(11) NOT NULL,
  `fk_products` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `orders_content`
--

INSERT INTO `orders_content` (`fk_orders`, `fk_products`, `quantity`) VALUES
(48, 5, 1),
(50, 6, 1),
(51, 1, 1),
(51, 4, 1),
(54, 1, 1),
(55, 1, 1),
(56, 1, 1),
(57, 1, 1),
(58, 1, 1),
(59, 1, 1),
(60, 1, 1),
(61, 1, 1),
(62, 1, 1),
(63, 1, 1),
(64, 1, 1),
(65, 1, 1),
(66, 1, 1),
(67, 1, 1),
(68, 1, 1),
(69, 1, 1),
(70, 1, 1),
(71, 1, 1),
(72, 1, 1),
(73, 1, 1),
(74, 1, 1),
(75, 1, 1),
(76, 1, 1),
(77, 1, 1),
(78, 1, 1),
(79, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) NOT NULL,
  `fk_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `products`
--

INSERT INTO `products` (`ID`, `product_name`, `description`, `price`, `fk_category`) VALUES
(1, 'AMD Ryzen 5 5600X', 'Procesor 6 jádrový, 12 vláken, 3,7GHz (TDP 65W), Boost 4,6 GHz, 32MB L3 cache, Bez integrovaného grafického čipu, socket AMD AM4, Vermeer, box chladič, Wraith Stealth', 255, 1),
(2, 'Intel Core i9-11900KF', 'Procesor 16 jádrový, 32 vláken, 3,4GHz (TDP 105W), Boost 4,9 GHz, 64MB L3 cache, Bez integrovaného grafického čipu, socket AMD AM4, Vermeer, bez chladiče', 345, 1),
(3, 'AMD Ryzen 9 5950X', 'Procesor 8 jádrový, 16 vláken, 3,5GHz (TDP 125W), Boost 5,3 GHz, 16MB L3 cache, Bez integrovaného grafického čipu, socket Intel 1200, Rocket Lake-S, bez chladiče, pouze chipset Intel řady 5xx nebo Q470, Z490, H470', 150, 1),
(4, 'ASUS TUF Z390-PLUS GAMING (WI-FI)', 'Základní deska Intel Z390, socket Intel 1151 Coffee Lake, PCI Express 3.0, 2× PCIe x16, 4× PCIe x1, 4× DDR4 4266MHz (OC), 6× SATA III, 2ks M.2, USB 3.2 Gen 2, RJ-45 (LAN) 1Gbps, WiFi, Bluetooth, HDMI, DisplayPort, 8ch zvuková karta, RGB podsvícení, formát ATX', 50, 2),
(5, 'HyperX 32GB KIT DDR4 3200MHz CL16 FURY Black', 'Operační paměť 2x16GB, PC4-25600, CL16-20-20, napětí 1.35 V, pasivní chladič, Unbuffered a XMP 2.0', 64, 3),
(6, 'WD Red Plus 10TB', 'Pevný disk 3.5\", SATA III, maximální rychlost přenosu 215 MB/s, cache 256 MB, 7200 ot/min', 123, 4),
(7, 'Samsung 870 EVO 250GB', 'SSD disk 2.5\", SATA III, TLC (Triple-Level Cell), rychlost čtení 560MB/s, rychlost zápisu 530MB/s, životnost 150TBW', 68, 5),
(8, 'GIGABYTE GeForce GT 1030 Low Profile D4 2G', 'Grafická karta 2GB DDR4 (2100MHz), NVIDIA GeForce (, 1151 MHz), Boost 1417 MHz, PCI Express x16 3.0, 64Bit, DVI a HDMI', 258, 6),
(9, 'Cooler Master MasterLiquid Lite 240', 'Vodní chlazení - kompletní uzavřený set, pro socket AM2, AM2+, AM3, AM3+, AM4, FM1, FM2 a FM2+, 1200, 775, 1150, 1151, 1155, 1156, 1366, 2011, 2011-3 a 2066, 2x120mm ventilátor, max. otáčky 2000ot/min, rozměry (DxŠxV) 277x119,6x27 mm', 73, 7);

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `privileges` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`ID`, `username`, `email`, `password`, `address`, `firstName`, `lastName`, `privileges`) VALUES
(3, 'Username', 'Username@s.v', '$2y$10$qpuS.ErWvuZKXbUuq/LUBuojvHmJpV5hjp0Q8DSYIbs4EwXsgCK/O', 'Username', 'Abraham', 'Abrahamovič', 1),
(4, 'vingly', 'lamj00@vse.cz', '$2y$10$yq/UVImplHUAod0DkyovPuJgn15xASlO2NxgMtFIYSxON30dy8.cS', 'Kostelec 180, 2516 kamenice', 'Jan', 'Lampa', 3),
(5, 'lampa2255', 'lampa225@gmail.com', '$2y$10$yo91rmT3tBnPGfy7OsiUf.czShlDDMcz1TsAQaguRkjPabLQCjAWK', 'Vondráčkova 180, 150 00 Praha5', 'Jannn', 'Lampa', 1);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `categories`
--
ALTER TABLE `categories`
  ADD UNIQUE KEY `categories_category_name_uindex` (`category_name`),
  ADD UNIQUE KEY `categories_column_1_uindex` (`ID`);

--
-- Indexy pro tabulku `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `orders_ID_uindex` (`ID`),
  ADD KEY `orders_users_ID_fk` (`fk_users_ID`);

--
-- Indexy pro tabulku `orders_content`
--
ALTER TABLE `orders_content`
  ADD KEY `orders_content_orders_ID_fk` (`fk_orders`),
  ADD KEY `orders_content_product_ID_fk` (`fk_products`);

--
-- Indexy pro tabulku `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `product_id_product_uindex` (`ID`),
  ADD KEY `product_categories_ID_fk` (`fk_category`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `users_ID_uindex` (`ID`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT pro tabulku `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_users_ID_fk` FOREIGN KEY (`fk_users_ID`) REFERENCES `users` (`ID`);

--
-- Omezení pro tabulku `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_categories_ID_fk` FOREIGN KEY (`fk_category`) REFERENCES `categories` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
