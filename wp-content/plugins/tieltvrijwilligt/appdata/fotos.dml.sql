insert into sh_fotos (fid, fnaam, vrID, verID) values(1, 'Jan.jpg', 1, 1);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS FotoInsert;
DELIMITER //
CREATE PROCEDURE FotoInsert
(
	OUT pfID INT ,
	IN pfNaam VARCHAR (255) CHARACTER SET UTF8 ,
	IN pvrID INT,
    IN pverID INT
)
BEGIN
	INSERT INTO sh_fotos
	(
		fNaam,
		vrID,
        verID
	)
	VALUES
	(
		pfNaam,
		pvrID,
        pverID
	);
	SELECT LAST_INSERT_ID() INTO pfID;
END //
DELIMITER ;

call FotoInsert(@pfID, 'Mivalti.jpg', NULL, 3);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS FotoUpdate;
DELIMITER //
CREATE PROCEDURE FotoUpdate
(
	IN pfID INT ,
	IN pfNaam VARCHAR (255) CHARACTER SET UTF8 ,
	IN pvrID INT,
    IN pverID INT
)
BEGIN
UPDATE sh_fotos
SET
	fNaam = pfNaam,
	vrID = pvrID,
    verID = pverID

WHERE fID = pfID;
END //
DELIMITER ;

call FotoUpdate(2, 'Piet.gif', 3, NULL);


USE sociaalhuis;
DROP PROCEDURE IF EXISTS `FotoSelectByVrijwilligerId`;
DELIMITER //
CREATE PROCEDURE `FotoSelectByVrijwilligerId`
(
	IN pvrID INT
)
BEGIN
	SELECT * FROM sh_fotos
	WHERE vrID = pvrID;
END //
DELIMITER ;

call FotoSelectByVrijwilligerId(3);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS `FotoSelectByVerenigingId`;
DELIMITER //
CREATE PROCEDURE `FotoSelectByVerenigingId`
(
	IN pverID INT
)
BEGIN
	SELECT * FROM sh_fotos
	WHERE verID = pverID;
END //
DELIMITER ;

call FotoSelectByVerenigingId(3);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS `FotoDelete`;
DELIMITER //
CREATE PROCEDURE `FotoDelete`
(
	IN pId INT
)
BEGIN
DELETE FROM sh_fotos WHERE fID = pId;
END //
DELIMITER ;

call fotodelete(2);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS `FotoSelectById`;
DELIMITER //
CREATE PROCEDURE `FotoSelectById`
(
	IN pID INT
)
BEGIN
	SELECT * FROM sh_fotos
	WHERE fID = pID;
END //
DELIMITER ;

call FotoSelectById(3);