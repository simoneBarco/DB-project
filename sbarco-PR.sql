-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: 24 ago, 2015 at 09:23 AM
-- Versione MySQL: 5.1.73
-- Versione PHP: 5.3.2-1ubuntu4.30

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sbarco-PR`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Agente`
--

DROP TABLE IF EXISTS `Agente`;
CREATE TABLE IF NOT EXISTS `Agente` (
  `CFDip` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  KEY `CFDip` (`CFDip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Agente`
--

INSERT INTO `Agente` (`CFDip`) VALUES
('BLDGNN65L23E625U'),
('DGILMN70A01A479Z');

-- --------------------------------------------------------

--
-- Struttura della tabella `Agenzia`
--

DROP TABLE IF EXISTS `Agenzia`;
CREATE TABLE IF NOT EXISTS `Agenzia` (
  `Codice` int(4) NOT NULL AUTO_INCREMENT,
  `CittaSede` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ProvinciaSede` char(2) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `AgenteGenerale` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`Codice`),
  KEY `AgenteGenerale` (`AgenteGenerale`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dump dei dati per la tabella `Agenzia`
--

INSERT INTO `Agenzia` (`Codice`, `CittaSede`, `ProvinciaSede`, `AgenteGenerale`) VALUES
(11, 'Castelfranco V.to', 'TV', 'DGILMN70A01A479Z'),
(12, 'Thiene', 'VI', 'BLDGNN65L23E625U');

-- --------------------------------------------------------

--
-- Struttura della tabella `Casa`
--

DROP TABLE IF EXISTS `Casa`;
CREATE TABLE IF NOT EXISTS `Casa` (
  `Codice` int(4) NOT NULL AUTO_INCREMENT,
  `Durata` int(3) NOT NULL,
  `PrezzoAnnuo` int(5) NOT NULL,
  `AnnoCostruzione` int(4) NOT NULL,
  `AnnoRistrutturazione` int(4) NOT NULL,
  `SpeseLegali` int(5) NOT NULL,
  `Tipo` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`Codice`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `Casa`
--

INSERT INTO `Casa` (`Codice`, `Durata`, `PrezzoAnnuo`, `AnnoCostruzione`, `AnnoRistrutturazione`, `SpeseLegali`, `Tipo`) VALUES
(1, 180, 500, 1980, 2000, 6000, 'Incendio'),
(2, 180, 800, 1980, 2010, 7000, 'Furto'),
(5, 180, 500, 1993, 2009, 8000, 'Furto');

-- --------------------------------------------------------

--
-- Struttura della tabella `Cliente`
--

DROP TABLE IF EXISTS `Cliente`;
CREATE TABLE IF NOT EXISTS `Cliente` (
  `CodiceFiscale` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Password` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Nome` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Cognome` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `DataNascita` date NOT NULL,
  `CittaResidenza` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ProvinciaResidenza` char(2) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `DataPatente` date NOT NULL,
  `AnniPatente` int(2) NOT NULL,
  `ClasseDiMerito` int(2) NOT NULL DEFAULT '14',
  PRIMARY KEY (`CodiceFiscale`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Cliente`
--

INSERT INTO `Cliente` (`CodiceFiscale`, `Password`, `Nome`, `Cognome`, `DataNascita`, `CittaResidenza`, `ProvinciaResidenza`, `DataPatente`, `AnniPatente`, `ClasseDiMerito`) VALUES
('BRCSMN93C23C111I', '00', 'Simone', 'Barco', '1993-03-23', 'Loreggia', 'PD', '2011-06-11', 4, 12),
('CCCPTC80B43H612X', '', 'Pasticcia', 'Ciccia', '1980-02-03', 'Rovereto', 'TN', '2000-05-16', 15, 14),
('PRLDNL79P54G315Y', '02', 'Daniela', 'Pirolo', '1970-09-14', 'Pantelleria', 'TP', '1990-04-27', 25, 14),
('RSSPLA70A01C111A', '0', 'Paolo', 'Rossi', '1970-01-01', 'Castelfranco V.to', 'TV', '1990-03-11', 25, 14);

-- --------------------------------------------------------

--
-- Struttura della tabella `Dipendente`
--

DROP TABLE IF EXISTS `Dipendente`;
CREATE TABLE IF NOT EXISTS `Dipendente` (
  `CodiceFiscale` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Password` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Nome` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Cognome` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Provvigione` int(5) DEFAULT NULL,
  `Agenzia` int(4) NOT NULL,
  PRIMARY KEY (`CodiceFiscale`),
  KEY `Agenzia` (`Agenzia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Dipendente`
--

INSERT INTO `Dipendente` (`CodiceFiscale`, `Password`, `Nome`, `Cognome`, `Provvigione`, `Agenzia`) VALUES
('BLDGNN65L23E625U', '12', 'Baldo', 'Giovanni', 100, 12),
('BNCLVR83M14A462W', '1234', 'Oliver', 'Bianchi', 70, 12),
('BNDGLC82C05L157A', '12', 'Benedetto', 'Gianluca', 30, 12),
('DGILMN70A01A479Z', '12', 'Limone', 'Diego', 100, 11),
('FRRDNL65P58F205M', '1235', 'Daniela', 'Ferrari', 70, 12),
('MNGVNI77E10C111D', '11', 'Meneghini', 'Ivano', 70, 11),
('MRLMHL90D15A346R', '123', 'Michele', 'Marullo', 30, 11),
('PRVGNN87M49D458S', '24', 'Giovanna', 'Prova', 30, 12),
('PRVLCU73C17D845S', '23', 'Luca', 'Prova', 70, 12),
('SCMNHL73E17A390H', '21', 'Nicholas', 'Scambroglio', 30, 11),
('SLVLRM92R23B563B', '21', 'Luigi Remo', 'Salvadego', 70, 11);

-- --------------------------------------------------------

--
-- Struttura della tabella `Polizza`
--

DROP TABLE IF EXISTS `Polizza`;
CREATE TABLE IF NOT EXISTS `Polizza` (
  `Numero` int(5) NOT NULL AUTO_INCREMENT,
  `Massimale` int(7) NOT NULL,
  `DataStipula` date NOT NULL DEFAULT '1970-01-01',
  `DataScadenza` date NOT NULL DEFAULT '1971-01-01',
  `CFCliente` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `CodCasa` int(4) DEFAULT NULL,
  `CodRC` int(4) DEFAULT NULL,
  `CFDipendente` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`Numero`),
  KEY `CFCliente` (`CFCliente`),
  KEY `CFDipendente` (`CFDipendente`),
  KEY `CodCasa` (`CodCasa`),
  KEY `CodRC` (`CodRC`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dump dei dati per la tabella `Polizza`
--

INSERT INTO `Polizza` (`Numero`, `Massimale`, `DataStipula`, `DataScadenza`, `CFCliente`, `CodCasa`, `CodRC`, `CFDipendente`) VALUES
(1, 6000, '2015-08-22', '2016-08-22', 'BRCSMN93C23C111I', NULL, 3, 'MNGVNI77E10C111D'),
(4, 10000, '2015-08-19', '2016-08-19', 'BRCSMN93C23C111I', 2, NULL, 'DGILMN70A01A479Z'),
(5, 8000, '2015-08-20', '2016-08-20', 'RSSPLA70A01C111A', NULL, 5, 'DGILMN70A01A479Z'),
(8, 9000, '2015-04-20', '2016-04-20', 'RSSPLA70A01C111A', 5, NULL, 'MRLMHL90D15A346R'),
(10, 8000, '2014-09-12', '2015-09-12', 'CCCPTC80B43H612X', NULL, 6, 'MNGVNI77E10C111D'),
(11, 6000, '2016-08-22', '2017-08-22', 'PRLDNL79P54G315Y', NULL, 3, 'DGILMN70A01A479Z');

-- --------------------------------------------------------

--
-- Struttura della tabella `Portafoglio`
--

DROP TABLE IF EXISTS `Portafoglio`;
CREATE TABLE IF NOT EXISTS `Portafoglio` (
  `NPolizza` int(5) NOT NULL,
  `CFDip` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Importo` int(5) DEFAULT NULL,
  KEY `NPolizza` (`NPolizza`),
  KEY `CFDip` (`CFDip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Portafoglio`
--

INSERT INTO `Portafoglio` (`NPolizza`, `CFDip`, `Importo`) VALUES
(1, 'MNGVNI77E10C111D', 210),
(4, 'DGILMN70A01A479Z', 800),
(5, 'DGILMN70A01A479Z', 300),
(8, 'MRLMHL90D15A346R', 150),
(10, 'MNGVNI77E10C111D', 175),
(11, 'DGILMN70A01A479Z', 300);

-- --------------------------------------------------------

--
-- Struttura Stand-in per le viste `PortafoglioAgenzie`
--
DROP VIEW IF EXISTS `PortafoglioAgenzie`;
CREATE TABLE IF NOT EXISTS `PortafoglioAgenzie` (
`NPolizza` int(5)
,`CFDip` varchar(16)
,`Nome` varchar(30)
,`Cognome` varchar(30)
,`Importo` int(5)
,`Agenzia` int(4)
);
-- --------------------------------------------------------

--
-- Struttura della tabella `Produttore`
--

DROP TABLE IF EXISTS `Produttore`;
CREATE TABLE IF NOT EXISTS `Produttore` (
  `CFDip` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `DurataContratto` int(3) NOT NULL,
  KEY `CFDip` (`CFDip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Produttore`
--

INSERT INTO `Produttore` (`CFDip`, `DurataContratto`) VALUES
('BNDGLC82C05L157A', 5),
('MRLMHL90D15A346R', 7),
('PRVGNN87M49D458S', 2),
('SCMNHL73E17A390H', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `RCAuto`
--

DROP TABLE IF EXISTS `RCAuto`;
CREATE TABLE IF NOT EXISTS `RCAuto` (
  `Codice` int(4) NOT NULL AUTO_INCREMENT,
  `Durata` int(3) NOT NULL,
  `PrezzoAnnuo` int(5) NOT NULL,
  `Potenza` int(4) NOT NULL,
  `Cilindrata` int(5) NOT NULL,
  PRIMARY KEY (`Codice`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `RCAuto`
--

INSERT INTO `RCAuto` (`Codice`, `Durata`, `PrezzoAnnuo`, `Potenza`, `Cilindrata`) VALUES
(3, 12, 300, 55, 1400),
(5, 12, 300, 100, 2000),
(6, 12, 250, 70, 1600),
(7, 12, 250, 55, 1400);

-- --------------------------------------------------------

--
-- Struttura della tabella `SubAgente`
--

DROP TABLE IF EXISTS `SubAgente`;
CREATE TABLE IF NOT EXISTS `SubAgente` (
  `CFDip` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `SedeUfficio` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  KEY `CFDip` (`CFDip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `SubAgente`
--

INSERT INTO `SubAgente` (`CFDip`, `SedeUfficio`) VALUES
('MNGVNI77E10C111D', 'Camposampiero'),
('BNCLVR83M14A462W', 'Caldogno'),
('FRRDNL65P58F205M', 'Schio'),
('PRVLCU73C17D845S', 'Camposampiero'),
('SLVLRM92R23B563B', 'Camposampiero');

-- --------------------------------------------------------

--
-- Struttura Stand-in per le viste `TotEntrate`
--
DROP VIEW IF EXISTS `TotEntrate`;
CREATE TABLE IF NOT EXISTS `TotEntrate` (
`Nome` varchar(30)
,`Cognome` varchar(30)
,`TotaleEntrate` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Struttura per la vista `PortafoglioAgenzie`
--
DROP TABLE IF EXISTS `PortafoglioAgenzie`;

CREATE ALGORITHM=UNDEFINED DEFINER=`sbarco`@`localhost` SQL SECURITY DEFINER VIEW `PortafoglioAgenzie` AS select `Portafoglio`.`NPolizza` AS `NPolizza`,`Portafoglio`.`CFDip` AS `CFDip`,`C`.`Nome` AS `Nome`,`C`.`Cognome` AS `Cognome`,`Portafoglio`.`Importo` AS `Importo`,`D`.`Agenzia` AS `Agenzia` from (((`Portafoglio` join `Polizza` on((`Portafoglio`.`NPolizza` = `Polizza`.`Numero`))) join `Cliente` `C` on((`Polizza`.`CFCliente` = `C`.`CodiceFiscale`))) join `Dipendente` `D` on((`Portafoglio`.`CFDip` = `D`.`CodiceFiscale`)));

-- --------------------------------------------------------

--
-- Struttura per la vista `TotEntrate`
--
DROP TABLE IF EXISTS `TotEntrate`;

CREATE ALGORITHM=UNDEFINED DEFINER=`sbarco`@`localhost` SQL SECURITY DEFINER VIEW `TotEntrate` AS select distinct `Dipendente`.`Nome` AS `Nome`,`Dipendente`.`Cognome` AS `Cognome`,sum(`Portafoglio`.`Importo`) AS `TotaleEntrate` from (`Portafoglio` join `Dipendente` on((`Portafoglio`.`CFDip` = `Dipendente`.`CodiceFiscale`))) group by `Dipendente`.`Nome` order by sum(`Portafoglio`.`Importo`) desc;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Agente`
--
ALTER TABLE `Agente`
  ADD CONSTRAINT `Agente_ibfk_1` FOREIGN KEY (`CFDip`) REFERENCES `Dipendente` (`CodiceFiscale`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Agenzia`
--
ALTER TABLE `Agenzia`
  ADD CONSTRAINT `Agenzia_ibfk_1` FOREIGN KEY (`AgenteGenerale`) REFERENCES `Agente` (`CFDip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Dipendente`
--
ALTER TABLE `Dipendente`
  ADD CONSTRAINT `Dipendente_ibfk_1` FOREIGN KEY (`Agenzia`) REFERENCES `Agenzia` (`Codice`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `Polizza`
--
ALTER TABLE `Polizza`
  ADD CONSTRAINT `Polizza_ibfk_1` FOREIGN KEY (`CFCliente`) REFERENCES `Cliente` (`CodiceFiscale`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Polizza_ibfk_2` FOREIGN KEY (`CodCasa`) REFERENCES `Casa` (`Codice`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Polizza_ibfk_3` FOREIGN KEY (`CodRC`) REFERENCES `RCAuto` (`Codice`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Polizza_ibfk_4` FOREIGN KEY (`CFDipendente`) REFERENCES `Dipendente` (`CodiceFiscale`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `Portafoglio`
--
ALTER TABLE `Portafoglio`
  ADD CONSTRAINT `Portafoglio_ibfk_2` FOREIGN KEY (`NPolizza`) REFERENCES `Polizza` (`Numero`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Portafoglio_ibfk_1` FOREIGN KEY (`CFDip`) REFERENCES `Dipendente` (`CodiceFiscale`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `Produttore`
--
ALTER TABLE `Produttore`
  ADD CONSTRAINT `Produttore_ibfk_1` FOREIGN KEY (`CFDip`) REFERENCES `Dipendente` (`CodiceFiscale`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `SubAgente`
--
ALTER TABLE `SubAgente`
  ADD CONSTRAINT `SubAgente_ibfk_1` FOREIGN KEY (`CFDip`) REFERENCES `Dipendente` (`CodiceFiscale`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Procedure
--
DROP PROCEDURE IF EXISTS `provaAgente`$$
CREATE DEFINER=`sbarco`@`localhost` PROCEDURE `provaAgente`(IN dip VARCHAR(16))
BEGIN
	DECLARE provvi INT(3);

	SET provvi=100;

	UPDATE Dipendente
	SET Provvigione=provvi
	WHERE CodiceFiscale= dip;
END$$

DROP PROCEDURE IF EXISTS `provaCasa`$$
CREATE DEFINER=`sbarco`@`localhost` PROCEDURE `provaCasa`(INOUT Npol INT(5), INOUT dip VARCHAR(16))
BEGIN
     DECLARE ImportoTemp INT(5);
     DECLARE ImportoFin INT(5);
     DECLARE ProvTemp INT(5);

     SELECT PrezzoAnnuo INTO ImportoTemp
     FROM Polizza JOIN Casa ON CodCasa=Codice
     WHERE Numero= Npol;

     SELECT Provvigione INTO ProvTemp
     FROM Dipendente
     WHERE CodiceFiscale=dip;

     SET ImportoFin=ImportoTemp*(ProvTemp/100);

     INSERT INTO Portafoglio (NPolizza, CFDip, Importo) 
          VALUES (Npol, dip, ImportoFin);
END$$

DROP PROCEDURE IF EXISTS `provaProd`$$
CREATE DEFINER=`sbarco`@`localhost` PROCEDURE `provaProd`(IN dip VARCHAR(16))
BEGIN
	DECLARE provvi INT(3);

	SET provvi=30;

	UPDATE Dipendente
	SET Provvigione=provvi
	WHERE CodiceFiscale= dip;
END$$

DROP PROCEDURE IF EXISTS `provaRC`$$
CREATE DEFINER=`sbarco`@`localhost` PROCEDURE `provaRC`(INOUT Npol INT(5), INOUT dip VARCHAR(16))
BEGIN
     DECLARE ImportoTemp INT(5);
     DECLARE ImportoFin INT(5);
     DECLARE ProvTemp INT(3);

     SELECT PrezzoAnnuo INTO ImportoTemp
     FROM Polizza JOIN RCAuto ON CodRC=Codice
     WHERE Numero= Npol;

     SELECT Provvigione INTO ProvTemp
     FROM Dipendente
     WHERE CodiceFiscale=dip;
          
     SET ImportoFin=ImportoTemp*(ProvTemp/100);

     INSERT INTO Portafoglio (NPolizza, CFDip, Importo) 
          VALUES (Npol, dip, ImportoFin);
END$$

DROP PROCEDURE IF EXISTS `provaSub`$$
CREATE DEFINER=`sbarco`@`localhost` PROCEDURE `provaSub`(IN dip VARCHAR(16))
BEGIN
	DECLARE provvi INT(3);

	SET provvi=70;

	UPDATE Dipendente
	SET Provvigione=provvi
	WHERE CodiceFiscale= dip;
END$$

DROP PROCEDURE IF EXISTS `rinnovo`$$
CREATE DEFINER=`sbarco`@`localhost` PROCEDURE `rinnovo`(IN Npol INT(5))
BEGIN
     DECLARE NDataS DATE;
     DECLARE NDataSc DATE;
     DECLARE Num INT(5);
     DECLARE cli VARCHAR(16);
     DECLARE anni INT(2);

     UPDATE Polizza SET DataStipula= CURDATE(), 
     DataScadenza= DATE_ADD(CURDATE(),INTERVAL 1 YEAR)
     WHERE Numero= Npol;

     SELECT CodRC INTO Num
     FROM Polizza
     WHERE Numero=Npol;

     IF Num IS NOT NULL THEN

          SELECT CFCLiente INTO cli
          FROM Polizza
          WHERE Numero=Npol;

          SELECT AnniPatente INTO anni
          FROM Cliente
          WHERE CodiceFiscale=cli;

          IF anni > 1 THEN
               UPDATE Cliente SET ClasseDiMerito= ClasseDiMerito-1
               WHERE CodiceFiscale=cli;
          END IF;
     END IF;

END$$

--
-- Funzioni
--
DROP FUNCTION IF EXISTS `AnniPatente`$$
CREATE DEFINER=`sbarco`@`localhost` FUNCTION `AnniPatente`(`CFClie` VARCHAR(16)) RETURNS int(2)
BEGIN
	DECLARE Anni INT;
	SELECT (YEAR(CURRENT_DATE)-YEAR(DataPatente)) INTO Anni
	FROM Cliente
	WHERE CodiceFiscale= CFClie;
	RETURN Anni;
END$$

DELIMITER ;
