-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: mai 29, 2024 la 05:24 PM
-- Versiune server: 10.4.32-MariaDB
-- Versiune PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `ceramica`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `prod_id`, `prod_qty`, `created_at`) VALUES
(140, 10, 12, 3, '2023-12-05 07:57:57'),
(186, 14, 14, 1, '2024-04-27 14:47:40'),
(187, 14, 18, 1, '2024-04-27 14:47:40'),
(188, 8, 0, 1, '2024-04-28 08:43:38'),
(197, 8, 15, 1, '2024-05-07 09:21:20'),
(201, 8, 13, 1, '2024-05-07 13:28:33'),
(202, 17, 8, 1, '2024-05-16 15:26:00'),
(203, 17, 13, 1, '2024-05-16 15:26:05');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `categories`
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
-- Eliminarea datelor din tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `status`, `popular`, `image`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`) VALUES
(6, 'Mic dejun', 'micdejun', '', 1, 1, '1714226855.jpg', '', '', '', '2023-11-30 10:43:08'),
(7, 'Pranz', 'pranz', '', 1, 1, '1714226865.jpg', '', '', '', '2023-12-01 10:06:01'),
(8, 'Cina', 'cina', '', 1, 1, '1714226873.jpg', '', '', '', '2023-12-01 10:06:49'),
(13, 'Desert', 'desert', '', 1, 1, '1714226884.jpg', '', '', '', '2024-04-27 14:05:03'),
(14, 'Mexicana', 'mexicana', '', 1, 0, '1715075887.jpg', '', '', '', '2024-04-28 11:08:17'),
(15, 'Italiana', 'italiana', '', 1, 0, '1715075936.jpg', '', '', '', '2024-04-28 11:08:35'),
(17, 'Vegetariana', 'vegetariana', '', 1, 0, '1715075955.jpg', '', '', '', '2024-04-28 11:08:45'),
(18, 'Greceasca', 'greceasca', '', 1, 0, '1715075977.jpg', '', '', '', '2024-04-28 11:08:51'),
(19, 'Asiatica', 'asiatica', '', 1, 0, '1715075992.jpg', '', '', '', '2024-04-28 11:09:11');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `cupoane`
--

CREATE TABLE `cupoane` (
  `id` int(11) NOT NULL,
  `cupon` varchar(30) NOT NULL,
  `valoare` int(4) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `cupoane`
--

INSERT INTO `cupoane` (`id`, `cupon`, `valoare`, `status`) VALUES
(4, 'iarna15', 15, 1),
(5, 'reducere10', 10, 0);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `filtre`
--

CREATE TABLE `filtre` (
  `id` int(11) NOT NULL,
  `nume_filtru` varchar(255) DEFAULT NULL,
  `valoare_filtru` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `filtre`
--

INSERT INTO `filtre` (`id`, `nume_filtru`, `valoare_filtru`) VALUES
(1, 'Timpul de preparare', 'Mai puțin de 10 minute'),
(2, 'Timpul de preparare', '10 - 20 minute'),
(3, 'Timpul de preparare', '20 - 30 minute'),
(4, 'Timpul de preparare', '30 - 40 minute'),
(5, 'Timpul de preparare', '40 - 50 minute'),
(6, 'Timpul de preparare', '50 - 60 minute'),
(7, 'Timpul de preparare', 'Peste 60 de minute'),
(8, 'Valoarea calorică', 'Mai puțin de 50 calorii'),
(9, 'Valoarea calorică', '50 - 100 calorii'),
(10, 'Valoarea calorică', '100 - 200 calorii'),
(11, 'Valoarea calorică', '200 - 300 calorii'),
(12, 'Valoarea calorică', '300 - 400 calorii'),
(13, 'Valoarea calorică', '400 - 500 calorii'),
(14, 'Valoarea calorică', 'Peste 500 calorii'),
(15, 'Numărul de ingrediente', 'Mai puțin de 5 ingrediente'),
(16, 'Numărul de ingrediente', '5 - 10 ingrediente'),
(17, 'Numărul de ingrediente', '10 - 20 ingrediente'),
(18, 'Numărul de ingrediente', '20 - 30 ingrediente'),
(19, 'Numărul de ingrediente', 'Mai mult de 30 de ingrediente'),
(20, 'Alergeni', 'Gluten'),
(21, 'Alergeni', 'Lapte de vaca'),
(22, 'Alergeni', 'Soia'),
(23, 'Alergeni', 'Telina');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `news_letter`
--

CREATE TABLE `news_letter` (
  `id` int(11) NOT NULL,
  `email` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `news_letter`
--

INSERT INTO `news_letter` (`id`, `email`) VALUES
(2, 'ssdsadd@fff'),
(7, 'miau@mail.com'),
(8, 'maria@gmail.com');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `tracking_no` varchar(191) NOT NULL,
  `user_id` int(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `adress` mediumtext NOT NULL,
  `pincode` int(191) NOT NULL,
  `total_price` int(191) NOT NULL,
  `payment_mode` varchar(191) NOT NULL,
  `payment_id` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `comments` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `orders`
--

INSERT INTO `orders` (`id`, `tracking_no`, `user_id`, `name`, `email`, `phone`, `adress`, `pincode`, `total_price`, `payment_mode`, `payment_id`, `status`, `comments`, `created_at`) VALUES
(1, 'comanda241sfdsfd', 8, 'ddsd', 'fdsfds', 'fdsfdsfd', 'fds', 0, 40, 'COD', '', 1, NULL, '2023-12-01 18:41:18'),
(2, 'comanda253fdsf', 8, 'f', 'ddsfdf', 'dsfdsf', 'dssdf', 0, 40, '', '', 0, NULL, '2023-12-01 18:51:29'),
(3, 'comanda740fgf', 8, 'gfdgdgfdg', 'denisa@gmail.com', 'fdfgf', 'fdgfdg', 0, 40, 'COD', '', 0, NULL, '2023-12-01 18:51:51'),
(4, 'comanda979hgfh', 8, 'hhfg', 'miau@miau.com', 'gfhgfh', 'gfhgf', 0, 40, 'COD', '', 1, NULL, '2023-12-01 18:54:35'),
(5, 'comanda333dsa', 8, 'dsadas', 'denisa@gmail.com', 'sadsa', 'sdasd', 0, 40, 'COD', '', 0, NULL, '2023-12-01 18:55:11'),
(6, 'comanda476sdsad', 8, 'asdasd', 'asdsad@asdsadsa', 'dasdsad', 'sadsadsddssdfds', 0, 200, 'COD', '', 0, NULL, '2023-12-02 09:26:46'),
(7, 'comanda852f', 8, 'dfsdf', 'admin@2mail', 'dsf', 'dsfds', 0, 160, 'COD', '', 0, NULL, '2023-12-02 09:28:22'),
(8, 'comanda9352526', 8, 'ion popescu', 'ion@popescu', '332526', 'dsa ffd grfgfd ', 369, 180, 'COD', '', 0, NULL, '2023-12-02 10:51:17'),
(9, '307659', 8, 'ion popescu', 'ionpopescu@mail.com', '23659', 'ssa sdd asd sasda ', 222, 95, 'COD', '', 1, NULL, '2023-12-02 13:15:04'),
(10, '467215963', 8, 'Ion Popescu', 'ionpopescu@mail.com', ' 7215963', 'Str amurgului', 963, 204, 'cash', '', 0, NULL, '2023-12-12 18:54:36'),
(11, '540215963', 8, 'Ion Popescu', 'ionpopescu@mail.com', ' 7215963', 'Str amurgului', 963, 35, 'card', '', 0, NULL, '2023-12-12 18:55:20'),
(12, '310215963', 8, 'Ion Popescu', 'ionpopescu@mail.com', ' 7215963', 'Str amurgului', 963, 35, 'card', '', 0, NULL, '2023-12-12 18:56:01'),
(13, '658215963', 8, 'Ion Popescu', 'ionpopescu@mail.com', ' 7215963', 'Str amurgului', 963, 100, 'cash', '', 0, NULL, '2023-12-15 13:06:40'),
(14, '257215963', 8, 'Ion Popescu', 'ionpopescu@mail.com', ' 7215963', 'Str amurgului', 963, 179, 'cash', '', 1, 'vreau sa fie impachetata frumos', '2023-12-15 15:27:10'),
(15, '315215963', 11, ' Danciu  Denisa', 'danciudenisa12@gmail.com', ' 7215963', 'Timisoara, Timis, str Dropiei, nr 7', 98563, 48, '', '', 0, NULL, '2023-12-16 09:48:52'),
(16, '256215963', 11, ' Danciu  Denisa', 'danciudenisa12@gmail.com', ' 7215963', 'Timisoara, Timis, str Dropiei, nr 7', 98563, 171, 'cash', '', 0, NULL, '2023-12-16 10:27:44'),
(17, '839215963', 11, ' Danciu  Denisa', 'danciudenisa12@gmail.com', ' 7215963', 'Timisoara, Timis, str Dropiei, nr 7', 98563, 25, 'cash', '', 0, NULL, '2023-12-16 12:05:12'),
(18, '420215963', 11, ' Danciu  Denisa', 'danciudenisa12@gmail.com', ' 7215963', 'Timisoara, Timis, str Dropiei, nr 7', 98563, 16, 'cash', '', 0, NULL, '2023-12-16 12:11:58'),
(19, '503215963', 11, ' Danciu  Denisa', 'danciudenisa12@gmail.com', ' 7215963', 'Timisoara, Timis, str Dropiei, nr 7', 98563, 35, 'cash', '', 0, NULL, '2023-12-16 12:52:03'),
(20, '966215963', 11, ' Danciu  Denisa', 'danciudenisa12@gmail.com', ' 7215963', 'Timisoara, Timis, str Dropiei, nr 7', 98563, 35, 'cash', '', 0, NULL, '2023-12-16 12:56:02'),
(21, '700215963', 11, ' Danciu  Denisa', 'danciudenisa12@gmail.com', ' 7215963', 'Timisoara, Timis, str Dropiei, nr 7', 98563, 35, 'cash', '', 0, NULL, '2023-12-16 13:02:15'),
(22, '778215963', 11, ' Danciu  Denisa', 'danciudenisa12@gmail.com', ' 7215963', 'Timisoara, Timis, str Dropiei, nr 7', 98563, 10, 'cash', '', 0, NULL, '2023-12-16 13:05:10'),
(23, '265215963', 11, ' Danciu  Denisa', 'danciudenisa12@gmail.com', ' 7215963', 'Timisoara, Timis, str Dropiei, nr 7', 98563, 35, 'cash', '', 0, NULL, '2023-12-16 13:05:40'),
(24, '425215963', 11, ' Danciu  Denisa', 'danciudenisa12@gmail.com', ' 7215963', 'Timisoara, Timis, str Dropiei, nr 7', 98563, 24, 'cash', '', 0, NULL, '2023-12-16 13:08:50'),
(25, '778215963', 11, ' Danciu  Denisa', 'danciudenisa12@gmail.com', ' 7215963', 'Timisoara, Timis, str Dropiei, nr 7', 98563, 16, 'cash', '', 0, NULL, '2023-12-16 13:09:54'),
(26, '720215963', 11, ' Danciu  Denisa', 'danciudenisa12@gmail.com', ' 7215963', 'Timisoara, Timis, str Dropiei, nr 7', 98563, 35, 'cash', '', 1, NULL, '2023-12-16 13:12:45'),
(27, '196215963', 8, 'Ion Popescu', 'ionpopescu@mail.com', ' 7215963', 'Arad, Arad, Strada Soarelui, nr 40', 963, 317, 'cash', '', 1, NULL, '2023-12-19 08:00:26');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `order_items`
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
-- Eliminarea datelor din tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `prod_id`, `qty`, `price`, `created_at`) VALUES
(1, 1, 12, 1, 40, '2023-12-01 18:41:18'),
(2, 2, 12, 1, 40, '2023-12-01 18:51:29'),
(3, 3, 12, 1, 40, '2023-12-01 18:51:51'),
(4, 4, 12, 1, 40, '2023-12-01 18:54:35'),
(5, 5, 12, 1, 40, '2023-12-01 18:55:11'),
(6, 6, 12, 5, 40, '2023-12-02 09:26:46'),
(7, 6, 12, 5, 40, '2023-12-02 09:26:46'),
(8, 7, 12, 4, 40, '2023-12-02 09:28:22'),
(9, 8, 12, 3, 40, '2023-12-02 10:51:17'),
(10, 8, 13, 1, 60, '2023-12-02 10:51:17'),
(11, 9, 13, 1, 60, '2023-12-02 13:15:04'),
(12, 9, 14, 1, 35, '2023-12-02 13:15:04'),
(13, 10, 12, 3, 40, '2023-12-12 18:54:36'),
(14, 10, 13, 1, 60, '2023-12-12 18:54:36'),
(15, 10, 16, 1, 24, '2023-12-12 18:54:36'),
(16, 11, 14, 1, 35, '2023-12-12 18:55:20'),
(17, 12, 14, 1, 35, '2023-12-12 18:56:01'),
(18, 13, 26, 1, 16, '2023-12-15 13:06:40'),
(19, 13, 16, 1, 24, '2023-12-15 13:06:40'),
(20, 13, 13, 1, 60, '2023-12-15 13:06:40'),
(21, 14, 24, 3, 15, '2023-12-15 15:27:10'),
(22, 14, 27, 1, 35, '2023-12-15 15:27:10'),
(23, 14, 26, 4, 16, '2023-12-15 15:27:10'),
(24, 14, 14, 1, 35, '2023-12-15 15:27:10'),
(25, 15, 26, 3, 16, '2023-12-16 09:48:52'),
(26, 16, 20, 1, 30, '2023-12-16 10:27:44'),
(27, 16, 19, 1, 90, '2023-12-16 10:27:44'),
(28, 16, 18, 1, 35, '2023-12-16 10:27:44'),
(29, 16, 26, 1, 16, '2023-12-16 10:27:44'),
(30, 17, 21, 1, 25, '2023-12-16 12:05:12'),
(31, 18, 26, 1, 16, '2023-12-16 12:11:58'),
(32, 19, 14, 1, 35, '2023-12-16 12:52:03'),
(33, 20, 18, 1, 35, '2023-12-16 12:56:02'),
(34, 21, 27, 1, 35, '2023-12-16 13:02:15'),
(35, 22, 29, 1, 10, '2023-12-16 13:05:10'),
(36, 23, 14, 1, 35, '2023-12-16 13:05:40'),
(37, 24, 16, 1, 24, '2023-12-16 13:08:50'),
(38, 25, 26, 1, 16, '2023-12-16 13:09:54'),
(39, 26, 27, 1, 35, '2023-12-16 13:12:45'),
(40, 27, 31, 6, 27, '2023-12-19 08:00:26'),
(41, 27, 27, 4, 35, '2023-12-19 08:00:26'),
(42, 27, 24, 1, 15, '2023-12-19 08:00:26');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `small_description` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `selling_price` int(11) NOT NULL,
  `image` varchar(191) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `trending` tinyint(4) NOT NULL,
  `meta_title` varchar(191) NOT NULL,
  `meta_keywords` mediumtext NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `likes` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `small_description`, `description`, `selling_price`, `image`, `qty`, `status`, `trending`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `likes`) VALUES
(13, 6, 'Farfurie frunze', 'farfurii-2', 'Farfuriile roșii strălucesc cu o eleganță aparte, conturând imagini rafinate și culori vii. Picturile delicate aduc un farmec aparte oricărei mese și adaugă o notă de rafinament în orice interior.', 'Farfuriile roșii strălucesc cu o eleganță aparte, conturând imagini rafinate și culori vii. Picturile delicate aduc un farmec aparte oricărei mese și adaugă o notă de rafinament în orice interior.\r\nDiametru: 25 cm', 60, '1701514210.png', 60, 1, 0, 'Farfurii2', 'farfurie,farfurii,frunze,minimalist,', 'Farfuriile roșii strălucesc cu o eleganță aparte, conturând imagini rafinate și culori vii. Picturile delicate aduc un farmec aparte oricărei mese și adaugă o notă de rafinament în orice interior.', '2023-12-02 10:50:10', -3),
(14, 6, 'Cana ', 'cana-vintage', 'Experimentați eleganța clasică cu această cană vintage albă și maro. Designul său simplu, dar rafinat, combină albul curat cu accentele de maro, aducând o notă de distincție la fiecare băutură.', 'Experimentați eleganța clasică cu această cană vintage albă și maro. Designul său simplu, dar rafinat, combină albul curat cu accentele de maro, aducând o notă de distincție la fiecare băutură.', 35, '1701517739.png', 80, 1, 0, 'Cana maro', 'cana,ceai,cafea,cani, ceasca, set', 'Experimentați eleganța clasică cu această cană vintage albă și maro. Designul său simplu, dar rafinat, combină albul curat cu accentele de maro, aducând o notă de distincție la fiecare băutură.', '2023-12-02 11:48:59', 0),
(15, 8, 'Suport Lumanare Craciun', 'Suport Lumanare Craciun casuta bookstore', 'Îmbrățișați magia sărbătorilor cu suportul nostru de lumânare în formă de casă de cărți, un element distinctiv ce aduce farmecul Crăciunului în orice colț al casei dumneavoastră. Această casetă artistică, decorată cu detalii de carte și ornamente festive, reprezintă o reinterpretare captivantă a atmosferei călduroase a sărbătorilor.', 'Îmbrățișați magia sărbătorilor cu suportul nostru de lumânare în formă de casă de cărți, un element distinctiv ce aduce farmecul Crăciunului în orice colț al casei dumneavoastră. Această casetă artistică, decorată cu detalii de carte și ornamente festive, reprezintă o reinterpretare captivantă a atmosferei călduroase a sărbătorilor.\r\nÎnălțime: 14 cm\r\nLățime: 10 cm', 30, '1701518484.png', 35, 1, 1, 'Suport Lumanare Craciun casuta bookstore', 'craciun,mos,cadou,suport,lumanare,casuta,casa', 'Îmbrățișați magia sărbătorilor cu suportul nostru de lumânare în formă de casă de cărți, un element distinctiv ce aduce farmecul Crăciunului în orice colț al casei dumneavoastră. Această casetă artistică, decorată cu detalii de carte și ornamente festive, reprezintă o reinterpretare captivantă a atmosferei călduroase a sărbătorilor.', '2023-12-02 12:01:24', 0),
(16, 8, 'Suport lumanare', 'Suport Lumanare casuta de la tara ', 'Suportul nostru de lumânare, sub formă de casă de la țară, este un tribut adus frumuseții simplificării și naturaleții. Realizată cu atenție la detalii și conturată de linii curate, această casă aduce un aer plin de autenticitate, completând atmosfera relaxată și confortabilă a unei case de la țară.', 'Suportul nostru de lumânare, sub formă de casă de la țară, este un tribut adus frumuseții simplificării și naturaleții. Realizată cu atenție la detalii și conturată de linii curate, această casă aduce un aer plin de autenticitate, completând atmosfera relaxată și confortabilă a unei case de la țară.\r\nÎnălțime: 14 cm\r\nLățime : 15 cm', 24, '1701518582.png', 16, 1, 1, 'Suport Lumanare casuta de la tara ', 'Suport Lumanare casuta de la tara decor, casa lumanare,suport, casa', 'Suportul nostru de lumânare, sub formă de casă de la țară, este un tribut adus frumuseții simplificării și naturaleții. Realizată cu atenție la detalii și conturată de linii curate, această casă aduce un aer plin de autenticitate, completând atmosfera relaxată și confortabilă a unei case de la țară.', '2023-12-02 12:03:02', 1),
(18, 6, 'Farfurie vintage', 'farfurie vintage 1', ' O farfurie vintage albastru cu detalii albe încântătoare și desene distincte este o piesă de ceramică rafinată, cu o aură clasică și farmec nostalgic. Fondul albastru închis, decorat cu modele subtile sau intricate în alb, adaugă eleganță și un aspect distinct fiecărei farfurii. Această combinație de culori poate evoca o atmosferă fermecătoare și poate oferi o notă de rafinament unei mese sau chiar unei colecții de obiecte vintage.', ' O farfurie vintage albastru cu detalii albe încântătoare și desene distincte este o piesă de ceramică rafinată, cu o aură clasică și farmec nostalgic. Fondul albastru închis, decorat cu modele subtile sau intricate în alb, adaugă eleganță și un aspect distinct fiecărei farfurii. Această combinație de culori poate evoca o atmosferă fermecătoare și poate oferi o notă de rafinament unei mese sau chiar unei colecții de obiecte vintage.\r\nDiametru: 20 cm', 35, '1701542994.png', 9, 1, 0, 'Farfurie vintage', 'farfurie,vintage,platou,pictura, verde,alb,farfurii,', ' O farfurie vintage albastru cu detalii albe încântătoare și desene distincte este o piesă de ceramică rafinată, cu o aură clasică și farmec nostalgic. Fondul albastru închis, decorat cu modele subtile sau intricate în alb, adaugă eleganță și un aspect distinct fiecărei farfurii. Această combinație de culori poate evoca o atmosferă fermecătoare și poate oferi o notă de rafinament unei mese sau chiar unei colecții de obiecte vintage.', '2023-12-02 18:49:54', 0),
(19, 6, 'Farfurie', 'farfurie90', 'Farfurie foarte veche din portelan Maling Newcastle-on-Tyne anii 1920, bogat ornamentata absolut superba cu incandescenta.\r\nDiametrul 28,5 cm.', 'Farfurie foarte veche din portelan Maling Newcastle-on-Tyne anii 1920, bogat ornamentata absolut superba cu incandescenta.\r\nDiametrul 28,5 cm.', 60, '1702538903.png', 25, 1, 1, 'farfurie90', 'farfurie,platou,pictura,farfurie cu pictura, portelan englezesc, farfurii, pictura, pictata, farfurie pictata,platouri', 'Farfurie foarte veche din portelan Maling Newcastle-on-Tyne anii 1920, bogat ornamentata absolut superba cu incandescenta.\r\nDiametrul 28,5 cm.', '2023-12-14 07:28:23', 0),
(20, 6, 'Platou Brad', 'platou-brad', 'Platoul în formă de brad aduce o notă festivă cu designul său alb imaculat, conturat de o margine verde vibrantă, dispunând de trei compartimente generoase perfecte pentru a organiza și prezenta cu eleganță gustările festive sau aperitivele preferate într-un mod atrăgător și organizat.', 'Platoul în formă de brad aduce o notă festivă cu designul său alb imaculat, conturat de o margine verde vibrantă, dispunând de trei compartimente generoase perfecte pentru a organiza și prezenta cu eleganță gustările festive sau aperitivele preferate într-un mod atrăgător și organizat.\r\nLungime: 27 cm', 30, '1702540363.png', 45, 1, 0, 'Platou brad', 'brad,platou,farfurie,compartiment,compartimente,farfurii,platouri, 3 compartimente,craciun,cadou,decoratiune,pom craciun,sarbatoare,sarbatori,platou de sarbatori,farfurie de sarbatori, Craciun', 'Platoul în formă de brad aduce o notă festivă cu designul său alb imaculat, conturat de o margine verde vibrantă, dispunând de trei compartimente generoase perfecte pentru a organiza și prezenta cu eleganță gustările festive sau aperitivele preferate într-un mod atrăgător și organizat.', '2023-12-14 07:52:43', 0),
(21, 6, 'Bol festiv', 'bol-urs-festiv', 'Bolul de Crăciun este o bucurie vizuală, decorat cu motive festive și adorabilul ursuleț în centrul său, aducând atmosfera magică a sărbătorilor în fiecare moment. Este o combinație perfectă între utilitate și farmec, pregătit să găzduiască deliciile sezonului într-un stil plin de căldură și veselie.', 'Bolul de Crăciun este o bucurie vizuală, decorat cu motive festive și adorabilul ursuleț în centrul său, aducând atmosfera magică a sărbătorilor în fiecare moment. Este o combinație perfectă între utilitate și farmec, pregătit să găzduiască deliciile sezonului într-un stil plin de căldură și veselie.\r\nLatime: 23 cm', 25, '1702540778.png', 49, 1, 0, 'bol ursu festiv', 'bol,craciun,cadou,platou,bol adanc, urs,ursulet,copii,copil,copiii,copilasi, surpriza,magic,magie', 'Bolul de Crăciun este o bucurie vizuală, decorat cu motive festive și adorabilul ursuleț în centrul său, aducând atmosfera magică a sărbătorilor în fiecare moment. Este o combinație perfectă între utilitate și farmec, pregătit să găzduiască deliciile sezonului într-un stil plin de căldură și veselie.\r\nLatime: 23 cm', '2023-12-14 07:59:38', 0),
(22, 6, 'Farfurie Crăciun', 'farfurie-mos-craciun', 'Farfuria cu Moș Crăciun, purtând un sac plin de daruri în spate, aduce un farmec aparte, ilustrând scena magică în care Moșul colindă străzile, aducând bucurie și zâmbete copiilor în așteptarea Crăciunului. Un design captivant ce îmbină tradiția festivă cu povestea generozității, creând o atmosferă magică la fiecare masă.', 'Farfuria cu Moș Crăciun, purtând un sac plin de daruri în spate, aduce un farmec aparte, ilustrând scena magică în care Moșul colindă străzile, aducând bucurie și zâmbete copiilor în așteptarea Crăciunului. Un design captivant ce îmbină tradiția festivă cu povestea generozității, creând o atmosferă magică la fiecare masă.\r\nDiametru: 29 cm', 20, '1702540977.png', 80, 1, 0, 'farfurie mos craciun', 'craciun,mos, farfurie,cadou,copil,copii,platou,farfurii,festiv,magic,magie,desen,inger,', 'Farfuria cu Moș Crăciun, purtând un sac plin de daruri în spate, aduce un farmec aparte, ilustrând scena magică în care Moșul colindă străzile, aducând bucurie și zâmbete copiilor în așteptarea Crăciunului. Un design captivant ce îmbină tradiția festivă cu povestea generozității, creând o atmosferă magică la fiecare masă.', '2023-12-14 08:02:57', 0),
(23, 6, 'Farfurie pisicute', 'farfurie-pisicute-jucause', 'Farfuria albă din porțelan englezesc aduce un farmec aparte în orice masă, ilustrând jocul jucaș al pisicuțelor cu ghemul de ață roșie într-un mod adorabil și captivant. Este o combinație perfectă între eleganță și simplitate, aducând un zâmbet și o notă ludică în fiecare moment.', 'Farfuria albă din porțelan englezesc aduce un farmec aparte în orice masă, ilustrând jocul jucaș al pisicuțelor cu ghemul de ață roșie într-un mod adorabil și captivant. Este o combinație perfectă între eleganță și simplitate, aducând un zâmbet și o notă ludică în fiecare moment.\r\nDiametru: 30 cm', 24, '1702541352.png', 42, 1, 0, 'Farfurie pisicute jucause', 'pisica,pisici,pisicuta, cat,farfurie,platou,copii,cadou,magie,copil,copilas,copilasi,', 'Farfuria albă din porțelan englezesc aduce un farmec aparte în orice masă, ilustrând jocul jucaș al pisicuțelor cu ghemul de ață roșie într-un mod adorabil și captivant. Este o combinație perfectă între eleganță și simplitate, aducând un zâmbet și o notă ludică în fiecare moment.', '2023-12-14 08:09:12', 0),
(24, 8, 'Îngeraș', 'decoratiune-inger-alb', 'Decoratiunea cu un îngeraș alb emană o aură de delicatețe și pace, având o prezență subtilă, însuflețită de aripile sale gingașe și de expresia blândă a feței. Este o simbolizare a purității și a bucuriei, aducând o atmosferă caldă și reconfortantă în încăpere.', 'Decoratiunea cu un îngeraș alb emană o aură de delicatețe și pace, având o prezență subtilă, însuflețită de aripile sale gingașe și de expresia blândă a feței. Este o simbolizare a purității și a bucuriei, aducând o atmosferă caldă și reconfortantă în încăpere.\r\nÎnăltime: 10 cm', 15, '1702541718.png', 16, 1, 0, 'decoratiune ingeras', 'infger,decoratiune,magic,magie, pace, craciun,cadou', 'Decoratiunea cu un îngeraș alb emană o aură de delicatețe și pace, având o prezență subtilă, însuflețită de aripile sale gingașe și de expresia blândă a feței. Este o simbolizare a purității și a bucuriei, aducând o atmosferă caldă și reconfortantă în încăpere.', '2023-12-14 08:15:18', 0),
(25, 0, 'Farfurie Crăciun', 'farfurie-brad-craciun-mos-craciun', 'Pe farfuria fermecătoare se desfășoară o scenă festivă - un brad impunător înconjurat de cadouri strălucitoare și de Moș Crăciun, iar un copil bucuros contemplă această scenă magică. Este o îmbinare perfectă între elementele tradiționale de Crăciun, capturând bucuria și entuziasmul acestei sărbători într-o imagine plină de farmec.', 'Pe farfuria fermecătoare se desfășoară o scenă festivă - un brad impunător înconjurat de cadouri strălucitoare și de Moș Crăciun, iar un copil bucuros contemplă această scenă magică. Este o îmbinare perfectă între elementele tradiționale de Crăciun, capturând bucuria și entuziasmul acestei sărbători într-o imagine plină de farmec.\r\nDiametru: 27 cm', 26, '1702541963.png', 20, 1, 0, 'farfurie-brad-craciun-mos-craciun', 'copiii,craciun,cadou,mos,magic,magie,farfurie,platou,farfurii', 'Pe farfuria fermecătoare se desfășoară o scenă festivă - un brad impunător înconjurat de cadouri strălucitoare și de Moș Crăciun, iar un copil bucuros contemplă această scenă magică. Este o îmbinare perfectă între elementele tradiționale de Crăciun, capturând bucuria și entuziasmul acestei sărbători într-o imagine plină de farmec.', '2023-12-14 08:19:23', 0),
(26, 7, 'Cana jucarii', 'cana-jucarii-craciun', 'Cana încântătoare este decorată cu jucării de Crăciun, aducând spiritul festiv chiar în timpul unei pauze pentru cafea sau ceai. Înconjurată de globuri strălucitoare, clopoței jucauși și alte ornamente, cana aduce o notă plină de bucurie și emoție în fiecare înghițitură.', 'Cana încântătoare este decorată cu jucării de Crăciun, aducând spiritul festiv chiar în timpul unei pauze pentru cafea sau ceai. Înconjurată de globuri strălucitoare, clopoței jucauși și alte ornamente, cana aduce o notă plină de bucurie și emoție în fiecare înghițitură.\r\nÎnălțime: 12 cm', 16, '1702542112.png', 1, 1, 0, 'cana-jucarii-craciun', 'copil,copiii,craciun,jucarii,jucarie,cadou,cana,ceai,cafea,cani,magie,magic,', 'Cana încântătoare este decorată cu jucării de Crăciun, aducând spiritul festiv chiar în timpul unei pauze pentru cafea sau ceai. Înconjurată de globuri strălucitoare, clopoței jucauși și alte ornamente, cana aduce o notă plină de bucurie și emoție în fiecare înghițitură.', '2023-12-14 08:21:52', 0),
(27, 7, 'Halbă porțelan', 'halba-portelan1', 'Halba din portelan englezesc albastru și alb este o capodoperă de artă cu o pictură ce redă în detaliu o moară de vânt olandeză, capturând frumusețea și farmecul peisajului rural într-un mod elegant și rafinat. Este o combinație între tradiția portelanului de calitate și frumusețea unei scene pitorești, aducând atmosfera de poveste în fiecare înghițitură savurată.', 'Halba din portelan englezesc albastru și alb este o capodoperă de artă cu o pictură ce redă în detaliu o moară de vânt olandeză, capturând frumusețea și farmecul peisajului rural într-un mod elegant și rafinat. Este o combinație între tradiția portelanului de calitate și frumusețea unei scene pitorești, aducând atmosfera de poveste în fiecare înghițitură savurată.\r\nInaltime: 24 cm', 35, '1702542267.png', 3, 1, 0, 'halba-albastra', 'halba,bere,portelan,', 'Halba din portelan englezesc albastru și alb este o capodoperă de artă cu o pictură ce redă în detaliu o moară de vânt olandeză, capturând frumusețea și farmecul peisajului rural într-un mod elegant și rafinat. Este o combinație între tradiția portelanului de calitate și frumusețea unei scene pitorești, aducând atmosfera de poveste în fiecare înghițitură savurată.``', '2023-12-14 08:24:27', 0),
(28, 6, 'Set bol portelan', 'bol-portelan1', 'Bolul de portelan alb, elegant și funcțional pentru supă, vine cu manere subtile și o margine în nuanțe calde de maro, aducând un accent rafinat și practicitate în timpul servirii. Farfuria asortată completează perfect setul, păstrând aceeași estetică și oferind o prezentare armonioasă a delicioaselor tale preparate.', 'Bolul de portelan alb, elegant și funcțional pentru supă, vine cu manere subtile și o margine în nuanțe calde de maro, aducând un accent rafinat și practicitate în timpul servirii. Farfuria asortată completează perfect setul, păstrând aceeași estetică și oferind o prezentare armonioasă a delicioaselor tale preparate.\r\nDiametru bol: 14 cm\r\nDiametru farfurie: 20 cm', 43, '1702542395.png', 16, 1, 0, 'bol-farfurie', 'bol,farfurie,supa,ciorba,boluri,set,', 'Bolul de portelan alb, elegant și funcțional pentru supă, vine cu manere subtile și o margine în nuanțe calde de maro, aducând un accent rafinat și practicitate în timpul servirii. Farfuria asortată completează perfect setul, păstrând aceeași estetică și oferind o prezentare armonioasă a delicioaselor tale preparate.', '2023-12-14 08:26:35', 0),
(29, 8, 'Suport lumanare', 'suport-lumanare-inger', 'Suportul de lumânare în formă de îngeraș emană o delicatețe aparte, sculptat cu atenție la detalii pentru a crea o prezență plină de grație și seninătate în decor. Este o piesă fermecătoare ce aduce o notă angelică și liniștitoare în orice încăpere.', 'Suportul de lumânare în formă de îngeraș emană o delicatețe aparte, sculptat cu atenție la detalii pentru a crea o prezență plină de grație și seninătate în decor. Este o piesă fermecătoare ce aduce o notă angelică și liniștitoare în orice încăpere.\r\nÎnălțime: 10 cm', 10, '1702544558.png', 9, 1, 0, 'suport lumanare inger', 'lumanare,suport,ingeras,inger,cadou,lumanari,', 'Suportul de lumânare în formă de îngeraș emană o delicatețe aparte, sculptat cu atenție la detalii pentru a crea o prezență plină de grație și seninătate în decor. Este o piesă fermecătoare ce aduce o notă angelică și liniștitoare în orice încăpere.', '2023-12-14 09:02:38', 0),
(30, 0, 'Ananas auriu', 'ananas-auriu', 'Întruchipează un farmec rustic și o eleganță atemporală cu acest ananas miniatural realizat din metal. Cu o muncă meticuloasă și o atenție deosebită pentru detaliu, acest decor îmbină aspectul robust al metalului cu contururi și texturi fine, aducând un element de farmec și caracter în decorul tău. Plasat pe rafturi, pe birou sau ca parte a unui ansamblu decorativ, acest ananas aduce o notă de prospețime și originalitate în orice spațiu.', 'Întruchipează un farmec rustic și o eleganță atemporală cu acest ananas miniatural realizat din metal. Cu o muncă meticuloasă și o atenție deosebită pentru detaliu, acest decor îmbină aspectul robust al metalului cu contururi și texturi fine, aducând un element de farmec și caracter în decorul tău. Plasat pe rafturi, pe birou sau ca parte a unui ansamblu decorativ, acest ananas aduce o notă de prospețime și originalitate în orice spațiu.\r\nÎnălțime: 5 cm', 30, '1702820252.png', 36, 1, 0, 'ananas auriu', 'ananas,auriu,aurie,aur,decor,decoratiuni,', 'Întruchipează un farmec rustic și o eleganță atemporală cu acest ananas miniatural realizat din metal. Cu o muncă meticuloasă și o atenție deosebită pentru detaliu, acest decor îmbină aspectul robust al metalului cu contururi și texturi fine, aducând un element de farmec și caracter în decorul tău. Plasat pe rafturi, pe birou sau ca parte a unui ansamblu decorativ, acest ananas aduce o notă de prospețime și originalitate în orice spațiu.', '2023-12-17 13:37:32', 0),
(31, 7, 'Latieră', 'ulcior-rosu', 'Latieră albă cu accente roșii este o piesă simplă, dar fermecătoare pentru bucătăria ta. Cu o formă clasică și detalii roșii subtile, acest ulcior adaugă o notă de farmec rustic. Ideal pentru a păstra sosuri sau lichide esențiale, acesta aduce un strop de culoare și caracter pe rafturi. Mânerul său comod și designul compact îl fac o alegere practică și estetică pentru servirea băuturilor sau pentru adăugarea unei nuanțe colorate în decor.', 'Latieră albă cu accente roșii este o piesă simplă, dar fermecătoare pentru bucătăria ta. Cu o formă clasică și detalii roșii subtile, acest ulcior adaugă o notă de farmec rustic. Ideal pentru a păstra sosuri sau lichide esențiale, acesta aduce un strop de culoare și caracter pe rafturi. Mânerul său comod și designul compact îl fac o alegere practică și estetică pentru servirea băuturilor sau pentru adăugarea unei nuanțe colorate în decor.\r\nÎnălțime: 14 cm\r\n', 27, '1702821004.png', 34, 1, 0, 'ulcior rosu', 'ulcior,rosu,apa,lapte,latiera,cafea,decor,rosu,alb', 'ulcior rosu alb ', '2023-12-17 13:50:04', 0),
(32, 7, 'Cana plante', 'cana-plante-abstracte', '\"Descoperă frumusețea pură a naturii reinterpretată într-un mod abstract cu această cană decorativă cu plante abstracte. Designul său unic combină liniile și forme geometrice pentru a crea un tablou vizual impresionant de culori și texturi. Fiecare detaliu al acestei cani este o exprimare artistică, aducând o notă de eleganță și mister în orice spațiu. O piesă captivantă, perfectă pentru a-ți îmbogăți colțurile casei sau pentru a completa colecția ta de obiecte decorative.\"\r\nÎnălțime: 14 cm\r\nLățime : 7 cm', 'Descoperă frumusețea pură a naturii reinterpretată într-un mod abstract cu această cană decorativă cu plante abstracte. Designul său unic combină liniile și forme geometrice pentru a crea un tablou vizual impresionant de culori și texturi. Fiecare detaliu al acestei cani este o exprimare artistică, aducând o notă de eleganță și mister în orice spațiu. O piesă captivantă, perfectă pentru a-ți îmbogăți colțurile casei sau pentru a completa colecția ta de obiecte decorative.\r\nÎnălțime: 14 cm\r\nLățime : 7 cm', 12, '1702822246.png', 30, 1, 1, 'cana abstracta plante', 'cana,plante,ceai,cafea, abstract,cani', '\"Descoperă frumusețea pură a naturii reinterpretată într-un mod abstract cu această cană decorativă cu plante abstracte. Designul său unic combină liniile și forme geometrice pentru a crea un tablou vizual impresionant de culori și texturi. Fiecare detaliu al acestei cani este o exprimare artistică, aducând o notă de eleganță și mister în orice spațiu. O piesă captivantă, perfectă pentru a-ți îmbogăți colțurile casei sau pentru a completa colecția ta de obiecte decorative.\"\r\nÎnălțime: 14 cm\r\nLățime : 7 cm', '2023-12-17 14:10:46', 0),
(33, 8, 'Ghiveci alb-rosu', 'Ghiveci alb-rosu', 'Descoperă eleganța subtilă a acestui ghiveci alb-rosu, o piesă deosebită care aduce un strop de rafinament în decorul tău interior. Tonurile sale contrastante, de alb pur și roșu vibrant, creează un echilibru vizual plăcut, evidențiind frumusețea plantelor îngrijite înăuntru. Cu o formă clasică și linii fluide, acest ghiveci devine un element de focalizare, adăugând o notă de prospețime și eleganță atât în spațiile contemporane, cât și în cele mai tradiționale.', 'Descoperă eleganța subtilă a acestui ghiveci alb-rosu, o piesă deosebită care aduce un strop de rafinament în decorul tău interior. Tonurile sale contrastante, de alb pur și roșu vibrant, creează un echilibru vizual plăcut, evidențiind frumusețea plantelor îngrijite înăuntru. Cu o formă clasică și linii fluide, acest ghiveci devine un element de focalizare, adăugând o notă de prospețime și eleganță atât în spațiile contemporane, cât și în cele mai tradiționale.\r\nÎnălțime: 20 cm\r\nLățime : 15 cm', 25, '1702822417.png', 35, 1, 0, 'ghiveci alb rosu', 'ghiveci,floare,planta,plante,ghivece, decoratiune,decor,exterior,flori', 'ghiveci alb rosu', '2023-12-17 14:13:37', 0),
(34, 7, 'Cana Starbucks', 'cana-starbucks', 'Cana albă de cafea sau ceai de la Starbucks este emblematică pentru simplitatea și eleganța sa. Cu un design curat și minimalist, cana oferă un fundal perfect pentru logo-ul iconic al Starbucks, permițându-i să strălucească și să devină punctul focal al atenției. Simplitatea albă permite brandului să-și etaleze logo-ul verde și alb, facilitând recunoașterea imediată a mărcii.', 'Cana albă de cafea sau ceai de la Starbucks este emblematică pentru simplitatea și eleganța sa. Cu un design curat și minimalist, cana oferă un fundal perfect pentru logo-ul iconic al Starbucks, permițându-i să strălucească și să devină punctul focal al atenției. Simplitatea albă permite brandului să-și etaleze logo-ul verde și alb, facilitând recunoașterea imediată a mărcii.', 17, '1702899034.png', 30, 1, 0, 'cana stabucks', 'cana,cafea,ceai,cadou,starbucks,', 'Cana albă de cafea sau ceai de la Starbucks este emblematică pentru simplitatea și eleganța sa. Cu un design curat și minimalist, cana oferă un fundal perfect pentru logo-ul iconic al Starbucks, permițându-i să strălucească și să devină punctul focal al atenției. Simplitatea albă permite brandului să-și etaleze logo-ul verde și alb, facilitând recunoașterea imediată a mărcii.', '2023-12-18 11:30:34', 0),
(35, 8, 'Vaza albastra', 'vaza-albastra1', 'Oferind o combinație vibrantă între eleganță și modernitate, această vază captivantă îmbină perfect estetica clasică a unei forme tradiționale de vază cu un model contemporan și culori îndrăznețe. Cu o înălțime de 40 de centimetri, devine punctul central al oricărui decor interior, adăugând o notă rafinată și proaspătă în spațiul dvs.', 'Oferind o combinație vibrantă între eleganță și modernitate, această vază captivantă îmbină perfect estetica clasică a unei forme tradiționale de vază cu un model contemporan și culori îndrăznețe. Cu o înălțime de 40 de centimetri, devine punctul central al oricărui decor interior, adăugând o notă rafinată și proaspătă în spațiul dvs.\r\nÎnălțimeȘ 40 cm', 35, '1702899299.png', 10, 1, 0, 'vaza albastra', 'vaza,albastru,albastra,decor,flori,plante,veze', 'Oferind o combinație vibrantă între eleganță și modernitate, această vază captivantă îmbină perfect estetica clasică a unei forme tradiționale de vază cu un model contemporan și culori îndrăznețe. Cu o înălțime de 40 de centimetri, devine punctul central al oricărui decor interior, adăugând o notă rafinată și proaspătă în spațiul dvs.', '2023-12-18 11:34:59', 0),
(36, 8, 'Decoratiune pom', 'vrabie aurie', ' O decoratiune de brad de Crăciun aurie în forma de vrăbiuță cu caiuță emană o eleganță distinctă. Culoarea aurie strălucitoare adaugă un farmec luxuriant și o notă festivă în orice decor festiv de Crăciun. Această nuanță vibrantă aduce o aură de sofisticare și rafinament în împrejurimile bradului, aducând un contrast plăcut și un accent plin de strălucire în întreaga atmosferă festivă.', ' O decoratiune de brad de Crăciun aurie în forma de vrăbiuță cu caiuță emană o eleganță distinctă. Culoarea aurie strălucitoare adaugă un farmec luxuriant și o notă festivă în orice decor festiv de Crăciun. Această nuanță vibrantă aduce o aură de sofisticare și rafinament în împrejurimile bradului, aducând un contrast plăcut și un accent plin de strălucire în întreaga atmosferă festivă.\r\nÎnălțime: 4 cm', 10, '1702899433.png', 24, 1, 1, 'vrabie aurie', 'vrabie,vrabiuta,cadou,craciun,cadouri,pom, decoratiune,decor', ' O decoratiune de brad de Crăciun aurie în forma de vrăbiuță cu caiuță emană o eleganță distinctă. Culoarea aurie strălucitoare adaugă un farmec luxuriant și o notă festivă în orice decor festiv de Crăciun. Această nuanță vibrantă aduce o aură de sofisticare și rafinament în împrejurimile bradului, aducând un contrast plăcut și un accent plin de strălucire în întreaga atmosferă festivă.', '2023-12-18 11:37:13', 0),
(37, 8, 'Vaza neagra', 'vaza neagra', 'Datorită bazei grase, vaza oferă stabilitate și siguranță pentru orice aranjament floral. Forma sa specifică, cu o gură îngustă, permite aranjamentelor să fie prezentate și expuse în mod distinct, permițând o focalizare eficientă asupra detaliilor acestora și oferind un impact vizual puternic în spațiul în care este amplasată.', 'Datorită bazei grase, vaza oferă stabilitate și siguranță pentru orice aranjament floral. Forma sa specifică, cu o gură îngustă, permite aranjamentelor să fie prezentate și expuse în mod distinct, permițând o focalizare eficientă asupra detaliilor acestora și oferind un impact vizual puternic în spațiul în care este amplasată.\r\nÎnălțime: 43 cm\r\nLălțime: 30 cm', 35, '1702899564.png', 32, 1, 0, 'vaza neagra', 'vaza,negru,neagra,flori,floral,suport,decor,decoratiune', 'vaza neagra', '2023-12-18 11:39:24', 0),
(38, 7, 'Cana craciun', 'cana-craciun12', 'Cana cu imaginea lui Moș Crăciun pe sanie, dăruind un cadou copilului, este mai mult decât un obiect de uz zilnic - este o fereastră către lumea magică a sărbătorilor. Această imagine aduce în prim-plan emoții precum bucuria, anticiparea și generozitatea. Fiecare sorbitură din această cană devine o experiență plină de încântare și speranță, oferind o pauză plină de magie chiar și în cele mai obișnuite momente ale zilei.', 'Cana cu imaginea lui Moș Crăciun pe sanie, dăruind un cadou copilului, este mai mult decât un obiect de uz zilnic - este o fereastră către lumea magică a sărbătorilor. Această imagine aduce în prim-plan emoții precum bucuria, anticiparea și generozitatea. Fiecare sorbitură din această cană devine o experiență plină de încântare și speranță, oferind o pauză plină de magie chiar și în cele mai obișnuite momente ale zilei.', 28, '1702899777.png', 30, 1, 1, 'canca mos craciun ', 'cana,craciun,mos,cadouri,cadou,ceai,cafea', 'Cana cu imaginea lui Moș Crăciun pe sanie, dăruind un cadou copilului, este mai mult decât un obiect de uz zilnic - este o fereastră către lumea magică a sărbătorilor. Această imagine aduce în prim-plan emoții precum bucuria, anticiparea și generozitatea. Fiecare sorbitură din această cană devine o experiență plină de încântare și speranță, oferind o pauză plină de magie chiar și în cele mai obișnuite momente ale zilei.', '2023-12-18 11:42:57', 1),
(39, 8, 'Decoratiune pom', 'glob-mos-craciun', 'Imaginea lui Moș Crăciun cu sacul în spate este adesea asociată cu generozitatea și bucuria sărbătorilor de iarnă. Un glob în această formă poate inspira aceste sentimente, reprezentând spiritul dăruirii și al momentelor pline de fericire și entuziasm care însoțesc sărbătorile de Crăciun.', 'Imaginea lui Moș Crăciun cu sacul în spate este adesea asociată cu generozitatea și bucuria sărbătorilor de iarnă. Un glob în această formă poate inspira aceste sentimente, reprezentând spiritul dăruirii și al momentelor pline de fericire și entuziasm care însoțesc sărbătorile de Crăciun.', 20, '1702899913.png', 40, 1, 1, 'mos craciun glob', 'mos,craiun glob iarna pom decoratiune decor', 'Imaginea lui Moș Crăciun cu sacul în spate este adesea asociată cu generozitatea și bucuria sărbătorilor de iarnă. Un glob în această formă poate inspira aceste sentimente, reprezentând spiritul dăruirii și al momentelor pline de fericire și entuziasm care însoțesc sărbătorile de Crăciun.', '2023-12-18 11:45:13', 0),
(40, 7, 'Set cana si farfurie', 'cana cafea gasca', 'Setul de farfurii și cană de cafea cu o gâscă mică desenată pe ele aduc un aer delicat și jucaus în orice încăpere. Prezența gâștei și a șorțulețului său colorat adaugă un element de veselie și caldețe în design, creând o atmosferă prietenoasă și plină de farmec în timp ce servești sau savurezi o băutură.', 'Setul de farfurii și cană de cafea cu o gâscă mică desenată pe ele aduc un aer delicat și jucaus în orice încăpere. Prezența gâștei și a șorțulețului său colorat adaugă un element de veselie și caldețe în design, creând o atmosferă prietenoasă și plină de farmec în timp ce servești sau savurezi o băutură.', 30, '1702900177.png', 120, 1, 1, 'cana cafea gasca', 'cafea, gasca ,cana ,set,farfurie,farfurioara,ceasca,', 'Setul de farfurii și cană de cafea cu o gâscă mică desenată pe ele aduc un aer delicat și jucaus în orice încăpere. Prezența gâștei și a șorțulețului său colorat adaugă un element de veselie și caldețe în design, creând o atmosferă prietenoasă și plină de farmec în timp ce servești sau savurezi o băutură.', '2023-12-18 11:49:37', 0),
(41, 6, 'Farfurie turcoaz', 'farfurie.model.abstract,turcoaz', 'Farfuria este o explozie de culori și modele, folosind turcoaz, alb și verde pentru a crea un design abstract plin de viață. Această combinație îndrăzneață și jucăușă de culori se împletește într-un model neconvențional, oferind un aspect distinct și captivant.', 'Farfuria este o explozie de culori și modele, folosind turcoaz, alb și verde pentru a crea un design abstract plin de viață. Această combinație îndrăzneață și jucăușă de culori se împletește într-un model neconvențional, oferind un aspect distinct și captivant.\r\nDiametru: 20 cm', 25, '1702902360.png', 27, 1, 0, 'farfruie turcoaz', 'farfurie farfurii turcoaz platou, macare ', 'farfurie farfurii turcoaz platou, macare ', '2023-12-18 12:26:00', 0),
(42, 6, 'Farfrurie flori albastre', 'farfurieflori albastre', 'Farfuria bogată în culori prezintă flori albastre vibrante care adaugă un accent vibrant și plin de viață. Aceste flori creează o atmosferă încântătoare și plină de energie, captând atenția și oferind un aspect distinct și atrăgător farfuriei', 'Farfuria bogată în culori prezintă flori albastre vibrante care adaugă un accent vibrant și plin de viață. Aceste flori creează o atmosferă încântătoare și plină de energie, captând atenția și oferind un aspect distinct și atrăgător farfuriei.\r\nDiametru: 24 cm', 15, '1702902482.png', 30, 1, 0, 'farfurie albastra', 'farfurie farfurii platou mancare supa portelan ', 'Farfuria bogată în culori prezintă flori albastre vibrante care adaugă un accent vibrant și plin de viață. Aceste flori creează o atmosferă încântătoare și plină de energie, captând atenția și oferind un aspect distinct și atrăgător farfuriei', '2023-12-18 12:28:02', 0),
(43, 6, 'Farfurie peisaj', 'farfuriepeisajcopaci', 'Farfuria albă cu un desen minimalist, constând într-un peisaj cu doi copaci în nuanțe de maro, emană o eleganță simplă. Contrastul dintre fondul alb și detaliile discrete ale peisajului adaugă un farmec subtil și rafinament, oferind o senzație de echilibru și liniște.', 'Farfuria albă cu un desen minimalist, constând într-un peisaj cu doi copaci în nuanțe de maro, emană o eleganță simplă. Contrastul dintre fondul alb și detaliile discrete ale peisajului adaugă un farmec subtil și rafinament, oferind o senzație de echilibru și liniște.\r\nDiametru: 27 cm', 24, '1702902603.png', 70, 1, 0, 'farfuriepeisajmaro', 'farfurie peisaj farfurii ', 'Farfuria albă cu un desen minimalist, constând într-un peisaj cu doi copaci în nuanțe de maro, emană o eleganță simplă. Contrastul dintre fondul alb și detaliile discrete ale peisajului adaugă un farmec subtil și rafinament, oferind o senzație de echilibru și liniște.', '2023-12-18 12:30:03', 0),
(44, 7, 'Set ceasca si farfurie', 'set.canafarfurie.verde', ' Setul de cești și farfurioare este încântător și captivant, evidențiind un desen în nuanțe de verde care reprezintă un castel înconjurat de natură. Imaginea unui castel în mijlocul peisajului natural transmite o senzație de eleganță și conexiune cu frumusețea naturală a lumii.', ' Setul de cești și farfurioare este încântător și captivant, evidențiind un desen în nuanțe de verde care reprezintă un castel înconjurat de natură. Imaginea unui castel în mijlocul peisajului natural transmite o senzație de eleganță și conexiune cu frumusețea naturală a lumii.', 30, '1702902780.png', 30, 1, 0, 'set ceasca farfurie verde', 'ceasca cana cafea ceai cesi set farfurioara ', ' Setul de cești și farfurioare este încântător și captivant, evidențiind un desen în nuanțe de verde care reprezintă un castel înconjurat de natură. Imaginea unui castel în mijlocul peisajului natural transmite o senzație de eleganță și conexiune cu frumusețea naturală a lumii.', '2023-12-18 12:33:00', 0),
(45, 8, 'Vaza rosie', 'vaza-rosie-model-negru', 'Vaza roșie oferă un fundal vibrant și distinctiv pentru floarea neagră abstractă. Contrastul dintre culoarea puternică a vazei și tonurile închise, enigmatice ale florii creează un impact vizual profund și o senzație de mister. Această combinație de nuanțe vibrante și culori intense oferă o estetică abstractă, captivantă și plină de dramatism, atrăgând privirea și provocând contemplare.', 'Vaza roșie oferă un fundal vibrant și distinctiv pentru floarea neagră abstractă. Contrastul dintre culoarea puternică a vazei și tonurile închise, enigmatice ale florii creează un impact vizual profund și o senzație de mister. Această combinație de nuanțe vibrante și culori intense oferă o estetică abstractă, captivantă și plină de dramatism, atrăgând privirea și provocând contemplare.\r\nÎnălțime: 28 cm\r\nLălțime:  15 cm', 45, '1702903039.png', 6, 1, 0, 'vaza rosie ', 'ceramic vaza rosu rosie floare flori decor ', 'Înălțime: 43 cm\r\nLălțime:', '2023-12-18 12:37:19', 0);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `retete`
--

CREATE TABLE `retete` (
  `id` int(11) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `nume` mediumtext NOT NULL,
  `descriere` mediumtext NOT NULL,
  `ingrediente` mediumtext NOT NULL,
  `pasi` mediumtext NOT NULL,
  `indicatii_opt` mediumtext NOT NULL,
  `id_user` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `alergeni` mediumtext NOT NULL,
  `calorii` int(11) NOT NULL,
  `nr_portii` int(11) NOT NULL,
  `ore` tinyint(4) NOT NULL,
  `minute` tinyint(4) NOT NULL,
  `users_likes` varchar(100) NOT NULL,
  `users_dislikes` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `retete`
--

INSERT INTO `retete` (`id`, `categorie`, `nume`, `descriere`, `ingrediente`, `pasi`, `indicatii_opt`, `id_user`, `img`, `status`, `alergeni`, `calorii`, `nr_portii`, `ore`, `minute`, `users_likes`, `users_dislikes`) VALUES
(8, '7', 'Piure de cartofi', 'Toată lumea a făcut sau măcar a mâncat piure de cartofi, dar, în urma unei celebre emisiuni de cooking care s-a dat la televizor, a apărut ideea că mulți dintre noi nu îl făceau corect. Acum, ce să zic? Nu aș zice nici că rețeta făcută publică atunci, cu ocazia emisiunii, era chiar cea mai ”ortodoxă”. Rețeta prevedea adăugarea untului în proporția de 1:3 – 250-300 de grame de unt la 1 kilogram de cartofi. Adică, probabil că este corectă, chiar iese un piure de cartofi dat naibii de bun procedând astfel, doar că nu este echilibrat din punct de vedere nutrițional. Să nu uităm, piureul de cartofi este o garnitură. Nu e în regulă să aibă garnitura mai multe calorii decât carnea din farfurie, oricine ar susține contrariul.', 'cartofi pentru fiert 1 kg\r\napa 1 l\r\nlapte 50 ml', 'Pentru început, cartofii se spală bine, apoi se curăță de coajă. La mine în casă, se treaba asta se ocupă soțul meu. Pe măsură ce se curăță, cartofii se păstrează într-un castron cu apă rece.\r\n Se spală bine cartofii în câteva ape reci. Se scurg și se taie în cubulețe sau felii (depinde de mărimea acestora). Se pun cartofii într-o cratiță de mărime potrivită. \r\nSe acoperă cu apă rece cam de 4 degete și se adaugă 1 linguriță cu vârf de sare. Se pune oala pe foc mediu și se fierb cartofii cam 25 de minute, cât să se frăgezească bine, dar să nu se spargă.\r\nSe scurg cartofii de apă, printr-o sită. Eu folosesc această sită care are picioare și las cartofii să aburească vreo 3-4 minute în aceasta, ca să mai piardă din abur. \r\nDacă vă uitați mai sus, în rețeta de la Larousse Gastronomique, se recomandă să fie sotați rapid, pentru a mai elimina din umiditate. Ideea e să avem cât mai puțină apă în al nostru pireu de cartofi. Se știe doar, apa nu-i bună. Nici la genunchi.\r\n Se zdrobesc cartofii fin, cât sunt fierbinți. Cel mai recomandat instrument, pentru treaba asta, este presa de cartofi. Eu o am de ani de zile și o păzesc ca pe ochii din cap.\r\nSe adaugă untul, de preferință la temperatura camerei. Se amestecă rapid cu un tel sau cu o spatulă, ca să se încorporeze untul în cartofii zdrobiți.,Treptat, se adaugă laptele fierbinte, în timp ce se amestecă energic cu telul sau cu o spatulă. \r\nSe ajustează cantitatea de lapte conform preferințelor, dacă vă place un piure mai consistent, probabil 200 ml. de lapte vor fi de ajuns, dacă vă place mai fluid, probabil veți pune 300 ml. Pentru o textură spumoasă a piureului, trebuie bătut bine cu telul. Nu cu mixerul, repet!,În final, obținem un piure sau un pireu, cum vrem să-i zicem, gustos și apetisant. Acum îl gustăm și adăugăm sare fină după gust. Pe la noi, prin influența vieneză, musai să adăugăm și-un strop de nucșoară rasă.', 'Absolut incorect este să zdrobim cartofii cu mixerul sau cu blenderul! În locul unui piure de cartofi pufos și apetisant, veți obține o masă elastică, care se va întinde ca un mucus. Nimic nu poate fi mai neapetisant! \r\nExistă o explicație științifică ce explică de ce anume se întâmplă asta. Pur și simplu, mișcarea rapidă a paletelor mixerului sau a lamelor blenderului distruge foarte fragilele molecule de amidon din cartofii fierți, ceea ce îi face să se transforme în acea masă elastică.', 0, 'pireu.png', 1, 'lapte de vaca', 50, 2, 1, 20, '0', '08,'),
(13, '7', 'Mamaliga', 'Am ales o oala incapatoare de vreo 3 L si am pus in ea apa la fiert impreuna cu sarea. Am cantarit malaiul. In principiu puteti lucra si cu cani, asa cum am spus mai sus: 4 cani de apa si o cana de malai.\r\n\r\nAm amestecat mai intai cu telul in forma de para ca sa fiu sigura ca nu se formeaza cocoloase. Cand mamaliga incepe sa clocoteasca (atentie! stropeste!) am trecut la lingura de lemn. Mamaliga trebuie amestecata incontinuu pe durata fierberii. Ea se ingroasa si pufneste ca un vulcan', 'malai 250 g\r\napa 1 l\r\nsare 3 g', 'Am fiert mamaliga cam 10-12 minute. Trebuie gustata ca sa ne dam seama daca e facut malaiul si nu ne crantane in dinti. Daca trebuie mai puneti-i si sare ca sa nu fie fada\r\nAm stins focul de sub oala si am adunat toata mamaliga de pe pereti si am presat-o cu dosul lingurii. Am acoperit oala cu un capac si am lasat mamaliga sa se abureasca 3-4 minute.\r\nApoi am pornit din nou flacara de sub oala (foc mic spre mediu) si am asteptat sa aud cum rabufneste nervoasa de sub capac. Doar 1 minut ajunge. Acesta este trucul prin care mamaliga se desprinde singura de pe peretii oalei, fiind ajutata de forta aburului care iese din ea.\r\nImediat am inlocuit capacul oalei cu un platou (sau cu scandura de lemn curata) si am rasturnat dintr-o miscare mamaliga. \r\nTa-daa!!', 'Puteti incerca sa taiati mamaliga cu ata si de sus in jos, prin simpla apasare a firului tensionat. Treaba asta iese bine daca mamaliga este rasturnata pe un plan drept – funde de lemn, nu pe farfurie sau platou adancit. Feliile se pot lua direct cu mana si pot fi muscate (in stilul taranesc), inlocuind painea.', 0, 'mamaliga.png', 1, '', 120, 1, 0, 20, '014,', '0'),
(15, '6', 'Paine', 'Am decis sa fac paine de casa dupa aceasta reteta simpla, explicata pas cu pas, pentru a va demonstra cat de usor este sa coci paine in propria gospodarie, in cuptorul casnic. Stiti deja ca noi avem multe retete de paine de casa publicate anterior si ca toate le-au reusit admirabil cititorilor care le-au testat. Avem retete testate de paine cu faina alba, cu faina integrala, paine multicereale, paine cu faina neagra, paine cu plamadeala (maia), paine neframantata.', 'faina 1 kg\r\napa 700 ml\r\ndrojdie proaspata 25 g\r\nsare 20 g', 'Faina se cerne de 2 ori inainte de folosire, in felul acesta se elimina eventualele corpuri straine, dar se si aeriseste.\r\nSe pune intr-un lighean, covata, ce aveti, se amesteca acum drojdia uscata si zaharul.\r\nDaca folositi drojdie proaspata, se pregateste maiaua separat: se pune drojdia proaspata (25 g) si se amesteca bine cu zaharul, pana se face ca o smantana.\r\nSe adauga 50 ml apa si 1 lingura de faiana, se amesteca bine si se lasa sa dospeasca 10-15 minute. Cand si-a dublat volumul, se toarna peste faina.\r\nDupa 5 minute de framantata, incepeti sa trantiti aluatul.Da, ati citit bine: trantiti aluatul. Puneti ligheanul jos si lasati aluatul sa cada in lighean. In lighean, nu pe langa, da?  Repetati de 10 ori. Acest trantit are rolul de a imprastia aerul in mod uniform in alua', 'Se aprinde cuptorul pentru 5 minute, apoi se stinge, sa fie caldut inauntru. Se baga vasul cu aluat in cuptor si se inchide usa. Veti avea un dospitor grozav. Nu uitati sa stingeti cuptorul si verificati aluatul dupa 30 de minute 🙂\r\nDaca vasul e mare cu aluat, sau aveti cuptorul ocupat cu altceva, puneti apa calda intr-un vas si asezati deasupra vasul cu aluat, dar fara sa atinga apa calda. Verificati dupa 30 de minute. Aceste metode ajuta aluatul sa creasca mult mai repede.', 0, 'paine.png', 1, '', 264, 1, 1, 20, '010,', '0'),
(16, '6', 'Humus de linte si morcovi', 'Chiar daca nu e facut din naut, acest hummus are un gust atat de specific arabesc incat numele mi s-a parut potrivit. E un hummus vibrant ca si culoare, dar si ca arome.', 'linte rosie fiarta 150 g\nmorcovi 400 g\npasta de susan (tahini) 10 ml\nusturoi 10 g\nboia dulce 3 g\nsuc lamaie 10 ml\nulei de masline 15 ml\nboia afumata 5 g\npatrunjel 15 g\ncoriandru macinat 10 g\nsirop de rodie 10 ml', 'Lintea am spalat-o bine, pana apa a ramas curata pe ea si am fiert-o la foc mic cu1 foaie de dafin, cateva felii de ceapa si 2 catei de usturoi in apa. Dureaza cam 15 minute. Am adaugat sare, am pus capacul si am lasat sa stea 10 minute asa. Am fiert mai multa linte, dar la aceasta reteta e nevoie doar de 150 gr linte fiarta.\nMorcovii se taie felii groase de un deget. Se presara cu sare, mult piper negru rasnit si cele doua tipuri de boia. Se adauga si 1 lingura de ulei si se maseaza bine. Se pun intr-un vas termorezisten, sa vina cam pe un strat, dar pot fi si usor inghesuiti.\nSe coc morcovii la 180C pana sunt facuti, amestecand in ei dupa o jumatate de ora. La mine a dura o ora sa fie gata, dar ii puteti verifica tot la 10 minute si ii scoateti cand sunt moi.\nSe pun in robot sau blenderul vertical lintea fiarta, morcovii copti, usturoiul strivit, tahini, sucul de lamaie, 2 linguri ulei de masline, coriandrul si fulgii de chili. Se presara putina sare. Se mixeaza bine pana aveti o pasta groasa cat mai fina, apoi incepeti sa turnati cate 1 lingura de apa rece pana obtineti o consistenta mai moale, mai pufoasa (am adaugat 8 linguri de apa). Gustati hummusul de sare.\nIntindeti hummusul pe o farfurie larga cu dosul unei linguri, facand un mic crater in mijloc. Acolo picurati 2 lingurite sos de rodie, putin ulei de masline si presarati putin patrunjel (sau/si menta) tocat.', 'Serviti cu pita sau cu paine prajita. Merge servit ca si garnitura langa o friptura (fiindca e un piure usor dulceag, carnea de vita, rata sau miel mi se pare potrivita).', 0, 'hummus.jpg', 1, '-', 161, 3, 0, 30, '', '14,'),
(17, '14', 'Guacamole', 'Guacamole e un sos originar din Mesoamerica, preparat pe bază de avocado. Cuvântul provine din limba spaniolă din aguacate și mole (avocado și sos) care la rândul lor provin din limba nahuatl, de la cuvântul Ahuacamolli (ahuacatl→aguacate→avocado; molli→mole→sos). Sosul are în componență pastă de avocado și apă la care se adaugă mirodenii.”', 'avocado  150 g\r\nlamaie 10 ml\r\nrosii 100 g\r\nceapa rosie 50 g\r\nardei iute tocat 15 g\r\nsare, piper 5 g', 'Am scos cu lingura pulpa de avocado si am asezat-o intr-un castron. Am stropit-o imediat cu zeama de lamaie verde si am zdrobit-o cu o furculita. Am pus rosia cubulete, ardeiul iute, ceapa, usturoiul si verdeata. Tot acum am asezonat cu sare si piper.\r\nAm amestecat totul si am lasat sa stea aproximativ 5 minute ca aromele sa se combine.', 'Guacamole se serveste ca dip pentru tortilla chips, nachos sau alte snacks crocante, se pune ca salsa la tacos sau alaturi de carnuri fripte la gratar.', 0, 'guacamole.jpg', 1, '', 140, 3, 0, 15, '', ''),
(21, '7', 'Mamaliga', 'dsadas', 'sdsad 2 ml', 'asddadsd', 'adsadsa', 17, 'mamaliga.png', 0, 'lapte de vaca', 13, 1, 1, 23, '0', '0');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` int(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` varchar(191) NOT NULL,
  `parere` varchar(191) NOT NULL,
  `id_reteta` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `created_at`, `parere`, `id_reteta`, `id_user`) VALUES
(12, 'Ion', '2024-05-07 18:39:19', 'foarte buna', 15, 8);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` int(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `prenume` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `role_as` tinyint(4) NOT NULL DEFAULT 0,
  `phone` int(191) NOT NULL,
  `adress` varchar(191) NOT NULL,
  `pincode` int(191) NOT NULL,
  `token_code` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `name`, `prenume`, `email`, `password`, `role_as`, `phone`, `adress`, `pincode`, `token_code`) VALUES
(7, '', 'denisa', 'denisa@gmail.com', '1234', 1, 0, '', 0, ''),
(8, 'Ion', 'Popescu', 'ionpopescu@mail.com', '1234', 0, 7215963, 'Arad, Arad, Strada Soarelui, nr 40', 963, ''),
(9, 'ionescu', 'andrei', 'andrei@ionescu.com', '1234', 0, 0, '', 0, ''),
(10, '  vlad', '  popescu', 'vlad@mail.com', '1234', 0, 7215963, '', 963, ''),
(11, ' Danciu', ' Denisa', 'danciudenisa12@gmail.com', '1234', 0, 7215963, 'Timisoara, Timis, str Dropiei, nr 7', 98563, ''),
(12, 'om', 'miau', 'miau@miau.com', '12345678', 0, 0, '', 0, ''),
(13, 'mig', 'as', 'admin111@mail', '12345678', 0, 0, '', 0, ''),
(14, 'admin', 'admin', 'admin', '1234', 1, 0, '', 0, ''),
(15, 'admin', 'admin', 'admin', '1234', 1, 0, 'fff', 0, ''),
(16, 'hhgfg', 'miau', 'denisa.danciu03@e-uvt.ro', '12345678', 0, 0, '', 0, '503568'),
(17, 'danciu', 'denisa', 'danciudenisa15@gmail.com', '12345678', 0, 0, '', 0, '344381'),
(18, 'danciu', 'denisa', 'danciudenisa15@gmail.com', '12345678', 0, 0, '', 0, '421624');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `cupoane`
--
ALTER TABLE `cupoane`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `filtre`
--
ALTER TABLE `filtre`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `news_letter`
--
ALTER TABLE `news_letter`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `retete`
--
ALTER TABLE `retete`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT pentru tabele `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pentru tabele `cupoane`
--
ALTER TABLE `cupoane`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pentru tabele `filtre`
--
ALTER TABLE `filtre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pentru tabele `news_letter`
--
ALTER TABLE `news_letter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pentru tabele `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pentru tabele `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pentru tabele `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pentru tabele `retete`
--
ALTER TABLE `retete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pentru tabele `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
