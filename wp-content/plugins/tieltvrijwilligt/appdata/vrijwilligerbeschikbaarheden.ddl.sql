USE `sociaalhuis`;
DROP TABLE IF EXISTS `sh_vrijwilligerbeschikbaarheden`;
CREATE TABLE `sh_vrijwilligerbeschikbaarheden` (
  `vrbsbID` INT(11) NOT NULL AUTO_INCREMENT,
  `bsbID` INT(11) NOT NULL,
  `vrID` INT(11) NOT NULL,
  `vrbsbInfo` varchar(255) CHARACTER SET utf8 NULL,
  PRIMARY KEY (`vrbsbID`),
  CONSTRAINT `fkc_vrijwilligerbeschikbaarheden_vrijwilligers` FOREIGN KEY (`vrID`) REFERENCES `sh_vrijwilligers` (`vrID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkc_vrijwilligerbeschikbaarheden_beschikbaarheden` FOREIGN KEY (`bsbID`) REFERENCES `sh_beschikbaarheden` (`bsbID`) ON DELETE CASCADE ON UPDATE CASCADE
) engine=innoDB;
