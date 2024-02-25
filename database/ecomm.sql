-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2024 at 12:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecomm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(65, 30, 38, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cat_slug` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `cat_slug`) VALUES
(13, 'Frozen Goods', 'frozen-goods'),
(14, 'Beverages', 'beverages'),
(15, 'Snacks', 'snacks'),
(16, 'Vegetables', 'vegetables'),
(17, 'Fruits', 'fruits'),
(18, 'Health ', 'health-'),
(19, 'Personal Care', 'personal-care');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `sales_id`, `product_id`, `quantity`) VALUES
(14, 9, 11, 2),
(15, 9, 13, 5),
(16, 9, 3, 2),
(17, 9, 1, 3),
(18, 10, 13, 3),
(19, 10, 2, 4),
(20, 10, 19, 5),
(21, 11, 39, 2),
(22, 12, 37, 1),
(23, 12, 48, 1),
(24, 13, 30, 1),
(25, 13, 38, 1),
(26, 14, 30, 1),
(27, 14, 40, 1),
(28, 15, 31, 1),
(29, 16, 36, 1),
(30, 17, 45, 1),
(31, 18, 31, 1),
(32, 18, 43, 1),
(33, 19, 36, 1),
(34, 20, 42, 1),
(35, 22, 43, 1),
(36, 22, 37, 1),
(37, 23, 45, 1),
(38, 23, 43, 1),
(39, 24, 38, 1),
(40, 25, 35, 1),
(41, 26, 31, 1),
(42, 27, 31, 1),
(43, 27, 30, 1),
(44, 28, 37, 1),
(45, 29, 38, 1),
(46, 29, 48, 1),
(47, 30, 37, 1),
(48, 30, 36, 1),
(49, 31, 38, 1),
(50, 31, 35, 1),
(51, 32, 40, 1),
(52, 33, 32, 1),
(53, 34, 45, 1),
(54, 35, 33, 1),
(55, 36, 44, 1),
(56, 37, 42, 1),
(57, 38, 43, 1),
(58, 39, 36, 1),
(59, 40, 43, 1),
(60, 41, 42, 1),
(61, 42, 34, 1),
(62, 43, 30, 1),
(63, 44, 36, 1),
(64, 46, 38, 1),
(65, 47, 37, 1),
(66, 48, 32, 1),
(67, 49, 36, 1),
(68, 50, 37, 1),
(69, 51, 43, 1),
(70, 52, 38, 1),
(71, 53, 32, 1),
(72, 54, 32, 1),
(73, 55, 48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `photo` varchar(200) NOT NULL,
  `date_view` date NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `slug`, `price`, `photo`, `date_view`, `counter`) VALUES
(30, 16, 'Honest Farms Table Tomato 250g', '<p>Cultivated organically by our partnered farmers in Bulacan and Benguet, table tomatoes boast an oval shape, a delicate skin, and a delectably sweet flavor, enhancing the appeal of various dishes. Abundant in lycopene, fiber, and essential vitamins, notably A and C, these tomatoes offer both taste and nutritional benefits.</p>\r\n', 'honest-farms-table-tomato-250g', 70, 'honest-farms-table-tomato-250g.png', '2024-01-21', 1),
(31, 16, 'Honest Farms White Radish 500g', '<p>Cultivated organically by our partnered farmers in Batangas, Benguet, and Rizal, the white radish features a crisp, peppery flesh with a zesty, mustard-like flavor. Low in calories, it offers significant levels of vitamin C, folate, fiber, and potassium. Additionally, it contains modest amounts of zinc and calcium.</p>\r\n', 'honest-farms-white-radish-500g', 150, 'honest-farms-white-radish-500g.png', '2024-01-20', 3),
(32, 16, 'Honest Farms Chayote 250g', '<p>Cultivated organically by our partnered farmers in Benguet, Daraitan, and Rizal, chayote possesses a crisp texture that becomes tender when cooked, accompanied by a gentle and slightly sweet flavor. This vegetable is rich in vitamin C, vitamin B-6, folate, dietary fiber, and potassium.</p>\r\n', 'honest-farms-chayote-250g', 35, 'honest-farms-chayote-250g.png', '2024-01-22', 3),
(33, 17, 'Watermelon 2.8kg', '<p>Watermelon is sweet, juicy, and has a satisfyingly crispy texture, perfect as a thirst-quenching and low-calorie snack!</p>\r\n', 'watermelon-2-8kg', 340, 'watermelon-2-8kg.png', '2024-01-20', 1),
(34, 17, 'Soursop (Guyabano) 600g', '<p>Guyabano has a rough, green skin with creamy white flesh and a strong flavor. It&#39;s a good source of calcium, phosphorus, iron, and vitamins C and B-complex. It contains compounds called acetogenins which are known to be versatile anticancer molecules.</p>\r\n', 'soursop-guyabano-600g', 125, 'soursop-guyabano-600g.png', '2024-01-21', 1),
(35, 17, 'Banana Saba 1kg', '<p>Banana Saba is shorter and thicker than a common banana, and have white, dense, starchy flesh. They are an excellent source of vitamins A, B, and C, and contain fiber, iron, and potassium.</p>\r\n', 'banana-saba-1kg', 135, 'banana-saba-1kg.png', '2024-01-20', 2),
(36, 13, 'Pork Soup Bones 1000g', '<p>Our happy pigs are fed with 100% organic cereals-based diet which contributes to its juicy and tasty meat with a sweet nuance provided by the chestnuts. They are raised without growth hormones or antibiotics and with access to the Galician countryside in Spain to cultivate pigs&#39; natural insticts, making sure you get the most tender and best tasting pork.</p>\r\n', 'pork-soup-bones-1000g', 595, 'pork-soup-bones-1000g.png', '2024-01-22', 2),
(37, 13, 'Frozen Bostock Chicken Thighs Boneless 330g', '<p>Bostock Brothers is New Zealand&#39;s only organic chicken producers.</p>\r\n\r\n<p>The chickens range freely on an organic apple orchard and thrive on a wholesome diet of certified organic homegrown feed, lush, green grass and juicy organic apples. Because the chickens grow naturally, the meat is better formed, is higher quality and superior tasting. They are also antibiotic free, hormone free, GMO free, chemical free and chlorine free.</p>\r\n\r\n<p>With the commitment to sustainability, all Bostock Brothers chicken products are packed in a compostable packaging. The packaging is compostable when disposed in a home compost environment containing water, oxygen, soil and micro-organisms.</p>\r\n', 'frozen-bostock-chicken-thighs-boneless-330g', 515, 'frozen-bostock-chicken-thighs-boneless-330g.png', '2024-01-22', 4),
(38, 13, 'Frozen By 360 Atlantic Salmon 280g', '<p>360&deg; Atlantic Salmon is raised by a family-owned farm that has been growing fish in the fjords of Norway for more than 20 years. Pioneer in the organic farming, it becomes the world&#39;s first salmon farm recognized by the Aquaculture Stewardship Council (ASC).</p>\r\n\r\n<p>Being raised in extremely cold water above the Arctic Circle, our Atlantic Salmon contains large amounts of essential Omega-3 fatty acids and natural antioxidants such as Vitamin E. These are essential for proper development of our nervous systems and they are considered effective in preventing heart and other cardiovascular diseases.</p>\r\n\r\n<p>To preserve its freshness, our Atlantic Salmon is quick frozen at temperatures of -40&deg;C and sealed in tight vacuum packs immediately after being harvested and processed, preventing oxidation and rancidity during storage. The result is a high quality product that maintains the essential fatty acids and fresh taste of salmon.</p>\r\n\r\n<p>A truly enjoyable and great seafood choice for everyone!</p>\r\n', 'frozen-360-atlantic-salmon-280g', 595, 'frozen-360-atlantic-salmon-280g.png', '2024-01-22', 3),
(39, 19, 'Attitude Super Leaves Hand Soap Red Vine Leaves 473ml', '', 'attitude-super-leaves-hand-soap-red-vine-leaves-473ml', 485, 'attitude-super-leaves-hand-soap-red-vine-leaves-473ml.png', '2024-01-08', 1),
(40, 19, 'Green Beaver Invigorating Tea Tree Shampoo 240ml', '<p>Green Beaver Invigorating Tea Tree Shampoo is tailored for normal to oily scalps. With cooling tea tree and mint, this invigorating, clarifying, and cleaning shampoo increases scalp circulation for a renewed and refreshed feeling.</p>\r\n', 'green-beaver-invigorating-tea-tree-shampoo-240ml', 675, 'green-beaver-invigorating-tea-tree-shampoo-240ml.png', '2024-01-20', 1),
(41, 19, 'Acure Brightening Day Cream Cica & Argan Oil 50ml', '<p>Face the day with cica (centella asiatica) and argan oil. This powerhouse combo helps moisturize and protect with a one-two punch that fights dullness and evens out skin tone for skin that&rsquo;s bright and beautiful. Serious ingredients for a stellar day.</p>\r\n', 'acure-brightening-day-cream-cica-argan-oil-50ml', 890, 'acure-brightening-day-cream-cica-argan-oil-50ml.png', '0000-00-00', 0),
(42, 14, 'Chilled Kevita Sparkling Probiotic Drink Tangerine 450ml', '', 'chilled-kevita-sparkling-probiotic-drink-tangerine-450ml', 310, 'chilled-kevita-sparkling-probiotic-drink-tangerine-450ml.png', '2024-01-21', 2),
(43, 14, 'Healthy Options Organic Pink Grapefruit Juice 750ml', '', 'healthy-options-organic-pink-grapefruit-juice-750ml', 395, 'healthy-options-organic-pink-grapefruit-juice-750ml.png', '2024-01-22', 1),
(44, 15, 'Healthy Options Organic Trail Mix with Berries 142g', '', 'healthy-options-organic-trail-mix-berries-142g', 345, 'healthy-options-organic-trail-mix-berries-142g.png', '2024-01-20', 4),
(45, 15, 'Coco Crisps Organic Baked Coconut Chips Cacao 30g', '', 'coco-crisps-organic-baked-coconut-chips-cacao-30g', 70, 'coco-crisps-organic-baked-coconut-chips-cacao-30g.png', '2024-01-20', 2),
(46, 19, 'Lily of the Desert Aloe Vera Gel 16 ounces', '', 'lily-of-desert-aloe-vera-gel-16-ounces', 430, 'lily-of-desert-aloe-vera-gel-16-ounces.png', '0000-00-00', 0),
(47, 18, 'Solgar L-Arginine 500mg 100 capsules', '', 'solgar-l-arginine-500mg-100-capsules', 823, 'solgar-l-arginine-500mg-100-capsules.png', '0000-00-00', 0),
(48, 18, 'Solgar Korean Ginseng Root Extract 60 Capsules', '<p>Korean Ginseng is an immune support herb that naturally contains beneficial components that play a role in the body&rsquo;s well-being. It helps enable Korean Ginseng the unique ability to rejuvenate and revitalize the entire body in order to make the most out of its natural energy. It is known for its ability to support physical performance.</p>\r\n', 'solgar-korean-ginseng-root-extract-60-capsules', 678, 'solgar-korean-ginseng-root-extract-60-capsules.png', '2024-01-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_id` varchar(50) NOT NULL,
  `sales_date` date NOT NULL,
  `sales_status` varchar(255) DEFAULT NULL,
  `sales_recipient` text NOT NULL,
  `sales_address` text NOT NULL,
  `sales_contact_info` varchar(50) NOT NULL,
  `pay_method` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `pay_id`, `sales_date`, `sales_status`, `sales_recipient`, `sales_address`, `sales_contact_info`, `pay_method`) VALUES
(47, 28, 'PAYID-tGoABdWJdNa5lDUmkjJrTD96aBlenqG0', '2024-01-22', 'In Progress', 'Grace Doe', 'Tetuan, Zamboanga City, Philippines', '09673655502', 'Cash on Delivery'),
(52, 29, 'PAYID-MWXEZBQ6GA20086HW3091825', '2024-01-22', 'In Progress', 'Kathryn Bernardo', 'Baliwasan, Zamboanga City', '09674578291', 'Paid via Paypal'),
(53, 29, 'PAYID-RvHD2UVcEiMZ99uEXKu0W1SVJbdUrqj9', '2024-01-22', 'In Progress', 'Daniel Padilla', 'San Roque, Zamboanga City Philippines', '\n								09972548901								\n							', 'Cash on Delivery'),
(54, 30, 'PAYID-MWXFEKY3W921087VC433604X', '2024-01-22', 'In Progress', 'Nadine  Lustre', 'Tugbungan, Zamboanga City', '09673655502', 'Paid via Paypal'),
(55, 30, 'PAYID-pmOOBwhGNtncrKJfgKWrZ3ZVDh0gZp4u', '2024-01-22', 'In Progress', 'Anne Curtis', 'Cubao, Metro Manila', '\n								09235671972								\n							', 'Cash on Delivery');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(60) NOT NULL,
  `type` int(1) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `address2` text NOT NULL,
  `buyer2` varchar(50) NOT NULL,
  `contact_info2` varchar(100) NOT NULL,
  `address3` text NOT NULL,
  `buyer3` varchar(50) NOT NULL,
  `contact_info3` varchar(100) NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `activate_code` varchar(15) NOT NULL,
  `reset_code` varchar(15) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `type`, `firstname`, `lastname`, `address`, `address2`, `buyer2`, `contact_info2`, `address3`, `buyer3`, `contact_info3`, `contact_info`, `photo`, `status`, `activate_code`, `reset_code`, `created_on`) VALUES
(1, 'admin@admin.com', '$2y$10$Jmp6ZeWmTMbK9/WQaKgXo.L9rt1nwcFolYVn7pTRnJG.Zr3nb2ZX6', 1, 'Admin', 'Admin', '', '', '', '0', '', '', '0', '', 'kathryn-bernardo-1695296855.jpg', 1, '', '', '2018-05-01'),
(25, 'janedoe123@email.com', '$2y$10$JfNWXdRYdMCuvu/wkH52gegcul1VDyrzP1f0EOXKBSyXXVopfMlXC', 0, 'Jane ', 'Doe', '', '', '', '0', '', '', '0', '', '', 0, 'kyBnhpqYFAHx', '', '2024-01-08'),
(26, 'gracedoe@email.com', '$2y$10$BbgvYjSOU59qdX3hvRj.nefbrEfd6u5RaoqApq.darWOOj7K71ZpG', 0, 'Grace', 'Doe', '', '', '', '0', '', '', '0', '', '', 0, 'AyM5eLHKD9YI', '', '2024-01-08'),
(27, 'jdc@email.com', '$2y$10$9fpRpfQea97NCS.D6UPwleVwBm53fkjR.vPpVBhq3BRvc4LspsYnS', 0, 'Juan ', 'Dela Cruz', 'Zamboanga City', '', '', '0', '', '', '0', '09673655502', 'thanos1.jpg', 0, 'Qx28pLCaZUuA', '', '2024-01-11'),
(28, 'graceD@email.com', '$2y$10$IKy6Pr4bTfoTYT1VBH7ru.SsS4PBL9exgXwap1hceljnqdsWtzyLK', 0, 'Grace', 'Doe', 'Tetuan, Zamboanga City, Philippines', 'Divisoria, Zamboanga City, Philippines', 'Jane Doe', '09672567892', 'Tugbungan, Zamboanga City, Philippines', 'John Dela Cruz', '09235617892', '09673655502', '', 0, 'hSjnpKU3oqxO', '', '2024-01-15'),
(29, 'kathyB@email.com', '$2y$10$dHK6.6ks6X/k7/71Tka5/eemwa/Odkmb.Bb5zuNglACaG8legD6v.', 0, 'Kathryn', 'Bernardo', 'Baliwasan, Zamboanga City', 'San Roque, Zamboanga City Philippines', 'Daniel Padilla', '09972548901', '', '', '', '09674578291', '', 0, 'isXNnQ2ZC9JD', '', '2024-01-22'),
(30, 'nadineL@email.com', '$2y$10$nUneoJFu7S/cBmMQk2aGKOQfldxs69.Vgw/XjjfPEvtq4P2JNZJcO', 0, 'Nadine ', 'Lustre', 'Tugbungan, Zamboanga City', '', '', '', 'Cubao, Metro Manila', 'Anne Curtis', '09235671972', '09673655502', 'MIGHTY MANE.png', 0, 'mbXveo3GQPy9', '', '2024-01-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
