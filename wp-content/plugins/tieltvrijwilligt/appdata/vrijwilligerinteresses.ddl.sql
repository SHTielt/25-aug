USE `sociaalhuis`;
DROP TABLE IF EXISTS `sh_vrijwilligerinteresses`;
CREATE TABLE `sh_vrijwilligerinteresses` (
  `vrintID` INT(11) NOT NULL AUTO_INCREMENT,
  `intID` INT(11) NOT NULL,
  `vrID` INT(11) NOT NULL,
  `vrintInfo` varchar(255) CHARACTER SET utf8 NULL,
  PRIMARY KEY (`vrintID`),
  CONSTRAINT `fkc_vrijwilligerinteresses_vrijwilligers` FOREIGN KEY (`vrID`) REFERENCES `sh_vrijwilligers` (`vrID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkc_vrijwilligerinteresses_interesses` FOREIGN KEY (`intID`) REFERENCES `sh_interesses` (`intID`) ON DELETE CASCADE ON UPDATE CASCADE
) engine=innoDB;

    