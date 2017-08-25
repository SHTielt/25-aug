insert into sh_functies (funcid, funcnaam, funcinfo) values(1, 'Penningmeester', 'vzw');
insert into sh_functies (funcid, funcnaam, funcinfo) values(2, 'Secretaris', 'vzw');
insert into sh_functies (funcid, funcnaam, funcinfo) values(3, 'Secretaris-Penningmeester', NULL);
insert into sh_functies (funcid, funcnaam, funcinfo) values(4, 'Voorzitter', 'vzw');

USE sociaalhuis;
DROP PROCEDURE IF EXISTS FunctieInsert;
DELIMITER //
CREATE PROCEDURE FunctieInsert
(
	OUT pfuncID INT ,
	IN pfuncNaam VARCHAR (255) CHARACTER SET UTF8 ,
	IN pfuncInfo VARCHAR (255) CHARACTER SET UTF8
)
BEGIN
	INSERT INTO sh_functies
	(
		funcNaam,
		funcInfo
	)
	VALUES
	(
		pfuncNaam,
		pfuncInfo
	);
	SELECT LAST_INSERT_ID() INTO pfuncID;
END //
DELIMITER ;

call FunctieInsert(@funcID, 'Directeur', 'in stichting');


USE sociaalhuis;
DROP PROCEDURE IF EXISTS FunctieUpdate;
DELIMITER //
CREATE PROCEDURE FunctieUpdate
(
	IN pfuncID INT ,
	IN pfuncNaam VARCHAR (255) CHARACTER SET UTF8 ,
	IN pfuncInfo VARCHAR (255) CHARACTER SET UTF8 
)
BEGIN
UPDATE sh_functies
SET
	funcNaam = pfuncNaam,
	funcInfo = pfuncInfo
WHERE funcID = pfuncID;
END //
DELIMITER ;

call FunctieUpdate(5, 'Directeur', 'Stichting');

 
USE sociaalhuis;
DROP PROCEDURE IF EXISTS `FunctieDelete`;
DELIMITER //
CREATE PROCEDURE `FunctieDelete`
(
	IN pId INT
)
BEGIN
DELETE FROM sh_functies WHERE funcID = pId;
END //
DELIMITER ;

USE sociaalhuis;
DROP PROCEDURE IF EXISTS `FunctieSelectById`;
DELIMITER //
CREATE PROCEDURE `FunctieSelectById`
(
	IN pId INT
)
BEGIN
	SELECT * FROM sh_functies
	WHERE funcID = pId;
END //
DELIMITER ;

call functieselectById(2);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS FunctieSelectAll;
DELIMITER //
CREATE PROCEDURE FunctieSelectAll()
BEGIN
	SELECT * FROM sh_functies order by funcNaam;
END //
DELIMITER ;

call functieselectAll();

