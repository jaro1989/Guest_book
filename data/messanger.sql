/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : messanger

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2014-07-08 16:57:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `m_messages`
-- ----------------------------
DROP TABLE IF EXISTS `m_messages`;
CREATE TABLE `m_messages` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_messages
-- ----------------------------
