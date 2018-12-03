CREATE DATABASE  IF NOT EXISTS `biblioteca` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `biblioteca`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: biblioteca
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.28-MariaDB

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
-- Table structure for table `emprestimo`
--

DROP TABLE IF EXISTS `emprestimo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emprestimo` (
  `idUsuario` int(11) NOT NULL,
  `idLivro` int(11) NOT NULL,
  `DataVencimentoEmprestimo` date NOT NULL,
  KEY `idLivro` (`idLivro`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`idLivro`) REFERENCES `livro` (`idLivro`),
  CONSTRAINT `emprestimo_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emprestimo`
--

LOCK TABLES `emprestimo` WRITE;
/*!40000 ALTER TABLE `emprestimo` DISABLE KEYS */;
INSERT INTO `emprestimo` VALUES (3,18,'2018-12-04'),(2,2,'2018-12-11'),(1,20,'2018-12-18');
/*!40000 ALTER TABLE `emprestimo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livro`
--

DROP TABLE IF EXISTS `livro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livro` (
  `idLivro` int(11) NOT NULL AUTO_INCREMENT,
  `nomeLivro` varchar(150) NOT NULL,
  `disponibilidade` int(1) NOT NULL,
  PRIMARY KEY (`idLivro`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livro`
--

LOCK TABLES `livro` WRITE;
/*!40000 ALTER TABLE `livro` DISABLE KEYS */;
INSERT INTO `livro` VALUES (1,'Harry Potter e a Ordem da FÃªnix',0),(2,'Harry Potter e a Ordem da FÃªnix',0),(3,'Harry Potter e a Ordem da FÃªnix',0),(4,'Harry Potter e a Ordem da FÃªnix',1),(5,'Harry Potter e a Ordem da FÃªnix',1),(6,'Harry Potter e a Ordem da FÃªnix',1),(7,'Harry Potter e a Ordem da FÃªnix',1),(8,'Harry Potter e a Ordem da FÃªnix',1),(9,'Harry Potter e a Ordem da FÃªnix',1),(10,'Harry Potter e a Ordem da FÃªnix',1),(11,'Minha Luta',0),(12,'Minha Luta',0),(13,'Minha Luta',1),(14,'Minha Luta',1),(15,'Minha Luta',1),(16,'As CrÃ´nicas de NÃ¡rnia',0),(17,'As CrÃ´nicas de NÃ¡rnia',0),(18,'As CrÃ´nicas de NÃ¡rnia',0),(19,'As CrÃ´nicas de NÃ¡rnia',0),(20,'As CrÃ´nicas de NÃ¡rnia',0),(21,'As CrÃ´nicas de NÃ¡rnia',0),(22,'As CrÃ´nicas de NÃ¡rnia',0),(23,'As CrÃ´nicas de NÃ¡rnia',1),(24,'As CrÃ´nicas de NÃ¡rnia',1),(25,'As CrÃ´nicas de NÃ¡rnia',1),(26,'As CrÃ´nicas de NÃ¡rnia',1),(27,'As CrÃ´nicas de NÃ¡rnia',1),(28,'As CrÃ´nicas de NÃ¡rnia',1),(29,'As CrÃ´nicas de NÃ¡rnia',1),(30,'As CrÃ´nicas de NÃ¡rnia',1),(31,'The Hunger Games',0),(32,'The Hunger Games',1),(33,'The Hunger Games',1),(34,'The Hunger Games',1),(35,'The Hunger Games',1),(36,'The Hunger Games',1),(37,'The Hunger Games',1),(38,'The Hunger Games',1);
/*!40000 ALTER TABLE `livro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservado`
--

DROP TABLE IF EXISTS `reservado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservado` (
  `idUsuario` int(11) NOT NULL,
  `idLivro` int(11) NOT NULL,
  `VencimentoReserva` date NOT NULL,
  KEY `idLivro` (`idLivro`),
  KEY `reservado_ibfk_1` (`idUsuario`),
  CONSTRAINT `reservado_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservado`
--

LOCK TABLES `reservado` WRITE;
/*!40000 ALTER TABLE `reservado` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `data_nascimento` date NOT NULL,
  `tipo` int(1) NOT NULL,
  `data_cadastro` date NOT NULL,
  `data_vencimento_cadastro` date NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'professor@email.com','prof123','Professor','1980-10-05',1,'2018-11-25','2019-11-25'),(2,'aluno@email.com','aluno23','Aluno','2000-10-28',2,'2018-11-25','2019-11-25'),(3,'comunidade@email.com','comunidade123','Comunidade','1994-07-31',3,'2018-11-25','2019-11-25');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarioadmin`
--

DROP TABLE IF EXISTS `usuarioadmin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarioadmin` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(120) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `senha` varchar(120) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarioadmin`
--

LOCK TABLES `usuarioadmin` WRITE;
/*!40000 ALTER TABLE `usuarioadmin` DISABLE KEYS */;
INSERT INTO `usuarioadmin` VALUES (1,'admin@admin.com','Admin','123');
/*!40000 ALTER TABLE `usuarioadmin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'biblioteca'
--
/*!50003 DROP PROCEDURE IF EXISTS `cadastrarLivro` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cadastrarLivro`(IN `nomeLivro` VARCHAR(150), IN QtdLivro INT(11))
BEGIN









DECLARE cont INT;




SET cont = 1;









 WHILE cont <= QtdLivro DO




 




INSERT INTO livro(nomeLivro, disponibilidade) VALUES (nomeLivro,1);




SET cont = cont+1;









 END WHILE;









END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cadastrarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cadastrarUsuario`(IN `emailR` VARCHAR(80), IN `senhaR` VARCHAR(80), IN `nomeR` VARCHAR(80), IN `dataR` DATE, IN `tipoR` VARCHAR(1))
BEGIN





INSERT INTO usuario (email, senha, nome, data_nascimento, tipo, data_cadastro, data_vencimento_cadastro) VALUES (emailR, senhaR, nomeR, dataR, tipoR, NOW(), NOW() + INTERVAL 1 YEAR);








END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `EmprestimoLivro` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `EmprestimoLivro`(IN `nomeLivroS` VARCHAR(150), IN QtdLivro INT(11), IN idUsuario INT (11), IN idTipoUsuario INT (11))
BEGIN

DECLARE cont INT;

SET cont = 1;

IF(idTipoUsuario = 1)
THEN
WHILE cont <= QtdLivro DO

INSERT INTO emprestimo VALUES (idUsuario, (SELECT idLivro FROM livro WHERE nomeLivro LIKE nomeLivroS AND disponibilidade = 1 LIMIT 1),NOW() + INTERVAL 14 DAY);

UPDATE livro SET disponibilidade = 0 WHERE nomeLivro LIKE nomeLivroS AND disponibilidade = 1 LIMIT 1;

SET cont = cont+1;

 END WHILE;
 
 END IF;
 
 
IF(idTipoUsuario = 2)
THEN
WHILE cont <= QtdLivro DO

INSERT INTO emprestimo VALUES (idUsuario, (SELECT idLivro FROM livro WHERE nomeLivro LIKE nomeLivroS AND disponibilidade = 1 LIMIT 1),NOW() + INTERVAL 7 DAY);

UPDATE livro SET disponibilidade = 0 WHERE nomeLivro LIKE nomeLivroS AND disponibilidade = 1 LIMIT 1;

SET cont = cont+1;

 END WHILE;
 
 END IF;
 
IF(idTipoUsuario = 3)
THEN
WHILE cont <= QtdLivro DO

INSERT INTO emprestimo VALUES (idUsuario, (SELECT idLivro FROM livro WHERE nomeLivro LIKE nomeLivroS AND disponibilidade = 1 LIMIT 1),NOW() + INTERVAL 4 DAY);

UPDATE livro SET disponibilidade = 0 WHERE nomeLivro LIKE nomeLivroS AND disponibilidade = 1 LIMIT 1;

SET cont = cont+1;

 END WHILE;

END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `EmprestimoLivroR` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `EmprestimoLivroR`(IN idUsuarioR INT (11), IN nomeLivroS VARCHAR(150), IN QtdLivroR INT(11))
BEGIN

DECLARE cont INT;

SET cont = 1;

WHILE cont <= QtdLivroR DO

INSERT INTO reservado VALUES (idUsuarioR, (SELECT idLivro FROM livro WHERE nomeLivro LIKE nomeLivroS AND disponibilidade = 1 LIMIT 1),NOW() + INTERVAL 20 DAY);

UPDATE livro SET disponibilidade = 2 WHERE nomeLivro LIKE nomeLivroS AND disponibilidade = 1 LIMIT 1;

SET cont = cont+1;

 END WHILE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-03 21:42:00
