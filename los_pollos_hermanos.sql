-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 07, 2026 at 05:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `los_pollos_hermanos`
--

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `numero_pedido_usuario` int(11) NOT NULL,
  `forma_pagamento` varchar(50) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_pedido` datetime NOT NULL DEFAULT current_timestamp(),
  `valor_entrega` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pedido_itens`
--

CREATE TABLE `pedido_itens` (
  `id_pedido` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1,
  `preco_unit` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `vlr_produto` double(10,2) NOT NULL,
  `url_foto` varchar(36) DEFAULT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`id_produto`, `nome`, `vlr_produto`, `url_foto`, `descricao`) VALUES
(1, 'Balde de frango frito', 29.90, 'balde_frango.png', 'Balde de frango com 8 pedaços de frango crocante e delicioso'),
(2, 'Churros', 25.90, 'churros.jpg', 'Porção de 32 mini churros quentinhos acompanhado de um pote de doce de leite'),
(3, 'Asinha de frango', 10.90, 'asa_frango.jpg', 'Uma porção de 8 unidades de asinhas de frango deliciosas e crocantes'),
(4, 'Batata Frita', 25.00, 'batata.png', 'Porção de batata frita crocante e deliciosa'),
(5, 'Fritas Supreme', 39.90, 'batata-supreme.jpg', 'Porção de fritas supreme com cheedar cremoso e cubos de bacon'),
(6, 'Frango Power Combo', 17.90, 'combo.png', 'Porção deliciosa de Frango Frito, Nuggets e Batata frita'),
(7, 'Tiras de Frango Frito LPH', 21.90, 'Frango-frito-crocante-estilo-KFC.jpg', 'Porção deliciosa e crocante de Frango Frito'),
(8, 'Chicken Bacon Supreme', 39.99, 'hamburguer-grango.jpg', 'Magnífico e saboroso Chicken Bacon Supreme'),
(9, 'LPH Onion Chicken', 39.90, 'lph_chicken.jpg', 'Magnífico e saboroso LPH Onion Chicken'),
(10, 'Onion Rings LPH', 25.00, 'onion_rings.jpg', 'Deliciosa porção de 12 unidades de Onion Rings'),
(11, 'Porção de Nuggets', 20.00, 'nuggets.png', 'Porção de 10 unidades de Nuggets LPH'),
(12, 'Salada Crispy LPH', 35.00, 'salada.jpg', 'Salada Crispy especial da Casa');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `token` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD PRIMARY KEY (`id_pedido`,`id_item`),
  ADD KEY `fk_pedido_itens_cardapio` (`id_item`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD CONSTRAINT `fk_pedido_itens_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
