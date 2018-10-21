-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Set-2018 às 19:11
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.7

--
-- Database: `sigep`
--

CREATE DATABASE sigep;
USE sigep;

--
-- SETS ON DATABASE
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fabricante`
--

CREATE TABLE `fabricante` (
  `id` int(11) NOT NULL,
  `descricao` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_item`
--

CREATE TABLE `tipo_item` (
  `id` int(11) NOT NULL,
  `descricao` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
