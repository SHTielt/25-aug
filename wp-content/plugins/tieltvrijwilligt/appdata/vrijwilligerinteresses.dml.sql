insert into sh_vrijwilligerinteresses(vrintID, vrID, intID, vrintInfo) values(1, 1, 1, NULL);


USE sociaalhuis;
DROP PROCEDURE IF EXISTS VrijwilligerInteresseInsert;
DELIMITER //
CREATE PROCEDURE VrijwilligerInteresseInsert
(
	OUT pvrintID INT ,
    IN pvrID INT ,
	IN pintID INT ,
	IN pvrintInfo VARCHAR (255) CHARACTER SET UTF8 
)
BEGIN
	INSERT INTO sh_vrijwilligerinteresses
	(
		vrID,
        intID,
        vrintInfo
	)
	VALUES
	(
		pvrID,
        pintID,
        pvrintInfo
	);
	SELECT LAST_INSERT_ID() INTO pvrintID;
END //
DELIMITER ;

call VrijwilligerInteresseInsert(@pvrintID, 1, 2, 'slechts 2 uren');
call VrijwilligerInteresseInsert(@pvrintID, 2, 2, 'slechts 3 uren');


USE sociaalhuis;
DROP PROCEDURE IF EXISTS `VrijwilligerInteresseDelete`;
DELIMITER //
CREATE PROCEDURE `VrijwilligerInteresseDelete`
(
	IN pId INT
)
BEGIN
DELETE FROM `sh_vrijwilligerinteresses`
WHERE vrintID = pId;
END //
DELIMITER ;

call VrijwilligerInteresseDelete(2);

/*interesses per lid selecteren*/
/*1ste poging*/
/*
USE sociaalhuis;
DROP PROCEDURE IF EXISTS `SelectInteressesByVrijwilligerId`;
DELIMITER //
CREATE PROCEDURE `SelectInteressesByVrijwilligerId`
(
	IN pMemberId INT
)
BEGIN
SELECT rs_projects.ProjectId as ProjectId, rs_projects.ProjectTitle as ProjectTitle, rs_projects.GroupName as GroupName, rs_projects.PplEstimated as PplEstimated,
 rs_projects.Location as Location, rs_projects.Objective as Objective, rs_projects.Means as Means, rs_projects.StartDate as StartDate, rs_projects.TimeFrameId as TimeFrameId,
 rs_projects.LanguageId as LanguageId, rs_projects.CountryId as CountryId, rs_projects.ProjectStatusId as ProjectStatusId, rs_projects.HoursSpent as HoursSpent,
 rs_projects.PplParticipated as PplParticipated, rs_projects.PplServed as PplServed, rs_projects.Report as Report, rs_projects.EndDate as EndDate, rs_projects.InsertedBy as InsertedBy, rs_projects.InsertedOn as InsertedOn, rs_projects.ModifiedBy as ModifiedBy, rs_projects.ModifiedOn as ModifiedOn
from rs_projects, rs_projectmembers, rs_members where rs_projects.ProjectId = rs_projectmembers.ProjectId and rs_members.MemberId = rs_projectmembers.MemberId and rs_members.MemberId = pMemberId;
END //
DELIMITER ;

call SelectProjectsByMemberId(1);
*/

/*2de poging*/
USE sociaalhuis;
DROP PROCEDURE IF EXISTS `SelectInteressesByVrijwilligerId`;
DELIMITER //
CREATE PROCEDURE `SelectInteressesByVrijwilligerId`
(
	IN pvrId INT
)
BEGIN
SELECT * from sh_vrijwilligerinteresses where vrID = pvrId;
END //
DELIMITER ;

call SelectInteressesByVrijwilligerId(2);


