-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07-Maio-2025 às 20:37
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bdimovel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
`id_cliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_cadastro` datetime DEFAULT CURRENT_TIMESTAMP,
  `ativo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `sobrenome`, `cpf`, `telefone`, `email`, `senha`, `data_cadastro`, `ativo`) VALUES
(1, 'Paulo', 'Pinto', '03032525023', '55999536412', 'PPP@email.com', '123', '2025-05-07 08:49:43', 1),
(3, 'Lucas', 'Martins', '04780567025', '55', 'lucasmartins@email.com', '123', '2025-05-07 15:30:54', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
`id_funcionario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `creci` varchar(20) NOT NULL,
  `data_cadastro` datetime DEFAULT CURRENT_TIMESTAMP,
  `ativo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id_funcionario`, `nome`, `sobrenome`, `cpf`, `email`, `senha`, `creci`, `data_cadastro`, `ativo`) VALUES
(1, 'JoÃ£o', 'Ugulini', '03032541069', 'joao@email.com', '123', '32145', '2025-05-07 08:49:17', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `imovel`
--

CREATE TABLE IF NOT EXISTS `imovel` (
`id` int(11) NOT NULL,
  `id_proprietario` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `tipo` enum('Casa','Apartamento','Terreno','Comercial','Outro') NOT NULL,
  `finalidade` enum('Venda','Aluguel') NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `medida_frente` decimal(10,2) DEFAULT NULL,
  `medida_lateral` decimal(10,2) DEFAULT NULL,
  `quartos` int(11) DEFAULT NULL,
  `banheiros` int(11) DEFAULT NULL,
  `vagas_garagem` int(11) DEFAULT NULL,
  `endereco` varchar(200) NOT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` char(2) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `imovel`
--

INSERT INTO `imovel` (`id`, `id_proprietario`, `titulo`, `tipo`, `finalidade`, `valor`, `medida_frente`, `medida_lateral`, `quartos`, `banheiros`, `vagas_garagem`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `ativo`, `path`) VALUES
(2, 1, 'Casa Brasileira', 'Casa', 'Venda', '1350000.00', '35.00', '50.00', 4, 2, 2, 'Rua 7 DE SETEMBRO', '491', 'Casa', 'STO. ANTONIO', 'Jaguari/RS', 'RS', 1, '../imgImovel/681b556e1be72.jpg'),
(3, 1, 'MansÃ£o padrÃ£o', 'Casa', 'Venda', '5500000.00', '150.00', '50.00', 4, 2, 4, 'RUA DAS FLORES', '2375', '', 'KUWAIT', 'ROSARIO DO SUL', 'RS', 1, '../imgImovel/681b55e3a8c22.jpg'),
(6, 1, 'Terreno para cria de gado', 'Terreno', 'Venda', '750000.00', '1000.00', '500.00', 0, 0, 0, 'R EVERALDO M. SILVA', '1', '', 'STO. ANTONIO', 'RosÃ¡rio do Sul', 'RS', 1, '../imgImovel/681b578b1c196.jfif');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE IF NOT EXISTS `venda` (
`id` int(11) NOT NULL,
  `id_imovel` int(11) NOT NULL,
  `id_cliente_vendedor` int(11) NOT NULL,
  `id_cliente_comprador` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `data_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
 ADD PRIMARY KEY (`id_cliente`), ADD UNIQUE KEY `cpf` (`cpf`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
 ADD PRIMARY KEY (`id_funcionario`), ADD UNIQUE KEY `cpf` (`cpf`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `creci` (`creci`);

--
-- Indexes for table `imovel`
--
ALTER TABLE `imovel`
 ADD PRIMARY KEY (`id`), ADD KEY `id_proprietario` (`id_proprietario`);

--
-- Indexes for table `venda`
--
ALTER TABLE `venda`
 ADD PRIMARY KEY (`id`), ADD KEY `id_imovel` (`id_imovel`), ADD KEY `id_cliente_vendedor` (`id_cliente_vendedor`), ADD KEY `id_cliente_comprador` (`id_cliente_comprador`), ADD KEY `idx_data_venda` (`data_venda`), ADD KEY `idx_funcionario_data` (`id_funcionario`,`data_venda`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `imovel`
--
ALTER TABLE `imovel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `venda`
--
ALTER TABLE `venda`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `imovel`
--
ALTER TABLE `imovel`
ADD CONSTRAINT `imovel_ibfk_1` FOREIGN KEY (`id_proprietario`) REFERENCES `cliente` (`id_cliente`);

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`id_imovel`) REFERENCES `imovel` (`id`),
ADD CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`id_cliente_vendedor`) REFERENCES `cliente` (`id_cliente`),
ADD CONSTRAINT `venda_ibfk_3` FOREIGN KEY (`id_cliente_comprador`) REFERENCES `cliente` (`id_cliente`),
ADD CONSTRAINT `venda_ibfk_4` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
