/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.1.38-MariaDB : Database - infocity2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`infocity2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `infocity2`;

/*Table structure for table `tbcidade` */

DROP TABLE IF EXISTS `tbcidade`;

CREATE TABLE `tbcidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `idEstado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Reference_5` (`idEstado`),
  CONSTRAINT `FK_Reference_5` FOREIGN KEY (`idEstado`) REFERENCES `tbestado` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbcidade` */

insert  into `tbcidade`(`id`,`nome`,`idEstado`) values 
(1,'Ipatinga',1),
(3,'TimÃ³teo',1);

/*Table structure for table `tbcolaboracao` */

DROP TABLE IF EXISTS `tbcolaboracao`;

CREATE TABLE `tbcolaboracao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(4000) NOT NULL,
  `dataRegistro` datetime NOT NULL,
  `latitude` decimal(9,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `complemento` varchar(255) NOT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `idCidade` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `idSituacao` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Reference_1` (`idUsuario`),
  KEY `FK_Reference_13` (`idTipo`),
  KEY `FK_Reference_15` (`idSituacao`),
  KEY `FK_Reference_7` (`idCidade`),
  CONSTRAINT `FK_Reference_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`id`),
  CONSTRAINT `FK_Reference_13` FOREIGN KEY (`idTipo`) REFERENCES `tbtipo` (`id`),
  CONSTRAINT `FK_Reference_15` FOREIGN KEY (`idSituacao`) REFERENCES `tbsituacao` (`id`),
  CONSTRAINT `FK_Reference_7` FOREIGN KEY (`idCidade`) REFERENCES `tbcidade` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `tbcolaboracao` */

insert  into `tbcolaboracao`(`id`,`titulo`,`descricao`,`dataRegistro`,`latitude`,`longitude`,`rua`,`numero`,`bairro`,`complemento`,`cep`,`idCidade`,`idUsuario`,`idTipo`,`idSituacao`) values 
(13,'Coleta seletiva de aparelhos eletrÃ´nicos','Tenho vÃ¡rios computadores velhos quebrados em casa, alÃ©m disso, alguns celulares antigos e televisÃµes.','2020-04-04 20:31:01',-19.586628,-42.648890,'Rua Holanda','100','Ana Rita','casa','35182-262',3,3,1,4),
(14,'Buraco enorme','Buraco enorme na rua do meu serviÃ§o, impossibilitando passar de carro','2020-04-04 20:36:49',-19.582679,-42.646476,'PraÃ§a Vinte e Nove de Abril','314','Centro Sul','Loja','35182-004',3,3,3,2),
(15,'trolando a prefeitura hahahaha','testando sistema falho da prefeitura hehe','2020-04-04 20:37:47',-19.586628,-42.648890,'Rua Holanda','100','Ana Rita','casa','35182-262',3,3,5,5),
(16,'Coleta seletiva papelÃ£o','Mudei recentemente, entÃ£o tenho vÃ¡rias caixas de papelÃ£o para reciclagem','2020-04-04 20:58:27',-19.543592,-42.646310,'Avenida Almir de Souza Ameno','215','FuncionÃ¡rios','apartamento 201','35180-412',3,18,1,4),
(17,'Caixas de papelÃ£o do supermercado','Centenas de caixas de papelÃ£o descartadas diariamente neste supermercado.','2020-04-04 21:01:54',-19.542064,-42.650519,'Avenida Jovino Augusto da Silva','210','BromÃ©lias','supermercado','35180-514',3,19,1,4),
(18,'Luz do poste queimado','Luz do poste queimado em frente minha casa','2020-04-04 21:02:58',-19.554184,-42.585413,'Rua AraribÃ¡','300','Recanto Verde','Casa','35181-582',3,19,5,2),
(19,'testando novo sistema da prefeitura','testando novo sistema da prefeitura','2020-04-04 21:03:36',-19.542064,-42.650519,'Avenida Jovino Augusto da Silva','210','BromÃ©lias','supermercado','35180-514',3,19,6,5);

/*Table structure for table `tbcomentario` */

DROP TABLE IF EXISTS `tbcomentario`;

CREATE TABLE `tbcomentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` varchar(4000) DEFAULT NULL,
  `data` datetime NOT NULL,
  `avaliacao` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idColaboracao` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Reference_17` (`idUsuario`),
  KEY `FK_Reference_18` (`idColaboracao`),
  CONSTRAINT `FK_Reference_17` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`id`),
  CONSTRAINT `FK_Reference_18` FOREIGN KEY (`idColaboracao`) REFERENCES `tbcolaboracao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `tbcomentario` */

insert  into `tbcomentario`(`id`,`comentario`,`data`,`avaliacao`,`idUsuario`,`idColaboracao`) values 
(16,'muito bom, sem palavras','2020-04-04 06:19:55',5,3,13),
(17,'muito boa','2020-04-04 06:47:47',5,19,17),
(18,'intermediaria\n','2020-04-04 06:52:21',3,18,16);

/*Table structure for table `tbendereco` */

DROP TABLE IF EXISTS `tbendereco`;

CREATE TABLE `tbendereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` decimal(9,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `complemento` varchar(255) NOT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `idCidade` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Reference_4` (`idUsuario`),
  KEY `FK_Reference_6` (`idCidade`),
  CONSTRAINT `FK_Reference_4` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`id`),
  CONSTRAINT `FK_Reference_6` FOREIGN KEY (`idCidade`) REFERENCES `tbcidade` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbendereco` */

insert  into `tbendereco`(`id`,`latitude`,`longitude`,`rua`,`numero`,`bairro`,`complemento`,`cep`,`idCidade`,`idUsuario`) values 
(2,-19.586628,-42.648890,'Rua Holanda','100','Ana Rita','casa','35182-262',3,3),
(3,-19.582679,-42.646476,'PraÃ§a Vinte e Nove de Abril','314','Centro Sul','Loja','35182-004',3,3),
(4,-19.543592,-42.646310,'Avenida Almir de Souza Ameno','215','FuncionÃ¡rios','apartamento 201','35180-412',3,18),
(5,-19.554184,-42.585413,'Rua AraribÃ¡','300','Recanto Verde','Casa','35181-582',3,19),
(6,-19.542064,-42.650519,'Avenida Jovino Augusto da Silva','210','BromÃ©lias','supermercado','35180-514',3,19);

/*Table structure for table `tbestado` */

DROP TABLE IF EXISTS `tbestado`;

CREATE TABLE `tbestado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `sigla` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbestado` */

insert  into `tbestado`(`id`,`nome`,`sigla`) values 
(1,'Minas Gerais','Mg'),
(4,'SÃ£o Paulo','Sp');

/*Table structure for table `tbhistorico` */

DROP TABLE IF EXISTS `tbhistorico`;

CREATE TABLE `tbhistorico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `observacao` varchar(4000) DEFAULT NULL,
  `dataRegistro` datetime NOT NULL,
  `idColaboracao` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idSituacao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Reference_16` (`idSituacao`),
  KEY `FK_Reference_2` (`idColaboracao`),
  KEY `FK_Reference_3` (`idUsuario`),
  CONSTRAINT `FK_Reference_16` FOREIGN KEY (`idSituacao`) REFERENCES `tbsituacao` (`id`),
  CONSTRAINT `FK_Reference_2` FOREIGN KEY (`idColaboracao`) REFERENCES `tbcolaboracao` (`id`),
  CONSTRAINT `FK_Reference_3` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbhistorico` */

/*Table structure for table `tbperfil` */

DROP TABLE IF EXISTS `tbperfil`;

CREATE TABLE `tbperfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbperfil` */

insert  into `tbperfil`(`id`,`nome`) values 
(4,'Colaborador'),
(5,'CorporaÃ§Ã£o'),
(6,'Admin');

/*Table structure for table `tbplanejamento` */

DROP TABLE IF EXISTS `tbplanejamento`;

CREATE TABLE `tbplanejamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dataRegistro` date NOT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaTermino` time DEFAULT NULL,
  `observacao` varchar(4000) DEFAULT NULL,
  `flagSituacao` int(11) NOT NULL,
  `distancia` decimal(9,2) NOT NULL,
  `idTipo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Reference_10` (`idTipo`),
  CONSTRAINT `FK_Reference_10` FOREIGN KEY (`idTipo`) REFERENCES `tbtipo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

/*Data for the table `tbplanejamento` */

insert  into `tbplanejamento`(`id`,`dataRegistro`,`horaInicio`,`horaTermino`,`observacao`,`flagSituacao`,`distancia`,`idTipo`) values 
(54,'2020-04-05','13:00:00','18:00:00','planejamneot 0001 pelo funcionÃ¡rio 1 devido a grande demanda da populaÃ§Ã£o',2,100.00,1);

/*Table structure for table `tbplanejamentocolaboracao` */

DROP TABLE IF EXISTS `tbplanejamentocolaboracao`;

CREATE TABLE `tbplanejamentocolaboracao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dataRealizacao` datetime NOT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `idPlanejamento` int(11) NOT NULL,
  `idColaboracao` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Reference_8` (`idPlanejamento`),
  KEY `FK_Reference_9` (`idColaboracao`),
  CONSTRAINT `FK_Reference_8` FOREIGN KEY (`idPlanejamento`) REFERENCES `tbplanejamento` (`id`),
  CONSTRAINT `FK_Reference_9` FOREIGN KEY (`idColaboracao`) REFERENCES `tbcolaboracao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

/*Data for the table `tbplanejamentocolaboracao` */

insert  into `tbplanejamentocolaboracao`(`id`,`dataRealizacao`,`observacao`,`idPlanejamento`,`idColaboracao`) values 
(81,'0000-00-00 00:00:00','nada',54,13),
(82,'0000-00-00 00:00:00','nada',54,16),
(83,'0000-00-00 00:00:00','nada',54,17);

/*Table structure for table `tbplanejamentousuario` */

DROP TABLE IF EXISTS `tbplanejamentousuario`;

CREATE TABLE `tbplanejamentousuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPlanejamento` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Reference_11` (`idPlanejamento`),
  KEY `FK_Reference_12` (`idUsuario`),
  CONSTRAINT `FK_Reference_11` FOREIGN KEY (`idPlanejamento`) REFERENCES `tbplanejamento` (`id`),
  CONSTRAINT `FK_Reference_12` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `tbplanejamentousuario` */

insert  into `tbplanejamentousuario`(`id`,`idPlanejamento`,`idUsuario`) values 
(24,54,9);

/*Table structure for table `tbsituacao` */

DROP TABLE IF EXISTS `tbsituacao`;

CREATE TABLE `tbsituacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbsituacao` */

insert  into `tbsituacao`(`id`,`nome`) values 
(1,'Registrada'),
(2,'Aceita'),
(3,'Planejada'),
(4,'Executada'),
(5,'Arquivada');

/*Table structure for table `tbtipo` */

DROP TABLE IF EXISTS `tbtipo`;

CREATE TABLE `tbtipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbtipo` */

insert  into `tbtipo`(`id`,`nome`) values 
(1,'Coleta seletiva'),
(2,'Foco de dengue'),
(3,'Buraco na rua'),
(4,'SemÃ¡foros com defeito'),
(5,'IluminaÃ§Ã£o pÃºblica'),
(6,'Lixo na rua');

/*Table structure for table `tbusuario` */

DROP TABLE IF EXISTS `tbusuario`;

CREATE TABLE `tbusuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `dataNascimento` date NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `flagSituacao` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `idPerfil` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Reference_14` (`idPerfil`),
  CONSTRAINT `FK_Reference_14` FOREIGN KEY (`idPerfil`) REFERENCES `tbperfil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `tbusuario` */

insert  into `tbusuario`(`id`,`nome`,`email`,`senha`,`dataNascimento`,`sexo`,`flagSituacao`,`foto`,`idPerfil`) values 
(3,'usuario1','usuario1@gmail.com','usuario1','2001-09-13','M',1,'padrao.png',4),
(6,'admin','admin@gmail.com','admin','0001-01-01','M',1,'padrao.png',6),
(9,'funcionario1','funcionario1@gmail.com','funcionario1','2012-08-16','M',1,'padrao.png',5),
(10,'funcionario2','funcionario2@gmail.com','funcionario2','2001-09-13','M',1,'padrao.png',5),
(18,'usuario2','usuario2@gmail.com','usuario2','2020-04-10','F',1,'padrao.png',4),
(19,'usuario3','usuario3@gmail.com','usuario3','2020-04-16','M',1,'padrao.png',4),
(20,'funcionario3','funcionario3@gmail.com','funcionario3','2020-12-31','M',1,'padrao.png',5);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
