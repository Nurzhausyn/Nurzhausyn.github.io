-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июнь 18 2015 г., 15:07
-- Версия сервера: 5.1.54
-- Версия PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `adress`
--

CREATE TABLE IF NOT EXISTS `adress` (
  `id_user` int(11) NOT NULL,
  `id_country` int(11) NOT NULL,
  `id_city` int(11) NOT NULL,
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `adress`
--

INSERT INTO `adress` (`id_user`, `id_country`, `id_city`) VALUES
(66, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `birthday`
--

CREATE TABLE IF NOT EXISTS `birthday` (
  `id_user` int(11) NOT NULL,
  `day` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `mounth` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `birthday`
--

INSERT INTO `birthday` (`id_user`, `day`, `mounth`, `year`) VALUES
(66, '29', '9', '2007');

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id_city` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(24) CHARACTER SET utf8 NOT NULL,
  `id_country` int(11) NOT NULL,
  PRIMARY KEY (`id_city`),
  KEY `id_country` (`id_country`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id_city`, `name`, `id_country`) VALUES
(1, 'New York', 1),
(2, 'California', 1),
(3, 'Illinois', 1),
(4, 'Florida', 1),
(5, 'Pennsylvania', 1),
(6, 'Astana', 2),
(7, 'Almaty', 2),
(8, 'Otar', 2),
(9, 'Karaganda', 2),
(10, 'Kokshetau', 2);

-- --------------------------------------------------------
--
-- Структура таблицы `main`
--

CREATE TABLE IF NOT EXISTS `main` (
  `id_number` int(6) NOT NULL AUTO_INCREMENT,
  `model` varchar(32) CHARACTER SET utf8 NOT NULL,
  `tipe` varchar(32) CHARACTER SET utf8 NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id_number`),
  KEY `id_tipe` (`id_tipe`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `main`
--

INSERT INTO `main` (`id_number`, `model`, `tipe`, `price`) VALUES
(1,'Kupe', 'cupboard', 100000),
(2,'Rotang', 'cupboard', 112000),
(3,'ATLANTA', 'sofa', 132000),
(4,'Memfis', 'sofa', 115000),
(5,'latches', 'furnitura', 1000),
(6,'pens', 'furnitura', 2000),
(7,'guides for drawers', 'furnitura', 2500);
-- --------------------------------------------------------
--
-- Структура таблицы `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `id_number` int(6) NOT NULL AUTO_INCREMENT,
  `tipe` varchar(32) CHARACTER SET utf8 NOT NULL,
  `color` varchar(32) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_number`),
  KEY `id_tipe` (`id_tipe`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `material`
--

INSERT INTO `material` (`id_number`, `tipe`, `color`) VALUES
(1, 'cupboard', red),
(2, 'cupboard', yellow),
(3, 'sofa', black),
(4, 'sofa', magenta),
(5, 'furnitura', blue),
(6, 'furnitura', green),
(7, 'furnitura', cyan);
-- --------------------------------------------------------
--
-- Структура таблицы `manufacturer`
--

CREATE TABLE IF NOT EXISTS `manufacturer` (
  `id_number` int(6) NOT NULL AUTO_INCREMENT,
  `tipe` varchar(32) CHARACTER SET utf8 NOT NULL,
  `firm` varchar(32) CHARACTER SET utf8 NOT NULL,
  `country` int(11) NOT NULL,
  PRIMARY KEY (`id_number`),
  KEY `id_firm` (`id_firm`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `manufacturer`
--

INSERT INTO `manufacturer` (`id_number`, `tipe`, `firm`, `country`) VALUES
(1, 'cupboard','Kupe', Russia),
(2, 'cupboard','Rotang', Norway),
(3, 'sofa','ATLANTA', Usa),
(4, 'sofa','Memfis', Canada),
(5, 'furnitura','latches', China),
(6, 'furnitura','pens',England),
(7, 'furnitura','guides for drawers', Kazakhstan);
-- --------------------------------------------------------
--
-- Структура таблицы `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id_country` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_country`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`id_country`, `name`) VALUES
(1, 'Usa'),
(2, 'Kazakhstan');

-- --------------------------------------------------------

--
-- Структура таблицы `link`
--

CREATE TABLE IF NOT EXISTS `link` (
  `id_user` int(11) NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `link`
--

INSERT INTO `link` (`id_user`, `phone`, `mail`) VALUES
(66, '+7-727-2656', 'test@test.ts');
-- --------------------------------------------------------

--
-- Структура таблицы `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id_user` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=74 ;

--
-- Дамп данных таблицы `members`
--

INSERT INTO `members` (`id_user`, `login`, `password`) VALUES
(66, 'test', '3718793147bec822f500fda099a2e7b9');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id_session` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `sid` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `time_start` datetime NOT NULL,
  `time_last` datetime NOT NULL,
  PRIMARY KEY (`id_session`),
  UNIQUE KEY `sid` (`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=325 ;

--
-- Дамп данных таблицы `sessions`
--

