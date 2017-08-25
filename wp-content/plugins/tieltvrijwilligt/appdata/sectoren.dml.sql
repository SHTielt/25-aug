insert into sh_sectoren (secid, secnaam, secinfo) values(1, 'Cultuur', NULL);
insert into sh_sectoren (secid, secnaam, secinfo) values(2, 'Jeugd', NULL);
insert into sh_sectoren (secid, secnaam, secinfo) values(3, 'Sport', NULL);
insert into sh_sectoren (secid, secnaam, secinfo) values(4, 'Senioren', NULL);
insert into sh_sectoren (secid, secnaam, secinfo) values(5, 'Welzijn', NULL);
insert into sh_sectoren (secid, secnaam, secinfo) values(6, 'Andere', NULL);


USE sociaalhuis;
DROP PROCEDURE IF EXISTS `SectorSelectById`;
DELIMITER //
CREATE PROCEDURE `SectorSelectById`
(
	IN pId INT
)
BEGIN
	SELECT * FROM sh_sectoren
	WHERE secid = pId;
END //
DELIMITER ;

call SectorSelectById(2);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS SectorSelectAll;
DELIMITER //
CREATE PROCEDURE SectorSelectAll()
BEGIN
	SELECT * FROM sh_sectoren order by secnaam;
END //
DELIMITER ;

call SectorSelectAll();

USE sociaalhuis;
DROP PROCEDURE IF EXISTS SectorInsert;
DELIMITER //
CREATE PROCEDURE SectorInsert
(
	OUT secid INT ,
	IN secnaam VARCHAR (255) CHARACTER SET UTF8 ,
	IN secinfo VARCHAR (255) CHARACTER SET UTF8 
)
BEGIN
	INSERT INTO sh_sectoren
	(
		secnaam,
		secinfo
	)
	VALUES
	(
		secnaam,
		secinfo
	);
	SELECT LAST_INSERT_ID() INTO secid;
END //
DELIMITER ;

call SectorInsert(@secid, 'Asiel en migratie', NULL);


USE sociaalhuis;
DROP PROCEDURE IF EXISTS SectorUpdate;
DELIMITER //
CREATE PROCEDURE SectorUpdate
(
	IN psecid INT ,
	IN psecnaam VARCHAR (255) CHARACTER SET UTF8 ,
	IN psecinfo VARCHAR (255) CHARACTER SET UTF8 
)
BEGIN
UPDATE sh_sectoren
SET
	secnaam = psecnaam,
	secinfo = psecinfo
	
WHERE secid = psecid;
END //
DELIMITER ;

call SectorUpdate(7, 'Asiel, migratie en inburgering', NULL);
 
USE sociaalhuis;
DROP PROCEDURE IF EXISTS `SectorDelete`;
DELIMITER //
CREATE PROCEDURE `SectorDelete`
(
	IN pId INT
)
BEGIN
DELETE FROM sh_sectoren WHERE secid = pId;
END //
DELIMITER ;

call SectorDelete(7);