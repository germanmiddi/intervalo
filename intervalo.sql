-- MariaDB dump 10.17  Distrib 10.5.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: intervalodb
-- ------------------------------------------------------
-- Server version	10.5.6-MariaDB-1:10.5.6+maria~focal

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
-- Table structure for table `afirmation_competencia`
--

DROP TABLE IF EXISTS `afirmation_competencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `afirmation_competencia` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `afirmation_id` bigint(20) unsigned NOT NULL,
  `competencia_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `afirmation_competencia_competencia_id_foreign` (`competencia_id`),
  KEY `afirmation_competencia_afirmation_id_foreign` (`afirmation_id`),
  CONSTRAINT `afirmation_competencia_afirmation_id_foreign` FOREIGN KEY (`afirmation_id`) REFERENCES `afirmations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `afirmation_competencia_competencia_id_foreign` FOREIGN KEY (`competencia_id`) REFERENCES `competencias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `afirmation_competencia`
--

LOCK TABLES `afirmation_competencia` WRITE;
/*!40000 ALTER TABLE `afirmation_competencia` DISABLE KEYS */;
INSERT INTO `afirmation_competencia` VALUES (51,1536,1,NULL,NULL),(52,1536,3,NULL,NULL),(53,1537,1,NULL,NULL),(54,1537,3,NULL,NULL),(55,1538,1,NULL,NULL),(56,1538,3,NULL,NULL),(57,1539,1,NULL,NULL),(58,1539,3,NULL,NULL),(59,1540,1,NULL,NULL),(60,1540,3,NULL,NULL),(61,1541,4,NULL,NULL),(62,1541,6,NULL,NULL),(63,1542,4,NULL,NULL),(64,1542,6,NULL,NULL),(65,1543,4,NULL,NULL),(66,1543,6,NULL,NULL),(67,1544,5,NULL,NULL),(68,1544,1,NULL,NULL),(69,1545,5,NULL,NULL),(70,1545,1,NULL,NULL),(71,1546,5,NULL,NULL),(72,1546,1,NULL,NULL);
/*!40000 ALTER TABLE `afirmation_competencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `afirmations`
--

DROP TABLE IF EXISTS `afirmations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `afirmations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ponderacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1547 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `afirmations`
--

LOCK TABLES `afirmations` WRITE;
/*!40000 ALTER TABLE `afirmations` DISABLE KEYS */;
INSERT INTO `afirmations` VALUES (1536,'Disfruto encarar trabajos donde me dan total libertad de acción, y puedo manejarme sol@.','DESC','2022-05-11 18:56:36','2022-05-11 18:56:36',NULL),(1537,'Prefiero que otros me faciliten los parámetros e indicaciones de cada trabajo, para asegurarme de esa manera que estará realizado de acuerdo a lo esperado','DESC','2022-05-11 18:56:36','2022-05-11 18:56:36',NULL),(1538,'Ejecuto los planes trazados siguiendo estrictamente los lineamientos de cada tarea','DESC','2022-05-11 18:56:36','2022-05-11 18:56:36',NULL),(1539,'Sigo las indicaciones y no cuestiono nada, aunque se me ocurran soluciones mejores.','DESC','2022-05-11 18:56:36','2022-05-11 18:56:36',NULL),(1540,'Aplico mis valores y actitudes personales en el plano laboral, son mi guía.','ASC','2022-05-11 18:56:36','2022-05-11 18:56:36',NULL),(1541,'Suelo ser muy perseverante, no me doy por vencid@ tan facilmente','ASC','2022-05-11 18:56:36','2022-05-11 18:56:36',NULL),(1542,'Conozco muy bien mis fortalezas y debilidades, y actúo en función de mis capacidades','ASC','2022-05-11 18:56:36','2022-05-11 18:56:36',NULL),(1543,'Disfruto de participar en la implementación de proyectos colectivos y de beneficio comunitario','ASC','2022-05-11 18:56:36','2022-05-11 18:56:36',NULL),(1544,'Tengo muy claros mis planes y proyecto de vida y voy tras ellos','ASC','2022-05-11 18:56:36','2022-05-11 18:56:36',NULL),(1545,'Tengo facilidad para iIdentifica criterios, recursos y estrategias para el logro de metas','ASC','2022-05-11 18:56:36','2022-05-11 18:56:36',NULL),(1546,'Soy muy eficiente a la hora de liderar proyectos, aunque tengan pocos recursos','ASC','2022-05-11 18:56:36','2022-05-11 18:56:36',NULL);
/*!40000 ALTER TABLE `afirmations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `capsule_competencia`
--

DROP TABLE IF EXISTS `capsule_competencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `capsule_competencia` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `capsule_id` bigint(20) unsigned NOT NULL,
  `competencia_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `capsule_competencia_capsule_id_foreign` (`capsule_id`),
  KEY `capsule_competencia_competencia_id_foreign` (`competencia_id`),
  CONSTRAINT `capsule_competencia_capsule_id_foreign` FOREIGN KEY (`capsule_id`) REFERENCES `capsules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `capsule_competencia_competencia_id_foreign` FOREIGN KEY (`competencia_id`) REFERENCES `competencias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capsule_competencia`
--

LOCK TABLES `capsule_competencia` WRITE;
/*!40000 ALTER TABLE `capsule_competencia` DISABLE KEYS */;
INSERT INTO `capsule_competencia` VALUES (3,1,1,NULL,NULL),(4,3,1,NULL,NULL),(5,1,3,NULL,NULL),(6,2,4,NULL,NULL),(7,2,5,NULL,NULL),(8,3,5,NULL,NULL),(9,2,6,NULL,NULL),(10,1,6,NULL,NULL);
/*!40000 ALTER TABLE `capsule_competencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `capsules`
--

DROP TABLE IF EXISTS `capsules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `capsules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capsules`
--

LOCK TABLES `capsules` WRITE;
/*!40000 ALTER TABLE `capsules` DISABLE KEYS */;
INSERT INTO `capsules` VALUES (1,'Capsula 1','Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cupiditate repellat sunt voluptatibus nihil saepe eveniet.\n\n',NULL,NULL,NULL,NULL,NULL),(2,'Capsula 3','Lorem ipsum, dolor sit a Cupiditate repellat sunt voluptatibus nihil saepe eveniet.\n\n',NULL,NULL,NULL,NULL,NULL),(3,'Capsula 2','Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus nihil saepe eveniet.\n\n',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `capsules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'INNOVACIÓN',NULL,'2022-04-21 15:02:48','2022-04-21 15:02:48'),(2,'LOGRO',NULL,'2022-04-21 15:02:48','2022-04-21 15:02:48'),(3,'COLABORACIÓN',NULL,'2022-04-21 15:02:48','2022-04-21 15:02:48'),(4,'LIDERAZGO',NULL,'2022-04-21 15:02:48','2022-04-21 15:02:48');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competencias`
--

DROP TABLE IF EXISTS `competencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `competencias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `competencia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `definicion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comportamiento` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `competencias_category_id_foreign` (`category_id`),
  CONSTRAINT `competencias_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competencias`
--

LOCK TABLES `competencias` WRITE;
/*!40000 ALTER TABLE `competencias` DISABLE KEYS */;
INSERT INTO `competencias` VALUES (1,'Autonomía','Capacidad para persuadir a otras personas, utilizar argumentos sólidos y honestos, y',4,'Se refiere a la capacidad de elegir con criterio propio; de llevar','El conocimiento de sí mism@, conciencia y aplicación de valores y actitudes personales','2022-04-21 15:02:48','2022-04-21 15:18:39',NULL),(3,'Adaptabilidad / Flexibilidad','Capacidad para comprender y apreciar perspectivas diferentes,',1,'Capacidad para comprender y apreciar perspectivas diferentes, cambiar convicciones y conductas a fin de adaptarse en forma rápida y eficiente a diversas situaciones, contextos, medios y personas. Implica realizar una revisión crítica de su propia actuación. Comprende rápidamente las necesidades que se generan internamente a medida que se le informan los cambios de contexto. Es flexible y receptivo a nuevas demandas, en pos del cumplimiento de objetivos organizacionales. Los cambios de personas en su equipo no alteran su desempeño.','Capacidad para comprender y apreciar (otorgar un valor especial) perspectivas diferentes, cambiar convicciones y conductas a fin de adaptarse en forma rápida y eficiente a diversas situaciones, contextos (interno o externo a la organización), medios y personas. Capacidad para llevar a cabo una revisión crítica de las estrategias y objetivos de su área, así como de su propia actividad y la de su equipo de trabajo, proponer cambios cuando resulte necesario, a fin de lograr una adecuada adaptación a las nuevas situaciones. Si corresponde, implica la capacidad de realizar una revisión crítica de las estrategias de la organización en su conjunto, y proponer los cambios pertinentes.','2022-04-21 19:46:30','2022-04-21 19:46:30',NULL),(4,'Calidad y Mejora continua','Capacidad para optimizar los recursos disponibles',1,'Capacidad para optimizar los recursos disponibles –personas, materiales, etc.– y agregar valor a través de ideas, enfoques o soluciones originales o diferentes en relación con la tarea asignada, las funciones de las personas a cargo, y/o los procesos y métodos de la organización. Implica la actitud permanente de brindar aportes que signifiquen una solución a situaciones inusuales y/o aportes que permitan perfeccionar, modernizar u optimizar el uso de los recursos a cargo.','Capacidad para diseñar métodos de trabajo organizacionales que permitan optimizar los recursos disponibles –personas, materiales, etc.– y agregar valor a través de ideas, enfoques o soluciones originales o diferentes en relación con las tareas de las personas a cargo y/o los procesos y métodos de la organización. Capacidad para generar y promover la disposición permanente a brindar aportes que signifiquen una solución a situaciones inusuales y/o que permitan perfeccionar, modernizar u optimizar el uso de los recursos a cargo. Capacidad para constituirse en un referente en la organización y el mercado en general en materia de calidad y mejora continua.','2022-04-21 19:47:13','2022-04-21 19:47:13',NULL),(5,'Planificación y Organización / Uso eficaz del tiempo','Capacidad para determinar eficazmente metas y prioridades de su tarea, área o proyecto.',2,'Capacidad para determinar eficazmente metas y prioridades de su tarea, área o proyecto, y especificar las etapas, acciones, plazos y recursos requeridos para el logro de los objetivos. Incluye utilizar mecanismos de seguimiento y verificación de los grados de avance de las distintas tareas para mantener el control del proceso y aplicar las medidas correctivas necesarias.','Capacidad para diseñar métodos de trabajo organizacionales que permitan determinar eficazmente metas y prioridades para todos los colaboradores y especificar las etapas, acciones, plazos y recursos requeridos para el logro de los objetivos fijados, en general, así como los de cada etapa en particular. Capacidad para diseñar e implementar mecanismos de seguimiento y verificación de los grados de avance de las distintas etapas para mantener el control de los proyectos o procesos y poder, de ese modo, aplicar las medidas correctivas que resulten necesarias. Capacidad para constituirse en un referente en materia de planificación y organización tanto personal como organizacional','2022-04-21 19:48:30','2022-04-21 19:48:30',NULL),(6,'Planificación y Organización / Uso eficaz del tiempo','Capacidad para persuadir a otras personas, utilizar argumentos sólidos y honestos, y',3,'Capacidad para orientarse al logro de los objetivos, seleccionar y formar personas, delegar, generar directrices, planificar, diseñar, analizar información, movilizar recursos organizacionales, controlar la gestión, sopesar riesgos e integrar las actividades de manera de lograr la eficacia, eficiencia y calidad en el cumplimiento de la misión y funciones de la organización.',NULL,'2022-04-21 20:36:39','2022-04-21 20:36:39',NULL);
/*!40000 ALTER TABLE `competencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2022_04_10_152914_create_sessions_table',1),(7,'2022_04_10_164751_create_competencias_table',1),(8,'2022_04_10_171728_create_afirmations_table',1),(9,'2022_04_10_191515_competencia_afirmation',1),(10,'2022_04_11_031642_create_capsules_table',1),(11,'2022_04_20_000000_create_categories_table',1),(12,'2022_04_21_000000_alter_table_competencias',1),(13,'2022_04_21_000001_capsule_competencia',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('F3lDmwToNrWQ3BJCzF7WMwDDbfSixFDnJ2Jt2ZWg',1,'192.168.0.198','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoia2VGSDBoVUlwb0FoSU9oWlEycHVPem5SUmxCbWNNOWp1Znlmb1hYSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xOTIuMTY4LjAuMTcwOjgwMDUvcXVpei8xJTJDMyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1652462316),('mII93CZLely2eVLwAKlJmKh9wgzhg4m973CcaTKO',1,'192.168.0.198','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWmU3NVlMZ2J3SnZERDFPUFp5RG5mQW1NSU1CeVIzbU9WT0ZEZ3Z2VSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xOTIuMTY4LjAuMTcwOjgwMDUvcXVpei8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1652307088),('qWcCdxybI9BYEDYvae3djM4504HiXZjh6IZmiIdl',NULL,'192.168.0.198','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaHFzRWoycDA3NDdOcUhKUDAyY083bVAxcG9zQ0JsV29NTFlMNWZyNCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovLzE5Mi4xNjguMC4xNzA6ODAwNS9jYXBzdWxlLzEvZWRpdCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTkyLjE2OC4wLjE3MDo4MDA1L2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1652317869),('vwIOI6c8AzpSovmgE8SYTLp5TqxzjM9XutZH2Fmb',NULL,'192.168.0.198','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_1) AppleWebKit/601.2.4 (KHTML, like Gecko) Version/9.0.1 Safari/601.2.4 facebookexternalhit/1.1 Facebot Twitterbot/1.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWTRkVFhaQlBKeVE4VEswRjFzZ3ZwdzF5WmxyU2Y5TjFDeGhJbm1LcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly8xOTIuMTY4LjAuMTcwOjgwMDUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1652461854);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'German Middi','g@gmail.com',NULL,'$2y$10$DsUqrHN2p.vAHVWAjWbKQOSnWgi/pTClWjZ3YWY9vWEIKUSNLgGyW',NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 15:02:48','2022-04-21 15:02:48');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-03  2:05:41
