-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 29, 2023 at 11:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `productId` int(10) NOT NULL,
  `userid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catagories`
--

CREATE TABLE `catagories` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catagories`
--

INSERT INTO `catagories` (`id`, `name`, `photo`) VALUES
(2, 'Mobile Phones', '/uploads/1679824761609--Apple-iPhone-12-PNG-Photo.png'),
(3, 'Home Applicances', '/uploads/1679824781823--Home-Appliance-Background-PNG.png'),
(4, ' Furnitures', '/uploads/1679824795757--Sofa-Transparent-Background.png'),
(5, 'Office equipments', '/uploads/1679824810895--pngwing.com.png'),
(6, 'Automobiles and Cars', '/uploads/1679864182095--Car-PNG-Picture.png'),
(7, 'Books and Study ', '/uploads/1680074459263--pngwing.com (1).png'),
(8, 'Fashion and Beauty', '/uploads/1680074689263--kindpng_2185799.png');

-- --------------------------------------------------------

--
-- Table structure for table `orderedProducts`
--

CREATE TABLE `orderedProducts` (
  `orderid` varchar(100) NOT NULL,
  `productId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderedProducts`
--

INSERT INTO `orderedProducts` (`orderid`, `productId`) VALUES
('6424b04ba2b54', 6),
('6424b04ba2b54', 2),
('6424b04ba2b54', 2),
('6424b04ba2b54', 2),
('6424b04ba2b54', 6),
('6424b04ba2b54', 6),
('6424b04ba2b54', 6),
('6424b04ba2b54', 6),
('6424b04ba2b54', 6),
('6424b04ba2b54', 6),
('6424b04ba2b54', 6),
('6424b04ba2b54', 1),
('6424b0d53acd4', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `turn_id` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending',
  `address` varchar(100) NOT NULL,
  `userid` int(10) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `notes` varchar(100) DEFAULT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`turn_id`, `status`, `address`, `userid`, `phone`, `name`, `notes`, `order_date`) VALUES
('6424b04ba2b54', 'pending', '', 1, '01533523233', 'Md Reaz Ahammed Chowdhury', '', '2023-03-30'),
('6424b0d53acd4', 'pending', '', 1, '01533523233', 'Md Reaz Ahammed Chowdhury', '', '2023-03-30');

-- --------------------------------------------------------

--
-- Table structure for table `orderSession`
--

CREATE TABLE `orderSession` (
  `orderid` varchar(100) NOT NULL,
  `session` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productImages`
--

CREATE TABLE `productImages` (
  `id` int(10) NOT NULL,
  `productId` int(10) NOT NULL,
  `file_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productImages`
--

INSERT INTO `productImages` (`id`, `productId`, `file_name`) VALUES
(1, 1, '/uploads/1679870401999--Apple-iPhone-12-PNG-Photo.png'),
(2, 1, '/uploads/1679870402001--Car-PNG-Picture.png'),
(3, 1, '/uploads/1679870402002--hero__cj6i78tzkp8i_large_2x.jpg'),
(4, 1, '/uploads/1679870402004--Home-Appliance-Background-PNG.png'),
(5, 2, '/uploads/1679870571769--hero__cj6i78tzkp8i_large_2x.jpg'),
(6, 3, '/uploads/1679870874855--Apple-iPhone-12-PNG-Photo.png'),
(7, 3, '/uploads/1679870874856--Car-PNG-Picture.png'),
(8, 3, '/uploads/1679870874858--hero__cj6i78tzkp8i_large_2x.jpg'),
(9, 4, 'error'),
(10, 5, '/uploads/1679870965976--hero__cj6i78tzkp8i_large_2x.jpg'),
(11, 5, '/uploads/1679870965977--pexels-albin-berlin-919073.jpg'),
(12, 6, '/uploads/1680079273100--Apple-iPhone-12-PNG-Photo.png'),
(13, 6, '/uploads/1680079273101--Car-PNG-Picture.png'),
(14, 6, '/uploads/1680079273101--hero__cj6i78tzkp8i_large_2x.jpg'),
(15, 6, '/uploads/1680079273102--Home-Appliance-Background-PNG.png');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `catagory` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `catagory`, `image`, `price`) VALUES
(1, 'Iphone 11x pro', 'this is hello world', 2, '/uploads/1679870401993--Apple-iPhone-12-PNG-Photo.png', 10000),
(2, 'Iphone 11x ', 'this is a description', 2, '/uploads/1679870571766--Home-Appliance-Background-PNG.png', 121.11),
(3, 'BMW xyz', 'hello world this is dump', 6, '/uploads/1679870874852--Car-PNG-Picture.png', 13345700),
(4, 'Khata kolom', 'This is d', 5, '/uploads/1679870933800--pngwing.com.png', 110.12),
(5, 'Home set', 'This is not dump', 2, '/uploads/1679870965974--Home-Appliance-Background-PNG.png', 100.1),
(6, 'Iphone 12xx', 'Lorem Ipsum is simply dummy text of the printing and ', 2, '/uploads/1680079273095--Apple-iPhone-12-PNG-Photo.png', 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `proImage` varchar(100) NOT NULL DEFAULT '/uploads/user.svg',
  `role` varchar(10) NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `address`, `proImage`, `role`) VALUES
(1, 'Md Reaz Ahammed Chowdhury', '01533523233', 'baphonreaz@gmail.com', 'b4b4c614a99865a49ec2ef8196d16240', NULL, '/uploads/user.svg', 'admin'),
(2, 'Iron Man', '01521545113', 'ironman@gmail.com', 'b4b4c614a99865a49ec2ef8196d16240', NULL, '/uploads/user.svg', 'member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `catagories`
--
ALTER TABLE `catagories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderedProducts`
--
ALTER TABLE `orderedProducts`
  ADD KEY `orderid` (`orderid`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`turn_id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `orderSession`
--
ALTER TABLE `orderSession`
  ADD KEY `orderid` (`orderid`);

--
-- Indexes for table `productImages`
--
ALTER TABLE `productImages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catagory` (`catagory`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`email`,`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `catagories`
--
ALTER TABLE `catagories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `productImages`
--
ALTER TABLE `productImages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `orderedProducts`
--
ALTER TABLE `orderedProducts`
  ADD CONSTRAINT `orderedproducts_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `orders` (`turn_id`),
  ADD CONSTRAINT `orderedproducts_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `orderSession`
--
ALTER TABLE `orderSession`
  ADD CONSTRAINT `ordersession_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `orders` (`turn_id`);

--
-- Constraints for table `productImages`
--
ALTER TABLE `productImages`
  ADD CONSTRAINT `productimages_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`catagory`) REFERENCES `catagories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
