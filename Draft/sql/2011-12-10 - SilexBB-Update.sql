/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50514
Source Host           : localhost:3306
Source Database       : silexboard

Target Server Type    : MYSQL
Target Server Version : 50514
File Encoding         : 65001

Date: 2011-12-10 20:15:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `session`
-- ----------------------------
DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
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
