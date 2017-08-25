USE sociaalhuis; 
DROP TABLE IF EXISTS sh_contactvoorkeuren; 

CREATE TABLE sh_contactvoorkeuren ( 
	cvID INT NOT NULL AUTO_INCREMENT, 
	CONSTRAINT PRIMARY KEY(cvID), 
	cvVoorkeur VARCHAR (255) CHARACTER SET UTF8 NULL
    ) engine=innoDB;  