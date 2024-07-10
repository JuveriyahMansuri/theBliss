-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2022 at 09:53 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `the_bliss`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `pincode` int(11) NOT NULL,
  `area_name` varchar(45) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`pincode`, `area_name`, `city_id`) VALUES
(382457, 'Navrangpura', 1),
(382475, 'Sardarnagar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(45) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `state_id`) VALUES
(1, 'Ahmedabad', 1),
(2, 'Surat', 1),
(3, 'Jaipur', 2),
(4, 'Bhopal', 4),
(5, 'Mumbai', 3);

-- --------------------------------------------------------

--
-- Table structure for table `customized_order`
--

CREATE TABLE `customized_order` (
  `customized_id` int(11) NOT NULL,
  `customized_details` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(45) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `approval` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_booking`
--

CREATE TABLE `event_booking` (
  `event_booking_id` int(11) NOT NULL,
  `event_booking_Date` date NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `event_type_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `event_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_booking_detail`
--

CREATE TABLE `event_booking_detail` (
  `event_booking_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(45) DEFAULT NULL,
  `price` float NOT NULL,
  `approval` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

CREATE TABLE `event_type` (
  `event_type_id` int(11) NOT NULL,
  `event_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback` varchar(45) DEFAULT NULL,
  `feedback_date` datetime NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_image`
--

CREATE TABLE `feedback_image` (
  `feedback_image_id` int(11) NOT NULL,
  `feedback_image` varchar(45) DEFAULT NULL,
  `feedback_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `security_question` varchar(45) NOT NULL,
  `security_answer` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `membership_id` int(11) NOT NULL,
  `membership_type` varchar(45) NOT NULL,
  `membership_rate` int(11) NOT NULL,
  `membership_duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`membership_id`, `membership_type`, `membership_rate`, `membership_duration`) VALUES
(1, '3-months', 399, 90),
(2, '6-months', 699, 180),
(3, '12-months', 999, 365);

-- --------------------------------------------------------

--
-- Table structure for table `offer/discount`
--

CREATE TABLE `offer/discount` (
  `offer/discount_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `delivery_address` multilinestring DEFAULT NULL,
  `delivery_status` varchar(45) NOT NULL,
  `payment_mode` varchar(45) NOT NULL,
  `order_status` varchar(45) NOT NULL,
  `cancellation_date` datetime DEFAULT NULL,
  `total_amount` float NOT NULL,
  `customer_id` int(11) NOT NULL,
  `area_pincode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_replace`
--

CREATE TABLE `order_replace` (
  `order_replace_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_replace_detail`
--

CREATE TABLE `order_replace_detail` (
  `order_replace_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `reason` varchar(45) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_mode` varchar(45) NOT NULL,
  `amount` float NOT NULL,
  `payment_date` datetime NOT NULL,
  `event_booking_id` int(11) NOT NULL,
  `Payment_reference_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` multilinestring NOT NULL,
  `price` float NOT NULL,
  `unit_of_measurement` varchar(45) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `quantity_in_hand` int(11) DEFAULT NULL,
  `product_category_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `offer/discount_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_category_id` int(11) NOT NULL,
  `category_name` varchar(45) NOT NULL,
  `sub_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `image_id` int(11) NOT NULL,
  `image` varchar(45) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `request_delivery`
--

CREATE TABLE `request_delivery` (
  `request_delivery_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `delivery_person_id` int(11) NOT NULL,
  `is_accept` tinyint(1) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `pickup_area_pincode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`) VALUES
(1, 'Gujarat'),
(2, 'Rajasthan'),
(3, 'Maharashtra'),
(4, 'Madhya Pradesh');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `user_id_proof` varchar(45) DEFAULT NULL,
  `email_address` varchar(45) DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  `display_picture` varchar(45) DEFAULT NULL,
  `address` multilinestring NOT NULL,
  `vendor_category_id` int(11) DEFAULT NULL,
  `user_type_id` int(11) NOT NULL,
  `area_pincode` int(11) NOT NULL,
  `membership_id` int(11) DEFAULT NULL,
  `membership_start_date` datetime DEFAULT NULL,
  `skill_certificate` varchar(45) DEFAULT NULL,
  `commission(for_Delivery_person)` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type`) VALUES
(1, 'customer'),
(2, 'vendor'),
(3, 'Delivery Person');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_advertisement`
--

CREATE TABLE `vendor_advertisement` (
  `v_ad_id` int(11) NOT NULL,
  `v_ad_name` varchar(45) NOT NULL,
  `images/videos` varchar(45) DEFAULT NULL,
  `images/videos_description` varchar(45) DEFAULT NULL,
  `vendor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_category`
--

CREATE TABLE `vendor_category` (
  `vendor_category_id` int(11) NOT NULL,
  `category_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`pincode`),
  ADD KEY `fk_area_city1_idx` (`city_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `fk_cart_product1_idx` (`product_id`),
  ADD KEY `fk_cart_user1_idx` (`user_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `fk_city_state1_idx` (`state_id`);

--
-- Indexes for table `customized_order`
--
ALTER TABLE `customized_order`
  ADD PRIMARY KEY (`customized_id`),
  ADD KEY `fk_customized_order_product1_idx` (`product_id`),
  ADD KEY `fk_customized_order_user1_idx` (`customer_id`);

--
-- Indexes for table `event_booking`
--
ALTER TABLE `event_booking`
  ADD PRIMARY KEY (`event_booking_id`),
  ADD KEY `fk_event_booking_event_type1_idx` (`event_type_id`),
  ADD KEY `fk_event_booking_user1_idx` (`customer_id`);

--
-- Indexes for table `event_booking_detail`
--
ALTER TABLE `event_booking_detail`
  ADD PRIMARY KEY (`event_booking_id`,`product_id`),
  ADD KEY `fk_event_booking_has_product_product1_idx` (`product_id`),
  ADD KEY `fk_event_booking_has_product_event_booking1_idx` (`event_booking_id`);

--
-- Indexes for table `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`event_type_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `fk_feedback_product1_idx` (`product_id`),
  ADD KEY `fk_feedback_user1_idx` (`customer_id`);

--
-- Indexes for table `feedback_image`
--
ALTER TABLE `feedback_image`
  ADD PRIMARY KEY (`feedback_image_id`),
  ADD KEY `fk_feedback_image_feedback1_idx` (`feedback_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `fk_login_user1_idx` (`user_id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`membership_id`);

--
-- Indexes for table `offer/discount`
--
ALTER TABLE `offer/discount`
  ADD PRIMARY KEY (`offer/discount_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_order_user1_idx` (`customer_id`),
  ADD KEY `fk_order_area1_idx` (`area_pincode`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `fk_order_has_product_product1_idx` (`product_id`),
  ADD KEY `fk_order_has_product_order1_idx` (`order_id`);

--
-- Indexes for table `order_replace`
--
ALTER TABLE `order_replace`
  ADD PRIMARY KEY (`order_replace_id`),
  ADD KEY `fk_Order_Replace_Order1_idx` (`order_id`);

--
-- Indexes for table `order_replace_detail`
--
ALTER TABLE `order_replace_detail`
  ADD KEY `fk_order_replace_details_order_replace1_idx` (`order_replace_id`),
  ADD KEY `fk_order_replace_details_product1_idx` (`product_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_payment_event_booking1_idx` (`event_booking_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_product_product_category1_idx` (`product_category_id`),
  ADD KEY `fk_product_user1_idx` (`vendor_id`),
  ADD KEY `fk_product_offer/discount1_idx` (`offer/discount_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_category_id`),
  ADD KEY `fk_product_category_product_category1_idx` (`sub_category_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `fk_product_image_product1_idx` (`product_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `fk_rating_product1_idx` (`product_id`),
  ADD KEY `fk_rating_user1_idx` (`user_id`);

--
-- Indexes for table `request_delivery`
--
ALTER TABLE `request_delivery`
  ADD PRIMARY KEY (`request_delivery_id`),
  ADD KEY `fk_request_delivery_user1_idx` (`vendor_id`),
  ADD KEY `fk_request_delivery_user2_idx` (`delivery_person_id`),
  ADD KEY `fk_request_delivery_order1_idx` (`order_id`),
  ADD KEY `fk_request_delivery_area1_idx` (`pickup_area_pincode`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`,`user_type_id`),
  ADD KEY `fk_user_vendor_category1_idx` (`vendor_category_id`),
  ADD KEY `fk_user_user_type1_idx` (`user_type_id`),
  ADD KEY `fk_user_area1_idx` (`area_pincode`),
  ADD KEY `fk_user_membership1_idx` (`membership_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- Indexes for table `vendor_advertisement`
--
ALTER TABLE `vendor_advertisement`
  ADD PRIMARY KEY (`v_ad_id`),
  ADD KEY `fk_vendor_advertisement_user1_idx` (`vendor_id`);

--
-- Indexes for table `vendor_category`
--
ALTER TABLE `vendor_category`
  ADD PRIMARY KEY (`vendor_category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `pincode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=382476;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customized_order`
--
ALTER TABLE `customized_order`
  MODIFY `customized_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_booking`
--
ALTER TABLE `event_booking`
  MODIFY `event_booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_booking_detail`
--
ALTER TABLE `event_booking_detail`
  MODIFY `event_booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_type`
--
ALTER TABLE `event_type`
  MODIFY `event_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback_image`
--
ALTER TABLE `feedback_image`
  MODIFY `feedback_image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `offer/discount`
--
ALTER TABLE `offer/discount`
  MODIFY `offer/discount_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_replace`
--
ALTER TABLE `order_replace`
  MODIFY `order_replace_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_replace_detail`
--
ALTER TABLE `order_replace_detail`
  MODIFY `order_replace_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_delivery`
--
ALTER TABLE `request_delivery`
  MODIFY `request_delivery_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor_advertisement`
--
ALTER TABLE `vendor_advertisement`
  MODIFY `v_ad_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_category`
--
ALTER TABLE `vendor_category`
  MODIFY `vendor_category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `fk_area_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `fk_city_state1` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customized_order`
--
ALTER TABLE `customized_order`
  ADD CONSTRAINT `fk_customized_order_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_customized_order_user1` FOREIGN KEY (`customer_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_booking`
--
ALTER TABLE `event_booking`
  ADD CONSTRAINT `fk_event_booking_event_type1` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`event_type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_event_booking_user1` FOREIGN KEY (`customer_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_booking_detail`
--
ALTER TABLE `event_booking_detail`
  ADD CONSTRAINT `fk_event_booking_has_product_event_booking1` FOREIGN KEY (`event_booking_id`) REFERENCES `event_booking` (`event_booking_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_event_booking_has_product_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_feedback_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_feedback_user1` FOREIGN KEY (`customer_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback_image`
--
ALTER TABLE `feedback_image`
  ADD CONSTRAINT `fk_feedback_image_feedback1` FOREIGN KEY (`feedback_id`) REFERENCES `feedback` (`feedback_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `fk_login_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_area1` FOREIGN KEY (`area_pincode`) REFERENCES `area` (`pincode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_user1` FOREIGN KEY (`customer_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `fk_order_has_product_order1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_has_product_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_replace`
--
ALTER TABLE `order_replace`
  ADD CONSTRAINT `fk_Order_Replace_Order1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_replace_detail`
--
ALTER TABLE `order_replace_detail`
  ADD CONSTRAINT `fk_order_replace_details_order_replace1` FOREIGN KEY (`order_replace_id`) REFERENCES `order_replace` (`order_replace_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_replace_details_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_event_booking1` FOREIGN KEY (`event_booking_id`) REFERENCES `event_booking` (`event_booking_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_offer/discount1` FOREIGN KEY (`offer/discount_id`) REFERENCES `offer/discount` (`offer/discount_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_product_category1` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`product_category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_user1` FOREIGN KEY (`vendor_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `fk_product_category_product_category1` FOREIGN KEY (`sub_category_id`) REFERENCES `product_category` (`product_category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `fk_product_image_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_rating_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rating_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_delivery`
--
ALTER TABLE `request_delivery`
  ADD CONSTRAINT `fk_request_delivery_area1` FOREIGN KEY (`pickup_area_pincode`) REFERENCES `area` (`pincode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_request_delivery_order1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_request_delivery_user1` FOREIGN KEY (`vendor_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_request_delivery_user2` FOREIGN KEY (`delivery_person_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_area1` FOREIGN KEY (`area_pincode`) REFERENCES `area` (`pincode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_membership1` FOREIGN KEY (`membership_id`) REFERENCES `membership` (`membership_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_user_type1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`user_type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_vendor_category1` FOREIGN KEY (`vendor_category_id`) REFERENCES `vendor_category` (`vendor_category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_advertisement`
--
ALTER TABLE `vendor_advertisement`
  ADD CONSTRAINT `fk_vendor_advertisement_user1` FOREIGN KEY (`vendor_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
