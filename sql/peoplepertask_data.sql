-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2023 at 09:06 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peoplepertask_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(6, 'marketing'),
(7, 'write'),
(8, 'graphic'),
(9, 'logo design'),
(10, 'ai'),
(11, 'front end'),
(12, 'logodesign');

-- --------------------------------------------------------

--
-- Table structure for table `freelancers_skills`
--

CREATE TABLE `freelancers_skills` (
  `freelancer_id` int DEFAULT NULL,
  `skill_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `freelancers_skills`
--

INSERT INTO `freelancers_skills` (`freelancer_id`, `skill_id`) VALUES
(107, 1),
(107, 2),
(107, 3),
(107, 5),
(107, 13),
(107, 18),
(107, 9),
(107, 15),
(112, 21),
(112, 22),
(112, 3),
(112, 5),
(112, 9),
(112, 8),
(112, 17),
(112, 18),
(112, 12),
(112, 20),
(112, 11),
(112, 13),
(112, 1),
(112, 16),
(112, 15),
(112, 10),
(112, 23),
(107, 10);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_requests`
--

CREATE TABLE `freelancer_requests` (
  `request_id` int NOT NULL,
  `project_id` int NOT NULL,
  `freelancer_id` int NOT NULL,
  `status` enum('pending','completed','rejected','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pending',
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `freelancer_requests`
--

INSERT INTO `freelancer_requests` (`request_id`, `project_id`, `freelancer_id`, `status`, `message`) VALUES
(1, 28, 107, 'pending', 'hello there can you acccept my proposal pplzzz ;)'),
(2, 28, 102, 'pending', 'now dont accept him accept me brother i promise i do my best ;)) '),
(3, 32, 107, 'completed', 'plz accept me lol'),
(4, 38, 107, 'completed', 'plz accept my proposal i want to build my carrer'),
(5, 39, 107, 'completed', 'lol it will work plz for the triple time gg'),
(6, 40, 107, 'pending', 'im mr freelancer 1 accept me '),
(7, 40, 112, 'completed', 'im mr freelancer the second the real accept pzl'),
(8, 35, 107, 'completed', 'hello'),
(9, 36, 107, 'completed', 'I need to work with you'),
(10, 41, 107, 'completed', 'plz accept my rpoposal');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int NOT NULL,
  `project_tittle` varchar(100) NOT NULL,
  `descreption` varchar(200) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `subcate_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  `freelancer_id` int DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_tittle`, `descreption`, `category_id`, `subcate_id`, `user_id`, `price`, `freelancer_id`, `creation_date`) VALUES
(28, 'lol lol ', 'f', 6, 11, 104, 1022, NULL, '2023-12-08 16:07:30'),
(32, 'lol lol ', 'Revolutionary AI-driven healthcare app enhancing patient engagement and streamlining medical records for seamless, personalized care', 6, 11, 109, 1022, 107, '2023-12-08 16:07:30'),
(35, 'lol', 'jiji', 6, 11, 106, 105, 107, '2023-12-08 16:07:30'),
(36, '100', 'mmmmmmmmmmmm', 8, 12, 106, 100, 107, '2023-12-08 16:07:30'),
(38, 'me', 'me', 6, 11, 111, 100, 107, '2023-12-08 16:07:30'),
(39, 'me again', 'me again project', 6, 11, 111, 1, 107, '2023-12-08 16:07:30'),
(40, 'now duos freelancers', 'duos', 10, 12, 111, 22222, 112, '2023-12-08 16:07:30'),
(41, 'check', 'hi i want some one to design for me this logo', 6, 11, 106, 200, 107, '2023-12-08 16:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `projects_tags`
--

CREATE TABLE `projects_tags` (
  `project_id` int DEFAULT NULL,
  `tag_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `projects_tags`
--

INSERT INTO `projects_tags` (`project_id`, `tag_id`) VALUES
(35, 1),
(36, 5),
(35, 12),
(35, 11),
(41, 5),
(35, 5),
(39, 13),
(40, 3),
(36, 1),
(36, 5),
(36, 7);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `skill_id` int NOT NULL,
  `skill_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`skill_id`, `skill_name`) VALUES
(1, 'Web Development'),
(2, 'Graphic Design'),
(3, 'Content Writing'),
(4, 'Digital Marketing'),
(5, 'SEO'),
(6, 'Social Media Management'),
(7, 'Mobile App Development'),
(8, 'UI/UX Design'),
(9, 'Copywriting'),
(10, 'Photography'),
(11, 'Video Editing'),
(12, 'Project Management'),
(13, 'Data Entry'),
(14, 'Virtual Assistance'),
(15, 'Customer Support'),
(16, 'Translation'),
(17, 'E-commerce'),
(18, 'Blockchain Development'),
(19, 'WordPress'),
(20, 'SEO Optimization'),
(21, 'front end'),
(22, 'back end developer'),
(23, 'management'),
(24, 'full stack'),
(25, 'full stack');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `subcate_id` int NOT NULL,
  `subcate_name` varchar(20) DEFAULT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`subcate_id`, `subcate_name`, `category_id`) VALUES
(11, 'lol', 9),
(12, 'Yasser', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int NOT NULL,
  `tag_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(1, 'ProjectX'),
(2, 'InnovationHub'),
(3, 'TechPioneers'),
(4, 'CodeMasters'),
(5, 'DataInsights'),
(6, 'QuantumLeap'),
(7, 'EcoTech'),
(8, 'FutureTech'),
(9, 'SkyNet'),
(10, 'GreenSolutions'),
(11, 'SmartCities'),
(12, 'InfinityLoop'),
(13, 'CodeNinjas'),
(14, 'DigitalHarbor'),
(15, 'RobotRevolution'),
(16, 'NeuralNetworks'),
(17, 'BlueHorizon'),
(18, 'DataVortex'),
(19, 'QuantumQuotient'),
(20, 'ProjectZ'),
(21, 'fast'),
(22, 'fast');

-- --------------------------------------------------------

--
-- Table structure for table `testemonials`
--

CREATE TABLE `testemonials` (
  `testemonial_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `user_name` varchar(25) DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `other` varchar(200) DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `email`, `other`, `role`) VALUES
(18, 'new', '$2y$10$vrXUsMZJRSWfHW3YU2lMIeZX2pa1NDFZtgzzpJWi3XqNbDS3WopfS', 'newgmail2@gmail.com', 'i can develop  back and <br> i can do it agai ', 'admin'),
(102, 'admin', '$2y$10$iJu9HqDrtNYj08HYKaV7/OaJkoAjhYTJu0nZCxL92GKoMC7NLPDVW', 'admin@gmail.com', 'i can develop  back and <br> i can do it agai ', 'admin'),
(104, 'Yasser', '$2y$10$H324rO/S7/tvgvUi5fo0VO0kCbQEv1x7OWxodxEw.4dleLo6jYWHS', 'aitelghaasser@gmail.com', 'i can develop  back and <br> i can do it agai ', 'freelancer'),
(105, 'ffff', '$2y$10$A36Uq308J/12IhqFhD2.LOo6QpJZB7tCb2koXtNzJYbcWgeBPYw/6', 'for@gmail.com', 'i can develop  back and <br> i can do it agai ', 'admin'),
(106, 'user', '$2y$10$uolG9Aip5/6sVXnI2X3Ax.pCGvFBjRzwX/.v3ZqMJpMDU9xjN.uFq', 'user@gmail.com', 'i can develop  back and <br> i can do it agai ', 'user'),
(107, 'freelancer', '$2y$10$xerADpcVMRX/jrlbJqW2SebHjl09FtgZ16Zy5eZQ1Vzyflf2btPtu', 'freelancer@gmail.com', 'i can develop  back and <br> i can do it agai ', 'freelancer'),
(108, 'yassir', '$2y$10$uSrjInIttBhfm6YRyo3ZnODdxKQ4JOXjyD1ea13RTiJOb.Kc9JyVu', 'aitelghariyasser@gmail.com', 'i can develop  back and <br> i can do it agai ', 'admin'),
(109, 'client', '$2y$10$AA/pbxdd2VSx2CqKDeQHUOwf/.BrhafrByF30Wa9nsjfAUXuoYrJy', 'client@gmail.com', 'i can develop  back and <br> i can do it agai ', 'user'),
(110, '&lt;h1&gt;hhhh&lt;/h1&gt;', '$2y$10$TROX0X3Fp2z1Tx/VS1Xb8.t/U4vSjlixAjB4Uym9BkepGSR4kcqmu', 'aityasser@gmail.com', '', 'freelancer'),
(111, 'me', '$2y$10$rPCGqwd6Hm4EEHpl0hkkZuUf837IK1ZVRC2pdHx4NjRTZwH5GK5Pu', 'me@gmail.com', NULL, 'user'),
(112, 'freelancer2', '$2y$10$om3v.lm.v4oIbQiDfVZ5c.tHEKp7sZvdoUOz.Bz5j10Saj83ASTS2', 'freelancer2@gmail.com', NULL, 'freelancer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `freelancer_requests`
--
ALTER TABLE `freelancer_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `fk_proid` (`project_id`),
  ADD KEY `fk__freeid` (`freelancer_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcate_id` (`subcate_id`),
  ADD KEY `projects_ibfk_4` (`user_id`),
  ADD KEY `projects_ibfk_5` (`freelancer_id`);

--
-- Indexes for table `projects_tags`
--
ALTER TABLE `projects_tags`
  ADD KEY `project_id` (`project_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`skill_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`subcate_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `testemonials`
--
ALTER TABLE `testemonials`
  ADD PRIMARY KEY (`testemonial_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `freelancer_requests`
--
ALTER TABLE `freelancer_requests`
  MODIFY `request_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `skill_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `subcate_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `testemonials`
--
ALTER TABLE `testemonials`
  MODIFY `testemonial_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `freelancer_requests`
--
ALTER TABLE `freelancer_requests`
  ADD CONSTRAINT `fk__freeid` FOREIGN KEY (`freelancer_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_proid` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`subcate_id`) REFERENCES `subcategories` (`subcate_id`),
  ADD CONSTRAINT `projects_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `projects_ibfk_5` FOREIGN KEY (`freelancer_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `projects_tags`
--
ALTER TABLE `projects_tags`
  ADD CONSTRAINT `projects_tags_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  ADD CONSTRAINT `projects_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `testemonials`
--
ALTER TABLE `testemonials`
  ADD CONSTRAINT `testemonials_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
