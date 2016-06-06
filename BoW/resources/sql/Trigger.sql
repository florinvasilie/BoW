DROP SEQUENCE plante_seq;

CREATE SEQUENCE plante_seq START WITH 1 INCREMENT BY 1 NOMAXVALUE; 
/
DROP TRIGGER plante_increment;
/
CREATE TRIGGER plante_increment
BEFORE INSERT ON plante
FOR EACH ROW
BEGIN
 	SELECT plante_seq.nextval INTO :new.id_planta FROM DUAL;
END;
/