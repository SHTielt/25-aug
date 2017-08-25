insert into sh_statussen (sid, snaam) values(1, 'Goedgekeurd');
insert into sh_statussen (sid, snaam) values(2, 'Afgekeurd');

USE sociaalhuis;
DROP PROCEDURE IF EXISTS StatusSelectAll;
DELIMITER //
CREATE PROCEDURE StatusSelectAll()
BEGIN
	SELECT * FROM sh_statussen order by sid;
END //
DELIMITER ;

call StatusSelectAll();

USE sociaalhuis;
DROP PROCEDURE IF EXISTS StatusSelectById;
DELIMITER //
CREATE PROCEDURE StatusSelectById
(
	IN pId INT
)
BEGIN
	SELECT * FROM sh_statussen WHERE sid = pId;
END //
DELIMITER ;

call StatusSelectById(2); 