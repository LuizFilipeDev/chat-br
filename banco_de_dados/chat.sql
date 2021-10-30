-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 30, 2021 at 07:47 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversas`
--

DROP TABLE IF EXISTS `conversas`;
CREATE TABLE IF NOT EXISTS `conversas` (
  `id_conversa` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_conversa` int(11) NOT NULL,
  `nome_usuario_conversa` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario_iniciou_conversa` int(11) NOT NULL,
  `nome_usuario_iniciou_conversa` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario_excluiu_primeiro` int(11) NOT NULL,
  PRIMARY KEY (`id_conversa`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mensagens`
--

DROP TABLE IF EXISTS `mensagens`;
CREATE TABLE IF NOT EXISTS `mensagens` (
  `id_mensagens` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_mensagens` int(11) NOT NULL,
  `nome_usuario_mensagens` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario_destino_mensagens` int(11) NOT NULL,
  `nome_usuario_destino_mensagens` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mensagem_usuario_mensagens` longtext COLLATE utf8_unicode_ci NOT NULL,
  `id_conversa_mensagens` int(11) NOT NULL,
  `id_usuario_excluiu_primeiro` int(11) NOT NULL,
  `data_mensagem` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_mensagens`)
) ENGINE=MyISAM AUTO_INCREMENT=653 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefone_usuario` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `senha_usuario` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status_online` int(1) NOT NULL,
  `data_cadastro` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios_bloqueados`
--

DROP TABLE IF EXISTS `usuarios_bloqueados`;
CREATE TABLE IF NOT EXISTS `usuarios_bloqueados` (
  `id_bloqueio` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_bloqueou` int(11) NOT NULL,
  `nome_usuario_bloqueou` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario_bloqueado` int(11) NOT NULL,
  `nome_usuario_bloqueado` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_bloqueio`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
