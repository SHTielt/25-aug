USE `sociaalhuis`;
DROP TABLE IF EXISTS `sh_contactpersonen`;
CREATE TABLE `sh_contactpersonen` (
  `contID` int(11) NOT NULL AUTO_INCREMENT,
  `contVoornaam` varchar(255) CHARACTER SET utf8 NOT NULL,
  `contNaam` varchar(255) CHARACTER SET utf8 NOT NULL,
  `contInfo` varchar(255) CHARACTER SET utf8 NULL,
  `contEmail` varchar(255) CHARACTER SET utf8 NULL,
  `contGSM` varchar(255) CHARACTER SET utf8 NULL,
  `contTelefoon` varchar(255) CHARACTER SET utf8 NULL,
  `cvID` int(11) NULL,
  `verID` int(11) NOT NULL, 
  PRIMARY KEY (`contId`),
  CONSTRAINT `fkc_contactpersonen_contactvoorkeuren` FOREIGN KEY (`cvID`) REFERENCES `sh_contactvoorkeuren` (`cvID`) ON UPDATE CASCADE,
  CONSTRAINT `fkc_contactpersonen_verenigingen` FOREIGN KEY (`verID`) REFERENCES `sh_verenigingen` (`verID`) ON DELETE CASCADE ON UPDATE CASCADE
 ) engine=innoDB;


