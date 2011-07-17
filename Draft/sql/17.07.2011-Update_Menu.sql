-- phpMyAdmin SQL Dump
-- version 3.4.1-rc1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 17. Jul 2011 um 20:23
-- Server Version: 5.5.8
-- PHP-Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `silexboard`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu`
--

UPDATE  `silexboard`.`menu` SET  `MenuName` =  'com.sbb.menu.home' WHERE  `menu`.`ID` =1;
UPDATE  `silexboard`.`menu` SET  `MenuName` =  'com.sbb.menu.forum' WHERE  `menu`.`ID` =2;
UPDATE  `silexboard`.`menu` SET  `MenuName` =  'com.sbb.menu.userlist' WHERE  `menu`.`ID` =3;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
