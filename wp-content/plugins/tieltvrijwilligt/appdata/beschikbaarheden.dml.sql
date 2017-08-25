insert into sh_beschikbaarheden (bsbid, bsbnaam) values(1, 'Maandag Voormiddag');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(2, 'Maandag Namiddag');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(3, 'Maandag Avond');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(4, 'Dinsdag Voormiddag');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(5, 'Dinsdag Namiddag');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(6, 'Dinsdag Avond');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(7, 'Woensdag Voormiddag');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(8, 'Woensdag Namiddag');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(9, 'Woensdag Avond');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(10, 'Donderdag Voormiddag');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(11, 'Donderdag Namiddag');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(12, 'Donderdag Avond');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(13, 'Vrijdag Voormiddag');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(14, 'Vrijdag Namiddag');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(15, 'Vrijdag Avond');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(16, 'Zaterdag Voormiddag');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(17, 'Zaterdag Namiddag');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(18, 'Zaterdag Avond');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(19, 'Zondag Voormiddag');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(20, 'Zondag Namiddag');
insert into sh_beschikbaarheden (bsbid, bsbnaam) values(21, 'Zondag Avond');

USE sociaalhuis;
DROP PROCEDURE IF EXISTS BeschikbaarheidSelectAll;
DELIMITER //
CREATE PROCEDURE BeschikbaarheidSelectAll()
BEGIN
	SELECT * FROM sh_beschikbaarheden order by bsbID;
END //
DELIMITER ;

call BeschikbaarheidSelectAll();
