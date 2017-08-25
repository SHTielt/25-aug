USE sociaalhuis; 
DROP TABLE IF EXISTS sh_deelwerkingen; 

CREATE TABLE sh_deelwerkingen ( 
	dwId INT NOT NULL AUTO_INCREMENT, 
	CONSTRAINT PRIMARY KEY(dwId), 
	dwNaam VARCHAR (255) CHARACTER SET UTF8 NULL,
    dwInfo VARCHAR (255) CHARACTER SET UTF8 NULL,
    dwActief TINYINT(1)
    ) engine=innoDB;