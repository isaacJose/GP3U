-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 09-Out-2018 às 23:47
-- Versão do servidor: 5.7.21
-- PHP Version: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigep_db`
--

CREATE DATABASE sigep;
USE sigep;

-- --------------------------------------------------------

--
-- Definindo o charset do banco para UFT-8
--

ALTER DATABASE `sigep` CHARACTER SET utf8 COLLATE utf8_general_ci;

--
-- Estrutura da tabela `logacesso`
--

DROP TABLE IF EXISTS `logacesso`;
CREATE TABLE `logacesso` (
    `id` int auto_increment not null,
    `matricula` VARCHAR(255),
    `nomedoacesso` VARCHAR(255),
    `horalogin` VARCHAR(255),
    `horalogout` VARCHAR(255),
    `datalogin` VARCHAR(255),
    `datalogout` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Estrutura da tabela `alteracao_cautela`
--

DROP TABLE IF EXISTS `alteracao_cautela`;
CREATE TABLE IF NOT EXISTS `alteracao_cautela` (
  `idCautela` bigint(20) NOT NULL,
  `idItem` bigint(20) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `motivo` varchar(100) DEFAULT NULL,
  `comunicao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idCautela`,`idItem`)

) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cautela`
--

DROP TABLE IF EXISTS `cautela`;
CREATE TABLE IF NOT EXISTS `cautela` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `permanente` tinyint(1) NOT NULL,
  `aberta` tinyint(1) NOT NULL,
  `dataRetirada` date NOT NULL,
  `vencimento` date DEFAULT NULL,
  `dataEntrega` date DEFAULT NULL,
  `idPolicial` bigint(20) DEFAULT NULL,
  `idDespachante` bigint(20) DEFAULT NULL,
  `idRecebedor` bigint(20) DEFAULT NULL,
  `idItem` bigint(20) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
  
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Estrutura da tabela `fabricante`
--

DROP TABLE IF EXISTS `fabricante`;
CREATE TABLE IF NOT EXISTS `fabricante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `inspecao`
--

DROP TABLE IF EXISTS `inspecao`;
CREATE TABLE IF NOT EXISTS `inspecao` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dataUltima` date NOT NULL,
  `dataProxima` date NOT NULL,
  `situacao` varchar(50) DEFAULT NULL,
  `idCautela` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)

) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `serial` varchar(30) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `estoque` int(11) NOT NULL,
  `estoque_danificado` int(11) NOT NULL DEFAULT '0',
  `situacao` varchar(30) NOT NULL DEFAULT '''Operacional''' COMMENT '''Operacional, Danificado, Manutenção, Justiça''',
  `validade` date DEFAULT NULL,
  `observacoes` varchar(150) DEFAULT NULL,
  `id_subunidade` int(11) DEFAULT NULL,
  `id_tipo_item` int(11) DEFAULT NULL,
  `id_fabricante` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `serial` (`serial`)

) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estrutura da tabela `item_cautela`
--

DROP TABLE IF EXISTS `item_cautela`;
CREATE TABLE IF NOT EXISTS `item_cautela` (
   `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idCautela` bigint(20),
  `idItem` bigint(20),
  `quantidade` int(11),
   PRIMARY KEY (`id`)

) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `operador`
--

DROP TABLE IF EXISTS `operador`;
CREATE TABLE IF NOT EXISTS `operador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `graduacao` varchar(10) NOT NULL DEFAULT 'sd',
  `nome_funcional` varchar(30) NOT NULL,
  `matricula` varchar(9) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '0',
  `tipo` varchar(25) NOT NULL DEFAULT 'operador',
  PRIMARY KEY (`id`),
  UNIQUE KEY `matricula` (`matricula`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `policial`
--

DROP TABLE IF EXISTS `policial`;
CREATE TABLE IF NOT EXISTS `policial` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `graduacao` varchar(10) NOT NULL DEFAULT 'sd',
  `nome_funcional` varchar(30) NOT NULL,
  `matricula` varchar(9) NOT NULL,
  `email` varchar(50) NOT NULL,
  `situacao` varchar(25) NOT NULL DEFAULT 'Apto' COMMENT 'Apto, Suspenso, Junta Psiquiátrica',
  `id_subunidade` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `matricula` (`matricula`),
  UNIQUE KEY `email` (`email`)

) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `subunidade`
--

DROP TABLE IF EXISTS `subunidade`;
CREATE TABLE IF NOT EXISTS `subunidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(25) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `id_unid_superior` int(11) NOT NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_item`
--

DROP TABLE IF EXISTS `tipo_item`;
CREATE TABLE IF NOT EXISTS `tipo_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidade`
--

DROP TABLE IF EXISTS `unidade`;
CREATE TABLE IF NOT EXISTS `unidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(25) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `operador`
--

INSERT INTO `operador` (`id`, `nome`, `graduacao`, `nome_funcional`, `matricula`, `email`, `senha`, `ativo`, `tipo`) VALUES
(1, 'Vanderson Fábio de Araújo', 'sd', 'vanderson', '205.020-0', 'vanderson.fabio@gmail.com', '11111', 1, 'admin');


--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`id`, `serial`, `modelo`, `estoque`, `estoque_danificado`, `situacao`, `validade`, `observacoes`, `id_subunidade`, `id_tipo_item`, `id_fabricante`) VALUES
(1, 'SWI048144', 'PT 001', 1, 0, 'Danificado', '2018-09-12', 'teste', 1, 1, 1);

--
-- Extraindo dados da tabela `fabricante`
--

INSERT INTO `fabricante` (`id`, `descricao`) VALUES
(1, 'Taurus'),
(2, 'Imbel'),
(3, 'CBC'),
(4, 'Imbra'),
(5, 'Taser'),
(6, 'Condor'),
(7, 'Safeline'),
(8, 'INCOSEG');

--
-- Extraindo dados da tabela `unidade`
--

INSERT INTO `unidade` (`id`, `sigla`, `descricao`) VALUES
(1, '6BPM', '6º Batalhão de Polícial Militar'),
(2, 'CIPAM', 'Companhia Independente de Proteção Ambiental'),
(3, 'CIPRED', 'Companhia Independente de Prevenção ao Uso de Drog'),
(4, 'CPRE', 'Comando de Policiamento Rodoviário Estadual'),
(5, 'RPMON', 'Regimento de Polícia Montada'),
(6, 'CIPM', 'Companhia Independente da Polícia Militar');


--
-- Extraindo dados da tabela `tipo_item`
--

INSERT INTO `tipo_item` (`id`, `descricao`) VALUES
(1, 'Pistola');


--
-- Extraindo dados da tabela `subunidade`
--

INSERT INTO `subunidade` (`id`, `sigla`, `descricao`, `id_unid_superior`) VALUES
(1, '1CIA/SEDE', '1ª Companhia - Caicó', 1),
(2, '2CIA/JSERIDO', '2ª Companhia - Jardim do Seridó', 1),
(3, '3CIA/JUCURUTU', '3ª Companhia - Jucurutu', 1),
(5, '3CIPM', '3ª CIPM - Currais Novos', 6),
(6, '5CIPM', '5ª CIPM - Jardim de Piranhas', 6),
(7, '3DPRE', '3º DPRE - Caicó', 4),
(8, '2EPMON', '2º EPMon - Caicó', 5),
(9, 'DPM/CRUZETA', 'Descacamento PM - Cruzeta', 1),
(10, 'DPM/IPUEIRA', 'Descacamento PM - Ipueira', 1),
(11, 'DPM/OUROB', 'Descacamento PM - Ouro Branco', 1),
(12, 'DPM/SJSERIDO', 'Descacamento PM - São José do Seridó', 1),
(13, 'DPM/SJSABUGI', 'Descacamento PM - São João do Sabugi', 1),
(14, 'DPM/TIMBAUBA', 'Descacamento PM - Timbaúba dos Batistas', 1),
(15, 'DPM/SFERNAND', 'Descacamento PM - São Fernando', 1),
(16, 'DPM/FLORANIA', 'Descacamento PM - Florânia', 1),
(17, 'DPM/SMATOS', 'Descacamento PM - Santana do Matos', 1),
(18, 'DPM/TENLAURE', 'Descacamento PM - Tenente Laurentino', 1);

--
-- Extraindo dados da tabela `policial`
--

INSERT INTO `policial` (`id`, `nome`, `graduacao`, `nome_funcional`, `matricula`, `email`, `situacao`, `id_subunidade`) VALUES
(1, 'Vanderson Fábio de Araújo', 'sd', 'vanderson', '205.020-0', 'vanderson.fabio@gmail.com', 'Apto', 1);


--
-- Constraints for dumped tables
--


ALTER TABLE item ADD CONSTRAINT fk_id_fabricante FOREIGN KEY (id_fabricante) REFERENCES fabricante (id);

ALTER TABLE item  ADD CONSTRAINT fk_id_subunidade FOREIGN KEY (id_subunidade) REFERENCES subunidade (id);

ALTER TABLE item  ADD CONSTRAINT fk_id_tipo_item FOREIGN KEY (id_tipo_item) REFERENCES tipo_item (id);

ALTER TABLE policial ADD CONSTRAINT fk_pm_subunidade FOREIGN KEY (id_subunidade) REFERENCES subunidade (id);

ALTER TABLE subunidade ADD CONSTRAINT fk_unid_superior FOREIGN KEY (id_unid_superior) REFERENCES unidade (id);

alter table cautela add CONSTRAINT fk_Policial FOREIGN key (idPolicial) REFERENCES policial (id);

alter table cautela add CONSTRAINT fk_Despachante FOREIGN key (idDespachante) REFERENCES policial (id);

alter table cautela add CONSTRAINT fk_Recebedor FOREIGN key (idRecebedor) REFERENCES policial (id);

alter table cautela add CONSTRAINT fk_item FOREIGN key (idItem) REFERENCES item (id);

alter table alteracao_cautela add CONSTRAINT fk_cautela FOREIGN key (idCautela) REFERENCES cautela (id);

alter table alteracao_cautela add CONSTRAINT fk_Item FOREIGN key (idItem) REFERENCES item (id);

alter table inspecao add CONSTRAINT fk_Cautela FOREIGN key (idCautela) REFERENCES cautela (id);

alter table item_cautela add CONSTRAINT fk_Cautela FOREIGN key (idCautela) REFERENCES cautela (id);

alter table item_cautela add CONSTRAINT fk_Item FOREIGN key (idItem) REFERENCES item (id);

-- Cria um registro na tabela inspeção logo após a criação de uma cautela permanente
-- O trigger também seta a data da próxima inspeção para 3 meses depois
DELIMITER $$
-- DROP TRIGGER IF EXISTS `tgr_Inspecao_add`;
CREATE TRIGGER `tgr_Inspecao_add` AFTER INSERT ON `cautela`
 FOR EACH ROW BEGIN
	IF NEW.permanente = 1 THEN 
		INSERT INTO Inspecao (idCautela, dataUltima, dataProxima, situacao) 
			values (	NEW.id, 
                    	CURDATE(), 
                    	DATE_ADD(CURDATE(), INTERVAL 3 MONTH), 
                    	'Em dia'
                   );
	END IF;
END $$
DELIMITER ;

-- Gatilho para subtrair do estoque a quantidade de itens cadastrados na cautela
-- Quando uma cautela é cadastrada o gatilho dispara
DELIMITER $$
-- DROP TRIGGER IF EXISTS `tgr_Inspecao_add`;
CREATE TRIGGER `tgr_subtrair` AFTER INSERT ON `cautela`
 FOR EACH ROW BEGIN 
		UPDATE `item` i set i.estoque = i.estoque - new.quantidade 
        WHERE i.id = new.idItem;
END $$
DELIMITER ;



-- Deleta a inspeção após fechar a cautela permanente
DELIMITER $$
-- DROP TRIGGER IF EXISTS `tgr_Inspecao_delete`;
CREATE TRIGGER `tgr_Inspecao_delete` AFTER UPDATE ON `cautela`
 FOR EACH ROW BEGIN
	IF NEW.aberta = 0 and NEW.permanente = 1 THEN 
		DELETE FROM Inspecao
        WHERE idCautela = NEW.id;
	END IF;
END $$
DELIMITER ;

-- Privilégios para que os eventos possam rodar
SET GLOBAL event_scheduler := 1;

-- Rotina diária de verificação das inspeções vencidas
-- Executada todos os dias às 6 da manhã
DELIMITER $$
-- DROP EVENT IF EXISTS `InspecaoVencida`;
CREATE DEFINER=`root`@`localhost` EVENT `InspecaoVencida`
ON SCHEDULE 
EVERY 1 DAY 
STARTS '2018-11-14 06:00:00' 
ON COMPLETION PRESERVE ENABLE 
DO 
BEGIN
  UPDATE inspecao SET situacao = 'Atrasada'
  WHERE situacao = 'Em dia' and dataProxima <= CURDATE();
END $$
DELIMITER ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
