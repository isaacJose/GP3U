--
-- Indexes for table `fabricante`
--
ALTER TABLE `fabricante`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial` (`serial`),
  ADD KEY `fk_item_subunidade` (`id_subunidade`),
  ADD KEY `fk_item_tipo` (`id_tipo_item`),
  ADD KEY `fk_item_fabricante` (`id_fabricante`);

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
-- AUTO_INCREMENT for table `fabricante`
--
ALTER TABLE `fabricante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `operador`
--
ALTER TABLE `operador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `policial`
--
ALTER TABLE `policial`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subunidade`
--
ALTER TABLE `subunidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tipo_item`
--
ALTER TABLE `tipo_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `fk_item_fabricante` FOREIGN KEY (`id_fabricante`) REFERENCES `fabricante` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_item_subunidade` FOREIGN KEY (`id_subunidade`) REFERENCES `subunidade` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_item_tipo` FOREIGN KEY (`id_tipo_item`) REFERENCES `tipo_item` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `policial`
--
ALTER TABLE `policial`
  ADD CONSTRAINT `fk_pm_subunidade` FOREIGN KEY (`id_subunidade`) REFERENCES `subunidade` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `subunidade`
--
ALTER TABLE `subunidade`
  ADD CONSTRAINT `fk_unid_superior` FOREIGN KEY (`id_unid_superior`) REFERENCES `unidade` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;