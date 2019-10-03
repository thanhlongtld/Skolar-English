/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100316
 Source Host           : localhost:3306
 Source Schema         : baitaplon

 Target Server Type    : MySQL
 Target Server Version : 100316
 File Encoding         : 65001

 Date: 03/10/2019 15:04:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for banners
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of banners
-- ----------------------------
INSERT INTO `banners` VALUES (1, '<h3>Bring to you the best English</h3>\r\n', 1, '<p>asdsad</p>\r\n', '2019-08-23 21:31:42', 0);
INSERT INTO `banners` VALUES (2, '<p>Learn smarter. Change deeper. Fly higher</p>\r\n', 0, '<p>asdasdasdsadsad</p>\r\n', '2019-08-31 13:40:21', 0);

-- ----------------------------
-- Table structure for banners_about
-- ----------------------------
DROP TABLE IF EXISTS `banners_about`;
CREATE TABLE `banners_about`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for buyer
-- ----------------------------
DROP TABLE IF EXISTS `buyer`;
CREATE TABLE `buyer`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `method` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bank_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `bank` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `message` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of buyer
-- ----------------------------
INSERT INTO `buyer` VALUES (1, 20, ' Đỗ Thanh Long', '+84868766071', 'thanhlongtld@gmail.com', ' 122', '1', '1', '', '', ' ', '2019-10-01 00:17:38');
INSERT INTO `buyer` VALUES (2, 21, ' Đỗ Thanh Long', '+84868766071', 'thanhlongtld@gmail.com', ' 122', '1', '1', '', '', ' ', '2019-10-01 00:22:49');
INSERT INTO `buyer` VALUES (3, 22, ' Đỗ Thanh Long', '+84 868766071', 'thanhlongtld@gmail.com', ' sadasd', '1', '1', '', '', ' ', '2019-10-03 11:50:16');
INSERT INTO `buyer` VALUES (4, 23, ' Đỗ Thanh Long', '+84 868766071', 'thanhlongtld@gmail.com', ' asdsadsad', '1', '1', '', '', ' ', '2019-10-03 14:14:52');
INSERT INTO `buyer` VALUES (5, 23, ' Đỗ Thanh Long', '+84 868766071', 'thanhlongtld@gmail.com', 'sadasd', '1', '1', '', '', ' ', '2019-10-03 14:15:36');

-- ----------------------------
-- Table structure for contact_informations
-- ----------------------------
DROP TABLE IF EXISTS `contact_informations`;
CREATE TABLE `contact_informations`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of contact_informations
-- ----------------------------
INSERT INTO `contact_informations` VALUES (3, 'facebook', 'https://www.facebook.com/skolarmshuong/?__tn__=%2Cd%2CP-R&eid=ARCgDGGD9fKVihjUEC33Z1ZLGpa0HFIaeP1GLg_nAMTqs3bCGfiRYRBhPH4mhXhlXwglUF7s0MAHu5TV', '<p>Facebook ch&iacute;nh c?a trang</p>\r\n', '2019-09-08 09:30:42', 1);
INSERT INTO `contact_informations` VALUES (4, 'twitter', 'https://twitter.com/?lang=vi', '<p>Twitter ch&iacute;nh c?a trang</p>\r\n', '2019-09-08 09:31:16', 1);
INSERT INTO `contact_informations` VALUES (5, 'instagram', 'https://www.instagram.com/', '<p>Instagram của trang</p>\r\n', '2019-09-08 09:33:15', 1);
INSERT INTO `contact_informations` VALUES (6, 'sdt', '   +84 947 599 691', '<p>Sdt li&ecirc;n lạc</p>\r\n', '2019-09-08 09:33:40', 1);
INSERT INTO `contact_informations` VALUES (7, 'mail', 'skolarenglish@gmail.com', '<p>mail ch&iacute;nh của trang</p>\r\n', '2019-09-08 09:36:28', 1);

-- ----------------------------
-- Table structure for courses
-- ----------------------------
DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `number_of_student` int(11) NULL DEFAULT NULL,
  `max_number_student` int(11) NOT NULL,
  `teacher` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of courses
-- ----------------------------
INSERT INTO `courses` VALUES (5, 'General English Class', 333, 1000, 'Mrs. Huong', 'courseAva1568040742course-1.jpg', 1, '', '2019-08-29 22:46:57', 1);
INSERT INTO `courses` VALUES (6, 'Business English Class', 33, 333, 'Mrs. Huong', 'courseAva1568043937course-2.jpg', 2, '<p>sadasdasdsd</p>\r\n', '2019-08-31 15:27:01', 1);
INSERT INTO `courses` VALUES (7, 'Ielts Class', 2, 34, 'Mrs. Huong', 'courseAva1568043955course-4.jpg', 2, '', '2019-09-08 22:41:21', 1);
INSERT INTO `courses` VALUES (8, 'Toeic Class', 22, 50, 'Mrs. Huong', 'courseAva1568043969course-5.jpg', 1, '', '2019-09-09 22:44:41', 1);
INSERT INTO `courses` VALUES (9, 'Focus Class', 3, 43, 'Mrs. Huong', 'courseAva1568043987course-3.jpg', 0, '', '2019-09-09 22:46:27', 1);

-- ----------------------------
-- Table structure for document_fee
-- ----------------------------
DROP TABLE IF EXISTS `document_fee`;
CREATE TABLE `document_fee`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `introduction` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cost` int(10) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of document_fee
-- ----------------------------
INSERT INTO `document_fee` VALUES (12, 'sadasdsadsadsadsadsadsad', 'feeDocumentAva1567761704IMG_8760.JPG', '', '<p>long</p>\r\n', '', 0, '<p>sadsadsadsad</p>\r\n', '2019-09-06 16:17:51', 1);
INSERT INTO `document_fee` VALUES (13, 'sadasdasdsadsad', 'feeDocumentAva1569122654myw3schoolsimage.jpg', 'sadsadsad', '<p>sadsadsad</p>\r\n', 'feeDocumentFile1569122654Bài giảng Vật lý 3 và thí nghiệm.pdf', 15000, '<p>sadasd</p>\r\n', '2019-09-22 10:24:14', 1);
INSERT INTO `document_fee` VALUES (14, 'ádasdsadsa', 'feeDocumentAva1569246104cau-be-phu-thuy-harry-potter-1.jpg', 'đâsdsadsad', '<p>sadsadsadsad</p>\r\n', 'feeDocumentFile1569246104Bài giảng Vật lý 3 và thí nghiệm.pdf', 160000, '<p>sadasdsad</p>\r\n', '2019-09-23 20:41:44', 1);

-- ----------------------------
-- Table structure for document_free
-- ----------------------------
DROP TABLE IF EXISTS `document_free`;
CREATE TABLE `document_free`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `introduction` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of document_free
-- ----------------------------
INSERT INTO `document_free` VALUES (10, 'Harry Potter', 'Tác phẩm kinh điển của nước Mỹ', 'freeDocumentAva1568949643cau-be-phu-thuy-harry-potter-1.jpg', 'freeDocumentFile1568949643Bài giảng Vật lý 3 và thí nghiệm.pdf', '<p>abcxyz</p>\r\n', '<p>sadsadsad</p>\r\n', '2019-09-20 10:20:43', 1);

-- ----------------------------
-- Table structure for infos
-- ----------------------------
DROP TABLE IF EXISTS `infos`;
CREATE TABLE `infos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `value` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of infos
-- ----------------------------
INSERT INTO `infos` VALUES (8, 'sadasdsadsasadsadsadsad', '<p>dasdasd</p>\r\n', '<p>sadasdasdsad</p>\r\n', '2019-09-01 17:26:16', 0);

-- ----------------------------
-- Table structure for intro
-- ----------------------------
DROP TABLE IF EXISTS `intro`;
CREATE TABLE `intro`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of intro
-- ----------------------------
INSERT INTO `intro` VALUES (1, 'sadsadsa                            ', '                            dasdasdsadsad', '2019-09-01 17:44:42', 0);

-- ----------------------------
-- Table structure for logo
-- ----------------------------
DROP TABLE IF EXISTS `logo`;
CREATE TABLE `logo`  (
  `id` int(11) NOT NULL,
  `logo_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of logo
-- ----------------------------
INSERT INTO `logo` VALUES (1, 'logo1567949540logo1.png', '2019-08-23 21:33:42', 1);

-- ----------------------------
-- Table structure for main_pic
-- ----------------------------
DROP TABLE IF EXISTS `main_pic`;
CREATE TABLE `main_pic`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of main_pic
-- ----------------------------
INSERT INTO `main_pic` VALUES (1, 'mainpic1567953440home-banner.jpg', '2019-08-23 21:39:51', 1);

-- ----------------------------
-- Table structure for main_pic_about
-- ----------------------------
DROP TABLE IF EXISTS `main_pic_about`;
CREATE TABLE `main_pic_about`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of main_pic_about
-- ----------------------------
INSERT INTO `main_pic_about` VALUES (1, 'mainpic156724279741396946_973438386197719_5380920034145075200_n.jpg', '2019-08-31 15:38:11', 1);

-- ----------------------------
-- Table structure for offline
-- ----------------------------
DROP TABLE IF EXISTS `offline`;
CREATE TABLE `offline`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_banner` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `extra_banner` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `video` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of offline
-- ----------------------------
INSERT INTO `offline` VALUES (1, 'sadasdsadsadsadsadsad', '                <p>long</p>\r\n            ', '                                                                                                                <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/nIjVuRTm-dc\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" ></iframe>                                ', '                <p>sadasdasdsadasdasdasdsadsadasdsadsadsdasdasdsad</p>\r\n\r\n<p>sadsadsadsa</p>\r\n            ', '2019-09-05 09:32:52', 0);

-- ----------------------------
-- Table structure for online
-- ----------------------------
DROP TABLE IF EXISTS `online`;
CREATE TABLE `online`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_banner` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `extra_banner` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `video` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of online
-- ----------------------------
INSERT INTO `online` VALUES (1, 'sadasd', '<p>long</p>\r\n', '                                                                                                                <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/nIjVuRTm-dc\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" ></iframe>                                ', '<p>sadasdasdsadasdasdasdsadsadasdsadsadsdasdasdsad</p>\r\n\r\n<p>sadsadsadsa</p>\r\n', '2019-09-05 09:32:52', 0);

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ship` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `quantity` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `total` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `condition` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (0, '', '', '', '', '', NULL, 0);
INSERT INTO `orders` VALUES (3, ' Đỗ Thanh Long', '12,13', '', '#12:1<br>#13:1<br>', '15000', '2019-09-30 23:57:10', 1);
INSERT INTO `orders` VALUES (4, ' Đỗ Thanh Long', '12,13', '', '#12:1<br>#13:1<br>', '15000', '2019-10-01 00:00:24', 1);
INSERT INTO `orders` VALUES (5, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:04:58', 1);
INSERT INTO `orders` VALUES (6, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:05:19', 1);
INSERT INTO `orders` VALUES (7, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:05:52', 1);
INSERT INTO `orders` VALUES (8, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:05:57', 0);
INSERT INTO `orders` VALUES (9, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:07:15', 0);
INSERT INTO `orders` VALUES (10, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:07:56', 0);
INSERT INTO `orders` VALUES (11, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:08:07', 0);
INSERT INTO `orders` VALUES (12, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:09:54', 0);
INSERT INTO `orders` VALUES (13, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:10:44', 0);
INSERT INTO `orders` VALUES (14, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:10:45', 0);
INSERT INTO `orders` VALUES (15, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:11:04', 0);
INSERT INTO `orders` VALUES (16, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:11:30', 0);
INSERT INTO `orders` VALUES (17, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:11:50', 0);
INSERT INTO `orders` VALUES (18, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:11:52', 0);
INSERT INTO `orders` VALUES (19, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:12:11', 0);
INSERT INTO `orders` VALUES (20, ' Đỗ Thanh Long', '12,13', '30000', '+84868766071', '15000', '2019-10-01 00:15:43', 0);
INSERT INTO `orders` VALUES (21, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:17:38', 0);
INSERT INTO `orders` VALUES (22, ' Đỗ Thanh Long', '12,13', '', '+84868766071', '15000', '2019-10-01 00:22:49', 0);
INSERT INTO `orders` VALUES (23, ' Đỗ Thanh Long', '12,13', '', '#12:1<br>#13:1<br>', '15000', '2019-10-03 11:50:16', 0);
INSERT INTO `orders` VALUES (24, ' Đỗ Thanh Long', '12,13', '', '#12:1<br>#13:1<br>', '15000', '2019-10-03 14:15:36', 0);

-- ----------------------------
-- Table structure for teachers
-- ----------------------------
DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `achievement` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of teachers
-- ----------------------------
INSERT INTO `teachers` VALUES (10, 'Đỗ Thanh Long', '', 'Giám đốc', 'teacherAva1567483294IMG_8760.JPG', 'https://www.facebook.com/dothanhlongtld', 'https://instagram.com', 'https://twitter.com/?lang=vi', '<p>10. Ielst</p>\r\n\r\n<p>10000 Toeic</p>\r\n\r\n<p>Gi&agrave;u nhất thế giới</p>\r\n', '<p>asdasdasdasd</p>\r\n', '2019-09-10 10:52:56', 1);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, '', '', 'admin', '1', '', '2019-09-13 11:20:42');
INSERT INTO `user` VALUES (2, 'sadasd', 'asdasdsa', 'dasdsad', 'asdasd', 'Ava15685393472.png', '2019-09-15 16:22:27');
INSERT INTO `user` VALUES (3, 'sadasd', 'sadasd', 'asdsad', 'sadsadsad', 'Ava15685393932.png', '2019-09-15 16:23:13');
INSERT INTO `user` VALUES (4, 'sadasd', 'sadasdas', 'dasdsadsa', 'dsadasd', 'Ava15685396441.png', '2019-09-15 16:27:24');
INSERT INTO `user` VALUES (5, 'sadsadsa', 'dasdsa', 'dasdasd', 'sadsad', 'Ava15685397022.png', '2019-09-15 16:28:22');
INSERT INTO `user` VALUES (6, 'sadsadsa', 'dasdsa', 'dasdasd', 'sadsad', 'Ava15685397312.png', '2019-09-15 16:28:51');
INSERT INTO `user` VALUES (8, 'Long', 'Đỗ', 'thanhlongtld123', '21232f297a57a5a743894a0e4a801fc3', 'Ava1568950182cau-be-phu-thuy-harry-potter-1.jpg', '2019-09-15 16:31:11');

-- ----------------------------
-- Table structure for video
-- ----------------------------
DROP TABLE IF EXISTS `video`;
CREATE TABLE `video`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of video
-- ----------------------------
INSERT INTO `video` VALUES (1, '                                                <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/nIjVuRTm-dc\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>     ', '<p>sadsad sadasdsadasddasdasdsadsaddsadasdasdsad</p>\r\n', '2019-09-03 10:36:23', 0);

SET FOREIGN_KEY_CHECKS = 1;
