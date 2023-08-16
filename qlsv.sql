/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100408
 Source Host           : localhost:3306
 Source Schema         : qlsv

 Target Server Type    : MariaDB
 Target Server Version : 100408
 File Encoding         : 65001

 Date: 12/04/2023 13:16:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for register
-- ----------------------------
DROP TABLE IF EXISTS `register`;
CREATE TABLE `register`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `score` float(255, 0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_student`(`student_id`) USING BTREE,
  INDEX `fk_subject`(`subject_id`) USING BTREE,
  CONSTRAINT `fk_student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_subject` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of register
-- ----------------------------
INSERT INTO `register` VALUES (3, 1, 1, 9);
INSERT INTO `register` VALUES (4, 7, 2, 10);
INSERT INTO `register` VALUES (5, 7, 3, 10);
INSERT INTO `register` VALUES (10, 7, 3, 10);
INSERT INTO `register` VALUES (11, 8, 7, 10);
INSERT INTO `register` VALUES (12, 26, 8, 10);
INSERT INTO `register` VALUES (14, 8, 10, 10);
INSERT INTO `register` VALUES (15, 32, 12, 8);

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES (1, 'Hà', '2023-01-05', 'nữ');
INSERT INTO `student` VALUES (2, 'Tân Sửu', '2023-01-10', 'nữ');
INSERT INTO `student` VALUES (3, 'Dần', '2023-01-20', 'khác');
INSERT INTO `student` VALUES (7, 'Tú Uyên', '2005-06-13', 'nữ');
INSERT INTO `student` VALUES (8, 'Minh', '1995-12-11', 'nam');
INSERT INTO `student` VALUES (9, 'Bảo', '2023-01-19', 'nam');
INSERT INTO `student` VALUES (24, 'Hằng', '2023-02-18', 'nữ');
INSERT INTO `student` VALUES (25, 'Uyên Nguyễn', '2023-02-24', 'nữ');
INSERT INTO `student` VALUES (26, 'An Nguyễn', '2023-02-11', 'nam');
INSERT INTO `student` VALUES (31, 'Tú Uyên', '2023-02-18', 'nữ');
INSERT INTO `student` VALUES (32, 'Gia Bảo', '2023-04-20', 'nam');

-- ----------------------------
-- Table structure for subject
-- ----------------------------
DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ects` int(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subject
-- ----------------------------
INSERT INTO `subject` VALUES (1, 'Math', 20);
INSERT INTO `subject` VALUES (2, 'Tin Học Văn Phòng', 15);
INSERT INTO `subject` VALUES (3, 'Java 1', 20);
INSERT INTO `subject` VALUES (4, 'Java 2', 20);
INSERT INTO `subject` VALUES (7, 'Technology', 25);
INSERT INTO `subject` VALUES (8, 'Math 2', 20);
INSERT INTO `subject` VALUES (10, 'Physical Reel', 25);
INSERT INTO `subject` VALUES (12, 'Web App', 20);
INSERT INTO `subject` VALUES (14, 'Dark', 25);
INSERT INTO `subject` VALUES (15, 'C++', 25);
INSERT INTO `subject` VALUES (16, 'Javascript', 20);

SET FOREIGN_KEY_CHECKS = 1;
