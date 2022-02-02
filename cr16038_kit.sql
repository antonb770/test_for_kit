-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Янв 31 2022 г., 12:52
-- Версия сервера: 10.3.24-MariaDB
-- Версия PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cr16038_kit`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` text DEFAULT NULL,
  `parent_category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `category`, `parent_category`) VALUES
(15, 'Филателия', NULL),
(16, 'Нумизматика', NULL),
(18, 'События', 15),
(19, 'Европа', 16),
(20, 'Австрия', 19),
(21, 'WOW II', 18),
(22, '1941', 21),
(23, 'Лето', 22),
(24, 'Личности', 15),
(25, 't2', 15),
(26, 'WOW I', 18);

-- --------------------------------------------------------

--
-- Структура таблицы `description_category`
--

CREATE TABLE `description_category` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `description_category`
--

INSERT INTO `description_category` (`id`, `description`) VALUES
(15, 'Филатели́я (греч. philéō, люблю   atéleia, освобождение от оплаты) — область коллекционирования и изучения знаков почтовой оплаты (например, почтовых марок) и других филателистических материалов. Самым непосредственным образом областью изучения филателии является также история почтовой связи. В некоторых случаях под филателией может также подразумеваться совокупность собственно предметов филателистического коллекционирования.....'),
(16, 'Нумизма́тика (от лат. numisma, nomisma, numismatis — «монета» ← др.-греч. νόμισμα, νόμισματος — «установившийся обычай, общепринятый порядок; монета») — вспомогательная историческая дисциплина, изучающая историю монетной чеканки и монетного обращения.От нумизматики как науки следует отличать нумизматическое собирательство, или коллекционирование монет...'),
(18, 'Events...');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_bin NOT NULL,
  `password` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(1, 'admin', 'sHaisNJ7QJcBU8Y92+Tigg==');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_par` (`parent_category`);

--
-- Индексы таблицы `description_category`
--
ALTER TABLE `description_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `description_category`
--
ALTER TABLE `description_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_par` FOREIGN KEY (`parent_category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
