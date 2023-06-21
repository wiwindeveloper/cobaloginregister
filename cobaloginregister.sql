-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2023 at 10:33 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cobaloginregister`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `title`, `content`, `user_id`, `status`, `date`) VALUES
(45, 'test', '<p>sdasdsa</p>\r\n', '19', 0, '2023-06-21'),
(46, 'dsdasd', '<p>dasdas</p>\r\n', '20', 0, '2023-06-21'),
(47, 'sdadasd', '<p>dsadasd</p>\r\n', '21', 0, '2023-06-21'),
(48, 'test', '<p>dasdasd</p>\r\n', '19', 0, '2023-06-21'),
(49, 'sdadsa', '<p>sdadsa</p>\r\n', '19', 0, '2023-06-21'),
(50, 'dsadsadsa', '<p>dsdasdasss</p>\r\n', '19', 0, '2023-06-21'),
(51, 'sdfsdfsd', '<p>dfsdfds</p>\r\n', '19', 0, '2023-06-21'),
(52, 'dsadas', '<p>dsadasdsa</p>\r\n', '19', 0, '2023-06-21'),
(53, 'test', '<p>sdasdsa</p>\r\n', '19', 0, '2023-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `datecreate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `datecreate`) VALUES
(18, 'Wiwin', 'Savitri', 'n.wiwinsavitri@gmail.com', '$2y$10$ZtGg0uD0BmAgBe0kiIm/h.xBiPo3hHTsoxkhjD.foM4QqZsxnmKwG', 1687329437),
(19, 'Oklan', 'Pramana', 'oklan@example.com', '$2y$10$WiIX/vNJ1m0kzNLqwO84xO0EjF5NI9PqhRKLQUez6ZDA/t98ILKBS', 1687329949),
(20, 'Indra', 'Laksemana', 'indra@example.com', '$2y$10$a/45/pgNQudr31SC1sMu5eUU.c9ca3/8ftq.4eAE48jYNpS/dGtlC', 1687330031),
(21, 'Bombom', 'Brown', 'bombom@example.com', '$2y$10$W2pUs55CuOeFEzP6Zd1CJea4/cOm/FKu0rW5ki8G38wZ72Rx1Frnq', 1687330073),
(22, 'Vita', 'Minasih', 'vita@example.com', '$2y$10$VmbBTVV9SAva7jjyoqrNA.7Eq9ywxJ3rtYLxd4ruyWz9dUd7PuULu', 1687333374),
(23, 'Cipi', 'Setia', 'cipi@example.com', '$2y$10$HDgl.Bv2WU4qgxMKaTI9D.o4ewY5zDh8OCCdLi8Zu1IQqksk7yQ2O', 1687333407);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_create` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_create`) VALUES
(111, 'wiwin@gmail.com', 'b9y0vg7kLbDv/F0NGdGjtv63dnu+OepXlZyLv66Kbrs=', 1671075295),
(112, 'wiwin@gmail.com', '/WwL8H3FUMjKPsXPFEMG9pSzZVHcUCBkom1hymv0jyQ=', 1671075822),
(113, 'wiwin@gmail.com', '0hnlZWAIZWF9x1R4K2xRefpXl9tvcDO8gjGQkCK711E=', 1671075838),
(114, 'wiwin@gmail.com', 'qobLq01QmwAEfyz8ENA+3IsJFTIjQO0XRt21Scyv4h8=', 1671075942),
(115, 'wiwin@gmail.com', '/Kp6yVO+YhzUvDg8e31HH78cdeFu/IAuGGc5AVBo+Zs=', 1671076015);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
