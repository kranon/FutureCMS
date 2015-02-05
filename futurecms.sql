-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2014 at 01:41 AM
-- Server version: 5.5.34-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `futurecms`
--

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_lang1` text COLLATE utf8_unicode_ci NOT NULL,
  `name_lang2` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `num` int(11) NOT NULL,
  `album_year` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=124 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `name_lang1`, `name_lang2`, `link`, `date`, `num`, `album_year`) VALUES
(116, 'Альбом 1', 'Альбом 2', 'xxx', '2013-06-11', 0, 2014),
(121, 'sadasd', '', 'sadasd', '2013-08-30', 0, 0000);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `language`
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
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` int(11) NOT NULL,
  `lang1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0',
  `in` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=60 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `num`, `lang1`, `lang2`, `link`, `published`, `in`) VALUES
(1, 0, 'Галоўная', 'Главная', '/', 1, 0),
(5, 2, 'Нашы навіны', 'Наши новости', '/news/', 1, 0),
(29, 4, 'Наша жыццё', 'Наша жизнь', '/galery/', 1, 0),
(38, 3, 'Сведчанні', 'Отзывы', '/Otzyivyi/', 1, 0),
(39, 1, 'Пра нас', 'О нас', '/Istoriya/', 1, 0),
(40, 5, 'Даты рэкалекцый', 'Даты реколлекций', '/Datyi_rekolektsiy/', 1, 0),
(47, 7, 'Відэа', 'Видео', '/Video/', 1, 0),
(45, 6, 'Кантакты', 'Контакты', '/Kantaktyi/', 1, 0),
(48, 8, 'Старонка аніматара', 'Страница аниматора', '/Staronka_animatara/', 1, 0),
(51, 9, 'Увага !!!', 'Внимание !!!', '/Uvaga!!!/', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption_lang1` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `caption_lang2` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `text_lang1` text COLLATE utf8_unicode_ci NOT NULL,
  `text_lang2` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=67 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `caption_lang1`, `caption_lang2`, `text_lang1`, `text_lang2`, `date`) VALUES
(55, 'dsdsd', 'czxczxczcz', '<p>zxczxczx&nbsp;</p>', '<p>czczczc&nbsp;</p>', '2013-06-09 20:01:30'),
(56, 'xcvcxv', '', '', '', '2013-06-11 03:06:40'),
(64, 'xcxvxcv', '', '', '', '2013-08-30 22:05:35'),
(66, 'fgh', '', '', '', '2013-11-27 13:56:15');

-- --------------------------------------------------------

--
-- Table structure for table `news_comments`
--

CREATE TABLE IF NOT EXISTS `news_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `news_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_news_comments_news1` (`news_id`),
  KEY `fk_news_comments_users1` (`users_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Комментарии к новостям' AUTO_INCREMENT=22 ;

--
-- Dumping data for table `news_comments`
--

INSERT INTO `news_comments` (`id`, `text`, `news_id`, `users_id`, `datetime`) VALUES
(19, '222 333', 55, 39, '2013-08-26 00:12:08'),
(21, 'dfgdfgdfg', 55, 500000000, '2013-08-26 00:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang1` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `lang2` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `text_lang1` longtext COLLATE utf8_unicode_ci NOT NULL,
  `text_lang2` longtext COLLATE utf8_unicode_ci NOT NULL,
  `in_menu` int(11) NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL,
  `edit_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=225 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `lang1`, `lang2`, `link`, `text_lang1`, `text_lang2`, `in_menu`, `access`, `edit_date`) VALUES
(1, 'Галоўная старонка', 'Главная страница', '', '', '', 0, 0, '2012-04-25 18:57:17'),
(120, 'ПРАВАЯ КОЛОНКА', 'ПРАВАЯ КОЛОНКА', 'RightSideBar', '', '', 0, 0, '2012-04-12 10:04:33'),
(159, 'Аб карыстальніку', 'О пользователе', 'O_polzovatele', '', '', 0, 0, '2012-04-12 10:04:13'),
(196, 'Сямейны альбом &quot;Сужэнских Сустрэч&quot;', 'Семейный альбом &quot;Супружеских Встреч&quot;', 'galery', '', '', 1, 0, '2012-04-28 22:19:43'),
(206, 'Кантакты', 'Контакты', 'Kantaktyi', '', '', 0, 0, '2013-03-25 20:49:01'),
(207, 'Відэа', 'Видео', 'video', '<p>sdfsdfsdfs&nbsp;</p>', '', 1, 0, '2013-08-16 01:49:44'),
(208, 'Старонка аніматара', 'Страница аниматора', 'Staronka_animatara', '', '', 1, 0, '2013-01-30 15:24:24'),
(212, 'Новости', 'Новости', 'news', '', '', 0, 0, '2013-08-18 23:06:33');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lang2` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `lang1`, `lang2`) VALUES
(1, 'Адміністратар', 'Администратор'),
(2, 'Мадэратар', 'Модератор'),
(3, 'Карыстальнік', 'Пользователь'),
(4, 'Аніматар', 'Аниматор');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siteName` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `siteHeader` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `siteFooter` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `metaTitle` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `metaKeywords` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `metaDescription` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `metaCharset` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Настройки сайта' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `siteName`, `siteHeader`, `siteFooter`, `metaTitle`, `metaKeywords`, `metaDescription`, `metaCharset`) VALUES
(1, 'Сужэнскія сустрэчы', 'Сужэнскія сустрэчы', '© 2012 <b>Сужэнскія сустрэчы.</b> Усе правы абаронены.', 'Сужэнскія сустрэчы', 'Сужэнскія сустрэчы', 'Сужэнскія сустрэчы', 'utf-8'),
(2, 'Супружеские встречи', 'Супружеские встречи', '© 2012 <b>Супружеские встречи.</b> Все права защищены.', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pass` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ava` text COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `datreg` datetime NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_role1` (`group`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=57 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `email`, `ava`, `sex`, `datreg`, `group`) VALUES
(39, 'kranon', 'd214a7aafe42a41fe59216827bd11f6e03cc93f2', 'kranon@tut.by', 'default.png', 'men', '2012-02-29 16:42:39', 1),
(56, 'andrey', '9b3210c187cd32ccfa9f98e5c57e437e3a2a487f', 'asa@iuiu.df', 'default.png', 'men', '2013-08-31 00:50:40', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
