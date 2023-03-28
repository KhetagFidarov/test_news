-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 28 2023 г., 15:41
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_web`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_view` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_id` int(255) NOT NULL,
  `is_delete` int(1) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `post_name`, `is_view`, `user_id`, `category_id`, `image_id`, `is_delete`, `create_time`) VALUES
(1, 'Разработанный в России искусственный интеллект ставит пациентам диагнозы за считанные минуты                                                  ', '0', '99', 1, 1, 0, '2023-03-27 16:15:26'),
(2, 'В России подводят предварительные итоги сразу нескольких программ в здравоохранении            ', '0', '99', 1, 2, 0, '2023-03-27 16:15:26'),
(3, 'Можно ли убежать от стресса, и что эффективнее снимает тревогу – пробежка или прогулка  ', '1', '99', 2, 5, 0, '2023-03-27 16:17:07'),
(4, 'Больше движения! Чем лучше заняться – бегом или ходьбой  ', '1', '99', 2, 6, 0, '2023-03-27 16:17:07'),
(5, 'Бутерброд из лаваша с копченым палтусом', '1', '99', 4, 3, 0, '2023-03-27 16:18:19'),
(6, 'Сухарики из черного хлеба с чесноком', '1', '99', 4, 4, 0, '2023-03-27 16:18:19'),
(19, 'Разработанный в России искусственный интеллект ставит пациентам диагнозы за считанные минуты                                                  ', '1', '99', 1, 7, 0, '2023-03-27 16:15:26'),
(20, 'Разработанный в России искусственный интеллект ставит пациентам диагнозы за считанные минуты                                                  ', '1', '99', 1, 8, 0, '2023-03-27 16:15:26'),
(21, 'В России подводят предварительные итоги сразу нескольких программ в здравоохранении            ', '1', '99', 1, 9, 0, '2023-03-27 16:15:26'),
(22, 'В России подводят предварительные итоги сразу нескольких программ в здравоохранении            ', '1', '99', 1, 10, 0, '2023-03-27 16:15:26'),
(23, 'Бутерброд из лаваша с копченым палтусом     ', '1', '99', 4, 11, 0, '2023-03-27 16:18:19'),
(24, 'Бутерброд из лаваша с копченым палтусом', '1', '99', 4, 12, 0, '2023-03-27 16:18:19');

-- --------------------------------------------------------

--
-- Структура таблицы `posts_category`
--

CREATE TABLE `posts_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_tag` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `posts_category`
--

INSERT INTO `posts_category` (`id`, `category_name`, `category_tag`) VALUES
(1, 'Здоровье', 'health'),
(2, 'Тренировки', 'fitness'),
(3, 'Новости', 'news'),
(4, 'Еда', 'food');

-- --------------------------------------------------------

--
-- Структура таблицы `posts_image`
--

CREATE TABLE `posts_image` (
  `id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `directory` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `posts_image`
--

INSERT INTO `posts_image` (`id`, `image_name`, `directory`, `post_id`) VALUES
(1, '12321.jpg', 'images/12321.jpg', 1),
(2, 'health_2', 'images/health_2.jpeg', 2),
(3, 'food_1', 'images/food_1.jpg', 5),
(4, 'food_2', 'images/food_2.jpg', 6),
(5, 'fitness_1', 'images/fitness_1.jpg', 3),
(6, 'image12.jpg', 'images/image12.jpg', 4),
(7, '12321.jpg', 'images/12321.jpg', 19),
(8, '12321.jpg', 'images/12321.jpg', 20),
(9, 'health_2', 'images/health_2.jpeg', 21),
(10, 'health_2', 'images/health_2.jpeg', 22),
(11, 'm225f681.jpg', 'images/m225f681.jpg', 23),
(12, 'food_1', 'images/food_1.jpg', 24);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rights` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `rights`) VALUES
(7, 'admin', '$2y$10$bLzCfTUTnU70ykGcrkloIubD3ctnlxOVXb/oQd.l.TrnVLbfU5kf2', 1),
(8, 'moder', '$2y$10$o9QNUtyFj82HvPlnHFcLe.o.wLgL0h9WQYfGajYAk23q172oNr.zi', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `user_rights`
--

CREATE TABLE `user_rights` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rights` varchar(255) NOT NULL,
  `rights_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user_rights`
--

INSERT INTO `user_rights` (`id`, `name`, `rights`, `rights_name`) VALUES
(1, 'Администратор', '1', 'create,delete'),
(2, 'Модератор', '2', 'update'),
(4, 'Пользователь', '3', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Индексы таблицы `posts_category`
--
ALTER TABLE `posts_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts_image`
--
ALTER TABLE `posts_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `rights` (`rights`);

--
-- Индексы таблицы `user_rights`
--
ALTER TABLE `user_rights`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `posts_category`
--
ALTER TABLE `posts_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `posts_image`
--
ALTER TABLE `posts_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `user_rights`
--
ALTER TABLE `user_rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `posts_category` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `posts_image` (`id`);

--
-- Ограничения внешнего ключа таблицы `posts_image`
--
ALTER TABLE `posts_image`
  ADD CONSTRAINT `posts_image_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rights`) REFERENCES `user_rights` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
