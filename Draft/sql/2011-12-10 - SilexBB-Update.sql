/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50514
Source Host           : localhost:3306
Source Database       : silexboard

Target Server Type    : MYSQL
Target Server Version : 50514
File Encoding         : 65001

Date: 2011-12-10 21:09:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `acp_session`
-- ----------------------------
DROP TABLE IF EXISTS `acp_session`;
CREATE TABLE `acp_session` (
  `ID` int(11) NOT NULL,
  `UserID` mediumint(9) NOT NULL,
  `Username` varchar(32) NOT NULL,
  `IPAddress` varchar(64) NOT NULL,
  `UserAgent` tinytext NOT NULL,
  `LastActivityTime` int(11) NOT NULL,
  `Token` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of acp_session
-- ----------------------------

-- ----------------------------
-- Table structure for `board`
-- ----------------------------
DROP TABLE IF EXISTS `board`;
CREATE TABLE `board` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of board
-- ----------------------------
INSERT INTO `board` VALUES ('1', '0', '0', 'Hauptforum', '123', '', '0', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `board` VALUES ('2', '1', '1', 'UnterForum', 'aaaa', '', '0', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `board_last_post`
-- ----------------------------
DROP TABLE IF EXISTS `board_last_post`;
CREATE TABLE `board_last_post` (
  `BoardID` mediumint(9) NOT NULL,
  `ThreadID` mediumint(9) NOT NULL,
  PRIMARY KEY (`BoardID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of board_last_post
-- ----------------------------

-- ----------------------------
-- Table structure for `board_permissions_group`
-- ----------------------------
DROP TABLE IF EXISTS `board_permissions_group`;
CREATE TABLE `board_permissions_group` (
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

-- ----------------------------
-- Records of board_permissions_group
-- ----------------------------

-- ----------------------------
-- Table structure for `board_permissions_user`
-- ----------------------------
DROP TABLE IF EXISTS `board_permissions_user`;
CREATE TABLE `board_permissions_user` (
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

-- ----------------------------
-- Records of board_permissions_user
-- ----------------------------

-- ----------------------------
-- Table structure for `config`
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `Type` varchar(16) NOT NULL,
  `ConfigVariable` varchar(32) NOT NULL,
  `ConfigValue` varchar(32) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `ConfigName` varchar(255) NOT NULL,
  PRIMARY KEY (`Type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('CONST', 'Style_Default', 'Standard', 'config.style', 'config.style.default');
INSERT INTO `config` VALUES ('VAR', 'PageTitle', 'Silex Bulletin Board', 'config.page', 'config.page.title');

-- ----------------------------
-- Table structure for `group_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `group_permissions`;
CREATE TABLE `group_permissions` (
  `GroupID` mediumint(9) NOT NULL,
  `PermissionID` mediumint(9) NOT NULL,
  `OptionValue` text NOT NULL,
  PRIMARY KEY (`GroupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of group_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `GroupName` text NOT NULL,
  `Image` text NOT NULL,
  `Color` varchar(8) NOT NULL,
  `Icon` text NOT NULL,
  `Type` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups
-- ----------------------------

-- ----------------------------
-- Table structure for `language`
-- ----------------------------
DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Shortcut` varchar(4) NOT NULL,
  `Encoding` varchar(16) NOT NULL DEFAULT 'UTF-8',
  `DefaultLanguage` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of language
-- ----------------------------
INSERT INTO `language` VALUES ('1', 'DE', 'UTF-8', '1');
INSERT INTO `language` VALUES ('2', 'EN', 'UTF-8', '0');

-- ----------------------------
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `ID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `MenuName` varchar(255) NOT NULL,
  `Target` varchar(255) NOT NULL,
  `Position` tinyint(4) NOT NULL,
  `Permission` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'com.sbb.menu.home', 'menu.home', '1', '');
INSERT INTO `menu` VALUES ('2', 'com.sbb.menu.forum', 'menu.forum', '2', '');
INSERT INTO `menu` VALUES ('3', 'com.sbb.menu.userlist', 'menu.userlist', '3', '');

-- ----------------------------
-- Table structure for `permissions`
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `PermissionName` text NOT NULL,
  `CategoryName` text NOT NULL,
  `Type` varchar(8) NOT NULL,
  `DefaultValue` text NOT NULL,
  `ModulName` text NOT NULL,
  `Position` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of permissions
-- ----------------------------

-- ----------------------------
-- Table structure for `pm`
-- ----------------------------
DROP TABLE IF EXISTS `pm`;
CREATE TABLE `pm` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pm
-- ----------------------------

-- ----------------------------
-- Table structure for `poll`
-- ----------------------------
DROP TABLE IF EXISTS `poll`;
CREATE TABLE `poll` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of poll
-- ----------------------------

-- ----------------------------
-- Table structure for `poll_options`
-- ----------------------------
DROP TABLE IF EXISTS `poll_options`;
CREATE TABLE `poll_options` (
  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `PollID` mediumint(9) NOT NULL,
  `Option` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of poll_options
-- ----------------------------

-- ----------------------------
-- Table structure for `poll_votes`
-- ----------------------------
DROP TABLE IF EXISTS `poll_votes`;
CREATE TABLE `poll_votes` (
  `OptionID` mediumint(9) NOT NULL,
  `UserID` mediumint(9) NOT NULL,
  PRIMARY KEY (`OptionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of poll_votes
-- ----------------------------

-- ----------------------------
-- Table structure for `post`
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of post
-- ----------------------------

-- ----------------------------
-- Table structure for `session`
-- ----------------------------
DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `ID` varchar(32) NOT NULL,
  `UserID` int(11) NOT NULL,
  `IPAddress` varchar(64) NOT NULL,
  `UserAgent` tinytext NOT NULL,
  `LastActivityTime` int(11) NOT NULL,
  `Token` tinytext NOT NULL,
  `LoginHash` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of session
-- ----------------------------

-- ----------------------------
-- Table structure for `smiley`
-- ----------------------------
DROP TABLE IF EXISTS `smiley`;
CREATE TABLE `smiley` (
  `ID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `Category` varchar(32) NOT NULL DEFAULT 'Default',
  `SmileyPath` tinytext NOT NULL,
  `SmileyTitle` varchar(32) NOT NULL,
  `SmileyCode` varchar(16) NOT NULL,
  `Position` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of smiley
-- ----------------------------

-- ----------------------------
-- Table structure for `thread`
-- ----------------------------
DROP TABLE IF EXISTS `thread`;
CREATE TABLE `thread` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of thread
-- ----------------------------
INSERT INTO `thread` VALUES ('1', '2', '1', '1', '', 'test', 'Das hier ist text. omg!', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '0');

-- ----------------------------
-- Table structure for `thread_visit`
-- ----------------------------
DROP TABLE IF EXISTS `thread_visit`;
CREATE TABLE `thread_visit` (
  `ThreadID` mediumint(9) NOT NULL,
  `UserID` mediumint(9) NOT NULL,
  `Time` int(11) NOT NULL,
  PRIMARY KEY (`ThreadID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of thread_visit
-- ----------------------------

-- ----------------------------
-- Table structure for `user_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `user_permissions`;
CREATE TABLE `user_permissions` (
  `UserID` mediumint(9) NOT NULL,
  `PermissionID` mediumint(9) NOT NULL,
  `OptionValue` text NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'cf8dbc7a1eaadcf0a63bafbaec4cc2bc0ee1c390', 'aecca3db58bff495a3429d714d766c9d8770754d', '0', 'admin@silexboard.org', 'e1e2f6c8795a79e', '1317503300', '0', '0', '', '', '');
INSERT INTO `users` VALUES ('2', 'user', '9cdb86abb28e5eebedeb14838dc074418a0d8f14', '630dd14c99e0c6efb1a344c0a73a28b0d99fbb81', '0', 'user@silexboard.org', 'fc973531e7e287b', '1317503334', '0', '0', '', '', '');
