/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-02-22 14:48:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/assets/img/user01.png',
  `intro` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', 'fredchen188@gmail.com', '博主', '$2y$10$58A0X4xrWV.p2x.ogVjqpefP7BnnCpm2wzcyAx..k3yXrTAlkM8Le', '2017-10-18 15:01:49', '2018-01-01 14:36:51', 'http://b.com/storage/avatar/OntS7hPQpBnkUO4zr2zW5woT3Njcp6uawcnz4GH8.jpeg', 'fadsfdasfadsfasdf');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('6', '算法', '2', '2017-11-01 18:24:05', '2018-02-22 10:28:27', '20', null);
INSERT INTO `categories` VALUES ('12', 'php', null, '2017-11-01 18:24:06', '2017-11-01 18:24:06', null, null);
INSERT INTO `categories` VALUES ('13', 'svn', '14', '2017-11-01 18:24:07', '2018-02-22 10:29:43', '31', null);
INSERT INTO `categories` VALUES ('14', '3213123123213213123123123', null, '2017-11-01 18:24:08', '2017-11-01 18:24:08', null, '2018-02-17 13:04:11');
INSERT INTO `categories` VALUES ('15', 'javascript', null, '2017-11-01 18:24:09', '2017-11-01 18:24:09', null, null);
INSERT INTO `categories` VALUES ('1', '未分类', null, '2017-11-01 18:20:03', '2018-02-22 12:25:04', null, null);
INSERT INTO `categories` VALUES ('5', 'javascript', '1', '2017-11-01 18:24:11', '2018-02-22 10:27:35', '15', null);
INSERT INTO `categories` VALUES ('16', '微信开发', '15', '2017-11-01 18:24:12', '2018-02-22 10:30:48', '30', null);
INSERT INTO `categories` VALUES ('17', '基本', null, '2017-11-01 18:24:13', '2017-11-01 18:24:13', null, '2018-02-19 13:49:04');
INSERT INTO `categories` VALUES ('18', 'php', '16', '2017-11-01 18:24:14', '2017-11-01 18:24:14', '12', null);
INSERT INTO `categories` VALUES ('19', 'php', '17', '2017-11-01 18:24:15', '2018-02-22 10:31:49', '12', null);
INSERT INTO `categories` VALUES ('20', '算法', null, '2017-11-01 18:24:16', '2017-11-01 18:24:16', null, null);
INSERT INTO `categories` VALUES ('21', 'Vue.js', '18', '2017-11-01 18:24:17', '2018-02-22 10:33:20', '29', null);
INSERT INTO `categories` VALUES ('22', 'Nginx', '19', '2017-11-01 18:24:18', '2018-02-22 10:33:58', '28', null);
INSERT INTO `categories` VALUES ('23', 'Memcached', '20', '2017-11-01 18:24:20', '2018-02-22 10:34:48', '27', null);
INSERT INTO `categories` VALUES ('24', 'mysql', null, '2017-11-01 18:24:21', '2017-11-01 18:24:21', null, null);
INSERT INTO `categories` VALUES ('25', 'linux', null, '2017-11-01 18:24:22', '2017-11-01 18:24:22', null, null);
INSERT INTO `categories` VALUES ('26', 'Redis', null, '2017-11-01 18:24:23', '2017-11-01 18:24:23', null, null);
INSERT INTO `categories` VALUES ('27', 'Memcached', null, '2017-11-01 18:24:24', '2017-11-01 18:24:24', null, null);
INSERT INTO `categories` VALUES ('28', 'Nginx', null, '2017-11-01 18:24:52', '2017-11-01 18:24:52', null, null);
INSERT INTO `categories` VALUES ('29', 'Vue.js', null, '2017-11-01 18:24:26', '2017-11-01 18:24:26', null, null);
INSERT INTO `categories` VALUES ('30', '微信开发', null, '2017-11-01 18:24:27', '2017-11-01 18:24:27', null, null);
INSERT INTO `categories` VALUES ('31', 'svn', null, '2017-11-01 18:24:28', '2017-11-01 18:24:28', null, null);
INSERT INTO `categories` VALUES ('32', 'Redis', '21', '2018-02-22 10:35:14', '2018-02-22 10:35:14', '26', null);
INSERT INTO `categories` VALUES ('33', 'mysql', '22', '2018-02-22 10:36:07', '2018-02-22 10:36:07', '24', null);

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '匿名',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment_id` int(100) unsigned DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `read` tinyint(4) DEFAULT NULL,
  `isme` tinyint(4) DEFAULT NULL,
  `gavatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('75', 'Fred', '123@312', 'test', '2018-02-22 13:26:46', '2018-02-22 13:36:48', '1', null, '1', '1', null, 'https://secure.gravatar.com/avatar/2f704dbde7b59f7c3d596e4c0111b0ac?size=120', null);
INSERT INTO `comments` VALUES ('76', '博主', 'fredchen188@gmail.com', 'test', '2018-02-22 13:36:48', '2018-02-22 13:36:48', '1', '75', '1', '1', '1', '/assets_admin/img/fred.png', null);

-- ----------------------------
-- Table structure for links
-- ----------------------------
DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of links
-- ----------------------------
INSERT INTO `links` VALUES ('1', '百度', 'htttp://www.baidu.com', '/storage/linklogo/CrD3HhTTTMQST7G5CXEdWxNxyEVv0Qgejl85UKcX.jpeg', '2017-11-01 18:24:28', '2017-11-01 18:24:28');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2017_10_13_144032_create_admins_table', '1');
INSERT INTO `migrations` VALUES ('4', '2017_10_15_130001_create_posts_table', '2');
INSERT INTO `migrations` VALUES ('5', '2017_10_15_130447_create_categories_table', '3');
INSERT INTO `migrations` VALUES ('6', '2017_10_15_130823_create_post_tags_table', '4');
INSERT INTO `migrations` VALUES ('7', '2017_10_15_130946_create_tags_table', '5');
INSERT INTO `migrations` VALUES ('8', '2017_10_16_021802_create_table_links', '6');
INSERT INTO `migrations` VALUES ('9', '2017_10_16_043431_create_comments_table', '7');
INSERT INTO `migrations` VALUES ('10', '2017_10_16_141524_create_webs_table', '8');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(1500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/assets/img/pimage.png',
  `visit` int(20) DEFAULT NULL,
  `intro` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('1', '15', null, '2017-11-01 18:24:28', '2018-02-22 13:36:24', 'javascript闭包详解', '<p>People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at，People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp; &nbsp;，People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp; &nbsp;，People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</p>', 'http://b.com/assets_admin/img/pimage.png', '352', 'People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it mea...');
INSERT INTO `posts` VALUES ('2', '20', null, '2017-11-01 18:24:28', '2018-02-22 13:00:16', 'php算法最佳探讨-1', '<p>People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', 'http://b.com/assets_admin/img/pimage.png', '347', 'People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it mea...');
INSERT INTO `posts` VALUES ('14', '31', null, '2017-11-01 18:24:28', '2017-11-01 18:24:28', '关于svn在本地与服务器的部署问题', '<p>People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;</p>', 'http://b.com/assets_admin/img/pimage.png', '31', 'People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it mea...');
INSERT INTO `posts` VALUES ('15', '30', null, '2017-11-01 18:24:28', '2017-11-01 18:24:28', '微信支付通过jasapi调用接口获取不到openid怎么办？', '<p>People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;</p>', 'http://b.com/assets_admin/img/pimage.png', '123', 'People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it mea...');
INSERT INTO `posts` VALUES ('17', '12', null, '2017-11-01 18:24:28', '2017-11-01 18:24:28', '使用原生php从零开始搭建企业官网', '<p>People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at&nbsp;&nbsp;&nbsp;</p>', 'http://b.com/assets_admin/img/pimage.png', '23', 'People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it mea...');
INSERT INTO `posts` VALUES ('18', '29', null, '2017-11-01 18:24:28', '2017-11-01 18:24:28', 'vue.js 还是 jquery? 作为一个码农，项目中如何选择？', '<p>People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at</p>', 'http://b.com/assets_admin/img/pimage.png', '127', 'People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it mea...');
INSERT INTO `posts` VALUES ('19', '28', null, '2017-11-01 18:24:28', '2017-11-01 18:24:28', '有关Nginx的配置详解', '<p>People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at</p>', 'http://b.com/assets_admin/img/pimage.png', '2', 'People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it mea...');
INSERT INTO `posts` VALUES ('20', '27', null, '2017-11-01 18:24:28', '2017-11-01 18:24:28', '手把手教你使用Memcached搭建集群', '<p>People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at</p>', 'http://b.com/assets_admin/img/pimage.png', '1', 'People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it mea...');
INSERT INTO `posts` VALUES ('21', '26', null, '2017-11-01 18:24:28', '2017-11-01 18:24:28', 'Redis中的数据结构探讨', '<p>People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at</p>', 'http://b.com/assets_admin/img/pimage.png', '1', 'People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it mea...');
INSERT INTO `posts` VALUES ('22', '24', null, '2017-11-01 18:24:28', '2017-11-01 18:24:28', 'mysql中的索引实现原理深入探讨', '<p>People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means atPeople think focus means saying yes to the thing you’ve got to focus on. But that’s not what it means at</p>', 'http://b.com/assets_admin/img/pimage.png', '1', 'People think focus means saying yes to the thing you’ve got to focus on. But that’s not what it mea...');

-- ----------------------------
-- Table structure for post_tags
-- ----------------------------
DROP TABLE IF EXISTS `post_tags`;
CREATE TABLE `post_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of post_tags
-- ----------------------------
INSERT INTO `post_tags` VALUES ('95', '2', '5', null, null);
INSERT INTO `post_tags` VALUES ('94', '2', '1', null, null);
INSERT INTO `post_tags` VALUES ('3', '3', '1', null, null);
INSERT INTO `post_tags` VALUES ('4', '5', '1', null, null);
INSERT INTO `post_tags` VALUES ('5', '5', '2', null, null);
INSERT INTO `post_tags` VALUES ('6', '6', '1', null, null);
INSERT INTO `post_tags` VALUES ('7', '6', '2', null, null);
INSERT INTO `post_tags` VALUES ('8', '6', '3', null, null);
INSERT INTO `post_tags` VALUES ('9', '8', '1', null, null);
INSERT INTO `post_tags` VALUES ('10', '8', '2', null, null);
INSERT INTO `post_tags` VALUES ('11', '8', '3', null, null);
INSERT INTO `post_tags` VALUES ('27', '12', '2', null, null);
INSERT INTO `post_tags` VALUES ('26', '12', '1', null, null);
INSERT INTO `post_tags` VALUES ('14', '11', '1', null, null);
INSERT INTO `post_tags` VALUES ('15', '11', '2', null, null);
INSERT INTO `post_tags` VALUES ('16', '11', '3', null, null);
INSERT INTO `post_tags` VALUES ('25', '10', '1', null, null);
INSERT INTO `post_tags` VALUES ('28', '12', '3', null, null);
INSERT INTO `post_tags` VALUES ('29', '13', '1', null, null);
INSERT INTO `post_tags` VALUES ('30', '13', '2', null, null);
INSERT INTO `post_tags` VALUES ('93', '1', '3', null, null);
INSERT INTO `post_tags` VALUES ('92', '1', '1', null, null);
INSERT INTO `post_tags` VALUES ('101', '15', '6', null, null);
INSERT INTO `post_tags` VALUES ('98', '14', '5', null, null);
INSERT INTO `post_tags` VALUES ('97', '14', '1', null, null);
INSERT INTO `post_tags` VALUES ('100', '15', '5', null, null);
INSERT INTO `post_tags` VALUES ('99', '15', '1', null, null);
INSERT INTO `post_tags` VALUES ('78', '16', '1', null, null);
INSERT INTO `post_tags` VALUES ('79', '16', '2', null, null);
INSERT INTO `post_tags` VALUES ('80', '16', '3', null, null);
INSERT INTO `post_tags` VALUES ('102', '17', '1', null, null);
INSERT INTO `post_tags` VALUES ('108', '20', '5', null, null);
INSERT INTO `post_tags` VALUES ('105', '18', '6', null, null);
INSERT INTO `post_tags` VALUES ('104', '18', '1', null, null);
INSERT INTO `post_tags` VALUES ('106', '19', '1', null, null);
INSERT INTO `post_tags` VALUES ('107', '20', '1', null, null);
INSERT INTO `post_tags` VALUES ('96', '2', '6', null, null);
INSERT INTO `post_tags` VALUES ('103', '17', '5', null, null);
INSERT INTO `post_tags` VALUES ('109', '21', '1', null, null);
INSERT INTO `post_tags` VALUES ('110', '22', '1', null, null);

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES ('1', '原创', '2017-11-01 18:24:28', '2017-11-01 18:24:28');
INSERT INTO `tags` VALUES ('2', '转载', '2017-11-01 18:24:28', '2017-11-01 18:24:28');
INSERT INTO `tags` VALUES ('3', '资源', '2017-11-01 18:24:28', '2017-11-01 18:24:28');
INSERT INTO `tags` VALUES ('5', '博主力荐', '2017-11-01 18:24:28', '2017-11-01 18:24:28');
INSERT INTO `tags` VALUES ('6', '技术探讨', '2017-11-01 18:24:28', '2017-11-01 18:24:28');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Table structure for webs
-- ----------------------------
DROP TABLE IF EXISTS `webs`;
CREATE TABLE `webs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'FredBlog',
  `keywords` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '开源博客，富漾老浩',
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '无聊撸代码，越撸越寂寞',
  `qrcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/assets/img/fredcode.png',
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/assets/img/fred.png',
  `beian` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '©2016-2018 陕icp备16010117号',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of webs
-- ----------------------------
INSERT INTO `webs` VALUES ('1', 'Fred Blog', 'Laravel，开源博客，Fred Blog', '本博客是博主用Laravel写的一个博客网站，同时也基于MIT license ，大家可以去演示后台瞅瞅，功能挺全的，还能继续扩展很多。觉得看得上眼的拿去玩就行了。博主把精力放在了写文章上和养猫上，网站现在做的的不怎么走心了哈哈哈~', '/storage/logo/fred.jpg', 'http://b.com/storage/logo/kxww78XnV2NLdU8eY52rEF2C7ENJjaVvGyXmV2FG.jpeg', '©2016-2018 陕icp备16010117号', '2017-11-01 18:24:28', '2017-11-01 18:24:28');
SET FOREIGN_KEY_CHECKS=1;
