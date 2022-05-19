-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: cangurodb
-- ------------------------------------------------------
-- Server version	8.0.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cita`
--

DROP TABLE IF EXISTS `cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cita` (
  `id` int NOT NULL AUTO_INCREMENT,
  `folio` varchar(10) DEFAULT NULL,
  `idCiudadano` int DEFAULT NULL,
  `idModulo` int DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `idDocumento` int DEFAULT NULL,
  `idComprobante` int DEFAULT NULL,
  `idTramite` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cita_ciudadano_idx` (`idCiudadano`),
  KEY `FK_cita_modulo_idx` (`idModulo`),
  KEY `FK_cita_documento_idx` (`idDocumento`),
  KEY `FK_cita_combropante_idx` (`idComprobante`),
  KEY `FK_cita_tramite_idx` (`idTramite`),
  CONSTRAINT `FK_cita_ciudadano` FOREIGN KEY (`idCiudadano`) REFERENCES `ciudadano` (`id`),
  CONSTRAINT `FK_cita_combropante` FOREIGN KEY (`idComprobante`) REFERENCES `comprobante_domicilio` (`id`),
  CONSTRAINT `FK_cita_documento` FOREIGN KEY (`idDocumento`) REFERENCES `documento_nacionalidad` (`id`),
  CONSTRAINT `FK_cita_modulo` FOREIGN KEY (`idModulo`) REFERENCES `modulo` (`id`),
  CONSTRAINT `FK_cita_tramite` FOREIGN KEY (`idTramite`) REFERENCES `tramite` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita`
--

LOCK TABLES `cita` WRITE;
/*!40000 ALTER TABLE `cita` DISABLE KEYS */;
INSERT INTO `cita` VALUES (5,'1234567890',1,20152,'2022-05-19 00:00:00',1,1,1);
/*!40000 ALTER TABLE `cita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ciudad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `idEstado` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ciudad_estado_idx` (`idEstado`),
  CONSTRAINT `FK_ciudad_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudad`
--

LOCK TABLES `ciudad` WRITE;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
INSERT INTO `ciudad` VALUES (1,'Mexicali',2),(2,'Tijuana',2),(3,'Tecate',2),(4,'Zapopan',14),(5,'Guadalajara',14),(6,'Tlajomulco de Zuñiga',14),(7,'Hermosillo',26),(8,'Guaymas',26),(9,'Empalme',26),(10,'Ahome',25),(11,'Culiacán',25),(12,'Guasave',25),(13,'Veracruz',30),(14,'Xalapa',30),(15,'Coatzacoalcos',30),(22,'la paz',2);
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudadano`
--

DROP TABLE IF EXISTS `ciudadano`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ciudadano` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  `apellidoPaterno` varchar(80) DEFAULT NULL,
  `apellidoMaterno` varchar(80) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `tipoTelefono` int DEFAULT NULL,
  `correo` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudadano`
--

LOCK TABLES `ciudadano` WRITE;
/*!40000 ALTER TABLE `ciudadano` DISABLE KEYS */;
INSERT INTO `ciudadano` VALUES (1,'Hernando',' Gómez ','Salazar','6865758477',1,'gosalher45@hotmail.com'),(2,'Ranulfo ','Lisboa ','Garmendia','0337854226',1,'rarmendia.lisboa@outlook.com'),(3,'Sofía ','Ramirez ','Bocanegra','6684272427',0,'sorabo32@gmail.com'),(4,'Marco ','Montoya ','Ávila','6224585425',1,'avilo.monmar98@gmail.com');
/*!40000 ALTER TABLE `ciudadano` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comprobante_domicilio`
--

DROP TABLE IF EXISTS `comprobante_domicilio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comprobante_domicilio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comprobante_domicilio`
--

LOCK TABLES `comprobante_domicilio` WRITE;
/*!40000 ALTER TABLE `comprobante_domicilio` DISABLE KEYS */;
INSERT INTO `comprobante_domicilio` VALUES (1,'Pago de impuesto predial'),(2,'Recibo de pago de luz'),(3,'Recibo de pago de agua'),(4,'Recibo de pago de teléfono'),(5,'Recibo de pago de señal de televisón'),(6,'Recibo de pago de gas'),(7,'Bancarios'),(8,'De tiendas departamentales'),(9,'Copia certificada de escrituras de propiedad inmobiliaria'),(10,'Contrato de arrendamiento'),(11,'Dos testigos'),(12,'Estado de cuenta de crédito hipotecario'),(13,'Estados de cuenta del Sistema de Ahorro para el Retiro'),(14,'Contrato de servicio público de agua potable'),(15,'licencia de pesca');
/*!40000 ALTER TABLE `comprobante_domicilio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento_nacionalidad`
--

DROP TABLE IF EXISTS `documento_nacionalidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documento_nacionalidad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento_nacionalidad`
--

LOCK TABLES `documento_nacionalidad` WRITE;
/*!40000 ALTER TABLE `documento_nacionalidad` DISABLE KEYS */;
INSERT INTO `documento_nacionalidad` VALUES (1,'Acta de nacimiento'),(2,'Documento que acredita la nacionalidad mexicana por naturalización');
/*!40000 ALTER TABLE `documento_nacionalidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (2,'Baja California'),(3,'Baja California Sur'),(4,'Campeche'),(5,'Chiapas'),(6,'Chihuahua'),(7,'Ciudad de México'),(8,'Coahuila'),(9,'Colima'),(10,'Durango'),(11,'Guanajuato'),(12,'Guerrero'),(13,'Hidalgo'),(14,'Jalisco'),(15,'México'),(16,'Michoacán'),(17,'Morelos'),(18,'Nayarit '),(19,'Nuevo León'),(20,'Oaxaca'),(21,'Puebla'),(22,'Querétaro'),(23,'Quintana Roo'),(24,'San Luís Potosí'),(25,'Sinaloa'),(26,'Sonora'),(27,'Tabasco'),(28,'Tamaulipas'),(29,'Tlaxcala'),(30,'Veracruz'),(31,'Yucatán'),(35,'Zacatecas');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulo`
--

DROP TABLE IF EXISTS `modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modulo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `idCiudad` int DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `referencia` varchar(250) DEFAULT NULL,
  `horario` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PK_modulo_ciudad_idx` (`idCiudad`),
  CONSTRAINT `PK_modulo_ciudad` FOREIGN KEY (`idCiudad`) REFERENCES `ciudad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=260555 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo`
--

LOCK TABLES `modulo` WRITE;
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
INSERT INTO `modulo` VALUES (20152,'MEXICALI - FRACC. VALLE DEL PUEBLA 1',1,'AV. RÍO SAN ÁNGEL NO. 78, COL. FRACC. VALLE DEL PUEBLA, C.P. 21395, LOC. MEXICALI, MEXICALI, BAJA CALIFORNIA','CENTRO COMERCIAL SANTA FE, LOCAL 6 Y 7 , ENTRE CALLES DE LA CERÁMICA Y DE LOS CANDILES','**08:00 - 20:00 Lunes, Martes, Miércoles, Jueves, Viernes**'),(140853,'GUADALAJARA - CENTRO',5,'AVENIDA ALCALDE NO. 500, COL. CENTRO, C.P. 44100, LOC. GUADALAJARA, GUADALAJARA, JALISCO','HOSPITAL Y JUAN ÁLVAREZ DENTRO DEL PALACIO FEDERAL','**08:00 - 20:00 Lunes, Martes, Miércoles, Jueves, Viernes**'),(250251,'LOS MOCHIS - COLONIA CUAHUTÉMOC',10,'CALLE CEIBA NO. 260, COL. COL CUAUHTÉMOC, C.P. 81200, LOC. LOS MOCHIS, AHOME, SINALOA','ESQUINA CON AVENIDA INDEPENDENCIA','**08:00 - 20:00 Lunes, Martes, Miércoles, Jueves, Viernes**'),(260451,'GUAYMAS - CENTRO',8,'AV. SERDÁN NO. 508, COL. CENTRO, C.P. 85400, LOC. GUAYMAS, GUAYMAS, SONORA','ENTRE CALLE 10 Y CALLE 11, FRENTE A PLAZA 10','**08:00 - 15:00 Lunes, Martes, Miércoles, Jueves, Viernes**');
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tramite`
--

DROP TABLE IF EXISTS `tramite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tramite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tramite`
--

LOCK TABLES `tramite` WRITE;
/*!40000 ALTER TABLE `tramite` DISABLE KEYS */;
INSERT INTO `tramite` VALUES (1,'Cambio de domicilio'),(2,'Corrección de datos'),(3,'Corrección de datos en dirección'),(4,'Inscripción'),(5,'Reemplazo por vigencia'),(6,'Reincorporación'),(7,'Reposición'),(8,'Aplazo');
/*!40000 ALTER TABLE `tramite` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-19 15:09:25
