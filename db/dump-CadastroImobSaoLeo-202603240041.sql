-- MySQL dump 10.13  Distrib 9.3.0, for macos15.2 (arm64)
--
-- Host: localhost    Database: CadastroImobSaoLeo
-- ------------------------------------------------------
-- Server version	9.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `people` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `birth_date` date NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` VALUES (21,'Ana Oliveira','1975-01-01','000.000.000-01','M','(11) 97000-0000','pessoa1@example.com'),(22,'Bruno Pereira','1976-02-02','000.000.000-02','F','(11) 97000-0001','pessoa2@example.com'),(23,'Carlos Souza','1977-03-03','000.000.000-03','ND','(11) 97000-0002','pessoa3@example.com'),(24,'Daniela Souza','1978-04-04','000.000.000-04','M','(11) 97000-0003','pessoa4@example.com'),(25,'Eduardo Rodrigues','1979-05-05','000.000.000-05','F','(11) 97000-0004','pessoa5@example.com'),(26,'Fernanda Martins','1980-06-06','000.000.000-06','ND','(11) 97000-0005','pessoa6@example.com'),(27,'Gabriel Almeida','1981-07-07','000.000.000-07','M','(11) 97000-0006','pessoa7@example.com'),(28,'Helena Silva','1982-08-08','000.000.000-08','F','(11) 97000-0007','pessoa8@example.com'),(29,'Igor Oliveira','1983-09-09','000.000.000-09','ND','(11) 97000-0008','pessoa9@example.com'),(30,'Juliana Souza','1984-10-10','000.000.000-10','M','(11) 97000-0009','pessoa10@example.com'),(31,'Kaique Almeida','1985-11-11','000.000.000-11','F','(11) 97000-0010','pessoa11@example.com'),(32,'Larissa Souza','1986-12-12','000.000.000-12','ND','(11) 97000-0011','pessoa12@example.com'),(33,'Marcos Almeida','1987-01-13','000.000.000-13','M','(11) 97000-0012','pessoa13@example.com'),(34,'Natália Almeida','1988-02-14','000.000.000-14','F','(11) 97000-0013','pessoa14@example.com'),(35,'Otávio Martins','1989-03-15','000.000.000-15','ND','(11) 97000-0014','pessoa15@example.com'),(36,'Patrícia Gomes','1990-04-16','000.000.000-16','M','(11) 97000-0015','pessoa16@example.com'),(37,'Rafael Gomes','1991-05-17','000.000.000-17','F','(11) 97000-0016','pessoa17@example.com'),(38,'Sabrina Santos','1992-06-18','000.000.000-18','ND','(11) 97000-0017','pessoa18@example.com'),(39,'Thiago Oliveira','1993-07-19','000.000.000-19','M','(11) 97000-0018','pessoa19@example.com'),(40,'Vanessa Silva','1994-08-20','000.000.000-20','F','(11) 97000-0019','pessoa20@example.com');
/*!40000 ALTER TABLE `people` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `properties` (
  `id` int NOT NULL AUTO_INCREMENT,
  `street` varchar(150) NOT NULL,
  `number` varchar(10) NOT NULL,
  `neighborhood` varchar(100) NOT NULL,
  `complement` varchar(100) DEFAULT NULL,
  `person_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `person_id` (`person_id`),
  CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `properties`
--

LOCK TABLES `properties` WRITE;
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;
INSERT INTO `properties` VALUES (41,'Rua São Jorge','5321','Santa Rita','Portão azul',23),(42,'Avenida Independência','6230','Vila Nova','Próximo à praça',26),(43,'Rua das Flores','5147','Santa Rita','Lado par',31),(44,'Avenida Central','6773','Santa Rita','Lado par',32),(45,'Rua Bela Vista','4957','Santa Rita','Portão azul',22),(46,'Rua Tiradentes','3580','Santa Rita','Sem complemento',37),(47,'Rua das Laranjeiras','6288','Industrial','Sobrado',30),(48,'Rua das Acácias','389','São José','Sobrado',28),(49,'Avenida Brasil','4240','Boa Esperança','Casa fundos',22),(50,'Avenida Central','2943','São José','Esquina',27),(51,'Avenida Brasil','8304','São José','Sem complemento',25),(52,'Rua das Laranjeiras','8084','Jardim América','Casa fundos',30),(53,'Avenida Central','1584','Centro','Lado par',32),(54,'Rua das Laranjeiras','2320','Jardim América','Sem complemento',31),(55,'Rua São Jorge','1329','Boa Esperança','Sem complemento',27),(56,'Avenida Independência','6452','Boa Esperança','Portão azul',36),(57,'Avenida Central','9091','São José','Sobrado',38),(58,'Rua das Flores','2515','Jardim América','Sobrado',26),(59,'Avenida Central','7247','Santa Rita','Esquina',33),(60,'Rua Primavera','9916','Boa Esperança','Casa fundos',21),(61,'Rua Bela Vista','892','Vila Nova','Próximo à praça',25),(62,'Rua dos Jasmins','420','Bela Vista','Sem complemento',37),(63,'Avenida Brasil','7675','Vila Nova','Sem complemento',39),(64,'Rua das Acácias','2698','Santa Rita','Próximo à praça',32),(65,'Rua Bela Vista','1211','São José','Portão azul',31),(66,'Rua Tiradentes','2878','São José','Sobrado',25),(67,'Avenida Independência','3316','São José','Sobrado',33),(68,'Rua Tiradentes','7716','Industrial','Sobrado',29),(69,'Avenida Independência','9306','Boa Esperança','Lado par',27),(70,'Avenida Brasil','989','Vila Nova','Esquina',39),(71,'Rua das Laranjeiras','3399','Santa Rita','Portão azul',25),(72,'Rua das Acácias','5412','Bela Vista','Casa fundos',22),(73,'Rua Tiradentes','7609','Jardim América','Lado par',29),(74,'Avenida Central','7506','Bela Vista','Portão azul',37),(75,'Avenida Central','4491','Industrial','Sem complemento',22),(76,'Avenida Brasil','4707','Industrial','Lado par',33),(77,'Avenida Central','2957','Boa Esperança','Sem complemento',30),(78,'Rua do Comércio','5189','Jardim América','Casa fundos',38),(79,'Rua das Flores','6435','Jardim América','Casa fundos',24),(80,'Rua dos Jasmins','7875','Santa Rita','Sem complemento',30);
/*!40000 ALTER TABLE `properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'CadastroImobSaoLeo'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-24  0:41:13
