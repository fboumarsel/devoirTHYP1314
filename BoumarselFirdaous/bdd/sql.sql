CREATE DATABASE 'etunote'
CREATE TABLE `etunote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cours` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exercice` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cours` (`cours`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=304 ;

INSERT INTO `etunote` (`id`, `etu`, `cours`, `exercice`, `note`) VALUES
(2, 'Boumarsel Firdaous', 'Langage web', 'exo 2', 16),
(3, 'Moustakbale Jihane', 'Langage web', 'exo 2', 16),
(4, 'Marwa Said', 'Langage web', 'exo 2', 16),
(5, 'Billel Remki', 'Langage web', 'exo 2', 16),
(6, 'Naoufel', 'dev web', 'ex3', 19);
