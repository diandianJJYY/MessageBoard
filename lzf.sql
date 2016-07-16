/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : lzf

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-07-16 14:38:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT '留言者姓名',
  `gender` enum('0','1') DEFAULT '0' COMMENT '性别（0=>男，1=>女）',
  `tel` varchar(11) DEFAULT NULL COMMENT '电话',
  `content` varchar(255) DEFAULT NULL COMMENT '留言内容',
  `createtime` int(20) DEFAULT NULL COMMENT '时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of messages
-- ----------------------------
INSERT INTO `messages` VALUES ('18', '刘德华', '1', '13117735073', '我是刘天王 啊哈给我一杯忘情水~~', '1468576554');
INSERT INTO `messages` VALUES ('19', '吴彦祖', '1', '13117735073', '大家好 我是吴彦祖', '1468576621');
INSERT INTO `messages` VALUES ('20', '杜远标', '0', '13117735073', '我也是天王 哈哈哈', '1468580907');
INSERT INTO `messages` VALUES ('21', 'liuzuf', '1', '13117735073', '内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容', '1468582063');
INSERT INTO `messages` VALUES ('22', '测试姓名', '1', '13117735073', '留言内容', '1468633789');
INSERT INTO `messages` VALUES ('23', '换行', '1', '13117735073', '测试换行\n换行   \n再换', '1468645225');
INSERT INTO `messages` VALUES ('24', 'YKS', '1', '13117735073', '用于测试回复的动态效果', '1468649868');

-- ----------------------------
-- Table structure for replay
-- ----------------------------
DROP TABLE IF EXISTS `replay`;
CREATE TABLE `replay` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(20) NOT NULL COMMENT '对应message里的id',
  `uid` int(20) NOT NULL COMMENT '对应管理员users里的id',
  `content` varchar(255) DEFAULT NULL COMMENT '回复内容',
  `createtime` int(50) DEFAULT NULL COMMENT '回复时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of replay
-- ----------------------------
INSERT INTO `replay` VALUES ('1', '22', '1', '测试回复', '1468633977');
INSERT INTO `replay` VALUES ('2', '22', '1', '测试回复', '1468633989');
INSERT INTO `replay` VALUES ('3', '22', '1', '我是回复', '1468636215');
INSERT INTO `replay` VALUES ('4', '23', '1', '换行失败。。', '1468645548');
INSERT INTO `replay` VALUES ('5', '23', '1', '柳祖发啊你呀细哟', '1468645637');
INSERT INTO `replay` VALUES ('6', '23', '2', '测试回复效果', '1468650143');
INSERT INTO `replay` VALUES ('7', '24', '2', '测试回复效果', '1468650801');
INSERT INTO `replay` VALUES ('8', '23', '2', '测试回复效果', '1468650954');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'user1', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `users` VALUES ('2', 'user2', 'e10adc3949ba59abbe56e057f20f883e');
SET FOREIGN_KEY_CHECKS=1;
