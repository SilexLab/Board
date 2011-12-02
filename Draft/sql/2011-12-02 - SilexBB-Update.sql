-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 02. Dez 2011 um 20:28
-- Server Version: 5.5.16
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

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `acp_session`
--

DROP TABLE IF EXISTS `acp_session`;
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

DROP TABLE IF EXISTS `board`;
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
  `News` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `board`
--

INSERT INTO `board` (`ID`, `ParentID`, `Type`, `Title`, `Description`, `Link`, `Position`, `Image`, `ImageNew`, `Prefixes`, `PrefixesRequired`, `Views`, `Threads`, `Posts`, `MarkingAsDone`, `Closed`, `Invisible`, `News`) VALUES
(1, 0, 0, 'Hauptforum', '123', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(2, 1, 1, 'UnterForum', 'aaaa', '', 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `board_last_post`
--

DROP TABLE IF EXISTS `board_last_post`;
CREATE TABLE IF NOT EXISTS `board_last_post` (
  `BoardID` mediumint(9) NOT NULL,
  `ThreadID` mediumint(9) NOT NULL,
  PRIMARY KEY (`BoardID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `board_permissions_group`
--

DROP TABLE IF EXISTS `board_permissions_group`;
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

DROP TABLE IF EXISTS `board_permissions_user`;
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

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `Type` varchar(16) NOT NULL,
  `ConfigVariable` varchar(32) NOT NULL,
  `ConfigValue` varchar(32) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `ConfigName` varchar(255) NOT NULL,
  PRIMARY KEY (`Type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `config`
--

INSERT INTO `config` (`Type`, `ConfigVariable`, `ConfigValue`, `CategoryName`, `ConfigName`) VALUES
('CONST', 'Style_Default', 'Standard', 'config.style', 'config.style.default'),
('VAR', 'PageTitle', 'Silex Bulletin Board', 'config.page', 'config.page.title');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `groups`
--

DROP TABLE IF EXISTS `groups`;
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

DROP TABLE IF EXISTS `group_permissions`;
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

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Shortcut` varchar(4) NOT NULL,
  `Encoding` varchar(16) NOT NULL DEFAULT 'UTF-8',
  `DefaultLanguage` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `language`
--

INSERT INTO `language` (`ID`, `Shortcut`, `Encoding`, `DefaultLanguage`) VALUES
(1, 'DE', 'UTF-8', 1),
(2, 'EN', 'UTF-8', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `ID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `MenuName` varchar(255) NOT NULL,
  `Target` varchar(255) NOT NULL,
  `Position` tinyint(4) NOT NULL,
  `Permission` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `menu`
--

INSERT INTO `menu` (`ID`, `MenuName`, `Target`, `Position`, `Permission`) VALUES
(1, 'com.sbb.menu.home', 'menu.home', 1, ''),
(2, 'com.sbb.menu.forum', 'menu.forum', 2, ''),
(3, 'com.sbb.menu.userlist', 'menu.userlist', 3, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `permissions`
--

DROP TABLE IF EXISTS `permissions`;
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

DROP TABLE IF EXISTS `pm`;
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

DROP TABLE IF EXISTS `poll`;
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

DROP TABLE IF EXISTS `poll_options`;
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

DROP TABLE IF EXISTS `poll_votes`;
CREATE TABLE IF NOT EXISTS `poll_votes` (
  `OptionID` mediumint(9) NOT NULL,
  `UserID` mediumint(9) NOT NULL,
  PRIMARY KEY (`OptionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `post`
--

DROP TABLE IF EXISTS `post`;
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

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `ID` varchar(32) NOT NULL,
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

DROP TABLE IF EXISTS `smiley`;
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

DROP TABLE IF EXISTS `thread`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `thread`
--

INSERT INTO `thread` (`ID`, `BoardID`, `PostID`, `UserID`, `Prefix`, `Topic`, `Message`, `Time`, `LastPostID`, `LastPostTime`, `Replies`, `Views`, `Sticky`, `Disabled`, `Closed`, `Deleted`, `DeleteReason`, `DeleteTime`) VALUES
(1, 2, 1, 1, '', 'test', 'Das hier ist text. omg!', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `thread_visit`
--

DROP TABLE IF EXISTS `thread_visit`;
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

DROP TABLE IF EXISTS `users`;
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
  `Language` varchar(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`ID`, `Username`, `Password`, `Salt`, `GroupID`, `Email`, `ActivationKey`, `RegisterTime`, `OnlineTime`, `Banned`, `Homepage`, `Signatur`, `Language`) VALUES
(1, 'admin', 'cf8dbc7a1eaadcf0a63bafbaec4cc2bc0ee1c390', 'aecca3db58bff495a3429d714d766c9d8770754d', 0, 'admin@silexboard.org', 'e1e2f6c8795a79e', 1317503300, 0, 0, '', '', ''),
(2, 'user', '9cdb86abb28e5eebedeb14838dc074418a0d8f14', '630dd14c99e0c6efb1a344c0a73a28b0d99fbb81', 0, 'user@silexboard.org', 'fc973531e7e287b', 1317503334, 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_permissions`
--

DROP TABLE IF EXISTS `user_permissions`;
CREATE TABLE IF NOT EXISTS `user_permissions` (
  `UserID` mediumint(9) NOT NULL,
  `PermissionID` mediumint(9) NOT NULL,
  `OptionValue` text NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
