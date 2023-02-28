-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2023 at 11:47 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `makalaty`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instgram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `andriod` varchar(255) DEFAULT NULL,
  `ios` varchar(255) DEFAULT NULL,
  `about_en` text DEFAULT NULL,
  `about_ar` text DEFAULT NULL,
  `about_footer_en` varchar(255) DEFAULT NULL,
  `about_footer_ar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `facebook`, `twitter`, `instgram`, `youtube`, `andriod`, `ios`, `about_en`, `about_ar`, `about_footer_en`, `about_footer_ar`) VALUES
(1, 'f', 'twittertwittertwitter', 'instgraminstgraminstgram', 'youtubeyoutube', 'andriodandriodandriod', 'iosios', 'about_enabout_en', 'about_footer_arabout_footer_arabout_footer_ar', 'about_footer_arabout_footer_ar', 'about_footer_arabout_footer_arabout_footer_ar');

-- --------------------------------------------------------

--
-- Table structure for table `advertises`
--

CREATE TABLE `advertises` (
  `id` int(11) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` enum('Vertical','Horizontal') NOT NULL DEFAULT 'Vertical',
  `page_num` int(11) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advertises`
--

INSERT INTO `advertises` (`id`, `link`, `photo`, `type`, `page_num`, `created`, `modified`) VALUES
(2, '.comlink', 'library/advertises/makalaty_articles_701676534777.png', 'Vertical', 1, '2023-02-16 08:06:17', '2023-02-16 08:06:17'),
(3, '.comlink', 'library/advertises/makalaty_articles_441676534778.png', 'Vertical', 1, '2023-02-16 08:06:18', '2023-02-16 08:06:18'),
(4, '.comlink', 'library/advertises/makalaty_articles_541676534782.png', 'Horizontal', 1, '2023-02-16 08:06:22', '2023-02-16 08:06:22'),
(5, '.comlink', 'library/advertises/makalaty_articles_291676534845.png', 'Horizontal', 1, '2023-02-16 08:07:25', '2023-02-16 08:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `address_en` varchar(255) DEFAULT NULL,
  `address_ar` varchar(255) DEFAULT NULL,
  `short_desc_en` varchar(255) DEFAULT NULL,
  `short_desc_ar` varchar(255) DEFAULT NULL,
  `content_en` longtext DEFAULT NULL,
  `content_ar` longtext DEFAULT NULL,
  `type` enum('article','video') DEFAULT 'article',
  `youtube_link` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `viewers_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `category_id`, `address_en`, `address_ar`, `short_desc_en`, `short_desc_ar`, `content_en`, `content_ar`, `type`, `youtube_link`, `photo`, `created`, `modified`, `viewers_count`) VALUES
(2, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, '180865718_1119189771893403_7017924847130814952_n.jpg', '2023-02-15 08:17:41', '2023-02-26 08:53:33', 6),
(3, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:37:59', '2023-02-15 08:37:59', 0),
(4, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:38:34', '2023-02-15 08:38:34', 0),
(5, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:40:16', '2023-02-15 08:40:16', 0),
(6, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:40:28', '2023-02-15 08:40:28', 0),
(7, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:49:40', '2023-02-15 08:49:40', 0),
(8, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:49:49', '2023-02-15 08:49:49', 0),
(9, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:50:08', '2023-02-15 08:50:08', 0),
(10, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:50:16', '2023-02-15 08:50:16', 0),
(11, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:50:49', '2023-02-15 08:50:49', 0),
(12, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:50:54', '2023-02-15 08:50:54', 0),
(13, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:51:00', '2023-02-15 08:51:00', 0),
(14, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:51:10', '2023-02-15 08:51:10', 0),
(15, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:51:25', '2023-02-15 08:51:25', 0),
(16, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:51:35', '2023-02-15 08:51:35', 0),
(17, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:51:54', '2023-02-15 08:51:54', 0),
(18, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:52:06', '2023-02-15 08:52:06', 0),
(19, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:53:09', '2023-02-15 08:53:09', 0),
(20, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 08:54:09', '2023-02-15 08:54:09', 0),
(21, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'dsdsa', '2023-02-15 08:56:10', '2023-02-15 08:56:10', 0),
(22, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 09:06:05', '2023-02-15 09:06:05', 0),
(23, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 09:07:21', '2023-02-15 09:07:21', 0),
(24, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 09:07:35', '2023-02-15 09:07:35', 0),
(25, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 09:08:07', '2023-02-15 09:08:07', 0),
(26, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'img.jpg', '2023-02-15 09:08:19', '2023-02-15 09:08:19', 0),
(27, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'library/articles/img.jpg', '2023-02-15 09:08:31', '2023-02-15 09:08:31', 0),
(28, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'library/articles/makalaty_articles_281676452604.Array', '2023-02-15 09:16:44', '2023-02-15 09:16:44', 0),
(29, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'library/articles/makalaty_articles_461676452634.jpg', '2023-02-15 09:17:14', '2023-02-15 09:17:14', 0),
(30, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'makalaty_articles_711676453204.jpg', '2023-02-15 09:26:44', '2023-02-15 09:26:44', 0),
(31, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'library/articles/makalaty_articles_501676453238.jpg', '2023-02-15 09:27:18', '2023-02-15 09:27:18', 0),
(32, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'library/articles/makalaty_articles_91676453252.jpg', '2023-02-15 09:27:32', '2023-02-15 09:27:32', 0),
(33, 3, 'add in en', 'add in ar', 'short_desc_en', 'short_desc_ar', 'content_en', 'content_en ar ', 'article', NULL, 'library/articles/makalaty_articles_991676532205.jpg', '2023-02-16 07:23:26', '2023-02-16 07:23:26', 0),
(34, 6, 'TEST1', 'TEST2', 'TEST3', 'TEST4', 'TEST5', 'TEST6', 'video', 'www.yputube.com', 'library/articles/makalaty_articles_711676532776.png', '2023-02-16 07:32:56', '2023-02-16 07:32:56', 0),
(35, 6, 'TEST1', 'TEST2', 'TEST3', 'TEST4', 'TEST5', 'TEST6', 'video', 'www.yputube.com', NULL, '2023-02-16 07:33:40', '2023-02-16 07:33:40', 0),
(36, 6, 'TEST1', 'TEST2', 'TEST3', 'TEST4', 'TEST5', 'TEST6', 'video', 'www.yputube.com', 'library/articles/makalaty_articles_701676532867.png', '2023-02-16 07:34:27', '2023-02-16 07:34:27', 0),
(37, 6, 'TEST1', 'TEST2', 'TEST3', 'TEST4', 'TEST5', 'TEST6', 'video', 'www.yputube.com', NULL, '2023-02-16 07:35:39', '2023-02-16 07:35:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created`, `modified`) VALUES
(3, 'اخبار', '2023-02-12 07:40:11', '2023-02-12 07:40:11'),
(4, NULL, '2023-02-12 07:40:39', '2023-02-13 09:18:50'),
(5, NULL, '2023-02-12 07:40:51', '2023-02-12 07:40:51'),
(6, 'فن12', '2023-02-12 07:48:35', '2023-02-12 07:48:35'),
(7, 'فن12', '2023-02-12 07:51:50', '2023-02-12 07:51:50'),
(8, 'فن12', '2023-02-12 07:54:03', '2023-02-12 07:54:03'),
(9, 'فن12', '2023-02-12 08:00:25', '2023-02-12 08:00:25'),
(12, 'اقتصاد وسياسة', '2023-02-12 08:02:46', '2023-02-13 09:46:31'),
(13, 'رياضة', '2023-02-12 08:12:01', '2023-02-12 08:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` enum('inactive','active') NOT NULL DEFAULT 'inactive',
  `article_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `website`, `comment`, `created`, `modified`, `status`, `article_id`) VALUES
(1, 'hatem', 'email@mail.com', 'wwww.www.com', 'sample', NULL, '2023-02-17 16:38:47', 'inactive', 2),
(2, 'hatem', 'email@mail.com', 'wwww.www.com', 'sample', NULL, NULL, 'active', NULL),
(3, 'ahmed', 'ahmed.com', 'ahmed.www.com', 'sample', NULL, NULL, 'inactive', NULL),
(4, 'ali', 'ali@.com', 'ali.www.com', 'sample ali', NULL, NULL, 'active', 2),
(14, 'name', 'admin@admin.com', 'www', 'text text sample', '2023-02-26 13:13:15', '2023-02-26 13:13:15', 'inactive', 2),
(15, 'name', 'admin@admin.com', 'www', 'text text sample', '2023-02-26 16:32:53', '2023-02-26 16:32:53', 'inactive', 2);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `mobile`, `subject`, `message`, `created`, `modified`) VALUES
(1, 'name', 'mail', '213231', 'ddsadsa', 'dsad', NULL, NULL),
(2, 'name', 'mail', '213231', 'ddsadsa', 'dsad', NULL, NULL),
(3, 'name', 'admin@admin.com', 'www', 'text text sample', 'msg', '2023-02-26 16:46:03', '2023-02-26 16:46:03'),
(4, 'name', 'admin@admin.com', 'www', 'text text sample', 'msg', '2023-02-26 16:46:09', '2023-02-26 16:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `email_list`
--

CREATE TABLE `email_list` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_list`
--

INSERT INTO `email_list` (`id`, `email`, `created`, `modified`) VALUES
(1, 'dsad@dasdsa', NULL, NULL),
(2, 'dsadas@ddasd', NULL, NULL),
(3, NULL, '2023-02-26 07:01:43', '2023-02-26 07:01:43'),
(4, NULL, '2023-02-26 07:02:22', '2023-02-26 07:02:22'),
(5, NULL, '2023-02-26 07:06:54', '2023-02-26 07:06:54'),
(6, 'hs@jd.com', '2023-02-26 07:13:57', '2023-02-26 07:13:57'),
(7, 'admin@admin.com', '2023-02-26 07:27:36', '2023-02-26 07:27:36'),
(8, 'admin@admin.com', '2023-02-26 07:28:19', '2023-02-26 07:28:19'),
(9, 'hatem@yahoo.com', '2023-02-26 07:29:00', '2023-02-26 07:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_group` enum('user','admin') NOT NULL DEFAULT 'user',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `user_group`, `created`, `modified`) VALUES
(4, 'admin', '$2y$10$b0GFVClBy/u6dZQLi.JqwOhx15pYJk.VK7ZBBaew1YR9/on/UQTt2', 'admin@admin.com', 'admin', '2023-01-19 19:37:11', '2023-01-19 19:37:11'),
(5, 'user', '$2y$10$50NW56VSzvnZY3tfKVzrYuzq7O7xJ0aUQiYjYZF9wx4SDvZB5BvwG', 'user@user.com', 'user', '2023-02-21 11:50:17', '2023-02-21 11:50:17'),
(6, 'user2', '$2y$10$EbbGlDl1N2viAusmNcbyGeHjrsE1oaFTH4Rm.Rqj0IdSbpVeZrXyi', 'user2@user.com', 'user', '2023-02-21 11:51:44', '2023-02-21 11:51:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertises`
--
ALTER TABLE `advertises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_list`
--
ALTER TABLE `email_list`
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
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advertises`
--
ALTER TABLE `advertises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `email_list`
--
ALTER TABLE `email_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
