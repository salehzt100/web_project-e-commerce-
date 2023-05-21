-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 21 مايو 2023 الساعة 13:57
-- إصدار الخادم: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zetawiStore`
--

-- --------------------------------------------------------

--
-- بنية الجدول `Cart`
--

CREATE TABLE `Cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `Order_Details`
--

CREATE TABLE `Order_Details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `Order_Details`
--

INSERT INTO `Order_Details` (`id`, `user_id`, `order_date`, `total_amount`, `order_status`) VALUES
(1, 1, '2023-05-09 12:00:00', '19.99', 'shipped'),
(2, 2, '2023-05-08 15:30:00', '59.98', 'processing');

-- --------------------------------------------------------

--
-- بنية الجدول `Order_Items`
--

CREATE TABLE `Order_Items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `Order_Items`
--

INSERT INTO `Order_Items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, '19.99'),
(2, 2, 1, 2, '39.98'),
(3, 2, 2, 1, '29.99');

-- --------------------------------------------------------

--
-- بنية الجدول `Payment_Details`
--

CREATE TABLE `Payment_Details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `card_expiry` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `Payment_Details`
--

INSERT INTO `Payment_Details` (`id`, `order_id`, `card_number`, `card_expiry`) VALUES
(1, 1, '1234567812345678', '05/25'),
(2, 2, '8765432187654321', '09/24');

-- --------------------------------------------------------

--
-- بنية الجدول `Product`
--

CREATE TABLE `Product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `upload_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `Product`
--

INSERT INTO `Product` (`id`, `name`, `description`, `price`, `image_url`, `upload_date`) VALUES
(1, 'Product 1', 'Description for Product 1', '19.99', 'img1.jpg', '0000-00-00'),
(2, 'Product 2', 'Description for Product 2', '29.99', 'img2.jpg', '0000-00-00'),
(7, 'Product D', 'Description for Product D', '12.99', '14.jpg', '2023-05-11'),
(33, 'dfgh', 'dfghnm,', '6.00', '20230516110527-ayman.jpg', '2023-05-16');

-- --------------------------------------------------------

--
-- بنية الجدول `Product_Category`
--

CREATE TABLE `Product_Category` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `Product_Category`
--

INSERT INTO `Product_Category` (`id`, `product_id`, `category_name`) VALUES
(1, 1, 'Category 1'),
(2, 2, 'Category 2');

-- --------------------------------------------------------

--
-- بنية الجدول `Product_Inventory`
--

CREATE TABLE `Product_Inventory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `Product_Inventory`
--

INSERT INTO `Product_Inventory` (`id`, `product_id`, `quantity`) VALUES
(1, 1, 100),
(2, 2, 50);

-- --------------------------------------------------------

--
-- بنية الجدول `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isadmin` tinyint(1) DEFAULT 0,
  `user_imag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `User`
--

INSERT INTO `User` (`id`, `username`, `email`, `password`, `isadmin`, `user_imag`) VALUES
(1, 'saleh dkjd', 'saleh@gmail.com', 'Ss123456@', 1, 'saleh.jpg'),
(2, 'ayman ', 'ayman@gmail.com', 'Ss123456@', 0, 'ayman.jpg'),
(17, 'sara', 'sara@gmail.com', 'Ss123456@', 0, 'user.png'),
(18, 'sladfja', 'dfjkadsfadf@gmsf.kfgj', '$2y$10$3DbrJsDM3WNuZ/svMUk0Ze8C6DAs4ldImtJUs8Oq9Jp75naaj2dcS', 0, 'user.png'),
(19, 'saleh', 'salehz@gmail.com', '$2y$10$n4FHlLGjIGC4JMHWf/JTmeaI8KWCxUQAIVOy.PmrsWogGFU7luRim', 1, 'user.png');

-- --------------------------------------------------------

--
-- بنية الجدول `User_Address`
--

CREATE TABLE `User_Address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `User_Address`
--

INSERT INTO `User_Address` (`id`, `user_id`, `street_address`, `city`, `state`, `zip_code`, `phone`) VALUES
(1, 1, '123 Main St', 'tulkarm ', 'CA', '12345', 569522815),
(2, 2, '456 Oak Ave', 'nablus', 'NY', '56789', 569533876),
(3, 19, '123 Main St', 'Anytown', 'CA', '12345', 569522815),
(4, 19, '123 Main St', 'TULKARM', 'CA', '12345', 569522815),
(5, 18, '123 Main St', 'NABLUS', 'CA', '12345', 569522995);

-- --------------------------------------------------------

--
-- بنية الجدول `User_Payment`
--

CREATE TABLE `User_Payment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `card_expiry` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `User_Payment`
--

INSERT INTO `User_Payment` (`id`, `user_id`, `card_number`, `card_expiry`) VALUES
(1, 1, '1234567812345678', '05/25'),
(2, 2, '8765432187654321', '09/24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cart`
--
ALTER TABLE `Cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `Order_Details`
--
ALTER TABLE `Order_Details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Order_Items`
--
ALTER TABLE `Order_Items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `Payment_Details`
--
ALTER TABLE `Payment_Details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Product_Category`
--
ALTER TABLE `Product_Category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `Product_Inventory`
--
ALTER TABLE `Product_Inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `User_Address`
--
ALTER TABLE `User_Address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `User_Payment`
--
ALTER TABLE `User_Payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cart`
--
ALTER TABLE `Cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Order_Details`
--
ALTER TABLE `Order_Details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Order_Items`
--
ALTER TABLE `Order_Items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Payment_Details`
--
ALTER TABLE `Payment_Details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `Product_Category`
--
ALTER TABLE `Product_Category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Product_Inventory`
--
ALTER TABLE `Product_Inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `User_Address`
--
ALTER TABLE `User_Address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `User_Payment`
--
ALTER TABLE `User_Payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `Cart`
--
ALTER TABLE `Cart`
  ADD CONSTRAINT `Cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `Cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`);

--
-- القيود للجدول `Order_Details`
--
ALTER TABLE `Order_Details`
  ADD CONSTRAINT `Order_Details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

--
-- القيود للجدول `Order_Items`
--
ALTER TABLE `Order_Items`
  ADD CONSTRAINT `Order_Items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `Order_Details` (`id`),
  ADD CONSTRAINT `Order_Items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`);

--
-- القيود للجدول `Payment_Details`
--
ALTER TABLE `Payment_Details`
  ADD CONSTRAINT `Payment_Details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `Order_Details` (`id`);

--
-- القيود للجدول `Product_Category`
--
ALTER TABLE `Product_Category`
  ADD CONSTRAINT `Product_Category_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`);

--
-- القيود للجدول `Product_Inventory`
--
ALTER TABLE `Product_Inventory`
  ADD CONSTRAINT `Product_Inventory_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`);

--
-- القيود للجدول `User_Address`
--
ALTER TABLE `User_Address`
  ADD CONSTRAINT `User_Address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

--
-- القيود للجدول `User_Payment`
--
ALTER TABLE `User_Payment`
  ADD CONSTRAINT `User_Payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
