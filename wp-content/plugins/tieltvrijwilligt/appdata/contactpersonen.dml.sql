insert into sh_contactpersonen(contVoornaam, contNaam, contInfo, contEmail, contGSM, contTelefoon, cvID, verID) values('Janssens', 'Jan', 'Plaatsvervangend voorzitter', 'jan.janssens@yahoo.com', NULL, '051/401223', 1, 1);


USE sociaalhuis;
DROP PROCEDURE IF EXISTS ContactPersoonInsert;
DELIMITER //
CREATE PROCEDURE ContactPersoonInsert
(
	OUT pcontID INT ,
	IN pcontVoornaam VARCHAR (255) CHARACTER SET UTF8 ,
    IN pcontNaam VARCHAR (255) CHARACTER SET UTF8 ,
    IN pcontInfo VARCHAR (255) CHARACTER SET UTF8 ,
	IN pcontEmail VARCHAR (255) CHARACTER SET UTF8 ,
    IN pcontGSM VARCHAR (255) CHARACTER SET UTF8 ,
    IN pcontTelefoon VARCHAR (255) CHARACTER SET UTF8 ,
    IN pcvID INT ,
    IN pverID INT 
)
BEGIN
	INSERT INTO sh_contactpersonen
	(
		contVoornaam,
        contNaam,
        contInfo,
        contEmail,
        contGSM,
        contTelefoon,
        cvID,
        verID
	)
	VALUES
	(
		pcontVoornaam ,
        pcontNaam ,
	    pcontInfo ,
	    pcontEmail ,
        pcontGSM ,
        pcontTelefoon ,
        pcvID ,
        pverID  
	);
	SELECT LAST_INSERT_ID() INTO pcontID;
END //
DELIMITER ;

call ContactPersoonInsert(@pcontID, 'Jos', 'Jolens', 'penningmeester op rust', 'josj@skynet.be', '0477/123456', '051/401447', 1, 1);


USE sociaalhuis;
DROP PROCEDURE IF EXISTS ContactPersoonUpdate;
DELIMITER //
CREATE PROCEDURE ContactPersoonUpdate
(
	IN pcontID INT ,
	IN pcontVoornaam VARCHAR (255) CHARACTER SET UTF8 ,
    IN pcontNaam VARCHAR (255) CHARACTER SET UTF8 ,
    IN pcontInfo VARCHAR (255) CHARACTER SET UTF8 ,
	IN pcontEmail VARCHAR (255) CHARACTER SET UTF8 ,
    IN pcontGSM VARCHAR (255) CHARACTER SET UTF8 ,
    IN pcontTelefoon VARCHAR (255) CHARACTER SET UTF8 ,
    IN pcvID INT ,
    IN pverID INT 
)
BEGIN
UPDATE sh_contactpersonen
SET
	contVoornaam = pcontVoornaam,
    contNaam = pcontNaam,
    contInfo = pcontInfo,
	contEmail = pcontEmail,
    contGSM = pcontGSM,
    contTelefoon = pcontTelefoon,
    cvID = pcvID,
    verID = pverID
WHERE contId = pcontId;
END //
DELIMITER ;

call ContactPersoonUpdate(3, 'Jos', 'Jolens', 'penningmeester op pensioen', 'josj@skynet.be', '0477/123456', '051/401447', 1, 1);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS `ContactPersoonDelete`;
DELIMITER //
CREATE PROCEDURE `ContactPersoonDelete`
(
	IN pId INT
)
BEGIN
DELETE FROM sh_contactpersonen WHERE contID = pId;
END //
DELIMITER ;

USE sociaalhuis;
DROP PROCEDURE IF EXISTS ContactPersoonselectAll;
DELIMITER //
CREATE PROCEDURE ContactPersoonselectAll
(
)
BEGIN
	SELECT * FROM sh_contactpersonen order by contNaam;
END //
DELIMITER ;

call ContactPersoonselectall();

USE sociaalhuis;
DROP PROCEDURE IF EXISTS `ContactPersoonSelectById`;
DELIMITER //
CREATE PROCEDURE `ContactPersoonSelectById`
(
	IN pcontID INT 
)
BEGIN
	SELECT * FROM sh_contactpersonen WHERE contID = pcontID;
END //
DELIMITER ;

call ContactPersoonselectById(1);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS `ContactPersoonSelectByVerenigingId`;
DELIMITER //
CREATE PROCEDURE `ContactPersoonSelectByVerenigingId`
(
	IN pverID INT 
)
BEGIN
	SELECT * FROM sh_contactpersonen WHERE verID = pverID;
END //
DELIMITER ;

call ContactPersoonSelectByVerenigingId(1);
