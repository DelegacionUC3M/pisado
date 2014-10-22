-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: delegados
-- ------------------------------------------------------
-- Server version	5.5.38-0+wheezy1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comisiones`
--

DROP TABLE IF EXISTS `comisiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comisiones` (
  `id_com` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  PRIMARY KEY (`id_com`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comisiones`
--

LOCK TABLES `comisiones` WRITE;
/*!40000 ALTER TABLE `comisiones` DISABLE KEYS */;
INSERT INTO `comisiones` VALUES (1,'Calidad'),(2,'Huelgas');
/*!40000 ALTER TABLE `comisiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delegados`
--

DROP TABLE IF EXISTS `delegados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delegados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `del_curso` tinyint(1) NOT NULL,
  `del_titulacion` tinyint(1) NOT NULL,
  `cargo` varchar(15) NOT NULL,
  `junta` tinyint(1) NOT NULL,
  `claustro` tinyint(1) NOT NULL,
  `del_escuela` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `delegados_ibfk_3` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delegados`
--

LOCK TABLES `delegados` WRITE;
/*!40000 ALTER TABLE `delegados` DISABLE KEYS */;
INSERT INTO `delegados` VALUES (54,1,1,'',0,0,1),(64,1,1,'',0,0,0),(82,1,0,'Tesorero',1,1,0),(101,1,0,'Secretaria',0,0,0);
/*!40000 ALTER TABLE `delegados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamentos` (
  `id_dep` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  PRIMARY KEY (`id_dep`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,'Teoria de la Señal y Comunicaciones'),(2,'Fisica'),(3,'Matematicas'),(4,'Telematica'),(5,'Informatica');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupos_trabajo`
--

DROP TABLE IF EXISTS `grupos_trabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupos_trabajo` (
  `id_gru` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  PRIMARY KEY (`id_gru`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos_trabajo`
--

LOCK TABLES `grupos_trabajo` WRITE;
/*!40000 ALTER TABLE `grupos_trabajo` DISABLE KEYS */;
INSERT INTO `grupos_trabajo` VALUES (1,'Feria de Asociaciones');
/*!40000 ALTER TABLE `grupos_trabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nia` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `apellido1` varchar(120) NOT NULL,
  `apellido2` varchar(120) NOT NULL,
  `curso` int(11) NOT NULL,
  `id_titulacion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nia` (`nia`),
  KEY `id_titulacion` (`id_titulacion`),
  CONSTRAINT `personas_ibfk_2` FOREIGN KEY (`id_titulacion`) REFERENCES `titulaciones` (`id_titulacion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` VALUES (3,100056069,'Guillermo','Baldan','Lopez',1,1),(4,100315790,'Isabel','Higueras','de Jorge',1,2),(8,100315873,'Fernando','Perez','Juanes',1,2),(9,100317510,'Elena','Lopez','Gil',1,2),(10,100318655,'Hector Francisco','Marquez','Garcia',1,2),(11,100291649,'Rebeca','Jimenez','Guillen',2,2),(12,100292326,'Diego','Martin','Azpeitia',3,2),(13,100290682,'Diego','Salmeron','Aguirre',3,2),(14,100316972,'Alejandro','Colom','Taylor',1,3),(15,100316909,'Antonio Kenji','Sepulveda','Muro',1,3),(16,100317460,'Laura Cecilia','Salmeron','Herrero',1,4),(17,100317420,'Maria','de Cambra','Echenique',1,4),(18,100318739,'Jimmy Hugo','Veliz','Moreno',1,4),(19,100315171,'Javier','Bernal','Cuadrado',1,4),(20,100316906,'Javier','Fernandez','Garrido',1,4),(21,100315707,'Diego','Trapero','Caraballo',1,4),(22,100293317,'Manuel','Holst','Ariaudo',2,4),(23,100282665,'Rodrigo Manuel','Lama','Tartas',2,4),(24,100283239,'Gabriela','Martinez-Falero','Uquillas',2,4),(25,100290722,'Irene','Santos','Garcia',3,4),(26,100276140,'Ali','Heroabadi','Perez',3,4),(27,100079164,'Borja','Velasco','Regulez',4,4),(28,100318673,'Roberto','Hernandez','Gonzalez',1,5),(29,100291869,'Belen','Vazquez','Pastor',2,5),(30,100083901,'Jose Maria','Rodriguez','Garcia',3,5),(31,100290805,'Sara','Pascual','Palomo',3,5),(32,100276697,'Raul','Gomez-Alvarez','Lobon',4,5),(33,100315224,'Daniel','Oliva','del Moral',1,6),(34,100316217,'Alejandro','Lopez','Pajares',1,6),(35,100303641,'Raul','Serrano','Martin',2,6),(36,100303653,'Carmen','Burguillos','Sanchez',2,6),(37,100292343,'Pedro','Marcos','Solorzano',3,6),(38,100277608,'Orge','Ortega','Paris',4,6),(39,100074170,'Miguel Angel','Rosado','Rodriguez',4,6),(40,100080950,'David','Garcia','Palancares',4,6),(41,100304633,'Patricia ','Carrera','Fernandez',2,7),(42,100304645,'Clara','Luis','Mingueza',2,7),(43,100275901,'Javier','Lopez','Labraca',4,7),(44,100315631,'Jorge Luis','Saez','de Teresa',1,8),(45,100303788,'Andrea','Mosquera','Alonso',2,8),(46,100293560,'Pablo Antonio','Machuca','Varela',3,8),(47,100293261,'Nereida','Aguera','Lopez',3,8),(48,100282260,'Juan','Lozano','Angosto',4,8),(49,100317037,'Antonio','Miranda','Escalada',1,9),(50,100317238,'Clara','Ramon','Lozano',1,9),(51,100318678,'Maria Teresa','Cuesta','Barquita',1,9),(52,100317472,'Ana Maria','Sanchez','de la Nava',1,9),(53,100307042,'Telmo','Diez','Perez',2,9),(54,100303849,'Irene','Sanz','Vizcaino',2,9),(55,100303761,'Esther','Fuentes','Blas',2,9),(56,100303803,'Carlos','Martin','Cabarcos',2,9),(57,100293923,'Alfonso','Arredondo','Villaluenga',3,9),(58,100291691,'Javier','Lanillos','Manchon',3,9),(59,100293101,'Javier','Torres','Marcos',3,9),(60,100284675,'Alvaro','Gomariz','Carrillo',4,9),(61,100282780,'Carlos','Porras','Rodriguez',4,9),(62,100315879,'Tomas','Blanco','Gonzalez',1,10),(63,100304883,'Sonia','Sanchez','Jimenez',1,10),(64,100303804,'Jose Javier','Turon','Beder',1,10),(65,100315060,'Daniel','Nogues','Polon',1,10),(66,100081895,'Eva','Lopez','Palacios',4,10),(80,100315536,'Adrian','Borja','Pimentel',1,11),(81,100315435,'Mara','Bermudez','Cabello',1,11),(82,100315991,'Axel','Blanco','Cerro',1,11),(83,100317714,'Fernando Felix','Collado','Egea',1,11),(84,100315803,'Imanol','Sanz','Ruiz',1,11),(85,100318104,'Mario','Montes','Gonzalez',1,11),(86,100317118,'Jorge Carlos','Frias','Galan',1,11),(87,100303606,'Jaime','Carrascosa','Fernandez',1,11),(88,100315318,'Rafel Enrique','Gautier','Barderas',1,11),(89,100303572,'Adrian','Dominguez','Martin',2,11),(90,100303618,'Danay','Fernandez','Martinez',2,11),(91,100292307,'Oscar','Seguro','Alonso',3,11),(92,100284126,'Sergio','del Olmo','Pueblas',4,11),(93,100315347,'Almudena','Garcia','Sanchez',1,12),(94,100317673,'Fernando','Gamboa','Garcia',1,12),(95,100304090,'Javier','Pamplona','Gomez',2,12),(96,100303974,'Alexis Mauricio','Jimenez','Coronel',2,12),(97,100293065,'Lucas','Garcia','Romero',3,12),(98,100275013,'Antonio Alberto','Ramos','Ruiz',3,12),(99,100305296,'Jesus Alberto','Polo','Garcia',2,13),(100,100047475,'Fernando','Cerezal','Lopez',2,13),(101,100305011,'Lara','Lorenzo','Regueira',2,13),(102,100284600,'Clara','Cabañas','Pujadas',3,13),(103,100274847,'Yago','Perez','Saiz',4,13),(104,100276661,'Bruno','Ramos','Sanchez',0,14),(105,100278102,'Enrique','de Nicolas','Lumbreras',0,14),(106,100074389,'Andres','Iwan','Glazer',0,14),(107,100039318,'Roberto','Muñoz','Gomez',0,15);
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prueba`
--

DROP TABLE IF EXISTS `prueba`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prueba` (
  `rol` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prueba`
--

LOCK TABLES `prueba` WRITE;
/*!40000 ALTER TABLE `prueba` DISABLE KEYS */;
INSERT INTO `prueba` VALUES (''),(''),('ALUMNO'),(''),(''),('Adapt'),(''),('Escuela'),('Escuela'),('GUILLERMO'),('Escuela'),('Escuela'),('ISABEL');
/*!40000 ALTER TABLE `prueba` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `representantes_com`
--

DROP TABLE IF EXISTS `representantes_com`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `representantes_com` (
  `id_com` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `id_com` (`id_com`),
  CONSTRAINT `representantes_com_ibfk_4` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `representantes_com_ibfk_5` FOREIGN KEY (`id_com`) REFERENCES `comisiones` (`id_com`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `representantes_com`
--

LOCK TABLES `representantes_com` WRITE;
/*!40000 ALTER TABLE `representantes_com` DISABLE KEYS */;
INSERT INTO `representantes_com` VALUES (1,94),(2,54);
/*!40000 ALTER TABLE `representantes_com` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `representantes_dep`
--

DROP TABLE IF EXISTS `representantes_dep`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `representantes_dep` (
  `id_dep` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_dep` (`id_dep`),
  CONSTRAINT `representantes_dep_ibfk_4` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `representantes_dep_ibfk_5` FOREIGN KEY (`id_dep`) REFERENCES `departamentos` (`id_dep`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `representantes_dep`
--

LOCK TABLES `representantes_dep` WRITE;
/*!40000 ALTER TABLE `representantes_dep` DISABLE KEYS */;
INSERT INTO `representantes_dep` VALUES (2,15),(3,101),(5,89);
/*!40000 ALTER TABLE `representantes_dep` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `representantes_gru`
--

DROP TABLE IF EXISTS `representantes_gru`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `representantes_gru` (
  `id_gru` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_gru` (`id_gru`),
  CONSTRAINT `representantes_gru_ibfk_5` FOREIGN KEY (`id_gru`) REFERENCES `grupos_trabajo` (`id_gru`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `representantes_gru_ibfk_6` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `representantes_gru`
--

LOCK TABLES `representantes_gru` WRITE;
/*!40000 ALTER TABLE `representantes_gru` DISABLE KEYS */;
INSERT INTO `representantes_gru` VALUES (1,16);
/*!40000 ALTER TABLE `representantes_gru` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `titulaciones`
--

DROP TABLE IF EXISTS `titulaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `titulaciones` (
  `id_titulacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  PRIMARY KEY (`id_titulacion`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `titulaciones`
--

LOCK TABLES `titulaciones` WRITE;
/*!40000 ALTER TABLE `titulaciones` DISABLE KEYS */;
INSERT INTO `titulaciones` VALUES (1,'Adaptacion al Grado de Ingenieria Electronica Industrial y Automatica'),(2,'Grado en Ingenieria en Tecnologias de Telecomunicacion '),(3,'Grado en Ingenieria de la Energia'),(4,'Grado en Ingenieria en Tecnologias Industriales'),(5,'Grado en Ingenieria de Sistemas de Comunicaciones'),(6,'Grado en Ingenieria Electronica Industrial y Automatica'),(7,'Grado en Ingenieria de Sistemas Audiovisuales'),(8,'Grado en Ingenieria Aeroespacial'),(9,'Grado en Ingenieria Biomedica'),(10,'Grado en Ingenieria Electrica'),(11,'Grado en Ingenieria Informatica'),(12,'Grado en Ingenieria Mecanica'),(13,'Grado en Ingenieria Telematica'),(14,'Ingenieria Industrial'),(15,'Ingenieria Informatica');
/*!40000 ALTER TABLE `titulaciones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-21 11:56:47
