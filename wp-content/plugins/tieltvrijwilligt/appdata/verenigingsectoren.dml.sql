insert into sh_verenigingsectoren(vrdwID, vrID, dwID, vrdwInfo) values(1, 1, 1, NULL);


USE sociaalhuis;
DROP PROCEDURE IF EXISTS VerenigingSectorInsert;
DELIMITER //
CREATE PROCEDURE VerenigingSectorInsert
(
	OUT pversecID INT ,
    IN pverID INT ,
	IN psecID INT 
)
BEGIN
	INSERT INTO sh_verenigingsectoren
	(
		verID,
        secID
	)
	VALUES
	(
		pverID,
        psecID
	);
	SELECT LAST_INSERT_ID() INTO pversecID;
END //
DELIMITER ;

call VerenigingSectorInsert(@pversecID, 1, 2);


USE sociaalhuis;
DROP PROCEDURE IF EXISTS `VerenigingSectorDelete`;
DELIMITER //
CREATE PROCEDURE `VerenigingSectorDelete`
(
	IN pId INT
)
BEGIN
DELETE FROM `sh_verenigingsectoren`
WHERE versecID = pId;
END //
DELIMITER ;

call VerenigingSectorDelete(2);

/*sectoren per vereniging selecteren*/
USE sociaalhuis;
DROP PROCEDURE IF EXISTS `SelectSectorenByVerenigingId`;
DELIMITER //
CREATE PROCEDURE `SelectSectorenByVerenigingId`
(
	IN pverId INT
)
BEGIN
SELECT * from sh_verenigingsectoren where verID = pverId;
END //
DELIMITER ;

call SelectSectorenByVerenigingId(1);

/*selectie van verenigingsectoren per sector*/
USE sociaalhuis;
DROP PROCEDURE IF EXISTS `VerenigingSectorSelectVerenigingBySectorId`;
DELIMITER //
CREATE PROCEDURE `VerenigingSectorSelectVerenigingBySectorId`
(
	IN psecId INT
)
BEGIN
SELECT * from sh_verenigingsectoren where secID = psecId;
END //
DELIMITER ;

call VerenigingSectorSelectVerenigingBySectorId(1);

/*selectie van verenigingen per sector*/
USE sociaalhuis;
DROP PROCEDURE IF EXISTS `FilterVerenigingenBySectorId`;
DELIMITER //
CREATE PROCEDURE `FilterVerenigingenBySectorId`
(
	IN psecId INT
)
BEGIN
SELECT * from sh_verenigingsectoren, sh_verenigingen
where sh_verenigingen.verID = sh_verenigingsectoren.verID and secID = psecId;
END //
DELIMITER ;

call FilterVerenigingenBySectorId(4);
