--
-- Extraindo dados da tabela `Cautela`
--

INSERT INTO `cautela` (`id`, `permanente`,`aberta`,`dataRetirada`,`vencimento`,`dataEntrega`,`idPolicial`,`idDespachante`,`idRecebedor`) VALUES
(1, 1, 1, '2018/10/22', '2020/01/01', '', '', 1,2,3);
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
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`id`, `serial`, `modelo`, `estoque`, `estoque_danificado`, `situacao`, `validade`, `observacoes`, `id_subunidade`, `id_tipo_item`, `id_fabricante`) VALUES
(1, 'SWI04814', 'PT 100 AF', 1, 0, 'Operacional', NULL, NULL, 1, 1, 1);

--
-- Extraindo dados da tabela `operador`
--

INSERT INTO `operador` (`id`, `nome`, `graduacao`, `nome_funcional`, `matricula`, `email`, `senha`, `ativo`, `tipo`) VALUES
(1, 'Vanderson Fábio de Araújo', 'sd', 'vanderson', '205.020-0', 'vanderson.fabio@gmail.com', '11111', 1, 'admin');

--
-- Extraindo dados da tabela `policial`
--

INSERT INTO `policial` (`id`, `nome`, `graduacao`, `nome_funcional`, `matricula`, `email`, `situacao`, `id_subunidade`) VALUES
(1, 'Vanderson Fábio de Araújo', 'sd', 'vanderson', '205.020-0', 'vanderson.fabio@gmail.com', 'Apto', 1);

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
-- Extraindo dados da tabela `tipo_item`
--

INSERT INTO `tipo_item` (`id`, `descricao`) VALUES
(1, 'Pistola');

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
