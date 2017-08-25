USE `sociaalhuis`;
DROP TABLE IF EXISTS `sh_verenigingsectoren`;
CREATE TABLE `sh_verenigingsectoren` (
  `versecID` INT(11) NOT NULL AUTO_INCREMENT,
  `verID` INT(11) NOT NULL,
  `secID` INT(11) NOT NULL,
  PRIMARY KEY (`versecID`),
  CONSTRAINT `fkc_verenigingsectoren_verenigingen` FOREIGN KEY (`verID`) REFERENCES `sh_verenigingen` (`verID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkc_verenigingsectoren_sectoren` FOREIGN KEY (`secID`) REFERENCES `sh_sectoren` (`secID`) ON DELETE CASCADE ON UPDATE CASCADE
) engine=innoDB;