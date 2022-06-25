-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2022 at 02:45 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online-todo-list`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activityid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activityid`, `userid`, `title`, `content`, `created`, `updated`) VALUES
(9, 4, 'Activity 1', 'create a program using C++', '2022-06-25 11:50:42', '2022-06-25 11:50:42'),
(10, 4, 'Activity 2', 'Create a program using C++ that will return the sum of two numbers', '2022-06-25 11:51:18', '2022-06-25 11:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `activityfiles`
--

CREATE TABLE `activityfiles` (
  `activityfilesid` int(11) NOT NULL,
  `activityid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `fileurl` text NOT NULL,
  `filedir` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activityfiles`
--

INSERT INTO `activityfiles` (`activityfilesid`, `activityid`, `studentid`, `title`, `fileurl`, `filedir`, `created`, `updated`) VALUES
(60, 10, 6, 'asdasd', '/activityfiles/10/60/hnnnnng.jpg', 'activityfiles\\10\\hnnnnng.jpg', '2022-06-25 11:51:49', '2022-06-25 11:51:49');

-- --------------------------------------------------------

--
-- Table structure for table `todolist`
--

CREATE TABLE `todolist` (
  `todoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `todolist`
--

INSERT INTO `todolist` (`todoid`, `userid`, `title`, `description`, `created`, `updated`) VALUES
(15, 4, 'asda', 'sdasdasd', '2022-06-25 10:04:30', '2022-06-25 10:04:30'),
(16, 4, 'xxx', 'xxx', '2022-06-25 10:14:32', '2022-06-25 10:14:32'),
(17, 4, 'asda', 'asd', '2022-06-25 10:17:08', '2022-06-25 10:17:08'),
(18, 8, 'asdas xxxxxxx', 'dasdasd', '2022-06-25 10:18:08', '2022-06-25 10:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `todolist_status`
--

CREATE TABLE `todolist_status` (
  `todoliststatusid` int(11) NOT NULL,
  `todoid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `todostatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `todolist_status`
--

INSERT INTO `todolist_status` (`todoliststatusid`, `todoid`, `studentid`, `todostatus`) VALUES
(1, 18, 1, 1),
(2, 16, 1, 0),
(3, 18, 6, 1),
(4, 17, 6, 1),
(5, 15, 6, 1),
(6, 16, 6, 1),
(7, 17, 1, 0),
(8, 15, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topicid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topicid`, `userid`, `title`, `content`, `created`, `updated`) VALUES
(8, 4, 'asdas', '<p>da sdas das dasd</p>', '2022-06-25 11:02:27', '2022-06-25 11:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(30) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `email`, `username`, `password`, `usertype`, `firstname`, `lastname`, `status`, `created`, `updated`) VALUES
(1, 'test@gmail.com', 'johndoe', '1a1dc91c907325c69271ddf0c944bc72', 'student', 'John xxx', 'Doe', 1, '2022-06-20 13:20:29', '2022-06-20 13:20:29'),
(4, 'admin@gmail.com', 'Corona', '5f4dcc3b5aa765d61d8327deb882cf99', 'professor', 'John', 'Corona', 1, '2022-06-23 19:01:50', '2022-06-23 19:01:50'),
(6, 'test5@gmail.com', 'test5', '5f4dcc3b5aa765d61d8327deb882cf99', 'student', 'test', 'five', 1, '2022-06-25 07:24:28', '2022-06-25 07:24:28'),
(8, 'marty@gmail.com', 'Marty', '5f4dcc3b5aa765d61d8327deb882cf99', 'professor', 'Marty', 'M.', 1, '2022-06-25 09:33:52', '2022-06-25 09:33:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activityid`);

--
-- Indexes for table `activityfiles`
--
ALTER TABLE `activityfiles`
  ADD PRIMARY KEY (`activityfilesid`);

--
-- Indexes for table `todolist`
--
ALTER TABLE `todolist`
  ADD PRIMARY KEY (`todoid`);

--
-- Indexes for table `todolist_status`
--
ALTER TABLE `todolist_status`
  ADD PRIMARY KEY (`todoliststatusid`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topicid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activityid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `activityfiles`
--
ALTER TABLE `activityfiles`
  MODIFY `activityfilesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `todolist`
--
ALTER TABLE `todolist`
  MODIFY `todoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `todolist_status`
--
ALTER TABLE `todolist_status`
  MODIFY `todoliststatusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topicid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
