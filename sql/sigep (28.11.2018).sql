-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Nov-2018 às 18:46
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
  `dataRetirada` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vencimento` datetime DEFAULT NULL,
  `dataEntrega` datetime DEFAULT NULL,
  `idPolicial` bigint(20) NOT NULL,
  `idItem` bigint(11) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `idDespachante` bigint(20) DEFAULT NULL,
  `idRecebedor` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cautela`
--

INSERT INTO `cautela` (`id`, `permanente`, `aberta`, `dataRetirada`, `vencimento`, `dataEntrega`, `idPolicial`, `idItem`, `quantidade`, `idDespachante`, `idRecebedor`) VALUES
(29, 1, 0, '2018-11-28 00:00:00', '2018-11-29 00:00:00', NULL, 1, 3, 2, 1, NULL),
(30, 1, 0, '2018-11-28 00:00:00', '2018-11-29 00:00:00', NULL, 1, 4, 10, 1, NULL),
(31, 1, 0, '2018-11-28 00:00:00', '2018-11-29 00:00:00', NULL, 4, 3, 5, 1, NULL),
(32, 1, 0, '2018-11-28 00:00:00', '2018-11-29 00:00:00', NULL, 4, 4, 3, 1, NULL),
(33, 1, 1, '2018-11-28 00:00:00', '2018-11-29 00:00:00', NULL, 1, 3, 12, 1, NULL);

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
    
    IF NEW.permanente = 1 and NEW.aberta = 0 THEN
        
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
(18, '2018-11-28', '2019-02-28', 'Em dia', 33);

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
(1, 'SWI048144', 'PT 001', 1, 0, 'Operacional', '2018-09-12', 'teste', 1, 1, 1),
(2, 'SSAGD8mmmm', 'PT-8000', 0, 1, 'Operacional', '2018-11-23', 'Sem observações', 1, 2, 1),
(3, 'ALG', 'Oxidada', 23, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 3, 1),
(4, 'ALGEMA', 'shhsa', 100, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 4, 1),
(5, 'tttttttt', 'ttttttttttttt', 6, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 6, 3),
(6, 'SWI048148', 'Tamanho G', 3, 0, 'Operacional', '2018-09-12', 'Sem observações', 1, 1, 1),
(7, 'lhklhjkljkljkljlkKK', 'HJKHHJK', 1, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 4, 1),
(8, 'bbb', 'M5', 5, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 8, 2),
(9, 'aaa', 'SAFEGUARD 844', 10, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 9, 1),
(10, 'MUN40', 'Munição .40', 150, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 11, 3),
(11, 'MUN380', 'Munição .380', 100, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 11, 3),
(12, 'SPRAY_PIMENTA', 'Espargidor de pimenta', 5, 0, 'Operacional', '2018-11-28', 'Sem observações', 1, 6, 6),
(13, 'SPRAY_LACRIMO', 'Espargidor lacrimogênico', 2, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 14, 6),
(14, 'TONFA', 'Tonfa plástica', 90, 0, 'Operacional', '0000-00-00', 'Sem observações', 1, 15, 8),
(15, 'CB001', 'Tamanho M', 1, 0, 'Operacional', '2019-07-31', 'Sem observações', 1, 1, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_cautela`
--

CREATE TABLE `item_cautela` (
  `id` bigint(20) NOT NULL,
  `idCautela` bigint(20) DEFAULT NULL,
  `idItem` bigint(20) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `item_cautela`
--

INSERT INTO `item_cautela` (`id`, `idCautela`, `idItem`, `quantidade`) VALUES
(10, NULL, 4, 11),
(9, NULL, 3, 12),
(8, NULL, 5, 1),
(7, NULL, 1, 1);

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
(1, '205.020-0', 'vanderson', '15:17:17', '15:45:49', '09/11/2018', '28/11/2018'),
(2, '205.020-0', 'vanderson', '15:28:58', '15:45:49', '09/11/2018', '28/11/2018'),
(3, '205.020-0', 'vanderson', '14:33:42', '15:45:49', '12/11/2018', '28/11/2018'),
(4, '205.020-0', 'vanderson', '15:36:49', '15:45:49', '13/11/2018', '28/11/2018'),
(5, '205.020-0', 'vanderson', '18:06:43', '15:45:49', '13/11/2018', '28/11/2018'),
(6, '205.020-0', 'vanderson', '16:14:28', '15:45:49', '14/11/2018', '28/11/2018'),
(7, '205.020-0', 'vanderson', '08:49:19', '15:45:49', '15/11/2018', '28/11/2018'),
(8, '205.020-0', 'vanderson', '10:05:40', '15:45:49', '15/11/2018', '28/11/2018'),
(9, '205.020-0', 'vanderson', '14:35:31', '15:45:49', '15/11/2018', '28/11/2018'),
(10, '205.020-0', 'vanderson', '16:12:19', '15:45:49', '15/11/2018', '28/11/2018'),
(11, '205.020-0', 'vanderson', '15:27:35', '15:45:49', '16/11/2018', '28/11/2018'),
(12, '205.020-0', 'vanderson', '14:33:08', '15:45:49', '19/11/2018', '28/11/2018'),
(13, '205.020-0', 'vanderson', '18:30:00', '15:45:49', '19/11/2018', '28/11/2018'),
(14, '205.020-0', 'vanderson', '14:17:57', '15:45:49', '20/11/2018', '28/11/2018'),
(15, '205.020-0', 'vanderson', '15:48:46', '15:45:49', '20/11/2018', '28/11/2018'),
(16, '205.020-0', 'vanderson', '14:29:34', '15:45:49', '26/11/2018', '28/11/2018'),
(17, '205.020-0', 'vanderson', '14:08:52', '15:45:49', '27/11/2018', '28/11/2018'),
(18, '205.020-0', 'vanderson', '14:23:39', '15:45:49', '27/11/2018', '28/11/2018'),
(19, '205.020-0', 'vanderson', '15:58:25', '15:45:49', '27/11/2018', '28/11/2018'),
(20, '205.020-0', 'vanderson', '17:39:00', '15:45:49', '27/11/2018', '28/11/2018'),
(21, '205.020-0', 'vanderson', '14:17:23', '15:45:49', '28/11/2018', '28/11/2018');

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
(1, 'Vanderson Fábio de Araújo', 'sd', 'Vanderon', '205.020-0', 'vanderson.fabio@gmail.com', '11111', 1, 'admin');

INSERT INTO `operador` (`id`, `nome`, `graduacao`, `nome_funcional`, `matricula`, `email`, `senha`, `ativo`, `tipo`) VALUES
(2, 'Bruno Borges da Silva', 'sd', 'Bruno', '654.020-0', 'brunno.linkin@gmail.com', '11111', 1, 'operador');

INSERT INTO `operador` (`id`, `nome`, `graduacao`, `nome_funcional`, `matricula`, `email`, `senha`, `ativo`, `tipo`) VALUES
(3, 'Rogrido Aggeu', 'sd', 'vanderson', '854.020-0', 'rodrigoaggeu@gmail.com', '11111', 1, 'operador');

INSERT INTO `operador` (`id`, `nome`, `graduacao`, `nome_funcional`, `matricula`, `email`, `senha`, `ativo`, `tipo`) VALUES
(4, 'Isaac José de Oliveira Santos', 'sd', 'Isaac', '852.020-0', 'oliveiira99.i@gmail.com', '11111', 1, 'admin');

INSERT INTO `operador` (`id`, `nome`, `graduacao`, `nome_funcional`, `matricula`, `email`, `senha`, `ativo`, `tipo`) VALUES
(5, 'Joaquim Heitor', 'sd', 'Gôdu', '999.020-0', 'kinkacaico@gmail.com', '11111', 1, 'operador');

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
(1, 'Vanderson Fábio de Araújo', 'SD', 'VANDERSON', '205.020-0', 'vanderson.fabio@gmail.com', 'Apto', 1),
(2, 'Francimar Lopes', '2TEN', 'FRANCIMAR', '789.789-7', 'email@email.com', 'Apto', 14),
(4, 'Heitor Gordão', 'ST', 'BLASTOISE', '676.686-8', 'email4@email.com', 'Apto', 12),
(5, 'Davi Victor Dantas Alves', 'SD', 'DAVI VICTOR', '121.212-1', 'davivictor@gmail.com', 'Apto', 1),
(6, 'Isaac José', 'CB', 'ISAAC JOSÉ', '844.515-1', 'fulano@gmail.com', 'Apto', 1),
(7, 'Nardiele Mariz Alves', 'MAJ', 'NARDIELE', '999.999-9', 'nardiele.mariz@gmail.com', 'Apto', 7),
(8, 'SEVERINO PAULINO NETO', '3SGT', 'PAULINO', '555.555-5', 'sgtpaulino@hotmail.com', 'Apto', 2),
(9, 'DAMIÃO BENVINDO DE LIMA', '2SGT', 'DE LIMA', '425.785-6', 'damiaobenvindo@hotmail.com', 'Apto', 1),
(10, 'Steven Grant Rogers', 'CAP', 'AMÉRICA', '111.123-0', 'steve@marvel.com', 'Apto', 1),
(11, 'Thor Odinson', 'ST', 'THOR', '111.123-1', 'thor@marvel.com', 'Apto', 1),
(12, 'Anthony Edward Stark', 'TC', 'STARK', '111.123-2', 'si@marvel.com', 'Apto', 1),
(13, 'Robert Bruce Banner', 'CEL', 'HULK', '111.123-3', 'bbanner@marvel.com', 'Apto', 1),
(14, 'Wanda Maximoff', 'CB', 'MAXIMOFF', '111.123-4', 'wanda@marvel.com', 'Apto', 1),
(15, 'Natalia Alianovna Romanoff', '2TEN', 'NATASHA', '111.123-5', 'blackwidow@marvel.com', 'Apto', 1),
(16, 'Peter Benjamin Parker', 'SD', 'PARKER', '111.123-6', 'ps2mj@marvel.com', 'Apto', 1),
(17, 'Stephen Strange', 'CEL', 'STRANGE', '111.123-7', 'dr_strange@marvel.com', 'Apto', 1),
(18, 'Thanos', 'CEL', 'THANOS', '111.123-8', 'stones@marvel.com', 'Apto', 1),
(19, 'Nicholas Joseph Fury', 'CEL', 'FURY', '111.123-9', 'nickfury@marvel.com', 'Apto', 1);

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
(2, 'Pistola'),
(3, 'Fuzil'),
(4, 'Algema'),
(5, 'Carabina'),
(6, 'Spray'),
(7, 'Revólver'),
(8, 'Escopeta'),
(9, 'Munição'),
(10, 'Colete Reflexivo'),
(11, 'Tonfa'),
(12, 'Bastão'),
(13, 'Carregador'),
(14, 'Pistola de Choque'),
(15, 'Capacete'),
(16, 'Escudo');

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
  ADD KEY `fk_Recebedor` (`idRecebedor`);

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
  ADD KEY `fk_Cautela` (`idCautela`),
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `fabricante`
--
ALTER TABLE `fabricante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inspecao`
--
ALTER TABLE `inspecao`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `item_cautela`
--
ALTER TABLE `item_cautela`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `logacesso`
--
ALTER TABLE `logacesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `operador`
--
ALTER TABLE `operador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `policial`
--
ALTER TABLE `policial`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `subunidade`
--
ALTER TABLE `subunidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tipo_item`
--
ALTER TABLE `tipo_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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

-- FOREIGN KEY PARA ITEM

ALTER TABLE `cautela`
  ADD CONSTRAINT `fk_id_item_cautela` FOREIGN KEY (`idItem`) 
  REFERENCES `item` (`id`) on DELETE RESTRICT on UPDATE cascade;

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
CREATE DEFINER=`root`@`localhost` EVENT `InspecaoVencida` ON SCHEDULE EVERY 10 SECOND STARTS '2018-11-14 06:00:00' ON COMPLETION PRESERVE ENABLE DO BEGIN
  UPDATE inspecao SET situacao = 'Atrasada'
  WHERE situacao = 'Em dia' and dataProxima <= CURDATE();
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
