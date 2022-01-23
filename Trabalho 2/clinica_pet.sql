-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2022 at 11:31 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinica_pet`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `email_admin` varchar(150) NOT NULL,
  `senha_admin` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_admin`, `email_admin`, `senha_admin`) VALUES
(1, 'admin@admin.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `nome_cliente` varchar(200) NOT NULL,
  `email_cliente` varchar(150) NOT NULL,
  `cpf_cliente` varchar(14) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `celular_cliente` varchar(11) NOT NULL,
  `endereco_cliente` varchar(200) NOT NULL,
  `data_cadastro_cliente` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`nome_cliente`, `email_cliente`, `cpf_cliente`, `id_cliente`, `celular_cliente`, `endereco_cliente`, `data_cadastro_cliente`) VALUES
('A', 'k@h.com', '11111111111111', 1, '11111111111', 'sdfsfbsdfgbsdfvsdfg', '2022-01-17 15:54:18'),
('TIRULIPA', 'asd@aasd.com', '11111111111111', 2, '11111111111', 'asdfasdf', '2022-01-17 21:01:26');

-- --------------------------------------------------------

--
-- Table structure for table `consultas`
--

CREATE TABLE `consultas` (
  `id_consulta` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `observacoes` varchar(200) NOT NULL,
  `data_cadastro_consulta` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `consultas`
--

INSERT INTO `consultas` (`id_consulta`, `cliente_id`, `pet_id`, `data`, `hora`, `observacoes`, `data_cadastro_consulta`) VALUES
(1, 2, 6, '2022-01-19', '15:55:00', 'bla bla bla', '2022-01-18 18:11:17'),
(2, 1, 5, '2022-01-21', '14:15:00', 'bla bla bla', '2022-01-18 18:13:21'),
(3, 2, 7, '2022-02-18', '10:37:00', 'bla bla bla', '2022-01-18 21:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `id_pet` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `nome_pet` varchar(100) NOT NULL,
  `data_cadastro_pet` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`id_pet`, `cliente_id`, `nome_pet`, `data_cadastro_pet`) VALUES
(5, 1, 'BOB', '2022-01-18 10:42:48'),
(6, 2, 'IRINEU', '2022-01-18 11:11:21'),
(7, 2, 'BOB2', '2022-01-18 11:50:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id_consulta`),
  ADD KEY `clienteHasConsultas` (`cliente_id`),
  ADD KEY `petHasConsultas` (`pet_id`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`id_pet`),
  ADD KEY `clienteHasPet` (`cliente_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `id_pet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `clienteHasConsultas` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `petHasConsultas` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`id_pet`);

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `clienteHasPet` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
