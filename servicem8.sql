/*
 Navicat Premium Dump SQL

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80403 (8.4.3)
 Source Host           : localhost:3306
 Source Schema         : servicem8

 Target Server Type    : MySQL
 Target Server Version : 80403 (8.4.3)
 File Encoding         : 65001

 Date: 27/01/2026 00:24:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for files
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `folder_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mime_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `size` bigint NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_files_folder`(`folder_id` ASC) USING BTREE,
  CONSTRAINT `fk_files_folder` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of files
-- ----------------------------
INSERT INTO `files` VALUES (1, 2, 'WhatsApp Image 2026-01-03 at 12.36.47 AM.jpeg', 'documents/1Y120rylCequ7Jmp8mTDtsT9RgcDx3Br8qeiRaKR.jpg', 'image/jpeg', 47188, '2026-01-24 20:53:33', '2026-01-24 20:53:33');
INSERT INTO `files` VALUES (2, 4, '10.151.1.241_Syvox_2.0_public_dashboard (1).png', 'documents/dXwEfeH8X9Ql3qHlB8bztqoF3dKlOVAq6uIVHCRq.png', 'image/png', 758762, '2026-01-24 23:12:46', '2026-01-24 23:12:46');

-- ----------------------------
-- Table structure for folders
-- ----------------------------
DROP TABLE IF EXISTS `folders`;
CREATE TABLE `folders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `parent_id` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_folders_parent`(`parent_id` ASC) USING BTREE,
  CONSTRAINT `fk_folders_parent` FOREIGN KEY (`parent_id`) REFERENCES `folders` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of folders
-- ----------------------------
INSERT INTO `folders` VALUES (2, 'test', NULL, '2026-01-24 20:53:23', '2026-01-24 20:53:23');
INSERT INTO `folders` VALUES (3, 'test', 2, '2026-01-24 20:53:52', '2026-01-24 20:53:52');
INSERT INTO `folders` VALUES (4, 'atiq', 2, '2026-01-24 23:12:22', '2026-01-24 23:12:22');
INSERT INTO `folders` VALUES (5, 'khizer', 4, '2026-01-24 23:13:12', '2026-01-24 23:13:12');

-- ----------------------------
-- Table structure for icons
-- ----------------------------
DROP TABLE IF EXISTS `icons`;
CREATE TABLE `icons`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `active` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT 'Yes',
  `deleted_at` int NULL DEFAULT NULL,
  `created_at` int NULL DEFAULT NULL,
  `updated_at` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2767 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of icons
-- ----------------------------
INSERT INTO `icons` VALUES (1, 'pencil', 'border', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2597, 'address-book', 'uf2b9', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2598, 'address-card', 'uf2bb', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2599, 'adjust', 'uf042', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2600, 'air-freshener', 'uf5d0', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2601, 'align-center', 'uf037', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2602, 'align-justify', 'uf039', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2603, 'align-left', 'uf036', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2604, 'align-right', 'uf038', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2605, 'ambulance', 'uf0f9', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2606, 'anchor', 'uf13d', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2607, 'angle-double-down', 'uf103', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2608, 'angle-double-left', 'uf100', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2609, 'angle-double-right', 'uf101', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2610, 'angle-double-up', 'uf102', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2611, 'angle-down', 'uf107', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2612, 'angle-left', 'uf104', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2613, 'angle-right', 'uf105', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2614, 'angle-up', 'uf106', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2615, 'archive', 'uf187', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2616, 'arrow-alt-circle-down', 'uf358', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2617, 'arrow-alt-circle-left', 'uf359', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2618, 'arrow-alt-circle-right', 'uf35a', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2619, 'arrow-alt-circle-up', 'uf35b', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2620, 'arrow-circle-down', 'uf0ab', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2621, 'arrow-circle-left', 'uf0a8', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2622, 'arrow-circle-right', 'uf0a9', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2623, 'arrow-circle-up', 'uf0aa', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2624, 'arrow-down', 'uf063', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2625, 'arrow-left', 'uf060', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2626, 'arrow-right', 'uf061', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2627, 'arrow-up', 'uf062', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2628, 'arrows-alt', 'uf0b2', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2629, 'asterisk', 'uf069', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2630, 'at', 'uf1fa', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2631, 'award', 'uf559', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2632, 'baby', 'uf77c', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2633, 'backspace', 'uf55a', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2634, 'backward', 'uf04a', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2635, 'balance-scale', 'uf24e', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2636, 'ban', 'uf05e', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2637, 'barcode', 'uf02a', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2638, 'bars', 'uf0c9', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2639, 'battery-empty', 'uf244', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2640, 'battery-full', 'uf240', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2641, 'battery-half', 'uf242', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2642, 'bed', 'uf236', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2643, 'beer', 'uf0fc', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2644, 'bell', 'uf0f3', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2645, 'bicycle', 'uf206', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2646, 'binoculars', 'uf1e5', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2647, 'birthday-cake', 'uf1fd', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2648, 'bolt', 'uf0e7', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2649, 'bomb', 'uf1e2', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2650, 'book', 'uf02d', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2651, 'bookmark', 'uf02e', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2652, 'briefcase', 'uf0b1', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2653, 'bug', 'uf188', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2654, 'building', 'uf1ad', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2655, 'bullhorn', 'uf0a1', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2656, 'bullseye', 'uf140', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2657, 'bus', 'uf207', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2658, 'calculator', 'uf1ec', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2659, 'calendar', 'uf133', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2660, 'camera', 'uf030', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2661, 'car', 'uf1b9', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2662, 'certificate', 'uf0a3', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2663, 'chart-bar', 'uf080', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2664, 'chart-line', 'uf201', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2665, 'chart-pie', 'uf200', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2666, 'check', 'uf00c', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2667, 'check-circle', 'uf058', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2668, 'child', 'uf1ae', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2669, 'circle', 'uf111', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2670, 'clipboard', 'uf328', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2671, 'clock', 'uf017', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2672, 'cloud', 'uf0c2', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2673, 'code', 'uf121', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2674, 'coffee', 'uf0f4', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2675, 'cog', 'uf013', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2676, 'comment', 'uf075', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2677, 'comments', 'uf086', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2678, 'compass', 'uf14e', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2679, 'copy', 'uf0c5', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2680, 'credit-card', 'uf09d', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2681, 'cube', 'uf1b2', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2682, 'database', 'uf1c0', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2683, 'desktop', 'uf108', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2684, 'download', 'uf019', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2685, 'edit', 'uf044', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2686, 'envelope', 'uf0e0', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2687, 'exclamation-circle', 'uf06a', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2688, 'eye', 'uf06e', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2689, 'file', 'uf15b', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2690, 'filter', 'uf0b0', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2691, 'fire', 'uf06d', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2692, 'flag', 'uf024', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2693, 'flask', 'uf0c3', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2694, 'folder', 'uf07b', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2695, 'forward', 'uf04e', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2696, 'gamepad', 'uf11b', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2697, 'gift', 'uf06b', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2698, 'globe', 'uf0ac', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2699, 'graduation-cap', 'uf19d', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2700, 'handshake', 'uf2b5', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2701, 'headphones', 'uf025', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2702, 'heart', 'uf004', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2703, 'home', 'uf015', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2704, 'id-badge', 'uf2c1', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2705, 'image', 'uf03e', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2706, 'info-circle', 'uf05a', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2707, 'key', 'uf084', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2708, 'keyboard', 'uf11c', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2709, 'laptop', 'uf109', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2710, 'leaf', 'uf06c', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2711, 'lightbulb', 'uf0eb', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2712, 'link', 'uf0c1', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2713, 'list', 'uf03a', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2714, 'lock', 'uf023', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2715, 'map-marker', 'uf041', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2716, 'medal', 'uf5a2', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2717, 'microphone', 'uf130', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2718, 'minus', 'uf068', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2719, 'mobile', 'uf10b', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2720, 'money-bill', 'uf0d6', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2721, 'moon', 'uf186', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2722, 'music', 'uf001', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2723, 'paperclip', 'uf0c6', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2724, 'pause', 'uf04c', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2725, 'pen', 'uf304', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2726, 'phone', 'uf095', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2727, 'play', 'uf04b', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2728, 'plus', 'uf067', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2729, 'print', 'uf02f', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2730, 'question-circle', 'uf059', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2731, 'recycle', 'uf1b8', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2732, 'redo', 'uf01e', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2733, 'reply', 'uf3e5', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2734, 'rocket', 'uf135', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2735, 'save', 'uf0c7', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2736, 'search', 'uf002', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2737, 'server', 'uf233', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2738, 'shopping-cart', 'uf07a', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2739, 'sign-in-alt', 'uf2f6', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2740, 'sign-out-alt', 'uf2f5', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2741, 'sitemap', 'uf0e8', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2742, 'smile', 'uf118', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2743, 'spinner', 'uf110', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2744, 'star', 'uf005', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2745, 'stop', 'uf04d', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2746, 'sun', 'uf185', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2747, 'sync', 'uf021', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2748, 'table', 'uf0ce', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2749, 'tag', 'uf02b', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2750, 'tasks', 'uf0ae', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2751, 'thumbs-down', 'uf165', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2752, 'thumbs-up', 'uf164', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2753, 'times', 'uf00d', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2754, 'trash', 'uf1f8', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2755, 'trophy', 'uf091', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2756, 'truck', 'uf0d1', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2757, 'undo', 'uf0e2', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2758, 'unlock', 'uf09c', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2759, 'upload', 'uf093', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2760, 'user', 'uf007', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2761, 'user-circle', 'uf2bd', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2762, 'users', 'uf0c0', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2763, 'video', 'uf03d', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2764, 'wallet', 'uf555', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2765, 'wifi', 'uf1eb', 'Yes', NULL, NULL, NULL);
INSERT INTO `icons` VALUES (2766, 'wrench', 'uf0ad', 'Yes', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_lang` json NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `route_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` int NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `parent_id` bigint NOT NULL DEFAULT 0,
  `order` int NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 693 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (684, 'Permissions', 'Permissions', NULL, 'bullseye', NULL, 'permissions', 114, 1, 0, 0, '2026-01-26 23:26:19', '2026-01-26 23:26:19');
INSERT INTO `menus` VALUES (685, 'Roles', 'Roles', NULL, 'wrench', NULL, 'roles', 114, 1, 0, 0, '2026-01-26 23:26:57', '2026-01-26 23:26:57');
INSERT INTO `menus` VALUES (686, 'Users', 'Users', NULL, 'server', NULL, 'users', 114, 1, 0, 0, '2026-01-26 23:27:46', '2026-01-26 23:27:46');
INSERT INTO `menus` VALUES (687, 'Menus', 'Menus', NULL, 'sitemap', NULL, 'menus.index', 114, 1, 0, 0, '2026-01-26 23:28:22', '2026-01-26 23:28:22');
INSERT INTO `menus` VALUES (688, 'Staff', 'Staff', NULL, 'recycle', NULL, 'servicem8.staff', 114, 1, 0, 0, '2026-01-26 23:29:12', '2026-01-26 23:29:12');
INSERT INTO `menus` VALUES (689, 'Clients', 'Clients', NULL, 'barcode', NULL, 'servicem8.clients', 113, 1, 0, 0, '2026-01-26 23:29:59', '2026-01-26 23:29:59');
INSERT INTO `menus` VALUES (690, 'Jobs', 'Jobs', NULL, 'bookmark', NULL, 'servicem8.jobs', 114, 1, 0, 0, '2026-01-26 23:31:15', '2026-01-26 23:31:15');
INSERT INTO `menus` VALUES (691, 'Documents', 'Documents', NULL, 'clipboard', NULL, 'documents.index', 114, 1, 0, 0, '2026-01-26 23:31:56', '2026-01-26 23:31:56');
INSERT INTO `menus` VALUES (692, 'Dashboard', 'Dashboard', NULL, 'chart-bar', NULL, 'dashboard-index', 113, 1, 0, 0, '2026-01-26 23:32:40', '2026-01-26 23:32:40');

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_type` varchar(573) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `model_id` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`permission_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (6, 'App\\Models\\User', 1948);

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL DEFAULT 0,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int NULL DEFAULT NULL,
  `updated_at` int NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 115 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (113, 0, 'User', 'web', 1769451918, 1769451918, 1, 1);
INSERT INTO `permissions` VALUES (114, 113, 'user-create', 'web', 1769451918, 1769451918, 1, 1);

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint NOT NULL,
  `role_id` bigint NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (113, 6);
INSERT INTO `role_has_permissions` VALUES (114, 6);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int NULL DEFAULT NULL,
  `updated_at` int NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `auto_assign` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'No',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (6, 'Staff', 'web', 1769452514, 1769452514, 1, 1, 'No');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deleted_at` int NULL DEFAULT NULL,
  `created_at` int NULL DEFAULT NULL,
  `updated_at` int NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `settings_key_unique`(`key` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of settings
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` int NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` int NULL DEFAULT NULL,
  `updated_at` int NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `is_active` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'Yes',
  `password_reset_required` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username` ASC) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1949 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin', '123456', 'admin@admin.com', '$2y$12$.Y6d4lk5uD81dsLCBhyE/.QoHHr8cbOyrYLxgxQuDzPS7d2qq15rm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', NULL);
INSERT INTO `users` VALUES (1948, 'admin@example.com', 'Alex', '12345678', 'admin@example.com', '$2y$10$xQiLT6XVpnKpu.9bA91J..vWSfzfSv3BueaQdJwcKzfYyQOAfZGHm', NULL, NULL, NULL, 1769452643, 1769452643, NULL, NULL, 'Yes', NULL);

SET FOREIGN_KEY_CHECKS = 1;
