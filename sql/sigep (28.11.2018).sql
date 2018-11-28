-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Nov-2018 às 15:43
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigep`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alteracao_cautela`
--

CREATE TABLE `alteracao_cautela` (
  `idCautela` bigint(20) NOT NULL,
  `idItem` bigint(20) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `motivo` varchar(100) DEFAULT NULL,
  `comunicao` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cautela`
--

CREATE TABLE `cautela` (
  `id` bigint(20) NOT NULL,
  `permanente` tinyint(1) NOT NULL,
  `aberta` tinyint(1) NOT NULL,
  `dataRetirada` date NOT NULL,
  `vencimento` date DEFAULT NULL,
  `dataEntrega` date DEFAULT NULL,
  `idPolicial` bigint(20) NOT NULL,
  `idDespachante` bigint(20) DEFAULT NULL,
  `idRecebedor` bigint(20) DEFAULT NULL,
  `idItem` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cautela`
--

INSERT INTO `cautela` (`id`, `permanente`, `aberta`, `dataRetirada`, `vencimento`, `dataEntrega`, `idPolicial`, `idDespachante`, `idRecebedor`, `idItem`, `quantidade`) VALUES
(37, 1, 0, '2018-11-28', '2018-11-29', NULL, 2, 1, NULL, 7, 14),
(36, 1, 0, '2018-11-28', '2018-11-29', NULL, 2, 1, NULL, 6, 7),
(35, 1, 0, '2018-11-28', '2018-11-29', NULL, 5, 1, NULL, 2, 1),
(34, 1, 0, '2018-11-28', '2018-11-29', NULL, 5, 1, NULL, 1, 1),
(38, 1, 0, '2018-11-28', '2018-11-29', NULL, 20, 1, NULL, 4, 1),
(39, 1, 0, '2018-11-28', '2018-11-29', NULL, 1, 1, NULL, 6, 18),
(40, 1, 0, '2018-11-28', '2018-11-29', NULL, 5, 1, NULL, 10, 1),
(41, 1, 0, '2018-11-28', '2018-11-29', NULL, 16, 1, NULL, 10, 10),
(42, 1, 0, '2018-11-28', '2018-11-29', NULL, 24, 1, NULL, 10, 70),
(43, 1, 0, '2018-11-28', '2018-11-29', NULL, 22, 1, NULL, 10, 15);

--
-- Acionadores `cautela`
--
DELIMITER $$
CREATE TRIGGER `tgr_Cautela_add` AFTER INSERT ON `cautela` FOR EACH ROW BEGIN
	IF NEW.permanente = 1 THEN 
		INSERT INTO Inspecao (idCautela, dataUltima, dataProxima, situacao) 
			values (	NEW.id, 
                    	CURDATE(), 
                    	DATE_ADD(CURDATE(), INTERVAL 3 MONTH), 
                    	'Em dia'
                   );
	END IF;
    UPDATE item
    SET estoque = estoque - NEW.quantidade
    WHERE id = NEW.idItem;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tgr_Cautela_update` AFTER UPDATE ON `cautela` FOR EACH ROW BEGIN
	IF NEW.aberta = 0 THEN     
    
        UPDATE item 
        SET estoque = estoque + NEW.quantidade
        WHERE id = NEW.idItem;
        
	END IF;
    
    IF NEW.permanente = 0 and NEW.aberta = 0 THEN
        
        DELETE FROM Inspecao
        WHERE idCautela = NEW.id;

	END IF; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fabricante`
--

CREATE TABLE `fabricante` (
  `id` int(11) NOT NULL,
  `descricao` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `inspecao`
--

CREATE TABLE `inspecao` (
  `id` bigint(20) NOT NULL,
  `dataUltima` date NOT NULL,
  `dataProxima` date NOT NULL,
  `situacao` varchar(50) DEFAULT NULL,
  `idCautela` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `inspecao`
--

INSERT INTO `inspecao` (`id`, `dataUltima`, `dataProxima`, `situacao`, `idCautela`) VALUES
(16, '2018-11-28', '2019-02-28', 'Em dia', 43);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE `item` (
  `id` bigint(20) NOT NULL,
  `serial` varchar(30) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `estoque` int(11) NOT NULL,
  `estoque_danificado` int(11) NOT NULL DEFAULT '0',
  `situacao` varchar(30) NOT NULL DEFAULT '''Operacional''' COMMENT '''Operacional, Danificado, Manutenção, Justiça''',
  `validade` date DEFAULT NULL,
  `observacoes` varchar(150) DEFAULT NULL,
  `id_subunidade` int(11) DEFAULT NULL,
  `id_tipo_item` int(11) DEFAULT NULL,
  `id_fabricante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`id`, `serial`, `modelo`, `estoque`, `estoque_danificado`, `situacao`, `validade`, `observacoes`, `id_subunidade`, `id_tipo_item`, `id_fabricante`) VALUES
(1, 'SWI048144', 'Tamanho G', 3, 0, 'Operacional', '2018-09-12', 'Sem observações', 1, 1, 1),
(3, 'lhklhjkljkljkljlkKK', 'HJKHHJK', 1, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 4, 1),
(4, 'bbb', 'M5', 5, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 8, 2),
(5, 'aaa', 'SAFEGUARD 844', 10, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 9, 1),
(6, 'MUN40', 'Munição .40', 150, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 11, 3),
(7, 'MUN380', 'Munição .380', 100, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 11, 3),
(8, 'SPRAY_PIMENTA', 'Espargidor de pimenta', 5, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 14, 6),
(9, 'SPRAY_LACRIMO', 'Espargidor lacrimogênico', 2, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 14, 6),
(10, 'TONFA', 'Tonfa plástica', 90, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 15, 8),
(11, 'CB001', 'Tamanho M', 1, 0, 'Operacional', '2019-07-31', 'Sem observações', 1, 1, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_cautela`
--

CREATE TABLE `item_cautela` (
  `id` bigint(20) NOT NULL,
  `permanente` int(11) DEFAULT NULL,
  `aberta` int(11) DEFAULT NULL,
  `idPolicial` int(11) DEFAULT NULL,
  `dataRetirada` date DEFAULT NULL,
  `vencimento` date DEFAULT NULL,
  `dataEntrega` date DEFAULT NULL,
  `idDespachante` int(11) DEFAULT NULL,
  `idRecebedor` int(11) DEFAULT NULL,
  `idItem` bigint(20) NOT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `logacesso`
--

CREATE TABLE `logacesso` (
  `id` int(11) NOT NULL,
  `matricula` varchar(255) DEFAULT NULL,
  `nomedoacesso` varchar(255) DEFAULT NULL,
  `horalogin` varchar(255) DEFAULT NULL,
  `horalogout` varchar(255) DEFAULT NULL,
  `datalogin` varchar(255) DEFAULT NULL,
  `datalogout` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `logacesso`
--

INSERT INTO `logacesso` (`id`, `matricula`, `nomedoacesso`, `horalogin`, `horalogout`, `datalogin`, `datalogout`) VALUES
(1, '205.020-0', 'VANDERSON', '09:16:07', '12:43:37', '16/11/2018', '28/11/2018'),
(2, '205.020-0', 'VANDERSON', '10:21:03', '12:43:37', '16/11/2018', '28/11/2018'),
(3, '205.020-0', 'VANDERSON', '11:55:00', '12:43:37', '16/11/2018', '28/11/2018'),
(4, '205.020-0', 'VANDERSON', '08:13:17', '12:43:37', '19/11/2018', '28/11/2018'),
(5, '205.020-0', 'VANDERSON', '08:13:45', '12:43:37', '20/11/2018', '28/11/2018'),
(6, '205.020-0', 'VANDERSON', '08:04:48', '12:43:37', '24/11/2018', '28/11/2018'),
(7, '205.020-0', 'VANDERSON', '09:44:57', '12:43:37', '24/11/2018', '28/11/2018'),
(8, '205.020-0', 'VANDERSON', '11:03:56', '12:43:37', '24/11/2018', '28/11/2018'),
(9, '205.020-0', 'VANDERSON', '08:29:51', '12:43:37', '27/11/2018', '28/11/2018'),
(10, '205.020-0', 'VANDERSON', '09:46:25', '12:43:37', '28/11/2018', '28/11/2018');

-- --------------------------------------------------------

--
-- Estrutura da tabela `operador`
--

CREATE TABLE `operador` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `graduacao` varchar(10) NOT NULL DEFAULT 'sd',
  `nome_funcional` varchar(30) NOT NULL,
  `matricula` varchar(9) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '0',
  `tipo` varchar(25) NOT NULL DEFAULT 'operador'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `operador`
--

INSERT INTO `operador` (`id`, `nome`, `graduacao`, `nome_funcional`, `matricula`, `email`, `senha`, `ativo`, `tipo`) VALUES
(1, 'Vanderson Fábio de Araújo', 'SD', 'VANDERSON', '205.020-0', 'vanderson.fabio@gmail.com', '11111', 1, 'admin'),
(2, 'Rodrigo Aggeu de Medeiros Lopes', 'SD', 'AGGEU', '111.111-0', 'rodrigoaggeu@gmail.com', '11111', 1, 'admin'),
(3, 'Isaac José de Oliveira Santos', 'SD', 'ISAAC', '123.321-0', 'oliveiira99.i@gmail.com', '11111', 1, 'admin'),
(4, 'Bruno Borges da Silva', 'SD', 'Bruno', '321.321-0', 'brunosilv_a@outlook.com', '11111', 1, 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `policial`
--

CREATE TABLE `policial` (
  `id` bigint(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `graduacao` varchar(10) NOT NULL DEFAULT 'sd',
  `nome_funcional` varchar(30) NOT NULL,
  `matricula` varchar(9) NOT NULL,
  `email` varchar(50) NOT NULL,
  `situacao` varchar(25) NOT NULL DEFAULT 'Apto' COMMENT 'Apto, Suspenso, Junta Psiquiátrica',
  `id_subunidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `policial`
--

INSERT INTO `policial` (`id`, `nome`, `graduacao`, `nome_funcional`, `matricula`, `email`, `situacao`, `id_subunidade`) VALUES
(1, 'Isaac José', 'CB', 'ISAAC JOSÉ', '844.515-1', 'fulano@gmail.com', 'Apto', 1),
(2, 'Nardiele Mariz Alves', 'MAJ', 'NARDIELE', '999.999-9', 'nardiele.mariz@gmail.com', 'Apto', 7),
(3, 'SEVERINO PAULINO NETO', '3SGT', 'PAULINO', '555.555-5', 'sgtpaulino@hotmail.com', 'Apto', 2),
(4, 'DAMIÃO BENVINDO DE LIMA', '2SGT', 'DE LIMA', '425.785-6', 'damiaobenvindo@hotmail.com', 'Apto', 1),
(5, 'Vanderson Fábio de Araújo', 'CB', 'VANDERSON', '919.000-0', 'vanderson.fabio@gmail.com', 'Apto', 1),
(16, 'Steven Grant Rogers', 'CAP', 'AMÉRICA', '111.123-0', 'steve@marvel.com', 'Apto', 1),
(17, 'Thor Odinson', 'ST', 'THOR', '111.123-1', 'thor@marvel.com', 'Apto', 1),
(18, 'Anthony Edward Stark', 'TC', 'STARK', '111.123-2', 'si@marvel.com', 'Apto', 1),
(19, 'Robert Bruce Banner', 'CEL', 'HULK', '111.123-3', 'bbanner@marvel.com', 'Apto', 1),
(20, 'Wanda Maximoff', 'CB', 'MAXIMOFF', '111.123-4', 'wanda@marvel.com', 'Apto', 1),
(21, 'Natalia Alianovna Romanoff', '2TEN', 'NATASHA', '111.123-5', 'blackwidow@marvel.com', 'Apto', 1),
(22, 'Peter Benjamin Parker', 'SD', 'PARKER', '111.123-6', 'ps2mj@marvel.com', 'Apto', 1),
(23, 'Stephen Strange', 'CEL', 'STRANGE', '111.123-7', 'dr_strange@marvel.com', 'Apto', 1),
(24, 'Thanos', 'CEL', 'THANOS', '111.123-8', 'stones@marvel.com', 'Apto', 1),
(25, 'Nicholas Joseph Fury', 'CEL', 'FURY', '111.123-9', 'nickfury@marvel.com', 'Apto', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `subunidade`
--

CREATE TABLE `subunidade` (
  `id` int(11) NOT NULL,
  `sigla` varchar(25) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `id_unid_superior` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_item`
--

CREATE TABLE `tipo_item` (
  `id` int(11) NOT NULL,
  `descricao` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_item`
--

INSERT INTO `tipo_item` (`id`, `descricao`) VALUES
(1, 'Colete Balístico'),
(6, 'Pistola'),
(7, 'Revólver'),
(8, 'Fuzil'),
(9, 'Escopeta'),
(10, 'Carabina'),
(11, 'Munição'),
(12, 'Algema'),
(13, 'Colete Reflexivo'),
(14, 'Spray'),
(15, 'Tonfa'),
(16, 'Bastão'),
(17, 'Carregador'),
(18, 'Pistola de Choque'),
(19, 'Capacete'),
(20, 'Escudo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidade`
--

CREATE TABLE `unidade` (
  `id` int(11) NOT NULL,
  `sigla` varchar(25) NOT NULL,
  `descricao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `alteracao_cautela`
--
ALTER TABLE `alteracao_cautela`
  ADD PRIMARY KEY (`idCautela`,`idItem`),
  ADD KEY `fk_Item` (`idItem`);

--
-- Indexes for table `cautela`
--
ALTER TABLE `cautela`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Policial` (`idPolicial`),
  ADD KEY `fk_Despachante` (`idDespachante`),
  ADD KEY `fk_Recebedor` (`idRecebedor`),
  ADD KEY `idItem` (`idItem`);

--
-- Indexes for table `fabricante`
--
ALTER TABLE `fabricante`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspecao`
--
ALTER TABLE `inspecao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Cautela` (`idCautela`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial` (`serial`),
  ADD KEY `fk_id_fabricante` (`id_fabricante`),
  ADD KEY `fk_id_subunidade` (`id_subunidade`),
  ADD KEY `fk_id_tipo_item` (`id_tipo_item`);

--
-- Indexes for table `item_cautela`
--
ALTER TABLE `item_cautela`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Item` (`idItem`);

--
-- Indexes for table `logacesso`
--
ALTER TABLE `logacesso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operador`
--
ALTER TABLE `operador`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricula` (`matricula`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `policial`
--
ALTER TABLE `policial`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricula` (`matricula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_pm_subunidade` (`id_subunidade`);

--
-- Indexes for table `subunidade`
--
ALTER TABLE `subunidade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_unid_superior` (`id_unid_superior`);

--
-- Indexes for table `tipo_item`
--
ALTER TABLE `tipo_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unidade`
--
ALTER TABLE `unidade`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cautela`
--
ALTER TABLE `cautela`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `fabricante`
--
ALTER TABLE `fabricante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inspecao`
--
ALTER TABLE `inspecao`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `item_cautela`
--
ALTER TABLE `item_cautela`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `logacesso`
--
ALTER TABLE `logacesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `operador`
--
ALTER TABLE `operador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `policial`
--
ALTER TABLE `policial`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `subunidade`
--
ALTER TABLE `subunidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tipo_item`
--
ALTER TABLE `tipo_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `unidade`
--
ALTER TABLE `unidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_id_fabricante` FOREIGN KEY (`id_fabricante`) REFERENCES `fabricante` (`id`),
  ADD CONSTRAINT `fk_id_subunidade` FOREIGN KEY (`id_subunidade`) REFERENCES `subunidade` (`id`),
  ADD CONSTRAINT `fk_id_tipo_item` FOREIGN KEY (`id_tipo_item`) REFERENCES `tipo_item` (`id`);

--
-- Limitadores para a tabela `policial`
--
ALTER TABLE `policial`
  ADD CONSTRAINT `fk_pm_subunidade` FOREIGN KEY (`id_subunidade`) REFERENCES `subunidade` (`id`);

--
-- Limitadores para a tabela `subunidade`
--
ALTER TABLE `subunidade`
  ADD CONSTRAINT `fk_unid_superior` FOREIGN KEY (`id_unid_superior`) REFERENCES `unidade` (`id`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `InspecaoVencida` ON SCHEDULE EVERY 1 DAY STARTS '2018-11-14 06:00:00' ON COMPLETION PRESERVE ENABLE DO BEGIN
  UPDATE inspecao SET situacao = 'Atrasada'
  WHERE situacao = 'Em dia' and dataProxima <= CURDATE();
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
