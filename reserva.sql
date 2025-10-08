-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/10/2025 às 14:14
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projetogoat`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `data_reserva` date NOT NULL,
  `horario` time NOT NULL,
  `quantidade_pessoas` int(11) NOT NULL,
  `preferencia` enum('almoco','jantar') NOT NULL,
  `restricao` enum('sim','nao') NOT NULL,
  `comentario` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `data_reserva`, `horario`, `quantidade_pessoas`, `preferencia`, `restricao`, `comentario`) VALUES
(118, '2025-09-11', '00:00:00', 3, 'almoco', 'sim', 'LLLLLLLLLL'),
(123, '2025-09-11', '12:30:00', 2, 'almoco', 'sim', 'YYYYYYYYYY'),
(127, '2025-09-11', '00:00:00', 5, 'almoco', 'nao', 'KKKKKKKK'),
(130, '2025-09-12', '12:30:00', 2, 'almoco', 'sim', 'NNNNNNNNNNNNNNNNNNNNN'),
(131, '2025-09-12', '13:00:00', 2, 'almoco', 'nao', ',,,,,,,,,,,,,,,,,,'),
(132, '2025-09-12', '13:00:00', 2, '', 'nao', 'KKKKKKKKKKKKKKKKKKKKKKKKKKK'),
(133, '2025-09-12', '12:30:00', 2, 'jantar', 'nao', 'GGGGFFFFFFFFFFFFF');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
