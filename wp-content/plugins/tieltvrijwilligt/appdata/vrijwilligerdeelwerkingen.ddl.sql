USE `sociaalhuis`;
DROP TABLE IF EXISTS `sh_vrijwilligerdeelwerkingen`;
CREATE TABLE `sh_vrijwilligerdeelwerkingen` (
  `vrdwID` INT(11) NOT NULL AUTO_INCREMENT,
  `dwID` INT(11) NOT NULL,
  `vrID` INT(11) NOT NULL,
  `vrdwInfo` varchar(255) CHARACTER SET utf8 NULL,
  PRIMARY KEY (`vrdwID`),
  CONSTRAINT `fkc_vrijwilligerdeelwerkingen_vrijwilligers` FOREIGN KEY (`vrID`) REFERENCES `sh_vrijwilligers` (`vrID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkc_vrijwilligerdeelwerkingen_deelwerkingen` FOREIGN KEY (`dwID`) REFERENCES `sh_deelwerkingen` (`dwID`) ON DELETE CASCADE ON UPDATE CASCADE
) engine=innoDB;


    