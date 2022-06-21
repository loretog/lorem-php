-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2022 at 12:54 AM
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
(2, 1, 'asd fasdfa s', 'fasfa sdf asdf asdf asdfas df', '2022-06-21 00:15:14', '2022-06-21 00:15:14'),
(3, 1, 'as sdfa sdfas dfasd f', 'asd fasdf asdf asdf', '2022-06-21 00:18:21', '2022-06-21 00:18:21'),
(4, 1, 'ICT 101', 'asd fasdfa sdfas df', '2022-06-21 00:18:26', '2022-06-21 00:18:26'),
(5, 1, 'ICT 110', 'asdf sdfs df', '2022-06-21 11:36:16', '2022-06-21 11:36:16'),
(6, 1, 'English 191', 'asd asd asd', '2022-06-21 11:36:52', '2022-06-21 11:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `activityfiles`
--

CREATE TABLE `activityfiles` (
  `activityfilesid` int(11) NOT NULL,
  `activityid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `fileurl` text NOT NULL,
  `filedir` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activityfiles`
--

INSERT INTO `activityfiles` (`activityfilesid`, `activityid`, `title`, `fileurl`, `filedir`, `created`, `updated`) VALUES
(51, 6, 'as dasd asd', '/activityfiles/6/51/87055255_10160195140966840_4086214254573649920_o.jpg', 'activityfiles\\6\\87055255_10160195140966840_4086214254573649920_o.jpg', '2022-06-21 14:03:33', '2022-06-21 14:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `todolist`
--

CREATE TABLE `todolist` (
  `todoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `todolist`
--

INSERT INTO `todolist` (`todoid`, `userid`, `title`, `description`, `status`, `created`, `updated`) VALUES
(6, 1, 'xxx asd asd asda sdasd', '123', 1, '2022-06-20 14:48:04', '2022-06-20 14:48:04'),
(8, 1, 'test', 'test', 1, '2022-06-20 22:25:06', '2022-06-20 22:25:06'),
(9, 1, 'test', 'test', 1, '2022-06-20 22:25:11', '2022-06-20 22:25:11'),
(11, 1, 'jknkjn', 'kjbjkhbkh b', 0, '2022-06-21 00:02:18', '2022-06-21 00:02:18'),
(12, 2, 'submit activity 1', 'activity from sir Lopez', 1, '2022-06-21 22:30:29', '2022-06-21 22:30:29');

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
(2, 1, 'sdfsd fgsfd gsdfg sdfg sdfg', '<p>sfd<strong>g dfg sdfgs dfgs dfgsfg dsfa sdfa sdfasd fas</strong>dfas dfasd fasd</p><blockquote><p>f asdfa sdf asdfa sdfa sdf</p></blockquote><p>a sdfa sdfa s</p><p>df asdfa sdf asdf asdf</p>', '2022-06-20 23:02:58', '2022-06-20 23:02:58'),
(3, 1, 'tetwasdfa sdfa sdfa sdf xxxxxxxxxxxxxxxxxxxxxxxxx', '<p>d asdfa sd</p><p>fa sdfasdfas dfa sdfa sdf</p><ul><li>as dfas dfasdf</li><li>asdfas dfasd</li><li>asdfasdf</li></ul><p>sdfasdf asdf sdfsdfa</p>', '2022-06-20 23:04:31', '2022-06-20 23:04:31'),
(4, 1, 'ICT 111', '<p>sd asd asd asd fds dfa sdf asdf</p><p>a sdfa sdfa sdfa sdfa&nbsp;</p><p>asdf asdf asdf</p>', '2022-06-20 23:25:47', '2022-06-20 23:25:47');

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
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `email`, `username`, `password`, `usertype`, `created`, `updated`) VALUES
(1, 'test@gmail.com', 'johndoe', '5f4dcc3b5aa765d61d8327deb882cf99', '', '2022-06-20 13:20:29', '2022-06-20 13:20:29'),
(2, 'test2@gmail.com', 'wanda', '5f4dcc3b5aa765d61d8327deb882cf99', '', '2022-06-21 22:25:52', '2022-06-21 22:25:52');

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
  MODIFY `activityid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `activityfiles`
--
ALTER TABLE `activityfiles`
  MODIFY `activityfilesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `todolist`
--
ALTER TABLE `todolist`
  MODIFY `todoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topicid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
