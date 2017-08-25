insert into sh_vrijwilligerbeschikbaarheden(vrbsbID, vrID, bsbID, vrbsbInfo) values(1, 1, 1, NULL);

USE sociaalhuis;
DROP PROCEDURE IF EXISTS VrijwilligerBeschikbaarheidInsert;
DELIMITER //
CREATE PROCEDURE VrijwilligerBeschikbaarheidInsert
(
	OUT pvrbsbID INT ,
    IN pvrID INT ,
	IN pbsbID INT ,
	IN pvrbsbInfo VARCHAR (255) CHARACTER SET UTF8 
)
BEGIN
	INSERT INTO sh_vrijwilligerbeschikbaarheden
	(
		vrID,
        bsbID,
        vrbsbInfo
	)
	VALUES
	(
		pvrID,
        pbsbID,
        pvrbsbInfo
	);
	SELECT LAST_INSERT_ID() INTO pvrbsbID;
END //
DELIMITER ;

call VrijwilligerBeschikbaarheidInsert(@pvrbsbID, 1, 2, 'slechts 2 uren');
call VrijwilligerBeschikbaarheidInsert(@pvrbsbID, 2, 2, 'slechts 3 uren');


USE sociaalhuis;
DROP PROCEDURE IF EXISTS `VrijwilligerBeschikbaarheidDelete`;
DELIMITER //
CREATE PROCEDURE `VrijwilligerBeschikbaarheidDelete`
(
	IN pId INT
)
BEGIN
DELETE FROM `sh_vrijwilligerbeschikbaarheden`
WHERE vrbsbID = pId;
END //
DELIMITER ;

call VrijwilligerBeschikbaarheidDelete(2);

/*beschikbaarheden per lid selecteren*/
USE sociaalhuis;
DROP PROCEDURE IF EXISTS `SelectBeschikbaarhedenByVrijwilligerId`;
DELIMITER //
CREATE PROCEDURE `SelectBeschikbaarhedenByVrijwilligerId`
(
	IN pvrId INT
)
BEGIN
SELECT * from sh_vrijwilligerbeschikbaarheden where vrID = pvrId;
END //
DELIMITER ;

call SelectBeschikbaarhedenByVrijwilligerId(2);


