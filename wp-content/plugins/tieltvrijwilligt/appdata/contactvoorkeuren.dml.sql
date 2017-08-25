insert into sh_contactvoorkeuren (cvid, cvvoorkeur) values(1, 'E-mail');
insert into sh_contactvoorkeuren (cvid, cvvoorkeur) values(2, 'GSM');
insert into sh_contactvoorkeuren (cvid, cvvoorkeur) values(3, 'Telefoon');


USE sociaalhuis;
DROP PROCEDURE IF EXISTS ContactVoorkeurSelectAll;
DELIMITER //
CREATE PROCEDURE ContactVoorkeurSelectAll()
BEGIN
	SELECT * FROM sh_contactvoorkeuren order by cvID;
END //
DELIMITER ;

call ContactVoorkeurSelectAll();

USE sociaalhuis;
DROP PROCEDURE IF EXISTS ContactVoorkeurSelectById;
DELIMITER //
CREATE PROCEDURE ContactVoorkeurSelectById
(
	IN pId INT
)
BEGIN
	SELECT * FROM sh_contactvoorkeuren WHERE cvID = pId;
END //
DELIMITER ;