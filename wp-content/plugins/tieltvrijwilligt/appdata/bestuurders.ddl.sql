USE `sociaalhuis`;
DROP TABLE IF EXISTS `sh_bestuurders`;
CREATE TABLE `sh_bestuurders` (
  `bestID` int(11) NOT NULL AUTO_INCREMENT,
  `bestVoornaam` varchar(255) CHARACTER SET utf8 NOT NULL,
  `bestNaam` varchar(255) CHARACTER SET utf8 NOT NULL,
  `bestInfo` varchar(255) CHARACTER SET utf8 NULL,
  `bestEmail` varchar(255) CHARACTER SET utf8 NULL,
  `bestGSM` varchar(255) CHARACTER SET utf8 NULL,
  `bestTelefoon` varchar(255) CHARACTER SET utf8 NULL,
  `cvID` int(11) NULL,
  `funcID` int(11) NULL,
  `verID` int(11) NOT NULL, 
  PRIMARY KEY (`bestId`),
  CONSTRAINT `fkc_bestuurders_functies` FOREIGN KEY (`funcID`) REFERENCES `sh_functies` (`funcID`) ON UPDATE CASCADE,
  CONSTRAINT `fkc_bestuurders_contactvoorkeuren` FOREIGN KEY (`cvID`) REFERENCES `sh_contactvoorkeuren` (`cvID`) ON UPDATE CASCADE,
  CONSTRAINT `fkc_bestuurders_verenigingen` FOREIGN KEY (`verID`) REFERENCES `sh_verenigingen` (`verID`) ON DELETE CASCADE ON UPDATE CASCADE
 ) engine=innoDB;


