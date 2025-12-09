-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 09 2025 г., 11:07
-- Версия сервера: 10.8.4-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `incident_tracker`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `incident_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `incident_id`, `user_id`, `comment`, `created_at`) VALUES
(2, 3, 2, 'да\r\n', '2025-12-08 09:51:43'),
(3, 5, 1, 'yyyy', '2025-12-08 19:34:41');

-- --------------------------------------------------------

--
-- Структура таблицы `incidents`
--

CREATE TABLE `incidents` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('new','in_progress','closed') NOT NULL DEFAULT 'new',
  `priority` enum('low','medium','high') NOT NULL DEFAULT 'medium',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `incidents`
--

INSERT INTO `incidents` (`id`, `user_id`, `title`, `description`, `status`, `priority`, `created_at`, `updated_at`) VALUES
(2, 1, '1', '2', 'new', 'high', '2025-11-20 10:15:46', '2025-11-20 10:15:46'),
(3, 2, '12', '34', 'new', 'low', '2025-11-20 10:19:05', '2025-11-20 10:19:05'),
(5, 1, 'Важно', 'Важно', 'new', 'medium', '2025-12-07 16:15:18', '2025-12-07 16:15:18'),
(6, 4, 'Важно', '2', 'in_progress', 'high', '2025-12-07 20:00:29', '2025-12-07 20:02:46'),
(7, 2, 'не знаю', 'не знаюне знаю', 'in_progress', 'low', '2025-12-08 10:17:25', '2025-12-08 10:17:25'),
(8, 1, '111111111111', '11111111111111111111111111111', 'new', 'medium', '2025-12-09 00:30:20', '2025-12-09 00:30:20');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `auth_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `auth_key`) VALUES
(1, 'алена', '1111@mail.ru', '$2y$10$IRPm7KpDzCfOmewyBjwBd.Q0yJeoBR5Rh02ygVlIgoGU3I62ySI/C', 0, '2025-11-19 19:56:22', '2025-11-19 19:56:22', NULL),
(2, 'админ', '1@mail.ru', '$2y$10$oR8QdetizIU.AOTzPQOMKuj8XWwKTmCy4ZBknwvoRTGFdg1e9Cxhy', 1, '2025-11-19 20:21:47', '2025-11-20 17:01:05', NULL),
(3, 'алена', '1345111@mail.ru', '$2y$10$JlhFgSEO82teCn5mGGqUfeOpPyJ1ltkU.CKaCTvmLVm0aiOMjca/q', 1, '2025-12-07 20:00:00', '2025-12-07 20:00:00', 'QlN7W1kq7lwYb6BISNt0KC63zTOeaI0J'),
(4, '2', 'decf@y.ru', '$2y$10$qc6ZauGoTMQN00nBpDwhWewlFJ2DkAVNOZYdZPChccA3iNEuGkSau', 0, '2025-12-07 20:00:17', '2025-12-07 20:00:17', '-4wegjYKhohY0RR2Z3jLBkEa1zLgfj2f'),
(5, '1345111@mail.ru', '13451112@mail.ru', '$2y$10$HVJJJf2K1eSZ6BmyV1v6xuQbu.FQ7vOwBh7NNaLP4b6KrDJ9g/tgu', 0, '2025-12-07 20:01:37', '2025-12-07 20:01:37', 'mOVlldAGvgikKovb1Pf2aoL9f97ULJQB'),
(6, '134511123@mail.ru', '134511123@mail.ru', '$2y$10$J.T0MdDxXsfQ1Qr4D0ns8O59q2bi/RQo2/QIyBzPxPJElqifcikIO', 1, '2025-12-07 20:02:28', '2025-12-07 20:02:28', 'G4PVSipK9-3eeKxlWQMLwyAEB-FzZo8H'),
(7, '131145111@mail.ru', '131145111@mail.ru', '$2y$10$J/g.lRay2iOD/TnnjtjZZe9nyci.7cGO85yyF4r/bA1wVHnwyT1VW', 1, '2025-12-09 00:08:41', '2025-12-09 00:08:41', 'Z3ivaH52lNH2affpuU1lgIqfVzEA1ztj'),
(8, '11111345111@mail.ru', '11111345111@mail.ru', '$2y$10$0tWSZTxeMD3manEfVLJ50evlVgGSLvmd/TsXWCvQN9Wpq1iMvuBFG', 0, '2025-12-09 11:02:34', '2025-12-09 11:02:34', '0mbJR2nytF1-B4w2s-mXFYd4r7uKDaTg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incident_id` (`incident_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_inc_title` (`title`),
  ADD KEY `idx_inc_created` (`created_at`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`incident_id`) REFERENCES `incidents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `incidents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
