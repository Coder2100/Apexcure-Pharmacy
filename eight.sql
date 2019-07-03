-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2018 at 06:54 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eight`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(31, 'TransAct'),
(32, 'NuroFen'),
(33, 'iLiadin'),
(34, 'Wermox'),
(35, 'Clickx'),
(36, 'Strepsils'),
(37, 'Vitality'),
(38, 'Valoids'),
(39, 'Covamets'),
(40, 'Stugeron'),
(41, 'Sorbet Men'),
(42, 'Sorbet Women'),
(43, 'Kistna'),
(44, 'Nivea Men'),
(45, 'Gillette'),
(46, 'Prep'),
(47, 'Hairgum'),
(48, 'Rockface'),
(49, 'Schick'),
(50, 'Scholl'),
(51, 'Clix'),
(52, 'Clixx');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `expired_date` datetime NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(1, 'Men', 1),
(6, 'Pants', 1),
(7, 'Shoes', 1),
(8, 'Accessories', 1),
(18, 'Gadgets', 1),
(75, 'Pharmacy', 0),
(76, 'Mens', 0),
(77, 'Toiletries', 0),
(78, 'Mother &amp; Babies', 0),
(79, 'Beauty', 0),
(80, 'OTC Medication ', 75),
(81, ' Alternative, Homeopathic and Herbal Health', 75),
(82, 'Pain Relief', 75),
(83, 'Back Pain', 75),
(84, 'Dental Pain', 75),
(85, 'Headaches', 75),
(86, 'Muscle Cramps', 75),
(87, 'Muscle Pain', 75),
(88, 'Period Pain', 75),
(89, 'Anaesthetics (Skin numbing)', 75),
(90, ' Anti Migraine Agents ', 75),
(91, ' Anti-Vertigo Anti-Emetic Agents', 75),
(92, 'Anti-histamines (Glossary: Allergy medication)', 75),
(93, ' Baby and Child Health', 75),
(94, ' Blood &amp; Haemopoetic (Glossary: Heart Health)', 75),
(95, ' Condoms and Sexual Health', 75),
(96, ' Cough &amp; Colds', 75),
(97, ' Dermatologicals (Glossary: Itchy skin or skin rash Relief)', 75),
(98, ' Dermatologicals (Glossary: Skincare)', 75),
(99, ' Dermatologicals (Glossary: Wart Treatment)', 75),
(100, ' Diabetes', 75),
(101, ' Diagnostics and Electrical Health', 75),
(102, ' Diet and Weight loss', 75),
(103, ' Ear, Nose and Throat', 75),
(104, ' Energy', 75),
(105, ' First Aid', 75),
(106, ' Footcare', 75),
(107, ' Gastro-Intestinal Tract (Glossary: Digestive health)', 75),
(108, ' Health Food', 75),
(109, ' Incontinence', 75),
(110, ' Legcare', 75),
(111, ' Men&#039;s Health', 75),
(112, ' Mobility and Daily Living Aids', 75),
(113, ' Mouthcare', 75),
(114, ' Musculo-Skeletal Agents (Glossary: Muscle and Joint Pain)', 75),
(115, ' Opthalmics (Glossary: Red, dry or itchy eye drops)', 75),
(116, ' Respiratory System (Glossary: Tight chest medication)', 75),
(117, ' Sedative Hypnotics (Glossary: Sleep Assistance)', 75),
(118, ' Sensitive Health Solutions', 75),
(119, ' Sports Nutrition and Supplements', 75),
(120, ' Stop Smoking', 75),
(121, ' Urinary System (Glossary: Bladder Health)', 75),
(122, ' Vaginal Preparations (Glossary: Vaginal Infection Treatments)', 75),
(123, ' Vitamins and Supplements', 75),
(125, ' Women&#039;s Health', 75),
(126, ' Beauty Tools', 79),
(127, ' Celebrity Fragrances', 79),
(128, ' Cotton Wool, Facial Wipes and Buds', 79),
(129, ' Ethnic Haircare', 79),
(130, ' Expert Skincare', 79),
(131, ' Facial Skincare', 79),
(132, ' Footcare', 79),
(133, ' Fragrances', 79),
(134, ' Hair Accessories', 79),
(135, ' Hair Colourants', 79),
(136, ' Haircare', 79),
(137, ' Hosiery', 79),
(138, ' Jewellery', 79),
(139, ' Lipcare', 79),
(140, ' Luxury Fragrances', 79),
(141, ' Make-up - Eyes', 79),
(142, ' Make-up - Face', 79),
(143, ' Make-up - Lips', 79),
(144, ' Make-up Removers', 79),
(145, ' Make-up Sets and Palettes', 79),
(146, ' Nails', 79),
(147, ' Natural Haircare', 79),
(148, ' Sunglasses', 79),
(149, ' Temporary Tattoos', 79),
(150, ' Baby Clothing', 78),
(151, ' Baby Feeding', 78),
(152, ' Baby Safety', 78),
(153, ' Baby Toiletries and Bathing', 78),
(154, ' Baby Toys', 78),
(155, ' Baby Travel', 78),
(156, ' Baby and Child Health', 78),
(157, ' Baby and Toddler Food and Drinks', 78),
(158, ' Baby and Toddler Gifts', 78),
(159, ' Nappies and Wipes', 78),
(160, ' New Mom', 78),
(161, ' Planning for Baby', 78),
(162, ' Pregnancy', 78),
(163, ' Body Skincare', 77),
(164, ' Deodorants', 77),
(165, ' Electrical Dental', 77),
(166, ' Expert Bodycare', 77),
(167, ' Female Hair Removal', 77),
(168, ' Feminine Hygiene', 77),
(170, ' Gift Sets', 77),
(171, ' Handscare', 77),
(172, ' Oral Health', 77),
(173, ' Suncare and Protection', 77),
(174, ' Toothbrushes', 77),
(175, ' Washing and Bathing', 77),
(176, ' Aftershave', 76),
(177, ' Celebrity Fragrances', 76),
(178, ' Fragrances', 76),
(179, ' Luxury Fragrances', 76),
(180, ' Men&#039;s Bath and Shower', 76),
(181, ' Men&#039;s Bodycare', 76),
(182, ' Men&#039;s Deodorants', 76),
(183, ' Men&#039;s Facial Skincare', 76),
(184, ' Men&#039;s Hair Removal', 76),
(185, ' Men&#039;s Haircare', 76),
(186, ' Shaving', 76),
(187, 'Appliances', 0),
(188, ' Audio', 187),
(189, ' Batteries and Chargers', 187),
(190, ' Electrical Beauty', 187),
(191, ' Dental Appliances', 187),
(192, ' Hair Styling Appliances', 187),
(193, ' Female Electrical Grooming', 187),
(194, ' Household Appliances', 187),
(195, ' Kitchen Appliances', 187),
(196, ' Men&#039;s Electrical Grooming', 187),
(197, ' Seasonal Appliances', 187),
(198, ' Technology and Accessories', 187),
(199, 'First Aid', 0),
(200, 'Bandages   ', 199),
(201, ' Disinfectants', 199),
(202, '  Dressings  ', 199),
(203, ' Electrical  ', 199),
(205, 'Gloves', 199),
(206, 'Kits  ', 199),
(207, '   Plasters  ', 199),
(208, 'Allergy and Hayfever ', 75),
(209, 'Dermatols', 75);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street_address2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('f','m') COLLATE utf8_unicode_ci NOT NULL,
  `verification_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verified` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `password`, `join_date`, `last_login`, `mobile`, `street_address`, `street_address2`, `city`, `province`, `zip_code`, `country`, `gender`, `verification_code`, `verified`) VALUES
(2, 'zukes', 'zukes', 'email@email.com', '$2y$10$4L5kP.vGQfKEhGiRUM/lSev6gnST7a/aXUEwRu4MLLReL9B4qS/m6', '2018-01-17 00:00:00', '2018-01-18 00:00:00', '0840187667', '8 highstead rd', 'rondebosch', 'cape town', 'western province', '8000', 'south africa', 'm', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

CREATE TABLE `medications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `images` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `sizes` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `SKU` text COLLATE utf8_unicode_ci NOT NULL,
  `manufacture_id` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `sizes` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `SKU` text COLLATE utf8_unicode_ci NOT NULL,
  `manufacture_id` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `sizes`, `deleted`, `SKU`, `manufacture_id`) VALUES
(9, 'Tablets', '45.55', '55.99', 35, '81', '/eight/images/products/cc54e57b0ba22bce06d2a3318b146802.jpg,/eight/images/products/ac09ada801f762534fdc1af6ba3f1fc3.jpg,/eight/images/products/54195ee69f1bef479a772361b0d55f5e.jpg', 'You must think that I&#039;m stupid \r\nYou must think that I&#039;m a fool\r\n You must think that I&#039;m new to this But I have seen this \r\nall before I&#039;m never gonna let you close to me Even though \r\nyou mean the most to me &#039;Cause every time I open up, it \r\nhurts So I&#039;m never gonna get too close to you Even when \r\nI mean the most to you In case you go and leave me in th\r\ne dirt But every time you hurt me, the less that I cry And every time you leave me, the quicker t\r\nhese tears dry And every time you walk out, the less I love you Baby, we don&#039;t stand a chan\r\nce, it&#039;s sad but it&#039;s true I&#039;m way too good at goodbyes (I&#039;m way too good at goodbyes) I&#039;m way t\r\noo good at goodbyes (I&#039;m way too good at goodbyes) I \r\n', 1, '50ml:21:8', 1, '', ''),
(10, 'Guva Huije', '30.00', '54.00', 35, '188', '/eight/images/products/db3d39e344ccf26367bd7016123c9e5d.jpg,/eight/images/products/50a4f0866b78668074ab8702df091d3a.jpg,/eight/images/products/16e668e85c63f14664cf26db3d6d9b57.jpg', 'There are three items i want o check.Please buy them!', 1, 's:500:450,xs:600:550,m:400:350', 0, '', ''),
(11, 'Try Me', '45.55', '55.99', 31, '144', '/eight/images/products/07fb6de30f14388a28f68178221a527f.jpg', 'tryryry\r\nryryryry\r\nyyryryry', 1, '23:7:6', 0, '', ''),
(12, 'Another', '45.55', '54.55', 32, '179', '/eight/images/products/3fc3cb222413397d1debf601bcae1cd7.png,/eight/images/products/1e89c89668090f6fadc39b013df696a7.png,/eight/images/products/1badfdbf0e14a3c31f060e7e5f2e3607.png,/eight/images/products/abff6ec5e2aa87aae1f5e5713e70d565.png', 'this is a try\r\nthis is a try\r\nthis is a try\r\nthis is a try', 1, '12:1:', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `charge_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trolley_id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `street_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street_address2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `txn_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `txn_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trolley`
--

CREATE TABLE `trolley` (
  `id` int(11) NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `expire_date` datetime NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `delivered` tinyint(4) NOT NULL DEFAULT '0',
  `quantity` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trolley`
--

INSERT INTO `trolley` (`id`, `items`, `customer_id`, `product_id`, `expire_date`, `paid`, `delivered`, `quantity`, `created_date`, `updated_date`) VALUES
(21, '[{\"id\":\"11\",\"size\":\"23\",\"quantity\":7}]', 0, 0, '2018-07-12 21:53:36', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, '[{\"id\":\"10\",\"size\":\"xs\",\"quantity\":\"590\"}]', 0, 0, '2018-07-20 20:23:15', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `permissions` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `join_date`, `last_login`, `permissions`) VALUES
(1, 'Zukile Mtotso', 'zukilemtotso@ymail.com', '$2y$10$tCFUBzvxLmaeuoKyZ1ffvuAdzzV/ivTUuYumolrePKjGXPYoYGu4q', '2017-12-20 23:42:35', '2018-06-10 17:30:22', 'admin,editor'),
(9, 'Joseph Tanya', 'emai1l@email.com', '$2y$10$igdgTG.pEkQ2LYVa4gQX2.fOjs70J8ffXPL/le/8lL0V7K7xFXH66', '2018-02-11 16:32:13', '2018-02-11 22:30:46', 'editor'),
(11, 'Seph', 'ymail@ymail.com', '$2y$10$6VMusHwApAVMX9e07wJ4duDxblKG2Cz59SbiT68h2BeYdrVyklJ3m', '2018-05-27 16:33:16', '2018-05-27 16:34:22', 'admin,editor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trolley`
--
ALTER TABLE `trolley`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trolley`
--
ALTER TABLE `trolley`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
