-- MySQL dump 10.18  Distrib 10.3.27-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db_app_sasuke
-- ------------------------------------------------------
-- Server version	10.3.27-MariaDB-1:10.3.27+maria~bionic

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_app_setting`
--

DROP TABLE IF EXISTS `tb_app_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_app_setting` (
  `id_app` int(1) NOT NULL,
  `judul_app` varchar(255) NOT NULL,
  `judul_app_alt` varchar(80) NOT NULL,
  `logo_app` varchar(255) NOT NULL,
  `icon_app` varchar(255) NOT NULL,
  `text_footer_app` varchar(255) NOT NULL,
  PRIMARY KEY (`id_app`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_app_setting`
--

LOCK TABLES `tb_app_setting` WRITE;
/*!40000 ALTER TABLE `tb_app_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_app_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_user_type`
--

DROP TABLE IF EXISTS `tb_user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_user_type` (
  `id_type` int(1) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(100) NOT NULL,
  `index_page` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_user_type`
--

LOCK TABLES `tb_user_type` WRITE;
/*!40000 ALTER TABLE `tb_user_type` DISABLE KEYS */;
INSERT INTO `tb_user_type` VALUES (1,'administrator','manajemen-user'),(2,'Kepala Puskesmas','surat-kematian');
/*!40000 ALTER TABLE `tb_user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` int(1) NOT NULL,
  `nip` bigint(18) DEFAULT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_token` varchar(255) DEFAULT NULL,
  `user_picture` varchar(255) DEFAULT NULL,
  `last_login` int(11) DEFAULT NULL,
  `last_ip` varbinary(16) DEFAULT NULL,
  `is_active` enum('TRUE','FALSE') DEFAULT 'FALSE',
  PRIMARY KEY (`id_user`),
  KEY `id_type` (`id_type`),
  CONSTRAINT `tb_user_ibfk_3` FOREIGN KEY (`id_type`) REFERENCES `tb_user_type` (`id_type`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_user`
--

LOCK TABLES `tb_user` WRITE;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_instansi`
--

DROP TABLE IF EXISTS `tb_instansi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_instansi` (
  `id_instansi` int(1) NOT NULL,
  `kode_instansi` varchar(10) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `nama_instansi_alt` varchar(100) DEFAULT NULL,
  `alamat_instansi` varchar(500) NOT NULL,
  `induk_instansi` varchar(255) NOT NULL,
  `logo_kop_instansi` varchar(255) NOT NULL,
  `kota_instansi` varchar(100) NOT NULL,
  `kota_administrasi` varchar(100) NOT NULL,
  `kode_pos_instansi` int(5) NOT NULL,
  `telp_instansi` varchar(19) NOT NULL,
  `email_instansi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_instansi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_instansi`
--

LOCK TABLES `tb_instansi` WRITE;
/*!40000 ALTER TABLE `tb_instansi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_instansi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_menu`
--

DROP TABLE IF EXISTS `tb_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `label_menu` varchar(100) NOT NULL,
  `link_menu` varchar(100) DEFAULT NULL,
  `icon_menu` varchar(80) DEFAULT NULL,
  `tipe_menu` enum('mainmenu','submenu','content') NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_menu`
--

LOCK TABLES `tb_menu` WRITE;
/*!40000 ALTER TABLE `tb_menu` DISABLE KEYS */;
INSERT INTO `tb_menu` VALUES (1,NULL,'Dashboard',NULL,NULL,'mainmenu'),(2,1,'Dashboard','dashboard','fas fa-fw fa-tachometer-alt','submenu'),(3,NULL,'Manajemen',NULL,NULL,'mainmenu'),(4,3,'Manajemen Akses','manajemen-akses','fas fa-fw fa-key','submenu'),(5,3,'Tambah Role','tambah-role','fas fa-fw fa-plus','content'),(6,3,'Edit Role','edit-role','fas fa-fw fa-pencil-alt','content'),(7,3,'Hapus Role','hapus-role','fas fa-fw fa-trash-alt','content'),(8,3,'Manajemen User','manajemen-user','fas fa-fw fa-users','submenu'),(9,3,'Tambah User','tambah-user','fas fa-fw fa-user-plus','content'),(10,3,'Edit User','edit-user','fas fa-fw fa-user-edit','content'),(11,3,'Hapus User','hapus-user','fas fa-fw fa-trash-alt','content'),(12,NULL,'Arsip Surat',NULL,NULL,'mainmenu'),(13,12,'Buat Surat Kematian','buat-skmk','fas fa-fw fa-plus-square','submenu'),(14,12,'Edit Surat Kematian','edit-skmk','fas fa-fw fa-pencil-alt','content'),(15,12,'Hapus Surat Kematian','hapus-skmk','fas fa-fw fa-trash-alt','content'),(16,12,'Cari Surat Kematian','cari-skmk','fas fa-fw fa-search','content'),(17,NULL,'Setting',NULL,NULL,'mainmenu'),(18,17,'App Setting','app-setting','fas fa-fw fa-cogs','submenu'),(28,12,'Surat Kematian','surat-kematian','fas fa-fw fa-bars','submenu'),(31,12,'Detail SKMK','detail-skmk','fas fa-fw fa-eye','content'),(32,17,'Pengaturan Instansi','pengaturan-instansi','fas fa-fw fa-cogs','submenu'),(33,3,'Status User','status-user','fas fa-fw fa-key','content'),(34,3,'Get Role','get-role','','content');
/*!40000 ALTER TABLE `tb_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pelapor`
--

DROP TABLE IF EXISTS `tb_pelapor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pelapor` (
  `id_pelapor` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `no_skmk` varchar(100) NOT NULL,
  `nama_pelapor` varchar(255) NOT NULL,
  `tempat_lahir_pelapor` varchar(255) NOT NULL,
  `tgl_lahir_pelapor` date NOT NULL,
  `alamat_pelapor` varchar(500) NOT NULL,
  `no_ktp_pelapor` bigint(18) NOT NULL,
  `pekerjaan_pelapor` varchar(100) DEFAULT NULL,
  `hubungan` varchar(100) NOT NULL,
  `tembusan` varchar(255) DEFAULT NULL,
  `tgl_dibuat` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_pelapor`),
  KEY `id_pegawai` (`id_user`),
  CONSTRAINT `tb_pelapor_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pelapor`
--

LOCK TABLES `tb_pelapor` WRITE;
/*!40000 ALTER TABLE `tb_pelapor` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_pelapor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_roles`
--

DROP TABLE IF EXISTS `tb_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_roles` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` int(1) NOT NULL,
  `id_menu` int(11) NOT NULL,
  PRIMARY KEY (`id_role`),
  KEY `id_menu` (`id_menu`),
  KEY `id_type` (`id_type`),
  CONSTRAINT `tb_roles_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `tb_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_roles_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `tb_user_type` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_roles`
--

LOCK TABLES `tb_roles` WRITE;
/*!40000 ALTER TABLE `tb_roles` DISABLE KEYS */;
INSERT INTO `tb_roles` VALUES (44,1,18),(45,1,2),(46,1,1),(47,1,6),(48,1,10),(49,1,7),(50,1,11),(51,1,3),(52,1,4),(53,1,8),(54,1,17),(55,1,5),(56,1,9),(62,1,32),(63,1,33),(64,1,34),(65,2,12),(66,2,13),(67,2,16),(68,2,1),(69,2,2),(70,2,31),(71,2,14),(72,2,15),(73,2,28);
/*!40000 ALTER TABLE `tb_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_terlapor`
--

DROP TABLE IF EXISTS `tb_terlapor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_terlapor` (
  `id_terlapor` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelapor` int(11) NOT NULL,
  `nama_terlapor` varchar(255) NOT NULL,
  `tempat_lahir_terlapor` varchar(255) NOT NULL,
  `tgl_lahir_terlapor` date NOT NULL,
  `alamat_terlapor` varchar(500) NOT NULL,
  `no_ktp_terlapor` bigint(18) NOT NULL,
  `pekerjaan_terlapor` varchar(100) DEFAULT NULL,
  `tgl_meninggal` datetime NOT NULL,
  `lokasi_meninggal` varchar(255) NOT NULL,
  PRIMARY KEY (`id_terlapor`),
  KEY `id_pelapor` (`id_pelapor`),
  CONSTRAINT `tb_terlapor_ibfk_1` FOREIGN KEY (`id_pelapor`) REFERENCES `tb_pelapor` (`id_pelapor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_terlapor`
--

LOCK TABLES `tb_terlapor` WRITE;
/*!40000 ALTER TABLE `tb_terlapor` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_terlapor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-03  4:43:24
