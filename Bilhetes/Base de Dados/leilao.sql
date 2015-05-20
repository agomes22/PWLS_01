-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 20-Maio-2015 às 10:57
-- Versão do servidor: 5.6.14
-- versão do PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `leilao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bilhete`
--

CREATE TABLE IF NOT EXISTS `bilhete` (
  `idBilhete` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `abertura` varchar(20) NOT NULL,
  `fecho` varchar(20) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idImagem` int(11) NOT NULL,
  `precoActual` varchar(5) NOT NULL,
  `precoMinimo` varchar(5) NOT NULL,
  PRIMARY KEY (`idBilhete`),
  KEY `idCategoria` (`idCategoria`),
  KEY `idImagem` (`idImagem`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem`
--

CREATE TABLE IF NOT EXISTS `imagem` (
  `idImagem` int(11) NOT NULL AUTO_INCREMENT,
  `caminho` int(11) NOT NULL,
  PRIMARY KEY (`idImagem`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE IF NOT EXISTS `utilizador` (
  `idUtilizador` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(50) NOT NULL,
  `morada` varchar(120) NOT NULL,
  `dataNascimento` varchar(50) NOT NULL,
  `tipo` varchar(40) NOT NULL,
  PRIMARY KEY (`idUtilizador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vencedor`
--

CREATE TABLE IF NOT EXISTS `vencedor` (
  `idVencedor` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilizador` int(11) NOT NULL,
  `idBilhete` int(11) NOT NULL,
  `precoFinal` varchar(50) NOT NULL,
  PRIMARY KEY (`idVencedor`),
  KEY `idUtilizador` (`idUtilizador`),
  KEY `idBilhete` (`idBilhete`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `bilhete`
--
ALTER TABLE `bilhete`
  ADD CONSTRAINT `bilhete_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`),
  ADD CONSTRAINT `bilhete_ibfk_2` FOREIGN KEY (`idImagem`) REFERENCES `imagem` (`idImagem`),
  ADD CONSTRAINT `bilhete_ibfk_3` FOREIGN KEY (`idBilhete`) REFERENCES `vencedor` (`idBilhete`);

--
-- Limitadores para a tabela `vencedor`
--
ALTER TABLE `vencedor`
  ADD CONSTRAINT `vencedor_ibfk_1` FOREIGN KEY (`idUtilizador`) REFERENCES `utilizador` (`idUtilizador`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
