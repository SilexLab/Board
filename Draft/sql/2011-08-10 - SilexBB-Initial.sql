-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 10. Aug 2011 um 17:56
-- Server Version: 5.5.14
-- PHP-Version: 5.3.6

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
-- Tabellenstruktur für Tabelle `acp_session`
--

CREATE TABLE IF NOT EXISTS `acp_session` (
  `ID` int(11) NOT NULL,
  `UserID` mediumint(9) NOT NULL,
  `Username` varchar(32) NOT NULL,
  `IPAddress` varchar(64) NOT NULL,
  `UserAgent` tinytext NOT NULL,
  `LastActivityTime` int(11) NOT NULL,
  `Token` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `board`
--

CREATE TABLE IF NOT EXISTS `board` (
  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `ParentID` mediumint(9) NOT NULL,
  `Type` tinyint(4) NOT NULL,
  `Title` varchar(64) NOT NULL,
  `Description` text NOT NULL,
  `Link` text NOT NULL,
  `Position` tinyint(4) NOT NULL,
  `Image` text NOT NULL,
  `ImageNew` text NOT NULL,
  `Prefixes` text NOT NULL,
  `PrefixesRequired` tinyint(1) NOT NULL DEFAULT '0',
  `Views` int(11) NOT NULL,
  `Threads` int(11) NOT NULL,
  `Posts` int(11) NOT NULL,
  `MarkingAsDone` tinyint(1) NOT NULL DEFAULT '0',
  `Closed` tinyint(1) NOT NULL DEFAULT '0',
  `Invisible` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `board_last_post`
--

CREATE TABLE IF NOT EXISTS `board_last_post` (
  `BoardID` mediumint(9) NOT NULL,
  `ThreadID` mediumint(9) NOT NULL,
  PRIMARY KEY (`BoardID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `board_permissions_group`
--

CREATE TABLE IF NOT EXISTS `board_permissions_group` (
  `BoardID` mediumint(9) NOT NULL,
  `GroupID` mediumint(9) NOT NULL,
  `CanViewBoard` tinyint(1) NOT NULL DEFAULT '1',
  `CanEnterBoard` tinyint(1) NOT NULL DEFAULT '1',
  `CanViewThread` tinyint(1) NOT NULL DEFAULT '1',
  `CanReadThread` tinyint(1) NOT NULL DEFAULT '1',
  `CanReadOwnThread` tinyint(1) NOT NULL DEFAULT '1',
  `CanStartThread` tinyint(1) NOT NULL DEFAULT '1',
  `CanReplyThread` tinyint(1) NOT NULL DEFAULT '1',
  `StartThreadModerated` tinyint(1) NOT NULL DEFAULT '0',
  `ReplyThreadModerated` tinyint(1) NOT NULL DEFAULT '0',
  `CanStartPoll` tinyint(1) NOT NULL DEFAULT '1',
  `CanVotePoll` tinyint(1) NOT NULL DEFAULT '1',
  `CanRatePost` tinyint(1) NOT NULL DEFAULT '1',
  `CanUsePrefix` tinyint(1) NOT NULL DEFAULT '1',
  `CanDeletePost` tinyint(1) NOT NULL DEFAULT '1',
  `CanEditPost` tinyint(1) NOT NULL DEFAULT '1',
  `CanMarkAsDone` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`BoardID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `board_permissions_user`
--

CREATE TABLE IF NOT EXISTS `board_permissions_user` (
  `BoardID` mediumint(9) NOT NULL,
  `UserID` mediumint(9) NOT NULL,
  `CanViewBoard` tinyint(1) NOT NULL DEFAULT '1',
  `CanEnterBoard` tinyint(1) NOT NULL DEFAULT '1',
  `CanViewThread` tinyint(1) NOT NULL DEFAULT '1',
  `CanReadThread` tinyint(1) NOT NULL DEFAULT '1',
  `CanReadOwnThread` tinyint(1) NOT NULL DEFAULT '1',
  `CanStartThread` tinyint(1) NOT NULL DEFAULT '1',
  `CanReplyThread` tinyint(1) NOT NULL DEFAULT '1',
  `StartThreadModerated` tinyint(1) NOT NULL DEFAULT '0',
  `ReplyThreadModerated` tinyint(1) NOT NULL DEFAULT '0',
  `CanStartPoll` tinyint(1) NOT NULL DEFAULT '1',
  `CanVotePoll` tinyint(1) NOT NULL DEFAULT '1',
  `CanRatePost` tinyint(1) NOT NULL DEFAULT '1',
  `CanUsePrefix` tinyint(1) NOT NULL DEFAULT '1',
  `CanDeletePost` tinyint(1) NOT NULL DEFAULT '1',
  `CanEditPost` tinyint(1) NOT NULL DEFAULT '1',
  `CanMarkAsDone` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`BoardID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `Type` varchar(16) NOT NULL,
  `ConfigVariable` varchar(32) NOT NULL,
  `ConfigValue` varchar(32) NOT NULL,
  `CategoryName` text NOT NULL,
  `ConfigName` text NOT NULL,
  PRIMARY KEY (`Type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `GroupName` text NOT NULL,
  `Image` text NOT NULL,
  `Color` varchar(8) NOT NULL,
  `Icon` text NOT NULL,
  `Type` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `group_permissions`
--

CREATE TABLE IF NOT EXISTS `group_permissions` (
  `GroupID` mediumint(9) NOT NULL,
  `PermissionID` mediumint(9) NOT NULL,
  `OptionValue` text NOT NULL,
  PRIMARY KEY (`GroupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Shortcut` varchar(4) NOT NULL,
  `Encoding` varchar(16) NOT NULL DEFAULT 'UTF-8',
  `Default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `ID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `MenuName` tinytext NOT NULL,
  `Target` tinytext NOT NULL,
  `Position` tinyint(4) NOT NULL,
  `Permission` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `PermissionName` text NOT NULL,
  `CategoryName` text NOT NULL,
  `Type` varchar(8) NOT NULL,
  `DefaultValue` text NOT NULL,
  `ModulName` text NOT NULL,
  `Position` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pm`
--

CREATE TABLE IF NOT EXISTS `pm` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ParentID` int(11) NOT NULL,
  `UserID` mediumint(9) NOT NULL,
  `AuthorID` mediumint(9) NOT NULL,
  `Subject` tinytext NOT NULL,
  `Message` text NOT NULL,
  `Time` int(11) NOT NULL,
  `Visited` tinyint(1) NOT NULL DEFAULT '0',
  `Draft` tinyint(1) NOT NULL DEFAULT '0',
  `Smileys` tinyint(1) NOT NULL DEFAULT '1',
  `HTML` tinyint(1) NOT NULL DEFAULT '0',
  `SilexCode` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `poll`
--

CREATE TABLE IF NOT EXISTS `poll` (
  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `Question` tinytext NOT NULL,
  `Description` text NOT NULL,
  `Time` int(11) NOT NULL,
  `EndTime` int(11) NOT NULL,
  `Choices` tinyint(4) NOT NULL,
  `VotesChangeable` tinyint(1) NOT NULL DEFAULT '1',
  `SortByResult` tinyint(1) NOT NULL DEFAULT '1',
  `Public` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `poll_options`
--

CREATE TABLE IF NOT EXISTS `poll_options` (
  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `PollID` mediumint(9) NOT NULL,
  `Option` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `poll_votes`
--

CREATE TABLE IF NOT EXISTS `poll_votes` (
  `OptionID` mediumint(9) NOT NULL,
  `UserID` mediumint(9) NOT NULL,
  PRIMARY KEY (`OptionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ThreadID` mediumint(9) NOT NULL,
  `UserID` mediumint(9) NOT NULL,
  `Subject` text NOT NULL,
  `Message` text NOT NULL,
  `Time` int(11) NOT NULL,
  `LastEdit` int(11) NOT NULL,
  `EditorID` mediumint(9) NOT NULL,
  `PollID` mediumint(9) NOT NULL,
  `IPAddress` varchar(64) NOT NULL,
  `Disabled` tinyint(1) NOT NULL DEFAULT '0',
  `Closed` tinyint(1) NOT NULL DEFAULT '0',
  `Deleted` tinyint(1) NOT NULL DEFAULT '0',
  `DeleteReason` text NOT NULL,
  `DeleteTime` int(11) NOT NULL,
  `Smileys` tinyint(1) NOT NULL DEFAULT '1',
  `HTML` tinyint(1) NOT NULL DEFAULT '0',
  `SilexCode` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `ID` int(11) NOT NULL,
  `UserID` mediumint(9) NOT NULL,
  `Username` varchar(32) NOT NULL,
  `IPAddress` varchar(64) NOT NULL,
  `UserAgent` tinytext NOT NULL,
  `LastActivityTime` int(11) NOT NULL,
  `Token` tinytext NOT NULL,
  `LoginHash` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `smiley`
--

CREATE TABLE IF NOT EXISTS `smiley` (
  `ID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `Category` varchar(32) NOT NULL DEFAULT 'Default',
  `SmileyPath` tinytext NOT NULL,
  `SmileyTitle` varchar(32) NOT NULL,
  `SmileyCode` varchar(16) NOT NULL,
  `Position` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `thread`
--

CREATE TABLE IF NOT EXISTS `thread` (
  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `BoardID` mediumint(9) NOT NULL,
  `PostID` int(11) NOT NULL,
  `UserID` mediumint(9) NOT NULL,
  `Prefix` varchar(32) NOT NULL,
  `Topic` text NOT NULL,
  `Message` text NOT NULL,
  `Time` int(11) NOT NULL,
  `LastPostID` int(11) NOT NULL,
  `LastPostTime` int(11) NOT NULL,
  `Replies` int(11) NOT NULL,
  `Views` int(11) NOT NULL,
  `Sticky` tinyint(1) NOT NULL DEFAULT '0',
  `Disabled` tinyint(1) NOT NULL DEFAULT '0',
  `Closed` tinyint(1) NOT NULL DEFAULT '0',
  `Deleted` tinyint(1) NOT NULL DEFAULT '0',
  `DeleteReason` text NOT NULL,
  `DeleteTime` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `thread_visit`
--

CREATE TABLE IF NOT EXISTS `thread_visit` (
  `ThreadID` mediumint(9) NOT NULL,
  `UserID` mediumint(9) NOT NULL,
  `Time` int(11) NOT NULL,
  PRIMARY KEY (`ThreadID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(32) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Salt` varchar(64) NOT NULL,
  `GroupID` mediumint(9) NOT NULL,
  `Email` text NOT NULL,
  `ActivationKey` varchar(16) NOT NULL,
  `RegisterTime` int(11) NOT NULL,
  `OnlineTime` int(11) NOT NULL,
  `Banned` tinyint(1) NOT NULL DEFAULT '0',
  `Homepage` text NOT NULL,
  `Signatur` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_permissions`
--

CREATE TABLE IF NOT EXISTS `user_permissions` (
  `UserID` mediumint(9) NOT NULL,
  `PermissionID` mediumint(9) NOT NULL,
  `OptionValue` text NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
