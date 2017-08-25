USE sociaalhuis;
DROP TABLE IF EXISTS `sh_beschikbaarheden`;
CREATE TABLE `sh_beschikbaarheden` (
	`bsbID` INT NOT NULL AUTO_INCREMENT,
	CONSTRAINT PRIMARY KEY(bsbID),
	`bsbNaam` VARCHAR (255) CHARACTER SET UTF8 NOT NULL
) engine=innoDB;






