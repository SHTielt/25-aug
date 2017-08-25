USE `sociaalhuis`;
DROP TABLE IF EXISTS `sh_fotos`;
CREATE TABLE `sh_fotos` (
  `fID` int(11) NOT NULL AUTO_INCREMENT,
  `fNaam` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vrID` int(11) NULL,
  `verID` int(11) NULL,
  CONSTRAINT PRIMARY KEY (`fID`),
  CONSTRAINT `fkc_fotos_vrijwilligers` FOREIGN KEY (`vrID`) REFERENCES `sh_vrijwilligers` (`vrID`) ON DELETE CASCADE ON UPDATE CASCADE ,
  CONSTRAINT `fkc_fotos_verenigingen` FOREIGN KEY (`verID`) REFERENCES `sh_verenigingen` (`verID`) ON DELETE CASCADE ON UPDATE CASCADE
 ) engine=innoDB;

 /*als een vrijwilliger verwijderd wordt, wordt ook zijn foto verwijderd.*/
 /*idem voor vereniging*/