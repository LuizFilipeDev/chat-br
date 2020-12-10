-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Tempo de geração: 23-Mar-2020 às 13:45
-- Versão do servidor: 8.0.18
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `chat`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `conversas`
--

DROP TABLE IF EXISTS `conversas`;
CREATE TABLE IF NOT EXISTS `conversas` (
  `id_conversa` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_conversa` int(11) NOT NULL,
  `nome_usuario_conversa` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario_iniciou_conversa` int(11) NOT NULL,
  `nome_usuario_iniciou_conversa` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario_excluiu_primeiro` int(11) NOT NULL,
  PRIMARY KEY (`id_conversa`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `conversas`
--

INSERT INTO `conversas` (`id_conversa`, `id_usuario_conversa`, `nome_usuario_conversa`, `id_usuario_iniciou_conversa`, `nome_usuario_iniciou_conversa`, `id_usuario_excluiu_primeiro`) VALUES
(68, 70, ' Geraldo', 69, 'Itamara', 69),
(66, 68, ' Luiz Filipe', 69, 'Itamara', 0),
(67, 71, ' Patricia', 69, 'Itamara', 69),
(69, 74, ' Douglas', 68, 'Luiz Filipe', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--

DROP TABLE IF EXISTS `mensagens`;
CREATE TABLE IF NOT EXISTS `mensagens` (
  `id_mensagens` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_mensagens` int(11) NOT NULL,
  `nome_usuario_mensagens` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario_destino_mensagens` int(11) NOT NULL,
  `nome_usuario_destino_mensagens` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mensagem_usuario_mensagens` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_conversa_mensagens` int(11) NOT NULL,
  `id_usuario_excluiu_primeiro` int(11) NOT NULL,
  `data_mensagem` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_mensagens`)
) ENGINE=MyISAM AUTO_INCREMENT=653 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `mensagens`
--

INSERT INTO `mensagens` (`id_mensagens`, `id_usuario_mensagens`, `nome_usuario_mensagens`, `id_usuario_destino_mensagens`, `nome_usuario_destino_mensagens`, `mensagem_usuario_mensagens`, `id_conversa_mensagens`, `id_usuario_excluiu_primeiro`, `data_mensagem`) VALUES
(629, 69, 'Itamara', 70, 'Geraldo', 'sdfsdf', 68, 69, '2020-03-20 13:20'),
(628, 69, 'Itamara', 68, 'Luiz Filipe', 'asdasd', 66, 69, '2020-03-20 13:20'),
(652, 68, 'Luiz Filipe', 74, 'Douglas', 'ola douglas', 69, 0, '2020-03-23 10:45'),
(651, 68, 'Luiz Filipe', 69, 'Itamara', 'espero que bem ?', 66, 0, '2020-03-23 10:45'),
(650, 68, 'Luiz Filipe', 69, 'Itamara', 'como vc esta ?', 66, 0, '2020-03-23 10:45'),
(649, 68, 'Luiz Filipe', 69, 'Itamara', 'tudo bem ?', 66, 0, '2020-03-23 10:44'),
(648, 68, 'Luiz Filipe', 69, 'Itamara', 'ola itamara', 66, 0, '2020-03-23 10:44'),
(647, 68, 'Luiz Filipe', 69, 'Itamara', 'werwer', 66, 0, '2020-03-20 15:52'),
(646, 68, 'Luiz Filipe', 69, 'Itamara', 'werwer', 66, 0, '2020-03-20 15:52'),
(645, 68, 'Luiz Filipe', 69, 'Itamara', 'werwer', 66, 0, '2020-03-20 15:52'),
(644, 68, 'Luiz Filipe', 69, 'Itamara', 'wertwer', 66, 0, '2020-03-20 15:52'),
(643, 68, 'Luiz Filipe', 69, 'Itamara', 'asdasd', 66, 0, '2020-03-20 15:50'),
(642, 68, 'Luiz Filipe', 69, 'Itamara', 'asdasd', 66, 0, '2020-03-20 15:50'),
(641, 68, 'Luiz Filipe', 69, 'Itamara', 'adsfsdaf', 66, 0, '2020-03-20 15:31'),
(640, 69, 'Itamara', 68, 'Luiz Filipe', 'asdasd', 66, 69, '2020-03-20 13:25'),
(639, 69, 'Itamara', 70, 'Geraldo', 'asdasd', 68, 69, '2020-03-20 13:25'),
(638, 69, 'Itamara', 68, 'Luiz Filipe', 'asdasd', 66, 69, '2020-03-20 13:23'),
(637, 69, 'Itamara', 71, 'Patricia', 'asdasd', 67, 69, '2020-03-20 13:23'),
(636, 69, 'Itamara', 68, 'Luiz Filipe', 'asdasd', 66, 69, '2020-03-20 13:23'),
(635, 69, 'Itamara', 70, 'Geraldo', 'ASDASD', 68, 69, '2020-03-20 13:23'),
(634, 69, 'Itamara', 68, 'Luiz Filipe', 'sdasd', 66, 69, '2020-03-20 13:22'),
(632, 69, 'Itamara', 71, 'Patricia', 'asdasd', 67, 69, '2020-03-20 13:21'),
(631, 69, 'Itamara', 70, 'Geraldo', 'asdasd', 68, 69, '2020-03-20 13:21'),
(630, 69, 'Itamara', 70, 'Geraldo', 'sdfsdf', 68, 69, '2020-03-20 13:20'),
(633, 69, 'Itamara', 68, 'Luiz Filipe', 'asdasd', 66, 69, '2020-03-20 13:22'),
(627, 69, 'Itamara', 68, 'Luiz Filipe', 'dasdasdas', 66, 69, '2020-03-20 13:20'),
(626, 69, 'Itamara', 71, 'Patricia', 'sdasd', 67, 69, '2020-03-20 13:19'),
(625, 69, 'Itamara', 71, 'Patricia', 'asdasd', 67, 69, '2020-03-20 13:19'),
(624, 69, 'Itamara', 68, 'Luiz Filipe', 'sdasd', 66, 69, '2020-03-20 13:18'),
(623, 69, 'Itamara', 68, 'Luiz Filipe', 'asdasd', 66, 69, '2020-03-20 13:18'),
(622, 69, 'Itamara', 70, 'Geraldo', 'sdasda', 68, 69, '2020-03-20 13:18'),
(612, 69, 'Itamara', 71, 'Patricia', 'asdasd', 67, 69, '2020-03-20 13:14'),
(621, 69, 'Itamara', 70, 'Geraldo', 'asdasd', 68, 69, '2020-03-20 13:18'),
(620, 69, 'Itamara', 71, 'Patricia', 'asdasd', 67, 69, '2020-03-20 13:16'),
(619, 69, 'Itamara', 70, 'Geraldo', 'asdasd', 68, 69, '2020-03-20 13:16'),
(618, 69, 'Itamara', 68, 'Luiz Filipe', 'asdasd', 66, 69, '2020-03-20 13:16'),
(617, 69, 'Itamara', 68, 'Luiz Filipe', 'asdasd', 66, 69, '2020-03-20 13:14'),
(616, 69, 'Itamara', 68, 'Luiz Filipe', 'asdasd', 66, 69, '2020-03-20 13:14'),
(615, 69, 'Itamara', 70, 'Geraldo', 'asdasdasd', 68, 69, '2020-03-20 13:14'),
(614, 69, 'Itamara', 70, 'Geraldo', 'asdasd', 68, 69, '2020-03-20 13:14'),
(613, 69, 'Itamara', 71, 'Patricia', 'asdasd', 67, 69, '2020-03-20 13:14'),
(610, 69, 'Itamara', 68, 'Luiz Filipe', 'asdasd', 66, 69, '2020-03-20 13:12'),
(611, 69, 'Itamara', 71, 'Patricia', 'asdasd', 67, 69, '2020-03-20 13:13'),
(609, 69, 'Itamara', 68, 'Luiz Filipe', 'asdasd', 66, 69, '2020-03-20 13:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telefone_usuario` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `senha_usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status_online` int(1) NOT NULL,
  `data_cadastro` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `telefone_usuario`, `senha_usuario`, `status_online`, `data_cadastro`) VALUES
(74, 'Douglas', '35996321478', '68053af2923e00204c3ca7c6a3150cf7', 0, '2020-03-23 10:32'),
(73, 'Afonso', '35998458569', '68053af2923e00204c3ca7c6a3150cf7', 0, '2020-03-23 10:13'),
(72, 'Jose Paulo', '35999950044', '68053af2923e00204c3ca7c6a3150cf7', 0, '2020-03-23 10:01'),
(71, 'Patricia', '35965896589', 'e034fb6b66aacc1d48f445ddfb08da98', 0, '2020-03-20 12:45'),
(70, 'Geraldo', '35998458745', '68053af2923e00204c3ca7c6a3150cf7', 0, '2020-03-20 12:44'),
(69, 'Itamara', '35998549568', '68053af2923e00204c3ca7c6a3150cf7', 0, '2020-03-18 22:43'),
(68, 'Luiz Filipe', '35998436654', '68053af2923e00204c3ca7c6a3150cf7', 0, '2020-03-18 21:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_bloqueados`
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
