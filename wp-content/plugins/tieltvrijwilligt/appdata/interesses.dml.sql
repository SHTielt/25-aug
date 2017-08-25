insert into sh_interesses (intid, intnaam, intinfo, intactief) values(1, 'Administratie', NULL, 1);
insert into sh_interesses (intid, intnaam, intinfo, intactief) values(2, 'Animatie', NULL, 1);
insert into sh_interesses (intid, intnaam, intinfo, intactief) values(3, 'Bar', NULL, 1);
insert into sh_interesses (intid, intnaam, intinfo, intactief) values(4, 'Boeken voorlezen', NULL, 1);
insert into sh_interesses (intid, intnaam, intinfo, intactief) values(5, 'Boodschappen doen', NULL, 1);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS `InteresseSelectById`;
DELIMITER //
CREATE PROCEDURE `InteresseSelectById`
(
	IN pId INT
)
BEGIN
	SELECT * FROM sh_interesses
	WHERE intID = pId;
END //
DELIMITER ;

call InteresseSelectById(2);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS InteresseSelectAll;
DELIMITER //
CREATE PROCEDURE InteresseSelectAll()
BEGIN
	SELECT * FROM sh_interesses order by intNaam;
END //
DELIMITER ;

call InteresseSelectAll();

USE sociaalhuis;
DROP PROCEDURE IF EXISTS InteresseInsert;
DELIMITER //
CREATE PROCEDURE InteresseInsert
(
	OUT pintID INT ,
	IN pintNaam VARCHAR (255) CHARACTER SET UTF8 ,
	IN pintInfo VARCHAR (255) CHARACTER SET UTF8 ,
	IN pintActief TINYINT (1)
)
BEGIN
	INSERT INTO sh_interesses
	(
		intNaam,
		intInfo,
		intActief
	)
	VALUES
	(
		pintNaam,
		pintInfo,
		pintActief
	);
	SELECT LAST_INSERT_ID() INTO pintID;
END //
DELIMITER ;

call InteresseInsert(@intID, 'Buddy werking', NULL, '1');


USE sociaalhuis;
DROP PROCEDURE IF EXISTS InteresseUpdate;
DELIMITER //
CREATE PROCEDURE InteresseUpdate
(
	IN pintID INT ,
	IN pintNaam VARCHAR (255) CHARACTER SET UTF8 ,
	IN pintInfo VARCHAR (255) CHARACTER SET UTF8 ,
	IN pintActief TINYINT (1)
)
BEGIN
UPDATE sh_interesses
SET
	intNaam = pintNaam,
	intInfo = pintInfo,
	intActief = pintActief
WHERE intID = pintID;
END //
DELIMITER ;

call InteresseUpdate(6, 'Buddy werking', NULL, '1');
call InteresseUpdate(7, 'Coaching', NULL, '1');
 
USE sociaalhuis;
DROP PROCEDURE IF EXISTS `InteresseDelete`;
DELIMITER //
CREATE PROCEDURE `InteresseDelete`
(
	IN pId INT
)
BEGIN
DELETE FROM sh_interesses WHERE intID = pId;
END //
DELIMITER ;