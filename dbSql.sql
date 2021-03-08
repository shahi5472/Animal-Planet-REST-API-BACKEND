-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 08, 2021 at 06:39 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `animal_planet_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
                            `id` bigint(20) UNSIGNED NOT NULL,
                            `post_id` bigint(20) UNSIGNED NOT NULL,
                            `user_id` bigint(20) UNSIGNED NOT NULL,
                            `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 3, 9, 'helo one', '2021-03-08 00:16:41', '2021-03-08 00:16:41'),
(2, 3, 8, 'frnf akjfnasjkf anmdf', '2021-03-08 00:19:52', '2021-03-08 00:19:52'),
(3, 1, 11, 'iafbsjdnf ', '2021-03-08 00:21:02', '2021-03-08 00:21:02');

-- --------------------------------------------------------

--
-- Table structure for table `comment_replies`
--

CREATE TABLE `comment_replies` (
                                   `id` bigint(20) UNSIGNED NOT NULL,
                                   `comment_id` bigint(20) UNSIGNED NOT NULL,
                                   `user_id` bigint(20) UNSIGNED NOT NULL,
                                   `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment_replies`
--

INSERT INTO `comment_replies` (`id`, `comment_id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 'reply comment one', '2021-03-08 00:16:51', '2021-03-08 00:16:51'),
(2, 1, 11, 'jakb sdmnf a', '2021-03-08 00:21:16', '2021-03-08 00:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
                             `id` bigint(20) UNSIGNED NOT NULL,
                             `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `address`, `contact`, `created_at`, `updated_at`) VALUES
(1, 'Hospital Name One', 'Sylhet', '01737492874', '2021-03-08 17:48:20', '2021-03-08 17:48:20'),
(2, 'Hospital Name Two', 'Dhaka', '01723963823', '2021-03-08 17:48:20', '2021-03-08 17:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
                          `id` bigint(20) UNSIGNED NOT NULL,
                          `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `image_src` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `user_id` bigint(20) UNSIGNED NOT NULL,
                          `created_at` timestamp NULL DEFAULT NULL,
                          `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `url`, `image_src`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'IMG_68853579885.png', 'post', 3, '2021-03-08 00:09:36', '2021-03-08 00:09:36'),
(2, 'IMG_3822213164088.png', 'post', 3, '2021-03-08 00:09:36', '2021-03-08 00:09:36'),
(3, 'IMG_1645614355533.png', 'post', 3, '2021-03-08 00:09:36', '2021-03-08 00:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
                                 `id` bigint(20) UNSIGNED NOT NULL,
                                 `user_id` bigint(20) UNSIGNED NOT NULL,
                                 `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `read_at` timestamp NULL DEFAULT NULL,
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
                         `id` bigint(20) UNSIGNED NOT NULL,
                         `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `description` longtext COLLATE utf8mb4_unicode_ci,
                         `animal_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `user_id` bigint(20) UNSIGNED NOT NULL,
                         `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
                         `is_answered` tinyint(1) NOT NULL DEFAULT '0',
                         `view_count` int(11) NOT NULL DEFAULT '0',
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `animal_type`, `user_id`, `doctor_id`, `is_answered`, `view_count`, `created_at`, `updated_at`) VALUES
(1, 'What makes a good blog post?', 'Before you write a blog, make sure you know the answers to questions like, \"Why would someone keep reading this entire blog post?\" and \"What makes our audience come back for more?\"\r\n\r\nTo start, a good blog post is interesting and educational. Blogs should answer questions and help readers resolve a challenge they\'re experiencing — and you have to do so in an interesting way.\r\n\r\nIt\'s not enough just to answer someone\'s questions — you also have to provide actionable steps while being engaging. For instance, your introduction should hook the reader and make them want to continue reading your post. Then, use examples to keep your readers interested in what you have to say.', 'Cat', 8, NULL, 0, 31, '2021-03-06 15:18:58', '2021-03-06 15:18:58'),
(2, 'How to Write a Blog Post', 'Here are the steps you\'ll want to follow while writing a blog post.\r\n\r\n1. Understand your audience.\r\nBefore you start writing your blog post, make sure you have a clear understanding of your target audience.\r\n\r\nAsk questions like: What do they want to know about? And, what will resonate with them?\r\n\r\nThis is where creating your buyer personas comes in handy. Consider what you know about your buyer personas and their interests while you\'re coming up with a topic for your blog post.\r\n\r\nFor instance, if your readers are millennials looking to start a business, you probably don\'t need to provide them with information about getting started in social media — most of them already have that down.', 'Dog', 8, NULL, 0, 12, '2021-03-06 15:19:34', '2021-03-06 15:19:34'),
(3, 'Check', 'check descriptions', 'dog', 9, NULL, 0, 12, '2021-03-08 00:09:36', '2021-03-08 00:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `id` bigint(20) UNSIGNED NOT NULL,
                         `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
                         `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `specialists` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_type`, `phone`, `address`, `specialists`, `password`, `created_at`, `updated_at`) VALUES
(8, 'S M KAMAL HUSSAIN SHAHI', 's.m.kamalhussain@gmail.com', 'user', '01746799842', NULL, NULL, 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '2021-03-03 22:46:45', '2021-03-03 22:46:45'),
(9, 'Admin', 'admin@gmail.com', 'admin', '01712591218', 'Moulvibazar', NULL, 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '2021-03-08 17:43:30', '2021-03-08 17:43:30'),
(10, 'Doctor One', 'doctor@gmail.com', 'doctor', '01675539928', 'MOULVIBAZAR', 'Cat', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '2021-03-08 17:49:20', '2021-03-08 17:49:20'),
(11, 'MD AKTHARUZZAMAN SHIBLU', 'mdshiblu39928@gmail.com', 'user', '01675539928', NULL, NULL, 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '2021-03-08 00:20:17', '2021-03-08 00:20:17'),
(12, 'doctor add ', 'adddoctor@gmail.com', 'doctor', '01736598363', '80 OPORAJITA, MODDOPARA', 'Birds', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', '2021-03-08 00:25:12', '2021-03-08 00:25:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
    ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `comment_replies`
--
ALTER TABLE `comment_replies`
    ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
    ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
    ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
    ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
    ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment_replies`
--
ALTER TABLE `comment_replies`
    ADD CONSTRAINT `comment_replies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
    ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
    ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
