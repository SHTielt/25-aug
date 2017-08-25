insert into sh_vrijwilligerdeelwerkingen(vrdwID, vrID, dwID, vrdwInfo) values(1, 1, 1, NULL);


USE sociaalhuis;
DROP PROCEDURE IF EXISTS VrijwilligerDeelwerkingInsert;
DELIMITER //
CREATE PROCEDURE VrijwilligerDeelwerkingInsert
(
	OUT pvrdwID INT ,
    IN pvrID INT ,
	IN pdwID INT ,
	IN pvrdwInfo VARCHAR (255) CHARACTER SET UTF8 
)
BEGIN
	INSERT INTO sh_vrijwilligerdeelwerkingen
	(
		vrID,
        dwID,
        vrdwInfo
	)
	VALUES
	(
		pvrID,
        pdwID,
        pvrdwInfo
	);
	SELECT LAST_INSERT_ID() INTO pvrdwID;
END //
DELIMITER ;

call VrijwilligerDeelwerkingInsert(@pvrdwID, 1, 2, 'af en toe');
call VrijwilligerDeelwerkingInsert(@pvrintID, 2, 4, 'sporadisch');


USE sociaalhuis;
DROP PROCEDURE IF EXISTS `VrijwilligerDeelwerkingDelete`;
DELIMITER //
CREATE PROCEDURE `VrijwilligerDeelwerkingDelete`
(
	IN pId INT
)
BEGIN
DELETE FROM `sh_vrijwilligerdeelwerkingen`
WHERE vrdwID = pId;
END //
DELIMITER ;

call VrijwilligerDeelwerkingDelete(2);

/*deelwerkingen per vrijwilliger selecteren*/

USE sociaalhuis;
DROP PROCEDURE IF EXISTS `SelectDeelwerkingenByVrijwilligerId`;
DELIMITER //
CREATE PROCEDURE `SelectDeelwerkingenByVrijwilligerId`
(
	IN pvrId INT
)
BEGIN
SELECT * from sh_vrijwilligerdeelwerkingen where vrID = pvrId;
END //
DELIMITER ;

call SelectDeelwerkingenByVrijwilligerId(2);


