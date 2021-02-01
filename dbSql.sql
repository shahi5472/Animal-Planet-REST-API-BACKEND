-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 01, 2021 at 07:16 PM
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
(1, 1, 1, 'This is another WordPress-like blogging platform. While the Ghost software can be downloaded for free, you need paid hosting for fuel. DigitalOcean is a great service that supports Ghost: it is cheap and comes with a bunch of nice features to get you started.', '2021-01-10 17:29:53', '2021-01-10 17:29:53'),
(3, 3, 1, 'This is another WordPress-like blogging platform. While the Ghost software can be downloaded for free, you need paid hosting for fuel. DigitalOcean is a great service that supports Ghost: it is cheap and comes with a bunch of nice features to get you started.', '2021-01-10 17:30:51', '2021-01-10 17:30:51'),
(4, 4, 1, 'This is another WordPress-like blogging platform. While the Ghost software can be downloaded for free, you need paid hosting for fuel. DigitalOcean is a great service that supports Ghost: it is cheap and comes with a bunch of nice features to get you started.', '2021-01-10 17:30:51', '2021-01-10 17:30:51'),
(5, 1, 2, 'This is another WordPress-like blogging platform. While the Ghost software can be downloaded for free, you need paid hosting for fuel. DigitalOcean is a great service that supports Ghost: it is cheap and comes with a bunch of nice features to get you started.', NULL, NULL),
(6, 1, 1, 'This is another WordPress-like blogging platform. While the Ghost software can be downloaded for free, you need paid hosting for fuel. DigitalOcean is a great service that supports Ghost: it is cheap and comes with a bunch of nice features to get you started.', NULL, NULL);

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
(1, 1, 1, 'To create a post in Ghost is easy once you set up your website. The editor is simple and minimalist, and it offers a live preview of your text on the right side of the screen. On the front-end, you get a Medium vibe, so it’s nice. Near the editor screen, there is a sidebar with settings, where you can choose your preferences.\r\n\r\n', '2021-01-10 17:31:36', '2021-01-10 17:31:36'),
(2, 2, 1, 'To create a post in Ghost is easy once you set up your website. The editor is simple and minimalist, and it offers a live preview of your text on the right side of the screen. On the front-end, you get a Medium vibe, so it’s nice. Near the editor screen, there is a sidebar with settings, where you can choose your preferences.\r\n\r\n', '2021-01-09 17:31:36', '2021-01-09 17:31:36'),
(4, 4, 1, 'To create a post in Ghost is easy once you set up your website. The editor is simple and minimalist, and it offers a live preview of your text on the right side of the screen. On the front-end, you get a Medium vibe, so it’s nice. Near the editor screen, there is a sidebar with settings, where you can choose your preferences.\r\n\r\n', '2021-01-10 17:32:21', '2021-01-10 17:32:21'),
(6, 4, 1, 'To create a post in Ghost is easy once you set up your website. The editor is simple and minimalist, and it offers a live preview of your text on the right side of the screen. On the front-end, you get a Medium vibe, so it’s nice. Near the editor screen, there is a sidebar with settings, where you can choose your preferences.\r\n\r\n', '2021-01-10 17:32:53', '2021-01-10 17:32:53'),
(7, 1, 2, 'now comment replies', '2021-01-27 18:58:59', '2021-01-27 18:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
                               `id` bigint(20) UNSIGNED NOT NULL,
                               `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
                               `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
                               `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'A', 'Sylhet', '01846799842', '2021-01-10 17:28:21', '2021-01-10 17:28:21'),
(2, 'B', 'Dhaka', '01946799842', '2021-01-10 17:28:21', '2021-01-10 17:28:21'),
(3, 'C', 'Moulvibazar', '01446799842', '2021-01-10 17:29:06', '2021-01-10 17:29:06');

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
(1, 'https://images.pexels.com/photos/5277697/pexels-photo-5277697.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500', 'post', 1, NULL, NULL),
(2, 'https://images.pexels.com/photos/5277697/pexels-photo-5277697.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500', 'post', 1, NULL, NULL),
(3, 'https://images.pexels.com/photos/5277697/pexels-photo-5277697.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500', 'post', 1, NULL, NULL),
(4, 'https://images.pexels.com/photos/5277697/pexels-photo-5277697.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500', 'post', 1, NULL, NULL),
(5, 'https://images.pexels.com/photos/5277697/pexels-photo-5277697.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500', 'user', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
                              `id` int(10) UNSIGNED NOT NULL,
                              `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_01_10_164808_create_posts_table', 1),
(5, '2021_01_10_165803_create_images_table', 1),
(6, '2021_01_10_170103_create_hospitals_table', 1),
(7, '2021_01_10_170719_create_notifications_table', 1),
(8, '2021_01_10_171008_create_comments_table', 1),
(9, '2021_01_10_171309_create_comment_replies_table', 1);

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
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
                                   `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
                         `id` bigint(20) UNSIGNED NOT NULL,
                         `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `description` longtext COLLATE utf8mb4_unicode_ci,
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

INSERT INTO `posts` (`id`, `title`, `description`, `user_id`, `doctor_id`, `is_answered`, `view_count`, `created_at`, `updated_at`) VALUES
(1, 'WordPress (www.wordpress.org)', 'WordPress.org is the king of free blogging sites. It is a free platform, but you need to build the site mostly by yourself afterward. You also have to host the software yourself. While you can find some free WordPress hosting, a better long-term strategy is to pay a moderate amount for a solid WordPress host.\r\n\r\nThis is where Bluehost comes into play. Not only is it very cheap (just $2.95 per month on the Basic plan), but it also provides solid features, including a free domain name, 50GB of disk space, unmetered bandwidth, free SSL, and 100MB of email storage per account. At this very moment, Bluehost is the cheapest sensible WordPress hosting you can find out there.', 1, 2, 0, 4, '2021-01-10 17:24:42', '2021-01-10 17:24:42'),
(3, 'Weebly is another website builder', 'You probably didn’t see this one coming. LinkedIn isn’t most people’s first choice when considering which of the free blogging sites to choose. That being said, it really does deserve some attention!\r\n\r\nTwo main reasons for this: easy to use tools, and pre-existing audience.\r\n\r\nAbout that second thing – the audience – what’s great about LinkedIn’s user base is that those are highly focused users, professionals and business owners. In fact, it’s reported that more than 30 million businesses are active on LinkedIn. And they’re not just there for the sake of it. Other data indicates that 94% of B2B marketers use the platform as one of their primary lead sources.\r\n\r\nIn short, LinkedIn just works as a platform where you can get exposure, and this makes it one of the best free blogging sites of them all.\r\n\r\n', 1, 2, 1, 10, '2021-01-10 17:26:25', '2021-01-10 17:26:25'),
(4, 'Medium is a multipurpose platform tackling diverse topics', 'You probably didn’t see this one coming. LinkedIn isn’t most people’s first choice when considering which of the free blogging sites to choose. That being said, it really does deserve some attention!\r\n\r\nTwo main reasons for this: easy to use tools, and pre-existing audience.\r\n\r\nAbout that second thing – the audience – what’s great about LinkedIn’s user base is that those are highly focused users, professionals and business owners. In fact, it’s reported that more than 30 million businesses are active on LinkedIn. And they’re not just there for the sake of it. Other data indicates that 94% of B2B marketers use the platform as one of their primary lead sources.\r\n\r\nIn short, LinkedIn just works as a platform where you can get exposure, and this makes it one of the best free blogging sites of them all.\r\n\r\n', 1, NULL, 0, 20, '2021-01-10 17:26:25', '2021-01-10 17:26:25'),
(5, 'This is title', 'this is description', 1, NULL, 0, 0, '2021-01-30 23:05:44', '2021-01-30 23:05:44'),
(6, 'This is title another ', 'this is description another', 1, NULL, 0, 0, '2021-01-30 23:08:32', '2021-01-30 23:08:32'),
(7, 'This is title third ', 'this is description third', 1, NULL, 0, 0, '2021-01-30 23:13:07', '2021-01-30 23:13:07'),
(8, 'ajfshfbkjafsdafjnsfj', 'this is description third', 1, NULL, 0, 0, '2021-01-30 23:34:41', '2021-01-30 23:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `id` bigint(20) UNSIGNED NOT NULL,
                         `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
                         `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'Shahi', 'shahi@gmail.com', 'user', '01746799842', 'Moulvibazar', NULL, 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '2021-01-10 17:20:14', '2021-01-10 17:20:14'),
(2, 'Mustafiz', 'mustafiz@gmail.com', 'doctor', '01546799842', 'Sylhet', 'Animal Nai', '$2y$10$0SF1056JAqAaCvAsximkoOyP.FoaabjQ4Hibe/NQXmTXjER.6oWOu', '2021-01-10 17:22:43', '2021-01-10 17:22:43'),
(3, 'Admin', 'admin@gmail.com', 'admin', '01646799842', 'Dhaka', NULL, '$2y$10$0SF1056JAqAaCvAsximkoOyP.FoaabjQ4Hibe/NQXmTXjER.6oWOu', '2021-01-10 17:23:29', '2021-01-10 17:23:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_replies`
--
ALTER TABLE `comment_replies`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
    ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
