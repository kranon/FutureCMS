-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 23 2015 г., 14:43
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
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `name_lang1`, `name_lang2`, `link`, `date`, `num`, `album_year`) VALUES
(154, 'eeee', '', 'eeee', '2015-02-05', 1, 0000);

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_img`
--

CREATE TABLE IF NOT EXISTS `gallery_img` (
`id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `link` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `gallery_img`
--

INSERT INTO `gallery_img` (`id`, `album_id`, `link`, `sort`, `create_date`) VALUES
(30, 154, 'Empty Space by Glenn Rayat.jpg', 1, '2015-02-25 00:54:47'),
(31, 154, 'Golden leaves by Mauro Campanelli.jpg', 0, '2015-02-25 00:54:48'),
(32, 154, 'Horses on sand dunes by Matthias Siewert.jpg', 2, '2015-02-25 00:54:48'),
(33, 154, 'Kronach leuchtet 2014 by Brian Fox.jpg', 3, '2015-02-25 00:54:48'),
(34, 154, 'Utopic Unicorn  by Bedis ElAchКche.jpg', 4, '2015-02-25 00:55:28');

-- --------------------------------------------------------

--
-- Структура таблицы `language`
--

CREATE TABLE IF NOT EXISTS `language` (
`id` int(11) NOT NULL,
  `lang1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lang2` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `language`
--

INSERT INTO `language` (`id`, `lang1`, `lang2`) VALUES
(1, 'Аўтарызацыя', 'Авторизация'),
(2, 'Рэгістрацыя', 'Регистрация'),
(3, 'Панэль адміністратара', 'Панель администратора'),
(4, 'Выйсці', 'Выйти'),
(5, 'Падрабязней', 'Подробней'),
(6, 'Логін', 'Логин'),
(7, 'Пароль', 'Пароль'),
(8, 'E-mail', 'E-mail'),
(9, 'Абярыце аватар:', 'Выберите аватар:'),
(10, 'Абярыце пол:', 'Выберите пол:'),
(11, 'Мужчынскі', 'Мужской'),
(12, 'Жаночы', 'Женский'),
(13, 'Вашэ імя', 'Ваше имя'),
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
(29, 'Паўтарыце пароль', 'Повторите пароль'),
(30, 'Iмя', 'Имя'),
(31, 'Прозвішча', 'Фамилия'),
(32, 'Змяніць пароль', 'Сменить пароль'),
(33, 'Вы не можаце пакідаць каментары, таму што ваш акаунт заблакіраваны адміністратарам!', 'Вы не можете оставлять комментарии, т.к. ваш аккаунт заблокирован администратором!');

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
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `num`, `lang1`, `lang2`, `link`, `published`, `in`) VALUES
(1, 0, 'Галоўная', 'Главная', '/', 1, 0),
(29, 4, 'Наша жыццё', 'Наша жизнь', '/gallery/', 1, 0),
(61, 2, 'Новости', 'Навины', '/news/', 1, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `caption_lang1`, `caption_lang2`, `text_lang1`, `text_lang2`, `date`) VALUES
(67, 'test', '', '', '', '2015-02-14 21:56:13');

-- --------------------------------------------------------

--
-- Структура таблицы `news_comments`
--

CREATE TABLE IF NOT EXISTS `news_comments` (
`id` int(11) NOT NULL,
  `text` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `news_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Комментарии к новостям';

--
-- Дамп данных таблицы `news_comments`
--

INSERT INTO `news_comments` (`id`, `text`, `news_id`, `users_id`, `datetime`) VALUES
(19, '222 333', 55, 39, '2013-08-26 00:12:08'),
(21, 'dfgdfgdfg', 55, 56, '2013-08-26 00:13:45'),
(22, 'mmm', 55, 39, '2015-02-01 23:22:21'),
(23, 'ddd', 64, 39, '2015-02-06 00:47:46'),
(24, 'asd asd ad a d a da ds a dsa d a d d d  dddsf', 70, 39, '2015-02-21 20:29:01'),
(25, 'xcvcxv,sdfsd ''fff'' jjj "dddd"', 70, 69, '2015-03-19 16:52:58');

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
  `access` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `edit_date` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=234 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `lang1`, `lang2`, `link`, `text_lang1`, `text_lang2`, `in_menu`, `access`, `edit_date`) VALUES
(1, 'Галоўная старонка', 'Главная страница', '/', '&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;text-align:center&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/image/ikonaspotkanmalz_1.gif&quot; style=&quot;height:300px; width:300px&quot; /&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;text-align:center&quot;&gt;&lt;span style=&quot;font-size:large&quot;&gt;&lt;em&gt;&lt;strong&gt;&lt;cite&gt;&lt;span style=&quot;color:#ff6600&quot;&gt;Абраз Сужэнскіх Сустрэч&lt;/span&gt;&lt;/cite&gt;&lt;/strong&gt;&lt;/em&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;text-align:center&quot;&gt;&lt;span style=&quot;color:#993300&quot;&gt;&lt;span style=&quot;font-size:small&quot;&gt;&lt;em&gt;&lt;strong&gt;&lt;cite&gt;&lt;span style=&quot;font-size:medium&quot;&gt;Трывайце ў Маёй любові (Ян 15,9)&lt;/span&gt;&lt;/cite&gt;&lt;/strong&gt;&lt;/em&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;text-align:center&quot;&gt;&lt;span style=&quot;color:#ff6600&quot;&gt;&lt;span style=&quot;font-size:medium&quot;&gt;Жадаеце&lt;/span&gt;&amp;nbsp;&lt;span style=&quot;font-size:medium&quot;&gt;радавацца сужэнскаму жыццю, перажыць яскравасць узаемных пачуццяў, паглыбіць сваё каханне альбо адкрыць яго нанова?&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;text-align:center&quot;&gt;&lt;span style=&quot;color:#800000&quot;&gt;&lt;span style=&quot;font-size:medium&quot;&gt;Запрашаем на Сужэнскія сустрэчы !&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &lt;strong&gt; &lt;a href=&quot;http://suvstrechi.by/Datyi_rekolektsiy.php&quot; style=&quot;color:#FF0000;&quot;&gt;13 - 15 сакавіка 2015 г. ў г. Орша&lt;/a&gt; &lt;/strong&gt; &amp;nbsp;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp; &lt;strong&gt; &lt;a href=&quot;http://suvstrechi.by/Datyi_rekolektsiy.php&quot; style=&quot;color:#FF0000;&quot;&gt;20 - 22 сакавіка 2015 г. ў в. Ляскоўка (Бараўляны)&lt;/a&gt; &lt;/strong&gt; &amp;nbsp; &amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp; &lt;strong&gt; &lt;a href=&quot;http://suvstrechi.by/Datyi_rekolektsiy.php&quot; style=&quot;color:#FF0000;&quot;&gt;27 - 29 сакавіка 2015г. ў г. Баранавічы &lt;/a&gt; &lt;/strong&gt; &amp;nbsp; &amp;nbsp;&lt;/p&gt;\r\n', '&lt;p style=&quot;text-align:center&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;/image/ikonaspotkanmalz_1.gif&quot; style=&quot;height:300px; width:300px&quot; /&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;text-align:center&quot;&gt;&lt;span style=&quot;font-size:large&quot;&gt;&lt;span style=&quot;color:#ff6600&quot;&gt;&lt;strong&gt;&lt;cite&gt;Икона Супружеских Встреч&lt;/cite&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;text-align:center&quot;&gt;&lt;span style=&quot;color:#993300&quot;&gt;&lt;span style=&quot;font-size:medium&quot;&gt;&lt;cite&gt;Пребудьте в любви Моей (Иоанн 15,9)&lt;/cite&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;text-align:center&quot;&gt;&lt;span style=&quot;color:#ff6600&quot;&gt;&lt;cite&gt;&lt;span style=&quot;font-size:medium&quot;&gt;Хотите радоваться супружеской жизни, пережить свежесть взаимных чувств, углубить свою любовь либо открыть её заново?&lt;/span&gt;&lt;/cite&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;text-align:center&quot;&gt;&lt;span style=&quot;color:#800000&quot;&gt;&lt;cite&gt;&lt;span style=&quot;font-size:medium&quot;&gt;Приглашаем на Супружеские встречи &lt;/span&gt;&lt;/cite&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp; &lt;span style=&quot;color:#FF0000&quot;&gt; &lt;a href=&quot;http://suvstrechi.by/Datyi_rekolektsiy.php&quot; style=&quot;color:#FF0000;&quot;&gt;13 - 15 марта 2015 г. в г. Орша &lt;/a&gt; &lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp; &lt;span style=&quot;color:#FF0000&quot;&gt; &lt;a href=&quot;http://suvstrechi.by/Datyi_rekolektsiy.php&quot; style=&quot;color:#FF0000;&quot;&gt;20 - 22 марта 2015 г. в д. Лесковка (Боровляны)&lt;/a&gt; &lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp; &lt;span style=&quot;color:#FF0000&quot;&gt; &lt;a href=&quot;http://suvstrechi.by/Datyi_rekolektsiy.php&quot; style=&quot;color:#FF0000;&quot;&gt;27 - 29 марта 2015г. &amp;nbsp;в г. Барановичи&lt;/a&gt; &lt;/span&gt;&lt;/p&gt;\r\n', 1, 'a:1:{i:0;s:3:"all";}', '2015-03-07 02:39:28'),
(120, 'ПРАВАЯ КОЛОНКА', 'ПРАВАЯ КОЛОНКА', 'RightSideBar', '', '', 0, 'a:1:{i:0;s:3:"all";}', '2012-04-12 10:04:33'),
(196, 'Сямейны альбом &quot;Сужэнских Сустрэч&quot;', 'Семейный альбом &quot;Супружеских Встреч&quot;', 'gallery', '', '', 1, 'a:1:{i:0;s:3:"all";}', '2015-03-07 02:23:24'),
(212, 'Новости', 'Новости', 'news', '', '', 1, 'a:1:{i:0;s:3:"all";}', '2015-03-19 11:40:36');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id` int(11) NOT NULL,
  `lang1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lang2` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `gallery_img_width` int(11) NOT NULL,
  `gallery_img_height` int(11) NOT NULL,
  `feedback_emails` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Настройки сайта';

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `gallery_img_width`, `gallery_img_height`, `feedback_emails`) VALUES
(1, 1500, 1000, 'beshion@mail.ru');

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
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `email`, `name`, `last_name`, `ava`, `sex`, `datreg`, `group`, `active`) VALUES
(39, 'kranon', '097c08d39f1b9c65f995b60df0a39aa5a7156b29', 'kranon@tut.by', 'Andrey', 'Sobko', 'kranon.jpg', 'men', '2012-02-29 16:42:39', 1, 'Y');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery_img`
--
ALTER TABLE `gallery_img`
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=157;
--
-- AUTO_INCREMENT для таблицы `gallery_img`
--
ALTER TABLE `gallery_img`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT для таблицы `language`
--
ALTER TABLE `language`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT для таблицы `news_comments`
--
ALTER TABLE `news_comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT для таблицы `page`
--
ALTER TABLE `page`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=234;
--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=70;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
