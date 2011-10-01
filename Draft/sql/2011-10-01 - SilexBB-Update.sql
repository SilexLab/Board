-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 01. Okt 2011 um 22:59
-- Server Version: 5.5.15
-- PHP-Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `silexboard`
--

--
-- Daten für Tabelle `board`
--

INSERT INTO `board` (`ID`, `ParentID`, `Type`, `Title`, `Description`, `Link`, `Position`, `Image`, `ImageNew`, `Prefixes`, `PrefixesRequired`, `Views`, `Threads`, `Posts`, `MarkingAsDone`, `Closed`, `Invisible`, `News`) VALUES
(1, 0, 0, 'Hauptforum', '123', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(2, 1, 1, 'UnterForum', 'aaaa', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Daten für Tabelle `thread`
--

INSERT INTO `thread` (`ID`, `BoardID`, `PostID`, `UserID`, `Prefix`, `Topic`, `Message`, `Time`, `LastPostID`, `LastPostTime`, `Replies`, `Views`, `Sticky`, `Disabled`, `Closed`, `Deleted`, `DeleteReason`, `DeleteTime`) VALUES
(1, 2, 1, 1, '', 'test', 'Das hier ist text. omg!', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
