-- phpMyAdmin SQL Dump
-- version 3.4.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 08. Jun 2011 um 21:51
-- Server Version: 5.1.46
-- PHP-Version: 5.3.2

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
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(32) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Salt` varchar(250) NOT NULL,
  `GroupID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Homepage` varchar(100) NOT NULL,
  `Signatur` text NOT NULL,
  `ActivationKey` varchar(32) NOT NULL,
  `Language` varchar(16) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `IsBanned` tinyint(1) NOT NULL,
  `RegisterTime` int(32) NOT NULL,
  `OnlineTime` int(32) NOT NULL,
  `Request` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
