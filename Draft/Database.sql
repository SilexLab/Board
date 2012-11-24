SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


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

DROP TABLE IF EXISTS `board`;
CREATE TABLE IF NOT EXISTS `board` (
  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `ParentID` mediumint(9) NOT NULL,
  `Type` tinyint(1) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

INSERT INTO `board` (`ID`, `ParentID`, `Type`, `Title`, `Description`, `Link`, `Position`, `Image`, `ImageNew`, `Prefixes`, `PrefixesRequired`, `Views`, `Threads`, `Posts`, `MarkingAsDone`, `Closed`, `Invisible`, `News`) VALUES
(1, 0, 0, 'Kategorie', '', '', 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(2, 1, 1, 'Unterforum', 'Beschreibung', '', 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(3, 0, 1, 'Oberforum', 'Beschreibung des Oberforums', '', 2, '', '', '', 0, 1, 2, 3, 0, 0, 0, 0),
(4, 3, 2, 'Silex Bulletin Board', 'Beste Forensoftware überhaupt', 'http://www.silexboard.org/', 3, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(5, 0, 2, 'Demo', 'Silex Bulletin Board Demo', 'http://demo.silexboard.org/', 4, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(6, 0, 1, '<script type="text/javascript">alert("xss");</script>', '<b>Beschreibung</b>', '', 5, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0),
(7, 1, 1, 'Noch eins', 'Ein weiteres Unterforum', '', 2, '', '', '', 0, 3, 5, 6, 0, 0, 0, 0),
(8, 2, 1, 'Unterunterforum', 'Ein Forum in einem Unterforum', '', 1, '', '', '', 0, 5, 4, 3, 0, 0, 0, 0);

DROP TABLE IF EXISTS `board_last_post`;
CREATE TABLE IF NOT EXISTS `board_last_post` (
  `BoardID` mediumint(9) NOT NULL,
  `ThreadID` mediumint(9) NOT NULL,
  PRIMARY KEY (`BoardID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `Package` smallint(6) NOT NULL,
  `ConfigNode` varchar(255) NOT NULL,
  `CategoryNode` varchar(255) NOT NULL,
  `ConfigValue` varchar(255) NOT NULL,
  `ValueType` varchar(16) NOT NULL,
  PRIMARY KEY (`ConfigNode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `config` (`Package`, `ConfigNode`, `CategoryNode`, `ConfigValue`, `ValueType`) VALUES
(1, 'page.language.default', 'page', 'de', 'string(11)'),
(1, 'page.timezone', 'page', 'Europe/Berlin', 'string(255)'),
(1, 'page.title', 'page', 'Silex Bulletin Board', 'string(255)'),
(1, 'page.uri_format', 'page', '1', 'int(1)'),
(1, 'style.default', 'style', 'Lumen Lunae', 'string(255)'),
(1, 'system.cache.dir', 'system', '', 'string(255)'),
(1, 'user.autologout', 'user', '3600', 'int(8)'),
(1, 'user.session.autologout_probability', 'user.session', '25', 'int(3)'),
(1, 'user.session.cookie_time', 'user.session', '86400', 'int(8)'),
(1, 'user.session.name', 'user.session', 'SBB', 'string(255)'),
(1, 'mail.method', 'mail', 'PHP', 'string(255)'),
(1, 'mail.smtp.server', 'mail.smtp', '', 'string(255)'),
(1, 'mail.smtp.port', 'mail.smtp', '', 'int(8)'),
(1, 'mail.smtp.user', 'mail.smtp', '', 'string(255)'),
(1, 'mail.smtp.password', 'mail.smtp', '', 'string(255)');

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

DROP TABLE IF EXISTS `group_permissions`;
CREATE TABLE IF NOT EXISTS `group_permissions` (
  `GroupID` mediumint(9) NOT NULL,
  `PermissionID` mediumint(9) NOT NULL,
  `OptionValue` text NOT NULL,
  PRIMARY KEY (`GroupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Abbreviation` varchar(11) NOT NULL,
  `Encoding` varchar(16) NOT NULL DEFAULT 'UTF-8',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `language` (`ID`, `Abbreviation`, `Encoding`) VALUES
(1, 'de', 'UTF-8'),
(2, 'en', 'UTF-8');

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `ID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `MenuName` varchar(255) NOT NULL,
  `Target` varchar(255) NOT NULL,
  `Position` tinyint(4) NOT NULL,
  `Permission` tinytext NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Target` (`Target`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `menu` (`ID`, `MenuName`, `Target`, `Position`, `Permission`) VALUES
(1, 'sbb.page.home', 'p:Home', 1, ''),
(2, 'sbb.page.board', 'p:Board', 2, ''),
(3, 'sbb.page.userlist', 'p:UserList', 3, '');

DROP TABLE IF EXISTS `package`;
CREATE TABLE IF NOT EXISTS `package` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `PackageNode` varchar(255) NOT NULL,
  `PackageName` varchar(255) NOT NULL,
  `ParentID` smallint(6) NOT NULL DEFAULT '0',
  `Author` varchar(255) NOT NULL,
  `Website` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `package` (`ID`, `PackageNode`, `PackageName`, `ParentID`, `Author`, `Website`) VALUES
(1, 'sbb.core', 'Silex Bulletin Board Core', 0, 'Patrick Kleinschmidt', 'http://www.silexboard.org/');

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `PermissionName` text NOT NULL,
  `CategoryName` text NOT NULL,
  `Type` varchar(8) NOT NULL,
  `DefaultValue` text NOT NULL,
  `Package` smallint(6) NOT NULL,
  `Position` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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

DROP TABLE IF EXISTS `poll_options`;
CREATE TABLE IF NOT EXISTS `poll_options` (
  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `PollID` mediumint(9) NOT NULL,
  `Option` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `poll_votes`;
CREATE TABLE IF NOT EXISTS `poll_votes` (
  `OptionID` mediumint(9) NOT NULL,
  `UserID` mediumint(9) NOT NULL,
  PRIMARY KEY (`OptionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `post` (`ID`, `ThreadID`, `UserID`, `Subject`, `Message`, `Time`, `LastEdit`, `EditorID`, `PollID`, `IPAddress`, `Disabled`, `Closed`, `Deleted`, `DeleteReason`, `DeleteTime`, `Smileys`, `HTML`, `SilexCode`) VALUES
(1, 1, 1, 'Example Topic', 'Text des posts', 0, 0, 0, 0, '', 0, 0, 0, '', 0, 1, 0, 1),
(2, 1, 2, '', 'Antwort auf den ersten Post des ersten Threads', 1, 0, 0, 0, '', 0, 0, 0, '', 0, 1, 0, 1);

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `ID` varchar(32) NOT NULL,
  `SessionValue` mediumtext NOT NULL,
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `IPAddress` varchar(64) NOT NULL,
  `UserAgent` tinytext NOT NULL,
  `LastActivityTime` int(11) NOT NULL,
  `Token` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

DROP TABLE IF EXISTS `thread`;
CREATE TABLE IF NOT EXISTS `thread` (
  `ID` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `BoardID` mediumint(9) unsigned NOT NULL,
  `PostID` int(11) unsigned NOT NULL,
  `UserID` mediumint(9) unsigned NOT NULL,
  `Prefix` varchar(32) NOT NULL,
  `Topic` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  `Time` int(11) NOT NULL,
  `LastPostID` int(11) unsigned NOT NULL,
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

INSERT INTO `thread` (`ID`, `BoardID`, `PostID`, `UserID`, `Prefix`, `Topic`, `Message`, `Time`, `LastPostID`, `LastPostTime`, `Replies`, `Views`, `Sticky`, `Disabled`, `Closed`, `Deleted`, `DeleteReason`, `DeleteTime`) VALUES
(1, 2, 1, 1, '', 'Example Topic', 'Das hier ist text. omg!', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0);

DROP TABLE IF EXISTS `thread_visit`;
CREATE TABLE IF NOT EXISTS `thread_visit` (
  `ThreadID` mediumint(9) unsigned NOT NULL,
  `UserID` mediumint(9) unsigned NOT NULL,
  `Time` int(11) NOT NULL,
  PRIMARY KEY (`ThreadID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Salt` varchar(64) NOT NULL,
  `GroupID` mediumint(9) unsigned NOT NULL,
  `Email` text NOT NULL,
  `ActivationKey` varchar(16) NOT NULL,
  `Joined` int(11) NOT NULL,
  `OnlineTime` int(11) NOT NULL,
  `Banned` tinyint(1) NOT NULL DEFAULT '0',
  `Homepage` text NOT NULL,
  `Signature` text NOT NULL,
  `Language` varchar(4) NOT NULL,
  `LastActivity` int(11) NOT NULL,
  `Birthday` int(11) NOT NULL,
  `Posts` int(8) NOT NULL,
  `Threads` int(8) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `users` (`ID`, `Username`, `Password`, `Salt`, `GroupID`, `Email`, `ActivationKey`, `Joined`, `OnlineTime`, `Banned`, `Homepage`, `Signature`, `Language`, `LastActivity`, `Birthday`, `Posts`, `Threads`) VALUES
(1, 'admin', 'cf8dbc7a1eaadcf0a63bafbaec4cc2bc0ee1c390', 'aecca3db58bff495a3429d714d766c9d8770754d', 0, 'admin@silexboard.org', 'e1e2f6c8795a79e', 1317503300, 0, 0, '', 'Des Admins Signatur steht hier.', '', 0, 0, 0, 0),
(2, 'user', '9cdb86abb28e5eebedeb14838dc074418a0d8f14', '630dd14c99e0c6efb1a344c0a73a28b0d99fbb81', 0, 'user@silexboard.org', 'fc973531e7e287b', 1317503334, 0, 0, '', '', '', 0, 0, 0, 0);

DROP TABLE IF EXISTS `user_permissions`;
CREATE TABLE IF NOT EXISTS `user_permissions` (
  `UserID` mediumint(9) unsigned NOT NULL,
  `PermissionID` mediumint(9) unsigned NOT NULL,
  `OptionValue` text NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
