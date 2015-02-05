-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Фев 05 2015 г., 23:18
-- Версия сервера: 5.6.21
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `futurecms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
`id` int(11) NOT NULL,
  `name_lang1` text COLLATE utf8_unicode_ci NOT NULL,
  `name_lang2` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `num` int(11) NOT NULL,
  `album_year` year(4) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=155 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `name_lang1`, `name_lang2`, `link`, `date`, `num`, `album_year`) VALUES
(154, 'eeee', '', 'eeee', '2015-02-05', 0, 2015);

-- --------------------------------------------------------

--
-- Структура таблицы `language`
--

CREATE TABLE IF NOT EXISTS `language` (
`id` int(11) NOT NULL,
  `lang1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang2` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `language`
--

INSERT INTO `language` (`id`, `lang1`, `lang2`) VALUES
(1, 'Аўтарызацыя', 'Авторизация'),
(2, 'Рэгістрацыя', 'Регистрация'),
(3, 'Панэль адміністратара', 'Панель администратора'),
(4, 'Выйсці', 'Выйти'),
(5, 'Падрабязней', 'Подробней'),
(6, 'Увядзіце логін:', 'Введите логин:'),
(7, 'Увядзіце пароль:', 'Введите пароль:'),
(8, 'Увядзіце E-mail:', 'Введите E-mail:'),
(9, 'Абярыце аватар:', 'Выберите аватар:'),
(10, 'Абярыце пол:', 'Выберите пол:'),
(11, 'Мужчынскі', 'Мужской'),
(12, 'Жаночы', 'Женский'),
(13, 'Вашэ імя:', 'Ваше имя:'),
(14, 'Ваш E-mail:', 'Ваш E-mail:'),
(15, 'Тэма пытання', 'Тема вопроса'),
(16, 'Пытанне:', 'Вопрос:'),
(17, 'Усе палі абавязковыя для запаўнення!', 'Все поля обязательны для заполнения!'),
(18, 'Адправіць', 'Отправить'),
(19, 'Дадаць каментар:', 'Добавить комментарий:'),
(20, 'Для таго каб пакінуць каментар неабходна', 'Для того чтобы оставить комментарий необходимо'),
(21, 'або', 'или'),
(22, 'Імя карыстальніка:', 'Имя пользователя:'),
(23, 'Суполка:', 'Группа:'),
(24, 'Дата рэгістрацыі:', 'Дата регистрации:'),
(25, 'На галоўную', 'На главную'),
(26, 'вэбмайстар', 'вебмастер'),
(27, 'унутранная інфармацыя', 'внутренняя информация'),
(28, 'напішы нам', 'напиши нам'),
(29, 'Паўтарыце пароль:', 'Повторите пароль:');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `lang1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0',
  `in` int(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `num`, `lang1`, `lang2`, `link`, `published`, `in`) VALUES
(1, 0, 'Галоўная', 'Главная', '/', 1, 0),
(29, 4, 'Наша жыццё', 'Наша жизнь', '/gallery/', 1, 0),
(38, 3, 'Сведчанні', 'Отзывы', '/Otzyivyi/', 1, 0),
(39, 1, 'Пра нас', 'О нас', '/Istoriya/', 1, 0),
(40, 5, 'Даты рэкалекцый', 'Даты реколлекций', '/Datyi_rekolektsiy/', 1, 0),
(47, 7, 'Відэа', 'Видео', '/Video/', 1, 0),
(48, 8, 'Старонка аніматара', 'Страница аниматора', '/Staronka_animatara/', 1, 0),
(61, 1, 'Новости', '', '/news/', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`id` int(11) NOT NULL,
  `caption_lang1` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `caption_lang2` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `text_lang1` text COLLATE utf8_unicode_ci NOT NULL,
  `text_lang2` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `caption_lang1`, `caption_lang2`, `text_lang1`, `text_lang2`, `date`) VALUES
(56, 'xcvcxv', '', '<p>dsfsdf</p>\r\n', '', '2013-06-11 03:06:40'),
(64, 'xcxvxcv', '', '', '', '2013-08-30 22:05:35'),
(66, 'fgh', '', '', '', '2013-11-27 13:56:15');

-- --------------------------------------------------------

--
-- Структура таблицы `news_comments`
--

CREATE TABLE IF NOT EXISTS `news_comments` (
`id` int(11) NOT NULL,
  `text` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `news_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Комментарии к новостям';

--
-- Дамп данных таблицы `news_comments`
--

INSERT INTO `news_comments` (`id`, `text`, `news_id`, `users_id`, `datetime`) VALUES
(19, '222 333', 55, 39, '2013-08-26 00:12:08'),
(21, 'dfgdfgdfg', 55, 56, '2013-08-26 00:13:45'),
(22, 'mmm', 55, 39, '2015-02-01 23:22:21'),
(23, 'ddd', 64, 39, '2015-02-06 00:47:46');

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE IF NOT EXISTS `page` (
`id` int(11) NOT NULL,
  `lang1` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `lang2` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `text_lang1` longtext COLLATE utf8_unicode_ci NOT NULL,
  `text_lang2` longtext COLLATE utf8_unicode_ci NOT NULL,
  `in_menu` int(11) NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL,
  `edit_date` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=225 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `lang1`, `lang2`, `link`, `text_lang1`, `text_lang2`, `in_menu`, `access`, `edit_date`) VALUES
(1, 'Галоўная старонка', 'Главная страница', '', '', '', 0, 0, '2012-04-25 18:57:17'),
(120, 'ПРАВАЯ КОЛОНКА', 'ПРАВАЯ КОЛОНКА', 'RightSideBar', '', '', 0, 0, '2012-04-12 10:04:33'),
(196, 'Сямейны альбом &quot;Сужэнских Сустрэч&quot;', 'Семейный альбом &quot;Супружеских Встреч&quot;', 'gallery', '', '', 1, 0, '2012-04-28 22:19:43'),
(206, 'Кантакты', 'Контакты', 'Kantaktyi', '', '', 1, 0, '2013-03-25 20:49:01'),
(207, 'Відэа', 'Видео', 'video', '&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;/ckeditor/kcfinder/upload/images/7.jpg&quot; style=&quot;height:519px; width:778px&quot; /&gt;&lt;img alt=&quot;&quot; src=&quot;/ckeditor/kcfinder/upload/images/001_small.jpg&quot; style=&quot;height:327px; width:490px&quot; /&gt;&lt;/p&gt;\r\n', '', 1, 0, '2015-02-01 23:09:00'),
(208, 'Старонка аніматара', 'Страница аниматора', 'Staronka_animatara', '', '', 1, 0, '2013-01-30 15:24:24'),
(212, 'Новости', 'Новости', 'news', '', '', 1, 0, '2013-08-18 23:06:33');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id` int(11) NOT NULL,
  `lang1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lang2` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `lang1`, `lang2`) VALUES
(1, 'Адміністратар', 'Администратор'),
(2, 'Мадэратар', 'Модератор'),
(3, 'Карыстальнік', 'Пользователь'),
(4, 'Аніматар', 'Аниматор');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id` int(11) NOT NULL,
  `siteName` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `siteHeader` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `siteFooter` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `metaTitle` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `metaKeywords` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `metaDescription` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `metaCharset` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Настройки сайта';

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `siteName`, `siteHeader`, `siteFooter`, `metaTitle`, `metaKeywords`, `metaDescription`, `metaCharset`) VALUES
(1, 'Сужэнскія сустрэчы', 'Сужэнскія сустрэчы', '© 2012 <b>Сужэнскія сустрэчы.</b> Усе правы абаронены.', 'Сужэнскія сустрэчы', 'Сужэнскія сустрэчы', 'Сужэнскія сустрэчы', 'utf-8'),
(2, 'Супружеские встречи', 'Супружеские встречи', '© 2012 <b>Супружеские встречи.</b> Все права защищены.', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `login` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pass` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ava` text COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `datreg` datetime NOT NULL,
  `group` int(11) NOT NULL,
  `active` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `email`, `name`, `last_name`, `ava`, `sex`, `datreg`, `group`, `active`) VALUES
(39, 'kranon', '42afa6be3e1bcd3efc32a0277d56d9d87e54cf44', 'kranon@tut.by', '', '', 'default.png', 'men', '2012-02-29 16:42:39', 1, 'Y'),
(56, 'andrey', '9b3210c187cd32ccfa9f98e5c57e437e3a2a487f', 'asa@iuiu.df', '', '', 'default.png', 'men', '2013-08-31 00:50:40', 3, 'N');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `language`
--
ALTER TABLE `language`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news_comments`
--
ALTER TABLE `news_comments`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `fk_news_comments_news1` (`news_id`), ADD KEY `fk_news_comments_users1` (`users_id`);

--
-- Индексы таблицы `page`
--
ALTER TABLE `page`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_users_role1` (`group`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=155;
--
-- AUTO_INCREMENT для таблицы `language`
--
ALTER TABLE `language`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT для таблицы `news_comments`
--
ALTER TABLE `news_comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `page`
--
ALTER TABLE `page`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=225;
--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
