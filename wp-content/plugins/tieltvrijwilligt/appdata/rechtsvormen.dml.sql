insert into sh_rechtsvormen (rvid, rvnaam, rvinfo) values(1, 'Feitelijke vereniging', 'slechts 2 personen');
insert into sh_rechtsvormen (rvid, rvnaam, rvinfo) values(2, 'IVZW', 'bv. Don Bosco Youth-Net');
insert into sh_rechtsvormen (rvid, rvnaam, rvinfo) values(3, 'Lokale afdeling Koepel', 'bv. Femma');
insert into sh_rechtsvormen (rvid, rvnaam, rvinfo) values(4, 'Openbaar Bestuur', 'gemeente, OCMW, een school, een bibliotheek');
insert into sh_rechtsvormen (rvid, rvnaam, rvinfo) values(5, 'Stichting', NULL);
insert into sh_rechtsvormen (rvid, rvnaam, rvinfo) values(6, 'VZW', NULL);


USE sociaalhuis;
DROP PROCEDURE IF EXISTS `RechtsvormSelectById`;
DELIMITER //
CREATE PROCEDURE `RechtsvormSelectById`
(
	IN pId INT
)
BEGIN
	SELECT * FROM sh_rechtsvormen
	WHERE rvID = pId;
END //
DELIMITER ;

call RechtsvormSelectById(2);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS RechtsvormSelectAll;
DELIMITER //
CREATE PROCEDURE RechtsvormSelectAll()
BEGIN
	SELECT * FROM sh_rechtsvormen order by rvNaam;
END //
DELIMITER ;

call RechtsvormSelectAll();

USE sociaalhuis;
DROP PROCEDURE IF EXISTS RechtsvormInsert;
DELIMITER //
CREATE PROCEDURE RechtsvormInsert
(
	OUT rvID INT ,
	IN rvNaam VARCHAR (255) CHARACTER SET UTF8 ,
	IN rvInfo VARCHAR (255) CHARACTER SET UTF8 
)
BEGIN
	INSERT INTO sh_rechtsvormen
	(
		rvNaam,
		rvInfo
	)
	VALUES
	(
		rvNaam,
		rvInfo
	);
	SELECT LAST_INSERT_ID() INTO rvID;
END //
DELIMITER ;

call RechtsvormInsert(@rvID, 'Buddy werking', NULL);


USE sociaalhuis;
DROP PROCEDURE IF EXISTS RechtsvormUpdate;
DELIMITER //
CREATE PROCEDURE RechtsvormUpdate
(
	IN prvID INT ,
	IN prvNaam VARCHAR (255) CHARACTER SET UTF8 ,
	IN prvInfo VARCHAR (255) CHARACTER SET UTF8 
)
BEGIN
UPDATE sh_rechtsvormen
SET
	rvNaam = prvNaam,
	rvInfo = prvInfo
	
WHERE rvID = prvID;
END //
DELIMITER ;

call RechtsvormUpdate(7, 'Coaching', NULL);
 
USE sociaalhuis;
DROP PROCEDURE IF EXISTS `RechtsvormDelete`;
DELIMITER //
CREATE PROCEDURE `RechtsvormDelete`
(
	IN pId INT
)
BEGIN
DELETE FROM sh_rechtsvormen WHERE rvID = pId;
END //
DELIMITER ;

call RechtsvormDelete(7);