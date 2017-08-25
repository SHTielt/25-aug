insert into sh_vrijwilligers(vrVoornaam, vrNaam, vrAdres, vrPostCode, vrGemeente, vrGeboorteDatum, vrEmail, vrGSM, vrTelefoon, vrInfo, vrComment, vrActief, sID, cvID, vrWPUserID) values('Janssens', 'Jan', 'Deken Darraslaan 12', '8700', 'Tielt', '1980-02-05', 'jan.janssens@yahoo.com', NULL, '051/401223', NULL, NULL, 1, NULL, 1, 1);


USE sociaalhuis;
DROP PROCEDURE IF EXISTS VrijwilligerInsert;
DELIMITER //
CREATE PROCEDURE VrijwilligerInsert
(
	OUT pvrID INT ,
	IN pvrVoornaam VARCHAR (255) CHARACTER SET UTF8 ,
    IN pvrNaam VARCHAR (255) CHARACTER SET UTF8 ,
	IN pvrAdres VARCHAR (255) CHARACTER SET UTF8 ,
	IN pvrPostCode VARCHAR (255) CHARACTER SET UTF8 ,
    IN pvrGemeente VARCHAR (255) CHARACTER SET UTF8 ,
	IN pvrGeboorteDatum DATE ,
    IN pvrEmail VARCHAR (255) CHARACTER SET UTF8 ,
    IN pvrGSM VARCHAR (255) CHARACTER SET UTF8 ,
    IN pvrTelefoon VARCHAR (255) CHARACTER SET UTF8 ,
    IN pvrInfo VARCHAR (255) CHARACTER SET UTF8 ,
    IN pvrComment VARCHAR (255) CHARACTER SET UTF8 ,
    IN pvrActief TINYINT(1),
    IN psID INT ,
    IN pcvID INT ,
    IN pvrWPUserID INT 
)
BEGIN
	INSERT INTO sh_vrijwilligers
	(
		vrVoornaam,
        vrNaam,
        vrAdres,
        vrPostCode,
        vrGemeente,
        vrGeboorteDatum,
        vrEmail,
        vrGSM,
        vrTelefoon,
        vrInfo,
        vrComment,
        vrActief,
        sID,
        cvID,
        vrWPUserID
	)
	VALUES
	(
		pvrVoornaam ,
        pvrNaam ,
	    pvrAdres ,
	    pvrPostCode ,
        pvrGemeente ,
	    pvrGeboorteDatum ,
        pvrEmail ,
        pvrGSM ,
        pvrTelefoon ,
        pvrInfo ,
        pvrComment ,
        pvrActief ,
        psID ,
        pcvID ,
        pvrWPUserID  
	);
	SELECT LAST_INSERT_ID() INTO pvrID;
END //
DELIMITER ;

call VrijwilligerInsert(@pvrID, 'Jos', 'Jolens', 'Vredestraat 5', '8700', 'Tielt', '1950-10-14', 'josj@skynet.be', '0477/123456', '051/401447', 'Geen info', 'Lui', 1, 1, 2, 5);


USE sociaalhuis;
DROP PROCEDURE IF EXISTS VrijwilligerUpdate;
DELIMITER //
CREATE PROCEDURE VrijwilligerUpdate
(
	In pvrID INT ,
	IN pvrVoornaam VARCHAR (255) CHARACTER SET UTF8 ,
    IN pvrNaam VARCHAR (255) CHARACTER SET UTF8 ,
	IN pvrAdres VARCHAR (255) CHARACTER SET UTF8 ,
	IN pvrPostCode VARCHAR (255) CHARACTER SET UTF8 ,
    IN pvrGemeente VARCHAR (255) CHARACTER SET UTF8 ,
	IN pvrGeboorteDatum DATE ,
    IN pvrEmail VARCHAR (255) CHARACTER SET UTF8 ,
    IN pvrGSM VARCHAR (255) CHARACTER SET UTF8 ,
    IN pvrTelefoon VARCHAR (255) CHARACTER SET UTF8 ,
    IN pvrInfo VARCHAR (255) CHARACTER SET UTF8 ,
    IN pvrComment VARCHAR (255) CHARACTER SET UTF8 ,
    IN pvrActief TINYINT(1),
    IN psID INT ,
    IN pcvID INT ,
    IN pvrWPUserID INT 
)
BEGIN
UPDATE sh_vrijwilligers
SET
	vrVoornaam = pvrVoornaam,
    vrNaam = pvrNaam,
	vrAdres = pvrAdres,
    vrPostCode = pvrPostCode,
    vrGemeente = pvrGemeente, 
    vrGeboorteDatum = pvrGeboorteDatum,
	vrEmail = pvrEmail,
    vrGSM = pvrGSM,
    vrTelefoon = pvrTelefoon,
    vrInfo = pvrInfo,
    vrComment = pvrComment,
    vrActief = pvrActief,
    sID = psID,
    cvID = pcvID,
    vrWPUserID = pvrWPUserID
WHERE vrId = pvrId;
END //
DELIMITER ;

call VrijwilligerUpdate(2,'Jos', 'Jolens', 'Vredestraat 5', '8700', 'Tielt', '1960-10-14', 'josj@skynet.be', '0477/123456', '051/401447', 'Geen info', 'Lui', 1, 1, 2, 5);
call VrijwilligerUpdate(7,'Mie', 'Mietens', 'Markt 5', '8700', 'Tielt', '1950-10-14', 'mie.mietens@skynet.be', NULL, NULL, 'Geen info', NULL, 1, NULL, 1, 9);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS `VrijwilligerDelete`;
DELIMITER //
CREATE PROCEDURE `VrijwilligerDelete`
(
	IN pId INT
)
BEGIN
DELETE FROM sh_vrijwilligers WHERE vrID = pId;
END //
DELIMITER ;

USE sociaalhuis;
DROP PROCEDURE IF EXISTS VrijwilligerSelectAll;
DELIMITER //
CREATE PROCEDURE VrijwilligerSelectAll
(
)
BEGIN
	SELECT * FROM sh_vrijwilligers order by vrNaam;
END //
DELIMITER ;

call Vrijwilligerselectall();

USE sociaalhuis;
DROP PROCEDURE IF EXISTS `VrijwilligerSelectById`;
DELIMITER //
CREATE PROCEDURE `VrijwilligerSelectById`
(
	IN pvrID INT 
)
BEGIN
	SELECT * FROM sh_vrijwilligers WHERE vrID = pvrID;
END //
DELIMITER ;

call VrijwilligerSelectById(1);

//select vrijwilligerid by userid
USE sociaalhuis;
DROP PROCEDURE IF EXISTS `VrijwilligerSelectByUserId`;
DELIMITER //
CREATE PROCEDURE `VrijwilligerSelectByUserId`
(
	IN pvrWPUserID INT 
)
BEGIN
	SELECT * FROM sh_vrijwilligers WHERE vrWPUserID = pvrWPUserID;
END //
DELIMITER ;

call VrijwilligerSelectByUserId(1);

//selecteer vrijwilliger op basis van zijn naam, voornaam en geboortedatum
USE sociaalhuis;
DROP PROCEDURE IF EXISTS `VrijwilligerSelectByVoornaamNaamGeboorteDatum`;
DELIMITER //
CREATE PROCEDURE `VrijwilligerSelectByVoornaamNaamGeboorteDatum`
(
	IN pvrVoornaam VARCHAR (255) CHARACTER SET UTF8 ,
    IN pvrNaam VARCHAR (255) CHARACTER SET UTF8 ,
	IN pvrGeboorteDatum DATE 
)
BEGIN
	SELECT * FROM sh_vrijwilligers WHERE vrVoornaam = pvrVoornaam AND vrNaam = pvrNaam AND vrGeboortedatum = pvrGeboorteDatum;
END //
DELIMITER ;

call VrijwilligerSelectByVoornaamNaamGeboorteDatum('Mie','Mietens','2015-04-01');

