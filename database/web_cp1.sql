/*
 Navicat Premium Data Transfer

 Source Server         : MYSQL LOCAL WINDOWS
 Source Server Type    : MySQL
 Source Server Version : 50722
 Source Host           : localhost:3306
 Source Schema         : web_cp1

 Target Server Type    : MySQL
 Target Server Version : 50722
 File Encoding         : 65001

 Date: 01/07/2021 20:22:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_about
-- ----------------------------
DROP TABLE IF EXISTS `m_about`;
CREATE TABLE `m_about`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `map` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_about
-- ----------------------------
INSERT INTO `m_about` VALUES (1, 'http://localhost:85/web-cp1/assets/uploads/as.png', 'Masjid Baiturrahman', 'baiturrahman@email.com', '081566677778', 'Jl Raya Cigudeg No 14 RT 001 / RW 007 Desa Cigudeg Bogor', 'https://maps.google.com/maps?q=cigudeg&t=&z=13&ie=UTF8&iwloc=&output=embed', 'Masjid baiturrahman didirikan sejak tahun 1788 oleh pemuda pemuda berkarya pada zamannya');

-- ----------------------------
-- Table structure for m_banner
-- ----------------------------
DROP TABLE IF EXISTS `m_banner`;
CREATE TABLE `m_banner`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tag_line` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_banner
-- ----------------------------
INSERT INTO `m_banner` VALUES (1, 'http://localhost:85/web-cp1/assets/uploads/a.jpg', 'Masji Baiturrahman', 'Masjid yang terlatak di daerah bogor jawa barat , cigudeg');
INSERT INTO `m_banner` VALUES (2, 'http://localhost:85/web-cp1/assets/uploads/e.jpeg', 'Didirikan sejak 1788', 'Masjid baiturrahman didirikan sejak tahun 1788');
INSERT INTO `m_banner` VALUES (3, 'http://localhost:85/web-cp1/assets/uploads/asas.jpg', 'Pengajian', 'Pengajian bulanan masjid baiturrahman');

-- ----------------------------
-- Table structure for m_berita
-- ----------------------------
DROP TABLE IF EXISTS `m_berita`;
CREATE TABLE `m_berita`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `posted_date` timestamp(0) NULL DEFAULT NULL,
  `desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_berita
-- ----------------------------
INSERT INTO `m_berita` VALUES (1, 'Berita 1', '2021-06-26 17:12:18', 'Lorem ipsum dolor sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.', 'http://localhost:85/web-cp1/assets/uploads/12.jpg');
INSERT INTO `m_berita` VALUES (2, 'Berita 2', '2021-06-26 17:12:34', 'Lorem ipsum dolor sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.', 'http://localhost:85/web-cp1/assets/uploads/13.jpg');
INSERT INTO `m_berita` VALUES (3, 'Berita 3', '2021-06-26 17:12:45', 'Lorem ipsum dolor sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.', 'http://localhost:85/web-cp1/assets/uploads/14.jpg');
INSERT INTO `m_berita` VALUES (4, 'Masjid Baru', '2021-06-30 22:12:30', 'Lorem ipsum dolor sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.sit amet conse adipis elit Assumenda repud eum veniam optio modi sit explicabo nisi magnam quibusdam.', 'http://localhost:85/web-cp1/assets/uploads/asas2.jpg');

-- ----------------------------
-- Table structure for m_hewan
-- ----------------------------
DROP TABLE IF EXISTS `m_hewan`;
CREATE TABLE `m_hewan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hewan_jenis_id` int(11) NULL DEFAULT NULL,
  `hewan_golongan_id` int(11) NULL DEFAULT NULL,
  `weight` int(11) NULL DEFAULT NULL,
  `label` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `price` bigint(50) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `hj_f`(`hewan_jenis_id`) USING BTREE,
  INDEX `hg_f`(`hewan_golongan_id`) USING BTREE,
  CONSTRAINT `hg_f` FOREIGN KEY (`hewan_golongan_id`) REFERENCES `m_hewan_golongan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `hj_f` FOREIGN KEY (`hewan_jenis_id`) REFERENCES `m_hewan_jenis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_hewan
-- ----------------------------
INSERT INTO `m_hewan` VALUES (1, 1, 1, 300, 'KG', 20000000);
INSERT INTO `m_hewan` VALUES (2, 1, 1, 250, 'KG', 17000000);
INSERT INTO `m_hewan` VALUES (3, 1, 2, 300, 'KG', 18000000);
INSERT INTO `m_hewan` VALUES (4, 2, 1, 300, 'KG', 15000000);
INSERT INTO `m_hewan` VALUES (5, 1, 1, 400, 'KG', 35000000);
INSERT INTO `m_hewan` VALUES (6, 2, 2, 500, 'KG', 89000000);

-- ----------------------------
-- Table structure for m_hewan_golongan
-- ----------------------------
DROP TABLE IF EXISTS `m_hewan_golongan`;
CREATE TABLE `m_hewan_golongan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_hewan_golongan
-- ----------------------------
INSERT INTO `m_hewan_golongan` VALUES (1, 'A');
INSERT INTO `m_hewan_golongan` VALUES (2, 'B');
INSERT INTO `m_hewan_golongan` VALUES (3, 'C');

-- ----------------------------
-- Table structure for m_hewan_jenis
-- ----------------------------
DROP TABLE IF EXISTS `m_hewan_jenis`;
CREATE TABLE `m_hewan_jenis`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_hewan_jenis
-- ----------------------------
INSERT INTO `m_hewan_jenis` VALUES (1, 'Sapi');
INSERT INTO `m_hewan_jenis` VALUES (2, 'Kerbau');
INSERT INTO `m_hewan_jenis` VALUES (3, 'Kambing');

-- ----------------------------
-- Table structure for m_jamaah
-- ----------------------------
DROP TABLE IF EXISTS `m_jamaah`;
CREATE TABLE `m_jamaah`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_jamaah
-- ----------------------------
INSERT INTO `m_jamaah` VALUES (8, 'Aldi', '0898891289', 'Gardu Seri');

-- ----------------------------
-- Table structure for m_jamaah_group
-- ----------------------------
DROP TABLE IF EXISTS `m_jamaah_group`;
CREATE TABLE `m_jamaah_group`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_jamaah_group
-- ----------------------------
INSERT INTO `m_jamaah_group` VALUES (6, 'Banyek');

-- ----------------------------
-- Table structure for m_jamaah_group_map
-- ----------------------------
DROP TABLE IF EXISTS `m_jamaah_group_map`;
CREATE TABLE `m_jamaah_group_map`  (
  `jamaah_group_id` int(11) NOT NULL,
  `jamaah_id` int(11) NOT NULL,
  PRIMARY KEY (`jamaah_group_id`, `jamaah_id`) USING BTREE,
  INDEX `jm_f`(`jamaah_id`) USING BTREE,
  CONSTRAINT `jm_f` FOREIGN KEY (`jamaah_id`) REFERENCES `m_jamaah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jmg_f` FOREIGN KEY (`jamaah_group_id`) REFERENCES `m_jamaah_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_jamaah_group_map
-- ----------------------------
INSERT INTO `m_jamaah_group_map` VALUES (6, 8);

-- ----------------------------
-- Table structure for m_kegiatan
-- ----------------------------
DROP TABLE IF EXISTS `m_kegiatan`;
CREATE TABLE `m_kegiatan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_kegiatan
-- ----------------------------
INSERT INTO `m_kegiatan` VALUES (1, 'fa-money', 'Infaq', 'Mencatat semua data infaq masuk, dan membuat laporan infaq');
INSERT INTO `m_kegiatan` VALUES (2, 'fa-calculator', 'Zakat', 'Mencatat semua data zakat, dan membuat laporan data zakat');
INSERT INTO `m_kegiatan` VALUES (3, 'fa-calendar', 'Tabungan Qurban', 'Menabung atau iyuran untuk qurban, setiap jamaah bisa melakukan iyuran untuk qurban');

-- ----------------------------
-- Table structure for m_pengurus
-- ----------------------------
DROP TABLE IF EXISTS `m_pengurus`;
CREATE TABLE `m_pengurus`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `profession` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_pengurus
-- ----------------------------
INSERT INTO `m_pengurus` VALUES (1, 'http://localhost:85/web-cp1/assets/uploads/ss1.jpg', 'Ust Somad', 'Imam Besar ');
INSERT INTO `m_pengurus` VALUES (2, 'http://localhost:85/web-cp1/assets/uploads/ss2.jpg', 'Ust Solmed', 'Imam Besar');
INSERT INTO `m_pengurus` VALUES (3, 'http://localhost:85/web-cp1/assets/uploads/ss3.jpg', 'Ust Jefri', 'Imam Besar');
INSERT INTO `m_pengurus` VALUES (4, 'http://localhost:85/web-cp1/assets/uploads/ss4.jpg', 'Ust Yusuf', 'Imam Besar');

-- ----------------------------
-- Table structure for m_trans_type
-- ----------------------------
DROP TABLE IF EXISTS `m_trans_type`;
CREATE TABLE `m_trans_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `saldo` bigint(50) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_trans_type
-- ----------------------------
INSERT INTO `m_trans_type` VALUES (1, 'INFAQ', 0);
INSERT INTO `m_trans_type` VALUES (2, 'ZAKAT MAL', 0);
INSERT INTO `m_trans_type` VALUES (3, 'ZAKAT FITRAH', 0);
INSERT INTO `m_trans_type` VALUES (4, 'KAS', 0);

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES (1, 'admin', '$2y$10$UBgOG.JJISMZRp2I1CcaoulwTYremuGkF4N4WHgZthXrOIF675Znq');

-- ----------------------------
-- Table structure for m_zakat_type
-- ----------------------------
DROP TABLE IF EXISTS `m_zakat_type`;
CREATE TABLE `m_zakat_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `trans_type_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tr_f`(`trans_type_id`) USING BTREE,
  CONSTRAINT `tr_f` FOREIGN KEY (`trans_type_id`) REFERENCES `m_trans_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_zakat_type
-- ----------------------------
INSERT INTO `m_zakat_type` VALUES (1, 'Emas', 2);
INSERT INTO `m_zakat_type` VALUES (2, 'Perak', 2);
INSERT INTO `m_zakat_type` VALUES (3, 'Hasil Peternakan', 2);
INSERT INTO `m_zakat_type` VALUES (4, 'Hasil Pertanian', 2);
INSERT INTO `m_zakat_type` VALUES (5, 'Hasil Perdagangan', 2);
INSERT INTO `m_zakat_type` VALUES (6, 'Hasil Tambang dan Laut', 2);
INSERT INTO `m_zakat_type` VALUES (7, 'Hasil Jasa Profesi', 2);
INSERT INTO `m_zakat_type` VALUES (8, 'Hasil Saham', 2);
INSERT INTO `m_zakat_type` VALUES (9, 'Uang', 3);
INSERT INTO `m_zakat_type` VALUES (10, 'Beras', 3);
INSERT INTO `m_zakat_type` VALUES (11, 'Uang', 1);
INSERT INTO `m_zakat_type` VALUES (12, 'Uang', 4);

-- ----------------------------
-- Table structure for t_pengeluaran
-- ----------------------------
DROP TABLE IF EXISTS `t_pengeluaran`;
CREATE TABLE `t_pengeluaran`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_type_id` int(11) NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `amount` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `received_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_date` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `trp_f`(`trans_type_id`) USING BTREE,
  CONSTRAINT `trp_f` FOREIGN KEY (`trans_type_id`) REFERENCES `m_trans_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for t_tabungan
-- ----------------------------
DROP TABLE IF EXISTS `t_tabungan`;
CREATE TABLE `t_tabungan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jamaah_group_id` int(11) NULL DEFAULT NULL,
  `hewan_id` int(11) NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `start_date` date NULL DEFAULT NULL,
  `end_date` date NULL DEFAULT NULL,
  `duration` int(11) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `created_date` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jmhg_f`(`jamaah_group_id`) USING BTREE,
  INDEX `hwn_f`(`hewan_id`) USING BTREE,
  CONSTRAINT `hwn_f` FOREIGN KEY (`hewan_id`) REFERENCES `m_hewan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jmhg_f` FOREIGN KEY (`jamaah_group_id`) REFERENCES `m_jamaah_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for t_tabungan_detail
-- ----------------------------
DROP TABLE IF EXISTS `t_tabungan_detail`;
CREATE TABLE `t_tabungan_detail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tabungan_id` int(11) NULL DEFAULT NULL,
  `amount` bigint(50) NULL DEFAULT NULL,
  `is_paid` int(11) NULL DEFAULT 0,
  `due_date` date NULL DEFAULT NULL,
  `pay_date` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tb_f`(`tabungan_id`) USING BTREE,
  CONSTRAINT `tb_f` FOREIGN KEY (`tabungan_id`) REFERENCES `t_tabungan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for t_transaction
-- ----------------------------
DROP TABLE IF EXISTS `t_transaction`;
CREATE TABLE `t_transaction`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_type_id` int(11) NULL DEFAULT NULL,
  `zakat_type_id` int(11) NULL DEFAULT NULL,
  `jamaah_id` int(11) NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `label` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `amount` bigint(50) NULL DEFAULT NULL,
  `desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(255) NULL DEFAULT NULL,
  `created_date` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ttf_r`(`trans_type_id`) USING BTREE,
  INDEX `zkt_f`(`zakat_type_id`) USING BTREE,
  INDEX `jmh_f`(`jamaah_id`) USING BTREE,
  CONSTRAINT `jmh_f` FOREIGN KEY (`jamaah_id`) REFERENCES `m_jamaah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ttf_r` FOREIGN KEY (`trans_type_id`) REFERENCES `m_trans_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `zkt_f` FOREIGN KEY (`zakat_type_id`) REFERENCES `m_zakat_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
