USE `sociaalhuis`;
DROP TABLE IF EXISTS `sh_vrijwilligers`;
CREATE TABLE `sh_vrijwilligers` (
  `vrID` int(11) NOT NULL AUTO_INCREMENT,
  `vrVoornaam` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vrNaam` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vrAdres` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vrPostCode` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vrGemeente` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vrGeboorteDatum` date NOT NULL,
  `vrTelefoon` varchar(255) CHARACTER SET utf8 NULL,
  `vrGSM` varchar(255) CHARACTER SET utf8 NULL,
  `vrEmail` varchar(255) CHARACTER SET utf8 NULL,
  `vrInfo` varchar(255) CHARACTER SET utf8 NULL,
  `vrComment` varchar(255) CHARACTER SET utf8 NULL,
  `vrActief` TINYINT(1),
  `sID` int(11) NULL,
  `cvID` int(11) NULL,
  `vrWPUserID` int(11) NOT NULL,
  
  PRIMARY KEY (`vrId`),
  UNIQUE KEY `uc_vrWPUserID` (`vrWPUserID`),
  CONSTRAINT `fkc_vrijwilligers_statussen` FOREIGN KEY (`sID`) REFERENCES `sh_statussen` (`sID`) ON UPDATE CASCADE,
  CONSTRAINT `fkc_vrijwilligers_contactvoorkeuren` FOREIGN KEY (`cvID`) REFERENCES `sh_contactvoorkeuren` (`cvID`) ON UPDATE CASCADE,

 ) engine=innoDB;

/*BOOL type wordt in mySQL omgezet in TINYINT(1)*/
