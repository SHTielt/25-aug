insert into sh_bestuurders(bestVoornaam, bestNaam, bestInfo, bestEmail, bestGSM, bestTelefoon, bestContactPersoon, cvID, funcID, verID) values('Janssens', 'Jan', 'Plaatsvervangend voorzitter', 'jan.janssens@yahoo.com', NULL, '051/401223', 0, 1, 4, 1);


USE sociaalhuis;
DROP PROCEDURE IF EXISTS BestuurderInsert;
DELIMITER //
CREATE PROCEDURE BestuurderInsert
(
	OUT pbestID INT ,
	IN pbestVoornaam VARCHAR (255) CHARACTER SET UTF8 ,
    IN pbestNaam VARCHAR (255) CHARACTER SET UTF8 ,
    IN pbestInfo VARCHAR (255) CHARACTER SET UTF8 ,
	IN pbestEmail VARCHAR (255) CHARACTER SET UTF8 ,
    IN pbestGSM VARCHAR (255) CHARACTER SET UTF8 ,
    IN pbestTelefoon VARCHAR (255) CHARACTER SET UTF8 ,
    IN pcvID INT ,
    IN pfuncID INT ,
    IN pverID INT 
)
BEGIN
	INSERT INTO sh_bestuurders
	(
		bestVoornaam,
        bestNaam,
        bestInfo,
        bestEmail,
        bestGSM,
        bestTelefoon,
        cvID,
        funcID,
        verID
	)
	VALUES
	(
		pbestVoornaam ,
        pbestNaam ,
	    pbestInfo ,
	    pbestEmail ,
        pbestGSM ,
        pbestTelefoon ,
        pcvID ,
        pfuncID ,
        pverID  
	);
	SELECT LAST_INSERT_ID() INTO pbestID;
END //
DELIMITER ;

call BestuurderInsert(@pbestID, 'Jos', 'Jolens', 'penningmeester op rust', 'josj@skynet.be', '0477/123456', '051/401447', 1, 1, 1);


USE sociaalhuis;
DROP PROCEDURE IF EXISTS BestuurderUpdate;
DELIMITER //
CREATE PROCEDURE BestuurderUpdate
(
	IN pbestID INT ,
	IN pbestVoornaam VARCHAR (255) CHARACTER SET UTF8 ,
    IN pbestNaam VARCHAR (255) CHARACTER SET UTF8 ,
    IN pbestInfo VARCHAR (255) CHARACTER SET UTF8 ,
	IN pbestEmail VARCHAR (255) CHARACTER SET UTF8 ,
    IN pbestGSM VARCHAR (255) CHARACTER SET UTF8 ,
    IN pbestTelefoon VARCHAR (255) CHARACTER SET UTF8 ,
    IN pcvID INT ,
    IN pfuncID INT ,
    IN pverID INT 
)
BEGIN
UPDATE sh_bestuurders
SET
	bestVoornaam = pbestVoornaam,
    bestNaam = pbestNaam,
    bestInfo = pbestInfo,
	bestEmail = pbestEmail,
    bestGSM = pbestGSM,
    bestTelefoon = pbestTelefoon,
    cvID = pcvID,
    funcID = pfuncID,
    verID = pverID
WHERE bestId = pbestId;
END //
DELIMITER ;

call BestuurderUpdate(3, 'Jos', 'Jolens', 'penningmeester op pensioen', 'josj@skynet.be', '0477/123456', '051/401447', 1, 1, 1);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS `BestuurderDelete`;
DELIMITER //
CREATE PROCEDURE `BestuurderDelete`
(
	IN pId INT
)
BEGIN
DELETE FROM sh_bestuurders WHERE bestID = pId;
END //
DELIMITER ;

USE sociaalhuis;
DROP PROCEDURE IF EXISTS bestuurderselectAll;
DELIMITER //
CREATE PROCEDURE bestuurderselectAll
(
)
BEGIN
	SELECT * FROM sh_bestuurders order by bestNaam;
END //
DELIMITER ;

call bestuurderselectall();

USE sociaalhuis;
DROP PROCEDURE IF EXISTS `BestuurderSelectById`;
DELIMITER //
CREATE PROCEDURE `BestuurderSelectById`
(
	IN pbestID INT 
)
BEGIN
	SELECT * FROM sh_bestuurders WHERE bestID = pbestID;
END //
DELIMITER ;

call bestuurderselectById(1);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS `BestuurderSelectByVerenigingId`;
DELIMITER //
CREATE PROCEDURE `BestuurderSelectByVerenigingId`
(
	IN pverID INT 
)
BEGIN
	SELECT * FROM sh_bestuurders WHERE verID = pverID;
END //
DELIMITER ;

call BestuurderSelectByVerenigingId(4);
