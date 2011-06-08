-- phpMyAdmin SQL Dump
-- version 3.4.1-rc1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 08. Jun 2011 um 14:08
-- Server Version: 5.5.8
-- PHP-Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `silexboard`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MenuName` varchar(32) NOT NULL,
  `Link` text NOT NULL,
  `Position` int(11) NOT NULL,
  `Permissions` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `menu`
--

INSERT INTO `menu` (`ID`, `MenuName`, `Link`, `Position`, `Permissions`) VALUES
(1, 'Home', './', 1, ''),
(2, 'Forum', '?page=Forum', 2, ''),
(3, 'Userlist', '?page=User', 3, '');