/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : working_report

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 20/06/2020 13:30:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for blocks
-- ----------------------------
DROP TABLE IF EXISTS `blocks`;
CREATE TABLE `blocks`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã khối',
  `block_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Tên khối',
  `block_brief` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Tên viết tắt',
  `block_note` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'mô tả',
  `created_at` datetime(0) NULL DEFAULT NULL COMMENT 'NgayTao',
  `updated_at` datetime(0) NULL DEFAULT NULL COMMENT 'NgayThayDoi',
  `deleted_at` datetime(0) NULL DEFAULT NULL COMMENT 'ngày update',
  `block_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Email khối',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 108 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of blocks
-- ----------------------------
INSERT INTO `blocks` VALUES (1, 'KCN', NULL, 'Khối công nghệ', '2019-07-25 13:50:58', '2019-08-15 18:02:36', NULL, 'kcn@agrimedia.vn');
INSERT INTO `blocks` VALUES (6, 'B2C', NULL, 'Khối B2C', '2019-06-21 09:14:00', '2019-08-15 17:23:48', NULL, 'b2c@gmail.com');
INSERT INTO `blocks` VALUES (7, 'B2G', NULL, 'Khối B2G', '2019-06-21 09:14:15', '2019-06-24 09:39:51', NULL, 'b2g@agrimedia.com');
INSERT INTO `blocks` VALUES (8, 'HCNS', NULL, 'Hành chính nhân sự', '2019-06-21 09:14:31', '2019-08-02 15:17:36', NULL, 'hcns@agrimedia.com');
INSERT INTO `blocks` VALUES (99, 'PRD', NULL, 'Khối PRD', '2019-08-22 16:28:19', '2019-08-22 16:28:19', NULL, 'prd@agrimedia.vn');
INSERT INTO `blocks` VALUES (100, 'B2B', NULL, 'Khối B2B', '2019-08-22 16:29:45', '2019-08-22 16:29:45', NULL, 'b2b@agrimedia.vn');
INSERT INTO `blocks` VALUES (101, 'TCKT', NULL, 'Khối TCKT', '2019-08-23 14:03:51', '2019-08-23 14:03:51', NULL, 'tckt@agrimedia.vn');
INSERT INTO `blocks` VALUES (102, 'gaedga', NULL, NULL, '2019-08-26 08:48:38', '2020-06-18 01:16:08', '2020-06-18 01:16:08', 'acd@gmail.com');
INSERT INTO `blocks` VALUES (103, 'gaedga', NULL, NULL, '2019-08-26 08:49:00', '2019-08-26 10:28:05', '2019-08-26 10:28:05', 'acd@gmail.com');
INSERT INTO `blocks` VALUES (104, 'gaedga', NULL, NULL, '2019-08-26 09:15:27', '2019-08-26 10:27:58', '2019-08-26 10:27:58', 'acd@gmail.com');
INSERT INTO `blocks` VALUES (105, 'gaedga', NULL, NULL, '2019-08-26 09:15:37', '2019-08-26 10:27:52', '2019-08-26 10:27:52', 'acd@gmail.com');
INSERT INTO `blocks` VALUES (106, 'gaedga', NULL, NULL, '2019-08-26 09:15:56', '2019-08-26 10:27:44', '2019-08-26 10:27:44', 'acd@gmail.com');
INSERT INTO `blocks` VALUES (107, 'gaedga', NULL, NULL, '2019-08-26 09:16:05', '2019-08-26 10:27:38', '2019-08-26 10:27:38', 'acd@gmail.com');

-- ----------------------------
-- Table structure for corporation
-- ----------------------------
DROP TABLE IF EXISTS `corporation`;
CREATE TABLE `corporation`  (
  `id` int(10) NOT NULL,
  `corporation_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Tên pháp nhân',
  `corporation_detail` varchar(512) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'mô tả pháp nhân',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of corporation
-- ----------------------------
INSERT INTO `corporation` VALUES (1, 'AGRIMEDIA', '');
INSERT INTO `corporation` VALUES (2, 'STECH', '');
INSERT INTO `corporation` VALUES (3, 'SMI', NULL);
INSERT INTO `corporation` VALUES (4, 'A CHAU', 'Á châu');

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã phòng ban',
  `block_id` int(10) NULL DEFAULT NULL COMMENT 'Mã khối',
  `department_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Tên phòng ban',
  `department_note` varchar(526) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Mô tả',
  `created_at` datetime(0) NULL DEFAULT NULL COMMENT 'Ngày tạo',
  `updated_at` datetime(0) NULL DEFAULT NULL COMMENT 'Ngày thay đổi',
  `deleted_at` datetime(0) NULL DEFAULT NULL COMMENT 'ngày xóa',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 80 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES (1, 1, 'DEV', NULL, NULL, '2019-06-24 10:31:55', NULL);
INSERT INTO `departments` VALUES (11, 1, 'Vận hành', NULL, '2019-06-24 08:37:15', '2019-08-23 14:52:50', NULL);
INSERT INTO `departments` VALUES (12, 1, 'IT VAS', NULL, '2019-06-24 08:37:29', '2019-08-23 14:42:47', NULL);
INSERT INTO `departments` VALUES (13, 1, 'BA & TESTER..', NULL, '2019-06-24 08:37:41', '2019-08-02 14:28:41', NULL);
INSERT INTO `departments` VALUES (16, 5, 'B2B', NULL, '2019-07-03 06:35:09', '2019-07-03 06:35:09', NULL);
INSERT INTO `departments` VALUES (18, 7, 'Phòng B2G', NULL, '2019-07-03 06:35:32', '2019-08-23 14:52:24', NULL);
INSERT INTO `departments` VALUES (73, 6, 'Phòng B2C', NULL, '2019-08-23 14:42:12', '2019-08-23 14:42:12', NULL);
INSERT INTO `departments` VALUES (74, 101, 'Tài chính kế toán', NULL, '2019-08-23 14:43:38', '2019-08-23 14:43:38', NULL);
INSERT INTO `departments` VALUES (75, 100, 'Phòng B2B', NULL, '2019-08-23 14:43:59', '2019-08-23 14:43:59', NULL);
INSERT INTO `departments` VALUES (76, 99, 'Trạm thời tiết', NULL, '2019-08-23 14:44:31', '2019-08-23 14:44:31', NULL);
INSERT INTO `departments` VALUES (77, 8, 'Hành chính nhân sự', NULL, '2019-08-23 14:46:05', '2019-08-23 14:46:05', NULL);
INSERT INTO `departments` VALUES (78, 6, 'Telesales', NULL, '2019-08-23 15:00:58', '2019-08-23 15:00:58', NULL);
INSERT INTO `departments` VALUES (79, 6, 'Chăm sóc khách hàng', NULL, '2019-08-23 15:01:45', '2019-08-23 15:01:45', NULL);

-- ----------------------------
-- Table structure for early_late
-- ----------------------------
DROP TABLE IF EXISTS `early_late`;
CREATE TABLE `early_late`  (
  `id` int(4) NOT NULL COMMENT 'STT',
  `date` date NULL DEFAULT NULL COMMENT 'Ngày đăng ký',
  `user_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Mã nhân viên',
  `type` int(1) NULL DEFAULT NULL COMMENT '1: Đi muộn, 2: Về sớm',
  `minutes` bigint(4) NULL DEFAULT NULL COMMENT 'Số phút',
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Lý Do',
  `created_at` datetime(0) NULL DEFAULT NULL COMMENT 'ngày tạo',
  `updated_at` datetime(0) NULL DEFAULT NULL COMMENT 'ngày thay đổi',
  `deleted_at` datetime(0) NULL DEFAULT NULL COMMENT 'ngày xóa',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'Mã công việc',
  `job_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Loại công việc',
  `job_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `block_id` bigint(10) NULL DEFAULT NULL COMMENT 'Mã khối',
  `created_at` datetime(0) NULL DEFAULT NULL COMMENT 'ngày tạo',
  `updated_at` datetime(0) NULL DEFAULT NULL COMMENT 'ngày thay đổi',
  `deleted_at` datetime(0) NULL DEFAULT NULL COMMENT 'ngày xóa',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 87 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of jobs
-- ----------------------------
INSERT INTO `jobs` VALUES (82, 'Test case', 'Viết testcase', 1, '2019-08-16 16:07:29', '2019-08-19 10:26:39', NULL);
INSERT INTO `jobs` VALUES (83, 'Họp nội bộ', NULL, 1, '2019-08-16 16:07:41', '2019-08-16 16:07:41', NULL);
INSERT INTO `jobs` VALUES (84, 'ĐỐi soát', NULL, 1, '2019-08-16 16:07:59', '2019-08-16 16:07:59', NULL);
INSERT INTO `jobs` VALUES (85, 'làm mới', NULL, 1, '2019-08-16 16:12:26', '2019-08-16 16:12:26', NULL);
INSERT INTO `jobs` VALUES (86, 'hỗ trợ', NULL, 1, '2019-08-16 16:12:47', '2019-08-16 16:12:47', NULL);

-- ----------------------------
-- Table structure for leaves
-- ----------------------------
DROP TABLE IF EXISTS `leaves`;
CREATE TABLE `leaves`  (
  `id` int(4) NOT NULL COMMENT 'STT',
  `date` date NULL DEFAULT NULL COMMENT 'ngày đăng ký',
  `user_name` bigint(10) NULL DEFAULT NULL COMMENT 'mã nhân viên',
  `date_type` int(4) NULL DEFAULT NULL COMMENT '1: nghỉ cả ngày; 2: nghỉ buổi sáng; 3 nghỉ buổi chiều',
  `leave_type` int(1) NULL DEFAULT NULL COMMENT '1: nghỉ phép, 2: Đi công tác',
  `reason` bigint(10) NULL DEFAULT NULL COMMENT 'lý do nghỉ\r\n1: bận việc riêng\r\n2: nghỉ ốm\r\n3.....',
  `leave_old` float(4, 0) NULL DEFAULT NULL COMMENT 'Phép tồn năm cũ',
  `created_at` datetime(6) NULL DEFAULT NULL COMMENT 'ngày tạo',
  `updated_at` datetime(6) NULL DEFAULT NULL COMMENT 'ngày thay đổi',
  `deleted_at` datetime(6) NULL DEFAULT NULL COMMENT 'Ngày xóa',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for permission_screen
-- ----------------------------
DROP TABLE IF EXISTS `permission_screen`;
CREATE TABLE `permission_screen`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'STT',
  `action_screen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'mã màn hình, action',
  `permission_id` int(10) NULL DEFAULT NULL COMMENT 'mã quyền',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4195 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of permission_screen
-- ----------------------------
INSERT INTO `permission_screen` VALUES (4009, 'blocks', 8);
INSERT INTO `permission_screen` VALUES (4010, 'block.index', 8);
INSERT INTO `permission_screen` VALUES (4011, 'block.insert', 8);
INSERT INTO `permission_screen` VALUES (4012, 'block.update', 8);
INSERT INTO `permission_screen` VALUES (4013, 'block.destroy', 8);
INSERT INTO `permission_screen` VALUES (4014, 'departments', 8);
INSERT INTO `permission_screen` VALUES (4015, 'departments.index', 8);
INSERT INTO `permission_screen` VALUES (4016, 'departments.insert', 8);
INSERT INTO `permission_screen` VALUES (4017, 'departments.update', 8);
INSERT INTO `permission_screen` VALUES (4018, 'departments.destroy', 8);
INSERT INTO `permission_screen` VALUES (4019, 'jobs', 8);
INSERT INTO `permission_screen` VALUES (4020, 'jobs.index', 8);
INSERT INTO `permission_screen` VALUES (4021, 'jobs.insert', 8);
INSERT INTO `permission_screen` VALUES (4022, 'jobs.update', 8);
INSERT INTO `permission_screen` VALUES (4023, 'jobs.destroy', 8);
INSERT INTO `permission_screen` VALUES (4024, 'permissions', 8);
INSERT INTO `permission_screen` VALUES (4025, 'permissions.index', 8);
INSERT INTO `permission_screen` VALUES (4026, 'permissions.view', 8);
INSERT INTO `permission_screen` VALUES (4027, 'permissions.edit', 8);
INSERT INTO `permission_screen` VALUES (4028, 'permissions.destroy', 8);
INSERT INTO `permission_screen` VALUES (4029, 'projectblocks', 8);
INSERT INTO `permission_screen` VALUES (4030, 'projectblock.index', 8);
INSERT INTO `permission_screen` VALUES (4031, 'projectblock.insert', 8);
INSERT INTO `permission_screen` VALUES (4032, 'projectblock.update', 8);
INSERT INTO `permission_screen` VALUES (4033, 'projectblock.destroy', 8);
INSERT INTO `permission_screen` VALUES (4034, 'projects', 8);
INSERT INTO `permission_screen` VALUES (4035, 'projects.list', 8);
INSERT INTO `permission_screen` VALUES (4036, 'projects.insert', 8);
INSERT INTO `permission_screen` VALUES (4037, 'projects.update', 8);
INSERT INTO `permission_screen` VALUES (4038, 'projects.destroy', 8);
INSERT INTO `permission_screen` VALUES (4039, 'report', 8);
INSERT INTO `permission_screen` VALUES (4040, 'report.index', 8);
INSERT INTO `permission_screen` VALUES (4041, 'report.getDataReportLatest', 8);
INSERT INTO `permission_screen` VALUES (4042, 'report.insert', 8);
INSERT INTO `permission_screen` VALUES (4043, 'statiscalproject', 8);
INSERT INTO `permission_screen` VALUES (4044, 'statiscalProject.index', 8);
INSERT INTO `permission_screen` VALUES (4045, 'statistic', 8);
INSERT INTO `permission_screen` VALUES (4046, 'statistic.employees', 8);
INSERT INTO `permission_screen` VALUES (4047, 'users', 8);
INSERT INTO `permission_screen` VALUES (4048, 'users.index', 8);
INSERT INTO `permission_screen` VALUES (4049, 'users.ajax-get-data', 8);
INSERT INTO `permission_screen` VALUES (4050, 'users.ajax', 8);
INSERT INTO `permission_screen` VALUES (4051, 'users.view', 8);
INSERT INTO `permission_screen` VALUES (4052, 'users.view_edit', 8);
INSERT INTO `permission_screen` VALUES (4053, 'users.startView', 8);
INSERT INTO `permission_screen` VALUES (4054, 'users.destroy', 8);
INSERT INTO `permission_screen` VALUES (4055, 'workflow', 8);
INSERT INTO `permission_screen` VALUES (4056, 'workflow.view', 8);
INSERT INTO `permission_screen` VALUES (4057, 'workflow.ajax-get-data', 8);
INSERT INTO `permission_screen` VALUES (4058, 'workflow.ajax', 8);
INSERT INTO `permission_screen` VALUES (4059, 'workflow.edit', 8);
INSERT INTO `permission_screen` VALUES (4060, 'report', 7);
INSERT INTO `permission_screen` VALUES (4061, 'report.index', 7);
INSERT INTO `permission_screen` VALUES (4062, 'report.getDataReportLatest', 7);
INSERT INTO `permission_screen` VALUES (4063, 'report.insert', 7);
INSERT INTO `permission_screen` VALUES (4064, 'departments', 6);
INSERT INTO `permission_screen` VALUES (4065, 'departments.index', 6);
INSERT INTO `permission_screen` VALUES (4066, 'departments.insert', 6);
INSERT INTO `permission_screen` VALUES (4067, 'departments.update', 6);
INSERT INTO `permission_screen` VALUES (4068, 'departments.destroy', 6);
INSERT INTO `permission_screen` VALUES (4069, 'projects', 6);
INSERT INTO `permission_screen` VALUES (4070, 'projects.list', 6);
INSERT INTO `permission_screen` VALUES (4071, 'projects.insert', 6);
INSERT INTO `permission_screen` VALUES (4072, 'projects.update', 6);
INSERT INTO `permission_screen` VALUES (4073, 'projects.destroy', 6);
INSERT INTO `permission_screen` VALUES (4074, 'report', 6);
INSERT INTO `permission_screen` VALUES (4075, 'report.index', 6);
INSERT INTO `permission_screen` VALUES (4076, 'report.getDataReportLatest', 6);
INSERT INTO `permission_screen` VALUES (4077, 'report.insert', 6);
INSERT INTO `permission_screen` VALUES (4078, 'statiscalproject', 6);
INSERT INTO `permission_screen` VALUES (4079, 'statiscalProject.index', 6);
INSERT INTO `permission_screen` VALUES (4111, 'blocks', 4);
INSERT INTO `permission_screen` VALUES (4112, 'block.index', 4);
INSERT INTO `permission_screen` VALUES (4113, 'block.insert', 4);
INSERT INTO `permission_screen` VALUES (4114, 'block.update', 4);
INSERT INTO `permission_screen` VALUES (4115, 'block.destroy', 4);
INSERT INTO `permission_screen` VALUES (4116, 'departments', 4);
INSERT INTO `permission_screen` VALUES (4117, 'departments.index', 4);
INSERT INTO `permission_screen` VALUES (4118, 'departments.insert', 4);
INSERT INTO `permission_screen` VALUES (4119, 'departments.update', 4);
INSERT INTO `permission_screen` VALUES (4120, 'departments.destroy', 4);
INSERT INTO `permission_screen` VALUES (4121, 'jobs', 4);
INSERT INTO `permission_screen` VALUES (4122, 'jobs.index', 4);
INSERT INTO `permission_screen` VALUES (4123, 'jobs.insert', 4);
INSERT INTO `permission_screen` VALUES (4124, 'jobs.update', 4);
INSERT INTO `permission_screen` VALUES (4125, 'jobs.destroy', 4);
INSERT INTO `permission_screen` VALUES (4126, 'permissions', 4);
INSERT INTO `permission_screen` VALUES (4127, 'permissions.index', 4);
INSERT INTO `permission_screen` VALUES (4128, 'permissions.view', 4);
INSERT INTO `permission_screen` VALUES (4129, 'permissions.edit', 4);
INSERT INTO `permission_screen` VALUES (4130, 'permissions.destroy', 4);
INSERT INTO `permission_screen` VALUES (4131, 'projectblocks', 4);
INSERT INTO `permission_screen` VALUES (4132, 'projectblock.index', 4);
INSERT INTO `permission_screen` VALUES (4133, 'projectblock.insert', 4);
INSERT INTO `permission_screen` VALUES (4134, 'projectblock.update', 4);
INSERT INTO `permission_screen` VALUES (4135, 'projectblock.destroy', 4);
INSERT INTO `permission_screen` VALUES (4136, 'projects', 4);
INSERT INTO `permission_screen` VALUES (4137, 'projects.list', 4);
INSERT INTO `permission_screen` VALUES (4138, 'projects.insert', 4);
INSERT INTO `permission_screen` VALUES (4139, 'projects.update', 4);
INSERT INTO `permission_screen` VALUES (4140, 'projects.destroy', 4);
INSERT INTO `permission_screen` VALUES (4141, 'report', 4);
INSERT INTO `permission_screen` VALUES (4142, 'report.index', 4);
INSERT INTO `permission_screen` VALUES (4143, 'report.getDataReportLatest', 4);
INSERT INTO `permission_screen` VALUES (4144, 'report.insert', 4);
INSERT INTO `permission_screen` VALUES (4145, 'statiscalproject', 4);
INSERT INTO `permission_screen` VALUES (4146, 'statiscalProject.index', 4);
INSERT INTO `permission_screen` VALUES (4147, 'statistic', 4);
INSERT INTO `permission_screen` VALUES (4148, 'statistic.employees', 4);
INSERT INTO `permission_screen` VALUES (4149, 'users', 4);
INSERT INTO `permission_screen` VALUES (4150, 'users.index', 4);
INSERT INTO `permission_screen` VALUES (4151, 'users.ajax-get-data', 4);
INSERT INTO `permission_screen` VALUES (4152, 'users.ajax', 4);
INSERT INTO `permission_screen` VALUES (4153, 'users.view', 4);
INSERT INTO `permission_screen` VALUES (4154, 'users.view_edit', 4);
INSERT INTO `permission_screen` VALUES (4155, 'users.startView', 4);
INSERT INTO `permission_screen` VALUES (4156, 'users.destroy', 4);
INSERT INTO `permission_screen` VALUES (4157, 'workflow', 4);
INSERT INTO `permission_screen` VALUES (4158, 'workflow.view', 4);
INSERT INTO `permission_screen` VALUES (4159, 'workflow.ajax-get-data', 4);
INSERT INTO `permission_screen` VALUES (4160, 'workflow.ajax', 4);
INSERT INTO `permission_screen` VALUES (4161, 'workflow.edit', 4);
INSERT INTO `permission_screen` VALUES (4162, 'blocks', 5);
INSERT INTO `permission_screen` VALUES (4163, 'block.index', 5);
INSERT INTO `permission_screen` VALUES (4164, 'block.insert', 5);
INSERT INTO `permission_screen` VALUES (4165, 'block.update', 5);
INSERT INTO `permission_screen` VALUES (4166, 'block.destroy', 5);
INSERT INTO `permission_screen` VALUES (4167, 'departments', 5);
INSERT INTO `permission_screen` VALUES (4168, 'departments.index', 5);
INSERT INTO `permission_screen` VALUES (4169, 'departments.insert', 5);
INSERT INTO `permission_screen` VALUES (4170, 'departments.update', 5);
INSERT INTO `permission_screen` VALUES (4171, 'departments.destroy', 5);
INSERT INTO `permission_screen` VALUES (4172, 'jobs', 5);
INSERT INTO `permission_screen` VALUES (4173, 'jobs.index', 5);
INSERT INTO `permission_screen` VALUES (4174, 'jobs.insert', 5);
INSERT INTO `permission_screen` VALUES (4175, 'jobs.update', 5);
INSERT INTO `permission_screen` VALUES (4176, 'jobs.destroy', 5);
INSERT INTO `permission_screen` VALUES (4177, 'projectblocks', 5);
INSERT INTO `permission_screen` VALUES (4178, 'projectblock.index', 5);
INSERT INTO `permission_screen` VALUES (4179, 'projectblock.insert', 5);
INSERT INTO `permission_screen` VALUES (4180, 'projectblock.update', 5);
INSERT INTO `permission_screen` VALUES (4181, 'projectblock.destroy', 5);
INSERT INTO `permission_screen` VALUES (4182, 'projects', 5);
INSERT INTO `permission_screen` VALUES (4183, 'projects.list', 5);
INSERT INTO `permission_screen` VALUES (4184, 'projects.insert', 5);
INSERT INTO `permission_screen` VALUES (4185, 'projects.update', 5);
INSERT INTO `permission_screen` VALUES (4186, 'projects.destroy', 5);
INSERT INTO `permission_screen` VALUES (4187, 'report', 5);
INSERT INTO `permission_screen` VALUES (4188, 'report.index', 5);
INSERT INTO `permission_screen` VALUES (4189, 'report.getDataReportLatest', 5);
INSERT INTO `permission_screen` VALUES (4190, 'report.insert', 5);
INSERT INTO `permission_screen` VALUES (4191, 'statiscalproject', 5);
INSERT INTO `permission_screen` VALUES (4192, 'statiscalProject.index', 5);
INSERT INTO `permission_screen` VALUES (4193, 'statistic', 5);
INSERT INTO `permission_screen` VALUES (4194, 'statistic.employees', 5);

-- ----------------------------
-- Table structure for permission_user
-- ----------------------------
DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE `permission_user`  (
  `id` int(10) NOT NULL COMMENT 'STT',
  `permission_id` int(10) NULL DEFAULT NULL COMMENT 'Mã nhóm quyền',
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Mã quyền',
  `created_at` datetime(6) NULL DEFAULT NULL COMMENT 'Thời gian tạo',
  `updated_at` datetime(6) NULL DEFAULT NULL COMMENT 'Thời gian cập nhật',
  `deleted_at` datetime(6) NULL DEFAULT NULL COMMENT 'Thời gian xóa',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Mã nhóm quyền',
  `permission_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Tên nhóm quyền',
  `permission_note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Mô tả',
  `created_at` datetime(0) NULL DEFAULT NULL COMMENT 'Ngày tạo',
  `updated_at` datetime(0) NULL DEFAULT NULL COMMENT 'Ngày thay đổi',
  `deleted_at` datetime(0) NULL DEFAULT NULL COMMENT 'ngày xóa',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (4, 'Admin', NULL, '2019-06-28 09:50:01', '2019-08-22 15:04:37', NULL);
INSERT INTO `permissions` VALUES (5, 'Quản lý khối', NULL, '2019-06-28 09:50:05', '2019-08-26 16:12:28', NULL);
INSERT INTO `permissions` VALUES (6, 'Quản lý phòng', NULL, '2019-06-28 09:50:08', '2019-08-22 15:03:09', NULL);
INSERT INTO `permissions` VALUES (7, 'Nhân viên', NULL, '2019-07-22 08:42:44', '2019-08-22 15:01:30', NULL);
INSERT INTO `permissions` VALUES (8, 'Ban điều hành', NULL, '2019-07-23 10:00:20', '2019-08-22 15:00:55', NULL);

-- ----------------------------
-- Table structure for project_block
-- ----------------------------
DROP TABLE IF EXISTS `project_block`;
CREATE TABLE `project_block`  (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'Mã Dự án',
  `block_id` bigint(10) NULL DEFAULT NULL COMMENT 'Mã khối',
  `project_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Tên dự án',
  `project_content` varchar(127) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Mô tả dự án',
  `block_relate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Khối liên quan',
  `created_at` datetime(0) NULL DEFAULT NULL COMMENT 'ngày tạo',
  `updated_at` datetime(0) NULL DEFAULT NULL COMMENT 'Ngày thay đổi',
  `deleted_at` datetime(0) NULL DEFAULT NULL COMMENT 'ngày xóa',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 116 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of project_block
-- ----------------------------
INSERT INTO `project_block` VALUES (93, 1, '85', NULL, NULL, '2019-08-16 16:02:38', '2019-08-19 09:15:29', NULL);
INSERT INTO `project_block` VALUES (94, 1, '84', NULL, NULL, '2019-08-16 16:02:55', '2019-08-19 09:07:58', NULL);
INSERT INTO `project_block` VALUES (95, 1, '83', NULL, NULL, '2019-08-16 16:06:27', '2019-08-19 09:03:31', NULL);
INSERT INTO `project_block` VALUES (96, 1, '82', NULL, NULL, '2019-08-16 16:10:23', '2019-08-16 16:10:23', NULL);
INSERT INTO `project_block` VALUES (99, 1, '87', NULL, NULL, '2019-08-19 08:49:11', '2019-08-19 08:49:11', NULL);
INSERT INTO `project_block` VALUES (100, 7, '87', NULL, NULL, '2019-08-19 08:54:42', '2019-08-19 08:54:42', NULL);
INSERT INTO `project_block` VALUES (101, 1, '87', NULL, NULL, '2019-08-19 08:56:08', '2019-08-19 08:56:08', NULL);
INSERT INTO `project_block` VALUES (102, 7, '78', NULL, NULL, '2019-08-19 08:57:09', '2019-08-19 08:57:09', NULL);
INSERT INTO `project_block` VALUES (103, 59, '75', NULL, NULL, '2019-08-19 08:57:26', '2019-08-19 08:57:46', NULL);
INSERT INTO `project_block` VALUES (104, 59, '74', NULL, NULL, '2019-08-19 09:00:34', '2019-08-19 10:04:21', NULL);
INSERT INTO `project_block` VALUES (105, 59, '79', NULL, NULL, '2019-08-19 09:00:45', '2019-08-19 09:00:45', NULL);
INSERT INTO `project_block` VALUES (106, 1, '90', NULL, NULL, '2019-08-19 09:04:51', '2019-08-20 17:09:33', NULL);
INSERT INTO `project_block` VALUES (108, 7, '82', NULL, NULL, '2019-08-19 09:34:08', '2019-08-19 09:34:08', NULL);
INSERT INTO `project_block` VALUES (109, 7, '78', NULL, NULL, '2019-08-19 09:34:40', '2019-08-19 09:34:40', NULL);
INSERT INTO `project_block` VALUES (110, 7, '78', NULL, NULL, '2019-08-19 09:54:18', '2019-08-19 09:54:18', NULL);
INSERT INTO `project_block` VALUES (111, 7, '78', NULL, NULL, '2019-08-19 10:02:38', '2019-08-19 10:02:38', NULL);
INSERT INTO `project_block` VALUES (112, 7, '82', NULL, NULL, '2019-08-19 10:02:55', '2019-08-19 10:02:55', NULL);
INSERT INTO `project_block` VALUES (113, 1, '94', NULL, NULL, '2019-08-19 10:27:56', '2019-08-20 17:10:21', NULL);
INSERT INTO `project_block` VALUES (114, 1, '104', 'test 1222', NULL, '2019-08-20 17:11:38', '2019-08-23 14:04:34', NULL);
INSERT INTO `project_block` VALUES (115, 92, '110', 'test 1', NULL, '2019-08-21 13:07:37', '2019-08-21 13:07:47', NULL);

-- ----------------------------
-- Table structure for projects
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Mã dự án',
  `corporation_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Tên pháp nhân',
  `project_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Tên Dự án',
  `project_note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Nội dung mô tả',
  `created_at` datetime(0) NULL DEFAULT NULL COMMENT 'ngày tạo',
  `updated_at` datetime(0) NULL DEFAULT NULL COMMENT 'ngày thay đổi',
  `deleted_at` datetime(0) NULL DEFAULT NULL COMMENT 'ngày xóa',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 130 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of projects
-- ----------------------------
INSERT INTO `projects` VALUES (74, 'AGRIMEDIA', 'SEHO', NULL, '2019-08-16 15:59:44', '2019-08-16 15:59:44', NULL);
INSERT INTO `projects` VALUES (75, 'AGRIMEDIA', 'NNX-VNP', NULL, '2019-08-16 15:59:46', '2019-08-16 16:00:11', NULL);
INSERT INTO `projects` VALUES (76, 'SMI', 'DAM', NULL, '2019-08-16 16:00:57', '2019-08-16 19:46:27', NULL);
INSERT INTO `projects` VALUES (78, 'STECH', 'Dealtoday VNP', NULL, '2019-08-16 16:01:32', '2019-08-16 16:01:32', NULL);
INSERT INTO `projects` VALUES (79, 'AGRIMEDIA', 'PROD', NULL, '2019-08-16 16:06:08', '2019-08-16 16:06:08', NULL);
INSERT INTO `projects` VALUES (82, 'AGRIMEDIA', 'Okko', NULL, '2019-08-16 16:08:09', '2019-08-16 16:08:09', NULL);
INSERT INTO `projects` VALUES (83, 'AGRIMEDIA', 'IP Data123', NULL, '2019-08-16 16:11:40', '2019-08-19 09:01:42', NULL);
INSERT INTO `projects` VALUES (84, 'STECH', 'Giáo dục', NULL, '2019-08-16 19:07:13', '2019-08-16 19:07:13', NULL);
INSERT INTO `projects` VALUES (86, 'SMI', 'Vasonline VMS123', NULL, '2019-08-16 19:46:26', '2019-08-19 08:46:33', NULL);
INSERT INTO `projects` VALUES (87, 'SMI', 'Vasonline VMS', NULL, '2019-08-19 08:46:41', '2019-08-19 08:46:41', NULL);
INSERT INTO `projects` VALUES (88, 'SMI', 'test', NULL, '2019-08-19 08:53:38', '2019-08-19 08:53:38', NULL);
INSERT INTO `projects` VALUES (89, 'A CHAU', 'test1', NULL, '2019-08-19 08:53:55', '2019-08-19 11:45:19', NULL);
INSERT INTO `projects` VALUES (90, 'AGRIMEDIA', 'IP Data', NULL, '2019-08-19 09:01:55', '2019-08-19 09:01:55', NULL);
INSERT INTO `projects` VALUES (91, 'AGRIMEDIA', 'TG PHIM1', NULL, '2019-08-19 09:21:38', '2019-08-19 09:31:08', NULL);
INSERT INTO `projects` VALUES (94, 'STECH', 'TG PHIMm', NULL, '2019-08-19 09:30:39', '2019-08-20 13:42:07', NULL);
INSERT INTO `projects` VALUES (103, 'AGRIMEDIA', 'dự án 1', NULL, '2019-08-20 17:08:18', '2019-08-20 17:08:18', NULL);
INSERT INTO `projects` VALUES (104, 'STECH', 'dự án 2', NULL, '2019-08-20 17:08:38', '2019-08-20 17:08:38', NULL);
INSERT INTO `projects` VALUES (105, 'STECH', 'dự án 3', NULL, '2019-08-20 17:12:23', '2019-08-20 17:12:23', NULL);
INSERT INTO `projects` VALUES (106, 'A CHAU', 'dự án 4', NULL, '2019-08-20 17:12:31', '2019-08-20 17:12:31', NULL);
INSERT INTO `projects` VALUES (119, 'A CHAU', 'dự án 6', 'test', '2019-08-21 13:27:46', '2019-08-21 13:27:46', NULL);
INSERT INTO `projects` VALUES (120, 'SMI', 'vật lý', NULL, '2019-08-21 13:30:20', '2019-08-21 13:30:20', NULL);
INSERT INTO `projects` VALUES (122, 'SMI', 'hiếu', NULL, '2019-08-21 13:31:16', '2019-08-21 13:31:16', NULL);
INSERT INTO `projects` VALUES (123, 'AGRIMEDIA', 'DV BQLG', NULL, '2019-08-21 13:40:35', '2019-08-21 13:40:35', NULL);
INSERT INTO `projects` VALUES (124, 'AGRIMEDIA', 'Thái Nguyên', 'test1', '2019-08-21 13:43:45', '2019-08-21 13:54:05', NULL);
INSERT INTO `projects` VALUES (125, 'AGRIMEDIA', 'tool wr', NULL, '2019-08-21 13:54:02', '2019-08-21 13:54:02', NULL);
INSERT INTO `projects` VALUES (126, 'AGRIMEDIA', 'tool dự báo', NULL, '2019-08-21 13:54:22', '2019-08-21 13:54:22', NULL);
INSERT INTO `projects` VALUES (128, 'AGRIMEDIA', 'dam1', NULL, '2019-08-21 13:54:57', '2019-08-21 13:54:57', NULL);
INSERT INTO `projects` VALUES (129, 'AGRIMEDIA', 'tool wr', NULL, '2019-08-21 13:55:19', '2019-08-21 13:55:19', NULL);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(10) NOT NULL COMMENT 'Mã chức vụ',
  `role_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Tên chức vụ',
  `created_at` timestamp(0) NULL DEFAULT NULL COMMENT 'Ngày tạo',
  `updated_at` timestamp(0) NULL DEFAULT NULL COMMENT 'Ngày thay đổi',
  `deleted_at` timestamp(0) NULL DEFAULT NULL COMMENT 'ngày xóa',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Admin', '2019-06-05 10:41:04', '2019-06-05 10:41:09', '2019-06-05 10:41:12');
INSERT INTO `roles` VALUES (2, 'Ban điều hành', '2019-06-05 10:41:04', '2019-06-05 10:43:15', '2019-06-05 10:43:18');
INSERT INTO `roles` VALUES (3, 'Quản lý khối', '2019-06-05 10:43:55', '2019-06-05 10:43:58', '2019-06-05 10:44:00');
INSERT INTO `roles` VALUES (4, 'Quản lý phòng', '2019-06-05 10:44:24', '2019-06-05 10:44:26', '2019-06-05 10:44:29');
INSERT INTO `roles` VALUES (5, 'Nhân viên', '2019-06-05 10:44:57', '2019-06-05 10:45:00', '2019-06-05 10:45:02');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'Số thứ tự',
  `user_login` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Tên user đăng nhập',
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Mật khẩu',
  `fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Họ tên nhân viên',
  `department_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Phòng ban',
  `block_id` bigint(10) NULL DEFAULT NULL COMMENT 'Mã phòng nhân viên trực thuộc',
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Email nhân viên',
  `role_id` int(10) NULL DEFAULT NULL COMMENT 'vai trò',
  `permission` int(2) NULL DEFAULT NULL COMMENT 'Nhóm quyền',
  `created_at` timestamp(0) NULL DEFAULT NULL COMMENT 'Ngày tạo',
  `updated_at` timestamp(0) NULL DEFAULT NULL COMMENT 'Ngày thay đổi',
  `deleted_at` timestamp(0) NULL DEFAULT NULL COMMENT 'ngày xóa',
  `remember_token` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 225 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (27, 'vannt2', '$2b$10$eC7A4smSlSDLIoq0x94sD.gLdv62xc3Tka9bBWeVW7rlgsWT6eF7O', 'Nguyen Thi Van', '13', 1, 'ntvan1611@gmail.cvn', 3, 7, '2019-07-19 03:35:11', '2019-08-26 16:28:31', NULL, 'GLDZJQNDqPnJeHvWM5k0I9nT3QkERZdroVogVC0eThX1eXzZ85QYBY77xgPn');
INSERT INTO `users` VALUES (215, 'test', '$2y$10$Q00svbgQxrZI7yBTUjd6luR6jcgHF3JCeVGl.bkA0/h0mDvODKP9O', 'test', '1', 1, 'test@gmail.com', 5, 7, '2019-08-22 14:54:22', '2019-08-22 14:54:22', NULL, NULL);
INSERT INTO `users` VALUES (216, 'hieunv', '$2y$10$Q.lH01HpHuanPzinWhxybeWR7LxSJpfxk.J8T8zpffG0OpCD.DY22', 'NVH', '1', 1, 'nvh@gmail.com', 5, 7, '2019-08-22 17:24:58', '2019-08-22 17:24:58', NULL, NULL);
INSERT INTO `users` VALUES (217, 'ndh', '$2y$10$nAqhstmdITd20kFrXtjL0uRbc0LETpr4blAq1MjBzuWwsW3ADVMfK', 'NDH', '1', 1, 'nguyenhiu1412@gmail.com', 5, 4, '2019-08-23 09:00:42', '2019-08-26 16:21:59', NULL, NULL);
INSERT INTO `users` VALUES (218, 'admin', '$2y$10$wF/lxQl6MIbAIQSXqYx/FuSWVzV1f7SktLJnrNxzLz6VxZe4CbiDG', 'Super Admin', '1', 1, 'admin@agrimedia.vn', 1, 4, '2019-08-23 13:18:06', '2019-08-23 13:18:06', NULL, NULL);
INSERT INTO `users` VALUES (219, 'quanlykhoi', '$2y$10$lDNIJECtOLEFpCBnWd4MWedlryJSGBHFOli3et/V1zGiLvcI6rQAW', 'Quản Lý Khối KCN', '1', 1, 'quanlykhoi@agrimedia.vn', 3, 5, '2019-08-26 15:33:52', '2019-08-26 16:14:41', NULL, NULL);
INSERT INTO `users` VALUES (220, 'quanlyphong', '$2y$10$RCoIlwDX8HZ6Sn1sJOu/ZOQrfRaaTj0Zoo.52Aa7Z55UbHOfihEg2', 'Quản Lý Phòng Ban', '1', 1, 'quanlyphongban@agrimedia.vn', 4, 6, '2019-08-26 16:14:00', '2019-08-26 16:14:00', NULL, NULL);
INSERT INTO `users` VALUES (221, 'bandieuhanh', '$2y$10$yIqIwwxxGztYXGHucSo15./tUgeEFL9SpMrYilwgpla8TbLxoX.S2', 'Ban Điều Hành KCN', '1', 1, 'bandieuhanhkcn@agrimedia.vn', 2, 8, '2019-08-26 16:40:22', '2019-08-26 16:40:22', NULL, NULL);
INSERT INTO `users` VALUES (222, 'hanhchinhnhansu', '$2y$10$FO06Xczs/RrYfS0oObs/pOA8BQGrK8FxwRDi.R3cTT1hW8lMscloq', 'Hành Chính Nhân Sự', '77', 8, 'hanhchinhnhansu@agrimedia.vn', 1, 4, '2019-08-26 16:42:45', '2019-08-26 16:42:45', NULL, NULL);
INSERT INTO `users` VALUES (223, 'taichinhketoan', '$2y$10$D8e/5PzgntuoJFgyljv66eaRCdN5BZ7qgXyjzQSMrJ1luL0dlaYAa', 'Tài Chính Kế Toán', '74', 101, 'taichinhketoan@agrimedia.vn', 1, 4, '2019-08-26 16:51:34', '2019-08-26 16:51:34', NULL, NULL);
INSERT INTO `users` VALUES (224, 'b2b', '$2y$10$qY6ncSArQy78.hajFpMa5.dE6qByExpPG1.NGYl0Jt//gQ73cTame', 'Khối B2B', '75', 100, 'khoib2b@agrimedia.vn', 1, 4, '2019-08-26 16:52:43', '2019-08-26 16:52:43', NULL, NULL);

-- ----------------------------
-- Table structure for working_report
-- ----------------------------
DROP TABLE IF EXISTS `working_report`;
CREATE TABLE `working_report`  (
  `id` bigint(10) NOT NULL AUTO_INCREMENT COMMENT 'STT',
  `user_login` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'tên nhân viên đăng nhập hệ thống',
  `work_date` timestamp(0) NULL DEFAULT NULL COMMENT 'ngày báo cáo',
  `relate_block` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Khối liên quan',
  `project_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'tên dự án',
  `work_content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'nội dung công viêc',
  `work_type` bigint(10) NULL DEFAULT NULL COMMENT 'Loại công việc',
  `execute_time` float(10, 2) NULL DEFAULT NULL COMMENT 'thời gian thực hiện, tính theo giờ',
  `progress` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'hiện trạng % xử lý công việc',
  `target` bigint(10) NULL DEFAULT NULL COMMENT 'Mục tiêu',
  `result` bigint(10) NULL DEFAULT NULL COMMENT 'kết quả',
  `late` int(1) NULL DEFAULT NULL COMMENT '0: Không trễ, 1: có trễ',
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'note vấn đề',
  `created_at` timestamp(0) NULL DEFAULT NULL COMMENT 'ngày tạo',
  `updated_at` timestamp(0) NULL DEFAULT NULL COMMENT 'ngày thay đổi',
  `deleted_at` timestamp(0) NULL DEFAULT NULL COMMENT 'ngày xóa',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 821 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of working_report
-- ----------------------------
INSERT INTO `working_report` VALUES (814, 'admin', '2019-08-22 00:00:00', '93', '84', 'test', 82, 4.00, '20', NULL, NULL, 0, NULL, '2019-08-22 13:08:45', '2019-08-22 13:09:48', '2019-08-22 13:09:48');
INSERT INTO `working_report` VALUES (815, 'admin', '2019-08-22 00:00:00', '93', '84', 'test123', 82, 4.00, '20', NULL, NULL, 0, 'testttttt', '2019-08-22 13:09:48', '2019-08-22 13:09:48', NULL);
INSERT INTO `working_report` VALUES (816, 'ndh', '2019-08-22 00:00:00', '1', '84', 'test', 82, 8.00, '50', NULL, NULL, 1, 'test', '2019-08-23 09:05:26', '2019-08-23 13:47:46', NULL);
INSERT INTO `working_report` VALUES (817, 'ndh', '2019-08-23 00:00:00', '1', '84', 'test', 82, 8.00, '20', NULL, NULL, 0, 'test', '2019-08-23 15:36:24', '2019-08-23 15:41:48', '2019-08-23 15:41:48');
INSERT INTO `working_report` VALUES (818, 'ndh', '2019-08-23 00:00:00', '99', '87', 'hhhhhh', 84, 12.00, '100', NULL, NULL, 0, 'testtt', '2019-08-23 15:54:13', '2019-08-23 15:56:17', '2019-08-23 15:56:17');
INSERT INTO `working_report` VALUES (819, 'ndh', '2019-08-23 00:00:00', '101', '83', 'egtwests', 83, 4.00, '15', NULL, NULL, 0, '3q5', '2019-08-23 15:56:21', '2019-08-24 13:24:11', '2019-08-24 13:24:11');
INSERT INTO `working_report` VALUES (820, 'ndh', '2019-08-23 00:00:00', '8', '83', 'testtt', 83, 8.00, '20', NULL, NULL, 0, NULL, '2019-08-24 13:24:16', '2019-08-24 13:24:16', NULL);

SET FOREIGN_KEY_CHECKS = 1;
