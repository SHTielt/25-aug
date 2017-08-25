insert into sh_deelwerkingen (dwid, dwnaam, dwinfo, dwactief) values(1, 'Boodschappendienst', 'DC Vijverhof', 1);
insert into sh_deelwerkingen (dwid, dwnaam, dwinfo, dwactief) values(2, 'Dorpresto Saar', 'Sociaal Huis', 1);
insert into sh_deelwerkingen (dwid, dwnaam, dwinfo, dwactief) values(3, 'Huiswerkbegeleiding', 'Sociaal Huis', 1);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS `DeelwerkingSelectById`;
DELIMITER //
CREATE PROCEDURE `DeelwerkingSelectById`
(
	IN pId INT
)
BEGIN
	SELECT * FROM sh_deelwerkingen
	WHERE dwId = pId;
END //
DELIMITER ;

call DeelwerkingSelectById(2);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS DeelwerkingSelectAll;
DELIMITER //
CREATE PROCEDURE DeelwerkingSelectAll()
BEGIN
	SELECT * FROM sh_deelwerkingen order by dwNaam;
END //
DELIMITER ;

call DeelwerkingSelectAll();

USE sociaalhuis;
DROP PROCEDURE IF EXISTS DeelwerkingInsert;
DELIMITER //
CREATE PROCEDURE DeelwerkingInsert
(
	OUT pdwID INT ,
	IN pdwNaam VARCHAR (255) CHARACTER SET UTF8 ,
	IN pdwInfo VARCHAR (255) CHARACTER SET UTF8 ,
	IN pdwActief TINYINT (1)
)
BEGIN
	INSERT INTO sh_deelwerkingen
	(
		dwNaam,
		dwInfo,
		dwActief
	)
	VALUES
	(
		pdwNaam,
		pdwInfo,
		pdwActief
	);
	SELECT LAST_INSERT_ID() INTO pdwID;
END //
DELIMITER ;

call DeelwerkingInsert(@pdwID, 'Huyse Kenhoft', 'Dagverzorgingscentrum', '1');


USE sociaalhuis;
DROP PROCEDURE IF EXISTS DeelwerkingUpdate;
DELIMITER //
CREATE PROCEDURE DeelwerkingUpdate
(
	IN pdwID INT ,
	IN pdwNaam VARCHAR (255) CHARACTER SET UTF8 ,
	IN pdwInfo VARCHAR (255) CHARACTER SET UTF8 ,
	IN pdwActief TINYINT (1)
)
BEGIN
UPDATE sh_deelwerkingen
SET
	dwNaam = pdwNaam,
	dwInfo = pdwInfo,
	dwActief = pdwActief
WHERE dwID = pdwID;
END //
DELIMITER ;

call DeelwerkingUpdate(4, 'Huyse Kenhoft', 'Dagverzorgingscentrum',0); 
call DeelwerkingUpdate(4, 'Huyse Kenhoft', 'Dagverzorgingscentrum',0); 

USE sociaalhuis;
DROP PROCEDURE IF EXISTS `DeelwerkingDelete`;
DELIMITER //
CREATE PROCEDURE `DeelwerkingDelete`
(
	IN pId INT
)
BEGIN
DELETE FROM sh_deelwerkingen WHERE dwID = pId;
END //
DELIMITER ;