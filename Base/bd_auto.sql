-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 06 2022 г., 23:45
-- Версия сервера: 5.7.33
-- Версия PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bd_auto`
--
CREATE DATABASE IF NOT EXISTS `bd_auto` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bd_auto`;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_catalog`
--

DROP TABLE IF EXISTS `tbl_catalog`;
CREATE TABLE `tbl_catalog` (
  `id` int(11) NOT NULL,
  `mark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `generation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(4) DEFAULT NULL,
  `run` int(6) DEFAULT NULL,
  `color` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body-type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `engine-type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `transmission` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gear-type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `generation_id` int(11) DEFAULT NULL,
  `date_metka` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tbl_catalog`
--

INSERT INTO `tbl_catalog` (`id`, `mark`, `model`, `generation`, `year`, `run`, `color`, `body-type`, `engine-type`, `transmission`, `gear-type`, `generation_id`, `date_metka`) VALUES
(10, 'ГАЗ', '13 «Чайка»', '(1959-1981)', 1968, 1453, 'Белый', 'Седан', 'Бензин', 'Автоматическая', 'Задний', 20351648, '2022-11-06 23:22:44'),
(402501, 'Волжанин', '5286', '', 2012, 192500, 'Зеленый', 'Специальный', 'Дизель', 'Механическая', 'Задний', NULL, '2022-11-06 23:22:44'),
(412873, 'Honda', 'CR-V', 'V (2016-2022)', 2017, 47751, 'Серебристый', 'Внедорожник 5 дв.', 'Бензин', 'Вариатор', 'Полный', 20875803, '2022-11-06 23:22:44'),
(440418, 'Mercedes', 'G-Класс', 'II (W463) (1990-2006)', 2005, 127632, 'Серебристый', 'Внедорожник 5 дв.', 'Бензин', 'Автоматическая', 'Полный', 4760268, '2022-11-06 23:22:44');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tbl_catalog`
--
ALTER TABLE `tbl_catalog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mark` (`mark`(10)),
  ADD KEY `model` (`model`(10)),
  ADD KEY `run` (`run`),
  ADD KEY `color` (`color`(12)) USING BTREE,
  ADD KEY `body-type` (`body-type`(20)),
  ADD KEY `generation` (`generation`(20)) USING BTREE,
  ADD KEY `transmission` (`transmission`(16)),
  ADD KEY `gear-type` (`gear-type`(10)),
  ADD KEY `engine-type` (`engine-type`(6)),
  ADD KEY `date_metka` (`date_metka`),
  ADD KEY `year` (`year`) USING BTREE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
