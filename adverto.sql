-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2022 at 09:05 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adverto`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `firstname` varchar(15) NOT NULL,
  `lastname` varchar(15) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'assets/images/avatars/avatar.png',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `firstname`, `lastname`, `avatar`, `password`) VALUES
(1, 'adverto', 'admin@adverto.com', 'Shuaibu', 'Yahaya', 'assets/images/avatars/avatar.png', '$2y$10$aDU9Ol81BK54vpT.2iVFwurHJ1H6FuEeWD/gTzbi/tEyS6FQMeVFO');

-- --------------------------------------------------------

--
-- Table structure for table `advert`
--

CREATE TABLE `advert` (
  `id` int(10) NOT NULL,
  `ad_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `banner` text NOT NULL,
  `advert_price` int(11) NOT NULL,
  `clicks` int(10) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'In Review',
  `owner` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advert`
--

INSERT INTO `advert` (`id`, `ad_id`, `product_id`, `banner`, `advert_price`, `clicks`, `status`, `owner`) VALUES
(1, 'cbfe5681369338a48e2d1b63998099d6', 'e165421110ba03099a1c0393373c5b43', 'cbfe5681369338a48e2d1b63998099d6.png', 1000, 7, 'Accepted', 'adamufura98@gmail.com'),
(2, 'b3f445b0ff5a783ec652cdf8e669a9bf', 'd61e4bbd6393c9111e6526ea173a7c8b', 'b3f445b0ff5a783ec652cdf8e669a9bf.jpg', 500, 7, 'In Review', 'anka@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` varchar(50) NOT NULL DEFAULT '1',
  `buyer_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `quantity`, `buyer_id`) VALUES
(4, 'e165421110ba03099a1c0393373c5b43', '1', 'adamufura98@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'Food'),
(2, 'Beverage'),
(3, 'Cement'),
(4, 'Drinks'),
(5, 'Decorations'),
(6, 'Tech');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `seller_id` varchar(50) NOT NULL,
  `buyer_id` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `quantity` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `seller_id`, `buyer_id`, `status`, `quantity`, `amount`, `datetime`) VALUES
(1, 'd61e4bbd6393c9111e6526ea173a7c8b', 'anka@gmail.com', 'adamufura98@gmail.com', 'Delivered', '5', '25000', '2022-01-01 01:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `product_price` int(10) NOT NULL,
  `category_id` varchar(20) NOT NULL,
  `owner` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_id`, `title`, `description`, `product_price`, `category_id`, `owner`) VALUES
(1, 'e165421110ba03099a1c0393373c5b43', 'HP Laptop', 'HP Laptop Core i7 <br> 6GB Ram <br> 500GB HDD', 80000, '6', 'adamufura98@gmail.com'),
(2, 'bea5955b308361a1b07bc55042e25e54', 'Rice', 'Rice and Beans', 400, '1', 'adamufura98@gmail.com'),
(3, 'd34ab169b70c9dcd35e62896010cd9ff', 'Pop Cola', 'Pop Cola Drink', 200, '4', 'anka@gmail.com'),
(4, 'd61e4bbd6393c9111e6526ea173a7c8b', 'Pizza', 'Pizza Combination', 5000, '1', 'anka@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `firstname` varchar(15) NOT NULL,
  `lastname` varchar(15) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'assets/images/avatars/avatar.png',
  `delivery_address` varchar(255) NOT NULL DEFAULT 'Customer did not provide address',
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `phone`, `avatar`, `delivery_address`, `password`) VALUES
(1, 'adamufura98@gmail.com', 'Adamu', 'Suleiman', '08166644083', 'assets/images/avatars/adamufura98@gmail.com.jpg', 'Sardauna Estate, Katsina  State', '$2y$10$O2n7e5hAY3/Jw.Tzu/5yD.zbxpBuKm3RmTfREGb5j5rCzebMOWbJu'),
(2, 'anka@gmail.com', 'Yahya', 'Anka', '', 'assets/images/avatars/avatar.png', 'Customer did not provide address', '$2y$10$IclV99HXdWcyxYbXmCn1eePu6zvWRpQHzasVQu8/Ws30ozNEzBJki');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advert`
--
ALTER TABLE `advert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advert`
--
ALTER TABLE `advert`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
