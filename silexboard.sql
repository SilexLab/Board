-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 03. April 2011 um 20:19
-- Server Version: 5.1.41
-- PHP-Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `silexboard`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `acp_sessions`
--

DROP TABLE IF EXISTS `acp_sessions`;
CREATE TABLE IF NOT EXISTS `acp_sessions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Time` int(32) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Salt` varchar(300) NOT NULL,
  `IP` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `acp_sessions`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(32) NOT NULL,
  `Description` text NOT NULL,
  `Position` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `categories`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `ConfigName` varchar(32) NOT NULL,
  `ConfigValue` text NOT NULL,
  KEY `ConfigName` (`ConfigName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `config`
--

INSERT INTO `config` (`ConfigName`, `ConfigValue`) VALUES
('Site', 'Seitentitel'),
('Slogan', 'Der Slogan der Webseite');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `forums`
--

DROP TABLE IF EXISTS `forums`;
CREATE TABLE IF NOT EXISTS `forums` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Category` int(11) NOT NULL,
  `ForumName` varchar(32) NOT NULL,
  `Description` text NOT NULL,
  `Permission` longtext NOT NULL,
  `State` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `forums`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(32) NOT NULL,
  `Image` text NOT NULL,
  `Color` varchar(8) NOT NULL,
  `Icon` text NOT NULL,
  `Permission` longtext NOT NULL,
  `Standard` tinyint(2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `groups`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `guests`
--

DROP TABLE IF EXISTS `guests`;
CREATE TABLE IF NOT EXISTS `guests` (
  `IP` varchar(32) NOT NULL,
  `Time` int(32) NOT NULL,
  KEY `IP` (`IP`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `guests`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hits`
--

DROP TABLE IF EXISTS `hits`;
CREATE TABLE IF NOT EXISTS `hits` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IP` varchar(32) NOT NULL,
  `Date` int(32) NOT NULL,
  `Count` int(20) NOT NULL,
  `Banned` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `hits`
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
  `Permissions` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `menu`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pns`
--

DROP TABLE IF EXISTS `pns`;
CREATE TABLE IF NOT EXISTS `pns` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `AuthorID` int(11) NOT NULL,
  `Title` varchar(32) NOT NULL,
  `Text` text NOT NULL,
  `Date` int(32) NOT NULL,
  `Read` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `pns`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `polls`
--

DROP TABLE IF EXISTS `polls`;
CREATE TABLE IF NOT EXISTS `polls` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TopicID` int(11) NOT NULL,
  `Polls` text NOT NULL,
  `PollClose` tinyint(1) NOT NULL,
  `PollTime` int(11) NOT NULL,
  `Voted` longtext NOT NULL,
  `Open` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `polls`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TopicID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostTitle` varchar(32) NOT NULL,
  `Date` int(32) NOT NULL,
  `Text` text NOT NULL,
  `Edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `posts`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Time` int(32) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Salt` varchar(300) NOT NULL,
  `IP` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `sessions`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TopicTitle` varchar(32) NOT NULL,
  `ForumID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TopicRead` longtext NOT NULL,
  `TopicPage` int(11) NOT NULL,
  `Views` int(11) NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `Important` tinyint(4) NOT NULL,
  `Date` int(32) NOT NULL,
  `Text` text NOT NULL,
  `Edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `topics`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

DROP TABLE IF EXISTS `users`;
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
  `IsActive` tinyint(1) NOT NULL,
  `IsBanned` tinyint(1) NOT NULL,
  `RegisterTime` int(32) NOT NULL,
  `OnlineTime` int(32) NOT NULL,
  `Request` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `users`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
