SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET @@time_zone = `+03:00`;

CREATE TABLE IF NOT EXISTS `dimensoes` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `dimensao` varchar(255) DEFAULT NULL    
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `perguntas` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `pergunta` varchar(255) DEFAULT NULL,    
    `dimensao` varchar(255) DEFAULT NULL,    
    `status`  BOOLEAN NULL DEFAULT 1   
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
