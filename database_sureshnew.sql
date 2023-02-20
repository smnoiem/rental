-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 05, 2019 at 11:14 PM
-- Server version: 5.6.44-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sureshnew`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `category` text NOT NULL,
  `sub_category` text NOT NULL,
  `location` text NOT NULL,
  `details` text NOT NULL,
  `image` text NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'active',
  `verified` varchar(15) NOT NULL DEFAULT 'not',
  `sellers_id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `category`, `sub_category`, `location`, `details`, `image`, `status`, `verified`, `sellers_id`, `users_id`) VALUES
(17, 'Projectors For Rent', '10', '54', '2', '                           ', 'Projectors_For_Rent1392724853.jpg', 'active', 'yes', 15, 15),
(18, 'Projector Screen for Rent', '10', '55', '2', '                           ', 'Projector_Screen_for_Rent1097352410.jpg', 'active', 'yes', 15, 15),
(19, 'Speaker For Rent', '20', '59', '2', '                           ', 'Speaker_For_Rent370794753.jpg', 'active', 'yes', 15, 15),
(20, 'Mic For Rent', '20', '60', '2', '                           ', 'Mic_For_Rent1361071849.png', 'active', 'yes', 15, 15);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` text NOT NULL,
  `icon` varchar(100) NOT NULL,
  `catkey` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `icon`, `catkey`) VALUES
(10, 'Video Equipment ', 'videoequipmentrental.png', 'videoequipment'),
(20, 'Audio Equipment', 'audioequipment.png', 'audioequipment'),
(21, 'Cameras and Accessories', 'camerasandaccessories.png', 'camerasandaccessories'),
(22, 'Vehicles ', 'vehicles.png', 'vehicles'),
(23, 'Costumes', 'costumes.png', 'costumes'),
(24, 'Event Equipment', 'eventequipment.png', 'eventequipment'),
(25, 'Home Appliances', 'homeappliances.png', 'homeappliances'),
(26, 'Office Equipment ', 'officeequipment.png', 'officeequipment'),
(27, 'Medical Equipment', 'medicalequipment.png', 'medicalequipment'),
(28, 'Trekking Equipments ', 'trekkingequipments.png', 'trekkingequipments'),
(29, 'Kids Gaming Items', 'kidsequipment.png', 'kidsgamingtoys'),
(30, 'Construction & Industrial Equipment', 'constructionequipment.png', 'construction-industrialequipment'),
(31, 'Decoration', 'decoration.jpg', 'decoration');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(3) UNSIGNED NOT NULL,
  `location` text NOT NULL,
  `lockey` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location`, `lockey`) VALUES
(1, 'Guwahati', 'guwahati'),
(2, 'Bangalore', 'bangalore'),
(3, 'Chennai', 'chennai'),
(4, 'Mumbai', 'mumbai'),
(5, 'Delhi', 'delhi'),
(6, 'Hyderabad', 'hyderabad'),
(7, 'Kolkata', 'kolkata'),
(8, 'Pune', 'pune'),
(9, 'Guntur', 'guntur'),
(10, 'Mysore', 'mysore'),
(11, 'Visakhapatnam', 'visakhapatnam'),
(12, 'Surat', 'surat'),
(13, 'Ahmedabad', 'Ahmedabad'),
(14, 'Patna', 'patna'),
(15, 'Kanpur', 'kanpur'),
(16, 'Vijayawada', 'vijayawada'),
(17, 'Jamshedpur', 'jamshedpur'),
(18, 'Nellore', 'Nellore');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bname` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `aphone` text NOT NULL,
  `estab` date NOT NULL,
  `location` text NOT NULL,
  `address` text NOT NULL,
  `website` text NOT NULL,
  `gstin` text NOT NULL,
  `plan` text NOT NULL,
  `image` text NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `bname`, `email`, `phone`, `aphone`, `estab`, `location`, `address`, `website`, `gstin`, `plan`, `image`, `users_id`) VALUES
(14, 'raju', 'venkateshraju142@gmail.com', '9900901047', '8660097479', '0000-00-00', '2', 'Bangalore, Karnataka', '', '', 'platinum', '16.jpeg', 16),
(15, 'Quickon Rentals', 'quickonrentals@gmail.com', '6362328251', '', '0000-00-00', '1', 'RT Nagar', '', '', 'platinum', '15.png', 15),
(16, 'Jataayu Group', 'jataayugroup@gmail.com', '9538178049', '9611633214', '2015-01-29', '2', 'Nature View Apartment, No 780, L R Bande Main Road, Monnarayanaplaya, RT Nagar, Near, Bengaluru, Karnataka 560032', 'https://www.jataayugroup.in', '', 'trial', '17.jpeg', 17);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(10) UNSIGNED NOT NULL,
  `subcategory` text NOT NULL,
  `subcatkey` varchar(100) DEFAULT NULL,
  `cat_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `subcategory`, `subcatkey`, `cat_id`) VALUES
(54, 'Projectors', 'projectors', 10),
(55, 'Projector Screens', 'projectorscreens', 10),
(56, 'LED Walls', 'ledwalls', 10),
(57, 'Televisions', 'televisions', 10),
(59, 'Speakers', 'speakers', 20),
(60, 'Microphones', 'microphones', 20),
(61, 'DJ Sound System', 'djsoundsystem', 20),
(62, 'Karaoke Systems', 'karaokesystems', 20),
(64, 'DSLR Cameras', 'dslrcameras', 21),
(65, 'DSLR Lenses', 'dslrlenses', 21),
(66, 'Camera Tripods', 'cameratripods', 21),
(67, 'Drone Cameras', 'dronecameras', 21),
(68, 'Cars', 'cars', 22),
(69, 'Trucks', 'trucks', 22),
(70, 'Tempos', 'tempos', 22),
(71, 'Vans', 'vans', 22),
(72, 'Tempo Travellers', 'tempotravellers', 22),
(73, 'Buses', 'buses', 22),
(74, 'Kids Costumes', 'kidscostumes', 23),
(75, 'Bridal Wear', 'bridalwear', 23),
(76, 'Blazers', 'blazers', 23),
(77, 'Fancy Dresses', 'fancydresses', 23),
(78, 'Chairs', 'chairs', 24),
(79, 'Lightings', 'lightings', 24),
(81, 'Generators', 'generators', 24),
(82, 'Function Halls', 'functionhalls', 24),
(83, 'Shamiana ', 'shamiana', 24),
(84, 'Foldable Tables', 'foldabletables', 24),
(85, 'Round Tables', 'roundtables', 24),
(86, 'Air Coolers', 'aircoolers', 25),
(87, 'Refrigerators', 'refrigerators', 25),
(88, 'TV', 'tv', 25),
(89, 'Washing Machines', 'washingmachines', 25),
(90, 'Microwave Ovens', 'microwaveovens', 25),
(91, 'Water Purifiers', 'waterpurifiers', 25),
(92, 'Water Heaters', 'waterheaters', 25),
(93, 'Mist Fans', 'mistfans', 25),
(94, 'Laptops', 'laptops', 26),
(95, 'Computers', 'computers', 26),
(96, 'Printers', 'printers', 26),
(97, 'Office Chairs', 'officechairs', 26),
(98, 'Office Tables', 'officetables', 26),
(99, 'Shredders', 'shredders', 26),
(100, 'Oxygen Cylinders', 'oxygencylinders', 27),
(101, 'Bi-PAP / CPAP', 'bi-pap/cpap', 27),
(102, 'Wheel Chairs', 'wheelchairs', 27),
(103, 'Ambulance', 'ambulance', 27),
(104, 'Cardiac Monitors', 'cardiacmonitors', 27),
(105, 'Ventilators', 'ventilators', 27),
(106, 'Syringe Pumps', 'syringepumps', 27),
(107, 'Suction Apparatus', 'suctionapparatus', 27),
(108, 'Pulse Oximeter', 'pulseoximeter', 27),
(109, 'Tents', 'tents', 28),
(110, 'Sleeping Bags', 'sleepingbags', 28),
(111, 'Trek Shoes', 'trekshoes', 28),
(112, 'Head Lamps', 'headlamps', 28),
(113, 'Life Jackets', 'lifejackets', 28),
(114, 'Wind Jackets', 'windjackets', 28),
(115, 'Rucksack Bags', 'rucksackbags', 28),
(116, 'Tent  Lights', 'tentlights', 28),
(118, 'Bouncy House', 'bouncyhouse', 29),
(119, 'Bouncing Castles', 'bouncingcastles', 29),
(120, 'Trampolines', 'trampolines', 29),
(121, 'Playstations', 'playstations', 29),
(122, 'Educational Toys', 'educationaltoys', 29),
(123, 'Kids Toys', 'kidstoys', 29),
(124, 'Outdoor Games', 'outdoorgames', 29),
(125, 'Indoor Games', 'indoorgames', 29),
(126, 'Dead Body Freezer Box', 'deadbodyfreezerbox', 27),
(127, 'Boom Lift', 'boomlift', 30),
(128, 'Fork Lift', 'forklift', 30),
(129, 'Scissor Lift', 'scissorlift', 30),
(130, 'Earth Movers', 'earthmovers', 30),
(131, 'Cranes', 'cranes', 30),
(132, 'Manlift', 'manlift', 30),
(133, 'Air Equipment', 'airequipment', 30),
(134, 'Wheel Loaders', 'wheelloaders', 30),
(135, 'Tippers', 'tippers', 30),
(136, 'Flower Decoration', 'flowerdecoration', 31),
(137, 'Event Planning', 'eventplanning', 31),
(138, 'Balloon Decoration', 'balloondecoration', 31);

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `cat` int(10) NOT NULL,
  `subcat` int(10) NOT NULL,
  `location` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `name`, `email`, `phone`, `cat`, `subcat`, `location`) VALUES
(5, 'deepak', 'yendlurisureshys@gmail.com', '06362328251', 2, 10, 9),
(6, 'venkatesh', 'venkateshraju142@gmail.com', '9900901047', 10, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `password` text NOT NULL,
  `token` varchar(250) NOT NULL,
  `token_exp` datetime NOT NULL,
  `email` text NOT NULL,
  `user_type` int(3) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `password`, `token`, `token_exp`, `email`, `user_type`) VALUES
(15, 'suresh', 'y', '$2y$10$eSResOPhEHtRHRsCeIUJI.bNoZs1NmA3QcQ4VHAc6NR8dPPeuWHHi', 'e48a900a95c8e0a3db31da9fbad6866e8c45d239e7', '2019-10-05 18:17:43', 'yendlurisureshys@gmail.com', 2),
(16, 'venkatesh', 'Raju', '$2y$10$Jx621691yWEWsUWtkexGUOfEvcIfLN8j1uZPazoYTzM0uN6HCzjvK', '', '0000-00-00 00:00:00', 'venkateshraju142@gmail.com', 1),
(17, 'Jataayu', 'Group', '$2y$10$eW4j2GL0krkzWeicxSmfweqKB9o02BOLRQ8ZP5AMVNxPO.usuYQ.W', '', '0000-00-00 00:00:00', 'jataayugroup@gmail.com', 2),
(19, 'Rajus', 'n', '$2y$10$WNB9QmmFkprEGxoLhj8E5ehjAE9maloXMxhbn1XPDxKrU7Z9CTQ/2', 'e48a900a95c8e0a3db31da9fbad6866e3ac064053b', '2019-10-05 05:55:03', 'rajusn9900@gmail.com', 3),
(20, 'venkatesh', 'raj', '$2y$10$6PshHVpCMUjdTO6B16XcN.bnN6aeVgTVH8nCoXxDnayxTAB2aMjc.', 'e48a900a95c8e0a3db31da9fbad6866ec53bfd3f52', '2019-10-05 08:15:29', 'venkateshraju9900@gmail.com', 3),
(21, 'Gani', 'M', '$2y$10$pCOw6fAj9guH3kbiprnVd.DskGHyg8WEMVdheTF/TymDTAzoRgPPm', 'e48a900a95c8e0a3db31da9fbad6866e9335f3c1cd', '2019-10-05 10:12:28', 'ksuraj680@gmail.com', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `catkey` (`catkey`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lockey` (`lockey`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subcatkey` (`subcatkey`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `sellers_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
