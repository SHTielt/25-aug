USE `sociaalhuis`;
DROP TABLE IF EXISTS `sh_verenigingen`;
CREATE TABLE `sh_verenigingen` (
  `verID` int(11) NOT NULL AUTO_INCREMENT,
  `verNaam` varchar(255) CHARACTER SET utf8 NOT NULL,
  `verLocatie` varchar(255) CHARACTER SET utf8 NULL,
  `verOmschrijving` text CHARACTER SET utf8 NULL,
  `verWerkingsGebied` varchar(255) CHARACTER SET utf8 NULL,
  `verWebsite` varchar(255) CHARACTER SET utf8 NULL,
  `verFacebook` varchar(255) CHARACTER SET utf8 NULL,
  `verBeschrijving` varchar(50) CHARACTER SET utf8 NULL,
  `verActief` TINYINT(1),
  `verWPUserID` int(11) NOT NULL,
  `rvID` int(11) NULL,
  PRIMARY KEY (`verId`),
  UNIQUE KEY `uc_verWPUserID` (`verWPUserID`),
  CONSTRAINT `fkc_verenigingen_rechtsvormen` FOREIGN KEY (`rvID`) REFERENCES `sh_rechtsvormen` (`rvID`) ON UPDATE CASCADE
) engine=innoDB;


